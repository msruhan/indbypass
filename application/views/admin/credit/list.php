<div class="row">
    <div class="col-md-12">
        <!-- BEGIN SAMPLE TABLE PORTLET-->
        <div class="portlet">
            
            <?php echo form_open('admin/credit/add', array('method' => 'post', 'id' => 'form')); ?> 
            <div class="portlet-title">
                <div class="caption">
                    <i class="fa fa-cogs"></i>Credits Management
                </div>
            </div>
            <div class="portlet-body">
                <div class="table-responsive">
                    <table class="table table-hover" cellpadding="0" cellspacing="0" width="100%" id="TableDeferLoading">
                        <thead>
                            <tr>
                                <th width="5%">ID</th>
                                <th width="12%">Code</th>
                                <th width="20%">Member</th>
                                <th>Description</th>
                                <th width="5%">Amount</th>
                                <th width="15%">Date Time</th>
                                <th width="5%">Action</th>
                            </tr>
                        </thead>
                    </table>
                </div>
                <?php echo form_close(); ?>
                
                <!-- <?php echo form_open('admin/credit/remove', array('method' => 'post', 'id' => 'removeCreditForm')); ?>
                    <button type="submit" class="btn btn-danger">Remove Credit <i class="fa fa-minus"></i></button>
                <?php echo form_close(); ?> -->

                <a href="<?php echo site_url('admin/credit/add'); ?>" class="btn btn-success">Add Credit <i class="fa fa-plus"></i></a>
            </div>
        </div>
        <!-- END SAMPLE TABLE PORTLET-->
    </div>
</div>

<script type="text/javascript" src="//cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="<?php echo $this->config->item('assets_url');?>plugins/datatables/extensions/TableTools/js/dataTables.tableTools.min.js"></script>
<script type="text/javascript" src="<?php echo $this->config->item('assets_url');?>plugins/datatables/extensions/ColReorder/js/dataTables.colReorder.min.js"></script>
<script type="text/javascript" src="<?php echo $this->config->item('assets_url');?>plugins/datatables/extensions/Scroller/js/dataTables.scroller.min.js"></script>
<script type="text/javascript" src="<?php echo $this->config->item('assets_url');?>plugins/datatables/plugins/bootstrap/dataTables.bootstrap.js"></script>
<script type="text/javascript" charset="utf-8">
$(document).ready(function() {
    <?php if($this->config->item('csrf_protection') === TRUE){ ?>
        $.ajaxSetup({
            headers: {
                '<?php echo $this->config->item('csrf_token_name'); ?>': '<?php echo $this->config->item('csrf_cookie_name'); ?>'
            }
        });
    <?php } ?>
    
    $('#TableDeferLoading').DataTable({
        "processing": true,
        "serverSide": true,
        "deferRender": true,
        "ajax": "<?php echo site_url('admin/credit/listener'); ?>",
        "order": [[ 0, 'desc' ]],
        "columnDefs": [
            { "orderable": false, "targets": [-1] },
            { "searchable": false, "targets": [-1] }
        ],
        "columns": [
            { "data": "ID" },
            { "data": "Code" },
            { "data": "Name" },
            { "data": "Description" },
            { "data": "Amount" },
            { "data": "CreatedDateTime" },
            { "data": "action" }
        ]
    });
});
</script>
