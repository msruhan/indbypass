<div class="portlet">
    <div class="portlet-body form">
    	
        <div class="head clearfix">
            <div class="isw-documents"></div>
            <h3 style="padding:10px;">File Service Update</h3>
        </div>
       	<?php echo form_open_multipart("admin/fileservices/update",array('id'=>"fileservices-validate")); ?>
        <input type="hidden" name="ID" value="<?php echo $data[0]['ID'] ?>" />
            <div class="form-body">
                <div class="form-group">
                    <label>API:</label>
                    <?php echo  form_dropdown('ApiID', $api_list, set_value('ApiID', $data[0]['ApiID']), 'class="form-control"', 'id="ApiID"'); ?><strong></strong>
                </div>
                <div class="form-group">
                    <label>Tool ID:</label>
                    <div class="input-group">
                        <span class="input-group-addon">
                        <i class="fa fa-text-width"></i>
                        </span>
                        <?php echo form_input(array('name'=>"ToolID",'id'=>"ToolID", 'class'=>"form-control", 'value'=>set_value('ToolID', $data[0]['ToolID']))); ?>
                    </div>
                </div>
                <div class="form-group">
                    <label>Title:</label>
                    <div class="input-group">
                        <span class="input-group-addon">
                        <i class="fa fa-font"></i>
                        </span>
                        <?php echo form_input(array('name'=>"Title",'id'=>"Title", 'class'=>"form-control", 'value'=>set_value('Title', $data[0]['Title']))); ?>
                    </div>
                </div>
                <div class="form-group">
                    <label>Delivery Time:</label>
                    <div class="input-group">
                        <span class="input-group-addon">
                        <i class="fa fa-clock-o"></i>
                        </span>
                        <?php echo form_input(array('name'=>"DeliveryTime",'id'=>"DeliveryTime", 'class'=>"form-control", 'value'=>set_value('DeliveryTime', $data[0]['DeliveryTime']))); ?>
                    </div>
                </div>
                <div class="form-group">
                    <label>Description:</label>
                    <div class="input-group">
                        <span class="input-group-addon">
                        </span>
                        <?php echo form_textarea(array('name'=>"Description",'id'=>"Description", 'class'=>"form-control", 'value'=>set_value('Description', $data[0]['Description']))); ?>
                    </div>
                </div>
                <div class="form-group">
                    <label>Allow Extensions:</label>
                    <div class="input-group">
                        <span class="input-group-addon">
                        <i class="fa fa-unlock"></i>
                        </span>
                        <?php echo form_input(array('name'=>"AllowExtension",'id'=>"AllowExtension", 'class'=>"form-control", 'value'=>set_value('AllowExtension', $data[0]['AllowExtension']))); ?>
                    </div>
                </div>
                <div class="form-group">
                    <label>Price:</label>
                    <div class="input-group">
                        <span class="input-group-addon">
                        <i class="fa fa-money"></i>
                        </span>
                        <?php echo form_input(array('name'=>"Price",'id'=>"Price", 'class'=>"form-control", 'value'=>set_value('Price', $data[0]['Price']))); ?>
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
