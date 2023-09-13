
$(document).ready(function (){

  $.ajax({
    type: "POST",
    url: "./appserv/dataprocessor.php",
    data: 'companyname=1',
    success: function (response) {
      $("#companyname").html(response);
    }
  });

  $(".gallery-img").click(function () { //function for selecting products
    var product = $(this).data("product");

      $.ajax({
        type: "POST",
        url: "./appserv/dataprocessor.php",
        data: 'addproduct='+product,
        success: function (response) {
          if(response){
            location.reload();
          }
          else{
            location.reload();
          }
        }
    });

  });

  $(".product-list").click(function () { //function for removing products from list
    var products = $(this).data("fproducts");
  
    $.ajax({
      type: "POST",
      url: "./appserv/dataprocessor.php",
      data: 'removeproduct='+products,
      success: function (response) {
        if(response){
          location.reload();
        }
        else{
          //location.reload();
        }
      }
    });
  
  });

  $('.quantity-input').on('keyup', function() {
    var inputValue = $(this).val();
    var productId = $(this).data('productid'); // Get the product ID from data attribute
    
    $.ajax({
      type: "POST",
      url: "./appserv/dataprocessor.php",
      data: {
        quantity: inputValue,
        productid: productId // Include product ID in the data sent to the server
      },
      success: function(response) {
        setTimeout(function() {
          location.reload();
        }, 2000);
      
      }
    });
    
  });
  
  

  $("#logout").click(function () { //function for Logout
    $.ajax({
      type: "POST",
      url: "./appserv/dataprocessor.php",
      data: 'logout=1',
      success: function(response) {
        location.href="login";
      }
    });
  });

  $("#profile").click(function () { //function for Profile
    alert("Profile!");
  });

 

  $("#settle").click(function () { //function for Settled
    
    $.ajax({
      type: "POST",
      url: "./appserv/dataprocessor.php",
      data: 'settle=1',
      success: function(response) {
        
        if(response == 0){
          alert('There is no product selected!');
        }
        else{
          location.reload();
        }
      }
    });


  });

  $("#void").click(function () { //function for Voiding products

    $.ajax({
      type: "POST",
      url: "./appserv/dataprocessor.php",
      data: 'voidtrx=1',
      success: function(response) {
        location.reload();
      }
    });

  });

  $(".category-label").click(function () { //function for Selecting categories
    var category = $(this).data("category");

   // Get the current URL
   var currentUrl = window.location.href;

   // Check if the category query parameter already exists in the URL
   if (currentUrl.indexOf('category=') === -1) {
       // Check if the current URL already contains query parameters
       var separator = currentUrl.indexOf('?') !== -1 ? '&' : '?';

       // Construct the new URL with the category ID as a query parameter
       var newUrl = currentUrl + separator + "category=" + category;

       // Change the URL of the page
       window.location.href = newUrl;
   } else {
       // Category query parameter already exists, update it instead
       var updatedUrl = currentUrl.replace(/category=[^&]*/, "category=" + category);

       // Change the URL of the page
       window.location.href = updatedUrl;
   }

  });

  $.ajax({
    type: "POST",
    url: "./appserv/dataprocessor.php",
    datatype: 'json',
    data: 'fetchsummary=1',
    success: function (response) {
      // Process the response data
      var data1 = response.data1;
      var data2 = response.data2;
      var data3 = response.data3;
      var data4 = response.data4;

      var formattedData1 = parseFloat(data1).toLocaleString(undefined, {
        minimumFractionDigits: 2,
        maximumFractionDigits: 2
      });

      var formattedData2 = parseFloat(data2).toLocaleString(undefined, {
        minimumFractionDigits: 2,
        maximumFractionDigits: 2
      });

      var formattedData3 = parseFloat(data3).toLocaleString(undefined, {
        minimumFractionDigits: 2,
        maximumFractionDigits: 2
      });

      var formattedData4 = parseFloat(data4).toLocaleString(undefined, {
        minimumFractionDigits: 2,
        maximumFractionDigits: 2
      });

      $("#fdiscount").html(formattedData1);
      $("#fsubtotal").html(formattedData4);
      $("#ftax").html(formattedData3);
      $("#ftotal").html(formattedData4);
      $("#totalcost").html('P'+ formattedData4);


    }
  });

  $("#zreading").click(function () { //function for z-reading
  
    $.ajax({
      type: "POST",
      url: "./appserv/dataprocessor.php",
      data: 'zread=1',
      success: function (response) {
        location.reload();
      }
    });


  
  });



  



});
