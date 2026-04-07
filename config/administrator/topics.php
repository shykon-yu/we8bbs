<?php
use App\Models\Topic;
return [
    'title' => '帖子',
    'single' => '帖子',
    'model' =>Topic::class,
    'columns' => [
        'id' => [
            'title' => 'ID'
        ],
        'title' => [
            'title' => '帖子标题',
            'sortable' => false,
            'output'=>function($value,$model){
                return '<div style="max-width:250px">'.model_link($value,$model).'</div>';
            }
        ],
        'user' => [
            'title' => '作者',
            'sortable' => false,
            'output'=>function($value,$model){
                $avatar = $model->user->avatar;
                $value = empty($avatar) ? 'N/A--'.$model->user->name : '<img src="'.$avatar.'" style="width:25px;height:25px;">'.$model->user->name;
                return model_link($value,$model);
            }
        ],
        'category' => [
            'title' => '帖子分类',
            'sortable' => false,
            'output'=>function($value,$model){
                return model_admin_link($model->category->name,$model->category);
            }
        ],
        'reply_count' => [
            'title' => '评论数',
            'sortable' => false,
        ],
        'operation' => [
            'title' => '管理',
            'sortable' => false
        ]
    ],
    'edit_fields' => [
        'title' => [
            'title' => '帖子标题'
        ],
        'content' => [
            'title' => '帖子内容',
            'type'=>'textarea'
        ],
        'user'=>[
            'title'=>'作者',
            'type'=>'relationship',
            'name_field'=>'name',
            'autocomplete'=>true,
            'search_field'=>["CONCAT(id,' ',name)"],
            'options_sort_field'=>'id'
        ],
        'category'=>[
            'title'=>'分类',
            'type'=>'relationship',
            'name_field'=>'name',
            'search_field'=>["CONCAT(id,' ',name)"],
            'options_sort_field'=>'id'
        ],
        'reply_count'=>[
            'title'=>'评论数量',
        ],
        'view_count'=>[
            'title'=>'浏览数量',
        ]
    ],
    'filters' => [
        'id' => [
            'title' => '帖子ID'
        ],
        'user'=>[
            'title'=>'作者',
            'type'=>'relationship',
            'name_field'=>'name',
            'autocomplete'=>true,
            'search_field'=>["CONCAT(id,' ',name)"],
            'options_sort_field'=>'id'
        ],
        'category'=>[
            'title'=>'分类',
            'type'=>'relationship',
            'name_field'=>'name',
            'search_field'=>["CONCAT(id,' ',name)"],
            'options_sort_field'=>'id'
        ],
    ],
    'rules' => [
        'title' => 'required|max:200',
        'content'=>'required|max:2000',
    ],
    'messages' => [
        'title.required'=>'帖子标题不能为空',
        'title.max'=>'帖子标题不能超过200个字',
        'content.required'=>'帖子内容不能为空',
        'content.max'=>'帖子内容不能超过2000个字',
    ]
];
