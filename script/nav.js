let cross = document.getElementById("cross");
let burger = document.getElementById("hamburger");
let menu = document.getElementById("menu");
let li = document.getElementsByTagName("li");

function init() {
    if (window.innerWidth <= 700) {
        //hamburger menu settings
        cross.style.display = "none";
        li[0].classList.add("remove");
        li[1].classList.add("remove");
        li[2].classList.add("remove");
        li[3].classList.add("remove");

        menu.addEventListener("click", function () {
            menu.classList.add("show");
            menu.classList.remove("hide");
            cross.style.display = "block";
            burger.style.display = "none";

            setTimeout(function () {
                li[0].classList.remove("remove");
                li[1].classList.remove("remove");
                li[2].classList.remove("remove");
                li[3].classList.remove("remove");
            }, 200)
        });

        cross.addEventListener("click", function () {
            menu.classList.add("hide");
            menu.classList.remove("show");
            cross.style.display = "none";
            burger.style.display = "block";
            li[0].classList.add("remove");
            li[1].classList.add("remove");
            li[2].classList.add("remove");
            li[3].classList.add("remove");
        });
    }else {
        li[0].classList.remove("remove");
        li[1].classList.remove("remove");
        li[2].classList.remove("remove");
        li[3].classList.remove("remove");
    }

}
