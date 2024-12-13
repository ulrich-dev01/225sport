@extends('base')

@section('title', ' ')
@section('keywords', 'mots clés spécifiques, séparés par des virgules')
@section('description', 'Description spécifique à cette page')

@section('content')


    <!-- News With Sidebar Start -->
    <div class="pt-3 mt-5 container-fluid">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="row">
                        <div class="col-12">
                            <div class="section-title">
                                <h4 class="m-0 text-uppercase font-weight-bold">Catégorie: {{ $category->nom }}</h4>
                            </div>
                        </div>
                        @foreach ($article as $article)
                        <div class="col-lg-6">

                            <div class="mb-3 position-relative">
                                <img class="img-fluid w-100" src="{{ Storage::url($article->image) }}" alt="{{ $article->titre }}" style="object-fit: cover;">
                                <div class="p-4 bg-white border border-top-0">
                                    <div class="mb-2">
                                        <a class="p-2 mr-2 badge badge-primary text-uppercase font-weight-semi-bold"
                                            href="{{ route('category.show', ['nom' => $article->category->nom ]) }}">{{ $article->category->nom ?? 'Sans catégorie' }}</a>
                                        <a class="text-body" href=""><small>{{ $article->created_at->translatedFormat('l d F Y') }}</small></a>
                                    </div>
                                    <a class="mb-3 h4 d-block text-secondary text-uppercase font-weight-bold" href="{{ route('articles.show', ['slug' => $article->slug]) }}">{{ Str::limit(strip_tags($article->titre), 20, '...') }}</a>
                                    <p class="m-0">{{ Str::limit(strip_tags($article->description), 100, '...') }}</p>
                                </div>
                                <div class="p-4 bg-white border d-flex justify-content-between border-top-0">
                                    <div class="d-flex align-items-center">
                                        <small>{{ $article->auteur }}</small>
                                    </div>
                                    <div class="d-flex align-items-center">
                                        <small class="ml-3"><i class="mr-2 far fa-eye"></i>{{ $article->vue }}</small>
                                    </div>
                                </div>
                            </div>

                        </div>
                        @endforeach
                    </div>
                </div>

                @include('include.autreArticle')
            </div>
        </div>
    </div>
    <!-- News With Sidebar End -->


@endsection
