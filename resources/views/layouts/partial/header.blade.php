<div class="header @@classList">
    <!-- navbar -->
    <nav class="navbar-classic navbar navbar-expand-lg">
        <a id="nav-toggle" href="#"><i data-feather="menu" class="nav-icon me-2 icon-xs"></i></a>
        <!--Navbar nav -->
        <ul class="navbar-nav navbar-right-wrap ms-auto d-flex nav-top-wrap">
            <!-- List -->
            <li class="dropdown ms-2">
                <a class="rounded-circle" href="#" role="button" id="dropdownUser" data-bs-toggle="dropdown"
                    aria-haspopup="true" aria-expanded="false">
                    <div class="avatar avatar-md avatar-indicators avatar-online">
                        <img alt="avatar" src="{{ asset('asset/avatar.jpg') }}" class="rounded-circle" />
                    </div>
                </a>
                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownUser">
                    <div class="px-4 pb-0 pt-2">
                        <div class="lh-1">
                            <h4 class="mb-1 fw-bold"> {{ auth()->user()->name }}</h4>
                            <p href="#" class="text-inherit fs-6">{{ auth()->user()->role }}</p>
                        </div>
                        <div class=" dropdown-divider mt-3 mb-2"></div>
                    </div>

                    <ul class="list-unstyled">
                        <li>
                            <a class="dropdown-item" href="#">
                                <i class="me-2 icon-xxs dropdown-item-icon" data-feather="user"></i>Edit
                                Profile
                            </a>
                        </li>
                        <li>
                            <form action="/logout" method="GET">
                                @csrf
                                <button class="btn dropdown-item" type="submit">
                                    <i class="me-2 icon-xxs dropdown-item-icon" data-feather="power"></i>Sign Out
                                </button>
                            </form>
                        </li>
                    </ul>
                </div>
            </li>
        </ul>
    </nav>
</div>
