<?php

include 'FileMaker.php';
include 'edplocation.php';

if(isset($_REQUEST['studentCourse']) && isset($_REQUEST['name'])&& isset($_REQUEST['mark'])){

	$studentCourse = $_REQUEST['studentCourse'];
	$name = $_REQUEST['name'];
  $mark = $_REQUEST['mark'];

	$fm = new FileMaker($databasename, $ip, $login, $pass);

	$data = array("course_student_id_fk"=>$studentCourse,"last_updated_by"=>$name,"mark"=>$mark);

	$compoundFind = $fm->newCompoundFindCommand('marks 2');
	$findReq1 = $fm->newFindRequest('marks 2');

  $findReq1->addFindCriterion('course_student_id_fk', '=='.$studentCourse);

	$compoundFind->add(1,$findReq1);

	$result = $compoundFind->execute();

	if (FileMaker::isError($result)) 
	{
  
	$rec = $fm->newAddCommand('marks 2', $data);
	$add = $rec->execute();
  
  $newPerformScript = $fm->newPerformScriptCommand('marks 2','getEverythingForMarks2');
  $result2 = $newPerformScript->execute(); 

	$returnValue = 1;
	echo $returnValue;
  	exit();

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