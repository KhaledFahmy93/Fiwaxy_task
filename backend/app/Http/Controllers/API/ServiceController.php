<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Hourrate;

class ServiceController extends Controller{

    public $successStatus = 200;

    public function services(){
        $service = Hourrate::with(['service', 'area'])->has('service')->has('area')->get();
        return response()->json(['success' => $service], $this->successStatus); 
    }


}
