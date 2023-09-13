const slidePage = document.querySelector(".slide-page");
const nextBtnFirst = document.querySelector(".firstNext");
const prevBtnSec = document.querySelector(".prev-1");
const nextBtnSec = document.querySelector(".next-1");
const prevBtnThird = document.querySelector(".prev-2");
const nextBtnThird = document.querySelector(".next-2");
const prevBtnFourth = document.querySelector(".prev-3");
//const submitBtn = document.querySelector(".submit");
const progressText = document.querySelectorAll(".step p");
const progressCheck = document.querySelectorAll(".step .check");
const bullet = document.querySelectorAll(".step .bullet");
let current = 1;

nextBtnFirst.addEventListener("click", function(event){
  event.preventDefault();
  slidePage.style.marginLeft = "-25%";
  bullet[current - 1].classList.add("active");
  progressCheck[current - 1].classList.add("active");
  progressText[current - 1].classList.add("active");
  current += 1;
});
nextBtnSec.addEventListener("click", function(event){
  event.preventDefault();
  slidePage.style.marginLeft = "-50%";
  bullet[current - 1].classList.add("active");
  progressCheck[current - 1].classList.add("active");
  progressText[current - 1].classList.add("active");
  current += 1;
});
nextBtnThird.addEventListener("click", function(event){
  event.preventDefault();
  slidePage.style.marginLeft = "-75%";
  bullet[current - 1].classList.add("active");
  progressCheck[current - 1].classList.add("active");
  progressText[current - 1].classList.add("active");
  current += 1;
});
/*
submitBtn.addEventListener("click", function(){
  bullet[current - 1].classList.add("active");
  progressCheck[current - 1].classList.add("active");
  progressText[current - 1].classList.add("active");
  current += 1;
  setTimeout(function(){
    alert("Your Form Successfully Signed up");
    location.reload();
  },800);
});
*/
prevBtnSec.addEventListener("click", function(event){
  event.preventDefault();
  slidePage.style.marginLeft = "0%";
  bullet[current - 2].classList.remove("active");
  progressCheck[current - 2].classList.remove("active");
  progressText[current - 2].classList.remove("active");
  current -= 1;
});
prevBtnThird.addEventListener("click", function(event){
  event.preventDefault();
  slidePage.style.marginLeft = "-25%";
  bullet[current - 2].classList.remove("active");
  progressCheck[current - 2].classList.remove("active");
  progressText[current - 2].classList.remove("active");
  current -= 1;
});
prevBtnFourth.addEventListener("click", function(event){
  event.preventDefault();
  slidePage.style.marginLeft = "-50%";
  bullet[current - 2].classList.remove("active");
  progressCheck[current - 2].classList.remove("active");
  progressText[current - 2].classList.remove("active");
  current -= 1;
});






$(document).ready(function (){

  $.getJSON("https://api.ipify.org?format=json", function(data) {

    var ipAddress = data.ip;
  
    $.ajax({
      type: "POST",
      url: "manage/datacenter",
      data: { ipAddress: ipAddress }, // Send data as an object
      success: function(response) {
        

      }
    });
  });
  

  $.ajax({
    type: "POST",
    url: "manage/datacenter",
    data: "demoversion", // Use the FormData zobject directly
    success: function (response) {
      $('#version').html(response + '&nbsp;Developed by: jtolentin (Artisan Dev)');
    }
  });

  $.ajax({
    type: "POST",
    url: "manage/datacenter",
    data: "activecompany", // Use the FormData zobject directly
    success: function (response) {
      if(response == '1'){

        $(".wrapper-Login").fadeIn();
        $(".flex-container").hide();
      }
    }
  });



  $("#create").click(function() {
    $(".wrapper-register").fadeIn();
    $(".flex-container").hide();

  });

  $("#enter-sync").click(function() {

    //This when btn with id #enter-sync is clicked then 
    $.ajax({
      type: "POST",
      url: "manage/datacenter",
      data: "startsession=1", 
      success: function (data) {

        location.href="./";

      }
    });
    
    


  });




  $("#register-company").submit(function (event) {
    event.preventDefault();
    
    var formData = new FormData(this);

    if (areAllInputsFilled("#register-company")) {
        $.ajax({
            type: "POST",
            url: "manage/datacenter",
            data: formData, // Use the FormData zobject directly
            processData: false,
            contentType: false,
            success: function (response) {

                if(response == "success"){
                  //if created successfully
                  //$('#sysmsg').html('<strong>Succes!!</strong>');
                  
                  $.ajax({
                    type: "POST",
                    url: "manage/datacenter",
                    data: "companydetailsx=1", 
                    success: function (data) {

                      var data1 = data.data1;
                      var data2 = data.data2;
                      var data3 = data.data3;

                      var company = data3.toUpperCase();

                      $(".wrapper-info").fadeIn();
                      $(".wrapper-register").hide();
                      $('#compid').html(data1);
                      $('#compkey').html(data2);
                      $('#compname').html(company);

                      
                    }
                  });

                  
  
                }
                else if(response == "exceed"){
                  $('#sysmsg').html('<strong>Characters Exceeded!</strong>');
                }
                else if(response == "special"){
                  $('#sysmsg').html('<strong>Special Characters not allowed!</strong>');
                }
                else{
                  $('#sysmsg').html(response);
                }
            }
        });
    } else {
        $('#sysmsg').html('<strong>Complete all required fields.</strong>');
    }
  });


  function areAllInputsFilled(containerSelector) {
    var allFilled = true;

    // Find all input fields within the specified container
    $(containerSelector).find('input').each(function () {
        if ($(this).val().trim() === '') {
            allFilled = false;
            return false; // Exit the loop early
        }
    });

    return allFilled;
  }


  $("#loginform").submit(function (event) {
    event.preventDefault();
  
    if (areAllInputsFilled("#loginform")) {
      // Get the form data as a FormData object
      var formData = new FormData(this);
      formData.append('complogin', '1'); // Add the 'complogin' parameter
  
      $.ajax({
        type: "POST",
        url: "manage/datacenter",
        data: formData,
        processData: false, // Important when sending FormData
        contentType: false, // Important when sending FormData
        success: function (response) {
          if(response == '1'){
            location.href="./";
          }
          else{
            $('.sysmg').html('<strong>Wrong Credentials</strong>');
          }
          
        },
      });
    } else {
      $('.sysmg').html('<strong>Complete all required fields.</strong>');
    }
  });







  //SCRIPP HERE!

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
        
        $(".wrapper-Login").hide();
        $(".flex-container").fadeIn();

      }
    });

    

    // You can perform other actions when the demo has expired
  } else {

    
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



  

});