<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    // Affiche tous les articles d'une catégorie donnée (via slug)
    public function show($slug)
    {
        $category = \App\Models\Category::where('slug', $slug)->firstOrFail();
        $articles = $category->articles()->orderBy('created_at', 'desc')->paginate(5);

        return view('category.show', compact('category', 'articles'));
    }

}
