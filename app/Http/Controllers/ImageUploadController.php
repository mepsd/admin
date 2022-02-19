<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\Response;
use Str;
class ImageUploadController extends Controller
{
    public function __invoke(Request $request)
    {
        $file = $request->file('image');
        $name = Str::random(10);
        $url = Storage::disk('public_uploads')->putFileAs('image', $file, $name.'.'.$file->extension());
        return response(['url' => config('app.url'). '/uploads/'.$url], Response::HTTP_CREATED);
    }
}
