<nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container-fluid">
        <span class="navbar-brand mb-0 h1">
            <a href="index.php">
                <?php echo $INTERN_NAME ?>
            </a>
        </span>
        <form class="d-flex" role="search" action="search.php" method="GET" id="rechercheForm">
            <?php
            if(isset($_GET['query'])) {
                $Q = $_GET['query'];
            } else {
                $Q = null;
            }
            ?>
            <input class="form-control me-2" type="search" placeholder="Recherche" name="query" id="query" aria-label="Recherche" pattern="^\S.*$" oninvalid="this.setCustomValidity('Veuillez saisir une requête de recherche valide.')" oninput="setCustomValidity('')" autocomplete="off" value="<?php echo $Q; ?>">
            <button class="btn btn-outline-success" type="submit">Recherche</button>
        </form>
        <script>
            document.getElementById('rechercheForm').addEventListener('submit', function(event) {
                var queryInput = document.getElementById('query');
                if (queryInput.value.trim() === '') {
                    event.preventDefault();
                    queryInput.setCustomValidity('Veuillez saisir une requête de recherche valide.');
                }
            });
        </script>
    </div>
</nav>