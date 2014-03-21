<?php  echo $header; ?>
<div id="content">
  <div class="breadcrumb">
    <?php foreach ($breadcrumbs as $breadcrumb) { ?>
    <?php echo $breadcrumb['separator']; ?><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a>
    <?php } ?>
  </div>
  <?php if ($error_warning) { ?>
  <div class="warning"><?php echo $error_warning; ?></div>
  <?php } ?>
  <div class="box">
    <div class="heading">
      <h1><img src="view/image/user-group.png" alt="" /> <?php echo $heading_title; ?></h1>
      <div class="buttons"><a onclick="$('#form').submit();" class="button"><?php echo $button_save; ?></a><a href="<?php echo $cancel; ?>" class="button"><?php echo $button_cancel; ?></a></div>
    </div>
    <div class="content">
      <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form" onsubmit="return checkform();">
        <table class="form">
          <tr>
            
            <td colspan="2"><span class="required">*</span> <?php echo $entry_name; ?> <input type="text" name="name" value="<?php echo $name; ?>" /></td>
            <td colspan="4">
              <?php if ($error_name) { ?>
              <span class="error"><?php echo $error_name; ?></span>
              <?php  } ?></td>
          </tr>
          <tr>
            <td colspan="6"><div class="scrollbox" style="height:500px;width:88%">
            	<div class="odd">
            		<table><thead><tr>
            			<td style="width: 200px;"><a onclick="$('#form input:checkbox.access-node').attr('checked', true);"><?php echo $text_select_all; ?></a> / <a onclick="$('#form input:checkbox.access-node').attr('checked', false);"><?php echo $text_unselect_all; ?></a></td>
              			<td style="width: 200px;"><a onclick="$('#form input:checkbox.modify-node').attr('checked', true);"><?php echo $text_select_all; ?></a> / <a onclick="$('#form input:checkbox.modify-node').attr('checked', false);"><?php echo $text_unselect_all; ?></a></td>
              			<td style="width: 200px;"><a onclick="$('#form input:checkbox.log-node').attr('checked', true);"><?php echo $text_select_all; ?></a> / <a onclick="$('#form input:checkbox.log-node').attr('checked', false);"><?php echo $text_unselect_all; ?></a></td>
            			<td></td>
            		</tr></thead></table>
            	</div>
                <?php $class = 'odd'; ?>
                <?php foreach ($permissions as $pk=>$permission) { ?>
                <?php $class = ($class == 'even' ? 'odd' : 'even'); ?>
                <div class="<?php echo $class; ?>">
                	<table style="width:100%;" name="permission_row">
                		<tr>
                			<td style="width:200px;">
                  			<?php if (in_array($permission['value'], $access)) { ?>
                  				<input type="checkbox" name="permission[access][]" class="access-node" value="<?php echo $permission['value']; ?>" checked="checked" />
                  			<?php } else { ?>
                  				<input type="checkbox" name="permission[access][]" class="access-node" value="<?php echo $permission['value']; ?>" />
                  			<?php } ?> 
                  			<?php echo $entry_access; ?>
                  			</td>
			                <td style="width:200px;">
			                <?php if (in_array($permission['value'], $modify)) { ?>
			                  	<input type="checkbox" name="permission[modify][]" class="modify-node" value="<?php echo $permission['value']; ?>" checked="checked" />
			                <?php } else { ?>
			                  	<input type="checkbox" name="permission[modify][]" class="modify-node" value="<?php echo $permission['value']; ?>" />
			                <?php } ?> <?php echo $entry_modify; ?>
			                </td>
			                <td style="width:200px;">
			                <?php if (in_array($permission['value'], $log)) { ?>
			                  	<input type="checkbox" name="permission[log][]" class="log-node" value="<?php echo $permission['value']; ?>" checked="checked" />                  
			                <?php } else { ?>
			                  	<input type="checkbox" name="permission[log][]" class="log-node" value="<?php echo $permission['value']; ?>" />
			                <?php } ?> <?php echo $entry_log; ?>
			                </td>
			                <td >
                  				<span class="node-remark" id="node-sort-<?php echo $pk?>" data-value="<?php echo $permission['value'] ?>" title="双击修改备注"><?php echo $permission['value']; ?><b style="margin-right:10px;float:right"><?php echo $permission['text'] ? $permission['text'] : '' ?></b></span>
                			</td>
                		</tr>
                	</table>
                </div>
                <?php } ?>
              </div>

           </td>
          </tr>
        </table>
      </form>
    </div>
  </div>
</div>
<div id="node-remark-dialog" style="display:none;">
	<table style="width:98%">
	<tr>
		<th><span>URL:</span></th>
		<td><span class="node-url"></span><input type="hidden" name="node_url" value=""></td>
	</tr>
	<tr>
		<th><span>Remark:</span></th>
		<td><input type="text" name="node_remark" value="" style="width:200px"></td>
	</tr>
	</table>
</div>
<script src="<?php echo HTTP_CATALOG?>asset/js/jquery.json-2.4.min.js" type="text/javascript"></script>
<script type="text/javascript"><!--
function checkform(){
var permission = [];
$('#form input[name^="permission[access]"]:checked').each(function(){
	permission.push({"key":"access[]","value":$(this).val()});
});
$('#form input[name^="permission[modify]"]:checked').each(function(){
	permission.push({"key":"modify[]","value":$(this).val()});
});
$('#form input[name^="permission[log]"]:checked').each(function(){
	permission.push({"key":"log[]","value":$(this).val()});
});
if(permission!=''){
	$('#form').append('<input name="json_permission" value=\''+$.toJSON(permission)+'\' type="hidden">');
	$('#form input[name^="permission"]:checked').remove();
	return true;
}
return false;
}
//-->
</script>
<script type="text/javascript"><!--
$(document).ready(function() {
	$('table[name="permission_row"]').mouseover(function(){	$(this).css('background','#3d6999');}).mouseout(function(){$(this).css('background','none');});
	$('#form span.node-remark').bind('dblclick',function(){
		var permission_url = $(this).attr('data-value');
		if(permission_url!=''){
			$('#node-remark-dialog input[name="node_remark"]').val($(this).children('b').text());
			$('#node-remark-dialog .node-url').html(permission_url) ;
			$('#node-remark-dialog input[name="node_url"]').val(permission_url).attr('data-sort',$(this).attr('id')) ;
			$('#node-remark-dialog').dialog('open');
		}
	});
	$('#node-remark-dialog').dialog({
		title:'Update Node Remark',
		width: 360,
		autoOpen:false,
		resizable: false,
		buttons:{
			'Update':function(){
				if($('#node-remark-dialog input[name="node_remark"]').val()==''){
					$('#node-remark-dialog input[name="node_remark"]').focus();
				}else{
					$.post('index.php?route=user/user_permission/update_remark&token=<?php echo $this->session->data['token']?>',{url:$('#node-remark-dialog input[name="node_url"]').val(),remark:$('#node-remark-dialog input[name="node_remark"]').val()},function(data){
						if(data==0){
							alert('Exception');
						}else{
							var node_sort = $('#node-remark-dialog input[name="node_url"]').attr('data-sort');
							$('#'+node_sort+' b').text($('#node-remark-dialog input[name="node_remark"]').val());
						}
					});
				}
				$(this).dialog('close');
			}
		}
	});
})
//-->
</script>
<?php echo $footer; ?> 