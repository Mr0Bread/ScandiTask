<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Product List</title>
    <link rel="stylesheet" href="./Sass/normalize.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
          integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://unpkg.com/infinite-scroll@3/dist/infinite-scroll.pkgd.min.js"></script>
    <link href="https://fonts.googleapis.com/css?family=Roboto&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="./Sass/common.css">
    <link rel="stylesheet" href="./Sass/list.css">
</head>
<body>
<header>
    <h1 class="header">Product List</h1>
</header>
<hr>
<main>
    <div>
        <div style="text-align: left">
            <form action="/index.php" method="get">
                <button type="submit" class="btn btn-dark">Back</button>
            </form>
        </div>
        <div id="upperPagination"></div>
    </div>
    <div class="grid-container" id="container">
        <?php
        require "Config/Core.php";

        $page = isset($_GET['page']) ? $_GET['page'] : 1;

        $no_of_records_per_page = 9;
        $offset = ($page - 1) * $no_of_records_per_page;

        $db_client = new MySQLDataBase();
        $db_client->connect();
        $result = $db_client->getRows($no_of_records_per_page, $offset);

        while ($row = $result->fetch_assoc()) {
            echo "<div class=\"grid-item\"> 
                    SKU: " . $row['sku'] . "<br>
                    Name: " . $row['name'] . "<br>
                    Price: " . $row['price'] . "<br>
                </div>";
        }

        ?>
    </div>
    <div style="margin-top: 10px">
        <nav id="navBar">
            <ul class="pagination justify-content-center">
                <?php
                $total_rows = $db_client->getRowCount();
                $total_pages = ceil($total_rows / $no_of_records_per_page);

                if ($page != 1) {
                    $previous = $page - 1;
                    echo "<li class=\"page-item\"><a class=\"page-link\" href=\"http://localhost:8080/list.php?page=$previous\">Previous</a></li>";
                }

                for ($i = 1; $i <= $total_pages; $i++) {
                    if ($i == $page) {
                        echo "<li class=\"page-item active\">
                          <a class=\"page-link\" href=\"http://localhost:8080/list.php?page=$i\">$i<span class=\"sr-only\">(current)</span></a>
                          </li>";
                    } else {
                        echo "<li class=\"page-item\"><a class=\"page-link\" href=\"http://localhost:8080/list.php?page=$i\">$i</a></li>";
                    }
                }

                if ($page != $total_pages) {
                    $next = $page + 1;
                    echo "<li class=\"page-item\"><a class=\"page-link\" href=\"http://localhost:8080/list.php?page=$next\">Next</a></li>";
                }

                $db_client->close();
                ?>
            </ul>
        </nav>
    </div>
    <script>
        var navBar = document.getElementById('navBar');
        var clone = navBar.cloneNode(true);
        document.getElementById('upperPagination').appendChild(clone);
    </script>
</main>
<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
        integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo"
        crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"
        integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6"
        crossorigin="anonymous"></script>
</body>
</html>
