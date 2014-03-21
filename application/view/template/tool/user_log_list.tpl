<?php echo $header; ?>
<div id="content">
  <div class="breadcrumb">
    <?php foreach ($breadcrumbs as $breadcrumb) { ?>
    <?php echo $breadcrumb['separator']; ?><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a>
    <?php } ?>
  </div>
  <?php if ($error_warning) { ?>
  <div class="warning"><?php echo $error_warning; ?></div>
  <?php } ?>
  <?php if ($success) { ?>
  <div class="success"><?php echo $success; ?></div>
  <?php } ?>
  <div class="box">
    <div class="heading">
      <h1><img src="view/image/log.png" alt="" /> <?php echo $heading_title; ?></h1>
      <?php if((int)$this->user->getUserGroupId()<4){?>
      <div class="buttons"><a onclick="truncate_logs();" class="button"><?php echo $button_truncate; ?></a><a id="export-userlog-button" class="button">Export</a><a onclick="$('form').submit();" class="button"><?php echo $button_delete; ?></a></div>
      <?php }?>
    </div>
    <div class="content">
      <form action="<?php echo $delete; ?>" method="post" enctype="multipart/form-data" id="form">
        <table class="list">
          <thead>
            <tr>
              <td width="1" style="text-align: center;"><input type="checkbox" onclick="$('input[name*=\'selected\']').attr('checked', this.checked);" /></td>
              <td class="left"><?php if ($sort == 'username') { ?>
                <a href="<?php echo $sort_username; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_user_name; ?></a>
                <?php } else { ?>
                <a href="<?php echo $sort_username; ?>"><?php echo $column_user_name; ?></a>
                <?php } ?></td>
                <td class="left"><?php if ($sort == 'action') { ?>
                <a href="<?php echo $sort_action; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_log_action; ?></a>
                <?php } else { ?>
                <a href="<?php echo $sort_action; ?>"><?php echo $column_log_action; ?></a>
                <?php } ?></td>
                <td class="left"><?php if ($sort == 'url') { ?>
                <a href="<?php echo $sort_url; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_log_url; ?></a>
                <?php } else { ?>
                <a href="<?php echo $sort_url; ?>"><?php echo $column_log_url; ?></a>
                <?php } ?></td>
                <td class="left"><?php echo $column_log_data ?></td>
                <td class="left"><?php if ($sort == 'log_time') { ?>
                <a href="<?php echo $sort_log_time; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_log_time; ?></a>
                <?php } else { ?>
                <a href="<?php echo $sort_log_time; ?>"><?php echo $column_log_time; ?></a>
                <?php } ?></td>
              <td class="right"><?php echo $column_action; ?></td>
            </tr>
          </thead>
          <tbody>
              <tr class="filter">
              <td></td>
              <td><select name="filter_user_id" <?php echo !in_array($this->user->getUserGroupId(), array(1,2,3)) ? 'disabled' : ''?>>
                  <option value="*"></option>
                  <?php foreach ($users as $key => $_user) { ?>
                  <?php if ($key == $filter_user_id) { ?>
                  <option value="<?php echo $key; ?>" selected="selected"><?php echo $_user; ?></option>
                  <?php } else { ?>
                  <option value="<?php echo $key; ?>"><?php echo $_user; ?></option>
                  <?php } ?>
                  <?php } ?>
                </select></td>
			  <td><input type="text" name="filter_action" value="<?php echo $filter_action; ?>" /></td>
              <td><input type="text" name="filter_url" value="<?php echo $filter_url; ?>" /></td>
              <td></td>
              <td><input type="text" name="filter_log_time_start" value="<?php echo $filter_log_time_start; ?>" size="14" class="datetime" /></td>
              <td align="right"><a onclick="filter();" class="button"><?php echo $button_filter; ?></a></td>
            </tr>
            <?php  if ($user_logs) { ?>
            <?php foreach ($user_logs as $log) { ?>
            <tr>
              <td style="text-align: center;"><?php if ($log['selected']) { ?>
                <input type="checkbox" name="selected[]" value="<?php echo $log['user_log_id']; ?>" checked="checked" />
                <?php } else { ?>
                <input type="checkbox" name="selected[]" value="<?php echo $log['user_log_id']; ?>" />
                <?php } ?></td>
              <td class="left"><?php echo $log['username']; ?></td>
              <td class="left"><?php echo $log['logaction']; ?></td>
              <td class="left"><?php echo $log['url']; ?></td>
              <td class="left"><?php echo lively_truncate(strip_tags($log['data']),120); ?></td>
              <td class="left"><?php echo $log['log_time']; ?></td>
              <td class="right"><?php foreach ($log['action'] as $action) { ?>
                [ <a href="<?php echo $action['href']; ?>"><?php echo $action['text']; ?></a> ]
                <?php } ?></td>
            </tr>
            <?php } ?>
            <?php } else { ?>
            <tr>
              <td class="center" colspan="7"><?php echo $text_no_results; ?></td>
            </tr>
            <?php } ?>
          </tbody>
        </table>
      </form>
      <div class="pagination"><?php echo $pagination; ?></div>
    </div>
  </div>
