<?php
include "db_connect.php";
$customer = mysqli_fetch_array(mysqli_query($connection, "SELECT COUNT(*) FROM customer"));
$supplier = mysqli_fetch_array(mysqli_query($connection, "SELECT COUNT(*) FROM supplier"));
$inventory = mysqli_fetch_array(mysqli_query($connection, "SELECT COUNT(*) FROM inventory"));
$item = mysqli_fetch_array(mysqli_query($connection, "SELECT COUNT(*) FROM purchase"));
$sales = mysqli_fetch_array(mysqli_query($connection, "SELECT COUNT(*) FROM purchase"));
$payment = mysqli_fetch_array(mysqli_query($connection, "SELECT COUNT(*) FROM purchase"));

//  replace this key from  fixer.io after getting  a free API access key:

$API = '01aa159043da43768545109c0d93a2bc';

function convertCurrency($API, $amount, $from = 'EUR', $to = 'AFN'){
$curl = file_get_contents("http://data.fixer.io/api/latest?access_key=$API&symbols=$from,$to");

if($curl)
{
    $arr = json_decode($curl,true);
    if($arr['success'])
    {
        $from = $arr['rates'][$from];
        $to = $arr['rates'][$to];

        $rate = $to / $from;
        $result = round($amount * $rate, 6);
        return $result;
    }else{
        echo $arr['error']['info'];
    }
}else{
    echo "Error reaching api";
}
}



?>


<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="fontiran.com:license" content="Y68A9">
    <link rel="icon" href="../build/images/favicon.ico" type="image/ico"/>
    <title>گلوبل اکسپرت </title>

    <!-- Bootstrap -->
    <link href="../vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="../vendors/bootstrap-rtl/dist/css/bootstrap-rtl.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="../vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="../vendors/nprogress/nprogress.css" rel="stylesheet">
    <!-- bootstrap-progressbar -->
    <link href="../vendors/bootstrap-progressbar/css/bootstrap-progressbar-3.3.4.min.css" rel="stylesheet">
    <!-- iCheck -->
    <link href="../vendors/iCheck/skins/flat/green.css" rel="stylesheet">
    <!-- bootstrap-daterangepicker -->
    <link href="../vendors/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">
    
    <!-- Custom Theme Style -->
    <link href="../build/css/custom.min.css" rel="stylesheet">
