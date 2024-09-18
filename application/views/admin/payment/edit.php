<div class="portlet">
    <div class="portlet-body form">
    	
        <div class="head clearfix">
            <div class="isw-documents"></div>
            <h3 style="padding:10px;">Payment Update</h3>
        </div>
       	<?php echo form_open_multipart("admin/payment/update",array('id'=>"payment-validate")); ?>
		<input type="hidden" name="ID" value="<?php echo $data[0]['ID'] ?>" />
        
            <div class="form-body">
                <div class="form-group">
                    <label>Type:</label>
                    <div class="input-group">
                        <span class="input-group-addon">
                        <i class="fa fa-money"></i>
                        </span>
                        <?php echo form_input(array('name'=>"Type",'id'=>"Type", 'class'=>"form-control", 'value'=>set_value('Type', $data[0]['Type']))); ?>
                    </div>
                </div>
                <div class="form-group">
                    <label>User Name:</label>
                    <div class="input-group">
                        <span class="input-group-addon">
                        <i class="fa fa-user"></i>
                        </span>
                        <?php echo form_input(array('name'=>"UserName",'id'=>"UserName", 'class'=>"form-control", 'value'=>set_value('UserName', $data[0]['UserName']))); ?>
                    </div>
                </div>
                <div class="form-group">
                    <label>Password:</label>
                    <div class="input-group">
                        <span class="input-group-addon">
                        <i class="fa fa-lock"></i>
                        </span>
                        <?php echo form_input(array('name'=>"Password",'id'=>"Password", 'class'=>"form-control", 'value'=>set_value('Password', $data[0]['Password']))); ?>
                    </div>
                </div>
                <div class="form-group">
                    <label>Signature:</label>
                    <div class="input-group">
                        <span class="input-group-addon">
                        <i class="fa fa-text-width"></i>
                        </span>
                        <?php echo form_input(array('name'=>"Signature",'id'=>"Signature", 'class'=>"form-control", 'value'=>set_value('Signature', $data[0]['Signature']))); ?>
                    </div>
                </div>
                <div class="form-group">
                    <label>Percent:</label>
                    <div class="input-group">
                        <span class="input-group-addon">%</span>
                        <?php echo form_input(array('name'=>"percent",'id'=>"percent", 'class'=>"form-control", 'value'=>set_value('percent', $data[0]['percent']))); ?>
                    </div>
                </div>
                <div class="form-group">
                    <label>Currency:</label>
                    <div class="input-group">
                        <span class="input-group-addon">
                        <i class="fa fa-usd"></i>
                        </span>
                        <?php echo form_input(array('name'=>"Currency",'id'=>"Currency", 'class'=>"form-control", 'value'=>set_value('Currency', $data[0]['Currency']))); ?>
                    </div>
                </div>
            </div>
            <div class="form-actions">
                <button type="submit" class="btn btn-info">Submit</button>
            </div>
        <?php echo form_close(); ?>
    </div>
</div>