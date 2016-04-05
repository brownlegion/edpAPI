<?php

    include 'FileMaker.php';
  include 'edplocation.php';
  
  if(isset($_REQUEST['id'])) {
  
  $id = $_REQUEST['id'];
  $fm = new FileMaker($databasename, $ip, $login, $pass);
  
  $findRec = $fm->newCompoundFindCommand('roles');
  $findReq1 = $fm->newFindRequest('roles');
  $findReq1->addFindCriterion('id', $id);
  $findRec->add(1,$findReq1);
  $result = $findRec->execute();
  
  if (FileMaker::isError($result)) {
  
    $returnValue = 0;
		echo $returnValue;
    exit();
    
  } else {
  
  //$role = array();
  $records = $result->getRecords();
    
    foreach ($records as $record) {
    
      //$tempid = $record->getField('id');
      $createUsers = $record->getField('createUsers');
      $deleteUsers = $record->getField('deleteUsers');
      $editUsers = $record->getField('editUsers');
      $viewUsers = $record->getField('viewUsers');
      $createGrades = $record->getField('addGrades');
      $deleteGrades = $record->getField('deleteGrades');
      $editGrades = $record->getField('editGrades');
      $viewGrades = $record->getField('viewGrades');
      //array_push($role, array('createUesrs'=>$createUsers,'deleteUsers'=>$deleteUsers,'editUsers'=>$editUsers, 'viewUsers'=>$viewUsers, 'addGrades'=>$createGrades, 'deleteGrades'=>$deleteGrades, 'editGrades'=>$editGrades, 'viewGrades'=>$viewGrades));
      $role = array('createUsers'=>$createUsers,'deleteUsers'=>$deleteUsers,'editUsers'=>$editUsers, 'viewUsers'=>$viewUsers, 'addGrades'=>$createGrades, 'deleteGrades'=>$deleteGrades, 'editGrades'=>$editGrades, 'viewGrades'=>$viewGrades);
    
    }
    
    echo json_encode($role);

    exit();
    }
    
    } else {
    
      echo -1;
      exit();
    
    }


?>