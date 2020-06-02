<?php

/*Validate the fetching records with Auth Key*/

if($_SERVER['HTTP_AUTH_KEY']=='advanz101'){
  $logdata=array();
  $logdatadetails=array();
  $CallList=$GLOBALS['db']->QUERY("SELECT count(id) As CallCount,parent_type,parent_id FROM `calls` WHERE deleted=0 AND parent_id!='' GROUP BY `parent_type`,`parent_id`");
  while($CallListData=$GLOBALS['db']->fetchByAssoc($CallList)){

    if($CallListData['parent_type']=='Accounts'){
      $AccoutnList=BeanFactory::getBean('Accounts',$CallListData['parent_id']);
      $logdatadetails['name']=$AccoutnList->name;
    }

    if($CallListData['parent_type']=='Leads'){
      $LeadList=BeanFactory::getBean('Leads',$CallListData['parent_id']);
      $logdatadetails['name']=$LeadList->first_name.' '.$LeadList->last_name;
    }
    $logdatadetails['CallCount']=$CallListData['CallCount'];

    $logdata[$CallListData['parent_type']][]=$logdatadetails;
  }

  $CallContact=$GLOBALS['db']->QUERY("SELECT count(`call_id`) AS CallCount,`contact_id` FROM `calls_contacts` WHERE deleted=0 GROUP BY `contact_id`");
  while($CallContactlist=$GLOBALS['db']->fetchByAssoc($CallContact)){

    $logdatadetails['CallCount']=$CallContactlist['CallCount'];
    $ContactList=BeanFactory::getBean('Contacts',$CallContactlist['contact_id']);
    $logdatadetails['name']=$ContactList->first_name.' '.$ContactList->last_name;

    $logdata['Contacts'][]=$logdatadetails;
  }

  echo json_encode($logdata);
}else{
  echo "Invalid Authkey";
}
?>
