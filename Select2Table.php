<?php

namespace seisvalt\select2table;

use yii\base\Widget;
use yii\helpers\Json;
use yii\web\View;

class Select2Table extends Widget
{
    public $options = [];
    public $data = [];
    public $link;
    public $table = [];
    public $htmlOptions = [];
    public $setupOptions = [];
    public $scripts = [];
    public $callback = false;
    public $filter;
    public $searchModel;
    public $attributes;
    public $context;
    public $model;
    public $optionsJs;
    public $url;
    public $action = null;
    public $onSuccess;
    public $onError;
    public $onEmptyResult;
    public $noResultsMessage = 'No results found.';
    private $message;
    private $id;    // function(txt){ }
    private $title = "sensores";
    private $id_model;

    public function init()
    {

        parent::init();

        if (is_array($this->options) && count($this->options) >= 1) {
            if (isset($this->options["title"])) {
                $this->title = $this->options["title"];
            }
        }
        $this->id = isset($htmlOption["id"]) ? $htmlOption["id"] : "list-" . uniqid();
        $this->id_model = $this->model->id;

        if (is_array($this->data) && count($this->data) >= 1) {
            $this->message = $this->render(
                'index',
                [
                    'data_select' => $this->data,
                    'link_select' => $this->link,
                    'data_table' => $this->table['dataProvider'],
                    'columns' => $this->table['columns'],
                    'id' => $this->id,
                    'title' => $this->title,

                ]
            );
            $modelAttributeId = '';

            if (($this->model != null) && ($this->table != null)) {
                $modelAttributeId = get_class($this->model) . '_' . $this->id;
            }

            if ($this->onSuccess == null) {
                $this->onSuccess = 'function(val,text){ }';
            }
            if ($this->onError == null) {
                $this->onError = 'function(e){ }';
            }
            if ($this->onEmptyResult == null) {
                $this->onEmptyResult = 'function(txt){ }';
            }

            $this->optionsJs = Json::encode(
                array(
                    'id' => $this->id,
                    'url' => $this->url,
                    'onSuccess' => $this->onSuccess,
                    'onError' => $this->onError,
                    'onEmptyResult' => $this->onEmptyResult,
                    'modelAttributeId' => $modelAttributeId,
                    'noResultsMessage' => $this->noResultsMessage,
                )
            );
        } else {
            $this->message = 'No se ha enviado un recurso de datos';
        }
    }

    /**
     * Renders the widget.
     */
    public function run()
    {
        $this->registerAssets();

        return $this->message;
    }

    /**
     * Registers required assets and the executing code block with the view
     */
    protected function registerAssets()
    {
        $js = "
		var buscadorLista = {$this->optionsJs};
		var model = {$this->id_model};
		var linkglobal;
        ";
        $key = __CLASS__ . '#' . $this->id;
        $this->view->registerJs($js, View::POS_BEGIN, $key);
        Select2TableAsset::register($this->view);
    }
}
