@extends('admin.template')
@section('style')
    {{-- <script src="{{ asset('assets/jsChart.js') }}"></script> --}}
    <style>
        .icon {
            width: 3rem;
            height: 3rem;
        }

        .icon i,
        .icon svg {
            font-size: 2.25rem;
        }

        .icon+.icon-text {
            width: calc(100% - 3rem - 1);
            padding-left: 1rem;
        }

        .icon-xl {
            width: 5rem;
            height: 5rem;
        }

        .icon-xl i,
        .icon-xl svg {
            font-size: 4.25rem;
        }

        .icon-xl+.icon-text {
            width: calc(100% - 5rem - 1);
        }

        .icon-lg {
            width: 4rem;
            height: 4rem;
        }

        .icon-lg i,
        .icon-lg svg {
            font-size: 3.25rem;
        }

        .icon-lg+.icon-text {
            width: calc(100% - $icon-size-lg - 1);
        }

        .icon-sm {
            width: 2rem;
            height: 2rem;
        }

        .icon-sm i,
        .icon-sm svg {
            font-size: 1.25rem;
        }

        .icon-sm+.icon-text {
            width: calc(100% - $icon-size-sm - 1);
        }

        .icon-xs {
            width: 1.25rem;
            height: 1.25rem;
        }

        .icon-xs i,
        .icon-xs svg {
            font-size: .5rem;
        }

        .icon-xs+.icon-text {
            width: calc(100% - $icon-size-xs - 1);
        }

        .icon-actions>a {
            font-size: .875rem;

            display: inline-block;

            margin-right: .75rem;

            color: #8898aa;
        }

        .icon-actions>a:last-of-type {
            margin-right: 0;
        }

        .icon-actions>a span {
            font-weight: 600;

            margin-left: .1875rem;

            color: #8898aa;
        }

        .icon-actions>a:hover span {
            color: #6a7e95;
        }

        .icon-actions>a,
        .icon-actions>a:hover,
        .icon-actions>a.active {
            color: #32325d;
        }

        .icon-actions>.favorite:hover,
        .icon-actions>.favorite.active {
            color: #ffd600;
        }

        .icon-actions>.love:hover,
        .icon-actions>.love.active {
            color: #f5365c;
        }

        .icon-actions>.like:hover,
        .icon-actions>.like.active {
            color: #5e72e4;
        }

        .icon-actions-lg a {
            font-size: 1.25rem;

            margin-right: .875rem;
        }

        .icon-shape {
            display: inline-flex;

            padding: 12px;

            text-align: center;

            border-radius: 50%;

            align-items: center;
            justify-content: center;
        }

        .icon-shape i,
        .icon-shape svg {
            font-size: 1.25rem;
        }

        .icon-shape.icon-lg i,
        .icon-shape.icon-lg svg {
            font-size: 1.625rem;
        }

        .icon-shape.icon-sm i,
        .icon-shape.icon-sm svg {
            font-size: .875rem;
        }

        .icon-shape.icon-xs i,
        .icon-shape.icon-xs svg {
            font-size: .6rem;
        }

        .icon-shape svg {
            width: 30px;
            height: 30px;
        }

        .icon-shape-primary {
            color: #2643e9;
            background-color: rgba(138, 152, 235, .5);
        }

        .icon-shape-secondary {
            color: #cfe3f1;
            background-color: rgba(255, 255, 255, .5);
        }

        .icon-shape-success {
            color: #1aae6f;
            background-color: rgba(84, 218, 161, .5);
        }

        .icon-shape-info {
            color: #03acca;
            background-color: rgba(65, 215, 242, .5);
        }

        .icon-shape-warning {
            color: #ff3709;
            background-color: rgba(252, 140, 114, .5);
        }

        .icon-shape-danger {
            color: #f80031;
            background-color: rgba(247, 103, 131, .5);
        }

        .icon-shape-light {
            color: #879cb0;
            background-color: rgba(201, 207, 212, .5);
        }

        .icon-shape-dark {
            color: #090c0e;
            background-color: rgba(56, 63, 69, .5);
        }

        .icon-shape-default {
            color: #091428;
            background-color: rgba(35, 65, 116, .5);
        }

        .icon-shape-white {
            color: #e8e3e3;
            background-color: rgba(255, 255, 255, .5);
        }

        .icon-shape-neutral {
            color: #e8e3e3;
            background-color: rgba(255, 255, 255, .5);
        }

        .icon-shape-darker {
            color: black;
            background-color: rgba(26, 26, 26, .5);
        }

        .bg-gradient-primary {
            background: linear-gradient(87deg, #5e72e4 0, #825ee4 100%) !important;
        }

        .bg-gradient-secondary {
            background: linear-gradient(87deg, #f7fafc 0, #f7f8fc 100%) !important;
        }

        .bg-gradient-success {
            background: linear-gradient(87deg, #2dce89 0, #2dcecc 100%) !important;
        }

        .bg-gradient-info {
            background: linear-gradient(87deg, #11cdef 0, #1171ef 100%) !important;
        }

        .bg-gradient-warning {
            background: linear-gradient(87deg, #fb6340 0, #fbb140 100%) !important;
        }

        .bg-gradient-danger {
            background: linear-gradient(87deg, #f5365c 0, #f56036 100%) !important;
        }

        .bg-gradient-light {
            background: linear-gradient(87deg, #adb5bd 0, #adaebd 100%) !important;
        }

        .bg-gradient-dark {
            background: linear-gradient(87deg, #212529 0, #212229 100%) !important;
        }

        .bg-gradient-default {
            background: linear-gradient(87deg, #172b4d 0, #1a174d 100%) !important;
        }

        .bg-gradient-white {
            background: linear-gradient(87deg, #fff 0, white 100%) !important;
        }

        .bg-gradient-neutral {
            background: linear-gradient(87deg, #fff 0, white 100%) !important;
        }

        .bg-gradient-darker {
            background: linear-gradient(87deg, black 0, black 100%) !important;
        }

        .bg-gradient-blue {
            background: linear-gradient(87deg, #5e72e4 0, #825ee4 100%) !important;
        }

        .bg-gradient-indigo {
            background: linear-gradient(87deg, #5603ad 0, #9d03ad 100%) !important;
        }

        .bg-gradient-purple {
            background: linear-gradient(87deg, #8965e0 0, #bc65e0 100%) !important;
        }

        .bg-gradient-pink {
            background: linear-gradient(87deg, #f3a4b5 0, #f3b4a4 100%) !important;
        }

        .bg-gradient-red {
            background: linear-gradient(87deg, #f5365c 0, #f56036 100%) !important;
        }

        .bg-gradient-orange {
            background: linear-gradient(87deg, #fb6340 0, #fbb140 100%) !important;
        }

        .bg-gradient-yellow {
            background: linear-gradient(87deg, #ffd600 0, #beff00 100%) !important;
        }

        .bg-gradient-green {
            background: linear-gradient(87deg, #2dce89 0, #2dcecc 100%) !important;
        }

        .bg-gradient-teal {
            background: linear-gradient(87deg, #11cdef 0, #1171ef 100%) !important;
        }

        .bg-gradient-cyan {
            background: linear-gradient(87deg, #2bffc6 0, #2be0ff 100%) !important;
        }

        .bg-gradient-white {
            background: linear-gradient(87deg, #fff 0, white 100%) !important;
        }

        .bg-gradient-gray {
            background: linear-gradient(87deg, #8898aa 0, #888aaa 100%) !important;
        }

        .bg-gradient-gray-dark {
            background: linear-gradient(87deg, #32325d 0, #44325d 100%) !important;
        }

        .bg-gradient-light {
            background: linear-gradient(87deg, #ced4da 0, #cecfda 100%) !important;
        }

        .bg-gradient-lighter {
            background: linear-gradient(87deg, #e9ecef 0, #e9eaef 100%) !important;
        }

    </style>
    <script src="http://keuangan.almaarif-school.online/assets/js/Chart.js"></script>
    <style type="text/css">
        .container {
            width: 40%;
            margin: 15px auto;
        }

    </style>
@endsection
@section('content')
    <div class="container-fluid mt--6">
        <div class="row">
            <div class="col-xl-3 col-md-6">
                <div class="card card-stats">
                    <!-- Card body -->
                    <div class="card-body">
                        <div class="row">
                            <div class="col">
                                <h4 class=" text-uppercase  mb-0">Total Pengeluaran</h5>
                                    <span class="text-primary h5 font-weight-bold mb-0">Rp.
                                        {{ number_format($debit->sum('nominal')) }}</span></span>
                            </div>
                            <div class="col-auto">
                                <div class="icon icon-shape bg-gradient-red text-white rounded-circle shadow"
                                    title="Rp. 225,601,000">
                                    <i class="fas fa-money-bill-wave-alt"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6">
                <div class="card card-stats">
                    <!-- Card body -->
                    <div class="card-body">
                        <div class="row">
                            <div class="col">
                                <h4 class=" text-uppercase  mb-0">Total Pemasukan</h5>
                                    <span class="text-primary h5 font-weight-bold mb-0">Rp.
                                        {{ number_format($kredit->sum('nominal')) }}</span>
                            </div>
                            <div class="col-auto">
                                <div class="icon icon-shape bg-gradient-orange text-white rounded-circle shadow">
                                    <i class="fas fa-money-bill-wave-alt"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6">
                <div class="card card-stats">
                    <!-- Card body -->
                    <div class="card-body">
                        <div class="row">
                            <div class="col">
                                <h4 class=" text-uppercase  mb-0">Jumlah Mitra</h5>
                                    <span class="text-primary h5 font-weight-bold mb-0">{{ $anggota->count() }}</span>
                            </div>
                            <div class="col-auto">
                                <div class="icon icon-shape bg-gradient-green text-white rounded-circle shadow">
                                    <i class="fas fa-users"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6">
                <div class="card card-stats">
                    <!-- Card body -->
                    <div class="card-body">
                        <div class="row">
                            <div class="col">
                                <h4 class=" text-uppercase  mb-0">Total Transaksi</h5>
                                    <span class="text-primary h5 font-weight-bold mb-0">{{ $transaksi->count() }}</span>
                            </div>
                            <div class="col-auto">
                                <div class="icon icon-shape bg-gradient-info text-white rounded-circle shadow">
                                    <i class="fas fa-chart-bar"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xl-6">
                <div class="card">
                    <div class="card-header">
                        <h6 class="surtitle">Review</h6>
                        <h5 class="h3 mb-0">Pengeluaran Terbaru</h5>
                    </div>
                    <div class="card-body">
                        <div class="chart">
                            <div class="table-responsive py-4">
                                <table class="table table-flush" id="datatable-basic">
                                    <thead class="thead-light">
                                        <tr>
                                            <th width="50px">No</th>
                                            <th>Kategori</th>
                                            <th>Nominal</th>
                                            <th>Keterangan</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($debit->take(5) as $item)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $item->kategori->nama_kategori }}</td>
                                                <td>Rp. {{ number_format($item->nominal) }}</td>
                                                <td>{{ $item->keterangan }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-6">
                <div class="card">
                    <div class="card-header">
                        <h6 class="surtitle">Review</h6>
                        <h5 class="h3 mb-0">Pemasukan Terbaru</h5>
                    </div>
                    <div class="card-body">
                        <div class="chart">
                            <div class="table-responsive py-4">
                                <table class="table table-flush" id="datatable-basic">
                                    <thead class="thead-light">
                                        <tr>
                                            <th width="50px">No</th>
                                            <th>Kategori</th>
                                            <th>Nominal</th>
                                            <th>Keterangan</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($kredit->take(5) as $item)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $item->kategori->nama_kategori }}</td>
                                                <td>Rp. {{ number_format($item->nominal) }}</td>
                                                <td>{{ $item->keterangan }}</td>
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
        <div class="row">
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-header">
                        <h6 class="surtitle">Grafik</h6>
                        <h5 class="h3 mb-0">Transaksi</h5>
                    </div>
                    <div class="card-body">
                        <iframe width="100%" height="400" src="{{ asset('grafikTransaksi') }}">
                        </iframe>
                    </div>
                </div>
            </div>
        </div>
        <footer class="footer pt-0">
            <div class="row align-items-center justify-content-lg-between">
                <div class="col-lg-6">
                    <div class="copyright text-center text-lg-left ">
                        &copy; 2021 <a href="http://jagatgenius.com" class="font-weight-bold ml-1" target="_blank">PT.
                            JAGAT DIGITAL INDONESIA</a>
                    </div>
                </div>
                <div class="col-lg-6">
                    <ul class="nav nav-footer justify-content-center justify-content-lg-end">
                        <li class="nav-item">
                            <a href="http://jagatgenius.com" class="nav-link" target="_blank">Creative Tim</a>
                        </li>
                        <li class="nav-item">
                            <a href="http://jagatgenius.com" class="nav-link" target="_blank">About Us</a>
                        </li>
                        <li class="nav-item">
                            <a href="http://jagatgenius.com" class="nav-link" target="_blank">Blog</a>
                        </li>
                        <li class="nav-item">
                            <a href="http://jagatgenius.com" class="nav-link" target="_blank">License</a>
                        </li>
                    </ul>
                </div>
            </div>
        </footer>
    </div>
@endsection
