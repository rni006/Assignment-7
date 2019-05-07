/*navigation script written by candidate 110*/
let isOpen = false;
function toggleExpansion() {

    /*all elements that need to be tweaked*/
    let navOptions = document.getElementById("navOptions");
    let menu = document.getElementById("menu");
    let hamburger = document.getElementById("hamburger");
    let cross = document.getElementById("cross");


    if (!isOpen){
        /*adds all necceccary classes to display the navigation options*/
        navOptions.classList.add("expandMenu");
        menu.classList.add("showList");
        hamburger.classList.add("hideHam");
        cross.classList.add("displayCross");
        isOpen = true;
    }
    else {
        navOptions.classList.remove("expandMenu");
        menu.classList.remove("showList");
        hamburger.classList.remove("hideHam");
        cross.classList.remove("displayCross");
        isOpen = false;
    }

}