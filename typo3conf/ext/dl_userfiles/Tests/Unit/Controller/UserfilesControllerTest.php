<?php
namespace DanLundgren\DlUserfiles\Tests\Unit\Controller;
/***************************************************************
 *  Copyright notice
 *
 *  (c) 2016 Dan Lundgren <danlundgren0@gmail.com>
 *  			
 *  All rights reserved
 *
 *  This script is part of the TYPO3 project. The TYPO3 project is
 *  free software; you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation; either version 2 of the License, or
 *  (at your option) any later version.
 *
 *  The GNU General Public License can be found at
 *  http://www.gnu.org/copyleft/gpl.html.
 *
 *  This script is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU General Public License for more details.
 *
 *  This copyright notice MUST APPEAR in all copies of the script!
 ***************************************************************/

/**
 * Test case for class DanLundgren\DlUserfiles\Controller\UserfilesController.
 *
 * @author Dan Lundgren <danlundgren0@gmail.com>
 */
class UserfilesControllerTest extends \TYPO3\CMS\Core\Tests\UnitTestCase
{

	/**
	 * @var \DanLundgren\DlUserfiles\Controller\UserfilesController
	 */
	protected $subject = NULL;

	public function setUp()
	{
		$this->subject = $this->getMock('DanLundgren\\DlUserfiles\\Controller\\UserfilesController', array('redirect', 'forward', 'addFlashMessage'), array(), '', FALSE);
	}

	public function tearDown()
	{
		unset($this->subject);
	}

	/**
	 * @test
	 */
	public function listActionFetchesAllUserfilessFromRepositoryAndAssignsThemToView()
	{

		$allUserfiless = $this->getMock('TYPO3\\CMS\\Extbase\\Persistence\\ObjectStorage', array(), array(), '', FALSE);

		$userfilesRepository = $this->getMock('DanLundgren\\DlUserfiles\\Domain\\Repository\\UserfilesRepository', array('findAll'), array(), '', FALSE);
		$userfilesRepository->expects($this->once())->method('findAll')->will($this->returnValue($allUserfiless));
		$this->inject($this->subject, 'userfilesRepository', $userfilesRepository);

		$view = $this->getMock('TYPO3\\CMS\\Extbase\\Mvc\\View\\ViewInterface');
		$view->expects($this->once())->method('assign')->with('userfiless', $allUserfiless);
		$this->inject($this->subject, 'view', $view);

		$this->subject->listAction();
	}
}
