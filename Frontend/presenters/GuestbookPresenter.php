<?php

namespace FrontendModule\GuestbookModule;

/**
 * Description of PagePresenter
 *
 * @author Tomáš Voslař <tomas.voslar at webcook.cz>
 */
class GuestbookPresenter extends \FrontendModule\BasePresenter{
	
	private $repository;
	
	private $posts;
	
	protected function startup() {
		parent::startup();
	
		$this->repository = $this->em->getRepository('WebCMS\GuestbookModule\Doctrine\Post');
	}

	protected function beforeRender() {
		parent::beforeRender();
		
	}
	
	public function actionDefault($id){
		$this->posts = $this->repository->findBy(array(
			'page' => $this->actualPage
		));
	}
	
	public function createComponentPostForm(){
		$form = $this->createForm('postForm-submit');
		
		$form->addText('name', 'Name')->setRequired('Please fill in your name.');
		$form->addText('email', 'Email');
		$form->addText('phone', 'Phone');
		$form->addTextArea('post', 'Post')->setRequired('Please fill in your post');
		
		$form->onSuccess[] = callback($this, 'postFormSubmitted');
		$form->addSubmit('send');
		
		return $form;
	}
	
	public function postFormSubmitted($form){
		$values = $form;
		
		$post = new \WebCMS\GuestbookModule\Doctrine\Post;
		$post->setName($values->name);
		$post->setEmail($values->email);
		$post->setPhone($values->phone);
		$post->setPost($values->post);
		$post->setPage($this->actualPage);
		
		$this->em->persist($post);
		$this->em->flush();
		
		$this->flashMessageTranslated('Your post has been saved. Thank you.', 'success');
	}
	
	public function renderDefault($id){
		
		$this->template->posts = $this->posts;
		$this->template->id = $id;
	}

}