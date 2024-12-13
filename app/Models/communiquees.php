<?php

namespace App\Models;

use Cocur\Slugify\Slugify;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;


class communiquees extends Model
{
    use HasFactory;

    protected $fillable = ['titre', 'mots_cles', 'contenu', 'auteur', 'image', 'slug'];

    public static function boot()
    {
        parent::boot();

        static::creating(function ($communiques) {
            $slugify = new Slugify();
            $communiques->slug = $slugify->slugify(Str::slug($communiques->titre, '-'));// Générer le slug à partir du titre
        });

        static::updating(function ($communiques) {
            $slugify = new Slugify();
            $communiques->slug = $slugify->slugify(Str::slug($communiques->titre, '-'));
        });
    }

}