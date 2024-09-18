"use strict";

const CURRENCY_COOKIE = "currency-navigate";

// Alpine Init
document.addEventListener("alpine:init", () => {
  Alpine.prefix("data-x-");

  // Toggle logic for mobile navigation
  Alpine.data("mobileNav", () => ({
    mobileMenuOpen: false,
    triggerHamburgerClick: {
      ["data-x-on:click"]() {
        this.mobileMenuOpen = !this.mobileMenuOpen;
      },
    },
    toggleNavVisibility: {
      ["data-x-bind:class"]() {
        return { block: this.mobileMenuOpen, hidden: !this.mobileMenuOpen };
      },
    },
  }));

  // Toggle logic for mobile submenu
  Alpine.data("mobileNavSubmenuCollapse", () => ({
    isOpen: false,
    trigger: {
      ["data-x-on:click"]() {
        this.isOpen = !this.isOpen;
      },
    },
    toggleSubmenuVisibility: {
      ["data-x-bind:class"]() {
        return {
          block: this.isOpen,
          hidden: !this.isOpen,
          "-mb-4": this.isOpen,
        };
      },
    },
  }));

  // Toggle logic for search bar | Destination button
  Alpine.data("searchBarDestination", () => ({
    isOpen: false,
    destination: "Where you are?",
    trigger: {
      ["data-x-on:click.prevent"]() {
        this.isOpen = !this.isOpen;
      },
      ["data-x-bind:class"]() {
        return { "bg-green-medium": this.isOpen, "bg-primary": !this.isOpen };
      },
    },
    iconClass: {
      ["data-x-bind:class"]() {
        return { "rotate-180": this.isOpen };
      },
    },
    dropdown: {
      ["data-x-show"]() {
        return this.isOpen;
      },
      ["data-x-on:click.away"]() {
        this.isOpen = false;
      },
      ["data-x-bind:class"]() {
        return { block: this.isOpen, hidden: !this.isOpen };
      },
    },
    dropdownItemClick: {
      ["data-x-on:click.prevent"]($event) {
        this.destination = $event.target.textContent;
        this.isOpen = false;
      },
    },
  }));

  // Toggle logic for search bar | Activity button
  Alpine.data("searchBarActivity", () => ({
    isOpen: false,
    activity: "All Activity",
    trigger: {
      ["data-x-on:click.prevent"]() {
        this.isOpen = !this.isOpen;
      },
      ["data-x-bind:class"]() {
        return { "bg-green-medium": this.isOpen, "bg-primary": !this.isOpen };
      },
    },
    iconClass: {
      ["data-x-bind:class"]() {
        return { "rotate-180": this.isOpen };
      },
    },
    dropdown: {
      ["data-x-show"]() {
        return this.isOpen;
      },
      ["data-x-on:click.away"]() {
        this.isOpen = false;
      },
      ["data-x-bind:class"]() {
        return { block: this.isOpen, hidden: !this.isOpen };
      },
    },
    dropdownItemClick: {
      ["data-x-on:click.prevent"]($event) {
        this.activity = $event.target.textContent;
        this.isOpen = false;
      },
    },
  }));

  // Toggle logic for search bar | Date button
  Alpine.data("searchBarDate", () => ({
    date: "Date from",
    init() {
      new Pikaday({
        field: this.$el,
        trigger: this.$refs.datepicker,
        onSelect: (selectedDate) =>
          (this.date = `${selectedDate.getDate()}/${
            selectedDate.getMonth() + 1
          }/${selectedDate.getFullYear()}`),
      });
    },
    iconClass: {
      ["data-x-bind:class"]() {
        return { "rotate-180": this.isOpen };
      },
    },
    dateClick: {
      ["data-x-on:click.prevent"]() {
        return true;
      },
    },
  }));

  // Toggle logic for search bar | Guests button
  Alpine.data("searchBarGuests", () => ({
    isOpen: false,
    guests: 0,
    adults: 0,
    youth: 0,
    children: 0,
    trigger: {
      ["data-x-on:click.prevent"]() {
        this.isOpen = !this.isOpen;
      },
      ["data-x-bind:class"]() {
        return { "bg-green-medium": this.isOpen, "bg-primary": !this.isOpen };
      },
    },
    dropdown: {
      ["data-x-show"]() {
        return this.isOpen;
      },
      ["data-x-on:click.away"]() {
        this.isOpen = false;
      },
      ["data-x-bind:class"]() {
        return { block: this.isOpen, hidden: !this.isOpen };
      },
    },
    decreaseAdults: {
      ["data-x-on:click.prevent"]() {
        this.adults = this.adults <= 0 ? this.adults : this.adults - 1;
      },
    },
    increaseAdults: {
      ["data-x-on:click.prevent"]() {
        this.adults = this.adults + 1;
      },
    },
    decreaseYouth: {
      ["data-x-on:click.prevent"]() {
        this.youth = this.youth <= 0 ? this.youth : this.youth - 1;
      },
    },
    increaseYouth: {
      ["data-x-on:click.prevent"]() {
        this.youth = this.youth + 1;
      },
    },
    decreaseChildren: {
      ["data-x-on:click.prevent"]() {
        this.children = this.children <= 0 ? this.children : this.children - 1;
      },
    },
    increaseChildren: {
      ["data-x-on:click.prevent"]() {
        this.children = this.children + 1;
      },
    },
    iconClass: {
      ["data-x-bind:class"]() {
        return { "rotate-180": this.isOpen };
      },
    },
  }));

  // Accordion logic
  Alpine.data("accordionInit", () => ({
    selected: null,
    trigger(index) {
      return {
        ["data-x-on:click"]() {
          this.selected !== index
            ? (this.selected = index)
            : (this.selected = null);
        },
      };
    },
    iconStyle(index) {
      return {
        ["data-x-bind:style"]() {
          return this.selected === index ? "transform: rotate(180deg)" : "";
        },
      };
    },
    containerStyle(index) {
      return {
        ["data-x-bind:style"]() {
          return this.selected === index
            ? "max-height: " +
                this.$refs[`container-${index}`].scrollHeight +
                "px !important"
            : "";
        },
      };
    },
  }));

  // Testimonials slider
  Alpine.data("testimonialsSlider", () => ({
    swiper: null,
    init() {
      this.swiper = new Swiper(this.$refs.container, {
        loop: true,
        slidesPerView: 1,
        spaceBetween: 20,
        autoplay: true,
        breakpoints: {
          768: {
            slidesPerView: 2,
            spaceBetween: 30,
          },
          1024: {
            slidesPerView: 3,
            spaceBetween: 20,
          },
          1280: {
            slidesPerView: 3,
            spaceBetween: 40,
          },
        },
        grabCursor: true,
        keyboard: true,
        pagination: {
          el: this.$refs.pagination,
          clickable: true,
          dynamicBullets: true,
        },
      });
    },
  }));

  // Blog slider
  Alpine.data("blogSlider", () => ({
    swiper: null,
    init() {
      this.swiper = new Swiper(this.$refs.container, {
        loop: true,
        autoplay: true,
        slidesPerView: 1,
        grabCursor: true,
        keyboard: true,
        pagination: {
          el: this.$refs.pagination,
          clickable: true,
          dynamicBullets: true,
        },
      });
    },
    prevSlide: {
      ["data-x-on:click"]() {
        this.swiper.slidePrev();
      },
    },
    nextSlide: {
      ["data-x-on:click"]() {
        this.swiper.slideNext();
      },
    },
  }));

  // Recent posts slider
  Alpine.data("recentPostsSlider", () => ({
    swiper: null,
    init() {
      this.swiper = new Swiper(this.$refs.container, {
        loop: true,
        autoplay: true,
        slidesPerView: 1,
        spaceBetween: 20,
        breakpoints: {
          768: {
            slidesPerView: 1,
            spaceBetween: 30,
          },
          1024: {
            slidesPerView: 2,
            spaceBetween: 20,
          },
          1280: {
            slidesPerView: 3,
            spaceBetween: 40,
          },
        },
        grabCursor: true,
        keyboard: true,
        pagination: {
          el: this.$refs.pagination,
          clickable: true,
          dynamicBullets: true,
        },
      });
    },
  }));
});

