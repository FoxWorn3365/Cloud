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

    protected string $folder;
    protected array $loadAfter = array();
    protected string $confDir;

    public function setPluginsFolder($dir) {
      $this->folder = $dir;
    }

    protected function loadPlugin($name) {
      if ($this->pluginExists($name)) {
        require_once('protected/' . $this->folder . '/' . $name);
      } else {
        error_log("[FoxCloud] Il plugin richiesto non esiste! - Thrown in FoxCloud - Plugin: $name", 0);
      }
    }

    protected function getFile($file) {
      return file_get_contents($file);
    }

    protected function getPluginConfig($name) {
      if ($this->pluginExists($name)) {
        return json_decode($this->getFile('phar://protected/' . $this->folder . '/' . $name . '/config.json'));
      } else {
        error_log("[FoxCloud] Il plugin richiesto non esiste! - Thrown in FoxCloud - Plugin: $name", 0);
      }
    }

    public function validatePlugin($name) {
      $pluginConf = json_decode($this->getFile('phar://protected/' . $this->folder . '/' . $name . '/config.json'));
      if ($pluginConf->type == "phar_plugin" && in_array($this->getFile('version.txt'), $pluginConf->compatibility->cloudVersions)) {
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

    function loadAfter() {
      if (!empty($this->loadAfter[0])) {
        foreach ($this->loadAfter as $plugin) {
          require 'protected/' . $this->folder . '/' . $plugin;
        }
      }

      return true;
    }

    protected function loadAllPlugins($url) {
      foreach ($this->pluginList() as $plugin) {
        $pluginConf = $this->getPluginConfig($plugin);
        if ($pluginConf->loadEverywhere === true) {
          if ($pluginConf->load == "before") {
            $this->loadPlugin($plugin);
          } else {
            array_push($this->loadAfter, $plugin);
          }
        } else { 
          if (in_array($url, $pluginConf->URLs) && $pluginConf->enable === true) {
            if ($pluginConf->load == "before") {
              $this->loadPlugin($plugin);
            } else {
              array_push($this->loadAfter, $plugin);
            }
          }
        }
      }
      return true;
    }

    public function definePluginConfigDirectory($dir) {
      $this->confDir = $dir;
    }

    protected function getGlobalPluginConfig() {
      return json_decode($this->getFile('protected/' . $this->confDir));
    }

    public function loadPluginsFromConfig($url) {
      $config = $this->getGlobalPluginConfig();
      foreach ($config->load as $plugin) {
        if (!$this->pluginExists($plugin)) {
          error_log("[FoxCloud] ERRORE: Nel file iniziale plugin_config.json un plugin ($plugin) non esiste!");
          return false;
        }
        $pluginConf = $this->getPluginConfig($plugin);
        if ($pluginConf->loadEverywhere == true) {
          if ($pluginConf->load == "before") {
            $this->loadPlugin($plugin);
          } else {
            array_push($this->loadAfter, $plugin);
          }
        } else { 
          if (in_array($url, $pluginConf->URLs) && $pluginConf->enable === true) {
            if ($pluginConf->load == "before") {
              $this->loadPlugin($plugin);
            } else {
              array_push($this->loadAfter, $plugin);
            }
          }
        }
      }
      return true;
    }

    public function addEventListener($url) {
      if ($this->getGlobalPluginConfig()->isEnabled == true && $this->getGlobalPluginConfig()->restricted == true) {
        $this->loadPluginsFromConfig($url);
      } elseif ($this->getGlobalPluginConfig()->isEnabled == true && $this->getGlobalPluginConfig()->restricted == false) {
        $this->loadAllPlugins($url);
      } else {
        error_log("[FoxCloud] Plugins non abilitati!", 0);
        // Non carichiamo plugins
      }
      return true;
    }
}
