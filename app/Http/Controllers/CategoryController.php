<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function index(Category $category)
    {
        $categories = $category->publicList();

        return view( 'category.index', compact('categories') );
    }

    /**
     * Display a listing of the resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function admin(Category $category)
    {
        $categories = $category->adminList();

        return view( 'category.admin', compact('categories') );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view( 'category.create' );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Category             $category
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Category $category)
    {
        $category->store( $request );

        session()->flash( 'success', 'Category has been created and saved!' );

        return redirect()->route( 'category.admin' );
    }

     /**
     * Display the specified resource.
     *
     * @param  string $slug
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function details(Category $category)
    {
        $category = $category->load( 'articles' );

        return view( 'category.details', compact('category') );
    }

    /**
     * Display the specified resource.
     *
     * @param  string $slug
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show($slug, Category $category)
    {
        $category = $category->show( $slug );

        return view( 'category.show', compact('category') );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {       
        return view( 'category.edit', compact('category') );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {   
        $category->renew( $request );

        session()->flash( 'success', 'Category update has been saved.' );

        return redirect()->route( 'category.admin' );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        if ( $category->remove() ) {

            session()->flash( 'success', 'Category update has been saved.' );

            return redirect()->route( 'category.admin' );

        } 

        session()->flash( 'error', 'Category can not be removed.' );

        return back();
    }
}