</head>
<!-- /header content -->
<body class="nav-md .">
<div class="container body">
    <div class="main_container">
        <div class="col-md-3 left_col hidden-print">
            <div class="left_col scroll-view">
                <div class="navbar nav_title" style="border: 0;">
                    <a href="index.php" class="site_title"><i class="fa fa-paw"></i> <span>گلوبل اکسپرت</span></a>
                </div>

                <div class="clearfix"></div>

                <!-- menu profile quick info -->
                <div class="profile clearfix">
                    <div class="profile_pic">
                        <img src="../build/images/img.jpg" alt="..." class="img-circle profile_img">
                    </div>
                    <div class="profile_info">
                        <span>خوش آمدید,</span>
                        <h2>سام سامی</h2>
                    </div>
                </div>
                <!-- /menu profile quick info -->

                <br/>

                <!-- sidebar menu -->
                <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
                    <div class="menu_section">
                        <h3>عمومی</h3>
                        <ul class="nav side-menu">
                            <li><a><i class="fa fa-home"></i> عملیات سیستم <span class="fa fa-chevron-down"></span></a>
                            <ul class="nav child_menu">
                                    <li><a href="customer.php">مشتری</a></li>
                                    <li><a href="supplier.php">تهیه کننده</a></li>
                                    <li><a href="inventory.php">گدام</a></li>
                                    <li><a href="inven_item_list.php">لست اجناس</a></li>
                                    <li><a href="purchase_insert.php">خریداری</a></li>
                                    <li><a href="transaction.php">معاملات</a></li>
                            </ul>

                            </li>
                            <li><a><i class="fa fa-home"></i> عملیات محاسباتی <span class="fa fa-chevron-down"></span></a>
                            <ul class="nav child_menu">
                                    <li><a href="barcode.php">بارکود</a></li>
                                    <li><a href="#">کوتیشن</a></li>
                                    <li><a href="#">صورت حساب</a></li>
                                    <li><a href="#">پرداخت</a></li>
                                </ul>
                                
                            </li>
                            <li><a><i class="fa fa-home"></i> راپور ها <span class="fa fa-chevron-down"></span></a>
                            <ul class="nav child_menu">
                                    <li><a href="#">مشتری</a></li>
                                    <li><a href="#">تهیه کننده</a></li>
                                    <li><a href="#">گدام</a></li>
                                    <li><a href="#">فروشات</a></li>
                                    <li><a href="#">خریداری</a></li>
                                    <li><a href="#">پرداخت</a></li>
                                </ul>
                     
                        </ul>
                    </div>

                </div>
                <!-- /sidebar menu -->

                <!-- /menu footer buttons -->
                <div class="sidebar-footer hidden-small">
                    <a data-toggle="tooltip" data-placement="top" title="تنظیمات">
                        <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
                    </a>
                    <a data-toggle="tooltip" data-placement="top" title="تمام صفحه" onclick="toggleFullScreen();">
                        <span class="glyphicon glyphicon-fullscreen" aria-hidden="true"></span>
                    </a>
                    <a data-toggle="tooltip" data-placement="top" title="قفل" class="lock_btn">
                        <span class="glyphicon glyphicon-eye-close" aria-hidden="true"></span>
                    </a>
                    <a data-toggle="tooltip" data-placement="top" title="خروج" href="login.php">
                        <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
                    </a>
                </div>
                <!-- /menu footer buttons -->
            </div>
        </div>

        <!-- top navigation -->
        <div class="top_nav hidden-print">
            <div class="nav_menu">
                <nav>
                    <div class="nav toggle">
                        <a id="menu_toggle"><i class="fa fa-bars"></i></a>
                    </div>

                    <ul class="nav navbar-nav navbar-right">
                        <li class="">
                            <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown"
                               aria-expanded="false">
                                <img src="../build/images/img.jpg" alt="">سام سامی
                                <span class=" fa fa-angle-down"></span>
                            </a>
                            <ul class="dropdown-menu dropdown-usermenu pull-right">
                                <li><a href="javascript:;">نمایه</a></li>
                                <li>
                                    <a href="javascript:;">
                                        <span class="badge bg-red pull-right">50%</span>
                                        <span>تنظیمات</span>
                                    </a>
                                </li>
                                <li><a href="javascript:;">کمک</a></li>
                                <li><a href="login.php"><i class="fa fa-sign-out pull-right"></i> خروج</a></li>
                            </ul>
                        </li>

                        <li role="presentation" class="dropdown">
                            <a href="javascript:;" class="dropdown-toggle info-number" data-toggle="dropdown"
                               aria-expanded="false">
                                <i class="fa fa-envelope-o"></i>
                                <span class="badge bg-green">6</span>
                            </a>
                            <ul id="menu1" class="dropdown-menu list-unstyled msg_list" role="menu">
                                <li>
                                    <a>
                                        <span class="image"><img src="../build/images/img.jpg"
                                                                 alt="Profile Image"/></span>
                                        <span>
                          <span>سام سامی</span>
                          <span class="time">3 دقیقه پیش</span>
                        </span>
                                        <span class="message">
                          فیلمای فستیوال فیلمایی که اجرا شده یا راجع به لحظات مرده ایه که فیلمسازا میسازن. آنها جایی بودند که....
                        </span>
                                    </a>
                                </li>
                                <li>
                                    <a>
                                        <span class="image"><img src="../build/images/img.jpg"
                                                                 alt="Profile Image"/></span>
                                        <span>
                          <span>سام سامی</span>
                          <span class="time">3 دقیقه پیش</span>
                        </span>
                                        <span class="message">
                          فیلمای فستیوال فیلمایی که اجرا شده یا راجع به لحظات مرده ایه که فیلمسازا میسازن. آنها جایی بودند که....
                        </span>
                                    </a>
                                </li>
                                <li>
                                    <a>
                                        <span class="image"><img src="../build/images/img.jpg"
                                                                 alt="Profile Image"/></span>
                                        <span>
                          <span>سام سامی</span>
                          <span class="time">3 دقیقه پیش</span>
                        </span>
                                        <span class="message">
                          فیلمای فستیوال فیلمایی که اجرا شده یا راجع به لحظات مرده ایه که فیلمسازا میسازن. آنها جایی بودند که....
                        </span>
                                    </a>
                                </li>
                                <li>
                                    <a>
                                        <span class="image"><img src="../build/images/img.jpg"
                                                                 alt="Profile Image"/></span>
                                        <span>
                          <span>سام سامی</span>
                          <span class="time">3 دقیقه پیش</span>
                        </span>
                                        <span class="message">
                          فیلمای فستیوال فیلمایی که اجرا شده یا راجع به لحظات مرده ایه که فیلمسازا میسازن. آنها جایی بودند که....
                        </span>
                                    </a>
                                </li>
                                <li>
                                    <div class="text-center">
                                        <a>
                                            <strong>مشاهده تمام اعلان ها</strong>
                                            <i class="fa fa-angle-left"></i>
                                        </a>
                                    </div>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
        <!-- /top navigation -->
        <!-- /header content -->
        
