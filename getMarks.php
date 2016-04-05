<?php

include 'FileMaker.php';
include 'edplocation.php';

if(isset($_REQUEST['id'])) {

$id = $_REQUEST['id'];

  $fm = new FileMaker($databasename, $ip, $login, $pass);
  $findRec = $fm->newCompoundFindCommand('marks');
  $findReq1 = $fm->newFindRequest('marks');
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
           array_push($marks, array('id'=>$tempid, 'mark'=>$tempmark, 'updatedLast'=>$updated, 'updatedBy'=>$updatedBy, 'course'=>$course, 'section'=>$section));
    
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