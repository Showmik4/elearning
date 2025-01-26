<?php

namespace App\Http\Controllers;

use App\Models\Question;
use App\Models\QuestionOption;
use App\Models\Survey;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Session;

class QuestionController extends Controller
{
    public function show()
    {
        return view('question.index');
    }

    /***
     * @throws Exception
     **/
    public function list(Request $request)
    {
        $question = Question::where('survey_id',$request->survey_id)->get();      
        return datatables()->of($question)
            ->setRowAttr([
                'align' => 'center',
            ])          
            ->make(true);
    }

    // public function create()
    // {
    //     $survey=Survey::all();
    //     return view('question.create',compact('survey'));
    // }

    public function create(Request $request): JsonResponse
    {     
        
        $survey = Survey::where('id', $request->survey_id)->first(); 
        // dd($subtype);     
        if (!$survey) {
            return response()->json(['statusText' => 'Survey Not Found!'], 404);
        }
        return response()->json(['survey' => $survey], 200);
    }

    // public function store(Request $request): RedirectResponse
    // {       
    //     $validated = $this->validate($request, [
    //         'survey_id' => 'required|string|max:255',    
    //         'offered_answer' => 'required',   
    //         'title' => 'required',
    //     ]); 

    //     $question = Question::create([
    //        'title' => $validated['title'],
    //        'survey_id' => $validated['survey_id'],
    //     ]); 

    //     $survey=$request->survey_id;
    //     foreach ($validated['offered_answer'] as $idx => $answer) {
    //         QuestionOption::query()->create([
    //             'survey_id' => $survey,
    //             'question_id' => $question->id, 
    //             'offered_answer'=>$answer,     
            
    //         ]);
    //     }     
    //     Session::flash('success', 'Question Created Successfully!');
    //     return redirect()->route('question.show');
    // }

    public function store(Request $request)
    {      
        try {
            DB::beginTransaction();          
            $validated = $this->validate($request, [
                'title' => 'nullable',               
                'survey_id'=>'nullable',              
            ]);
            if($request->question_id == 0)
            {
                Question::create([
                    'title' => $validated['title'],
                    'survey_id' => $validated['survey_id'],                     
                ]);
            }
            else
            {
                $question = Question::findOrFail($request->question_id); 
                $question->title = $validated['title'];      
                $question->save();  
            }

            $message = "Stored";

            DB::commit();
            return response()->json(['message' => $message], Response::HTTP_OK);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['statusText' => $e->getMessage()], Response::HTTP_NOT_ACCEPTABLE);
        }
    }

    // public function edit($id)
    // {      
    //     $question = Question::with('question_point')->findOrFail($id);  
    //     $survey=Survey::all();     
    //     return view('question.edit', compact('question','survey'));
    // }

    public function edit($id): JsonResponse
    {       
        $question = Question::where('id', $id)->first();      
        if (!$question) {
            return response()->json(['statusText' => 'Question Not Found!'], 404);
        }
        return response()->json(['question' => $question], 200);
    }

    public function update(Request $request, $id): RedirectResponse
    {    
        $validatedData = $request->validate([
            'survey_id' => 'nullable', 
            'title' => 'nullable',         
        ]);       
        $question = Question::findOrFail($id); 
        $question->survey_id = $validatedData['survey_id'];    
        $question->title = $validatedData['title'];    
        $question->save(); 


        return redirect()->route('question.show')->with('success', 'Question updated successfully.');
    }

    public function delete(Request $request): JsonResponse
    {
        $question = Question::with('question_point')->where('id', $request->id)->first();
        if (!empty($question)) { 
            $question->question_point->delete();         
            $question->delete();
        }
        return response()->json();
    }

}
