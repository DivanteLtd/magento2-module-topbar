<?php
/**
 * @package   Divante\Topbar
 * @author    Marek Mularczyk <mmularczyk@divante.pl>
 * @copyright 2017 Divante Sp. z o.o.
 * @license   See LICENSE_DIVANTE.txt for license details.
 */

namespace Divante\Topbar\Test\TestCase;

use Magento\Mtf\TestCase\Injectable;
use Divante\Topbar\Test\Page\Adminhtml\SystemConfigEditSectionGeneral;
use Divante\Topbar\Test\Repository\ConfigData;

/**
 * Class ChangeGeneralSettingsForTopbarTest.
 *
 * Requirements: Divante Topbar must be set to ENABLED
 *
 * Notice: in core_config_data table where path="divante/topbar/enabled" value should be "1" or remove that row
 *
 * Test scenario:
 * 1) Log in to admin panel
 * 2) Go to Stores>Configuration
 * 3) Set new general phone number for store
 * 4) Go to home page and check that new phone is visible
 */
class ChangeGeneralSettingsForTopbarTest extends Injectable
{
    /**
     * @var SystemConfigEditSectionGeneral
     */
    private $configPage;

    protected $phoneConfig;

    /* Variables for organization */
    /**
     * @var ConfigData
     */
    protected $configData;

    /**
     * @var string
     */
    protected $oldValueOfField;

    /* Variables for organization end*/

    public function __inject(SystemConfigEditSectionGeneral $configPage)
    {
        $this->configPage = $configPage;
    }

    public function test(ConfigData $configData)
    {
        $this->configData = $configData;

        $this->configPage->open();

        /* Find field in admin configuration */
        $section = $this->configData->get('phone_config_information');
        $keys    = array_keys($section);
        $parts   = explode('/', $keys[0], 3);

        $tab   = $parts[0];
        $group = $parts[1];
        $field = $parts[2];

        $storeInformation = $this->configPage->getForm()->getGroup($tab, $group);

        /* Save old value of field for future cleaning*/
        $this->oldValueOfField = $storeInformation->getValue($tab, $group, $field);

        /* Save phone and wait for success message */
        $storeInformation->setValue($tab, $group, $field, $section[$keys[0]]['value']);
        $this->configPage->getPageActions()->save();
        $this->configPage->getMessagesBlock()->waitSuccessMessage();
    }

    /**
     * Method is responsible for cleaning after tests
     */
    public function tearDown()
    {
        $this->configPage->open();

        /* Find field in admin configuration */
        $section = $this->configData->get('phone_config_information');
        $keys    = array_keys($section);
        $parts   = explode('/', $keys[0], 3);

        $tab   = $parts[0];
        $group = $parts[1];
        $field = $parts[2];

        $storeInformation = $this->configPage->getForm()->getGroup($tab, $group);

        /* Save old value and wait for success message */
        $storeInformation->setValue($tab, $group, $field, $this->oldValueOfField);
        $this->configPage->getPageActions()->save();
        $this->configPage->getMessagesBlock()->waitSuccessMessage();
    }
}
