<?php 

$connect = mysqli_connect('localhost', 'rjtbgtpncb', 'rAd7xcTSMc', 'rjtbgtpncb');

$query = 'UPDATE users set leads_daily=0';

mysqli_query($connect, $query);