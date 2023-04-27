// function countdown(elementName, minutes, seconds) {
//   let element, endTime, hours, mins, msLeft, time;

//   function twoDigits(n) {
//       return (n <= 9 ? '0' + n : n);
//   }

//   function updateTimer() {
//       msLeft = endTime - (+new Date);

//       if (msLeft < 1000) {
//         // location.href = "index2.php";
//         localStorage.clear();
//       } else {
//           time = new Date(msLeft);
//           hours = time.getUTCHours();
//           mins = time.getUTCMinutes();
//           element.innerHTML = (hours ? hours + ':' + twoDigits(mins) : mins) + ':' + twoDigits(time.getUTCSeconds());

//           // Save current time locally
//           localStorage.setItem('lastHValue', hours);
//           localStorage.setItem('lastMValue', mins);
//           localStorage.setItem('lastSValue', time.getUTCSeconds());

//           setTimeout(updateTimer, time.getUTCMilliseconds() + 500);
//       }
//   }

//   element = document.getElementById(elementName);
//   endTime = (+new Date) + 1 * (10*minutes + seconds) + 1;

//   updateTimer();
// }

// if (localStorage.getItem('lastHValue')) {
//   let lastHValue = parseInt(localStorage.getItem('lastHValue')),
//       lastMValue = parseInt(localStorage.getItem('lastMValue')),
//       lastSValue = parseInt(localStorage.getItem('lastSValue'));

//   let totalMValue = parseInt((lastHValue * 60) + lastMValue);

//   countdown('countdown', totalMValue, lastSValue);
// } else {
//   countdown('countdown', 1439, 59);
// }


// countdown('countdown', totalMValue, lastSValue);



//NÉZI, HOGY HOL TART A FELHASZNÁLÓ AZ OLDAL NÉUEGETÉSE SORÁN ÉS FRISSÍTÉSKOR ODA VISZI
document.addEventListener("DOMContentLoaded", function(event) { 
  let scrollpos = localStorage.getItem('scrollpos');
  if (scrollpos) window.scrollTo(0, scrollpos);
});

window.onbeforeunload = function(e) {
  localStorage.setItem('scrollpos', window.scrollY);
};





var hoursleft = 0;
var minutesleft = 2; //give minutes you wish
var secondsleft = 30; // give seconds you wish
var finishedtext = "Countdown finished!";
var end1;
if(localStorage.getItem("end1")) {
end1 = new Date(localStorage.getItem("end1"));
} else {
end1 = new Date();
end1.setMinutes(end1.getMinutes()+minutesleft);
end1.setSeconds(end1.getSeconds()+secondsleft);

};
var counter = function () {
var now = new Date();
var diff = end1 - now;

diff = new Date(diff);

var milliseconds = parseInt((diff%1000)/100)
    var sec = parseInt((diff/1000)%60)
    var mins = parseInt((diff/(1000*60))%60)
    //var hours = parseInt((diff/(1000*60*60))%24);

if (mins < 10) {
    mins = "0" + mins;
}
if (sec < 10) { 
    sec = "0" + sec;
}     
if(now >= end1) {     
    clearTimeout(interval);
   // localStorage.setItem("end", null);
     localStorage.removeItem("end1");
    document.getElementById('divCounter').innerHTML = finishedtext;
    window.location.href = "index2.php";
} else {
    var value = mins + ":" + sec;
    localStorage.setItem("end1", end1);
    document.getElementById('divCounter').innerHTML = value;
}
}
var interval = setInterval(counter, 1000);


// var hoursleft =10;
// var minutesleft = 0;
// var secondsleft = 1; 
// var finishedtext = "Countdown finished!";
// var end;
// if(localStorage.getItem("end")) {
//     end = new Date(localStorage.getItem("end"));
// } else {
//     end = new Date();
//     end.setMinutes(end.getMinutes()+minutesleft);
//     end.setSeconds(end.getSeconds()+secondsleft);
// }
// var counter = function () {
//     var now = new Date();
//     var diff = end - now;
//     diff = new Date(diff);
//     var sec = diff.getSeconds();
//     var min = diff.getMinutes(); 
//     if (min < 10) {
//         min = "0" + min;
//     }
//     if (sec < 10) { 
//         sec = "0" + sec;
//     }     
//     if(now >= end) {     
//         clearTimeout(interval);
//         localStorage.setItem("end", null)
//         document.getElementById('divCounter').innerHTML = finishedtext;
//         location.href = "index2.php";
//     } else {
//         var value = min + ":" + sec;
//         localStorage.setItem("end", end);
//         document.getElementById('divCounter').innerHTML = value;
//     }
// }
// var interval = setInterval(counter, 1000);



let popUp = document.getElementById("cookiePopup");
console.log("popup:");
console.log(popUp);
//When user clicks the accept button
document.getElementById("acceptCookie").addEventListener("click", () => {
  //Create date object
  console.log(document.getElementById("acceptCookie"))
  let d = new Date();
  //Increment the current time by 1 minute (cookie will expire after 1 minute)
  d.setMinutes(2 + d.getMinutes());
  //Create Cookie withname = myCookieName, value = thisIsMyCookie and expiry time=1 minute
  document.cookie = "myCookieName=Cookie elfogadása; expires = " + d + ";";
  //Hide the popup
  popUp.classList.add("hide");
  popUp.classList.remove("show");
});
//Check if cookie is already present
const checkCookie = () => {
  //Read the cookie and split on "="
  let input = document.cookie.split("=");
  //Check for our cookie
  if (input[0] == "myCookieName") {
    //Hide the popup
    popUp.classList.add("hide");
    popUp.classList.remove("show");
  } else {
    //Show the popup
    popUp.classList.add("show");
    popUp.classList.remove("hide");
  }
};
//Check if cookie exists when page loads
window.onload = () => {
  setTimeout(() => {
    checkCookie();
  }, 2000);
};




