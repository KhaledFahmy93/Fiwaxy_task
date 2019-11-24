<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Orderdetail;

class OrderController extends Controller{

    public $successStatus = 200;
    
    public function createorder(Request $request){
        $neworder = Order::create($request->except(['services' , 'repairmen']));
	$input = $request->all(); 
	$this->createorderdetails($input['services'] , $input['repairmen'] ,  $neworder->id);
        return response()->json(['success' => $neworder], $this->successStatus);
    }

    public function createorderdetails($services , $repairmen,$id){
    	    for($i=0 ;  $i < count($services) ; $i++){
		for($j=0 ;  $j < count($repairmen) ; $j++){
			$neworder = Orderdetail::insert(['order_id'=> $id ,'service_id' =>$services[$i],'repairman_id'=> $repairmen[$j]]);
		}	
	    }	
    }

    public function orders(){
	$orders = Order::with(['area:id,name' ,'customer:id,name'])->get();
	return response()->json(['success' => $orders], $this->successStatus);
    }
	
     public function show(Request $request , $id){
	$orderdetails = Orderdetail::with('service:id,name')->where("order_id" , $id)
		->groupBy(['service_id','price'])->select(['service_id','price'])->get();
	return response()->json(['success' => $orderdetails], $this->successStatus);
    }	

}
