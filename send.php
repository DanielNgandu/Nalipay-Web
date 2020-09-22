<?php

/////////////////////////////////////////////////////////////////////////////////////////////////////
								$total= $_GET['amount'];
								$user_id = $_GET['user_id'];

								$user_balance = "0";
								$user_name = "";
	                               
                                $json=array();

								$phone_number = $_GET['reciever'];
                                $description = "";
                                $$description = $_GET['$description'];

								$recievers_name="";
								$seller_balance = "";

								$Myconnection = new PDO("mysql:host=$serverlocation;dbname=user",$username, $password);
								$Myconnection -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
								$stmt = $Myconnection->prepare("select * from bank where user_id = '$user_id'");
								$stmt->execute();
								$result = $stmt->setFetchMode(PDO::FETCH_ASSOC); 
								foreach($stmt->fetchAll() as $k=>$v) 
								{
									$name =$v["username"];
									$user_balance =$v["balance"];
								}
						        

                                $Myconnection = new PDO("mysql:host=$serverlocation;dbname=user",$username, $password);
								$Myconnection -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
								$stmt = $Myconnection->prepare("select * from user where phone = '$phone_number'");
								$stmt->execute();
								$result = $stmt->setFetchMode(PDO::FETCH_ASSOC); 
								foreach($stmt->fetchAll() as $k=>$v) 
								{
									$user_id1 =$v["id"];
									
								}

								$Myconnection = new PDO("mysql:host=$serverlocation;dbname=user",$username, $password);
								$Myconnection -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
								$stmt = $Myconnection->prepare("select * from user where user_id = '$user_id1'");
								$stmt->execute();
								$result = $stmt->setFetchMode(PDO::FETCH_ASSOC); 
								foreach($stmt->fetchAll() as $k=>$v) 
								{
									$seller_name =$v["username"];
									$seller_balance =$v["balance"];
								}
						
						
							$rudeguy = $user_balance - $total;
							if($rudeguy < 0)
							{
								//echo 'insufitient fund  ';
                                $json[]="insufitient fund";
                                
								echo json_encode($json);
								
							}else
							{
								$niceguy = $total + $seller_balance;
								$Myconnection = new PDO("mysql:host=$serverlocation;dbname=user",$username, $password);
								$Myconnection -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
								$stmt = $Myconnection->prepare("INSERT INTO bank(id,name,balance) VALUES('$id','$seller_name','$niceguy')");
								$stmt->execute();
								
								
								$niceguy = $user_balance - $total;
								$Myconnection = new PDO("mysql:host=$serverlocation;dbname=user",$username, $password);
								$Myconnection -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
								$stmt = $Myconnection->prepare("INSERT INTO bank(user_id,name,balance) VALUES('$user_id','$user_name','$niceguy')");
								$stmt->execute();
								//echo "Transaction completed successfuly";
                                $json[]="Transaction completed successfuly";
                                
								echo json_encode($json);
							}



?>