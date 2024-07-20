(function() {
    const Style = `:host {gap: .25rem;display: flex;margin: 0 auto;flex-wrap: wrap;overflow: hidden;width: max-content;border-radius: .25rem;}[part="btns"] {display: flex;border: unset;outline: unset;background: unset;align-items: center;padding: .25rem .5rem;border-radius: .20rem;text-decoration: unset;justify-content: center;color: {{ @Theme.colors("WHITE") }};background: red;}[part="btns"]:hover,[part="btns"]:focus,[part="btns"]:focus-within {cursor: pointer;color: {{ @Theme.colors("BLACK") }};}[part="svgs"] {width: 1rem;height: 1rem;display: block;pointer-events: none;}{$ if @props.scene $}[part="btns"][title="scene"] {background: {{ @Theme.colors("GRAY", 400) }};}[part="btns"][title="scene"]:hover,[part="btns"][title="scene"]:focus,[part="btns"][title="scene"]:focus-within {background: {{ @Theme.colors("GRAY", 400, 60) }};}{$ endif $}{$ if @props.print $}[part="btns"][title="print"] {background: {{ @Theme.colors("GREEN", 400) }};}[part="btns"][title="print"]:hover,[part="btns"][title="print"]:focus,[part="btns"][title="print"]:focus-within {background: {{ @Theme.colors("GREEN", 400, 60) }};}{$ endif $}{$ if @props.patch $}[part="btns"][title="patch"] {background: {{ @Theme.colors("YELLOW", 400) }};}[part="btns"][title="patch"]:hover,[part="btns"][title="patch"]:focus,[part="btns"][title="patch"]:focus-within {background: {{ @Theme.colors("YELLOW", 400, 60) }};}{$ endif $}{$ if @truty(@props.clear) && @truty(@props.csrf) $}[part="btns"][title="clear"] {background: {{ @Theme.colors("RED", 400) }};}[part="btns"][title="clear"]:hover,[part="btns"][title="clear"]:focus,[part="btns"][title="clear"]:focus-within {background: {{ @Theme.colors("RED", 400, 60) }};}{$ endif $}`;

    const Template = `{$ if @props.scene $}<a title="scene" href="{{ @props.scene.replace('XXX', @props.target) }}" part="btns"><svg part="svgs" fill="currentcolor" viewBox="0 -960 960 960"><path d="M99-272q-19.325 0-32.662-13.337Q53-298.675 53-318v-319q0-20.3 13.338-33.15Q79.675-683 99-683h73q18.9 0 31.95 12.85T217-637v319q0 19.325-13.05 32.663Q190.9-272 172-272H99Zm224 96q-20.3 0-33.15-13.05Q277-202.1 277-221v-513q0-19.325 12.85-32.662Q302.7-780 323-780h314q20.3 0 33.15 13.338Q683-753.325 683-734v513q0 18.9-12.85 31.95T637-176H323Zm465-96q-18.9 0-31.95-13.337Q743-298.675 743-318v-319q0-20.3 13.05-33.15Q769.1-683 788-683h73q19.325 0 33.162 12.85Q908-657.3 908-637v319q0 19.325-13.838 32.663Q880.325-272 861-272h-73Z" /></svg></a>{$ endif $}{$ if @props.print $}<a title="print" href="{{ @props.print.replace('XXX', @props.target) }}" part="btns"><svg part="svgs" fill="currentcolor" viewBox="0 -960 960 960"><path d="M741-701H220v-160h521v160Zm-17 236q18 0 29.5-10.812Q765-486.625 765-504.5q0-17.5-11.375-29.5T724.5-546q-18.5 0-29.5 12.062-11 12.063-11 28.938 0 18 11 29t29 11Zm-75 292v-139H311v139h338Zm92 86H220v-193H60v-264q0-53.65 36.417-91.325Q132.833-673 186-673h588q54.25 0 90.625 37.675T901-544v264H741v193Z" /></svg></a>{$ endif $}{$ if @props.patch $}<a title="patch" href="{{ @props.patch.replace('XXX', @props.target) }}" part="btns"><svg part="svgs" fill="currentcolor" viewBox="0 -960 960 960"><path d="M170-103q-32 7-53-14.5T103-170l39-188 216 216-188 39Zm235-78L181-405l435-435q27-27 64.5-27t63.5 27l96 96q27 26 27 63.5T840-616L405-181Z" /></svg></a>{$ endif $}{$ if @truty(@props.clear) && @truty(@props.csrf) $}<form action="{{ @props.clear.replace('XXX', @props.target) }}" method="POST"><input type="hidden" name="_token" value="{{ @props.csrf }}" autocomplete="off" /><input type="hidden" name="_method" value="delete" /><button type="submit" title="clear" part="btns"><svg part="svgs" fill="currentcolor" viewBox="0 -960 960 960"><path d="M253-99q-36.462 0-64.231-26.775Q161-152.55 161-190v-552h-11q-18.75 0-31.375-12.86Q106-767.719 106-787.36 106-807 118.613-820q12.612-13 31.387-13h182q0-20 13.125-33.5T378-880h204q19.625 0 33.312 13.75Q629-852.5 629-833h179.921q20.279 0 33.179 13.375 12.9 13.376 12.9 32.116 0 20.141-12.9 32.825Q829.2-742 809-742h-11v552q0 37.45-27.069 64.225Q743.863-99 706-99H253Zm104-205q0 14.1 11.051 25.05 11.051 10.95 25.3 10.95t25.949-10.95Q431-289.9 431-304v-324q0-14.525-11.843-26.262Q407.313-666 392.632-666q-14.257 0-24.944 11.738Q357-642.525 357-628v324Zm173 0q0 14.1 11.551 25.05 11.551 10.95 25.8 10.95t25.949-10.95Q605-289.9 605-304v-324q0-14.525-11.545-26.262Q581.91-666 566.93-666q-14.555 0-25.742 11.738Q530-642.525 530-628v324Z" /></svg></button></form>{$ endif $}`;

    Neo.Component({
        tag: "action-tools",
        tpl: Template,
        css: Style
    })({
        props: {
            "csrf": null,
            "scene": null,
            "print": null,
            "patch": null,
            "clear": null,
            "target": null
        },
        cycle: {
            mounted() {
                if (this.hasAttribute("csrf")) {
                    this.props.csrf = this.getAttribute("csrf");
                    this.removeAttribute("csrf");
                }

                if (this.hasAttribute("target")) {
                    this.props.target = this.getAttribute("target");
                    this.removeAttribute("target");
                }

                if (this.hasAttribute("scene")) {
                    this.props.scene = this.getAttribute("scene");
                    this.removeAttribute("scene");
                }

                if (this.hasAttribute("print")) {
                    this.props.print = this.getAttribute("print");
                    this.removeAttribute("print");
                }

                if (this.hasAttribute("patch")) {
                    this.props.patch = this.getAttribute("patch");
                    this.removeAttribute("patch");
                }

                if (this.hasAttribute("clear")) {
                    this.props.clear = this.getAttribute("clear");
                    this.removeAttribute("clear");
                }
            }
        }
    }).define();
})();

