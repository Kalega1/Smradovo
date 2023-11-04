const tooltip = document.querySelector(".tooltip");
const mesta = document.querySelectorAll(".mesta");
const popupBg = document.querySelector(".info_bg");
const popup = document.querySelector(".info");



// mesta.forEach((mesta) => {
//   mesta.addEventListener("click", function () {
//     popup.querySelector(".info_photo").setAttribute("src", this.dataset.photo);
//     popup.querySelector(".info_title").innerText = this.dataset.title;
//     popup.querySelector(".info_text").innerText = this.dataset.description;
//     if (this.getAttribute("data-has-link") === "true") {
//       popup.querySelector(".info_link").setAttribute("href", this.dataset.link);
//       popup.querySelector(".info_link").style.display = "block";
//     } else {
//       popup.querySelector(".info_link").style.display = "none";
//     }
//     popupBg.classList.add("active");
//   });
// });


  

// document.addEventListener("click", (e) => {
//   if (e.target === popupBg) {
//     popupBg.classList.remove("active");
//   }
// });

mesta.forEach((mesta) => {
  mesta.addEventListener("click", function () {
    const link = this.dataset.link;
    window.location.href = link;
  });
});





