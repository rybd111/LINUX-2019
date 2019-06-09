<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset='utf-8'" />
<title>课程选择</title>

</head>

<body>
<div ><H3><b>您当前的位置：</b>[教师管理]-[课程选择]</H3></div>
<div ><b>请老师给每个院的学生分配对应的实验课，点击查询进行分类</b></div>
<hr />
<form name="form0" method="get" action="teacherinsert1.php">
<table align="center">
<tr><td>课程院系：</td><td><select name="department" ><option value="信息学院">信息学院</option><option value="数学院">数学院</option></select></td></tr><td><input type="submit" value="查询" name="submit1" /></td>
</table>
</form>
<hr />
<table align="right"><tr><td><a href="insert.php"><input type="button" value="增加"></a>    &nbsp;&nbsp;&nbsp;     <a href="course_daoru.html"><input type="button" value="导入" /></a>　　　<a href="course_daochu.php"><input type="button" value="导出" /></a></td></tr></table>
<?php 
	
$link=mysqli_connect("localhost","root","")or die("数据库连接失败！");
	
	mysqli_select_db($link,"sign")or die("数据链接失败！");
	mysqli_query($link,"set names 'utf-8'");
	
	$sql="select  * from course  order by C_id";
	$result=mysqli_query($link,$sql);
	$rows=mysqli_num_rows($result);
	$pagesize=3;
	$pagecount=ceil($rows/$pagesize);
	if(isset($_GET["pageno"]))
		$pageno=$_GET["pageno"];
	if(!isset($pageno)||$pageno<1)
		$pageno=1;
	if($pageno>$pagecount)
		$pageno=$pagecount;
		
	$offset=($pageno-1)*$pagesize;
	mysqli_data_seek($result,$offset);
	
	?>
	
	<table width="100%" border="0" cellpadding="2" cellspacing="2" bgcolor="#cccccc">
<tr bgcolor="#999999" align="center">

<td><b>课程ID</b></td>
<td><b>课程名称</b></td>
<td><b>开始时间</b></td>
<td><b>结束时间</b></td>
<td><b>实验学院</b></td>
<td><b>实验教室</b></td>
<td><b>实验室IP</b></td>
</tr>
<?php
	$i=0;
	while($row=mysqli_fetch_array($result)){
	?>
	
<tr bgcolor="#ffffff">
 
<td><div align="center"><?php echo $row['C_id'];?></div></td>
<td><div align="center"><?php echo $row['C_name'];?></div></td>
<td><div align="center"><?php echo $row['C_start_time'];?></div></td>
<td><div align="center"><?php echo $row['C_over_time'];?></div></td>
<td><div align="center"><?php echo $row['C_department'];?></div></td>

<td><div align="center"><?php echo $row['C_room'];?></div></td>
<td><div align="center"><?php echo $row['C_ip'];?></div></td>

</tr>
<?php
	$i=$i+1;
	if($i==$pagesize)
	break;
	}
	mysqli_free_result($result);
	mysqli_close($link);
	?>
<tr><td colspan="9">&nbsp;</td></tr>
</table>

<div align="center">
[第<?php echo $pageno;?>页/共<?php echo $pagecount;?>页]
<?php // $href=$_SERVER['PHP_SELF']."?subit=".urlencode($subit);
if($pageno<>1){
?>
<a href="<?php echo "teacherinsert.php"?>?pageno=1">首页</a>
<a href="<?php echo "teacherinsert.php"?>?pageno=<?php echo $pageno-1; ?>">上一页</a>
<?php
}
if($pageno<>$pagecount){
?>
<a href="<?php echo "teacherinsert.php"?>?pageno=<?php echo $pageno+1;?>">下一页</a>
<a href="<?php echo "teacherinsert.php"?>?pageno=<?php  echo $pagecount;?>">尾页</a>
<?php 
}
?>
[共找到<?php echo $rows;?>个课程]

</div>
</td>
</tr>
</table>

</body>
</html>
