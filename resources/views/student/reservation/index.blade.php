@extends('student.master')

@section('content')

<section class="section">
    <div class="section-header">
        <h1>Pengajuan Peminjaman</h1>
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
                                        <th style="text-align: center">Kode ISBN</th>
                                        <th style="text-align: center">Durasi Peminjaman</th>
                                        <th style="text-align: center">Tanggal Dibuat</th>
                                        <th style="text-align: center">Status</th>
                                        <th style="text-align: center">Keterangan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($studentReservation as $val)
                                    <tr>
                                        <td style="text-align: center">{{ $no++ }}</td>
                                        <td style="text-align: center">
                                            <form id="filterForm{{ $val->catalog->isbn }}" action="{{ route('student.catalog.filter') }}" method="get" style="display: none">
                                                @csrf
                                                <input type="text" name="classification" value="code">
                                                <input type="text" name="keyword" value="{{ $val->catalog->code }}">
                                            </form>
                                            <a href="javascript:void(0);" onclick="document.getElementById('filterForm{{ $val->catalog->code }}').submit();">
                                                {{ $val->catalog->isbn }}
                                            </a>
                                        </td>                                        
                                        <td style="text-align: center">{{ $val->duration }} Minggu</td>
                                        <td style="text-align: center">{{ $val->created_at }}</td>
                                        <td style="text-align: center">
                                            @if ($val->status == 'waiting')
                                                <div class="badge badge-primary">Menunggu Persetujuan</div>
                                            @elseif ($val->status == 'approved')
                                                <div class="badge badge-success">Disetujui</div>
                                            @else
                                                <div class="badge badge-danger">Ditolak</div>
                                            @endif
                                        </td>
                                        @if ($val->status == 'not_approved')
                                        <td style="text-align: center">
                                            {{$val->info}}
                                        </td>
                                        @else
                                        <td style="text-align: center">
                                            -
                                        </td>
                                        @endif
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
