<?php

  include 'FileMaker.php';
  include 'edplocation.php';
  
  if(isset($_REQUEST['id']) && isset($_REQUEST['mark']) && isset($_REQUEST['name'])) {
  
      $editId = $_REQUEST['id'];
      $name = $_REQUEST['name'];
      $editMark = $_REQUEST['mark'];
      
      $fm = new FileMaker($databasename, $ip, $login, $pass);
      
      $findRec = $fm->newFindCommand('marks 2');
      $findRec->addFindCriterion('id', $editId);
	    $result = $findRec->execute();
      $records = $result->getRecords();
	    $recID = $records[0]->getRecordID();
      $newEdit = $fm->newEditCommand('marks 2', $recID);
      
      //$returnValue = array('id'=>$editId, 'name'=>$name, 'mark'=>$editMark);
      //array_push($returnValue, array('id'=>$editId));

        $newEdit->setField('mark', $editMark);
        $newEdit->setField('last_updated_by', $name);
     
     $result2 = $newEdit->execute();
     //echo json_encode($returnValue);
     //exit();
     
     if (FileMaker::isError($result2)) {
  
    $returnValue = 0;
		echo $returnValue;
    exit();
    
  } else {
  
    $returnValue = 1;
    echo $returnValue;
    exit();
  }
      
  } else {
  
    $returnValue = -1;
    echo $returnValue;
    exit();
  }

?>