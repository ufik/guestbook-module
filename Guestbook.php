<?php

namespace WebCMS\GuestbookModule;

/**
 * Description of Page
 *
 * @author Tomáš Voslař <tomas.voslar at webcook.cz>
 */
class Guestbook extends \WebCMS\Module {
	
	protected $name = 'Guestbook';
	
	protected $author = 'Tomáš Voslař';
	
	protected $presenters = array(
		array(
			'name' => 'Guestbook',
			'frontend' => TRUE,
			'parameters' => FALSE
			),
		array(
			'name' => 'Settings',
			'frontend' => FALSE
			)
	);
	
	protected $params = array(
		
	);
	
	public function __construct(){
		//$this->addBox('Guestbook box', 'Guestbook', 'guestbookBox');
	}
	
}