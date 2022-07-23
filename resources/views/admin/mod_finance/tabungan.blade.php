@extends('admin.template')
@section('style')
    <style>
        .custom {
            border-radius: 2px;
            border: solid 1px rgb(201, 201, 201);
            height: 30px;
            width: 230px;
        }
    </style>
@endsection
@section('content')
    @php
    function balance($id)
    {
        $balance = number_format(
            App\Models\Simpanan::where('id_anggota', $id)
                // ->whereNotIn('id_jenissimpanan', ['1', '4'])
                ->where('status', '1')
                ->sum('besar_simpanan') +
                App\Models\Transfer::where('id_penerima', $id)->sum('jumlah') -
                App\Models\Transfer::where('id_pengirim', $id)->sum('jumlah') -
                App\Models\Pengambilan::where('id_anggota', $id)->sum('besar_ambil'),
        );

        return $balance;
    }
    @endphp
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header row">
                    <div class="col-sm-6">
                        <span class="h4 mr-4">Saldo Tabungan</span>
                        <span class="card-title">
                            <a class="btn btn-primary text-white" href="{{ asset('laporanTabungan') }}">
                                <span class="btn-label">
                                    <i class="fa fa-file-alt"></i>
                                </span>
                                Cetak Laporan
                            </a>
                        </span>
                    </div>
                    <div class="col-sm-6 text-right">
                        <input type="text" class="custom" id="keyword" onkeyup="searchKey()">
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="display table table-striped table-hover" id="original">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama anggota</th>
                                    <th>Saldo</th>
                                    <th class="text-center">Riwayat</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($anggota as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->nama_anggota }}</td>
                                        <td>Rp.{{ balance($item->id_anggota) }}
                                        </td>
                                        <td class="text-center">
                                            <a href="#" class="text-primary"><i
                                                    class="fas fa-file-invoice-dollar fa-2x"
                                                    onclick="detail('{{ $item->id_anggota }}')"></i></a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <table class="display table table-striped table-hover d-none" id="search">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama anggota</th>
                                    <th>Saldo</th>
                                    <th class="text-center">Riwayat</th>
                                </tr>
                            </thead>
                            <tbody id="contentSearch">

                            </tbody>
                        </table>
                    </div>
                    <div id="page">
                        {{ $anggota->links('pagination::bootstrap-5') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        function searchKey() {
            const x = document.getElementById('keyword');
            const o = document.getElementById('original');
            const s = document.getElementById('search');
            const p = document.getElementById('page');
            const c = $('#contentSearch');

            const url = "{{ asset('') }}" + "getAnggota/" + x.value;
            if (!x.value == '') {
                o.classList.add('d-none');
                p.classList.add('d-none');
                s.classList.remove('d-none');
            } else {
                s.classList.add('d-none');
                o.classList.remove('d-none');
                p.classList.remove('d-none');
            }
            $.ajax({
                type: "GET",
                url: url,
                success: function(data) {
                    c.empty();
                    let num = 0;
                    data['anggota'].forEach(element => {
                        num = num + 1;
                        c.append("<tr> <td> " + num + " </td> <td> " + element["nama_anggota"] +
                            "</td><td> Rp.{{ balance("+element['nama_anggota']+") }}</td> <td class='text-center'><a href='' class='text-primary'><i class='fas fa-file-invoice-dollar fa-2x'></i></a></td></tr>"
                        );
                    });
                }
            });
        }

        function detail(id) {
            const url = "{{ asset('') }}" + "getRiwayat/" + id;
            $.ajax({
                type: "GET",
                url: url,
                success: function(data) {
                    console.log(data);
                }
            })
        }
    </script>
@endsection
