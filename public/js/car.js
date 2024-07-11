if (document.querySelector("#modal")) document.querySelector("#modal").show();

const
    tabs = document.querySelectorAll(".tabs"),
    blocks = document.querySelectorAll("[block]"),
    price = +document.querySelector("#price").textContent,
    days = document.querySelector("#days"),
    total = document.querySelector("#total"),
    smtotal = document.querySelector("#sm-total"),
    smdays = document.querySelector("#sm-days"),
    booking = document.querySelector("#book"),
    reservation = document.querySelector("#reservation"),
    smreserve = document.querySelector("#sm-reserve"),
    feedback_trigger = document.querySelector("#feedback_trigger"),
    feedback_overlay = document.querySelector("#feedback_overlay"),
    feedback_form = document.querySelector("#feedback_form");

if (document.querySelector("#ui-carousel")) Slider({
    root: document.querySelector("#ui-carousel"),
    prev: document.querySelector("#ui-prev"),
    next: document.querySelector("#ui-next"),
    opts: {
        drag: true,
        gaps: 0,
    }
})

tabs.forEach(t => {
    t.addEventListener("click", e => {
        e.preventDefault();
        activeTab(t);
        const targetId = t.getAttribute("href").substring(1);
        const targetElement = document.getElementById(targetId);
        const threshold = 60;
        const offsetPosition = targetElement.offsetTop - threshold;
        window.scrollTo({
            top: offsetPosition,
            behavior: "smooth"
        });
    });
});

function activeTab(tab) {
    tabs.forEach(t => {
        t.classList[tab === t ? "add" : "remove"]("active");
    });
}

function betweenDates(date1, date2) {
    const startDate = new Date(date1);
    const endDate = new Date(date2);
    const timeDifference = endDate - startDate;
    const millisecondsPerDay = 1000 * 60 * 60 * 24;
    const dayDifference = timeDifference / millisecondsPerDay;
    return dayDifference;
}

function ucWords(str) {
    const stringWithSpaces = str.replace(/-/g, " ").replace("pick up", "Pick-up").replace("drop off", "Drop-off");
    const words = stringWithSpaces.split(" ");
    const titleCasedString = words.map(word => {
        return word.charAt(0).toUpperCase() + word.slice(1).toLowerCase();
    }).join(" ");
    return titleCasedString;
}

function calcPrice() {
    const sourceElements = booking.elements;
    if (!sourceElements["from_date"].value.trim() || !sourceElements["to_date"].value.trim()) return;

    const nbrDays = Math.round(betweenDates(
        sourceElements["from_date"].value + " " + sourceElements["from_time"].value,
        sourceElements["to_date"].value + " " + sourceElements["to_time"].value,
    ));

    days.innerHTML = nbrDays;
    total.innerHTML = (nbrDays * price).toFixed(2);
    smtotal.innerHTML = (nbrDays * price).toFixed(2);
    smdays.innerHTML = Neo.Helper.trans("Per") + " " + nbrDays + " " + Neo.Helper.trans("Days");
}

function intersect() {
    const scrollPosition = window.scrollY || document.documentElement.scrollTop;
    let closestElement = null;
    let minDistance = Infinity;

    blocks.forEach(element => {
        const rect = element.getBoundingClientRect();
        const elementTop = rect.top + window.pageYOffset - 40;
        const distance = Math.abs(scrollPosition - elementTop);

        if (distance < minDistance) {
            minDistance = distance;
            closestElement = element;
        }
    });

    if (closestElement) {
        activeTab(document.querySelector(`[href="#${closestElement.id}"]`));
    }
}

