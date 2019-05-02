<?php
// 本类由系统自动生成，仅供测试用途
class IndexAction extends Action {
	
	
	
 	public function index(){
    	header("Content-Type:text/html; charset=utf-8");
    	$news=M('Product');	  	
 
    	$tj_list= $news->where('Comm_IsTj=1')->field('Id,Comm_Name,Comm_Pic,Comm_MarketPrice,Comm_Reserves,Comm_SellPrice')->limit(2)->select();
   	
    	$hot_list= $news->where('Comm_IsHot=1')->field('Id,Comm_Name,Comm_Pic,Comm_MarketPrice,Comm_Reserves,Comm_SellPrice')->limit(2)->select();
    	
    	$new_list= $news->where('Comm_IsRecomm=1')->field('Id,Comm_Name,Comm_Pic,Comm_MarketPrice,Comm_Reserves,Comm_SellPrice')->limit(2)->order('Id desc')->select();
    	
    	$this->assign('new_data',$new_list);
    	$this->assign('hot_data',$hot_list);    	
    	$this->assign('tj_data',$tj_list);   	
    	
    	$gg = M('Gonggao');    	
    	$gglist= $gg->where('isshow=1')->limit(3)->select();
    	
    	$this->assign('two',2);   
    	$this->assign('gg',$gglist);    	
		$this->display();
    }

    public function bbs_index()
    {
        header("Content-Type:text/html; charset=utf-8");
        $new = M('bbs');
        $bbslist = $new->where('1=1')->limit(5)->select();
        $this->assign('bbs', $bbslist);
        $gg=M('Gonggao');
        $gglist= $gg->where('isshow=1')->limit(3)->select();
        $this->assign('gg', $gglist);
        $this->display();
    }

    public function bbs_list()
    {
        header("Content-Type:text/html; charset=utf-8");
        $topic = M('topic');
        $id = $_GET['id'];
        $topiclist= $topic->where("typeid=$id")->where("tid=0")->select();
        $this->assign('topiclist',$topiclist);
        $this->assign('typeid', $id);

        $gg=M('Gonggao');
        $gglist= $gg->where('isshow=1')->limit(3)->select();
        $this->assign('gg', $gglist);
        $this->display();
    }

    public function bbs_detail()
    {
        header("Content-Type:text/html; charset=utf-8");
        $topic = M('topic');
        $user = M('userinfo');
        $id = $_GET['id'];
        $topic= $topic->where("id=$id")->find();
        $userinfo= $user->where("id=$topic[user_id]")->find();
        $topic['photo'] = '/bike/Public/images/face/'.$userinfo['photo'].'.gif';

        $topics = M('topic');
        $topicreply= $topics->where("tid=$id")->select();
        foreach ($topicreply as $top){
            $nf = $user->where("id=$top[user_id]")->find();
            $pic = '/bike/Public/images/face/'.$nf['photo'].'.gif';
            $top['photo'] = $pic;
            $topicreplys[] =$top;
        }
        $this->assign('topicreply',$topicreplys);
        $this->assign('topic',$topic);
        $this->assign('topicid', $id);

        $gg=M('Gonggao');
        $gglist= $gg->where('isshow=1')->limit(3)->select();
        $this->assign('gg', $gglist);
        $this->display();
    }

