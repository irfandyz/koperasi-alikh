@extends('admin.template')
@section('style')
    <style>
        .autocomplete-items {
            border: 1px solid #d4d4d4;
            border-bottom: none;
            border-top: none;
            z-index: 10;
            /*position the autocomplete items to be the same width as the container:*/
            top: 100%;
            left: 0;
            right: 0;
        }

        .autocomplete-items div {
            padding: 10px;
            display: block;
            cursor: pointer;
            background-color: #fff;
            border-bottom: 1px solid #d4d4d4;
        }

        .autocomplete-items div:hover {
            /*when hovering an item:*/
            background-color: #e9e9e9;
        }

        .autocomplete-active {
            /*when navigating through the items using the arrow keys:*/
            background-color: DodgerBlue !important;
            color: #ffffff;
        }

    </style>
@endsection
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <span class="card-title"><button class="btn btn-secondary" data-toggle="modal"
                            data-target="#exampleModal">
                            <span class="btn-label">
                                <i class="fa fa-plus"></i>
                            </span>
                            Tambah Tenor
                        </button></span>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="display table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Jenis Pinjaman</th>
                                    <th>Lama Tenor</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            
                            <tbody>
                                @foreach($tenor as $item)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{$item->nama_pinjaman}}</td>
                                    <td>{{$item->lama_tenor}}</td>
                                    <td><a href="" data-toggle="modal" data-target="#updateModal{{$item->id_tenor}}" class="btn btn-outline-success">Edit</a> <a onclick="return confirm('Apakah anda yakin ingin menghapus data ini?')" href="{{asset('hapus_tenor_pinjaman/'.$item->id_tenor)}}" class="ml-2 btn btn-outline-danger">Delete</a></td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Tambah Tenor</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <form method="post" action="{{asset('/tambah_tenor_pinjaman')}}">
              @csrf
              <div class="modal-body">
                <div class="form-group">
                    <label>Lama Tenor (Bulan)</label>
                    <input class="form-control" name="lama_tenor" type="number">
                </div>
                <div class="form-group">
                    <select class="form-control" name="id_jenispinjaman">
                        <option> - Jenis Pinjaman - </option>
                        @foreach($jenispinjaman as $item)
                            <option value="{{$item->id_jenispinjaman}}">{{$item->nama_pinjaman}}</option>
                        @endforeach
                    </select>
                </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save changes</button>
              </div>
           </form>
        </div>
      </div>
    </div>
    
    @foreach($tenor as $item)
        <div class="modal fade" id="updateModal{{$item->id_tenor}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Tambah Tenor</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <form method="post" action="{{asset('/update_tenor_pinjaman')}}">
              @csrf
              <div class="modal-body">
                <div class="form-group">
                    <label>Lama Tenor (Bulan)</label>
                    <input class="form-control" name="lama_tenor" value="{{$item->lama_tenor}}" type="number">
                    <input class="form-control" name="id_tenor" value="{{$item->id_tenor}}" type="hidden">
                </div>
                <div class="form-group">
                    <select class="form-control" name="id_jenispinjaman">
                        <option> - Jenis Pinjaman - </option>
                        @foreach($jenispinjaman as $data)
                            <option value="{{$data->id_jenispinjaman}}" {{ $item->id_jenispinjaman == $data->id_jenispinjaman ? 'selected' : '' }}>{{$data->nama_pinjaman}}</option>
                        @endforeach
                    </select>
                </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save changes</button>
              </div>
           </form>
        </div>
      </div>
    </div>
    @endforeach
@endsection
