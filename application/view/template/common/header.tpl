<!DOCTYPE html>
<html dir="<?php echo $direction; ?>" lang="<?php echo $lang; ?>">
<head>
<meta charset="UTF-8" />
<title><?php echo $title; ?></title>
<meta content="width=device-width, initial-scale=1.0" name="viewport" />
<base href="<?php echo $base; ?>" />
<?php if ($description) { ?>
<meta name="description" content="<?php echo $description; ?>" />
<?php } ?>
<?php if ($keywords) { ?>
<meta name="keywords" content="<?php echo $keywords; ?>" />
<?php } ?>
<?php foreach ($links as $link) { ?>
<link href="<?php echo $link['href']; ?>" rel="<?php echo $link['rel']; ?>" />
<?php } ?>
<!-- BEGIN GLOBAL MANDATORY STYLES -->

<link href="asset/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>

<link href="asset/css/bootstrap-responsive.min.css" rel="stylesheet" type="text/css"/>

<link href="asset/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>

<link href="asset/css/style-metro.css" rel="stylesheet" type="text/css"/>

<link href="asset/css/style.css" rel="stylesheet" type="text/css"/>

<link href="asset/css/style-responsive.css" rel="stylesheet" type="text/css"/>

<link href="asset/css/default.css" rel="stylesheet" type="text/css" id="style_color"/>

<link href="asset/css/uniform.default.css" rel="stylesheet" type="text/css"/>

<!-- END GLOBAL MANDATORY STYLES -->
<?php if($styles){?>
<!-- BEGIN EXT PLUGINS STYLESHEET -->
<?php foreach ($styles as $style) { ?>
<link rel="<?php echo $style['rel']; ?>" type="text/css" href="<?php echo $style['href']; ?>" media="<?php echo $style['media']; ?>" />
<?php } ?>
<!-- END EXT PLUGINS STYLESHEET -->
<?php }?>

<script src="asset/js/jquery-1.10.1.min.js" type="text/javascript"></script>

<script src="asset/js/jquery-migrate-1.2.1.min.js" type="text/javascript"></script>

	<!-- IMPORTANT! Load jquery-ui-1.10.1.custom.min.js before bootstrap.min.js to fix bootstrap tooltip conflict with jquery ui tooltip -->

<script src="asset/js/jquery-ui-1.10.1.custom.min.js" type="text/javascript"></script>      

<script src="asset/js/bootstrap.min.js" type="text/javascript"></script>

<!--[if lt IE 9]>

	<script src="asset/js/excanvas.min.js"></script>

	<script src="asset/js/respond.min.js"></script>  

<![endif]-->   

<script src="asset/js/jquery.slimscroll.min.js" type="text/javascript"></script>

<script src="asset/js/jquery.blockui.min.js" type="text/javascript"></script>  

<script src="asset/js/jquery.cookie.min.js" type="text/javascript"></script>

<script src="asset/js/jquery.uniform.min.js" type="text/javascript" ></script>

<!-- END CORE PLUGINS -->

<?php if($scripts){?>
<!-- BEGIN EXT PLUGINS JAVASCRIPT -->
<?php foreach ($scripts as $script) { ?>
<script type="text/javascript" src="<?php echo $script; ?>"></script>
<?php } ?>
<!-- END EXT PLUGINS JAVASCRIPT -->
<?php }?>
<script src="protected/view/javascript/app.js" type="text/javascript"></script>
</head>
<body <?php echo !empty($body_class) ? 'class="'.$body_class.'"' : ''?>>

