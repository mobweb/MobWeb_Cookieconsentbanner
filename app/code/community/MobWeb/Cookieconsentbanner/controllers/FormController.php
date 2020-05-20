<?php
/**
 * @author    Louis Bataillard <info@mobweb.ch>
 * @package    MobWeb_Cookieconsentbanner
 * @copyright    Copyright (c) MobWeb GmbH (https://mobweb.ch)
 */

class MobWeb_Cookieconsentbanner_FormController extends Mage_Core_Controller_Front_Action
{
    public function postAction()
    {
        $request = Mage::app()->getRequest();
        $this->_setConsentCookiesFromRequest($request);
        $this->_redirectToRequestReferer($request);
    }

    private function _setConsentCookiesFromRequest(Mage_Core_Controller_Request_Http $request)
    {
        $data = $request->getParams();
        $allowedCookies = array();
        if (isset($data['allow_cookie'])) {
            $allowedCookies = array_keys($data['allow_cookie']);
        }

        $allowedCookies[] = MobWeb_Cookieconsentbanner_Helper_Data::ALLOW_COOKIES_ESSENTIAL_NAME;

        foreach ($allowedCookies as $allowedCookie) {
            Mage::getModel('core/cookie')->set($allowedCookie, '1', true);
        }
    }

    private function _redirectToRequestReferer(Mage_Core_Controller_Request_Http $request)
    {
        $redirectTo = Mage::getBaseUrl(Mage_Core_Model_Store::URL_TYPE_WEB);

        if (isset($_SERVER['HTTP_REFERER'])) {
            $redirectTo = $_SERVER['HTTP_REFERER'];

            $this->_redirectUrl($redirectTo);
        } else {
            $this->_redirect($redirectTo);
        }
    }
}