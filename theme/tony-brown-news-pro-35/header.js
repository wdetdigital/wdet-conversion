jQuery(document).ready(() => {
  jQuery("#mainNav>div.container-fluid>div.row>div.col-lg-3").each((i, div) => {
    const $div = jQuery(div);
    $div.addClass("col-lg-1");
    $div.removeClass("col-lg-3");
  });
});
