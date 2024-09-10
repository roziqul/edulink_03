@extends('master')

@section('content')
    <section class="section">
        <div class="section-header">
        <h1>Buku Hilang</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
                <div class="breadcrumb-item"><a href="#">Components</a></div>
                <div class="breadcrumb-item">Table</div>
            </div>
        </div>

        <div class="section-body">
            <div class="row">
                <div class="col-12">
                  <div class="card">
                    <div class="card-body">
                      {{-- <div style="text-align:right">
                        <a href="{{route('buku.peminjaman.inputmhs')}}" class="btn btn-primary" style="margin-bottom: 10px; width:150px;">Input Data</a>
                      </div> --}}
                      <div class="table-responsive">
                        <table class="table table-striped" id="table-1">
                          <thead>
                            <tr>
                                <th style="text-align: center">Nomor Seri</th>
                                <th style="text-align: center">Nama Peminjam</th>
                                <th style="text-align: center">Tanggal Peminjaman</th>
                                <th style="text-align: center">Tanggal Kehilangan</th>
                                <th style="text-align: center">Petugas</th>
                                <th style="text-align: center">Status</th>
                                <th style="text-align: center">Menu</th>
                            </tr>
                          </thead>
                          <tbody>
                            <tr>
                                <td style="text-align: center">337123091</td>
                                <td style="text-align: center">Mr. Nobody</td>
                                <td style="text-align: center">25 Jan 2024</td>
                                <td style="text-align: center">5 Feb 2024</td>
                                <td style="text-align: center">-</td>
                                <td style="text-align: center">
                                    <div class="badge badge-warning">Menunggu Persetujuan</div>
                                </td>
                                <td style="text-align: center"><a href="{{route('buku.hilang.show')}}" class="btn btn-primary">Detail</a></td>
                            </tr>
                            <tr>
                                <td style="text-align: center">337123091</td>
                                <td style="text-align: center">Mr. Nobody</td>
                                <td style="text-align: center">25 Jan 2024</td>
                                <td style="text-align: center">5 Feb 2024</td>
                                <td style="text-align: center">Pak Nobody</td>
                                <td style="text-align: center">
                                    <div class="badge badge-success">Approved</div>
                                </td>
                                <td style="text-align: center"><a href="{{route('buku.hilang.show')}}" class="btn btn-primary">Detail</a></td>
                            </tr>
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