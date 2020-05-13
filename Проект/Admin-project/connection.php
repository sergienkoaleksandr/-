<?php
/*$servername = 'localhost'; // адрес сервера 
$username = 'id13053809_computer_club'; // имя пользователя
$password = 'computer'; // пароль
$database = 'id13053809_computerclub'; // имя базы данных*/
$link = mysqli_connect("localhost", "id13053809_computer_club", "computer", "id13053809_computerclub");
if(!$link)
{
    echo "Not connected";
}
else
{
    mysqli_set_charset($link, "utf8");
}
?>