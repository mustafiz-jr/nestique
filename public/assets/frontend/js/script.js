// js for category dropdown toggle 
const toggleBtn = document.getElementById("catddToggle");
const dropdown = document.getElementById("catddDropdown");
const closeBtn = dropdown.querySelector(".catdd-close-btn");
const body = document.body;

toggleBtn.addEventListener("click", () => {
    const isShown = dropdown.classList.toggle("show");
    toggleBtn.querySelector("i.fa-chevron-down").classList.toggle("fa-rotate-180", isShown);
    toggleBtn.setAttribute("aria-expanded", isShown);

    if (window.innerWidth <= 768) {
        closeBtn.style.display = isShown ? "flex" : "none";
        if (isShown) {
            body.classList.add("dropdown-open");
            dropdown.querySelectorAll(".catdd-links").forEach((dl) => {
                expandSection(dl);
                dl.previousElementSibling.classList.add("active");
            });
        } else {
            body.classList.remove("dropdown-open");
        }
    }
});

closeBtn.addEventListener("click", () => {
    dropdown.classList.remove("show");
    toggleBtn.querySelector("i.fa-chevron-down").classList.remove("fa-rotate-180");
    toggleBtn.setAttribute("aria-expanded", false);
    closeBtn.style.display = "none";
    body.classList.remove("dropdown-open");
});

const headers = dropdown.querySelectorAll("h4");

headers.forEach((h4) => {
    h4.addEventListener("click", () => {
        const linksContainer = h4.nextElementSibling;
        const isCollapsed = linksContainer.classList.contains("collapsed");

        if (isCollapsed) {
            expandSection(linksContainer);
            h4.classList.add("active");
        } else {
            collapseSection(linksContainer);
            h4.classList.remove("active");
        }
    });

    h4.addEventListener("keydown", (e) => {
        if (e.key === "Enter" || e.key === " ") {
            e.preventDefault();
            h4.click();
        }
    });
});

function expandSection(element) {
    element.classList.remove("collapsed");
    let height = element.scrollHeight;
    element.style.maxHeight = height + "px";
    element.style.opacity = 1;
    element.style.transform = "translateX(0)";
    element.addEventListener("transitionend", function te() {
        element.style.maxHeight = null;
        element.removeEventListener("transitionend", te);
    });
}

function collapseSection(element) {
    let height = element.scrollHeight;
    element.style.maxHeight = height + "px";
    element.style.opacity = 0;
    element.style.transform = "translateX(-15px)";
    requestAnimationFrame(() => {
        element.style.maxHeight = "0";
        element.classList.add("collapsed");
    });
}

document.addEventListener("click", (e) => {
    if (
        !dropdown.contains(e.target) &&
        !toggleBtn.contains(e.target) &&
        dropdown.classList.contains("show")
    ) {
        dropdown.classList.remove("show");
        toggleBtn.querySelector("i.fa-chevron-down").classList.remove("fa-rotate-180");
        toggleBtn.setAttribute("aria-expanded", false);
        closeBtn.style.display = "none";
        body.classList.remove("dropdown-open");
    }
});

const observer = new MutationObserver(() => {
    if (body.classList.contains("dropdown-open")) {
        document.documentElement.style.overflow = "hidden";
        document.body.style.overflow = "hidden";
    } else {
        document.documentElement.style.overflow = "";
        document.body.style.overflow = "";
    }
});
observer.observe(body, {
    attributes: true,
    attributeFilter: ["class"]
});