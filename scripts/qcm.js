let inputsChecked = document.querySelectorAll('.reponses input[type="radio"]');

inputsChecked.forEach(input => {
    input.addEventListener("click", () => {
        input.classList.toggle('actif');
    });
});
