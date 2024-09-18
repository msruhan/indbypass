<div class="portlet">
    <div class="portlet-body form">
        <div class="head clearfix">
            <div class="isw-documents"></div>
            <h3 style="padding:10px;">Profile Update</h3>
        </div>
       	<?php echo form_open_multipart("",array('id'=>"menu-validate")); ?>
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
                    <label>Current Password:</label>
                    <div class="input-group">
                        <span class="input-group-addon">
                        <i class="fa fa-lock"></i>
                        </span>
                      <?php echo form_password(array('name'=>"Password",'id'=>"Password", 'class'=>"form-control", 'value'=>'')); ?>
                    </div>
                </div>
                <div class="form-group">
                    <label>New Password:</label>
                    <div class="input-group">
                        <span class="input-group-addon">
                        <i class="fa fa-lock"></i>
                        </span>
                      <?php echo form_password(array('name'=>"NewPassword", 'id'=>"NewPassword", 'class'=>"form-control", 'value'=>'')); ?>
                    </div>
                </div>
                <div class="form-group">
                    <label>Confirm Password:</label>
                    <div class="input-group">
                        <span class="input-group-addon">
                        <i class="fa fa-lock"></i>
                        </span>
                      <?php echo form_password(array('name'=>"ConfirmPassword", 'id'=>"ConfirmPassword", 'class'=>"form-control", 'value'=>'')); ?>
                    </div>
                </div>
            </div>
            <div class="form-actions">
                <button type="submit" class="btn btn-info">Submit</button>
            </div>
        <?php echo form_close(); ?>
    </div>
</div>