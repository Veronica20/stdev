
@extends('app')
@section('title', 'Login')

@section('content')
    <div class="container ">
        <div class=" form-row  align-items-center">
            <div  class="col-auto mt-5 mx-auto">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div><br/>
                @endif
                <form action="{{ route('login') }}" method="POST">
                    {{ csrf_field() }}
                    <h1 class="text-center"> <span class="login_title">Մուտք</span> </h1>
                    <div class="form-group">
                        <label for="email">էլ հասցե</label>
                        <input type="text" class="form-control"  name="email" id="email" required>
                    </div>
                    <div class="form-group">
                        <label for="password">Գաղտնաբառ</label>
                        <input type="password" class="form-control"  name="password" id="password" required>
                    </div>
                    <div class="form-check">
                        <input type="checkbox" name="remember" class="form-check-input" id="remember">
                        <label class="form-check-label" for="remember">Հիշել</label>
                    </div>
                    <br>
                    <div>
                        <button type="submit" class="btn btn-primary"> Մուտք </button>
                        <div>
                            <a href="{{ url('/registration') }}" class="text-white">
                                Գրանցվել
                            </a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection