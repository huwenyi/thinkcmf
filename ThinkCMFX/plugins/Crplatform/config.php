<?php
// +----------------------------------------------------------------------
// | Author: win
// +----------------------------------------------------------------------
return array (
	'account_name' => array (// 在后台插件配置表单中的键名 ,会是config[text]
		'title' => '短信账号', // 表单的label标题
		'type' => 'text',// 表单的类型：text,password,textarea,checkbox,radio,select等
		'value' => '',// 表单的默认值
		'tip' => '创瑞短信平台的账号' //表单的帮助提示
	),
    'password' => array (// 在后台插件配置表单中的键名 ,会是config[text]
        'title' => '短信密码', // 表单的label标题
        'type' => 'password',// 表单的类型：text,password,textarea,checkbox,radio,select等
        'value' => '',// 表单的默认值
        'tip' => '短信对接密码' //表单的帮助提示
    ),
    
);
					