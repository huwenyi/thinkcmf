<?php
// +----------------------------------------------------------------------
// | Author: win
// +----------------------------------------------------------------------

namespace plugins\Crplatform;
use Common\Lib\Plugin;

class CrplatformPlugin extends Plugin{
	public $info = array(
        'name'=>'Crplatform',//Demo插件英文名，改成你的插件英文就行了
        'title'=>'创瑞短信',
        'description'=>'创瑞短信',
        'status'=>1,
        'author'=>'win',
        'version'=>'1.0'
    );
    
    public $has_admin=1;//插件是否有后台管理界面

    public function install(){//安装方法必须实现
        return true;//安装成功返回true，失败false
    }

    public function uninstall(){//卸载方法必须实现
        return true;//卸载成功返回true，失败false
    }
    
    //实现的send_cr_code钩子方法
    public function send_cr_code($param){
    	$config=$this->getConfig();
    	$this->assign($config);
    	$this->display('widget');
    }
}