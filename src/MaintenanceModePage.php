<?php

namespace IntWebG {

	use SilverStripe\Security\PermissionProvider;
	use SilverStripe\Security\Permission;
	use SilverStripe\CMS\Controllers\ContentController;
	use SilverStripe\ErrorPage\ErrorPage;

	class MaintenanceModePage extends ErrorPage
	{

		private static $allowed_children = array("none");

		private static $description = "Maintenance page";

		public function canCreate($member = null, $context = null)
		{
			return !MaintenanceModePage::get()->exists();
		}
	}


	class MaintenanceModePageController extends ContentController implements PermissionProvider
	{

		private static $url_handlers = array(
			'*' => 'index'
		);

		private static $allowed_actions = array();

		public function init()
		{
			parent::init();
		}

		public function index()
		{
			$config = $this->SiteConfig();

			if (!$config->MaintenanceMode && !Permission::check('ADMIN')) {
				return $this->redirect(BASE_URL); //redirect to home page
			}
			$this->response->setStatusCode($this->ErrorCode);
			if ($this->dataRecord->RenderingTemplate) {
				return $this->renderWith(array($this->dataRecord->RenderingTemplate));
			}
			return $this->renderWith(array('MaintenanceModePage', 'Page'));
		}

		public function providePermissions()
		{
			return array(
				'MAINTENANCE_MODE_PAGE_VIEW_SITE' => _t('MaintenanceModePage.PERMISSION_ADMIN', "Permit access to the website when in maintenance")
			);
		}
	}
}
