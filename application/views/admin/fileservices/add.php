<div class="portlet">
    <div class="portlet-body form">
    	
        <div class="head clearfix">
            <div class="isw-documents"></div>
            <h3 style="padding:10px;">File Service Add</h3>
        </div>
       	<?php echo form_open_multipart("admin/fileservices/insert",array('id'=>"fileservices-validate")); ?>
            <div class="form-body">
                <div class="form-group">
                    <label>API:</label>
                    <?php echo  form_dropdown('ApiID', $api_list, set_value('ApiID', ''), 'class="form-control"', 'id="ApiID"'); ?>
                </div>
                <div class="form-group">
                    <label>Tool ID:</label>
                    <div class="input-group">
                        <span class="input-group-addon">
                        <i class="fa fa-text-width"></i>
                        </span>
                        <?php echo form_input(array('name'=>"ToolID",'id'=>"ToolID", 'class'=>"form-control", 'value'=>set_value('ToolID', ''))); ?>
                    </div>
                </div>
                <div class="form-group">
                    <label>Title:</label>
                    <div class="input-group">
                        <span class="input-group-addon">
                        <i class="fa fa-font"></i>
                        </span>
                        <?php echo form_input(array('name'=>"Title",'id'=>"Title", 'class'=>"form-control", 'value'=>set_value('Title', ''))); ?>
                    </div>
                </div>
                <div class="form-group">
                    <label>Delivery Time:</label>
                    <div class="input-group">
                        <span class="input-group-addon">
                        <i class="fa fa-clock-o"></i>
                        </span>
                        <?php echo form_input(array('name'=>"DeliveryTime",'id'=>"DeliveryTime", 'class'=>"form-control", 'value'=>set_value('DeliveryTime', ''))); ?>
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
                    <label>Allow Extensions:</label>
                    <div class="input-group">
                        <span class="input-group-addon">
                        <i class="fa fa-unlock"></i>
                        </span>
                        <?php echo form_input(array('name'=>"AllowExtension",'id'=>"AllowExtension", 'class'=>"form-control", 'value'=>set_value('AllowExtension', ''))); ?>
                    </div>
                </div>
                <div class="form-group">
                    <label>Price:</label>
                    <div class="input-group">
                        <span class="input-group-addon">
                        <i class="fa fa-money"></i>
                        </span>
                        <?php echo form_input(array('name'=>"Price",'id'=>"Price", 'class'=>"form-control", 'value'=>set_value('Price', ''))); ?>
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
