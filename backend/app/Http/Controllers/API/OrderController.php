<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Hourrate;
use App\Models\Orderdetail;

class OrderController extends Controller{

    public $successStatus = 200;
    
    public function createorder(Request $request){
        $neworder = Order::create($request->except(['services']));
	$input = $request->all(); 
	$this->createorderdetails($input['services'] , $neworder->id);
        return response()->json(['success' => $neworder], $this->successStatus);
    }

    public function createorderdetails($services , $id){
	for($i=0 ;  $i < count($services) ; $i++){
		$neworder = Orderdetail::insert(['order_id'=> $id ,'service_id' =>$services[$i] ]);	
	}	
    }

    public function orders(){
	$orders = Order::with(['area:id,name' ,'customer:id,name','orderdetail:order_id,hours'])->orderBy('id', 'DESC')->get();
	return response()->json(['success' => $orders], $this->successStatus);
    }
	
     public function show(Request $request , $id){
	$orderdetails = Orderdetail::with(['service:id,name' , 'order' => function($query){
		$query->with('area');
	}])->where("order_id" , $id)->get();
	return response()->json(['success' => $orderdetails], $this->successStatus);
    }
	
     public function update(Request $request , $id){
	$input = $request->all();
	$total_price = 0;
	 for($i=0 ;  $i < count($input['services']) ; $i++){
		$area_id = $input['services'][$i]['order']['area_id'];
		$service_id = $input['services'][$i]['service_id'];
		$hours = $input['services'][$i]['hours'];
		Orderdetail::where("order_id" , $id)->where('service_id' ,$service_id)->update(['hours'=> $hours]);
		$price = Hourrate::where(['service_id'=> $service_id , 'area_id' => $area_id])->select('price')->first()['price'];
		$total_price += $price * $hours ;	
	}
	Order::where('id' , $id )->update(['totalprice'=>$total_price]);	 
     }	

}
