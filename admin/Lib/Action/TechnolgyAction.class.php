<?php
// 本类由系统自动生成，仅供测试用途
class TechnolgyAction extends Action {
	
	
	public function index(){ 	
      	header("Content-Type:text/html; charset=utf-8");
    	$news=M('jszc');
    	if($_POST['action']=='del'){

        }
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
		$news_list=$news->field(array('id','question','author','createtime'))->order('id desc')->limit($page->firstRow.','.$page->listRows)->select();
    //	$this->filter(&$news_list);
    	$this->assign('technolgy',$news_list);
    	$this->assign('page_method',$show);
    	$this->assign('cat_count',$count);
    	$this->display();
    }
    

 	public function insert(){ 			
        $gg   =   D('Gonggao'); 
		if(empty($_POST['title'])){
			  $this->error('广告标题不能为空！');
		}   
		import('ORG.Net.UploadFile');
	    $upload = new UploadFile();// 实例化上传类
	    $upload->maxSize  = 4145728 ;// 设置附件上传大小
	    $upload->allowExts  = array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
	    $upload->savePath =  './Public/index/image/';// 设置附件上传目录
	    //设置上传文件规则
		$upload->saveRule = 'uniqid';
	    if(!$upload->upload()) {// 上传错误提示错误信息
	        $this->error($upload->getErrorMsg());
	    }else{// 上传成功
	      	$info =  $upload->getUploadFileInfo();
	    }	 
	    if(count($info[0])>0){
		     if($gg->create()) {        	
	        	$data['title']  =   $_POST['title'];
	        	$data['pic']  =   $info[0]['savename'];
				$data['isshow']    =   isset($_POST['isshow'])?$_POST['isshow']:0;
				$data['addtime']    =   time();
				$data['content']    =   $_POST['editorValue'];			
				$result =   $gg->add($data);
	            if($result) {
	                $this->success('广告添加成功！');
	            }else{
	                $this->error('数据写入错误！');
	            }
	        }else{
	            $this->error($gg->getError());
	        }	    	
	    }else{
	    	echo "<script>alert('请上传一张图片吧');history.back(-1);</script>";
	    }      
    }

    
	function edit(){
		header("Content-Type:text/html; charset=utf-8");
		if($_GET['id']){		
			$id = $_GET['id'];
			$article=M('jszc');
			$article_item=$article->where("id=$id")->find();		
			$this->assign('jszc',$article_item);
            $this->assign('action','edit');
			$this->assign('title','修改常见问题信息');
			$this->display();
		}	
	}
	
	
	public function add(){		
		header("Content-Type:text/html; charset=utf-8");
		if($_POST){

            $model = M('jszc');
            //保存当前数据对象
            $data['question'] =  $_POST['title'];
            $data['author'] = $_POST['author'];
            $data['createtime'] = NOW_TIME;
            $data['answer']    =   $_POST['editorValue'];
            $data['is_show']    =   $_POST['isshow'];
            $result =   $model->add($data);
            if($result) {
                echo "<script>alert('添加成功！');location.href='../Technolgy/index';</script>";
                exit(0);
                //  $this->success('广告添加成功！');
            }else{
                $this->error('数据写入错误！');
            }
		}
		
		$this->assign('action','add');
		$this->display();
	}
	
	/**
     * @函数	update
     * @功能	更新修改到数据库
     */
	public function update(){		
		header("Content-Type:text/html; charset=utf-8");	
		$article=M('jszc');
		if(empty($_POST['title'])){
			  $this->error('问题名称不能为空！');
		} 	
		
    	$data = array('question'=>$_POST['title'],'author'=>$_POST['author'],'answer'=>$_POST['editorValue'],'is_show'=>$_POST['isshow']);
    	$id=$_POST['id'];
		$fl = $article->where('id='.$id)->setField($data); // 根据条件保存修改的数据

		if($fl){
			echo "<script>alert('修改成功！');location.href='../Technolgy/index';</script>";
			//$url=U('/Gonggao/index/');			
			//redirect($url,0, '跳转中...');
		}
	
	    
	}
	
	/**
     * @函数	delete
     * @功能	删除文章
     */
	function delete(){		
    	$article=M('jszcs');
		if($article->delete($_GET['id'])){
			$this->success('删除成功');
		}else{
			$this->error($article->getLastSql());
		}
	}

    
    
}