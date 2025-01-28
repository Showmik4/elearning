<?php

namespace App\Http\Controllers;

use App\Models\HomePageSettings;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Traits\ImageTrait;
use App\Traits\FileTrait;
use Illuminate\Support\Facades\Session;

class HomePageSettingsController extends Controller
{
    use ImageTrait;
    use FileTrait;
    public function show()
    {
        return view('homepage_settings.index');
    }

    /***
     * @throws Exception
     **/
    public function list()
    {
        $settings = HomePageSettings::get();     
        $userPermissions = auth()->user()->userType->permissions->pluck('name')->toArray(); 
        return datatables()->of($settings)
            ->addColumn('permissions', function () use ($userPermissions) {
                return $userPermissions; 
            })  
            ->addColumn('banner_image', function (HomePageSettings $settings){
                if (isset($settings->banner_image)) {
                    return '<img height="50px" width="50px" src="'.url($settings->banner_image).'" alt="">';
                }
                return '';
            }) 
            ->addColumn('about_image', function (HomePageSettings $settings){
                if (isset($settings->about_image)) {
                    return '<img height="50px" width="50px" src="'.url($settings->about_image).'" alt="">';
                }
                return '';
            })   
               
            ->setRowAttr([
                'align' => 'center',
            ])            
            ->rawColumns(['banner_image','about_image'])     
            ->make(true);
    }

    public function edit($id)
    {      
        $home_setting = HomePageSettings::findOrFail($id); 
      
        return view('homepage_settings.edit', compact('home_setting'));
    }

    public function update(Request $request, $id): RedirectResponse
    {       
        $validated = $request->validate([
            'banner_image' => 'nullable', 
            'banner_short_text'=>'nullable',  
            'banner_large_text'=>'nullable', 
            'about_image'=>'nullable',
            'about_description'=>'nullable',
            'why_chose_us_description'=>'nullable',
            'feature_1'=>'nullable',
            'feature_2'=>'nullable',
            'feature_3'=>'nullable',  
             
        ]);
       
        $setting = HomePageSettings::findOrFail($id);       
        if (!empty($setting)) {
            $banner_image = $setting->banner_image;           
            if ($request->hasFile('banner_image')) {
                $this->deleteImage($setting->banner_image); 
                $banner_image = $this->save_image('settingImage', $request->file('banner_image')); 
            }

            $about_image = $setting->about_image;           
            if ($request->hasFile('about_image')) {
                $this->deleteImage($setting->about_image); 
                $about_image = $this->save_image('settingImage', $request->file('about_image')); 
            }
           
            $setting->update([
                'banner_short_text' => $validated['banner_short_text'], 
                'banner_large_text'=>$validated['banner_large_text'],     
                'banner_image'=>$banner_image, 
                'about_image'=>$about_image, 
                'about_description'=>$validated['about_description'], 
                'why_chose_us_description'=>$validated['why_chose_us_description'], 
                'feature_1'=>$validated['feature_1'], 
                'feature_2'=>$validated['feature_2'], 
                'feature_3' => $validated['feature_3'],                        
            ]);
            
            Session::flash('success', 'Setting Updated Successfully!');
        }
      
        return redirect()->route('homepage_settings.show');
    }
}
