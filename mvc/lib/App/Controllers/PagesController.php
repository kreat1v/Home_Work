<?php

namespace App\Controllers;

use \App\Entity\Page;
use \App\Core\App;

class PagesController extends Base

{
	/** @var Page */
	private $pageModel;

	public function __construct($params = [])
	{
		parent::__construct($params);

		$this->pageModel = new Page(App::getConnection());
	}

	public function indexAction()
	{
		$this->data = $this->pageModel->list(['active' => 1]);
	}

	public function viewAction()
	{
		$page = $this->pageModel->getBy('id', $this->params[0]);

		if (!empty($page) && $page['active']) {
			$this->data = $page;
		} else {
			$this->page404();
		}
	}
}
