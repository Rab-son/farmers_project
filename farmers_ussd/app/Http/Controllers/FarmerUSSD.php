<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FarmerUSSD extends Controller
{
    public function session()
    {
      <?php
    //$Authors==$KondwaniLadmanLusinje&$RabsonJuniorSayenda 

    // Connection Credential
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
   
    // Receive the POST from browser URL
	$sessionId     =$_GET['sessionId'];
	$phoneNumber   =$_GET['phoneNumber'];
	$serviceCode   =$_GET['serviceCode'];
    $text          =$_GET['text'];
    
    // Explode the text into an array by separating the input with stars inbetween
	$textArray=explode('*', $text);

    // Trim the string arra to get the last string entered
	// We pass the response to a variable userResponse
	$userResponse=trim(end($textArray));
	
	// Set the default session level to 0
    $level=0;

    // Check the level of the user from the DataBase and retain default level if none is found for this session
	$sql = "select level from session where session_id ='".$sessionId." '";
	$levelQuery = $db->query($sql);
	if($result = $levelQuery->fetch_assoc()) {
		//setting the session from the database
  		$level = $result['level'];
    }
    
    // Check the farmer from the DataBase to verify if the user is registered or not
	$sql = "SELECT * FROM farmer WHERE phoneNumber LIKE '%".$phoneNumber."%' LIMIT 1";
	$farmerQuery=$db->query($sql);
	$farmerAvailable=$farmerQuery->fetch_assoc();   

    //====================CHECKING IF FARMER IS REGISTERED OR NOT ====================	
	// Check if the FARMER is available (yes)->Serve the menu; (no)->Register the FARMER
    
    if($farmerAvailable && $farmerAvailable['name']!=NULL && $farmerAvailable['id_number']!=NULL){
      	if($level==0){
			if($userResponse==""){ //The fisrt string has to be empty at the begginning
			    // Graduate user to next level & Serve Main Menu by setting the level to one in the database
				$sql9b = "INSERT INTO `session`(`session_id`,`phonenumber`,`level`) VALUES('".$sessionId."','".$phoneNumber."',1)";
				$db->query($sql9b);
				//Serve our services menu
				$response = "CON Welcome to Farmers World\n";
				$response .= "Please select language\n";
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
							$sql2a="UPDATE `session` SET `level`=69 where `session_id`='".$sessionId."'";
							$db->query($sql2a);
							//Menu 2 Chichewa 							
							//Serve Chichewa services menu
							$response = "Takulandirani Kuno Ku Farmers World\n";
							$response = "Zikomo Posankha Chichewa \n";
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
                          	$sql4="UPDATE `session` SET `level`=14 where `session_id`='".$sessionId."'";
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
                           $sql4="UPDATE `session` SET `level`=43 where `session_id`='".$sessionId."'";
                           $db->query($sql4);
							
							      $response = "CON Farmers World Advisors\n";
							      $response .= "Farm Categories Of Advisors\n\n";

							      $response .= "1. Crop Production\n";
							      $response .= "2. Animal Husbandly\n";
							      $response .= "3. Poultry Farming\n";
							      $response .= "4. Main Menu\n";

							// Print the response onto the page so that our gateway can read it
							header('Content-type: text/plain');
                            echo $response;				
                        }
                    break;
                    //Menu 2.4
                    case "4": // user will be here if he chooses option 4 in english menu
                        if($level==2){
                            // Graduate user to level 7
                            $sql4="UPDATE `session` SET `level`=50 where `session_id`='".$sessionId."'";
                            $db->query($sql4);
                            
                            $response = "CON  Farm Management Implementation\n";
                            $response .= "Farm Calculations\n";
							        $response .= "Select Crop To Be Produced\n\n";
							
                            $response .= "1. Maize\n";
                            $response .= "2. Cotton\n";
                            $response .= "3. Tobbaco\n";
                            $response .= "4. Soya Beans\n";
                            $response .= "5. Main Menu\n";
                            
                            header('Content-type: text/plain');
                            echo $response;				
                        }
                    break;
                     //Menu 2.5
                     case "5": // user will be here if he chooses option 5 in english menu
                        if($level==2){
                            // Graduate user to level 59
                            $sql4="UPDATE `session` SET `level`=59 where `session_id`='".$sessionId."'";
                            $db->query($sql4);
                            
                            $response = "CON Farmers World Notification Section\n";
							       $response .= "You Have Choosen Nofications\n\n";
							
                            $response .= "1. Recieve Nofications\n";
                            $response .= "2. Main Menu";
                            
                            header('Content-type: text/plain');
                            echo $response;				
                        }
                    break;
                    //Menu 2.6
                    case "6": // user will be here if he chooses option 5 in english menu
                        if($level==2){
                            // Graduate user to level 62
                            $sql4="UPDATE `session` SET `level`=62 where `session_id`='".$sessionId."'";
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
						
                        $response .= "1. Zomba ADMARC, Zomba\n";
                        $response .= "2. Blantyre ADMARC, Blantyre\n";
                        $response .= "3. Lilongwe ADMARC, Lilongwe\n";
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
                                                            
                            //update the level to 0 so that the session should start at level 1
                            $sql4="UPDATE `session` SET `level`=3 where `session_id`='".$sessionId."'";
                            $db->query($sql4);

                            // Print the response onto the page so that our gateway can read it
                            header('Content-type: text/plain');
                            echo $response;	
                        }
                }
            }
      	}
      	//MenU 2.X.1.1 START
      	//Menu 2.1.1.1 Farm categories English Menu
		else if($level==4){
			if(!$userResponse==""){
				switch($userResponse){
					case "1":
						if($level==4){							
						   //Graduate user to level 5
						   $sql4="UPDATE `session` SET `level`=5 where `session_id`='".$sessionId."'";
						   $db->query($sql4);

						   $response = "CON You Have Selected Zomba ADMARC\n";
							$response .= "Categories Of Their Sales:\n\n";
							
    						$response .= "1. Farm Inputs\n";
						   $response .= "2. Farm Produce\n";
							$response .= "3. Back\n";
						   $response .= "4. Main Menu\n";

						    // Print the response onto the page so that our gateway can read it
						    header('Content-type: text/plain');
						    echo $response;	
						}
					break;

					case "2":
						if($level==4){							
						    //Graduate user to level  
						    $sql4="UPDATE `session` SET `level`=8 where `session_id`='".$sessionId."'";
						    $db->query($sql4);

						    $response = "CON You Have Selected Blantyre ADMARC\n";
							$response .= "Categories Of Their Sales:\n\n";
							
						    $response .= "1. Farm Inputs\n";
						    $response .= "2. Farm Produce\n";
						    $response .= "3. Back\n";
						    $response .= "4. Main Menu\n";

						    // Print the response onto the page so that our gateway can read it
						    header('Content-type: text/plain');
						    echo $response;	
						}
					break;

					case "3":
						if($level==4){							
						   //Graduate user to level 
						   $sql4="UPDATE `session` SET `level`=11 where `session_id`='".$sessionId."'";
						   $db->query($sql4);

						   $response = "CON You Have Selected Lilongwe ADMARC\n";
							$response .= "Categories Of Their Sales:\n\n";
							
        				   $response .= "1. Farm Inputs\n";
						   $response .= "2. Farm Produce\n";
                     $response .= "3. Back\n";
						   $response .= "4. Main Menu\n";

						    // Print the response onto the page so that our gateway can read it
						    header('Content-type: text/plain');
						    echo $response;	
					}
					break;

					case "4":   			// user will be here if he chooses option 1 in Eenglish menu
						if($level==4){
						//Downgrade user to level 3
							$sql4="UPDATE `session` SET `level`=3 where `session_id`='".$sessionId."'";
							$db->query($sql4);
								
							$response = "CON Farmers World Farm Suppliers\n"; 
							$response .= "You Have chosen Suppliers\n";
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
							$response = "CON Wrong Option, Please Try Again\n";
							$response .= "Farm Suppliers\n";
							$response .= "Select one and see what they sale\n\n";
						
                    		$response .= "1. Zomba ADMARC, Zomba\n";
                     		$response .= "2. Blantyre ADMARC, Blantyre\n";
                     		$response .= "3. Lilongwe ADMARC, Lilongwe\n";
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
						// Graduate user to level 6
						$sql4="UPDATE `session` SET `level`=6 where `session_id`='".$sessionId."'";
						$db->query($sql4);

						$response = "END You Have Selected Farm Inputs ZA\n";
						$response .= "The Following Items Are On Sale:\n\n";

						$response .= "> Tomato Seeds Mk200/25g\n";
						$response .= "> CAN Fertilizer Mk7500/50Kg\n";
						$response .= "> Maize Insecticide Mk2500/10L\n";
						$response .= "> Fish Hooks Mk1260/kg\n";
						$response .= "> Fish Nets(Large) Mk7500/50Kg\n\n";

						$response .= "1. Back\n";
						$response .= "2. Main Menu\n";

						// Print the response onto the page so that our gateway can read it
						header('Content-type: text/plain');
						echo $response;	
						}
					break;

					case "2":
						if($level==5){							
						// Graduate user to level 
						$sql4="UPDATE `session` SET `level`=7 where `session_id`='".$sessionId."'";
						$db->query($sql4);

						$response = "END You Have Selected Farm OutPut ZA\n";
						$response .= "The Following Items Are On Sale:\n\n";

						$response .= "> Soya Mk7200/50kg\n";
						$response .= "> Rice Mk10000/50Kg\n";
						$response .= "> Maize Mk5000/50Kg\n";
						$response .= "> Chambo Mk1260/kg\n";
						$response .= "> Cotton Mk1260/50Kg\n";

						$response .= "1. Back\n";
						$response .= "2. Main Menu\n";

						// Print the response onto the page so that our gateway can read it
						header('Content-type: text/plain');
						echo $response;	
						}
					break;

					case "3":
						if($level==5){							
						// Graduate user to level 14
						$sql4="UPDATE `session` SET `level`=4 where `session_id`='".$sessionId."'";
						$db->query($sql4);

						$response = "CON You Have Selected Suppliers\n";
                        $response .= "Select one and see what they sale\n\n";

                        $response .= "1. Zomba ADMARC, Zomba\n";
                        $response .= "2. Blantyre ADMARC, Blantyre\n";
                        $response .= "3. Lilongwe ADMARC, Lilongwe\n";
                        $response .= "4. Back\n";
                        $response .= "5. Main Menu\n";;
						
						// Print the response onto the page so that our gateway can read it
						header('Content-type: text/plain');
						echo $response;	
						}
					break;

					case "4":   			// if the choice is 1 the user go to nglish version
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
							$response = "Wrong Option, Please Try Again.\n";
							$response .= "You Have Selected Zomba ADMARC\n";
							$response .= "Categories Of Their Sales:\n\n";
							
    						$response .= "1. Farm Inputs\n";
						    $response .= "2. Farm Produce\n";
							$response .= "3. Back\n";
						    $response .= "4. Main Menu\n";
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
      	else if($level==6){ //last level of Zomba ADMARC
			if(!$userResponse==""){
				switch($userResponse){
					case "1":
						if($level==6){							
							// Graduate user to level 14
							$sql4="UPDATE `session` SET `level`=5 where `session_id`='".$sessionId."'";
							$db->query($sql4);

							$response = "CON You Have Selected Zomba ADMARC\n";
							$response .= "Categories Of Their Sales:\n\n";

							$response .= "1. Farm Inputs\n";
							$response .= "2. Farm Produce\n";
							$response .= "3. Back\n";
							$response .= "4. Main Menu\n";

							// Print the response onto the page so that our gateway can read it
							header('Content-type: text/plain');
							echo $response;	
						}
					break;

					case "2":   			// returns the user to the main menu
						if($level==6){
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
						if($level==6){
							// Return user to Main Menu & Demote user's level
							
							$response = "Wrong Option, Please Try Again\n";
							
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
						    //Downgrade user to level 5
						    $sql4="UPDATE `session` SET `level`=5 where `session_id`='".$sessionId."'";
						    $db->query($sql4);

						    $response = "CON You Have Selected Zomba ADMARC\n";
							$response .= "Categories Of Their Sales:\n\n";
							
    					    $response .= "1. Farm Inputs\n";
						    $response .= "2. Farm Produce\n";
						    $response .= "3. Back\n";
						    $response .= "4. Main Menu\n";

						    // Print the response onto the page so that our gateway can read it
						    header('Content-type: text/plain');
						    echo $response;	
						}
					break;

					case "2":   			// returns the user to the main menu
						if($level==7){
							//Downgrade user to level 2
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
						if($level==7){
							// Return user to Main Menu & Demote user's level
							
							$response = "Wrong Option, Please Try Again\n";
							
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
						// Graduate user to level 9
						$sql4="UPDATE `session` SET `level`=9 where `session_id`='".$sessionId."'";
						$db->query($sql4);

						$response = "END You Have Selected Farm Inputs BT\n";
						$response .= "The Following Items Are On Sale:\n\n";

						$response .= "> Tomato Seeds Mk200/25g\n";
						$response .= "> CAN Fertilizer Mk7500/50Kg\n";
						$response .= "> Maize Insecticide Mk2500/10L\n";
						$response .= "> Fish Hooks Mk1260/kg\n";
						$response .= "> Fish Nets(Large) Mk7500/50Kg\n\n";

						$response .= "1. Back\n";
						$response .= "2. Main Menu\n";

						// Print the response onto the page so that our gateway can read it
						header('Content-type: text/plain');
						echo $response;	
						}
					break;

					case "2":
						if($level==8){							
						// Graduate user to level 
						$sql4="UPDATE `session` SET `level`=10 where `session_id`='".$sessionId."'";
						$db->query($sql4);

						$response = "END You Have Selected Farm OutPut BT\n";
						$response .= "The Following Items Are On Sale:\n\n";

						$response .= "> Soya Mk7200/50kg\n";
						$response .= "> Rice Mk10000/50Kg\n";
						$response .= "> Maize Mk5000/50Kg\n";
						$response .= "> Chambo Mk1260/kg\n";
						$response .= "> Cotton Mk1260/50Kg\n";

						$response .= "1. Back\n";
						$response .= "2. Main Menu\n";

						// Print the response onto the page so that our gateway can read it
						header('Content-type: text/plain');
						echo $response;	
						}
					break;

					case "3":
						if($level==8){							
						// Graduate user to level 14
						$sql4="UPDATE `session` SET `level`=4 where `session_id`='".$sessionId."'";
						$db->query($sql4);

						$response = "CON You Have Selected Suppliers\n";
                        $response .= "Select one and see what they sale\n\n";

                        $response .= "1. Zomba ADMARC, Zomba\n";
                        $response .= "2. Blantyre ADMARC, Blantyre\n";
                        $response .= "3. Lilongwe ADMARC, Lilongwe\n";
                        $response .= "4. Back\n";
                        $response .= "5. Main Menu\n";;
						
						// Print the response onto the page so that our gateway can read it
						header('Content-type: text/plain');
						echo $response;	
						}
					break;

					case "4":   			// if the choice is 1 the user go to nglish version
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
							$response = "Wrong Option, Please Try Again\n";
							$response .= "You Have Selected Farm Inputs BT\n";
						    $response .= "The Following Items Are On Sale:\n";

						    $response .= "> Tomato Seeds Mk200/25g\n";
						    $response .= "> CAN Fertilizer Mk7500/50Kg\n";
						    $response .= "> Maize Insecticide Mk2500/10L\n";
						    $response .= "> Fish Hooks Mk1260/kg\n";
						    $response .= "> Fish Nets(Large) Mk7500/50Kg\n\n";

						    $response .= "1. Back\n";
						    $response .= "2. Main Menu\n";
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
      	else if($level==9){ //last level of Blantyre ADMARC
			if(!$userResponse==""){
				
				switch($userResponse){
					case "1":
						if($level==9){							
						// Graduate user to level 14
						$sql4="UPDATE `session` SET `level`=8 where `session_id`='".$sessionId."'";
						$db->query($sql4);

						$response = "CON You Have Selected Blantyre ADMARC\n";
						$response .= "Categories Of Their Sales:\n\n";

						$response .= "1. Farm Inputs\n";
						$response .= "2. Farm Produce\n";
						$response .= "3. Back\n";
						$response .= "4. Main Menu\n";

						// Print the response onto the page so that our gateway can read it
						header('Content-type: text/plain');
						echo $response;	
						}
					break;

					case "2":   			// returns the user to the main menu
						if($level==9){
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
						if($level==9){
							// Return user to Main Menu & Demote user's level
							
							$response = "Wrong Option, Please Try Again\n";
							
							// Print the response onto the page so that our gateway can read it
							header('Content-type: text/plain');
							echo $response;	
						}
				}		
			}
      	}        
		else if($level==10){
			if(!$userResponse==""){
				
				switch($userResponse){
					case "1":
						if($level==10){							
						    //Downgrade user to level 5
						    $sql4="UPDATE `session` SET `level`=8 where `session_id`='".$sessionId."'";
						    $db->query($sql4);

						    $response = "CON You Have Selected Blantyre ADMARC\n";
							$response .= "Categories Of Their Sales:\n\n";
							
    					    $response .= "1. Farm Inputs\n";
						    $response .= "2. Farm Produce\n";
						    $response .= "3. Back\n";
						    $response .= "4. Main Menu\n";

						    // Print the response onto the page so that our gateway can read it
						    header('Content-type: text/plain');
						    echo $response;	
						}
					break;

					case "2":   			// returns the user to the main menu
						if($level==10){
							//Downgrade user to level 2
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
						if($level==10){
							// Return user to Main Menu & Demote user's level
							
							$response = "Wrong Option, Please Try Again\n";
							
							// Print the response onto the page so that our gateway can read it
							header('Content-type: text/plain');
							echo $response;	
						}
				}	
			}
		}
		else if($level==11){
			if(!$userResponse==""){
				
				switch($userResponse){
					case "1":
						if($level==11){							
						// Graduate user to level 9
						$sql4="UPDATE `session` SET `level`=12 where `session_id`='".$sessionId."'";
						$db->query($sql4);

						$response = "END You Have Selected Farm Inputs LL\n";
						$response .= "The Following Items Are On Sale:\n\n";

						$response .= "> Tomato Seeds Mk200/25g\n";
						$response .= "> CAN Fertilizer Mk7500/50Kg\n";
						$response .= "> Maize Insecticide Mk2500/10L\n";
						$response .= "> Fish Hooks Mk1260/kg\n";
						$response .= "> Fish Nets(Large) Mk7500/50Kg\n\n";

						$response .= "1. Back\n";
						$response .= "2. Main Menu\n";

						// Print the response onto the page so that our gateway can read it
						header('Content-type: text/plain');
						echo $response;	
						}
					break;

					case "2":
						if($level==11){							
						// Graduate user to level 
						$sql4="UPDATE `session` SET `level`=13 where `session_id`='".$sessionId."'";
						$db->query($sql4);

						$response = "END You Have Selected Farm OutPut LL\n";
						$response .= "The Following Items Are On Sale:\n\n";

						$response .= "> Soya Mk7200/50kg\n";
						$response .= "> Rice Mk10000/50Kg\n";
						$response .= "> Maize Mk5000/50Kg\n";
						$response .= "> Chambo Mk1260/kg\n";
						$response .= "> Cotton Mk1260/50Kg\n";

						$response .= "1. Back\n";
						$response .= "2. Main Menu\n";

						// Print the response onto the page so that our gateway can read it
						header('Content-type: text/plain');
						echo $response;	
						}
					break;

					case "3":
						if($level==11){							
						// Graduate user to level 14
						$sql4="UPDATE `session` SET `level`=4 where `session_id`='".$sessionId."'";
						$db->query($sql4);

						$response = "CON You Have Selected Suppliers\n";
                        $response .= "Select one and see what they sale\n\n";

                        $response .= "1. Zomba ADMARC, Zomba\n";
                        $response .= "2. Blantyre ADMARC, Blantyre\n";
                        $response .= "3. Lilongwe ADMARC, Lilongwe\n";
                        $response .= "4. Back\n";
                        $response .= "5. Main Menu\n";;
						
						// Print the response onto the page so that our gateway can read it
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
						if($level==11){
							// Return user to Main Menu & Demote user's level
							$response = "Wrong Option, Please Try Again\n";
							$response .= "You Have Selected Farm Inputs LL\n";
						    $response .= "The Following Items Are On Sale:\n";

						    $response .= "> Tomato Seeds Mk200/25g\n";
						    $response .= "> CAN Fertilizer Mk7500/50Kg\n";
						    $response .= "> Maize Insecticide Mk2500/10L\n";
						    $response .= "> Fish Hooks Mk1260/kg\n";
						    $response .= "> Fish Nets(Large) Mk7500/50Kg\n";

						    $response .= "1. Back\n";
						    $response .= "2. Main Menu\n";
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
     	else if($level==12){ //last level of Lilongwe ADMARC
			if(!$userResponse==""){
				
				switch($userResponse){
					case "1":
						if($level==12){							
							// Graduate user to level 14
							$sql4="UPDATE `session` SET `level`=11 where `session_id`='".$sessionId."'";
							$db->query($sql4);

							$response = "CON You Have Selected Lilongwe ADMARC\n";
							$response .= "Categories Of Their Sales:\n\n";

							$response .= "1. Farm Inputs\n";
							$response .= "2. Farm Produce\n";
							$response .= "3. Back\n";
							$response .= "4. Main Menu\n";

							// Print the response onto the page so that our gateway can read it
							header('Content-type: text/plain');
							echo $response;	
						}
					break;

					case "2":   			// returns the user to the main menu
						if($level==12){
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
						if($level==12){
							// Return user to Main Menu & Demote user's level
							
							$response = "Wrong Option, Please Try Again\n";
							
							// Print the response onto the page so that our gateway can read it
							header('Content-type: text/plain');
							echo $response;	
						}
				}		
			}
      	}        
		else if($level==13){
			if(!$userResponse==""){
				
				switch($userResponse){
					case "1":
						if($level==13){							
						    //Downgrade user to level 5
						    $sql4="UPDATE `session` SET `level`=11 where `session_id`='".$sessionId."'";
						    $db->query($sql4);

						    $response = "CON You Have Selected Lilongwe ADMARC\n";
						    $response .= "Categories Of Their Sales:\n\n";
    					    $response .= "1. Farm Inputs\n";
						    $response .= "2. Farm Produce\n";
						    $response .= "3. Back\n";
						    $response .= "4. Main Menu\n";

						    // Print the response onto the page so that our gateway can read it
						    header('Content-type: text/plain');
						    echo $response;	
						}
					break;

					case "2":   			// returns the user to the main menu
						if($level==13){
							//Downgrade user to level 2
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
						if($level==13){
							// Return user to Main Menu & Demote user's level
							
							$response = "Wrong Option, Please Try Again\n";
							
							// Print the response onto the page so that our gateway can read it
							header('Content-type: text/plain');
							echo $response;	
						}
				}	
			}
		}			
		else if($level==14){
			if(!$userResponse==""){
				switch($userResponse){
					case "1":
						if($level==14){							
							// Graduate user to level 15
							$sql4="UPDATE `session` SET `level`=15 where `session_id`='".$sessionId."'";
							$db->query($sql4);
		
							$response = "CON List of Available Markets\n";
							$response .= "Please Select One\n\n";
		
							$response .= "1. Zomba ADMARC Market\n";
							$response .= "2. Lilongwe Auction Holdings Market\n";
							$response .= "3. Blantyre Auction Holdings\n";
							$response .= "4. Back\n";
							$response .= "5. Main Menu\n";
		
							// Print the response onto the page so that our gateway can read it
							header('Content-type: text/plain');
							echo $response;	
						}
					break;
							
					case "2":   			// if the choice is 1 the user go to nglish version
						if($level==14){
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
						if($level==14){
						// Return user to Main Menu & Demote user's level
							$response = "CON Wrong Option\n";
							$response .= "Farmers World Market Section\n";
							$response .= "You Have Chosen Markets\n\n"; 
							
                            $response .= "1. View Markets And What They Buy\n";
                            $response .= "2. Main Menu";

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
		else if($level==15){
			if(!$userResponse==""){
				switch($userResponse){
					case "1":
						if($level==15){							
							// Graduate user to level 16
							$sql4="UPDATE `session` SET `level`=16 where `session_id`='".$sessionId."'";
							$db->query($sql4);

							$response = "CON Zomba ADMARC\n";
							$response .= "List Of Products To Sale\n";
							$response .= "Please Select One\n\n";

							$response .= "1. Maize at MK5000/50Kg\n";
							$response .= "2. Soya Beans at MK7000/50Kg\n";
							$response .= "3. Ground Nuts MK10000/50Kg\n";
							$response .= "4. Back\n";
							$response .= "5. Main Menu\n";

							// Print the response onto the page so that our gateway can read it
							header('Content-type: text/plain');
							echo $response;	
						}
					break;

					case "2":
						if($level==15){							
							// Graduate user to level 58
							$sql4="UPDATE `session` SET `level`=25 where `session_id`='".$sessionId."'";
							$db->query($sql4);

							$response = "CON Lilongwe Auction Holdings\n";
							$response .= "List Of Products To Sale\n";
							$response .= "Please Select One\n\n";

							$response .= "1. Maize at MK5000/50Kg\n";
							$response .= "2. Soya Beans at MK7000/50Kg\n";
							$response .= "3. Ground Nuts MK10000/50Kg\n";
							$response .= "4. Back\n";
							$response .= "5. Main Menu\n";

							// Print the response onto the page so that our gateway can read it
							header('Content-type: text/plain');
							echo $response;	
						}
					break;

					case "3":
						if($level==15){							
							// Graduate user to level 59
							$sql4="UPDATE `session` SET `level`=34 where `session_id`='".$sessionId."'";
							$db->query($sql4);

							$response = "CON Blantyre Auction Holdings\n";
							$response .= "List Of Products To Sale\n";
							$response .= "Please Select One\n\n";

							$response .= "1. Maize at MK5000/50Kg\n";
							$response .= "2. Soya Beans at MK7000/50Kg\n";
							$response .= "3. Ground Nuts MK10000/50Kg\n";
							$response .= "4. Back\n";
							$response .= "5. Main Menu\n";

							// Print the response onto the page so that our gateway can read it
							header('Content-type: text/plain');
							echo $response;	
						}
					break;

					case "4": // user will be here if he chooses option 2 in english menu
						if($level==15){
							// Graduate user to level 5
							$sql4="UPDATE `session` SET `level`=14 where `session_id`='".$sessionId."'";
							$db->query($sql4);

							$response = "CON  Farmers World Market Section\n";
							$response .= "You Have Chosen Markets\n";
							$response .= "1. View Markets And What They Buy\n";
							$response .= "2. Main Menu";

							header('Content-type: text/plain');
							echo $response;				
							}
					break;

					case "5":
						if($level==15){
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
						if($level==15){
							// Return user to Main Menu & Demote user's level
							$response = "CON Wrong Option\n";
							$response .= "List of Available Markets\n";
							$response .= "Please Select One\n\n";

							$response .= "1. Zomba ADMARC Market\n";
							$response .= "2. Lilongwe Auction Holdings\n";
							$response .= "3. Blantyre Auction Holdings\n";
							$response .= "4. Back\n";
							$response .= "5. Main Menu\n";

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
		//Markets section for Zomba English Menu
		else if($level==16){
			if(!$userResponse==""){
				switch($userResponse){
					case "1":
						if($level==16){							
							// Graduate user to level 17
							$sql="UPDATE `session` SET `level`=17 where `session_id`='".$sessionId."'";
							$db->query($sql);
							$response = "CON Zomba ADMARC\n";
							$response .= "Maize at MK5000/50Kg\n  ";
							
							$response .= "1. Enter Amount(in Kgs) to Sell\n";
	
							// Print the response onto the page so that our gateway can read it
							header('Content-type: text/plain');
							echo $response;	
						}
					break;
	
					case "2":
						if($level==16){							
							// Graduate user to level 14
							$sql4="UPDATE `session` SET `level`=21 where `session_id`='".$sessionId."'";
							$db->query($sql4);
	
							$response = "CON Zomba ADMARC\n";
							$response .= "Soya Beans at MK7000/50Kg\n  ";
							
							$response .= "1. Enter Amount(in Kgs) to Sell\n";

							// Print the response onto the page so that our gateway can read it
							header('Content-type: text/plain');
							echo $response;	
						}
					break;
	
					case "3":
						if($level==16){							
						// Graduate user to level 14
						$sql4="UPDATE `session` SET `level`=23 where `session_id`='".$sessionId."'";
						$db->query($sql4);
	
						$response = "CON Zomba ADMARC\n";
						$response .= "Ground Nuts MK10000/50Kg\n  ";
	
						$response .= "1. Enter Amount(in Kgs) to Sell\n";
							
						// Print the response onto the page so that our gateway can read it
						header('Content-type: text/plain');
						echo $response;	
						}
					break;
					

					case "4":
						if($level==16){							
							// Graduate user to level 14
							$sql4="UPDATE `session` SET `level`=15 where `session_id`='".$sessionId."'";
							$db->query($sql4);
	
							$response = "CON List of Available Markets\n";
							$response .= "Please Select One\n\n";

							$response .= "1. Zomba ADMARC Market\n";
							$response .= "2. Lilongwe Auction Holdings Market\n";
							$response .= "3. Blantyre Auction Holdings\n";
							$response .= "4. Back\n";
							$response .= "5. Main Menu\n";
	
							// Print the response onto the page so that our gateway can read it
							header('Content-type: text/plain');
							echo $response;	
						}
					break;

					case "5":
						if($level==16){							
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
						if($level==16){
							// Return user to Main Menu & Demote user's level
							$response = "CON Wrong Option, Please Try Again\n";
							$response .= "Zomba ADMARC\n";
							$response .= "List Of Products To Sale\n";
							$response .= "Please Select One\n\n";

							$response .= "1. Maize at MK5000/50Kg\n";
							$response .= "2. Soya Beans at MK7000/50Kg\n";
							$response .= "3. Ground Nuts MK10000/50Kg\n";
							$response .= "4. Back\n";
							$response .= "5. Main Menu\n";

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
		else if($level==17){
			if(!$userResponse==""){
				if($level==17){							
					// Graduate user to level 65
					$sql4="UPDATE `session` SET `level`=18 where `session_id`='".$sessionId."'";
					$db->query($sql4);

					$response = "CON Zomba ADMARC\n";
					$response .= "Maize at MK5000/50Kg\n";
							
					$response .= "You Have Entered (Amount Kgs) Up for Sell\n";

					$response .= "1. Continue\n";
					$response .= "2. Cancel\n";

					// Print the response onto the page so that our gateway can read it
					header('Content-type: text/plain');
					echo $response;	
				}				 							
			}
		}
		else if($level==18){
			if(!$userResponse==""){
				switch($userResponse){
					case "1":
						if($level==18){							
						// Graduate user to level 14
						$sql4="UPDATE `session` SET `level`=19 where `session_id`='".$sessionId."'";
						$db->query($sql4);
	
						$response = "END Zomba Admarc\n";
						$response .= "Maize at MK5000/50Kg\n";
							
						$response .= "Booking Successful!!!\n";

						// Print the response onto the page so that our gateway can read it
						header('Content-type: text/plain');
						echo $response;	
						}
					break;
	
					case "2":
						if($level==18){							
						// Graduate user to level 71
						$sql4="UPDATE `session` SET `level`=20 where `session_id`='".$sessionId."'";
						$db->query($sql4);
	
						$response = "END Zomba Admarc\n";
						$response .= "Maize at MK5000/50Kg\n";
							
						$response .= "Booking Cancelled by User\n";

						// Print the response onto the page so that our gateway can read it
						header('Content-type: text/plain');
						echo $response;	
						}
					break;
	
					default:
						if($level==18){
							// Return user to Main Menu & Demote user's level
							$response = "CON Wrong Option, Please Try Again\n";
							$response .= "Zomba ADMARC\n";
							$response .= "Maize at MK5000/50Kg\n";
							
							$response .= "You Have Entered (Amount Kgs) Up for Sell\n";

							$response .= "1. Continue\n";
							$response .= "2. Cancel\n";

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
				
				$response = "END, Level 19\n";
				header('Content-type: text/plain');
				echo $response;	
				
			}
		}
		else if($level==20){
			if(!$userResponse==""){
				
				$response = "END, Level 20\n";
				header('Content-type: text/plain');
				echo $response;	
				
			}
		}
		else if($level==21){
			if(!$userResponse==""){
				if($level==21){							
					// Graduate user to level 65
					$sql4="UPDATE `session` SET `level`=22 where `session_id`='".$sessionId."'";
					$db->query($sql4);

					$response = "CON Zomba ADMARC\n";
					$response .= "Soya Beans at MK7000/50Kg\n";
							
					$response .= "You Have Entered (Amount Kgs) Up for Sell\n";

					$response .= "1. Continue\n";
					$response .= "2. Cancel\n";

					// Print the response onto the page so that our gateway can read it
					header('Content-type: text/plain');
					echo $response;	
				}				 							
			}
		}
		else if($level==22){
			if(!$userResponse==""){
				switch($userResponse){
					case "1":
						if($level==22){							
						// Graduate user to level 19
						$sql4="UPDATE `session` SET `level`=19 where `session_id`='".$sessionId."'";
						$db->query($sql4);
	
						$response = "END Zomba Admarc\n";
						$response .= "Soya Beans at MK7000/50Kg\n";
							
						$response .= "Booking Successful!!!\n";

						// Print the response onto the page so that our gateway can read it
						header('Content-type: text/plain');
						echo $response;	
						}
					break;
	
					case "2":
						if($level==22){							
						// Graduate user to level 71
						$sql4="UPDATE `session` SET `level`=20 where `session_id`='".$sessionId."'";
						$db->query($sql4);
	
						$response = "END Zomba Admarc\n";
						$response .= "Soya Beans at MK7000/50Kg\n";
							
						$response .= "Booking Cancelled by User\n";

						// Print the response onto the page so that our gateway can read it
						header('Content-type: text/plain');
						echo $response;	
						}
					break;
	
					default:
						if($level==22){
							// Return user to Main Menu & Demote user's level
							$response = "CON Wrong Option, Please Try Again\n";
							$response .= "Zomba ADMARC\n";
							$response .= "Soya Beans at MK7000/50Kg\n";
							
							$response .= "You Have Entered (Amount Kgs) Up for Sell\n";

							$response .= "1. Continue\n";
							$response .= "2. Cancel\n";

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
			if(!$userResponse==""){
				if($level==23){							
					// Graduate user to level 65
					$sql4="UPDATE `session` SET `level`=24 where `session_id`='".$sessionId."'";
					$db->query($sql4);

					$response = "CON Zomba ADMARC\n";
					$response .= "Ground Nuts at MK10000/50Kg\n  ";
							
					$response .= "You Have Entered (Amount Kgs) Up for Sell\n";

					$response .= "1. Continue\n";
					$response .= "2. Cancel\n";

					// Print the response onto the page so that our gateway can read it
					header('Content-type: text/plain');
					echo $response;	
				}				 							
			}
		}
		else if($level==24){
			if(!$userResponse==""){
				switch($userResponse){
					case "1":
						if($level==24){							
						// Graduate user to level 14
						$sql4="UPDATE `session` SET `level`=19 where `session_id`='".$sessionId."'";
						$db->query($sql4);
	
						$response = "END Zomba Admarc\n";
						$response .= "Ground Nuts at MK10000/50Kg\n";
							
						$response .= "Booking Successful!!!\n";

						// Print the response onto the page so that our gateway can read it
						header('Content-type: text/plain');
						echo $response;	
						}
					break;
	
					case "2":
						if($level==24){							
						   // Graduate user to level 71
						   $sql4="UPDATE `session` SET `level`=20 where `session_id`='".$sessionId."'";
						   $db->query($sql4);
	
						   $response = "END Zomba Admarc\n";
						   $response .= "Ground Nuts at MK10000/50Kg\n";
							
						   $response .= "Booking Cancelled by User\n";

						   // Print the response onto the page so that our gateway can read it
						   header('Content-type: text/plain');
						   echo $response;	
						}
					break;
	
					default:
						if($level==24){
							// Return user to Main Menu & Demote user's level
							$response = "CON Wrong Option, Please Try Again\n";
							$response .= "Zomba ADMARC\n";
							$response .= "Ground Nuts at MK10000/50Kg\n";
							$response .= "You Have Entered (Amount Kgs) Up for Sell\n";

							$response .= "1. Continue\n";
							$response .= "2. Cancel\n";
      						$sql4="UPDATE `session` SET `level`=24 where `session_id`='".$sessionId."'";
							$db->query($sql4);
	  					   // Print the response onto the page so that our gateway can read it
							header('Content-type: text/plain');
							echo $response;	
						}
				}					
			}
		}
		//Markets section for Lilongwe English Menu
		else if($level==25){
			if(!$userResponse==""){
				switch($userResponse){
					case "1":
						if($level==25){							
							// Graduate user to level 17
							$sql="UPDATE `session` SET `level`=26 where `session_id`='".$sessionId."'";
							$db->query($sql);
							$response = "CON Lilongwe Auction Holdings\n";
							$response .= "Maize at MK5000/50Kg\n  ";
							
							$response .= "1. Enter Amount(in Kgs) to Sell\n";
	
							// Print the response onto the page so that our gateway can read it
							header('Content-type: text/plain');
							echo $response;	
						}
					break;
	
					case "2":
						if($level==25){							
							// Graduate user to level 14
							$sql4="UPDATE `session` SET `level`=30 where `session_id`='".$sessionId."'";
							$db->query($sql4);
	
							$response = "CON Lilongwe Auction Holdings\n";
							$response .= "Soya Beans at MK7000/50Kg\n  ";
							
							$response .= "1. Enter Amount(in Kgs) to Sell\n";

							// Print the response onto the page so that our gateway can read it
							header('Content-type: text/plain');
							echo $response;	
						}
					break;
	
					case "3":
						if($level==25){							
						// Graduate user to level 14
						$sql4="UPDATE `session` SET `level`=32 where `session_id`='".$sessionId."'";
						$db->query($sql4);
	
						$response = "CON Lilongwe Auction Holdings\n";
						$response .= "Ground Nuts MK10000/50Kg\n  ";
	
						$response .= "1. Enter Amount(in Kgs) to Sell\n";
							
						// Print the response onto the page so that our gateway can read it
						header('Content-type: text/plain');
						echo $response;	
						}
					break;
					

					case "4":
						if($level==25){							
							// Graduate user to level 14
							$sql4="UPDATE `session` SET `level`=15 where `session_id`='".$sessionId."'";
							$db->query($sql4);
	
							$response = "CON List of Available Markets\n";
							$response .= "Please Select One\n\n";

							$response .= "1. Zomba ADMARC Market\n";
							$response .= "2. Lilongwe Auction Holdings Market\n";
							$response .= "3. Blantyre Auction Holdings\n";
							$response .= "4. Back\n";
							$response .= "5. Main Menu\n";
	
							// Print the response onto the page so that our gateway can read it
							header('Content-type: text/plain');
							echo $response;	
						}
					break;

					case "5":
						if($level==25){							
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
						if($level==25){
							// Return user to Main Menu & Demote user's level
							$response = "CON Wrong Option, Please Try Again\n";
							$response .= "Lilongwe Auction Holdings\n";
							$response .= "List Of Products To Sale\n";
							$response .= "Please Select One\n\n";

							$response .= "1. Maize at MK5000/50Kg\n";
							$response .= "2. Soya Beans at MK7000/50Kg\n";
							$response .= "3. Ground Nuts MK10000/50Kg\n";
							$response .= "4. Back\n";
							$response .= "5. Main Menu\n";

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
		else if($level==26){
			if(!$userResponse==""){
				if($level==26){							
					// Graduate user to level 65
					$sql4="UPDATE `session` SET `level`=27 where `session_id`='".$sessionId."'";
					$db->query($sql4);

					$response = "CON Lilongwe Auction Holdings\n";
					$response .= "Maize at MK5000/50Kg\n";
							
					$response .= "You Have Entered (Amount Kgs) Up for Sell\n";

					$response .= "1. Continue\n";
					$response .= "2. Cancel\n";

					// Print the response onto the page so that our gateway can read it
					header('Content-type: text/plain');
					echo $response;	
				}				 							
			}
		}
		else if($level==27){
			if(!$userResponse==""){
				switch($userResponse){
					case "1":
						if($level==27){							
						// Graduate user to level 14
						$sql4="UPDATE `session` SET `level`=28 where `session_id`='".$sessionId."'";
						$db->query($sql4);
	
						$response = "END Lilongwe Auction Holdings\n";
						$response .= "Maize at MK5000/50Kg\n";
							
						$response .= "Booking Successful!!!\n";

						// Print the response onto the page so that our gateway can read it
						header('Content-type: text/plain');
						echo $response;	
						}
					break;
	
					case "2":
						if($level==27){							
						// Graduate user to level 71
						$sql4="UPDATE `session` SET `level`=29 where `session_id`='".$sessionId."'";
						$db->query($sql4);
	
						$response = "END Lilongwe Auction Holdings\n";
						$response .= "Maize at MK5000/50Kg\n";
							
						$response .= "Booking Cancelled by User\n";

						// Print the response onto the page so that our gateway can read it
						header('Content-type: text/plain');
						echo $response;	
						}
					break;
	
					default:
						if($level==27){
							// Return user to Main Menu & Demote user's level
							$response = "CON Wrong Option, Please Try Again\n";
							$response .= "Lilongwe Auction Holdings\n";
							$response .= "Maize at MK5000/50Kg\n";
							
							$response .= "You Have Entered (Amount Kgs) Up for Sell\n";

							$response .= "1. Continue\n";
							$response .= "2. Cancel\n";

							$sql4="UPDATE `session` SET `level`=27 where `session_id`='".$sessionId."'";
							$db->query($sql4);
	
							// Print the response onto the page so that our gateway can read it
							header('Content-type: text/plain');
							echo $response;	
						}
				}					
			}
		}
		else if($level==28){
			if(!$userResponse==""){
				
				$response = "END, Level 19\n";
				header('Content-type: text/plain');
				echo $response;	
				
			}
		}
		else if($level==29){
			if(!$userResponse==""){
				
				$response = "END, Level 20\n";
				header('Content-type: text/plain');
				echo $response;	
				
			}
		}
		else if($level==30){
			if(!$userResponse==""){
				if($level==30){							
					// Graduate user to level 65
					$sql4="UPDATE `session` SET `level`=31 where `session_id`='".$sessionId."'";
					$db->query($sql4);

					$response = "CON Lilongwe Auction Holdings\n";
					$response .= "Soya Beans at MK7000/50Kg\n";
							
					$response .= "You Have Entered (Amount Kgs) Up for Sell\n";

					$response .= "1. Continue\n";
					$response .= "2. Cancel\n";

					// Print the response onto the page so that our gateway can read it
					header('Content-type: text/plain');
					echo $response;	
				}				 							
			}
		}
		else if($level==31){
			if(!$userResponse==""){
				switch($userResponse){
					case "1":
						if($level==31){							
						// Graduate user to level 19
						$sql4="UPDATE `session` SET `level`=28 where `session_id`='".$sessionId."'";
						$db->query($sql4);
	
						$response = "END Lilongwe Auction Holdings\n";
						$response .= "Soya Beans at MK7000/50Kg\n";
							
						$response .= "Booking Successful!!!\n";

						// Print the response onto the page so that our gateway can read it
						header('Content-type: text/plain');
						echo $response;	
						}
					break;
	
					case "2":
						if($level==31){							
						// Graduate user to level 71
						$sql4="UPDATE `session` SET `level`=29 where `session_id`='".$sessionId."'";
						$db->query($sql4);
	
						$response = "END Lilongwe Auction Holdings\n";
						$response .= "Soya Beans at MK7000/50Kg\n";
							
						$response .= "Booking Cancelled by User\n";

						// Print the response onto the page so that our gateway can read it
						header('Content-type: text/plain');
						echo $response;	
						}
					break;
	
					default:
						if($level==31){
							// Return user to Main Menu & Demote user's level
							$response = "CON Wrong Option, Please Try Again\n";
							$response .= "Lilongwe Auction Holdings\n";
							$response .= "Soya Beans at MK7000/50Kg\n";
							
							$response .= "You Have Entered (Amount Kgs) Up for Sell\n";

							$response .= "1. Continue\n";
							$response .= "2. Cancel\n";

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
				if($level==32){							
					// Graduate user to level 65
					$sql4="UPDATE `session` SET `level`=33 where `session_id`='".$sessionId."'";
					$db->query($sql4);

					$response = "CON Lilongwe Auction Holdings\n";
					$response .= "Ground Nuts at MK10000/50Kg\n  ";
							
					$response .= "You Have Entered (Amount Kgs) Up for Sell\n";

					$response .= "1. Continue\n";
					$response .= "2. Cancel\n";

					// Print the response onto the page so that our gateway can read it
					header('Content-type: text/plain');
					echo $response;	
				}				 							
			}
		}
		else if($level==33){
			if(!$userResponse==""){
				switch($userResponse){
					case "1":
						if($level==33){							
						// Graduate user to level 14
						$sql4="UPDATE `session` SET `level`=28 where `session_id`='".$sessionId."'";
						$db->query($sql4);
	
						$response = "END Lilongwe Auction Holdings\n";
						$response .= "Ground Nuts at MK10000/50Kg\n";
							
						$response .= "Booking Successful!!!\n";

						// Print the response onto the page so that our gateway can read it
						header('Content-type: text/plain');
						echo $response;	
						}
					break;
	
					case "2":
						if($level==33){							
						   // Graduate user to level 71
						   $sql4="UPDATE `session` SET `level`=29 where `session_id`='".$sessionId."'";
						   $db->query($sql4);
	
						   $response = "END Lilongwe Auction Holdings\n";
						   $response .= "Ground Nuts at MK10000/50Kg\n";
							
						   $response .= "Booking Cancelled by User\n";

						   // Print the response onto the page so that our gateway can read it
						   header('Content-type: text/plain');
						   echo $response;	
						}
					break;
	
					default:
						if($level==33){
							// Return user to Main Menu & Demote user's level
							$response = "CON Wrong Option, Please Try Again\n";
							$response .= "Lilongwe Auction Holdings\n";
							$response .= "Ground Nuts at MK10000/50Kg\n";
							$response .= "You Have Entered (Amount Kgs) Up for Sell\n";

							$response .= "1. Continue\n";
							$response .= "2. Cancel\n";
      						$sql4="UPDATE `session` SET `level`=24 where `session_id`='".$sessionId."'";
							$db->query($sql4);
	  					   // Print the response onto the page so that our gateway can read it
							header('Content-type: text/plain');
							echo $response;	
						}
				}					
			}
		}
		//Markets section for Blantyre English Menu
		else if($level==34){
			if(!$userResponse==""){
				switch($userResponse){
					case "1":
						if($level==34){							
							// Graduate user to level 35
							$sql="UPDATE `session` SET `level`=35 where `session_id`='".$sessionId."'";
							$db->query($sql);
							$response = "CON Blantyre Auction Holdings\n";
							$response .= "Maize at MK5000/50Kg\n  ";
							
							$response .= "1. Enter Amount(in Kgs) to Sell\n";
	
							// Print the response onto the page so that our gateway can read it
							header('Content-type: text/plain');
							echo $response;	
						}
					break;
	
					case "2":
						if($level==34){							
							// Graduate user to level 39
							$sql4="UPDATE `session` SET `level`=39 where `session_id`='".$sessionId."'";
							$db->query($sql4);
	
							$response = "CON Blantyre Auction Holdings\n";
							$response .= "Soya Beans at MK7000/50Kg\n  ";
							
							$response .= "1. Enter Amount(in Kgs) to Sell\n";

							// Print the response onto the page so that our gateway can read it
							header('Content-type: text/plain');
							echo $response;	
						}
					break;
	
					case "3":
						if($level==34){							
						// Graduate user to level 14
						$sql4="UPDATE `session` SET `level`=41 where `session_id`='".$sessionId."'";
						$db->query($sql4);
	
						$response = "CON Blantyre Auction Holdings\n";
						$response .= "Ground Nuts MK10000/50Kg\n  ";
	
						$response .= "1. Enter Amount(in Kgs) to Sell\n";
							
						// Print the response onto the page so that our gateway can read it
						header('Content-type: text/plain');
						echo $response;	
						}
					break;
					

					case "4":
						if($level==34){							
							// Graduate user to level 14
							$sql4="UPDATE `session` SET `level`=15 where `session_id`='".$sessionId."'";
							$db->query($sql4);
	
							$response = "CON List of Available Markets\n";
							$response .= "Please Select One\n\n";

							$response .= "1. Zomba ADMARC Market\n";
							$response .= "2. Lilongwe Auction Holdings\n";
							$response .= "3. Blantyre Auction Holdings\n";
							$response .= "4. Back\n";
							$response .= "5. Main Menu\n";
	
							// Print the response onto the page so that our gateway can read it
							header('Content-type: text/plain');
							echo $response;	
						}
					break;

					case "5":
						if($level==34){							
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
						if($level==34){
							// Return user to Main Menu & Demote user's level
							$response = "CON Wrong Option, Please Try Again\n";
							$response .= "Blantyre Auction Holdings\n";
							$response .= "List Of Products To Sale\n";
							$response .= "Please Select One\n\n";

							$response .= "1. Maize at MK5000/50Kg\n";
							$response .= "2. Soya Beans at MK7000/50Kg\n";
							$response .= "3. Ground Nuts MK10000/50Kg\n";
							$response .= "4. Back\n";
							$response .= "5. Main Menu\n";

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
		else if($level==35){
			if(!$userResponse==""){
				if($level==35){							
					// Graduate user to level 65
					$sql4="UPDATE `session` SET `level`=36 where `session_id`='".$sessionId."'";
					$db->query($sql4);

					$response = "CON Blantyre Auction Holdings\n";
					$response .= "Maize at MK5000/50Kg\n";
							
					$response .= "You Have Entered (Amount Kgs) Up for Sell\n";

					$response .= "1. Continue\n";
					$response .= "2. Cancel\n";

					// Print the response onto the page so that our gateway can read it
					header('Content-type: text/plain');
					echo $response;	
				}				 							
			}
		}
		else if($level==36){
			if(!$userResponse==""){
				switch($userResponse){
					case "1":
						if($level==36){							
						// Graduate user to level 14
						$sql4="UPDATE `session` SET `level`=37 where `session_id`='".$sessionId."'";
						$db->query($sql4);
	
						$response = "END Blantyre Auction Holdings\n";
						$response .= "Maize at MK5000/50Kg\n";
							
						$response .= "Booking Successful!!!\n";

						// Print the response onto the page so that our gateway can read it
						header('Content-type: text/plain');
						echo $response;	
						}
					break;
	
					case "2":
						if($level==36){							
						// Graduate user to level 71
						$sql4="UPDATE `session` SET `level`=38 where `session_id`='".$sessionId."'";
						$db->query($sql4);
	
						$response = "END Blantyre Auction Holdings\n";
						$response .= "Maize at MK5000/50Kg\n\n";
							
						$response .= "Booking Cancelled by User\n";

						// Print the response onto the page so that our gateway can read it
						header('Content-type: text/plain');
						echo $response;	
						}
					break;
	
					default:
						if($level==36){
							// Return user to Main Menu & Demote user's level
							$response = "CON Wrong Option, Please Try Again\n";
							$response .= "Blantyre Auction Holdings\n";
							$response .= "Maize at MK5000/50Kg\n\n";
							
							$response .= "You Have Entered (Amount Kgs) Up for Sell\n\n";

							$response .= "1. Continue\n";
							$response .= "2. Cancel\n";

							$sql4="UPDATE `session` SET `level`=27 where `session_id`='".$sessionId."'";
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
				
				$response = "END, Level 37\n";
				header('Content-type: text/plain');
				echo $response;	
				
			}
		}
		else if($level==38){
			if(!$userResponse==""){
				
				$response = "END, Level 38\n";
				header('Content-type: text/plain');
				echo $response;	
				
			}
		}
		else if($level==39){
			if(!$userResponse==""){
				if($level==39){							
					// Graduate user to level 65
					$sql4="UPDATE `session` SET `level`=40 where `session_id`='".$sessionId."'";
					$db->query($sql4);

					$response = "CON Blantyre Auction Holdings\n";
					$response .= "Soya Beans at MK7000/50Kg\n";
							
					$response .= "You Have Entered (Amount Kgs) Up for Sell\n";

					$response .= "1. Continue\n";
					$response .= "2. Cancel\n";

					// Print the response onto the page so that our gateway can read it
					header('Content-type: text/plain');
					echo $response;	
				}				 							
			}
		}
		else if($level==40){
			if(!$userResponse==""){
				switch($userResponse){
					case "1":
						if($level==40){							
						// Graduate user to level 19
						$sql4="UPDATE `session` SET `level`=37 where `session_id`='".$sessionId."'";
						$db->query($sql4);
	
						$response = "END Blantyre Auction Holdings\n";
						$response .= "Soya Beans at MK7000/50Kg\n";
							
						$response .= "Booking Successful!!!\n";

						// Print the response onto the page so that our gateway can read it
						header('Content-type: text/plain');
						echo $response;	
						}
					break;
	
					case "2":
						if($level==40){							
						// Graduate user to level 71
						$sql4="UPDATE `session` SET `level`=38 where `session_id`='".$sessionId."'";
						$db->query($sql4);
	
						$response = "END Blantyre Auction Holdings\n";
						$response .= "Soya Beans at MK7000/50Kg\n";
							
						$response .= "Booking Cancelled by User\n";

						// Print the response onto the page so that our gateway can read it
						header('Content-type: text/plain');
						echo $response;	
						}
					break;
	
					default:
						if($level==40){
							// Return user to Main Menu & Demote user's level
							$response = "CON Wrong Option, Please Try Again\n";
							$response .= "Blantyre Auction Holdings\n";
							$response .= "Soya Beans at MK7000/50Kg\n";
							
							$response .= "You Have Entered (Amount Kgs) Up for Sell\n";

							$response .= "1. Continue\n";
							$response .= "2. Cancel\n";

							$sql4="UPDATE `session` SET `level`=31 where `session_id`='".$sessionId."'";
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
				if($level==41){							
					// Graduate user to level 65
					$sql4="UPDATE `session` SET `level`=42 where `session_id`='".$sessionId."'";
					$db->query($sql4);

					$response = "CON Blantyre Auction Holdings\n";
					$response .= "Ground Nuts at MK10000/50Kg\n  ";
							
					$response .= "You Have Entered (Amount Kgs) Up for Sell\n";

					$response .= "1. Continue\n";
					$response .= "2. Cancel\n";

					// Print the response onto the page so that our gateway can read it
					header('Content-type: text/plain');
					echo $response;	
				}				 							
			}
		}
		else if($level==42){
			if(!$userResponse==""){
				switch($userResponse){
					case "1":
						if($level==42){							
						// Graduate user to level 14
						$sql4="UPDATE `session` SET `level`=37 where `session_id`='".$sessionId."'";
						$db->query($sql4);
	
						$response = "END Blantyre Auction Holdings\n";
						$response .= "Ground Nuts at MK10000/50Kg\n  ";
							
						$response .= "Booking Successful!!!\n";

						// Print the response onto the page so that our gateway can read it
						header('Content-type: text/plain');
						echo $response;	
						}
					break;
	
					case "2":
						if($level==42){							
						   // Graduate user to level 71
						   $sql4="UPDATE `session` SET `level`=38 where `session_id`='".$sessionId."'";
						   $db->query($sql4);
	
						   $response = "END Blantyre Auction Holdings\n";
						   $response .= "Ground Nuts at MK10000/50Kg\n";
							
						   $response .= "Booking Cancelled by User\n";

						   // Print the response onto the page so that our gateway can read it
						   header('Content-type: text/plain');
						   echo $response;	
						}
					break;
	
					default:
						if($level==42){
							// Return user to Main Menu & Demote user's level
							$response = "CON Wrong Option, Please Try Again\n";
							$response .= "Blantyre Auction Holdings\n";
							$response .= "Ground Nuts at MK10000/50Kg\n";
							
							$response .= "You Have Entered (Amount Kgs) Up for Sell\n";

							$response .= "1. Continue\n";
							$response .= "2. Cancel\n";
      						$sql4="UPDATE `session` SET `level`=24 where `session_id`='".$sessionId."'";
							$db->query($sql4);
	  					   // Print the response onto the page so that our gateway can read it
							header('Content-type: text/plain');
							echo $response;	
						}
				}					
			}
		}
		//Advisors Section English Menu
		else if($level==43){
			if(!$userResponse==""){
				switch($userResponse){
					case "1":
						if($level==43){							
						// Graduate user to level 44
						$sql4="UPDATE `session` SET `level`=44 where `session_id`='".$sessionId."'";
						$db->query($sql4);

						$response = "CON Crop Production Advisors\n";
						$response .= "List of Advisors\n";
						$response .= "Select Advisor for His/Her Details\n\n";
						
						$response .= "1. Mr. Rabson Sayenda\n";
						$response .= "2. Mr. Kondwani Lusinje\n";
						$response .= "3. Dr. Nelson Kumbani\n";
						$response .= "4. Mr. Fredson Likhunya\n";

						$response .= "5. Back\n";
						$response .= "6. Main Menu\n"; 

						// Print the response onto the page so that our gateway can read it
						header('Content-type: text/plain');
						echo $response;	
						}
					break;
					case "2":
						if($level==43){
						// Graduate user to level 14
						$sql4="UPDATE `session` SET `level`=46 where `session_id`='".$sessionId."'";
						$db->query($sql4);

						$response = "CON Animal Husbandly Advisors\n";
						$response .= "List of Advisors\n";
						$response .= "Select Advisor for His/Her Details\n\n";
						
						$response .= "1. Mr. Rabson Sayenda\n";
						$response .= "2. Mr. Kondwani Lusinje\n";
						$response .= "3. Dr. Nelson Kumbani\n";
						$response .= "4. Mr. Fredson Likhunya\n";

						$response .= "5. Back\n";
						$response .= "6. Main Menu\n"; 


						// Print the response onto the page so that our gateway can read it
						header('Content-type: text/plain');
						echo $response;								
						}
					break;
					case "3":
						if($level==43){
						// Graduate user to level 14
						$sql4="UPDATE `session` SET `level`=48 where `session_id`='".$sessionId."'";
						$db->query($sql4);

						$response = "CON Poultry Advisors\n";
						$response .= "List of Advisors\n";
						$response .= "Select Advisor for His/Her Details\n\n";
						
						$response .= "1. Mr. Rabson Sayenda\n";
						$response .= "2. Mr. Kondwani Lusinje\n";
						$response .= "3. Dr. Nelson Kumbani\n";
						$response .= "4. Mr. Fredson Likhunya\n";

						$response .= "5. Back\n";
						$response .= "6. Main Menu\n"; 


						// Print the response onto the page so that our gateway can read it
						header('Content-type: text/plain');
						echo $response;								
						}
					break;
					case "4":
						if($level==43){	
						   // Graduate user to level 1
						   $sql4="UPDATE `session` SET `level`=2 where `session_id`='".$sessionId."'";
						   $db->query($sql4);
						   //Menu 2  English
						   //Serve English services menu
						   $response = "Welcome To Farmers World\n";
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
						if($level==43){
							// Return user to Main Menu & Demote user's level
							$response = "CON Wrong Option\n";
							$response .= "Enter Category of Advisor You Desire\n";
							$response .= "Farm Categories Of Advisors\n\n";

							$response .= "1. Crop Production\n";
							$response .= "2. Animal Husbandly\n";
							$response .= "3. Poultry Farming\n";

							$response .= "4. Back\n";
							$response .= "5. Main Menu\n";
	

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
		//Advisors of Crop Productions 
		else if($level==44){
			if(!$userResponse==""){
				
				switch($userResponse){
					case "1":
						if($level==44){							
						// Graduate user to level 45
						$sql4="UPDATE `session` SET `level`=45 where `session_id`='".$sessionId."'";
						$db->query($sql4);

						$response = "END Crop Production Advisors\n";
						$response .= "Details Of Selected Advisor\n\n";
						
						$response .= "Name 			\t: Mr. Rabson Sayenda\n"; //Should come from DataBase 
						$response .= "Cell Number 	\t: 265886799210\n";
						$response .= "Working Hours 	\t: 8am - 6pm\n\n";
						
						$response .= "1. Back\n";
						$response .= "2. Main Menu\n"; 

						// Print the response onto the page so that our gateway can read it
						header('Content-type: text/plain');
						echo $response;	
						}
					break;
					
					case "2":
						if($level==44){
						// Graduate user to level 45
						$sql4="UPDATE `session` SET `level`=45 where `session_id`='".$sessionId."'";
						$db->query($sql4);

						$response = "END Crop Production Advisors\n";
						$response .= "Details Of Selected Advisor\n\n";
						
						$response .= "Name 			\t: Mr. Kondwani Lusinje\n"; //Should come from DataBase 
						$response .= "Cell Number 	\t: 265886788210\n";
						$response .= "Working Hours 	\t: 8am - 6pm\n\n";
						
						$response .= "1. Back\n";
						$response .= "2. Main Menu\n"; 



						// Print the response onto the page so that our gateway can read it
						header('Content-type: text/plain');
						echo $response;								
						}
					break;

					case "3":
						if($level==44){
						// Graduate user to level 45
						$sql4="UPDATE `session` SET `level`=45 where `session_id`='".$sessionId."'";
						$db->query($sql4);

						$response = "END Crop Production Advisors\n";
						$response .= "Details Of Selected Advisor\n\n";
						
						$response .= "Name 			\t: Mr. Nelson kumbani\n"; //Should come from DataBase 
						$response .= "Cell Number 	\t: 265882897073\n";
						$response .= "Working Hours 	\t: 8am - 6pm\n\n";
						
						$response .= "1. Back\n";
						$response .= "2. Main Menu\n"; 

						// Print the response onto the page so that our gateway can read it
						header('Content-type: text/plain');
						echo $response;								
						}
					break;

					case "4":
						if($level==44){
						// Graduate user to level 45
						$sql4="UPDATE `session` SET `level`=45 where `session_id`='".$sessionId."'";
						$db->query($sql4);

						$response = "END Crop Production Advisors\n";
						$response .= "Details Of Selected Advisor\n\n";
						
						$response .= "Name 			\t: Mr. Fredson Likhunya\n"; //Should come from DataBase 
						$response .= "Cell Number 	\t: 265882897073\n";
						$response .= "Working Hours 	\t: 8am - 6pm\n\n";
						
						$response .= "1. Back\n";
						$response .= "2. Main Menu\n"; 

						// Print the response onto the page so that our gateway can read it
						header('Content-type: text/plain');
						echo $response;								
						}
					break;

					case "5":
						if($level==44){							
							// Graduate user to level 14
							$sql4="UPDATE `session` SET `level`=43 where `session_id`='".$sessionId."'";
							$db->query($sql4);
	
							$response = "Select A Farm Category Please\n";	
							$response .= "Farm Categories Of Advisors\n\n";

							$response .= "1. Crop Production\n";
							$response .= "2. Animal Husbandly\n";
							$response .= "3. Poultry Farming\n";
							$response .= "4. Back\n";
							$response .= "5. Main Menu\n";
	
							// Print the response onto the page so that our gateway can read it
							header('Content-type: text/plain');
							echo $response;	
						}
					break;

					case "6":
						if($level==44){							
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
						if($level==44){
							// Return user to Main Menu & Demote user's level
							$response = "CON Wrong Option\n";
							$response .= "List of Crop Production Advisor\n";
							$response .= "Select Advisor for His/Her Details\n\n";
						
							$response .= "1. Mr. Rabson Sayenda\n";
							$response .= "2. Mr. Kondwani Lusinje\n";
							$response .= "3. Dr. Nelson Kumbani\n";
							$response .= "4. Mr. Fredson Likhunya\n";
							$response .= "5. Back\n";
							$response .= "6. Main Menu\n"; 
	

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
				switch($userResponse){
					case "1":
						if($level==45){							
							// Graduate user to level 14
							$sql4="UPDATE `session` SET `level`=44 where `session_id`='".$sessionId."'";
							$db->query($sql4);

							$response = "CON Crop Production Advisors\n";
							$response .= "List of Advisors\n";
							$response .= "Select Advisor for His/Her Details\n\n";
						
							$response .= "1. Mr. Rabson Sayenda\n";
							$response .= "2. Mr. Kondwani Lusinje\n";
							$response .= "3. Dr. Nelson Kumbani\n";
							$response .= "4. Mr. Fredson Likhunya\n";
							$response .= "5. Back\n";
							$response .= "6. Main Menu\n"; 

							// Print the response onto the page so that our gateway can read it
							header('Content-type: text/plain');
							echo $response;	
						}
					break;

					case "2":   			// if the choice is 2 the user go to English version
						if($level==45){
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
						if($level==45){
							
							$response = "END Wrong Option, Try Again\n";

							// Print the response onto the page so that our gateway can read it
							header('Content-type: text/plain');
							echo $response;	
						}

				} 
			}
		}
		//Advisors of Animal HUsbandly 
		else if($level==46){
			if(!$userResponse==""){
				
				switch($userResponse){
					case "1":
						if($level==46){							
						// Graduate user to level 45
						$sql4="UPDATE `session` SET `level`=47 where `session_id`='".$sessionId."'";
						$db->query($sql4);

						$response = "CON Animal Husbandly Advisors\n";
						$response .= "Details Of Selected Advisor\n\n";
						
						$response .= "Name 			\t: Mr. Rabson Sayenda\n"; //Should come from DataBase 
						$response .= "Cell Number 	\t: 265886799210\n";
						$response .= "Working Hours 	\t: 8am - 6pm\n\n";
						
						$response .= "1. Back\n";
						$response .= "2. Main Menu\n"; 

						// Print the response onto the page so that our gateway can read it
						header('Content-type: text/plain');
						echo $response;	
						}
					break;
					
					case "2":
						if($level==46){
						// Graduate user to level 45
						$sql4="UPDATE `session` SET `level`=47 where `session_id`='".$sessionId."'";
						$db->query($sql4);

						$response = "END Animal Husbandly Advisors\n";
						$response .= "Details Of Selected Advisor\n\n";
						
						$response .= "Name 			\t: Mr. Kondwani Lusinje\n"; //Should come from DataBase 
						$response .= "Cell Number 	\t: 265886788210\n";
						$response .= "Working Hours 	\t: 8am - 6pm\n\n";
						
						$response .= "1. Back\n";
						$response .= "2. Main Menu\n"; 

						// Print the response onto the page so that our gateway can read it
						header('Content-type: text/plain');
						echo $response;								
						}
					break;

					case "3":
						if($level==46){
						// Graduate user to level 45
						$sql4="UPDATE `session` SET `level`=47 where `session_id`='".$sessionId."'";
						$db->query($sql4);

						$response = "END Animal Husbandly Advisors\n";
						$response .= "Details Of Selected Advisor\n\n";
						
						$response .= "Name 			\t: Mr. Nelson kumbani\n"; //Should come from DataBase 
						$response .= "Cell Number 	\t: 265882897073\n";
						$response .= "Working Hours 	\t: 8am - 6pm\n\n";
						
						$response .= "1. Back\n";
						$response .= "2. Main Menu\n"; 

						// Print the response onto the page so that our gateway can read it
						header('Content-type: text/plain');
						echo $response;								
						}
					break;

					case "4":
						if($level==46){
						// Graduate user to level 45
						$sql4="UPDATE `session` SET `level`=47 where `session_id`='".$sessionId."'";
						$db->query($sql4);

						$response = "END Animal Husbandly Advisors\n";
						$response .= "Details Of Selected Advisor\n\n";
						
						$response .= "Name 			\t: Mr. Fredson Likhunya\n"; //Should come from DataBase 
						$response .= "Cell Number 	\t: 265882897073\n";
						$response .= "Working Hours 	\t: 8am - 6pm\n\n";
						
						$response .= "1. Back\n";
						$response .= "2. Main Menu\n"; 

						// Print the response onto the page so that our gateway can read it
						header('Content-type: text/plain');
						echo $response;								
						}
					break;

					case "5":
						if($level==46){							
							// Graduate user to level 14
							$sql4="UPDATE `session` SET `level`=43 where `session_id`='".$sessionId."'";
							$db->query($sql4);
	
							$response = "Select A Farm Category Please\n";	
							$response .= "Farm Categories Of Advisors\n\n";
							$response .= "1. Crop Production\n";
							$response .= "2. Animal Husbandly\n";
							$response .= "3. Poultry Farming\n";
							$response .= "4. Back\n";
							$response .= "5. Main Menu\n";
	
							// Print the response onto the page so that our gateway can read it
							header('Content-type: text/plain');
							echo $response;	
						}
					break;

					case "6":
						if($level==46){							
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
						if($level==46){
							// Return user to Main Menu & Demote user's level
							$response = "CON Wrong Option\n";
							$response .= "List of Crop Production Advisor\n";
							$response .= "Select Advisor for His/Her Details\n\n";
						
							$response .= "1. Mr. Rabson Sayenda\n";
							$response .= "2. Mr. Kondwani Lusinje\n";
							$response .= "3. Dr. Nelson Kumbani\n";
							$response .= "4. Mr. Fredson Likhunya\n";
							$response .= "5. Back\n";
							$response .= "6. Main Menu\n"; 
	

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
				switch($userResponse){
					case "1":
						if($level==47){							
							// Graduate user to level 14
							$sql4="UPDATE `session` SET `level`=46 where `session_id`='".$sessionId."'";
							$db->query($sql4);

							$response = "CON Animal Husbandly Advisors\n";
							$response .= "List of Advisors\n";
							$response .= "Select Advisor for His/Her Details\n\n";
						
							$response .= "1. Mr. Rabson Sayenda\n";
							$response .= "2. Mr. Kondwani Lusinje\n";
							$response .= "3. Dr. Nelson Kumbani\n";
							$response .= "4. Mr. Fredson Likhunya\n";
							$response .= "5. Back\n";
							$response .= "6. Main Menu\n"; 

							// Print the response onto the page so that our gateway can read it
							header('Content-type: text/plain');
							echo $response;	
						}
					break;

					case "2":   			// if the choice is 2 the user go to English version
						if($level==47){
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
						if($level==47){
							
							$response = "END Wrong Option, Try Again\n";

							// Print the response onto the page so that our gateway can read it
							header('Content-type: text/plain');
							echo $response;	
						}

				} 
			}
		}
		//Advisors of Poultry Farming
		else if($level==48){
			if(!$userResponse==""){
				
				switch($userResponse){
					case "1":
						if($level==48){							
						// Graduate user to level 45
						$sql4="UPDATE `session` SET `level`=49 where `session_id`='".$sessionId."'";
						$db->query($sql4);

						$response = "CON Poultry Framing Advisors\n";
						$response .= "Details Of Selected Advisor\n\n";
						
						$response .= "Name 			\t: Mr. Rabson Sayenda\n"; //Should come from DataBase 
						$response .= "Cell Number 	\t: 265886799210\n";
						$response .= "Working Hours 	\t: 8am - 6pm\n\n";
						
						$response .= "1. Back\n";
						$response .= "2. Main Menu\n"; 

						// Print the response onto the page so that our gateway can read it
						header('Content-type: text/plain');
						echo $response;	
						}
					break;
					
					case "2":
						if($level==48){
						// Graduate user to level 45
						$sql4="UPDATE `session` SET `level`=49 where `session_id`='".$sessionId."'";
						$db->query($sql4);

						$response = "END Poultry Framing Advisors\n";
						$response .= "Details Of Selected Advisor\n\n";
						
						$response .= "Name 			\t: Mr. Kondwani Lusinje\n"; //Should come from DataBase 
						$response .= "Cell Number 	\t: 265886788210\n";
						$response .= "Working Hours 	\t: 8am - 6pm\n\n";
						
						$response .= "1. Back\n";
						$response .= "2. Main Menu\n"; 

						// Print the response onto the page so that our gateway can read it
						header('Content-type: text/plain');
						echo $response;								
						}
					break;

					case "3":
						if($level==48){
						// Graduate user to level 45
						$sql4="UPDATE `session` SET `level`=49 where `session_id`='".$sessionId."'";
						$db->query($sql4);

						$response = "END Poultry Framing Advisors\n";
						$response .= "Details Of Selected Advisor\n\n";
						
						$response .= "Name 			\t: Mr. Nelson kumbani\n"; //Should come from DataBase 
						$response .= "Cell Number 	\t: 265882897073\n";
						$response .= "Working Hours 	\t: 8am - 6pm\n\n";
						
						$response .= "1. Back\n";
						$response .= "2. Main Menu\n"; 

						// Print the response onto the page so that our gateway can read it
						header('Content-type: text/plain');
						echo $response;								
						}
					break;

					case "4":
						if($level==48){
						// Graduate user to level 45
						$sql4="UPDATE `session` SET `level`=49 where `session_id`='".$sessionId."'";
						$db->query($sql4);

						$response = "END Poultry Framing Advisors\n";
						$response .= "Details Of Selected Advisor\n\n";
						
						$response .= "Name 			\t: Mr. Fredson Likhunya\n"; //Should come from DataBase 
						$response .= "Cell Number 	\t: 265882897073\n";
						$response .= "Working Hours 	\t: 8am - 6pm\n\n";
						
						$response .= "1. Back\n";
						$response .= "2. Main Menu\n"; 

						// Print the response onto the page so that our gateway can read it
						header('Content-type: text/plain');
						echo $response;								
						}
					break;

					case "5":
						if($level==48){							
							// Graduate user to level 14
							$sql4="UPDATE `session` SET `level`=43 where `session_id`='".$sessionId."'";
							$db->query($sql4);
	
							$response = "Select A Farm Category Please\n";	
							$response .= "Farm Categories Of Advisors\n\n";
							$response .= "1. Crop Production\n";
							$response .= "2. Animal Husbandly\n";
							$response .= "3. Poultry Farming\n";
							$response .= "4. Back\n";
							$response .= "5. Main Menu\n";
	
							// Print the response onto the page so that our gateway can read it
							header('Content-type: text/plain');
							echo $response;	
						}
					break;

					case "6":
						if($level==48){							
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
						if($level==48){
							// Return user to Main Menu & Demote user's level
							$response = "CON Wrong Option\n";
							$response .= "List of Poultry Farming Advisor\n";
							$response .= "Select Advisor for His/Her Details\n\n";
						
							$response .= "1. Mr. Rabson Sayenda\n";
							$response .= "2. Mr. Kondwani Lusinje\n";
							$response .= "3. Dr. Nelson Kumbani\n";
							$response .= "4. Mr. Fredson Likhunya\n";
							$response .= "5. Back\n";
							$response .= "6. Main Menu\n"; 
	

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
		else if($level==49){
			if(!$userResponse==""){
				switch($userResponse){
					case "1":
						if($level==49){							
							// Graduate user to level 14
							$sql4="UPDATE `session` SET `level`=48 where `session_id`='".$sessionId."'";
							$db->query($sql4);

							$response = "CON Poultry Farming Advisors\n";
							$response .= "List of Advisors\n";
							$response .= "Select Advisor for His/Her Details\n\n";
						
							$response .= "1. Mr. Rabson Sayenda\n";
							$response .= "2. Mr. Kondwani Lusinje\n";
							$response .= "3. Dr. Nelson Kumbani\n";
							$response .= "4. Mr. Fredson Likhunya\n";
							$response .= "5. Back\n";
							$response .= "6. Main Menu\n"; 

							// Print the response onto the page so that our gateway can read it
							header('Content-type: text/plain');
							echo $response;	
						}
					break;

					case "2":   			// if the choice is 2 the user go to English version
						if($level==49){
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
						if($level==49){
							
							$response = "END Wrong Option, Try Again\n";

							// Print the response onto the page so that our gateway can read it
							header('Content-type: text/plain');
							echo $response;	
						}
				} 
			}
		}
		//Farm Management Menu
		else if($level==50){
			if(!$userResponse==""){
				switch($userResponse){
					case "1":
						if($level==50){							
						// Graduate user to level 51
						$sql4="UPDATE `session` SET `level`=51 where `session_id`='".$sessionId."'";
						$db->query($sql4);
						
						$response = "CON  Farm Management Implementation\n";
						$response .= "Maize\n";
						$response .= "Farm Calculatins\n\n";

						$response .= "1. Enter Amount Of Maize to Produce{KGs}\n";
						$response .= "2. Back\n";
						$response .= "3. Main Menu\n";
						
						// Print the response onto the page so that our gateway can read it
						header('Content-type: text/plain');
						echo $response;	
						}
					break;

					case "2":
						if($level==50){							
						// Graduate user to level 53
						$sql4="UPDATE `session` SET `level`=53 where `session_id`='".$sessionId."'";
						$db->query($sql4);
						
						$response = "CON  Farm Management Implementation\n";
						$response .= "Cotton\n";
						$response .= "Farm Calculatins\n\n";

						$response .= "1. Enter Amount Of Cotton to Produce{KGs}\n";
						$response .= "2. Back\n";
						$response .= "3. Main Menu\n";
						
						// Print the response onto the page so that our gateway can read it
						header('Content-type: text/plain');
						echo $response;	
						}
					break;

					case "3":
						if($level==50){							
						// Graduate user to level 55
						$sql4="UPDATE `session` SET `level`=55 where `session_id`='".$sessionId."'";
						$db->query($sql4);
						
						$response = "CON  Farm Management Implementation\n";
						$response .= "Tobbaco\n";
						$response .= "Farm Calculatins\n\n";

						$response .= "1. Enter Amount Of Tobbaco to Produce{KGs}\n";
						$response .= "2. Back\n";
						$response .= "3. Main Menu\n";
						
						// Print the response onto the page so that our gateway can read it
						header('Content-type: text/plain');
						echo $response;	
						}
					break;

					case "4":
						if($level==50){							
						// Graduate user to level 57
						$sql4="UPDATE `session` SET `level`=57 where `session_id`='".$sessionId."'";
						$db->query($sql4);
						
						$response = "CON  Farm Management Implementation\n";
						$response = "Soya Beans\n";
						$response .= "Farm Calculatins\n\n";

						$response .= "1. Enter Amount Of Soya Beans to Produce{KGs}\n";
						$response .= "2. Back\n";
						$response .= "3. Main Menu\n";
						
						// Print the response onto the page so that our gateway can read it
						header('Content-type: text/plain');
						echo $response;	
						}
					break;

					case "5":
						if($level==50){							
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
						if($level==50){
							// Return user to Main Menu & Demote user's level
							$response = "CON Wrong Option\n";
							$response .= "Farm Calculatins\n";
							$response .= "Select Crop To Be Produced\n\n";

							$response .= "1. Maize\n";
							$response .= "2. Cotton\n";
							$response .= "3. Tobbaco\n";
							$response .= "4. Soya Beans\n";
							$response .= "5. Main Menu\n";
														
							//update the level to 0 so that the session should start at level 1
							$sql4="UPDATE `session` SET `level`=50 where `session_id`='".$sessionId."'";
							$db->query($sql4);

							// Print the response onto the page so that our gateway can read it
							header('Content-type: text/plain');
							echo $response;	
						}
				}
			}
		}
		//Maize Menu
		else if($level==51){
			if(!$userResponse==""){
				switch($userResponse){
					case "1":
						if($level==51){							
						// Graduate user to level 14
						$sql4="UPDATE `session` SET `level`=52 where `session_id`='".$sessionId."'";
						$db->query($sql4);

						$response = "END  Farm Management Implementation\n";
						$response .= "Maize\n";
						$response .= "Farm Calculatins\n\n";

						$response .= "You have chosen to Produce {Amount}Kgs of Maize.\nRequirements to produce that amount\nwill be sent you via SMS soon.\nank you for using our servicies\n\n";

						$response .= "1. Main Menu\n";

						// Print the response onto the page so that our gateway can read it
						header('Content-type: text/plain');
						echo $response;	
						}
					break;

					case "2":
						if($level==51){							
							// Graduate user to level 14
							$sql4="UPDATE `session` SET `level`=50 where `session_id`='".$sessionId."'";
							$db->query($sql4);
	
							$response = "CON Wrong Option\n";
							$response .= "Farm Calculations\n";
							$response .= "Select Crop To Be Produced\n\n";

							$response .= "1. Maize\n";
							$response .= "2. Cotton\n";
							$response .= "3. Tobbaco\n";
							$response .= "4. Soya Beans\n";
							$response .= "5. Main Menu\n";
	
							// Print the response onto the page so that our gateway can read it
							header('Content-type: text/plain');
							echo $response;	
						}
					break;

					case "3":
						if($level==51){							
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
						if($level==51){
							// Return user to Main Menu & Demote user's level
							$response = "END Wrong Option\n";
							$response .= "Please Try Again.\n";
														
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
				switch($userResponse){
					case "1":
						if($level==52){							
							// Graduate user to level 14
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
						if($level==52){
							// Return user to Main Menu & Demote user's level
							$response = "CON Wrong Option\n";
							$response = "Please Choose A Correct Option\n";
														
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
		//Cotton Menu
		else if($level==53){
			if(!$userResponse==""){
				switch($userResponse){
					case "1":
						if($level==53){							
						// Graduate user to level 14
						$sql4="UPDATE `session` SET `level`=54 where `session_id`='".$sessionId."'";
						$db->query($sql4);

						$response = "END  Farm Management Implementation\n";
						$response .= "Cotton\n";
						$response .= "Farm Calculatins\n\n";

						$response .= "You have chosen to Produce {Amount}Kgs of Cotton.\nRequirements to produce that amount\nwill be sent you via SMS soon.\nhank you for using our servicies\n\n";

						$response .= "1. Main Menu\n";

						// Print the response onto the page so that our gateway can read it
						header('Content-type: text/plain');
						echo $response;	
						}
					break;
					
					case "2":
						if($level==53){							
							// Graduate user to level 14
							$sql4="UPDATE `session` SET `level`=50 where `session_id`='".$sessionId."'";
							$db->query($sql4);
	
							$response = "CON Wrong Option\n";
							$response .= "Farm Calculations\n";
							$response .= "Select Crop To Be Produced\n\n";
							
							$response .= "1. Maize\n";
							$response .= "2. Cotton\n";
							$response .= "3. Tobbaco\n";
							$response .= "4. Soya Beans\n";
							$response .= "5. Main Menu\n";
	
							// Print the response onto the page so that our gateway can read it
							header('Content-type: text/plain');
							echo $response;	
						}
					break;

					case "3":
						if($level==53){							
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
						if($level==53){
							// Return user to Main Menu & Demote user's level
							$response = "END Wrong Option\n";
							$response .= "Please Try Again\n";
														
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
		else if($level==54){
			if(!$userResponse==""){
				switch($userResponse){
					case "1":
						if($level==54){							
							// Graduate user to level 14
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
						if($level==54){
							// Return user to Main Menu & Demote user's level
							$response = "END Wrong Option\n";
							$response = "Please Try Again.\n";
														
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
		//Tobbaco Menu
		else if($level==55){
			if(!$userResponse==""){
				switch($userResponse){
					case "1":
						if($level==55){							
						// Graduate user to level 55
						$sql4="UPDATE `session` SET `level`=56 where `session_id`='".$sessionId."'";
						$db->query($sql4);

						$response = "END  Farm Management Implementation\n";
						$response .= "Tobbaco\n";
						$response .= "Farm Calculatins\n\n";

						$response .= "You have chosen to Produce {Amount}Kgs of Tobbaco.\nRequirements to produce that amount\nwill be sent you via SMS soon.\nvicies\n\n";

						$response .= "1. Main Menu\n";

						// Print the response onto the page so that our gateway can read it
						header('Content-type: text/plain');
						echo $response;	
						}
					break;

					case "2":
						if($level==55){							
							// Graduate user to level 50
							$sql4="UPDATE `session` SET `level`=50 where `session_id`='".$sessionId."'";
							$db->query($sql4);
	
							$response = "CON Wrong Option\n";
							$response .= "Farm Calculations\n";
							$response .= "Select Crop To Be Produced\n\n";
							
							$response .= "1. Maize\n";
							$response .= "2. Cotton\n";
							$response .= "3. Tobbaco\n";
							$response .= "4. Soya Beans\n";
							$response .= "5. Main Menu\n";
	
							// Print the response onto the page so that our gateway can read it
							header('Content-type: text/plain');
							echo $response;	
						}
					break;

					case "3":
						if($level==55){							
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
						if($level==55){
							// Return user to Main Menu & Demote user's level
							$response = "END Wrong Option\n";
							$response .= "Please Try Again\n";
														
							//update the level to 0 so that the session should start at level 1
							$sql4="UPDATE `session` SET `level`=55 where `session_id`='".$sessionId."'";
							$db->query($sql4);

							// Print the response onto the page so that our gateway can read it
							header('Content-type: text/plain');
							echo $response;	
						}
				}
			}
		}
		else if($level==56){
			if(!$userResponse==""){
				switch($userResponse){
					case "1":
						if($level==56){							
							// Graduate user to level 14
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
						if($level==56){
							// Return user to Main Menu & Demote user's level
							$response = "END Wrong Option\n";
							$response = "Please Try Again.\n";
														
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
		//Soya Beans Menu
		else if($level==57){
			if(!$userResponse==""){
				switch($userResponse){
					case "1":
						if($level==57){							
						// Graduate user to level 58
						$sql4="UPDATE `session` SET `level`=58 where `session_id`='".$sessionId."'";
						$db->query($sql4);

						$response = "END  Farm Management Implementation\n";
						$response .= "Soya Beans\n";
						$response .= "Farm Calculatins\n\n";

						$response .= "You have chosen to Produce {Amount}Kgs of Soya Beans.\nRequirements to produce that amount\nwill be sent you via SMS soon.\nThank you for using our servicies\n\n";

						$response .= "1. Main Menu\n";

						// Print the response onto the page so that our gateway can read it
						header('Content-type: text/plain');
						echo $response;	
						}
					break;

					case "2":
						if($level==57){							
							// Graduate user to level 14
							$sql4="UPDATE `session` SET `level`=50 where `session_id`='".$sessionId."'";
							$db->query($sql4);
	
							$response = "CON Wrong Option\n";
							$response .= "Farm Calculations\n";
							$response .= "Select Crop To Be Produced\n\n";
							
							$response .= "1. Maize\n";
							$response .= "2. Cotton\n";
							$response .= "3. Tobbaco\n";
							$response .= "4. Soya Beans\n";
							$response .= "5. Main Menu\n";
	
							// Print the response onto the page so that our gateway can read it
							header('Content-type: text/plain');
							echo $response;	
						}
					break;

					case "3":
						if($level==57){							
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
						if($level==57){
							// Return user to Main Menu & Demote user's level
							$response = "END Wrong Option\n";
							$response .= "Please Try Again\n";
														
							//update the level to 0 so that the session should start at level 1
							$sql4="UPDATE `session` SET `level`=57 where `session_id`='".$sessionId."'";
							$db->query($sql4);

							// Print the response onto the page so that our gateway can read it
							header('Content-type: text/plain');
							echo $response;	
						}
				}
			}
		}
		else if($level==58){
			if(!$userResponse==""){
				switch($userResponse){
					case "1":
						if($level==58){							
							// Graduate user to level 14
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
						if($level==58){
							// Return user to Main Menu & Demote user's level
							$response = "END Wrong Option\n";
							$response = "Please Try Again.\n";
														
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
		//Notification Menu
		else if($level==59){
            if(!$userResponse==""){
                switch($userResponse){
                    case "1":
                        if($level==59){							
                        // Graduate user to level 4
                        $sql4="UPDATE `session` SET `level`=60 where `session_id`='".$sessionId."'";
                        $db->query($sql4);

                        $response = "CON Notication Menu\n";
                        $response .= "Received Notifications\n\n"; //Mauthenga
						
						      $response .= "1. Message 1\n";
                        $response .= "2. Message 2\n";
                        $response .= "3. Message 3\n";
                        $response .= "4. Back\n";
                        $response .= "5. Main Menu\n";
                        
                        
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
                        if($level==59){
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
		else if($level==60){
			if(!$userResponse==""){
				switch($userResponse){
					case "1":
						if($level==60){							
						    //Graduate user to level 5
						    $sql4="UPDATE `session` SET `level`=61 where `session_id`='".$sessionId."'";
						    $db->query($sql4);

						    $response = "CON Notification Menu\n";
							$response .= "Message 1\n\n";
							
							$response .= "Dear Sir/Madam\n\nFollowing your request on growing Tobbaco,\nThe following are the requirements needed\nto produce 2000Kgs of Tobbaco\n>20Kgs seeds\n>100Kgs Fertilizer\n>Grows Best in Warm Weather\n\n";

							$response .= "1. Back\n";
						    $response .= "2. Main Menu\n";

						    // Print the response onto the page so that our gateway can read it
						    header('Content-type: text/plain');
						    echo $response;	
						}
					break;

					case "2":
						if($level==60){							
						    //Graduate user to level  
						    $sql4="UPDATE `session` SET `level`=61 where `session_id`='".$sessionId."'";
						    $db->query($sql4);

						    $response = "CON Notification Menu\n";
							$response .= "Message 2\n\n";
							
							$response .= "Dear Sir/Madam\n\nYour request to sell 2000Kgs of\nCotton to Blantyre ADMARC has\nbeen approved, please report to the\nShops with your sales before 31st July With\nwith the assigned Order Number\n\nOrder Number: KOND123LAD\n\n";

							$response .= "1. Back\n";
						    $response .= "2. Main Menu\n";

						    // Print the response onto the page so that our gateway can read it
						    header('Content-type: text/plain');
						    echo $response;	
						}
					break;

					case "3":
						if($level==60){							
						    //Graduate user to level 61
						    $sql4="UPDATE `session` SET `level`=61 where `session_id`='".$sessionId."'";
						    $db->query($sql4);

						    $response = "CON Notification Menu\n";
							$response .= "Message 3\n\n";
							
							$response .= "Dear Sir/Madam\n\nWe are Updating our system.\nDue to this some of our service might not be available.\nWe apologise for the inconviniences this will cause.\n\n";

							$response .= "1. Back\n";
						    $response .= "2. Main Menu\n";

						    // Print the response onto the page so that our gateway can read it
						    header('Content-type: text/plain');
						    echo $response;	
					}
					break;

					case "4":   			
						if($level==60){
						//Downgrade user to level 59
							$sql4="UPDATE `session` SET `level`=59 where `session_id`='".$sessionId."'";
							$db->query($sql4);
								
							$response = "CON Farmers World Notification Section\n";
							$response .= "You Have Choosen Nofications\n\n";
							
                            $response .= "1. Recieve Nofications\n";
                            $response .= "2. Main Menu";
                            
																
							header('Content-type: text/plain');
							echo $response;	
						}
					break;
					
					case "5":
						if($level==60){	
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
						if($level==60){
							// Return user to Main Menu & Demote user's level
							$response = "CON Wrong Option, Please Try Again.\n";
							$response .= "Notication Menu\n";
                        	$response .= "Receivied Notifications\n\n"; //Mauthenga
						
							$response .= "1. Message 1\n";
                        	$response .= "2. Message 2\n";
                        	$response .= "3. Message 3\n";
                       	 	$response .= "4. Back\n";
                        	$response .= "5. Main Menu\n";

							//update the level to 0 so that the session should start at level 1
							$sql4="UPDATE `session` SET `level`=60 where `session_id`='".$sessionId."'";
							$db->query($sql4);

							// Print the response onto the page so that our gateway can read it
							header('Content-type: text/plain');
							echo $response;	
						}
				}
			}
		}
		else if($level==61){
			if(!$userResponse==""){
				switch($userResponse){
					case "1":
						if($level==61){							
							// Graduate user to level 60
							$sql4="UPDATE `session` SET `level`=60 where `session_id`='".$sessionId."'";
							$db->query($sql4);

							$response = "Notication Menu\n";
                     		$response .= "Received Notifications\n\n"; //Mauthenga
						
							$response .= "1. Message 1\n";
							$response .= "2. Message 2\n";
							$response .= "3. Message 3\n";
							$response .= "4. Back\n";
							$response .= "5. Main Menu\n";

							// Print the response onto the page so that our gateway can read it
							header('Content-type: text/plain');
							echo $response;	
						}
					break;

					case "2":   			// if the choice is 2 the user go to English version
						if($level==61){
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
						if($level==61){
							
							$response = "END Wrong Option, Try Again\n";

							// Print the response onto the page so that our gateway can read it
							header('Content-type: text/plain');
							echo $response;	
						}				
				}
			}
		}
		//My Account Menu
		else if($level==62){
			if(!$userResponse==""){
				switch($userResponse){
					case "1":
						if($level==62){							
						// Graduate user to level 14
						$sql4="UPDATE `session` SET `level`=63 where `session_id`='".$sessionId."'";
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
						$sql4="UPDATE `session` SET `level`=68 where `session_id`='".$sessionId."'";
						$db->query($sql4);

						$sql5 = "SELECT * FROM farmer WHERE phonenumber LIKE '%".$phoneNumber."%' LIMIT 1";
						$fQuery=$db->query($sql5);
						$Available=$fQuery->fetch_assoc();

						$response = "CON Check Acount Details\n";
						$response .= "My Account Details\n\n";

						$response .= "Full Name     \t: ".$Available['name']."\n";
						$response .= "Sex		    \t: ".$Available['sex']."\n";	
						$response .= "ID Number  	\t: ".$Available['id_number']."\n";
						$response .= "Phone Number  \t: ".$Available['phonenumber']."\n";	
						$response .= "Location		\t: ".$Available['location']."\n\n";

						$response .= "1. Back\n";
						$response .= "2. Main Menu\n";
						

						// Print the response onto the page so that our gateway can read it
						header('Content-type: text/plain');
						echo $response;

						}
					break;

					case "3": // the choice is 2 the user go to Chichewa version
						if($level==62){
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
						if($level==62){
							// Return user to Main Menu & Demote user's level
							$response = "CON Wrong Option\n";
							$response .= "Please Choose A Correct Option\n";
							$response .= "1. Change My Account Details\n";
							$response .= "2. Check My Account Details\n";
							$response .= "3. Main Menu\n";
							
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
		//Changing Account Name and Location
		else if($level==63){
			if(!$userResponse==""){
				switch($userResponse){
					case "1":
						if($level==63){
							
							// Graduate user to level 64
							$sql4="UPDATE `session` SET `level`=64 where `session_id`='".$sessionId."'";
							$db->query($sql4);

							$response = "CON  Account Update\n";
							$response .= "Please Enter Your New User Name\n";
						
							// Print the response onto the page so that our gateway can read it
							header('Content-type: text/plain');
							echo $response;	
						}
					break;
					case "2":
						if($level==63){
																				
							// Graduate user to level 14
							$sql4="UPDATE `session` SET `level`=66 where `session_id`='".$sessionId."'";
							$db->query($sql4);

							$response = "CON  Account Update\n";
							$response .= "Please Enter Your New Location\n";
						
							// Print the response onto the page so that our gateway can read it
							header('Content-type: text/plain');
							echo $response;	
						}
					break;
					case "3":
						if($level==63){							
							// Graduate user to level 14
							$sql4="UPDATE `session` SET `level`=62 where `session_id`='".$sessionId."'";
							$db->query($sql4);

							$response = "CON Farmers World My Acoount Section\n";
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
                        if($level==63){
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
						if($level==63){
							// Return user to Main Menu & Demote user's level
							$response = "CON Wrong Option\n";
							$response .= "Try Again To Update\n";
							$response .= "1. Change Name\n";
							$response .= "2. Change Location\n";
							$response .= "3. Back\n";
							$response .= "4. Main Menu\n";

							//update the level to 0 so that the session should start at level 1
							$sql4="UPDATE `session` SET `level`=63 where `session_id`='".$sessionId."'";
							$db->query($sql4);

							// Print the response onto the page so that our gateway can read it
							header('Content-type: text/plain');
							echo $response;	
						}
				}
			}
		}
		else if($level==64){
			if(!$userResponse==""){
				
				// Graduate user to level 64
				$sql4="UPDATE `session` SET `level`=65 where `session_id`='".$sessionId."'";
				$db->query($sql4);

				//Update User Name
				$sql4 = "UPDATE farmer SET `name`='".$userResponse."' WHERE `phonenumber` LIKE '%". $phoneNumber ."%'";
				$db->query($sql4);

				$sql5 = "SELECT `name` FROM farmer WHERE phonenumber LIKE '%".$phoneNumber."%' LIMIT 1";
				$fQuery=$db->query($sql5);
				$Available=$fQuery->fetch_assoc();

				$response = "END Account Update\n";
				$response .= "You have successfully Your User Name\n\n";

				$response .= "Your New User Name is\t: ".$Available['name']."\n\n";

				$response .= "1.Back\n";
				$response .= "2.Main Menu\n";
					
				// Print the response onto the page so that our gateway can read it
				header('Content-type: text/plain');
				echo $response;
				
			}
		}
		else if($level==65){
			if(!$userResponse==""){			//checking that that the user input is not empty
				switch ($userResponse){ 	// from this point we are using user input as a case variable
					case "1":
						if($level==65){							
						// Graduate user to level 64
						$sql4="UPDATE `session` SET `level`=63 where `session_id`='".$sessionId."'";
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
						if($level==65){
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
						if($level==65){
							$sql5 = "SELECT `name` FROM farmer WHERE phonenumber LIKE '%".$phoneNumber."%' LIMIT 1";
							$fQuery=$db->query($sql5);
							$Available=$fQuery->fetch_assoc();

							$response = "END Account Update\n";
							$response .= "You have successfully Changed Your User Name\n\n";

							$response .= "Your New User Name is\t: ".$Available['name']."\n\n";

							$response .= "1.Back\n";
							$response .= "2.Main Menu\n";
							
							//update the level to 0 so that the session should start at level 1
							$sql4="UPDATE `session` SET `level`=65 where `session_id`='".$sessionId."'";
							$db->query($sql4);
		
							// Print the response onto the page so that our gateway can read it
							header('Content-type: text/plain');
							echo $response;	
						}
				}
			}
		}
		//Changing Location
		else if($level==66){
			if(!$userResponse==""){
				
				// Graduate user to level 64
				$sql4="UPDATE `session` SET `level`=67 where `session_id`='".$sessionId."'";
				$db->query($sql4);

				//Update District Name
				$sql4 = "UPDATE farmer SET `location`='".$userResponse."' WHERE `phonenumber` LIKE '%". $phoneNumber ."%'";
				$db->query($sql4);

				//Getting the new set location from the database
				$sql5 = "SELECT `location` FROM farmer WHERE phonenumber LIKE '%".$phoneNumber."%' LIMIT 1";
				$fQuery=$db->query($sql5);
				$Available=$fQuery->fetch_assoc();

				$response = "END Account Update\n";
				$response .= "You have successfully Changed Your Location\n\n";

				$response .= "Your Location is\t: ".$Available['location']."\n\n";

				$response .= "1.Back\n";
				$response .= "2.Main Menu\n";
					
				// Print the response onto the page so that our gateway can read it
				header('Content-type: text/plain');
				echo $response;
				
			}
		}
		else if($level==67){
			if(!$userResponse==""){			//checking that that the user input is not empty
				switch ($userResponse){ 	// from this point we are using user input as a case variable
					case "1":
						if($level==67){							
						// Graduate user to level 63
						$sql4="UPDATE `session` SET `level`=63 where `session_id`='".$sessionId."'";
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
						if($level==67){
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
						if($level==67){
							$sql5 = "SELECT `location` FROM farmer WHERE phonenumber LIKE '%".$phoneNumber."%' LIMIT 1";
							$fQuery=$db->query($sql5);
							$Available=$fQuery->fetch_assoc();

							$response = "END Account Update\n";
							$response .= "You have successfully Changed Your Location\n\n";

							$response .= "Your New User Name is:\n";
							$response .= "Full Name     \t: ".$Available['location']."\n\n";

							$response .= "1.Back\n";
							$response .= "2.Main Menu\n";
							
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
		else if($level==68){
			if(!$userResponse==""){			//checking that that the user input is not empty
				switch ($userResponse){ 	// from this point we are using user input as a case variable
					case "1":   			// if the choice is 1 the user go to nglish version
						if($level==68){
							
							// Graduate user to level 2
							$sql2="UPDATE `session` SET `level`=62 where `session_id`='".$sessionId."'";
							$db->query($sql2);
							//Serve the Account Menu
							$response = "CON Farmers World My Acoount Section\n";
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
						if($level==68){
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
						if($level==68){
							// Return user to Main Menu & Demote user's level
							$response = "CON Farmers World My Acoount Section\n";
							$response .= "You Have Choosen My Account Option\n\n";
							
                            $response .= "1. Change Account Details\n";
                            $response .= "2. Check Account Details\n";
                            $response .= "3. Main Menu";
                            
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

		//Chichewa MENU STARTS HERE
		else if($level==69){
			if(!$userResponse==""){			//checking that that the user input is not empty
				switch ($userResponse){
					//Menu 2.1 	        // from this point we are using user input as a case variable
					case "1":   			// user will be here if he chooses option 1 in Chichewa menu
						if($level==69){
							// Graduate user to level 70
							$sql4="UPDATE `session` SET `level`=70 where `session_id`='".$sessionId."'";
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
						if($level==69){
							// Graduate user to level 81
							$sql4="UPDATE `session` SET `level`=81 where `session_id`='".$sessionId."'";
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
						if($level==69){
							// Graduate user to level 43
							$sql4="UPDATE `session` SET `level`=110 where `session_id`='".$sessionId."'";
							$db->query($sql4);
							
							$response = "CON Alangizi A Ku Farmers World\n";
							$response .= "Magulu A Alangizi\n\n";
	
							$response .= "1. Ulimi Wa Za Kumunda\n";
							$response .= "2. Ulimi Wa Ziweto\n";
							$response .= "3. Ulimi Wa Mbalame\n";
							$response .= "4. Kubwelera Kumayambiliro\n";
	
							// Print the response onto the page so that our gateway can read it
							header('Content-type: text/plain');
							echo $response;				
						}
					break;
					//Menu 2.4
					case "4": // user will be here if he chooses option 4 in Chichewa menu
						if($level==69){
							// Graduate user to level 7
							$sql4="UPDATE `session` SET `level`=117 where `session_id`='".$sessionId."'";
							$db->query($sql4);
							
							$response = "CON  Kusamala Zakumunda\n";
							$response .= "Kuwelengela Zakumunda\n";
							$response .= "Sankhani Mbewu Zomwe Mukufuna kukolora\n\n";
							
							$response .= "1. Chimanga\n";
							$response .= "2. Cotton\n";
							$response .= "3. Fodya\n";
							$response .= "4. Soya\n";
							$response .= "5. Kubwelera Kumayambiliro\n";
							
							header('Content-type: text/plain');
							echo $response;				
						}
					break;
					 //Menu 2.5
					 case "5": // user will be here if he chooses option 5 in Chichewa menu
						if($level==69){
							// Graduate user to level 126
							$sql4="UPDATE `session` SET `level`=126 where `session_id`='".$sessionId."'";
							$db->query($sql4);
							
							$response = "CON Gawo la Mauthenga Ku Farmers World\n";
							$response .= "Mwasankha Mauthenga\n\n";
							
							$response .= "1. Mauthenga Olandilidwa\n";
							$response .= "2. Kubwelera Kumayambiliro";
							
							header('Content-type: text/plain');
							echo $response;				
						}
					break;
					//Menu 2.6
					case "6": // user will be here if he chooses option 6 in Chichewa menu
						if($level==69){
							// Graduate user to level 128
							$sql4="UPDATE `session` SET `level`=128 where `session_id`='".$sessionId."'";
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
						if($level==69){
							// Return user to Main Menu & Demote user's level
							$response = "CON Mwasankha Polakwika, Chonde Yeselaninso\n";                                             
							//re-serve Chichewa menu in case user chooses wrong option
                     		$response = "Takulandirani Kuno Ku Farmers World\n";
							$response = "Zikomo Posankha Chichewa \n";
							$response .= "Sankhani Chomwe Mukufuna\n\n";
	
							$response .= "1. Mitsika{Kogula Katundu}\n";
							$response .= "2. Mitsika{Kogulitsa Katundu}\n";
							$response .= "3. Alangizi\n";
							$response .= "4. Kusamala Za Kumunda\n";
							$response .= "5. Mauthenga\n";
							$response .= "6. Account Yanga\n";
							
							//update the level to 0 so that the session should start at level 1
							$sql4="UPDATE `session` SET `level`=69 where `session_id`='".$sessionId."'";
							$db->query($sql4);
		
							// Print the response onto the page so that our gateway can read it
							header('Content-type: text/plain');
							echo $response;	
						}
				}
			}
		}        
		//MenU 2.X.1 START 
		//Menu 2.1.1 Chichewa Version
		//Start of Option 1of The Chichewa Menu
		else if($level==70){
			if(!$userResponse==""){
				switch($userResponse){
					case "1":
						if($level==70){							
						// Graduate user to level 4
						$sql4="UPDATE `session` SET `level`=71 where `session_id`='".$sessionId."'";
						$db->query($sql4);
	
						$response = "CON  Misika Kogula Zakumunda\n";
						$response .= "Sankhani Msika Kuti Muone Zomwe Akugulisa\n\n";
						
						$response .= "1. Zomba ADMARC, Zomba\n";
						$response .= "2. Blantyre ADMARC, Blantyre\n";
						$response .= "3. Lilongwe ADMARC, Lilongwe\n";
						$response .= "4. Kubwelera Pambuyo\n";
						$response .= "5. Kubwelera Kumayambiliro\n";
						
						
						// Print the response onto the page so that our gateway can read it
						header('Content-type: text/plain');
						echo $response;	
						}
					break;
	
					case "2":   			// if the choice is 2 the user go to Chichewa version
						if($level==70){
							// graduate user to level 69
							$sql2="UPDATE `session` SET `level`=69 where `session_id`='".$sessionId."'";
							$db->query($sql2);
							//Menu 2  Chichewa 
							//Serve Chichewa services menu
							$response = "Zikomo Posankha Chichewa \n";
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
						if($level==70){
							// Return user to Main Menu & Demote user's level
							$response = "CON Mwasankha Nambala yolakwika, Chonde Yeselaniso .\n";
							$response .= "Gawo La Misika Kogula Katundu\n";
							$response .= "Mwasankha Misika Kogula Katundu\n\n";

							$response .= "1. Misika Kogula Katundu\n";
							$response .= "2. Kubwerera Kumayambiliro";                                                    
															
							//update the level to 0 so that the session should start at level 1
							$sql4="UPDATE `session` SET `level`=70 where `session_id`='".$sessionId."'";
							$db->query($sql4);
	
							// Print the response onto the page so that our gateway can read it
							header('Content-type: text/plain');
							echo $response;	
						}
				}
			}
		}
		//MenU 2.X.1.1 START
		//Menu 2.1.1.1 Farm categories Chichewa Menu
		else if($level==71){
			if(!$userResponse==""){
				switch($userResponse){
					case "1":
						if($level==71){							
							//Graduate user to level 5
							$sql4="UPDATE `session` SET `level`=72 where `session_id`='".$sessionId."'";
							$db->query($sql4);
	
							$response = "CON Gawo La Misika Yogulisalisa Zakumunda\n";
							$response .= "Mwasankha Zomba ADMARC\n";
							$response .= "Magulu A Zomwe Amagulisa:\n\n";
	
							$response .= "1. Zolowa Kumunda\n";
							$response .= "2. Zokolora Za Kumunda\n";
							$response .= "3. Kubwelera Pa Mbuyo\n";
							$response .= "4. Kubwelera Ku Mayambiliro\n";
	
							// Print the response onto the page so that our gateway can read it
							header('Content-type: text/plain');
							echo $response;	
						}
					break;
	
					case "2":
						if($level==71){							
							//Graduate user to level  
							$sql4="UPDATE `session` SET `level`=75 where `session_id`='".$sessionId."'";
							$db->query($sql4);
	
							$response = "CON Gawo La Misika Yogulisalisa Zakumunda\n";
							$response .= "Mwasankha Blantyre ADMARC\n";
							$response .= "Magulu A Zomwe Amagulisa:\n\n";
	
							$response .= "1. Zolowa Kumunda\n";
							$response .= "2. Zokolora Za Kumunda\n";					
							$response .= "3. Kubwelera Pa Mbuyo\n";
							$response .= "4. Kubwelera Ku Mayambiliro\n";
	
							// Print the response onto the page so that our gateway can read it
							header('Content-type: text/plain');
							echo $response;	
						}
					break;
	
					case "3":
						if($level==71){							
							//Graduate user to level 
							$sql4="UPDATE `session` SET `level`=78 where `session_id`='".$sessionId."'";
							$db->query($sql4);
	
							$response = "CON Gawo La Misika Yogulisalisa Zakumunda\n";
							$response .= "Mwasankha Lilongwe ADMARC\n";
							$response .= "Magulu A Zomwe Amagulisa:\n\n";
	
							$response .= "1. Zolowa Kumunda\n";
							$response .= "2. Zokolora Za Kumunda\n";					
							$response .= "3. Kubwelera Pa Mbuyo\n";
							$response .= "4. Kubwelera Ku Mayambiliro\n";
	
							// Print the response onto the page so that our gateway can read it
							header('Content-type: text/plain');
							echo $response;	
					}
					break;
	
					case "4":   			// user will be here if he chooses option 1 in Chichewa menu
						if($level==71){
						//Downgrade user to level 70
						$sql4="UPDATE `session` SET `level`=70 where `session_id`='".$sessionId."'";
						$db->query($sql4);
	
						$response = "CON  Gawo La Misika Kogula Katundu\n";
						$response .= "Mwasankha Misika Kogula Katundu\n\n";

						$response .= "1. Wonani Misika ndi Zomwe Akugulisa\n";
						$response .= "2. Kubwerera Kumayambiliro";
																
						header('Content-type: text/plain');
						echo $response;	
						}
					break;
					
					case "5":
						if($level==71){	
							// Graduate user to level 1
							$sql4="UPDATE `session` SET `level`=69 where `session_id`='".$sessionId."'";
							$db->query($sql4);
	
							//Menu 2  Chichewa 
							//Serve Chichewa services menu
							$response = "Zikomo Posankha Chichewa \n";
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
						if($level==71){
							// Return user to Main Menu & Demote user's level
							$response = "CON  Mwasankha Nambala Yolakwika, Chonde Yeselaninso\n";
							$response .= "Misika Kogula Zakumunda\n";
							$response .= "Sankhani Msika Kuti Muone Zomwe Akugulisa\n\n";
						
							$response .= "1. Zomba ADMARC, Zomba\n";
							$response .= "2. Blantyre ADMARC, Blantyre\n";
							$response .= "3. Lilongwe ADMARC, Lilongwe\n";
							$response .= "4. Kubwelera Pambuyo\n";
							$response .= "5. Kubwelera Kumayambiliro\n";
	
							//update the level to 0 so that the session should start at level 1
							$sql4="UPDATE `session` SET `level`=71 where `session_id`='".$sessionId."'";
							$db->query($sql4);
	
							// Print the response onto the page so that our gateway can read it
							header('Content-type: text/plain');
							echo $response;	
						}
				}
			}
		}
		else if($level==72){
			if(!$userResponse==""){
				
				switch($userResponse){
					case "1":
						if($level==72){							
						// Graduate user to level 6
						$sql4="UPDATE `session` SET `level`=73 where `session_id`='".$sessionId."'";
						$db->query($sql4);
	
						$response = "Mwasankha Zolowa Kumunda ZA\n";
						$response .= "Izi Ndi Zomwe Zikugulitsidwa\n\n";
	
						$response .= "> Mbewu  Za Tomato Mk200/25g\n";
						$response .= "> CAN Fertilizer Mk7500/50kg\n";
						$response .= "> Mankhwala A Chimanga Mk2500/10L\n";
						$response .= "> Mbedza Mk1260/kg\n";
						$response .= "> Ma Nets A Nsomba Mk7500/50kg\n\n";
	
						$response .= "1. Kubwera Pambuyo\n";
						$response .= "2. Kubwelera Kumayambiliro\n";
	
						// Print the response onto the page so that our gateway can read it
						header('Content-type: text/plain');
						echo $response;	
						}
					break;
	
					case "2":
						if($level==72){							
						// Graduate user to level 
						$sql4="UPDATE `session` SET `level`=74 where `session_id`='".$sessionId."'";
						$db->query($sql4);
	
						$response = "Mwasankha Zokolora Za Kumunda ZA\n";
						$response .= "Izi Ndi Zomwe Zikugulitsidwa\n\n";
	
						$response .= "> Soya Mk7200/50kg\n";
						$response .= "> Mpunga Mk10000/50kg\n";
						$response .= "> Chimanga Mk5000/50kg\n";
						$response .= "> Chambo Mk1260/kg\n";
						$response .= "> Cotton Mk1260/50kg\n\n";
	
						$response .= "1. Kubwera Pambuyo\n";
						$response .= "2. Kubwelera Kumayambiliro\n";
	
						// Print the response onto the page so that our gateway can read it
						header('Content-type: text/plain');
						echo $response;	
						}
					break;
	
					case "3":
						if($level==72){							
						// Graduate user to level 14
						$sql4="UPDATE `session` SET `level`=71 where `session_id`='".$sessionId."'";
						$db->query($sql4);
	
						$response = "CON  Magulu A Zithu Zakumunda\n";
						$response .= "Mwasankha Wogulisa Za Kumunda Ku {Malo Omwe Mumakhala}\n";
						$response .= "Sankhani Msika Umodzi ndi kuona Zomwe Amagulisa\n\n";
	
						$response .= "1. Zomba ADMARC, Zomba\n";
						$response .= "2. Blantyre ADMARC, Blantyre\n";
						$response .= "3. Lilongwe ADMARC, Lilongwe\n";
						$response .= "4. Kubwelera Pambuyo\n";
						$response .= "5. Kubwelera Koyambilira\n";
						
						// Print the response onto the page so that our gateway can read it
						header('Content-type: text/plain');
						echo $response;	
						}
					break;
	
					case "4":   			// if the choice is 1 the user go to Chichewa version
						if($level==72){
							// graduate user to level 69
							$sql2="UPDATE `session` SET `level`=69 where `session_id`='".$sessionId."'";
							$db->query($sql2);
							
							//Menu 2  Chichewa 
							//Serve Chichewa services menu
							$response = "Zikomo Posankha Chichewa \n";
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
						if($level==72){
							// Return user to Main Menu & Demote user's level
							$response = "CON Mwasankha Nambala Yolakwika, Chonde Yeselaninso\n";
							$response .= "Mwasankha Zomba ADMARC\n";
							$response .= "Magulu A Zomwe Amagulisa:\n\n";
	
							$response .= "1. Zolowa Kumunda\n";
							$response .= "2. Zokolora Za Kumunda\n";
							$response .= "3. Kubwelera Pa Mbuyo\n";
							$response .= "4. Kubwelera Ku Mayambiliro\n";
							//update the level to 0 so that the session should start at level 1
							$sql4="UPDATE `session` SET `level`=72 where `session_id`='".$sessionId."'";
							$db->query($sql4);
	
							// Print the response onto the page so that our gateway can read it
							header('Content-type: text/plain');
							echo $response;	
						}
				}
			}
		}
		else if($level==73){ //last level of Zomba ADMARC
			if(!$userResponse==""){
				switch($userResponse){
					case "1":
						if($level==73){							
							// Graduate user to level 14
							$sql4="UPDATE `session` SET `level`=72 where `session_id`='".$sessionId."'";
							$db->query($sql4);
	
							$response = "Mwasankha Zomba ADMARC\n";
							$response .= "Magulu A Zomwe Amagulisa:\n\n";
	
							$response .= "1. Zolowa Kumunda\n";
							$response .= "2. Zokolora Za Kumunda\n";
							$response .= "3. Kubwelera Pa Mbuyo\n";
							$response .= "4. Kubwelera Ku Mayambiliro\n";
	
							// Print the response onto the page so that our gateway can read it
							header('Content-type: text/plain');
							echo $response;	
						}
					break;
	
					case "2":   			// returns the user to the main menu
						if($level==73){
							// graduate user to level 69
							$sql2="UPDATE `session` SET `level`=69 where `session_id`='".$sessionId."'";
							$db->query($sql2);
							
							//Menu 2  Chichewa 
							//Serve Chichewa services menu
							$response = "Zikomo Posankha Chichewa \n";
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
						if($level==73){
							// Return user to Main Menu & Demote user's level
							
							$response = "Mwasankha Nambala Yolakwika, Chonde Yeselaninso\n";
							
							// Print the response onto the page so that our gateway can read it
							header('Content-type: text/plain');
							echo $response;	
						}
				}		
			}
		}     
		else if($level==74){ //last level of Zomba ADMARC
			if(!$userResponse==""){
				switch($userResponse){
					case "1":
						if($level==74){							
							// Graduate user to level 14
							$sql4="UPDATE `session` SET `level`=72 where `session_id`='".$sessionId."'";
							$db->query($sql4);
	
							$response = "CON Mwasankha Zomba ADMARC\n";
							$response .= "Magulu A Zomwe Amagulisa:\n\n";
	
							$response .= "1. Zolowa Kumunda\n";
							$response .= "2. Zokolora Za Kumunda\n";
							$response .= "3. Kubwelera Pa Mbuyo\n";
							$response .= "4. Kubwelera Ku Mayambiliro\n";
	
							// Print the response onto the page so that our gateway can read it
							header('Content-type: text/plain');
							echo $response;	
						}
					break;
	
					case "2":   			// returns the user to the main menu
						if($level==74){
							// graduate user to level 69
							$sql2="UPDATE `session` SET `level`=69 where `session_id`='".$sessionId."'";
							$db->query($sql2);
							
							//Menu 2  Chichewa 
							//Serve Chichewa services menu
							$response = "Zikomo Posankha Chichewa \n";
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
						if($level==74){
							// Return user to Main Menu & Demote user's level
							
							$response = "Mwasankha Nambala Yolakwika, Chonde Yeselaninso\n";
							
							// Print the response onto the page so that our gateway can read it
							header('Content-type: text/plain');
							echo $response;	
						}
				}		
			}
		}    
		else if($level==75){
			if(!$userResponse==""){
				
				switch($userResponse){
					case "1":
						if($level==75){							
						// Graduate user to level 6
						$sql4="UPDATE `session` SET `level`=76 where `session_id`='".$sessionId."'";
						$db->query($sql4);
	
						$response = "Mwasankha Zolowa Kumunda BT\n";
						$response .= "Izi Ndi Zomwe Zikugulitsidwa\n\n";
	
						$response .= "> Mbewu  Za Tomato Mk200/25g\n";
						$response .= "> CAN Fertilizer Mk7500/50kg\n";
						$response .= "> Mankhwala A Chimanga Mk2500/10L\n";
						$response .= "> Mbedza Mk1260/kg\n";
						$response .= "> Ma Nets A Nsomba Mk7500/50kg\n\n";
	
						$response .= "1. Kubwera Pambuyo\n";
						$response .= "2. Kubwelera Kumayambiliro\n";
	
						// Print the response onto the page so that our gateway can read it
						header('Content-type: text/plain');
						echo $response;	
						}
					break;
	
					case "2":
						if($level==75){							
						// Graduate user to level 
						$sql4="UPDATE `session` SET `level`=77 where `session_id`='".$sessionId."'";
						$db->query($sql4);
	
						$response = "Mwasankha Zokolora Za Kumunda BT\n";
						$response .= "Izi Ndi Zomwe Zikugulitsidwa\n\n";
	
						$response .= "> Soya Mk7200/50kg\n";
						$response .= "> Mpunga Mk10000/50kg\n";
						$response .= "> Chimanga Mk5000/50kg\n";
						$response .= "> Chambo Mk1260/kg\n";
						$response .= "> Cotton Mk1260/50kg\n\n";
	
						$response .= "1. Kubwera Pambuyo\n";
						$response .= "2. Kubwelera Kumayambiliro\n";
	
						// Print the response onto the page so that our gateway can read it
						header('Content-type: text/plain');
						echo $response;	
						}
					break;
	
					case "3":
						if($level==75){							
						// Graduate user to level 14
						$sql4="UPDATE `session` SET `level`=71 where `session_id`='".$sessionId."'";
						$db->query($sql4);
	
						$response = "CON  Magulu A Zithu Zakumunda\n";
						$response .= "Mwasankha Wogulisa Za Kumunda\n";
						$response .= "Sankhani Msika Umodzi ndi kuona Zomwe Amagulisa\n\n";
	
						$response .= "1. Zomba ADMARC, Zomba\n";
						$response .= "2. Blantyre ADMARC, Blantyre\n";
						$response .= "3. Lilongwe ADMARC, Lilongwe\n";
						$response .= "4. Kubwelera Pambuyo\n";
						$response .= "5. Kubwelera Koyambilira\n";
						
						// Print the response onto the page so that our gateway can read it
						header('Content-type: text/plain');
						echo $response;	
						}
					break;
	
					case "4":   			// if the choice is 1 the user go to Chichewa version
						if($level==75){
							// graduate user to level 69
							$sql2="UPDATE `session` SET `level`=2 where `session_id`='".$sessionId."'";
							$db->query($sql2);
							
							//Menu 2  Chichewa 
							//Serve Chichewa services menu
							$response = "Zikomo Posankha Chichewa \n";
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
						if($level==75){
							// Return user to Main Menu & Demote user's level
							$response = "CON Mwasankha Nambala Yolakwika, Chonde Yeselaninso\n";
							$response .= "Mwasankha Blantyre ADMARC\n";
							$response .= "Magulu A Zomwe Amagulisa:\n\n";
	
							$response .= "1. Zolowa Kumunda\n";
							$response .= "2. Zokolora Za Kumunda\n";
							$response .= "3. Kubwelera Pa Mbuyo\n";
							$response .= "4. Kubwelera Ku Mayambiliro\n";
							//update the level to 0 so that the session should start at level 1
							$sql4="UPDATE `session` SET `level`=75 where `session_id`='".$sessionId."'";
							$db->query($sql4);
	
							// Print the response onto the page so that our gateway can read it
							header('Content-type: text/plain');
							echo $response;	
						}
				}
			}
		}
		else if($level==76){ //last level of Blantyre ADMARC
			if(!$userResponse==""){
				switch($userResponse){
					case "1":
						if($level==76){							
							// Graduate user to level 14
							$sql4="UPDATE `session` SET `level`=75 where `session_id`='".$sessionId."'";
							$db->query($sql4);
	
							$response = "CON Mwasankha Blantyre ADMARC\n";
							$response .= "Magulu A Zomwe Amagulisa:\n\n";
	
							$response .= "1. Zolowa Kumunda\n";
							$response .= "2. Zokolora Za Kumunda\n";
							$response .= "3. Kubwelera Pa Mbuyo\n";
							$response .= "4. Kubwelera Ku Mayambiliro\n";
	
							// Print the response onto the page so that our gateway can read it
							header('Content-type: text/plain');
							echo $response;	
						}
					break;
	
					case "2":   			// returns the user to the main menu
						if($level==76){
							// graduate user to level 69
							$sql2="UPDATE `session` SET `level`=69 where `session_id`='".$sessionId."'";
							$db->query($sql2);
							
							//Menu 2  Chichewa 
							//Serve Chichewa services menu
							$response = "Zikomo Posankha Chichewa \n";
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
						if($level==76){
							// Return user to Main Menu & Demote user's level
							
							$response = "Mwasankha Nambala Yolakwika, Chonde Yeselaninso\n";
							
							// Print the response onto the page so that our gateway can read it
							header('Content-type: text/plain');
							echo $response;	
						}
				}		
			}
		}     
		else if($level==77){ //last level of Blantyre ADMARC
			if(!$userResponse==""){
				switch($userResponse){
					case "1":
						if($level==77){							
							// Graduate user to level 14
							$sql4="UPDATE `session` SET `level`=75 where `session_id`='".$sessionId."'";
							$db->query($sql4);
	
							$response = "CON Mwasankha Blantyre ADMARC\n";
							$response .= "Magulu A Zomwe Amagulisa:\n\n";
	
							$response .= "1. Zolowa Kumunda\n";
							$response .= "2. Zokolora Za Kumunda\n";
							$response .= "3. Kubwelera Pa Mbuyo\n";
							$response .= "4. Kubwelera Ku Mayambiliro\n";
	
							// Print the response onto the page so that our gateway can read it
							header('Content-type: text/plain');
							echo $response;	
						}
					break;
	
					case "2":   			// returns the user to the main menu
						if($level==77){
							// graduate user to level 69
							$sql2="UPDATE `session` SET `level`=69 where `session_id`='".$sessionId."'";
							$db->query($sql2);
							
							//Menu 2  Chichewa 
							//Serve Chichewa services menu
							$response = "Zikomo Posankha Chichewa \n";
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
						if($level==77){
							// Return user to Main Menu & Demote user's level
							
							$response = "Mwasankha Nambala Yolakwika, Chonde Yeselaninso\n";
							
							// Print the response onto the page so that our gateway can read it
							header('Content-type: text/plain');
							echo $response;	
						}
				}		
			}
		} 
		else if($level==78){
			if(!$userResponse==""){
				switch($userResponse){
					case "1":
						if($level==78){							
						// Graduate user to level 6
						$sql4="UPDATE `session` SET `level`=79 where `session_id`='".$sessionId."'";
						$db->query($sql4);
	
						$response = "Mwasankha Zolowa Kumunda LL\n";
						$response .= "Izi Ndi Zomwe Zikugulitsidwa\n\n";
	
						$response .= "> Mbewu  Za Tomato Mk200/25g\n";
						$response .= "> CAN Fertilizer Mk7500/50kg\n";
						$response .= "> Mankhwala A Chimanga Mk2500/10L\n";
						$response .= "> Mbedza Mk1260/kg\n";
						$response .= "> Ma Nets A Nsomba Mk7500/50kg\n\n";
	
						$response .= "1. Kubwera Pambuyo\n";
						$response .= "2. Kubwelera Kumayambiliro\n";
	
						// Print the response onto the page so that our gateway can read it
						header('Content-type: text/plain');
						echo $response;	
						}
					break;
	
					case "2":
						if($level==78){							
						// Graduate user to level 
						$sql4="UPDATE `session` SET `level`=80 where `session_id`='".$sessionId."'";
						$db->query($sql4);
	
						$response = "Mwasankha Zokolora Za Kumunda LL\n";
						$response .= "Izi Ndi Zomwe Zikugulitsidwa\n\n";
	
						$response .= "> Soya Mk7200/50kg\n";
						$response .= "> Mpunga Mk10000/50kg\n";
						$response .= "> Chimanga Mk5000/50kg\n";
						$response .= "> Chambo Mk1260/kg\n";
						$response .= "> Cotton Mk1260/50kg\n\n";
	
						$response .= "1. Kubwera Pambuyo\n";
						$response .= "2. Kubwelera Kumayambiliro\n";
	
						// Print the response onto the page so that our gateway can read it
						header('Content-type: text/plain');
						echo $response;	
						}
					break;
	
					case "3":
						if($level==78){							
						// Graduate user to level 14
						$sql4="UPDATE `session` SET `level`=71 where `session_id`='".$sessionId."'";
						$db->query($sql4);
	
						$response = "CON  Magulu A Zithu Zakumunda\n";
						$response .= "Mwasankha Wogulisa Za Kumunda\n";
						$response .= "Sankhani Msika Umodzi ndi kuona Zomwe Amagulisa\n\n";
	
						$response .= "1. Zomba ADMARC, Zomba\n";
						$response .= "2. Blantyre ADMARC, Blantyre\n";
						$response .= "3. Lilongwe ADMARC, Lilongwe\n";
						$response .= "4. Kubwelera Pambuyo\n";
						$response .= "5. Kubwelera Koyambilira\n";
						
						// Print the response onto the page so that our gateway can read it
						header('Content-type: text/plain');
						echo $response;	
						}
					break;
	
					case "4":   			// if the choice is 1 the user go to Chichewa version
						if($level==78){
							// graduate user to level 69
							$sql2="UPDATE `session` SET `level`=69 where `session_id`='".$sessionId."'";
							$db->query($sql2);
							
							//Menu 2  Chichewa 
							//Serve Chichewa services menu
							$response = "Zikomo Posankha Chichewa \n";
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
						if($level==78){
							// Return user to Main Menu & Demote user's level
							$response = "CON Mwasankha Nambala Yolakwika, Chonde Yeselaninso\n";
							$response .= "Mwasankha Lilongwe ADMARC\n";
							$response .= "Magulu A Zomwe Amagulisa:\n\n";
	
							$response .= "1. Zolowa Kumunda\n";
							$response .= "2. Zokolora Za Kumunda\n";
							$response .= "3. Kubwelera Pa Mbuyo\n";
							$response .= "4. Kubwelera Ku Mayambiliro\n";
							//update the level to 0 so that the session should start at level 1
							$sql4="UPDATE `session` SET `level`=78 where `session_id`='".$sessionId."'";
							$db->query($sql4);
	
							// Print the response onto the page so that our gateway can read it
							header('Content-type: text/plain');
							echo $response;	
						}
				}
			}
		}
		else if($level==79){ //last level of Lilongwe ADMARC
			if(!$userResponse==""){
				switch($userResponse){
					case "1":
						if($level==79){							
							// Graduate user to level 14
							$sql4="UPDATE `session` SET `level`=75 where `session_id`='".$sessionId."'";
							$db->query($sql4);
	
							$response = "CON Mwasankha Lilongwe ADMARC\n";
							$response .= "Magulu A Zomwe Amagulisa:\n\n";
	
							$response .= "1. Zolowa Kumunda\n";
							$response .= "2. Zokolora Za Kumunda\n";
							$response .= "3. Kubwelera Pa Mbuyo\n";
							$response .= "4. Kubwelera Ku Mayambiliro\n";
	
							// Print the response onto the page so that our gateway can read it
							header('Content-type: text/plain');
							echo $response;	
						}
					break;
	
					case "2":   			// returns the user to the main menu
						if($level==79){
							// graduate user to level 69
							$sql2="UPDATE `session` SET `level`=69 where `session_id`='".$sessionId."'";
							$db->query($sql2);
							
							//Menu 2  Chichewa 
							//Serve Chichewa services menu
                     $response = "Takulandirani Kuno Ku Farmers World\n";
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
						if($level==79){
							// Return user to Main Menu & Demote user's level
							
							$response = "Mwasankha Nambala Yolakwika, Chonde Yeselaninso\n";
							
							// Print the response onto the page so that our gateway can read it
							header('Content-type: text/plain');
							echo $response;	
						}
				}		
			}
		}     
		else if($level==80){ //last level of Lilongwe ADMARC
			if(!$userResponse==""){
				switch($userResponse){
					case "1":
						if($level==80){							
							// Graduate user to level 14
							$sql4="UPDATE `session` SET `level`=75 where `session_id`='".$sessionId."'";
							$db->query($sql4);
	
							$response = "CON Mwasankha Lilongwe ADMARC\n";
							$response .= "Magulu A Zomwe Amagulisa:\n\n";
	
							$response .= "1. Zolowa Kumunda\n";
							$response .= "2. Zokolora Za Kumunda\n";
							$response .= "3. Kubwelera Pa Mbuyo\n";
							$response .= "4. Kubwelera Ku Mayambiliro\n";
	
							// Print the response onto the page so that our gateway can read it
							header('Content-type: text/plain');
							echo $response;	
						}
					break;
	
					case "2":   			// returns the user to the main menu
						if($level==80){
							// graduate user to level 69
							$sql2="UPDATE `session` SET `level`=69 where `session_id`='".$sessionId."'";
							$db->query($sql2);
							
							//Menu 2  Chichewa 
							//Serve Chichewa services menu
							$response = "Zikomo Posankha Chichewa \n";
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
						if($level==80){
							// Return user to Main Menu & Demote user's level
							
							$response = "Mwasankha Nambala Yolakwika, Chonde Yeselaninso\n";
							
							// Print the response onto the page so that our gateway can read it
							header('Content-type: text/plain');
							echo $response;	
						}
				}		
			}
		}
		//End of Option 1 of the Chichewa Menu
		
		//Start of Option 2 of the Chichewa Menu
		else if($level==81){
			if(!$userResponse==""){
				switch($userResponse){
					case "1":
						if($level==81){							
							// Graduate user to level 14
							$sql4="UPDATE `session` SET `level`=82 where `session_id`='".$sessionId."'";
							$db->query($sql4);
		
							$response = "CON Misika Kogulisa Katundu\n";
							$response .= "Misika Yomwe Ikupezeka\n";
							$response .= "Sankhani Komwe Mukufuna Kugulisa Katundu Wanu\n\n";
	
							$response .= "1. Zomba ADMARC Market\n";
							$response .= "2. Lilongwe Auction Holdings\n";
							$response .= "3. Blantyre Auction Holdings\n";
							$response .= "4. Kubwelera Pambuyo\n";
							$response .= "5. Kubwelera Kumayambiliro\n";
	
		
							// Print the response onto the page so that our gateway can read it
							header('Content-type: text/plain');
							echo $response;	
						}
					break;
							
					case "2":   			// if the choice is 1 the user go to Chichewa version
						if($level==81){
							// graduate user to level 69
							$sql2="UPDATE `session` SET `level`=69 where `session_id`='".$sessionId."'";
							$db->query($sql2);
									
							// Menu 2  Chichewa 
							//Serve Chichewa services menu
							$response = "Takulandirani Kuno Ku Farmers World\n";
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
						if($level==81){
							// Return user to Main Menu & Demote user's level
							$response = "CON Mwasankha Nambala Yolakwika,Chonde Sankhani Yoyenela\n";
							$response .= "Takulandirani Kuno Ku Farmers World\n";
							$response .= "Mwasankha Misika Wogula Zakumunda\n\n";

							$response .= "1. Wonani Misika ndi Zomwe Amagula Kwa Inu\n";
							$response .= "2. Kubwerera pambuyo";
	
							//update the level to 0 so that the session should start at level 1
							$sql4="UPDATE `session` SET `level`=81 where `session_id`='".$sessionId."'";
							$db->query($sql4);
		
							// Print the response onto the page so that our gateway can read it
							header('Content-type: text/plain');
							echo $response;	
						}
					
				}
			}
		}		
		else if($level==82){
			if(!$userResponse==""){
				switch($userResponse){
					case "1":
						if($level==82){							
							// Graduate user to level 16
							$sql4="UPDATE `session` SET `level`=83 where `session_id`='".$sessionId."'";
							$db->query($sql4);
	
							$response = "CON Zomba ADMARC\n";
							$response .= "Zakumunda Zomwe Akugula\n";
							$response .= "Chonde Sankhani Chimodzi\n\n";
		
							$response .= "1. Chimanga Pa Mtengo Wa MK5000/50Kg\n";
							$response .= "2. Soya Pa Mtengo Wa MK7000/50Kg\n";
							$response .= "3. Mtedza Pa Mtengo Wa MK10000/50Kg\n";
							$response .= "4. Kubwelera Pambuyo\n";
							$response .= "5. Kubwelera Kumayambiliro\n";
	
							// Print the response onto the page so that our gateway can read it
							header('Content-type: text/plain');
							echo $response;	
						}
					break;
	
					case "2":
						if($level==82){							
							// Graduate user to level 58
							$sql4="UPDATE `session` SET `level`=92 where `session_id`='".$sessionId."'";
							$db->query($sql4);
	
							$response = "CON Lilongwe Auction Holdings\n";
							$response .= "Zakumunda Zomwe Akugula\n";
							$response .= "Chonde Sankhani Chimodzi\n\n";
		
							$response .= "1. Chimanga Pa Mtengo Wa MK5000/50Kg\n";
							$response .= "2. Soya Pa Mtengo Wa MK7000/50Kg\n";
							$response .= "3. Mtedza Pa Mtengo Wa MK10000/50Kg\n";;
							$response .= "4. Kubwelera Pambuyo\n";
							$response .= "5. Kubwelera Kumayambiliro\n";
	
							// Print the response onto the page so that our gateway can read it
							header('Content-type: text/plain');
							echo $response;	
						}
					break;
	
					case "3":
						if($level==82){							
							// Graduate user to level 101
							$sql4="UPDATE `session` SET `level`=101 where `session_id`='".$sessionId."'";
							$db->query($sql4);
	
							$response = "CON Blantyre Auction Holdings\n";
							$response .= "Zakumunda Zomwe Akugula\n";
							$response .= "Chonde Sankhani Chimodzi\n\n";
		
							$response .= "1. Chimanga Pa Mtengo Wa MK5000/50Kg\n";
							$response .= "2. Soya Pa Mtengo Wa MK7000/50Kg\n";
							$response .= "3. Mtedza Pa Mtengo Wa MK10000/50Kg\n";
							$response .= "4. Kubwelera Pambuyo\n";
							$response .= "5. Kubwelera Kumayambiliro\n";
	
							// Print the response onto the page so that our gateway can read it
							header('Content-type: text/plain');
							echo $response;	
						}
					break;
	
					case "4": // user will be here if he chooses option 2 in Chichewa menu
						if($level==82){
							   //Downgrade user to level 81
							$sql4="UPDATE `session` SET `level`=81 where `session_id`='".$sessionId."'";
							$db->query($sql4);
		
							$response = "CON  Gawo La Misika Kogula Katundu\n";
							$response .= "Mwasankha Misika Kogula Katundu\n\n";
	
							$response .= "1. Wonani Misika ndi Zomwe Akugulisa\n";
							$response .= "2. Kubwerera Kumayambiliro";												
							
							// Print the response onto the page so that our gateway can read it
							header('Content-type: text/plain');
							echo $response;				
							}
					break;
	
					case "5":
						if($level==82){
							// graduate user to level 69
							$sql2="UPDATE `session` SET `level`=69 where `session_id`='".$sessionId."'";
							$db->query($sql2);
									
							// Menu 2  Chichewa 
							//Serve Chichewa services menu
							$response = "Takulandirani Kuno Ku Farmers World\n";
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
						if($level==82){
							// Return user to Main Menu & Demote user's level
							$response = "CON Mwasankha Numbala Yolakwika, Chonde Yeseleraninso.\n";
							$response = "CON Misika Yomwe Ikupezeka\n";
							$response .= "Sankhani Komwe Mukufuna Kugulisa Katundu Wanu\n\n";
	
							$response .= "1. Zomba ADMARC\n";
							$response .= "2. Lilongwe Auction Holdings\n";
							$response .= "3. Blantyre Auction Holdings\n";
							$response .= "4. Kubwelera Pambuyo\n";
							$response .= "5. Kubwelera Kumayambiliro\n";
	
							//update the level to 0 so that the session should start at level 1
							$sql4="UPDATE `session` SET `level`=82 where `session_id`='".$sessionId."'";
							$db->query($sql4);
	
							// Print the response onto the page so that our gateway can read it
							header('Content-type: text/plain');
							echo $response;	
						}
				}
			}
		}
		//Markets section for Zomba Chichewa Menu
		else if($level==83){
			if(!$userResponse==""){
				switch($userResponse){
					case "1":
						if($level==83){							
							// Graduate user to level 84
							$sql="UPDATE `session` SET `level`=84 where `session_id`='".$sessionId."'";
							$db->query($sql);
	
							$response = "CON Zomba ADMARC\n";
							$response .= "Chimanga Pa Mtengo Wa MK5000/50kg\n\n";
								
							$response .= "1. Lowetsani Mlingo (Kgs) Woti Mugulitse\n";
	
							// Print the response onto the page so that our gateway can read it
							header('Content-type: text/plain');
							echo $response;	
						}
					break;
	
					case "2":
						if($level==83){							
							// Graduate user to level 
							$sql4="UPDATE `session` SET `level`=88 where `session_id`='".$sessionId."'";
							$db->query($sql4);
	
							$response = "CON Zomba ADMARC\n";
							$response .= "Soya Pamtengo Wa MK7000/50Kg\n\n";
								
							$response .= "1. Lowetsani Mlingo (Kgs) Woti Mugulitse\n";
	
							// Print the response onto the page so that our gateway can read it
							header('Content-type: text/plain');
							echo $response;	
						}
					break;
	
					case "3":
						if($level==83){							
						// Graduate user to level 14
						$sql4="UPDATE `session` SET `level`=90 where `session_id`='".$sessionId."'";
						$db->query($sql4);
	
						$response = "CON Zomba ADMARC\n";
						$response .= "Mteza Pa Mtengo Wa MK10000/50Kg\n\n";
		
						$response .= "1. Lowetsani Mlingo (Kgs) Woti Mugulitse\n";
												
						// Print the response onto the page so that our gateway can read it
						header('Content-type: text/plain');
						echo $response;	
						}
					break;
					
	
					case "4":
						if($level==83){							
							// Graduate user to level 82
							$sql4="UPDATE `session` SET `level`=82 where `session_id`='".$sessionId."'";
							$db->query($sql4);
	
							$response = "CON Misika Yomwe Ikupezeka\n";
							$response .= "Sankhani Komwe Mukufuna Kugulisa Katundu Wanu\n\n";
	
							$response .= "1. Zomba ADMARC\n";
							$response .= "2. Lilongwe Auction Holdings\n";
							$response .= "3. Blantyre Auction Holdings\n";
							$response .= "4. Kubwelera Pambuyo\n";
							$response .= "5. Kubwelera Kumayambiliro\n";
	
							// Print the response onto the page so that our gateway can read it
							header('Content-type: text/plain');
							echo $response;	
						}
					break;
	
					case "5":
						if($level==83){							
							// graduate user to level 69						
							$sql2="UPDATE `session` SET `level`=69 where `session_id`='".$sessionId."'";
							$db->query($sql2);
							
							// Menu 2  Chichewa 
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
						if($level==83){
							// Return user to Main Menu & Demote user's level
							$response = "CON Mwasankha Nambala Yolakwika, Chonde Yeselaninso\n";
							$response .= "Zakumunda Zomwe Akugula ZA\n";
							$response .= "Chonde Sankhani Chimodzi\n\n";
		
							$response .= "1. Chimanga Pa Mtengo Wa MK5000/50Kg\n";
							$response .= "2. Soya Pa Mtengo Wa MK7000/50Kg\n";
							$response .= "3. Mtedza Pa Mtengo Wa K10000/50Kg\n";
							$response .= "4. Kubwelera Pambuyo\n";
							$response .= "5. Kubwelera Kumayambiliro\n";
	
							//update the level to 0 so that the session should start at level 1
							$sql4="UPDATE `session` SET `level`=83 where `session_id`='".$sessionId."'";
							$db->query($sql4);
	
							// Print the response onto the page so that our gateway can read it
							header('Content-type: text/plain');
							echo $response;	
						}
				}			
			}
		}
		//Maize Menu Under Lilongwe For Chichewa Menu 
		else if($level==84){
			if(!$userResponse==""){
				if($level==84){							
					// Graduate user to level 65
					$sql4="UPDATE `session` SET `level`=85 where `session_id`='".$sessionId."'";
					$db->query($sql4);
	
					$response = "CON Zomba ADMARC\n";
					$response .= "Chimanga Pa Mtengo  Wa MK5000/50kg\n\n";
							
					$response .= "Mwalowetsa {Amount}Kgs Kuti Mugulitse\n\n";
	
					$response .= "1. Kupitiliza\n";
					$response .= "2. Kuchosa\n";
	
					// Print the response onto the page so that our gateway can read it
					header('Content-type: text/plain');
					echo $response;	
				}				 							
			}
		}
		else if($level==85){
			if(!$userResponse==""){
				switch($userResponse){
					case "1":
						if($level==85){							
						// Graduate user to level 14
						$sql4="UPDATE `session` SET `level`=86 where `session_id`='".$sessionId."'";
						$db->query($sql4);
	
						$response = "END Zomba Admarc\n";
						$response .= "Chimanga Pa Mtengo Wa MK5000/50kg\n\n";
								
						$response .= "Booking Successful!!!\n";
	
						// Print the response onto the page so that our gateway can read it
						header('Content-type: text/plain');
						echo $response;	
						}
					break;
	
					case "2":
						if($level==85){							
						// Graduate user to level 71
						$sql4="UPDATE `session` SET `level`=87 where `session_id`='".$sessionId."'";
						$db->query($sql4);
	
						$response = "END Zomba Admarc\n";
						$response .= "Chimanga Pa Mtengo Wa MK5000/50kg\n\n";
								
						$response .= "Mwachotsa, Chonde Yeselaninso\n";
	
						// Print the response onto the page so that our gateway can read it
						header('Content-type: text/plain');
						echo $response;	
						}
					break;
	
					default:
						if($level==85){
							// Return user to Main Menu & Demote user's level
							$response = "CON Mwasankha Nambala Yolakwika, Chonde Sankhaninso\n";
							$response = "Zomba ADMARC\n";
							$response = "Chimanga Pa Mtengo  Wa MK5000/50kg\n\n";
							
							$response .= "Mwalowetsa {Amount}Kgs Kuti Mugulitse\n\n";
	
							$response .= "1. Kupitiliza\n";
							$response .= "2. Kubwelera Kumayambiliro\n";
	
							$sql4="UPDATE `session` SET `level`=85 where `session_id`='".$sessionId."'";
							$db->query($sql4);
	
							// Print the response onto the page so that our gateway can read it
							header('Content-type: text/plain');
							echo $response;	
						}
				}					
			}
		}
		else if($level==86){
			if(!$userResponse==""){
				
				$response = "END, Level 86\n";
				header('Content-type: text/plain');
				echo $response;	
				
			}
		}
		else if($level==87){
			if(!$userResponse==""){
				
				$response = "END, Level 87\n";
				header('Content-type: text/plain');
				echo $response;	
				
			}
		}
		//Soya Beans Menu Under Zomba for Chichewa Menu
		else if($level==88){
			if(!$userResponse==""){
				if($level==88){							
					// Graduate user to level 65
					$sql4="UPDATE `session` SET `level`=89 where `session_id`='".$sessionId."'";
					$db->query($sql4);
	
					$response = "CON Zomba ADMARC\n";
					$response .= "Soya Pa Mtengo  Wa MK7000/50kg\n\n";
							
					$response .= "Mwalowetsa {Amount}Kgs Kuti Mugulitse\n\n";
	
					$response .= "1. Kupitiliza\n";
					$response .= "2. Kuchosa\n";
	
					// Print the response onto the page so that our gateway can read it
					header('Content-type: text/plain');
					echo $response;	
				}				 							
			}
		}
		else if($level==89){
			if(!$userResponse==""){
				switch($userResponse){
					case "1":
						if($level==89){							
						// Graduate user to level 19
						$sql4="UPDATE `session` SET `level`=86 where `session_id`='".$sessionId."'";
						$db->query($sql4);
	
						$response = "END Zomba Admarc\n";
						$response .= "Soya Pa Mtengo Wa MK7000/50kg\n\n";
								
						$response .= "Booking Successful!!!\n";
						
						// Print the response onto the page so that our gateway can read it
						header('Content-type: text/plain');
						echo $response;	
						}
					break;
	
					case "2":
						if($level==89){							
						// Graduate user to level 71
						$sql4="UPDATE `session` SET `level`=87 where `session_id`='".$sessionId."'";
						$db->query($sql4);
	
						$response = "END Zomba Admarc\n";
						$response .= "Soya Pa Mtengo Wa MK7000/50kg\n\n";
								
						$response .= "Mwachotsa, Chonde Yeselaninso\n";
	
	
						// Print the response onto the page so that our gateway can read it
						header('Content-type: text/plain');
						echo $response;	
						}
					break;
	
					default:
						if($level==89){
							// Return user to Main Menu & Demote user's level
							$response = "CON Mwasankha Nambala Yolakwika, Chonde Sankhaninso\n";
							$response = "Zomba ADMARC\n";
							$response = "Soya Pa Mtengo  Wa MK7000/50kg\n\n";
							
							$response .= "Mwalowetsa {Amount}Kgs Kuti Mugulitse\n\n";
	
							$response .= "1. Kupitiliza\n";
							$response .= "2. Kubwelera Kumayambiliro\n";
							
							$sql4="UPDATE `session` SET `level`=89 where `session_id`='".$sessionId."'";
							$db->query($sql4);
	
							// Print the response onto the page so that our gateway can read it
							header('Content-type: text/plain');
							echo $response;	
						}
				}					
			}
		}
		//GroundNuts Menu Under Zomba for Chichewa Menu
		else if($level==90){
			if(!$userResponse==""){
				if($level==90){							
					// Graduate user to level 65
					$sql4="UPDATE `session` SET `level`=91 where `session_id`='".$sessionId."'";
					$db->query($sql4);
	
					$response = "CON Zomba ADMARC\n";
					$response .= "Mtedza Pa Mtengo  Wa MK5000/50kg\n\n";
							
					$response .= "Mwalowetsa {Amount}Kgs Kuti Mugulitse\n\n";
	
					$response .= "1. Kupitiliza\n";
					$response .= "2. Kuchosa\n";
	
					// Print the response onto the page so that our gateway can read it
					header('Content-type: text/plain');
					echo $response;	
				}				 							
			}
		}
		else if($level==91){
			if(!$userResponse==""){
				switch($userResponse){
					case "1":
						if($level==91){							
						// Graduate user to level 14
						$sql4="UPDATE `session` SET `level`=86 where `session_id`='".$sessionId."'";
						$db->query($sql4);
	
						$response = "END Zomba Admarc\n";
						$response .= "Mtedza Pa Mtengo Wa MK10000/50kg\n\n";
								
						$response .= "Booking Successful!!!\n";
	
						// Print the response onto the page so that our gateway can read it
						header('Content-type: text/plain');
						echo $response;	
						}
					break;
	
					case "2":
						if($level==91){							
							// Graduate user to level 71
							$sql4="UPDATE `session` SET `level`=87 where `session_id`='".$sessionId."'";
							$db->query($sql4);
	
							$response = "END Zomba Admarc\n";
							$response .= "Mtedza Pa Mtengo Wa MK10000/50kg\n\n";
								
							$response .= "Mwachotsa, Chonde Yeselaninso\n";
	
							// Print the response onto the page so that our gateway can read it
							header('Content-type: text/plain');
							echo $response;	
						}
					break;
	
					default:
						if($level==91){
							// Return user to Main Menu & Demote user's level
							$response = "CON Mwasankha Nambala Yolakwika, Chonde Sankhaninso\n";
							$response = "Zomba ADMARC\n";
							$response = "Mteza Pa Mtengo  Wa MK10000/50kg\n\n";
							
							$response .= "Mwalowetsa {Amount}Kgs Kuti Mugulitse\n\n";
	
							$response .= "1. Kupitiliza\n";
							$response .= "2. Kubwelera Kumayambiliro\n";
	
							$sql4="UPDATE `session` SET `level`=24 where `session_id`='".$sessionId."'";
							$db->query($sql4);
							 // Print the response onto the page so that our gateway can read it
							header('Content-type: text/plain');
							echo $response;	
						}
				}					
			}
		}
		//Markets section for Lilongwe Chichewa Menu
		else if($level==92){
			if(!$userResponse==""){
				switch($userResponse){
					case "1":
						if($level==92){							
							// Graduate user to level 93
							$sql="UPDATE `session` SET `level`=93 where `session_id`='".$sessionId."'";
							$db->query($sql);
							$response = "CON Lilongwe Auction Holdings\n";
							$response .= "Chimanga Pa Mtengo Wa MK5000/50kg\n\n";
								
							$response .= "1. Lowetsani Mlingo (Kgs) Woti Mugulitse\n";
	
							// Print the response onto the page so that our gateway can read it
							header('Content-type: text/plain');
							echo $response;	
						}
					break;
	
					case "2":
						if($level==92){							
							// Graduate user to level 97
							$sql4="UPDATE `session` SET `level`=97 where `session_id`='".$sessionId."'";
							$db->query($sql4);
	
							$response = "CON Lilongwe Auction Holdings\n";
							$response .= "Soya Pamtengo Wa MK7000/50Kg\n\n";
								
							$response .= "1. Lowetsani Mlingo (Kgs) Woti Mugulitse\n";
	
							// Print the response onto the page so that our gateway can read it
							header('Content-type: text/plain');
							echo $response;	
						}
					break;
	
					case "3":
						if($level==92){							
						// Graduate user to level 99
						$sql4="UPDATE `session` SET `level`=99 where `session_id`='".$sessionId."'";
						$db->query($sql4);
	
						$response = "CON Lilongwe Auction Holdings\n";
						$response .= "Mteza Pa Mtengo Wa MK10000/50Kg\n\n";
		
						$response .= "1. Lowetsani Mlingo (Kgs) Woti Mugulitse\n";
							
						// Print the response onto the page so that our gateway can read it
						header('Content-type: text/plain');
						echo $response;	
						}
					break;
					
	
					case "4":
						if($level==92){							
							// Graduate user to level 82
							$sql4="UPDATE `session` SET `level`=82 where `session_id`='".$sessionId."'";
							$db->query($sql4);
	
							$response = "CON Misika Yomwe Ikupezeka\n";
							$response .= "Sankhani Komwe Mukufuna Kugulisa Katundu Wanu\n\n";
	
							$response .= "1. Zomba ADMARC\n";
							$response .= "2. Lilongwe Auction Holdings\n";
							$response .= "3. Blantyre Auction Holdings\n";
							$response .= "4. Kubwelera Pambuyo\n";
							$response .= "5. Kubwelera Kumayambiliro\n";
	
							// Print the response onto the page so that our gateway can read it
							header('Content-type: text/plain');
							echo $response;	
						}
					break;
	
					case "5":
						if($level==92){							
							// graduate user to level 69						
							$sql2="UPDATE `session` SET `level`=69 where `session_id`='".$sessionId."'";
							$db->query($sql2);
							
							// Menu 2  Chichewa 
							//Serve Chichewa services menu
							$$response = "Takulandirani Kuno Ku Farmers World\n";
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
						if($level==92){
							// Return user to Main Menu & Demote user's level
							$response = "CON Mwasankha Nambala Yolakwika, Chonde Yeselaninso\n";
						$response .= "Zakumunda Zomwe Akugula LL\n";
						$response .= "Chonde Sankhani Chimodzi\n\n";
	
							$response .= "1. Chimanga Pa Mtengo Wa MK5000/50Kg\n";
							$response .= "2. Soya Pa Mtengo Wa MK7000/50Kg\n";
							$response .= "3. Mtedza Pa Mtengo Wa K10000/50Kg\n";
							$response .= "4. Kubwelera Pambuyo\n";
							$response .= "5. Kubwelera Kumayambiliro\n";
	
							//update the level to 0 so that the session should start at level 1
							$sql4="UPDATE `session` SET `level`=92 where `session_id`='".$sessionId."'";
							$db->query($sql4);
	
							// Print the response onto the page so that our gateway can read it
							header('Content-type: text/plain');
							echo $response;	
						}
				}			
			}
		}
		//Maize Menu Under Lilongwe For Chichewa Menu 
		else if($level==93){
			if(!$userResponse==""){
				if($level==93){							
					// Graduate user to level 65
					$sql4="UPDATE `session` SET `level`=94 where `session_id`='".$sessionId."'";
					$db->query($sql4);
	
					$response = "CON Lilongwe Auction Holdings\n";
					$response .= "Chimanga Pa Mtengo  Wa MK5000/50kg\n\n";
							
					$response .= "Mwalowetsa {Amount}Kgs Kuti Mugulitse\n\n";
	
					$response .= "1. Kupitiliza\n";
					$response .= "2. Kuchosa\n";
	
					// Print the response onto the page so that our gateway can read it
					header('Content-type: text/plain');
					echo $response;	
				}				 							
			}
		}
		else if($level==94){
			if(!$userResponse==""){
				switch($userResponse){
					case "1":
						if($level==94){							
						// Graduate user to level 14
						$sql4="UPDATE `session` SET `level`=95 where `session_id`='".$sessionId."'";
						$db->query($sql4);
	
						$response = "END Lilongwe Auction Holdings\n";
						$response .= "Chimanga Pa Mtengo Wa MK5000/50kg\n\n";
								
						$response .= "Booking Successful!!!\n";
	
						// Print the response onto the page so that our gateway can read it
						header('Content-type: text/plain');
						echo $response;	
						}
					break;
	
					case "2":
						if($level==94){							
						// Graduate user to level 71
						$sql4="UPDATE `session` SET `level`=96 where `session_id`='".$sessionId."'";
						$db->query($sql4);
	
						$response = "END Lilongwe Auction Holdings\n";
						$response .= "Chimanga Pa Mtengo Wa MK5000/50kg\n\n";
								
						$response .= "Mwachotsa, Chonde Yeselaninso\n";
						
						// Print the response onto the page so that our gateway can read it
						header('Content-type: text/plain');
						echo $response;	
						}
					break;
	
					default:
						if($level==94){
							// Return user to Main Menu & Demote user's level
							$response = "CON Mwasankha Nambala Yolakwika, Chonde Sankhaninso\n";
							$response = "Lilongwe Auction Holdings\n";
							$response = "Chimanga Pa Mtengo  Wa MK5000/50kg\n\n";
							
							$response .= "Mwalowetsa {Amount}Kgs Kuti Mugulitse\n\n";
	
							$response .= "1. Kupitiliza\n";
							$response .= "2. Kubwelera Kumayambiliro\n";
	
							$sql4="UPDATE `session` SET `level`=27 where `session_id`='".$sessionId."'";
							$db->query($sql4);
	
							// Print the response onto the page so that our gateway can read it
							header('Content-type: text/plain');
							echo $response;	
						}
				}					
			}
		}
		else if($level==95){
			if(!$userResponse==""){
				
				$response = "END, Level 95\n";
				header('Content-type: text/plain');
				echo $response;	            
			}
		}
		else if($level==96){
			if(!$userResponse==""){
				
				$response = "END, Level 96\n";
				header('Content-type: text/plain');
				echo $response;	          
			}
		}
		//Soya Beans Menu Under Lilongwe for Chichewa Menu
		else if($level==97){
			if(!$userResponse==""){
				if($level==97){							
					// Graduate user to level 65
					$sql4="UPDATE `session` SET `level`=98 where `session_id`='".$sessionId."'";
					$db->query($sql4);
	
					$response = "CON Lilongwe Auction Holdings\n";
					$response .= "Soya Pa Mtengo  Wa MK7000/50kg\n\n";
							
					$response .= "Mwalowetsa {Amount}Kgs Kuti Mugulitse\n\n";
	
					$response .= "1. Kupitiliza\n";
					$response .= "2. Kuchosa\n";
	
					// Print the response onto the page so that our gateway can read it
					header('Content-type: text/plain');
					echo $response;	
				}				 							
			}
		}
		else if($level==98){
			if(!$userResponse==""){
				switch($userResponse){
					case "1":
						if($level==98){							
						// Graduate user to level 19
						$sql4="UPDATE `session` SET `level`=95 where `session_id`='".$sessionId."'";
						$db->query($sql4);
	
						$response = "END Lilongwe Auction Holdings\n";
						$response .= "Soya Pa Mtengo Wa MK7000/50kg\n\n";
								
						$response .= "Booking Successful!!!\n";
	
						// Print the response onto the page so that our gateway can read it
						header('Content-type: text/plain');
						echo $response;	
						}
					break;
	
					case "2":
						if($level==98){							
						// Graduate user to level 71
						$sql4="UPDATE `session` SET `level`=96 where `session_id`='".$sessionId."'";
						$db->query($sql4);
	
						$response = "END Lilongwe Auction Holdings\n";
						$response .= "Soya Pa Mtengo Wa MK7000/50kg\n\n";
								
						$response .= "Mwachotsa, Chonde Yeselaninso\n";
	
						// Print the response onto the page so that our gateway can read it
						header('Content-type: text/plain');
						echo $response;	
						}
					break;
	
					default:
						if($level==98){
							// Return user to Main Menu & Demote user's level
							$response = "CON Mwasankha Nambala Yolakwika, Chonde Sankhaninso\n";
							$response .= "Lilongwe Auction Holdings\n";
							$response .= "Soya Pa Mtengo  Wa MK7000/50kg\n\n";
							
							$response .= "Mwalowetsa {Amount}Kgs Kuti Mugulitse\n\n";
	
							$response .= "1. Kupitiliza\n";
							$response .= "2. Kubwelera Kumayambiliro\n";
	
							$sql4="UPDATE `session` SET `level`=98 where `session_id`='".$sessionId."'";
							$db->query($sql4);
	
							// Print the response onto the page so that our gateway can read it
							header('Content-type: text/plain');
							echo $response;	
						}
				}					
			}
		}
		//GroundNuts Menu Under Lilongwe for Chichewa Menu 
		else if($level==99){
			if(!$userResponse==""){
				if($level==99){							
					// Graduate user to level 100
					$sql4="UPDATE `session` SET `level`=100 where `session_id`='".$sessionId."'";
					$db->query($sql4);
	
					$response = "CON Lilongwe Auction Holdings\n";
					$response .= "Mtedza Pa Mtengo  Wa MK5000/50kg\n\n";
							
					$response .= "Mwalowetsa {Amount}Kgs Kuti Mugulitse\n\n";
	
					$response .= "1. Kupitiliza\n";
					$response .= "2. Kuchosa\n";
	
					// Print the response onto the page so that our gateway can read it
					header('Content-type: text/plain');
					echo $response;	
				}				 							
			}
		}
		else if($level==100){
			if(!$userResponse==""){
				switch($userResponse){
					case "1":
						if($level==100){							
						// Graduate user to level 95
						$sql4="UPDATE `session` SET `level`=95 where `session_id`='".$sessionId."'";
						$db->query($sql4);
	
						$response = "END Lilongwe Auction Holdings\n";
						$response .= "Mtedza Pa Mtengo Wa MK10000/50kg\n\n";
								
						$response .= "Booking Successful!!!\n";
	
						// Print the response onto the page so that our gateway can read it
						header('Content-type: text/plain');
						echo $response;	
						}
					break;
	
					case "2":
						if($level==100){							
						   // Graduate user to level 96
						   $sql4="UPDATE `session` SET `level`=96 where `session_id`='".$sessionId."'";
						   $db->query($sql4);
	
						   $response = "END Lilongwe Auction Holdings\n";
						   $response .= "Mtedza Pa Mtengo Wa MK10000/50kg\n\n";
								
						   $response .= "Mwachotsa, Chonde Yeselaninso\n";
	
						   // Print the response onto the page so that our gateway can read it
						   header('Content-type: text/plain');
						   echo $response;	
						}
					break;
	
					default:
						if($level==100){
							// Return user to Main Menu & Demote user's level
							$response = "CON Mwasankha Nambala Yolakwika, Chonde Sankhaninso\n";
							$response = "Lilongwe Auction Holdings\n";
							$response = "Mteza Pa Mtengo  Wa MK10000/50kg\n\n";
							
							$response .= "Mwalowetsa {Amount}Kgs Kuti Mugulitse\n\n";
	
							$response .= "1. Kupitiliza\n";
							$response .= "2. Kubwelera Kumayambiliro\n";
	
							 $sql4="UPDATE `session` SET `level`=100 where `session_id`='".$sessionId."'";
							$db->query($sql4);
							 // Print the response onto the page so that our gateway can read it
							header('Content-type: text/plain');
							echo $response;	
						}
				}					
			}
		}	
		//Markets section for Blantyre Chichewa Menu
		else if($level==101){
			if(!$userResponse==""){
				switch($userResponse){
					case "1":
						if($level==101){							
							// Graduate user to level 17
							$sql="UPDATE `session` SET `level`=102 where `session_id`='".$sessionId."'";
							$db->query($sql);
							$response = "CON Blantyre Auction Holdings\n";
							$response .= "Chimanga Pa Mtengo Wa MK5000/50kg\n\n";
								
							$response .= "1. Lowetsani Mlingo (Kgs) Woti Mugulitse\n";
	
							// Print the response onto the page so that our gateway can read it
							header('Content-type: text/plain');
							echo $response;	
						}
					break;
	
					case "2":
						if($level==101){							
							// Graduate user to level 14
							$sql4="UPDATE `session` SET `level`=106 where `session_id`='".$sessionId."'";
							$db->query($sql4);
	
							$response = "CON Blantyre Auction Holdings\n";
							$response .= "Soya Pamtengo Wa MK7000/50Kg\n\n";
								
							$response .= "1. Lowetsani Mlingo (Kgs) Woti Mugulitse\n";
	
							// Print the response onto the page so that our gateway can read it
							header('Content-type: text/plain');
							echo $response;	
						}
					break;
	
					case "3":
						if($level==101){							
						// Graduate user to level 14
						$sql4="UPDATE `session` SET `level`=108 where `session_id`='".$sessionId."'";
						$db->query($sql4);
	
						$response = "CON Blantyre Auction Holdings\n";
						$response .= "Mteza Pa Mtengo Wa MK10000/50Kg\n\n";
		
						$response .= "1. Lowetsani Mlingo (Kgs) Woti Mugulitse\n";
							
						// Print the response onto the page so that our gateway can read it
						header('Content-type: text/plain');
						echo $response;	
						}
					break;
					
	
					case "4":
						if($level==101){							
							// Graduate user to level 14
							$sql4="UPDATE `session` SET `level`=82 where `session_id`='".$sessionId."'";
							$db->query($sql4);
	
							$response = "CON Misika Yomwe Ikupezeka\n";
							$response .= "Sankhani Komwe Mukufuna Kugulisa Katundu Wanu\n\n";
	
							$response .= "1. Zomba ADMARC\n";
							$response .= "2. Lilongwe Auction Holdings\n";
							$response .= "3. Blantyre Auction Holdings\n";
							$response .= "4. Kubwelera Pambuyo\n";
							$response .= "5. Kubwelera Kumayambiliro\n";
	
							// Print the response onto the page so that our gateway can read it
							header('Content-type: text/plain');
							echo $response;	
						}
					break;
	
					case "5":
						if($level==101){							
							// graduate user to level 69						
							$sql2="UPDATE `session` SET `level`=69 where `session_id`='".$sessionId."'";
							$db->query($sql2);
							
							// Menu 2  Chichewa 
							//Serve Chichewa services menu
							$response = "Takulandirani Kuno Ku Farmers World\n";
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
						if($level==101){
							// Return user to Main Menu & Demote user's level
							$response = "CON Mwasankha Nambala Yolakwika, Chonde Yeselaninso\n";
							$response .= "Zakumunda Zomwe Akugula BT\n";
							$response .= "Chonde Sankhani Chimodzi\n\n";
		
							$response .= "1. Chimanga Pa Mtengo Wa MK5000/50Kg\n";
							$response .= "2. Soya Pa Mtengo Wa MK7000/50Kg\n";
							$response .= "3. Mtedza Pa Mtengo Wa K10000/50Kg\n";
							$response .= "4. Kubwelera Pambuyo\n";
							$response .= "5. Kubwelera Kumayambiliro\n";
	
	
							//update the level to 0 so that the session should start at level 1
							$sql4="UPDATE `session` SET `level`=101 where `session_id`='".$sessionId."'";
							$db->query($sql4);
	
							// Print the response onto the page so that our gateway can read it
							header('Content-type: text/plain');
							echo $response;	
						}
				}			
			}
		}
		//Maize Menu Under Blantyre For Chichewa Menu 
		else if($level==102){
			if(!$userResponse==""){
				if($level==102){							
					// Graduate user to level 103
					$sql4="UPDATE `session` SET `level`=103 where `session_id`='".$sessionId."'";
					$db->query($sql4);
	
					$response = "CON Blantyre Auction Holdings\n";
					$response .= "Chimanga Pa Mtengo  Wa MK5000/50kg\n\n";
							
					$response .= "Mwalowetsa {Amount}Kgs Kuti Mugulitse\n\n";
	
					$response .= "1. Kupitiliza\n";
					$response .= "2. Kuchosa\n";
	
					// Print the response onto the page so that our gateway can read it
					header('Content-type: text/plain');
					echo $response;	
				}				 							
			}
		}
		else if($level==103){
			if(!$userResponse==""){
				switch($userResponse){
					case "1":
						if($level==103){							
						// Graduate user to level 104
						$sql4="UPDATE `session` SET `level`=104 where `session_id`='".$sessionId."'";
						$db->query($sql4);
	
						$response = "END Blantyre Auction Holdings\n";
						$response .= "Chimanga Pa Mtengo Wa MK5000/50kg\n\n";
								
						$response .= "Booking Successful!!!\n";
	
						// Print the response onto the page so that our gateway can read it
						header('Content-type: text/plain');
						echo $response;	
						}
					break;
	
					case "2":
						if($level==103){							
						// Graduate user to level 104
						$sql4="UPDATE `session` SET `level`=105 where `session_id`='".$sessionId."'";
						$db->query($sql4);
	
						$response = "END Blantyre Auction Holdings\n";
						$response .= "Chimanga Pa Mtengo Wa MK5000/50kg\n\n";
								
						$response .= "Mwachotsa, Chonde Yeselaninso\n";
						
						// Print the response onto the page so that our gateway can read it
						header('Content-type: text/plain');
						echo $response;	
						}
					break;
	
					default:
						if($level==103){
							// Return user to Main Menu & Demote user's level
							$response = "CON Mwasankha Nambala Yolakwika, Chonde Sankhaninso\n";
							$response = "Blantyre Auction Holdings\n";
							$response = "Chimanga Pa Mtengo  Wa MK5000/50kg\n\n";
							
							$response .= "Mwalowetsa {Amount}Kgs Kuti Mugulitse\n\n";
	
							$response .= "1. Kupitiliza\n";
							$response .= "2. Kuchosa\n";
	
							$sql4="UPDATE `session` SET `level`=103 where `session_id`='".$sessionId."'";
							$db->query($sql4);
	
							// Print the response onto the page so that our gateway can read it
							header('Content-type: text/plain');
							echo $response;	
						}
				}					
			}
		}
		else if($level==104){
			if(!$userResponse==""){
				
				$response = "END, Level 95\n";
				header('Content-type: text/plain');
				echo $response;	            
			}
		}
		else if($level==105){
			if(!$userResponse==""){
				
				$response = "END, Level 96\n";
				header('Content-type: text/plain');
				echo $response;	          
			}
		}
		//Soya Beans Menu Under Blantyre for Chichewa Menu 
		else if($level==106){
			if(!$userResponse==""){
				if($level==106){							
					// Graduate user to level 65
					$sql4="UPDATE `session` SET `level`=107 where `session_id`='".$sessionId."'";
					$db->query($sql4);
	
					$response = "CON Blantyre Auction Holdings\n";
					$response .= "Soya Pa Mtengo  Wa MK7000/50kg\n\n";
							
					$response .= "Mwalowetsa {Amount}Kgs Kuti Mugulitse\n\n";
	
					$response .= "1. Kupitiliza\n";
					$response .= "2. Kuchosa\n";
	
					// Print the response onto the page so that our gateway can read it
					header('Content-type: text/plain');
					echo $response;	
				}				 							
			}
		}
		else if($level==107){
			if(!$userResponse==""){
				switch($userResponse){
					case "1":
						if($level==107){							
						// Graduate user to level 19
						$sql4="UPDATE `session` SET `level`104 where `session_id`='".$sessionId."'";
						$db->query($sql4);
	
						$response = "END Blantyre Auction Holdings\n";
						$response .= "Soya Pa Mtengo Wa MK7000/50kg\n\n";
								
						$response .= "Booking Successful!!!\n";
	
						// Print the response onto the page so that our gateway can read it
						header('Content-type: text/plain');
						echo $response;	
						}
					break;
	
					case "2":
						if($level==107){							
						// Graduate user to level 71
						$sql4="UPDATE `session` SET `level`=105 where `session_id`='".$sessionId."'";
						$db->query($sql4);
	
						$response = "END Blantyre Auction Holdings\n";
						$response .= "Soya Pa Mtengo Wa MK7000/50kg\n\n";
								
						$response .= "Mwachotsa, Chonde Yeselaninso\n";
	
						// Print the response onto the page so that our gateway can read it
						header('Content-type: text/plain');
						echo $response;	
						}
					break;
	
					default:
						if($level==107){
							// Return user to Main Menu & Demote user's level
							$response = "CON Mwasankha Nambala Yolakwika, Chonde Sankhaninso\n";
							$response .= "Blantyre Auction Holdings\n";
							$response .= "Soya Pa Mtengo  Wa MK7000/50kg\n\n";
							
							$response .= "Mwalowetsa {Amount}Kgs Kuti Mugulitse\n\n";
	
							$response .= "1. Kupitiliza\n";
							$response .= "2. Kuchosa\n";
	
							$sql4="UPDATE `session` SET `level`=98 where `session_id`='".$sessionId."'";
							$db->query($sql4);
	
							// Print the response onto the page so that our gateway can read it
							header('Content-type: text/plain');
							echo $response;	
						}
				}					
			}
		}
		//GroundNuts Menu Under Blantyre for Chichewa Menu  
		else if($level==108){
			if(!$userResponse==""){
				if($level==108){							
					// Graduate user to level 65
					$sql4="UPDATE `session` SET `level`=109 where `session_id`='".$sessionId."'";
					$db->query($sql4);
	
					$response = "CON Blantyre Auction Holdings\n";
					$response .= "Mtedza Pa Mtengo  Wa MK5000/50kg\n\n";
							
					$response .= "Mwalowetsa {Amount}Kgs Kuti Mugulitse\n\n";
	
					$response .= "1. Kupitiliza\n";
					$response .= "2. Kuchosa\n";
	
					// Print the response onto the page so that our gateway can read it
					header('Content-type: text/plain');
					echo $response;	
				}				 							
			}
		}
		else if($level==109){
			if(!$userResponse==""){
				switch($userResponse){
					case "1":
						if($level==109){							
						// Graduate user to level 14
						$sql4="UPDATE `session` SET `level`=104 where `session_id`='".$sessionId."'";
						$db->query($sql4);
	
						$response = "END Blantyre Auction Holdings\n";
						$response .= "Mtedza Pa Mtengo Wa MK10000/50kg\n\n";
								
						$response .= "Booking Successful!!!\n";
	
						// Print the response onto the page so that our gateway can read it
						header('Content-type: text/plain');
						echo $response;	
						}
					break;
	
					case "2":
						if($level==109){							
						   // Graduate user to level 71
						   $sql4="UPDATE `session` SET `level`=105 where `session_id`='".$sessionId."'";
						   $db->query($sql4);
	
						   $response = "END Blantyre Auction Holdings\n";
						   $response .= "Mtedza Pa Mtengo Wa MK10000/50kg\n\n";
								
						   $response .= "Mwachotsa, Chonde Yeselaninso\n";
	
						   // Print the response onto the page so that our gateway can read it
						   header('Content-type: text/plain');
						   echo $response;	
						}
					break;
	
					default:
						if($level==109){
							// Return user to Main Menu & Demote user's level
							$response = "CON Mwasankha Nambala Yolakwika, Chonde Sankhaninso\n";
							$response .= "Blantyre Auction Holdings\n";
							$response .= "Mteza Pa Mtengo  Wa MK10000/50kg\n\n";
							
							$response .= "Mwalowetsa {Amount}Kgs Kuti Mugulitse\n\n";
	
							$response .= "1. Kupitiliza\n";
							$response .= "2. Kuchosa\n";
	
							 $sql4="UPDATE `session` SET `level`=109 where `session_id`='".$sessionId."'";
							$db->query($sql4);
							 // Print the response onto the page so that our gateway can read it
							header('Content-type: text/plain');
							echo $response;	
						}
				}					
			}
		}
		//ADVISORS SECTION ON THE Chichewa MENU
		else if($level==110){
			if(!$userResponse==""){
				switch($userResponse){
					case "1":
						if($level==110){							
						// Graduate user to level 44
						$sql4="UPDATE `session` SET `level`=111 /*44*/ where `session_id`='".$sessionId."'";
						$db->query($sql4);
	
						$response = "CON Alangizi A Ulimi Wa Zakumunda\n";
						$response .= "Sankhani Mlangizi Kuti Muone Zambiri\n\n";
							
						$response .= "1. Mr. Rabson Sayenda\n";
						$response .= "2. Mr. Kondwani Lusinje\n";
						$response .= "3. Dr. Nelson Kumbani\n";
						$response .= "4. Mr. Fredson Likhunya\n";
						$response .= "5. Kubwelera Pambuyo\n";
						$response .= "6. Kubwelera Kumayambiliro\n"; 
	
						// Print the response onto the page so that our gateway can read it
						header('Content-type: text/plain');
						echo $response;	
						}
					break;
					case "2":
						if($level==110){
						// Graduate user to level 14
						$sql4="UPDATE `session` SET `level`=113 /*46*/ where `session_id`='".$sessionId."'";
						$db->query($sql4);
	
						$response = "CON Alangizi A Ulimi Wa Ziweto\n";					
						$response .= "Sankhani Mlangizi Kuti Muone Zambiri\n\n";
							
						$response .= "1. Mr. Rabson Sayenda\n";
						$response .= "2. Mr. Kondwani Lusinje\n";
						$response .= "3. Dr. Nelson Kumbani\n";
						$response .= "4. Mr. Fredson Likhunya\n";
						$response .= "5. Kubwelera Pambuyo\n";
						$response .= "6. Kubwelera Kumayambiliro\n"; 
	
						// Print the response onto the page so that our gateway can read it
						header('Content-type: text/plain');
						echo $response;								
						}
					break;
					case "3":
						if($level==110){
						// Graduate user to level 14
						$sql4="UPDATE `session` SET `level`=115 /*48*/ where `session_id`='".$sessionId."'";
						$db->query($sql4);
	
						$response = "CON Alangizi A Ulimi Wa Mbalame\n";						
						$response .= "Sankhani Mlangizi Kuti Muone Zambiri\n\n";
							
						$response .= "1. Mr. Rabson Sayenda\n";
						$response .= "2. Mr. Kondwani Lusinje\n";
						$response .= "3. Dr. Nelson Kumbani\n";
						$response .= "4. Mr. Fredson Likhunya\n";
						$response .= "5. Kubwelera Pambuyo\n";
						$response .= "6. Kubwelera Kumayambiliro\n";  
	
						// Print the response onto the page so that our gateway can read it
						header('Content-type: text/plain');
						echo $response;								
						}
					break;
					case "4":
						if($level==110){	
							// Graduate user to level 1
							$sql4="UPDATE `session` SET `level`=69 where `session_id`='".$sessionId."'";
							$db->query($sql4);
	
							//Menu 2  Chichewa 
							//Serve Chichewa services menu
							$response = "Takulandirani Kuno Ku Farmers World\n";
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
						if($level==110){
							// Return user to Main Menu & Demote user's level
							$response = "CON Mwasankha Nambala Yolakwika\n";
							$response .= "Sankhani Glu Limodzi Kuti Muone Alangizi Ake\n";	
							$response .= "Magulu A Alangizi\n\n";
	
							$response .= "1. Ulimi Wa Za Kumunda\n";
							$response .= "2. Ulimi Wa Ziweto\n";
							$response .= "3. Ulimi Wa Mbalame\n";
							$response .= "4. Kubwelera Kumayambiliro\n";
								
							//update the level to 0 so that the session should start at level 1
							$sql4="UPDATE `session` SET `level`=110 where `session_id`='".$sessionId."'";
							$db->query($sql4);
	
							// Print the response onto the page so that our gateway can read it
							header('Content-type: text/plain');
							echo $response;	
						}
				}
			}
		}
		//Advisors of Crop Productions 
		else if($level==111){
			switch($userResponse){
				case "1":
					if($level==111){	
							// Graduate user to level 112
							$sql4="UPDATE `session` SET `level`=112 where `session_id`='".$sessionId."'";
							$db->query($sql4);						
							$response = "END Mlangizi Wa Ulimi Wa Zakumunda\n";
							$response .= "Zambiri Za Mlangizi\n\n";
							
							$response .= "Dzina			\t: Mr. Rabson Sayenda\n";
							$response .= "Namabala Ya Phone\t: 265886799210\n";
							$response .= "Nthawi Ya Ntchito\t: 8am - 6pm\n\n";
							
							$response .= "1. Kubwelera Pa Mbuyo\n";
							$response .= "2. Kubwelera Kumayambiliro\n";  
	
							// Print the response onto the page so that our gateway can read it
							header('Content-type: text/plain');
							echo $response;	
					}
				break;
					
				case "2":
					if($level==111){
							// Graduate user to level 45
							$sql4="UPDATE `session` SET `level`=112 where `session_id`='".$sessionId."'";
							$db->query($sql4);
	
							$response = "END Mlangizi Wa Ulimi Wa Zakumunda\n";
							$response .= "Zambiri Za Mlangizi\n\n";
							
							$response .= "Dzina			\t: Mr. Kondwani Lusinje\n";
							$response .= "Namabala Ya Phone\t: 265886799210\n";
							$response .= "Nthawi Ya Ntchito\t: 8am - 6pm\n\n";
							
							$response .= "1. Kubwelera Pa Mbuyo\n";
							$response .= "2. Kubwelera Kumayambiliro\n";	
	
							// Print the response onto the page so that our gateway can read it
							header('Content-type: text/plain');
							echo $response;								
					}
				break;
	
				case "3":
					if($level==111){
						// Graduate user to level 45
						$sql4="UPDATE `session` SET `level`=112 where `session_id`='".$sessionId."'";
						$db->query($sql4);
	
						$response = "END Mlangizi Wa Ulimi Wa Zakumunda\n";
						$response .= "Zambiri Za Mlangizi\n\n";
						
						$response .= "Dzina			\t: Mr. Nelson Kumbani\n"; //Should come from DataBase 
						$response .= "Namabala Ya Phone\t: 265886799210\n";
						$response .= "Nthawi Ya Ntchito\t: 8am - 6pm\n\n";
						
						$response .= "1. Kubwelera Pa Mbuyo\n";
						$response .= "2. Kubwelera Kumayambiliro\n"; 
						// Print the response onto the page so that our gateway can read it
						header('Content-type: text/plain');
						echo $response;								
					}
				break;
	
					case "4":
						if($level==111){
							// Graduate user to level 112
							$sql4="UPDATE `session` SET `level`=112 where `session_id`='".$sessionId."'";
							$db->query($sql4);
	
							$response = "END Mlangizi Wa Ulimi Wa Zakumunda\n";
							$response .= "Zambiri Za Mlangizi\n\n";
							
							$response .= "Dzina			\t: Mr. Fredson Likhunya\n";
							$response .= "Namabala Ya Phone\t: 265886799210\n";
							$response .= "Nthawi Ya Ntchito\t: 8am - 6pm\n\n";
							
							$response .= "1. Kubwelera Pa Mbuyo\n";
							$response .= "2. Kubwelera Kumayambiliro\n";  
	
							// Print the response onto the page so that our gateway can read it
							header('Content-type: text/plain');
							echo $response;								
						}
					break;
	
					case "5":
						if($level==111){							
							// Graduate user to level 14
							$sql4="UPDATE `session` SET `level`=110 where `session_id`='".$sessionId."'";
							$db->query($sql4);
	
							$response = "CON Alangizi A Ku Farmers World\n";
							$response .= "Magulu A Alangizi\n\n";
	
							$response .= "1. Ulimi Wa Za Kumunda\n";
							$response .= "2. Ulimi Wa Ziweto\n";
							$response .= "3. Ulimi Wa Mbalame\n";
							$response .= "4. Kubwelera Kumayambiliro\n";
	
							// Print the response onto the page so that our gateway can read it
							header('Content-type: text/plain');
							echo $response;	
						}
					break;
	
					case "6":
						if($level==111){							
							// graduate user to level 69						
							$sql2="UPDATE `session` SET `level`=69 where `session_id`='".$sessionId."'";
							$db->query($sql2);
							
							// Menu 2  Chichewa 
							//Serve Chichewa services menu
							$response = "Takulandirani Kuno Ku Farmers World\n";
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
						if($level==111){
							// Return user to Main Menu & Demote user's level
							$response = "CON Mwasankha Nambala Yolakwika, Chonde Yesaninso\n";
							$response .= "Alangizi A Ulimi Wa Zakumunda\n";
							$response .= "Sankhani Mlangizi Kuti Muone Zambiri\n\n";
							
							$response .= "1. Mr. Rabson Sayenda\n";
							$response .= "2. Mr. Kondwani Lusinje\n";
							$response .= "3. Dr. Nelson Kumbani\n";
							$response .= "4. Mr. Fredson Likhunya\n";
							$response .= "5. Kubwelera Pambuyo\n";
							$response .= "6. Kubwelera Kumayambiliro\n";; 
	
	
							//update the level to 0 so that the session should start at level 1
							$sql4="UPDATE `session` SET `level`=111 where `session_id`='".$sessionId."'";
							$db->query($sql4);
	
							// Print the response onto the page so that our gateway can read it
							header('Content-type: text/plain');
							echo $response;	
						}
			}				
		}		
		else if($level==112){
			if(!$userResponse==""){
				switch($userResponse){
					case "1":
						if($level==112){							
							// Graduate user to level 14
							$sql4="UPDATE `session` SET `level`=111 where `session_id`='".$sessionId."'";
							$db->query($sql4);
	
							$response = "CON Alangizi A Ulimi Wa Zakumunda\n";
							$response .= "Sankhani Mlangizi Kuti Muone Zambiri\n\n";
							
							$response .= "1. Mr. Rabson Sayenda\n";
							$response .= "2. Mr. Kondwani Lusinje\n";
							$response .= "3. Dr. Nelson Kumbani\n";
							$response .= "4. Mr. Fredson Likhunya\n";
							$response .= "5. Kubwelera Pambuyo\n";
							$response .= "6. Kubwelera Kumayambiliro\n"; 
	
							// Print the response onto the page so that our gateway can read it
							header('Content-type: text/plain');
							echo $response;	
						}
					break;
	
					case "2":   			// if the choice is 2 the user go to Chichewa version
						if($level==112){
							// graduate user to level 69
							$sql2="UPDATE `session` SET `level`=69 where `session_id`='".$sessionId."'";
							$db->query($sql2);
							
							// Menu 2  Chichewa 
							//Serve Chichewa services menu
							$response = "Takulandirani Kuno Ku Farmers World\n";
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
						if($level==112){
							
							$response = "END MWasankha NAmbala Yolakwika, Chonde Yesaninso\n";
	
							// Print the response onto the page so that our gateway can read it
							header('Content-type: text/plain');
							echo $response;	
						}
	
				} 
			}
		}
		//Advisors of Animal HUsbandly 
		else if($level==113){
			if(!$userResponse==""){
				
				switch($userResponse){
					case "1":
						if($level==113){							
						// Graduate user to level 45
						$sql4="UPDATE `session` SET `level`=114 where `session_id`='".$sessionId."'";
						$db->query($sql4);
	
						$response = "END Mlangizi Wa Ulimi Wa Ziweto\n";
						$response .= "Zambiri Za Mlangizi\n\n";
							
						$response .= "Dzina			\t: Mr. Rabson Sayenda\n"; //Should come from DataBase 
						$response .= "Namabala Ya Phone\t: 265886799210\n";
						$response .= "Nthawi Ya Ntchito\t: 8am - 6pm\n\n";
							
						$response .= "1. Kubwelera Pa Mbuyo\n";
						$response .= "2. Kubwelera Kumayambiliro\n"; 
	
						// Print the response onto the page so that our gateway can read it
						header('Content-type: text/plain');
						echo $response;	
						}
					break;
					
					case "2":
						if($level==113){
						// Graduate user to level 45
						$sql4="UPDATE `session` SET `level`=114 where `session_id`='".$sessionId."'";
						$db->query($sql4);
	
						$response = "END Mlangizi Wa Ulimi Wa Ziweto\n";
						$response .= "Zambiri Za Mlangizi\n\n";
							
						$response .= "Dzina			\t: Mr. Kondwani Lusinje\n"; //Should come from DataBase 
						$response .= "Namabala Ya Phone\t: 265886799210\n";
						$response .= "Nthawi Ya Ntchito\t: 8am - 6pm\n\n";
							
						$response .= "1. Kubwelera Pa Mbuyo\n";
						$response .= "2. Kubwelera Kumayambiliro\n";  
	
						// Print the response onto the page so that our gateway can read it
						header('Content-type: text/plain');
						echo $response;								
						}
					break;
	
					case "3":
						if($level==113){
						// Graduate user to level 45
						$sql4="UPDATE `session` SET `level`=114 where `session_id`='".$sessionId."'";
						$db->query($sql4);
	
						$response = "END Mlangizi Wa Ulimi Wa Ziweto\n";
						$response .= "Zambiri Za Mlangizi\n\n";
							
						$response .= "Dzina			\t: Mr. Nelson Kumbani\n"; //Should come from DataBase 
						$response .= "Namabala Ya Phone\t: 265886799210\n";
						$response .= "Nthawi Ya Ntchito\t: 8am - 6pm\n\n";
							
						$response .= "1. Kubwelera Pa Mbuyo\n";
						$response .= "2. Kubwelera Kumayambiliro\n";
	
						// Print the response onto the page so that our gateway can read it
						header('Content-type: text/plain');
						echo $response;								
						}
					break;
	
					case "4":
						if($level==113){
						// Graduate user to level 47
						$sql4="UPDATE `session` SET `level`=114 where `session_id`='".$sessionId."'";
						$db->query($sql4);
	
						$response = "END Mlangizi Wa Ulimi Wa Ziweto\n";
						$response .= "Zambiri Za Mlangizi\n\n";
							
						$response .= "Dzina			\t: Mr. Fredson Likhunya\n";//Should come from DataBase 
						$response .= "Namabala Ya Phone\t: 265886799210\n";
						$response .= "Nthawi Ya Ntchito\t: 8am - 6pm\n\n";
							
						$response .= "1. Kubwelera Pa Mbuyo\n";
						$response .= "2. Kubwelera Kumayambiliro\n";
	
						// Print the response onto the page so that our gateway can read it
						header('Content-type: text/plain');
						echo $response;								
						}
					break;
	
					case "5":
						if($level==113){							
							// Graduate user to level 110
							$sql4="UPDATE `session` SET `level`=110 where `session_id`='".$sessionId."'";
							$db->query($sql4);
	
							$response = "CON Alangizi A Ku Farmers World\n";
                     $response .= "Magulu A Alangizi\n\n";
	
							$response .= "1. Ulimi Wa Za Kumunda\n";
							$response .= "2. Ulimi Wa Ziweto\n";
							$response .= "3. Ulimi Wa Mbalame\n";
							$response .= "4. Kubwelera Pambuyo\n";
							$response .= "5. Kubwelera Kumayambiliro\n";
	
							// Print the response onto the page so that our gateway can read it
							header('Content-type: text/plain');
							echo $response;	
						}
					break;
	
					case "6":
						if($level==113){							
							// graduate user to level 69						
							$sql2="UPDATE `session` SET `level`=69 where `session_id`='".$sessionId."'";
							$db->query($sql2);
							
							// Menu 2  Chichewa 
							//Serve Chichewa services menu
							$$response = "Takulandirani Kuno Ku Farmers World\n";
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
						if($level==113){
							// Return user to Main Menu & Demote user's level
							$response = "CON MWasankha NAmbala Yolakwika, Chonde Yesaninso\n";
							$response .= "Alangizi A Ulimi Wa Ziweto\n";
							$response .= "Sankhani Mlangizi Kuti Muone Zambiri\n\n";
							
							$response .= "1. Mr. Rabson Sayenda\n";
							$response .= "2. Mr. Kondwani Lusinje\n";
							$response .= "3. Dr. Nelson Kumbani\n";
							$response .= "4. Mr. Fredson Likhunya\n";
							$response .= "5. Kubwelera Pambuyo\n";
							$response .= "6. Kubwelera Kumayambiliro\n"; 
	
	
							//update the level to 0 so that the session should start at level 1
							$sql4="UPDATE `session` SET `level`=103 where `session_id`='".$sessionId."'";
							$db->query($sql4);
	
							// Print the response onto the page so that our gateway can read it
							header('Content-type: text/plain');
							echo $response;	
						}
				}				
			}
		}
		else if($level==114){
			if(!$userResponse==""){
				switch($userResponse){
					case "1":
						if($level==114){							
							// Graduate user to level 14
							$sql4="UPDATE `session` SET `level`=113 where `session_id`='".$sessionId."'";
							$db->query($sql4);
											   
							$response = "CON Alangizi A Ulimi Wa Ziweto\n";
							$response .= "Sankhani Mlangizi Kuti Muone Zambiri\n\n";
							
							$response .= "1. Mr. Rabson Sayenda\n";
							$response .= "2. Mr. Kondwani Lusinje\n";
							$response .= "3. Dr. Nelson Kumbani\n";
							$response .= "4. Mr. Fredson Likhunya\n";
							$response .= "5. Kubwelera Pambuyo\n";
							$response .= "6. Kubwelera Kumayambiliro\n";
	
							// Print the response onto the page so that our gateway can read it
							header('Content-type: text/plain');
							echo $response;	
						}
					break;
					case "2":   			// if the choice is 2 the user go to Chichewa version
						if($level==114){
							// graduate user to level 69
							$sql2="UPDATE `session` SET `level`=69 where `session_id`='".$sessionId."'";
							$db->query($sql2);
							
							// Menu 2  Chichewa 
							//Serve Chichewa services menu
							$response = "Takulandirani Kuno Ku Farmers World\n";
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
						if($level==114){
							
							$response = "END MWasankha NAmbala Yolakwika, Chonde Yesaninso\n";
	
							// Print the response onto the page so that our gateway can read it
							header('Content-type: text/plain');
							echo $response;	
						}
	
				} 
			}
		}
		//Advisors of Poultry Farming
		else if($level==115){
			if(!$userResponse==""){
				switch($userResponse){
					case "1":
						if($level==115){							
						// Graduate user to level 45
						$sql4="UPDATE `session` SET `level`=116 where `session_id`='".$sessionId."'";
						$db->query($sql4);
	
						$response = "END Mlangizi Wa Ulimi Wa Mbalame\n";
						$response .= "Zambiri Za Mlangizi\n\n";
							
						$response .= "Dzina			\t: Mr. Rabson Sayenda\n";//Should come from DataBase 
						$response .= "Namabala Ya Phone\t: 265886799210\n";
						$response .= "Nthawi Ya Ntchito\t: 8am - 6pm\n\n";
							
						$response .= "1. Kubwelera Pa Mbuyo\n";
						$response .= "2. Kubwelera Kumayambiliro\n"; 
						 
						// Print the response onto the page so that our gateway can read it
						header('Content-type: text/plain');
						echo $response;	
						}
					break;
					
					case "2":
						if($level==115){
						// Graduate user to level 45
						$sql4="UPDATE `session` SET `level`=116 where `session_id`='".$sessionId."'";
						$db->query($sql4);
	
						$response = "END Mlangizi Wa Ulimi Wa Mbalame\n";
						$response .= "Zambiri Za Mlangizi\n\n";
							
						$response .= "Dzina			\t: Mr. Kondwani Lusinje\n";//Should come from DataBase 
						$response .= "Namabala Ya Phone\t: 265886799210\n";
						$response .= "Nthawi Ya Ntchito\t: 8am - 6pm\n\n";
							
						$response .= "1. Kubwelera Pa Mbuyo\n";
						$response .= "2. Kubwelera Kumayambiliro\n"; 
	
						// Print the response onto the page so that our gateway can read it
						header('Content-type: text/plain');
						echo $response;								
						}
					break;
	
					case "3":
						if($level==115){
						// Graduate user to level 116
						$sql4="UPDATE `session` SET `level`=116 where `session_id`='".$sessionId."'";
						$db->query($sql4);
	
						$response = "END Mlangizi Wa Ulimi Wa Mbalame\n";
						$response .= "Zambiri Za Mlangizi\n\n";
						
						$response .= "Dzina			\t: Mr. Nelson Kumbani\n"; //Should come from DataBase 
						$response .= "Namabala Ya Phone\t: 265886799210\n";
						$response .= "Nthawi Ya Ntchito\t: 8am - 6pm\n\n";
						
						$response .= "1. Kubwelera Pa Mbuyo\n";
						$response .= "2. Kubwelera Kumayambiliro\n"; 
	
						// Print the response onto the page so that our gateway can read it
						header('Content-type: text/plain');
						echo $response;								
						}
					break;
	
					case "4":
						if($level==115){
						// Graduate user to level 45
						$sql4="UPDATE `session` SET `level`=116 where `session_id`='".$sessionId."'";
						$db->query($sql4);
	
						$response = "END Mlangizi Wa Ulimi Wa Mbalame\n";
						$response .= "Zambiri Za Mlangizi\n\n";
						
						$response .= "Dzina			\t: Mr. Fredson Likhunya\n"; //Should come from DataBase 
						$response .= "Namabala Ya Phone\t: 265886799210\n";
						$response .= "Nthawi Ya Ntchito\t: 8am - 6pm\n\n";
						
						$response .= "1. Kubwelera Pa Mbuyo\n";
						$response .= "2. Kubwelera Kumayambiliro\n";  
	
						// Print the response onto the page so that our gateway can read it
						header('Content-type: text/plain');
						echo $response;								
						}
					break;
	
					case "5":
						if($level==115){							
							// Graduate user to level 14
							$sql4="UPDATE `session` SET `level`=110 where `session_id`='".$sessionId."'";
							$db->query($sql4);
	
                     $response = "CON Alangizi A Ku Farmers World\n";
                     $response .= "Magulu A Alangizi\n\n";
	
							$response .= "1. Ulimi Wa Za Kumunda\n";
							$response .= "2. Ulimi Wa Ziweto\n";
							$response .= "3. Ulimi Wa Mbalame\n";
							$response .= "4. Kubwelera Pambuyo\n";
							$response .= "5. Kubwelera Kumayambiliro\n";
	
							// Print the response onto the page so that our gateway can read it
							header('Content-type: text/plain');
							echo $response;	
						}
					break;
	
					case "6":
						if($level==115){							
							// graduate user to level 69						
							$sql2="UPDATE `session` SET `level`=69 where `session_id`='".$sessionId."'";
							$db->query($sql2);
							
							// Menu 2  Chichewa 
							//Serve Chichewa services menu
							$response = "Takulandirani Kuno Ku Farmers World\n";
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
						if($level==115){
							// Return user to Main Menu & Demote user's level
							$response = "CON MWasankha NAmbala Yolakwika, Chonde Yesaninso\n";
							$response = "Alangizi A Ulimi Wa Mbalame\n";
							$response = "Sankhani Mlangizi Kuti Muone Zambiri\n\n";
						
							$response .= "1. Mr. Rabson Sayenda\n";
							$response .= "2. Mr. Kondwani Lusinje\n";
							$response .= "3. Dr. Nelson Kumbani\n";
							$response .= "4. Mr. Fredson Likhunya\n";
							$response .= "5. Kubwelera Pambuyo\n";
							$response .= "6. Kubwelera Kumayambiliro\n";  
	
	
							//update the level to 0 so that the session should start at level 1
							$sql4="UPDATE `session` SET `level`=115 where `session_id`='".$sessionId."'";
							$db->query($sql4);
	
							// Print the response onto the page so that our gateway can read it
							header('Content-type: text/plain');
							echo $response;	
						}
				}				
			}
		}
		else if($level==116){
			if(!$userResponse==""){
				switch($userResponse){
					case "1":
						if($level==116){							
							// Graduate user to level 14
							$sql4="UPDATE `session` SET `level`=115 where `session_id`='".$sessionId."'";
							$db->query($sql4);
	
							$response = "CON Alangizi A Ulimi Wa Mbalame\n";						
							$response .= "Sankhani Mlangizi Kuti Muone Zambiri\n\n";
							
							$response .= "1. Mr. Rabson Sayenda\n";
							$response .= "2. Mr. Kondwani Lusinje\n";
							$response .= "3. Dr. Nelson Kumbani\n";
							$response .= "4. Mr. Fredson Likhunya\n";
							$response .= "5. Kubwelera Pambuyo\n";
							$response .= "6. Kubwelera Kumayambiliro\n";
	
							// Print the response onto the page so that our gateway can read it
							header('Content-type: text/plain');
							echo $response;	
						}
					break;
	
					case "2":   			// if the choice is 2 the user go to Chichewa version
						if($level==116){
							// graduate user to level 69
							$sql2="UPDATE `session` SET `level`=69 where `session_id`='".$sessionId."'";
							$db->query($sql2);
							
							// Menu 2  Chichewa 
							//Serve Chichewa services menu
							$response = "Takulandirani Kuno Ku Farmers World\n";
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
						if($level==116){
							
							$response = "END MWasankha NAmbala Yolakwika, Chonde Yesaninso\n";
	
							// Print the response onto the page so that our gateway can read it
							header('Content-type: text/plain');
							echo $response;	
						}
				} 
			}
		}
	    //Farm Management Menu
		else if($level==117){
			if(!$userResponse==""){
				switch($userResponse){
					case "1":
						if($level==117){							
						// Graduate user to level 14
						$sql4="UPDATE `session` SET `level`=118 where `session_id`='".$sessionId."'";
						$db->query($sql4);
						
						$response = "CON  Kusamala Za Kumunda\n";
						$response .= "Kuwerengeresera Za Kumunda\n";
						$response .= "Chimanga\n\n";
	
						$response .= "1. Tumizani Mlingo Omwe mukufuna Kukolora\n";
						$response .= "2. Kubwelera Pambuyo\n";
						$response .= "3. Kubwelera Kumayambiliro\n";
						
						// Print the response onto the page so that our gateway can read it
						header('Content-type: text/plain');
						echo $response;	
						}
					break;
	
					case "2":
						if($level==117){							
						// Graduate user to level 14
						$sql4="UPDATE `session` SET `level`=120 where `session_id`='".$sessionId."'";
						$db->query($sql4);
						
						$response = "CON  Kusamala Za Kumunda\n";
						$response .= "Kuwerengeresera Za Kumunda\n";
						$response .= "Cotton\n\n";
	
						$response .= "1. Tumizani Mlingo Omwe mukufuna Kukolora\n";
						$response .= "2. Kubwelera Pambuyo\n";
						$response .= "3. Kubwelera Kumayambiliro\n";
						
						// Print the response onto the page so that our gateway can read it
						header('Content-type: text/plain');
						echo $response;	
						}
					break;
	
					case "3":
						if($level==117){							
						// Graduate user to level 14
						$sql4="UPDATE `session` SET `level`=122 where `session_id`='".$sessionId."'";
						$db->query($sql4);
						
						$response = "CON  Kusamala Za Kumunda\n";
						$response .= "Kuwerengeresera Za Kumunda\n";
						$response .= "Fodya\n\n";
	
						$response .= "1. Tumizani Mlingo Omwe mukufuna Kukolora\n";
						$response .= "2. Kubwelera Pambuyo\n";
						$response .= "3. Kubwelera Kumayambiliro\n";
						
						
						// Print the response onto the page so that our gateway can read it
						header('Content-type: text/plain');
						echo $response;	
						}
					break;
	
					case "4":
						if($level==117){							
						// Graduate user to level 14
						$sql4="UPDATE `session` SET `level`=124 where `session_id`='".$sessionId."'";
						$db->query($sql4);
						
						$response = "CON  Kusamala Za Kumunda\n";
						$response .= "Kuwerengeresera Za Kumunda\n";
						$response .= "Soya\n\n";
	
						$response .= "1. Tumizani Mlingo Omwe mukufuna Kukolora\n";
						$response .= "2. Kubwelera Pambuyo\n";
						$response .= "3. Kubwelera Kumayambiliro\n";
						
						
						// Print the response onto the page so that our gateway can read it
						header('Content-type: text/plain');
						echo $response;	
						}
					break;
	
					case "5":
						if($level==117){							
							// Graduate user to level 69
							$sql4="UPDATE `session` SET `level`=69 where `session_id`='".$sessionId."'";
							$db->query($sql4);
						
							// Menu 2  Chichewa 
							//Serve Chichewa services menu
							$response = "Takulandirani Kuno Ku Farmers World\n";
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
						if($level==117){
							// Return user to Main Menu & Demote user's level
							$response = "CON Mwalowetsa Nambala Yolakwika\n"; // Subject to change
							$response .= "Mwasankha Kuwelengela Zokolora\n"; 
							$response .= "Tumizani Mbewu Mukufuna Kukolora\n\n";
									
							$response .= "1. Chimanga\n";
							$response .= "2. Cotton\n";
							$response .= "3. Fodya\n";
							$response .= "4. Soya\n";
							$response .= "5. Kubwelera Kumayambiliro\n";
														
							//update the level to 0 so that the session should start at level 1
							$sql4="UPDATE `session` SET `level`=117 where `session_id`='".$sessionId."'";
							$db->query($sql4);
	
							// Print the response onto the page so that our gateway can read it
							header('Content-type: text/plain');
							echo $response;	
						}
				}
			}
		}
		//Maize Menu
		else if($level==118){
			if(!$userResponse==""){
				switch($userResponse){
					case "1":
						if($level==118){							
						// Graduate user to level 14
						$sql4="UPDATE `session` SET `level`=119 where `session_id`='".$sessionId."'";
						$db->query($sql4);
	
						$response = "END  Chigawo Chosamala Za Chuma\n";
						$response .= "Kuwerengesera Malimidwe\n\n";
						
						$response .= "Mwasankha Kuzakolora {Amount}Kgs Ya Chimanga.\nZofunika kuti Mukolore Zochuluka Choncho\nZitumizidwa Posachedwa Pa Uthenga Wa Mmanja\n\nZikomo Pogwilitsa Ntchito Makina Athu\n\n";
	
						$response .= "1. Kubwelera Kumayambiliro\n\n";
	
						// Print the response onto the page so that our gateway can read it
						header('Content-type: text/plain');
						echo $response;	
						}
					break;
	
					case "2":
						if($level==118){							
							// Graduate user to level 14
							$sql4="UPDATE `session` SET `level`=117 where `session_id`='".$sessionId."'";
							$db->query($sql4);
	
							$response = "CON Mwasankha Nambala Yolakwika, Chonde Yeselaninso\n"; // Subject to change
							$response .= "Mwasankha Kuwelengela Zokolora\n"; 
							$response .= "Tumizani Mbewu Mukufuna Kukolora\n\n";
							
							$response .= "1. Chimanga\n";
							$response .= "2. Cotton\n";
							$response .= "3. Fodya\n";
							$response .= "4. Soya\n";
							$response .= "5. Kubwelera Kumayambiliro\n";
	
							// Print the response onto the page so that our gateway can read it
							header('Content-type: text/plain');
							echo $response;	
						}
					break;
	
					case "3":
						if($level==118){							
							// graduate user to level 69						
							$sql2="UPDATE `session` SET `level`=69 where `session_id`='".$sessionId."'";
							$db->query($sql2);
							
							// Menu 2  Chichewa 
							//Serve Chichewa services menu
							$response = "Takulandirani Kuno Ku Farmers World\n";
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
						if($level==118){
							// Return user to Main Menu & Demote user's level
							$response = "END Mwasakha ambala Yolakwika, Chonde Yselaninso.\n";
														
							//update the level to 0 so that the session should start at level 1
							$sql4="UPDATE `session` SET `level`=118 where `session_id`='".$sessionId."'";
							$db->query($sql4);
	
							// Print the response onto the page so that our gateway can read it
							header('Content-type: text/plain');
							echo $response;	
						}
				}
			}
		}
		else if($level==119){
			if(!$userResponse==""){
				switch($userResponse){
					case "1":
						if($level==119){							
							// Graduate user to level 69
							$sql4="UPDATE `session` SET `level`=69 where `session_id`='".$sessionId."'";
							$db->query($sql4);
	
							// Menu 2  Chichewa 
							//Serve Chichewa services menu
							$response = "Takulandirani Kuno Ku Farmers World\n";
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
						if($level==119){
							// Return user to Main Menu & Demote user's level
							$response = "CON Mwasankha Nambala Yolakwika, Chonde Yeselaninso\n";
														
							//update the level to 0 so that the session should start at level 1
							$sql4="UPDATE `session` SET `level`=119 where `session_id`='".$sessionId."'";
							$db->query($sql4);
	
							// Print the response onto the page so that our gateway can read it
							header('Content-type: text/plain');
							echo $response;	
						}
				}	
			}
		}
		//Cotton Menu
		else if($level==120){
			if(!$userResponse==""){
				switch($userResponse){
					case "1":
						if($level==120){							
						// Graduate user to level 14
						$sql4="UPDATE `session` SET `level`=54 where `session_id`='".$sessionId."'";
						$db->query($sql4);
	
						$response = "END  Chigawo Chosamala Za Chuma\n";
						$response .= "Kuwerengesera Malimidwe\n\n";
						
						$response .= "Mwasankha Kuzakolora {Amount}Kgs Ya Cotton.\nZofunika kuti Mukolore Zochuluka Choncho\nZitumizidwa Posachedwa Pa Uthenga Wa Mmanja\n\nZikomo Pogwilitsa Ntchito Makina Athu\n\n";
	
						$response .= "1. Kubwelera Kumayambiliro\n\n";
	
						// Print the response onto the page so that our gateway can read it
						header('Content-type: text/plain');
						echo $response;	
						}
					break;
					
					case "2":
						if($level==120){							
							// Graduate user to level 14
							$sql4="UPDATE `session` SET `level`=117 where `session_id`='".$sessionId."'";
							$db->query($sql4);
	
							$response = "CON Mwasankha Nambala Yolakwika, Chonde Yeselaninso\n";
							$response .= "Mwasankha Kuwelengela Zokolora\n"; 
							$response .= "Tumizani Mbewu Mukufuna Kukolora\n\n";
							
							$response .= "1. Chimanga\n";
							$response .= "2. Cotton\n";
							$response .= "3. Fodya\n";
							$response .= "4. Soya\n";
							$response .= "5. Kubwelera Kumayambiliro\n";
	
							// Print the response onto the page so that our gateway can read it
							header('Content-type: text/plain');
							echo $response;	
						}
					break;
	
					case "3":
						if($level==120){							
							// graduate user to level 69						
							$sql2="UPDATE `session` SET `level`=2 where `session_id`='".$sessionId."'";
							$db->query($sql2);
							
							// Menu 2  Chichewa 
							//Serve Chichewa services menu
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
						if($level==120){
							// Return user to Main Menu & Demote user's level
							$response = "END Wrong Option\n";
							$response .= "Please Try Again\n";
														
							//update the level to 0 so that the session should start at level 1
							$sql4="UPDATE `session` SET `level`=120 where `session_id`='".$sessionId."'";
							$db->query($sql4);
	
							// Print the response onto the page so that our gateway can read it
							header('Content-type: text/plain');
							echo $response;	
						}
				}
			}
		}
		else if($level==121){
			if(!$userResponse==""){
				switch($userResponse){
					case "1":
						if($level==121){							
							// Graduate user to level 14
							$sql4="UPDATE `session` SET `level`=69 where `session_id`='".$sessionId."'";
							$db->query($sql4);
	
							// Menu 2  Chichewa 
							//Serve Chichewa services menu
							$response = "Takulandirani Kuno Ku Farmers World\n";
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
						if($level==121){
							// Return user to Main Menu & Demote user's level
							$response = "Mwasankha Nambala Yolakwika, Chonde Yeselaninso\n";
														
							//update the level to 0 so that the session should start at level 1
							$sql4="UPDATE `session` SET `level`=121 where `session_id`='".$sessionId."'";
							$db->query($sql4);
	
							// Print the response onto the page so that our gateway can read it
							header('Content-type: text/plain');
							echo $response;	
						}
				}	
			}
		}
		//Tobbaco Menu
		else if($level==122){
			if(!$userResponse==""){
				switch($userResponse){
					case "1":
						if($level==122){							
						// Graduate user to level 122
						$sql4="UPDATE `session` SET `level`=123 where `session_id`='".$sessionId."'";
						$db->query($sql4);
	
						$response = "END  Chigawo Chosamala Za Chuma\n";
						$response .= "Kuwerengesera Malimidwe\n\n";
						
						$response .= "Mwasankha Kuzakolora {Amount}Kgs Wa Fodya.\nZofunika kuti Mukolore Zochuluka Choncho\nZitumizidwa Posachedwa Pa Uthenga Wa Mmanja\n\nZikomo Pogwilitsa Ntchito Makina Athu\n\n";
	
						$response .= "1. Kubwelera Kumayambiliro\n\n";
	
						// Print the response onto the page so that our gateway can read it
						header('Content-type: text/plain');
						echo $response;	
						}
					break;
	
					case "2":
						if($level==122){							
							// Graduate user to level 117
							$sql4="UPDATE `session` SET `level`=117 where `session_id`='".$sessionId."'";
							$db->query($sql4);
	
							$response = "CON Mwasankha Number Yolakwika, Chonde Yeselaninso\n";
							$response .= "Mwasankha Kuwelengela Zokolora\n"; 
							$response .= "Tumizani Mbewu Mukufuna Kukolora\n\n";
								
							$response .= "1. Chimanga\n";
							$response .= "2. Cotton\n";
							$response .= "3. Fodya\n";
							$response .= "4. Soya\n";
							$response .= "5. Kubwelera Kumayambiliro\n";
	
							// Print the response onto the page so that our gateway can read it
							header('Content-type: text/plain');
							echo $response;	
						}
					break;
	
					case "3":
						if($level==122){							
							// graduate user to level 69						
							$sql2="UPDATE `session` SET `level`=69 where `session_id`='".$sessionId."'";
							$db->query($sql2);
							
							// Menu 2  Chichewa 
							//Serve Chichewa services menu
							$response = "Takulandirani Kuno Ku Farmers World\n";
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
						if($level==122){
							// Return user to Main Menu & Demote user's level
							$response = "Mwasankha Nambala Yolakwika, Chonde Yeselaninso\n";
														
							//update the level to 0 so that the session should start at level 1
							$sql4="UPDATE `session` SET `level`=122 where `session_id`='".$sessionId."'";
							$db->query($sql4);
	
							// Print the response onto the page so that our gateway can read it
							header('Content-type: text/plain');
							echo $response;	
						}
				}
			}
		}
		else if($level==123){
			if(!$userResponse==""){
				switch($userResponse){
					case "1":
						if($level==123){							
							// Graduate user to level 14
							$sql4="UPDATE `session` SET `level`=69 where `session_id`='".$sessionId."'";
							$db->query($sql4);
	
							// Menu 2  Chichewa 
							//Serve Chichewa services menu
							$response = "Takulandirani Kuno Ku Farmers World\n";
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
						if($level==123){
							// Return user to Main Menu & Demote user's level
							$response = "Mwasankha Nambala Yolakwika, Chonde Yeselaninso\n";
														
							//update the level to 0 so that the session should start at level 1
							$sql4="UPDATE `session` SET `level`=123 where `session_id`='".$sessionId."'";
							$db->query($sql4);
	
							// Print the response onto the page so that our gateway can read it
							header('Content-type: text/plain');
							echo $response;	
						}
				}	
			}
		}
		//Soya Beans Menu
		else if($level==124){
			if(!$userResponse==""){
				switch($userResponse){
					case "1":
						if($level==124){							
						// Graduate user to level 58
						$sql4="UPDATE `session` SET `level`=125 where `session_id`='".$sessionId."'";
						$db->query($sql4);
	
						$response = "END  Chigawo Chosamala Za Chuma\n";
						$response .= "Kuwerengesera Malimidwe\n\n";
						
						$response .= "Mwasankha Kuzakolora {Amount}Kgs Ya Soya.\nZofunika kuti Mukolore Zochuluka Choncho\nZitumizidwa Posachedwa Pa Uthenga Wa Mmanja\n\nZikomo Pogwilitsa Ntchito Makina Athu\n\n";
	
						$response .= "1. Kubwelera Kumayambiliro\n\n";
	
						// Print the response onto the page so that our gateway can read it
						header('Content-type: text/plain');
						echo $response;	
						}
					break;
	
					case "2":
						if($level==124){							
							// Graduate user to level 14
							$sql4="UPDATE `session` SET `level`=117 where `session_id`='".$sessionId."'";
							$db->query($sql4);
	
							$response = "CON Mwasankha Number Yolakwika, Chonde Yeselaninso\n";
							$response .= "Mwasankha Kuwelengela Zokolora\n"; 
							$response .= "Tumizani Mbewu Mukufuna Kukolora\n\n";
							
							$response .= "1. Chimanga\n";
							$response .= "2. Cotton\n";
							$response .= "3. Fodya\n";
							$response .= "4. Soya\n";
							$response .= "5. Kubwelera Kumayambiliro\n";
	
							// Print the response onto the page so that our gateway can read it
							header('Content-type: text/plain');
							echo $response;	
						}
					break;
	
					case "3":
						if($level==124){							
							// graduate user to level 69						
							$sql2="UPDATE `session` SET `level`=69 where `session_id`='".$sessionId."'";
							$db->query($sql2);
							
							// Menu 2  Chichewa 
							//Serve Chichewa services menu
							$response = "Takulandirani Kuno Ku Farmers World\n";
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
						if($level==124){
							// Return user to Main Menu & Demote user's level
							$response = "END Mwasankha Nambala Yolakwika, Chonde Yeselaninso\n";
														
							//update the level to 0 so that the session should start at level 1
							$sql4="UPDATE `session` SET `level`=124 where `session_id`='".$sessionId."'";
							$db->query($sql4);
	
							// Print the response onto the page so that our gateway can read it
							header('Content-type: text/plain');
							echo $response;	
						}
				}
			}
		}
		else if($level==125){
			if(!$userResponse==""){
				switch($userResponse){
					case "1":
						if($level==125){							
							// Graduate user to level 14
							$sql4="UPDATE `session` SET `level`=69 where `session_id`='".$sessionId."'";
							$db->query($sql4);
	
							// Menu 2  Chichewa 
							//Serve Chichewa services menu
							$response = "Takulandirani Kuno Ku Farmers World\n";
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
						if($level==125){
							// Return user to Main Menu & Demote user's level
							$response = "END Mwasankha Nambala Yolakwika, Chande Yeselaninso\n";
														
							//update the level to 0 so that the session should start at level 1
							$sql4="UPDATE `session` SET `level`=125 where `session_id`='".$sessionId."'";
							$db->query($sql4);
	
							// Print the response onto the page so that our gateway can read it
							header('Content-type: text/plain');
							echo $response;	
						}
				}	
			}
		}
		//Notification Menu in Chichewa
		else if($level==126){
				if(!$userResponse==""){
					switch($userResponse){
						case "1":
							if($level==126){							
							// Graduate user to level 4
							$sql4="UPDATE `session` SET `level`=127 where `session_id`='".$sessionId."'";
							$db->query($sql4);
	
							$response = "CON Gawo La Mauthenga\n";
							$response .= "Mauthenga Olandilidwa\n\n"; //Mauthenga
							
							$response .= "1. Uthenga 1\n";
							$response .= "2. Uthenga 2\n";
							$response .= "3. Uthenga 3\n";
							$response .= "4. Kubwelera Pambuyo\n";
							$response .= "5. Kubwelera Kumayambiliro\n";
														
							// Print the response onto the page so that our gateway can read it
							header('Content-type: text/plain');
							echo $response;	
							}
						break;
	
						case "2":   			// if the choice is 1 the user go to English version
							if($level==126){
								// Graduate user to level 2
								$sql2="UPDATE `session` SET `level`=69 where `session_id`='".$sessionId."'";
								$db->query($sql2);
								//Menu 2  English
								//Serve English services menu
								$response = "CON  Takulandirani Kuno Ku Farmers World\n";
								$response .= "Zikomo Posankha Chichewa\n";
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
							if($level==126){
									  // Return user to Main Menu & Demote user's level
									  $response = "CON Mwasankha Nambala Yolakwika, Chonde Yeselaninso";
									  $response .= "CON Gawo la Mauthenga Ku Farmers World\n";
									  $response .= "Mwasankha Mauthenga\n\n";
									  
									  $response .= "1. Mauthenga Olandilidwa\n";
									  $response .= "2. Kubwelera Kumayambiliro";
																
							    //update the level to 0 so that the session should start at level 1
							    $sql4="UPDATE `session` SET `level`=126 where `session_id`='".$sessionId."'";
							    $db->query($sql4);
	
							   // Print the response onto the page so that our gateway can read it
							   header('Content-type: text/plain');
							   echo $response;	
							}
					}
				}
		}
		else if($level==127){
			if(!$userResponse==""){
				switch($userResponse){
					case "1":
							if($level==127){							
								//Graduate user to level 126
								$sql4="UPDATE `session` SET `level`=126 where `session_id`='".$sessionId."'";
								$db->query($sql4);
	
								$response = "CON Gawo La Mauthenga\n";
								$response .= "Uthenga 1\n\n";
								
								$response .= "Okondedwa Sir/Madam\n\nKusatila zomwe munafunsa pa zolima Fodya,\nZosatilazi ndi zofunika kuti mukolore 20000kg ya Fodya\n>20Kgs ya Mbewu\n>100Kgs ya Feteleza\n>Nyengo yotenthelako\n\n";
		
								$response .= "1. Kubwelera Pambuyo\n";
								$response .= "2. Kubwelera Kumayambiliro\n";
	
								// Print the response onto the page so that our gateway can read it
								header('Content-type: text/plain');
								echo $response;	
							}
						break;
	
						case "2":
							if($level==127){							
								//Graduate user to level 126 
								$sql4="UPDATE `session` SET `level`=126 where `session_id`='".$sessionId."'";
								$db->query($sql4);
	
								$response = "CON Gawo La Mauthenga\n";
								$response .= "Uthenga 2\n\n";
								
								$response .= "Okondedwa Sir/Madam\n\nMalonda anu ofuna kugulisa 2000Kgs ya\nCotton ku Blantyre ADMARC wavomelezedwa.\n\nChonde pitani ku Blantyre ADMARC ndi Nambala ya Order\npasanafike pa 31 July\n\nOrder Number: KOND123LAD\n\n";
		
								$response .= "1. Kubwelera Pambuyo\n";
								$response .= "2. Kubwelera Kumayambiliro\n";
	
								// Print the response onto the page so that our gateway can read it
								header('Content-type: text/plain');
								echo $response;	
							}
						break;
	
						case "3":
							if($level==127){							
								//Graduate user to level 126
								$sql4="UPDATE `session` SET `level`=126 where `session_id`='".$sessionId."'";
								$db->query($sql4);
	
								$response = "CON Gawo La Mauthenga\n";
								$response .= "Uthenga 3\n\n";
								
								$response .= "Okondwedwa Sir/Madam\n\nTafuna kukuziwitsani kuti tikukonza Makina athu\n\nPachifukwa ichi mbali zina sizimagwira\n\nTikupepesa chifukwa cha zovuta zomwe zingabwele kamba kavutoli.\n\n";
		
								$response .= "1. Kubwelera Pambuyo\n";
								$response .= "2. Kubwelera Kumayambiliro\n";
	
								// Print the response onto the page so that our gateway can read it
								header('Content-type: text/plain');
								echo $response;	
						}
						break;
	
						case "4":   			
							if($level==127){
							//Downgrade user to level 126
								$sql4="UPDATE `session` SET `level`=126 where `session_id`='".$sessionId."'";
								$db->query($sql4);
									
								$response = "CON Gawo La Mauthenga\n";
								$response .= "Mwasankha Mwauthenga\n\n";
								
								$response .= "1. Mauthenga Olandilidwa\n";
								$response .= "2. Kubwelera Kumayambiliro\n";

								// Print the response onto the page so that our gateway can read it																	
								header('Content-type: text/plain');
								echo $response;	
							}
						break;
						
						case "5":
							if($level==127){	
								// Graduate user to level 1
								$sql4="UPDATE `session` SET `level`=69 where `session_id`='".$sessionId."'";
								$db->query($sql4);
	
								//Menu 2  English
								//Serve English services menu
								$response = "Takulandirani Kuno Ku Farmers World\n";
								$response .= "Zikomo Posankha Chichewa\n";
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
							if($level==127){
								// Return user to Main Menu & Demote user's level
								$response = "CON Mwasankha Nambala Yolakwika, Chonde Yeselaninso.\n";
								$response .= "Gawo La Mauthenga\n";
								$response .= "Received Notifications\n\n"; //Mauthenga
							
								$response .= "1. Uthenga 1\n";
								$response .= "2. Uthenga 2\n";
								$response .= "3. Uthenga 3\n";
								$response .= "4. Kubwelera Pambuyo\n";
								$response .= "5. Kubwelera Kumayambiliro\n";
	
								//update the level to 0 so that the session should start at level 1
								$sql4="UPDATE `session` SET `level`=127 where `session_id`='".$sessionId."'";
								$db->query($sql4);
	
								// Print the response onto the page so that our gateway can read it
								header('Content-type: text/plain');
								echo $response;	
							}
					}
				}
		}			
      	//My Account Menu 
      	else if($level==128){
         	if(!$userResponse==""){
            	switch($userResponse){
               		case "1":
                  		if($level==128){                     
                  		// Graduate user to level 14
                  		$sql4="UPDATE `session` SET `level`=129 where `session_id`='".$sessionId."'";
                  		$db->query($sql4);

						  $response = "CON Gawo Losithira Akaunti Yanga\n";
						  $response .= "Sithani Zofunikira Za Akaunti Yanu\n\n";
	  
						  $response .= "1. Sithani Dzina\n";
						  $response .= "2. Sithani Dela Lomwe Mukukhala \n";
						  $response .= "3. Kubwera Pambuyo\n";
						  $response .= "4. Kubwelera Kumayambiliro\n";

                  		// Print the response onto the page so that our gateway can read it
                  		header('Content-type: text/plain');
                  		echo $response;   
                  }
               break;
               case "2":
                  if($userResponse){
                  // Graduate user to level 14
                  $sql4="UPDATE `session` SET `level`=134 where `session_id`='".$sessionId."'";
                  $db->query($sql4);

                  $sql5 = "SELECT * FROM farmer WHERE phonenumber LIKE '%".$phoneNumber."%' LIMIT 1";
                  $fQuery=$db->query($sql5);
                  $Available=$fQuery->fetch_assoc();

				  $response = "CON Wonani Za Akaunti Yanu\n";
				  $response .= "Za Akaunti Yanga\n\n";
				  
				  $response .= "Dzina Lanu      \t : ".$Available['name']."\n";
				  $response .= "Sex		    	\t : ".$Available['sex']."\n";	
				  $response .= "Nambala Ya ID	\t : ".$Available['id_number']."\n";
				  $response .= "Foni Yanu       \t : ".$Available['phonenumber']."\n";	
				  $response .= "Komwe Mumakhala \t : ".$Available['location']."\n";

				  $response .= "1. Kubwera Pambuyo\n";
				  $response .= "2. Kubwelera Kumayambiliro\n";
                  

                  // Print the response onto the page so that our gateway can read it
                  header('Content-type: text/plain');
                  echo $response;

                  }
               break;

               case "3": // the choice is 2 the user go to Chichewa version
                  if($level==128){
                     // Graduate user to level 2
                     $sql2="UPDATE `session` SET `level`=69 where `session_id`='".$sessionId."'";
                     $db->query($sql2);
                     // Menu 2  Chichewa
                     //Serve Chichewa services menu
					 $response = "CON  Takulandirani Kuno Ku Farmers World\n";
					 $response .= "Zikomo Posankha Chichewa\n";
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
                  if($level==128){
                     // Return user to Main Menu & Demote user's level
					 $response = "CON Mwasankha Number Yolakwika\n";
					 $response .= "Yeseraninso Kulowesa numbala yoyonera\n\n";

					 $response .= "1. Sithani Za Akaunti Yanu\n";
					 $response .= "2. Wonani Za Akaunti Yanu \n";
					 $response .= "3. Kubwelera Pambuyo\n";
                     
                     //update the level to 0 so that the session should start at level 1
                     $sql4="UPDATE `session` SET `level`=128 where `session_id`='".$sessionId."'";
                     $db->query($sql4);

                     // Print the response onto the page so that our gateway can read it
                     header('Content-type: text/plain');
                     echo $response;   
                  }
            }
         }
      	}
      	//Changing Account Name and Location
     	else if($level==129){
         	if(!$userResponse==""){
            	switch($userResponse){
               		case "1":
                  		if($level==129){
                     
                     		// Graduate user to level 130
                     		$sql4="UPDATE `session` SET `level`=130 where `session_id`='".$sessionId."'";
							 $db->query($sql4);
							 
							 $response = "CON Kusintha Akaunti\n";
							 $response .= "Kusintha Dzina\n\n";
	 
							 $response .= "Chonde Lembani Dzina Lanu Latsopano\n";
                  
                     		// Print the response onto the page so that our gateway can read it
                     		header('Content-type: text/plain');
                     		echo $response;   
                  		}
               		break;
               		case "2":
                  		if($level==129){
                                                            
                     	// Graduate user to level 132
                     	$sql4="UPDATE `session` SET `level`=132 where `session_id`='".$sessionId."'";
                     	$db->query($sql4);

						 $response = "CON Kusintha Akaunti\n";
						 $response .= "Kusintha Dela Lokhala\n\n";
 
						 $response .= "Chonde Lembani Dela Lanu Latsopano\n";
                  
                     	// Print the response onto the page so that our gateway can read it
                     	header('Content-type: text/plain');
                     	echo $response;   
                  		}
               		break;
               		case "3":
                  		if($level==129){                     
                    		 // Graduate user to level 128
                     		$sql4="UPDATE `session` SET `level`=128 where `session_id`='".$sessionId."'";
                     		$db->query($sql4);

							 $response = "CON Gawo La Akaunti Yanga Ku Farmers World \n";
							 $response .= "Mwasankha Za Akaunti Yanu\n\n";
	 
							 $response .= " 1. Sinthani Za Akaunti Yanu \n";
							 $response .= " 2. Wonani Za Akaunti Yanu \n";
							 $response .= " 3. Kubwerera Koyambilira";
                            
                  
                     		// Print the response onto the page so that our gateway can read it
                     		header('Content-type: text/plain');
                     		echo $response;   
                  		}
              		break;

               		case "4":            // if the choice is 1 the user go to Chichewa version
                        if($level==129){
                            // Graduate user to level 2
                            $sql2="UPDATE `session` SET `level`=69 where `session_id`='".$sessionId."'";
                            $db->query($sql2);
                            //Menu 2  Chichewa
                            //Serve Chichewa services menu
							$response = "CON  Takulandirani Kuno Ku Farmers World\n";
							$response .= "Zikomo Posankha Chichewa\n";
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
                  		if($level==129){
                     		// Return user to Main Menu & Demote user's level
							 $response = "CON Mwasankha Nambala Yolakwika, Chonde Yeselaninso\n";
							 $response .= "CON Gawo Losithira Akaunti Yanga\n";
							 $response .= "Sithani Zofunikira Za Akaunti Yanu\n\n";
		 
							 $response .= "1. Sithani Dzina\n";
							 $response .= "2. Sithani Dela Lomwe Mukukhala \n";
							 $response .= "3. Kubwera Pambuyo\n";
							 $response .= "4. Kubwelera Kumayambiliro\n";

                     		//update the level to 0 so that the session should start at level 1
                     		$sql4="UPDATE `session` SET `level`=129 where `session_id`='".$sessionId."'";
                     		$db->query($sql4);

                     		// Print the response onto the page so that our gateway can read it
                     		header('Content-type: text/plain');
                     		echo $response;   
                		}
            	}
         	}
      	}
      	else if($level==130){
			if(!$userResponse==""){
				
				// Graduate user to level 130
				$sql4="UPDATE `session` SET `level`=131 where `session_id`='".$sessionId."'";
				$db->query($sql4);

				//Update User Name
				$sql4 = "UPDATE farmer SET `name`='".$userResponse."' WHERE `phonenumber` LIKE '%". $phoneNumber ."%'";
				$db->query($sql4);

				$sql5 = "SELECT `name` FROM farmer WHERE phonenumber LIKE '%".$phoneNumber."%' LIMIT 1";
				$fQuery=$db->query($sql5);
				$Available=$fQuery->fetch_assoc();

				$response = "END Kusintha Akaunti\n";
				$response .= "Kusintha Dzina Lanu\n\n";
				
				$response .= "Mwakwanitsa Kusintha Dzina Lanu\n";
				$response .= "Dzina Lanu Latsopano Ndi\t: ".$Available['name']."\n\n";

				$response .= "1. Kubwelera Pambuyo\n";
				$response .= "2. Kubwelera Kumayambiliro\n";
				
				// Print the response onto the page so that our gateway can read it
				header('Content-type: text/plain');
				echo $response;
				
			}
      	}
      	else if($level==131){
         	if(!$userResponse==""){       //checking that that the user input is not empty
				switch ($userResponse){    // from this point we are using user input as a case variable
				case "1":
					if($level==131){                     
					// Graduate user to level 130
					$sql4="UPDATE `session` SET `level`=129 where `session_id`='".$sessionId."'";
					$db->query($sql4);

					$response = "CON Gawo Losithira Akaunti Yanga\n";
					$response .= "Sithani Zofunikira Za Akaunti Yanu\n\n";

					$response .= "1. Sithani Dzina\n";
					$response .= "2. Sithani Dela Lomwe Mukukhala\n";
					$response .= "3. Kubwera Pambuyo\n";
					$response .= "4. Kubwelera Kumayambiliro\n";

					// Print the response onto the page so that our gateway can read it
					header('Content-type: text/plain');
					echo $response;   
					}
				break;
				case "2":            // if the choice is 2 the user go to nglish version
					if($level==131){
						// Graduate user to level 2
						$sql2="UPDATE `session` SET `level`=69 where `session_id`='".$sessionId."'";
						$db->query($sql2);
						// Menu 2  Chichewa
						//Serve Chichewa services menu
						$response = "CON  Takulandirani Kuno Ku Farmers World\n";
						$response .= "Zikomo Posankha Chichewa\n";
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
					if($level==131){
						$sql5 = "SELECT `name` FROM farmer WHERE phonenumber LIKE '%".$phoneNumber."%' LIMIT 1";
						$fQuery=$db->query($sql5);
						$Available=$fQuery->fetch_assoc();

						$response = "END Mwasankha Nambala Yolakwika, Chaopnde Yeselaninso\n";
						$response .= "Kusintha Dzina Lanu\n\n";
						
						$response .= "Mwakwanitsa Kusintha Dzina Lanu\n";
						$response .= "Dzina Lanu Latsopano Ndi\t: ".$Available['name']."\n\n";
			
						$response .= "1. Kubwelera Pambuyo\n";
						$response .= "2. Kubwelera Kumayambiliro\n";
						
						//update the level to 0 so that the session should start at level 1
						$sql4="UPDATE `session` SET `level`=131 where `session_id`='".$sessionId."'";
						$db->query($sql4);
		
						// Print the response onto the page so that our gateway can read it
						header('Content-type: text/plain');
						echo $response;   
					}
				}
			}
      	}
      	//Changing Location
      	else if($level==132){
			if(!$userResponse==""){
				
				// Graduate user to level 130
				$sql4="UPDATE `session` SET `level`=133 where `session_id`='".$sessionId."'";
				$db->query($sql4);

				//Update District Name
				$sql4 = "UPDATE farmer SET `location`='".$userResponse."' WHERE `phonenumber` LIKE '%". $phoneNumber ."%'";
				$db->query($sql4);

				//Getting the new set location from the database
				$sql5 = "SELECT `location` FROM farmer WHERE phonenumber LIKE '%".$phoneNumber."%' LIMIT 1";
				$fQuery=$db->query($sql5);
				$Available=$fQuery->fetch_assoc();

				$response = "END Kusintha Akaunti\n\n";

				$response .= "Mwakwanitsa Kusintha Dela Lanu\nn";
				$response .= "Dela Lanu Latsopano Ndi\t: ".$Available['location']."\n\n";

				$response .= "1. Kubwelera Pambuyo\n";
				$response .= "2. Kubwelera Kumayambiliro\n";
				
				// Print the response onto the page so that our gateway can read it
				header('Content-type: text/plain');
				echo $response;
				
			}
      	}
      	else if($level==133){
         if(!$userResponse==""){       //checking that that the user input is not empty
            switch ($userResponse){    // from this point we are using user input as a case variable
               case "1":
                  if($level==133){                     
                  // Graduate user to level 14
                  $sql4="UPDATE `session` SET `level`=129 where `session_id`='".$sessionId."'";
                  $db->query($sql4);

				  $response = "CON Gawo Losithira Akaunti Yanga\n";
				  $response .= "Sithani Zofunikira Za Akaunti Yanu\n\n";

				  $response .= "1. Sithani Dzina\n";
				  $response .= "2. Sithani Dela Lomwe Mukukhala\n";
				  $response .= "3. Kubwera Pambuyo\n";
				  $response .= "4. Kubwelera Kumayambiliro\n";

                  // Print the response onto the page so that our gateway can read it
                  header('Content-type: text/plain');
                  echo $response;   
                  }
               break;
               case "2":            // if the choice is 2 the user go to nglish version
                  if($level==133){
                     // Graduate user to level 2
                     $sql2="UPDATE `session` SET `level`=69 where `session_id`='".$sessionId."'";
                     $db->query($sql2);
                     // Menu 2  Chichewa
                     //Serve Chichewa services menu
					 $response = "CON  Takulandirani Kuno Ku Farmers World\n";
					 $response .= "Zikomo Posankha Chichewa\n";
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
                  if($level==133){
                     $sql5 = "SELECT `location` FROM farmer WHERE phonenumber LIKE '%".$phoneNumber."%' LIMIT 1";
                     $fQuery=$db->query($sql5);
                     $Available=$fQuery->fetch_assoc();

					 $response = "END Mwasankha Nambala Yolakwika, Chonde Yeselaninso";
					 $response .= "Kusintha Dela\n\n";

					 $response .= "Mwakwanitsa Kusintha Dela Lanu\n";            
					 $response .= "Dela Lanu Latsopano Ndi\t: ".$Available['location']."\n\n";
		 
					 $response .= "1. Kubwelera Pambuyo\n";
					 $response .= "2. Kubwelera Kumayambiliro\n";
                     
                     //update the level to 0 so that the session should start at level 1
                     $sql4="UPDATE `session` SET `level`=133 where `session_id`='".$sessionId."'";
                     $db->query($sql4);
      
                     // Print the response onto the page so that our gateway can read it
                     header('Content-type: text/plain');
                     echo $response;   
                  }
            }
         }
      	}
  		else if($level==134){
         if(!$userResponse==""){       //checking that that the user input is not empty
            switch ($userResponse){    // from this point we are using user input as a case variable
               case "1":            // if the choice is 1 the user go to nglish version
                  if($level==134){
                     
                     // Graduate user to level 2
                     $sql2="UPDATE `session` SET `level`=128 where `session_id`='".$sessionId."'";
                     $db->query($sql2);
                     //Serve the Account Menu
					 $response = "CON Gawo La Akaunti Yanga Ku Farmers World \n";
					 $response .= "Mwasankha Za Akaunti Yanu\n\n";

					 $response .= " 1. Sinthani Za Akaunti Yanu \n";
					 $response .= " 2. Wonani Za Akaunti Yanu \n";
					 $response .= " 3. Kubwerera Koyambilira";
                            
                     // Print the response onto the page so that our gateway can read it
                     header('Content-type: text/plain');
                     echo $response;
                  }
               break;

               case "2": // the choice is 2 the user go to Chichewa version
                  if($level==134){
                     // Graduate user to level 2
                     $sql2="UPDATE `session` SET `level`=69 where `session_id`='".$sessionId."'";
                     $db->query($sql2);
                     // Menu 2  Chichewa
                     //Serve Chichewa services menu
					 $response = "CON  Takulandirani Kuno Ku Farmers World\n";
					 $response .= "Zikomo Posankha Chichewa\n";
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
                  if($level==134){
                     // Return user to Main Menu & Demote user's level
					 $response = "CON Mwasankha Nambala Yolakwika, Chonde Yeselaninso\n";
					 $response .= "Mwasankha Za Akaunti Yanu\n\n";

					 $response .= " 1. Sinthani Za Akaunti Yanu \n";
					 $response .= " 2. Wonani Za Akaunti Yanu \n";
					 $response .= " 3. Kubwerera Koyambilira";
                            
                     //update the level to 0 so that the session should start at level 1
                     $sql4="UPDATE `session` SET `level`=128 where `session_id`='".$sessionId."'";
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

        //Check that users response is not empty
        if($userResponse==""){

            //On receiving a blank, Advise User to input correctly based on level
            switch($level){

               	case 0:
				       // Graduate the user to the next level, so you dont serve them the same menu
				    $sql = "INSERT INTO `session`(`session_id`, `phonenumber`,`level`) VALUES('".$sessionId."','".$phoneNumber."', 1)";
                  	$db->query($sql);
                     
				    // Insert the phoneNumber, since it comes with the first POST
				    $sql = "INSERT INTO farmer(`phonenumber`) VALUES ('".$phoneNumber."')";
                  	$db->query($sql);
                     
				    // Serve the menu request for name
				    $response = "CON you are not registered\n";
                    $response .= "Please Enter Your Full Name To Register";
                     
			  		// Print the response onto the page so that our gateway can read it
			  		header('Content-type: text/plain');
 			  		echo $response;	
                break;
                    
				case 1:
			    	// Request again for district - level has not changed...
                    $response = "CON District Name Not supposed To Be Empty.\nPlease Enter Your District Name\n";
                    
			  		// Print the response onto the page so that our gateway can read it
			  		header('Content-type: text/plain');
 			  		echo $response;	
                    break;
                    
			    case 2:
			    	// Request for city again --- level has not changed...
                    $response = "CON ID Number Is Not Supposed To Be Empty.\nPlease Enter Your ID Number\n";

			  		// Print the response onto the page so that our gateway can read it
			  		header('Content-type: text/plain');
 			  		echo $response;	
                    break;
                    
			    default:
			    	// End the session
                    $response = "END Apologies, something went wrong ...\n";
                    
			  		// Print the response onto the page so that our gateway can read it
			  		header('Content-type: text/plain');
 			  		echo $response;	
			        break;
            } 
        }

        else{

            // Update User table based on input to correct level
			switch($level){

			    case 0:
				    // Graduate the user to the next level, so you dont serve them the same menu
				     $sql = "INSERT INTO `session`(`session_id`, `phonenumber`,`level`) VALUES('".$sessionId."','".$phoneNumber."', 1)";
				     $db->query($sql);
				     
					 // Insert the phoneNumber, since it comes with the first POST
				     $sql = "INSERT INTO farmer (`phonenumber`) VALUES ('".$phoneNumber."')";
				     $db->query($sql);
				     
					 // Serve the menu request for name
				     $response = "CON Please enter your First and Last name";
			  		
					// Print the response onto the page so that our gateway can read it
			  		header('Content-type: text/plain');
				  		echo $response;	
				break;
				
				case 1:
			    	// Update Name, and Request for District Name
			        $sql = "UPDATE farmer SET `name`='".$userResponse."' WHERE `phonenumber` LIKE '%". $phoneNumber ."%'";
			        $db->query($sql);
			        
					//11c. We graduate the user to the district level
			        $sql = "UPDATE `session` SET `level`=2 WHERE `session_id`='".$sessionId."'";
			        $db->query($sql);
			        
					//Requestion Gender
					$response = "CON Select Your Gender\n\n";
					
			  		$response .= "1. Male\n";
					$response .= "2. Female\n";
					$response .= "3. Others\n";

					
					// Print the response onto the page so that our gateway can read it
			  		header('Content-type: text/plain');
				  		echo $response;	
                break;
                	    
			    case 2:
			    	//11d. Update Gender
			        $sql11d = "UPDATE farmer SET `sex`='".$userResponse."' WHERE `phonenumber` = '". $phoneNumber ."'";
			        $db->query($sql11d);
					
					if($userResponse==1){
						$sql11d = "UPDATE farmer SET `sex`='Male' WHERE `phonenumber` = '". $phoneNumber ."'";
						$db->query($sql11d);
					}elseif($userResponse==2){
						$sql11d = "UPDATE farmer SET `sex`='Female' WHERE `phonenumber` = '". $phoneNumber ."'";
						$db->query($sql11d);	
					}elseif($userResponse==3){
						$sql11d = "UPDATE farmer SET `sex`='Others' WHERE `phonenumber` = '". $phoneNumber ."'";
						$db->query($sql11d);
					}else{
						$response = "Wrong Selection Please Restart";	        	   	
						
						// Print the response onto the page so that our gateway can read it
						header('Content-type: text/plain');
						echo $response;	
						break;						
					}
					//11c. We graduate the user to the district level
			        $sql = "UPDATE `session` SET `level`=3 WHERE `session_id`='".$sessionId."'";
			        $db->query($sql);
			        
					//Requestion District name
			        $response = "CON Enter Your District\n";

					
					// Print the response onto the page so that our gateway can read it
			  		header('Content-type: text/plain');
				  		echo $response;	
                break;

                case 3:    
                    // Update District Name
                    $sql = "UPDATE farmer SET `location`='".$userResponse."' WHERE `phonenumber` LIKE '%". $phoneNumber ."%'";
                    $db->query($sql);
                    
                    // Change level to 3
                    $sql = "UPDATE `session` SET `level`=4 WHERE `session_id`='".$sessionId."'";
                    $db->query($sql);  
                    
                    // Serve the menu request for name
                    $response = "CON Enter Your ID Number\n";        	   	
                    
                    // Print the response onto the page so that our gateway can read it
                    header('Content-type: text/plain');
                    echo $response;	
                break;
                case 4:
                    // Update Identification Number
                    $sql = "UPDATE farmer SET `id_number`='".$userResponse."' WHERE `phonenumber` = '". $phoneNumber ."'";
                    $db->query($sql);
                    
                   // Change level to 0
                   $sql = "UPDATE `session` SET `level`=0 WHERE `session_id`='".$sessionId."'";
                   $db->query($sql);  
                   
                   // Serve the menu request for name
                   $response = "END You have been successfully registered";	        	   	
                    
                    // Print the response onto the page so that our gateway can read it
                    header('Content-type: text/plain');
                    echo $response;	
				break;
					        		        		        
                default:
                    //11g. Request for city again
                    $response = "END Apologies, something went wrong ...\n";
                    // Print the response onto the page so that our gateway can read it
                    header('Content-type: text/plain');
                    echo $response;	
                    break;
            }	
        }
    }
?>  
    }
}
