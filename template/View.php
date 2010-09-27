<?php

namespace li3_phptal\template;

use \lithium\core\Libraries;
use \PHPTAL;

class View extends \lithium\core\Object {

    static protected $_tmplDir;

    public function render ($type, $data = null, array $options = array()) {
        $tmplFile = $options['controller'] . '/' . $options['template'] . '.' . $options['type'];
        $tmplDirs = $this->getTemplateRepository($options['request']);
        $tmpl = PHPTAL::create()
            ->setPhpCodeDestination($this->getTempDir())
            ->setTemplateRepository($tmplDirs)
            ->setOutputMode(PHPTAL::HTML5)
            ->setTemplate($tmplFile);
        array_walk($data, function ($v, $k) use ($tmpl) { $tmpl->set($k, $v); });
        return "<!doctype html>\n" . ltrim($tmpl->execute());
    }

    public function getTemplateRepository ($request) {
        $dirs = array();
        foreach (Libraries::get() as $name => $config) {
            $dir = $config['path'] . '/views/';
            if (file_exists($dir) && is_dir($dir)) {
                $dirs[] = $dir;
            }
        }
        return $dirs;
    }

    public function getTempDir () {
        $dir = LITHIUM_APP_PATH . '/resources/tmpl/';
        if (!is_dir($dir)) {
            mkdir($dir);
        }
        return $dir;
    }

}
