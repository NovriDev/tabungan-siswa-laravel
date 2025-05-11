<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title }} | Tabungan Siswa</title>
    <link rel="shortcut icon" type="image/png" href="{{ asset('template-admin/src/assets/images/logos/favicon.png') }}" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('template-admin/src/assets/css/styles.min.css') }}" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@latest/tabler-icons.min.css">   
    @yield('styles')
    <style>
        .logo-img {
            color: #000;
            /* Ganti warna teks sesuai kebutuhan */
            text-decoration: none;
            /* Menghilangkan garis bawah */
        }
    </style>
</head>

<body>
    <!--  Body Wrapper -->
    <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
        data-sidebar-position="fixed" data-header-position="fixed">
        <!-- Sidebar Start -->
        @include('admin.partials.sidebar')
        <!--  Sidebar End -->

        <!--  Main wrapper -->
        <div class="body-wrapper">
            <!--  Header Start -->
            @include('admin.partials.header')
            <!--  Header End -->

            <div class="container-fluid">
                <!--  Content Start  -->
                @yield('content')
                <!--  Content End  -->

                <!--  Footer Start -->
                @include('admin.partials.footer')
                <!--  Footer End -->
            </div>
        </div>
    </div>

    {{-- Modal untuk date picker --}}
    {{-- <div class="modal fade" id="tanggalModal" tabindex="-1" role="dialog" aria-labelledby="tanggalModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="tanggalModalLabel">Filter Tanggal</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('laporan') }}" method="GET">
                        @csrf
                        <div class="d-flex row g-4">
                            <div class="mb-3 col-md-6">
                                <label for="tanggal_awal" class="form-label">Dari Tanggal</label>
                                <input type="date" id="tanggal_awal" name="tanggal_awal" class="form-control"
                                    value="{{ request('tanggal_awal') }}">
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="tanggal_akhir" class="form-label">Sampai Tanggal</label>
                                <input type="date" id="tanggal_akhir" name="tanggal_akhir" class="form-control"
                                    value="{{ request('tanggal_akhir') }}">
                            </div>
                        </div>
                        <div class="d-flex justify-content-end">
                            <button type="submit" class="btn btn-outline-primary me-2">Kembali</button>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div> --}}

    <script src="{{ asset('template-admin/src/assets/libs/jquery/dist/jquery.min.js') }}"></script>
    <script src="{{ asset('template-admin/src/assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('template-admin/src/assets/js/sidebarmenu.js') }}"></script>
    <script src="{{ asset('template-admin/src/assets/js/app.min.js') }}"></script>
    <script src="{{ asset('template-admin/src/assets/libs/apexcharts/dist/apexcharts.min.js') }}"></script>
    <script src="{{ asset('template-admin/src/assets/libs/simplebar/dist/simplebar.js') }}"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script>
        @if (session('status'))
            swal('{{ session('title') }}', '{{ session('message') }}', '{{ session('status') }}');
        @endif
    </script>
    @yield('scripts')
</body>

</html>
