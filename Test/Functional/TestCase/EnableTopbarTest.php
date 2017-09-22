<?php
/**
 * @package   Divante\Topbar
 * @author    Marek Mularczyk <mmularczyk@divante.pl>
 * @copyright 2017 Divante Sp. z o.o.
 * @license   See LICENSE_DIVANTE.txt for license details.
 */

namespace Divante\Topbar\Test\TestCase;

use Magento\Mtf\TestCase\Injectable;
use Divante\Topbar\Test\Page\Adminhtml\SystemConfigEditSectionDivante;

/**
 * Class EnableTopbarTest.
 *
 * Requirements: none.
 *
 * Test scenario:
 * 1) Log in to admin panel
 * 2) Go to Stores>Configuration>Divante Extensions>Topbar
 * 3) Set Topbar as Enabled
 * 4) Go to home page and check that topbar is visible
 */
class EnableTopbarTest extends Injectable
{
    /**
     * @var SystemConfigEditSectionDivante
     */
    private $configPage;

    /* Variables for organization */

    /**
     * @var string
     */
    protected $oldValueOfField;

    /**
     * Information where option is located
     *
     * @var array
     */
    protected $selector = [
        'tab'   => null,
        'group' => null,
        'field' => null,
    ];

    /* Variables for organization end*/

    /**
     * Class preparation
     *
     * @param SystemConfigEditSectionDivante $configPage
     */
    public function __inject(SystemConfigEditSectionDivante $configPage)
    {
        $this->configPage = $configPage;
    }

    /**
     * Test execution method
     */
    public function test()
    {
        $this->configPage->open();

        $configuration = $this->currentVariation['arguments'];

        /* Find field in admin configuration */
        $section = $configuration['path'];
        $parts   = explode('/', $section, 3);

        $this->selector['tab']   = $parts[0];
        $this->selector['group'] = $parts[1];
        $this->selector['field']  = $parts[2];

        $storeInformation = $this->configPage->getForm()->getGroup($this->selector['tab'], $this->selector['group']);

        /* Save old value of field for future cleaning*/
        $this->oldValueOfField = $storeInformation->getValue(
            $this->selector['tab'],
            $this->selector['group'],
            $this->selector['field']
        );

        /* Save email and wait for success message */
        $storeInformation->setValue(
            $this->selector['tab'],
            $this->selector['group'],
            $this->selector['field'],
            $configuration['value']
        );

        $this->configPage->getPageActions()->save();
        $this->configPage->getMessagesBlock()->waitSuccessMessage();
    }

    /**
     * Method is responsible for cleaning after tests
     */
    public function tearDown()
    {
        $this->configPage->open();

        $storeInformation = $this->configPage->getForm()->getGroup($this->selector['tab'], $this->selector['group']);

        /* Save old value and wait for success message */
        $storeInformation->setValue(
            $this->selector['tab'],
            $this->selector['group'],
            $this->selector['field'],
            $this->oldValueOfField
        );

        $this->configPage->getPageActions()->save();
        $this->configPage->getMessagesBlock()->waitSuccessMessage();
    }
}
