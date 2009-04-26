<?php

/*
 * Extends the Form Helper for some custom uses.
 * 
 * TODO: Expand functionality to more form elements.
 */
if ( ! function_exists('form_row'))
{
	function form_text_item($label, $id)
	{
		$form  = '<p>';
		$form .= '<label for="' . $id . '">' . $label . '</label>';
		$form .= form_input($id);
		$form .= '</p>';
		
		return $form;
	}
}