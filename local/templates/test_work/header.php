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
	<?$APPLICATION->AddHeadScript("https://cdn.jsdelivr.net/gh/StephanWagner/jBox@v1.2.13/dist/jBox.all.min.js");?>
	<?$APPLICATION->SetAdditionalCSS("https://cdn.jsdelivr.net/gh/StephanWagner/jBox@v1.2.13/dist/jBox.all.min.css")?>
	<?$APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH."/js/custom.js");?>
	<?$APPLICATION->ShowHead();?>

</head>
<body>
		<div id="page-wrapper">
			<div id="panel"><?$APPLICATION->ShowPanel();?></div>
		</div>
		<div class="row">
<?
//получаем все справочники, как для отображения таблиц, так и для заполнения форм
// можно запихнуть логику в компонент и закешировать
CModule::IncludeModule("iblock");
//Статусы заявок
global $GLOBALS ;
$arSelect = Array("ID", "NAME");
$arFilter = Array("IBLOCK_ID"=>6, "ACTIVE_DATE"=>"Y", "ACTIVE"=>"Y");
$res = CIBlockElement::GetList(Array(), $arFilter, false, Array(), $arSelect);
while($ob = $res->GetNextElement())
{
 $arFields = $ob->GetFields();
 $statuslist[$arFields["ID"]]=$arFields["NAME"] ;
} 

//Список сотрудников
$arSelect = Array("ID", "NAME");
$arFilter = Array("IBLOCK_ID"=>4, "ACTIVE_DATE"=>"Y", "ACTIVE"=>"Y");
$res = CIBlockElement::GetList(Array(), $arFilter, false, Array(), $arSelect);
while($ob = $res->GetNextElement())
{
 $arFields = $ob->GetFields();
 $WorkersList[$arFields["ID"]]=$arFields["NAME"] ;
} 

$arSelect = Array("ID", "NAME");
$arFilter = Array("IBLOCK_ID"=>5, "ACTIVE_DATE"=>"Y", "ACTIVE"=>"Y");
$res = CIBlockElement::GetList(Array(), $arFilter, false, Array(), $arSelect);
while($ob = $res->GetNextElement())
{
 $arFields = $ob->GetFields();
 $PostList[$arFields["ID"]]=$arFields["NAME"] ;
} 

$GLOBALS['POST_LIST'] = $PostList;
$GLOBALS['WORKER_LIST'] = $WorkersList;
$GLOBALS['STATUS_LIST'] = $statuslist;

?>