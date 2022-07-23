<!DOCTYPE html
    PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
    <title>LAPORAN {{ $type }}</title>
</head>
<style type="text/css">
    /* Kode CSS Untuk PAGE ini dibuat oleh http://jsfiddle.net/2wk6Q/1/ */
    body {
        width: 100%;
        height: 100%;
        margin: 0;
        padding: 0;
        font: 10pt "Tahoma";
    }

    * {
        box-sizing: border-box;
        -moz-box-sizing: border-box;
    }

    .page {
        width: 230mm;
        min-height: 297mm;
        padding: 20mm;
        margin: 10mm auto;
        border: 1px #D3D3D3 solid;
        border-radius: 5px;

        box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
    }

    .subpage {
        padding: .2 cm;
        border: 1px #F8F8FF solid;
        height: 257mm;
        outline: 2.5cm #FFFFFF solid;
    }

    @page {
        size: A4;
        margin: 0;
    }

    @media print {

        html,
        body {
            width: 200mm;
            height: 297mm;
        }

        .page {
            margin: 0;
            border: initial;
            border-radius: initial;
            width: initial;
            min-height: initial;
            box-shadow: initial;
            background: initial;
            page-break-after: always;
        }
    }

    .table,
    th,
    tr,
    td {
        padding-left: 5px;
        border-collapse: collapse;
        border: 1px solid black;
        border-width: 1px;
        bg-color: black;
    }

    .w-100 {
        width: 100%;
    }

    .text-center {
        text-align: center;
    }

</style>

