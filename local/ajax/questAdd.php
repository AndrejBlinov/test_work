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
		$formName = $request->getPost("name"); 
		$formData = $request->getPost("data"); 
		$name = "";
		$PROP = array();

		foreach($formData as $dataItem)
		{
			switch($dataItem['name']){
				case 'questName' :
					$name = $dataItem['value'] ;
				break;

				case 'questWorker':
					$PROP['WORKER']["VALUE"] = $dataItem['value'];
				break;

				case 'questStatus':
					$PROP['STATUS']["VALUE"] = $dataItem['value'];
				break;
			}
		}

		$arTranslitParams = array("replace_space"=>"-","replace_other"=>"-"); 
		$CODE = Cutil::translit(strtolower($name. date("Y-m-d H")),"ru",$arTranslitParams); 

		$arLoadProductArray = Array(
		  	"MODIFIED_BY"    => 1, // элемент изменен текущим пользователем
		  	"IBLOCK_SECTION_ID" => false,          // элемент лежит в корне раздела
		  	"IBLOCK_ID"      => 3,
		  	"PROPERTY_VALUES"=> $PROP,
		  	"NAME"           => $name,
		  	"ACTIVE"         => "Y",  
 			'PREVIEW_TEXT' => '',  
   			'DETAIL_TEXT' => '',
			'CODE' => $CODE,         
		);
		file_put_contents(__DIR__ ."/text.txt",print_r($arLoadProductArray,true));

		if($PRODUCT_ID = $el->Add($arLoadProductArray)){
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
			 }
				echo($str);
		}
		else{
			echo("error");
		}
	}
}
?>