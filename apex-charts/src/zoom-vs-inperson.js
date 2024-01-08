var options = {
    series: [
    	{ name: "In Person Attendance",
    	  data: [13, 19, 0]
    	}, 
    	{
    	name: "Total Zoom Attendance",
    	data: [84, 192, 146]
    	},
    	{
    	name: "Allen Co. Zoom Attendance",
    	data: [9, 19, 23]
    	},
      ],
      chart: {
      type: 'bar',
      height: 550,
      width:  700
    },
    plotOptions: {
      bar: {
        horizontal: false,
        columnWidth: '55%',
        endingShape: 'rounded'
      },
    },
    dataLabels: {
      enabled: false
    },
    stroke: {
      show: true,
      width: 2,
      colors: ['transparent']
    },
    xaxis: {
      categories: ['Oct', 'Nov', 'Dec'],
    },
    yaxis: {
      title: {
        text: 'In-person vs. Zoom'
      }
    },
    fill: {
      opacity: 1
    },
    tooltip: {
      y: {
        formatter: function (val) {
          return "$ " + val + " thousands"
        }
      }
    }
  }; // end options

  var chart = new ApexCharts(document.querySelector("#chart2"), options);
  chart.render();
