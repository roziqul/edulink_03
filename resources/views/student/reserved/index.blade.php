@extends('master')

@section('content')
    <section class="section">
        <div class="section-header">
        <h1>Student</h1>
            <div class="section-header-breadcrumb">
              <div class="breadcrumb-item">Users</div>
              <div class="breadcrumb-item"><a href="{{route('student.index')}}">Student</a></div>
            </div>
        </div>

        <div class="section-body">
            <div class="row">
                <div class="col-12">
                  <div class="card">
                    <div class="card-body">
                      <div style="text-align:right">
                        <a href="{{route('student.create')}}" class="btn btn-icon icon-left btn-primary" style="margin-bottom: 10px; width:100px;">
                          <i class="fas fa-plus"></i>
                          Insert
                        </a>                      </div>
                      <div class="table-responsive">
                        <table class="table table-striped" id="table-1">
                          <thead>
                            <tr>
                                <th style="text-align: center">No.</th>
                                <th style="text-align: center">NISN</th>
                                <th style="text-align: center">Name</th>
                                <th style="text-align: center">Class</th>
                                <th style="text-align: center">Menu</th>
                            </tr>
                          </thead>
                          <tbody>
                            @foreach ($student as $val)
                            <tr>
                                <td style="text-align: center">{{$no++}}</td>
                                <td style="text-align: center">{{$val->nisn}}</td>
                                <td>{{$val->fullname}}</td>
                                <td style="text-align: center">{{$val->class}}</td>
                                <td style="text-align: center">
                                    <div class="d-inline-block">
                                        <button class="btn-sm btn-icon icon-center btn-primary">
                                            <a href="{{route('student.show', $val->id)}}" style="text-align: center">
                                                <i class="fas fa-search text-white icon-center"></i>
                                            </a>
                                        </button>                                                      
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