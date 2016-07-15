<?php

class PortalElement2 {

    public static function getContent($cat_type) {

        $output = '';

        $sql = "SELECT e.content, e.menu_id FROM ost_menu a 
                    INNER JOIN ost_categories b ON a.menu_id = b.id 
                    INNER JOIN ost_user_role c ON a.id = c.menu_id 
                    INNER JOIN ost_article d ON a.bulletin_id = d.id 
                    INNER JOIN cms_bulletin_content e ON e.bulletin_id = a.bulletin_id 
                WHERE 
                    a.menu_cat = 'mlayout' AND 
                    a.hide_ind = 0 AND 
                    c.role_code = 'pub' AND 
                    b.cat_type = '" . $cat_type . "' AND 
                    b.status = 'psh' AND b.access = 'pub' AND 
                    b.level = 1 AND b.parent_id = 1 AND 
                    d.status = 'psh' AND d.access = 'pub' AND 
                    d.approval_sts = 'app' AND d.cat = a.cat_id";

        $model = BulletinContent::model()->findBySql($sql);

        if (sizeof($model) > 0)
            $output = CommonTranslation::TranslateArticleContent($model->bulletin_id, $model->content);

        return $output;
    }

    public static function getTitle($cat_type) {

        $output = '';

        $sql = "SELECT a.menu_txt, a.id FROM mod_ost_menu a 
                    INNER JOIN cms_categories b ON a.cat_id = b.id 
                    INNER JOIN mod_role_mapping c ON a.id = c.menu_id 
                    INNER JOIN cms_bulletin d ON a.bulletin_id = d.id 
                    INNER JOIN cms_bulletin_content e ON e.bulletin_id = a.bulletin_id 
                WHERE 
                    a.menu_cat = 'mlayout' AND 
                    a.hide_ind = 0 AND 
                    c.role_code = 'pub' AND 
                    b.cat_type = '" . $cat_type . "' AND 
                    b.status = 'psh' AND b.access = 'pub' AND 
                    b.level = 1 AND b.parent_id = 1 AND 
                    d.status = 'psh' AND d.access = 'pub' AND 
                    d.approval_sts = 'app' AND d.cat = a.cat_id";

        $model = OstMenu::model()->findBySql($sql);

        if (sizeof($model) > 0)
            $output = PortalTranslation::TranslateMenu($model->id, $model->menu_txt);

        return $output;
    }

    public static function strip_html_tags($text) {

        $text = preg_replace(
                array(
            // Remove invisible content
            '@<head[^>]*?>.*?</head>@siu',
            '@<style[^>]*?>.*?</style>@siu',
            '@<script[^>]*?.*?</script>@siu',
            '@<object[^>]*?.*?</object>@siu',
            '@<embed[^>]*?.*?</embed>@siu',
            '@<applet[^>]*?.*?</applet>@siu',
            '@<noframes[^>]*?.*?</noframes>@siu',
            '@<noscript[^>]*?.*?</noscript>@siu',
            '@<noembed[^>]*?.*?</noembed>@siu',
            // Add line breaks before and after blocks
            '@</?((address)|(blockquote)|(center)|(del))@iu',
            '@</?((div)|(h[1-9])|(ins)|(isindex)|(p)|(pre))@iu',
            '@</?((dir)|(dl)|(dt)|(dd)|(li)|(menu)|(ol)|(ul))@iu',
            '@</?((table)|(th)|(td)|(caption))@iu',
            '@</?((form)|(button)|(fieldset)|(legend)|(input))@iu',
            '@</?((label)|(select)|(optgroup)|(option)|(textarea))@iu',
            '@</?((frameset)|(frame)|(iframe))@iu',
                ), array(
            ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ',
            "\n\$0", "\n\$0", "\n\$0", "\n\$0", "\n\$0", "\n\$0",
            "\n\$0", "\n\$0",
                ), $text);
        return strip_tags($text);
    }

}
?>