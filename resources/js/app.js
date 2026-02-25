import "./bootstrap";

const THEME_KEY = "laraventory-theme";
const DARK_CLASS = "dark";

const resolveTheme = () => {
    const stored = localStorage.getItem(THEME_KEY);
    if (stored) {
        return stored === "dark";
    }
    localStorage.setItem(THEME_KEY, "dark");
    return true;
};

const applyTheme = (isDark) => {
    document.documentElement.classList.toggle(DARK_CLASS, isDark);
};

const initTheme = () => {
    const toggle = document.getElementById("theme-toggle");
    const isDark = resolveTheme();

    applyTheme(isDark);

    if (toggle) {
        toggle.checked = isDark;
        if (!toggle.dataset.themeBound) {
            toggle.dataset.themeBound = "true";
            toggle.addEventListener("change", () => {
                const nextIsDark = toggle.checked;
                localStorage.setItem(THEME_KEY, nextIsDark ? "dark" : "light");
                applyTheme(nextIsDark);
            });
        }
    }
};

document.addEventListener("DOMContentLoaded", initTheme);
document.addEventListener("livewire:navigated", initTheme);
