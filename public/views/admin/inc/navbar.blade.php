@php
    $admin = $_SESSION['user'];
@endphp
<aside id="menubar" class="menubar light">
    <div class="app-user">
        <div class="media">
            <div class="media-left">
                <div class="avatar avatar-md avatar-circle">
                    <a href="javascript:void(0)"><img class="img-responsive my-auto" src="{{ get_picture('users', $admin['image']) }}" width="80" height="80" alt="avatar"/></a>
                </div>
            </div>
            <div class="media-body">
                <div class="foldable">
                    <ul>
                        <li class="dropdown">
                            <ul class="dropdown-menu animated flipInY">
                                <li>
                                    <a class="text-color" href="{{ base_url('panel') }}">
                                        <span class="m-r-xs"><i class="fa fa-home"></i></span>
                                        <span> Panel </span>
                                    </a>
                                </li>
                                <li>
                                    <a class="text-color" href="{{ base_url('panel/profil') }}">
                                        <span class="m-r-xs"><i class="fa fa-user"></i></span>
                                        <span> {{ $admin['fullName'] ?? 'Bilinmeyen Kullanıcı' }} </span>
                                    </a>
                                </li>
                                <li>
                                    <a class="text-color" href="javascript:void(0)">
                                        <span class="m-r-xs"><i class="fa fa-gear"></i></span>
                                        <span> Ayarlar </span>
                                    </a>
                                </li>
                                <li role="separator" class="divider"></li>
                                <li>
                                    <a class="text-warning" href="{{ base_url('oturumu-kilitle') }}">
                                        <span class="m-r-xs"><i class="fa fa-power-off"></i></span>
                                        <span> Oturumu Kilitle </span>
                                    </a>
                                </li>
                                <li>
                                    <a class="text-danger" href="{{ base_url('cikis') }}">
                                        <span class="m-r-xs"><i class="fa fa-power-off"></i></span>
                                        <span> Güvenli Çıkış</span>
                                    </a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <div class="menubar-scroll">
        <div class="menubar-scroll-inner">
            <ul class="app-menu">
                <li>
                    <a href="{{ base_url('panel') }}">
                        <i class="menu-icon zmdi zmdi-view-dashboard zmdi-hc-lg"></i>
                        <span class="menu-text"> Panel </span>
                    </a>
                </li>

                <li class="has-submenu">
                    <a href="javascript:void(0)" class="submenu-toggle">
                        <i class="menu-icon zmdi zmdi-accounts zmdi-hc-lg"></i>
                        <span class="menu-text"> Kullanıcılar </span>
                        <i class="menu-caret zmdi zmdi-hc-sm zmdi-chevron-right"></i>
                    </a>
                    <ul class="submenu">
                        <li><a href="{{ base_url('panel/kullanici/listesi') }}"><span class="menu-text"> Kullanıcı Listesi </span></a></li>
                        <li><a href="{{ base_url('panel/kullanici/ekle') }}"><span class="menu-text"> Kullanıcı Ekle </span></a></li>
                    </ul>
                </li>


                <li class="menu-separator"><hr></li>

                <li>
                    <a href="javascript:void(0)">
                        <i class="menu-icon zmdi zmdi-file-text zmdi-hc-lg"></i>
                        <span class="menu-text">Documentation</span>
                    </a>
                </li>

                <li>
                    <a href="javascript:void(0)">
                        <i class="menu-icon zmdi zmdi-settings zmdi-hc-lg"></i>
                        <span class="menu-text"> Ayarlar </span>
                    </a>
                </li>

            </ul>
        </div>
    </div>
</aside>