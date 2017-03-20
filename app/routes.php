<?php

$route->add('/','Kik@index');
$route->add('/signin', 'Kik@signIn');
$route->add('/create', 'Kik@createAcc');
$route->add('/signout', 'Kik@signOut');
$route->add('/addUsers', 'Kik@userPictures');
$route->add('/loadUsers', 'Kik@loadUsers');
$route->add('/forgot', 'Kik@forgot');