<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" /> 
        <meta name="csrf-token" content="{{ csrf_token() }}" />
        <title>{{config('app.name')}}</title>
        <link rel="shortcut icon" type="image/png" href="{{url('/images/favicon.png')}}"/>
        <link rel="stylesheet" href="{{url('css/animate.css')}}" type="text/css" />
        <link rel="stylesheet" href="{{url('css/custom.css')}}" type="text/css" />
    </head>
  
    <body>

        <section class="auth animated fadeInUp">
            <img class="logo" src="{{URL::to('images/logo.png')}}"/>

            @if(isset($message))
              <p class="alert">{{ $message }}</p>
            @endif
            
            @if($errors->any())
                <ul class="errors">
                    @foreach($errors->all() as $message)
                        <li> {{$message}} </li>
                    @endforeach
                </ul>
            @endif
            
            <form class="auth-form" action="{{URL::current()}}" method="POST">
                {{ csrf_field() }}
                <div class="form-group">
                    <input type="username" name="username" placeholder="Username" class="form-control"/>
                </div>
                <div class="form-group">
                    <input type="password" name="password" placeholder="Password" class="form-control"/>
                </div>
                <input type="submit" value="Login" class="auth-btn text-uppercase"/>
                <a href="{{url('/register')}}" class="sm-text text-uppercase">Register here</a>
            </form> 
        </section>
    
    </body>

</html>