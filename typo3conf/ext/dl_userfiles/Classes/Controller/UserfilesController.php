<?php
namespace DanLundgren\DlUserfiles\Controller;


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
 * UserfilesController
 */
class UserfilesController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController
{

    /**
     * User Repository
     *
     * @var \TYPO3\CMS\Extbase\Domain\Repository\FrontendUserRepository
     * @inject
     */
    protected $userRepository;

    /**
     * Category Repository
     *
     * @var \TYPO3\CMS\Extbase\Domain\Repository\CategoryRepository
     * @inject
     */
    protected $categoryRepository;

    /**
     * Page Repository
     *
     * @var \TYPO3\CMS\Frontend\Page\PageRepository
     * @inject
     */
    protected $pageRepository;

    /**
     * userfilesRepository
     *
     * @var \DanLundgren\DlUserfiles\Domain\Repository\UserfilesRepository
     * @inject
     */
    protected $userfilesRepository = NULL;

    /**
     * action list
     *
     * @return void
     */
    public function listAction()
    {

//plugin.tx_dluserfiles_userfiles.persistence.storagePid
        if($GLOBALS['TSFE']->fe_user->user['uid'] > 0) {
            $this->objectManager = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance('TYPO3\\CMS\\Extbase\\Object\\ObjectManager');

            //$userRepository = $this->objectManager->get('TYPO3\CMS\Extbase\Domain\Repository\FrontendUserRepository');
            $storageRepository = $this->objectManager->get('TYPO3\CMS\Core\Resource\StorageRepository');
            $categoryRepository = $this->objectManager->get('TYPO3\CMS\Extbase\Domain\Repository\CategoryRepository');
            //$pageRepository = $this->objectManager->get('TYPO3\CMS\Frontend\Page\PageRepository');
            $curPage = $this->pageRepository->getPage($GLOBALS['TSFE']->page['uid']);
			$currentUser = $this->userRepository->findByUid($GLOBALS['TSFE']->fe_user->user['uid']);
            $currentUserGroup = NULL;
            if(count($currentUser->getUserGroup())>0) {
                foreach($currentUser->getUserGroup() as $ug) {
                    $currentUserGroup = $ug;
                    break;
                }
            }
            $pageCategories = $this->userfilesRepository->getCategoriesByPageUid($GLOBALS['TSFE']->page['uid']);
            $customerFiles = array();
            if($pageCategories !== NULL && count($pageCategories) > 0) {
				foreach($pageCategories as $pCat) {
                    $customerFiles = $this->getCustomerFiles($currentUserGroup->getTitle(), $pCat['title']);
                    $customerSubFiles = $this->getCustomerSubFiles($currentUserGroup->getTitle(), $pCat['title']);
					//$customerFiles = $this->getCustomerFiles($currentUser->getUsername(), $pCat['title']);
                    //$customerSubFiles = $this->getCustomerSubFiles($currentUser->getUsername(), $pCat['title']);
				}
            }
        }
        $this->view->assign('customerFiles', $customerFiles);
        $this->view->assign('customerSubFiles', $customerSubFiles);

        //if ($this->currentUser == NULL && $GLOBALS['TSFE']->fe_user->user['uid'] > 0) {
        //    $this->currentUser = $this->userRepository->findByUid($GLOBALS['TSFE']->fe_user->user['uid']);
        //}

        //$storageRepository = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance('TYPO3\\CMS\\Core\\Resource\\StorageRepository'); // create instance to storage repository
        //$storage = $storageRepository->findByUid(1);    // get file storage with uid 1 (this should by default point to your fileadmin/ directory)
        //$files = $storage->getFilesInFolder($storage->getDefaultFolder());

        //$userfiles = $this->userfilesRepository->findAll();
        //$this->view->assign('userfiles', $userfiles);
    }
    public function getCustomerFiles($username, $folderName) {
    	$parentCustomerFolder = $GLOBALS['TSFE']->tmpl->setup['plugin.']['tx_dluserfiles_userfiles.']['customers.']['parentCustomerFolder'];
    	$fullpath =  PATH_site . 'fileadmin/user_upload/'.$parentCustomerFolder;
        $hasSubFolders = FALSE;
        $c=0;
    	if (file_exists($fullpath)) {
    		if (file_exists($fullpath.'/'.$username)) {
    			if (file_exists($fullpath.'/'.$username.'/'.$folderName)) {
                    $filesInDir = \TYPO3\CMS\Core\Utility\GeneralUtility::getFilesInDir($fullpath.'/'.$username.'/'.$folderName.'/','',TRUE,'','');
                    foreach($filesInDir as $filePath) {
                        $fileadmin   = 'fileadmin';
                        $pos = strpos($filePath, $fileadmin);
                        $fileNamePos = strrpos($filePath, '/')+1;
                        $fileInfo[$c] = array();
                        $fileInfo[$c]['path'] = $GLOBALS['TSFE']->baseUrl.substr($filePath, $pos);
                        $fileInfo[$c]['name'] = substr($filePath, $fileNamePos);
                        $c+=1;
                    }
                    return $fileInfo;
    			}
    		}
    	}
    	return '';
    }
    public function getCustomerSubFiles($username, $folderName) {
        $parentCustomerFolder = $GLOBALS['TSFE']->tmpl->setup['plugin.']['tx_dluserfiles_userfiles.']['customers.']['parentCustomerFolder'];
        $fullpath =  PATH_site . 'fileadmin/user_upload/'.$parentCustomerFolder;
        $hasSubFolders = FALSE;
        $c=0;
        if (file_exists($fullpath)) {
            if (file_exists($fullpath.'/'.$username)) {
                if (file_exists($fullpath.'/'.$username.'/'.$folderName)) {
                    $subDirs = \TYPO3\CMS\Core\Utility\GeneralUtility::get_dirs($fullpath.'/'.$username.'/'.$folderName);
                    if(count($subDirs) > 0) {
                        $hasSubFolders = TRUE;
                        foreach($subDirs as $subDir) {
                            $filesInSubDir = \TYPO3\CMS\Core\Utility\GeneralUtility::getFilesInDir($fullpath.'/'.$username.'/'.$folderName.'/'.$subDir.'/','',TRUE,'','');
                            $isFirst = TRUE;
                            foreach($filesInSubDir as $filePath) {
                                $fileadmin   = 'fileadmin';
                                $pos = strpos($filePath, $fileadmin);
                                $fileNamePos = strrpos($filePath, '/')+1;
                                $fileInfo[$c]['subDirName'] = ($isFirst) ? $subDir : '';
                                $isFirst = FALSE;
                                //$fileInfo['sub'][$c]['subDirName'] = $subDir;
                                $fileInfo[$c]['path'] = $GLOBALS['TSFE']->baseUrl.substr($filePath, $pos);
                                $fileInfo[$c]['name'] = substr($filePath, $fileNamePos);
                                //$fileInfo[$c]['path'] = $GLOBALS['TSFE']->baseUrl.substr($filePath, $pos);
                                //$fileInfo[$c]['name'] = substr($filePath, $fileNamePos);
                                $c+=1;
                            }
                        }
                    }
                    return $fileInfo;
                }
            }
        }
        return '';
    }
}
