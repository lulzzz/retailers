!function(t,e,s,i){"use strict";function n(e,s){o=t(e),this.element=e,this.settings=t.extend({},O,s),this._defaults=O,this._name=a,this.init()}var a="storeLocator";if("undefined"==typeof t.fn[a]&&"undefined"!=typeof google){var o,r,l,g,c,h,u,d,p,m,f,b,y,k,v,D,w,L,M=[],S=[],C=[],I=[],x={},F={},R={},P={},O={mapID:"bh-sl-map",locationList:"bh-sl-loc-list",formContainer:"bh-sl-form-container",formID:"bh-sl-user-location",addressID:"bh-sl-address",regionID:"bh-sl-region",mapSettings:{zoom:12,mapTypeId:google.maps.MapTypeId.ROADMAP},markerImg:null,markerDim:null,catMarkers:null,selectedMarkerImg:null,selectedMarkerImgDim:null,disableAlphaMarkers:!1,lengthUnit:"m",storeLimit:26,distanceAlert:60,dataType:"xml",dataLocation:"data/locations.xml",dataRaw:null,xmlElement:"marker",listColor1:"#ffffff",listColor2:"#eeeeee",originMarker:!1,originMarkerImg:null,originMarkerDim:null,bounceMarker:!0,slideMap:!0,modal:!1,overlay:"bh-sl-overlay",modalWindow:"bh-sl-modal-window",modalContent:"bh-sl-modal-content",closeIcon:"bh-sl-close-icon",defaultLoc:!1,defaultLat:null,defaultLng:null,autoComplete:!1,autoCompleteOptions:{},autoGeocode:!1,geocodeID:null,maxDistance:!1,maxDistanceID:"bh-sl-maxdistance",fullMapStart:!1,fullMapStartBlank:!1,fullMapStartListLimit:!1,noForm:!1,loading:!1,loadingContainer:"bh-sl-loading",featuredLocations:!1,pagination:!1,locationsPerPage:10,inlineDirections:!1,nameSearch:!1,searchID:"bh-sl-search",nameAttribute:"name",visibleMarkersList:!1,dragSearch:!1,infowindowTemplatePath:"assets/js/plugins/storeLocator/templates/infowindow-description.html",listTemplatePath:"assets/js/plugins/storeLocator/templates/location-list-description.html",KMLinfowindowTemplatePath:"assets/js/plugins/storeLocator/templates/kml-infowindow-description.html",KMLlistTemplatePath:"assets/js/plugins/storeLocator/templates/kml-location-list-description.html",listTemplateID:null,infowindowTemplateID:null,taxonomyFilters:null,taxonomyFiltersContainer:"bh-sl-filters-container",exclusiveFiltering:!1,querystringParams:!1,debug:!1,sessionStorage:!1,markerCluster:null,infoBubble:null,callbackNotify:null,callbackBeforeSend:null,callbackSuccess:null,callbackModalOpen:null,callbackModalReady:null,callbackModalClose:null,callbackJsonp:null,callbackCreateMarker:null,callbackPageChange:null,callbackDirectionsRequest:null,callbackCloseDirections:null,callbackNoResults:null,callbackListClick:null,callbackMarkerClick:null,callbackFilters:null,callbackMapSet:null,addressErrorAlert:"Unable to find address",autoGeocodeErrorAlert:"Automatic location detection failed. Please fill in your address or zip code.",distanceErrorAlert:"Unfortunately, our closest location is more than ",mileLang:"mile",milesLang:"miles",kilometerLang:"kilometer",kilometersLang:"kilometers",noResultsTitle:"No results",noResultsDesc:"No locations were found with the given criteria. Please modify your selections or input.",nextPage:"Next &raquo;",prevPage:"&laquo; Prev"};t.extend(n.prototype,{init:function(){var e=this;if(this.writeDebug("init"),"km"===this.settings.lengthUnit?R.EarthRadius=6367:R.EarthRadius=3956,g="kml"===this.settings.dataType?"xml":this.settings.dataType,this.settings.inlineDirections===!0&&t("."+this.settings.locationList).prepend('<div class="bh-sl-directions-panel"></div>'),u=this.settings.mapSettings.zoom,Handlebars.registerHelper("niceURL",function(t){if(t)return t.replace("https://","").replace("http://","")}),null!==this.settings.taxonomyFilters&&this.taxonomyFiltering(),this.settings.modal===!0&&(null!==this.settings.taxonomyFilters&&t("."+this.settings.taxonomyFiltersContainer).clone(!0,!0).prependTo(o),o.wrap('<div class="'+this.settings.overlay+'"><div class="'+this.settings.modalWindow+'"><div class="'+this.settings.modalContent+'">'),t("."+this.settings.modalWindow).prepend('<div class="'+this.settings.closeIcon+'"></div>'),t("."+this.settings.overlay).hide()),this.settings.autoComplete===!0){var i=s.getElementById(this.settings.addressID),n=new google.maps.places.Autocomplete(i,this.settings.autoCompleteOptions);this.settings.autoComplete===!0&&n.addListener("place_changed",function(t){e.processForm(t)})}this._loadTemplates()},destroy:function(){this.writeDebug("destroy"),this.reset();var e=t("#"+this.settings.mapID);if(I.length)for(var i=0;i<=I.length;i++)google.maps.event.removeListener(I[i]);t("."+this.settings.locationList+" ul").empty(),e.hasClass("bh-sl-map-open")&&e.empty().removeClass("bh-sl-map-open"),this.settings.modal===!0&&t(". "+this.settings.overlay).remove(),e.attr("style",""),o.hide(),t.removeData(o.get(0)),t(s).off(a),o.unbind()},reset:function(){if(this.writeDebug("reset"),S=[],M=[],C=[],I=[],L=!1,t(s).off("click."+a,"."+this.settings.locationList+" li"),t("."+this.settings.locationList+" .bh-sl-close-directions-container").length&&t(".bh-sl-close-directions-container").remove(),this.settings.inlineDirections===!0){var e=t("."+this.settings.locationList+" .adp");e.length>0&&(e.remove(),t("."+this.settings.locationList+" ul").fadeIn()),t(s).off("click","."+this.settings.locationList+" li .loc-directions a")}this.settings.pagination===!0&&t(s).off("click."+a,".bh-sl-pagination li")},formFiltersReset:function(){if(this.writeDebug("formFiltersReset"),null!==this.settings.taxonomyFilters){var e=t("."+this.settings.taxonomyFiltersContainer+" input"),s=t("."+this.settings.taxonomyFiltersContainer+" select");"object"==typeof e&&(e.each(function(){(t(this).is('input[type="checkbox"]')||t(this).is('input[type="radio"]'))&&t(this).prop("checked",!1)}),s.each(function(){t(this).prop("selectedIndex",0)}))}},mapReload:function(){this.writeDebug("mapReload"),this.reset(),null!==this.settings.taxonomyFilters&&(this.formFiltersReset(),this.taxonomyFiltersInit()),f&&b?(this.settings.mapSettings.zoom=u,this.processForm()):this.mapping(P)},notify:function(t){this.writeDebug("notify",t),this.settings.callbackNotify?this.settings.callbackNotify.call(this,t):alert(t)},geoCodeCalcToRadian:function(t){return this.writeDebug("geoCodeCalcToRadian",t),t*(Math.PI/180)},geoCodeCalcDiffRadian:function(t,e){return this.writeDebug("geoCodeCalcDiffRadian",arguments),this.geoCodeCalcToRadian(e)-this.geoCodeCalcToRadian(t)},geoCodeCalcCalcDistance:function(t,e,s,i,n){return this.writeDebug("geoCodeCalcCalcDistance",arguments),2*n*Math.asin(Math.min(1,Math.sqrt(Math.pow(Math.sin(this.geoCodeCalcDiffRadian(t,s)/2),2)+Math.cos(this.geoCodeCalcToRadian(t))*Math.cos(this.geoCodeCalcToRadian(s))*Math.pow(Math.sin(this.geoCodeCalcDiffRadian(e,i)/2),2))))},getQueryString:function(t){if(this.writeDebug("getQueryString",t),t){t=t.replace(/[\[]/,"\\[").replace(/[\]]/,"\\]");var e=new RegExp("[\\?&]"+t+"=([^&#]*)"),s=e.exec(location.search);return null===s?"":decodeURIComponent(s[1].replace(/\+/g," "))}},_loadTemplates:function(){this.writeDebug("_loadTemplates");var e,s=this,i='<div class="bh-sl-error">Error: Could not load plugin templates. Check the paths and ensure they have been uploaded. Paths will be wrong if you do not run this from a web server.</div>';"kml"===this.settings.dataType&&null===this.settings.listTemplateID&&null===this.settings.infowindowTemplateID?t.when(t.get(this.settings.KMLinfowindowTemplatePath,function(t){e=t,l=Handlebars.compile(e)}),t.get(this.settings.KMLlistTemplatePath,function(t){e=t,r=Handlebars.compile(e)})).then(function(){s.locator()},function(){throw t("."+s.settings.formContainer).append(i),new Error("Could not load storeLocator plugin templates")}):null!==this.settings.listTemplateID&&null!==this.settings.infowindowTemplateID?(l=Handlebars.compile(t("#"+this.settings.infowindowTemplateID).html()),r=Handlebars.compile(t("#"+this.settings.listTemplateID).html()),s.locator()):t.when(t.get(this.settings.infowindowTemplatePath,function(t){e=t,l=Handlebars.compile(e)}),t.get(this.settings.listTemplatePath,function(t){e=t,r=Handlebars.compile(e)})).then(function(){s.locator()},function(){throw t("."+s.settings.formContainer).append(i),new Error("Could not load storeLocator plugin templates")})},locator:function(){this.writeDebug("locator"),this.settings.slideMap===!0&&o.hide(),this._start(),this._formEventHandler()},_formEventHandler:function(){this.writeDebug("_formEventHandler");var e=this;this.settings.noForm===!0?(t(s).on("click."+a,"."+this.settings.formContainer+" button",function(t){e.processForm(t)}),t(s).on("keydown."+a,function(s){13===s.keyCode&&t("#"+e.settings.addressID).is(":focus")&&e.processForm(s)})):t(s).on("submit."+a,"#"+this.settings.formID,function(t){e.processForm(t)}),t(".bh-sl-reset").length&&t("#"+this.settings.mapID).length&&t(s).on("click."+a,".bh-sl-reset",function(){e.mapReload()})},_getData:function(e,s,i,n){this.writeDebug("_getData",arguments);var a=this,o="",r="",l="";if("undefined"!=typeof n&&"undefined"!=typeof n.geometry.bounds&&(l=n.formatted_address,o=JSON.stringify(n.geometry.bounds.getNorthEast()),r=JSON.stringify(n.geometry.bounds.getSouthWest())),this.settings.callbackBeforeSend&&this.settings.callbackBeforeSend.call(this,e,s,i,l,o,r),null===a.settings.dataRaw){var c=t.Deferred();return this.settings.loading===!0&&t("."+this.settings.formContainer).append('<div class="'+this.settings.loadingContainer+'"></div>'),t.ajax({type:"GET",url:this.settings.dataLocation+("jsonp"===this.settings.dataType?(this.settings.dataLocation.match(/\?/)?"&":"?")+"callback=?":""),data:{origLat:e,origLng:s,origAddress:i,formattedAddress:l,boundsNorthEast:o,boundsSouthWest:r},dataType:g,jsonpCallback:"jsonp"===this.settings.dataType?this.settings.callbackJsonp:null}).done(function(e){c.resolve(e),a.settings.loading===!0&&t("."+a.settings.formContainer+" ."+a.settings.loadingContainer).remove()}).fail(c.reject),c.promise()}return"xml"===g?t.parseXML(a.settings.dataRaw):"json"===g?Array.isArray&&Array.isArray(a.settings.dataRaw)?a.settings.dataRaw:"string"==typeof a.settings.dataRaw?t.parseJSON(a.settings.dataRaw):[]:void 0},_start:function(){this.writeDebug("_start");var i,n=this,o=this.settings.autoGeocode;if(n.settings.fullMapStartBlank!==!1){var r=t("#"+n.settings.mapID);r.addClass("bh-sl-map-open");var l=n.settings.mapSettings;l.zoom=n.settings.fullMapStartBlank,i=new google.maps.LatLng(this.settings.defaultLat,this.settings.defaultLng),l.center=i;var g=new google.maps.Map(s.getElementById(n.settings.mapID),l);google.maps.event.addDomListener(e,"resize",function(){var t=g.getCenter();google.maps.event.trigger(g,"resize"),g.setCenter(t)}),n.settings.fullMapStartBlank=!1,l.zoom=u}else this.settings.defaultLoc===!0&&this.defaultLocation(),""!==t.trim(t("#"+this.settings.addressID).val())?(n.writeDebug("Using Address Field"),n.processForm(null),o=!1):this.settings.fullMapStart===!0&&(this.settings.querystringParams===!0&&this.getQueryString(this.settings.addressID)||this.settings.querystringParams===!0&&this.getQueryString(this.settings.searchID)||this.settings.querystringParams===!0&&this.getQueryString(this.settings.maxDistanceID)?(n.writeDebug("Using Query String"),this.processForm(null),o=!1):this.mapping(null)),this.settings.autoGeocode===!0&&o===!0&&(n.writeDebug("Auto Geo"),n.htmlGeocode()),null!==this.settings.autoGeocode&&(n.writeDebug("Button Geo"),t(s).on("click."+a,"#"+this.settings.geocodeID,function(){n.htmlGeocode()}))},htmlGeocode:function(){this.writeDebug("htmlGeocode",arguments);var t=this;return this.settings.sessionStorage===!0&&e.sessionStorage&&e.sessionStorage.getItem("myGeo")?(this.writeDebug("Using Session Saved Values for GEO"),this.autoGeocodeQuery(JSON.parse(e.sessionStorage.getItem("myGeo"))),!1):void(navigator.geolocation&&navigator.geolocation.getCurrentPosition(function(s){t.writeDebug("Current Position Result");var i={coords:{latitude:s.coords.latitude,longitude:s.coords.longitude,accuracy:s.coords.accuracy}};t.settings.sessionStorage===!0&&e.sessionStorage&&e.sessionStorage.setItem("myGeo",JSON.stringify(i)),t.autoGeocodeQuery(i)},function(e){t._autoGeocodeError(e)}))},googleGeocode:function(t){t.writeDebug("googleGeocode",arguments);var e=new google.maps.Geocoder;this.geocode=function(t,s){e.geocode(t,function(t,e){if(e!==google.maps.GeocoderStatus.OK)throw s(null),new Error("Geocode was not successful for the following reason: "+e);var i={};i.latitude=t[0].geometry.location.lat(),i.longitude=t[0].geometry.location.lng(),i.geocodeResult=t[0],s(i)})}},reverseGoogleGeocode:function(t){t.writeDebug("reverseGoogleGeocode",arguments);var e=new google.maps.Geocoder;this.geocode=function(t,s){e.geocode(t,function(t,e){if(e!==google.maps.GeocoderStatus.OK)throw s(null),new Error("Reverse geocode was not successful for the following reason: "+e);if(t[0]){var i={};i.address=t[0].formatted_address,s(i)}})}},roundNumber:function(t,e){return this.writeDebug("roundNumber",arguments),Math.round(t*Math.pow(10,e))/Math.pow(10,e)},isEmptyObject:function(t){this.writeDebug("isEmptyObject",arguments);for(var e in t)if(t.hasOwnProperty(e))return!1;return!0},hasEmptyObjectVals:function(t){this.writeDebug("hasEmptyObjectVals",arguments);var e=!0;for(var s in t)t.hasOwnProperty(s)&&""!==t[s]&&0!==t[s].length&&(e=!1);return e},modalClose:function(){this.writeDebug("modalClose"),this.settings.callbackModalClose&&this.settings.callbackModalClose.call(this),x={},t("."+this.settings.overlay+" select").prop("selectedIndex",0),t("."+this.settings.overlay+" input").prop("checked",!1),t("."+this.settings.overlay).hide()},_createLocationVariables:function(t){this.writeDebug("_createLocationVariables",arguments);var e;F={};for(var s in S[t])S[t].hasOwnProperty(s)&&(e=S[t][s],"distance"===s&&(e=this.roundNumber(e,2)),F[s]=e)},sortNumerically:function(t){this.writeDebug("sortNumerically",arguments),t.sort(function(t,e){return t.distance<e.distance?-1:t.distance>e.distance?1:0})},filterData:function(t,e){this.writeDebug("filterData",arguments);var s=!0;for(var i in e)if(e.hasOwnProperty(i))if(this.settings.exclusiveFiltering===!0){for(var n=e[i],a=[],o=0;o<n.length;o++)a[o]=new RegExp(n[o],"i").test(t[i].replace(/[^\x00-\x7F]/g,""));a.indexOf(!0)===-1&&(s=!1)}else"undefined"!=typeof t[i]&&new RegExp(e[i].join(""),"i").test(t[i].replace(/[^\x00-\x7F]/g,""))||(s=!1);if(s)return!0},_paginationOutput:function(t,e){this.writeDebug("_paginationOutput",arguments),t=parseFloat(t);var s="",i=t+1,n=t-1;t>0&&(s+='<li class="bh-sl-next-prev" data-page="'+n+'">'+this.settings.prevPage+"</li>");for(var a=0;a<Math.ceil(e);a++){var o=a+1;s+=a===t?'<li class="bh-sl-current" data-page="'+a+'">'+o+"</li>":'<li data-page="'+a+'">'+o+"</li>"}return i<e&&(s+='<li class="bh-sl-next-prev" data-page="'+i+'">'+this.settings.nextPage+"</li>"),s},paginationSetup:function(e){this.writeDebug("paginationSetup",arguments);var s,i="",n=t(".bh-sl-pagination-container .bh-sl-pagination");s=this.settings.storeLimit===-1||S.length<this.settings.storeLimit?S.length/this.settings.locationsPerPage:this.settings.storeLimit/this.settings.locationsPerPage,"undefined"==typeof e&&(e=0),0===n.length?i=this._paginationOutput(e,s):(n.empty(),i=this._paginationOutput(e,s)),n.append(i)},markerImage:function(t,e,s){this.writeDebug("markerImage",arguments);var i;return i="undefined"!=typeof e&&"undefined"!=typeof s?{url:t,size:new google.maps.Size(e,s),scaledSize:new google.maps.Size(e,s)}:{url:t,size:new google.maps.Size(32,32),scaledSize:new google.maps.Size(32,32)}},createMarker:function(t,e,s,i,n,a){this.writeDebug("createMarker",arguments);var o,r,l,g=[];if(null!==this.settings.catMarkers&&"undefined"!=typeof a)if(a.indexOf(",")!==-1){g=a.split(",");for(var c=0;c<g.length;c++)g[c]in this.settings.catMarkers&&(r=this.markerImage(this.settings.catMarkers[g[c]][0],parseInt(this.settings.catMarkers[g[c]][1]),parseInt(this.settings.catMarkers[g[c]][2])))}else a in this.settings.catMarkers&&(r=this.markerImage(this.settings.catMarkers[a][0],parseInt(this.settings.catMarkers[a][1]),parseInt(this.settings.catMarkers[a][2])));return null!==this.settings.markerImg&&(r=null===this.settings.markerDim?this.markerImage(this.settings.markerImg):this.markerImage(this.settings.markerImg,this.settings.markerDim.width,this.settings.markerDim.height)),this.settings.callbackCreateMarker?o=this.settings.callbackCreateMarker.call(this,n,t,i,a):this.settings.disableAlphaMarkers===!0||this.settings.storeLimit===-1||this.settings.storeLimit>26||null!==this.settings.catMarkers||null!==this.settings.markerImg||this.settings.fullMapStart===!0&&L===!0&&(isNaN(this.settings.fullMapStartListLimit)||this.settings.fullMapStartListLimit>26||this.settings.fullMapStartListLimit===-1)?o=new google.maps.Marker({position:t,map:n,draggable:!1,icon:r}):(l={url:"https://mt.googleapis.com/vt/icon/name=icons/spotlight/spotlight-waypoint-b.png&text="+i+"&psize=16&font=fonts/Roboto-Regular.ttf&color=ff333333&ax=44&ay=48"},o=new google.maps.Marker({position:t,map:n,icon:l,draggable:!1})),o},_defineLocationData:function(e,s,i){this.writeDebug("_defineLocationData",arguments);var n="";this._createLocationVariables(e.get("id"));var a;a=F.distance<=1?"km"===this.settings.lengthUnit?this.settings.kilometerLang:this.settings.mileLang:"km"===this.settings.lengthUnit?this.settings.kilometersLang:this.settings.milesLang;var o=e.get("id");return n=this.settings.disableAlphaMarkers===!0||this.settings.storeLimit===-1||this.settings.storeLimit>26||this.settings.fullMapStart===!0&&L===!0&&(isNaN(this.settings.fullMapStartListLimit)||this.settings.fullMapStartListLimit>26||this.settings.fullMapStartListLimit===-1)?o+1:i>0?String.fromCharCode("A".charCodeAt(0)+(s+o)):String.fromCharCode("A".charCodeAt(0)+o),{location:[t.extend(F,{markerid:o,marker:n,length:a,origin:c})]}},listSetup:function(e,s,i){this.writeDebug("listSetup",arguments);var n=this._defineLocationData(e,s,i),a=r(n);t("."+this.settings.locationList+" ul").append(a)},changeSelectedMarker:function(t){var e;"undefined"!=typeof w&&w.setIcon(D),e=null===this.settings.selectedMarkerImgDim?this.markerImage(this.settings.selectedMarkerImg):this.markerImage(this.settings.selectedMarkerImg,this.settings.selectedMarkerImgDim.width,this.settings.selectedMarkerImgDim.height),D=t.icon,t.setIcon(e),w=t},createInfowindow:function(e,s,i,n,a){this.writeDebug("createInfowindow",arguments);var o=this,r=this._defineLocationData(e,n,a),g=l(r);"left"===s?(i.setContent(g),i.open(e.get("map"),e)):google.maps.event.addListener(e,"click",function(){i.setContent(g),i.open(e.get("map"),e);var s=e.get("id"),n=t("."+o.settings.locationList+" li[data-markerid="+s+"]");if(n.length>0){o.settings.callbackMarkerClick&&o.settings.callbackMarkerClick.call(this,e,s,n),t("."+o.settings.locationList+" li").removeClass("list-focus"),n.addClass("list-focus");var a=t("."+o.settings.locationList);a.animate({scrollTop:n.offset().top-a.offset().top+a.scrollTop()})}null!==o.settings.selectedMarkerImg&&o.changeSelectedMarker(e)})},autoGeocodeQuery:function(e){this.writeDebug("autoGeocodeQuery",arguments);var s,i=this,n=null,a=t("#"+this.settings.maxDistanceID);this.settings.querystringParams===!0&&this.getQueryString(this.settings.maxDistanceID)?(n=this.getQueryString(this.settings.maxDistanceID),""!==a.val()&&(n=a.val())):this.settings.maxDistance===!0&&(n=a.val()||"");var o=new this.reverseGoogleGeocode(this),r=new google.maps.LatLng(e.coords.latitude,e.coords.longitude);o.geocode({latLng:r},function(t){null!==t?(s=m=t.address,f=P.lat=e.coords.latitude,b=P.lng=e.coords.longitude,P.origin=s,P.distance=n,i.mapping(P)):i.notify(i.settings.addressErrorAlert)})},_autoGeocodeError:function(){this.writeDebug("_autoGeocodeError"),this.notify(this.settings.autoGeocodeErrorAlert)},defaultLocation:function(){this.writeDebug("defaultLocation");var e,s=this,i=null,n=t("#"+this.settings.maxDistanceID);this.settings.querystringParams===!0&&this.getQueryString(this.settings.maxDistanceID)?(i=this.getQueryString(this.settings.maxDistanceID),""!==n.val()&&(i=n.val())):this.settings.maxDistance===!0&&(i=n.val()||"");var a=new this.reverseGoogleGeocode(this),o=new google.maps.LatLng(this.settings.defaultLat,this.settings.defaultLng);a.geocode({latLng:o},function(t){null!==t?(e=m=t.address,f=P.lat=s.settings.defaultLat,b=P.lng=s.settings.defaultLng,P.distance=i,P.origin=e,s.mapping(P)):s.notify(s.settings.addressErrorAlert)})},paginationChange:function(t){this.writeDebug("paginationChange",arguments),this.settings.callbackPageChange&&this.settings.callbackPageChange.call(this,t),P.page=t,this.mapping(P)},getAddressByMarker:function(t){this.writeDebug("getAddressByMarker",arguments);var e="";return S[t].address&&(e+=S[t].address+" "),S[t].address2&&(e+=S[t].address2+" "),S[t].city&&(e+=S[t].city+", "),S[t].state&&(e+=S[t].state+" "),S[t].postal&&(e+=S[t].postal+" "),S[t].country&&(e+=S[t].country+" "),e},clearMarkers:function(){this.writeDebug("clearMarkers");var t=null;t=S.length<this.settings.storeLimit?S.length:this.settings.storeLimit;for(var e=0;e<t;e++)I[e].setMap(null)},directionsRequest:function(e,i,n){this.writeDebug("directionsRequest",arguments),this.settings.callbackDirectionsRequest&&this.settings.callbackDirectionsRequest.call(this,e,i,n);var a=this.getAddressByMarker(i);if(a){t("."+this.settings.locationList+" ul").hide(),this.clearMarkers(),null!==k&&"undefined"!=typeof k&&(k.setMap(null),k=null),k=new google.maps.DirectionsRenderer,v=new google.maps.DirectionsService,k.setMap(n),k.setPanel(t(".bh-sl-directions-panel").get(0));var o={origin:e,destination:a,travelMode:google.maps.TravelMode.DRIVING};v.route(o,function(t,e){e===google.maps.DirectionsStatus.OK&&k.setDirections(t)}),t("."+this.settings.locationList).prepend('<div class="bh-sl-close-directions-container"><div class="'+this.settings.closeIcon+'"></div></div>')}t(s).off("click","."+this.settings.locationList+" li .loc-directions a")},closeDirections:function(){this.writeDebug("closeDirections"),this.settings.callbackCloseDirections&&this.settings.callbackCloseDirections.call(this),this.reset(),f&&b&&(0===this.countFilters()?this.settings.mapSettings.zoom=u:this.settings.mapSettings.zoom=0,this.processForm(null)),t(s).off("click."+a,"."+this.settings.locationList+" .bh-sl-close-icon")},processForm:function(e){this.writeDebug("processForm",arguments);var s=this,i=null,n=t("#"+this.settings.addressID),a=t("#"+this.settings.searchID),o=t("#"+this.settings.maxDistanceID);"undefined"!=typeof e&&null!==e&&e.preventDefault(),this.settings.querystringParams===!0&&(this.getQueryString(this.settings.addressID)||this.getQueryString(this.settings.searchID)||this.getQueryString(this.settings.maxDistanceID))?(m=this.getQueryString(this.settings.addressID),p=this.getQueryString(this.settings.searchID),i=this.getQueryString(this.settings.maxDistanceID),""!==n.val()&&(m=n.val()),""!==a.val()&&(p=a.val()),""!==o.val()&&(i=o.val())):(m=n.val()||"",p=a.val()||"",this.settings.maxDistance===!0&&(i=o.val()||""));var r=t("#"+this.settings.regionID).val();if(""===m&&""===p)this._start();else if(""!==m)if("undefined"!=typeof c&&"undefined"!=typeof f&&"undefined"!=typeof b&&m===c)P.lat=f,P.lng=b,P.origin=m,P.name=p,P.distance=i,s.mapping(P);else{var l=new this.googleGeocode(this);l.geocode({address:m,region:r},function(t){null!==t?(f=t.latitude,b=t.longitude,P.lat=f,P.lng=b,P.origin=m,P.name=p,P.distance=i,P.geocodeResult=t.geocodeResult,s.mapping(P)):s.notify(s.settings.addressErrorAlert)})}else""!==p&&(P.name=p,s.mapping(P))},locationsSetup:function(t,e,s,i,n){if(this.writeDebug("locationsSetup",arguments),"undefined"!=typeof i&&(t.distance||(t.distance=this.geoCodeCalcCalcDistance(e,s,t.lat,t.lng,R.EarthRadius))),this.settings.maxDistance===!0&&"undefined"!=typeof n&&null!==n){if(!(t.distance<=n))return;S.push(t)}else if(this.settings.maxDistance===!0&&this.settings.querystringParams===!0&&"undefined"!=typeof n&&null!==n){if(!(t.distance<=n))return;S.push(t)}else S.push(t)},countFilters:function(){this.writeDebug("countFilters");var t=0;if(!this.isEmptyObject(x))for(var e in x)x.hasOwnProperty(e)&&(t+=x[e].length);return t},_existingCheckedFilters:function(e){this.writeDebug("_existingCheckedFilters",arguments),t("#"+this.settings.taxonomyFilters[e]+" input[type=checkbox]").each(function(){if(t(this).prop("checked")){var s=t(this).val();"undefined"!=typeof s&&""!==s&&x[e].indexOf(s)===-1&&x[e].push(s)}})},_existingSelectedFilters:function(e){this.writeDebug("_existingSelectedFilters",arguments),t("#"+this.settings.taxonomyFilters[e]+" select").each(function(){var s=t(this).val();"undefined"!=typeof s&&""!==s&&x[e].indexOf(s)===-1&&(x[e]=[s])})},_existingRadioFilters:function(e){this.writeDebug("_existingRadioFilters",arguments),t("#"+this.settings.taxonomyFilters[e]+" input[type=radio]").each(function(){if(t(this).prop("checked")){var s=t(this).val();"undefined"!=typeof s&&""!==s&&x[e].indexOf(s)===-1&&(x[e]=[s])}})},checkFilters:function(){this.writeDebug("checkFilters");for(var t in this.settings.taxonomyFilters)this.settings.taxonomyFilters.hasOwnProperty(t)&&(this._existingCheckedFilters(t),this._existingSelectedFilters(t),this._existingRadioFilters(t))},checkQueryStringFilters:function(){this.writeDebug("checkQueryStringFilters",arguments);for(var t in x)if(x.hasOwnProperty(t)){var e=this.getQueryString(t);"undefined"!=typeof e&&""!==e&&x[t].indexOf(e)===-1&&(x[t]=[e])}},getFilterKey:function(t){this.writeDebug("getFilterKey",arguments);for(var e in this.settings.taxonomyFilters)if(this.settings.taxonomyFilters.hasOwnProperty(e))for(var s=0;s<this.settings.taxonomyFilters[e].length;s++)if(this.settings.taxonomyFilters[e]===t)return e},taxonomyFiltersInit:function(){this.writeDebug("taxonomyFiltersInit");for(var t in this.settings.taxonomyFilters)this.settings.taxonomyFilters.hasOwnProperty(t)&&(x[t]=[])},taxonomyFiltering:function(){this.writeDebug("taxonomyFiltering");var e=this;e.taxonomyFiltersInit(),e.checkQueryStringFilters(),t("."+this.settings.taxonomyFiltersContainer).on("change."+a,"input, select",function(s){s.stopPropagation();var i,n,a;if(t(this).is('input[type="checkbox"]')){if(e.checkFilters(),i=t(this).val(),n=t(this).closest(".bh-sl-filters").attr("id"),a=e.getFilterKey(n))if(t(this).prop("checked"))x[a].indexOf(i)===-1&&x[a].push(i),t("#"+e.settings.mapID).hasClass("bh-sl-map-open")===!0&&(f&&b?(e.settings.mapSettings.zoom=0,e.processForm()):e.mapping(P));else{var o=x[a].indexOf(i);o>-1&&(x[a].splice(o,1),t("#"+e.settings.mapID).hasClass("bh-sl-map-open")===!0&&(f&&b?(0===e.countFilters()?e.settings.mapSettings.zoom=u:e.settings.mapSettings.zoom=0,e.processForm()):e.mapping(P)))}}else(t(this).is("select")||t(this).is('input[type="radio"]'))&&(e.checkFilters(),i=t(this).val(),n=t(this).closest(".bh-sl-filters").attr("id"),a=e.getFilterKey(n),i?a&&(x[a]=[i],t("#"+e.settings.mapID).hasClass("bh-sl-map-open")===!0&&(f&&b?(e.settings.mapSettings.zoom=0,e.processForm()):e.mapping(P))):(a&&(x[a]=[]),e.reset(),f&&b?(e.settings.mapSettings.zoom=u,e.processForm()):e.mapping(P)))})},checkVisibleMarkers:function(e,s){this.writeDebug("checkVisibleMarkers",arguments);var i,n,a=this;t("."+this.settings.locationList+" ul").empty(),t(e).each(function(e,o){s.getBounds().contains(o.getPosition())&&(a.listSetup(o,0,0),n=r(i),t("."+a.settings.locationList+" ul").append(n))}),t("."+this.settings.locationList+" ul li:even").css("background",this.settings.listColor1),t("."+this.settings.locationList+" ul li:odd").css("background",this.settings.listColor2)},dragSearch:function(t){this.writeDebug("dragSearch",arguments);var e,s=t.getCenter(),i=this;this.settings.mapSettings.zoom=t.getZoom(),f=P.lat=s.lat(),b=P.lng=s.lng();var n=new this.reverseGoogleGeocode(this);e=new google.maps.LatLng(P.lat,P.lng),n.geocode({latLng:e},function(t){null!==t?(P.origin=m=t.address,i.mapping(P)):i.notify(i.settings.addressErrorAlert)})},emptyResult:function(){this.writeDebug("emptyResult",arguments);var e,i,n=t("."+this.settings.locationList+" ul"),a=this.settings.mapSettings,o=new google.maps.Map(s.getElementById(this.settings.mapID),a);this.settings.callbackNoResults&&this.settings.callbackNoResults.call(this,o,a),n.empty(),i=t('<li><div class="bh-sl-noresults-title">'+this.settings.noResultsTitle+'</div><br><div class="bh-sl-noresults-desc">'+this.settings.noResultsDesc+"</li>").hide().fadeIn(),n.append(i),e=f&&b?new google.maps.LatLng(f,b):new google.maps.LatLng(0,0),o.setCenter(e),u&&o.setZoom(u)},originMarker:function(t,e,s){if(this.writeDebug("originMarker",arguments),this.settings.originMarker===!0){var i,n="";"undefined"!=typeof e&&(n=null!==this.settings.originMarkerImg?null===this.settings.originMarkerDim?this.markerImage(this.settings.originMarkerImg):this.markerImage(this.settings.originMarkerImg,this.settings.originMarkerDim.width,this.settings.originMarkerDim.height):{url:"https://mt.googleapis.com/vt/icon/name=icons/spotlight/spotlight-waypoint-a.png"},i=new google.maps.Marker({position:s,map:t,icon:n,draggable:!1}))}},modalWindow:function(){if(this.writeDebug("modalWindow"),this.settings.modal===!0){var e=this;e.settings.callbackModalOpen&&e.settings.callbackModalOpen.call(this),t("."+e.settings.overlay).fadeIn(),t(s).on("click."+a,"."+e.settings.closeIcon+", ."+e.settings.overlay,function(){e.modalClose()}),t(s).on("click."+a,"."+e.settings.modalWindow,function(t){t.stopPropagation()}),t(s).on("keyup."+a,function(t){27===t.keyCode&&e.modalClose()})}},listClick:function(e,i,n,o){this.writeDebug("listClick",arguments);var r=this;t(s).on("click."+a,"."+r.settings.locationList+" li",function(){var s=t(this).data("markerid"),a=I[s];r.settings.callbackListClick&&r.settings.callbackListClick.call(this,s,a),e.panTo(a.getPosition());var l="left";r.settings.bounceMarker===!0?(a.setAnimation(google.maps.Animation.BOUNCE),setTimeout(function(){a.setAnimation(null),r.createInfowindow(a,l,i,n,o)},700)):r.createInfowindow(a,l,i,n,o),null!==r.settings.selectedMarkerImg&&r.changeSelectedMarker(a),t("."+r.settings.locationList+" li").removeClass("list-focus"),t("."+r.settings.locationList+" li[data-markerid="+s+"]").addClass("list-focus")}),t(s).on("click."+a,"."+r.settings.locationList+" li a",function(t){t.stopPropagation()})},resultsTotalCount:function(e){this.writeDebug("resultsTotalCount",arguments);var s=t(".bh-sl-total-results");"undefined"==typeof e||e<=0||0===s.length||s.text(e)},inlineDirections:function(e,i){if(this.writeDebug("inlineDirections",arguments),this.settings.inlineDirections===!0&&"undefined"!=typeof i){var n=this;t(s).on("click."+a,"."+n.settings.locationList+" li .loc-directions a",function(o){o.preventDefault();var r=t(this).closest("li").attr("data-markerid");n.directionsRequest(i,r,e),t(s).on("click."+a,"."+n.settings.locationList+" .bh-sl-close-icon",function(){n.closeDirections()})})}},visibleMarkersList:function(t,e){if(this.writeDebug("visibleMarkersList",arguments),this.settings.visibleMarkersList===!0){var s=this;google.maps.event.addListenerOnce(t,"idle",function(){s.checkVisibleMarkers(e,t)}),google.maps.event.addListener(t,"center_changed",function(){s.checkVisibleMarkers(e,t)}),google.maps.event.addListener(t,"zoom_changed",function(){s.checkVisibleMarkers(e,t)})}},mapping:function(t){this.writeDebug("mapping",arguments);var e,s,i,n,a,o,r=this;this.isEmptyObject(t)||(e=t.lat,s=t.lng,i=t.geocodeResult,n=t.origin,o=t.page),r.settings.pagination===!0&&("undefined"!=typeof o&&c===m||(o=0)),"undefined"==typeof n&&this.settings.nameSearch===!0?d=r._getData():(a=new google.maps.LatLng(e,s),"undefined"!=typeof c&&n===c&&"undefined"!=typeof h?(n=c,d=h):d=r._getData(f,b,n,i)),null!==r.settings.taxonomyFilters&&r.hasEmptyObjectVals(x)&&r.checkFilters(),null!==r.settings.dataRaw?r.processData(t,a,d,o):d.done(function(e){r.processData(t,a,e,o)})},processData:function(i,n,r,l){this.writeDebug("processData",arguments);var g,m,f,b,k,v,D,w,F,R,P,O,E,T=this,_=0,A={};this.isEmptyObject(i)||(g=i.lat,m=i.lng,f=i.origin,b=i.name,k=i.distance);var G=t("#"+T.settings.mapID),N="km"===T.settings.lengthUnit?T.settings.kilometersLang:T.settings.milesLang;if(h=d,"undefined"!=typeof f&&(c=f),T.settings.callbackSuccess&&T.settings.callbackSuccess.call(this),O=G.hasClass("bh-sl-map-open"),
T.settings.fullMapStart===!0&&O===!1||T.settings.autoGeocode===!0&&O===!1||T.settings.defaultLoc===!0&&O===!1?L=!0:T.reset(),G.addClass("bh-sl-map-open"),"json"===T.settings.dataType||"jsonp"===T.settings.dataType)for(var z=0;_<r.length;z++){var j=r[z],Q={};for(var B in j)j.hasOwnProperty(B)&&(Q[B]=j[B]);T.locationsSetup(Q,g,m,f,k),_++}else"kml"===T.settings.dataType?t(r).find("Placemark").each(function(){var e={name:t(this).find("name").text(),lat:t(this).find("coordinates").text().split(",")[1],lng:t(this).find("coordinates").text().split(",")[0],description:t(this).find("description").text()};T.locationsSetup(e,g,m,f,k),_++}):t(r).find(T.settings.xmlElement).each(function(){var t={};for(var e in this.attributes)this.attributes.hasOwnProperty(e)&&(t[this.attributes[e].name]=this.attributes[e].value);T.locationsSetup(t,g,m,f,k),_++});if(T.settings.nameSearch===!0&&"undefined"!=typeof p&&(x[T.settings.nameAttribute]=[p]),null!==T.settings.taxonomyFilters||T.settings.nameSearch===!0){for(var q in x)if(x.hasOwnProperty(q)&&x[q].length>0)for(var U=0;U<x[q].length;U++)A[q]||(A[q]=[]),A[q][U]="(?=.*\\b"+x[q][U].replace(/([^\x00-\x7F]|[.*+?^=!:${}()|\[\]\/\\])/g,"")+"\\b)";T.isEmptyObject(A)||(S=t.grep(S,function(t){return T.filterData(t,A)}))}if("undefined"!=typeof f&&T.sortNumerically(S),T.settings.featuredLocations===!0&&(M=t.grep(S,function(t){return"true"===t.featured}),C=t.grep(S,function(t){return"true"!==t.featured}),S=[],S=M.concat(C)),T.isEmptyObject(A))if(T.settings.maxDistance===!0&&k)("undefined"==typeof S[0]||S[0].distance>k)&&T.notify(T.settings.distanceErrorAlert+k+" "+N);else{if("undefined"==typeof S[0])throw new Error("No locations found. Please check the dataLocation setting and path.");T.settings.distanceAlert!==-1&&S[0].distance>T.settings.distanceAlert&&(T.notify(T.settings.distanceErrorAlert+T.settings.distanceAlert+" "+N),P=!0)}if(T.settings.slideMap===!0&&o.slideDown(),T.isEmptyObject(S)||"none"===S[0].result)return void T.emptyResult();if(T.settings.pagination===!0&&T.paginationSetup(l),T.modalWindow(),y=T.settings.storeLimit===-1||S.length<T.settings.storeLimit||this.settings.fullMapStart===!0&&L===!0&&(isNaN(this.settings.fullMapStartListLimit)||this.settings.fullMapStartListLimit>26||this.settings.fullMapStartListLimit===-1)?S.length:T.settings.storeLimit,T.settings.pagination===!0?(F=T.settings.locationsPerPage,w=l*T.settings.locationsPerPage,w+F>S.length&&(F=T.settings.locationsPerPage-(w+F-S.length)),S=S.slice(w,w+F),y=S.length):(F=y,w=0),T.resultsTotalCount(S.length),T.settings.fullMapStart===!0&&L===!0||0===T.settings.mapSettings.zoom||"undefined"==typeof f||P===!0)R=T.settings.mapSettings,D=new google.maps.LatLngBounds;else if(T.settings.pagination===!0){var V=new google.maps.LatLng(S[0].lat,S[0].lng);0===l?(T.settings.mapSettings.center=n,R=T.settings.mapSettings):(T.settings.mapSettings.center=V,R=T.settings.mapSettings)}else T.settings.mapSettings.center=n,R=T.settings.mapSettings;var H=new google.maps.Map(s.getElementById(T.settings.mapID),R);if(google.maps.event.addDomListener(e,"resize",function(){var t=H.getCenter();google.maps.event.trigger(H,"resize"),H.setCenter(t)}),T.settings.dragSearch===!0&&H.addListener("dragend",function(){T.dragSearch(H)}),o.data(T.settings.mapID.replace("#",""),H),T.settings.callbackMapSet&&T.settings.callbackMapSet.call(this,H,n,u,R),"undefined"!=typeof InfoBubble&&null!==T.settings.infoBubble){var K=T.settings.infoBubble;K.map=H,E=new InfoBubble(K)}else E=new google.maps.InfoWindow;T.originMarker(f,n,H),t(s).on("click."+a,".bh-sl-pagination li",function(e){e.preventDefault(),T.paginationChange(t(this).attr("data-page"))}),T.inlineDirections(H,f);for(var W=0;W<=F-1;W++){var J="";J=l>0?String.fromCharCode("A".charCodeAt(0)+(w+W)):String.fromCharCode("A".charCodeAt(0)+W);var Z=new google.maps.LatLng(S[W].lat,S[W].lng);v=T.createMarker(Z,S[W].name,S[W].address,J,H,S[W].category),v.set("id",W),I[W]=v,(T.settings.fullMapStart===!0&&L===!0||0===T.settings.mapSettings.zoom||"undefined"==typeof f||P===!0)&&D.extend(Z),T.createInfowindow(v,null,E,w,l)}(T.settings.fullMapStart===!0&&L===!0||0===T.settings.mapSettings.zoom||"undefined"==typeof f||P===!0)&&H.fitBounds(D);var X=t("."+T.settings.locationList+" ul");if(X.empty(),L&&T.settings.fullMapStartListLimit!==!1&&!isNaN(T.settings.fullMapStartListLimit)&&T.settings.fullMapStartListLimit!==-1)for(var $=0;$<T.settings.fullMapStartListLimit;$++){var Y=I[$];T.listSetup(Y,w,l)}else t(I).each(function(t){var e=I[t];T.listSetup(e,w,l)});if("undefined"!=typeof MarkerClusterer&&null!==T.settings.markerCluster){new MarkerClusterer(H,I,T.settings.markerCluster)}T.listClick(H,E,w,l),t("."+T.settings.locationList+" ul > li:even").css("background",T.settings.listColor1),t("."+T.settings.locationList+" ul > li:odd").css("background",T.settings.listColor2),T.visibleMarkersList(H,I),T.settings.modal===!0&&T.settings.callbackModalReady&&T.settings.callbackModalReady.call(this),T.settings.callbackFilters&&T.settings.callbackFilters.call(this,x)},writeDebug:function(){e.console&&this.settings.debug&&(Function.prototype.bind?this.writeDebug=Function.prototype.bind.call(console.log,console,"StoreLocator :"):this.writeDebug=function(){arguments[0]="StoreLocator : "+arguments[0],Function.prototype.apply.call(console.log,console,arguments)},this.writeDebug.apply(this,arguments))}}),t.fn[a]=function(e){var s=arguments;if(e===i||"object"==typeof e)return this.each(function(){t.data(this,"plugin_"+a)||t.data(this,"plugin_"+a,new n(this,e))});if("string"==typeof e&&"_"!==e[0]&&"init"!==e){var o;return this.each(function(){var i=t.data(this,"plugin_"+a);i instanceof n&&"function"==typeof i[e]&&(o=i[e].apply(i,Array.prototype.slice.call(s,1))),"destroy"===e&&t.data(this,"plugin_"+a,null)}),o!==i?o:this}}}}(jQuery,window,document);