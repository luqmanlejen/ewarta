<?php
$title = 'Articles';
$leftmenuno = '29';
$exturl = '';

if (isset($_GET['menu_id'])) {

    //Activities
    if ($_GET['menu_id'] == '192') {
        $title = 'Activities';
        $leftmenuno = '10';
        $exturl = '&menu_id=192';
    }

    //Announcement
    if ($_GET['menu_id'] == '190') {
        $title = 'Announcement';
        $leftmenuno = '11';
        $exturl = '&menu_id=190';
    }

    //News
    if ($_GET['menu_id'] == '194') {
        $title = 'News';
        $leftmenuno = '12';
        $exturl = '&menu_id=194';
    }
}
?>

<script>
    $(function() {
        activemenu('17', <?php echo $leftmenuno; ?>);
    });
</script>