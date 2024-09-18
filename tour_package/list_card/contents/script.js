document.addEventListener("DOMContentLoaded", function () {
  const list = document.getElementsByClassName("font-bold") || [];
  Array.from(list).forEach(function (element) {
    element.classList.add("huhu");
  });
  console.log("Class `huhu` added to each `font-bold` element.");
});
