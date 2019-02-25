<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
	/**
	* Guarded columns from mass assignment
	*
	* @var array
	*/
    protected $guarded = [];

    ///// Relationships

    /**
    * Reltionship to Article model
    */
    public function articles()
    {
    	return $this->hasMany( Article::class );
    }

    /**
    * Reltionship to Article model
    */
    public function publishedArticles()
    {
    	return $this->hasMany( Article::class )->where( 'publish_at', '<', Carbon::now() );
    }

    ///// Queries and Helpers

    /**
    * Gather data to display a category
    *
    * @param  string $slug
    * @return model
    */
    public function show($slug)
    {
        return $this->with( 'publishedArticles' )->where( 'slug', $slug )->firstOrFail();
    }

    /**
    * Create and store a new category
    *
    * @param  \Illuminate\Http\Request  $request
    * @return model
    */
    public function store(Request $request)
    {
        return $this->create( $this->setData($request) );
    }

    /**
    * Update and store a category
    *
    * @param  \Illuminate\Http\Request  $request
    * @return model
    */
    public function renew(Request $request)
    {
        return $this->update( $this->setData($request) );
    }

    /**
    * Attempt to remove a category
    *
    * @return bool
    */
    public function remove()
    {
        if ( $this->articles->count() === 0 ) {

            return $this->delete();

        }

        return false;
    }

    /**
    * Gather data for a select input list
    *
    * @return Collection
    */
    public function menuList()
    {
    	return $this->withCount( 'publishedArticles' )
    			->orderBy( 'title', 'asc' )
    			->get( ['id', 'slug', 'title'] );
    }

    /**
    * Gather data for a select input list
    *
    * @return Collection
    */
    public function selectList()
    {
    	return $this->orderBy( 'title', 'asc' )
    			->get( ['id', 'title'] );
    }

    /**
    * Gather data for a select input list
    *
    * @return Collection
    */
    public function adminList()
    {
        return $this->withCount( 'articles' )->latest()->get();
    }

    ///// Helpers

    /**
    * Trigger validation and set data for inserting
    *
    * @param  \Illuminate\Http\Request  $request
    * @return array
    */
    private function setData(Request $request)
    {
        $request = $this->validate( $request );

        return [
            'slug' => str_slug( $request['title'] ),
            'title' => $request['title'],
            'description' => $request['description'],
        ];
    }

    /**
    * Validate incoming input data
    *
    * @param  \Illuminate\Http\Request  $request
    * @return array
    */
    private function validate(Request $request)
    {
        $rules = [
            'title' => 'required|max:60|string|unique:categories,title',
            'description' => 'required|max:550|string',
        ];

        if ( $request->isMethod('patch') ) {

            $rules['title'] .= ','. $this->id;

        }

        return $request->validate( $rules );
    }
}
