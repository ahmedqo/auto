function empty() {
    return "N/A";
}

function tabs() {
    const tabs = [...$qall('[data-tabs]')].reduce((a, e) => ({...a, [+e.dataset.tabs]: e }), {}),
        view = [...$qall('[data-view]')].reduce((a, e) => ({...a, [+e.dataset.view]: e }), {}),
        next = $query("#next"),
        save = $query("#save"),
        atabs = Object.values(tabs),
        aview = Object.values(view);

    var cur = 1;

    function flip() {
        if (cur === atabs.length) {
            next.classList.add("hidden");
            save.classList.remove("hidden");
        } else {
            next.classList.remove("hidden");
            save.classList.add("hidden");
        }
    }

    function valid(fn, next) {
        if (next && next < cur) return fn();
        const fields = view[cur].querySelectorAll("[require]"),
            errors = [];
        fields.forEach(f => {
            if (String(f.value).trim()) f.classList.remove("outline", "outline-2", "-outline-offset-2", "outline-red-400");
            else f.classList.add("outline", "outline-2", "-outline-offset-2", "outline-red-400");
            errors.push(String(f.value).trim() ? true : false);
        });

        if (!errors.includes(false)) fn();
    }

    Object.entries(tabs).forEach(([i, tab]) => {
        tab.addEventListener("click", e => {
            valid(() => {
                atabs.forEach(t => t.classList.remove('active'));
                aview.forEach(v => {
                    v.classList.remove('grid');
                    v.classList.add('hidden');
                });
                tab.classList.add('active')
                view[i].classList.add('grid');
                view[i].classList.remove('hidden');
                cur = +i;
                flip();
            }, +i);
        });
    });

    next.addEventListener("click", e => {
        valid(() => {
            cur = cur + 1;
            atabs.forEach(t => t.classList.remove('active'));
            aview.forEach(v => {
                v.classList.remove('grid');
                v.classList.add('hidden');
            });
            tabs[cur].classList.add('active')
            view[cur].classList.add('grid');
            view[cur].classList.remove('hidden');
            flip();
        }, cur + 1);
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

async function getData(url, createLinks) {
    const req = await fetch(url);
    const res = await req.json();
    createLinks && createLinks(res.prev_cursor, res.next_cursor, (new URL(url)).searchParams.get("search"));
    return res.data;
}

function TableVisualizer(dataVisualizer, Type, Data) {
    var timer;
    const Links = document.createElement("div");
    Links.innerHTML = `<a id="prev" slot="end" aria-label="prev_page_link" class="block w-6 h-6 text-x-black outline-none relative isolate before:content-[''] before:rounded-x-thin before:absolute before:block before:w-[130%] before:h-[130%] before:-inset-[15%] before:-z-[1] before:!bg-opacity-40 hover:before:bg-x-shade focus:before:bg-x-shade focus-within:before:bg-x-shade"><svg class="block w-6 h-6 pointer-events-none" fill="currentcolor" viewBox="0 -960 960 960"><path d="M452-219 190-481l262-262 64 64-199 198 199 197-64 65Zm257 0L447-481l262-262 63 64-198 198 198 197-63 65Z" /></svg></a><a id="next" slot="end" aria-label="next_page_link" class="block w-6 h-6 text-x-black outline-none relative isolate before:content-[''] before:rounded-x-thin before:absolute before:block before:w-[130%] before:h-[130%] before:-inset-[15%] before:-z-[1] before:!bg-opacity-40 hover:before:bg-x-shade focus:before:bg-x-shade focus-within:before:bg-x-shade"><svg class="block w-6 h-6 pointer-events-none" fill="currentcolor" viewBox="0 -960 960 960"><path d="M388-481 190-679l64-64 262 262-262 262-64-65 198-197Zm257 0L447-679l63-64 262 262-262 262-63-65 198-197Z" /></svg></a>`;

    async function event(e) {
        e.preventDefault();
        dataVisualizer.loading = true;
        dataVisualizer.rows = await getData(e.target.href, createLinks);
        dataVisualizer.loading = false;
    }

    function createLinks(prev, next, str) {
        const search = "?search" + (str ? ("=" + str) : "");
        const preva = $query("#prev");
        const nexta = $query("#next");
        if (prev) {
            const href = Data.Search + search + "&cursor=" + prev;
            if (preva) preva.href = href
            else {
                const _preva = Links.querySelector("#prev").cloneNode(true);
                _preva.addEventListener("click", event);
                if (nexta) dataVisualizer.insertBefore(_preva, nexta);
                else dataVisualizer.insertAdjacentElement("afterstart", _preva);
                _preva.title = $trans("Prev");
                _preva.href = href;
            }
        } else {
            if (preva) {
                preva.removeEventListener("click", event);
                preva.remove();
            }
        }
        if (next) {
            const href = Data.Search + search + "&cursor=" + next;
            if (nexta) nexta.href = href
            else {
                const _nexta = Links.querySelector("#next").cloneNode(true);
                _nexta.addEventListener("click", event);
                dataVisualizer.insertAdjacentElement("afterstart", _nexta);
                _nexta.title = $trans("Next");
                _nexta.href = href;
            }
        } else {
            if (nexta) {
                nexta.removeEventListener("click", event);
                nexta.remove();
            }
        }
    }

    (async function() {
        dataVisualizer.loading = true;
        dataVisualizer.rows = await getData(Data.Search + window.location.search, createLinks);
        dataVisualizer.loading = false;
    })();

    dataVisualizer.cols = COLS[Type]({
        Currency: Data.Currency,
        Scene: Data.Scene,
        Print: Data.Print,
        Patch: Data.Patch,
        Clear: Data.Clear,
        Csrf: Data.Csrf,
    });

    var url = Data.Search;

    async function search(e) {
        if (timer) clearTimeout(timer);
        dataVisualizer.loading = true;
        dataVisualizer.rows = await new Promise((resolver, rejecter) => {
            timer = setTimeout(async() => {
                const data = await getData(url + (e ? ("?search=" +
                    encodeURIComponent(e.detail
                        .data)) : ""), createLinks);
                resolver(data);
            }, 2000);
        });
        dataVisualizer.loading = false;
    }

    var all = dataVisualizer.querySelector("#all");

    if (all) all.addEventListener("change", e => {
        url = e.target.active ? Data.Filter : Data.Search;
        search();
    });

    dataVisualizer.addEventListener("search", async e => {
        e.preventDefault();
        search(e);
    });
}

function VehicleInitializer() {
    const brand = $query("neo-select[name=brand]"),
        model = $query("neo-select[name=model]"),
        fuel = $query("neo-select[name=fuel]"),
        power = $query("neo-select[name=horsepower]"),
        price = $query("#tax"),
        type = $query("neo-select[name=registration_type]"),
        reg = $query(".reg"),
        ww = $query(".ww"),
        vehicle = $query(".vehicle"),
        wfield = ww.querySelectorAll(".field"),
        vfield = vehicle.querySelectorAll(".field");

    const cost = {
        gasoline: {
            'less than 8 cv': 300,
            'between 8 and 10 cv': 650,
            'between 11 and 14 cv': 3000,
            'grather than or equals to 15 cv': 8000
        },
        diesel: {
            'less than 8 cv': 700,
            'between 8 and 10 cv': 1500,
            'between 11 and 14 cv': 6000,
            'grather than or equals to 15 cv': 20000
        }
    }

    function change() {
        if (!fuel.value || !power.value) return;
        const group = cost[fuel.value];
        price.value = (group ? group[power.value] : 0) || 0;
    }

    fuel.addEventListener("change", change);
    power.addEventListener("change", change);

    brand.addEventListener("change", e => {
        model.disable = false;
        const str = '';

        Models[e.detail.data].forEach(e => {
            str += `<neo-select-item value="${e}">${$cap($trans(e))}</neo-select-item>`;
        });

        model.reset();
        model.innerHTML = str;
    });

    type.addEventListener("change", e => {
        reg.classList.remove("hidden");
        reg.classList.add("flex");
        if (e.detail.data === "WW") {
            ww.classList.remove("hidden");
            ww.classList.add("flex");
            vehicle.classList.add("hidden");
            vehicle.classList.remove("flex");

            wfield.forEach(f => f.setAttribute("require", ""));
            vfield.forEach(f => f.removeAttribute("require"));
        } else {
            vehicle.classList.remove("hidden");
            vehicle.classList.add("flex");
            ww.classList.add("hidden");
            ww.classList.remove("flex");

            vfield.forEach(f => f.setAttribute("require", ""));
            wfield.forEach(f => f.removeAttribute("require"));
        }
    });

    tabs();
}

function AlertInitializer({ Vehicle }) {
    const
        vehicle = $query("neo-autocomplete[name=vehicle]"),
        unit = $query("neo-select[name=unit]"),
        div = $query(".date"),
        date = div.querySelector("neo-datepicker[name=date]");

    function fill(auto, url) {
        var timer;
        auto.addEventListener("input", async(e) => {
            if (timer) clearTimeout(timer);
            auto.loading = true;
            const d = await new Promise((resolver, rejecter) => {
                timer = setTimeout(async() => {
                    const data = await getData(url + "?search=" +
                        encodeURIComponent(
                            auto.query.trim()));
                    auto.loading = false;
                    resolver(data);
                }, 250);
            });


            d = d.map(e => {
                return {...e, name: $cap(e.brand) + ' ' + $cap(e.model) + ' ' + e.year + ' (' + $cap(e.registration_number) + ")" }
            });

            auto.data = d;
        });

        auto.addEventListener("select", e => {
            e.target.querySelector("input").value = e.detail.data[e.target.setQuery];
        });
    }

    unit.addEventListener("change", e => {
        if (e.detail.data === 'mileage') {
            div.classList.add("hidden");
            div.classList.remove("flex");
            date.removeAttribute("require");
            date.reset();
        } else {
            div.classList.remove("hidden");
            div.classList.add("flex");
            date.setAttribute("require", "");
        }
    });

    fill(vehicle, Vehicle);
}

function ReservationInitializer({ Client, Vehicle, Agency, Mileage: $URL, Colors }) {
    const
        renter = $query("neo-select[name=renter]"),
        client = $query("neo-autocomplete[name=client]"),
        agency = $query("neo-autocomplete[name=agency]"),
        sclient = $query("neo-autocomplete[name=secondary_client]"),
        vehicle = $query("neo-autocomplete[name=vehicle]"),
        price = $query("neo-textbox[name=price]"),
        smileage = $query("neo-textbox[name=starting_mileage]"),
        rmileage = $query("neo-textbox[name=return_mileage]"),
        total = $query("neo-textbox[name=total]"),
        from_date = $query("neo-datepicker[name=from_date]"),
        from_time = $query("neo-timepicker[name=from_time]"),
        to_date = $query("neo-datepicker[name=to_date]"),
        to_time = $query("neo-timepicker[name=to_time]"),
        payment = $query("neo-textbox[name=payment]"),
        creance = $query("neo-textbox[name=creance]"),
        overlay = $query("neo-overlay"),
        list = $query("#list"),
        cost = $query("#cost"),
        json = $query("#json"),
        div = document.createElement("table"),
        data = JSON.parse(json.value);

    function fill(auto, url, merge) {
        var timer;
        auto.addEventListener("input", async(e) => {
            if (timer) clearTimeout(timer);
            auto.loading = true;
            var d = await new Promise((resolver, rejecter) => {
                timer = setTimeout(async() => {
                    const data = await getData(url + "?search=" +
                        encodeURIComponent(
                            auto.query.trim()));
                    auto.loading = false;
                    resolver(data);
                }, 250);
            });

            if (merge === "client") {
                d = d.map(e => {
                    return {...e, name: $cap(e.first_name) + ' ' + $cap(e.last_name) + (e.blacklist ? " (blacklisted)" : "") }
                })
            }

            if (merge === "vehicle") {
                d = d.map(e => {
                    return {...e, name: $cap(e.brand) + ' ' + $cap(e.model) + ' ' + e.year + ' (' + $cap(e.registration_number) + ")" }
                })
            }

            if (merge === "agency") {
                d = d.map(e => {
                    return {...e, name: $cap(e.name) }
                })
            }

            auto.data = d;
        });

        auto.addEventListener("select", e => {
            e.target.querySelector("input").value = e.detail.data[e.target.setQuery];
        });
    }

    function calc() {
        const $days = betweenDates(from_date.value + ' ' + from_time.value, to_date.value + ' ' + to_time.value),
            $price = parseFloat(String(price.value).replace(/,/g, '') || 0),
            $payment = data.reduce((a, e) => a + e, 0);

        total.value = $money($price * $days, 3);
        payment.value = $money($payment, 3);
        creance.value = $money(($price * $days) - $payment, 3);
    }

    function mile() {
        const $days = betweenDates(from_date.value + ' ' + from_time.value, to_date.value + ' ' + to_time.value),
            begin = parseFloat(smileage.value || 0);

        rmileage.value = begin + ($days * Mileage);
    }

    function row(value) {
        div.innerHTML = `<tr class="border-t border-t-x-shade"><td class="w-[200px] ps-8 px-4 py-2 text-lg text-x-black text-center">${$money(value, 3)} ${Currency}</td><td></td><td class="w-[80px] pe-8 px-4 py-2 text-base text-x-black text-center"><button class="block mx-auto px-2 py-1 bg-red-500 rounded-x-thin text-x-white outline-none hover:bg-red-400 focus:bg-red-400"><svg class="w-[1.2rem] h-[1.2rem] pointer-events-none" fill="currentColor" viewBox="0 -960 960 960"><path d="M267-74q-55.73 0-95.86-39.44Q131-152.88 131-210v-501H68v-136h268v-66h287v66h269v136h-63v501q0 57.12-39.44 96.56Q750.13-74 693-74H267Zm67-205h113v-363H334v363Zm180 0h113v-363H514v363Z" /></svg></button></td></tr>`;
        const tr = div.querySelector("tr");
        tr.querySelector("button").addEventListener("click", e => {
            e.preventDefault();
            data.splice([...list.children].indexOf(tr), 1);
            json.value = JSON.stringify(data);
            tr.remove();
            calc();
        });
        return tr;
    }

    payment.addEventListener("click", e => {
        overlay.show();
    });

    smileage.addEventListener("change", e => {
        mile()
    });

    cost.addEventListener("submit", e => {
        e.preventDefault();
        if (e.target.elements[0].value) {
            data.push(parseFloat(e.target.elements[0].value));
            list.insertAdjacentElement("beforeend", row(+e.target.elements[0].value));
            e.target.elements[0].value = "";
            json.value = JSON.stringify(data);
            calc();
        }
    });

    const adiv = agency.parentElement,
        cdiv = client.parentElement,
        scdiv = sclient.parentElement;

    renter.addEventListener("change", e => {
        if (e.detail.data === "agency") {
            agency.setAttribute('require', '');
            adiv.classList.add("flex");
            adiv.classList.remove("hidden");

            client.removeAttribute('require');
            cdiv.classList.remove("flex");
            cdiv.classList.add("hidden");
            scdiv.classList.add("hidden");
            scdiv.classList.remove("flex");
        } else {
            agency.removeAttribute('require');
            adiv.classList.remove("flex");
            adiv.classList.add("hidden");

            client.setAttribute('require', "");
            cdiv.classList.add("flex");
            cdiv.classList.remove("hidden");
            scdiv.classList.remove("hidden");
            scdiv.classList.add("flex");
        }
    });

    vehicle.addEventListener("select", async e => {
        price.value = e.detail.data.price;
        calc();

        const data = await getData($URL.replace('XXX', e.detail.data.id));
        smileage.value = data.mileage || e.detail.data.mileage;
        mile();
    });

    [from_date, from_time, to_date, to_time, price].forEach(el => {
        el.addEventListener("change", e => {
            calc();
            mile();
        })
    });

    if (data.length) {
        data.forEach((e, i) => {
            list.insertAdjacentElement("beforeend", row(+e));
        });
    }

    StateInitializer(Colors);
    fill(vehicle, Vehicle, "vehicle");
    fill(sclient, Client, "client");
    fill(client, Client, "client");
    fill(agency, Agency, 'agency');
    calc();
    tabs();
}

function paymentInitializer() {
    const
        total = $query("neo-textbox[name=total]"),
        payment = $query("neo-textbox[name=payment]"),
        creance = $query("neo-textbox[name=creance]"),
        overlay = $query("neo-overlay"),
        list = $query("#list"),
        cost = $query("#cost"),
        json = $query("#json"),
        div = document.createElement("table"),
        data = JSON.parse(json.value);

    function calc() {
        const $total = parseFloat(total.value.replace(/,/g, '')),
            $payment = data.reduce((a, e) => a + e, 0);
        payment.value = $money($payment, 3);
        creance.value = $money($total - $payment, 3);
    }

    function row(value) {
        div.innerHTML = `<tr class="border-t border-t-x-shade"><td class="w-[200px] ps-8 px-4 py-2 text-lg text-x-black text-center">${$money(value, 3)} ${Currency}</td><td></td><td class="w-[80px] pe-8 px-4 py-2 text-base text-x-black text-center"><button class="block mx-auto px-2 py-1 bg-red-500 rounded-x-thin text-x-white outline-none hover:bg-red-400 focus:bg-red-400"><svg class="w-[1.2rem] h-[1.2rem] pointer-events-none" fill="currentColor" viewBox="0 -960 960 960"><path d="M267-74q-55.73 0-95.86-39.44Q131-152.88 131-210v-501H68v-136h268v-66h287v66h269v136h-63v501q0 57.12-39.44 96.56Q750.13-74 693-74H267Zm67-205h113v-363H334v363Zm180 0h113v-363H514v363Z" /></svg></button></td></tr>`;
        const tr = div.querySelector("tr");
        tr.querySelector("button").addEventListener("click", e => {
            e.preventDefault();
            data.splice([...list.children].indexOf(tr), 1);
            json.value = JSON.stringify(data);
            tr.remove();
            calc();
        });
        return tr;
    }

    payment.addEventListener("click", e => {
        overlay.show();
    });

    cost.addEventListener("submit", e => {
        e.preventDefault();
        if (e.target.elements[0].value) {
            data.push(parseFloat(e.target.elements[0].value));
            list.insertAdjacentElement("beforeend", row(+e.target.elements[0].value));
            e.target.elements[0].value = "";
            json.value = JSON.stringify(data);
            calc();
        }
    });

    if (data.length) {
        data.forEach((e, i) => {
            list.insertAdjacentElement("beforeend", row(+e));
        });
    }
    calc();
}

function ChargeInitializer({ Search }) {
    const auto = $query("neo-autocomplete");
    var timer;
    auto.addEventListener("input", async(e) => {
        if (timer) clearTimeout(timer);
        auto.loading = true;
        const d = await new Promise((resolver, rejecter) => {
            timer = setTimeout(async() => {
                const data = await getData(Search + "?search=" +
                    encodeURIComponent(
                        auto.query.trim()));
                auto.loading = false;
                resolver(data);
            }, 250);
        });

        auto.data = d.map(e => {
            return {...e, name: $cap(e.brand) + ' ' + $cap(e.model) + ' ' + e.year + ' (' + $cap(e.registration_number) + ")" }
        })

        auto.addEventListener("select", e => {
            e.target.querySelector("input").value = e.detail.data[e.target.setQuery];
        });
    });
}

function BlackListInitializer({ Search }) {
    const auto = $query("neo-autocomplete");
    var timer;
    auto.addEventListener("input", async(e) => {
        if (timer) clearTimeout(timer);
        auto.loading = true;
        const data = await new Promise((resolver, rejecter) => {
            timer = setTimeout(async() => {
                const data = await getData(Search + "?search=" +
                    encodeURIComponent(
                        auto.query.trim()));
                auto.loading = false;
                resolver(data);
            }, 250);
        });

        auto.data = data.map(e => {
            return {...e, name: $cap(e.first_name) + ' ' + $cap(e.last_name) + (e.blacklist ? " (blacklisted)" : "") }
        });

        auto.addEventListener("select", e => {
            e.target.querySelector("input").value = e.detail.data[e.target.setQuery];
        });
    });
}

async function CoreInitializer({ Table, Pie, Line, Search, Data, Total, Charges }) {
    TableVisualizer(Table, "most", { Search });

    new Chart(Pie, {
        type: "doughnut",
        data: {
            labels: [$trans("Total"), $trans("Charges")],
            datasets: [{
                data: [Total, Charges],
                borderWidth: 1,
                backgroundColor: ["#22C55E", "#EC4899"],
                borderColor: ["#22C55E", "#EC4899"]
            }, ]
        },
        options: {
            responsive: true,
            cutout: '80%',
            plugins: {
                legend: {
                    display: false
                },
            },
        }
    });

    const data = await getData(Data);
    data['keys'] = data['keys'].map(e => $trans(e));

    new Chart(line, {
        type: "bar",
        data: {
            labels: data['keys'],
            datasets: [{
                data: data['payments'],
                order: 2,
                borderWidth: 2,
                backgroundColor: "#22C55E",
                borderColor: "#22C55E",
                label: $trans('Payments')
            }, {
                data: data['creances'],
                order: 2,
                borderWidth: 2,
                backgroundColor: "#EAB308",
                borderColor: "#EAB308",
                label: $trans('Creances')
            }, {
                data: data['charges'],
                borderWidth: 2,
                backgroundColor: "#EC4899",
                borderColor: "#EC4899",
                label: $trans('Charges')
            }, ]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    labels: {
                        fontColor: "#1D1D1D",
                        fontSize: 18
                    }
                },
            },
        }
    });

    line.parentElement.classList.remove("aspect-video");
    line.nextElementSibling.remove();

    $query("#printer").addEventListener("click", () => {
        $query("#chart-viewer").src = line.toDataURL();
        $query("neo-printer").print();
    });

    function parse(str) {
        if (!str) return '""';
        str = String(str).replace(/"/g, `""`);
        if (/[",\n]/.test(str)) {
            str = `"${str}"`;
        }
        return str;
    }

    function resize() {
        Pie.style.width = "100%";
        Pie.style.height = "100%";
        Line.style.width = "100%";
        Line.style.height = "100%";
    }

    const csv = [
        ["", ...data['keys']],
        [$trans("Payments"), ...data['payments']],
        [$trans("Creances"), ...data['creances']],
        [$trans("Charges"), ...data['charges']],
    ].map(e => e.map(c => parse(typeof c === "number" ? $money(c) : c)).join(',')).join("\n");
    $query("#download").href = URL.createObjectURL(new Blob([csv], {
        type: "text/csv",
    }));

    window.addEventListener("resize", resize);
    $query("#trigger").addEventListener("click", e => {
        setTimeout(() => resize(), 250);
    });
}

async function SceneInitializer({ Line, Search, Data }) {
    Search.forEach(([id, type, url, fil]) => {
        TableVisualizer($query(id), type, { Search: url, Filter: fil });
    });

    const data = await getData(Data);
    data['keys'] = data['keys'].map(e => $trans(e));

    new Chart(line, {
        type: "bar",
        data: {
            labels: data['keys'],
            datasets: [{
                data: data['payments'],
                order: 2,
                borderWidth: 2,
                backgroundColor: "#22C55E",
                borderColor: "#22C55E",
                label: $trans('Payments')
            }, {
                data: data['creances'],
                order: 2,
                borderWidth: 2,
                backgroundColor: "#EAB308",
                borderColor: "#EAB308",
                label: $trans('Creances')
            }, ...(data['charges'] ? [{
                data: data['charges'],
                borderWidth: 2,
                backgroundColor: "#EC4899",
                borderColor: "#EC4899",
                label: $trans('Charges')
            }] : []), ]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    labels: {
                        fontColor: "#1D1D1D",
                        fontSize: 18
                    }
                },
            },
        }
    });

    line.parentElement.classList.remove("aspect-video");
    line.nextElementSibling.remove();

    $query("#printer").addEventListener("click", () => {
        $query("#chart-viewer").src = line.toDataURL();
        $query("neo-printer").print();
    });

    function parse(str) {
        if (!str) return '""';
        str = String(str).replace(/"/g, `""`);
        if (/[",\n]/.test(str)) {
            str = `"${str}"`;
        }
        return str;
    }

    function resize() {
        Line.style.width = "100%";
        Line.style.height = "100%";
    }

    const csv = [
        ["", ...data['keys']],
        [$trans("Payments"), ...data['payments']],
        [$trans("Creances"), ...data['creances']],
        ...(data['charges'] ? [
            [$trans("Charges"), ...data['charges']]
        ] : []),
    ].map(e => e.map(c => parse(typeof c === "number" ? $money(c) : c)).join(',')).join("\n");
    $query("#download").href = URL.createObjectURL(new Blob([csv], {
        type: "text/csv",
    }));

    window.addEventListener("resize", resize);
    $query("#trigger").addEventListener("click", e => {
        setTimeout(() => resize(), 250);
    });
}

async function CalendarInitializer({ Calendar, Data }) {
    const data = await getData(Data);
    var _calendar = new FullCalendar.Calendar(Calendar, {
        headerToolbar: {
            "left": "title",
            "right": "today,dayGridMonth,timeGridWeek,timeGridDay prev,next"
        },
        initialView: "dayGridMonth",
        firstDay: 1,
        timeZone: 'Africa/Casablanc',
        locale: document.documentElement.lang,
        events: data,
        locale: Locale
    });
    _calendar.render();

    Calendar.nextElementSibling.remove();

    $query(".fc-prev-button").innerHTML = `<svg class="block w-6 h-6 pointer-events-none" fill="currentColor" viewBox="0 -960 960 960"><path d="M528-251 331-449q-7-6-10.5-14t-3.5-18q0-9 3.5-17.5T331-513l198-199q13-12 32-12t33 12q13 13 12.5 33T593-646L428-481l166 166q13 13 13 32t-13 32q-14 13-33.5 13T528-251Z"></path></svg>`;
    $query(".fc-next-button").innerHTML = `<svg class="block w-6 h-6 pointer-events-none" fill="currentColor" viewBox="0 -960 960 960"><path d="M344-251q-14-15-14-33.5t14-31.5l164-165-165-166q-14-12-13.5-32t14.5-33q13-14 31.5-13.5T407-712l199 199q6 6 10 14.5t4 17.5q0 10-4 18t-10 14L408-251q-13 13-32 12.5T344-251Z"></path></svg>`;
    $query(".tools").appendChild($query(".fc-header-toolbar"));

    window.addEventListener("resize", () => _calendar.render());
    $query("#trigger").addEventListener("click", e => {
        setTimeout(() => _calendar.render(), 250);
    });
}

function StateInitializer(colors) {
    const damage = $query("neo-select[name=damage]"),
        paths = $qall(".path"),
        parts = $query("#parts"),
        state = $query("#state"),
        add = $query("#add"),
        div = document.createElement("table"),
        data = JSON.parse(state.value);

    var active = [];

    function row(name, color) {
        div.innerHTML = `<tr class="border-t border-t-x-shade"><td class="ps-8 p-4 text-lg text-x-black"><div class="flex items-center gap-2 flex-wrap"><span class="block w-10 h-6 rounded-x-thin" style="background:${color}"></span><span class="block">${$cap($trans(name))}</span></div></td><td class="w-[80px] pe-8 p-4 text-base text-x-black text-center"><button class="block mx-auto px-2 py-1 bg-red-500 rounded-x-thin text-x-white outline-none hover:bg-red-400 focus:bg-red-400"><svg class="w-[1.2rem] h-[1.2rem] pointer-events-none" fill="currentColor" viewBox="0 -960 960 960"><path d="M267-74q-55.73 0-95.86-39.44Q131-152.88 131-210v-501H68v-136h268v-66h287v66h269v136h-63v501q0 57.12-39.44 96.56Q750.13-74 693-74H267Zm67-205h113v-363H334v363Zm180 0h113v-363H514v363Z" /></svg></button></td></tr>`;
        const tr = div.querySelector("tr");
        tr.querySelector("button").addEventListener("click", e => {
            e.preventDefault();
            const index = [...parts.children].indexOf(tr);
            data[index].parts.forEach(part => {
                const path = $query("#" + part);
                path.classList.remove("selected");
                path.style.fill = "";
            });
            data.splice(index, 1);
            state.value = JSON.stringify(data);
            tr.remove();
        });
        return tr;
    }

    add.addEventListener("click", e => {
        if (!active.length || !damage.value) return;
        const found = data.find(p => p.type === damage.value);
        const cur = found || {
            type: damage.value,
            parts: []
        };

        active.forEach(path => {
            path.classList.remove("active");
            path.classList.add("selected");
            path.style.fill = colors[damage.value];
            cur.parts.push(path.id);
        });

        data.push(cur);
        state.value = JSON.stringify(data);
        if (!found) parts
            .insertAdjacentElement("beforeend", row(damage.value, colors[damage.value]));
        damage.reset();
        active = [];
    });

    paths.forEach(path => {
        path.addEventListener("click", e => {
            if (path.classList.contains("selected")) return;
            if (path.classList.contains("active")) {
                active = active.filter(p => p.id !== path.id);
                path.classList.remove("active");
                path.style.fill = "";
            } else {
                path.classList.add("active");
                path.style.fill = "#458cfe80";
                active.push(path);
            }
        });
    });

    if (data.length) {
        data.forEach(obj => {
            obj.parts.forEach(part => {
                const path = $query("#" + part);
                path.classList.add("selected");
                path.style.fill = colors[obj.type];
            });
            parts
                .insertAdjacentElement("beforeend", row(obj.type, colors[obj.type]));
        });
    }
}

function StateScene({ Colors, Data }) {
    const img = $query("#img")
    trigger = $query("#printer"),
        printer = $query("neo-printer");

    trigger.addEventListener("click", () => printer.print());

    if (Data.length) {
        Data.forEach(obj => {
            obj.parts.forEach(part => {
                const paths = $qall("#" + part);
                paths.forEach(path => {
                    path.style.fill = Colors[obj.type];
                });
            });
        });
    }

    function print() {
        setTimeout(() => {
            printer.print();
        }, 250);
    }

    if (img.complete) print();
    img.addEventListener("load", print);
}

const form = $query("form[require]");

if (form) form.addEventListener("submit", e => {
    e.preventDefault();
    const fields = form.querySelectorAll("[require]"),
        errors = [];
    fields.forEach(f => {
        if (String(f.value).trim()) f.classList.remove("outline", "outline-2", "-outline-offset-2", "outline-red-400");
        else f.classList.add("outline", "outline-2", "-outline-offset-2", "outline-red-400");
        errors.push(String(f.value).trim() ? true : false);
    });

    if (!errors.includes(false)) {
        const tab = $query("[data-tabs]");
        tab && tab.classList.add("on");
        form.submit();
    }
});