<?php

include 'FileMaker.php';
include 'edplocation.php';

if(isset($_REQUEST['code']) && isset($_REQUEST['title']) && isset($_REQUEST['profid'])){

	$code = $_REQUEST['code'];
	$title = $_REQUEST['title'];
	$profid = $_REQUEST['profid'];

	$fm = new FileMaker($databasename, $ip, $login, $pass);

	$data = array("course_code"=>$code,"course_title"=>$title,"professor_id"=>$profid);

	$compoundFind = $fm->newCompoundFindCommand('courses');
	$findReq1 = $fm->newFindRequest('courses');

	$findReq1->addFindCriterion('course_code', '=='.$code);


	$compoundFind->add(1,$findReq1);

	$result = $compoundFind->execute();

	if (FileMaker::isError($result)) 
	{
	$rec = $fm->newAddCommand('courses', $data);
	$add = $rec->execute();
  $newPerformScript = $fm->newPerformScriptCommand('courses','getProfessorForCourses');
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