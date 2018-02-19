<?php

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

    public function render($vars = [])
    {
        $tmpl = new Template($this->layoutfile);
        $tmpl->setVars($vars);

        return $tmpl->output();
    }

    public function output(){
        ob_start();
        eval('?>' . $this->get_content());
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

    public function get_content(){
        $this->filecontent = file_get_contents($this->filepath);
        $content = preg_replace('#{{ *([0-9a-z_\.\-]+) *}}#i', '<?php echo $this->get_value(\'$1\'); ?>',$this->filecontent);

        return $content;
    }

    public function get_value($key){
        return $this->data[$key];
    }


}
