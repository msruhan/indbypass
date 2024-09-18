<?php $status_options = ['Pending' => 'Pending', 'Issued' => 'Issued', 'Canceled' => 'Canceled']; ?>
<div class="portlet">
    <div class="portlet-body form">
    	
        <div class="head clearfix">
            <div class="isw-documents"></div>
            <h3 style="padding:10px;">File Services Order Update</h3>
        </div>
		<?php echo form_open("admin/fileorder/update", ['class' => "form-horizontal", 'role' => "form"]); ?>
        <input type="hidden" name="ID" value="<?php echo $data[0]['ID'] ?>" />
            <div class="form-body">
                <div class="form-group">
                    <label class="col-md-3 control-label">File Service:</label>
                    <div class="col-md-6">
                        <?php echo  form_dropdown('FileServiceID', $service_list, set_value('FileServiceID', $data[0]['FileServiceID']), 'id="FileServiceID" class="form-control"'); ?>
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
                    <label class="col-md-3 control-label">File:</label>
                    <div class="input-group col-md-6">
                        <a href="<?php echo $this->config->item('fileservice_url').$data[0]['FileName']; ?>"><?php echo $data[0]['FileName']; ?></a>
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
                <div class="form-group">
                    <label class="col-md-3 control-label">Mobile No:</label>
                    <div class="input-group col-md-6">
                        <span class="input-group-addon">
                        <i class="fa fa-font"></i>
                        </span>
                        <?php echo form_input(array('name'=>"Mobile",'id'=>"Mobile", 'class'=>"form-control", 'value'=>set_value('Mobile', $data[0]['Mobile']))); ?>
                    </div>
                </div>
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