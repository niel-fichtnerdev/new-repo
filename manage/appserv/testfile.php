<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h2>Test Document for backend</h2>
    <?php
        //if(!defined('BASE2')) define('BASE2', '../');
        require_once 'classes/view.class.php'; //Only Define view class
        require_once 'classes/controller.class.php'; //Only Define Controller class
        
        //Here we can test the object from backend
        $test = new view();
        //$test->viewtest();
        $test->showUsers();

        //$test2 = new controller();
        //$test2->createUser("john", "doe", "1995");

        //$test3 = new model();
        //$test3->createUser("john", "doe", "1995");


    ?>
</body>
</html>