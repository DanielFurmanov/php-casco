<?php
  require_once(dirname(__FILE__) . '/smartpolis.class.casco.api.php');

  class smartPolisSettings {
    private $settingsFilePath = null;
    private $settings = null;

    public function __construct() {
      if ( is_null($this->settingsFilePath) ) {
        $this->settingsFilePath = realpath(dirname(__FILE__)) . '/settings.php';
      }
      if ( is_null($this->settings) && file_exists($this->settingsFilePath) ) {
        include($this->settingsFilePath);
        $this->settings = unserialize(base64_decode($SMARTPOLIS_SETTINGS));
      }
    }

    public function get($key="") {
      if ( ! is_null($this->settings) && isset($this->settings[$key]) ) {
        return $this->settings[$key];
      }
      return "";
    }

    public function setCompanyParams($id, $active, $discount) {
        if (array_key_exists($id, $this->settings['smartpolis_companies'])) {
            $this->settings['smartpolis_companies'][$id]['params'] = array(
                'active'   => $active ? 'true' : 'false',
                'discount' => doubleval($discount)
            );
        }
    }

    public function updateCompanies() {
        $api = new smartpolisCascoApi();
        $companies = json_decode($api->getCompanies());
        foreach($companies as $company) {
            $this->settings['smartpolis_companies'][$company->id]['object'] = $company;
            if ( !isset($this->settings['smartpolis_companies'][$company->id]['params']) ) {
                $this->settings['smartpolis_companies'][$company->id]['params'] = array();
                $this->settings['smartpolis_companies'][$company->id]['params']['active'] = 'false';
                $this->settings['smartpolis_companies'][$company->id]['params']['discount'] = '0.00';
            }
        }
        $this->save();
    }

    public function set($array = array()) {
      foreach($array as $key=>$value) {
        if (strpos($key, 'smartpolis_')===0) {
          $this->settings[$key] = $value;
        }
      }
    }

    public function save() {
      error_reporting(E_ALL);
      ini_set('display_errors', 1);
      file_put_contents($this->settingsFilePath, "<?php\n");
      file_put_contents($this->settingsFilePath, '$SMARTPOLIS_SETTINGS = "', FILE_APPEND);
      file_put_contents($this->settingsFilePath, base64_encode(serialize($this->settings)), FILE_APPEND);
      file_put_contents($this->settingsFilePath, '";' . "\n", FILE_APPEND);
      file_put_contents($this->settingsFilePath, "?>", FILE_APPEND);
    }
    
  }
?>
