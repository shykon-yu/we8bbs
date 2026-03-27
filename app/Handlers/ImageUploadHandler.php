<?php
namespace App\Handlers;
use Illuminate\Support\Facades\DB;
use Intervention\Image\Image;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver; // 这里必须完整引入
class ImageUploadHandler{
    protected $allowed_ext = ['png', 'jpg', 'jpeg', 'gif'];
    public function save($file,$folder,$model_id,$max_weidth = 800)
    {
        if( !in_array($file->getClientOriginalExtension(), $this->allowed_ext) ){
            return false;
        }
        //文件夹路径
        $folder_name = "uploads/images/$folder/".date('Ymd');
        //物理文件夹路径
        $upload_path = public_path().'/'.$folder_name;
        //后缀
        $extension = strtolower($file->getClientOriginalExtension())?:'png';

        //dd($extension);
        //文件名
        $filename = md5($model_id.time()).'.'.$extension;

        $file_path = $upload_path.'/'.$filename;


        if( $extension != 'gif' ){
            $this->reduceSize($file,$file_path,$max_weidth);
        }else{
            $file->move($upload_path,$filename);
        }

        $this->delOldImage($model_id);

        return [
            //'path' => config('app.url').'/'.$folder_name.'/'.$filename,
            'path' => $folder_name.'/'.$filename,
        ];
    }

    //缩放
    public function reduceSize($file,$file_path,$max_width)
    {
        $manager = new ImageManager(new Driver()); // 实例化
        $img = $manager->read($file->getPathname());
        // 等比例缩放，最大800px
        $img->scale(width: $max_width)->scaleDown();
        // 保存，质量80%
        $res = $img->save($file_path, 80);
    }
    public function delOldImage($user_id){
        $user = DB::table('users')->find($user_id);
        $path_url = public_path().'/'.$user->avatar;
        @unlink($path_url);
    }
}
