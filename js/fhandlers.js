function displayCurrentTime() {
  var currentTimeElement = document.getElementById("currentTime");
  var currentTime = new Date();

  var options = {
    weekday: 'long', // Display full weekday name
    year: 'numeric',
    month: 'long', // Display full month name
    day: 'numeric',
    hour: 'numeric',
    minute: 'numeric',
    second: 'numeric',
    timeZoneName: 'short' // Display abbreviated timezone name
  };

  // Format the time using Intl.DateTimeFormat
  var formattedTime = new Intl.DateTimeFormat('en-US', options).format(currentTime);
  currentTimeElement.textContent = formattedTime;
}

// Call the function to display the formatted current time
displayCurrentTime();

  // Update the time every second
  setInterval(displayCurrentTime, 1000);


