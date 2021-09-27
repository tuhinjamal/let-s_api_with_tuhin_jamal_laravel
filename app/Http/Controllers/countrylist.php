<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Countrycode;
use Validator; // this one for validation
class countrylist extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id=null)
    {
    return $id?Countrycode::find($id):Countrycode::all();
    //to fetch all or as per need by individual id
    }
    /*Request will come through route from postman and i have to catch this by variable*/

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $req)
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


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
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

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
