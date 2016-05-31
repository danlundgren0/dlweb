<?php
//srv/sites/bergwall.se/web/typo3conf/ext/dl_bergwalltmpl/Configuration/TCA/Overrides
/***************
 * Add Content Elements to List
 */
$backupCTypeItems = $GLOBALS['TCA']['tt_content']['columns']['CType']['config']['items'];
$GLOBALS['TCA']['tt_content']['columns']['CType']['config']['items'] = array(
    array(
        'LLL:EXT:dl_bergwalltmpl/Resources/Private/Language/Backend.xlf:theme_name',
        '--div--'
    ),
    array(
        'LLL:EXT:dl_bergwalltmpl/Resources/Private/Language/Backend.xlf:content_element.button',
        'dl_bergwalltmpl_button',
        'i/tt_content_header.gif'
    ),
);
foreach ($backupCTypeItems as $key => $value) {
    $GLOBALS['TCA']['tt_content']['columns']['CType']['config']['items'][] = $value;
}
unset($key);
unset($value);
unset($backupCTypeItems);


/***************
 * Add FlexForms for content element configuration
 */
/*
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPiFlexFormValue('*',
    'FILE:EXT:dl_bergwalltmpl/Configuration/FlexForms/Button.xml', 'bootstrap_package_carousel');
*/

/***************
 * Modify the tt_content TCA
 */
$tca = array(
    'ctrl' => array(
        'requestUpdate' => $GLOBALS['TCA']['tt_content']['ctrl']['requestUpdate'] . ',icon_type',
        'typeicons' => array(
            'dl_bergwalltmpl_button' => 'tt_content_header.gif',
        ),
    ),
    'palettes' => array(
        'dans_header' => array(
            'canNotCollapse' => 1,
            'showitem' => '
				header;LLL:EXT:cms/locallang_ttc.xlf:header_formlabel,
				--linebreak--,
				subheader;LLL:EXT:cms/locallang_ttc.xlf:subheader_formlabel,
				--linebreak--,
				header_layout;LLL:EXT:cms/locallang_ttc.xlf:header_layout_formlabel,
				--linebreak--,
				header_link;LLL:EXT:cms/locallang_ttc.xlf:header_link_formlabel
			'
        ),
    ),
    'types' => array(
        '1' => array('showitem' => 'sys_language_uid;;;;1-1-1, l10n_parent, l10n_diffsource, hidden;;1, button_text, button_link, --div--;LLL:EXT:cms/locallang_ttc.xlf:tabs.access, starttime, endtime'),
    ),
    'types' => array(
        'dl_bergwalltmpl_button' => array(
            'columnsOverrides' => array(
                'bodytext' => array(
                    'defaultExtras' => 'nowrap'
                ),
            ),
            'showitem' => '
				--palette--;LLL:EXT:cms/locallang_ttc.xlf:palette.general;general,button_text,button_link,
				--div--;LLL:EXT:cms/locallang_ttc.xlf:tabs.appearance,
				--palette--;LLL:EXT:cms/locallang_ttc.xlf:palette.frames;frames,
				--div--;LLL:EXT:cms/locallang_ttc.xlf:tabs.access,
				--palette--;LLL:EXT:cms/locallang_ttc.xlf:palette.visibility;visibility,
				--palette--;LLL:EXT:cms/locallang_ttc.xlf:palette.access;access,
				--div--;LLL:EXT:cms/locallang_ttc.xlf:tabs.extended,
				--div--;LLL:EXT:lang/locallang_tca.xlf:sys_category.tabs.category,
				categories
			'
        ),
    ),
    'columns' => array(
        'button_text' => array(
            'label' => 'Button text',
            'config' => array(
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim',
            ),
        ),
        'button_link' => array(
            'label' => 'Button Link',
            'config' => array(
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim',
                'wizards' => array(
                        '_PADDING' => 2,
                        'link' => array(
                                'type' => 'popup',
                                'title' => 'LLL:EXT:cms/locallang_ttc.xlf:header_link_formlabel',
                                'icon' => 'link_popup.gif',
                                'module' => array(
                                        'name' => 'wizard_element_browser',
                                        'urlParameters' => array(
                                                'mode' => 'wizard'
                                        )
                                ),
                                'JSopenParams' => 'height=300,width=500,status=0,menubar=0,scrollbars=1'
                        )
                ),
                'softref' => 'typolink'
            ),
        ),
    ),
);
$GLOBALS['TCA']['tt_content'] = array_replace_recursive($GLOBALS['TCA']['tt_content'], $tca);


/***************
 * Add subheader to header palette
 */
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addFieldsToPalette('tt_content', 'header',
    '--linebreak--, subheader;LLL:EXT:cms/locallang_ttc.xlf:subheader_formlabel');
