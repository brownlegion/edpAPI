<?php

  include 'FileMaker.php';
  include 'edplocation.php';
  
  $fm = new FileMaker($databasename, $ip, $login, $pass);
  
  $findRec = $fm->newCompoundFindCommand('users');
    $findReq1 = $fm->newFindRequest('users');
    $findReq1->addFindCriterion('role', 2);
    $findRec->add(1,$findReq1);
    $result = $findRec->execute();

    if (FileMaker::isError($result)) 
	{
    $returnValue = 0;
		echo $returnValue;
    exit();
    
  } else {
  
    $records = $result->getRecords();
    $users = array();          
    
    foreach ($records as $record) {
    
      $tempid = $record->getField('id');
      $tempuser = $record->getField('username');
      $tempfirstname = $record->getField('firstname');
      $templastname = $record->getField('lastname');
      array_push($users,array('id'=>$tempid,'username'=>$tempuser,'firstname'=>$tempfirstname, 'lastname'=>$templastname));
    
    }
    
    echo json_encode($users);
    exit();
  
  }

?>