<style>
.profile-container {
    display: flex;
    padding: 20px;
    background: #f7f7f7;
    min-height: 80vh;
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
    text-decoration: none;
    color: #000;
    font-weight: bold;
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
.form-group {
    margin-bottom: 15px;
}
label {
    display: block;
    font-weight: bold;
    margin-bottom: 5px;
}
input[type="text"], select {
    width: 100%;
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 4px;
}
.btn-submit {
    padding: 10px 20px;
    background: #222;
    color: #fff;
    border: none;
    border-radius: 4px;
    margin-top: 10px;
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
</style>

<div class="profile-container">
    {{-- Sidebar --}}
    <div class="sidebar">
        <a href="{{ auth()->user()->role_id == 1 ? route('admin.profile.index') : route('profile.index') }}"
            class="active">
             PROFILE
         </a>
         <a href="{{ auth()->user()->role_id == 1 ? route('admin.profile.address.index') : route('profile.address.index') }}"
            class="active">
             ADDRESSES
         </a>
        <a href="#">ORDERS</a>
        <a href="{{ route('logout') }}">LOGOUT</a>
    </div>

    {{-- Content --}}
    <div class="content">
        <h2>My Addresses</h2>

        @if(session('success'))
            <div style="color:green; margin-bottom:10px;">{{ session('success') }}</div>
        @endif

        <form action="{{ route('profile.address.store') }}" method="POST">
            @csrf
            <div class="row">
                <div class="col">
                    <div class="form-group">
                        <label>Address Title</label>
                        <input type="text" name="address_title">
                    </div>
                    <div class="form-group">
                        <label>First Name</label>
                        <input type="text" name="first_name">
                    </div>
                    <div class="form-group">
                        <label>Last Name</label>
                        <input type="text" name="last_name">
                    </div>
                    <div class="form-group">
                        <label>Phone</label>
                        <input type="text" name="phone">
                    </div>
                </div>

                <div class="col">
                    <div class="form-group">
                        <label>Address</label>
                        <input type="text" name="address">
                    </div>
                    {{-- <div class="form-group">
                        <label>Country</label>
                        <select name="country_id">
                            @foreach(\App\Models\Country::all() as $country)
                                <option value="{{ $country->id }}">{{ $country->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label>State</label>
                        <select name="state_id">
                            <option value="">-- Select State --</option>
                            @foreach(\App\Models\State::all() as $state)
                                <option value="{{ $state->id }}">{{ $state->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label>City</label>
                        <select name="city_id">
                            @foreach(\App\Models\City::all() as $city)
                                <option value="{{ $city->id }}">{{ $city->name }}</option>
                            @endforeach
                        </select>
                    </div> --}}
                    <div class="form-group">
                        <label>Zip Code</label>
                        <input type="text" name="zip_code">
                    </div>
                </div>
            </div>

            <button class="btn-submit">Add Address</button>
        </form>

        {{-- List Addresses --}}
        <table class="table-address">
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Name</th>
                    <th>Phone</th>
                    <th>Address</th>
                    <th>City</th>
                    <th>State</th>
                    <th>Country</th>
                    <th>Zip</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($addresses as $address)
                <tr>
                    <td>{{ $address->address_title }}</td>
                    <td>{{ $address->first_name }} {{ $address->last_name }}</td>
                    <td>{{ $address->phone }}</td>
                    <td>{{ $address->address }}</td>
                    <td>{{ $address->city->name ?? '-' }}</td>
                    <td>{{ $address->state->name ?? '-' }}</td>
                    <td>{{ $address->country->name ?? '-' }}</td>
                    <td>{{ $address->zip_code }}</td>
                    <td>
                        <form action="{{ route('profile.address.destroy', $address->id) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button class="btn-submit" onclick="return confirm('Delete this address?')" style="background:#FF0000;">Delete</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

    </div>
</div>


