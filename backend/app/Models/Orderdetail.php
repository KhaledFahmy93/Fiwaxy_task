<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

    class Orderdetail extends Model{
        protected $table = "order_details";
        protected $fillable = [
            'order_id',
            'service_id',
            'hours'
        ];
        public $timestamps = false;

	public function order(){
		return $this->belongsTo(Order::class);
	}

	public function service(){
		return $this->belongsTo(Service::class , 'service_id' , 'id');
	}
    }
