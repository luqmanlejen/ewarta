<?php

class PortalElement {

    public static function encrypt_decrypt($action, $string) {

        $output = false;

        $encrypt_method = "AES-256-CBC";

        $secret_key = '{*my0p3n$0f+!*}';

        $secret_iv = '[!#@tt0rn3y#]';

        // hash
        $key = hash('sha256', $secret_key);

        // iv - encrypt method AES-256-CBC expects 16 bytes - else you will get a warning
        $iv = substr(hash('sha256', $secret_iv), 0, 16);

        if ($action == 'encrypt') {

            $output = openssl_encrypt($string, $encrypt_method, $key, 0, $iv);

            $output = base64_encode($output);
        } else if ($action == 'decrypt') {

            $output = openssl_decrypt(base64_decode($string), $encrypt_method, $key, 0, $iv);
        }

        return $output;
    }

    public static function isActive($menu) {

        if (isset($_GET['menu_id'])) {

            $decrypted_menuId = PortalElement::encrypt_decrypt('decrypt', $_GET['menu_id']);

            if ($decrypted_menuId == $menu)
                return "active";
        }
    }

    public static function Topmenu() {

        $output = '';

        $model = OstMenuPortal::model()->findAll(array("condition" => "menu_type='header' AND parent_menu=0 AND parent_lang=0 AND hide_ind=0 ORDER BY sort ASC"));

        if (sizeof($model) > 0) {

            foreach ($model as $key => $row) {

                $lastchild = '';

                if (($key + 1) == sizeof($model))
                    $lastchild = 'last-child';

                $drop = '';

                $submenu = '';

                $model2 = OstMenuPortal::model()->findAll(array("condition" => "menu_type='header' AND parent_menu=$row->id AND parent_lang=0 AND hide_ind=0 ORDER BY sort ASC"));

                if (sizeof($model2) > 0) {

                    $drop = 'drop';

                    $submenu = '<ul>';

                    foreach ($model2 as $row2) {

                        $url2 = '#';

                        if ($row2->url != '')
                            $url2 = 'index.php?r=' . $row2->url . '&menu_id=' . PortalElement::encrypt_decrypt('encrypt', $row2->id);

                        $submenu .= '<li class="' . PortalElement::isActive($row2->id) . '">
                                        <a href="' . $url2 . '" title="' . PortalTranslation::TranslateMenu($row2->id, $row2->title) . '">
                                            ' . PortalTranslation::TranslateMenu($row2->id, $row2->title) . '
                                        </a>
                                     </li>';
                    }

                    $submenu.= '</ul>';
                }

                $url = '#';

                if ($row->url != '')
                    $url = 'index.php?r=' . $row->url . '&menu_id=' . PortalElement::encrypt_decrypt('encrypt', $row->id);

                $output.= '<li class="' . $lastchild . ' ' . PortalElement::isActive($row->id) . '">
                                <a class="' . $drop . '" href="' . $url . '" title="' . PortalTranslation::TranslateMenu($row->id, $row->title) . '">
                                    ' . PortalTranslation::TranslateMenu($row->id, $row->title) . '
                                </a>' . $submenu . '
                           </li>';
            }
        }

        return $output;
    }

    public static function GetMasterTitle() {

        $output = '';

        if (isset($_GET['menu_id'])) {

            $menu_id = PortalElement::LoopingToGetMenuParent();

            $model = OstMenuPortal::model()->findByPK($menu_id);

            if (sizeof($model) > 0) {

                $output = PortalTranslation::TranslateMenu($model->id, $model->title);
            }
        }

        return $output;
    }

    public static function LoopingToGetMenuParent() {

        if (isset($_GET['menu_id'])) {

            $menu_id = PortalElement::encrypt_decrypt('decrypt', $_GET['menu_id']);

            $menu_parent_id = PortalElement::GetMenuParent($menu_id);

            while ($menu_parent_id != '0') {

                $menu_id = $menu_parent_id;

                $menu_parent_id = PortalElement::GetMenuParent($menu_id);
            }

            return $menu_id;
        }
    }

    public static function GetMenuParent($id) {

        $model = OstMenuPortal::model()->findByPK($id);

        if (sizeof($model) > 0)
            return $model->parent_menu;
    }

