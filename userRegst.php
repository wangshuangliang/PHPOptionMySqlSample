<?php  include 'config.php';?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title></title>
	<style>
		
		table{

			border:1px solid #F00;
			width: 300px;
			border-collapse:collapse;
			margin-top: 10px;
		}

		td{

			border:1px solid #F00;
			width: 100px;
			text-align: center;
		}
	</style>
	<script type="text/javascript" src="http://code.jquery.com/jquery-latest.js"></script>
</head>
<body>
	<!-- 添加数据 -->
	<form action="DBRegst.php" method="POST">
		<span>姓氏:</span>
		<input type="text" name="first_name" placeholder = "请输入姓氏">
		<br>
		<br>
		<span>名称:</span>
		<input type="text" name="last_name" placeholder = "请输入名称">
		<input type="text" name="type" value="insert" style="display: none">
		<br>
		<br>
		<input type="submit">
	</form>
	<!-- 查看数据 -->
	<button id = "browseBtn" onclick="browseAction()"> 查看/刷新</button>
	<!-- 查询 -->
	<br>
	<span>搜索关键字</span>
	<input id ='searchKeyWord' type="text" name="">
	<input id ='isChooseKeyWordSearch' type="checkbox">
	<table id ='resultListTb'>
		<tr>
			<td>编号</td>
			<td>姓氏</td>
			<td>名称</td>
			<td>操作</td>
		</tr>
	</table>
</body>
<script>
	//删除数据
	function deleteAction(object){

		var senderId = object.getAttribute("id");

		$.post("DBRegst.php",
	    {
	        type:'delete',
	        userId:senderId
	    },
	        function(data,status){

	        	//重新刷新数据
	        	var codeAttr = JSON.parse(data);
	        	var code = codeAttr['code'];
	        	if (code == '1') {

	        		browseAction();
	        	} else {

	        		alert('删除失败');
	        	}
	        	
	        }
	     );
	}

	//加载数据
	function browseAction() {
		
		$("#resultListTb").empty();
		if ($('#isChooseKeyWordSearch').is(':checked')) {

			//搜索查询
			var searchKey = $('#searchKeyWord').val();
			if (searchKey.length == 0 || searchKey == null) {

				alert('请输入关键字');
			} else {

				//进行数据库查询
				$.post("DBRegst.php",{type:'select',keyWord:searchKey},function(data,status){

					//数据库搜索结果返回
					var codeAttr = JSON.parse(data);
		        	var code = codeAttr['code'];
		        	if (code == '1') {

		        		
	                var dataArr = JSON.parse(data)['data'];
	                var trS = '<tr><td>编号</td><td>姓氏</td><td>名称</td><td>操作</td></tr>';
			        $('#resultListTb').append(trS);
			        for (var i = dataArr.length - 1; i >= 0; i--) {

			        	var cellArr = dataArr[i];
			        	var tb = '<tbody>';
			        	for (var j = 0; j < cellArr.length; j++) {

			        		var str = '<td>'+cellArr[j]+'</td>';
			        	    tb += str;
			        	}
			        	var idStr = '\''+cellArr[0]+'\'';
			        	tb += '<td>'+'<button id = '+idStr+' onclick="deleteAction(this)"> 删除</button>'+'</td>';
			        	$('#resultListTb').append(tb + '</tbody>');
			         }
			        	} else {

			        		alert('未查到数据');
			        	}
				});
			}
		} else {

			//插叙全部
			$.post("DBRegst.php",
		    {
		        type:'browse'
		    },
	        function(data,status){

	        var dataArr = JSON.parse(data)['data'];
	        var trS = '<tr><td>编号</td><td>姓氏</td><td>名称</td><td>操作</td></tr>';
	        $('#resultListTb').append(trS);
	        for (var i = dataArr.length - 1; i >= 0; i--) {

	        	var cellArr = dataArr[i];
	        	var tb = '<tbody>';
	        	for (var j = 0; j < cellArr.length; j++) {

	        		var str = '<td>'+cellArr[j]+'</td>';
	        	    tb += str;
	        	}
	        	var idStr = '\''+cellArr[0]+'\'';
	        	tb += '<td>'+'<button id = '+idStr+' onclick="deleteAction(this)"> 删除</button>'+'</td>';
	        	$('#resultListTb').append(tb + '</tbody>');
	         }
	       });
		}
	}
	
</script>
</html>