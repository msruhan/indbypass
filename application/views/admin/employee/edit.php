<div class="portlet">
    <div class="portlet-body form">
    	
        <div class="head clearfix">
            <div class="isw-documents"></div>
            <h3 style="padding:10px;">Employee Update</h3>
        </div>
       	<?php echo form_open_multipart("admin/employee/update",array('id'=>"menu-validate")); ?>
        <input type="hidden" name="ID" value="<?php echo $data[0]['ID'] ?>" />
            <div class="form-body">
                <div class="form-group">
                    <label>First Name:</label>
                    <div class="input-group">
                        <span class="input-group-addon">
                        <i class="fa fa-info"></i>
                        </span>
                        <?php echo form_input(array('name'=>"FirstName",'id'=>"FirstName", 'class'=>"form-control",  'value'=>set_value('FirstName', $data[0]['FirstName']))); ?>
                    </div>
                </div>
                <div class="form-group">
                    <label>Last Name:</label>
                    <div class="input-group">
                        <span class="input-group-addon">
                        <i class="fa fa-info"></i>
                        </span>
                        <?php echo form_input(array('name'=>"LastName",'id'=>"LastName", 'class'=>"form-control", 'value'=>set_value('LastName', $data[0]['LastName']))); ?>
                    </div>
                </div>
                <div class="form-group">
                    <label>Email:</label>
                    <div class="input-group">
                        <span class="input-group-addon">
                        <i class="fa fa-user"></i>
                        </span>
                       <?php echo form_input(array('name'=>"Email",'id'=>"Email", 'class'=>"form-control", 'disabled'=>'disabled', 'value'=>set_value('Email', $data[0]['Email']))); ?>
                    </div>
                </div>
                <div class="form-group">
                    <label>Password:</label>
                    <div class="input-group">
                        <span class="input-group-addon">
                        <i class="fa fa-lock"></i>
                        </span>
                      <?php echo form_password(array('name'=>"Password",'id'=>"Password", 'class'=>"form-control", 'value'=>'')); ?>
                    </div>
                </div>
                <div class="form-group">
                    <label>Status:</label>
                    <?php echo form_dropdown('Status', ['Enabled'=>'Enabled', 'Disabled'=>'Disabled'], set_value('Status', $data[0]['Status']), 'class="form-control"'); ?>
                </div>
            </div>
            <div class="form-actions">
                <button type="submit" class="btn btn-info">Submit</button>
            </div>
        <?php echo form_close(); ?>
    </div>
</div>