<?php
/**
 * Created by PhpStorm.
 * User: Veronica
 * Date: 25.09.2019
 * Time: 22:49
 */

namespace App\Http\Controllers;


use App\Answer;
use App\Question;
use Illuminate\Http\Request;

class AdminController
{

    public function questions(){

        $questions = Question::query()
            ->get();

        return view('admin.question.all',[
            'questions' => $questions
        ]);
    }

    public function deleteQuestion(Request $request){

        $request->validate([
            'id' => 'required',
        ]);

        $question_id = $request->get('id');
        Question::where('id', $question_id)->delete();
        return redirect()->back();
    }

    public function innerQuestion( Request $request, $id = '' ){

        $question = [];

        if($id){
            $question = Question::where('id', $id)->first();

            if(is_null($question))
                return abort(404);
        }

        if($request->isMethod('post')){

            $request->validate([
                'name' => 'required',
                'score' => 'required|numeric',
            ]);

            if(empty($question))
                $question = new Question();

            $question->value = $request->get('name');
            $question->score = $request->get('score');
            $question->save();

            return redirect()->route('questions');
        }

        return view('admin.question.inner',[
            'question' => $question,
            'id' => $id,
        ]);

    }


    public function answers( $question ){

        $question_info = Question::find( $question );

        if(is_null($question_info))
            return abort(404);

        $answers = $question_info->answers()->get();

        return view('admin.answer.all',[
            'answers' => $answers,
            'question_id' => $question,
        ]);
    }

    public function deleteAnswer( Request $request, $question ){

        $request->validate([
            'id' => 'required',
        ]);

        $answer = $request->get('id');
        Answer::where('id', $answer)->delete();
        return redirect()->back();

    }

    public function innerAnswer( Request $request, $question, $answer = '' ){

        $answer_info = [];

        $question_info = Question::find( $question );

        if(!is_null($question_info)){
            if($answer){
                $answer_info = $question_info->answers()->where('id', 39)->first();

                if(is_null($answer_info))
                    return abort(404);
            }

            if($request->isMethod('post')){

                $request->validate([
                    'name' => 'required',
                    'is_correct' => 'required|numeric',
                ]);

                if(empty($answer_info))
                    $answer_info = new Answer();


                $answer_info->value = $request->get('name');
                $answer_info->is_correct = $request->get('is_correct');
                $answer_info->question_id = $question;
                $answer_info->save();

                return redirect()->route('answers',[ 'question' => $question ]);
            }


            return view('admin.answer.inner', [ 'question' => $question, 'answer' => $answer, 'answer_info' => $answer_info  ]);
        }else{
            return abort(404);
        }

    }
}