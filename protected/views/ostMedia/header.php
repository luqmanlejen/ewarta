<?php
$title = 'Media Administration';
$leftmenuno = '12';
$exturl = '';

if (isset($_GET['media_type'])) {
    
    //Background
    if ($_GET['media_type'] == 'background') {
        $title = 'Background';
        $leftmenuno = '331';
        $exturl = '&media_type=background';
    }
    
    //Slider Public
    if ($_GET['media_type'] == 'slider') {
        $title = 'Slider Public';
        $leftmenuno = '19';
        $exturl = '&media_type=slider';
    }
    
    //Slider Public2
    if ($_GET['media_type'] == 'slider2') {
        $title = 'Slider Business';
        $leftmenuno = '332';
        $exturl = '&media_type=slider2';
    }
    
    //Video
    if ($_GET['media_type'] == 'video') {
        $title = 'Video Gallery';
        $leftmenuno = '17';
        $exturl = '&media_type=video';
    }

    //Audio
    if ($_GET['media_type'] == 'audio') {
        $title = 'Audio Gallery';
        $leftmenuno = '18';
        $exturl = '&media_type=audio';
    }
    
    //Online Services
    if ($_GET['media_type'] == 'online') {
        $title = 'Online Service';
        $leftmenuno = '13';
        $exturl = '&media_type=online';
    }
}
?>

<script>
    $(function() {
        activemenu('15', <?php echo $leftmenuno; ?>);
    });
</script>