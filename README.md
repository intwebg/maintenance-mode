<h1>intwebg/silverstripe-maintenance-mode</h1>
<p>Easy way to put website in maintenance</p>
<ul>
  <li>Add a checkbox in the LeftAndMain Settings menu inside Access tab to enable maintenance mode and will only visible unless a <code>MaintenanceModePage</code> page will be created</li>
  <li>An error message will be displayed when non-admin users try to log in. Currently applyied on default <code>LoginHandler</code>*</li>
  <li>Configurable content and error type available in <code>MaintenanceModePage</code></li>
</ul>
<p>* If you have another way to validate the login process (ex. MFA), you must change this to:</p>


<p>config.yml:</p>

```
SilverStripe\Core\Injector\Injector:
  SilverStripe\MFA\Authenticator\LoginHandler:
    class: IntWebG\MaintenanceModeLoginHandler
```

*todos:
- Add task to create automatically the MaintenanceModePage
