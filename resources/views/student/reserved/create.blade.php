@extends('master')

@section('content')
<section class="section">
    <div class="section-header">
        {{-- <div class="section-header-back">
            <a href="#" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
        </div> --}}
        <h1>Input Siswa</h1>
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
                        <h4>Photo</h4>
                        <label for="coverPreview" style="cursor: pointer;">
                            <img src="https://cdn.vectorstock.com/i/preview-1x/76/27/default-profile-picture-avatar-photo-placeholder-vector-30247627.webp" alt="foto siswa" style="width: 100%" id="coverPreview">
                        </label>
                    </div>
                </div>
            </div>
            <div class="col-9">
                <div class="card">
                    <div class="card-body">
                        <form action="{{route('student.store')}}" method="post" id="formTambah" enctype=multipart/form-data>
                            @csrf
                            <div class="form-group row mb-4" style="display: none">
                                <label class="col-form-label col-12 col-md-3 col-lg-3">Photo</label>
                                <div class="col-sm-12 col-md-7">
                                    <input type="file" class="form-control" name="photo" id="photo" onchange="displaySelectedImage(this)">
                                    <div class="invalid-feedback" for="serial_number"></div>
                                </div>
                            </div>
                            <div class="form-group row mb-4">
                                <label class="col-form-label col-12 col-md-3 col-lg-3">Class</label>
                                <div class="col-sm-12 col-md-7">
                                    <input type="text" class="form-control" name="class" id="class">
                                    <div class="invalid-feedback" for="serial_number"></div>
                                </div>
                            </div>
                            <div class="form-group row mb-4">
                                <label class="col-form-label col-12 col-md-3 col-lg-3">NISN</label>
                                <div class="col-sm-12 col-md-7">
                                    <input type="text" class="form-control" name="nisn" id="nisn">
                                    <div class="invalid-feedback" for="serial_number"></div>
                                </div>
                            </div>
                            <div class="form-group row mb-4">
                                <label class="col-form-label col-12 col-md-3 col-lg-3">Full Name</label>
                                <div class="col-sm-12 col-md-7">
                                    <input type="text" class="form-control" name="fullname" id="fullname">
                                    <div class="invalid-feedback" for="serial_number"></div>
                                </div>
                            </div>
                            <div class="form-group row mb-4">
                                <label class="col-form-label col-12 col-md-3 col-lg-3">Place of Birth</label>
                                <div class="col-sm-12 col-md-7">
                                    <input type="text" class="form-control" name="pob" id="pob">
                                    <div class="invalid-feedback" for="serial_number"></div>
                                </div>
                            </div>
                            <div class="form-group row mb-4">
                                <label class="col-form-label col-12 col-md-3 col-lg-3">Date of Birth</label>
                                <div class="col-sm-12 col-md-7">
                                    <div class="input-group" style="width: 100%;">
                                        <input type="date" class="form-control datemask" placeholder="YYYY/MM/DD" name="dob">
                                    </div>
                                    <div class="invalid-feedback" for="birthplace"></div>
                                </div>
                            </div>
                            <div class="form-group row mb-4">
                                <label class="col-form-label col-12 col-md-3 col-lg-3">Gender</label>
                                <div class="col-sm-12 col-md-7">
                                    <div class="selectgroup w-100">
                                        <label class="selectgroup-item">
                                          <input type="radio" name="gender" value="L" class="selectgroup-input" checked="">
                                          <span class="selectgroup-button">Laki-laki</span>
                                        </label>
                                        <label class="selectgroup-item">
                                          <input type="radio" name="gender" value="P" class="selectgroup-input">
                                          <span class="selectgroup-button">Perempuan</span>
                                        </label>
                                      </div>
                                </div>
                            </div>
                            <div class="form-group row mb-4">
                                <label class="col-form-label col-12 col-md-3 col-lg-3">Address</label>
                                <div class="col-sm-12 col-md-7">
                                    <input type="text" class="form-control" name="address" id="address">
                                    <div class="invalid-feedback" for="title"></div>
                                </div>
                            </div>
                            <div class="form-group row mb-4">
                                <label class="col-form-label col-12 col-md-3 col-lg-3">Phone</label>
                                <div class="col-sm-12 col-md-7">
                                    <input type="text" class="form-control" name="phone" id="phone">
                                    <div class="invalid-feedback" for="writer"></div>
                                </div>
                            </div>
                            <div class="form-group row mb-4" style="text-align: right">
                                <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3"></label>
                                <div class="col-sm-12 col-md-7">
                                    <button type="submit" class="btn btn-icon icon-left btn-success">
                                        <i class="fa fa-save"></i>
                                        Create
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
        const fileInput = document.getElementById('photo');
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
        document.getElementById('photo').click();
    });
</script>
@endsection