const toggle = document.querySelector(".toggle");
console.log(toggle);
const menu = document.querySelector(".menu");
const items = document.querySelectorAll(".item");

/* Toggle mobile menu */
function toggleMenu() {
  if (menu.classList.contains("active")) {
    menu.classList.remove("active");
    toggle.querySelector("a").innerHTML = "<i class='fas fa-bars'></i>";
  } else {
    menu.classList.add("active");
    toggle.querySelector("a").innerHTML = "<i class='fas fa-times'></i>";
  }
};

/* Activate Submenu */
function toggleItem() {
  if (this.classList.contains("submenu-active")) {
    this.classList.remove("submenu-active");
  } else if (menu.querySelector(".submenu-active")) {
    menu.querySelector(".submenu-active").classList.remove("submenu-active");
    this.classList.add("submenu-active");
  } else {
    this.classList.add("submenu-active");
  }
};

/* Close Submenu From Anywhere */
function closeSubmenu(e) {
  if (menu.querySelector(".submenu-active")) {
    let isClickInside = menu
      .querySelector(".submenu-active")
      .contains(e.target);

    if (!isClickInside && menu.querySelector(".submenu-active")) {
      menu.querySelector(".submenu-active").classList.remove("submenu-active");
    }
  }
};
/* Event Listeners */
toggle.addEventListener("click", toggleMenu, false);
for (let item of items) {
  if (item.querySelector(".submenu")) {
    item.addEventListener("click", toggleItem, false);
  }
  item.addEventListener("keypress", toggleItem, false);
}
document.addEventListener("click", closeSubmenu, false);









jQuery(document).ready(function() {
  var allItems = [],
      lineFull = [],
      firstItem,
      arr2 = [],
      arr1 = [],
      count,
      count2,
      actualEl,
      lineGap,
      firstArr2,
      last,
      firstArr1;

  allItems = $('.per-carousel .item').toArray();
  firstItem = allItems[0];
  allItems.shift();
  arr1 = allItems.splice(0, Math.ceil(allItems.length /2));
  arr2 = allItems;
  lineFull = [...arr1, ...arr2];
  arr2.reverse();
  carouselClass();

  function carouselClass() {  
      $(".per-carousel .item").removeClass('center-item before-item after-item');
      $(".per-carousel .item").css('z-index','0');
      $(firstItem).addClass('center-item');
      $(firstItem).css('z-index','90');
      count = arr1.length;
      count2 = arr2.length;
      actualEl = lineFull.indexOf(firstItem);
      lineGap = (((actualEl + 2)*100)/(lineFull.length + 1));
      $(".actual-line").css('width',lineGap + '%');
      for(i = 0; i < arr1.length; i++) {
          if (arr1.length == count) {
              $(arr1[i]).addClass('second-item');
          }
          count--;
          $(arr1[i]).addClass('after-item');
          $(arr1[i]).css('z-index', count);
      }

      for(i = 0; i < arr2.length ; i++) {
          if (arr2.length == count2) {
              $(arr2[i]).addClass('last-item');
          }
          count2--;
          $(arr2[i]).addClass('before-item');
          $(arr2[i]).css('z-index', count2);
      }
  }

  function sliding(firstArray, secondArray) {
      firstArr2 = secondArray.pop();
      firstArray.push(firstArr2);
      secondArray.unshift(firstItem);
      last = secondArray[-1];
      firstArray.push(last);
      firstArr1 = firstArray[0];
      firstItem = firstArr1;
      firstArray.shift();
      firstArray.pop();
      $(".per-carousel .item").removeClass('center-item before-item after-item last-item second-item');
      carouselClass();
  }

  $(document).on('click', '.second-item, .per-next', function() {
      sliding(arr1, arr2);
  });

  $(document).on('click', '.last-item, .per-prev', function() {
      sliding(arr2, arr1);
  });

  $(".per-carousel").on("touchstart", function(event){
      console.log("work");
  var xClick = event.originalEvent.touches[0].pageX;
      $(this).one("touchmove", function(event){
          var xMove = event.originalEvent.touches[0].pageX;
          if( Math.floor(xClick - xMove) > 5 ){
              sliding(arr1, arr2);
          }
          else if( Math.floor(xClick - xMove) < -5 ){
              sliding(arr2, arr1);
          }
      });
      $(".per-carousel").on("touchend", function(){
              $(this).off("touchmove");
      });
  });
});



//Számla gombra kattintás számolása

function clickCounter() {
  if (typeof(Storage) !== "undefined") {
    if (localStorage.clickcount) {
      localStorage.clickcount = Number(localStorage.clickcount)+1;
    } else {
      localStorage.clickcount = 1;
    }
    document.getElementById("result").innerHTML = "localStorage.clickcount";
  } else {
    document.getElementById("result").innerHTML = "Sorry, your browser does not support web storage...";
  }
}


//Számla kiállítása postán

