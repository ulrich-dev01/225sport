<x-app-layout>


    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
            {{ __('Modifier la bannière') }}
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

        <form action="{{ route('Banière.update', $banieres) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="lien1">Lien 1</label>
                <input type="text" name="lien1" class="form-control" id="lien1" value="{{ $banieres->lien1 }}" required>
            </div>
            <div class="form-group">
                <label for="image1">Image 1</label>
                <input type="file" name="image1" class="form-control" id="image1">
                @if($banieres->image1)
                    <img src="{{ asset('storage/' . $banieres->image1) }}" alt="Image 1" width="100">
                @endif
            </div>
            <div class="form-group">
                <label for="lien2">Lien 2</label>
                <input type="text" name="lien2" class="form-control" id="lien2" value="{{ $banieres->lien2 }}">
            </div>
            <div class="form-group">
                <label for="image2">Image 2</label>
                <input type="file" name="image2" class="form-control" id="image2">
                @if($banieres->image2)
                    <img src="{{ asset('storage/' . $banieres->image2) }}" alt="Image 2" width="100">
                @endif
            </div>
            <div class="form-group">
                <label for="lien3">Lien 3</label>
                <input type="text" name="lien3" class="form-control" id="lien3" value="{{ $banieres->lien3 }}">
            </div>
            <div class="form-group">
                <label for="image3">Image 3</label>
                <input type="file" name="image3" class="form-control" id="image3">
                @if($banieres->image3)
                    <img src="{{ asset('storage/' . $banieres->image3) }}" alt="Image 3" width="100">
                @endif
            </div>
            <button type="submit" class="btn btn-primary">Mettre à jour</button>
        </form>
    </div>

</x-app-layout>
