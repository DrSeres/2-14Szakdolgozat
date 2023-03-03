

let gomb = document.getElementById("kuldes");

gomb.addEventListener("click", () => {    

    let adatok = new FormData();
    adatok.append("felhasznalonev", "Kaklanf");
    adatok.append("jelszo", "1234");

    fetch("feltoltes.php", {
        method: "POST",
        body: adatok
    })
    .then(response => response.text())
    .then(data => {
        
    })
    .catch(error => console.log(error));

});