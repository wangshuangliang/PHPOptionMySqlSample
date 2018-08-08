
<?php include 'config.php';?>
<?php 
   $type = $_POST['type'];
   $wsldb = new WSLDB();
   if ($type == 'insert') {

   	//插入数据
   	$first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    if ($first_name == '' || $last_name == '') {

    	echo "姓氏及名称不能为空!";
    } else {

        $wsldb->connetDB("localhost","root","root","WLS",$type)($first_name,$last_name);
    }

   } else if ($type == 'browse') {

	   	//查看数据
	   	$totleArr = $wsldb->connetDB("localhost","root","root","WLS",$type);
	   	echo $totleArr;
   } else if ($type == 'delete') {

   	    //删除数据
   	    $userId = $_POST['userId'];
   	    $wsldb->connetDB("localhost","root","root","WLS",$type)($userId);
   } else if ($type == 'select'){
        //搜索数据
   	    $keyWord = $_POST['keyWord'];
   	    $wsldb->connetDB("localhost","root","root","WLS",$type)($keyWord);
   }
 ?>