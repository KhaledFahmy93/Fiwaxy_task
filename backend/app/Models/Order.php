<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

    class Order extends Model{
        protected $fillable = [
            'description',
            'customer_id',
            'area_id',
            'totalprice'
        ];

        public $timestamps = false;
	
	public function customer(){
		return $this->belongsTo(Customer::class);
	}

	 public function area(){
		return $this->belongsTo(Area::class);
	 }

	 public function orderdetail(){
        	return $this->hasMany(Orderdetail::class, 'order_id', 'id');
    	}

    }
