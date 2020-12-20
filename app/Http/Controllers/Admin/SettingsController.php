<?php

namespace App\Http\Controllers\Admin;

use Inertia\Inertia;
use App\Models\Settings;
use App\Actions\UploadFile;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\SaveAboutRequest;
use App\Http\Resources\SettingsResource;
use App\Http\Requests\SaveContactRequest;

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
            'hero_image' => ['image', 'nullable'],
            'hero_title' => ['string', 'required'],
            'hero_description' => ['required', 'string'],
        ]);

        $data['hero_description'] = $request->get('hero_description');
        $data['hero_title'] = $request->get('hero_title');

        if ($request->file('hero_image')) {

            //delete previous image if any
            $this->settings->deleteImage('hero_image');

            $imageName = (new UploadFile)
                ->setFile($request->file('hero_image'))
                ->setUploadPath($this->settings->uploadFolder())
                ->execute();

            $data['hero_image'] = $imageName;
        }

        $this->save($data);
        return back();
    }

    public function saveAbout(SaveAboutRequest $request)
    {

        $data['about_description'] = $request->get('about_description');
        $data['about_title'] = $request->get('about_title');

        if ($request->file('about_image')) {

            //delete previous image if any
            $this->settings->deleteImage('about_image');

            $imageName = (new UploadFile)
                ->setFile($request->file('about_image'))
                ->setUploadPath($this->settings->uploadFolder())
                ->execute();

            $data['about_image'] = $imageName;
        }

        $this->save($data);
        return back();
    }

    public function saveContact(SaveContactRequest $request)
    {
        $data = $request->only(['address', 'phone', 'email', 'google_map_url']);

        if ($request->file('contact_image')) {

            //delete previous image if any
            $this->settings->deleteImage('contact_image');

            $imageName = (new UploadFile)
                ->setFile($request->file('contact_image'))
                ->setUploadPath($this->settings->uploadFolder())
                ->execute();

            $data['contact_image'] = $imageName;
        }

        $this->save($data);
        return back();
    }

    private function save(array $data): void
    {
        //so image will not change/lose if the description is updated

        $this->settings->data = array_merge($this->settings->data, $data);
        $this->settings->save();
    }
}