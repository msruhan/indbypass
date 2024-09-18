<?php $required_options = [ 0 => 'No', 1 => 'Yes'] ?>
<div class="portlet">
    <div class="portlet-body form">
    	
        <div class="head clearfix">
            <div class="isw-documents"></div>
            <h3 style="padding:10px;">IMEI Service Edit</h3>
        </div>
		<?php echo form_open("admin/method/update", ['class' => "form-horizontal", 'role' => "form"]); ?>
        <input type="hidden" name="ID" value="<?php echo $data[0]['ID'] ?>" />
            <div class="form-body">
				<div class="form-group">
                    <label class="col-md-3 control-label">Title:</label>
                    <div class="input-group col-md-6">
                        <span class="input-group-addon">
                        <i class="fa fa-font"></i>
                        </span>
                        <?php echo form_input(array('name'=>"Title",'id'=>"Title", 'class'=>"form-control", 'value'=>set_value('Title', $data[0]['Title']))); ?>
                    </div>
                </div>
				<div class="form-group">
                    <label class="col-md-3 control-label">Delivery Time:</label>
                    <div class="input-group col-md-6">
                        <span class="input-group-addon">
                        <i class="fa fa-clock-o"></i>
                        </span>
                        <?php echo form_input(array('name'=>"DeliveryTime", 'id'=>"DeliveryTime", 'class'=>"form-control", 'value'=>set_value('DeliveryTime', $data[0]['DeliveryTime']))); ?>
                    </div>
                </div>
				<div class="form-group">
                    <label class="col-md-3 control-label">Description:</label>
                    <div class="input-group col-md-6">
                        <span class="input-group-addon">
                        <i class="fa fa-font"></i>
                        </span>
                        <?php echo form_textarea(array('name'=>"Description", 'class'=>"form-control", 'id'=>"Description", 'value'=>set_value('Description', $data[0]['Description']))); ?>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-3 control-label">Price:</label>
                    <div class="input-group col-md-6">
                        <span class="input-group-addon">
                        <i class="fa fa-dollar"></i>
                        </span>
                        <?php echo form_input(array('name'=>"Price", 'id'=>"Price", 'class'=>"form-control", 'value'=>set_value('Price', $data[0]['Price']))); ?>
                    </div>
                </div>
				<div class="form-group">
                    <label class="col-md-3 control-label">Tool ID:</label>
                    <div class="input-group col-md-6">
                        <span class="input-group-addon">
                        <i class="fa fa-wrench"></i>
                        </span>
						<?php echo form_input(array('name'=>"ToolID",'id'=>"ToolID", 'class'=>"form-control", 'value'=>set_value('ToolID', $data[0]['ToolID']))); ?>
                    </div>
                </div>
				<div class="form-group">
                    <label class="col-md-3 control-label">API:</label>
                    <div class="col-md-6">
						<?php echo form_dropdown('ApiID', $api_list, set_value('ApiID', $data[0]['ApiID']), 'id="ApiID" class="form-control"'); ?>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-3 control-label">Network:</label>
                    <div class="col-md-6">
						<?php echo form_dropdown('NetworkID', $network_list, set_value('NetworkID', $data[0]['NetworkID']), 'id="NetworkID" class="form-control"'); ?>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-3 control-label">Order Field Type:</label>
                    <div class="col-md-6">
                        <div class="radio-list">
                            <label class="radio-inline">
						        <?php echo form_radio('FieldType', ORDER_FIELD_TYPE_IMEI, set_value('FieldType', $data[0]['FieldType']) == ORDER_FIELD_TYPE_IMEI? TRUE: FALSE ); ?> IMEI
                            </label>
                            <label class="radio-inline">
						        <?php echo form_radio('FieldType', ORDER_FIELD_TYPE_SN, set_value('FieldType', $data[0]['FieldType']) == ORDER_FIELD_TYPE_SN? TRUE: FALSE ); ?> Serial Number
                            </label>
                            <label class="radio-inline">
						        <?php echo form_radio('FieldType', ORDER_FIELD_TYPE_UNIVERSAL, set_value('FieldType', $data[0]['FieldType']) == ORDER_FIELD_TYPE_UNIVERSAL? TRUE: FALSE ); ?> Universal
                            </label>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-3 control-label">Extra Information Required:</label>
                    <div class="col-md-6">
						<?php echo form_dropdown('ExtraInformation', $required_options, set_value('ExtraInformation', $data[0]['ExtraInformation']), 'class="form-control"'); ?>
                    </div>
                </div>
                
                <div class="form-group">
                    <label class="col-md-3 control-label">Country and Carrier info:</label>
                    <div class="col-md-6">
						<?php echo form_dropdown('iCloudCarrierInfo', $required_options, set_value('iCloudCarrierInfo', $data[0]['iCloudCarrierInfo']), 'class="form-control"'); ?>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-3 control-label">Apple ID Hint :</label>
                    <div class="col-md-6">
						<?php echo form_dropdown('iCloudAppleIDHint', $required_options, set_value('iCloudAppleIDHint', $data[0]['iCloudAppleIDHint']), 'class="form-control"'); ?>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-3 control-label">Photo of Activation Lock Screenshot:</label>
                    <div class="col-md-6">
						<?php echo form_dropdown('iCloudActivationLockScreenshot', $required_options, set_value('iCloudActivationLockScreenshot', $data[0]['iCloudActivationLockScreenshot']), 'class="form-control"'); ?>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-3 control-label">Photo of IMEI Number Screenshot:</label>
                    <div class="col-md-6">
						<?php echo form_dropdown('iCloudIMEINumberScreenshot', $required_options, set_value('iCloudIMEINumberScreenshot', $data[0]['iCloudIMEINumberScreenshot']), 'class="form-control"'); ?>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-3 control-label">Apple ID (Email):</label>
                    <div class="col-md-6">
						<?php echo form_dropdown('iCloudAppleIdEmail', $required_options, set_value('iCloudAppleIdEmail', $data[0]['iCloudAppleIdEmail']), 'class="form-control"'); ?>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-3 control-label">Photo of Apple ID Screenshot:</label>
                    <div class="col-md-6">
						<?php echo form_dropdown('iCloudAppleIdScreenshot', $required_options, set_value('iCloudAppleIdScreenshot', $data[0]['iCloudAppleIdScreenshot']), 'class="form-control"'); ?>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-3 control-label">Apple ID Info:</label>
                    <div class="col-md-6">
						<?php echo form_dropdown('iCloudAppleIdInfo', $required_options, set_value('iCloudAppleIdInfo', $data[0]['iCloudAppleIdInfo']), 'class="form-control"'); ?>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-3 control-label">Phone Number:</label>
                    <div class="col-md-6">
						<?php echo form_dropdown('iCloudPhoneNumber', $required_options, set_value('iCloudPhoneNumber', $data[0]['iCloudPhoneNumber']), 'class="form-control"'); ?>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-3 control-label">iCloud ID:</label>
                    <div class="col-md-6">
						<?php echo form_dropdown('iCloudID', $required_options, set_value('iCloudID', $data[0]['iCloudID']), 'class="form-control"'); ?>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-3 control-label">Password:</label>
                    <div class="col-md-6">
						<?php echo form_dropdown('iCloudPassword', $required_options, set_value('iCloudPassword', $data[0]['iCloudPassword']), 'class="form-control"'); ?>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-3 control-label">UDID:</label>
                    <div class="col-md-6">
						<?php echo form_dropdown('iCloudUDID', $required_options, set_value('iCloudUDID', $data[0]['iCloudUDID']), 'class="form-control"'); ?>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-3 control-label">ICCID:</label>
                    <div class="col-md-6">
						<?php echo form_dropdown('iCloudICCID', $required_options, set_value('iCloudICCID', $data[0]['iCloudICCID']), 'class="form-control"'); ?>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-3 control-label">Clear Video - Activation Process, Must Show:</label>
                    <div class="col-md-6">
						<?php echo form_dropdown('iCloudVideo', $required_options, set_value('iCloudVideo', $data[0]['iCloudVideo']), 'class="form-control"'); ?>
                    </div>
                </div>
                
				<div class="form-group">
                    <label class="col-md-3 control-label">Network Required:</label>
                    <div class="col-md-6">
						<?php echo form_dropdown('Network', $required_options, set_value('Network', $data[0]['Network']), 'class="form-control"'); ?>
                    </div>
                </div>
				<div class="form-group">
                    <label class="col-md-3 control-label">Mobile Required:</label>
                    <div class="col-md-6">
                        <?php echo form_dropdown('Mobile', $required_options, set_value('Mobile', $data[0]['Mobile']), 'class="form-control"'); ?>
                    </div>
                </div>
				<div class="form-group">
                    <label class="col-md-3 control-label">Serial Number Required:</label>
                    <div class="col-md-6">
                        <?php echo form_dropdown('SerialNumber', $required_options, set_value('SerialNumber', $data[0]['SerialNumber']), 'class="form-control"'); ?>
                    </div>
                </div>
				<div class="form-group">
                    <label class="col-md-3 control-label">Provider Required:</label>
                    <div class="col-md-6">
                        <?php echo form_dropdown('Provider', $required_options, set_value('Provider', $data[0]['Provider']), 'class="form-control"'); ?>
                    </div>
                </div>
				<div class="form-group">
                    <label class="col-md-3 control-label">PIN Required:</label>
                    <div class="col-md-6">
                        <?php echo form_dropdown('PIN', $required_options, set_value('PIN', $data[0]['PIN']), 'class="form-control"'); ?>
                    </div>
                </div>
				<div class="form-group">
                    <label class="col-md-3 control-label">KBH Required:</label>
                    <div class="col-md-6">
                        <?php echo form_dropdown('KBH', $required_options, set_value('KBH', $data[0]['KBH']), 'class="form-control"'); ?>
                    </div>
                </div>
				<div class="form-group">
                    <label class="col-md-3 control-label">MEP Required:</label>
                    <div class="col-md-6">
                        <?php echo form_dropdown('MEP', $required_options, set_value('MEP', $data[0]['MEP']), 'class="form-control"'); ?>
                    </div>
                </div>
				<div class="form-group">
                    <label class="col-md-3 control-label">PRD Required:</label>
                    <div class="col-md-6">
                        <?php echo form_dropdown('PRD', $required_options, set_value('PRD', $data[0]['PRD']), 'class="form-control"'); ?>
                    </div>
                </div>
				<div class="form-group">
                    <label class="col-md-3 control-label">Type Required:</label>
                    <div class="col-md-6">
                        <?php echo form_dropdown('Type', $required_options, set_value('Type', $data[0]['Type']), 'class="form-control"'); ?>
                    </div>
                </div>
				<div class="form-group">
                    <label class="col-md-3 control-label">Locks Required:</label>
                    <div class="col-md-6">
                        <?php echo form_dropdown('Locks', $required_options, set_value('Locks', $data[0]['Locks']), 'class="form-control"'); ?>
                    </div>
                </div>
				<div class="form-group">
                    <label class="col-md-3 control-label">Reference Required:</label>
                    <div class="col-md-6">
                        <?php echo form_dropdown('Reference', $required_options, set_value('Reference', $data[0]['Reference']), 'class="form-control"'); ?>
                    </div>
                </div>
				<div class="form-group">
                    <label class="col-md-3 control-label">Status:</label>
                    <div class="col-md-6">
                        <?php echo form_dropdown('Status', ['Enabled'=>'Enabled', 'Disabled'=>'Disabled'], set_value('Status', $data[0]['Status']), 'class="form-control"'); ?>
                    </div>
                </div>
            </div>
            <div class="form-actions">
                <button type="submit" class="btn btn-info">Submit</button>
            </div>
        <?php echo form_close(); ?>
    </div>
</div>