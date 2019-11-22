<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

    class Orderdetail extends Model{
        protected $tabletablename = "order_details";
        private $fillabe =[
            'order_id',
            'service_id',
            'repairman_id',
            'price'
        ];
        public $timestamps = false;
    }
