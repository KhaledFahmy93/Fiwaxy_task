<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Models\Customer;
use App\Http\Controllers\Controller;

class RepairmanController extends Controller{

    public $successStatus = 200;

    public function repairmen(){
        $repairmen = Customer::where('user_type' , 'repairman')->get();
        return response()->json(['success' => $repairmen], $this->successStatus); 
    }


}