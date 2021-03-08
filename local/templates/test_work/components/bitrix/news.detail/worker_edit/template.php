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
?>
<h2>
Редактирование сотрудника "<?=$arResult["NAME"]?>"
</h2>
<?global $GLOBALS;
?>
<div>
	<form id="editWorkerForm" name="editWorkerForm">
		<div class="input-group">
			<div class="input-group-prepend">
				<span class="input-group-text">ФИО исполнителя</span>
			</div>
			<input type="text" value="<?=$arResult["NAME"]?>" name="workName" class="form-control" required>
		</div>
		<div class="form-group">
			<label for="workPost_addWorkForm">Статус</label>
			<select class="form-select" aria-label="Выберите должность" id="workPost_addWorkForm"  name="workPost" required>
				<?foreach( $GLOBALS['POST_LIST'] as $index=>$workerItem){?>
				<option value=<?=$index?> <?if($index==$arResult["PROPERTIES"]["POST"]["VALUE"]){echo("selected");}?>><?=$workerItem?></option>
				<?}?>
			</select>
		</div>
		<input type="hidden" name="id" value="<?=$arParams['ELEMENT_ID']?>">
		<div>
			<button type="button" class="btn btn-secondary" >Выйти</button>
			<button type="submit" class="btn btn-primary">Сохранить</button>
		</div>
	</form>
</div>
