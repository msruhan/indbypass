<?php $status_options = ['Pending' => 'Pending', 'Issued' => 'Issued', 'Verified' => 'Verified']; ?>
<div class="portlet">
    <div class="portlet-body form">
    	
        <div class="head clearfix">
            <div class="isw-documents"></div>
            <h3 style="padding:10px;">IMEI Order Update</h3>
        </div>
		<?php echo form_open("admin/imeiorder/update", ['class' => "form-horizontal", 'role' => "form"]); ?>
        <input type="hidden" name="ID" value="<?php echo $data[0]['ID'] ?>" />
            <div class="form-body">
                <div class="form-group">
                    <label class="col-md-3 control-label">Method:</label>
                    <div class="col-md-6">
                        <?php echo form_dropdown('MethodID', $method_list, set_value('MethodID', $data[0]['MethodID']), 'id="MethodID" class="form-control"'); ?>
                    </div>
                </div>
				<div class="form-group">
                    <label class="col-md-3 control-label">Maker:</label>
                    <div class="input-group col-md-6">
                        <span class="input-group-addon">
                        <i class="fa fa-font"></i>
                        </span>
                        <?php echo form_input(array('name'=>"Maker",'id'=>"Maker", 'class'=>"form-control", 'value'=>set_value('Maker', $data[0]['Maker']))); ?>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-3 control-label">Model:</label>
                    <div class="input-group col-md-6">
                        <span class="input-group-addon">
                        <i class="fa fa-font"></i>
                        </span>
                        <?php echo form_input(array('name'=>"Model",'id'=>"Model", 'class'=>"form-control", 'value'=>set_value('Model', $data[0]['Model']))); ?>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-3 control-label">IMEI:</label>
                    <div class="input-group col-md-6">
                        <span class="input-group-addon">
                        <i class="fa fa-font"></i>
                        </span>
                        <?php echo form_input(array('name'=>"IMEI",'id'=>"IMEI", 'class'=>"form-control", 'value'=>set_value('IMEI', $data[0]['IMEI']))); ?>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-3 control-label">iCloud Information:</label>
                    <div class="col-md-6 input-group">
                        <span class="input-group-addon">
                            <i class="fa fa-font"></i>
                            </span>
                            <?php echo form_textarea(array('name'=>"ExtraInformation", 'id'=>"ExtraInformation", 'class'=>"form-control", 'value'=>set_value('ExtraInformation', $data[0]['ExtraInformation']))); ?>
                        </span>    
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-3 control-label">Country and Carrier info:</label>
                    <div class="input-group col-md-6">
                        <span class="input-group-addon">
                        <i class="fa fa-font"></i>
                        </span>
                        <?php echo form_input(array('name'=>"iCloudCarrierInfo",'id'=>"iCloudCarrierInfo", 'class'=>"form-control", 'value'=>set_value('iCloudCarrierInfo', $data[0]['iCloudCarrierInfo']))); ?>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-3 control-label">Apple ID Hint:</label>
                    <div class="input-group col-md-6">
                        <span class="input-group-addon">
                        <i class="fa fa-font"></i>
                        </span>
                        <?php echo form_input(array('name'=>"iCloudAppleIDHint",'id'=>"iCloudAppleIDHint", 'class'=>"form-control", 'value'=>set_value('iCloudAppleIDHint', $data[0]['iCloudAppleIDHint']))); ?>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-3 control-label">Photo of Activation Lock Screenshot:</label>
                    <div class="input-group col-md-6">
                        <span class="input-group-addon">
                        <i class="fa fa-font"></i>
                        </span>
                        <?php echo form_input(array('name'=>"iCloudActivationLockScreenshot",'id'=>"iCloudActivationLockScreenshot", 'class'=>"form-control", 'value'=>set_value('iCloudActivationLockScreenshot', $data[0]['iCloudActivationLockScreenshot']))); ?>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-3 control-label">Photo of IMEI Number Screenshot:</label>
                    <div class="input-group col-md-6">
                        <span class="input-group-addon">
                        <i class="fa fa-font"></i>
                        </span>
                        <?php echo form_input(array('name'=>"iCloudIMEINumberScreenshot",'id'=>"iCloudIMEINumberScreenshot", 'class'=>"form-control", 'value'=>set_value('iCloudIMEINumberScreenshot', $data[0]['iCloudIMEINumberScreenshot']))); ?>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-3 control-label">Apple ID (Email):</label>
                    <div class="input-group col-md-6">
                        <span class="input-group-addon">
                        <i class="fa fa-font"></i>
                        </span>
                        <?php echo form_input(array('name'=>"iCloudAppleIdEmail",'id'=>"iCloudAppleIdEmail", 'class'=>"form-control", 'value'=>set_value('iCloudAppleIdEmail', $data[0]['iCloudAppleIdEmail']))); ?>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-3 control-label">Photo of Apple ID Screenshot:</label>
                    <div class="input-group col-md-6">
                        <span class="input-group-addon">
                        <i class="fa fa-font"></i>
                        </span>
                        <?php echo form_input(array('name'=>"iCloudAppleIdScreenshot",'id'=>"iCloudAppleIdScreenshot", 'class'=>"form-control", 'value'=>set_value('iCloudAppleIdScreenshot', $data[0]['iCloudAppleIdScreenshot']))); ?>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-3 control-label">Apple ID Info:</label>
                    <div class="input-group col-md-6">
                        <span class="input-group-addon">
                        <i class="fa fa-font"></i>
                        </span>
                        <?php echo form_input(array('name'=>"iCloudAppleIdInfo",'id'=>"iCloudAppleIdInfo", 'class'=>"form-control", 'value'=>set_value('iCloudAppleIdInfo', $data[0]['iCloudAppleIdInfo']))); ?>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-3 control-label">Phone Number:</label>
                    <div class="input-group col-md-6">
                        <span class="input-group-addon">
                        <i class="fa fa-font"></i>
                        </span>
                        <?php echo form_input(array('name'=>"iCloudPhoneNumber",'id'=>"iCloudPhoneNumber", 'class'=>"form-control", 'value'=>set_value('iCloudPhoneNumber', $data[0]['iCloudPhoneNumber']))); ?>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-3 control-label">iCloud ID:</label>
                    <div class="input-group col-md-6">
                        <span class="input-group-addon">
                        <i class="fa fa-font"></i>
                        </span>
                        <?php echo form_input(array('name'=>"iCloudID",'id'=>"iCloudID", 'class'=>"form-control", 'value'=>set_value('iCloudID', $data[0]['iCloudID']))); ?>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-3 control-label">Password:</label>
                    <div class="input-group col-md-6">
                        <span class="input-group-addon">
                        <i class="fa fa-font"></i>
                        </span>
                        <?php echo form_input(array('name'=>"iCloudPassword",'id'=>"iCloudPassword", 'class'=>"form-control", 'value'=>set_value('iCloudPassword', $data[0]['iCloudPassword']))); ?>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-3 control-label">UDID:</label>
                    <div class="input-group col-md-6">
                        <span class="input-group-addon">
                        <i class="fa fa-font"></i>
                        </span>
                        <?php echo form_input(array('name'=>"iCloudUDID",'id'=>"iCloudUDID", 'class'=>"form-control", 'value'=>set_value('iCloudUDID', $data[0]['iCloudUDID']))); ?>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-3 control-label">ICCID:</label>
                    <div class="input-group col-md-6">
                        <span class="input-group-addon">
                        <i class="fa fa-font"></i>
                        </span>
                        <?php echo form_input(array('name'=>"iCloudICCID",'id'=>"iCloudICCID", 'class'=>"form-control", 'value'=>set_value('iCloudICCID', $data[0]['iCloudICCID']))); ?>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-3 control-label">Clear Video:</label>
                    <div class="input-group col-md-6">
                        <span class="input-group-addon">
                        <i class="fa fa-font"></i>
                        </span>
                        <?php echo form_input(array('name'=>"iCloudVideo",'id'=>"iCloudVideo", 'class'=>"form-control", 'value'=>set_value('iCloudVideo', $data[0]['iCloudVideo']))); ?>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-3 control-label">Email:</label>
                    <div class="input-group col-md-6">
                        <span class="input-group-addon">
                        <i class="fa fa-font"></i>
                        </span>
                        <?php echo form_input(array('name'=>"Email",'id'=>"Email", 'class'=>"form-control", 'value'=>set_value('Email', $data[0]['Email']))); ?>
                    </div>
                </div>
                <!--<div class="form-group">
                    <label class="col-md-3 control-label">Mobile No:</label>
                    <div class="input-group col-md-6">
                        <span class="input-group-addon">
                        <i class="fa fa-font"></i>
                        </span>
                        <?php echo form_input(array('name'=>"MobileNo",'id'=>"MobileNo", 'class'=>"form-control", 'value'=>set_value('MobileNo', $data[0]['MobileNo']))); ?>
                    </div>
                </div>-->
                <div class="form-group">
                    <label class="col-md-3 control-label">Note:</label>
                    <div class="input-group col-md-6">
                        <span class="input-group-addon">
                        <i class="fa fa-font"></i>
                        </span>
                        <?php echo form_textarea(array('name'=>"Note",'id'=>"Note", 'class'=>"form-control", 'value'=>set_value('Note', $data[0]['Note']))); ?>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-3 control-label">Comments:</label>
                    <div class="input-group col-md-6">
                        <span class="input-group-addon">
                        <i class="fa fa-font"></i>
                        </span>
                        <?php echo form_textarea(array('name'=>"Comments",'id'=>"Comments", 'class'=>"form-control", 'value'=>set_value('Comments', $data[0]['Comments']))); ?>
                    </div>
                </div>
				<div class="form-group">
                    <label class="col-md-3 control-label">Status:</label>
                    <div class="col-md-6">
                        <?php echo form_dropdown('Status', $status_options, set_value('Status', $data[0]['Status']), 'class="form-control"'); ?>
                    </div>
                </div>
            </div>
            <div class="form-actions">
                <button type="submit" class="btn btn-info">Submit</button>
            </div>
        <?php echo form_close(); ?>
    </div>
</div>