

let gomb = document.getElementById('rendben');
gomb.addEventListener('click', () => {
    let knev = document.getElementById('last-name');
    let vnev = document.getElementById('first-name');
    let card = document.getElementById('card');
    let cvv = document.getElementById('code');
    let phone = document.getElementById('phone');
    let cim = document.getElementById('cim');
    let varos = document.getElementById('varos');
    let megye = document.getElementById('megye');
    if (knev != "" || vnev != "") {
        Swal.fire({
            background: '#003554',
            title: 'Sikeresen megrendelte a termékeit!',
            icon: 'warning',
            color: 'white',
        })
    } else {
        Swal.fire({
            background: '#003554',
            title: 'Sikeresen megrendelte a termékeit!',
            icon: 'success',
            color: 'white',
        })
    }
    
});




