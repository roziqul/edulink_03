@extends('master')

@section('content')
<section class="section">
    <div class="section-header">
        <h1>Detail Kehilangan</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="#" onclick="loadPage('dashboard.php')">Dashboard</a></div>
            <div class="breadcrumb-item">Status NOP</div>
        </div>
    </div>
    <div class="section-body">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-9">
                                <strong>
                                    <h4>Data Peminjam</h4>
                                </strong>
                                <table class="table table-striped table-sm table-bordered mb-5">
                                    <tbody>
                                        <tr>
                                            <th scope="row">Nama Siswa</th>
                                            <td colspan="5" id="nama_wp" style="width: 70%;">Mr. Nobody</td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Kelas</th>
                                            <td colspan="5" id="alamat_wp">12 MIPA 7</td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Alamat Siswa</th>
                                            <td colspan="5" id="alamat_wp">Jl. AA 70mm No.27</td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Nomor Telepon Siswa</th>
                                            <td colspan="5" id="alamat_wp">+6281232333251</td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Tanggal Pengajuan</th>
                                            <td colspan="5" id="alamat_wp">25 Jan 2024</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="col-3">
                                <div class="card">
                                    <div class="card-body">
                                        <img src="https://e7.pngegg.com/pngimages/938/268/png-clipart-madagascar-penguins-madagascar-penguins-thumbnail.png" alt="Girl in a jacket" style="width: 100%"> 
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-8">
                                <strong>
                                    <h4>Detail Buku</h4>
                                </strong>
                                <table class="table table-striped table-sm table-bordered">
                                    <tbody>
                                        <tr>
                                            <th scope="row">Nomor Seri</th>
                                            <td colspan="5" id="alamat_op" style="width: 70%;">
                                                <a href="{{route ('buku.peminjaman.show')}}">
                                                    337123091
                                                </a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Kategori</th>
                                            <td colspan="5" id="alamat_op" style="width: 70%;">PELAJARAN</td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Judul</th>
                                            <td colspan="5" id="alamat_op" style="width: 70%;">MODUL PEMBELAJARAN TAHUN 2025</td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Penyusun</th>
                                            <td colspan="5" id="alamat_op" style="width: 70%;">Itsuki Takahashi</td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Penerbit</th>
                                            <td colspan="5" id="alamat_op" style="width: 70%;">SD BORCELLE</td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Tahun Terbit</th>
                                            <td colspan="5" id="alamat_op" style="width: 70%;">2025</td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Harga Satuan</th>
                                            <td colspan="5" id="alamat_op" style="width: 70%;">Rp. 113.500,00</td>
                                        </tr>
                                    </tbody>
                                </table>
                                <form action="#" method="" enctype="multipart/form-data">
                                    {{-- <input type="hidden" class="form-control" id="title" value="" name="title"> --}}
                                    <div style="text-align: right">
                                        <a href="{{route('buku.hilang.index')}}" class="btn btn-danger">Verifikasi Kehilangan</a>
                                    </div>
                                </form>
                            </div>
                            <div class="col-4">
                                <div class="card">
                                    <div class="card-body">
                                        <img src="https://marketplace.canva.com/EAF57cpiHJw/1/0/1131w/canva-biru-oranye-modern-profesional-cover-modul-dokumen-a4-8UR5peyyTlA.jpg" alt="Girl in a jacket" style="width: 100%"> 
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection