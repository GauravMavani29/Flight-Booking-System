<div class="sidebar py-md-5 me-0 px-4 py-4">
    <div class="d-flex flex-column h-100">
        <a href="{{ route('admin.dashboard') }}" class="brand-icon justify-content-center mb-0 h2" target="_blank">
            <x-application-logo class="block h-9 w-auto fill-current text-gray-800" />
        </a>
        <ul class="menu-list flex-grow-1" id="main-menu">
            <li class="collapsed">
                <a class="m-link" data-bs-toggle="collapse" data-bs-target="#roles" href="#">
                    <i class="icofont-robot fs-5"></i> <span>Staffs</span> <span
                        class="arrow icofont-rounded-down fs-5 ms-auto text-end"></span></a>
                <!-- Menu: Sub menu ul -->
                <ul class="sub-menu collapse" id="roles">
                    <li><a class="ms-link " href="{{ route('admin.staff.index') }}"><span class="ms-link-text"><i
                                    class="icofont-swoosh-right"></i>&nbsp;All staffs</span></a>
                    </li>
                    <li><a class="ms-link " href="{{ route('admin.staff.create') }}"><span class="ms-link-text"><i
                                    class="icofont-swoosh-right"></i>&nbsp;Add staff</span></a>
                    </li>
                    <li><a class="ms-link " href="{{ route('admin.role.index') }}"><span class="ms-link-text"><i
                                    class="icofont-swoosh-right"></i>&nbsp;Staff
                                permissions</span></a></li>
                </ul>
            </li>
            <li class="collapsed">
                <a class="m-link" data-bs-toggle="collapse" data-bs-target="#permissions" href="#">
                    <i class="icofont-ssl-security fs-5"></i><span>Permissions</span> <span
                        class="arrow icofont-rounded-down fs-5 ms-auto text-end"></span></a>
                <!-- Menu: Sub menu ul -->
                <ul class="sub-menu  collapse" id="permissions">
                    <li><a class="ms-link " href="{{ route('admin.permission.index') }}"><span class="ms-link-text"><i
                                    class="icofont-swoosh-right"></i>&nbsp;All
                                permissions</span></a></li>
                    <li><a class="ms-link " href="{{ route('admin.permission.create') }}"><span class="ms-link-text"><i
                                    class="icofont-swoosh-right"></i>&nbsp;Add
                                permissions</span></a></li>
                </ul>
            </li>
            <li><a class="m-link" href="{{ route('admin.logout') }}"><i class="icofont-logout fs-5 "></i>
                    <span class="ms-link-text">Signout</span></a></li>
        </ul>
        <!-- Menu: main ul -->
        {{-- <div class="mt-2"><input class="form-control" type="text" name="" id="menu-search" onkeyup="menuSearch()"
                placeholder="Search in menu"></div>
        <ul class="menu-list m-0" id="search-menu">
        </ul>
        <ul class="menu-list flex-grow-1" id="main-menu">
            @php
                $user = Auth::user();
                $userRole = $user->hasRole('Super Admin');

                $pending_accepted_count = App\Models\Task::whereHas('task_statuses', function ($query) {
                    $query->where('accepted', 0)->where('status', 0);
                })->count();

                $pending_status_count = App\Models\Task::whereHas('task_statuses', function ($query) {
                    $query->where('accepted', 1)->where('status', 0);
                })->count();

                $completed_task_count = App\Models\Task::whereHas('task_statuses', function ($query) {
                    $query->where('status', 1);
                })->count();

            @endphp

            @forelse ($user->roles as $role)
                @if ($role->name == 'Super Admin')
                    <li class="collapsed">
                        <a class="m-link" data-bs-toggle="collapse" data-bs-target="#tasks" href="#">
                            <i class="icofont-crown"></i><span>Task Management</span> <span
                                class="arrow icofont-rounded-down fs-5 ms-auto text-end"></span></a>
                        <!-- Menu: Sub menu ul -->
                        <ul class="sub-menu show collapse" id="tasks">
                            <li><a class="ms-link {{ isActiveRoute('admin.project-management') }}"
                                    href="{{ route('admin.project-management') }}"><span class="ms-link-text"><i
                                            class="icofont-swoosh-right"></i>&nbsp;Project Management</span></a>
                            </li>
                            <li><a class="ms-link {{ isActiveRoute('admin.title-management') }}"
                                    href="{{ route('admin.title-management') }}"><span class="ms-link-text"><i
                                            class="icofont-swoosh-right"></i>&nbsp;Title Management</span></a>
                            </li>
                            <li><a class="ms-link {{ isActiveRoute('admin.task-management') }}"
                                    href="{{ route('admin.task-management') }}"><span class="ms-link-text"><i
                                            class="icofont-swoosh-right"></i>&nbsp;
                                        Task Management&nbsp;<br><i class="badge rounded-pill bgg"
                                            style="color: rgb(255, 255, 255); background:  rgb(255, 70, 70);">
                                            {{ $pending_accepted_count }}
                                        </i>&nbsp;<i class="badge rounded-pill bgg"
                                            style="color: rgb(0, 0, 0); background: rgb(244, 255, 92);">
                                            {{ $pending_status_count }}
                                        </i>&nbsp;<i class="badge rounded-pill bgg"
                                            style="color: rgb(0, 0, 0); background: rgb(109, 255, 109);">
                                            {{ $completed_task_count }}
                                        </i></span></a>
                            </li>
                            <li><a class="ms-link {{ isActiveRoute('admin.self-tasks') }}"
                                    href="{{ route('admin.self-tasks') }}"><span class="ms-link-text"><i
                                            class="icofont-swoosh-right"></i>&nbsp;
                                        Self Task Management</span></a></li>
                            <li><a class="ms-link {{ isActiveRoute('staff.todo-list') }}"
                                    href="{{ route('staff.todo-list') }}"><span class="ms-link-text"><i
                                            class="icofont-swoosh-right"></i>&nbsp;
                                        Todo List</span></a></li>
                        </ul>
                    </li>
                    <hr>
                    <li><a class="m-link {{ isActiveRoute('admin.dashboard') }}"
                            href="{{ route('admin.dashboard') }}"><i class="icofont-home fs-5"></i>
                            <span class="ms-link-text">Dashboard</span></a></li>
                    <li><a class="m-link {{ isActiveRoute('admin.general-setting') }}"
                            href="{{ route('admin.general-setting') }}"><i class="icofont-gear fs-5"></i>
                            <span class="ms-link-text">General Setting</span></a></li>
                    <li class="collapsed">
                        <a class="m-link" data-bs-toggle="collapse" data-bs-target="#roles" href="#">
                            <i class="icofont-robot fs-5"></i> <span>Staffs</span> <span
                                class="arrow icofont-rounded-down fs-5 ms-auto text-end"></span></a>
                        <!-- Menu: Sub menu ul -->
                        <ul class="sub-menu {{ isDropdownExpanded('admin.staff.index', 'admin.staff.create', 'admin.role.index', 'admin.staff.edit', 'admin.role.edit', 'admin.user.pending') ? 'show' : '' }} collapse"
                            id="roles">
                            <li><a class="ms-link {{ isActiveRoute('admin.staff.index') }}"
                                    href="{{ route('admin.staff.index') }}"><span class="ms-link-text"><i
                                            class="icofont-swoosh-right"></i>&nbsp;All staffs</span></a>
                            </li>
                            <li><a class="ms-link {{ isActiveRoute('admin.staff.create') }}"
                                    href="{{ route('admin.staff.create') }}"><span class="ms-link-text"><i
                                            class="icofont-swoosh-right"></i>&nbsp;Add staff</span></a>
                            </li>
                            <li><a class="ms-link {{ isActiveRoute('admin.role.index') }}"
                                    href="{{ route('admin.role.index') }}"><span class="ms-link-text"><i
                                            class="icofont-swoosh-right"></i>&nbsp;Staff
                                        permissions</span></a></li>
                            <li><a class="ms-link {{ isActiveRoute('admin.user.pending') }}"
                                    href="{{ route('admin.user.pending') }}"><span class="ms-link-text"><i
                                            class="icofont-swoosh-right"></i>&nbsp;User
                                        pending</span></a></li>
                        </ul>
                    </li>
                    <li class="collapsed">
                        <a class="m-link" data-bs-toggle="collapse" data-bs-target="#permissions" href="#">
                            <i class="icofont-ssl-security fs-5"></i><span>Permissions</span> <span
                                class="arrow icofont-rounded-down fs-5 ms-auto text-end"></span></a>
                        <!-- Menu: Sub menu ul -->
                        <ul class="sub-menu {{ isDropdownExpanded('admin.permission.index', 'admin.permission.create', 'admin.permission.edit') ? 'show' : '' }} collapse"
                            id="permissions">
                            <li><a class="ms-link {{ isActiveRoute('admin.permission.index') }}"
                                    href="{{ route('admin.permission.index') }}"><span class="ms-link-text"><i
                                            class="icofont-swoosh-right"></i>&nbsp;All
                                        permissions</span></a></li>
                            <li><a class="ms-link {{ isActiveRoute('admin.permission.create') }}"
                                    href="{{ route('admin.permission.create') }}"><span class="ms-link-text"><i
                                            class="icofont-swoosh-right"></i>&nbsp;Add
                                        permissions</span></a></li>
                        </ul>
                    </li>

                    <li class="collapsed">
                        <a class="m-link" data-bs-toggle="collapse" data-bs-target="#categories" href="#">
                            <i class="icofont-chart-flow fs-5"></i><span>Categories</span> <span
                                class="arrow icofont-rounded-down fs-5 ms-auto text-end"></span></a>
                        <!-- Menu: Sub menu ul -->
                        <ul class="sub-menu {{ isDropdownExpanded('admin.category.index', 'admin.category.create', 'admin.category.edit') ? 'show' : '' }} collapse"
                            id="categories">
                            <li><a class="ms-link {{ isActiveRoute('admin.category.index') }}"
                                    href="{{ route('admin.category.index') }}"><span class="ms-link-text"><i
                                            class="icofont-swoosh-right"></i>&nbsp;All
                                        Category</span></a></li>
                            <li><a class="ms-link {{ isActiveRoute('admin.category.create') }}"
                                    href="{{ route('admin.category.create') }}"><span class="ms-link-text"><i
                                            class="icofont-swoosh-right"></i>&nbsp;Add
                                        Category</span></a></li>
                        </ul>
                    </li>
                    <li class="collapsed">
                        <a class="m-link" data-bs-toggle="collapse" data-bs-target="#brands" href="#">
                            <i class="icofont-crown"></i><span>Brands</span> <span
                                class="arrow icofont-rounded-down fs-5 ms-auto text-end"></span></a>
                        <!-- Menu: Sub menu ul -->
                        <ul class="sub-menu {{ isDropdownExpanded('admin.brand.index', 'admin.brand.create', 'admin.brand.edit') ? 'show' : '' }} collapse"
                            id="brands">
                            <li><a class="ms-link {{ isActiveRoute('admin.brand.index') }}"
                                    href="{{ route('admin.brand.index') }}"><span class="ms-link-text"><i
                                            class="icofont-swoosh-right"></i>&nbsp;All
                                        Brand</span></a></li>
                            <li><a class="ms-link {{ isActiveRoute('admin.brand.create') }}"
                                    href="{{ route('admin.brand.create') }}"><span class="ms-link-text"><i
                                            class="icofont-swoosh-right"></i>&nbsp;Add
                                        Brand</span></a></li>
                        </ul>
                    </li>
                    <li class="collapsed">
                        <a class="m-link" data-bs-toggle="collapse" data-bs-target="#attributes" href="#">
                            <i class="icofont-at"></i><span>Attributes</span> <span
                                class="arrow icofont-rounded-down fs-5 ms-auto text-end"></span></a>
                        <!-- Menu: Sub menu ul -->
                        <ul class="sub-menu {{ isDropdownExpanded('admin.attribute.index', 'admin.attribute.create', 'admin.attribute.edit', 'admin.attribute.show', 'admin.edit-attribute-value') ? 'show' : '' }} collapse"
                            id="attributes">
                            <li><a class="ms-link {{ isActiveRoute('admin.attribute.index') }}"
                                    href="{{ route('admin.attribute.index') }}"><span class="ms-link-text"><i
                                            class="icofont-swoosh-right"></i>&nbsp;All
                                        Attribute</span></a></li>
                            <li><a class="ms-link {{ isActiveRoute('admin.attribute.create') }}"
                                    href="{{ route('admin.attribute.create') }}"><span class="ms-link-text"><i
                                            class="icofont-swoosh-right"></i>&nbsp;Add
                                        Attribute</span></a></li>
                        </ul>
                    </li>
                @endif


                @if ($role->name == 'User' || $role->name == 'Super Admin')
                    <li class="collapsed">
                        <a class="m-link" data-bs-toggle="collapse" data-bs-target="#menu-product" href="#">
                            <i class="icofont-truck-loaded fs-5"></i> <span>Products</span> <span
                                class="arrow icofont-rounded-down fs-5 ms-auto text-end"></span></a>
                        <!-- Menu: Sub menu ul -->
                        <ul class="sub-menu {{ isDropdownExpanded('admin.product.index', 'admin.product.create', 'admin.product.edit', 'admin.product.show') ? 'show' : '' }} collapse"
                            id="menu-product">
                            <li><a class="ms-link {{ isActiveRoute('admin.product.index') }}"
                                    href="{{ route('admin.product.index') }}"><span class="ms-link-text"><i
                                            class="icofont-swoosh-right"></i>&nbsp;Product Grid</span></a>
                            </li>
                            <li><a class="ms-link {{ isActiveRoute('admin.product.create') }}"
                                    href="{{ route('admin.product.create') }}"><span class="ms-link-text"><i
                                            class="icofont-swoosh-right"></i>&nbsp;Add Product</span></a>
                            </li>
                        </ul>
                    </li>
                @endif
                @if ($role->name == 'Super Admin')
                    <li class="collapsed">
                        <a class="m-link" data-bs-toggle="collapse" data-bs-target="#menu-collection"
                            href="#">
                            <i class="icofont-royal fs-5"></i> <span>Collections</span> <span
                                class="arrow icofont-rounded-down fs-5 ms-auto text-end"></span></a>
                        <!-- Menu: Sub menu ul -->
                        <ul class="sub-menu {{ isDropdownExpanded('admin.collections.index', 'admin.collections.create', 'admin.collections.edit', 'admin.collections.show') ? 'show' : '' }} collapse"
                            id="menu-collection">
                            <li><a class="ms-link {{ isActiveRoute('admin.collections.index') }}"
                                    href="{{ route('admin.collections.index') }}"><span class="ms-link-text"><i
                                            class="icofont-swoosh-right"></i>&nbsp;Collection Grid</span></a>
                            </li>
                            <li><a class="ms-link {{ isActiveRoute('admin.collections.create') }}"
                                    href="{{ route('admin.collections.create') }}"><span class="ms-link-text"><i
                                            class="icofont-swoosh-right"></i>&nbsp;Add Collection</span></a>
                            </li>
                        </ul>
                    </li>
                    <li class="collapsed">
                        <a class="m-link" data-bs-toggle="collapse" data-bs-target="#menu-blog" href="#">
                            <i class="icofont-book-alt fs-5"></i> <span>Blogs</span> <span
                                class="arrow icofont-rounded-down fs-5 ms-auto text-end"></span></a>
                        <!-- Menu: Sub menu ul -->
                        <ul class="sub-menu {{ isDropdownExpanded('admin.blogs.index', 'admin.blogs.create', 'admin.blogs.edit', 'admin.blogs.show') ? 'show' : '' }} collapse"
                            id="menu-blog">
                            <li><a class="ms-link {{ isActiveRoute('admin.blogs.index') }}"
                                    href="{{ route('admin.blogs.index') }}"><span class="ms-link-text"><i
                                            class="icofont-swoosh-right"></i>&nbsp;Blog Grid</span></a>
                            </li>
                            <li><a class="ms-link {{ isActiveRoute('admin.blogs.create') }}"
                                    href="{{ route('admin.blogs.create') }}"><span class="ms-link-text"><i
                                            class="icofont-swoosh-right"></i>&nbsp;Add Blog</span></a>
                            </li>
                        </ul>
                    </li>
                    <li class="collapsed">
                        <a class="m-link" data-bs-toggle="collapse" data-bs-target="#menu-discount" href="#">
                            <i class="icofont-sale-discount fs-5"></i> <span>Discounts</span> <span
                                class="arrow icofont-rounded-down fs-5 ms-auto text-end"></span></a>
                        <!-- Menu: Sub menu ul -->
                        <ul class="sub-menu {{ isDropdownExpanded('admin.discounts.index', 'admin.discounts.create', 'admin.discounts.edit', 'admin.discounts.show') ? 'show' : '' }} collapse"
                            id="menu-discount">
                            <li><a class="ms-link {{ isActiveRoute('admin.discounts.index') }}"
                                    href="{{ route('admin.discounts.index') }}"><span class="ms-link-text"><i
                                            class="icofont-swoosh-right"></i>&nbsp;Discount Grid</span></a>
                            </li>
                            <li><a class="ms-link {{ isActiveRoute('admin.discounts.create') }}"
                                    href="{{ route('admin.discounts.create') }}"><span class="ms-link-text"><i
                                            class="icofont-swoosh-right"></i>&nbsp;Add Discount</span></a>
                            </li>
                        </ul>
                    </li>
                    <li class="collapsed">
                        <a class="m-link" data-bs-toggle="collapse" data-bs-target="#menu-faq" href="#">
                            <i class="icofont-support-faq fs-5"></i> <span>FAQs</span> <span
                                class="arrow icofont-rounded-down fs-5 ms-auto text-end"></span></a>
                        <!-- Menu: Sub menu ul -->
                        <ul class="sub-menu {{ isDropdownExpanded('admin.faqs.index', 'admin.faqs.create', 'admin.faqs.edit', 'admin.faqs.show') ? 'show' : '' }} collapse"
                            id="menu-faq">
                            <li><a class="ms-link {{ isActiveRoute('admin.faqs.index') }}"
                                    href="{{ route('admin.faqs.index') }}"><span class="ms-link-text"><i
                                            class="icofont-swoosh-right"></i>&nbsp;FAQ Grid</span></a>
                            </li>
                            <li><a class="ms-link {{ isActiveRoute('admin.faqs.create') }}"
                                    href="{{ route('admin.faqs.create') }}"><span class="ms-link-text"><i
                                            class="icofont-swoosh-right"></i>&nbsp;Add FAQ</span></a>
                            </li>
                        </ul>
                    </li>

                    <li><a class="m-link {{ isActiveRoute('admin.brand.userBrandCreate') }}"
                            href="{{ route('admin.brand.userBrandCreate') }}"><i class="icofont-crown fs-5"></i>
                            <span class="ms-link-text">Brand</span></a></li>
                @endif
                @if ($role->name == 'Staff')
                    <li><a class="m-link {{ isActiveRoute('staff.task-management') }}"
                            href="{{ route('staff.task-management') }}"><i class="icofont-crown fs-5"></i>
                            <span class="ms-link-text">Task Management</span></a></li>
                    <li><a class="m-link {{ isActiveRoute('staff.todo-list') }}"
                            href="{{ route('staff.todo-list') }}"><i class="icofont-crown fs-5"></i>
                            <span class="ms-link-text">Todo List</span></a></li>
                @endif
            @empty
            @endforelse


           
        </ul> --}}
        <!-- Menu: menu collepce btn -->
        <button type="button" class="btn btn-link sidebar-mini-btn text-light">
            <span class="ms-2"><i class="icofont-bubble-right"></i></span>
        </button>
    </div>
</div>
