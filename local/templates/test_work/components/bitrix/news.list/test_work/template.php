<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */
$this->setFrameMode(true);

$themeClass = isset($arParams['TEMPLATE_THEME']) ? ' bx-'.$arParams['TEMPLATE_THEME'] : '';
?>
<?
global $GLOBALS ;
//print_r($arResult["ITEMS"][0]);?>
<div>
	<div>
		<table class="table">
		  <thead>
			<tr>
				<th>#</th>
				<th>Название</th>
				<th>Исполнитель</th>
				<th>Статус</th>
				<th>Действия</th>
			</tr>
		  </thead>
		  <tbody id="questList">
			<?foreach($arResult["ITEMS"] as $index=>$arItem){?>
			<tr>
				<th scope="row"><?=$index+1?></th>
				<td><?=$arItem["NAME"]?></td>
				<td>
					<?=$GLOBALS['WORKER_LIST'][$arItem["PROPERTIES"]["WORKER"]["VALUE"]];?>
				</td>
				<td><?=$GLOBALS["STATUS_LIST"][$arItem["PROPERTIES"]["STATUS"]["VALUE"]]?></td>
				<td><a href="<?=$arItem['DETAIL_PAGE_URL']?>">редактировать</a>/<a onClick="deletequest(<?=$arItem["ID"]?>)" href="#">удалить<a/></td>
			</tr>
			  <?}?>
		  </tbody>
		</table>

		<?if($arParams["DISPLAY_BOTTOM_PAGER"]):?>
			<?=$arResult["NAV_STRING"]?>
		<?endif;?>
	</div>
</div>
