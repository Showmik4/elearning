<?php

namespace App\Http\Controllers;

use App\Models\KpiSubType;
use App\Models\KpiSubTypeTopic;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Response;

class TopicController extends Controller
{
    public function list(Request $request)
    {
        $topic = KpiSubTypeTopic::where('fk_subtype_id',$request->subtype_id)->get();      
        return datatables()->of($topic)
           
            ->setRowAttr([
                'align' => 'center',
            ])            
                          
            ->make(true);
    }

    public function create(Request $request): JsonResponse
    {     
        
        $subtype = KpiSubType::where('id', $request->subtype_id)->first(); 
        // dd($subtype);     
        if (!$subtype) {
            return response()->json(['statusText' => 'Any Variation Document Not Found!'], 404);
        }
        return response()->json(['subtype' => $subtype], 200);
    }

    public function store(Request $request)
    {
        // dd($request->all());
        try {
            DB::beginTransaction();          
            $validated = $this->validate($request, [
                'topic_name' => 'nullable',               
                'fk_subtype_id'=>'nullable',              
            ]);
            if($request->topicId == 0)
            {
                KpiSubTypeTopic::create([
                    'topic_name' => $validated['topic_name'],
                    'fk_subtype_id' => $validated['fk_subtype_id'],                     
                ]);
            }
            else
            {
                $kpiTopic = KpiSubTypeTopic::findOrFail($request->topicId); 
                $kpiTopic->topic_name = $validated['topic_name'];      
                $kpiTopic->save();  
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
        $topic = KpiSubTypeTopic::where('id', $id)->first();      
        if (!$topic) {
            return response()->json(['statusText' => 'Topic Not Found!'], 404);
        }
        return response()->json(['topic' => $topic], 200);
    }

    public function delete(Request $request): JsonResponse
    {
        $topic = KpiSubTypeTopic::where('id', $request->id)->first();
        if (!empty($topic)) {          
            $topic->delete();
        }
        return response()->json();
    }
}
