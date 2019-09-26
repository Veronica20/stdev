<?php
/**
 * Created by PhpStorm.
 * User: Veronica
 * Date: 25.09.2019
 * Time: 21:17
 */

namespace App\Http\Controllers;


use App\Answer;
use App\Question;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class GameController extends Controller
{
    public function game()
    {
        $questions = Question::query()
            ->groupBy('score')
            ->orderByRaw('RAND()')
            ->limit(5)
            ->get()
        ;

        Session::put('questions', $questions);
        Session::put('step', 0);
        Session::put('score', 0);

        return redirect()->route('question');
    }

    public function question()
    {
        $questions = Session::get('questions');

        if (empty($questions)) {
            return redirect()->route('game');
        }

        $step = Session::get('step');
        $score = Session::get('score');

        $answers = [];
        $correct_id = null;

        if ($step >= 4) {
            $currentQuestion = null;


            Session::put('questions', []);
            Session::put('step', 0);
            Session::put('score', 0);

            $user = User::query()
                ->where('id', Auth::id())
                ->first();

            if ($score > $user->score) {
                $user->score = $score;
                $user->save();
            }

        } else {
            $currentQuestion = $questions[$step];


            foreach ($currentQuestion->answers as $answer) {
                if($answer->is_correct){
                    if ($correct_id) {
                        continue;
                    }
                    $correct_id = $answer->id;
                }

                $answers[] = $answer;
            }
        }

        return view('users.game')->with([
            'question' => $currentQuestion,
            'answers' => $answers,
            'step' => $step,
            'score' =>  $score,
        ]);
    }

    public function answer(Request $request)
    {
        $id = $request->post('id');

        $answer = Answer::query()
            ->whereId($id)
            ->first();

        if (!$answer) {
            abort(404);
        }

        $answers = [];
        $correct_id = null;

        foreach (Session::get('questions')[Session::get('step')]->answers as $val){
            if($val->is_correct){
                $correct_id = $val->id;
            }
        }

        $step = Session::get('step') + 1;
        Session::put('step', $step);
        $score = Session::get('score');

        if ($answer->is_correct) {
            $score += $answer->question->score;
            Session::put('score', $score);
        }



        return [
            'correct' => $answer->is_correct,
            'correct_id' => $correct_id,
        ];
    }

    public function score(){

        $scores = User::query()->limit(10)->orderBy('score','desc')->get();

        return view('users.score')->with([
            'scores' => $scores
        ]);
    }
}