const Locale = document.documentElement.lang,
    BasePath = window.location.origin + "/storage/IMAGES/",
    Background = "rgb(" + getComputedStyle(document.documentElement)
    .getPropertyValue("--prime") + ")",
    Color = "rgb(" + getComputedStyle(document.documentElement)
    .getPropertyValue("--white") + ")",
    Currency = document.querySelector("[name=currency]").content,
    COLS = {
        most: () => [{
            name: "image",
            text: Neo.Helper.trans('Image'),
            headStyle: { width: 20, textAlign: "center" },
            bodyStyle: { width: 20, textAlign: "center" },
            headPdfStyle: function() {
                return {...this.headStyle, background: Background, color: Color };
            },
            bodyPdfStyle: function() {
                return this.bodyStyle;
            },
            bodyRender: (row) => `<img part="image" style="margin:auto;display:block;width:4rem;aspect-ratio:1/1;object-fit:contain;object-position:center;background:rgb(209 209 209);" src="${BasePath + row.storage}" />`,
            bodyPdfRender: function(row) {
                return this.bodyRender(row);
            },
            bodyCsvRender: function(row) {
                return BasePath + row.image.storage;
            },
        }, {
            name: "name",
            text: Neo.Helper.trans('Name'),
            headPdfStyle: {
                background: Background,
                color: Color
            },
            bodyRender: (row) => Neo.Helper.Str.capitalize(row.name),
            bodyPdfRender: function(row) {
                return this.bodyRender(row);
            },
            bodyCsvRender: function(row) {
                return this.bodyRender(row);
            },
        }, {
            name: "total",
            text: Neo.Helper.trans("Total") + " (" + Currency + ")",
            headStyle: { width: 120, textAlign: "center", },
            bodyStyle: { width: 120, textAlign: "center", },
            headPdfStyle: function() {
                return {...this.headStyle, background: Background, color: Color };
            },
            bodyPdfStyle: function() {
                return this.bodyStyle;
            },
            bodyRender: (row) => Neo.Helper.Str.money(row.total, 3),
            bodyPdfRender: function(row) {
                return this.bodyRender(row);
            },
        }, {
            name: "period",
            text: Neo.Helper.trans("Period"),
            headStyle: { width: 100, textAlign: "center", },
            bodyStyle: { width: 100, textAlign: "center", },
            headPdfStyle: function() {
                return {...this.headStyle, background: Background, color: Color };
            },
            bodyPdfStyle: function() {
                return this.bodyStyle;
            },
            bodyRender: (row) => row.period + " " + Neo.Helper.trans("Days"),
            bodyPdfRender: function(row) {
                return this.bodyRender(row);
            },
        }],
        users: ({
            Csrf,
            Patch,
            Clear
        }) => [{
            name: "first_name",
            text: Neo.Helper.trans("First Name"),
            headPdfStyle: {
                background: Background,
                color: Color
            },
            bodyRender: (row) => Neo.Helper.Str.capitalize(row.first_name),
            bodyPdfRender: function(row) {
                return this.bodyRender(row);
            },
            bodyCsvRender: function(row) {
                return this.bodyRender(row);
            },
        }, {
            name: "last_name",
            text: Neo.Helper.trans("Last Name"),
            headPdfStyle: {
                background: Background,
                color: Color
            },
            bodyRender: (row) => Neo.Helper.Str.capitalize(row.last_name),
            bodyPdfRender: function(row) {
                return this.bodyRender(row);
            },
            bodyCsvRender: function(row) {
                return this.bodyRender(row);
            },
        }, {
            name: "gender",
            text: Neo.Helper.trans("Gender"),
            visible: false,
            headStyle: { textAlign: "center" },
            bodyStyle: { textAlign: "center" },
            headPdfStyle: function() {
                return {...this.headStyle, background: Background, color: Color };
            },
            bodyRender: (row) => row.gender ? Neo.Helper.Str.capitalize(Neo.Helper.trans(row.gender)) : empty(),
            bodyPdfRender: function(row) {
                return this.bodyRender(row);
            },
            bodyCsvRender: function(row) {
                return this.bodyRender(row);
            },
        }, {
            name: "birth_date",
            text: Neo.Helper.trans("Birth Date"),
            visible: false,
            headPdfStyle: {
                background: Background,
                color: Color
            },
            bodyRender: (row) => row.birth_date ? row.birth_date : empty(),
            bodyPdfRender: function(row) {
                return this.bodyRender(row);
            },
            bodyCsvRender: function(row) {
                return this.bodyRender(row);
            },
        }, {
            name: "email",
            text: Neo.Helper.trans("Email"),
            headPdfStyle: {
                background: Background,
                color: Color
            },
        }, {
            name: "phone",
            text: Neo.Helper.trans("Phone"),
            headPdfStyle: {
                background: Background,
                color: Color
            },
        }, {
            name: "address",
            text: Neo.Helper.trans("Address"),
            visible: false,
            headPdfStyle: {
                background: Background,
                color: Color
            },
            bodyRender: (row) => row.address ? Neo.Helper.Str.capitalize(row.address) : empty(),
            bodyPdfRender: function(row) {
                return this.bodyRender(row);
            },
            bodyCsvRender: function(row) {
                return this.bodyRender(row);
            },
        }, {
            name: "action",
            text: Neo.Helper.trans("Actions"),
            headStyle: { width: 20, textAlign: "center" },
            bodyStyle: { width: 20, textAlign: "center" },
            bodyRender: (row) => {
                return `<action-tools target="${row.id}"csrf="${Csrf}"patch="${Patch}"clear="${Clear}"></action-tools>`;
            },
            headPdfStyle: function() {
                return {...this.headStyle, background: Background, color: Color };
            },
            bodyPdfStyle: function() {
                return this.bodyStyle;
            },
            bodyPdfRender: () => empty(),
            bodyCsvRender: () => empty(),
        }],
        clients: ({
            Csrf,
            Patch,
            Scene,
            Clear
        }) => [{
            text: Neo.Helper.trans("Full Name"),
            headPdfStyle: {
                background: Background,
                color: Color
            },
            bodyRender: (row) => Neo.Helper.Str.capitalize(row.first_name) + ' ' + Neo.Helper.Str.capitalize(row.last_name),
            bodyPdfRender: function(row) {
                return this.bodyRender(row);
            },
            bodyCsvRender: function(row) {
                return this.bodyRender(row);
            },
        }, {
            name: "phone",
            text: Neo.Helper.trans("Phone"),
            headPdfStyle: {
                background: Background,
                color: Color
            },
        }, {
            name: "nationality",
            text: Neo.Helper.trans("Nationality"),
            headPdfStyle: {
                background: Background,
                color: Color
            },
            bodyRender: (row) => row.nationality ? Neo.Helper.Str.capitalize(Neo.Helper.trans(row.nationality)) : empty(),
            bodyPdfRender: function(row) {
                return this.bodyRender(row);
            },
            bodyCsvRender: function(row) {
                return this.bodyRender(row);
            },
        }, {
            name: "identity",
            text: Neo.Helper.trans("Identity"),
            headStyle: { textAlign: "center" },
            bodyStyle: { textAlign: "center" },
            headPdfStyle: function() {
                return {...this.headStyle, background: Background, color: Color };
            },
        }, {
            name: "identity_type",
            text: Neo.Helper.trans("Identity Type"),
            headStyle: { textAlign: "center" },
            bodyStyle: { textAlign: "center" },
            headPdfStyle: function() {
                return {...this.headStyle, background: Background, color: Color };
            },
            bodyRender: (row) => row.identity_type ? Neo.Helper.Str.capitalize(Neo.Helper.trans(row.identity_type)) : empty(),
            bodyPdfRender: function(row) {
                return this.bodyRender(row);
            },
            bodyCsvRender: function(row) {
                return this.bodyRender(row);
            },
        }, {
            name: "license_number",
            text: Neo.Helper.trans("License Number"),
            headStyle: { textAlign: "center" },
            bodyStyle: { textAlign: "center" },
            headPdfStyle: function() {
                return {...this.headStyle, background: Background, color: Color };
            },
        }, {
            name: "blacklist",
            text: Neo.Helper.trans("BlackList"),
            headStyle: { width: 20, textAlign: "center" },
            bodyStyle: { width: 20, textAlign: "center" },
            headPdfStyle: function() {
                return {...this.headStyle, background: Background, color: Color };
            },
            bodyPdfStyle: function() {
                return this.bodyStyle;
            },
            bodyRender: (row) => `<span style="width:100%;height:1rem;display:block;border-radius:9999px;background:${row.blacklist ? "#F43F5E" : "#22C55E"}"></span>`,
            bodyPdfRender: function(row) {
                return this.bodyRender(row);
            },
            bodyCsvRender: (row) => Neo.Helper.trans(row.blacklist ? "True" : "False")
        }, {
            name: "gender",
            text: Neo.Helper.trans("Gender"),
            visible: false,
            headStyle: { textAlign: "center" },
            bodyStyle: { textAlign: "center" },
            headPdfStyle: function() {
                return {...this.headStyle, background: Background, color: Color };
            },
            bodyRender: (row) => row.gender ? Neo.Helper.Str.capitalize(Neo.Helper.trans(row.gender)) : empty(),
            bodyPdfRender: function(row) {
                return this.bodyRender(row);
            },
            bodyCsvRender: function(row) {
                return this.bodyRender(row);
            },
        }, {
            name: "birth_date",
            text: Neo.Helper.trans("Birth Date"),
            visible: false,
            headPdfStyle: {
                background: Background,
                color: Color
            },
            bodyRender: (row) => row.birth_date ? row.birth_date : empty(),
            bodyPdfRender: function(row) {
                return this.bodyRender(row);
            },
            bodyCsvRender: function(row) {
                return this.bodyRender(row);
            },
        }, {
            name: "email",
            text: Neo.Helper.trans("Email"),
            visible: false,
            headPdfStyle: {
                background: Background,
                color: Color
            },
            bodyRender: (row) => row.email ? Neo.Helper.Str.capitalize(row.email) : empty(),
            bodyPdfRender: function(row) {
                return this.bodyRender(row);
            },
            bodyCsvRender: function(row) {
                return this.bodyRender(row);
            },
        }, {
            name: "address",
            text: Neo.Helper.trans("Address"),
            visible: false,
            headPdfStyle: {
                background: Background,
                color: Color
            },
            bodyRender: (row) => row.address ? Neo.Helper.Str.capitalize(row.address) : empty(),
            bodyPdfRender: function(row) {
                return this.bodyRender(row);
            },
            bodyCsvRender: function(row) {
                return this.bodyRender(row);
            },
        }, {
            name: "action",
            text: Neo.Helper.trans("Actions"),
            headStyle: { width: 20, textAlign: "center" },
            bodyStyle: { width: 20, textAlign: "center" },
            bodyRender: (row) => {
                return `<action-tools target="${row.id}"csrf="${Csrf}"patch="${Patch}"scene="${Scene}"clear="${Clear}"></action-tools>`;
            },
            headPdfStyle: function() {
                return {...this.headStyle, background: Background, color: Color };
            },
            bodyPdfStyle: function() {
                return this.bodyStyle;
            },
            bodyPdfRender: () => empty(),
            bodyCsvRender: () => empty(),
        }],
        client_reservation: () => [{
            name: "vehicle",
            text: Neo.Helper.trans("Vehicle"),
            headPdfStyle: {
                background: Background,
                color: Color
            },
            bodyRender: (row) => row.vehicle ? Neo.Helper.Str.capitalize(row.vehicle.name) : empty(),
            bodyPdfRender: function(row) {
                return this.bodyRender(row);
            },
            bodyCsvRender: function(row) {
                return this.bodyRender(row);
            },
        }, {
            name: "from",
            text: Neo.Helper.trans("From"),
            headPdfStyle: {
                background: Background,
                color: Color
            },
        }, {
            name: "pick_up",
            text: Neo.Helper.trans("Pick-up Location"),
            headPdfStyle: {
                background: Background,
                color: Color
            },
            visible: false,
            bodyRender: (row) => row.pick_up ? Neo.Helper.Str.capitalize(row.pick_up) : empty(),
            bodyPdfRender: function(row) {
                return this.bodyRender(row);
            },
            bodyCsvRender: function(row) {
                return this.bodyRender(row);
            },
        }, {
            name: "to",
            text: Neo.Helper.trans("To"),
            headPdfStyle: {
                background: Background,
                color: Color
            },
        }, {
            name: "drop_off",
            text: Neo.Helper.trans("Drop-off Location"),
            headPdfStyle: {
                background: Background,
                color: Color
            },
            visible: false,
            bodyRender: (row) => row.drop_off ? Neo.Helper.Str.capitalize(row.drop_off) : empty(),
            bodyPdfRender: function(row) {
                return this.bodyRender(row);
            },
            bodyCsvRender: function(row) {
                return this.bodyRender(row);
            },
        }, {
            name: "period",
            text: Neo.Helper.trans("Period"),
            headStyle: { width: 100, textAlign: "center", },
            bodyStyle: { width: 100, textAlign: "center", },
            headPdfStyle: function() {
                return {...this.headStyle, background: Background, color: Color };
            },
            bodyPdfStyle: function() {
                return this.bodyStyle;
            },
            bodyRender: (row) => row.period + " " + Neo.Helper.trans("Days"),
            bodyPdfRender: function(row) {
                return this.bodyRender(row);
            },
        }, {
            name: "price",
            text: Neo.Helper.trans("Price") + " (" + Currency + ")",
            headStyle: { width: 120, textAlign: "center", },
            bodyStyle: { width: 120, textAlign: "center", },
            headPdfStyle: function() {
                return {...this.headStyle, background: Background, color: Color };
            },
            bodyPdfStyle: function() {
                return this.bodyStyle;
            },
            bodyRender: (row) => Neo.Helper.Str.money(row.price, 3),
            bodyPdfRender: function(row) {
                return this.bodyRender(row);
            },
        }, {
            name: "total",
            text: Neo.Helper.trans("Total") + " (" + Currency + ")",
            headStyle: { width: 120, textAlign: "center", },
            bodyStyle: { width: 120, textAlign: "center", },
            headPdfStyle: function() {
                return {...this.headStyle, background: Background, color: Color };
            },
            bodyPdfStyle: function() {
                return this.bodyStyle;
            },
            bodyRender: (row) => Neo.Helper.Str.money(row.total, 3),
            bodyPdfRender: function(row) {
                return this.bodyRender(row);
            },
        }, {
            name: "payment",
            text: Neo.Helper.trans("Payment") + " (" + Currency + ")",
            headStyle: { width: 160, textAlign: "center", },
            bodyStyle: { width: 160, textAlign: "center", },
            headPdfStyle: function() {
                return {...this.headStyle, background: Background, color: Color };
            },
            bodyPdfStyle: function() {
                return this.bodyStyle;
            },
            bodyRender: (row) => Neo.Helper.Str.money(JSON.parse(row.payment).reduce((a, e) => a + e, 0), 3),
            bodyPdfRender: function(row) {
                return this.bodyRender(row);
            },
        }, {
            name: "creance",
            text: Neo.Helper.trans("Creance") + " (" + Currency + ")",
            headStyle: { width: 160, textAlign: "center", },
            bodyStyle: { width: 160, textAlign: "center", },
            headPdfStyle: function() {
                return {...this.headStyle, background: Background, color: Color };
            },
            bodyPdfStyle: function() {
                return this.bodyStyle;
            },
            bodyRender: (row) => Neo.Helper.Str.money(row.total - JSON.parse(row.payment).reduce((a, e) => a + e, 0), 3),
            bodyPdfRender: function(row) {
                return this.bodyRender(row);
            },
        }, {
            name: "status",
            text: Neo.Helper.trans("Status"),
            headStyle: { width: 100, textAlign: "center", },
            bodyStyle: { width: 100, textAlign: "center", },
            headPdfStyle: function() {
                return {...this.headStyle, background: Background, color: Color };
            },
            bodyPdfStyle: function() {
                return this.bodyStyle;
            },
            bodyRender: (row) => Neo.Helper.Str.capitalize(Neo.Helper.trans(row.status)),
            bodyPdfRender: function(row) {
                return this.bodyRender(row);
            },
        }, {
            name: "insurance",
            text: Neo.Helper.trans('Insurance'),
            headStyle: {
                maxWidth: 500,
            },
            visible: false,
            bodyStyle: function() {
                return this.headStyle;
            },
            headPdfStyle: function() {
                return {
                    ...this.headStyle,
                    background: Background,
                    color: Color
                }
            },
            bodyRender: (row) => row.insurance ? Neo.Helper.Str.capitalize(row.insurance) : empty(),
            bodyPdfRender: function(row) {
                return this.bodyRender(row);
            },
            bodyCsvRender: function(row) {
                return this.bodyRender(row);
            },
        }],
        blacklist: ({
            Csrf,
            Patch,
            Clear
        }) => [{
            name: "client",
            text: Neo.Helper.trans("Client"),
            headPdfStyle: {
                background: Background,
                color: Color
            },
            bodyRender: (row) => row.client ? Neo.Helper.Str.capitalize(row.client.first_name) + ' ' + Neo.Helper.Str.capitalize(row.client.last_name) : empty(),
            bodyPdfRender: function(row) {
                return this.bodyRender(row);
            },
            bodyCsvRender: function(row) {
                return this.bodyRender(row);
            },
        }, {
            name: "details",
            text: Neo.Helper.trans('Details'),
            headStyle: {
                maxWidth: 500,
            },
            bodyStyle: function() {
                return this.headStyle;
            },
            headPdfStyle: function() {
                return {
                    ...this.headStyle,
                    background: Background,
                    color: Color
                }
            },
            bodyRender: (row) => row.details ? Neo.Helper.Str.capitalize(row.details) : empty(),
            bodyPdfRender: function(row) {
                return this.bodyRender(row);
            },
            bodyCsvRender: function(row) {
                return this.bodyRender(row);
            },
        }, {
            name: "action",
            text: Neo.Helper.trans("Actions"),
            headStyle: { width: 20, textAlign: "center" },
            bodyStyle: { width: 20, textAlign: "center" },
            bodyRender: (row) => {
                return `<action-tools target="${row.id}"csrf="${Csrf}"patch="${Patch}"clear="${Clear}"></action-tools>`;
            },
            headPdfStyle: function() {
                return {...this.headStyle, background: Background, color: Color };
            },
            bodyPdfStyle: function() {
                return this.bodyStyle;
            },
            bodyPdfRender: () => empty(),
            bodyCsvRender: () => empty(),
        }],
        vehicles: ({
            Csrf,
            Patch,
            Scene,
            Clear
        }) => [{
            name: "image",
            text: Neo.Helper.trans('Image'),
            headStyle: { width: 20, textAlign: "center" },
            bodyStyle: { width: 20, textAlign: "center" },
            headPdfStyle: function() {
                return {...this.headStyle, background: Background, color: Color };
            },
            bodyPdfStyle: function() {
                return this.bodyStyle;
            },
            bodyRender: (row) => `<img part="image" style="margin:auto;display:block;width:4rem;aspect-ratio:1/1;object-fit:contain;object-position:center;background:rgb(209 209 209);" src="${BasePath + row.images[0].storage}" />`,
            bodyPdfRender: function(row) {
                return this.bodyRender(row);
            },
            bodyCsvRender: function(row) {
                return BasePath + row.image.storage;
            },
        }, {
            name: "name",
            text: Neo.Helper.trans('Name'),
            headPdfStyle: {
                background: Background,
                color: Color
            },
            bodyRender: (row) => Neo.Helper.Str.capitalize(row.name),
            bodyPdfRender: function(row) {
                return this.bodyRender(row);
            },
            bodyCsvRender: function(row) {
                return this.bodyRender(row);
            },
        }, {
            name: "price",
            text: Neo.Helper.trans("Price") + " (" + Currency + ")",
            headStyle: { width: 120, textAlign: "center", },
            bodyStyle: { width: 120, textAlign: "center", },
            headPdfStyle: function() {
                return {...this.headStyle, background: Background, color: Color };
            },
            bodyPdfStyle: function() {
                return this.bodyStyle;
            },
            bodyRender: (row) => Neo.Helper.Str.money(row.price, 3),
            bodyPdfRender: function(row) {
                return this.bodyRender(row);
            },
        }, {
            name: "transmission",
            text: Neo.Helper.trans("Transmission"),
            headStyle: { width: 100, textAlign: "center", },
            bodyStyle: { width: 100, textAlign: "center", },
            headPdfStyle: function() {
                return {...this.headStyle, background: Background, color: Color };
            },
            bodyPdfStyle: function() {
                return this.bodyStyle;
            },
            bodyRender: (row) => Neo.Helper.trans(Neo.Helper.Str.capitalize(row.transmission)),
            bodyPdfRender: function(row) {
                return this.bodyRender(row);
            },
        }, {
            name: "fuel",
            text: Neo.Helper.trans("Fuel"),
            headStyle: { width: 100, textAlign: "center", },
            bodyStyle: { width: 100, textAlign: "center", },
            headPdfStyle: function() {
                return {...this.headStyle, background: Background, color: Color };
            },
            bodyPdfStyle: function() {
                return this.bodyStyle;
            },
            bodyRender: (row) => Neo.Helper.trans(Neo.Helper.Str.capitalize(row.fuel)),
            bodyPdfRender: function(row) {
                return this.bodyRender(row);
            },
        }, {
            name: "passengers",
            text: Neo.Helper.trans("Passengers"),
            visible: false,
            headStyle: { width: 100, textAlign: "center", },
            bodyStyle: { width: 100, textAlign: "center", },
            headPdfStyle: function() {
                return {...this.headStyle, background: Background, color: Color };
            },
            bodyPdfStyle: function() {
                return this.bodyStyle;
            },
        }, {
            name: "milage",
            text: Neo.Helper.trans("Milage") + " (" + Neo.Helper.trans('Km') + ")",
            headStyle: { width: 120, textAlign: "center", },
            bodyStyle: { width: 120, textAlign: "center", },
            headPdfStyle: function() {
                return {...this.headStyle, background: Background, color: Color };
            },
            bodyPdfStyle: function() {
                return this.bodyStyle;
            },
        }, {
            name: "doors",
            text: Neo.Helper.trans("Doors"),
            visible: false,
            headStyle: { width: 100, textAlign: "center", },
            bodyStyle: { width: 100, textAlign: "center", },
            headPdfStyle: function() {
                return {...this.headStyle, background: Background, color: Color };
            },
            bodyPdfStyle: function() {
                return this.bodyStyle;
            },
        }, {
            name: "cargo",
            text: Neo.Helper.trans("Cargo"),
            visible: false,
            headStyle: { width: 100, textAlign: "center", },
            bodyStyle: { width: 100, textAlign: "center", },
            headPdfStyle: function() {
                return {...this.headStyle, background: Background, color: Color };
            },
            bodyPdfStyle: function() {
                return this.bodyStyle;
            },
        }, {
            name: "details",
            text: Neo.Helper.trans('Details'),
            visible: false,
            headPdfStyle: {
                background: Background,
                color: Color
            },
            bodyRender: (row) => row.details ? Neo.Helper.Str.capitalize(row.details) : empty(),
            bodyPdfRender: function(row) {
                return this.bodyRender(row);
            },
            bodyCsvRender: function(row) {
                return this.bodyRender(row);
            },
        }, {
            name: "action",
            text: Neo.Helper.trans("Actions"),
            headStyle: { width: 20, textAlign: "center" },
            bodyStyle: { width: 20, textAlign: "center" },
            bodyRender: (row) => {
                return `<action-tools target="${row.id}"csrf="${Csrf}"patch="${Patch}"scene="${Scene}"clear="${Clear}"></action-tools>`;
            },
            headPdfStyle: function() {
                return {...this.headStyle, background: Background, color: Color };
            },
            bodyPdfStyle: function() {
                return this.bodyStyle;
            },
            bodyPdfRender: () => empty(),
            bodyCsvRender: () => empty(),
        }],
        vehicle_reservation: () => [{
            name: "client",
            text: Neo.Helper.trans("Client"),
            headPdfStyle: {
                background: Background,
                color: Color
            },
            bodyRender: (row) => row.client ? Neo.Helper.Str.capitalize(row.client.first_name) + ' ' + Neo.Helper.Str.capitalize(row.client.last_name) : empty(),
            bodyPdfRender: function(row) {
                return this.bodyRender(row);
            },
            bodyCsvRender: function(row) {
                return this.bodyRender(row);
            },
        }, {
            name: "from",
            text: Neo.Helper.trans("From"),
            headPdfStyle: {
                background: Background,
                color: Color
            },
        }, {
            name: "pick_up",
            text: Neo.Helper.trans("Pick-up Location"),
            headPdfStyle: {
                background: Background,
                color: Color
            },
            visible: false,
            bodyRender: (row) => row.pick_up ? Neo.Helper.Str.capitalize(row.pick_up) : empty(),
            bodyPdfRender: function(row) {
                return this.bodyRender(row);
            },
            bodyCsvRender: function(row) {
                return this.bodyRender(row);
            },
        }, {
            name: "to",
            text: Neo.Helper.trans("To"),
            headPdfStyle: {
                background: Background,
                color: Color
            },
        }, {
            name: "drop_off",
            text: Neo.Helper.trans("Drop-off Location"),
            headPdfStyle: {
                background: Background,
                color: Color
            },
            visible: false,
            bodyRender: (row) => row.drop_off ? Neo.Helper.Str.capitalize(row.drop_off) : empty(),
            bodyPdfRender: function(row) {
                return this.bodyRender(row);
            },
            bodyCsvRender: function(row) {
                return this.bodyRender(row);
            },
        }, {
            name: "period",
            text: Neo.Helper.trans("Period"),
            headStyle: { width: 100, textAlign: "center", },
            bodyStyle: { width: 100, textAlign: "center", },
            headPdfStyle: function() {
                return {...this.headStyle, background: Background, color: Color };
            },
            bodyPdfStyle: function() {
                return this.bodyStyle;
            },
            bodyRender: (row) => row.period + " " + Neo.Helper.trans("Days"),
            bodyPdfRender: function(row) {
                return this.bodyRender(row);
            },
        }, {
            name: "price",
            text: Neo.Helper.trans("Price") + " (" + Currency + ")",
            headStyle: { width: 120, textAlign: "center", },
            bodyStyle: { width: 120, textAlign: "center", },
            headPdfStyle: function() {
                return {...this.headStyle, background: Background, color: Color };
            },
            bodyPdfStyle: function() {
                return this.bodyStyle;
            },
            bodyRender: (row) => Neo.Helper.Str.money(row.price, 3),
            bodyPdfRender: function(row) {
                return this.bodyRender(row);
            },
        }, {
            name: "total",
            text: Neo.Helper.trans("Total") + " (" + Currency + ")",
            headStyle: { width: 120, textAlign: "center", },
            bodyStyle: { width: 120, textAlign: "center", },
            headPdfStyle: function() {
                return {...this.headStyle, background: Background, color: Color };
            },
            bodyPdfStyle: function() {
                return this.bodyStyle;
            },
            bodyRender: (row) => Neo.Helper.Str.money(row.total, 3),
            bodyPdfRender: function(row) {
                return this.bodyRender(row);
            },
        }, {
            name: "payment",
            text: Neo.Helper.trans("Payment") + " (" + Currency + ")",
            headStyle: { width: 160, textAlign: "center", },
            bodyStyle: { width: 160, textAlign: "center", },
            headPdfStyle: function() {
                return {...this.headStyle, background: Background, color: Color };
            },
            bodyPdfStyle: function() {
                return this.bodyStyle;
            },
            bodyRender: (row) => Neo.Helper.Str.money(JSON.parse(row.payment).reduce((a, e) => a + e, 0), 3),
            bodyPdfRender: function(row) {
                return this.bodyRender(row);
            },
        }, {
            name: "creance",
            text: Neo.Helper.trans("Creance") + " (" + Currency + ")",
            headStyle: { width: 160, textAlign: "center", },
            bodyStyle: { width: 160, textAlign: "center", },
            headPdfStyle: function() {
                return {...this.headStyle, background: Background, color: Color };
            },
            bodyPdfStyle: function() {
                return this.bodyStyle;
            },
            bodyRender: (row) => Neo.Helper.Str.money(row.total - JSON.parse(row.payment).reduce((a, e) => a + e, 0), 3),
            bodyPdfRender: function(row) {
                return this.bodyRender(row);
            },
        }, {
            name: "status",
            text: Neo.Helper.trans("Status"),
            headStyle: { width: 100, textAlign: "center", },
            bodyStyle: { width: 100, textAlign: "center", },
            headPdfStyle: function() {
                return {...this.headStyle, background: Background, color: Color };
            },
            bodyPdfStyle: function() {
                return this.bodyStyle;
            },
            bodyRender: (row) => Neo.Helper.Str.capitalize(Neo.Helper.trans(row.status)),
            bodyPdfRender: function(row) {
                return this.bodyRender(row);
            },
        }, {
            name: "insurance",
            text: Neo.Helper.trans('Insurance'),
            headStyle: {
                maxWidth: 500,
            },
            visible: false,
            bodyStyle: function() {
                return this.headStyle;
            },
            headPdfStyle: function() {
                return {
                    ...this.headStyle,
                    background: Background,
                    color: Color
                }
            },
            bodyRender: (row) => row.insurance ? Neo.Helper.Str.capitalize(row.insurance) : empty(),
            bodyPdfRender: function(row) {
                return this.bodyRender(row);
            },
            bodyCsvRender: function(row) {
                return this.bodyRender(row);
            },
        }],
        vehicle_charge: () => [{
            name: "name",
            text: Neo.Helper.trans("Name"),
            headStyle: {
                maxWidth: 300,
            },
            bodyStyle: function() {
                return this.headStyle;
            },
            headPdfStyle: function() {
                return {
                    ...this.headStyle,
                    background: Background,
                    color: Color
                }
            },
            bodyRender: (row) => Neo.Helper.Str.capitalize(row.name),
            bodyPdfRender: function(row) {
                return this.bodyRender(row);
            },
            bodyCsvRender: function(row) {
                return this.bodyRender(row);
            },
        }, {
            name: "cost",
            text: Neo.Helper.trans("Cost") + " (" + Currency + ")",
            headStyle: { width: 120, textAlign: "center", },
            bodyStyle: { width: 120, textAlign: "center", },
            headPdfStyle: function() {
                return {...this.headStyle, background: Background, color: Color };
            },
            bodyPdfStyle: function() {
                return this.bodyStyle;
            },
            bodyRender: (row) => Neo.Helper.Str.money(row.cost, 3),
            bodyPdfRender: function(row) {
                return this.bodyRender(row);
            },
        }, {
            name: "details",
            text: Neo.Helper.trans('Details'),
            headStyle: {
                maxWidth: 500,
            },
            visible: false,
            bodyStyle: function() {
                return this.headStyle;
            },
            headPdfStyle: function() {
                return {
                    ...this.headStyle,
                    background: Background,
                    color: Color
                }
            },
            bodyRender: (row) => row.details ? Neo.Helper.Str.capitalize(row.details) : empty(),
            bodyPdfRender: function(row) {
                return this.bodyRender(row);
            },
            bodyCsvRender: function(row) {
                return this.bodyRender(row);
            },
        }],
        alerts: ({
            Csrf,
            Patch,
            Clear
        }) => [{
            name: "vehicle",
            text: Neo.Helper.trans("Vehicle"),
            headPdfStyle: {
                background: Background,
                color: Color
            },
            bodyRender: (row) => row.vehicle ? Neo.Helper.Str.capitalize(row.vehicle.name) : empty(),
            bodyPdfRender: function(row) {
                return this.bodyRender(row);
            },
            bodyCsvRender: function(row) {
                return this.bodyRender(row);
            },
        }, {
            name: "name",
            text: Neo.Helper.trans('Name'),
            headStyle: {
                maxWidth: 300,
            },
            bodyStyle: function() {
                return this.headStyle;
            },
            headPdfStyle: function() {
                return {
                    ...this.headStyle,
                    background: Background,
                    color: Color
                }
            },
            bodyRender: (row) => Neo.Helper.Str.capitalize(row.name),
            bodyPdfRender: function(row) {
                return this.bodyRender(row);
            },
            bodyCsvRender: function(row) {
                return this.bodyRender(row);
            },
        }, {
            name: "date",
            text: Neo.Helper.trans("date"),
            headPdfStyle: {
                background: Background,
                color: Color
            },
        }, {
            name: "recurrence",
            text: Neo.Helper.trans("Recurrence"),
            headStyle: { width: 120, textAlign: "center", },
            bodyStyle: { width: 120, textAlign: "center", },
            headPdfStyle: function() {
                return {...this.headStyle, background: Background, color: Color };
            },
            bodyPdfStyle: function() {
                return this.bodyStyle;
            },
            bodyRender: (row) => Neo.Helper.trans(Neo.Helper.Str.capitalize(row.recurrence)),
            bodyPdfRender: function(row) {
                return this.bodyRender(row);
            },
            bodyCsvRender: function(row) {
                return this.bodyRender(row);
            },
        }, {
            name: "threshold",
            text: Neo.Helper.trans("Threshold"),
            headStyle: { width: 120, textAlign: "center", },
            bodyStyle: { width: 120, textAlign: "center", },
            headPdfStyle: function() {
                return {...this.headStyle, background: Background, color: Color };
            },
            bodyPdfStyle: function() {
                return this.bodyStyle;
            },
        }, {
            name: "details",
            text: Neo.Helper.trans('Details'),
            headStyle: {
                maxWidth: 500,
            },
            visible: false,
            bodyStyle: function() {
                return this.headStyle;
            },
            headPdfStyle: function() {
                return {
                    ...this.headStyle,
                    background: Background,
                    color: Color
                }
            },
            bodyRender: (row) => row.details ? Neo.Helper.Str.capitalize(row.details) : empty(),
            bodyPdfRender: function(row) {
                return this.bodyRender(row);
            },
            bodyCsvRender: function(row) {
                return this.bodyRender(row);
            },
        }, {
            name: "action",
            text: Neo.Helper.trans("Actions"),
            headStyle: { width: 20, textAlign: "center" },
            bodyStyle: { width: 20, textAlign: "center" },
            bodyRender: (row) => {
                return `<action-tools target="${row.id}"csrf="${Csrf}"patch="${Patch}"clear="${Clear}"></action-tools>`;
            },
            headPdfStyle: function() {
                return {...this.headStyle, background: Background, color: Color };
            },
            bodyPdfStyle: function() {
                return this.bodyStyle;
            },
            bodyPdfRender: () => empty(),
            bodyCsvRender: () => empty(),
        }],
        reservations: ({
            Csrf,
            Patch,
            Print,
            Clear
        }) => [{
            name: "client",
            text: Neo.Helper.trans("Client"),
            headPdfStyle: {
                background: Background,
                color: Color
            },
            bodyRender: (row) => row.client ? Neo.Helper.Str.capitalize(row.client.first_name) + ' ' + Neo.Helper.Str.capitalize(row.client.last_name) : empty(),
            bodyPdfRender: function(row) {
                return this.bodyRender(row);
            },
            bodyCsvRender: function(row) {
                return this.bodyRender(row);
            },
        }, {
            name: "vehicle",
            text: Neo.Helper.trans("Vehicle"),
            headPdfStyle: {
                background: Background,
                color: Color
            },
            bodyRender: (row) => row.vehicle ? Neo.Helper.Str.capitalize(row.vehicle.name) : empty(),
            bodyPdfRender: function(row) {
                return this.bodyRender(row);
            },
            bodyCsvRender: function(row) {
                return this.bodyRender(row);
            },
        }, {
            name: "from",
            text: Neo.Helper.trans("From"),
            headPdfStyle: {
                background: Background,
                color: Color
            },
        }, {
            name: "pick_up",
            text: Neo.Helper.trans("Pick-up Location"),
            headPdfStyle: {
                background: Background,
                color: Color
            },
            visible: false,
            bodyRender: (row) => row.pick_up ? Neo.Helper.Str.capitalize(row.pick_up) : empty(),
            bodyPdfRender: function(row) {
                return this.bodyRender(row);
            },
            bodyCsvRender: function(row) {
                return this.bodyRender(row);
            },
        }, {
            name: "to",
            text: Neo.Helper.trans("To"),
            headPdfStyle: {
                background: Background,
                color: Color
            },
            visible: false,
        }, {
            name: "drop_off",
            text: Neo.Helper.trans("Drop-off Location"),
            headPdfStyle: {
                background: Background,
                color: Color
            },
            visible: false,
            bodyRender: (row) => row.drop_off ? Neo.Helper.Str.capitalize(row.drop_off) : empty(),
            bodyPdfRender: function(row) {
                return this.bodyRender(row);
            },
            bodyCsvRender: function(row) {
                return this.bodyRender(row);
            },
        }, {
            name: "period",
            text: Neo.Helper.trans("Period"),
            headStyle: { width: 100, textAlign: "center", },
            bodyStyle: { width: 100, textAlign: "center", },
            headPdfStyle: function() {
                return {...this.headStyle, background: Background, color: Color };
            },
            bodyPdfStyle: function() {
                return this.bodyStyle;
            },
            bodyRender: (row) => row.period + " " + Neo.Helper.trans("Days"),
            bodyPdfRender: function(row) {
                return this.bodyRender(row);
            },
        }, {
            name: "price",
            text: Neo.Helper.trans("Price") + " (" + Currency + ")",
            headStyle: { width: 120, textAlign: "center", },
            bodyStyle: { width: 120, textAlign: "center", },
            headPdfStyle: function() {
                return {...this.headStyle, background: Background, color: Color };
            },
            bodyPdfStyle: function() {
                return this.bodyStyle;
            },
            bodyRender: (row) => Neo.Helper.Str.money(row.price, 3),
            bodyPdfRender: function(row) {
                return this.bodyRender(row);
            },
        }, {
            name: "total",
            text: Neo.Helper.trans("Total") + " (" + Currency + ")",
            headStyle: { width: 120, textAlign: "center", },
            bodyStyle: { width: 120, textAlign: "center", },
            headPdfStyle: function() {
                return {...this.headStyle, background: Background, color: Color };
            },
            bodyPdfStyle: function() {
                return this.bodyStyle;
            },
            bodyRender: (row) => Neo.Helper.Str.money(row.total, 3),
            bodyPdfRender: function(row) {
                return this.bodyRender(row);
            },
        }, {
            name: "payment",
            text: Neo.Helper.trans("Payment") + " (" + Currency + ")",
            headStyle: { width: 160, textAlign: "center", },
            bodyStyle: { width: 160, textAlign: "center", },
            headPdfStyle: function() {
                return {...this.headStyle, background: Background, color: Color };
            },
            bodyPdfStyle: function() {
                return this.bodyStyle;
            },
            bodyRender: (row) => Neo.Helper.Str.money(JSON.parse(row.payment).reduce((a, e) => a + e, 0), 3),
            bodyPdfRender: function(row) {
                return this.bodyRender(row);
            },
        }, {
            name: "creance",
            text: Neo.Helper.trans("Creance") + " (" + Currency + ")",
            headStyle: { width: 160, textAlign: "center", },
            bodyStyle: { width: 160, textAlign: "center", },
            headPdfStyle: function() {
                return {...this.headStyle, background: Background, color: Color };
            },
            bodyPdfStyle: function() {
                return this.bodyStyle;
            },
            bodyRender: (row) => Neo.Helper.Str.money(row.total - JSON.parse(row.payment).reduce((a, e) => a + e, 0), 3),
            bodyPdfRender: function(row) {
                return this.bodyRender(row);
            },
        }, {
            name: "status",
            text: Neo.Helper.trans("Status"),
            headStyle: { width: 100, textAlign: "center", },
            bodyStyle: { width: 100, textAlign: "center", },
            headPdfStyle: function() {
                return {...this.headStyle, background: Background, color: Color };
            },
            bodyPdfStyle: function() {
                return this.bodyStyle;
            },
            bodyRender: (row) => Neo.Helper.Str.capitalize(Neo.Helper.trans(row.status)),
            bodyPdfRender: function(row) {
                return this.bodyRender(row);
            },
        }, {
            name: "insurance",
            text: Neo.Helper.trans('Insurance'),
            headStyle: {
                maxWidth: 500,
            },
            visible: false,
            bodyStyle: function() {
                return this.headStyle;
            },
            headPdfStyle: function() {
                return {
                    ...this.headStyle,
                    background: Background,
                    color: Color
                }
            },
            bodyRender: (row) => row.insurance ? Neo.Helper.Str.capitalize(row.insurance) : empty(),
            bodyPdfRender: function(row) {
                return this.bodyRender(row);
            },
            bodyCsvRender: function(row) {
                return this.bodyRender(row);
            },
        }, {
            name: "action",
            text: Neo.Helper.trans("Actions"),
            headStyle: { width: 20, textAlign: "center" },
            bodyStyle: { width: 20, textAlign: "center" },
            bodyRender: (row) => {
                return `<action-tools target="${row.id}"csrf="${Csrf}"patch="${Patch}"print="${Print}"clear="${Clear}"></action-tools>`;
            },
            headPdfStyle: function() {
                return {...this.headStyle, background: Background, color: Color };
            },
            bodyPdfStyle: function() {
                return this.bodyStyle;
            },
            bodyPdfRender: () => empty(),
            bodyCsvRender: () => empty(),
        }],
        charges: ({
            Csrf,
            Patch,
            Clear
        }) => [{
            name: "name",
            text: Neo.Helper.trans("Name"),
            headStyle: {
                maxWidth: 300,
            },
            bodyStyle: function() {
                return this.headStyle;
            },
            headPdfStyle: function() {
                return {
                    ...this.headStyle,
                    background: Background,
                    color: Color
                }
            },
            bodyRender: (row) => Neo.Helper.Str.capitalize(row.name),
            bodyPdfRender: function(row) {
                return this.bodyRender(row);
            },
            bodyCsvRender: function(row) {
                return this.bodyRender(row);
            },
        }, {
            name: "vehicle",
            text: Neo.Helper.trans("Vehicle"),
            headPdfStyle: {
                background: Background,
                color: Color
            },
            bodyRender: (row) => row.vehicle ? Neo.Helper.Str.capitalize(row.vehicle.name) : empty(),
            bodyPdfRender: function(row) {
                return this.bodyRender(row);
            },
            bodyCsvRender: function(row) {
                return this.bodyRender(row);
            },
        }, {
            name: "cost",
            text: Neo.Helper.trans("Cost") + " (" + Currency + ")",
            headStyle: { width: 120, textAlign: "center", },
            bodyStyle: { width: 120, textAlign: "center", },
            headPdfStyle: function() {
                return {...this.headStyle, background: Background, color: Color };
            },
            bodyPdfStyle: function() {
                return this.bodyStyle;
            },
            bodyRender: (row) => Neo.Helper.Str.money(row.cost, 3),
            bodyPdfRender: function(row) {
                return this.bodyRender(row);
            },
        }, {
            name: "details",
            text: Neo.Helper.trans('Details'),
            headStyle: {
                maxWidth: 500,
            },
            visible: false,
            bodyStyle: function() {
                return this.headStyle;
            },
            headPdfStyle: function() {
                return {
                    ...this.headStyle,
                    background: Background,
                    color: Color
                }
            },
            bodyRender: (row) => row.details ? Neo.Helper.Str.capitalize(row.details) : empty(),
            bodyPdfRender: function(row) {
                return this.bodyRender(row);
            },
            bodyCsvRender: function(row) {
                return this.bodyRender(row);
            },
        }, {
            name: "action",
            text: Neo.Helper.trans("Actions"),
            headStyle: { width: 20, textAlign: "center" },
            bodyStyle: { width: 20, textAlign: "center" },
            bodyRender: (row) => {
                return `<action-tools target="${row.id}"csrf="${Csrf}"patch="${Patch}"clear="${Clear}"></action-tools>`;
            },
            headPdfStyle: function() {
                return {...this.headStyle, background: Background, color: Color };
            },
            bodyPdfStyle: function() {
                return this.bodyStyle;
            },
            bodyPdfRender: () => empty(),
            bodyCsvRender: () => empty(),
        }],
        payments: ({
            Csrf,
            Patch,
            Print,
        }) => [{
            name: "client",
            text: Neo.Helper.trans("Client"),
            headPdfStyle: {
                background: Background,
                color: Color
            },
            bodyRender: (row) => row.client ? Neo.Helper.Str.capitalize(row.client.first_name) + ' ' + Neo.Helper.Str.capitalize(row.client.last_name) : empty(),
            bodyPdfRender: function(row) {
                return this.bodyRender(row);
            },
            bodyCsvRender: function(row) {
                return this.bodyRender(row);
            },
        }, {
            name: "vehicle",
            text: Neo.Helper.trans("Vehicle"),
            headPdfStyle: {
                background: Background,
                color: Color
            },
            bodyRender: (row) => row.vehicle ? Neo.Helper.Str.capitalize(row.vehicle.name) : empty(),
            bodyPdfRender: function(row) {
                return this.bodyRender(row);
            },
            bodyCsvRender: function(row) {
                return this.bodyRender(row);
            },
        }, {
            name: "price",
            text: Neo.Helper.trans("Price") + " (" + Currency + ")",
            headStyle: { width: 120, textAlign: "center", },
            bodyStyle: { width: 120, textAlign: "center", },
            headPdfStyle: function() {
                return {...this.headStyle, background: Background, color: Color };
            },
            bodyPdfStyle: function() {
                return this.bodyStyle;
            },
            bodyRender: (row) => Neo.Helper.Str.money(row.price, 3),
            bodyPdfRender: function(row) {
                return this.bodyRender(row);
            },
        }, {
            name: "total",
            text: Neo.Helper.trans("Total") + " (" + Currency + ")",
            headStyle: { width: 120, textAlign: "center", },
            bodyStyle: { width: 120, textAlign: "center", },
            headPdfStyle: function() {
                return {...this.headStyle, background: Background, color: Color };
            },
            bodyPdfStyle: function() {
                return this.bodyStyle;
            },
            bodyRender: (row) => Neo.Helper.Str.money(row.total, 3),
            bodyPdfRender: function(row) {
                return this.bodyRender(row);
            },
        }, {
            name: "payment",
            text: Neo.Helper.trans("Payment") + " (" + Currency + ")",
            headStyle: { width: 160, textAlign: "center", },
            bodyStyle: { width: 160, textAlign: "center", },
            headPdfStyle: function() {
                return {...this.headStyle, background: Background, color: Color };
            },
            bodyPdfStyle: function() {
                return this.bodyStyle;
            },
            bodyRender: (row) => Neo.Helper.Str.money(JSON.parse(row.payment).reduce((a, e) => a + e, 0), 3),
            bodyPdfRender: function(row) {
                return this.bodyRender(row);
            },
        }, {
            name: "creance",
            text: Neo.Helper.trans("Creance") + " (" + Currency + ")",
            headStyle: { width: 160, textAlign: "center", },
            bodyStyle: { width: 160, textAlign: "center", },
            headPdfStyle: function() {
                return {...this.headStyle, background: Background, color: Color };
            },
            bodyPdfStyle: function() {
                return this.bodyStyle;
            },
            bodyRender: (row) => Neo.Helper.Str.money(row.total - JSON.parse(row.payment).reduce((a, e) => a + e, 0), 3),
            bodyPdfRender: function(row) {
                return this.bodyRender(row);
            },
        }, {
            name: "action",
            text: Neo.Helper.trans("Actions"),
            headStyle: { width: 20, textAlign: "center" },
            bodyStyle: { width: 20, textAlign: "center" },
            bodyRender: (row) => {
                return `<action-tools target="${row.id}"csrf="${Csrf}"patch="${Patch}"print="${Print}"></action-tools>`;
            },
            headPdfStyle: function() {
                return {...this.headStyle, background: Background, color: Color };
            },
            bodyPdfStyle: function() {
                return this.bodyStyle;
            },
            bodyPdfRender: () => empty(),
            bodyCsvRender: () => empty(),
        }],
    }

