@extends('master')

@section('content')
    <section class="section">
        <div class="section-header">
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
                <div class="breadcrumb-item"><a href="#">Components</a></div>
                <div class="breadcrumb-item">Siswa Peminjaman</div>
            </div>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            @if (session('error'))
                                <div class="alert alert-danger">{{ session('error') }}</div>
                            @endif

                            @if (isset($student))
                                <!-- Tampilkan Data Siswa -->
                                <h4>Data Siswa</h4>
                                <table class="table table-striped">
                                    <tr>
                                        <th>NISN</th>
                                        <td>{{ $student->nisn }}</td>
                                    </tr>
                                    <!-- Tambahkan field lainnya sesuai kebutuhan -->
                                </table>
                            @else
                                <!-- Form Input NISN -->
                                <form action="{{ route('loan.student.search') }}" method="post">
                                    @csrf
                                    <div class="form-group">
                                        <label for="nisn">NISN</label>
                                        <input type="number" class="form-control" id="nisn" name="nisn" required>
                                    </div>
                                    <button type="submit" class="btn btn-primary">Cari Data Siswa</button>
                                </form>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Bagian 2: Pencarian Buku dan Tampilan Data Buku -->
    @if (isset($student) && isset($buku))
        <section class="section">
            <div class="section-header">
                <h1>Peminjaman Buku</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
                    <div class="breadcrumb-item">Siswa Peminjaman</div>
                </div>
            </div>
            <div class="section-body">
                <!-- Tampilkan data buku dan form tambah buku jika diperlukan -->
                <div class="row">
                    <!-- Tampilkan data buku -->
                    <!-- ... -->
                </div>
            </div>
        </section>
    @endif
@endsection
