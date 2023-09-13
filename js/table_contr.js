//INTERACTIVE TABLE CONTROLLER


  $(document).on('click', '#masterCheckbox', function() {          
    //working
		$(".userCheckbox").prop("checked", this.checked);
		//$("#select_count").html($("input.userCheckbox:checked").length+" Selected");
	});	

	$(document).on('click', '.userCheckbox', function() {		
		if ($('.userCheckbox:checked').length == $('.userCheckbox').length) {
			$('#masterCheckbox').prop('checked', true);
		} else {
			$('#masterCheckbox').prop('checked', false);
  
		}
  
	});  


  // delete selected User records
$('#deleteuser').on('click', function(e) { 
	var employee = [];  
	$(".userCheckbox:checked").each(function() {  
		employee.push($(this).data('user-id'));
	});	

	if(employee.length <=0)  {  
		alert("Please select records.");  
	}  
	else { 	
		WRN_PROFILE_DELETE = "Are you sure you want to delete "+(employee.length>1?"these":"this")+" row?";  
		var checked = confirm(WRN_PROFILE_DELETE);  
		if(checked == true) {			
			var selected_values = employee.join(","); 
			$.ajax({ 
				type: "POST",  
				url: "datacenter.php",  
				cache:false,  
				data: 'user_id='+selected_values,  
				success: function(response) {	
          
          if(response){
            alert(response);
            location.reload();
          }
				}   
			});				
		}  
	}  
});

  // delete selected Product records
  $('#deleteproduct').on('click', function(e) { 
    var employee = [];  
    $(".userCheckbox:checked").each(function() {  
      employee.push($(this).data('product-id'));
    });	
  
    if(employee.length <=0)  {  
      alert("Please select records.");  
    }  
    else { 	
      WRN_PROFILE_DELETE = "Are you sure you want to delete "+(employee.length>1?"these":"this")+" row?";  
      var checked = confirm(WRN_PROFILE_DELETE);  
      if(checked == true) {			
        var selected_values = employee.join(","); 
        $.ajax({ 
          type: "POST",  
          url: "datacenter.php",  
          cache:false,  
          data: 'product_id='+selected_values,  
          success: function(response) {	
            alert(response);
            location.reload();
          }   
        });				
      }  
    }  
  });
  



  // EXPORT TO PDF
  $('#product_create_pdf').on('click', function(e) {
    e.preventDefault();
    
    var products = [];
    $(".userCheckbox:checked").each(function() {
      products.push($(this).data('product-id'));
    });
  
    if (products.length <= 0) {
      alert("Please select records.");
    } else {
      var selected_values = products.join(",");
      var form = $('<form action="datacenter.php" method="post" target="_blank">' +
        '<input type="hidden" name="pdfproduct_id" value="' + selected_values + '">' +
        '</form>');
      $('body').append(form);
      form.submit();
    }
  });


  // EXPORT SALES REPORT TO PDF
  $('#sales_pdf').on('click', function(e) {
    e.preventDefault();

    var sales = [];
  
    $(".userCheckbox:checked").each(function() {
      sales.push($(this).data('summary-id'));
    });
  
    if (sales.length <= 0) {
      alert("Please select records.");
    } else {
      var selected_values = sales.join(",");
      var form = $('<form action="datacenter.php" method="post" target="_blank">' +
        '<input type="hidden" name="pdfsalesid" value="' + selected_values + '">' +
        '</form>');
      $('body').append(form);
      form.submit();
    }
    
  });





//EXPORT PRODUCT TABLE TO PDF

$(document).ready(function() {
  $('#create_excel').click(function() {
    // Clone the original table to a new variable
    var modifiedTable = $("#userTable").clone();


    // Remove the last <td> in each <tr> of the cloned table
    modifiedTable.find("tr").children("td:last-child").remove();
    modifiedTable.find("tr").children("th:last-child").remove();

    // Generate the filename in the desired format
    var currentDate = new Date();
    var year = currentDate.getFullYear();
    var month = (currentDate.getMonth() + 1).toString().padStart(2, "0");
    var day = currentDate.getDate().toString().padStart(2, "0");

    // Get the number of data rows in the table
    var numberOfRows = modifiedTable.find("tr").length-2;

    // Create a filename with the format "accounts-YYYYMMDD-XXXX.xls"
    var filename = "accounts-" + year + month + day + "-" + numberOfRows.toString().padStart(4, "0") + ".xls";

    // Call the table2excel plugin on the modified table with the custom filename
    modifiedTable.table2excel({
      filename: filename,
      fileext: ".xls",
      preserveColors: false
    });
  });
});


//EXPORT SALES REPORT TABLE TO EXCEL

