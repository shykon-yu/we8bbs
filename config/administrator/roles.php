<?php
//use Spatie\Permission\Models\Role;
//return [
//    'title'=>'角色',
//    'single'=>'角色',
//    'model'=>Role::class,
//    'permission'=>function(){
//        return Auth::user()->can('manage_users');
//    },
//    'columns'=>[
//        'id'=>[
//            'title'=>'ID',
//        ],
//        'name'=>[
//            'title'=>'角色名称',
//            'sortable'=>false,
//            'output'=>function($value,$model){
//                $result = [];
//                foreach ($model->permissions as $permission){
//                    $result[] = $permission->name;
//                }
//                return empty($result) ? 'N/A' : implode(', ',$result);
//            }
//        ],
//
//        'operation'=>[
//            'title'=>'管理',
//            'sortable'=>false
//        ]
//    ],
//    'edit_fields'=>[
//        'name'=>[
//            'title'=>'角色名称'
//        ],
//        'permissions'=>[
//            'title' =>'用户角色',
//            'type' =>'relationship',
//            'name_field' =>'name'
//        ],
//    ],
//    'filters'=>[
//        'id'=>[
//            'title'=>'用户ID'
//        ],
//        'name'=>[
//            'title'=>'用户名'
//        ],
//        'email'=>[
//            'title'=>'用户邮箱'
//        ]
//    ]
//];
