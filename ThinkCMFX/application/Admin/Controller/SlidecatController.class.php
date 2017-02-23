<?php
namespace Admin\Controller;
use Common\Controller\AdminbaseController;

class SlidecatController extends AdminbaseController{
	
	protected $slidecat_model;
	
	public function _initialize() {
		parent::_initialize();
		$this->slidecat_model = D("Common/SlideCat");
	}
	
	// 幻灯片分类列表
	public function index(){
		$cats=$this->slidecat_model->where("cat_status!=0")->select();
		$this->assign("slidecats",$cats);
		$this->display();
	}
	
	// 幻灯片分类添加
    public function add() {
        $this->display();
    }
	
    // 幻灯片分类添加提交
    public function add_post() {
    	if (IS_POST) {
    		if ($this->slidecat_model->create()!==false) {
    			if ($this->slidecat_model->add()!==false) {
    				$this->success("添加成功！", U("slidecat/index"));
    			} else {
    				$this->error("添加失败！");
    			}
    		} else {
    			$this->error($this->slidecat_model->getError());
    		}
    	}
    }
    
    // 幻灯片分类编辑
	public function edit(){
		$id= I("get.id",0,'intval');
		$slidecat=$this->slidecat_model->where(array('cid'=>$id))->find();
		$this->assign($slidecat);
		$this->display();
	}
	
	// 幻灯片分类编辑提交
	public function edit_post(){
		if (IS_POST) {
			if ($this->slidecat_model->create()!==false) {
				if ($this->slidecat_model->save()!==false) {
					$this->success("保存成功！", U("slidecat/index"));
				} else {
					$this->error("保存失败！");
				}
			} else {
				$this->error($this->slidecat_model->getError());
			}
		}
	}
	
	// 幻灯片分类删除
	public function delete(){

		$id = I("get.id",0,'intval');
		if ($this->slidecat_model->delete($id)!==false) {
			$slide_obj=M("Slide");
			$slide_obj->where(array('slide_cid'=>$id))->save(array("slide_cid"=>0));
			$this->success("删除成功！");
		} else {
			$this->error("删除失败！");
		}
		
	}
	
	// 设置首页幻灯片分类标识-win
    public function setcatid() {

    	$check_slide = M('otherset')->where(array('cat_type'=>'home_slide'))->getfield('type_value');//获取当前选择的幻灯片id
    	$this->check_slide = $check_slide;
    	

    	$cats=$this->slidecat_model->where("cat_status!=0")->select();//所有幻灯片分类
    	foreach ($cats as $c_key => $c_value) {
    		$cat_idnamelist[$c_key]['cat_idname'] = $c_value['cat_idname'];//获取分类标识
    	}
    	$this->assign("cat_idnamelist",$cat_idnamelist);
        $this->display();
    }

    //设置首页幻灯片分类标识-win
    public function edit_otherset(){
    	
    	$type_value = $_POST['cat_idname'];
    	$modify = M('otherset')->where(array('cat_type'=>'home_slide'))->save(array('type_value'=>$type_value));
    	if ($modify) {
    		$this->success('编辑成功');
    	}else{
    		$this->error('编辑失败');
    	}
}
	
}