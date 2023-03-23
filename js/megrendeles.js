let knev = document.getElementById("last-name");
let vnev = document.getElementById("first-name");
let card = document.getElementById("card");
let cvv = document.getElementById("code");
let phone = document.getElementById("phone");
let cim = document.getElementById("cim");
let varos = document.getElementById("varos");
let megye = document.getElementById("megye");
console.log(" vezetéknév", vnev);

// if(knev != ""){
//     console.log(true);
// }
// else{
//     console.log(false);
// }
let gomb = document.getElementById("rendben");
gomb.addEventListener("click", () => {
    if (
        knev.value != "" &&
        vnev.value != "" &&
        card.value != "" &&
        cvv.value != "" &&
        phone.value != "" &&
        cim.value != "" &&
        varos.value != "" &&
        megye.value != ""
    ) {
        console.log("MINDEGYIK KI VAN TÖLTVE");
        console.log("CLICK MŰKÖDIK");
        
    } else {
        console.log("ÖSSZES ÜRES");
    }
});

let torles = document.getElementById("torles");
torles.addEventListener("click", (e) => {
    
});
