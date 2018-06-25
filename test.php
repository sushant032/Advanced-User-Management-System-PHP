<?php
  require_once('bootstrap/init.php');
  $db = DB::getInstance();
  $db->query("INSERT INTO company (`organization_name`, `email`, `password`, `salt`, `first_name`, `last_name`, `mobile_no`, `created_at`, `updated_at`) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)",array('organization_name'=>'InternMax',
  'email'=>'sushant.sinha22@gmail.com',
  'password'=>'password',
  'salt'=>'salt',
  'first_name'=>'Sush',
  'last_name'=>'Kumar',
  'mobile_no'=>'7219100476',
  'created_at'=>date("Y-m-d h:i:s"),
  'updated_at'=>date("Y-m-d h:i:s")));
  echo "<pre>";
  var_dump(array('organization_name'=>'InternMax',
  'email'=>'sushant.sinha22@gmail.com',
  'password'=>'password',
  'salt'=>'salt',
  'first_name'=>'Sush',
  'last_name'=>'Kumar',
  'mobile_no'=>'7219100476',
  'created_at'=>date("Y-m-d h:i:s"),
  'updated_at'=>date("Y-m-d h:i:s")));
  // $db = DB::getInstance();
  // echo '<pre>';
  // var_dump($db->query("INSERT INTO `users`VALUES (?,?,?,?,?,?,?)",array('email'=>'sush',
  // 'password'=>'sush',
  // 'first_name'=>'sush',
  // 'last_name'=>'sush',
  // 'salt'=>'sush',
  // 'created_at'=>date("Y-m-d H:i:s"),
  // 'updated_at'=>date("Y-m-d H:i:s"))));
  // var_dump(array('email'=>'sushant.sinha22@gmail.com',
  //                 'password'=>'iamsk9',
  //                 'first_name'=>'Sushant',
  //                 'last_name'=>'Kumar',
  //                 'salt'=>'salt',
  //                 'created_at'=>date("Y-m-d H:i:s"),
  //                 'updated_at'=>date("Y-m-d H:i:s")));
                                                                                                                                                                   // $db->insert('users',array('first_name'=>'hello',
  //                           'last_name'=>'world',
  //                           'email'=>'defrd',
  //                           'password'=>'password',
  //                           'salt'=>'salt'
  //                       ));

?>