Neo.load(function() {
    document.querySelectorAll(".nav-colors svg").forEach((svg, i) => {
        svg.style.color = "var(--color-" + i + ")";
    });

    document.querySelectorAll(".sys-colors svg").forEach((svg, i) => {
        svg.style.color = "var(--color-sys-" + i + ")";
    });
});

function empty() {
    return "N/A";
}

function tabs() {
    const tabs = [...document.querySelectorAll('[data-tabs]')].reduce((a, e) => ({...a, [+e.dataset.tabs]: e }), {}),
        view = [...document.querySelectorAll('[data-view]')].reduce((a, e) => ({...a, [+e.dataset.view]: e }), {}),
        next = document.querySelector("#next"),
        save = document.querySelector("#save"),
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
        const preva = document.querySelector("#prev");
        const nexta = document.querySelector("#next");
        if (prev) {
            const href = Data.Search + search + "&cursor=" + prev;
            if (preva) preva.href = href
            else {
                const _preva = Links.querySelector("#prev").cloneNode(true);
                _preva.addEventListener("click", event);
                if (nexta) dataVisualizer.insertBefore(_preva, nexta);
                else dataVisualizer.insertAdjacentElement("afterstart", _preva);
                _preva.title = Neo.Helper.trans("Prev");
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
                _nexta.title = Neo.Helper.trans("Next");
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

function AlertInitializer({ Vehicle }) {
    const
        vehicle = document.querySelector("neo-autocomplete[name=vehicle]");

    function fill(auto, url, merge) {
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

            if (merge) {
                d = d.map(e => {
                    return {...e, name: Neo.Helper.Str.capitalize(e.first_name) + ' ' + Neo.Helper.Str.capitalize(e.last_name) + (e.blacklist ? " (blacklisted)" : "") }
                })
            }

            auto.data = d;
        });

        auto.addEventListener("select", e => {
            e.target.querySelector("input").value = e.detail.data[e.target.setQuery];
        });
    }

    fill(vehicle, Vehicle);
    tabs();
}

function ReservationInitializer({ Client, Vehicle, Colors }) {
    const
        client = document.querySelector("neo-autocomplete[name=client]"),
        sclient = document.querySelector("neo-autocomplete[name=secondary_client]"),
        vehicle = document.querySelector("neo-autocomplete[name=vehicle]"),
        price = document.querySelector("neo-textbox[name=price]"),
        total = document.querySelector("neo-textbox[name=total]"),
        from_date = document.querySelector("neo-datepicker[name=from_date]"),
        from_time = document.querySelector("neo-timepicker[name=from_time]"),
        to_date = document.querySelector("neo-datepicker[name=to_date]"),
        to_time = document.querySelector("neo-timepicker[name=to_time]"),
        payment = document.querySelector("neo-textbox[name=payment]"),
        creance = document.querySelector("neo-textbox[name=creance]"),
        overlay = document.querySelector("neo-overlay"),
        list = document.querySelector("#list"),
        cost = document.querySelector("#cost"),
        json = document.querySelector("#json"),
        div = document.createElement("table"),
        data = JSON.parse(json.value);

    function fill(auto, url, merge) {
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

            if (merge) {
                d = d.map(e => {
                    return {...e, name: Neo.Helper.Str.capitalize(e.first_name) + ' ' + Neo.Helper.Str.capitalize(e.last_name) + (e.blacklist ? " (blacklisted)" : "") }
                })
            }

            auto.data = d;
        });

        auto.addEventListener("select", e => {
            e.target.querySelector("input").value = e.detail.data[e.target.setQuery];
        });
    }

    function calc() {
        const days = betweenDates(from_date.value + ' ' + from_time.value, to_date.value + ' ' + to_time.value);
        total.value = Neo.Helper.Str.money(parseFloat(price.value || 0) * days, 3);
        payment.value = Neo.Helper.Str.money(data.reduce((a, e) => a + e, 0), 3);
        creance.value = Neo.Helper.Str.money(parseFloat(total.value) - parseFloat(payment.value), 3);
    }

    function row(value) {
        div.innerHTML = `<tr class="border-t border-t-x-shade"><td class="w-[160px] ps-8 px-4 py-2 text-lg text-x-black text-center">${Neo.Helper.Str.money(value, 3)} ${Currency}</td><td></td><td class="w-[80px] pe-8 px-4 py-2 text-base text-x-black text-center"><button class="block mx-auto px-2 py-1 bg-red-500 rounded-x-thin text-x-white outline-none hover:bg-red-400 focus:bg-red-400"><svg class="w-[1.2rem] h-[1.2rem] pointer-events-none" fill="currentColor" viewBox="0 -960 960 960"><path d="M267-74q-55.73 0-95.86-39.44Q131-152.88 131-210v-501H68v-136h268v-66h287v66h269v136h-63v501q0 57.12-39.44 96.56Q750.13-74 693-74H267Zm67-205h113v-363H334v363Zm180 0h113v-363H514v363Z" /></svg></button></td></tr>`;
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

    vehicle.addEventListener("select", e => {
        price.value = Neo.Helper.Str.money(e.detail.data.price, 3);
        calc();
    });

    [from_date, from_time, to_date, to_time, price].forEach(el => {
        el.addEventListener("change", e => {
            calc();
        })
    });

    if (data.length) {
        data.forEach((e, i) => {
            list.insertAdjacentElement("beforeend", row(+e));
        });
    }

    StateInitializer(Colors);
    fill(sclient, Client, true);
    fill(vehicle, Vehicle);
    fill(client, Client, true);
    calc();
    tabs();
}

