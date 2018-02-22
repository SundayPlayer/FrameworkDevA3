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

    /**
     * This genereate the html code with elements render from the layout
     *
     * @param string $view The path of the layout used.
     *
     * @param array $vars The list containing all the element used for render
     * the html code.
     *
     * @return string
     */
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
            throw new LayoutException('Chemin de la vue chargée: '.$layout.".");
        }

        $tmpl->setVars($vars);

        return $tmpl->output();
    }

    /**
     * This write the generated code in a buffer
     *
     * @return buffer contents
     */
    public function output()
    {
        ob_start();
        extract($this->data);
        eval('?>' . $this->getContent());
        return ob_get_clean();
    }

    /**
     * This copy variables from an array and put it in another array used for
     * replace variable in layout by their value
     *
     * @param array $vars List of variable for the layout
     *
     * @return array
     */
    public function setVars($vars)
    {
        foreach ($vars as $k => $v) {
            $this->data[$k] = $v;
        }
        return $this;
    }

    /**
     * This replace the variable from the layout and return the modified
     * content
     *
     * return string
     */
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

    /**
     * This return the value of the variable name from an array
     *
     * @param string $key The variable name
     *
     * @return string
     */
    public function getValue($key)
    {
        if (!isset($this->data[$key])) {
            $this->data[$key] = "";
        }
        return $this->data[$key];
    }
}
