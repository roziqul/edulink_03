@extends('admin.master')
@section('content')
<section class="section">
    <div class="section-header">
        <h1>Edit Katalog</h1>
    </div>
    <div class="section-body">
        <div class="row">
            <div class="col-3">
                <div class="card">
                    <div class="card-body" id="imageContainer">
                        <h4>Sampul</h4>
                        <label for="coverPreview" style="cursor: pointer;">
                            <img src="{{$catalogDetail->cover}}" alt="Cover" style="width: 100%" id="coverPreview">
                        </label>
                    </div>
                </div>
            </div>
            <div class="col-9">
                <div class="card">
                    <div class="card-body">
                        <h4>Rincian</h4>
                        <form action="{{route('admin.catalog.update', $catalogDetail->id)}}" method="post" id="formTambah" enctype=multipart/form-data>
                            @csrf
                            @method('PUT')
                            <div class="form-group row mb-4" style="display: none">
                                <div class="col-sm-12 col-md-7">
                                    <input type="file" class="form-control" name="cover" id="cover" onchange="displaySelectedImage(this)">
                                    <div class="invalid-feedback" for="cover"></div>
                                </div>
                            </div>
                            <div class="form-group row mb-4">
                                <label class="col-form-label col-12 col-md-3 col-lg-3">Klasifikasi Buku</label>
                                <div class="col-sm-12 col-md-7">
                                    <select class="custom-select" name="category_id">
                                        @foreach ($category as $val)
                                        @if ($val->id != $catalogDetail->id)
                                        <option value="{{$val->id}}">{{$val->name}}</option>
                                        @endif
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row mb-4">
                                <label class="col-form-label col-12 col-md-3 col-lg-3">Kode ISBN</label>
                                <div class="col-sm-12 col-md-7">
                                    <input type="text" class="form-control" name="isbn" value="{{$catalogDetail->isbn}}">
                                    <div class="invalid-feedback" for="isbn"></div>
                                </div>
                            </div>
                            <div class="form-group row mb-4">
                                <label class="col-form-label col-12 col-md-3 col-lg-3">Judul Buku</label>
                                <div class="col-sm-12 col-md-7">
                                    <input type="text" class="form-control" name="title" value="{{$catalogDetail->title}}">
                                    <div class="invalid-feedback" for="title"></div>
                                </div>
                            </div>
                            <div class="form-group row mb-4">
                                <label class="col-form-label col-12 col-md-3 col-lg-3">Penulis</label>
                                <div class="col-sm-12 col-md-7">
                                    <textarea class="form-control" name="writer" id="writer" rows="4">{{$catalogDetail->writer}}</textarea>
                                    <div class="invalid-feedback" for="writer"></div>
                                </div>
                            </div>
                            <div class="form-group row mb-4">
                                <label class="col-form-label col-12 col-md-3 col-lg-3">Penerbit</label>
                                <div class="col-sm-12 col-md-7">
                                    <textarea type="text" class="form-control" name="publisher" rows="4">{{$catalogDetail->publisher}}</textarea>
                                    <div class="invalid-feedback" for="name"></div>
                                </div>
                            </div>
                            <div class="form-group row mb-4">
                                <label class="col-form-label col-12 col-md-3 col-lg-3">Tahun Rilis</label>
                                <div class="col-sm-12 col-md-7">
                                    <div class="input-group" style="width: 100%;">
                                        <input type="number" class="form-control datemask" name="release_year" value="{{$catalogDetail->release_year}}">
                                    </div>
                                    <div class="invalid-feedback" for="release_year"></div>
                                </div>
                            </div>
                            <div class="form-group row mb-4">
                                <label class="col-form-label col-12 col-md-3 col-lg-3">Tingkatan</label>
                                <div class="col-sm-12 col-md-7">
                                    <select class="custom-select" name="class">
                                        <option value="X">Kelas X</option>
                                        <option value="XI">Kelas XI</option>
                                        <option value="XII">Kelas XII</option>
                                        <option value="ALL">Umum</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row mb-4">
                                <label class="col-form-label col-12 col-md-3 col-lg-3">Edisi</label>
                                <div class="col-sm-12 col-md-7">
                                    <input type="text" class="form-control" name="edition" value="{{$catalogDetail->edition}}">
                                    <div class="invalid-feedback" for="edition"></div>
                                </div>
                            </div>
                            <div class="form-group row mb-4">
                                <label class="col-form-label col-12 col-md-3 col-lg-3">Harga Retail</label>
                                <div class="col-sm-12 col-md-7">
                                    <input type="number" class="form-control" name="price" value="{{$catalogDetail->price}}">
                                    <div class="invalid-feedback" for="name"></div>
                                </div>
                            </div>
                            <div class="form-group row mb-4" style="text-align: right">
                                <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3"></label>
                                <div class="col-sm-12 col-md-7">
                                    <a type="button" href="{{route('admin.catalog.show',$catalogDetail->id)}}" class="btn btn-icon icon-left btn-danger">
                                        <i class="fa fa-times"></i>
                                        Batalkan
                                    </a>
                                    <button type="submit" class="btn btn-icon icon-left btn-success">
                                        <i class="fa fa-save"></i>
                                        Simpan
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<script>
    function displaySelectedImage() {
        const fileInput = document.getElementById('cover');
        const selectedFile = fileInput.files[0];

        if (selectedFile) {
            const coverPreview = document.getElementById('coverPreview');
            const reader = new FileReader();

            reader.onload = function (e) {
                coverPreview.src = e.target.result;
            };

            reader.readAsDataURL(selectedFile);
        }
    }

    document.getElementById('imageContainer').addEventListener('click', function () {
        document.getElementById('cover').click();
    });
</script>
@endsection