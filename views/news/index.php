<?php
/**
 * @var $data
 * @var $pages
 */

?>
<h1>Список последних новостей</h1>
<?php foreach ($data as $item):?>
    <div><h2><?= $item['title']?></h2></div>
<?php endforeach;?>
