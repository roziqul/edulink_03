@extends('admin.master')

@section('content')
    <section class="section">
        <div class="section-header">
          <h1>Data Administrator</h1>
        </div>

        <div class="section-body">
            <div class="row">
                <div class="col-12">
                  <div class="card">
                    <div class="card-body">
                      <div style="text-align:right">
                        <a href="{{route('admin-data.create')}}" class="btn btn-icon icon-left btn-primary" style="margin-bottom: 10px; width:100px;">
                          <i class="fas fa-plus"></i>
                          Tambah
                        </a>
                      </div>
                      <div class="table-responsive">
                        <table class="table table-striped" id="table-1">
                          <thead>
                            <tr>
                                <th style="text-align: center">No.</th>
                                <th style="text-align: center">Nama Pegawai</th>
                                <th style="text-align: center">Email</th>
                                <th style="text-align: center">Tanggal Dibuat</th>
                                <th style="text-align: center">Tanggal Diperbarui</th>
                                <th style="text-align: center">Aksi</th>
                            </tr>
                          </thead>
                          <tbody>
                            @foreach ($administrator as $val)
                            <tr>
                              <td style="text-align: center">{{$no++}}</td>
                              <td style="text-align: center">{{$val->fullname}}</td>
                              <td style="text-align: center">{{$val->email}}</td>
                              <td style="text-align: center">{{$val->created_at}}</td>
                              <td style="text-align: center">{{$val->updated_at}}</td>
                              <td style="text-align: center">
                                <div class="d-inline-block">
                                    <form action="{{route('admin-data.edit', $val->id)}}" method="get">
                                        @csrf
                                        <button type="submit" class="btn-sm btn-icon icon-center bg-transparent">
                                            <i class="fas fa-pen text-primary"></i>
                                        </button>
                                    </form>
                                </div> 
                                <div class="d-inline-block">
                                    <form action="{{route('admin-data.show', $val->id)}}" method="get">
                                        @csrf
                                        <button type="submit" class="btn-sm btn-icon icon-center btn-primary">
                                            <i class="fas fa-search text-white icon-center"></i>
                                        </button>
                                    </form>
                                </div>
                                <div class="d-inline-block">
                                    <form action="{{route('admin-data.destroy', $val->id)}}" method="post">
                                    <form action="#" method="get">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn-sm btn-icon icon-center btn-danger">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                              </td>
                            </tr>
                            @endforeach
                          </tbody>
                        </table>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
        </div>
    </section>
@endsection