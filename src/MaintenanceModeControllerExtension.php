<?php

namespace IntWebG {

  use SilverStripe\SiteConfig\SiteConfig;
  use SilverStripe\Security\Permission;
  use SilverStripe\Control\HTTPResponse;
  use SilverStripe\Core\Extension;

  class MaintenanceModeControllerExtension extends Extension
  {

    public function onBeforeInit()
    {

      $config = SiteConfig::current_site_config();
      $MaintenanceModePage = MaintenanceModePage::get()->first();

      if ($this->owner->URLSegment == "home" && $config->MaintenanceMode && !Permission::check('MAINTENANCE_MODE_PAGE_VIEW_SITE') && !Permission::check('ADMIN')) {
        $response = new HTTPResponse();
        $response->redirect($MaintenanceModePage->AbsoluteLink(), 302);
        $response->output();
        die();
      }

      if (!$config->MaintenanceMode) {
        return;
      }

      if (Permission::check('MAINTENANCE_MODE_PAGE_VIEW_SITE') || Permission::check('ADMIN')) {
        return;
      }

      if ($this->owner instanceof MaintenanceModePageController) return;

      if (!$MaintenanceModePage) return;

      if (strpos($this->owner->RelativeLink(), "Security") === false) {

        $response = new HTTPResponse();
        $response->redirect($MaintenanceModePage->AbsoluteLink(), 302);
        die();
      }
    }
  }
}
