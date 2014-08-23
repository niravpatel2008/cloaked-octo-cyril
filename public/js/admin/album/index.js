var oTable;
$(document).ready(function() {
	oTable = $('#albumTable').dataTable( {
		"processing": true,
		"serverSide": true,
		"ajax": {
			"url": admin_path ()+'album/ajax_list/',
			"type": "POST"
		},
		aoColumnDefs: [
		  {
			 bSortable: false,
			 aTargets: [ -1 ]
		  },
		  {
			 bSortable: false,
			 aTargets: [ -2 ]
		  }
		]
	} );
} );
function delete_album (del_id) {
	$.ajax({
		type: 'post',
		url: admin_path()+'album/delete',
		data: 'id='+del_id,
		success: function (data) {
			if (data == "success") {
				oTable.fnClearTable(0);
				oTable.fnDraw();
				$("#flash_msg").html(success_msg_box ('Album deleted successfully.'));
			}else{
				$("#flash_msg").html(error_msg_box ('An error occurred while processing.'));
			}
		}
	});
}