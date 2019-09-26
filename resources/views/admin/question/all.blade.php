@extends('app')
@section('title', 'Login')

@section('content')
    <div class="container">
        <a class="btn btn-success mb-lg-5" href="{{ route('innerQuestion') }}"> Ստեղծել Հարց</a>

        <table id="questions_table" class="display text-black-50">
            <thead>
            <tr class="text-white">
                <th>*</th>
                <th>Հարց</th>
                <th>Միավոր</th>
                <th> Հարցեր </th>
                <th> Ջնջել, Փոխել </th>
            </tr>
            </thead>
            <tbody>
            @foreach($questions as $question)
                <tr>
                    <td>{{$question->id}}</td>
                    <td>{{$question->value}}</td>
                    <td>{{$question->score}}</td>
                    <td> <a class="btn btn-info" href="{{ route('answers', ['id' => $question->id]) }}"> Ցանկ </a></td>
                    <td>
                        <form action="{{ route('deleteQuestion') }}" method="POST" class="inline_block">
                            {{ csrf_field() }}
                            <input type="hidden" name="id" value="{{$question->id}}">
                            <button class="btn btn-danger"> Ջնջել </button>
                        </form>
                        <a  class="btn btn-primary" href="{{ route('innerQuestion', ['id' => $question->id]) }}"> Փոխել </a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    <script>

        $(document).ready( function () {
            $('#questions_table').DataTable();
        } );

    </script>

@endsection