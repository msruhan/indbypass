<div class="portlet">
    <div class="portlet-body form">
    	
        <div class="head clearfix">
            <div class="isw-documents"></div>
            <h3 style="padding:10px;">Server Service Update</h3>
        </div>
       	<?php echo form_open_multipart("admin/serverservice/update",array('id'=>"services-validate")); ?>
        <input type="hidden" name="ID" value="<?php echo $data[0]['ID'] ?>" />
            <div class="form-body">
                <div class="form-group">
                    <label>Server Box / Tool:</label>
                    <?php echo form_dropdown('ServerBoxID', $box_list, set_value('ServerBoxID', $data[0]['ServerBoxID']), 'id="ServerBoxID" class="form-control"'); ?>
                </div>
                <div class="form-group">
                    <label>Title:</label>
                    <div class="input-group">
                        <span class="input-group-addon">
                        <i class="fa fa-font"></i>
                        </span>
                        <?php echo form_input(array('name'=>"Title",'id'=>"Title", 'class'=>"form-control", 'value'=>set_value('Title', $data[0]['Title']), 'required'=>'required')); ?>
                    </div>
                </div>
                <div class="form-group">
                    <label>Delivery Time:</label>
                    <div class="input-group">
                        <span class="input-group-addon">
                        <i class="fa fa-clock-o"></i>
                        </span>
                        <?php echo form_input(array('name'=>"DeliveryTime",'id'=>"DeliveryTime", 'class'=>"form-control", 'value'=>set_value('DeliveryTime', $data[0]['DeliveryTime']), 'required'=>'required')); ?>
                    </div>
                </div>
                <div class="form-group">
                    <label>Description:</label>
                    <div class="input-group">
                        <span class="input-group-addon">
                        </span>
                        <?php echo form_textarea(array('name'=>"Description",'id'=>"Description", 'class'=>"form-control", 'value'=>set_value('Description', $data[0]['Description']), 'required'=>'required')); ?>
                    </div>
                </div>
                <div class="form-group">
                    <label>Price:</label>
                    <div class="input-group">
                        <span class="input-group-addon">
                        <i class="fa fa-money"></i>
                        </span>
                        <?php echo form_input(array('name'=>"Price",'id'=>"Price", 'class'=>"form-control", 'value'=>set_value('Price', $data[0]['Price']), 'required'=>'required')); ?>
                    </div>
                </div>
                <div class="form-group">
                    <label>Quantity:</label>
                    <div class="input-group">
                        <span class="input-group-addon">
                        <i class="fa fa-info"></i>
                        </span>
                        <?php echo form_input(array('name'=>"Quantity",'id'=>"Quantity", 'class'=>"form-control", 'value'=>set_value('Quantity', $data[0]['Quantity']), 'required'=>'required')); ?>
                    </div>
                </div>
                <div class="form-group">
                    <label>Required Fields:</label>
                    <div class="input-group">
                        <span class="input-group-addon">
                        <i class="fa fa-clock-o"></i>
                        </span>
                        <?php echo form_input(array('name'=>"RequiredFields",'id'=>"RequiredFields", 'class'=>"form-control", 'value'=>set_value('RequiredFields', $data[0]['RequiredFields']), 'required'=>'required')); ?>
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
