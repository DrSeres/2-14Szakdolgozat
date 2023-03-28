
let btn = document.querySelectorAll(".felhasznaloKezeles");
console.log(btn);
let i = 0;
btn.forEach((elem) => {
    elem.addEventListener(('click'), (element) => {
            if (elem.value == "Kitiltás") {
            elem.value = "Engedélyezés";
            elem.innerHTML = "Engedélyezés";
            // console.log(element.dataset.id);
            console.log("s");
            console.log(elem.dataset.id);
            let formdata = new FormData();
            formdata.append("id", elem.dataset.id);
            fetch("kitiltas.php", {
                method: "POST",
                body: formdata,
              })
                .then((response) => response.text())
                .then((data) => {
                  console.log(data);
                })
                .catch((error) => console.log(error));
        }
        else {
            elem.value = "Kitiltás";
            elem.innerHTML = "Kitiltás";
            console.log("s");
            console.log(elem.dataset.id);
            let formdata = new FormData();
            formdata.append("id", elem.dataset.id);
            fetch("engedelyezes.php", {
                method: "POST",
                body: formdata,
              })
                .then((response) => response.text())
                .then((data) => {
                  console.log(data);
                })
                .catch((error) => console.log(error));
        }
    })
});



