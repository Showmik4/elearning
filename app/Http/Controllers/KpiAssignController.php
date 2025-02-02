<?php

namespace App\Http\Controllers;

use App\Models\KPI;
use App\Models\KpiAssign;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class KpiAssignController extends Controller
{
    public function assign($id)
    {      
        $kpi = KPI::findOrFail($id);
        
        if(auth()->user()->userType->typeName == 'Admin')
        {
            $user=User::all(); 
        }

        else
        {
            $user=User::where('fk_team_id',auth()->user()->fk_team_id)->get();
        }
           
        return view('kpi.assign', compact('kpi','user'));
    }

    public function assign_submit(Request $request): RedirectResponse
    {      
        $validated = $this->validate($request, [
            'fk_kpi_id' => 'required', 
            'fk_user_id'=>'required',
            'target'=>'required',
        ]);  
        
        $kpi=$request->fk_kpi_id;        
        foreach ($validated['fk_user_id'] as $idx => $user) {
            KpiAssign::query()->create([
                'fk_user_id' => $user,
                'fk_kpi_id' => $kpi, 
                'date' => now()->format('Y-m-d'),
                'target'=>$validated['target'],
                'status'=>'Assigned',
                'assigned_by'=>auth()->user()->userId,
            
            ]);
        }      
        Session::flash('success', 'Kpi Created Successfully!');
        return redirect()->back();
    }

    public function assignList(Request $request)
    {
        // dd($request->kpi_id);
        if(auth()->user()->userType->typeName == 'Admin')
        {
            $kpiAssign = KpiAssign::with('kpi','kpi.type','kpi.subtype','kpi.topic','kpi.documents','user','assignedBy')->where('fk_kpi_id',$request->kpi_id)->get();    
        }

        else
        {
            $kpiAssign = KpiAssign::with('kpi','kpi.type','kpi.subtype','kpi.topic','kpi.documents','user','assignedBy','user.team')->where('fk_kpi_id',$request->kpi_id)->whereHas('user.team', function ($query) {
                $query->where('id', Auth::user()->fk_team_id); 
            })->get();
        }
        
          
        return datatables()->of($kpiAssign)
         
            ->addColumn('type', function (KpiAssign $kpiAssign) {
                return $kpiAssign->kpi->type->type_name;
            })
            ->addColumn('subtype', function (KpiAssign $kpiAssign) {
                return $kpiAssign->kpi->subtype->subtype_name;
            })
            ->addColumn('topic', function (KpiAssign $kpiAssign) {
                return $kpiAssign->kpi->topic->topic_name;
            })
            ->addColumn('member', function (KpiAssign $kpiAssign) {
                return $kpiAssign->user->firstName .' '. $kpiAssign->user->lastName;
            })

            ->addColumn('added_by', function (KpiAssign $kpiAssign) {
                return $kpiAssign->assignedBy->firstName .' '. $kpiAssign->assignedBy->lastName;
            })

            ->addColumn('Downloads', function (KpiAssign $kpiAssign) {
                $documentLinks = '';       
                foreach ($kpiAssign->kpi->documents as $document) {
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

            ->rawColumns(['type','subtype','topic','Downloads','member','added_by'])  
            ->make(true);
    }

    //All Assigned List For Officers

    public function all_kpi()
    {
        return view('kpi.all_kpi_for_member');
    }

    public function all_assigned_kpi_list()
    {
        if(auth()->user()->userType->typeName == 'Officer')
        {
            $kpiAssign = KpiAssign::with('kpi','kpi.type','kpi.subtype','kpi.topic','kpi.documents','user','assignedBy')->where('fk_user_id',auth()->user()->userId)->get();
        }
        elseif(auth()->user()->userType->typeName == 'Line Manager')
        {            
            $kpiAssign = KpiAssign::with('kpi','kpi.type','kpi.subtype','kpi.topic','kpi.documents','user','assignedBy','user.team')->whereHas('user.team', function ($query) {
                $query->where('id', Auth::user()->fk_team_id); 
            })->get();
        }
        else
        {
            $kpiAssign = KpiAssign::with('kpi','kpi.type','kpi.subtype','kpi.topic','kpi.documents','user','assignedBy')->get();  
        }    
        
        $userPermissions = auth()->user()->userType->permissions->pluck('name')->toArray(); 

        return datatables()->of($kpiAssign)
            ->addColumn('permissions', function () use ($userPermissions) {
                return $userPermissions; 
            })
            ->addColumn('type', function (KpiAssign $kpiAssign) {
                return $kpiAssign->kpi->type->type_name;
            })
            ->addColumn('subtype', function (KpiAssign $kpiAssign) {
                return $kpiAssign->kpi->subtype->subtype_name;
            })
            ->addColumn('topic', function (KpiAssign $kpiAssign) {
                return $kpiAssign->kpi->topic->topic_name;
            })
            ->addColumn('member', function (KpiAssign $kpiAssign) {
                return $kpiAssign->user->firstName .' '. $kpiAssign->user->lastName;
            })

            ->addColumn('added_by', function (KpiAssign $kpiAssign) {
                return $kpiAssign->assignedBy->firstName .' '. $kpiAssign->assignedBy->lastName;
            })

            ->addColumn('status', function ($kpiAssign) {
                $btn = '';
                if ($kpiAssign->status == 'Assigned') {
                    $btn = $btn . '<a title="Status" class="btn btn-danger">Assigned</a>';
                } else {
                    $btn = $btn . '<a title="Status" class="btn btn-success">Completed</a>';
                }
                return $btn;
            })

            ->addColumn('Downloads', function (KpiAssign $kpiAssign) {
                $documentLinks = '';       
                foreach ($kpiAssign->kpi->documents as $document) {
                    $fileNameArray = explode('/', $document->file);
                    $documentFileName = end($fileNameArray);       
                  
                    $documentLinks .= '<a href="' . asset($document->file) . '" target="_blank" class="file-download" download="' . $documentFileName . '" title="Download Document">
                                            <i class="fa fa-download font-24"></i>
                                       </a><br>'; 
                }
            
                return $documentLinks ?: 'No Documents'; 
            })

            ->addColumn('FeedBackFile', function (KpiAssign $kpiAssign) {
                $documentLinks = '';       
                foreach ($kpiAssign->documents as $document) {
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

            ->rawColumns(['type','subtype','topic','Downloads','member','added_by','FeedBackFile','status'])  
            ->make(true);
    }
}
