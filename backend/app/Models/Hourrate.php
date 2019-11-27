<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

    class Hourrate extends Model{
        public $timestamps = false;
        private $fillabe =[
            'service_id',
	    'area_id',
            'price',
        ];
	public function service(){
		return $this->belongsTo(Service::class);
	}
	public function area(){
		return $this->belongsTo(Area::class);
	}
    }
