var listings = new List('retailers-list', {
  valueNames: [
    'name',
    'street_number',
    'street_address',
    'city',
    'country',
    'postcode',
    'street_number',
    'distance',
    { name: 'location', data: ['latitude','longitude']},
    { name: 'country_code', data: ['country_code'] },
    { name: 'logo_md', data: ['logo_md']},
    { name: 'storefront_md', data: ['storefront_md']}
]
});