    public static function GetLeftMenu() {

        $output = '';

        if (isset($_GET['menu_id'])) {

            $parent_menu = PortalElement::LoopingToGetMenuParent();

            $output = PortalElement::LoopingToGetLeftMenu($parent_menu, 0);
        }

        return $output;
    }

    public static function LoopingToGetLeftMenu($parent_menu, $loopno) {

        $output = '';

        $model = OstMenuPortal::model()->findAll(array("condition" => "parent_menu=$parent_menu AND parent_lang=0 AND hide_ind=0 ORDER BY sort ASC"));

        if (sizeof($model) > 0) {

            $loopno++;

            foreach ($model as $row) {

                $title = PortalTranslation::TranslateMenu($row->id, $row->title);

                $submenu = PortalElement::LoopingToGetLeftMenu($row->id, $loopno);

                $url = 'javascript:void(0)';

                if ($row->url != '')
                    $url = 'index.php?r=' . $row->url . '&menu_id=' . PortalElement::encrypt_decrypt('encrypt', $row->id);

                if ($submenu != '')
                    $output .= '<li class="leftmenu-li"><a href="javascript:void(0)" class="' . PortalElement::isActive($row->id) . ' leftmenu-title-' . $loopno . '">' . $title . ' <span class="down_arrow"></span></a><ul class="leftmenu-content-' . $loopno . '">' . $submenu . '</ul></li>';
                else
                    $output .= '<li><a href="' . $url . '"  class="' . PortalElement::isActive($row->id) . '">' . $title . '</a></li>';
            }
        }

        return $output;
    }

    public static function GetBreadcrumbs() {

        $output = '';

        $arr = array();

        if (isset($_GET['menu_id'])) {

            $menu_id = PortalElement::encrypt_decrypt('decrypt', $_GET['menu_id']);

            $menu_parent_id = PortalElement::GetMenuParent($menu_id);

            $arr[] = $menu_id;

            while ($menu_parent_id != '0') {

                $menu_id = $menu_parent_id;

                $menu_parent_id = PortalElement::GetMenuParent($menu_id);

                $arr[] = $menu_id;
            }

            $arr[] = 94;

            if (sizeof($arr) > 0) {

                $loop = sizeof($arr) - 1;

                for ($x = $loop; $x >= 0; $x--) {

                    $model = OstMenuPortal::model()->findByPK($arr[$x]);

                    if (sizeof($model) > 0)
                        $output .= PortalTranslation::TranslateMenu($model->id, $model->title);

                    if ($x != '')
                        $output .= '&nbsp;&nbsp;&raquo;&nbsp;&nbsp;';
                }
            }
        }

        return $output;
    }

    public static function GetArticles($field) {

        $output = '';

        if (isset($_GET['menu_id'])) {

            $menu_id = PortalElement::encrypt_decrypt('decrypt', $_GET['menu_id']);

            $sql = "SELECT * FROM ost_articles 
                    WHERE 
                        menu_id=$menu_id AND 
                        approval_sts='publish' AND 
                        parent_id=0 AND 
                        lang='en' AND 
                        (display_type='p' OR (display_type='t' AND DATE(display_startdt)<=DATE(NOW()) AND DATE(display_enddt)>=DATE(NOW())))
                    ORDER BY updated_dt DESC LIMIT 1";

            $model = OstArticles::model()->findAllBySql($sql);
            
            if (sizeof($model) > 0) {

                foreach ($model as $row) {

                    if ($field == 'title')
                        $output = PortalTranslation::TranslateArticles($row->id, $row->title, $field);

                    if ($field == 'content')
                        $output = PortalTranslation::TranslateArticles($row->id, $row->content, $field);
                }
            }
        }

        return $output;
    }

    public static function GetHomeBottomMenu($parent_menu) {

        $output = '';

        $model = OstMenuPortal::model()->findAll(array("condition" => "parent_menu=$parent_menu AND parent_lang=0 AND hide_ind=0 ORDER BY sort ASC"));

        if (sizeof($model) > 0) {

            foreach ($model as $row) {

                $url = '#';

                if ($row->url != '')
                    $url = 'index.php?r=' . $row->url . '&menu_id=' . PortalElement::encrypt_decrypt('encrypt', $row->id);

                $output.= ' <li><a href="' . $url . '">' . PortalTranslation::TranslateMenu($row->id, $row->title) . '</a></li>';
            }
        }

        return $output;
    }
    
