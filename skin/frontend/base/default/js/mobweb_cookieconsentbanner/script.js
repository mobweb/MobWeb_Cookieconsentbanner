/**
 * @author    Louis Bataillard <info@mobweb.ch>
 * @package    MobWeb_Cookieconsentbanner
 * @copyright    Copyright (c) MobWeb GmbH (https://mobweb.ch)
 */

document.addEventListener('DOMContentLoaded', function(event) {
    window.mccbForm = document.getElementById('mobweb-cookie-consent-banner');
    if (window.mccbForm) {
        window.mccbFormCheckboxes = window.mccbForm.querySelectorAll('input[type="checkbox"]');

        window.mccbAcceptAll = function() {
            for (i = 0; i < window.mccbFormCheckboxes.length; ++i) {
                var checkbox = window.mccbFormCheckboxes[i];
                checkbox.checked = 'checked';
            }

            mccbForm.submit();
        };

        window.mccbAcceptEssential = function() {
            for (i = 0; i < window.mccbFormCheckboxes.length; ++i) {
                var checkbox = window.mccbFormCheckboxes[i];
                if (!(checkbox.disabled)) {
                    checkbox.checked = false;
                }
            }

            mccbForm.submit();
        };
    }
});