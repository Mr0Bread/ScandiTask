<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add Product</title>
    <link rel="stylesheet" href="../Sass/normalize.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
          integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Roboto&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../Sass/common.css">
    <link rel="stylesheet" href="../Sass/add.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
</head>
<body>
<header>
    <h1 class="title">ScandiTask</h1>
    <div class="container">
        <div class="row">
            <div class="col-sm">
                <h1 class="header">Add Product</h1>
            </div>
            <div class="col-sm" style="text-align: right">
                <form action="/Views/list.php" method="get">
                    <button type="submit" class="btn btn-dark">Product List</button>
                </form>
            </div>
        </div>
    </div>
</header>
<hr>
<main class="container">
    <form id="form" method="post">
        <div class="row">
            <div class="col-sm">
                <div class="form-group">
                    <label for="sku">SKU</label><input style="background-color: #343434; color: aliceblue"
                                                       class="form-control"
                                                       type="text" name="sku" id="sku" required>
                </div>

                <div class="form-group">
                    <label for="name">Name</label><input style="background-color: #343434; color: aliceblue"
                                                         class="form-control"
                                                         type="text" name="name" id="name"
                                                         minlength="3"
                                                         required>
                </div>

                <div class="form-group">
                    <label for="price">Price</label><input style="background-color: #343434; color: aliceblue"
                                                           class="form-control"
                                                           type="number" step="0.01" min="0.01" name="price" id="price"
                                                           required>
                </div>

                <div class="form-group">
                    <label for="typeSelect">Type</label><select style="background-color: #343434; color: aliceblue"
                                                                class="form-control" name="type" id="typeSelect"
                                                                required
                                                                oninput="setFormType(this.value)">
                        <option value="none" selected disabled>Select Type</option>
                        <option value="furniture">Furniture</option>
                        <option value="dvd">DVD</option>
                        <option value="book">Book</option>
                    </select>
                </div>
            </div>

            <div id="multi" class="col-sm"></div>
        </div>
        <div class="row">
            <div class="col-sm">
                <button type="submit" class="btn btn-dark" onclick="submitBack()">Home</button>
            </div>
            <div class="col-sm" id="submit-holder">

            </div>
        </div>
    </form>
    <div id="log" style="color: aliceblue">

    </div>
    <form action="/Views/index.php" method="get" id="backForm"></form>
</main>
<script src="../Scripts/formTypeHandler.js">
</script>
<script src="../Scripts/addRequestHandler.js">
</script>
<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
        integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo"
        crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"
        integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6"
        crossorigin="anonymous"></script>
</body>
</html>
