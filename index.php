<?php
include './lib/thumb.php';

$fileName='./lib/images/1.jpg';
$thumb=new Thumb($fileName,'./images/',200,200);
$thumb->createThumb();
