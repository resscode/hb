<?php

echo!empty($succMessage) ? '<div class="alert alert-success">
    <button type="button" class="close" data-dismiss="alert">&times;</button>
' . $succMessage . '
</div>'
            : '';
echo!empty($errorMessage) ? '<div class="alert alert-error">
    <button type="button" class="close" data-dismiss="alert">&times;</button>
 ' . $errorMessage . '
</div>'
            : '';
if (isset($lines) && is_array($lines)) {
    foreach ($lines as $line) {
//        echo '<div class="alert alert-block">
//  <button type="button" class="close" data-dismiss="alert">&times;</button>  
//  ' . $line . '
//        </div>';
        $content.=$line;
    }
    echo '<pre>'.$content.'</pre>';
} else {

    echo form_open('', '');
    echo form_dropdown('logs', $logs);
    echo "<br/>";
    echo '<input type="submit" name="submit" value="Submit" class="btn">';
    echo form_close();
}
?>
