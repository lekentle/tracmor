<?php 
        header("Content-Type: application/json; charset=UTF-8");                                
        error_log("Entering Api"); 
       
	require_once('../includes/prepend.inc.php');
	//QApplication::Authenticate(3);
	//require_once(__FOjkkRMBASE_CLASSES__ . '/UserAccountListFormBase.class.php');


        
        class Api{
            
            
            private $apicall;
            private $response;
            private $request;
            
            function __construct($call, $payload) {
                
                $this->response =  array();
                $this->apicall = $call;
                $this->request = $payload;
                //Default response
                $response['error'] = true; 
                $response['message'] = 'Invalid Operation Called';
             }

            
            function isTheseParametersAvailable($params){

                foreach($params as $param){
                    if(!isset($payload[$param])){
                            return false; 
                    }
                }
                return true; 
            }
            
            function syncLoookups (){
                
                
            }
            
            function login (){
                
               
       		if(isTheseParametersAvailable(array('username', 'password'))){
					
                    $username = $payload['username'];
                    $password = $payload['password']; 

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
            }

            function uploadInventory (){
                
            }
            
            public function getResponse(){
                
            return $this->response;
            }
            
        }
        
        error_log("Api Call:". $_GET['apicall']); 
        
        $api = new Api($_GET['apicall'], $_POST);
        
        echo json_encode($api->getResponse());
	
