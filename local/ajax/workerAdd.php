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
				case 'workName' :
					$name = $dataItem['value'] ;
				break;

				case 'workPost':
					$PROP['POST']["VALUE"] = $dataItem['value'];
				break;
			}
		}

		$arTranslitParams = array("replace_space"=>"-","replace_other"=>"-"); 
		$CODE = Cutil::translit(strtolower( $name. date("Y-m-d H")),"ru",$arTranslitParams); 

		$arLoadProductArray = Array(
		  	"MODIFIED_BY"    => 1, // элемент изменен текущим пользователем
		  	"IBLOCK_SECTION_ID" => false,          // элемент лежит в корне раздела
		  	"IBLOCK_ID"      => 4,
		  	"PROPERTY_VALUES"=> $PROP,
		  	"NAME"           => $name,
		  	"ACTIVE"         => "Y",  
 			'PREVIEW_TEXT' => '',  
   			'DETAIL_TEXT' => '',
			'CODE' => $CODE,         
		);
		file_put_contents(__DIR__ ."/text.txt",print_r($arLoadProductArray,true));

		if($PRODUCT_ID = $el->Add($arLoadProductArray)){ 

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

		}
		else{
			echo("error");
		}
	}
}
?>