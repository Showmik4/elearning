<?php

namespace App\Http\Controllers;

use App\Models\KpiSubType;
use App\Models\KpiSubTypeTopic;
use App\Models\KpiType;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class KpiSubTypeController extends Controller
{
    public function show()
    {
        return view('kpi_subtype.index');
    }

    /***
     * @throws Exception
     **/
    public function list()
    {
        $kpi_subtype = KpiSubType::with('type')->get();     
        $userPermissions = auth()->user()->userType->permissions->pluck('name')->toArray(); 
        return datatables()->of($kpi_subtype)
            ->addColumn('permissions', function () use ($userPermissions) {
                return $userPermissions; 
            })
            ->addColumn('type', function (KpiSubType $kpi_subtype) {
                return $kpi_subtype->type->type_name;
            })
            ->setRowAttr([
                'align' => 'center',
            ])  
            ->addColumn('topic_name', function (KpiSubType $kpi_subtype) {              
                $topicNames = $kpi_subtype->topic->pluck('topic_name')->toArray();           
              
                return implode(', ', $topicNames);
            })
            ->setRowAttr([
                'align' => 'center',
            ])
            ->rawColumns(['topic_name'])     
            ->make(true);
    }

    public function create()
    {
        $type=KpiType::all();
        return view('kpi_subtype.create',compact('type'));
    }

    public function store(Request $request): RedirectResponse
    {       
        $validated = $this->validate($request, [
            'subtype_name' => 'required|string|max:255', 
            'fk_type_id'=>'required',  
            'topic_name'=>'required'        
        ]);

        $subtype = KpiSubType::create([
            'subtype_name' => $validated['subtype_name'], 
            'fk_type_id'=>$validated['fk_type_id'],          
        ]);  
        
        foreach ($validated['topic_name'] as $idx => $topic_name) {
            KpiSubTypeTopic::query()->create([
                'fk_subtype_id' => $subtype->id,
                'topic_name' => $topic_name,               
            ]);
        } 
     
        Session::flash('success', 'Kpi Sub Type Created Successfully!');
        return redirect()->route('kpi_subtype.show');
    }

    public function edit($id)
    {      
        $kpi_subtype = KpiSubType::findOrFail($id);  
        $type=KpiType::all();     
        return view('kpi_subtype.edit', compact('kpi_subtype','type'));
    }

    public function update(Request $request, $id): RedirectResponse
    {    
        $validatedData = $request->validate([
            'subtype_name' => 'required|string|max:255', 
             'fk_type_id'=>'required',         
        ]);       
        $kpi_subtype = KpiSubType::findOrFail($id); 
        $kpi_subtype->subtype_name = $validatedData['subtype_name']; 
        $kpi_subtype->fk_type_id = $validatedData['fk_type_id'];     
        $kpi_subtype->save();  
        return redirect()->route('kpi_subtype.show')->with('success', 'Kpi Sub Type updated successfully.');
    }

    public function delete(Request $request): JsonResponse
    {
        $kpi_subtype = KpiSubType::where('id', $request->id)->first();
        if (!empty($kpi_subtype)) {          
            $kpi_subtype->delete();
        }
        return response()->json();
    }

    // Sub type topic list


    public function subtype_topic_list(Request $request)
    {
        // dd($request->all());
        $topic = KpiSubTypeTopic::where('fk_subtype_id',$request->subtype_id)->get();      
        return datatables()->of($topic)
           
            ->setRowAttr([
                'align' => 'center',
            ])            
                          
            ->make(true);
    }
}