    public function post()
    {
        header("Content-Type:text/html; charset=utf-8");
        $topic = M('topic');
        $id = $_GET['id'];
        if($_POST){
            $userid = session("userid");
            $username=session("username");
            $title=strval(trim($_POST['title']));
            $content=strval(trim($_POST['content']));
            $typeid=intval(trim($_POST['typeid']));
            $tid=intval(trim($_POST['tid']));
            $data=array(
                'user_id'=>$userid,
                'username'=>$username,
                'title'=>$title,
                'content'=>$content,
                'addtime'=>time(),
                'lastreplytime'=>time(),
                'typeid'=>$typeid,
                'tid'=>$tid
            );
            $result = $topic->data($data)->add();
            if(!$tid&&$result){
                echo "<script>alert('发表成功!');location.href='../Index/bbs_list?id=$typeid';</script>";
                exit;
            }elseif($tid&&$result){
                echo "<script>alert('回复成功!');self.location=document.referrer;</script>";
                exit;
            }else{
                $this->error('发表出错！');
            }
        }
        $this->assign('typeid', $id);
         $gg=M('Gonggao');
        $gglist= $gg->where('isshow=1')->limit(3)->select();
        $this->assign('gg', $gglist);
        $this->display();
    }
    public function bbs(){
        header("Content-Type:text/html; charset=utf-8");
        $news = M('soft');
        import('ORG.Util.Page');
        $gglist= $news->where('1=1')->select();
        $count=count($gglist);
        $page=new Page($count,10);//后台管理页面默认一页显示8条文章记录

        $page->setConfig('prev', "&laquo; 上一页");//上一页
        $page->setConfig('next', '下一页 &raquo;');//下一页
        $page->setConfig('first', '&laquo; 第一页');//第一页
        $page->setConfig('last', '最后页 &raquo;');//最后一页
        $page->setConfig('theme',' %first% %upPage%  %linkPage%  %downPage% %end%');
        //设置分页回调方法
        $show=$page->show();
        $gglist= $news->where('1=1')->limit($page->firstRow.','.$page->listRows)->select();
        $this->assign('softs',$gglist);
        $this->assign('page_method',$show);
        $this->display();
    }
    public function soft(){
        header("Content-Type:text/html; charset=utf-8");
        $news=M('soft');
        import('ORG.Util.Page');
        $gglist= $news->where('1=1')->select();
        $count=count($gglist);
        $page=new Page($count,10);//后台管理页面默认一页显示8条文章记录

        $page->setConfig('prev', "&laquo; 上一页");//上一页
        $page->setConfig('next', '下一页 &raquo;');//下一页
        $page->setConfig('first', '&laquo; 第一页');//第一页
        $page->setConfig('last', '最后页 &raquo;');//最后一页
        $page->setConfig('theme',' %first% %upPage%  %linkPage%  %downPage% %end%');
        //设置分页回调方法
        $show=$page->show();
        $gglist= $news->where('1=1')->limit($page->firstRow.','.$page->listRows)->select();
        $this->assign('softs',$gglist);
        $this->assign('page_method',$show);
        $this->display();
    }

    public function technolgy(){
        header("Content-Type:text/html; charset=utf-8");
        $news=M('jszc');
        import('ORG.Util.Page');
        $gglist= $news->where('1=1')->select();
        $count=count($gglist);
        $page=new Page($count,10);//后台管理页面默认一页显示8条文章记录

        $page->setConfig('prev', "&laquo; 上一页");//上一页
        $page->setConfig('next', '下一页 &raquo;');//下一页
        $page->setConfig('first', '&laquo; 第一页');//第一页
        $page->setConfig('last', '最后页 &raquo;');//最后一页
        $page->setConfig('theme',' %first% %upPage%  %linkPage%  %downPage% %end%');
        //设置分页回调方法
        $show=$page->show();
        $gglist= $news->where('1=1')->limit($page->firstRow.','.$page->listRows)->select();
        $this->assign('jszc',$gglist);
        $this->assign('page_method',$show);

        $this->display();
    }
    public function tech_detail(){
        header("Content-Type:text/html; charset=utf-8");
        $jszc=M('jszc');
        $id = $_GET['Id'];

        $new= $jszc->where("id=$id")->find();
        $this->assign('jszc',$new);

        $gg=M('Gonggao');
        $gglist= $gg->where('isshow=1')->limit(3)->select();
        $this->assign('gg',$gglist);
        $this->display();
    }


    public function gglist(){
    	header("Content-Type:text/html; charset=utf-8");
    	$news=M('Gonggao');	
    	$gglist= $news->where('isshow=1')->limit(3)->select(); 
    	$this->assign('gg',$gglist);    	
		$this->display(); 	
    }
    
    public function detail(){
    	header("Content-Type:text/html; charset=utf-8");
    	$news=M('Gonggao');	
    	$id = $_GET['Id'];
    	
    	$new= $news->where("id=$id")->find();
    	$this->assign('new',$new);  
    	$gglist= $news->where('isshow=1')->limit(3)->select(); 
    	$this->assign('gg',$gglist);     	
		$this->display(); 	
    }
    