    public static function GetPollMenu() {
        
        $output = '';

        $model = OstPoll::model()->findAll(array("condition" => "status=1"));

        if (sizeof($model) > 0) {

            foreach ($model as $row) {

                $url = '#';

//                if ($row->url != '')
//                    $url = 'index.php?r=' . $row->url . '&menu_id=' . PortalElement::encrypt_decrypt('encrypt', $row->id);

                $output.= ' <li><a href="' . $url . '">' . PortalTranslation::TranslateMenu($row->id, $row->question) . '</a></li><br>';
                
                $model2 = OstPollAns::model()->findAll(array("condition" => "question_id=".$row->id));
                
                foreach ($model2 as $row2) {
                    
                    $output.= ' <ul><li><input type="radio">' . PortalTranslation::TranslateMenu($row2->id, $row2->answer) . '</li><br>';
                    
                }
            }
        }

        return $output;
    }

    public static function GetMenuTitle() {

        $output = '';

        if (isset($_GET['menu_id'])) {

            $menu_id = PortalElement::encrypt_decrypt('decrypt', $_GET['menu_id']);

            $model = OstMenuPortal::model()->findByPk($menu_id);

            if (sizeof($model) > 0)
                $output = PortalTranslation::TranslateMenu($model->id, $model->title);
        }

        return $output;
    }

    public static function GetLom() {

        $output = '';

        $model = OstLom::model()->findAll(array("condition" => "lom_parent_lang=0 AND lom_lang='en' GROUP BY lom_no ORDER BY lom_no DESC"));

        if (sizeof($model) > 0) {

            foreach ($model as $row) {

                echo '<tr>
                        <td>' . $row->lom_no . '</td>
                        <td><a href="' . $row->lom_doc . '" target="_blank" class="linklom">' . PortalTranslation::TranslateLomTitle($row->id, $row->lom_title) . '</a>';

                $model3 = OstLom::model()->findAll(array("condition" => "lom_parent_lang=0 AND lom_lang='en' AND online='1' AND lom_no='$row->lom_no' ORDER BY lom_no DESC"));

                if (sizeof($model3) > 0) {

                    foreach ($model3 as $row3) {

                        if ($row->lom_no === $row3->lom_no) {

                            echo '<br><a href="' . $row3->lom_doc . '" target="_blank" class="linklom">' . PortalTranslation::TranslateLomTitle($row3->id, $row3->lom_title) . '</a>';
                        }
                    }
                }

                $model2 = OstLom::model()->findAll(array("condition" => "lom_rev=1 AND lom_no='$row->lom_no' ORDER BY lom_no DESC"));

                if (sizeof($model2) > 0) {

                    foreach ($model2 as $row2) {

                        if ($row->lom_no === $row2->lom_no)
                            echo '<br><a href="' . $row2->lom_doc . '" target="_blank" class="linklom">' . PortalTranslation::TranslateLomTitle($row2->id, $row2->lom_title) . '</a>';
                    }
                }

                echo '
                        </td>
                        <td align="center">' . $row->lom_year_rev . '</td>
                        <td align="center">' . $row->hits . '</td>
                    </tr>';
            }
        }
    }

