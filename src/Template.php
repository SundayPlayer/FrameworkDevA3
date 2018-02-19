<?php

namespace FrameworkDevA3\Template;

class Template
{
    /** @var string template path */
    protected $filepath;
    /** @var string template content */
    protected $filecontent;
    /** @var string layout file */
    protected $layoutfile = __DIR__ . '/../default.php';
    /** @var string Contenu */
    protected $data = [];

    /** Constructeur */
    public function __construct($filepath)
    {
        $this->filepath = $filepath;
    }

    public function render($vars = [], $view = null)
    {
        if ($view != null) {
            $tmpl = new Template($view);
        } else {
            $tmpl = new Template($this->layoutfile);
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
        return $this->data[$key];
    }
}
