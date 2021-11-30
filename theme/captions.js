jQuery(document).ready(() => {
  jQuery("div[data-caption]").each((i, image) => {
    const caption = image.dataset.caption;
    if (caption) {
      jQuery(image).children("figure").each((j, figure) => {
        jQuery(figure).append(`<figcaption class="wp-caption-text">${caption}</figcaption>`);
      });
    }
  });
});
