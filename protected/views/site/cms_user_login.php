<div class="well">
<?php
$total = 0;

$Jan_it = 0;
$Feb_it = 0;
$Mac_it = 0;
$Apr_it = 0;
$May_it = 0;
$June_it = 0;
$July_it = 0;
$Aug_it = 0;
$Sept_it = 0;
$Oct_it = 0;
$Nov_it = 0;
$Dec_it = 0;

$Jan_dev = 0;
$Feb_dev = 0;
$Mac_dev = 0;
$Apr_dev = 0;
$May_dev = 0;
$June_dev = 0;
$July_dev = 0;
$Aug_dev = 0;
$Sept_dev = 0;
$Oct_dev = 0;
$Nov_dev = 0;
$Dec_dev = 0;

$Jan_civil = 0;
$Feb_civil = 0;
$Mac_civil = 0;
$Apr_civil = 0;
$May_civil = 0;
$June_civil = 0;
$July_civil = 0;
$Aug_civil = 0;
$Sept_civil = 0;
$Oct_civil = 0;
$Nov_civil = 0;
$Dec_civil = 0;

//set initial value
$log_admin_it = '0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0';

$log_dev = '0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0';

$log_admin_civil = '0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0';

Yii::app()->setTimeZone("Asia/Kuala_Lumpur");

//$rows = OstVisitor::model()->findAll(array('order' => 'dtvisit DESC'));
$rows = OstAuditTrail::model()->findAll(array('order' => 'action_datetime DESC'));

//display x-axis
foreach ($rows as $row) {

    $visitor_id = $row['user_id'];

    $month_visit = date("m", strtotime($row['action_datetime']));
    
    $row2 = OstUser::model()->findByPk($visitor_id);
    
    $user_id = $row2['id'];
    
    if($user_id == 4){
        
        if ($month_visit == 1){
            $Jan_civil++;
        }
        if ($month_visit == 2){
            $Feb_civil++;
        }
        if ($month_visit == 3){
            $Mac_civil++;
        }
        if ($month_visit == 4){
            $Apr_civil++;
        }
        if ($month_visit == 5){
            $May_civil++;
        }
        if ($month_visit == 6){
            $June_civil++;
        }
        if ($month_visit == 7){
            $July_civil++;
        }
        if ($month_visit == 8){
            $Aug_civil++;
        }
        if ($month_visit == 9){
            $Sept_civil++;
        }
        if ($month_visit == 10){
            $Oct_civil++;
        }
        if ($month_visit == 11){
            $Nov_civil++;
        }
        if ($month_visit == 12){
            $Dec_civil++;
        }        
    }
    if($user_id == 8){
        
        if ($month_visit == 1){
            $Jan_it++;
        }
        if ($month_visit == 2){
            $Feb_it++;
        }
        if ($month_visit == 3){
            $Mac_it++;
        }
        if ($month_visit == 4){
            $Apr_it++;
        }
        if ($month_visit == 5){
            $May_it++;
        }
        if ($month_visit == 6){
            $June_it++;
        }
        if ($month_visit == 7){
            $July_it++;
        }
        if ($month_visit == 8){
            $Aug_it++;
        }
        if ($month_visit == 9){
            $Sept_it++;
        }
        if ($month_visit == 10){
            $Oct_it++;
        }
        if ($month_visit == 11){
            $Nov_it++;
        }
        if ($month_visit == 12){
            $Dec_it++;
        }        
    }
    if($user_id == 3 || $user_id == 1 || $user_id == 2){
        //echo 'berjaya';
        if ($month_visit == 1){
            $Jan_dev++;
        }
        if ($month_visit == 2){
            $Feb_dev++;
        }
        if ($month_visit == 3){
            $Mac_dev++;
        }
        if ($month_visit == 4){
            $Apr_dev++;
        }
        if ($month_visit == 5){
            $May_dev++;
        }
        if ($month_visit == 6){
            $June_dev++;
        }
        if ($month_visit == 7){
            $July_dev++;
        }
        if ($month_visit == 8){
            $Aug_dev++;
        }
        if ($month_visit == 9){
            $Sept_dev++;
        }
        if ($month_visit == 10){
            $Oct_dev++;
        }
        if ($month_visit == 11){
            $Nov_dev++;
        }
        if ($month_visit == 12){
            $Dec_dev++;
        }        
    }
    $total++;
}

$log_admin_civil = $Jan_civil.', '.$Feb_civil.', '.$Mac_civil.', '.$Apr_civil.', '.$May_civil.', '.$June_civil.', '.$July_civil.', '.$Aug_civil.', '.$Sept_civil.', '.$Oct_civil.', '.$Nov_civil.', '.$Dec_civil;

$log_admin_it = $Jan_it.', '.$Feb_it.', '.$Mac_it.', '.$Apr_it.', '.$May_it.', '.$June_it.', '.$July_it.', '.$Aug_it.', '.$Sept_it.', '.$Oct_it.', '.$Nov_it.', '.$Dec_it;

$log_dev = $Jan_dev.', '.$Feb_dev.', '.$Mac_dev.', '.$Apr_dev.', '.$May_dev.', '.$June_it.', '.$July_dev.', '.$Aug_dev.', '.$Sept_dev.', '.$Oct_dev.', '.$Nov_dev.', '.$Dec_dev;
?>
<script src="./themes/admin/js/highcharts.js"></script>

<script src="./themes/admin/js/exporting.js"></script>

<div class="graph" id="graph" style=""></div>

<script type="text/javascript">

    $(function() {
        $('#graph').highcharts({
            credits: {
                enabled: false,
            },
            chart: {
                marginTop: 80
            },
            title: {
                text: 'CMS User Login Statistics',
                x: -20 //center
            },
            xAxis: {
                categories: ['Jan', 'Feb', 'March', 'Apr', 'May', 'June', 'July', 'Aug', 'Sept', 'Oct', 'Nov', 'Dec']
            },
            yAxis: {
                min: 0,
                title: {
                    text: 'Number of Users Login'
                },
                plotLines: [{
                        value: 0,
                        width: 1,
                        color: '#808080'
                    }],
                allowDecimals: false,
            },
            tooltip: {
                valueSuffix: ' total user numbers'
            },
            legend: {
                layout: 'horizontal',
                backgroundColor: '#FFFFFF',
                align: 'center',
                verticalAlign: 'top',
                x: 0,
                y: 30,
                floating: true,
                shadow: false,
                borderRadius: 0,
                borderWidth: 0
            },
            series: [
                {
                    name: 'Admin IT',
                    color: 'violet',
                    data: [<?= $log_admin_it; ?>]
                },
                {
                    name: 'Admin Civil',
                    color: 'blue',
                    data: [<?= $log_admin_civil; ?>]
                },
                {
                    name: 'Developer',
                    color: 'green',
                    data: [<?= $log_dev; ?>]
                },
                    ]
        });
    });


</script>
</div>