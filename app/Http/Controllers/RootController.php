<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Handlers\ImageUploadHandler;
use App\Models\User;

class RootController extends Controller
{
    public function index(ImageUploadHandler $uploader)
    {
        return view('pages.home');
    }
}
