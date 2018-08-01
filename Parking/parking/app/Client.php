<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Auto;

class Client extends Model
{
    public $timestamps = false;
    public function auto()
    {
      return $this->hasMany('Auto');
    }
    protected $fillable=['full_name','gender','phone','address'];
    protected $guarded=['id'];

    public static function all_client()
    {
      return DB::table('clients')
                    ->select('id','full_name')
                    ->get();
    }

    public static function all_record()
    {
      return DB::table('clients')
                      ->join('autos', 'clients.id','autos.id_client')
                      ->select('clients.*', 'autos.*', 'autos.id as id_auto');
    }

    public static function client($id)
    {
      $id=strip_tags($id);
      return DB::table('clients')
                        ->where('clients.id', $id)
                        ->select('clients.*')
                        ->get();
    }


    public static function check_phone($phone, $id)
    {
      return DB::table('clients')
                      ->where('clients.phone', $phone)
                      ->where('clients.id','!=',$id)
                      ->get();
    }

    public static function update_data($id, $data)
    {
      return DB::table('clients')->where('id', $id)->update($data);
    }
}
