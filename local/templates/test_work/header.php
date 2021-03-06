<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?
IncludeTemplateLangFile(__FILE__);
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="<?=LANGUAGE_ID?>" lang="<?=LANGUAGE_ID?>">
<head>
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<title><?$APPLICATION->ShowTitle()?></title>
	<link rel="shortcut icon" type="image/x-icon" href="<?=SITE_TEMPLATE_PATH?>/favicon.ico" />
	<?use Bitrix\Main\UI\Extension;
	Extension::load('ui.bootstrap4');?>
	<?$APPLICATION->ShowHead();?>

</head>
<body>
		<div id="page-wrapper">
			<div id="panel"><?$APPLICATION->ShowPanel();?></div>
		</div>
		<div class="row">