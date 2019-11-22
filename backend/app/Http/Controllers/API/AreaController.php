<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Area;

class AreaController extends Controller{

    public $successStatus = 200;
    
    public function areas(){
        $user = Area::all();
        return response()->json(['success' => $user], $this->successStatus); 
    }

}