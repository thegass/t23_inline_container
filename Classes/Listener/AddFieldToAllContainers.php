<?php

declare(strict_types=1);

namespace Team23\T23InlineContainer\Listener;

/*
 * This file is part of TYPO3 CMS-based extension "t23_inline_container" by TEAM23.

 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 */

use TYPO3\CMS\Core\Configuration\Event\AfterTcaCompilationEvent;
use TYPO3\CMS\Core\Utility\GeneralUtility;

class AddFieldToAllContainers {
    public function __invoke(AfterTcaCompilationEvent $event)
    {
        $containerRegistry = GeneralUtility::makeInstance(\B13\Container\Tca\Registry::class);

        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addToAllTCAtypes(
            'tt_content',
            'tx_t23inlinecontainer_elements',
            implode(
                ',',
                $containerRegistry->getRegisteredCTypes()
            ),
            'before:--div--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:tabs.appearance'
        );

        $event->setTca($GLOBALS['TCA']);
    }
}
