<?php
// +--------------------------+
// | FoxCloud - Plugin Loader |
// +--------------------------+
// | (C) 2021 - 2022 .FoxOrg  |
// | https://foxorg.fcosma.it |
// | Tutti i diritti ris.     |
// +--------------------------+

namespace FoxCloud;

class Plugins {

    public string $folder;

    public function setPluginsFolder($dir) {
      $this->folder = $dir;
    }

    protected function loadPlugin($name) {
      $config = $this->loadConfig($name);
      if ($this->pluginExists($name)) {
        if ($config->load == "before") {
          require_once('protected/' . $this->folder . '/' . $name);
        } elseif ($config->load == "after") {
          include('protected/' . $this->folder . '/' . $name);
        } else {
          error_log("[FoxCloud] Errore nel config.json del plugin $name! - Thrown in config.json -> load");
        }
      } else {
        error_log("[FoxCloud] Il plugin richiesto non esiste! - Thrown in FoxCloud - Plugin: $name", 0);
      }
    }

    protected function getFile($file) {
      return file_get_contents($file);
    }

    protected function loadConfig($name) {
      if ($this->pluginExists($name)) {
        return json_decode($this->getFile('phar://protected/' . $this->folder . '/' . $name . '/config.json'));
      } else {
        error_log("[FoxCloud] Il plugin richiesto non esiste! - Thrown in FoxCloud - Plugin: $name", 0);
      }
    }

    public function validatePlugin($name) {
      if (json_decode($this->getFile('phar://protected/' . $this->folder . '/' . $name . '/config.json'))->type == "phar_plugin") {
        return true;
      } else {
        error_log("[FoxCloud] Il plugin richiesto non è caricato correttamente! - Thrown in FoxCloud - Plugin: $name - String: phar://protected/" . $this->folder . "/" . $name . "/config.json", 0);
        return false;
      }
    }

    public function pluginExists($name) {
      if (file_exists('protected/' . $this->folder . '/' . $name)) {
         // Esiste, verifichiamo che sia valido!
         return $this->validatePlugin($name);
      } else {
         return false;
      }
    }

    public function pluginList() {
      $list = array();
      foreach (glob('protected/' . $this->folder . '/*.phar') as $plugin) {
        array_push($list, str_replace('protected/' . $this->folder . '/', "", $plugin));
      }

      return $list;
    }
    
    public function addEventListener($url) {
      // Carichiamo tutti i plugin per vedere se è l'url richiesto
      foreach ($this->pluginList() as $plugin) {
        $pluginConf = $this->loadConfig($plugin);
        if (in_array($url, $pluginConf->URLs) && $pluginConf->enable == true) {
          $this->loadPlugin($plugin);
        }
      }
      return true;
    }
}
     
