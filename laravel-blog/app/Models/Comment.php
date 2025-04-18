<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = ['article_id', 'author', 'body', 'approved'];

    // Relation : un commentaire appartient à un article
    public function article()
    {
        return $this->belongsTo(Article::class);
    }

    // Relation : un commentaire appartient à un utilisateur
    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
