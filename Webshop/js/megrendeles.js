let gomb = document.getElementById("rendben");
  gomb.addEventListener('click', () => {
    Swal.fire({
      title: 'Biztosan megrendeled a termékeket?',
      text: "Nem fogod tudni visszavonni ha már rákattintottál a megrendelés gombra!",
      icon: 'warning',
      iconColor:'red',
      background: '#003554',
      color:'white',
      showCancelButton: true,
      cancelButtonText: 'Mégsem',
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Igen, megrendelem'
    }).then((result) => {
      if (result.isConfirmed) {
        Swal.fire({
          background:'#003554',
          title:'Átirányítás a rendelés fizetése menüponthoz!',
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
        },
          
        ).then((result) => {
          /* Read more about handling dismissals below */
          
          if (result.dismiss === Swal.DismissReason.timer) {
            
              
                let adatok = new FormData();
                for (n of nev) {
                  adatok.append("nev", n);
                  nevDb++;
                  adatok.append("rendelesDb", darab[nevDb]);
                  adatok.append("prices", price[nevDb]);
                  fetch("feltoltes.php", {
                    method: "POST",
                    body: adatok,
                  })
                    .then((response) => window.location.href='megrendeles.php')
                    .then((data) => {
                      console.log(data);
                    })
                    .catch((error) => console.log(error));
                }
              
            
          }
        })
        
        
    
      }
    })
  });