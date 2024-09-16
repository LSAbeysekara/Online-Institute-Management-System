//sidebar section
const sideMenu = document.querySelector("aside");
const menuBtn = document.querySelector("#menu-btn");
const closeBtn = document.querySelector("#close-btn");

menuBtn.addEventListener("click", () => {
    sideMenu.style.display = 'block';
})

closeBtn.addEventListener("click", () => {
    sideMenu.style.display = 'none';
})


//Theme section
// JavaScript code
const themeToggler = document.querySelector(".theme-toggler");
const darkThemeClass = 'dark-theme-variables';
const activeThemeKey = 'activeTheme';

// Function to set the theme preference to localStorage
const setThemePreference = (isDarkTheme) => {
    localStorage.setItem(activeThemeKey, isDarkTheme ? 'dark' : 'light');
}

// Function to apply the theme based on the user's preference
const applyThemePreference = () => {
    const activeTheme = localStorage.getItem(activeThemeKey);
    if (activeTheme === 'dark') {
        document.body.classList.add(darkThemeClass);
        themeToggler.querySelector('span:nth-child(1)').classList.remove('active');
        themeToggler.querySelector('span:nth-child(2)').classList.add('active');
    } else {
        document.body.classList.remove(darkThemeClass);
        themeToggler.querySelector('span:nth-child(1)').classList.add('active');
        themeToggler.querySelector('span:nth-child(2)').classList.remove('active');
    }
}

// Add event listener to the theme toggler button
themeToggler.addEventListener('click', () => {
    document.body.classList.toggle(darkThemeClass);
    themeToggler.querySelector('span:nth-child(1)').classList.toggle('active');
    themeToggler.querySelector('span:nth-child(2)').classList.toggle('active');

    // Store the user's preference in localStorage
    const isDarkTheme = document.body.classList.contains(darkThemeClass);
    setThemePreference(isDarkTheme);
});

// When the page loads, apply the theme based on the user's preference stored in localStorage
document.addEventListener('DOMContentLoaded', () => {
    applyThemePreference();
});







//NO reloaed after submetting the form
var form = document.getElementById("formId02");
        var opTag = document.getElementById("opTag");
        function submitForm(event) {
            event.preventDefault();
            opTag.innerHTML = "<b>Form submit successful</b>";
        }
        //form.addEventListener('submit', submitForm);