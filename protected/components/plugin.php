<?php
// +--------------------------+
// | FoxCloud - Plugin Loader |
// +--------------------------+
// | (C) 2021 - 2022 .FoxOrg  |
// | https://foxorg.fcosma.it |
// | Licenza GPL 3.0          |
// +--------------------------+

namespace FoxCloud;

class Plugins {

    protected string $folder;
    protected array $pluginListAfter = array();
    protected array $pluginListBefore = array();
    protected $savedBefore = array();
    protected $savedAfter = array();
    protected string $confDir;

    public function setPluginsFolder($dir) {
      $this->folder = $dir;
    }

    public function addAfter($value) {
      array_push($this->pluginListAfter, $value);
    }

    public function addBefore($value) {
      array_push($this->pluginListBefore, $value);
    }

    protected function loadPlugin($name) {
      if ($this->pluginExists($name)) {
        require_once('protected/' . $this->folder . '/' . $name);
        $this->log("", "[PluginManager] Plugin $name inizializzato con successo!");
      } else {
        $this->log("error", "[PluginManager] Il plugin richiesto non esiste! - Thrown in FoxCloud - Plugin: $name", 0);
      }
    }

    protected function log($type = '', $content) {
      if ($type == "error") {
        $pre = "[#ERROR]";
      } else {
        $pre = "[#INFO]";
      }

      file_put_contents('protected/sys/latest.log', file_get_contents('protected/sys/latest.log') . "\n[" . date("d/m/Y - H:i:s") . "]:[FoxCloud]:$pre $content");
    }

    protected function getFile($file) {
      return file_get_contents($file);
    }

    protected function getPluginConfig($name) {
      if ($this->pluginExists($name)) {
        return json_decode($this->getFile('phar://protected/' . $this->folder . '/' . $name . '/config.json'));
      } else {
        $this->log('error', "[PluginManager] Il plugin richiesto non esiste! - Thrown in FoxCloud - Plugin: $name", 0);
      }
    }

    public function validatePlugin($name) {
      $pluginConf = json_decode($this->getFile('phar://protected/' . $this->folder . '/' . $name . '/config.json'));
      if ($pluginConf->type == "phar_plugin" && in_array($this->getFile('version.txt'), $pluginConf->compatibility->cloudVersions)) {
        return true;
      } else {
        $this->log('error', "[PluginManager] Il plugin richiesto non è caricato correttamente! - Thrown in FoxCloud - Plugin: $name - String: phar://protected/" . $this->folder . "/" . $name . "/config.json - Il plugin non presenta una corretta configurazione in config.json", 0);
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

    protected function loadAllPlugins($url) {
      foreach ($this->pluginList() as $plugin) {
        $pluginConf = $this->getPluginConfig($plugin);
        if ($pluginConf->enabled === true) {
            $this->loadPlugin($plugin);
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

    public function loadPluginsFromConfig() {
      $config = $this->getGlobalPluginConfig();
      foreach ($config->load as $plugin) {
        if (!$this->pluginExists($plugin)) {
          $this->log('error', "[PluginManager] ERRORE: Nel file iniziale plugin_config.json un plugin ($plugin) non esiste!");
          return false;
        }
        $pluginConf = $this->getPluginConfig($plugin);
        if ($pluginConf->enabled === true) {
          $this->loadPlugin($plugin);
        } 
      }
      return true;
    }

    public function test() {
      die("OKKe");
    }

    public function load() {
      if ($this->getGlobalPluginConfig()->isEnabled == true && $this->getGlobalPluginConfig()->restricted == true) {
        $this->loadPluginsFromConfig($url);
      } elseif ($this->getGlobalPluginConfig()->isEnabled == true && $this->getGlobalPluginConfig()->restricted == false) {
        $this->loadAllPlugins($url);
      } else {
        $this->log('error', "[PluginManager] Plugins non abilitati!", 0);
        // Non carichiamo plugins
      }
      return true;
    }

    public function addEvent($event, $type, $do, $params = array()) {
      file_put_contents('protected/sys/temp.txt', $do);
      if ($event == "pageLoad") {
        if ($type == "before") {
          array_push($GLOBALS['pluginLoadBefore'], $do);
          $this->log("", "[PluginManager] Plugin aggiunto all'evento loadBefore!");
        } elseif ($type == "after") {
          array_push($GLOBALS['pluginLoadAfter'], $do);
          $this->log("", "[PluginManager] Plugin aggiunto all'evento loadAfter!");
        } else {
          $this->log('error', "[PluginManager] NoEventTypeOn: PageLoad!", 0);
        }
      } elseif ($event == "request") {
        if (is_array($params) && in_array($GLOBALS['url'], $params)) {
          if ($type == "before") {
            array_push($GLOBALS['pluginLoadBefore'], $do);
            $this->log("", "[PluginManager] Plugin aggiunto all'evento loadBefore!");
          } elseif ($type == "after") {
            array_push($GLOBALS['pluginLoadAfter'], $do);
            $this->log("", "[PluginManager] Plugin aggiunto all'evento loadAfter!");
          } else {
            $this->log('error', "[PluginManager] NoEventTypeOn: PageLoad!", 0);
          }
        }
      }
    }

    public function execute($type = 'null') {
      if ($type == "after") {
        foreach ($GLOBALS['pluginLoadAfter'] as $action) {
          $action();
          $this->log("", "[PluginManager] Caricato i plugin dagli eventi pageLoad // AFTER");
        }
      } else {
        foreach ($GLOBALS['pluginLoadBefore'] as $action) {
          $action();
          $this->log("", "[PluginManager] Caricato i plugin dagli eventi pageLoad // BEFORE");
        }
      }
    }
}

