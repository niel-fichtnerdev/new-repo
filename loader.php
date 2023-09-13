
<div id="loader_main">

    <div class="ground">

    </div>


    <div class="center">
        <div class="wave"></div>
        <div class="wave"></div>
        <div class="wave"></div>
        <div class="wave"></div>
        <div class="wave"></div>
        <div class="wave"></div>
        <div class="wave"></div>
        <div class="wave"></div>
        <div class="wave"></div>
        <div class="wave"></div>
    </div>    
</div>


<script type="text/javascript">
    $(window).on("load", function() {
    var loader = $("#loader_main");
    loader.hide();
    });

</script>

<!--
// script.js
window.addEventListener("load", function() {
  var loader = document.getElementById("loader");
  loader.style.display = "none";
});

function showLoader() {
  var loader = document.getElementById("loader");
  loader.style.display = "block";
}

function hideLoader() {
  var loader = document.getElementById("loader");
  loader.style.display = "none";
}

// Listen for AJAX request start and end events
document.addEventListener("ajaxStart", showLoader);
document.addEventListener("ajaxStop", hideLoader);

// Listen for fetch API request start and end events
document.addEventListener("fetchStart", showLoader);
document.addEventListener("fetchEnd", hideLoader);

// Example usage of AJAX request
$.ajax({
  url: "your-api-endpoint",
  method: "GET",
  success: function(data) {
    // Handle the response
  }
});

// Example usage of fetch API
fetch("your-api-endpoint")
  .then(function(response) {
    return response.json();
  })
  .then(function(data) {
    // Handle the response
  });


-->