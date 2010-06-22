<?php

namespace dummy_data\extensions\helper;

class Special extends \lithium\template\Helper {

	public function radio($field, array $options = array()) {
		$value = $options['value'];
		$id = $options['id'];
		$label = $options['label'];
		$checked = (isset($options['checked']) && $options['checked'])?'checked="checked"':'';
		$ret = "<input type='radio' value='$value' name='$field' id='$id' $checked>";
		$ret .= "<label for='$id'>$label</label>";
		return $ret;
	}
	
	public function select($field, array $list = array(), array $options = array() ) {
		$ret = '<select name="'.$field.'">';
		foreach ($list as $group => $optionItems) {
			$ret .= "<optgroup label='$group'>";
			foreach ($optionItems as $value => $option) {
				$selected = (isset($options['value'])&&$options['value']==$value)?'selected="selected"':'';
				$ret .= "<option value='$value'$selected>$option</option>";
			}
			$ret .= '</optgroup>';
		}
		$ret .= '</select>';
		return $ret;
	}

}
?>
