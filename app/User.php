<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that not are mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    /**
    * set attributes
    *
    * @return string
    */
    public function getTypeAttribute()
    {
        if ( $this->is_admin ) {
            return 'Admin';
        } elseif ( $this->author ) {
            return 'Author';
        } elseif ( $this->email_verified_at ) {
            return 'Verified';
        }
        return 'Non-verified';
    }

    /**
    * set attributes
    *
    * @return string
    */
    public function getVerifiedAttribute()
    {
        if ( $this->email_verified_at ) {

            return $this->formatDate( $this->email_verified_at );

        }

        return 'No';
    }

    /**
    * set attributes
    *
    * @return string
    */
    public function getCreatedAttribute()
    {
       return $this->formatDate( $this->created_at );
    }

    ///// Queries

    public function adminRenew(Request $request)
    {
    	return $this->update( $this->setAdminData($request) );
    }

    public function adminList()
    {
    	return $this->latest()->paginate( 20 );
    }

    ///// Helpers

    /**
    * Set admin data for updating a user's access
    *
    * @param  \Illuminate\Http\Request  $request
    * @return array
    */
    private function setAdminData(Request $request)
    {
    	$this->validateAdmin( $request );

    	return [
    		'is_admin' => $request->is_admin?? false,
    		'is_author' => $request->is_author?? false,
    		'email_verified_at' => $request->is_verified? Carbon::now():null,
    	];
    }

    /**
    * Validate an admins update request
    *
    * @param  \Illuminate\Http\Request  $request
    * @return array
    */
    private function validateAdmin(Request $request)
    {
    	$rules = [
    		'is_admin' => 'boolean',
    		'is_author' => 'boolean',
    		'is_verified' => 'boolean',
    	];

    	return $request->validate( $rules );
    }

    private function formatDate($date)
    {
        return $date->format( 'm-d-Y' );
    }
}
