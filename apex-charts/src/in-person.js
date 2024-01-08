var options = {
    series: [
    	{ name: "2018-2019 Season",
    	  data: [62, 54, 52, 51, 25, 32, 45, 51, 49]
    	}, 
    	{
    	name: "2019-2020 Season",
    	data: [58, 27, 30, 32, 70, 36, 32, 0, 0]
    	},
    	{
    	name: "2022-2023 Season",
    	data: [27, 21, 10, 13, 10, 14, 13, 12, 13] 
    	},
    	{
    	name: "2023-2024 Season",
    	data: [16, 13, 19]
    	}
      ],
      chart: {
      type: 'bar',
      height: 550
      //height: 350
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
      categories: ['Sep', 'Oct', 'Nov', 'Dec', 'Jan', 'Feb', 'Mar', 'Apr', 'May' ],
    },
    yaxis: {
      title: {
        text: 'In Person Attendance'
      }
    },
    fill: {
      opacity: 1
    },
    tooltip: {
      y: {
        formatter: function (val) {
          //return "$ " + val + " thousands"
          return val + " individuals present"
        }
      }
    }
  }; // end options

  var chart = new ApexCharts(document.querySelector("#chart1"), options);
  chart.render();
