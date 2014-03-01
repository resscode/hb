<?php

echo!empty($succMessage) ? '<div class="alert alert-success">
    <button type="button" class="close" data-dismiss="alert">&times;</button>
' . $succMessage . '
</div>' : '';
echo!empty($errorMessage) ? '<div class="alert alert-error">
    <button type="button" class="close" data-dismiss="alert">&times;</button>
 ' . $errorMessage . '
</div>' : '';
echo!empty($content) ? '<div class="hero-unit">
 ' . $content . '
</div>' : '';
echo form_open('', '');
echo form_dropdown('actions', $actionsList, 'info');
echo "<br/>";
echo '<input type="submit" name="submit" value="Submit" class="btn">';
echo form_close();
?>
