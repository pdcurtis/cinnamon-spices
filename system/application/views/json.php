<?php
    
    $json = array();

    if ($spiceData->num_rows() > 0) {
        foreach ($spiceData->result() as $spice) {
            if ($spiceType == "themes") {
                $json[$spice->uuid] = array(
                    'spices-id' => $spice->id,                    
                    'name' => $spice->name,
                    'description' => $spice->description,
                    'score' => $spice->score,
                    'created' => $spice->created,
                    'last_edited' => $spice->last_edited,
                    'file' => $spice->file,                    
                    'screenshot' => $spice->screenshot,
                    'author_id' => $spice->user,
                    'author_user' => $spice->username
                );
            }
            else {
                $json[$spice->uuid] = array(
                    'spices-id' => $spice->id,
                    'uuid' => $spice->uuid,
                    'name' => $spice->name,
                    'description' => $spice->description,
                    'score' => $spice->score,
                    'created' => $spice->created,
                    'last_edited' => $spice->last_edited,
                    'file' => $spice->file,
                    'icon' => $spice->icon,
                    'screenshot' => $spice->screenshot,
                    'author_id' => $spice->user,
                    'author_user' => $spice->username
                );
            }
        }
    }

    $response = json_encode($json);
    header("Content-type: application/json");
    header("Content-length: ".strlen($response) . "\r\n");
    exit($response);
?>