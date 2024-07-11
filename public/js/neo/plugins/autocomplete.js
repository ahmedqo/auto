Neo.Component({ctl:!0,tag:"neo-autocomplete",tpl:'return function($CONTEXT$,$HELPER$,$EACH$,$SIZE$,$ESCAPE$,$ERROR$){var $TXT$=[],$JSX$=[],$INDEX$=0,$LINE$=0,$COL$=0;function $ADDTXT$($LINE$){if(!$TXT$[$INDEX$]){$TXT$[$INDEX$]=\'\'}$TXT$[$INDEX$]=($TXT$[$INDEX$]+$LINE$).replace(/\\n(:?\\s*\\n)+/g,\'\\n\')}function $ADDJSX$($LINE$){$JSX$[$INDEX$]=$LINE$,$INDEX$++}with($CONTEXT$||{}){try{$LINE$=1;$COL$=1;$ADDTXT$("<slot name=\\"start\\"></slot>\\n<div ref=\\"wrapper\\" part=\\"wrapper\\">\\n");$LINE$=3;$COL$=1;if($HELPER$["truty"]($HELPER$["props"]["label"])){$LINE$=3;$COL$=30;$ADDTXT$("\\n<label ref=\\"label\\" part=\\"label\\" for=\\"");$LINE$=4;$COL$=38;$ADDJSX$($HELPER$["state"]["uid"]);$LINE$=4;$COL$=54;$ADDTXT$("\\">");$LINE$=4;$COL$=56;$ADDJSX$($HELPER$["props"]["label"]);$LINE$=4;$COL$=74;$ADDTXT$("</label>\\n");$LINE$=5;$COL$=1;}$LINE$=5;$COL$=12;$ADDTXT$("\\n<input ref=\\"field\\" part=\\"field\\" id=\\"");$LINE$=6;$COL$=37;$ADDJSX$($HELPER$["state"]["uid"]);$LINE$=6;$COL$=53;$ADDTXT$("\\"\\n@keypress=\\"");$LINE$=7;$COL$=12;$ADDJSX$($HELPER$["rules"]["keypress"]);$LINE$=7;$COL$=33;$ADDTXT$("\\"\\n@keydown=\\"");$LINE$=8;$COL$=11;$ADDJSX$($HELPER$["rules"]["keydown"]);$LINE$=8;$COL$=31;$ADDTXT$("\\"\\n@change=\\"");$LINE$=9;$COL$=10;$ADDJSX$($HELPER$["rules"]["change"]);$LINE$=9;$COL$=29;$ADDTXT$("\\"\\n@keyup=\\"");$LINE$=10;$COL$=9;$ADDJSX$($HELPER$["rules"]["keyup"]);$LINE$=10;$COL$=27;$ADDTXT$("\\"\\n@input=\\"");$LINE$=11;$COL$=9;$ADDJSX$($HELPER$["rules"]["input"]);$LINE$=11;$COL$=27;$ADDTXT$("\\"\\n@focus=\\"");$LINE$=12;$COL$=9;$ADDJSX$($HELPER$["rules"]["focus"]);$LINE$=12;$COL$=27;$ADDTXT$("\\"\\n@blur=\\"");$LINE$=13;$COL$=8;$ADDJSX$($HELPER$["rules"]["blur"]);$LINE$=13;$COL$=25;$ADDTXT$("\\"\\nvalue=\\"");$LINE$=14;$COL$=8;$ADDJSX$($HELPER$["props"]["query"]);$LINE$=14;$COL$=26;$ADDTXT$("\\"\\ntype=\\"search\\"\\nplaceholder=\\"");$LINE$=16;$COL$=14;$ADDJSX$($HELPER$["when"]($HELPER$["truty"]($HELPER$["props"]["placeholder"]), $HELPER$["props"]["placeholder"], \' \'));$LINE$=16;$COL$=78;$ADDTXT$("\\"\\n");$LINE$=17;$COL$=1;if($HELPER$["props"]["disable"]){$LINE$=17;$COL$=24;$ADDTXT$(" disabled=\\"");$LINE$=17;$COL$=35;$ADDJSX$($HELPER$["props"]["disable"]);$LINE$=17;$COL$=55;$ADDTXT$("\\" ");$LINE$=17;$COL$=57;}$LINE$=17;$COL$=68;$ADDTXT$("\\n/>\\n</div>\\n<svg ref=\\"icon\\" part=\\"icon\\" fill=\\"currentColor\\" viewBox=\\"0 0 48 48\\">\\n");$LINE$=21;$COL$=1;if($HELPER$["props"]["loading"]){$LINE$=21;$COL$=24;$ADDTXT$("\\n<path d=\\"M7.90396 31.4377C6.84107 30.306 6.09136 29.1249 5.65481 27.8942C5.21827 26.6636 5 25.3693 5 24.0113C5 20.1638 6.86954 16.8467 10.6086 14.0601C14.3477 11.2735 18.7606 9.88014 23.8472 9.88014H26.2957L22.3668 6.90962L24.9291 5L34.0396 11.7898L24.9291 18.5795L22.3099 16.6699L26.2387 13.7418H24.0181C20.26 13.7418 17.0144 14.7603 14.2813 16.7972C11.5481 18.8341 10.1816 21.2389 10.1816 24.0113C10.1816 24.9166 10.3049 25.7724 10.5517 26.5787C10.7984 27.385 11.1306 28.0994 11.5481 28.7217L7.90396 31.4377ZM23.164 43.15L14.0535 36.3602L23.164 29.4856L25.7263 31.4801L21.7404 34.4082H24.1889C27.909 34.4365 31.1356 33.4321 33.8687 31.3952C36.6019 29.3583 37.9684 26.9253 37.9684 24.0962C37.9684 23.2192 37.8451 22.3776 37.5983 21.5713C37.3516 20.765 37.0004 20.0365 36.5449 19.3858L40.246 16.6699C41.271 17.8864 42.0112 19.1029 42.4667 20.3194C42.9222 21.5359 43.15 22.7948 43.15 24.0962C43.15 27.972 41.2805 31.3174 37.5414 34.1323C33.8023 36.9473 29.4084 38.3406 24.3597 38.3123H21.7404L25.7263 41.2828L23.164 43.15Z\\"/>\\n");$LINE$=23;$COL$=1;}else{$LINE$=23;$COL$=11;$ADDTXT$("\\n<path d=\\"M19.25 38.6V34.05H28.9V38.6H19.25ZM11.1 26.55V22.05H37V26.55H11.1ZM5 14.55V10H43.15V14.55H5Z\\" />\\n");$LINE$=25;$COL$=1;}$LINE$=25;$COL$=12;$ADDTXT$("\\n</svg>\\n<slot name=\\"end\\"></slot>\\n");$LINE$=28;$COL$=1;if($HELPER$["state"]["show"]){$LINE$=28;$COL$=21;$ADDTXT$("\\n<ul ref=\\"content\\" part=\\"content\\" @click:propagation=\\"");$LINE$=29;$COL$=54;$ADDJSX$(() => {});$LINE$=29;$COL$=68;$ADDTXT$("\\">\\n");$LINE$=30;$COL$=1;if(Array["isArray"]($HELPER$["props"]["data"])){$LINE$=30;$COL$=36;$ADDTXT$("\\n");$LINE$=31;$COL$=1;$EACH$($HELPER$["props"]["data"],function(_,result,$LOOP$){$LINE$=31;$COL$=35;$ADDTXT$("\\n<li ref=\\"item\\" part=\\"item\\" tabindex=\\"0\\" @click:propagation=\\"");$LINE$=32;$COL$=61;$ADDJSX$((event) => $HELPER$["rules"]["select"](event, result));$LINE$=32;$COL$=106;$ADDTXT$("\\" @keydown:propagation=\\"");$LINE$=32;$COL$=130;$ADDJSX$((event) => $HELPER$["rules"]["select"](event, result));$LINE$=32;$COL$=175;$ADDTXT$("\\">\\n");$LINE$=33;$COL$=1;$ADDJSX$($HELPER$["rules"]["write"](result, $HELPER$["props"]["setQuery"]));$LINE$=33;$COL$=44;$ADDTXT$("\\n</li>\\n");$LINE$=35;$COL$=1;});$LINE$=35;$COL$=14;$ADDTXT$("\\n");$LINE$=36;$COL$=1;}$LINE$=36;$COL$=12;$ADDTXT$("\\n</ul>\\n");$LINE$=38;$COL$=1;}}catch(e){throw new $ERROR$([e.message,\'\\n\\tat\',\'Line:\',\'"\'+$LINE$+\'"\',\'Col:\',\'"\'+$COL$+\'"\'].join(\' \'))}}return [$TXT$,...$JSX$]}',css:'return function($CONTEXT$,$HELPER$,$EACH$,$SIZE$,$ESCAPE$,$ERROR$){var $TXT$=[],$JSX$=[],$INDEX$=0,$LINE$=0,$COL$=0;function $ADDTXT$($LINE$){if(!$TXT$[$INDEX$]){$TXT$[$INDEX$]=\'\'}$TXT$[$INDEX$]=($TXT$[$INDEX$]+$LINE$).replace(/\\n(:?\\s*\\n)+/g,\'\\n\')}function $ADDJSX$($LINE$){$JSX$[$INDEX$]=$LINE$,$INDEX$++}with($CONTEXT$||{}){try{$LINE$=1;$COL$=1;$ADDTXT$("<style>* {\\nbox-sizing: border-box;\\nfont-family: inherit;\\n}\\n\\n");$LINE$=6;$COL$=1;$EACH$($HELPER$["Theme"]["MEDIA"],function(_,media,$LOOP$){$LINE$=6;$COL$=35;$ADDTXT$("\\n@");$LINE$=7;$COL$=2;$ADDJSX$(media);$LINE$=7;$COL$=13;$ADDTXT$("keyframes animate-off {\\n0% {\\nopacity: 1;\\n");$LINE$=10;$COL$=1;$EACH$($HELPER$["Theme"]["MEDIA"],function(_,_media,$LOOP$){$LINE$=10;$COL$=36;$ADDTXT$("\\n");$LINE$=11;$COL$=1;$ADDJSX$(_media);$LINE$=11;$COL$=13;$ADDTXT$("transform: translateY(0px);\\n");$LINE$=12;$COL$=1;});$LINE$=12;$COL$=14;$ADDTXT$("\\n}\\n100% {\\nopacity: 0;\\n");$LINE$=16;$COL$=1;$EACH$($HELPER$["Theme"]["MEDIA"],function(_,_media,$LOOP$){$LINE$=16;$COL$=36;$ADDTXT$("\\n");$LINE$=17;$COL$=1;$ADDJSX$(_media);$LINE$=17;$COL$=13;$ADDTXT$("transform: translateY(20px);\\n");$LINE$=18;$COL$=1;});$LINE$=18;$COL$=14;$ADDTXT$("\\n}\\n}\\n\\n@");$LINE$=22;$COL$=2;$ADDJSX$(media);$LINE$=22;$COL$=13;$ADDTXT$("keyframes animate-on {\\n0% {\\nopacity: 0;\\n");$LINE$=25;$COL$=1;$EACH$($HELPER$["Theme"]["MEDIA"],function(_,_media,$LOOP$){$LINE$=25;$COL$=36;$ADDTXT$("\\n");$LINE$=26;$COL$=1;$ADDJSX$(_media);$LINE$=26;$COL$=13;$ADDTXT$("transform: translateY(20px);\\n");$LINE$=27;$COL$=1;});$LINE$=27;$COL$=14;$ADDTXT$("\\n}\\n100% {\\nopacity: 1;\\n");$LINE$=31;$COL$=1;$EACH$($HELPER$["Theme"]["MEDIA"],function(_,_media,$LOOP$){$LINE$=31;$COL$=36;$ADDTXT$("\\n");$LINE$=32;$COL$=1;$ADDJSX$(_media);$LINE$=32;$COL$=13;$ADDTXT$("transform: translateY(0px);\\n");$LINE$=33;$COL$=1;});$LINE$=33;$COL$=14;$ADDTXT$("\\n}\\n}\\n\\n@");$LINE$=37;$COL$=2;$ADDJSX$(media);$LINE$=37;$COL$=13;$ADDTXT$("keyframes rotate {\\n100% {\\n");$LINE$=39;$COL$=1;$EACH$($HELPER$["Theme"]["MEDIA"],function(_,_media,$LOOP$){$LINE$=39;$COL$=36;$ADDTXT$("\\n");$LINE$=40;$COL$=1;$ADDJSX$(_media);$LINE$=40;$COL$=13;$ADDTXT$("transform: rotate(360deg);\\n");$LINE$=41;$COL$=1;});$LINE$=41;$COL$=14;$ADDTXT$("\\n}\\n}\\n");$LINE$=44;$COL$=1;});$LINE$=44;$COL$=14;$ADDTXT$("\\n\\n::-webkit-search-cancel-button,\\n::-webkit-inner-spin-button,\\n::-webkit-outer-spin-button {\\n");$LINE$=49;$COL$=1;$EACH$($HELPER$["Theme"]["MEDIA"],function(_,_media,$LOOP$){$LINE$=49;$COL$=36;$ADDTXT$("\\n");$LINE$=50;$COL$=1;$ADDJSX$(_media);$LINE$=50;$COL$=13;$ADDTXT$("appearance: none;\\n");$LINE$=51;$COL$=1;});$LINE$=51;$COL$=14;$ADDTXT$("\\ndisplay: none;\\n}\\n\\n");$LINE$=55;$COL$=1;if($HELPER$["state"]["show"]){$LINE$=55;$COL$=21;$ADDTXT$("\\n::-webkit-scrollbar {\\nwidth: 5px;\\nheight: 5px;\\n");$LINE$=59;$COL$=1;$EACH$($HELPER$["Theme"]["MEDIA"],function(_,_media,$LOOP$){$LINE$=59;$COL$=36;$ADDTXT$("\\n");$LINE$=60;$COL$=1;$ADDJSX$(_media);$LINE$=60;$COL$=13;$ADDTXT$("appearance: none;\\n");$LINE$=61;$COL$=1;});$LINE$=61;$COL$=14;$ADDTXT$("\\nbackground: transparent;\\n}\\n\\n::-webkit-scrollbar-track {\\nbackground: transparent;\\n}\\n\\n::-webkit-scrollbar-thumb {\\nborder-radius: 2px;\\nbackground: ");$LINE$=71;$COL$=13;$ADDJSX$($HELPER$["Theme"]["colors"]("GRAY", 300));$LINE$=71;$COL$=45;$ADDTXT$(";\\n}\\n\\n::-webkit-scrollbar-thumb:hover {\\nbackground: ");$LINE$=75;$COL$=13;$ADDJSX$($HELPER$["Theme"]["colors"]("GRAY", 400));$LINE$=75;$COL$=45;$ADDTXT$(";\\n}\\n");$LINE$=77;$COL$=1;}$LINE$=77;$COL$=12;$ADDTXT$("\\n\\ninput {\\n");$LINE$=80;$COL$=1;$EACH$($HELPER$["Theme"]["MEDIA"],function(_,_media,$LOOP$){$LINE$=80;$COL$=36;$ADDTXT$("\\n");$LINE$=81;$COL$=1;$ADDJSX$(_media);$LINE$=81;$COL$=13;$ADDTXT$("appearance: textfield;\\n");$LINE$=82;$COL$=1;});$LINE$=82;$COL$=14;$ADDTXT$("\\n}\\n\\n:host {\\ngap: .5rem;\\nwidth: auto;\\nmax-width: 100%;\\nflex-wrap: wrap;\\nborder-width: 1px;\\nposition: relative;\\nalign-items: center;\\nborder-style: solid;\\ndisplay: inline-flex;\\nborder-radius: .25rem;\\npadding: .375rem .75rem;\\n");$LINE$=97;$COL$=1;if($HELPER$["props"]["outline"]){$LINE$=97;$COL$=24;$ADDTXT$("\\nborder-color: ");$LINE$=98;$COL$=15;$ADDJSX$($HELPER$["Theme"]["colors"]("BLACK"));$LINE$=98;$COL$=43;$ADDTXT$(";\\n");$LINE$=99;$COL$=1;}else{$LINE$=99;$COL$=11;$ADDTXT$("\\nbackground: ");$LINE$=100;$COL$=13;$ADDJSX$($HELPER$["Theme"]["colors"]("LIGHT"));$LINE$=100;$COL$=41;$ADDTXT$(";\\nborder-color: ");$LINE$=101;$COL$=15;$ADDJSX$($HELPER$["Theme"]["colors"]("SHADE"));$LINE$=101;$COL$=43;$ADDTXT$(";\\n");$LINE$=102;$COL$=1;}$LINE$=102;$COL$=12;$ADDTXT$("\\n}\\n\\n");$LINE$=105;$COL$=1;if(!$HELPER$["props"]["disable"]){$LINE$=105;$COL$=25;$ADDTXT$("\\n:host(:focus),\\n:host(:focus-within) {\\noutline-width: 2px;\\noutline-offset: -2px;\\noutline-style: solid;\\noutline-color: ");$LINE$=111;$COL$=16;$ADDJSX$($HELPER$["Theme"]["colors"]("PRIME", 400));$LINE$=111;$COL$=49;$ADDTXT$(";\\n}\\n");$LINE$=113;$COL$=1;}$LINE$=113;$COL$=12;$ADDTXT$("\\n\\n[part=\\"wrapper\\"] {\\nflex: 1;\\nwidth: 0%;\\ndisplay: flex;\\nposition: relative;\\nflex-direction: column;\\n}\\n\\n");$LINE$=123;$COL$=1;if($HELPER$["truty"]($HELPER$["props"]["label"])){$LINE$=123;$COL$=30;$ADDTXT$("\\n[part=\\"label\\"] {\\nwidth: 100%;\\ndisplay: flex;\\noverflow: hidden;\\nfont-weight: 600;\\ninset: 0 0 auto 0;\\nposition: absolute;\\npadding: .437rem 0;\\nwhite-space: nowrap;\\nflex-direction: column;\\ntext-overflow: ellipsis;\\njustify-content: center;\\ncolor: ");$LINE$=136;$COL$=8;$ADDJSX$($HELPER$["Theme"]["colors"]("BLACK", 50));$LINE$=136;$COL$=40;$ADDTXT$(";\\nfont-size: ");$LINE$=137;$COL$=12;$ADDJSX$($HELPER$["Theme"]["sizes"]("BASE"));$LINE$=137;$COL$=38;$ADDTXT$(";\\nline-height: ");$LINE$=138;$COL$=14;$ADDJSX$($HELPER$["Theme"]["lines"]("SMALL"));$LINE$=138;$COL$=41;$ADDTXT$(";\\n");$LINE$=139;$COL$=1;$EACH$($HELPER$["Theme"]["MEDIA"],function(_,_media,$LOOP$){$LINE$=139;$COL$=36;$ADDTXT$("\\n");$LINE$=140;$COL$=1;$ADDJSX$(_media);$LINE$=140;$COL$=13;$ADDTXT$("transition: 200ms ease-in-out padding, 200ms ease-in-out color, 200ms ease-in-out font-size, 200ms ease-in-out line-height;\\n");$LINE$=141;$COL$=1;});$LINE$=141;$COL$=14;$ADDTXT$("\\n}\\n\\n[part=\\"label\\"]:has(+ [part=\\"field\\"]:not(:placeholder-shown)),\\n[part=\\"label\\"]:has(+ [part=\\"field\\"]:focus) {\\npadding: 0;\\noverflow: visible;\\ncolor: ");$LINE$=148;$COL$=8;$ADDJSX$($HELPER$["Theme"]["colors"]("BLACK", 80));$LINE$=148;$COL$=40;$ADDTXT$(";\\nfont-size: ");$LINE$=149;$COL$=12;$ADDJSX$($HELPER$["Theme"]["sizes"]("XSMALL"));$LINE$=149;$COL$=40;$ADDTXT$(";\\nline-height: ");$LINE$=150;$COL$=14;$ADDJSX$($HELPER$["Theme"]["lines"]("THIN"));$LINE$=150;$COL$=40;$ADDTXT$(";\\n}\\n");$LINE$=152;$COL$=1;}$LINE$=152;$COL$=12;$ADDTXT$("\\n\\n[part=\\"field\\"] {\\nwidth: 100%;\\noutline: none;\\nborder: unset;\\ndisplay: block;\\nbackground: transparent;\\ncolor: ");$LINE$=160;$COL$=8;$ADDJSX$($HELPER$["Theme"]["colors"]("BLACK"));$LINE$=160;$COL$=36;$ADDTXT$(";\\nfont-size: ");$LINE$=161;$COL$=12;$ADDJSX$($HELPER$["Theme"]["sizes"]("BASE"));$LINE$=161;$COL$=38;$ADDTXT$(";\\nline-height: ");$LINE$=162;$COL$=14;$ADDJSX$($HELPER$["Theme"]["lines"]("SMALL"));$LINE$=162;$COL$=41;$ADDTXT$(";\\ncaret-color: ");$LINE$=163;$COL$=14;$ADDJSX$($HELPER$["Theme"]["colors"]("PRIME", 400));$LINE$=163;$COL$=47;$ADDTXT$(";\\nmargin: ");$LINE$=164;$COL$=9;$ADDJSX$($HELPER$["truty"]($HELPER$["props"]["label"]) ? ".75rem 0 0 0" : ".375rem 0");$LINE$=164;$COL$=66;$ADDTXT$(";\\n}\\n\\n[part=\\"icon\\"] {\\nwidth: 1.2rem;\\nheight: 1.2rem;\\ndisplay: block;\\npointer-events: none;\\ncolor: ");$LINE$=172;$COL$=8;$ADDJSX$($HELPER$["Theme"]["colors"]("BLACK"));$LINE$=172;$COL$=36;$ADDTXT$(";\\n");$LINE$=173;$COL$=1;if($HELPER$["props"]["loading"]){$LINE$=173;$COL$=24;$ADDTXT$("\\n");$LINE$=174;$COL$=1;$EACH$($HELPER$["Theme"]["MEDIA"],function(_,_media,$LOOP$){$LINE$=174;$COL$=36;$ADDTXT$("\\n");$LINE$=175;$COL$=1;$ADDJSX$(_media);$LINE$=175;$COL$=13;$ADDTXT$("animation: rotate 200ms ease-in-out infinite;\\n");$LINE$=176;$COL$=1;});$LINE$=176;$COL$=14;$ADDTXT$("\\n");$LINE$=177;$COL$=1;}$LINE$=177;$COL$=12;$ADDTXT$("\\n}\\n\\n");$LINE$=180;$COL$=1;if(!$HELPER$["props"]["disable"]){$LINE$=180;$COL$=25;$ADDTXT$("\\n:host(:focus) [part=\\"icon\\"],\\n:host(:focus-within) [part=\\"icon\\"] {\\ncolor: ");$LINE$=183;$COL$=8;$ADDJSX$($HELPER$["Theme"]["colors"]("PRIME", 400));$LINE$=183;$COL$=41;$ADDTXT$(";\\n}\\n");$LINE$=185;$COL$=1;}$LINE$=185;$COL$=12;$ADDTXT$("\\n\\n");$LINE$=187;$COL$=1;if($HELPER$["state"]["show"]){$LINE$=187;$COL$=21;$ADDTXT$("\\n[part=\\"content\\"] {\\nmargin: 0;\\npadding: 0;\\nwidth: 100%;\\ndisplay: flex;\\noverflow: auto;\\nlist-style: none;\\nmax-height: 300px;\\nposition: absolute;\\ninset: auto 0 auto 0;\\nborder-radius: .25rem;\\nflex-direction: column;\\n");$LINE$=200;$COL$=1;if(!$HELPER$["state"]["expand"]){$LINE$=200;$COL$=24;$ADDTXT$("\\npointer-events: none;\\n");$LINE$=202;$COL$=1;}$LINE$=202;$COL$=12;$ADDTXT$("\\nz-index: ");$LINE$=203;$COL$=10;$ADDJSX$($HELPER$["Theme"]["layer"]());$LINE$=203;$COL$=30;$ADDTXT$(";\\nbackground: ");$LINE$=204;$COL$=13;$ADDJSX$($HELPER$["Theme"]["colors"]("WHITE"));$LINE$=204;$COL$=41;$ADDTXT$(";\\nborder: 1px solid ");$LINE$=205;$COL$=19;$ADDJSX$($HELPER$["Theme"]["colors"]("BLACK", 20));$LINE$=205;$COL$=51;$ADDTXT$(";\\n");$LINE$=206;$COL$=1;$ADDJSX$($HELPER$["state"]["pos"] ? "bottom" : "top");$LINE$=206;$COL$=36;$ADDTXT$(": calc(100% + .25rem);\\n");$LINE$=207;$COL$=1;$EACH$($HELPER$["Theme"]["MEDIA"],function(_,_media,$LOOP$){$LINE$=207;$COL$=36;$ADDTXT$("\\n");$LINE$=208;$COL$=1;$ADDJSX$(_media);$LINE$=208;$COL$=13;$ADDTXT$("box-shadow: 0px 8px 8px -8px ");$LINE$=208;$COL$=42;$ADDJSX$($HELPER$["Theme"]["colors"]("BLACK", 20));$LINE$=208;$COL$=74;$ADDTXT$(";\\n");$LINE$=209;$COL$=1;$ADDJSX$(_media);$LINE$=209;$COL$=13;$ADDTXT$("animation: animate-");$LINE$=209;$COL$=32;$ADDJSX$($HELPER$["state"]["expand"] ? "on" : "off");$LINE$=209;$COL$=66;$ADDTXT$(" 200ms ease-in-out forwards;\\n");$LINE$=210;$COL$=1;});$LINE$=210;$COL$=14;$ADDTXT$("\\n}\\n\\n[part=\\"item\\"] {\\nwidth: 100%;\\noutline: none;\\ndisplay: block;\\nfont-family: inherit;\\npadding: .25rem .5rem;\\nfont-size: ");$LINE$=219;$COL$=12;$ADDJSX$($HELPER$["Theme"]["sizes"]("MEDIUM"));$LINE$=219;$COL$=40;$ADDTXT$(";\\nline-height: ");$LINE$=220;$COL$=14;$ADDJSX$($HELPER$["Theme"]["lines"]("MEDIUM"));$LINE$=220;$COL$=42;$ADDTXT$(";\\n}\\n\\n[part=\\"item\\"]:hover,\\n[part=\\"item\\"]:focus,\\n[part=\\"item\\"]:focus-within {\\ncolor: ");$LINE$=226;$COL$=8;$ADDJSX$($HELPER$["Theme"]["colors"]("BLACK"));$LINE$=226;$COL$=36;$ADDTXT$(";\\nbackground: ");$LINE$=227;$COL$=13;$ADDJSX$($HELPER$["Theme"]["colors"]("PRIME", 40));$LINE$=227;$COL$=45;$ADDTXT$(";\\n}\\n");$LINE$=229;$COL$=1;}$LINE$=229;$COL$=12;$ADDTXT$("</style>");}catch(e){throw new $ERROR$([e.message,\'\\n\\tat\',\'Line:\',\'"\'+$LINE$+\'"\',\'Col:\',\'"\'+$COL$+\'"\'].join(\' \'))}}return [$TXT$,...$JSX$]}'})({attrs:["label","loading","outline","disable","placeholder","set-query","set-value"],props:{data:[],label:"",query:"",value:"",setQuery:null,setValue:null,loading:!1,outline:!1,disable:!1,placeholder:""},state:{uid:"uid_"+Neo.Helper.random(),expand:!1,show:!1,pos:!1},rules:{focus(){this.emit("focus",{value:this.props.value,query:this.props.query})},blur(){this.emit("blur",{value:this.props.value,query:this.props.query})},change(){Neo.Helper.falsy(this.props.value)&&(this.props.query=""),this.emit("change",{value:this.props.value,query:this.props.query})},keyup(){this.emit("keyup",{value:this.props.value,query:this.props.query})},keydown(){this.emit("keydown",{value:this.props.value,query:this.props.query})},keypress(){this.emit("keypress",{value:this.props.value,query:this.props.query})},input($){this.props.value="",this.props.query=$.target.value,this.emit("input",{value:this.props.value,query:this.props.query})},select($,e){"click"!==$.type&&13!==$.keyCode||this.emit("select",{data:e},()=>{this.setProps({query:this.rules.write(e,this.props.setQuery),value:this.rules.write(e,this.props.setValue)}),this.state.expand=!1})},write($,e){return e?e.split(".").reduce(($,e)=>$[e],$):$},hide($){!this.root.contains($.target)&&$.target!==this&&this.state.expand&&(this.state.expand=!1)},pos(){this.state.show&&(this.state.pos=window.innerHeight-this.getBoundingClientRect().top<this.refs.content.clientHeight)}},cycle:{created(){this.reset=function(){this.state.expand=!1,this.setProps({value:"",query:""}),this.emit("reset")},this.focus=function(){this.refs.field.focus()},this.blur=function(){this.refs.field.blur()}},mounted(){this.hasAttribute("value")&&(this.props.value=this.getAttribute("value"),this.removeAttribute("value")),this.hasAttribute("query")&&(this.props.query=this.getAttribute("query"),this.removeAttribute("query")),window.addEventListener("click",this.rules.hide),window.addEventListener("scroll",this.rules.pos),this.ctl.form&&this.ctl.form.addEventListener("reset",this.reset.bind(this))},removed(){window.removeEventListener("click",this.rules.hide),window.removeEventListener("scroll",this.rules.pos),this.ctl.form&&this.ctl.form.removeEventListener("reset",this.reset.bind(this))},updated($,e,L,n){Neo.Helper.option({attrs:{"label,placeholder,set-query,set-value":()=>{this.props[Neo.Helper.Str.snake($)]=L},"outline,disable,loading":()=>{this.props[$]=Neo.Helper.truty(L)||this.hasAttribute($)&&!["false","null","undefined"].includes(this.getAttribute($))}},state:{show:()=>{this.focus(),this.emit("change:expand",{data:L})},expand:()=>{L?(this.state.show=L,this.rules.pos()):setTimeout(()=>{this.state.show=L},250)}},props:{"label,setQuery,setValue,outline,loading,placeholder":()=>{this.emit("change:"+$,{data:L})},disable:()=>{L&&(this.state.expand=!1),this.emit("change:disable",{data:L})},query:()=>{Neo.Helper.falsy(L)&&(this.props.value=""),this.emit("change:"+$,{data:L})},value:()=>{this.ctl.setFormValue(L||null)},data:()=>{this.state.expand=Array.isArray(L)&&Boolean(L.length)}}}[n],$)}}}).define();