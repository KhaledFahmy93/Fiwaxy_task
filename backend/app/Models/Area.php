<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

    class Area extends Model{
        public $timestamps = false;

        private $fillabe =[
            'name',
            'repairman_id',
        ];
    }
