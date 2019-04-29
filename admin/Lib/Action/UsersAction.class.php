<?php
// 本类由系统自动生成，仅供测试用途
class UsersAction extends Action {
	
	
	public function admin(){ 	
		header("Content-Type:text/html; charset=utf-8");
		if(session('?adminuser')){
			$this->assign('username',session('adminuser'));
      	}  
      	$news=M('Admin');
      	$count=$news->count();
      	$article_item=$news->where("1=1")->select();		
		$this->assign('admins',$article_item);
		$this->assign('count',$count);	
			
		$this->assign('title','用户信息管理');
    	$this->display();
	}
	public function adds(){ 
		header("Content-Type:text/html; charset=utf-8");
		if(IS_POST){
			
			$uname = trim($_POST['name']);
			$pwd   = trim($_POST['pwd']);
			$repwd = trim($_POST['repwd']);			
			if(empty($uname)){
				 $this->error('帐户不能为空！');
			}
			if(empty($pwd)){
				 $this->error('密码不能为空！');
			}
			if($pwd!=$repwd){
				 $this->error('两次密码不能一样！');
			}
			$admin = M("Admin"); // 实例化User对象
			$admin->create(); // 创建数据对象	
	 		$admin->username	=$uname;
			$admin->pwd			=md5($pwd);
			$admin->addtime		=time();
			$result=$admin->add();
			if($result){
				$this->success('新管理帐户添加成功！',U('Users/admin'));
			}else{
				$this->error('添加出错！');
			}		
		}
	}
	public function index(){ 	
      	header("Content-Type:text/html; charset=utf-8");
    	if(session('?adminuser')){
			$this->assign('username',session('adminuser'));
      	}      	
    	$news=M('Users');	
    	$count=$news->count();
    	//分页显示文章列表，每页8篇文章
		import('ORG.Util.Page');
		$page=new Page($count,20);//后台管理页面默认一页显示8条文章记录
		
		
        $page->setConfig('prev', "&laquo; 上一页");//上一页
        $page->setConfig('next', '下一页 &raquo;');//下一页
        $page->setConfig('first', '&laquo; 第一页');//第一页
        $page->setConfig('last', '最后页 &raquo;');//最后一页	
		$page->setConfig('theme',' %first% %upPage%  %linkPage%  %downPage% %end%');
        //设置分页回调方法
		$show=$page->show();
		$news_list=$news->field(array('User_Id','User_UserName','User_Email','User_Addtime','User_Grade'))->order('User_Id desc')->limit($page->firstRow.','.$page->listRows)->select();
    //	$this->filter(&$news_list);
    			
		
    	$this->assign('news_list',$news_list);
    	$this->assign('page_method',$show);
    	
    	$this->assign('cat_count',$count);
    	$this->assign('title','用户信息管理');
    	$this->display();
    }
    
	
    
    
 	public function insert(){ 			
 	 	import('ORG.Net.UploadFile');
	    $upload = new UploadFile();// 实例化上传类
	    $upload->maxSize  = 4145728 ;// 设置附件上传大小
	    $upload->allowExts  = array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
	    $upload->savePath =  './public/Uploads/pic/';// 设置附件上传目录
	    //设置上传文件规则
		$upload->saveRule = 'uniqid';
	    if(!$upload->upload()) {// 上传错误提示错误信息
	        $this->error($upload->getErrorMsg());
	    }else{// 上传成功
	      	$info =  $upload->getUploadFileInfo();
	    }	    
	    // 保存表单数据 包括附件数据
	    $Comm_Name		=strval(trim($_POST['Comm_Name']));
		$Cat_Id			=intval(trim($_POST['Cat_Id']));
		$Comm_SellPrice	=doubleval(trim($_POST['Comm_SellPrice']));
		$Comm_MarketPrice	=doubleval(trim($_POST['Comm_MarketPrice']));
		$Comm_Reserves	=intval(trim($_POST['Comm_Reserves']));
		$Comm_IsHot	=intval(trim($_POST['Comm_IsHot']));
		$Comm_IsTj	=intval(trim($_POST['Comm_IsTj']));
		$Comm_Sort = intval(trim($_POST['Sort']));
		$Comm_Describe = strval(trim($_POST['editorValue']));
		$pro = M("Product"); // 实例化User对象
		$pro->create(); // 创建数据对象	
 		$pro->Comm_Name		=$Comm_Name;
		$pro->Cat_Id			=$Cat_Id;
		$pro->Comm_MarketPrice	=$Comm_MarketPrice;
		$pro->Comm_Reserves		=$Comm_Reserves;
		$pro->Comm_SellPrice	=$Comm_SellPrice;
		$pro->Comm_IsHot		=$Comm_IsHot;
		$pro->Comm_IsTj		=   $Comm_IsTj;
		$pro->comm_SjTime   =   time();		
		$pro->Comm_Describe = $Comm_Describe;	
		$pro->Admin_Id = session('username')? session('username'):1;	
		$pro->Comm_Sort = $Comm_Sort;
		if(count($info[0])>0){
			$pro->Comm_Pic=substr($info[0]['savepath'],1).$info[0]['savename'];
		}	
		$result=$pro->add();
		if($result){
			$this->success('添加商品成功！',U('Product/index'));
		}else{
			$this->error('添加出错！');
		}			
    }
	//修改i
	function add(){
		header("Content-Type:text/html; charset=utf-8");
		if($_POST){
		
			if(empty($_POST['User_UserName'])){
			  $this->error('用户昵称不能为空！');
			} 
			$data = array(
					  'User_UserName'=>$_POST['User_UserName'],
					  'User_Sex'=>$_POST['sex'],
					  'User_Password'=>md5('12345'),
					  'User_Email'=>$_POST['User_Email'],
					  'User_Birthdat'=>strtotime($_POST['User_Birthdat']),
					  'User_Balance'=>$_POST['User_Balance'],
			 		  'User_Mobile'=>$_POST['User_Mobile'],
			 		  'User_Telephone'=>$_POST['User_Telephone'],
				 	  'User_Province'=>$_POST['User_Province'],
			 		  'User_City'=>$_POST['User_City'],
					  'User_Area'=>$_POST['User_Area'],
					  'User_Address'=>$_POST['User_Address'],
					  'User_Addtime'=>time(),
			 		  'User_QQ'=>$_POST['User_QQ'],
					  'User_SafeQues'=>$_POST['User_SafeQues'],
			 		  'User_SafeAnswer'=>$_POST['User_SafeAnswer'],
					  'User_Grade'=>$_POST['User_Grade']);			
			$result = M('Users')->data($data)->add();
			if($result){
				
					echo "<script>alert('新用户注册成功,请重新登录！');location.href='../Users/index';</script>";
					//$this->success('新用户注册成功,请重新登录！',U('Index/index'));
			}else{
					$this->error('添加出错！');
			} 
		}	
		$this->assign('action','add');
		$this->display();	
	}
    
