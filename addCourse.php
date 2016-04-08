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

	$compoundFind2 = $fm->newCompoundFindCommand('courses');
	$findReq12 = $fm->newFindRequest('courses');

	$findReq12->addFindCriterion('course_code', '=='.$code);

	$compoundFind2->add(1,$findReq12);

	$result5 = $compoundFind2->execute();
  
  if (FileMaker::isError($result5)) {
  
    $returnValue = 2;
    echo $returnValue;
    exit();
    
  }else {
  
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
