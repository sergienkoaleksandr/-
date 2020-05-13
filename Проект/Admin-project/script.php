<?php
error_reporting(-1);
ini_set(‘display_errors’, ‘true’);
include __DIR__ . '/connection.php';
$textareaGames = "gamesText";
$textareaPrograms = "programsText";
$textareaPrices = "pricesText";
$textareaSubs = "subsText";
$textareaFree = "freeText";
$textareaBusy = "busyText";
global $link;
if (isset($_POST["buttongame"]))
{
	showGames();
}
if (isset($_POST["buttonprog"]))
{
	showPrograms();
}
if (isset($_POST["buttonprice"]))
{
	showPrices();
}
if (isset($_POST["buttonsubs"]))
{
	showSubs();
}
if (isset($_POST["buttonnotbusycomp"]))
{
	showFreeComputers();
}
if (isset($_POST["buttonbusycomp"]))
{
	showBusyComputers();
}
if(isset($_POST["buttonreleasecomputer"]))
{
    releaseComputer();
}
if(isset($_POST["buttonoccupycomputer"]))
{
    occupyComputer();
}
if (isset($_POST["buttonreg"]))
{
	register();
}

function showGames()
{
	global $textareaGames;
	global $link;
	$query = "SELECT Name FROM Games";//объявляем запрос к бд
	$result = mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link));/*функция mysqli_query() возвращает объект $result,	который содержит результат запроса*/
	$text = "Список игр:\r\n";
	if($result)
	{
		$rows = mysqli_num_rows($result); // количество полученных строк
		for ($i = 0 ; $i < $rows; ++$i)
		{
			$text .= mysqli_fetch_row($result)[0];//чтобы извлечь отдельную строку, используется функция mysqli_fetch_row()
			$text .= "\r\n";
		}
	}
	mysqli_close($link);
	echo "<p>";
	echo "<textarea name=".$textareaGames." cols=\"40\" rows=\"8\">".$text."</textarea>";
	echo "</p>";
}

function showPrograms()
{
	global $textareaPrograms;
	global $link;
	$query = "SELECT Name FROM Programs";//объявляем запрос к бд
	$result = mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link));/*функция mysqli_query() возвращает объект $result,	который содержит результат запроса*/
	$text = "Список программ:\r\n";
	if($result)
	{
		$rows = mysqli_num_rows($result); // количество полученных строк
		for ($i = 0 ; $i < $rows; ++$i)
		{
			$text .= mysqli_fetch_row($result)[0];//чтобы извлечь отдельную строку, используется функция mysqli_fetch_row()
			$text .= "\r\n";
		}
	}
	mysqli_close($link);
	echo "<p>";
	echo "<textarea name=".$textareaPrograms." cols=\"40\" rows=\"8\">".$text."</textarea>";
	echo "</p>";
}

function showPrices()
{
	global $textareaPrices;
	global $link;
	$query = "SELECT NumberOfHours, Cost FROM Prices";//объявляем запрос к бд
	$result = mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link));/*функция mysqli_query() возвращает объект $result, 
	который содержит результат запроса*/
	$text = "Список цен:\r\n";
	if($result)
	{
		$rows = mysqli_num_rows($result); // количество полученных строк
		for ($i = 0 ; $i < $rows; ++$i)
		{
			$row = mysqli_fetch_row($result);//чтобы извлечь отдельную строку, используется функция mysqli_fetch_row()
			$text .=$row[0];
			$text .= "ч.   -   ";
			$text .= $row[1];
			$text .= "руб.\r\n";
		}
	}
	mysqli_close($link);
	echo "<p>";
	echo "<textarea name=".$textareaPrices." cols=\"30\" rows=\"5\">".$text."</textarea>";
	echo "</p>";
}

