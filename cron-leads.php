<?php 

$connect = mysqli_connect('localhost', 'vykebcezjj', 'mx63EzfuW9', 'vykebcezjj');

$query = 'UPDATE users set leads_daily=0';

mysqli_query($connect, $query);