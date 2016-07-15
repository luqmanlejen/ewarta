<?php

class Menu {

    public static function isActive($menu) {

        if (isset($_GET['page'])) {

            if ($_GET['page'] == $menu)
                return "active";
        }
    }

}

?>
