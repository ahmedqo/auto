<neo-sidebar id="sidebar">
    <neo-topbar transparent>
        <img src="{{ asset('img/logo.webp') }}?v={{ env('APP_VERSION') }}" alt="{{ env('COMPANY_NAME') }} logo image"
            class="block w-full mx-auto pointer-events-auto" width="500" height="349" loading="lazy" />
    </neo-topbar>
    <ul class="nav-colors w-full flex flex-col flex-1 gap-8 mt-6">
        <li class="w-full">
            <ul class="w-full flex flex-col">
                <li class="w-full">
                    <h3 class="font-x-thin text-x-black text-sm mx-2">{{ __('General') }}</h3>
                    <hr class="border-x-shade">
                </li>
                <li class="w-full">
                    <a href="{{ route('views.core.index') }}" aria-label="dashboard_page_link"
                        class="w-full flex flex-wrap gap-2 p-2 text-start text-x-black items-center outline-none !bg-opacity-10 hover:bg-x-black focus:bg-x-black focus-within:bg-x-black {{ Core::matchRoute('dashboard') ? '!bg-x-black' : '' }}">
                        <svg class="block w-6 h-6 pointer-events-none" fill="currentcolor" viewBox="0 -960 960 960">
                            <path
                                d="M99-425v-356q0-32.025 24.194-56.512Q147.387-862 179-862h277v437H99Zm405-437h277q32.025 0 56.512 24.488Q862-813.025 862-781v197H504v-278Zm0 763v-436h358v356q0 31.613-24.488 55.806Q813.025-99 781-99H504ZM99-376h357v277H179q-31.613 0-55.806-24.194Q99-147.387 99-179v-197Z" />
                        </svg>
                        <span class="block flex-1 text-base">{{ __('Dashboard') }}</span>
                    </a>
                </li>
                <li class="w-full">
                    <a href="{{ route('views.core.calendar') }}" aria-label="dashboard_page_link"
                        class="w-full flex flex-wrap gap-2 p-2 text-start text-x-black items-center outline-none !bg-opacity-10 hover:bg-x-black focus:bg-x-black focus-within:bg-x-black {{ Core::matchRoute('calendar') ? '!bg-x-black' : '' }}">
                        <svg class="block w-6 h-6 pointer-events-none" fill="currentcolor" viewBox="0 -960 960 960">
                            <path
                                d="M480.49-390q-20.91 0-35.7-14.59Q430-419.18 430-439.79q0-20.61 14.79-35.41 14.79-14.8 35.7-14.8 20.91 0 35.21 14.59t14.3 35.2q0 20.61-14.3 35.41-14.3 14.8-35.21 14.8Zm-160.28 0q-20.61 0-35.41-14.59-14.8-14.59-14.8-35.2 0-20.61 14.59-35.41 14.59-14.8 35.2-14.8 20.61 0 35.41 14.59 14.8 14.59 14.8 35.2 0 20.61-14.59 35.41-14.59 14.8-35.2 14.8Zm319.3 0Q620-390 605-404.59q-15-14.59-15-35.2 0-20.61 15-35.41 15-14.8 35.01-14.8 20.01 0 35 14.59Q690-460.82 690-440.21q0 20.61-14.79 35.41-14.79 14.8-35.7 14.8ZM480.49-230q-20.91 0-35.7-15Q430-260 430-280.01q0-20.01 14.79-35Q459.58-330 480.49-330q20.91 0 35.21 14.79t14.3 35.7Q530-260 515.7-245q-14.3 15-35.21 15Zm-160.28 0q-20.61 0-35.41-15-14.8-15-14.8-35.01 0-20.01 14.59-35Q299.18-330 319.79-330q20.61 0 35.41 14.79 14.8 14.79 14.8 35.7Q370-260 355.41-245q-14.59 15-35.2 15Zm319.3 0Q620-230 605-245q-15-15-15-35.01 0-20.01 15-35Q620-330 640.01-330q20.01 0 35 14.79Q690-300.42 690-279.51 690-260 675.21-245q-14.79 15-35.7 15ZM210-34q-57.12 0-96.56-40.14Q74-114.28 74-170v-541q0-57.13 39.44-96.56Q152.88-847 210-847h15v-79h113v79h284v-79h113v79h15q57.13 0 96.56 39.44Q886-768.13 886-711v541q0 55.72-39.44 95.86Q807.13-34 750-34H210Zm0-136h540v-398H210v398Z" />
                        </svg>
                        <span class="block flex-1 text-base">{{ __('Calendar') }}</span>
                    </a>
                </li>
            </ul>
        </li>
        <li class="w-full">
            <ul class="w-full flex flex-col">
                <li class="w-full">
                    <h3 class="font-x-thin text-x-black text-sm mx-2">{{ __('Finence') }}</h3>
                    <hr class="border-x-shade">
                </li>
                <li class="w-full">
                    <a href="{{ route('views.reservations.index') }}"
                        class="w-full flex flex-wrap gap-2 p-2 text-start text-x-black items-center outline-none !bg-opacity-10 hover:bg-x-black focus:bg-x-black focus-within:bg-x-black {{ Core::matchRoute('reservations') ? '!bg-x-black' : '' }}">
                        <svg class="block w-6 h-6 pointer-events-none" fill="currentcolor" viewBox="0 -960 960 960">
                            <path
                                d="M250-34q-74 0-125-51T74-209.53V-384h123v-542h690v716q0 74-51 125T711-34H250Zm461.5-136q16.5 0 28-11.36Q751-192.71 751-209.5V-790H333v406h338v174q0 17 12 28.5t28.5 11.5ZM373-610v-116h338v116H373Zm0 156v-116h338v116H373Z" />
                        </svg>
                        <span class="block flex-1 text-base">{{ __('Reservations') }}</span>
                    </a>
                </li>
                <li class="w-full">
                    <a href="{{ route('views.charges.index') }}"
                        class="w-full flex flex-wrap gap-2 p-2 text-start text-x-black items-center outline-none !bg-opacity-10 hover:bg-x-black focus:bg-x-black focus-within:bg-x-black {{ Core::matchRoute('charges') ? '!bg-x-black' : '' }}">
                        <svg class="block w-6 h-6 pointer-events-none" fill="currentcolor" viewBox="0 -960 960 960">
                            <path
                                d="M280-170v-373q0-58 39.5-97.5T416-680h374q57 0 96.5 39.5T926-544v296L712-34H416q-57 0-96.5-39.5T280-170ZM36-702q-10-56 22-102t88-56l368-64q56-10 102 22t56 88l9 54H416q-90 0-153 63t-63 154v316q-37-9-65-37.5T100-334L36-702Zm764 396H654v146l146-146Z" />
                        </svg>
                        <span class="block flex-1 text-base">{{ __('Charges') }}</span>
                    </a>
                </li>
            </ul>
        </li>
        <li class="w-full">
            <ul class="w-full flex flex-col">
                <li class="w-full">
                    <h3 class="font-x-thin text-x-black text-sm mx-2">{{ __('Management') }}</h3>
                    <hr class="border-x-shade">
                </li>
                <li class="w-full">
                    <a href="{{ route('views.blacklist.index') }}"
                        class="w-full flex flex-wrap gap-2 p-2 text-start text-x-black items-center outline-none !bg-opacity-10 hover:bg-x-black focus:bg-x-black focus-within:bg-x-black {{ Core::matchRoute('blacklist') ? '!bg-x-black' : '' }}">
                        <svg class="block w-6 h-6 pointer-events-none" fill="currentcolor" viewBox="0 -960 960 960">
                            <path
                                d="M320-278q18.6 0 31.8-13.2T365-323q0-18.6-13.2-31.8T320-368q-18.6 0-31.8 13.2T275-323q0 18.6 13.2 31.8T320-278Zm0-157q18.6 0 31.8-13.2T365-480q0-18.6-13.2-31.8T320-525q-18.6 0-31.8 13.2T275-480q0 18.6 13.2 31.8T320-435Zm0-158q18.6 0 31.8-13.08t13.2-31.5q0-18.42-13.2-31.92T320-683q-18.6 0-31.8 13.28t-13.2 32Q275-619 288.2-606t31.8 13Zm118 315h247v-90H438v90Zm0-157h247v-90H438v90Zm0-157h247v-90H438v90ZM212-76q-57.12 0-96.56-39.44Q76-154.88 76-212v-536q0-57.13 39.44-96.56Q154.88-884 212-884h536q57.13 0 96.56 39.44Q884-805.13 884-748v536q0 57.12-39.44 96.56Q805.13-76 748-76H212Z" />
                        </svg>
                        <span class="block flex-1 text-base">{{ __('Blacklist') }}</span>
                    </a>
                </li>
                <li class="w-full">
                    <a href="{{ route('views.clients.index') }}"
                        class="w-full flex flex-wrap gap-2 p-2 text-start text-x-black items-center outline-none !bg-opacity-10 hover:bg-x-black focus:bg-x-black focus-within:bg-x-black {{ Core::matchRoute('clients') ? '!bg-x-black' : '' }}">
                        <svg class="block w-6 h-6 pointer-events-none" fill="currentcolor" viewBox="0 -960 960 960">
                            <path
                                d="M13-116v-176q0-35.6 25.65-60.3Q64.3-377 98-377h146q20.21 0 34.11 7Q292-363 300-352q32 44 79.5 69.5T480.04-257q51.96 0 100.46-25.5Q629-308 663-352q6-11 19.59-18 13.6-7 34.41-7h146q35.6 0 60.8 24.7Q949-327.6 949-292v176H658v-128q-38 30-83 46.5T480.14-181q-47.8 0-93.97-16T304-243v127H13Zm466.88-214q-32.88 0-61.38-14.5T372-387q-22-29-48-43t-60-18q36-31 99.08-48T480-513q55.84 0 117.92 17T698-448q-34 4-61 18t-46 43q-19 27-48.58 42t-62.54 15ZM160-473q-47.67 0-81.33-34.25Q45-541.5 45-590.28 45-637 78.75-671t81.53-34Q209-705 243-670.8t34 80.8q0 48.67-34.2 82.83Q208.6-473 160-473Zm640 0q-47.67 0-81.33-34.25Q685-541.5 685-590.28 685-637 718.75-671t81.53-34Q849-705 883-670.8t34 80.8q0 48.67-34.2 82.83Q848.6-473 800-473ZM480-609q-47.67 0-81.33-34.25Q365-677.5 365-725.28q0-48.72 33.75-82.22t81.53-33.5Q529-841 563-807.3t34 82.3q0 47.67-34.2 81.83Q528.6-609 480-609Z" />
                        </svg>
                        <span class="block flex-1 text-base">{{ __('Clients') }}</span>
                    </a>
                </li>
                <li class="w-full">
                    <a href="{{ route('views.users.index') }}"
                        class="w-full flex flex-wrap gap-2 p-2 text-start text-x-black items-center outline-none !bg-opacity-10 hover:bg-x-black focus:bg-x-black focus-within:bg-x-black {{ Core::matchRoute('users') ? '!bg-x-black' : '' }}">
                        <svg class="block w-6 h-6 pointer-events-none" fill="currentcolor" viewBox="0 -960 960 960">
                            <path
                                d="M68-130q-20.1 0-33.05-12.45Q22-154.9 22-174.708V-246q0-42.011 21.188-75.36 21.187-33.348 59.856-50.662Q178-404 238.469-419 298.938-434 363-434q66.062 0 126.031 15Q549-404 624-372q38.812 16.018 60.406 49.452Q706-289.113 706-246v71.708Q706-155 693.275-142.5T660-130H68Zm679 0q11-5 20.5-17.5T777-177v-67q0-65-32.5-108T659-432q60 10 113 24.5t88.88 31.939q34.958 18.329 56.539 52.945Q939-288 939-241v66.787q0 19.505-13.225 31.859Q912.55-130 893-130H747ZM364-494q-71.55 0-115.275-43.725Q205-581.45 205-652.5q0-71.05 43.725-115.275Q292.45-812 363.5-812q70.05 0 115.275 44.113Q524-723.775 524-653q0 71.55-45.112 115.275Q433.775-494 364-494Zm386-159q0 70.55-44.602 114.775Q660.796-494 591.035-494 578-494 567.5-495.5T543-502q26-27.412 38.5-65.107 12.5-37.696 12.5-85.599 0-46.903-12.5-83.598Q569-773 543-804q10.75-3.75 23.5-5.875T591-812q69.775 0 114.387 44.613Q750-722.775 750-653Z" />
                        </svg>
                        <span class="block flex-1 text-base">{{ __('Users') }}</span>
                    </a>
                </li>
            </ul>
        </li>
        <li class="w-full">
            <ul class="w-full flex flex-col">
                <li class="w-full">
                    <h3 class="font-x-thin text-x-black text-sm mx-2">{{ __('Agency') }}</h3>
                    <hr class="border-x-shade">
                </li>
                <li class="w-full">
                    <a href="{{ route('views.brands.index') }}"
                        class="w-full flex flex-wrap gap-2 p-2 text-start text-x-black items-center outline-none !bg-opacity-10 hover:bg-x-black focus:bg-x-black focus-within:bg-x-black {{ Core::matchRoute('brands') ? '!bg-x-black' : '' }}">
                        <svg class="block w-6 h-6 pointer-events-none" fill="currentcolor" viewBox="0 -960 960 960">
                            <path
                                d="m437-439-69-73q-10-12-25-11.5t-26 9.5q-12 13-12 27.5t12 25.5l88 86q12 15 32 15t33-15l174-172q10-9 10-24.5T643-598q-11-8-25-8t-23 10L437-439ZM316-68l-60-103-119-25q-19-3-29.5-17t-7.5-32l14-116-76-90q-10-12-10-29t10-30l76-88-14-116q-3-18 7.5-32t29.5-18l119-24 60-104q9-15 26-20.5t34 1.5l104 49 105-49q16-5 33-1t26 19l61 105 118 24q19 4 29.5 18t7.5 32l-14 116 76 88q10 13 10 30t-10 29l-76 90 14 116q3 18-7.5 32T823-196l-118 25-61 104q-9 15-26 19t-33-1L480-98 376-49q-17 5-34 .5T316-68Z" />
                        </svg>
                        <span class="block flex-1 text-base">{{ __('Brands') }}</span>
                    </a>
                </li>
                <li class="w-full">
                    <a href="{{ route('views.models.index') }}"
                        class="w-full flex flex-wrap gap-2 p-2 text-start text-x-black items-center outline-none !bg-opacity-10 hover:bg-x-black focus:bg-x-black focus-within:bg-x-black {{ Core::matchRoute('models') ? '!bg-x-black' : '' }}">
                        <svg class="block w-6 h-6 pointer-events-none" fill="currentcolor" viewBox="0 -960 960 960">
                            <path
                                d="m264-572 178-288q6-10 17-15.5t22-5.5q11 0 21.375 5.289Q512.75-870.421 520-860l179 288q6 11 5.5 23.5t-5.625 23.948q-5.125 10.449-16.15 16.5Q671.7-502 659-502H302q-12.814 0-23.925-6.177-11.111-6.176-14.95-16.375Q257-536 256.5-548.5T264-572ZM726-39q-82.917 0-139.458-56.25Q530-151.5 530-234.588t56.662-140.75Q643.324-433 726.412-433t139.338 57.542Q922-317.917 922-235q0 82.083-56.958 139.042Q808.083-39 726-39ZM65-111v-257q0-18.775 12.625-32.388Q90.25-414 112-414h257q19.775 0 32.388 13.612Q414-386.775 414-368v257q0 21.75-12.612 34.375Q388.775-64 369-64H112q-21.75 0-34.375-12.625T65-111Z" />
                        </svg>
                        <span class="block flex-1 text-base">{{ __('Models') }}</span>
                    </a>
                </li>
                <li class="w-full">
                    <a href="{{ route('views.vehicles.index') }}"
                        class="w-full flex flex-wrap gap-2 p-2 text-start text-x-black items-center outline-none !bg-opacity-10 hover:bg-x-black focus:bg-x-black focus-within:bg-x-black {{ Core::matchRoute('vehicles') ? '!bg-x-black' : '' }}">
                        <svg class="block w-6 h-6 pointer-events-none" fill="currentcolor" viewBox="0 -960 960 960">
                            <path
                                d="M244-161v8q0 30.6-22.5 51.3Q199-81 166.7-81h-10.89Q125-81 102.5-103.29 80-125.58 80-156v-331.43L167-735q9.64-28.8 34.86-46.4Q227.08-799 258-799h444q30.92 0 56.14 17.6T793-735l87 247.57V-156q0 30.42-22.5 52.71T804.19-81H793.3q-32.3 0-54.8-20.7T716-153v-8H244Zm1-404h470l-36-105H281l-36 105Zm60 241q26 0 44-18.38t18-43.5q0-25.12-18-43.62-18-18.5-43.5-18.5T262-429.62q-18 18.38-18 43.5t18.13 43.62Q280.25-324 305-324Zm349.5 0q25.5 0 43.5-18.38t18-43.5q0-25.12-18.12-43.62Q679.75-448 655-448q-26 0-44 18.38t-18 43.5q0 25.12 18 43.62 18 18.5 43.5 18.5Z" />
                        </svg>
                        <span class="block flex-1 text-base">{{ __('Vehicles') }}</span>
                    </a>
                </li>
            </ul>
        </li>
        <li class="w-full">
            <ul class="w-full flex flex-col">
                <li class="w-full">
                    <h3 class="font-x-thin text-x-black text-sm mx-2">{{ __('System') }}</h3>
                    <hr class="border-x-shade">
                </li>
                <li class="w-full">
                    <a href="{{ route('views.core.settings') }}"
                        class="w-full flex flex-wrap gap-2 p-2 text-start text-x-black items-center outline-none !bg-opacity-10 hover:bg-x-black focus:bg-x-black focus-within:bg-x-black {{ Core::matchRoute('settings') ? '!bg-x-black' : '' }}">
                        <svg class="block w-6 h-6 pointer-events-none" fill="currentcolor" viewBox="0 -960 960 960">
                            <path
                                d="M497-572v-136h120v-165h136v165h120v136H497ZM617-87v-428h136v428H617Zm-410 0v-165H87v-136h376v136H343v165H207Zm0-358v-428h136v428H207Z" />
                        </svg>
                        <span class="block flex-1 text-base">{{ __('Settings') }}</span>
                    </a>
                </li>
            </ul>
        </li>
    </ul>
</neo-sidebar>
