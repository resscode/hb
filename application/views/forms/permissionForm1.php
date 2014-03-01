<STYLE>
    label{
        display:inline;
    }
</STYLE>
<?php

echo form_open('', '');
echo '<input type="button" class="check" value="check all" />';
echo "<h1>" . ucfirst($entityFor) . " Fields Permissions</h1>";
foreach ($entityFieldsList as $entityField) {
    echo "<h2>" . $entityField . "</h2>";
    foreach ($rolesList as $role) {
        echo "<h3>" . $role['name'] . "</h3>";
        foreach ($permissionMakerForm['checkboxes']['rules_field'] as $nameCheck => $checkBoxField) {
            $fieldName                     = $entityField . '_' . $role['id'];
            $checkBoxFieldReady            = $checkBoxField;
            $checkBoxFieldReady['name']    = 'fieldperm_' . $fieldName . '[]';
            $checkBoxFieldReady['id']      = $checkBoxField['id'] . "_" . $fieldName;
            $checkBoxFieldReady['checked'] = checkFieldChecked($entityFieldPerm, $entityField, $nameCheck, $role['id']);
            echo form_label(ucfirst($nameCheck), $checkBoxFieldReady['id']);
            echo form_checkbox($checkBoxFieldReady);
        }
        echo "<br/>";
    }
    echo "<hr/>";
}
echo "<br/>";
echo '<h1>Entity Permissions</h1>';
foreach ($rolesList as $role) {
    echo "<h2>" . $role['name'] . "</h3>";
    foreach ($permissionMakerForm['checkboxes']['rules_entity'] as $nameCheck => $checkBoxField) {
        $fieldName                     = 'entperm_' . $role['id'];
        $checkBoxFieldReady            = $checkBoxField;
        $checkBoxFieldReady['name']    = $fieldName . '[]';
        $checkBoxFieldReady['id']      = $checkBoxField['id'] . "_" . $fieldName;
        $checkBoxFieldReady['checked'] = checkEntityChecked($entityPerm, $nameCheck, $role['id']);
        echo form_label(ucfirst($nameCheck), $checkBoxFieldReady['id']);
        echo form_checkbox($checkBoxFieldReady);
    }
    echo "<br/>";
}
echo form_hidden('formStep', '0');
echo form_hidden('enities', $entityFor);
echo form_hidden('permReady', '1');
echo '<input type="submit" name="submit" value="Submit" class="btn">';
echo form_close();
echo "<script type='text/javascript'>$(document).ready(function(){
    $('.check:button').toggle(function(){
        $('input:checkbox').attr('checked','checked');
        $(this).val('uncheck all')
    },function(){
        $('input:checkbox').removeAttr('checked');
        $(this).val('check all');        
    })
})</script>";

function checkFieldChecked($entityFieldPerm, $fieldName, $operName, $roleId) {
    $result = false;
    foreach ($entityFieldPerm as $fieldPerm) {
        if ($fieldName == $fieldPerm['field_name'] && $operName == $fieldPerm['permission_type'] && $fieldPerm['role_id'] == $roleId) {
            $result = true;
            break;
        }
    }
    return $result;
}

function checkEntityChecked($entityPerm, $operName, $roleId) {
    $result = false;
    foreach ($entityPerm as $perm) {
        if ($operName == $perm['permission_type'] && $perm['role_id'] == $roleId) {
            $result = true;
            break;
        }
    }
    return $result;
}
?>

