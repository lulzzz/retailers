!function(e,t){"use strict";function n(t,n,o){"addEventListener"in e?t.addEventListener(n,o,!1):"attachEvent"in e&&t.attachEvent("on"+n,o)}function o(t,n,o){"removeEventListener"in e?t.removeEventListener(n,o,!1):"detachEvent"in e&&t.detachEvent("on"+n,o)}function i(e){return e.charAt(0).toUpperCase()+e.slice(1)}function r(e){var t,n,o,i=null,r=0,a=function(){r=Re(),i=null,o=e.apply(t,n),i||(t=n=null)};return function(){var u=Re();r||(r=u);var c=Me-(u-r);return t=this,n=arguments,c<=0||c>Me?(i&&(clearTimeout(i),i=null),r=u,o=e.apply(t,n),i||(t=n=null)):i||(i=setTimeout(a,c)),o}}function a(e){return me+"["+he+"] "+e}function u(t){de&&"object"==typeof e.console&&console.log(a(t))}function c(t){"object"==typeof e.console&&console.warn(a(t))}function s(){l(),u("Initialising iFrame ("+location.href+")"),f(),g(),m("background",$),m("padding",_),w(),b(),T(),h(),C(),E(),se=k(),q("init","Init message from host page"),Ae()}function l(){function e(e){return"true"===e}var n=ce.substr(ge).split(":");he=n[0],G=t!==n[1]?Number(n[1]):G,ee=t!==n[2]?e(n[2]):ee,de=t!==n[3]?e(n[3]):de,le=t!==n[4]?Number(n[4]):le,X=t!==n[6]?e(n[6]):X,Q=n[7],ae=t!==n[8]?n[8]:ae,$=n[9],_=n[10],Ee=t!==n[11]?Number(n[11]):Ee,se.enable=t!==n[12]&&e(n[12]),ve=t!==n[13]?n[13]:ve,we=t!==n[14]?n[14]:we}function f(){function t(){var t=e.iFrameResizer;u("Reading data from page: "+JSON.stringify(t)),Ce="messageCallback"in t?t.messageCallback:Ce,Ae="readyCallback"in t?t.readyCallback:Ae,Te="targetOrigin"in t?t.targetOrigin:Te,ae="heightCalculationMethod"in t?t.heightCalculationMethod:ae,we="widthCalculationMethod"in t?t.widthCalculationMethod:we}function n(e,t){return"function"==typeof e&&(u("Setup custom "+t+"CalcMethod"),ze[t]=e,e="custom"),e}"iFrameResizer"in e&&Object===e.iFrameResizer.constructor&&(t(),ae=n(ae,"height"),we=n(we,"width")),u("TargetOrigin for parent set to: "+Te)}function d(e,t){return-1!==t.indexOf("-")&&(c("Negative CSS value ignored for "+e),t=""),t}function m(e,n){t!==n&&""!==n&&"null"!==n&&(document.body.style[e]=n,u("Body "+e+' set to "'+n+'"'))}function g(){t===Q&&(Q=G+"px"),m("margin",d("margin",Q))}function h(){document.documentElement.style.height="",document.body.style.height="",u('HTML & body height set to "auto"')}function p(t){function r(){q(t.eventName,t.eventType)}var a={add:function(t){n(e,t,r)},remove:function(t){o(e,t,r)}};t.eventNames&&Array.prototype.map?(t.eventName=t.eventNames[0],t.eventNames.map(a[t.method])):a[t.method](t.eventName),u(i(t.method)+" event listener: "+t.eventType)}function v(e){p({method:e,eventType:"Animation Start",eventNames:["animationstart","webkitAnimationStart"]}),p({method:e,eventType:"Animation Iteration",eventNames:["animationiteration","webkitAnimationIteration"]}),p({method:e,eventType:"Animation End",eventNames:["animationend","webkitAnimationEnd"]}),p({method:e,eventType:"Input",eventName:"input"}),p({method:e,eventType:"Mouse Up",eventName:"mouseup"}),p({method:e,eventType:"Mouse Down",eventName:"mousedown"}),p({method:e,eventType:"Orientation Change",eventName:"orientationchange"}),p({method:e,eventType:"Print",eventName:["afterprint","beforeprint"]}),p({method:e,eventType:"Ready State Change",eventName:"readystatechange"}),p({method:e,eventType:"Touch Start",eventName:"touchstart"}),p({method:e,eventType:"Touch End",eventName:"touchend"}),p({method:e,eventType:"Touch Cancel",eventName:"touchcancel"}),p({method:e,eventType:"Transition Start",eventNames:["transitionstart","webkitTransitionStart","MSTransitionStart","oTransitionStart","otransitionstart"]}),p({method:e,eventType:"Transition Iteration",eventNames:["transitioniteration","webkitTransitionIteration","MSTransitionIteration","oTransitionIteration","otransitioniteration"]}),p({method:e,eventType:"Transition End",eventNames:["transitionend","webkitTransitionEnd","MSTransitionEnd","oTransitionEnd","otransitionend"]}),"child"===ve&&p({method:e,eventType:"IFrame Resized",eventName:"resize"})}function y(e,t,n,o){return t!==e&&(e in n||(c(e+" is not a valid option for "+o+"CalculationMethod."),e=t),u(o+' calculation method set to "'+e+'"')),e}function b(){ae=y(ae,re,Le,"height")}function T(){we=y(we,Ne,Fe,"width")}function E(){!0===X?(v("add"),z()):u("Auto Resize disabled")}function S(){u("Disable outgoing messages"),ye=!1}function O(){u("Remove event listener: Message"),o(e,"message",j)}function M(){null!==Z&&Z.disconnect()}function I(){v("remove"),M(),clearInterval(fe)}function N(){S(),O(),!0===X&&I()}function w(){var e=document.createElement("div");e.style.clear="both",e.style.display="block",document.body.appendChild(e)}function k(){function o(){return{x:e.pageXOffset!==t?e.pageXOffset:document.documentElement.scrollLeft,y:e.pageYOffset!==t?e.pageYOffset:document.documentElement.scrollTop}}function i(e){var t=e.getBoundingClientRect(),n=o();return{x:parseInt(t.left,10)+parseInt(n.x,10),y:parseInt(t.top,10)+parseInt(n.y,10)}}function r(e){function n(e){var t=i(e);u("Moving to in page link (#"+o+") at x: "+t.x+" y: "+t.y),U(t.y,t.x,"scrollToOffset")}var o=e.split("#")[1]||e,r=decodeURIComponent(o),a=document.getElementById(r)||document.getElementsByName(r)[0];t!==a?n(a):(u("In page link (#"+o+") not found in iFrame, so sending to parent"),U(0,0,"inPageLink","#"+o))}function a(){""!==location.hash&&"#"!==location.hash&&r(location.href)}function s(){function e(e){function t(e){e.preventDefault(),r(this.getAttribute("href"))}"#"!==e.getAttribute("href")&&n(e,"click",t)}Array.prototype.forEach.call(document.querySelectorAll('a[href^="#"]'),e)}function l(){n(e,"hashchange",a)}function f(){setTimeout(a,ne)}function d(){Array.prototype.forEach&&document.querySelectorAll?(u("Setting up location.hash handlers"),s(),l(),f()):c("In page linking not fully supported in this browser! (See README.md for IE8 workaround)")}return se.enable?d():u("In page linking not enabled"),{findTarget:r}}function C(){u("Enable public methods"),ke.parentIFrame={autoResize:function(e){return!0===e&&!1===X?(X=!0,E()):!1===e&&!0===X&&(X=!1,I()),X},close:function(){U(0,0,"close"),N()},getId:function(){return he},getPageInfo:function(e){"function"==typeof e?(xe=e,U(0,0,"pageInfo")):(xe=function(){},U(0,0,"pageInfoStop"))},moveToAnchor:function(e){se.findTarget(e)},reset:function(){J("parentIFrame.reset")},scrollTo:function(e,t){U(t,e,"scrollTo")},scrollToOffset:function(e,t){U(t,e,"scrollToOffset")},sendMessage:function(e,t){U(0,0,"message",JSON.stringify(e),t)},setHeightCalculationMethod:function(e){ae=e,b()},setWidthCalculationMethod:function(e){we=e,T()},setTargetOrigin:function(e){u("Set targetOrigin: "+e),Te=e},size:function(e,t){var n=""+(e?e:"")+(t?","+t:"");q("size","parentIFrame.size("+n+")",e,t)}}}function A(){0!==le&&(u("setInterval: "+le+"ms"),fe=setInterval(function(){q("interval","setInterval: "+le)},Math.abs(le)))}function x(){function n(e){function t(e){!1===e.complete&&(u("Attach listeners to "+e.src),e.addEventListener("load",a,!1),e.addEventListener("error",c,!1),f.push(e))}"attributes"===e.type&&"src"===e.attributeName?t(e.target):"childList"===e.type&&Array.prototype.forEach.call(e.target.querySelectorAll("img"),t)}function o(e){f.splice(f.indexOf(e),1)}function i(e){u("Remove listeners from "+e.src),e.removeEventListener("load",a,!1),e.removeEventListener("error",c,!1),o(e)}function r(e,n,o){i(e.target),q(n,o+": "+e.target.src,t,t)}function a(e){r(e,"imageLoad","Image loaded")}function c(e){r(e,"imageLoadFailed","Image load failed")}function s(e){q("mutationObserver","mutationObserver: "+e[0].target+" "+e[0].type),e.forEach(n)}function l(){var e=document.querySelector("body"),t={attributes:!0,attributeOldValue:!1,characterData:!0,characterDataOldValue:!1,childList:!0,subtree:!0};return m=new d(s),u("Create body MutationObserver"),m.observe(e,t),m}var f=[],d=e.MutationObserver||e.WebKitMutationObserver,m=l();return{disconnect:function(){"disconnect"in m&&(u("Disconnect body MutationObserver"),m.disconnect(),f.forEach(i))}}}function z(){var t=0>le;e.MutationObserver||e.WebKitMutationObserver?t?A():Z=x():(u("MutationObserver not supported in this browser!"),A())}function R(e,t){function n(e){var n=/^\d+(px)?$/i;if(n.test(e))return parseInt(e,Y);var o=t.style.left,i=t.runtimeStyle.left;return t.runtimeStyle.left=t.currentStyle.left,t.style.left=e||0,e=t.style.pixelLeft,t.style.left=o,t.runtimeStyle.left=i,e}var o=0;return t=t||document.body,"defaultView"in document&&"getComputedStyle"in document.defaultView?(o=document.defaultView.getComputedStyle(t,null),o=null!==o?o[e]:0):o=n(t.currentStyle[e]),parseInt(o,Y)}function L(e){e>Me/2&&(Me=2*e,u("Event throttle increased to "+Me+"ms"))}function F(e,t){for(var n=t.length,o=0,r=0,a=i(e),c=Re(),s=0;s<n;s++)o=t[s].getBoundingClientRect()[e]+R("margin"+a,t[s]),o>r&&(r=o);return c=Re()-c,u("Parsed "+n+" HTML elements"),u("Element position calculated in "+c+"ms"),L(c),r}function P(e){return[e.bodyOffset(),e.bodyScroll(),e.documentElementOffset(),e.documentElementScroll()]}function D(e,t){function n(){return c("No tagged elements ("+t+") found on page"),ie}var o=document.querySelectorAll("["+t+"]");return 0===o.length?n():F(e,o)}function W(){return document.querySelectorAll("body *")}function H(e,n,o,i){function r(){ie=d,Ie=m,U(ie,Ie,e)}function a(){function e(e,t){var n=Math.abs(e-t)<=Ee;return!n}return d=t!==o?o:Le[ae](),m=t!==i?i:Fe[we](),e(ie,d)||ee&&e(Ie,m)}function c(){return!(e in{init:1,interval:1,size:1})}function s(){return ae in pe||ee&&we in pe}function l(){u("No change in size detected")}function f(){c()&&s()?J(n):e in{interval:1}||l()}var d,m;a()||"init"===e?(B(),r()):f()}function q(e,t,n,o){function i(){e in{reset:1,resetPage:1,init:1}||u("Trigger event: "+t)}function r(){return Se&&e in te}r()?u("Trigger event cancelled: "+e):(i(),Pe(e,t,n,o))}function B(){Se||(Se=!0,u("Trigger event lock on")),clearTimeout(Oe),Oe=setTimeout(function(){Se=!1,u("Trigger event lock off"),u("--")},ne)}function V(e){ie=Le[ae](),Ie=Fe[we](),U(ie,Ie,e)}function J(e){var t=ae;ae=re,u("Reset trigger event: "+e),B(),V("reset"),ae=t}function U(e,n,o,i,r){function a(){t===r?r=Te:u("Message targetOrigin: "+r)}function c(){var a=e+":"+n,c=he+":"+a+":"+o+(t!==i?":"+i:"");u("Sending message to host page ("+c+")"),be.postMessage(me+c,r)}!0===ye&&(a(),c())}function j(t){function o(){return me===(""+t.data).substr(0,ge)}function i(){function o(){ce=t.data,be=t.source,s(),oe=!1,setTimeout(function(){ue=!1},ne)}document.body?o():(u("Waiting for page ready"),n(e,"readystatechange",i))}function r(){ue?u("Page reset ignored by init"):(u("Page size reset by host page"),V("resetPage"))}function a(){q("resizeParent","Parent window requested size check")}function l(){var e=d();se.findTarget(e)}function f(){return t.data.split("]")[1].split(":")[0]}function d(){return t.data.substr(t.data.indexOf(":")+1)}function m(){return"iFrameResize"in e}function g(){var e=d();u("MessageCallback called from parent: "+e),Ce(JSON.parse(e)),u(" --")}function h(){var e=d();u("PageInfoFromParent called from parent: "+e),xe(JSON.parse(e)),u(" --")}function p(){return t.data.split(":")[2]in{"true":1,"false":1}}function v(){switch(f()){case"reset":r();break;case"resize":a();break;case"inPageLink":case"moveToAnchor":l();break;case"message":g();break;case"pageInfo":h();break;default:m()||p()||c("Unexpected message ("+t.data+")")}}function y(){!1===oe?v():p()?i():u('Ignored message of type "'+f()+'". Received before initialization.')}o()&&y()}function K(){"loading"!==document.readyState&&e.parent.postMessage("[iFrameResizerChild]Ready","*")}var X=!0,Y=10,$="",G=0,Q="",Z=null,_="",ee=!1,te={resize:1,click:1},ne=128,oe=!0,ie=1,re="bodyOffset",ae=re,ue=!0,ce="",se={},le=32,fe=null,de=!1,me="[iFrameSizer]",ge=me.length,he="",pe={max:1,min:1,bodyScroll:1,documentElementScroll:1},ve="child",ye=!0,be=e.parent,Te="*",Ee=0,Se=!1,Oe=null,Me=16,Ie=1,Ne="scroll",we=Ne,ke=e,Ce=function(){c("MessageCallback function not defined")},Ae=function(){},xe=function(){},ze={height:function(){return c("Custom height calculation function not defined"),document.documentElement.offsetHeight},width:function(){return c("Custom width calculation function not defined"),document.body.scrollWidth}},Re=Date.now||function(){return(new Date).getTime()},Le={bodyOffset:function(){return document.body.offsetHeight+R("marginTop")+R("marginBottom")},offset:function(){return Le.bodyOffset()},bodyScroll:function(){return document.body.scrollHeight},custom:function(){return ze.height()},documentElementOffset:function(){return document.documentElement.offsetHeight},documentElementScroll:function(){return document.documentElement.scrollHeight},max:function(){return Math.max.apply(null,P(Le))},min:function(){return Math.min.apply(null,P(Le))},grow:function(){return Le.max()},lowestElement:function(){return Math.max(Le.bodyOffset(),F("bottom",W()))},taggedElement:function(){return D("bottom","data-iframe-height")}},Fe={bodyScroll:function(){return document.body.scrollWidth},bodyOffset:function(){return document.body.offsetWidth},custom:function(){return ze.width()},documentElementScroll:function(){return document.documentElement.scrollWidth},documentElementOffset:function(){return document.documentElement.offsetWidth},scroll:function(){return Math.max(Fe.bodyScroll(),Fe.documentElementScroll())},max:function(){return Math.max.apply(null,P(Fe))},min:function(){return Math.min.apply(null,P(Fe))},rightMostElement:function(){return F("right",W())},taggedElement:function(){return D("right","data-iframe-width")}},Pe=r(H);n(e,"message",j),K()}(window||{});