<?php

include 'FileMaker.php';
include 'edplocation.php';

if(isset($_REQUEST['id'])) {

  $id = $_REQUEST['id'];
  $fm = new FileMaker($databasename, $ip, $login, $pass);
  $findRec = $fm->newCompoundFindCommand('courses');
  $findReq1 = $fm->newFindRequest('courses');
  $findReq1->addFindCriterion('professor_id', $id);
  $findRec->add(1,$findReq1);
  $result = $findRec->execute();
  
  if (FileMaker::isError($result)) {
  
    $returnValue = 0;
		echo $returnValue;
    exit();
    
  } else {
  
    $records = $result->getRecords();
    $courses = array();
    
    foreach ($records as $record) {
    
      $tempid = $record->getField('id');
      $tempCode = $record->getField('course_code');
      $tempTitle = $record->getField('course_title');    
      array_push($courses, array('id'=>$tempid, 'coursecode'=>$tempCode, 'title'=>$tempTitle));
    }
  
    echo json_encode($courses);
    exit();
  }

} else {

    $returnValue = -1;
		echo $returnValue;
    exit();

}

?>