    public static function GetLom2($postkeyword, $postrev, $postcat, $postcat_sub) {
        $output = '';
        $model = $postkeyword; //OstLom::model()->findAll(array("condition" => "lom_parent_lang=0 AND lom_lang='en' GROUP BY lom_no ORDER BY lom_no DESC"));

        if ($postrev != 1) {
            if (sizeof($model) > 0) {

                foreach ($model as $row) {
                    echo '<tr>
                            <td>' . $row->lom_no . '</td>
                            <td><a href="' . $row->lom_doc . '" target="_blank" class="linklom">' . PortalTranslation::TranslateLomTitle($row->id, $row->lom_title) . '</a>';
                    //var_dump($row->lom_no);
                    //                if($row->online != 0) {
                    $model3 = OstLom::model()->findAll(array("condition" => "lom_parent_lang=0 AND online='1' AND lom_no='$row->lom_no' ORDER BY lom_no DESC"));
                    if (sizeof($model3) > 0) {

                        foreach ($model3 as $row3) {
                            if ($row->lom_no === $row3->lom_no) {
                                echo '
                                        <br><a href="' . $row3->lom_doc . '" target="_blank" class="linklom">' . PortalTranslation::TranslateLomTitle($row3->id, $row3->lom_title) . '</a>
                               ';
                                //$row3->lom_title
                            }
                        }
                    }
                    //                }
                    //                if($row->lom_rev != 0) {
                    $model2 = OstLom::model()->findAll(array("condition" => "lom_rev=1 AND lom_no='$row->lom_no' ORDER BY lom_no DESC"));
                    if (sizeof($model2) > 0) {
                        foreach ($model2 as $row2) {
                            if ($row->lom_no === $row2->lom_no)
                                echo '
                                        <br><a href="' . $row2->lom_doc . '" target="_blank" class="linklom">' . PortalTranslation::TranslateLomTitle($row2->id, $row2->lom_title) . '</a>
                               ';
                        }
                    }
                    //}


                    echo '
                            </td>
                            <td align="center">' . $row->lom_year_rev . '</td>
                            <td align="center">' . $row->hits . '</td>
                        </tr>';
                }
            }
        }else {
            $model = OstLom::model()->findAll(array("condition" => "lom_parent_lang=0 AND lom_rev=1 GROUP BY lom_no ORDER BY lom_no DESC"));
            if (sizeof($model) > 0) {

                foreach ($model as $row) {
                    echo '<tr>
                            <td>' . $row->lom_no . '</td>
                            <td><a href="' . $row->lom_doc . '" target="_blank" class="linklom">' . PortalTranslation::TranslateLomTitle($row->id, $row->lom_title) . '</a>';
                    //var_dump($row->lom_no);
                    //                if($row->online != 0) {
                    $model3 = OstLom::model()->findAll(array("condition" => "lom_parent_lang=0 AND online='1' AND lom_no='$row->lom_no' ORDER BY lom_no DESC"));
                    if (sizeof($model3) > 0) {

                        foreach ($model3 as $row3) {
                            if ($row->lom_no === $row3->lom_no) {
                                echo '
                                        <br><a href="' . $row3->lom_doc . '" target="_blank" class="linklom">' . PortalTranslation::TranslateLomTitle($row3->id, $row3->lom_title) . '</a>
                               ';
                                //$row3->lom_title
                            }
                        }
                    }
                    //                }
                    //                if($row->lom_rev != 0) {
                    $model2 = OstLom::model()->findAll(array("condition" => "lom_rev=1 AND lom_no='$row->lom_no' ORDER BY lom_no DESC"));
                    if (sizeof($model2) > 0) {
                        foreach ($model2 as $row2) {
                            if ($row->lom_no === $row2->lom_no)
                                echo '<br><a href="' . $row2->lom_doc . '" target="_blank" class="linklom">' . PortalTranslation::TranslateLomTitle($row2->id, $row2->lom_title) . '</a>';
                        }
                    }
                    //}


                    echo '
                            </td>
                            <td align="center">' . $row->lom_year_rev . '</td>
                            <td align="center">' . $row->hits . '</td>
                        </tr>';
                }
            }
        }
    }
    
