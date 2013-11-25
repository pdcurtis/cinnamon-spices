

<div id="main">
        	<div id="post-content" class="clearfix">
				        		<h1 class="page-title">Themes</h1>	
                                                                                                                     
    <p>To install a theme: Download it and decompress it in ~/.themes.</p>

<?php if($latest->num_rows > 0) {
    alternator();
    ?>
<div class="greydiv">    
    <h4 align="center">Latest</h4>
    <table border="0" cellspacing="10" cellpadding="0">    
    <tbody><tr>        
        <?php foreach($latest->result() as $theme):            
            $thumb = str_replace("themes", "themes/thumbs", $theme->screenshot);
            if (file_exists(FCPATH.$thumb)) {        
                $screenshot = "src='$thumb'";
            }
            else {
                $screenshot = "src='$theme->screenshot' width='100'";
            }            
            $array = preg_split("/,/", timespan($theme->last_edited, time()));        
            $time_span = strtolower($array[0])." ago";
            $time_actual = date("Y-m-d, H:i", $theme->last_edited);
            $score = "Score: ".$theme->score;            
        ?>
            <td style="vertical-align: bottom;" align="center">
                <center>
                    <div class="wp-caption alignnone" style="width: 120px; border: 1px solid #a5a5a5;">                        
                    <?=anchor("themes/view/$theme->id", "<img $screenshot/>")?>
                    <p class="wp-caption-text"><?=anchor("themes/view/$theme->id", "$theme->name")?><br/><?=$score?><br/><span title="<?=$time_actual?>"><?=$time_span?></span></p>
                    </div>
                </center></td>
            <?= alternator('', '', '', '', '</tr><tr>') ?>
        <?php endforeach;?>
        </tr>
    </tbody>
    </table>
</div>
<?php } ?>

<?php if($popular->num_rows > 0) {
    alternator();
    ?>
<div class="greydiv">
    <h4 align="center">Most popular</h4>
    <table border="0" cellspacing="10" cellpadding="0">    
    <tbody><tr>        
        <?php foreach($popular->result() as $theme):            
            $thumb = str_replace("themes", "themes/thumbs", $theme->screenshot);
            if (file_exists(FCPATH.$thumb)) {        
                $screenshot = "src='$thumb'";
            }
            else {
                $screenshot = "src='$theme->screenshot' width='100'";
            }            
            $array = preg_split("/,/", timespan($theme->last_edited, time()));        
            $time_span = strtolower($array[0])." ago";
            $time_actual = date("Y-m-d, H:i", $theme->last_edited);
            $score = "Score: ".$theme->score;            
        ?>
            <td style="vertical-align: bottom;" align="center">
                <center>
                    <div class="wp-caption alignnone" style="width: 120px; border: 1px solid #a5a5a5;">                        
                    <?=anchor("themes/view/$theme->id", "<img $screenshot/>")?>
                    <p class="wp-caption-text"><?=anchor("themes/view/$theme->id", "$theme->name")?><br/><?=$score?><br/><span title="<?=$time_actual?>"><?=$time_span?></span></p>
                    </div>
                </center></td>
            <?= alternator('', '', '', '', '</tr><tr>') ?>
        <?php endforeach;?>
        </tr>
    </tbody>
    </table>
</div>
<?php } ?>      
                            
</div>


<!-- END post-content -->
