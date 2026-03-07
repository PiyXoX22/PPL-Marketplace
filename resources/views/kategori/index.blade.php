@extends('layouts.app')

@section('content')

<div class="container-fluid">

    <h1 class="h3 mb-4 text-gray-800">Data Kategori</h1>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <a href="{{ route('admin.kategori.create') }}" class="btn btn-primary mb-3">
        + Tambah Kategori
    </a>

    <div class="card shadow">
        <div class="card-body">

            <div class="table-responsive">
                <table class="table table-bordered table-striped">

                    <thead class="thead-dark">
                        <tr>
                            <th>No</th>
                            <th>Kategori</th>
                            <th>Gambar</th>
                            <th width="150px">Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse ($kategori as $k)
                        <tr>

                            <td>{{ $kategori->firstItem() + $loop->index }}</td>

                            <td>{{ $k->kategori }}</td>

                            <td>
                                @if($k->gambar)
                                <img src="{{ asset($k->gambar) }}" width="60">
                                @else
                                Tidak ada
                                @endif
                            </td>

                            <td>

                                <a href="{{ route('admin.kategori.edit', $k->id) }}"
                                   class="btn btn-warning btn-sm">
                                   Edit
                                </a>

                                <form action="{{ route('admin.kategori.destroy', $k->id) }}"
                                      method="POST"
                                      class="d-inline">
                                    @csrf
                                    @method('DELETE')

                                    <button class="btn btn-danger btn-sm"
                                        onclick="return confirm('Yakin ingin menghapus?')">
                                        Hapus
                                    </button>
                                </form>

                            </td>

                        </tr>

                        @empty

                        <tr>
                            <td colspan="4" class="text-center">
                                Belum ada data kategori
                            </td>
                        </tr>

                        @endforelse
                    </tbody>

                </table>

                <div class="mt-3">
                    {{ $kategori->links() }}
                </div>

            </div>

        </div>
    </div>

</div>

@endsection