<<<<<<< HEAD
<?php

  include 'FileMaker.php';
  include 'edplocation.php';
  
  $fm = new FileMaker($databasename, $ip, $login, $pass);
  
  $findAllRecords = $fm->newFindAllCommand('courses_sections');
  $result = $findAllRecords->execute();
 	$records= $result->getRecords();
  $courses = array();
    
    foreach ($records as $record) {
    
      $tempid = $record->getField('id');
      $tempuser = $record->getField('course_id');
      $temprole = $record->getField('course_code_fk');
      $tempfirstname = $record->getField('sections_id');
      $templastname = $record->getField('section_number');
      $tempRegistered = $record->getField('ta_id');
      $temppass= $record->getField('ta_username');
      array_push($courses,array('id'=>$tempid,'courseId'=>$tempuser,'courseCode'=>$temprole, 'sectionId'=>$tempfirstname, 'sectionNumber'=>$templastname, 
      'taId'=>$tempRegistered, 'taUsername'=>$temppass));
    
    }
    
    echo json_encode($courses);

    exit();

=======
<?php

  include 'FileMaker.php';
  include 'edplocation.php';
  
  $fm = new FileMaker($databasename, $ip, $login, $pass);
  
  $findAllRecords = $fm->newFindAllCommand('courses_sections');
  $result = $findAllRecords->execute();
 	$records= $result->getRecords();
  $courses = array();
    
    foreach ($records as $record) {
    
      $tempid = $record->getField('id');
      $tempuser = $record->getField('course_id');
      $temprole = $record->getField('course_code_fk');
      $tempfirstname = $record->getField('sections_id');
      $templastname = $record->getField('section_number');
      $tempRegistered = $record->getField('ta_id');
      $temppass= $record->getField('ta_username');
      array_push($courses,array('id'=>$tempid,'courseId'=>$tempuser,'courseCode'=>$temprole, 'sectionId'=>$tempfirstname, 'sectionNumber'=>$templastname, 
      'taId'=>$tempRegistered, 'taUsername'=>$temppass));
    
    }
    
    echo json_encode($courses);

    exit();

>>>>>>> ac6a0a41a566b97837818cdae326f1ef9ac8ef2e
?>