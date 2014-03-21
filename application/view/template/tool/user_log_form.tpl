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
  <div class="box">
    <div class="heading">
      <h1><img src="view/image/log.png" alt="" /> <?php echo $heading_title; ?></h1>
      <div class="buttons"><a href="<?php echo $cancel; ?>" class="button"><?php echo $button_cancel; ?></a></div>
    </div>
    <div class="content">      
        <table class="form">
          <tr bgcolor="#c3d999">
            <td width="25%"> <b><?php echo $entry_user; ?></b> <?php echo $username; ?></td><td></td>            
            <td width="25%"> <b><?php echo $entry_url; ?></b> <?php echo $url; ?></td><td></td>
            <td width="25%"> <b><?php echo $entry_action; ?></b> <?php echo $action; ?></td><td></td>
            <td width="25%"> <b><?php echo $entry_log_time; ?></b> <?php echo $log_time; ?></td><td></td>
          </tr>
          <tr>
          <tr>
          <td colspan="<?php echo !empty($last_username) ? '4' : '8'?>" valign="top"style="border-right: 1px solid #cccccc;background-color:#c3d999;">
          		<b><?php echo $entry_data ?></b><div style="margin:auto;"><?php echo $data;?></div>
          </td>
          <?php if(!empty($last_username)){?>          
          <td colspan="4" valign="top" style="border-left: 1px solid #cccccc;background-color:#DBDBDB;">
          		<b>Last <?php echo $entry_data ?></b>
          		<div style="margin: 0 auto"><?php echo $last_data;?></div>
          </td>
          <?php } ?>
          </tr>
          <?php if(!empty($last_username)){?>
          <tr bgcolor="#DBDBDB">
            <td width="25%"> <b>Last <?php echo $entry_user; ?></b> <?php echo $last_username; ?></td><td></td>
            <td width="25%"> <b>Last <?php echo $entry_url; ?></b> <?php echo $last_url; ?></td><td></td>
            <td width="25%"> <b>Last <?php echo $entry_action; ?></b> <?php echo $last_action; ?></td><td></td>            
            <td width="25%"> <b>Last <?php echo $entry_log_time; ?></b> <?php echo $last_log_time; ?></td><td></td>
          </tr>
		<?php } ?>
        </table>
      
    </div>
  </div>
</div>
<?php echo $footer; ?> 