<div class="col-auto col-md-3 col-xl-2 px-sm-2 px-0 bg-dark">
    <div class="d-flex flex-column align-items-center align-items-sm-start px-3 pt-2 text-white min-vh-100">
        <a href="/" class="d-flex align-items-center pb-3 mb-md-0 me-md-auto text-white text-decoration-none">
            <span class="fs-5 d-none d-sm-inline">Menu</span>
        </a>
        <ul class="nav nav-pills flex-column mb-sm-auto mb-0" style="width: 270px" id="menu">
            <li class="nav-item-admin">
                <a href="{{route('artist.index')}}"  class="nav-link nav-link-hover px-0 align-middle">
                    <i class="fs-4 bi-speedometer2"></i> <span class="ms-1 d-none d-sm-inline">Артисти</span>
                </a>
            </li>
            <li class="nav-item-admin">
                <a href="{{route('event.index')}}" class="nav-link nav-link-hover px-0 align-middle">
                    <i class="fs-4 bi-speedometer2"></i> <span class="ms-1 d-none d-sm-inline">Концерти</span>
                </a>
            </li>
            <li class="nav-item-admin">
                <a href="{{route('genre.index')}}" class="nav-link nav-link-hover px-0 align-middle">
                    <i class="fs-4 bi-speedometer2"></i> <span class="ms-1 d-none d-sm-inline">Жанри</span>
                </a>
            </li>
            <li class="nav-item-admin">
                <a href="{{route('venue.index')}}" class="nav-link nav-link-hover px-0 align-middle">
                    <i class="fs-4 bi-speedometer2"></i> <span class="ms-1 d-none d-sm-inline">Розташування</span>
                </a>
            </li>
            <li class="nav-item-admin">
                <a href="{{route('user.index')}}" class="nav-link nav-link-hover px-0 align-middle">
                    <i class="fs-4 bi-speedometer2"></i> <span class="ms-1 d-none d-sm-inline">Користувачі</span>
                </a>
            </li>

        </ul>
        <hr>
    </div>
</div>
