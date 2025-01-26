<?php

namespace App\Http\Controllers;

use App\Models\Batch;
use App\Models\Category;
use App\Models\KPI;
use App\Models\KpiAssign;
use App\Models\OrderInfo;
use App\Models\Customer;
use App\Models\Expense;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\Stock;
use App\Models\Sku;
use App\Models\Transaction;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use DB;

class HomeController extends Controller
{
    public function index()
    {
        $totalKpi=KPI::count();

        //Organization & Culture
        $completedKpiOrganization = KpiAssign::with(['user.team', 'kpi.type'])
        ->where('kpi_assign.status', 'Completed')
        ->whereHas('kpi.type', function ($query) {
            $query->where('type_name', 'Organization & Culture');
        })
        ->selectRaw('team.name, sum(kpi_assign.total_complete) as total_completed, sum(kpi_assign.target) as total_target')
        ->join('user', 'kpi_assign.fk_user_id', '=', 'user.userId')
        ->join('team', 'user.fk_team_id', '=', 'team.id')
        ->groupBy('team.name')
        ->get();
    
        
        $chartDataForOrganization = [
            ['Team', 'Total Completed', 'Total Target'], 
        ];
        
        if ($completedKpiOrganization->isEmpty()) {
            $chartDataForOrganization[] = ['No Data Available', 0, 0]; // Default row
        }
        else
        {

        }
        foreach ($completedKpiOrganization as $row) {
            $chartDataForOrganization[] = [
                $row->name, 
                (int) $row->total_completed, 
                (int) $row->total_target, 
            ];
        }  

        //CDD
        $completedKpiCDD = KpiAssign::with(['user.team', 'kpi.type'])
        ->where('kpi_assign.status', 'Completed')
        ->whereHas('kpi.type', function ($query) {
            $query->where('type_name', 'CDD');
        })

        ->selectRaw('team.name, sum(kpi_assign.total_complete) as total_completed,sum(kpi_assign.target) as total_target')
        ->join('user', 'kpi_assign.fk_user_id', '=', 'user.userId')
        ->join('team', 'user.fk_team_id', '=', 'team.id')
        ->groupBy('team.name')
        ->get();  
        
        $chartDataForCDD = [
            ['Team', 'Total Completed', 'Total Target'], 
        ];
        
        if ($completedKpiCDD->isEmpty()) {
            $chartDataForCDD[] = ['No Data Available', 0, 0]; 
        }

        else
        {
            foreach ($completedKpiCDD as $row) {
                $chartDataForCDD[] = [
                    $row->name, 
                    (int) $row->total_completed, 
                    (int) $row->total_target, 
                ];
            }  
        }


        //EDD

        $completedKpiEDD = KpiAssign::with(['user.team', 'kpi.type'])
        ->where('kpi_assign.status', 'Completed')
        ->whereHas('kpi.type', function ($query) {
            $query->where('type_name', 'EDD');
        })

        ->selectRaw('team.name, sum(kpi_assign.total_complete) as total_completed,sum(kpi_assign.target) as total_target')
        ->join('user', 'kpi_assign.fk_user_id', '=', 'user.userId')
        ->join('team', 'user.fk_team_id', '=', 'team.id')
        ->groupBy('team.name')
        ->get();   
        
        $chartDataForEDD = [
            ['Team', 'Total Completed', 'Total Target'], 
        ];
        
        if ($completedKpiEDD->isEmpty()) {
            $chartDataForEDD[] = ['No Data Available', 0, 0]; 
        }
        else
        {
            foreach ($completedKpiEDD as $row) {
                $chartDataForEDD[] = [
                    $row->name, 
                    (int) $row->total_completed, 
                    (int) $row->total_target, 
                ];
            }  
        }             
    

        //CB
        $completedKpiCB = KpiAssign::with(['user.team', 'kpi.type'])
        ->where('kpi_assign.status', 'Completed')
        ->whereHas('kpi.type', function ($query) {
            $query->where('type_name', 'CB');
        })

        ->selectRaw('team.name, sum(kpi_assign.total_complete) as total_completed,sum(kpi_assign.target) as total_target')
        ->join('user', 'kpi_assign.fk_user_id', '=', 'user.userId')
        ->join('team', 'user.fk_team_id', '=', 'team.id')
        ->groupBy('team.name')
        ->get();   

        
        $chartDataForCB = [
            ['Team', 'Total Completed', 'Total Target'], 
        ];
        
        if ($completedKpiCB->isEmpty()) {
            $chartDataForCB[] = ['No Data Available', 0, 0]; 
        }
        else
        {  
        foreach ($completedKpiCB as $row) {
            $chartDataForCB[] = [
                $row->name, 
                (int) $row->total_completed, 
                (int) $row->total_target, 
            ];
        }   
    }
        
        //Old 
                
        // $chartDataForCB = [
        //     'xValues' => $completedKpiCB->pluck('name')->toArray(),
        //     'yValues' => $completedKpiCB->pluck('total_completed')->toArray(),
        //     'totalTargets' => $completedKpiOrganization->pluck('total_target')->toArray(),
        // ];
    
        return view('home', compact('chartDataForOrganization','chartDataForCDD','chartDataForEDD','chartDataForCB'));
    }

    public function dummy_chart()
    {
        $totalKpi=KPI::count();

        //Organization & Culture
        $completedKpiOrganization = KpiAssign::with(['user.team', 'kpi.type'])
        ->where('kpi_assign.status', 'Completed')
        ->whereHas('kpi.type', function ($query) {
            $query->where('type_name', 'Organization & Culture');
        })
        ->selectRaw('team.name, sum(kpi_assign.total_complete) as total_completed, sum(kpi_assign.target) as total_target')
        ->join('user', 'kpi_assign.fk_user_id', '=', 'user.userId')
        ->join('team', 'user.fk_team_id', '=', 'team.id')
        ->groupBy('team.name')
        ->get();
    
        $chartDataForOrganization = [
            'xValues' => $completedKpiOrganization->pluck('name')->toArray(),
            'yValues' => $completedKpiOrganization->pluck('total_completed')->toArray(),      
            'totalTargets' => $completedKpiOrganization->pluck('total_target')->toArray(),    
        ];   

        return view('dummy_home', compact('chartDataForOrganization'));
    }

    public function upload(Request $request): void
    {
        if ($request->hasFile('upload') && $request->file('upload') !== null) {
            $originName = $request->file('upload')->getClientOriginalName();
            $fileName = pathinfo($originName, PATHINFO_FILENAME);
            $extension = $request->file('upload')->getClientOriginalExtension();
            $fileName .= '_' . time() . '.' . $extension;

            if (!File::isDirectory('public/ckImages')) {
                File::makeDirectory(('public/ckImages'), 0777, true, true);
            }

            $request->file('upload')->move(public_path('ckImages'), $fileName);

            $CKEditorFuncNum = $request->input('CKEditorFuncNum');
            $url = url('public/ckImages/' . $fileName);
            $msg = 'Image uploaded successfully';
            $response = "<script>window.parent.CKEDITOR.tools.callFunction($CKEditorFuncNum, '$url', '$msg')</script>";

            @header('Content-type: text/html; charset=utf-8');
            echo $response;
        }
    }

    public function registration_confimation()
    {
        return view('auth.confirm_registration');
    }
   
}
