<?php 
		class WSLDB
		{
			public $servername;
			public $username;
			public $password;
			public $dbname;
			public $conn;
			//数据库操作
			public function connetDB($serviernamedb,$usernamedb,$passworddb,$dbnamedb,$type)
			{
				$this->servername = $serviernamedb;
				$this->username = $usernamedb;
				$this->password = $passworddb;
				$this->dbnamedb = $dbnamedb;
				// 创建连接
				$this->conn = new mysqli($servernamedb, $usernamedb, $passworddb,$dbnamedb);
				 
				// 检测连接
				if ($this->conn->connect_error) {
				    die("连接失败: " . $this->conn->connect_error);
				} 
				switch ($type) {
					case 'insert':
						{
							//新增数据
							return function($first_name,$last_name) {
					    
						    $sql = "INSERT INTO user (first_name, last_name)
							VALUES ('$first_name', '$last_name')";

							if ($this->conn->query($sql) === TRUE) {
							    echo "新记录插入成功";
							} else {
							    echo "Error: " . $sql . "<br>" . $conn->error;
							}
							$this->conn->close();
						    }; 
						}
						break;
						case 'browse':	
							{
								//查询数据
								$sql = "SELECT id, first_name, last_name FROM user";
								$totoleArr = array();
								$result = $this->conn->query($sql);
								if ($result->num_rows > 0) {
								    // 输出数据
								    while($row = $result->fetch_assoc()) {
								    	$arr = array();
								    	$arr[] = $row["id"];
								    	$arr[] = $row["first_name"];
								    	$arr[] = $row["last_name"];
								    	$totoleArr[] = $arr;
								    }
								} else {
								    echo "0 结果";
								}
							    $arrNow = array('data' => $totoleArr);
								$this->conn->close();
								return json_encode($arrNow);
							}
							break;
							case 'delete':
								{
									//删除
									return function($userId) {
							    
								    $sql = "DELETE FROM user WHERE id='$userId'";
								 
								    if ($this->conn->query($sql)) {
								    	
								        $result = array('code' => '1');
								    	echo json_encode($result);
								    	$this->conn->close();

								    } else {

								    	$result = array('code' => '-1');
								    	echo json_encode($result);
								    }
								    }; 
								}
								break;
								case 'select':
									{
										//查询
										return function($keyWord) {
							    
									    $sql = "SELECT * FROM user WHERE first_name REGEXP '$keyWord'";
									 
									    $totoleArr = array();
										$result = $this->conn->query($sql);
										if ($result->num_rows > 0) {

											// 输出数据
										    while($row = $result->fetch_assoc()) {
										    	$arr = array();
										    	$arr[] = $row["id"];
										    	$arr[] = $row["first_name"];
										    	$arr[] = $row["last_name"];
										    	$totoleArr[] = $arr;
										    }
										    $arrNow = array('code' => '1','data' => $totoleArr);
											$this->conn->close();
											echo json_encode($arrNow);
										} else {

											$result = array('code' => '-1');
											echo json_encode($result);
										}
									    };
									}
									break;
					
					default:
						# code...
						break;
				}
		}   
	}
 ?>