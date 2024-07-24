<div class="row">
	<div class="col-md-12">
		<!-- BEGIN SAMPLE TABLE PORTLET-->
		<div class="portlet">
			<div class="portlet-title">
				<div class="caption">
					<i class="fa fa-cogs"></i>IMEI Services List
				</div>
            </div>
            <div class="portlet-body">
                <div class="table-responsive">
                    <?php echo form_open('admin/apimanager/add_imei_service_list/'.$this->uri->segment(4), array('method' => 'post','id'=>'form')); ?>
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
                            <input type="hidden" name="Network[<?php echo $service_id ?>]" value="<?php echo array_key_exists('Requires.Network', $service)?$service['Requires.Network']:'None'?>" disabled="disabled">
                            <input type="hidden" name="Mobile[<?php echo $service_id ?>]" value="<?php echo array_key_exists('Requires.Mobile', $service)?$service['Requires.Mobile']:'None'?>" disabled="disabled">
                            <input type="hidden" name="Provider[<?php echo $service_id ?>]" value="<?php echo array_key_exists('Requires.Provider', $service)?$service['Requires.Provider']:'None'?>" disabled="disabled">
                            <input type="hidden" name="PIN[<?php echo $service_id ?>]" value="<?php echo array_key_exists('Requires.PIN', $service)?$service['Requires.PIN']:'None'?>" disabled="disabled">
                            <input type="hidden" name="KBH[<?php echo $service_id ?>]" value="<?php echo array_key_exists('Requires.KBH', $service)?$service['Requires.KBH']:'None'?>" disabled="disabled">
                            <input type="hidden" name="MEP[<?php echo $service_id ?>]" value="<?php echo array_key_exists('Requires.MEP', $service)?$service['Requires.MEP']:'None'?>" disabled="disabled">
                            <input type="hidden" name="PRD[<?php echo $service_id ?>]" value="<?php echo array_key_exists('Requires.PRD', $service)?$service['Requires.PRD']:'None'?>" disabled="disabled">
                            <input type="hidden" name="Type[<?php echo $service_id ?>]" value="<?php echo array_key_exists('Requires.Type', $service)?$service['Requires.Type']:'None'?>" disabled="disabled">
                            <input type="hidden" name="Locks[<?php echo $service_id ?>]" value="<?php echo array_key_exists('Requires.Locks', $service)?$service['Requires.Locks']:'None'?>" disabled="disabled">
                            <input type="hidden" name="Reference[<?php echo $service_id ?>]" value="<?php echo array_key_exists('Requires.Reference', $service)?$service['Requires.Reference']:'None'?>" disabled="disabled">
                            <!-- ## Exclusive Unlock Fields ## -->
                            <input type="hidden" name="ExtraInformation[<?php echo $service_id ?>]" value="<?php echo array_key_exists('ExtraInformation', $service)?$service['ExtraInformation']:'None'?>" disabled="disabled">
                            <input type="hidden" name="iCloudCarrierInfo[<?php echo $service_id ?>]" value="<?php echo array_key_exists('iCloudCarrierInfo', $service)?$service['iCloudCarrierInfo']:'None'?>" disabled="disabled">
                            <input type="hidden" name="iCloudAppleIDHint[<?php echo $service_id ?>]" value="<?php echo array_key_exists('iCloudAppleIDHint', $service)?$service['iCloudAppleIDHint']:'None'?>" disabled="disabled">
                            <input type="hidden" name="iCloudActivationLockScreenshot[<?php echo $service_id ?>]" value="<?php echo array_key_exists('iCloudActivationLockScreenshot', $service)?$service['iCloudActivationLockScreenshot']:'None'?>" disabled="disabled">
                            <input type="hidden" name="iCloudIMEINumberScreenshot[<?php echo $service_id ?>]" value="<?php echo array_key_exists('iCloudIMEINumberScreenshot', $service)?$service['iCloudIMEINumberScreenshot']:'None'?>" disabled="disabled">
                            <input type="hidden" name="iCloudAppleIdEmail[<?php echo $service_id ?>]" value="<?php echo array_key_exists('iCloudAppleIdEmail', $service)?$service['iCloudAppleIdEmail']:'None'?>" disabled="disabled">
                            <input type="hidden" name="iCloudAppleIdScreenshot[<?php echo $service_id ?>]" value="<?php echo array_key_exists('iCloudAppleIdScreenshot', $service)?$service['iCloudAppleIdScreenshot']:'None'?>" disabled="disabled">
                            <input type="hidden" name="iCloudAppleIdInfo[<?php echo $service_id ?>]" value="<?php echo array_key_exists('iCloudAppleIdInfo', $service)?$service['iCloudAppleIdInfo']:'None'?>" disabled="disabled">
                            <input type="hidden" name="iCloudPhoneNumber[<?php echo $service_id ?>]" value="<?php echo array_key_exists('iCloudPhoneNumber', $service)?$service['iCloudPhoneNumber']:'None'?>" disabled="disabled">
                            <input type="hidden" name="iCloudID[<?php echo $service_id ?>]" value="<?php echo array_key_exists('iCloudID', $service)?$service['iCloudID']:'None'?>" disabled="disabled">
                            <input type="hidden" name="iCloudPassword[<?php echo $service_id ?>]" value="<?php echo array_key_exists('iCloudPassword', $service)?$service['iCloudPassword']:'None'?>" disabled="disabled">
                            <input type="hidden" name="iCloudUDID[<?php echo $service_id ?>]" value="<?php echo array_key_exists('iCloudUDID', $service)?$service['iCloudUDID']:'None'?>" disabled="disabled">
                            <input type="hidden" name="iCloudICCID[<?php echo $service_id ?>]" value="<?php echo array_key_exists('iCloudICCID', $service)?$service['iCloudICCID']:'None'?>" disabled="disabled">
                            <input type="hidden" name="iCloudVideo[<?php echo $service_id ?>]" value="<?php echo array_key_exists('iCloudVideo', $service)?$service['iCloudVideo']:'None'?>" disabled="disabled">
                            </td>
                            <td><input type="text" name="ServiceName[<?php echo $service_id; ?>]" value="<?php echo $service['SERVICENAME']; ?>" class="form-control input-sm" disabled="disabled" /></td>
                            <td><input type="text" value="<?php echo $service['CREDIT']; ?>" class="form-control input-sm" disabled="disabled" /></td>
                            <td><?php echo substr(strip_tags($service['INFO']), 0, 100); ?>...</td>
                            <td><input type="text" name="Time[<?php echo $service_id; ?>]" value="<?php echo $service['TIME']; ?>" class="form-control input-sm" disabled="disabled" /></td>
                            <td>
                            <select name="NetworkID[<?php echo $service_id; ?>]"  class="form-control input-sm" disabled="disabled">
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