function reserve(e) {
    e.preventDefault();
    const errors = [];
    const sourceElements = booking.elements;

    for (let i = 0; i < sourceElements.length; i++) {
        const sourceElement = sourceElements[i];
        if ("value" in sourceElement) {
            const error = document.querySelector(sourceElement.dataset.error);
            if (sourceElement.value.trim()) {
                sourceElement.classList.remove("outline", "outline-2",
                    "outline-red-400", "outline-offset-[-2px]");
                error && error.classList.add("hidden");
            } else {
                sourceElement.classList.add("outline", "outline-2", "outline-red-400",
                    "outline-offset-[-2px]");
                error && (error.innerHTML = Neo.Helper.trans(ucWords(sourceElement.name) + " Is Required"));
                error && error.classList.remove("hidden");
            }
            errors.push(!sourceElement.value.trim());
        }
    }

    if (sourceElements["from_date"].value.trim()) {
        const error = document.querySelector(sourceElements["from_date"].dataset.error);
        if (betweenDates(Neo.Helper.Str.moment(new Date().toDateString()), sourceElements[
                "from_date"].value) < 0) {
            sourceElements["from_date"].classList.add("outline", "outline-2", "outline-red-400",
                "outline-offset-[-2px]");
            error && (error.innerHTML = Neo.Helper.trans("Pick-up Date Must Be Today Or After"));
            error && error.classList.remove("hidden");
        } else {
            sourceElements["from_date"].classList.remove("outline", "outline-2", "outline-red-400",
                "outline-offset-[-2px]");
            error && error.classList.add("hidden");
        }
        errors.push(!sourceElements["from_date"].value.trim());
    }

    if (sourceElements["from_date"].value.trim() && sourceElements["to_date"].value.trim()) {
        const error = document.querySelector(sourceElements["from_date"].dataset.error);
        if (betweenDates(sourceElements["from_date"].value, sourceElements["to_date"].value) < 1) {
            sourceElements["to_date"].classList.add("outline", "outline-2", "outline-red-400",
                "outline-offset-[-2px]");
            error && (error.innerHTML = Neo.Helper.trans("Drop-off Date Must Be After Pick-up Date"));
            error && error.classList.remove("hidden");
        } else {
            sourceElements["to_date"].classList.remove("outline", "outline-2", "outline-red-400",
                "outline-offset-[-2px]");
            error && error.classList.add("hidden");
        }
        errors.push(!sourceElements["to_date"].value.trim());
    }

    if (!errors.includes(true)) booking.submit();
}

function feedback(e) {
    e.preventDefault();
    const errors = [];
    const sourceElements = feedback_form.elements;

    for (let i = 0; i < sourceElements.length; i++) {
        const sourceElement = sourceElements[i];
        if (sourceElement.type === "radio") continue;
        if ("value" in sourceElement) {
            const error = document.querySelector(sourceElement.dataset.error);
            if (sourceElement.value.trim()) {
                sourceElement.classList.remove("outline", "outline-2",
                    "outline-red-400", "outline-offset-[-2px]");
                error && error.classList.add("hidden");
            } else {
                sourceElement.classList.add("outline", "outline-2", "outline-red-400",
                    "outline-offset-[-2px]");
                error && (error.innerHTML = Neo.Helper.trans(ucWords(sourceElement.name) + " Is Required"));
                error && error.classList.remove("hidden");
            }
            errors.push(!sourceElement.value.trim());
        }
    }

    const error = document.querySelector(sourceElements['rate'][0].dataset.error);
    if ([...sourceElements['rate']].map(e => e.checked).find(e => e)) {
        document.querySelector("#rate-group").classList.remove("outline", "outline-2",
            "outline-red-400", "outline-offset-[-2px]", "p-1");
        error && error.classList.add("hidden");
    } else {
        document.querySelector("#rate-group").classList.add("outline", "outline-2",
            "outline-red-400", "outline-offset-[-2px]", "p-1");
        error && (error.innerHTML = Neo.Helper.trans(ucWords("Rate Is Required")));
        error && error.classList.remove("hidden");
    }
    errors.push(![...sourceElements['rate']].map(e => e.checked).find(e => e));

    if (!errors.includes(true)) feedback_form.submit();
}

(new IntersectionObserver((entries) => {
    entries.forEach(entry => {
        smreserve.classList[entry.isIntersecting ? "add" : "remove"]("translate-y-full");
    });
})).observe(reservation);

feedback_trigger.addEventListener("click", e => {
    feedback_overlay.show();
});

booking.addEventListener("change", calcPrice);
booking.addEventListener("input", calcPrice);
window.addEventListener("scroll", intersect);
booking.addEventListener("submit", reserve);
feedback_form.addEventListener("submit", feedback);
calcPrice();