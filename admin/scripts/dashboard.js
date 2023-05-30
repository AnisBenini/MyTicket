if (localStorage.getItem("theme") === "dark") switchTheme("dark")

// let's drop a function in here to switch up the theme.
function switchTheme(theme) {
    if (theme === "dark") {
        document.documentElement.classList.add("dark-theme")
        localStorage.setItem("theme", "dark")
        document.querySelector(".switch-theme-btn").checked = true
    } else if (theme === "light") {
        document.documentElement.classList.remove("dark-theme")
        localStorage.setItem("theme", "light")
        document.querySelector(".switch-theme-btn").checked = false
    } else {
        // Let's toggle that thing  if none of the above parameters are given
        if (document.documentElement.classList.contains("dark-theme")) return switchTheme("light")
        else return switchTheme("dark")
    }

    return theme

}

// ############################# switch theme button ##############################

const switchThemeBtnElm = document.querySelector(".switch-theme-btn")
if (switchThemeBtnElm) switchThemeBtnElm.addEventListener("change", () => switchTheme())


// tab control
const tabControls = document.querySelectorAll(".tab-control");
const tabs = document.querySelectorAll(".tab");
const tabHeaders = document.querySelectorAll(".tab--header");



let currentTab = 0;

function selectTab(i) {
    if (i < 0 || i > tabs.length) return;


    tabs[currentTab].classList.remove("tab__selected");
    tabControls[currentTab].classList.remove("tab-control__selected");
    tabHeaders[currentTab].classList.remove("tab--header__selected");

    tabs[i].classList.add("tab__selected");
    tabControls[i].classList.add("tab-control__selected");
    tabHeaders[i].classList.add("tab--header__selected");

    currentTab = i;
    localStorage.setItem("lasttab", currentTab)
}

const lastab = localStorage.getItem("lasttab")
if (lastab) {
  selectTab(lastab)
}

tabControls.forEach((control, i) => {
    control.addEventListener("click", () => {
        selectTab(i);
    })
})


// sidebar collapse
const sidebarCollapseBtn = document.querySelector(".sidebar--collapse-btn");
const sidebar = document.querySelector(".sidebar");
const wrapper = document.querySelector(".wrapper");

sidebarCollapseBtn.addEventListener("click", () => {
    wrapper.classList.toggle("sidebar__collapsed");
});