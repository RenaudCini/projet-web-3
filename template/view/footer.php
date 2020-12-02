<footer>
    <script src="/asset/lib/jquery/jquery.min.js"></script>
    <script src="/asset/lib/popper/popper.min.js"></script>
    <script src="/asset/lib/bootstrap/bootstrap.min.js"></script>
    <?php
    if (isset($js)) {
        foreach ($js as $script) {
            echo "<script src='/asset/js/$script'></script>";
        }
    }
    ?>

    <div class="bg-dark text-white text-center p-3 container-fluid m-0">
        <p><a class="text-white" href="#">Facebook</a>
            &bull; <a class="text-white" href="#">Twitter</a>
            &bull; <a class="text-white" href="#">Instagram</a></p>
        <p><a class="text-white" href="#">Nous contacter</a>

        </p>
        <p>
            <span>Les recettes du programmeur</span> &bull; <span>Copyright 2020</span>
            &bull; <span>Tous droits réservés</span>
        </p>

    </div>
</footer>

</body>

</html>