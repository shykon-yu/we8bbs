<?php

namespace App\Http\Controllers;

use App\Handlers\ImageUploadHandler;
use App\Http\Requests\UserUpdateRequest;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Drivers\Gd\Driver;

class UsersController extends Controller
{
    public function show(User $user)
    {
        return view('users.show', compact('user'));
    }

    public function edit(User $user)
    {
        $this->authorize('edit', $user);
        return view('users.edit', compact('user'));
    }

    public function update(UserUpdateRequest $request, User $user , ImageUploadHandler $uploader)
    {
        //$user->update($request->all());
        $data = $request->validated();
        unset($data['email']);
        if( $request->avatar ){
            $res = $uploader->save($request->avatar,'avatars',$user->id);
            if( $res ){
                $data['avatar'] = $res['path'];
            }
        }
        $user->update($data);//只拿验证过的安全字段
        return redirect()->route('users.show', ['user' => $user])->with('success','修改成功');
    }
}
