<?php
/**
 *
 */
class Company
{
  public   $_db,
            $_data,
            $_sessionName,
            $_cookieName,
            $isLoggedIn;
  public function __construct($user = null)
  {
      $this->_db = DB::getInstance();
      $this->_sessionName = Config::get('sessions/session_name');
       $this->_cookieName = Config::get('remember/cookie_name');
       if(!$user) {
           if(Session::exists($this->_sessionName)) {
               $user = Session::get($this->_sessionName);
               if($this->find($user)) {
                   $this->isLoggedIn = true;
               } else {
                   //Logout
               }
           }
       } else {
           $this->find($user);
       }
  }

  public function create($fields){
    if(!$this->_db->insert('company',$fields)){
        throw new Exception('There was a problem creating the Company account.');
    }
  }
  public function createNewInternship($fields){
    if(!$this->_db->insert('internships',$fields)){
        throw new Exception('There was a problem creating the new Internship.');
    }
  }
  public function getMyInternships(){
    return $this->_db->get('internships',array('company_id','=',$this->data()->id))->_results;
  }
  public function find($user = null) {
        if($user) {
            $field = (is_numeric($user)) ? 'id' : 'email';
            $data = $this->_db->get('company', array($field, '=', $user));
            if($data->count()) {
                $this->_data = $data->first();
                return true;
            }
        }
        return false;
    }
  public function login($username = null, $password = null, $remember = false) {
        if(!$username && !$password && $this->exists()) {
            Session::put($this->_sessionName, $this->data()->id);
        } else {
            $user = $this->find($username);
            if ($user) {
                if ($this->data()->password === Hash::make($password, $this->data()->salt)) {
                    Session::put($this->_sessionName, $this->data()->id);
                    if ($remember) {
                        $hash = Hash::unique();
                        $hashCheck = $this->_db->get('company_sessions', array('user_id', '=', $this->data()->id));
                        if (!$hashCheck->count()) {
                            $this->_db->insert('company_sessions', array(
                                'user_id' => $this->data()->id,
                                'hash' => $hash
                            ));
                        } else {
                            $hash = $hashCheck->first()->hash;
                        }
                        Cookie::put($this->_cookieName, $hash, Config::get('remember/cookie_expiry'));
                    }
                    return true;
                }
            }
        }
        return false;
    }
    public function exists() {
        return (!empty($this->_data)) ? true : false;
    }
    public function logout() {
        $this->_db->delete('company_sessions', array('user_id', '=', $this->data()->id));
        Session::delete($this->_sessionName);
        Cookie::delete($this->_cookieName);
    }
    public function data(){
        return $this->_data;
    }
    public function isLoggedIn() {
        return $this->isLoggedIn;
    }

  // public function create($fields){
  //   $email = $fields['email'];
  //   $password = $fields['password'];
  //   $first_name = $fields['first_name'];
  //   $last_name = $fields['last_name'];
  //   $salt = $fields['salt'];
  //   $created_at = $fields['created_at'];
  //   $updated_at = $fields['updated_at'];
  //   $result = $this->_db->_pdo->prepare("SELECT * FROM users WHERE `email` = {$email}");
  //   $result->execute();
  //   $rs = $result->fetchAll(PDO::FETCH_OBJ);
  //   if(!count($rs)){
  //     $result = $this->_db->_pdo->prepare("INSERT INTO `users`(`first_name`, `last_name`, `email`, `password`, `salt`, `created_at`, `updated_at`) VALUES ('{$first_name}','{$last_name}','{$email}','{$password}','{$salt}','{$created_at}','{$updated_at}')");
  //     if($result->execute())
  //       echo 'Done';
  //     else {
  //       echo "INSERT INTO `users`(`first_name`, `last_name`, `email`, `password`, `salt`, `created_at`, `updated_at`) VALUES ('{$first_name}','{$last_name}','{$email}','{$password}','{$salt}','{$created_at}','{$updated_at}')";
  //     }
  //     Session::flash('success','Your account is created');
  //   }
  //   else Session::flash('fail','Account Already Exists');
  //
  // }
}
