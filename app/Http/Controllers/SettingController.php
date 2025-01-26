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
            'address' => 'required|string',
            'phone' => 'required|string|max:30',          
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
            ]);
        }

        Session::flash('success', 'Setting Updated Successfully!');
        return redirect()->route('setting.show');
    }
  
}
