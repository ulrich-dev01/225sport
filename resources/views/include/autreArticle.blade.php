<div class="col-lg-4">
    <!-- Social Follow Start -->
    <div class="mb-3">
        <div class="mb-0 section-title">
            <h4 class="m-0 text-uppercase font-weight-bold">Suivez Nous</h4>
        </div>
        <div class="p-3 bg-white border border-top-0">
            <a href="" class="mb-3 text-white d-block w-100 text-decoration-none" style="background: #39569E;">
                <i class="py-4 mr-3 text-center fab fa-facebook-f" style="width: 65px; background: rgba(0, 0, 0, .2);"></i>
                <span class="font-weight-medium">12,345 Fans</span>
            </a>
            {{-- <a href="" class="mb-3 text-white d-block w-100 text-decoration-none" style="background: #52AAF4;">
                <i class="py-4 mr-3 text-center fab fa-twitter" style="width: 65px; background: rgba(0, 0, 0, .2);"></i>
                <span class="font-weight-medium">12,345 Followers</span>
            </a>
            <a href="" class="mb-3 text-white d-block w-100 text-decoration-none" style="background: #0185AE;">
                <i class="py-4 mr-3 text-center fab fa-linkedin-in" style="width: 65px; background: rgba(0, 0, 0, .2);"></i>
                <span class="font-weight-medium">12,345 Connects</span>
            </a>
            <a href="" class="mb-3 text-white d-block w-100 text-decoration-none" style="background: #C8359D;">
                <i class="py-4 mr-3 text-center fab fa-instagram" style="width: 65px; background: rgba(0, 0, 0, .2);"></i>
                <span class="font-weight-medium">12,345 Followers</span>
            </a>
            <a href="" class="mb-3 text-white d-block w-100 text-decoration-none" style="background: #DC472E;">
                <i class="py-4 mr-3 text-center fab fa-youtube" style="width: 65px; background: rgba(0, 0, 0, .2);"></i>
                <span class="font-weight-medium">12,345 Subscribers</span>
            </a>
            <a href="" class="text-white d-block w-100 text-decoration-none" style="background: #055570;">
                <i class="py-4 mr-3 text-center fab fa-vimeo-v" style="width: 65px; background: rgba(0, 0, 0, .2);"></i>
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
            <a href=""><img class="img-fluid" src="img/news-800x500-2.jpg" alt=""></a>
        </div>
    </div>
    <!-- Ads End -->

    <!-- Popular News Start -->
    <div class="mb-3">
        <div class="mb-0 section-title">
            <h4 class="m-0 text-uppercase font-weight-bold"> Publications</h4>
        </div>
        <div class="p-3 bg-white border border-top-0">
            @foreach ($articles as $article)

            <div class="mb-3 bg-white d-flex align-items-center" style="height: 110px; ">
                <img class="img-fluid" src="{{ Storage::url($article->image) }}" alt="{{ $article->titre }}" width="100">
                <div class="px-3 border w-100 h-100 d-flex flex-column justify-content-center border-left-0">
                    <div class="mb-2">
                        <a class="p-1 mr-2 badge badge-primary text-uppercase font-weight-semi-bold" href="{{ route('category.show', ['nom' => $article->category->nom ]) }}">{{ $article->category->nom ?? 'Sans catégorie' }}</a>
                        <a class="text-body" href=""><small>{{ $article->created_at->translatedFormat('l d F Y') }}</small></a>
                    </div>
                    <a class="m-0 h6 text-secondary text-uppercase font-weight-bold" href="">{{ Str::limit(strip_tags($article->titre), 40, '...') }}</a>
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
                <a href="{{ route('category.show', ['nom' => $categorie->nom]) }}" class="m-1 btn btn-sm btn-outline-secondary {{ Request::is('category/' . $categorie->nom) ? 'btn-secondary text-white' : '' }}">{{ $categorie->nom }}</a>
                @endforeach
            </div>
        </div>
    </div>
    <!-- Tags End -->
</div>
