<?php

    namespace FrontendModule\GuestbookModule;

    /**
     * Description of PagePresenter
     *
     * @author Tomáš Voslař <tomas.voslar at webcook.cz>
     */
    class GuestbookPresenter extends \FrontendModule\BasePresenter {

	private $repository;
	private $posts;
	private $ppp;
	
	protected function startup() {
	    parent::startup();

	    $this->repository = $this->em->getRepository('WebCMS\GuestbookModule\Doctrine\Post');
	}

	protected function beforeRender() {
	    parent::beforeRender();
	}

	private function loadPosts() {
	    $page = $this->getParameter('p') ? $this->getParameter('p') : 0;
	    $this->ppp = $this->settings->get('Posts per page', 'guestbookModule' . $this->actualPage->getId(), 'text')->getValue();

	    $this->posts = $this->repository->findBy(array(
		'page' => $this->actualPage
		), array('date' => 'DESC'), $this->ppp, $page * $this->ppp);
	}

	public function actionDefault($id) {
	    $this->loadPosts();
	}

	public function createComponentPostForm() {
	    $form = $this->createForm('postForm-submit');

	    $form->addText('name', 'Name')->setRequired('Please fill in your name.');
	    $form->addText('email', 'Email');
	    $form->addText('phone', 'Phone');
	    $form->addTextArea('post', 'Post')->setRequired('Please fill in your post');

	    $form->onSuccess[] = callback($this, 'postFormSubmitted');
	    $form->addSubmit('send');

	    $form->addProtection();

	    return $form;
	}

	public function handleLoadPosts($p) {
	    $this->loadPosts();

	    $template = $this->createTemplate();
	    $template->setFile('../app/templates/guestbook-module/Guestbook/posts.latte');
	    $template->page = $p;
	    $template->actualPage = $this->actualPage;
	    $template->abbr = $this->abbr;
	    $template->posts = $this->posts;

	    $this->payload->page = $p;
	    $this->payload->data = $template->__toString();
	    $this->terminate();
	}

	public function postFormSubmitted($form) {
	    $values = $form->getValues();

	    if (\WebCMS\Helpers\SystemHelper::rpHash($_POST['real']) == $_POST['realHash']) {

		$post = new \WebCMS\GuestbookModule\Doctrine\Post;
		$post->setName($values->name);
		$post->setEmail($values->email);
		$post->setPhone($values->phone);
		$post->setPost($values->post);
		$post->setPage($this->actualPage);

		$this->em->persist($post);
		$this->em->flush();

		$this->flashMessage('Your post has been saved. Thank you.', 'success');
		$this->redirect('default', array(
		    'path' => $this->actualPage->getPath(),
		    'abbr' => $this->abbr
		));
	    } else {
		$this->flashMessage('Wrong protection code.', 'danger');
	    }
	}

	public function renderDefault($id) {

	    $this->template->maxPages = ceil(count($this->repository->findAll()) / $this->ppp);
	    $this->template->page = $this->getParameter('p') ? $this->getParameter('p') : 1;
	    $this->template->posts = $this->posts;
	    $this->template->id = $id;
	}

    }
    
