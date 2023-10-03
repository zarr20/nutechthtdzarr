<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Response;

class FileController extends Controller
{


    public function show($filename)
    {
        $path = storage_path('app/public/' . $filename);

        if (!Storage::exists('public/' . $filename)) {
            abort(404);
        }

        return response()->file($path);
    }
}
