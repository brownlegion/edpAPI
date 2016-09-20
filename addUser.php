<?php

include 'FileMaker.php';
include 'edplocation.php';

#check to see if everything is set, if not no action is taken
if(isset($_REQUEST['username']) && isset($_REQUEST['password'])&& isset($_REQUEST['firstname'])&& isset($_REQUEST['lastname']) && isset($_REQUEST['role'])){

	$username = $_REQUEST['username'];
	$password = $_REQUEST['password'];
	$firstname = $_REQUEST['firstname'];
	$lastname = $_REQUEST['lastname'];
  $role = $_REQUEST['role'];

	#location info of Filemaker server. If location is changed update here
	$fm = new FileMaker($databasename, $ip, $login, $pass);

	#array containing each value. Note, each value name has to match the exact name of the destination field
	$data = array("username"=>$username,"password"=>$password,"firstname"=>$firstname,"lastname"=>$lastname, "role"=>$role, "changedPassword"=>"false");

	#search for user in existing database
	$compoundFind = $fm->newCompoundFindCommand('users');
	$findReq1 = $fm->newFindRequest('users');

	#search parameters for username
	$findReq1->addFindCriterion('username', '=='.$username);
	//$findReq1->addFindCriterion('password',$password);
	//$findReq1->addFindCriterion('firstname',$firstname);
  //$findReq1->addFindCriterion('lastname',$lastname);

	$compoundFind->add(1,$findReq1);
	//$compoundFind->add(2,$findReq1);
  //$compoundFind->add(3,$findReq1);

	#execute find reqest, and obtain return
	$result = $compoundFind->execute();

	#if the search returns an error this means that the user does not exist in the database and can be added
	if (FileMaker::isError($result)) 
	{
	$rec = $fm->newAddCommand('users', $data);
	$add = $rec->execute();

 	# a value of 1 is returned to indicate success
	$returnValue = 1;
	echo $returnValue;

	exit();   
	}

	#if the user already exists no action is taken an a 0 is returned to indicated that the user was not added to the database
	$returnValue = 0;
	echo $returnValue;
  exit(); 

}
else
$returnValue = -1;
echo $returnValue;
exit();     
?>