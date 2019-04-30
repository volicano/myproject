<?php 


class LoginAction extends Action{
	
	
	
	function index(){		
		//配置页面显示内容
		header("Content-Type:text/html; charset=utf-8");
		if($_POST){
			$name = $_POST['name'];
			$pwd = md5($_POST['pwd']);
			$user=M('Admin');				
			if($user->where("username ='$name' AND pwd = '$pwd'")->find()){
				$_SESSION['admin']=$name;				
				echo "<script>alert('管理员成功！');location.href='../Index/index';</script>";
								
			}else{
				$this->error('用户名或密码错误');
			}
		}	
		$this->assign('title','后台管理系统登录页');
		$this->display();
	}
	
	function logout(){
		$_SESSION['admin']="";
		echo "<script>alert('管理员退出成功！');location.href='../Login/index';</script>";
	}
	
	function add(){	
		header("Content-Type:text/html; charset=utf-8");
		if($_POST){
			$name = $_POST['name'];
			$pwd = $_POST['pwd'];
			$repwd = $_POST['repwd'];
			
			if($name==""){				
				echo "<script>alert('名称不能为空');history.go(-1);</script>";
				exit;
			}
			if($pwd==""){				
				echo "<script>alert('密码不能为空');history.go(-1);</script>";
				exit;
			}
			if($repwd==""){				
				echo "<script>alert('重复密码不能为空');history.go(-1);</script>";
				exit;
			}
			if($repwd!=$pwd){				
				echo "<script>alert('两次密码不一致');history.go(-1);</script>";
				exit;
			}
			$user=M('Admin');
			$data['username']  =   $name;
			$data['pwd']       =  md5($pwd);			
			$data['addtime']    =   time();
			$data['isable']     =   1;			
			$result =   $user->add($data);
	           if($result) {
	               echo "<script>alert('管理员添加成功！');location.href='../Login/admin';</script>";
	            }else{
	                $this->error('写入错误！');
	            }
			
			
		}
		
		
		
		$this->assign('title','后台管理系统登录页');
		$this->assign('action','add');
		$this->display();
		
	}
	
	function admin(){
		header("Content-Type:text/html; charset=utf-8");
		
		$news=M('Admin');	
    	$count=$news->count();
    	//分页显示文章列表，每页8篇文章
		import('ORG.Util.Page');
		$page=new Page($count,20);//后台管理页面默认一页显示8条文章记录
		
		
        $page->setConfig('prev', "&laquo; Previous");//上一页
        $page->setConfig('next', 'Next &raquo;');//下一页
        $page->setConfig('first', '&laquo; First');//第一页
        $page->setConfig('last', 'Last &raquo;');//最后一页	
		$page->setConfig('theme',' %first% %upPage%  %linkPage%  %downPage% %end%');
        //设置分页回调方法
		$show=$page->show();
		$news_list=$news->field(array('id','username','pwd','addtime'))->order('id desc')->limit($page->firstRow.','.$page->listRows)->select();
    //	$this->filter(&$news_list);
    	
		
		
		
    	$this->assign('news_list',$news_list);
    	$this->assign('page_method',$show);
    	
    	$this->assign('cat_count',$count);
    	
		$this->assign('title','后台管理系统登录页');
		$this->display();
		
	}
	
	//用户登录页面
	function login(){
		 header("Content-Type:text/html; charset=utf-8");
		//首先检查验证码是否正确(验证码存在Session中)
		if(	$_SESSION['verify']	!=	md5($_POST['verify'])	){
			$this->error('验证码不正确');
		}
		
		$user=M('Admin');//参数的User必须首字母大写，否则自动验证功能失效！
		$username=$_POST['username'];
		$password=md5($_POST['password']);
		
		if(!$this->checklen($username)){
			$this->error('用户名长度必须在5~15个字符之间');
		}		
		//查找输入的用户名是否存在
		if($user->where("username ='$username' AND pwd = '$password'")->find()){		
			session(adminuser,$username);
			$url=U('/Index/index');
			redirect($url,0, '跳转中...');
		}else{
			$this->error('用户名或密码错误');
		}
		
	}
	
	function checklen($data){
			if(strlen($data)>15 || strlen($data)<4){
			return false;
		}
		return true;
	}
}



?>