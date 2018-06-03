<!-- Navbar-->
<nav class="navbar navbar-expand-lg">
    <div class="container"><a href="/" class="navbar-brand"><img src="{{ asset('img/logo.png') }}" alt="..." width="180" class="img-fluid"></a>
        <button type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation" class="navbar-toggler navbar-toggler-right"><span></span><span></span><span></span></button>
        <div id="navbarSupportedContent" class="collapse navbar-collapse">
            <ul class="navbar-nav mx-auto">
                <li class="nav-item {{ isActiveURL('/') }}">
                    <a href="/" class="nav-link">
                        Home
                    </a>
                </li>
                <li class="nav-item {{ isActiveURL('/about') }}">
                    <a href="/about" class="nav-link">About</a>
                </li>
                <li class="nav-item {{ areActiveURLS(['/property', '/property/list']) }}">
                    <a href="/property" class="nav-link">Property</a>
                </li>
                <li class="nav-item {{ isActiveURL('/gallery') }}">
                    <a href="/gallery" class="nav-link">Gallery</a>
                </li>
            </ul>
            {{-- @can('create-house') --}}
                <ul class="secondary-nav-menu list-inline ml-auto mb-0">
                    <li class="list-inline-item"><a href="/houses/create" class="btn btn-primary btn-gradient">Submit property</a></li>
                </ul>
            {{-- @endcan --}}
        </div>
    </div>
</nav>
