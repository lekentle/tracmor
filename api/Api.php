<?php 
                        
        error_log("Entering Api"); 
        
	require_once '../includes/configuration.inc.php';
	require_once '../includes/UserAccount.class.php';
        
	$response = array();
	
	if(isset($_GET['apicall'])){
		
		switch($_GET['apicall']){
			
			case 'sync':
				if(isTheseParametersAvailable(array('username','email','password','gender'))){

					
				}else{
					$response['error'] = true; 
					$response['message'] = 'required parameters are not available'; 
				}
				
			break; 
                        
			case 'upload':
				if(isTheseParametersAvailable(array('username','email','password','gender'))){

					
				}else{
					$response['error'] = true; 
					$response['message'] = 'required parameters are not available'; 
				}
				
			break; 
			
			case 'login':
				
				if(isTheseParametersAvailable(array('username', 'password'))){
					
                                    $username = $_POST['username'];
                                    $password = $_POST['password']; 

                                    $objUserAccount = UserAccount::LoadByUsername($username);


                                    // Check if that username exists
                                    if (!$objUserAccount) {
                                        $response['error'] = true; 
                                        $response['message'] = 'Invalid username or password.'; 

                                        // Check that the user account is Active
                                    }elseif (!$objUserAccount->ActiveFlag) {
                                        $response['error'] = true; 
                                        $response['message'] = 'The account is disabled. please contact the administrator.';

                                    }
                                    // Check to see if the password hashes match
                                    elseif (!QApplication::CheckPassword(sha1($password), $objUserAccount->PasswordHash)) {
                                        $response['error'] = true; 
                                        $response['message'] = 'Wrong password.';
                                    }
                                    else {
                                        
                                        $response['error'] = false; 
                                        $response['message'] = 'Login successfull'; 
                                        $response['user'] = $user; 

                                    }
						
				}
			break; 
			
			default: 
				$response['error'] = true; 
				$response['message'] = 'Invalid Operation Called';
		}
		
	}else{
		$response['error'] = true; 
		$response['message'] = 'Invalid API Call';
	}
	
	echo json_encode($response);
	
	function isTheseParametersAvailable($params){
		
		foreach($params as $param){
			if(!isset($_POST[$param])){
				return false; 
			}
		}
		return true; 
	}