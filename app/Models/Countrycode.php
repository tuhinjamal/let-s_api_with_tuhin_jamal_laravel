<?php
/*warnigng!!! you must that you have to modify boot function by place  Schema::defaultStringLength(199); of AppServiceProvider.php */
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Countrycode extends Model
{
    use HasFactory;
    public $timestamps=false;// must have to false otherwise show error for blank of this pre existed field
    //for post method below spaces are optional
    
    protected $table = "countries";
    protected $fillable = [
    	
    	'name',
    	'iso',
    	'phonecode',
    	
    ];
}