    public function product(){
    	$db=M('Product');	
		$Comm_Id=intval($_GET['Comm_Id']);
		
		
		$this->product=$db->where('Id='.$Comm_Id)->find();
		
		$com = M('Commit');
		
		$this->commit = $com->where("pid=".$Comm_Id)->select();
		
		
		
		
		$news=M('Gonggao');	
		$gglist= $news->where('isshow=1')->limit(3)->select(); 
    	$this->assign('gg',$gglist);  
    	
		$this->display();			
    }
    
	public function plist(){
     	header("Content-Type:text/html; charset=utf-8");
     	$new=M('Gonggao');	
		$gglist= $new->where('isshow=1')->limit(3)->select(); 
    	$this->assign('gg',$gglist);
    	
    	
     	$news=M('Product');	
     	$type=intval($_GET['type']);
     	if($type==1){
     		import('ORG.Util.Page');
     		$tj_lists= $news->where('Comm_IsTj=1')->field('Id,Comm_Name,Comm_MarketPrice,comm_SjTime,Comm_Pic,Comm_SellPrice')->select();
     		$count=count($tj_lists);
			$page=new Page($count,10);//后台管理页面默认一页显示8条文章记录
						
     		$page->setConfig('prev', "&laquo; 上一页");//上一页
	        $page->setConfig('next', '下一页 &raquo;');//下一页
	        $page->setConfig('first', '&laquo; 第一页');//第一页
	        $page->setConfig('last', '最后页 &raquo;');//最后一页		
			$page->setConfig('theme',' %first% %upPage%  %linkPage%  %downPage% %end%');
	        //设置分页回调方法
			$show=$page->show();
     		$tj_list= $news->where('Comm_IsTj=1')->field('Id,Comm_Name,Comm_MarketPrice,comm_SjTime,Comm_Pic,Comm_SellPrice')->limit($page->firstRow.','.$page->listRows)->select();
     		$this->assign('tj_data',$tj_list);
     		$this->assign('page_method',$show);
     	}elseif ($type==2){
     		import('ORG.Util.Page');
     		$tj_lists= $news->where('Comm_IsHot=1')->field('Id,Comm_Name,Comm_MarketPrice,comm_SjTime,Comm_Pic,Comm_SellPrice')->select();
     		$count=count($tj_lists);
			$page=new Page($count,10);//后台管理页面默认一页显示8条文章记录
						
     		$page->setConfig('prev', "&laquo; 上一页");//上一页
	        $page->setConfig('next', '下一页 &raquo;');//下一页
	        $page->setConfig('first', '&laquo; 第一页');//第一页
	        $page->setConfig('last', '最后页 &raquo;');//最后一页	
			$page->setConfig('theme',' %first% %upPage%  %linkPage%  %downPage% %end%');
	        //设置分页回调方法
			$show=$page->show();
     		$tj_list= $news->where('Comm_IsHot=1')->field('Id,Comm_Name,Comm_MarketPrice,comm_SjTime,Comm_Pic,Comm_SellPrice')->limit($page->firstRow.','.$page->listRows)->select();
     		$this->assign('tj_data',$tj_list);
     		$this->assign('page_method',$show);
     	}elseif ($type==3){
     		import('ORG.Util.Page');     		
     		$tj_lists= $news->where('Comm_IsRecomm=1')->field('Id,Comm_Name,Comm_MarketPrice,comm_SjTime,Comm_Pic,Comm_SellPrice')->select();
     		$count=count($tj_lists);
			$page=new Page($count,10);//后台管理页面默认一页显示8条文章记录
						
	        $page->setConfig('prev', "&laquo; 上一页");//上一页
	        $page->setConfig('next', '下一页 &raquo;');//下一页
	        $page->setConfig('first', '&laquo; 第一页');//第一页
	        $page->setConfig('last', '最后页 &raquo;');//最后一页	
			$page->setConfig('theme',' %first% %upPage%  %linkPage%  %downPage% %end%');
	        //设置分页回调方法
			$show=$page->show();
     		$tj_list= $news->where('Comm_IsRecomm=1')->field('Id,Comm_Name,Comm_MarketPrice,comm_SjTime,Comm_Pic,Comm_SellPrice')->limit($page->firstRow.','.$page->listRows)->select();
     		$this->assign('tj_data',$tj_list);
     		$this->assign('page_method',$show);
     	}elseif ($type==4){ //自行车 
     		import('ORG.Util.Page');     		
     		$tj_lists= $news->where('Cat_Id=33')->field('Id,Comm_Name,Comm_MarketPrice,comm_SjTime,Comm_Pic,Comm_SellPrice')->select();
     		$count=count($tj_lists);
			$page=new Page($count,10);//后台管理页面默认一页显示8条文章记录
						
	        $page->setConfig('prev', "&laquo; 上一页");//上一页
	        $page->setConfig('next', '下一页 &raquo;');//下一页
	        $page->setConfig('first', '&laquo; 第一页');//第一页
	        $page->setConfig('last', '最后页 &raquo;');//最后一页	
			$page->setConfig('theme',' %first% %upPage%  %linkPage%  %downPage% %end%');
	        //设置分页回调方法
			$show=$page->show();
     		$tj_list= $news->where('Cat_Id=33')->field('Id,Comm_Name,Comm_MarketPrice,comm_SjTime,Comm_Pic,Comm_SellPrice')->limit($page->firstRow.','.$page->listRows)->select();
     		$this->assign('tj_data',$tj_list);
     		$this->assign('page_method',$show);
     	}elseif ($type==5){ //电动车
     		import('ORG.Util.Page');     		
     		$tj_lists= $news->where('Cat_Id=34')->field('Id,Comm_Name,Comm_MarketPrice,comm_SjTime,Comm_Pic,Comm_SellPrice')->select();
     		$count=count($tj_lists);
			$page=new Page($count,10);//后台管理页面默认一页显示8条文章记录
						
	        $page->setConfig('prev', "&laquo; 上一页");//上一页
	        $page->setConfig('next', '下一页 &raquo;');//下一页
	        $page->setConfig('first', '&laquo; 第一页');//第一页
	        $page->setConfig('last', '最后页 &raquo;');//最后一页	
			$page->setConfig('theme',' %first% %upPage%  %linkPage%  %downPage% %end%');
	        //设置分页回调方法
			$show=$page->show();
     		$tj_list= $news->where('Cat_Id=34')->field('Id,Comm_Name,Comm_MarketPrice,comm_SjTime,Comm_Pic,Comm_SellPrice')->limit($page->firstRow.','.$page->listRows)->select();
     		$this->assign('tj_data',$tj_list);
     		$this->assign('page_method',$show);
     	}elseif ($type==6){ //三轮车
     		import('ORG.Util.Page');     		
     		$tj_lists= $news->where('Cat_Id=36')->field('Id,Comm_Name,Comm_MarketPrice,comm_SjTime,Comm_Pic,Comm_SellPrice')->select();
     		$count=count($tj_lists);
			$page=new Page($count,10);//后台管理页面默认一页显示8条文章记录
						
	        $page->setConfig('prev', "&laquo; 上一页");//上一页
	        $page->setConfig('next', '下一页 &raquo;');//下一页
	        $page->setConfig('first', '&laquo; 第一页');//第一页
	        $page->setConfig('last', '最后页 &raquo;');//最后一页	
			$page->setConfig('theme',' %first% %upPage%  %linkPage%  %downPage% %end%');
	        //设置分页回调方法
			$show=$page->show();
     		$tj_list= $news->where('Cat_Id=36')->field('Id,Comm_Name,Comm_MarketPrice,comm_SjTime,Comm_Pic,Comm_SellPrice')->limit($page->firstRow.','.$page->listRows)->select();
     		$this->assign('tj_data',$tj_list);
     		$this->assign('page_method',$show);
     	}else{
     		import('ORG.Util.Page');
     		$count=$news->count();
			$page=new Page($count,10);//后台管理页面默认一页显示8条文章记录
						
	        $page->setConfig('prev', "&laquo; 上一页");//上一页
	        $page->setConfig('next', '下一页 &raquo;');//下一页
	        $page->setConfig('first', '&laquo; 第一页');//第一页
	        $page->setConfig('last', '最后页 &raquo;');//最后一页	
			$page->setConfig('theme',' %first% %upPage%  %linkPage%  %downPage% %end%');
	        //设置分页回调方法
			$show=$page->show();
     		$tj_list= $news->where('1=1')->field('Id,Comm_Name,Comm_MarketPrice,Comm_Pic,comm_SjTime,Comm_SellPrice')->limit($page->firstRow.','.$page->listRows)->select();
     		$this->assign('tj_data',$tj_list);
     		$this->assign('page_method',$show);
     	
     	}
     	
     	$this->assign('type',$type);
		$this->display();    	
    }
    
