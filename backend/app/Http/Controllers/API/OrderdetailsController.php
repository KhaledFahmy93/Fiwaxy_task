<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Hourrate;
use App\Models\Orderdetail;

class OrderdetailsController extends Controller{

    public $successStatus = 200;
    
    public function update(Request $request , $id){
 	    $input = $request->all();
 	    $total_price = 0;
 	    for($i=0 ;  $i < count($input['services']) ; $i++){
            $area_id = $input['services'][$i]['order']['area_id'];
            $service_id = $input['services'][$i]['service_id'];
            $hours = $input['services'][$i]['hours'];
            $status = Orderdetail::where("order_id" , $id)->where('service_id' ,$service_id)->update(['hours'=> $hours]);
            $price = Hourrate::where(['service_id'=> $service_id , 'area_id' => $area_id])->select('price')->first()['price'];
            $total_price += $price * $hours ;	
        } 
 	    Order::where('id' , $id )->update(['totalprice'=>$total_price]);
        return response()->json(['success' => $total_price], $this->successStatus);	     
    }


}