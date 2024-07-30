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

const $trans = Neo.Helper.trans,
    $cap = Neo.Helper.Str.capitalize,
    $money = Neo.Helper.Str.money,
    $query = (sel) => document.querySelector(sel),
    $qall = (sel) => document.querySelectorAll(sel)

Neo.Locales.ar = {
    ...Neo.Locales.ar,

    "pending": "معلق",
    "completed": "منجز",
    "Prev": "السابق",
    "Next": "التالي",
    "Total": "المجموع",
    "Charges": "رسوم",
    "Payments": "المدفوعات",
    "Creances": "كريانس",
    "Vehicle": "عربة",
    "Mileage": "عدد الأميال",
    "Km": "كم",
    "Period": "فترة",
    "Days": "أيام",
    "First Name": "الاسم الأول",
    "Last Name": "اسم العائلة",
    "Gender": "جنس",
    "Birth Date": "تاريخ الميلاد",
    "Email": "بريد إلكتروني",
    "Phone": "هاتف",
    "Address": "عنوان",
    "Actions": "أجراءات",
    "Full Name": "الاسم الكامل",
    "Nationality": "جنسية",
    "Identity": "هوية",
    "Identity Type": "نوع الهوية",
    "License Number": "رقم الرخصة",
    "BlackList": "القائمة السوداء",
    "Ref": "المرجع",
    "From": "من",
    "Pick-up Location": "اختر موقعا",
    "To": "ل",
    "Drop-off Location": "موقع النزول",
    "Price": "سعر",
    "Payment": "قسط",
    "Creance": "كريانس",
    "Starting Mileage": "عدد الكيلومترات البداية",
    "Return Mileage": "عودة الأميال",
    "Fuel": "وقود",
    "Status": "حالة",
    "Client": "عميل",
    "Details": "تفاصيل",
    "Circulation Date": "تاريخ التداول",
    "Horse Power": "قوة حصان",
    "Horse Power Tax": "ضريبة قوة الحصان",
    "Insurance": "تأمين",
    "Insurance Cost": "تكلفة التأمين",
    "Transmission": "الانتقال",
    "Passengers": "ركاب",
    "Doors": "أبواب",
    "Cargo": "البضائع",
    "Name": "اسم",
    "Cost": "يكلف",
    "Consumable": "مستهلكة",
    "Recurrence": "تكرار",
    "Threshold": "عتبة",
    "Hour": "ساعة",
    "Next Recurrence": "التكرار التالي",
    "Reservation": "حجز",
    "male": "ذكر",
    "female": "أنثى",
    "week": "أسبوع",
    "month": "شهر",
    "year": "سنة",
    "cin": "سين",
    "visa": "تأشيرة",
    "passport": "جواز سفر",
    "residence permit": "تصريح الإقامة",
    "manual": "يدوي",
    "automatic": "تلقائي",
    "gasoline": "الغازولين",
    "diesel": "ديزل",
    "gasoline hybrid": "هجين البنزين",
    "diesel hybrid": "هجين الديزل",
    "less than 8 cv": "أقل من 8 السيرة الذاتية",
    "between 8 and 10 cv": "بين 8 و 10 السيرة الذاتية",
    "between 11 and 14 cv": "بين 11 و 14 السيرة الذاتية",
    "grather than or equals to 15 cv": "أكبر من أو يساوي 15 السيرة الذاتية",
    "mileage": "عدد الأميال",
    "casablanca": "الدار البيضاء",
    "rabat": "الرباط",
    "fez": "فاس",
    "marrakesh": "مراكش",
    "agadir": "أغادير",
    "tangier": "طنجة",
    "meknes": "مكناس",
    "oujda": "وجدة",
    "kenitra": "القنيطرة",
    "tetouan": "تطوان",
    "safi": "صافي",
    "mohammedia": "المحمدية",
    "khouribga": "خريبكة",
    "el jadida": "الجديدة",
    "nador": "الناظور",
    "beni mellal": "بني ملال",
    "khemisset": "الخميسات",
    "larache": "العرائش",
    "ksar el kebir": "القصر الكبير",
    "settat": "سطات",
    "sidi kacem": "سيدي قاسم",
    "temara": "تمارة",
    "berrechid": "برشيد",
    "oued zem": "وادي زم",
    "fquih ben salah": "الفقيه بن صلاح",
    "taroudant": "تارودانت",
    "ouarzazate": "ورزازات",
    "dakhla": "الداخلة",
    "guelmim": "كلميم",
    "laayoune": "العيون",
    "scrtaches": "خدوش",
    "cracks": "الشقوق",
    "dents": "الخدوش",
    "afghan": "الأفغاني",
    "albanian": "الألبانية",
    "algerian": "جزائري",
    "american": "أمريكي",
    "andorran": "andorran",
    "angolan": "الأنغولية",
    "anguillan": "أنغيلا",
    "citizen of antigua and barbuda": "مواطن من أنتيغوا وبربودا",
    "argentine": "أرجنتيني",
    "armenian": "الأرمنية",
    "australian": "استرالي",
    "austrian": "النمساوي",
    "azerbaijani": "أذربيجان",
    "bahamian": "الباهامية",
    "bahraini": "بحريني",
    "bangladeshi": "بنجلاديش",
    "barbadian": "بربادوسي",
    "belarusian": "البيلاروسية",
    "belgian": "بلجيكي",
    "belizean": "بليزي",
    "beninese": "بنينيز",
    "bermudian": "برمودي",
    "bhutanese": "بوتاني",
    "bolivian": "بوليفي",
    "citizen of bosnia and herzegovina": "مواطن من البوسنة والهرسك",
    "botswanan": "بوتسوانا",
    "brazilian": "برازيلي",
    "british": "بريطاني",
    "british virgin islander": "جزر فيرجن البريطانية",
    "bruneian": "بروني",
    "bulgarian": "البلغارية",
    "burkinan": "بوركينان",
    "burmese": "البورمية",
    "burundian": "بوروندي",
    "cambodian": "كمبودي",
    "cameroonian": "الكاميروني",
    "canadian": "كندي",
    "cape verdean": "الرأس الأخضر",
    "cayman islander": "جزر كايمان",
    "central african": "أفريقيا الوسطى",
    "chadian": "تشادية",
    "chilean": "تشيلي",
    "chinese": "صينى",
    "colombian": "كولومبي",
    "comoran": "comoran",
    "congolese (congo)": "الكونغولية (الكونغو)",
    "congolese (drc)": "الكونغولية (جمهورية الكونغو الديمقراطية)",
    "cook islander": "طبخ سكان الجزيرة",
    "costa rican": "كوستاريكا",
    "croatian": "الكرواتي",
    "cuban": "الكوبي",
    "cymraes": "cymraes",
    "cymro": "cymro",
    "cypriot": "القبرصي",
    "czech": "التشيكية",
    "danish": "دانماركي",
    "djiboutian": "جيبوتي",
    "dominican": "الدومينيكان",
    "citizen of the dominican republic": "مواطن من جمهورية الدومينيكان",
    "dutch": "هولندي",
    "east timorese": "تيمور الشرقية",
    "ecuadorean": "الاكوادورية",
    "egyptian": "مصري",
    "emirati": "إماراتي",
    "english": "إنجليزي",
    "equatorial guinean": "غينيا الاستوائية",
    "eritrean": "إريتريا",
    "estonian": "الإستونية",
    "ethiopian": "الاثيوبية",
    "faroese": "الفارويز",
    "fijian": "فيجي",
    "filipino": "الفلبينية",
    "finnish": "الفنلندية",
    "french": "فرنسي",
    "gabonese": "الجابونية",
    "gambian": "غامبي",
    "georgian": "الجورجية",
    "german": "ألمانية",
    "ghanaian": "الغاني",
    "gibraltarian": "جبل طارق",
    "greek": "اليونانية",
    "greenlandic": "غرينلاند",
    "grenadian": "غرينادي",
    "guamanian": "الغوامانية",
    "guatemalan": "الغواتيمالية",
    "citizen of guinea-bissau": "مواطن غينيا بيساو",
    "guinean": "غينيا",
    "guyanese": "الغيانا",
    "haitian": "هايتي",
    "honduran": "هندوراس",
    "hong konger": "هونج كونج",
    "hungarian": "الهنغارية",
    "icelandic": "الأيسلندية",
    "indian": "هندي",
    "indonesian": "الأندونيسية",
    "iranian": "إيراني",
    "iraqi": "عراقي",
    "irish": "الأيرلندية",
    "israeli": "إسرائيلي",
    "italian": "ايطالي",
    "ivorian": "الإيفواري",
    "jamaican": "الجامايكي",
    "japanese": "اليابانية",
    "jordanian": "أردني",
    "kazakh": "الكازاخستانية",
    "kenyan": "الكيني",
    "kittitian": "كيتيتي",
    "citizen of kiribati": "مواطن كيريباتي",
    "kosovan": "كوسوفو",
    "kuwaiti": "كويتي",
    "kyrgyz": "قيرغيزستان",
    "lao": "لاو",
    "latvian": "لاتفيا",
    "lebanese": "لبناني",
    "liberian": "ليبيري",
    "libyan": "libyan",
    "liechtenstein citizen": "مواطن ليختنشتاين",
    "lithuanian": "الليتوانية",
    "luxembourger": "لوكسمبورغ",
    "macanese": "ماكانيز",
    "macedonian": "المقدونية",
    "malagasy": "مدغشقر",
    "malawian": "ملاوي",
    "malaysian": "الماليزية",
    "maldivian": "المالديف",
    "malian": "مالي",
    "maltese": "المالطية",
    "marshallese": "مارشال",
    "martiniquais": "مارتينيكوايس",
    "mauritanian": "موريتاني",
    "mauritian": "موريشيوس",
    "mexican": "مكسيكي",
    "micronesian": "ميكرونيزيا",
    "moldovan": "مولدوفا",
    "monegasque": "monegasque",
    "mongolian": "المنغولية",
    "montenegrin": "الجبل الأسود",
    "montserratian": "مونتسيراتيان",
    "moroccan": "مغربي",
    "mosotho": "موسوتو",
    "mozambican": "موزمبيقى",
    "namibian": "الناميبي",
    "nauruan": "ناوروان",
    "nepalese": "النيبالية",
    "new zealander": "نيوزيلندي",
    "nicaraguan": "نيكاراغوا",
    "nigerian": "نيجيري",
    "nigerien": "نيجيري",
    "niuean": "com.niuean",
    "north korean": "كوري شمالي",
    "northern irish": "شمالية إيرلندية",
    "norwegian": "النرويجية",
    "omani": "عماني",
    "pakistani": "باكستاني",
    "palauan": "بالاو",
    "palestinian": "فلسطيني",
    "panamanian": "بنمي",
    "papua new guinean": "بابوا غينيا الجديدة",
    "paraguayan": "باراغواي",
    "peruvian": "بيرو",
    "pitcairn islander": "سكان جزيرة بيتكيرن",
    "polish": "تلميع",
    "portuguese": "البرتغالية",
    "prydeinig": "بريدينيج",
    "puerto rican": "بورتوريكو",
    "qatari": "قطري",
    "romanian": "روماني",
    "russian": "الروسية",
    "rwandan": "الرواندية",
    "salvadorean": "سلفادوري",
    "sammarinese": "سامارينيز",
    "samoan": "ساموا",
    "sao tomean": "ساو توميان",
    "saudi arabian": "العربية السعودية",
    "scottish": "اسكتلندي",
    "senegalese": "سنغالي",
    "serbian": "الصربية",
    "citizen of seychelles": "مواطن من سيشيل",
    "sierra leonean": "السيراليوني",
    "singaporean": "سنغافوري",
    "slovak": "السلوفاكية",
    "slovenian": "السلوفينية",
    "solomon islander": "جزر سليمان",
    "somali": "الصومالية",
    "south african": "جنوب افريقيا",
    "south korean": "كوريا الجنوبية",
    "south sudanese": "جنوب السودان",
    "spanish": "الأسبانية",
    "sri lankan": "سري لانكا",
    "st helenian": "سانت هيلينيان",
    "st lucian": "سانت لوسيان",
    "stateless": "عديمي الجنسية",
    "sudanese": "سوداني",
    "surinamese": "سورينام",
    "swazi": "سوازيلاند",
    "swedish": "السويدية",
    "swiss": "سويسري",
    "syrian": "سوري",
    "taiwanese": "التايوانية",
    "tajik": "الطاجيكية",
    "tanzanian": "تنزانيا",
    "thai": "التايلاندية",
    "togolese": "التوغولية",
    "tongan": "تونجا",
    "trinidadian": "ترينيدادي",
    "tristanian": "تريستانيان",
    "tunisian": "تونسي",
    "turkish": "اللغة التركية",
    "turkmen": "التركمان",
    "turks and caicos islander": "جزر تركس وكايكوس",
    "tuvaluan": "tuvaluan",
    "ugandan": "أوغندية",
    "ukrainian": "الأوكرانية",
    "uruguayan": "الأوروغواي",
    "uzbek": "الأوزبكية",
    "vatican citizen": "مواطن الفاتيكان",
    "citizen of vanuatu": "مواطن فانواتو",
    "venezuelan": "فنزويلية",
    "vietnamese": "vietnamese",
    "vincentian": "فنسنتيان",
    "wallisian": "الواليزي",
    "welsh": "تهرب من دفع الرهان",
    "yemeni": "يمني",
    "zambian": "زامبيا",
    "zimbabwean": "زيمبابوي",
    "fluids": "السوائل",
    "filters": "المرشحات",
    "belts and hoses": "الأحزمة والخراطيم",
    "tires and brakes": "الإطارات والفرامل",
    "battery and electrical": "البطارية والكهربائية",
    "additional items": "عناصر إضافية",
    "other": "آخر",
    "seat": "مقعد",
    "renault": "رينو",
    "peugeot": "بيجو",
    "dacia": "داسيا",
    "citroën": "سيتروين",
    "opel": "أوبل",
    "alfa romeo": "الفا روميو",
    "škoda": "شكودا",
    "chevrolet": "شيفروليه",
    "porsche": "بورش",
    "honda": "هوندا",
    "subaru": "سوبارو",
    "mazda": "مازدا",
    "mitsubishi": "ميتسوبيشي",
    "lexus": "لكزس",
    "toyota": "تويوتا",
    "bmw": "بي ام دبليو",
    "volkswagen": "فولكس واجن",
    "suzuki": "سوزوكي",
    "mercedes-benz": "مرسيدس بنز",
    "saab": "صعب",
    "audi": "أودي",
    "kia": "كيا",
    "land rover": "لاند روفر",
    "dodge": "يتملص",
    "chrysler": "كرايسلر",
    "ford": "معقل",
    "hummer": "مطرقة 🔨",
    "hyundai": "هيونداي",
    "infiniti": "إنفينيتي",
    "jaguar": "جاكوار",
    "jeep": "جيب",
    "nissan": "نيسان",
    "volvo": "فولفو",
    "daewoo": "دايو",
    "fiat": "فيات",
    "mini": "mini",
    "rover": "روفر",
    "smart": "ذكي",
    "engine oil": "زيت المحرك",
    "transmission fluid": "انتقال السوائل",
    "brake fluid": "زيت الفرامل",
    "coolant": "المبرد",
    "power steering fluid": "سائل التوجيه المعزز",
    "differential fluid": "السائل التفاضلي",
    "engine filter": "مرشح المحرك",
    "air filter": "مرشح الهواء",
    "cabin air filter": "مصفاة هواء المقصورة",
    "fuel filter": "مرشح الوقود",
    "timing belt": "توقيت الحزام",
    "serpentine belt": "حزام اعوج",
    "hoses": "خراطيم",
    "tires": "الإطارات",
    "brake pads and rotors": "منصات الفرامل والدوارات",
    "wheel alignment": "موازنة العجلات",
    "battery": "بطارية",
    "spark plugs": "شمعات الإشعال",
    "ignition coils": "لفائف الاشتعال",
    "wiper blades": "شفرات المساحات",
    "lights": "أضواء",
    "exhaust system": "نظام العادم",
    "suspension components": "مكونات التعليق",
    "insurance": "تأمين",
    "taxes": "الضرائب",
    "alhambra": "قصر الحمراء",
    "altea": "ألتيا",
    "altea xl": "ألتيا XL",
    "arosa": "أروسا",
    "cordoba": "قرطبة",
    "cordoba vario": "قرطبة فاريو",
    "exeo": "com.exeo",
    "ibiza": "إيبيزا",
    "ibiza st": "شارع إيبيزا",
    "exeo st": "شارع إكسيو",
    "leon": "ليون",
    "leon st": "شارع ليون",
    "inca": "الإنكا",
    "mii": "mii",
    "toledo": "توليدو",
    "captur": "الالتقاط",
    "clio": "كليو",
    "clio grandtour": "كليو جراندتور",
    "espace": "com.espace",
    "express": "يعبر",
    "fluence": "فلوينس",
    "grand espace": "الفضاء الكبير",
    "grand modus": "طريقة كبيرة",
    "grand scenic": "المناظر الطبيعية الخلابة",
    "kadjar": "كادجار",
    "kangoo": "كانجو",
    "kangoo express": "كانجو اكسبرس",
    "koleos": "كوليوس",
    "laguna": "لاغونا",
    "laguna grandtour": "لاجونا جراندتور",
    "latitude": "خط العرض",
    "mascott": "التميمة",
    "mégane": "ميجان",
    "mégane cc": "ميجان cc",
    "mégane combi": "ميجان كومبي",
    "mégane grandtour": "ميجان جراندتور",
    "mégane coupé": "ميجان كوبيه",
    "mégane scénic": "ميغان ذات المناظر الخلابة",
    "scénic": "ذات المناظر الخلابة",
    "talisman": "تعويذة",
    "talisman grandtour": "تعويذة العظمة",
    "thalia": "ثاليا",
    "twingo": "توينجو",
    "wind": "رياح",
    "zoé": "زوي",
    "bipper": "biper",
    "rcz": "rcz",
    "dokker": "dokker",
    "duster": "منفضة",
    "lodgy": "lodgy",
    "logan": "لوغان",
    "logan mcv": "لوغان ام سي في",
    "logan van": "شاحنة لوغان",
    "sandero": "سانديرو",
    "solenza": "سولينزا",
    "berlingo": "berlingo",
    "c-crosser": "ج كروسر",
    "c-elissée": "ج-إليسي",
    "c-zero": "ج-صفر",
    "c1": "ج1",
    "c2": "ج2",
    "c3": "ج3",
    "c3 picasso": "c3 بيكاسو",
    "c4": "ج4",
    "c4 aircross": "c4 ايركروس",
    "c4 cactus": "C4 الصبار",
    "c4 coupé": "كوبيه c4",
    "c4 grand picasso": "C4 جراند بيكاسو",
    "c4 sedan": "سي4 سيدان",
    "c5": "ج5",
    "c5 break": "استراحة c5",
    "c5 tourer": "سي 5 تورير",
    "c6": "ج6",
    "c8": "ج8",
    "ds3": "ds3",
    "ds4": "ds4",
    "ds5": "ds5",
    "evasion": "التهرب",
    "jumper": "سترة او قفاز او لاعب قفز",
    "jumpy": "ثاب",
    "saxo": "ساكسو",
    "nemo": "نيمو",
    "xantia": "xantia",
    "xsara": "كسارا",
    "agila": "أجيلا",
    "ampera": "أمبيرا",
    "antara": "أنتارا",
    "astra": "أسترا",
    "astra cabrio": "أسترا كابريو",
    "astra caravan": "قافلة استرا",
    "astra coupé": "أسترا كوبيه",
    "calibra": "عيار",
    "campo": "كامبو",
    "cascada": "كاسكادا",
    "corsa": "كورسا",
    "frontera": "فرونتيرا",
    "insignia": "شارة",
    "insignia kombi": "شارة كومبي",
    "kadett": "كاديت",
    "meriva": "ميريفا",
    "mokka": "موكا",
    "movano": "movano",
    "omega": "أوميغا",
    "signum": "سيغنوم",
    "vectra": "فكترا",
    "vectra caravan": "قافلة فيكترا",
    "vivaro": "فيفارو",
    "vivaro kombi": "فيفارو كومبي",
    "zafira": "زافيرا",
    "brera": "بريرا",
    "gtv": "gtv",
    "mito": "ميتو",
    "crosswagon": "عربة كروس",
    "spider": "العنكبوت",
    "gt": "GT",
    "giulietta": "جوليتا",
    "giulia": "جوليا",
    "favorit": "مفضل",
    "felicia": "فيليسيا",
    "citigo": "سيتيجو",
    "fabia": "فابيا",
    "fabia combi": "كومبي فابيا",
    "fabia sedan": "فابيا سيدان",
    "felicia combi": "فيليسيا كومبي",
    "octavia": "اوكتافيا",
    "octavia combi": "اوكتافيا كومبي",
    "roomster": "رومستر",
    "yeti": "اليتي",
    "rapid": "سريع",
    "rapid spaceback": "عودة الفضاء السريع",
    "superb": "رائع",
    "superb combi": "كومبي رائع",
    "alero": "com.alero",
    "aveo": "أفيو",
    "camaro": "كامارو",
    "captiva": "كابتيفا",
    "corvette": "كورفيت",
    "cruze": "كروز",
    "cruze sw": "كروز سو",
    "epica": "ملحمة",
    "equinox": "الاعتدال",
    "evanda": "ايفاندا",
    "hhr": "ساعة",
    "kalos": "كالوس",
    "lacetti": "لاكيتي",
    "lacetti sw": "لاكيتي سو",
    "lumina": "لومينا",
    "malibu": "ماليبو",
    "matiz": "ماتيز",
    "monte carlo": "مونتي كارلو",
    "nubira": "نوبيرا",
    "orlando": "أورلاندو",
    "spark": "شرارة",
    "suburban": "من الضواحى",
    "tacuma": "تاكوما",
    "tahoe": "تاهو",
    "trax": "تراكس",
    "boxster": "بوكستر",
    "cayenne": "حريف",
    "cayman": "كايمان",
    "macan": "macan",
    "panamera": "باناميرا",
    "accord": "اتفاق",
    "accord coupé": "كوبيه اتفاق",
    "accord tourer": "أكورد تورير",
    "city": "مدينة",
    "civic": "مدني",
    "civic aerodeck": "المطار المدني",
    "civic coupé": "كوبيه سيفيك",
    "civic tourer": "السياحة المدنية",
    "civic type r": "النوع المدني ص",
    "cr-v": "CR-V",
    "cr-x": "cr-x",
    "cr-z": "cr-z",
    "fr-v": "الأب-V",
    "hr-v": "ساعة-v",
    "insight": "بصيرة",
    "integra": "انتيغرا",
    "jazz": "موسيقى الجاز",
    "legend": "أسطورة",
    "prelude": "مقدمة",
    "brz": "brz",
    "forester": "فورستر",
    "impreza": "امبريزا",
    "impreza wagon": "عربة امبريزا",
    "justy": "عادل",
    "legacy": "إرث",
    "legacy wagon": "عربة تراث",
    "legacy outback": "المناطق النائية التراثية",
    "levorg": "levorg",
    "outback": "المناطق النائية",
    "svx": "svx",
    "tribeca": "تريبيكا",
    "tribeca b9": "تريبيكا ب9",
    "xv": "الخامس عشر",
    "b-fighter": "ب-مقاتل",
    "b2500": "ب2500",
    "bt": "بريتيش تيليكوم",
    "cx-3": "سي اكس-3",
    "cx-5": "سي اكس-5",
    "cx-7": "سي اكس-7",
    "cx-9": "cx-9",
    "demio": "ديميو",
    "mpv": "mpv",
    "mx-3": "مكس-3",
    "mx-5": "مكس-5",
    "mx-6": "مكس-6",
    "premacy": "أسبقية",
    "rx-7": "آر إكس-7",
    "rx-8": "آر إكس-8",
    "xedox 6": "اكسيدوكس 6",
    "asx": "asx",
    "carisma": "كاريزما",
    "colt": "مسدس",
    "colt cc": "كولت سي سي",
    "eclipse": "كسوف",
    "fuso canter": "فوزو الخبب",
    "galant": "جالانت",
    "galant combi": "كومبي جالانت",
    "grandis": "غراندز",
    "l200": "ل200",
    "l200 pick up": "l200 التقاط",
    "l200 pick up allrad": "l200 التقاط allrad",
    "l300": "ل 300",
    "lancer": "لانسر",
    "lancer combi": "كومبي لانسر",
    "lancer evo": "لانسر إيفو",
    "lancer sportback": "لانسر سبورت باك",
    "outlander": "غريب عن الديار",
    "pajero": "باجيرو",
    "pajeto pinin": "باجيتو بينين",
    "pajero pinin wagon": "عربة باجيرو بينين",
    "pajero sport": "رياضة باجيرو",
    "pajero wagon": "عربة باجيرو",
    "space star": "نجم الفضاء",
    "ct": "ط م",
    "gs": "ع",
    "gs 300": "ع 300",
    "gx": "gx",
    "is": "يكون",
    "is 200": "هو 200",
    "is 250 c": "هو 250 ج",
    "is-f": "هو-و",
    "ls": "ليرة سورية",
    "lx": "lx",
    "nx": "nx",
    "rc f": "RC و",
    "rx": "rx",
    "rx 300": "ار اكس 300",
    "rx 400h": "آر إكس 400 ساعة",
    "rx 450h": "آر إكس 450 ساعة",
    "sc 430": "ش 430",
    "auris": "أوريس",
    "avensis": "أفينسيس",
    "avensis combi": "أفينسيس كومبي",
    "avensis van verso": "أفينسيس فان فيرسو",
    "aygo": "com.aygo",
    "camry": "كامري",
    "carina": "كارينا",
    "celica": "سيليكا",
    "corolla": "كورولا",
    "corolla combi": "كورولا كومبي",
    "corolla sedan": "كورولا سيدان",
    "corolla verso": "كورولا العكس",
    "fj cruiser": "اف جي كروزر",
    "gt86": "GT86",
    "hiace": "هايس",
    "hiace van": "هايس فان",
    "highlander": "هايلاندر",
    "hilux": "هايلكس",
    "land cruiser": "لاند كروزر",
    "mr2": "السيد2",
    "paseo": "باسيو",
    "picnic": "نزهه",
    "prius": "بريوس",
    "rav4": "rav4",
    "sequoia": "سيكويا",
    "starlet": "نجيمة",
    "supra": "أعلاه",
    "tundra": "التندرا",
    "urban cruiser": "الطراد الحضري",
    "verso": "الصفحة اليسرى",
    "yaris": "ياريس",
    "yaris verso": "ياريس العكس",
    "i3": "i3",
    "i8": "i8",
    "m3": "م3",
    "m4": "م4",
    "m5": "م5",
    "m6": "م6",
    "rad 1": "راد 1",
    "rad 1 cabrio": "راد 1 كابريو",
    "rad 1 coupé": "راد 1 كوبيه",
    "rad 2": "راد 2",
    "rad 2 active tourer": "راد 2 تورير نشط",
    "rad 2 coupé": "راد 2 كوبيه",
    "rad 2 gran tourer": "راد 2 جران تورير",
    "rad 3": "راد 3",
    "rad 3 cabrio": "راد 3 كابريو",
    "rad 3 compact": "راد 3 مدمج",
    "rad 3 coupé": "راد 3 كوبيه",
    "rad 3 gt": "راد 3 جي تي",
    "rad 3 touring": "راد 3 بجولة",
    "rad 4": "راد 4",
    "rad 4 cabrio": "راد 4 كابريو",
    "rad 4 gran coupé": "راد 4 غران كوبيه",
    "rad 5": "راد 5",
    "rad 5 gt": "راد 5 جي تي",
    "rad 5 touring": "راد 5 بجولة",
    "rad 6": "راد 6",
    "rad 6 cabrio": "راد 6 كابريو",
    "rad 6 coupé": "راد 6 كوبيه",
    "rad 6 gran coupé": "راد 6 غران كوبيه",
    "rad 7": "راد 7",
    "rad 8 coupé": "راد 8 كوبيه",
    "x1": "×1",
    "x3": "×3",
    "x4": "×4",
    "x5": "×5",
    "x6": "×6",
    "z3": "z3",
    "z3 coupé": "كوبيه z3",
    "z3 roadster": "z3 رودستر",
    "z4": "z4",
    "z4 roadster": "z4 رودستر",
    "amarok": "أمروك",
    "beetle": "خنفساء",
    "bora": "بورا",
    "bora variant": "البديل بورا",
    "caddy": "العلبة",
    "caddy van": "عربة العلبة",
    "life": "حياة",
    "california": "كاليفورنيا",
    "caravelle": "كارافيل",
    "cc": "نسخة",
    "crafter": "Crafter",
    "crafter van": "شاحنة كرافت",
    "crafter kombi": "كرافتر كومبي",
    "crosstouran": "crosstouran",
    "eos": "eos",
    "fox": "ثعلب",
    "golf": "جولف",
    "golf cabrio": "جولف كابريو",
    "golf plus": "جولف بلس",
    "golf sportvan": "سيارة جولف رياضية",
    "golf variant": "البديل للجولف",
    "jetta": "جيتا",
    "lt": "لتر",
    "lupo": "lupo",
    "multivan": "multivan",
    "new beetle": "خنفساء جديدة",
    "new beetle cabrio": "خنفساء كابريو جديدة",
    "passat": "باسات",
    "passat alltrack": "باسات alltrack",
    "passat cc": "باسات سي سي",
    "passat variant": "البديل باسات",
    "passat variant van": "سيارة باسات البديل",
    "phaeton": "السيارة السياحية",
    "polo": "بولو",
    "polo van": "شاحنة البولو",
    "polo variant": "متغير البولو",
    "scirocco": "شيروكو",
    "sharan": "شاران",
    "t4": "t4",
    "t4 caravelle": "t4 كارافيل",
    "t4 multivan": "شاحنة متعددة الأغراض T4",
    "t5": "t5",
    "t5 caravelle": "كارافيل t5",
    "t5 multivan": "شاحنة متعددة الأغراض T5",
    "t5 transporter shuttle": "مكوك النقل T5",
    "tiguan": "تيغوان",
    "touareg": "طوارق",
    "touran": "توران",
    "alto": "ألتو",
    "baleno": "بالينو",
    "baleno kombi": "بالينو كومبي",
    "grand vitara": "جراند فيتارا",
    "grand vitara xl-7": "جراند فيتارا XL-7",
    "ignis": "إشعال",
    "jimny": "جيمني",
    "kizashi": "كيزاشي",
    "liana": "ليانا",
    "samurai": "الساموراي",
    "splash": "دفقة",
    "swift": "سريع",
    "sx4": "sx4",
    "sx4 sedan": "سيدان sx4",
    "vitara": "فيتارا",
    "wagon r+": "عربة ص +",
    "trieda a": "تريدا أ",
    "a": "أ",
    "a l": "ل",
    "amg gt": "ايه ام جي جي تي",
    "trieda b": "تريدا ب",
    "trieda c": "تريدا ج",
    "c": "ج",
    "c sportcoupé": "ج سبورت كوبيه",
    "c t": "ج ر",
    "citan": "سيتان",
    "cl": "cl",
    "cla": "cla",
    "clc": "clc",
    "clk cabrio": "clk كابريو",
    "clk coupé": "clk كوبيه",
    "cls": "cls",
    "trieda e": "تريدا ه",
    "e": "ه",
    "e cabrio": "ه كابريو",
    "e coupé": "ه كوبيه",
    "e t": "ه ر",
    "trieda g": "تريدا ز",
    "g cabrio": "ز كابريو",
    "gl": "gl",
    "gla": "غلا",
    "glc": "glc",
    "gle": "gle",
    "glk": "glk",
    "trieda m": "تريدا م",
    "mb 100": "ميغابايت 100",
    "trieda r": "تريدا ر",
    "trieda s": "تريسا س",
    "s": "س",
    "s coupé": "كوبيه",
    "sl": "sl",
    "slc": "com.slc",
    "slk": "slk",
    "slr": "slr",
    "sprinter": "عداء",
    "a1": "a1",
    "a2": "a2",
    "a3": "a3",
    "a3 cabriolet": "a3 كابريوليه",
    "a3 limuzina": "a3 ليموزينا",
    "a3 sportback": "a3 سبورتباك",
    "a4": "a4",
    "a4 allroad": "a4 على الطرق الوعرة",
    "a4 avant": "a4 أفانت",
    "a4 cabriolet": "a4 كابريوليه",
    "a5": "a5",
    "a5 cabriolet": "a5 كابريوليه",
    "a5 sportback": "a5 سبورتباك",
    "a6": "a6",
    "a6 allroad": "a6 اولرود",
    "a6 avant": "a6 أفانت",
    "a7": "a7",
    "a8": "a8",
    "a8 long": "a8 طويلة",
    "q3": "س3",
    "q5": "س5",
    "q7": "س7",
    "r8": "ص8",
    "rs4 cabriolet": "rs4 كابريوليه",
    "rs4/rs4 avant": "rs4/rs4 أفانت",
    "rs5": "rs5",
    "rs6 avant": "rs6 أفانت",
    "rs7": "rs7",
    "s3/s3 sportback": "S3/S3 سبورتباك",
    "s4 cabriolet": "s4 كابريوليه",
    "s4/s4 avant": "S4/S4 أفانت",
    "s5/s5 cabriolet": "S5/S5 كابريوليه",
    "s6/rs6": "S6/RS6",
    "s7": "S7",
    "s8": "S8",
    "sq5": "sq5",
    "tt coupé": "كوبيه",
    "tt roadster": "tt رودستر",
    "tts": "تحويل النص إلى كلام",
    "avella": "أفيلا",
    "besta": "com.besta",
    "carens": "كارينز",
    "carnival": "كرنفال",
    "cee`d": "cee`d",
    "cee`d sw": "cee`d sw",
    "cerato": "سيراتو",
    "k 2500": "ك 2500",
    "magentis": "أرجواني",
    "opirus": "أوبيروس",
    "optima": "أوبتيما",
    "picanto": "بيكانتو",
    "pregio": "بريجيو",
    "pride": "فخر",
    "pro cee`d": "برو ce`d",
    "rio": "ريو",
    "rio combi": "ريو كومبي",
    "rio sedan": "ريو سيدان",
    "sephia": "سيفيا",
    "shuma": "شوما",
    "sorento": "سورينتو",
    "soul": "روح",
    "sportage": "سبورتاج",
    "venga": "فينجا",
    "defender": "مدافع",
    "discovery": "اكتشاف",
    "discovery sport": "رياضة الاكتشاف",
    "freelander": "فريلاندر",
    "range rover": "رينج روفر",
    "range rover evoque": "رينج روفر إيفوك",
    "range rover sport": "رينج روفر سبورت",
    "avenger": "المنتقم",
    "caliber": "عيار",
    "challenger": "منافس",
    "charger": "شاحن",
    "grand caravan": "القافلة الكبرى",
    "journey": "رحلة",
    "magnum": "ماغنوم",
    "nitro": "نيترو",
    "ram": "كبش",
    "stealth": "خلسة",
    "viper": "الافعى",
    "crossfire": "تبادل لاطلاق النار",
    "grand voyager": "المسافر الكبير",
    "lhs": "lhs",
    "neon": "نيون",
    "pacifica": "باسيفيكا",
    "plymouth": "بليموث",
    "pt cruiser": "بي تي كروزر",
    "sebring": "sebring",
    "sebring convertible": "سيبرينغ للتحويل",
    "stratus": "ستراتوس",
    "stratus cabrio": "ستراتوس كابريو",
    "town & country": "المدينة والبلد",
    "voyager": "مسافر",
    "aerostar": "ايروستار",
    "b-max": "ب-ماكس",
    "c-max": "ج-ماكس",
    "cortina": "كورتينا",
    "cougar": "أسد امريكي",
    "edge": "حافة",
    "escort": "مرافقة",
    "escort cabrio": "مرافقة كابريو",
    "escort kombi": "مرافقة كومبي",
    "explorer": "Explorer",
    "f-150": "f-150",
    "f-250": "f-250",
    "fiesta": "العيد",
    "focus": "ركز",
    "focus c-max": "التركيز ج-ماكس",
    "focus cc": "التركيز سم مكعب",
    "focus kombi": "التركيز كومبي",
    "fusion": "انصهار",
    "galaxy": "galaxy",
    "grand c-max": "جراند سي ماكس",
    "ka": "كا",
    "kuga": "كوجا",
    "maverick": "المنشق",
    "mondeo": "مونديو",
    "mondeo combi": "كومبي مونديو",
    "mustang": "موستانج",
    "orion": "أوريون",
    "puma": "بوما",
    "ranger": "الحارس",
    "s-max": "S-ماكس",
    "sierra": "سلسلة جبلية",
    "street ka": "شارع كا",
    "tourneo connect": "اتصال تورنيو",
    "tourneo custom": "مخصص تورنيو",
    "transit": "عبور",
    "transit bus": "حافلة العبور",
    "transit connect lwb": "اتصال العبور lwb",
    "transit courier": "ساعي العبور",
    "transit custom": "عرف العبور",
    "transit kombi": "عبور كومبي",
    "transit tourneo": "تورنيو العبور",
    "transit valnik": "عبور فالنيك",
    "transit van": "شاحنة العبور",
    "transit van 350": "سيارة النقل 350",
    "windstar": "com.windstar",
    "h2": "h2",
    "h3": "h3",
    "accent": "لهجة",
    "atos": "اتوس",
    "atos prime": "اتوس برايم",
    "coupé": "كوبيه",
    "elantra": "إلنترا",
    "galloper": "عدو",
    "genesis": "منشأ",
    "getz": "جيتز",
    "grandeur": "عظمة",
    "h 350": "ح 350",
    "h1": "h1",
    "h1 bus": "حافلة h1",
    "h1 van": "شاحنة h1",
    "h200": "h200",
    "i10": "أنا 10",
    "i20": "i20",
    "i30": "i30",
    "i30 cw": "i30 سو",
    "i40": "i40",
    "i40 cw": "i40 سو",
    "ix20": "تاسعا20",
    "ix35": "تاسعا35",
    "ix55": "ix55",
    "lantra": "لانترا",
    "matrix": "مصفوفة",
    "santa fe": "سانتا في",
    "sonata": "سوناتا",
    "terracan": "تيراكان",
    "trajet": "com.trajet",
    "tucson": "توكسون",
    "veloster": "veloster",
    "ex": "السابق",
    "fx": "fx",
    "g": "ز",
    "g coupé": "ز كوبيه",
    "m": "م",
    "q": "س",
    "qx": "qx",
    "daimler": "دايملر",
    "f-pace": "f-pace",
    "f-type": "نوع f",
    "s-type": "النوع S",
    "sovereign": "سيادة",
    "x-type": "نوع x",
    "x-type estate": "العقارات من النوع X",
    "xe": "xe",
    "xf": "xf",
    "xj": "xj",
    "xj12": "xj12",
    "xj6": "xj6",
    "xj8": "xj8",
    "xjr": "xjr",
    "xk": "xk",
    "xk8 convertible": "xk8 قابلة للتحويل",
    "xkr": "xkr",
    "xkr convertible": "XKR قابلة للتحويل",
    "cherokee": "شيروكي",
    "commander": "القائد",
    "compass": "بوصلة",
    "grand cherokee": "جراند شيروكي",
    "patriot": "وطني",
    "renegade": "المنشق",
    "wrangler": "رانجلر",
    "almera": "الميرا",
    "almera tino": "ألميرا تينو",
    "cabstar e - t": "كابستار ه - ر",
    "cabstar tl2 valnik": "كابستار tl2 فالنيك",
    "e-nv200": "e-nv200",
    "gt-r": "جي تي آر",
    "insterstar": "com.insterstar",
    "juke": "جوك",
    "king cab": "كابينة الملك",
    "leaf": "ورقة",
    "maxima": "ماكسيما",
    "maxima qx": "ماكسيما كيو اكس",
    "micra": "ميكرا",
    "murano": "مورانو",
    "navara": "نافارا",
    "note": "ملحوظة",
    "np300 pickup": "لاقط np300",
    "nv200": "nv200",
    "nv400": "nv400",
    "pathfinder": "باثفايندر",
    "patrol": "دورية",
    "patrol gr": "دورية غرام",
    "pickup": "يلتقط",
    "pixo": "com.pixo",
    "primastar": "com.primastar",
    "primastar combi": "combi",
    "primera": "بريميرا",
    "primera combi": "كومبي الأول",
    "pulsar": "النجم النابض",
    "qashqai": "قاشقاي",
    "serena": "سيرينا",
    "sunny": "مشمس",
    "terrano": "تيرانو",
    "tiida": "تيدا",
    "trade": "تجارة",
    "vanette cargo": "البضائع فانيت",
    "x-trail": "x-trail",
    "c30": "ج30",
    "c70": "ج70",
    "c70 cabrio": "c70 كابريو",
    "c70 coupé": "كوبيه c70",
    "s40": "s40",
    "s60": "s60",
    "s70": "s70",
    "s80": "s80",
    "s90": "s90",
    "v40": "الإصدار 40",
    "v50": "v50",
    "v60": "v60",
    "v70": "v70",
    "v90": "v90",
    "xc60": "xc60",
    "xc70": "xc70",
    "xc90": "xc90",
    "espero": "اسبيرو",
    "lanos": "لانوس",
    "leganza": "ليجانزا",
    "lublin": "لوبلين",
    "nexia": "نكسيا",
    "nubira kombi": "نوبيرا كومبي",
    "racer": "متسابق",
    "tico": "تيكو",
    "barchetta": "بارشيتا",
    "brava": "برافا",
    "cinquecento": "سينكوسينتو",
    "croma": "كروما",
    "doblo": "دوبلو",
    "doblo cargo": "البضائع دوبلو",
    "doblo cargo combi": "كومبي البضائع دوبلو",
    "ducato": "دوكاتو",
    "ducato van": "دوكاتو فان",
    "ducato kombi": "دوكاتو كومبي",
    "ducato podvozok": "دوكاتو بودفوزوك",
    "florino": "فلورينو",
    "florino combi": "كومبي فلورينو",
    "freemont": "فريمونت",
    "grande punto": "بونتو الكبير",
    "idea": "فكرة",
    "linea": "لينيا",
    "marea": "ماريا",
    "marea weekend": "ماريا نهاية الأسبوع",
    "multipla": "multipla",
    "palio weekend": "عطلة نهاية الأسبوع باليو",
    "panda": "الباندا",
    "panda van": "شاحنة الباندا",
    "punto": "بونتو",
    "punto cabriolet": "بونتو كابريوليه",
    "punto evo": "بونتو إيفو",
    "punto van": "بونتو فان",
    "qubo": "qubo",
    "scudo": "سكودو",
    "scudo van": "شاحنة سكودو",
    "scudo kombi": "سكودو كومبي",
    "sedici": "سيديسي",
    "seicento": "seicento",
    "stilo": "ستيلو",
    "stilo multiwagon": "ستيلو متعددة العربات",
    "strada": "Strada",
    "talento": "تالنتو",
    "tipo": "تيبو",
    "ulysse": "أوليس",
    "uno": "com.uno",
    "x1/9": "×1/9",
    "cooper": "كوبر",
    "cooper cabrio": "كوبر كابريو",
    "cooper clubman": "كوبر كلوبمان",
    "cooper d": "كوبر د",
    "cooper d clubman": "كوبر د كلوبمان",
    "cooper s": "كوبر س",
    "cooper s cabrio": "كوبر كابريو",
    "cooper s clubman": "كوبر كلوبمان",
    "countryman": "مواطن",
    "mini one": "واحدة صغيرة",
    "one d": "واحد د",
    "cabrio": "كابريو",
    "city-coupé": "مدينة كوبيه",
    "compact pulse": "نبض مدمج",
    "forfour": "لأربعة",
    "fortwo cabrio": "فورتو كابريو",
    "fortwo coupé": "فورتو كوبيه",
    "roadster": "رودستر"
}

