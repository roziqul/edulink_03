@extends('admin.master')
@section('content')
<section class="section">
    <div class="section-body">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <table class="table table-striped table-sm table-bordered">
                            <tbody>
                                <tr>
                                    <th scope="row">Kode ISBN</th>
                                    <td colspan="5" id="alamat_op" style="width: 70%;">
                                        {{ $serialInfo->catalog->isbn }}
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row">Nomor Registrasi Buku</th>
                                    <td colspan="5" id="alamat_op" style="width: 70%;">
                                        {{ $serialInfo->serial_number }}
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row">Tanggal Registrasi Masuk</th>
                                    <td colspan="5" id="alamat_op" style="width: 70%;">
                                        {{ $createdDate->translatedFormat('d F Y / H:i') }}
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row">Petugas</th>
                                    <td colspan="5" id="alamat_op" style="width: 70%;">
                                        {{ $serialInfo->verified_by }}
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row">Status Buku</th>
                                    <td colspan="5" id="alamat_op" style="width: 70%;">
                                        @if ( $serialInfo->status == 'available')
                                            <div class="badge badge-success">Tersedia</div>
                                        @elseif ( $serialInfo->status == 'not_available')
                                            <div class="badge badge-primary">Dipinjam</div>
                                        @else
                                            <div class="badge badge-danger">Hilang</div>
                                        @endif  
                                    </td>
                                </tr>
                                @if ($serialInfo->status == 'not_available')
                                <tr>
                                    <th scope="row">Siswa Peminjam</th>
                                    <td colspan="5" id="alamat_op" style="width: 70%;">
                                        {{ $reservedInfo->student->fullname }}
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row">Tanggal Peminjaman</th>
                                    <td colspan="5" id="alamat_op" style="width: 70%;">
                                        {{ $startDate->translatedFormat('d F Y / H:i') }}
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row">Tanggal Selesai</th>
                                    <td colspan="5" id="alamat_op" style="width: 70%;">
                                        {{ $dueDate->translatedFormat('d F Y / H:i') }}
                                    </td>
                                </tr>                          
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>    
@endsection
