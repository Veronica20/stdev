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
        <form action="{{ route('innerAnswer',['question' =>$question, 'answer' => $answer ]) }}" method="POST">
            {{ csrf_field() }}

            <h1><span class="login_title">Պատասխան</span></h1>
            <div class="form-group">
                <label for="name">Անվանում</label>
                <input type="text" class="form-control" value="{{ isset($answer_info->value) ? $answer_info->value : ''  }}" name="name" id="name" required>
            </div>
            <!-- Default unchecked -->
            <div class="custom-control custom-radio">
                <input type="radio" class="custom-control-input" id="defaultUnchecked" name="is_correct" value="1" {{ !isset($answer_info->value) || ( isset($answer_info->value) && $answer_info->is_correct  ) ? 'checked' : ''}}>
                <label class="custom-control-label" for="defaultUnchecked"> Ճիշտ է </label>
            </div>

            <!-- Default checked -->
            <div class="custom-control custom-radio">
                <input type="radio" class="custom-control-input" id="defaultChecked" name="is_correct" value="0"  {{ isset($answer_info->value) && !$answer_info->is_correct ? 'checked' : ''}}>
                <label class="custom-control-label" for="defaultChecked"> Սխալ է </label>
            </div>
            <br>
            <button type="submit" class="btn btn-primary">Պահպանել</button>

        </form>
    </div>
@endsection