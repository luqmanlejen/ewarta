<ul id="nav" class="row nopadding cd-side-navigation">
    <li class="col-xs-4 col-sm-2 nopadding menuitem green">
        <a href="index.php?r=portal" class="hvr-sweep-to-bottom"><img src="images/menu/web.png" style="padding-top:10px;padding-bottom:10px; color:white;" alt="Home"/><span> <?php echo OstRefList::model()->getTranslation("12"); ?></span></a>
    </li>
    <?php
    $output = '';
    $count = 0;
    $color = ['blue', 'cyan', 'orange', 'red', 'yellow'];
    //$icon = ['graduation61', 'book-bag2', 'placeholders4', 'earphones18', 'pens15'];
    $icon = ['construction', 'tool', 'A', 'B', 'law'];
    $menus = OstMenuPortal::model()->findAll(array('condition' => "menu_type='header' AND lang='en' AND hide_ind=0", 'order' => 'sort ASC'));
    foreach ($menus as $menu) {
//        $output .= '<li class="col-xs-4 col-sm-2 nopadding menuitem ' . $color[$count] . '">
//                    <a href="' . $menu->url . '" class="hvr-sweep-to-bottom"><i class="flaticon-' . $icon[$count] . '"></i><span>' . PortalTranslation::TranslateMenu($menu->id, $menu->title) . '</span></a>
//                </li>';
        $output .= '<li class="col-xs-4 col-sm-2 nopadding menuitem ' . $color[$count] . '">
                    <a href="' . $menu->url . '" class="hvr-sweep-to-bottom"><img src="images/menu/' . $icon[$count] . '.png" style="padding-top:10px;padding-bottom:10px; color:white;"><span>' . PortalTranslation::TranslateMenu($menu->id, $menu->title) . '</span></a>
                </li>';
        $count++;
    }
    echo $output;
    ?>
</ul>