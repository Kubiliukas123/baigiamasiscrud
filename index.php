<?php
include "/xampp/htdocs/vcs/baigiamasiscrud/controlers/PlantController.php";

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    if (isset($_POST['save'])) {
        $hasErrors = PlantController::store();
        if (!$hasErrors) {
            header("Location:" . $_SERVER['REQUEST_URI']);
        }
    }

    if (isset($_POST['edit'])) {
        $plant = PlantController::show();
    }

    if (isset($_POST['update'])) {
        PlantController::update();
        header("Location:" . $_SERVER['REQUEST_URI']);
    }

    if (isset($_POST['destroy'])) {
        PlantController::destroy();
        header("Location:" . $_SERVER['REQUEST_URI']);
    }
}

$plants = PlantController::index();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/reset.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="./css/styles.css">
    <title>Augalų biblioteka</title>
</head>
<body>
    <main>
        <div class="bg-img">
            <div class="container">
                <h1 id="hash">Įvesk augalą</h1>
                <div class="form-container">
                    <form action="" method="post" class="form">
                
                        <label class="label-txt" for="nameLt">Lietuviškas pavadinimas</label>
                        <input class="input-content" type="text" name="nameLt"   <?= isset($_POST['edit']) ? 'value="' . $plant->nameLt . '"' : "" ?>>
                    
                        <label class="label-txt" for="nameLatin">Lotyniškas pavadinimas</label>
                        <input class="input-content" type="text" name="nameLatin"   <?= isset($_POST['edit']) ? 'value="' . $plant->nameLatin . '"' : "" ?>>
                    
                        <div class="radio">
                            <label for="annual">Vienmetis</label>
                            <input  type="radio" name="annual" value="1" checked <?= isset($_POST['edit']) ? 'value="' . $plant->annual . '"' : "" ?>>
                            <label for="annual">Daugiametis</label>
                            <input  type="radio" name="annual" value="0" <?= isset($_POST['edit']) ? 'value="' . $plant->annual . '"' : "" ?>>
                        </div>

                        <label class="label-txt" for="age">Amžius</label>
                        <input class="input-content" type="number" step="0.01" name="age"   <?= isset($_POST['edit']) ? 'value="' . $plant->age . '"' : ""  ?>>
                    
                    
                        <label class="label-txt" for="height">Aukštis</label>
                        <input class="input-content" type="number" step="0.01" name="height"  <?= isset($_POST['edit']) ? 'value="' . $plant->height . '"' : "" ?>>
                    
                        <div class="alg-cnt">
                            <?= isset($_POST['edit']) ? '<input type="hidden" name="id" value="' . $plant->id . '">' : "" ?>
                            <button type="submit" class="btn btn-success btn-edited" name=
                            <?= isset($_POST['edit']) ? '"update" >Naujinti' :'"save" >Saugoti'?>
                            </button>
                        </div>
                    </form>
                </div>
                <div>
                    <h1 id="hash">Augalų sąrašas</h1>
                        <table class="content-table">
                            <thead>
                                <tr>
                                    <th>Lietuviškas pavadinimas</th>
                                    <th>Lotyniškas pavadinimas</th>
                                    <th>Vienmetis/Daugiametis</th>
                                    <th>Amžius</th>
                                    <th>Aukštis</th>
                                    <th>Keisti</th>
                                    <th>Trinti</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($plants as $plant) { ?>
                                    <tr>
                                        <td><?=$plant->nameLt?></td>
                                        <td><?=$plant->nameLatin?></td>
                                        <td><?=($plant->annual)  ? 'Vienmetis' : 'Daugiametis'?></td>
                                        <td><?=$plant->age?> m.</td>
                                        <td><?=$plant->height?>cm</td>
                                        <td>
                                            <form action="" method="post">
                                                <input type="hidden" name="id" value="<?=$plant->id?>">
                                                <button type="submit" class="btn btn-success" name="edit" value=" <?=$plant->id?> " >Keisti</button>
                                            </form>
                                        </td>
                                        <td>
                                            <form action="" method="post">
                                                <input type="hidden" name="id" value="<?=$plant->id?>">
                                                <button type="submit" class="btn btn-danger" name="destroy" value=" <?=$plant->id?> " >Trinti</button>
                                            </form>
                                        </td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                </div>
            </div>
        </div>
    </main>
</body>
</html>