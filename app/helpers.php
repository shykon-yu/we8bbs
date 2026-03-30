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
