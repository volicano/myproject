<?php
// 本类由系统自动生成，仅供测试用途
class CategoryAction extends Action {
	
	
	
	
	
	
	public function index(){ 	
      	header("Content-Type:text/html; charset=utf-8");
    	if(session('?adminuser')){
			$this->assign('username',session('adminuser'));
    	}      	
    	$news=M('Category');	
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
		$news_list=$news->field(array('id','cat_name','addtime','displayorder'))->order('id desc')->limit($page->firstRow.','.$page->listRows)->select();
    //	$this->filter(&$news_list);
    	
		$list=$news->field(array('id','cat_name','parent_id'))->order('parent_id')->select();

	  	$tree= $this->sortOut($list);
		
		$this->assign('list',$tree);
		
		
		
    	$this->assign('news_list',$news_list);
    	$this->assign('page_method',$show);
    	
    	$this->assign('cat_count',$count);
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
    
   public function add(){
   		header("Content-Type:text/html; charset=utf-8");
   		  		
   		if($_POST){		
	   		$Category   =   D('Category'); 
			if(empty($_POST['name'])){
				  $this->error('类别名称不能为空！');
			}        
	        if($Category->create()) {        	
	        	$data['cat_name']  =   $_POST['name'];
				$data['parent_id']    =   $_POST['level'];
				$data['addtime']    =   time();
				$data['displayorder']    =   $_POST['order'];			
				$result =   $Category->add($data);
	            if($result) {
	               echo "<script>alert('类别添加成功！');location.href='../Category/index';</script>";
	            }else{
	                $this->error('写入错误！');
	            }
	        }else{
	            $this->error($Category->getError());
	        }			
		}
		$article=M('Category');
		$list=$article->field(array('id','cat_name','parent_id'))->order('parent_id')->select();
  		$tree= $this->sortOut($list);		
		$this->assign('list',$tree);
   		$this->assign('action','add');
   		$this->display();
   }
 	public function insert(){ 			
        
    }
        
	function edit(){
		header("Content-Type:text/html; charset=utf-8");
		if($_GET['id']){
		
			$id = $_GET['id'];
			$article=M('Category');
			$article_item=$article->where("id=$id")->find();		
			$this->assign('article_item',$article_item);

			$list=$article->field(array('id','cat_name','parent_id'))->order('parent_id')->select();
	  		$tree= $this->sortOut($list);		
			$this->assign('list',$tree);
			$this->display();
		}
	}
	
	/**
     * @函数	update
     * @功能	更新修改到数据库
     */
	public function update(){		
		header("Content-Type:text/html; charset=utf-8");	
		$article=M('Category');
		if(empty($_POST['name'])){
			  $this->error('类别名称不能为空！');
		} 			
		$data = array('cat_name'=>$_POST['name'],'parent_id'=>$_POST['level'],'displayorder'=>$_POST['order']);		
		$id=$_POST['id'];
		$article->where('id='.$id)->setField($data); // 根据条件保存修改的数据		
		$url=U('/Category/index/');			
		redirect($url,0, '跳转中...');
	}
	
	/**
     * @函数	delete
     * @功能	删除文章
     */
	function delete(){		
    	$article=M('Category');
		if($article->delete($_GET['id'])){
			$this->success('类别删除成功');
		}else{
			$this->error($article->getLastSql());
		}
	}
	

    
    
    
}