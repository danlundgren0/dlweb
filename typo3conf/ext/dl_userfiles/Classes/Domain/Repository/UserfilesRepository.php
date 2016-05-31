<?php
namespace DanLundgren\DlUserfiles\Domain\Repository;


/***************************************************************
 *
 *  Copyright notice
 *
 *  (c) 2016 Dan Lundgren <danlundgren0@gmail.com>
 *
 *  All rights reserved
 *
 *  This script is part of the TYPO3 project. The TYPO3 project is
 *  free software; you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation; either version 3 of the License, or
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
 * The repository for Userfiles
 */
class UserfilesRepository extends \TYPO3\CMS\Extbase\Persistence\Repository
{

	public function getCategoriesByPageUid($uid) {
		$res = $GLOBALS['TYPO3_DB']->exec_SELECT_mm_query(
			'sys_category.*',
			'sys_category',
			'sys_category_record_mm',
			'pages',
			' AND sys_category_record_mm.uid_foreign=' . $uid . '',
			'',
			''
		);
		$cats = array();
		while ($row = $GLOBALS['TYPO3_DB']->sql_fetch_assoc($res)) {
			$cats[] = $row;
		}
		return $cats;
	}
}