<?php

use Firebase\JWT\JWT;

if(! function_exists('create_jwt')){
    /**
	 * 
	 * Create JWT with passed parameter in array 
	 *
	 * @param string|array   $value     Values that need to be set in the JWT
	 *
	 * @return mixed|array 
	 */
    function create_jwt($value){
        $time = time();
        $payload = array(
            "iss" => base_url(),
            "aud" => "user",
            "iat" => $time,
            "exp" => $time + 36000,
            "nbf" => $time,
            "id"  => $value
        );

        return $jwt = JWT::encode($payload,JWT_KEY);
    }

}

if (! function_exists('verify_jwt')) {
    /**
	 * 
	 * Verify the JWT token whether the data is tampered or not
	 *
	 * @param string   $token     Token that is got from the user
	 *
	 * @return bool  
	 */ 

     function verify_jwt(string $token){
        try {
            $decoded_token = JWT::decode($token, JWT_KEY, array('HS256'));
            return $decoded_token;
        } catch (\Firebase\JWT\SignatureInvalidException $th) {
            echo $th->getMessage();
            echo "Invalid signature";
            session_destroy();
            return redirect()->to("login");
        }
     }
}

