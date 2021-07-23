<?php

namespace IntWebG {

  use SilverStripe\Forms\CheckboxField;
  use SilverStripe\ORM\DataExtension;
  use SilverStripe\Forms\FieldList;

  class MaintenanceModeExtension extends DataExtension
  {

    private static $db = [
      'MaintenanceMode' => 'Boolean',
    ];

    public function updateCMSFields(FieldList $fields)
    {

      parent::updateCMSFields($fields);

      if ((MaintenanceModePage::get()->count() > 0)) {

        $fields->addFieldToTab(
          'Root.Access',
          CheckboxField::create(
            'MaintenanceMode',
            _t(__CLASS__ . '.MAINTENANCEMODE', 'lang')
          )
        );
      }

      return $fields;
    }
  }
}
