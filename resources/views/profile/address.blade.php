<x-headersite/>
<style>
.profile-container {
    display: flex;
    padding: 20px;
    background: #f7f7f7;
}
.sidebar {
    width: 200px;
    background: #e6e6e6;
    padding: 20px;
}
.sidebar a {
    display: block;
    padding: 10px;
    margin-bottom: 5px;
    color: #000;
    font-weight: bold;
    text-decoration: none;
}
.sidebar a.active {
    background: #000;
    color: #fff;
}
.content {
    flex: 1;
    background: #fff;
    padding: 30px;
    margin-left: 20px;
    border-radius: 4px;
}
.table-address {
    width: 100%;
    border-collapse: collapse;
    margin-top: 20px;
}
.table-address th, .table-address td {
    border: 1px solid #ccc;
    padding: 10px;
}
.btn-submit {
    padding: 8px 16px;
    background: #222;
    color: #fff;
    border: none;
    border-radius: 4px;
}
input, select {
    width: 100%;
    height: 40px;
    margin-bottom: 10px;
    padding: 5px;
}
</style>

<div class="profile-container">

{{-- Sidebar --}}
<div class="sidebar">
    <a href="{{ route('profile.index') }}"
       class="{{ request()->routeIs('profile.index') ? 'active' : '' }}">
        PROFILE
    </a>

    <a href="{{ route('profile.address.index') }}"
       class="{{ request()->routeIs('profile.address.*') ? 'active' : '' }}">
        ADDRESSES
    </a>

    <a href="{{ route('profile.orders') }}"
       class="{{ request()->routeIs('profile.orders') ? 'active' : '' }}">
        ORDERS
    </a>

    <a href="{{ route('logout') }}">
        LOGOUT
    </a>
</div>

    {{-- Content --}}
    <div class="content">
        <h2>Alamat Saya</h2>

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        {{-- Form Tambah --}}
        <form action="{{ route('profile.address.store') }}" method="POST">
            @csrf

            <label>Nama Lengkap</label>
            <input type="text" name="full_name" required>

            <label>No. Telepon</label>
            <input type="text" name="phone" required>

            <label>Provinsi</label>
            <select id="province" name="province" required>
                <option value="">-- Pilih Provinsi --</option>
                @foreach($provinces as $p)
                    <option value="{{ $p['name'] }}" data-id="{{ $p['id'] }}">
                        {{ $p['name'] }}
                    </option>
                @endforeach
            </select>

            <label>Kota</label>
            <select id="city" name="city" required disabled>
                <option value="">Pilih Provinsi dulu</option>
            </select>

            <label>Kecamatan</label>
            <select id="district" name="district" required disabled>
                <option value="">Pilih Kota dulu</option>
            </select>

            <label>Kode Pos</label>
            <input type="text" name="postal_code" required>

            <label>Alamat Lengkap</label>
            <input type="text" name="address_line" required>

            <label>Detail Tambahan (Opsional)</label>
            <input type="text" name="additional_info">

            <button class="btn-submit">Tambah Alamat</button>
        </form>

        {{-- Tabel List --}}
        <table class="table-address">
            <thead>
                <tr>
                    <th>Nama</th>
                    <th>Telepon</th>
                    <th>Provinsi</th>
                    <th>Kota</th>
                    <th>Kecamatan</th>
                    <th>Kode Pos</th>
                    <th>Alamat</th>
                    <th>Default?</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($addresses as $address)
                <tr>
                    <td>{{ $address->full_name }}</td>
                    <td>{{ $address->phone }}</td>
                    <td>{{ $address->province }}</td>
                    <td>{{ $address->city }}</td>
                    <td>{{ $address->district }}</td>
                    <td>{{ $address->postal_code }}</td>
                    <td>{{ $address->address_line }}</td>
                    <td>{{ $address->is_default ? 'Default' : '-' }}</td>
                    <td>
                        <form action="{{ route('profile.address.destroy', $address->id) }}" method="POST">
                            @csrf @method('DELETE')
                            <button class="btn-submit" style="background:red"
                                onclick="return confirm('Hapus alamat ini?')">
                                Hapus
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr><td colspan="9" class="text-center">Belum ada alamat</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$('#province').on('change', function () {
    let id = $(this).find(':selected').data('id');

    $("#city").prop("disabled", false).html('<option>Loading...</option>');
    $("#district").html('<option>Pilih Kota dulu</option>').prop("disabled", true);

    $.get('/cities/' + id, function(data) {
        $("#city").html('<option value="">-- Pilih Kota --</option>');
        $.each(data, function(i, item) {
            $("#city").append(`<option value="${item.name}" data-id="${item.id}">${item.name}</option>`);
        });
    });
});

$('#city').on('change', function () {
    let id = $(this).find(':selected').data('id');

    $("#district").prop("disabled", false).html('<option>Loading...</option>');

    $.get('/districts/' + id, function(data) {
        $("#district").html('<option value="">-- Pilih Kecamatan --</option>');
        $.each(data, function(i, item) {
            $("#district").append(`<option value="${item.name}">${item.name}</option>`);
        });
    });
});
</script>
