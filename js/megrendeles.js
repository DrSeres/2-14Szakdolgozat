console.log("sadas");
function GombFunction(){
    
let gomb = document.getElementById("rendben");

let knev = lastname.value;
console.log(knev);

        let vnev = document.getElementById("first-name").value;

        let card = document.getElementById("card").value;
        let cvv = document.getElementById("code").value;
        let phone = document.getElementById("phone").value;
        let cim = document.getElementById("cim").value;
        let varos = document.getElementById("varos").value;
        let megye = document.getElementById("megye").value;
if (knev == "" && vnev == "" && card == "" && cvv == "" && phone == "" && cim  == "" && varos == "" && megye == ""){
    console.log("Ne csinálj semmit");
} 
else{
    console.log("asdasdasssssssssssssssss");
    gomb.addEventListener("click", () => {
        console.log(gomb);
        
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

}