function isInt(n) {
  return Number(n) === n && n % 1 === 0;
}

function isFloat(n) {
  return Number(n) === n && n % 1 !== 0;
}

function numberFormat(num, digit = 0) {
  if (!(isInt(num) || isFloat(num))) return num;
  var nStr = num.toFixed(digit) + "";
  var x = nStr.split(".");
  var x1 = x[0];
  var x2 = x.length > 1 ? "." + x[1] : "";
  var rgx = /(\d+)(\d{3})/;
  while (rgx.test(x1)) {
    x1 = x1.replace(rgx, "$1" + "," + "$2");
  }
  return x1 + x2;
}

function getAttribute(target, key, defaultValue = undefined) {
  let data = defaultValue;
  try {
    data = target.getAttribute(key);
  } catch (e) {}
  return data;
}

function getData(target, key, defaultValue = undefined) {
  let data = defaultValue;
  try {
    data = target.getAttribute("data-" + key);
  } catch (e) {}
  return data;
}

function getElementWithName(target) {
  let el = document.querySelector('#page-addon [name="' + target + '"]');
  return el;
}

function getElement(target) {
  let el = document.querySelector("#page-addon " + target);
  return el;
}
function setCookie(cname, cvalue, exdays) {
  const d = new Date();
  d.setTime(d.getTime() + exdays * 24 * 60 * 60 * 1000);
  let expires = "expires=" + d.toUTCString();
  document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
}
function getCookie(cname) {
  let name = cname + "=";
  let decodedCookie = decodeURIComponent(document.cookie);
  let ca = decodedCookie.split(";");
  for (let i = 0; i < ca.length; i++) {
    let c = ca[i];
    while (c.charAt(0) == " ") {
      c = c.substring(1);
    }
    if (c.indexOf(name) == 0) {
      return c.substring(name.length, c.length);
    }
  }
  return "";
}
function checkCurrency() {
  var currency = "";
  if (getCookie(CURRENCY_COOKIE) != "")
    currency = "currency=" + getCookie(CURRENCY_COOKIE);
  else {
    setCookie(CURRENCY_COOKIE, "USD", 365);
    currency = "currency=" + getCookie(CURRENCY_COOKIE);
  }
  return currency;
}
function createParams() {
  var param = "";
  var currency = "";
  currency = checkCurrency();
  param += currency;
  if (param != "") param = "?" + param;
  return param;
}
