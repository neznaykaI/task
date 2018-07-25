@extends('layouts.main_template')
@section('content')
<div id="menu" class="container">
  <div class="row">
      <div class="col-md-2 col-md-offset-2 block1" style="background-color:#d7d7d7;">
        <a href="{{route('clients.index')}}" class="menu-link">Все клиенты</a>
        <i class="fas fa-user-friends"></i>
      </div>

      <div class="col-md-2 block2" style="background-color:#d7d7d7;">
        <a href="{{route('show_auto')}}" class="menu-link">Статистика автостоянки</a>
        <i class="far fa-chart-bar"></i>
      </div>

      <div class="col-md-2 block3" style="background-color:#d7d7d7;">
        <a href="{{route('create_record')}}" class="menu-link">Новый клиент</a>
        <i class="fas fa-user-plus"></i>
      </div>
    </div>
</div>
@endsection
