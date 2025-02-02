<?php

namespace App\Http\Controllers;

use App\Models\Answer;
use App\Models\Survey;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class SurveyFormController extends Controller
{
    public function complete_survey()
    {
        return view('survey_form.index');
    }

    public function complete_survey_list()
    {    
        if(auth()->user()->userType->typeName == 'Admin')    
        {
            $answersGrouped = Answer::with('survey', 'user')->get()->groupBy('reference_no');
        }
        else
        {
            $answersGrouped = Answer::with('survey', 'user')->where('fk_user_id',auth()->user()->userId)->get()->groupBy('reference_no');
        }           
        $userPermissions = auth()->user()->userType->permissions->pluck('name')->toArray();
        $flattenedAnswers = $answersGrouped->map(function ($group, $referenceNo) {
            return [
                'reference_no' => $referenceNo,
                'survey' => $group->first()->survey->title ?? '',
                'user' => $group->first()->user->firstName ?? '',
            ];
        })->values();     
       
        return datatables()->of($flattenedAnswers)
            ->addColumn('permissions', function () use ($userPermissions) {
                return $userPermissions; 
            })
            ->addColumn('reference_no', function ($data) {
                return $data['reference_no'];
            })
            ->addColumn('survey', function ($data) {
                return $data['survey'];
            })
            ->addColumn('user', function ($data) {
                return $data['user'];
            })
            ->setRowAttr([
                'align' => 'center',
            ])
            ->rawColumns(['survey', 'user'])
            ->make(true);
    }  

    public function survey_form($id)
    {
        $survey=Survey::with('question','question.question_point')->where('id',$id)->first();       
       
        return view('survey_form.survey_form_view',compact('survey'));
    }

    public function submit_survey_form(Request $request): RedirectResponse
    {      
        $validated = $request->validate([
            'survey_id' => 'required|integer',
            'question_id' => 'required|array',
            'offered_answer_id' => 'required|array',
            'feedback'=>'required|array',
        ]);       

        $surveyId = $validated['survey_id'];       
        $referenceNumber = $this->generateReferenceNumber($surveyId);   

        foreach ($validated['question_id'] as $questionId) {
            if (isset($validated['offered_answer_id'][$questionId])) {
                Answer::create([
                    'survey_id' => $surveyId,
                    'question_id' => $questionId,
                    'offered_answer_id' => $validated['offered_answer_id'][$questionId],
                    'feedback' => $validated['feedback'][$questionId],
                    'fk_user_id'=>auth()->user()->userId,
                    'reference_no'=>$referenceNumber,
                ]);
            }
        }      
        Session::flash('success', 'Survey Submitted Successfully!');
        return redirect()->route('survey.show');
    }

    private function generateReferenceNumber($surveyId)
    {
        $userId = auth()->user()->userId;

        do {
            $uniqueNumber = random_int(10000, 99999);
            $exists = DB::table('answer')->where('reference_no', "$surveyId-$userId-$uniqueNumber")->exists();
        } while ($exists);

        return "$surveyId-$userId-$uniqueNumber";
    }

    public function view_complete_survey_answer($reference_no)
    {
        $answer=Answer::with('survey','question','question_point','user')->where('reference_no',$reference_no)->get();
        // dd($answer);

        return view('survey_form.complete_survey_answer',compact('answer'));

    }

}
