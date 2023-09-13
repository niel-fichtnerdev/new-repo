$(document).ready(function() {
 // Fetch data from PHP using POST
 $.ajax({
  url: './manage/chartdata.php',
  type: 'POST', // Use POST method
  data: { chartdata: 1 },
  dataType: 'json',
  success: function(data) {
    var monthlySummaryData = data.map(item => parseFloat(item));
    createMonthlySummaryChart(monthlySummaryData);
  },
  error: function(xhr, status, error) {
    console.error(error);
  }
});

$.ajax({
  url: './manage/productchart.php',
  type: 'POST', 
  data: { topproducts: 1 },
  dataType: 'json',
  success: function(data) {
    // Call the function to create the product chart here
    createProductChart(data.productLabels, data.productData);
  }
});

$.ajax({
  url: './manage/datacenter.php',
  type: 'POST',
  data: { currentmonth: 1 },
  success: function(data) {
      var data1 = data.data1;
      var data2 = data.data2;
      var data3 = data.data3;

      var formattedData1 = parseFloat(data1).toLocaleString(undefined, {
          minimumFractionDigits: 2,
          maximumFractionDigits: 2
      });

      var formattedData2 = parseFloat(data2).toLocaleString(undefined, {
        minimumFractionDigits: 2,
        maximumFractionDigits: 2
      });
      formattedData2 = formattedData2.replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,');

      var formattedData3 = parseFloat(data3).toLocaleString(undefined, {
        minimumFractionDigits: 2,
        maximumFractionDigits: 2
      });

      
      $('#currentMonthSales').html(formattedData1);
      $('#presentnrgt').html(formattedData2);
      $('#avesales').html(formattedData3);
  }
});




  // Function to create the monthly summary chart
  function createMonthlySummaryChart(monthlySummaryData) {
    var ctx = $('#myChart');
    var myChart = new Chart(ctx, {
      type: 'bar',
      data: {
        labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
        datasets: [{
          type: 'bar',
          label: 'Monthly Summary by gross',
          data: monthlySummaryData,
          backgroundColor: 'rgba(75, 192, 192, 0.6)',
          borderColor: 'rgba(75, 192, 192, 1)',
          borderWidth: 1
        }]
      },
      options: {
        scales: {
          y: {
            beginAtZero: true
          }
        }
      }
    });
  }

  // Function to create the product chart
  function createProductChart(productLabels, productData) {
    var ctx = $('#myChart2');
    var myChart = new Chart(ctx, {
      type: 'doughnut',
      data: {
        labels: productLabels,
        datasets: [{
          data: productData,
          backgroundColor: ['#FF6384', '#36A2EB', '#FFCE56', '#800080', '#FF4500'],
          borderColor: ['#FF6384', '#36A2EB', '#FFCE56', '#800080', '#FF4500'],
          borderWidth: 1
        }]
      },
      options: {
        plugins: {
          title: {
            display: true,
            text: 'Top 5 products',
            font: {
              size: 16
            }
          },
          legend: {
            position: 'bottom'
          },
          tooltip: {
            callbacks: {
              label: function(context) {
                var label = context.label || '';
                var value = context.parsed || 0;
                return label + ': ' + value;
              }
            }
          }
        }
      }
    });
  }







});
