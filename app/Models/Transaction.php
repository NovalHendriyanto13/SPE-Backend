<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model {
	/**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = BaseTable::TBL_TRANS; 

    /**
	 * The attributes that aren't mass assignable.
	 *
	 * @var array
	 */
	protected $guarded = [];

	public function customer() {
        return $this->hasOne('App\Models\Customer','id','customer_id');
    } 
}