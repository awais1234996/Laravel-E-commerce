<div class="sidebar" id="sidebar">
    <div class="sidebar-inner slimscroll">
        <div id="sidebar-menu" class="sidebar-menu">
            <ul>

                <li class="active">
                    <a href="/"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a>
                </li>



                <li class="submenu">
                    <a href="#"><i class="fa-solid fa-layer-group"></i> <span> Category</span> <span
                            class="menu-arrow"></span></a>
                    <ul style="display: none;">
                        <li><a href="{{ route('category.create') }}">Add Category</a></li>
                        <li><a href="{{ route('category.index') }}">View Category</a></li>

                    </ul>
                </li>
                <li class="submenu">
                    <a href="#"><i class="fa-solid fa-layer-group"></i> <span> SubCategory</span> <span
                            class="menu-arrow"></span></a>
                    <ul style="display: none;">
                        <li><a href="{{ route('subcategory.create') }}">Add SubCategory</a></li>
                        <li><a href="{{ route('subcategory.index') }}">View SubCategory</a></li>

                    </ul>
                </li>
                <li class="submenu">
                    <a href="#"><i class="fa-solid fa-layer-group"></i> <span> Supplier</span> <span
                            class="menu-arrow"></span></a>
                    <ul style="display: none;">
                        <li><a href="{{ route('supplier.create') }}">Add Supplier</a></li>
                        <li><a href="{{ route('supplier.index') }}">View Supplier</a></li>

                    </ul>
                </li>
                <li class="submenu">
                    <a href="#"><i class="fa-solid fa-layer-group"></i> <span> Quantity</span> <span
                            class="menu-arrow"></span></a>
                    <ul style="display: none;">
                        <li><a href="{{ route('quantity.create') }}">Add Quantity</a></li>
                        <li><a href="{{ route('quantity.index') }}">View Quantity</a></li>

                    </ul>
                </li>
                <li class="submenu">
                    <a href="#"><i class="fa-solid fa-layer-group"></i> <span>Product</span> <span
                            class="menu-arrow"></span></a>
                    <ul style="display: none;">
                        <li><a href="{{ route('product.create') }}">Add Product</a></li>
                        <li><a href="{{ route('product.index') }}">View Product</a></li>

                    </ul>
                </li>
                <li class="submenu">
                    <a href="#"><i class="fa-solid fa-layer-group"></i> <span>POS</span> <span
                            class="menu-arrow"></span></a>
                    <ul style="display: none;">
                        <li><a href="{{ route('AddPOSProduct.create') }}">Add POS</a></li>
                        <li><a href="{{ route('pos_userinfo.index') }}">View POS</a></li>

                    </ul>
                </li>



            </ul>
        </div>
    </div>
</div>
