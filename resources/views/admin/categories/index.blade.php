<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
            {{ __('Catégories Des Articles') }}
        </h2>
    </x-slot>

    <div class="container mt-5">
        <a href="{{ route('categories.create') }}" class="mb-3 btn btn-primary">Ajouter une catégorie</a>
            <!-- Affichage des messages flash -->
            @if(session('success'))
                <script>
                    document.addEventListener('DOMContentLoaded', function () {
                        toastr.success('{{ session('success') }}', 'Succès', {
                            closeButton: true,
                            progressBar: true,
                            positionClass: "toast-top-right",
                            timeOut: 5000
                        });
                    });
                </script>
            @endif
        <table class="table">
            <thead>
                <tr>
                    <th>Nom</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($categories as $category)
                    <tr>
                        <td>{{ $category->nom }}</td>
                        <td>
                            <a href="{{ route('categories.edit', $category->id) }}" class="btn btn-warning">Modifier</a>
                            <form action="{{ route('categories.destroy', $category->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger end-7">Supprimer</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{ $categories->links() }}
    </div>
</x-app-layout>
