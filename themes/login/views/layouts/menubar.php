<nav class="navbar navbar-default" role="navigation">

    <div class="collapse navbar-collapse navbar-ex1-collapse">

        <ul class="nav navbar-nav">

           <?php

            if (!Yii::app()->user->isGuest) {
                $sql ="select * from (select t.* from ost_menu t inner join ost_role_mapping b on b.menu_id=t.id 
                        inner join ost_staff_access d on d.role_code=b.role_code
                            inner join ost_user c on c.id=d.id_user 
                            and c.id='" . Yii::app()->session['user_id'] . "' and t.module_ind='1'
                                union select * from ost_menu where default_menu='1') aa order by aa.sort ";
                //echo $sql;
                $modules = OstMenu::model()->findAllBySql($sql);
                $arr_menu = array(); // semua menu. level 1 dan 2

                foreach ($modules as $module) {
                    $arr_sub = array();

                    $criteria = new CDbCriteria(array('order'=>'sort'));
                    $sub_modules = OstMenu::model()->findAllByAttributes(array("menu_parent_id" => $module->id),$criteria);

                    if (count($sub_modules) > 0) {
                        foreach ($sub_modules as $sub) {
                            array_push($arr_sub, array('label' => $sub->menu_txt, 'url' => $sub->menu_loc));
                        }
                    }

                    array_push($arr_menu, array('label' => $module->menu_txt, 'url' => $module->menu_loc, 'sub_menu' => $arr_sub));
                }

                echo '<ul class="nav navbar-nav">';
                foreach ($arr_menu as $menu) {
                    $sub = $menu['sub_menu'];
                    //$caret = count($sub) > 0 ? "<b class='caret'></b>" : '';
                    if (count($sub) > 0) { // ada sub-menu
                        $caret = "<b class='caret'></b>";
                        $class = "class='dropdown-toggle' data-toggle='dropdown'";
                    } else {
                        $caret = '';
                        $class = '';
                    }
                    echo "<li class='dropdown'>";
                    echo "<a href='index.php?r=" . $menu['url'] . "' $class>" . $menu['label'] . "$caret</a>";

                    // jika ada sub-menu
                    if (count($menu['sub_menu']) > 0) {
                        echo "<ul class='dropdown-menu'>";
                        $sub = $menu['sub_menu'];
                        foreach ($sub as $s) {
                            echo "<li>";
                                echo "<a href='index.php?r=" . $s['url'] . "'>" . $s['label'] . "</a>";
                            echo "</li>";
                        }
                        echo "</ul>";
                    }
                    
                    echo "</li>";
                    
                }
                echo '</ul>';

            } 
            
            ?>
            
        </ul>
        
        <?php if (!Yii::app()->user->isGuest) { ?>
        
            <ul class="right nav navbar-nav" style="float:right"><li><?= '<li>' . CHtml::link($text = 'Log Keluar', Yii::app()->createUrl('/site/logout')) . '</li>'; ?></li></ul>
        
       <?php } ?>
        
    </div>

</nav>


