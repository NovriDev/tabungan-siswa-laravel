@extends('admin.layouts.main')

@section('styles')
    <link rel="stylesheet" href="https://cdn.datatables.net/2.1.7/css/dataTables.bootstrap5.css">
@endsection

@section('content')
    <h3 class="fw-semibold">Penarikan</h3>
    <h6>Menu ini digunakan untuk mencatat dan mengelola data penarikan</h6>
    <div class="card mt-4">
        <div class="card-body">
            <a href="{{ route('penarikan.create') }}" class="btn btn-primary mb-4"><i class="ti ti-plus mr-2"></i>Tambah
                Penarikan</a>
            <div class="table-responsive">
                <table id="data-table" class="table table-striped table-bordered w-100">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Penarikan</th>
                            <th>Tanggal Transaksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($tabungan as $key => $item)
                            <tr class="align-middle">
                                <td>{{ $key + 1 }}</td>
                                <td>{{ $item->siswa->nama }}</td>
                                <td class="text-danger">Rp -{{ number_format($item->saldo, 0, ',', '.') }}</td>
                                <td>{{ \Carbon\Carbon::parse($item->tanggal_transaksi)->format('d F Y h:i:s') }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="https://cdn.datatables.net/2.1.7/js/dataTables.js"></script>
    <script src="https://cdn.datatables.net/2.1.7/js/dataTables.bootstrap5.js"></script>
    <script>
        $(document).ready(function() {
            $('#data-table').DataTable();
        });
    </script>
@endsection
