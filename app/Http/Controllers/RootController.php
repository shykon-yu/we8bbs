<?php

namespace App\Http\Controllers;

use App\Models\Traits\ActiveUserCounter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Handlers\ImageUploadHandler;
use App\Models\User;
use Illuminate\Support\Arr;

class RootController extends Controller
{
    use ActiveUserCounter;
    public function index(ImageUploadHandler $uploader)
    {
        return view('pages.home');
    }

    public function permissionDenied()
    {
        if(config('administrator.permission')()){
            return redirect(url(config('administrator.uri')));
        }
        return view('pages.permission-denied');
    }


}
