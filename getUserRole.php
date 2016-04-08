<?php

include 'FileMaker.php';
include 'edplocation.php';

if(isset($_REQUEST['id'])) {

$id = $_REQUEST['id'];

  $fm = new FileMaker($databasename, $ip, $login, $pass);
  $findRec = $fm->newCompoundFindCommand('acl');
  $findReq1 = $fm->newFindRequest('acl');
  $findReq1->addFindCriterion('userId', $id);
  $findRec->add(1,$findReq1);
  $result = $findRec->execute();
  
  if (FileMaker::isError($result)) 
	{
    $returnValue = 0;
		echo $returnValue;
    exit();
  } else {
  
    $records = $result->getRecords();
    //$permissions = array();
    
    foreach ($records as $record) {
    
    //Variable names make no sense, but produce right results.
           $tempid = $record->getField('createUsers');
           $tempmark = $record->getField('editUsers');
           $updated = $record->getField('deleteUsers');
           $updatedBy = $record->getField('viewUsers');
           $course = $record->getField('addGrades');
           $section = $record->getField('editGrades');
           $section2 = $record->getField('deleteGrades');
           $section3 = $record->getField('viewGrades');
           //array_push($permissions, array('createUsers'=>$tempid, 'editUsers'=>$tempmark, 'deleteUsers'=>$updated, 'viewUsers'=>$updatedBy, 
           //'addGrades'=>$course, 'editGrades'=>$section, 'deleteGrades'=>$section2, 'viewGrades'=>$section3));
           $permissions = array('createUsers'=>$tempid, 'editUsers'=>$tempmark, 'deleteUsers'=>$updated, 'viewUsers'=>$updatedBy, 
           'addGrades'=>$course, 'editGrades'=>$section, 'deleteGrades'=>$section2, 'viewGrades'=>$section3);
    
    }
    
    echo json_encode($permissions);
    //$returnValue = 1;
    //echo $returnValue;
    exit();
    
  }

} else {
    
    $returnValue = -1;
		echo $returnValue;
    exit();

}

?>