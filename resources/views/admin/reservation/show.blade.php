@extends('admin.master')
@section('content')
<section class="section">
    <div class="section-header">
        <h1>Reservasi Siswa</h1>
    </div>
    <div class="section-body">
        <div class="row">
            <div class="col-3">
                <div class="card">
                    <div class="card-body">
                        <img src="{{ $studentDetail->photo }}" alt="Foto siswa" style="width: 100%">
                    </div>
                </div>
            </div>
            <div class="col-9">
                <div class="card">
                    <div class="card-body">
                        <strong>
                            <h4>Informasi Siswa</h4>
                        </strong>
                        <table class="table table-striped table-sm table-bordered mb-5">
                            <tbody>
                                <tr>
                                    <th scope="row">NISN / Email</th>
                                    <td colspan="5" id="nama_wp" style="width: 70%;">{{$studentDetail->nisn}} / {{$studentDetail->email}}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Kelas</th>
                                    <td colspan="5" id="nama_wp" style="width: 70%;">{{$studentDetail->class}}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Nama Lengkap</th>
                                    <td colspan="5" id="nama_wp" style="width: 70%;">{{$studentDetail->fullname}}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Tempat / Tanggal Lahir</th>
                                    <td colspan="5" id="nama_wp" style="width: 70%;">{{$studentDetail->pob}}, {{$studentDetail->dob}}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Jenis Kelamin</th>
                                    <td colspan="5" id="alamat_wp">
                                        @if ($studentDetail->gender == 'L')
                                            <div class="badge badge-primary">Laki-laki</div>
                                        @else
                                            <div class="badge badge-primary" style="background-color: palevioletred">Perempuan</div>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row">Alamat</th>
                                    <td colspan="5" id="alamat_wp">{{$studentDetail->address}}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Nomor Telepon</th>
                                    <td colspan="5" id="alamat_wp">{{$studentDetail->phone}}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th style="text-align: center">Kode ISBN</th>
                                        <th style="text-align: center">Tanggal Reservasi</th>
                                        <th style="text-align: center">Durasi Peminjaman</th>
                                        <th style="text-align: center">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($detailReservation as $val)
                                    <tr>
                                        <td style="text-align: center">
                                            <a href="{{route('admin.catalog.show', $val->id)}}">{{ $val->catalog->isbn }}</a>
                                        </td>
                                        <td style="text-align: center">
                                            {{ $val->created_at }}
                                        </td>
                                        <td style="text-align: center">
                                            {{ $val->duration }} Minggu
                                        </td>
                                        <td style="text-align: center">
                                            <div class="d-inline-block">
                                                <form action="{{route('admin.reservation.detail')}}" method="get">
                                                    @csrf
                                                    <input type="hidden" name="catalog_id" value="{{$val->catalog_id}}">
                                                    <input type="hidden" name="reservation_id" value="{{$val->id}}">
                                                    <button type="submit" class="btn-sm btn-icon icon-center btn-primary">
                                                        <i class="fas fa-search text-white"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <div style="text-align: right">
                                <a href="#" class="btn btn-icon icon-left btn-success">
                                    <i class="fa fa-save"></i>
                                    Simpan
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
