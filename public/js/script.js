document.addEventListener('DOMContentLoaded', function () {
    const checkbox = document.querySelector("#gridCheck");
    const breaking = document.querySelector('#breaking-block')

    checkbox.addEventListener('change', function () {
        if (this.checked) {
            console.log("Checkbox is checked..");
            breaking.classList.remove('d-none')
            breaking.classList.add('row')
        } else {
            console.log("Checkbox is not checked..");
            breaking.classList.add('d-none')
        }
    });
})