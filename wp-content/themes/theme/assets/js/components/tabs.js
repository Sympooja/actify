let tabs = document.querySelectorAll(".tab");
let tabContent = document.querySelectorAll(".content");
tabs.forEach((tab) => {
  tab.addEventListener("click", function () {
    tabs.forEach((item) => {
      item.classList.remove("active");
    });
    this.classList.add("active");
    let tabName = this.getAttribute("data-tab");
    selectTabContent(tabName);
  });
  function selectTabContent(tabName) {
    tabContent.forEach((item) => {
      item.classList.contains(tabName)
        ? item.classList.add("active")
        : item.classList.remove("active");
    });
  }
});
