<?php

namespace FrontendModule\GuestbookModule;

/**
 * Description of PagePresenter
 *
 * @author Tomáš Voslař <tomas.voslar at webcook.cz>
 */
class GuestbookPresenter extends \FrontendModule\BasePresenter{
	
	private $repository;
	
	protected function startup() {
		parent::startup();
	
		$this->repository = $this->em->getRepository('WebCMS\GuestbookModule\Doctrine\Post');
	}

	protected function beforeRender() {
		parent::beforeRender();
		
	}
	
	public function actionDefault($id){
		
	}
	
	public function renderDefault($id){
		
		$this->template->id = $id;
	}

}