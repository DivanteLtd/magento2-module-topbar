<?php
/**
 * @package   Divante\Topbar
 * @author    Marek Mularczyk <mmularczyk@divante.pl>
 * @copyright 2017 Divante Sp. z o.o.
 * @license   See LICENSE_DIVANTE.txt for license details.
 */

namespace Divante\Topbar\Block\Header;

use Magento\Framework\View\Element\Template;

/**
 * Class Topbar.
 */
class Topbar extends Template
{
    /**
     * Topbar constructor.
     *
     * @param Template\Context $context
     * @param array            $data
     */
    public function __construct(
        Template\Context $context,
        array $data = []
    ) {
        parent::__construct($context, $data);
    }

    /**
     * @return bool
     */
    public function isEnabled()
    {
        return (bool) $this->_scopeConfig->getValue('divante/topbar/enabled');
    }

    /**
     * @param string $path
     * @param array  $params
     *
     * @return string
     */
    public function buildUrl($path, $params = [])
    {
        return $this->_urlBuilder->getUrl($path, $params);
    }

    /**
     * @return string
     */
    public function getSupportEmail()
    {
        return $this->_scopeConfig->getValue('trans_email/ident_support/email');
    }

    /**
     * @return string
     */
    public function getSupportPhone()
    {
        return $this->_scopeConfig->getValue('general/store_information/phone');
    }

    /**
     * @return string
     */
    public function getLogoutUrl()
    {
        return $this->_urlBuilder->getUrl('customer/account/logout');
    }

    /**
     * @return string
     */
    public function getLoginUrl()
    {
        return $this->_urlBuilder->getUrl('customer/account');
    }
}
