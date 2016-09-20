<?php

    include 'FileMaker.php';
  include 'edplocation.php';
  
  $fm = new FileMaker($databasename, $ip, $login, $pass);
  
  $findAllRecords = $fm->newFindAllCommand('sections');
  $result = $findAllRecords->execute();
 	$records= $result->getRecords();
  $courses = array();
    
    foreach ($records as $record) {
    
      $tempid = $record->getField('id');
      $tempcode = $record->getField('section_number');
      $temptitle = $record->getField('semester');
      $tempprofid = $record->getField('year');

      array_push($courses,array('id'=>$tempid,'sectionNumber'=>$tempcode,'semester'=>$temptitle, 'year'=>$tempprofid));
    
    }
    
    echo json_encode($courses);

    exit();


?>