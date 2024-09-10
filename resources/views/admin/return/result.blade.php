@extends('admin.master')

@section('content')
<section class="section">
    <div class="section-header">
        <h1>Pengembalian Buku</h1>
    </div>
    <div class="section-body">
        <div class="row">
            <div class="col-4">
                <div class="card">
                    <div class="card-body">
                        <img src="{{$serial->catalog->cover}}" alt="cover" style="width: 100%"> 
                    </div>
                </div>
            </div>
            <div class="col-8">
                <div class="card">
                    <div class="card-body">
                        <table class="table table-striped table-sm table-bordered">
                            <tbody>
                                <tr>
                                    <th scope="row">Kode ISBN</th>
                                    <td colspan="5" id="alamat_op" style="width: 70%;">{{$serial->catalog->isbn}}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Nomor Registrasi</th>
                                    <td colspan="5" id="alamat_op" style="width: 70%;">{{$serial->registration_number}}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Kategori</th>
                                    <td colspan="5" id="alamat_op" style="width: 70%;">{{$serial->catalog->category->code}} - {{$serial->catalog->category->name}}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Judul</th>
                                    <td colspan="5" id="alamat_op" style="width: 70%;">{{$serial->catalog->title}}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Klasifikasi Buku</th>
                                    <td colspan="5" id="alamat_op" style="width: 70%;">
                                        @if ($serial->catalog->classification_id == 1 || $serial->catalog->classification_id == 2 || $serial->catalog->classification_id == 3)
                                        Kelas {{$serial->catalog->classification->name}}
                                        @elseif ($serial->catalog->classification_id == 4)
                                        {{$serial->catalog->classification->name}}
                                        @elseif ($serial->catalog->classification_id == 5)
                                        Pegangan {{$serial->catalog->classification->name}}
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row">Edisi</th>
                                    <td colspan="5" id="alamat_op" style="width: 70%;">{{$serial->catalog->edition}}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Penulis</th>
                                    <td colspan="5" id="alamat_op" style="width: 70%;">{{$serial->catalog->writer}}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Penerbit</th>
                                    <td colspan="5" id="alamat_op" style="width: 70%;">{{$serial->catalog->publisher}}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Tahun Terbit</th>
                                    <td colspan="5" id="alamat_op" style="width: 70%;">{{$serial->catalog->release_year}}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Harga Satuan</th>
                                    <td colspan="5" id="alamat_op" style="width: 70%;">
                                        @if ($serial->catalog->price)
                                            Rp. {{ number_format($serial->catalog->price, 2) }}
                                        @else
                                            -
                                        @endif
                                    </td>
                                </tr>
                            </tbody>
                        </table>

                        <strong>
                            <h4>Informasi Peminjam</h4>
                        </strong>
                        <table class="table table-striped table-sm table-bordered mb-5">
                            <tbody>
                                <tr>
                                    <th scope="row">Nama</th>
                                    <td colspan="5" id="nama_wp" style="width: 70%;">{{$student->fullname}}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Kelas</th>
                                    <td colspan="5" id="alamat_wp">{{$student->class}}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Tanggal Peminjaman</th>
                                    <td colspan="5" id="alamat_wp">
                                        {{ $startDate->translatedFormat('d F Y / H:i') }}
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row">Tanggal Jatuh Tempo</th>
                                    <td colspan="5" id="alamat_wp">
                                        {{ $dueDate->translatedFormat('d F Y / H:i') }}
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row">Status</th>
                                    <td colspan="5" id="alamat_op" style="width: 70%;">
                                        @if ($reserved->rsv_status == 'not_finished')
                                            <div class="badge badge-danger">Belum Selesai</div>
                                        @else
                                            <div class="badge badge-primary">-</div>
                                        @endif
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        
                        <form action="{{route('admin.return.submit')}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" class="form-control" value="{{$serial->id}}" name="serial_id">
                            <input type="hidden" class="form-control" value="{{$reserved->id}}" name="reserved_id">
                            <div style="text-align: right">
                                <button type="submit" class="btn btn-success">
                                    <i class="fas fa-check"></i>
                                    Konfirmasi Pengembalian
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection