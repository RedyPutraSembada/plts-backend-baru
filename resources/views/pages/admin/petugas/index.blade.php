@extends('layouts.master')

@section('content')
    <div class="breadcrumbs">
        <div class="breadcrumbs-inner">
            <div class="row m-0">
                <div class="col-sm-4">
                    <div class="page-header float-left">
                        <div class="page-title">
                            <h1>{{ $judul }}</h1>
                        </div>
                    </div>
                </div>
                <div class="col-sm-8">
                    <div class="page-header float-right">
                        <div class="page-title">
                            <ol class="breadcrumb text-right">
                                <li><a href="">Dashboard</a></li>
                                <li class="active">{{ $judul }}</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Content --}}
    <div class="content">
        <div class="animated fadeIn">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <a href="{{ route('master-petugas.create') }}" class="btn btn-primary text-right"
                                style="border-radius: 10px;"><i class="fa-solid fa-square-plus mr-2"></i> Data Petugas</a>
                        </div>
                        <div class="card-body">
                            <table id="bootstrap-data-table" class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th class="serial">#</th>
                                        <th>Nama Lengkap</th>
                                        <th>Jenis Kelamin</th>
                                        <th>Username</th>
                                        <th>Email</th>
                                        <th>NIK</th>
                                        <th>NIP</th>
                                        <th>Alamat</th>
                                        <th>No Handphone</th>
                                        <th>Lokasi</th>
                                        <th>Status User</th>
                                        <th class="text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($banyakPetugas as $petugas)
                                        <tr>
                                            <td class="serial">{{ $loop->iteration }}</td>
                                            <td>{{ $petugas->nama_lengkap }}</td>
                                            <td>{{ $petugas->jenis_kelamin }}</td>
                                            <td>{{ $petugas->Login->username }}</td>
                                            <td>{{ $petugas->Login->email }}</td>
                                            <td>{{ $petugas->nik }}</td>
                                            <td>{{ $petugas->nip }}</td>
                                            <td>{{ $petugas->alamat }}</td>
                                            <td>{{ $petugas->no_hp }}</td>
                                            <td>{{ $petugas->Lokasi->nama_lokasi }}</td>
                                            <td class="text-center">
                                                @if ($petugas->Login->is_active)
                                                    <form action="{{ route('petugas-isActive', $petugas->id) }}"
                                                        method="post">
                                                        @csrf
                                                        <button class="btn btn-success mb-2"
                                                            style="border-radius: 10px;">Aktif</button>
                                                    </form>
                                                @else
                                                    <form action="{{ route('petugas-isActive', $petugas->id) }}"
                                                        method="post">
                                                        @csrf
                                                        <button class="btn btn-danger mb-2"
                                                            style="border-radius: 10px;">Tidak Aktif</button>
                                                    </form>
                                                @endif
                                            </td>
                                            <td class="text-center">
                                                <a href="{{ route('master-petugas.edit', $petugas->id) }}"
                                                    class="btn-sm badge-warning"
                                                    style="font-size: 14px; border-radius:10px;"><i
                                                        class="fa fa-edit"></i></a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{-- akhir Content --}}
    </div>
@endsection
