<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Controllers\Controller;

class RepairmanController extends Controller{

    public $successStatus = 200;

    public function repairmen(){
        $repairmen = User::where('user_type' , 'repairman')->get();
        return response()->json(['success' => $repairmen], $this->successStatus); 
    }


}