<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use App\Traits\ImageTrait;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class SettingController extends Controller
{
    use ImageTrait;

    public function show()
    {
        $setting = Setting::query()->first();
        return view('setting.index', compact('setting'));
    }

    /**
     * @throws Exception
     */
    public function list()
    {
        $setting = Setting::all();
        return datatables()->of($setting)
            ->addColumn('logo', function (Setting $setting) {
                if (isset($setting->logo)) {
                    return '<img height="50px" width="50px" src="' . url($setting->logo) . '" alt="">';
                }
                return '';
            })
            ->addColumn('logoDark', function (Setting $setting) {
                if (isset($setting->logoDark)) {
                    return '<img height="50px" width="50px" src="' . url($setting->logoDark) . '" alt="">';
                }
                return '';
            })
            ->setRowAttr([
                'align' => 'center',
            ])
            ->rawColumns(['logo', 'logoDark'])
            ->make(true);
    }


    public function edit($settingId)
    {
        $setting = Setting::query()->where('settingId', $settingId)->first();
        return view('setting.edit', compact('setting'));
    }

    public function update(Request $request, $settingId): RedirectResponse
    {              
        $validated = $this->validate($request, [
            'companyName' => 'required|string|max:255',
            'email' => 'required|email|max:50',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg',
            'logoDark' => 'nullable|image|mimes:jpeg,png,jpg',
            'address' => 'nullable',
            'phone' => 'nullable',  
            'twitter_link' => 'nullable',
            'facebook_link' => 'nullable',
            'instagram_link' => 'nullable',
            'linkedin_link' => 'nullable',
            'footer_text' => 'nullable',
            'google_map_link' => 'nullable',
            'contact_page_banner_text'=>'nullable',
            'trainer_page_banner_text'=>'nullable',
            'course_page_banner_text'=>'nullable',            
        ]);

        $setting = Setting::query()->first();
        if (!empty($setting)) {
            if (empty($validated['logo'])) {
                $logo = $setting->logo;
            } else {
                $this->deleteImage($setting->logo);
                $logo = $this->save_image('settingImage', $validated['logo']);
            }

            if (empty($validated['logoDark'])) {
                $logoDark = $setting->logoDark;
            } else {
                $this->deleteImage($setting->logoDark);
                $logoDark = $this->save_image('settingImage', $validated['logoDark']);
            }


            $setting->update([
                'companyName' => $validated['companyName'],
                'email' => $validated['email'],
                'logo' => $logo,
                'logoDark' => $logoDark,
                'address' => $validated['address'],
                'phone' => $validated['phone'],
                'twitter_link' => $validated['twitter_link'],
                'facebook_link' => $validated['facebook_link'],
                'instagram_link' => $validated['instagram_link'],
                'linkedin_link' => $validated['linkedin_link'],
                'footer_text' => $validated['footer_text'],
                'google_map_link' => $validated['google_map_link'],
                'contact_page_banner_text' => $validated['contact_page_banner_text'],
                'trainer_page_banner_text' => $validated['trainer_page_banner_text'],
                'course_page_banner_text' => $validated['course_page_banner_text'],
            ]);
        }

        Session::flash('success', 'Setting Updated Successfully!');
        return redirect()->route('setting.show');
    }
  
}
