<<<<<<< HEAD
<?php

  include 'FileMaker.php';
  include 'edplocation.php';
  
  $fm = new FileMaker($databasename, $ip, $login, $pass);
  
  $findRec = $fm->newCompoundFindCommand('users');
    $findReq1 = $fm->newFindRequest('users');
    $findReq1->addFindCriterion('role', 3);
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

=======
<?php

  include 'FileMaker.php';
  include 'edplocation.php';
  
  $fm = new FileMaker($databasename, $ip, $login, $pass);
  
  $findRec = $fm->newCompoundFindCommand('users');
    $findReq1 = $fm->newFindRequest('users');
    $findReq1->addFindCriterion('role', 3);
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

>>>>>>> ac6a0a41a566b97837818cdae326f1ef9ac8ef2e
?>