@extends('layouts.main_template')
@section('content')
<div class="container">
  <div class="row">
    <h1>Добавление нового клиента</h1>
    <br>
    <form action="{{ route('client_store') }}" method="post">
      <input type="hidden" name="_token" value="{{ csrf_token() }}">
      <div class="col-md-8">
        <p class="lead"> Информация о клиенте </p>
      </div>
      <div class="form-group col-md-8 {{$errors->has('full_name') ? 'has-error' : ''}}">
        <label for="full_name" >ФИО</label>
        <input class="form-control" name="full_name" id="full_name" type="text" minlength="3" lvalue="{{old('full_name')}}" @if($errors->has('full_name')) autofocus @endif autofocus>
        @if($errors->has('full_name'))
          <span class="help-block">
            <strong> {{$errors->first('full_name')}} </strong>
          </span>
        @endif
      </div>
      <div class="form-group col-md-8">
        <p> Пол* : </p>
        <label for="genderM">  <input type="radio" id="genderM" name="gender" value="m" {{old('gender')=="m" ? 'checked' : ''}} {{empty(old('gender')) ? 'checked' : ''}}> Мужской </label><br/>
        <label for="genderF">  <input type="radio" id="genderF" name="gender" value="f" {{old('gender')=="f" ? 'checked' : ''}}> Женский </label>
      </div>
      <div class="form-group col-md-8 {{$errors->has('phone') ? 'has-error' : ''}}">
        <label for="phone">Номер телефона * </label>
        <span class="help-block">Введите номер сотового телефона в формате 8**********</span>
        <input class="form-control" type="tel" id="phone" name="phone" pattern="^(8)+\d{10}$" required maxlength="11" style="width:30%;" value="{{old('phone')}}" @if($errors->has('phone')) autofocus @endif>
        @if ($errors->has('phone'))
            <span class="help-block">
                <strong>{{ $errors->first('phone') }}</strong>
            </span>
        @endif
      </div>
      <div class="form-group col-md-8">
        <label for="address"> Адрес </label>
        <input class="form-control" type="text" id="address" name="address" value="{{old('address')}}">
      </div>

      <div class="col-md-8">
        <p class="lead"> Информация об автомобиле клиента </p>
      </div>
      <div class="form-group col-md-8 {{$errors->has('mark') ? 'has-error' : ''}}">
        <label for="mark" >Марка *</label>
        <input class="form-control" name="mark" id="mark" type="text" style="width:50%;" required value="{{old('mark')}}" @if($errors->has('mark')) autofocus @endif>
        @if($errors->has('mark'))
          <span class="help-block">
            <strong>{{$errors->first('mark')}}</strong>
          </span>
        @endif
      </div>
      <div class="form-group col-md-8 {{$errors->has('model') ? 'has-error' : ''}}">
        <label for="model" >Модель *</label>
        <input class="form-control" name="model" id="model" type="text" style="width:50%;" value="{{old('model')}}" required @if($errors->has('model')) autofocus @endif>
        @if($errors->has('model'))
          <span class="help-block">
            <strong>{{$errors->first('model')}}</strong>
          </span>
        @endif
      </div>
      <div class="form-group col-md-8 {{$errors->has('color') ? 'has-error' : ''}}">
        <label for="color" >Цвет кузова *</label>
        <input class="form-control" name="color" id="color" type="text" style="width:40%;"  value="{{old('color')}}" required @if($errors->has('color')) autofocus @endif>
        @if($errors->has('color'))
          <span class="help-block">
            <strong> {{$errors->first('color')}} </strong>
          </span>
        @endif
      </div>
      <div class="form-group col-md-8 {{$errors->has('number') ? 'has-error' : ''}}">
        <label for="number">Гос номер РФ * </label>
        <span class="help-block"></span>
        <input class="form-control" type="tel" id="number" name="number"  pattern="([(АВЕКМНОРСТУХ){1,3}0-9{5,6}]){6,8}" maxlength="9" style="width:30%;" value="{{old('number')}}" @if($errors->has('number')) autofocus @endif required>
        <span class="help-block"> Введите корректный номерной знак автомобиля вместе с кодом региона, без запятых (например, <span class="text-danger"><b>С227НА69</b></span>) </span>
        @if($errors->has('number'))
          <span class="help-block">
            <strong>{{$errors->first('number')}}</strong>
          </span>
        @endif
      </div>
      <div class="form-group col-md-5 col-md-offset-5">
        <button class="btn btn-success" type="submit">Добавить</button>
      </div>
    </form>
  </div>
</div>
@endsection
