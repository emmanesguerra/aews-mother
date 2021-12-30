<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="{{ route('welcome') }}">AE Purified Drinking Station</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-item nav-link {{  request()->routeIs('customer.*') ? 'active' : '' }}" href="{{ route('customer.index') }}">Customer List</a>
                </li>
                <li class="nav-item">
                    <a class="nav-item nav-link {{  request()->routeIs('payhistory.*') ? 'active' : '' }}" href="{{ route('payhistory.index') }}">Payment List</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-item nav-link {{  request()->routeIs('customer.*') ? 'active' : '' }}" href="{{ route('customer.index') }}">Order List</a>
                </li>
            </ul>
        </div>
    </div>
</nav>