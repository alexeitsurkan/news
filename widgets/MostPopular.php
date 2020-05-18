<?php namespace app\widgets;

use app\models\ShowNews;

class MostPopular extends \yii\bootstrap\Widget
{
    public function run()
    {
        $data = ShowNews::ShowMostPopularNews();
        return $this->render('most_popular',[
            'data' => $data
        ]);
    }
}
