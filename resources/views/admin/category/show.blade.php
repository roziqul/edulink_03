@extends('admin.master')
@section('content')
<section class="section">
    <div class="section-body">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <div>
                                <a href="{{route('admin.category.index')}}" class="btn btn-icon btn-icon-left btn-primary" style="margin-bottom: 30px; width:120px;">
                                    <i class="fas fa-angle-left mx-1"></i>
                                    Kembali
                                </a>
                            </div>
                            <div>
                                <a href="#" data-toggle="modal" data-target="#editCategoryModal" class="btn btn-icon btn-icon-left btn-primary" style="margin-bottom: 30px; width:120px;">
                                    <i class="fas fa-pen mx-1"></i>
                                    Edit Data
                                </a>
                            </div>
                        </div>                        
                        <table class="table table-striped table-sm table-bordered">
                            <tbody>
                                <tr>
                                    <th scope="row">Kode</th>
                                    <td colspan="5" id="alamat_op" style="width: 70%;">{{ $category->code }}
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row">Nama</th>
                                    <td colspan="5" id="alamat_op" style="width: 70%;">{{ $category->name }}
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row">Tanggal dibuat</th>
                                    <td colspan="5" id="alamat_op" style="width: 70%;">{{ $createdDate->translatedFormat('d F Y / H:i') }}
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row">Terakhir diperbarui</th>
                                    <td colspan="5" id="alamat_op" style="width: 70%;">{{ $updatedDate->translatedFormat('d F Y / H:i') }}
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row">Dibuat oleh</th>
                                    <td colspan="5" id="alamat_op" style="width: 70%;">
                                        @if ($category->verified_by)
                                            {{ $category->verified_by }}
                                        @else
                                            -
                                        @endif  
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row">Jumlah Katalog</th>
                                    <td colspan="5" id="alamat_op" style="width: 70%;">{{ $count }}
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <table class="table table-striped" id="table-1">
                            <thead>
                                <tr>
                                    <th style="text-align: center">Kode ISBN</th>
                                    <th style="text-align: center">Judul</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($category->catalogs as $val)
                                    <tr>
                                        <td style="text-align: center">
                                            <a href="{{route('admin.catalog.show', $val->id)}}">{{ $val->isbn }}</a>
                                        </td>
                                        <td>{{ $val->title }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>    
<div class="modal fade" id="editCategoryModal" tabindex="-1" aria-labelledby="editCategoryModal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addSerialModalLabel">Edit Kategori</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{route('admin.category.update')}}" method="post">
                <div class="modal-body">
                    @csrf
                    <div class="mb-3">
                        <label for="number_of_serials" class="form-label">Kode Kategori</label>
                        <input type="text" name="code" value="{{$category->code}}" class="form-control" min="1" required>
                    </div>
                    <div>
                        <label for="number_of_serials" class="form-label">Nama Kategori</label>
                        <input type="text" name="name" value="{{$category->name}}" class="form-control" min="1" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-md btn-icon icon-left btn-primary">
                        <i class="fa fa-save" style="margin-right: 5px"></i>
                        Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
