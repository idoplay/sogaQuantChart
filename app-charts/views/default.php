<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<!--meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"-->
<meta name="viewport" content="width=device-width, initial-scale=1">
<title><?php echo $title_for_layout; ?></title>
<meta name="keywords" content="<?php echo $keywords_for_layout; ?>">
<meta name="description" content="<?php echo $description_for_layout; ?>">
<?php
/*简单处理css&js版本问题*/
$_lay_version = '';
if(file_exists(APPPATH.'_version')){
    $_lay_version = trim(file_get_contents(APPPATH.'_version'));
}
?>
<?php if(!empty($style_for_layout)):?>
<?php foreach($style_for_layout as $value):?>
<link rel="stylesheet" rev="stylesheet" href="<?php echo $Layout->get_style_url($value); ?><?php if($_lay_version){echo "?=v".$_lay_version;}?>" type="text/css" />
<?php endforeach;?>
<?php endif;?>

<?php if(!empty($lib_style_for_layout)):?>
<?php foreach($lib_style_for_layout as $value):?>
<link rel="stylesheet" rev="stylesheet" href="<?php echo $value; ?>" type="text/css" />
<?php endforeach;?>
<?php endif;?>
<script type="text/javascript" src="/pages/echarts/echarts.js"></script>
</head>
<body>


<?php echo $Layout->component($Layout->get_header());?>

<?php echo $contents_for_layout; ?>

<?php echo $Layout->component($Layout->get_footer());?>

<?php if(!empty($script_for_layout)):?>
<?php foreach($script_for_layout as $value):?>
<script type="text/javascript" src="<?php echo $Layout->get_javascript_url($value); ?><?php if($_lay_version){echo "?=v".$_lay_version;}?>"></script>
<?php endforeach;?>
<?php endif;?>

<script type="text/javascript">
<?php
$blocks = '';
foreach ($Layout->get_script_blocks() as $block) {
    $blocks .= preg_replace('/^\s*<script[^>]*>(.*)<\/script>\s*$/ims', '$1', $block);
};
echo $blocks;
?>
</script>
<?php echo $Layout->component('component/tracker');?>
<?php echo $Layout->component('component/debug');?>
</body>
</html>