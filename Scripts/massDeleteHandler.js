function passValueToForm(value, id) {
    if (document.getElementById(id).checked === true) {
        const input = document.createElement('input');
        input.setAttribute('type', 'hidden');
        input.setAttribute('name', 'id' + value);
        input.setAttribute('id', 'id' + value);
        input.setAttribute('value', value);
        input.setAttribute('class', 'hiddenIdInput');
        document.getElementById('massDeleteForm').appendChild(input);
    } else {
        document.getElementById('id' + value).remove();
    }
}

function compoundAllHiddenValuesIntoOne() {
    let allInputs = document.getElementsByClassName('hiddenIdInput');
    const input = document.createElement('input');
    input.setAttribute('type', 'hidden');
    input.setAttribute('name', 'idsToDelete');
    for (let i = 0; i < allInputs.length; i++) {
        if (i === allInputs.length - 1) {
            input.value += allInputs[i].value
        } else {
            input.value += allInputs[i].value + ",";
        }
    }
    input.value = "(" + input.value + ")";
    document.getElementById('massDeleteForm').appendChild(input);
    $('.hiddenIdInput').remove();
}

function submitDelete() {
    document.getElementById("massDeleteForm").submit();
}