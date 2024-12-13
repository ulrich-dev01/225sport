    <!-- Topbar Start -->
    <div class="container-fluid d-none d-lg-block">
        <div class="row align-items-center bg-dark px-lg-5">
            <div class="col-lg-9">
                <nav class="p-0 navbar navbar-expand-sm bg-dark">
                    <ul class="navbar-nav ml-n2">
                        <li class="nav-item border-right border-secondary">
                            <a class="nav-link text-body small" href="#"><span id="currentDateTime"></span></a>
                        </li>
                    </ul>
                </nav>
            </div>
            <div class="text-right col-lg-3 d-none d-md-block">
                <nav class="p-0 navbar navbar-expand-sm bg-dark">
                    <ul class="ml-auto navbar-nav mr-n2">
                        <li class="nav-item">
                            <a class="nav-link text-body" href="#"><small class="fab fa-twitter"></small></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-body" href="#"><small class="fab fa-facebook-f"></small></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-body" href="#"><small class="fab fa-linkedin-in"></small></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-body" href="#"><small class="fab fa-instagram"></small></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-body" href="#"><small class="fab fa-google-plus-g"></small></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-body" href="#"><small class="fab fa-youtube"></small></a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
        <div class="py-3 bg-white row align-items-center px-lg-5">
            <div class="col-lg-4">
                <a href="{{ route('home') }}" class="p-0 navbar-brand d-none d-lg-block">
                    <img src="{{ asset('logo/225.png') }}" alt="LOGO 225 Sport" width="50%">
                </a>
            </div>
            <div class="text-center col-lg-8 text-lg-right">
                @foreach ($banieres as $baniere)
                <a href="{{ $baniere->lien1 }}"><img class="img-fluid" src="{{ Storage::url($baniere->image1) }}" alt=""></a>
                @endforeach
            </div>
        </div>
    </div>
    <!-- Topbar End -->


    <!-- Navbar Start -->
    <div class="p-0 container-fluid">
        <nav class="py-2 navbar navbar-expand-lg bg-dark navbar-dark py-lg-0 px-lg-5">
            <a href="index.html" class="navbar-brand d-block d-lg-none">
                <h1 class="m-0 display-4 text-uppercase text-primary">
                    <img src="{{ asset('logo/225.png') }}" alt="" width="80%" height="100">
                </h1>
            </a>
            <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="px-0 collapse navbar-collapse justify-content-between px-lg-3" id="navbarCollapse">
                <div class="py-0 mr-auto navbar-nav">
                    <a href="{{ route('home') }}" class="nav-item nav-link {{ Route::currentRouteName() == 'home' ? 'active' : '' }}">Accueil</a>
                    @foreach ($liens as $lien)
                        <a href="{{ route('category.show', ['nom' => $lien->nom]) }}" class="nav-item nav-link {{ Request::is('category/' . $lien->nom) ? 'active' : '' }}">{{ $lien->nom }}</a>
                    @endforeach
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">Autres</a>
                        <div class="m-0 dropdown-menu rounded-0">
                            @foreach ($remainingCategories as $category)
                                <a href="{{ route('category.show', ['nom' => $category->nom]) }}" class="dropdown-item nav-item nav-link text-dark p-1 {{ Request::is('category/' . $category->nom) ? 'active' : '' }}">{{ $category->nom }}</a>
                            @endforeach
                        </div>
                    </div>
                </div>

                    <div class="d-block">
                        <div class="ml-auto input-group d-none d-lg-flex" style="width: 100%; max-width: 300px;">
                            <input type="text" id="search" class="border-0 form-control" placeholder="Keyword">
                            <div class="input-group-append">
                                <button type="submit" class="px-3 border-0 input-group-text bg-primary text-dark"><i class="fa fa-search"></i></button>
                            </div>
                        </div>
                        <div id="search-results" style="width: 100%; max-width: 300px; background: white; position: absolute; z-index: 1000;">
                            <!-- Les résultats de la recherche seront affichés ici -->
                        </div>
                    </div>
            </div>
        </nav>
    </div>
    <!-- Navbar End -->



