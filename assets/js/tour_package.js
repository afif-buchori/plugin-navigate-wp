const API_TP_URL = "/api/tour-package";

// Function Detail
const date_detail = document.getElementById("tp_date_detail") ?? null;

if (date_detail) {
  date_detail.addEventListener("change", function (e) {
    const attr_service = JSON.parse(date_detail.getAttribute("data-service"));
    const body = {
      date: e.target.value,
      ...attr_service,
    };
    const url = API_TP_URL + "/get-package";

    const res = fetchingPost(url, body);
    console.log(res);
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
    btnClose.addEventListener(
      "click",
      () => (modalListPackage.style.display = "none")
    );
  });
}
// End Modal List Package
