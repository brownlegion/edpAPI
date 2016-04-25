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
           $findRec2 = $fm->newCompoundFindCommand('courses_students');
           $findReq2 = $fm->newFindRequest('courses_students');
           $findReq2->addFindCriterion('courseTitle', $tempid);
           $findRec2->add(1,$findReq2);
           $result2 = $findRec2->execute();
           
           if (FileMaker::isError($result2)) 
            {
            
            }   else {
            
                   $records2 = $result2->getRecords();
                   
                   foreach ($records2 as $record2) {
                   
                    $tempid2 = $record2->getField('id');
                    $tempmark = $record2->getField('student_id');
                    $updated = $record2->getField('username');
                    $course = $record2->getField('courseTitle');
                    $section = $record2->getField('sectionNumber');
                    $sectionCourse = $record2->getField('course_section_id');
                    $firstname = $record2->getField('firstname');
                    $lastname = $record2->getField('lastname');
                    $findRec3 = $fm->newCompoundFindCommand('marks 2');
                    $findReq3 = $fm->newFindRequest('marks 2');
                    $findReq3->addFindCriterion('course_student_id_fk', $tempid2);
                    $findRec3->add(1,$findReq3);
                    $result3 = $findRec3->execute();
                    
                    if (FileMaker::isError($result3)) {
                    array_push($marks, array('id'=>$tempid2, 'studentId'=>$tempmark, 'username'=>$updated, 
                    'firstname'=>$firstname, 'lastname'=>$lastname, 'courseSectionId'=>$sectionCourse, 'course'=>$course, 'section'=>$section));                    
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
