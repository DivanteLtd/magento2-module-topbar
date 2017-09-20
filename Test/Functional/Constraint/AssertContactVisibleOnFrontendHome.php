<?php
/**
 * @package   Divante\Topbar
 * @author    Marek Mularczyk <mmularczyk@divante.pl>
 * @copyright 2017 Divante Sp. z o.o.
 * @license   See LICENSE_DIVANTE.txt for license details.
 */

namespace Divante\Topbar\Test\Constraint;

use Magento\Mtf\Client\Locator;
use Magento\Mtf\Constraint\AbstractConstraint;
use Divante\Topbar\Test\Page\HomePage;
use Divante\Topbar\Test\Repository\ConfigData;

/**
 * Class AssertContactVisibleOnFrontendHome.
 */
class AssertContactVisibleOnFrontendHome extends AbstractConstraint
{
    /**
     * Assert that topbar is visible with good config
     *
     * @param HomePage   $homePage
     * @param ConfigData $configData
     *
     * @return void
     */
    public function processAssert(HomePage $homePage, ConfigData $configData)
    {
        $homePage->open();
        $topbar = $homePage->getTopbar();

        $emailElement = $topbar->getEmailElement();
        $emailValue   = current($emailElement->getElements('span', Locator::SELECTOR_TAG_NAME));

        $expectedValue = current($configData->get('email_config_information'))['value'];

        \PHPUnit_Framework_Assert::assertEquals(
            $expectedValue,
            $emailValue->getText(),
            'Wrong email is visible.' . "\n Expected: " .
            $expectedValue . "\n Actual: " . $emailElement->getText()
        );
    }

    /**
     * Returns a string representation of the object.
     *
     * @return string
     */
    public function toString()
    {
        return 'Configuration email visible on home page.';
    }
}
