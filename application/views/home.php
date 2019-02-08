<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Document</title>
</head>
<body>
  <h1>Learning git now</h1>
<?php


use Carbon\Carbon;

  $today = Carbon::now()->toDayDateTimeString();

  echo $today;

  ?>
</body>
</html>