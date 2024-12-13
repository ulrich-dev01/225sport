@extends('base')

@section('title', ' ')
@section('keywords', 'mots clés spécifiques, séparés par des virgules')
@section('description', 'Description spécifique à cette page')

@section('content')
    <!-- Main News Slider Start -->
    <div class="container-fluid">
        <div class="row">
            <div class="px-0 col-lg-7">
                <div class="owl-carousel main-carousel position-relative">
                    @foreach ($lastThreeArticles as $article)
                        <div class="overflow-hidden position-relative" style="height: 500px;">
                            <img class="img-fluid h-100" src="{{ asset('storage/' . $article->image) }}" style="object-fit: cover;" alt="{{ $article->titre }}">
                            <div class="overlay">
                                <div class="mb-2">
                                    <a class="p-2 mr-2 badge badge-primary text-uppercase font-weight-semi-bold"
                                    href="{{ route('category.show', ['nom' => $article->category->nom ]) }}">{{ $article->category->nom ?? 'Sans catégorie' }}</a>
                                    <a class="text-white" href="">{{ $article->created_at->translatedFormat('l d F Y') }}</a>
                                </div>
                                <a class="m-0 text-white h2 text-uppercase font-weight-bold" href="{{ route('articles.show', ['slug' => $article->slug]) }}">{{ Str::limit(strip_tags($article->titre), 100, '...') }}</a>
                            </div>
                        </div>
                    @endforeach

                    {{-- <div class="overflow-hidden position-relative" style="height: 500px;">
                        <img class="img-fluid h-100" src="img/news-800x500-2.jpg" style="object-fit: cover;">
                        <div class="overlay">
                            <div class="mb-2">
                                <a class="p-2 mr-2 badge badge-primary text-uppercase font-weight-semi-bold"
                                    href="">Business</a>
                                <a class="text-white" href="">Jan 01, 2045</a>
                            </div>
                            <a class="m-0 text-white h2 text-uppercase font-weight-bold" href="">Lorem ipsum dolor
                                sit amet elit. Proin vitae porta diam...</a>
                        </div>
                    </div>
                    <div class="overflow-hidden position-relative" style="height: 500px;">
                        <img class="img-fluid h-100" src="img/news-800x500-3.jpg" style="object-fit: cover;">
                        <div class="overlay">
                            <div class="mb-2">
                                <a class="p-2 mr-2 badge badge-primary text-uppercase font-weight-semi-bold"
                                    href="">Business</a>
                                <a class="text-white" href="">Jan 01, 2045</a>
                            </div>
                            <a class="m-0 text-white h2 text-uppercase font-weight-bold" href="">Lorem ipsum dolor
                                sit amet elit. Proin vitae porta diam...</a>
                        </div>
                    </div> --}}
                </div>
            </div>
            <div class="px-0 col-lg-5">
                <div class="mx-0 row">
                    @foreach ($nextFourArticles as $article)
                        <div class="px-0 col-md-6">
                            <div class="overflow-hidden position-relative" style="height: 250px;">
                                <img class="img-fluid w-100 h-100" src="{{ asset('storage/' . $article->image) }}" style="object-fit: cover;" alt="{{ $article->titre }}">
                                <div class="overlay">
                                    <div class="mb-2">
                                        <a class="p-2 mr-2 badge badge-primary text-uppercase font-weight-semi-bold"
                                            href="{{ route('category.show', ['nom' => $article->category->nom ]) }}">{{ $article->category->nom ?? 'Sans catégorie' }}</a>
                                        <a class="text-white" href=""><small>{{ $article->created_at->translatedFormat('l d F Y') }}</small></a>
                                    </div>
                                    <a class="m-0 text-white h6 text-uppercase font-weight-semi-bold" href="{{ route('articles.show', ['slug' => $article->slug]) }}">{{ Str::limit(strip_tags($article->titre), 20, '...') }}</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                    {{-- <div class="px-0 col-md-6">
                        <div class="overflow-hidden position-relative" style="height: 250px;">
                            <img class="img-fluid w-100 h-100" src="img/news-700x435-2.jpg" style="object-fit: cover;">
                            <div class="overlay">
                                <div class="mb-2">
                                    <a class="p-2 mr-2 badge badge-primary text-uppercase font-weight-semi-bold"
                                        href="">Business</a>
                                    <a class="text-white" href=""><small>Jan 01, 2045</small></a>
                                </div>
                                <a class="m-0 text-white h6 text-uppercase font-weight-semi-bold" href="">Lorem ipsum
                                    dolor sit amet elit...</a>
                            </div>
                        </div>
                    </div>
                    <div class="px-0 col-md-6">
                        <div class="overflow-hidden position-relative" style="height: 250px;">
                            <img class="img-fluid w-100 h-100" src="img/news-700x435-3.jpg" style="object-fit: cover;">
                            <div class="overlay">
                                <div class="mb-2">
                                    <a class="p-2 mr-2 badge badge-primary text-uppercase font-weight-semi-bold"
                                        href="">Business</a>
                                    <a class="text-white" href=""><small>Jan 01, 2045</small></a>
                                </div>
                                <a class="m-0 text-white h6 text-uppercase font-weight-semi-bold" href="">Lorem ipsum
                                    dolor sit amet elit...</a>
                            </div>
                        </div>
                    </div>
                    <div class="px-0 col-md-6">
                        <div class="overflow-hidden position-relative" style="height: 250px;">
                            <img class="img-fluid w-100 h-100" src="img/news-700x435-4.jpg" style="object-fit: cover;">
                            <div class="overlay">
                                <div class="mb-2">
                                    <a class="p-2 mr-2 badge badge-primary text-uppercase font-weight-semi-bold"
                                        href="">Business</a>
                                    <a class="text-white" href=""><small>Jan 01, 2045</small></a>
                                </div>
                                <a class="m-0 text-white h6 text-uppercase font-weight-semi-bold" href="">Lorem
                                    ipsum dolor sit amet elit...</a>
                            </div>
                        </div>
                    </div> --}}
                </div>
            </div>
        </div>
    </div>
    <!-- Main News Slider End -->


    <!-- Breaking News Start -->
    <div class="py-3 mb-3 container-fluid bg-dark">
        <div class="container">
            <div class="row align-items-center bg-dark">
                <div class="col-12">
                    <div class="d-flex justify-content-between">
                        <div class="py-2 text-center bg-primary text-dark font-weight-medium" style="width: 170px;"> Communiqués </div>
                        <div class="ml-3 owl-carousel tranding-carousel position-relative d-inline-flex align-items-center"
                            style="width: calc(100% - 170px); padding-right: 90px;">
                            @foreach ($communiques as $communique)
                            <div class="text-truncate"><a class="text-white text-uppercase font-weight-semi-bold"
                                    href="{{ route('communique.show', ['slug' => $communique->slug]) }}">{{ $communique->titre }}</a></div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Breaking News End -->


    <!-- Featured News Slider Start -->
    <div class="pt-5 mb-3 container-fluid">
        <div class="container">
            <div class="section-title">
                <h4 class="m-0 text-uppercase font-weight-bold">Les articles, les plus vues</h4>
            </div>
            <div class="owl-carousel news-carousel carousel-item-4 position-relative">
                @foreach ($articlesVues as $article)

                <div class="overflow-hidden position-relative" style="height: 300px;">
                    <img class="img-fluid h-100" src="{{ asset('storage/' . $article->image) }}" style="object-fit: cover;" width="100%">
                    <div class="overlay">
                        <div class="mb-2">
                            <a class="p-2 mr-2 badge badge-primary text-uppercase font-weight-semi-bold"
                                href="{{ route('category.show', ['nom' => $article->category->nom ]) }}">{{ $article->category->nom ?? 'Sans catégorie' }}</a>
                            <a class="text-white" href="{{ route('articles.show', ['slug' => $article->slug]) }}"><small>{{ $article->created_at->translatedFormat('l d F Y') }}</small></a>
                        </div>
                        <a class="m-0 text-white h6 text-uppercase font-weight-semi-bold" href="{{ route('articles.show', ['slug' => $article->slug]) }}">{{ Str::limit(strip_tags($article->titre), 20, '...') }}</a>
                    </div>
                </div>

                @endforeach
            </div>
        </div>
    </div>
    <!-- Featured News Slider End -->


    <!-- News With Sidebar Start -->
    <div class="container-fluid">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="row">
                        <div class="col-12">
                            <div class="section-title">
                                <h4 class="m-0 text-uppercase font-weight-bold">Dernières Nouvelles</h4>
                            </div>
                        </div>
                        {{-- Les 5 et 6 --}}
                        @foreach ($nextFourArticles1 as $article)
                            <div class="col-lg-6">
                                <div class="mb-3 position-relative">
                                    <img class="img-fluid w-100" src="{{ asset('storage/' . $article->image) }}" style="object-fit: cover;">
                                    <div class="p-4 bg-white border border-top-0">
                                        <div class="mb-2">
                                            <a class="p-2 mr-2 badge badge-primary text-uppercase font-weight-semi-bold"
                                                href="{{ route('category.show', ['nom' => $article->category->nom ]) }}">{{ $article->category->nom ?? 'Sans catégorie' }}</a>
                                            <a class="text-body" href="{{ route('articles.show', ['slug' => $article->slug]) }}"><small>{{ $article->created_at->translatedFormat('l d F Y') }}</small></a>
                                        </div>
                                        <a class="mb-3 h4 d-block text-secondary text-uppercase font-weight-bold"
                                            href="{{ route('articles.show', ['slug' => $article->slug]) }}">{{ Str::limit(strip_tags($article->titre), 40, '...') }}</a>
                                        <p class="m-0">{{ Str::limit(strip_tags($article->contenu), 200, '...') }}</p>
                                    </div>
                                    <div class="p-4 bg-white border d-flex justify-content-between border-top-0">
                                        <div class="d-flex align-items-center">
                                            <small>Par : {{ $article->auteur }}</small>
                                        </div>
                                        <div class="d-flex align-items-center">
                                            <small class="ml-3"><i class="mr-2 far fa-eye"></i>{{ $article->vue }}</small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach

                        @foreach ($banieres as $baniere)
                        <div class="mb-3">
                            <a href="{{ $baniere->lien2 }}"><img class="img-fluid" src="{{ Storage::url($baniere->image2) }}" alt=""></a>
                        </div>
                        @endforeach

                        @foreach ($nextFourArticles2 as $article)
                            <div class="col-lg-6">
                                    <div class="mb-3 position-relative">
                                        <img class="img-fluid w-100" src="{{ asset('storage/' . $article->image) }}" style="object-fit: cover;">
                                        <div class="p-4 bg-white border border-top-0">
                                            <div class="mb-2">
                                                <a class="p-2 mr-2 badge badge-primary text-uppercase font-weight-semi-bold"
                                                    href="{{ route('category.show', ['nom' => $article->category->nom ]) }}">{{ $article->category->nom ?? 'Sans catégorie' }}</a>
                                                <a class="text-body" href="{{ route('articles.show', ['slug' => $article->slug]) }}"><small>{{ $article->created_at->translatedFormat('l d F Y') }}</small></a>
                                            </div>
                                            <a class="mb-0 h4 d-block text-secondary text-uppercase font-weight-bold"
                                                href="{{ route('articles.show', ['slug' => $article->slug]) }}">{{ Str::limit(strip_tags($article->titre), 40, '...') }}</a>
                                        </div>
                                        <div class="p-4 bg-white border d-flex justify-content-between border-top-0">
                                            <div class="d-flex align-items-center">
                                                <small>Par : {{ $article->auteur }}</small>
                                            </div>
                                            <div class="d-flex align-items-center">
                                                <small class="ml-3"><i class="mr-2 far fa-eye"></i>{{ $article->vue }}</small>
                                                {{-- <small class="ml-3"><i class="mr-2 far fa-comment"></i>123</small> --}}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        {{-- <div class="col-lg-6">
                            <div class="mb-3 position-relative">
                                <img class="img-fluid w-100" src="img/news-700x435-4.jpg" style="object-fit: cover;">
                                <div class="p-4 bg-white border border-top-0">
                                    <div class="mb-2">
                                        <a class="p-2 mr-2 badge badge-primary text-uppercase font-weight-semi-bold"
                                            href="">Business</a>
                                        <a class="text-body" href=""><small>Jan 01, 2045</small></a>
                                    </div>
                                    <a class="mb-0 h4 d-block text-secondary text-uppercase font-weight-bold"
                                        href="">Lorem ipsum dolor sit amet elit...</a>
                                </div>
                                <div class="p-4 bg-white border d-flex justify-content-between border-top-0">
                                    <div class="d-flex align-items-center">
                                        <img class="mr-2 rounded-circle" src="img/user.jpg" width="25"
                                            height="25" alt="">
                                        <small>John Doe</small>
                                    </div>
                                    <div class="d-flex align-items-center">
                                        <small class="ml-3"><i class="mr-2 far fa-eye"></i>12345</small>
                                        <small class="ml-3"><i class="mr-2 far fa-comment"></i>123</small>
                                    </div>
                                </div>
                            </div>
                        </div> --}}
                        @foreach ($nextFourArticles3 as $article)
                            <div class="col-lg-6">
                                <div class="mb-3 bg-white d-flex align-items-center" style="height: 110px;">
                                    <img class="img-fluid" src="{{ asset('storage/' . $article->image) }}" alt="{{ asset('storage/' . $article->titre) }}" width="100" height="100px">
                                    <div
                                        class="px-3 border w-100 h-100 d-flex flex-column justify-content-center border-left-0">
                                        <div class="mb-2">
                                            <a class="p-1 mr-2 badge badge-primary text-uppercase font-weight-semi-bold"
                                                href="{{ route('category.show', ['nom' => $article->category->nom ]) }}">{{ $article->category->nom ?? 'Sans catégorie' }}</a>
                                            <a class="text-body" href="{{ route('articles.show', ['slug' => $article->slug]) }}"><small>{{ $article->created_at->translatedFormat('l d F Y') }}</small></a>
                                        </div>
                                        <a class="m-0 h6 text-secondary text-uppercase font-weight-bold" href="{{ route('articles.show', ['slug' => $article->slug]) }}">{{ Str::limit(strip_tags($article->titre), 40, '...') }}</a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                        <br>
                        @foreach ($banieres as $baniere)
                            <a href="{{ $baniere->lien3 }}"><img class="img-fluid" src="{{ Storage::url($baniere->image3) }}" alt=""></a>
                        @endforeach

                    </div>
                </div>

                <div class="col-lg-4">
                    <!-- Social Follow Start -->
                    <div class="mb-3">
                        <div class="mb-0 section-title">
                            <h4 class="m-0 text-uppercase font-weight-bold">Suivez-nous</h4>
                        </div>
                        <div class="p-3 bg-white border border-top-0">
                            <a href="#" class="mb-3 text-white d-block w-100 text-decoration-none"
                                style="background: #39569E;">
                                <i class="py-4 mr-3 text-center fab fa-facebook-f"
                                    style="width: 65px; background: rgba(0, 0, 0, .2);"></i>
                                <span class="font-weight-medium">12,345 Fans</span>
                            </a>
                            {{-- <a href="" class="mb-3 text-white d-block w-100 text-decoration-none"
                                style="background: #52AAF4;">
                                <i class="py-4 mr-3 text-center fab fa-twitter"
                                    style="width: 65px; background: rgba(0, 0, 0, .2);"></i>
                                <span class="font-weight-medium">12,345 Followers</span>
                            </a>
                            <a href="" class="mb-3 text-white d-block w-100 text-decoration-none"
                                style="background: #0185AE;">
                                <i class="py-4 mr-3 text-center fab fa-linkedin-in"
                                    style="width: 65px; background: rgba(0, 0, 0, .2);"></i>
                                <span class="font-weight-medium">12,345 Connects</span>
                            </a>
                            <a href="" class="mb-3 text-white d-block w-100 text-decoration-none"
                                style="background: #C8359D;">
                                <i class="py-4 mr-3 text-center fab fa-instagram"
                                    style="width: 65px; background: rgba(0, 0, 0, .2);"></i>
                                <span class="font-weight-medium">12,345 Followers</span>
                            </a>
                            <a href="" class="mb-3 text-white d-block w-100 text-decoration-none"
                                style="background: #DC472E;">
                                <i class="py-4 mr-3 text-center fab fa-youtube"
                                    style="width: 65px; background: rgba(0, 0, 0, .2);"></i>
                                <span class="font-weight-medium">12,345 Subscribers</span>
                            </a>
                            <a href="" class="text-white d-block w-100 text-decoration-none"
                                style="background: #055570;">
                                <i class="py-4 mr-3 text-center fab fa-vimeo-v"
                                    style="width: 65px; background: rgba(0, 0, 0, .2);"></i>
                                <span class="font-weight-medium">12,345 Followers</span>
                            </a> --}}
                        </div>
                    </div>
                    <!-- Social Follow End -->

                    <!-- Ads Start -->
                    <div class="mb-3">
                        <div class="mb-0 section-title">
                            <h4 class="m-0 text-uppercase font-weight-bold">Publicité</h4>
                        </div>
                        <div class="p-3 text-center bg-white border border-top-0">
                            <a href=""><img class="img-fluid" src="" alt=""></a>
                        </div>
                    </div>
                    <!-- Ads End -->

                    <!-- Popular News Start -->
                    <div class="mb-3">
                        <div class="mb-0 section-title">
                            <h4 class="m-0 text-uppercase font-weight-bold">Communiqués</h4>
                        </div>
                        <div class="p-3 bg-white border border-top-0">
                            @foreach ($communiques as $communique)
                            <div class="mb-3 bg-white d-flex align-items-center" style="height: 110px;">
                                <img class="img-fluid" src="{{ asset('storage/' . $communique->image) }}" alt="{{ $communique->titre }}" width="100">
                                <div
                                    class="px-3 border w-100 h-100 d-flex flex-column justify-content-center border-left-0">
                                    <div class="mb-2">
                                        <a class="text-body" href="{{ route('communique.show', ['slug' => $communique->slug]) }}"><small>{{ $communique->created_at->translatedFormat('l d F Y') }}</small></a>
                                    </div>
                                    <a class="m-0 h6 text-secondary text-uppercase font-weight-bold" href="{{ route('communique.show', ['slug' => $communique->slug]) }}">{{ Str::limit(strip_tags($communique->titre), 10, '...') }}</a>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    <!-- Popular News End -->

                    <!-- Newsletter Start -->
                    @include('include.letter')
                    <!-- Newsletter End -->

                    <!-- Tags Start -->
                    <div class="mb-3">
                        <div class="mb-0 section-title">
                            <h4 class="m-0 text-uppercase font-weight-bold">Tags</h4>
                        </div>
                        <div class="p-3 bg-white border border-top-0">
                            <div class="flex-wrap d-flex m-n1">
                                @foreach ($categories as $categorie)
                                <a href="{{ route('category.show', ['nom' => $categorie->nom]) }}" class="m-1 btn btn-sm btn-outline-secondary {{ Request::is('category/' . $categorie->nom) ? 'btn-secondary' : '' }}">{{ $categorie->nom }}</a>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <!-- Tags End -->
                </div>
            </div>
        </div>
    </div>
    <!-- News With Sidebar End -->
@endsection
