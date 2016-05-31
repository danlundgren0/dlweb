<?php
$GLOBALS['TYPO3_CONF_VARS']['EXTCONF']['realurl']=[
    'dlweb.se.hosting.vajer.se' => [
        'init' => [
            'enableCHashCache' => true,
            'appendMissingSlash' => 'ifNotFile,redirect',
            'adminJumpToBackend' => true,
            'enableUrlDecodeCache' => true,
            'enableUrlEncodeCache' => true,
            'emptyUrlReturnValue' => '/',
        ],
        'pagePath' => [
            'type' => 'user',
            'userFunc' => 'Tx\\Realurl\\UriGeneratorAndResolver->main',
            'spaceCharacter' => '-',
            'languageGetVar' => 'L',
            'rootpage_id' => '1',
        ],
        'fileName' => [
            'defaultToHTMLsuffixOnPrev' => 0,
            'acceptHTMLsuffix' => 1,
            'index' => [
                'print' => [
                    'keyValues' => [
                        'type' => 98,
                    ],
                ],
            ],
        ],
        'preVars' => [
            [
                'GETvar' => 'no_cache',
                'valueMap' => [
                    'nc' => '1',
                ],
                'noMatch' => 'bypass',
            ],
            [
                'GETvar' => 'L',
                'valueMap' => [
                    'de' => '1',
                    'da' => '2',
                ],
                'noMatch' => 'bypass',
            ],
        ],
        'postVarSets' => [
            '_DEFAULT' => [
                'page' => [
                    [
                        'GETvar' => 'page',
                    ],
                ],
            ],
        ],
    ],
];
