<div class="portlet">
    <div class="portlet-body form">
    	
        <div class="head clearfix">
            <div class="isw-documents"></div>
            <h3 style="padding:10px;">API Add</h3>
        </div>
       	<?php echo form_open_multipart("admin/payment/insert",array('id'=>"payment-validate")); ?>
            <div class="form-body">
                <div class="form-group">
                    <label>Type:</label>
                    <div class="input-group">
                        <span class="input-group-addon">
                        <i class="fa fa-money"></i>
                        </span>
                        <?php echo form_input(array('name'=>"Type",'id'=>"Type", 'class'=>"form-control", 'value'=>set_value('Type',''))); ?>
                    </div>
                </div>
                <div class="form-group">
                    <label>User Name:</label>
                    <div class="input-group">
                        <span class="input-group-addon">
                        <i class="fa fa-user"></i>
                        </span>
                        <?php echo form_input(array('name'=>"UserName",'id'=>"UserName", 'class'=>"form-control", 'value'=>set_value('UserName',''))); ?>
                    </div>
                </div>
                <div class="form-group">
                    <label>Password:</label>
                    <div class="input-group">
                        <span class="input-group-addon">
                        <i class="fa fa-lock"></i>
                        </span>
                        <?php echo form_input(array('name'=>"Password",'id'=>"Password", 'class'=>"form-control", 'value'=>set_value('Password',''))); ?>
                    </div>
                </div>
                <div class="form-group">
                    <label>Signature:</label>
                    <div class="input-group">
                        <span class="input-group-addon">
                        <i class="fa fa-text-width"></i>
                        </span>
                        <?php echo form_input(array('name'=>"Signature",'id'=>"Signature", 'class'=>"form-control", 'value'=>set_value('Signature',''))); ?>
                    </div>
                </div>
                <div class="form-group">
                    <label>Percent:</label>
                    <div class="input-group">
                        <span class="input-group-addon">%</span>
                        <?php echo form_input(array('name'=>"percent",'id'=>"percent", 'class'=>"form-control", 'value'=>set_value('percent',''))); ?>
                    </div>
                </div>
                <div class="form-group">
                    <label>Currency:</label>
                    <div class="input-group">
                        <span class="input-group-addon">
                        	<i class="fa fa-usd"></i>
                        </span>
                        <?php echo form_input(array('name'=>"Currency",'id'=>"Currency", 'class'=>"form-control", 'value'=>set_value('Currency',''))); ?>
                    </div>
                </div>
            </div>
            <div class="form-actions">
                <button type="submit" class="btn btn-info">Submit</button>
            </div>
        <?php echo form_close(); ?>
    </div>
</div>