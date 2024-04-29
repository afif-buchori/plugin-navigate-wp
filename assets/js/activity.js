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

    // const ticketTypeAct = document.getElementById("ticket-type-act") || "";
    // if (ticketTypeAct !== "") {
    //   const countType = ticketTypeAct.getAttribute("data-ticket");
    //   for (let j = 0; j < parseInt(countType); j++) {
    //     const btnDecrement =
    //       document.getElementById(i + "qty-act-dec" + j) || "";
    //     const btnIncrement =
    //       document.getElementById(i + "qty-act-inc" + j) || "";
    //     const qtyType = document.getElementById(i + "qty-type-act" + j) | "";

    //     console.log(i + "qty-act-dec" + j);
    //     // btnDecrement.addEventListener("click", function () {
    //     //   console.log(qtyType);
    //     //   // qtyType.innerHTML = parseInt(qtyType) - 1;
    //     // });
    //   }
    // }
  }
}

const newTicketTypeAct = document.querySelectorAll("#new-ticket-type-act");
        newTicketTypeAct.forEach(function(element) {

            var btnDecrement = element.getAttribute("data-qty-act-dec");
            document.getElementById(btnDecrement).onclick = function() {
                console.log("huhu " + btnDecrement);
            }
            
            var btnIncrement = element.getAttribute("data-qty-act-inc");
            document.getElementById(btnIncrement).onclick = function() {
                console.log("huhu " + btnIncrement);
            }
            
            var qtyType = element.getAttribute("data-qty-type-act");
            document.getElementById(qtyType).onclick = function() {
                console.log("huhu " + qtyType);
            }
        });
