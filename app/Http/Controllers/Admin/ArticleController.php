<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

class ArticleController extends Controller
{
    public function index()
    {
        $articles = Article::query()->latest()->get();
        return view('admin.articles.index', compact('articles'));
    }

    public function create()
    {
        return view('admin.articles.form', ['article' => new Article()]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'image' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
        ]);

        $articleData = [
            'title' => $data['title'],
            'slug' => Str::slug($data['title']) . '-' . time(),
            'content' => $data['content'],
        ];

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('articles', 'public');

            if (Schema::hasColumn('articles', 'image')) {
                $articleData['image'] = $path;
            }

            if (Schema::hasColumn('articles', 'thumbnail')) {
                $articleData['thumbnail'] = $path;
            }
        }

        Article::create($articleData);

        return redirect()->route('admin.articles.index')->with('success', 'Artikel berhasil ditambahkan.');
    }

    public function edit(Article $article)
    {
        return view('admin.articles.form', compact('article'));
    }

    public function update(Request $request, Article $article)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'image' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
        ]);

        $articleData = [
            'title' => $data['title'],
            'slug' => $article->slug ?? (Str::slug($data['title']) . '-' . time()),
            'content' => $data['content'],
        ];

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('articles', 'public');

            if (Schema::hasColumn('articles', 'thumbnail')) {
                $articleData['thumbnail'] = $path;
            }

            if (Schema::hasColumn('articles', 'image')) {
                $articleData['image'] = $path;
            }
        }

        $article->update($articleData);

        return redirect()->route('admin.articles.index')->with('success', 'Artikel berhasil diperbarui.');
    }

    public function destroy(Article $article)
    {
        $article->delete();

        return redirect()->route('admin.articles.index')->with('success', 'Artikel berhasil dihapus.');
    }
}
