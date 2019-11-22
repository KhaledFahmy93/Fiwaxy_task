<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Order;

class OrderController extends Controller{

    public $successStatus = 200;
    
    public function createorder(Request $request){
        $user = Order::insert($request->except('numservices'));
        return response()->json(['success' => $user], $this->successStatus);
    }

    public function createorderdetails(Request $request){
        
    }


}