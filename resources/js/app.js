import "./bootstrap";

const THEME_KEY = "laraventory-theme";
const DARK_CLASS = "dark";

const applyTheme = (isDark) => {
    document.documentElement.classList.toggle(DARK_CLASS, isDark);
};

document.addEventListener("DOMContentLoaded", () => {
    const toggle = document.getElementById("theme-toggle");
    const stored = localStorage.getItem(THEME_KEY);
    const isDark = stored ? stored === "dark" : true;

    applyTheme(isDark);

    if (toggle) {
        toggle.checked = isDark;
        toggle.addEventListener("change", () => {
            const nextIsDark = toggle.checked;
            localStorage.setItem(THEME_KEY, nextIsDark ? "dark" : "light");
            applyTheme(nextIsDark);
        });
    }
});