Neo.Locales.fr = {
    ...Neo.Locales.fr,

    "pending": "en attente",
    "completed": "terminé",
    "Prev": "Précédent",
    "Next": "Suivant",
    "Total": "Total",
    "Charges": "Charges",
    "Payments": "Paiements",
    "Creances": "Créances",
    "Vehicle": "Véhicule",
    "Mileage": "Kilométrage",
    "Km": "Km",
    "Period": "Période",
    "Days": "Jours",
    "First Name": "Prénom",
    "Last Name": "Nom de famille",
    "Gender": "Genre",
    "Birth Date": "Date de naissance",
    "Email": "E-mail",
    "Phone": "Téléphone",
    "Address": "Adresse",
    "Actions": "Actions",
    "Full Name": "Nom et prénom",
    "Nationality": "Nationalité",
    "Identity": "Identité",
    "Identity Type": "Type d'identité",
    "License Number": "Numéro de licence",
    "BlackList": "Liste noire",
    "Ref": "Réf",
    "From": "Depuis",
    "Pick-up Location": "Lieu de ramassage",
    "To": "À",
    "Drop-off Location": "Point de chute",
    "Price": "Prix",
    "Payment": "Paiement",
    "Creance": "Créance",
    "Starting Mileage": "Kilométrage de départ",
    "Return Mileage": "Kilométrage de retour",
    "Fuel": "Carburant",
    "Status": "Statut",
    "Client": "Client",
    "Details": "Détails",
    "Circulation Date": "Date de diffusion",
    "Horse Power": "Puissance en chevaux",
    "Horse Power Tax": "Taxe sur la puissance cheval-vapeur",
    "Insurance": "Assurance",
    "Insurance Cost": "Cout d'assurance",
    "Transmission": "Transmission",
    "Passengers": "Passagers",
    "Doors": "Des portes",
    "Cargo": "Cargaison",
    "Name": "Nom",
    "Cost": "Coût",
    "Consumable": "Consommable",
    "Recurrence": "Récurrence",
    "Threshold": "Seuil",
    "Hour": "Heure",
    "Next Recurrence": "Récurrence suivante",
    "Reservation": "Réservation",
    "male": "mâle",
    "female": "femelle",
    "week": "semaine",
    "month": "mois",
    "year": "année",
    "cin": "cin",
    "visa": "visa",
    "passport": "passeport",
    "residence permit": "permis de résidence",
    "manual": "manuel",
    "automatic": "automatique",
    "gasoline": "de l'essence",
    "diesel": "diesel",
    "gasoline hybrid": "hybride essence",
    "diesel hybrid": "hybride diesel",
    "less than 8 cv": "moins de 8 cv",
    "between 8 and 10 cv": "entre 8 et 10 cv",
    "between 11 and 14 cv": "entre 11 et 14 cv",
    "grather than or equals to 15 cv": "supérieur ou égal à 15 cv",
    "mileage": "kilométrage",
    "casablanca": "casablanca",
    "rabat": "rabat",
    "fez": "fez",
    "marrakesh": "marrakech",
    "agadir": "agadir",
    "tangier": "tanger",
    "meknes": "meknès",
    "oujda": "oujda",
    "kenitra": "kénitra",
    "tetouan": "tétouan",
    "safi": "safi",
    "mohammedia": "mohammédia",
    "khouribga": "khouribga",
    "el jadida": "el-jadida",
    "nador": "nador",
    "beni mellal": "beni mellal",
    "khemisset": "khémisset",
    "larache": "larache",
    "ksar el kebir": "ksar el kébir",
    "settat": "settat",
    "sidi kacem": "sidi kacem",
    "temara": "témara",
    "berrechid": "berrechid",
    "oued zem": "oued zem",
    "fquih ben salah": "fquih ben salah",
    "taroudant": "taroudant",
    "ouarzazate": "ouarzazate",
    "dakhla": "dakhla",
    "guelmim": "guelmim",
    "laayoune": "laâyoune",
    "scrtaches": "rayures",
    "cracks": "fissures",
    "dents": "bosses",
    "afghan": "afghan",
    "albanian": "albanais",
    "algerian": "algérien",
    "american": "américain",
    "andorran": "andorran",
    "angolan": "angolais",
    "anguillan": "anguillan",
    "citizen of antigua and barbuda": "citoyen d'antigua-et-barbuda",
    "argentine": "argentin",
    "armenian": "arménien",
    "australian": "australien",
    "austrian": "autrichien",
    "azerbaijani": "azerbaïdjanais",
    "bahamian": "bahaméen",
    "bahraini": "bahreïn",
    "bangladeshi": "bangladais",
    "barbadian": "barbadien",
    "belarusian": "biélorusse",
    "belgian": "belge",
    "belizean": "bélizien",
    "beninese": "béninois",
    "bermudian": "bermudien",
    "bhutanese": "bhoutanais",
    "bolivian": "bolivien",
    "citizen of bosnia and herzegovina": "citoyen de bosnie-herzégovine",
    "botswanan": "botswana",
    "brazilian": "brésilien",
    "british": "britanique",
    "british virgin islander": "île vierge britannique",
    "bruneian": "bruneien",
    "bulgarian": "bulgare",
    "burkinan": "burkinabé",
    "burmese": "birman",
    "burundian": "burundais",
    "cambodian": "cambodgien",
    "cameroonian": "camerounais",
    "canadian": "canadien",
    "cape verdean": "cap-verdien",
    "cayman islander": "habitant des îles caïmans",
    "central african": "afrique centrale",
    "chadian": "tchadien",
    "chilean": "chilien",
    "chinese": "chinois",
    "colombian": "colombien",
    "comoran": "comorien",
    "congolese (congo)": "congolais (congo)",
    "congolese (drc)": "congolais (rdc)",
    "cook islander": "cuisinier insulaire",
    "costa rican": "costaricain",
    "croatian": "croate",
    "cuban": "cubain",
    "cymraes": "cymraes",
    "cymro": "cymro",
    "cypriot": "chypriote",
    "czech": "tchèque",
    "danish": "danois",
    "djiboutian": "djiboutien",
    "dominican": "dominicain",
    "citizen of the dominican republic": "citoyen de la république dominicaine",
    "dutch": "néerlandais",
    "east timorese": "timor oriental",
    "ecuadorean": "équatorien",
    "egyptian": "égyptien",
    "emirati": "émirati",
    "english": "anglais",
    "equatorial guinean": "guinée équatoriale",
    "eritrean": "érythréen",
    "estonian": "estonien",
    "ethiopian": "éthiopien",
    "faroese": "féroïen",
    "fijian": "fidjien",
    "filipino": "philippin",
    "finnish": "finlandais",
    "french": "français",
    "gabonese": "gabonais",
    "gambian": "gambien",
    "georgian": "géorgien",
    "german": "allemand",
    "ghanaian": "ghanéen",
    "gibraltarian": "gibraltarien",
    "greek": "grec",
    "greenlandic": "groenlandais",
    "grenadian": "grenadien",
    "guamanian": "guamanien",
    "guatemalan": "guatémaltèque",
    "citizen of guinea-bissau": "citoyen de guinée-bissau",
    "guinean": "guinéen",
    "guyanese": "guyanais",
    "haitian": "haïtien",
    "honduran": "hondurien",
    "hong konger": "hong kong",
    "hungarian": "hongrois",
    "icelandic": "islandais",
    "indian": "indien",
    "indonesian": "indonésien",
    "iranian": "iranien",
    "iraqi": "irakien",
    "irish": "irlandais",
    "israeli": "israélien",
    "italian": "italien",
    "ivorian": "ivoirien",
    "jamaican": "jamaïquain",
    "japanese": "japonais",
    "jordanian": "jordanien",
    "kazakh": "kazakh",
    "kenyan": "kenyan",
    "kittitian": "kittitien",
    "citizen of kiribati": "citoyen de kiribati",
    "kosovan": "kosovare",
    "kuwaiti": "koweïtien",
    "kyrgyz": "kirghize",
    "lao": "laotien",
    "latvian": "letton",
    "lebanese": "libanais",
    "liberian": "libérien",
    "libyan": "libyen",
    "liechtenstein citizen": "citoyen du liechtenstein",
    "lithuanian": "lituanien",
    "luxembourger": "luxembourgeois",
    "macanese": "macanais",
    "macedonian": "macédonien",
    "malagasy": "malgache",
    "malawian": "malawien",
    "malaysian": "malaisien",
    "maldivian": "maldivien",
    "malian": "malien",
    "maltese": "maltais",
    "marshallese": "marshallais",
    "martiniquais": "martiniquais",
    "mauritanian": "mauritanien",
    "mauritian": "mauricien",
    "mexican": "mexicain",
    "micronesian": "micronésien",
    "moldovan": "moldave",
    "monegasque": "monégasque",
    "mongolian": "mongol",
    "montenegrin": "monténégrin",
    "montserratian": "montserratien",
    "moroccan": "marocain",
    "mosotho": "mosotho",
    "mozambican": "mozambicain",
    "namibian": "namibien",
    "nauruan": "nauruan",
    "nepalese": "népalais",
    "new zealander": "néo-zélandais",
    "nicaraguan": "nicaraguayen",
    "nigerian": "nigérian",
    "nigerien": "nigérien",
    "niuean": "niuéen",
    "north korean": "nord coréen",
    "northern irish": "irlandais du nord",
    "norwegian": "norvégien",
    "omani": "omanais",
    "pakistani": "pakistanais",
    "palauan": "palaos",
    "palestinian": "palestinien",
    "panamanian": "panaméen",
    "papua new guinean": "papouasie nouvelle guinée",
    "paraguayan": "paraguayen",
    "peruvian": "péruvien",
    "pitcairn islander": "insulaire de pitcairn",
    "polish": "polonais",
    "portuguese": "portugais",
    "prydeinig": "prydeinig",
    "puerto rican": "portoricain",
    "qatari": "qatar",
    "romanian": "roumain",
    "russian": "russe",
    "rwandan": "rwandais",
    "salvadorean": "salvadorien",
    "sammarinese": "saint-marinais",
    "samoan": "samoan",
    "sao tomean": "sao tomé-et-principe",
    "saudi arabian": "arabie saoudite",
    "scottish": "écossais",
    "senegalese": "sénégalais",
    "serbian": "serbe",
    "citizen of seychelles": "citoyen des seychelles",
    "sierra leonean": "sierra léonais",
    "singaporean": "singapourien",
    "slovak": "slovaque",
    "slovenian": "slovène",
    "solomon islander": "insulaire salomon",
    "somali": "somali",
    "south african": "sud africain",
    "south korean": "sud coréen",
    "south sudanese": "sud-soudanais",
    "spanish": "espagnol",
    "sri lankan": "sri lankais",
    "st helenian": "saint-hélène",
    "st lucian": "sainte-lucie",
    "stateless": "apatride",
    "sudanese": "soudanais",
    "surinamese": "surinamien",
    "swazi": "swazi",
    "swedish": "suédois",
    "swiss": "suisse",
    "syrian": "syrien",
    "taiwanese": "taïwanais",
    "tajik": "tadjik",
    "tanzanian": "tanzanien",
    "thai": "thaïlandais",
    "togolese": "togolais",
    "tongan": "tonguien",
    "trinidadian": "trinidadien",
    "tristanian": "tristanien",
    "tunisian": "tunisien",
    "turkish": "turc",
    "turkmen": "turkmènes",
    "turks and caicos islander": "insulaire des îles turques et caïques",
    "tuvaluan": "tuvaluan",
    "ugandan": "ougandais",
    "ukrainian": "ukrainien",
    "uruguayan": "uruguayen",
    "uzbek": "ouzbek",
    "vatican citizen": "citoyen du vatican",
    "citizen of vanuatu": "citoyen du vanuatu",
    "venezuelan": "vénézuélien",
    "vietnamese": "vietnamien",
    "vincentian": "vincentien",
    "wallisian": "wallisien",
    "welsh": "gallois",
    "yemeni": "yéménite",
    "zambian": "zambien",
    "zimbabwean": "zimbabwéen",
    "fluids": "fluides",
    "filters": "filtres",
    "belts and hoses": "courroies et durites",
    "tires and brakes": "pneus et freins",
    "battery and electrical": "batterie et électrique",
    "additional items": "eléments supplémentaires",
    "other": "autre",
    "seat": "siège",
    "renault": "renault",
    "peugeot": "peugeot",
    "dacia": "dacia",
    "citroën": "citroën",
    "opel": "opel",
    "alfa romeo": "alfa romeo",
    "škoda": "skoda",
    "chevrolet": "chevrolet",
    "porsche": "porsche",
    "honda": "honda",
    "subaru": "subaru",
    "mazda": "mazda",
    "mitsubishi": "mitsubishi",
    "lexus": "lexus",
    "toyota": "toyota",
    "bmw": "bmw",
    "volkswagen": "volkswagen",
    "suzuki": "suzuki",
    "mercedes-benz": "mercedes benz",
    "saab": "saab",
    "audi": "audi",
    "kia": "kia",
    "land rover": "land rover",
    "dodge": "esquiver",
    "chrysler": "chrysler",
    "ford": "gué",
    "hummer": "hummer",
    "hyundai": "hyundai",
    "infiniti": "infini",
    "jaguar": "jaguar",
    "jeep": "jeep",
    "nissan": "nissan",
    "volvo": "volvo",
    "daewoo": "daewoo",
    "fiat": "décret",
    "mini": "mini",
    "rover": "vagabond",
    "smart": "intelligent",
    "engine oil": "huile moteur",
    "transmission fluid": "transmission fluide",
    "brake fluid": "liquide de frein",
    "coolant": "liquide de refroidissement",
    "power steering fluid": "liquide de direction assistée",
    "differential fluid": "fluide différentiel",
    "engine filter": "filtre moteur",
    "air filter": "filtre à air",
    "cabin air filter": "filtre à air d'habitacle",
    "fuel filter": "filtre à carburant",
    "timing belt": "courroie de distribution",
    "serpentine belt": "ceinture serpentine",
    "hoses": "tuyaux",
    "tires": "pneus",
    "brake pads and rotors": "plaquettes et disques de frein",
    "wheel alignment": "alignement des roues",
    "battery": "batterie",
    "spark plugs": "bougies",
    "ignition coils": "bobines d'allumage",
    "wiper blades": "balais d'essuie-glace",
    "lights": "lumières",
    "exhaust system": "système d'échappement",
    "suspension components": "composants de suspension",
    "insurance": "assurance",
    "taxes": "impôts",
    "alhambra": "alhambra",
    "altea": "altea",
    "altea xl": "altea xl",
    "arosa": "arosa",
    "cordoba": "cordoue",
    "cordoba vario": "cordoue vario",
    "exeo": "exéo",
    "ibiza": "ibiza",
    "ibiza st": "rue ibiza",
    "exeo st": "exéo st",
    "leon": "léon",
    "leon st": "léon st",
    "inca": "inca",
    "mii": "mii",
    "toledo": "tolède",
    "captur": "capturer",
    "clio": "clio",
    "clio grandtour": "clio grandtour",
    "espace": "espace",
    "express": "exprimer",
    "fluence": "influence",
    "grand espace": "grand espace",
    "grand modus": "grand mode",
    "grand scenic": "grand paysage",
    "kadjar": "kadjar",
    "kangoo": "kangoo",
    "kangoo express": "kangoo express",
    "koleos": "koléos",
    "laguna": "lagune",
    "laguna grandtour": "grand tour de la lagune",
    "latitude": "latitude",
    "mascott": "mascotte",
    "mégane": "mégane",
    "mégane cc": "mégane cc",
    "mégane combi": "mégane combi",
    "mégane grandtour": "mégane grandtour",
    "mégane coupé": "mégane coupé",
    "mégane scénic": "mégane scénic",
    "scénic": "scénique",
    "talisman": "talisman",
    "talisman grandtour": "grand tour du talisman",
    "thalia": "thalie",
    "twingo": "twingo",
    "wind": "vent",
    "zoé": "zoé",
    "bipper": "bipper",
    "rcz": "rcz",
    "dokker": "dokker",
    "duster": "plumeau",
    "lodgy": "logé",
    "logan": "logan",
    "logan mcv": "logan mcv",
    "logan van": "camionnette logan",
    "sandero": "sandéro",
    "solenza": "solenza",
    "berlingo": "berlingo",
    "c-crosser": "c-crosser",
    "c-elissée": "c-elissée",
    "c-zero": "c-zéro",
    "c1": "c1",
    "c2": "c2",
    "c3": "c3",
    "c3 picasso": "c3 picasso",
    "c4": "c4",
    "c4 aircross": "c4 air cross",
    "c4 cactus": "cactus c4",
    "c4 coupé": "c4 coupé",
    "c4 grand picasso": "c4 grand picasso",
    "c4 sedan": "berline c4",
    "c5": "c5",
    "c5 break": "pause c5",
    "c5 tourer": "c5 tourer",
    "c6": "c6",
    "c8": "c8",
    "ds3": "ds3",
    "ds4": "ds4",
    "ds5": "ds5",
    "evasion": "évasion",
    "jumper": "sauteur",
    "jumpy": "nerveux",
    "saxo": "saxo",
    "nemo": "némo",
    "xantia": "xantia",
    "xsara": "xsara",
    "agila": "agila",
    "ampera": "ampère",
    "antara": "antara",
    "astra": "astre",
    "astra cabrio": "astra cabriolet",
    "astra caravan": "caravane astra",
    "astra coupé": "astra coupé",
    "calibra": "calibrer",
    "campo": "camp",
    "cascada": "cascade",
    "corsa": "corse",
    "frontera": "frontière",
    "insignia": "insigne",
    "insignia kombi": "insigne kombi",
    "kadett": "kadett",
    "meriva": "meriva",
    "mokka": "mokka",
    "movano": "movano",
    "omega": "oméga",
    "signum": "signum",
    "vectra": "vecteur",
    "vectra caravan": "caravane vectra",
    "vivaro": "vivaro",
    "vivaro kombi": "vivaro combi",
    "zafira": "zafira",
    "brera": "brera",
    "gtv": "gtv",
    "mito": "mito",
    "crosswagon": "crosswagon",
    "spider": "araignée",
    "gt": "gt",
    "giulietta": "giulietta",
    "giulia": "giulia",
    "favorit": "favori",
    "felicia": "félicia",
    "citigo": "citigo",
    "fabia": "fabia",
    "fabia combi": "combi fabia",
    "fabia sedan": "berline fabia",
    "felicia combi": "combi félicia",
    "octavia": "octavie",
    "octavia combi": "octavia combi",
    "roomster": "colocataire",
    "yeti": "yéti",
    "rapid": "rapide",
    "rapid spaceback": "retour spatial rapide",
    "superb": "superbe",
    "superb combi": "superbe combi",
    "alero": "aléro",
    "aveo": "avéo",
    "camaro": "camaro",
    "captiva": "captivant",
    "corvette": "corvette",
    "cruze": "cruze",
    "cruze sw": "cruze sw",
    "epica": "épique",
    "equinox": "équinoxe",
    "evanda": "evanda",
    "hhr": "hhr",
    "kalos": "kalos",
    "lacetti": "lacetti",
    "lacetti sw": "lacetti sw",
    "lumina": "lumière",
    "malibu": "malibu",
    "matiz": "matiz",
    "monte carlo": "monte carlo",
    "nubira": "nubie",
    "orlando": "orlando",
    "spark": "étincelle",
    "suburban": "de banlieue",
    "tacuma": "tacuma",
    "tahoe": "tahoe",
    "trax": "trax",
    "boxster": "boxeur",
    "cayenne": "cayenne",
    "cayman": "caïman",
    "macan": "macan",
    "panamera": "panamera",
    "accord": "accord",
    "accord coupé": "accord coupé",
    "accord tourer": "accord tourer",
    "city": "ville",
    "civic": "civique",
    "civic aerodeck": "aérodrome civique",
    "civic coupé": "coupé civique",
    "civic tourer": "voiture de tourisme civique",
    "civic type r": "type civique r",
    "cr-v": "cr-v",
    "cr-x": "cr-x",
    "cr-z": "cr-z",
    "fr-v": "fr-v",
    "hr-v": "h-v",
    "insight": "aperçu",
    "integra": "intégrer",
    "jazz": "le jazz",
    "legend": "légende",
    "prelude": "prélude",
    "brz": "brz",
    "forester": "forestier",
    "impreza": "impreza",
    "impreza wagon": "wagon impreza",
    "justy": "justy",
    "legacy": "héritage",
    "legacy wagon": "wagon d'héritage",
    "legacy outback": "héritage de l'arrière-pays",
    "levorg": "levorg",
    "outback": "arrière-pays",
    "svx": "svx",
    "tribeca": "tribuca",
    "tribeca b9": "tribuca b9",
    "xv": "xv",
    "b-fighter": "b-combattant",
    "b2500": "b2500",
    "bt": "bt",
    "cx-3": "cx-3",
    "cx-5": "cx-5",
    "cx-7": "cx-7",
    "cx-9": "cx-9",
    "demio": "demio",
    "mpv": "monospace",
    "mx-3": "mx-3",
    "mx-5": "mx-5",
    "mx-6": "mx-6",
    "premacy": "prématurité",
    "rx-7": "rx-7",
    "rx-8": "rx-8",
    "xedox 6": "xédox 6",
    "asx": "asx",
    "carisma": "carisme",
    "colt": "poulain",
    "colt cc": "poulain cc",
    "eclipse": "éclipse",
    "fuso canter": "galop fuso",
    "galant": "galant",
    "galant combi": "combi galant",
    "grandis": "grandiose",
    "l200": "l200",
    "l200 pick up": "l200 ramasser",
    "l200 pick up allrad": "l200 ramasser allrad",
    "l300": "l300",
    "lancer": "lancier",
    "lancer combi": "lancer combi",
    "lancer evo": "lancer evo",
    "lancer sportback": "lancer sportback",
    "outlander": "étranger",
    "pajero": "pajero",
    "pajeto pinin": "pajeto pinin",
    "pajero pinin wagon": "pajero pinin wagon",
    "pajero sport": "pajero sport",
    "pajero wagon": "pajero familiale",
    "space star": "étoile de l'espace",
    "ct": "côté",
    "gs": "gs",
    "gs 300": "gs300",
    "gx": "gx",
    "is": "est",
    "is 200": "est 200",
    "is 250 c": "soit 250c",
    "is-f": "est-f",
    "ls": "ls",
    "lx": "lx",
    "nx": "nx",
    "rc f": "rc-f",
    "rx": "rx",
    "rx 300": "rx300",
    "rx 400h": "rx400h",
    "rx 450h": "rx450h",
    "sc 430": "sc 430",
    "auris": "auris",
    "avensis": "avensis",
    "avensis combi": "avensis combi",
    "avensis van verso": "avensis du verso",
    "aygo": "oui",
    "camry": "camry",
    "carina": "carine",
    "celica": "célica",
    "corolla": "corolle",
    "corolla combi": "corolle combi",
    "corolla sedan": "berline corolle",
    "corolla verso": "corolle verso",
    "fj cruiser": "croiseur fj",
    "gt86": "gt86",
    "hiace": "hiace",
    "hiace van": "fourgon hiace",
    "highlander": "montagnard",
    "hilux": "hilux",
    "land cruiser": "croiseur terrestre",
    "mr2": "mr2",
    "paseo": "paseo",
    "picnic": "pique-nique",
    "prius": "prius",
    "rav4": "rav4",
    "sequoia": "séquoia",
    "starlet": "starlette",
    "supra": "supra",
    "tundra": "toundra",
    "urban cruiser": "croiseur urbain",
    "verso": "verso",
    "yaris": "yaris",
    "yaris verso": "yaris verso",
    "i3": "i3",
    "i8": "i8",
    "m3": "m3",
    "m4": "m4",
    "m5": "m5",
    "m6": "m6",
    "rad 1": "rad 1",
    "rad 1 cabrio": "rad 1 cabriolet",
    "rad 1 coupé": "rad1 coupé",
    "rad 2": "rad 2",
    "rad 2 active tourer": "rad 2 tourer actif",
    "rad 2 coupé": "rad 2 coupé",
    "rad 2 gran tourer": "rad 2 gran tourer",
    "rad 3": "rayon 3",
    "rad 3 cabrio": "rad 3 cabriolet",
    "rad 3 compact": "rad 3 compact",
    "rad 3 coupé": "rad 3 coupé",
    "rad 3 gt": "rad 3 gt",
    "rad 3 touring": "rad 3 en tournée",
    "rad 4": "rayon 4",
    "rad 4 cabrio": "rad 4 cabriolet",
    "rad 4 gran coupé": "rad 4 grand coupé",
    "rad 5": "rayon 5",
    "rad 5 gt": "rad 5 gt",
    "rad 5 touring": "rad 5 en tournée",
    "rad 6": "rayon 6",
    "rad 6 cabrio": "rad 6 cabriolet",
    "rad 6 coupé": "rad 6 coupé",
    "rad 6 gran coupé": "rad 6 grand coupé",
    "rad 7": "rayon 7",
    "rad 8 coupé": "rad 8 coupé",
    "x1": "x1",
    "x3": "x3",
    "x4": "x4",
    "x5": "x5",
    "x6": "x6",
    "z3": "z3",
    "z3 coupé": "coupé z3",
    "z3 roadster": "roadster z3",
    "z4": "z4",
    "z4 roadster": "roadster z4",
    "amarok": "amarok",
    "beetle": "scarabée",
    "bora": "bora",
    "bora variant": "variante bora",
    "caddy": "caddie",
    "caddy van": "fourgon caddie",
    "life": "vie",
    "california": "californie",
    "caravelle": "caravelle",
    "cc": "cc",
    "crafter": "artisan",
    "crafter van": "fourgon artisanal",
    "crafter kombi": "combi crafter",
    "crosstouran": "crosstouran",
    "eos": "éos",
    "fox": "renard",
    "golf": "le golf",
    "golf cabrio": "cabriolet de golf",
    "golf plus": "golf plus",
    "golf sportvan": "fourgonnette de golf",
    "golf variant": "variante de golf",
    "jetta": "jetta",
    "lt": "lt",
    "lupo": "lupo",
    "multivan": "multifourgon",
    "new beetle": "new beetle",
    "new beetle cabrio": "new beetle cabriolet",
    "passat": "passat",
    "passat alltrack": "passat alltrack",
    "passat cc": "passat cc",
    "passat variant": "variante passat",
    "passat variant van": "variante passat fourgonnette",
    "phaeton": "phaéton",
    "polo": "polo",
    "polo van": "camionnette polo",
    "polo variant": "variante de polo",
    "scirocco": "scirocco",
    "sharan": "sharan",
    "t4": "t4",
    "t4 caravelle": "t4 caravelle",
    "t4 multivan": "fourgon t4",
    "t5": "t5",
    "t5 caravelle": "caravelle t5",
    "t5 multivan": "fourgon t5",
    "t5 transporter shuttle": "navette de transport t5",
    "tiguan": "tiguan",
    "touareg": "touareg",
    "touran": "touran",
    "alto": "alto",
    "baleno": "balène",
    "baleno kombi": "combi baleno",
    "grand vitara": "grand vitara",
    "grand vitara xl-7": "grand vitara xl-7",
    "ignis": "ignis",
    "jimny": "jimmy",
    "kizashi": "kizashi",
    "liana": "liane",
    "samurai": "samouraï",
    "splash": "éclaboussure",
    "swift": "rapide",
    "sx4": "sx4",
    "sx4 sedan": "berline sx4",
    "vitara": "vitara",
    "wagon r+": "wagon r+",
    "trieda a": "j'ai essayé un",
    "a": "un",
    "a l": "al",
    "amg gt": "amg gt",
    "trieda b": "j'ai essayé b",
    "trieda c": "essayé c",
    "c": "c",
    "c sportcoupé": "c sportcoupé",
    "c t": "c t",
    "citan": "citan",
    "cl": "cl",
    "cla": "cla",
    "clc": "clc",
    "clk cabrio": "clk cabriolet",
    "clk coupé": "clk coupé",
    "cls": "cls",
    "trieda e": "j'ai essayé",
    "e": "e",
    "e cabrio": "le cabriolet",
    "e coupé": "le coupé",
    "e t": "et",
    "trieda g": "j'ai essayé g",
    "g cabrio": "g cabriolet",
    "gl": "gl",
    "gla": "gla",
    "glc": "glc",
    "gle": "gle",
    "glk": "glk",
    "trieda m": "j'ai essayé m",
    "mb 100": "mo 100",
    "trieda r": "essayé r",
    "trieda s": "j'ai essayé",
    "s": "s",
    "s coupé": "le coupé",
    "sl": "sl",
    "slc": "slc",
    "slk": "slk",
    "slr": "reflex",
    "sprinter": "sprinter",
    "a1": "a1",
    "a2": "a2",
    "a3": "a3",
    "a3 cabriolet": "a3 cabriolet",
    "a3 limuzina": "a3 limuzine",
    "a3 sportback": "a3 sportback",
    "a4": "a4",
    "a4 allroad": "a4 allroad",
    "a4 avant": "a4 avant",
    "a4 cabriolet": "cabriolet a4",
    "a5": "a5",
    "a5 cabriolet": "a5 cabriolet",
    "a5 sportback": "a5 sportback",
    "a6": "a6",
    "a6 allroad": "a6 allroad",
    "a6 avant": "a6 avant",
    "a7": "a7",
    "a8": "a8",
    "a8 long": "a8 long",
    "q3": "q3",
    "q5": "q5",
    "q7": "q7",
    "r8": "r8",
    "rs4 cabriolet": "rs4 cabriolet",
    "rs4/rs4 avant": "rs4/rs4 avant",
    "rs5": "rs5",
    "rs6 avant": "rs6 avant",
    "rs7": "rs7",
    "s3/s3 sportback": "s3/s3 sportback",
    "s4 cabriolet": "cabriolet s4",
    "s4/s4 avant": "s4/s4 avant",
    "s5/s5 cabriolet": "cabriolet s5/s5",
    "s6/rs6": "s6/rs6",
    "s7": "s7",
    "s8": "s8",
    "sq5": "sq5",
    "tt coupé": "tt coupé",
    "tt roadster": "roadster",
    "tts": "tts",
    "avella": "avelle",
    "besta": "meilleure",
    "carens": "carens",
    "carnival": "carnaval",
    "cee`d": "cee`d",
    "cee`d sw": "cee`d sw",
    "cerato": "cérat",
    "k 2500": "2500 k",
    "magentis": "magentis",
    "opirus": "opirus",
    "optima": "optimale",
    "picanto": "picanto",
    "pregio": "prégio",
    "pride": "fierté",
    "pro cee`d": "procédé",
    "rio": "rio",
    "rio combi": "combi rio",
    "rio sedan": "berline rio",
    "sephia": "séphia",
    "shuma": "chouma",
    "sorento": "sorento",
    "soul": "âme",
    "sportage": "sportage",
    "venga": "venga",
    "defender": "défenseur",
    "discovery": "découverte",
    "discovery sport": "sport découverte",
    "freelander": "freelander",
    "range rover": "range rover",
    "range rover evoque": "range rover evoque",
    "range rover sport": "range rover sport",
    "avenger": "vengeur",
    "caliber": "calibre",
    "challenger": "challenger",
    "charger": "chargeur",
    "grand caravan": "grande caravane",
    "journey": "voyage",
    "magnum": "magnum",
    "nitro": "nitro",
    "ram": "ram",
    "stealth": "furtivité",
    "viper": "vipère",
    "crossfire": "feux croisés",
    "grand voyager": "grand voyageur",
    "lhs": "lhs",
    "neon": "néon",
    "pacifica": "pacifique",
    "plymouth": "plymouth",
    "pt cruiser": "croiseur pt",
    "sebring": "sébring",
    "sebring convertible": "cabriolet sebring",
    "stratus": "stratus",
    "stratus cabrio": "stratus cabriolet",
    "town & country": "ville et campagne",
    "voyager": "voyageur",
    "aerostar": "aérostar",
    "b-max": "b-max",
    "c-max": "c-max",
    "cortina": "cortine",
    "cougar": "puma",
    "edge": "bord",
    "escort": "escorte",
    "escort cabrio": "escorte cabriolet",
    "escort kombi": "escorte kombi",
    "explorer": "explorateur",
    "f-150": "f-150",
    "f-250": "f-250",
    "fiesta": "fête",
    "focus": "se concentrer",
    "focus c-max": "mise au point c-max",
    "focus cc": "se concentrer cc",
    "focus kombi": "focus combi",
    "fusion": "la fusion",
    "galaxy": "galaxie",
    "grand c-max": "grand c-max",
    "ka": "ka",
    "kuga": "kuga",
    "maverick": "maverick",
    "mondeo": "mondeo",
    "mondeo combi": "mondeo combi",
    "mustang": "mustang",
    "orion": "orion",
    "puma": "puma",
    "ranger": "ranger",
    "s-max": "s-max",
    "sierra": "sierra",
    "street ka": "rue ka",
    "tourneo connect": "tourneo connecter",
    "tourneo custom": "tourneo personnalisé",
    "transit": "transit",
    "transit bus": "autobus urbain",
    "transit connect lwb": "transit connecter lwb",
    "transit courier": "courrier en transit",
    "transit custom": "transit personnalisé",
    "transit kombi": "combi de transport en commun",
    "transit tourneo": "tourneo de transit",
    "transit valnik": "transit valnik",
    "transit van": "fourgon de transport en commun",
    "transit van 350": "fourgon de transport 350",
    "windstar": "étoile du vent",
    "h2": "h2",
    "h3": "h3",
    "accent": "accent",
    "atos": "atos",
    "atos prime": "atos prime",
    "coupé": "coupé",
    "elantra": "élantra",
    "galloper": "galopeur",
    "genesis": "genèse",
    "getz": "obtenir",
    "grandeur": "grandeur",
    "h 350": "h 350",
    "h1": "h1",
    "h1 bus": "autobus h1",
    "h1 van": "fourgon h1",
    "h200": "h200",
    "i10": "i10",
    "i20": "i20",
    "i30": "i30",
    "i30 cw": "i30 cw",
    "i40": "i40",
    "i40 cw": "i40 cw",
    "ix20": "ix20",
    "ix35": "ix35",
    "ix55": "ix55",
    "lantra": "lanterne",
    "matrix": "matrice",
    "santa fe": "santa fe",
    "sonata": "sonate",
    "terracan": "terracan",
    "trajet": "trajet",
    "tucson": "tucson",
    "veloster": "véloster",
    "ex": "ex",
    "fx": "effets",
    "g": "g",
    "g coupé": "g coupé",
    "m": "m",
    "q": "q",
    "qx": "qx",
    "daimler": "daimler",
    "f-pace": "f-rythme",
    "f-type": "type f",
    "s-type": "type s",
    "sovereign": "souverain",
    "x-type": "type x",
    "x-type estate": "domaine de type x",
    "xe": "xe",
    "xf": "xf",
    "xj": "xj",
    "xj12": "xj12",
    "xj6": "xj6",
    "xj8": "xj8",
    "xjr": "xjr",
    "xk": "xk",
    "xk8 convertible": "cabriolet xk8",
    "xkr": "xkr",
    "xkr convertible": "xkr cabriolet",
    "cherokee": "cherokee",
    "commander": "le commandant",
    "compass": "boussole",
    "grand cherokee": "grand cherokee",
    "patriot": "patriote",
    "renegade": "renégat",
    "wrangler": "cow-boy",
    "almera": "almera",
    "almera tino": "almera tino",
    "cabstar e - t": "cabstar e-t",
    "cabstar tl2 valnik": "cabstar tl2 valnik",
    "e-nv200": "e-nv200",
    "gt-r": "gt-r",
    "insterstar": "étoile montante",
    "juke": "juke",
    "king cab": "cabine king",
    "leaf": "feuille",
    "maxima": "maxima",
    "maxima qx": "maxima qx",
    "micra": "micra",
    "murano": "murano",
    "navara": "navara",
    "note": "note",
    "np300 pickup": "ramassage np300",
    "nv200": "nv200",
    "nv400": "nv400",
    "pathfinder": "éclaireur",
    "patrol": "patrouille",
    "patrol gr": "patrouille gr",
    "pickup": "ramasser",
    "pixo": "pixo",
    "primastar": "primastar",
    "primastar combi": "combi primastar",
    "primera": "première",
    "primera combi": "primera combi",
    "pulsar": "pulsar",
    "qashqai": "qashqai",
    "serena": "serena",
    "sunny": "ensoleillé",
    "terrano": "terrano",
    "tiida": "tiida",
    "trade": "commerce",
    "vanette cargo": "cargo vanette",
    "x-trail": "x-piste",
    "c30": "c30",
    "c70": "c70",
    "c70 cabrio": "c70 cabriolet",
    "c70 coupé": "coupé c70",
    "s40": "s40",
    "s60": "s60",
    "s70": "s70",
    "s80": "s80",
    "s90": "s90",
    "v40": "v40",
    "v50": "v50",
    "v60": "v60",
    "v70": "v70",
    "v90": "v90",
    "xc60": "xc60",
    "xc70": "xc70",
    "xc90": "xc90",
    "espero": "espéro",
    "lanos": "lanos",
    "leganza": "léganza",
    "lublin": "lublin",
    "nexia": "nexia",
    "nubira kombi": "nubira combi",
    "racer": "coureur",
    "tico": "tico",
    "barchetta": "barchette",
    "brava": "bravo",
    "cinquecento": "cinquecento",
    "croma": "croma",
    "doblo": "doblo",
    "doblo cargo": "doblo cargo",
    "doblo cargo combi": "combi cargo doblo",
    "ducato": "ducato",
    "ducato van": "fourgon ducato",
    "ducato kombi": "ducato combi",
    "ducato podvozok": "ducato podvozok",
    "florino": "florin",
    "florino combi": "combi florino",
    "freemont": "franc-mont",
    "grande punto": "grand point",
    "idea": "idée",
    "linea": "ligne",
    "marea": "marée",
    "marea weekend": "week-end à la mer",
    "multipla": "multipla",
    "palio weekend": "week-end palio",
    "panda": "panda",
    "panda van": "fourgon panda",
    "punto": "point",
    "punto cabriolet": "punto cabriolet",
    "punto evo": "point evo",
    "punto van": "camionnette punto",
    "qubo": "qubo",
    "scudo": "scudo",
    "scudo van": "fourgon scudo",
    "scudo kombi": "scudo combi",
    "sedici": "sedici",
    "seicento": "seicento",
    "stilo": "style",
    "stilo multiwagon": "multiwagon stilo",
    "strada": "route",
    "talento": "talent",
    "tipo": "type",
    "ulysse": "ulysse",
    "uno": "uno",
    "x1/9": "x1/9",
    "cooper": "tonnelier",
    "cooper cabrio": "cooper cabriolet",
    "cooper clubman": "joueur de club de cooper",
    "cooper d": "tonnelier d",
    "cooper d clubman": "cooper d. clubman",
    "cooper s": "tonnelier",
    "cooper s cabrio": "cooper's cabrio",
    "cooper s clubman": "cooper's clubman",
    "countryman": "compatriote",
    "mini one": "mini-un",
    "one d": "un d",
    "cabrio": "cabriolet",
    "city-coupé": "coupé de ville",
    "compact pulse": "impulsion compacte",
    "forfour": "pour quatre",
    "fortwo cabrio": "fortwo cabriolet",
    "fortwo coupé": "fortwo coupé",
    "roadster": "roadster"
}

