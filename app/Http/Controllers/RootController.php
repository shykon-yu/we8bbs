<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Handlers\ImageUploadHandler;

class RootController extends Controller
{
    public function index(ImageUploadHandler $uploader)
    {
        return view('pages.home');
    }
}
