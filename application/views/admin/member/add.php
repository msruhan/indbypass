<div class="portlet">
    <div class="portlet-body form">
    	
        <div class="head clearfix">
            <div class="isw-documents"></div>
            <h3 style="padding:10px;">Member Add</h3>
        </div>
       	<?php echo form_open_multipart("admin/member/insert",array('id'=>"member-validate")); ?>
        
            <div class="form-body">
                <div class="form-group">
                    <label>Member Group:</label>
                    <div class="input-group">
                        <span class="input-group-addon">
                        <i class="fa fa-group"></i>
                        </span>
                       <?php echo  form_dropdown('MemberGroupID', $group_list, set_value('MemberGroupID', ''),  'class="form-control"', 'id="MemberGroupID"'); ?>
                    </div>
                </div>
                <div class="form-group">
                    <label>First Name:</label>
                    <div class="input-group">
                        <span class="input-group-addon">
                        <i class="fa fa-info"></i>
                        </span>
                      <?php echo form_input(array('name'=>"FirstName",'id'=>"FirstName", 'class'=>"form-control", 'value'=>set_value('FirstName', ''))); ?>
                    </div>
                </div>
                <div class="form-group">
                    <label>Last Name:</label>
                    <div class="input-group">
                        <span class="input-group-addon">
                        <i class="fa fa-info"></i>
                        </span>
                      <?php echo form_input(array('name'=>"LastName",'id'=>"LastName", 'class'=>"form-control", 'value'=>set_value('LastName', ''))); ?>
                    </div>
                </div>
                <div class="form-group">
                    <label>Mobile:</label>
                    <div class="input-group">
                        <span class="input-group-addon">
                        <i class="fa fa-mobile"></i>
                        </span>
                        <?php echo form_input(array('name'=>"Mobile",'id'=>"Mobile", 'class'=>"form-control", 'value'=>set_value('Mobile', ''))); ?>
                    </div>
                </div>
                <div class="form-group">
                    <label>Email:</label>
                    <div class="input-group">
                        <span class="input-group-addon">
                        <i class="fa fa-envelope-o"></i>
                        </span>
                        <?php echo form_input(array('name'=>"Email",'id'=>"Email", 'class'=>"form-control", 'value'=>set_value('Email', ''))); ?>
                    </div>
                </div>
                <div class="form-group">
                    <label>Password:</label>
                    <div class="input-group">
                        <span class="input-group-addon">
                        <i class="fa fa-lock"></i>
                        </span>
                        <?php echo form_password(array('name'=>"Password",'id'=>"Password", 'class'=>"form-control", 'value'=>set_value('Password', ''))); ?>
                    </div>
                </div>
                <div class="form-group">
                    <label>Status:</label>
                    <input type="checkbox" name="Status" class="make-switch" data-size="normal" value="Enabled" <?php echo (set_value('Status', '') == 'Enabled'?'checked':'' ) ?>>
                </div>
            </div>
            <div class="form-actions">
                <button type="submit" class="btn btn-info">Submit</button>
            </div>
        <?php echo form_close(); ?>
    </div>
</div>
<script src="<?php echo $this->config->item('assets_url');?>plugins/bootstrap-switch/js/bootstrap-switch.min.js" type="text/javascript"></script>
