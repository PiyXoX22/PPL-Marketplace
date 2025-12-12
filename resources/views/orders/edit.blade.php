<x-adminlayout>

    <div class="card p-4">
        <h2>Edit Order #{{ $order->id }}</h2>

        <form action="{{ route('admin.orders.update', $order->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label>Status Order</label>
                <select name="status" class="form-control">
                    @foreach ($statuses as $status)
                        <option value="{{ $status }}" {{ $order->status == $status ? 'selected' : '' }}>
                            {{ strtoupper($status) }}
                        </option>
                    @endforeach
                </select>
            </div>

            <button class="btn btn-dark">Simpan</button>
        </form>

    </div>

    </x-adminlayout>
