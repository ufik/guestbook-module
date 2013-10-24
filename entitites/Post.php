<?php

namespace WebCMS\GuestbookModule\Doctrine;

use Doctrine\ORM\Mapping as orm;

/**
 * Description of Post
 * @orm\Entity
 * @author Tomáš Voslař <tomas.voslar at webcook.cz>
 */
class Post extends \AdminModule\Doctrine\Entity {
	
	/**
	 * @orm\Column
	 */
	private $name;
	
	/**
	 * @orm\Column
	 */
	private $email;
	
	/**
	 * @orm\Column
	 */
	private $phone;
	
	/**
	 * @orm\Column(type="text")
	 */
	private $post;
	
	/**
	 * @orm\Column(type="text")
	 */
	private $postResponse;
	
	/**
	 * @orm\ManyToOne(targetEntity="AdminModule\Page")
	 * @orm\JoinColumn(name="page_id", referencedColumnName="id", onDelete="CASCADE")
	 */
	private $page;
	
	public function getName() {
		return $this->name;
	}

	public function getEmail() {
		return $this->email;
	}

	public function getPhone() {
		return $this->phone;
	}

	public function getPost() {
		return $this->post;
	}

	public function getPage() {
		return $this->page;
	}

	public function setName($name) {
		$this->name = $name;
	}

	public function setEmail($email) {
		$this->email = $email;
	}

	public function setPhone($phone) {
		$this->phone = $phone;
	}

	public function setPost($post) {
		$this->post = $post;
	}

	public function setPage($page) {
		$this->page = $page;
	}
}