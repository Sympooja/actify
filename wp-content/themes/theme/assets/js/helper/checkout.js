import GLightbox from 'glightbox';

document.addEventListener('DOMContentLoaded', ()=> {
  // Custom html for popup
  let customSlideHTML = `<div class="gslide checkout-popup">
      <div class="gslide-inner-content">
          <div class="ginner-container">
              <div class="gslide-media">
              </div>
              <div class="gslide-description">
                  <div class="gdesc-inner">
                      <h4 class="gslide-title"></h4>
                      <div class="gslide-desc"></div>
                  </div>
              </div>
          </div>
      </div>
  </div>`;

  const popupGlightbox = GLightbox({
    selector: '.glightbox-checkout',
    autofocusVideos : true,
    slideHTML: customSlideHTML,
  });

  // Select all 2checkout links
  const links = [...document.querySelectorAll('a[href^="https://secure.2checkout.com/order/product.php"]')];

  // Looping through each link
  links.forEach(link => {
    link.addEventListener('click', e => {
      e.preventDefault();

      // If link contains url snippet trigger popup
      popupGlightbox.open();

      // Open link to store in new tab after 3 secs
      setTimeout(()=>{window.open(link.href, '_blank')}, 3000)
    })
  })

})