    public function addgw(){
    	header("Content-Type:text/html; charset=utf-8");
     	$news=M('Gonggao');	
		$gglist= $news->where('isshow=1')->limit(3)->select(); 
    	$this->assign('gg',$gglist);
    	
    	
		if($_GET){
		    	if($_SESSION[username]==""){
				  echo "<script>alert('请先登录后购物!');history.back();</script>"; 
				  exit;
				 }
				$id=strval($_GET['id']);
				$db=M('Product');	
			
				$info=$db->where('Id='.$id)->find();
					
				if($info['Comm_Reserves']<=0){
				   echo "<script>alert('该商品已经售完!');history.back();</script>";
				   exit;
				 }
				
				 
			//	 $_SESSION[producelist]="";
			//	 $_SESSION[quatity]=""; 
				 
				 $array=explode("@",$_SESSION[producelist]);
				 for($i=0;$i<count($array)-1;$i++){
					 if($array[$i]==$id){
					     echo "<script>alert('该商品已经在您的购物车中!');history.back();</script>";
						 exit;
					  }
				 }

				// exit;
				 $_SESSION[producelist]=$_SESSION[producelist].$id."@";
				 $_SESSION[quatity]=$_SESSION[quatity]."1@";
				 				
				//$this->assign('info', $info);
				 $this->redirect('/Index/gouwu');
		}
    	//$this->display();
    }
    public function removegw(){
        if($_GET['id']){
	    	$id=$_GET['id'];
			$arraysp=explode("@",$_SESSION[producelist]);
			$arraysl=explode("@",$_SESSION[quatity]);
			for($i=0;$i<count($arraysp);$i++){
			   if($arraysp[$i]==$id){
				  $arraysp[$i]="";
				  $arraysl[$i]="";
				}
			 }
			$_SESSION[producelist]=implode("@",$arraysp);
			$_SESSION[quatity]=implode("@",$arraysl);			
        }
        $this->redirect('/Index/gouwu');
    }
    
