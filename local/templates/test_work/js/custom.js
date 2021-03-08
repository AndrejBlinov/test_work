$( document ).ready(function() {
	$( "form" ).on( "submit", function( event ) {
	  	event.preventDefault();
	  	const data = $(this).serializeArray() ;
		const name = $(this).attr("name");
		let scriptName = "";
		let edit ;
		switch(name) {
		  	case 'questAddForm':  // if (x === 'value1')
				scriptName = "questAdd";
				edit = $("#questList");
			break;
		
		  	case 'addWorkForm':  // if (x === 'value2')
				scriptName = "workerAdd";
				edit = $("#workerList");
			break;
			case 'editQuestForm':  // if (x === 'value2')
				scriptName = "editQuest";
				edit = $("#editQuestForm");
			break;
			case 'editWorkerForm':  // if (x === 'value2')
				scriptName = "editWorker";
				edit = $("#editWorkerForm");
			break;
		}
		$.ajax({
			url: '/local/ajax/'+scriptName+'.php',
			method: 'post',
			dataType: 'html',
			data: {data: data , name: name},
			success: function(data){
				console.log(data);
				if (data!=="error")
				{
					if($(".modal").hasClass('show')){
						$(".modal").modal("hide")
					}
					edit.html(data);
				}
			}
		});
	});
}) 

function deletequest(id){
	let edit = $("#questList");
	$.ajax({
		url: '/local/ajax/questDelete.php',
		method: 'post',
		dataType: 'html',
		data: {id: id},
		success: function(data){
			if (data!=="error")
			{
				console.log(data);
				if($(".modal").hasClass('show')){
					$(".modal").modal("hide")
				}
				alert("Удaлeние произошло успешно") ;
				edit.html(data);
	
			}
		}
	});
}

function deleteUsers(id){
	let edit = $("#workerList");
	$.ajax({
		url: '/local/ajax/worksDelete.php',
		method: 'post',
		dataType: 'html',
		data: {id: id},
		success: function(data){
			if (data!=="error")
			{
				console.log(data);
				if($(".modal").hasClass('show')){
					$(".modal").modal("hide")
				}
				alert("Удaлeние произошло успешно") ;
				edit.html(data);
	
			}
		}
	});
}
