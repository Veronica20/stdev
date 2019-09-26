@extends('app')
@section('title', 'game')

@section('content')
    <audio id="end" src="{{asset('sounds/end.mp3')}}"></audio>
    <audio id="correct" src="{{asset('sounds/correct.mp3')}}"></audio>
    <audio id="wrong" src="{{asset('sounds/wrong.mp3')}}"></audio>
    <audio id="ready" src="{{asset('sounds/ready.mp3')}}"></audio>
    @if($question)
    <div class="container">

        <div class="row">
            <div id="question_answer" class="col-xs-12 question_answer" style="">
                <div class="quest">
                    <span>{{$question->value}}</span>
                </div>
                <div class="answ_block">
                    @foreach($answers as $answer)
                    <div class="answ answer ahov mb-2">
                        <div data-id="{{$answer->id}}" class="answ_inside">
                            <div class="answ_text">{{$answer->value}}</div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
        <script>
            $(function() {
                $('#ready')[0].play();
            });
        </script>
    @else
        <script>
            $(function() {
                $('#end')[0].play();
            });
        </script>
    @endif

    <div>Question: <span class="question">{{$step + 1}}</span></div>
    <div>Score: <span class="score">{{$score}}</span></div>


    <script>
        $(function() {
            $('.answ_inside').click(function (e) {
                e.preventDefault();

                var this_ = $(this);
                const id = this_.data('id');

                $.post('', {id: id}, function(data) {

                    if (data.correct) {
                        this_.css('background-position','0 -134px');
                        $('#correct')[0].play();
                    } else {
                        var find = "#question_answer .answ_inside[data-id='"+ data.correct_id +"'";
                        $(find).css('background-position','0 -134px');

                        this_.css('background-position','0 -93px');

                        $('#wrong')[0].play();
                    }
                    setTimeout(function () {
                        location.reload(true);
                    }, 4000);


                }, "json");
            });
        });
    </script>

@endsection

