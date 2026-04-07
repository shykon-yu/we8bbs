<?php
if(!function_exists('category_navbar_active')){
    function category_navbar_active($category_id){
        return active_class(if_route('categories.show') && if_route_param('category',$category_id));
    }
}

if(!function_exists('mack_desc')){
    function mack_desc($value,$len = 200){
        $desc = trim(preg_replace('/\r\n|\r|\n+/',' ',strip_tags($value)));
        return str()->limit($desc,$len);
    }
}
if(!function_exists('model_plural_name')){
    function model_plural_name($model){
        $full_class_name = get_class($model);
        $class_name = class_basename($full_class_name);
        $snake_class_name = str()->snake($class_name);
        return str()->plural($snake_class_name);
    }
}
if (!function_exists('model_link')) {
    function model_link($title, $model, $prefix = '') {
        $model_name = model_plural_name($model);
        $prefix = $prefix ? "/$prefix/" : '/';
        $url = config('app.url').$prefix.'/'.$model->id;
        //拼接html
        return '<a href="'.$url.'" target="_blank">'.$title.'</a>';
    }
}
if(!function_exists('model_admin_link')){
    function model_admin_link($title,$model){
        return model_link($title,$model,'admin');
    }
}
