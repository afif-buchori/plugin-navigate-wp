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
