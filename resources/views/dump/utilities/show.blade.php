@extends('master')

@section('content')
<section class="section">
    <div class="section-header">
        {{-- <div class="section-header-back">
            <a href="#" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
        </div> --}}
        <h1>Utilities Configuration</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item"><a href="#">Dashboard</a></div>
            <div class="breadcrumb-item"><a href="#">Module</a></div>
            <div class="breadcrumb-item active">#</div>
        </div>
    </div>

    <div class="section-body">
        <div class="row">
            <div class="col-3">
                <div class="card">
                    <div class="card-body" id="imageContainer">
                        <h4>Main Logo - Favicon</h4>
                        <label for="fileInput" style="cursor: pointer;">
                            <img src="https://cdn.vectorstock.com/i/preview-1x/76/27/default-profile-picture-avatar-photo-placeholder-vector-30247627.webp" alt="Foto" style="width: 100%">
                        </label>
                        <input type="file" id="fileInput" style="display: none;" accept="image/*" onchange="displaySelectedImage()">
                    </div>
                </div>
            </div>
            <div class="col-9">
                <div class="card">
                    <div class="card-body">
                        <form action="#" method="post" id="formTambah">
                            <div class="form-group row mb-4">
                                <label class="col-form-label col-12 col-md-3 col-lg-3">Website Head</label>
                                <div class="col-sm-12 col-md-7">
                                    <input type="text" class="form-control" name="name" id="name" value="SmartLib - V1" disabled>
                                    <div class="invalid-feedback" for="name"></div>
                                </div>
                            </div>
                            <div class="form-group row mb-4">
                                <label class="col-form-label col-12 col-md-3 col-lg-3">Website Name</label>
                                <div class="col-sm-12 col-md-7">
                                    <input type="text" class="form-control" name="name" id="name" value="SmartLib - V1" disabled>
                                    <div class="invalid-feedback" for="name"></div>
                                </div>
                            </div>
                            <div class="form-group row mb-4">
                                <label class="col-form-label col-12 col-md-3 col-lg-3">Alamat</label>
                                <div class="col-sm-12 col-md-7">
                                    <input type="text" class="form-control" name="name" id="name" value="Jl. Akjasfkjanfqwbfqlfqlfqwfqw" disabled>
                                    <div class="invalid-feedback" for="name"></div>
                                </div>
                            </div>
                            <div class="form-group row mb-4">
                                <label class="col-form-label col-12 col-md-3 col-lg-3">Contact Person</label>
                                <div class="col-sm-12 col-md-7">
                                    <input type="text" class="form-control" name="name" id="name" value="012491121231 (Pak Agus)" disabled>
                                    <div class="invalid-feedback" for="name"></div>
                                </div>
                            </div>
                            <div class="form-group row mb-4">
                                <label class="col-form-label col-12 col-md-3 col-lg-3">Denda Harian</label>
                                <div class="col-sm-12 col-md-7">
                                    <input type="text" class="form-control" name="name" id="name" value="Rp. 500,00" disabled>
                                    <div class="invalid-feedback" for="name"></div>
                                </div>
                            </div>
                            <div class="form-group row mb-4" style="text-align: right">
                                <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3"></label>
                                <div class="col-sm-12 col-md-7">
                                    <a href="{{route('utilities.update')}}" class="btn btn-icon icon-left btn-primary">
                                        <i class="fa fa-pen"></i>
                                        Edit
                                    </a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection