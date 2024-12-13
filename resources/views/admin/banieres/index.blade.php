<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
            {{ __('Liste des bannières') }}
        </h2>
    </x-slot>

    <div class="container table-responsive">
        {{-- <a href="{{ route('Banière.create') }}" class="btn btn-primary">Liste des bannières</a> --}}
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
                    <th>ID</th>
                    {{-- <th>Lien 1</th> --}}
                    <th>Image 1</th>
                    {{-- <th>Lien 2</th> --}}
                    <th>Image 2</th>
                    {{-- <th>Lien 3</th> --}}
                    <th>Image 3</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($banieres as $baniere)
                    <tr>
                        <td>{{ $baniere->id }}</td>
                        {{-- <td>{{ $baniere->lien1 }}</td> --}}
                        <td><img src="{{ Storage::url($baniere->image1) }}"></td>
                        {{-- <td>{{ $baniere->lien2 }}</td> --}}
                        <td><img src="{{ Storage::url($baniere->image2) }}"></td>
                        {{-- <td>{{ $baniere->lien3 }}</td> --}}
                        <td><img src="{{ Storage::url($baniere->image3) }}"></td>
                        <td>
                            <a href="{{ route('Banière.edit', $baniere) }}" class="btn btn-warning">Modifier</a>
                            {{-- <form action="{{ route('Banière.destroy', $baniere) }}" method="POST" style="display:inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Supprimer</button>
                            </form> --}}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

    </div>
</x-app-layout>
