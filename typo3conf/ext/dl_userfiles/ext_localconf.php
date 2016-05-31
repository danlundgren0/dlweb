<?php
if (!defined('TYPO3_MODE')) {
	die('Access denied.');
}

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
	'DanLundgren.' . $_EXTKEY,
	'Userfiles',
	array(
		'Userfiles' => 'list',
		
	),
	// non-cacheable actions
	array(
		'Userfiles' => '',
		
	)
);
$GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['t3lib/class.t3lib_tcemain.php']['processDatamapClass'][] = 'EXT:dl_userfiles/Classes/Hooks/createCustomerFolders.php:DanLundgren\DlUserfiles\Hooks\CreateCustomerFolders';
