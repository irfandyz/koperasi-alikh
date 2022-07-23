<!DOCTYPE html
    PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
    <title>Cetak Jurnal Umum</title>
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

</style>

<body>
    <div class="book">
        <div class="page">
            <div class="subpage">
                <img src="{{ asset('logo_koperasi.jpg') }}" width="100%">
                <hr>
                <h3 style="color:black; font-family: sans;" align="center">LAPORAN SIMPANAN</h3>
                <p>Tanggal cetak : {{ date('d F Y', strtotime($awal)) }} &nbsp s.d
                    {{ date('d F Y', strtotime($akhir)) }} </p>
                <div id="outtable">
                    <div class="table-responsive">
                        <table class="table" width="100%">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Tanggal bayar</th>
                                    <th>Nama anggota</th>
                                    <th>Jenis setoran</th>
                                    <th>Jumlah</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($simpan as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ date('d F Y', strtotime($item->tgl_simpan)) }}</td>
                                        <td>{{ $item->anggota->nama_anggota }}</td>
                                        <td>{{ $item->jenissimpanan->nama_simpanan }}</td>
                                        <td>Rp.{{ number_format($item->besar_simpanan) }}</td>
                                    </tr>
                                @endforeach
                                <tr>
                                    <td colspan="4" style="text-align: right;">Total</td>
                                    <td>Rp. {{ number_format($simpan->sum('besar_simpanan')) }}</td>
                                </tr>
                            </tbody>
                        </table>



                    </div>

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
