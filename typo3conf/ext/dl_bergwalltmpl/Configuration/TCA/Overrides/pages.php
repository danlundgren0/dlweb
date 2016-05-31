<?php

/***************
 * Temporary variables
 */
$extensionKey = 'dl_bergwalltmpl';


/***************
 * Register PageTS
 */

// AdminPanel
/*
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::registerPageTSConfigFile(
    $extensionKey,
    'Configuration/PageTS/admPanel.txt',
    'Bootstrap Package: Admin Panel'
);
*/

// BackendLayouts
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::registerPageTSConfigFile(
    $extensionKey,
    'Configuration/PageTS/Mod/WebLayout/BackendLayouts.ts',
    'Bergwall template: Backend Layouts'
);

// TCEMAIN
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::registerPageTSConfigFile(
    $extensionKey,
    'Configuration/PageTS/TCEMAIN.ts',
    'Bergwall template: TCEMAIN'
);

// TCEFORM
/*
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::registerPageTSConfigFile(
    $extensionKey,
    'Configuration/PageTS/TCEFORM.txt',
    'Bootstrap Package: TCEFORM'
);
*/
// RTE
/*
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::registerPageTSConfigFile(
    $extensionKey,
    'Configuration/PageTS/RTE.txt',
    'Bootstrap Package: RTE'
);
*/