<x-adminlayout>

    <div class="card p-4">
        <h2 class="mb-3">Order List</h2>

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>User</th>
                    <th>Total</th>
                    <th>Status</th>
                    <th>Tanggal</th>
                    <th>Aksi</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($orders as $o)
                    <tr>
                        <td>{{ $o->id }}</td>
                        <td>{{ $o->user->name ?? '-' }}</td>
                        <td>Rp {{ number_format($o->total,0,',','.') }}</td>
                        <td>
                            <span class="badge bg-dark">{{ strtoupper($o->status) }}</span>
                        </td>
                        <td>{{ $o->created_at->format('d-m-Y') }}</td>
                        <td>
                            <a href="{{ route('admin.orders.show', $o->id) }}" class="btn btn-primary btn-sm">Detail</a>
                            <a href="{{ route('admin.orders.edit', $o->id) }}" class="btn btn-warning btn-sm">Edit</a>
                            <form action="{{ route('admin.orders.destroy', $o->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger btn-sm"
                                    onclick="return confirm('Hapus order ini?')">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>

        </table>

        {{ $orders->links() }}
    </div>

    </x-adminlayout>