const Locale = document.documentElement.lang,
    BasePath = window.location.origin + "/storage/IMAGES/",
    Background = "rgb(" + getComputedStyle(document.documentElement)
    .getPropertyValue("--prime") + ")",
    Color = "rgb(" + getComputedStyle(document.documentElement)
    .getPropertyValue("--white") + ")",
    Currency = $query("[name=currency]").content,
    Mileage = +$query("[name=mileage]").content,
    Models = {
        "seat": ["alhambra", "altea", "altea xl", "arosa", "cordoba", "cordoba vario", "exeo", "ibiza", "ibiza st", "exeo st", "leon", "leon st", "inca", "mii", "toledo"],
        "renault": ["captur", "clio", "clio grandtour", "espace", "express", "fluence", "grand espace", "grand modus", "grand scenic", "kadjar", "kangoo", "kangoo express", "koleos", "laguna", "laguna grandtour", "latitude", "mascott", "mégane", "mégane cc", "mégane combi", "mégane grandtour", "mégane coupé", "mégane scénic", "scénic", "talisman", "talisman grandtour", "thalia", "twingo", "wind", "zoé"],
        "peugeot": ["1007", "107", "106", "108", "2008", "205", "205 cabrio", "206", "206 cc", "206 sw", "207", "207 cc", "207 sw", "306", "307", "307 cc", "307 sw", "308", "308 cc", "308 sw", "309", "4007", "4008", "405", "406", "407", "407 sw", "5008", "508", "508 sw", "605", "806", "607", "807", "bipper", "rcz"],
        "dacia": ["dokker", "duster", "lodgy", "logan", "logan mcv", "logan van", "sandero", "solenza"],
        "citroën": ["berlingo", "c-crosser", "c-elissée", "c-zero", "c1", "c2", "c3", "c3 picasso", "c4", "c4 aircross", "c4 cactus", "c4 coupé", "c4 grand picasso", "c4 sedan", "c5", "c5 break", "c5 tourer", "c6", "c8", "ds3", "ds4", "ds5", "evasion", "jumper", "jumpy", "saxo", "nemo", "xantia", "xsara"],
        "opel": ["agila", "ampera", "antara", "astra", "astra cabrio", "astra caravan", "astra coupé", "calibra", "campo", "cascada", "corsa", "frontera", "insignia", "insignia kombi", "kadett", "meriva", "mokka", "movano", "omega", "signum", "vectra", "vectra caravan", "vivaro", "vivaro kombi", "zafira"],
        "alfa romeo": ["145", "146", "147", "155", "156", "156 sportwagon", "159", "159 sportwagon", "164", "166", "4c", "brera", "gtv", "mito", "crosswagon", "spider", "gt", "giulietta", "giulia"],
        "škoda": ["favorit", "felicia", "citigo", "fabia", "fabia combi", "fabia sedan", "felicia combi", "octavia", "octavia combi", "roomster", "yeti", "rapid", "rapid spaceback", "superb", "superb combi"],
        "chevrolet": ["alero", "aveo", "camaro", "captiva", "corvette", "cruze", "cruze sw", "epica", "equinox", "evanda", "hhr", "kalos", "lacetti", "lacetti sw", "lumina", "malibu", "matiz", "monte carlo", "nubira", "orlando", "spark", "suburban", "tacuma", "tahoe", "trax"],
        "porsche": ["911 carrera", "911 carrera cabrio", "911 targa", "911 turbo", "924", "944", "997", "boxster", "cayenne", "cayman", "macan", "panamera"],
        "honda": ["accord", "accord coupé", "accord tourer", "city", "civic", "civic aerodeck", "civic coupé", "civic tourer", "civic type r", "cr-v", "cr-x", "cr-z", "fr-v", "hr-v", "insight", "integra", "jazz", "legend", "prelude"],
        "subaru": ["brz", "forester", "impreza", "impreza wagon", "justy", "legacy", "legacy wagon", "legacy outback", "levorg", "outback", "svx", "tribeca", "tribeca b9", "xv"],
        "mazda": ["121", "2", "3", "323", "323 combi", "323 coupé", "323 f", "5", "6", "6 combi", "626", "626 combi", "b-fighter", "b2500", "bt", "cx-3", "cx-5", "cx-7", "cx-9", "demio", "mpv", "mx-3", "mx-5", "mx-6", "premacy", "rx-7", "rx-8", "xedox 6"],
        "mitsubishi": ["3000 gt", "asx", "carisma", "colt", "colt cc", "eclipse", "fuso canter", "galant", "galant combi", "grandis", "l200", "l200 pick up", "l200 pick up allrad", "l300", "lancer", "lancer combi", "lancer evo", "lancer sportback", "outlander", "pajero", "pajeto pinin", "pajero pinin wagon", "pajero sport", "pajero wagon", "space star"],
        "lexus": ["ct", "gs", "gs 300", "gx", "is", "is 200", "is 250 c", "is-f", "ls", "lx", "nx", "rc f", "rx", "rx 300", "rx 400h", "rx 450h", "sc 430"],
        "toyota": ["4-runner", "auris", "avensis", "avensis combi", "avensis van verso", "aygo", "camry", "carina", "celica", "corolla", "corolla combi", "corolla sedan", "corolla verso", "fj cruiser", "gt86", "hiace", "hiace van", "highlander", "hilux", "land cruiser", "mr2", "paseo", "picnic", "prius", "rav4", "sequoia", "starlet", "supra", "tundra", "urban cruiser", "verso", "yaris", "yaris verso"],
        "bmw": ["i3", "i8", "m3", "m4", "m5", "m6", "rad 1", "rad 1 cabrio", "rad 1 coupé", "rad 2", "rad 2 active tourer", "rad 2 coupé", "rad 2 gran tourer", "rad 3", "rad 3 cabrio", "rad 3 compact", "rad 3 coupé", "rad 3 gt", "rad 3 touring", "rad 4", "rad 4 cabrio", "rad 4 gran coupé", "rad 5", "rad 5 gt", "rad 5 touring", "rad 6", "rad 6 cabrio", "rad 6 coupé", "rad 6 gran coupé", "rad 7", "rad 8 coupé", "x1", "x3", "x4", "x5", "x6", "z3", "z3 coupé", "z3 roadster", "z4", "z4 roadster"],
        "volkswagen": ["amarok", "beetle", "bora", "bora variant", "caddy", "caddy van", "life", "california", "caravelle", "cc", "crafter", "crafter van", "crafter kombi", "crosstouran", "eos", "fox", "golf", "golf cabrio", "golf plus", "golf sportvan", "golf variant", "jetta", "lt", "lupo", "multivan", "new beetle", "new beetle cabrio", "passat", "passat alltrack", "passat cc", "passat variant", "passat variant van", "phaeton", "polo", "polo van", "polo variant", "scirocco", "sharan", "t4", "t4 caravelle", "t4 multivan", "t5", "t5 caravelle", "t5 multivan", "t5 transporter shuttle", "tiguan", "touareg", "touran"],
        "suzuki": ["alto", "baleno", "baleno kombi", "grand vitara", "grand vitara xl-7", "ignis", "jimny", "kizashi", "liana", "samurai", "splash", "swift", "sx4", "sx4 sedan", "vitara", "wagon r+"],
        "mercedes-benz": ["100 d", "115", "124", "126", "190", "190 d", "190 e", "200 - 300", "200 d", "200 e", "210 van", "210 kombi", "310 van", "310 kombi", "230 - 300 ce coupé", "260 - 560 se", "260 - 560 sel", "500 - 600 sec coupé", "trieda a", "a", "a l", "amg gt", "trieda b", "trieda c", "c", "c sportcoupé", "c t", "citan", "cl", "cl", "cla", "clc", "clk cabrio", "clk coupé", "cls", "trieda e", "e", "e cabrio", "e coupé", "e t", "trieda g", "g cabrio", "gl", "gla", "glc", "gle", "glk", "trieda m", "mb 100", "trieda r", "trieda s", "s", "s coupé", "sl", "slc", "slk", "slr", "sprinter"],
        "saab": ["9-3", "9-3 cabriolet", "9-3 coupé", "9-3 sportcombi", "9-5", "9-5 sportcombi", "900", "900 c", "900 c turbo", "9000"],
        "audi": ["100", "100 avant", "80", "80 avant", "80 cabrio", "90", "a1", "a2", "a3", "a3 cabriolet", "a3 limuzina", "a3 sportback", "a4", "a4 allroad", "a4 avant", "a4 cabriolet", "a5", "a5 cabriolet", "a5 sportback", "a6", "a6 allroad", "a6 avant", "a7", "a8", "a8 long", "q3", "q5", "q7", "r8", "rs4 cabriolet", "rs4/rs4 avant", "rs5", "rs6 avant", "rs7", "s3/s3 sportback", "s4 cabriolet", "s4/s4 avant", "s5/s5 cabriolet", "s6/rs6", "s7", "s8", "sq5", "tt coupé", "tt roadster", "tts"],
        "kia": ["avella", "besta", "carens", "carnival", "cee`d", "cee`d sw", "cerato", "k 2500", "magentis", "opirus", "optima", "picanto", "pregio", "pride", "pro cee`d", "rio", "rio combi", "rio sedan", "sephia", "shuma", "sorento", "soul", "sportage", "venga"],
        "land rover": ["109", "defender", "discovery", "discovery sport", "freelander", "range rover", "range rover evoque", "range rover sport"],
        "dodge": ["avenger", "caliber", "challenger", "charger", "grand caravan", "journey", "magnum", "nitro", "ram", "stealth", "viper"],
        "chrysler": ["300 c", "300 c touring", "300 m", "crossfire", "grand voyager", "lhs", "neon", "pacifica", "plymouth", "pt cruiser", "sebring", "sebring convertible", "stratus", "stratus cabrio", "town & country", "voyager"],
        "ford": ["aerostar", "b-max", "c-max", "cortina", "cougar", "edge", "escort", "escort cabrio", "escort kombi", "explorer", "f-150", "f-250", "fiesta", "focus", "focus c-max", "focus cc", "focus kombi", "fusion", "galaxy", "grand c-max", "ka", "kuga", "maverick", "mondeo", "mondeo combi", "mustang", "orion", "puma", "ranger", "s-max", "sierra", "street ka", "tourneo connect", "tourneo custom", "transit", "transit", "transit bus", "transit connect lwb", "transit courier", "transit custom", "transit kombi", "transit tourneo", "transit valnik", "transit van", "transit van 350", "windstar"],
        "hummer": ["h2", "h3"],
        "hyundai": ["accent", "atos", "atos prime", "coupé", "elantra", "galloper", "genesis", "getz", "grandeur", "h 350", "h1", "h1 bus", "h1 van", "h200", "i10", "i20", "i30", "i30 cw", "i40", "i40 cw", "ix20", "ix35", "ix55", "lantra", "matrix", "santa fe", "sonata", "terracan", "trajet", "tucson", "veloster"],
        "infiniti": ["ex", "fx", "g", "g coupé", "m", "q", "qx"],
        "jaguar": ["daimler", "f-pace", "f-type", "s-type", "sovereign", "x-type", "x-type estate", "xe", "xf", "xj", "xj12", "xj6", "xj8", "xj8", "xjr", "xk", "xk8 convertible", "xkr", "xkr convertible"],
        "jeep": ["cherokee", "commander", "compass", "grand cherokee", "patriot", "renegade", "wrangler"],
        "nissan": ["100 nx", "200 sx", "350 z", "350 z roadster", "370 z", "almera", "almera tino", "cabstar e - t", "cabstar tl2 valnik", "e-nv200", "gt-r", "insterstar", "juke", "king cab", "leaf", "maxima", "maxima qx", "micra", "murano", "navara", "note", "np300 pickup", "nv200", "nv400", "pathfinder", "patrol", "patrol gr", "pickup", "pixo", "primastar", "primastar combi", "primera", "primera combi", "pulsar", "qashqai", "serena", "sunny", "terrano", "tiida", "trade", "vanette cargo", "x-trail"],
        "volvo": ["240", "340", "360", "460", "850", "850 kombi", "c30", "c70", "c70 cabrio", "c70 coupé", "s40", "s60", "s70", "s80", "s90", "v40", "v50", "v60", "v70", "v90", "xc60", "xc70", "xc90"],
        "daewoo": ["espero", "kalos", "lacetti", "lanos", "leganza", "lublin", "matiz", "nexia", "nubira", "nubira kombi", "racer", "tacuma", "tico"],
        "fiat": ["1100", "126", "500", "500l", "500x", "850", "barchetta", "brava", "cinquecento", "coupé", "croma", "doblo", "doblo cargo", "doblo cargo combi", "ducato", "ducato van", "ducato kombi", "ducato podvozok", "florino", "florino combi", "freemont", "grande punto", "idea", "linea", "marea", "marea weekend", "multipla", "palio weekend", "panda", "panda van", "punto", "punto cabriolet", "punto evo", "punto van", "qubo", "scudo", "scudo van", "scudo kombi", "sedici", "seicento", "stilo", "stilo multiwagon", "strada", "talento", "tipo", "ulysse", "uno", "x1/9"],
        "mini": ["cooper", "cooper cabrio", "cooper clubman", "cooper d", "cooper d clubman", "cooper s", "cooper s cabrio", "cooper s clubman", "countryman", "mini one", "one d"],
        "rover": ["200", "214", "218", "25", "400", "414", "416", "620", "75"],
        "smart": ["cabrio", "city-coupé", "compact pulse", "forfour", "fortwo cabrio", "fortwo coupé", "roadster"]
    },
    COLS = {
        most: () => [{
            name: "vehicle",
            text: $trans('Vehicle'),
        }, {
            name: "total",
            text: $trans("Total") + " (" + Currency + ")",
            headStyle: {
                width: 120,
                textAlign: "center",
            },
            bodyStyle: {
                width: 120,
                textAlign: "center",
            },
            headPdfStyle: function() {
                return this.headStyle;
            },
            bodyPdfStyle: function() {
                return this.bodyStyle;
            },
            bodyRender: (row) => $money(row.total, 3),
            bodyPdfRender: function(row) {
                return this.bodyRender(row);
            },
        }, {
            name: "mileage",
            text: $trans("Mileage") + " (" + $trans('Km') + ")",
            headStyle: {
                width: 120,
                textAlign: "center",
            },
            bodyStyle: {
                width: 120,
                textAlign: "center",
            },
            headPdfStyle: function() {
                return this.headStyle;
            },
            bodyPdfStyle: function() {
                return this.bodyStyle;
            },
            bodyRender: (row) => $money(row.mileage, 3),
            bodyPdfRender: function(row) {
                return this.bodyRender(row);
            },
            bodyCsvRender: function(row) {
                return this.bodyRender(row);
            },
        }, {
            name: "period",
            text: $trans("Period"),
            headStyle: {
                width: 100,
                textAlign: "center",
            },
            bodyStyle: {
                width: 100,
                textAlign: "center",
            },
            headPdfStyle: function() {
                return this.headStyle;
            },
            bodyPdfStyle: function() {
                return this.bodyStyle;
            },
            bodyRender: (row) => row.period + " " + $trans("Days"),
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
            text: $trans("First Name"),
            bodyRender: (row) => $cap(row.first_name),
            bodyPdfRender: function(row) {
                return this.bodyRender(row);
            },
            bodyCsvRender: function(row) {
                return this.bodyRender(row);
            },
        }, {
            name: "last_name",
            text: $trans("Last Name"),
            bodyRender: (row) => $cap(row.last_name),
            bodyPdfRender: function(row) {
                return this.bodyRender(row);
            },
            bodyCsvRender: function(row) {
                return this.bodyRender(row);
            },
        }, {
            name: "gender",
            text: $trans("Gender"),
            visible: false,
            headStyle: {
                textAlign: "center"
            },
            bodyStyle: {
                textAlign: "center"
            },
            headPdfStyle: function() {
                return this.headStyle;
            },
            bodyRender: (row) => row.gender ? $cap($trans(row.gender)) : empty(),
            bodyPdfRender: function(row) {
                return this.bodyRender(row);
            },
            bodyCsvRender: function(row) {
                return this.bodyRender(row);
            },
        }, {
            name: "birth_date",
            text: $trans("Birth Date"),
            visible: false,
            bodyRender: (row) => row.birth_date ? row.birth_date : empty(),
            bodyPdfRender: function(row) {
                return this.bodyRender(row);
            },
            bodyCsvRender: function(row) {
                return this.bodyRender(row);
            },
        }, {
            name: "email",
            text: $trans("Email"),
        }, {
            name: "phone",
            text: $trans("Phone"),
        }, {
            name: "address",
            text: $trans("Address"),
            visible: false,
            bodyRender: (row) => row.address ? $cap(row.address) : empty(),
            bodyPdfRender: function(row) {
                return this.bodyRender(row);
            },
            bodyCsvRender: function(row) {
                return this.bodyRender(row);
            },
        }, {
            name: "action",
            text: $trans("Actions"),
            headStyle: {
                width: 20,
                textAlign: "center"
            },
            bodyStyle: {
                width: 20,
                textAlign: "center"
            },
            bodyRender: (row) => {
                return `<action-tools target="${row.id}"csrf="${Csrf}"patch="${Patch}"clear="${Clear}"></action-tools>`;
            },
            headPdfStyle: function() {
                return this.headStyle;
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
            text: $trans("Full Name"),
            bodyRender: (row) => $cap(row.first_name) + ' ' + $cap(row.last_name),
            bodyPdfRender: function(row) {
                return this.bodyRender(row);
            },
            bodyCsvRender: function(row) {
                return this.bodyRender(row);
            },
        }, {
            name: "phone",
            text: $trans("Phone"),
        }, {
            name: "nationality",
            text: $trans("Nationality"),
            bodyRender: (row) => row.nationality ? $cap($trans(row.nationality)) : empty(),
            bodyPdfRender: function(row) {
                return this.bodyRender(row);
            },
            bodyCsvRender: function(row) {
                return this.bodyRender(row);
            },
        }, {
            name: "identity",
            text: $trans("Identity"),
            headStyle: {
                textAlign: "center"
            },
            bodyStyle: {
                textAlign: "center"
            },
            headPdfStyle: function() {
                return this.headStyle;
            },
        }, {
            name: "identity_type",
            text: $trans("Identity Type"),
            headStyle: {
                textAlign: "center"
            },
            bodyStyle: {
                textAlign: "center"
            },
            headPdfStyle: function() {
                return this.headStyle;
            },
            bodyRender: (row) => row.identity_type ? $cap($trans(row.identity_type)) : empty(),
            bodyPdfRender: function(row) {
                return this.bodyRender(row);
            },
            bodyCsvRender: function(row) {
                return this.bodyRender(row);
            },
        }, {
            name: "license_number",
            text: $trans("License Number"),
            headStyle: {
                textAlign: "center"
            },
            bodyStyle: {
                textAlign: "center"
            },
            headPdfStyle: function() {
                return this.headStyle;
            },
        }, {
            name: "blacklist",
            text: $trans("BlackList"),
            headStyle: {
                width: 20,
                textAlign: "center"
            },
            bodyStyle: {
                width: 20,
                textAlign: "center"
            },
            headPdfStyle: function() {
                return this.headStyle;
            },
            bodyPdfStyle: function() {
                return this.bodyStyle;
            },
            bodyRender: (row) => `<span style="width:100%;height:1rem;display:block;border-radius:9999px;background:${row.blacklist ? "#F43F5E" : "#22C55E"}"></span>`,
            bodyPdfRender: function(row) {
                return this.bodyRender(row);
            },
            bodyCsvRender: (row) => $trans(row.blacklist ? "True" : "False")
        }, {
            name: "gender",
            text: $trans("Gender"),
            visible: false,
            headStyle: {
                textAlign: "center"
            },
            bodyStyle: {
                textAlign: "center"
            },
            headPdfStyle: function() {
                return this.headStyle;
            },
            bodyRender: (row) => row.gender ? $cap($trans(row.gender)) : empty(),
            bodyPdfRender: function(row) {
                return this.bodyRender(row);
            },
            bodyCsvRender: function(row) {
                return this.bodyRender(row);
            },
        }, {
            name: "birth_date",
            text: $trans("Birth Date"),
            visible: false,
            bodyRender: (row) => row.birth_date ? row.birth_date : empty(),
            bodyPdfRender: function(row) {
                return this.bodyRender(row);
            },
            bodyCsvRender: function(row) {
                return this.bodyRender(row);
            },
        }, {
            name: "email",
            text: $trans("Email"),
            visible: false,
            bodyRender: (row) => row.email ? $cap(row.email) : empty(),
            bodyPdfRender: function(row) {
                return this.bodyRender(row);
            },
            bodyCsvRender: function(row) {
                return this.bodyRender(row);
            },
        }, {
            name: "address",
            text: $trans("Address"),
            visible: false,
            bodyRender: (row) => row.address ? $cap(row.address) : empty(),
            bodyPdfRender: function(row) {
                return this.bodyRender(row);
            },
            bodyCsvRender: function(row) {
                return this.bodyRender(row);
            },
        }, {
            name: "action",
            text: $trans("Actions"),
            headStyle: {
                width: 20,
                textAlign: "center"
            },
            bodyStyle: {
                width: 20,
                textAlign: "center"
            },
            bodyRender: (row) => {
                return `<action-tools target="${row.id}"csrf="${Csrf}"patch="${Patch}"scene="${Scene}"clear="${Clear}"></action-tools>`;
            },
            headPdfStyle: function() {
                return this.headStyle;
            },
            bodyPdfStyle: function() {
                return this.bodyStyle;
            },
            bodyPdfRender: () => empty(),
            bodyCsvRender: () => empty(),
        }],
        agencies: ({
            Csrf,
            Patch,
            Scene,
            Clear
        }) => [{
            text: $trans("Name"),
            bodyRender: (row) => $cap(row.name),
            bodyPdfRender: function(row) {
                return this.bodyRender(row);
            },
            bodyCsvRender: function(row) {
                return this.bodyRender(row);
            },
        }, {
            name: "phone",
            text: $trans("Phone"),
        }, {
            name: "secondary_phone",
            text: $trans("Secondary Phone"),
            bodyRender: (row) => row.secondary_phone ? row.secondary_phone : empty(),
            bodyPdfRender: function(row) {
                return this.bodyRender(row);
            },
            bodyCsvRender: function(row) {
                return this.bodyRender(row);
            },
        }, {
            name: "email",
            text: $trans("Email"),
            bodyRender: (row) => row.email ? $cap(row.email) : empty(),
            bodyPdfRender: function(row) {
                return this.bodyRender(row);
            },
            bodyCsvRender: function(row) {
                return this.bodyRender(row);
            },
        }, {
            name: "address",
            text: $trans("Address"),
            visible: false,
            bodyRender: (row) => row.address ? $cap(row.address) : empty(),
            bodyPdfRender: function(row) {
                return this.bodyRender(row);
            },
            bodyCsvRender: function(row) {
                return this.bodyRender(row);
            },
        }, {
            name: "action",
            text: $trans("Actions"),
            headStyle: {
                width: 20,
                textAlign: "center"
            },
            bodyStyle: {
                width: 20,
                textAlign: "center"
            },
            bodyRender: (row) => {
                return `<action-tools target="${row.id}"csrf="${Csrf}"patch="${Patch}"scene="${Scene}"clear="${Clear}"></action-tools>`;
            },
            headPdfStyle: function() {
                return this.headStyle;
            },
            bodyPdfStyle: function() {
                return this.bodyStyle;
            },
            bodyPdfRender: () => empty(),
            bodyCsvRender: () => empty(),
        }],
        order_reservation: () => [{
            name: "ref",
            text: $trans("Ref"),
            headStyle: {
                width: 120,
                textAlign: "center",
            },
            bodyStyle: {
                width: 120,
                textAlign: "center",
            },
            headPdfStyle: function() {
                return this.headStyle;
            },
            bodyPdfStyle: function() {
                return this.bodyStyle;
            },
        }, {
            name: "vehicle",
            text: $trans("Vehicle"),
            bodyRender: (row) => row.vehicle ? $cap($trans(row.vehicle.brand)) + ' ' + $cap($trans(row.vehicle.model)) + ' ' + row.vehicle.year + ' (' + $cap(row.vehicle.registration) + ")" : empty(),
            bodyPdfRender: function(row) {
                return this.bodyRender(row);
            },
            bodyCsvRender: function(row) {
                return this.bodyRender(row);
            },
        }, {
            name: "from",
            text: $trans("From"),
        }, {
            name: "pick_up",
            text: $trans("Pick-up Location"),
            visible: false,
            bodyRender: (row) => row.pick_up ? $cap(row.pick_up) : empty(),
            bodyPdfRender: function(row) {
                return this.bodyRender(row);
            },
            bodyCsvRender: function(row) {
                return this.bodyRender(row);
            },
        }, {
            name: "to",
            text: $trans("To"),
        }, {
            name: "drop_off",
            text: $trans("Drop-off Location"),
            visible: false,
            bodyRender: (row) => row.drop_off ? $cap(row.drop_off) : empty(),
            bodyPdfRender: function(row) {
                return this.bodyRender(row);
            },
            bodyCsvRender: function(row) {
                return this.bodyRender(row);
            },
        }, {
            name: "period",
            text: $trans("Period"),
            headStyle: {
                width: 100,
                textAlign: "center",
            },
            bodyStyle: {
                width: 100,
                textAlign: "center",
            },
            headPdfStyle: function() {
                return this.headStyle;
            },
            bodyPdfStyle: function() {
                return this.bodyStyle;
            },
            bodyRender: (row) => row.period + " " + $trans("Days"),
            bodyPdfRender: function(row) {
                return this.bodyRender(row);
            },
        }, {
            name: "price",
            text: $trans("Price") + " (" + Currency + ")",
            headStyle: {
                width: 120,
                textAlign: "center",
            },
            bodyStyle: {
                width: 120,
                textAlign: "center",
            },
            headPdfStyle: function() {
                return this.headStyle;
            },
            bodyPdfStyle: function() {
                return this.bodyStyle;
            },
            bodyRender: (row) => $money(row.price, 3),
            bodyPdfRender: function(row) {
                return this.bodyRender(row);
            },
        }, {
            name: "total",
            text: $trans("Total") + " (" + Currency + ")",
            headStyle: {
                width: 120,
                textAlign: "center",
            },
            bodyStyle: {
                width: 120,
                textAlign: "center",
            },
            headPdfStyle: function() {
                return this.headStyle;
            },
            bodyPdfStyle: function() {
                return this.bodyStyle;
            },
            bodyRender: (row) => $money(row.total, 3),
            bodyPdfRender: function(row) {
                return this.bodyRender(row);
            },
        }, {
            name: "payment",
            text: $trans("Payment") + " (" + Currency + ")",
            headStyle: {
                width: 160,
                textAlign: "center",
            },
            bodyStyle: {
                width: 160,
                textAlign: "center",
            },
            headPdfStyle: function() {
                return this.headStyle;
            },
            bodyPdfStyle: function() {
                return this.bodyStyle;
            },
            bodyRender: (row) => $money(JSON.parse(row.payment).reduce((a, e) => a + e, 0), 3),
            bodyPdfRender: function(row) {
                return this.bodyRender(row);
            },
        }, {
            name: "creance",
            text: $trans("Creance") + " (" + Currency + ")",
            headStyle: {
                width: 160,
                textAlign: "center",
            },
            bodyStyle: {
                width: 160,
                textAlign: "center",
            },
            headPdfStyle: function() {
                return this.headStyle;
            },
            bodyPdfStyle: function() {
                return this.bodyStyle;
            },
            bodyRender: (row) => $money(row.total - JSON.parse(row.payment).reduce((a, e) => a + e, 0), 3),
            bodyPdfRender: function(row) {
                return this.bodyRender(row);
            },
        }, {
            name: "starting_mileage",
            text: $trans("Starting Mileage") + " (" + $trans('Km') + ")",
            headStyle: {
                width: 200,
                textAlign: "center",
            },
            bodyStyle: {
                width: 200,
                textAlign: "center",
            },
            headPdfStyle: function() {
                return this.headStyle;
            },
            bodyPdfStyle: function() {
                return this.bodyStyle;
            },
            bodyRender: (row) => $money(row.starting_mileage, 3),
            bodyPdfRender: function(row) {
                return this.bodyRender(row);
            },
            bodyCsvRender: function(row) {
                return this.bodyRender(row);
            },
        }, {
            name: "return_mileage",
            text: $trans("Return Mileage") + " (" + $trans('Km') + ")",
            headStyle: {
                width: 200,
                textAlign: "center",
            },
            bodyStyle: {
                width: 200,
                textAlign: "center",
            },
            headPdfStyle: function() {
                return this.headStyle;
            },
            bodyPdfStyle: function() {
                return this.bodyStyle;
            },
            bodyRender: (row) => $money(row.return_mileage, 3),
            bodyPdfRender: function(row) {
                return this.bodyRender(row);
            },
            bodyCsvRender: function(row) {
                return this.bodyRender(row);
            },
        }, {
            name: "fuel",
            text: $trans("Fuel"),
            headStyle: {
                width: 120,
                textAlign: "center",
            },
            bodyStyle: {
                width: 120,
                textAlign: "center",
            },
            headPdfStyle: function() {
                return this.headStyle;
            },
            bodyPdfStyle: function() {
                return this.bodyStyle;
            },
        }, {
            name: "status",
            text: $trans("Status"),
            headStyle: {
                width: 100,
                textAlign: "center",
            },
            bodyStyle: {
                width: 100,
                textAlign: "center",
            },
            headPdfStyle: function() {
                return this.headStyle;
            },
            bodyPdfStyle: function() {
                return this.bodyStyle;
            },
            bodyRender: (row) => $cap($trans(row.status)),
            bodyPdfRender: function(row) {
                return this.bodyRender(row);
            },
        }],
        blacklist: ({
            Csrf,
            Patch,
            Clear
        }) => [{
            name: "renter",
            text: $trans("Renter"),
            bodyRender: (row) => row.client ? $cap(row.client.first_name) + ' ' + $cap(row.client.last_name) : empty(),
            bodyPdfRender: function(row) {
                return this.bodyRender(row);
            },
            bodyCsvRender: function(row) {
                return this.bodyRender(row);
            },
        }, {
            name: "details",
            text: $trans('Details'),
            headStyle: {
                maxWidth: 500,
            },
            bodyStyle: function() {
                return this.headStyle;
            },
            headPdfStyle: function() {
                return this.headStyle;
            },
            bodyRender: (row) => row.details ? $cap(row.details) : empty(),
            bodyPdfRender: function(row) {
                return this.bodyRender(row);
            },
            bodyCsvRender: function(row) {
                return this.bodyRender(row);
            },
        }, {
            name: "action",
            text: $trans("Actions"),
            headStyle: {
                width: 20,
                textAlign: "center"
            },
            bodyStyle: {
                width: 20,
                textAlign: "center"
            },
            bodyRender: (row) => {
                return `<action-tools target="${row.id}"csrf="${Csrf}"patch="${Patch}"clear="${Clear}"></action-tools>`;
            },
            headPdfStyle: function() {
                return this.headStyle;
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
            name: "vehicle",
            text: $trans('Vehicle'),

            bodyRender: (row) => $cap($trans(row.brand)) + " " + $cap($trans(row.model)) + " " + row.year + " (" + row.registration.toUpperCase() + ")",
            bodyPdfRender: function(row) {
                return this.bodyRender(row);
            },
            bodyCsvRender: function(row) {
                return this.bodyRender(row);
            },
        }, {
            name: "price",
            text: $trans("Price") + " (" + Currency + ")",
            headStyle: {
                width: 120,
                textAlign: "center",
            },
            bodyStyle: {
                width: 120,
                textAlign: "center",
            },
            headPdfStyle: function() {
                return this.headStyle;
            },
            bodyPdfStyle: function() {
                return this.bodyStyle;
            },
            bodyRender: (row) => $money(row.price, 3),
            bodyPdfRender: function(row) {
                return this.bodyRender(row);
            },
        }, {
            name: "circulation",
            text: $trans("Circulation Date"),
            headStyle: {
                width: 160,
                textAlign: "center",
            },
            bodyStyle: {
                width: 160,
                textAlign: "center",
            },
            headPdfStyle: function() {
                return this.headStyle;
            },
            bodyPdfStyle: function() {
                return this.bodyStyle;
            },
        }, {
            name: "mileage",
            text: $trans("Mileage") + " (" + $trans('Km') + ")",
            headStyle: {
                width: 120,
                textAlign: "center",
            },
            bodyStyle: {
                width: 120,
                textAlign: "center",
            },
            headPdfStyle: function() {
                return this.headStyle;
            },
            bodyPdfStyle: function() {
                return this.bodyStyle;
            },
            bodyRender: (row) => $money(row.mileage, 3),
            bodyPdfRender: function(row) {
                return this.bodyRender(row);
            },
            bodyCsvRender: function(row) {
                return this.bodyRender(row);
            },
        }, {
            name: "fuel",
            text: $trans("Fuel"),
            headStyle: {
                width: 100,
                textAlign: "center",
            },
            bodyStyle: {
                width: 100,
                textAlign: "center",
            },
            headPdfStyle: function() {
                return this.headStyle;
            },
            bodyPdfStyle: function() {
                return this.bodyStyle;
            },
            bodyRender: (row) => $cap($trans(row.fuel)),
            bodyPdfRender: function(row) {
                return this.bodyRender(row);
            },
        }, {
            name: "horsepower",
            text: $trans("Horse Power"),

            bodyRender: (row) => $trans(row.horsepower),
            bodyPdfRender: function(row) {
                return this.bodyRender(row);
            },
        }, {
            name: "horsepower_tax",
            text: $trans("Horse Power Tax") + " (" + Currency + ")",
            visible: false,
            headStyle: {
                width: 200,
                textAlign: "center",
            },
            bodyStyle: {
                width: 200,
                textAlign: "center",
            },
            headPdfStyle: function() {
                return this.headStyle;
            },
            bodyPdfStyle: function() {
                return this.bodyStyle;
            },
            bodyRender: (row) => $money(row.horsepower_tax, 3),
            bodyPdfRender: function(row) {
                return this.bodyRender(row);
            },
        }, {
            name: "insurance",
            text: $trans("Insurance"),

            bodyRender: (row) => $trans(row.insurance),
            bodyPdfRender: function(row) {
                return this.bodyRender(row);
            },
        }, {
            name: "insurance_cost",
            text: $trans("Insurance Cost") + " (" + Currency + ")",
            visible: false,
            headStyle: {
                width: 200,
                textAlign: "center",
            },
            bodyStyle: {
                width: 200,
                textAlign: "center",
            },
            headPdfStyle: function() {
                return this.headStyle;
            },
            bodyPdfStyle: function() {
                return this.bodyStyle;
            },
            bodyRender: (row) => $money(row.insurance_cost, 3),
            bodyPdfRender: function(row) {
                return this.bodyRender(row);
            },
        }, {
            name: "transmission",
            text: $trans("Transmission"),
            visible: false,
            headStyle: {
                width: 100,
                textAlign: "center",
            },
            bodyStyle: {
                width: 100,
                textAlign: "center",
            },
            headPdfStyle: function() {
                return this.headStyle;
            },
            bodyPdfStyle: function() {
                return this.bodyStyle;
            },
            bodyRender: (row) => $cap($trans(row.transmission)),
            bodyPdfRender: function(row) {
                return this.bodyRender(row);
            },
        }, {
            name: "passengers",
            text: $trans("Passengers"),
            visible: false,
            headStyle: {
                width: 100,
                textAlign: "center",
            },
            bodyStyle: {
                width: 100,
                textAlign: "center",
            },
            headPdfStyle: function() {
                return this.headStyle;
            },
            bodyPdfStyle: function() {
                return this.bodyStyle;
            },
        }, {
            name: "doors",
            text: $trans("Doors"),
            visible: false,
            headStyle: {
                width: 100,
                textAlign: "center",
            },
            bodyStyle: {
                width: 100,
                textAlign: "center",
            },
            headPdfStyle: function() {
                return this.headStyle;
            },
            bodyPdfStyle: function() {
                return this.bodyStyle;
            },
        }, {
            name: "cargo",
            text: $trans("Cargo"),
            visible: false,
            headStyle: {
                width: 100,
                textAlign: "center",
            },
            bodyStyle: {
                width: 100,
                textAlign: "center",
            },
            headPdfStyle: function() {
                return this.headStyle;
            },
            bodyPdfStyle: function() {
                return this.bodyStyle;
            },
        }, {
            name: "action",
            text: $trans("Actions"),
            headStyle: {
                width: 20,
                textAlign: "center"
            },
            bodyStyle: {
                width: 20,
                textAlign: "center"
            },
            bodyRender: (row) => {
                return `<action-tools target="${row.id}"csrf="${Csrf}"patch="${Patch}"scene="${Scene}"clear="${Clear}"></action-tools>`;
            },
            headPdfStyle: function() {
                return this.headStyle;
            },
            bodyPdfStyle: function() {
                return this.bodyStyle;
            },
            bodyPdfRender: () => empty(),
            bodyCsvRender: () => empty(),
        }],
        vehicle_reservation: () => [{
            name: "ref",
            text: $trans("Ref"),
            headStyle: {
                width: 120,
                textAlign: "center",
            },
            bodyStyle: {
                width: 120,
                textAlign: "center",
            },
            headPdfStyle: function() {
                return this.headStyle;
            },
            bodyPdfStyle: function() {
                return this.bodyStyle;
            },
        }, {
            name: "renter",
            text: $trans("Renter"),
            bodyRender: (row) => {
                var name = empty();
                if (row.client) name = $cap(row.client.first_name) + ' ' + $cap(row.client.last_name);
                if (row.agency) name = $cap(row.agency.name);
                return name;
            },
            bodyPdfRender: function(row) {
                return this.bodyRender(row);
            },
            bodyCsvRender: function(row) {
                return this.bodyRender(row);
            },
        }, {
            name: "from",
            text: $trans("From"),
        }, {
            name: "pick_up",
            text: $trans("Pick-up Location"),
            visible: false,
            bodyRender: (row) => row.pick_up ? $cap(row.pick_up) : empty(),
            bodyPdfRender: function(row) {
                return this.bodyRender(row);
            },
            bodyCsvRender: function(row) {
                return this.bodyRender(row);
            },
        }, {
            name: "to",
            text: $trans("To"),
        }, {
            name: "drop_off",
            text: $trans("Drop-off Location"),
            visible: false,
            bodyRender: (row) => row.drop_off ? $cap(row.drop_off) : empty(),
            bodyPdfRender: function(row) {
                return this.bodyRender(row);
            },
            bodyCsvRender: function(row) {
                return this.bodyRender(row);
            },
        }, {
            name: "period",
            text: $trans("Period"),
            headStyle: {
                width: 100,
                textAlign: "center",
            },
            bodyStyle: {
                width: 100,
                textAlign: "center",
            },
            headPdfStyle: function() {
                return this.headStyle;
            },
            bodyPdfStyle: function() {
                return this.bodyStyle;
            },
            bodyRender: (row) => row.period + " " + $trans("Days"),
            bodyPdfRender: function(row) {
                return this.bodyRender(row);
            },
        }, {
            name: "price",
            text: $trans("Price") + " (" + Currency + ")",
            headStyle: {
                width: 120,
                textAlign: "center",
            },
            bodyStyle: {
                width: 120,
                textAlign: "center",
            },
            headPdfStyle: function() {
                return this.headStyle;
            },
            bodyPdfStyle: function() {
                return this.bodyStyle;
            },
            bodyRender: (row) => $money(row.price, 3),
            bodyPdfRender: function(row) {
                return this.bodyRender(row);
            },
        }, {
            name: "total",
            text: $trans("Total") + " (" + Currency + ")",
            headStyle: {
                width: 120,
                textAlign: "center",
            },
            bodyStyle: {
                width: 120,
                textAlign: "center",
            },
            headPdfStyle: function() {
                return this.headStyle;
            },
            bodyPdfStyle: function() {
                return this.bodyStyle;
            },
            bodyRender: (row) => $money(row.total, 3),
            bodyPdfRender: function(row) {
                return this.bodyRender(row);
            },
        }, {
            name: "payment",
            text: $trans("Payment") + " (" + Currency + ")",
            headStyle: {
                width: 160,
                textAlign: "center",
            },
            bodyStyle: {
                width: 160,
                textAlign: "center",
            },
            headPdfStyle: function() {
                return this.headStyle;
            },
            bodyPdfStyle: function() {
                return this.bodyStyle;
            },
            bodyRender: (row) => $money(JSON.parse(row.payment).reduce((a, e) => a + e, 0), 3),
            bodyPdfRender: function(row) {
                return this.bodyRender(row);
            },
        }, {
            name: "creance",
            text: $trans("Creance") + " (" + Currency + ")",
            headStyle: {
                width: 160,
                textAlign: "center",
            },
            bodyStyle: {
                width: 160,
                textAlign: "center",
            },
            headPdfStyle: function() {
                return this.headStyle;
            },
            bodyPdfStyle: function() {
                return this.bodyStyle;
            },
            bodyRender: (row) => $money(row.total - JSON.parse(row.payment).reduce((a, e) => a + e, 0), 3),
            bodyPdfRender: function(row) {
                return this.bodyRender(row);
            },
        }, {
            name: "starting_mileage",
            text: $trans("Starting Mileage") + " (" + $trans('Km') + ")",
            headStyle: {
                width: 200,
                textAlign: "center",
            },
            bodyStyle: {
                width: 200,
                textAlign: "center",
            },
            headPdfStyle: function() {
                return this.headStyle;
            },
            bodyPdfStyle: function() {
                return this.bodyStyle;
            },
            bodyRender: (row) => $money(row.starting_mileage, 3),
            bodyPdfRender: function(row) {
                return this.bodyRender(row);
            },
            bodyCsvRender: function(row) {
                return this.bodyRender(row);
            },
        }, {
            name: "return_mileage",
            text: $trans("Return Mileage") + " (" + $trans('Km') + ")",
            headStyle: {
                width: 200,
                textAlign: "center",
            },
            bodyStyle: {
                width: 200,
                textAlign: "center",
            },
            headPdfStyle: function() {
                return this.headStyle;
            },
            bodyPdfStyle: function() {
                return this.bodyStyle;
            },
            bodyRender: (row) => $money(row.return_mileage, 3),
            bodyPdfRender: function(row) {
                return this.bodyRender(row);
            },
            bodyCsvRender: function(row) {
                return this.bodyRender(row);
            },
        }, {
            name: "fuel",
            text: $trans("Fuel"),
            headStyle: {
                width: 120,
                textAlign: "center",
            },
            bodyStyle: {
                width: 120,
                textAlign: "center",
            },
            headPdfStyle: function() {
                return this.headStyle;
            },
            bodyPdfStyle: function() {
                return this.bodyStyle;
            },
        }, {
            name: "status",
            text: $trans("Status"),
            headStyle: {
                width: 100,
                textAlign: "center",
            },
            bodyStyle: {
                width: 100,
                textAlign: "center",
            },
            headPdfStyle: function() {
                return this.headStyle;
            },
            bodyPdfStyle: function() {
                return this.bodyStyle;
            },
            bodyRender: (row) => $cap($trans(row.status)),
            bodyPdfRender: function(row) {
                return this.bodyRender(row);
            },
        }],
        vehicle_charge: () => [{
            name: "name",
            text: $trans("Name"),
            headStyle: {
                maxWidth: 300,
            },
            bodyStyle: function() {
                return this.headStyle;
            },
            headPdfStyle: function() {
                return this.headStyle;
            },
            bodyRender: (row) => $cap(row.name),
            bodyPdfRender: function(row) {
                return this.bodyRender(row);
            },
            bodyCsvRender: function(row) {
                return this.bodyRender(row);
            },
        }, {
            name: "cost",
            text: $trans("Cost") + " (" + Currency + ")",
            headStyle: {
                width: 120,
                textAlign: "center",
            },
            bodyStyle: {
                width: 120,
                textAlign: "center",
            },
            headPdfStyle: function() {
                return this.headStyle;
            },
            bodyPdfStyle: function() {
                return this.bodyStyle;
            },
            bodyRender: (row) => $money(row.cost, 3),
            bodyPdfRender: function(row) {
                return this.bodyRender(row);
            },
        }, {
            name: "details",
            text: $trans('Details'),
            headStyle: {
                maxWidth: 500,
            },
            visible: false,
            bodyStyle: function() {
                return this.headStyle;
            },
            headPdfStyle: function() {
                return this.headStyle;
            },
            bodyRender: (row) => row.details ? $cap(row.details) : empty(),
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
            text: $trans("Vehicle"),
            bodyRender: (row) => row.vehicle ? $cap($trans(row.vehicle.brand)) + ' ' + $cap($trans(row.vehicle.model)) + ' ' + row.vehicle.year + ' (' + $cap(row.vehicle.registration) + ")" : empty(),
            bodyPdfRender: function(row) {
                return this.bodyRender(row);
            },
            bodyCsvRender: function(row) {
                return this.bodyRender(row);
            },
        }, {
            name: "consumable",
            text: $trans('Consumable'),
            headStyle: {
                maxWidth: 300,
            },
            bodyStyle: function() {
                return this.headStyle;
            },
            headPdfStyle: function() {
                return this.headStyle;
            },
            bodyRender: (row) => $cap($trans(row.consumable)),
            bodyPdfRender: function(row) {
                return this.bodyRender(row);
            },
            bodyCsvRender: function(row) {
                return this.bodyRender(row);
            },
        }, {
            name: "recurrence",
            text: $trans("Recurrence"),
            headStyle: {
                width: 120,
                textAlign: "center",
            },
            bodyStyle: {
                width: 120,
                textAlign: "center",
            },
            headPdfStyle: function() {
                return this.headStyle;
            },
            bodyPdfStyle: function() {
                return this.bodyStyle;
            },
            bodyRender: (row) => row.recurrence + " " + $cap(row.unit === 'mileage' ? $trans('Km') : $trans(row.unit)),
            bodyPdfRender: function(row) {
                return this.bodyRender(row);
            },
            bodyCsvRender: function(row) {
                return this.bodyRender(row);
            },
        }, {
            name: "threshold",
            text: $trans("Threshold"),
            headStyle: {
                width: 120,
                textAlign: "center",
            },
            bodyStyle: {
                width: 120,
                textAlign: "center",
            },
            headPdfStyle: function() {
                return this.headStyle;
            },
            bodyPdfStyle: function() {
                return this.bodyStyle;
            },
            bodyRender: (row) => {
                const is = row.unit === 'mileage';
                return row.threshold * (is ? Mileage : 1) + " " + $cap(is ? $trans('Km') : $trans('Hour'));
            },
            bodyPdfRender: function(row) {
                return this.bodyRender(row);
            },
            bodyCsvRender: function(row) {
                return this.bodyRender(row);
            },
        }, {
            name: "viewed_at",
            text: $trans("Next Recurrence"),
            headStyle: {
                width: 200,
                textAlign: "center",
            },
            bodyStyle: {
                width: 200,
                textAlign: "center",
            },
            headPdfStyle: function() {
                return this.headStyle;
            },
            bodyPdfStyle: function() {
                return this.bodyStyle;
            },
            bodyRender: function(row) {
                const d = new Date(row.viewed_at),
                    t = {
                        week: 7,
                        month: 30,
                        year: 365,
                    };
                if (d.toDateString() === (new Date()).toDateString()) {
                    const v = d.getTime() + (row.recurrence * t[row.unit] * 24 * 60 * 60 * 1000);
                    return Neo.Helper.Str.moment(new Date(v).toDateString());
                } else return row.viewed_at;
            },
            bodyPdfRender: function(row) {
                return this.bodyRender(row);
            },
            bodyCsvRender: function(row) {
                return this.bodyRender(row);
            }
        }, {
            name: "action",
            text: $trans("Actions"),
            headStyle: {
                width: 20,
                textAlign: "center"
            },
            bodyStyle: {
                width: 20,
                textAlign: "center"
            },
            bodyRender: (row) => {
                return `<action-tools target="${row.id}"csrf="${Csrf}"patch="${Patch}"clear="${Clear}"></action-tools>`;
            },
            headPdfStyle: function() {
                return this.headStyle;
            },
            bodyPdfStyle: function() {
                return this.bodyStyle;
            },
            bodyPdfRender: () => empty(),
            bodyCsvRender: () => empty(),
        }],
        reservations: ({
            Patch,
            Print,
        }) => [{
            name: "ref",
            text: $trans("Ref"),
            headStyle: {
                width: 120,
                textAlign: "center",
            },
            bodyStyle: {
                width: 120,
                textAlign: "center",
            },
            headPdfStyle: function() {
                return this.headStyle;
            },
            bodyPdfStyle: function() {
                return this.bodyStyle;
            },
        }, {
            name: "renter",
            text: $trans("Renter"),
            bodyRender: (row) => {
                var name = empty();
                if (row.client) name = $cap(row.client.first_name) + ' ' + $cap(row.client.last_name);
                if (row.agency) name = $cap(row.agency.name);
                return name;
            },
            bodyPdfRender: function(row) {
                return this.bodyRender(row);
            },
            bodyCsvRender: function(row) {
                return this.bodyRender(row);
            },
        }, {
            name: "vehicle",
            text: $trans("Vehicle"),
            bodyRender: (row) => row.vehicle ? $cap($trans(row.vehicle.brand)) + ' ' + $cap($trans(row.vehicle.model)) + ' ' + row.vehicle.year + ' (' + $cap(row.vehicle.registration) + ")" : empty(),
            bodyPdfRender: function(row) {
                return this.bodyRender(row);
            },
            bodyCsvRender: function(row) {
                return this.bodyRender(row);
            },
        }, {
            name: "from",
            text: $trans("From"),
        }, {
            name: "pick_up",
            text: $trans("Pick-up Location"),
            visible: false,
            bodyRender: (row) => row.pick_up ? $cap(row.pick_up) : empty(),
            bodyPdfRender: function(row) {
                return this.bodyRender(row);
            },
            bodyCsvRender: function(row) {
                return this.bodyRender(row);
            },
        }, {
            name: "to",
            text: $trans("To"),
        }, {
            name: "drop_off",
            text: $trans("Drop-off Location"),
            visible: false,
            bodyRender: (row) => row.drop_off ? $cap(row.drop_off) : empty(),
            bodyPdfRender: function(row) {
                return this.bodyRender(row);
            },
            bodyCsvRender: function(row) {
                return this.bodyRender(row);
            },
        }, {
            name: "period",
            text: $trans("Period"),
            headStyle: {
                width: 100,
                textAlign: "center",
            },
            bodyStyle: {
                width: 100,
                textAlign: "center",
            },
            headPdfStyle: function() {
                return this.headStyle;
            },
            bodyPdfStyle: function() {
                return this.bodyStyle;
            },
            bodyRender: (row) => row.period + " " + $trans("Days"),
            bodyPdfRender: function(row) {
                return this.bodyRender(row);
            },
        }, {
            name: "price",
            text: $trans("Price") + " (" + Currency + ")",
            headStyle: {
                width: 120,
                textAlign: "center",
            },
            bodyStyle: {
                width: 120,
                textAlign: "center",
            },
            headPdfStyle: function() {
                return this.headStyle;
            },
            bodyPdfStyle: function() {
                return this.bodyStyle;
            },
            bodyRender: (row) => $money(row.price, 3),
            bodyPdfRender: function(row) {
                return this.bodyRender(row);
            },
        }, {
            name: "total",
            text: $trans("Total") + " (" + Currency + ")",
            headStyle: {
                width: 120,
                textAlign: "center",
            },
            bodyStyle: {
                width: 120,
                textAlign: "center",
            },
            headPdfStyle: function() {
                return this.headStyle;
            },
            bodyPdfStyle: function() {
                return this.bodyStyle;
            },
            bodyRender: (row) => $money(row.total, 3),
            bodyPdfRender: function(row) {
                return this.bodyRender(row);
            },
        }, {
            name: "payment",
            text: $trans("Payment") + " (" + Currency + ")",
            headStyle: {
                width: 160,
                textAlign: "center",
            },
            bodyStyle: {
                width: 160,
                textAlign: "center",
            },
            headPdfStyle: function() {
                return this.headStyle;
            },
            bodyPdfStyle: function() {
                return this.bodyStyle;
            },
            bodyRender: (row) => $money(JSON.parse(row.payment).reduce((a, e) => a + e, 0), 3),
            bodyPdfRender: function(row) {
                return this.bodyRender(row);
            },
        }, {
            name: "creance",
            text: $trans("Creance") + " (" + Currency + ")",
            headStyle: {
                width: 160,
                textAlign: "center",
            },
            bodyStyle: {
                width: 160,
                textAlign: "center",
            },
            headPdfStyle: function() {
                return this.headStyle;
            },
            bodyPdfStyle: function() {
                return this.bodyStyle;
            },
            bodyRender: (row) => $money(row.total - JSON.parse(row.payment).reduce((a, e) => a + e, 0), 3),
            bodyPdfRender: function(row) {
                return this.bodyRender(row);
            },
        }, {
            name: "starting_mileage",
            text: $trans("Starting Mileage") + " (" + $trans('Km') + ")",
            headStyle: {
                width: 200,
                textAlign: "center",
            },
            bodyStyle: {
                width: 200,
                textAlign: "center",
            },
            headPdfStyle: function() {
                return this.headStyle;
            },
            bodyPdfStyle: function() {
                return this.bodyStyle;
            },
            bodyRender: (row) => $money(row.starting_mileage, 3),
            bodyPdfRender: function(row) {
                return this.bodyRender(row);
            },
            bodyCsvRender: function(row) {
                return this.bodyRender(row);
            },
        }, {
            name: "return_mileage",
            text: $trans("Return Mileage") + " (" + $trans('Km') + ")",
            headStyle: {
                width: 200,
                textAlign: "center",
            },
            bodyStyle: {
                width: 200,
                textAlign: "center",
            },
            headPdfStyle: function() {
                return this.headStyle;
            },
            bodyPdfStyle: function() {
                return this.bodyStyle;
            },
            bodyRender: (row) => $money(row.return_mileage, 3),
            bodyPdfRender: function(row) {
                return this.bodyRender(row);
            },
            bodyCsvRender: function(row) {
                return this.bodyRender(row);
            },
        }, {
            name: "fuel",
            text: $trans("Fuel"),
            headStyle: {
                width: 120,
                textAlign: "center",
            },
            bodyStyle: {
                width: 120,
                textAlign: "center",
            },
            headPdfStyle: function() {
                return this.headStyle;
            },
            bodyPdfStyle: function() {
                return this.bodyStyle;
            },
        }, {
            name: "status",
            text: $trans("Status"),
            headStyle: {
                width: 100,
                textAlign: "center",
            },
            bodyStyle: {
                width: 100,
                textAlign: "center",
            },
            headPdfStyle: function() {
                return this.headStyle;
            },
            bodyPdfStyle: function() {
                return this.bodyStyle;
            },
            bodyRender: (row) => $cap($trans(row.status)),
            bodyPdfRender: function(row) {
                return this.bodyRender(row);
            },
        }, {
            name: "action",
            text: $trans("Actions"),
            headStyle: {
                width: 20,
                textAlign: "center"
            },
            bodyStyle: {
                width: 20,
                textAlign: "center"
            },
            bodyRender: (row) => {
                return `<action-tools target="${row.id}"patch="${Patch}"print="${Print}"></action-tools>`;
            },
            headPdfStyle: function() {
                return this.headStyle;
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
            text: $trans("Name"),
            headStyle: {
                maxWidth: 300,
            },
            bodyStyle: function() {
                return this.headStyle;
            },
            headPdfStyle: function() {
                return this.headStyle;
            },
            bodyRender: (row) => $cap(row.name),
            bodyPdfRender: function(row) {
                return this.bodyRender(row);
            },
            bodyCsvRender: function(row) {
                return this.bodyRender(row);
            },
        }, {
            name: "vehicle",
            text: $trans("Vehicle"),
            bodyRender: (row) => row.vehicle ? $cap($trans(row.vehicle.brand)) + ' ' + $cap($trans(row.vehicle.model)) + ' ' + row.vehicle.year + ' (' + $cap(row.vehicle.registration) + ")" : empty(),
            bodyPdfRender: function(row) {
                return this.bodyRender(row);
            },
            bodyCsvRender: function(row) {
                return this.bodyRender(row);
            },
        }, {
            name: "cost",
            text: $trans("Cost") + " (" + Currency + ")",
            headStyle: {
                width: 120,
                textAlign: "center",
            },
            bodyStyle: {
                width: 120,
                textAlign: "center",
            },
            headPdfStyle: function() {
                return this.headStyle;
            },
            bodyPdfStyle: function() {
                return this.bodyStyle;
            },
            bodyRender: (row) => $money(row.cost, 3),
            bodyPdfRender: function(row) {
                return this.bodyRender(row);
            },
        }, {
            name: "details",
            text: $trans('Details'),
            headStyle: {
                maxWidth: 500,
            },
            visible: false,
            bodyStyle: function() {
                return this.headStyle;
            },
            headPdfStyle: function() {
                return this.headStyle;
            },
            bodyRender: (row) => row.details ? $cap(row.details) : empty(),
            bodyPdfRender: function(row) {
                return this.bodyRender(row);
            },
            bodyCsvRender: function(row) {
                return this.bodyRender(row);
            },
        }, {
            name: "action",
            text: $trans("Actions"),
            headStyle: {
                width: 20,
                textAlign: "center"
            },
            bodyStyle: {
                width: 20,
                textAlign: "center"
            },
            bodyRender: (row) => {
                return `<action-tools target="${row.id}"csrf="${Csrf}"patch="${Patch}"clear="${Clear}"></action-tools>`;
            },
            headPdfStyle: function() {
                return this.headStyle;
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
            name: "ref",
            text: $trans("Reservation"),
            headStyle: {
                width: 120,
                textAlign: "center",
            },
            bodyStyle: {
                width: 120,
                textAlign: "center",
            },
            headPdfStyle: function() {
                return this.headStyle;
            },
            bodyPdfStyle: function() {
                return this.bodyStyle;
            },
        }, {
            name: "renter",
            text: $trans("Renter"),
            bodyRender: (row) => {
                var name = empty();
                if (row.client) name = $cap(row.client.first_name) + ' ' + $cap(row.client.last_name);
                if (row.agency) name = $cap(row.agency.name);
                return name;
            },
            bodyPdfRender: function(row) {
                return this.bodyRender(row);
            },
            bodyCsvRender: function(row) {
                return this.bodyRender(row);
            },
        }, {
            name: "vehicle",
            text: $trans("Vehicle"),
            bodyRender: (row) => row.vehicle ? $cap($trans(row.vehicle.brand)) + ' ' + $cap($trans(row.vehicle.model)) + ' ' + row.vehicle.year + ' (' + $cap(row.vehicle.registration) + ")" : empty(),
            bodyPdfRender: function(row) {
                return this.bodyRender(row);
            },
            bodyCsvRender: function(row) {
                return this.bodyRender(row);
            },
        }, {
            name: "price",
            text: $trans("Price") + " (" + Currency + ")",
            headStyle: {
                width: 120,
                textAlign: "center",
            },
            bodyStyle: {
                width: 120,
                textAlign: "center",
            },
            headPdfStyle: function() {
                return this.headStyle;
            },
            bodyPdfStyle: function() {
                return this.bodyStyle;
            },
            bodyRender: (row) => $money(row.price, 3),
            bodyPdfRender: function(row) {
                return this.bodyRender(row);
            },
        }, {
            name: "total",
            text: $trans("Total") + " (" + Currency + ")",
            headStyle: {
                width: 120,
                textAlign: "center",
            },
            bodyStyle: {
                width: 120,
                textAlign: "center",
            },
            headPdfStyle: function() {
                return this.headStyle;
            },
            bodyPdfStyle: function() {
                return this.bodyStyle;
            },
            bodyRender: (row) => $money(row.total, 3),
            bodyPdfRender: function(row) {
                return this.bodyRender(row);
            },
        }, {
            name: "payment",
            text: $trans("Payment") + " (" + Currency + ")",
            headStyle: {
                width: 160,
                textAlign: "center",
            },
            bodyStyle: {
                width: 160,
                textAlign: "center",
            },
            headPdfStyle: function() {
                return this.headStyle;
            },
            bodyPdfStyle: function() {
                return this.bodyStyle;
            },
            bodyRender: (row) => $money(JSON.parse(row.payment).reduce((a, e) => a + e, 0), 3),
            bodyPdfRender: function(row) {
                return this.bodyRender(row);
            },
        }, {
            name: "creance",
            text: $trans("Creance") + " (" + Currency + ")",
            headStyle: {
                width: 160,
                textAlign: "center",
            },
            bodyStyle: {
                width: 160,
                textAlign: "center",
            },
            headPdfStyle: function() {
                return this.headStyle;
            },
            bodyPdfStyle: function() {
                return this.bodyStyle;
            },
            bodyRender: (row) => $money(row.total - JSON.parse(row.payment).reduce((a, e) => a + e, 0), 3),
            bodyPdfRender: function(row) {
                return this.bodyRender(row);
            },
        }, {
            name: "action",
            text: $trans("Actions"),
            headStyle: {
                width: 20,
                textAlign: "center"
            },
            bodyStyle: {
                width: 20,
                textAlign: "center"
            },
            bodyRender: (row) => {
                return `<action-tools target="${row.id}"csrf="${Csrf}"patch="${Patch}"print="${Print}"></action-tools>`;
            },
            headPdfStyle: function() {
                return this.headStyle;
            },
            bodyPdfStyle: function() {
                return this.bodyStyle;
            },
            bodyPdfRender: () => empty(),
            bodyCsvRender: () => empty(),
        }],
    }

Neo.load(function() {
    $qall(".nav-colors svg").forEach((svg, i) => {
        svg.style.color = "var(--color-" + i + ")";
    });

    $qall(".sys-colors svg").forEach((svg, i) => {
        svg.style.color = "var(--color-sys-" + i + ")";
    });
})