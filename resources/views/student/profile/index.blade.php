@extends('master')

@section('content')

    @if (auth()->user()->role == 'superadmin' || auth()->user()->role == 'admin')
        <section class="section">
            <div class="section-header">
                <h1>User Information</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item">Users</div>
                    <div class="breadcrumb-item active"><a href="{{ route('student.index') }}">Student</a></div>
                    <div class="breadcrumb-item">Detail</div>
                </div>
            </div>
            <div class="section-body">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-9">
                                        <table class="table table-striped table-sm table-bordered mb-5">
                                                <tbody>
                                                    <tr>
                                                        <th scope="row">NISN / Email</th>
                                                        <td colspan="5" id="nama_wp" style="width: 70%;">
                                                            {{ $student->nisn }} / {{ $student->email }}</td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row">Class</th>
                                                        <td colspan="5" id="alamat_wp">{{ $student->class }}</td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row">Name</th>
                                                        <td colspan="5" id="nama_wp" style="width: 70%;">
                                                            {{ $student->fullname }}</td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row">Place / Date of Birth</th>
                                                        <td colspan="5" id="nama_wp" style="width: 70%;">
                                                            {{ $student->pob }}, {{ $student->dob }}</td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row">Gender</th>
                                                        <td colspan="5" id="alamat_wp">
                                                            @if ($student->gender == 'L')
                                                                <div class="badge badge-primary">Male</div>
                                                            @else
                                                                <div class="badge badge-primary"
                                                                    style="background-color: palevioletred">Female</div>
                                                            @endif
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row">Address</th>
                                                        <td colspan="5" id="alamat_wp">{{ $student->address }}</td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row">Phone Number</th>
                                                        <td colspan="5" id="alamat_wp">{{ $student->phone }}</td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row">Status</th>
                                                        <td colspan="5" id="alamat_wp">
                                                            @if ($status == 'active')
                                                                <div class="badge badge-success">Active</div>
                                                            @elseif ($status == 'nonactive')
                                                                <div class="badge badge-warning">Inactive</div>
                                                            @elseif ($status == 'unregistered')
                                                                <div class="badge badge-danger">Not Registered</div>
                                                            @endif
                                                        </td>
                                                    </tr>
                                                </tbody>
                                        </table>
                                        @if ($status == 'unregistered')
                                            <form action="{{ route('student-activation') }}" method="POST" enctype="multipart/form-data">
                                                @csrf
                                                <input type="hidden" class="form-control" value="register" name="condition">
                                                <input type="hidden" class="form-control" value="{{ $student->fullname }}" name="name">
                                                <input type="hidden" class="form-control" value="{{ $student->email }}" name="email">
                                                <input type="hidden" class="form-control" value="{{ $student->nisn }}" name="password">
                                                <input type="hidden" class="form-control" value="student" name="role">
                                                <input type="hidden" class="form-control" value="active" name="status">
                                                <div style="text-align: right">
                                                    <button type="submit" class="btn btn-icon icon-left btn-success">
                                                        <i class="fa fa-check"></i>
                                                        Activate Account
                                                    </button>
                                                </div>
                                            </form>
                                        @elseif ($status == 'active')
                                            <form action="{{ route('student-deactivation') }}" method="POST" enctype="multipart/form-data">
                                                @csrf
                                                    <input type="hidden" class="form-control" value="{{ $student->email }}" name="email">
                                                <div style="text-align: right">
                                                    <button type="submit" href="{{ route('student.index') }}" class="btn btn-icon icon-left btn-danger">
                                                        <i class="fa fa-exclamation"></i>
                                                        Deactivate Account
                                                    </button>
                                                </div>
                                            </form>
                                        @elseif ($status == 'nonactive')
                                            <form action="{{ route('student-activation') }}" method="POST" enctype="multipart/form-data">
                                                @csrf
                                                <input type="hidden" class="form-control" value="reactivate" name="condition">
                                                <input type="hidden" class="form-control" value="{{ $student->fullname }}" name="name">
                                                <input type="hidden" class="form-control" value="{{ $student->email }}" name="email">
                                                <input type="hidden" class="form-control" value="{{ $student->nisn }}" name="password">
                                                <input type="hidden" class="form-control" value="student" name="role">
                                                <input type="hidden" class="form-control" value="active" name="status">
                                                <div style="text-align: right">
                                                    <button type="submit" href="{{ route('student.index') }}" class="btn btn-icon icon-left btn-success">
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
                                                <img src="{{ $student->photo }}" alt="Foto siswa" style="width: 100%">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="table-responsive">
                                    <strong>
                                        <h4>Reservation History</h4>
                                    </strong>
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th style="text-align: center">Serial Number</th>
                                                <th style="text-align: center">Start Date</th>
                                                <th style="text-align: center">Due Date</th>
                                                <th style="text-align: center">Author</th>
                                                <th style="text-align: center">Status</th>
                                                <th style="text-align: center">Info</th>
                                                <th style="text-align: center">Menu</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($reserved as $item)
                                            <tr>
                                                <td style="text-align: center">
                                                    <a href="{{ route('catalog.index') }}">{{$item->serial->serial_number}}</a>
                                                </td>
                                                <td style="text-align: center">{{$item->start_date}}</td>
                                                <td style="text-align: center">{{$item->due_date}}</td>
                                                <td style="text-align: center">{{$item->verifier}}</td>
                                                <td style="text-align: center">
                                                    <div class="badge badge-warning">{{$item->rsv_status}}</div>
                                                </td>
                                                {{-- <td style="text-align: center">
                                                    <a href="{{ route('catalog.index') }}" class="btn btn-primary">Send
                                                        Reminder</a>
                                                </td> --}}
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                {{-- <strong>
                                    <h4>Riwayat Tagihan</h4>
                                </strong>
                                <div class="table-responsive">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th style="text-align: center">Nomor Seri</th>
                                                <th style="text-align: center">Keterangan</th>
                                                <th style="text-align: center">Tagihan</th>
                                                <th style="text-align: center">Status</th>
                                                <th style="text-align: center">Menu</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td style="text-align: center">
                                                    <a href="{{ route('catalog.index') }}">337123091</a>
                                                </td>
                                                <td style="text-align: center">Denda Jatuh Tempo</td>
                                                <td style="text-align: right">Rp. 15.000,00</td>
                                                <td style="text-align: center">
                                                    <div class="badge badge-danger">Belum Lunas</div>
                                                </td>
                                                <td style="text-align: center">
                                                    <a href="{{ route('catalog.index') }}" class="btn btn-primary">Send
                                                        Reminder</a>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div> --}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    @elseif (auth()->user()->role == 'student')
        <section class="section">
            <div class="section-header">
                <h1>Data Siswa</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="#"
                            onclick="loadPage('dashboard.php')">Dashboard</a>
                    </div>
                    <div class="breadcrumb-item">Status NOP</div>
                </div>
            </div>
            <div class="section-body">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-9">
                                        <table class="table table-striped table-sm table-bordered">
                                            <tbody>
                                                @foreach ($student as $val)
                                                    <tr>
                                                        <th scope="row">NISN</th>
                                                        <td colspan="5" id="nama_wp" style="width: 70%;">
                                                            {{ $val->nisn }}</td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row">Kelas</th>
                                                        <td colspan="5" id="nama_wp" style="width: 70%;">
                                                            {{ $val->class }}</td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row">Nama Lengkap</th>
                                                        <td colspan="5" id="nama_wp" style="width: 70%;">
                                                            {{ $val->fullname }}</td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row">Tempat / Tanggal Lahir</th>
                                                        <td colspan="5" id="nama_wp" style="width: 70%;">
                                                            {{ $val->pob }}, {{ $val->dob }}</td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row">Jenis Kelamin</th>
                                                        <td colspan="5" id="alamat_wp">
                                                            @if ($val->gender == 'L')
                                                                <div class="badge badge-primary">Laki-laki</div>
                                                            @else
                                                                <div class="badge badge-primary"
                                                                    style="background-color: palevioletred">Perempuan</div>
                                                            @endif

                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row">Alamat Siswa</th>
                                                        <td colspan="5" id="alamat_wp">{{ $val->address }}</td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row">Nomor Telepon Siswa</th>
                                                        <td colspan="5" id="alamat_wp">{{ $val->phone }}</td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row">Total Tagihan</th>
                                                        <td colspan="5" id="alamat_wp">
                                                            Rp. 180.000,00 &nbsp;
                                                            <div class="badge badge-warning">Tagihan Belum Lunas</div>
                                                            <div class="badge badge-danger">Buku Belum Dikembalikan</div>
                                                            <div class="badge badge-success">Bebas Tanggungan</div>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                        <form action="#" method="" enctype="multipart/form-data">
                                            <input type="hidden" class="form-control" id="title" value=""
                                                name="title">
                                            <div style="text-align: right; margin-bottom:20px;">
                                                <a href="#" class="btn btn-icon icon-left btn-success">
                                                    <i class="fa fa-print"></i>
                                                    Cetak Surat Bebas Tanggungan
                                                </a>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="col-3">
                                        <div class="card">
                                            <div class="card-body">
                                                @foreach ($student as $val)
                                                    <img src="{{ $val->photo }}" alt="foto siswa"
                                                        style="width: 100%;">
                                                @endforeach
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
    @endif

@endsection
