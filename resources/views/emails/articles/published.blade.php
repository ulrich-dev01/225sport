{{-- <x-mail::message>
# Introduction

The body of your message.

<x-mail::button :url="''">
Button Text
</x-mail::button>

Thanks,<br>
{{ config('app.name') }}
</x-mail::message> --}}



@component('mail::message')
{{-- Logo --}}
<img src="{{ asset('favicon.ico') }}" alt="Logo de {{ config('app.name') }}" style="width: 150px; height: auto;">

# Un nouvel article a été publié !

**Titre :** {{ $article->titre }}

**Auteur :** {{ $article->auteur }}

**Catégorie :** {{ $article->category->nom ?? 'Sans catégorie' }}

**Aperçu :**   {!! strip_tags(Str::limit($article->contenu, 100)) !!}

@component('mail::button', ['url' => route('articles.show', $article->slug)])
Lire l'article
@endcomponent

Merci d'être abonné à {{ config('app.name') }} !

@endcomponent
