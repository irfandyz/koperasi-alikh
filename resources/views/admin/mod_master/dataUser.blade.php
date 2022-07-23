@extends('admin.template')
@section('style')
    <style>
        ul {
            list-style: none;
        }

    </style>
@endsection
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex flex-row justify-content-between">
                        <h4 class="card-title">
                            <button class="btn btn-secondary" data-toggle="modal" data-target="#exampleModal">
                                <span class="btn-label">
                                    <i class="fa fa-plus"></i>
                                </span>
                                User
                            </button>
                        </h4>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="basic-datatables" class="display table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Foto</th>
                                    <th>Nama Lengkap</th>
                                    <th>Email</th>
                                    <th>Nomor Telepon</th>
                                    <th>Level</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($user as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td><img src="{{ asset('userImage/' . $item->foto) }}" class="img-fluid">
                                        </td>
                                        <td>{{ $item->nama_lengkap }}</td>
                                        <td>{{ $item->email }}</td>
                                        <td>{{ $item->no_telp }}</td>
                                        <td>{{ $item->level }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <form action="{{ asset('addUser') }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Tambah Anggota</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Nama Lengkap </label>
                                    <input type="text" name="nama_lengkap" required="required" class="form-control"
                                        placeholder="Nama Lengkap..">
                                </div>
                                <div class="form-group">
                                    <label>Email</label>
                                    <input type="text" name="email" required="required" class="form-control"
                                        placeholder="Email penduduk ..">
                                </div>
                                <div class="form-group">
                                    <label>Telepon</label>
                                    <input type="text" name="telepon" required="required" class="form-control"
                                        placeholder="telepon ..">
                                </div>
                                <div class="form-group">
                                    <label>Foto</label>
                                    <input type="file" name="foto" required="required" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label>Username</label>
                                    <input type="name" name="username" required="required" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label>Password</label>
                                    <input type="password" name="pasword" required="required" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label>Level </label>
                                    <select class="form-control" name="level">
                                        <option selected disabled>Choose Level</option>
                                        <option value="admin">admin</option>
                                        <option value="kontributor">kontributor</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <h1>Akses Menu</h1>
                                <ul>
                                    @foreach ($tag as $item)
                                        <li class="mt-3">
                                            <span class="text-primary">{{ $item->tagName }}</span>
                                            @if ($menu->where('tag_id', $item->id)->count() !== '0')
                                                <ul>
                                                    @foreach ($menu->where('tag_id', $item->id) as $data)
                                                        <li class="mt-3">
                                                            <input name="menu_id[]" value="{{ $data->id }}"
                                                                type="checkbox" id="check{{ $data->id }}"
                                                                onclick="data({{ $data->id }})">
                                                            <span class="text-secondary">{{ $data->menuName }}</span>
                                                        </li>
                                                        @if ($submenu->where('menu_id', $data->id)->count() !== '0')
                                                            <ul id="data{{ $data->id }}" style="display: none">
                                                                @foreach ($submenu->where('menu_id', $data->id) as $key)
                                                                    <li>
                                                                        <input name="submenu_id[]"
                                                                            value="{{ $key->id }}" type="checkbox">
                                                                        {{ $key->subName }}
                                                                    </li>
                                                                @endforeach
                                                            </ul>
                                                        @endif
                                                    @endforeach
                                                </ul>
                                            @endif
                                        </li>
                                    @endforeach
                                </ul>
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
    <script>
        function data(i) {
            var a = document.getElementById('check' + i);
            var v = document.getElementById('data' + i);
            if (a.checked == true) {
                console.log('true');
                v.style.display = 'block';
            } else {
                console.log('false');
                v.style.display = 'none';
            }
        }
    </script>
@endsection
