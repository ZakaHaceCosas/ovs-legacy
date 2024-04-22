<!DOCTYPE html>
<html lang="fr" data-bs-theme="dark">
<head>
    <?php require("components/meta.php"); ?>
</head>
<body>
    <?php require("components/nav.php"); ?>
    <main id="main">
        <?php
        $OPENVENDESYS_DB = file_get_contents('data/data.json');
        $OPENVENDESYS_DT = json_decode($OPENVENDESYS_DB, true);

        if (isset($_GET['brand']) && isset($_GET['model']) && isset($_GET['amount']) && isset($_GET['transaction'])) {
            $BRAND = $_GET['brand'];
            $MODEL = $_GET['model'];
            $NUM = $_GET['amount'];
            $OPERATION = $_GET['transaction'];

            $OPERATINGWITH = $OPENVENDESYS_DT[$BRAND][$MODEL];
            $OPERATINGWITHNAME = $OPERATINGWITH['name'];
            $OLDNUM = $OPERATINGWITH['stock'];
            $NEWNUM = $OPERATINGWITH['stock'];

            if ($OPERATION == 'achete') {
                $NEWNUM += $NUM;
            } elseif ($OPERATION == 'vendu') {
                $NEWNUM -= $NUM;
            }

            $OPENVENDESYS_DT[$BRAND][$MODEL]['stock'] = $NEWNUM;

            file_put_contents('data/data.json', json_encode($OPENVENDESYS_DT, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
        }

        echo "<div class='alert alert-info' role='alert'>";
        echo "<h4 class='alert-heading'>SUCCÈS!</h4>";
        echo "<p>La quantité de $OPERATINGWITHNAME a été mise à jour avec succès!</p>";
        echo "<hr>";
        echo "<p class='mb-0'><i><b>AVANT: $OLDNUM<br>ACTUELLEMENT: $NEWNUM</b></i></p>";
        echo "</div>";
        echo "<a href='index.php'><button type='button' class='btn btn-outline-info'>REVENIR</button></a>";
        ?>
        <br>
        <br>
        <div class="alert alert-danger" role="alert">
            REMARQUE: <b>NE</b> rechargez/actualisez pas la page. Cliquez sur "Revenir".
            <i>Dans le cas où vous rechargez/actualisez la page, l'opération sera doublée (c'est-à-dire que si vous avez acheté 50 unités, le rechargement en ajoutera 50 deux fois (100)). Si cela devait arriver par accident, vous pouvez soit faire l'opération inverse (par exemple soustraire 50) pour récupérer la valeur souhaitée, soit éditer manuellement <code>data/data.json</code> (non recommandé).</i>
        </div>
    </main>
    <?php require("components/foot.php"); ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>