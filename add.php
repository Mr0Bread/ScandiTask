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
    <h1 class="header">Add Product</h1>
</header>
<hr>
<main class="container">
    <form id="form" method="post">
        <div class="row">
            <div class="col-sm">
                <div class="form-group">
                    <label for="sku">SKU</label><input style="background-color: #343434; color: aliceblue" class="form-control"
                                                       type="text" name="sku" id="sku" required>
                </div>

                <div class="form-group">
                    <label for="name">Name</label><input style="background-color: #343434; color: aliceblue" class="form-control"
                                                         type="text" name="name" id="name"
                                                         required>
                </div>

                <div class="form-group">
                    <label for="price">Price</label><input style="background-color: #343434; color: aliceblue" class="form-control"
                                                           type="text" name="price" id="price"
                                                           required>
                </div>

                <div class="form-group">
                    <label for="typeSelect">Type</label><select style="background-color: #343434; color: aliceblue" class="form-control" name="type" id="typeSelect"
                                                                required
                                                                oninput="clearForm(); setFormType()">
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
                <button type="submit" class="btn btn-dark" onclick="submitBack()">Back</button>
            </div>
            <div class="col-sm" id="submit-holder">

            </div>
        </div>
    </form>
    <form action="/index.php" method="get" id="backForm"></form>
