<div class="modal-dialog">
	<div class="modal-content">
		<div class="modal-header">
			<button type="button" class="remove close" data-dismiss="modal" aria-hidden="true"></button>
		    <h4 class="modal-title" id="dialog-header-title"><?php echo $title;?></h4>
		</div>
		
		<div class="modal-body">
		
			<div class="row-fluid">
				<form class="form-horizontal" id="node-form">
					<input type="hidden" name="action" value="<?php echo $action;?>" />
					<input type="hidden" name="type" value="<?php echo $type?>" />
					<input type="hidden" name="node_id" value="<?php echo $node_id?>" />
					<?php if($parentNode){?>
						<?php if($topNodes){?>
						<div class="control-group">
							<label class="control-label">Controller Node <span class="required">*</span> </label>
							<div class="controls">
								<select id="parent-parent-node-id" class="span10 m-wrap">
								<?php foreach ($topNodes as $item){?>
									<option value="<?php echo $item['node_id'];?>" <?php echo $topNode['node_id']==$item['node_id'] ? 'selected' : '' ;?>><?php echo $item['name'];?></option>
								<?php }?>
								</select>
							</div>
						</div>
						<?php }?>
						
						<div class="control-group">
							<label class="control-label"><?php echo ucfirst($parentNode['type']);?> Node <span class="required">*</span> </label>
							<div class="controls">
								<select name="parent_node_id" class="span10 m-wrap">
								<?php foreach ($parentNodes as $item){?>
									<option value="<?php echo $item['node_id'];?>" <?php echo $parent_node_id==$item['node_id'] ? 'selected' : '' ;?>><?php echo $item['name'];?></option>
								<?php }?>
								</select>
							</div>
						</div>
					<?php }?>
					<div class="control-group">
						<label class="control-label"><?php echo $node_name;?> <span class="required">*</span> </label>
						<div class="controls"><input type="text" name="node_name" class="span10 m-wrap" value="<?php echo $name;?>"></div>
					</div>
					
					<div class="control-group">
						<label class="control-label">URL</label>
						<div class="controls"><input type="text" name="url" class="span10 m-wrap" placeholder="aaa/bbb/ccc" value="<?php echo $url;?>"></div>
					</div>
					
					<div class="control-group">
						<label class="control-label">Remark</label>
						<div class="controls"><input type="text" name="remark" class="span10 m-wrap" value="<?php echo $remark;?>"></div>
					</div>
					
					<div class="control-group">
						<label class="control-label">Status</label>
						<div class="controls">
							<label class="radio">
								<div class="radio">
								<span <?php echo $status ? 'class="checked"' : ''; ?>><input type="radio" name="status" value="1" <?php echo $status ? 'checked="checked"' : ''; ?> /></span>
								</div>Enabled
							</label>
							<label class="radio">
								<div class="radio">
								<span <?php echo !$status ? 'class="checked"' : ''; ?>><input type="radio" name="status" value="0" <?php echo !$status ? 'checked="checked"' : ''; ?>/></span>
								</div>Disabled
							</label>
						</div>
					</div>
					
					<div class="control-group">
						<label class="control-label">Ignore</label>
						<div class="controls">
							<label class="radio">
								<div class="radio">
								<span <?php echo !$ignore ? 'class="checked"' : ''; ?>><input type="radio" name="ignore" value="0" <?php echo !$ignore ? 'checked="checked"' : ''; ?>></span>
								</div>No
							</label>
							<label class="radio">
								<div class="radio">
								<span <?php echo $ignore ? 'class="checked"' : ''; ?>><input type="radio" name="ignore" value="1" <?php echo $ignore ? 'class="checked"' : ''; ?>></span>
								</div>Yes
							</label>
							
						</div>
					</div>
					
					<div class="control-group">
						<label class="control-label">Sort Order</label>
						<div class="controls"><input type="text" name="sort_order" class="span10 m-wrap" value="<?php echo $sort_order;?>"></div>
					</div>
				
				</form>
			</div>
		</div>
		<div class="modal-footer">
		   <button type="button" class="btn btn-primary purple save-node" >Save</button>
		</div>
	</div>
</div>