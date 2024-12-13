<?php

namespace App\Http\Controllers;

use App\Models\communiquees;
use App\Http\Requests\StorecommuniqueesRequest;
use App\Http\Requests\UpdatecommuniqueesRequest;
use App\Models\banieres;
use App\Models\category;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;
use DOMDocument;

class CommuniqueesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $communiquees = communiquees::paginate(10);
        return view('admin.communiqué.index', compact('communiquees'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.communiqué.creat'); // Correction de la vue à 'create'
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorecommuniqueesRequest $request)
    {
        $validated = $request->validated();

        try {
            $imagePath = null;
            if ($request->hasFile('image')) {
                $imagePath = $request->file('image')->store('images', 'public');
            }

            $contenu = $this->processContentImages($request->input('contenu'));

            $communiques = communiquees::create([
                'titre' => $validated['titre'],
                'mots_cles' => $validated['mots_cles'],
                'contenu' => $contenu,
                'auteur' => $validated['auteur'],
                'image' => $imagePath,
                'slug' => $this->generateUniqueSlug($validated['titre'])
            ]);

            return redirect()->route('communiqué.index')->with('success', 'Communiqué créé avec succès.');
        } catch (QueryException $e) {
            if ($e->errorInfo[1] == 1062) {
                return redirect()->back()->with('error', 'Le slug généré à partir du titre existe déjà, veuillez choisir un autre titre.');
            }
            return redirect()->back()->with('error', 'Une erreur est survenue lors de la création du communiqué.');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($slug)
    {
        $communique = communiquees::where('slug', $slug)->firstOrFail();
        $categories = category::all();
        $liens = Category::take(4)->get();
        $communiques = communiquees::latest()->take(4)->get();

        // Sauter les 4 premières catégories et prendre toutes les suivantes
        $remainingCategories = Category::offset(4)->limit(PHP_INT_MAX)->get();

        $banieres = banieres::all();

        $communique->increment('vue');
        return view('site.detailsCommunique', compact('communique','remainingCategories', 'categories', 'communiques', 'liens', 'banieres'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $communiquees = communiquees::find($id);
        return view('admin.communiqué.edit', compact('communiquees'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatecommuniqueesRequest $request, $id)
    {
        $communiquees = communiquees::find($id);

        $validated = $request->validated();

        try {
            if ($request->hasFile('image')) {
                if ($communiquees->image) {
                    Storage::disk('public')->delete($communiquees->image);
                }
                $communiquees->image = $request->file('image')->store('images', 'public');
            }

            $contenu = $this->processContentImages($request->input('contenu'));

            $communiquees->update([
                'titre' => $validated['titre'],
                'mots_cles' => $validated['mots_cles'],
                'contenu' => $contenu,
                'auteur' => $validated['auteur'],
                'slug' => $this->generateUniqueSlug($validated['titre'], $communiquees->id) // Slug unique
            ]);

            return redirect()->route('communiqué.index')->with('success', 'Communiqué mis à jour avec succès.');
        } catch (QueryException $e) {
            if ($e->errorInfo[1] == 1062) {
                return redirect()->back()->with('error', 'Le slug généré à partir du titre existe déjà, veuillez choisir un autre titre.');
            }
            return redirect()->back()->with('error', 'Une erreur est survenue lors de la mise à jour du communiqué.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $communiquees = communiquees::find($id);

        if ($communiquees->image) {
            Storage::disk('public')->delete($communiquees->image);
        }

        $communiquees->delete();

        return redirect()->route('communiqué.index')->with('success', 'Communiqué supprimé avec succès.');
    }

    /**
     * Process the content to handle base64 images and save them as files.
     */
    private function processContentImages($content)
    {
        $dom = new DOMDocument('1.0', 'utf-8');
        libxml_use_internal_errors(true);
        $dom->loadHTML(mb_convert_encoding($content, 'HTML-ENTITIES', 'UTF-8'), LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
        libxml_clear_errors();

        $imageDir = public_path('article_images');
        if (!File::exists($imageDir)) {
            File::makeDirectory($imageDir, 0755, true);
        }

        $images = $dom->getElementsByTagName('img');
        foreach ($images as $img) {
            $src = $img->getAttribute('src');
            if (strpos($src, 'data:image/') === 0) {
                $base64Part = explode(',', $src)[1];
                $data = base64_decode($base64Part);

                $image_name = "article_images/" . time() . '_' . uniqid() . '.png';
                $image_path = public_path($image_name);

                file_put_contents($image_path, $data);

                $img->setAttribute('src', asset($image_name));
            }
        }

        return $dom->saveHTML();
    }

    /**
     * Generate a unique slug for the given title.
     */
    private function generateUniqueSlug($title, $id = null)
    {
        $slug = Str::slug($title);
        $count = communiquees::where('slug', 'like', "$slug%")
            ->where('id', '<>', $id) // Exclude the current record if updating
            ->count();

        return $count ? "{$slug}-{$count}" : $slug;
    }


}