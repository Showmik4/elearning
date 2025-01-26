<?php

namespace App\Http\Controllers;

use App\Models\Answer;
use App\Models\Question;
use App\Models\QuestionOption;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AnswerController extends Controller
{
    public function create($id)
    {      
        $question = Question::findOrFail($id);       
        return view('survey.create_answer', compact('question'));
    }

    public function list(Request $request)
    {
        $answer = QuestionOption::where('question_id',$request->question_id)->get();      
        return datatables()->of($answer)
            ->setRowAttr([
                'align' => 'center',
            ])          
            ->make(true);
    }

    public function add(Request $request): JsonResponse
    {   
        $question = Question::where('id', $request->question_id)->first();         
        if (!$question) {
            return response()->json(['statusText' => 'Question Not Found!'], 404);
        }
        return response()->json(['question' => $question], 200);
    }

    public function store(Request $request)
    {      
        try {
            DB::beginTransaction();          
            $validated = $this->validate($request, [
                'offered_answer' => 'nullable',             
                  
                'question_id'=>'nullable',
                'survey_id'=>'nullable',           
            ]);
            if($request->option_id == 0)
            {
                QuestionOption::create([
                    'offered_answer' => $validated['offered_answer'],
                    'question_id' => $validated['question_id'],   
                    'survey_id' => $validated['survey_id'],                   
                ]);
            }
            else
            {
                $answer = QuestionOption::findOrFail($request->option_id); 
                $answer->offered_answer = $validated['offered_answer'];      
                $answer->save();  
            }

            $message = "Stored";

            DB::commit();
            return response()->json(['message' => $message], Response::HTTP_OK);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['statusText' => $e->getMessage()], Response::HTTP_NOT_ACCEPTABLE);
        }
    }

    public function edit($id): JsonResponse
    {       
        $answer = QuestionOption::where('id', $id)->first();      
        if (!$answer) {
            return response()->json(['statusText' => 'Answer Not Found!'], 404);
        }
        return response()->json(['answer' => $answer], 200);
    }

    public function delete(Request $request): JsonResponse
    {
        $answer = QuestionOption::where('id', $request->id)->first();
        if (!empty($answer)) {          
            $answer->delete();
        }
        return response()->json();
    }

}
