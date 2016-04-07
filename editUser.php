<?php

  include 'FileMaker.php';
  include 'edplocation.php';
  
  if(isset($_REQUEST['id'])) {
  
      $editId = $_REQUEST['id'];
      $editFirstName = $_REQUEST['firstname'];
      $editLastName = $_REQUEST['lastname'];
      $editPassword = $_REQUEST['password'];
      
      $fm = new FileMaker($databasename, $ip, $login, $pass);
      
      $findRec = $fm->newFindCommand('users');
      $findRec->addFindCriterion('id', $editId);
	    $result = $findRec->execute();
      $records = $result->getRecords();
	    $recID = $records[0]->getRecordID();
      $newEdit = $fm->newEditCommand('users', $recID);
      
      $returnValue = array();
      array_push($returnValue, array('id'=>$editId));
      
      if(empty($_REQUEST['firstname']) == false){
        $newEdit->setField('firstname', $editFirstName);
        array_push($returnValue, array('firstname'=>$editFirstName));
	   }
     
     if(empty($_REQUEST['lastname']) == false){
        $newEdit->setField('lastname', $editLastName);
       array_push($returnValue, array('lastname'=>$editLastName));
	   }
     
     if(empty($_REQUEST['password']) == false){
        $newEdit->setField('password', $editPassword);
        $newEdit->setField('changedPassword', "true");
        array_push($returnValue, array('password'=>$editPassword));
	   }
     
     $result = $newEdit->execute();
     echo json_encode($returnValue);
     exit();
      
  } else {
  
    $returnValue = 0;
    echo $returnValue;
    exit();
  }

?>
