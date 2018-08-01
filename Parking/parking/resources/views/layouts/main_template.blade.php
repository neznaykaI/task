<!DOCTYPE html>
<html lang="ru">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="csrf-token" content="{{ csrf_token() }}" />
  <title>Car-Park</title>

  <!-- Styles -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.1.1/css/all.css" integrity="sha384-O8whS3fhG2OnA5Kas0Y9l3cfpmYjapjI0E4theH4iuMD+pLhbf6JI0jIMfYcK3yZ" crossorigin="anonymous">
<link href="{{ asset('css/new_style.css') }}" rel="stylesheet">
</head>
<body>
  <div>
    <div class="navbar navbar-default navbar-fixed-top">
      <div class="container-fluid">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="/" title="Учет клиентов автостоянки">Car-Park
            <span><i class="fas fa-car"></i></span>
          </a>
        </div>
        <div class="navbar-collapse collapse">
          <ul class="nav navbar-nav navbar-right">
            <li> <a href="/">На главную</a></li>
            @if(Auth::guest())
              <li> <a href="{{route('login')}}"> Вход </a>  </li>
              @else
                <li> <a href="{{route('show_auto')}}"> Статистика </a></li>
                <li> <a href="{{route('clients.index')}}"> База клиентов </a></li>
                <li> <a href="{{route('create_record')}}"> Добавить клиента </a></li>
                <li><a href="{{route('logout')}}" title="Выход" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">  Выйти ( {{Auth::user()->login}} )  </a></li>
              <form hidden action="{{ route('logout') }}" id="logout-form" method="post">
                {{ csrf_field() }}
              </form>
              @endif
          </ul>
      </div>
    </div>
  </div>
  @yield('content')

</div>
  <!-- Scripts -->
  <script src="{{ asset('js/app.js') }}"></script>
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.2/js/bootstrap.min.js" integrity="sha384-o+RDsa0aLu++PJvFqy8fFScvbHFLtbvScb8AjopnFD+iEQ7wo/CG0xlczd+2O/em" crossorigin="anonymous"></script>
  <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>

  <script>$('div.alert').not('.alert-important').delay(3000).fadeOut(350);</script>
</body>
</html>
