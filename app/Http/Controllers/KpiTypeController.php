<?php

namespace App\Http\Controllers;

use App\Models\KpiType;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class KpiTypeController extends Controller
{
    public function show()
    {
        return view('kpi_type.index');
    }

    /***
     * @throws Exception
     **/
    public function list()
    {
        $kpi_type = KpiType::all();      
        $userPermissions = auth()->user()->userType->permissions->pluck('name')->toArray();
        return datatables()->of($kpi_type)
            ->addColumn('permissions', function () use ($userPermissions) {
                return $userPermissions; 
            })
            ->setRowAttr([
                'align' => 'center',
            ])          
            ->make(true);
    }

    public function create()
    {
        return view('kpi_type.create');
    }

    public function store(Request $request): RedirectResponse
    {       
        $validated = $this->validate($request, [
            'type_name' => 'required|string|max:255',           
        ]);

        $type = KpiType::create([
            'type_name' => $validated['type_name'],           
        ]);     
     
        Session::flash('success', 'Kpi Type Created Successfully!');
        return redirect()->route('kpi_type.show');
    }

    public function edit($id)
    {      
        $kpi = KpiType::findOrFail($id);       
        return view('kpi_type.edit', compact('kpi'));
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

    public function delete(Request $request): JsonResponse
    {
        $kpi_type = KpiType::where('id', $request->id)->first();
        if (!empty($kpi_type)) {          
            $kpi_type->delete();
        }
        return response()->json();
    }
}
