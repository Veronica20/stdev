@extends('app')
@section('title', 'Login')

@section('content')
    <div class="container">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div><br/>
        @endif
        <form action="{{ route('registration') }}" method="POST">
            {{ csrf_field() }}
            <h1><span class="login_title">գրանցում</span></h1>
            <div class="form-group">
                <label for="name">Անուն</label>
                <input type="text" class="form-control"  name="name" id="name" required>
            </div>
            <div class="form-group">
                <label for="surname">Ազգանուն</label>
                <input type="text" name="surname" class="form-control" id="surname" required>
            </div>
            <div class="form-group">
                <label for="email">Էլ․ հասցե</label>
                <input type="email"  name="email" class="form-control" id="email" required>
            </div>

            <div class="form-group">
                <label for="password">Գաղտնաբառ</label>
                <input type="password" class="form-control" pattern="^[a-zA-Z0-9]{6,12}$" name="password" id="password" required>
            </div>
            <div class="form-group">
                <label for="password_confirmation">Կրկնել Գաղտնաբառը</label>
                <input type="password" class="form-control" pattern="^[a-zA-Z0-9]{6,12}$" name="password_confirmation"  id="password_confirmation" required>
            </div>

            <br>
            <button type="submit" class="btn btn-primary">Գրանցվել</button>

            <a href="{{ url('/login') }}">
                մուտք
            </a>
        </form>
    </div>
@endsection