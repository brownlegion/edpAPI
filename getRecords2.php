<?php

  include 'FileMaker.php';
  include 'edplocation.php';
  
  $fm = new FileMaker($databasename, $ip, $login, $pass);
  
  $findAllRecords = $fm->newFindAllCommand('users');
  $result = $findAllRecords->execute();
 	$records= $result->getRecords();
  $users = array();
    
    foreach ($records as $record) {
    
      $tempid = $record->getField('id');
      $tempuser = $record->getField('username');
      $temprole = $record->getField('role');
      $tempfirstname = $record->getField('firstname');
      $templastname = $record->getField('lastname');
      $tempRegistered = $record->getField('changedPassword');
      //$temppass= $record->getField('password');
      array_push($users,array('id'=>$tempid,'username'=>$tempuser,'role'=>$temprole, 'firstname'=>$tempfirstname, 'lastname'=>$templastname, 'registered'=>$tempRegistered));
    
    }
    
    echo json_encode($users);

    exit();

?>