<?php
$value = $this->get($field['field_key']);
if ( ! $value && isset($field['default'])){
	$value = $field['default'];
}
?>
<input type="text" class="tutor_colorpicker" name="tutor_option[<?php echo $field['field_key']; ?>]" value="<?php echo $value; ?>" >