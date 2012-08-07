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
				)
			);
		}

		public function addParameter($context)
		{
			if(Frontend::instance()->isLoggedIn())
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
	}