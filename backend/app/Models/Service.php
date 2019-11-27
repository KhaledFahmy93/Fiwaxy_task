<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

    class Service extends Model{
        public $timestamps = false;
        private $fillabe =[
            'name',
            'repairman_id',
        ];
	
	 public function orderdetail(){
        	return $this->hasMany(Orderdetail::class);
    	}
	public function hourrate(){
        	return $this->hasMany(Hourrate::class);
    	}
 
    }
