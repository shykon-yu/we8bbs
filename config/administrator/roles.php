<?php
use Spatie\Permission\Models\Role;
return [
    'title'=>'角色',
    'single'=>'角色',
    'model'=>Role::class,
    'permission'=>function(){
        return Auth::user()->can('manage_users');
    },
    'columns'=>[
        'id'=>[
            'title'=>'ID'
        ],
        'name'=>[
            'title'=>'角色名称'
        ],
        'permissions'=>[
            'title'=>'权限',
            'output'=>function($value,$model){
                $result = [];
                foreach ($model->permissions as $permission){
                    $result[] = $permission->name;
                }
                return empty($result) ? 'N/A' : implode(' , ',$result);

            },
            'sortable'=>false
        ],
        'operation'=>[
            'title'=>'管理',
            'sortable'=>false
        ]
    ],
    'edit_fields'=>[
        'name'=>[
            'title'=>'角色名称'
        ],
        'permissions'=>[
            'type'=>'relationship',
            'title'=>'权限',
            'name_field'=>'name'
        ]
    ],
    'filters'=>[
        'id'=>[
            'title'=>'ID',
        ],
        'name'=>[
            'title'=>'角色名称'
        ]
    ],
    'rules'=>[
        'name'=>'required|max:30|unique:roles,name'
    ],
    'messages'=>[
        'name.required'=>'角色名称必须填',
        'name.max'=>'角色名称不能超过30个字',
        'name.unique'=>'角色名称已存在'
    ]
];
