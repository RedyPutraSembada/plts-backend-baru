@extends('layouts.master')

@section('content')
<div class="content">
    <!-- Animated -->
    <div class="animated fadeIn">
        <!--  /Traffic -->
        <div class="clearfix"></div>
        <!-- Orders -->
        <div class="orders">
            <div class="row">
                <div class="col-xl-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="box-title">{{ $judul }}</h4>
                        </div>
                        <div class="card-body">
                            <form method="post" action="{{ route('sewa-kios.store') }}">
                                @csrf
                                <div class="row">
                                    <div class="mb-3 col-lg-12">
                                        <label for="user_id" class="form-label">Pilih Penyewa</label>
                                        <select name="user_id" id="user_id" class="form-control js-example-basic-single @error('user_id') is-invalid @enderror">
                                            <option value="" disabled selected hidden>-- Pilih Penyewa --</option>
                                            @foreach($users as $user)
                                                @if ($user->Login->is_active)
                                                    <option value="{{ $user->id }}">{{ $user->nama_lengkap }}</option>
                                                @else
                                                    <option value="" disabled>Tidak ada user tersedia</option>
                                                @endif
                                            @endforeach
                                        </select>
                                        @error('user_id')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="mb-3 col-lg-12">
                                        <label for="relasi_kios_id" class="form-label">Pilih Kios</label>
                                        <select name="relasi_kios_id" id="relasi_kios_id" class="form-control js-example-basic-single @error('relasi_kios_id') is-invalid @enderror">
                                            <option value="" disabled selected hidden>-- Pilih Kios --</option>
                                            @foreach($relasiDataKios as $kios)
                                                @if ($kios->status_relasi_kios == false)
                                                    <option value="{{ $kios->id }}">{{ $kios->Kios->nama_kios }}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                        @error('relasi_kios_id')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="mb-3 col-lg-12">
                                        <label for="tgl_sewa" class="form-label">Tanggal Sewa</label>
                                        <input type="date" name="tgl_sewa" id="tgl_sewa" class="form-control">
                                        @error('tgl_sewa')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </form>
                        </div>
                    </div> <!-- /.card -->
                </div>  <!-- /.col-lg-8 -->
            </div>
        </div>
        <!-- /.orders -->
    <!-- /#add-category -->
    </div>
    <!-- .animated -->
</div>
@endsection

@push('style')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endpush

@push('script')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.js-example-basic-single').select2();
        });
    </script>
@endpush
