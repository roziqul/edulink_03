@extends('student.master')
@section('content')
<section class="section">
    <div class="section-header">
        <h1>Katalog Buku</h1>
    </div>
    <div class="section-body">
        <div class="row">
            <div class="col-12">
                @if ($catalog != null)
                <div class="card">
                    <div class="card-header">
                        <form action="{{route('student.catalog.filter')}}" enctype="multipart/form-data" class="form-row w-100 d-flex justify-content-end ml-0">
                            @csrf
                            <div class="d-flex">
                                <div class="form-group mb-0">
                                    <select id="inputState" class="form-control" name="classification">
                                        <option selected disabled readonly>Klasifikasi</option>
                                        @foreach ($classification as $key => $label)
                                        <option value="{{$key}}">{{$label}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group mb-0 mx-3">
                                    <input type="text" name="keyword" class="form-control lg" id="inputCity" placeholder="Kata kunci.." style="height: calc(2.25rem + 6px)">
                                </div>
                                <div class="form-group mb-0">
                                    <button type="submit" class="btn-sm btn-icon icon-center btn-primary" style="height: calc(2.25rem + 6px); width: calc(2.25rem + 6px); border-radius: 10px;">
                                        <i class="fas fa-search text-white icon-center"></i>
                                    </button>
                                </div>
                            </div>
                        </form>                         
                    </div>
                </div>
                <div class="row">
                @foreach ($catalog as $cat)
                    <div class="col-12 col-md-6 col-lg-3 mb-4">
                        <div class="card h-100" style=" border-radius: 10px;">
                            <div class="card-body text-center">
                                <a href="{{route('student.catalog.show', $cat->id)}}">
                                <div class="book-cover text-left">
                                    <img src="{{$cat->cover}}" alt="cover buku" style="width: 100%; height: 70%; border-radius: 10px;">
                                </div>
                                <div class="text-left mt-3">
                                    @if ($cat->class == 'X')
                                    <span class="badge badge-success">{{$cat->class}}</span>
                                    @elseif ($cat->class == 'XI')
                                    <span class="badge badge-warning">{{$cat->class}}</span>
                                    @elseif ($cat->class == 'XII')
                                    <span class="badge badge-danger">{{$cat->class}}</span>
                                    @else
                                    <span class="badge badge-primary">Umum</span>
                                    @endif
                                    <span class="badge badge-secondary ml-1">{{$cat->category->name}}</span>
                                </div>    
                                <p class="text-left mt-2" style="font-size: 20px">{{$cat->title}}</p>  
                                </a>                                                             
                            </div>
                            <div class="card-footer text-right">
                                @if(in_array($cat->id, $excludedIds))
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
                @endforeach
                </div>
                @else
                <div class="card">
                    <div class="card-body">
                    <div class="empty-state" data-height="400">
                        <i class="fas fa-search text-primary" style="font-size: 40px"></i>
                        <h2>Maaf, kami tidak dapat menemukan katalog yang tersedia</h2>
                    </div>
                    </div>
                </div>
                @endif
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
                    <input type="hidden" name="catalog_id" value="{{$cat->id ?? null}}">
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

<style>
    .book-cover img {
        border-radius: 10px;
    }
    .badge {
        padding: 0.5em 1em;
        font-size: 0.9em;
    }
</style>
