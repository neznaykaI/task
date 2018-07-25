@extends('layouts.main_template')
@section('content')
<div class="container">
  <div class="row">
    <p class="lead"> Сейчас на автостоянке </p>
    @if(Session::has('msg'))
      <div class="alert alert-success">{{ Session::get('msg') }}</div>
    @endif
    <form class="form-inline" action="{{route('status_on')}}" method="post">
      <input type="hidden" name="_token" value="{{ csrf_token() }}">
      <div class="form-group">
        <select class="form-control" id="client" name="client" required {{count($clients)==0 ? 'disabled' : ''}}>
          <option hidden value=""> ФИО </option>
          @foreach($clients as $client)
            <option value="{{$client->id}}"> {{$client->full_name}} </option>
          @endforeach
        </select>
      </div>
      <div class="form-group col-md-offset-1">
        <select class="form-control" id="auto" name="auto" disabled required>
          <option hidden value=""> Автомобиль </option>
          <option> Fio1 </option>
        </select>
      </div>
      <button id="send" type="submit" class="btn btn-success col-md-offset-1" {{count($clients)==0 ? 'disabled' : ''}} >Въехал</button>
    </form>

    <hr>
    <br>
      <div class="table-responsive">
        <table class="table table-bordered table-hover">
          <tr class="success">
            <th style="width:30%;">ФИО</th>
            <th style="width:30%;">Автомобиль</th>
            <th style="width:15%;">Номер</th>
            <th style="width:10%; text-align:center;">Изменить статус</th>
          </tr>
          <tr>
            @if(count($autos)!=0)
              @foreach($autos as $number => $auto)
              <td>{{$auto->full_name}}</td>
              <td>{{$auto->mark}}: {{$auto->model}} ({{$auto->color}})</td>
              <td>{{$auto->number}}</td>
              <td style="width:10%; text-align:center;"> <a class="btn btn-warning" href="status_off/{{$auto->id}}"> Выехал </a></td>
            </tr>
            @endforeach
          @else
            <td colspan="4" style="text-align:center;" class="warning">В данный момент на автостоянке автомоблей нет</td>
          @endif
        </table>
        {{$autos->links()}}
    </div>
  </div>
</div>
@endsection


<script src="//ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
<script>
$(document).ready(function() {
  $('#client').change( function () {
    var client=$(this).val();
    if(client=="0")
    {
      $('#auto').html('<option>Выберите из списка...</option>');
      $('#auto').attr('disabled', true);
      return(false);
    }
    $('#auto').attr('disabled', true);
    $('#auto').html('<option>Загрузка...</option>');
    var url = "{{route('get_auto')}}";
    $.ajaxSetup ({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });
    $.get(
        url,
        "client=" + client,
        function (result) {
            if (result.type == 'error') {
                $('#auto').html('<option> Список пуст </option>');
                $('#send').attr('disabled', true);
            }
            else {
                var options = '';
                $(result.auto_list).each(function() {
                    options += '<option value="' + $(this).attr('id') + '">' + $(this).attr('auto_list') + '</option>';
                });
                $('#auto').html(options);
                $('#auto').attr('disabled', false);
                $('#send').attr('disabled', false);
            }
        },
        "json"
    );
  })
});
</script>
