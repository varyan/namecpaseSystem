</<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
    <link rel="stylesheet" href="<?=TEMPLATE?>bootstrap/css/bootstrap.min.css">
</head>
<body>
<div class="container">
    <h2 class="page-header text-center">Race cars list</h2>
    <div class="col-md-12 well well-lg">
        <table class="table table-responsive table-bordered">
            <thead>
                <tr>
                    <th>Mark</th>
                    <th>Model</th>
                    <th>Color</th>
                    <th>Power</th>
                    <th>Max speed</th>
                    <th>Acceleration</th>
                </tr>
            </thead>
            <tbody>
            <?php foreach($cars as $car) : ?>
                <tr>
                    <td><?=$car->getMark()?></td>
                    <td><?=$car->getModel()?></td>
                    <td class="text-center"><span style="background-color: <?=$car->getColor()?>; padding: 10px;"><?=$car->getColor()?></span></td>
                    <td><?=$car->getPower()?> h/p</td>
                    <td><?=$car->getMaxSpeed()?> km/h</td>
                    <td>From 0 - 100 km/h <?=$car->getSpeed()?> second</td>
                </tr>
            <?php endforeach;; ?>
            </tbody>
        </table>
    </div>
</div>
</body>
</html>
