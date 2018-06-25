<?php
session_start();
$GLOBALS['config'] = array(
  'mysql' => array(
      'host' => '127.0.0.1',
      'username' => 'root',
      'password' => '',
      'db' => 'internshala'
  ),
  'remember' => array(
      'cookie_name' => 'hash',
      'cookie_expiry' => 86400
  ),
  'sessions' => array(
      'session_name' => 'user',
      'token_name' => 'token'
  )
);
spl_autoload_register(function($class) {
  require_once 'classes/' . $class . '.php';
});
require_once 'methods/sanitize.php';
if(Cookie::exists(Config::get('remember/cookie_name')) && !Session::exists(Config::get('sessions/session_name'))) {
  $hash = Cookie::get(Config::get('remember/cookie_name'));
  $hashCheck = DB::getInstance()->get('users_session', array('hash', '=', $hash));
  if($hashCheck->count()) {
      $user = new User($hashCheck->first()->user_id);
      $user->login();
  }
}
