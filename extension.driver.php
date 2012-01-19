<?php

	Class Extension_CacheableDatasource_OnDemand extends Extension {

		public function about(){
			return array(
				'name' => 'Cacheable Datasource: On Demand',
				'version' => '0.1',
				'release-date' => '2012-01-19',
				'author' => array(
					'name' => 'Brendan Abbott',
				),
				'description' => 'This extension is created to be an add-on for
				 the Cacheable Datasource extension. It will clear caches when
				 entries are created, updated or deleted in the backend'
			);
		}

		public function getSubscribedDelegates() {
			return array(
				array(
					'page'		=> '/publish/new/',
					'delegate'	=> 'EntryPostCreate',
					'callback'	=> 'clearCache'
				),
				array(
					'page'		=> '/publish/edit/',
					'delegate'	=> 'EntryPreEdit',
					'callback'	=> 'clearCache'
				),
				array(
					'page'		=> '/publish/',
					'delegate'	=> 'Delete',
					'callback'	=> 'clearCache'
				),
			)
		}

		public function clearCache($context) {
			$caches = glob(CACHE . '/*.xml');

			foreach($caches as $file) {
				General::deleteFile($file);
			}
		}

	}
