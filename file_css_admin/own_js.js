$(document).ready(function() {
	var date = new Date();
	$('#example_scroll').DataTable( {
        "scrollY":        "200px",
        "scrollCollapse": true,
        "paging":         false
    } );
    $('#example_scroll_cart').DataTable( {
        "scrollY":        "400px",
        "scrollCollapse": true,
        "paging":         false
    } );
	$('#example').DataTable( {
	    dom: 'Bfrtip',
	    buttons: [
	        {
	            extend: 'copyHtml5',
	            exportOptions: {
	                columns: [ 0, ':visible' ]
	            }
	        },
	        {
	            extend: 'excelHtml5',
	            exportOptions: {
	                columns: ':visible'
	            }
	        },
	        {
	            extend: 'pdfHtml5',
	            exportOptions: {
	                columns: [ 0, 1, 2, 5 ]
	            }
	        },
	        'colvis'
	    ]
	} );
	$('#example_buyer').DataTable( {
		scrollX: true,
	    dom: 'Bfrtip',
	    buttons: [
	        {
	            extend: 'copyHtml5',
	             title: 'Receive Material Requisition - '+date,
	            exportOptions: {
	                columns: [ 0, ':visible' ]
	            }
	        },
	        {
	            extend: 'excelHtml5',
	            title: 'Receive Material Requisition - '+date,
	            exportOptions: {
	                columns: ':visible'
	            }
	        },
	        {
	            extend: 'pdfHtml5',
	            orientation:'landscape',
	            title: 'Receive Material Requisition - '+date,
	            exportOptions: {
	                columns: ':visible'
	            },
	            // customize: function(doc) {
             //            console.log(doc.content)
             //            doc.content.splice(0, 0, {
             //                margin: [12, 0, 0, 12],
             //                alignment: "center",
             //            });

             //            doc.content[2].table.widths = ["*", "*", "*"];
             //        }
	            // exportOptions: {
	            //     columns: [ 0, 1, 2, 5 ]
	            // }
	        },
	        'colvis'
	    ]
	} );
} );

  $( function() {
    $( "#datepicker" ).datepicker({
    		changeMonth: true,
      		changeYear: true,
      		dateFormat: 'yy-mm-dd'
    	});
  } );
