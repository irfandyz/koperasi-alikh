<div class="sidebar sidebar-style-2">
    <div class="sidebar-wrapper scrollbar scrollbar-inner">
        <div class="sidebar-content">
            <div class="user">
                <div class="avatar-sm float-left mr-2">
                    <img src="http://kopmafeuii.com/wp-content/uploads/2017/06/LAMBANG-KOPERASI.png" alt="..."
                        class="avatar-img rounded-circle">
                </div>
                <div class="info">
                    <a data-toggle="collapse" href="#collapseExample" aria-expanded="true">
                        <span>
                            {{ Session::get('nama_lengkap') }}
                            <span class="user-level">{{ Session::get('level') }}</span>
                        </span>
                    </a>
                    <div class="clearfix"></div>
                </div>
            </div>
            {{-- Old----------------------------------------------------- --}}
            {{-- <ul class="nav nav-success">
                <?php
                use App\Models\Menu;
                use App\Models\Submenu;
                use App\Models\Tag;
                $menuid = [];
                $idmenu = Menu::whereIn('id', json_decode(Session::get('menu_id')))
                    ->orderBy('sequence', 'asc')
                    ->get();
                
                $menu = $idmenu;
                $submenu = Submenu::orderBy('sequence')
                    ->whereIn('id', json_decode(Session::get('submenu_id')))
                    ->get();
                $tagid = [];
                foreach ($menu as $data) {
                    if (isset($data->tag->id)) {
                        array_push($tagid, $data->id);
                    }
                }
                $tag = Tag::whereIn('id', $tagid)
                    ->orderBy('sequence', 'asc')
                    ->get();
                ?>
                @foreach ($tag as $item)
                    <li class="nav-section">
                        <span class="sidebar-mini-icon">
                            <i class="fa fa-ellipsis-h"></i>
                        </span>
                        <h4 class="text-section">{{ $item->tagName }}</h4>
                    </li>
                    @foreach ($menu->where('tag_id', $item->id) as $data)
                        @if ($data->main == 'on')
                            <li class="nav-item">
                                <a href="{{ asset('' . $data->menuUrl) }}">
                                    <i class="fas fa-{{ $data->menuIcon }}"></i>
                                    <p>{{ $data->menuName }}</p>
                                </a>
                            </li>
                        @else
                            <li class="nav-item">
                                <a data-toggle="collapse" href="#{{ $data->id }}">
                                    <i class="fas fa-{{ $data->menuIcon }}"></i>
                                    <p>{{ $data->menuName }}</p>
                                    <span class="caret"></span>
                                </a>
                                <div class="collapse" id="{{ $data->id }}">
                                    <ul class="nav nav-collapse">
                                        @foreach ($submenu->where('menu_id', $data->id) as $key)
                                            <li>
                                                <a href="{{ asset('' . $key->subUrl) }}">
                                                    <span class="sub-item">{{ $key->subName }}</span>
                                                </a>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </li>
                        @endif
                    @endforeach
                @endforeach

                <li class="nav-item">
                    <a href="{{ asset('/logout') }}">
                        <i class="fas fa-sign-out-alt"></i>
                        <p>Logout</p>
                    </a>
                </li>
            </ul> --}}
            {{-- old ---------------------------------------------------- --}}
            <ul class="nav nav-success">
                <?php
                use App\Models\Menu;
                use App\Models\Submenu;
                use App\Models\Tag;
                $menuid = [];
                $idmenu = Menu::orderBy('sequence', 'asc')->get();
                
                $menu = $idmenu;
                $submenu = Submenu::orderBy('sequence')->get();
                $tagid = [];
                foreach ($menu as $data) {
                    if (isset($data->tag->id)) {
                        array_push($tagid, $data->id);
                    }
                }
                $tag = Tag::whereIn('id', $tagid)
                    ->orderBy('sequence', 'asc')
                    ->get();
                ?>
                @foreach ($tag as $item)
                    <li class="nav-section">
                        <span class="sidebar-mini-icon">
                            <i class="fa fa-ellipsis-h"></i>
                        </span>
                        <h4 class="text-section">{{ $item->tagName }}</h4>
                    </li>
                    @foreach ($menu->where('tag_id', $item->id) as $data)
                        @if ($data->main == 'on')
                            <li class="nav-item">
                                <a href="{{ asset('' . $data->menuUrl) }}">
                                    <i class="fas fa-{{ $data->menuIcon }}"></i>
                                    <p>{{ $data->menuName }}</p>
                                </a>
                            </li>
                        @else
                            <li class="nav-item">
                                <a data-toggle="collapse" href="#{{ $data->id }}">
                                    <i class="fas fa-{{ $data->menuIcon }}"></i>
                                    <p>{{ $data->menuName }}</p>
                                    <span class="caret"></span>
                                </a>
                                <div class="collapse" id="{{ $data->id }}">
                                    <ul class="nav nav-collapse">
                                        @foreach ($submenu->where('menu_id', $data->id) as $key)
                                            <li>
                                                <a href="{{ asset('' . $key->subUrl) }}">
                                                    <span class="sub-item">{{ $key->subName }}</span>
                                                </a>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </li>
                        @endif
                    @endforeach
                @endforeach

                <li class="nav-item">
                    <a href="{{ asset('/logout') }}">
                        <i class="fas fa-sign-out-alt"></i>
                        <p>Logout</p>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</div>
