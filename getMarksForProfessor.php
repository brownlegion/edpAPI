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
  
  if (FileMaker::isError($result)) 
	{
    $returnValue = 0;
		echo $returnValue;
    exit();
    
  } else  {
    
    $records = $result->getRecords();
    $marks = array();
    
    foreach ($records as $record) {

           $tempid = $record->getField('course_code');
           $findRec2 = $fm->newCompoundFindCommand('marks 2');
           $findReq2 = $fm->newFindRequest('marks 2');
           $findReq2->addFindCriterion('courseCode', $tempid);
           $findRec2->add(1,$findReq2);
           $result2 = $findRec2->execute();
           
           if (FileMaker::isError($result2)) 
            {
            
            }   else {
            
                   $records2 = $result2->getRecords();
                   
                   foreach ($records2 as $record2) {
                   
                    $tempid2 = $record2->getField('id');
                    $tempmark = $record2->getField('mark');
                    $updated = $record2->getField('last_updated');
                    $updatedBy = $record2->getField('last_updated_by');
                    $course = $record2->getField('courseCode');
                    $section = $record2->getField('sectionCode');
                    $firstname = $record2->getField('firstName');
                    $lastname = $record2->getField('lastName');
                    array_push($marks, array('id'=>$tempid2, 'mark'=>$tempmark, 'updatedLast'=>$updated, 'updatedBy'=>$updatedBy, 
                    'firstname'=>$firstname, 'lastname'=>$lastname, 'course'=>$course, 'section'=>$section));
                   
                   }
            } 
    }
    
    echo json_encode($marks);
    exit();
    
  }
  
  } else {
    $returnValue = -1;
    echo $returnValue;
    exit();
  }

?>