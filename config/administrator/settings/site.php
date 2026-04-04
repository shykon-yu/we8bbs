<?php
return [
    'title'=>'站点配置',
    'permission'=>function(){
        return Auth::user()->hasRole('Founder');
    },
    'edit_fields'=>[
        'site_name'=>[
            'title'=>'站点名称',
            'type'=>'textarea',
            'limit'=>100
        ],
        'contact_email'=>[
            'title'=>'站长邮箱',
            'type'=>'textarea',
            'limit'=>100
        ],
        'seo_description'=>[
            'title'=>'SEO-description',
            'type'=>'textarea',
            'limit'=>256
        ],
        'seo_keyword'=>[
            'title'=>'SEO-keyword',
            'type'=>'textarea',
            'limit'=>256
        ],
    ],
    'rules'=>[
        'site_name'=>'required|max:100',
        'contact_email'=>'email'
    ],
    'messages'=>[
        'site_name.required'=>'站点名称必填',
        'site_name.max'=>'站点名称不能超过100字',
        'contact_email.email'=>'邮箱格式不正确',
    ],
    'before_save'=>function(&$data){
        if(strpos($data['site_name'],'Powder by BbsChat') === false){
            $data['site_name'] .= '--Powder by BbsChat';
        }
    },
    'actions'=>[
        'clear_cache'=>[
            'title'=>'更新缓存',
            'messages'=>[
                'active'=>'正在清空缓存...',
                'success'=>'缓存已清空',
                'error'=>'缓存清空时出错'
            ],
            'action'=>function(&$data){
                Artisan::call('cache:clear');
                return true;
            }
        ]
    ]
];
