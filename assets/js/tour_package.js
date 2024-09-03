const API_TP_URL = "/api/tour-package";

// Function Detail
const date_detail = document.getElementById("tp_date_detail") ?? null;

if (date_detail) {
  date_detail.addEventListener("change", async function (e) {
    const attr_service = JSON.parse(date_detail.getAttribute("data-service"));
    const form_detail = document.querySelector("#form-package-detail-tourpackage");
    const input_passangers = form_detail.querySelectorAll("input[type='number']");
    const package_data = form_detail.querySelector("textarea[name='package-data']");

    let passangers = {};
    input_passangers.forEach((input) => {
      passangers[input.name] = parseInt(input.value);
    });

    const body = {
      date: e.target.value,
      ...attr_service,
      ...passangers,
    };

    const url = API_TP_URL + "/get-package";

    const res = await fetchingPost(url, body);
    if (res && res.data) {
      package_data.value = JSON.stringify(res.data);
      console.log(JSON.parse(package_data.value)); // Cek apakah res.data ada
    } else {
      console.log("Response data is empty or not returned correctly");
    }
  });
}
// End Function Detail

// Fetch Post
async function fetchingPost(url, data) {
  try {
    const result = await fetch(url, {
      method: "POST",
      headers: {
        Accept: "application/json",
        "Content-Type": "application/json",
      },
      body: JSON.stringify(data),
    });
    const res = await result.json();
    return res;
  } catch (error) {
    console.log(error);
    return error;
  }
}
// End Fetch Post

// Modal List Package
const modalListPackage = document.getElementById("modal-list-tour-package");
const btnSlectPackage = document.getElementById("btn-open-list-modal-package");
if (btnSlectPackage) {
  btnSlectPackage.addEventListener("click", function () {
    const btnClose = document.getElementById("close-modal-list-tourpackage");
    modalListPackage.style.display = "grid";
    btnClose.addEventListener("click", () => (modalListPackage.style.display = "none"));
  });
}
// End Modal List Package
