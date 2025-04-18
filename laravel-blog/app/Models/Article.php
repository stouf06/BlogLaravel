<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    // Champs assignables
    protected $fillable = ['title', 'slug', 'body', 'category_id'];

    // Relation : un article appartient à une catégorie
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    // Ici, seuls les commentaires approuvés seront affichés
    public function comments()
    {
        return $this->hasMany(Comment::class)->where('approved', true);
    }

}
