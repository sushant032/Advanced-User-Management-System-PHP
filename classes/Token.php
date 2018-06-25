<?php
/**
 *
 */
class Token
{

  public static function generate(){
    // var_dump(Config::get('sessions/token_name'));
    return Session::put(Config::get('sessions/token_name'),md5(uniqid(time())));
  }

  public static function check($token){
    $tokenName = Config::get('sessions/token_name');
    if(Session::exists($tokenName) && $token === Session::get($tokenName)){
        Session::delete($tokenName);
        return true;
    }
    return false;
  }
}
