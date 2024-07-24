<!-- BEGIN OVERVIEW STATISTIC BLOCKS-->
<div class="row">
	<div class="col-md-3 col-sm-6">
		<div class="circle-stat stat-block">
            <a href="<?php echo site_url('admin/member'); ?>">
                <div class="visual">
                    <input class="knobify" data-width="115" data-thickness=".2" data-skin="tron" data-displayprevious="true" value="<?php echo $active_members ?>" data-max="<?php echo $active_members+$inactive_members ?>" data-min="0"/>
                </div>
                <div class="details">
                    <div class="title">
                        <i class="fa fa-users"></i> Members
                    </div>
                    <div class="number">
                        <?php echo $active_members+$inactive_members ?>
                    </div>
                    <span class="label label-success">
                        <i class="fa fa-thumbs-up"></i> <?php echo $active_members ?>
                    </span>
                    &nbsp;
                    <span class="label label-warning">
                        <i class="fa fa-thumbs-down"></i> <?php echo $inactive_members ?>
                    </span>
                </div>
            </a>    
		</div>
	</div>
	<div class="col-md-3 col-sm-6">
		<div class="circle-stat stat-block">
            <a href="<?php echo site_url('admin/employee'); ?>">
                <div class="visual">
                    <input class="knobify" data-width="115" data-thickness=".2" data-skin="tron" data-displayprevious="true" value="<?php echo $active_employees ?>" data-max="<?php echo $active_employees+$inactive_employees ?>" data-min="0"/>
                </div>
                <div class="details">
                    <div class="title">
                        <i class="fa fa-users"></i> Employees
                    </div>
                    <div class="number">
                        <?php echo $active_employees+$inactive_employees ?>
                    </div>
                    <span class="label label-success">
                        <i class="fa fa-thumbs-up"></i> <?php echo $active_employees ?>
                    </span>
                    &nbsp;
                    <span class="label label-warning">
                        <i class="fa fa-thumbs-down"></i> <?php echo $inactive_employees ?>
                    </span>
                </div>
            </a>    
		</div>
	</div>
	<div class="col-md-3 col-sm-6">
		<div class="circle-stat stat-block">
            <a href="<?php echo site_url('admin/imeiorder'); ?>">
                <div class="visual">
                    <input class="knobify" data-width="115" data-fgcolor="#66EE66" data-thickness=".2" data-skin="tron" data-displayprevious="true" value="<?php echo $imei_orders['Issued']; ?>" data-max="<?php echo $imei_orders['Pending'] + $imei_orders['Issued']; ?>" data-min="0"/>
                </div>
                <div class="details">
                    <div class="title">
                        <i class="fa fa-shopping-cart"></i> IMEI Orders
                    </div>
                    <div class="number">
                        <?php echo $imei_orders['Pending'] + $imei_orders['Issued'] + $imei_orders['Canceled']; ?>
                    </div>
                    <span class="label label-success">
                        <i class="fa fa-thumbs-up"></i> <?php echo $imei_orders['Issued']; ?>
                    </span>
                    <span class="label label-default">
                        <?php echo $imei_orders['Pending']; ?> 
                    </span>
                    <span class="label label-warning">
                        <i class="fa fa-thumbs-down"></i> <?php echo $imei_orders['Canceled']; ?>
                    </span>
                </div>
            </a>	    
		</div>
	</div>
	<div class="col-md-3 col-sm-6">
		<div class="circle-stat stat-block">
            <a href="<?php echo site_url('admin/fileorder'); ?>">
                <div class="visual">
                    <input class="knobify" data-width="115" data-fgcolor="#66EE66" data-thickness=".2" data-skin="tron" data-displayprevious="true" value="<?php echo $file_orders['Issued']; ?>" data-max="<?php echo $file_orders['Pending'] + $file_orders['Issued']; ?>" data-min="0"/>
                </div>
                <div class="details">
                    <div class="title">
                        <i class="fa fa-shopping-cart"></i> File Orders
                    </div>
                    <div class="number">
                        <?php echo $file_orders['Pending'] + $file_orders['Issued'] + $file_orders['Canceled']; ?>
                    </div>
                    <span class="label label-success">
                        <i class="fa fa-thumbs-up"></i> <?php echo $file_orders['Issued']; ?>
                    </span>
                    <span class="label label-default">
                        <?php echo $file_orders['Pending']; ?> 
                    </span>
                    <span class="label label-warning">
                        <i class="fa fa-thumbs-down"></i> <?php echo $file_orders['Canceled']; ?>
                    </span>
                </div>
            </a>	    
		</div>
	</div>
</div>
<div class="row ">
	<div class="col-md-6 col-sm-6">
		<div class="portlet">
			<div class="portlet-title">
				<div class="caption">
					<i class="fa fa-trophy"></i> Top IMEI Services
				</div>
			</div>
			<div class="portlet-body">
				<div class="table-scrollable">
					<table class="table table-striped table-bordered table-hover">
						<thead>
						<tr>
							<th>No.</th>
							<th>Title</th>
							<th>Delivery Time</th>
							<th>Price</th>
						</tr>
						</thead>
						<tbody>
					<?php foreach ($top_imei_methods as $k => $m): ?>
						<tr>
							<td><?php echo $k ?></td>
							<td><?php echo $m['Title'] ?></td>
							<td><?php echo $m['DeliveryTime'] ?></td>
							<td><?php echo $m['Price'] ?></td>
						</tr>
					<?php endforeach ?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
	<div class="col-md-6 col-sm-6">
		<div class="portlet">
			<div class="portlet-title">
				<div class="caption">
					<i class="fa fa-trophy"></i> Top File Services
				</div>
			</div>
			<div class="portlet-body">
				<div class="table-scrollable">
					<table class="table table-striped table-bordered table-hover">
						<thead>
						<tr>
							<th>No.</th>
							<th>Title</th>
							<th>Delivery Time</th>
							<th>Price</th>
						</tr>
						</thead>
						<tbody>
					<?php foreach ($top_file_services as $k => $m): ?>
						<tr>
							<td><?php echo $k ?></td>
							<td><?php echo $m['Title'] ?></td>
							<td><?php echo $m['DeliveryTime'] ?></td>
							<td><?php echo $m['Price'] ?></td>
						</tr>
					<?php endforeach ?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>