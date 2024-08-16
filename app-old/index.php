<!DOCTYPE html>
<html lang="fr" data-bs-theme="dark">
<head>
    <?php require("components.meta.php"); ?>
</head>
<body>
    <?php require("components.nav.php"); ?>
    <main id="main">
        <h1>Stock par modèl</h1>
        <?php
        $VENDECAR_DB = file_get_contents('data.json');
        $VENDECAR_DT = json_decode($VENDECAR_DB, true);

        $BRANDS = array_keys($VENDECAR_DT);

        foreach ($BRANDS as $BRAND) {
            $BRAND_DT = $VENDECAR_DT[$BRAND];
            $SUBTOTAL = 0;
            $LOW_ST_ALERT_FIRED = false;

            foreach ($BRAND_DT as $MODEL => $DETS) {
                $SUBTOTAL += $DETS['stock'];
                if ($DETS['stock'] < 20 && $DETS['stock'] > 0 && !$LOW_ST_ALERT_FIRED) {
                    echo "<div class='alert alert-warning' role='alert'>Certains articles de la catégorie <b>$BRAND</b> ont un faible stock (19 ou moins).</div>";
                    $LOW_ST_ALERT_FIRED = true;
                }
                elseif ($DETS['stock'] == 0 && !$LOW_ST_ALERT_FIRED) {
                    echo "<div class='alert alert-danger' role='alert'>En rupture de stock dans certains articles de la catégorie <b>$BRAND</b>.</div>";
                    $LOW_ST_ALERT_FIRED = true;
                }
            }

            if ($SUBTOTAL < 20 && $SUBTOTAL > 0) {
                echo "<div class='alert alert-warning' role='alert'>Stock total faible (19 ou moins) dans l'ensemble <b>$BRAND</b></div>";
                ${$BRAND . '_BADGEBG_CSSVAR'} = "text-bg-warning";
            } elseif ($SUBTOTAL == 0) {
                echo "<div class='alert alert-danger' role='alert'>En rupture de stock dans le set <b>$BRAND</b></div>";
                ${$BRAND . '_BADGEBG_CSSVAR'} = "text-bg-danger";
            } else {
                ${$BRAND . '_BADGEBG_CSSVAR'} = "text-bg-primary";
            }
        }

        foreach ($VENDECAR_DT as $BRAND => $MODELS) {
            $SUBTOTAL = array_sum(array_column($MODELS, 'stock'));
            $BADGE_BST_CLR_VAR = "text-bg-primary";
  
            if ($SUBTOTAL < 20 && $SUBTOTAL > 0) {
              echo "<div class='alert alert-warning' role='alert'>Stock total faible (19 ou moins) dans l'ensemble <b>$BRAND</b></div>";
              $BADGE_BST_CLR_VAR = "text-bg-warning";
            } elseif ($SUBTOTAL == 0) {
              echo "<div class='alert alert-danger' role='alert'>En rupture de stock dans le set <b>$BRAND</b></div>";
              $BADGE_BST_CLR_VAR = "text-bg-danger";
            }
        }
        ?>
        <a href="update-data.php">
          <button type="button" class="btn btn-success" id="updateDataEndBodyBtn">Mettre à jour les données</button>
        </a>
        <div style='height: 10px;'></div>
        <ol class="list-group list-group-numbered">
        <?php
        foreach ($VENDECAR_DT as $BRAND => $MODELS) {
          echo '<li class="list-group-item d-flex justify-content-between align-items-start">';
          echo '<div class="ms-2 me-auto">';
          echo '<div class="fw-bold">' . $BRAND . '</div>';
          echo '<div style="height: 5px;"></div>';
          echo '<ul class="list-group list-group-flush">';
      
          foreach ($MODELS as $MODEL => $DETS) {
              $MODEL_CLR = "white";
              if ($DETS['stock'] < 20 && $DETS['stock'] > 0) {
                  $MODEL_CLR = "var(--bs-warning-text-emphasis)";
              } elseif ($DETS['stock'] == 0) {
                  $MODEL_CLR = "var(--bs-danger-text-emphasis)";
              }
              
              echo '<li class="list-group-item">' . $DETS['name'] . ': <b><u style="color: ' . $MODEL_CLR . '">STOCK: ' . $DETS['stock'] . '</u></b></li>';
          }
      
          echo '</ul>';
          echo '</div>';
          echo "<span class='badge $BADGE_BST_CLR_VAR'>TOTAL: $SUBTOTAL</span>";
          echo '</li>';
        }
        ?>
        </ol>
    </main>
    <?php require("components.foot.php"); ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>