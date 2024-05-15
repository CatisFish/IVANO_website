document.addEventListener("DOMContentLoaded", function() {
    const toggleButton = document.getElementById("toggleButton");
    const sidebar = document.getElementById("sidebar");
    const content = document.getElementById("content");
    const navIcons = document.querySelector(".nav-icons");
    const dashboardTitle = document.querySelector(".top-sidebar h2");
    const navLinks = document.querySelectorAll(".nav-icons ul li a span");
    const iconLink = document.querySelectorAll(".nav-icons ul li a i")
    const toggleIcon = document.querySelector("#toggleButton i");

    toggleButton.addEventListener("click", function() {
        sidebar.classList.toggle("hidden");
        if (sidebar.classList.contains("hidden")) {
            sidebar.style.width = "5%";
            dashboardTitle.style.display = "none";
            navIcons.style.width = "100%";
            content.style.marginLeft = "5%";
            navLinks.forEach(function(link) {
                link.style.display = "none";
            });

            iconLink.forEach(function(icon) {
                icon.style.textAlign = "center";
            });
            
            toggleIcon.classList.remove("fa-xmark");
            toggleIcon.classList.add("fa-bars");
        } else {
            sidebar.style.width = "15%";
            dashboardTitle.style.display = "block";
            navIcons.style.width = "100%";
            content.style.marginLeft = "15%";
            navLinks.forEach(function(link) {
                link.style.display = "inline";
            });
            toggleIcon.classList.remove("fa-bars");
            toggleIcon.classList.add("fa-xmark");
        }
    });
});