$(document).ready(function() {
  $('#sales_excel').click(function() {

  
    // Clone the original table to a new variable
    var modifiedTable = $("#salestable").clone();


    // Remove the last <td> in each <tr> of the cloned table
    modifiedTable.find("tr").children("td:last-child").remove();
    modifiedTable.find("tr").children("th:last-child").remove();

    // Generate the filename in the desired format
    var currentDate = new Date();
    var year = currentDate.getFullYear();
    var month = (currentDate.getMonth() + 1).toString().padStart(2, "0");
    var day = currentDate.getDate().toString().padStart(2, "0");

    // Get the number of data rows in the table
    var numberOfRows = modifiedTable.find("tr").length-2;

    // Create a filename with the format "accounts-YYYYMMDD-XXXX.xls"
    var filename = "Sales-Report -" + year + month + day + "-" + numberOfRows.toString().padStart(4, "0") + ".xls";

    // Call the table2excel plugin on the modified table with the custom filename
    modifiedTable.table2excel({
      filename: filename,
      fileext: ".xls",
      preserveColors: false
    });
  
  });
  
});


  //EXPORT TRX REPORT TABLE TO EXCEL

$(document).ready(function() {
  $('#trxexcel').click(function() {

  
    // Clone the original table to a new variable
    var modifiedTable = $("#salesdata").clone();



    // Generate the filename in the desired format
    var currentDate = new Date();
    var year = currentDate.getFullYear();
    var month = (currentDate.getMonth() + 1).toString().padStart(2, "0");
    var day = currentDate.getDate().toString().padStart(2, "0");

    // Get the number of data rows in the table
    var numberOfRows = modifiedTable.find("tr").length-2;

    // Create a filename with the format "accounts-YYYYMMDD-XXXX.xls"
    var filename = "Sales-Transaction -" + year + month + day + "-" + numberOfRows.toString().padStart(4, "0") + ".xls";

    // Call the table2excel plugin on the modified table with the custom filename
    modifiedTable.table2excel({
      filename: filename,
      fileext: ".xls",
      preserveColors: false
    });
  
  });
  
});




$(document).ready(function() {

  $('#product_create_excel').click(function() {
    // Clone the original table to a new variable
    var modifiedTable = $("#productTable").clone();
    // Get the category value from the URL
    var urlParams = new URLSearchParams(window.location.search);
    var category = urlParams.get('szcategory');
    
    if (!category) {
      category = '';
    }

    // Remove the last <td> in each <tr> of the cloned table
    modifiedTable.find("tr").children("td:last-child").remove();
    modifiedTable.find("tr").children("th:last-child").remove();

    // Generate the filename in the desired format
    var currentDate = new Date();
    var year = currentDate.getFullYear();
    var month = (currentDate.getMonth() + 1).toString().padStart(2, "0");
    var day = currentDate.getDate().toString().padStart(2, "0");

    // Get the number of data rows in the table
    var numberOfRows = modifiedTable.find("tr").length-2;

    // Create a filename with the format "accounts-YYYYMMDD-XXXX.xls"
    var filename = "products-" + category + "-" + year + month + day + "-" + numberOfRows.toString().padStart(4, "0") + ".xls";

    // Call the table2excel plugin on the modified table with the custom filename
    modifiedTable.table2excel({
      filename: filename,
      fileext: ".xls",
      preserveColors: false
    });
  });
});






$(document).ready(function() {
  
  var $disabledInput = $("#disabledInput");

  $disabledInput.on("mouseenter", function() {
    if ($disabledInput.prop("disabled")) {
      $disabledInput.css("cursor", "url('https://via.placeholder.com/20'), not-allowed");
    }
  });

  $disabledInput.on("mouseleave", function() {
    if ($disabledInput.prop("disabled")) {
      $disabledInput.css("cursor", "not-allowed");
    }
  });

  




});




  $(document).ready(function () {
    
    $(document).ready(function () {
      $("#companyform").submit(function (event) {
          event.preventDefault();
          var loader = $("#loader_main");
          loader.show();
          // Get the form data as an object
          var formData = new FormData(this);
          $.ajax({
              type: "POST",
              url: "datacenter.php",
              data: formData,
              processData: false,
              contentType: false,
              success: function (response) {

                  alert(response);
                  loader.hide();
                  location.reload();

              }
          });
      });
  });


  //Get company name function here!
  $.ajax({
    type: "POST",
    url: "datacenter.php",
    data: 'getcompanyname=1',
    success: function (response) {
      var uppercaseString = response.toUpperCase();
      $('#companyheader').html(uppercaseString);
      $('#companyname').html(uppercaseString + ' <i class="fa fa-check-circle" aria-hidden="true"></i>');
      $('#licenseto').html(response);
        
    }
  });

    //Get company name function here for index
    $.ajax({
      type: "POST",
      url: "manage/datacenter.php",
      data: 'getcompanyname=1',
      success: function (response) {
        var uppercaseString = response.toUpperCase();
        $('#companyheader2').html(uppercaseString);
          
      }
    });


});



var updateInterval; // Declare a variable to store the interval ID

