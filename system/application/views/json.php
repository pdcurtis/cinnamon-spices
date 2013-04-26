<?php
    header("Content-Type: application/json");
    
    $pack = true;
    if(!empty($_SERVER["HTTP_ACCEPT_ENCODING"]) && strpos("gzip",$_SERVER["HTTP_ACCEPT_ENCODING"]) === NULL) {
        $pack = false;
    }

    $list = array();

    if ($spiceData->num_rows > 0) {
        foreach ($spiceData->result() as $spice) {
            $list[] = array(
                'spices-id'     => $spice->id,
                'uuid'          => $spice->uuid,
                'name'          => $spice->name,
                'description'   => $spice->description,
                'score'         => $spice->score,
                'created'       => $spice->created,
                'last_edited'   => $spice->last_edited,
                'file'          => $spice->file,
                'icon'          => $spice->icon,
                'screenshot'    => $spice->screenshot,
                'author_id'     => $spice->user,
                'author_user'   => $spice->username,
                'website'       => $spice->website,
            );
        }
    }

    $json = json_encode($list);

    if ($pack) {
        header("Content-Encoding: gzip");
        $output = gzencode($json,9,true);
    }
    else {
        $output = $json;
    }

    header("Content-Length: " . mb_strlen($output, 'latin1'));

    echo $output;
?>