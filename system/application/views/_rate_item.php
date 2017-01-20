<?php if (False) { ?>
    <?= $rate_message ?>
    <br/>
    <br/>
    <?php
    $color="grey"; if ($rating == 1) { $color = "red"; }
    echo anchor("/$type/rate/$id/1", "[*]", "class=''")."&nbsp;";
    $color="grey"; if ($rating == 2) { $color = "orange"; }
    echo anchor("/$type/rate/$id/2", "[**]", "class=''")."&nbsp;";
    $color="grey"; if ($rating == 3) { $color = "yellow"; }
    echo anchor("/$type/rate/$id/3", "[***]", "class=''")."&nbsp;";
    $color="grey"; if ($rating == 4) { $color = "blue"; }
    echo anchor("/$type/rate/$id/4", "[****]", "class=''")."&nbsp;";
    $color="grey"; if ($rating == 5) { $color = "green"; }
    echo anchor("/$type/rate/$id/5", "[*****]", "class=''")."&nbsp;";
    ?>
    <br/>
    <br/>
<?php } ?>
