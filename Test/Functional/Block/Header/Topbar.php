<?php
/**
 * @package   Divante\Topbar
 * @author    Marek Mularczyk <mmularczyk@divante.pl>
 * @copyright 2017 Divante Sp. z o.o.
 * @license   See LICENSE_DIVANTE.txt for license details.
 */

namespace Divante\Topbar\Test\Block\Header;

use Magento\Mtf\Block\Block;
use Magento\Mtf\Client\Locator;
use Magento\Mtf\Client\ElementInterface;

/**
 * Class Topbar.
 */
class Topbar extends Block
{
    /**
     * Topbar selector
     *
     * @var string
     */
    protected $topbarSelector = '.header-top-bar';

    /**
     * Phone element class
     *
     * @var string
     */
    protected $elementPhoneClass = 'phone';

    /**
     * Topbar div structure
     *
     * @var array
     */
    protected $topbarStructure = [
        'email' => 0,
        'phone' => 1,
        'links' => 2,
    ];

    /**
     * Get topbar phone element
     *
     * @return ElementInterface
     */
    public function getPhoneElement()
    {
        return $this->_rootElement->find(
            'phone',
            Locator::SELECTOR_CLASS_NAME
        );
    }

    /**
     * Get topbar email element
     *
     * @return ElementInterface
     */
    public function getEmailElement()
    {
        return $this->_rootElement->find(
            'email',
            Locator::SELECTOR_CLASS_NAME
        );
    }
}
