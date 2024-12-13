<?php

namespace App\Models;

use Cocur\Slugify\Slugify;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;


class article extends Model
{
    use HasFactory;

    protected $fillable = ['titre', 'mots_cles', 'contenu', 'auteur', 'image', 'slug', 'category_id'];

    public static function boot()
    {
        parent::boot();

        static::creating(function ($article) {
            $slugify = new Slugify();
            $article->slug = $slugify->slugify(Str::slug($article->titre, '-'));// Générer le slug à partir du titre
        });

        static::updating(function ($article) {
            $slugify = new Slugify();
            $article->slug = $slugify->slugify(Str::slug($article->titre, '-'));
        });
    }


    public function category()
    {
        return $this->belongsTo(category::class);
    }



}