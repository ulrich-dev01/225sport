<x-app-layout>


    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
            {{ __('Ajouter une nouvelle bannière') }}
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

        <form action="{{ route('Banière.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="lien1">Lien 1</label>
                <input type="text" name="lien1" class="form-control" id="lien1" required>
            </div>
            <div class="form-group">
                <label for="image1">Image 1</label>
                <input type="file" name="image1" class="form-control" id="image1" required>
            </div>
            <div class="form-group">
                <label for="lien2">Lien 2</label>
                <input type="text" name="lien2" class="form-control" id="lien2">
            </div>
            <div class="form-group">
                <label for="image2">Image 2</label>
                <input type="file" name="image2" class="form-control" id="image2">
            </div>
            <div class="form-group">
                <label for="lien3">Lien 3</label>
                <input type="text" name="lien3" class="form-control" id="lien3">
            </div>
            <div class="form-group">
                <label for="image3">Image 3</label>
                <input type="file" name="image3" class="form-control" id="image3">
            </div>
            <button type="submit" class="btn btn-primary">Ajouter</button>
        </form>
    </div>

</x-app-layout>
