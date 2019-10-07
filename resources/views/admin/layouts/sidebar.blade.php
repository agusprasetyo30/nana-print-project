<ul class="sidebar-menu" data-widget="tree">
    {{-- <li class="header ">
        <div>
            <a href="#" class="btn btn-flat btn-warning" target="_blank" style="width: 100%;">
                <b>Go to website</b>
            </a>
        </div>
    </li> --}}
    <li class="header">MENU</li>
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
    {{-- Request::is('admin/item') --}}
    <li class="{{Request::path() == 'admin/item' || Request::is('admin/item/paper*')  ? 'active' : '' }}">
        <a href="{{ route('item.index') }}">
            <i class="ion ion-ios-book"></i> <span>Item</span>
        </a>
    </li>

    <li class="header">MENU TRANSAKSI</li>
    <li class="{{Request::path() == 'admin/item-order' ? 'active' : '' }}">
        <a href="{{ route('order-atk.index') }}">
            <i class="ion ion-ios-photos"></i> <span>Transaksi ATK</span>
        </a>
    </li>
    <li class="">
        <a href="{{ route('item.index') }}">
            <i class="ion ion-printer"></i> <span>Transaksi Print & Foto</span>
        </a>
    </li>
    <li class="header">KEUANGAN</li>
    <li class="">
        <a href="{{ route('item.index') }}">
            <i class="ion ion-ios-paper"></i> <span>Laporan Keuangan</span>
        </a>
    </li>

</ul>
