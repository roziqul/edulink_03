@extends('admin.master')

@section('content')
<section class="section">
    <div class="section-header">
        <h1>Detail Reservasi</h1>
    </div>
    <div class="section-body">
        <div class="row">
            <div class="col-4">
                <div class="card">
                    <div class="card-body">
                        <img src="{{ $catalogDetail->cover }}" alt="cover buku" style="width: 100%">
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
                                            {{ $catalogDetail->category->code }} - {{ $catalogDetail->category->name }}
                                        </a>
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row">Klasifikasi Buku</th>
                                    <td colspan="5" id="alamat_op" style="width: 70%;">
                                        @if ($catalogDetail->classification_id == 1 || $catalogDetail->classification_id == 2 || $catalogDetail->classification_id == 3)
                                        Kelas {{$catalogDetail->classification->name}}
                                        @elseif ($catalogDetail->classification_id == 4)
                                        {{$catalogDetail->classification->name}}
                                        @elseif ($catalogDetail->classification_id == 5)
                                        Pegangan {{$catalogDetail->classification->name}}
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row">Kode ISBN</th>
                                    <td colspan="5" id="alamat_op" style="width: 70%;">
                                        {{ $catalogDetail->isbn }}
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row">Judul</th>
                                    <td colspan="5" id="alamat_op" style="width: 70%;">
                                        {{ $catalogDetail->title }}
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row">Edisi</th>
                                    <td colspan="5" id="alamat_op" style="width: 70%;">
                                        {{ $catalogDetail->edition }}
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row">Penulis</th>
                                    <td colspan="5" id="alamat_op" style="width: 70%;">
                                        {{ $catalogDetail->writer }}
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row">Penerbit</th>
                                    <td colspan="5" id="alamat_op" style="width: 70%;">
                                        {{ $catalogDetail->publisher }}
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row">Tahun Rilis</th>
                                    <td colspan="5" id="alamat_op" style="width: 70%;">
                                        {{ $catalogDetail->release_year }}
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row">Harga Retail</th>
                                    <td colspan="5" id="alamat_op" style="width: 70%;">
                                        @if ($catalogDetail->price)
                                            Rp. {{ number_format($catalogDetail->price, 2) }}
                                        @else
                                            -
                                        @endif
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <table class="table table-striped table-sm table-bordered">
                            <tbody>
                                <tr>
                                    <th scope="row">Durasi Peminjaman</th>
                                    <td colspan="5" id="alamat_op" style="width: 70%;">
                                        {{ $reservationDetail->duration }} Minggu
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row">Tanggal Pengajuan</th>
                                    <td colspan="5" id="alamat_op" style="width: 70%;">
                                        {{ $reservationRequest }}
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row">Estimasi Selesai Peminjaman</th>
                                    <td colspan="5" id="alamat_op" style="width: 70%;">
                                        {{ $timeEstimation }}
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <div style="text-align: right">
                            <button type="button" class="btn btn-success" data-toggle="modal" data-target="#approveReservationModal">
                                <i class="far fa-check-circle"></i>
                                Setujui
                            </button>
                            <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#rejectReservationModal">
                                <i class="fas fa-times"></i>
                                Tolak
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<div class="modal fade" id="approveReservationModal" tabindex="-1" aria-labelledby="addSerialModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addSerialModalLabel">Nomor Seri</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{route('admin.reservation.submit')}}" enctype="multipart/form-data" method="post">
                <div class="modal-body">
                    @csrf
                    <input type="hidden" name="status" value="approved">
                    <input type="hidden" name="reservation_id" value="{{$reservationDetail->id}}">
                    <input type="hidden" name="student_id" value="{{$reservationDetail->student_id}}">
                    <input type="hidden" name="start_date" value="{{$reservationDetail->created_at}}">
                    <input type="hidden" name="duration" value="{{$reservationDetail->duration}}">
                    <div class="mb-3">
                        <label for="number_of_serials" class="form-label">Masukkan Nomor Seri</label>
                        <select class="form-control select2" name="registration_number" id="registration_number">
                            <option value="" selected disabled></option>
                            @foreach ($allSerial as $val)
                                <option value="{{ $val->id }}">{{ $val->registration_number }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Konfirmasi</button>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="modal fade" id="rejectReservationModal" tabindex="-1" aria-labelledby="rejectReservationModal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addSerialModalLabel">Pembatalan Reservasi</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{route('admin.reservation.submit')}}" enctype="multipart/form-data" method="post">
                <div class="modal-body">
                    @csrf
                    <input type="hidden" name="status" value="declined">
                    <input type="hidden" name="reservation_id" value="{{$reservationDetail->id}}">
                    <div class="mb-3">
                        <label for="number_of_serials" class="form-label">Alasan penolakan</label>
                        <textarea class="form-control" name="info" cols="30" rows="20"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Konfirmasi</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
