<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Session;
use Client;

class Auto extends Model
{
    public $timestamps = false;
    public function client()
    {
      return $this->hasMany('Client');
    }

    public static function autos($id)
    {
      return DB::table('autos')
                ->where('autos.id_client', $id)
                ->select('autos.*')
                ->get();
    }

    public static function check_number($number, $id)
    {
      return DB::table('autos')
                      ->where('autos.number', $number)
                      ->where('autos.id','!=', $id)
                      ->get();
    }

    public static function get_id_client($id)
    {
      return DB::table('autos')
                      ->where('id', $id)
                      ->select('id_client')
                      ->get();
    }

    public static function update_data($id, $data)
    {
      return DB::table('autos')->where('id', $id)->update($data);
    }

    public static function get_auto_data($id)
    {
      return DB::table('autos')->where('id', $id)->select('id_client','flag')->get();
    }

    public static function get_auto_of_client($client)
    {
      return DB::table('autos')
                ->where('autos.id_client', $client)
                ->where('autos.flag', '0')
                ->select('id','mark','model')
                ->get();
    }

    public static function get_auto_parking()
    {
      return DB::table('clients')
                      ->join('autos', 'clients.id','autos.id_client')
                      ->where('autos.flag','1')
                      ->select('clients.*', 'autos.*', 'autos.id as id_auto')
                      ->paginate(7);
    }
    public static function change_status($id, $flag)
    {
      return DB::table('autos')
                ->where('id', $id)
                ->update(['flag' => $flag]);
    }

    public static function delete_auto($id)
    {
      $count_auto = DB::table('autos')->whereIn('id_client',function($query) use ($id){
            $query->select('id_client')
              ->from('autos')->where('id', '=',$id);
              })
              ->count();
      if($count_auto>1)
      {
          DB::table('autos')->where('id', $id)->delete();

          return Session::flash('msg', 'Данные успешно сохранены');
           //redirect()->route('clients.index');
      }

      else
      {
          if($count_auto<=1)
          {
              return Session::flash('msg1', 'Данную запись невозможно удалить');
              //return redirect()->route('clients.index');
          }
      }
    }
}
