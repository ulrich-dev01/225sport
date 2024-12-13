<x-app-layout>
        <!-- include libraries(jQuery, bootstrap) -->
        <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

        <!-- include summernote css/js -->
        <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
        <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
            {{ __("Modifier l'article") }}
        </h2>
    </x-slot>

    <div class="container">
        <h1>Modifier l'article</h1>
        <form action="{{ route('articles.update', $article->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="titre">Titre</label>
                <input type="text" name="titre" class="form-control @error('titre') is-invalid @enderror" id="titre" value="{{ $article->titre }}" required>
                @error('titre')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="form-group">
                <label for="mots_cles">Mots Clés</label>
                <input type="text" name="mots_cles" class="form-control @error('mots_cles') is-invalid @enderror" id="mots_cles" value="{{ $article->mots_cles }}" required>
                @error('mots_cles')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="form-group">
                <label for="contenu">Contenu</label>
                <textarea name="contenu" class="form-control @error('contenu') is-invalid @enderror" id="summernote" required>{{ $article->contenu }}</textarea>
                @error('contenu')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="form-group">
                <label for="auteur">Auteur</label>
                <input type="text" name="auteur" class="form-control @error('auteur') is-invalid @enderror" id="auteur" value="{{ $article->auteur }}" required>
                @error('auteur')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="form-group">
                <label for="image">Image</label>
                <input type="file" name="image" class="form-control @error('image') is-invalid @enderror" id="image">
                @if($article->image)
                    <img src="{{ Storage::url($article->image) }}" alt="{{ $article->titre }}" style="max-width: 100px; margin-top: 10px;">
                @endif
                @error('image')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>


            <div class="form-group">
                <label for="category_id">Catégorie</label>
                <select name="category_id" class="form-control @error('category_id') is-invalid @enderror" id="category_id">
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ $article->category_id == $category->id ? 'selected' : '' }}>
                            {{ $category->nom }}
                        </option>
                    @endforeach
                </select>
                @error('category_id')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary">Mettre à jour</button>
        </form>
    </div>



    <!-- Scripts de Summernote -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.18/summernote-bs4.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#summernote').summernote({
                height: 300, // Hauteur de l'éditeur
            });
        });
    </script>
</x-app-layout>
