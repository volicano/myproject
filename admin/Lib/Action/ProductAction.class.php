<?php
// 本类由系统自动生成，仅供测试用途
class ProductAction extends Action {
	
	
	
	
	
	
	public function index(){ 	
      	header("Content-Type:text/html; charset=utf-8");
    	if(session('?adminuser')){
			$this->assign('username',session('adminuser'));
      	}      	
    	$news=M('Product');	
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
		$news_lists=$news->field(array('Id','Cat_Id','Comm_Pic','Comm_Name','Comm_SellPrice','Comm_Reserves','Comm_Sellnum','comm_SjTime'))->order('Id desc')->limit($page->firstRow.','.$page->listRows)->select();
    //	$this->filter(&$news_list);
    	
		$cat = M('Category');
		$tree=$cat->field(array('id','cat_name','parent_id'))->select();

	  	$ra = array();
	  	foreach($tree as $t){
	  		$ra[$t['id']] =$t;
	  	}
		$this->assign('list',$ra);	
		$news_list = array();	
		foreach ($news_lists as $v){
			//print_r($ra);exit;
			$v['type'] = $ra[$v['Cat_Id']]['cat_name'];
			//print_r($v);
			$news_list[] = $v;
		}		
    	$this->assign('news_list',$news_list);
    	$this->assign('page_method',$show);
    	
    	$this->assign('cat_count',$count);
    	$this->assign('title','商品信息管理');
    	$this->display();
    }
    
	//实现树型层级的分类
 	static public function sortOut($cate,$pid=0,$level=0,$html='--'){
         $tree = array();
         foreach($cate as $v){
             if($v['parent_id'] == $pid){
                  $v['level'] = $level + 1;
                  $v['html'] = str_repeat($html, $level);
                  $tree[] = $v;
                  $tree = array_merge($tree, self::sortOut($cate,$v['id'],$level+1,$html));
             }
         }
         return $tree;
   }
    
    
 	public function insert(){ 			
 	 	
    }
    
    public function add(){
    	header("Content-Type:text/html; charset=utf-8");
    
    	if($_POST){
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
		$Comm_IsRecomm	=intval(trim($_POST['Comm_IsRecomm']));
		$Comm_Sort = intval(trim($_POST['Sort']));
		$Comm_Describe = strval(trim($_POST['editorValue']));
		$isshow = intval($_POST['isshow']);
		$pro = M("Product"); // 实例化User对象
		$pro->create(); // 创建数据对象	
 		$pro->Comm_Name			=$Comm_Name;
		$pro->Cat_Id			=$Cat_Id;
		$pro->Comm_MarketPrice	=$Comm_MarketPrice;
		$pro->Comm_Reserves		=$Comm_Reserves;
		$pro->Comm_SellPrice	=$Comm_SellPrice;
		$pro->Comm_IsHot		=$Comm_IsHot;
		$pro->Comm_IsTj			=$Comm_IsTj;
		$pro->Comm_IsRecomm     =$Comm_IsRecomm;
		$pro->comm_SjTime   	=time();		
		$pro->Comm_Describe 	=$Comm_Describe;	
		$pro->Admin_Id = session('username')? session('username'):1;	
		$pro->Comm_Sort = $Comm_Sort;
		if(count($info[0])>0){
			$pro->Comm_Pic=substr($info[0]['savepath'],1).$info[0]['savename'];
		}	
		$result=$pro->add();
		if($result){
			echo "<script>alert('添加商品成功！');location.href='../Product/index';</script>";
			//$this->success('添加商品成功！',U('Product/index'));
		}else{
			$this->error('添加出错！');
		}			
    		
    		
    	}
    	   	
    		$cat = M('Category');
			$list=$cat->field(array('id','cat_name','parent_id'))->order('parent_id')->select();
	  		$tree= $this->sortOut($list);		
			$this->assign('list',$tree);
	    	$this->assign('action','add');
	    	$this->display();
    }
    
    
    //修改i
	function edit(){
		header("Content-Type:text/html; charset=utf-8");
		if($_GET['id']){
		
			$id = $_GET['id'];
			$pro=M('Product');
			$article_item=$pro->where("id=$id")->find();		
			$this->assign('product',$article_item);

			
			$cat = M('Category');
			$list=$cat->field(array('id','cat_name','parent_id'))->order('parent_id')->select();
	  		$tree= $this->sortOut($list);		
			$this->assign('list',$tree);
			$this->assign('title','修改商品信息');
			$this->display();
		}		
	}
	
