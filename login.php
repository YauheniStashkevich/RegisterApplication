<?php
  require "connect.php";
  $datalogin=$_POST;
  $pathtoJSON='JS_AJAX/request.json';
  function putToJSON($path,$fileToPut)
  {
    file_put_contents($path,'['.json_encode($fileToPut).']');
  }
  if($datalogin['login']=='')
  {
    $response=array("status"=>false,"type"=>'1',"message"=>'Press your login please');
    putToJSON($pathtoJSON,$response);

  }
  if($datalogin['password']=='')
  {
    $response=array("status"=>false,"type"=>'2',"message"=>'Press your password please');
    putToJSON($pathtoJSON,$response);
  }
  function checklogin($dataforcheck,$xmlfile){
    $salt='DeutshlandfromRammstein';
    foreach($xmlfile as $key){
        if ($key->login==$dataforcheck['login'])
        {
          if($key->password==md5($dataforcheck['password'] . $salt))
          {
            $response=array("status"=>true);
            putToJSON('JS_AJAX/request.json',$response);
          }
          else
          { 
            $response=array("status"=>false,"type"=>'0',"message"=>'Wrong password');
            $textToJSON=json_encode($response);
            putToJSON('JS_AJAX/request.json',$response);
          }
        }
    }
  }
  checklogin($datalogin,$xml);
?>