

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
            $time = strtolower($array[0])." ago";          
            $score = "Score: ".$theme->score;            
        ?>
            <td style="vertical-align: bottom;" align="center">
                <center>
                    <div class="wp-caption alignnone" style="width: 120px; border: 1px solid #a5a5a5;">                        
                    <?=anchor("themes/view/$theme->id", "<img $screenshot/>")?>
                    <p class="wp-caption-text"><?=anchor("themes/view/$theme->id", "$theme->name")?><br/><?=$score?><br/><?=$time?></p>
                    </div>
                </center></td>
            <?= alternator('', '', '', '', '</tr><tr>') ?>
        <?php endforeach;?>
        </tr>
    </tbody>
    </table>
</div>
<?php } ?>

<?php foreach($certifications->result() as $certification) {  
    $this->db->order_by('score DESC, name ASC');  
	$this->db->where('certification', $certification->id);        
	$themes = $this->db->get('themes');
    if ($themes->num_rows() > 0) { 
        alternator();
        ?>
        <div class="greydiv">    
        <h4 align="center">Most popular (certified Cinnamon <?=$certification->name?>)</h4>
            <table border="0" cellspacing="10" cellpadding="0">    
            <tbody><tr>        
                <?php 
                alternator();
                foreach($themes->result() as $theme):                    
                    $thumb = str_replace("themes", "themes/thumbs", $theme->screenshot);
                    if (file_exists(FCPATH.$thumb)) {        
                        $screenshot = "src='$thumb'";
                    }
                    else {
                        $screenshot = "src='$theme->screenshot' width='100'";
                    }            
                    $array = preg_split("/,/", timespan($theme->last_edited, time()));        
                    $time = strtolower($array[0])." ago";          
                    $score = "Score: ".$theme->score;            
                ?>
                    <td style="vertical-align: bottom;" align="center">
                        <center>
                            <div class="wp-caption alignnone" style="width: 120px; border: 1px solid #a5a5a5;">                        
                            <?=anchor("themes/view/$theme->id", "<img $screenshot/>")?>
                            <p class="wp-caption-text"><?=anchor("themes/view/$theme->id", "$theme->name")?><br/><?=$score?><br/><?=$time?></p>
                            </div>
                        </center></td>
                    <?= alternator('', '', '', '', '</tr><tr>') ?>
                <?php endforeach;?>
                </tr>
            </tbody>
            </table>
        </div>
    <?php 
    }
}
?>

<?php if($uncertified->num_rows > 0) {
    alternator();
    ?>
<div class="greydiv">
    <h4 align="center">Most popular (uncertified)</h4>
    <table border="0" cellspacing="10" cellpadding="0">    
    <tbody><tr>        
        <?php foreach($uncertified->result() as $theme):            
            $thumb = str_replace("themes", "themes/thumbs", $theme->screenshot);
            if (file_exists(FCPATH.$thumb)) {        
                $screenshot = "src='$thumb'";
            }
            else {
                $screenshot = "src='$theme->screenshot' width='100'";
            }            
            $array = preg_split("/,/", timespan($theme->last_edited, time()));        
            $time = strtolower($array[0])." ago";          
            $score = "Score: ".$theme->score;            
        ?>
            <td style="vertical-align: bottom;" align="center">
                <center>
                    <div class="wp-caption alignnone" style="width: 120px; border: 1px solid #a5a5a5;">                        
                    <?=anchor("themes/view/$theme->id", "<img $screenshot/>")?>
                    <p class="wp-caption-text"><?=anchor("themes/view/$theme->id", "$theme->name")?><br/><?=$score?><br/><?=$time?></p>
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