    public static function pagination($limit, $total_pages, $page, $targetpage) {

        $trans_pag_next = 'Next';

        $trans_pag_prev = 'Previous';

        if (Yii::app()->session['lang'] == 'my') {

            $trans_pag_next = 'Seterusnya';

            $trans_pag_prev = 'Sebelumnya';
        }

        $adjacents = 1;

        /* Setup page vars for display. */

        if ($page == 0)
            $page = 1;     //if no page var is given, default to 1.

        $prev = $page - 1;       //previous page is page - 1

        $next = $page + 1;       //next page is page + 1

        $lastpage = ceil($total_pages / $limit);  //lastpage is = total pages / items per page, rounded up.

        $lpm1 = $lastpage - 1;      //last page minus 1

        /* Now we apply our rules and draw the pagination object.We're actually saving the code to a variable in case we want to draw it more than once. */

        $pagination = "";

        if ($lastpage > 1) {

            $pagination .= "<div class=\"pagination\">";

            //previous button

            if ($page > 1)
                $pagination.= "<a href=\"$targetpage&page=$prev\">$trans_pag_prev</a>";
            else
                $pagination.= "<span class=\"disabled\">$trans_pag_prev</span>";

            //pages	

            if ($lastpage < 7 + ($adjacents * 2)) { //not enough pages to bother breaking it up
                for ($counter = 1; $counter <= $lastpage; $counter++) {

                    if ($counter == $page)
                        $pagination.= "<span class=\"current\">$counter</span>";
                    else
                        $pagination.= "<a href=\"$targetpage&page=$counter\">$counter</a>";
                }
            }

            elseif ($lastpage > 5 + ($adjacents * 2)) { //enough pages to hide some
                //close to beginning; only hide later pages
                if ($page < 1 + ($adjacents * 2)) {

                    for ($counter = 1; $counter < 4 + ($adjacents * 2); $counter++) {

                        if ($counter == $page)
                            $pagination.= "<span class=\"current\">$counter</span>";
                        else
                            $pagination.= "<a href=\"$targetpage&page=$counter\">$counter</a>";
                    }

                    $pagination.= "...";

                    $pagination.= "<a href=\"$targetpage&page=$lpm1\">$lpm1</a>";

                    $pagination.= "<a href=\"$targetpage&page=$lastpage\">$lastpage</a>";
                }

                //in middle; hide some front and some back

                elseif ($lastpage - ($adjacents * 2) > $page && $page > ($adjacents * 2)) {

                    $pagination.= "<a href=\"$targetpage&page=1\">1</a>";

                    $pagination.= "<a href=\"$targetpage&page=2\">2</a>";

                    $pagination.= "...";

                    for ($counter = $page - $adjacents; $counter <= $page + $adjacents; $counter++) {

                        if ($counter == $page)
                            $pagination.= "<span class=\"current\">$counter</span>";
                        else
                            $pagination.= "<a href=\"$targetpage&page=$counter\">$counter</a>";
                    }

                    $pagination.= "...";

                    $pagination.= "<a href=\"$targetpage&page=$lpm1\">$lpm1</a>";

                    $pagination.= "<a href=\"$targetpage&page=$lastpage\">$lastpage</a>";
                }

                //close to end; only hide early pages

                else {

                    $pagination.= "<a href=\"$targetpage&page=1\">1</a>";

                    $pagination.= "<a href=\"$targetpage&page=2\">2</a>";

                    $pagination.= "...";

                    for ($counter = $lastpage - (2 + ($adjacents * 2)); $counter <= $lastpage; $counter++) {

                        if ($counter == $page)
                            $pagination.= "<span class=\"current\">$counter</span>";
                        else
                            $pagination.= "<a href=\"$targetpage&page=$counter\">$counter</a>";
                    }
                }
            }

            //next button
            if ($page < $counter - 1)
                $pagination.= "<a href=\"$targetpage&page=$next\">$trans_pag_next</a>";
            else
                $pagination.= "<span class=\"disabled\">$trans_pag_next</span>";

            $pagination.= "</div>\n";
        }

        return $pagination;
    }

    public static function GetMediaList($media_type) {

        $output = array();

        if (strlen($media_type) <= 10) {

            $model = OstMedia::model()->findAll(array("condition" => "media_type='$media_type' AND parent_id=0 AND lang='en' ORDER BY updated_dt DESC"));

            if (sizeof($model) > 0) {

                foreach ($model as $row) {

                    $output2 = array();

                    $output2['title'] = PortalTranslation::TranslateMedia($row->id, $row->title, 'title');

                    $output2['url'] = $row->url;

                    $output2['img'] = PortalTranslation::TranslateMedia($row->id, $row->img, 'img');

                    $output[] = $output2;
                }
            }
        }

        return $output;
    }

    public static function GetArticleList($menu_list) {

        $output = array();

        $sql = "SELECT * FROM ost_articles 
                    WHERE 
                        menu_id IN ($menu_list) AND 
                        approval_sts='publish' AND 
                        parent_id=0 AND 
                        lang='en' AND 
                        view_latest = 0 AND
                        (display_type='p' OR (display_type='t' AND DATE(display_startdt)<=DATE(NOW()) AND DATE(display_enddt)>=DATE(NOW())))
                    ORDER BY created_dt DESC";

        $model = OstArticles::model()->findAllBySql($sql);

        if (sizeof($model) > 0) {

            foreach ($model as $row) {

                $output2 = array();

                $output2['title'] = PortalTranslation::TranslateArticles($row->id, $row->title, 'title');

                $output2['url'] = 'index.php?r=portal2/article&menu_id=' . PortalElement::encrypt_decrypt('encrypt', $row->menu_id) . '&artikel_id=' . PortalElement::encrypt_decrypt('encrypt', $row->id);

                $output[] = $output2;
            }
        }

        return $output;
    }
    
