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
<div>
	<div>
		<table class="table">
		  <thead>
			<tr>
				<th>#</th>
				<th>Имя</th>
				<th>Должность</th>
				<th>Действия</th>
			</tr>
		  </thead>
		  <tbody>
			<?foreach($arResult["ITEMS"] as $index=>$arItem){?>
			<tr>
				<th scope="row"><?=$index+1?></th>
				<td><?=$arItem["NAME"]?></td>
				<td><?=$arResult['POST_LIST'][$arItem["PROPERTIES"]["POST"]["VALUE"]]?></td>
				<td><a href="#">редактировать/ удалить</a></td>
			</tr>
			  <?}?>
		  </tbody>
		</table>

		<?if($arParams["DISPLAY_BOTTOM_PAGER"]):?>
			<?=$arResult["NAV_STRING"]?>
		<?endif;?>
	</div>
</div>