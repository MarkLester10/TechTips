<?php

namespace App\Http\Controllers\Admin;

use Inertia\Inertia;
use App\Models\Settings;
use App\Actions\UploadFile;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\SettingsResource;

class SettingsController extends Controller
{
    private $settings;

    public function __construct()
    {
        $this->settings = Settings::find(1) ?? new Settings();
    }


    public function create(Request $request)
    {
        return Inertia::render('Settings/Create', [
            'settings' => new SettingsResource($this->settings),
        ]);
    }

    public function saveHero(Request $request)
    {
        $request->validate([
            'hero_img' => ['image', 'nullable'],
            'hero_title' => ['string', 'required'],
            'hero_description' => ['required', 'string'],
        ]);

        $data['hero_description'] = $request->get('hero_description');
        $data['hero_title'] = $request->get('hero_title');

        if ($request->file('hero_img')) {

            //delete previous image if any
            $this->settings->deleteImage();

            $imageName = (new UploadFile)
                ->setFile($request->file('hero_img'))
                ->setUploadPath($this->settings->uploadFolder())
                ->execute();

            $data['hero_img'] = $imageName;
        }

        //so image will not change/lose if the description is updated
        $mergedData = array_merge($this->settings->data, $data);

        $this->settings->data = $mergedData;
        $this->settings->save();

        return back();
    }
}