<!-- page content -->
<div class="right_col" role="main">
    <!-- top tiles -->
    <div class="row tile_count">
        <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
            <span class="count_top"><i class="fa fa-user"></i>  مشتریان </span>
            <div class="count"><?php echo $customer[0]?></div>
            <span class="count_bottom"><i class="green">4% </i> از هفته گذشته</span>
        </div>
        <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
            <span class="count_top"><i class="fa fa-user"></i> تهیه کنندگان</span>
            <div class="count"><?php echo $supplier[0]?></div>
            <span class="count_bottom"><i class="green"><i
                    class="fa fa-sort-asc"></i>3% </i> از هفته گذشته</span>
        </div>
        <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
            <span class="count_top"><i class="fa fa-user"></i> گدام</span>
            <div class="count green"><?php echo $inventory[0]?></div>
            <span class="count_bottom"><i class="green"><i
                    class="fa fa-sort-asc"></i>34% </i> از هفته گذشته</span>
        </div>
        <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
            <span class="count_top"><i class="fa fa-user"></i> خریداری</span>
            <div class="count"><?php echo $item[0]?></div>
            <span class="count_bottom"><i class="red"><i
                    class="fa fa-sort-desc"></i>12% </i> از هفته گذشته</span>
        </div>
        <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
            <span class="count_top"><i class="fa fa-user"></i> فروشات</span>
            <div class="count"><?php echo $sales[0]?></div>
            <span class="count_bottom"><i class="green"><i
                    class="fa fa-sort-asc"></i>34% </i> از هفته گذشته</span>
        </div>
        <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
            <span class="count_top"><i class="fa fa-user"></i> مجموع پرداخت</span>
            <div class="count"><?php echo $payment[0]?></div>
            <span class="count_bottom"><i class="green"><i
                    class="fa fa-sort-asc"></i>34% </i> از هفته گذشته</span>
        </div>
    </div>
    <!-- /top tiles -->

<div class="row">

<div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
        <div class="x_title">
            <h2>نرخ ارز ها
                <!-- <small>ارز های خارجی به افغانی و برعکس آن</small> -->
            </h2>
            <ul class="nav navbar-right panel_toolbox">
                <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                </li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
                       aria-expanded="false"><i class="fa fa-wrench"></i></a>
                    <ul class="dropdown-menu" role="menu">
                        <li><a href="#">تنظیمات 1</a>
                        </li>
                        <li><a href="#">تنظیمات 2</a>
                        </li>
                    </ul>
                </li>
                <li><a class="close-link"><i class="fa fa-close"></i></a>
                </li>
            </ul>
            <div class="clearfix"></div>
        </div>
        <div class="x_content">
            <div class="dashboard-widget-content">
                <div class="col-md-4 hidden-small">
                    <h2 class="line_30"> ارز های خارجی به افغانی</h2>

                    <table class="countries_list">
                        <tbody>
                        <tr>
                            <td>یک دالر </td>
                            <td class="fs15 fw700 text-right"><?php echo convertCurrency($API, 1, 'USD', 'AFN');?>&#1547;</td>
                        </tr>
                        <tr>
                            <td>یک یورو</td>
                            <td class="fs15 fw700 text-right"><?php echo convertCurrency($API, 1, 'EUR', 'AFN');?>&#1547;</td>
                        </tr>
                        <tr>
                            <td>یک پوند</td>
                            <td class="fs15 fw700 text-right"><?php echo convertCurrency($API, 1, 'GBP', 'AFN');?>&#1547;</td>
                        </tr>
                        <tr>
                            <td>هزار روپیه پاکستانی</td>
                            <td class="fs15 fw700 text-right"><?php echo convertCurrency($API, 1000, 'PKR', 'AFN');?>&#1547;</td>
                        </tr>
                        <tr>
                            <td>هزار ریال ایرانی</td>
                            <td class="fs15 fw700 text-right"><?php echo convertCurrency($API, 1000, 'IRR', 'AFN');?>&#1547;</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
                <div id="world-map-gdp" class="col-md-8 col-sm-12 col-xs-12"
                     style="height:230px;"></div>
            </div>
        </div>
    </div>
