<?php

namespace App\Http\Controllers;

use App\Models\category;
use App\Http\Requests\StorecategoryRequest;
use App\Http\Requests\UpdatecategoryRequest;
use App\Models\article;
use App\Models\banieres;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::paginate(15);
        return view('admin.categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.categories.form');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorecategoryRequest $request)
    {
        $request->validated();

        Category::create($request->all());

        return redirect()->route('categories.index')->with('success', 'Catégorie créée avec succès.');
    }

    /**
     * Display the specified resource.
     */
    // public function show($nom)
    // {
    //     $category = Category::findOrFail($nom);
    //     $article = article::where('category_nom', $category->nom)->get();
    //     $articles = Article::latest()->take(4)->get();
    //     $liens = Category::take(4)->get();
    //     $categories = category::all();

    //     // Sauter les 4 premières catégories et prendre toutes les suivantes
    //     $remainingCategories = Category::offset(4)->limit(PHP_INT_MAX)->get();



    //     return view('site.categoryshow', compact('category','remainingCategories', 'article', 'categories', 'articles', 'liens'));
    // }

    public function show($nom)
{
    // Trouver la catégorie par son nom
    $category = Category::where('nom', $nom)->firstOrFail();

    // Trouver les articles associés à cette catégorie
    $article = Article::where('category_id', $category->id)->get();

    // Prendre les 4 derniers articles
    $articles = Article::latest()->take(4)->get();

    // Prendre les 4 premières catégories
    $liens = Category::take(4)->get();

    // Prendre toutes les catégories
    $categories = Category::all();

    $banieres = banieres::all();

    // Sauter les 4 premières catégories et prendre toutes les suivantes
    $remainingCategories = Category::offset(4)->limit(PHP_INT_MAX)->get();

    return view('site.categoryshow', compact('category', 'remainingCategories', 'articles', 'categories', 'article', 'liens', 'banieres'));
}


    /**
     * Show the form for editing the specified resource.
     */
    // Afficher le formulaire de modification de catégorie
    public function edit(Category $category)
    {
        return view('admin.categories.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatecategoryRequest $request, category $category)
    {
        $request->validated();

        $category->update($request->all());

        return redirect()->route('categories.index')->with('success', 'Catégorie mise à jour avec succès.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(category $category)
    {
        $category->delete();

        return redirect()->route('categories.index')->with('success', 'Catégorie supprimée avec succès.');
    }
}