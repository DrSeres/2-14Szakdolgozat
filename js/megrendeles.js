

let knev = document.getElementById("last-name");
let vnev = document.getElementById("first-name");
let card = document.getElementById("card");
let cvv = document.getElementById("code");
let phone = document.getElementById("phone");
let cim = document.getElementById("cim");
let varos = document.getElementById("varos");
let megye = document.getElementById("megye");
console.log(' vezetéknév', vnev);

// if(knev != ""){
//     console.log(true);
// }
// else{
//     console.log(false);
// }
let gomb = document.getElementById('rendben');
gomb.addEventListener("click", () => {
    
    if (
        knev.value != "" && vnev.value != "" && card.value != "" &&
        cvv.value != "" && phone.value != "" && cim.value != "" &&
        varos.value != "" && megye.value != ""
    ) {
       
        console.log("MINDEGYIK KI VAN TÖLTVE");
        console.log("CLICK MŰKÖDIK");
       
        
        let timerInterval;
        Swal.fire({
            background: '#003554',
            title: 'Rögzítettük a rendelését!',
            text: 'Köszönjük, hogy nálunk vásárolt.',
            icon: 'success',
            color: 'white',
            timer: 4000,
            timerProgressBar: true,
            didOpen: () => {
                Swal.showLoading()
            },
            willClose: () => {
                clearInterval(timerInterval)
            }
        },).then((result) => {
            /* Read more about handling dismissals below */
            if (result.dismiss === Swal.DismissReason.timer) {
                //window.location.href = 'index.php';
                localStorage.clear();
            }
        });
    }
    else {
        console.log("ÖSSZES ÜRES");
    }
});

let torles = document.getElementById('torles');
torles.addEventListener('click', e => {
    Swal.fire({
        title: 'Biztosan törlöd a terméket?',
        text: "Nem fogod tudni visszavonni ha már töröltél egy terméket!",
        icon: 'warning',
        iconColor: 'red',
        background: '#003554',
        color: 'white',
        showCancelButton: true,
        cancelButtonText: 'Mégsem',
        confirmButtonColor: 'red',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Igen, törlöm'
    }).then((result) => {
        if (result.isConfirmed) {
            Swal.fire({
                background: '#003554',
                title: 'Termékek törlése',
                icon: 'success',
                color: 'white',
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
            },
            ).then((result) => {
                    if (result.dismiss === Swal.DismissReason.timer) {
                        window.location.href='index.php';
                        localStorage.clear();
                    }
                
            })
        }
    })
});