function paymentInitializer() {
    const
        total = document.querySelector("neo-textbox[name=total]"),
        payment = document.querySelector("neo-textbox[name=payment]"),
        creance = document.querySelector("neo-textbox[name=creance]"),
        overlay = document.querySelector("neo-overlay"),
        list = document.querySelector("#list"),
        cost = document.querySelector("#cost"),
        json = document.querySelector("#json"),
        div = document.createElement("table"),
        data = JSON.parse(json.value);

    function calc() {
        payment.value = Neo.Helper.Str.money(data.reduce((a, e) => a + e, 0), 3);
        creance.value = Neo.Helper.Str.money(parseFloat(total.value) - parseFloat(payment.value), 3);
    }

    function row(value) {
        div.innerHTML = `<tr class="border-t border-t-x-shade"><td class="w-[160px] ps-8 px-4 py-2 text-lg text-x-black text-center">${Neo.Helper.Str.money(value, 3)} ${Currency}</td><td></td><td class="w-[80px] pe-8 px-4 py-2 text-base text-x-black text-center"><button class="block mx-auto px-2 py-1 bg-red-500 rounded-x-thin text-x-white outline-none hover:bg-red-400 focus:bg-red-400"><svg class="w-[1.2rem] h-[1.2rem] pointer-events-none" fill="currentColor" viewBox="0 -960 960 960"><path d="M267-74q-55.73 0-95.86-39.44Q131-152.88 131-210v-501H68v-136h268v-66h287v66h269v136h-63v501q0 57.12-39.44 96.56Q750.13-74 693-74H267Zm67-205h113v-363H334v363Zm180 0h113v-363H514v363Z" /></svg></button></td></tr>`;
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
    const auto = document.querySelector("neo-autocomplete");
    var timer;
    auto.addEventListener("input", async(e) => {
        if (timer) clearTimeout(timer);
        auto.loading = true;
        auto.data = await new Promise((resolver, rejecter) => {
            timer = setTimeout(async() => {
                const data = await getData(Search + "?search=" +
                    encodeURIComponent(
                        auto.query.trim()));
                auto.loading = false;
                resolver(data);
            }, 250);
        });

        auto.addEventListener("select", e => {
            e.target.querySelector("input").value = e.detail.data[e.target.setQuery];
        });
    });
}

function BlackListInitializer({ Search }) {
    const auto = document.querySelector("neo-autocomplete");
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
            return {...e, name: Neo.Helper.Str.capitalize(e.first_name) + ' ' + Neo.Helper.Str.capitalize(e.last_name) + (e.blacklist ? " (blacklisted)" : "") }
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
            labels: [Neo.Helper.trans("Total"), Neo.Helper.trans("Charges")],
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
    data['keys'] = data['keys'].map(e => Neo.Helper.trans(e));

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
                label: Neo.Helper.trans('Payments')
            }, {
                data: data['creances'],
                order: 2,
                borderWidth: 2,
                backgroundColor: "#EAB308",
                borderColor: "#EAB308",
                label: Neo.Helper.trans('Creances')
            }, {
                data: data['charges'],
                borderWidth: 2,
                backgroundColor: "#EC4899",
                borderColor: "#EC4899",
                label: Neo.Helper.trans('Charges')
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

    document.querySelector("#printer").addEventListener("click", () => {
        document.querySelector("#chart-viewer").src = line.toDataURL();
        document.querySelector("neo-printer").print();
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
        [Neo.Helper.trans("Payments"), ...data['payments']],
        [Neo.Helper.trans("Creances"), ...data['creances']],
        [Neo.Helper.trans("Charges"), ...data['charges']],
    ].map(e => e.map(c => parse(typeof c === "number" ? Neo.Helper.Str.money(c) : c)).join(',')).join("\n");
    document.querySelector("#download").href = URL.createObjectURL(new Blob([csv], {
        type: "text/csv",
    }));

    window.addEventListener("resize", resize);
    document.querySelector("#trigger").addEventListener("click", e => {
        setTimeout(() => resize(), 250);
    });
}

async function SceneInitializer({ Line, Search, Data }) {
    Search.forEach(([id, type, url, fil]) => {
        TableVisualizer(document.querySelector(id), type, { Search: url, Filter: fil });
    });

    const data = await getData(Data);
    data['keys'] = data['keys'].map(e => Neo.Helper.trans(e));

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
                label: Neo.Helper.trans('Payments')
            }, {
                data: data['creances'],
                order: 2,
                borderWidth: 2,
                backgroundColor: "#EAB308",
                borderColor: "#EAB308",
                label: Neo.Helper.trans('Creances')
            }, ...(data['charges'] ? [{
                data: data['charges'],
                borderWidth: 2,
                backgroundColor: "#EC4899",
                borderColor: "#EC4899",
                label: Neo.Helper.trans('Charges')
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

    document.querySelector("#printer").addEventListener("click", () => {
        document.querySelector("#chart-viewer").src = line.toDataURL();
        document.querySelector("neo-printer").print();
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
        [Neo.Helper.trans("Payments"), ...data['payments']],
        [Neo.Helper.trans("Creances"), ...data['creances']],
        ...(data['charges'] ? [
            [Neo.Helper.trans("Charges"), ...data['charges']]
        ] : []),
    ].map(e => e.map(c => parse(typeof c === "number" ? Neo.Helper.Str.money(c) : c)).join(',')).join("\n");
    document.querySelector("#download").href = URL.createObjectURL(new Blob([csv], {
        type: "text/csv",
    }));

    window.addEventListener("resize", resize);
    document.querySelector("#trigger").addEventListener("click", e => {
        setTimeout(() => resize(), 250);
    });
}

async function CalendarInitializer({ Calendar, Data }) {
    const period = document.querySelector("[name=period]").content;

    const data = await getData(Data);
    var _calendar = new FullCalendar.Calendar(Calendar, {
        headerToolbar: {
            "left": "title",
            "right": "today,dayGridMonth,timeGridWeek,timeGridDay prev,next"
        },
        initialView: period == "month" ? "dayGridMonth" : (period == "week" ? "timeGridWeek" : "timeGridDay"),
        allDaySlot: false,
        timeZone: 'UTC',
        locale: document.documentElement.lang,
        events: data,
    });
    _calendar.render();

    Calendar.nextElementSibling.remove();

    document.querySelector(".fc-prev-button").innerHTML = `<svg class="block w-6 h-6 pointer-events-none" fill="currentColor" viewBox="0 -960 960 960"><path d="M528-251 331-449q-7-6-10.5-14t-3.5-18q0-9 3.5-17.5T331-513l198-199q13-12 32-12t33 12q13 13 12.5 33T593-646L428-481l166 166q13 13 13 32t-13 32q-14 13-33.5 13T528-251Z"></path></svg>`;
    document.querySelector(".fc-next-button").innerHTML = `<svg class="block w-6 h-6 pointer-events-none" fill="currentColor" viewBox="0 -960 960 960"><path d="M344-251q-14-15-14-33.5t14-31.5l164-165-165-166q-14-12-13.5-32t14.5-33q13-14 31.5-13.5T407-712l199 199q6 6 10 14.5t4 17.5q0 10-4 18t-10 14L408-251q-13 13-32 12.5T344-251Z"></path></svg>`;
    document.querySelector(".tools").appendChild(document.querySelector(".fc-header-toolbar"));

    window.addEventListener("resize", () => _calendar.render());
    document.querySelector("#trigger").addEventListener("click", e => {
        setTimeout(() => _calendar.render(), 250);
    });
}

function StateInitializer(colors) {
    const damage = document.querySelector("neo-select[name=damage]"),
        paths = document.querySelectorAll(".path"),
        parts = document.querySelector("#parts"),
        state = document.querySelector("#state"),
        add = document.querySelector("#add"),
        div = document.createElement("table"),
        data = JSON.parse(state.value);

    var active = [];

    function row(name, color) {
        div.innerHTML = `<tr class="border-t border-t-x-shade"><td class="ps-8 p-4 text-lg text-x-black"><div class="flex items-center gap-2 flex-wrap"><span class="block w-10 h-6 rounded-x-thin" style="background:${color}"></span><span class="block">${Neo.Helper.trans(Neo.Helper.Str.capitalize(name))}</span></div></td><td class="w-[80px] pe-8 p-4 text-base text-x-black text-center"><button class="block mx-auto px-2 py-1 bg-red-500 rounded-x-thin text-x-white outline-none hover:bg-red-400 focus:bg-red-400"><svg class="w-[1.2rem] h-[1.2rem] pointer-events-none" fill="currentColor" viewBox="0 -960 960 960"><path d="M267-74q-55.73 0-95.86-39.44Q131-152.88 131-210v-501H68v-136h268v-66h287v66h269v136h-63v501q0 57.12-39.44 96.56Q750.13-74 693-74H267Zm67-205h113v-363H334v363Zm180 0h113v-363H514v363Z" /></svg></button></td></tr>`;
        const tr = div.querySelector("tr");
        tr.querySelector("button").addEventListener("click", e => {
            e.preventDefault();
            const index = [...parts.children].indexOf(tr);
            data[index].parts.forEach(part => {
                const path = document.querySelector("#" + part);
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
                const path = document.querySelector("#" + part);
                path.classList.add("selected");
                path.style.fill = colors[obj.type];
            });
            parts
                .insertAdjacentElement("beforeend", row(obj.type, colors[obj.type]));
        });
    }
}

function StateScene({ Colors, Data }) {
    const trigger = document.querySelector("#printer"),
        printer = document.querySelector("neo-printer");

    trigger.addEventListener("click", () => printer.print());

    if (Data.length) {
        Data.forEach(obj => {
            obj.parts.forEach(part => {
                const paths = document.querySelectorAll("#" + part);
                paths.forEach(path => {
                    path.style.fill = Colors[obj.type];
                });
            });
        });
    }

    document.addEventListener("DOMContentLoaded", () => setTimeout(() => {
        printer.print();
    }, 1000));
}