    public static function GetTenderList($menu_list) {

        $output = array();

        $sql = "SELECT * FROM ost_articles 
                    WHERE 
                        menu_id IN ($menu_list) AND 
                        approval_sts='publish' AND 
                        parent_id=0 AND 
                        lang='en' AND
                        view_latest = 1 AND
                        (display_type='p' OR (display_type='t' AND DATE(display_startdt)<=DATE(NOW()) AND DATE(display_enddt)>=DATE(NOW())))
                    ORDER BY created_dt DESC";

        $model = OstArticles::model()->findAllBySql($sql);

        if (sizeof($model) > 0) {

            foreach ($model as $row) {

                $output2 = array();

                $output2['title'] = PortalTranslation::TranslateArticles($row->id, $row->title, 'title');

                $output2['url'] = 'index.php?r=portal2/article&menu_id=' . PortalElement::encrypt_decrypt('encrypt', $row->menu_id) . '&artikel_id=' . PortalElement::encrypt_decrypt('encrypt', $row->id);

                $output[] = $output2;
            }
        }

        return $output;
    }
    
    public static function GetArticleListLatest($menu_list) {

        $output = array();

        $sql = "SELECT * FROM ost_articles 
                    WHERE 
                        menu_id IN ($menu_list) AND 
                        approval_sts='publish' AND 
                        parent_id=0 AND 
                        lang='en' AND
                        view_latest=1 AND
                        (display_type='p' OR (display_type='t' AND DATE(display_startdt)<=DATE(NOW()) AND DATE(display_enddt)>=DATE(NOW())))
                    ORDER BY created_dt DESC";

        $model = OstArticles::model()->findAllBySql($sql);

        if (sizeof($model) > 0) {

            foreach ($model as $row) {

                $output2 = array();

                $output2['title'] = PortalTranslation::TranslateArticles($row->id, $row->title, 'title');

                $output2['url'] = 'index.php?r=portal2/article&menu_id=' . PortalElement::encrypt_decrypt('encrypt', $row->menu_id) . '&artikel_id=' . PortalElement::encrypt_decrypt('encrypt', $row->id);

                $output[] = $output2;
            }
        }

        return $output;
    }   
    
    public static function GetTenderListLatest($menu_list) {

        $output = array();

        $sql = "SELECT * FROM ost_articles 
                    WHERE 
                        menu_id IN ($menu_list) AND 
                        approval_sts='publish' AND 
                        parent_id=0 AND 
                        lang='en' AND
                        view_latest=1 AND
                        (display_type='p' OR (display_type='t' AND DATE(display_startdt)<=DATE(NOW()) AND DATE(display_enddt)>=DATE(NOW())))
                    ORDER BY created_dt DESC";

        $model = OstArticles::model()->findAllBySql($sql);

        if (sizeof($model) > 0) {

            foreach ($model as $row) {

                $output2 = array();

                $output2['title'] = PortalTranslation::TranslateArticles($row->id, $row->title, 'title');

                $output2['url'] = 'index.php?r=portal2/article&menu_id=' . PortalElement::encrypt_decrypt('encrypt', $row->menu_id) . '&artikel_id=' . PortalElement::encrypt_decrypt('encrypt', $row->id);

                $output[] = $output2;
            }
        }

        return $output;
    }

    public static function GetArticleDetails($id, $field) {

        $output = '';

        $decrypt_id = PortalElement::encrypt_decrypt('decrypt', $id);
        
        if (is_numeric($decrypt_id)) {
            //$model = OstArticles::model()->findByPk($decrypt_id);
            $model = OstArticles::model()->findByAttributes(array('menu_id' => $decrypt_id));
            
            if (sizeof($model) > 0) {

                if ($field == 'title')
                    $output = PortalTranslation::TranslateArticles($model->id, $model->title, 'title');
                if ($field == 'content')
                    $output = PortalTranslation::TranslateArticles($model->id, $model->content, 'content');
            }
        }

        return $output;
    }
    
    public function actionPublicationCounter() {
        
        $id = $_GET['id'];
        $model = OstPublication::model()->findByPK($id);
        if (sizeof($model) > 0) {
            $hits = $model->hits + 1;
            OstPublication::model()->updateByPk($model->id, array('hits' => $hits));
        }
        $this->redirect($model->lom_doc);
    }
}