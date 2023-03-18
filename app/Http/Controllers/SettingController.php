<?php

namespace App\Http\Controllers;

use App\Models\aboatUs;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class SettingController extends Controller
{
    public function index()
    {
        $socials = Setting::where('type', 'social')->get();
        $aboatUs = aboatUs::first();
        if ($aboatUs !== null) {
            $info = aboatUs::where('id', $aboatUs->id)->first();
            return view('admin.manage.setting.index', compact('socials', 'info'));
        }
        return view('admin.manage.setting.index', compact('socials'));

    }

    public function storeSetting(Request $request)
    {
        if ($request->type == 'social') {
            return $this->storeSocial($request);
        }
    }

    public function storeInfo(Request $request)
    {
        $input = $request->all();
        $request->validate([
            'email'       => 'nullable',
            'phoneNumber' => 'nullable',
            'description' => 'nullable',
            'image'       => 'nullable',
        ]);
        $aboutUs = aboatUs::first();

        if ($aboutUs == null) {
            $info = aboatUs::create($input);
        } else {
            $info = aboatUs::findOrFail($aboutUs->id);
            $info->update($input);
        }

        $info = aboatUs::where('id', $info->id)->first();
        return response()->json([
            'status' => (bool)$info,
            'html'   => view('admin.manage.setting.ajax.table-info', compact('info'))->render()
        ]);
    }

    public function storeSocial($request)
    {
        $validator = $request->validate([
            'name'    => 'required',
            'address' => 'required',
        ]);

        $setting = Setting::create([
            'name'  => $request->name,
            'value' => $request->address,
            'type'  => $request->type,
        ]);
        $socials = Setting::where('type', $request->type)->get();
        return response()->json([

            'html' => view('admin.manage.setting.ajax.table-social', compact('socials'))->render()
        ]);
    }

    public function updateSocial(Request $request)
    {

        $validator = $request->validate([
            'name'    => 'required',
            'address' => 'required',
        ]);

        $setting = Setting::findOrFail($request->id);
        $setting->update([
            'name'  => $request->name,
            'value' => $request->address,
        ]);
        return response(['status' => (bool)$setting, 'message' => 'شبکه اجتماعی با موفقیت ویرایش شد']);
    }

    public function deleteSocial($id)
    {
        $status = Setting::destroy($id);
        return response(['status' => $status]);
    }
}