</div>


</div>
    


    
</div>

<!-- /page content -->

        <!-- footer content -->
        <footer class="hidden-print">
        <div class="d-flex align-items-center justify-content-between "> 
            
                
                <div class="pull left-align">   
                &copy; گلوبل اکسپرت
                </div>
        </div>
                              
        <div class="clearfix"></div>
        </footer>
        <!-- /footer content -->
    </div>
</div>
<div id="lock_screen">
    <table>
        <tr>
            <td>
                <div class="clock"></div>
                <span class="unlock">
                    <span class="fa-stack fa-5x">
                      <i class="fa fa-square-o fa-stack-2x fa-inverse"></i>
                      <i id="icon_lock" class="fa fa-lock fa-stack-1x fa-inverse"></i>
                    </span>
                </span>
            </td>
        </tr>
    </table>
</div>
<!-- jQuery -->
<script src="../vendors/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap -->
<script src="../vendors/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- FastClick -->
<script src="../vendors/fastclick/lib/fastclick.js"></script>
<!-- NProgress -->
<script src="../vendors/nprogress/nprogress.js"></script>
<!-- bootstrap-progressbar -->
<script src="../vendors/bootstrap-progressbar/bootstrap-progressbar.min.js"></script>
<!-- iCheck -->
<script src="../vendors/iCheck/icheck.min.js"></script>

<!-- bootstrap-daterangepicker -->
<script src="../vendors/moment/min/moment.min.js"></script>

<script src="../vendors/bootstrap-daterangepicker/daterangepicker.js"></script>

<!-- Chart.js -->
<script src="../vendors/Chart.js/dist/Chart.min.js"></script>
<!-- jQuery Sparklines -->
<script src="../vendors/jquery-sparkline/dist/jquery.sparkline.min.js"></script>
<!-- gauge.js -->
<script src="../vendors/gauge.js/dist/gauge.min.js"></script>
<!-- Skycons -->
<script src="../vendors/skycons/skycons.js"></script>
<!-- Flot -->
<script src="../vendors/Flot/jquery.flot.js"></script>
<script src="../vendors/Flot/jquery.flot.pie.js"></script>
<script src="../vendors/Flot/jquery.flot.time.js"></script>
<script src="../vendors/Flot/jquery.flot.stack.js"></script>
<script src="../vendors/Flot/jquery.flot.resize.js"></script>
<!-- Flot plugins -->
<script src="../vendors/flot.orderbars/js/jquery.flot.orderBars.js"></script>
<script src="../vendors/flot-spline/js/jquery.flot.spline.min.js"></script>
<script src="../vendors/flot.curvedlines/curvedLines.js"></script>
<!-- DateJS -->
<script src="../vendors/DateJS/build/production/date.min.js"></script>
<!-- JQVMap -->
<script src="../vendors/jqvmap/dist/jquery.vmap.js"></script>
<script src="../vendors/jqvmap/dist/maps/jquery.vmap.world.js"></script>
<script src="../vendors/jqvmap/examples/js/jquery.vmap.sampledata.js"></script>

<!-- Custom Theme Scripts -->
<script src="../build/js/custom.min.js"></script>


</body>
</html>
