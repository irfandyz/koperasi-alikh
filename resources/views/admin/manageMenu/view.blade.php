@extends('admin.template')
@section('style')
    <style>
        #snackbar {
            visibility: hidden;
            min-width: 250px;
            margin-left: -125px;
            background-color: rgb(233, 0, 0);
            color: rgb(255, 255, 255);
            text-align: center;
            border-radius: 2px;
            padding: 16px;
            position: fixed;
            z-index: 1;
            left: 50%;
            bottom: 30px;
        }

        #snackbar.show {
            visibility: visible;
            -webkit-animation: fadein 0.5s, fadeout 0.5s 2.5s;
            animation: fadein 0.5s, fadeout 0.5s 2.5s;
        }

        @-webkit-keyframes fadein {
            from {
                bottom: 0;
                opacity: 0;
            }

            to {
                bottom: 30px;
                opacity: 1;
            }
        }

        @keyframes fadein {
            from {
                bottom: 0;
                opacity: 0;
            }

            to {
                bottom: 30px;
                opacity: 1;
            }
        }

        @-webkit-keyframes fadeout {
            from {
                bottom: 30px;
                opacity: 1;
            }

            to {
                bottom: 0;
                opacity: 0;
            }
        }

        @keyframes fadeout {
            from {
                bottom: 30px;
                opacity: 1;
            }

            to {
                bottom: 0;
                opacity: 0;
            }
        }

    </style>
    <style>
        .radio-icon {
            display: none;
        }

        .radioType {
            display: none;
        }

        .label-icon {
            border: solid 1px rgb(167, 167, 167);
            background: rgb(255, 255, 255);
            width: 35px;
            padding: 5px 0;
        }

        .label-type {
            border: solid 1px rgb(167, 167, 167);
            background: rgb(255, 255, 255);
            width: 100%;
            text-align: center;
            padding: 10px 0;
            font-weight: bold;
        }

        .radio-icon:checked+.label-icon {
            border: solid 1px rgb(146, 146, 146);
            background: rgb(75, 104, 168);
        }

        .radioType:checked+.label-type {
            border: solid 1px rgb(146, 146, 146);
            background: rgb(75, 104, 168);
        }

        .radio-icon:checked+.label-icon i {
            color: white
        }

        .radioType:checked+.label-type span {
            color: white
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
                            <button class="btn btn-secondary" data-toggle="modal" data-target="#addMenu">
                                <span class="btn-label">
                                    <i class="fa fa-plus"></i>
                                </span>
                                New Menu
                            </button>
                        </h4>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="display table table-bordered">
                            <thead>
                                <tr>
                                    <th>Tag</th>
                                    <th>Daftar Menu</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($tag as $item)
                                    @foreach ($menu->where('tag_id', $item->id) as $data)
                                        <tr>
                                            @if ($loop->iteration == '1')
                                                <td class="fw-bold"
                                                    rowspan="{{ $menu->where('tag_id', $item->id)->count() }}">
                                                    {{ $item->tagName }}</td>
                                            @endif
                                            <td>
                                                <div class="row">
                                                    <div class="col-sm-4">
                                                        <i class="fas fa-{{ $data->menuIcon }}"></i> &nbsp;
                                                        <strong>{{ $data->menuName }}</strong>
                                                    </div>
                                                    <div class="col-sm-8 text-right">
                                                        @if ($data->main == 'off')
                                                            <button data-toggle="modal"
                                                                data-target="#submenu{{ $data->id }}"
                                                                class="badge badge-info text-white"><i
                                                                    class="fas fa-hand-point-right"></i> Sub Menu</button>
                                                        @else
                                                            <a
                                                                class="badge badge-secondary text-white">{{ asset($data->menuUrl) }}</a>
                                                            <span class="badge badge-success">main</span>
                                                        @endif
                                                        <a class="badge badge-primary" href="">
                                                            <i class="fas fa-edit"></i>
                                                        </a>
                                                        <a class="badge badge-danger" href="">
                                                            <i class="fas fa-trash"></i>
                                                        </a>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @foreach ($menu as $item)
        <div class="modal fade bd-example-modal-lg" id="submenu{{ $item->id }}" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Sub Menu</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <h4 class="card-title mb-2">
                            <button class="btn btn-sm btn-secondary" data-dismiss="modal" data-toggle="modal"
                                data-target="#newsubmenu{{ $item->id }}">
                                <span class="btn-label">
                                    <i class="fa fa-plus"></i>
                                </span>
                                New Submenu
                            </button>
                        </h4>
                        <table class="display table table-bordered">
                            <tbody>
                                {!! $sub->where('menu_id', $item->id)->first() == null ? "<td class='text-center fw-bold'>Empty Data</td>" : '' !!}
                                @foreach ($sub->where('menu_id', $item->id) as $data)
                                    <tr>
                                        <td>
                                            <div class="row">
                                                <div class="col-sm-3">
                                                    {{ $data->subName }}
                                                </div>
                                                <div class="col-sm-6 text-center"
                                                    style="border-left: solid 1px rgb(150, 150, 150);border-right: solid 1px rgb(150, 150, 150)">
                                                    <a href="{{ asset($data->subUrl) }}">{{ asset($data->subUrl) }}</a>
                                                </div>
                                                <div class="col-sm-3 text-right">
                                                    <a data-toggle="modal" data-target="#subedit{{ $data->id }}"
                                                        data-dismiss="modal" class="badge badge-primary"><i
                                                            class="fas fa-edit text-white"></i></a>
                                                    <a data-toggle="modal" data-target="#subdelete{{ $data->id }}"
                                                        data-dismiss="modal" class="badge badge-danger"><i
                                                            class="fas fa-trash text-white"></i></a>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    @endforeach

    @foreach ($menu as $item)
        <form action="{{ asset('addSubmenu') }}" method="post">
            @csrf
            <input type="hidden" name="id" value="{{ $item->id }}">
            <div class="modal fade" id="newsubmenu{{ $item->id }}" tabindex="-1" role="dialog"
                aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLongTitle">New Submenu for <span
                                    class="text-primary">{{ $item->menuName }}</span>
                                Menu's</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <label for="subName" class="mt-3 h5">Nama Submenu</label>
                            <input type="text" name="subName" id="subName" class="form-control">
                            <label for="subUrl" class="mt-3 h5">Submenu Url</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">{{ asset('') }}</div>
                                </div>
                                <input type="text" name="subUrl" id="subUrl" class="form-control">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-success">Save</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    @endforeach

    @foreach ($sub as $item)
        <form action="{{ asset('editSubmenu') }}" method="post">
            @csrf
            <input type="hidden" name="id" value="{{ $item->id }}">
            <div class="modal fade" id="subedit{{ $item->id }}" tabindex="-1" role="dialog"
                aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLongTitle">New Submenu for <span
                                    class="text-primary">{{ $item->menuName }}</span>
                                Menu's</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <label for="subName" class="mt-3 h5">Nama Submenu</label>
                            <input type="text" name="subName" id="subName" value="{{ $item->subName }}"
                                class="form-control">
                            <label for="subUrl" class="mt-3 h5">Submenu Url</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">{{ asset('') }}</div>
                                </div>
                                <input type="text" name="subUrl" value="{{ $item->subUrl }}" id="subUrl"
                                    class="form-control">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-success">Save</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    @endforeach

    @foreach ($sub as $item)
        <div class="modal fade" id="subdelete{{ $item->id }}" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        Delete
                    </div>
                    <div class="modal-body">
                        <h1>Delete Submenu <span class="text-primary">{{ $item->subName }}</span></h1>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <a href="{{ asset('deleteSubmenu/' . $item->id) }}" class="btn btn-danger">delete</a>
                    </div>
                </div>
            </div>
        </div>
    @endforeach

    <form action="{{ asset('addMenu') }}" method="post">
        @csrf
        <div class="modal fade" id="addMenu" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">New Menu</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <label for="tag" class="mt-3 h5">Choose Tag</label>
                        <select name="tag" id="tag" class="form-control">
                            <option selected disabled>Choose Tag</option>
                            @foreach ($tag as $item)
                                <option value="{{ $item->id }}">{{ $item->tagName }}</option>
                            @endforeach
                        </select>
                        <label for="menuName" class="mt-3 h5">Nama Menu</label>
                        <input type="text" name="menuName" id="menuName" class="form-control">
                        <label for="subUrl" class="mt-3 h5">Menu Url</label>
                        <label class="mt-3 h5">Choose Icon :</label>
                        <div class="row text-center">
                            <div class=" col-sm-2 mt-1 icon-border">
                                <input type="radio" class="radio-icon" name="icon" id="icon-mobile-alt"
                                    value="mobile-alt">
                                <label for="icon-mobile-alt" class="label-icon"><i
                                        class="fas fa-mobile-alt"></i></label>
                            </div>
                            <div class="col-sm-2 mt-1 icon-border">
                                <input type="radio" class="radio-icon" name="icon" id="icon-layer-group"
                                    value="layer-group">
                                <label for="icon-layer-group" class="label-icon"><i
                                        class="fas fa-layer-group"></i></label>
                            </div>
                            <div class="col-sm-2 mt-1 icon-border">
                                <input type="radio" class="radio-icon" name="icon" id="icon-sliders-h"
                                    value="sliders-h">
                                <label for="icon-sliders-h" class="label-icon"><i
                                        class="fas fa-sliders-h"></i></label>
                            </div>
                            <div class="col-sm-2 mt-1 icon-border">
                                <input type="radio" class="radio-icon" name="icon" id="icon-calendar-alt"
                                    value="calendar-alt">
                                <label for="icon-calendar-alt" class="label-icon"><i
                                        class="fas fa-calendar-alt"></i></label>
                            </div>
                            <div class="col-sm-2 mt-1 icon-border">
                                <input type="radio" class="radio-icon" name="icon" id="icon-user" value="user">
                                <label for="icon-user" class="label-icon"><i class="fas fa-user"></i></label>
                            </div>
                            <div class="col-sm-2 mt-1 icon-border">
                                <input type="radio" class="radio-icon" name="icon" id="icon-bookmark" value="bookmark">
                                <label for="icon-bookmark" class="label-icon"><i class="fas fa-bookmark"></i></label>
                            </div>
                            <div class="col-sm-2 mt-1 icon-border">
                                <input type="radio" class="radio-icon" name="icon" id="icon-home" value="home">
                                <label for="icon-home" class="label-icon"><i class="fas fa-home"></i></label>
                            </div>
                            <div class="col-sm-2 mt-1 icon-border">
                                <input type="radio" class="radio-icon" name="icon" id="icon-archive" value="archive">
                                <label for="icon-archive" class="label-icon"><i class="fas fa-archive"></i></label>
                            </div>
                            <div class="col-sm-2 mt-1 icon-border">
                                <input type="radio" class="radio-icon" name="icon" id="icon-atom" value="atom">
                                <label for="icon-atom" class="label-icon"><i class="fas fa-atom"></i></label>
                            </div>
                            <div class="col-sm-2 mt-1 icon-border">
                                <input type="radio" class="radio-icon" name="icon" id="icon-credit-card"
                                    value="credit-card">
                                <label for="icon-credit-card" class="label-icon"><i
                                        class="fas fa-credit-card"></i></label>
                            </div>
                            <div class="col-sm-2 mt-1 icon-border">
                                <input type="radio" class="radio-icon" name="icon" id="icon-book" value="book">
                                <label for="icon-book" class="label-icon"><i class="fas fa-book"></i></label>
                            </div>
                            <div class="col-sm-2 mt-1 icon-border">
                                <input type="radio" class="radio-icon" name="icon" id="icon-cog" value="cog">
                                <label for="icon-cog" class="label-icon"><i class="fas fa-cog"></i></label>
                            </div>
                        </div>
                        <label class="mt-3 h5">Choose Type :</label>
                        <div class="row">
                            <div class="col-sm-6 mt-1">
                                <input type="radio" class="radioType" name="type" value="on" id="main"
                                    onclick="Main()">
                                <label for="main" class="label-type"><span> Set as Main menu</span></label>
                            </div>
                            <div class="col-sm-6 mt-1">
                                <input type="radio" class="radioType" name="type" value="off" id="submenu"
                                    onclick="Submenu()">
                                <label for="submenu" class="label-type"><span>Set with Submenu</span></label>
                            </div>
                        </div>
                        <div style="display: none" id="divUrl">
                            <label class="mt-3 h5">Set Menu Url</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">{{ asset('') }}</div>
                                </div>
                                <input type="text" name="menuUrl" id="menuUrl" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-success">Save</button>
                    </div>
                </div>
            </div>
        </div>
    </form>

    @if ($errors->first('subUrl'))
        <div id="snackbar">{{ $errors->first('subUrl') }}</div>
        <script>
            var x = document.getElementById("snackbar");
            x.className = "show";
            setTimeout(function() {
                x.className = x.className.replace("show", "");
            }, 5000);
        </script>
    @endif
    @if ($errors->first('subName'))
        <div id="snackbar">{{ $errors->first('subName') }}</div>
        <script>
            var x = document.getElementById("snackbar");
            x.className = "show";
            setTimeout(function() {
                x.className = x.className.replace("show", "");
            }, 5000);
        </script>
    @endif
    @if (Session::get('message'))
        <div id="snackbar" style="background: rgb(2, 255, 65)">{{ Session::get('message') }}</div>
        <script>
            var x = document.getElementById("snackbar");
            x.className = "show";
            setTimeout(function() {
                x.className = x.className.replace("show", "");
            }, 5000);
        </script>
    @endif
    <script>
        function Main() {
            document.getElementById('divUrl').style.display = 'block';
        }

        function Submenu() {
            document.getElementById('divUrl').style.display = 'none';
        }
    </script>
@endsection
