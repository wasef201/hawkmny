<!DOCTYPE html>
<head>
    <meta charset='UTF-8'>

    <title>  افتتاح منصة حوكمني </title>

    <link rel='stylesheet' href='{{ asset('open_assets/css/style.css') }}'>

    <script src='https://ajax.googleapis.com/ajax/libs/jquery/1.4.4/jquery.min.js'></script>
    <script src='https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.2/jquery-ui.min.js'></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Tajawal&display=swap" rel="stylesheet">
    <script src="{{ asset('open_assets/js/slidetounlock.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/promise-polyfill@8/dist/polyfill.min.js">

    </script>
    <script src="https://cdn.jsdelivr.net/npm/eligrey-classlist-js-polyfill@1.2.20171210/classList.min.js">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/findindex_polyfill_mdn"></script>
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <style>
        body{
            font-family: 'Tajawal', sans-serif;
            height: 100vh;
        }
        .ball_wrap {
            position: relative;
            margin: 50px auto;
            width: 90%;
        }

        .green_ball {
            background: #00C762;
            height: 150px;
            width: 150px;
            border-radius: 50%;
            border: 3px solid #ccc;
            position: absolute;
        }


        .green_ball p {
            padding-top: 43%;
            padding-left: 8px;
            text-align: center;

        }

        .blue_ball {
            /*background: white;*/
            height: auto;
            width: auto;
            border-radius: 50%;
            display: inline-block;
            padding-top: 25px;
            /*border: 3px solid #ccc;*/
        }

        .ball_wrap div:nth-of-type(2) {
            top: 20px;
            left: -191px;

        }
        .ball_wrap div:nth-of-type(3) {
            top: 20px;
            right: -248px;
        }
        .ball_wrap div:nth-of-type(4) {
            right: 156px;
            bottom: -189px;
        }

        #chart1 {
            display: block;
            margin: auto;
        }

        #chart2 {
            display:  inline-block;
            vertical-align: middle;
            margin: 0 12px;
        }

        #chart3 {
            display:  inline-block;
            vertical-align: middle;
            margin: 0 12px;
        }
        .container {
            direction: rtl;
            text-align: center;
        }
        #page-wrap{
            height: 100%;
        }
    </style>

    <script>
// #1CA68B
       $(document).ready(function() {
        var options = {
          series: [40],
          chart: {
              height: 350,
              type: 'radialBar',
              fontFamily: "inherit",
          },
          plotOptions: {
              radialBar: {
                hollow: {
                  size: '70%',
              }
          },
      },
      labels: ['معيار الامتثال والالتزام'],
            colors: ['#1CA08C'],

  };

  var chart = new ApexCharts(document.querySelector("#chart1"), options);
  chart.render();



  var options2 = {
      series: [20],
      chart: {
          height: 350,
          type: 'radialBar',
          fontFamily: "inherit",
      },
      plotOptions: {
          radialBar: {
            hollow: {
              size: '70%',
          }
      },
  },
  labels: ['معيار الشفافية والإفصاح'],
      colors: ['#1CA08C'],
};

var chart2 = new ApexCharts(document.querySelector("#chart2"), options2);
chart2.render();




var options3 = {
  series: [40],
  chart: {
      height: 350,
      type: 'radialBar',
      fontFamily: "inherit",
  },
  plotOptions: {
      radialBar: {
        hollow: {
          size: '70%',
      }
  },
},
labels: ['معيار السلامه المالى'],
    colors: ['#1CA08C'],
};

var chart3 = new ApexCharts(document.querySelector("#chart3"), options3);
chart3.render();
});


</script>


</head>

<body>

    <div id="page-wrap">
        <div id="well_cont" style="height: 100%; display: grid; place-items: center">
            <div id="well">
                <h2>
                    <strong id="slider"></strong>
                    <span>  أطلق حوكمني </span>
                </h2>

            </div>
        </div>




        <div class="ball_wrap" style='display:none;'  >


            <div id="chart1"></div>

            <div class="container" >
                <div id="chart2"></div>
                <div class="blue_ball">
                    <img src="{{ asset('/images/logo.png') }}" alt="">
                </div>
                <div id="chart3"></div>
            </div>


        </div>



    </div>




</body>


</html>
