@extends('admin.template')
@section('style')
    <style>

    </style>
@endsection
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title"><button class="btn btn-secondary" data-toggle="modal" data-target="#exampleModal">
                            <span class="btn-label">
                                <i class="fa fa-plus"></i>
                            </span>
                            Pinjaman Sementara
                        </button>
                    </h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="basic-datatables" class="display table table-striped table-hover">
                            <thead>
                                <tr>
                                    <td>No</td>
                                    <td>Nama</td>
                                    <td>NIP</td>
                                    <td>No Kas</td>
                                    <td>Tanggal Mulai</td>
                                    <td>Besar Pinjaman</td>
                                    <td>Besar Pembayaran</td>
                                    <td>Keterangan</td>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($result as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $anggota->find($item->id_anggota)->nama_anggota }}</td>
                                        <td>{{ $item->nip }}</td>
                                        <td>{{ $item->no_kas }}</td>
                                        <td>{{ $item->tgl_mulai }}</td>
                                        <td>{{ $item->besar_pinjaman }}</td>
                                        <td>{{ $item->besar_pembayaran }}</td>
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
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <form method="post" action="{{ asset('tambahSementara') }}">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Tambah Data</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        @csrf
                        <div class="form-group">
                            <label>Nama Anggota</label>
                            <input class="form-control form-control-sm" onkeyup="search()" type="text" autocomplete="off"
                                id="name" name="nama">
                            <ul id="box"></ul>
                            <div id="afterComplete" class="d-none">
                                <label>NIP</label>
                                <input type="number" name="nip" id="nip" class="form-control form-control-sm">
                                <label>No kas</label>
                                <input type="text" name="no_kas" id="" class="form-control form-control-sm">
                                <label>Tanggal Mulai</label>
                                <input type="date" name="tgl_mulai" id="" class="form-control form-control-sm">
                                <label>Besar Pinjaman</label>
                                <input type="number" name="besar_pinjaman" id=""
                                    class="form-control form-control-sm">
                                <label>Besar Pembayaran</label>
                                <input type="number" name="besar_pembayaran" id=""
                                    class="form-control form-control-sm">
                                <label>Keterangan</label>
                                <input type="text" name="keterangan" id="" class="form-control form-control-sm">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <script>
        function search() {
            var x = document.getElementById('name');
            $.ajax({
                url: "{{ asset('api/searchAnggota') }}",
                type: "post",
                data: {
                    'key': x.value
                },
                success: function(response) {
                    $('#box').empty();
                    response.forEach(element => {
                        $('#box').append("<li class='custom-box' onclick='pick(`" + element[
                            'nama_anggota'] + "`,`" + element['nip'] + "`)'>" + element[
                                'nama_anggota'] +
                            " <i class='fas fa-check' style='float:right'></i></li>");
                    });
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.log(textStatus, errorThrown);
                }
            });
        }

        function pick(name, nip) {
            document.getElementById('name').value = name;
            document.getElementById('nip').value = nip;
            $('#box').empty();
            document.getElementById('afterComplete').classList.remove('d-none');
        }
    </script>
@endsection
