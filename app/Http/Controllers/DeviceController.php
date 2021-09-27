<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Device;

class DeviceController extends Controller
{
   public function list()
   {
   	return Device::all();//to fetch all of the data
   }

   public function byid($id=null)
   {
   	return $id?Device::find($id):Device::all();
   	//to fetch all or as per need by individual id
   }
   


}
