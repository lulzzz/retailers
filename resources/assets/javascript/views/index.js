ShopifyApp.Bar.initialize({
  buttons: {
    primary: [
    { 
      label: "Create Retailer",
      loading: false,
      callback: function(messege){
        createModal("/merchants/create");
      }  
    }
    ]
  }
});


window.createModal = function(path){
  ShopifyApp.Modal.open({
    src: path,
    title: 'What Type of Retailer?',
    height: 290,
    width: 'small'
  });
}