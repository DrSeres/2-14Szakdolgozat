window.onload = function() {
    const kosaricon = document.querySelector('.kosaricon');
    //Ez az x amivel bezárjuk a felugró ablakot
    const cartCloseBtn = document.querySelector('.fa-close');
    //kosar tartalma
    const cartBox = document.querySelector('.cartBox');
    //a felugró ablak megjelenítése

    kosaricon.addEventListener('click', function() {
        cartBox.classList.add('active');
    });
    //a felugró ablak eltüntetése
    cartCloseBtn.addEventListener('click', function() {
        cartBox.classList.remove('active');
    });
    //adatok hozzáadása a kosárhoz
    const kosarhozGomb = document.getElementsByClassName('kosarhoz');
    console.log(kosarhozGomb);
    //üres tömb a bekerülő áruknak és adatoknak a tartalma
    let cuccok = [];
    //megvizsgáljuk, hogy melyik gombra történt a kattintás
    for (let i = 0; i< kosarhozGomb.length; i++) {
        kosarhozGomb[i].addEventListener('click', function(element) {
            //ha a storage nem üres akkor adja hozzá az elemeket
            if(typeof(Storage) !== 'undefined'){
                //létre hozzuk a kulcs értékpárokat
                let cucc = {
                    id: i+1,
                    name: element.target.parentElement.children[0].innerHTML,
                    price: parseInt(element.target.parentElement[1].innerHTML),
                    no: parseInt(element.target.parentElement.children[2].value)
                };
                //adjuk hozzá a localStoragehez az adatokat
                if (JSON.parse(localStorage.getItem('cuccok') === null)) {
                    cuccok.push(cucc);
                    //tárolás localStorageba
                    localStorage.setItem('cuccok', JSON.stringify(cuccok));
                    window.location.reload();
                } else {
                    const localCuccok = JSON.parse(localStorage.getItem('cuccok'));
                    console.log(localCuccok);
                    localCuccok.map(data => {
                        if (cucc.id == data.id) {
                            cucc.no += data.no;
                            //cucc.price += data.price;
                        } else {
                            cuccok.push(data);
                        }
                    });
                    cuccok.push(cucc);
                    localStorage.setItem('cuccok', JSON.stringify(cuccok));
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
    JSON.parse(localStorage.getItem('cuccok')).map(data =>{
        no = no + data.no;
    });
    kosarikonP.innerHTML = no;

    //táblázat feltöltése az adatbázisba 
    const cartBoxTable = cartBox.querySelector("table");
    console.log(cartBoxTable);
    let tableData = '';
    //fejlave
    if(JSON.parse(localStorage.getItem('cuccok'))[0] === null){
        tableData += `<tr><td colspan="5"></td></tr>`;
    } else {
        JSON.parse(localStorage.getItem('cuccok')).map(data =>{
            tableData += `<tr><td>` + data.id + `</td><td>` + data.name + `</td><td>` + data.no + ` darab</td><td>` + data.price * data.no + ` Ft</td><td><a href="#" onclick=Delete(this) style='color:red'>X</a></td></tr>`;
        })
    }
    let sum = 0;
    JSON.parse(localStorage.getItem('cuccok')).map(data =>{
        sum += data.no * data.price;
    });
    tableData += `<tr><th colspan="3"><a href="#" onclick=Megrendeles();>Megrendelés elküldése</th><th>` + sum + ` Ft</th><th><a href="#" onclick=allDelete(this)>Összes törlése</a></th></tr>`;

    cartBoxTable.innerHTML = tableData;

    

    
    
}
//törlés
function Delete(elem) {
    let cuccok = [];
    JSON.parse(localStorage.getItem('cuccok')).map(data => {
        if (data.id != elem.parentElement.parentElement.children[0].textContent) {
            cuccok.push(data);
        }
    });
    localStorage.setItem('cuccok', JSON.stringify(cuccok));
    window.location.reload();
};

function allDelete(elem) {
    let cuccok = [];
    JSON.parse(localStorage.getItem('cuccok')).map(data => {
        cuccok.splice(data);
    })
    localStorage.setItem('cuccok', JSON.stringify(cuccok));
    window.location.reload();
}

function Megrendeles()
{
    window.location.href = "megrendeles.html";
}