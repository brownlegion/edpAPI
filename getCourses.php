<?php

    include 'FileMaker.php';
  include 'edplocation.php';
  
  $fm = new FileMaker($databasename, $ip, $login, $pass);
  
  $findAllRecords = $fm->newFindAllCommand('courses');
  $result = $findAllRecords->execute();
 	$records= $result->getRecords();
  $courses = array();
    
    foreach ($records as $record) {
    
      $tempid = $record->getField('id');
      $tempcode = $record->getField('course_code');
      $temptitle = $record->getField('course_title');
      $tempprofid = $record->getField('professor_id');
      $tempprof = $record->getField('professor_username');
      array_push($courses,array('id'=>$tempid,'code'=>$tempcode,'title'=>$temptitle, 'professor_id'=>$tempprofid, 'professor'=>$tempprof));
    
    }
    
    echo json_encode($courses);

    exit();


?>