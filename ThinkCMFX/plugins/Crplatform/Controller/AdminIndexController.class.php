<?php
// +----------------------------------------------------------------------
// | ThinkCMF [ WE CAN DO IT MORE SIMPLE ]
// +----------------------------------------------------------------------
// | Copyright (c) 2013-2014 http://www.thinkcmf.com All rights reserved.
// +----------------------------------------------------------------------
// | Author: Dean <zxxjjforever@163.com>
// +----------------------------------------------------------------------
namespace plugins\Crplatform\Controller; //Demo插件英文名，改成你的插件英文就行了
use Api\Controller\PluginController;//插件控制器基类

class AdminIndexController extends PluginController{
	
	function _initialize(){
		$adminid=sp_get_current_admin_id();//获取后台管理员id，可判断是否登录
		if(!empty($adminid)){
			$this->assign("adminid",$adminid);
		}else{
			//TODO no login
		}
	}
	
	function index(){
		//$plugin_demo_model=D("plugins://Demo/PluginDemo");//实例化自定义模型PluginDemo ,需要创建plugin_demo表
		//$plugin_demo_model->test();//调用自定义模型PluginDemo里的test方法
		
		$plugin_crplatform_model = D("plugins://Crplatform/PluginCrplatform");
		$smslist = $plugin_crplatform_model->select();
		$this->assign("smslist",$smslist);

		/* 获取插件配置信息 */
		// $aaa = M('plugins')->where(array('name'=>'Crplatform'))->getfield('config');
		// echo "<pre>";
		// print_r($aaa);die();
		$this->display(":admin_index");
	}

	/* 添加短信模板内容 */
	function add_crplatform(){
		$sms_cat = I('post.sms_cat');
		$sms_content = I('post.sms_content');

		$plugin_crplatform_model = D("plugins://Crplatform/PluginCrplatform");

		if (empty($sms_cat) || empty($sms_content)) {
			$this->error('类型或内容为空，请重新填写');
		}else{
			$find_sms = $plugin_crplatform_model->where(array('sms_cat'=>$sms_cat))->find();
			if ($find_sms) {
				$this->error('该类型模板已存在，无法继续添加');
			}else{
				$data_sms['sms_cat'] = $sms_cat;
				$data_sms['sms_content'] = $sms_content;
				$data_sms['add_time'] = date('Y-m-d H:i:s');
				if($plugin_crplatform_model->add_sms($data_sms)){
					$this->success('短信模板添加成功');
				}else{
					$this->error('短信模板添加失败');
				}
			}
		}
	}

	/* 删除短信模板 */
	function delete_crplatform(){
		$delete_id = I('get.id');
		$delete_info['id'] = $delete_id;

		$plugin_crplatform_model = D("plugins://Crplatform/PluginCrplatform");

		if ($plugin_crplatform_model->delete_sms($delete_info)) {
			$this->success('删除成功');
		}else{
			$this->error('删除失败');
		}
	}

}
