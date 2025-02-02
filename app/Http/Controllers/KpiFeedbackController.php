<?php

namespace App\Http\Controllers;

use App\Models\KpiAssign;
use App\Models\KpiFeedbackAttachment;
use Illuminate\Http\RedirectResponse;
use App\Traits\FileTrait;
use App\Traits\ImageTrait;
use Illuminate\Http\Request;

class KpiFeedbackController extends Controller
{
    use ImageTrait;
    use FileTrait;
    public function kpi_feedback($id)
    {
        $kpi_feedback=KpiAssign::find($id);
        return view('kpi.kpi_feedback',compact('kpi_feedback'));
    }

    public function kpi_feedback_submit(Request $request, $id): RedirectResponse
    {    
        $validatedData = $request->validate([           
            'fk_kpi_id'=>'required',
            'fk_kpi_assign_id'=>'required',
            'file'=>'nullable',         
        ]); 

        $kpi_feedback = KpiAssign::findOrFail($id);         
        $kpi_feedback->status = 'Completed';     
        $kpi_feedback->save(); 
        
        if ($request->hasFile('file')) {
            foreach ($request->file('file') as $file) {
                $filePath = $this->save_file('documents', $file);  
                KpiFeedbackAttachment::query()->create([
                    'file' => $filePath,
                    'fk_kpi_id' => $kpi_feedback->fk_kpi_id,
                    'fk_kpi_assign_id'=>$kpi_feedback->id,
                ]);
            }
        }
        
        return redirect()->route('kpi.all_assigned_kpi')->with('success', 'Kpi Feedback updated successfully.');
    }

    public function complete_kpi($id)
    {
        $complete_kpi=KpiAssign::find($id);
        return view('kpi.kpi_complete',compact('complete_kpi'));
    }

    public function complete_kpi_submit(Request $request, $id): RedirectResponse
    {    
        $validatedData = $request->validate([           
            'fk_kpi_id'=>'required',
            'fk_kpi_assign_id'=>'required',
            'total_complete'=>'nullable',         
        ]); 

        $kpi_assign = KpiAssign::findOrFail($id);         
        $kpi_assign->total_complete = $validatedData['total_complete'];    
        $kpi_assign->save();     
              
        return redirect()->route('kpi.all_assigned_kpi')->with('success', 'Kpi Target updated successfully.');
    }

    
}
