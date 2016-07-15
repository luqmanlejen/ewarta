<?

Yii::app()->setTimeZone("Asia/Kuala_Lumpur");

$today = date("Y-m-d");

$rows = Visitor::model()->findByAttributes(array('dtvisit' => $today));

if (sizeof($rows) == 0) {

    //Insert

    $visitor = new visitor();

    $visitor->dtvisit = $today;

    $visitor->total = 1;

    $visitor->save();
} else {

    //Update

    $id = $rows['id'];

    $visitor = new visitor();

    $visitor->id = $id;

    $visitor->dtvisit = $today;

    $visitor->total = intval($rows['total'] + 1);

    $visitor->updateByPk($visitor->id, $visitor);
}
?>