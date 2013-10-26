<?php

namespace AdminModule\GuestbookModule;

/**
 * Description of BasePresenter
 *
 * @author Tomáš Voslař <tomas.voslar at webcook.cz>
 */
class BasePresenter extends \AdminModule\BasePresenter {
	
	protected $repository;
	
	protected function startup() {
		parent::startup();
		
		$this->repository = $this->em->getRepository('WebCMS\GuestbookModule\Doctrine\Post');
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