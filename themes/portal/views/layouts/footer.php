<?php
$visitor = 'Number of Visitors';
$notice = 'Important notice :<br>A print-out from this website is NOT A COPY of the Gazette printed by the Government Printer for the purposes of section 61 of the Interpretation Acts 1948 and 1967 [Act 388] and does not constitute prima facie evidence of the contents of the Gazette by virtue of the section.';
$copies = 'Authoritative printed copies of the Federal Government Gazette can be obtained from <a href="http://www.printnasional.com.my/pnmb/"><b>Percetakan Nasional Malaysia Berhad</b></a>.';
$best_view = 'Best viewed using Internet Explorer 10.0 and above with 1024x768 screen resolution. ';
$copy = 'Copyright';
if(Yii::app()->session['lang'] == 'my'){
    $visitor = 'Jumlah Pelawat';
    $notice = 'Notis Penting :<br>Cetakan daripada laman sesawang ini BUKAN SUATU SALINAN Warta yang dicetak oleh Pencetak Kerajaan bagi maksud Seksyen 61 Akta Tafsiran 1948 & 1967 [Akta 388] dan tidak boleh menjadi keterangan prima facie kandungan Warta bagi maksud seksyen tersebut.';
    $copies = 'Salinan cetakan rasmi bagi Warta Kerajaan Persekutuan boleh diperoleh di <a href="http://www.printnasional.com.my/pnmb/"><b>Percetakan Nasional Malaysia Berhad<//b></a>.';
    $best_view = 'Paparan terbaik dengan Internet Explorer Versi 10.0 ke atas dan resolusi 1024 X 768. ';
    $copy = 'Hakcipta';
}
?>
<!--<footer class="padding-50 e-bg-light-texture">-->
<footer class="padding-50" style="background: rgba(0, 0, 0, 0.2);">
    <div class="container-fluid nopadding">

        <div class="row wow fadeInDown" data-wow-delay=".2s" data-wow-offset="10">
            <div class="col-md-9">
                <ul class="list-inline">
                    <?php
                    $output = '';
                    $sitemaps = OstMenuPortal::model()->findAll(array('condition' => "menu_type='footer' AND lang='en' ORDER BY sort ASC"));
                    foreach($sitemaps as $sitemap){
                        $output .= '<li><a href="'.$sitemap->url.'&menu_id='.PortalElement::encrypt_decrypt('encrypt', $sitemap->id).'">'.  PortalTranslation::TranslateFooterTitle($sitemap->id, $sitemap->title).'</a></li>';
                    }
                    echo $output;
                    ?>
                </ul>
                <p class="inline-block" style="text-align:justify; width:90%;">              
                    <?php echo $best_view; ?>
                </p>
                <p class="inline-block" style="text-align:justify; width:90%;">              
                    <?php echo $notice; ?>
                </p>
                <p class="inline-block" style="text-align:justify; width:90%;">
                    <?php echo $copies; ?>
                </p>
                <div class="divider-dynamic"></div>
            </div>
<!--            <div class="col-md-2">
                <ul class="list-inline">
                    <?php
                    $output = '';
                    $sitemaps = OstMenuPortal::model()->findAll(array('condition' => "menu_type='footer' AND lang='en' ORDER BY sort ASC"));
                    foreach($sitemaps as $sitemap){
                        $output .= '<li><a href="'.$sitemap->url.'&menu_id='.PortalElement::encrypt_decrypt('encrypt', $sitemap->id).'">'.  PortalTranslation::TranslateFooterTitle($sitemap->id, $sitemap->title).'</a></li>';
                    }
                    echo $output;
                    ?>
                </ul>
                <div class="dividewhite2"></div>
            </div>-->
            <div class="col-md-3">
                <h4 class="font-accident-two-normal uppercase"><?php echo $visitor; ?></h4>


                <section id="counts-light-bg" class="counts inner-section wow fadeInDown" data-wow-delay="0.2s" data-wow-offset="10">
                    <div class="container-fluid nopadding">
                        <div class="count-container row">
                            <div class="col-lg-3 col-sm-6 col-xs-12 count">
                                <div>
                                    <span class=".integers digit font-accident-two-normal" style="color:white;"><?php echo OstVisitor::model()->GetAll(); ?></span>
                                </div>
                            </div>
                        </div>
                        <div class="dividewhite2"></div>
                    </div>
                </section>

                <div class="divider-dynamic">
                    <p><?php echo $copy; ?> © 2016 eWarta.</p>
                </div>
            </div>
        </div>
<!--        <div class="dividewhite1"></div>
        <div class="row wow fadeInDown" data-wow-delay=".4s" data-wow-offset="10">
            <div class="col-md-12 copyrights">
                <a href="#">Contact Us</a> | <a href="#">FAQ</a> | <a href="#">Feedback</a> | <a href="#">Terms & Conditions</a> | <a href="#">Other Links</a>
                <p>Copyright © 2016 eWarta.</p>
            </div>
        </div>-->
    </div>
</footer>