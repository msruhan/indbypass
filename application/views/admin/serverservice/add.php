<div class="portlet">
    <div class="portlet-body form">
    	
        <div class="head clearfix">
            <div class="isw-documents"></div>
            <h3 style="padding:10px;">Server Service Add</h3>
        </div>
       	<?php echo form_open_multipart("admin/serverservice/insert",array('id'=>"services-validate")); ?>
            <div class="form-body">
            
                <div class="form-group">
                    <label>Server Box / Tool:</label>
                    <?php echo form_dropdown('ServerBoxID', $box_list, set_value('ServerBoxID', ''), 'id="ServerBoxID" class="form-control"'); ?>
                </div>
                <div class="form-group">
                    <label>Title:</label>
                    <div class="input-group">
                        <span class="input-group-addon">
                        <i class="fa fa-font"></i>
                        </span>
                        <?php echo form_input(array('name'=>"Title",'id'=>"Title", 'class'=>"form-control", 'value'=>set_value('Title', ''), 'required'=>'required')); ?>
                    </div>
                </div>
                <div class="form-group">
                    <label>Delivery Time:</label>
                    <div class="input-group">
                        <span class="input-group-addon">
                        <i class="fa fa-clock-o"></i>
                        </span>
                        <?php echo form_input(array('name'=>"DeliveryTime",'id'=>"DeliveryTime", 'class'=>"form-control", 'value'=>set_value('DeliveryTime', ''), 'required'=>'required')); ?>
                    </div>
                </div>
                <div class="form-group">
                    <label>Description:</label>
                    <div class="input-group">
                        <span class="input-group-addon">
                        </span>
                        <?php echo form_textarea(array('name'=>"Description",'id'=>"Description", 'class'=>"form-control", 'value'=>set_value('Description', ''))); ?>
                    </div>
                </div>
                <div class="form-group">
                    <label>Price:</label>
                    <div class="input-group">
                        <span class="input-group-addon">
                        <i class="fa fa-money"></i>
                        </span>
                        <?php echo form_input(array('name'=>"Price",'id'=>"Price", 'class'=>"form-control", 'value'=>set_value('Price', 1.00), 'required'=>'required')); ?>
                    </div>
                </div>
                <div class="form-group">
                    <label>Quantity:</label>
                    <div class="input-group">
                        <span class="input-group-addon">
                        <i class="fa fa-info"></i>
                        </span>
                        <?php echo form_input(array('name'=>"Quantity",'id'=>"Quantity", 'class'=>"form-control", 'value'=>set_value('Quantity', 1), 'required'=>'required')); ?>
                    </div>
                </div>
                <div class="form-group">
                    <label>Required Fields:</label>
                    <div class="input-group">
                        <span class="input-group-addon">
                        <i class="fa fa-clock-o"></i>
                        </span>
                        <?php echo form_input(array('name'=>"RequiredFields",'id'=>"RequiredFields", 'class'=>"form-control", 'value'=>set_value('RequiredFields'))); ?>
                    </div>
                </div>
                <div class="form-group">
                    <label>Status:</label>
                    <?php echo form_dropdown('Status', ['Enabled'=>'Enabled', 'Disabled'=>'Disabled'], set_value('Status'), 'class="form-control"'); ?>
                </div>
            </div>
            <div class="form-actions">
                <button type="submit" class="btn btn-info">Submit</button>
            </div>
        <?php echo form_close(); ?>
    </div>
</div>
