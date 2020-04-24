<?php

    //Connection Credentials
	$servername = "localhost";
	$username = "root";
	$password = "";
	$database = "sample";
	
	// Create connection
    $db = new mysqli($servername, $username, $password, $database);
    
	// Check connection
    if ($db->connect_error) {
        header('Content-type: text/plain');
        //log error to file/db $e-getMessage()
        die("END An error was encountered. Please try again later");
    } 
		
	//2. receive the POST from browser URL
	$sessionId     =$_GET['sessionId'];
	$phoneNumber   =$_GET['phoneNumber'];
	$serviceCode   =$_GET['serviceCode'];
	$text          =$_GET['text'];
	
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
	$sql6 = "SELECT * FROM farmer WHERE phoneNumber LIKE '%".$phoneNumber."%' LIMIT 1";
	$farmerQuery=$db->query($sql6);
	$farmerAvailable=$farmerQuery->fetch_assoc();
	
	//==========================================CHECKING IF FARMER IS REGISTERED OR NOT ==============================================================	
	//9. Check if the FARMER is available (yes)->Serve the menu; (no)->Register the FARMER
	
if($farmerAvailable && $farmerAvailable['name']!=NULL && $farmerAvailable['id_number']!=NULL){ 

	    if($level==0){
			if($userResponse==""){ //the fisrt string has to be empty at the begginning
			
				//9b. Graduate user to next level & Serve Main Menu by setting the level to one in the database
				$sql9b = "INSERT INTO `session`(`session_id`,`phonenumber`,`level`) VALUES('".$sessionId."','".$phoneNumber."',1)";
				$db->query($sql9b);
				//Serve our services menu
				$response = "CON Welcome to Farmers World\n";
				$response .= "Please select language\n";
				$response .= "1) English\n";
				$response .= "2) Chichewa\n";
				
				// Print the response onto the page so that our gateway can read it
				header('Content-type: text/plain');
				echo $response;
			}
		}
// Menu 2 Section
		else if($level==1){
			if(!$userResponse==""){			//checking that that the user input is not empty
				switch ($userResponse){ 	// from this point we are using user input as a case variable
					case "1":   			// if the choice is 1 the user go to nglish version
						if($level==1){
							//9b. Graduate user to level 2
							$sql2="UPDATE `session` SET `level`=2 where `session_id`='".$sessionId."'";
							$db->query($sql2);
							
							// Menu 2  English
							//Serve English services menu
							$response = "CON  Welcome To Farmers World\n";
							$response .= "Choose Your Desired Option\n";
							$response .= "1. Farm Management\n";
							$response .= "2. Markets\n";
							$response .= "3. Advisors\n";
							$response .= "4. Financial Management\n";
							$response .= "5. My Account\n";
							
							// Print the response onto the page so that our gateway can read it
							header('Content-type: text/plain');
							echo $response;
						}
					break;
					case "2": // the choice is 2 the user go to chichewa version
						if($level==1){
							//9b. Graduate user to level 2
							$sql2a="UPDATE `session` SET `level`=3 where `session_id`='".$sessionId."'";
							$db->query($sql2a);
							//Menu 2 Chichewa							
							//Serve chichewa services menu
							$response = "CON  Takulandirani Kuno Ku Farmers World\n";
							$response .= "Zikomo Posankha Chichewa\n";
							$response .= "Sankhani Chomwe Mukufuna\n";
							$response .= "1. Kusamala Zakumunda\n";
							$response .= "2. Mitsika\n";
							$response .= "3. Alangizi\n";
							$response .= "4. Kusamala Za Chuma\n";
							$response .= "5. Account Yanga\n";
							
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
							$response .= "2) Chichewa\n";
							
							//update the level to 0 so that the session should start at level 1
							$sql4="UPDATE `session` SET `level`=0 where `session_id`='".$sessionId."'";
							$db->query($sql4);
		
							// Print the response onto the page so that our gateway can read it
							header('Content-type: text/plain');
							echo $response;	
						}
				}
			}
		}
// Menu 2.X Section English Version
		else if($level==2){
				if(!$userResponse==""){			//checking that that the user input is not empty
					switch ($userResponse){
						// Menu 2.1 	        // fro thia point we are using user input as a case variable
						case "1":   			// user will be here if he chooses option 1 in english menu
							if($level==2){
								//9b. Graduate user to level 4
								$sql4="UPDATE `session` SET `level`=4 where `session_id`='".$sessionId."'";
								$db->query($sql4);
								
								$response = "CON Farmers World Farm Management Section\n";
								$response .= "You Have chosen Farm Management\n";
								$response .= "1. Suppliers\n";
																
								header('Content-type: text/plain');
								echo $response;	
							}
						break;
						// Menu 2.2
						case "2": // user will be here if he chooses option 2 in english menu
							if($level==2){
								//9b. Graduate user to level 5
								$sql4="UPDATE `session` SET `level`=5 where `session_id`='".$sessionId."'";
								$db->query($sql4);
								
								$response = "CON  Farmers World Market Section\n";
								$response .= "You Have Chosen Markets\n";
								$response .= "1. View Markets And What They Buy\n";
								
								header('Content-type: text/plain');
								echo $response;				
							}
						break;
						// Menu 2.3
						case "3": // user will be here if he chooses option 3 in english menu
							if($level==2){
								//9b. Graduate user to level 6
								$sql4="UPDATE `session` SET `level`=6 where `session_id`='".$sessionId."'";
								$db->query($sql4);
								
								$response = "CON Farmers World Advisors Section\n";
								$response .= "You Have Choosen Advisors \n";
								$response .= " 1. Enter Your District \n";
								
								header('Content-type: text/plain');
								echo $response;				
							}
						break;
						// Menu 2.4
						case "4": // user will be here if he chooses option 4 in english menu
							if($level==2){
								//9b. Graduate user to level 7
								$sql4="UPDATE `session` SET `level`=7 where `session_id`='".$sessionId."'";
								$db->query($sql4);
								
								$response = "CON Farmers World Financial Management Section\n";
								$response .= "You Have Choosen Financial Management Option \n";
								$response .= " 1. Proceed To Calculations \n";
								
								header('Content-type: text/plain');
								echo $response;				
							}
						break;
						// Menu 2.5
						case "5": // user will be here if he chooses option 5 in english menu
							if($level==2){
								//9b. Graduate user to level 8
								$sql4="UPDATE `session` SET `level`=8 where `session_id`='".$sessionId."'";
								$db->query($sql4);
								
								$response = "CON Farmers World My Acoount Section \n";
								$response .= "You Have Choosen My Account Option \n";
								$response .= " 1. Change Account Details \n";
								$response .= " 2. Check Account Details \n";
								
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
								$response .= "1. Farm Management\n";
								$response .= "2. Markets\n";
								$response .= "3. Advisors\n";
								$response .= "4. Financial Management\n";
								$response .= "5. My Account\n";
								
								
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
// Menu 2.X Section Chichewa Version
		else if($level==3){
				if(!$userResponse==""){			//checking that that the user input is not empty
					switch ($userResponse){ 	// fro thia point we are using user input as a case variable
						case "1":   			// user will be here if he chooses option 2 on chichewa menu
							if($level==3){
								//9b. Graduate user to level 9
								$sql4="UPDATE `session` SET `level`=9 where `session_id`='".$sessionId."'";
								$db->query($sql4);
								
								$response = "CON  Gawo La Zosamala Zakumunda Ku Farmers World\n";
								$response .= "Mwasankha Kusamala Zakumunda\n";
								$response .= "1. Wogulitsa Za Kumunda\n";
															
								header('Content-type: text/plain');
								echo $response;	
							}
						break;
						case "2": // user will be here if he chooses option 2 on chichewa menu
							if($level==3){
								//9b. Graduate user to level 10
								$sql4="UPDATE `session` SET `level`=10 where `session_id`='".$sessionId."'";
								$db->query($sql4);
								
								$response = "CON  Takulandirani Kuno Ku Farmers World\n";
								$response .= "Misika\n";
								$response .= "1. Wonani Misika ndi Zomwe Amagula Kwa Inu\n";
								
								header('Content-type: text/plain');
								echo $response;				
							}
						break;
						case "3": // user will be here if he chooses option 3 on chichewa menu
							if($level==3){
								//9b. Graduate user to level 11
								$sql4="UPDATE `session` SET `level`=11 where `session_id`='".$sessionId."'";
								$db->query($sql4);
								
								$response = "CON  Gawo La Alangizi La Farmers World\n";
								$response .= "Mwasankha Gawo La Alangizi \n";
								$response .= " 1. Lowesani Boma Lanu \n";
								
								header('Content-type: text/plain');
								echo $response;				
							}
						break;
						case "4": // user will be here if he chooses option 4 on chichewa menu
							if($level==3){
								//9b. Graduate user to level 12
								$sql4="UPDATE `session` SET `level`=12 where `session_id`='".$sessionId."'";
								$db->query($sql4);

								$response = "CON Gawo Losamala Chuma Ku Farmers World\n";
								$response .= "Mwasankha Kusamala Chuma \n";
								$response .= " 1. Pitilirizani Kuti Muwerengere \n";


								header('Content-type: text/plain');
								echo $response;				
							}
						break;
						case "5": // user will be here if he chooses option 5 on chichewa menu
							if($level==3){
								//9b. Graduate user to level 13
								$sql4="UPDATE `session` SET `level`=13 where `session_id`='".$sessionId."'";
								$db->query($sql4);
								
								$response = "CON Gawo La Akaunti Yanga Ku Farmers World \n";
								$response .= "Mwasankha Za Akaunti Yanu \n";
								$response .= " 1. Sinthani Za Akaunti Yanu \n";
								$response .= " 2. Wonani Za Akaunti Yanu \n";
								
								header('Content-type: text/plain');
								echo $response;				
							}
						break;
						default:
							if($level==3){
								// re-serve the chichewa Menu in case user enters wrong option
								$response = "CON mwasankha molakwika \n";
								$response .= "chonde sankhaninso\n";
								$response .= "1. Kusamala Zakumunda\n";
								$response .= "2. Mitsika\n";
								$response .= "3. Alangizi\n";
								$response .= "4. Kusamala Za Chuma\n";
								$response .= "5. Account Yanga\n";
								
								//update the level to 3 so that the user should reach very same level
								$sql4="UPDATE `session` SET `level`=3 where `session_id`='".$sessionId."'";
								$db->query($sql4);
			
								// Print the response onto the page so that our gateway can read it
								header('Content-type: text/plain');
								echo $response;	
							}
					}
			}
		}

// MENU 2.X.1 START 
// Menu 2.1.1 English Version
		else if($level==4){
				if(!$userResponse==""){
					switch($userResponse){
						case "1":
							if($level==4){							
							//9b. Graduate user to level 14
							$sql4="UPDATE `session` SET `level`=14 where `session_id`='".$sessionId."'";
							$db->query($sql4);

							$response = "CON  Suppliers Section\n";
							$response .= "You Have Selected Suppliers\n";
							$response .= "1. Enter Your Location\n";

							// Print the response onto the page so that our gateway can read it
							header('Content-type: text/plain');
							echo $response;	
							}
						break;
						default:
							if($level==4){
								// Return user to Main Menu & Demote user's level
								$response = "CON Wrong Option\n";
								$response .= "Try Again\n";
								$response .= "1. Enter Your Location \n";

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
// Menu 2.2.1 English Version Markets and What they are buying
		else if($level==5){
			if(!$userResponse==""){
				switch($userResponse){
					case "1":
						if($level==5){							
						//9b. Graduate user to level 14
						$sql4="UPDATE `session` SET `level`=15 where `session_id`='".$sessionId."'";
						$db->query($sql4);

						$response = "CON  Market Section \n";
						$response .= "What Are They Buying (Select To Book)\n";
						$response .= "1. Product Name - Price\n";
						$response .= "2. Maize Bag - K6,000.00\n";
						$response .= "3. Rice Bag  - K10,000.00\n";
						$response .= "4. Nandolo Bag - K5,000.00\n";

						// Print the response onto the page so that our gateway can read it
						header('Content-type: text/plain');
						echo $response;	
						}
					break;
					default:
						if($level==5){
							// Return user to Main Menu & Demote user's level
							$response = "CON Wrong Option\n";
							$response .= "Try Again\n";
							$response .= "1. Product Name - Price\n";
							$response .= "2. Maize Bag - K6,000.00\n";
							$response .= "3. Rice Bag  - K10,000.00\n";
							$response .= "4. Nandolo Bag - K5,000.00\n";
							
							//update the level to 0 so that the session should start at level 1
							$sql4="UPDATE `session` SET `level`=5 where `session_id`='".$sessionId."'";
							$db->query($sql4);

							// Print the response onto the page so that our gateway can read it
							header('Content-type: text/plain');
							echo $response;	
						}
				}
			}
		}
// Menu 2.3.1 English Version 
		else if($level==6){
			if(!$userResponse==""){
				switch($userResponse){
					case "1":
						if($level==6){							
						//9b. Graduate user to level 14
						$sql4="UPDATE `session` SET `level`=16 where `session_id`='".$sessionId."'";
						$db->query($sql4);

						$response = "CON  Categories of Farm Advisors \n";
						$response .= "List of Specialities\n";
						$response .= "1. Speciaty Name\n";
						$response .= "2. Speciaty Name 2\n";
						$response .= "3. Speciaty Name 3\n";
						$response .= "4. Speciaty Name 4\n";
						$response .= "5. Speciaty Name 5\n";
						$response .= "6. Speciaty Name 6\n";

						// Print the response onto the page so that our gateway can read it
						header('Content-type: text/plain');
						echo $response;	
						}
					break;
					default:
						if($level==6){
							// Return user to Main Menu & Demote user's level
							$response = "CON Wrong Option\n";
							$response .= "Please Select A Specialty Name\n";
							$response .= "1. Speciaty Name\n";
							$response .= "2. Speciaty Name 2\n";
							$response .= "3. Speciaty Name 3\n";
							$response .= "4. Speciaty Name 4\n";
							$response .= "5. Speciaty Name 5\n";
							$response .= "6. Speciaty Name 6\n";
							
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
// Menu 2.4.1 English Version
		else if($level==7){
			if(!$userResponse==""){
				switch($userResponse){
					case "1":
						if($level==7){							
						//9b. Graduate user to level 14
						$sql4="UPDATE `session` SET `level`=17 where `session_id`='".$sessionId."'";
						$db->query($sql4);

						$response = "CON  Financial Management Implementation \n";
						$response .= "Financial Calculations\n";
						$response .= "1. Send>>>>>>>>\n";
						$response .= "2. Reiceve>>>>>>>> \n";

						// Print the response onto the page so that our gateway can read it
						header('Content-type: text/plain');
						echo $response;	
						}
					break;
					default:
						if($level==7){
							// Return user to Main Menu & Demote user's level
							$response = "CON Wrong Option\n";
							$response .= "Please Choose A Correct Option\n";
							$response .= "1. Send>>>>>>>>\n";
							$response .= "2. Reiceve>>>>>>>> \n";
							
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
// Menu 2.5.1 English Version // Coded
		else if($level==8){
			if(!$userResponse==""){
				switch($userResponse){
					case "1":
						if($level==8){							
						//9b. Graduate user to level 14
						$sql4="UPDATE `session` SET `level`=18 where `session_id`='".$sessionId."'";
						$db->query($sql4);

						$response = "CON My Account Updation Section \n";
						$response .= "Change Account Details\n";
						$response .= "1. Change Pin\n";
						$response .= "2. Change Name \n";
						$response .= "3. Change Phone Number \n";

						// Print the response onto the page so that our gateway can read it
						header('Content-type: text/plain');
						echo $response;	
						}
					break;
					case "2":
						if($userResponse){
						//9b. Graduate user to level 14
						$sql4="UPDATE `session` SET `level`=30 where `session_id`='".$sessionId."'";
						$db->query($sql4);

						$sql5 = "SELECT * FROM farmer WHERE phonenumber LIKE '%".$phoneNumber."%' LIMIT 1";
						$fQuery=$db->query($sql5);
						$Available=$fQuery->fetch_assoc();

						$response = "CON Check Acount Details \n";
						$response .= "My Account Details\n";
						$response .= "Full Name       \t: ".$Available['name']."\n";	
						$response .= "Nambala Ya ID   \t: ".$Available['id_number']."\n";
						$response .= "Phone Number    \t: ".$Available['phonenumber']."\n";	
						$response .= "Location		  \t: ".$Available['location']."\n";		

						// Print the response onto the page so that our gateway can read it
						header('Content-type: text/plain');
						echo $response;

						}
					break;
					default:
						if($level==8){
							// Return user to Main Menu & Demote user's level
							$response = "CON Wrong Option\n";
							$response .= "Please Choose A Correct Option\n";
							$response .= "1. Change My Account Details \n";
							$response .= "2. Check My Account Details \n";
							
							//update the level to 0 so that the session should start at level 1
							$sql4="UPDATE `session` SET `level`=8 where `session_id`='".$sessionId."'";
							$db->query($sql4);

							// Print the response onto the page so that our gateway can read it
							header('Content-type: text/plain');
							echo $response;	
						}
				}
			}
		}

		
// Menu 2.1.1 Chichewa Version // Coded
		else if($level==9){
				if(!$userResponse==""){
					switch($userResponse){
						case "1":
							if($level==9){
								// Graduate user to level 15
								$sql4="UPDATE `session` SET `level`=19 where `session_id`='".$sessionId."'";
								$db->query($sql4);
								// Displaying Menu
								$response = "CON  Gawo La Wogulisa Za Kumunda\n";
								$response .= "Mwasankha Wogulisa Za kumunda \n";
								$response .= "1. Lowetsani Boma Lomwe Mumakhala\n";	

								header('Content-type: text/plain');
								echo $response;	
							}
						break;
						default: 
							if($level==9){
								// Return user to Main Menu & Demote user's level
								$response = "CON Mwasankha Number Yolakwika\n";
								$response .= "Yeseraninso Kolowesa numbala yoyonera\n";
								$response .= "1. Lowetsani Boma Lomwe Mumakhala \n";

								//update the level to 4 so that the session should start at level 5
								$sql4="UPDATE `session` SET `level`=9 where `session_id`='".$sessionId."'";
								$db->query($sql4);

								header('Content-type: text/plain');
								echo $response;	
		
							}						
						}
				}
		}
// Menu 2.2.1 Chichewa Version // Coded
		else if($level==10){
			if(!$userResponse==""){
				switch($userResponse){
					case "1":
						if($level==10){
							// Graduate user to level 15
							$sql4="UPDATE `session` SET `level`=20 where `session_id`='".$sessionId."'";
							$db->query($sql4);
							// Displaying Menu
							$response = "CON  Gawo La Msika \n";
							$response .= "Zomwe Tikugula (Sankhani Kuti Mubuke)\n";
							$response .= "1. Dzina la Katundu - Mtengo\n";
							$response .= "2. Thumba La Chimanga - K6,000.00\n";
							$response .= "3. Thumba La Mpunga - K10,000.00\n";
							$response .= "4. Thumba La Nandolo - K5,000.00\n";
							header('Content-type: text/plain');
							echo $response;	
						}
					break;
					default: 
						if($level==10){
							// Return user to Main Menu & Demote user's level
							$response = "CON Mwasankha Nambala Yolakwika\n";
							$response .= "Yeseraninso Kolowesa numbala yoyonera\n";
							$response .= "1. Dzina la Katundu - Mtengo\n";
							$response .= "2. Thumba La Chimanga - K6,000.00\n";
							$response .= "3. Thumba La Mpunga - K10,000.00\n";
							$response .= "4. Thumba La Nandolo - K5,000.00\n";

							//update the level to 4 so that the session should start at level 5
							$sql4="UPDATE `session` SET `level`=10 where `session_id`='".$sessionId."'";
							$db->query($sql4);

							header('Content-type: text/plain');
							echo $response;	
	
						}						
					}
			}
		}
// Menu 2.3.1 Chichewa Version // coded
		else if($level==11){
			if(!$userResponse==""){
				switch($userResponse){
					case "1":
						if($level==11){
							// Graduate user to level 15
							$sql4="UPDATE `session` SET `level`=21 where `session_id`='".$sessionId."'";
							$db->query($sql4);
							// Displaying Menu
							$response = "CON  Gawo La Alangizi \n";
							$response .= "Mayina AMagawo A Alangizi \n";
							$response .= "1. Dzina La Gawo\n";
							$response .= "2. Dzina La Gawo 2\n";
							$response .= "3. Dzina La Gawo 3\n";
							$response .= "4. Dzina La Gawo 4\n";
							$response .= "5. Dzina La Gawo 5\n";
							$response .= "6. Dzina La Gawo 6\n";

							header('Content-type: text/plain');
							echo $response;	
						}
					break;
					default: 
						if($level==11){
							// Return user to Main Menu & Demote user's level
							$response = "CON Mwasankha Number Yolakwika\n";
							$response .= "Yeseraninso Kolowesa numbala yoyonera\n";
							$response .= "1. Dzina La Gawo\n";
							$response .= "2. Dzina La Gawo 2\n";
							$response .= "3. Dzina La Gawo 3\n";
							$response .= "4. Dzina La Gawo 4\n";
							$response .= "5. Dzina La Gawo 5\n";
							$response .= "6. Dzina La Gawo 6\n";

							//update the level to 4 so that the session should start at level 5
							$sql4="UPDATE `session` SET `level`=11 where `session_id`='".$sessionId."'";
							$db->query($sql4);

							header('Content-type: text/plain');
							echo $response;	
	
						}						
					}
			}
		}
// Menu 2.4.1 Chichewa Version // coded
		else if($level==12){
			if(!$userResponse==""){
				switch($userResponse){
					case "1":
						if($level==12){
							// Graduate user to level 15
							$sql4="UPDATE `session` SET `level`=22 where `session_id`='".$sessionId."'";
							$db->query($sql4);
							// Displaying Menu
							$response = "CON  Kusamala Za Chama Chathu \n";
							$response .= "Kuwerengeresera Za Chuma\n";
							$response .= "1. Tumizani>>>>>>>>\n";
							$response .= "2. Landirani>>>>>>>> \n";

							header('Content-type: text/plain');
							echo $response;	
						}
					break;
					default: 
						if($level==12){
							// Return user to Main Menu & Demote user's level
							$response = "CON Mwasankha Number Yolakwika\n";
							$response .= "Yeseraninso Kolowesa numbala yoyonera\n";
							$response .= "1. Tumizani>>>>>>>>\n";
							$response .= "2. Landirani>>>>>>>> \n";

							//update the level to 4 so that the session should start at level 5
							$sql4="UPDATE `session` SET `level`=12 where `session_id`='".$sessionId."'";
							$db->query($sql4);

							header('Content-type: text/plain');
							echo $response;	
	
						}						
					}
			}
		}
// Menu 2.5.1 Chichewa Version
		else if($level==13){
			if(!$userResponse==""){
				switch($userResponse){
					case "1":
						if($level==13){
							// Graduate user to level 15
							$sql4="UPDATE `session` SET `level`=23 where `session_id`='".$sessionId."'";
							$db->query($sql4);
							// Displaying Menu
							$response = "CON Gawo Losithira Akaunti Yanga \n";
							$response .= "Sithani Zofunikira Za Akaunti Yanu\n";
							$response .= "1. Sithani Pin\n";
							$response .= "2. Sithani Dzina \n";
							$response .= "3. Sithani Numbala Ya Foni Yanu\n";

							header('Content-type: text/plain');
							echo $response;	
						}
						break;
						case "2":
							if($userResponse){
							//9b. Graduate user to level 14
							$sql4="UPDATE `session` SET `level`=31 where `session_id`='".$sessionId."'";
							$db->query($sql4);

							$sql5 = "SELECT * FROM farmer WHERE phonenumber LIKE '%".$phoneNumber."%' LIMIT 1";
							$fQuery=$db->query($sql5);
							$Available=$fQuery->fetch_assoc();
	
							$response = "CON Wonani Za Akaunti Yanu\n";
							$response .= "Za Akaunti Yanga\n";
							$response .= "Dzina Lanu      \t :".$Available['name']."\n";	
							$response .= "Nambala Ya ID	  \t :".$Available['id_number']."\n";
							$response .= "Foni Yanu       \t :".$Available['phonenumber']."\n";	
							$response .= "Komwe Mumakhala \t :".$Available['location']."\n";	
	

							
							// Print the response onto the page so that our gateway can read it
							header('Content-type: text/plain');
							echo $response;
	
							}
						break;
					default: 
						if($level==13){
							// Return user to Main Menu & Demote user's level
							$response = "CON Mwasankha Number Yolakwika\n";
							$response .= "Yeseraninso Kolowesa numbala yoyonera\n";
							$response .= "1. Sithani Za Akaunti Yanu\n";
							$response .= "2. Wonani Za Akaunti Yanu \n";

							//update the level to 4 so that the session should start at level 5
							$sql4="UPDATE `session` SET `level`=13 where `session_id`='".$sessionId."'";
							$db->query($sql4);

							header('Content-type: text/plain');
							echo $response;	
	
						}						
					}
			}
		}
// MENU 2.X.1 END

// MENU 2.X.1.1 START
// Menu 2.1.1.1 Farm categories English Menu
		else if($level==14){
			if(!$userResponse==""){
				switch($userResponse){
					case "1":
						if($level==14){							
						//9b. Graduate user to level 14
						$sql4="UPDATE `session` SET `level`=24 where `session_id`='".$sessionId."'";
						$db->query($sql4);

						$response = "CON  Farm Categories By Category\n";
						$response .= "You Have Selected Suppliers\n";
						$response .= "1. Farm Categories\n";

						// Print the response onto the page so that our gateway can read it
						header('Content-type: text/plain');
						echo $response;	
						}
					break;
					default:
						if($level==14){
							// Return user to Main Menu & Demote user's level
							$response = "CON Wrong Option\n";
							$response .= "Try Again\n";
							$response .= "1. Farm Categories \n";

							//update the level to 0 so that the session should start at level 1
							$sql4="UPDATE `session` SET `level`=14 where `session_id`='".$sessionId."'";
							$db->query($sql4);

							// Print the response onto the page so that our gateway can read it
							header('Content-type: text/plain');
							echo $response;	
						}
				}
			}
		}
// Menu 2.2.1.1 Quantinty To Sell English Menu
		else if($level==15){
			if(!$userResponse==""){
				switch($userResponse){
					case "1":
						if($level==15){							
						//9b. Graduate user to level 14
						$sql4="UPDATE `session` SET `level`=24 where `session_id`='".$sessionId."'";
						$db->query($sql4);

						$response = "CON Quantity Required For Sale\n";
						$response .= "You Wish To Sell {Product name and Price}\n";
						$response .= "1. Enter Amount To Sell\n";

						// Print the response onto the page so that our gateway can read it
						header('Content-type: text/plain');
						echo $response;	
						}
					break;
					case "2":
						if($level==15){
						//9b. Graduate user to level 14
						$sql4="UPDATE `session` SET `level`=25 where `session_id`='".$sessionId."'";
						$db->query($sql4);


						$response = "CON Quantity Required For Sale\n";
						$response .= "You Wish To Sell Maize Bag At K6,000.00\n";
						$response .= "1. Enter Amount To Sell\n";

						// Print the response onto the page so that our gateway can read it
						header('Content-type: text/plain');
						echo $response;								
						}
					break;
					case "3":
						if($level==15){
						//9b. Graduate user to level 14
						$sql4="UPDATE `session` SET `level`=26 where `session_id`='".$sessionId."'";
						$db->query($sql4);


						$response = "CON Quantity Required For Sale\n";
						$response .= "You Wish To Sell Rice Bag At K10,000.00\n";
						$response .= "1. Enter Amount To Sell\n";

						// Print the response onto the page so that our gateway can read it
						header('Content-type: text/plain');
						echo $response;								
						}
					break;
					case "4":
						if($level==15){
						//9b. Graduate user to level 14
						$sql4="UPDATE `session` SET `level`=27 where `session_id`='".$sessionId."'";
						$db->query($sql4);


						$response = "CON Quantity Required For Sale\n";
						$response .= "You Wish To Sell Nandolo Bag At K5,000.00\n";
						$response .= "1. Enter Amount To Sell\n";

						// Print the response onto the page so that our gateway can read it
						header('Content-type: text/plain');
						echo $response;								
						}
					break;
					default:
						if($level==15){
							// Return user to Main Menu & Demote user's level
							$response = "CON Wrong Option\n";
							$response .= "Enter Amount You Wish To Sell\n";
							$response .= "1. Product Name - Price \n";
							$response .= "2. Rice Bag - Price \n";
							$response .= "3. Maize Bag - Price \n";
							$response .= "4. Nandolo Bag - Price \n";

							//update the level to 0 so that the session should start at level 1
							$sql4="UPDATE `session` SET `level`=15 where `session_id`='".$sessionId."'";
							$db->query($sql4);

							// Print the response onto the page so that our gateway can read it
							header('Content-type: text/plain');
							echo $response;	
						}
				}
			}
		}
// Menu 2.3.1.1 List of Advisors English Menu		
		else if($level==16){
			if(!$userResponse==""){
				switch($userResponse){
					case "1":
						if($level==16){							
						//9b. Graduate user to level 14
						$sql4="UPDATE `session` SET `level`=28 where `session_id`='".$sessionId."'";
						$db->query($sql4);

						$response = "CON  List of Advisors of {Name of District}\n";
						$response .= "Advisors In your Area\n";
						$response .= "1. Advisor Full Name\n";
						$response .= "2. Mr. Rabson Sayenda\n";
						$response .= "3. Mr. Kondwani Lusinje\n";
						$response .= "4. Dr. Nelson Kumbani\n";
						$response .= "5. Mr. Fredson Likhunya\n";

						// Print the response onto the page so that our gateway can read it
						header('Content-type: text/plain');
						echo $response;	
						}
					break;
					default:
						if($level==16){
							// Return user to Main Menu & Demote user's level
							$response = "CON Wrong Option\n";
							$response .= "Select An Advisor Name Please\n";
							$response .= "1. Advisor Full Name\n";
							$response .= "2. Mr. Rabson Sayenda\n";
							$response .= "3. Mr. Kondwani Lusinje\n";
							$response .= "4. Dr. Nelson Kumbani\n";
							$response .= "5. Mr. Fredson Likhunya\n";

							//update the level to 0 so that the session should start at level 1
							$sql4="UPDATE `session` SET `level`=16 where `session_id`='".$sessionId."'";
							$db->query($sql4);

							// Print the response onto the page so that our gateway can read it
							header('Content-type: text/plain');
							echo $response;	
						}
				}
			}
		}
//Menu 2.4.1.1 Financial Management Implementation
		else if($level==17){
			if(!$userResponse==""){
				switch($userResponse){
					case "1":
						if($level==17){							
						//9b. Graduate user to level 14
						$sql4="UPDATE `session` SET `level`=29 where `session_id`='".$sessionId."'";
						$db->query($sql4);

						$response = "CON  Financial Management Section\n";
						$response .= "Advisors In your Area\n";
						$response .= "1. To Be Implemented\n";
						$response .= "2. To Be Implemented 2\n";

						// Print the response onto the page so that our gateway can read it
						header('Content-type: text/plain');
						echo $response;	
						}
					break;
					default:
						if($level==17){
							// Return user to Main Menu & Demote user's level
							$response = "CON Wrong Option\n";
							$response .= "Advisors In your Area\n";
							$response .= "1. To Be Implemented\n";
							$response .= "2. To Be Implemented 2\n";

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
//Menu 2.5.1.1 Change Account Details
		else if($level==18){
			if(!$userResponse==""){
				switch($userResponse){
					case "1":
						if($level==18){							
						//9b. Graduate user to level 14
						$sql4="UPDATE `session` SET `level`=39 where `session_id`='".$sessionId."'";
						$db->query($sql4);

						$response = "CON  Change PIN\n";
						$response .= "PIN Updatation\n";
						$response .= "1. Enter Your Old Pin\n";

						// Print the response onto the page so that our gateway can read it
						header('Content-type: text/plain');
						echo $response;	
						}
					break;
					case "2":
						if($level==18){							
						//9b. Graduate user to level 14
						$sql4="UPDATE `session` SET `level`=40 where `session_id`='".$sessionId."'";
						$db->query($sql4);

						$response = "CON  Change Name\n";
						$response .= "Name Updation\n";
						$response .= "1. Enter Your Pin To Proceed\n";
						
						// Print the response onto the page so that our gateway can read it
						header('Content-type: text/plain');
						echo $response;	
						}
					break;
					case "3":
						if($level==18){							
						//9b. Graduate user to level 14
						$sql4="UPDATE `session` SET `level`=41 where `session_id`='".$sessionId."'";
						$db->query($sql4);

						$response = "CON  Change Phone Number\n";
						$response .= "Phone Number Updatation\n";
						$response .= "1. Enter Your Pin To Proceed With The Update\n";
						
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
							$response .= "1. Change Pin\n";
							$response .= "2. Change Name\n";
							$response .= "3. Change Phone Number\n";

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
		// level 32-44
		// Chichewa Implementation
// Menu 2.1.1.1 Farm categories Chichewa Menu
		else if($level==19){
			if(!$userResponse==""){
				switch($userResponse){
					case "1":
						if($level==19){							
						//Graduate user to level 32
						$sql4="UPDATE `session` SET `level`=32 where `session_id`='".$sessionId."'";
						$db->query($sql4);

						$response = "CON  Magulu A Zithu Zakumunda\n";
						$response .= "Mwasankha Wogulisa Za Kumunda\n";
						$response .= "1. Magulu A Zinthu Za Kumunda\n";

						// Print the response onto the page so that our gateway can read it
						header('Content-type: text/plain');
						echo $response;	
						}
					break;
					default:
						if($level==19){
							// Return user to Main Menu & Demote user's level
							$response = "CON Mwasankha Nambala Yolakwika\n";
							$response .= "Yesalaninso Posankha Numbala Yoyenera\n";
							$response .= "1. Magulu A Zinthu Za Kumunda \n";

							//update the level to 18 so that the session should start at level 19
							$sql4="UPDATE `session` SET `level`=19 where `session_id`='".$sessionId."'";
							$db->query($sql4);

							// Print the response onto the page so that our gateway can read it
							header('Content-type: text/plain');
							echo $response;	
						}
				}
			}
		}
// Menu 2.2.1.1 Quantinty To Sell Chichewa Menu
		else if($level==20){
			if(!$userResponse==""){
				switch($userResponse){
					case "1":
						if($level==20){							
						//9b. Graduate user to level 14
						$sql4="UPDATE `session` SET `level`=33 where `session_id`='".$sessionId."'";
						$db->query($sql4);

						$response = "CON Mlingo Wa Katundu Womwe Ukufunikira\n";
						$response .= "Mwasankha {Dzina La Kandutu ndi Mtengo}\n";
						$response .= "1. Lowesani Nambala Kapena Mlingo Womwe Ukufunikira\n";

						// Print the response onto the page so that our gateway can read it
						header('Content-type: text/plain');
						echo $response;	
						}
					break;
					case "2":
						if($level==20){
						//9b. Graduate user to level 14
						$sql4="UPDATE `session` SET `level`=34 where `session_id`='".$sessionId."'";
						$db->query($sql4);


						$response = "CON Mlingo Wa Katundu Womwe Ukufunikira\n";
						$response .= "Mwasankha Nthumba La Chimanga Pa - K6,000.00\n";
						$response .= "1. Lowesani Nambala Kapena Mlingo Womwe Mukugulitsa\n";

						// Print the response onto the page so that our gateway can read it
						header('Content-type: text/plain');
						echo $response;								
						}
					break;
					case "3":
						if($level==20){
						//9b. Graduate user to level 14
						$sql4="UPDATE `session` SET `level`=35 where `session_id`='".$sessionId."'";
						$db->query($sql4);


						$response = "CON Mlingo Wa Katundu Womwe Ukufunikira\n";
						$response .= "Mwasankha Nthumba La Mpunga - K10,000.00\n";
						$response .= "1. Lowesani Nambala Kapena Mlingo Womwe Mukugulitsa\n";

						// Print the response onto the page so that our gateway can read it
						header('Content-type: text/plain');
						echo $response;								
						}
					break;
					case "4":
						if($level==20){
						//9b. Graduate user to level 14
						$sql4="UPDATE `session` SET `level`=36 where `session_id`='".$sessionId."'";
						$db->query($sql4);


						$response = "CON Mlingo Wa Katundu Womwe Ukufunikira\n";
						$response .= "Mwasankha Nthumba La Nandolo - K5,000.00\n";
						$response .= "1. Lowesani Nambala Kapena Mlingo Womwe Mukugulitsa\n";

						// Print the response onto the page so that our gateway can read it
						header('Content-type: text/plain');
						echo $response;								
						}
					break;
					default:
						if($level==20){
							// Return user to Main Menu & Demote user's level
							$response = "CON Mwasankha Nambala Yolakwika\n";
							$response .= "Lowesani Nambala Ya Zinthu Zomwe Mufuna Kugulisa\n";
							$response .= "1. Dzina La Katundu - Mtengo \n";
							$response .= "2. Thumba La Mpunga - Mtengo \n";
							$response .= "3. Thumba La Chimanga - Mtengo \n";
							$response .= "4. Thumba La Nandolo - Mtengo \n";

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
// Menu 2.3.1.1 Mayina A Alangizi Chichewa Menu
		else if($level==21){
			if(!$userResponse==""){
				switch($userResponse){
					case "1":
						if($level==21){							
						//9b. Graduate user to level 14
						$sql4="UPDATE `session` SET `level`=37 where `session_id`='".$sessionId."'";
						$db->query($sql4);

						$response = "CON  Mndandanda Wa Alangizi Muboma La {Dzina La Boma}\n";
						$response .= "Alangizi Muboma Lanu\n";
						$response .= "1. Dzina La Mlangizi\n";
						$response .= "2. Mr. Rabson Sayenda\n";
						$response .= "3. Mr. Kondwani Lusinje\n";
						$response .= "4. Dr. Nelson Kumbani\n";
						$response .= "5. Mr. Fredson Likhunya\n";

						// Print the response onto the page so that our gateway can read it
						header('Content-type: text/plain');
						echo $response;	
						}
					break;
					default:
						if($level==21){
							// Return user to Main Menu & Demote user's level
							$response = "CON Mwasankha Nambala Yolakwika\n";
							$response .= "Chonde Sankhaninso Dzina La Mlangizi\n";
							$response .= "1. Dzina La Mlangizi\n";
							$response .= "2. Mr. Rabson Sayenda\n";
							$response .= "3. Mr. Kondwani Lusinje\n";
							$response .= "4. Dr. Nelson Kumbani\n";
							$response .= "5. Mr. Fredson Likhunya\n";

							//update the level to 0 so that the session should start at level 1
							$sql4="UPDATE `session` SET `level`=21 where `session_id`='".$sessionId."'";
							$db->query($sql4);

							// Print the response onto the page so that our gateway can read it
							header('Content-type: text/plain');
							echo $response;	
						}
				}
			}
		}
//Menu 2.4.1.1 Kusamala Za Chuma Implementation
		else if($level==22){
			if(!$userResponse==""){
				switch($userResponse){
					case "1":
						if($level==22){							
						//9b. Graduate user to level 14
						$sql4="UPDATE `session` SET `level`=38 where `session_id`='".$sessionId."'";
						$db->query($sql4);

						$response = "CON  Chigawo Chosamala Za Chuma\n";
						$response .= "Kuwerengesera Malimidwe\n";
						$response .= "1. Kuwerengesera Malimidwe 1\n";
						$response .= "2. Kuwerengesera Malimidwe 2\n";

						// Print the response onto the page so that our gateway can read it
						header('Content-type: text/plain');
						echo $response;	
						}
					break;
					default:
						if($level==22){
							// Return user to Main Menu & Demote user's level
							$response = "CON Mwasankha Molakwika\n";
							$response .= "Kuwerengesera Malimidwe\n";
							$response .= "1. Kuwerengesera Malimidwe 1\n";
							$response .= "2. Kuwerengesera Malimidwe 2\n";

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
//Menu 2.5.1.1 Kusintha Za Akaunti
		else if($level==23){
			if(!$userResponse==""){
				switch($userResponse){
					case "1":
						if($level==23){							
						//9b. Graduate user to level 14
						$sql4="UPDATE `session` SET `level`=42 where `session_id`='".$sessionId."'";
						$db->query($sql4);

						$response = "CON  Kusitha Nambala Ya Chinsinsi (PIN)\n";
						$response .= "Kusitha Nambala Ya Chinsinsi\n";
						$response .= "1. Lowesani Nambala Yanu Yakale Ya Chinsinsi\n";

						// Print the response onto the page so that our gateway can read it
						header('Content-type: text/plain');
						echo $response;	
						}
					break;
					case "2":
						if($level==23){							
						//9b. Graduate user to level 14
						$sql4="UPDATE `session` SET `level`=43 where `session_id`='".$sessionId."'";
						$db->query($sql4);

						$response = "CON Kusintha Dzina Lanu\n";
						$response .= "Kusintha Dzina\n";
						$response .= "1. Lowesani Nambala Ya Chinsinsi Kuti Mutipilize\n";
						
						// Print the response onto the page so that our gateway can read it
						header('Content-type: text/plain');
						echo $response;	
						}
					break;
					case "3":
						if($level==23){							
						//9b. Graduate user to level 14
						$sql4="UPDATE `session` SET `level`=44 where `session_id`='".$sessionId."'";
						$db->query($sql4);

						$response = "CON  Kusintha Nambala Ya Foni\n";
						$response .= "Kusintha Foni Nambala\n";
						$response .= "1. Lowesani Nambala Ya Chinsinsi Kuti Mutipilize Apa\n";
						
						// Print the response onto the page so that our gateway can read it
						header('Content-type: text/plain');
						echo $response;	
						}
					break;
					default:
						if($level==23){
							// Return user to Main Menu & Demote user's level
							$response = "CON Wrong Option\n";
							$response .= "Try Again To Update\n";
							$response .= "1. Sinthani Nambala Ya Chinsinsi\n";
							$response .= "2. Sinthani Dzina\n";
							$response .= "3. Sinthani Phone Number\n";

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
	
		// level 45-
		else if($level==24){
			if(!$userResponse==""){
				
				$response = "END this is level 24\n";
				header('Content-type: text/plain');
				echo $response;	
			}
		}
		
		else if($level==25){
			if(!$userResponse==""){
				
				$response = "END this is level 25\n";
				header('Content-type: text/plain');
				echo $response;	
			}
		}
		else if($level==26){
			if(!$userResponse==""){
				
				$response = "END this is level 26\n";
				header('Content-type: text/plain');
				echo $response;	
			}
		}
		else if($level==27){
			if(!$userResponse==""){
				
				$response = "END this is level 27\n";
				header('Content-type: text/plain');
				echo $response;	
			}
		}
		else if($level==28){
			if(!$userResponse==""){
				
				$response = "END this is level 28\n";
				header('Content-type: text/plain');
				echo $response;	
			}
		}
		else if($level==29){
			if(!$userResponse==""){
				
				$response = "END takulandirani mu level 29 \n";
				header('Content-type: text/plain');
				echo $response;	
			}
		}
	
		else if($level==30){
			if(!$userResponse==""){
				
				$response = "END mwafika muno ndi level 30 \n";
				header('Content-type: text/plain');
				echo $response;	
			}
		}
		else if($level==31){
			if(!$userResponse==""){
				
				$response = "END muli mu 31 \n";
				header('Content-type: text/plain');
				echo $response;	
			}
		}
		else if($level==32){
			if(!$userResponse==""){
				
				$response = "END mwafika mu level 32 \n";
				header('Content-type: text/plain');
				echo $response;	
			}
		}
		else if($level==33){
			if(!$userResponse==""){
				
				$response = "END iyi ndi level 33 \n";
				header('Content-type: text/plain');
				echo $response;	
				
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
				     $sql10c = "INSERT INTO farmer(`phonenumber`) VALUES ('".$phoneNumber."')";
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
        			$response = "CON District Name Not supposed To Be Empty. Please Enter Your District Name \n";
			  		// Print the response onto the page so that our gateway can read it
			  		header('Content-type: text/plain');
 			  		echo $response;	
			        break;
			    case 2:
			    	//10f. Request for city again --- level has not changed...
					$response = "CON ID Number Is Not Supposed To Be Empty. \n Please Enter Your ID Number \n";
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
				     $sql10c = "INSERT INTO farmer (`phonenumber`) VALUES ('".$phoneNumber."')";
				     $db->query($sql10c);
				     
					 //10d. Serve the menu request for name
				     $response = "CON Please enter your first and last name";
			  		
					// Print the response onto the page so that our gateway can read it
			  		header('Content-type: text/plain');
				  		echo $response;	
			    break;		    
			    case 1:
			    	//11b. Update Name, and Request for District Name
			        $sql11b = "UPDATE farmer SET `name`='".$userResponse."' WHERE `phonenumber` LIKE '%". $phoneNumber ."%'";
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
                    $sql11d = "UPDATE farmer SET `location`='".$userResponse."' WHERE `phonenumber` LIKE '%". $phoneNumber ."%'";
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
                    $sql11d = "UPDATE farmer SET `id_number`='".$userResponse."' WHERE `phonenumber` = '". $phoneNumber ."'";
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