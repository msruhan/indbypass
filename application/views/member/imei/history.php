<div class="dashboard">
    <div class="row">
        <div class="col-lg-12">

        </div>
    </div>

<div class="row">
    <div class="col-lg-12">
        <div class="order-history">
            <ul class="nav nav-tabs" id="myTab">
                <li class="active"><a data-toggle="tab" href="#imeiorders">Available</a></li>
                <li class=""><a data-toggle="tab" href="#pendinginvoices">Pending</a></li>
                <li class=""><a data-toggle="tab" href="#latestnews">Canceled</a></li>
                <?php /* <li class=""><a data-toggle="tab" href="#verifyimei">Verfied</a></li> */ ?>
            </ul>
            
            <div class="tab-content" id="myTabContent">
            <div id="imeiorders" class="tab-pane fade active in">
                <div class="table-responsive">
                	<table cellpadding="0" cellspacing="0" border="0" class="display table" id="imeiapproave">
                        <thead>
                            <tr>
                                <th width="3%"><?php echo $this->lang->line('imei_fields_id'); ?></th>
                                <th width="15%"><?php echo $this->lang->line('imei_fields_imei'); ?></th>
                                <th width="20%"><?php echo $this->lang->line('imei_fields_method'); ?></th>
                                <th width="40%"><?php echo $this->lang->line('imei_fields_code'); ?></th>
                                <th width="7%"><?php echo $this->lang->line('imei_fields_note'); ?></th>
                                <th width="5%"><?php echo $this->lang->line('imei_fields_status'); ?></th>
                                <th width="10%"><?php echo $this->lang->line('imei_fields_datetime'); ?></th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
            <div id="pendinginvoices" class="tab-pane fade">
                <div class="table-responsive">
                	<table cellpadding="0" cellspacing="0" border="0" class="display table" id="imeipending">
                        <thead>
                            <tr>
                                <th width="3%"><?php echo $this->lang->line('imei_fields_id'); ?></th>
                                <th width="15%"><?php echo $this->lang->line('imei_fields_imei'); ?></th>
                                <th width="20%"><?php echo $this->lang->line('imei_fields_method'); ?></th>
                                <th width="40%"><?php echo $this->lang->line('imei_fields_code'); ?></th>
                                <th width="7%"><?php echo $this->lang->line('imei_fields_note'); ?></th>
                                <th width="5%"><?php echo $this->lang->line('imei_fields_status'); ?></th>
                                <th width="10%"><?php echo $this->lang->line('imei_fields_datetime'); ?></th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
            <div id="latestnews" class="tab-pane fade">
                <div class="table-responsive">
                	<table cellpadding="0" cellspacing="0" border="0" class="display table" id="imeireject">
                        <thead>
                            <tr>
                            <th width="3%"><?php echo $this->lang->line('imei_fields_id'); ?></th>
                            <th width="15%"><?php echo $this->lang->line('imei_fields_imei'); ?></th>
                            <th width="20%"><?php echo $this->lang->line('imei_fields_method'); ?></th>
                            <th width="40%"><?php echo $this->lang->line('imei_fields_code'); ?></th>
                            <th width="7%"><?php echo $this->lang->line('imei_fields_note'); ?></th>
                            <th width="5%"><?php echo $this->lang->line('imei_fields_status'); ?></th>
                            <th width="10%"><?php echo $this->lang->line('imei_fields_datetime'); ?></th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
                <?php /* ?><div id="verifyimei" class="tab-pane fade">
                <table cellpadding="0" cellspacing="0" border="0" class="display" id="imeiverify">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>IMEI</th>
                            <th>Method</th>
                            <th>Email</th>
                            <th>Note</th>
                            <th>Status</th>
                            <th>Created date</th>
                        </tr>
                    </thead>	
                </table>
            </div><?php */ ?>
            </div>
        </div>
    </div>
