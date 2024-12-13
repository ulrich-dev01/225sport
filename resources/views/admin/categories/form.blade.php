{{-- <x-guest-layout>
    <div>
        <h1 class="text-center mb-20 mt-10 text-bold">Ajouter une Catégorie</h1>
    </div>
    <form method="POST" action="{{ route('categories.store') }}">
        @csrf

        <!-- Name -->
        <div>
            <x-input-label for="nom" :value="__('Nom de la catégorie')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>




        <div class="flex items-center justify-end mt-4">
            <x-primary-button class="ms-4">
                {{ __('Ajouter') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout> --}}

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Ajouter une categorie') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="container">
                <form action="{{ route('categories.store') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="name">Nom</label>
                        <input type="text" name="nom" class="form-control border-radui" id="nom" required>
                    </div>
                    <button type="submit" class="btn btn-primary mt-3">Enregistrer</button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>

