<?
if (!$_SERVER["DOCUMENT_ROOT"])
{
	$_SERVER["DOCUMENT_ROOT"] = __DIR__ . "/../";
}
require_once($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");

$context = Bitrix\Main\Application::getInstance()->getContext();
$request = $context->getRequest() ;

if ($request->isPost()){
	global $GLOBAL ;
	if(CModule::IncludeModule("iblock")){
		$el = new CIBlockElement;
		$ELEMENT_ID = $request->getPost("id"); 
		CIBlockElement::Delete($ELEMENT_ID);

		//Список сотрудников
		$arSelect = Array("ID", "NAME","PROPERTY_POST");
		$arFilter = Array("IBLOCK_ID"=>4,"ACTIVE"=>"Y");
		$res = CIBlockElement::GetList(Array(), $arFilter, false, Array(), $arSelect);
		while($ob = $res->GetNextElement())
		{
			$arFields = $ob->GetFields();
			$WorkersList[$arFields["ID"]]=$arFields ;
		} 


		$arSelect = Array("ID", "NAME");
		$arFilter = Array("IBLOCK_ID"=>5,"ACTIVE"=>"Y");
		$res = CIBlockElement::GetList(Array(), $arFilter, false, Array(), $arSelect);
		$quest=array();
		while($ob = $res->GetNextElement())
		{
			$arFields = $ob->GetFields();
			$postList[$arFields["ID"]]=$arFields["NAME"];
		} 

		$str="";
		foreach($WorkersList as $index=>$arItem){
			$str .="<tr><th scope='row'>".($index+1);
				$str .="</th><td>".$arItem['NAME'].'</td>
				<td>'.$postList[$arItem["PROPERTY_POST_VALUE"]].'</td>
				<td><a href="#">редактировать</a>/<a onClick="deleteUsers('.$arItem["ID"].')" href="#">удалить<a/></td>
			</tr>';
		}
		echo($str);

	}else{
		echo("error");
	}
}
?>