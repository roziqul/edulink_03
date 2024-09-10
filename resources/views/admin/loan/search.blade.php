@extends('admin.master')
@section('content')
<section class="section">
    <div class="section-body">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Peminjaman Buku</h4>
                    </div>
                    <div class="card-body">
                        <div class="empty-state" data-height="400">
                            <div class="empty-state-icon">
                                <i class="fas fa-search"></i>
                            </div>
                            <h2>Masukkan NISN Siswa</h2>
                            <p class="lead">
                                <form action="{{route('admin.loan.result-student')}}" method="post" id="formTambah" enctype=multipart/form-data class="form-inline mb-4">
                                    @csrf
                                    <div class="input-group mb-2" style="width: 100%;">
                                        <div class="form-inline" style="display: block">
                                            <input type="number" name="nisn" id="nisn" class="form-control" title="nisn" placeholder="Masukkan NISN.." style="width: 300px;">
                                        </div>
                                        <div class="form-inline ml-2">
                                            <button type="submit" class="btn btn-icon icon-left btn-primary">
                                                <i class="fa fa-search"></i>
                                                Cari Siswa
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
    </div>
</section>
@endsection