<?php

include 'FileMaker.php';
include 'edplocation.php';

if(isset($_REQUEST['id'])) {

$id = $_REQUEST['id'];

  $fm = new FileMaker($databasename, $ip, $login, $pass);
<<<<<<< HEAD
  $findRec = $fm->newCompoundFindCommand('marks 2');
  $findReq1 = $fm->newFindRequest('marks 2');
=======
  $findRec = $fm->newCompoundFindCommand('marks');
  $findReq1 = $fm->newFindRequest('marks');
>>>>>>> ac6a0a41a566b97837818cdae326f1ef9ac8ef2e
  $findReq1->addFindCriterion('student_id', $id);
  $findRec->add(1,$findReq1);
  $result = $findRec->execute();
  
  if (FileMaker::isError($result)) 
	{
    $returnValue = 0;
		echo $returnValue;
    exit();
  } else {
  
    $records = $result->getRecords();
    $marks = array();
    
    foreach ($records as $record) {
    
           $tempid = $record->getField('id');
           $tempmark = $record->getField('mark');
           $updated = $record->getField('last_updated');
           $updatedBy = $record->getField('last_updated_by');
           $course = $record->getField('courseCode');
           $section = $record->getField('sectionCode');
<<<<<<< HEAD
           $firstname = $record->getField('firstName');
           $lastname = $record->getField('lastName');
           array_push($marks, array('id'=>$tempid, 'mark'=>$tempmark, 'updatedLast'=>$updated, 'updatedBy'=>$updatedBy,
           'firstname'=>$firstname, 'lastname'=>$lastname, 'course'=>$course, 'section'=>$section));
=======
           array_push($marks, array('id'=>$tempid, 'mark'=>$tempmark, 'updatedLast'=>$updated, 'updatedBy'=>$updatedBy, 'course'=>$course, 'section'=>$section));
>>>>>>> ac6a0a41a566b97837818cdae326f1ef9ac8ef2e
    
    }
    
    echo json_encode($marks);
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