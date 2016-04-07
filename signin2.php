<?php

  include 'FileMaker.php';
  include 'edplocation.php';

  if(isset($_REQUEST['username']) && isset($_REQUEST['password'])){

  $submitUsername = $_REQUEST['username'];
  $submitPassword = $_REQUEST['password'];
  
  $fm = new FileMaker($databasename, $ip, $login, $pass);
  //echo "dabba";
  $compoundFind = $fm->newCompoundFindCommand('users');
	$findReq1 = $fm->newFindRequest('users');  
  
  $findReq1->addFindCriterion('username', '=='.$submitUsername);
	$findReq1->addFindCriterion('password', '=='.$submitPassword);
  
  $compoundFind->add(1,$findReq1);
	$compoundFind->add(2,$findReq1);

	$result = $compoundFind->execute();
  //echo "Before results";
                                       
  if (FileMaker::isError($result)) 
	{
     $returnValue = array("Sign In"=>"False");
		echo json_encode($returnValue);
  }
  
  else {
            
  $record = $result->getRecords();
    
  foreach ($record as $temp) {
    $id = $temp->getField('id');
    $role = $temp->getField('role');
    $firstname = $temp->getField('firstname');
    $lastname = $temp->getField('lastname');
    $registered = $temp->getField('changedPassword');
  }

   $returnValue = array("Sign In"=>"True", "ID"=>$id, "Role"=>$role, "FirstName"=>$firstname, "LastName"=>$lastname, "Registered"=>$registered);
	 echo json_encode($returnValue);
  }
  
  exit();
}         
?>