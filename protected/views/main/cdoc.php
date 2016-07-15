<?php

$oCommon = new CommonElement();

$url = Yii::app()->request->url;

$id = filter_var($_GET['id'],FILTER_SANITIZE_FULL_SPECIAL_CHARS);

$home = 'Anjung';

$bmonth = array("", "Januari", "Februari", "Mac", "April", "Mei", "Jun", "Julai", "Ogos", "September", "Oktober", "November", "Disember");

$bkeyword = 'Kata Kunci';

$year = 'Tahun';

$bulan = 'Bulan';

$search = 'Cari';

$all = 'Semua';

$displayall = 'Papar Semua';

$tajuk = 'Tajuk';

$dt = 'Tarikh';

$dl = 'Muat turun';

if (isset(Yii::app()->session['lang']) && Yii::app()->session['lang'] == 'eng') {
    
    $home = 'Home';
    
    $bmonth = array("", "January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December");

    $bkeyword = 'Keyword';
    
    $year = 'Year';

    $bulan = 'Month';

    $search = 'Search';

    $all = 'All';

    $displayall = 'Display All';
    
    $tajuk = 'Title';

    $dt = 'Date';
    
    $dl = 'Downloads';
}


$output = '';

$count = 1;

if($news_rows != null){
    foreach($news_rows as $news) {
        
        $title = $news->title;
        
        if (isset(Yii::app()->session['lang']) && Yii::app()->session['lang'] == 'eng') {
            
            $title = $news->title_eng;
           
        }
        
        $output.= '<tr>

                       <td>'. $count .'</td>
                           
                       <td style="text-align:left">'. $title .'</td>
                           
                       <td>'. $news->hits .'</td>
                           
                       <td>'. date("j F Y",strtotime($news->date)) .'</td>';
        
        $cat1 = filter_var($_GET['cat1'],FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        
        if($cat1){
            if(Yii::app()->session['userfe_id'] != '') {
                $output .= '<td><a target="_blank" onClick="addCount('.$news->id.')" href="'. $news->link .'"><img src="images/pdf.gif" alt="icon"></a></td>';
            }
        }else if(!$cat1){
            $output .= '<td><a target="_blank" onClick="addCount('.$news->id.')" href="'. $news->link .'"><img src="images/pdf.gif" alt="icon"></a></td>';
        }
                       
        $output .= '</tr>';
        
        $count++;
    }
} else {
    
    $output = '<tr>
                  <td>-</td>
                  <td style="text-align:left">-</td>
                  <td>-</td>
                  <td>-</td>';
    
    if(isset($_GET['cat1'])){
            if(Yii::app()->session['userfe_id'] != '') {
                $output .= '<td>-</td>';
            }
        }else if(!isset($_GET['cat1'])){
            $output .= '<td>-</td>';
        }
                  
     $output .= '</tr>';
}


?>

<script>
(function($, R) {

    R.action(function() {

         if (R.viewportW() < 800) {
            
                    var test1 = $("#td1");
					var test2 = $("#td3");
					var test3 = $("#td5");
					var test4 = $("#td6");
					
					if ( test1.parent().is( "tr" ) ) {
						test1.unwrap();
					}
					
					if ( test2.parent().is( "tr" ) ) {
						test2.unwrap();
					}
					
					if ( test3.parent().is( "tr" ) ) {
						test3.unwrap();
					}
					
					if ( test4.parent().is( "tr" ) ) {
						test4.unwrap();
					}
					
					if ( !(test1.parent()).is( "tr" ) ) {
						$('#td1, #td2').wrapAll('<tr/>');
						$('#td3, #td4').wrapAll('<tr/>');
						$('#td5').wrap('<tr/>');
						$('#td6, #td7').wrapAll('<tr/>');
					}

            } else {
				
				var test1 = $("#td1");
				var test2 = $("#td3");
				var test3 = $("#td5");
				var test4 = $("#td6");
				
                if ( test1.parent().is( "tr" ) ) {
					test1.unwrap();
				}
				
				if ( test2.parent().is( "tr" ) ) {
					test2.unwrap();
				}
				
				if ( test3.parent().is( "tr" ) ) {
					test3.unwrap();
				}
				
				if ( test4.parent().is( "tr" ) ) {
					test4.unwrap();
				}
				
				$('#td1, #td2, #td3, #td4, #td5, #td6, #td7').wrapAll('<tr/>');
            }
    });
 
}(this.jQuery, this.Response));

function addCount(id){
    
    $.ajax({
            type: "post",
            url: "./protected/views/column/cdoc_handler.php",
            data: "id=" + id,
            success: function(data) {

                location.reload();

            }
        });
}
</script>

<div class="wrapper row3">
    
    <div id="container">
        
        <div id="sidebar_1" class="sidebar one_quarter first">
            <aside>
              <!-- ########################################################################################## -->
              <h2><?php echo $this->content_title; ?></h2>
              <nav>
                  <ul>
                        <?php echo $this->content_menu; ?>
                  </ul>
              </nav>
              <!-- /nav -->


                  <!-- ########################################################################################## -->
            </aside>
          </div>
              <!-- ################################################################################################ -->
          <div class="three_quarter">

                  <div class="breadcrumbs">
                      
                     <!--<img src="images/demo/bannerHeader_demo.jpg" alt="header banner"><br>  // content Header banner --> 
                      
                      <span style="font-size: smaller"><a href="index.php"><?= $home ?></a><?php echo $this->breadcrumbs_list; ?></span>
                  
                  </div>

                  <form method="post" action="<?= $url ?>" id="beritaform">
    
                    <table>
                        <tbody>

                            <tr>

                                <td style="padding: 10px" id="td1"><?= $year?> : </td>

                                <td id="td2"><select name="post_btahun" onchange="changemonth()">

                                    <option value=""><?= $all ?></option>    
                                <?php
                                    for ($z = date('Y'); $z >= 2010; $z--) {

                                        $selected = '';

                                        if ($z == $post_btahun)
                                            $selected = 'selected';

                                        echo '<option value="' . $z . '" ' . $selected . '>' . $z . '</option>';
                                    }
                                    ?>
                                    </select></td>
                                
                                 <td style="padding: 10px" id="td3"><?= $bulan ?>: </td>

                                <td id="td4"><select name="post_bmonth">

                                        <option value=""><?= $all ?></option> 

                                        <?php
                                            for ($y = 1; $y < sizeof($bmonth); $y++) {

                                                $selected = '';

                                                if ($y == $post_bmonth)
                                                    $selected = 'selected';

                                                echo '<option value="' . $y . '" ' . $selected . '>' . $bmonth[$y] . '</option>';
                                            }
                                        ?>

                                    </select></td>
                                
                           
                                    <td colspan="2" id="td5"><input type="text" name="post_bkey" placeholder="<?= $bkeyword ?>" value="<?= addslashes($post_bkey) ?>"></td>
                                
                                <td id="td6"><input type="button" value="<?= $search ?>" class="button black" onclick="displayall(1)"></td>

                                <td id="td7"><input type="button" value="<?= $displayall ?>" class="button red" onclick="displayall(2)"></td>

                            </tr>

                        </tbody>

                    </table>
                      
                  </form>
              
              <table style="text-align: center">
                  <tr>
                      <th style="width: 5%">No.</th>
                      <th style="width: 50%"><?= $tajuk ?></th>
                      <th style="width: 15%">Hits</th>
                      <th><?= $dt ?></th>
                      <?php
                      
                        if(isset($_GET['cat1'])){
                            if(Yii::app()->session['userfe_id'] != '') {
                                echo '<th>'.$dl.'</th>';
                            }
                        }else if(!isset($_GET['cat1'])){
                            echo '<th>'.$dl.'</th>';
                        }
                      ?>
                  </tr>
                  
                  <?php echo $output ?>

              </table>
              
              <center><?php $this->widget('CLinkPager',array('pages'=>$pages, 'header'=>'')); ?></center><br><br>
                  
          </div>
          <!-- ################################################################################################ -->
          <div class="clear"></div>  

    </div>
    
</div>

<script>

$(function() {

    changemonth();

});

function displayall(btn) {

    $("[name=post_bmonth]").removeAttr("disabled");

    if (btn == 2) {

        $("[name=post_btahun]").val('');

        $("[name=post_bmonth]").val('');
        
        $("[name=post_bkey]").val('');

    }

    $("#beritaform").submit();

}

function changemonth() {

    var tahun = $("[name=post_btahun]").val();

    if (tahun == '') {

        $("[name=post_bmonth]").val('');  

        $("[name=post_bmonth]").prop('disabled', 'disabled');

    } else {

        $("[name=post_bmonth]").removeAttr("disabled");

    }

}

</script>
