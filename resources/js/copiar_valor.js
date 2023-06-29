function copiarValor(inputId) {
    let input = document.getElementById(inputId);
    input.select();
    input.setSelectionRange(0, 99999);
    document.execCommand("copy");
}