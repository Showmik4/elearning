<?php

namespace App\Http\Controllers;

use App\Models\KPI;
use App\Models\KpiAssign;
use App\Models\KpiAttachment;
use App\Models\KpiSubType;
use App\Models\KpiSubTypeTopic;
use App\Models\KpiType;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Traits\ImageTrait;
use App\Traits\FileTrait;
use Illuminate\Support\Facades\Session;

class KpiController extends Controller
{
    use ImageTrait;
    use FileTrait;
    public function show()
    {
        return view('kpi.index');
    }

    /***
     * @throws Exception
     **/
    public function list()
    {
        $kpi = KPI::with('type','subtype','topic')->get();      
        $userPermissions = auth()->user()->userType->permissions->pluck('name')->toArray();
        return datatables()->of($kpi)
            ->addColumn('permissions', function () use ($userPermissions) {
                return $userPermissions; 
            })
            ->addColumn('type', function (KPI $kpi) {
                return $kpi->type->type_name;
            })
            ->addColumn('subtype', function (KPI $kpi) {
                return $kpi->subtype->subtype_name;
            })
            ->addColumn('topic', function (KPI $kpi) {
                return $kpi->topic->topic_name;
            })

            ->addColumn('Downloads', function (KPI $kpi) {
                $documentLinks = '';       
                foreach ($kpi->documents as $document) {
                    $fileNameArray = explode('/', $document->file);
                    $documentFileName = end($fileNameArray);       
                  
                    $documentLinks .= '<a href="' . asset($document->file) . '" target="_blank" class="file-download" download="' . $documentFileName . '" title="Download Document">
                                            <i class="fa fa-download font-24"></i>
                                       </a><br>'; 
                }
            
                return $documentLinks ?: 'No Documents'; 
            })

            ->setRowAttr([
                'align' => 'center',
            ])  
           
            ->rawColumns(['type','subtype','topic','Downloads'])  
            ->make(true);
    }

    public function findSubType(Request $request){        
        $subType = KpiSubType::where('fk_type_id', $request->typeId)->get();       
        return response()->json([ 'subType' => $subType]);
    }

    public function findSubTypeTopic(Request $request){        
        $subTypeTopic = KpiSubTypeTopic::where('fk_subtype_id', $request->subtypeId)->get();       
        return response()->json([ 'subTypeTopic' => $subTypeTopic]);
    }

    public function create()
    {
        $type=KpiType::all();
        if(auth()->user()->fkUserTypeId == 1)
        {
            $user=User::all();
        }
        elseif(auth()->user()->fkUserTypeId == 2)
        {
            $user=User::where('fk_team_id',auth()->user()->fk_team_id)->get();
        }
        
        return view('kpi.create',compact('type','user'));
    }

    public function store(Request $request): RedirectResponse
    {       
        $validated = $this->validate($request, [
            'fk_type_id' => 'required', 
            'fk_subtype_id'=>'required',  
            'fk_subtype_topic_id'=>'required',
            'date'=>'required',
            'file'=>'required',  
            'fk_user_id'=>'required',   
            'target'=>'required',  
        ]);

        $kpi = KPI::create([
            'fk_type_id' => $validated['fk_type_id'], 
            'fk_subtype_id'=>$validated['fk_subtype_id'], 
            'fk_subtype_topic_id'=>$validated['fk_subtype_topic_id'],
            'date'=>$validated['date'],
            'added_by'=>auth()->user()->userId,         
        ]);  
        
        if ($request->hasFile('file')) {
            foreach ($request->file('file') as $file) {
                $filePath = $this->save_file('documents', $file);  
                KpiAttachment::query()->create([
                    'file' => $filePath,
                    'fk_kpi_id' => $kpi->id,
                ]);
            }
        }

        foreach ($validated['fk_user_id'] as $idx => $user) {
            KpiAssign::query()->create([
                'fk_user_id' => $user,
                'fk_kpi_id' => $kpi->id, 
                'date' => now()->format('Y-m-d'),
                'status'=>'Assigned',
                'assigned_by'=>auth()->user()->userId,     
                'target'=>$validated['target'],        
            ]);
        } 
     
        Session::flash('success', 'Kpi Created Successfully!');
        return redirect()->route('kpi.show');
    }  
    
    public function edit($id)
    {      
        $kpi = KPI::findOrFail($id);  
        $type=KpiType::all();     
        $sub_type=KpiSubType::all();
        $subtype_topic=KpiSubTypeTopic::all();
        if(auth()->user()->fkUserTypeId == 1)
        {
            $user=User::all();
        }
        elseif(auth()->user()->fkUserTypeId == 2)
        {
            $user=User::where('fk_team_id',auth()->user()->fk_team_id)->get();
        }
        return view('kpi.edit', compact('kpi','type','sub_type','user','subtype_topic'));
    }

    public function update(Request $request, $id): RedirectResponse
    {    
        $validatedData = $request->validate([
            'type_name' => 'required|string|max:255',          
        ]);       
        $kpi_type = KpiType::findOrFail($id); 
        $kpi_type->type_name = $validatedData['type_name'];      
        $kpi_type->save();  
        return redirect()->route('kpi_type.show')->with('success', 'Kpi Type updated successfully.');
    }
}
