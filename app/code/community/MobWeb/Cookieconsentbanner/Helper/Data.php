<?php
/**
 * @author    Louis Bataillard <info@mobweb.ch>
 * @package    MobWeb_Cookieconsentbanner
 * @copyright    Copyright (c) MobWeb GmbH (https://mobweb.ch)
 */

class MobWeb_Cookieconsentbanner_Helper_Data extends Mage_Core_Helper_Abstract
{
    const ALLOW_COOKIES_ESSENTIAL_NAME = 'allow_cookies_essential';
    const ALLOW_COOKIES_CUSTOM_1_NAME = 'allow_cookies_custom_1';
    const ALLOW_COOKIES_CUSTOM_2_NAME = 'allow_cookies_custom_2';

    public function getConsentForCookie($cookieName)
    {
        switch ($cookieName) {
            case 'essential':
                return $this->_hasCookie(self::ALLOW_COOKIES_ESSENTIAL_NAME);
            case 'custom_1':
                return $this->_hasCookie(self::ALLOW_COOKIES_CUSTOM_1_NAME);
            case 'custom_2':
                return $this->_hasCookie(self::ALLOW_COOKIES_CUSTOM_2_NAME);
        }

        return false;
    }

    private function _hasCookie($name)
    {
        return (Boolean) Mage::getSingleton('core/cookie')->get($name);
    }

    public function getConfigData($config)
    {
        $baseConfigPath = 'web/mobweb_cookieconsentbanner';

        return Mage::getStoreConfig($baseConfigPath . DS . $config);
    }
}