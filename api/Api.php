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
                $this->response['error'] = true; 
                $this->response['message'] = 'Invalid Operation Called';
                
                $this->processCall();
             }
            
            private function processCall() {
                
                 switch ($this->apicall){
                    case 'login' : return $this->login();
                        break;
                    default : return $this->response;
                }
              
                
            } 
            
            private function isTheseParametersAvailable($params){

                foreach($params as $param){
                    if(!isset($this->request[$param])){
                            return false; 
                    }
                }
                return true; 
            }
            
            private function syncLoookups (){
                 
            }
            
            private function login (){
                
               
       		if($this->isTheseParametersAvailable(array('username', 'password'))){
					
                    $username = $this->request['username'];
                    $password = $this->request['password']; 

                    $objUserAccount = UserAccount::LoadByUsername($username);


                    // Check if that username exists
                    if (!$objUserAccount) {
                        $this->response['error'] = true; 
                        $this->response['message'] = 'Invalid username or password.'; 

                        // Check that the user account is Active
                    }elseif (!$objUserAccount->ActiveFlag) {
                        $this->response['error'] = true; 
                        $this->response['message'] = 'The account is disabled. please contact the administrator.';

                    }
                    // Check to see if the password hashes match
                    elseif (!QApplication::CheckPassword(sha1($password), $objUserAccount->PasswordHash)) {
                        $this->response['error'] = true; 
                        $this->response['message'] = 'Wrong password.';
                    }
                    else {

                        $this->response['error'] = false; 
                        $this->response['message'] = 'Login successfull'; 
                        $user = array(
                                    'id'=>$objUserAccount->UserAccountId, 
                                    'fullname'=>$objUserAccount->FirstName . ' ' . $objUserAccount->LastName,
                                    'username'=>$username,
                                    'password'=>$objUserAccount->PasswordHash);
                        $this->response['user'] = $user; 

                    }
                }
            }

            function uploadInventory (){
                
            }
            
            public function getResponse(){

                return $this->response;
            }
            
        }
        

        
        $api = new Api($_GET['apicall'], $_POST);
        
        echo json_encode($api->getResponse());
	
