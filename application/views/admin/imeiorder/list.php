<div class="row">
	<div class="col-md-12">
        <!-- BEGIN SAMPLE FORM PORTLET-->
        <div class="portlet ">
            <div class="portlet-title">
                <div class="caption">
                    <i class="fa fa-reorder"></i> Search Form
                </div>
                <div class="tools">
                    <a href="" class="collapse"></a>
                    <a href="#portlet-config" data-toggle="modal" class="config"></a>
                    <a href="" class="reload"></a>
                    <a href="" class="remove"></a>
                </div>
            </div>
            <div class="portlet-body form">
                <form class="form-horizontal" role="form">
                    <div class="form-body">
                        <div class="form-group">
                            <label class="col-md-1 control-label">IMEI</label>
                            <div class="col-md-3">
                                <input type="text" id="imei" class="form-control" placeholder="Enter imei">
                            </div>
                            <label class="col-md-1 control-label">Method</label>
                            <div class="col-md-4">
                                <select id="method" class="form-control">
                                    <option value="">All Methods</option>
                                <?php foreach ($methods as $m): ?>
                                    <option value="<?php echo $m['ID']; ?>"><?php echo $m['Title'] ?></option>
                                <?php endforeach ?>
                                </select>
                            </div>
                            <label class="col-md-1 control-label">Status</label>
                            <div class="col-md-2">
                                <select id="status" class="form-control">
                                    <option value="">All Status</option>
                                    <option>Pending</option>
                                    <option>Issued</option>
                                    <option>Canceled</option>
                                    <!-- <option>Verified</option> -->
                                </select>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <!-- END SAMPLE FORM PORTLET-->
		<!-- BEGIN SAMPLE TABLE PORTLET-->
		<div class="portlet">
			<?php echo form_open('admin/network/add', array('method' => 'post', 'id'=>'form')); ?>
			<div class="portlet-title">
				<div class="caption">
					<i class="fa fa-cogs"></i>IMEI Orders
				</div>
			</div>
			<div class="portlet-body">
				<div class="table-responsive">
					<table class="table table-hover" cellpadding="0" cellspacing="0" width="100%" id="TableDeferLoading">
                        <thead>
                            <tr>
                              <th width="5%">ID</th>
                              <th width="13%">IMEI</th>
                              <th width="23%">Method</th>
                              <th width="15%">Email</th>
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
                            <th>Method</th>
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
		"ajax": "<?php echo site_url('admin/imeiorder/listener'); ?>",
		"order": [[ 0, 'desc' ]],
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
    $('#imei').keyup(function(){
        table.columns( 1 ).search( jQuery(this).val() ).draw();
    });
    $('#method').change(function(){
        table.columns( 2 ).search( jQuery(this).val() ).draw();
    });
    $('#status').change(function(){
        table.columns( 5 ).search( jQuery(this).val() ).draw();
    });
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
            var form = $('<?php echo str_replace (array("\r\n", "\n", "\r"), '', form_open('admin/imeiorder/bulk')); ?>' +
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