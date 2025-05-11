@extends('admin.layouts.main')

@section('styles')
    <!-- Select2 -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endsection

@section('content')
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title fw-semibold mb-4">Form Tambah Penarikan</h5>
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('penarikan.store') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="siswa" class="form-label">Siswa</label>
                                <select class="form-select form-select-2 @error('siswa') is-invalid @enderror"
                                    id="siswa" name="siswa">
                                    <option value="">Pilih Siswa</option>
                                    @foreach ($siswa as $item)
                                        <option value="{{ $item->id }}"
                                            {{ old('siswa') == $item->id ? 'selected' : '' }}>
                                            {{ $item->nama }}</option>
                                    @endforeach
                                </select>
                                @error('siswa')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="jumlah_penarikan" class="form-label">Jumlah Penarikan</label>
                                <input type="text" class="form-control @error('jumlah_penarikan') is-invalid @enderror"
                                    id="jumlah_penarikan" name="jumlah_penarikan" value="{{ old('jumlah_penarikan') }}"
                                    placeholder="Jumlah Penarikan">
                                @error('jumlah_penarikan')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <a href="{{ route('penarikan.index') }}" class="btn btn-outline-primary">Kembali</a>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        document.getElementById('jumlah_penarikan').addEventListener('keyup', function() {
            let jumlah = this.value;
            this.value = formatRupiah(jumlah);
        });

        function formatRupiah(angka) {
            const parameter = new Intl.NumberFormat('id-ID', {
                style: 'currency',
                currency: 'IDR',
                minimumFractionDigits: 0
            });
            return parameter.format(angka.replace(/[^0-9]/g, ''));
        }

        $(document).ready(function() {
            $('.form-select-2').select2();
        });
    </script>
@endsection
