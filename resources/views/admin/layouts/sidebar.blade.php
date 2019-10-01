<ul class="sidebar-menu" data-widget="tree">
    <li class="header ">
        <div>
            <a href="#" class="btn btn-flat btn-warning" target="_blank" style="width: 100%;">
                <b>Go to website</b>
            </a>
        </div>
    </li>
    <li class="header">MENU NAVIGATION</li>
    <li class="{{Request::path() == 'admin' ? 'active' : '' }}">
        <a href="{{ route('admin.dashboard') }}">
            <i class="fa fa-dashboard"></i> <span>Dashboard</span>

        </a>
    </li>
    <li class="{{Request::path() == 'admin/users' ? 'active' : '' }}">
        <a href="{{ route('users.index') }}">
            <i class="ion ion-person-stalker"></i> <span>Pengguna</span>
        </a>
    </li>
    <li class="{{Request::is('admin/item*') ? 'active' : '' }}">
        <a href="{{ route('item.index') }}">
            <i class="ion ion-ios-book"></i> <span>Item</span>
        </a>
    </li>

    <li class="header">TRANSAKSI</li>
    <li class="">
        <a href="{{ route('item.index') }}">
            <i class="ion ion-printer"></i> <span>Transaksi Print</span>
        </a>
    </li>
    <li class="">
        <a href="{{ route('item.index') }}">
            <i class="ion ion-ios-photos"></i> <span>Transaksi Foto</span>
        </a>
    </li>

</ul>
