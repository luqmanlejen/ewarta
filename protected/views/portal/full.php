<style>
    .mj_accordion{padding:0;margin:0;}
    .mj_accordion li{list-style: none;margin-bottom:20px;}
    .mj_accordion_item{background:#24a2e6;color:white;padding:10px;cursor: pointer;}
    .mj_accordion_item.active{background:#16c1a8;}
    .mj_accordion_content{border:1px solid #16c1a8;padding:20px;}
</style>

<div class="content-wrap">
    
    <div id="contacts" class="inner-content">
        <section id="page-title" class="inner-section">
            <div class="container-fluid nopadding wow fadeInRight" data-wow-delay="0.4s" data-wow-offset="10">
                <h2 class="font-accident-two-normal uppercase"><?php echo PortalElement::GetMasterTitle(); ?></h2>
                <!--            <h5 class="font-accident-one-bold hovercolor uppercase">Hard-working person on the way to the success...</h5>
                            <p class="small fontcolor-medium">
                               Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam id metus purus. Ut vulputate, est vel tincidunt mattis, orci neque iaculis lectus, et interdum quam felis vel tortor. Fusce ultrices dui quis nunc dignissim faucibus. Ut ac odio quis nibh viverra fringilla ac id nisi. Suspendisse tincidunt augue quis ligula cursus, non efficitur ligula faucibus. Mauris id neque maximus, tincidunt metus et, sodales nulla.
                            </p>-->
                <hr>
            </div>
        </section>
        <?php echo PortalElement::GetArticleDetails($_GET['menu_id'], 'content'); ?>

    </div>

</div>

<script>
    jQuery(function ($) {
        $(".mj_accordion .mj_accordion_item").click(function () {
            $(".mj_accordion .mj_accordion_item").removeClass("active");
            $(".mj_accordion .mj_accordion_content").slideUp("normal");
            if ($(this).next().is(":hidden") == true) {
                $(this).addClass("active");
                $(this).next().slideDown("normal");
                return false;
            }
        });
        $(".mj_accordion .mj_accordion_content").hide();
        $(".mj_accordion .mj_accordion_content:eq(0)").show();
        $('.mj_accordion .mj_accordion_item:eq(0)').addClass("active");
    });
</script>