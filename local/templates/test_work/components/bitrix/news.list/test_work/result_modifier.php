<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */

//Статусы заявок
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

$arResult["STATUS_LIST"] = $statuslist; 
$arResult["WORKERS"] = $WorkersList;   
