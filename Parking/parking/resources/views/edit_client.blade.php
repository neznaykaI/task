@extends('layouts.main_template')
@section('content')
<div class="container">
  <div class="row">
    <h1>Данные о клиенте</h1>
    @if (Session::has('msg'))
        <div class="alert alert-info">{{ Session::get('msg') }}</div>
    @endif


    <br>
    <div class="col-md-8">
        <div class="panel panel-default">
          <div class="panel-body">
            <p class="lead"> Информация о клиенте </p>
              @foreach($client as $info)
              <form action="{{route('clients.update', $info->id)}}" method="POST">
                <input type="hidden" name="_method" value="PUT">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">

                <div class="form-group col-md-10 {{$errors->has('full_name') ? 'has-error' : ''}}">
                  <label for="full_name" >ФИО</label>
                  <input class="form-control" name="full_name" id="full_name" type="text" minlength="3" value="{{$info->full_name}}" @if($errors->has('full_name')) autofocus @endif >
                  @if($errors->has('full_name'))
                    <span class="help-block">
                      <strong> {{$errors->first('full_name')}} </strong>
                    </span>
                  @endif
                </div>
                <div class="form-group col-md-10">
                  <p> Пол* : </p>
                  <label for="genderM">  <input type="radio" id="genderM" name="gender" value="m" {{$info->gender=="m" ? 'checked' : ''}}> Мужской </label><br/>
                  <label for="genderF">  <input type="radio" id="genderF" name="gender" value="f" {{$info->gender=="f" ? 'checked' : ''}}> Женский </label>
                </div>
                <div class="form-group col-md-10 {{$errors->has('phone') ? 'has-error' : ''}}">
                  <label for="phone">Номер телефона * </label>
                  <span class="help-block">Введите номер сотового телефона в формате 8**********</span>
                  <input class="form-control" type="tel" id="phone" name="phone" pattern="^(8)+\d{10}$" required maxlength="11" style="width:30%;" value="{{$info->phone}}" @if($errors->has('phone')) autofocus @endif>
                  @if ($errors->has('phone'))
                      <span class="help-block">
                          <strong>{{ $errors->first('phone') }}</strong>
                      </span>
                  @endif
                </div>
                <div class="form-group col-md-10">
                  <label for="address"> Адрес </label>
                  <input class="form-control" type="text" id="address" name="address" value="{{$info->address}}">
                </div>
                <div class="form-group col-md-10 col-md-offset-5">
                  <button type="submit" class="btn btn-success">Сохранить</button>
                </div>
              </form>
              @endforeach

          </div>
        </div>
      </div>

      <div class="col-md-8">
        <div class="panel panel-default">
          <div class="panel-body">
            <p class="lead"> Автомобили клиента </p>
                @foreach($autos as $count => $auto)
                <form action="{{route('clients.update', $auto->id)}}" method="POST">
                  <input type="hidden" name="_method" value="PUT">
                  <input type="hidden" name="_token" value="{{ csrf_token() }}">
                  <div class="panel panel-default">
                    <div class="panel-body">
                            <div class="form-group col-md-6 {{$errors->has('mark') ? 'has-error' : ''}}">
                              <label for="mark" >Марка *</label>
                              <input class="form-control" name="mark" id="mark" type="text" style="width:60%;" required value="{{$auto->mark}}" @if($errors->has('mark')) autofocus @endif>
                              @if($errors->has('mark'))
                                <span class="help-block">
                                  <strong>{{$errors->first('mark')}}</strong>
                                </span>
                              @endif
                            </div>

                            <div class="form-group col-md-6 {{$errors->has('model') ? 'has-error' : ''}}">
                              <label for="model" >Модель *</label>
                              <input class="form-control" name="model" id="model" type="text" style="width:60%;" value="{{$auto->model}}" required @if($errors->has('model')) autofocus @endif>
                              @if($errors->has('model'))
                                <span class="help-block">
                                  <strong>{{$errors->first('model')}}</strong>
                                </span>
                              @endif
                            </div>

                            <div class="form-group col-md-6 {{$errors->has('color') ? 'has-error' : ''}}">
                              <label for="color" >Цвет кузова *</label>
                              <input class="form-control" name="color" id="color" type="text" style="width:60%;"  value="{{$auto->color}}" required @if($errors->has('color')) autofocus @endif>
                              @if($errors->has('color'))
                                <span class="help-block">
                                  <strong> {{$errors->first('color')}} </strong>
                                </span>
                              @endif
                            </div>

                            <div class="form-group col-md-6 {{($errors->has('number') && (session('id_auto')==$auto->id)) ? 'has-error' : ''}}">
                              <label for="number">Гос номер РФ * </label>
                              <span class="help-block"></span>
                              <input class="form-control" type="tel" id="number" name="number"  pattern="([(АВЕКМНОРСТУХ){1,3}0-9{5,6}]){6,8}"  style="width:50%;" value="{{$auto->number}}" @if(($errors->has('number')) && (session('id_auto')==$auto->id)) autofocus value="{{old('number')}}" @endif required>
                              <span class="help-block"> Введите корректный номерной знак автомобиля вместе с кодом региона, без запятых (например, <span class="text-danger"><b>С227НА69</b></span>) </span>
                              @if(($errors->has('number')) && (session('id_auto')==$auto->id))
                                <span class="help-block">
                                  <strong>{{$errors->first('number')}}</strong>
                                </span>
                              @endif
                            </div>

                            <div class="form-group col-md-10 col-md-offset-5">
                              <button type="submit" class="btn btn-success">Сохранить</button>
                            </div>
                            </form>
                      </div>
                    </div>

                  @endforeach

              <div class="panel panel-default">
                <div class="panel-body">
                  <form action="{{route('client_store', ['id'=>$id])}}" method="POST">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                  <div class="form-group col-md-6 {{$errors->has('mark_new') ? 'has-error' : ''}}">
                    <label for="mark_new" >Марка *</label>
                    <input class="form-control" name="mark_new" id="mark_new" type="text" style="width:60%;" required value="{{old('mark_new')}}">
                    @if($errors->has('mark_new'))
                      <span class="help-block">
                        <strong>{{$errors->first('mark_new')}}</strong>
                      </span>
                    @endif
                  </div>
                  <div class="form-group col-md-6 {{$errors->has('model_new') ? 'has-error' : ''}}">
                    <label for="model_new" >Модель *</label>
                    <input class="form-control" name="model_new" id="model_new" type="text" style="width:60%;" value="{{old('model_new')}}" required>
                    @if($errors->has('model_new'))
                      <span class="help-block">
                        <strong>{{$errors->first('model_new')}}</strong>
                      </span>
                    @endif
                  </div>
                  <div class="form-group col-md-6 {{$errors->has('color_new') ? 'has-error' : ''}}">
                    <label for="color_new" >Цвет кузова *</label>
                    <input class="form-control" name="color_new" id="color_new" type="text" style="width:60%;"  value="{{old('color_new')}}" required>
                    @if($errors->has('color_new'))
                      <span class="help-block">
                        <strong> {{$errors->first('color_new')}} </strong>
                      </span>
                    @endif
                  </div>


                  <div class="form-group col-md-6 {{$errors->has('number_new') ? 'has-error' : ''}}">
                    <label for="number_new">Гос номер РФ * </label>
                    <span class="help-block"></span>
                    <input class="form-control" type="text" id="number_new" name="number_new"  pattern="([(АВЕКМНОРСТУХ){1,3}0-9{5,6}]){6,8}"  style="width:50%;" value="{{old('number_new')}}" @if($errors->has('number_new')) autofocus @endif required>
                    <span class="help-block"> Введите корректный номерной знак автомобиля вместе с кодом региона, без запятых (например, <span class="text-danger"><b>С227НА69</b></span>) </span>
                    @if($errors->has('number_new'))
                      <span class="help-block">
                        <strong>{{$errors->first('number_new')}}</strong>
                      </span>
                    @endif
                  </div>
                  <div class="form-group col-md-5 col-md-offset-5">
                    <button class="btn btn-success" type="submit">Сохранить</button>
                  </div>
                </form>
                </div>
              </div>
              </div>
            </div>
          </div>
@endsection
