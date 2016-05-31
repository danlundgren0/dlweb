<?php
if (!defined('TYPO3_MODE')) {
	die('Access denied.');
}

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerPlugin(
	'DanLundgren.' . $_EXTKEY,
	'Userfiles',
	'User files'
);

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addStaticFile($_EXTKEY, 'Configuration/TypoScript', 'User files');

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_dluserfiles_domain_model_userfiles', 'EXT:dl_userfiles/Resources/Private/Language/locallang_csh_tx_dluserfiles_domain_model_userfiles.xlf');
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_dluserfiles_domain_model_userfiles');

if (TYPO3_MODE === 'BE') { 
	\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTypoScript($_EXTKEY,'setup','<INCLUDE_TYPOSCRIPT: source=FILE:EXT:dl_userfiles/Configuration/TypoScript/setup.txt>');     
	\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTypoScript($_EXTKEY,'constants','<INCLUDE_TYPOSCRIPT: source=FILE:EXT:dl_userfiles/Configuration/TypoScript/constants.txt>'); 
} 