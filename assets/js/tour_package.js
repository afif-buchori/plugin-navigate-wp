const API_TP_URL = "/api/tour-package";

// Function Detail
const form_detail = document.querySelector("#form-package-detail-tourpackage") ?? null;

if (form_detail) {
  // Date
  const date_detail = document.getElementById("tp_date_detail") ?? null;
  date_detail.addEventListener("change", async function (e) {
    const attr_service = JSON.parse(date_detail.getAttribute("data-service"));
    const input_passangers = form_detail.querySelectorAll("input[type='number']");
    const package_data = form_detail.querySelector("textarea[name='package-data']");
    const btn_slct_package = document.querySelector("#btn-slc-package-detail");

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
      btn_slct_package.removeAttribute("hidden");
    } else {
      btn_slct_package.setAttribute("hidden", "");
      console.log("Response data is empty or not returned correctly");
    }
  });
  // End Date

  // Modal List Package
  const modalListPackage = document.getElementById("modal-list-tour-package") ?? null;
  const btnSlectPackage = document.getElementById("btn-open-list-modal-package") ?? null;
  if (btnSlectPackage) {
    btnSlectPackage.addEventListener("click", function () {
      const package_data = form_detail.querySelector("textarea[name='package-data']") ?? null;
      const btnClose = document.getElementById("close-modal-list-tourpackage");
      let data = [];
      if (package_data) data = JSON.parse(package_data.value);
      console.log(data);

      modalListPackage.style.display = "grid";
      btnClose.addEventListener("click", () => (modalListPackage.style.display = "none"));
    });
  }
  // End Modal List Package
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
