
function setThemeOnLoad() {
    if (
        localStorage.theme === "dark" ||
        (!(localStorage.theme) &&
            window.matchMedia("(prefers-color-scheme: dark)").matches)
     ) {
        document.documentElement.classList.add("dark");
    } else {
        document.documentElement.classList.remove("dark");
    }
}

function switchTheme() {
    if (
        localStorage.theme === "dark" ||
        (!(localStorage.theme) &&
            window.matchMedia("(prefers-color-scheme: dark)").matches)
    ) {
        document.documentElement.classList.remove("dark");
        localStorage.theme = "light";
    } else {
        document.documentElement.classList.add("dark");
        localStorage.theme = "dark";
    }
}

export { setThemeOnLoad, switchTheme };
