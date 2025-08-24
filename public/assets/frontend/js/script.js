// category dropdown js start

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
// category dropdown js end


// user modal js start
document.addEventListener('DOMContentLoaded', initializeUserInteraction);

function initializeUserInteraction() {
    const userModal = document.getElementById("userModal");

    // Event listener for closing modal by clicking outside of it
    window.addEventListener('click', handleWindowClick);
}

function handleUserIconClick(e) {
    e.preventDefault();
    const isGuest = e.target.closest('#userIcon').getAttribute('data-modal') === 'login';

    if (isGuest) {
        const userModal = document.getElementById("userModal");
        if (userModal) {
            userModal.style.display = "block";
        }
    }
}

function handleModalClose() {
    const userModal = document.getElementById("userModal");
    if (userModal) {
        userModal.style.display = "none";
    }
}

function handleWindowClick(event) {
    const userModal = document.getElementById("userModal");
    if (userModal && event.target === userModal) {
        userModal.style.display = "none";
    }
}

function handleTabClick(clickedButton) {
    const userModal = document.getElementById("userModal");
    const tabBtns = userModal.querySelectorAll(".tab-btn");
    const formContents = userModal.querySelectorAll(".form-content");

    // Remove 'active' class from all tabs and forms
    tabBtns.forEach(btn => btn.classList.remove("active"));
    formContents.forEach(content => content.classList.remove("active"));

    // Add 'active' class to the clicked tab and its corresponding form
    clickedButton.classList.add("active");
    const tabName = clickedButton.getAttribute("data-tab");
    document.getElementById(`${tabName}-form`).classList.add("active");
}

// user modal js end

// register form password matching js start

const passwordInput = document.getElementById('register-password');
const confirmPasswordInput = document.getElementById('register-confirm');
const messageContainer = document.getElementById('password-match-message');

// Function to check if passwords match
function checkPasswords() {
    // Get the current values of the two fields
    const passwordValue = passwordInput.value;
    const confirmValue = confirmPasswordInput.value;

    // Only show a message if both fields have a value
    if (passwordValue.length > 0 && confirmValue.length > 0) {
        if (passwordValue === confirmValue) {
            // Passwords match
            messageContainer.textContent = '';
            messageContainer.style.color = 'green';
        } else {
            // Passwords do not match
            messageContainer.textContent = 'Passwords do not match!';
            messageContainer.style.color = 'red';
        }
    } else {
        // Clear the message if one of the fields is empty
        messageContainer.textContent = '';
    }
}

// Add event listeners to both input fields for real-time validation
passwordInput.addEventListener('keyup', checkPasswords);
confirmPasswordInput.addEventListener('keyup', checkPasswords);

// register form password matching js end



// wish and cart increament js start

const cart_add = document.getElementById('cart_add');
const cart_count = document.querySelector('.cart_count');

function count_cart() {
    let cart_count_field = parseInt(cart_count.innerText) || 0;
    cart_count_field++;

    cart_count.innerText = cart_count_field;
}

// wishlist increament
document.addEventListener('DOMContentLoaded', function () {
    const wishCount = document.getElementById('wish_count');
    const wishlistBtn = document.getElementById('wishlist_btn');

    let count = 0;

    wishlistBtn.addEventListener('click', function () {
        count++;
        wishCount.textContent = count;
    });
});

// wish and cart increament js end 