</main>
<script>
    function submitBack() {
        document.getElementById('backForm').submit();
    }

    function setFurnitureForm() {
        const mainDiv = document.getElementById('multi');

        const heightDiv = document.createElement('div');
        heightDiv.setAttribute('class', 'form-group');

        const heightLabel = document.createElement('label');
        heightLabel.setAttribute('for', 'height');
        heightLabel.textContent = 'Height';
        const heightInput = document.createElement("input");
        heightInput.setAttribute('type', 'text');
        heightInput.setAttribute('name', 'height');
        heightInput.setAttribute('id', 'height');
        heightInput.setAttribute('class', 'form-control');
        heightInput.setAttribute('style', 'background-color: #343434; color: aliceblue');
        heightInput.required = true;

        heightDiv.appendChild(heightLabel);
        heightDiv.appendChild(heightInput);

        const widthDiv = document.createElement('div');
        widthDiv.setAttribute('class', 'form-group');

        const widthLabel = document.createElement('label');
        widthLabel.setAttribute('for', 'width');
        widthLabel.textContent = 'Width';
        const widthInput = document.createElement('input');
        widthInput.setAttribute('type', 'text');
        widthInput.setAttribute('name', 'width');
        widthInput.setAttribute('id', 'width');
        widthInput.setAttribute('class', 'form-control');
        widthInput.setAttribute('style', 'background-color: #343434; color: aliceblue');
        widthInput.required = true;

        widthDiv.appendChild(widthLabel);
        widthDiv.appendChild(widthInput);

        const lengthDiv = document.createElement('div');
        lengthDiv.setAttribute('class', 'form-group');

        const lengthLabel = document.createElement('label');
        lengthLabel.setAttribute('for', 'length');
        lengthLabel.textContent = 'Length';
        const lengthInput = document.createElement('input');
        lengthInput.setAttribute('type', 'text');
        lengthInput.setAttribute('name', 'length');
        lengthInput.setAttribute('id', 'length');
        lengthInput.setAttribute('class', 'form-control');
        lengthInput.setAttribute('style', 'background-color: #343434; color: aliceblue');
        lengthInput.required = true;

        lengthDiv.appendChild(lengthLabel);
        lengthDiv.appendChild(lengthInput);

        const submit = document.createElement('button');
        submit.setAttribute('type', 'submit');
        submit.setAttribute('class', 'btn btn-dark');
        submit.innerHTML = 'Submit';
        document.getElementById('submit-holder').appendChild(submit);

        mainDiv.appendChild(heightDiv);
        mainDiv.appendChild(widthDiv);
        mainDiv.appendChild(lengthDiv);
    }

    function clearForm() {
        const mainDiv = document.getElementById('multi');
        const submitHolderDiv = document.getElementById('submit-holder');

        while (submitHolderDiv.firstChild) {
            submitHolderDiv.removeChild(submitHolderDiv.firstChild);
        }

        while (mainDiv.firstChild) {
            mainDiv.removeChild(mainDiv.firstChild);
        }
    }

    function setDvdForm() {
        const mainDiv = document.getElementById('multi');

        const sizeDiv = document.createElement('div');
        sizeDiv.setAttribute('class', 'form-group');

        const sizeLabel = document.createElement('label');
        sizeLabel.setAttribute('for', 'size');
        sizeLabel.textContent = 'Size';
        const sizeInput = document.createElement("input");
        sizeInput.setAttribute('type', 'text');
        sizeInput.setAttribute('name', 'size');
        sizeInput.setAttribute('id', 'size');
        sizeInput.setAttribute('class', 'form-control');
        sizeInput.setAttribute('style', 'background-color: #343434; color: aliceblue');

        sizeDiv.appendChild(sizeLabel);
        sizeDiv.appendChild(sizeInput);

        const submit = document.createElement('button');
        submit.setAttribute('type', 'submit');
        submit.setAttribute('class', 'btn btn-dark');
        submit.innerHTML = 'Submit';

        document.getElementById('submit-holder').appendChild(submit);

        mainDiv.appendChild(sizeLabel);
        mainDiv.appendChild(sizeInput);

    }

    function setBookForm() {
        const mainDiv = document.getElementById('multi');

        const weightDiv = document.createElement('div');
        weightDiv.setAttribute('class', 'form-group');

        const weightLabel = document.createElement('label');
        weightLabel.setAttribute('for', 'weight');
        weightLabel.textContent = 'Weight';
        const weightInput = document.createElement("input");
        weightInput.setAttribute('type', 'text');
        weightInput.setAttribute('name', 'weight');
        weightInput.setAttribute('id', 'weight');
        weightInput.setAttribute('class', 'form-control');
        weightInput.setAttribute('style', 'background-color: #343434; color: aliceblue');

        const submit = document.createElement('button');
        submit.setAttribute('type', 'submit');
        submit.setAttribute('class', 'btn btn-dark');
        submit.innerHTML = 'Submit';

        document.getElementById('submit-holder').appendChild(submit);

        mainDiv.appendChild(weightLabel);
        mainDiv.appendChild(weightInput);

    }

    function setFormType() {
        const type = document.getElementById('typeSelect').value;

        switch (type) {
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
        // Variable to hold request
        var request;

        // Bind to the submit event of our form
        $("#form").submit(function (event) {

            // Prevent default posting of form - put here to work in case of errors
            event.preventDefault();

            // Abort any pending request
            if (request) {
                request.abort();
            }
            // setup some local variables
            var $form = $(this);

            // Let's select and cache all the fields
            var $inputs = $form.find("input, select, button, textarea");

            // Serialize the data in the form
            var serializedData = $form.serialize();

            // Let's disable the inputs for the duration of the Ajax request.
            // Note: we disable elements AFTER the form data has been serialized.
            // Disabled form elements will not be serialized.
            $inputs.prop("disabled", true);

            var url = document.getElementById('typeSelect').value;
            request = $.ajax({
                url: "/add_" + url + ".php",
                type: "post",
                data: serializedData
            });

            // Callback handler that will be called on success
            request.done(function (response, textStatus, jqXHR) {
                // Log a message to the console
                console.log("Hooray, it worked!");
                console.log(response);
            });

            // Callback handler that will be called on failure
            request.fail(function (jqXHR, textStatus, errorThrown) {
                // Log the error to the console
                console.error(
                    "The following error occurred: " +
                    textStatus, errorThrown
                );
            });

            // Callback handler that will be called regardless
            // if the request failed or succeeded
            request.always(function () {
                // Reenable the inputs
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
