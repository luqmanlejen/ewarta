<?php

$oCommon = new CommonElement();

$url = Yii::app()->request->url;

$id = $_GET['id'];

$home = 'Anjung';

$bmonth = array("", "Januari", "Februari", "Mac", "April", "Mei", "Jun", "Julai", "Ogos", "September", "Oktober", "November", "Disember");

$bkeyword = 'Kata Kunci';

$year = 'Tahun';

$bulan = 'Bulan';

$search = 'Cari';

$all = 'Semua';

$displayall = 'Papar Semua';

$tajuk = 'Tajuk';

$sdt = 'Tarikh Mula';

$edt = 'Tarikh Tamat';

if (isset(Yii::app()->session['lang']) && Yii::app()->session['lang'] == 'eng') {
    
    $home = 'Home';
    
    $bmonth = array("", "January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December");

    $bkeyword = 'Keyword';
    
    $year = 'Year';

    $bulan = 'Month';

    $search = 'Search';

    $all = 'All';

    $displayall = 'Display All';
    
    $tajuk = 'Tajuk';
    
    $sdt = 'Start Date';

    $edt = 'End Date';

}

$post_bkey = '';

$post_btahun = '';

$post_bmonth = '';

if (isset($_POST['post_btahun'])) {

    if ($_POST['post_btahun'] == '')
        $post_btahun = '';
    else
        $post_btahun = $_POST['post_btahun'];
}

if (isset($_POST['post_bmonth'])) {

    if ($_POST['post_bmonth'] == '')
        $post_bmonth = '';
    else
        $post_bmonth = sprintf("%02s", $_POST['post_bmonth']);
}

if (isset($_POST['post_bkey'])) {

    if ($_POST['post_bkey'] == '')
        $post_bkey = '';
    else
        $post_bkey = $_POST['post_bkey'];
}

$sqlext_imp = '';

$sqlext = '';



if ($post_bkey != ''){
    $sqlext[0] = "title ILIKE '%" . (string) $post_bkey ."%'";
    
    if (isset(Yii::app()->session['lang']) && Yii::app()->session['lang'] == 'eng') {
        
        $sqlext[0] = "title_eng ILIKE '%" . (string) $post_bkey ."%'";
    }
}

if ($post_btahun != '')
    $sqlext[] = 'extract(year from start_dt) = ' . (int) $post_btahun;

if ($post_bmonth != '')
    $sqlext[] = 'extract(month from start_dt) = ' . (int) $post_bmonth;

if ($sqlext != '')
    $sqlext_imp = implode(' AND ', $sqlext);

$output = '';

$count = 1;

$news_rows = CmsProgram::model()->findAll(array('condition' => $sqlext_imp, 'order' => 'start_dt DESC'));

if($news_rows != null){
    foreach($news_rows as $news) {
        
        $title = $news->title;
        
        if (isset(Yii::app()->session['lang']) && Yii::app()->session['lang'] == 'eng') {
            
            $title = $news->title_eng;
           
        }
        
        $newsid_encrypt = $oCommon->encrypt_decrypt('encrypt', $news->id);
        
        $output.= '<tr>
                       
                     

                       <td>'. $count .'</td>
                           
                       <td style="text-align:left"><a href="index.php?r=column/cprogram_view&id='.$id.'&program_view='. $newsid_encrypt .'">'. $title .'</a></td>
                           
                       <td>'. date("j F Y",strtotime($news->start_dt)) .'</td>

                       <td>'. date("j F Y",strtotime($news->end_dt)) .'</td>

                   </tr>';
        
        $count++;
    }
} else {
    
    $output = '<tr>
                  <td>-</td>
                  <td style="text-align:left">-</td>
                  <td>-</td>
                  <td>-</td>
               </tr>';
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
                                
                           
                                <td colspan="2" id="td5"><input type="text" name="post_bkey" placeholder="<?= $bkeyword ?>" value="<?= $post_bkey ?>"></td>
                                
                                <td id="td6"><input type="button" value="<?= $search ?>" class="button black" onclick="displayall(1)"></td>

                                <td id="td7"><input type="button" value="<?= $displayall ?>" class="button red" onclick="displayall(2)"></td>

                            </tr>

                        </tbody>

                    </table>
                      
                  </form>
              
              <table style="text-align: center">
                  <tr>
                      <th style="width: 5%">No.</th>
                      <th><?= $tajuk ?></th>
                      <th style="width: 20%"><?= $sdt ?></th>
                      <th style="width: 20%"><?= $edt ?></th>
                  </tr>
                  
                  <?php echo $output ?>

              </table>
                  
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