	public function gouwu2(){
		header("Content-Type:text/html; charset=utf-8");
		if($_POST){
			$user = M('Users');
			$name = $_SESSION[username]!=""?$_SESSION[username]:'';
			$info = $user->where("User_UserName='".$name."'")->find();

			$order = M('Order');
				$dingdanhao=date("YmjHis").$info[id];
				$spc=$_SESSION[producelist];
				$slc= $_SESSION[quatity];
				$shouhuoren=$_POST['name2'];
				$sex=$_POST[sex];
				$dizhi=$_POST[dz];
				$youbian=$_POST[yb];
				$tel=$_POST[tel];
				$email=$_POST[email];
				$shff=$_POST[shff];
				$zfff=$_POST[zfff];
				if(trim($_POST[ly])==""){
				   $leaveword="";
				 }else{
				   $leaveword=$_POST[ly];
				 }
				 $xiadanren=$_SESSION['username'];
				 $time=date("Y-m-j H:i:s");
				 $zt="下单成功";
		 		 $total=$_POST['total'];
				 $data=array(
					'dingdanhao'=>$dingdanhao,
					'spc'=>$spc,
					'slc'=>$slc,
					'shouhuoren'=>$shouhuoren,
					'sex'=>$sex,
				 	'dizhi'=>$dizhi,
					'youbian'=>$youbian,
					'tel'=>$tel,
					'email'=>$email,
				 	'shff'=>$shff,
					'zfff'=>$zfff,
				 	'leaveword'=>$leaveword,
					'time'=>$time,
					'xiadanren'=>$xiadanren,
				 	'zt'=>$zt,
				 	'total'=>$total,
				);		
				$result = $order->data($data)->add();				
				if($result){
					echo "<script>alert('下单成功!');location.href='../Index/showdd?ddh=$result';</script>";
					exit;			
				}else{
					$this->error('评论添加出错！');
				} 			
			}
			$this->assign('total',$_GET['total']);
	        $this->display();
	    }
	    
