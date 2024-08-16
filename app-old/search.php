<!DOCTYPE html>
<html lang="fr" data-bs-theme="dark">
<head>
    <?php require("components.meta.php"); ?>
</head>
<body>
    <?php require("components.nav.php"); ?>
    <main id="main">
        <h1>Résultats pour votre recherche</h1>
        <?php

        $VENDECAR_DB = file_get_contents("data.json");
        $data = json_decode($VENDECAR_DB, true);

        if(isset($_GET['query'])) {
            $query = $_GET['query'];

            foreach($data as $brand => $models) {
                foreach($models as $model => $details) {
                  if(stripos($details['name'], $query) !== false ||
                  stripos($brand, $query) !== false ||
                  stripos($model, $query) !== false) {
                      echo "<div style='height: 10px;'></div>";
                      echo "<div class='card'>";
                      echo "<h5 class='card-header'><i>$brand</i> · <code>$model</code></h5>";
                      echo "<div class='card-body'>";
                      echo "<h5 class='card-title'><b>{$details['name']}</b></h5>";
                      echo "<p class='card-text'>Stock: {$details['stock']}</p>";
                      // echo "<a href='#' class='btn btn-primary'>Go somewhere</a>";
                      echo "</div>";
                      echo "</div>";
                    }
                }
            }
        } else {
            echo "Veuillez fournir une requête de recherche.";
        }
        ?>
    </main>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  </body>
</html>