    //修改i
	function edit(){
		header("Content-Type:text/html; charset=utf-8");
		if($_GET['id']){
		
			$id = $_GET['id'];
			$pro=M('Users');
			$article_item=$pro->where("User_Id=$id")->find();		
			$this->assign('user',$article_item);

			$this->assign('title','修改用户个人信息');
			$this->display();
		}		
	}
	
	/**
     * @函数	update
     * @功能	更新修改到数据库
     */
	public function update(){		
		header("Content-Type:text/html; charset=utf-8");	
			$article=M('Users');
			if(empty($_POST['User_UserName'])){
				  $this->error('用户昵称不能为空！');
			} 
			if(!empty($_POST['User_Password'])){			
				$data = array('User_Sex'=>$_POST['sex'],
						  'User_Password'=>md5($_POST['User_Password']),
						  'User_Birthdat'=>strtotime($_POST['User_Birthdat']),
						  'User_Balance'=>$_POST['User_Balance'],
				 		  'User_Mobile'=>$_POST['User_Mobile'],
				 		  'User_Telephone'=>$_POST['User_Telephone'],
					 	  'User_Province'=>$_POST['User_Province'],
				 		  'User_City'=>$_POST['User_City'],
						  'User_Area'=>$_POST['User_Area'],
						  'User_Address'=>$_POST['User_Address'],
				 		  'User_QQ'=>$_POST['User_QQ'],
						  'User_SafeQues'=>$_POST['User_SafeQues'],
				 		  'User_SafeAnswer'=>$_POST['User_SafeAnswer'],
						  'User_Grade'=>$_POST['User_Grade']);	
			}else{
				$data = array('User_Sex'=>$_POST['sex'],						 
						  'User_Birthdat'=>strtotime($_POST['User_Birthdat']),
						  'User_Balance'=>$_POST['User_Balance'],
				 		  'User_Mobile'=>$_POST['User_Mobile'],
				 		  'User_Telephone'=>$_POST['User_Telephone'],
					 	  'User_Province'=>$_POST['User_Province'],
				 		  'User_City'=>$_POST['User_City'],
						  'User_Area'=>$_POST['User_Area'],
						  'User_Address'=>$_POST['User_Address'],
				 		  'User_QQ'=>$_POST['User_QQ'],
						  'User_SafeQues'=>$_POST['User_SafeQues'],
				 		  'User_SafeAnswer'=>$_POST['User_SafeAnswer'],
						  'User_Grade'=>$_POST['User_Grade']);	
			}		
			$id=$_POST['id'];
			$article->where('User_Id='.$id)->setField($data); // 根据条件保存修改的数据	
			//$url=U('/Product/index/');	
			echo "<script>alert('用户信息修改成功！');location.href='../Users/index';</script>";		
			//$this->success('用户信息修改成功！',U('Users/index'));		
	}
    
    
    	
	/**
     * @函数	delete
     * @功能	删除文章
     */
	function delete(){		
    	$article=M('Users');
		if($article->delete($_GET['id'])){
			$this->success('用户信息删除成功');
		}else{
			$this->error($article->getLastSql());
		}
	}
	
	function deletes(){		
    	$article=M('Admin');
		if($article->delete($_GET['id'])){
			$this->success('管理员信息删除成功');
		}else{
			$this->error($article->getLastSql());
		}
	}
    
/**
     * @函数	quit
     * @功能	登出账户，跳转至登录页面。并清除Session
     */
    function quit(){
    	session(null);//清空所有session信息
		redirect(U('/Login/index'),0, '重新登录');
    }
    
}