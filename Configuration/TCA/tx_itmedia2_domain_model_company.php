<?php

/*
 * This file is part of the package jweiland/itmedia2.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

return [
    'ctrl' => [
        'title' => 'LLL:EXT:itmedia2/Resources/Private/Language/locallang_db.xlf:tx_itmedia2_domain_model_company',
        'label' => 'company',
        'tstamp' => 'tstamp',
        'crdate' => 'crdate',
        'default_sortby' => 'ORDER BY company',
        'versioningWS' => true,
        'origUid' => 't3_origuid',
        'languageField' => 'sys_language_uid',
        'transOrigPointerField' => 'l10n_parent',
        'transOrigDiffSourceField' => 'l10n_diffsource',
        'delete' => 'deleted',
        'enablecolumns' => [
            'disabled' => 'hidden',
            'starttime' => 'starttime',
            'endtime' => 'endtime',
        ],
        'searchFields' => 'company,logo,street,house_number,zip,city,telephone,fax,contact_person,email,website,opening_times,barrier_free,description,district,',
        'iconfile' => 'EXT:itmedia2/Resources/Public/Icons/tx_itmedia2_domain_model_company.svg',
    ],
    'types' => [
        '1' => [
            'showitem' => '--palette--;;languageHidden, company, path_segment,
            logo, images, image_maps,
            --palette--;;streetHouseNumber, --palette--;;zipCity, --palette--;;districtBarrierFree,
            --palette--;;telephoneFax, --palette--;;emailWebsite, contact_person,
            opening_times, description, floors, position,
            --div--;LLL:EXT:itmedia2/Resources/Private/Language/locallang_db.xlf:tabs.social, facebook, twitter, instagram,
            --div--;LLL:EXT:itmedia2/Resources/Private/Language/locallang_db.xlf:tabs.trades, main_trade, trades,
            --div--;LLL:EXT:frontend/Resources/Private/Language/locallang_tca.xlf:pages.tabs.access,
            --palette--;LLL:EXT:frontend/Resources/Private/Language/locallang_tca.xlf:pages.palettes.access;access',
        ],
    ],
    'palettes' => [
        'languageHidden' => ['showitem' => 'sys_language_uid, l10n_parent, hidden'],
        'streetHouseNumber' => ['showitem' => 'street, house_number'],
        'districtBarrierFree' => ['showitem' => 'district, barrier_free'],
        'zipCity' => ['showitem' => 'zip, city'],
        'telephoneFax' => ['showitem' => 'telephone, fax'],
        'emailWebsite' => ['showitem' => 'email, website'],
        'access' => [
            'showitem' => 'starttime;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:starttime_formlabel,endtime;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:endtime_formlabel',
        ],
    ],
    'columns' => [
        'sys_language_uid' => [
            'exclude' => true,
            'label' => 'LLL:EXT:core/Resources/Private/Language/locallang_general.xlf:LGL.language',
            'config' => ['type' => 'language'],
        ],
        'l10n_parent' => [
            'displayCond' => 'FIELD:sys_language_uid:>:0',
            'label' => 'LLL:EXT:core/Resources/Private/Language/locallang_general.xlf:LGL.l18n_parent',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectSingle',
                'items' => [
                    ['label' => '', 'value' => 0],
                ],
                'foreign_table' => 'tx_itmedia2_domain_model_company',
                'foreign_table_where' => 'AND tx_itmedia2_domain_model_company.pid=###CURRENT_PID### AND tx_itmedia2_domain_model_company.sys_language_uid IN (-1,0)',
                'fieldWizard' => [
                    'selectIcons' => [
                        'disabled' => true,
                    ],
                ],
                'default' => 0,
            ],
        ],
        'l10n_diffsource' => [
            'config' => [
                'type' => 'passthrough',
                'default' => '',
            ],
        ],
        'hidden' => [
            'exclude' => true,
            'label' => 'LLL:EXT:core/Resources/Private/Language/locallang_general.xlf:LGL.hidden',
            'config' => [
                'type' => 'check',
                'renderType' => 'checkboxToggle',
                'default' => 0,
            ],
        ],
        'cruser_id' => [
            'label' => 'cruser_id',
            'config' => [
                'type' => 'passthrough',
            ],
        ],
        'pid' => [
            'label' => 'pid',
            'config' => [
                'type' => 'passthrough',
            ],
        ],
        'crdate' => [
            'label' => 'crdate',
            'config' => [
                'type' => 'passthrough',
            ],
        ],
        'tstamp' => [
            'label' => 'tstamp',
            'config' => [
                'type' => 'passthrough',
            ],
        ],
        'starttime' => [
            'exclude' => true,
            'label' => 'LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:starttime_formlabel',
            'config' => [
                'type' => 'datetime',
                'default' => 0,
                'behaviour' => [
                    'allowLanguageSynchronization' => true,
                ],
            ],
        ],
        'endtime' => [
            'exclude' => true,
            'label' => 'LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:endtime_formlabel',
            'config' => [
                'type' => 'datetime',
                'default' => 0,
                'behaviour' => [
                    'allowLanguageSynchronization' => true,
                ],
            ],
        ],
        'company' => [
            'exclude' => true,
            'label' => 'LLL:EXT:itmedia2/Resources/Private/Language/locallang_db.xlf:tx_itmedia2_domain_model_company.company',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim',
                'required' => true,
            ],
        ],
        'path_segment' => [
            'label' => 'LLL:EXT:itmedia2/Resources/Private/Language/locallang_db.xlf:tx_itmedia2_domain_model_company.path_segment',
            'displayCond' => 'VERSION:IS:false',
            'config' => [
                'type' => 'slug',
                'size' => 50,
                'generatorOptions' => [
                    'fields' => ['company'],
                    // Do not add pageSlug, as we add pageSlug on our own in RouteEnhancer
                    'prefixParentPageSlug' => false,
                    'fieldSeparator' => '-',
                    'replacements' => [
                        '/' => '-',
                    ],
                ],
                'fallbackCharacter' => '-',
                'eval' => 'unique',
                'default' => '',
            ],
        ],
        'logo' => [
            'exclude' => true,
            'label' => 'LLL:EXT:itmedia2/Resources/Private/Language/locallang_db.xlf:tx_itmedia2_domain_model_company.logo',
            'config' => [
                'type' => 'file',
                'maxitems' => 1,
                'allowed' => 'common-image-types',
            ],
        ],
        'images' => [
            'exclude' => true,
            'label' => 'LLL:EXT:itmedia2/Resources/Private/Language/locallang_db.xlf:tx_itmedia2_domain_model_company.images',
            'config' => [
                'type' => 'file',
                'maxitems' => 5,
                'allowed' => 'common-image-types',
            ],
        ],
        'image_maps' => [
            'exclude' => true,
            'label' => 'LLL:EXT:itmedia2/Resources/Private/Language/locallang_db.xlf:tx_itmedia2_domain_model_company.image_maps',
            'config' => [
                'type' => 'file',
                'maxitems' => 1,
                'allowed' => 'common-image-types',
            ],
        ],
        'street' => [
            'exclude' => true,
            'label' => 'LLL:EXT:itmedia2/Resources/Private/Language/locallang_db.xlf:tx_itmedia2_domain_model_company.street',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim',
            ],
        ],
        'house_number' => [
            'exclude' => true,
            'label' => 'LLL:EXT:itmedia2/Resources/Private/Language/locallang_db.xlf:tx_itmedia2_domain_model_company.houseNumber',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim',
                'required' => true,
            ],
        ],
        'zip' => [
            'exclude' => true,
            'label' => 'LLL:EXT:itmedia2/Resources/Private/Language/locallang_db.xlf:tx_itmedia2_domain_model_company.zip',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim',
            ],
        ],
        'city' => [
            'exclude' => true,
            'label' => 'LLL:EXT:itmedia2/Resources/Private/Language/locallang_db.xlf:tx_itmedia2_domain_model_company.city',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim',
            ],
        ],
        'telephone' => [
            'exclude' => true,
            'label' => 'LLL:EXT:itmedia2/Resources/Private/Language/locallang_db.xlf:tx_itmedia2_domain_model_company.telephone',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim',
            ],
        ],
        'fax' => [
            'exclude' => true,
            'label' => 'LLL:EXT:itmedia2/Resources/Private/Language/locallang_db.xlf:tx_itmedia2_domain_model_company.fax',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim',
            ],
        ],
        'contact_person' => [
            'exclude' => true,
            'label' => 'LLL:EXT:itmedia2/Resources/Private/Language/locallang_db.xlf:tx_itmedia2_domain_model_company.contactPerson',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim',
            ],
        ],
        'email' => [
            'exclude' => true,
            'label' => 'LLL:EXT:itmedia2/Resources/Private/Language/locallang_db.xlf:tx_itmedia2_domain_model_company.email',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim',
            ],
        ],
        'website' => [
            'exclude' => true,
            'label' => 'LLL:EXT:itmedia2/Resources/Private/Language/locallang_db.xlf:tx_itmedia2_domain_model_company.website',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim',
            ],
        ],
        'opening_times' => [
            'exclude' => true,
            'label' => 'LLL:EXT:itmedia2/Resources/Private/Language/locallang_db.xlf:tx_itmedia2_domain_model_company.openingTimes',
            'config' => [
                'type' => 'text',
                'cols' => 30,
                'rows' => 5,
                'eval' => 'trim',
            ],
        ],
        'barrier_free' => [
            'exclude' => true,
            'label' => 'LLL:EXT:itmedia2/Resources/Private/Language/locallang_db.xlf:tx_itmedia2_domain_model_company.barrierFree',
            'config' => [
                'type' => 'check',
                'renderType' => 'checkboxToggle',
                'default' => 0,
            ],
        ],
        'description' => [
            'exclude' => true,
            'label' => 'LLL:EXT:itmedia2/Resources/Private/Language/locallang_db.xlf:tx_itmedia2_domain_model_company.description',
            'config' => [
                'type' => 'text',
                'cols' => 40,
                'rows' => 15,
                'softref' => 'typolink_tag,images,email[subst],url',
                'enableRichtext' => true,
            ],
        ],
        'district' => [
            'exclude' => true,
            'label' => 'LLL:EXT:yellowpages2/Resources/Private/Language/locallang_db.xlf:tx_yellowpages2_domain_model_company.district',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectSingle',
                'foreign_table' => 'tx_yellowpages2_domain_model_district',
                'foreign_table_where' => 'ORDER BY tx_yellowpages2_domain_model_district.district',
                'items' => [
                    ['label' => 'LLL:EXT:yellowpages2/Resources/Private/Language/locallang_db.xlf:tx_yellowpages2_domain_model_company.district.pleaseChoose', 'value' => 0],
                ],
                'minitems' => 0,
                'maxitems' => 1,
                'default' => 0,
            ],
        ],
        'floors' => [
            'exclude' => true,
            'label' => 'LLL:EXT:itmedia2/Resources/Private/Language/locallang_db.xlf:tx_itmedia2_domain_model_company.floors',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectMultipleSideBySide',
                'foreign_table' => 'tx_itmedia2_domain_model_floor',
                'foreign_table_where' => 'ORDER BY tx_itmedia2_domain_model_floor.sorting',
            ],
        ],
        'position' => [
            'exclude' => true,
            'label' => 'LLL:EXT:itmedia2/Resources/Private/Language/locallang_db.xlf:tx_itmedia2_domain_model_company.position',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectSingle',
                'foreign_table' => 'tx_itmedia2_domain_model_position',
                'foreign_table_where' => 'ORDER BY tx_itmedia2_domain_model_position.title',
                'items' => [
                    ['label' => 'LLL:EXT:itmedia2/Resources/Private/Language/locallang_db.xlf:tx_itmedia2_domain_model_company.position.pleaseChoose', 'value' => 0],
                ],
                'minitems' => 0,
                'maxitems' => 1,
                'default' => 0,
            ],
        ],
        'facebook' => [
            'exclude' => true,
            'label' => 'LLL:EXT:itmedia2/Resources/Private/Language/locallang_db.xlf:tx_itmedia2_domain_model_company.facebook',
            'config' => [
                'type' => 'link',
            ],
        ],
        'twitter' => [
            'exclude' => true,
            'label' => 'LLL:EXT:itmedia2/Resources/Private/Language/locallang_db.xlf:tx_itmedia2_domain_model_company.twitter',
            'config' => [
                'type' => 'link',
                'allowedTypes' => ['page', 'url', 'record'],
            ],
        ],
        'instagram' => [
            'exclude' => true,
            'label' => 'LLL:EXT:itmedia2/Resources/Private/Language/locallang_db.xlf:tx_itmedia2_domain_model_company.instagram',
            'config' => [
                'type' => 'link',
                'allowedTypes' => ['page', 'url', 'record'],
            ],
        ],
        'main_trade' => [
            'exclude' => true,
            'label' => 'LLL:EXT:itmedia2/Resources/Private/Language/locallang_db.xlf:tx_itmedia2_domain_model_company.mainTrade',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectTree',
                'treeConfig' => [
                    'parentField' => 'parent',
                    'appearance' => [
                        'showHeader' => true,
                        'expandAll' => true,
                        'maxLevels' => 99,
                    ],
                ],
                'MM' => 'sys_category_record_mm',
                'MM_match_fields' => [
                    'fieldname' => 'main_trade',
                    'tablenames' => 'tx_itmedia2_domain_model_company',
                ],
                'MM_opposite_field' => 'items',
                'foreign_table' => 'sys_category',
                'foreign_table_where' => ' AND (sys_category.sys_language_uid = 0 OR sys_category.l10n_parent = 0) ORDER BY sys_category.sorting',
                'size' => 10,
                'minitems' => 1,
                'maxitems' => 1,
                'behaviour' => [
                    'allowLanguageSynchronization' => true,
                ],
            ],
        ],
        'trades' => [
            'exclude' => true,
            'label' => 'LLL:EXT:itmedia2/Resources/Private/Language/locallang_db.xlf:tx_itmedia2_domain_model_company.trades',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectTree',
                'treeConfig' => [
                    'parentField' => 'parent',
                    'appearance' => [
                        'showHeader' => true,
                        'expandAll' => true,
                        'maxLevels' => 99,
                    ],
                ],
                'MM' => 'sys_category_record_mm',
                'MM_match_fields' => [
                    'fieldname' => 'trades',
                    'tablenames' => 'tx_itmedia2_domain_model_company',
                ],
                'MM_opposite_field' => 'items',
                'foreign_table' => 'sys_category',
                'foreign_table_where' => ' AND (sys_category.sys_language_uid = 0 OR sys_category.l10n_parent = 0) ORDER BY sys_category.sorting',
                'size' => 10,
                'minitems' => 0,
                'maxitems' => 2,
                'behaviour' => [
                    'allowLanguageSynchronization' => true,
                ],
            ],
        ],
    ],
];
