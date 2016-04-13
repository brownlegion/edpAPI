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
  
  if (FileMaker::isError($result)) 
	{
    $returnValue = 0;
		echo $returnValue;
    exit();
    
  } else  {
    
    $records = $result->getRecords();
    $marks = array();
    
    foreach ($records as $record) {
    
           $tempid = $record->getField('id');
           $findRec2 = $fm->newCompoundFindCommand('courses_students');
           $findReq2 = $fm->newFindRequest('courses_students');
           $findReq2->addFindCriterion('course_section_id', $tempid);
           $findRec2->add(1,$findReq2);
           $result2 = $findRec2->execute();
           
           if (FileMaker::isError($result2)) 
            {
		        //echo 'TA is not assiciated with that mark.';
            //exit();
            
            }   else {
            
                   $records2 = $result2->getRecords();
                   
                   foreach ($records2 as $record2) {
                   
                    $tempid2 = $record2->getField('id');
           $findRec3 = $fm->newCompoundFindCommand('marks 2');
           $findReq3 = $fm->newFindRequest('marks 2');
           $findReq3->addFindCriterion('course_student_id_fk', $tempid2);
           $findRec3->add(1,$findReq3);
           $result3 = $findRec3->execute();
           
           if (FileMaker::isError($result3)) 
            {
		        //echo 'TA is not assiciated with that mark.';
            //exit();
            
            } else {
            
                $records3 = $result3->getRecords();
                foreach ($records3 as $record3) {
           $tempid3 = $record3->getField('id');
           $tempmark = $record3->getField('mark');
           $updated = $record3->getField('last_updated');
           $updatedBy = $record3->getField('last_updated_by');
           $course = $record3->getField('courseCode');
           $section = $record3->getField('sectionCode');
           $firstname = $record3->getField('firstName');
           $lastname = $record3->getField('lastName');
           array_push($marks, array('id'=>$tempid3, 'mark'=>$tempmark, 'updatedLast'=>$updated, 'updatedBy'=>$updatedBy,
           'firstname'=>$firstname, 'lastname'=>$lastname, 'course'=>$course, 'section'=>$section));
                
                }
            }
                   
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
