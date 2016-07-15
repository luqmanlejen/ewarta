<script src="./themes/admin/js/highcharts.js"></script>
<script src="./themes/admin/js/exporting.js"></script>

<!--<div class="main-content">-->
<div class="main-content-inner">
    <!-- #section:basics/content.breadcrumbs -->
    <div class="breadcrumbs" id="breadcrumbs">
        <script type="text/javascript">
            try {
                ace.settings.check('breadcrumbs', 'fixed')
            } catch (e) {
            }
        </script>
        <ul class="breadcrumb">
            <li class="active"><i class="ace-icon fa fa-home home-icon"></i>&nbsp;<a href="index.php?r=site/index">Dashboard</a></li>
        </ul><!-- /.breadcrumb -->
    </div>
    <div class="page-content">
        <?php include 'themes/admin/views/layouts/setting.php'; ?>
        <div class="page-header"><h1>Dashboard</h1></div>

        <div class="row">

            <div class="widget-box transparent">
                <div class="widget-header widget-header-flat">
                    <h4 class="widget-title blue"><i class="ace-icon fa fa-bar-chart"></i>CMS User Login Statistics</h4>
                    <div class="widget-toolbar"><a href="#" data-action="collapse"><i class="ace-icon fa fa-chevron-up"></i></a></div>
                </div>

                <div class="widget-body">
                    <div class="widget-main padding-4">
                        <?php //include 'cms_user_login.php'; ?> 
                    </div> 
                </div> 
            </div>

            <!--<div class="hr hr32 hr-dotted"></div>-->


        </div>
    </div>
</div>