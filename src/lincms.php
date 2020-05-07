<?php
/** Created by 嗝嗝<china_wangyu@aliyun.com>. Date: 2019-12-12  */

return [
    'jwt' => [
        'key' => 'lin-cms-tp6', // 授权 key
        'type' => 'Bearer', // 授权类型
        'request' => 'header', // 请求方式
        'param' => 'authorization', // 授权名称
        'access_exp' => 7200, //access_token 过期时间：2小时
        'refresh_exp' => 84000 * 30, //refresh_token 过期时间：30天
        'payload' => [
            'iss' => 'PAA-ThinkPHP6', //签发者
            'iat' => '', //什么时候签发的
            'exp' => '' , // 过期时间
            'uniqueId' => '',
            'signature' => ''
        ]
    ],
    "management"=> [ # 接口管理平台
        'enable' => true, # 开关控制，true：开启｜false：关闭
        'member' => [
            'admin' => [
                'password' => 'supper',
                'admin' => true, # true：超级管理员｜false：浏览者
            ],
            'web' => [
                'password' => '123456',
                'admin' => false, # true：超级管理员｜false：浏览者
            ]
        ],
    ],
    'file' => [
        'validate' => [
            'image' => [
                'file',
                'fileSize'=>1024*1024*2,
                'fileExt'=>['jpg','jpeg','png','gif'],
            ],
            'video' => [
                'file',
                'fileSize'=>1024*1024*20,
                'fileExt'=>['mp4'],
            ],
        ],
        'store_dir' => 'storage',
        'nums' => 10
    ]
];
