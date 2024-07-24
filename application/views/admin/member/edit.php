<div class="portlet">
    <div class="portlet-body form">
    	
        <div class="head clearfix">
            <div class="isw-documents"></div>
            <h3 style="padding:10px;">Member Update</h3>
        </div>
       	<?php echo form_open_multipart("admin/member/update",array('id'=>"member-validate")); ?>
        <input type="hidden" name="ID" value="<?php echo $data[0]['ID'] ?>" />
        
            <div class="form-body">
                <div class="form-group">
                    <label>Member Group:</label>
                    <div class="input-group">
                        <span class="input-group-addon">
                        <i class="fa fa-group"></i>
                        </span>
                       <?php echo  form_dropdown('MemberGroupID', $group_list, set_value('MemberGroupID', $data[0]['MemberGroupID']), 'class="form-control"', 'id="MemberGroupID"'); ?>
                    </div>
                </div>
                <div class="form-group">
                    <label>First Name:</label>
                    <div class="input-group">
                        <span class="input-group-addon">
                        <i class="fa fa-info"></i>
                        </span>
                      <?php echo form_input(array('name'=>"FirstName",'id'=>"FirstName", 'class'=>"form-control", 'value'=>set_value('FirstName', $data[0]['FirstName']))); ?>
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
                    <label>Mobile:</label>
                    <div class="input-group">
                        <span class="input-group-addon">
                        <i class="fa fa-mobile"></i>
                        </span>
                        <?php echo form_input(array('name'=>"Mobile",'id'=>"Mobile", 'class'=>"form-control", 'value'=>set_value('Mobile', $data[0]['Mobile']))); ?>
                    </div>
                </div>
                <div class="form-group">
                    <label>Email:</label>
                    <div class="input-group">
                        <span class="input-group-addon">
                        <i class="fa fa-envelope-o"></i>
                        </span>
                        <?php echo form_input(array('name'=>"Email",'id'=>"Email", 'class'=>"form-control", 'value'=>set_value('Email', $data[0]['Email']))); ?>
                    </div>
                </div>
                <div class="form-group">
                    <label>Password:</label>
                    <div class="input-group">
                        <span class="input-group-addon">
                        <i class="fa fa-lock"></i>
                        </span>
                        <?php echo form_input(array('name'=>"Password",'id'=>"Password", 'class'=>"form-control")); ?>
                    </div>
                </div>
                <div class="form-group">
                    <label>Status:</label>
                    <?php echo form_dropdown('Status', ['Enabled'=>'Enabled', 'Disabled'=>'Disabled'], set_value('Status', $data[0]['Status']), 'class="form-control"'); ?>
                </div>

                <div class="form-group">
                    <label>Api Key:</label>
                    <div class="input-group">
                        <span class="input-group-addon">
                        <i class="fa fa-key"></i>
                        </span>
                        <?php echo form_input(array('name'=>"ApiKey", 'id'=>"ApiKey", 'class'=>"form-control", 'value' => set_value('ApiKey', $data[0]['ApiKey']))); ?>
                    </div>
                </div>
                
                <div class="form-group">
                    <label>Server IP:</label>
                    <div class="input-group">
                        <span class="input-group-addon">
                        <i class="fa fa-desktop"></i>
                        </span>
                        <?php echo form_input(array('name'=>"ServerIP", 'id'=>"ServerIP", 'class'=>"form-control", 'value' => set_value('ServerIP', $data[0]['ServerIP']))); ?>
                    </div>
                </div>

                <div class="form-group">
                    <label>API Status:</label>
                    <?php echo form_dropdown('ApiStatus', ['Enabled'=>'Enabled', 'Disabled'=>'Disabled'], set_value('ApiStatus', $data[0]['ApiStatus']), 'class="form-control"'); ?>
                </div>
            </div>
            <div class="form-actions">
                <button type="submit" class="btn btn-info">Submit</button>
            </div>
        <?php echo form_close(); ?>
    </div>
</div>
<script src="<?php echo $this->config->item('assets_url');?>plugins/bootstrap-switch/js/bootstrap-switch.min.js" type="text/javascript"></script>