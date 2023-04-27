
let postaBtn = document.getElementById('vissza');
console.log("posta");
console.log(postaBtn);
postaBtn.addEventListener('click', () => {


Swal.fire({
  title: 'Biztos vagy benne, hogy meg szeretnéd kapni postán is a számlát?',
  icon: 'warning',
  icon: 'warning',
      iconColor:'red',
      background: '#003554',
      color:'white',
      showCancelButton: true,
      cancelButtonText: 'Mégsem',
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
  confirmButtonText: 'Igen kérem.',
}).then((result) => {
  if (result.isConfirmed) {
      Swal.fire({
        background : '#003554',
        color:'white',
        icon: 'success',
        title: 'Kérés feldolgozva!',
        timer: 3500,
        showCancelButton: false,
        showConfirmButton: false
      })
    fetch("posta.php", {
        method: "POST",
      })
      .then((response) =>  postaBtn.style.display = "none")
        .then((data) => {
          console.log(data);
        })
        .catch((error) => console.log(error));
  }
})

})