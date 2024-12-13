<x-app-layout>

    <!-- include libraries(jQuery, bootstrap) -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

    <!-- include summernote css/js -->
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>

    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
            {{ __('Ajouter un article') }}
        </h2>
    </x-slot>

    <div class="container mt-5">
        <!-- Affichage des messages d'erreur globaux -->
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Affichage des messages flash d'erreur avec Toastr -->
        @if(session('error'))
            <script>
                document.addEventListener('DOMContentLoaded', function () {
                    toastr.error('{{ session('error') }}', 'Erreur', {
                        closeButton: true,
                        progressBar: true,
                        positionClass: "toast-top-right",
                        timeOut: 5000
                    });
                });
            </script>
        @endif

        <form action="{{ route('articles.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="titre">Titre</label>
                <input type="text" name="titre" class="form-control @error('titre') is-invalid @enderror" id="titre" value="{{ old('titre') }}" required>
                @error('titre')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="form-group">
                <label for="mots_cles">Mots Clés</label>
                <input type="text" name="mots_cles" class="form-control @error('mots_cles') is-invalid @enderror" id="mots_cles" value="{{ old('mots_cles') }}" required>
                @error('mots_cles')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="form-group">
                <label for="contenu">Contenu</label>
                <textarea name="contenu" class="form-control @error('contenu') is-invalid @enderror" id="summernote" required>{{ old('contenu') }}</textarea>
                @error('contenu')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="form-group">
                <label for="auteur">Auteur</label>
                <input type="text" name="auteur" class="form-control @error('auteur') is-invalid @enderror" id="auteur" value="{{ old('auteur') }}" required>
                @error('auteur')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="form-group">
                <label for="image">Image</label>
                <input type="file" name="image" class="form-control @error('image') is-invalid @enderror" id="image">
                @error('image')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="form-group">
                <label for="category_id">Catégorie</label>
                <select name="category_id" class="form-control @error('category_id') is-invalid @enderror" id="category_id">
                    <option value="">Sélectionnez une catégorie</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>{{ $category->nom }}</option>
                    @endforeach
                </select>
                @error('category_id')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <button type="submit" class="mt-5 btn btn-primary">Enregistrer</button>
        </form>
    </div>

    <!-- Scripts de Summernote -->
    <script>
        $(document).ready(function() {
            $('#summernote').summernote({
                height: 300, // Hauteur de l'éditeur
            });
        });
    </script>
</x-app-layout>
