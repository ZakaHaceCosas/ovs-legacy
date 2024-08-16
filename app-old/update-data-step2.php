<!DOCTYPE html>
<html lang="fr" data-bs-theme="dark">
<head>
    <?php require("components.meta.php"); ?>
</head>
<body>
    <?php require("components.nav.php"); ?>
    <main id="main">
        <h1>Mettre à jour les données</h1>
            <?php
            if (isset($_GET['set'])) {
                $QUERY = $_GET['set'];
                $VENDECAR_DB = file_get_contents("data.json");
                $VENDECAR_DT = json_decode($VENDECAR_DB, true);
                $HAS_ERRED_NONEXISTANTBRAND = true;
                foreach ($VENDECAR_DT as $BRAND => $MODELS) {
                    if ($BRAND == $QUERY) {
                        echo "<form action='update-data-step3.php' method='get'>";
                        echo "<input type='text' style='display: none;' name='brand' value='$QUERY' id='brandHiddenInput'>";
                        echo "<div class='mb-3'>";
                        echo "<select required class='form-select' aria-label='Choisir le modèl' id='actDatosModSelect' name='model'>";
                        echo "<option selected disabled>Choisir le modèl</option>";

                                foreach ($MODELS as $MODEL => $DETS) {
                                    echo "<option value='$MODEL'>{$DETS['name']}</option>";
                                }
                        echo "</select>";
                        echo "</div>";
                        
                        echo "<div class='mb-3'>";
                        echo "<label for='cambiarDatosCantidad' class='form-label'>Quantité</label>";
                        echo "<input type='number' class='form-control' id='cambiarDatosCantidad' name='amount' required>";
                        echo "<div class='form-text'>Il doit s'agir d'un nombre.</div>";
                        echo "</div>";
                        
                        echo "<div class='mb-3' style='width: 100%;'>";
                        echo "<div class='btn-group' role='group' style='width: 100%;'>";
                        echo "<input type='radio' class='btn-check' name='transaction' id='transactionAchete' value='achete' autocomplete='off' checked>";
                        echo "<label class='btn btn-outline-success' for='transactionAchete'>ACHETÉ (AJOUTER AU TOTAL)</label>";

                        echo "<input type='radio' class='btn-check' name='transaction' id='transactionVendu' value='vendu' autocomplete='off'>";
                        echo "<label class='btn btn-outline-danger' for='transactionVendu'>VENDU (RÉDUCTION DU TOTAL)</label>";
                        echo "</div>";
                        echo "</div>";

                        echo "<div class='mb-3'>";
                        echo "<button type='submit' class='btn btn-primary'>PROCÉDER</button>";
                        echo "</div>";
                        echo "</form>";
                        $HAS_ERRED_NONEXISTANTBRAND = false;
                    }
                }

                if ($HAS_ERRED_NONEXISTANTBRAND) {
                    echo "<div class='alert alert-warning' role='alert'>";
                    echo "<h4 class='alert-heading'>ERREUR!</h4>";
                    echo "<code>CODE D'ERREUR: Ux002</code>";
                    echo "<p>L'argument <code>?set</code> a été spécifié, mais a pris une valeur inexistante. Cela peut se produire si vous avez collé directement une URL au lieu d'utiliser le sélecteur de l'étape précédente. Veuillez retourner à l'étape précédente et sélectionner un SET valide. Merci.</p>";
                    echo "<hr>";
                    echo "<p class='mb-0'><i>Si vous êtes sûr d'avoir sélectionné un SET valide et que vous voyez à nouveau cette erreur, contactez le développeur.</i></p>";
                    echo "</div>";
                    echo "<a href='update-data.php'><button type='button' class='btn btn-outline-warning'>REVENIR</button></a>";
                    $HAS_ERRED_NONEXISTANTBRAND = true;
                }
            }
            else {
                echo "<div class='alert alert-warning' role='alert'>";
                echo "<h4 class='alert-heading'>ERREUR!</h4>";
                echo "<code>CODE D'ERREUR: Ux001</code>";
                echo "<p>L'argument <code>?set</code> n'a pas été spécifié. Veuillez retourner à l'étape précédente et spécifier un SET valide. Merci.</p>";
                echo "<hr>";
                echo "<p class='mb-0'><i>Si vous êtes sûr d'avoir saisi un SET et que cette erreur s'affiche à nouveau, parlez-en au développeur du programme.</i></p>";
                echo "</div>";
                echo "<a href='update-data.php'><button type='button' class='btn btn-outline-warning'>REVENIR</button></a>";
            };
            ?>
    </main>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>