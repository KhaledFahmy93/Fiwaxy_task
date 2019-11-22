<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

    class Order extends Model{
        private $fillabe =[
            'description',
            'customer_id',
            'area_id',
            'totalprice'
        ];
        public $timestamps = false;
    }
