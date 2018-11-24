<?php

namespace test\components;

/**
 * Class View
 */
class View
{
    public $title = 'Title';
    public $content = 'Content';
    public $path = 'Path';
    public $params = [];

    /**
     * @param $path
     * @return false|string
     */
    public function renderFile()
    {
        ob_start();
        require $this->path;
        $var = ob_get_contents();
        ob_end_clean();
        return $var;
    }

    public function setAdditionalProperties()
    {
        foreach ($this->params as $variable => $value) {
            $this->$variable = $value;
        }
    }
}