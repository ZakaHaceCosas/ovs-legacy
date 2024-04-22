<!DOCTYPE html>
<html lang="fr" data-bs-theme="dark">
<head>
    <?php require("components/meta.php"); ?>
</head>
<body>
    <?php require("components/nav.php"); ?>
    <main id="main">
        <h1>Résultats pour votre recherche</h1>
        <?php
        $OPENVENDESYS_DB = file_get_contents("data/data.json");
        $DATA = json_decode($OPENVENDESYS_DB, true);

        if(isset($_GET['query']) && trim($_GET['query']) !== '') {
            $QUERY = trim($_GET['query']);
            $RESULTS = false;

            foreach($DATA as $BRAND => $MODELS) {
                foreach($MODELS as $MODEL => $DETAILS) {
                    if(stripos($DETAILS['name'], $QUERY) !== false ||
                    stripos($BRAND, $QUERY) !== false ||
                    stripos($MODEL, $QUERY) !== false) {
                        echo "<div style='height: 10px;'></div>";
                        echo "<div class='card'>";
                        echo "<h5 class='card-header'><i>$BRAND</i> · <code>$MODEL</code></h5>";
                        echo "<div class='card-body'>";
                        echo "<h5 class='card-title'><b>{$DETAILS['name']}</b></h5>";
                        echo "<p class='card-text'>Stock: {$DETAILS['stock']}</p>";
                        echo "</div>";
                        echo "</div>";
                        $RESULTS = true;
                    }
                }
            }

            if(!$RESULTS) {
                echo "<div class='alert alert-warning' role='alert'>No results found for your search.</div>";
            }
        } else {
            echo "<div class='alert alert-warning' role='alert'>Please enter a search query.</div>";
        }
        ?>
    </main>
    <?php require("components/foot.php"); ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  </body>
</html>