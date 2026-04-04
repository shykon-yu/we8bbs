<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Link;
use App\Models\User;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{
    public function show(Category $category,Request $request,User $user,Link $link)
    {
        $links = $link->getAllCached();
        $active_users = $user->getActiveUsers();
        $topics = $category->topics()->with('user','category')->withOrder($request->order)->paginate(10);
        return view('topics.index',compact('topics','category','active_users','links'));
    }
}
