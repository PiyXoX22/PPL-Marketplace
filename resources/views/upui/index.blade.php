@extends('layouts.app')

@section('content')

<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 text-gray-800">Data Banner</h1>

        <a href="{{ route('admin.upui.create') }}"
           class="btn btn-primary shadow-sm">
            <i class="fas fa-plus fa-sm"></i> Tambah Banner
        </a>
    </div>


    <!-- Card -->
    <div class="card shadow mb-4">

        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">
                List Banner
            </h6>
        </div>


        <div class="card-body">

            <div class="table-responsive">

                <table class="table table-bordered table-hover align-middle">

                    <thead class="thead-dark">
                        <tr>
                            <th width="60">ID</th>
                            <th>Judul</th>
                            <th>Subjudul</th>
                            <th width="150">Gambar</th>
                            <th width="160">Aksi</th>
                        </tr>
                    </thead>

                    <tbody>

                    @forelse($banner as $b)

                        <tr>

                            <!-- ID -->
                            <td>
                                <span class="badge badge-secondary">
                                    {{ $loop->iteration }}
                                </span>
                            </td>


                            <!-- JUDUL -->
                            <td class="font-weight-bold">
                                {{ $b->judul }}
                            </td>


                            <!-- SUBJUDUL -->
                            <td>
                                {{ $b->subjudul }}
                            </td>


                            <!-- GAMBAR -->
                            <td>
                                <img src="{{ asset($b->gambar) }}"
                                     width="100"
                                     class="img-thumbnail">
                            </td>


                            <!-- ACTION -->
                            <td>

                                <a href="{{ route('admin.upui.edit',$b->id) }}"
                                   class="btn btn-warning btn-sm">

                                    <i class="fas fa-edit"></i>

                                </a>

                                <form action="{{ route('admin.upui.destroy',$b->id) }}"
                                      method="POST"
                                      class="d-inline">

                                    @csrf
                                    @method('DELETE')

                                    <button class="btn btn-danger btn-sm"
                                        onclick="return confirm('Hapus banner ini?')">

                                        <i class="fas fa-trash"></i>

                                    </button>

                                </form>

                            </td>

                        </tr>

                    @empty

                        <tr>
                            <td colspan="5" class="text-center text-muted">
                                Belum ada data banner
                            </td>
                        </tr>

                    @endforelse

                    </tbody>

                </table>

            </div>

        </div>

    </div>

</div>

@endsection