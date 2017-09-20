<?php
/**
 * @package   Divante\Topbar
 * @author    Marek Mularczyk <mmularczyk@divante.pl>
 * @copyright 2017 Divante Sp. z o.o.
 * @license   See LICENSE_DIVANTE.txt for license details.
 */

namespace Divante\Topbar\Test\Constraint;

use Magento\Mtf\Constraint\AbstractConstraint;
use Magento\Backend\Test\Page\Adminhtml\SystemConfigEdit;
use Magento\PageCache\Test\Page\Adminhtml\AdminCache;

/**
 * Class AssertConfigurationSaveMessage.
 */
class AssertConfigurationSaveMessage extends AbstractConstraint
{
    /**
     * @var string
     */
    const SUCCESS_MESSAGE = 'You saved the configuration.';

    /**
     * Assert that success message is displayed after config save.
     *
     * @param SystemConfigEdit $systemConfigEdit
     * @param AdminCache       $adminCache
     *
     * @return void
     */
    public function processAssert(SystemConfigEdit $systemConfigEdit, AdminCache $adminCache)
    {
        $actualMessage = $systemConfigEdit->getMessagesBlock()->getSuccessMessage();

        \PHPUnit_Framework_Assert::assertEquals(
            self::SUCCESS_MESSAGE,
            $actualMessage,
            'Different message was displayed' . "\nExpected: " . self::SUCCESS_MESSAGE . "\nActual: " . $actualMessage
        );

        // Flush cache
        $adminCache->open();
        $adminCache->getActionsBlock()->flushMagentoCache();
        $adminCache->getMessagesBlock()->waitSuccessMessage();
    }

    /**
     * Returns a string representation of the object.
     *
     * @return string
     */
    public function toString()
    {
        return 'Assert that success message is displayed.';
    }
}