</div>
<div id="userlog-export-dialog" style="display:none">
	<table>
		<tr>
			<td><span>Operator:</span></td>
			<td><select name="operator">
					<option value="0"> -- All -- </option>
				<?php foreach ($all_users as $user){?>
					<option value="<?php echo $user['user_id']?>"><?php echo $user['username'].' '.$user['lastname'].$user['firstname'];?></option>
				<?php }	?>
				</select>
			</td>
		</tr>
		<tr>
			<td><span>Date Start:</span></td>
			<td><input type="text" name="date_start" value="" class="datetime"/></td>
		</tr>
		<tr>
			<td><span>Date End:</span></td>
			<td><input type="text" name="date_end" value="<?php echo date('Y-m-d H:i')?>" class="datetime"/></td>
		</tr>
	</table>
	<div class="alert" style="margin-top:5px "></div>
</div>
<script type="text/javascript"><!--
$('#export-userlog-button').bind('click',function(){
	$('#userlog-export-dialog').dialog({
		title:'Export Logs',
		width: 600,
		buttons:{
			'Export':function(){
				$('#userlog-export-dialog .alert').removeClass('success').removeClass('error').html('');
				$.ajax({
					url:'index.php?route=tools/user_log/export_logs&token=<?php echo $token;?>',
					data:$('#userlog-export-dialog input,#userlog-export-dialog select'),
					type:'Post',
					dataType:'json',
					success:function(data){
						if(data.status == 0){
							$('#userlog-export-dialog .alert').addClass('error').html(data.msg);
						}else{
							$('#userlog-export-dialog .alert').addClass('success').html(data.msg);
						}
					},
					error: function(xhr, ajaxOptions, thrownError) {
						alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
					}
				});
			},
			'Close':function(){
				$(this).dialog('close');
			}
		}
	});
});
function truncate_logs(){
	if (!confirm('Logging data will not resume! Are you sure you want to do this?')) {
        return false;
    }else{
		$.ajax({url:'index.php?route=tools/user_log/truncate&token=<?php echo $token; ?>',type:'get',dataType:'json',success:function(data){
			$('.msg').remove();
			if(data.warning){
				$('.breadcrumb').after('<div class="warning msg">'+data.warning+'</div>');
			}else{		
				$('.breadcrumb').after('<div class="success msg">'+data.success+'</div>');
				location.href='index.php?route=tools/user_log&token=<?php echo $token; ?>';
			}
			//
		}});
    }
}
function filter() {
	url = 'index.php?route=tools/user_log&token=<?php echo $token; ?>';
	
	var filter_user_id = $('select[name=\'filter_user_id\']').attr('value');
	
	if (filter_user_id != '*') {
		url += '&filter_user_id=' + encodeURIComponent(filter_user_id);
	}	
	
	var filter_action = $('input[name=\'filter_action\']').attr('value');
	
	if (filter_action) {
		url += '&filter_action=' + encodeURIComponent(filter_action); 
	}	
	
	var filter_url = $('input[name=\'filter_url\']').attr('value');
	
	if (filter_url) {
		url += '&filter_url=' + encodeURIComponent(filter_url);
	}	
	
	var filter_log_time_start = $('input[name=\'filter_log_time_start\']').attr('value');
	
	if (filter_log_time_start) {
		url += '&filter_log_time_start=' + encodeURIComponent(filter_log_time_start);
	}
	
	location = url;
}
//--></script>
<link rel="stylesheet" media="all" type="text/css" href="view/javascript/jquery/timepicker/css/jquery-ui-timepicker-addon.css" />
<script src="view/javascript/jquery/timepicker/js/jquery-ui-timepicker-addon.js" type="text/javascript"></script>
<script type="text/javascript"><!--
$(document).ready(function() {
	$('.datetime').datetimepicker({timeFormat: "HH:mm",dateFormat: "yy-mm-dd",inline: true});
});
//--></script>
<?php echo $footer; ?> 