	    public function showdd(){
	    	header("Content-Type:text/html; charset=utf-8");
	    	$new=M('Gonggao');	
			$gglist= $new->where('isshow=1')->limit(3)->select(); 
	    	$this->assign('gg',$gglist);
	    	if($_GET){
	    		$id = $_GET['ddh'];
	    		$order = M('Order');
	    		$info = $order->where("id='".$id."'")->find();
	    		$this->assign('info',$info);
	    		
	    		$spc=$info[spc];
  				$slc=$info[slc];
				$arraysp=explode("@",$spc);
				$arraysl=explode("@",$slc);

				$db=M('Product');
				$total=0;
				for($i=0;$i<count($arraysp)-1;$i++){
					 if($arraysp[$i]!=""){
					 $id = $arraysp[$i];
					 $num = $arraysl[$i];	
				     $p=$db->where('Id='.$id)->find();
					 $p['num'] = $num;
					 $total1=$num*$p['Comm_SellPrice'];
					 $p['total1'] = $total1;
					 $total+=$total1;			
					 $products[]=$p;
					 
					 }
				}
				$this->data=$products;
				$this->total=$total;
	    		
	    	}	    	
	    	$this->display();
	    }
        
    public function gouwu(){
   		header("Content-Type:text/html; charset=utf-8");
     	$news=M('Gonggao');	
		$gglist= $news->where('isshow=1')->limit(3)->select(); 
    	$this->assign('gg',$gglist);
      	if($_SESSION[username]==""){
		  echo "<script>alert('请先登录后购物!');history.back();</script>"; 
		  exit;
		}    	
    	if($_GET['act']=='del'){
    			 $_SESSION[producelist]="";
				 $_SESSION[quatity]=""; 
    	}
    	    	    	
    	$arraygwc=explode("@",$_SESSION[producelist]);
		$s=0;
		for($i=0;$i<count($arraygwc);$i++){
		       $s+=intval($arraygwc[$i]);
		}
		
		$this->assign('s', $s);
    	$total=0;
		$array=explode("@",$_SESSION[producelist]);
		$arrayquatity=explode("@",$_SESSION[quatity]);
			 while(list($name,$value)=each($_POST)){
					  for($i=0;$i<count($array)-1;$i++){
					    if(($array[$i])==$name){
						  $arrayquatity[$i]=$value;  
						}
					}
				}
		$_SESSION[quatity]=implode("@",$arrayquatity); 
		
		$db=M('Product');
		$products= array();
		$num=0;
		$total=0;
		for($i=0;$i<count($array)-1;$i++){ 
			$id=$array[$i];
			$num=$arrayquatity[$i];	
			if($id){
			$p=$db->where('Id='.$id)->find();
			$p['num'] = $num;
			$total1=$num*$p['Comm_SellPrice'];
			$p['total1'] = $total1;
			$total+=$total1;			
			$products[]=$p;
			}
		}
		//print_r($total);exit;
		//$this->len=$len;
		$this->data=$products;
		$this->total=$total;
		
    	$this->display();
    }
    
    public function usercenter(){
    	header("Content-Type:text/html; charset=utf-8");
    	$news=M('Gonggao');	
		$gglist= $news->where('isshow=1')->limit(3)->select(); 
    	$this->assign('gg',$gglist); 
    	
	    if($_SESSION[username]==""){
		  echo "<script>alert('请先登录!');history.back();</script>";
		  exit;
		 }
    	$username = $_SESSION['username'];
    	$user_users=M('userinfo')->where(array('usernc'=>$username))->find();
    	if($_POST){
//    		$email=$_POST[email];
			$truename=$_POST[truename];
			$sex=$_POST[sex];
			$tel=$_POST[tel];
			$qq=$_POST[qq];
			$dizhi=$_POST[address];
			$youbian=$_POST[yb];
            $id_card=$_POST[id_card];
            $photo=$_POST[photo];
			
			$data = array('truename'=>$truename,
					  'sex'=>$sex,
					  'tel'=>$tel,
				  	  'qq'=>$qq,
			 		  'yb'=>$youbian,
					  'address'=>$dizhi,
                      'photo'=>$photo,
					  'id_card'=>$id_card);
			$id=$_POST['id'];
			$id = M('userinfo')->where(array('id'=>$id))->setField($data); // 根据条件保存修改的数据
			//$url=U('/Product/index/');			
			//$this->success('修改商品信息成功！',U('Product/index'));
			echo "<script>alert('用户信息保存成功！');location.href='../Index/usercenter';</script>";
    	
    	}  
    	$this->assign('info',$user_users);  	
    	$this->display();
    	   	
    }
    
