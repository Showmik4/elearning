@extends('layouts.main')
@section('header.css')
    <style>
        /* .order-card {
            color: #fff;
        }

        .bg-c-blue {
            background: linear-gradient(45deg, #4099ff, #73b4ff);
        }

        .bg-c-green {
            background: linear-gradient(45deg, #2ed8b6, #59e0c5);
        }

        .bg-c-yellow {
            background: linear-gradient(45deg, #FFB64D, #ffcb80);
        }

        .bg-c-pink {
            background: linear-gradient(45deg, #FF5370, #ff869a);
        }


        .card {
            border-radius: 5px;
            -webkit-box-shadow: 0 1px 2.94px 0.06px rgba(4, 26, 55, 0.16);
            box-shadow: 0 1px 2.94px 0.06px rgba(4, 26, 55, 0.16);
            border: none;
            margin-bottom: 30px;
            -webkit-transition: all 0.3s ease-in-out;
            transition: all 0.3s ease-in-out;
        }

        .card .card-block {
            padding: 25px;
        }

        .order-card i {
            font-size: 26px;
        }

        .f-left {
            float: left;
        }

        .f-right {
            float: right;
        } */
        /* #barchart_material, #barchart_material1, #barchart_material2, #barchart_material3 {
            max-width: 100%;
            height: 300px;
        } */
    </style>
@endsection
@section('main.content')
    <div class="page-body">
        <div class="container-fluid">
            <div class="page-title">
                <div class="row">
                    <div class="col-6">
                        <h3>Dashboard</h3>
                    </div>
                    <div class="col-6">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('index') }}"><i data-feather="home"></i></a></li>
                            <li class="breadcrumb-item active">Dashboard</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <!-- Container-fluid starts-->
        <div class="container-fluid">
            <div class="row second-chart-list third-news-update">
                {{-- <div class="col-lg-6 col-md-12 col-sm-12 chart_data_left"> --}}
                    <div class="col-lg-6 col-md-12 col-sm-12 mb-4" id="barchart_material"></div>
                {{-- </div> --}}
                {{-- <div class="col-lg-6 col-md-12 col-sm-12 chart_data_left"> --}}
                    <div class="col-lg-6 col-md-12 col-sm-12 mb-4" id="barchart_material1"></div>
                {{-- </div> --}}
                {{-- <div class="col-lg-6 col-md-12 col-sm-12 chart_data_left"> --}}
                    <div class="col-lg-6 col-md-12 col-sm-12 mb-4" id="barchart_material2"></div>
                {{-- </div> --}}
                {{-- <div class="col-lg-6 col-md-12 col-sm-12 chart_data_left"> --}}
                    <div class="col-lg-6 col-md-12 col-sm-12 mb-4" id="barchart_material3"></div>
                {{-- </div> --}}
            </div>
        </div>
        
        
    </div>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
        google.charts.load('current', {'packages': ['bar']});
    
        google.charts.setOnLoadCallback(drawChart);
    
        function drawChart() {          
            var data = google.visualization.arrayToDataTable(@json($chartDataForOrganization));
    
            var options = {
                chart: {
                    title: 'Organization & Culture KPIs',
                    subtitle: 'Total Completed vs. Total Target',
                },
                bars: 'vertical', 
                vAxis: { format: 'decimal' },
                height: 500,
                colors: ['#1b9e77', '#d95f02'], 
            };
    
            var chart = new google.charts.Bar(document.getElementById('barchart_material'));
    
            chart.draw(data, google.charts.Bar.convertOptions(options));
        }
    </script>

    <script type="text/javascript">
        google.charts.load('current', {'packages': ['bar']});

        google.charts.setOnLoadCallback(drawChart);

        function drawChart() {          
            var data = google.visualization.arrayToDataTable(@json($chartDataForCDD));

            var options = {
                chart: {
                    title: 'CDD KPIs',
                    subtitle: 'Total Completed vs. Total Target',
                },
                bars: 'vertical', 
                vAxis: { format: 'decimal' },
                height: 500,
                colors: ['#1b9e77', '#d95f02'], 
            };

            var chart = new google.charts.Bar(document.getElementById('barchart_material1'));

            chart.draw(data, google.charts.Bar.convertOptions(options));
        }
    </script>

    <script type="text/javascript">
        google.charts.load('current', {'packages': ['bar']});

        google.charts.setOnLoadCallback(drawChart);

        function drawChart() {          
            var data = google.visualization.arrayToDataTable(@json($chartDataForEDD));

            var options = {
                chart: {
                    title: 'EDD KPIs',
                    subtitle: 'Total Completed vs. Total Target',
                },
                bars: 'vertical', 
                vAxis: { format: 'decimal' },
                height: 500,
                colors: ['#1b9e77', '#d95f02'], 
            };

            var chart = new google.charts.Bar(document.getElementById('barchart_material2'));

            chart.draw(data, google.charts.Bar.convertOptions(options));
        }
    </script>  

    <script type="text/javascript">
        google.charts.load('current', {'packages': ['bar']});

        google.charts.setOnLoadCallback(drawChart);

        function drawChart() {          
            var data = google.visualization.arrayToDataTable(@json($chartDataForCB));

            var options = {
                chart: {
                    title: 'CB KPIs',
                    subtitle: 'Total Completed vs. Total Target',
                },
                bars: 'vertical', 
                vAxis: { format: 'decimal' },
                height: 500,
                colors: ['#1b9e77', '#d95f02'], 
            };

            var chart = new google.charts.Bar(document.getElementById('barchart_material3'));

            chart.draw(data, google.charts.Bar.convertOptions(options));
        }
    </script> 
       


    {{-- Old --}}
    {{-- <script>
    var xValues = @json($chartDataForCB['xValues']);
        var yValues = @json($chartDataForCB['yValues']);
      
        var barColors = xValues.map((_, index) => {
            const colors = ["red", "green", "blue", "orange", "brown","DeepPink","OrangeRed","Yellow","Magenta"];
            return colors[index % colors.length]; 
        });
      
        new Chart("myChart3", {
            type: "bar",
            data: {
                labels: xValues,
                datasets: [{
                    backgroundColor: barColors,
                    data: yValues 
                }]
            },
            options: {
                legend: { display: false },
                title: {
                    display: true,
                    text: "Team-wise Completed KPIs In CB"
                },
                scales: {
                    y: {
                        beginAtZero: true 
                    }
                }
            }
        });
    </script> --}}
@endsection