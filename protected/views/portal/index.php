<?php
$today = 'Today\'s Gazette';
$announce = 'Announcement';
$dewan_rakyat = 'House of Representatives Bills';
$dewan_negara = 'Senate Bills';
$principal = 'Principal Act';
$amending = 'Amending Act';
$pua = 'List of P.U. (A)';
$pub = 'List of P.U. (B)';
$click = "Click here to read more >>";
$act = "Act";

if (Yii::app()->session['lang'] == 'my') {
    $today = 'Warta Hari Ini';
    $announce = 'Pengumuman';
    $dewan_rakyat = 'RUU <br>DEWAN RAKYAT';
    $dewan_negara = 'RUU <br>DEWAN NEGARA';
    $principal = 'Akta Utama';
    $amending = 'Akta Pindaan';
    $pua = 'Senarai P.U. (A)';
    $pub = 'Senarai P.U. (B)';
    $click = "Klik di sini bacaan lanjut >>";
    $act = 'AKTA';
}


$rakyat = 'http://www.parlimen.gov.my/bills-dewan-rakyat.html?uweb=dr&lang=en';
$negara = 'http://www.parlimen.gov.my/bills-dewan-negara.html?uweb=dn&lang=en';
if (Yii::app()->session['lang'] == 'my') {
    $rakyat = 'http://www.parlimen.gov.my/bills-dewan-rakyat.html?uweb=dr&lang=bm';
    $negara = 'http://www.parlimen.gov.my/bills-dewan-negara.html?uweb=dn&lang=bm';
}
?>


<style>
    .personal{
        min-height: 205px;    /*290px luqman 13062016*/
        max-height: 350px;
    }
    .tiles{
        color: white;
        min-height: 190px;      /*luqman 13062016*/
        max-height: 190px;
    }

    .tiles h3{
        color: white;
    }

    .tiles p{
        color: white;
        font-size: 13px;
    }

    .tilesp{
        color: white;
        font-size: 13px;
        //display: none;

        width: 370px;       /*350px luqman 13062016*/
        display: block;
        white-space: nowrap;
        text-overflow: ellipsis;
        overflow: hidden;
        text-align: right;
    }

    figcaption a{
        overflow: hidden;
        position: relative;
        display: none;
    }
    figcaption a:hover{
        //font-size: 14px;
    }

    figcaption {
        position: absolute;
        //width: 170px;
        width: 100%;
        margin: 0 auto;
        padding: 10px 15px;
        text-align: right;
        color: white;
        background-color: rgba(0, 0, 0, 0);
        transition: background-color 0.3s ease;
        line-height: 1em;
    }

    .tiles:hover a:hover{
        color: #3498db;
        font-weight: 700;
    }

    .tiles:hover a{
        color: white;
        display: inline;
    }
    
    .tiles:hover figcaption {
        bottom: 0;
        background-color: rgba(0, 0, 0, 0.5);
        transition: background-color 0.5s linear;
    }

    .small{
        text-align: justify;
        font-size: 14px;
    }

    .announcement{
        height:380px;
    }

    .bil{
        height:120px;
    }

    #nt-example1 li{
        color: white;
        overflow: hidden;
        height: 100px;
        padding: 10px;
        line-height: 20px;      /*30px luqman 13062016*/
        list-style: none;
        font-size: 14px;
        text-align: left;
        border-bottom: 1px dotted white;
    }
    #today li{
        color: black;
        overflow: hidden;
        height: 140px;              /*100px luqman 13062016*/
        padding: 10px 0 0 0;        /*10px luqman 14062016*/
        line-height: 20px;          /*30px luqman 13062016*/
        list-style: none;
        font-size: 14px;
        text-align: left;        
    }

    .padding-51{
        padding: 20px 20px 10px 20px;
    }
</style>

