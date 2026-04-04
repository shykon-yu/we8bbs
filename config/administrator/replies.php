<?php
use App\Models\Reply;

return [
    'title'=>'评论',
    'single'=>'评论',
    'model'=>Reply::class,
    'columns'=>[
        'id'=>[
            'title'=>'评论ID'
        ],
        'content'=>[
            'title'=>'评论内容',
            'output'=>function($reply,$model){
                return '<div style="max-width: 250px;">'.$reply.'</div>';
            },
            'sortable'=>false

        ],
        'user'=>[
            'title'=>'作者',
            'output'=>function($value,$model){
                $avatar = $model->user->avatar;
                $value = empty($avatar) ? 'N/A' : '<img src="'.$avatar.'" style="height:25px;width:25px;">'.$model->user->name;
                return model_link($value,$model->user);
            },
            'sortable'=>false
        ],
        'topic'=>[
            'title'=>'所属帖子',
            'output'=>function($value,$model){
                return '<div style="max-width: 250px;">'.model_admin_link(e($model->topic->title),$model->topic).'</div>';
            },
            'sortable'=>false
        ],
        'operation'=>[
            'title'=>'管理',
            'sortable'=>false
        ]
    ],
    'edit_fields'=>[
        'content'=>[
            'title'=>'评论内容',
            'type'=>'textarea'
        ],
        'user'=>[
            'title'=>'作者',
            'type'=>'relationship',
            'name_field'=>'name',
            'autocomplete'=>true,
            'search_field' => ["CONCAT(id,' ',name)"],
            'options_sort_field'=>'id'
        ],
        'topic'=>[
            'title'=>'帖子',
            'type'=>'relationship',
            'name_field'=>'title',
            'autocomplete'=>true,
            // 自动补全的搜索字段
            'search_field' => ["CONCAT(id,' ',title)"],
            // 自动补全排序
            'options_sort_field'=>'id'
        ],
    ],
    'filters'=>[
        'content'=>[
            'title'=>'评论内容',
        ],
        'user'=>[
            'title'=>'作者',
            'type'=>'relationship',
            'name_field'=>'name',
            'autocomplete'=>true,
            'search_field' => ["CONCAT(id,' ',name)"],
            'options_sort_field'=>'id'
        ],
        'topic'=>[
            'title'=>'帖子',
            'type'=>'relationship',
            'name_field'=>'title',
            'autocomplete'=>true,
            // 自动补全的搜索字段
            'search_field' => ["CONCAT(id,' ',title)"],
            // 自动补全排序
            'options_sort_field'=>'id'
        ],
    ],
    'rules'=>[
        'content'=>'required|max:2000'
    ],
    'messages'=>[
        'content.required'=>'评论内容必填',
        'content.max'=>'评论内容不能超过2000字',
    ]
];