function calculateTimeLeft(expiryDate) {
  var currentDateTime = new Date();
  
  // Convert expiryDate into a Date object
  var year = parseInt(expiryDate.substr(0, 4));
  var month = parseInt(expiryDate.substr(4, 2)) - 1; // Months are zero-indexed
  var day = parseInt(expiryDate.substr(6, 2));
  var expiryDateTime = new Date(year, month, day);

  var timeDifference = expiryDateTime - currentDateTime;
  
  if (timeDifference < 0) {
    clearInterval(updateInterval);

    // Send AJAX request to indicate expiry to backend
    $.ajax({
      type: "POST",
      url: "datacenter.php",
      data: 'expiredemo=1',
      success: function(response) {
        alert(response);
        location.reload();
      }
    });

    

    // You can perform other actions when the demo has expired
  } else {
    var hoursLeft = Math.floor(timeDifference / (1000 * 60 * 60));
    var minutesLeft = Math.floor((timeDifference % (1000 * 60 * 60)) / (1000 * 60));
    
    $('#timeleft').html("Time left: " + hoursLeft + " hours " + minutesLeft + " minutes");
  }
}

function updateTimeLeft() {
  $.ajax({
    type: "POST",
    url: "datacenter.php",
    data: 'expirycheck=1',
    success: function (response) {
      if (response == '') {
        // Handle empty response
      } else {
        calculateTimeLeft(response);
      }
    }
  });
}

// Call updateTimeLeft initially
updateTimeLeft();

// Update time every 5 seconds (adjust interval as needed)
updateInterval = setInterval(updateTimeLeft, 5000); // Store the interval ID

// Stop the interval when the page is unloaded or navigated away
$(window).on('unload', function () {
  clearInterval(updateInterval);
});






//FOR INDEXXXXXXXXXXXXX


var updateInterval2; // Declare a variable to store the interval ID

function calculateTimeLeft2(expiryDate) {
  var currentDateTime = new Date();
  
  // Convert expiryDate into a Date object
  var year = parseInt(expiryDate.substr(0, 4));
  var month = parseInt(expiryDate.substr(4, 2)) - 1; // Months are zero-indexed
  var day = parseInt(expiryDate.substr(6, 2));
  var expiryDateTime = new Date(year, month, day);

  var timeDifference = expiryDateTime - currentDateTime;
  
  if (timeDifference < 0) {
    clearInterval(updateInterval2);

    // Send AJAX request to indicate expiry to backend
    $.ajax({
      type: "POST",
      url: "manage/datacenter.php",
      data: 'expiredemo=1',
      success: function(response) {
        alert(response);
      }
    });

    

    // You can perform other actions when the demo has expired
  } else {
    var hoursLeft = Math.floor(timeDifference / (1000 * 60 * 60));
    var minutesLeft = Math.floor((timeDifference % (1000 * 60 * 60)) / (1000 * 60));
    
    $('#timeleft2').html("Time left: " + hoursLeft + " hours " + minutesLeft + " minutes");
  }
}

function updateTimeLeft2() {
  $.ajax({
    type: "POST",
    url: "manage/datacenter.php",
    data: 'expirycheck=1',
    success: function (response) {
      if (response == '') {
        // Handle empty response
      } else {
        calculateTimeLeft2(response);
      }
    }
  });
}

// Call updateTimeLeft initially
updateTimeLeft2();

// Update time every 5 seconds (adjust interval as needed)
updateInterval2 = setInterval(updateTimeLeft, 5000); // Store the interval ID

// Stop the interval when the page is unloaded or navigated away
$(window).on('unload', function () {
  clearInterval(updateInterval2);
});



$.ajax({
  type: "POST",
  url: "manage/datacenter.php",
  data: 'getversion2=1',
  success: function (response) {
    console.log(response);

    var data1 = response.data1;
    var data2 = response.data2;

    $('#falias2').html(data2 + '&nbsp;');
    $('#fversion2').html(data1+ '&nbsp;');

  }
});



$(document).ready(function() {
  $('#open-profile').click(function() {

    alert('Work in Progress: This module is still being developed to offer you even more capabilities. Keep an eye out for updates!');
    
  });

  $('#open-settings').click(function() {

    alert('Work in Progress: This module is still being developed to offer you even more capabilities. Keep an eye out for updates!');
    
  });

  $('#open-logout').click(function() {

    $.ajax({
      type: "POST",
      url: "manage/datacenter.php",
      data: 'logout=1',
      success: function (response) {
      
        if(response == '1'){
          
          location.href='welcome'
        }
        else{
          //if error handle!
        }
        
        
      }
    });
    
  });

  $('#open-logout2').click(function() {

    $.ajax({
      type: "POST",
      url: "datacenter.php",
      data: 'logout=1',
      success: function (response) {
      
        if(response == '1'){
          
          location.href='../welcome'
        }
        else{
          //if error handle!
        }
        
        
      }
    });
    
  });


  $.ajax({
    type: "POST",
    url: "datacenter.php",
    data: 'getversion=1',
    success: function (response) {
      console.log(response);

      var data1 = response.data1;
      var data2 = response.data2;

      $('#falias').html(data2 + '&nbsp;');
      $('#fversion').html(data1+ '&nbsp;');

    }
  });





  
  
});












