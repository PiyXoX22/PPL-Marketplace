<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-laugh-wink"></i>
        </div>
        <div class="sidebar-brand-text mx-3">E-Blox Store</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item">
        <a class="nav-link" href="{{ route('admin.dashboard') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Main Menu
    </div>

    <!-- Nav Item - Produk -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="{{ route('admin.produk.buat')}}"
            aria-expanded="true" aria-controls="collapseTwo">
            <i class="fas fa-fw fa-cog"></i>
            <span>Penambahan Barang</span>
        </a>
    </li>

    <li class="nav-item">
        <a class="nav-link collapsed" href="{{ route('admin.produk.index')}}"
            aria-expanded="true" aria-controls="collapseTwo">
            <i class="fas fa-fw fa-cog"></i>
            <span>Produk</span>
        </a>
    </li>

        <!-- Nav Item - Produk -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="{{ route('admin.kategori.index')}}"
            aria-expanded="true" aria-controls="collapseTwo">
            <i class="fas fa-fw fa-cog"></i>
            <span>Kategori</span>
        </a>
    </li>

        <!-- Nav Item - Produk -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="{{ route('admin.qty.index')}}"
            aria-expanded="true" aria-controls="collapseTwo">
            <i class="fas fa-fw fa-cog"></i>
            <span>Qty</span>
        </a>
    </li>

     <!-- Nav Item - Produk -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="{{ route('admin.gambar.index')}}"
            aria-expanded="true" aria-controls="collapseTwo">
            <i class="fas fa-fw fa-cog"></i>
            <span>Gambar</span>
        </a>
    </li>

        <!-- Nav Item - Produk -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="{{ route('admin.harga.index')}}"
            aria-expanded="true" aria-controls="collapseTwo">
            <i class="fas fa-fw fa-cog"></i>
            <span>Harga</span>
        </a>
    </li>
            <!-- Nav Item - Produk -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="{{ route('admin.orders.index') }}"
                   aria-expanded="true" aria-controls="collapseTransaksi">
                   <i class="fas fa-fw fa-money-bill-wave"></i>
                   <span>Transaksi</span>
                </a>
            </li>

            <!-- Nav Item - Produk -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="{{ route('admin.harga.index')}}"
                    aria-expanded="true" aria-controls="collapseTwo">
                    <i class="fas fa-fw fa-cog"></i>
                    <span>Kupon</span>
                </a>
            </li>
            <!-- Nav Item - Produk -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="{{ route('admin.posts.index')}}"
                    aria-expanded="true" aria-controls="collapseTwo">
                    <i class="fas fa-fw fa-cog"></i>
                    <span>Blog</span>
                </a>
            </li>

    <!-- Nav Item - Pages Collapse Menu -->
    {{-- <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
            aria-expanded="true" aria-controls="collapseTwo">
            <i class="fas fa-fw fa-cog"></i>
            <span>Components</span>
        </a>
        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Custom Components:</h6>
                <a class="collapse-item" href="buttons.html">Buttons</a>
                <a class="collapse-item" href="cards.html">Cards</a>
            </div>
        </div>
    </li> --}}

    <!-- Nav Item - Utilities Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="{{ route('admin.upui.index')}}"
            aria-expanded="true" aria-controls="collapseTwo">
            <i class="fas fa-fw fa-wrench"></i>
            <span>Tampilan UI</span>
        </a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>