@extends('admin.template')
@section('content')
<style> 
    
</style>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title"><button class="btn btn-secondary" data-toggle="modal"
                            data-target="#exampleModal">
                            <span class="btn-label">
                                <i class="fa fa-plus"></i>
                            </span>
                            Tambah Shu
                        </button></h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="basic-datatables" class="display table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Tahun</th>
                                    <th>Total</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($shu as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->tahun }}</td>
                                        <td>Rp.{{ number_format($item->total_shu) }}</td>
                                        <td><a data-toggle="modal" data-target="#info{{ $item->id_shu }}"><span
                                                    class="badge badge-warning"><i
                                                        class="fas fa-info"></i></span></a>&nbsp;&nbsp;&nbsp;<a
                                                data-toggle="modal" data-target="#tambah{{ $item->id_shu }}"><span
                                                    class="badge badge-success"><i class="fas fa-plus"></i></span></a>
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

    <form action="{{ asset('tambah-shu') }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Tambah SHU</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <h4>Tahun</h4>
                        <input type="number" name="tahun" id="" class="form-control">
                        <h4 class="mt-3">Total SHU</h4>
                        <input type="number" name="total" id="" class="form-control">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
                        <button type="submit" name="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </div>
            </div>
        </div>
    </form>

    @foreach ($shu as $item)
            <div class="modal fade" id="info{{ $item->id_shu }}" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Info Detail SHU</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <h4>Total SHU : Rp. <i class="text-primary">{{ number_format($item->total_shu) }}</i></h4>
                        <div class="table-responsive">
                        <table class="table table-bordered">
                            <tr>
                                <th>No</th>
                                <th>Nama Variabel</th>
                                <th>Prosentasi</th>
                                <th>Total</th>
                                <th>Hapus</th>
                            </tr>
                            <?php $sisa = 0; ?>
                            @foreach ($detail->where('id_shu', $item->id_shu) as $data)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $data->nama_variabel }}</td>
                                    <td>{{ $data->prosentasi }}%</td>
                                    <td>Rp. {{ number_format($item->total_shu*$data->prosentasi/100) }}</td>
                                    <td><a href="{{ asset('hapus-detailshu/'.$data->id_detailshu) }}" class="badge bagde-danger"><i class="fas fa-times text-danger"></i></a></td>
                                </tr>
                                <?php $sisa = $sisa+$item->total_shu*$data->prosentasi/100; ?>
                            @endforeach
                        </table>
                        <h4>Sisa : Rp. <i class="text-danger">{{ number_format($item->total_shu-$sisa) }}</i></h4>
                    </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach

    @foreach ($shu as $item)
        <form action="{{ asset('tambah-detailshu') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="modal fade" id="tambah{{ $item->id_shu }}" tabindex="-1" role="dialog"
                aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-xl" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <input type="button" class="btn btn-success btn-sm" value="Tambah"
                                onclick="createNewElement();" />
                            <h5 class="modal-title ml-3" id="exampleModalLabel">Info Detail SHU</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div id="dynamicCheck">
                                <div class="row">
                                    <input type="hidden" name="id" value="{{ $item->id_shu }}">
                                    <div class="col-md-8">
                                        <h4 class="text-center">Nama Variabel</h4>
                                    </div>
                                    <div class="col-md-4">
                                        <h4 class="text-center">Prosentase</h4>
                                    </div>
                                    <div class="col-md-8">
                                        <input type='text' class='form-control mt-3' name="nama[]" id='newInputBox'
                                            placeholder='Nama Variabel'>
                                    </div>
                                    <div class="col-md-4">
                                        <input type='number' class='form-control mt-3' name="persentasi[]" id='newInputBox'
                                            placeholder='Prosenstase'>
                                    </div>
                                    <div class="col-md-8">
                                        <div id="newElementId"></div>
                                    </div>
                                    <div class="col-md-4">
                                        <div id="newElementNumber"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
                            <button type="submit" name="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    @endforeach





    <script type="text/JavaScript">
        function createNewElement() {
                        // First create a DIV element.
                        var txtNewInputBox = document.createElement('div');
                        var txtNewNumberBox = document.createElement('div');
                    
                        // Then add the content (a new input box) of the element.
                        txtNewInputBox.innerHTML = "<input type='text' class='form-control mt-3' name='nama[]' id='newInputBox' placeholder='Nama Variabel'>";
                        txtNewNumberBox.innerHTML = "<input type='number' class='form-control mt-3' name='persentasi[]' id='newInputBox' placeholder='Prosentase'>";
                    
                        // Finally put it where it is supposed to appear.
                        document.getElementById("newElementId").appendChild(txtNewInputBox);
                        document.getElementById("newElementNumber").appendChild(txtNewNumberBox);
                    }
                    </script>
@endsection
