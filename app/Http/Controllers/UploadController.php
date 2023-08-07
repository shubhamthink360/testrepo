<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;


class UploadController extends Controller
{
    public function index()
    {
        return view('backend.package.index');
    }

    public function store(Request $request)
    {
        $rules = [
            'startingPriceCheckbox' => 'nullable|boolean',
            'dayNightCheckbox' => 'nullable|boolean',
        ];

        if ($request->input('startingPriceCheckbox')) {
            $rules['startingPrice'] = 'required|numeric|min:0';
        }
        dd('stop');
        if ($request->input('dayNightCheckbox')) {
            $rules['addDay'] = 'required|numeric|min:0';
            $rules['addNight'] = 'required|numeric|min:0';
        }

        $request->validate($rules);


        $image_parts = explode(";base64,", $request->image);
        $image_type_aux = explode("image/", $image_parts[0]);
        $image_type = $image_type_aux[1];
        $image_base64 = base64_decode($image_parts[1]);
        $file_name = uniqid() . time() . '.png';

        // Save the image to the 'public' disk
        Storage::disk('public')->put($file_name, $image_base64);

        // Get the public URL for the saved image
        $image_url = Storage::disk('public')->url($file_name);

        return response()->json(['success' => 'success', 'image_url' => $image_url]);
    }
}
