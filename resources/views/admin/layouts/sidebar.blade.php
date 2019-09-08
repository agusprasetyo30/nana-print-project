<ul class="sidebar-menu" data-widget="tree">
    <li class="header ">
        <div>
            <a href="#" class="btn btn-flat btn-warning" target="_blank" style="width: 100%;">
                <b>Go to website</b>
            </a>
        </div>
    </li>
    <li class="header">MENU NAVIGATION</li>
    <li class="{{Request::is('admin') ? 'active' : '' }}">
        <a href="#">
            <i class="fa fa-dashboard"></i> <span>Dashboard</span>
        </a>
    </li>
    <li class="{{Request::is('admin/users*') ? 'active' : '' }}">
        <a href="{{ route('users.index') }}">
            <i class="ion ion-person-stalker"></i> <span>Users</span>
        </a>
    </li>
    <li class="treeview">
            <a href="#">
                <i class="fa fa-photo"></i> <span>Galeri</span>
                <span class="pull-right-container">
                    <i class="fa fa-angle-left pull-right"></i>
                </span>
            </a>
            <ul class="treeview-menu">
                {{-- <li class="{{Request::is('admin/photo*') ? 'active' : '' }}"> --}}
                <li>
                    <a href="#"><i class="fa fa-file-image-o"></i> Foto</a>
                </li>
            </ul>
    </li>

</ul>
