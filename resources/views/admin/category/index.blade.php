@extends('admin.master')
@section('content')
<section class="section">

    <div class="section-header">
        <h1>Kategori Katalog</h1>
    </div>

    <div class="row">
        <div class="col-lg-4 col-md-6 col-sm-6 col-12">
            <a href="#" style="text-decoration: none;" data-toggle="modal" data-target="#addCategoryModal">
                <div class="card card-statistic-1 btn-utilities-card add-category-card">
                    <div class="card-icon" style="background-color: transparent; display: flex; flex-direction: column; align-items: center; justify-content: center; color: white; margin: 0px">
                        <i class="fas fa-folder-plus" style="font-size: 30px"></i>
                    </div>
                    <div class="card-wrap" style="display: flex; align-items: center; height: 75px;">
                        <div class="card-header" style="width: 100%; display: flex; align-items: center; padding-top: 5px; padding-left: 0px;">
                            <h4 style="color: white">Tambah Kategori</h4>
                        </div>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-lg-4 col-md-6 col-sm-6 col-12">
            <a href="{{route('admin.catalog.create')}}" style="text-decoration: none;">
                <div class="card card-statistic-1 btn-utilities-card add-book-card">
                    <div class="card-icon" style="background-color: transparent; display: flex; flex-direction: column; align-items: center; justify-content: center;  color: white; margin: 0px">
                        <i class="fas fa-book-medical" style="font-size: 30px"></i>
                    </div>
                    <div class="card-wrap" style="display: flex; align-items: center; height: 75px;">
                        <div class="card-header" style="width: 100%; display: flex; align-items: center; padding-top: 5px; padding-left: 0px;">
                            <h4 style="color: white">Tambah Buku</h4>
                        </div>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-lg-4 col-md-6 col-sm-6 col-12">
            <a href="#" style="text-decoration: none;" data-toggle="modal" data-target="#searchBookModal">
                <div class="card card-statistic-1 btn-utilities-card search-book-card">
                    <div class="card-icon" style="background-color: transparent; display: flex; flex-direction: column; align-items: center; justify-content: center; color: white; margin: 0px">
                        <i class="fas fa-search" style="font-size: 30px"></i>
                    </div>
                    <div class="card-wrap" style="display: flex; align-items: center; height: 75px;">
                        <div class="card-header" style="width: 100%; display: flex; align-items: center; padding-top: 5px; padding-left: 0px;">
                            <h4 style="color: white">Cari Buku</h4>
                        </div>
                    </div>
                </div>
            </a>
        </div>
    </div>

    <div class="row" style="justify-content: center;">
        @foreach ($categories as $cat)
        <div class="col-lg-6 col-md-6 col-sm-6 col-12">
            <a href="{{route('admin.category.show', $cat->id)}}" style="text-decoration: none;">
                <div class="card card-statistic-1 btn-categories-card">
                    <div class="card-icon" style="background-color: {{$cat->background}}; display: flex; flex-direction: column; align-items: center; justify-content: center; padding: 20px; color: white;">
                        <i class="fas {{$cat->icon}}" style="margin-top: 75%;"></i>
                        <p>{{$cat->code}}</p>
                    </div>
                    <div class="card-wrap" style="display: flex; align-items: center; height: 75px;">
                        <div class="card-header" style="width: 100%; display: flex; align-items: center; padding-top: 25px; padding-left: 10px;">
                            <h4>{{$cat->name}}</h4>
                        </div>
                    </div>
                </div>
            </a>
        </div>
        @endforeach
    </div>

</section>

<div class="modal fade" id="searchBookModal" tabindex="-1" aria-labelledby="searchBookModal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addSerialModalLabel">Pencarian Buku</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="#" method="post" enctype="multipart/form-data">
                <div class="modal-body">
                    @csrf
                    <div class="mb-3">
                        <label for="number_of_serials" class="form-label">Klasifikasi Pencarian</label>
                        <select id="inputState" class="form-control" name="classification">
                            @foreach ($classification as $key => $label)
                            <option value="{{$key}}">{{$label}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="number_of_serials" class="form-label">Kata Kunci</label>
                        <input type="text" name="keyword" class="form-control" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-sm btn-icon icon-left btn-primary">
                        <i class="fa fa-search" style="margin-right: 5px"></i>
                        Cari Buku
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="modal fade" id="addCategoryModal" tabindex="-1" aria-labelledby="addCategoryModal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addSerialModalLabel">Tambah Kategori</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{route('admin.category.store')}}" method="post">
                <div class="modal-body">
                    @csrf
                    <div class="mb-3">
                        <label for="number_of_serials" class="form-label">Kode Kategori</label>
                        <input type="text" name="code" class="form-control" min="1" required>
                    </div>
                    <div class="mb-3">
                        <label for="number_of_serials" class="form-label">Nama</label>
                        <input type="text" name="name" class="form-control" min="1" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-sm btn-icon icon-left btn-success">
                        <i class="fa fa-save" style="margin-right: 5px"></i>
                        Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<style>
    .btn-utilities-card.add-category-card {
        background: linear-gradient(135deg, #6a11cb 0%, #2575fc 100%);
    }

    .btn-utilities-card.add-book-card {
        background: linear-gradient(135deg, #ff512f 0%, #dd2476 100%);
    }

    .btn-utilities-card.search-book-card {
        background: linear-gradient(135deg, #00c6ff 0%, #0072ff 100%);
    }

    .btn-utilities-card:hover {
        filter: brightness(80%);
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.3);
    }

    .btn-utilities-card:hover .card-icon {
        background-color: rgba(0, 0, 0, 0.3); 
    }

    .btn-utilities-card:hover .card-icon i,
    .btn-utilities-card:hover .card-header h4 {
        color: white;
    }

    /* Styles for Categories Cards */
    .btn-categories-card {
        transition: background-color 0.3s, box-shadow 0.3s;
    }

    .btn-categories-card:hover {
        background-color: rgba(0, 0, 0, 0.1); /* Light darken effect */
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.2);
    }

    .btn-categories-card:hover .card-icon {
        background-color: rgba(0, 0, 0, 0.2); /* Light darken effect */
    }

    .btn-categories-card:hover .card-icon i,
    .btn-categories-card:hover .card-icon p,
    .btn-categories-card:hover .card-header h4 {
        color: var(--text-white);
    }

    .card-header {
        background-color: #f8f9fa;
        border-bottom: 1px solid #e3e6f0;
    }

    .btn {
        border-radius: 0.25rem;
        transition: background-color 0.3s, box-shadow 0.3s;
        font-size: 16px;
        padding: 15px 20px;
        font-weight: bold;
        border: 2px solid transparent;
    }

    .btn:hover {
        background-color: #2c3e50;
        color: #ffffff;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }

    .card a {
        text-decoration: none;
    }

    .card a:hover {
        text-decoration: none;
    }

    .card:hover {
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }

    .modal-header {
        background-color: #f8f9fa;
        border-bottom: 1px solid #e3e6f0;
    }

    .modal-footer {
        background-color: #f8f9fa;
        border-top: 1px solid #e3e6f0;
    }
</style>
@endsection
