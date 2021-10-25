<?php

# load libraries and declare the auth0 obj 
//require(PAGES_SITE_ROOT.'/vendor/autoload.php');
//use josegonzalez\Dotenv\Loader;
use Auth0\SDK\Auth0;
use Auth0\SDK\Exception\CoreException;
use Auth0\SDK\Exception\ApiException;
//use Auth0\SDK\Store\SessionStore;

// Get our persistent storage interface to get the stored userinfo.
//$store = new SessionStore();

// load chargebee sdk
use ChargeBee\ChargeBee\Environment;
use ChargeBee\ChargeBee\Models\Customer;

Environment::configure(getenv('CB_TEST_CLIENT'),getenv('CB_TEST_KEY'));

//$Dotenv = new Loader(KOOWA_ROOT.'/config/.env');
//$Dotenv->parse()->putenv(true);

$auth0 = new Auth0([
  'domain' => getenv('AUTH0_DOMAIN'),
  'client_id' => getenv('AUTH0_CLIENT_ID'),
  'client_secret' => getenv('AUTH0_CLIENT_SECRET'),
  'redirect_uri' => getenv('AUTH0_REDIRECT_URI').'/auth',
  'scope' => 'openid profile email users read:user_metadata',
  'persist_id_token' => true,
  'persist_access_token' => true,
  'persist_refresh_token' => true
]);

# class for Auth0 and ChargeBee written by Gurman.
class CBAuth0_API{
    
    # declare the Array to hold the Credentials
    var $_query=array();
    
    # init the constructor to set the credentials in variable 
    # and make available for all functions
    function __construct() {
        $this->_query = array(
                "grant_type"=>"client_credentials",
                "client_id"=>getenv('AUTH0_M2M_CLIENT_ID'),
                "client_secret"=>getenv('AUTH0_M2M_CLIENT_SECRET'),
                "audience"=>"https://under-the-radar-report.au.auth0.com/api/v2/"
            );
        # prepare url
        $this->url="https://".getenv('AUTH0_DOMAIN');
      }

    # @func to get bearer token by sending credentials, it will return the token
    function __getToken(){
        
        $httpHeader=array("content-type: application/x-www-form-urlencoded");
        
        # init the request to send POST Request
        $res=$this->__sendRequest($this->url."/oauth/token", http_build_query($this->_query), $httpHeader, "POST");
        
        # decode the response from curl
        $encArr=json_decode($res);

        # get bearer access token
        if(isset($encArr->access_token) && !empty($encArr->access_token)){
            $token=$encArr->access_token;
        } else {$token='';}
        return $token;
    }
    
    # @func, POST user data to Auth0 to create user tenant by authenticating with bearer token
    # @return, it will return the boolean true/false
    # $para token, it accepts the bearer token from the other function
    # @para $userData, it accepts the array of user data recieved by Chargebee
    function __createUser($customer){

        # String of all alphanumeric character
        $str_result='0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';

        # set random password
        $hashedPass='$'.substr(str_shuffle($str_result), 0, 8).'#';

        # set the data to send to Auth0 API to create user
        $userData=array(
              "user_metadata"=>array("chargeBee_ID"=>$customer['id']),
              "email"=>$customer['email'],
              "password"=>$hashedPass,
              "blocked"=>false,
              "email_verified"=>false,
              "given_name"=>$customer['first_name'],
              "family_name"=>$customer['last_name'],
              "name"=> $customer['first_name'].' '.$customer['last_name'],
              "nickname"=>$customer['email'],
              //"picture"=>"https://secure.gravatar.com/avatar/15626c5e0c749cb912f9d1ad48dba440?s=480&r=pg&d=https%3A%2F%2Fssl.gstatic.com%2Fs2%2Fprofiles%2Fimages%2Fsilhouette80.png",
              //"connection"=>""connection"=>"google-oauth2",
              "connection"=>"Username-Password-Authentication",
              "verify_email"=>false
            );

        # get bearer access token
        $token=$this->__getToken();
        
        # check if we get the token
        if($token!==''){
            $httpHeader=array("authorization: Bearer {$token}", "content-type: application/json");
            $decodedRes=json_decode($this->__sendRequest($this->url."/api/v2/users", json_encode($userData), $httpHeader, "POST"));
            
            if(isset($decodedRes->email)){
              $this->__setUserRole($decodedRes->user_id);
              $this->__sendResetPasswordEmail($decodedRes->email);
              return json_encode(array("status"=>"success", "msg"=>"User created successfully!"));
            } 
            else if($decodedRes->statusCode==409){
              return json_encode(array("status"=>"error", "msg"=>"User already exists!"));
            } else{return json_encode($decodedRes);}
        }else{
            return json_encode(array("status"=>"error", "msg"=>"Error in getting Bearer Token."));
        } 
    }