     public function findsp(){
     	header("Content-Type:text/html; charset=utf-8");
     	$news=M('Gonggao');	
		$gglist= $news->where('isshow=1')->limit(3)->select(); 
    	$this->assign('gg',$gglist);

    	
    	if($_POST){
    		$name=strval(trim($_POST['name']));
    		$db=M('Product');
    		$condition["Comm_Name"] = array("like", "%".$name."%");
    		$p=$db->where($condition)->select();
    		
    		$this->assign('p',$p);
    	}    	
     	$this->display();
     }
    
    public function finddd(){
   		header("Content-Type:text/html; charset=utf-8");
     	$news=M('Gonggao');	
		$gglist= $news->where('isshow=1')->limit(3)->select(); 
    	$this->assign('gg',$gglist);      	
    	if($_SESSION[username]==""){
		  echo "<script>alert('请先登录后购物!');history.back();</script>"; 
		  exit;
		}
    	$user = $_SESSION['username'];
    	$order = M('Order');
    	$info = $order->where("xiadanren='".$user."'")->select();
    	
    	$arr = array();
    	foreach ($info as $v){
    		$v['slc'] = str_replace("@", "", $v["slc"]);
    		$arr[] = $v;
    	}
    	   	
    	//print_r($info);exit;
    	$this->assign('s',1); 
    	$this->assign('data',$arr);  
    	$this->display();
    }
    
    public function logout(){
   		session_destroy();
		$this->redirect('Index/index');
    }
    
    public function reg(){
    	header("Content-Type:text/html; charset=utf-8");
     	$news=M('Gonggao');	
		$gglist= $news->where('isshow=1')->limit(3)->select(); 
    	$this->assign('gg',$gglist);    	
    	if($_POST){
		    	$username=strval(trim($_POST['usernc']));
				$password=md5(strval(trim($_POST['p1'])));
				$email=strval(trim($_POST['email']));
				$data=array(
					'usernc'=>$username,
					'pwd'=>$password,
					'email'=>$email,
					'regtime'=>time(),
				);		
				$result = M('userinfo')->data($data)->add();
				if($result){
					    echo "<script>alert('新用户注册成功,请重新登录！');location.href='../Index/index';</script>";
						exit;
						//echo "<script>alert('广告添加成功！');location.href='../Gonggao/index';</script>";
						//$this->success('新用户注册成功,请重新登录！',U('Index/index'));
				}else{
						$this->error('添加出错！');
				}    
    	}   	
    	$this->display();
    }
     //前台登录表单处理
	public function loginHandle(){
		if(!IS_POST){
			$this->redirect('Index/index');
		}else{
			$username=$_POST['username'];
			$userpwd=md5($_POST['userpwd']);
			$yz=$_POST['yz'];
			$num=$_POST['num'];
			if(strval($yz)!=strval($num)){
			  echo "<script>alert('验证码输入错误!');history.go(-1);</script>";
			  exit;
			 }
			 $user_users=M('userinfo')->where(array('usernc'=>$username))->find();
			 			 
			 if(!$user_users||$user_users['pwd']!=$userpwd){
				$this->success('用户名或者密码错误!',U('Index/index'));
			 }else{
			 	//session_start()
			 	$_SESSION['username'] = $user_users['usernc'];
			 	$_SESSION['userid'] = $user_users['id'];
			 	$_SESSION['admin'] = 0;			 	
				$this->success('登录前台成功!',U('Index/index'));
			 }	
			 	
		}
	} 
    
    
	public function save(){
		header("Content-Type:text/html; charset=utf-8");
		$commit=M('Commit');   	
		$userid = session("userid");
    	if(!$userid){
    		echo "<script>alert('请登录后评论!');history.back();</script>";
			exit;
    		//$this->success('请登录后评论!',U('Index/login'));
    	}
    	$username=session("username");
		$content=strval(trim($_POST['content']));
		$pid=intval(trim($_POST['pid']));
		$data=array(
			'user_id'=>$userid,
			'user_name'=>$username,
			'content'=>$content,
			'addtime'=>time(),
			'pid'=>$pid,
		);		
		$result = $commit->data($data)->add();
		if($result){
			echo "<script>alert('评论添加成功!');history.back();</script>";
			exit;			
		}else{
			$this->error('评论添加出错！');
		}     	
	}
    
    
}