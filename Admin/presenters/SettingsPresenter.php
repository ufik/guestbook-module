<?php

namespace AdminModule\GuestbookModule;

/**
 * Description of GuestbokPresenter
 * @author Tomáš Voslař <tomas.voslar at webcook.cz>
 */
class SettingsPresenter extends BasePresenter {
	
	protected $repository;

	protected function startup() {
		parent::startup();

	}

	protected function beforeRender() {
		parent::beforeRender();
		
	}
	
	public function actionDefault($idPage){

	}
	
	public function createComponentSettingsForm(){
		
		$settings = array();
		$settings[] = $this->settings->get('Posts per page', 'guestbookModule' . $this->actualPage->getId(), 'text');
		
		return $this->createSettingsForm($settings);
	}
	
	public function renderDefault($idPage){
		$this->reloadContent();
		
		$this->template->config = $this->settings->getSection('guestbookModule');
		$this->template->idPage = $idPage;
	}
	
}