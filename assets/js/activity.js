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

    const ticketTypeAct = document.getElementById("ticket-type-act") || "";
    if (ticketTypeAct !== "") {
      const countType = ticketTypeAct.getAttribute("data-ticket");
      for (let j = 0; j < parseInt(countType); j++) {
        const btnDecrement =
          document.getElementById(i + "qty-act-dec" + j) || "";
        const btnIncrement =
          document.getElementById(i + "qty-act-inc" + j) || "";
        const qtyType = document.getElementById(i + "qty-type-act" + j) | "";

        console.log(i + "qty-act-dec" + j);
        // btnDecrement.addEventListener("click", function () {
        //   console.log(qtyType);
        //   // qtyType.innerHTML = parseInt(qtyType) - 1;
        // });
      }
    }
  }
}
