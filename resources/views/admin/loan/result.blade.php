@extends('admin.master')

@section('content')
<section class="section">
    <div class="section-header">
        <h1>Halaman Peminjaman Buku</h1>
    </div>
    <div class="section-body">
        <!-- Student Information Section -->
        <div class="row">
            <div class="col-3">
                <div class="card">
                    <div class="card-body">
                        <img src="{{ $student->photo }}" alt="Foto siswa" style="width: 100%">
                    </div>
                </div>
            </div>
            <div class="col-9">
                <div class="card">
                    <div class="card-body">
                        <strong><h4>Informasi Siswa</h4></strong>
                        <table class="table table-striped table-sm table-bordered mb-5">
                            <tbody>
                                <tr>
                                    <th scope="row">NISN / Email</th>
                                    <td colspan="5">{{ $student->nisn }} / {{ $student->email }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Kelas</th>
                                    <td colspan="5">{{ $student->class }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Nama Lengkap</th>
                                    <td colspan="5">{{ $student->fullname }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Tempat / Tanggal Lahir</th>
                                    <td colspan="5">{{ $student->pob }}, {{ $student->dob }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Jenis Kelamin</th>
                                    <td colspan="5">
                                        <div class="badge badge-primary">
                                            {{ $student->gender == 'L' ? 'Laki-laki' : 'Perempuan' }}
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row">Alamat</th>
                                    <td colspan="5">{{ $student->address }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Nomor Telepon</th>
                                    <td colspan="5">{{ $student->phone }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- Reserved Books Section -->
        @if ($rsvcount != null)
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th style="text-align: center">Kategori</th>
                                        <th style="text-align: center">Nomor Registrasi</th>
                                        <th style="text-align: center">Tanggal Peminjaman</th>
                                        <th style="text-align: center">Jatuh Tempo</th>
                                        <th style="text-align: center">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($reserved as $val)
                                    <tr>
                                        <td class="text-center">
                                            <a href="#">{{ $val->serial->registration_number }}</a>
                                        </td>
                                        <td class="text-left">
                                            {{ $val->serial->catalog->title }}
                                        </td>
                                        <td class="text-center">{{ $val->start_date }}</td>
                                        <td class="text-center">{{ $val->due_date }}</td>
                                        <td class="text-center">
                                            <form action="{{ route('admin.loan.cancel') }}" method="POST">
                                                @csrf
                                                <input type="hidden" name="serial_id" value="{{ $val->serial->id }}">
                                                <input type="hidden" name="reserved_id" value="{{ $val->id }}">
                                                <button type="submit" class="btn btn-icon icon-left btn-danger">
                                                    <i class="fa fa-times-circle"></i> Batalkan
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <div style="text-align: right">
                                <a href="{{ route('admin.loan.submit') }}" class="btn btn-icon icon-left btn-success">
                                    <i class="fa fa-save"></i> Simpan
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endif

        <!-- Serial Number Search Section -->
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="empty-state" data-height="400">
                            <div class="empty-state-icon">
                                <i class="fas fa-search"></i>
                            </div>
                            <h2>Masukkan Nomor Registrasi Buku</h2>
                            <p class="lead">
                                <form action="{{ route('admin.loan.result-catalog') }}" method="post" class="form-inline mb-4">
                                    @csrf
                                    <div class="input-group mb-2" style="width: 100%;">
                                        <div class="form-inline" style="display: block">
                                            <input type="number" name="book_registration" class="form-control" placeholder="Masukkan nomor registrasi buku" style="width: 300px;">
                                        </div>
                                        <div class="form-inline ml-2">
                                            <button type="submit" class="btn btn-icon icon-left btn-primary">
                                                <i class="fa fa-search"></i> Cari Buku
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Book Details Section -->
        @if ($catalog != null)
        <div class="row">
            <div class="col-4">
                <div class="card">
                    <div class="card-body">
                        <img src="{{ $catalog->cover }}" alt="cover buku" style="width: 100%">
                    </div>
                </div>
            </div>
            <div class="col-8">
                <div class="card">
                    <div class="card-body">
                        <table class="table table-striped table-sm table-bordered">
                            <tbody>
                                <tr>
                                    <th scope="row">Kategori</th>
                                    <td colspan="5" id="alamat_op" style="width: 70%;">
                                        <a href="#">
                                            {{ $catalog->category->code }} - {{ $catalog->category->name }}
                                        </a>
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row">Klasifikasi Buku</th>
                                    <td colspan="5" id="alamat_op" style="width: 70%;">
                                        @if ($catalog->classification_id == 1 || $catalog->classification_id == 2 || $catalog->classification_id == 3)
                                        Kelas {{$catalog->classification->name}}
                                        @elseif ($catalog->classification_id == 4)
                                        {{$catalog->classification->name}}
                                        @elseif ($catalog->classification_id == 5)
                                        Pegangan {{$catalog->classification->name}}
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row">Kode ISBN</th>
                                    <td colspan="5" id="alamat_op" style="width: 70%;">
                                        {{ $catalog->isbn }}
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row">Judul</th>
                                    <td colspan="5" id="alamat_op" style="width: 70%;">
                                        {{ $catalog->title }}
                                    </td>
                                </tr>
                                @if ($catalog->class)
                                <tr>
                                    <th scope="row">Kelas</th>
                                    <td colspan="5" id="alamat_op" style="width: 70%;">
                                        {{ $catalog->class }}
                                    </td>
                                </tr>
                                @endif
                                <tr>
                                    <th scope="row">Edisi</th>
                                    <td colspan="5" id="alamat_op" style="width: 70%;">
                                        {{ $catalog->edition }}
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row">Penulis</th>
                                    <td colspan="5" id="alamat_op" style="width: 70%;">
                                        {{ $catalog->writer }}
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row">Penerbit</th>
                                    <td colspan="5" id="alamat_op" style="width: 70%;">
                                        {{ $catalog->publisher }}
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row">Tahun Rilis</th>
                                    <td colspan="5" id="alamat_op" style="width: 70%;">
                                        {{ $catalog->release_year }}
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row">Harga Retail</th>
                                    <td colspan="5" id="alamat_op" style="width: 70%;">
                                        @if ($catalog->price)
                                            Rp. {{ number_format($catalog->price, 2) }}
                                        @else
                                            -
                                        @endif
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <form action="{{ route('admin.loan.submit') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="serial_id" value="{{ $serial_id }}">
                            <table class="table table-striped table-sm table-bordered">
                                <tbody>
                                    <tr>
                                        <th scope="row">Durasi Peminjaman</th>
                                        <td colspan="5" style="width: 70%;">
                                            <select name="duration">
                                                <option selected disabled>Dalam Minggu</option>
                                                <option value="1">1</option>
                                                <option value="2">2</option>
                                                <option value="3">3</option>
                                                <option value="4">4</option>
                                                <option value="5">5</option>
                                                <option value="6">6</option>
                                                <option value="7">7</option>
                                                <option value="8">8</option>
                                            </select>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <div style="text-align: right">
                                <button type="submit" class="btn btn-icon icon-left btn-primary">
                                    <i class="fa fa-arrow-circle-up"></i> Simpan
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        @endif
    </div>
</section>
@endsection
