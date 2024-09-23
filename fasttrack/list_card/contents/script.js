document.addEventListener("DOMContentLoaded", function () {
  const scasContainerCard = document.querySelector(".scas-container-card") ?? null;

  if (scasContainerCard) {
    // const url = (API_TP_URL = "/api/tour-package/list-data");
    const url = scasContainerCard.dataset.url;
    const code = scasContainerCard.dataset.code.toUpperCase();
    const currency = checkCurrency();
    // const currency = scasContainerCard.dataset.currency;
    const limit = scasContainerCard.dataset.limit;
    const route = scasContainerCard.dataset.route;

    let body = {
      code,
      currency,
      limit,
    };

    let loading = [];
    for (let i = 0; i < parseInt(limit); i++) {
      loading.push(`<div class="scas-card">
                <div class="scas-card-top">
                </div>
                <div class="scas-card-bottom">
                  <p  style="margin-bottom: 4px !important; width: 100%" class="scas-skeleton">...</p>
                  <p style="width: 80%" class="scas-skeleton">...</p>
                  <div class="scas-conloc">
                  </div>
                  <div class="scas-container-info-card">
                    <div style="padding-top: 4px; margin-left: auto !important" class="scas-info-price">
                      <p style="margin-bottom: 4px !important" class="scas-skeleton">start From</p>
                      <p class="scas-skeleton">USD 123.45</p>
                    </div>
                  </div>
                </div>
            </div>`);
    }
    scasContainerCard.innerHTML = loading.join("");
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
        // return console.log(dataRes);

        if (Array.isArray(dataRes.items) && dataRes.items.length > 0) {
          let output = "";

          dataRes.items.forEach((service) => {
            output += `
              <div class="scas-card">
                <a href="/${route}/${service.slug}">
                  <div class="scas-card-top">
                    <img id="scas-img-card-${service.slug}" src="${service.image_url}" onerror="testimg('scas-img-card-${service.slug}')" alt="img-airport-service" class="scas-img-card">
                  </div>
                  <div class="scas-card-bottom">
                    <p class="scas-title">${service.title}</p>
                    <div class="scas-conloc">
                    
                    </div>
                    <div class="scas-container-info-card">
                      <div class="scas-duration">
                        <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" fill="currentColor" class="bi bi-lightning-fill" viewBox="0 0 16 16">
                          <path d="M5.52.359A.5.5 0 0 1 6 0h4a.5.5 0 0 1 .474.658L8.694 6H12.5a.5.5 0 0 1 .395.807l-7 9a.5.5 0 0 1-.873-.454L6.823 9.5H3.5a.5.5 0 0 1-.48-.641z"/>
                        </svg>
                        <p>Instant Confirmation</p>
                      </div>
                      <div class="scas-info-price">
                        <p class="scas-info">Start From</p>
                        <p class="scas-price primary-color">${currency} ${numberFormat(service.rate, service.currency.digit)}</p>
                      </div>
                    </div>
                  </div>
                </a>
              </div>
            `;
          });
          scasContainerCard.innerHTML = output;
        }
      } catch (error) {
        console.error("Error:", error);
      }
    };

    testing();
  }
});

function testimg(id) {
  const img = document.getElementById(id) ?? null;
  if (img) {
    img.src = "https://d3837chlpocfug.cloudfront.net/28338fc3-5be8-4666-9b73-babecc70a467/build/assets/ph-notfound-d1e5c849.png";
  }
}
// function isInt(n) {
//   return Number(n) === n && n % 1 === 0;
// }

// function isFloat(n) {
//   return Number(n) === n && n % 1 !== 0;
// }

// function numberFormat(num, digit = 0) {
//   if (!(isInt(num) || isFloat(num))) return num;
//   var nStr = num.toFixed(digit) + "";
//   var x = nStr.split(".");
//   var x1 = x[0];
//   var x2 = x.length > 1 ? "." + x[1] : "";
//   var rgx = /(\d+)(\d{3})/;
//   while (rgx.test(x1)) {
//     x1 = x1.replace(rgx, "$1" + "," + "$2");
//   }
//   return x1 + x2;
// }

// function checkCurrency() {
//   var currency = "";
//   if (getCookie(CURRENCY_COOKIE) != "") currency = getCookie(CURRENCY_COOKIE);
//   else {
//     setCookie(CURRENCY_COOKIE, "USD", 365);
//     currency = getCookie(CURRENCY_COOKIE);
//   }
//   return currency;
// }

// function getCookie(cname) {
//   let name = cname + "=";
//   let decodedCookie = decodeURIComponent(document.cookie);
//   let ca = decodedCookie.split(";");
//   for (let i = 0; i < ca.length; i++) {
//     let c = ca[i];
//     while (c.charAt(0) == " ") {
//       c = c.substring(1);
//     }
//     if (c.indexOf(name) == 0) {
//       return c.substring(name.length, c.length);
//     }
//   }
//   return "";
// }