	/**
     * @函数	update
     * @功能	更新修改到数据库
     */
	public function update(){		
		header("Content-Type:text/html; charset=utf-8");	
		$article=M('Product');
		if(empty($_POST['Comm_Name'])||$_POST['Comm_Name']==''){
			  $this->error('产品名称不能为空！');
		} 	
		import('ORG.Net.UploadFile');
	    $upload = new UploadFile();// 实例化上传类
	    $upload->maxSize  = 4145728 ;// 设置附件上传大小
	    $upload->allowExts  = array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
	    $upload->savePath =  './public/Uploads/pic/';// 设置附件上传目录
	    //设置上传文件规则
		$upload->saveRule = 'uniqid';
	    if(!$upload->upload()) {// 上传错误提示错误信息
	      //  $this->error($upload->getErrorMsg());
	    }else{// 上传成功
	      	$info =  $upload->getUploadFileInfo();
	    }	    
		if(count($info[0])>0){
			$Comm_Pic=substr($info[0]['savepath'],1).$info[0]['savename'];			
			$data = array('Comm_Name'=>$_POST['Comm_Name'],
					  'Cat_Id'=>$_POST['Cat_Id'],
					  'Comm_SellPrice'=>$_POST['Comm_SellPrice'],
			 		  'Comm_MarketPrice'=>$_POST['Comm_MarketPrice'],
			 		  'Comm_Reserves'=>$_POST['Comm_Reserves'],
				 	  'Comm_IsHot'=>$_POST['Comm_IsHot'],
			 		  'Comm_IsTj'=>$_POST['Comm_IsTj'],
					  'Comm_IsRecomm'=>$_POST['Comm_IsRecomm'],
					  'Sort'=>$_POST['Sort'],
					  'Comm_Describe'=>$_POST['editorValue'],
			 		  'Comm_Pic'=>$Comm_Pic,
					  'isshow'=>$_POST['isshow'],
					  'Comm_MarketPrice'=>$_POST['Comm_MarketPrice']);			
			$id=$_POST['id'];
			$article->where('id='.$id)->setField($data); // 根据条件保存修改的数据	
			//$url=U('/Product/index/');	
			echo "<script>alert('修改商品信息成功！');location.href='../Product/index';</script>";		
			//$this->success('修改商品信息成功！',U('Product/index'));
		}else{
			$data = array('Comm_Name'=>$_POST['Comm_Name'],
					  'Cat_Id'=>$_POST['Cat_Id'],
					  'Comm_SellPrice'=>$_POST['Comm_SellPrice'],
				  	  'Comm_MarketPrice'=>$_POST['Comm_MarketPrice'],
			 		  'Comm_Reserves'=>$_POST['Comm_Reserves'],
					  'Comm_IsRecomm'=>$_POST['Comm_IsRecomm'],
					  'Sort'=>$_POST['Sort'],
					  'Comm_IsHot'=>$_POST['Comm_IsHot'],
			 		  'Comm_IsTj'=>$_POST['Comm_IsTj'],
					  'Comm_Describe'=>$_POST['editorValue'],
					   'isshow'=>$_POST['isshow'],
					  'Comm_MarketPrice'=>$_POST['Comm_MarketPrice']);	
			$id=$_POST['id'];
			$article->where('id='.$id)->setField($data); // 根据条件保存修改的数据
			//$url=U('/Product/index/');			
			//$this->success('修改商品信息成功！',U('Product/index'));
			echo "<script>alert('修改商品信息成功！');location.href='../Product/index';</script>";
		}		
	}
    
    /**
     * @函数	delete
     * @功能	删除文章
     */
	function delete(){		
    	$article=M('Product');
		if($article->delete($_GET['id'])){
			$this->success('商品信息删除成功');
		}else{
			$this->error($article->getLastSql());
		}
	}

    
    
}