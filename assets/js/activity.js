const packageOptActivity =
  document.getElementById("package-opt-activity") || "";
if (packageOptActivity !== "") {
  const countPackage = packageOptActivity.getAttribute("data-package");
  for (let i = 0; i < parseInt(countPackage); i++) {
    const btnDetailPkt =
      document.getElementById("btn-details-package" + i) || "";
    const modalComp = document.getElementById("modal-detail-act" + i) || "";
    const btnCloseModal = document.getElementById("close-modal" + i) || "";

    if (btnCloseModal) {
      btnCloseModal.addEventListener("click", function () {
        modalComp.style.display = "none";
      });
    }
    if (btnDetailPkt) {
      btnDetailPkt.addEventListener("click", function () {
        modalComp.style.display = "grid";
      });
      modalComp.addEventListener("click", function () {
        modalComp.style.display = "none";
      });
    }
  }
}
