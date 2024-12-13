@extends('base')

@section('title','-'. $article->titre)
@section('keywords', $article->mots_cles )
@section('description', $article->description  )

@section('content')

    <!-- Breaking News Start -->
    <div class="pt-3 mt-5 mb-3 container-fluid">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-12">
                    <div class="d-flex justify-content-between">
                        <div class="mb-0 section-title border-right-0" style="width: 180px;">
                            <h4 class="m-0 text-uppercase font-weight-bold">Nouvelles</h4>
                        </div>
                        <div class="bg-white border owl-carousel tranding-carousel position-relative d-inline-flex align-items-center border-left-0"
                            style="width: calc(100% - 180px); padding-right: 100px;">
                            @foreach ($communiques as $communique)
                            <div class="text-truncate"><a class="text-secondary text-uppercase font-weight-semi-bold" href="">{{ $communique->titre }}</a></div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Breaking News End -->


    <!-- News With Sidebar Start -->
    <div class="container-fluid">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <!-- News Detail Start -->
                    <div class="mb-3 position-relative">
                        <img class="img-fluid w-100" src="{{ Storage::url($article->image) }}" alt="{{ $article->titre }}" style="object-fit: cover;">
                        <div class="p-4 bg-white border border-top-0">
                            <div class="mb-3">
                                <a class="p-2 mr-2 badge badge-primary text-uppercase font-weight-semi-bold"
                                    href="{{ route('category.show', ['nom' => $article->category->nom ]) }}">{{ $article->category->nom ?? 'Sans catégorie' }}</a>
                                <a class="text-body" href="">{{ $article->created_at->translatedFormat('l d F Y') }}</a>
                            </div>
                            <h1 class="mb-3 text-secondary text-uppercase font-weight-bold">{{ $article->titre }}</h1><br>
                            {!! $article->contenu !!}
                        </div>
                        <div class="p-4 bg-white border d-flex justify-content-between border-top-0">
                            <div class="d-flex align-items-center">
                                <span>Auteur : {{ $article->auteur }}</span>
                            </div>
                            <div class="d-flex align-items-center">
                                <span class="ml-3"><i class="mr-2 far fa-eye"></i>{{ $article->vue }}</span>
                            </div>
                        </div>
                    </div>
                </div>
                @include('include.autreArticle')
            </div>
        </div>
    </div>
    <!-- News With Sidebar End -->




@endsection
