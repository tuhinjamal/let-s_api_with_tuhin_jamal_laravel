<?php
/*warnigng!!! you must that you have to modify boot function by place  Schema::defaultStringLength(199); of AppServiceProvider.php */
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Countrycode;
use Validator; // this one for validation

class Cncode extends Controller
{
   public function countrycode($id=null)
    {
    return $id?Countrycode::find($id):Countrycode::all();
    //to fetch all or as per need by individual id
    }
	/*Request will come through route from postman and i have to catch this by variable*/
    
    public function add(Request $req)
  {
    $rules=array(
      "name"=>"required|min:3|max:50",
      "iso"=>"required",
      "phonecode"=>"required"
    );
    $validator=Validator::make($req->all(),$rules);
    if ($validator->fails())
    {
      //return $validator->errors();  //this will not show error code like 401 so not efficient
      //instead of that use this one
      return response()->json($validator->errors(),401);
    }else{
      // created a new object of model here then we use it to catch each request value 
    $Countrycode = new Countrycode;
    $Countrycode->name=$req->name;
    $Countrycode->iso=$req->iso;
    $Countrycode->phonecode=$req->phonecode;
    $result=$Countrycode->save();//send request to database to save
    //stored save request activity in $result variable and checked confirmation by conditional operator
    if ($result) 
    {
      return ["Result"=>"Data inserted successfully!"]; 
    }else
    {
    return ["Result"=>"Opps something went wrong!"];  
    }  
    }
    
  }

    public function update(Request $req)
  {
   	$Countrycode = Countrycode::find($req->id);
   	$Countrycode->name=$req->name;
   	$Countrycode->iso=$req->iso;
   	$Countrycode->phonecode=$req->phonecode;
   	$result=$Countrycode->save();//send request to database to save
   	if ($result) {
   	return ["Result"=>"Data updated successfully!"];	
   	}else{
   	return ["Result"=>"Opps something went wrong!"];	
   	}	
  }

   	public function search($name)
  {
   		//like and % are used here to search by charecter 
   		return Countrycode::where("name","like","%".$name."%")->get();
 	}

   	public function delete($id)
   	{
   		$Countrycode = Countrycode::find($id);
   		$result=$Countrycode->delete();
   		if ($result) {
   		return ["Result"=>"Data deleted successfully!".$id];	
   		}else{
   		return ["Result"=>"Opps something went wrong!"];	
   	}		
 	}



}




   
   	


