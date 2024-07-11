const tabs = document.querySelectorAll(".tabs");
tabs.forEach((tab) => {
    tab.querySelector("button").addEventListener("click", () => {
        tabs.forEach(t => {
            t.classList.remove("is-open");
        });
        tab.classList.add("is-open");
    });
});