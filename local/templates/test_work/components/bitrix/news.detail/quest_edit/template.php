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
Редактирование задачи "<?=$arResult["NAME"]?>"
</h2>
<?global $GLABALS;
//print_r($arParams['ELEMENT_ID']);
?>
<div>
	<form id="editQuestForm" name="editQuestForm">
		<div class="modal-body">
			<div class="input-group">
				<div class="input-group-prepend">
					<span class="input-group-text">Наименование задачи</span>
				</div>
				<input type="text" name="questName" class="form-control" value="<?=$arResult["NAME"]?>" required >
			</div>
			<div class="form-group">
				<label for="questWorker">Исполнитель</label>
				<select class="form-select" aria-label="Выберите исполнителя" id="questWorker" name="questWorker" required>
					<?foreach( $GLOBALS['WORKER_LIST'] as $index=>$workerItem){?>
					<option value="<?=$index?>" <?if($index==$arResult["PROPERTIES"]["WORKER"]["VALUE"]){echo("selected");}?>><?=$workerItem?></option>
					<?}?>
				</select>
			</div>
			<div class="form-group">
				<label for="questStatus">Статус</label>
				<select class="form-select" aria-label="Выберите статус задачи" id="questStatus"  name="questStatus" required>
					<?foreach( $GLOBALS['STATUS_LIST'] as $index=>$workerItem){?>
					<option value="<?=$index?>" <?if($index==$arResult["PROPERTIES"]["STATUS"]["VALUE"]){echo("selected");}?> ><?=$workerItem?></option>
					<?}?>
				</select>
			</div>
			<input type="hidden" name ="id" value="<?=$arParams['ELEMENT_ID']?>">
		</div>
		<div class="modal-footer">
			<button type="button" class="btn btn-secondary" data-dismiss="modal">Выйти</button>
			<button type="submit" class="btn btn-primary">Сохранить</button>
		</div>
	</form>
</div>