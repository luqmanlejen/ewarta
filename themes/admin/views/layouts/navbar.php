<ul class="nav nav-list" id="leftmenu">
<?php
    //$count = 0;
    //$counts =0;
    if (!Yii::app()->user->isGuest) {
        
    $sql = "
            SELECT DISTINCT t.id, t.* FROM ost_menu t 
                INNER JOIN ost_menu_access b ON b.menu_id = t.id
                INNER JOIN ost_user_role c ON b.role_code = c.role_code
                INNER JOIN ost_user d ON c.user_id = d.id
            WHERE
                t.parent_menu = 0 AND
                t.menu_type = 'cms' AND
                t.hide_ind = 0 AND
                d.id IN (".Yii::app()->session['user_id'].")
            ORDER BY t.sort ASC
            ";

    $modelmenuadm = OstMenu::model()->findAllBySql($sql);
        
    foreach ($modelmenuadm as $rowmenuadm) {
        //$count++;
        $submenu = '';
        $menu_parent_id = $rowmenuadm['id'];
		
        $sql2 = "
                SELECT DISTINCT t.id, t.* FROM ost_menu t 
                    INNER JOIN ost_menu_access b ON b.menu_id = t.id
                    INNER JOIN ost_user_role c ON b.role_code = c.role_code
                    INNER JOIN ost_user d ON c.user_id = d.id
                WHERE
                    t.parent_menu = ".$menu_parent_id." AND
                    t.menu_type = 'cms' AND
                    t.hide_ind = 0 AND
                    d.id IN (".Yii::app()->session['user_id'].")
                ORDER BY t.sort ASC
                ";
        
        $modelmenuadm2 = OstMenu::model()->findAllBySql($sql2);
        $output = '';
        
        foreach ($modelmenuadm2 as $rowmenuadm2) {
            $menu_sub_id = $rowmenuadm2['id'];
            //$counts++;
            
            $submenu.= "<li id='".$menu_sub_id."'>" . CHtml::link($text = $rowmenuadm2['title'], Yii::app()->createUrl($rowmenuadm2['url'])) . '</li>';
        }

        if ($submenu == '') {
            $output .= '<li><a href="index.php?r=' . $rowmenuadm['url'] . '">' . $rowmenuadm['title'] . '</a></li>';
        } else {
            $output .= "<li id='".$menu_parent_id."'>".
                            '<a href="#" class="dropdown-toggle" data-toggle="">' . $rowmenuadm['title'] . ' <b class="arrow fa fa-angle-down"></b></a>
                            <ul class="submenu">' . $submenu . '</ul>
                        </li>
                        ';
        }
        echo $output;
    }
}
?>
</ul>

<script type="text/javascript">
    function activemenu(one, two) {
        $("#leftmenu li").removeClass("active");
        $("#leftmenu li").removeClass("open");
        $("#leftmenu #"+one).addClass("open active");

        $("#leftmenu ul li").removeClass("active");
        $("#leftmenu ul li").removeClass("open");
        $("#leftmenu #"+two).addClass("active");
    }
</script>
