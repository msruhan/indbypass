<div class="row">
	<div class="col-md-12">
		<!-- BEGIN SAMPLE TABLE PORTLET-->
		<div class="portlet">
			
			<div class="portlet-title">
				<div class="caption">
					<i class="fa fa-cogs"></i>Members
				</div>
			</div>
			<div class="portlet-body">
				<div class="table-responsive">
					<table class="table table-hover" cellpadding="0" cellspacing="0" width="100%" id="TableDeferLoading">
						<thead>
							<tr>                                        
								<th width="5%">ID</th>
								<th width="12%">First Name</th>
								<th width="12%">Last Name</th>
								<th width="12%">Mobile</th>
								<th width="12%">Email</th>
								<th width="5%">Credits</th>
								<th width="5%">Status</th>
								<th width="15%">Created Date Time</th>                                        
								<th width="12%">Options</th>                                
							</tr>
						</thead>
					</table>
				</div>
				<a href="<?php echo site_url('admin/member/add') ?>"><button id="sample_editable_1_new" class="btn btn-success"> Add Member <i class="fa fa-plus"></i></button></a>
			</div>
		</div>
		<!-- END SAMPLE TABLE PORTLET-->
	</div>
</div>
<script src="//cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"  type="text/javascript"></script>
<script src="<?php echo $this->config->item('assets_url');?>plugins/datatables/extensions/TableTools/js/dataTables.tableTools.min.js"  type="text/javascript"></script>
<script src="<?php echo $this->config->item('assets_url');?>plugins/datatables/extensions/ColReorder/js/dataTables.colReorder.min.js"  type="text/javascript"></script>
<script src="<?php echo $this->config->item('assets_url');?>plugins/datatables/extensions/Scroller/js/dataTables.scroller.min.js"  type="text/javascript"></script>
<script src="<?php echo $this->config->item('assets_url');?>plugins/datatables/plugins/bootstrap/dataTables.bootstrap.js"  type="text/javascript"></script>
<script src="<?php echo $this->config->item('assets_url');?>plugins/bootstrap-switch/js/bootstrap-switch.min.js" type="text/javascript"></script>
<script type="text/javascript" charset="utf-8">
$(document).ready(function() {
<?php if($this->config->item('csrf_protection') === TRUE){	?>	
	$.ajaxSetup({
		headers: {
			'<?php echo $this->config->item('csrf_token_name'); ?>': '<?php echo $this->config->item('csrf_cookie_name'); ?>'
		}
	});
<?php }	?>	
    $('#TableDeferLoading').DataTable( {
        "processing": true,
		"serverSide": true,
		"deferRender": true,
		"ajax": "<?php echo site_url('admin/member/listener'); ?>",
		"order": [[ 0, 'asc' ]],
        "columnDefs": [
            { "orderable": false, "targets": [-1,-4] },
            { "searchable": false, "targets": [-1,-3,-4] }
        ],
		"columns": [
            { "data": "ID" },
            { "data": "FirstName" },
			{ "data": "LastName" },
			{ "data": "Mobile" },
			{ "data": "Email" },
			{ "data": "Credits" },
			{ "data": "Status", render : function(id, type, row) {
				var status = row.Status == 'Enabled'? 'Enabled': 'Enabled';
				var checked = row.Status == 'Enabled'? 'checked': '';
				return '<input type="checkbox" name="Status" class="make-switch" value="'+row.ID+'" data-size="small" '+checked+'>';
			}},
			{ "data": "CreatedDateTime" },
            { "data": "delete"}
		],
		"initComplete": function( settings, json ) {
		},
		"drawCallback": function( settings ) {
			$('.make-switch').bootstrapSwitch();
			$('.make-switch').on('switchChange.bootstrapSwitch', function (e, s) {
				if(s){
					var status = 'Enabled';
				}else{
					var status = 'Disabled';
				}
				$.get( "<?php echo site_url('admin/member/status') ?>?id="+e.target.value+"&status="+status );
			});
		}
    } );
} );	
</script>   