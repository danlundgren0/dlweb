<?php
    namespace DanLundgren\DlUserfiles\Hooks;
    class CreateCustomerFolders {

        protected $parentCatId = NULL;
        protected $parentCustomerFolder = NULL;
        protected $userName = NULL;
        protected $table = NULL;
        protected $status = NULL;
        protected $customerCatNames = array();

        /*
        *  $status      new, updated
        *  $table       fe_users
        *  $id          new: NEW5691208b2428b763522287 updated: 4
        *  $fieldArray  feuser data
        *  $pObj        ?
         */
        public function processDatamap_postProcessFieldArray($status, $table, $id, &$fieldArray, &$pObj) {
            $this->table = $table;
            $this->status = $status;
            if(($status == 'new' || $status != 'updated') && $this->formIsValid()) {
                $this->getCategories();
                $this->setFoldersFromCategoryNames();
            }
        }
        public function getCategories() {
            $objectManager = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance('TYPO3\\CMS\\Extbase\\Object\\ObjectManager');
            $categoryRepository = $objectManager->get('TYPO3\CMS\Extbase\Domain\Repository\CategoryRepository');
            $allCats = $categoryRepository->findAll();
            foreach($allCats as $cat) {
                $parent = $cat->getParent();
                if($parent !== NULL && $parent->getUid() == $this->parentCatId) {
                    $this->customerCatNames[] = $cat->getTitle();
                }
            }
        }
        public function setFoldersFromCategoryNames() {
            $fullpath =  PATH_site . 'fileadmin/user_upload/'.$this->parentCustomerFolder;
            if (!file_exists($fullpath)) {
                \TYPO3\CMS\Core\Utility\GeneralUtility::mkdir($fullpath);
            }
            if (file_exists($fullpath)) {
                $customerFolderFullPath = $fullpath.'/'.$this->userName;
                if(!file_exists($customerFolderFullPath)) {
                    \TYPO3\CMS\Core\Utility\GeneralUtility::mkdir($customerFolderFullPath);
                }
                foreach($this->customerCatNames as $catName) {
                    $customerSubFolderFullPath = $customerFolderFullPath.'/'.$catName;
                    \TYPO3\CMS\Core\Utility\GeneralUtility::mkdir($customerFolderFullPath.'/'.$catName);
                }
            }
            if (!file_exists($fullpath)) {
\TYPO3\CMS\Extbase\Utility\DebuggerUtility::var_dump(
 array(
  'class' => __CLASS__,
  'function' => __FUNCTION__,
  'Folder error' => 'Check folder rights and that folder name characters is valid '.$fullpath,
 )
);
            }
        }
        public function setConstantValues() {
            $objectManager = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance('TYPO3\\CMS\\Extbase\\Object\\ObjectManager');
            $this->configurationManager = $objectManager->get('TYPO3\\CMS\\Extbase\\Configuration\\ConfigurationManager');
            $settings = $this->configurationManager->getConfiguration(\TYPO3\CMS\Extbase\Configuration\ConfigurationManagerInterface::CONFIGURATION_TYPE_FULL_TYPOSCRIPT);
            $pc = ((int)$settings['plugin.']['tx_dluserfiles_userfiles.']['customers.']['parentCategoryId']>0)?$settings['plugin.']['tx_dluserfiles_userfiles.']['customers.']['parentCategoryId']:NULL;
            $pf = (strlen($settings['plugin.']['tx_dluserfiles_userfiles.']['customers.']['parentCustomerFolder'])>0)?$settings['plugin.']['tx_dluserfiles_userfiles.']['customers.']['parentCustomerFolder']:NULL;

            $this->parentCatId = $pc;
            $this->parentCustomerFolder = $pf;
        }
        public function setUserName($userName) {
            $search = array('å', 'ä', 'ö');
            $replace = array('a', 'a', 'o');
            $this->userName = str_replace($search, $replace, $userName);
        }
        public function setUserGroupName($userName) {
            $search = array('å', 'ä', 'ö');
            $replace = array('a', 'a', 'o');
            $this->userName = str_replace($search, $replace, $userName);
        }
        public function formIsValid() {
            if($this->parentCustomerFolder && $this->parentCatId && $this->userName
                && $this->table == 'fe_groups') {
                return TRUE;
            }
            return FALSE;
        }
        public function processDatamap_preProcessFieldArray(&$fieldArray, $table, $id, &$pObj) {
            $this->table = $table;
            $this->setConstantValues();
            //$this->setUserName($fieldArray['username']);
            $this->setUserGroupName($fieldArray['title']);
            if($this->formIsValid()) {
                $fieldArray['username'] = $this->userName;
            }
        }

    }
