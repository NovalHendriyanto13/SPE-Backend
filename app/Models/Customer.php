<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model {
	/**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = BaseTable::TBL_CUSTOMER; 
    /**
	 * The attributes that aren't mass assignable.
	 *
	 * @var array
	 */
	protected $guarded = [];
	const UPDATED_AT = null;
	const CREATED_AT = null;

}