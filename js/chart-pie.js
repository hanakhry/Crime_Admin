// Set new default font family and font color to mimic Bootstrap's default styling
Chart.defaults.global.defaultFontFamily = '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
Chart.defaults.global.defaultFontColor = '#292b2c';

// Pie Chart Example
var ctx = document.getElementById("myPieChart");
var myPieChart = new Chart(ctx, {
  type: 'pie',
  data: {
    labels: ["Physical Violence", "Gun Assault", "Knife Assault"],
    datasets: [{
      data: [319, 6014, 767, 232],
      backgroundColor: ['#007bff','#ffc107', '#28a745'],
    }],
  },
});
