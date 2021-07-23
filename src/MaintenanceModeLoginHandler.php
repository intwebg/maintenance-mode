<?php

namespace IntWebG {

    use SilverStripe\Control\HTTPRequest;
    use SilverStripe\Security\Member;
    use SilverStripe\Security\MemberAuthenticator\LoginHandler;
    use SilverStripe\Security\MemberAuthenticator\MemberLoginForm;
    use SilverStripe\SiteConfig\SiteConfig;

    class MaintenanceModeLoginHandler extends LoginHandler
    {

        private static $allowed_actions = [
            'doLogin',
        ];

        public function doLogin($data, MemberLoginForm $form, HTTPRequest $request)
        {

            if (SiteConfig::current_site_config()->MaintenanceMode) {

                if ($member = Member::get()->filter('Email', $data['Email'])->first()) {

                    if (!$member->inGroup(2)) { // Avoid users were not in admin group to log in
                        $form->sessionMessage(_t(__CLASS__ . '.CANTLOGIN', 'lang'), 'bad');
                        return $this->redirect('Security/login');
                    }
                }
            }
            echo 'allo';
            exit;
            return parent::doLogin($data, $form, $request);
        }
    }
}
