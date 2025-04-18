<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    // Affiche la liste de tous les articles (page d'accueil) avec filtre par catégorie
    public function index(Request $request)
    {
        $articles = Article::with('category')
            ->when($request->category, function ($query, $slug) {
                $query->whereHas('category', function ($q) use ($slug) {
                    $q->where('slug', $slug);
                });
            })
            ->latest()
            ->paginate(6);

        return view('articles.index', compact('articles'));
    }

    // Affiche le détail d'un seul article via son slug
    public function show($slug)
    {
        $article = Article::where('slug', $slug)->firstOrFail();
        return view('articles.show', compact('article'));
    }

    // Recherche d’articles via une requête textuelle
    public function search(Request $request)
    {
        $query = $request->input('query');
        
        $articles = Article::where('title', 'like', "%{$query}%")
            ->orWhere('body', 'like', "%{$query}%")
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('articles.index', compact('articles'));
    }

    // Filtrage via URL par slug de catégorie (si besoin pour une page dédiée)
    public function filterByCategory($slug)
    {
        $category = \App\Models\Category::where('slug', $slug)->firstOrFail();
        $articles = $category->articles()->orderBy('created_at', 'desc')->paginate(10);

        return view('category.show', compact('category', 'articles'));
    }
}
