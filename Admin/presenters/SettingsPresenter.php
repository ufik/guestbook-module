<?php

namespace AdminModule\GuestbookModule;

/**
 * Description of GuestbokPresenter
 * @author Tomáš Voslař <tomas.voslar at webcook.cz>
 */
class SettingsPresenter extends BasePresenter {
	
	private $repository;

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
		
		return $this->createSettingsForm($settings);
	}
	
	public function renderDefault($idPage){
		$this->reloadContent();
		
		$this->template->config = $this->settings->getSection('guestbookModule');
		$this->template->page = $this->page;
		$this->template->idPage = $idPage;
	}
	
}