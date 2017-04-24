<?php
/**
 * Created by PhpStorm.
 * User: seisvalt
 * Date: 8/09/15
 * Time: 07:31 AM
 */

namespace seisvalt\select2table;

use yii\web\AssetBundle;

class Select2TableAsset extends AssetBundle
{

    public $sourcePath = '@vendor/seisvalt/yii2-select2-table/assets';
    public $depends = ['yii\web\JqueryAsset'];

    /**
     * @inheritdoc
     */
    public function init()
    {

        $ext = YII_DEBUG ? 'src.js' : 'min.js';
        $ext = "js";
        $this->js[] = "ajax.$ext";

        return $this;
    }
}
