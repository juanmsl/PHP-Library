var navbar = document.getElementById("pw-navbar");

window.onscroll = function() {
    let distance = window.scrollY;
    if(distance > 0) {
        navbar.classList.add("pw-navbar_scroll");
    } else {
        navbar.classList.remove("pw-navbar_scroll");
    }
};