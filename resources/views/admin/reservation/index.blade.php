@extends('admin.master')

@section('content')

<section class="section">
    <div class="section-header">
        <h1>Data Reservasi Siswa</h1>
    </div>

    <div class="section-body">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped" id="table-1">
                                <thead>
                                    <tr>
                                        <th style="text-align: center">No.</th>
                                        <th style="text-align: center">Nama Peminjam</th>
                                        <th style="text-align: center">Status</th>
                                        <th style="text-align: center">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($reservation as $val)
                                    <tr>
                                        <td style="text-align: center">{{ $no++ }}</td>
                                        <td style="text-align: center">{{ $val->student->fullname }}</td>
                                        <td style="text-align: center">
                                            <div class="badge badge-warning">Menunggu Verifikasi</div>
                                        </td>
                                        <td style="text-align: center">
                                            <div class="d-inline-block">
                                                <form action="{{route('admin.reservation.show')}}" method="get">
                                                    @csrf
                                                    <input type="hidden" value="{{$val->student_id}}" name="student_id">
                                                    <button type="submit" class="btn-sm btn-icon icon-center btn-primary">
                                                        <i class="fas fa-search text-white icon-center"></i>
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
