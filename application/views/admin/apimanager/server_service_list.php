<div class="row">
	<div class="col-md-12">
		<!-- BEGIN SAMPLE TABLE PORTLET-->
		<div class="portlet">
			<div class="portlet-title">
				<div class="caption">
					<i class="fa fa-cogs"></i>Server Services List
				</div>
            </div>
            <div class="portlet-body">
                <div class="table-responsive">
                    <?php echo form_open('admin/apimanager/add_server_service_list/'.$this->uri->segment(4), array('method' => 'post','id'=>'form')); ?>
                    <table class="table table-striped table-hover" >
                        <thead>
                            <tr>                           
                                <th width="3%"><input type="checkbox" name="checkall" id="checkAll"/></th>             
                                <th width="24%">Service Name</th>
                                <th width="5%">Price</th>
                                <th width="5%">Info</th>
                                <th width="12%">Time</th>
                                <th width="12%">Network</th>
                                <th width="7%">Set Price</th>
                            </tr>
                        </thead>
                        <tbody>
                    <?php
                    foreach($service_list as $groups)
                    {
                        foreach($groups['SERVICES'] as $service )
                        {
                            $service_id = $service['SERVICEID'];
                        ?>
                          <tr>
                            <td>
                            <input type="checkbox" value="<?php echo $service_id; ?>" name="chk[]" class="checkbox" />
                            <input type="hidden" name="RequiredFields[<?php echo $service_id ?>]" value="<?php echo array_key_exists('REQUIRED', $service)?$service['REQUIRED']:''?>" disabled="disabled">
                            <input type="hidden" name="ToolID[<?php echo $service_id ?>]" value="<?php echo array_key_exists('SERVICEID', $service)?$service['SERVICEID']:''?>" disabled="disabled">
                            </td>
                            <td><input type="text" name="ServiceName[<?php echo $service_id; ?>]" value="<?php echo $service['SERVICENAME']; ?>" class="form-control input-sm" disabled="disabled" /></td>
                            <td><input type="text" value="<?php echo $service['CREDIT']; ?>" class="form-control input-sm" disabled="disabled" /></td>
                            <td><?php echo substr(strip_tags($service['INFO']), 0, 100); ?>...</td>
                            <td><input type="text" name="Time[<?php echo $service_id; ?>]" value="<?php echo $service['TIME']; ?>" class="form-control input-sm" disabled="disabled" /></td>
                            <td>
                            <select name="ServerBoxID[<?php echo $service_id; ?>]"  class="form-control input-sm" disabled="disabled">
                            <?php foreach($networks as $val): ?>
                              <option value="<?php echo $val['ID']; ?>" ><?php echo $val['Title']; ?></option>
                            <?php endforeach; ?>	
                            </select>
                            </td>
                            <td><input type="text" name="Price[<?php echo $service_id; ?>]" value="<?php echo $service['CREDIT']; ?>" class="form-control input-sm" disabled="disabled" /></td>
                        </tr>
                    <?php
                        }
                    }
                    ?>
                    </tbody>
                    </table>
                    <button type="submit" class="btn btn-info">Add Selected Services</button>
                    <?php echo form_close(); ?>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
$(function() {
    $('#checkAll').click(function () {    
        var check = $(this).prop('checked');
        if(check == true) {
            $('.checker').find('span').addClass('checked');
            $('.checkbox').prop('checked', true);
        } else {
            $('.checker').find('span').removeClass('checked');
            $('.checkbox').prop('checked', false);
        }
    });

    $("input[name*='chk[]']").click(function () {    
        var check = $(this).prop('checked');
        var v = $(this).val();
        if(check == true) {
            $( "input[name*='["+v+"]']" ).prop('disabled', false);
            $( "select[name*='["+v+"]']" ).prop('disabled', false);
        } else {
            $( "input[name*='["+v+"]']" ).prop('disabled', true);
            $( "select[name*='["+v+"]']" ).prop('disabled', true);
        }
    });
});
</script>