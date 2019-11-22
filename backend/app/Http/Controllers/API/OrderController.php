<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Orderdetail;

class OrderController extends Controller{

    public $successStatus = 200;
    
    public function createorder(Request $request){
        $neworder = Order::create($request->except('numservices'));
	$input = $request->all(); 
	$this->createorderdetails($input['numservices'] , $neworder->id);
        return response()->json(['success' => $neworder], $this->successStatus);
    }

    public function createorderdetails($numberOfServices , $id){
    	    for($i=0 ;  $i < $numberOfServices ; $i++){
		$neworder = Orderdetail::insert(['order_id'=> $id ]);
	    }	
    }

    public function orders(){
	$orders = Order::with(['area' ,'customer'])->get();
	return response()->json(['success' => $orders], $this->successStatus);
    }
	
     public function show(Request $request , $id){
	$orderdetails = Orderdetail::with(['order'])->where("order_id" , $id)->get();
	return response()->json(['success' => $orderdetails], $this->successStatus);
    }	

}
