<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('articles', function (Blueprint $table) {
            $table->id();
            $table->string('titre');
            $table->string('slug')->unique(); // Slug doit être unique
            $table->string('mots_cles');
            $table->longText('contenu');
            $table->string('auteur');
            $table->string('vue')->default(0);
            $table->string('image')->nullable(); // Permettre aux articles de ne pas avoir d'image
            $table->timestamps();

            // Clé étrangère vers la table categories
            $table->foreignId('category_id')->nullable()->constrained()->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('articles'); // Supprime la table et les contraintes automatiquement
    }
};