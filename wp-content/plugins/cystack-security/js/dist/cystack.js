!function(e,n){for(var t in n)e[t]=n[t]}(window,function(e){var n={};function t(r){if(n[r])return n[r].exports;var o=n[r]={i:r,l:!1,exports:{}};return e[r].call(o.exports,o,o.exports,t),o.l=!0,o.exports}return t.m=e,t.c=n,t.d=function(e,n,r){t.o(e,n)||Object.defineProperty(e,n,{enumerable:!0,get:r})},t.r=function(e){"undefined"!=typeof Symbol&&Symbol.toStringTag&&Object.defineProperty(e,Symbol.toStringTag,{value:"Module"}),Object.defineProperty(e,"__esModule",{value:!0})},t.t=function(e,n){if(1&n&&(e=t(e)),8&n)return e;if(4&n&&"object"==typeof e&&e&&e.__esModule)return e;var r=Object.create(null);if(t.r(r),Object.defineProperty(r,"default",{enumerable:!0,value:e}),2&n&&"string"!=typeof e)for(var o in e)t.d(r,o,function(n){return e[n]}.bind(null,o));return r},t.n=function(e){var n=e&&e.__esModule?function(){return e.default}:function(){return e};return t.d(n,"a",n),n},t.o=function(e,n){return Object.prototype.hasOwnProperty.call(e,n)},t.p="",t(t.s=1)}([function(e,n){e.exports=window.jQuery},function(e,n,t){"use strict";t.r(n);var r={};t.r(r),t.d(r,"adminUrl",(function(){return S})),t.d(r,"ajaxUrl",(function(){return $})),t.d(r,"cystackBaseUrl",(function(){return j})),t.d(r,"locale",(function(){return x})),t.d(r,"nonce",(function(){return P})),t.d(r,"phpVersion",(function(){return R})),t.d(r,"pluginPath",(function(){return b})),t.d(r,"plugins",(function(){return I})),t.d(r,"targetId",(function(){return N})),t.d(r,"targetName",(function(){return U})),t.d(r,"targetAddress",(function(){return _})),t.d(r,"cystackEmail",(function(){return M})),t.d(r,"iframeUrl",(function(){return O})),t.d(r,"loginUrl",(function(){return F})),t.d(r,"signupUrl",(function(){return A})),t.d(r,"theme",(function(){return D})),t.d(r,"wpVersion",(function(){return T})),t.d(r,"cystackFeature",(function(){return V})),t.d(r,"homeUrl",(function(){return L}));var o=t(0),a=t.n(o),i=()=>{const e=[];let n=!1;return{destroy(t){n=!0,e.forEach(e=>{e(t)})},onDestroy(t){n?t():e.push(t)}}};const c={"http:":"80","https:":"443"},s=/^(https?:)?\/\/([^/:]+)?(:(\d+))?/,d=["file:","data:"];var u,l,f,g,m,p=e=>(...n)=>{e&&console.log("[Penpal]",...n)};!function(e){e.Call="call",e.Reply="reply",e.Syn="syn",e.SynAck="synAck",e.Ack="ack"}(u||(u={})),function(e){e.Fulfilled="fulfilled",e.Rejected="rejected"}(l||(l={})),function(e){e.ConnectionDestroyed="ConnectionDestroyed",e.ConnectionTimeout="ConnectionTimeout",e.NotInIframe="NotInIframe",e.NoIframeSrc="NoIframeSrc"}(f||(f={})),function(e){e.DataCloneError="DataCloneError"}(g||(g={})),function(e){e.Message="message"}(m||(m={}));const y=({name:e,message:n,stack:t})=>({name:e,message:n,stack:t});var h=(e,n,t)=>{const{localName:r,local:o,remote:a,originForSending:i,originForReceiving:c}=e;let s=!1;const d=e=>{if(e.source!==a||e.data.penpal!==u.Call)return;if(e.origin!==c)return void t(`${r} received message from origin ${e.origin} which did not match expected origin ${c}`);const o=e.data,{methodName:d,args:f,id:m}=o;t(`${r}: Received ${d}() call`);const p=e=>n=>{if(t(`${r}: Sending ${d}() reply`),s)return void t(`${r}: Unable to send ${d}() reply due to destroyed connection`);const o={penpal:u.Reply,id:m,resolution:e,returnValue:n};e===l.Rejected&&n instanceof Error&&(o.returnValue=y(n),o.returnValueIsError=!0);try{a.postMessage(o,i)}catch(e){if(e.name===g.DataCloneError){const n={penpal:u.Reply,id:m,resolution:l.Rejected,returnValue:y(e),returnValueIsError:!0};a.postMessage(n,i)}throw e}};new Promise(e=>e(n[d].apply(n,f))).then(p(l.Fulfilled),p(l.Rejected))};return o.addEventListener(m.Message,d),()=>{s=!0,o.removeEventListener(m.Message,d)}};let v=0;var w=(e,n,t,r,o)=>{const{localName:a,local:i,remote:c,originForSending:s,originForReceiving:d}=n;let g=!1;o(a+": Connecting call sender");const p=e=>(...n)=>{let t;o(`${a}: Sending ${e}() call`);try{c.closed&&(t=!0)}catch(e){t=!0}if(t&&r(),g){const n=new Error(`Unable to send ${e}() call due to destroyed connection`);throw n.code=f.ConnectionDestroyed,n}return new Promise((t,r)=>{const f=++v,g=n=>{if(n.source!==c||n.data.penpal!==u.Reply||n.data.id!==f)return;if(n.origin!==d)return void o(`${a} received message from origin ${n.origin} which did not match expected origin ${d}`);const s=n.data;o(`${a}: Received ${e}() reply`),i.removeEventListener(m.Message,g);let p=s.returnValue;s.returnValueIsError&&(p=(e=>{const n=new Error;return Object.keys(e).forEach(t=>n[t]=e[t]),n})(p)),(s.resolution===l.Fulfilled?t:r)(p)};i.addEventListener(m.Message,g);const p={penpal:u.Call,id:f,methodName:e,args:n};c.postMessage(p,s)})};return t.reduce((e,n)=>(e[n]=p(n),e),e),()=>{g=!0}};var k=(e,n)=>{let t;return void 0!==e&&(t=window.setTimeout(()=>{const t=new Error(`Connection timed out after ${e}ms`);t.code=f.ConnectionTimeout,n(t)},e)),()=>{clearTimeout(t)}},C=e=>{let{iframe:n,methods:t={},childOrigin:r,timeout:o,debug:a=!1}=e;const l=p(a),g=i(),{onDestroy:y,destroy:v}=g;r||((e=>{if(!e.src&&!e.srcdoc){const e=new Error("Iframe must have src or srcdoc property defined.");throw e.code=f.NoIframeSrc,e}})(n),r=(e=>{if(e&&d.find(n=>e.startsWith(n)))return"null";const n=document.location,t=s.exec(e);let r,o,a;t?(r=t[1]?t[1]:n.protocol,o=t[2],a=t[4]):(r=n.protocol,o=n.hostname,a=n.port);return`${r}//${o}${a&&a!==c[r]?":"+a:""}`})(n.src));const C="null"===r?"*":r,E=((e,n,t,r)=>o=>{if(o.origin!==t)return void e(`Parent: Handshake - Received SYN message from origin ${o.origin} which did not match expected origin ${t}`);e("Parent: Handshake - Received SYN, responding with SYN-ACK");const a={penpal:u.SynAck,methodNames:Object.keys(n)};o.source.postMessage(a,r)})(l,t,r,C),S=((e,n,t,r,o)=>{const{destroy:a,onDestroy:i}=r;let c,s;const d={};return r=>{if(r.origin!==n)return void o(`Parent: Handshake - Received ACK message from origin ${r.origin} which did not match expected origin ${n}`);o("Parent: Handshake - Received ACK");const u={localName:"Parent",local:window,remote:r.source,originForSending:t,originForReceiving:n};c&&c(),c=h(u,e,o),i(c),s&&s.forEach(e=>{delete d[e]}),s=r.data.methodNames;const l=w(d,u,s,a,o);return i(l),d}})(t,r,C,g,l);return{promise:new Promise((e,t)=>{const r=k(o,v),a=t=>{if(t.source===n.contentWindow&&t.data)if(t.data.penpal!==u.Syn)if(t.data.penpal!==u.Ack);else{const n=S(t);n&&(r(),e(n))}else E(t)};window.addEventListener(m.Message,a),l("Parent: Awaiting handshake"),((e,n)=>{const{destroy:t,onDestroy:r}=n,o=setInterval(()=>{document.contains(e)||(clearInterval(o),t())},6e4);r(()=>{clearInterval(o)})})(n,g),y(e=>{window.removeEventListener(m.Message,a),e||((e=new Error("Connection destroyed")).code=f.ConnectionDestroyed),t(e)})}),destroy(){v()}}};var E=window.cystackConfig,S=E.adminUrl,$=E.ajaxUrl,j=E.cystackBaseUrl,x=E.locale,P=E.nonce,R=E.phpVersion,b=E.pluginPath,I=E.plugins,N=E.targetId,U=E.targetName,_=E.targetAddress,M=E.cystackEmail,O=E.iframeUrl,F=E.loginUrl,A=E.signupUrl,D=E.theme,T=E.wpVersion,V=E.cystackFeature,L=E.homeUrl;function H(e,n){return function(e,n,t){var r="".concat($,"?action=").concat(e,"&_ajax_nonce=").concat(P);return new Promise((function(e,o){var i={url:r,method:n,contentType:"application/json",success:function(n){return e(n)},error:function(e){return o(e)}};t&&(i.data=JSON.stringify(t)),a.a.ajax(i)}))}(e,"post",n)}var K=function(){return window.location.reload(!0)},Y={cystackClearQueryParam:function(){var e=window.location.toString();e.indexOf("?")>0&&(e=e.substring(0,e.indexOf("?")));var n="".concat(e,"?page=cystack");window.history.pushState({},"",n)},cystackClearMetaTag:function(){return H("cystack_clear_meta_ajax",{})},cystackPageReload:K,cystackPageRedirect:function(e){window.history.replaceState(null,null,"?page=cystack_".concat(e)),K()},cystackGetTargetInfo:function(){return{targetId:N,targetName:U,targetAddress:_,cystackEmail:M}},cystackConnectTarget:function(e){return H("cystack_registration_ajax",e)},cystackDisconnectTarget:function(){return H("cystack_disconnect_ajax",{})},cystackUpdateEmail:function(e){return H("cystack_update_email_ajax",e)},getCystackConfig:function(){return r}},B=j;function J(e){if(e){window.cystackChildFrameConnection||(window.cystackChildFrameConnection=function(e){return C({iframe:e,childOrigin:B,methods:Y})}(e));window.addEventListener("message",(function(e){if(e.origin===B)try{JSON.parse(e.data)}catch(e){}}));"cystack"!==function(e){for(var n=window.location.search.substring(1).split("&"),t=0;t<n.length;t++){var r=n[t].split("=");if(decodeURIComponent(r[0])===e)return decodeURIComponent(r[1])}return null}("page")&&window.addEventListener("message",(function n(t){"unauthorized"===t.data&&(window.removeEventListener("message",n),e.src=F)}))}}a()(document).ready((function(){var e,n;e=a()("#cystack-iframe-container"),J((n=a()('<iframe id="cystack-iframe" src="'.concat(O,'"></iframe>')))[0]),e.append(n)}))}]));
//# sourceMappingURL=cystack.js.map