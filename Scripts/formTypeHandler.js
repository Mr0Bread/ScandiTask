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
        "    <p style='padding-top: 10px'>Provide height, width and length of furniture in meters</p><input type='hidden' name='type' value='Furniture'>\n" +
        "</div>";

    submitHolder.innerHTML = submitBtn;
}

function setDvdForm() {
    multiForm.innerHTML = "<div class=\"form-group\">\n" +
        "    <label for=\"size\">Size</label><input required type=\"number\" min='0.01' step='0.01'  name=\"size\" id=\"size\" class=\"form-control\"\n" +
        "                                             style=\"background-color: #343434; color: aliceblue\">\n" +
        "    <p style='padding-top: 10px'>Enter size of disc in MB</p>\n<input type='hidden' name='type' value='DVD'>" +
        "</div>";

    submitHolder.innerHTML = submitBtn;

}

function setBookForm() {
    multiForm.innerHTML = "<div class=\"form-group\">\n" +
        "    <label for=\"weight\">Weight</label><input required type=\"number\" min='0.01' step='0.01' name=\"weight\" id=\"weight\" class=\"form-control\"\n" +
        "                                             style=\"background-color: #343434; color: aliceblue\">\n" +
        "    <p style='padding-top: 10px'>Enter weight of book in KG</p>\n<input type='hidden' name='type' value='Book'>" +
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