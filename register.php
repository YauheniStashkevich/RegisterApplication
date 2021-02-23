<?php
  require "connect.php";
  $data=$_POST;
  $pathtoJSON='JS_AJAX/registrreque.json';
  function putToJSON($path,$fileToPut)
  {
    file_put_contents($path,'['.json_encode($fileToPut).']');
  }
  class CRUD {
    public function create($newUser,$xmlfile) {
      $salt='DeutshlandfromRammstein';
      $user_xml = $xmlfile->addChild('User');
      $user_xml->addChild('login', $newUser['login']);
      $user_xml->addChild('password',md5($newUser['password'].$salt));
      $user_xml->addChild('password_repeat',md5($newUser['password_repeat'].$salt));
      $user_xml->addChild('email', $newUser['email']);
      $user_xml->addChild('name', $newUser['name']);
      $xmlfile->asXML('DB/users.xml');

    }
    public function retreive() {

    }
    public function update() {

    }
    public function delete() {

    }
  
  }
  $createNewUser= new Crud ();
    $response=array("status"=>true,"message"=>'Registration was success');
    putToJSON($pathtoJSON,$response);
    if (preg_match('/^[a-zA-Z0-9_-]{6,}$/', $data['login']))
    {
    }
    else
    {
      $response=array("status"=>false,"type"=>'1',"message"=>'Wrong login');
      putToJSON($pathtoJSON,$response);
      die();
    }
    if ($data['password']==$data['password_repeat'])
    {
    }
    else
    {
      $response=array("status"=>false,"type"=>'2',"message"=>'Your second password != your first password');
      putToJSON($pathtoJSON,$response);
      die();
    }
    if (preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&].{6,}$/', $data['password']))
    {
    }
    else
    {
      $response=array("status"=>false,"type"=>'3',"message"=>'Your password is easy');
      putToJSON($pathtoJSON,$response);
      die();
    }
    if (filter_var($data['email'], FILTER_VALIDATE_EMAIL))
    {
    }
    else
    {
      $response=array("status"=>false,"type"=>'4',"message"=>'Wrong email');
      putToJSON($pathtoJSON,$response);
      die();
    }
    if (preg_match('/^[a-zA-Z0-9_-]{2,}$/', $data['name']))
    {
      $response=array("status"=>true,"message"=>'Registration was success');
      putToJSON($pathtoJSON,$response);
    }
    else
    {
      $response=array("status"=>false,"type"=>'5',"message"=>'Wrong login');
      putToJSON($pathtoJSON,$response);
      die();
    }
  
  function chekUser($dataUser,$xmlfiles){
    foreach ($xmlfiles as $key) {
      if ($key->login == $dataUser['login'] || $key->email == $dataUser['email'])
      {
        die('User with this login or email already exists in system');
      }
    }
  }
  chekUser($data,$xml);
  $createNewUser->create($data,$xml);

?>