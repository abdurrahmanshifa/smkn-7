<!-- APP ASIDE ==========-->
<aside id="menubar" class="menubar light">
    <div class="app-user">
        <div class="media">
            <div class="text-center m-b-md">
                <img src="{{ asset('assets/images/logo.png') }}" style="width: 50%">
            </div>
        </div><!-- .media -->
    </div><!-- .app-user -->
    <div class="menubar-scroll">
        <div class="menubar-scroll-inner">
            <div class="app-user">
                <div class="media">
                    <div class="media-body">
                        <div class="foldable" style="text-align: center">
                            <h5><a href="javascript:void(0)" class="username" style="cursor:default;">{{ Auth::user()->name }}</a></h5>
                            <div style="margin-bottom: 5px">{{ Auth::user()->email }}</div>
                            
                        </div>
                    </div><!-- .media-body -->
                </div><!-- .media -->
            </div><!-- .app-user -->
            <ul class="app-menu">
                <li class="menu-separator">
                    <hr>
                </li>
                <li class="{{ request()->is('dashboard') ? 'active' : '' }}">
                    <a href="{{ route('dashboard') }}">
                        <i class="menu-icon zmdi zmdi-view-dashboard"></i>
                        <span class="menu-text">Dashboard</span>
                    </a>
                </li>
                <li class="menu-separator">
                    <hr>
                </li>
                <li class="has-submenu {{ request()->is('manajemen/siswa*') || request()->is('manajemen/pengguna*')  || request()->is('manajemen/pegawai*') ? 'active' : '' }}">
                    <a href="javascript:void(0)" class="submenu-toggle">
                        <i class="menu-icon fa fa-user"></i>
                        <span class="menu-text">Manajemen Pengguna</span>
                        <i class="menu-caret zmdi zmdi-hc-sm zmdi-chevron-right"></i>
                    </a>
                    <ul class="submenu" style="{{ request()->is('manajemen/siswa*') || request()->is('manajemen/pengguna*')  || request()->is('manajemen/pegawai*') ? 'display: block;' : '' }}">
                        <li class="{{ request()->is('manajemen/pengguna*') ? 'active' : '' }}">
                            <a href="{{ route('pengguna') }}">
                                <span class="menu-text">User Login</span>
                            </a>
                        </li>
                        <li class="{{ request()->is('manajemen/pegawai*') ? 'active' : '' }}">
                            <a href="{{ route('pegawai.index') }}">
                                <span class="menu-text">Pegawai</span>
                            </a>
                        </li>
                        <li class="{{ request()->is('manajemen/siswa*') ? 'active' : '' }}">
                            <a href="{{ route('siswa.index') }}">
                                <span class="menu-text">Siswa</span>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="has-submenu {{ request()->is('manajemen/tautan*') || request()->is('manajemen/sambutan*') || request()->is('manajemen/kategori*')  || request()->is('manajemen/jurusan*') || request()->is('manajemen/event*') || request()->is('manajemen/artikel*') || request()->is('manajemen/komentar*') ? 'active' : '' }}">
                    <a href="javascript:void(0)" class="submenu-toggle">
                        <i class="menu-icon fa fa-folder"></i>
                        <span class="menu-text">Manajemen Konten</span>
                        <i class="menu-caret zmdi zmdi-hc-sm zmdi-chevron-right"></i>
                    </a>

                    {{--
                    <ul class="submenu" style="{{ request()->is('manajemen/kategori')  || request()->is('manajemen/lokasi') || request()->is('manajemen/artikel') || request()->is('manajemen/komentar') ? 'display: block;' : '' }}"> 
                    --}}

                    <ul class="submenu" style="{{ request()->is('manajemen/tautan*') || request()->is('manajemen/sambutan*') || request()->is('manajemen/kategori*')  || request()->is('manajemen/jurusan*') || request()->is('manajemen/event*') || request()->is('manajemen/artikel*') || request()->is('manajemen/komentar*') ? 'display: block;' : '' }}">
                        <li class="{{ request()->is('manajemen/tautan*') ? 'active' : '' }}">
                            <a href="{{ route('manajemen.tautan') }}">
                                <span class="menu-text">Tautan</span>
                            </a>
                        </li>
                        <li class="{{ request()->is('manajemen/sambutan*') ? 'active' : '' }}">
                            <a href="{{ route('manajemen.sambutan') }}">
                                <span class="menu-text">Sambutan</span>
                            </a>
                        </li>
                        <li class="{{ request()->is('manajemen/kategori*') ? 'active' : '' }}">
                            <a href="{{ route('manajemen.kategori') }}">
                                <span class="menu-text">Kategori</span>
                            </a>
                        </li>
                        <li class="{{ request()->is('manajemen/jurusan*') ? 'active' : '' }}">
                            <a href="{{ route('jurusan.index') }}">
                                <span class="menu-text">Jurusan</span>
                            </a>
                        </li>
                        <li class="{{ request()->is('manajemen/event*') ? 'active' : '' }}">
                            <a href="{{ route('manajemen.event') }}">
                                <span class="menu-text">Events</span>
                            </a>
                        </li>
                        <li class="{{ request()->is('manajemen/artikel*') ? 'active' : '' }}">
                            <a href="{{ route('artikel.index') }}">
                                <span class="menu-text">Artikel</span>
                            </a>
                        </li>
                        <li class="{{ request()->is('manajemen/komentar*') ? 'active' : '' }}">
                            <a href="{{ route('komentar.index') }}">
                                <span class="menu-text">Komentar</span>
                            </a>
                        </li>
                        
                    </ul>
                </li>
                <li class="has-submenu {{ request()->is('manajemen/galeri-foto*') || request()->is('manajemen/file*') || request()->is('manajemen/galeri-video*') ? 'active' : '' }}">
                    <a href="javascript:void(0)" class="submenu-toggle">
                        <i class="menu-icon fa fa-folder"></i>
                        <span class="menu-text">Manajemen Galeri</span>
                        <i class="menu-caret zmdi zmdi-hc-sm zmdi-chevron-right"></i>
                    </a>
                    <ul class="submenu" style="{{ request()->is('manajemen/galeri-foto*') ||  request()->is('manajemen/file*') || request()->is('manajemen/galeri-video*')  ? 'display: block;' : '' }}">
                        <li class="{{ request()->is('manajemen/galeri-foto*') ? 'active' : '' }}">
                            <a href="{{ route('galeri-foto.index') }}">
                                <span class="menu-text">Foto</span>
                            </a>
                        </li>
                        <li class="{{ request()->is('manajemen/galeri-video*') ? 'active' : '' }}">
                            <a href="{{ route('galeri-video.index') }}">
                                <span class="menu-text">Video</span>
                            </a>
                        </li>
                        <li class="{{ request()->is('manajemen/file*') ? 'active' : '' }}">
                            <a href="{{ route('file') }}">
                                <span class="menu-text">File</span>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="has-submenu {{ request()->is('pengaturan/ppdb') || request()->is('pengaturan/menu') || request()->is('pengaturan/banner') || request()->is('pengaturan/logo') || request()->is('pengaturan/lokasi') ? 'active' : '' }}">
                    <a href="javascript:void(0)" class="submenu-toggle">
                        <i class="menu-icon fa fa-desktop"></i>
                        <span class="menu-text">Pengaturan Aplikasi</span>
                        <i class="menu-caret zmdi zmdi-hc-sm zmdi-chevron-right"></i>
                    </a>
                    <ul class="submenu" style="{{ request()->is('pengaturan/ppdb') || request()->is('pengaturan/menu') || request()->is('pengaturan/banner') || request()->is('pengaturan/logo') || request()->is('pengaturan/lokasi') ? 'display: block;' : '' }}">
                        <li class="{{ request()->is('pengaturan/menu') ? 'active' : '' }}">
                            <a href="{{ route('pengaturan.menu') }}">
                                <span class="menu-text">Menu</span>
                            </a>
                        </li>
                        <li class="{{ request()->is('pengaturan/ppdb') ? 'active' : '' }}">
                            <a href="{{ route('ppdb.index') }}">
                                <span class="menu-text">Informasi PPDB</span>
                            </a>
                        </li>
                        <li class="{{ request()->is('pengaturan/banner') ? 'active' : '' }}">
                            <a href="{{ route('pengaturan.banner') }}">
                                <span class="menu-text">Banner / Slider</span>
                            </a>
                        </li>
                        <li class="{{ request()->is('pengaturan/logo') ? 'active' : '' }}">
                            <a href="{{ route('pengaturan.logo') }}">
                                <span class="menu-text">Logo</span>
                            </a>
                        </li>
                        <li class="{{ request()->is('pengaturan/lokasi') ? 'active' : '' }}">
                            <a href="{{ route('pengaturan.lokasi') }}">
                                <span class="menu-text">Lokasi</span>
                            </a>
                        </li>
                    </ul>
                </li>
            </ul><!-- .app-menu -->
        </div><!-- .menubar-scroll-inner -->
    </div><!-- .menubar-scroll -->
</aside>
<!--========== END app aside -->