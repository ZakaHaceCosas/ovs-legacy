<!DOCTYPE html>
<html lang="fr" data-bs-theme="dark">
<head>
    <?php require("components/meta.php"); ?>
</head>
<body>
    <?php require("components/nav.php"); ?>
    <main id="main">
        <h1>Mettre à jour les données</h1>
        <form action="update-data-step2.php" method="GET">
            <div class="mb-3">
                <select required class="form-select" aria-label="Choisir le set" id="actDatosSetSelect" name="set">
                    <?php
                    $OPENVENDESYS_DB = file_get_contents('data/data.json');
                    $OPENVENDESYS_DT = json_decode($OPENVENDESYS_DB, true);
            
                    $BRANDS = array_keys($OPENVENDESYS_DT);

                    echo "<option selected disabled>Choisir le set</option>";
                    foreach ($BRANDS as $BRAND) {
                        echo "<option value=$BRAND>$BRAND</option>";
                    };
                    ?>
                </select>
            </div>
            <button type="submit" class="btn btn-primary" id="procederAlStep2ActualizarDatos">CONTINUER</button>
        </form>
    </main>
    <?php require("components/foot.php"); ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>