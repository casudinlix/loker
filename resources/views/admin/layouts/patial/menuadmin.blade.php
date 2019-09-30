<!-- START X-NAVIGATION -->
<ul class="x-navigation">
    <li class="xn-logo">
        <a href="{{ route('admin.home') }}">{{ config('app.name') }}</a>
        <a href="#" class="x-navigation-control"></a>
    </li>
    <li class="xn-profile">
        <a href="#" class="profile-mini">
            <img src="{{Storage:: url('avatar/male.svg')}}" alt="John Doe"/>
        </a>
        <div class="profile">
            <div class="profile-image">
                <img src="{{Storage:: url('avatar/male.svg')}}" alt="{{ 's' }}"/>
            </div>
            <div class="profile-data">
                <div class="profile-data-name">{{ Auth::guard('admin')->user()->name ?? "Guest" }}</div>
                <div class="profile-data-title">{{ Auth::guard('admin')->user()->email ?? "Guest@guest.com"  }}</div>
            </div>
            <div class="profile-controls">
                <a href="pages-profile.html" class="profile-control-left"><span class="fa fa-info"></span></a>
                <a href="pages-messages.html" class="profile-control-right"><span class="fa fa-envelope"></span></a>
            </div>
        </div>
    </li>
    <li class="xn-title">Navigation</li>
    <li class="">
        <a href="{{route('admin.home')}}"><span class="fa fa-desktop"></span> <span class="xn-text">Dashboard</span></a>
    </li>


    <li class="xn-openable">
        <a href="#"><span class="fa fa-mortar-board"></span> <span class="xn-text">Akademik</span></a>
        <ul>
            <li><a href="{{ route('psb.index') }}"><span class="fa fa-file-o"></span>PSB</a></li>
            <li><a href="{{ route('data.psb') }}"><span class="glyphicon glyphicon-pencil"></span>Daftar Ulang</a></li>
            <li><a href="layout-nav-top.html"><span class="fa fa-angle-right"></span>Pindah Jurusan</a></li>
            <li><a href="layout-nav-top.html"><span class="fa fa-calendar-o"></span>Jadwal Kuliah</a></li>
            <li><a href="layout-nav-right.html"><span class="fa fa-calendar-o"></span>Tugas</a></li>
            <li><a href="layout-nav-top-fixed.html"><span class="fa fa-clock-o"></span>Absensi</a></li>
            <li><a href="pages-address-book.html"><span class="fa fa-group"></span> Dosen</a></li>

            <li><a href="pages-profile.html"><span class="fa fa-calendar"></span> Periode Akademin</a></li>
            <li><a href="pages-address-book.html"><span class="fa fa-signal"></span> Jenjang</a></li>
            <li><a href="pages-address-book.html"><span class="fa fa-user-md"></span> Prodi</a></li>
            <li><a href="pages-address-book.html"><span class="fa fa-book"></span> Kurikulum</a></li>
            <li><a href="pages-address-book.html"><span class="fa fa-file-text"></span> Matakuliah</a></li>


        </ul>
    </li>
    <li class="xn-openable">
        <a href="#"><span class="fa fa-clock-o"></span> KRS / KRA</a>
        <ul>
            <li><a href="pages-timeline.html"><span class="fa fa-align-center"></span> Pengjuan KRS</a></li>
            <li><a href="pages-timeline-simple.html"><span class="fa fa-align-justify"></span> Ujian Online</a></li>
        </ul>
    </li>
    <li class="xn-openable">
        <a href="#"><span class="fa fa-clock-o"></span> Ujian</a>
        <ul>
            <li><a href="pages-timeline.html"><span class="fa fa-align-center"></span> Jadwal Ujian</a></li>
            <li><a href="pages-timeline-simple.html"><span class="fa fa-align-justify"></span> Ujian Online</a></li>
        </ul>
    </li>
    <li class="xn-openable">
        <a href="#"><span class="fa fa-clock-o"></span> Nilai</a>
        <ul>
          <li><a href="pages-timeline.html"><span class="fa fa-align-center"></span> Mahasiswa</a></li>
            <li><a href="pages-timeline.html"><span class="fa fa-align-center"></span> KHS</a></li>
            <li><a href="pages-timeline-simple.html"><span class="fa fa-align-justify"></span> KHS Semester</a></li>
            <li><a href="pages-timeline-simple.html"><span class="fa fa-align-justify"></span> Nilai Awal</a></li>

        </ul>
    </li>
    <li class="xn-openable">
        <a href="#"><span class="fa fa-cogs"></span> <span class="xn-text">Master</span></a>
        <ul>
            <li><a href="pages-gallery.html"><span class="fa fa-users"></span> Mahasiswa</a></li>

                    <li><a href="pages-address-book.html"><span class="fa fa-building-o"></span> Ruangan</a></li>
                        <li><a href="pages-address-book.html"><span class="fa fa-dollar"></span> Biaya</a></li>


            <li><a href="pages-messages.html"><span class="fa fa-comments"></span> Messages</a></li>
            <li><a href="pages-calendar.html"><span class="fa fa-calendar"></span> Calendar</a></li>
            <li><a href="pages-tasks.html"><span class="fa fa-edit"></span> Tasks</a></li>
            <li><a href="pages-content-table.html"><span class="fa fa-columns"></span> Content Table</a></li>
            <li><a href="pages-faq.html"><span class="fa fa-question-circle"></span> FAQ</a></li>
            <li><a href="pages-search.html"><span class="fa fa-search"></span> Search</a></li>
            <li class="xn-openable">
                <a href="#"><span class="fa fa-file"></span> Blog</a>

                <ul>
                    <li><a href="pages-blog-list.html"><span class="fa fa-copy"></span> List of Posts</a></li>
                    <li><a href="pages-blog-post.html"><span class="fa fa-file-o"></span>Single Post</a></li>
                </ul>
            </li>
            <li class="xn-openable">
                <a href="#"><span class="fa fa-sign-in"></span> Login</a>
                <ul>
                    <li><a href="pages-login.html">App Login</a></li>
                    <li><a href="pages-login-website.html">Website Login</a></li>
                    <li><a href="pages-login-website-light.html"> Website Login Light</a></li>
                </ul>
            </li>
            <li class="xn-openable">
                <a href="#"><span class="fa fa-warning"></span> Error Pages</a>
                <ul>
                    <li><a href="pages-error-404.html">Error 404 Sample 1</a></li>
                    <li><a href="pages-error-404-2.html">Error 404 Sample 2</a></li>
                    <li><a href="pages-error-500.html"> Error 500</a></li>
                </ul>
            </li>
        </ul>
    </li>
    <li class="xn-title">Components</li>
    <li class="">
        <a href="{{route('admin.home')}}"><span class="glyphicon glyphicon-book"></span> <span class="xn-text">E-Library</span></a>
    </li>
    <li class="">
        <a href="{{route('admin.home')}}"><span class="glyphicon glyphicon-bullhorn"></span> <span class="xn-text">Pengumuman</span></a>
    </li>



    <li class="xn-openable">
        <a href="#"><span class="fa fa-bar-chart-o"></span> <span class="xn-text">Keuangan</span></a>
        <ul>
             <li><a href="{{ route('kra.index') }}"><span class="fa fa-briefcase"></span> KRA</a></li>
            <li><a href="pages-mailbox-inbox.html"><span class="fa fa-credit-card"></span> Invoice</a></li>s
            <li><a href="pages-mailbox-inbox.html"><span class="fa fa-credit-card"></span> Transaksi</a></li>s
        </ul>
    </li>
    <li class="xn-openable">
        <a href="#"><span class="fa fa-bar-chart-o"></span> <span class="xn-text">Laporan</span></a>
        <ul>
            <li><a href="charts-morris.html"><span class="xn-text">Keuangan Mahaiswa</span></a></li>
            <li><a href="charts-nvd3.html"><span class="xn-text">NVD3</span></a></li>
            <li><a href="charts-rickshaw.html"><span class="xn-text">Rickshaw</span></a></li>
            <li><a href="charts-other.html"><span class="xn-text">Other</span></a></li>
        </ul>
    </li>
    <li class="xn-openable">
        <a href="#"><span class="fa fa-wrench "></span> <span class="xn-text">Pengaturan Sistem</span></a>
        <ul>
            <li><a href="{{ route('all.index') }}"><span class="fa fa-mortar-board"></span>Periode Akademik</a></li>
            <li><a href="{{ route('psb.index') }}"><span class="fa fa-file-o"></span>Umum</a></li>




            <li><a href="layout-frame-left.html">Frame Left Column</a></li>
            <li><a href="layout-frame-right.html">Frame Right Column</a></li>
            <li><a href="layout-search-left.html">Search Left Side</a></li>
            <li><a href="blank.html">Blank Page</a></li>
        </ul>
    </li>
    <li class="xn-openable">
        <a href="#"><span class="fa fa-envelope"></span> Pesan</a>
        <ul>
            <li><a href="pages-mailbox-inbox.html"><span class="fa fa-inbox"></span> Inbox</a></li>
            <li><a href="pages-mailbox-message.html"><span class="fa fa-file-text"></span> Message</a></li>
            <li><a href="pages-mailbox-compose.html"><span class="fa fa-pencil"></span> Compose</a></li>
        </ul>
    </li>
    <li>
        <a href="maps.html"><span class="fa fa-map-marker"></span> <span class="xn-text">Maps</span></a>
    </li>
    <li class="xn-openable">
        <a href="#"><span class="fa fa-pencil"></span> <span class="xn-text">Forms</span></a>
        <ul>
            <li>
                <a href="form-layouts-two-column.html"><span class="fa fa-tasks"></span> Form Layouts</a>
                <div class="informer informer-danger">New</div>
                <ul>
                    <li><a href="form-layouts-one-column.html"><span class="fa fa-align-justify"></span> One Column</a></li>
                    <li><a href="form-layouts-two-column.html"><span class="fa fa-th-large"></span> Two Column</a></li>
                    <li><a href="form-layouts-tabbed.html"><span class="fa fa-table"></span> Tabbed</a></li>
                    <li><a href="form-layouts-separated.html"><span class="fa fa-th-list"></span> Separated Rows</a></li>
                </ul>
            </li>
            <li><a href="form-elements.html"><span class="fa fa-file-text-o"></span> Elements</a></li>
            <li><a href="form-validation.html"><span class="fa fa-list-alt"></span> Validation</a></li>
            <li><a href="form-wizards.html"><span class="fa fa-arrow-right"></span> Wizards</a></li>
            <li><a href="form-editors.html"><span class="fa fa-text-width"></span> WYSIWYG Editors</a></li>
            <li><a href="form-file-handling.html"><span class="fa fa-floppy-o"></span> File Handling</a></li>
        </ul>
    </li>
    <li class="xn-openable">
        <a href="tables.html"><span class="fa fa-table"></span> <span class="xn-text">Tables</span></a>
        <ul>
            <li><a href="table-basic.html"><span class="fa fa-align-justify"></span> Basic</a></li>
            <li><a href="table-datatables.html"><span class="fa fa-sort-alpha-desc"></span> Data Tables</a></li>
            <li><a href="table-export.html"><span class="fa fa-download"></span> Export Tables</a></li>
        </ul>
    </li>
    <li class="xn-openable">
        <a href="#"><span class="fa fa-sitemap"></span> <span class="xn-text">Navigation Levels</span></a>
        <ul>
            <li class="xn-openable">
                <a href="#">Second Level</a>
                <ul>
                    <li class="xn-openable">
                        <a href="#">Third Level</a>
                        <ul>
                            <li class="xn-openable">
                                <a href="#">Fourth Level</a>
                                <ul>
                                    <li><a href="#">Fifth Level</a></li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                </ul>
            </li>
        </ul>
    </li>

</ul>
<!-- END X-NAVIGATION -->
