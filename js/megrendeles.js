let gomb = document.getElementById("rendben");
console.log(gomb);
let knev = document.getElementById("last-name");
console.log(knev);
        let vnev = document.getElementById("first-name");
        let card = document.getElementById("card");
        let cvv = document.getElementById("code");
        let phone = document.getElementById("phone");
        let cim = document.getElementById("cim");
        let varos = document.getElementById("varos");
        let megye = document.getElementById("megye");
if (knev !== "" || vnev !== "" || card !== ""|| cvv !== "" || phone !== "" || cim  !== "" || varos !== "" || megye !== "") {
    gomb.addEventListener("click", () => {
        
        
            let timerInterval;
            Swal.fire({
                title: "Sikeresen megrendelte a termékeit!",
                timer: 5000,
                icon:'success',
                background: "#003554",
                color: "white",
                timerProgressBar: true,
                didOpen: () => {
                    Swal.showLoading();
                    const b = Swal.getHtmlContainer().querySelector("b");
                    timerInterval = setInterval(() => {
                        b.textContent = Swal.getTimerLeft();
                    }, 100);
                },
                willClose: () => {
                    clearInterval(timerInterval);
                },
            }).then((result) => {
                /* Read more about handling dismissals below */
                if (result.dismiss === Swal.DismissReason.timer) {
                    //window.location.href='index.php';
                }
            });
        }
    );
    
}
