<?php

function statItemCheck($item)
{
    if ($item) {
        return $item;
    } else return 0;
}

if (isset($_POST['submit'])) {
    echo statItemCheck($_POST['centang']);
}
?>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <form action="" method="post">
        <input type="checkbox" name="centang" id="centang" value="1">
        <input type="submit" name="submit" id="submit">
    </form>
</body>

</html>