</div>
<script>    
$(document).ready(function() {
    $('#imeiapproave').dataTable
    ({			  
        'bProcessing'    : true,
        'bServerSide'    : true,
        'bAutoWidth'     : false,
        'oLanguage'		 : <?php echo $this->lang->line('table_language'); ?>,
        'sPaginationType': 'full_numbers',
        'sAjaxSource'    : '<?php echo site_url('member/imeirequest/listener/Issued'); ?>',
        'aoColumnDefs': [ { "bSortable": false, "aTargets": [ 6 ] } ],
        'aLengthMenu': [25, 50, 100, 200, 500, 1000],
        'aaSorting'      : [[0, 'desc']],
        'iDisplayLength': 50,
        'sDom'		   : 'T<"clear">lfrtip', //datatable export buttons
        'oTableTools'	  : 
        { //datatable export buttons
        "sSwfPath": "<?php echo $this->config->item('assets_url');?>js/plugins/dataTables/media/swf/copy_csv_xls_pdf.swf",
        "sRowSelect": "multi"		      	
        }, 
        'aoColumns'      : 
            [
            {
                'bSearchable': false,
                'bVisible'   : true
            },			        
            null,
            null,
            null,
            null,
            null,
            null
            ],
            'fnServerData': function(sSource, aoData, fnCallback)
            {
    <?php				if($this->config->item('csrf_protection') === TRUE){	?>
            aoData.push({ name : '<?php echo $this->config->item('csrf_token_name'); ?>', value :  $.cookie('<?php echo $this->config->item('csrf_cookie_name'); ?>') });
    <?php				}	?>			      	
            $.ajax
            ({
                    'dataType': 'json',
                    'type'    : 'POST',
                    'url'     : sSource,
                    'data'    : aoData,
                    'success' : fnCallback
            });
            }
    });


    $('#imeipending').dataTable
    ({			  
        'bProcessing'    : true,
        'bServerSide'    : true,
        'bAutoWidth'     : false,
        'oLanguage'		 : <?php echo $this->lang->line('table_language'); ?>,
        'sPaginationType': 'full_numbers',
        'sAjaxSource'    : '<?php echo site_url('member/imeirequest/listener/Pending'); ?>',
        'aoColumnDefs': [ { "bSortable": false, "aTargets": [ 6 ] } ],
        'aLengthMenu': [25, 50, 100, 200, 500, 1000],
        'iDisplayLength': 50,
        'aaSorting'      : [[0, 'desc']],
        'sDom'		   : 'T<"clear">lfrtip', //datatable export buttons
        'oTableTools'	  : 
        { //datatable export buttons
        "sSwfPath": "<?php echo $this->config->item('assets_url');?>js/plugins/dataTables/media/swf/copy_csv_xls_pdf.swf",
        "sRowSelect": "multi"		      	
        }, 
        'aoColumns'      : 
            [
            {
                'bSearchable': false,
                'bVisible'   : true
            },			        
            null,
            null,
            null,
            null,
            null,
            null
            ],
            'fnServerData': function(sSource, aoData, fnCallback)
            {
    <?php				if($this->config->item('csrf_protection') === TRUE){	?>
            aoData.push({ name : '<?php echo $this->config->item('csrf_token_name'); ?>', value :  $.cookie('<?php echo $this->config->item('csrf_cookie_name'); ?>') });
    <?php				}	?>			      	
            $.ajax
            ({
                    'dataType': 'json',
                    'type'    : 'POST',
                    'url'     : sSource,
                    'data'    : aoData,
                    'success' : fnCallback
            });
            }
    });


    $('#imeireject').dataTable
    ({			  
        'bProcessing'    : true,
        'bServerSide'    : true,
        'bAutoWidth'     : false,
        'oLanguage'		 : <?php echo $this->lang->line('table_language'); ?>,
        'sPaginationType': 'full_numbers',
        'sAjaxSource'    : '<?php echo site_url('member/imeirequest/listener/Canceled'); ?>',
        'aoColumnDefs': [ { "bSortable": false, "aTargets": [ 6 ] } ],
        'aLengthMenu': [25, 50, 100, 200, 500, 1000],
        'iDisplayLength': 50,
        'aaSorting'      : [[0, 'desc']],
        'sDom'		   : 'T<"clear">lfrtip', //datatable export buttons
        'oTableTools'	  : 
        { //datatable export buttons
        "sSwfPath": "<?php echo $this->config->item('assets_url');?>js/plugins/dataTables/media/swf/copy_csv_xls_pdf.swf",
        "sRowSelect": "multi"		      	
        }, 
        'aoColumns'      : 
            [
            {
                'bSearchable': false,
                'bVisible'   : true
            },			        
            null,
            null,
            null,
            null,
            null,
            null
            ],
            'fnServerData': function(sSource, aoData, fnCallback)
            {
    <?php				if($this->config->item('csrf_protection') === TRUE){	?>
            aoData.push({ name : '<?php echo $this->config->item('csrf_token_name'); ?>', value :  $.cookie('<?php echo $this->config->item('csrf_cookie_name'); ?>') });
    <?php				}	?>			      	
            $.ajax
            ({
                    'dataType': 'json',
                    'type'    : 'POST',
                    'url'     : sSource,
                    'data'    : aoData,
                    'success' : fnCallback
            });
            }
    });

<?php /* ?>
    $('#imeiverify').dataTable
    ({			  
        'bProcessing'    : true,
        'bServerSide'    : true,
        'bAutoWidth'     : false,
        'sPaginationType': 'full_numbers',
        'sAjaxSource'    : '<?php echo site_url('member/imeirequest/listener/Verified'); ?>',
        'aoColumnDefs': [ { "bSortable": false, "aTargets": [ 6 ] } ],
        'aLengthMenu': [25, 50, 100, 200, 500, 1000],
        'iDisplayLength': 100,
        'sDom'		   : 'T<"clear">lfrtip', //datatable export buttons
        'oTableTools'	  : 
        { //datatable export buttons
        "sSwfPath": "<?php echo $this->config->item('assets_url');?>js/plugins/dataTables/media/swf/copy_csv_xls_pdf.swf",
        "sRowSelect": "multi"		      	
        }, 
        'aoColumns'      : 
            [
            {
                'bSearchable': false,
                'bVisible'   : true
            },			        
            null,
            null,
            null,
            null,
            null,
            null
            ],
            'fnServerData': function(sSource, aoData, fnCallback)
            {
    <?php				if($this->config->item('csrf_protection') === TRUE){	?>
            aoData.push({ name : '<?php echo $this->config->item('csrf_token_name'); ?>', value :  $.cookie('<?php echo $this->config->item('csrf_cookie_name'); ?>') });
    <?php				}	?>			      	
            $.ajax
            ({
                    'dataType': 'json',
                    'type'    : 'POST',
                    'url'     : sSource,
                    'data'    : aoData,
                    'success' : fnCallback
            });
            }
    });
<?php */ ?>    
});
</script>




