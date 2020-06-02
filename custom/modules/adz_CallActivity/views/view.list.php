<?php
require_once('include/MVC/View/views/view.list.php');
class adz_CallActivityViewList extends ViewList
{
    /**
     * @see ViewList::preDisplay()
     */
    public function preDisplay(){
        parent::preDisplay();
    }

		function display(){
			$logdata=array();
			$totalCall=0;$accountcall=0;$leadcall=0;$contactcall=0;$modulecall=array();
			$CallList=$GLOBALS['db']->QUERY("SELECT count(id) As CallCount,parent_type,parent_id FROM `calls` WHERE deleted=0 AND parent_id!='' GROUP BY `parent_type`,`parent_id`");
			while($CallListData=$GLOBALS['db']->fetchByAssoc($CallList)){
				$logdata[$CallListData['parent_id']]=$CallListData;

				if($CallListData['parent_type']=='Accounts'){
					$AccoutnList=BeanFactory::getBean('Accounts',$CallListData['parent_id']);
					$logdata[$CallListData['parent_id']]['name']=$AccoutnList->name;
					$accountcall=$accountcall+$CallListData['CallCount'];
				}

				if($CallListData['parent_type']=='Leads'){
					$LeadList=BeanFactory::getBean('Leads',$CallListData['parent_id']);
					$logdata[$CallListData['parent_id']]['name']=$LeadList->first_name.' '.$LeadList->last_name;
					$leadcall=$leadcall+$CallListData['CallCount'];
				}
				$totalCall=$totalCall+$CallListData['CallCount'];
			}

      $CallContact=$GLOBALS['db']->QUERY("SELECT count(`call_id`) AS CallCount,`contact_id` FROM `calls_contacts` WHERE deleted=0 GROUP BY `contact_id`");
      while($CallContactlist=$GLOBALS['db']->fetchByAssoc($CallContact)){
        $logdata[$CallContactlist['contact_id']]['parent_type']='Contacts';
        $logdata[$CallContactlist['contact_id']]['parent_id']=$CallContactlist['contact_id'];
        $logdata[$CallContactlist['contact_id']]['CallCount']=$CallContactlist['CallCount'];
        $ContactList=BeanFactory::getBean('Contacts',$CallContactlist['contact_id']);
        $logdata[$CallContactlist['contact_id']]['name']=$ContactList->first_name.' '.$ContactList->last_name;
        $contactcall=$contactcall+$CallContactlist['CallCount'];
        $totalCall=$totalCall+$CallContactlist['CallCount'];
      }

			$modulecall['account']=$accountcall;
			$modulecall['lead']=$leadcall;
      $modulecall['contact']=$contactcall;
			$modulecall['totallms']=count($logdata);

			$sugarSmarty = new Sugar_Smarty();
			$sugarSmarty->assign("logdata", $logdata);
			$sugarSmarty->assign("totalCall",$totalCall);
			$sugarSmarty->assign("modulecall", $modulecall);
			$sugarSmarty->display('custom/modules/adz_CallActivity/tpls/list.tpl');
		}
}
?>
