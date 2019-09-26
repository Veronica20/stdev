@extends('app')
@section('title', 'Login')

@section('content')
    <div class="container">
        <a class="btn btn-success mb-lg-5" href="{{ route('innerAnswer',['question' => $question_id]) }}"> Ստեղծել Պատասխան </a>
        <a class="btn btn-secondary  mb-lg-5" href="{{ route('questions') }}"> Հարցերի Ցանկ </a>

        <table id="answer_table" class="display text-black-50">
            <thead>
            <tr class="text-white">
                <th>*</th>
                <th> Հարց </th>
                <th> ճիշտ է </th>
                <th> Ջնջել, Փոխել </th>
            </tr>
            </thead>
            <tbody>
            @foreach($answers as $answer)
                <tr>
                    <td>{{$answer->id}}</td>
                    <td>{{$answer->value}}</td>
                    <td>{{$answer->is_correct ? 'Այո' : 'Ոչ'}}</td>
                    <td>
                        <form action="{{ route('deleteAnswer',['question' => $question_id ]) }}" method="POST"  class="inline_block">
                            {{ csrf_field() }}
                            <input type="hidden" name="id" value="{{$answer->id}}">
                            <button class="btn btn-danger"> Ջնջել</button>
                        </form>
                        <a class="btn btn-primary" href="{{ route('innerAnswer', ['question' => $question_id, 'answer' => $answer->id ]) }}"> Փոխել </a></td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    <script>

        $(document).ready( function () {
            $('#answer_table').DataTable();
        } );

    </script>
@endsection