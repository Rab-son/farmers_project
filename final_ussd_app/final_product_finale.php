<?php

    //Connection Credentials
	$servername = "localhost";
	$username = "root";
	$password = "";
	$database = "farmers_world";
	
	// Create connection
    $db = new mysqli($servername, $username, $password, $database);
    
	// Check connection
    if ($db->connect_error) {
        header('Content-type: text/plain');
        //log error to file/db $e-getMessage()
        die("END An error was encountered. Please try again later");
    } 
		
	//2. receive the POST from browser URL
	$sessionId     =$_POST['sessionId'];
	$phoneNumber   =$_POST['phoneNumber'];
	$serviceCode   =$_POST['serviceCode'];
	$text          =$_POST['text'];
	$location	   =$_POST['text'];	

	//3. Explode the text into an array by separating the input with stars inbetween
	$textArray=explode('*', $text);
	
	//trim the string arra to get the last string entered
	// we pass the response to a variable userResponse
	$userResponse=trim(end($textArray));
	
	//4. Set the default session level to 0
	$level=0;
	
	//5. Check the level of the user from the DataBase and retain default level if none is found for this session
	$sql = "select level from session where session_id ='".$sessionId." '";
	$levelQuery = $db->query($sql);
	if($result = $levelQuery->fetch_assoc()) {
		//setting the session from the database
  		$level = $result['level'];
	}


	//. Check the farmer from the DataBase to verify if the user is registered or not
	$sql6 = "SELECT * FROM farmers WHERE phoneNumber LIKE '%".$phoneNumber."%' LIMIT 1";
	$farmerQuery=$db->query($sql6);
	$farmerAvailable=$farmerQuery->fetch_assoc();
	
	//==========================================CHECKING IF FARMER IS REGISTERED OR NOT ==============================================================	
    //9. Check if the FARMER is available (yes)->Serve the menu; (no)->Register the FARMER
    
    if($farmerAvailable && $farmerAvailable['full_name']!=NULL && $farmerAvailable['id_number']!=NULL){
        if($level==0){
			if($userResponse==""){ //The fisrt string has to be empty at the begginning
			    // Graduate user to next level & Serve Main Menu by setting the level to one in the database
				$sql9b = "INSERT INTO `session`(`session_id`,`phonenumber`,`level`) VALUES('".$sessionId."','".$phoneNumber."',1)";
                $db->query($sql9b);
                
				//Serve our services menu
				$response = "CON Welcome to Farmers World\n";
                $response .= "Please select language\n\n";
                
				$response .= "1) English\n";
                $response .= "2) Chichewa \n";
                
				// Print the response onto the page so that our gateway can read it
				header('Content-type: text/plain');
				echo $response;
			}
        }
      	//Menu 2 Section
        else if($level==1){
			if(!$userResponse==""){			//checking that that the user input is not empty
				switch ($userResponse){ 	// from this point we are using user input as a case variable
					case "1":   			// if the choice is 1 the user go to English version
						if($level==1){
							// Graduate user to level 2
							$sql2="UPDATE `session` SET `level`=2 where `session_id`='".$sessionId."'";
							$db->query($sql2);
							//Menu 2  English
							//Serve English services menu
							$response = "CON  Welcome To Farmers World\n";
							$response .= "Choose Your Desired Option\n\n";

							$response .= "1. Farm Suppliers\n";
							$response .= "2. Markets\n";
							$response .= "3. Advisors\n";
                            $response .= "4. Farm Management\n";
                            $response .= "5. Notifications\n";
							$response .= "6. My Account\n";
							
							// Print the response onto the page so that our gateway can read it
							header('Content-type: text/plain');
							echo $response;
						}
					break;

					case "2": // the choice is 2 the user go to Chichewa version
						if($level==1){
							// Graduate user to level 3
							$sql2a="UPDATE `session` SET `level`=24 where `session_id`='".$sessionId."'";
							$db->query($sql2a);
							//Menu 2 Chichewa 							
							//Serve Chichewa services menu
							$response = "CON Takulandirani Kuno Ku Farmers World\n";
							$response .= "Zikomo Posankha Chichewa \n";
							$response .= "Sankhani Chomwe Mukufuna\n\n";

							$response .= "1. Mitsika{Kogula Katundu}\n";
							$response .= "2. Mitsika{Kogulitsa Katundu}\n";
                     		$response .= "3. Alangizi\n";
                     		$response .= "4. Kusamala Za Kumunda\n";
                     		$response .= "5. Mauthenga\n";
							$response .= "6. Account Yanga\n";
							
							// Print the response onto the page so that our gateway can read it
							header('Content-type: text/plain');
							echo $response;				
						}
					break;

					default:
						if($level==1){
							// Return user to Main Menu & Demote user's level
							$response = "CON wrong option\n";
							$response .= "select language\n";
							$response .= "1) English\n";
							$response .= "2) Chichewa \n";
							
							//update the level to 0 so that the session should start at level 1
							$sql4="UPDATE `session` SET `level`=1 where `session_id`='".$sessionId."'";
							$db->query($sql4);
		
							// Print the response onto the page so that our gateway can read it
							header('Content-type: text/plain');
							echo $response;	
						}
				}
			}
        }    
		//ENGLISH MENU
      	//Menu 2.X Section English Version
        else if($level==2){
            if(!$userResponse==""){			//checking that that the user input is not empty
                switch ($userResponse){
                    //Menu 2.1 	        // from this point we are using user input as a case variable
                    case "1":   			// user will be here if he chooses option 1 in english menu
                        if($level==2){
                           // Graduate user to level 4
                           $sql4="UPDATE `session` SET `level`=3 where `session_id`='".$sessionId."'";
                           $db->query($sql4);
                            
                           $response = "CON Farmers World Farm Suppliers\n"; 
						   $response .= "You Have chosen Suppliers\n\n";
							
                           $response .= "1. Suppliers\n";
                           $response .= "2. Main Menu";
                                                            
                           header('Content-type: text/plain');
                           echo $response;	
                        }
                    break;

                    //Menu 2.2
                    case "2": // user will be here if he chooses option 2 in english menu
                        if($level==2){
                           // Graduate user to level 14
                          	$sql4="UPDATE `session` SET `level`=6 where `session_id`='".$sessionId."'";
                            $db->query($sql4);
                            
                            $response = "CON  Farmers World Market Section\n";
							$response .= "You Have Chosen Markets\n\n"; 
							
                            $response .= "1. View Markets And What They Buy\n";
                            $response .= "2. Main Menu";

                            header('Content-type: text/plain');
                            echo $response;				
                        }
                    break;

                    //Menu 2.3
                    case "3": // user will be here if he chooses option 3 in english menu
                        if($level==2){
                            // Graduate user to level 43
                            $sql4="UPDATE `session` SET `level`=9 where `session_id`='".$sessionId."'";
                            $db->query($sql4);
							
			                $response = "CON Farmers World Advisors\n";
                            $response .= "List of Advisors in Your District\n\n";
                            
                            $sql5 = "SELECT DISTINCT `advisor_name`,`phone_number`,`advisor_location` FROM `advisors` 
									WHERE `advisor_location` IN (SELECT `location` FROM `farmers` WHERE phoneNumber LIKE '%".$phoneNumber."%')
							 		";

                            $advisors=$db->query($sql5);

							$advisorAvailable=$advisors->fetch_assoc();


							if($advisorAvailable && $advisorAvailable['advisor_name']!=NULL && $advisorAvailable['advisor_location']!=NULL){
								foreach($advisors as $index=>$advisors){
                                    $response.= "> ".$advisors['advisor_name']."\t ".$advisors['phone_number']."\n";                                      
                                }
		
							} else {
								$response .= "You have no advisors in your area \n\n"; 
							}				

                                $response.= "1. Main Menu\n";	

							// Print the response onto the page so that our gateway can read it
							header('Content-type: text/plain');
                            echo $response;				
                        }
                    break;

                    //Menu 2.4
                    case "4": // user will be here if he chooses option 4 in english menu
                        if($level==2){
                            // Graduate user to level 7
                            $sql4="UPDATE `session` SET `level`=10 where `session_id`='".$sessionId."'";
                            $db->query($sql4);
                            
                            $response = "CON  Farm Management\n";
                            $response .= "Farm Calculations\n";
							$response .= "Select Crop To Be Produced\n\n";
							
                            $response .= "1. Maize\n";
                            $response .= "2. Cotton\n";
                            $response .= "3. Tobbaco\n";
                            $response .= "4. Main Menu\n";
                            
                            header('Content-type: text/plain');
                            echo $response;				
                        }
                    break;

                     //Menu 2.5
                    case "5": // user will be here if he chooses option 5 in english menu
                        if($level==2){
                            // Graduate user to level 59
                            $sql4="UPDATE `session` SET `level`=15 where `session_id`='".$sessionId."'";
                            $db->query($sql4);
                            
                            $response = "CON Farmers World Notification Section\n";
							$response .= "You Have Choosen Nofications\n\n";
							
                            $response .= "1. Recieved Nofications\n";
                            $response .= "2. Main Menu";
                            
                            header('Content-type: text/plain');
                            echo $response;				
                        }
                    break;

                    //Menu 2.6
                    case "6": // user will be here if he chooses option 5 in english menu
                        if($level==2){
                            // Graduate user to level 62
                            $sql4="UPDATE `session` SET `level`=17 where `session_id`='".$sessionId."'";
                            $db->query($sql4);
                            
                            $response = "CON Farmers World My Acoount Section\n";
							$response .= "You Have Choosen My Account Option\n\n";
							
                            $response .= "1. Change Account Details\n";
                            $response .= "2. Check Account Details\n";
                            $response .= "3. Main Menu";
                            
                            header('Content-type: text/plain');
                            echo $response;				
                        }
                    break;

                    default:
                        if($level==2){
                            // Return user to Main Menu & Demote user's level
                            $response = "CON wrong option\n";
                            $response .= "Please select a service\n";
                            
                            //re-serve english menu in case user chooses wrong option
                            $response .= "Choose Your Desired Option\n\n";
							$response .= "1. Farm Suppliers\n";
							$response .= "2. Markets\n";
							$response .= "3. Advisors\n";
                            $response .= "4. Farm Management\n";
                            $response .= "5. Notifications\n";
							$response .= "6. My Account\n";
                            
                            
                            //update the level to 0 so that the session should start at level 1
                            $sql4="UPDATE `session` SET `level`=2 where `session_id`='".$sessionId."'";
                            $db->query($sql4);
        
                            // Print the response onto the page so that our gateway can read it
                            header('Content-type: text/plain');
                            echo $response;	
                        }
                }
            }
        }        
        //MenU 2.X.1 START 
      	//Menu 2.1.1 English Version
        else if($level==3){
            if(!$userResponse==""){
                switch($userResponse){
                    case "1":
                        if($level==3){							
                        // Graduate user to level 4
                        $sql4="UPDATE `session` SET `level`=4 where `session_id`='".$sessionId."'";
                        $db->query($sql4);

                        $response = "CON  Farm Suppliers\n";
						$response .= "Select one and see what they sale\n\n";
						
                        $response .= "1. Enterprise\n";
                        $response .= "2. Agro-dealers\n";
                        $response .= "3. Invesments\n";
                        $response .= "4. Back\n";
                        $response .= "5. Main Menu\n";
                        
                        
                        // Print the response onto the page so that our gateway can read it
                        header('Content-type: text/plain');
                        echo $response;	
                        }
                    break;

                    case "2":   			// if the choice is 1 the user go to English version
                        if($level==3){
                            // Graduate user to level 2
                            $sql2="UPDATE `session` SET `level`=2 where `session_id`='".$sessionId."'";
                            $db->query($sql2);
                            //Menu 2  English
                            //Serve English services menu
                            $response = "CON  Welcome To Farmers World\n";
							$response .= "Choose Your Desired Option\n\n";
							
                            $response .= "1. Farm Suppliers\n";
                            $response .= "2. Markets\n";
                            $response .= "3. Advisors\n";
                            $response .= "4. Farm Management\n";
                            $response .= "5. Notifications\n";
                            $response .= "6. My Account\n";
                            
                            // Print the response onto the page so that our gateway can read it
                            header('Content-type: text/plain');
                            echo $response;
                        }
                    break;

                    default:
                        if($level==3){
							// Return user to Main Menu & Demote user's level
							$response = "CON Wrong Option, Please Try Again.\n";
                            $response .= "Farmers World Farm Suppliers\n"; 
                            $response .= "You Have chosen Suppliers\n";
                            $response .= "1. Suppliers\n";
                            $response .= "2. Main Menu";
                                                            
                            //update the level to 3 so that the session should start at level 1
                            $sql4="UPDATE `session` SET `level`=3 where `session_id`='".$sessionId."'";
                            $db->query($sql4);

                            // Print the response onto the page so that our gateway can read it
                            header('Content-type: text/plain');
                            echo $response;	
                        }
                }
            }
        }

        else if($level==4){
			if(!$userResponse==""){
				switch($userResponse){
					case "1":
						if($level==4){							
						// Graduate user to level 14
						$sql4="UPDATE `session` SET `level`=5 where `session_id`='".$sessionId."'";
                        $db->query($sql4);

						$response = "CON You have selected Enterprises in your area\n";
						$response .= "The following is what they are selling\n\n";

						$sql5 = "SELECT DISTINCT `product_name`,`selling_price`,`supplier_name` FROM `supplier_products` 
						WHERE (`supplier_location`IN (SELECT `location` FROM `farmers` WHERE phoneNumber LIKE '%".$phoneNumber."%')) AND `supplier_name` LIKE '%Enterprise%' LIMIT 5";																
						$supplier_products=$db->query($sql5);	

						$supplierProductAvailable=$supplier_products->fetch_assoc();

						if($supplierProductAvailable && $supplierProductAvailable['product_name']!=NULL && $supplierProductAvailable['selling_price']!=NULL){
							foreach($supplier_products as $index=>$supplier_products){
								$response.= "> ".$supplier_products['product_name']."\t MK".$supplier_products['selling_price']."\n";                                      
							}
	
						} else {
							$response .= "You have no Enterprises in your area\n\n"; 
						}
	


						$response.= "1. Back\n";
						$response.= "2. Main Menu\n";

						// Print the response onto the page so that our gateway can read it
						header('Content-type: text/plain');
						echo $response;	
						}
                    break;
                    
					case "2":
						if($level==4){							
						// Graduate user to level 14
						$sql4="UPDATE `session` SET `level`=5 where `session_id`='".$sessionId."'";
						$db->query($sql4);

						$response = "CON You have selected Agro-Dealers in your District\n";
						$response .= "The following is what they are selling\n\n";						

						$sql5 = "SELECT DISTINCT `product_name`,`selling_price`,`supplier_name` FROM `supplier_products` 
						WHERE (`supplier_location`IN (SELECT `location` FROM `farmers` WHERE phoneNumber LIKE '%".$phoneNumber."%')) AND `supplier_name` LIKE '%Agro%' LIMIT 5";																
						$supplier_products=$db->query($sql5);
						$supplierProductAvailable=$supplier_products->fetch_assoc();

						if($supplierProductAvailable && $supplierProductAvailable['product_name']!=NULL && $supplierProductAvailable['selling_price']!=NULL){
							foreach($supplier_products as $index=>$supplier_products){
								$response.= "> ".$supplier_products['product_name']."\t MK".$supplier_products['selling_price']."\n";                                      
							}
	
						} else {
							$response .= "You have no Agro-Dealers in your area\n\n"; 
						}
	

						$response .= "1. Back\n";
						$response .= "2. Main Menu\n";						

						// Print the response onto the page so that our gateway can read it
						header('Content-type: text/plain');
						echo $response;	
						}
                    break;

					case "3":
						if($level==4){							
						// Graduate user to level 14
						$sql4="UPDATE `session` SET `level`=5 where `session_id`='".$sessionId."'";
						$db->query($sql4);
						
						$response = "CON You have selected Investments in your District\n";
						$response .= "The following is what they are selling\n\n";

						$sql5 = "SELECT DISTINCT `product_name`,`selling_price`,`supplier_name` FROM `supplier_products` 
						WHERE (`supplier_location`IN (SELECT `location` FROM `farmers` WHERE phoneNumber LIKE '%".$phoneNumber."%')) AND `supplier_name` LIKE '%Investment%' LIMIT 5";																
						$supplier_products=$db->query($sql5);

						$supplierProductAvailable=$supplier_products->fetch_assoc();

						if($supplierProductAvailable && $supplierProductAvailable['product_name']!=NULL && $supplierProductAvailable['selling_price']!=NULL){
							foreach($supplier_products as $index=>$supplier_products){
								$response.= "> ".$supplier_products['product_name']."\t MK".$supplier_products['selling_price']."\n";                                      
							}
	
						} else {
							$response .= "You have no Investments in your area\n\n"; 
						}
	
	
						$response .= "1. Back\n";
						$response .= "2. Main Menu\n";

						// Print the response onto the page so that our gateway can read it
						header('Content-type: text/plain');
						echo $response;	
						}
                    break;

                    case "4":   			// user will be here if he chooses option 1 in english menu
                        if($level==4){
                           // Graduate user to level 4
                           $sql4="UPDATE `session` SET `level`=3 where `session_id`='".$sessionId."'";
                           $db->query($sql4);
                            
                           $response = "CON Farmers World Farm Suppliers\n"; 
						   $response .= "You Have chosen Suppliers\n\n";
							
                           $response .= "1. Suppliers\n";
                           $response .= "2. Main Menu";
                                                            
                           header('Content-type: text/plain');
                           echo $response;	
                        }
                    break;

                    case "5":
						if($level==4){	
						   // Graduate user to level 1
						   $sql4="UPDATE `session` SET `level`=2 where `session_id`='".$sessionId."'";
						   $db->query($sql4);

						   //Menu 2  English
						   //Serve English services menu
						   $response = "CON  Welcome To Farmers World\n";
						   $response .= "Choose Your Desired Option\n\n";

						   $response .= "1. Farm Suppliers\n";
						   $response .= "2. Markets\n";
						   $response .= "3. Advisors\n";
                     	   $response .= "4. Farm Management\n";
                     	   $response .= "5. Notifications\n";
						   $response .= "6. My Account\n";					
						
							// Print the response onto the page so that our gateway can read it
							header('Content-type: text/plain');
							echo $response;	
						}
                    break;
                    
					default:
						if($level==4){
							// Return user to Main Menu & Demote user's level
							$response = "CON Wrong Option\n";
                            $response .= "Farm Suppliers\n";
                            $response .= "Select one and see what they sale\n\n";
                            
                            $response .= "1. Enterprise\n";
                            $response .= "2. Agro-dealers\n";
                            $response .= "3. Invesments\n";
                            $response .= "4. Back\n";
                            $response .= "5. Main Menu\n";
							
							//update the level to 0 so that the session should start at level 1
							$sql4="UPDATE `session` SET `level`=4 where `session_id`='".$sessionId."'";
							$db->query($sql4);

							// Print the response onto the page so that our gateway can read it
							header('Content-type: text/plain');
							echo $response;	
						}
				}
			}
        }

        else if($level==5){
			if(!$userResponse==""){
				
				switch($userResponse){
					case "1":
						if($level==5){							
                            $sql4="UPDATE `session` SET `level`=4 where `session_id`='".$sessionId."'";
                            $db->query($sql4);
    
                            $response = "CON  Farm Suppliers\n";
                            $response .= "Select one and see what they sale\n\n";
                            
                            $response .= "1. Enterprise\n";
                            $response .= "2. Agro-dealers\n";
                            $response .= "3. Invesments\n";
                            $response .= "4. Back\n";
                            $response .= "5. Main Menu\n";

						// Print the response onto the page so that our gateway can read it
						header('Content-type: text/plain');
						echo $response;	
						}
					break;

					case "2":   			// returns the user to the main menu
						if($level==5){
							// Graduate user to level 2
							$sql2="UPDATE `session` SET `level`=2 where `session_id`='".$sessionId."'";
							$db->query($sql2);
							
							//Menu 2  English
							//Serve English services menu
							$response = "CON  Welcome To Farmers World\n";
							$response .= "Choose Your Desired Option\n\n";
							$response .= "1. Farm Suppliers\n";
							$response .= "2. Markets\n";
							$response .= "3. Advisors\n";
							$response .= "4. Farm Management\n";
							$response .= "5. Notifications\n";
							$response .= "6. My Account\n";

							
							// Print the response onto the page so that our gateway can read it
							header('Content-type: text/plain');
							echo $response;
						}
					break;

					default:
						if($level==5){
							// Return user to Main Menu & Demote user's level
							
							$response = "END Wrong Option, Please Try Again\n";
							
							// Print the response onto the page so that our gateway can read it
							header('Content-type: text/plain');
							echo $response;	
						}
				}		
			}
        }

		else if($level==6){
			if(!$userResponse==""){
				switch($userResponse){
					case "1":
						if($level==6){							
							// Graduate user to level 15
							$sql4="UPDATE `session` SET `level`=7 where `session_id`='".$sessionId."'";
							$db->query($sql4);
		
							$response = "CON List of Available Markets\n";
							$response .= "Please Select One\n\n";
		
							$response .= "1. ADMARC\n";
							$response .= "2. AGORA\n";
							$response .= "3. Agro-Dealers\n";
							$response .= "4. Back\n";
							$response .= "5. Main Menu\n";
		
							// Print the response onto the page so that our gateway can read it
							header('Content-type: text/plain');
							echo $response;	
						}
					break;
							
					case "2":   			// if the choice is 1 the user go to nglish version
						if($level==6){
							// Graduate user to level 2
							$sql2="UPDATE `session` SET `level`=2 where `session_id`='".$sessionId."'";
							$db->query($sql2);
									
							// Menu 2  English
							//Serve English services menu
							$response = "CON  Welcome To Farmers World\n";
							$response .= "Choose Your Desired Option\n\n";
							$response .= "1. Farm Suppliers\n";
							$response .= "2. Markets\n";
							$response .= "3. Advisors\n";
							$response .= "4. Farm Management\n";
							$response .= "5. Notifications\n";
							$response .= "6. My Account\n";
										
							// Print the response onto the page so that our gateway can read it
							header('Content-type: text/plain');
							echo $response;
						}
					break;
		
					default:
						if($level==6){
						// Return user to Main Menu & Demote user's level
							$response = "CON Wrong Option\n";
							$response .= "Farmers World Market Section\n";
							$response .= "You Have Chosen Markets\n\n"; 
							
                            $response .= "1. View Markets And What They Buy\n";
                            $response .= "2. Main Menu";

							//update the level to 0 so that the session should start at level 1
							$sql4="UPDATE `session` SET `level`=6 where `session_id`='".$sessionId."'";
							$db->query($sql4);
		
							// Print the response onto the page so that our gateway can read it
							header('Content-type: text/plain');
							echo $response;	
						}
					
				}
			}
        }
        
		else if($level==7){
			if(!$userResponse==""){
				switch($userResponse){
					case "1":
						if($level==7){							
						// Graduate user to level 14
						$sql4="UPDATE `session` SET `level`=8 where `session_id`='".$sessionId."'";
                        $db->query($sql4);
                        
						$response = "CON ADMARC in your area\n";
						$response .= "The following is what they are buying\n\n";                     
                        
						$sql5 = "SELECT DISTINCT `product_name`,`selling_price`,`buying_price`,`mark_name` FROM `market_products` 
						WHERE (`mark_location`IN (SELECT `location` FROM `farmers` WHERE phoneNumber LIKE '%".$phoneNumber."%')) AND `mark_name` LIKE '%ADMARC%' LIMIT 5";																
						$market_products=$db->query($sql5);

						$marketProductAvailable=$market_products->fetch_assoc();

						if($marketProductAvailable && $marketProductAvailable['product_name']!=NULL && $marketProductAvailable['selling_price']!=NULL){
							foreach($market_products as $index=>$market_products){
								$response.= "> ".$market_products['product_name']."\t MK".$market_products['selling_price']."\n";                                      
							}
	
						} else {
							$response .= "You have no Admarc in your area\n\n"; 
						}				

						$response .= "1. Back\n";
						$response .= "2. Main Menu\n";

						// Print the response onto the page so that our gateway can read it
						header('Content-type: text/plain');
						echo $response;	
						}
                    break;
                    
					case "2":
						if($level==7){							
						// Graduate user to level 14
						$sql4="UPDATE `session` SET `level`=8 where `session_id`='".$sessionId."'";
						$db->query($sql4);
						
						$response = "CON AGORA in your area\n";
						$response .= "The following is what they are buying\n\n";
                        
						$sql5 = "SELECT DISTINCT `product_name`,`selling_price`,`buying_price`,`mark_name` FROM `market_products` 
						WHERE (`mark_location`IN (SELECT `location` FROM `farmers` WHERE phoneNumber LIKE '%".$phoneNumber."%')) AND `mark_name` LIKE '%AGORA%' LIMIT 5";																
						$market_products=$db->query($sql5);

						$marketProductAvailable=$market_products->fetch_assoc();

						if($marketProductAvailable && $marketProductAvailable['product_name']!=NULL && $marketProductAvailable['selling_price']!=NULL){
							foreach($market_products as $index=>$market_products){
								$response.= "> ".$market_products['product_name']."\t MK".$market_products['selling_price']."\n";                                      
							}
	
						} else {
							$response .= "You have no Agora Shops in your area\n\n"; 
						}				

						$response .= "1. Back\n";
						$response .= "2. Main Menu\n";

						// Print the response onto the page so that our gateway can read it
						header('Content-type: text/plain');
						echo $response;	
						}
                    break;

					case "3":
						if($level==7){							
						// Graduate user to level 14
						$sql4="UPDATE `session` SET `level`=8 where `session_id`='".$sessionId."'";
                        $db->query($sql4);

						$response = "CON Agro-Dealers in your District\n";
						$response .= "The following is what they ae selling\n\n";
                        
						$sql5 = "SELECT DISTINCT `product_name`,`selling_price`,`buying_price`,`mark_name` FROM `market_products` 
						WHERE (`mark_location`IN (SELECT `location` FROM `farmers` WHERE phoneNumber LIKE '%".$phoneNumber."%')) AND `mark_name` LIKE '%AGORA%' LIMIT 5";																
						$market_products=$db->query($sql5);

						$marketProductAvailable=$market_products->fetch_assoc();

						if($marketProductAvailable && $marketProductAvailable['product_name']!=NULL && $marketProductAvailable['selling_price']!=NULL){
							foreach($market_products as $index=>$market_products){
								$response.= "> ".$market_products['product_name']."\t MK".$market_products['selling_price']."\n";                                      
							}
	
						} else {
							$response .= "You have no Agro-Dealers in your area\n\n"; 
						}				


						$response .= "1. Back\n";
						$response .= "2. Main Menu\n";
						// Print the response onto the page so that our gateway can read it
						header('Content-type: text/plain');
						echo $response;	
						}
                    break;

					case "4": // user will be here if he chooses option 2 in english menu
						if($level==7){
							// Graduate user to level 5
							$sql4="UPDATE `session` SET `level`=6 where `session_id`='".$sessionId."'";
							$db->query($sql4);

							$response = "CON  Farmers World Market Section\n";
                            $response .= "You Have Chosen Markets\n\n";
                            
							$response .= "1. View Markets And What They Buy\n";
							$response .= "2. Main Menu";

							header('Content-type: text/plain');
							echo $response;				
							}
					break;

					case "5":
						if($level==7){
							// Graduate user to level 2
							$sql2="UPDATE `session` SET `level`=2 where `session_id`='".$sessionId."'";
							$db->query($sql2);
									
							// Menu 2  English
							//Serve English services menu
							$response = "CON  Welcome To Farmers World\n";
							$response .= "Choose Your Desired Option\n\n";
							$response .= "1. Farm Suppliers\n";
							$response .= "2. Markets\n";
							$response .= "3. Advisors\n";
							$response .= "4. Farm Management\n";
							$response .= "5. Notifications\n";
							$response .= "6. My Account\n";
										
							// Print the response onto the page so that our gateway can read it
							header('Content-type: text/plain');
							echo $response;
						}
					break;

					default:
						if($level==7){
							// Return user to Main Menu & Demote user's level
							$response = "CON Wrong Option\n";
							$response .= "List of Available Markets\n";
							$response .= "Please Select One\n\n";
		
							$response .= "1. ADMARC\n";
							$response .= "2. AGORA\n";
							$response .= "3. Agro-Dealers\n";
							$response .= "4. Back\n";
							$response .= "5. Main Menu\n";

							//update the level to 0 so that the session should start at level 1
							$sql4="UPDATE `session` SET `level`=7 where `session_id`='".$sessionId."'";
							$db->query($sql4);

							// Print the response onto the page so that our gateway can read it
							header('Content-type: text/plain');
							echo $response;	
						}
				}
			}
        }
        
        else if($level==8){
			if(!$userResponse==""){
				
				switch($userResponse){
					case "1":
						if($level==8){							
                            $sql4="UPDATE `session` SET `level`=7 where `session_id`='".$sessionId."'";
                            $db->query($sql4);
    
							$response = "CON List of Available Markets\n";
							$response .= "Please Select One\n\n";
		
							$response .= "1. ADMARC\n";
							$response .= "2. AGORA\n";
							$response .= "3. Agro-Dealers\n";
							$response .= "4. Back\n";
							$response .= "5. Main Menu\n";

						// Print the response onto the page so that our gateway can read it
						header('Content-type: text/plain');
						echo $response;	
						}
					break;

					case "2":   			// returns the user to the main menu
						if($level==8){
							// Graduate user to level 2
							$sql2="UPDATE `session` SET `level`=2 where `session_id`='".$sessionId."'";
							$db->query($sql2);
							
							//Menu 2  English
							//Serve English services menu
							$response = "CON  Welcome To Farmers World\n";
							$response .= "Choose Your Desired Option\n\n";
							$response .= "1. Farm Suppliers\n";
							$response .= "2. Markets\n";
							$response .= "3. Advisors\n";
							$response .= "4. Farm Management\n";
							$response .= "5. Notifications\n";
							$response .= "6. My Account\n";

							
							// Print the response onto the page so that our gateway can read it
							header('Content-type: text/plain');
							echo $response;
						}
					break;

					default:
						if($level==8){
							// Return user to Main Menu & Demote user's level
							
							$response = "END Wrong Option, Please Try Again\n";
							
							// Print the response onto the page so that our gateway can read it
							header('Content-type: text/plain');
							echo $response;	
						}
				}		
			}
        }        
        else if($level==9){
			if(!$userResponse==""){			//checking that that the user input is not empty
				switch ($userResponse){ 	// from this point we are using user input as a case variable
					case "1":   			// if the choice is 1 the user go to nglish version
						if($level==9){
							//9b. Graduate user to level 2
							$sql2="UPDATE `session` SET `level`=2 where `session_id`='".$sessionId."'";
							$db->query($sql2);
							
							// Menu 2  English
							//Serve English services menu
							$response = "CON  Welcome To Farmers World\n";
							$response .= "Choose Your Desired Option\n\n";

							$response .= "1. Farm Suppliers\n";
							$response .= "2. Markets\n";
							$response .= "3. Advisors\n";
                            $response .= "4. Farm Management\n";
                            $response .= "5. Notifications\n";
							$response .= "6. My Account\n";
							
							// Print the response onto the page so that our gateway can read it
							header('Content-type: text/plain');
							echo $response;
						}
					break;

					default:
						if($level==9){
							// Return user to Main Menu & Demote user's level
                            $response = "CON Wrong Options\n";
 

							
							//update the level to 0 so that the session should start at level 1
							$sql4="UPDATE `session` SET `level`=9 where `session_id`='".$sessionId."'";
							$db->query($sql4);
		
							// Print the response onto the page so that our gateway can read it
							header('Content-type: text/plain');
							echo $response;	
						}
				}
			}
		}
		
		//Menu 4. FarmManagement
        else if($level==10){
			if(!$userResponse==""){
				switch($userResponse){
					case "1":
						if($level==10){							
						// Graduate user to level 51
						$sql4="UPDATE `session` SET `level`=11 where `session_id`='".$sessionId."'";
						$db->query($sql4);
						
						$response = "CON  Farm Managemen\n";
                        $response .= "Maize\n";                        
                        $response .= "Choose Quantity of Bag\n\n";
                        
						$response .= "1. 50Kg\n";
						$response .= "2. 70Kg\n";
						$response .= "3. Back\n";							
						$response .= "4. Main Menu\n";             
						
						// Print the response onto the page so that our gateway can read it
						header('Content-type: text/plain');
						echo $response;	
						}
					break;

					case "2":
						if($level==10){							
						// Graduate user to level 53
						$sql4="UPDATE `session` SET `level`=26 where `session_id`='".$sessionId."'";
						$db->query($sql4);
						
						$response = "CON  Farm Management\n";
						$response .= "Cotton\n";
                        $response .= "Choose Quantity of Bag\n\n";
                        
						$response .= "1. 50Kg\n";
						$response .= "2. 70Kg\n";
						$response .= "3. Back\n";							
						$response .= "4. Main Menu\n";    
						
						// Print the response onto the page so that our gateway can read it
						header('Content-type: text/plain');
						echo $response;	
						}
					break;

					case "3":
						if($level==10){							
						// Graduate user to level 55
						$sql4="UPDATE `session` SET `level`=31 where `session_id`='".$sessionId."'";
						$db->query($sql4);
						
						$response = "CON  Farm Management Implementation\n";
						$response .= "Tobbaco\n";
                        $response .= "Choose Quantity of Bale\n\n";
                        
						$response .= "1. 50Kg\n";
						$response .= "2. 70Kg\n";
						$response .= "3. Back\n";							
						$response .= "4. Main Menu\n";  
						
						// Print the response onto the page so that our gateway can read it
						header('Content-type: text/plain');
						echo $response;	
						}
                    break;
                    
					case "4":
						if($level==10){							
							// Graduate user to level 2
							$sql4="UPDATE `session` SET `level`=2 where `session_id`='".$sessionId."'";
							$db->query($sql4);
						
							// Menu 2  English
							//Serve English services menu
							$response = "CON  Welcome To Farmers World\n";
							$response .= "Choose Your Desired Option\n\n";
							
							$response .= "1. Farm Suppliers\n";
							$response .= "2. Markets\n";
							$response .= "3. Advisors\n";
							$response .= "4. Farm Management\n";
							$response .= "5. Notifications\n";
							$response .= "6. My Account\n";
						
							// Print the response onto the page so that our gateway can read it
							header('Content-type: text/plain');
							echo $response;	
						}
					break;

					default:
						if($level==10){
							// Return user to Main Menu & Demote user's level
							$response = "CON Wrong Option\n";
							$response .= "Farm Management\n";
							$response .= "Select Crop To Be Produced\n\n";

							$response .= "1. Maize\n";
							$response .= "2. Cotton\n";
							$response .= "3. Tobbaco\n";
							$response .= "4. Main Menu\n";
														
							//update the level to 0 so that the session should start at level 1
							$sql4="UPDATE `session` SET `level`=10 where `session_id`='".$sessionId."'";
							$db->query($sql4);

							// Print the response onto the page so that our gateway can read it
							header('Content-type: text/plain');
							echo $response;	
						}
				}
			}
		}
		//Menu 4*2. Farm Management of Maize 
        else if($level==11){
			if(!$userResponse==""){
				switch($userResponse){
					case "1":
						if($level==11){
							
							// Graduate user to level 64
							$sql4="UPDATE `session` SET `level`=12 where `session_id`='".$sessionId."'";
							$db->query($sql4);

                            $response = "CON Farm Management\n";
                            $response .= "Maize\n\n";
							$response .= "Enter Amount of 50Kg Bags\n\n";				
							
							// Print the response onto the page so that our gateway can read it
							header('Content-type: text/plain');
							echo $response;	
						}
					break;
					case "2":
						if($level==11){
																				
							// Graduate user to level 14
							$sql4="UPDATE `session` SET `level`=14 where `session_id`='".$sessionId."'";
							$db->query($sql4);

                            $response = "CON Farm Management\n";
                            $response .= "Maize\n\n";
                            $response .= "Enter Amount of 70Kg Bags\n\n";
						
							// Print the response onto the page so that our gateway can read it
							header('Content-type: text/plain');
							echo $response;	
						}
                    break;

                    case "3": // user will be here if he chooses option 4 in english menu
                        if($level==11){
                            // Graduate user to level 7
                            $sql4="UPDATE `session` SET `level`=10 where `session_id`='".$sessionId."'";
                            $db->query($sql4);
                            
                            $response = "CON  Farm Management\n";
                            $response .= "Farm Calculations\n";
							$response .= "Select Crop To Be Produced\n\n";
							
                            $response .= "1. Maize\n";
                            $response .= "2. Cotton\n";
                            $response .= "3. Tobbaco\n";
                            $response .= "4. Main Menu\n";
                            
                            header('Content-type: text/plain');
                            echo $response;				
                        }
                    break;
										
                    case "4":   			// if the choice is 1 the user go to English version
                        if($level==11){
                            // Graduate user to level 2
                            $sql2="UPDATE `session` SET `level`=2 where `session_id`='".$sessionId."'";
                            $db->query($sql2);
                            //Menu 2  English
                            //Serve English services menu
                            $response = "CON  Welcome To farmerss World\n";
							$response .= "Choose Your Desired Option\n\n";
							
                            $response .= "1. Farm Suppliers\n";
                            $response .= "2. Markets\n";
                            $response .= "3. Advisors\n";
                            $response .= "4. Farm Management\n";
                            $response .= "5. Notifications\n";
                            $response .= "6. My Account\n";
                            
                            // Print the response onto the page so that our gateway can read it
                            header('Content-type: text/plain');
                            echo $response;
                        }
                    break;
					default:
						if($level==11){
							// Return user to Main Menu & Demote user's level
							$response = "CON Wrong Option\n";
                            $response .= "Farm Managemen\n";
                            $response .= "Maize\n";                        
                            $response .= "Choose Quantity of Bag\n\n";
                            
                            $response .= "1. 50Kg\n";
							$response .= "2. 70Kg\n";
							$response .= "3. Back\n";							
                            $response .= "4. Main Menu\n"; 

							//update the level to 0 so that the session should start at level 1
							$sql4="UPDATE `session` SET `level`=11 where `session_id`='".$sessionId."'";
							$db->query($sql4);

							// Print the response onto the page so that our gateway can read it
							header('Content-type: text/plain');
							echo $response;	
						}
				}
			}
		}
		else if($level==12){
			if(!$userResponse==""){
				
				// Graduate user to level 64
				$sql4="UPDATE `session` SET `level`=13 where `session_id`='".$sessionId."'";
				$db->query($sql4);

				$maizeYieldOf50kgs = $userResponse * 0.016;
				$npkBags = 0.0224 * $userResponse;
				$ureaBags = 0.0224 * $userResponse;

                $response = "CON Farm Management\n\n";
                
				$response .="For $userResponse Maize Bag(s) of 50Kgs, You will need:\n>. $maizeYieldOf50kgs hectares of land\n>. $npkBags NPK Fertilizer Bag(s)\n>. $ureaBags Urea Fertilizer Bag(s)\n>. Moderate rainfall.\n\n";

				$response .= "1. Back\n";
				$response .= "2. Main Menu\n";
					
				// Print the response onto the page so that our gateway can read it
				header('Content-type: text/plain');
				echo $response;
				
			}
		}
		else if($level==13){
			if(!$userResponse==""){			//checking that that the user input is not empty
				switch ($userResponse){ 	// from this point we are using user input as a case variable
					case "1":
						if($level==13){							
						// Graduate user to level 64
						$sql4="UPDATE `session` SET `level`=11 where `session_id`='".$sessionId."'";
						$db->query($sql4);

						$response = "CON  Farm Managemen\n";
                        $response .= "Maize\n";                        
                        $response .= "Choose Quantity of Bag\n\n";
                        
						$response .= "1. 50Kg\n";
						$response .= "2. 70Kg\n";
						$response .= "3. Back\n";							
						$response .= "4. Main Menu\n"; 

						// Print the response onto the page so that our gateway can read it
						header('Content-type: text/plain');
						echo $response;	
						}
					break;
					case "2":   			// if the choice is 2 the user go to nglish version
						if($level==13){
							// Graduate user to level 2
							$sql2="UPDATE `session` SET `level`=2 where `session_id`='".$sessionId."'";
							$db->query($sql2);
							// Menu 2  English
							//Serve English services menu
							$response = "CON  Welcome To farmerss World\n";
							$response .= "Choose Your Desired Option\n\n";
							
							$response .= "1. Farm Suppliers\n";
							$response .= "2. Markets\n";
							$response .= "3. Advisors\n";
							$response .= "4. Farm Management\n";
							$response .= "5. Notifications\n";
							$response .= "6. My Account\n";
							
							// Print the response onto the page so that our gateway can read it
							header('Content-type: text/plain');
							echo $response;
						}
					break;

					default:
						if($level==13){

            
                            $response = "CON Wrong Option, please try Again\n\n";
			
							$response .= "1. Back\n";
							$response .= "2. Main Menu\n";
							
							//update the level to 0 so that the session should start at level 1
							$sql4="UPDATE `session` SET `level`=13 where `session_id`='".$sessionId."'";
							$db->query($sql4);
		
							// Print the response onto the page so that our gateway can read it
							header('Content-type: text/plain');
							echo $response;	
						}
				}
			}
        }        
		else if($level==14){
			if(!$userResponse==""){
				
				// Graduate user to level 64
				$sql4="UPDATE `session` SET `level`=25 where `session_id`='".$sessionId."'";
				$db->query($sql4);

				$maizeYieldOf70kgs = $userResponse * 0.0224;
				$npkBags = 0.04 * $userResponse;
				$ureaBags = 0.04 * $userResponse;
				
				$response = "CON Farm Management\n\n";
                
				$response .="For $userResponse Maize Bag(s) of 70Kgs, You will need:\n>. $maizeYieldOf70kgs hectares of land\n>. $npkBags NPK Fertilizer Bag(s)\n>. $ureaBags Urea Fertilizer Bag(s)\n>. Moderate rainfall.\n\n";

				$response .= "1. Back\n";
				$response .= "2. Main Menu\n";
					
				// Print the response onto the page so that our gateway can read it
				header('Content-type: text/plain');
				echo $response;
				
			}
		}
		else if($level==25){
			if(!$userResponse==""){			//checking that that the user input is not empty
				switch ($userResponse){ 	// from this point we are using user input as a case variable
					case "1":
						if($level==25){							
						// Graduate user to level 64
						$sql4="UPDATE `session` SET `level`=11 where `session_id`='".$sessionId."'";
						$db->query($sql4);

						$response = "CON  Farm Managemen\n";
                        $response .= "Maize\n";                        
                        $response .= "Choose Quantity of Bag\n\n";
                        
						$response .= "1. 50Kg\n";
						$response .= "2. 70Kg\n";
						$response .= "3. Back\n";							
						$response .= "4. Main Menu\n"; 

						// Print the response onto the page so that our gateway can read it
						header('Content-type: text/plain');
						echo $response;	
						}
					break;
					case "2":   			// if the choice is 2 the user go to nglish version
						if($level==25){
							// Graduate user to level 2
							$sql2="UPDATE `session` SET `level`=2 where `session_id`='".$sessionId."'";
							$db->query($sql2);
							// Menu 2  English
							//Serve English services menu
							$response = "CON  Welcome To farmerss World\n";
							$response .= "Choose Your Desired Option\n\n";
							
							$response .= "1. Farm Suppliers\n";
							$response .= "2. Markets\n";
							$response .= "3. Advisors\n";
							$response .= "4. Farm Management\n";
							$response .= "5. Notifications\n";
							$response .= "6. My Account\n";
							
							// Print the response onto the page so that our gateway can read it
							header('Content-type: text/plain');
							echo $response;
						}
					break;

					default:
						if($level==25){
                            $sql5 = "SELECT `received_message` FROM ussd_notifications WHERE phonenumber LIKE '%".$phoneNumber."%' LIMIT 1";
                            $fQuery=$db->query($sql5);
                            $Available=$fQuery->fetch_assoc();
            
                            $response = "CON Wrong Option, please try Again\n\n";
							$response .= "Farm Management\n\n";
                
							$response .="For $userResponse Maize Bag(s) of 70Kgs, You will need:\n>. $maizeYieldOf70kgs hectares of land\n>. $npkBags NPK Fertilizer Bag(s)\n>. $ureaBags Urea Fertilizer Bag(s)\n>. Moderate rainfall.\n\n";
			
							$response .= "1. Back\n";
							$response .= "2. Main Menu\n";
							
							//update the level to 0 so that the session should start at level 1
							$sql4="UPDATE `session` SET `level`=25 where `session_id`='".$sessionId."'";
							$db->query($sql4);
		
							// Print the response onto the page so that our gateway can read it
							header('Content-type: text/plain');
							echo $response;	
						}
				}
			}
		}
		
		//Menu 5. Notifications
		else if($level==15){
            if(!$userResponse==""){
                switch($userResponse){
                    case "1":
                        if($level==15){							
                            // Graduate user to level 4
                            $sql4="UPDATE `session` SET `level`=16 where `session_id`='".$sessionId."'";
                            $db->query($sql4);                    


							$sql5 = "SELECT DISTINCT `sent_message`,`farmer_id`,`created_at`
									 FROM `ussd_notifications`
									 WHERE `farmer_id` IN ( SELECT `id` FROM 
									`farmers` WHERE phoneNumber LIKE '%".$phoneNumber."%')
									ORDER BY `created_at` DESC
									LIMIT 1";

							$ussd_notifications=$db->query($sql5);

							$notificationAvailable=$ussd_notifications->fetch_assoc();
							
							$response = "CON Notifications\n";
							$response .= "Your Recent Notification\n\n";
							if($notificationAvailable && $notificationAvailable['sent_message']!=NULL && $notificationAvailable['farmer_id']!=NULL){
								foreach($ussd_notifications as $index=>$ussd_notifications){
                                    $response.= ">. ".$ussd_notifications['sent_message']."\n\n";                                      
                                }
		
							} else {
								$response .= "You have no notifications \n\n"; 
							}				


							$response.= "1. Back\n";
							$response.= "2. Main Menu\n";

							// Print the response onto the page so that our gateway can read it
							header('Content-type: text/plain');
							echo $response;
                        }    
                    break;

                    case "2":   			// if the choice is 1 the user go to English version
                        if($level==15){
                            // Graduate user to level 2
                            $sql2="UPDATE `session` SET `level`=2 where `session_id`='".$sessionId."'";
                            $db->query($sql2);
                            //Menu 2  English
                            //Serve English services menu
                            $response = "CON  Welcome To Farmers World\n";
							$response .= "Choose Your Desired Option\n\n";
							
                            $response .= "1. Farm Suppliers\n";
                            $response .= "2. Markets\n";
                            $response .= "3. Advisors\n";
                            $response .= "4. Farm Management\n";
                            $response .= "5. Notifications\n";
                            $response .= "6. My Account\n";
                            
                            // Print the response onto the page so that our gateway can read it
                            header('Content-type: text/plain');
                            echo $response;
                        }
                    break;

                    default:
                        if($level==15){
							      // Return user to Main Menu & Demote user's level
							
							$response = "CON Wrong Option,Please Try Again\n";
							$response .= "Farmers World Notification Section\n";
                        	$response .= "You Have Choosen Nofications\n\n";
                     
                            $response .= "1. Recieve Nofications\n";
                            $response .= "2. Main Menu";
                                                            
                            //update the level to 0 so that the session should start at level 1
                            $sql4="UPDATE `session` SET `level`=59 where `session_id`='".$sessionId."'";
                            $db->query($sql4);

                            // Print the response onto the page so that our gateway can read it
                            header('Content-type: text/plain');
                            echo $response;	
                        }
                }
            }
		}
		else if($level==16){
			if(!$userResponse==""){			//checking that that the user input is not empty
				switch ($userResponse){ 	// from this point we are using user input as a case variable
					case "1": // user will be here if he chooses option 5 in english menu
                        if($level==16){
                            // Graduate user to level 59
                            $sql4="UPDATE `session` SET `level`=15 where `session_id`='".$sessionId."'";
                            $db->query($sql4);
                            
                            $response = "CON Farmers World Notification Section\n";
							$response .= "You Have Choosen Nofications\n\n";
							
                            $response .= "1. Recieved Nofications\n";
                            $response .= "2. Main Menu";
                            
                            header('Content-type: text/plain');
                            echo $response;				
                        }
                    break;
					case "2": // the choice is 2 the user go to Chichewa version
						if($level==16){
							// Graduate user to level 2
							$sql2="UPDATE `session` SET `level`=2 where `session_id`='".$sessionId."'";
							$db->query($sql2);
							// Menu 2  English
							//Serve English services menu
							$response = "CON  Welcome To farmerss World\n";
							$response .= "Choose Your Desired Option\n\n";
							
							$response .= "1. Farm Suppliers\n";
							$response .= "2. Markets\n";
							$response .= "3. Advisors\n";
							$response .= "4. Farm Management\n";
							$response .= "5. Notifications\n";
							$response .= "6. My Account\n";
							// Print the response onto the page so that our gateway can read it
							header('Content-type: text/plain');
							echo $response;				
						}
					break;

					default:
						if($level==16){
							// Return user to Main Menu & Demote user's level
							$response = "CON farmerss World\n";
							$response .= "Wrong Ption Please try Again\n\n";
							
							// Print the response onto the page so that our gateway can read it
							header('Content-type: text/plain');
							echo $response;	
						}
				}
			}
        }
        
        //My Account Menu
		else if($level==17){
			if(!$userResponse==""){
				switch($userResponse){
					case "1":
						if($level==17){							
						// Graduate user to level 14
						$sql4="UPDATE `session` SET `level`=18 where `session_id`='".$sessionId."'";
						$db->query($sql4);

						$response = "CON My Account Updation Section\n";
						$response .= "Change Account Details\n\n";

						$response .= "1. Change Name\n";
						$response .= "2. Change Location\n";
						$response .= "3. Back\n";
						$response .= "4. Main Menu\n";

						// Print the response onto the page so that our gateway can read it
						header('Content-type: text/plain');
						echo $response;	
						}
					break;
					case "2":
						if($userResponse){
						// Graduate user to level 14
						$sql4="UPDATE `session` SET `level`=23 where `session_id`='".$sessionId."'";
						$db->query($sql4);

						$sql5 = "SELECT * FROM farmers WHERE phonenumber LIKE '%".$phoneNumber."%' LIMIT 1";
						$fQuery=$db->query($sql5);
						$Available=$fQuery->fetch_assoc();

						$response = "CON Check Acount Details\n";
						$response .= "My Account Details\n\n";

						$response .= "Full Name     \t: ".$Available['full_name']."\n";
						$response .= "ID Number  	\t: ".$Available['id_number']."\n";
						$response .= "Phone Number  \t: ".$Available['phonenumber']."\n";	
						$response .= "Location	\t: ".$Available['location']."\n\n";

						$response .= "1. Back\n";
						$response .= "2. Main Menu\n";
						

						// Print the response onto the page so that our gateway can read it
						header('Content-type: text/plain');
						echo $response;

						}
					break;

					case "3": // the choice is 2 the user go to Chichewa version
						if($level==17){
							// Graduate user to level 2
							$sql2="UPDATE `session` SET `level`=2 where `session_id`='".$sessionId."'";
							$db->query($sql2);
							// Menu 2  English
							//Serve English services menu
							$response = "CON  Welcome To farmerss World\n";
							$response .= "Choose Your Desired Option\n\n";
							
							$response .= "1. Farm Suppliers\n";
							$response .= "2. Markets\n";
							$response .= "3. Advisors\n";
							$response .= "4. Farm Management\n";
							$response .= "5. Notifications\n";
							$response .= "6. My Account\n";
							// Print the response onto the page so that our gateway can read it
							header('Content-type: text/plain');
							echo $response;				
						}
					break;

					default:
						if($level==17){
							// Return user to Main Menu & Demote user's level
							$response = "CON Wrong Option\n";
							$response .= "Please Choose A Correct Option\n";
							$response .= "1. Change My Account Details\n";
							$response .= "2. Check My Account Details\n";
							$response .= "3. Main Menu\n";
							
							//update the level to 0 so that the session should start at level 1
							$sql4="UPDATE `session` SET `level`=17 where `session_id`='".$sessionId."'";
							$db->query($sql4);

							// Print the response onto the page so that our gateway can read it
							header('Content-type: text/plain');
							echo $response;	
						}
				}
			}
		}

		//Changing Account Name and Location
		else if($level==18){
			if(!$userResponse==""){
				switch($userResponse){
					case "1":
						if($level==18){
							
							// Graduate user to level 64
							$sql4="UPDATE `session` SET `level`=19 where `session_id`='".$sessionId."'";
							$db->query($sql4);

							$response = "CON  Account Update\n";
							$response .= "Please Enter Your New User Name\n";
						
							// Print the response onto the page so that our gateway can read it
							header('Content-type: text/plain');
							echo $response;	
						}
					break;
					case "2":
						if($level==18){
																				
							// Graduate user to level 14
							$sql4="UPDATE `session` SET `level`=21 where `session_id`='".$sessionId."'";
							$db->query($sql4);

							$response = "CON  Account Update\n";
							$response .= "Please Enter Your New Location\n";
						
							// Print the response onto the page so that our gateway can read it
							header('Content-type: text/plain');
							echo $response;	
						}
					break;
					case "3":
						if($level==18){							
							// Graduate user to level 14
							$sql4="UPDATE `session` SET `level`=17 where `session_id`='".$sessionId."'";
							$db->query($sql4);

							$response = "CON farmerss World My Acoount Section\n";
							$response .= "You Have Choosen My Account Option\n\n";
							
                            $response .= "1. Change Account Details\n";
                            $response .= "2. Check Account Details\n";
                            $response .= "3. Main Menu";
                            
						
							// Print the response onto the page so that our gateway can read it
							header('Content-type: text/plain');
							echo $response;	
						}
					break;

					case "4":   			// if the choice is 1 the user go to English version
                        if($level==18){
                            // Graduate user to level 2
                            $sql2="UPDATE `session` SET `level`=2 where `session_id`='".$sessionId."'";
                            $db->query($sql2);
                            //Menu 2  English
                            //Serve English services menu
                            $response = "CON  Welcome To farmerss World\n";
							$response .= "Choose Your Desired Option\n\n";
							
                            $response .= "1. Farm Suppliers\n";
                            $response .= "2. Markets\n";
                            $response .= "3. Advisors\n";
                            $response .= "4. Farm Management\n";
                            $response .= "5. Notifications\n";
                            $response .= "6. My Account\n";
                            
                            // Print the response onto the page so that our gateway can read it
                            header('Content-type: text/plain');
                            echo $response;
                        }
                    break;
					default:
						if($level==18){
							// Return user to Main Menu & Demote user's level
							$response = "CON Wrong Option\n";
							$response .= "Try Again To Update\n";
							$response .= "1. Change Name\n";
							$response .= "2. Change Location\n";
							$response .= "3. Back\n";
							$response .= "4. Main Menu\n";

							//update the level to 0 so that the session should start at level 1
							$sql4="UPDATE `session` SET `level`=18 where `session_id`='".$sessionId."'";
							$db->query($sql4);

							// Print the response onto the page so that our gateway can read it
							header('Content-type: text/plain');
							echo $response;	
						}
				}
			}
		}
		else if($level==19){
			if(!$userResponse==""){
				
				// Graduate user to level 64
				$sql4="UPDATE `session` SET `level`=20 where `session_id`='".$sessionId."'";
				$db->query($sql4);

				//Update User Name
				$sql4 = "UPDATE farmers SET `full_name`='".$userResponse."' WHERE `phonenumber` LIKE '%". $phoneNumber ."%'";
				$db->query($sql4);

				$sql5 = "SELECT `full_name` FROM farmers WHERE phonenumber LIKE '%".$phoneNumber."%' LIMIT 1";
				$fQuery=$db->query($sql5);
				$Available=$fQuery->fetch_assoc();

				$response = "CON Account Update\n";
				$response .= "You have successfully Changed Your User Name\n\n";

				$response .= "Your New User Name is\t: ".$Available['full_name']."\n\n";

				$response .= "1.Back\n";
				$response .= "2.Main Menu\n";
					
				// Print the response onto the page so that our gateway can read it
				header('Content-type: text/plain');
				echo $response;
				
			}
		}
		else if($level==20){
			if(!$userResponse==""){			//checking that that the user input is not empty
				switch ($userResponse){ 	// from this point we are using user input as a case variable
					case "1":
						if($level==20){							
						// Graduate user to level 64
						$sql4="UPDATE `session` SET `level`=18 where `session_id`='".$sessionId."'";
						$db->query($sql4);

						$response = "CON My Account Updation Section\n";
						$response .= "Change Account Details\n\n";

						$response .= "1. Change Name\n";
						$response .= "2. Change Location\n";
						$response .= "3. Back\n";
						$response .= "4. Main Menu\n";

						// Print the response onto the page so that our gateway can read it
						header('Content-type: text/plain');
						echo $response;	
						}
					break;
					case "2":   			// if the choice is 2 the user go to nglish version
						if($level==20){
							// Graduate user to level 2
							$sql2="UPDATE `session` SET `level`=2 where `session_id`='".$sessionId."'";
							$db->query($sql2);
							// Menu 2  English
							//Serve English services menu
							$response = "CON  Welcome To farmerss World\n";
							$response .= "Choose Your Desired Option\n\n";
							
							$response .= "1. Farm Suppliers\n";
							$response .= "2. Markets\n";
							$response .= "3. Advisors\n";
							$response .= "4. Farm Management\n";
							$response .= "5. Notifications\n";
							$response .= "6. My Account\n";
							
							// Print the response onto the page so that our gateway can read it
							header('Content-type: text/plain');
							echo $response;
						}
					break;

					default:
						if($level==20){
							$sql5 = "SELECT `full_name` FROM farmers WHERE phonenumber LIKE '%".$phoneNumber."%' LIMIT 1";
							$fQuery=$db->query($sql5);
							$Available=$fQuery->fetch_assoc();

							$response = "CON Account Update\n";
							$response .= "You have successfully Changed Your User Name\n\n";

							$response .= "Your New User Name is\t: ".$Available['full_name']."\n\n";

							$response .= "1.Back\n";
							$response .= "2.Main Menu\n";
							
							//update the level to 0 so that the session should start at level 1
							$sql4="UPDATE `session` SET `level`=20 where `session_id`='".$sessionId."'";
							$db->query($sql4);
		
							// Print the response onto the page so that our gateway can read it
							header('Content-type: text/plain');
							echo $response;	
						}
				}
			}
		}

		//Changing Location
		else if($level==21){
			if(!$userResponse==""){
				
				// Graduate user to level 64
				$sql4="UPDATE `session` SET `level`=22 where `session_id`='".$sessionId."'";
				$db->query($sql4);

				//Update District Name
				$sql4 = "UPDATE farmers SET `location`='".$userResponse."' WHERE `phonenumber` LIKE '%". $phoneNumber ."%'";
				$db->query($sql4);

				//Getting the new set location from the database
				$sql5 = "SELECT `location` FROM farmers WHERE phonenumber LIKE '%".$phoneNumber."%' LIMIT 1";
				$fQuery=$db->query($sql5);
				$Available=$fQuery->fetch_assoc();

				$response = "CON Account Update\n";
				$response .= "You have successfully Changed Your Location\n\n";

				$response .= "Your Location is\t: ".$Available['location']."\n\n";

				$response .= "1.Back\n";
				$response .= "2.Main Menu\n";
					
				// Print the response onto the page so that our gateway can read it
				header('Content-type: text/plain');
				echo $response;
				
			}
		}
		else if($level==22){
			if(!$userResponse==""){			//checking that that the user input is not empty
				switch ($userResponse){ 	// from this point we are using user input as a case variable
					case "1":
						if($level==22){							
						// Graduate user to level 63
						$sql4="UPDATE `session` SET `level`=18 where `session_id`='".$sessionId."'";
						$db->query($sql4);

						$response = "CON My Account Updation Section\n";
						$response .= "Change Account Details\n\n";

						$response .= "1. Change Name\n";
						$response .= "2. Change Location\n";
						$response .= "3. Back\n";
						$response .= "4. Main Menu\n";

						// Print the response onto the page so that our gateway can read it
						header('Content-type: text/plain');
						echo $response;	
						}
					break;
					case "2":   			// if the choice is 2 the user go to nglish version
						if($level==22){
							// Graduate user to level 2
							$sql2="UPDATE `session` SET `level`=2 where `session_id`='".$sessionId."'";
							$db->query($sql2);
							// Menu 2  English
							//Serve English services menu
							$response = "CON  Welcome To farmerss World\n";
							$response .= "Choose Your Desired Option\n\n";
							
							$response .= "1. Farm Suppliers\n";
							$response .= "2. Markets\n";
							$response .= "3. Advisors\n";
							$response .= "4. Farm Management\n";
							$response .= "5. Notifications\n";
							$response .= "6. My Account\n";
							
							// Print the response onto the page so that our gateway can read it
							header('Content-type: text/plain');
							echo $response;
						}
					break;

					default:
						if($level==22){
							$sql5 = "SELECT `location` FROM farmers WHERE phonenumber LIKE '%".$phoneNumber."%' LIMIT 1";
							$fQuery=$db->query($sql5);
							$Available=$fQuery->fetch_assoc();

							$response = "CON Account Update\n";
							$response .= "You have successfully Changed Your Location\n\n";

							$response .= "Your Location is\t: ".$Available['location']."\n\n";

							$response .= "1.Back\n";
							$response .= "2.Main Menu\n";
							
							//update the level to 0 so that the session should start at level 1
							$sql4="UPDATE `session` SET `level`=22 where `session_id`='".$sessionId."'";
							$db->query($sql4);
		
							// Print the response onto the page so that our gateway can read it
							header('Content-type: text/plain');
							echo $response;	
						}
				}
			}
		}
		else if($level==23){
			if(!$userResponse==""){			//checking that that the user input is not empty
				switch ($userResponse){ 	// from this point we are using user input as a case variable
					case "1":   			// if the choice is 1 the user go to nglish version
						if($level==23){
							
							// Graduate user to level 2
							$sql2="UPDATE `session` SET `level`=17 where `session_id`='".$sessionId."'";
							$db->query($sql2);
							//Serve the Account Menu
							$response = "CON farmerss World My Acoount Section\n";
							$response .= "You Have Choosen My Account Option\n\n";
							
                            $response .= "1. Change Account Details\n";
                            $response .= "2. Check Account Details\n";
                            $response .= "3. Main Menu";
                            
							// Print the response onto the page so that our gateway can read it
							header('Content-type: text/plain');
							echo $response;
						}
					break;

					case "2": // the choice is 2 the user go to Chichewa version
						if($level==23){
							// Graduate user to level 2
							$sql2="UPDATE `session` SET `level`=2 where `session_id`='".$sessionId."'";
							$db->query($sql2);
							// Menu 2  English
							//Serve English services menu
							$response = "CON  Welcome To farmerss World\n";
							$response .= "Choose Your Desired Option\n\n";
							
							$response .= "1. Farm Suppliers\n";
							$response .= "2. Markets\n";
							$response .= "3. Advisors\n";
							$response .= "4. Farm Management\n";
							$response .= "5. Notifications\n";
							$response .= "6. My Account\n";
							// Print the response onto the page so that our gateway can read it
							header('Content-type: text/plain');
							echo $response;				
						}
					break;

					default:
						if($level==23){
							// Return user to Main Menu & Demote user's level
							$response = "CON farmerss World My Acoount Section\n";
							$response .= "You Have Choosen My Account Option\n\n";
							
                            $response .= "1. Change Account Details\n";
                            $response .= "2. Check Account Details\n";
                            $response .= "3. Main Menu";
                            
							//update the level to 0 so that the session should start at level 1
							$sql4="UPDATE `session` SET `level`=23 where `session_id`='".$sessionId."'";
							$db->query($sql4);
		
							// Print the response onto the page so that our gateway can read it
							header('Content-type: text/plain');
							echo $response;	
						}
				}
			}
        }        
        else if($level==24){
			if(!$userResponse==""){			//checking that that the user input is not empty
				switch ($userResponse){
					//Menu 2.1 	        // from this point we are using user input as a case variable
					case "1":   			// user will be here if he chooses option 1 in Chichewa menu
						if($level==24){
							// Graduate user to level 70
							$sql4="UPDATE `session` SET `level`=36 where `session_id`='".$sessionId."'";
							$db->query($sql4);
												   
							$response = "CON  Gawo La Misika Kogula Katundu\n";
							$response .= "Mwasankha Misika Kogula Katundu\n\n";

							$response .= "1. Wonani Misika ndi Zomwe Akugulisa\n";
							$response .= "2. Kubwerera pambuyo";
															
							header('Content-type: text/plain');
							echo $response;	
						}
					break;
					//Menu 2.2
					case "2": // user will be here if he chooses option 2 in Chichewa menu
						if($level==24){
							// Graduate user to level 81
							$sql4="UPDATE `session` SET `level`=39 where `session_id`='".$sessionId."'";
							$db->query($sql4);
							
							$response = "CON Takulandirani Kuno Ku Farmers World\n";
							$response .= "Mwasankha Misika Wogula Zakumunda\n\n";

							$response .= "1. Wonani Misika ndi Zomwe Amagula Kwa Inu\n";
							$response .= "2. Kubwerera pambuyo";
	
							header('Content-type: text/plain');
							echo $response;				
						}
					break;
					//Menu 2.3
					case "3": // user will be here if he chooses option 3 in Chichewa menu
						if($level==24){
							// Graduate user to level 43
							$sql4="UPDATE `session` SET `level`=42 where `session_id`='".$sessionId."'";
							$db->query($sql4);
							
							$response = "CON Alangizi A Ku Farmers World\n";
							$response .= "Alangizi A mu Dela Lanu\n\n";
                            
                            $sql5 = "SELECT DISTINCT `advisor_name`,`phone_number`,`advisor_location` FROM `advisors` 
									WHERE `advisor_location` IN (SELECT `location` FROM `farmers` WHERE phoneNumber LIKE '%".$phoneNumber."%')
							 		";
							$advisors=$db->query($sql5);
							$advisorAvailable=$advisors->fetch_assoc();


							if($advisorAvailable && $advisorAvailable['advisor_name']!=NULL && $advisorAvailable['advisor_location']!=NULL){
								foreach($advisors as $index=>$advisors){
                                    $response.= "> ".$advisors['advisor_name']."\t ".$advisors['phone_number']."\n";                                      
                                }
		
							} else {
								$response .= "Mulibe Alangizi Mu Dera Lanu \n\n"; 
							}				

                                $response.= "1. Kubwelera Kumayambiliro\n";
	
							// Print the response onto the page so that our gateway can read it
							header('Content-type: text/plain');
							echo $response;				
						}
					break;
					//Menu 2.4
					case "4": // user will be here if he chooses option 4 in Chichewa menu
						if($level==24){
							// Graduate user to level 7
							$sql4="UPDATE `session` SET `level`=43 where `session_id`='".$sessionId."'";
							$db->query($sql4);
							
							$response = "CON  Kusamala Zakumunda\n";
							$response .= "Kuwelengela Zakumunda\n";
							$response .= "Sankhani Mbewu Zomwe Mukufuna kukolora\n\n";
							
							$response .= "1. Chimanga\n";
							$response .= "2. Cotton\n";
							$response .= "3. Fodya\n";
							$response .= "4. Kubwelera Kumayambiliro\n";
							
							header('Content-type: text/plain');
							echo $response;				
						}
					break;
					 //Menu 2.5
					 case "5": // user will be here if he chooses option 5 in Chichewa menu
						if($level==24){
							// Graduate user to level 126
							$sql4="UPDATE `session` SET `level`=59 where `session_id`='".$sessionId."'";
							$db->query($sql4);
							
							$response = "CON Gawo la Mauthenga\n";
							$response .= "Mwasankha Mauthenga\n\n";
							
							$response .= "1. Mauthenga Olandilidwa\n";
							$response .= "2. Kubwelera Kumayambiliro";
							
							header('Content-type: text/plain');
							echo $response;				
						}
					break;
					//Menu 2.6
					case "6": // user will be here if he chooses option 6 in Chichewa menu
						if($level==24){
							// Graduate user to level 128
							$sql4="UPDATE `session` SET `level`=61 where `session_id`='".$sessionId."'";
							$db->query($sql4);
							
							$response = "CON Gawo La Akaunti Yanga Ku Farmers World\n";
							$response .= "Mwasankha Za Akaunti Yanu\n\n";

							$response .= "1. Sinthani Za Akaunti Yanu\n";
							$response .= "2. Wonani Za Akaunti Yanu\n";
							$response .= "3. Kubwerera pambuyo";
							
							header('Content-type: text/plain');
							echo $response;				
						}
					break;

					default:
						if($level==24){
							// Return user to Main Menu & Demote user's level
							$response = "CON Mwasankha Polakwika, Chonde Yeselaninso\n";                                             
							//re-serve Chichewa menu in case user chooses wrong option
                     		$response .= "Takulandirani Kuno Ku Farmers World\n";
							$response .= "Zikomo Posankha Chichewa \n";
							$response .= "Sankhani Chomwe Mukufuna\n\n";
	
							$response .= "1. Mitsika{Kogula Katundu}\n";
							$response .= "2. Mitsika{Kogulitsa Katundu}\n";
							$response .= "3. Alangizi\n";
							$response .= "4. Kusamala Za Kumunda\n";
							$response .= "5. Mauthenga\n";
							$response .= "6. Account Yanga\n";
							
							//update the level to 0 so that the session should start at level 1
							$sql4="UPDATE `session` SET `level`=24 where `session_id`='".$sessionId."'";
							$db->query($sql4);
		
							// Print the response onto the page so that our gateway can read it
							header('Content-type: text/plain');
							echo $response;	
						}
				}
			}
		}
		
		//Menu 4*2. FarmMAnagement of Cotton
		else if($level==26){
			if(!$userResponse==""){
				switch($userResponse){
					case "1":
						if($level==26){
							
							// Graduate user to level 64
							$sql4="UPDATE `session` SET `level`=27 where `session_id`='".$sessionId."'";
							$db->query($sql4);

                            $response = "CON Farm Management\n";
                            $response .= "Cotton\n\n";
							$response .= "Enter Amount of 50Kg Bags\n\n";				
							
							// Print the response onto the page so that our gateway can read it
							header('Content-type: text/plain');
							echo $response;	
						}
					break;
					case "2":
						if($level==26){
																				
							// Graduate user to level 29
							$sql4="UPDATE `session` SET `level`=29 where `session_id`='".$sessionId."'";
							$db->query($sql4);

                            $response = "CON Farm Management\n";
                            $response .= "Cotton\n\n";
                            $response .= "Enter Amount of 70Kg Bags\n\n";
						
							// Print the response onto the page so that our gateway can read it
							header('Content-type: text/plain');
							echo $response;	
						}
                    break;
				
                    case "3": // user will be here if he chooses option 4 in english menu
                        if($level==26){
                            // Graduate user to level 7
                            $sql4="UPDATE `session` SET `level`=10 where `session_id`='".$sessionId."'";
                            $db->query($sql4);
                            
                            $response = "CON  Farm Management\n";
                            $response .= "Farm Calculations\n";
							$response .= "Select Crop To Be Produced\n\n";
							
                            $response .= "1. Maize\n";
                            $response .= "2. Cotton\n";
                            $response .= "3. Tobbaco\n";
                            $response .= "4. Main Menu\n";
                            
                            header('Content-type: text/plain');
                            echo $response;				
                        }
                    break;
					
                    case "4":   			// if the choice is 1 the user go to English version
                        if($level==26){
                            // Graduate user to level 2
                            $sql2="UPDATE `session` SET `level`=2 where `session_id`='".$sessionId."'";
                            $db->query($sql2);
                            //Menu 2  English
                            //Serve English services menu
                            $response = "CON  Welcome To farmerss World\n";
							$response .= "Choose Your Desired Option\n\n";
							
                            $response .= "1. Farm Suppliers\n";
                            $response .= "2. Markets\n";
                            $response .= "3. Advisors\n";
                            $response .= "4. Farm Management\n";
                            $response .= "5. Notifications\n";
                            $response .= "6. My Account\n";
                            
                            // Print the response onto the page so that our gateway can read it
                            header('Content-type: text/plain');
                            echo $response;
                        }
                    break;
					default:
						if($level==26){
							// Return user to Main Menu & Demote user's level
							$response = "CON Wrong Option\n";
                            $response .= "Farm Managemen\n";
                            $response .= "Cotton\n";                        
                            $response .= "Choose Quantity of Bag\n\n";
                            
							$response .= "1. 50Kg\n";
							$response .= "2. 70Kg\n";
							$response .= "3. Back\n";							
							$response .= "4. Main Menu\n"; 

							//update the level to 0 so that the session should start at level 1
							$sql4="UPDATE `session` SET `level`=26 where `session_id`='".$sessionId."'";
							$db->query($sql4);

							// Print the response onto the page so that our gateway can read it
							header('Content-type: text/plain');
							echo $response;	
						}
				}
			}
		}
		else if($level==27){
			if(!$userResponse==""){
				
				// Graduate user to level 64
				$sql4="UPDATE `session` SET `level`=28 where `session_id`='".$sessionId."'";
				$db->query($sql4);

				$CottonYieldOf50kgs = $userResponse * 0.016;
				$npkBags = 0.0224 * $userResponse;
				$ureaBags = 0.0224 * $userResponse;

                $response = "CON Farm Management\n\n";
                
				$response .="For $userResponse Cotton Bag(s) of 50Kgs, You will need:\n>. $CottonYieldOf50kgs hectares of land\n>. $npkBags NPK Fertilizer Bag(s)\n>. $ureaBags Urea Fertilizer Bag(s)\n>. Moderate rainfall.\n\n";

				$response .= "1. Back\n";
				$response .= "2. Main Menu\n";
					
				// Print the response onto the page so that our gateway can read it
				header('Content-type: text/plain');
				echo $response;
				
			}
		}
		else if($level==28){
			if(!$userResponse==""){			//checking that that the user input is not empty
				switch ($userResponse){ 	// from this point we are using user input as a case variable
					case "1":
						if($level==28){							
						// Graduate user to level 64
						$sql4="UPDATE `session` SET `level`=26 where `session_id`='".$sessionId."'";
						$db->query($sql4);

						$response = "CON  Farm Managemen\n";
                        $response .= "Cotton\n";                        
                        $response .= "Choose Quantity of Bag\n\n";
                        
						$response .= "1. 50Kg\n";
						$response .= "2. 70Kg\n";
						$response .= "3. Back\n";							
						$response .= "4. Main Menu\n"; 

						// Print the response onto the page so that our gateway can read it
						header('Content-type: text/plain');
						echo $response;	
						}
					break;
					case "2":   			// if the choice is 2 the user go to nglish version
						if($level==28){
							// Graduate user to level 2
							$sql2="UPDATE `session` SET `level`=2 where `session_id`='".$sessionId."'";
							$db->query($sql2);
							// Menu 2  English
							//Serve English services menu
							$response = "CON  Welcome To farmerss World\n";
							$response .= "Choose Your Desired Option\n\n";
							
							$response .= "1. Farm Suppliers\n";
							$response .= "2. Markets\n";
							$response .= "3. Advisors\n";
							$response .= "4. Farm Management\n";
							$response .= "5. Notifications\n";
							$response .= "6. My Account\n";
							
							// Print the response onto the page so that our gateway can read it
							header('Content-type: text/plain');
							echo $response;
						}
					break;

					default:
						if($level==28){
                            $sql5 = "SELECT `received_message` FROM ussd_notifications WHERE phonenumber LIKE '%".$phoneNumber."%' LIMIT 1";
                            $fQuery=$db->query($sql5);
                            $Available=$fQuery->fetch_assoc();
            
                            $response = "CON Wrong Option, please try Again\n\n";
							$response .= "Farm Management\n\n";
                
							$response .="For $userResponse Cotton Bag(s) of 50Kgs, You will need:\n>. $CottonYieldOf50kgs hectares of land\n>. $npkBags NPK Fertilizer Bag(s)\n>. $ureaBags Urea Fertilizer Bag(s)\n>. Moderate rainfall.\n\n";
			
							$response .= "1. Back\n";
							$response .= "2. Main Menu\n";
							
							//update the level to 0 so that the session should start at level 1
							$sql4="UPDATE `session` SET `level`=28 where `session_id`='".$sessionId."'";
							$db->query($sql4);
		
							// Print the response onto the page so that our gateway can read it
							header('Content-type: text/plain');
							echo $response;	
						}
				}
			}
        }        
		else if($level==29){
			if(!$userResponse==""){
				
				// Graduate user to level 64
				$sql4="UPDATE `session` SET `level`=30 where `session_id`='".$sessionId."'";
				$db->query($sql4);

				$CottonYieldOf70kgs = $userResponse * 0.0224;
				$npkBags = 0.04 * $userResponse;
				$ureaBags = 0.04 * $userResponse;
				
				$response = "CON Farm Management\n\n";
                
				$response .="For $userResponse Cotton Bag(s) of 70Kgs, You will need:\n>. $CottonYieldOf70kgs hectares of land\n>. $npkBags NPK Fertilizer Bag(s)\n>. $ureaBags Urea Fertilizer Bag(s)\n>. Moderate rainfall.\n\n";

				$response .= "1. Back\n";
				$response .= "2. Main Menu\n";
					
				// Print the response onto the page so that our gateway can read it
				header('Content-type: text/plain');
				echo $response;
				
			}
		}
		else if($level==30){
			if(!$userResponse==""){			//checking that that the user input is not empty
				switch ($userResponse){ 	// from this point we are using user input as a case variable
					case "1":
						if($level==30){							
						// Graduate user to level 64
						$sql4="UPDATE `session` SET `level`=26 where `session_id`='".$sessionId."'";
						$db->query($sql4);

						$response = "CON  Farm Managemen\n";
                        $response .= "Cotton\n";                        
                        $response .= "Choose Quantity of Bag\n\n";
                        
						$response .= "1. 50Kg\n";
						$response .= "2. 70Kg\n";
						$response .= "3. Back\n";							
						$response .= "4. Main Menu\n"; 

						// Print the response onto the page so that our gateway can read it
						header('Content-type: text/plain');
						echo $response;	
						}
					break;
					case "2":   			// if the choice is 2 the user go to nglish version
						if($level==30){
							// Graduate user to level 2
							$sql2="UPDATE `session` SET `level`=2 where `session_id`='".$sessionId."'";
							$db->query($sql2);
							// Menu 2  English
							//Serve English services menu
							$response = "CON  Welcome To farmerss World\n";
							$response .= "Choose Your Desired Option\n\n";
							
							$response .= "1. Farm Suppliers\n";
							$response .= "2. Markets\n";
							$response .= "3. Advisors\n";
							$response .= "4. Farm Management\n";
							$response .= "5. Notifications\n";
							$response .= "6. My Account\n";
							
							// Print the response onto the page so that our gateway can read it
							header('Content-type: text/plain');
							echo $response;
						}
					break;

					default:
						if($level==30){
                            $sql5 = "SELECT `received_message` FROM ussd_notifications WHERE phonenumber LIKE '%".$phoneNumber."%' LIMIT 1";
                            $fQuery=$db->query($sql5);
                            $Available=$fQuery->fetch_assoc();
            
                            $response = "CON Wrong Option, please try Again\n\n";
							$response .= "Farm Management\n\n";
                
							$response .="For $userResponse Cotton Bag(s) of 70Kgs, You will need:\n>. $CottonYieldOf70kgs hectares of land\n>. $npkBags NPK Fertilizer Bag(s)\n>. $ureaBags Urea Fertilizer Bag(s)\n>. Moderate rainfall.\n\n";
			
							$response .= "1. Back\n";
							$response .= "2. Main Menu\n";
							
							//update the level to 0 so that the session should start at level 1
							$sql4="UPDATE `session` SET `level`=30 where `session_id`='".$sessionId."'";
							$db->query($sql4);
		
							// Print the response onto the page so that our gateway can read it
							header('Content-type: text/plain');
							echo $response;	
						}
				}
			}
		}

		//Menu 4*3. FarmMAnagement of Tobacco
		else if($level==31){
			if(!$userResponse==""){
				switch($userResponse){
					case "1":
						if($level==31){
							
							// Graduate user to level 64
							$sql4="UPDATE `session` SET `level`=32 where `session_id`='".$sessionId."'";
							$db->query($sql4);

                            $response = "CON Farm Management\n";
                            $response .= "Tobbaco\n\n";
							$response .= "Enter Amount of 50Kg Bales\n\n";				
							
							// Print the response onto the page so that our gateway can read it
							header('Content-type: text/plain');
							echo $response;	
						}
					break;
					case "2":
						if($level==31){
																				
							// Graduate user to level 34
							$sql4="UPDATE `session` SET `level`=34 where `session_id`='".$sessionId."'";
							$db->query($sql4);

                            $response = "CON Farm Management\n";
                            $response .= "Tobbaco\n\n";
                            $response .= "Enter Amount of 70Kg Bales\n\n";
						
							// Print the response onto the page so that our gateway can read it
							header('Content-type: text/plain');
							echo $response;	
						}
                    break;

					case "3": // user will be here if he chooses option 4 in english menu
                        if($level==31){
                            // Graduate user to level 7
                            $sql4="UPDATE `session` SET `level`=10 where `session_id`='".$sessionId."'";
                            $db->query($sql4);
                            
                            $response = "CON  Farm Management\n";
                            $response .= "Farm Calculations\n";
							$response .= "Select Crop To Be Produced\n\n";
							
                            $response .= "1. Maize\n";
                            $response .= "2. Cotton\n";
                            $response .= "3. Tobbaco\n";
                            $response .= "4. Main Menu\n";
                            
                            header('Content-type: text/plain');
                            echo $response;				
                        }
                    break;					

                    case "4":   			// if the choice is 1 the user go to English version
                        if($level==31){
                            // Graduate user to level 2
                            $sql2="UPDATE `session` SET `level`=2 where `session_id`='".$sessionId."'";
                            $db->query($sql2);
                            //Menu 2  English
                            //Serve English services menu
                            $response = "CON  Welcome To farmerss World\n";
							$response .= "Choose Your Desired Option\n\n";
							
                            $response .= "1. Farm Suppliers\n";
                            $response .= "2. Markets\n";
                            $response .= "3. Advisors\n";
                            $response .= "4. Farm Management\n";
                            $response .= "5. Notifications\n";
                            $response .= "6. My Account\n";
                            
                            // Print the response onto the page so that our gateway can read it
                            header('Content-type: text/plain');
                            echo $response;
                        }
                    break;
					default:
						if($level==31){
							// Return user to Main Menu & Demote user's level
							$response = "CON Wrong Option\n";
                            $response .= "Farm Managemen\n";
                            $response .= "Tobbaco\n";                        
                            $response .= "Choose Quantity of Bag\n\n";
                            
							$response .= "1. 50Kg\n";
							$response .= "2. 70Kg\n";
							$response .= "3. Back\n";							
							$response .= "4. Main Menu\n";  

							//update the level to 0 so that the session should start at level 1
							$sql4="UPDATE `session` SET `level`=31 where `session_id`='".$sessionId."'";
							$db->query($sql4);

							// Print the response onto the page so that our gateway can read it
							header('Content-type: text/plain');
							echo $response;	
						}
				}
			}
		}
		else if($level==32){
			if(!$userResponse==""){
				
				// Graduate user to level 64
				$sql4="UPDATE `session` SET `level`=33 where `session_id`='".$sessionId."'";
				$db->query($sql4);

				$TobbacoYieldOf50kgs = $userResponse * 0.016;
				$npkBales = 0.0224 * $userResponse;
				$ureaBales = 0.0224 * $userResponse;

                $response = "CON Farm Management\n\n";
                
				$response .="For $userResponse Tobbaco Bag(s) of 50Kgs, You will need:\n>. $TobbacoYieldOf50kgs hectares of land\n>. $npkBales NPK Fertilizer Bag(s)\n>. $ureaBales Urea Fertilizer Bag(s)\n>. Moderate rainfall.\n\n";

				$response .= "1. Back\n";
				$response .= "2. Main Menu\n";
					
				// Print the response onto the page so that our gateway can read it
				header('Content-type: text/plain');
				echo $response;
				
			}
		}
		else if($level==33){
			if(!$userResponse==""){			//checking that that the user input is not empty
				switch ($userResponse){ 	// from this point we are using user input as a case variable
					case "1":
						if($level==33){							
						// Graduate user to level 64
						$sql4="UPDATE `session` SET `level`=31 where `session_id`='".$sessionId."'";
						$db->query($sql4);

						$response = "CON  Farm Managemen\n";
                        $response .= "Tobbaco\n";                        
                        $response .= "Choose Quantity of Bag\n\n";
                        
						$response .= "1. 50Kg\n";
						$response .= "2. 70Kg\n";
						$response .= "3. Back\n";							
						$response .= "4. Main Menu\n"; 

						// Print the response onto the page so that our gateway can read it
						header('Content-type: text/plain');
						echo $response;	
						}
					break;
					case "2":   			// if the choice is 2 the user go to nglish version
						if($level==33){
							// Graduate user to level 2
							$sql2="UPDATE `session` SET `level`=2 where `session_id`='".$sessionId."'";
							$db->query($sql2);
							// Menu 2  English
							//Serve English services menu
							$response = "CON  Welcome To farmerss World\n";
							$response .= "Choose Your Desired Option\n\n";
							
							$response .= "1. Farm Suppliers\n";
							$response .= "2. Markets\n";
							$response .= "3. Advisors\n";
							$response .= "4. Farm Management\n";
							$response .= "5. Notifications\n";
							$response .= "6. My Account\n";
							
							// Print the response onto the page so that our gateway can read it
							header('Content-type: text/plain');
							echo $response;
						}
					break;

					default:
						if($level==33){
                            $sql5 = "SELECT `received_message` FROM ussd_notifications WHERE phonenumber LIKE '%".$phoneNumber."%' LIMIT 1";
                            $fQuery=$db->query($sql5);
                            $Available=$fQuery->fetch_assoc();
            
                            $response = "CON Wrong Option, please try Again\n\n";
							$response .= "Farm Management\n\n";
                
							$response .="For $userResponse Tobbaco Bag(s) of 50Kgs, You will need:\n>. $TobbacoYieldOf50kgs hectares of land\n>. $npkBales NPK Fertilizer Bag(s)\n>. $ureaBales Urea Fertilizer Bag(s)\n>. Moderate rainfall.\n\n";
			
							$response .= "1. Back\n";
							$response .= "2. Main Menu\n";
							
							//update the level to 0 so that the session should start at level 1
							$sql4="UPDATE `session` SET `level`=33 where `session_id`='".$sessionId."'";
							$db->query($sql4);
		
							// Print the response onto the page so that our gateway can read it
							header('Content-type: text/plain');
							echo $response;	
						}
				}
			}
        }        
		else if($level==34){
			if(!$userResponse==""){
				
				// Graduate user to level 64
				$sql4="UPDATE `session` SET `level`=35 where `session_id`='".$sessionId."'";
				$db->query($sql4);

				$TobbacoYieldOf70kgs = $userResponse * 0.0224;
				$npkBales = 0.04 * $userResponse;
				$ureaBales = 0.04 * $userResponse;
				
				$response = "CON Farm Management\n\n";
                
				$response .="For $userResponse Tobbaco Bag(s) of 70Kgs, You will need:\n>. $TobbacoYieldOf70kgs hectares of land\n>. $npkBales NPK Fertilizer Bag(s)\n>. $ureaBales Urea Fertilizer Bag(s)\n>. Moderate rainfall.\n\n";

				$response .= "1. Back\n";
				$response .= "2. Main Menu\n";
					
				// Print the response onto the page so that our gateway can read it
				header('Content-type: text/plain');
				echo $response;
				
			}
		}
		else if($level==35){
			if(!$userResponse==""){			//checking that that the user input is not empty
				switch ($userResponse){ 	// from this point we are using user input as a case variable
					case "1":
						if($level==35){							
						// Graduate user to level 64
						$sql4="UPDATE `session` SET `level`=31 where `session_id`='".$sessionId."'";
						$db->query($sql4);

						$response = "CON  Farm Managemen\n";
                        $response .= "Tobbaco\n";                        
                        $response .= "Choose Quantity of Bag\n\n";
                        
						$response .= "1. 50Kg\n";
						$response .= "2. 70Kg\n";
						$response .= "3. Back\n";							
						$response .= "4. Main Menu\n"; 

						// Print the response onto the page so that our gateway can read it
						header('Content-type: text/plain');
						echo $response;	
						}
					break;
					case "2":   			// if the choice is 2 the user go to nglish version
						if($level==35){
							// Graduate user to level 2
							$sql2="UPDATE `session` SET `level`=2 where `session_id`='".$sessionId."'";
							$db->query($sql2);
							// Menu 2  English
							//Serve English services menu
							$response = "CON  Welcome To farmerss World\n";
							$response .= "Choose Your Desired Option\n\n";
							
							$response .= "1. Farm Suppliers\n";
							$response .= "2. Markets\n";
							$response .= "3. Advisors\n";
							$response .= "4. Farm Management\n";
							$response .= "5. Notifications\n";
							$response .= "6. My Account\n";
							
							// Print the response onto the page so that our gateway can read it
							header('Content-type: text/plain');
							echo $response;
						}
					break;

					default:
						if($level==35){
                            $sql5 = "SELECT `received_message` FROM ussd_notifications WHERE phonenumber LIKE '%".$phoneNumber."%' LIMIT 1";
                            $fQuery=$db->query($sql5);
                            $Available=$fQuery->fetch_assoc();
            
                            $response = "CON Wrong Option, please try Again\n\n";
							$response .= "Farm Management\n\n";
                
							$response .="For $userResponse Tobbaco Bag(s) of 70Kgs, You will need:\n>. $TobbacoYieldOf70kgs hectares of land\n>. $npkBales NPK Fertilizer Bag(s)\n>. $ureaBales Urea Fertilizer Bag(s)\n>. Moderate rainfall.\n\n";
			
							$response .= "1. Back\n";
							$response .= "2. Main Menu\n";
							
							//update the level to 0 so that the session should start at level 1
							$sql4="UPDATE `session` SET `level`=35 where `session_id`='".$sessionId."'";
							$db->query($sql4);
		
							// Print the response onto the page so that our gateway can read it
							header('Content-type: text/plain');
							echo $response;	
						}
				}
			}
		}
        else if($level==36){
            if(!$userResponse==""){
                switch($userResponse){
                    case "1":
                        if($level==36){							
                        // Graduate user to level 4
                        $sql4="UPDATE `session` SET `level`=37 where `session_id`='".$sessionId."'";
                        $db->query($sql4);

                        $response = "CON Mitsika{Kogula Katundu}\n";
						$response .= "Sankhani Msika\n\n";
						
                        $response .= "1. Enterprise\n";
                        $response .= "2. Agro-dealers\n";
                        $response .= "3. Invesments\n";
                        $response .= "4. Kubwelera PaMbuyo\n";
                        $response .= "5. Kubwelera Kumayambiliro\n";
                        
                        
                        // Print the response onto the page so that our gateway can read it
                        header('Content-type: text/plain');
                        echo $response;	
                        }
                    break;

                    case "2":   			// if the choice is 1 the user go to English version
                        if($level==36){
                            // Graduate user to level 2
                            $sql2="UPDATE `session` SET `level`=24 where `session_id`='".$sessionId."'";
                            $db->query($sql2);
                            //Menu 2  English
                            //Serve English services menu
							$response = "CON Takulandirani Kuno Ku Farmers World\n";
							$response .= "Zikomo Posankha Chichewa \n";
							$response .= "Sankhani Chomwe Mukufuna\n\n";

							$response .= "1. Mitsika{Kogula Katundu}\n";
							$response .= "2. Mitsika{Kogulitsa Katundu}\n";
                     		$response .= "3. Alangizi\n";
                     		$response .= "4. Kusamala Za Kumunda\n";
                     		$response .= "5. Mauthenga\n";
							$response .= "6. Account Yanga\n";
                            
                            // Print the response onto the page so that our gateway can read it
                            header('Content-type: text/plain');
                            echo $response;
                        }
                    break;

                    default:
                        if($level==36){
							// Return user to Main Menu & Demote user's level
							$response = "CON Mwasankha Molakwika, Chonde Yeselaninso.\n";
                            $response .= "Mitsika{Kogula Katundu}\n"; 
                            
                            $response .= "1. Mitsika{Kogula Katundu}\n";
                            $response .= "2. Kubwelera Kumayambiliro";
                                                            
                            //update the level to 3 so that the session should start at level 1
                            $sql4="UPDATE `session` SET `level`=3 where `session_id`='".$sessionId."'";
                            $db->query($sql4);

                            // Print the response onto the page so that our gateway can read it
                            header('Content-type: text/plain');
                            echo $response;	
                        }
                }
            }
		}
		else if($level==37){
			if(!$userResponse==""){
				switch($userResponse){
					case "1":
						if($level==37){							
						// Graduate user to level 14
						$sql4="UPDATE `session` SET `level`=38 where `session_id`='".$sessionId."'";
                        $db->query($sql4);

						$response = "CON Mwasankha Enterprice a Mu Dela lanu\n";
						$response .= "Akugulisa Zosatila\n\n";
						
						$sql5 = "SELECT DISTINCT `product_name`,`selling_price`,`supplier_name` FROM `supplier_products` 
						WHERE (`supplier_location`IN (SELECT `location` FROM `farmers` WHERE phoneNumber LIKE '%".$phoneNumber."%')) AND `supplier_name` LIKE '%Enterprise%' LIMIT 5";																
						$supplier_products=$db->query($sql5);

                        foreach($supplier_products as $index=>$supplier_products){
                            $response.= "> ".$supplier_products['product_name']."\t MK".$supplier_products['selling_price']."\n";                                      
                        }

                        $response.= "\n";
						$response.= "1. Kubwelera Pambuyo\n";
						$response.= "2. Kubwelera Kumayambiliro\n";

						// Print the response onto the page so that our gateway can read it
						header('Content-type: text/plain');
						echo $response;	
						}
                    break;
                    
					case "2":
						if($level==37){							
						// Graduate user to level 14
						$sql4="UPDATE `session` SET `level`=38 where `session_id`='".$sessionId."'";
						$db->query($sql4);

						$response = "CON Mwasankha Agro-Dealers a Mu Dela lanu\n";
						$response .= "Akugulisa Zosatila\n\n";
						
						$sql5 = "SELECT DISTINCT `product_name`,`selling_price`,`supplier_name` FROM `supplier_products` 
						WHERE (`supplier_location`IN (SELECT `location` FROM `farmers` WHERE phoneNumber LIKE '%".$phoneNumber."%')) AND `supplier_name` LIKE '%Agro%' LIMIT 5";																
						$supplier_products=$db->query($sql5);

                        foreach($supplier_products as $index=>$supplier_products){
                            $response.= "> ".$supplier_products['product_name']."\t MK".$supplier_products['selling_price']."\n";                                      
                        }

                        $response.= "\n";
						$response.= "1. Kubwelera Pambuyo\n";
						$response.= "2. Kubwelera Kumayambiliro\n";						

						// Print the response onto the page so that our gateway can read it
						header('Content-type: text/plain');
						echo $response;	
						}
                    break;

					case "3":
						if($level==37){							
						// Graduate user to level 14
						$sql4="UPDATE `session` SET `level`=38 where `session_id`='".$sessionId."'";
						$db->query($sql4);
						
						$response = "CON Mwasankha Investments a Mu Dela lanu\n";
						$response .= "Akugulisa Zosatila\n\n";
						
						$sql5 = "SELECT DISTINCT `product_name`,`selling_price`,`supplier_name` FROM `supplier_products` 
						WHERE (`supplier_location`IN (SELECT `location` FROM `farmers` WHERE phoneNumber LIKE '%".$phoneNumber."%')) AND `supplier_name` LIKE '%Investment%' LIMIT 5";																
						$supplier_products=$db->query($sql5);

                        foreach($supplier_products as $index=>$supplier_products){
                            $response.= "> ".$supplier_products['product_name']."\t MK".$supplier_products['selling_price']."\n";                                      
                        }

                        $response.= "\n";
						$response.= "1. Kubwelera Pambuyo\n";
						$response.= "2. Kubwelera Kumayambiliro\n";

						// Print the response onto the page so that our gateway can read it
						header('Content-type: text/plain');
						echo $response;	
						}
                    break;

                    case "4":   			// user will be here if he chooses option 1 in english menu
                        if($level==37){
                           // Graduate user to level 4
                           $sql4="UPDATE `session` SET `level`=36 where `session_id`='".$sessionId."'";
                           $db->query($sql4);
                            
						   $response = "CON  Gawo La Misika Kogula Katundu\n";
						   $response .= "Mwasankha Misika Kogula Katundu\n\n";

						   $response .= "1. Wonani Misika ndi Zomwe Akugulisa\n";
						   $response .= "2. Kubwerera pambuyo";

                                                            
                           header('Content-type: text/plain');
                           echo $response;	
                        }
                    break;

                    case "5":
						if($level==37){	
						   // Graduate user to level 1
						   $sql4="UPDATE `session` SET `level`=2 where `session_id`='".$sessionId."'";
						   $db->query($sql4);

							//Menu 2 Chichewa 							
							//Serve Chichewa services menu
							$response = "CON Takulandirani Kuno Ku Farmers World\n";
							$response .= "Zikomo Posankha Chichewa \n";
							$response .= "Sankhani Chomwe Mukufuna\n\n";

							$response .= "1. Mitsika{Kogula Katundu}\n";
							$response .= "2. Mitsika{Kogulitsa Katundu}\n";
                     		$response .= "3. Alangizi\n";
                     		$response .= "4. Kusamala Za Kumunda\n";
                     		$response .= "5. Mauthenga\n";
							$response .= "6. Account Yanga\n";					
						
							// Print the response onto the page so that our gateway can read it
							header('Content-type: text/plain');
							echo $response;	
						}
                    break;
                    
					default:
						if($level==37){
							// Return user to Main Menu & Demote user's level
							$response = "CON Mwasankha Molakwika, Chonde Yeselaninso \n";
							$response .= "Mitsika{Kogula Katundu}\n";
							$response .= "Sankhani Msika\n\n";
							
							$response .= "1. Enterprise\n";
							$response .= "2. Agro-dealers\n";
							$response .= "3. Invesments\n";
							$response .= "4. Kubwelera PaMbuyo\n";
							$response .= "5. Kubwelera Kumayambiliro\n";
							
							//update the level to 0 so that the session should start at level 1
							$sql4="UPDATE `session` SET `level`=37 where `session_id`='".$sessionId."'";
							$db->query($sql4);

							// Print the response onto the page so that our gateway can read it
							header('Content-type: text/plain');
							echo $response;	
						}
				}
			}
		}
		else if($level==38){
			if(!$userResponse==""){
				
				switch($userResponse){
					case "1":
						if($level==38){							
                            $sql4="UPDATE `session` SET `level`=37 where `session_id`='".$sessionId."'";
                            $db->query($sql4);
    
                           
                            $response = "CON Mwasankha Molakwika, Chonde Yeselaninso \n";
							$response .= "Mitsika{Kogula Katundu}\n";
							$response .= "Sankhani Msika\n\n";
							
							$response .= "1. Enterprise\n";
							$response .= "2. Agro-dealers\n";
							$response .= "3. Invesments\n";
							$response .= "4. Kubwelera PaMbuyo\n";
							$response .= "5. Kubwelera Kumayambiliro\n";

						// Print the response onto the page so that our gateway can read it
						header('Content-type: text/plain');
						echo $response;	
						}
					break;

					case "2":   			// returns the user to the main menu
						if($level==38){
							// Graduate user to level 2
							$sql2="UPDATE `session` SET `level`=24 where `session_id`='".$sessionId."'";
							$db->query($sql2);
							
							//Menu 2 Chichewa 							
							//Serve Chichewa services menu
							$response = "CON Takulandirani Kuno Ku Farmers World\n";
							$response .= "Zikomo Posankha Chichewa \n";
							$response .= "Sankhani Chomwe Mukufuna\n\n";

							$response .= "1. Mitsika{Kogula Katundu}\n";
							$response .= "2. Mitsika{Kogulitsa Katundu}\n";
                     		$response .= "3. Alangizi\n";
                     		$response .= "4. Kusamala Za Kumunda\n";
                     		$response .= "5. Mauthenga\n";
							$response .= "6. Account Yanga\n";

							
							// Print the response onto the page so that our gateway can read it
							header('Content-type: text/plain');
							echo $response;
						}
					break;

					default:
						if($level==38){
							// Return user to Main Menu & Demote user's level
							
							$response = "END Mwasankha Molakwika, Chonde Yeselaninso\n";
							
							// Print the response onto the page so that our gateway can read it
							header('Content-type: text/plain');
							echo $response;	
						}
				}		
			}
		}
		else if($level==39){
			if(!$userResponse==""){
				switch($userResponse){
					case "1":
						if($level==39){							
							// Graduate user to level 15
							$sql4="UPDATE `session` SET `level`=40 where `session_id`='".$sessionId."'";
							$db->query($sql4);
		
                            $response = "CON Mitsika{Kogula Katundu}\n";
							$response .= "Sankhani Msika\n\n";
		
							$response .= "1. ADMARC\n";
							$response .= "2. AGORA\n";
							$response .= "3. Agro-Dealers\n";
							$response .= "4. Kubwelera PaMbuyo\n";
							$response .= "5. Kubwelera Kumayambiliro\n";
		
							// Print the response onto the page so that our gateway can read it
							header('Content-type: text/plain');
							echo $response;	
						}
					break;
							
					case "2":   			// if the choice is 1 the user go to nglish version
						if($level==39){
							// Graduate user to level 2
							$sql2="UPDATE `session` SET `level`=24 where `session_id`='".$sessionId."'";
							$db->query($sql2);
									
							//Menu 2 Chichewa 							
							//Serve Chichewa services menu
							$response = "CON Takulandirani Kuno Ku Farmers World\n";
							$response .= "Zikomo Posankha Chichewa \n";
							$response .= "Sankhani Chomwe Mukufuna\n\n";

							$response .= "1. Mitsika{Kogula Katundu}\n";
							$response .= "2. Mitsika{Kogulitsa Katundu}\n";
                     		$response .= "3. Alangizi\n";
                     		$response .= "4. Kusamala Za Kumunda\n";
                     		$response .= "5. Mauthenga\n";
							$response .= "6. Account Yanga\n";
										
							// Print the response onto the page so that our gateway can read it
							header('Content-type: text/plain');
							echo $response;
						}
					break;
		
					default:
						if($level==39){
							// Return user to Main Menu & Demote user's level
							$response = "CON Takulandirani Kuno Ku Farmers World\n";
							$response .= "Mwasankha Misika Wogula Zakumunda\n\n";

							$response .= "1. Wonani Misika ndi Zomwe Amagula Kwa Inu\n";
							$response .= "2. Kubwerera pambuyo";

							//update the level to 0 so that the session should start at level 1
							$sql4="UPDATE `session` SET `level`=39 where `session_id`='".$sessionId."'";
							$db->query($sql4);
		
							// Print the response onto the page so that our gateway can read it
							header('Content-type: text/plain');
							echo $response;	
						}
					
				}
			}
		}
		else if($level==40){
			if(!$userResponse==""){
				switch($userResponse){
					case "1":
						if($level==40){							
						// Graduate user to level 14
						$sql4="UPDATE `session` SET `level`=41 where `session_id`='".$sessionId."'";
                        $db->query($sql4);
                        
						$response = "CON ADMARC ya mu Dela\n";
						$response .= "Zotsatilazi Ndi Zomwe Akugula\n\n";                     
                        
						$sql5 = "SELECT DISTINCT `product_name`,`selling_price`,`buying_price`,`mark_name` FROM `market_products` 
						WHERE (`mark_location`IN (SELECT `location` FROM `farmers` WHERE phoneNumber LIKE '%".$phoneNumber."%')) AND `mark_name` LIKE '%ADMARC%' LIMIT 5";																
						$market_products=$db->query($sql5);

                        foreach($market_products as $index=>$market_products){
                            $response.= "> ".$market_products['product_name']."\t MK".$market_products['selling_price']."\n";                                      
                        }

						$response.= "\n";						

						$response .= "1. Kubwelera PaMbuyo\n";
						$response .= "2. Kubwelera Kumayambiliro\n";

						// Print the response onto the page so that our gateway can read it
						header('Content-type: text/plain');
						echo $response;	
						}
                    break;
                    
					case "2":
						if($level==40){							
						// Graduate user to level 14
						$sql4="UPDATE `session` SET `level`=41 where `session_id`='".$sessionId."'";
						$db->query($sql4);
						
						$response = "CON AGORA ya mu Dela\n";
						$response .= "Zotsatilazi Ndi Zomwe Akugula\n\n";                     
                        
						$sql5 = "SELECT DISTINCT `product_name`,`selling_price`,`buying_price`,`mark_name` FROM `market_products` 
						WHERE (`mark_location`IN (SELECT `location` FROM `farmers` WHERE phoneNumber LIKE '%".$phoneNumber."%')) AND `mark_name` LIKE '%AGORA%' LIMIT 5";																
						$market_products=$db->query($sql5);

                        foreach($market_products as $index=>$market_products){
                            $response.= "> ".$market_products['product_name']."\t MK".$market_products['selling_price']."\n";                                      
                        }

						$response.= "\n";						

						$response .= "1. Kubwelera PaMbuyo\n";
						$response .= "2. Kubwelera Kumayambiliro\n";

						// Print the response onto the page so that our gateway can read it
						header('Content-type: text/plain');
						echo $response;	
						}
                    break;

					case "3":
						if($level==40){							
						// Graduate user to level 14
						$sql4="UPDATE `session` SET `level`=41 where `session_id`='".$sessionId."'";
                        $db->query($sql4);

						$response = "CON AGRO-DEALER ya mu Dela\n";
						$response .= "Zotsatilazi Ndi Zomwe Akugula\n\n";                     
                        
						$sql5 = "SELECT DISTINCT `product_name`,`selling_price`,`buying_price`,`mark_name` FROM `market_products` 
						WHERE (`mark_location`IN (SELECT `location` FROM `farmers` WHERE phoneNumber LIKE '%".$phoneNumber."%')) AND `mark_name` LIKE '%AGORA%' LIMIT 5";																
						$market_products=$db->query($sql5);

                        foreach($market_products as $index=>$market_products){
                            $response.= "> ".$market_products['product_name']."\t MK".$market_products['selling_price']."\n";                                      
                        }

						$response.= "\n";						

						$response .= "1. Kubwelera PaMbuyo\n";
						$response .= "2. Kubwelera Kumayambiliro\n";
						// Print the response onto the page so that our gateway can read it
						header('Content-type: text/plain');
						echo $response;	
						}
                    break;

					case "4": // user will be here if he chooses option 2 in english menu
						if($level==40){
							// Graduate user to level 5
							$sql4="UPDATE `session` SET `level`=39 where `session_id`='".$sessionId."'";
							$db->query($sql4);

							$response = "CON Takulandirani Kuno Ku Farmers World\n";
							$response .= "Mwasankha Misika Wogula Zakumunda\n\n";

							$response .= "1. Wonani Misika ndi Zomwe Amagula Kwa Inu\n";
							$response .= "2. Kubwerera pambuyo";

							header('Content-type: text/plain');
							echo $response;				
							}
					break;

					case "5":
						if($level==40){
							// Graduate user to level 2
							$sql2="UPDATE `session` SET `level`=24 where `session_id`='".$sessionId."'";
							$db->query($sql2);
									
							// Menu 2  English
							//Serve English services menu
							$response = "CON Takulandirani Kuno Ku Farmers World\n";
							$response .= "Zikomo Posankha Chichewa \n";
							$response .= "Sankhani Chomwe Mukufuna\n\n";
	
							$response .= "1. Mitsika{Kogula Katundu}\n";
							$response .= "2. Mitsika{Kogulitsa Katundu}\n";
							$response .= "3. Alangizi\n";
							$response .= "4. Kusamala Za Kumunda\n";
							$response .= "5. Mauthenga\n";
							$response .= "6. Account Yanga\n";
										
							// Print the response onto the page so that our gateway can read it
							header('Content-type: text/plain');
							echo $response;
						}
					break;

					default:
						if($level==40){
							// Return user to Main Menu & Demote user's level
							$response = "CON Wrong Option\n";
                            $response .= "Mitsika{Kogula Katundu}\n";
							$response .= "Sankhani Msika\n\n";
		
							$response .= "1. ADMARC\n";
							$response .= "2. AGORA\n";
							$response .= "3. Agro-Dealers\n";
							$response .= "4. Kubwelera PaMbuyo\n";
							$response .= "5. Kubwelera Kumayambiliro\n";

							//update the level to 0 so that the session should start at level 1
							$sql4="UPDATE `session` SET `level`=40 where `session_id`='".$sessionId."'";
							$db->query($sql4);

							// Print the response onto the page so that our gateway can read it
							header('Content-type: text/plain');
							echo $response;	
						}
				}
			}
		}
		else if($level==41){
			if(!$userResponse==""){
				
				switch($userResponse){
					case "1":
						if($level==41){							
                            $sql4="UPDATE `session` SET `level`=40 where `session_id`='".$sessionId."'";
                            $db->query($sql4);
    
                            $response = "CON Mitsika{Kogula Katundu}\n";
							$response .= "Sankhani Msika\n\n";
		
							$response .= "1. ADMARC\n";
							$response .= "2. AGORA\n";
							$response .= "3. Agro-Dealers\n";
							$response .= "4. Kubwelera PaMbuyo\n";
							$response .= "5. Kubwelera Kumayambiliro\n";

						// Print the response onto the page so that our gateway can read it
						header('Content-type: text/plain');
						echo $response;	
						}
					break;

					case "2":   			// returns the user to the main menu
						if($level==41){
							// Graduate user to level 2
							$sql2="UPDATE `session` SET `level`=24 where `session_id`='".$sessionId."'";
							$db->query($sql2);
							
							//Serve the Chichewa Menu
							$response = "CON Takulandirani Kuno Ku Farmers World\n";
							$response .= "Zikomo Posankha Chichewa \n";
							$response .= "Sankhani Chomwe Mukufuna\n\n";

							$response .= "1. Mitsika{Kogula Katundu}\n";
							$response .= "2. Mitsika{Kogulitsa Katundu}\n";
                     		$response .= "3. Alangizi\n";
                     		$response .= "4. Kusamala Za Kumunda\n";
                     		$response .= "5. Mauthenga\n";
							$response .= "6. Account Yanga\n";

							
							// Print the response onto the page so that our gateway can read it
							header('Content-type: text/plain');
							echo $response;
						}
					break;

					default:
						if($level==41){
							// Return user to Main Menu & Demote user's level
							
							$response = "END Mwasankha Molakwika, Chonde yeselaninso\n";
							
							// Print the response onto the page so that our gateway can read it
							header('Content-type: text/plain');
							echo $response;	
						}
				}		
			}
		} 
        else if($level==42){
			if(!$userResponse==""){			//checking that that the user input is not empty
				switch ($userResponse){ 	// from this point we are using user input as a case variable
					case "1":   			// if the choice is 1 the user go to nglish version
						if($level==42){
							//42b. Graduate user to level 2
							$sql2="UPDATE `session` SET `level`=24 where `session_id`='".$sessionId."'";
							$db->query($sql2);
							
							//Serve the Chichewa Menu
							$response = "CON Takulandirani Kuno Ku Farmers World\n";
							$response .= "Zikomo Posankha Chichewa \n";
							$response .= "Sankhani Chomwe Mukufuna\n\n";

							$response .= "1. Mitsika{Kogula Katundu}\n";
							$response .= "2. Mitsika{Kogulitsa Katundu}\n";
                     		$response .= "3. Alangizi\n";
                     		$response .= "4. Kusamala Za Kumunda\n";
                     		$response .= "5. Mauthenga\n";
							$response .= "6. Account Yanga\n";
							
							// Print the response onto the page so that our gateway can read it
							header('Content-type: text/plain');
							echo $response;
						}
					break;

					default:
						if($level==42){
							// Return user to Kubwelera Kumayambiliro & Demote user's level
                            $response = "CON Mwasankha Number Yolakwika, Chonde Yeselaninso\n";
							$response .= "Alangizi A mu Dela Lanu\n\n";
                            
                            $sql5 = "SELECT * FROM `advisors` LIMIT 5";
                            $advisors=$db->query($sql5);

                                foreach($advisors as $index=>$advisors){
                                    $response.= "> ".$advisors['advisor_name']."\t ".$advisors['phone_number']."\n";                                      
                                }

                                $response.= "\n";
                                $response.= "1. Kubwelera Kumayambiliro\n";
							
							//update the level to 0 so that the session should start at level 1
							$sql4="UPDATE `session` SET `level`=42 where `session_id`='".$sessionId."'";
							$db->query($sql4);
		
							// Print the response onto the page so that our gateway can read it
							header('Content-type: text/plain');
							echo $response;	
						}
				}
			}
		}
		else if($level==43){
			if(!$userResponse==""){
				switch($userResponse){
					case "1":
						if($level==43){							
						// Graduate user to level 51
						$sql4="UPDATE `session` SET `level`=44 where `session_id`='".$sessionId."'";
						$db->query($sql4);
						
						$response = "CON Kusamalira Zakumunda\n";
                        $response .= "Chimanga\n";                        
                        $response .= "Sankhani Kuchuluka Kwa Bag \n\n";
                        
						$response .= "1. 50Kg\n";
						$response .= "2. 70Kg\n";
						$response .= "3. Kubwelera Pambuyo\n";							
						$response .= "4. Kubwelera Kumayambiliro\n";             
						
						// Print the response onto the page so that our gateway can read it
						header('Content-type: text/plain');
						echo $response;	
						}
					break;

					case "2":
						if($level==43){							
						// Graduate user to level 53
						$sql4="UPDATE `session` SET `level`=49 where `session_id`='".$sessionId."'";
						$db->query($sql4);
						
						$response = "CON  Kusamalira Zakumunda\n";
						$response .= "Cotton\n";
                        $response .= "Sankhani Kuchuluka Kwa Bag \n\n";
                        
						$response .= "1. 50Kg\n";
						$response .= "2. 70Kg\n";
						$response .= "3. Kubwelera Pambuyo\n";							
						$response .= "4. Kubwelera Kumayambiliro\n";    
						
						// Print the response onto the page so that our gateway can read it
						header('Content-type: text/plain');
						echo $response;	
						}
					break;

					case "3":
						if($level==43){							
						// Graduate user to level 55
						$sql4="UPDATE `session` SET `level`=54 where `session_id`='".$sessionId."'";
						$db->query($sql4);
						
						$response = "CON  Kusamalira Zakumunda\n";
						$response .= "Fodya\n";
                        $response .= "Sankhani Kuchuluka Kwa Bale \n\n";
                        
						$response .= "1. 50Kg\n";
						$response .= "2. 70Kg\n";
						$response .= "3. Kubwelera Pambuyo\n";							
						$response .= "4. Kubwelera Kumayambiliro\n";  
						
						// Print the response onto the page so that our gateway can read it
						header('Content-type: text/plain');
						echo $response;	
						}
                    break;
                    
					case "4":
						if($level==43){							
							// Graduate user to level 2
							$sql4="UPDATE `session` SET `level`=24 where `session_id`='".$sessionId."'";
							$db->query($sql4);
						
							
							//Serve the Chichewa Menu
							$response = "CON Takulandirani Kuno Ku Farmers World\n";
							$response .= "Zikomo Posankha Chichewa \n";
							$response .= "Sankhani Chomwe Mukufuna\n\n";

							$response .= "1. Mitsika{Kogula Katundu}\n";
							$response .= "2. Mitsika{Kogulitsa Katundu}\n";
                     		$response .= "3. Alangizi\n";
                     		$response .= "4. Kusamala Za Kumunda\n";
                     		$response .= "5. Mauthenga\n";
							$response .= "6. Account Yanga\n";
						
							// Print the response onto the page so that our gateway can read it
							header('Content-type: text/plain');
							echo $response;	
						}
					break;

					default:
						if($level==43){
							// Return user to Kubwelera Kumayambiliro & Demote user's level
							$response = "CON Mwasankha Number yolakwika, Chonde yeselaninso\n";
							$response .= "Kusamalira Zakumunda\n";
							$response .= "Sankhani Mbewu Zoti Mukolore\n\n";

							$response .= "1. Chimanga\n";
							$response .= "2. Cotton\n";
							$response .= "3. Fodya\n";
							$response .= "4. Kubwelera Kumayambiliro\n";
														
							//update the level to 0 so that the session should start at level 1
							$sql4="UPDATE `session` SET `level`=43 where `session_id`='".$sessionId."'";
							$db->query($sql4);

							// Print the response onto the page so that our gateway can read it
							header('Content-type: text/plain');
							echo $response;	
						}
				}
			}
		}

		//Chimanga FarmManagement
        else if($level==44){
			if(!$userResponse==""){
				switch($userResponse){
					case "1":
						if($level==44){
							
							// Graduate user to level 64
							$sql4="UPDATE `session` SET `level`=45 where `session_id`='".$sessionId."'";
							$db->query($sql4);

                            $response = "CON Kusamala Za Kumunda\n";
                            $response .= "Chimanga\n\n";
							$response .= "Lowesani Mulingo Wa Matumba a 50Kg\n\n";				
							
							// Print the response onto the page so that our gateway can read it
							header('Content-type: text/plain');
							echo $response;	
						}
					break;
					case "2":
						if($level==44){
																				
							// Graduate user to level 14
							$sql4="UPDATE `session` SET `level`=47 where `session_id`='".$sessionId."'";
							$db->query($sql4);

                            $response = "CON Kusamala Za Kumunda\n";
                            $response .= "Chimanga\n\n";
                            $response .= "Lowesani Mulingo Wa Matumba a 70Kg\n\n";
						
							// Print the response onto the page so that our gateway can read it
							header('Content-type: text/plain');
							echo $response;	
						}
                    break;

                    case "3": // user will be here if he chooses option 4 in english menu
                        if($level==44){
                            // Graduate user to level 7
                            $sql4="UPDATE `session` SET `level`=43 where `session_id`='".$sessionId."'";
                            $db->query($sql4);
                            
                            $response = "CON  Kusamala Za Kumunda\n";
                            $response .= "Kuwelengera Za Ku Munda\n";
							$response .= "Sankhani Mbewu Zomwe Mukufuna Kukolora\n\n";
							
                            $response .= "1. Chimanga\n";
                            $response .= "2. Cotton\n";
                            $response .= "3. Fodya\n";
                            $response .= "4. Kubwelera Kumayambiliro\n";
                            
                            header('Content-type: text/plain');
                            echo $response;				
                        }
                    break;
										
                    case "4":   			// if the choice is 1 the user go to English version
                        if($level==44){
                            // Graduate user to level 2
                            $sql2="UPDATE `session` SET `level`=24 where `session_id`='".$sessionId."'";
                            $db->query($sql2);
							 
							//Serve the Chichewa Menu
							$response = "CON Takulandirani Kuno Ku Farmers World\n";
							$response .= "Zikomo Posankha Chichewa \n";
							$response .= "Sankhani Chomwe Mukufuna\n\n";
 
							$response .= "1. Mitsika{Kogula Katundu}\n";
							$response .= "2. Mitsika{Kogulitsa Katundu}\n";
							$response .= "3. Alangizi\n";
							$response .= "4. Kusamala Za Kumunda\n";
							$response .= "5. Mauthenga\n";
							$response .= "6. Account Yanga\n";
                            
                            // Print the response onto the page so that our gateway can read it
                            header('Content-type: text/plain');
                            echo $response;
                        }
                    break;
					default:
						if($level==44){
							// Return user to Main Menu & Demote user's level
							$response = "CON Mwasankha Number Yolakwika, Chonde Yeselaninso\n";
                            $response .= "Kusamala Za Ku Munda\n";
                            $response .= "Chimanga\n";                        
                            $response .= "Sankhani Kuchuluka Kwa Thumba\n\n";
                            
                            $response .= "1. 50Kg\n";
							$response .= "2. 70Kg\n";
							$response .= "3. Kubwelera Pa Mbuyo\n";							
                            $response .= "4. Kubwelera Ku Mayambiliro\n"; 

							//update the level to 0 so that the session should start at level 1
							$sql4="UPDATE `session` SET `level`=44 where `session_id`='".$sessionId."'";
							$db->query($sql4);

							// Print the response onto the page so that our gateway can read it
							header('Content-type: text/plain');
							echo $response;	
						}
				}
			}
		}
		else if($level==45){
			if(!$userResponse==""){
				
				// Graduate user to level 64
				$sql4="UPDATE `session` SET `level`=46 where `session_id`='".$sessionId."'";
				$db->query($sql4);
	
				$maizeYieldOf50kgs = $userResponse * 0.016;
				$npkBags = 0.0224 * $userResponse;
				$ureaBags = 0.0224 * $userResponse;
	
				$response = "CON Kusamala Za Ku Munda\n\n";
				
				$response .="Kuti Mupeze Matumba $userResponse a ma 50kg,Mufunika:\n>. $maizeYieldOf50kgs hectares ya malo\n>. Matumba $npkBags a Feteleza wa NPK\n>. Matumba $npkBags a Feteleza wa Urea (s)\n>. Mvula Yokwanila.\n\n";
	
				$response .= "1. Kubwelera Pa Mbuyo\n";							
				$response .= "2. Kubwelera Ku Mayambiliro\n";
					
				// Print the response onto the page so that our gateway can read it
				header('Content-type: text/plain');
				echo $response;
				
			}
		}	
		else if($level==46){
			if(!$userResponse==""){			//checking that that the user input is not empty
				switch ($userResponse){ 	// from this point we are using user input as a case variable
					case "1":
						if($level==46){							
							// Graduate user to level 64
							$sql4="UPDATE `session` SET `level`=44 where `session_id`='".$sessionId."'";
							$db->query($sql4);
	
							$response = "CON Kusamala Za Ku Munda\n";
							$response .= "Chimanga\n";                        
							$response .= "Sankhani Kuchuluka Kwa Thumba\n\n";
							
							$response .= "1. 50Kg\n";
							$response .= "2. 70Kg\n";
							$response .= "3. Kubwelera Pa Mbuyo\n";							
							$response .= "4. Kubwelera Ku Mayambiliro\n";
	
							// Print the response onto the page so that our gateway can read it
							header('Content-type: text/plain');
							echo $response;	
						}
						break;
					case "2":   			// if the choice is 2 the user go to nglish version
						if($level==46){
							// Graduate user to level 2
							$sql2="UPDATE `session` SET `level`=24 where `session_id`='".$sessionId."'";
							$db->query($sql2);
							//Serve the Chichewa Menu
							$response = "CON Takulandirani Kuno Ku Farmers World\n";
							$response .= "Zikomo Posankha Chichewa \n";
							$response .= "Sankhani Chomwe Mukufuna\n\n";
	 
							$response .= "1. Mitsika{Kogula Katundu}\n";
							$response .= "2. Mitsika{Kogulitsa Katundu}\n";
							$response .= "3. Alangizi\n";
							$response .= "4. Kusamala Za Kumunda\n";
							$response .= "5. Mauthenga\n";
							$response .= "6. Account Yanga\n";
								
							// Print the response onto the page so that our gateway can read it
							header('Content-type: text/plain');
							echo $response;
						}
					break;
	
					default:
						if($level==46){
							$sql5 = "SELECT `received_message` FROM ussd_notifications WHERE phonenumber LIKE '%".$phoneNumber."%' LIMIT 1";
							$fQuery=$db->query($sql5);
							$Available=$fQuery->fetch_assoc();
				
							$response = "CON Mwasankha Number Yolakwika, Chonde Yeselaninso\n\n";
							$maizeYieldOf50kgs = $userResponse * 0.016;
							$npkBags = 0.0224 * $userResponse;
							$ureaBags = 0.0224 * $userResponse;
					
							$response = "CON Kusamala Za Ku Munda\n\n";
							
							$response .="Kuti Mupeze Matumba $userResponse a ma 50kg,Mufunika:\n>. $maizeYieldOf50kgs hectares ya malo\n>. Matumba $npkBags a Feteleza wa NPK\n>. Matumba $npkBags a Feteleza wa Urea (s)\n>. Mvula Yokwanila.\n\n";
				
							$response .= "1. Kubwelera Pa Mbuyo\n";							
							$response .= "2. Kubwelera Ku Mayambiliro\n";
								
							//update the level to 0 so that the session should start at level 1
							$sql4="UPDATE `session` SET `level`=46 where `session_id`='".$sessionId."'";
							$db->query($sql4);
			
							// Print the response onto the page so that our gateway can read it
							header('Content-type: text/plain');
							echo $response;	
						}
				}
			}
		}
		else if($level==47){
			if(!$userResponse==""){
				
				// Graduate user to level 64
				$sql4="UPDATE `session` SET `level`=48 where `session_id`='".$sessionId."'";
				$db->query($sql4);

				$maizeYieldOf70kgs = $userResponse * 0.0224;
				$npkBags = 0.04 * $userResponse;
				$ureaBags = 0.04 * $userResponse;
				
				$response = "CON Kusamala Za Ku Munda\n\n";
                
				$response .="Kuti Mupeze Matumba $userResponse a ma 70kg,Mufunika:\n>. $maizeYieldOf70kgs hectares ya malo\n>. Matumba $npkBags a Feteleza wa NPK\n>. Matumba $npkBags a Feteleza wa Urea (s)\n>. Mvula Yokwanila.\n\n";
				$response .= "1. Kubwelera Pa Mbuyo\n";							
				$response .= "2. Kubwelera Ku Mayambiliro\n";
					
				// Print the response onto the page so that our gateway can read it
				header('Content-type: text/plain');
				echo $response;
				
			}
		}
		else if($level==48){
			if(!$userResponse==""){			//checking that that the user input is not empty
				switch ($userResponse){ 	// from this point we are using user input as a case variable
					case "1":
						if($level==48){							
						// Graduate user to level 64
						$sql4="UPDATE `session` SET `level`=44 where `session_id`='".$sessionId."'";
						$db->query($sql4);

						$response = "CON Kusamala Za Ku Munda\n";
						$response .= "Chimanga\n";                        
						$response .= "Sankhani Kuchuluka Kwa Thumba\n\n";
						
						$response .= "1. 50Kg\n";
						$response .= "2. 70Kg\n";
						$response .= "3. Kubwelera Pa Mbuyo\n";							
						$response .= "4. Kubwelera Ku Mayambiliro\n";  

						// Print the response onto the page so that our gateway can read it
						header('Content-type: text/plain');
						echo $response;	
						}
					break;
					case "2":   			// if the choice is 2 the user go to nglish version
						if($level==48){
							// Graduate user to level 2
							$sql2="UPDATE `session` SET `level`=24 where `session_id`='".$sessionId."'";
							$db->query($sql2);

							$response = "CON Takulandirani Kuno Ku Farmers World\n";
							$response .= "Zikomo Posankha Chichewa \n";
							$response .= "Sankhani Chomwe Mukufuna\n\n";
 
							$response .= "1. Mitsika{Kogula Katundu}\n";
							$response .= "2. Mitsika{Kogulitsa Katundu}\n";
							$response .= "3. Alangizi\n";
							$response .= "4. Kusamala Za Kumunda\n";
							$response .= "5. Mauthenga\n";
							$response .= "6. Account Yanga\n";
							
							// Print the response onto the page so that our gateway can read it
							header('Content-type: text/plain');
							echo $response;
						}
					break;

					default:
						if($level==48){
                            $sql5 = "SELECT `received_message` FROM ussd_notifications WHERE phonenumber LIKE '%".$phoneNumber."%' LIMIT 1";
                            $fQuery=$db->query($sql5);
                            $Available=$fQuery->fetch_assoc();
            
                            $maizeYieldOf70kgs = $userResponse * 0.0224;
							$npkBags = 0.04 * $userResponse;
							$ureaBags = 0.04 * $userResponse;
							
							$response = "CON Mwasankha Number Yolakwika, Chonde Yeselaninso\n\n";
							$response .= "Kusamala Za Ku Munda\n\n";
							
							$response .="Kuti Mupeze Matumba $userResponse a ma 70kg,Mufunika:\n>. $maizeYieldOf70kgs hectares ya malo\n>. Matumba $npkBags a Feteleza wa NPK\n>. Matumba $npkBags a Feteleza wa Urea (s)\n>. Mvula Yokwanila.\n\n";
							$response .= "1. Kubwelera Pa Mbuyo\n";							
							$response .= "2. Kubwelera Ku Mayambiliro\n";
								
							// Print the response onto the page so that our gateway can read it
							header('Content-type: text/plain');
							echo $response;
							
							//update the level to 0 so that the session should start at level 1
							$sql4="UPDATE `session` SET `level`=48 where `session_id`='".$sessionId."'";
							$db->query($sql4);
		
							// Print the response onto the page so that our gateway can read it
							header('Content-type: text/plain');
							echo $response;	
						}
				}
			}
		}

		//Cotton FarmManagement
        else if($level==49){
			if(!$userResponse==""){
				switch($userResponse){
					case "1":
						if($level==49){
							
							// Graduate user to level 64
							$sql4="UPDATE `session` SET `level`=50 where `session_id`='".$sessionId."'";
							$db->query($sql4);

                            $response = "CON Kusamala Za Kumunda\n";
                            $response .= "Cotton\n\n";
							$response .= "Lowesani Mulingo Wa Matumba a 50Kg\n\n";				
							
							// Print the response onto the page so that our gateway can read it
							header('Content-type: text/plain');
							echo $response;	
						}
					break;
					case "2":
						if($level==49){
																				
							// Graduate user to level 14
							$sql4="UPDATE `session` SET `level`=52 where `session_id`='".$sessionId."'";
							$db->query($sql4);

                            $response = "CON Kusamala Za Kumunda\n";
                            $response .= "Cotton\n\n";
                            $response .= "Lowesani Mulingo Wa Matumba a 70Kg\n\n";
						
							// Print the response onto the page so that our gateway can read it
							header('Content-type: text/plain');
							echo $response;	
						}
                    break;

                    case "3": // user will be here if he chooses option 4 in english menu
                        if($level==49){
                            // Graduate user to level 7
                            $sql4="UPDATE `session` SET `level`=43 where `session_id`='".$sessionId."'";
                            $db->query($sql4);
                            
                            $response = "CON  Kusamala Za Kumunda\n";
                            $response .= "Kuwelengera Za Ku Munda\n";
							$response .= "Sankhani Mbewu Zomwe Mukufuna Kukolora\n\n";
							
                            $response .= "1. Chimanga\n";
                            $response .= "2. Cotton\n";
                            $response .= "3. Fodya\n";
                            $response .= "4. Kubwelera Kumayambiliro\n";
                            
                            header('Content-type: text/plain');
                            echo $response;				
                        }
                    break;
										
                    case "4":   			// if the choice is 1 the user go to English version
                        if($level==49){
                            // Graduate user to level 2
                            $sql2="UPDATE `session` SET `level`=24 where `session_id`='".$sessionId."'";
                            $db->query($sql2);
							 
							//Serve the Chichewa Menu
							$response = "CON Takulandirani Kuno Ku Farmers World\n";
							$response .= "Zikomo Posankha Chichewa \n";
							$response .= "Sankhani Chomwe Mukufuna\n\n";
 
							$response .= "1. Mitsika{Kogula Katundu}\n";
							$response .= "2. Mitsika{Kogulitsa Katundu}\n";
							$response .= "3. Alangizi\n";
							$response .= "4. Kusamala Za Kumunda\n";
							$response .= "5. Mauthenga\n";
							$response .= "6. Account Yanga\n";
                            
                            // Print the response onto the page so that our gateway can read it
                            header('Content-type: text/plain');
                            echo $response;
                        }
                    break;
					default:
						if($level==49){
							// Return user to Main Menu & Demote user's level
							$response = "CON Mwasankha Number Yolakwika, Chonde Yeselaninso\n";
                            $response .= "Kusamala Za Ku Munda\n";
                            $response .= "Cotton\n";                        
                            $response .= "Sankhani Kuchuluka Kwa Thumba\n\n";
                            
                            $response .= "1. 50Kg\n";
							$response .= "2. 70Kg\n";
							$response .= "3. Kubwelera Pa Mbuyo\n";							
                            $response .= "4. Kubwelera Ku Mayambiliro\n"; 

							//update the level to 0 so that the session should start at level 1
							$sql4="UPDATE `session` SET `level`=49 where `session_id`='".$sessionId."'";
							$db->query($sql4);

							// Print the response onto the page so that our gateway can read it
							header('Content-type: text/plain');
							echo $response;	
						}
				}
			}
		}
		else if($level==50){
			if(!$userResponse==""){
				
				// Graduate user to level 64
				$sql4="UPDATE `session` SET `level`=51 where `session_id`='".$sessionId."'";
				$db->query($sql4);
	
				$maizeYieldOf50kgs = $userResponse * 0.016;
				$npkBags = 0.0224 * $userResponse;
				$ureaBags = 0.0224 * $userResponse;
	
				$response = "CON Kusamala Za Ku Munda\n\n";
				
				$response .="Kuti Mupeze Matumba $userResponse a ma 50kg,Mufunika:\n>. $maizeYieldOf50kgs hectares ya malo\n>. Matumba $npkBags a Feteleza wa NPK\n>. Matumba $npkBags a Feteleza wa Urea (s)\n>. Mvula Yokwanila.\n\n";
	
				$response .= "1. Kubwelera Pa Mbuyo\n";							
				$response .= "2. Kubwelera Ku Mayambiliro\n";
					
				// Print the response onto the page so that our gateway can read it
				header('Content-type: text/plain');
				echo $response;
				
			}
		}	
		else if($level==51){
			if(!$userResponse==""){			//checking that that the user input is not empty
				switch ($userResponse){ 	// from this point we are using user input as a case variable
					case "1":
						if($level==51){							
							// Graduate user to level 64
							$sql4="UPDATE `session` SET `level`=49 where `session_id`='".$sessionId."'";
							$db->query($sql4);
	
							$response = "CON Kusamala Za Ku Munda\n";
							$response .= "Cotton\n";                        
							$response .= "Sankhani Kuchuluka Kwa Thumba\n\n";
							
							$response .= "1. 50Kg\n";
							$response .= "2. 70Kg\n";
							$response .= "3. Kubwelera Pa Mbuyo\n";							
							$response .= "4. Kubwelera Ku Mayambiliro\n";
	
							// Print the response onto the page so that our gateway can read it
							header('Content-type: text/plain');
							echo $response;	
						}
						break;
					case "2":   			// if the choice is 2 the user go to nglish version
						if($level==51){
							// Graduate user to level 2
							$sql2="UPDATE `session` SET `level`=24 where `session_id`='".$sessionId."'";
							$db->query($sql2);
							//Serve the Chichewa Menu
							$response = "CON Takulandirani Kuno Ku Farmers World\n";
							$response .= "Zikomo Posankha Chichewa \n";
							$response .= "Sankhani Chomwe Mukufuna\n\n";
	 
							$response .= "1. Mitsika{Kogula Katundu}\n";
							$response .= "2. Mitsika{Kogulitsa Katundu}\n";
							$response .= "3. Alangizi\n";
							$response .= "4. Kusamala Za Kumunda\n";
							$response .= "5. Mauthenga\n";
							$response .= "6. Account Yanga\n";
								
							// Print the response onto the page so that our gateway can read it
							header('Content-type: text/plain');
							echo $response;
						}
					break;
	
					default:
						if($level==51){
							$sql5 = "SELECT `received_message` FROM ussd_notifications WHERE phonenumber LIKE '%".$phoneNumber."%' LIMIT 1";
							$fQuery=$db->query($sql5);
							$Available=$fQuery->fetch_assoc();
				
							$response = "CON Mwasankha Number Yolakwika, Chonde Yeselaninso\n\n";
							$maizeYieldOf50kgs = $userResponse * 0.016;
							$npkBags = 0.0224 * $userResponse;
							$ureaBags = 0.0224 * $userResponse;
					
							$response = "CON Kusamala Za Ku Munda\n\n";
							
							$response .="Kuti Mupeze Matumba $userResponse a ma 50kg,Mufunika:\n>. $maizeYieldOf50kgs hectares ya malo\n>. Matumba $npkBags a Feteleza wa NPK\n>. Matumba $npkBags a Feteleza wa Urea (s)\n>. Mvula Yokwanila.\n\n";
				
							$response .= "1. Kubwelera Pa Mbuyo\n";							
							$response .= "2. Kubwelera Ku Mayambiliro\n";
								
							//update the level to 0 so that the session should start at level 1
							$sql4="UPDATE `session` SET `level`=51 where `session_id`='".$sessionId."'";
							$db->query($sql4);
			
							// Print the response onto the page so that our gateway can read it
							header('Content-type: text/plain');
							echo $response;	
						}
				}
			}
		}
		else if($level==52){
			if(!$userResponse==""){
				
				// Graduate user to level 64
				$sql4="UPDATE `session` SET `level`=53 where `session_id`='".$sessionId."'";
				$db->query($sql4);

				$maizeYieldOf70kgs = $userResponse * 0.0224;
				$npkBags = 0.04 * $userResponse;
				$ureaBags = 0.04 * $userResponse;
				
				$response = "CON Kusamala Za Ku Munda\n\n";
                
				$response .="Kuti Mupeze Matumba $userResponse a ma 70kg,Mufunika:\n>. $maizeYieldOf70kgs hectares ya malo\n>. Matumba $npkBags a Feteleza wa NPK\n>. Matumba $npkBags a Feteleza wa Urea (s)\n>. Mvula Yokwanila.\n\n";
				$response .= "1. Kubwelera Pa Mbuyo\n";							
				$response .= "2. Kubwelera Ku Mayambiliro\n";
					
				// Print the response onto the page so that our gateway can read it
				header('Content-type: text/plain');
				echo $response;
				
			}
		}
		else if($level==53){
			if(!$userResponse==""){			//checking that that the user input is not empty
				switch ($userResponse){ 	// from this point we are using user input as a case variable
					case "1":
						if($level==53){							
						// Graduate user to level 64
						$sql4="UPDATE `session` SET `level`=49 where `session_id`='".$sessionId."'";
						$db->query($sql4);

						$response = "CON Kusamala Za Ku Munda\n";
						$response .= "Cotton\n";                        
						$response .= "Sankhani Kuchuluka Kwa Thumba\n\n";
						
						$response .= "1. 50Kg\n";
						$response .= "2. 70Kg\n";
						$response .= "3. Kubwelera Pa Mbuyo\n";							
						$response .= "4. Kubwelera Ku Mayambiliro\n";  

						// Print the response onto the page so that our gateway can read it
						header('Content-type: text/plain');
						echo $response;	
						}
					break;
					case "2":   			// if the choice is 2 the user go to nglish version
						if($level==53){
							// Graduate user to level 2
							$sql2="UPDATE `session` SET `level`=24 where `session_id`='".$sessionId."'";
							$db->query($sql2);

							$response = "CON Takulandirani Kuno Ku Farmers World\n";
							$response .= "Zikomo Posankha Chichewa \n";
							$response .= "Sankhani Chomwe Mukufuna\n\n";
 
							$response .= "1. Mitsika{Kogula Katundu}\n";
							$response .= "2. Mitsika{Kogulitsa Katundu}\n";
							$response .= "3. Alangizi\n";
							$response .= "4. Kusamala Za Kumunda\n";
							$response .= "5. Mauthenga\n";
							$response .= "6. Account Yanga\n";
							
							// Print the response onto the page so that our gateway can read it
							header('Content-type: text/plain');
							echo $response;
						}
					break;

					default:
						if($level==53){
                            $sql5 = "SELECT `received_message` FROM ussd_notifications WHERE phonenumber LIKE '%".$phoneNumber."%' LIMIT 1";
                            $fQuery=$db->query($sql5);
                            $Available=$fQuery->fetch_assoc();
            
                            $maizeYieldOf70kgs = $userResponse * 0.0224;
							$npkBags = 0.04 * $userResponse;
							$ureaBags = 0.04 * $userResponse;
							
							$response = "CON Mwasankha Number Yolakwika, Chonde Yeselaninso\n\n";
							$response .= "Kusamala Za Ku Munda\n\n";
							
							$response .="Kuti Mupeze Matumba $userResponse a ma 70kg,Mufunika:\n>. $maizeYieldOf70kgs hectares ya malo\n>. Matumba $npkBags a Feteleza wa NPK\n>. Matumba $npkBags a Feteleza wa Urea (s)\n>. Mvula Yokwanila.\n\n";
							$response .= "1. Kubwelera Pa Mbuyo\n";							
							$response .= "2. Kubwelera Ku Mayambiliro\n";
								
							// Print the response onto the page so that our gateway can read it
							header('Content-type: text/plain');
							echo $response;
							
							//update the level to 0 so that the session should start at level 1
							$sql4="UPDATE `session` SET `level`=53 where `session_id`='".$sessionId."'";
							$db->query($sql4);
		
							// Print the response onto the page so that our gateway can read it
							header('Content-type: text/plain');
							echo $response;	
						}
				}
			}
		}		

		//Cotton FarmManagement
        else if($level==54){
			if(!$userResponse==""){
				switch($userResponse){
					case "1":
						if($level==54){
							
							// Graduate user to level 64
							$sql4="UPDATE `session` SET `level`=55 where `session_id`='".$sessionId."'";
							$db->query($sql4);

                            $response = "CON Kusamala Za Kumunda\n";
                            $response .= "Fodya\n\n";
							$response .= "Lowesani Mulingo Wa Matumba a 55Kg\n\n";				
							
							// Print the response onto the page so that our gateway can read it
							header('Content-type: text/plain');
							echo $response;	
						}
					break;
					case "2":
						if($level==54){
																				
							// Graduate user to level 14
							$sql4="UPDATE `session` SET `level`=57 where `session_id`='".$sessionId."'";
							$db->query($sql4);

                            $response = "CON Kusamala Za Kumunda\n";
                            $response .= "Fodya\n\n";
                            $response .= "Lowesani Mulingo Wa Matumba a 70Kg\n\n";
						
							// Print the response onto the page so that our gateway can read it
							header('Content-type: text/plain');
							echo $response;	
						}
                    break;

                    case "3": // user will be here if he chooses option 4 in english menu
                        if($level==54){
                            // Graduate user to level 7
                            $sql4="UPDATE `session` SET `level`=43 where `session_id`='".$sessionId."'";
                            $db->query($sql4);
                            
                            $response = "CON  Kusamala Za Kumunda\n";
                            $response .= "Kuwelengera Za Ku Munda\n";
							$response .= "Sankhani Mbewu Zomwe Mukufuna Kukolora\n\n";
							
                            $response .= "1. Chimanga\n";
                            $response .= "2. Cotton\n";
                            $response .= "3. Fodya\n";
                            $response .= "4. Kubwelera Kumayambiliro\n";
                            
                            header('Content-type: text/plain');
                            echo $response;				
                        }
                    break;
										
                    case "4":   			// if the choice is 1 the user go to English version
                        if($level==54){
                            // Graduate user to level 2
                            $sql2="UPDATE `session` SET `level`=24 where `session_id`='".$sessionId."'";
                            $db->query($sql2);
							 
							//Serve the Chichewa Menu
							$response = "CON Takulandirani Kuno Ku Farmers World\n";
							$response .= "Zikomo Posankha Chichewa \n";
							$response .= "Sankhani Chomwe Mukufuna\n\n";
 
							$response .= "1. Mitsika{Kogula Katundu}\n";
							$response .= "2. Mitsika{Kogulitsa Katundu}\n";
							$response .= "3. Alangizi\n";
							$response .= "4. Kusamala Za Kumunda\n";
							$response .= "5. Mauthenga\n";
							$response .= "6. Account Yanga\n";
                            
                            // Print the response onto the page so that our gateway can read it
                            header('Content-type: text/plain');
                            echo $response;
                        }
                    break;
					default:
						if($level==54){
							// Return user to Main Menu & Demote user's level
							$response = "CON Mwasankha Number Yolakwika, Chonde Yeselaninso\n";
                            $response .= "Kusamala Za Ku Munda\n";
                            $response .= "Fodya\n";                        
                            $response .= "Sankhani Kuchuluka Kwa Thumba\n\n";
                            
                            $response .= "1. 55Kg\n";
							$response .= "2. 70Kg\n";
							$response .= "3. Kubwelera Pa Mbuyo\n";							
                            $response .= "4. Kubwelera Ku Mayambiliro\n"; 

							//update the level to 0 so that the session should start at level 1
							$sql4="UPDATE `session` SET `level`=54 where `session_id`='".$sessionId."'";
							$db->query($sql4);

							// Print the response onto the page so that our gateway can read it
							header('Content-type: text/plain');
							echo $response;	
						}
				}
			}
		}
		else if($level==55){
			if(!$userResponse==""){
				
				// Graduate user to level 64
				$sql4="UPDATE `session` SET `level`=56 where `session_id`='".$sessionId."'";
				$db->query($sql4);
	
				$maizeYieldOf55kgs = $userResponse * 0.016;
				$npkBags = 0.0224 * $userResponse;
				$ureaBags = 0.0224 * $userResponse;
	
				$response = "CON Kusamala Za Ku Munda\n\n";
				
				$response .="Kuti Mupeze Matumba $userResponse a ma 55kg,Mufunika:\n>. $maizeYieldOf55kgs hectares ya malo\n>. Matumba $npkBags a Feteleza wa NPK\n>. Matumba $npkBags a Feteleza wa Urea (s)\n>. Mvula Yokwanila.\n\n";
	
				$response .= "1. Kubwelera Pa Mbuyo\n";							
				$response .= "2. Kubwelera Ku Mayambiliro\n";
					
				// Print the response onto the page so that our gateway can read it
				header('Content-type: text/plain');
				echo $response;
				
			}
		}	
		else if($level==56){
			if(!$userResponse==""){			//checking that that the user input is not empty
				switch ($userResponse){ 	// from this point we are using user input as a case variable
					case "1":
						if($level==56){							
							// Graduate user to level 64
							$sql4="UPDATE `session` SET `level`=54 where `session_id`='".$sessionId."'";
							$db->query($sql4);
	
							$response = "CON Kusamala Za Ku Munda\n";
							$response .= "Fodya\n";                        
							$response .= "Sankhani Kuchuluka Kwa Thumba\n\n";
							
							$response .= "1. 55Kg\n";
							$response .= "2. 70Kg\n";
							$response .= "3. Kubwelera Pa Mbuyo\n";							
							$response .= "4. Kubwelera Ku Mayambiliro\n";
	
							// Print the response onto the page so that our gateway can read it
							header('Content-type: text/plain');
							echo $response;	
						}
						break;
					case "2":   			// if the choice is 2 the user go to nglish version
						if($level==56){
							// Graduate user to level 2
							$sql2="UPDATE `session` SET `level`=24 where `session_id`='".$sessionId."'";
							$db->query($sql2);
							//Serve the Chichewa Menu
							$response = "CON Takulandirani Kuno Ku Farmers World\n";
							$response .= "Zikomo Posankha Chichewa \n";
							$response .= "Sankhani Chomwe Mukufuna\n\n";
	 
							$response .= "1. Mitsika{Kogula Katundu}\n";
							$response .= "2. Mitsika{Kogulitsa Katundu}\n";
							$response .= "3. Alangizi\n";
							$response .= "4. Kusamala Za Kumunda\n";
							$response .= "5. Mauthenga\n";
							$response .= "6. Account Yanga\n";
								
							// Print the response onto the page so that our gateway can read it
							header('Content-type: text/plain');
							echo $response;
						}
					break;
	
					default:
						if($level==56){
							$sql5 = "SELECT `received_message` FROM ussd_notifications WHERE phonenumber LIKE '%".$phoneNumber."%' LIMIT 1";
							$fQuery=$db->query($sql5);
							$Available=$fQuery->fetch_assoc();
				
							$response = "CON Mwasankha Number Yolakwika, Chonde Yeselaninso\n\n";
							$maizeYieldOf55kgs = $userResponse * 0.016;
							$npkBags = 0.0224 * $userResponse;
							$ureaBags = 0.0224 * $userResponse;
					
							$response = "CON Kusamala Za Ku Munda\n\n";
							
							$response .="Kuti Mupeze Matumba $userResponse a ma 55kg,Mufunika:\n>. $maizeYieldOf55kgs hectares ya malo\n>. Matumba $npkBags a Feteleza wa NPK\n>. Matumba $npkBags a Feteleza wa Urea (s)\n>. Mvula Yokwanila.\n\n";
				
							$response .= "1. Kubwelera Pa Mbuyo\n";							
							$response .= "2. Kubwelera Ku Mayambiliro\n";
								
							//update the level to 0 so that the session should start at level 1
							$sql4="UPDATE `session` SET `level`=56 where `session_id`='".$sessionId."'";
							$db->query($sql4);
			
							// Print the response onto the page so that our gateway can read it
							header('Content-type: text/plain');
							echo $response;	
						}
				}
			}
		}
		else if($level==57){
			if(!$userResponse==""){
				
				// Graduate user to level 64
				$sql4="UPDATE `session` SET `level`=58 where `session_id`='".$sessionId."'";
				$db->query($sql4);

				$maizeYieldOf70kgs = $userResponse * 0.0224;
				$npkBags = 0.04 * $userResponse;
				$ureaBags = 0.04 * $userResponse;
				
				$response = "CON Kusamala Za Ku Munda\n\n";
                
				$response .="Kuti Mupeze Matumba $userResponse a ma 70kg,Mufunika:\n>. $maizeYieldOf70kgs hectares ya malo\n>. Matumba $npkBags a Feteleza wa NPK\n>. Matumba $npkBags a Feteleza wa Urea (s)\n>. Mvula Yokwanila.\n\n";
				$response .= "1. Kubwelera Pa Mbuyo\n";							
				$response .= "2. Kubwelera Ku Mayambiliro\n";
					
				// Print the response onto the page so that our gateway can read it
				header('Content-type: text/plain');
				echo $response;
				
			}
		}
		else if($level==58){
			if(!$userResponse==""){			//checking that that the user input is not empty
				switch ($userResponse){ 	// from this point we are using user input as a case variable
					case "1":
						if($level==58){							
						// Graduate user to level 64
						$sql4="UPDATE `session` SET `level`=54 where `session_id`='".$sessionId."'";
						$db->query($sql4);

						$response = "CON Kusamala Za Ku Munda\n";
						$response .= "Fodya\n";                        
						$response .= "Sankhani Kuchuluka Kwa Thumba\n\n";
						
						$response .= "1. 55Kg\n";
						$response .= "2. 70Kg\n";
						$response .= "3. Kubwelera Pa Mbuyo\n";							
						$response .= "4. Kubwelera Ku Mayambiliro\n";  

						// Print the response onto the page so that our gateway can read it
						header('Content-type: text/plain');
						echo $response;	
						}
					break;
					case "2":   			// if the choice is 2 the user go to nglish version
						if($level==58){
							// Graduate user to level 2
							$sql2="UPDATE `session` SET `level`=24 where `session_id`='".$sessionId."'";
							$db->query($sql2);

							$response = "CON Takulandirani Kuno Ku Farmers World\n";
							$response .= "Zikomo Posankha Chichewa \n";
							$response .= "Sankhani Chomwe Mukufuna\n\n";
 
							$response .= "1. Mitsika{Kogula Katundu}\n";
							$response .= "2. Mitsika{Kogulitsa Katundu}\n";
							$response .= "3. Alangizi\n";
							$response .= "4. Kusamala Za Kumunda\n";
							$response .= "5. Mauthenga\n";
							$response .= "6. Account Yanga\n";
							
							// Print the response onto the page so that our gateway can read it
							header('Content-type: text/plain');
							echo $response;
						}
					break;

					default:
						if($level==58){
                            $sql5 = "SELECT `received_message` FROM ussd_notifications WHERE phonenumber LIKE '%".$phoneNumber."%' LIMIT 1";
                            $fQuery=$db->query($sql5);
                            $Available=$fQuery->fetch_assoc();
            
                            $maizeYieldOf70kgs = $userResponse * 0.0224;
							$npkBags = 0.04 * $userResponse;
							$ureaBags = 0.04 * $userResponse;
							
							$response = "CON Mwasankha Number Yolakwika, Chonde Yeselaninso\n\n";
							$response .= "Kusamala Za Ku Munda\n\n";
							
							$response .="Kuti Mupeze Matumba $userResponse a ma 70kg,Mufunika:\n>. $maizeYieldOf70kgs hectares ya malo\n>. Matumba $npkBags a Feteleza wa NPK\n>. Matumba $npkBags a Feteleza wa Urea (s)\n>. Mvula Yokwanila.\n\n";
							$response .= "1. Kubwelera Pa Mbuyo\n";							
							$response .= "2. Kubwelera Ku Mayambiliro\n";
								
							// Print the response onto the page so that our gateway can read it
							header('Content-type: text/plain');
							echo $response;
							
							//update the level to 0 so that the session should start at level 1
							$sql4="UPDATE `session` SET `level`=58 where `session_id`='".$sessionId."'";
							$db->query($sql4);
		
							// Print the response onto the page so that our gateway can read it
							header('Content-type: text/plain');
							echo $response;	
						}
				}
			}
		}

		//Menu 5. Mauthenga
		else if($level==59){
            if(!$userResponse==""){
                switch($userResponse){
                    case "1":
                        if($level==59){							
                            // Graduate user to level 4
                            $sql4="UPDATE `session` SET `level`=60 where `session_id`='".$sessionId."'";
                            $db->query($sql4);                    


							$sql5 = "SELECT DISTINCT `sent_message`,`farmer_id`,`created_at`
									 FROM `ussd_notifications`
									 WHERE `farmer_id` IN ( SELECT `id` FROM 
									`farmers` WHERE phoneNumber LIKE '%".$phoneNumber."%')
									ORDER BY `created_at` DESC
									LIMIT 1";

							$ussd_notifications=$db->query($sql5);
							
							$response = "CON Mauthenga\n";
							$response .= "Uthenga Wakumene\n\n";

                            foreach($ussd_notifications as $index=>$ussd_notifications){
                                    $response.= "".$ussd_notifications['sent_message']."\n\n";                                      
							}

							$response.= "1. Kubwelera Pambuyo\n";
							$response.= "2. Kubwelera Kumayambiliro\n";

							// Print the response onto the page so that our gateway can read it
							header('Content-type: text/plain');
							echo $response;
                        }    
                    break;

                    case "2":   			// if the choice is 1 the user go to English version
                        if($level==59){
                            // Graduate user to level 2
                            $sql2="UPDATE `session` SET `level`=2 where `session_id`='".$sessionId."'";
                            $db->query($sql2);
                            //Menu 2  English
                            //Serve English services menu
							$response = "CON Takulandirani Kuno Ku Farmers World\n";
							$response .= "Zikomo Posankha Chichewa \n";
							$response .= "Sankhani Chomwe Mukufuna\n\n";
 
							$response .= "1. Mitsika{Kogula Katundu}\n";
							$response .= "2. Mitsika{Kogulitsa Katundu}\n";
							$response .= "3. Alangizi\n";
							$response .= "4. Kusamala Za Kumunda\n";
							$response .= "5. Mauthenga\n";
							$response .= "6. Account Yanga\n";
                            
                            // Print the response onto the page so that our gateway can read it
                            header('Content-type: text/plain');
                            echo $response;
                        }
                    break;

                    default:
                        if($level==59){
							      // Return user to Main Menu & Demote user's level
							
							$response = "CON Mwasankha Number Yolakwika, Conde Yeselaninso\n";
							$response .= "Gawo la Mauthenga\n";
							$response .= "Mwasankha Mauthenga\n\n";
							
							$response .= "1. Mauthenga Olandilidwa\n";
							$response .= "2. Kubwelera Kumayambiliro";
                                                            
                            //update the level to 0 so that the session should start at level 1
                            $sql4="UPDATE `session` SET `level`=59 where `session_id`='".$sessionId."'";
                            $db->query($sql4);

                            // Print the response onto the page so that our gateway can read it
                            header('Content-type: text/plain');
                            echo $response;	
                        }
                }
            }
		}
		else if($level==60){
			if(!$userResponse==""){			//checking that that the user input is not empty
				switch ($userResponse){ 	// from this point we are using user input as a case variable
					case "1": // user will be here if he chooses option 5 in Chichewa menu
						if($level==24){
							// Graduate user to level 126
							$sql4="UPDATE `session` SET `level`=59 where `session_id`='".$sessionId."'";
							$db->query($sql4);
							
							$response = "CON Gawo la Mauthenga\n";
							$response .= "Mwasankha Mauthenga\n\n";
							
							$response .= "1. Mauthenga Olandilidwa\n";
							$response .= "2. Kubwelera Kumayambiliro";
							
							header('Content-type: text/plain');
							echo $response;				
						}
					break;

					case "2": // the choice is 2 the user go to Chichewa version
						if($level==60){
							// Graduate user to level 2
							$sql2="UPDATE `session` SET `level`=24 where `session_id`='".$sessionId."'";
							$db->query($sql2);

							//Servr the Chichewa Menu
							$response = "CON Takulandirani Kuno Ku Farmers World\n";
							$response .= "Zikomo Posankha Chichewa \n";
							$response .= "Sankhani Chomwe Mukufuna\n\n";
 
							$response .= "1. Mitsika{Kogula Katundu}\n";
							$response .= "2. Mitsika{Kogulitsa Katundu}\n";
							$response .= "3. Alangizi\n";
							$response .= "4. Kusamala Za Kumunda\n";
							$response .= "5. Mauthenga\n";
							$response .= "6. Account Yanga\n";
							// Print the response onto the page so that our gateway can read it
							header('Content-type: text/plain');
							echo $response;				
						}
					break;

					default:
						if($level==60){
							// Return user to Main Menu & Demote user's level
							$response = "END Mwasankha Number Yolakwika, Chonde Yeselaninso\n\n";
							
							// Print the response onto the page so that our gateway can read it
							header('Content-type: text/plain');
							echo $response;	
						}
				}
			}
		}
        //My Account Menu
		else if($level==61){
			if(!$userResponse==""){
				switch($userResponse){
					case "1":
						if($level==61){							
						// Graduate user to level 14
						$sql4="UPDATE `session` SET `level`=62 where `session_id`='".$sessionId."'";
						$db->query($sql4);

						$response = "CON Gawo La Akaunti Yanga\n";
						$response .= "Mwasankha Za Akaunti Yanu\n\n";

						$response .= "1. Sinthani Za Akaunti Yanu\n";
						$response .= "2. Wonani Za Akaunti Yanu\n";
						$response .= "3. Kubwerera pambuyo";

						// Print the response onto the page so that our gateway can read it
						header('Content-type: text/plain');
						echo $response;	
						}
					break;
					case "2":
						if($userResponse){
						// Graduate user to level 14
						$sql4="UPDATE `session` SET `level`=67 where `session_id`='".$sessionId."'";
						$db->query($sql4);

						$sql5 = "SELECT * FROM farmers WHERE phonenumber LIKE '%".$phoneNumber."%' LIMIT 1";
						$fQuery=$db->query($sql5);
						$Available=$fQuery->fetch_assoc();

						$response = "CON Kuona Za Account\n\n";

						$response .= "Dzina Lonse   \t: ".$Available['full_name']."\n";
						$response .= "Number Ya ID\t: ".$Available['id_number']."\n";
						$response .= "Phone Number \t: ".$Available['phonenumber']."\n";	
						$response .= "Dela		\t: ".$Available['location']."\n\n";

						$response .= "1. Kubwelera Pa Mbuyo\n";
						$response .= "2. Kubwelera Kumayambiliro\n";
						

						// Print the response onto the page so that our gateway can read it
						header('Content-type: text/plain');
						echo $response;

						}
					break;

					case "3": // the choice is 2 the user go to Chichewa version
						if($level==61){
							// Graduate user to level 2
							$sql2="UPDATE `session` SET `level`=24 where `session_id`='".$sessionId."'";
							$db->query($sql2);
							//Servr the Chichewa Menu
							$response = "CON Takulandirani Kuno Ku Farmers World\n";
							$response .= "Zikomo Posankha Chichewa \n";
							$response .= "Sankhani Chomwe Mukufuna\n\n";
 
							$response .= "1. Mitsika{Kogula Katundu}\n";
							$response .= "2. Mitsika{Kogulitsa Katundu}\n";
							$response .= "3. Alangizi\n";
							$response .= "4. Kusamala Za Kumunda\n";
							$response .= "5. Mauthenga\n";
							$response .= "6. Account Yanga\n";
							// Print the response onto the page so that our gateway can read it
							header('Content-type: text/plain');
							echo $response;				
						}
					break;

					default:
						if($level==61){
							// Return user to Main Menu & Demote user's level
							$response = "CON Gawo La Akaunti Yanga\n";
							$response .= "Mwasankha Za Akaunti Yanu\n\n";

							$response .= "1. Sinthani Za Akaunti Yanu\n";
							$response .= "2. Wonani Za Akaunti Yanu\n";
							$response .= "3. Kubwerera pambuyo";
							
							//update the level to 0 so that the session should start at level 1
							$sql4="UPDATE `session` SET `level`=61 where `session_id`='".$sessionId."'";
							$db->query($sql4);

							// Print the response onto the page so that our gateway can read it
							header('Content-type: text/plain');
							echo $response;	
						}
				}
			}
		}

		//Changing Account Name and Location
		else if($level==62){
			if(!$userResponse==""){
				switch($userResponse){
					case "1":
						if($level==62){
							
							// Graduate user to level 64
							$sql4="UPDATE `session` SET `level`=63 where `session_id`='".$sessionId."'";
							$db->query($sql4);

							$response = "CON Kosintha Za Account\n";
							$response .= "Chonde Lembani Dela Lanu Latsopano\n";
						
							// Print the response onto the page so that our gateway can read it
							header('Content-type: text/plain');
							echo $response;	
						}
					break;
					case "2":
						if($level==62){
																				
							// Graduate user to level 14
							$sql4="UPDATE `session` SET `level`=65 where `session_id`='".$sessionId."'";
							$db->query($sql4);

							$response = "CON Kosintha Za Account\n";
							$response .= "Chonde Lembani Dela Lanu Latsopano\n";
						
							// Print the response onto the page so that our gateway can read it
							header('Content-type: text/plain');
							echo $response;	
						}
					break;
					case "3":
						if($level==62){							
							// Graduate user to level 14
							$sql4="UPDATE `session` SET `level`=61 where `session_id`='".$sessionId."'";
							$db->query($sql4);

							$response = "CON Gawo La Akaunti Yanga\n";
							$response .= "Mwasankha Za Akaunti Yanu\n\n";

							$response .= "1. Sinthani Za Akaunti Yanu\n";
							$response .= "2. Wonani Za Akaunti Yanu\n";
							$response .= "3. Kubwerera pambuyo";
                            
						
							// Print the response onto the page so that our gateway can read it
							header('Content-type: text/plain');
							echo $response;	
						}
					break;

					case "4":   			// if the choice is 1 the user go to English version
                        if($level==62){
                            // Graduate user to level 2
                            $sql2="UPDATE `session` SET `level`=24 where `session_id`='".$sessionId."'";
                            $db->query($sql2);

							//Servr the Chichewa Menu
							$response = "CON Takulandirani Kuno Ku Farmers World\n";
							$response .= "Zikomo Posankha Chichewa \n";
							$response .= "Sankhani Chomwe Mukufuna\n\n";
 
							$response .= "1. Mitsika{Kogula Katundu}\n";
							$response .= "2. Mitsika{Kogulitsa Katundu}\n";
							$response .= "3. Alangizi\n";
							$response .= "4. Kusamala Za Kumunda\n";
							$response .= "5. Mauthenga\n";
							$response .= "6. Account Yanga\n";
                            
                            // Print the response onto the page so that our gateway can read it
                            header('Content-type: text/plain');
                            echo $response;
                        }
                    break;
					default:
						if($level==62){
							// Return user to Main Menu & Demote user's level
							$response = "CON Mwasankha Number Yolakwika, Chonde Yeselaninso\n";
							$response .= "Kosinthila Za Account\n";
							$response .= "Sankhani Choti Musinthe\n\n";
	
							$response .= "1. Kusintha Zina Lanu\n";
							$response .= "2. Kuaintha Dela Lanu\n";
							$response .= "3. Kubwelera Pa Mbuyo\n";
							$response .= "4. Kubwelera Kumayambiliro\n";

							//update the level to 0 so that the session should start at level 1
							$sql4="UPDATE `session` SET `level`=62 where `session_id`='".$sessionId."'";
							$db->query($sql4);

							// Print the response onto the page so that our gateway can read it
							header('Content-type: text/plain');
							echo $response;	
						}
				}
			}
		}
		else if($level==63){
			if(!$userResponse==""){
				
				// Graduate user to level 64
				$sql4="UPDATE `session` SET `level`=64 where `session_id`='".$sessionId."'";
				$db->query($sql4);

				//Update User Name
				$sql4 = "UPDATE farmers SET `full_name`='".$userResponse."' WHERE `phonenumber` LIKE '%". $phoneNumber ."%'";
				$db->query($sql4);

				$sql5 = "SELECT `full_name` FROM farmers WHERE phonenumber LIKE '%".$phoneNumber."%' LIMIT 1";
				$fQuery=$db->query($sql5);
				$Available=$fQuery->fetch_assoc();

				$response = "CON Kosintha Za Account\n";
				$response .= "Mwakwanisa Kusintha Dzina Lanu\n\n";

				$response .= "Dzina lanu latsopano ndi\t: ".$Available['full_name']."\n\n";

				$response .= "1. Kubwelera Pa Mbuyo\n";
				$response .= "2. Kubwelera Kumayambiliro\n";
					
				// Print the response onto the page so that our gateway can read it
				header('Content-type: text/plain');
				echo $response;
				
			}
		}
		else if($level==64){
			if(!$userResponse==""){			//checking that that the user input is not empty
				switch ($userResponse){ 	// from this point we are using user input as a case variable
					case "1":
						if($level==64){							
						// Graduate user to level 64
						$sql4="UPDATE `session` SET `level`=62 where `session_id`='".$sessionId."'";
						$db->query($sql4);

						$response = "CON Kosinthila Za Account\n";
						$response .= "Sankhani Choti Musinthe\n\n";

						$response .= "1. Kusintha Zina Lanu\n";
						$response .= "2. Kuaintha Dela Lanu\n";
						$response .= "3. Kubwelera Pa Mbuyo\n";
						$response .= "4. Kubwelera Kumayambiliro\n";

						// Print the response onto the page so that our gateway can read it
						header('Content-type: text/plain');
						echo $response;	
						}
					break;
					case "2":   			// if the choice is 2 the user go to nglish version
						if($level==64){
							// Graduate user to level 2
							$sql2="UPDATE `session` SET `level`=24 where `session_id`='".$sessionId."'";
							$db->query($sql2);
							//Servr the Chichewa Menu
							$response = "CON Takulandirani Kuno Ku Farmers World\n";
							$response .= "Zikomo Posankha Chichewa \n";
							$response .= "Sankhani Chomwe Mukufuna\n\n";
 
							$response .= "1. Mitsika{Kogula Katundu}\n";
							$response .= "2. Mitsika{Kogulitsa Katundu}\n";
							$response .= "3. Alangizi\n";
							$response .= "4. Kusamala Za Kumunda\n";
							$response .= "5. Mauthenga\n";
							$response .= "6. Account Yanga\n";
							
							// Print the response onto the page so that our gateway can read it
							header('Content-type: text/plain');
							echo $response;
						}
					break;

					default:
						if($level==64){
							$sql5 = "SELECT `full_name` FROM farmers WHERE phonenumber LIKE '%".$phoneNumber."%' LIMIT 1";
							$fQuery=$db->query($sql5);
							$Available=$fQuery->fetch_assoc();

							$response = "CON Kosintha Za Account\n";
							$response .= "Mwakwanisa Kusintha Dzina Lanu\n\n";
			
							$response .= "Dzina lanu latsopano ndi\t: ".$Available['full_name']."\n\n";
			
							$response .= "1. Kubwelera Pa Mbuyo\n";
							$response .= "2. Kubwelera Kumayambiliro\n";
							
							//update the level to 0 so that the session should start at level 1
							$sql4="UPDATE `session` SET `level`=64 where `session_id`='".$sessionId."'";
							$db->query($sql4);
		
							// Print the response onto the page so that our gateway can read it
							header('Content-type: text/plain');
							echo $response;	
						}
				}
			}
		}

		//Changing Location
		else if($level==65){
			if(!$userResponse==""){
				
				// Graduate user to level 64
				$sql4="UPDATE `session` SET `level`=66 where `session_id`='".$sessionId."'";
				$db->query($sql4);

				//Update District Name
				$sql4 = "UPDATE farmers SET `location`='".$userResponse."' WHERE `phonenumber` LIKE '%". $phoneNumber ."%'";
				$db->query($sql4);

				//Getting the new set location from the database
				$sql5 = "SELECT `location` FROM farmers WHERE phonenumber LIKE '%".$phoneNumber."%' LIMIT 1";
				$fQuery=$db->query($sql5);
				$Available=$fQuery->fetch_assoc();

				$response = "CON Kosintha Za Account\n";
				$response .= "Mwakwanisa Kusintha Dela Lanu\n\n";

				$response .= "Dela lanu latsopano ndi\t: ".$Available['location']."\n\n";

				$response .= "1. Kubwelera Pa Mbuyo\n";
				$response .= "2. Kubwelera Kumayambiliro\n";
					
				// Print the response onto the page so that our gateway can read it
				header('Content-type: text/plain');
				echo $response;
				
			}
		}
		else if($level==66){
			if(!$userResponse==""){			//checking that that the user input is not empty
				switch ($userResponse){ 	// from this point we are using user input as a case variable
					case "1":
						if($level==66){							
						// Graduate user to level 63
						$sql4="UPDATE `session` SET `level`=62 where `session_id`='".$sessionId."'";
						$db->query($sql4);

						$response = "CON Kosinthila Za Account\n";
						$response .= "Sankhani Choti Musinthe\n\n";

						$response .= "1. Kusintha Zina Lanu\n";
						$response .= "2. Kuaintha Dela Lanu\n";
						$response .= "3. Kubwelera Pa Mbuyo\n";
						$response .= "4. Kubwelera Kumayambiliro\n";

						// Print the response onto the page so that our gateway can read it
						header('Content-type: text/plain');
						echo $response;	
						}
					break;
					case "2":   			// if the choice is 2 the user go to nglish version
						if($level==66){
							// Graduate user to level 2
							$sql2="UPDATE `session` SET `level`=24 where `session_id`='".$sessionId."'";
							$db->query($sql2);

							//Servr the Chichewa Menu
							$response = "CON Takulandirani Kuno Ku Farmers World\n";
							$response .= "Zikomo Posankha Chichewa \n";
							$response .= "Sankhani Chomwe Mukufuna\n\n";
 
							$response .= "1. Mitsika{Kogula Katundu}\n";
							$response .= "2. Mitsika{Kogulitsa Katundu}\n";
							$response .= "3. Alangizi\n";
							$response .= "4. Kusamala Za Kumunda\n";
							$response .= "5. Mauthenga\n";
							$response .= "6. Account Yanga\n";
							
							// Print the response onto the page so that our gateway can read it
							header('Content-type: text/plain');
							echo $response;
						}
					break;

					default:
						if($level==66){
							$sql5 = "SELECT `location` FROM farmers WHERE phonenumber LIKE '%".$phoneNumber."%' LIMIT 1";
							$fQuery=$db->query($sql5);
							$Available=$fQuery->fetch_assoc();

							$response = "CON Kosintha Za Account\n";
							$response .= "Mwakwanisa Kusintha Dela Lanu\n\n";

							$response .= "Dela lanu latsopano ndi\t: ".$Available['location']."\n\n";

							$response .= "1. Kubwelera Pa Mbuyo\n";
							$response .= "2. Kubwelera Kumayambiliro\n";
							
							//update the level to 0 so that the session should start at level 1
							$sql4="UPDATE `session` SET `level`=66 where `session_id`='".$sessionId."'";
							$db->query($sql4);
		
							// Print the response onto the page so that our gateway can read it
							header('Content-type: text/plain');
							echo $response;	
						}
				}
			}
		}
		else if($level==67){
			if(!$userResponse==""){			//checking that that the user input is not empty
				switch ($userResponse){ 	// from this point we are using user input as a case variable
					case "1":   			// if the choice is 1 the user go to nglish version
						if($level==67){
							
							// Graduate user to level 2
							$sql2="UPDATE `session` SET `level`=61 where `session_id`='".$sessionId."'";
							$db->query($sql2);
							//Serve the Account Menu
							$response = "CON Gawo La Akaunti Yanga\n";
							$response .= "Mwasankha Za Akaunti Yanu\n\n";

							$response .= "1. Sinthani Za Akaunti Yanu\n";
							$response .= "2. Wonani Za Akaunti Yanu\n";
							$response .= "3. Kubwerera pambuyo";
                            
							// Print the response onto the page so that our gateway can read it
							header('Content-type: text/plain');
							echo $response;
						}
					break;

					case "2": // the choice is 2 the user go to Chichewa version
						if($level==67){
							// Graduate user to level 2
							$sql2="UPDATE `session` SET `level`=24 where `session_id`='".$sessionId."'";
							$db->query($sql2);
							//Servr the Chichewa Menu
							$response = "CON Takulandirani Kuno Ku Farmers World\n";
							$response .= "Zikomo Posankha Chichewa \n";
							$response .= "Sankhani Chomwe Mukufuna\n\n";
 
							$response .= "1. Mitsika{Kogula Katundu}\n";
							$response .= "2. Mitsika{Kogulitsa Katundu}\n";
							$response .= "3. Alangizi\n";
							$response .= "4. Kusamala Za Kumunda\n";
							$response .= "5. Mauthenga\n";
							$response .= "6. Account Yanga\n";
							// Print the response onto the page so that our gateway can read it
							header('Content-type: text/plain');
							echo $response;				
						}
					break;

					default:
						if($level==67){
							// Return user to Main Menu & Demote user's level
							$response = "CON Gawo La Akaunti Yanga\n";
							$response .= "Mwasankha Za Akaunti Yanu\n\n";

							$response .= "1. Sinthani Za Akaunti Yanu\n";
							$response .= "2. Wonani Za Akaunti Yanu\n";
							$response .= "3. Kubwerera pambuyo";

							//update the level to 0 so that the session should start at level 1
							$sql4="UPDATE `session` SET `level`=67 where `session_id`='".$sessionId."'";
							$db->query($sql4);
		
							// Print the response onto the page so that our gateway can read it
							header('Content-type: text/plain');
							echo $response;	
						}
				}
			}
        }	
	} 	   
        
	else{
		//10. Check that user response is not empty
		if($userResponse==""){
			//10a. On receiving a Blank. Advise user to input correctly based on level
			switch ($level) {
			    case 0:
				    //10b. Graduate the user to the next level, so you dont serve them the same menu
				     $sql10b = "INSERT INTO `session`(`session_id`, `phonenumber`,`level`) VALUES('".$sessionId."','".$phoneNumber."', 1)";
				     $db->query($sql10b);
				     //10c. Insert the phoneNumber, since it comes with the first POST
				     $sql10c = "INSERT INTO farmers(`phonenumber`) VALUES ('".$phoneNumber."')";
				     $db->query($sql10c);
				     //10d. Serve the menu request for name
				     $response = "CON you are not registered\n";
					 $response .= "Please Enter Your Full Name To Register";
			  		// Print the response onto the page so that our gateway can read it
			  		header('Content-type: text/plain');
 			  		echo $response;	
			        break;
			    case 1:
			    	//10e. Request again for district - level has not changed...
        			$response = "CON Name Is Not supposed To Be Empty.\nPlease Enter Your Full Name \n";
			  		// Print the response onto the page so that our gateway can read it
			  		header('Content-type: text/plain');
 			  		echo $response;	
			        break;
			    case 2:
			    	//10f. Request for city again --- level has not changed...
					$response = "CON District Is Not Supposed To Be Empty. \nPlease Enter Your District \n";
			  		// Print the response onto the page so that our gateway can read it
			  		header('Content-type: text/plain');
 			  		echo $response;	
					break;
			    case 3:
			    	//10f. Request for city again --- level has not changed...
					$response = "CON ID Number Is Not Supposed To Be Empty. \nPlease Enter Your ID Number \n";
			  		// Print the response onto the page so that our gateway can read it
			  		header('Content-type: text/plain');
 			  		echo $response;	
			    break;					
			    default:
			    	//10g. End the session
					$response = "END Apologies, something went wrong... \n";
			  		// Print the response onto the page so that our gateway can read it
			  		header('Content-type: text/plain');
 			  		echo $response;	
			        break;
			}
			
		}else{
			//11. Update User table based on input to correct level
			switch ($level) {
			    case 0:
				    //10b. Graduate the user to the next level, so you dont serve them the same menu
				     $sql10b = "INSERT INTO `session`(`session_id`, `phonenumber`,`level`) VALUES('".$sessionId."','".$phoneNumber."', 1)";
				     $db->query($sql10b);
				     
					 //10c. Insert the phoneNumber, since it comes with the first POST
				     $sql10c = "INSERT INTO farmers (`phonenumber`) VALUES ('".$phoneNumber."')";
				     $db->query($sql10c);
				     
					 //10d. Serve the menu request for name
				     $response = "CON Please enter your first and last name";
			  		
					// Print the response onto the page so that our gateway can read it
			  		header('Content-type: text/plain');
				  		echo $response;	
			    break;		    
			    case 1:
			    	//11b. Update Name, and Request for District Name
			        $sql11b = "UPDATE farmers SET `full_name`='".$userResponse."' WHERE `phonenumber` LIKE '%". $phoneNumber ."%'";
			        $db->query($sql11b);
			        
					//11c. We graduate the user to the district level
			        $sql11c = "UPDATE `session` SET `level`=2 WHERE `session_id`='".$sessionId."'";
			        $db->query($sql11c);
			        
					//Requestion District name
			        $response = "CON Enter Your District\n";

					
					// Print the response onto the page so that our gateway can read it
			  		header('Content-type: text/plain');
				  		echo $response;	
                break;
                case 2:    
                //11d. Update District Name
                    $sql11d = "UPDATE farmers SET `location`='".$userResponse."' WHERE `phonenumber` LIKE '%". $phoneNumber ."%'";
                    $db->query($sql11d);
                    
                    //11e. Change level to 3
                    $sql11e = "UPDATE `session` SET `level`=3 WHERE `session_id`='".$sessionId."'";
                    $db->query($sql11e);  
                    
                    //11f. Serve the menu request for name
                    $response = "CON Enter Your ID Number\n";        	   	
                    
                    // Print the response onto the page so that our gateway can read it
                    header('Content-type: text/plain');
                    echo $response;	
                break;
                case 3:
                    //11d. Update Identification Number
                    $sql11d = "UPDATE farmers SET `id_number`='".$userResponse."' WHERE `phonenumber` = '". $phoneNumber ."'";
                    $db->query($sql11d);
                    
                    //11e. Change level to 0
                    $sql11e = "UPDATE `session` SET `level`=0 WHERE `session_id`='".$sessionId."'";
                    $db->query($sql11e);  
                    
                    //11f. Serve the menu request for name
                    $response = "END You have been successfully registered";	        	   	
                    
                    // Print the response onto the page so that our gateway can read it
                    header('Content-type: text/plain');
                    echo $response;	
                break;			        		        		        
                default:
                    //11g. Request for city again
                    $response = "END Apologies, something went wrong... \n";
                    // Print the response onto the page so that our gateway can read it
                    header('Content-type: text/plain');
                    echo $response;	
                    break;
            }	
        }			
	}    
?>    