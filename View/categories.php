<?php 
    require_once('config/server.php');
    require_once('helpers/components.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Categorias</title>
    <link rel="stylesheet" href="<?php print SERVERURL; ?>Imports/resources/css/global/materialize.min.css">
    <link rel="stylesheet" href="<?php print SERVERURL; ?>Imports/resources/css/global/material-icons.css">
    <link rel="stylesheet" href="<?php print SERVERURL; ?>Imports/resources/css/utilities/categories.css">
</head>
<body>
<?php 
    Component::navbar();
?>
<script src="<?php print SERVERURL; ?>Imports/resources/js/global/jquery-3.2.1.min.js"></script>
<script src="<?php print SERVERURL; ?>Imports/resources/js/global/materialize.min.js"></script>
<script src="<?php print SERVERURL; ?>helpers/functions.js"></script>
<script src="<?php print SERVERURL; ?>controllers/Login.js"></script>
</body>
</html>