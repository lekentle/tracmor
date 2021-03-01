<?php 
        header("Content-Type: application/json; charset=UTF-8");                                
        error_log("Entering Api"); 
       
	require_once('../includes/prepend.inc.php');
	//QApplication::Authenticate(3);


        
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
                    case 'sync'  : return $this->syncLoookups();
                        break;
                    case 'upload': return $this->uploadInventory();
                        break;
                    case 'verify': return $this->verifyInventory();
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
                
                $categories = Category::LoadAllAsCustomArray(false, true);
                
                
                if (!is_null($categories) && count($categories) > 0)
                {
                    $this->response['error'] = false; 
                    $this->response['message'] = 'Category retrieval successful'; 
                    $this->response['categoroes']    = $categories;
                } else if (count($categories) == 0){
                    $this->response['error'] = false; 
                    $this->response['message'] = 'List of categories is empty'; 
                    $this->response['categoroes']    = array();
                }

                $locations = Location::LoadAllLocationsAsCustomArray();
                
                
                if (!is_null($locations) && count($locations) > 0)
                {
                    $this->response['error'] = false; 
                    $this->response['message'] = 'Location retrieval successful'; 
                    $this->response['areas']    = $locations;
                } else if (count($locations) == 0){
                    $this->response['error'] = false; 
                    $this->response['message'] = 'List of locations is empty'; 
                    $this->response['areas']    = array();
                }
                
                $manufactures = Manufacturer::LoadAllAsCustomArray();
                
                
                if (!is_null($manufactures) && count($manufactures) > 0)
                {
                    $this->response['error'] = false; 
                    $this->response['message'] = 'Manufacturers retrieval successful'; 
                    $this->response['manufactures']    = $manufactures;
                } else if (count($locations) == 0){
                    $this->response['error'] = false; 
                    $this->response['message'] = 'List of manufactures is empty'; 
                    $this->response['manufactures']    = array();
                }
                
                 
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
            
            function verifyInventory (){
                
            }
            
            public function getResponse(){

                return $this->response;
            }
            
        }
        

        
        $api = new Api($_GET['apicall'], $_POST);
        
        echo json_encode($api->getResponse());
	
