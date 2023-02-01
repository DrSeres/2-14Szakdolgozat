// //responsive navbar oldal.php-ben
// function myFunction() {
//     var x = document.getElementById("myTopnav");
//     if (x.className === "topnav") {
//       x.className += " responsive";
//     } else {
//       x.className = "topnav";
//     }
//   }









  let navbar = document.querySelector('.navbar');
  document.querySelector('#menu-btn').onclick = () => {
      navbar.classList.toggle('active');
      cartItem.classList.remove('active');
  };
  
  
  
  
  let cartItem = document.querySelector('.cart-items-container');
  document.querySelector('#cart-btn').onclick = () => {
      cartItem.classList.toggle('active');
      navbar.classList.remove('active');
  };
  
  window.onscroll = () => {
      navbar.classList.remove('active');
      cartItem.classList.remove('active');
  }
  
  