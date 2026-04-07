<?php

namespace App\Http\Controllers;

use App\Handlers\ImageUploadHandler;
use App\Handlers\TranslateTopicTitleHandler;
use App\Http\Requests\StoreTopicRequest;
use App\Http\Requests\UpdateTopicRequest;
use App\Models\Category;
use App\Models\Link;
use App\Models\Topic;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TopicController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except(['index', 'show']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request,User $user,Link $link)
    {
        $active_users = $user->getActiveUsers();
        $topics = Topic::with('user','category')->withOrder($request->order)->paginate(10);
        $links = $link->getAllCached();
        return view('topics.index', compact('topics','active_users','links'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        return view('topics.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreTopicRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTopicRequest $request , Topic $topic)
    {
        $topic->fill($request->all());
        $topic->user_id = $request->user()->id;
        $topic->save();
        return redirect()->to($topic->link())->with('succses', '帖子创建成功');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Topic  $topic
     * @return \Illuminate\Http\Response
     */
    public function show(Topic $topic,Request $request)
    {
        if( !empty($request->slug) && $request->slug != $topic->slug ){
            return redirect($topic->link(),301);
        }
        //dd($topic->user());
        return view('topics.show', compact('topic'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Topic  $topic
     * @return \Illuminate\Http\Response
     */
    public function edit(Topic $topic)
    {
        $this->authorize('update', $topic);
        $categories  = Category::all();
        return view('topics.edit', compact('topic', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateTopicRequest  $request
     * @param  \App\Models\Topic  $topic
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTopicRequest $request, Topic $topic)
    {
        $this->authorize('update', $topic);
        $topic->update($request->validated());
        return  redirect()->route('topics.show',$topic->id)->with('success','修改成功');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Topic  $topic
     * @return \Illuminate\Http\Response
     */
    public function destroy(Topic $topic)
    {
        $this->authorize('delete', $topic);
        $topic->delete();
        return redirect()->route('topics.index')->with('success','帖子删除成功');
    }

    public function uploadImage(Request $request,ImageUploadHandler $uploader)
    {
        $data = [
            'success'   => false,
            'msg'=>'图片上传失败',
            'file_path'=>'',
        ];
        if( $file = $request->upload_file ){
            $result = $uploader->save( $file, 'topics', Auth::id(), 800,800);
            if( $result ){
                $data['success'] = true;
                $data['msg'] = '上传成功';
                $data['file_path'] = asset($result['path']);
            }
        }
        return $data;
    }
}
