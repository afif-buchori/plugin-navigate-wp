const CURRENCY_COOKIE = "currency-navigate";

document.addEventListener("DOMContentLoaded", function () {
  const sctContainerCard = document.querySelector(".sct-container-card") ?? null;

  if (sctContainerCard) {
    // const url = (API_TP_URL = "/api/tour-package/list-data");
    const url = sctContainerCard.dataset.url;
    const slug_country = sctContainerCard.dataset.slugCountry;
    const currency = checkCurrency();
    // const currency = sctContainerCard.dataset.currency;
    const limit = sctContainerCard.dataset.limit;
    const route = sctContainerCard.dataset.route;

    let body = {
      slug_country,
      currency,
      limit,
    };

    let loading = [];
    for (let i = 0; i < parseInt(limit); i++) {
      loading.push(`<div class="sct-card">
                <div class="sct-card-top">
                </div>
                <div class="sct-card-bottom">
                  <p  style="margin-bottom: 4px !important; width: 100%" class="sct-skeleton">...</p>
                  <p style="width: 80%" class="sct-skeleton">...</p>
                  <div class="sct-conloc">
                  </div>
                  <div class="sct-container-info-card">
                    <div style="padding-top: 4px; margin-left: auto !important" class="sct-info-price">
                      <p style="margin-bottom: 4px !important" class="sct-skeleton">start From</p>
                      <p class="sct-skeleton">USD 123.45</p>
                    </div>
                  </div>
                </div>
            </div>`);
    }
    sctContainerCard.innerHTML = loading.join("");

    const testing = async () => {
      try {
        const res = await fetch(url, {
          method: "POST",
          headers: {
            Accept: "application/json",
            "Content-Type": "application/json",
          },
          body: JSON.stringify(body),
        });

        const dataRes = await res.json();
        // console.log(dataRes);

        if (dataRes.result === "ok") {
          let output = "";

          dataRes.data.services.forEach((service) => {
            const globalInformation = service.contents.global_information ?? null;
            let durationText = "";

            if (globalInformation) {
              const { duration } = globalInformation;
              const { day, hour, minute } = duration;

              if (day > 0) {
                durationText = (hour > 0 ? day + 1 : day) + (day > 1 || hour > 0 ? " Days" : " Day");
              }

              if (day <= 0 && hour > 0) {
                durationText = hour + (hour > 1 ? " Hours" : " Hour");
              }

              if (day <= 0 && minute > 0) {
                durationText += minute + (minute > 1 ? " Minutes" : " Minute");
              }

              if (duration.approx) {
                durationText += " (approx.)";
              }
            }

            const colorMap = {
              "FULL DAY": "#00712D",
              "HALF DAY": "#7A1CAC",
              PACKAGE: "#E85C0D",
            };
            let bgColor = colorMap[service.service_sub_type] || "#1F4172"; // Default to #1F4172 if not found

            output += `
              <div class="sct-card">
                <a href="/${route}/${service.country.slug}/${service.slug}">
                  <div class="sct-card-top">
                    <img src="${service.image}" alt="img-tour" class="sct-img-card">
                  </div>
                  <div class="sct-card-bottom">
                    <p class="sct-title">${service.contents.title}</p>
                    <div class="sct-conloc">
                      <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" fill="currentColor" class="bi bi-geo-alt-fill" viewBox="0 0 16 16">
                        <path d="M8 16s6-5.686 6-10A6 6 0 0 0 2 6c0 4.314 6 10 6 10m0-7a3 3 0 1 1 0-6 3 3 0 0 1 0 6"/>
                      </svg>
                      <p>${service.country.name}</p>
                    </div>
                    <div style="border-top: solid 1px ${bgColor}80 !important;" class="sct-container-info-card">
                      <span style="border: solid 1px ${bgColor}80 !important;" class="sct-type-info">
                        <p style="background-color: ${bgColor}50 !important;">${service.service_sub_type}</p>
                      </span>
                      <div class="sct-duration">
                        <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" fill="currentColor" class="bi bi-stopwatch-fill" viewBox="0 0 16 16">
                          <path d="M6.5 0a.5.5 0 0 0 0 1H7v1.07A7.001 7.001 0 0 0 8 16a7 7 0 0 0 5.29-11.584l.013-.012.354-.354.353.354a.5.5 0 1 0 .707-.707l-1.414-1.415a.5.5 0 1 0-.707.707l.354.354-.354.354-.012.012A6.97 6.97 0 0 0 9 2.071V1h.5a.5.5 0 0 0 0-1zm2 5.6V9a.5.5 0 0 1-.5.5H4.5a.5.5 0 0 1 0-1h3V5.6a.5.5 0 1 1 1 0"/>
                        </svg>
                        <p>${durationText}</p>
                      </div>
                      <div class="sct-info-price">
                        <p class="sct-info">Start From</p>
                        <p class="sct-price primary-color">${currency} ${numberFormat(service.minimum_price, service.minimum_price_detail.currency.digit)}</p>
                      </div>
                    </div>
                  </div>
                </a>
              </div>
            `;
          });

          // Menyisipkan konten yang dihasilkan ke dalam elemen yang sesuai di DOM
          sctContainerCard.innerHTML = output;
        }
      } catch (error) {
        console.error("Error:", error);
      }
    };

    testing();
  }
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
function setCookie(cname, cvalue, exdays) {
  const d = new Date();
  d.setTime(d.getTime() + exdays * 24 * 60 * 60 * 1000);
  let expires = "expires=" + d.toUTCString();
  document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
}

function checkCurrency() {
  var currency = "";
  if (getCookie(CURRENCY_COOKIE) != "") currency = getCookie(CURRENCY_COOKIE);
  else {
    setCookie(CURRENCY_COOKIE, "USD", 365);
    currency = getCookie(CURRENCY_COOKIE);
  }
  return currency;
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
