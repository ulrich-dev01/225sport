<?php

namespace App\Http\Controllers;

use App\Models\article;
use App\Http\Requests\StorearticleRequest;
use App\Http\Requests\UpdatearticleRequest;
use App\Mail\ArticlePublished;
use App\Models\banieres;
use App\Models\category;
use App\Models\communiquees;
use App\Models\letter;
use DOMDocument;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request as HttpRequest;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File; // Importation correcte de File
use Illuminate\Support\Facades\Request;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $articles = Article::with('category')->paginate(25);
        return view('admin.articles.index', compact('articles'));
    }

    public function Accueil()
    {
        // Récupérer tous les articles ordonnés par date de création décroissante
        $articles = Article::orderBy('created_at', 'desc')->get();

        // Séparer les articles en deux groupes: les trois derniers et les quatre suivants
        $lastThreeArticles = $articles->take(3); // Les 3 derniers
        $nextFourArticles = $articles->slice(3, 4); // Les 4 suivants
        $nextFourArticles1 = $articles->slice(7, 2); // Les 2 suivants
        $nextFourArticles2 = $articles->slice(9, 2); // Les 2 suivants
        $nextFourArticles3 = $articles->slice(11, 4); // Les 2 suivants

        $articlesVues = Article::orderBy('vue', 'desc')->take(10)->get(); //Les dix articles les plus vue

        $communiques = communiquees::latest()->take(4)->get(); //les communiqués

        $liens = Category::take(4)->get();

        // Sauter les 4 premières catégories et prendre toutes les suivantes
        $remainingCategories = Category::offset(4)->limit(PHP_INT_MAX)->get();


        $categories = category::all();

        $banieres = banieres::all();

        return view('site.index', compact('lastThreeArticles','remainingCategories', 'nextFourArticles', 'nextFourArticles1', 'nextFourArticles2', 'nextFourArticles3', 'communiques', 'articlesVues', 'categories', 'liens', 'banieres'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = category::all();
        return view('admin.articles.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreArticleRequest $request)
    {
        $request->validated();

        try {
            // Gestion de l'image principale (champ image du formulaire)
            $imagePath = null;
            if ($request->hasFile('image')) {
                $imagePath = $request->file('image')->store('images', 'public');
            }

            // Récupération du contenu
            $contenu = $request->input('contenu');

            // Chargement du contenu dans DOMDocument
            $dom = new \DOMDocument('1.0', 'utf-8');
            libxml_use_internal_errors(true);
            $dom->loadHTML(mb_convert_encoding($contenu, 'HTML-ENTITIES', 'UTF-8'), LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
            libxml_clear_errors();

            // Dossier où les images seront enregistrées
            $imageDir = public_path('article_images');

            // Vérifier si le dossier existe, sinon le créer
            if (!File::exists($imageDir)) {
                File::makeDirectory($imageDir, 0755, true);
            }

            // Traitement des images encodées en base64
            $images = $dom->getElementsByTagName('img');
            foreach ($images as $img) {
                $src = $img->getAttribute('src');

                // Vérifier si l'image est encodée en base64
                if (strpos($src, 'data:image/') === 0) {
                    // Extraire la partie base64 de l'image
                    $base64Part = explode(',', $src)[1];
                    $data = base64_decode($base64Part);

                    // Générer un nom de fichier unique
                    $image_name = "article_images/" . time() . '_' . uniqid() . '.png';
                    $image_path = public_path($image_name);

                    // Enregistrer l'image dans le dossier public
                    file_put_contents($image_path, $data);

                    // Mettre à jour l'attribut 'src' pour pointer vers le fichier enregistré
                    $img->setAttribute('src', asset($image_name));
                }
            }

            // Sauvegarder le contenu avec les chemins d'images mis à jour
            $contenu = $dom->saveHTML();

            // Créer l'article
            $article = Article::create([
                'titre' => $request->titre,
                'mots_cles' => $request->mots_cles,
                'contenu' => $contenu, // Utiliser le contenu traité avec les images mises à jour
                'auteur' => $request->auteur,
                'image' => $imagePath,
                'category_id' => $request->category_id,
                'slug' => Str::slug($request->titre) // Générer un slug basé sur le titre
            ]);

            // Envoi de l'email aux utilisateurs
            $users = Letter::all(); // Récupérer tous les utilisateurs
            foreach ($users as $user) {
                Mail::to($user->mail)->send(new ArticlePublished($article));
            }

            return redirect()->route('articles.index')->with('success', 'Article créé avec succès.');

        } catch (QueryException $e) {
            // Vérifier si l'erreur est due à un doublon de slug
            if ($e->errorInfo[1] == 1062) {
                return redirect()->back()->with('error', 'Le slug généré à partir du titre existe déjà, veuillez choisir un autre titre.');
            }

            // Gérer d'autres exceptions ou erreurs de la base de données
            return redirect()->back()->with('error', 'Une erreur est survenue lors de la création de l\'article.');
        }
    }

    /**
     * Display the specified resource.
     */


    public function show($slug)
    {
        $article = Article::where('slug', $slug)->with('category')->firstOrFail();
        $articles = Article::latest()->take(4)->get();
        $categories = Category::all();
        $liens = Category::take(4)->get();
        $communiques = communiquees::latest()->take(4)->get();
        $article->increment('vue'); // Incrémente le compteur de vues

        // Sauter les 4 premières catégories et prendre toutes les suivantes
        $remainingCategories = Category::offset(4)->limit(PHP_INT_MAX)->get();

        $banieres = banieres::all();


        return view('site.detailsArticles', compact('article','remainingCategories', 'communiques', 'articles', 'categories', 'liens', 'banieres'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(article $article)
    {
        $categories = Category::all();
        return view('admin.articles.edit', compact('article', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatearticleRequest $request, article $article)
    {
        $request->validated();

        try {
            // Gestion de l'image principale (champ image du formulaire)
            if ($request->hasFile('image')) {
                // Supprimer l'ancienne image si elle existe
                if ($article->image) {
                    Storage::disk('public')->delete($article->image);
                }

                // Enregistrer la nouvelle image
                $imagePath = $request->file('image')->store('images', 'public');
                $article->image = $imagePath;
            }

            // Récupération du contenu
            $contenu = $request->input('contenu');

            // Chargement du contenu dans DOMDocument
            $dom = new \DOMDocument('1.0', 'utf-8');
            libxml_use_internal_errors(true);
            $dom->loadHTML(mb_convert_encoding($contenu, 'HTML-ENTITIES', 'UTF-8'), LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
            libxml_clear_errors();

            // Dossier où les images seront enregistrées
            $imageDir = public_path('article_images');

            // Vérifier si le dossier existe, sinon le créer
            if (!File::exists($imageDir)) {
                File::makeDirectory($imageDir, 0755, true);
            }

            // Traitement des images encodées en base64
            $images = $dom->getElementsByTagName('img');
            foreach ($images as $img) {
                $src = $img->getAttribute('src');

                // Vérifier si l'image est encodée en base64
                if (strpos($src, 'data:image/') === 0) {
                    // Extraire la partie base64 de l'image
                    $base64Part = explode(',', $src)[1];
                    $data = base64_decode($base64Part);

                    // Générer un nom de fichier unique
                    $image_name = "article_images/" . time() . '_' . uniqid() . '.png';
                    $image_path = public_path($image_name);

                    // Enregistrer l'image dans le dossier public
                    file_put_contents($image_path, $data);

                    // Mettre à jour l'attribut 'src' pour pointer vers le fichier enregistré
                    $img->setAttribute('src', asset($image_name));
                }
            }

            // Sauvegarder le contenu avec les chemins d'images mis à jour
            $contenu = $dom->saveHTML();

            // Mise à jour de l'article
            $article->update([
                'titre' => $request->titre,
                'mots_cles' => $request->mots_cles,
                'contenu' => $contenu, // Utiliser le contenu traité avec les images mises à jour
                'auteur' => $request->auteur,
                'category_id' => $request->category_id,
            ]);

            return redirect()->route('articles.index')->with('success', 'Article mis à jour avec succès.');

        } catch (QueryException $e) {
            // Vérifier si l'erreur est due à un doublon de slug
            if ($e->errorInfo[1] == 1062) {
                return redirect()->back()->with('error', 'Le slug généré à partir du titre existe déjà, veuillez choisir un autre titre.');
            }

            // Gérer d'autres exceptions ou erreurs de la base de données
            return redirect()->back()->with('error', 'Une erreur est survenue lors de la mise à jour de l\'article.');
        }
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(article $article)
    {
        // Supprime l'image associée si elle existe
        if ($article->image) {
            Storage::disk('public')->delete($article->image);
        }

        $article->delete();

        return redirect()->route('articles.index')->with('success', 'Article supprimé avec succès.');
    }


    public function search(HttpRequest $request)
    {
        $request->validate([
            'query' => 'required|string|max:255',
        ]);

        $query = $request->input('query');
        $articles = Article::where('titre', 'LIKE', "%{$query}%")->get();

        return response()->json($articles);
    }


}