<?php

namespace FrameworkDevA3\Views;

use FrameworkDevA3\CustomException\LayoutException;

class Template
{
    /** @var string template path */
    protected $filepath;
    /** @var string template content */
    protected $filecontent;
    /** @var string contenu */
    protected $data = [];

    /** Constructeur */
    public function __construct($filepath)
    {
        $this->filepath = $filepath;
    }

    public static function render($view, $vars)
    {
        if ($view != null) {
            $layout = __dir__ . '/../../app/Layout/' . $view;
        } else {
            $layout = __dir__ . '/../../app/Layout/default.php';
        }

        if (is_file($layout)) {
            $tmpl = new Template($layout);
        } else {
            throw new LayoutException;
        }

        $tmpl->setVars($vars);

        return $tmpl->output();
    }

    public function output()
    {
        ob_start();
        eval('?>' . $this->getContent());
        return ob_get_clean();
    }

    /** Datas template */
    public function setVars($vars)
    {
        foreach ($vars as $k => $v) {
            $this->data[$k] = $v;
        }
        return $this;
    }

    public function getContent()
    {
        $this->filecontent = file_get_contents($this->filepath);
        $content = preg_replace(
            '#{{ *([0-9a-z_\.\-]+) *}}#i',
            '<?php echo $this->getValue(\'$1\'); ?>',
            $this->filecontent
        );

        return $content;
    }

    public function getValue($key)
    {
        if (!isset($this->data[$key])) {
            $this->data[$key] = "";
        }
        return $this->data[$key];
    }
}
