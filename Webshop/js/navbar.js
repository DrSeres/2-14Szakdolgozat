
  


const responsiveButton = document.getElementById('responsiveToggleButton');

const navBarLinks = document.querySelector('.navbar-links');

responsiveButton.addEventListener('click', () => {
  navBarLinks.classList.toggle('open');
  responsiveButton.classList.toggle('open');
})

const allNavLinks = document.querySelectorAll('.navbar-links li');

allNavLinks.forEach(link => {
  link.addEventListener('click', () => {
    navBarLinks.classList.remove('open');
    responsiveButton.classList.remove('open');
  })
});


let foGomb = document.getElementById('foOldalButton');
console.log(foGomb);
foGomb.addEventListener('click', () => {
  localStorage.removeItem('oldal');
  
});