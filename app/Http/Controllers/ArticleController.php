<?php

namespace App\Http\Controllers;

use App\Article;
use App\Category;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Article $article)
    {
        $articles = $article->publicList();

        return view( 'article.index', compact('articles') );
    }

    /**
     * Display a listing of the resource.
     *
     * @param  \App\Article $article
     * @return \Illuminate\Http\Response
     */
    public function admin(Article $article)
    {
        $articles = $article->adminList();

        return view( 'article.admin', compact('articles') );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param  \App\Category $category
     * @return \Illuminate\Http\Response
     */
    public function create(Category $category)
    {
        $categories = $category->selectList();

        return view( 'article.create', compact('categories') );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Article $article
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Article $article)
    {
        $article->store( $request );

        session()->flash( 'success', 'New Article saved.' );

        return redirect()->route( 'article.admin' );
    }

     /**
     * Display the specified resource.
     *
     * @param  \App\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function details(Article $article)
    {
        $article = $article->load( 'category' );

        return view( 'article.details', compact('article') );
    }

    /**
     * Display the specified resource.
     *
     * @param  string $slug
     * @param  \App\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function show($slug, Article $article)
    {
        $article = $article->with( 'category' )->where( 'slug', $slug )->firstOrFail();

        return view( 'article.show', compact('article') );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Article  $article
     * @param  \App\Category $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Article $article, Category $category)
    {
        $categories = $category->selectList();

        return view( 'article.edit', compact('article', 'categories') );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Article $article)
    {
        $article->renew( $request );

        session()->flash( 'success', 'Article update saved.' );

        return redirect()->route( 'article.admin' );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function destroy(Article $article)
    {
        $article->delete();

        session()->flash( 'success', 'Article has been removed.' );

        return redirect()->route( 'article.admin' );
    }
}
