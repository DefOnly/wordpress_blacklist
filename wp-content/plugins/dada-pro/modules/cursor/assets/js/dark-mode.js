(function ($) {
    "use strict";
    $(document).ready(function () {
        const setDarkMode = (active = false) => {
            const wrapper = document.querySelector(":root");
            if (active) {
                wrapper.setAttribute("data-theme", "dark");
                localStorage.setItem("theme", "dark");
            } else {
                wrapper.setAttribute("data-theme", "light");
                localStorage.setItem("theme", "light");
            }
        };

        const toggleDarkMode = () => {
            const theme = document.querySelector(":root").getAttribute("data-theme");
            setDarkMode(theme === "light");

            const toggleButtonTe = document.querySelector(".js__dark-mode-toggle");
            if (theme === "light") {
                let attrClass = toggleButtonTe.attributes.class;
                attrClass.nodeValue = "js__dark-mode-toggle dark-mode-toggle wdtDark"
            } else {
                let attrClass = toggleButtonTe.attributes.class;
                attrClass.nodeValue = "js__dark-mode-toggle dark-mode-toggle"
            };
        };

        const initDarkMode = () => {
            const query = window.matchMedia("(prefers-color-scheme: dark)");
            const themePreference = localStorage.getItem("theme");

            let active = query.matches;
            if (themePreference === "dark") {
                active = true;
            }

            if (themePreference === "light") {
                active = false;
            }

            setDarkMode(active);

            query.addListener((e) => setDarkMode(e.matches));

            const toggleButton = document.querySelector(".js__dark-mode-toggle");
            toggleButton.addEventListener("click", toggleDarkMode);
        };

        initDarkMode();

        
    });
})(jQuery);