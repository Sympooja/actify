$('.link-select').on('change', function () {
  const url = $(this).val(); // get selected value
  if (url) { // require a URL
      window.location = url; // redirect
  }
  return false;
});