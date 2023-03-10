window.onload = function () {

 
  const kosaricon = document.querySelector(".kosaricon");
  console.log(kosaricon);
  //Ez az x amivel bezárjuk a felugró ablakot
  const cartCloseBtn = document.querySelector(".fa-close");
  //kosar tartalma
  const cartBox = document.querySelector(".cartBox");
  console.log(cartBox);


  //kedvenc termék hozzáadása az adatbázishoz
  const heartBtn = document.querySelectorAll(".fa-heart");
  console.log(heartBtn);


heartBtn.forEach(element => {
  
  element.addEventListener("click", () => {
      console.log(element.dataset.id);
      element.style.color = "red";
      let adatok = new FormData();
      adatok.append("id", element.dataset.id);
    fetch("heart.php", {
      method: "POST",
      body: adatok,
    })
      .then((response) => response.text())
      .then((data) => {
        console.log(data);
      })
      .catch((error) => console.log(error));
  });
});
heartBtn.forEach(element => {
  
  element.addEventListener("dblclick", () => {
      console.log(element.dataset.id);
      element.style.color = "white";
      let adatok = new FormData();
      adatok.append("id", element.dataset.id);
    fetch("heart.php", {
      method: "POST",
      body: adatok,
    })
      .then((response) => response.text())
      .then((data) => {
        console.log(data);
      })
      .catch((error) => console.log(error));
  });
});


  //a felugró ablak megjelenítése

  kosaricon.addEventListener("click", function () {
    cartBox.classList.add("active");
  });
  //a felugró ablak eltüntetése
  cartCloseBtn.addEventListener("click", function () {
    cartBox.classList.remove("active");
  });
  //adatok hozzáadása a kosárhoz
  const kosarhozGomb = document.getElementsByClassName("kosarhoz");
  console.log(kosarhozGomb);
  //üres tömb a bekerülő áruknak és adatoknak a tartalma
  let termekek = [];

  //megvizsgáljuk, hogy melyik gombra történt a kattintás
  for (let i = 0; i < kosarhozGomb.length; i++) {
    kosarhozGomb[i].addEventListener("click", function (element) {
      //ha a storage nem üres akkor adja hozzá az elemeket
      if (typeof Storage !== "undefined") {
        //létre hozzuk a kulcs értékpárokat
        let termek = {
          id: i + 1,
          kep: element.target.parentElement.parentElement.parentElement
            .children[0].innerHTML,
          name: element.target.parentElement.parentElement.children[0]
            .innerHTML,
          price: parseInt(
            element.target.parentElement.parentElement.children[2].innerHTML
          ),
          no: parseInt(element.target.parentElement.children[0].value),
        };
        console.log(termek);
        //adjuk hozzá a localStoragehez az adatokat
        if (JSON.parse(localStorage.getItem("termekek") === null)) {
          termekek.push(termek);
          //tárolás localStorageba
          localStorage.setItem("termekek", JSON.stringify(termekek));
          window.location.reload();
        } else {
          const localtermekek = JSON.parse(localStorage.getItem("termekek"));
          console.log(localtermekek);
          localtermekek.map((data) => {
            if (termek.id == data.id) {
              termek.no += data.no;
              //termek.price += data.price;
            } else {
              termekek.push(data);
            }
          });
          termekek.push(termek);
          localStorage.setItem("termekek", JSON.stringify(termekek));
          window.location.reload();
        }
      } else {
        alert("A local storage nem működik a böngészőben!");
      }
    });
  }
  //rendelés hozzáadása a kosárhoz
  const kosarikonP = document.querySelector(".kosaricon p");
  console.log(kosarikonP);
  let no = 0;
  JSON.parse(localStorage.getItem("termekek")).map((data) => {
    no = no + data.no;
  });
  kosarikonP.innerHTML = no;

  //táblázat feltöltése az adatbázisba
  const cartBoxTable = cartBox.querySelector("table");
  console.log(cartBoxTable);
  let tableData = "";
  let price = [];
  let nevDb = -1;
  let darab = [];
  let nev = [];
  // let t = [];
  //fejlave
  if (JSON.parse(localStorage.getItem("termekek"))[0] === null) {
    tableData += `<tr><td colspan="6"></td></tr>`;
  } else {
    JSON.parse(localStorage.getItem("termekek")).map((data) => {
      tableData +=
        `<tr style='display:none;'><td>` +
        data.id +
        `<tr><td>` +
        data.kep +
        `</td><td>` +
        data.name +
        `</td><td>` +
        data.no +
        ` darab</td><td>` +
        data.price * data.no +
        ` Ft</td><td><a href="#" onclick=Delete(this) style='color:#051923; font-weight:900'>X</a></td></tr>`;

      nev.push(data.name);
      console.log(nevDb);
      price.push(data.price * data.no);
      darab.push(data.no);

      // t.push(nev);
      // t.push(price);
      // t.push(darab);
    });
  }
  let sum = 0;

  JSON.parse(localStorage.getItem("termekek")).map((data) => {
    sum += data.no * data.price;
  });
  tableData +=
    `<tr><th colspan="3" class='megrendeles'><a href="#" onclick=Megrendeles(); id='kuldes'>Megrendelés elküldése</th><th class='fizetes'>` +
    sum +
    ` Ft</th ><th class='osszesTorles'><a href="#" onclick=allDelete(this)>Összes törlése</a></th></tr>`;

  cartBoxTable.innerHTML = tableData;

  let gomb = document.getElementById("kuldes");
  console.log(gomb);
  gomb.addEventListener("click", () => {
    console.log("szia");
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
        .then((response) => response.text())
        .then((data) => {
          console.log(data);
        })
        .catch((error) => console.log(error));
    }









    // adatok.append("rendelesDb", darab[0]);
    // adatok.append("prices", price[0]);

    console.log(adatok);
  });
};

//törlés
function Delete(elem) {
  let termekek = [];
  JSON.parse(localStorage.getItem("termekek")).map((data) => {
    if (data.id != elem.parentElement.parentElement.children[0].textContent) {
      termekek.push(data);
    }
  });
  localStorage.setItem("termekek", JSON.stringify(termekek));
  window.location.reload();
}

function allDelete(elem) {
  let termekek = [];
  JSON.parse(localStorage.getItem("termekek")).map((data) => {
    termekek.splice(data);
  });
  localStorage.setItem("termekek", JSON.stringify(termekek));
  window.location.reload();
}

function Megrendeles() {
  window.location.href = "megrendeles.php";
}
