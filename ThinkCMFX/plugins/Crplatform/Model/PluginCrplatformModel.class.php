<?php
// +----------------------------------------------------------------------
// | ThinkCMF [ WE CAN DO IT MORE SIMPLE ]
// +----------------------------------------------------------------------
// | Copyright (c) 2013-2014 http://www.thinkcmf.com All rights reserved.
// +----------------------------------------------------------------------
// | Author: Dean <zxxjjforever@163.com>
// +----------------------------------------------------------------------
namespace plugins\Crplatform\Model;//Demo插件英文名，改成你的插件英文就行了
use Common\Model\CommonModel;//继承CommonModel
class PluginCrplatformModel extends CommonModel{ //Demo插件英文名，改成你的插件英文就行了,插件数据表最好加个plugin前缀再加表名,这个类就是对应“表前缀+plugin_demo”表
	
	//自动验证
	protected $_validate = array(
			//array(验证字段,验证规则,错误提示,验证条件,附加规则,验证时间)
			//array('ad_name', 'require', '广告名称不能为空！', 1, 'regex', 3),
	);
	
	protected function _before_write(&$data) {
		parent::_before_write($data);
	}
	
	/**
	*	添加短信模板
	*/
	function add_sms($data_sms){

		$succ = $this->add($data_sms);
		if ($succ) {
			return ture;
		}else{
			return false;
		}
	}

	/* 删除短信模板 */
	function delete_sms($data_sms){
		$succ = $this->where($data_sms)->delete();
		if ($succ) {
			return ture;
		}else{
			return false;
		}

	}
}