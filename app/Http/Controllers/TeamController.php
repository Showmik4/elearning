<?php

namespace App\Http\Controllers;

use App\Models\Team;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class TeamController extends Controller
{
    public function show()
    {
        return view('team.index');
    }

    /***
     * @throws Exception
     **/
    public function list()
{
    $team = Team::all();
    $userPermissions = auth()->user()->userType->permissions->pluck('name')->toArray();

    return datatables()->of($team)
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
        return view('team.create');
    }

    public function store(Request $request): RedirectResponse
    {       
        $validated = $this->validate($request, [
            'name' => 'required|string|max:255',           
        ]);       
        $team = Team::create([
            'name' => $validated['name'],           
        ]);      
     
        Session::flash('success', 'Team Created Successfully!');
        return redirect()->route('team.show');
    }

    public function edit($id)
    {      
        $team = Team::findOrFail($id);       
        return view('team.edit', compact('team'));
    }

    public function update(Request $request, $id): RedirectResponse
    {    
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',          
        ]);       
        $team = Team::findOrFail($id); 
        $team->name = $validatedData['name'];      
        $team->save();  
        return redirect()->route('team.show')->with('success', 'Team updated successfully.');
    }

    public function delete(Request $request): JsonResponse
    {
        $team = Team::where('id', $request->id)->first();
        if (!empty($team)) {          
            $team->delete();
        }
        return response()->json();
    }

    public function toggleStatus(Request $request)
    {
        $country = Country::query()->where('countryId', $request->id)->first();
        if (!empty($country)) {
            // Delete associated cities first
            $country->cities()->delete();

            // Then delete the country
            $country->delete();
        }
        return response()->json();
    }
}
