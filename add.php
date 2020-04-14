<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add Product</title>
    <link rel="stylesheet" href="./Sass/normalize.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
          integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Roboto&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="./Sass/common.css">
    <link rel="stylesheet" href="./Sass/add.css">
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
                <form action="/list.php" method="get">
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
    <form action="/index.php" method="get" id="backForm"></form>
</main>
<script>
    const submitHolder = document.getElementById('submit-holder');
    const submitBtn = "<button type=\"submit\" class=\"btn btn-dark\">Submit</button>";
    const multiForm = document.getElementById('multi');

    function submitBack() {
        document.getElementById('backForm').submit();
    }

    function setFurnitureForm() {
        multiForm.innerHTML = "<div class=\"form-group\">\n" +
            "    <label for=\"height\">Height</label><input required type=\"number\" min='0.01' step='0.01' name=\"height\" id=\"height\" class=\"form-control\"\n" +
            "                                             style=\"background-color: #343434; color: aliceblue\">\n" +
            "</div>\n" +
            "\n" +
            "<div class=\"form-group\">\n" +
            "    <label for=\"width\">Width</label><input required type=\"number\" min='0.01' step='0.01' name=\"width\" id=\"width\" class=\"form-control\"\n" +
            "                                           style=\"background-color: #343434; color: aliceblue\">\n" +
            "</div>\n" +
            "\n" +
            "<div class=\"form-group\">\n" +
            "    <label for=\"length\">Length</label><input required type=\"number\" min='0.01' step='0.01' name=\"length\" id=\"length\" class=\"form-control\"\n" +
            "                                             style=\"background-color: #343434; color: aliceblue\">\n" +
            "    <p style='padding-top: 10px'>Provide height, width and length of furniture in meters</p>\n" +
            "</div>";

        submitHolder.innerHTML = submitBtn;
    }

    function setDvdForm() {
        multiForm.innerHTML = "<div class=\"form-group\">\n" +
            "    <label for=\"size\">Size</label><input required type=\"number\" min='0.01' step='0.01'  name=\"size\" id=\"size\" class=\"form-control\"\n" +
            "                                             style=\"background-color: #343434; color: aliceblue\">\n" +
            "    <p style='padding-top: 10px'>Enter size of disc in MB</p>\n" +
            "</div>";

        submitHolder.innerHTML = submitBtn;

    }

    function setBookForm() {
        multiForm.innerHTML = "<div class=\"form-group\">\n" +
            "    <label for=\"weight\">Weight</label><input required type=\"number\" min='0.01' step='0.01' name=\"weight\" id=\"weight\" class=\"form-control\"\n" +
            "                                             style=\"background-color: #343434; color: aliceblue\">\n" +
            "    <p style='padding-top: 10px'>Enter weight of book in KG</p>\n" +
            "</div>";

        submitHolder.innerHTML = submitBtn;

    }

    function setFormType(value) {

        switch (value) {
            case 'furniture':
                setFurnitureForm();
                break;
            case 'dvd':
                setDvdForm();
                break;
            case 'book':
                setBookForm();
                break;
        }
    }

</script>
<script>
    $(document).ready(function () {
        var request;

        $("#form").submit(function (event) {

            event.preventDefault();

            if (request) {
                request.abort();
            }

            var $form = $(this);

            var $inputs = $form.find("input, select, button, textarea");

            var serializedData = $form.serialize();

            $inputs.prop("disabled", true);

            var url = document.getElementById('typeSelect').value;
            request = $.ajax({
                url: "/add_" + url + ".php",
                type: "post",
                data: serializedData
            });

            request.done(function (response, textStatus, jqXHR) {
                console.log("Hooray, it worked!");
                console.log(response);
                document.getElementById('log').innerHTML = response;
            });

            request.fail(function (jqXHR, textStatus, errorThrown) {
                console.error(
                    "The following error occurred: " +
                    textStatus, errorThrown
                );
            });

            request.always(function () {
                $inputs.prop("disabled", false);
            });

        });
    });
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
