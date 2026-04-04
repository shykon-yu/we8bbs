<?php
use Spatie\Permission\Models\Permission;
return [
    'title'=>'权限',
    'single'=>'权限',
    'model'=>Permission::class,
    'permission'=>function(){
        return Auth::user()->can('manage_users');
    },
    //对CRUD权限进行单独控制
    'action_permissions'=>[
        'create'=>function($model){
            return true;
        },
        'update'=>function($model){
            return true;
        },
        'delete'=>function($model){
            return false;
        },
        'view'=>function($model){
            return true;
        },
    ],
    'columns'=>[
        'id'=>[
            'title'=>'ID'
        ],
        'name'=>[
            'title'=>'角色名称'
        ],
        'operation'=>[
            'title'=>'管理',
            'sortable'=>false
        ]
    ],
    'edit_fields'=>[
        'name'=>[
            'title'=>'权限名称【请谨慎修改】',
            'hint'=>'修改权限名称存在潜在风险，请谨慎修改'
        ],
        'roles'=>[
            'type'=>'relationship',
            'title'=>'角色',
            'name_field'=>'name'
        ]
    ],
    'filters'=>[
        'name'=>[
            'title'=>'权限名称'
        ]
    ],

];
