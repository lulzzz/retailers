retailers.json = function(url) {

  qwest.get(url).then(function(xhr, response) {

    $('#locating').hide();
    $('.list').removeClass('list-disabled');

    // Re-structure the listed retailers
    listings.clear();
    listings.add(response);
    listings.sort('distance');

    // Select first result based on distance.
    retailers.shop(
      $('.location').closest('li').first().data('latitude'),
      $('.location').closest('li').first().data('longitude'),
      $('.location').closest('li').first().data('country_code'),
      $('.location').closest('li').first().data('storefront_md'),
      $('.location').closest('li').first().data('logo_md')
    );

    $('.location').closest('li').first().addClass('active');
  })

  .complete(function() {

    // Select via data attribute value (injected inline)
    $('.location').on('click', function() {
      $('.list > li').removeClass('active');
      $(this).toggleClass('active');

      store.set('retailer_latitude', $(this).data('latitude'));
      store.set('retailer_longitude', $(this).data('longitude'));

      retailers.shop(
        $(this).data('latitude'),
        $(this).data('longitude'),
        $(this).data('country_code'),
        $(this).data('storefront_md'),
        $(this).data('logo_md')
      );
    });
  });
};
