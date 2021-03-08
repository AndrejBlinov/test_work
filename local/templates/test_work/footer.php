			</div>

		<!--Модальные формы по добавлению задач и сотрудников -->
<?
global $GLOBALS;
?>
		<div class="modal"tabindex="-1" role="dialog" aria-hidden="true" id="questAdd">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
				  	<div class="modal-header">
						<h5 class="modal-title" id="exampleModalLabel">Добавить задачу</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					  	<span aria-hidden="true">&times;</span>
						</button>
				  	</div>
					<form id="addQuestForm" name="questAddForm">
				  		<div class="modal-body">
							<div class="input-group">
								<div class="input-group-prepend">
									<span class="input-group-text">Наименование задачи</span>
								</div>
								<input type="text" name="questName" class="form-control" required>
							</div>
							<div class="form-group">
								<label for="questWorker">Исполнитель</label>
								<select class="form-select" aria-label="Выберите исполнителя" id="questWorker" name="questWorker" required>
									<?foreach( $GLOBALS['WORKER_LIST'] as $index=>$workerItem){?>
									<option value=<?=$index?>><?=$workerItem?></option>
									<?}?>
								</select>
							</div>
							<div class="form-group">
								<label for="questStatus">Статус</label>
								<select class="form-select" aria-label="Выберите статус задачи" id="questStatus"  name="questStatus" required>
									<?foreach( $GLOBALS['STATUS_LIST'] as $index=>$workerItem){?>
									<option value=<?=$index?>><?=$workerItem?></option>
									<?}?>
								</select>
							</div>
				  		</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-secondary" data-dismiss="modal">Выйти</button>
							<button type="submit" class="btn btn-primary">Сохранить</button>
						</div>
					</form>
				</div>
			</div>
		</div>

		<div class="modal"tabindex="-1" role="dialog" aria-hidden="true" id="workerAdd">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
				  <div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">Добавить исполнителя</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					  <span aria-hidden="true">&times;</span>
					</button>
				  </div>
				  <form id="addWorkForm" name="addWorkForm">
				  		<div class="modal-body">
							<div class="input-group">
								<div class="input-group-prepend">
									<span class="input-group-text">ФИО исполнителя</span>
								</div>
								<input type="text" name="workName" class="form-control" required>
							</div>
							<div class="form-group">
								<label for="workPost_addWorkForm">Статус</label>
								<select class="form-select" aria-label="Выберите должность" id="workPost_addWorkForm"  name="workPost" required>
									<?foreach( $GLOBALS['POST_LIST'] as $index=>$workerItem){?>
									<option value=<?=$index?>><?=$workerItem?></option>
									<?}?>
								</select>
							</div>
				  		</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-secondary" data-dismiss="modal">Выйти</button>
							<button type="submit" class="btn btn-primary">Сохранить</button>
						</div>
					</form>
				</div>
			</div>
		</div>
		<!--КОНЕЦ -->
		</body>
	<footer></footer>
</html>
