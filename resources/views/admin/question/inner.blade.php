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
        <form action="{{ route('innerQuestion',['id' =>$id ]) }}" method="POST">
            {{ csrf_field() }}

            <h1><span class="login_title">Հարց</span></h1>
            <div class="form-group">
                <label for="name">Անվանում</label>
                <input type="text" class="form-control" value="{{ isset($question->value) ? $question->value : ''  }}" name="name" id="name" required>
            </div>
            <div class="form-group">
                <label for="score">Միավոր</label>
                <input type="text" name="score" pattern="^([5-9]|1[0-9]|20)$" class="form-control" value="{{ isset($question->score) ? $question->score : ''  }}" id="score" required>
            </div>
            <br>
            <button type="submit" class="btn btn-primary">Պահպանել</button>

        </form>
    </div>
@endsection