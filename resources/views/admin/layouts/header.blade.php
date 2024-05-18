<div class="header">
    <nav class="navbar py-4">
        <div class="container-xxl">

            <!-- header rightbar icon -->
            <div class="h-right d-flex align-items-center mr-lg-0 order-1 mr-5">
                {{-- <div class="d-flex">
                    <a class="nav-link text-primary collapsed" href="help.html" title="Get Help">
                        <i class="icofont-info-square fs-5"></i>
                    </a>
                </div>
                <div class="dropdown zindex-popover">
                    <a class="nav-link dropdown-toggle pulse" href="#" role="button" data-bs-toggle="dropdown">
                        <img src="../dist/assets/images/flag/GB.png" alt="">
                    </a>
                    <div
                        class="dropdown-menu dropdown-animation dropdown-menu-md-end m-0 mt-3 rounded-lg border-0 p-0 shadow">
                        <div class="card border-0">
                            <ul class="list-unstyled px-3 py-2">
                                <li>
                                    <a href="#" class=""><img src="../dist/assets/images/flag/GB.png"
                                            alt=""> English</a>
                                </li>
                                <li>
                                    <a href="#" class=""><img src="../dist/assets/images/flag/DE.png"
                                            alt=""> German</a>
                                </li>
                                <li>
                                    <a href="#" class=""><img src="../dist/assets/images/flag/FR.png"
                                            alt=""> French</a>
                                </li>
                                <li>
                                    <a href="#" class=""><img src="../dist/assets/images/flag/IT.png"
                                            alt=""> Italian</a>
                                </li>
                                <li>
                                    <a href="#" class=""><img src="../dist/assets/images/flag/RU.png"
                                            alt=""> Russian</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div> --}}
                {{-- <div class="dropdown notifications">
                    <a class="nav-link dropdown-toggle pulse" href="#" role="button" data-bs-toggle="dropdown">
                        <i class="icofont-alarm fs-5"></i>
                        <span class="pulse-ring"></span>
                    </a>
                    <div id="NotificationsDiv"
                        class="dropdown-menu dropdown-animation dropdown-menu-md-end m-0 mt-3 rounded-lg border-0 p-0 shadow">
                        <div class="card w380 border-0">
                            <div class="card-header border-0 p-3">
                                <h5 class="font-weight-light d-flex justify-content-between mb-0">
                                    <span>Notifications</span>
                                    <span class="badge text-white">06</span>
                                </h5>
                            </div>
                            <div class="tab-content card-body">
                                <div class="tab-pane fade show active">
                                    <ul class="list-unstyled list mb-0">
                                        <li class="border-bottom mb-1 py-2">
                                            <a href="javascript:void(0);" class="d-flex">
                                                <img class="avatar rounded-circle" src="assets/images/xs/avatar1.svg"
                                                    alt="">
                                                <div class="flex-fill ms-2">
                                                    <p class="d-flex justify-content-between mb-0"><span
                                                            class="font-weight-bold">Chloe Walkerr</span>
                                                        <small>2MIN</small>
                                                    </p>
                                                    <span class="">Added New Product 2021-07-15 <span
                                                            class="badge bg-success">Add</span></span>
                                                </div>
                                            </a>
                                        </li>
                                        <li class="border-bottom mb-1 py-2">
                                            <a href="javascript:void(0);" class="d-flex">
                                                <div class="avatar rounded-circle no-thumbnail">AH</div>
                                                <div class="flex-fill ms-2">
                                                    <p class="d-flex justify-content-between mb-0"><span
                                                            class="font-weight-bold">Alan Hill</span>
                                                        <small>13MIN</small>
                                                    </p>
                                                    <span class="">Invoice generator </span>
                                                </div>
                                            </a>
                                        </li>
                                        <li class="border-bottom mb-1 py-2">
                                            <a href="javascript:void(0);" class="d-flex">
                                                <img class="avatar rounded-circle" src="assets/images/xs/avatar3.svg"
                                                    alt="">
                                                <div class="flex-fill ms-2">
                                                    <p class="d-flex justify-content-between mb-0"><span
                                                            class="font-weight-bold">Melanie Oliver</span>
                                                        <small>1HR</small>
                                                    </p>
                                                    <span class="">Orader Return RT-00004</span>
                                                </div>
                                            </a>
                                        </li>
                                        <li class="border-bottom mb-1 py-2">
                                            <a href="javascript:void(0);" class="d-flex">
                                                <img class="avatar rounded-circle" src="assets/images/xs/avatar5.svg"
                                                    alt="">
                                                <div class="flex-fill ms-2">
                                                    <p class="d-flex justify-content-between mb-0"><span
                                                            class="font-weight-bold">Boris Hart</span>
                                                        <small>13MIN</small>
                                                    </p>
                                                    <span class="">Product Order to Toyseller</span>
                                                </div>
                                            </a>
                                        </li>
                                        <li class="border-bottom mb-1 py-2">
                                            <a href="javascript:void(0);" class="d-flex">
                                                <img class="avatar rounded-circle" src="assets/images/xs/avatar6.svg"
                                                    alt="">
                                                <div class="flex-fill ms-2">
                                                    <p class="d-flex justify-content-between mb-0"><span
                                                            class="font-weight-bold">Alan Lambert</span>
                                                        <small>1HR</small>
                                                    </p>
                                                    <span class="">Leave Apply</span>
                                                </div>
                                            </a>
                                        </li>
                                        <li class="py-2">
                                            <a href="javascript:void(0);" class="d-flex">
                                                <img class="avatar rounded-circle" src="assets/images/xs/avatar7.svg"
                                                    alt="">
                                                <div class="flex-fill ms-2">
                                                    <p class="d-flex justify-content-between mb-0"><span
                                                            class="font-weight-bold">Zoe Wright</span> <small
                                                            class="">1DAY</small></p>
                                                    <span class="">Product Stoke Entry Updated</span>
                                                </div>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <a class="card-footer border-top-0 text-center" href="#"> View all notifications</a>
                        </div>
                    </div>
                </div> --}}
                @php
                    $user = Auth::user();
                @endphp
                <div class="dropdown user-profile ml-sm-3 d-flex align-items-center zindex-popover ml-2">
                    <div class="u-info me-2">
                        <p class="line-height-sm mb-0 text-end"><span class="font-weight-bold">{{ $user->name }}</span>
                        </p>
                        <small>Admin Profile</small>
                    </div>
                    <a class="nav-link dropdown-toggle pulse p-0" href="#" role="button" data-bs-toggle="dropdown"
                        data-bs-display="static">
                        <img class="avatar lg rounded-circle img-thumbnail"
                            src="{{ asset('admin/assets/images/profile_av.svg') }}" alt="profile">
                    </a>

                    <div class="dropdown-menu dropdown-animation dropdown-menu-end m-0 rounded-lg border-0 p-0 shadow">
                        <div class="card w280 border-0">
                            <div class="card-body pb-0">
                                <div class="d-flex py-1">
                                    <img class="avatar rounded-circle"
                                        src="{{ asset('admin/assets/images/profile_av.svg') }}" alt="profile">
                                    <div class="flex-fill ms-3">
                                        <p class="mb-0"><span class="font-weight-bold">{{ $user->name }}</span>
                                        </p>
                                        <small class="">{{ $user->email }}</small>
                                    </div>
                                </div>

                                <div>
                                    <hr class="dropdown-divider border-dark">
                                </div>
                            </div>
                            <div class="list-group m-2">
                                {{-- <a href="admin-profile.html"
                                    class="list-group-item list-group-item-action border-0"><i
                                        class="icofont-ui-user fs-5 me-3"></i>Profile Page</a>
                                <a href="order-invoices.html"
                                    class="list-group-item list-group-item-action border-0"><i
                                        class="icofont-file-text fs-5 me-3"></i>Order Invoices</a> --}}
                                <a href="{{ route('admin.logout') }}"
                                    class="list-group-item list-group-item-action border-0"><i
                                        class="icofont-logout fs-5 me-3"></i>Signout</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- menu toggler -->
            <button class="navbar-toggler menu-toggle order-3 border-0 p-0" type="button" data-bs-toggle="collapse"
                data-bs-target="#mainHeader">
                <span class="fa fa-bars"></span>
            </button>

            <!-- main menu Search-->
            <div class="order-0 col-lg-4 col-md-4 col-sm-12 col-12 mb-md-0 mb-3">
                <div class="input-group input-group-lg flex-nowrap">
                    <input type="search" class="form-control" placeholder="Search" aria-label="search"
                        aria-describedby="addon-wrapping">
                    <button type="button" class="input-group-text" id="addon-wrapping"><i
                            class="fa fa-search"></i></button>
                </div>
            </div>

        </div>
    </nav>
</div>
