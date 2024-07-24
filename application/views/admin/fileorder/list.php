<div class="row">
	<div class="col-md-12">
		<!-- BEGIN SAMPLE TABLE PORTLET-->
		<div class="portlet">
			
			<?php echo form_open('admin/network/add', array('method' => 'post', 'id'=>'form')); ?>
			<div class="portlet-title">
				<div class="caption">
					<i class="fa fa-cogs"></i>File Service Orders
				</div>
			</div>
			<div class="portlet-body">
				<div class="table-responsive">
					<table class="table table-hover" cellpadding="0" cellspacing="0" width="100%" id="TableDeferLoading">
                        <thead>
                            <tr>
                                <th width="5%">ID</th>
                                <th width="13%">IMEI</th>
                                <th width="18%">Service</th>
                                <th width="20%">Email</th>
                                <th>Comments</th>
                                <th width="5%">Status</th>
                                <th width="15%">Created Date Time</th>         
                                <th width="10%">Options</th>
                            </tr>
                        </thead>
                        <tfoot>
                          <tr>
                                <th>ID</th>
                                <th>IMEI</th>
                                <th>Service</th>
                                <th>Email</th>
                                <th>Comments</th>
                                <th>Status</th>
                                <th>Created Date Time</th>      
                                <th>Options</th>   
                          </tr>                            
                        </tfoot>
					</table>
				</div>
                <button id="select_all" type="button" class="btn btn-success"> Select All</button>
                <button id="select_none" type="button" class="btn btn-success"> Clear Selected</button>
                <button id="bulk_issue" type="button" class="btn btn-success"> Reply Selected</button>
			</div>
			<?php echo form_close(); ?>
		</div>
		<!-- END SAMPLE TABLE PORTLET-->
	</div>
</div>

<script type="text/javascript" src="//cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="//cdn.datatables.net/select/1.2.5/js/dataTables.select.min.js"></script>
<script type="text/javascript" src="<?php echo $this->config->item('assets_url');?>plugins/datatables/extensions/TableTools/js/dataTables.tableTools.min.js"></script>
<script type="text/javascript" src="<?php echo $this->config->item('assets_url');?>plugins/datatables/extensions/ColReorder/js/dataTables.colReorder.min.js"></script>
<script type="text/javascript" src="<?php echo $this->config->item('assets_url');?>plugins/datatables/extensions/Scroller/js/dataTables.scroller.min.js"></script>
<script type="text/javascript" src="<?php echo $this->config->item('assets_url');?>plugins/datatables/plugins/bootstrap/dataTables.bootstrap.js"></script>
<script type="text/javascript" charset="utf-8">
$(document).ready(function() {
<?php if($this->config->item('csrf_protection') === TRUE){	?>	
	$.ajaxSetup({
		headers: {
			'<?php echo $this->config->item('csrf_token_name'); ?>': '<?php echo $this->config->item('csrf_cookie_name'); ?>'
		}
	});
<?php }	?>	
    var table = $('#TableDeferLoading').DataTable( {
        "processing": true,
		"serverSide": true,
		"deferRender": true,
        "select": true,
        "aLengthMenu": [25, 50, 100, 200, 500, 1000],
		"ajax": "<?php echo site_url('admin/fileorder/listener'); ?>",
		"order": [[ 0, 'asc' ]],
        "columnDefs": [
            { "orderable": false, "targets": [-1] },
            { "searchable": false, "targets": [-1] }
        ],
		"columns": [
            { "data": "ID" },
            { "data": "IMEI" },
			{ "data": "Title" },
            { "data": "Email" },
            { "data": "Comments" },
            { "data": "Status" },
            { "data": "CreatedDateTime" },
            { "data": "delete" }
		]
    } );
    $("#select_all").click(function(){
        table.rows().select();
    });
    $("#select_none").click(function(){
        table.rows().deselect();
    });
    $("#bulk_issue").click(function(){
        if(!confirm('Are you sure to issue code for selected records?')){
            return false;
        }
        var code_ids = new Array();
        table.rows({ "selected": true }).every( function () {
            var d = this.data();
            code_ids.push(parseInt(d.ID));
        });
        if(code_ids.length > 0){
            var form = $('<?php echo str_replace (array("\r\n", "\n", "\r"), '', form_open('admin/fileorder/bulk')); ?>' +
                '<input type="text" name="json" value="' + JSON.stringify(code_ids) + '" />' +
                '</form>');
            $('body').append(form);
            $(form).submit();
        }else{
            alert("No record selected.");
        }
    });
} );		
</script>