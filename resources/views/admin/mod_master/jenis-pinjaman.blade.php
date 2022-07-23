@extends('admin.template')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title"><button class="btn btn-secondary" data-toggle="modal" data-target="#exampleModal">
                            <span class="btn-label">
                                <i class="fa fa-plus"></i>
                            </span>
                            Jenis Pinjaman
                        </button></h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="basic-datatables" class="display table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Pinjaman</th>
                                    <th>Lama Angsuran</th>
                                    <th>Maksimal Pinjaman</th>
                                    <th>Bunga</th>
                                    <th>Petugas</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($record as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->nama_pinjaman }}</td>
                                        <td>{{ $item->lama_angsuran }}</td>
                                        <td>{{ $item->maks_pinjam }}</td>
                                        <td>{{ $item->bunga }}</td>
                                        <td>{{ $item->id_users }}</td>
                                        <td><button type="button" title="" class="btn btn-link btn-primary btn-lg"
                                                data-original-title="Edit Task" data-toggle="modal"
                                                data-target="#jenispinjaman{{ $item->id_jenispinjaman }}">
                                                <i class="fa fa-edit"></i>
                                            </button>
                                            <a href="{{ asset('hapus-jenispinjaman/' . $item->id_jenispinjaman) }}"
                                                type="button" data-toggle="tooltip" title=""
                                                class="btn btn-link btn-danger" data-original-title="Remove"
                                                <?php echo "onclick=\"return confirm('Apa anda yakin untuk hapus Data ini?')\" "; ?>>
                                                <i class="fa fa-times"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
