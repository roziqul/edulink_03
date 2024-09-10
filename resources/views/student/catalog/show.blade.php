@extends('student.master')
@section('content')
<section class="section">
    <div class="section-header">
        <h1>Detail Buku</h1>
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
                                @if ($catalogDetail->class)
                                <tr>
                                    <th scope="row">Kelas</th>
                                    <td colspan="5" id="alamat_op" style="width: 70%;">
                                        {{ $catalogDetail->class }}
                                    </td>
                                </tr>
                                @endif
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
                        <div style="text-align: right">
                            @if(in_array($catalogDetail->id, $excludedIds))
                            <button type="button" class="btn btn-secondary" disabled>
                                <i class="fas fa-cart-arrow-down"></i>
                                Pinjam
                            </button>
                            @else
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addSerialModal">
                                <i class="fas fa-cart-arrow-down"></i>
                                Pinjam
                            </button>
                            @endif
                        </div>
                    </div>
                </div>  
            </div>
        </div>
    </div>
</section>
<div class="modal fade" id="addSerialModal" tabindex="-1" aria-labelledby="addSerialModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addSerialModalLabel">Durasi Peminjaman</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{route('student.reservation.store')}}" method="post">
                <div class="modal-body">
                    @csrf
                    <input type="hidden" name="catalog_id" value="{{$catalogDetail->id ?? null}}">
                    <div class="mb-3">
                        <label for="number_of_serials" class="form-label">Durasi Peminjaman Buku ( dalam Minggu )</label>
                        <input type="number" name="duration" id="serial_amount" class="form-control" min="1" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