function showSubs()
{
	global $textareaSubs;
	global $link;
	$query = "SELECT NumberOfMonths, Cost FROM Subscriptions";//объявляем запрос к бд
	$result = mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link));/*функция mysqli_query() возвращает объект $result, 
	который содержит результат запроса*/
	$text = "Список подписок:\r\n";
	if($result)
	{
		$rows = mysqli_num_rows($result); // количество полученных строк
		for ($i = 0 ; $i < $rows; ++$i)
		{
			$row = mysqli_fetch_row($result);//чтобы извлечь отдельную строку, используется функция mysqli_fetch_row()
			$text .=$row[0];
			$text .= "мес.   -   ";
			$text .= $row[1];
			$text .= "руб.\r\n";
		}
	}
	mysqli_close($link);
	echo "<p>";
	echo "<textarea name=".$textareaSubs." cols=\"50\" rows=\"5\">".$text."</textarea>";
	echo "</p>";
}

function register()
{
    global $link;
    $emailText = $_POST["email"];
    $nameText = $_POST["name"];
    $surnameText = $_POST["surname"];
    $subscriptionText = $_POST["subscription"];
    $query = "SELECT NumberOfMonths FROM Subscriptions WHERE Id =".$subscriptionText;//объявляем запрос к бд
	$result = mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link));/*функция mysqli_query() возвращает объект $result, 
	который содержит результат запроса*/
	$number = mysqli_fetch_row($result)[0];
    $day = date("Y-m-d", time()+60*60*24*30*$number);
    $query = "INSERT RegisteredUsers(Email, Name, Surname, SubscriptionId, SubscriptionEndDate) VALUES(\"".$emailText."\", \"".$nameText."\",\"".$surnameText."\",\"".$subscriptionText."\",\"".$day."\")";//объявляем запрос к бд
	$result = mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link));/*функция mysqli_query() возвращает объект $result, 	который содержит результат запроса*/
    mysqli_close($link);
}

function showFreeComputers()
{
	global $textareaFree;
	global $link;
	$query = "SELECT Id FROM Computers WHERE IsFree=1";//объявляем запрос к бд
	$result = mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link));/*функция mysqli_query() возвращает объект $result,	который содержит результат запроса*/
	$text = "Список свободных компьютеров:\r\n";
	if($result)
	{
		$rows = mysqli_num_rows($result); // количество полученных строк
		for ($i = 0 ; $i < $rows; ++$i)
		{
			$text .= mysqli_fetch_row($result)[0];//чтобы извлечь отдельную строку, используется функция mysqli_fetch_row()
			$text .= "\r\n";
		}
	}
	mysqli_close($link);
	echo "<p>";
	echo "<textarea name=".$textareaFree." cols=\"40\" rows=\"8\">".$text."</textarea>";
	echo "</p>";
}

function showBusyComputers()
{
	global $textareaBusy;
	global $link;
	$query = "SELECT Id FROM Computers WHERE IsFree=0";//объявляем запрос к бд
	$result = mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link));/*функция mysqli_query() возвращает объект $result,	который содержит результат запроса*/
	$text = "Список занятых компьютеров:\r\n";
	if($result)
	{
		$rows = mysqli_num_rows($result); // количество полученных строк
		for ($i = 0 ; $i < $rows; ++$i)
		{
			$text .= mysqli_fetch_row($result)[0];//чтобы извлечь отдельную строку, используется функция mysqli_fetch_row()
			$text .= "\r\n";
		}
	}
	mysqli_close($link);
	echo "<p>";
	echo "<textarea name=".$textareaBusy." cols=\"40\" rows=\"8\">".$text."</textarea>";
	echo "</p>";
}

function releaseComputer()
{
    global $link;
    if($_POST["computers"])
    {
        $computer = $_POST["computers"];
        $query = "UPDATE Computers SET IsFree=1 WHERE Id=".$computer;//объявляем запрос к бд
	$result = mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link));/*функция mysqli_query() возвращает объект $result,	который содержит результат запроса*/
	mysqli_close($link);
    }
}

function occupyComputer()
{
    global $link;
    if($_POST["computers"])
    {
        $computer = $_POST["computers"];
        $query = "UPDATE Computers SET IsFree=0 WHERE Id=".$computer;//объявляем запрос к бд
	$result = mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link));/*функция mysqli_query() возвращает объект $result,	который содержит результат запроса*/
	mysqli_close($link);
    }
}

?>