@extends('layouts.main_template')
@section('content')
<div class="container">
  <div class="row">
    <p class="lead"> Клиенты автостоянки </p>
    @if(Session::has('msg'))
      <div class="alert alert-success">{{Session::get('msg')}}</div>
    @endif
    @if(Session::has('msg1'))
      <div class="alert alert-danger"> {{Session::get('msg1')}}</div>
    @endif
      <div class="table-responsive">
        <table class="table table-bordered table-hover">
          <tr class="success">
            <th style="width:30%;">ФИО</th>
            <th style="width:30%;">Автомобиль</th>
            <th style="width:15%;">Номер</th>
            <th style="width:10%; text-align:center;">Редактировать</th>
            <th style="width:5%; text-align:center;">Удалить</th>
          </tr>
          <tr>
            @if(count($allRecord)!=0)
              @foreach($allRecord as $number => $record)
              <td>{{$record->full_name}}</td>
              <td>{{$record->mark}}: {{$record->model}} ({{$record->color}})</td>
              <td>{{$record->number}}</td>
              <td style="width:10%; text-align:center;"> <a href="clients/{{$record->id_client}}/edit" title="Редактировать данные клиента"> <button class="fas fa-pencil-alt"></button> </a> </td>
              <td style="width:10%; text-align:center;">
                <form id="delete-link" action="{{ route('delete_record', $record->id) }}" method="POST" >
                  <input type="hidden" name="_method" value="DELETE">
                  <button type="submit" class="fas fa-times" title="Удалить данные об автомобиле">  </button>
                    {{ csrf_field() }}
                </form>
              </td>
            </tr>
            @endforeach
          @else
            <td class="warning" colspan="5" style="text-align:center;"> Список клиентов пуст </td>
          @endif
        </table>
        {{$allRecord->links()}}
    </div>
  </div>
</div>
@endsection
