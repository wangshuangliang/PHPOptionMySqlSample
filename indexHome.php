	<!DOCTYPE html>
	<html>
	<head>
		<title>测试</title>
	</head>
	<body>

		<?php
		$servername = "localhost";
		$username = "root";
		$password = "root";
		$dbname = "WLS";
		 
		// 创建连接
		$conn = new mysqli($servername, $username, $password,$dbname);
		 
		// 检测连接
		if ($conn->connect_error) {
		    die("连接失败: " . $conn->connect_error);
		} 
		echo "连接成功";
		$sql = "INSERT INTO user (first_name, last_name)
		VALUES ('王', '双亮')";

		if ($conn->query($sql) === TRUE) {
		    echo "新记录插入成功";
		} else {
		    echo "Error: " . $sql . "<br>" . $conn->error;
		}

		$conn->close();
		?>
	</body>
	</html>