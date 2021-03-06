<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */

//Статусы заявок
$arSelect = Array("ID", "NAME");
$arFilter = Array("IBLOCK_ID"=>5, "ACTIVE_DATE"=>"Y", "ACTIVE"=>"Y");
$res = CIBlockElement::GetList(Array(), $arFilter, false, Array(), $arSelect);
while($ob = $res->GetNextElement())
{
 $arFields = $ob->GetFields();
 $PostList[$arFields["ID"]]=$arFields["NAME"] ;
} 

$arResult['POST_LIST'] = $PostList;
