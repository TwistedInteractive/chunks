<?php

	Class extension_chunks extends Extension
	{
		public function getSubscribedDelegates(){
			return array(
				array(
					'page' => '/frontend/',
					'delegate' => 'FrontendParamsResolve',
					'callback' => 'addParameter'
				),
				array(
					'page' => '/backend/',
					'delegate' => 'InitaliseAdminPageHead',
					'callback' => 'modifyHeader'
				),
				array(
					'page'		=> '/system/preferences/',
					'delegate'	=> 'AddCustomPreferenceFieldsets',
					'callback'	=> 'actionAddCustomPreferenceFieldsets'
				),
				array(
					'page'		=> '/system/preferences/',
					'delegate'	=> 'Save',
					'callback'	=> 'actionSave'
				)
			);
		}

		public function addParameter($context)
		{
			if(Frontend::instance()->isLoggedIn() && Symphony::Configuration()->get('disabled', 'chunks') != 'yes')
			{
				$context['params']['chunks-logged-in'] = 'yes';
			} else {
				$context['params']['chunks-logged-in'] = 'no';
			}
		}

		public function modifyHeader($context)
		{
			if(isset($_GET['chunks']))
			{
				Administration::instance()->Page->addStylesheetToHead(URL.'/extensions/chunks/assets/chunks.css');
				Administration::instance()->Page->addScriptToHead(URL.'/extensions/chunks/assets/chunks.js');
			}
		}

		/*
		 * Delegate 'AddCustomPreferenceFieldsets' function
		 * @param $context
		 *  Provides the following parameters:
		 *  - wrapper (XMLElement) : An XMLElement of the current page
		 *  - errors (array) : An array of errors
		 */
		public function actionAddCustomPreferenceFieldsets($context)
		{
			// Create preference group
			$group = new XMLElement('fieldset');
			$group->setAttribute('class', 'settings');
			$group->appendChild(new XMLElement('legend', __('Chunks')));

			$label = Widget::Label();
			$value = Symphony::Configuration()->get('disabled', 'chunks');
			if(empty($value)) { $value = 'no'; }
			$input = Widget::Input('settings[chunks][disabled]', 'yes' , 'checkbox', ($value == 'yes' ? array('checked'=>'checked') : null));
			$label->setValue($input->generate() . ' ' . __('Disable edit-boxes for authors.'));
			$group->appendChild($label);

			// Append new preference group
			$context['wrapper']->appendChild($group);
		}

		/*
		 * Delegate 'Save' function
		 * @param $context
		 *  Provides the following parameters:
		 *  - settings (array) : An array of the preferences to be saved, passed by reference
		 *  - errors (array) : An array of errors passed by reference
		 */
		public function actionSave($context)
		{
			// Save the configuration
			$data = $context['settings']['chunks'];
			if(!isset($data['disabled'])) { $data['disabled'] = 'no'; }
			foreach($data as $key => $value)
			{
				Symphony::Configuration()->set($key, $value, 'chunks');
			}
			if(version_compare(Administration::Configuration()->get('version', 'symphony'), '2.2.5', '>'))
			{
				// S2.3+
				Symphony::Configuration()->write();
			} else {
				// S2.2.5-
				Administration::instance()->saveConfig();
			}
		}
	}