document.getElementById("show-hide-sidebar-ad").addEventListener("click", function() {
    var sidebar = document.querySelector(".container-sidebar-ad");
    var main = document.querySelector(".main-ad-page");
    var h3 = document.querySelector(".sidebar-top-ad h3");
    var spans = document.querySelectorAll(".sidebar-bottom-ad span");
    var topSidebarIcon = document.querySelector(".sidebar-top-ad button i");

    if (sidebar.style.width === "5%") {
        sidebar.style.width = "18%";
        main.style.width = "82%";
        main.style.marginLeft = "18%";
        h3.style.display = "block";
        spans.forEach(span => {
            span.style.display = "inline";
        });
        sidebar.classList.remove("sidebar-collapsed");
        topSidebarIcon.style.transform = "rotate(0deg)";
    } else {
        sidebar.style.width = "5%";
        main.style.width = "95%";
        main.style.marginLeft = "5%";
        h3.style.display = "none";
        spans.forEach(span => {
            span.style.display = "none";
        });
        sidebar.classList.add("sidebar-collapsed");
        topSidebarIcon.style.transform = "rotate(180deg)";
    }
});
