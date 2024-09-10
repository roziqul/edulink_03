@extends('admin.master')
@section('content')
<section class="section">
    <div class="section-header">
        <h1>SmartLib - Dasbor Admin</h1>
    </div>
    <div class="row">
        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
            <div class="card card-statistic-1">
                <div class="card-icon bg-primary">
                    <i class="fas fa-book"></i>
                </div>
                <div class="card-wrap">
                    <div class="card-header">
                        <h4>Buku Dipinjam</h4>
                    </div>
                    <div class="card-body">
                        {{ $countReserved }}
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
            <div class="card card-statistic-1">
                <div class="card-icon bg-danger">
                    <i class="fas fa-layer-group"></i>
                </div>
                <div class="card-wrap">
                    <div class="card-header">
                        <h4>Jumlah Buku</h4>
                    </div>
                    <div class="card-body">
                        {{ $countBook }}
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
            <div class="card card-statistic-1">
                <div class="card-icon bg-warning">
                    <i class="fas fa-user"></i>
                </div>
                <div class="card-wrap">
                    <div class="card-header">
                        <h4>Jumlah Pengguna</h4>
                    </div>
                    <div class="card-body">
                        {{ $countUser }}
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
            <div class="card card-statistic-1">
                <div class="card-icon bg-success">
                    <i class="fas fa-coins"></i>
                </div>
                <div class="card-wrap">
                    <div class="card-header">
                        <h4>Total Tagihan</h4>
                    </div>
                    <div class="card-body">
                        @if ($countFine < 1000000)
                            Rp. {{ $countFine }}
                        @else
                            <h6>
                                Rp. {{ $countFine }}
                            </h6>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
