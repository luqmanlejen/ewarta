<ul class="nav nav-list" id="leftmenu">
    <li id="menu1">
        <a href="" class="dropdown-toggle">
            <span class="menu-text">
                CMS Administration
            </span>

            <b class="arrow fa fa-angle-down"></b>
        </a>

        <b class="arrow"></b>

        <ul class="submenu">
            <li id="menu2">
                <a href="index.php?r=ostRef/admin">Manage Parameter</a>
            </li>
        </ul>
        
        <ul class="submenu">
            <li id="menu3">
                <a href="index.php?r=ostMenu/admin">Manage Menu</a>
            </li>
        </ul>
    </li>
    
    <li id="menu5">
        <a href="" class="dropdown-toggle">
            <span class="menu-text">
                User Administration
            </span>

            <b class="arrow fa fa-angle-down"></b>
        </a>

        <b class="arrow"></b>

        <ul class="submenu">
            <li id="menu6">
                <a href="index.php?r=ostUser/admin">Manage CMS User</a>
            </li>
        </ul>
    </li>

</ul><!-- /.nav-list -->

<script type="text/javascript">
    function activemenu(menuone, menutwo) {
        $("#leftmenu li").removeClass("active");
        $("#leftmenu li").removeClass("open");
        $("#leftmenu #"+menuone).addClass("active open");

        $("#leftmenu ul li").removeClass("active");
        $("#leftmenu ul li").removeClass("open");
        $("#leftmenu #"+menutwo).addClass("active");
    }    
</script>