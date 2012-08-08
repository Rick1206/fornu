<?php
// 本类由系统自动生成，仅供测试用途
class IndexAction extends Action {
	public function _before_index(){
		//echo "test";
	}
	public function _after_index(){
		//echo "test";
	}
    public function index(){
        header("Content-Type:text/html; charset=utf-8");
       
		$this->display();
    }
	public function login(){
		$user = new UserAction();
		
	}
}