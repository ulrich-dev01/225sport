<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
            {{ __('Tout les Communiqués de 255 Sport') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="container table-responsive">
            <a href="{{ route('communiqué.create') }}" class="mb-3 btn btn-primary">Ajouter un Communiqué</a>
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
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th>Titre</th>
                        <th>image</th>
                        <th>Auteur</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($communiquees as $communique)
                        <tr>
                            <td>{{ $communique->titre }}</td>
                            <td>
                                <img src="{{ Storage::url($communique->image) }}" alt="{{ $communique->titre }}" style="max-width: 100px; margin-top: 10px;">
                            </td>
                            <td>{{ $communique->auteur }}</td>
                            <td>
                                <a href="{{ route('communiqué.edit', $communique->id) }}" class="btn btn-warning">Modifier</a>
                                <form action="{{ route('communiqué.destroy', $communique->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="mt-5 btn btn-danger">Supprimer</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $communiquees->links() }}
        </div>
    </div>
</x-app-layout>
