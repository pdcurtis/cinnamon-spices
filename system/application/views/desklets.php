
<div id="main">
        	<div id="post-content" class="clearfix">
				        		<h1 class="page-title">Desklets</h1>	
                                
    <p><strong>Desklets are a new feature of Cinnamon 1.8 (coming in April 2013 and in Linux Mint 15 in May 2013).</strong></p>
                                
    <p>To install a desklet: Download it and decompress it in ~/.local/share/cinnamon/desklets.</p>
                                
<?php if($latest->num_rows > 0) {
    alternator();
    ?>
<div class="greydiv">    
    <h4 align="center">Latest</h4>
    <table border="0" cellspacing="10" cellpadding="0">    
    <tbody><tr>        
        <?php foreach($latest->result() as $desklet):                        
            $array = preg_split("/,/", timespan($desklet->last_edited, time()));        
            $time = strtolower($array[0])." ago";          
            $score = "Score: ".$desklet->score;            
        ?>
            <td style="vertical-align: bottom;" align="center">
                <center>
                    <div class="wp-caption alignnone" style="width: 120px; border: 1px solid #a5a5a5;">                        
                    <?=anchor("desklets/view/$desklet->id", "<img src='$desklet->icon' width='48'/>")?>
                    <p class="wp-caption-text"><?=anchor("desklets/view/$desklet->id", "$desklet->name")?><br/><?=$score?><br/><?=$time?></p>
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
        <?php foreach($popular->result() as $desklet):                        
            $array = preg_split("/,/", timespan($desklet->last_edited, time()));        
            $time = strtolower($array[0])." ago";          
            $score = "Score: ".$desklet->score;            
        ?>
            <td style="vertical-align: bottom;" align="center">
                <center>
                    <div class="wp-caption alignnone" style="width: 120px; border: 1px solid #a5a5a5;">                        
                    <?=anchor("desklets/view/$desklet->id", "<img src='$desklet->icon' width='48'/>")?>
                    <p class="wp-caption-text"><?=anchor("desklets/view/$desklet->id", "$desklet->name")?><br/><?=$score?><br/><?=$time?></p>
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
