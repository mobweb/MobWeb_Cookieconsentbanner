<?php
/**
 * @author    Louis Bataillard <info@mobweb.ch>
 * @package    MobWeb_Cookieconsentbanner
 * @copyright    Copyright (c) MobWeb GmbH (https://mobweb.ch)
 */

class MobWeb_Cookieconsentbanner_Block_Banner extends Mage_Core_Block_Template
{
    private $_helper;
    private $_isEnabled;
    private $_postUrl;
    private $_introTitle;
    private $_introText;
    private $_checkBoxes;
    private $_buttonAcceptAllLabel;
    private $_buttonSaveLabel;
    private $_buttonAcceptEssentialLabel;
    private $_customLinks;

    public function __construct()
    {
        $this->_helper = Mage::helper('mobweb_cookieconsentbanner');
    }

    public function isEnabled(): Bool
    {
        if (!$this->_isEnabled) {
            $this->_isEnabled = ($this->_helper->getConfigData('enabled') == '1');
        }

        return $this->_isEnabled;
    }

    public function canShowBanner(): Bool
    {
        return (Boolean) $this->isEnabled() && !$this->hasConsentCookie() && $this->getIntroTitle() && $this->getIntroText() && $this->getCheckboxes() && $this->getButtonAcceptAllLabel() && $this->getButtonSaveLabel() && $this->getButtonAcceptAllLabel();
    }

    public function hasConsentCookie(): Bool
    {

        return (Boolean) Mage::helper('mobweb_cookieconsentbanner')->getConsentForCookie('essential');
    }

    public function getPostUrl(): String
    {
        if (!$this->_postUrl) {
            $this->_postUrl = Mage::getUrl('mobweb_cookieconsentbanner/form/post');
        }

        return $this->_postUrl;
    }

    public function getIntroTitle(): String
    {
        if (!$this->_introTitle) {
            $this->_introTitle = $this->_helper->getConfigData('intro_title');
        }

        return (String) $this->_introTitle;
    }

    public function getIntroText(): String
    {
        if (!$this->_introText) {
            $this->_introText = $this->_helper->getConfigData('intro_text');
        }

        return (String) $this->_introText;
    }

    public function getCheckboxes(): Array
    {
        if (!$this->_checkBoxes) {
            $this->_checkboxes = array(
                array(
                    'id' => MobWeb_Cookieconsentbanner_Helper_Data::ALLOW_COOKIES_ESSENTIAL_NAME,
                    'label' => $this->_helper->getConfigData('checkbox_essential_label'),
                    'checked' => true,
                    'disabled' => true
                ),
                array(
                    'id' => MobWeb_Cookieconsentbanner_Helper_Data::ALLOW_COOKIES_CUSTOM_1_NAME,
                    'label' => $this->_helper->getConfigData('checkbox_custom_1_label'),
                    'checked' => false,
                    'disabled' => false,
                ),
                array(
                    'id' => MobWeb_Cookieconsentbanner_Helper_Data::ALLOW_COOKIES_CUSTOM_2_NAME,
                    'label' => $this->_helper->getConfigData('checkbox_custom_2_label'),
                    'checked' => false,
                    'disabled' => false,
                )
            );
        }

        return $this->_checkboxes;
    }

    public function getButtonAcceptAllLabel(): String
    {
        if (!$this->_buttonAcceptAllLabel) {
            $this->_buttonAcceptAllLabel = $this->_helper->getConfigData('button_accept_all_label');
        }

        return $this->_buttonAcceptAllLabel;
    }

    public function getButtonSaveLabel(): String
    {
        if (!$this->_buttonSaveLabel) {
            $this->_buttonSaveLabel = $this->_helper->getConfigData('button_save_label');
        }

        return $this->_buttonSaveLabel;
    }

    public function getButtonAcceptEssentialLabel(): String
    {
        if (!$this->_buttonAcceptEssentialLabel) {
            $this->_buttonAcceptEssentialLabel = $this->_helper->getConfigData('button_accept_essential_label');
        }

        return $this->_buttonAcceptEssentialLabel;
    }

    public function getCustomLinks(): Array
    {
        if (!$this->_customLinks) {
            $this->_customLinks = array(
                array(
                    'label' => $this->_helper->getConfigData('custom_link_1_label'),
                    'url' => $this->_helper->getConfigData('custom_link_1_url')
                ),
                array(
                    'label' => $this->_helper->getConfigData('custom_link_2_label'),
                    'url' => $this->_helper->getConfigData('custom_link_2_url')
                ),
                array(
                    'label' => $this->_helper->getConfigData('custom_link_3_label'),
                    'url' => $this->_helper->getConfigData('custom_link_3_url')
                ),
            );
        }

        return $this->_customLinks;
    }
}