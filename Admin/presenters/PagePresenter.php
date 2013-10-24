<?php

namespace AdminModule\GuestbookModule;

/**
 * Description of GuestbookPresenter
 *
 * @author Tomáš Voslař <tomas.voslar at webcook.cz>
 */
class GuestbookPresenter extends BasePresenter {
	
	private $repository;
	
	protected function startup() {
		parent::startup();
	}

	protected function beforeRender() {
		parent::beforeRender();
		
	}
	
	public function actionDefault($idPage){
	}
	
	public function renderDefault($idPage){
		$this->reloadContent();
		
		$this->template->idPage = $idPage;
	}
			
}