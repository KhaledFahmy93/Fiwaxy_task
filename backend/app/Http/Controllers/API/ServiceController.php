<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Service;

class ServiceController extends Controller{

    public $successStatus = 200;

    public function services(){
        $service = Service::all();
        return response()->json(['success' => $service], $this->successStatus); 
    }


}