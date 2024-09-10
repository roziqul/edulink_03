@extends('admin.master')
@section('content')
<section class="section">
    <div class="section-header">
        <h1>Detail Katalog</h1>
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
                                <tr>
                                    <th scope="row">Jumlah Buku</th>
                                    <td colspan="5" id="alamat_op" style="width: 70%;">
                                        <div class="badge badge-success">{{ $availableSerialNumber }} Tersedia</div>
                                        <div class="badge badge-primary">{{ $unavailableSerialNumber }} Terpinjam</div>
                                        <div class="badge badge-danger">{{ $missingSerialNumber }} Hilang</div>
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row">Tanggal Ditambahkan</th>
                                    <td colspan="5" id="alamat_op" style="width: 70%;">
                                        {{ $createdDate->translatedFormat('d F Y / H:i') }}
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row">Terakhir Diperbarui</th>
                                    <td colspan="5" id="alamat_op" style="width: 70%;">
                                        {{ $updatedDate->translatedFormat('d F Y / H:i') }}
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <div style="display: flex; justify-content: flex-end; gap: 10px;">
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addSerialModal">
                                <i class="fas fa-plus"></i>
                                Tambah Nomor Seri
                            </button>
                            <a href="{{ route('print.multiple.barcode', $catalogDetail->id) }}" target="_blank" class="btn btn-primary">
                                <i class="fas fa-qrcode text-white" style="margin-right: 5px"></i>
                                Cetak Barcode Buku
                            </a>
                            <form action="{{route('admin.catalog.edit')}}" method="get" style="margin: 0;">
                                @csrf
                                <input type="hidden" value="{{$catalogDetail->id}}" name="id">
                                <input type="hidden" value="{{$catalogDetail->category_id}}" name="category_id">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-pen text-white" style="margin-right: 5px"></i>Edit Data
                                </button>
                            </form>
                        </div>                        
                    </div>
                </div>

                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped" id="table-1">
                                <thead>
                                    <tr>
                                        <th style="text-align: center">Nomor Registrasi</th>
                                        <th style="text-align: center">Status Buku</th>
                                        <th style="text-align: center">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($allSerial as $val)
                                    <tr>
                                        <td style="text-align: center">
                                            <a href="{{route('admin.catalog.show.serial', $val->id)}}">{{ $val->registration_number }}</a>
                                        </td>  
                                        <td style="text-align: center">
                                            @if ( $val->status == 'available')
                                                <div class="badge badge-success">Tersedia</div>
                                            @elseif ( $val->status == 'not_available')
                                                <div class="badge badge-primary">Dipinjam</div>
                                            @else
                                                <div class="badge badge-danger">Hilang</div>
                                            @endif    
                                        </td>  
                                        <td style="text-align: center">
                                            <div class="d-inline-block">
                                                <a href="{{ route('print.single.barcode', $val->registration_number) }}" target="_blank" class="btn btn-primary">
                                                    <i class="fas fa-qrcode text-white"></i>
                                                </a>
                                            </div>  
                                        </td>  
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <!-- Add Serial Modal -->
                
            </div>
        </div>
    </div>
</section>
<div class="modal fade" id="addSerialModal" tabindex="-1" aria-labelledby="addSerialModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addSerialModalLabel">Tambah Nomor Seri</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{route('generate.serial.number')}}" method="get">
                <div class="modal-body">
                    @csrf
                    <input type="hidden" name="catalog_id" value="{{$catalogDetail->id}}">
                    <div class="mb-3">
                        <label for="number_of_serials" class="form-label">Jumlah Nomor Seri</label>
                        <input type="number" name="amount" class="form-control" min="1" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Tambah Nomor Seri</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    new DataTable('#example', {
    layout: {
        top1: {
            searchPanes: {
                orderable: false
            }
        }
    }
});
</script>
@endsection
