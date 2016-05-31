<?php
if (!defined('TYPO3_MODE')) {
    die('Access denied.');
}


/***************
 * Make the extension configuration accessible
 */
if (!is_array($GLOBALS['TYPO3_CONF_VARS']['EXT']['extConf'][$_EXTKEY])) {
    $GLOBALS['TYPO3_CONF_VARS']['EXT']['extConf'][$_EXTKEY] = unserialize($GLOBALS['TYPO3_CONF_VARS']['EXT']['extConf'][$_EXTKEY]);
}


/***************
 * PageTs
 */

// Add Content Elements to newContentElement Wizard
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPageTSConfig('<INCLUDE_TYPOSCRIPT: source="FILE:EXT:' . $_EXTKEY . '/Configuration/PageTS/Mod/Wizards/newContentElement.ts">');

// Configure Form Extension
/*
if (\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::isLoaded('form')) {
    \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPageTSConfig('<INCLUDE_TYPOSCRIPT: source="FILE:EXT:' . $_EXTKEY . '/Configuration/PageTS/Mod/Wizards/form.txt">');
}
*/
// Add BackendLayouts BackendLayouts for the BackendLayout DataProvider

//if (!$GLOBALS['TYPO3_CONF_VARS']['EXT']['extConf'][$_EXTKEY]['disablePageTsBackendLayouts']) {
    \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPageTSConfig('<INCLUDE_TYPOSCRIPT: source="FILE:EXT:' . $_EXTKEY . '/Configuration/PageTS/Mod/WebLayout/BackendLayouts.ts">');
//}

// AdminPanel
/*
if (!$GLOBALS['TYPO3_CONF_VARS']['EXT']['extConf'][$_EXTKEY]['disablePageTsAdmPanel']) {
    \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPageTSConfig('<INCLUDE_TYPOSCRIPT: source="FILE:EXT:' . $_EXTKEY . '/Configuration/PageTS/admPanel.txt">');
}
*/
// TCEMAIN

//if (!$GLOBALS['TYPO3_CONF_VARS']['EXT']['extConf'][$_EXTKEY]['disablePageTsTCEMAIN']) {
    \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPageTSConfig('<INCLUDE_TYPOSCRIPT: source="FILE:EXT:' . $_EXTKEY . '/Configuration/PageTS/TCEMAIN.ts">');
//}

// TCEFORM
/*
if (!$GLOBALS['TYPO3_CONF_VARS']['EXT']['extConf'][$_EXTKEY]['disablePageTsTCEFORM']) {
    \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPageTSConfig('<INCLUDE_TYPOSCRIPT: source="FILE:EXT:' . $_EXTKEY . '/Configuration/PageTS/TCEFORM.txt">');
}
*/
// Configure the RTE to match the needs of Dans Package

#if (!$GLOBALS['TYPO3_CONF_VARS']['EXT']['extConf'][$_EXTKEY]['disablePageTsRTE']) {
    //\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPageTSConfig('<INCLUDE_TYPOSCRIPT: source="FILE:EXT:' . $_EXTKEY . '/Configuration/PageTS/RTE.ts">');
#}


/***************
 * Disable backend skin if disabled or version is 7.x and higher
 * Override is not nessecary anymore.
 */
//if (!$GLOBALS['TYPO3_CONF_VARS']['EXT']['extConf'][$_EXTKEY]['disableBackendSkin']
//    && (\TYPO3\CMS\Core\Utility\VersionNumberUtility::convertVersionNumberToInteger(TYPO3_version) < 7000000)
//) {

    /***************
     * Backend Styling
     */
/*
    $GLOBALS['TYPO3_CONF_VARS']['SYS']['Objects']['TYPO3\\CMS\\Backend\\View\\LogoView']['className'] = 'DAN\\Xclass\\Backend\\View\\LogoView';
    $GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['typo3/backend.php']['renderPreProcess'][] = 'DAN\\Hooks\\Backend\\RenderPreProcess->addStyles';
    $GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['typo3/template.php']['preHeaderRenderHook'][] = 'DAN\\Hooks\\Backend\\PreHeaderRender->addStyles';
*/
//}


/***************
 * Add Dans Package autoconfig to realurl
 */
/*
if (\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::isLoaded('realurl')) {
    $realUrlVersion = \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::getExtensionVersion('realurl');
    if (\TYPO3\CMS\Core\Utility\VersionNumberUtility::convertVersionNumberToInteger($realUrlVersion) < 2000000) {
        $GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['ext/realurl/class.tx_realurl_autoconfgen.php']['extensionConfiguration'][$_EXTKEY] = 'DAN\\Hooks\\RealUrl\\AutoConfig->addConfigVersion1x';
    } else {
        $GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['ext/realurl/class.tx_realurl_autoconfgen.php']['extensionConfiguration'][$_EXTKEY] = 'DAN\\Hooks\\RealUrl\\AutoConfig->addConfigVersion2x';
    }
    unset($realUrlVersion);
}
*/
/***************
 * Reset extConf array to avoid errors
 */
if (is_array($GLOBALS['TYPO3_CONF_VARS']['EXT']['extConf'][$_EXTKEY])) {
    $GLOBALS['TYPO3_CONF_VARS']['EXT']['extConf'][$_EXTKEY] = serialize($GLOBALS['TYPO3_CONF_VARS']['EXT']['extConf'][$_EXTKEY]);
}