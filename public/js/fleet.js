const seForm = document.querySelector("#se-form");
const smForm = document.querySelector("#sm-form");
const lgForm = document.querySelector("#lg-form");

document.querySelectorAll(".link").forEach(l => {
    l.addEventListener("click", e => {
        e.preventDefault();
        var str = [];
        Array.from(seForm.elements).forEach(el => {
            if (el.value && el.value.trim() && el.name) str.push(el.name + "=" + el.value);
        });
        location.href = e.target.href + "?" + str.join("&");
    });
});

function syncValues(sourceForm, targetForm) {
    const sourceElements = sourceForm.elements;
    const targetElements = targetForm.elements;

    for (let i = 0; i < sourceElements.length; i++) {
        const sourceElement = sourceElements[i];
        const targetElement = targetElements[i];
        if (targetElement) {
            if (sourceElement.type === "checkbox" || sourceElement.type === "radio") {
                targetElement.checked = sourceElement.checked;
            } else {
                targetElement.value = sourceElement.value;
            }
        }
    }
}

smForm.addEventListener("input", () => {
    syncValues(smForm, lgForm)
});

lgForm.addEventListener("input", () => {
    syncValues(lgForm, smForm)
});

smForm.addEventListener("change", () => {
    syncValues(smForm, lgForm)
});

lgForm.addEventListener("change", () => {
    syncValues(lgForm, smForm)
});

[seForm, smForm, lgForm].forEach(form => {
    form.addEventListener("submit", (e) => {
        e.preventDefault();
        const url = new URL(location.href);
        Array.from(form.elements).forEach(el => {
            if (!el.name) return;
            if (el.type === "checkbox" || el.type === "radio") {
                let set = [...new Set(url.searchParams.getAll(el.name))];
                url.searchParams.delete(el.name);
                if (el.checked) !set.includes(el.value) && set.push(el.value)
                else set = set.filter(e => e !== el.value);
                set.forEach(e => url.searchParams.append(el.name, e))
            } else {
                if (el.value.trim()) url.searchParams.set(el.name, el.value);
                else url.searchParams.delete(el.name);
            }
        });

        location.href = url.href;
    });
});