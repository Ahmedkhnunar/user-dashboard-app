
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="Content-Language" content="en">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Analytics Dashboard - This is an example dashboard created using build-in elements and components.</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, shrink-to-fit=no" />
    <meta name="description" content="This is an example dashboard created using build-in elements and components.">
    <meta name="msapplication-tap-highlight" content="no">
    <style type="text/css">
        #profileImage {
          width: 40px;
          height: 40px;
          border-radius: 50%;
          background: #512DA8;
          font-size: 35px;
          color: #fff;
          text-align: center;
          line-height: 40px;
        }
    </style>
<link href="{{ asset('css/main.css') }}" rel="stylesheet"></head>
<body>
    <div class="app-container app-theme-white body-tabs-shadow fixed-sidebar fixed-header closed-sidebar">
        <div class="app-header header-shadow">
            <div class="app-header__logo">
                <div class="logo-src"></div>
                <div class="header__pane ml-auto">
                    <div>
                        <button type="button" class="hamburger close-sidebar-btn hamburger--elastic" data-class="closed-sidebar">
                            <span class="hamburger-box">
                                <span class="hamburger-inner"></span>
                            </span>
                        </button>
                    </div>
                </div>
            </div>
            <div class="app-header__mobile-menu">
                <div>
                    <button type="button" class="hamburger hamburger--elastic mobile-toggle-nav">
                        <span class="hamburger-box">
                            <span class="hamburger-inner"></span>
                        </span>
                    </button>
                </div>
            </div>
            <div class="app-header__menu">
                <span>
                    <button type="button" class="btn-icon btn-icon-only btn btn-primary btn-sm mobile-toggle-header-nav">
                        <span class="btn-icon-wrapper">
                            <i class="fa fa-ellipsis-v fa-w-6"></i>
                        </span>
                    </button>
                </span>
            </div>    
            <div class="app-header__content">
                <div class="app-header-left">
                    <ul class="header-menu nav">
                        <li class="nav-item">
                            <a href="?sortby=name" class="nav-link">
                                Sort By Name
                            </a>
                        </li>
                        <li class="btn-group nav-item">
                            <a href="?sortby=impression" class="nav-link">
                                Sort By Impression
                            </a>
                        </li>

                        <li class="btn-group nav-item">
                            <a href="?sortby=conversion" class="nav-link">
                                Sort By Conversion
                            </a>
                        </li>
                        <li class="btn-group nav-item">
                            <a href="?sortby=revenue" class="nav-link">
                                Sort By Revenue
                            </a>
                        </li>
                    </ul> 
                </div>
                <div class="app-header-right">
                    <div class="search-wrapper active">
                        <div class="input-holder">
                            <input type="text" class="search-input" placeholder="Type to search">
                            <button class="search-icon"><span></span></button>
                        </div>
                        <button class="close d-none"></button>
                    </div>      
                </div>
            </div>
        </div>        
        <div class="app-main">
                <div class="app-main__outer" style="padding-left: 0px !important">
                    <div class="app-main__inner">
                        
                        <div class="row">

                            @foreach ($users as $user)
                                <div class="col-md-6 col-xl-4">
                                    <div class="card mb-3 widget-content">
                                        <div class="widget-content-outer">
                                            <div class="widget-content-wrapper">
                                                <div class="widget-content-left">

                                                    <div class="row">
                                                        <div class="col-md-2">
                                                            @if($user['avatar'])
                                                                <img class="rounded-circle" style="height: 40px;" src="{{$user['avatar']}}" onerror='this.onerror=null;this.src="{{ asset("avatar/photo.png") }}"'> 
                                                            @else                 
                                                                <div id="profileImage">{{$user['name'][0]}}</div>
                                                            @endif

                                                        </div>
                                                        <div class="col-md-9">
                                                            <div class="widget-heading">{{$user['name']}}</div>
                                                            <div class="widget-subheading">{{$user['occupation']}}</div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="ml-3">
                                                            <canvas class="chart" id="{{uniqid();}}" time="{{json_encode($user['timelogs'])}}" revenue="{{json_encode($user['revenuelogs'])}}"></canvas>
                                                        </div>
                                                    </div>
                                                        
                                                    <div class="row">
                                                        <div class="widget-heading ml-3">Conversions {{$user['duration']}} </div>
                                                    </div>
                                                </div>
                                                <div class="widget-content-left ml-3">
                                                    <div class="widget-numbers text-success"></div>
                                                    <div class="widget-numbers text-success"></div>

                                                    <div class="widget-heading" style="font-size: 12px;">{{$user['impression']}}</div>
                                                    <div class="widget-subheading" style="font-size: 10px;">Impression</div>
                                                    <div class="widget-heading" style="font-size: 12px;">{{$user['conversion']}}</div>
                                                    <div class="widget-subheading" style="font-size: 10px;">Conversions</div>
                                                    <div class="widget-heading" style="font-size: 12px;">${{$user['revenue']}}</div>
                                                    <div class="widget-subheading" style="font-size: 10px;">revenu</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                    </div>    
                </div>
        </div>
    </div>
    <script type="text/javascript" src=" {{ asset('js/main.js') }} "></script>
    <script type="text/javascript" src=" {{ asset('js/echarts.min.js') }} "></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
</body>

<script type="text/javascript">

    


document.addEventListener("DOMContentLoaded", function(event) { 
  document.querySelectorAll('.chart').forEach(function(chartDom) {
        renderChart(chartDom)
    });
});


function renderChart(chartDom)
{
    var myChart = echarts.init(chartDom);
    var option;

    option = {
        animationDuration: 750,
        color:"#5470c6",
        gradientColor : "green",
        grid: {
                show: false,
                z:0,
                left: 0,
                right: 10,
                top: 15,
                bottom: 5,
                containLabel: false,
                backgroundColor:"rgba(0,0,0,0)",
                borderWith:1,
                borderColor:"ccc"
            },

      xAxis: {
        type: 'category',
        boundaryGap: false,
        data: JSON.parse(chartDom.getAttribute('time'))
      },
      yAxis: {
        type: 'value'
      },
      series: [
        {
          data: JSON.parse(chartDom.getAttribute('revenue')),
          type: 'line',
          areaStyle: {}
        }
      ]
    };

    option && myChart.setOption(option);
}   

</script>

</html>
