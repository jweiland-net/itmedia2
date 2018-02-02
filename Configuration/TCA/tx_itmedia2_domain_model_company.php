<?php
return [
    'ctrl' => [
        'title'    => 'LLL:EXT:itmedia2/Resources/Private/Language/locallang_db.xlf:tx_itmedia2_domain_model_company',
        'label' => 'company',
        'tstamp' => 'tstamp',
        'crdate' => 'crdate',
        'cruser_id' => 'cruser_id',
        'dividers2tabs' => true,
        'default_sortby' => 'ORDER BY company',

        'versioningWS' => 2,
        'versioning_followPages' => true,
        'origUid' => 't3_origuid',
        'languageField' => 'sys_language_uid',
        'transOrigPointerField' => 'l10n_parent',
        'transOrigDiffSourceField' => 'l10n_diffsource',
        'delete' => 'deleted',
        'enablecolumns' => [
            'disabled' => 'hidden',
            'starttime' => 'starttime',
            'endtime' => 'endtime'
        ],
        'searchFields' => 'company,logo,street,house_number,zip,city,telephone,fax,contact_person,email,website,opening_times,barrier_free,description,district,',
        'iconfile' => 'EXT:itmedia2/Resources/Public/Icons/tx_itmedia2_domain_model_company.gif'
    ],
    'interface' => [
        'showRecordFieldList' => 'sys_language_uid, l10n_parent, l10n_diffsource, hidden, wsp_member, company, logo, images, street, house_number, zip, city, telephone, fax, contact_person, email, website, opening_times, barrier_free, description, district, tx_maps2_uid, facebook, twitter, google, main_trade, trades'
    ],
    'types' => [
        '1' => [
            'showitem' => 'sys_language_uid;;;;1-1-1, l10n_parent, l10n_diffsource, hidden;;1, wsp_member, company,
            logo, images, street, house_number, zip, city, telephone, fax, contact_person, email, website,
            opening_times, barrier_free, description, district, tx_maps2_uid,
            --div--;LLL:EXT:itmedia2/Resources/Private/Language/locallang_db.xlf:tabs.social, facebook, twitter, google,
            --div--;LLL:EXT:itmedia2/Resources/Private/Language/locallang_db.xlf:tabs.trades, main_trade, trades,
            --div--;LLL:EXT:frontend/Resources/Private/Language/locallang_tca.xlf:pages.tabs.access, 
            --palette--;LLL:EXT:frontend/Resources/Private/Language/locallang_tca.xlf:pages.palettes.access;access'
        ]
    ],
    'palettes' => [
        'access' => [
            'showitem' => 'starttime;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:starttime_formlabel,endtime;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:endtime_formlabel',
        ]
    ],
    'columns' => [
        'sys_language_uid' => [
            'exclude' => true,
            'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.language',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectSingle',
                'special' => 'languages',
                'items' => [
                    [
                        'LLL:EXT:lang/locallang_general.xlf:LGL.allLanguages',
                        -1,
                        'flags-multiple'
                    ],
                ],
                'default' => 0,
            ]
        ],
        'l10n_parent' => [
            'displayCond' => 'FIELD:sys_language_uid:>:0',
            'exclude' => true,
            'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.l18n_parent',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectSingle',
                'items' => [
                    ['', 0],
                ],
                'foreign_table' => 'tx_itmedia2_domain_model_company',
                'foreign_table_where' => 'AND tx_itmedia2_domain_model_company.pid=###CURRENT_PID### AND tx_itmedia2_domain_model_company.sys_language_uid IN (-1,0)',
                'showIconTable' => false,
                'default' => 0,
            ]
        ],
        'l10n_diffsource' => [
            'config' => [
                'type' => 'passthrough',
                'default' => ''
            ]
        ],
        't3ver_label' => [
            'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.versionLabel',
            'config' => [
                'type' => 'input',
                'size' => '30',
                'max' => '255'
            ]
        ],
        'hidden' => [
            'exclude' => true,
            'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.hidden',
            'config' => [
                'type' => 'check',
                'items' => [
                    '1' => [
                        '0' => 'LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:hidden.I.0'
                    ]
                ]
            ]
        ],
        'starttime' => [
            'exclude' => true,
            'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.starttime',
            'config' => [
                'type' => 'input',
                'size' => '13',
                'eval' => 'datetime',
                'default' => 0
            ],
            'l10n_mode' => 'exclude',
            'l10n_display' => 'defaultAsReadonly'
        ],
        'endtime' => [
            'exclude' => true,
            'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.endtime',
            'config' => [
                'type' => 'input',
                'size' => '13',
                'eval' => 'datetime',
                'default' => 0,
                'range' => [
                    'upper' => mktime(0, 0, 0, 1, 1, 2038)
                ]
            ],
            'l10n_mode' => 'exclude',
            'l10n_display' => 'defaultAsReadonly'
        ],
        'wsp_member' => [
            'exclude' => true,
            'label' => 'LLL:EXT:itmedia2/Resources/Private/Language/locallang_db.xlf:tx_itmedia2_domain_model_company.wspMember',
            'config' => [
                'type' => 'check'
            ]
        ],
        'company' => [
            'exclude' => true,
            'label' => 'LLL:EXT:itmedia2/Resources/Private/Language/locallang_db.xlf:tx_itmedia2_domain_model_company.company',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim,required'
            ]
        ],
        'logo' => [
            'exclude' => true,
            'label' => 'LLL:EXT:itmedia2/Resources/Private/Language/locallang_db.xlf:tx_itmedia2_domain_model_company.logo',
            'config' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::getFileFieldTCAConfig(
                'logo',
                [
                    'minitems' => 0,
                    'maxitems' => 1,
                    'foreign_match_fields' => [
                        'fieldname' => 'logo',
                        'tablenames' => 'tx_itmedia2_domain_model_company',
                        'table_local' => 'sys_file'
                    ]
                ]
            )
        ],
        'images' => [
            'exclude' => true,
            'label' => 'LLL:EXT:itmedia2/Resources/Private/Language/locallang_db.xlf:tx_itmedia2_domain_model_company.images',
            'config' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::getFileFieldTCAConfig(
                'images',
                [
                    'minitems' => 0,
                    'maxitems' => 5,
                    'foreign_match_fields' => [
                        'fieldname' => 'images',
                        'tablenames' => 'tx_itmedia2_domain_model_company',
                        'table_local' => 'sys_file'
                    ]
                ]
            )
        ],
        'street' => [
            'exclude' => true,
            'label' => 'LLL:EXT:itmedia2/Resources/Private/Language/locallang_db.xlf:tx_itmedia2_domain_model_company.street',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim'
            ]
        ],
        'house_number' => [
            'exclude' => true,
            'label' => 'LLL:EXT:itmedia2/Resources/Private/Language/locallang_db.xlf:tx_itmedia2_domain_model_company.houseNumber',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim,required'
            ]
        ],
        'zip' => [
            'exclude' => true,
            'label' => 'LLL:EXT:itmedia2/Resources/Private/Language/locallang_db.xlf:tx_itmedia2_domain_model_company.zip',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim'
            ]
        ],
        'city' => [
            'exclude' => true,
            'label' => 'LLL:EXT:itmedia2/Resources/Private/Language/locallang_db.xlf:tx_itmedia2_domain_model_company.city',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim'
            ]
        ],
        'telephone' => [
            'exclude' => true,
            'label' => 'LLL:EXT:itmedia2/Resources/Private/Language/locallang_db.xlf:tx_itmedia2_domain_model_company.telephone',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim'
            ]
        ],
        'fax' => [
            'exclude' => true,
            'label' => 'LLL:EXT:itmedia2/Resources/Private/Language/locallang_db.xlf:tx_itmedia2_domain_model_company.fax',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim'
            ]
        ],
        'contact_person' => [
            'exclude' => true,
            'label' => 'LLL:EXT:itmedia2/Resources/Private/Language/locallang_db.xlf:tx_itmedia2_domain_model_company.contactPerson',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim'
            ]
        ],
        'email' => [
            'exclude' => true,
            'label' => 'LLL:EXT:itmedia2/Resources/Private/Language/locallang_db.xlf:tx_itmedia2_domain_model_company.email',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim'
            ]
        ],
        'website' => [
            'exclude' => true,
            'label' => 'LLL:EXT:itmedia2/Resources/Private/Language/locallang_db.xlf:tx_itmedia2_domain_model_company.website',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim'
            ]
        ],
        'opening_times' => [
            'exclude' => true,
            'label' => 'LLL:EXT:itmedia2/Resources/Private/Language/locallang_db.xlf:tx_itmedia2_domain_model_company.openingTimes',
            'config' => [
                'type' => 'text',
                'cols' => 30,
                'rows' => 5,
                'eval' => 'trim'
            ]
        ],
        'barrier_free' => [
            'exclude' => true,
            'label' => 'LLL:EXT:itmedia2/Resources/Private/Language/locallang_db.xlf:tx_itmedia2_domain_model_company.barrierFree',
            'config' => [
                'type' => 'check',
                'default' => 0
            ]
        ],
        'description' => [
            'exclude' => true,
            'label' => 'LLL:EXT:itmedia2/Resources/Private/Language/locallang_db.xlf:tx_itmedia2_domain_model_company.description',
            'config' => [
                'type' => 'text',
                'cols' => 40,
                'rows' => 15,
                'eval' => 'trim,required',
                'wizards' => [
                    'RTE' => [
                        'icon' => 'wizard_rte2.gif',
                        'notNewRecords'=> 1,
                        'RTEonly' => 1,
                        'script' => 'wizard_rte.php',
                        'title' => 'LLL:EXT:cms/locallang_ttc.xlf:bodytext.W.RTE',
                        'type' => 'script',
                        'module' => [
                            'name' => 'wizard_rte'
                        ]
                    ]
                ]
            ],
            'defaultExtras' => 'richtext:rte_transform[flag=rte_enabled|mode=ts]'
        ],
        'district' => [
            'exclude' => true,
            'label' => 'LLL:EXT:itmedia2/Resources/Private/Language/locallang_db.xlf:tx_itmedia2_domain_model_company.district',
            'config' => [
                'type' => 'select',
                'foreign_table' => 'tx_yellowpages2_domain_model_district',
                'foreign_table_where' => 'ORDER BY tx_yellowpages2_domain_model_district.district',
                'items' => [
                    ['LLL:EXT:itmedia2/Resources/Private/Language/locallang_db.xlf:tx_itmedia2_domain_model_company.district.pleaseChoose', '']
                ],
                'minitems' => 0,
                'maxitems' => 1,
                'default' => 0
            ]
        ],
        'tx_maps2_uid' => [
            'exclude' => true,
            'label' => 'LLL:EXT:maps2/Resources/Private/Language/locallang_db.xlf:tx_maps2_uid',
            'config' => [
                'type' => 'group',
                'internal_type' => 'db',
                'allowed' => 'tx_maps2_domain_model_poicollection',
                'prepend_tname' => false,
                'show_thumbs' => false,
                'size' => 1,
                'maxitems' => 1,
                'wizards' => [
                    'suggest' => [
                        'type' => 'suggest',
                        'default' => [
                            'searchWholePhrase' => true
                        ],
                        'module' => [
                            'name' => 'wizard_suggest'
                        ]
                    ]
                ]
            ]
        ],
        'facebook' => [
            'exclude' => true,
            'label' => 'LLL:EXT:itmedia2/Resources/Private/Language/locallang_db.xlf:tx_itmedia2_domain_model_company.facebook',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim',
                'wizards' => [
                    '_PADDING' => 2,
                    'link' => [
                        'type' => 'popup',
                        'title' => 'Link',
                        'icon' => 'link_popup.gif',
                        'script' => 'browse_links.php?mode=wizard',
                        'JSopenParams' => 'height=300,width=500,status=0,menubar=0,scrollbars=1',
                        'module' => [
                            'name' => 'wizard_link'
                        ]
                    ]
                ],
                'softref' => 'typolink[linkList]'
            ]
        ],
        'twitter' => [
            'exclude' => true,
            'label' => 'LLL:EXT:itmedia2/Resources/Private/Language/locallang_db.xlf:tx_itmedia2_domain_model_company.twitter',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim',
                'wizards' => [
                    '_PADDING' => 2,
                    'link' => [
                        'type' => 'popup',
                        'title' => 'Link',
                        'icon' => 'link_popup.gif',
                        'script' => 'browse_links.php?mode=wizard',
                        'JSopenParams' => 'height=300,width=500,status=0,menubar=0,scrollbars=1',
                        'module' => [
                            'name' => 'wizard_link'
                        ]
                    ]
                ],
                'softref' => 'typolink[linkList]'
            ]
        ],
        'google' => [
            'exclude' => true,
            'label' => 'LLL:EXT:itmedia2/Resources/Private/Language/locallang_db.xlf:tx_itmedia2_domain_model_company.google',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim',
                'wizards' => [
                    '_PADDING' => 2,
                    'link' => [
                        'type' => 'popup',
                        'title' => 'Link',
                        'icon' => 'link_popup.gif',
                        'script' => 'browse_links.php?mode=wizard',
                        'JSopenParams' => 'height=300,width=500,status=0,menubar=0,scrollbars=1',
                        'module' => [
                            'name' => 'wizard_link'
                        ]
                    ]
                ],
                'softref' => 'typolink[linkList]'
            ]
        ],
        'main_trade' => [
            'exclude' => true,
            'label' => 'LLL:EXT:itmedia2/Resources/Private/Language/locallang_db.xlf:tx_itmedia2_domain_model_company.mainTrade',
            'config' => [
                'type' => 'select',
                'foreign_table' => 'sys_category',
                'renderMode' => 'tree',
                'size' => 10,
                'autoSizeMax' => 50,
                'treeConfig' => [
                    'parentField' => 'parent',
                    'appearance' => [
                        'showHeader' => true,
                        'expandAll' => true
                    ]
                ],
                'minitems' => 0,
                'maxitems' => 1
            ]
        ],
        'trades' => [
            'exclude' => true,
            'label' => 'LLL:EXT:itmedia2/Resources/Private/Language/locallang_db.xlf:tx_itmedia2_domain_model_company.trades',
            'config' => [
                'type' => 'select',
                'foreign_table' => 'sys_category',
                'MM' => 'sys_category_record_mm',
                'MM_match_fields' => [
                    'tablenames' => 'tx_itmedia2_domain_model_company',
                    'fieldname' => 'trades'
                ],
                'MM_opposite_field' => 'items',
                'renderMode' => 'tree',
                'treeConfig' => [
                    'rootUid' => 0,
                    'parentField' => 'parent',
                    'appearance' => [
                        'showHeader' => true,
                        'expandAll' => false
                    ]
                ],
                'minitems' => 0,
                'maxitems' => 2
            ]
        ]
    ]
];
