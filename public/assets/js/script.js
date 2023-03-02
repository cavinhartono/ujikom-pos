const menu = document.querySelector("#menu");

menu.onclick = () => {
    document.querySelector(".navbar-side").classList.toggle("active");
    document.querySelector(".navbar-brand").classList.toggle("active");
    document.querySelector(".content").classList.toggle("active");
};

setTimeout(() => {
    document.querySelector(".alert").classList.add("hide");
}, 5000);
