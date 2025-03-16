<?php
use App\Models\Role;
use App\Models\User;
$roleid = Auth::user()->role_id;
$roledata = Role::where('id', '=', $roleid)->first();
?>
<div class="sidebar" id="sidebar">
    <div class="sidebar-inner slimscroll">
        <div id="sidebar-menu" class="sidebar-menu">
            <ul>

                <li class="active">
                    <a href="/"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a>
                </li>
                @if ($roledata->role_access == 'all' || $roledata->category == 'Category')
                    <li class="submenu">
                        <a href="#"><i class="fa-solid fa-list-check"></i> <span> Category
                            </span> <span class="menu-arrow"></span></a>
                        <ul style="display: none;">
                            <li><a href="{{ route('category.create') }}">Add Category</a></li>
                            <li><a href="{{ route('category.index') }}">View Category</a></li>

                        </ul>
                    </li>
                @endif
                @if ($roledata->role_access == 'all' || $roledata->subcategory == 'SubCategory')
                    <li class="submenu">
                        <a href="#"><i class="fa-solid fa-layer-group"></i> <span>Sub-Catgory </span> <span
                                class="menu-arrow"></span></a>
                        <ul style="display: none;">
                            <li><a href="{{ route('subcategory.create') }}">Add Sub-Category</a></li>
                            <li><a href="{{ route('subcategory.index') }}">View Sub-Category</a></li>

                        </ul>
                    </li>
                @endif
                @if ($roledata->role_access == 'all' || $roledata->quantity == 'Quantity')
                    <li class="submenu">
                        <a href="#"><i class="fa-solid fa-map-location-dot"></i> <span>Quantity</span> <span
                                class="menu-arrow"></span></a>
                        <ul style="display: none;">
                            <li><a href="{{ route('quantity.create') }}">Add Quantity</a></li>
                            <li><a href="{{ route('quantity.index') }}">View Quantity</a></li>

                        </ul>
                    </li>
                @endif
                @if ($roledata->role_access == 'all' || $roledata->supplier == 'Supplier')
                    <li class="submenu">
                        <a href="#"><i class="fa-solid fa-hand-holding-heart"></i> <span> Supplier</span> <span
                                class="menu-arrow"></span></a>
                        <ul style="display: none;">
                            <li><a href="{{ route('supplier.create') }}">Add Supplier</a></li>
                            <li><a href="{{ route('supplier.index') }}">View Supplier</a></li>

                        </ul>
                    </li>
                @endif
                @if ($roledata->role_access == 'all' || $roledata->products == 'Product')
                    <li class="submenu">
                        <a href="#"><i class="fa-solid fa-globe"></i> <span>Products</span> <span
                                class="menu-arrow"></span></a>
                        <ul style="display: none;">
                            <li><a href="{{ route('product.create') }}">Add Products</a></li>
                            <li><a href="{{ route('product.index') }}">View Products</a></li>

                        </ul>
                    </li>
                @endif
                @if ($roledata->role_access == 'all' || $roledata->pos == 'POS')
                    <li class="submenu">
                        <a href="#"><i class="fa-brands fa-first-order-alt"></i> <span>POS</span> <span
                                class="menu-arrow"></span></a>
                        <ul style="display: none;">
                            <li><a href="{{ route('AddPOSProduct.create') }}">Add POS</a></li>
                            <li><a href="{{ route('pos_userinfo.index') }}">View POS</a></li>

                        </ul>
                    </li>
                @endif
                {{-- <li class="submenu">
                    <a href="#"><i class="fa-solid fa-bookmark"></i> <span>Users</span> <span
                            class="menu-arrow"></span></a>
                    <ul style="display: none;">
                        <li><a href="{{ route('users.create') }}">Add Users</a></li>
                        <li><a href="{{ route('users.index') }}">View Users</a></li>

                    </ul>
                </li> --}}
                @if ($roledata->role_access == 'all' || $roledata->orders == 'Orders')
                    <li><a href="{{ route('orders.index') }}"><i class="fa-solid fa-bookmark"></i>&nbsp;&nbsp;View
                            Orders</a></li>
                @endif
                @if ($roledata->role_access == 'all' || $roledata->contact == 'Contact')
                    <li><a href="{{ route('contact.index') }}"><i class="fa-solid fa-list"></i>&nbsp;&nbsp; View
                            Contacts</a></li>
                @endif
                @if ($roledata->role_access == 'all' || $roledata->user_management == 'User-Management')
                    <li class="submenu">
                        <a href="#"><i class="fa-solid fa-bars-progress"></i> <span>User Management</span> <span
                                class="menu-arrow"></span></a>
                        <ul style="display: none;">
                            <li><a href="{{ route('role.create') }}">Add Role</a></li>
                            <li><a href="{{ route('role.index') }}">View Role</a></li>
                            <li><a href="{{ route('assignRole.create') }}">Assign Role</a></li>
                            <li><a href="{{ route('assignRole.index') }}">View Assign Role</a></li>

                        </ul>
                    </li>
                @endif


            </ul>
        </div>
    </div>
</div>
<script>
 document.addEventListener("DOMContentLoaded", function () {
    let currentUrl = window.location.href;
    document.querySelectorAll(".submenu ul li a").forEach(link => {
        if (link.href === currentUrl) {
            link.parentElement.classList.add("active"); // Highlight the clicked submenu item
            link.closest(".submenu").classList.add("open"); // Keep main menu open
            link.closest(".submenu").querySelector("ul").style.display = "block";
        }
    });
});

</script>
