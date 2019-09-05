<?php 
    require_once('helpers/components.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Ver subcategorias</title>
    <?php 
        Component::styles('view_subcategories');
    ?>
</head>
<body>
    <?php 
        Component::navbar();
    ?>
    <div class="row">
        <div class="col s12 m4 offset-m4">
            <div class="card" id="card-content-subcategories">
                <div class="card-content">
                    <div class="center card-title">
                        <span class="grey-text" id="titleSubcategory">Subcategorías</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php 
    Component::scripts('Selected_category');
?>
</body>
</html>