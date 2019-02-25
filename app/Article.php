<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
  	/**
  	* Always eager load relationships
  	*
  	* @var array
  	*/
  	protected $with = ['author'];

  	/**
  	* Always eager load relationships
  	*
  	* @var array
  	*/
  	protected $dates = ['publish_at'];

      /**
  	* Guarded columns from mass assignment
  	*
  	* @var array
  	*/
    protected $guarded = [];

    /**
    * Format publish date for display
    */
    public function getDisplayPublishAttribute()
    {
        if ( $this->publish_at ) {

            return $this->publish_at->format( 'm-d-Y g:i a' );

        }

        return 'Not set.';
    }

    ///// Relationships

    /**
    * Reltionship to User model
    */
    public function author()
    {
    	  return $this->belongsTo( User::class, 'user_id', 'id' )->select( 'id', 'name' );
    }

    /**
    * Reltionship to Category model
    */
    public function category()
    {
    	  return $this->belongsTo( Category::class );
    }

    ///// Queries

     ///// Queries and Helpers

    /**
    * Gather data to display a category
    *
    * @param  string $slug
    * @return model
    */
    public function show($slug)
    {
        return $this->with( 'category' )->where( 'slug', $slug )->firstOrFail();
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
        return $this->delete();
    }

    /**
    * Gather data to show a public list
    *
    * @param  int $amount
    * @return Collection
    */
    public function adminList($amount = 10)
    {
        return $this->with( 'category' )->orderBy( 'publish_at', 'desc' )->paginate( $amount );
    }

   	/**
   	* Gather data to show a public list
   	*
   	* @param  int $amount
   	* @return Collection
   	*/
   	public function publicList($amount = 5)
   	{
   		  return $this->with( 'category' )->where( 'publish_at', '<', Carbon::now() )->paginate( $amount );
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
        $data = $this->validate( $request );

        $slug = str_slug( $data['title'] );
        $user_id = $request->isMethod('post')? auth()->id():$this->user_id;
        $publish = $data['publish_at']? Carbon::parse($data['publish_at']):null;

        return [
            'slug' => $slug,
            'title' => $request['title'],
            'user_id' => $user_id,
            'content' => $request['content'],
            'publish_at' => $publish,
            'category_id' => $request['category_id'],
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
            'title' => 'required|max:60|string|unique:articles,title',
            'content' => 'required|string',
            'publish_at' => 'nullable|date',
            'category_id' => 'required|numeric|exists:categories,id',
            'description' => 'required|max:550|string',
        ];

        if ( $request->isMethod('patch') ) {

            $rules['title'] .= ','. $this->id;

        }

        return $request->validate( $rules );
    }
    
}
