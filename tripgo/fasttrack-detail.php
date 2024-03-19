<?php
function enx_get_page_content()
{
    ob_start();
?>
    <div class="enx-container site-wrapper">
        <div class="site-content">
            <div class="bg-gray-light3">
                <div class="relative bg-cover bg-center h-[600px] lg:h-[700px] xl:h-tour" style="
              background-image: url(https://html-travelata.wpzoro.com/assets/img/single-tour-bg.jpg);
            ">
                    <div class="absolute w-full h-full bg-secondary bg-opacity-90">
                        <div class="container h-full xl:flex items-center text-left justify-between">
                            <div class="max-w-prose py-10 xl:py-0">
                                <span class="bg-primary uppercase font-base rounded px-3 py-1 text-white text-xs md:text-sm tracking-widest">Explore tour</span>
                                <h1 class="font-heading text-primary text-3xl md:text-5xl lg:text-6xl xl:text-6xl mb-5 mt-5 lg:leading-15 xl:leading-15">
                                    Tokyo the different world 7 days
                                </h1>
                                <p class="text-primary/60">
                                    Tokyo the different world 7 days
                                </p>
                            </div>
                            <div class="bg-primary text-white px-8 py-8 rounded-xl xl:w-[426px]">
                                <div class="flex justify-between mb-8">
                                    <div class="flex items-center relative w-1/2">
                                        <div class="absolute -right-3 top-3 h-6 w-[1px] bg-white bg-opacity-40"></div>
                                        <span class="iconify mr-5" data-icon="ant-design:dollar-circle-outlined" data-width="28" data-height="28"></span>
                                        <div>
                                            <p class="text-white text-opacity-60 font-medium mb-1">
                                                Price
                                            </p>
                                            <p class="font-medium">From $200</p>
                                        </div>
                                    </div>
                                    <div class="flex items-center w-1/2 justify-end">
                                        <span class="iconify mr-5" data-icon="bx:bx-time-five" data-width="28" data-height="28"></span>
                                        <div>
                                            <p class="text-white text-opacity-60 font-medium mb-1">
                                                Duration
                                            </p>
                                            <p class="font-medium">11 days</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="flex justify-between mb-8">
                                    <div class="flex items-center relative w-1/2">
                                        <div class="absolute -right-3 top-3 h-6 w-[1px] bg-white bg-opacity-40"></div>
                                        <span class="iconify mr-5" data-icon="fluent:people-24-regular" data-width="28" data-height="28"></span>
                                        <div>
                                            <p class="text-white text-opacity-60 font-medium mb-1">
                                                Max People
                                            </p>
                                            <p class="font-medium">50</p>
                                        </div>
                                    </div>
                                    <div class="flex items-center w-1/2 justify-end">
                                        <span class="iconify mr-5" data-icon="carbon:user-avatar" data-width="28" data-height="28"></span>
                                        <div>
                                            <p class="text-white text-opacity-60 font-medium mb-1">
                                                Min Age
                                            </p>
                                            <p class="font-medium">+10</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="flex items-center">
                                    <span class="iconify mr-5" data-icon="iconoir:navigator-alt" data-width="28" data-height="28"></span>
                                    <div>
                                        <p class="text-white text-opacity-60 font-medium mb-1">
                                            Tour Type
                                        </p>
                                        <p class="font-medium">
                                            Cruiser, Museum Tours, Hotels included
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <section>
                    <div class="container">
                        <div class="xl:grid grid-cols-12 gap-x-28 pt-16 pb-5 xl:py-20">
                            <div class="col-span-8">
                                <h5 class="uppercase tracking-wide text-sm text-primary/70 font-medium">
                                    MAKE YOUR DECISION
                                </h5>
                                <h2 class="font-heading font-bold text-primary mt-3 text-4xl">
                                    Tour overview
                                </h2>
                                <p class="text-primary/70 leading-7 mt-5">
                                    Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                                    Cras tempus vitae gravida vel sed duis. Odio sagittis velit
                                    quis aliquet orci, tempus, vestibulum in vulputate. Non
                                    lacus, urna viverra quis a id sit id dui. Felis, diam amet
                                    pharetra nibh congue malesuada. Pellentesque justo nisl,
                                    ultrices condimentum consequat aliquet iaculis turpis. Elit
                                    enim metus tellus suspendisse feugiat. Ac blandit tellus
                                    quam amet. Aliquet eu tempor volutpat sapien ac. Mauris, leo
                                    integer in adipiscing leo et. Lectus id sit ornare sed.
                                    Aliquet est cursus enim magna
                                </p>
                                <h2 class="font-heading font-bold text-primary mt-10 text-4xl">
                                    Tour Plan
                                </h2>
                                <div class="mt-8" data-x-data="accordionInit()">
                                    <div class="accordion bg-white shadow-lg my-5 rounded-2xl px-5">
                                        <div class="flex justify-between items-center py-4 cursor-pointer" data-x-bind="trigger(1)">
                                            <h4 class="flex items-center space-x-4">
                                                <span class="inline-flex transition justify-center w-7 h-7 text-xl pt-[1px] font-heading font-medium leading-none text-white/60 bg-primary rounded-full">1</span>
                                                <span class="text-primary font-semibold">Center Tokyo</span>
                                            </h4>
                                            <span class="iconify -mt-1 text-primary transition-all duration-500" data-icon="fluent:chevron-down-12-regular" data-width="24" data-height="24" data-x-bind="iconStyle(1)"></span>
                                        </div>
                                        <div class="relative overflow-hidden transition-all max-h-0 duration-700" data-x-ref="container-1" data-x-bind="containerStyle(1)">
                                            <p class="text-primary/70 leading-7 pb-4">
                                                Lorem ipsum dolor sit amet, consectetur adipiscing
                                                elit. Et vitae neque blandit vestibulum, in lacinia.
                                                Nunc, suspendisse risus gravida sed nec. Et faucibus
                                                neque, purus metus bibendum nisl. Volutpat gravida
                                                bibendum euismod nascetur magna adipiscing posuere
                                                lectus.
                                            </p>
                                        </div>
                                    </div>

                                    <div class="accordion bg-white shadow-lg my-5 rounded-2xl px-5">
                                        <div class="flex justify-between items-center py-4 cursor-pointer" data-x-bind="trigger(2)">
                                            <h4 class="flex items-center space-x-4">
                                                <span class="inline-flex transition justify-center w-7 h-7 text-xl pt-[1px] font-heading font-medium leading-none text-white/60 bg-primary rounded-full">2</span>
                                                <span class="text-primary font-semibold">Center Tokyo</span>
                                            </h4>
                                            <span class="iconify -mt-1 text-primary transition-all duration-500" data-icon="fluent:chevron-down-12-regular" data-width="24" data-height="24" data-x-bind="iconStyle(2)"></span>
                                        </div>
                                        <div class="relative overflow-hidden transition-all max-h-0 duration-700" data-x-ref="container-2" data-x-bind="containerStyle(2)">
                                            <p class="text-primary/70 leading-7 pb-4">
                                                Lorem ipsum dolor sit amet, consectetur adipiscing
                                                elit. Et vitae neque blandit vestibulum, in lacinia.
                                                Nunc, suspendisse risus gravida sed nec. Et faucibus
                                                neque, purus metus bibendum nisl. Volutpat gravida
                                                bibendum euismod nascetur magna adipiscing posuere
                                                lectus.
                                            </p>
                                        </div>
                                    </div>

                                    <div class="accordion bg-white shadow-lg my-5 rounded-2xl px-5">
                                        <div class="flex justify-between items-center py-4 cursor-pointer" data-x-bind="trigger(3)">
                                            <h4 class="flex items-center space-x-4">
                                                <span class="inline-flex transition justify-center w-7 h-7 text-xl pt-[1px] font-heading font-medium leading-none text-white/60 bg-primary rounded-full">3</span>
                                                <span class="text-primary font-semibold">Center Tokyo</span>
                                            </h4>
                                            <span class="iconify -mt-1 text-primary transition-all duration-500" data-icon="fluent:chevron-down-12-regular" data-width="24" data-height="24" data-x-bind="iconStyle(3)"></span>
                                        </div>
                                        <div class="relative overflow-hidden transition-all max-h-0 duration-700" data-x-ref="container-3" data-x-bind="containerStyle(3)">
                                            <p class="text-primary/70 leading-7 pb-4">
                                                Lorem ipsum dolor sit amet, consectetur adipiscing
                                                elit. Et vitae neque blandit vestibulum, in lacinia.
                                                Nunc, suspendisse risus gravida sed nec. Et faucibus
                                                neque, purus metus bibendum nisl. Volutpat gravida
                                                bibendum euismod nascetur magna adipiscing posuere
                                                lectus.
                                            </p>
                                        </div>
                                    </div>

                                    <div class="accordion bg-white shadow-lg my-5 rounded-2xl px-5">
                                        <div class="flex justify-between items-center py-4 cursor-pointer" data-x-bind="trigger(4)">
                                            <h4 class="flex items-center space-x-4">
                                                <span class="inline-flex transition justify-center w-7 h-7 text-xl pt-[1px] font-heading font-medium leading-none text-white/60 bg-primary rounded-full">4</span>
                                                <span class="text-primary font-semibold">Center Tokyo</span>
                                            </h4>
                                            <span class="iconify -mt-1 text-primary transition-all duration-500" data-icon="fluent:chevron-down-12-regular" data-width="24" data-height="24" data-x-bind="iconStyle(4)"></span>
                                        </div>
                                        <div class="relative overflow-hidden transition-all max-h-0 duration-700" data-x-ref="container-4" data-x-bind="containerStyle(4)">
                                            <p class="text-primary/70 leading-7 pb-4">
                                                Lorem ipsum dolor sit amet, consectetur adipiscing
                                                elit. Et vitae neque blandit vestibulum, in lacinia.
                                                Nunc, suspendisse risus gravida sed nec. Et faucibus
                                                neque, purus metus bibendum nisl. Volutpat gravida
                                                bibendum euismod nascetur magna adipiscing posuere
                                                lectus.
                                            </p>
                                        </div>
                                    </div>

                                    <div class="accordion bg-white shadow-lg my-5 rounded-2xl px-5">
                                        <div class="flex justify-between items-center py-4 cursor-pointer" data-x-bind="trigger(5)">
                                            <h4 class="flex items-center space-x-4">
                                                <span class="inline-flex transition justify-center w-7 h-7 text-xl pt-[1px] font-heading font-medium leading-none text-white/60 bg-primary rounded-full">5</span>
                                                <span class="text-primary font-semibold">Center Tokyo</span>
                                            </h4>
                                            <span class="iconify -mt-1 text-primary transition-all duration-500" data-icon="fluent:chevron-down-12-regular" data-width="24" data-height="24" data-x-bind="iconStyle(5)"></span>
                                        </div>
                                        <div class="relative overflow-hidden transition-all max-h-0 duration-700" data-x-ref="container-5" data-x-bind="containerStyle(5)">
                                            <p class="text-primary/70 leading-7 pb-4">
                                                Lorem ipsum dolor sit amet, consectetur adipiscing
                                                elit. Et vitae neque blandit vestibulum, in lacinia.
                                                Nunc, suspendisse risus gravida sed nec. Et faucibus
                                                neque, purus metus bibendum nisl. Volutpat gravida
                                                bibendum euismod nascetur magna adipiscing posuere
                                                lectus.
                                            </p>
                                        </div>
                                    </div>

                                    <div class="accordion bg-white shadow-lg my-5 rounded-2xl px-5">
                                        <div class="flex justify-between items-center py-4 cursor-pointer" data-x-bind="trigger(6)">
                                            <h4 class="flex items-center space-x-4">
                                                <span class="inline-flex transition justify-center w-7 h-7 text-xl pt-[1px] font-heading font-medium leading-none text-white/60 bg-primary rounded-full">6</span>
                                                <span class="text-primary font-semibold">Center Tokyo</span>
                                            </h4>
                                            <span class="iconify -mt-1 text-primary transition-all duration-500" data-icon="fluent:chevron-down-12-regular" data-width="24" data-height="24" data-x-bind="iconStyle(6)"></span>
                                        </div>
                                        <div class="relative overflow-hidden transition-all max-h-0 duration-700" data-x-ref="container-6" data-x-bind="containerStyle(6)">
                                            <p class="text-primary/70 leading-7 pb-4">
                                                Lorem ipsum dolor sit amet, consectetur adipiscing
                                                elit. Et vitae neque blandit vestibulum, in lacinia.
                                                Nunc, suspendisse risus gravida sed nec. Et faucibus
                                                neque, purus metus bibendum nisl. Volutpat gravida
                                                bibendum euismod nascetur magna adipiscing posuere
                                                lectus.
                                            </p>
                                        </div>
                                    </div>

                                    <div class="accordion bg-white shadow-lg my-5 rounded-2xl px-5">
                                        <div class="flex justify-between items-center py-4 cursor-pointer" data-x-bind="trigger(7)">
                                            <h4 class="flex items-center space-x-4">
                                                <span class="inline-flex transition justify-center w-7 h-7 text-xl pt-[1px] font-heading font-medium leading-none text-white/60 bg-primary rounded-full">7</span>
                                                <span class="text-primary font-semibold">Center Tokyo</span>
                                            </h4>
                                            <span class="iconify -mt-1 text-primary transition-all duration-500" data-icon="fluent:chevron-down-12-regular" data-width="24" data-height="24" data-x-bind="iconStyle(7)"></span>
                                        </div>
                                        <div class="relative overflow-hidden transition-all max-h-0 duration-700" data-x-ref="container-7" data-x-bind="containerStyle(7)">
                                            <p class="text-primary/70 leading-7 pb-4">
                                                Lorem ipsum dolor sit amet, consectetur adipiscing
                                                elit. Et vitae neque blandit vestibulum, in lacinia.
                                                Nunc, suspendisse risus gravida sed nec. Et faucibus
                                                neque, purus metus bibendum nisl. Volutpat gravida
                                                bibendum euismod nascetur magna adipiscing posuere
                                                lectus.
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <h2 class="my-5 mt-14 font-heading font-bold text-primary text-3xl xl:text-4xl">
                                    Included and Excluded
                                </h2>
                                <div class="pb-10">
                                    <div class="md:grid grid-cols-12 border-b border-primary/10 py-5">
                                        <div class="text-primary/70 col-span-5 font-medium mb-2 md:mb-0">
                                            Departure & Return Location
                                        </div>
                                        <div class="text-primary col-span-7 font-medium">
                                            John F.K. International Airport (Google Map)
                                        </div>
                                    </div>
                                    <div class="md:grid grid-cols-12 border-b border-primary/10 py-5">
                                        <div class="text-primary/70 col-span-5 font-medium mb-2 md:mb-0">
                                            Departure Time
                                        </div>
                                        <div class="text-primary col-span-7 font-medium">
                                            3 Hours Before Flight Ti
                                        </div>
                                    </div>
                                    <div class="md:grid grid-cols-12 border-b border-primary/10 py-5">
                                        <div class="text-primary/70 col-span-5 font-medium mb-2 md:mb-0">
                                            Bedroom
                                        </div>
                                        <div class="text-primary col-span-7 font-medium">
                                            4 Bedrooms
                                        </div>
                                    </div>
                                    <div class="md:grid grid-cols-12 border-b border-primary/10 py-5">
                                        <div class="text-primary/70 col-span-5 font-medium mb-2 md:mb-0">
                                            Price Includes
                                        </div>
                                        <div class="text-primary col-span-7">
                                            <p class="flex space-x-2 items-center mb-4">
                                                <span class="iconify inline-block text-green-success" data-icon="akar-icons:circle-check" data-width="20" data-height="20"></span>
                                                <span class="font-medium text-primary text-sm md:text-base">Specialized bilingual guide</span>
                                            </p>
                                            <p class="flex space-x-2 items-center my-4">
                                                <span class="iconify inline-block text-green-success" data-icon="akar-icons:circle-check" data-width="20" data-height="20"></span>
                                                <span class="font-medium text-primary text-sm md:text-base">Private Transport</span>
                                            </p>
                                            <p class="flex space-x-2 items-center my-4">
                                                <span class="iconify text-green-success" data-icon="akar-icons:circle-check" data-width="20" data-height="20"></span>
                                                <span class="font-medium text-primary text-sm md:text-base">Entrance fees (Cable and car and Moon Valley)</span>
                                            </p>
                                            <p class="flex space-x-2 items-center my-4">
                                                <span class="iconify inline-block text-green-success" data-icon="akar-icons:circle-check" data-width="20" data-height="20"></span>
                                                <span class="font-medium text-primary text-sm md:text-base">Box lunch water, banana apple and chocolate</span>
                                            </p>
                                        </div>
                                    </div>
                                    <div class="md:grid grid-cols-12 border-b border-primary/10 py-5">
                                        <div class="text-primary/70 col-span-5 font-medium mb-2 md:mb-0">
                                            Price Excludes
                                        </div>
                                        <div class="text-primary col-span-7">
                                            <p class="flex space-x-2 items-center mb-4">
                                                <span class="iconify inline-block text-red-error" data-icon="radix-icons:cross-circled" data-width="20" data-height="20"></span>
                                                <span class="font-medium text-primary text-sm md:text-base">Departure Taxes</span>
                                            </p>
                                            <p class="flex space-x-2 items-center my-4">
                                                <span class="iconify inline-block text-red-error" data-icon="radix-icons:cross-circled" data-width="20" data-height="20"></span>
                                                <span class="font-medium text-primary text-sm md:text-base">Entry Fees</span>
                                            </p>
                                            <p class="flex space-x-2 items-center my-4">
                                                <span class="iconify inline-block text-red-error" data-icon="radix-icons:cross-circled" data-width="20" data-height="20"></span>
                                                <span class="font-medium text-primary text-sm md:text-base">5 Star Accommodation</span>
                                            </p>
                                            <p class="flex space-x-2 items-center my-4">
                                                <span class="iconify inline-block text-red-error" data-icon="radix-icons:cross-circled" data-width="20" data-height="20"></span>
                                                <span class="font-medium text-primary text-sm md:text-base">Airport Transfers</span>
                                            </p>
                                        </div>
                                    </div>
                                    <div class="md:grid grid-cols-12 py-5">
                                        <div class="text-primary/70 col-span-5 font-medium mb-2 md:mb-0">
                                            Complementaries
                                        </div>
                                        <div class="text-primary col-span-7">
                                            <p class="flex space-x-2 items-center mb-4">
                                                <span class="iconify inline-block text-green-success" data-icon="akar-icons:circle-check" data-width="20" data-height="20"></span>
                                                <span class="font-medium text-primary text-sm md:text-base">Private Transport</span>
                                            </p>
                                            <p class="flex space-x-2 items-center my-4">
                                                <span class="iconify inline-block text-green-success" data-icon="akar-icons:circle-check" data-width="20" data-height="20"></span>
                                                <span class="font-medium text-primary text-sm md:text-base">Entrance fees (Cable and car and Moon Valley)</span>
                                            </p>
                                            <p class="flex space-x-2 items-center my-4">
                                                <span class="iconify inline-block text-green-success" data-icon="akar-icons:circle-check" data-width="20" data-height="20"></span>
                                                <span class="font-medium text-primary text-sm md:text-base">Box lunch water, banana apple and chocolate</span>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-span-4">
                                <div class="widget shadow-lg rounded-xl my-10 bg-white sticky top-[150px]">
                                    <h5 class="font-heading text-xl text-primary font-bold border-b-2 border-primary border-opacity-10 px-7 py-5">
                                        Book This Tour
                                    </h5>
                                    <div class="py-5 px-7">
                                        <div class="flex justify-between my-5">
                                            <label class="flex items-center space-x-3" for="from">
                                                <span class="iconify inline-block text-primary" data-icon="carbon:calendar" data-width="20" data-height="20"></span>
                                                <span class="text-gray-700 font-medium">From:</span>
                                            </label>
                                            <input placeholder="xx/xx/xxxx" class="form-input bg-gray-light4/60 border-none rounded-full py-2 px-5 w-40 font-numbers font-medium text-center text-primary/90 focus:ring-2 focus:ring-primary placeholder-gray-400" id="from" type="text" />
                                        </div>
                                        <div class="flex justify-between my-5">
                                            <label class="flex items-center space-x-3" for="peopleBooked">
                                                <span class="iconify inline-block text-primary" data-icon="carbon:user-avatar" data-width="20" data-height="20"></span>
                                                <span class="text-gray-700 font-medium">People Booked:</span>
                                            </label>
                                            <input placeholder="xx" class="form-input bg-gray-light4/60 border-none rounded-full py-2 px-5 w-20 font-numbers font-medium text-center text-primary/90 focus:ring-2 focus:ring-primary placeholder-gray-400" id="peopleBooked" type="text" />
                                        </div>
                                        <div class="flex justify-between my-5">
                                            <label class="flex items-center space-x-3" for="time">
                                                <span class="iconify inline-block text-primary" data-icon="bx:bx-time-five" data-width="20" data-height="20"></span>
                                                <span class="text-gray-700 font-medium">Time:</span>
                                            </label>
                                            <input placeholder="xx:xx" class="form-input bg-gray-light4/60 border-none rounded-full py-2 px-5 w-24 font-numbers font-medium text-center text-primary/90 focus:ring-2 focus:ring-primary placeholder-gray-400" id="time" type="text" />
                                        </div>
                                        <div class="flex justify-between my-5">
                                            <label class="flex items-center space-x-3" for="ticket">
                                                <span class="iconify inline-block text-primary" data-icon="ic:outline-airplane-ticket" data-width="20" data-height="20"></span>
                                                <span class="text-gray-700 font-medium">Ticket:</span>
                                            </label>
                                            <input placeholder="xx.xxxx" class="form-input bg-gray-light4/60 border-none rounded-full py-2 px-5 w-36 font-numbers font-medium text-center text-primary/90 focus:ring-2 focus:ring-primary placeholder-gray-400" id="ticket" type="text" />
                                        </div>
                                        <div class="bg-gray-light4/60 rounded-xl px-7 py-7 mt-8">
                                            <h6 class="font-heading text-[#858585]">Add Extra</h6>
                                            <div class="flex justify-between my-3">
                                                <div class="flex items-center space-x-3">
                                                    <input class="form-checkbox -mt-[2px] bg-[#858585] text-primary focus:ring-primary" id="checkbox1" type="checkbox" />
                                                    <label class="text-[#858585] text-sm" for="checkbox1">Service per booking</label>
                                                </div>
                                                <p class="text-[#858585] text-sm font-numbers">$30</p>
                                            </div>
                                            <div class="flex justify-between my-3">
                                                <div class="flex items-center space-x-3">
                                                    <input class="form-checkbox -mt-[2px] bg-[#858585] text-primary focus:ring-primary" id="checkbox2" checked type="checkbox" />
                                                    <label class="text-[#858585] text-sm" for="checkbox2">Service per booking</label>
                                                </div>
                                                <p class="text-[#858585] text-sm font-numbers">$30</p>
                                            </div>
                                            <div class="text-[#858585] text-sm flex space-x-3">
                                                <span>Adult: <span class="font-numbers">$17</span></span>
                                                <span>Youth: <span class="font-numbers">$14</span></span>
                                            </div>
                                        </div>
                                        <div class="flex justify-between items-center mt-7 mb-5">
                                            <p class="text-[#858585] text-xl">
                                                Total:
                                                <span class="font-numbers text-primary ml-1">$21</span>
                                            </p>
                                            <button class="btn btn-primary text-white">
                                                Book Now
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

                <section class="container">
                    <h2 class="mb-10 font-heading font-bold text-primary text-3xl xl:text-4xl">
                        Tour map
                    </h2>
                    <div class="w-full h-[500px] rounded-xl" id="toursMap"></div>
                </section>

                <section class="container py-16">
                    <h2 class="mb-10 font-heading font-bold text-primary text-3xl text-4xl">
                        You may enjoy this
                    </h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 md:gap-x-10 lg:grid-cols-4 lg:gap-x-[370px] xl:gap-x-10 lg:overflow-x-auto xl:overflow-visible">
                        <a href="/single-tour" class="group block relative bg-cover rounded-2xl xl:my-0 overflow-hidden w-full h-tour">
                            <div class="absolute bg-cover bg-center origin-top w-full h-5/6 rounded-2xl transition duration-500 transform translate-y-[-10px] group-hover:scale-110" style="
                    background-image: url(https://html-travelata.wpzoro.com/assets/img/prague.jpg);
                  "></div>
                            <div class="bg-primary absolute origin-top-right right-5 top-5 rounded text-secondary uppercase px-5 py-1 font-numbers text-xs tracking-wider">
                                3 tours
                            </div>
                            <div class="absolute bottom-10 w-full bg-secondary transition duration-500 group-hover:bg-primary py-8 px-5 rounded-2xl">
                                <h3 class="font-heading text-3xl text-primary transition duration-500 group-hover:text-white">
                                    Prague
                                </h3>
                                <div class="w-full border-t border-primary border-opacity-40 my-6 transition duration-500 group-hover:border-white/30"></div>
                                <div class="flex justify-between items-center">
                                    <span class="btn btn-primary hover:bg-green-light hover:text-primary py-3 transition duration-500 text-sm group-hover:bg-secondary group-hover:text-primary">Explore places</span>
                                    <div class="text-right text-primary transition duration-500 group-hover:text-white">
                                        <span class="block text-sm font-numbers">From</span>
                                        <span class="block text-lg font-numbers font-bold">$299</span>
                                    </div>
                                </div>
                            </div>
                        </a>

                        <a href="/single-tour" class="group block relative bg-cover rounded-2xl xl:my-0 overflow-hidden w-full h-tour">
                            <div class="absolute bg-cover bg-center origin-top w-full h-5/6 rounded-2xl transition duration-500 transform translate-y-[-10px] group-hover:scale-110" style="
                    background-image: url(https://html-travelata.wpzoro.com/assets/img/los-angeles.jpg);
                  "></div>
                            <div class="bg-primary absolute origin-top-right right-5 top-5 rounded text-secondary uppercase px-5 py-1 font-numbers text-xs tracking-wider">
                                4 tours
                            </div>
                            <div class="absolute bottom-10 w-full bg-secondary transition duration-500 group-hover:bg-primary py-8 px-5 rounded-2xl">
                                <h3 class="font-heading text-3xl text-primary transition duration-500 group-hover:text-white">
                                    Los Angeles
                                </h3>
                                <div class="w-full border-t border-primary border-opacity-40 my-6 transition duration-500 group-hover:border-white/30"></div>
                                <div class="flex justify-between items-center">
                                    <span class="btn btn-primary hover:bg-green-light hover:text-primary py-3 transition duration-500 text-sm group-hover:bg-secondary group-hover:text-primary">Explore places</span>
                                    <div class="text-right text-primary transition duration-500 group-hover:text-white">
                                        <span class="block text-sm font-numbers">From</span>
                                        <span class="block text-lg font-numbers font-bold">$199</span>
                                    </div>
                                </div>
                            </div>
                        </a>

                        <a href="/single-tour" class="group block relative bg-cover rounded-2xl xl:my-0 overflow-hidden w-full h-tour">
                            <div class="absolute bg-cover bg-center origin-top w-full h-5/6 rounded-2xl transition duration-500 transform translate-y-[-10px] group-hover:scale-110" style="
                    background-image: url(https://html-travelata.wpzoro.com/assets/img/paris.jpg);
                  "></div>
                            <div class="bg-primary absolute origin-top-right right-5 top-5 rounded text-secondary uppercase px-5 py-1 font-numbers text-xs tracking-wider">
                                1 tours
                            </div>
                            <div class="absolute bottom-10 w-full bg-secondary transition duration-500 group-hover:bg-primary py-8 px-5 rounded-2xl">
                                <h3 class="font-heading text-3xl text-primary transition duration-500 group-hover:text-white">
                                    Paris
                                </h3>
                                <div class="w-full border-t border-primary border-opacity-40 my-6 transition duration-500 group-hover:border-white/30"></div>
                                <div class="flex justify-between items-center">
                                    <span class="btn btn-primary hover:bg-green-light hover:text-primary py-3 transition duration-500 text-sm group-hover:bg-secondary group-hover:text-primary">Explore places</span>
                                    <div class="text-right text-primary transition duration-500 group-hover:text-white">
                                        <span class="block text-sm font-numbers">From</span>
                                        <span class="block text-lg font-numbers font-bold">$549</span>
                                    </div>
                                </div>
                            </div>
                        </a>

                        <a href="/single-tour" class="group block relative bg-cover rounded-2xl xl:my-0 overflow-hidden w-full h-tour">
                            <div class="absolute bg-cover bg-center origin-top w-full h-5/6 rounded-2xl transition duration-500 transform translate-y-[-10px] group-hover:scale-110" style="
                    background-image: url(https://html-travelata.wpzoro.com/assets/img/new-york.jpg);
                  "></div>
                            <div class="bg-primary absolute origin-top-right right-5 top-5 rounded text-secondary uppercase px-5 py-1 font-numbers text-xs tracking-wider">
                                3 tours
                            </div>
                            <div class="absolute bottom-10 w-full bg-secondary transition duration-500 group-hover:bg-primary py-8 px-5 rounded-2xl">
                                <h3 class="font-heading text-3xl text-primary transition duration-500 group-hover:text-white">
                                    New York
                                </h3>
                                <div class="w-full border-t border-primary border-opacity-40 my-6 transition duration-500 group-hover:border-white/30"></div>
                                <div class="flex justify-between items-center">
                                    <span class="btn btn-primary hover:bg-green-light hover:text-primary py-3 transition duration-500 text-sm group-hover:bg-secondary group-hover:text-primary">Explore places</span>
                                    <div class="text-right text-primary transition duration-500 group-hover:text-white">
                                        <span class="block text-sm font-numbers">From</span>
                                        <span class="block text-lg font-numbers font-bold">$349</span>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                </section>

                <section class="container pt-0 pb-10">
                    <h2 class="mb-5 font-heading font-bold text-primary text-4xl">
                        Reviews
                    </h2>
                    <p class="text-primary/60">8 verified reviews</p>
                    <div class="bg-white shadow-xl rounded-xl py-10 px-10 md:px-16 xl:grid grid-cols-12 gap-x-16 mt-6">
                        <div class="col-span-2 mb-8 md:mb-0">
                            <p>
                                <span class="text-primary font-heading font-bold text-6xl">4.25</span>
                                <span class="text-primary/60 font-numbers font-semibold text-2xl">/ 5.0</span>
                            </p>
                            <p class="text-primary font-medium text-xl mt-3 mb-5">
                                Wonderful
                            </p>
                        </div>
                        <div class="col-span-5">
                            <div>
                                <p class="flex justify-between text-primary/60 font-medium mb-2">
                                    <span>Location</span>
                                    <span class="text-primary font-numbers">4.5/5</span>
                                </p>

                                <div class="relative pt-1">
                                    <div class="overflow-hidden h-2 mb-4 text-xs flex rounded bg-primary/10">
                                        <div style="width: 80%" class="shadow-none rounded flex flex-col text-center whitespace-nowrap text-white justify-center bg-primary"></div>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <p class="flex justify-between text-primary/60 font-medium mb-2">
                                    <span>Services</span>
                                    <span class="text-primary font-numbers">4/5</span>
                                </p>

                                <div class="relative pt-1">
                                    <div class="overflow-hidden h-2 mb-4 text-xs flex rounded bg-primary/10">
                                        <div style="width: 70%" class="shadow-none rounded flex flex-col text-center whitespace-nowrap text-white justify-center bg-primary"></div>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <p class="flex justify-between text-primary/60 font-medium mb-2">
                                    <span>Rooms</span>
                                    <span class="text-primary font-numbers">4.8/5</span>
                                </p>

                                <div class="relative pt-1">
                                    <div class="overflow-hidden h-2 mb-4 text-xs flex rounded bg-primary/10">
                                        <div style="width: 90%" class="shadow-none rounded flex flex-col text-center whitespace-nowrap text-white justify-center bg-primary"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-span-5">
                            <div>
                                <p class="flex justify-between text-primary/60 font-medium mb-2">
                                    <span>Amenities</span>
                                    <span class="text-primary font-numbers">3/5</span>
                                </p>

                                <div class="relative pt-1">
                                    <div class="overflow-hidden h-2 mb-4 text-xs flex rounded bg-primary/10">
                                        <div style="width: 50%" class="shadow-none rounded flex flex-col text-center whitespace-nowrap text-white justify-center bg-primary"></div>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <p class="flex justify-between text-primary/60 font-medium mb-2">
                                    <span>Price</span>
                                    <span class="text-primary font-numbers">2/5</span>
                                </p>

                                <div class="relative pt-1">
                                    <div class="overflow-hidden h-2 mb-4 text-xs flex rounded bg-primary/10">
                                        <div style="width: 30%" class="shadow-none rounded flex flex-col text-center whitespace-nowrap text-white justify-center bg-primary"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

                <section class="container pb-16">
                    <p class="text-primary/60">Showing 1–2 of 2 comments</p>
                    <div class="comments my-10">
                        <div class="comment shadow-xl rounded-xl px-8 py-10 my-8 bg-white">
                            <div class="lg:flex lg:space-x-4 items-center justify-between">
                                <div class="lg:flex lg:space-x-16 items-center">
                                    <div class="flex items-center space-x-4">
                                        <span class="iconify text-6xl text-primary" data-icon="carbon:user-avatar-filled-alt"></span>
                                        <h6 class="flex-grow font-heading font-bold text-2xl text-primary">
                                            Elicia
                                        </h6>
                                    </div>
                                    <div class="md:flex md:space-x-10 my-5 lg:my-0">
                                        <div class="my-2">
                                            <p class="text-primary/60 mb-1">Location</p>
                                            <div class="flex">
                                                <span class="iconify text-yellow-400" data-icon="ant-design:star-filled" data-width="20" data-height="20"></span>
                                                <span class="iconify text-yellow-400" data-icon="ant-design:star-filled" data-width="20" data-height="20"></span>
                                                <span class="iconify text-yellow-400" data-icon="ant-design:star-filled" data-width="20" data-height="20"></span>
                                                <span class="iconify text-yellow-400" data-icon="ant-design:star-filled" data-width="20" data-height="20"></span>
                                                <span class="iconify text-yellow-400" data-icon="ant-design:star-filled" data-width="20" data-height="20"></span>
                                            </div>
                                        </div>

                                        <div class="my-2">
                                            <p class="text-primary/60 mb-1">Services</p>
                                            <div class="flex">
                                                <span class="iconify text-yellow-400" data-icon="ant-design:star-filled" data-width="20" data-height="20"></span>
                                                <span class="iconify text-yellow-400" data-icon="ant-design:star-filled" data-width="20" data-height="20"></span>
                                                <span class="iconify text-yellow-400" data-icon="ant-design:star-filled" data-width="20" data-height="20"></span>
                                                <span class="iconify text-yellow-400" data-icon="ant-design:star-filled" data-width="20" data-height="20"></span>
                                                <span class="iconify text-yellow-400" data-icon="ant-design:star-filled" data-width="20" data-height="20"></span>
                                            </div>
                                        </div>

                                        <div class="my-2">
                                            <p class="text-primary/60 mb-1">Rooms</p>
                                            <div class="flex">
                                                <span class="iconify text-yellow-400" data-icon="ant-design:star-filled" data-width="20" data-height="20"></span>
                                                <span class="iconify text-yellow-400" data-icon="ant-design:star-filled" data-width="20" data-height="20"></span>
                                                <span class="iconify text-yellow-400" data-icon="ant-design:star-filled" data-width="20" data-height="20"></span>
                                                <span class="iconify text-yellow-400" data-icon="ant-design:star-filled" data-width="20" data-height="20"></span>
                                                <span class="iconify text-yellow-400" data-icon="ant-design:star-filled" data-width="20" data-height="20"></span>
                                            </div>
                                        </div>

                                        <div class="my-2">
                                            <p class="text-primary/60 mb-1">Amenities</p>
                                            <div class="flex">
                                                <span class="iconify text-yellow-400" data-icon="ant-design:star-filled" data-width="20" data-height="20"></span>
                                                <span class="iconify text-yellow-400" data-icon="ant-design:star-filled" data-width="20" data-height="20"></span>
                                                <span class="iconify text-yellow-400" data-icon="ant-design:star-filled" data-width="20" data-height="20"></span>
                                                <span class="iconify text-yellow-400" data-icon="ant-design:star-filled" data-width="20" data-height="20"></span>
                                                <span class="iconify text-yellow-400" data-icon="ant-design:star-filled" data-width="20" data-height="20"></span>
                                            </div>
                                        </div>

                                        <div class="my-2">
                                            <p class="text-primary/60 mb-1">Price</p>
                                            <div class="flex">
                                                <span class="iconify text-yellow-400" data-icon="ant-design:star-filled" data-width="20" data-height="20"></span>
                                                <span class="iconify text-yellow-400" data-icon="ant-design:star-filled" data-width="20" data-height="20"></span>
                                                <span class="iconify text-yellow-400" data-icon="ant-design:star-filled" data-width="20" data-height="20"></span>
                                                <span class="iconify text-yellow-400" data-icon="ant-design:star-filled" data-width="20" data-height="20"></span>
                                                <span class="iconify text-yellow-400" data-icon="ant-design:star-filled" data-width="20" data-height="20"></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <span class="lg:hidden xl:block text-primary text-opacity-60 font-numbers text-sm mt-1">11.09.2021</span>
                            </div>
                            <p class="text-primary text-opacity-80 leading-6 my-5">
                                Lorem ipsum dolor sit amet, consectetur adipiscing elit ut
                                aliquam, purus sit amet luctus venenatis, lectus magna
                                fringilla urna, porttitor rhoncus dolor purus non enim
                                praesent elementum facilisis leo, vel
                            </p>
                            <a href="#" class="group inline-flex flex-row items-center space-x-2">
                                <span class="transition iconify inline-block text-primary group-hover:text-green" data-icon="fa-solid:comment-dots"></span>
                                <span class="transition text-sm text-primary text-opacity-80 font-medium group-hover:text-green">Reply</span>
                            </a>
                        </div>
                        <div class="comment shadow-xl rounded-xl px-8 py-10 my-8 bg-white">
                            <div class="lg:flex lg:space-x-4 items-center justify-between">
                                <div class="lg:flex lg:space-x-16 items-center">
                                    <div class="flex items-center space-x-4">
                                        <span class="iconify text-6xl text-primary" data-icon="carbon:user-avatar-filled-alt"></span>
                                        <h6 class="flex-grow font-heading font-bold text-2xl text-primary">
                                            John Doe
                                        </h6>
                                    </div>
                                    <div class="md:flex md:space-x-10 my-5 lg:my-0">
                                        <div class="my-2">
                                            <p class="text-primary/60 mb-1">Location</p>
                                            <div class="flex">
                                                <span class="iconify text-yellow-400" data-icon="ant-design:star-filled" data-width="20" data-height="20"></span>
                                                <span class="iconify text-yellow-400" data-icon="ant-design:star-filled" data-width="20" data-height="20"></span>
                                                <span class="iconify text-yellow-400" data-icon="ant-design:star-filled" data-width="20" data-height="20"></span>
                                                <span class="iconify text-yellow-400" data-icon="ant-design:star-filled" data-width="20" data-height="20"></span>
                                                <span class="iconify text-yellow-400" data-icon="ant-design:star-filled" data-width="20" data-height="20"></span>
                                            </div>
                                        </div>

                                        <div class="my-2">
                                            <p class="text-primary/60 mb-1">Services</p>
                                            <div class="flex">
                                                <span class="iconify text-yellow-400" data-icon="ant-design:star-filled" data-width="20" data-height="20"></span>
                                                <span class="iconify text-yellow-400" data-icon="ant-design:star-filled" data-width="20" data-height="20"></span>
                                                <span class="iconify text-yellow-400" data-icon="ant-design:star-filled" data-width="20" data-height="20"></span>
                                                <span class="iconify text-yellow-400" data-icon="ant-design:star-filled" data-width="20" data-height="20"></span>
                                                <span class="iconify text-yellow-400" data-icon="ant-design:star-filled" data-width="20" data-height="20"></span>
                                            </div>
                                        </div>

                                        <div class="my-2">
                                            <p class="text-primary/60 mb-1">Rooms</p>
                                            <div class="flex">
                                                <span class="iconify text-yellow-400" data-icon="ant-design:star-filled" data-width="20" data-height="20"></span>
                                                <span class="iconify text-yellow-400" data-icon="ant-design:star-filled" data-width="20" data-height="20"></span>
                                                <span class="iconify text-yellow-400" data-icon="ant-design:star-filled" data-width="20" data-height="20"></span>
                                                <span class="iconify text-yellow-400" data-icon="ant-design:star-filled" data-width="20" data-height="20"></span>
                                                <span class="iconify text-yellow-400" data-icon="ant-design:star-filled" data-width="20" data-height="20"></span>
                                            </div>
                                        </div>

                                        <div class="my-2">
                                            <p class="text-primary/60 mb-1">Amenities</p>
                                            <div class="flex">
                                                <span class="iconify text-yellow-400" data-icon="ant-design:star-filled" data-width="20" data-height="20"></span>
                                                <span class="iconify text-yellow-400" data-icon="ant-design:star-filled" data-width="20" data-height="20"></span>
                                                <span class="iconify text-yellow-400" data-icon="ant-design:star-filled" data-width="20" data-height="20"></span>
                                                <span class="iconify text-yellow-400" data-icon="ant-design:star-filled" data-width="20" data-height="20"></span>
                                                <span class="iconify text-yellow-400" data-icon="ant-design:star-filled" data-width="20" data-height="20"></span>
                                            </div>
                                        </div>

                                        <div class="my-2">
                                            <p class="text-primary/60 mb-1">Price</p>
                                            <div class="flex">
                                                <span class="iconify text-yellow-400" data-icon="ant-design:star-filled" data-width="20" data-height="20"></span>
                                                <span class="iconify text-yellow-400" data-icon="ant-design:star-filled" data-width="20" data-height="20"></span>
                                                <span class="iconify text-yellow-400" data-icon="ant-design:star-filled" data-width="20" data-height="20"></span>
                                                <span class="iconify text-yellow-400" data-icon="ant-design:star-filled" data-width="20" data-height="20"></span>
                                                <span class="iconify text-yellow-400" data-icon="ant-design:star-filled" data-width="20" data-height="20"></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <span class="lg:hidden xl:block text-primary text-opacity-60 font-numbers text-sm mt-1">11.09.2021</span>
                            </div>
                            <p class="text-primary text-opacity-80 leading-6 my-5">
                                Lorem ipsum dolor sit amet, consectetur adipiscing elit ut
                                aliquam, purus sit amet luctus venenatis, lectus magna
                                fringilla urna, porttitor rhoncus dolor purus non enim
                                praesent elementum facilisis leo, vel
                            </p>
                            <a href="#" class="group inline-flex flex-row items-center space-x-2">
                                <span class="transition iconify inline-block text-primary group-hover:text-green" data-icon="fa-solid:comment-dots"></span>
                                <span class="transition text-sm text-primary text-opacity-80 font-medium group-hover:text-green">Reply</span>
                            </a>
                        </div>
                        <h2 class="font-heading font-bold text-3xl text-primary mt-16 mb-10">
                            Leave a review
                        </h2>
                        <div class="relative mt-8">
                            <textarea placeholder="Enter your review here" class="transition h-44 pl-8 pr-36 placeholder-primary placeholder-opacity-50 text-primary leading-7 px-5 py-4 w-full form-input bg-white rounded-xl border-none focus:ring-2 focus:border-green hover:border-gray-200 focus:ring-green shadow-lg font-body text-md font-medium"></textarea>
                            <button class="btn btn-primary text-gray-200 absolute bottom-6 right-4">
                                Submit
                            </button>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>
<?php
    $contents = ob_get_clean();
    return $contents;
}
