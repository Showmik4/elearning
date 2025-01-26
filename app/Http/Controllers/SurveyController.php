<?php

namespace App\Http\Controllers;

use App\Models\Survey;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class SurveyController extends Controller
{
    public function show()
    {
        return view('survey.index');
    }

    /***
     * @throws Exception
     **/
    public function list()
    {
        $survey = Survey::all();      
        $userPermissions = auth()->user()->userType->permissions->pluck('name')->toArray();
        return datatables()->of($survey)
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
        return view('survey.create');
    }

    public function store(Request $request): RedirectResponse
    {
       
        $validated = $this->validate($request, [
            'title' => 'required|string|max:255',    
            'description' => 'required',        
        ]);       
        $survey = Survey::create([
            'title' => $validated['title'],
           'description' => $validated['description'],
        ]);      
     
        Session::flash('success', 'Survey Created Successfully!');
        return redirect()->route('survey.show');
    }

    public function edit($id)
    {      
        $survey = Survey::findOrFail($id);       
        return view('survey.edit', compact('survey'));
    }

    public function update(Request $request, $id): RedirectResponse
    {    
        $validatedData = $request->validate([
            'title' => 'nullable|string|max:255', 
            'description' => 'nullable',         
        ]);       
        $survey = Survey::findOrFail($id); 
        $survey->title = $validatedData['title'];    
        $survey->description = $validatedData['description'];    
        $survey->save();  
        return redirect()->route('survey.show')->with('success', 'Survey updated successfully.');
    }

    public function delete(Request $request): JsonResponse
    {
        $survey = Survey::where('id', $request->id)->first();
        if (!empty($survey)) {          
            $survey->delete();
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
