<?php
/**
 * @package   Divante\Topbar
 * @author    Marek Mularczyk <mmularczyk@divante.pl>
 * @copyright 2017 Divante Sp. z o.o.
 * @license   See LICENSE_DIVANTE.txt for license details.
 */

namespace Divante\Topbar\Test\Constraint;

use Magento\Mtf\Constraint\AbstractConstraint;
use Divante\Topbar\Test\Page\HomePage;

/**
 * Class AssertTopbarNotVisibleOnFrontend.
 */
class AssertTopbarNotVisibleOnFrontend extends AbstractConstraint
{
    /**
     * Assert that topbar is not visible on frontend
     *
     * @param HomePage $homePage
     *
     * @return void
     */
    public function processAssert(HomePage $homePage)
    {
        $homePage->open();
        $topbar = $homePage->getTopbar();

        \PHPUnit_Framework_Assert::assertFalse(
            $topbar->isVisible(),
            'Topbar is visible in home page'
        );
    }

    /**
     * Returns a string representation of the object.
     *
     * @return string
     */
    public function toString()
    {
        return 'Topbar not visible on home page.';
    }
}
