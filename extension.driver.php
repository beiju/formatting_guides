<?php

Class extension_formatting_guides extends Extension {
  
	// Simply outputs information to Symphony about the extension
	public function about() {
		$info = array(
			'author' => array(
				'email' => 'beiju@iwillsite.com',
				'name' => 'Will P',
				'website' => 'http://iwillsite.com/'
			),
			'name' => 'Formatting Guides',
			'release-date' => '2010-05-30',
			'version' => '2.0Œ≤1'
		);
		return $info;
	}
	
	public function getSubscribedDelegates() {
		return array(
			array(
			'page' => '/backend/',
			'delegate' => 'ModifyTextareaFieldPublishWidget',
			'callback' => 'addGuideBelowTextArea'
			),
			array(
			'page'		=> '/backend/',
			'delegate'	=> 'InitaliseAdminPageHead',
			'callback'	=> 'initaliseAdminPageHead'
			)
		);
	}
	
	public function addGuideBelowTextArea($pointer) {
		//only show guide when using markdown
		$formatter = substr($pointer['field']->get('formatter'), 0,  11);
		
		$file = DOCROOT . '/extensions/formatting_guides/guides/' . $formatter . '.txt';
		
		if (file_exists($file)) {
			//append the textarea here so the guide will show after the textarea in the form
			$pointer['label']->appendChild($pointer['textarea']);

			//nullify the textarea to prevent another one being appended in field.textarea.php
			$pointer['textarea'] = Widget::Label('');

			//retrieve the guide and append it
			$contents = file_get_contents($file);
			$guide = Widget::Label($contents,null,'formatting_guides');
			$pointer['label']->appendChild($guide);
		}
		
	}


	/*-------------------------------------------------------------------------
		Delegates:
	-------------------------------------------------------------------------*/
		
		public function initaliseAdminPageHead($context) {
			$page = $context['parent']->Page;
			
			// Include only in section edit pages
			//if ($page instanceof contentBlueprintsSections and $page->_context[0] == 'edit') {
				$page->addScriptToHead(URL . '/extensions/formatting_guides/assets/collapse_guide.js', 900200);
			//}
		}
}

?>
