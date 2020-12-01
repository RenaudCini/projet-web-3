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
</footer>

</body>

</html>