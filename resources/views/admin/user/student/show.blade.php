@extends('admin.master')

@section('content')

        <section class="section">
            <div class="section-header">
                <h1>Data Siswa</h1>
            </div>
            <div class="section-body">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-3">
                                        <div class="card">
                                            <img src="{{ $student->photo }}" alt="Foto siswa" style="width: 100%">
                                        </div>
                                    </div>
                                    <div class="col-9">
                                        <table class="table table-striped table-sm table-bordered mb-5">
                                            <tbody>
                                                <tr>
                                                    <th scope="row">NISN / Email</th>
                                                    <td colspan="5" id="nama_wp" style="width: 70%;">
                                                        {{ $student->nisn }} / {{ $student->email }}</td>
                                                </tr>
                                                <tr>
                                                    <th scope="row">Kelas</th>
                                                    <td colspan="5" id="alamat_wp">{{ $student->class }}</td>
                                                </tr>
                                                <tr>
                                                    <th scope="row">Nama Lengkap</th>
                                                    <td colspan="5" id="nama_wp" style="width: 70%;">
                                                        {{ $student->fullname }}</td>
                                                </tr>
                                                <tr>
                                                    <th scope="row">Tempat / Tanggal Lahir</th>
                                                    <td colspan="5" id="nama_wp" style="width: 70%;">
                                                        {{ $student->pob }}, {{ $student->dob }}</td>
                                                </tr>
                                                <tr>
                                                    <th scope="row">Jenis Kelamin</th>
                                                    <td colspan="5" id="alamat_wp">
                                                        @if ($student->gender == 'L')
                                                            <div class="badge badge-primary">Laki-laki</div>
                                                        @else
                                                            <div class="badge badge-primary"
                                                                style="background-color: palevioletred">Perempuan</div>
                                                        @endif
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th scope="row">Alamat</th>
                                                    <td colspan="5" id="alamat_wp">{{ $student->address }}</td>
                                                </tr>
                                                <tr>
                                                    <th scope="row">Nomor Telepon</th>
                                                    <td colspan="5" id="alamat_wp" style="display: flex; justify-content: space-between; align-items: center;">
                                                        <div>
                                                            {{ $student->phone }}
                                                        </div>
                                                        <div>
                                                            <a href="http://wa.me/{{$student->phone}}" style="display: flex; align-items: center;">
                                                                <i class="fab fa-whatsapp" style="margin-right: 5px;"></i>
                                                                Hubungi
                                                            </a>
                                                        </div>
                                                    </td>                                                    
                                                </tr>
                                                <tr>
                                                    <th scope="row">Status Siswa</th>
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
                                            <form action="{{ route('user.student.activation') }}" method="POST" enctype="multipart/form-data">
                                                @csrf
                                                <input type="hidden" class="form-control" value="activation" name="condition">
                                                <input type="hidden" class="form-control" value="{{ $student->fullname }}" name="name">
                                                <input type="hidden" class="form-control" value="{{ $student->email }}" name="email">
                                                <input type="hidden" class="form-control" value="{{ $student->nisn }}" name="password">
                                                <div style="text-align: right">
                                                    <button type="submit" class="btn btn-icon icon-left btn-success">
                                                        <i class="fa fa-check"></i>
                                                        Aktivasi Akun
                                                    </button>
                                                </div>
                                            </form>
                                        @elseif ($status->status == 'active')
                                            <form action="{{ route('user.student.activation') }}" method="POST" enctype="multipart/form-data">
                                                @csrf
                                                <input type="hidden" class="form-control" value="deactivate" name="condition">
                                                <input type="hidden" class="form-control" value="{{ $student->email }}" name="email">
                                                <div style="text-align: right">
                                                    <button type="submit" class="btn btn-icon icon-left btn-danger">
                                                        <i class="fa fa-exclamation mr-2"></i>
                                                        Nonaktifkan Akun
                                                    </button>
                                                </div>
                                            </form>
                                        @elseif ($status->status == 'nonactive')
                                            <form action="{{ route('user.student.activation') }}" method="POST" enctype="multipart/form-data">
                                                @csrf
                                                <input type="hidden" class="form-control" value="reactivate" name="condition">
                                                <input type="hidden" class="form-control" value="{{ $student->email }}" name="email">
                                                <div style="text-align: right">
                                                    <button type="submit" class="btn btn-icon icon-left btn-success">
                                                        <i class="fa fa-check"></i>
                                                        Aktifkan Kembali
                                                    </button>
                                                </div>
                                            </form>
                                        @endif
                                    </div>
                                </div>
                                <div class="table-responsive">
                                    <strong>
                                        <h4>Riwayat Peminjaman Buku</h4>
                                    </strong>
                                    <table class="table table-striped" id="table-1">
                                        <thead>
                                            <tr>
                                                <th class="text-center">Nomor Registrasi</th>
                                                <th class="text-center">Judul</th>
                                                <th class="text-center">Tanggal Peminjaman</th>
                                                <th class="text-center">Status Peminjaman</th>
                                                <th class="text-center">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($reserved as $val)
                                            <tr>
                                                <td class="text-center">
                                                    <a href="#">{{$val->serial->registration_number}}</a>
                                                </td>
                                                <td class="text-left">{{$val->serial->catalog->title}}</td>
                                                <td style="text-align: center">{{$val->start_date}}</td>
                                                <td style="text-align: center">
                                                    @if ($val->rsv_status == 'finished')
                                                    <div class="badge badge-success">Selesai</div>    
                                                    @else
                                                    <div class="badge badge-primary">Berjalan</div>    
                                                    @endif
                                                </td>
                                                <td style="text-align: center">
                                                    <div class="d-inline-block">
                                                        <form action="#" method="get">
                                                            @csrf
                                                            <button type="submit" class="btn-sm btn-icon icon-center btn-primary">
                                                                <i class="fas fa-search text-white icon-center"></i>
                                                            </button>
                                                        </form>
                                                    </div>
                                                    <div class="d-inline-block">
                                                        <form action="#" method="get">
                                                            @csrf
                                                            <button type="submit" class="btn-sm btn-icon icon-center bg-light">
                                                                <i class="fas fa-bell text-primary icon-center"></i>
                                                            </button>
                                                        </form>
                                                    </div> 
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                <strong>
                                    <h4>Riwayat Tagihan</h4>
                                </strong>
                                <div class="table-responsive">
                                    <table class="table table-striped" id="table-1">
                                        <thead>
                                            <tr>
                                                <th style="text-align: center">Nomor Registrasi</th>
                                                <th style="text-align: center">Judul</th>
                                                <th style="text-align: center">Keterangan</th>
                                                <th style="text-align: center">Total Tagihan</th>
                                                <th style="text-align: center">Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td style="text-align: center">
                                                    <a href="#">337123091</a>
                                                </td>
                                                <td style="text-align: center">Denda Jatuh Tempo</td>
                                                <td style="text-align: right">Rp. 15.000,00</td>
                                                <td style="text-align: center">
                                                    <div class="badge badge-danger">Belum Lunas</div>
                                                </td>
                                                <td style="text-align: center">
                                                    <a href="#" class="btn btn-primary">Send
                                                        Reminder</a>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
@endsection
