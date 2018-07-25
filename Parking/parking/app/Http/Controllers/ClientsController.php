<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use App\Client;
use App\Auto;
use Session;

class ClientsController extends Controller
{
    public function index()
    {
        $allRecord=Client::all_record()->paginate(7);
        return view('show_clients')->withAllRecord($allRecord);
    }

    public function create()
    {
        return view('add_client');
    }

    public function store(Request $request)
    {
        if(isset($request->id))
        {

          $validator=Validator::make($request->all(), [
            'number_new'=>'unique:autos,number',
          ]);

          if($validator->fails())
          {

            return redirect()->route('edit_record', ['id'=> $request->id])
                              ->withErrors($validator)
                              ->withInput();
          }
          $data=Input::only('mark_new','model_new','color_new', 'number_new');
          $dataAuto=[];
          $dataAuto['mark']=strip_tags($data['mark_new']);
          $dataAuto['model']=strip_tags($data['model_new']);
          $dataAuto['color']=strip_tags($data['color_new']);
          $dataAuto['number']=strip_tags($data['number_new']);
          $dataAuto['id_client']=$request->id;
          $dataAuto['flag']=0;

          $auto=DB::table('autos')->insert($dataAuto);

          Session::flash('msg', 'Данные успешно сохранены');
          return redirect()->route('clients.index');
        }

        $validator=Validator::make($request->all(), [
          'phone'=>'unique:clients',
          'number'=>'unique:autos',
        ]);
        if($validator->fails())
        {
            return redirect()->route('create_record')
                              ->withErrors($validator)
                              ->withInput();
        }
        $mas=[];
        $dataClient=Input::only('full_name','gender','phone', 'address');
        foreach($dataClient as $key=>$value)
        {
          $dataClient[$key]=strip_tags($value);
        }

        $client=DB::table('clients')->insertGetId($dataClient);

        $dataAuto=Input::only('mark','model','color', 'number');
        foreach($dataAuto as $key=>$value)
        {
          $dataAuto[$key]=strip_tags($value);
        }
        $dataAuto['id_client']=$client;
        $dataAuto['flag']=0;
        $auto=DB::table('autos')->insert($dataAuto);

        Session::flash('msg', 'Данные успешно сохранены');
        return redirect()->route('clients.index');
    }

    public function show($id)
    {

    }

    public function edit($id)
    {
        $client=Client::client($id);
        if(!count($client))
          return abort(404);
        else
        {
          $autos=Auto::autos($id);
          return view('edit_client')->withClient($client)->withAutos($autos)->withId($id);
        }
    }

    public function update(Request $request, $id)
    {
          $id=strip_tags($id);
          if ($request->has('full_name'))
          {
            $check_phone=Client::check_phone($request->phone, $id);

            if(count($check_phone)!=0)
            {
              $validator=Validator::make($request->all(), [
                'phone'=>'unique:clients',
              ]);
            }
            if($validator->fails())
            {
              return redirect()->route('edit_record', ['id'=> $id])
                                ->withErrors($validator)
                                ->withInput();
            }
            else
            {
              $mas=[];
              $dataClient=Input::only('full_name','gender','phone', 'address');
              foreach($dataClient as $key=>$value)
              {
                $dataClient[$key]=strip_tags($value);
              }
              Client::update_data($id, $dataClient);

              Session::flash('msg', 'Данные успешно сохранены');
              return redirect()->route('edit_record', ['id'=> $id]);
            }
        }
        if ($request->has('mark'))
        {
          $check_number=Auto::check_number($request->number, $id);

          if(count($check_number)!=0)
          {
            $validator=Validator::make($request->all(), [
                    'number'=>'unique:autos',
                    ]);
            if($validator->fails())
            {
              $id_client=Auto::get_id_client($id);

              foreach($id_client as $val)
              {
                $id_client=$val->id_client;
              }
                  return redirect()->route('edit_record', ['id'=> $id_client])
                                      ->withErrors($validator)
                                      ->with('id_auto', $id)
                                      ->withInput();
            }
          }
              else
              {
                  $dataAuto=Input::only('mark','model','color', 'number');
                  foreach($dataAuto as $key=>$value)
                  {
                      $dataAuto[$key]=strip_tags($value);
                  }

                  $autoData=Auto::get_auto_data($id);

                  foreach($autoData as $value)
                  {
                    $dataAuto['id_client']=$value->id_client;
                    $dataAuto['flag']=$value->flag;
                  }

                  Auto::update_data($id, $dataAuto);

                  Session::flash('msg', 'Данные успешно сохранены');
                  return redirect()->route('edit_record',$dataAuto['id_client']);
              }
        }
    }

    public function destroy($id, Request $request)
    {
        $id=strip_tags($id);
        Auto::delete_auto($id);
        return redirect()->route('clients.index');
    }

    public function on_parking_now()
    {
      $autos=Auto::get_auto_parking();
      $clients=Client::all_client();

      return view('show_auto')->withAutos($autos)->withClients($clients);
    }

    public function get_auto(Request $request)
    {
        $client = intval($request->client);
        $autos=Auto::get_auto_of_client($client);

        if (null!=count($autos))
        {
          foreach ($autos as $key => $auto)
          {

            $auto_list[]=array('id' => $auto->id, 'auto_list' => $auto->mark.' ('.$auto->model.') ');
          }
          $result = array('type'=>'success', 'auto_list'=> $auto_list);
        }
          else {
              $result = array('type'=>'error');
          }
        print json_encode($result);
    }

    public function status_off($id)
    {
        $id=strip_tags($id);
        Auto::change_status($id, $flag='0');

        Session::flash('msg', 'Данные успешно сохранены');
        return redirect()->route('show_auto');
    }

    public function status_on(Request $request)
    {
        $auto=strip_tags($request->auto);
        Auto::change_status($auto, $flag = '1');
        Session::flash('msg', 'Данные успешно сохранены');
        return redirect()->route('show_auto');
    }

}
