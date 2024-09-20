const CURRENCY_COOKIE = "currency-navigate";

document.addEventListener("DOMContentLoaded", function () {
  const sctContainerCard =
    document.querySelector(".sct-container-card") ?? null;

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
        console.log(dataRes);

        if (dataRes.result === "ok") {
          let output = "";

          dataRes.data.services.forEach((service) => {
            const globalInformation =
              service.contents.global_information ?? null;
            let durationText = "";

            if (globalInformation) {
              const { duration } = globalInformation;
              const { day, hour, minute } = duration;

              if (day > 0) {
                durationText =
                  (hour > 0 ? day + 1 : day) +
                  (day > 1 || hour > 0 ? " Days" : " Day");
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

            output += `
              <div class="sct-card">
                <a href="/${route}/${service.slug}">
                  <div class="sct-card-top">
                    <img src="${
                      service.image
                    }" alt="img-tour" class="sct-img-card">
                  </div>
                  <div class="sct-card-bottom">
                    <p class="sct-title">${service.contents.title}</p>
                    <div class="sct-conloc">
                      <span class="iconify" data-icon="ic:outline-location-on" data-width="15" data-height="15"></span>
                      <p>${service.country.name}</p>
                    </div>
                    <div class="sct-container-info-card">
                      <div class="sct-duration">
                        <span class="iconify" data-icon="ic:outline-location-on" data-width="15" data-height="15"></span>
                        <p>${durationText}</p>
                      </div>
                      <div class="sct-info-price">
                        <p>Start From</p>
                        <p>${currency} ${numberFormat(
              service.minimum_price,
              service.minimum_price_detail.currency.digit
            )}</p>
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
