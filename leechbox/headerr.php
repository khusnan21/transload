<?php
// You can do some initialization for the template here
@date_default_timezone_set(date_default_timezone_get());
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>LeechBOX</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <link href="templates/leechbox/styles/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <link href="templates/leechbox/styles/style.css" rel="stylesheet" type="text/css" />
    <link href="templates/leechbox/styles/blue.css" rel="stylesheet" type="text/css" />
<script type="text/javascript">
/* <![CDATA[ */
var php_js_strings = [];
php_js_strings[87] = " <?php echo lang(87); ?>";
php_js_strings[281] = "<?php echo lang(281); ?>";
pic1= new Image(); 
pic1.src="templates/leechbox/images/ajax-loading.gif";
/* ]]> */
</script>
<script type="text/javascript" src="classes/js.js"></script>
<?php
if ($options['ajax_refresh']) { echo '<script type="text/javascript" src="classes/ajax_refresh.js"></script>'.$nn; }
if ($options['flist_sort']) { echo '<script type="text/javascript" src="classes/sorttable.js"></script>'.$nn; }
?>

</head>

  <body class="skin-blue layout-boxed">
    <div class="wrapper">