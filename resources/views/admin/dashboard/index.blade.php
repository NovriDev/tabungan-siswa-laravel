@extends('admin.layouts.main')

@section('content')
    <h3 class="fw-semibold">Dashboard</h3>
    <h6>Menu ini berisi ringkasan dan statistik operasional Tabungan Siswa</h6>

    @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif
    <div class="row mt-4">
        @if (Auth::user()->level == 'Siswa')
        <div class="col-lg-6">
            <div class="card">
                <div class="card-body">
                    <h6>Nama Siswa</h6>
                    <h5>{{ $namaSiswa }}</h5>
                </div>
            </div>
        </div>
        @endif
        @if (Auth::user()->level == 'Walas')
        <div class="col-lg-6">
            <div class="card">
                <div class="card-body">
                    <h6>Nama Wali Kelas</h6>
                    <h5>{{ $namaWalas }}</h5>
                </div>
            </div>
        </div>
        @endif
        @if (Auth::user()->level == 'Walas')
        <div class="col-lg-6">
            <div class="card">
                <div class="card-body">
                    <h6>Wali Kelas</h6>
                    <h5>{{ $kelasWalas }}</h5>
                </div>
            </div>
        </div>
        @endif
        <div class="col-lg-6">
            <div class="card">
                <div class="card-body">
                    <h6>Total Siswa</h6>
                    <h5>{{ $jumlahDataSiswa }}</h5>
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="card">
                <div class="card-body">
                    <h6>Total Saldo</h6>
                    <h5>Rp {{ number_format($jumlahAllSaldo, 0, ',', '.') }}</h5>
                </div>
            </div>
        </div>
    </div>

    <div class="card mt-4">
        <div class="card-header">
            <h6>Saldo Siswa</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table" id="data-table">
                    <thead>
                        <tr>
                            <th>Nama</th>
                            <th>Total Saldo</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($dataSaldoSiswa as $siswa)
                            <tr>
                                <td>{{ $siswa->nama }}</td>
                                <td>Rp {{ number_format($siswa->total_saldo, 0, ',', '.') }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection


@section('scripts')
    <script src="{{ asset('template-admin/src/assets/js/dashboard.js') }}"></script>
    <script src="https://cdn.datatables.net/2.1.7/js/dataTables.js"></script>
    <script src="https://cdn.datatables.net/2.1.7/js/dataTables.bootstrap5.js"></script>
    <script>
        $(document).ready(function() {
            $('#data-table').DataTable();
        });
    </script>
@endsection