<body>
    <div class="book">
        <div class="page">
            <div class="subpage">
                <img src="{{ asset('logo_koperasi.jpg') }}" width="100%">
                <hr>
                <h3 style="color:black; font-family: sans;" align="center">LAPORAN {{ $type }}</h3>
                <p>Tanggal cetak : {{ date('d F Y', strtotime($request->TanggalAwal)) }} &nbsp s.d
                    {{ date('d F Y', strtotime($request->TanggalAkhir)) }} </p>
                <div id="outtable">
                    <div class="table-responsive">
                        @if ($type == 'JURNAL UMUM')
                            <table class="table" width="100%">
                                <thead>
                                    <tr>
                                        <th width="5%">NO</th>
                                        <th width="20%" class="text-center">Tanggal</th>
                                        <th class="text-center">Kategori</th>
                                        <th class="text-center">Ref</th>
                                        <th class="text-center">Debit</th>
                                        <th class="text-center">Kredit</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($transaksi as $item)
                                        <tr>
                                            <td class="text-center">{{ $loop->iteration }}</td>
                                            <td class="text-center">
                                                {{ date('d F Y', strtotime($item->created_at)) }}<br></td>
                                            <td>{{ $item->kategori->nama_kategori }}</td>
                                            <td>{{ $item->kategori->kode }}</td>
                                            <td>
                                                Rp.{{ $item->kategori->id_jenis_transaksi == '2' ? number_format($item->nominal) : '0' }}
                                            </td>
                                            <td>
                                                Rp.{{ $item->kategori->id_jenis_transaksi == '1' ? number_format($item->nominal) : '0' }}
                                            </td>
                                        </tr>
                                    @endforeach
                                    <tr>
                                        <td colspan="4" style="text-align: right;">Total</td>
                                        <td>Rp. {{ number_format($debit) }}</td>
                                        <td>Rp. {{ number_format($kredit) }} </td>
                                    </tr>
                                </tbody>
                            </table>
                        @elseif ($type == 'BUKU BESAR')
                            @foreach ($kategori as $item)
                                <table class="table w-100" style="margin-top: 30px">
                                    <thead>
                                        <tr>
                                            <th colspan="2">NAMA KATEGORI : {{ $item->nama_kategori }} </th>
                                            <th colspan="2">KODE : {{ $item->kode }} </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>Tanggal</td>
                                            <td>Keterangan</td>
                                            <td>Debit</td>
                                            <td>Kredit</td>
                                        </tr>
                                        @foreach ($transaksi->where('id_kategori_transaksi', $item->id_kategori_transaksi) as $data)
                                            <tr>
                                                <td>{{ date('d F Y', strtotime($data->created_at)) }}</td>
                                                <td>{{ $data->keterangan }}</td>
                                                <td>{{ $item->id_jenis_transaksi == '2' ? 'Rp. ' . number_format($data->nominal) : '' }}
                                                </td>
                                                <td>{{ $item->id_jenis_transaksi == '1' ? 'Rp. ' . number_format($data->nominal) : '' }}
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            @endforeach
                        @elseif ($type == 'NERACA SALDO')
                            <table class="table w-100" style="margin-top: 30px">
                                <thead>
                                    <tr>
                                        <th>KODE</th>
                                        <th>KATEGORI</th>
                                        <TH>DEBIT</TH>
                                        <TH>KREDIT</TH>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $kredit = 0;
                                    $debit = 0;
                                    ?>
                                    @foreach ($kategori as $item)
                                        <tr>
                                            <td>{{ $item->kode }}</td>
                                            <td>{{ $item->nama_kategori }}</td>
                                            <td>Rp.{{ $item->id_jenis_transaksi == '2'? number_format($transaksi->where('id_kategori_transaksi', $item->id_kategori_transaksi)->sum('nominal')): '0' }}
                                            </td>
                                            <?php $item->id_jenis_transaksi == '2' ? ($debit = $debit + $transaksi->where('id_kategori_transaksi', $item->id_kategori_transaksi)->sum('nominal')) : '0'; ?>
                                            <?php $item->id_jenis_transaksi == '1' ? ($kredit = $kredit + $transaksi->where('id_kategori_transaksi', $item->id_kategori_transaksi)->sum('nominal')) : '0'; ?>
                                            <td>Rp.{{ $item->id_jenis_transaksi == '1'? number_format($transaksi->where('id_kategori_transaksi', $item->id_kategori_transaksi)->sum('nominal')): '0' }}
                                            </td>
                                        </tr>
                                    @endforeach
                                    <tr>
                                        <td colspan="2" align="center">Total</td>
                                        <td>Rp. {{ number_format($debit) }}</td>
                                        <td>Rp. {{ number_format($kredit) }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        @elseif ($type == 'INCOME STATEMENT')
                            <table class="table w-100" style="margin-top: 30px">
                                <thead>
                                    <?php $debit = 0;
                                    $kredit = 0; ?>
                                    @foreach ($jenis as $item)
                                        <tr>
                                            <th>{{ strtoupper($item->nama_jenis_transaksi) }}</th>
                                            <th>DEBIT</th>
                                            <TH>KREDIT</TH>
                                        </tr>
                                        @foreach ($kategori->where('id_jenis_transaksi', $item->id_jenis_transaksi) as $data)
                                            <tr>
                                                <td>{{ strtoupper($data->nama_kategori) }}</td>
                                                <td>Rp.
                                                    {{ $item->ket == 'debit'? number_format($transaksi->where('id_kategori_transaksi', $data->id_kategori_transaksi)->sum('nominal')): '0' }}
                                                    <?php
                                                    $item->ket == 'debit' ? number_format($debit = $debit + $transaksi->where('id_kategori_transaksi', $data->id_kategori_transaksi)->sum('nominal')) : '0'; ?>
                                                </td>
                                                <td>Rp.
                                                    {{ $item->ket == 'kredit'? number_format($transaksi->where('id_kategori_transaksi', $data->id_kategori_transaksi)->sum('nominal')): '0' }}
                                                    <?php
                                                    $item->ket == 'kredit' ? number_format($kredit = $kredit + $transaksi->where('id_kategori_transaksi', $data->id_kategori_transaksi)->sum('nominal')) : '0'; ?>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @endforeach
                                    <tr>
                                        <td style="font-weight: bold" align="center">Total</td>
                                        <td style="font-weight: bold">Rp. {{ number_format($debit) }}</td>
                                        <td style="font-weight: bold">Rp. {{ number_format($kredit) }}</td>
                                    </tr>
                                    <tr>
                                        <td style="font-weight: bold" align="center">LABA / RUGI</td>
                                        <td style="font-weight: bold" align="center" colspan="2">Rp.
                                            {{ number_format($debit - $kredit) }}</td>
                                    </tr>
                                </thead>
                            </table>
                        @endif
                        <p>Cirebon, {{ date('d F Y') }} </p><br><br><br>
                        <p>(__________________)<br> &nbsp &nbsp Koperasi<br></p>

                    </div>
                </div>
            </div>


            <script>
                window.print();
            </script>
        </div>
</body>

</html>
