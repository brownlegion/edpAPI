<?php

include 'FileMaker.php';
include 'edplocation.php';

if(isset($_REQUEST['id'])) {

  $id = $_REQUEST['id'];
  $fm = new FileMaker($databasename, $ip, $login, $pass);
  $findRec = $fm->newCompoundFindCommand('courses_sections');
  $findReq1 = $fm->newFindRequest('courses_sections');
  $findReq1->addFindCriterion('ta_id', $id);
  $findRec->add(1,$findReq1);
  $result = $findRec->execute();

  if (FileMaker::isError($result)) {
  
    $returnValue = 0;
		echo $returnValue;
    exit();
    
  } else  {
  
    $records = $result->getRecords();
    $courses = array();
    
    foreach ($records as $record) {
    
      $tempid = $record->getField('id');
      $tempcourse = $record->getField('course_code_fk');
      $tempsection = $record->getField('section_number');
      array_push($courses, array('id'=>$tempid, 'course'=>$tempcourse, 'section'=>$tempsection));
    
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