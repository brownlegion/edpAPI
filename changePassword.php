<?php

  include 'FileMaker.php';
  include 'edplocation.php';
  
  if(isset($_REQUEST['username']) && isset($_REQUEST['password']) && isset($_REQUEST['newpassword'])) {
  
  $submitUsername = $_REQUEST['username'];
  $submitPassword = $_REQUEST['password'];
  $newPassword = $_REQUEST['newpassword'];
  
  $fm = new FileMaker($databasename, $ip, $login, $pass);
  
  $findRec = $fm->newCompoundFindCommand('users');
  $findReq1 = $fm->newFindRequest('users');
   
  $findReq1->addFindCriterion('username', '=='.$submitUsername);
  $findReq1->addFindCriterion('password', '=='.$submitPassword);
  
  $findRec->add(1,$findReq1);
	$findRec->add(2,$findReq1);
  
  $result = $findRec->execute();
  
  if (FileMaker::isError($result)) 
	{
    $returnValue = 0;
		echo $returnValue;
    exit();
  } else {
  
    $record = $result->getRecords();
    
    foreach ($record as $temp) {
    
      $temp->setField('password', $newPassword);
      $temp->setField('changedPassword', 'true');
      $temp->commit();
      $returnValue = 1;
      echo $returnValue;
      exit();    
    }
  
  }
      
  } else {
  
    $returnValue = -1;
    echo $returnValue;
    exit();
  }  
?>