<div class="m-details row nopadding skin">

    <div class="col-md-12 nopadding">

        <div class="row nopadding">

            <div class="col-md-6 nopadding ">

                <div class="row nopadding">

                    <div class="col-md-12 fullwidth padding-50 wow fadeInDown" data-wow-delay="0.2s" data-wow-offset="10">
                        <div class="row nopadding">
                            <!--<h3 class="font-accident-two-normal uppercase">About me</h3>-->
                            <div class="quote">
                                <!--<h5 class="font-accident-one-bold hovercolor uppercase"></h5>-->
                                <!--<div class="dividewhite1"></div>-->
                                <p class="small">
                                    <?php
                                    $info = OstArticles::model()->findByAttributes(array('menu_id' => 30));
                                    echo PortalTranslation::TranslateArticleContent($info->id, $info->content);
                                    ?>
                                </p>
                            </div>
                        </div>
                        <div class="divider-dynamic"></div>
                    </div>

                </div>

            </div>

            <div class="col-md-3 personal nopadding l-grey">
                <div class="padding-50 wow fadeInRight" data-wow-delay="0.4s" data-wow-offset="10">
                    <h3 class="font-accident-two-normal uppercase"><?php echo $announce; ?></h3>
                    <!--<div class="dividewhite2"></div>-->
                    <div>
                        <div class="fullwidth box">
                            <!--<div class="one"><p class="small font-regular-bold uppercase">Name:</p></div>-->
                            <div class="">
                                <ul id="today">

                                    <?php
                                    $output = '';
                                    $act_list = OstAct::model()->findAll(array('condition' => "publish=1 AND isactive=0"));
                                    if (sizeof($act_list) > 0) {
                                        foreach ($act_list as $act_row) {
                                            $output .= '<li>
                                            <b>'.$act.' ' . $act_row->no_act . '</b><br>
                                            <a href="#" style="color:black;">' . PortalTranslation::TranslateAnnounceList($act_row->id, 'act', $act_row->act_name_bi) . '</a></li>';
                                        }
                                    }

                                    $amending_list = OstAmendingAct::model()->findAll(array('condition' => "publish=1 AND isactive=0"));
                                    if (sizeof($amending_list) > 0) {
                                        foreach ($amending_list as $amending_row) {
                                            $output .= '<li>
                                            <b>Act ' . $amending_row->no_act . '</b><br>
                                            <a href="#" style="color:black;">' . PortalTranslation::TranslateAnnounceList($amending_row->id, 'amending', $amending_row->act_name_bi) . '</a></li>';
                                        }
                                    }

                                    $pu_list = OstPerundangan::model()->findAll(array('condition' => "publish=1 AND isactive=0"));
                                    if (sizeof($pu_list) > 0) {
                                        foreach ($pu_list as $pu_row) {
                                            $output .= '<li>
                                            <b>' . $pu_row->pu_no . '</b><br>
                                            <a href="#" style="color:black;">' . PortalTranslation::TranslateAnnounceList($pu_row->id, 'pu', $pu_row->sub_act_name_bi) . '</a></li>';
                                        }
                                    }

                                    echo $output;
                                    ?>

                                </ul>
<!--                                <p class="small">
                                    Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s
                                </p>-->
                            </div>
                        </div>
                    </div>
                    <div class="dividewhite3"></div>
                </div>
            </div>

            <div class="col-md-3 nopadding l-grey">
                <!--Senate Bills-->
                <div class="nopadding red tiles2">
                    <a href="<?php echo $negara; ?>" alt="Dewan Negara" target="_blank">
                        <div class="padding-50 wow fadeInRight" data-wow-delay="0.4s" data-wow-offset="10">
                            <h3 class="font-accident-two-normal uppercase"><?php echo $dewan_negara; ?></h3>
                            <div class="dividewhite2"></div>                            
                        </div>
                    </a>
                </div>
                <!--Senate Bills-->
                <!--House of representative bills-->
                <div class="nopadding green tiles2">
                    <a href="<?php echo $rakyat; ?>" alt="Dewan Rakyat" target="_blank">
                        <div class="padding-50 wow fadeInRight" data-wow-delay="0.4s" data-wow-offset="10">
                            <h3 class="font-accident-two-normal uppercase"><?php echo $dewan_rakyat; ?></h3>
                            <div class="dividewhite2"></div>
                        </div>
                    </a>
                </div>
                <!--House of representative bills-->
            </div>
        </div>

    </div>

</div>

