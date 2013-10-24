<?php

	Class Extension_CacheableDatasource_OnDemand extends Extension {

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
				)
			);
		}

		public function clearCache($context) {
			$caches = glob(CACHE . '/cacheabledatasource/*.xml');

			foreach($caches as $file) {
				General::deleteFile($file);
			}
		}

	}
