<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CategoryController extends Controller
{
    public function show()
    {
        return view('category.index');
    }

    /***
     * @throws Exception
     **/
    public function list()
    {
        $category = Category::all();     
        $userPermissions = auth()->user()->userType->permissions->pluck('name')->toArray(); 
        return datatables()->of($category)
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
        return view('category.create');
    }

    public function store(Request $request): RedirectResponse
    {       
        $validated = $this->validate($request, [
            'name' => 'required|string|max:255', 
                 
        ]);

        $category = Category::create([
            'name' => $validated['name'],          
        ]);         
           
        Session::flash('success', 'Category Created Successfully!');
        return redirect()->route('category.show');
    }

    public function edit($id)
    {      
        $category = Category::findOrFail($id);  
        
        return view('category.edit', compact('category'));
    }

    public function update(Request $request, $id): RedirectResponse
    {       
        $validated = $request->validate([
            'name' => 'required|string|max:255', 
         
        ]);
       
        $category = Category::findOrFail($id);       
        if (!empty($category)) {           
           
            $category->update([
                'name' => $validated['name'],                    
            ]);
            
            Session::flash('success', 'Category Updated Successfully!');
        }
      
        return redirect()->route('category.show');
    }

    public function delete(Request $request): JsonResponse
    {
        $category = Category::where('id', $request->id)->first();
        if (!empty($category)) {          
            $category->delete();
        }
        return response()->json();
    }
}
