@extends('admin.master')

@section('content')
<section class="section">
    <div class="section-header">
        <h1>Informasi Pengguna</h1>
    </div>
    <div class="section-body">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-9">
                                                <table class="table table-striped table-sm table-bordered mb-5">
                                                    <tbody>
                                                        <tr>
                                                            <th scope="row">Nomor Induk Pegawai</th>
                                                            <td colspan="5" id="nama_wp" style="width: 70%;">
                                                                {{ $administrator->nip }}</td>
                                                        </tr>
                                                        <tr>
                                                            <th scope="row">Email</th>
                                                            <td colspan="5" id="alamat_wp">{{ $administrator->email }}</td>
                                                        </tr>
                                                        <tr>
                                                            <th scope="row">Nama Lengkap</th>
                                                            <td colspan="5" id="nama_wp" style="width: 70%;">
                                                                {{ $administrator->fullname }}</td>
                                                        </tr>
                                                        <tr>
                                                            <th scope="row">Tempat / Tanggal Lahir</th>
                                                            <td colspan="5" id="nama_wp" style="width: 70%;">
                                                                {{ $administrator->pob }}, {{ $administrator->dob }}</td>
                                                        </tr>
                                                        <tr>
                                                            <th scope="row">Jenis Kelamin</th>
                                                            <td colspan="5" id="alamat_wp">
                                                                @if ($administrator->gender == 'L')
                                                                    <div class="badge badge-primary">Male</div>
                                                                @else
                                                                    <div class="badge badge-primary" style="background-color: palevioletred">Female</div>
                                                                @endif
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <th scope="row">Alamat</th>
                                                            <td colspan="5" id="alamat_wp">{{ $administrator->address }}</td>
                                                        </tr>
                                                        <tr>
                                                            <th scope="row">Nomor Telepon</th>
                                                            <td colspan="5" id="alamat_wp">{{ $administrator->phone }}</td>
                                                        </tr>
                                                        <tr>
                                                            <th scope="row">Status Pengguna</th>
                                                            <td colspan="5" id="alamat_wp">
                                                                @if ($status == 'active')
                                                                    <div class="badge badge-success">Aktif</div>
                                                                @elseif ($status == 'nonactive')
                                                                    <div class="badge badge-warning">Tidak Aktif</div>
                                                                @elseif ($status == 'unregistered')
                                                                    <div class="badge badge-danger">Belum Aktivasi</div>
                                                                @endif
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                                @if ($status == 'unregistered')                                                
                                                    <form action="#" method="POST" enctype="multipart/form-data">
                                                        @csrf
                                                        <input type="hidden" class="form-control" value="register" name="condition">
                                                        <input type="hidden" class="form-control" value="{{ $administrator->fullname }}" name="name">
                                                        <input type="hidden" class="form-control" value="{{ $administrator->email }}" name="email">
                                                        <input type="hidden" class="form-control" value="{{ $administrator->nip }}" name="password">
                                                        <input type="hidden" class="form-control" value="admin" name="role">
                                                        <input type="hidden" class="form-control" value="active" name="status">
                                                        <div style="text-align: right">
                                                            <button type="submit" class="btn btn-icon icon-left btn-success">
                                                                <i class="fa fa-check"></i>
                                                                Aktivasi Akun
                                                            </button>
                                                        </div>
                                                    </form>
                                                @elseif ($status == 'active')
                                                    <form action="#" method="POST" enctype="multipart/form-data">
                                                        @csrf
                                                        <input type="hidden" class="form-control" value="{{ $administrator->email }}" name="email">
                                                        <input type="hidden" class="form-control" value="nonactive" name="status">
                                                        <div style="text-align: right">
                                                            <button type="submit" href="{{ route('admin-data.index') }}" class="btn btn-icon icon-left btn-danger">
                                                                <i class="fa fa-exclamation"></i>
                                                                Deactivate Account
                                                            </button>
                                                        </div>
                                                    </form>
                                                @elseif ($status == 'nonactive')
                                                    <form action="#" method="POST" enctype="multipart/form-data">
                                                        @csrf
                                                        <input type="hidden" class="form-control" value="{{ $administrator->fullname }}" name="name">
                                                        <input type="hidden" class="form-control" value="{{ $administrator->nip }}" name="password">
                                                        <input type="hidden" class="form-control" value="admin" name="role">
                                                        <input type="hidden" class="form-control" value="reactivate" name="condition">
                                                        <input type="hidden" class="form-control" value="{{ $administrator->email }}" name="email">
                                                        <input type="hidden" class="form-control" value="active" name="status">
                                                        <div style="text-align: right">
                                                            <button type="submit" href="{{ route('admin-data.index') }}" class="btn btn-icon icon-left btn-success">
                                                                <i class="fa fa-check"></i>
                                                                Activate Account
                                                            </button>
                                                        </div>
                                                    </form>
                                                @endif
                                                
                                            </div>
                                            <div class="col-3">
                                                <div class="card">
                                                    <div class="card-body">
                                                        <img src="{{ $administrator->photo }}" alt="Foto Admin" style="width: 100%">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection