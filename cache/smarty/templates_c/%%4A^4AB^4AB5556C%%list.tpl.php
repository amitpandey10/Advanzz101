<?php /* Smarty version 2.6.31, created on 2020-06-02 11:40:42
         compiled from custom/modules/adz_CallActivity/tpls/list.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'round', 'custom/modules/adz_CallActivity/tpls/list.tpl', 14, false),)), $this); ?>
<!--SuiteCRM Smary tpl-->

<link href="custom/modules/adz_CallActivity/css/custom-layout.css" rel="stylesheet" type="text/css"/>

<section class="moduleTitle">
	<div class="heading-block">
    	<h2>Module Call Logs</h2>
  </div>

	<div class="dashlet">
		<div class="first_call">
			<div class="fcall">
				<p>Total Calls: <?php echo $this->_tpl_vars['totalCall']; ?>
</p>
				<p>Average Calls: <?php echo ((is_array($_tmp=$this->_tpl_vars['totalCall']/$this->_tpl_vars['modulecall']['totallms'])) ? $this->_run_mod_handler('round', true, $_tmp, 2) : round($_tmp, 2)); ?>
</p>
			</div>
		</div>
		<div class="second_call">
			<div class="fcall">
				<p>Accounts : <?php echo $this->_tpl_vars['modulecall']['account']; ?>
</p>
				<p>Leads :  <?php echo $this->_tpl_vars['modulecall']['lead']; ?>
</p>
				<p>Contacts :  <?php echo $this->_tpl_vars['modulecall']['contact']; ?>
</p>
				<p></p>
			</div>
		</div>
	</div>

	<div class="listViewBody">
	<div class="inventory_list table-list-wrapper" style="max-height:300px">
		<table id="list_table" class="display">
			<thead>
					<tr>
							<th><input type="checkbox" id="mass_select_all" data-to-table="tasks"/></th>
							<th class="nosort"><strong>Activity</strong></th>
							<th class="nosort"><strong>Accounts</strong></th>
							<th class="nosort"><strong>Leads</strong></th>
							<th class="nosort"><strong>Contacts</strong></th>
							<th class="nosort">C<strong>all Count</strong></th>
					</tr>
			</thead>
			<tbody>

				<?php $this->assign('val', 1); ?>
				<?php $_from = $this->_tpl_vars['logdata']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['bean']):
?>
				<tr>
						<td><input type="checkbox" name="inventorybeanid" class="inventorybeanid" value="" /></td>
						<td><?php echo $this->_tpl_vars['val']; ?>
</td>
						<?php if ($this->_tpl_vars['bean']['parent_type'] == 'Accounts'): ?>
							<td><?php echo $this->_tpl_vars['bean']['name']; ?>
</td>
						<?php else: ?><td></td>
						<?php endif; ?>
						<?php if ($this->_tpl_vars['bean']['parent_type'] == 'Leads'): ?>
							<td><?php echo $this->_tpl_vars['bean']['name']; ?>
</td>
						<?php else: ?><td></td>
						<?php endif; ?>
						<?php if ($this->_tpl_vars['bean']['parent_type'] == 'Contacts'): ?>
							<td><?php echo $this->_tpl_vars['bean']['name']; ?>
</td>
						<?php else: ?><td></td>
						<?php endif; ?>
						<td><?php echo $this->_tpl_vars['bean']['CallCount']; ?>
</td>
				</tr>
				<?php $this->assign('val', $this->_tpl_vars['val']+1); ?>
				<?php endforeach; endif; unset($_from); ?>
			</tbody>
		</table>
	</div>
</div>
</section>

<script type="text/javascript" src="https://cdn.datatables.net/1.10.18/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.5.2/js/dataTables.buttons.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.flash.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.html5.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.print.min.js"></script>

<script type="text/javascript">
<?php echo '
$("#lightSlider").lightSlider({
	 pager: false,
	 controls: true,
	 prevHtml: \'<i class="fa fa-chevron-left"></i>\',
	 nextHtml: \'<i class="fa fa-chevron-right"></i>\',
	 autoWidth: true,
});

$(document).ready(function() {

	var table=$(\'#list_table\').DataTable( {
	    "paging":   true,
	    "info":     true,
	    "searching": true,
	    buttons: true,
	    "language": {
		    "paginate": {
		      "previous": "", "next": ""
		    }
		  },
			"columnDefs": [ {
			 "targets": [0,1,3,4,5,6,7,8,9,10],
			 "orderable": false
		 } ],
	    dom: \'<"datatable-top-filter"lf>rt<"datatable-bottom-filter"ip><"clear">\',
	});

	$(\'#SEARCH\').keyup(function(){
		table.search($(this).val()).draw() ;
	});
});
</script>
<style>
	.dataTables_filter{display: none;}
	.dispatch-dialogs{display:none}
	.dispatch-dialogs .action-button {
				display: flex;
				justify-content: flex-end;
				margin-top: 20px;
		}
		.dispatch-dialogs .action-button .cancel-button {
				margin-left: 10px;
		}
	 .dispatch-dialogs .dialog-btn{margin-top:30px;}
	 .dispatch-dialogs{ padding: 50px 20px 20px; width:700px; height:auto; top:50%; left:50%;  transform: translate(-50%, -50%); z-index:250002; border-radius:5px; box-shadow: 0 11px 15px -7px rgba(0,0,0,.2), 0 24px 38px 3px rgba(0,0,0,.14), 0 9px 46px 8px rgba(0,0,0,.12);}
	 .dispatch-dialogs .popup-block-main{display: flex; width: 100%;}
	 .dispatch-dialogs .popup-block-main .popup-block {width:100%;}
	 .dispatch-dialogs .popup-block-main .popup-block:last-child{margin-left:30px;}
	 .dispatch-dialogs .heading-title-block{display:flex; flex-direction: column; width: 100%; border-bottom:1px solid #bbbbbb; margin-bottom:25px; padding-bottom: 15px;}
	 .dispatch-dialogs .heading-title-block .request-block{ font-size:14px; color: #4d4d4d; margin-top: 10px;}
	 .dispatch-dialogs .heading-title-block .request-block span{ font-size:14px; color: #303188; margin-left: 5px;}
	 .dispatch-dialogs .heading-title-block .title{font-size: 24px; color: #4d4d4d;}
	 .dispatch-dialogs .outstock_div{display:flex; margin-top: 15px;}
	 .dispatch-dialogs .outstock_div .popup-block{ margin:0 0 0 20px; width: 100%;}
	 .dispatch-dialogs .outstock_div .popup-block:first-child{ margin-left:0;}

	 .dispatch-dialogs .dispatch-dialogs-block{display:flex; margin-top: 15px;}
	 .dispatch-dialogs .dispatch-dialogs-block .popup-block{ margin:0 0 0 20px; width: 50%;}
	 .dispatch-dialogs .dispatch-dialogs-block .popup-block:first-child{ margin-left:0;}

	 .search-filter-accordian{display: flex; flex-direction: column;}
	 .search-filter-accordian .panel-default>.panel-heading{border-radius: 4px;
	     border: 2px solid #bbbbbb;
	     background-color: #e9e9e9;
	     font-size: 15px;
	     padding: 10px 20px 10px 40px;
	     color: #4d4d4d;
	     font-family: lato;}
	 .search-filter-accordian .panel-default>.panel-heading h4{font-size: 15px;
	     color: #4d4d4d;
	     font-family: latobold; border:0px none; padding:0; margin:0;}
	   .search-filter-accordian .panel-default>.panel-heading h4 a {position: relative;  display: flex;}
	 .search-filter-accordian .panel-heading .panel-title a .accordian-arrow {
	     width: 18px;
	     height: 12px;
	     background-image: url(themes/SuiteR/images/accordian-down-arrow.png);
	     background-repeat: no-repeat;
	     position: absolute;
	     right: 0px;
	     top: 1px;
	 }
	 .search-filter-accordian .panel-heading .panel-title a[aria-expanded="true"] .accordian-arrow {
	     width: 18px;
	     height: 12px;
	     background-image: url(themes/SuiteR/images/accordian-up-arrow.png);
	     background-repeat: no-repeat;
	     position: absolute;
	     right: 0px;
	     top: 1px;
	 }
	 .student_list_style_search{
     padding: 15px 34px;
   }
	.dashlet {
    width:100%;
    margin: auto;
	}
	.first_call {
	    width: 300px;
	    float: left;
	    height: 150px;
			margin-left: 150px;
	    border: 1px solid;
			background-color: aliceblue;
    	color: chocolate;
	}
	.second_call {
	    width: 300px;
	    float: left;
	    height: 150px;
			margin-left: 100px;
	    border: 1px solid;
			background-color: aliceblue;
    	color: chocolate;
	}
	.fcall{
		font-size: 20px;
		padding: 40px;
	}
	#clear {
	    clear: both;
	}
	p{
		font-size: 20px
	}

</style>
'; ?>
