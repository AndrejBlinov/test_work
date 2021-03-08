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
		$PRODUCT_ID = 0;
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
				case 'id':
					$PRODUCT_ID = $dataItem['value'];
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

		if($PRODUCT_ID){
			$res = $el->Update($PRODUCT_ID, $arLoadProductArray);
			$str = "<div>
						<h3>Изменения внесены</h3>
						<a href='/' class='btn btn-btn btn-success'  >Вернутся назад</a>
					</div>";
			echo($str);
		}	
		else{
			echo("error");
		}
	}
}
?>