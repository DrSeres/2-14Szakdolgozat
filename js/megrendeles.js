let torles = document.getElementById('torles');

let knev = document.getElementById("last-name");
let vnev = document.getElementById("first-name");
let card = document.getElementById("card");
let cvv = document.getElementById("code");
let phone = document.getElementById("phone");
let cim = document.getElementById("cim");
let varos = document.getElementById("varos");
let megye = document.getElementById("megye");
console.log(' vezetéknév',vnev);

// if(knev != ""){
//     console.log(true);
// }
// else{
//     console.log(false);
// }
let gomb = document.getElementById('rendben');
gomb.addEventListener("click", e => {
    if (
        knev.value != "" && vnev.value != "" && card.value != "" && 
        cvv.value != "" && phone.value != "" && cim.value != "" && 
        varos.value != "" && megye.value != ""
        ) {
        console.log("MINDEGYIK KI VAN TÖLTVE");
        e.preventDefault();
        console.log("CLICK MŰKÖDIK");
        let timerInterval;
        Swal.fire({
            background:'#003554',
            title:'Kössz a rendelést',
            icon:'success',
            color:'white',
            timer: 4000,
            timerProgressBar: true,
            didOpen: () => {
                Swal.showLoading()
                const b = Swal.getHtmlContainer().querySelector('b')
                timerInterval = setInterval(() => {
                b.textContent = Swal.getTimerLeft()
                }, 100)
            },
            willClose: () => {
                clearInterval(timerInterval)
            }
            },).then((result) => {
            
            /* Read more about handling dismissals below */
            if (result.dismiss === Swal.DismissReason.timer) {
            }
        });
    }
    else{
        console.log("ÖSSZES ÜRES");
    }
});
