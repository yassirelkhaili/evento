/**
 * @author Yassir Elkhaili
 * @license MIT
*/
/**
 * @property {string} currentTheme
 * @description keeps track of the current theme
 */
/**
 *
 * @type {string}
 */

var currentTheme = "";

var handleInitialTheme = function () {
    var rootClasses = ["transition", "duration-100"];
    rootClasses.forEach(function (rootClass) {
        return document.documentElement.classList.add(rootClass);
    });
    var themeStored = localStorage.getItem("color-theme");
    if (themeStored === "dark" || (themeStored === "auto" && window.matchMedia("(prefers-color-scheme: dark)").matches)) {
        document.documentElement.classList.add("dark");
        localStorage.setItem("color-theme", "dark");
        currentTheme = "dark";
    }
    else {
        localStorage.setItem("color-theme", "light");
        currentTheme = "light";
    }
};
handleInitialTheme();

document.addEventListener("DOMContentLoaded", function () {
    var themeToggleDarkIcon = document.getElementById("theme-toggle-dark-icon");
    var themeToggleLightIcon = document.getElementById("theme-toggle-light-icon");
    var themeToggleBtn = document.getElementById("theme-toggle");
    var dropDown = document.querySelector("#selectThemeDropdown");

    //handle skills

    const skillButtons = document.querySelectorAll(".skill-button");
    const hiddenSkillInput = document.querySelector('input[name="skills"]');
    const currentSkills = hiddenSkillInput.value.split(',');

    const handleSkillsDelete = (event) => {
        //find and delete from currentSkills array and hide skill to be deleted
        const targetSkill = event.target.parentElement.parentElement.querySelector('span').textContent;
        const targetSkillContainer = event.target.parentElement.parentElement.parentElement;
        var skillIndex = currentSkills.indexOf(targetSkill);
        if (skillIndex !== -1) currentSkills.splice(skillIndex, 1);
        targetSkillContainer.classList.add("hidden");
        //update hidden input value
        hiddenSkillInput.value = currentSkills.join(',');
    } 

    skillButtons.forEach((skillButton) => skillButton.addEventListener("click", handleSkillsDelete));
    //change welcome logo logic

    const changeLogo = () => {
        const welcomeLogo = document.getElementById("welcomeLogo");
        if (welcomeLogo) {
            const welcomeSource = welcomeLogo.getAttribute("src").split("/");
            const newLogoName = document.documentElement.classList.contains("dark") ? "youtalent-high-resolution-logo-transparent3.webp" : "youtalent-high-resolution-logo-transparent.webp";
            welcomeSource[5] = newLogoName;
            welcomeLogo.setAttribute("src", welcomeSource.join("/"));
            console.log(document.documentElement.classList.contains("dark"));
        }
    };
    
    //end change logo logic
    /**
     * @function toggleLightTheme
     * @returns {void}
     * @description Toggles light theme
     */
    var toggleLightTheme = function () {
        document.documentElement.classList.remove("dark");
        themeToggleLightIcon === null || themeToggleLightIcon === void 0 ? void 0 : themeToggleLightIcon.classList.remove("hidden");
        themeToggleDarkIcon === null || themeToggleDarkIcon === void 0 ? void 0 : themeToggleDarkIcon.classList.add("hidden");
        localStorage.setItem("color-theme", "light");
        currentTheme = "light";
    };
    var toggleDarkTheme = function () {
        document.documentElement.classList.add("dark");
        themeToggleDarkIcon === null || themeToggleDarkIcon === void 0 ? void 0 : themeToggleDarkIcon.classList.remove("hidden");
        themeToggleLightIcon === null || themeToggleLightIcon === void 0 ? void 0 : themeToggleLightIcon.classList.add("hidden");
        localStorage.setItem("color-theme", "dark");
        currentTheme = "dark";
    };
    /**
     * @function toggleThemeDropdown
     * @description handles theme dropdown toggle animation
     * @returns {void}
     */
    var toggleThemeDropdown = function () {
        if (dropDown.classList.contains("hidden")) {
            dropDown.classList.remove("hidden");
            setTimeout(function () {
                dropDown.classList.add("opacity-100");
                dropDown.classList.add("translate-y-0");
            }, 1);
            setTimeout(function () {
                dropDown.classList.remove("opacity-0");
                dropDown.classList.remove("translate-y-3");
            }, 99);
        }
        else {
            dropDown.classList.remove("opacity-100");
            dropDown.classList.remove("translate-y-0");
            dropDown.classList.add("opacity-0");
            dropDown.classList.add("translate-y-3");
            setTimeout(function () {
                dropDown.classList.add("hidden");
            }, 200);
        }
    };
    themeToggleBtn &&
        themeToggleBtn.addEventListener("click", toggleThemeDropdown);
    var handleInitialThemeIcon = function () {
        currentTheme === "dark" ? themeToggleDarkIcon.classList.remove('hidden') : themeToggleLightIcon.classList.remove('hidden');
    };
    if(themeToggleDarkIcon && themeToggleLightIcon) handleInitialThemeIcon();
    /**
     * @function handleOutsideClick
     * @description Closes theme dropdown on outside click
     * @returns {void}
     * @param element - Element being clicked
     * @param event
     */
    var handleOutsideClick = function (element, event) {
        var target = event.target;
        if (element) {
            if (target !== dropDown &&
                !element.contains(target) &&
                element.classList.contains("opacity-100"))
                toggleThemeDropdown();
        }
    };
    window.addEventListener("click", handleOutsideClick.bind(null, dropDown));
    //toggle theme
    var handleThemeSwitchBtnClick = function (index) {
        changeLogo();
        if (index === 0) {
            window.matchMedia("(prefers-color-scheme: dark)").matches
                ? toggleDarkTheme()
                : toggleLightTheme();
            localStorage.setItem("color-theme", "auto");
        }
        else if (index === 1) {
            toggleLightTheme();
        }
        else {
            toggleDarkTheme();
        }
        toggleThemeDropdown();
    };
    if (dropDown) {
        var childrenArray = Array.from(dropDown.children);
        childrenArray.forEach(function (child, index) {
            child.addEventListener("click", handleThemeSwitchBtnClick.bind(null, index));
        });
    }
    //end theme switcher logic
});