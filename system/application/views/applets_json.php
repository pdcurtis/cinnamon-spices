<?php
    
    $json = array();

    if ($applets->num_rows() > 0) {
        foreach ($applets->result() as $applet) {            
            $json[$applet->uuid] = array(
                'spices-id'     => $applet->id,
                'uuid'          => $applet->uuid,
                'name'          => $applet->name,
                'description'   => $applet->description,
                'score'         => $applet->score,
                'created'       => $applet->created,
                'last_edited'   => $applet->last_edited,
                'file'          => $applet->file,
                'icon'          => $applet->icon,
                'screenshot'    => $applet->screenshot,
                'author_id'     => $applet->user,
                'author_user'   => $applet->username,
            );            
        }
    }

    $response = json_encode($json);    
    header("Content-type: application/json");
    header("Content-length: ".strlen($response) . "\r\n");    
    exit($response);
?>
