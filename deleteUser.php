<?php

include 'FileMaker.php';
include 'edplocation.php';

if(isset($_REQUEST['id'])) { 

   $deleteId = $_REQUEST['id'];
   
   if ($deleteId == 1) {
    echo 'Admins are not allowed to be deleted.';
    exit();
   }
   
   $fm = new FileMaker($databasename, $ip, $login, $pass);
   
   $compoundFind = $fm->newCompoundFindCommand('marks 2');
	 $findReq1 = $fm->newFindRequest('marks 2');
   $findReq1->addFindCriterion('student_id', '=='.$deleteId);
   $compoundFind->add(1,$findReq1);
   $result1 = $compoundFind->execute();
   
   if (FileMaker::isError($result1)) {   //User doesn't have any marks associated with them.
   
    $findRec = $fm->newFindCommand('users');
      $findRec->addFindCriterion('id', $deleteId);
	    $result = $findRec->execute();
      $records = $result->getRecords();
	    $recID = $records[0]->getRecordID();
      $newDelete = $fm->newDeleteCommand('users', $recID);
   
   //$newDelete = $fm->newDeleteCommand('edpTest', $deleteId);
   $result = $newDelete->execute();
   
   if (FileMaker::isError($result)) {
   
      $returnValue = 0;
      echo $returnValue;
      //exit();
   
   } else {
   
     $returnValue = 1;
     echo $returnValue;
     //exit();
   
   }
   
   } else {
   
   echo 'User has a mark associated with them.';
   
   }
   
} else {

  $returnValue = -1;
  echo $returnValue;
   exit();
}

?>