<div class="row nopadding cyan">

    <div class="col-md-4 pro-experience nopadding height-300">
        <div class="padding-50 wow announcement fadeInRight" data-wow-delay="0.6s" data-wow-offset="5">
            <h3 class="font-accident-two-normal uppercase fontcolor-invert"><?php echo $today; ?></h3>
            <div class="dividewhite2"></div>



            <div class="experience">

                <div id="nt-example1-container">
                    <ul id="nt-example1">
                        <?php
                        $output = '';
                        $act_list = OstAct::model()->findAll(array('condition' => "publish=1 AND isactive=0"));
                        if (sizeof($act_list) > 0) {
                            foreach ($act_list as $act_row) {
                                $output .= '<li>
                                                    <b>'.$act.' '. $act_row->no_act . '</b><br>
                                                    <a href="#" style="color:black;">' . PortalTranslation::TranslateAnnounceList($act_row->id, 'act', $act_row->act_name_bi) . '</a></li>';
                            }
                        }
                        echo $output;
                        ?>
                    </ul>                    
                </div>
            </div>
            <a href="#!"><i class="flaticon-three-1"></i></a>
        </div>

    </div>

    <!--Principal Act-->
    <div class="col-md-4 personal nopadding darkblue tiles">
        <a href="#" alt="">
            <div class="padding-50 wow fadeInRight" data-wow-delay="0.4s" data-wow-offset="10">
                <h3 class="font-accident-two-normal uppercase"><?php echo $principal; ?></h3>
                <!--<div class="dividewhite2"></div>-->
                <div>
                    <div class="fullwidth box">
                        <?php
                        $output_act = '';
                        $acts = OstAct::model()->findAll(array('condition' => "publish=1 ORDER BY date_effective LIMIT 2"));
                        foreach ($acts as $act) {
                            if(Yii::app()->session['lang'] == 'en'){
                                $output_act .= '<a href="'.PortalTranslation::TranslateActLink($act->id, 'act', $act->doc_name_bi).'">
                                                    <div class="one">
                                                        <p class="small font-regular-bold uppercase">ACT ' . $act->no_act . '</p>
                                                    </div>
                                                    <div class="two">
                                                        <p class="small tilesp">
                                                            ' . $act->act_name_bi . '
                                                        </p>
                                                    </div>
                                                </a><br>';
                            } else {
                                $output_act .= '<a href="'.PortalTranslation::TranslateActLink($act->id, 'act', $act->doc_name_bi).'">
                                                    <div class="one">
                                                        <p class="small font-regular-bold uppercase">AKTA ' . $act->no_act . '</p>
                                                    </div>
                                                    <div class="two">
                                                        <p class="small tilesp">
                                                        ' . $act->act_name_bm . '
                                                        </p>
                                                    </div>
                                                </a><br>';
                            }
                        }
                        echo $output_act;
                        ?>
                    </div>
                </div>
                <!--<div class="dividewhite4"></div>-->
            </div>
        </a>
        <figcaption><a href="index.php?r=portal/actList"><?php echo $click; ?></a></figcaption>
    </div>
    <!--Principal Act-->

    <!--Amending Act-->
    <div class="col-md-4 personal nopadding orange tiles">
        <a href="#" alt="">
            <div class="padding-50 wow fadeInRight" data-wow-delay="0.4s" data-wow-offset="10">
                <h3 class="font-accident-two-normal uppercase"><?php echo $amending; ?></h3>
                <!--<div class="dividewhite2"></div>-->
                <div>
                    <div class="fullwidth box">
                        <?php
                        $output_act = '';
                        $acts = OstAmendingAct::model()->findAll(array('condition' => "publish=1 ORDER BY date_effective LIMIT 2"));
                        foreach ($acts as $act) {
                            if(Yii::app()->session['lang'] == 'en'){
                                $output_act .= '<a href="'.PortalTranslation::TranslateActLink($act->id, 'amending', $act->doc_name_bi).'">
                                                    <div class="one"><p class="small font-regular-bold uppercase">ACT ' . $act->no_act . '</p></div>
                                                    <div class="two">
                                                        <p class="small tilesp">
                                                            ' . $act->act_name_bi . '
                                                        </p>
                                                    </div>
                                                </a><br>';
                            } else {
                                $output_act .= '<a href="'.PortalTranslation::TranslateActLink($act->id, 'amending', $act->doc_name_bi).'">
                                                    <div class="one"><p class="small font-regular-bold uppercase">AKTA ' . $act->no_act . '</p></div>
                                                    <div class="two">
                                                        <p class="small tilesp">
                                                            ' . $act->act_name_bm . '
                                                        </p>
                                                    </div>
                                                </a><br>';
                            }
                        }
                        echo $output_act;
                        ?>
                    </div>
                </div>
                <!--<div class="dividewhite4"></div>-->
            </div>
        </a>
        <figcaption><a href="#"><?php echo $click; ?></a></figcaption>
    </div>
    <!--Amending Act-->

    <!--List of P.U. (A)-->
    <div class="col-md-4 personal nopadding red tiles">
        <a href="#" alt="">
            <div class="padding-50 wow fadeInRight" data-wow-delay="0.4s" data-wow-offset="10">
                <h3 class="font-accident-two-normal uppercase"><?php echo $pua; ?></h3>
                <!--<div class="dividewhite2"></div>-->
                <div>
                    <div class="fullwidth box">
                        <?php
                        $output_pu_a = '';
                        $pu_as = OstPu::model()->findAll(array('condition' => "publish=1 AND pu_type_id=1 ORDER BY updated_dt LIMIT 2"));
                        foreach ($pu_as as $pu_a) {
                            if(Yii::app()->session['lang'] == 'en'){
                                $output_pu_a .= '<a href="'.PortalTranslation::TranslateActLink($act->id, 'pua', $act->doc_name_bi).'">
                                                    <div class="one"><p class="small font-regular-bold uppercase">' . $pu_a->pu_no . '</p></div>
                                                    <div class="two">
                                                        <p class="small tilesp">
                                                            ' . $pu_a->sub_act_name_bi . '
                                                        </p>
                                                    </div>
                                                </a><br>';
                            } else {
                                $output_pu_a .= '<a href="'.PortalTranslation::TranslateActLink($act->id, 'pua', $act->doc_name_bi).'">
                                                    <div class="one"><p class="small font-regular-bold uppercase">' . $pu_a->pu_no . '</p></div>
                                                    <div class="two">
                                                        <p class="small tilesp">
                                                            ' . $pu_a->sub_act_name_bm . '
                                                        </p>
                                                    </div>
                                                </a>';
                            }
                        }
                        echo $output_pu_a;
                        ?>
                    </div>
                </div>
                <!--<div class="dividewhite4"></div>-->
            </div>
        </a>
        <figcaption><a href="#"><?php echo $click; ?></a></figcaption>
    </div>
    <!--List of P.U. (A)-->

    <!--List of P.U. (B)-->
    <div class="col-md-4 personal nopadding yellow tiles">
        <a href="#" alt="">
            <div class="padding-50 wow fadeInRight" data-wow-delay="0.4s" data-wow-offset="10">
                <h3 class="font-accident-two-normal uppercase"><?php echo $pua; ?></h3>
                <!--<div class="dividewhite2"></div>-->
                <div>
                    <div class="fullwidth box">
                        <?php
                        $output_pu_b = '';
                        $pu_bs = OstPu::model()->findAll(array('condition' => "publish=1 AND pu_type_id=2 ORDER BY updated_dt LIMIT 2"));
                        foreach ($pu_bs as $pu_b) {
                            $output_pu_b .= '<div class="one"><p class="small font-regular-bold uppercase">' . $pu_b->pu_no . '</p></div>
                                        <div class="two">
                                            <p class="small tilesp">
                                                ' . $pu_b->sub_act_name_bi . '
                                            </p>
                                        </div>';
                        }
                        echo $output_pu_b;
                        ?>
                    </div>
                </div>
                <!--<div class="dividewhite4"></div>-->
            </div>
        </a>
        <figcaption><a href="#"><?php echo $click; ?></a></figcaption>
    </div>
    <!--List of P.U. (B)-->

</div>