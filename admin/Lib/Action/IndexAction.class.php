<?php
// 本类由系统自动生成，仅供测试用途
class IndexAction extends Action {
	
	
	
	
	
    public function index(){
        if($_SESSION['admin']!=""){
            $this->assign('username',$_SESSION['admin']);
        }else{
            $this->error('您好，请先登录！！！',U('/Login/index/'));
        }
        $this->display();
    }
    
    
    
	public function header()
	{
		if($_SESSION['admin']!=""){
			$this->assign('username',$_SESSION['admin']);
		}else{
			$this->error('您好，请先登录！！！',U('/Login/index/'));
		}
		$this->display();
	}
	
	public function menu()
	{	
		//if(session('?adminuser'))	
		//$this->load->view('admin/menu');	
		if($_SESSION['admin']!=""){
			$this->assign('username',$_SESSION['admin']);
		}else{
			$this->error('您好，请先登录！！！',U('/Login/index/'));
		}
		$this->display();	
	}	
	
	public function main()
	{	
		//if(session('?adminuser'))	
		//$this->load->view('admin/menu');	
		if($_SESSION['admin']!=""){
			$this->assign('username',$_SESSION['admin']);
		}else{
			$this->error('您好，请先登录！！！',U('/Login/index/'));
		}
		$this->display();	
	}	
}