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
      $createCourses = $record->getField('createCourses');
      $createSections = $record->getField('createSections');
      $addStudents = $record->getField('addStudents');
      //array_push($role, array('createUesrs'=>$createUsers,'deleteUsers'=>$deleteUsers,'editUsers'=>$editUsers, 'viewUsers'=>$viewUsers, 'addGrades'=>$createGrades, 'deleteGrades'=>$deleteGrades, 'editGrades'=>$editGrades, 'viewGrades'=>$viewGrades));
      $role = array('createUsers'=>$createUsers,'deleteUsers'=>$deleteUsers,'editUsers'=>$editUsers, 'viewUsers'=>$viewUsers, 'addGrades'=>$createGrades,
       'deleteGrades'=>$deleteGrades, 'editGrades'=>$editGrades, 'viewGrades'=>$viewGrades, 'createCourses'=>$createCourses, 'createSections'=>$createSections, 'addStudents'=>$addStudents);
    
    }
    
    echo json_encode($role);

    exit();
    }
    
    } else {
    
      echo -1;
      exit();
    
    }


<<<<<<< HEAD
?>
=======
?>
>>>>>>> ac6a0a41a566b97837818cdae326f1ef9ac8ef2e
