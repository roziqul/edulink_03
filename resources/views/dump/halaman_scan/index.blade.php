@extends('master')

@section('content')
    <section class="section">
        <div class="section-header">
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
                <div class="breadcrumb-item"><a href="#">Components</a></div>
                <div class="breadcrumb-item">Empty State</div>
            </div>
        </div>

        <div class="section-body">

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                    <h4>Pengembalian Buku</h4>
                    </div>
                    <div class="card-body">
                    <div class="empty-state" data-height="400">
                        <div class="empty-state-icon">
                            <i class="fas fa-search"></i>
                        </div>
                        <h2>Scan Barcode Buku</h2>
                        <p class="lead">
                            Jika mengalami kendala dengan scanner, silahkan melakukan input secara manual.
                        </p>
                        <a href="{{route('buku.pengembalian.show')}}" class="btn btn-primary mt-4">Mulai Scan</a>
                        <a href="{{route('buku.pengembalian.create')}}" class="mt-4 bb">Input Manual</a>
                    </div>
                    </div>
                </div>
            </div>
        </div>

        </div>
    </section>
@endsection