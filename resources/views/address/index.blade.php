@extends('layouts.app')

@section('content')
<div class="container">
    <h1>My Addresses</h1>

    <a href="{{ route('address.create') }}" class="btn btn-primary mb-3">Add New Address</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
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
                    <a href="{{ route('address.edit', $address->id) }}" class="btn btn-sm btn-warning">Edit</a>
                    <form action="{{ route('address.destroy', $address->id) }}" method="POST" style="display:inline-block;">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-sm btn-danger" onclick="return confirm('Delete this address?')">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