    # @func, POST user data to Auth0 to set user tenant role by authenticating with bearer token
    # @return, it will return the boolean true/false
    # @para $userID, it accepts the ID of the Auth0 user
    function __setUserRole($userID){

        # set the data to send to Auth0 API to create user
        $userData=array(
              "roles"=>["rol_YS3Qu5V5EapkS8tl"]
            );

        # get bearer access token
        $token=$this->__getToken();
        
        # check if we get the token
        if($token!==''){
            $httpHeader=array("authorization: Bearer {$token}", "content-type: application/json");
            $decodedRes=json_decode($this->__sendRequest($this->url."/api/v2/users/".$userID."/roles", json_encode($userData), $httpHeader, "POST"), TRUE);
            return json_encode(array("status"=>"success", "msg"=>"rol_YS3Qu5V5EapkS8tl")); 
        }else{
            return json_encode(array("status"=>"error", "msg"=>"Error in getting Bearer Token."));
        } 
    }
    
    # @func search existing user by 
    # @param Array and EMAIL
    # @param Array and ROLE
    # RolesID : ROLES
    # rol_YS3Qu5V5EapkS8tl : Small Caps Subscriber
    function __searchUserBy($customer, $by){
        
        # get bearer access token
        $token=$this->__getToken();
 
        # check if we get token
        if($token!==''){
            $httpHeader=array("authorization: Bearer {$token}", "content-type: application/json");
            
            if($by=="EMAIL"){
                $decodedRes=json_decode($this->__sendRequest($this->url."/api/v2/users?q=email:".$customer['email']."&search_engine=v3", array(), $httpHeader, "GET"));
                return json_encode(array("status"=>"success", "msg"=>count($decodedRes), "user"=>$decodedRes[0]));
            }elseif($by="ROLE"){
                $httpHeader=array("authorization: Bearer {$token}", "content-type: application/json");
                $decodedRes=json_decode($this->__sendRequest($this->url."/api/v2/users/".$customer['sub']."/roles", array(), $httpHeader, "GET"), TRUE);
                return json_encode(array("status"=>"success", "msg"=>$decodedRes[0]['id']));
            }
        }else{
            return json_encode(array("status"=>"error", "msg"=>"Error in getting Bearer Token."));
        } 
    }
    
    # @func search existing user by 
    # @param email of the user
    function __sendResetPasswordEmail($email){
        
        # get bearer access token
        $token=$this->__getToken();
 
        # check if we get token
        if($token!==''){
            $httpHeader=array("authorization: Bearer {$token}", "content-type: application/json");

            # set the data to send to Auth0 API to create user
            $userData=array(
                  "email"=>$email,
                  "connection"=>"Username-Password-Authentication"
                );
            
            $decodedRes=json_decode($this->__sendRequest($this->url."/dbconnections/change_password", json_encode($userData), $httpHeader, "POST"));
            return json_encode(array("status"=>"success", "msg"=>"Sent"));

        }else{
            return json_encode(array("status"=>"error", "msg"=>"Error in getting Bearer Token."));
        } 
    }
    
    # @func send the cURL request
    # @param send the endpoint
    # @param send the query/payload
    # @param send the header
    # @param send the GET/POST method
    function __sendRequest($endPoint, $query, $httpHeader, $method){
        
        $curl = curl_init();
        if(!empty($query)){
            curl_setopt_array($curl, [
              CURLOPT_URL => $endPoint,
              CURLOPT_RETURNTRANSFER => true,
              CURLOPT_ENCODING => "",
              CURLOPT_MAXREDIRS => 10,
              CURLOPT_TIMEOUT => 30,
              CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
              CURLOPT_CUSTOMREQUEST => $method,
              CURLOPT_POSTFIELDS => $query,
              CURLOPT_HTTPHEADER => $httpHeader
            ]);
        }else{ //echo $endPoint;
            curl_setopt_array($curl, [
              CURLOPT_URL => $endPoint,
              CURLOPT_RETURNTRANSFER => true,
              CURLOPT_ENCODING => "",
              CURLOPT_MAXREDIRS => 10,
              CURLOPT_TIMEOUT => 30,
              CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
              CURLOPT_CUSTOMREQUEST => $method,
              CURLOPT_HTTPHEADER => $httpHeader
            ]);
        }

        $res = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
          echo "cURL Error #:" . $err;
        } else {
            #echo '<br />In Response: <pre>'; print_r($res); echo '</pre>'; //die;
            return $res;
        }
    }
}

?>