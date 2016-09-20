<?php

include 'FileMaker.php';
include 'edplocation.php';

if(isset($_REQUEST['student']) && isset($_REQUEST['courseSection'])){

	$student = $_REQUEST['student'];
	$courseSection = $_REQUEST['courseSection'];

	$fm = new FileMaker($databasename, $ip, $login, $pass);

	$data = array("student_id"=>$student,"course_section_id"=>$courseSection);

	$compoundFind = $fm->newCompoundFindCommand('courses_students');
	$findReq1 = $fm->newFindRequest('courses_students');

  $findReq1->addFindCriterion('student_id', '=='.$student);
  $findReq1->addFindCriterion('course_section_id', '=='.$courseSection);

	$compoundFind->add(1,$findReq1);
  $compoundFind->add(2,$findReq1);

	$result = $compoundFind->execute();

	if (FileMaker::isError($result)) 
	{
  
	$rec = $fm->newAddCommand('courses_students', $data);
	$add = $rec->execute();
  
  $newPerformScript = $fm->newPerformScriptCommand('courses_students','getStudentsAndCourses');
  $result2 = $newPerformScript->execute(); 

  $compoundFind2 = $fm->newCompoundFindCommand('courses_students');
	$findReq12 = $fm->newFindRequest('courses_students');

  $findReq12->addFindCriterion('student_id', '=='.$student);
  $findReq12->addFindCriterion('course_section_id', '=='.$courseSection);

	$compoundFind2->add(1,$findReq12);
  $compoundFind2->add(2,$findReq12);

	$result5 = $compoundFind2->execute();
  
  if (FileMaker::isError($result5)) {
  
    $returnValue = 2;
    echo $returnValue;
    exit();
  
  } else {
  $records2 = $result5->getRecords();
	    $recID = $records2[0]->getField('id');
  
         	//$returnValue = 1;
	echo $recID;
  	exit();
  
  }


	} else {


	$returnValue = 0;
	echo $returnValue;
  exit();
  }

}
else {
$returnValue = -1;
echo $returnValue;
exit();
}
?>