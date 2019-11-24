<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

    class Orderdetail extends Model{
        protected $table = "order_details";
        protected $fillable = [
            'order_id',
            'service_id',
            'repairman_id',
            'price'
        ];
        public $timestamps = false;

	public function order(){
		return $this->belongsTo(Order::class);
	}

	public function service(){
		return $this->belongsTo(Service::class);
	}
    }
