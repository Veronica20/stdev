@extends('app')
@section('title', 'Login')

@section('content')
    <div class="container">

        <table id="scores_table" class="display text-black-50">
            <thead>
            <tr class="text-white">
                <th>*</th>
                <th>Անուն Ազգանուն</th>
                <th>Միավոր</th>
            </tr>
            </thead>
            <tbody>
            @foreach($scores as $key=> $score)
                <tr>
                    <td>{{$score->id}}</td>
                    <td>{{$score->name.' '. $score->surname}}</td>
                    <td>{{$score->score}}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    <script>

        $(document).ready( function () {
            $('#scores_table').DataTable();
        } );

    </script>

@endsection