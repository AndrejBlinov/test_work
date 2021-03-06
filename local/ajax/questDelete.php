<?
if (!$_SERVER["DOCUMENT_ROOT"])
{
	$_SERVER["DOCUMENT_ROOT"] = __DIR__ . "/../";
}
require_once($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");

$context = Bitrix\Main\Application::getInstance()->getContext();
$request = $context->getRequest() ;

if ($request->isPost()){
	global $GLOBALS ;
	if(CModule::IncludeModule("iblock")){
		$ELEMENT_ID = $request->getPost("id"); 
		CIBlockElement::Delete($ELEMENT_ID);

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

		$arSelect = Array("ID", "NAME","PROPERTY_STATUS","PROPERTY_WORKER");
		$arFilter = Array("IBLOCK_ID"=>3,"ACTIVE"=>"Y");
		$res = CIBlockElement::GetList(Array(), $arFilter, false, Array(), $arSelect);
		$quest=array();
		while($ob = $res->GetNextElement())
		{
			$arFields = $ob->GetFields();
			$quest[]=$arFields;
		} 
		$str="";
		foreach($quest as $index=>$arItem){
			$str .="<tr><th scope='row'>".($index+1);
				$str .="</th><td>".$arItem["NAME"].'</td><td>';
				foreach($arItem["PROPERTY_WORKER_VALUE"] as $index=>$worker)
					{
						$WorkerName = $WorkersList[$worker];
						$index==0 ? $strItem = $WorkerName : $strItem = " ,".$WorkerName ;
						$str .=$strItem;
					}
				$str .='</td>
				<td>'.$statuslist[$arItem["PROPERTY_STATUS_VALUE"]].'</td>
				<td><a href="#">редактировать</a>/<a onclick="deletequest('.$arItem["ID"].')" href="#">удалить</a><a></a></td>
			</tr>';
		}echo($str);
	}
	else{
		echo("error");
	}
}
?>