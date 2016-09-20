<?php

include 'FileMaker.php';
include 'edplocation.php';

if(isset($_REQUEST['course']) && isset($_REQUEST['section']) && isset($_REQUEST['ta'])){

	$course = $_REQUEST['course'];
	$section = $_REQUEST['section'];
	$ta = $_REQUEST['ta'];

	$fm = new FileMaker($databasename, $ip, $login, $pass);

	$data = array("course_id"=>$course,"sections_id"=>$section,"ta_id"=>$ta);

	$compoundFind = $fm->newCompoundFindCommand('courses_sections');
	$findReq1 = $fm->newFindRequest('courses_sections');

	$findReq1->addFindCriterion('course_id', '=='.$course);
  $findReq1->addFindCriterion('sections_id', '=='.$section);

	$compoundFind->add(1,$findReq1);
  $compoundFind->add(2,$findReq1);

	$result = $compoundFind->execute();

	if (FileMaker::isError($result)) 
	{
  
	$rec = $fm->newAddCommand('courses_sections', $data);
	$add = $rec->execute();
  
  $newPerformScript = $fm->newPerformScriptCommand('courses_sections','getCourseCodesForCourseSection');
  $result2 = $newPerformScript->execute();
  
  $newPerformScript2 = $fm->newPerformScriptCommand('courses_sections','getSectionNumbers');
  $result3 = $newPerformScript2->execute();
  
  $newPerformScript3 = $fm->newPerformScriptCommand('courses_sections','getTaForCoursesSections');
  $result4 = $newPerformScript3->execute(); 

  $compoundFind2 = $fm->newCompoundFindCommand('courses_sections');
	$findReq12 = $fm->newFindRequest('courses_sections');

	$findReq12->addFindCriterion('course_id', '=='.$course);
  $findReq12->addFindCriterion('sections_id', '=='.$section);

	$compoundFind2->add(1,$findReq12);
  $compoundFind2->add(2,$findReq12);

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
<<<<<<< HEAD
?>
=======
?>
>>>>>>> ac6a0a41a566b97837818cdae326f1ef9ac8ef2e
