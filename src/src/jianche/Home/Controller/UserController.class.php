<?php
namespace Home\Controller;
use Think\Controller;
class IndexController extends Controller {


public function insert()
{
	header('Content-Type:text/html; charset=utf-8');//防止出现乱码
	$user=$_POST['user'];
	$this->verifyCheck();
	$Pagemodel = D("user");
	$vo = $Pagemodel->create(); 
	if(false === $vo) die($Pagemodel->getError());
		$topicid = $Pagemodel->add(); //add方法会返回新添加的记录的主键值
	if($topicid)
	{
		//$_SESSION[C('USER_AUTH_KEY')]=$user;//不能用此句
		Session::set(C('USER_AUTH_KEY'),$user);
		//dump(Session::get('authId')); 
		echo "<script>alert('数据库添加成功');location.href='http://127.0.0.1/zhuce/index.php/index';</script>";
	}
	else throw_exception("<script>alert('数据库添加失败');history.back();</script>");
}



}