<?php

function secretkeygenerate($length) {
    $key = '';
    for ($i = 0; $i < $length; $i++) {
        $randVal = rand(48, 126);
        if ($randVal == 92)
            $randVal = 93;
        $key.=chr($randVal);
    }
    return $key;
}

?>
