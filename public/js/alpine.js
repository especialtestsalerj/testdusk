(()=>{var e={586:(e,t,n)=>{"use strict";n.r(t);var o,a,i,r,s=n(723),l=n.n(s),c=!1,u=!1,d=[],p=-1;function m(e){!function(e){d.includes(e)||d.push(e);u||c||(c=!0,queueMicrotask(w))}(e)}function f(e){let t=d.indexOf(e);-1!==t&&t>p&&d.splice(t,1)}function w(){c=!1,u=!0;for(let e=0;e<d.length;e++)d[e](),p=e;d.length=0,p=-1,u=!1}var g=!0;function h(e){a=e}var b=[],y=[],v=[];function x(e,t){"function"==typeof t?(e._x_cleanups||(e._x_cleanups=[]),e._x_cleanups.push(t)):(t=e,y.push(t))}function _(e,t){e._x_attributeCleanups&&Object.entries(e._x_attributeCleanups).forEach((([n,o])=>{(void 0===t||t.includes(n))&&(o.forEach((e=>e())),delete e._x_attributeCleanups[n])}))}var k=new MutationObserver(T),C=!1;function A(){k.observe(document,{subtree:!0,childList:!0,attributes:!0,attributeOldValue:!0}),C=!0}function E(){(S=S.concat(k.takeRecords())).length&&!O&&(O=!0,queueMicrotask((()=>{T(S),S.length=0,O=!1}))),k.disconnect(),C=!1}var S=[],O=!1;function P(e){if(!C)return e();E();let t=e();return A(),t}var j=!1,B=[];function T(e){if(j)return void(B=B.concat(e));let t=[],n=[],o=new Map,a=new Map;for(let i=0;i<e.length;i++)if(!e[i].target._x_ignoreMutationObserver&&("childList"===e[i].type&&(e[i].addedNodes.forEach((e=>1===e.nodeType&&t.push(e))),e[i].removedNodes.forEach((e=>1===e.nodeType&&n.push(e)))),"attributes"===e[i].type)){let t=e[i].target,n=e[i].attributeName,r=e[i].oldValue,s=()=>{o.has(t)||o.set(t,[]),o.get(t).push({name:n,value:t.getAttribute(n)})},l=()=>{a.has(t)||a.set(t,[]),a.get(t).push(n)};t.hasAttribute(n)&&null===r?s():t.hasAttribute(n)?(l(),s()):l()}a.forEach(((e,t)=>{_(t,e)})),o.forEach(((e,t)=>{b.forEach((n=>n(t,e)))}));for(let e of n)if(!t.includes(e)&&(y.forEach((t=>t(e))),e._x_cleanups))for(;e._x_cleanups.length;)e._x_cleanups.pop()();t.forEach((e=>{e._x_ignoreSelf=!0,e._x_ignore=!0}));for(let e of t)n.includes(e)||e.isConnected&&(delete e._x_ignoreSelf,delete e._x_ignore,v.forEach((t=>t(e))),e._x_ignore=!0,e._x_ignoreSelf=!0);t.forEach((e=>{delete e._x_ignoreSelf,delete e._x_ignore})),t=null,n=null,o=null,a=null}function L(e){return D(N(e))}function M(e,t,n){return e._x_dataStack=[t,...N(n||e)],()=>{e._x_dataStack=e._x_dataStack.filter((e=>e!==t))}}function z(e,t){let n=e._x_dataStack[0];Object.entries(t).forEach((([e,t])=>{n[e]=t}))}function N(e){return e._x_dataStack?e._x_dataStack:"function"==typeof ShadowRoot&&e instanceof ShadowRoot?N(e.host):e.parentNode?N(e.parentNode):[]}function D(e){let t=new Proxy({},{ownKeys:()=>Array.from(new Set(e.flatMap((e=>Object.keys(e))))),has:(t,n)=>e.some((e=>e.hasOwnProperty(n))),get:(n,o)=>(e.find((e=>{if(e.hasOwnProperty(o)){let n=Object.getOwnPropertyDescriptor(e,o);if(n.get&&n.get._x_alreadyBound||n.set&&n.set._x_alreadyBound)return!0;if((n.get||n.set)&&n.enumerable){let a=n.get,i=n.set,r=n;a=a&&a.bind(t),i=i&&i.bind(t),a&&(a._x_alreadyBound=!0),i&&(i._x_alreadyBound=!0),Object.defineProperty(e,o,{...r,get:a,set:i})}return!0}return!1}))||{})[o],set:(t,n,o)=>{let a=e.find((e=>e.hasOwnProperty(n)));return a?a[n]=o:e[e.length-1][n]=o,!0}});return t}function I(e){let t=(n,o="")=>{Object.entries(Object.getOwnPropertyDescriptors(n)).forEach((([a,{value:i,enumerable:r}])=>{if(!1===r||void 0===i)return;let s=""===o?a:`${o}.${a}`;var l;"object"==typeof i&&null!==i&&i._x_interceptor?n[a]=i.initialize(e,s,a):"object"!=typeof(l=i)||Array.isArray(l)||null===l||i===n||i instanceof Element||t(i,s)}))};return t(e)}function q(e,t=(()=>{})){let n={initialValue:void 0,_x_interceptor:!0,initialize(t,n,o){return e(this.initialValue,(()=>function(e,t){return t.split(".").reduce(((e,t)=>e[t]),e)}(t,n)),(e=>R(t,n,e)),n,o)}};return t(n),e=>{if("object"==typeof e&&null!==e&&e._x_interceptor){let t=n.initialize.bind(n);n.initialize=(o,a,i)=>{let r=e.initialize(o,a,i);return n.initialValue=r,t(o,a,i)}}else n.initialValue=e;return n}}function R(e,t,n){if("string"==typeof t&&(t=t.split(".")),1!==t.length){if(0===t.length)throw error;return e[t[0]]||(e[t[0]]={}),R(e[t[0]],t.slice(1),n)}e[t[0]]=n}var V={};function H(e,t){V[e]=t}function U(e,t){return Object.entries(V).forEach((([n,o])=>{Object.defineProperty(e,`$${n}`,{get(){let[e,n]=ce(t);return e={interceptor:q,...e},x(t,n),o(t,e)},enumerable:!1})})),e}function W(e,t,n,...o){try{return n(...o)}catch(n){F(n,e,t)}}function F(e,t,n=undefined){Object.assign(e,{el:t,expression:n}),console.warn(`Alpine Expression Error: ${e.message}\n\n${n?'Expression: "'+n+'"\n\n':""}`,t),setTimeout((()=>{throw e}),0)}var Z=!0;function Y(e,t,n={}){let o;return K(e,t)((e=>o=e),n),o}function K(...e){return X(...e)}var X=J;function J(e,t){let n={};U(n,e);let o=[n,...N(e)],a="function"==typeof t?function(e,t){return(n=(()=>{}),{scope:o={},params:a=[]}={})=>{Q(n,t.apply(D([o,...e]),a))}}(o,t):function(e,t,n){let o=function(e,t){if(G[e])return G[e];let n=Object.getPrototypeOf((async function(){})).constructor,o=/^[\n\s]*if.*\(.*\)/.test(e)||/^(let|const)\s/.test(e)?`(async()=>{ ${e} })()`:e;const a=()=>{try{return new n(["__self","scope"],`with (scope) { __self.result = ${o} }; __self.finished = true; return __self.result;`)}catch(n){return F(n,t,e),Promise.resolve()}};let i=a();return G[e]=i,i}(t,n);return(a=(()=>{}),{scope:i={},params:r=[]}={})=>{o.result=void 0,o.finished=!1;let s=D([i,...e]);if("function"==typeof o){let e=o(o,s).catch((e=>F(e,n,t)));o.finished?(Q(a,o.result,s,r,n),o.result=void 0):e.then((e=>{Q(a,e,s,r,n)})).catch((e=>F(e,n,t))).finally((()=>o.result=void 0))}}}(o,t,e);return W.bind(null,e,t,a)}var G={};function Q(e,t,n,o,a){if(Z&&"function"==typeof t){let i=t.apply(n,o);i instanceof Promise?i.then((t=>Q(e,t,n,o))).catch((e=>F(e,a,t))):e(i)}else"object"==typeof t&&t instanceof Promise?t.then((t=>e(t))):e(t)}var ee="x-";function te(e=""){return ee+e}var ne={};function oe(e,t){return ne[e]=t,{before(t){if(!ne[t])return void console.warn("Cannot find directive `${directive}`. `${name}` will use the default order of execution");const n=he.indexOf(t);he.splice(n>=0?n:he.indexOf("DEFAULT"),0,e)}}}function ae(e,t,n){if(t=Array.from(t),e._x_virtualDirectives){let n=Object.entries(e._x_virtualDirectives).map((([e,t])=>({name:e,value:t}))),o=ie(n);n=n.map((e=>o.find((t=>t.name===e.name))?{name:`x-bind:${e.name}`,value:`"${e.value}"`}:e)),t=t.concat(n)}let o={},a=t.map(de(((e,t)=>o[e]=t))).filter(fe).map(function(e,t){return({name:n,value:o})=>{let a=n.match(we()),i=n.match(/:([a-zA-Z0-9\-:]+)/),r=n.match(/\.[^.\]]+(?=[^\]]*$)/g)||[],s=t||e[n]||n;return{type:a?a[1]:null,value:i?i[1]:null,modifiers:r.map((e=>e.replace(".",""))),expression:o,original:s}}}(o,n)).sort(be);return a.map((t=>function(e,t){let n=()=>{},o=ne[t.type]||n,[a,i]=ce(e);!function(e,t,n){e._x_attributeCleanups||(e._x_attributeCleanups={}),e._x_attributeCleanups[t]||(e._x_attributeCleanups[t]=[]),e._x_attributeCleanups[t].push(n)}(e,t.original,i);let r=()=>{e._x_ignore||e._x_ignoreSelf||(o.inline&&o.inline(e,t,a),o=o.bind(o,e,t,a),re?se.get(le).push(o):o())};return r.runCleanups=i,r}(e,t)))}function ie(e){return Array.from(e).map(de()).filter((e=>!fe(e)))}var re=!1,se=new Map,le=Symbol();function ce(e){let t=[],[n,o]=function(e){let t=()=>{};return[n=>{let o=a(n);return e._x_effects||(e._x_effects=new Set,e._x_runEffects=()=>{e._x_effects.forEach((e=>e()))}),e._x_effects.add(o),t=()=>{void 0!==o&&(e._x_effects.delete(o),i(o))},o},()=>{t()}]}(e);t.push(o);return[{Alpine:ot,effect:n,cleanup:e=>t.push(e),evaluateLater:K.bind(K,e),evaluate:Y.bind(Y,e)},()=>t.forEach((e=>e()))]}var ue=(e,t)=>({name:n,value:o})=>(n.startsWith(e)&&(n=n.replace(e,t)),{name:n,value:o});function de(e=(()=>{})){return({name:t,value:n})=>{let{name:o,value:a}=pe.reduce(((e,t)=>t(e)),{name:t,value:n});return o!==t&&e(o,t),{name:o,value:a}}}var pe=[];function me(e){pe.push(e)}function fe({name:e}){return we().test(e)}var we=()=>new RegExp(`^${ee}([^:^.]+)\\b`);var ge="DEFAULT",he=["ignore","ref","data","id","bind","init","for","model","modelable","transition","show","if",ge,"teleport"];function be(e,t){let n=-1===he.indexOf(e.type)?ge:e.type,o=-1===he.indexOf(t.type)?ge:t.type;return he.indexOf(n)-he.indexOf(o)}function ye(e,t,n={}){e.dispatchEvent(new CustomEvent(t,{detail:n,bubbles:!0,composed:!0,cancelable:!0}))}function ve(e,t){if("function"==typeof ShadowRoot&&e instanceof ShadowRoot)return void Array.from(e.children).forEach((e=>ve(e,t)));let n=!1;if(t(e,(()=>n=!0)),n)return;let o=e.firstElementChild;for(;o;)ve(o,t),o=o.nextElementSibling}function xe(e,...t){console.warn(`Alpine Warning: ${e}`,...t)}var _e=[],ke=[];function Ce(){return _e.map((e=>e()))}function Ae(){return _e.concat(ke).map((e=>e()))}function Ee(e){_e.push(e)}function Se(e){ke.push(e)}function Oe(e,t=!1){return Pe(e,(e=>{if((t?Ae():Ce()).some((t=>e.matches(t))))return!0}))}function Pe(e,t){if(e){if(t(e))return e;if(e._x_teleportBack&&(e=e._x_teleportBack),e.parentElement)return Pe(e.parentElement,t)}}var je=[];function Be(e,t=ve,n=(()=>{})){!function(e){re=!0;let t=Symbol();le=t,se.set(t,[]);let n=()=>{for(;se.get(t).length;)se.get(t).shift()();se.delete(t)};e(n),re=!1,n()}((()=>{t(e,((e,t)=>{n(e,t),je.forEach((n=>n(e,t))),ae(e,e.attributes).forEach((e=>e())),e._x_ignore&&t()}))}))}function Te(e){ve(e,(e=>_(e)))}var Le=[],Me=!1;function ze(e=(()=>{})){return queueMicrotask((()=>{Me||setTimeout((()=>{Ne()}))})),new Promise((t=>{Le.push((()=>{e(),t()}))}))}function Ne(){for(Me=!1;Le.length;)Le.shift()()}function $e(e,t){return Array.isArray(t)?De(e,t.join(" ")):"object"==typeof t&&null!==t?function(e,t){let n=e=>e.split(" ").filter(Boolean),o=Object.entries(t).flatMap((([e,t])=>!!t&&n(e))).filter(Boolean),a=Object.entries(t).flatMap((([e,t])=>!t&&n(e))).filter(Boolean),i=[],r=[];return a.forEach((t=>{e.classList.contains(t)&&(e.classList.remove(t),r.push(t))})),o.forEach((t=>{e.classList.contains(t)||(e.classList.add(t),i.push(t))})),()=>{r.forEach((t=>e.classList.add(t))),i.forEach((t=>e.classList.remove(t)))}}(e,t):"function"==typeof t?$e(e,t()):De(e,t)}function De(e,t){return t=!0===t?t="":t||"",n=t.split(" ").filter((t=>!e.classList.contains(t))).filter(Boolean),e.classList.add(...n),()=>{e.classList.remove(...n)};var n}function Ie(e,t){return"object"==typeof t&&null!==t?function(e,t){let n={};return Object.entries(t).forEach((([t,o])=>{n[t]=e.style[t],t.startsWith("--")||(t=t.replace(/([a-z])([A-Z])/g,"$1-$2").toLowerCase()),e.style.setProperty(t,o)})),setTimeout((()=>{0===e.style.length&&e.removeAttribute("style")})),()=>{Ie(e,n)}}(e,t):function(e,t){let n=e.getAttribute("style",t);return e.setAttribute("style",t),()=>{e.setAttribute("style",n||"")}}(e,t)}function qe(e,t=(()=>{})){let n=!1;return function(){n?t.apply(this,arguments):(n=!0,e.apply(this,arguments))}}function Re(e,t,n={}){e._x_transition||(e._x_transition={enter:{during:n,start:n,end:n},leave:{during:n,start:n,end:n},in(n=(()=>{}),o=(()=>{})){He(e,t,{during:this.enter.during,start:this.enter.start,end:this.enter.end},n,o)},out(n=(()=>{}),o=(()=>{})){He(e,t,{during:this.leave.during,start:this.leave.start,end:this.leave.end},n,o)}})}function Ve(e){let t=e.parentNode;if(t)return t._x_hidePromise?t:Ve(t)}function He(e,t,{during:n,start:o,end:a}={},i=(()=>{}),r=(()=>{})){if(e._x_transitioning&&e._x_transitioning.cancel(),0===Object.keys(n).length&&0===Object.keys(o).length&&0===Object.keys(a).length)return i(),void r();let s,l,c;!function(e,t){let n,o,a,i=qe((()=>{P((()=>{n=!0,o||t.before(),a||(t.end(),Ne()),t.after(),e.isConnected&&t.cleanup(),delete e._x_transitioning}))}));e._x_transitioning={beforeCancels:[],beforeCancel(e){this.beforeCancels.push(e)},cancel:qe((function(){for(;this.beforeCancels.length;)this.beforeCancels.shift()();i()})),finish:i},P((()=>{t.start(),t.during()})),Me=!0,requestAnimationFrame((()=>{if(n)return;let i=1e3*Number(getComputedStyle(e).transitionDuration.replace(/,.*/,"").replace("s","")),r=1e3*Number(getComputedStyle(e).transitionDelay.replace(/,.*/,"").replace("s",""));0===i&&(i=1e3*Number(getComputedStyle(e).animationDuration.replace("s",""))),P((()=>{t.before()})),o=!0,requestAnimationFrame((()=>{n||(P((()=>{t.end()})),Ne(),setTimeout(e._x_transitioning.finish,i+r),a=!0)}))}))}(e,{start(){s=t(e,o)},during(){l=t(e,n)},before:i,end(){s(),c=t(e,a)},after:r,cleanup(){l(),c()}})}function Ue(e,t,n){if(-1===e.indexOf(t))return n;const o=e[e.indexOf(t)+1];if(!o)return n;if("scale"===t&&isNaN(o))return n;if("duration"===t){let e=o.match(/([0-9]+)ms/);if(e)return e[1]}return"origin"===t&&["top","right","left","center","bottom"].includes(e[e.indexOf(t)+2])?[o,e[e.indexOf(t)+2]].join(" "):o}oe("transition",((e,{value:t,modifiers:n,expression:o},{evaluate:a})=>{"function"==typeof o&&(o=a(o)),o?function(e,t,n){Re(e,$e,"");let o={enter:t=>{e._x_transition.enter.during=t},"enter-start":t=>{e._x_transition.enter.start=t},"enter-end":t=>{e._x_transition.enter.end=t},leave:t=>{e._x_transition.leave.during=t},"leave-start":t=>{e._x_transition.leave.start=t},"leave-end":t=>{e._x_transition.leave.end=t}};o[n](t)}(e,o,t):function(e,t,n){Re(e,Ie);let o=!t.includes("in")&&!t.includes("out")&&!n,a=o||t.includes("in")||["enter"].includes(n),i=o||t.includes("out")||["leave"].includes(n);t.includes("in")&&!o&&(t=t.filter(((e,n)=>n<t.indexOf("out"))));t.includes("out")&&!o&&(t=t.filter(((e,n)=>n>t.indexOf("out"))));let r=!t.includes("opacity")&&!t.includes("scale"),s=r||t.includes("opacity"),l=r||t.includes("scale"),c=s?0:1,u=l?Ue(t,"scale",95)/100:1,d=Ue(t,"delay",0),p=Ue(t,"origin","center"),m="opacity, transform",f=Ue(t,"duration",150)/1e3,w=Ue(t,"duration",75)/1e3,g="cubic-bezier(0.4, 0.0, 0.2, 1)";a&&(e._x_transition.enter.during={transformOrigin:p,transitionDelay:d,transitionProperty:m,transitionDuration:`${f}s`,transitionTimingFunction:g},e._x_transition.enter.start={opacity:c,transform:`scale(${u})`},e._x_transition.enter.end={opacity:1,transform:"scale(1)"});i&&(e._x_transition.leave.during={transformOrigin:p,transitionDelay:d,transitionProperty:m,transitionDuration:`${w}s`,transitionTimingFunction:g},e._x_transition.leave.start={opacity:1,transform:"scale(1)"},e._x_transition.leave.end={opacity:c,transform:`scale(${u})`})}(e,n,t)})),window.Element.prototype._x_toggleAndCascadeWithTransitions=function(e,t,n,o){const a="visible"===document.visibilityState?requestAnimationFrame:setTimeout;let i=()=>a(n);t?e._x_transition&&(e._x_transition.enter||e._x_transition.leave)?e._x_transition.enter&&(Object.entries(e._x_transition.enter.during).length||Object.entries(e._x_transition.enter.start).length||Object.entries(e._x_transition.enter.end).length)?e._x_transition.in(n):i():e._x_transition?e._x_transition.in(n):i():(e._x_hidePromise=e._x_transition?new Promise(((t,n)=>{e._x_transition.out((()=>{}),(()=>t(o))),e._x_transitioning.beforeCancel((()=>n({isFromCancelledTransition:!0})))})):Promise.resolve(o),queueMicrotask((()=>{let t=Ve(e);t?(t._x_hideChildren||(t._x_hideChildren=[]),t._x_hideChildren.push(e)):a((()=>{let t=e=>{let n=Promise.all([e._x_hidePromise,...(e._x_hideChildren||[]).map(t)]).then((([e])=>e()));return delete e._x_hidePromise,delete e._x_hideChildren,n};t(e).catch((e=>{if(!e.isFromCancelledTransition)throw e}))}))})))};var We=!1;function Fe(e,t=(()=>{})){return(...n)=>We?t(...n):e(...n)}function Ze(e,t,n,a=[]){switch(e._x_bindings||(e._x_bindings=o({})),e._x_bindings[t]=n,t=a.includes("camel")?t.toLowerCase().replace(/-(\w)/g,((e,t)=>t.toUpperCase())):t){case"value":!function(e,t){if("radio"===e.type)void 0===e.attributes.value&&(e.value=t),window.fromModel&&(e.checked=Ye(e.value,t));else if("checkbox"===e.type)Number.isInteger(t)?e.value=t:Number.isInteger(t)||Array.isArray(t)||"boolean"==typeof t||[null,void 0].includes(t)?Array.isArray(t)?e.checked=t.some((t=>Ye(t,e.value))):e.checked=!!t:e.value=String(t);else if("SELECT"===e.tagName)!function(e,t){const n=[].concat(t).map((e=>e+""));Array.from(e.options).forEach((e=>{e.selected=n.includes(e.value)}))}(e,t);else{if(e.value===t)return;e.value=t}}(e,n);break;case"style":!function(e,t){e._x_undoAddedStyles&&e._x_undoAddedStyles();e._x_undoAddedStyles=Ie(e,t)}(e,n);break;case"class":!function(e,t){e._x_undoAddedClasses&&e._x_undoAddedClasses();e._x_undoAddedClasses=$e(e,t)}(e,n);break;default:!function(e,t,n){[null,void 0,!1].includes(n)&&function(e){return!["aria-pressed","aria-checked","aria-expanded","aria-selected"].includes(e)}(t)?e.removeAttribute(t):(Ke(t)&&(n=t),function(e,t,n){e.getAttribute(t)!=n&&e.setAttribute(t,n)}(e,t,n))}(e,t,n)}}function Ye(e,t){return e==t}function Ke(e){return["disabled","checked","required","readonly","hidden","open","selected","autofocus","itemscope","multiple","novalidate","allowfullscreen","allowpaymentrequest","formnovalidate","autoplay","controls","loop","muted","playsinline","default","ismap","reversed","async","defer","nomodule"].includes(e)}function Xe(e,t){var n;return function(){var o=this,a=arguments;clearTimeout(n),n=setTimeout((function(){n=null,e.apply(o,a)}),t)}}function Je(e,t){let n;return function(){let o=this,a=arguments;n||(e.apply(o,a),n=!0,setTimeout((()=>n=!1),t))}}var Ge={},Qe=!1;var et={};function tt(e,t,n){let o=[];for(;o.length;)o.pop()();let a=Object.entries(t).map((([e,t])=>({name:e,value:t}))),i=ie(a);a=a.map((e=>i.find((t=>t.name===e.name))?{name:`x-bind:${e.name}`,value:`"${e.value}"`}:e)),ae(e,a,n).map((e=>{o.push(e.runCleanups),e()}))}var nt={};var ot={get reactive(){return o},get release(){return i},get effect(){return a},get raw(){return r},version:"3.12.0",flushAndStopDeferringMutations:function(){j=!1,T(B),B=[]},dontAutoEvaluateFunctions:function(e){let t=Z;Z=!1,e(),Z=t},disableEffectScheduling:function(e){g=!1,e(),g=!0},startObservingMutations:A,stopObservingMutations:E,setReactivityEngine:function(e){o=e.reactive,i=e.release,a=t=>e.effect(t,{scheduler:e=>{g?m(e):e()}}),r=e.raw},closestDataStack:N,skipDuringClone:Fe,onlyDuringClone:function(e){return(...t)=>We&&e(...t)},addRootSelector:Ee,addInitSelector:Se,addScopeToNode:M,deferMutations:function(){j=!0},mapAttributes:me,evaluateLater:K,interceptInit:function(e){je.push(e)},setEvaluator:function(e){X=e},mergeProxies:D,findClosest:Pe,closestRoot:Oe,destroyTree:Te,interceptor:q,transition:He,setStyles:Ie,mutateDom:P,directive:oe,throttle:Je,debounce:Xe,evaluate:Y,initTree:Be,nextTick:ze,prefixed:te,prefix:function(e){ee=e},plugin:function(e){e(ot)},magic:H,store:function(e,t){if(Qe||(Ge=o(Ge),Qe=!0),void 0===t)return Ge[e];Ge[e]=t,"object"==typeof t&&null!==t&&t.hasOwnProperty("init")&&"function"==typeof t.init&&Ge[e].init(),I(Ge[e])},start:function(){var e;document.body||xe("Unable to initialize. Trying to load Alpine before `<body>` is available. Did you forget to add `defer` in Alpine's `<script>` tag?"),ye(document,"alpine:init"),ye(document,"alpine:initializing"),A(),e=e=>Be(e,ve),v.push(e),x((e=>Te(e))),function(e){b.push(e)}(((e,t)=>{ae(e,t).forEach((e=>e()))})),Array.from(document.querySelectorAll(Ae())).filter((e=>!Oe(e.parentElement,!0))).forEach((e=>{Be(e)})),ye(document,"alpine:initialized")},clone:function(e,t){t._x_dataStack||(t._x_dataStack=e._x_dataStack),We=!0,function(e){let t=a;h(((e,n)=>{let o=t(e);return i(o),()=>{}})),e(),h(t)}((()=>{!function(e){let t=!1;Be(e,((e,n)=>{ve(e,((e,o)=>{if(t&&function(e){return Ce().some((t=>e.matches(t)))}(e))return o();t=!0,n(e,o)}))}))}(t)})),We=!1},bound:function(e,t,n){if(e._x_bindings&&void 0!==e._x_bindings[t])return e._x_bindings[t];let o=e.getAttribute(t);return null===o?"function"==typeof n?n():n:""===o||(Ke(t)?!![t,"true"].includes(o):o)},$data:L,walk:ve,data:function(e,t){nt[e]=t},bind:function(e,t){let n="function"!=typeof t?()=>t:t;e instanceof Element?tt(e,n()):et[e]=n}};function at(e,t){const n=Object.create(null),o=e.split(",");for(let e=0;e<o.length;e++)n[o[e]]=!0;return t?e=>!!n[e.toLowerCase()]:e=>!!n[e]}var it,rt=Object.freeze({}),st=(Object.freeze([]),Object.assign),lt=Object.prototype.hasOwnProperty,ct=(e,t)=>lt.call(e,t),ut=Array.isArray,dt=e=>"[object Map]"===wt(e),pt=e=>"symbol"==typeof e,mt=e=>null!==e&&"object"==typeof e,ft=Object.prototype.toString,wt=e=>ft.call(e),gt=e=>wt(e).slice(8,-1),ht=e=>"string"==typeof e&&"NaN"!==e&&"-"!==e[0]&&""+parseInt(e,10)===e,bt=e=>{const t=Object.create(null);return n=>t[n]||(t[n]=e(n))},yt=/-(\w)/g,vt=(bt((e=>e.replace(yt,((e,t)=>t?t.toUpperCase():"")))),/\B([A-Z])/g),xt=(bt((e=>e.replace(vt,"-$1").toLowerCase())),bt((e=>e.charAt(0).toUpperCase()+e.slice(1)))),_t=(bt((e=>e?`on${xt(e)}`:"")),(e,t)=>e!==t&&(e==e||t==t)),kt=new WeakMap,Ct=[],At=Symbol("iterate"),Et=Symbol("Map key iterate");var St=0;function Ot(e){const{deps:t}=e;if(t.length){for(let n=0;n<t.length;n++)t[n].delete(e);t.length=0}}var Pt=!0,jt=[];function Bt(){const e=jt.pop();Pt=void 0===e||e}function Tt(e,t,n){if(!Pt||void 0===it)return;let o=kt.get(e);o||kt.set(e,o=new Map);let a=o.get(n);a||o.set(n,a=new Set),a.has(it)||(a.add(it),it.deps.push(a),it.options.onTrack&&it.options.onTrack({effect:it,target:e,type:t,key:n}))}function Lt(e,t,n,o,a,i){const r=kt.get(e);if(!r)return;const s=new Set,l=e=>{e&&e.forEach((e=>{(e!==it||e.allowRecurse)&&s.add(e)}))};if("clear"===t)r.forEach(l);else if("length"===n&&ut(e))r.forEach(((e,t)=>{("length"===t||t>=o)&&l(e)}));else switch(void 0!==n&&l(r.get(n)),t){case"add":ut(e)?ht(n)&&l(r.get("length")):(l(r.get(At)),dt(e)&&l(r.get(Et)));break;case"delete":ut(e)||(l(r.get(At)),dt(e)&&l(r.get(Et)));break;case"set":dt(e)&&l(r.get(At))}s.forEach((r=>{r.options.onTrigger&&r.options.onTrigger({effect:r,target:e,key:n,type:t,newValue:o,oldValue:a,oldTarget:i}),r.options.scheduler?r.options.scheduler(r):r()}))}var Mt=at("__proto__,__v_isRef,__isVue"),zt=new Set(Object.getOwnPropertyNames(Symbol).map((e=>Symbol[e])).filter(pt)),Nt=Rt(),$t=Rt(!1,!0),Dt=Rt(!0),It=Rt(!0,!0),qt={};function Rt(e=!1,t=!1){return function(n,o,a){if("__v_isReactive"===o)return!e;if("__v_isReadonly"===o)return e;if("__v_raw"===o&&a===(e?t?hn:gn:t?wn:fn).get(n))return n;const i=ut(n);if(!e&&i&&ct(qt,o))return Reflect.get(qt,o,a);const r=Reflect.get(n,o,a);if(pt(o)?zt.has(o):Mt(o))return r;if(e||Tt(n,"get",o),t)return r;if(_n(r)){return!i||!ht(o)?r.value:r}return mt(r)?e?yn(r):bn(r):r}}function Vt(e=!1){return function(t,n,o,a){let i=t[n];if(!e&&(o=xn(o),i=xn(i),!ut(t)&&_n(i)&&!_n(o)))return i.value=o,!0;const r=ut(t)&&ht(n)?Number(n)<t.length:ct(t,n),s=Reflect.set(t,n,o,a);return t===xn(a)&&(r?_t(o,i)&&Lt(t,"set",n,o,i):Lt(t,"add",n,o)),s}}["includes","indexOf","lastIndexOf"].forEach((e=>{const t=Array.prototype[e];qt[e]=function(...e){const n=xn(this);for(let e=0,t=this.length;e<t;e++)Tt(n,"get",e+"");const o=t.apply(n,e);return-1===o||!1===o?t.apply(n,e.map(xn)):o}})),["push","pop","shift","unshift","splice"].forEach((e=>{const t=Array.prototype[e];qt[e]=function(...e){jt.push(Pt),Pt=!1;const n=t.apply(this,e);return Bt(),n}}));var Ht={get:Nt,set:Vt(),deleteProperty:function(e,t){const n=ct(e,t),o=e[t],a=Reflect.deleteProperty(e,t);return a&&n&&Lt(e,"delete",t,void 0,o),a},has:function(e,t){const n=Reflect.has(e,t);return pt(t)&&zt.has(t)||Tt(e,"has",t),n},ownKeys:function(e){return Tt(e,"iterate",ut(e)?"length":At),Reflect.ownKeys(e)}},Ut={get:Dt,set:(e,t)=>(console.warn(`Set operation on key "${String(t)}" failed: target is readonly.`,e),!0),deleteProperty:(e,t)=>(console.warn(`Delete operation on key "${String(t)}" failed: target is readonly.`,e),!0)},Wt=(st({},Ht,{get:$t,set:Vt(!0)}),st({},Ut,{get:It}),e=>mt(e)?bn(e):e),Ft=e=>mt(e)?yn(e):e,Zt=e=>e,Yt=e=>Reflect.getPrototypeOf(e);function Kt(e,t,n=!1,o=!1){const a=xn(e=e.__v_raw),i=xn(t);t!==i&&!n&&Tt(a,"get",t),!n&&Tt(a,"get",i);const{has:r}=Yt(a),s=o?Zt:n?Ft:Wt;return r.call(a,t)?s(e.get(t)):r.call(a,i)?s(e.get(i)):void(e!==a&&e.get(t))}function Xt(e,t=!1){const n=this.__v_raw,o=xn(n),a=xn(e);return e!==a&&!t&&Tt(o,"has",e),!t&&Tt(o,"has",a),e===a?n.has(e):n.has(e)||n.has(a)}function Jt(e,t=!1){return e=e.__v_raw,!t&&Tt(xn(e),"iterate",At),Reflect.get(e,"size",e)}function Gt(e){e=xn(e);const t=xn(this);return Yt(t).has.call(t,e)||(t.add(e),Lt(t,"add",e,e)),this}function Qt(e,t){t=xn(t);const n=xn(this),{has:o,get:a}=Yt(n);let i=o.call(n,e);i?mn(n,o,e):(e=xn(e),i=o.call(n,e));const r=a.call(n,e);return n.set(e,t),i?_t(t,r)&&Lt(n,"set",e,t,r):Lt(n,"add",e,t),this}function en(e){const t=xn(this),{has:n,get:o}=Yt(t);let a=n.call(t,e);a?mn(t,n,e):(e=xn(e),a=n.call(t,e));const i=o?o.call(t,e):void 0,r=t.delete(e);return a&&Lt(t,"delete",e,void 0,i),r}function tn(){const e=xn(this),t=0!==e.size,n=dt(e)?new Map(e):new Set(e),o=e.clear();return t&&Lt(e,"clear",void 0,void 0,n),o}function nn(e,t){return function(n,o){const a=this,i=a.__v_raw,r=xn(i),s=t?Zt:e?Ft:Wt;return!e&&Tt(r,"iterate",At),i.forEach(((e,t)=>n.call(o,s(e),s(t),a)))}}function on(e,t,n){return function(...o){const a=this.__v_raw,i=xn(a),r=dt(i),s="entries"===e||e===Symbol.iterator&&r,l="keys"===e&&r,c=a[e](...o),u=n?Zt:t?Ft:Wt;return!t&&Tt(i,"iterate",l?Et:At),{next(){const{value:e,done:t}=c.next();return t?{value:e,done:t}:{value:s?[u(e[0]),u(e[1])]:u(e),done:t}},[Symbol.iterator](){return this}}}}function an(e){return function(...t){{const n=t[0]?`on key "${t[0]}" `:"";console.warn(`${xt(e)} operation ${n}failed: target is readonly.`,xn(this))}return"delete"!==e&&this}}var rn={get(e){return Kt(this,e)},get size(){return Jt(this)},has:Xt,add:Gt,set:Qt,delete:en,clear:tn,forEach:nn(!1,!1)},sn={get(e){return Kt(this,e,!1,!0)},get size(){return Jt(this)},has:Xt,add:Gt,set:Qt,delete:en,clear:tn,forEach:nn(!1,!0)},ln={get(e){return Kt(this,e,!0)},get size(){return Jt(this,!0)},has(e){return Xt.call(this,e,!0)},add:an("add"),set:an("set"),delete:an("delete"),clear:an("clear"),forEach:nn(!0,!1)},cn={get(e){return Kt(this,e,!0,!0)},get size(){return Jt(this,!0)},has(e){return Xt.call(this,e,!0)},add:an("add"),set:an("set"),delete:an("delete"),clear:an("clear"),forEach:nn(!0,!0)};function un(e,t){const n=t?e?cn:sn:e?ln:rn;return(t,o,a)=>"__v_isReactive"===o?!e:"__v_isReadonly"===o?e:"__v_raw"===o?t:Reflect.get(ct(n,o)&&o in t?n:t,o,a)}["keys","values","entries",Symbol.iterator].forEach((e=>{rn[e]=on(e,!1,!1),ln[e]=on(e,!0,!1),sn[e]=on(e,!1,!0),cn[e]=on(e,!0,!0)}));var dn={get:un(!1,!1)},pn=(un(!1,!0),{get:un(!0,!1)});un(!0,!0);function mn(e,t,n){const o=xn(n);if(o!==n&&t.call(e,o)){const t=gt(e);console.warn(`Reactive ${t} contains both the raw and reactive versions of the same object${"Map"===t?" as keys":""}, which can lead to inconsistencies. Avoid differentiating between the raw and reactive versions of an object and only use the reactive version if possible.`)}}var fn=new WeakMap,wn=new WeakMap,gn=new WeakMap,hn=new WeakMap;function bn(e){return e&&e.__v_isReadonly?e:vn(e,!1,Ht,dn,fn)}function yn(e){return vn(e,!0,Ut,pn,gn)}function vn(e,t,n,o,a){if(!mt(e))return console.warn(`value cannot be made reactive: ${String(e)}`),e;if(e.__v_raw&&(!t||!e.__v_isReactive))return e;const i=a.get(e);if(i)return i;const r=(s=e).__v_skip||!Object.isExtensible(s)?0:function(e){switch(e){case"Object":case"Array":return 1;case"Map":case"Set":case"WeakMap":case"WeakSet":return 2;default:return 0}}(gt(s));var s;if(0===r)return e;const l=new Proxy(e,2===r?o:n);return a.set(e,l),l}function xn(e){return e&&xn(e.__v_raw)||e}function _n(e){return Boolean(e&&!0===e.__v_isRef)}H("nextTick",(()=>ze)),H("dispatch",(e=>ye.bind(ye,e))),H("watch",((e,{evaluateLater:t,effect:n})=>(o,a)=>{let i,r=t(o),s=!0,l=n((()=>r((e=>{JSON.stringify(e),s?i=e:queueMicrotask((()=>{a(e,i),i=e})),s=!1}))));e._x_effects.delete(l)})),H("store",(function(){return Ge})),H("data",(e=>L(e))),H("root",(e=>Oe(e))),H("refs",(e=>(e._x_refs_proxy||(e._x_refs_proxy=D(function(e){let t=[],n=e;for(;n;)n._x_refs&&t.push(n._x_refs),n=n.parentNode;return t}(e))),e._x_refs_proxy)));var kn={};function Cn(e){return kn[e]||(kn[e]=0),++kn[e]}function An(e,t,n){H(t,(t=>xe(`You can't use [$${directiveName}] without first installing the "${e}" plugin here: https://alpinejs.dev/plugins/${n}`,t)))}H("id",(e=>(t,n=null)=>{let o=function(e,t){return Pe(e,(e=>{if(e._x_ids&&e._x_ids[t])return!0}))}(e,t),a=o?o._x_ids[t]:Cn(t);return n?`${t}-${a}-${n}`:`${t}-${a}`})),H("el",(e=>e)),An("Focus","focus","focus"),An("Persist","persist","persist"),oe("modelable",((e,{expression:t},{effect:n,evaluateLater:o,cleanup:r})=>{let s=o(t),l=()=>{let e;return s((t=>e=t)),e},c=o(`${t} = __placeholder`),u=e=>c((()=>{}),{scope:{__placeholder:e}}),d=l();u(d),queueMicrotask((()=>{if(!e._x_model)return;e._x_removeModelListeners.default();let t=e._x_model.get,n=e._x_model.set,o=function({get:e,set:t},{get:n,set:o}){let r,s,l,c,u=!0,d=a((()=>{let a,i;u?(a=e(),o(a),i=n(),u=!1):(a=e(),i=n(),l=JSON.stringify(a),c=JSON.stringify(i),l!==r?(i=n(),o(a),i=a):(t(i),a=i)),r=JSON.stringify(a),s=JSON.stringify(i)}));return()=>{i(d)}}({get:()=>t(),set(e){n(e)}},{get:()=>l(),set(e){u(e)}});r(o)}))}));var En=document.createElement("div");oe("teleport",((e,{modifiers:t,expression:n},{cleanup:o})=>{"template"!==e.tagName.toLowerCase()&&xe("x-teleport can only be used on a <template> tag",e);let a=Fe((()=>document.querySelector(n)),(()=>En))();a||xe(`Cannot find x-teleport element for selector: "${n}"`);let i=e.content.cloneNode(!0).firstElementChild;e._x_teleport=i,i._x_teleportBack=e,e._x_forwardEvents&&e._x_forwardEvents.forEach((t=>{i.addEventListener(t,(t=>{t.stopPropagation(),e.dispatchEvent(new t.constructor(t.type,t))}))})),M(i,{},e),P((()=>{t.includes("prepend")?a.parentNode.insertBefore(i,a):t.includes("append")?a.parentNode.insertBefore(i,a.nextSibling):a.appendChild(i),Be(i),i._x_ignore=!0})),o((()=>i.remove()))}));var Sn=()=>{};function On(e,t,n,o){let a=e,i=e=>o(e),r={},s=(e,t)=>n=>t(e,n);if(n.includes("dot")&&(t=t.replace(/-/g,".")),n.includes("camel")&&(t=function(e){return e.toLowerCase().replace(/-(\w)/g,((e,t)=>t.toUpperCase()))}(t)),n.includes("passive")&&(r.passive=!0),n.includes("capture")&&(r.capture=!0),n.includes("window")&&(a=window),n.includes("document")&&(a=document),n.includes("prevent")&&(i=s(i,((e,t)=>{t.preventDefault(),e(t)}))),n.includes("stop")&&(i=s(i,((e,t)=>{t.stopPropagation(),e(t)}))),n.includes("self")&&(i=s(i,((t,n)=>{n.target===e&&t(n)}))),(n.includes("away")||n.includes("outside"))&&(a=document,i=s(i,((t,n)=>{e.contains(n.target)||!1!==n.target.isConnected&&(e.offsetWidth<1&&e.offsetHeight<1||!1!==e._x_isShown&&t(n))}))),n.includes("once")&&(i=s(i,((e,n)=>{e(n),a.removeEventListener(t,i,r)}))),i=s(i,((e,o)=>{(function(e){return["keydown","keyup"].includes(e)})(t)&&function(e,t){let n=t.filter((e=>!["window","document","prevent","stop","once","capture"].includes(e)));if(n.includes("debounce")){let e=n.indexOf("debounce");n.splice(e,Pn((n[e+1]||"invalid-wait").split("ms")[0])?2:1)}if(n.includes("throttle")){let e=n.indexOf("throttle");n.splice(e,Pn((n[e+1]||"invalid-wait").split("ms")[0])?2:1)}if(0===n.length)return!1;if(1===n.length&&jn(e.key).includes(n[0]))return!1;const o=["ctrl","shift","alt","meta","cmd","super"].filter((e=>n.includes(e)));if(n=n.filter((e=>!o.includes(e))),o.length>0){if(o.filter((t=>("cmd"!==t&&"super"!==t||(t="meta"),e[`${t}Key`]))).length===o.length&&jn(e.key).includes(n[0]))return!1}return!0}(o,n)||e(o)})),n.includes("debounce")){let e=n[n.indexOf("debounce")+1]||"invalid-wait",t=Pn(e.split("ms")[0])?Number(e.split("ms")[0]):250;i=Xe(i,t)}if(n.includes("throttle")){let e=n[n.indexOf("throttle")+1]||"invalid-wait",t=Pn(e.split("ms")[0])?Number(e.split("ms")[0]):250;i=Je(i,t)}return a.addEventListener(t,i,r),()=>{a.removeEventListener(t,i,r)}}function Pn(e){return!Array.isArray(e)&&!isNaN(e)}function jn(e){if(!e)return[];var t;e=[" ","_"].includes(t=e)?t:t.replace(/([a-z])([A-Z])/g,"$1-$2").replace(/[_\s]/,"-").toLowerCase();let n={ctrl:"control",slash:"/",space:" ",spacebar:" ",cmd:"meta",esc:"escape",up:"arrow-up",down:"arrow-down",left:"arrow-left",right:"arrow-right",period:".",equal:"=",minus:"-",underscore:"_"};return n[e]=e,Object.keys(n).map((t=>{if(n[t]===e)return t})).filter((e=>e))}function Bn(e){let t=e?parseFloat(e):null;return n=t,Array.isArray(n)||isNaN(n)?e:t;var n}function Tn(e){return null!==e&&"object"==typeof e&&"function"==typeof e.get&&"function"==typeof e.set}function Ln(e,t,n,o){let a={};if(/^\[.*\]$/.test(e.item)&&Array.isArray(t)){e.item.replace("[","").replace("]","").split(",").map((e=>e.trim())).forEach(((e,n)=>{a[e]=t[n]}))}else if(/^\{.*\}$/.test(e.item)&&!Array.isArray(t)&&"object"==typeof t){e.item.replace("{","").replace("}","").split(",").map((e=>e.trim())).forEach((e=>{a[e]=t[e]}))}else a[e.item]=t;return e.index&&(a[e.index]=n),e.collection&&(a[e.collection]=o),a}function Mn(){}function zn(e,t,n){oe(t,(o=>xe(`You can't use [x-${t}] without first installing the "${e}" plugin here: https://alpinejs.dev/plugins/${n}`,o)))}Sn.inline=(e,{modifiers:t},{cleanup:n})=>{t.includes("self")?e._x_ignoreSelf=!0:e._x_ignore=!0,n((()=>{t.includes("self")?delete e._x_ignoreSelf:delete e._x_ignore}))},oe("ignore",Sn),oe("effect",((e,{expression:t},{effect:n})=>n(K(e,t)))),oe("model",((e,{modifiers:t,expression:n},{effect:o,cleanup:a})=>{let i=e;t.includes("parent")&&(i=e.parentNode);let r,s=K(i,n);r="string"==typeof n?K(i,`${n} = __placeholder`):"function"==typeof n&&"string"==typeof n()?K(i,`${n()} = __placeholder`):()=>{};let l=()=>{let e;return s((t=>e=t)),Tn(e)?e.get():e},c=e=>{let t;s((e=>t=e)),Tn(t)?t.set(e):r((()=>{}),{scope:{__placeholder:e}})};t.includes("fill")&&e.hasAttribute("value")&&(null===l()||""===l())&&c(e.value),"string"==typeof n&&"radio"===e.type&&P((()=>{e.hasAttribute("name")||e.setAttribute("name",n)}));var u="select"===e.tagName.toLowerCase()||["checkbox","radio"].includes(e.type)||t.includes("lazy")?"change":"input";let d=We?()=>{}:On(e,u,t,(n=>{c(function(e,t,n,o){return P((()=>{if(n instanceof CustomEvent&&void 0!==n.detail)return void 0!==n.detail?n.detail:n.target.value;if("checkbox"===e.type){if(Array.isArray(o)){let e=t.includes("number")?Bn(n.target.value):n.target.value;return n.target.checked?o.concat([e]):o.filter((t=>!(t==e)))}return n.target.checked}if("select"===e.tagName.toLowerCase()&&e.multiple)return t.includes("number")?Array.from(n.target.selectedOptions).map((e=>Bn(e.value||e.text))):Array.from(n.target.selectedOptions).map((e=>e.value||e.text));{let e=n.target.value;return t.includes("number")?Bn(e):t.includes("trim")?e.trim():e}}))}(e,t,n,l()))}));if(e._x_removeModelListeners||(e._x_removeModelListeners={}),e._x_removeModelListeners.default=d,a((()=>e._x_removeModelListeners.default())),e.form){let t=On(e.form,"reset",[],(t=>{ze((()=>e._x_model&&e._x_model.set(e.value)))}));a((()=>t()))}e._x_model={get:()=>l(),set(e){c(e)}},e._x_forceModelUpdate=t=>{void 0===(t=void 0===t?l():t)&&"string"==typeof n&&n.match(/\./)&&(t=""),window.fromModel=!0,P((()=>Ze(e,"value",t))),delete window.fromModel},o((()=>{let n=l();t.includes("unintrusive")&&document.activeElement.isSameNode(e)||e._x_forceModelUpdate(n)}))})),oe("cloak",(e=>queueMicrotask((()=>P((()=>e.removeAttribute(te("cloak")))))))),Se((()=>`[${te("init")}]`)),oe("init",Fe(((e,{expression:t},{evaluate:n})=>"string"==typeof t?!!t.trim()&&n(t,{},!1):n(t,{},!1)))),oe("text",((e,{expression:t},{effect:n,evaluateLater:o})=>{let a=o(t);n((()=>{a((t=>{P((()=>{e.textContent=t}))}))}))})),oe("html",((e,{expression:t},{effect:n,evaluateLater:o})=>{let a=o(t);n((()=>{a((t=>{P((()=>{e.innerHTML=t,e._x_ignoreSelf=!0,Be(e),delete e._x_ignoreSelf}))}))}))})),me(ue(":",te("bind:"))),oe("bind",((e,{value:t,modifiers:n,expression:o,original:a},{effect:i})=>{if(!t){let t={};return r=t,Object.entries(et).forEach((([e,t])=>{Object.defineProperty(r,e,{get:()=>(...e)=>t(...e)})})),void K(e,o)((t=>{tt(e,t,a)}),{scope:t})}var r;if("key"===t)return function(e,t){e._x_keyExpression=t}(e,o);let s=K(e,o);i((()=>s((a=>{void 0===a&&"string"==typeof o&&o.match(/\./)&&(a=""),P((()=>Ze(e,t,a,n)))}))))})),Ee((()=>`[${te("data")}]`)),oe("data",Fe(((e,{expression:t},{cleanup:n})=>{t=""===t?"{}":t;let a={};U(a,e);let i={};var r,s;r=i,s=a,Object.entries(nt).forEach((([e,t])=>{Object.defineProperty(r,e,{get:()=>(...e)=>t.bind(s)(...e),enumerable:!1})}));let l=Y(e,t,{scope:i});void 0!==l&&!0!==l||(l={}),U(l,e);let c=o(l);I(c);let u=M(e,c);c.init&&Y(e,c.init),n((()=>{c.destroy&&Y(e,c.destroy),u()}))}))),oe("show",((e,{modifiers:t,expression:n},{effect:o})=>{let a=K(e,n);e._x_doHide||(e._x_doHide=()=>{P((()=>{e.style.setProperty("display","none",t.includes("important")?"important":void 0)}))}),e._x_doShow||(e._x_doShow=()=>{P((()=>{1===e.style.length&&"none"===e.style.display?e.removeAttribute("style"):e.style.removeProperty("display")}))});let i,r=()=>{e._x_doHide(),e._x_isShown=!1},s=()=>{e._x_doShow(),e._x_isShown=!0},l=()=>setTimeout(s),c=qe((e=>e?s():r()),(t=>{"function"==typeof e._x_toggleAndCascadeWithTransitions?e._x_toggleAndCascadeWithTransitions(e,t,s,r):t?l():r()})),u=!0;o((()=>a((e=>{(u||e!==i)&&(t.includes("immediate")&&(e?l():r()),c(e),i=e,u=!1)}))))})),oe("for",((e,{expression:t},{effect:n,cleanup:a})=>{let i=function(e){let t=/,([^,\}\]]*)(?:,([^,\}\]]*))?$/,n=/^\s*\(|\)\s*$/g,o=/([\s\S]*?)\s+(?:in|of)\s+([\s\S]*)/,a=e.match(o);if(!a)return;let i={};i.items=a[2].trim();let r=a[1].replace(n,"").trim(),s=r.match(t);s?(i.item=r.replace(t,"").trim(),i.index=s[1].trim(),s[2]&&(i.collection=s[2].trim())):i.item=r;return i}(t),r=K(e,i.items),s=K(e,e._x_keyExpression||"index");e._x_prevKeys=[],e._x_lookup={},n((()=>function(e,t,n,a){let i=e=>"object"==typeof e&&!Array.isArray(e),r=e;n((n=>{var s;s=n,!Array.isArray(s)&&!isNaN(s)&&n>=0&&(n=Array.from(Array(n).keys(),(e=>e+1))),void 0===n&&(n=[]);let l=e._x_lookup,c=e._x_prevKeys,u=[],d=[];if(i(n))n=Object.entries(n).map((([e,o])=>{let i=Ln(t,o,e,n);a((e=>d.push(e)),{scope:{index:e,...i}}),u.push(i)}));else for(let e=0;e<n.length;e++){let o=Ln(t,n[e],e,n);a((e=>d.push(e)),{scope:{index:e,...o}}),u.push(o)}let p=[],m=[],w=[],g=[];for(let e=0;e<c.length;e++){let t=c[e];-1===d.indexOf(t)&&w.push(t)}c=c.filter((e=>!w.includes(e)));let h="template";for(let e=0;e<d.length;e++){let t=d[e],n=c.indexOf(t);if(-1===n)c.splice(e,0,t),p.push([h,e]);else if(n!==e){let t=c.splice(e,1)[0],o=c.splice(n-1,1)[0];c.splice(e,0,o),c.splice(n,0,t),m.push([t,o])}else g.push(t);h=t}for(let e=0;e<w.length;e++){let t=w[e];l[t]._x_effects&&l[t]._x_effects.forEach(f),l[t].remove(),l[t]=null,delete l[t]}for(let e=0;e<m.length;e++){let[t,n]=m[e],o=l[t],a=l[n],i=document.createElement("div");P((()=>{a.after(i),o.after(a),a._x_currentIfEl&&a.after(a._x_currentIfEl),i.before(o),o._x_currentIfEl&&o.after(o._x_currentIfEl),i.remove()})),z(a,u[d.indexOf(n)])}for(let e=0;e<p.length;e++){let[t,n]=p[e],a="template"===t?r:l[t];a._x_currentIfEl&&(a=a._x_currentIfEl);let i=u[n],s=d[n],c=document.importNode(r.content,!0).firstElementChild;M(c,o(i),r),P((()=>{a.after(c),Be(c)})),"object"==typeof s&&xe("x-for key cannot be an object, it must be a string or an integer",r),l[s]=c}for(let e=0;e<g.length;e++)z(l[g[e]],u[d.indexOf(g[e])]);r._x_prevKeys=d}))}(e,i,r,s))),a((()=>{Object.values(e._x_lookup).forEach((e=>e.remove())),delete e._x_prevKeys,delete e._x_lookup}))})),Mn.inline=(e,{expression:t},{cleanup:n})=>{let o=Oe(e);o._x_refs||(o._x_refs={}),o._x_refs[t]=e,n((()=>delete o._x_refs[t]))},oe("ref",Mn),oe("if",((e,{expression:t},{effect:n,cleanup:o})=>{let a=K(e,t);n((()=>a((t=>{t?(()=>{if(e._x_currentIfEl)return e._x_currentIfEl;let t=e.content.cloneNode(!0).firstElementChild;M(t,{},e),P((()=>{e.after(t),Be(t)})),e._x_currentIfEl=t,e._x_undoIf=()=>{ve(t,(e=>{e._x_effects&&e._x_effects.forEach(f)})),t.remove(),delete e._x_currentIfEl}})():e._x_undoIf&&(e._x_undoIf(),delete e._x_undoIf)})))),o((()=>e._x_undoIf&&e._x_undoIf()))})),oe("id",((e,{expression:t},{evaluate:n})=>{n(t).forEach((t=>function(e,t){e._x_ids||(e._x_ids={}),e._x_ids[t]||(e._x_ids[t]=Cn(t))}(e,t)))})),me(ue("@",te("on:"))),oe("on",Fe(((e,{value:t,modifiers:n,expression:o},{cleanup:a})=>{let i=o?K(e,o):()=>{};"template"===e.tagName.toLowerCase()&&(e._x_forwardEvents||(e._x_forwardEvents=[]),e._x_forwardEvents.includes(t)||e._x_forwardEvents.push(t));let r=On(e,t,n,(e=>{i((()=>{}),{scope:{$event:e},params:[e]})}));a((()=>r()))}))),zn("Collapse","collapse","collapse"),zn("Intersect","intersect","intersect"),zn("Focus","trap","focus"),zn("Mask","mask","mask"),ot.setEvaluator(J),ot.setReactivityEngine({reactive:bn,effect:function(e,t=rt){(function(e){return e&&!0===e._isEffect})(e)&&(e=e.raw);const n=function(e,t){const n=function(){if(!n.active)return e();if(!Ct.includes(n)){Ot(n);try{return jt.push(Pt),Pt=!0,Ct.push(n),it=n,e()}finally{Ct.pop(),Bt(),it=Ct[Ct.length-1]}}};return n.id=St++,n.allowRecurse=!!t.allowRecurse,n._isEffect=!0,n.active=!0,n.raw=e,n.deps=[],n.options=t,n}(e,t);return t.lazy||n(),n},release:function(e){e.active&&(Ot(e),e.options.onStop&&e.options.onStop(),e.active=!1)},raw:xn});var Nn=ot;window.VMasker=l(),window.inputHandler=function(e,t,n){var o=n.target,a=o.value.replace(/\D/g,""),i=o.value.length>t?1:0;l()(o).unMask(),l()(o).maskPattern(e[i]),o.value=l().toPattern(a,e[i])},window.Alpine=Nn,Nn.start(),window.Swal=n(455),window.addEventListener("swal",(function(e){var t=e.detail;Swal.fire({title:t.title,text:t.text,icon:"warning",showConfirmButton:!0,cancelButtonColor:"#E3352E",confirmButtonColor:"#38c172",confirmButtonText:"confirmar",cancelButtonText:"cancelar",showCancelButton:!0}).then((function(e){e.isConfirmed&&(Livewire.emit(t.confirmEvent),Swal.fire({toast:!0,position:"top-end",showConfirmButton:!1,showCancelButton:!1,timer:2e3,icon:"success",title:("delete"===t.action?"Apagado":"Salvo")+" com sucesso"}))}))})),window.addEventListener("show-modal",(function(e){$("#"+e.detail.target).modal("show")})),window.addEventListener("hide-modal",(function(e){$("#"+e.detail.target).modal("hide")}))},455:function(e){e.exports=function(){"use strict";const e="SweetAlert2:",t=e=>{const t=[];for(let n=0;n<e.length;n++)-1===t.indexOf(e[n])&&t.push(e[n]);return t},n=e=>e.charAt(0).toUpperCase()+e.slice(1),o=e=>Array.prototype.slice.call(e),a=t=>{console.warn("".concat(e," ").concat("object"==typeof t?t.join(" "):t))},i=t=>{console.error("".concat(e," ").concat(t))},r=[],s=e=>{r.includes(e)||(r.push(e),a(e))},l=(e,t)=>{s('"'.concat(e,'" is deprecated and will be removed in the next major release. Please use "').concat(t,'" instead.'))},c=e=>"function"==typeof e?e():e,u=e=>e&&"function"==typeof e.toPromise,d=e=>u(e)?e.toPromise():Promise.resolve(e),p=e=>e&&Promise.resolve(e)===e,m={title:"",titleText:"",text:"",html:"",footer:"",icon:void 0,iconColor:void 0,iconHtml:void 0,template:void 0,toast:!1,showClass:{popup:"swal2-show",backdrop:"swal2-backdrop-show",icon:"swal2-icon-show"},hideClass:{popup:"swal2-hide",backdrop:"swal2-backdrop-hide",icon:"swal2-icon-hide"},customClass:{},target:"body",color:void 0,backdrop:!0,heightAuto:!0,allowOutsideClick:!0,allowEscapeKey:!0,allowEnterKey:!0,stopKeydownPropagation:!0,keydownListenerCapture:!1,showConfirmButton:!0,showDenyButton:!1,showCancelButton:!1,preConfirm:void 0,preDeny:void 0,confirmButtonText:"OK",confirmButtonAriaLabel:"",confirmButtonColor:void 0,denyButtonText:"No",denyButtonAriaLabel:"",denyButtonColor:void 0,cancelButtonText:"Cancel",cancelButtonAriaLabel:"",cancelButtonColor:void 0,buttonsStyling:!0,reverseButtons:!1,focusConfirm:!0,focusDeny:!1,focusCancel:!1,returnFocus:!0,showCloseButton:!1,closeButtonHtml:"&times;",closeButtonAriaLabel:"Close this dialog",loaderHtml:"",showLoaderOnConfirm:!1,showLoaderOnDeny:!1,imageUrl:void 0,imageWidth:void 0,imageHeight:void 0,imageAlt:"",timer:void 0,timerProgressBar:!1,width:void 0,padding:void 0,background:void 0,input:void 0,inputPlaceholder:"",inputLabel:"",inputValue:"",inputOptions:{},inputAutoTrim:!0,inputAttributes:{},inputValidator:void 0,returnInputValueOnDeny:!1,validationMessage:void 0,grow:!1,position:"center",progressSteps:[],currentProgressStep:void 0,progressStepsDistance:void 0,willOpen:void 0,didOpen:void 0,didRender:void 0,willClose:void 0,didClose:void 0,didDestroy:void 0,scrollbarPadding:!0},f=["allowEscapeKey","allowOutsideClick","background","buttonsStyling","cancelButtonAriaLabel","cancelButtonColor","cancelButtonText","closeButtonAriaLabel","closeButtonHtml","color","confirmButtonAriaLabel","confirmButtonColor","confirmButtonText","currentProgressStep","customClass","denyButtonAriaLabel","denyButtonColor","denyButtonText","didClose","didDestroy","footer","hideClass","html","icon","iconColor","iconHtml","imageAlt","imageHeight","imageUrl","imageWidth","preConfirm","preDeny","progressSteps","returnFocus","reverseButtons","showCancelButton","showCloseButton","showConfirmButton","showDenyButton","text","title","titleText","willClose"],w={},g=["allowOutsideClick","allowEnterKey","backdrop","focusConfirm","focusDeny","focusCancel","returnFocus","heightAuto","keydownListenerCapture"],h=e=>Object.prototype.hasOwnProperty.call(m,e),b=e=>-1!==f.indexOf(e),y=e=>w[e],v=e=>{h(e)||a('Unknown parameter "'.concat(e,'"'))},x=e=>{g.includes(e)&&a('The parameter "'.concat(e,'" is incompatible with toasts'))},_=e=>{y(e)&&l(e,y(e))},k=e=>{!e.backdrop&&e.allowOutsideClick&&a('"allowOutsideClick" parameter requires `backdrop` parameter to be set to `true`');for(const t in e)v(t),e.toast&&x(t),_(t)},C="swal2-",A=e=>{const t={};for(const n in e)t[e[n]]=C+e[n];return t},E=A(["container","shown","height-auto","iosfix","popup","modal","no-backdrop","no-transition","toast","toast-shown","show","hide","close","title","html-container","actions","confirm","deny","cancel","default-outline","footer","icon","icon-content","image","input","file","range","select","radio","checkbox","label","textarea","inputerror","input-label","validation-message","progress-steps","active-progress-step","progress-step","progress-step-line","loader","loading","styled","top","top-start","top-end","top-left","top-right","center","center-start","center-end","center-left","center-right","bottom","bottom-start","bottom-end","bottom-left","bottom-right","grow-row","grow-column","grow-fullscreen","rtl","timer-progress-bar","timer-progress-bar-container","scrollbar-measure","icon-success","icon-warning","icon-info","icon-question","icon-error"]),S=A(["success","warning","info","question","error"]),O=()=>document.body.querySelector(".".concat(E.container)),P=e=>{const t=O();return t?t.querySelector(e):null},j=e=>P(".".concat(e)),B=()=>j(E.popup),T=()=>j(E.icon),L=()=>j(E.title),M=()=>j(E["html-container"]),z=()=>j(E.image),N=()=>j(E["progress-steps"]),$=()=>j(E["validation-message"]),D=()=>P(".".concat(E.actions," .").concat(E.confirm)),I=()=>P(".".concat(E.actions," .").concat(E.deny)),q=()=>j(E["input-label"]),R=()=>P(".".concat(E.loader)),V=()=>P(".".concat(E.actions," .").concat(E.cancel)),H=()=>j(E.actions),U=()=>j(E.footer),W=()=>j(E["timer-progress-bar"]),F=()=>j(E.close),Z='\n  a[href],\n  area[href],\n  input:not([disabled]),\n  select:not([disabled]),\n  textarea:not([disabled]),\n  button:not([disabled]),\n  iframe,\n  object,\n  embed,\n  [tabindex="0"],\n  [contenteditable],\n  audio[controls],\n  video[controls],\n  summary\n',Y=()=>{const e=o(B().querySelectorAll('[tabindex]:not([tabindex="-1"]):not([tabindex="0"])')).sort(((e,t)=>{const n=parseInt(e.getAttribute("tabindex")),o=parseInt(t.getAttribute("tabindex"));return n>o?1:n<o?-1:0})),n=o(B().querySelectorAll(Z)).filter((e=>"-1"!==e.getAttribute("tabindex")));return t(e.concat(n)).filter((e=>fe(e)))},K=()=>ee(document.body,E.shown)&&!ee(document.body,E["toast-shown"])&&!ee(document.body,E["no-backdrop"]),X=()=>B()&&ee(B(),E.toast),J=()=>B().hasAttribute("data-loading"),G={previousBodyPadding:null},Q=(e,t)=>{if(e.textContent="",t){const n=(new DOMParser).parseFromString(t,"text/html");o(n.querySelector("head").childNodes).forEach((t=>{e.appendChild(t)})),o(n.querySelector("body").childNodes).forEach((t=>{e.appendChild(t)}))}},ee=(e,t)=>{if(!t)return!1;const n=t.split(/\s+/);for(let t=0;t<n.length;t++)if(!e.classList.contains(n[t]))return!1;return!0},te=(e,t)=>{o(e.classList).forEach((n=>{Object.values(E).includes(n)||Object.values(S).includes(n)||Object.values(t.showClass).includes(n)||e.classList.remove(n)}))},ne=(e,t,n)=>{if(te(e,t),t.customClass&&t.customClass[n]){if("string"!=typeof t.customClass[n]&&!t.customClass[n].forEach)return a("Invalid type of customClass.".concat(n,'! Expected string or iterable object, got "').concat(typeof t.customClass[n],'"'));re(e,t.customClass[n])}},oe=(e,t)=>{if(!t)return null;switch(t){case"select":case"textarea":case"file":return e.querySelector(".".concat(E.popup," > .").concat(E[t]));case"checkbox":return e.querySelector(".".concat(E.popup," > .").concat(E.checkbox," input"));case"radio":return e.querySelector(".".concat(E.popup," > .").concat(E.radio," input:checked"))||e.querySelector(".".concat(E.popup," > .").concat(E.radio," input:first-child"));case"range":return e.querySelector(".".concat(E.popup," > .").concat(E.range," input"));default:return e.querySelector(".".concat(E.popup," > .").concat(E.input))}},ae=e=>{if(e.focus(),"file"!==e.type){const t=e.value;e.value="",e.value=t}},ie=(e,t,n)=>{e&&t&&("string"==typeof t&&(t=t.split(/\s+/).filter(Boolean)),t.forEach((t=>{Array.isArray(e)?e.forEach((e=>{n?e.classList.add(t):e.classList.remove(t)})):n?e.classList.add(t):e.classList.remove(t)})))},re=(e,t)=>{ie(e,t,!0)},se=(e,t)=>{ie(e,t,!1)},le=(e,t)=>{const n=o(e.childNodes);for(let e=0;e<n.length;e++)if(ee(n[e],t))return n[e]},ce=(e,t,n)=>{n==="".concat(parseInt(n))&&(n=parseInt(n)),n||0===parseInt(n)?e.style[t]="number"==typeof n?"".concat(n,"px"):n:e.style.removeProperty(t)},ue=function(e){let t=arguments.length>1&&void 0!==arguments[1]?arguments[1]:"flex";e.style.display=t},de=e=>{e.style.display="none"},pe=(e,t,n,o)=>{const a=e.querySelector(t);a&&(a.style[n]=o)},me=(e,t,n)=>{t?ue(e,n):de(e)},fe=e=>!(!e||!(e.offsetWidth||e.offsetHeight||e.getClientRects().length)),we=()=>!fe(D())&&!fe(I())&&!fe(V()),ge=e=>!!(e.scrollHeight>e.clientHeight),he=e=>{const t=window.getComputedStyle(e),n=parseFloat(t.getPropertyValue("animation-duration")||"0"),o=parseFloat(t.getPropertyValue("transition-duration")||"0");return n>0||o>0},be=function(e){let t=arguments.length>1&&void 0!==arguments[1]&&arguments[1];const n=W();fe(n)&&(t&&(n.style.transition="none",n.style.width="100%"),setTimeout((()=>{n.style.transition="width ".concat(e/1e3,"s linear"),n.style.width="0%"}),10))},ye=()=>{const e=W(),t=parseInt(window.getComputedStyle(e).width);e.style.removeProperty("transition"),e.style.width="100%";const n=t/parseInt(window.getComputedStyle(e).width)*100;e.style.removeProperty("transition"),e.style.width="".concat(n,"%")},ve=()=>"undefined"==typeof window||"undefined"==typeof document,xe=100,_e={},ke=()=>{_e.previousActiveElement&&_e.previousActiveElement.focus?(_e.previousActiveElement.focus(),_e.previousActiveElement=null):document.body&&document.body.focus()},Ce=e=>new Promise((t=>{if(!e)return t();const n=window.scrollX,o=window.scrollY;_e.restoreFocusTimeout=setTimeout((()=>{ke(),t()}),xe),window.scrollTo(n,o)})),Ae='\n <div aria-labelledby="'.concat(E.title,'" aria-describedby="').concat(E["html-container"],'" class="').concat(E.popup,'" tabindex="-1">\n   <button type="button" class="').concat(E.close,'"></button>\n   <ul class="').concat(E["progress-steps"],'"></ul>\n   <div class="').concat(E.icon,'"></div>\n   <img class="').concat(E.image,'" />\n   <h2 class="').concat(E.title,'" id="').concat(E.title,'"></h2>\n   <div class="').concat(E["html-container"],'" id="').concat(E["html-container"],'"></div>\n   <input class="').concat(E.input,'" />\n   <input type="file" class="').concat(E.file,'" />\n   <div class="').concat(E.range,'">\n     <input type="range" />\n     <output></output>\n   </div>\n   <select class="').concat(E.select,'"></select>\n   <div class="').concat(E.radio,'"></div>\n   <label for="').concat(E.checkbox,'" class="').concat(E.checkbox,'">\n     <input type="checkbox" />\n     <span class="').concat(E.label,'"></span>\n   </label>\n   <textarea class="').concat(E.textarea,'"></textarea>\n   <div class="').concat(E["validation-message"],'" id="').concat(E["validation-message"],'"></div>\n   <div class="').concat(E.actions,'">\n     <div class="').concat(E.loader,'"></div>\n     <button type="button" class="').concat(E.confirm,'"></button>\n     <button type="button" class="').concat(E.deny,'"></button>\n     <button type="button" class="').concat(E.cancel,'"></button>\n   </div>\n   <div class="').concat(E.footer,'"></div>\n   <div class="').concat(E["timer-progress-bar-container"],'">\n     <div class="').concat(E["timer-progress-bar"],'"></div>\n   </div>\n </div>\n').replace(/(^|\n)\s*/g,""),Ee=()=>{const e=O();return!!e&&(e.remove(),se([document.documentElement,document.body],[E["no-backdrop"],E["toast-shown"],E["has-column"]]),!0)},Se=()=>{_e.currentInstance.resetValidationMessage()},Oe=()=>{const e=B(),t=le(e,E.input),n=le(e,E.file),o=e.querySelector(".".concat(E.range," input")),a=e.querySelector(".".concat(E.range," output")),i=le(e,E.select),r=e.querySelector(".".concat(E.checkbox," input")),s=le(e,E.textarea);t.oninput=Se,n.onchange=Se,i.onchange=Se,r.onchange=Se,s.oninput=Se,o.oninput=()=>{Se(),a.value=o.value},o.onchange=()=>{Se(),o.nextSibling.value=o.value}},Pe=e=>"string"==typeof e?document.querySelector(e):e,je=e=>{const t=B();t.setAttribute("role",e.toast?"alert":"dialog"),t.setAttribute("aria-live",e.toast?"polite":"assertive"),e.toast||t.setAttribute("aria-modal","true")},Be=e=>{"rtl"===window.getComputedStyle(e).direction&&re(O(),E.rtl)},Te=e=>{const t=Ee();if(ve())return void i("SweetAlert2 requires document to initialize");const n=document.createElement("div");n.className=E.container,t&&re(n,E["no-transition"]),Q(n,Ae);const o=Pe(e.target);o.appendChild(n),je(e),Be(o),Oe()},Le=(e,t)=>{e instanceof HTMLElement?t.appendChild(e):"object"==typeof e?Me(e,t):e&&Q(t,e)},Me=(e,t)=>{e.jquery?ze(t,e):Q(t,e.toString())},ze=(e,t)=>{if(e.textContent="",0 in t)for(let n=0;n in t;n++)e.appendChild(t[n].cloneNode(!0));else e.appendChild(t.cloneNode(!0))},Ne=(()=>{if(ve())return!1;const e=document.createElement("div"),t={WebkitAnimation:"webkitAnimationEnd",animation:"animationend"};for(const n in t)if(Object.prototype.hasOwnProperty.call(t,n)&&void 0!==e.style[n])return t[n];return!1})(),$e=()=>{const e=document.createElement("div");e.className=E["scrollbar-measure"],document.body.appendChild(e);const t=e.getBoundingClientRect().width-e.clientWidth;return document.body.removeChild(e),t},De=(e,t)=>{const n=H(),o=R();t.showConfirmButton||t.showDenyButton||t.showCancelButton?ue(n):de(n),ne(n,t,"actions"),Ie(n,o,t),Q(o,t.loaderHtml),ne(o,t,"loader")};function Ie(e,t,n){const o=D(),a=I(),i=V();Re(o,"confirm",n),Re(a,"deny",n),Re(i,"cancel",n),qe(o,a,i,n),n.reverseButtons&&(n.toast?(e.insertBefore(i,o),e.insertBefore(a,o)):(e.insertBefore(i,t),e.insertBefore(a,t),e.insertBefore(o,t)))}function qe(e,t,n,o){if(!o.buttonsStyling)return se([e,t,n],E.styled);re([e,t,n],E.styled),o.confirmButtonColor&&(e.style.backgroundColor=o.confirmButtonColor,re(e,E["default-outline"])),o.denyButtonColor&&(t.style.backgroundColor=o.denyButtonColor,re(t,E["default-outline"])),o.cancelButtonColor&&(n.style.backgroundColor=o.cancelButtonColor,re(n,E["default-outline"]))}function Re(e,t,o){me(e,o["show".concat(n(t),"Button")],"inline-block"),Q(e,o["".concat(t,"ButtonText")]),e.setAttribute("aria-label",o["".concat(t,"ButtonAriaLabel")]),e.className=E[t],ne(e,o,"".concat(t,"Button")),re(e,o["".concat(t,"ButtonClass")])}function Ve(e,t){"string"==typeof t?e.style.background=t:t||re([document.documentElement,document.body],E["no-backdrop"])}function He(e,t){t in E?re(e,E[t]):(a('The "position" parameter is not valid, defaulting to "center"'),re(e,E.center))}function Ue(e,t){if(t&&"string"==typeof t){const n="grow-".concat(t);n in E&&re(e,E[n])}}const We=(e,t)=>{const n=O();n&&(Ve(n,t.backdrop),He(n,t.position),Ue(n,t.grow),ne(n,t,"container"))};var Fe={awaitingPromise:new WeakMap,promise:new WeakMap,innerParams:new WeakMap,domCache:new WeakMap};const Ze=["input","file","range","select","radio","checkbox","textarea"],Ye=(e,t)=>{const n=B(),o=Fe.innerParams.get(e),a=!o||t.input!==o.input;Ze.forEach((e=>{const o=E[e],i=le(n,o);Je(e,t.inputAttributes),i.className=o,a&&de(i)})),t.input&&(a&&Ke(t),Ge(t))},Ke=e=>{if(!nt[e.input])return i('Unexpected type of input! Expected "text", "email", "password", "number", "tel", "select", "radio", "checkbox", "textarea", "file" or "url", got "'.concat(e.input,'"'));const t=tt(e.input),n=nt[e.input](t,e);ue(n),setTimeout((()=>{ae(n)}))},Xe=e=>{for(let t=0;t<e.attributes.length;t++){const n=e.attributes[t].name;["type","value","style"].includes(n)||e.removeAttribute(n)}},Je=(e,t)=>{const n=oe(B(),e);if(n){Xe(n);for(const e in t)n.setAttribute(e,t[e])}},Ge=e=>{const t=tt(e.input);e.customClass&&re(t,e.customClass.input)},Qe=(e,t)=>{e.placeholder&&!t.inputPlaceholder||(e.placeholder=t.inputPlaceholder)},et=(e,t,n)=>{if(n.inputLabel){e.id=E.input;const o=document.createElement("label"),a=E["input-label"];o.setAttribute("for",e.id),o.className=a,re(o,n.customClass.inputLabel),o.innerText=n.inputLabel,t.insertAdjacentElement("beforebegin",o)}},tt=e=>{const t=E[e]?E[e]:E.input;return le(B(),t)},nt={};nt.text=nt.email=nt.password=nt.number=nt.tel=nt.url=(e,t)=>("string"==typeof t.inputValue||"number"==typeof t.inputValue?e.value=t.inputValue:p(t.inputValue)||a('Unexpected type of inputValue! Expected "string", "number" or "Promise", got "'.concat(typeof t.inputValue,'"')),et(e,e,t),Qe(e,t),e.type=t.input,e),nt.file=(e,t)=>(et(e,e,t),Qe(e,t),e),nt.range=(e,t)=>{const n=e.querySelector("input"),o=e.querySelector("output");return n.value=t.inputValue,n.type=t.input,o.value=t.inputValue,et(n,e,t),e},nt.select=(e,t)=>{if(e.textContent="",t.inputPlaceholder){const n=document.createElement("option");Q(n,t.inputPlaceholder),n.value="",n.disabled=!0,n.selected=!0,e.appendChild(n)}return et(e,e,t),e},nt.radio=e=>(e.textContent="",e),nt.checkbox=(e,t)=>{const n=oe(B(),"checkbox");n.value="1",n.id=E.checkbox,n.checked=Boolean(t.inputValue);const o=e.querySelector("span");return Q(o,t.inputPlaceholder),e},nt.textarea=(e,t)=>{e.value=t.inputValue,Qe(e,t),et(e,e,t);const n=e=>parseInt(window.getComputedStyle(e).marginLeft)+parseInt(window.getComputedStyle(e).marginRight);return setTimeout((()=>{if("MutationObserver"in window){const t=parseInt(window.getComputedStyle(B()).width);new MutationObserver((()=>{const o=e.offsetWidth+n(e);B().style.width=o>t?"".concat(o,"px"):null})).observe(e,{attributes:!0,attributeFilter:["style"]})}})),e};const ot=(e,t)=>{const n=M();ne(n,t,"htmlContainer"),t.html?(Le(t.html,n),ue(n,"block")):t.text?(n.textContent=t.text,ue(n,"block")):de(n),Ye(e,t)},at=(e,t)=>{const n=U();me(n,t.footer),t.footer&&Le(t.footer,n),ne(n,t,"footer")},it=(e,t)=>{const n=F();Q(n,t.closeButtonHtml),ne(n,t,"closeButton"),me(n,t.showCloseButton),n.setAttribute("aria-label",t.closeButtonAriaLabel)},rt=(e,t)=>{const n=Fe.innerParams.get(e),o=T();return n&&t.icon===n.icon?(dt(o,t),void st(o,t)):t.icon||t.iconHtml?t.icon&&-1===Object.keys(S).indexOf(t.icon)?(i('Unknown icon! Expected "success", "error", "warning", "info" or "question", got "'.concat(t.icon,'"')),de(o)):(ue(o),dt(o,t),st(o,t),void re(o,t.showClass.icon)):de(o)},st=(e,t)=>{for(const n in S)t.icon!==n&&se(e,S[n]);re(e,S[t.icon]),pt(e,t),lt(),ne(e,t,"icon")},lt=()=>{const e=B(),t=window.getComputedStyle(e).getPropertyValue("background-color"),n=e.querySelectorAll("[class^=swal2-success-circular-line], .swal2-success-fix");for(let e=0;e<n.length;e++)n[e].style.backgroundColor=t},ct='\n  <div class="swal2-success-circular-line-left"></div>\n  <span class="swal2-success-line-tip"></span> <span class="swal2-success-line-long"></span>\n  <div class="swal2-success-ring"></div> <div class="swal2-success-fix"></div>\n  <div class="swal2-success-circular-line-right"></div>\n',ut='\n  <span class="swal2-x-mark">\n    <span class="swal2-x-mark-line-left"></span>\n    <span class="swal2-x-mark-line-right"></span>\n  </span>\n',dt=(e,t)=>{e.textContent="",t.iconHtml?Q(e,mt(t.iconHtml)):"success"===t.icon?Q(e,ct):"error"===t.icon?Q(e,ut):Q(e,mt({question:"?",warning:"!",info:"i"}[t.icon]))},pt=(e,t)=>{if(t.iconColor){e.style.color=t.iconColor,e.style.borderColor=t.iconColor;for(const n of[".swal2-success-line-tip",".swal2-success-line-long",".swal2-x-mark-line-left",".swal2-x-mark-line-right"])pe(e,n,"backgroundColor",t.iconColor);pe(e,".swal2-success-ring","borderColor",t.iconColor)}},mt=e=>'<div class="'.concat(E["icon-content"],'">').concat(e,"</div>"),ft=(e,t)=>{const n=z();if(!t.imageUrl)return de(n);ue(n,""),n.setAttribute("src",t.imageUrl),n.setAttribute("alt",t.imageAlt),ce(n,"width",t.imageWidth),ce(n,"height",t.imageHeight),n.className=E.image,ne(n,t,"image")},wt=e=>{const t=document.createElement("li");return re(t,E["progress-step"]),Q(t,e),t},gt=e=>{const t=document.createElement("li");return re(t,E["progress-step-line"]),e.progressStepsDistance&&(t.style.width=e.progressStepsDistance),t},ht=(e,t)=>{const n=N();if(!t.progressSteps||0===t.progressSteps.length)return de(n);ue(n),n.textContent="",t.currentProgressStep>=t.progressSteps.length&&a("Invalid currentProgressStep parameter, it should be less than progressSteps.length (currentProgressStep like JS arrays starts from 0)"),t.progressSteps.forEach(((e,o)=>{const a=wt(e);if(n.appendChild(a),o===t.currentProgressStep&&re(a,E["active-progress-step"]),o!==t.progressSteps.length-1){const e=gt(t);n.appendChild(e)}}))},bt=(e,t)=>{const n=L();me(n,t.title||t.titleText,"block"),t.title&&Le(t.title,n),t.titleText&&(n.innerText=t.titleText),ne(n,t,"title")},yt=(e,t)=>{const n=O(),o=B();t.toast?(ce(n,"width",t.width),o.style.width="100%",o.insertBefore(R(),T())):ce(o,"width",t.width),ce(o,"padding",t.padding),t.color&&(o.style.color=t.color),t.background&&(o.style.background=t.background),de($()),vt(o,t)},vt=(e,t)=>{e.className="".concat(E.popup," ").concat(fe(e)?t.showClass.popup:""),t.toast?(re([document.documentElement,document.body],E["toast-shown"]),re(e,E.toast)):re(e,E.modal),ne(e,t,"popup"),"string"==typeof t.customClass&&re(e,t.customClass),t.icon&&re(e,E["icon-".concat(t.icon)])},xt=(e,t)=>{yt(e,t),We(e,t),ht(e,t),rt(e,t),ft(e,t),bt(e,t),it(e,t),ot(e,t),De(e,t),at(e,t),"function"==typeof t.didRender&&t.didRender(B())},_t=Object.freeze({cancel:"cancel",backdrop:"backdrop",close:"close",esc:"esc",timer:"timer"}),kt=()=>{o(document.body.children).forEach((e=>{e===O()||e.contains(O())||(e.hasAttribute("aria-hidden")&&e.setAttribute("data-previous-aria-hidden",e.getAttribute("aria-hidden")),e.setAttribute("aria-hidden","true"))}))},Ct=()=>{o(document.body.children).forEach((e=>{e.hasAttribute("data-previous-aria-hidden")?(e.setAttribute("aria-hidden",e.getAttribute("data-previous-aria-hidden")),e.removeAttribute("data-previous-aria-hidden")):e.removeAttribute("aria-hidden")}))},At=["swal-title","swal-html","swal-footer"],Et=e=>{const t="string"==typeof e.template?document.querySelector(e.template):e.template;if(!t)return{};const n=t.content;return Lt(n),Object.assign(St(n),Ot(n),Pt(n),jt(n),Bt(n),Tt(n,At))},St=e=>{const t={};return o(e.querySelectorAll("swal-param")).forEach((e=>{Mt(e,["name","value"]);const n=e.getAttribute("name"),o=e.getAttribute("value");"boolean"==typeof m[n]&&"false"===o&&(t[n]=!1),"object"==typeof m[n]&&(t[n]=JSON.parse(o))})),t},Ot=e=>{const t={};return o(e.querySelectorAll("swal-button")).forEach((e=>{Mt(e,["type","color","aria-label"]);const o=e.getAttribute("type");t["".concat(o,"ButtonText")]=e.innerHTML,t["show".concat(n(o),"Button")]=!0,e.hasAttribute("color")&&(t["".concat(o,"ButtonColor")]=e.getAttribute("color")),e.hasAttribute("aria-label")&&(t["".concat(o,"ButtonAriaLabel")]=e.getAttribute("aria-label"))})),t},Pt=e=>{const t={},n=e.querySelector("swal-image");return n&&(Mt(n,["src","width","height","alt"]),n.hasAttribute("src")&&(t.imageUrl=n.getAttribute("src")),n.hasAttribute("width")&&(t.imageWidth=n.getAttribute("width")),n.hasAttribute("height")&&(t.imageHeight=n.getAttribute("height")),n.hasAttribute("alt")&&(t.imageAlt=n.getAttribute("alt"))),t},jt=e=>{const t={},n=e.querySelector("swal-icon");return n&&(Mt(n,["type","color"]),n.hasAttribute("type")&&(t.icon=n.getAttribute("type")),n.hasAttribute("color")&&(t.iconColor=n.getAttribute("color")),t.iconHtml=n.innerHTML),t},Bt=e=>{const t={},n=e.querySelector("swal-input");n&&(Mt(n,["type","label","placeholder","value"]),t.input=n.getAttribute("type")||"text",n.hasAttribute("label")&&(t.inputLabel=n.getAttribute("label")),n.hasAttribute("placeholder")&&(t.inputPlaceholder=n.getAttribute("placeholder")),n.hasAttribute("value")&&(t.inputValue=n.getAttribute("value")));const a=e.querySelectorAll("swal-input-option");return a.length&&(t.inputOptions={},o(a).forEach((e=>{Mt(e,["value"]);const n=e.getAttribute("value"),o=e.innerHTML;t.inputOptions[n]=o}))),t},Tt=(e,t)=>{const n={};for(const o in t){const a=t[o],i=e.querySelector(a);i&&(Mt(i,[]),n[a.replace(/^swal-/,"")]=i.innerHTML.trim())}return n},Lt=e=>{const t=At.concat(["swal-param","swal-button","swal-image","swal-icon","swal-input","swal-input-option"]);o(e.children).forEach((e=>{const n=e.tagName.toLowerCase();-1===t.indexOf(n)&&a("Unrecognized element <".concat(n,">"))}))},Mt=(e,t)=>{o(e.attributes).forEach((n=>{-1===t.indexOf(n.name)&&a(['Unrecognized attribute "'.concat(n.name,'" on <').concat(e.tagName.toLowerCase(),">."),"".concat(t.length?"Allowed attributes are: ".concat(t.join(", ")):"To set the value, use HTML within the element.")])}))};var zt={email:(e,t)=>/^[a-zA-Z0-9.+_-]+@[a-zA-Z0-9.-]+\.[a-zA-Z0-9-]{2,24}$/.test(e)?Promise.resolve():Promise.resolve(t||"Invalid email address"),url:(e,t)=>/^https?:\/\/(www\.)?[-a-zA-Z0-9@:%._+~#=]{1,256}\.[a-z]{2,63}\b([-a-zA-Z0-9@:%_+.~#?&/=]*)$/.test(e)?Promise.resolve():Promise.resolve(t||"Invalid URL")};function Nt(e){e.inputValidator||Object.keys(zt).forEach((t=>{e.input===t&&(e.inputValidator=zt[t])}))}function $t(e){(!e.target||"string"==typeof e.target&&!document.querySelector(e.target)||"string"!=typeof e.target&&!e.target.appendChild)&&(a('Target parameter is not valid, defaulting to "body"'),e.target="body")}function Dt(e){Nt(e),e.showLoaderOnConfirm&&!e.preConfirm&&a("showLoaderOnConfirm is set to true, but preConfirm is not defined.\nshowLoaderOnConfirm should be used together with preConfirm, see usage example:\nhttps://sweetalert2.github.io/#ajax-request"),$t(e),"string"==typeof e.title&&(e.title=e.title.split("\n").join("<br />")),Te(e)}class It{constructor(e,t){this.callback=e,this.remaining=t,this.running=!1,this.start()}start(){return this.running||(this.running=!0,this.started=new Date,this.id=setTimeout(this.callback,this.remaining)),this.remaining}stop(){return this.running&&(this.running=!1,clearTimeout(this.id),this.remaining-=(new Date).getTime()-this.started.getTime()),this.remaining}increase(e){const t=this.running;return t&&this.stop(),this.remaining+=e,t&&this.start(),this.remaining}getTimerLeft(){return this.running&&(this.stop(),this.start()),this.remaining}isRunning(){return this.running}}const qt=()=>{null===G.previousBodyPadding&&document.body.scrollHeight>window.innerHeight&&(G.previousBodyPadding=parseInt(window.getComputedStyle(document.body).getPropertyValue("padding-right")),document.body.style.paddingRight="".concat(G.previousBodyPadding+$e(),"px"))},Rt=()=>{null!==G.previousBodyPadding&&(document.body.style.paddingRight="".concat(G.previousBodyPadding,"px"),G.previousBodyPadding=null)},Vt=()=>{if((/iPad|iPhone|iPod/.test(navigator.userAgent)&&!window.MSStream||"MacIntel"===navigator.platform&&navigator.maxTouchPoints>1)&&!ee(document.body,E.iosfix)){const e=document.body.scrollTop;document.body.style.top="".concat(-1*e,"px"),re(document.body,E.iosfix),Ut(),Ht()}},Ht=()=>{const e=navigator.userAgent,t=!!e.match(/iPad/i)||!!e.match(/iPhone/i),n=!!e.match(/WebKit/i);if(t&&n&&!e.match(/CriOS/i)){const e=44;B().scrollHeight>window.innerHeight-e&&(O().style.paddingBottom="".concat(e,"px"))}},Ut=()=>{const e=O();let t;e.ontouchstart=e=>{t=Wt(e)},e.ontouchmove=e=>{t&&(e.preventDefault(),e.stopPropagation())}},Wt=e=>{const t=e.target,n=O();return!(Ft(e)||Zt(e)||t!==n&&(ge(n)||"INPUT"===t.tagName||"TEXTAREA"===t.tagName||ge(M())&&M().contains(t)))},Ft=e=>e.touches&&e.touches.length&&"stylus"===e.touches[0].touchType,Zt=e=>e.touches&&e.touches.length>1,Yt=()=>{if(ee(document.body,E.iosfix)){const e=parseInt(document.body.style.top,10);se(document.body,E.iosfix),document.body.style.top="",document.body.scrollTop=-1*e}},Kt=10,Xt=e=>{const t=O(),n=B();"function"==typeof e.willOpen&&e.willOpen(n);const o=window.getComputedStyle(document.body).overflowY;en(t,n,e),setTimeout((()=>{Gt(t,n)}),Kt),K()&&(Qt(t,e.scrollbarPadding,o),kt()),X()||_e.previousActiveElement||(_e.previousActiveElement=document.activeElement),"function"==typeof e.didOpen&&setTimeout((()=>e.didOpen(n))),se(t,E["no-transition"])},Jt=e=>{const t=B();if(e.target!==t)return;const n=O();t.removeEventListener(Ne,Jt),n.style.overflowY="auto"},Gt=(e,t)=>{Ne&&he(t)?(e.style.overflowY="hidden",t.addEventListener(Ne,Jt)):e.style.overflowY="auto"},Qt=(e,t,n)=>{Vt(),t&&"hidden"!==n&&qt(),setTimeout((()=>{e.scrollTop=0}))},en=(e,t,n)=>{re(e,n.showClass.backdrop),t.style.setProperty("opacity","0","important"),ue(t,"grid"),setTimeout((()=>{re(t,n.showClass.popup),t.style.removeProperty("opacity")}),Kt),re([document.documentElement,document.body],E.shown),n.heightAuto&&n.backdrop&&!n.toast&&re([document.documentElement,document.body],E["height-auto"])},tn=e=>{let t=B();t||new Zo,t=B();const n=R();X()?de(T()):nn(t,e),ue(n),t.setAttribute("data-loading",!0),t.setAttribute("aria-busy",!0),t.focus()},nn=(e,t)=>{const n=H(),o=R();!t&&fe(D())&&(t=D()),ue(n),t&&(de(t),o.setAttribute("data-button-to-replace",t.className)),o.parentNode.insertBefore(o,t),re([e,n],E.loading)},on=(e,t)=>{"select"===t.input||"radio"===t.input?cn(e,t):["text","email","number","tel","textarea"].includes(t.input)&&(u(t.inputValue)||p(t.inputValue))&&(tn(D()),un(e,t))},an=(e,t)=>{const n=e.getInput();if(!n)return null;switch(t.input){case"checkbox":return rn(n);case"radio":return sn(n);case"file":return ln(n);default:return t.inputAutoTrim?n.value.trim():n.value}},rn=e=>e.checked?1:0,sn=e=>e.checked?e.value:null,ln=e=>e.files.length?null!==e.getAttribute("multiple")?e.files:e.files[0]:null,cn=(e,t)=>{const n=B(),o=e=>dn[t.input](n,pn(e),t);u(t.inputOptions)||p(t.inputOptions)?(tn(D()),d(t.inputOptions).then((t=>{e.hideLoading(),o(t)}))):"object"==typeof t.inputOptions?o(t.inputOptions):i("Unexpected type of inputOptions! Expected object, Map or Promise, got ".concat(typeof t.inputOptions))},un=(e,t)=>{const n=e.getInput();de(n),d(t.inputValue).then((o=>{n.value="number"===t.input?parseFloat(o)||0:"".concat(o),ue(n),n.focus(),e.hideLoading()})).catch((t=>{i("Error in inputValue promise: ".concat(t)),n.value="",ue(n),n.focus(),e.hideLoading()}))},dn={select:(e,t,n)=>{const o=le(e,E.select),a=(e,t,o)=>{const a=document.createElement("option");a.value=o,Q(a,t),a.selected=mn(o,n.inputValue),e.appendChild(a)};t.forEach((e=>{const t=e[0],n=e[1];if(Array.isArray(n)){const e=document.createElement("optgroup");e.label=t,e.disabled=!1,o.appendChild(e),n.forEach((t=>a(e,t[1],t[0])))}else a(o,n,t)})),o.focus()},radio:(e,t,n)=>{const o=le(e,E.radio);t.forEach((e=>{const t=e[0],a=e[1],i=document.createElement("input"),r=document.createElement("label");i.type="radio",i.name=E.radio,i.value=t,mn(t,n.inputValue)&&(i.checked=!0);const s=document.createElement("span");Q(s,a),s.className=E.label,r.appendChild(i),r.appendChild(s),o.appendChild(r)}));const a=o.querySelectorAll("input");a.length&&a[0].focus()}},pn=e=>{const t=[];return"undefined"!=typeof Map&&e instanceof Map?e.forEach(((e,n)=>{let o=e;"object"==typeof o&&(o=pn(o)),t.push([n,o])})):Object.keys(e).forEach((n=>{let o=e[n];"object"==typeof o&&(o=pn(o)),t.push([n,o])})),t},mn=(e,t)=>t&&t.toString()===e.toString();function fn(){const e=Fe.innerParams.get(this);if(!e)return;const t=Fe.domCache.get(this);de(t.loader),X()?e.icon&&ue(T()):wn(t),se([t.popup,t.actions],E.loading),t.popup.removeAttribute("aria-busy"),t.popup.removeAttribute("data-loading"),t.confirmButton.disabled=!1,t.denyButton.disabled=!1,t.cancelButton.disabled=!1}const wn=e=>{const t=e.popup.getElementsByClassName(e.loader.getAttribute("data-button-to-replace"));t.length?ue(t[0],"inline-block"):we()&&de(e.actions)};function gn(e){const t=Fe.innerParams.get(e||this),n=Fe.domCache.get(e||this);return n?oe(n.popup,t.input):null}var hn={swalPromiseResolve:new WeakMap,swalPromiseReject:new WeakMap};const bn=()=>fe(B()),yn=()=>D()&&D().click(),vn=()=>I()&&I().click(),xn=()=>V()&&V().click(),_n=e=>{e.keydownTarget&&e.keydownHandlerAdded&&(e.keydownTarget.removeEventListener("keydown",e.keydownHandler,{capture:e.keydownListenerCapture}),e.keydownHandlerAdded=!1)},kn=(e,t,n,o)=>{_n(t),n.toast||(t.keydownHandler=t=>Sn(e,t,o),t.keydownTarget=n.keydownListenerCapture?window:B(),t.keydownListenerCapture=n.keydownListenerCapture,t.keydownTarget.addEventListener("keydown",t.keydownHandler,{capture:t.keydownListenerCapture}),t.keydownHandlerAdded=!0)},Cn=(e,t,n)=>{const o=Y();if(o.length)return(t+=n)===o.length?t=0:-1===t&&(t=o.length-1),o[t].focus();B().focus()},An=["ArrowRight","ArrowDown"],En=["ArrowLeft","ArrowUp"],Sn=(e,t,n)=>{const o=Fe.innerParams.get(e);o&&(t.isComposing||229===t.keyCode||(o.stopKeydownPropagation&&t.stopPropagation(),"Enter"===t.key?On(e,t,o):"Tab"===t.key?Pn(t,o):[...An,...En].includes(t.key)?jn(t.key):"Escape"===t.key&&Bn(t,o,n)))},On=(e,t,n)=>{if(c(n.allowEnterKey)&&t.target&&e.getInput()&&t.target.outerHTML===e.getInput().outerHTML){if(["textarea","file"].includes(n.input))return;yn(),t.preventDefault()}},Pn=(e,t)=>{const n=e.target,o=Y();let a=-1;for(let e=0;e<o.length;e++)if(n===o[e]){a=e;break}e.shiftKey?Cn(t,a,-1):Cn(t,a,1),e.stopPropagation(),e.preventDefault()},jn=e=>{if(![D(),I(),V()].includes(document.activeElement))return;const t=An.includes(e)?"nextElementSibling":"previousElementSibling";let n=document.activeElement;for(let e=0;e<H().children.length;e++){if(n=n[t],!n)return;if(fe(n)&&n instanceof HTMLButtonElement)break}n instanceof HTMLButtonElement&&n.focus()},Bn=(e,t,n)=>{c(t.allowEscapeKey)&&(e.preventDefault(),n(_t.esc))};function Tn(e,t,n,o){X()?Vn(e,o):(Ce(n).then((()=>Vn(e,o))),_n(_e)),/^((?!chrome|android).)*safari/i.test(navigator.userAgent)?(t.setAttribute("style","display:none !important"),t.removeAttribute("class"),t.innerHTML=""):t.remove(),K()&&(Rt(),Yt(),Ct()),Ln()}function Ln(){se([document.documentElement,document.body],[E.shown,E["height-auto"],E["no-backdrop"],E["toast-shown"]])}function Mn(e){e=In(e);const t=hn.swalPromiseResolve.get(this),n=Nn(this);this.isAwaitingPromise()?e.isDismissed||(Dn(this),t(e)):n&&t(e)}function zn(){return!!Fe.awaitingPromise.get(this)}const Nn=e=>{const t=B();if(!t)return!1;const n=Fe.innerParams.get(e);if(!n||ee(t,n.hideClass.popup))return!1;se(t,n.showClass.popup),re(t,n.hideClass.popup);const o=O();return se(o,n.showClass.backdrop),re(o,n.hideClass.backdrop),qn(e,t,n),!0};function $n(e){const t=hn.swalPromiseReject.get(this);Dn(this),t&&t(e)}const Dn=e=>{e.isAwaitingPromise()&&(Fe.awaitingPromise.delete(e),Fe.innerParams.get(e)||e._destroy())},In=e=>void 0===e?{isConfirmed:!1,isDenied:!1,isDismissed:!0}:Object.assign({isConfirmed:!1,isDenied:!1,isDismissed:!1},e),qn=(e,t,n)=>{const o=O(),a=Ne&&he(t);"function"==typeof n.willClose&&n.willClose(t),a?Rn(e,t,o,n.returnFocus,n.didClose):Tn(e,o,n.returnFocus,n.didClose)},Rn=(e,t,n,o,a)=>{_e.swalCloseEventFinishedCallback=Tn.bind(null,e,n,o,a),t.addEventListener(Ne,(function(e){e.target===t&&(_e.swalCloseEventFinishedCallback(),delete _e.swalCloseEventFinishedCallback)}))},Vn=(e,t)=>{setTimeout((()=>{"function"==typeof t&&t.bind(e.params)(),e._destroy()}))};function Hn(e,t,n){const o=Fe.domCache.get(e);t.forEach((e=>{o[e].disabled=n}))}function Un(e,t){if(!e)return!1;if("radio"===e.type){const n=e.parentNode.parentNode.querySelectorAll("input");for(let e=0;e<n.length;e++)n[e].disabled=t}else e.disabled=t}function Wn(){Hn(this,["confirmButton","denyButton","cancelButton"],!1)}function Fn(){Hn(this,["confirmButton","denyButton","cancelButton"],!0)}function Zn(){return Un(this.getInput(),!1)}function Yn(){return Un(this.getInput(),!0)}function Kn(e){const t=Fe.domCache.get(this),n=Fe.innerParams.get(this);Q(t.validationMessage,e),t.validationMessage.className=E["validation-message"],n.customClass&&n.customClass.validationMessage&&re(t.validationMessage,n.customClass.validationMessage),ue(t.validationMessage);const o=this.getInput();o&&(o.setAttribute("aria-invalid",!0),o.setAttribute("aria-describedby",E["validation-message"]),ae(o),re(o,E.inputerror))}function Xn(){const e=Fe.domCache.get(this);e.validationMessage&&de(e.validationMessage);const t=this.getInput();t&&(t.removeAttribute("aria-invalid"),t.removeAttribute("aria-describedby"),se(t,E.inputerror))}function Jn(){return Fe.domCache.get(this).progressSteps}function Gn(e){const t=B(),n=Fe.innerParams.get(this);if(!t||ee(t,n.hideClass.popup))return a("You're trying to update the closed or closing popup, that won't work. Use the update() method in preConfirm parameter or show a new popup.");const o=Qn(e),i=Object.assign({},n,o);xt(this,i),Fe.innerParams.set(this,i),Object.defineProperties(this,{params:{value:Object.assign({},this.params,e),writable:!1,enumerable:!0}})}const Qn=e=>{const t={};return Object.keys(e).forEach((n=>{b(n)?t[n]=e[n]:a('Invalid parameter to update: "'.concat(n,'". Updatable params are listed here: https://github.com/sweetalert2/sweetalert2/blob/master/src/utils/params.js\n\nIf you think this parameter should be updatable, request it here: https://github.com/sweetalert2/sweetalert2/issues/new?template=02_feature_request.md'))})),t};function eo(){const e=Fe.domCache.get(this),t=Fe.innerParams.get(this);t?(e.popup&&_e.swalCloseEventFinishedCallback&&(_e.swalCloseEventFinishedCallback(),delete _e.swalCloseEventFinishedCallback),_e.deferDisposalTimer&&(clearTimeout(_e.deferDisposalTimer),delete _e.deferDisposalTimer),"function"==typeof t.didDestroy&&t.didDestroy(),to(this)):no(this)}const to=e=>{no(e),delete e.params,delete _e.keydownHandler,delete _e.keydownTarget,delete _e.currentInstance},no=e=>{e.isAwaitingPromise()?(oo(Fe,e),Fe.awaitingPromise.set(e,!0)):(oo(hn,e),oo(Fe,e))},oo=(e,t)=>{for(const n in e)e[n].delete(t)};var ao=Object.freeze({hideLoading:fn,disableLoading:fn,getInput:gn,close:Mn,isAwaitingPromise:zn,rejectPromise:$n,handleAwaitingPromise:Dn,closePopup:Mn,closeModal:Mn,closeToast:Mn,enableButtons:Wn,disableButtons:Fn,enableInput:Zn,disableInput:Yn,showValidationMessage:Kn,resetValidationMessage:Xn,getProgressSteps:Jn,update:Gn,_destroy:eo});const io=e=>{const t=Fe.innerParams.get(e);e.disableButtons(),t.input?lo(e,"confirm"):fo(e,!0)},ro=e=>{const t=Fe.innerParams.get(e);e.disableButtons(),t.returnInputValueOnDeny?lo(e,"deny"):uo(e,!1)},so=(e,t)=>{e.disableButtons(),t(_t.cancel)},lo=(e,t)=>{const o=Fe.innerParams.get(e);if(!o.input)return i('The "input" parameter is needed to be set when using returnInputValueOn'.concat(n(t)));const a=an(e,o);o.inputValidator?co(e,a,t):e.getInput().checkValidity()?"deny"===t?uo(e,a):fo(e,a):(e.enableButtons(),e.showValidationMessage(o.validationMessage))},co=(e,t,n)=>{const o=Fe.innerParams.get(e);e.disableInput(),Promise.resolve().then((()=>d(o.inputValidator(t,o.validationMessage)))).then((o=>{e.enableButtons(),e.enableInput(),o?e.showValidationMessage(o):"deny"===n?uo(e,t):fo(e,t)}))},uo=(e,t)=>{const n=Fe.innerParams.get(e||void 0);n.showLoaderOnDeny&&tn(I()),n.preDeny?(Fe.awaitingPromise.set(e||void 0,!0),Promise.resolve().then((()=>d(n.preDeny(t,n.validationMessage)))).then((n=>{!1===n?(e.hideLoading(),Dn(e)):e.closePopup({isDenied:!0,value:void 0===n?t:n})})).catch((t=>mo(e||void 0,t)))):e.closePopup({isDenied:!0,value:t})},po=(e,t)=>{e.closePopup({isConfirmed:!0,value:t})},mo=(e,t)=>{e.rejectPromise(t)},fo=(e,t)=>{const n=Fe.innerParams.get(e||void 0);n.showLoaderOnConfirm&&tn(),n.preConfirm?(e.resetValidationMessage(),Fe.awaitingPromise.set(e||void 0,!0),Promise.resolve().then((()=>d(n.preConfirm(t,n.validationMessage)))).then((n=>{fe($())||!1===n?(e.hideLoading(),Dn(e)):po(e,void 0===n?t:n)})).catch((t=>mo(e||void 0,t)))):po(e,t)},wo=(e,t,n)=>{Fe.innerParams.get(e).toast?go(e,t,n):(yo(t),vo(t),xo(e,t,n))},go=(e,t,n)=>{t.popup.onclick=()=>{const t=Fe.innerParams.get(e);t&&(ho(t)||t.timer||t.input)||n(_t.close)}},ho=e=>e.showConfirmButton||e.showDenyButton||e.showCancelButton||e.showCloseButton;let bo=!1;const yo=e=>{e.popup.onmousedown=()=>{e.container.onmouseup=function(t){e.container.onmouseup=void 0,t.target===e.container&&(bo=!0)}}},vo=e=>{e.container.onmousedown=()=>{e.popup.onmouseup=function(t){e.popup.onmouseup=void 0,(t.target===e.popup||e.popup.contains(t.target))&&(bo=!0)}}},xo=(e,t,n)=>{t.container.onclick=o=>{const a=Fe.innerParams.get(e);bo?bo=!1:o.target===t.container&&c(a.allowOutsideClick)&&n(_t.backdrop)}},_o=e=>"object"==typeof e&&e.jquery,ko=e=>e instanceof Element||_o(e),Co=e=>{const t={};return"object"!=typeof e[0]||ko(e[0])?["title","html","icon"].forEach(((n,o)=>{const a=e[o];"string"==typeof a||ko(a)?t[n]=a:void 0!==a&&i("Unexpected type of ".concat(n,'! Expected "string" or "Element", got ').concat(typeof a))})):Object.assign(t,e[0]),t};function Ao(){const e=this;for(var t=arguments.length,n=new Array(t),o=0;o<t;o++)n[o]=arguments[o];return new e(...n)}function Eo(e){class t extends(this){_main(t,n){return super._main(t,Object.assign({},e,n))}}return t}const So=()=>_e.timeout&&_e.timeout.getTimerLeft(),Oo=()=>{if(_e.timeout)return ye(),_e.timeout.stop()},Po=()=>{if(_e.timeout){const e=_e.timeout.start();return be(e),e}},jo=()=>{const e=_e.timeout;return e&&(e.running?Oo():Po())},Bo=e=>{if(_e.timeout){const t=_e.timeout.increase(e);return be(t,!0),t}},To=()=>_e.timeout&&_e.timeout.isRunning();let Lo=!1;const Mo={};function zo(){Mo[arguments.length>0&&void 0!==arguments[0]?arguments[0]:"data-swal-template"]=this,Lo||(document.body.addEventListener("click",No),Lo=!0)}const No=e=>{for(let t=e.target;t&&t!==document;t=t.parentNode)for(const e in Mo){const n=t.getAttribute(e);if(n)return void Mo[e].fire({template:n})}};var $o=Object.freeze({isValidParameter:h,isUpdatableParameter:b,isDeprecatedParameter:y,argsToParams:Co,isVisible:bn,clickConfirm:yn,clickDeny:vn,clickCancel:xn,getContainer:O,getPopup:B,getTitle:L,getHtmlContainer:M,getImage:z,getIcon:T,getInputLabel:q,getCloseButton:F,getActions:H,getConfirmButton:D,getDenyButton:I,getCancelButton:V,getLoader:R,getFooter:U,getTimerProgressBar:W,getFocusableElements:Y,getValidationMessage:$,isLoading:J,fire:Ao,mixin:Eo,showLoading:tn,enableLoading:tn,getTimerLeft:So,stopTimer:Oo,resumeTimer:Po,toggleTimer:jo,increaseTimer:Bo,isTimerRunning:To,bindClickHandler:zo});let Do;class Io{constructor(){if("undefined"==typeof window)return;Do=this;for(var e=arguments.length,t=new Array(e),n=0;n<e;n++)t[n]=arguments[n];const o=Object.freeze(this.constructor.argsToParams(t));Object.defineProperties(this,{params:{value:o,writable:!1,enumerable:!0,configurable:!0}});const a=this._main(this.params);Fe.promise.set(this,a)}_main(e){let t=arguments.length>1&&void 0!==arguments[1]?arguments[1]:{};k(Object.assign({},t,e)),_e.currentInstance&&(_e.currentInstance._destroy(),K()&&Ct()),_e.currentInstance=this;const n=Ro(e,t);Dt(n),Object.freeze(n),_e.timeout&&(_e.timeout.stop(),delete _e.timeout),clearTimeout(_e.restoreFocusTimeout);const o=Vo(this);return xt(this,n),Fe.innerParams.set(this,n),qo(this,o,n)}then(e){return Fe.promise.get(this).then(e)}finally(e){return Fe.promise.get(this).finally(e)}}const qo=(e,t,n)=>new Promise(((o,a)=>{const i=t=>{e.closePopup({isDismissed:!0,dismiss:t})};hn.swalPromiseResolve.set(e,o),hn.swalPromiseReject.set(e,a),t.confirmButton.onclick=()=>io(e),t.denyButton.onclick=()=>ro(e),t.cancelButton.onclick=()=>so(e,i),t.closeButton.onclick=()=>i(_t.close),wo(e,t,i),kn(e,_e,n,i),on(e,n),Xt(n),Ho(_e,n,i),Uo(t,n),setTimeout((()=>{t.container.scrollTop=0}))})),Ro=(e,t)=>{const n=Et(e),o=Object.assign({},m,t,n,e);return o.showClass=Object.assign({},m.showClass,o.showClass),o.hideClass=Object.assign({},m.hideClass,o.hideClass),o},Vo=e=>{const t={popup:B(),container:O(),actions:H(),confirmButton:D(),denyButton:I(),cancelButton:V(),loader:R(),closeButton:F(),validationMessage:$(),progressSteps:N()};return Fe.domCache.set(e,t),t},Ho=(e,t,n)=>{const o=W();de(o),t.timer&&(e.timeout=new It((()=>{n("timer"),delete e.timeout}),t.timer),t.timerProgressBar&&(ue(o),ne(o,t,"timerProgressBar"),setTimeout((()=>{e.timeout&&e.timeout.running&&be(t.timer)}))))},Uo=(e,t)=>{if(!t.toast)return c(t.allowEnterKey)?void(Wo(e,t)||Cn(t,-1,1)):Fo()},Wo=(e,t)=>t.focusDeny&&fe(e.denyButton)?(e.denyButton.focus(),!0):t.focusCancel&&fe(e.cancelButton)?(e.cancelButton.focus(),!0):!(!t.focusConfirm||!fe(e.confirmButton)||(e.confirmButton.focus(),0)),Fo=()=>{document.activeElement instanceof HTMLElement&&"function"==typeof document.activeElement.blur&&document.activeElement.blur()};Object.assign(Io.prototype,ao),Object.assign(Io,$o),Object.keys(ao).forEach((e=>{Io[e]=function(){if(Do)return Do[e](...arguments)}})),Io.DismissReason=_t,Io.version="11.4.8";const Zo=Io;return Zo.default=Zo,Zo}(),void 0!==this&&this.Sweetalert2&&(this.swal=this.sweetAlert=this.Swal=this.SweetAlert=this.Sweetalert2),"undefined"!=typeof document&&function(e,t){var n=e.createElement("style");if(e.getElementsByTagName("head")[0].appendChild(n),n.styleSheet)n.styleSheet.disabled||(n.styleSheet.cssText=t);else try{n.innerHTML=t}catch(e){n.innerText=t}}(document,'.swal2-popup.swal2-toast{box-sizing:border-box;grid-column:1/4!important;grid-row:1/4!important;grid-template-columns:1fr 99fr 1fr;padding:1em;overflow-y:hidden;background:#fff;box-shadow:0 0 1px rgba(0,0,0,.075),0 1px 2px rgba(0,0,0,.075),1px 2px 4px rgba(0,0,0,.075),1px 3px 8px rgba(0,0,0,.075),2px 4px 16px rgba(0,0,0,.075);pointer-events:all}.swal2-popup.swal2-toast>*{grid-column:2}.swal2-popup.swal2-toast .swal2-title{margin:.5em 1em;padding:0;font-size:1em;text-align:initial}.swal2-popup.swal2-toast .swal2-loading{justify-content:center}.swal2-popup.swal2-toast .swal2-input{height:2em;margin:.5em;font-size:1em}.swal2-popup.swal2-toast .swal2-validation-message{font-size:1em}.swal2-popup.swal2-toast .swal2-footer{margin:.5em 0 0;padding:.5em 0 0;font-size:.8em}.swal2-popup.swal2-toast .swal2-close{grid-column:3/3;grid-row:1/99;align-self:center;width:.8em;height:.8em;margin:0;font-size:2em}.swal2-popup.swal2-toast .swal2-html-container{margin:.5em 1em;padding:0;font-size:1em;text-align:initial}.swal2-popup.swal2-toast .swal2-html-container:empty{padding:0}.swal2-popup.swal2-toast .swal2-loader{grid-column:1;grid-row:1/99;align-self:center;width:2em;height:2em;margin:.25em}.swal2-popup.swal2-toast .swal2-icon{grid-column:1;grid-row:1/99;align-self:center;width:2em;min-width:2em;height:2em;margin:0 .5em 0 0}.swal2-popup.swal2-toast .swal2-icon .swal2-icon-content{display:flex;align-items:center;font-size:1.8em;font-weight:700}.swal2-popup.swal2-toast .swal2-icon.swal2-success .swal2-success-ring{width:2em;height:2em}.swal2-popup.swal2-toast .swal2-icon.swal2-error [class^=swal2-x-mark-line]{top:.875em;width:1.375em}.swal2-popup.swal2-toast .swal2-icon.swal2-error [class^=swal2-x-mark-line][class$=left]{left:.3125em}.swal2-popup.swal2-toast .swal2-icon.swal2-error [class^=swal2-x-mark-line][class$=right]{right:.3125em}.swal2-popup.swal2-toast .swal2-actions{justify-content:flex-start;height:auto;margin:0;margin-top:.5em;padding:0 .5em}.swal2-popup.swal2-toast .swal2-styled{margin:.25em .5em;padding:.4em .6em;font-size:1em}.swal2-popup.swal2-toast .swal2-success{border-color:#a5dc86}.swal2-popup.swal2-toast .swal2-success [class^=swal2-success-circular-line]{position:absolute;width:1.6em;height:3em;transform:rotate(45deg);border-radius:50%}.swal2-popup.swal2-toast .swal2-success [class^=swal2-success-circular-line][class$=left]{top:-.8em;left:-.5em;transform:rotate(-45deg);transform-origin:2em 2em;border-radius:4em 0 0 4em}.swal2-popup.swal2-toast .swal2-success [class^=swal2-success-circular-line][class$=right]{top:-.25em;left:.9375em;transform-origin:0 1.5em;border-radius:0 4em 4em 0}.swal2-popup.swal2-toast .swal2-success .swal2-success-ring{width:2em;height:2em}.swal2-popup.swal2-toast .swal2-success .swal2-success-fix{top:0;left:.4375em;width:.4375em;height:2.6875em}.swal2-popup.swal2-toast .swal2-success [class^=swal2-success-line]{height:.3125em}.swal2-popup.swal2-toast .swal2-success [class^=swal2-success-line][class$=tip]{top:1.125em;left:.1875em;width:.75em}.swal2-popup.swal2-toast .swal2-success [class^=swal2-success-line][class$=long]{top:.9375em;right:.1875em;width:1.375em}.swal2-popup.swal2-toast .swal2-success.swal2-icon-show .swal2-success-line-tip{-webkit-animation:swal2-toast-animate-success-line-tip .75s;animation:swal2-toast-animate-success-line-tip .75s}.swal2-popup.swal2-toast .swal2-success.swal2-icon-show .swal2-success-line-long{-webkit-animation:swal2-toast-animate-success-line-long .75s;animation:swal2-toast-animate-success-line-long .75s}.swal2-popup.swal2-toast.swal2-show{-webkit-animation:swal2-toast-show .5s;animation:swal2-toast-show .5s}.swal2-popup.swal2-toast.swal2-hide{-webkit-animation:swal2-toast-hide .1s forwards;animation:swal2-toast-hide .1s forwards}.swal2-container{display:grid;position:fixed;z-index:1060;top:0;right:0;bottom:0;left:0;box-sizing:border-box;grid-template-areas:"top-start     top            top-end" "center-start  center         center-end" "bottom-start  bottom-center  bottom-end";grid-template-rows:minmax(-webkit-min-content,auto) minmax(-webkit-min-content,auto) minmax(-webkit-min-content,auto);grid-template-rows:minmax(min-content,auto) minmax(min-content,auto) minmax(min-content,auto);height:100%;padding:.625em;overflow-x:hidden;transition:background-color .1s;-webkit-overflow-scrolling:touch}.swal2-container.swal2-backdrop-show,.swal2-container.swal2-noanimation{background:rgba(0,0,0,.4)}.swal2-container.swal2-backdrop-hide{background:0 0!important}.swal2-container.swal2-bottom-start,.swal2-container.swal2-center-start,.swal2-container.swal2-top-start{grid-template-columns:minmax(0,1fr) auto auto}.swal2-container.swal2-bottom,.swal2-container.swal2-center,.swal2-container.swal2-top{grid-template-columns:auto minmax(0,1fr) auto}.swal2-container.swal2-bottom-end,.swal2-container.swal2-center-end,.swal2-container.swal2-top-end{grid-template-columns:auto auto minmax(0,1fr)}.swal2-container.swal2-top-start>.swal2-popup{align-self:start}.swal2-container.swal2-top>.swal2-popup{grid-column:2;align-self:start;justify-self:center}.swal2-container.swal2-top-end>.swal2-popup,.swal2-container.swal2-top-right>.swal2-popup{grid-column:3;align-self:start;justify-self:end}.swal2-container.swal2-center-left>.swal2-popup,.swal2-container.swal2-center-start>.swal2-popup{grid-row:2;align-self:center}.swal2-container.swal2-center>.swal2-popup{grid-column:2;grid-row:2;align-self:center;justify-self:center}.swal2-container.swal2-center-end>.swal2-popup,.swal2-container.swal2-center-right>.swal2-popup{grid-column:3;grid-row:2;align-self:center;justify-self:end}.swal2-container.swal2-bottom-left>.swal2-popup,.swal2-container.swal2-bottom-start>.swal2-popup{grid-column:1;grid-row:3;align-self:end}.swal2-container.swal2-bottom>.swal2-popup{grid-column:2;grid-row:3;justify-self:center;align-self:end}.swal2-container.swal2-bottom-end>.swal2-popup,.swal2-container.swal2-bottom-right>.swal2-popup{grid-column:3;grid-row:3;align-self:end;justify-self:end}.swal2-container.swal2-grow-fullscreen>.swal2-popup,.swal2-container.swal2-grow-row>.swal2-popup{grid-column:1/4;width:100%}.swal2-container.swal2-grow-column>.swal2-popup,.swal2-container.swal2-grow-fullscreen>.swal2-popup{grid-row:1/4;align-self:stretch}.swal2-container.swal2-no-transition{transition:none!important}.swal2-popup{display:none;position:relative;box-sizing:border-box;grid-template-columns:minmax(0,100%);width:32em;max-width:100%;padding:0 0 1.25em;border:none;border-radius:5px;background:#fff;color:#545454;font-family:inherit;font-size:1rem}.swal2-popup:focus{outline:0}.swal2-popup.swal2-loading{overflow-y:hidden}.swal2-title{position:relative;max-width:100%;margin:0;padding:.8em 1em 0;color:inherit;font-size:1.875em;font-weight:600;text-align:center;text-transform:none;word-wrap:break-word}.swal2-actions{display:flex;z-index:1;box-sizing:border-box;flex-wrap:wrap;align-items:center;justify-content:center;width:auto;margin:1.25em auto 0;padding:0}.swal2-actions:not(.swal2-loading) .swal2-styled[disabled]{opacity:.4}.swal2-actions:not(.swal2-loading) .swal2-styled:hover{background-image:linear-gradient(rgba(0,0,0,.1),rgba(0,0,0,.1))}.swal2-actions:not(.swal2-loading) .swal2-styled:active{background-image:linear-gradient(rgba(0,0,0,.2),rgba(0,0,0,.2))}.swal2-loader{display:none;align-items:center;justify-content:center;width:2.2em;height:2.2em;margin:0 1.875em;-webkit-animation:swal2-rotate-loading 1.5s linear 0s infinite normal;animation:swal2-rotate-loading 1.5s linear 0s infinite normal;border-width:.25em;border-style:solid;border-radius:100%;border-color:#2778c4 transparent #2778c4 transparent}.swal2-styled{margin:.3125em;padding:.625em 1.1em;transition:box-shadow .1s;box-shadow:0 0 0 3px transparent;font-weight:500}.swal2-styled:not([disabled]){cursor:pointer}.swal2-styled.swal2-confirm{border:0;border-radius:.25em;background:initial;background-color:#7066e0;color:#fff;font-size:1em}.swal2-styled.swal2-confirm:focus{box-shadow:0 0 0 3px rgba(112,102,224,.5)}.swal2-styled.swal2-deny{border:0;border-radius:.25em;background:initial;background-color:#dc3741;color:#fff;font-size:1em}.swal2-styled.swal2-deny:focus{box-shadow:0 0 0 3px rgba(220,55,65,.5)}.swal2-styled.swal2-cancel{border:0;border-radius:.25em;background:initial;background-color:#6e7881;color:#fff;font-size:1em}.swal2-styled.swal2-cancel:focus{box-shadow:0 0 0 3px rgba(110,120,129,.5)}.swal2-styled.swal2-default-outline:focus{box-shadow:0 0 0 3px rgba(100,150,200,.5)}.swal2-styled:focus{outline:0}.swal2-styled::-moz-focus-inner{border:0}.swal2-footer{justify-content:center;margin:1em 0 0;padding:1em 1em 0;border-top:1px solid #eee;color:inherit;font-size:1em}.swal2-timer-progress-bar-container{position:absolute;right:0;bottom:0;left:0;grid-column:auto!important;overflow:hidden;border-bottom-right-radius:5px;border-bottom-left-radius:5px}.swal2-timer-progress-bar{width:100%;height:.25em;background:rgba(0,0,0,.2)}.swal2-image{max-width:100%;margin:2em auto 1em}.swal2-close{z-index:2;align-items:center;justify-content:center;width:1.2em;height:1.2em;margin-top:0;margin-right:0;margin-bottom:-1.2em;padding:0;overflow:hidden;transition:color .1s,box-shadow .1s;border:none;border-radius:5px;background:0 0;color:#ccc;font-family:serif;font-family:monospace;font-size:2.5em;cursor:pointer;justify-self:end}.swal2-close:hover{transform:none;background:0 0;color:#f27474}.swal2-close:focus{outline:0;box-shadow:inset 0 0 0 3px rgba(100,150,200,.5)}.swal2-close::-moz-focus-inner{border:0}.swal2-html-container{z-index:1;justify-content:center;margin:1em 1.6em .3em;padding:0;overflow:auto;color:inherit;font-size:1.125em;font-weight:400;line-height:normal;text-align:center;word-wrap:break-word;word-break:break-word}.swal2-checkbox,.swal2-file,.swal2-input,.swal2-radio,.swal2-select,.swal2-textarea{margin:1em 2em 3px}.swal2-file,.swal2-input,.swal2-textarea{box-sizing:border-box;width:auto;transition:border-color .1s,box-shadow .1s;border:1px solid #d9d9d9;border-radius:.1875em;background:inherit;box-shadow:inset 0 1px 1px rgba(0,0,0,.06),0 0 0 3px transparent;color:inherit;font-size:1.125em}.swal2-file.swal2-inputerror,.swal2-input.swal2-inputerror,.swal2-textarea.swal2-inputerror{border-color:#f27474!important;box-shadow:0 0 2px #f27474!important}.swal2-file:focus,.swal2-input:focus,.swal2-textarea:focus{border:1px solid #b4dbed;outline:0;box-shadow:inset 0 1px 1px rgba(0,0,0,.06),0 0 0 3px rgba(100,150,200,.5)}.swal2-file::-moz-placeholder,.swal2-input::-moz-placeholder,.swal2-textarea::-moz-placeholder{color:#ccc}.swal2-file:-ms-input-placeholder,.swal2-input:-ms-input-placeholder,.swal2-textarea:-ms-input-placeholder{color:#ccc}.swal2-file::placeholder,.swal2-input::placeholder,.swal2-textarea::placeholder{color:#ccc}.swal2-range{margin:1em 2em 3px;background:#fff}.swal2-range input{width:80%}.swal2-range output{width:20%;color:inherit;font-weight:600;text-align:center}.swal2-range input,.swal2-range output{height:2.625em;padding:0;font-size:1.125em;line-height:2.625em}.swal2-input{height:2.625em;padding:0 .75em}.swal2-file{width:75%;margin-right:auto;margin-left:auto;background:inherit;font-size:1.125em}.swal2-textarea{height:6.75em;padding:.75em}.swal2-select{min-width:50%;max-width:100%;padding:.375em .625em;background:inherit;color:inherit;font-size:1.125em}.swal2-checkbox,.swal2-radio{align-items:center;justify-content:center;background:#fff;color:inherit}.swal2-checkbox label,.swal2-radio label{margin:0 .6em;font-size:1.125em}.swal2-checkbox input,.swal2-radio input{flex-shrink:0;margin:0 .4em}.swal2-input-label{display:flex;justify-content:center;margin:1em auto 0}.swal2-validation-message{align-items:center;justify-content:center;margin:1em 0 0;padding:.625em;overflow:hidden;background:#f0f0f0;color:#666;font-size:1em;font-weight:300}.swal2-validation-message::before{content:"!";display:inline-block;width:1.5em;min-width:1.5em;height:1.5em;margin:0 .625em;border-radius:50%;background-color:#f27474;color:#fff;font-weight:600;line-height:1.5em;text-align:center}.swal2-icon{position:relative;box-sizing:content-box;justify-content:center;width:5em;height:5em;margin:2.5em auto .6em;border:.25em solid transparent;border-radius:50%;border-color:#000;font-family:inherit;line-height:5em;cursor:default;-webkit-user-select:none;-moz-user-select:none;-ms-user-select:none;user-select:none}.swal2-icon .swal2-icon-content{display:flex;align-items:center;font-size:3.75em}.swal2-icon.swal2-error{border-color:#f27474;color:#f27474}.swal2-icon.swal2-error .swal2-x-mark{position:relative;flex-grow:1}.swal2-icon.swal2-error [class^=swal2-x-mark-line]{display:block;position:absolute;top:2.3125em;width:2.9375em;height:.3125em;border-radius:.125em;background-color:#f27474}.swal2-icon.swal2-error [class^=swal2-x-mark-line][class$=left]{left:1.0625em;transform:rotate(45deg)}.swal2-icon.swal2-error [class^=swal2-x-mark-line][class$=right]{right:1em;transform:rotate(-45deg)}.swal2-icon.swal2-error.swal2-icon-show{-webkit-animation:swal2-animate-error-icon .5s;animation:swal2-animate-error-icon .5s}.swal2-icon.swal2-error.swal2-icon-show .swal2-x-mark{-webkit-animation:swal2-animate-error-x-mark .5s;animation:swal2-animate-error-x-mark .5s}.swal2-icon.swal2-warning{border-color:#facea8;color:#f8bb86}.swal2-icon.swal2-warning.swal2-icon-show{-webkit-animation:swal2-animate-error-icon .5s;animation:swal2-animate-error-icon .5s}.swal2-icon.swal2-warning.swal2-icon-show .swal2-icon-content{-webkit-animation:swal2-animate-i-mark .5s;animation:swal2-animate-i-mark .5s}.swal2-icon.swal2-info{border-color:#9de0f6;color:#3fc3ee}.swal2-icon.swal2-info.swal2-icon-show{-webkit-animation:swal2-animate-error-icon .5s;animation:swal2-animate-error-icon .5s}.swal2-icon.swal2-info.swal2-icon-show .swal2-icon-content{-webkit-animation:swal2-animate-i-mark .8s;animation:swal2-animate-i-mark .8s}.swal2-icon.swal2-question{border-color:#c9dae1;color:#87adbd}.swal2-icon.swal2-question.swal2-icon-show{-webkit-animation:swal2-animate-error-icon .5s;animation:swal2-animate-error-icon .5s}.swal2-icon.swal2-question.swal2-icon-show .swal2-icon-content{-webkit-animation:swal2-animate-question-mark .8s;animation:swal2-animate-question-mark .8s}.swal2-icon.swal2-success{border-color:#a5dc86;color:#a5dc86}.swal2-icon.swal2-success [class^=swal2-success-circular-line]{position:absolute;width:3.75em;height:7.5em;transform:rotate(45deg);border-radius:50%}.swal2-icon.swal2-success [class^=swal2-success-circular-line][class$=left]{top:-.4375em;left:-2.0635em;transform:rotate(-45deg);transform-origin:3.75em 3.75em;border-radius:7.5em 0 0 7.5em}.swal2-icon.swal2-success [class^=swal2-success-circular-line][class$=right]{top:-.6875em;left:1.875em;transform:rotate(-45deg);transform-origin:0 3.75em;border-radius:0 7.5em 7.5em 0}.swal2-icon.swal2-success .swal2-success-ring{position:absolute;z-index:2;top:-.25em;left:-.25em;box-sizing:content-box;width:100%;height:100%;border:.25em solid rgba(165,220,134,.3);border-radius:50%}.swal2-icon.swal2-success .swal2-success-fix{position:absolute;z-index:1;top:.5em;left:1.625em;width:.4375em;height:5.625em;transform:rotate(-45deg)}.swal2-icon.swal2-success [class^=swal2-success-line]{display:block;position:absolute;z-index:2;height:.3125em;border-radius:.125em;background-color:#a5dc86}.swal2-icon.swal2-success [class^=swal2-success-line][class$=tip]{top:2.875em;left:.8125em;width:1.5625em;transform:rotate(45deg)}.swal2-icon.swal2-success [class^=swal2-success-line][class$=long]{top:2.375em;right:.5em;width:2.9375em;transform:rotate(-45deg)}.swal2-icon.swal2-success.swal2-icon-show .swal2-success-line-tip{-webkit-animation:swal2-animate-success-line-tip .75s;animation:swal2-animate-success-line-tip .75s}.swal2-icon.swal2-success.swal2-icon-show .swal2-success-line-long{-webkit-animation:swal2-animate-success-line-long .75s;animation:swal2-animate-success-line-long .75s}.swal2-icon.swal2-success.swal2-icon-show .swal2-success-circular-line-right{-webkit-animation:swal2-rotate-success-circular-line 4.25s ease-in;animation:swal2-rotate-success-circular-line 4.25s ease-in}.swal2-progress-steps{flex-wrap:wrap;align-items:center;max-width:100%;margin:1.25em auto;padding:0;background:inherit;font-weight:600}.swal2-progress-steps li{display:inline-block;position:relative}.swal2-progress-steps .swal2-progress-step{z-index:20;flex-shrink:0;width:2em;height:2em;border-radius:2em;background:#2778c4;color:#fff;line-height:2em;text-align:center}.swal2-progress-steps .swal2-progress-step.swal2-active-progress-step{background:#2778c4}.swal2-progress-steps .swal2-progress-step.swal2-active-progress-step~.swal2-progress-step{background:#add8e6;color:#fff}.swal2-progress-steps .swal2-progress-step.swal2-active-progress-step~.swal2-progress-step-line{background:#add8e6}.swal2-progress-steps .swal2-progress-step-line{z-index:10;flex-shrink:0;width:2.5em;height:.4em;margin:0 -1px;background:#2778c4}[class^=swal2]{-webkit-tap-highlight-color:transparent}.swal2-show{-webkit-animation:swal2-show .3s;animation:swal2-show .3s}.swal2-hide{-webkit-animation:swal2-hide .15s forwards;animation:swal2-hide .15s forwards}.swal2-noanimation{transition:none}.swal2-scrollbar-measure{position:absolute;top:-9999px;width:50px;height:50px;overflow:scroll}.swal2-rtl .swal2-close{margin-right:initial;margin-left:0}.swal2-rtl .swal2-timer-progress-bar{right:0;left:auto}@-webkit-keyframes swal2-toast-show{0%{transform:translateY(-.625em) rotateZ(2deg)}33%{transform:translateY(0) rotateZ(-2deg)}66%{transform:translateY(.3125em) rotateZ(2deg)}100%{transform:translateY(0) rotateZ(0)}}@keyframes swal2-toast-show{0%{transform:translateY(-.625em) rotateZ(2deg)}33%{transform:translateY(0) rotateZ(-2deg)}66%{transform:translateY(.3125em) rotateZ(2deg)}100%{transform:translateY(0) rotateZ(0)}}@-webkit-keyframes swal2-toast-hide{100%{transform:rotateZ(1deg);opacity:0}}@keyframes swal2-toast-hide{100%{transform:rotateZ(1deg);opacity:0}}@-webkit-keyframes swal2-toast-animate-success-line-tip{0%{top:.5625em;left:.0625em;width:0}54%{top:.125em;left:.125em;width:0}70%{top:.625em;left:-.25em;width:1.625em}84%{top:1.0625em;left:.75em;width:.5em}100%{top:1.125em;left:.1875em;width:.75em}}@keyframes swal2-toast-animate-success-line-tip{0%{top:.5625em;left:.0625em;width:0}54%{top:.125em;left:.125em;width:0}70%{top:.625em;left:-.25em;width:1.625em}84%{top:1.0625em;left:.75em;width:.5em}100%{top:1.125em;left:.1875em;width:.75em}}@-webkit-keyframes swal2-toast-animate-success-line-long{0%{top:1.625em;right:1.375em;width:0}65%{top:1.25em;right:.9375em;width:0}84%{top:.9375em;right:0;width:1.125em}100%{top:.9375em;right:.1875em;width:1.375em}}@keyframes swal2-toast-animate-success-line-long{0%{top:1.625em;right:1.375em;width:0}65%{top:1.25em;right:.9375em;width:0}84%{top:.9375em;right:0;width:1.125em}100%{top:.9375em;right:.1875em;width:1.375em}}@-webkit-keyframes swal2-show{0%{transform:scale(.7)}45%{transform:scale(1.05)}80%{transform:scale(.95)}100%{transform:scale(1)}}@keyframes swal2-show{0%{transform:scale(.7)}45%{transform:scale(1.05)}80%{transform:scale(.95)}100%{transform:scale(1)}}@-webkit-keyframes swal2-hide{0%{transform:scale(1);opacity:1}100%{transform:scale(.5);opacity:0}}@keyframes swal2-hide{0%{transform:scale(1);opacity:1}100%{transform:scale(.5);opacity:0}}@-webkit-keyframes swal2-animate-success-line-tip{0%{top:1.1875em;left:.0625em;width:0}54%{top:1.0625em;left:.125em;width:0}70%{top:2.1875em;left:-.375em;width:3.125em}84%{top:3em;left:1.3125em;width:1.0625em}100%{top:2.8125em;left:.8125em;width:1.5625em}}@keyframes swal2-animate-success-line-tip{0%{top:1.1875em;left:.0625em;width:0}54%{top:1.0625em;left:.125em;width:0}70%{top:2.1875em;left:-.375em;width:3.125em}84%{top:3em;left:1.3125em;width:1.0625em}100%{top:2.8125em;left:.8125em;width:1.5625em}}@-webkit-keyframes swal2-animate-success-line-long{0%{top:3.375em;right:2.875em;width:0}65%{top:3.375em;right:2.875em;width:0}84%{top:2.1875em;right:0;width:3.4375em}100%{top:2.375em;right:.5em;width:2.9375em}}@keyframes swal2-animate-success-line-long{0%{top:3.375em;right:2.875em;width:0}65%{top:3.375em;right:2.875em;width:0}84%{top:2.1875em;right:0;width:3.4375em}100%{top:2.375em;right:.5em;width:2.9375em}}@-webkit-keyframes swal2-rotate-success-circular-line{0%{transform:rotate(-45deg)}5%{transform:rotate(-45deg)}12%{transform:rotate(-405deg)}100%{transform:rotate(-405deg)}}@keyframes swal2-rotate-success-circular-line{0%{transform:rotate(-45deg)}5%{transform:rotate(-45deg)}12%{transform:rotate(-405deg)}100%{transform:rotate(-405deg)}}@-webkit-keyframes swal2-animate-error-x-mark{0%{margin-top:1.625em;transform:scale(.4);opacity:0}50%{margin-top:1.625em;transform:scale(.4);opacity:0}80%{margin-top:-.375em;transform:scale(1.15)}100%{margin-top:0;transform:scale(1);opacity:1}}@keyframes swal2-animate-error-x-mark{0%{margin-top:1.625em;transform:scale(.4);opacity:0}50%{margin-top:1.625em;transform:scale(.4);opacity:0}80%{margin-top:-.375em;transform:scale(1.15)}100%{margin-top:0;transform:scale(1);opacity:1}}@-webkit-keyframes swal2-animate-error-icon{0%{transform:rotateX(100deg);opacity:0}100%{transform:rotateX(0);opacity:1}}@keyframes swal2-animate-error-icon{0%{transform:rotateX(100deg);opacity:0}100%{transform:rotateX(0);opacity:1}}@-webkit-keyframes swal2-rotate-loading{0%{transform:rotate(0)}100%{transform:rotate(360deg)}}@keyframes swal2-rotate-loading{0%{transform:rotate(0)}100%{transform:rotate(360deg)}}@-webkit-keyframes swal2-animate-question-mark{0%{transform:rotateY(-360deg)}100%{transform:rotateY(0)}}@keyframes swal2-animate-question-mark{0%{transform:rotateY(-360deg)}100%{transform:rotateY(0)}}@-webkit-keyframes swal2-animate-i-mark{0%{transform:rotateZ(45deg);opacity:0}25%{transform:rotateZ(-25deg);opacity:.4}50%{transform:rotateZ(15deg);opacity:.8}75%{transform:rotateZ(-5deg);opacity:1}100%{transform:rotateX(0);opacity:1}}@keyframes swal2-animate-i-mark{0%{transform:rotateZ(45deg);opacity:0}25%{transform:rotateZ(-25deg);opacity:.4}50%{transform:rotateZ(15deg);opacity:.8}75%{transform:rotateZ(-5deg);opacity:1}100%{transform:rotateX(0);opacity:1}}body.swal2-shown:not(.swal2-no-backdrop):not(.swal2-toast-shown){overflow:hidden}body.swal2-height-auto{height:auto!important}body.swal2-no-backdrop .swal2-container{background-color:transparent!important;pointer-events:none}body.swal2-no-backdrop .swal2-container .swal2-popup{pointer-events:all}body.swal2-no-backdrop .swal2-container .swal2-modal{box-shadow:0 0 10px rgba(0,0,0,.4)}@media print{body.swal2-shown:not(.swal2-no-backdrop):not(.swal2-toast-shown){overflow-y:scroll!important}body.swal2-shown:not(.swal2-no-backdrop):not(.swal2-toast-shown)>[aria-hidden=true]{display:none}body.swal2-shown:not(.swal2-no-backdrop):not(.swal2-toast-shown) .swal2-container{position:static!important}}body.swal2-toast-shown .swal2-container{box-sizing:border-box;width:360px;max-width:100%;background-color:transparent;pointer-events:none}body.swal2-toast-shown .swal2-container.swal2-top{top:0;right:auto;bottom:auto;left:50%;transform:translateX(-50%)}body.swal2-toast-shown .swal2-container.swal2-top-end,body.swal2-toast-shown .swal2-container.swal2-top-right{top:0;right:0;bottom:auto;left:auto}body.swal2-toast-shown .swal2-container.swal2-top-left,body.swal2-toast-shown .swal2-container.swal2-top-start{top:0;right:auto;bottom:auto;left:0}body.swal2-toast-shown .swal2-container.swal2-center-left,body.swal2-toast-shown .swal2-container.swal2-center-start{top:50%;right:auto;bottom:auto;left:0;transform:translateY(-50%)}body.swal2-toast-shown .swal2-container.swal2-center{top:50%;right:auto;bottom:auto;left:50%;transform:translate(-50%,-50%)}body.swal2-toast-shown .swal2-container.swal2-center-end,body.swal2-toast-shown .swal2-container.swal2-center-right{top:50%;right:0;bottom:auto;left:auto;transform:translateY(-50%)}body.swal2-toast-shown .swal2-container.swal2-bottom-left,body.swal2-toast-shown .swal2-container.swal2-bottom-start{top:auto;right:auto;bottom:0;left:0}body.swal2-toast-shown .swal2-container.swal2-bottom{top:auto;right:auto;bottom:0;left:50%;transform:translateX(-50%)}body.swal2-toast-shown .swal2-container.swal2-bottom-end,body.swal2-toast-shown .swal2-container.swal2-bottom-right{top:auto;right:0;bottom:0;left:auto}')},723:function(e,t,n){var o,a;void 0===(a="function"==typeof(o=function(){var e="9",t="A",n="S",o=[9,16,17,18,36,37,38,39,40,91,92,93],a=function(e){for(var t=0,n=o.length;t<n;t++)if(e==o[t])return!1;return!0},i=function(e){return(e={delimiter:(e=e||{}).delimiter||".",lastOutput:e.lastOutput,precision:e.hasOwnProperty("precision")?e.precision:2,separator:e.separator||",",showSignal:e.showSignal,suffixUnit:e.suffixUnit&&" "+e.suffixUnit.replace(/[\s]/g,"")||"",unit:e.unit&&e.unit.replace(/[\s]/g,"")+" "||"",zeroCents:e.zeroCents}).moneyPrecision=e.zeroCents?0:e.precision,e},r=function(o,a,i){for(;a<o.length;a++)o[a]!==e&&o[a]!==t&&o[a]!==n||(o[a]=i);return o},s=function(e){this.elements=e};s.prototype.unbindElementToMask=function(){for(var e=0,t=this.elements.length;e<t;e++)this.elements[e].lastOutput="",this.elements[e].onkeyup=!1,this.elements[e].onkeydown=!1,this.elements[e].value.length&&(this.elements[e].value=this.elements[e].value.replace(/\D/g,""))},s.prototype.bindElementToMask=function(e){for(var t=this,n=function(n){var o=(n=n||window.event).target||n.srcElement;a(n.keyCode)&&setTimeout((function(){t.opts.lastOutput=o.lastOutput,o.value=l[e](o.value,t.opts),o.lastOutput=o.value,o.setSelectionRange&&t.opts.suffixUnit&&o.setSelectionRange(o.value.length,o.value.length-t.opts.suffixUnit.length)}),0)},o=0,i=this.elements.length;o<i;o++)this.elements[o].lastOutput="",this.elements[o].onkeyup=n,this.elements[o].value.length&&(this.elements[o].value=l[e](this.elements[o].value,this.opts))},s.prototype.maskMoney=function(e){this.opts=i(e),this.bindElementToMask("toMoney")},s.prototype.maskNumber=function(){this.opts={},this.bindElementToMask("toNumber")},s.prototype.maskAlphaNum=function(){this.opts={},this.bindElementToMask("toAlphaNumeric")},s.prototype.maskPattern=function(e){this.opts={pattern:e},this.bindElementToMask("toPattern")},s.prototype.unMask=function(){this.unbindElementToMask()};var l=function(e){if(!e)throw new Error("VanillaMasker: There is no element to bind.");var t="length"in e?e.length?e:[]:[e];return new s(t)};return l.toMoney=function(e,t){if((t=i(t)).zeroCents){t.lastOutput=t.lastOutput||"";var n="("+t.separator+"[0]{0,"+t.precision+"})",o=new RegExp(n,"g"),a=e.toString().replace(/[\D]/g,"").length||0,r=t.lastOutput.toString().replace(/[\D]/g,"").length||0;e=e.toString().replace(o,""),a<r&&(e=e.slice(0,e.length-1))}for(var s=e.toString().replace(/[\D]/g,""),l=new RegExp("^(0|\\"+t.delimiter+")"),c=new RegExp("(\\"+t.separator+")$"),u=s.substr(0,s.length-t.moneyPrecision),d=u.substr(0,u.length%3),p=new Array(t.precision+1).join("0"),m=0,f=(u=u.substr(u.length%3,u.length)).length;m<f;m++)m%3==0&&(d+=t.delimiter),d+=u[m];d=(d=d.replace(l,"")).length?d:"0";var w="";if(!0===t.showSignal&&(w=e<0||e.startsWith&&e.startsWith("-")?"-":""),!t.zeroCents){var g=s.length-t.precision,h=s.substr(g,t.precision),b=h.length,y=t.precision>b?t.precision:b;p=(p+h).slice(-y)}return(t.unit+w+d+t.separator+p).replace(c,"")+t.suffixUnit},l.toPattern=function(o,a){var i,s="object"==typeof a?a.pattern:a,l=s.replace(/\W/g,""),c=s.split(""),u=o.toString().replace(/\W/g,""),d=u.replace(/\W/g,""),p=0,m=c.length,f="object"==typeof a?a.placeholder:void 0;for(i=0;i<m;i++){if(p>=u.length){if(l.length==d.length)return c.join("");if(void 0!==f&&l.length>d.length)return r(c,i,f).join("");break}if(c[i]===e&&u[p].match(/[0-9]/)||c[i]===t&&u[p].match(/[a-zA-Z]/)||c[i]===n&&u[p].match(/[0-9a-zA-Z]/))c[i]=u[p++];else if(c[i]===e||c[i]===t||c[i]===n)return void 0!==f?r(c,i,f).join(""):c.slice(0,i).join("")}return c.join("").substr(0,i)},l.toNumber=function(e){return e.toString().replace(/(?!^-)[^0-9]/g,"")},l.toAlphaNumeric=function(e){return e.toString().replace(/[^a-z0-9 ]+/i,"")},l})?o.call(t,n,t,e):o)||(e.exports=a)}},t={};function n(o){var a=t[o];if(void 0!==a)return a.exports;var i=t[o]={exports:{}};return e[o].call(i.exports,i,i.exports,n),i.exports}n.n=e=>{var t=e&&e.__esModule?()=>e.default:()=>e;return n.d(t,{a:t}),t},n.d=(e,t)=>{for(var o in t)n.o(t,o)&&!n.o(e,o)&&Object.defineProperty(e,o,{enumerable:!0,get:t[o]})},n.o=(e,t)=>Object.prototype.hasOwnProperty.call(e,t),n.r=e=>{"undefined"!=typeof Symbol&&Symbol.toStringTag&&Object.defineProperty(e,Symbol.toStringTag,{value:"Module"}),Object.defineProperty(e,"__esModule",{value:!0})},n(586)})();                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                       walClasses['no-backdrop'], swalClasses['toast-shown'], swalClasses['has-column']]);
    return true;
  };

  const resetValidationMessage = () => {
    globalState.currentInstance.resetValidationMessage();
  };

  const addInputChangeListeners = () => {
    const popup = getPopup();
    const input = getDirectChildByClass(popup, swalClasses.input);
    const file = getDirectChildByClass(popup, swalClasses.file);
    /** @type {HTMLInputElement} */

    const range = popup.querySelector(".".concat(swalClasses.range, " input"));
    /** @type {HTMLOutputElement} */

    const rangeOutput = popup.querySelector(".".concat(swalClasses.range, " output"));
    const select = getDirectChildByClass(popup, swalClasses.select);
    /** @type {HTMLInputElement} */

    const checkbox = popup.querySelector(".".concat(swalClasses.checkbox, " input"));
    const textarea = getDirectChildByClass(popup, swalClasses.textarea);
    input.oninput = resetValidationMessage;
    file.onchange = resetValidationMessage;
    select.onchange = resetValidationMessage;
    checkbox.onchange = resetValidationMessage;
    textarea.oninput = resetValidationMessage;

    range.oninput = () => {
      resetValidationMessage();
      rangeOutput.value = range.value;
    };

    range.onchange = () => {
      resetValidationMessage();
      rangeOutput.value = range.value;
    };
  };
  /**
   * @param {string | HTMLElement} target
   * @returns {HTMLElement}
   */


  const getTarget = target => typeof target === 'string' ? document.querySelector(target) : target;
  /**
   * @param {SweetAlertOptions} params
   */


  const setupAccessibility = params => {
    const popup = getPopup();
    popup.setAttribute('role', params.toast ? 'alert' : 'dialog');
    popup.setAttribute('aria-live', params.toast ? 'polite' : 'assertive');

    if (!params.toast) {
      popup.setAttribute('aria-modal', 'true');
    }
  };
  /**
   * @param {HTMLElement} targetElement
   */


  const setupRTL = targetElement => {
    if (window.getComputedStyle(targetElement).direction === 'rtl') {
      addClass(getContainer(), swalClasses.rtl);
    }
  };
  /**
   * Add modal + backdrop + no-war message for Russians to DOM
   *
   * @param {SweetAlertOptions} params
   */


  const init = params => {
    // Clean up the old popup container if it exists
    const oldContainerExisted = resetOldContainer();
    /* istanbul ignore if */

    if (isNodeEnv()) {
      error('SweetAlert2 requires document to initialize');
      return;
    }

    const container = document.createElement('div');
    container.className = swalClasses.container;

    if (oldContainerExisted) {
      addClass(container, swalClasses['no-transition']);
    }

    setInnerHtml(container, sweetHTML);
    const targetElement = getTarget(params.target);
    targetElement.appendChild(container);
    setupAccessibility(params);
    setupRTL(targetElement);
    addInputChangeListeners();
  };

  /**
   * @param {HTMLElement | object | string} param
   * @param {HTMLElement} target
   */

  const parseHtmlToContainer = (param, target) => {
    // DOM element
    if (param instanceof HTMLElement) {
      target.appendChild(param);
    } // Object
    else if (typeof param === 'object') {
      handleObject(param, target);
    } // Plain string
    else if (param) {
      setInnerHtml(target, param);
    }
  };
  /**
   * @param {object} param
   * @param {HTMLElement} target
   */

  const handleObject = (param, target) => {
    // JQuery element(s)
    if (param.jquery) {
      handleJqueryElem(target, param);
    } // For other objects use their string representation
    else {
      setInnerHtml(target, param.toString());
    }
  };
  /**
   * @param {HTMLElement} target
   * @param {HTMLElement} elem
   */


  const handleJqueryElem = (target, elem) => {
    target.textContent = '';

    if (0 in elem) {
      for (let i = 0; (i in elem); i++) {
        target.appendChild(elem[i].cloneNode(true));
      }
    } else {
      target.appendChild(elem.cloneNode(true));
    }
  };

  /**
   * @returns {'webkitAnimationEnd' | 'animationend' | false}
   */

  const animationEndEvent = (() => {
    // Prevent run in Node env

    /* istanbul ignore if */
    if (isNodeEnv()) {
      return false;
    }

    const testEl = document.createElement('div');
    const transEndEventNames = {
      WebkitAnimation: 'webkitAnimationEnd',
      // Chrome, Safari and Opera
      animation: 'animationend' // Standard syntax

    };

    for (const i in transEndEventNames) {
      if (Object.prototype.hasOwnProperty.call(transEndEventNames, i) && typeof testEl.style[i] !== 'undefined') {
        return transEndEventNames[i];
      }
    }

    return false;
  })();

  /**
   * Measure scrollbar width for padding body during modal show/hide
   * https://github.com/twbs/bootstrap/blob/master/js/src/modal.js
   *
   * @returns {number}
   */

  const measureScrollbar = () => {
    const scrollDiv = document.createElement('div');
    scrollDiv.className = swalClasses['scrollbar-measure'];
    document.body.appendChild(scrollDiv);
    const scrollbarWidth = scrollDiv.getBoundingClientRect().width - scrollDiv.clientWidth;
    document.body.removeChild(scrollDiv);
    return scrollbarWidth;
  };

  /**
   * @param {SweetAlert2} instance
   * @param {SweetAlertOptions} params
   */

  const renderActions = (instance, params) => {
    const actions = getActions();
    const loader = getLoader(); // Actions (buttons) wrapper

    if (!params.showConfirmButton && !params.showDenyButton && !params.showCancelButton) {
      hide(actions);
    } else {
      show(actions);
    } // Custom class


    applyCustomClass(actions, params, 'actions'); // Render all the buttons

    renderButtons(actions, loader, params); // Loader

    setInnerHtml(loader, params.loaderHtml);
    applyCustomClass(loader, params, 'loader');
  };
  /**
   * @param {HTMLElement} actions
   * @param {HTMLElement} loader
   * @param {SweetAlertOptions} params
   */

  function renderButtons(actions, loader, params) {
    const confirmButton = getConfirmButton();
    const denyButton = getDenyButton();
    const cancelButton = getCancelButton(); // Render buttons

    renderButton(confirmButton, 'confirm', params);
    renderButton(denyButton, 'deny', params);
    renderButton(cancelButton, 'cancel', params);
    handleButtonsStyling(confirmButton, denyButton, cancelButton, params);

    if (params.reverseButtons) {
      if (params.toast) {
        actions.insertBefore(cancelButton, confirmButton);
        actions.insertBefore(denyButton, confirmButton);
      } else {
        actions.insertBefore(cancelButton, loader);
        actions.insertBefore(denyButton, loader);
        actions.insertBefore(confirmButton, loader);
      }
    }
  }
  /**
   * @param {HTMLElement} confirmButton
   * @param {HTMLElement} denyButton
   * @param {HTMLElement} cancelButton
   * @param {SweetAlertOptions} params
   */


  function handleButtonsStyling(confirmButton, denyButton, cancelButton, params) {
    if (!params.buttonsStyling) {
      return removeClass([confirmButton, denyButton, cancelButton], swalClasses.styled);
    }

    addClass([confirmButton, denyButton, cancelButton], swalClasses.styled); // Buttons background colors

    if (params.confirmButtonColor) {
      confirmButton.style.backgroundColor = params.confirmButtonColor;
      addClass(confirmButton, swalClasses['default-outline']);
    }

    if (params.denyButtonColor) {
      denyButton.style.backgroundColor = params.denyButtonColor;
      addClass(denyButton, swalClasses['default-outline']);
    }

    if (params.cancelButtonColor) {
      cancelButton.style.backgroundColor = params.cancelButtonColor;
      addClass(cancelButton, swalClasses['default-outline']);
    }
  }
  /**
   * @param {HTMLElement} button
   * @param {'confirm' | 'deny' | 'cancel'} buttonType
   * @param {SweetAlertOptions} params
   */


  function renderButton(button, buttonType, params) {
    toggle(button, params["show".concat(capitalizeFirstLetter(buttonType), "Button")], 'inline-block');
    setInnerHtml(button, params["".concat(buttonType, "ButtonText")]); // Set caption text

    button.setAttribute('aria-label', params["".concat(buttonType, "ButtonAriaLabel")]); // ARIA label
    // Add buttons custom classes

    button.className = swalClasses[buttonType];
    applyCustomClass(button, params, "".concat(buttonType, "Button"));
    addClass(button, params["".concat(buttonType, "ButtonClass")]);
  }

  /**
   * @param {SweetAlert2} instance
   * @param {SweetAlertOptions} params
   */

  const renderCloseButton = (instance, params) => {
    const closeButton = getCloseButton();
    setInnerHtml(closeButton, params.closeButtonHtml); // Custom class

    applyCustomClass(closeButton, params, 'closeButton');
    toggle(closeButton, params.showCloseButton);
    closeButton.setAttribute('aria-label', params.closeButtonAriaLabel);
  };

  /**
   * @param {SweetAlert2} instance
   * @param {SweetAlertOptions} params
   */

  const renderContainer = (instance, params) => {
    const container = getContainer();

    if (!container) {
      return;
    }

    handleBackdropParam(container, params.backdrop);
    handlePositionParam(container, params.position);
    handleGrowParam(container, params.grow); // Custom class

    applyCustomClass(container, params, 'container');
  };
  /**
   * @param {HTMLElement} container
   * @param {SweetAlertOptions['backdrop']} backdrop
   */

  function handleBackdropParam(container, backdrop) {
    if (typeof backdrop === 'string') {
      container.style.background = backdrop;
    } else if (!backdrop) {
      addClass([document.documentElement, document.body], swalClasses['no-backdrop']);
    }
  }
  /**
   * @param {HTMLElement} container
   * @param {SweetAlertOptions['position']} position
   */


  function handlePositionParam(container, position) {
    if (position in swalClasses) {
      addClass(container, swalClasses[position]);
    } else {
      warn('The "position" parameter is not valid, defaulting to "center"');
      addClass(container, swalClasses.center);
    }
  }
  /**
   * @param {HTMLElement} container
   * @param {SweetAlertOptions['grow']} grow
   */


  function handleGrowParam(container, grow) {
    if (grow && typeof grow === 'string') {
      const growClass = "grow-".concat(grow);

      if (growClass in swalClasses) {
        addClass(container, swalClasses[growClass]);
      }
    }
  }

  /// <reference path="../../../../sweetalert2.d.ts"/>
  /** @type {InputClass[]} */

  const inputClasses = ['input', 'file', 'range', 'select', 'radio', 'checkbox', 'textarea'];
  /**
   * @param {SweetAlert2} instance
   * @param {SweetAlertOptions} params
   */

  const renderInput = (instance, params) => {
    const popup = getPopup();
    const innerParams = privateProps.innerParams.get(instance);
    const rerender = !innerParams || params.input !== innerParams.input;
    inputClasses.forEach(inputClass => {
      const inputContainer = getDirectChildByClass(popup, swalClasses[inputClass]); // set attributes

      setAttributes(inputClass, params.inputAttributes); // set class

      inputContainer.className = swalClasses[inputClass];

      if (rerender) {
        hide(inputContainer);
      }
    });

    if (params.input) {
      if (rerender) {
        showInput(params);
      } // set custom class


      setCustomClass(params);
    }
  };
  /**
   * @param {SweetAlertOptions} params
   */

  const showInput = params => {
    if (!renderInputType[params.input]) {
      return error("Unexpected type of input! Expected \"text\", \"email\", \"password\", \"number\", \"tel\", \"select\", \"radio\", \"checkbox\", \"textarea\", \"file\" or \"url\", got \"".concat(params.input, "\""));
    }

    const inputContainer = getInputContainer(params.input);
    const input = renderInputType[params.input](inputContainer, params);
    show(inputContainer); // input autofocus

    setTimeout(() => {
      focusInput(input);
    });
  };
  /**
   * @param {HTMLInputElement} input
   */


  const removeAttributes = input => {
    for (let i = 0; i < input.attributes.length; i++) {
      const attrName = input.attributes[i].name;

      if (!['type', 'value', 'style'].includes(attrName)) {
        input.removeAttribute(attrName);
      }
    }
  };
  /**
   * @param {InputClass} inputClass
   * @param {SweetAlertOptions['inputAttributes']} inputAttributes
   */


  const setAttributes = (inputClass, inputAttributes) => {
    const input = getInput(getPopup(), inputClass);

    if (!input) {
      return;
    }

    removeAttributes(input);

    for (const attr in inputAttributes) {
      input.setAttribute(attr, inputAttributes[attr]);
    }
  };
  /**
   * @param {SweetAlertOptions} params
   */


  const setCustomClass = params => {
    const inputContainer = getInputContainer(params.input);

    if (typeof params.customClass === 'object') {
      addClass(inputContainer, params.customClass.input);
    }
  };
  /**
   * @param {HTMLInputElement | HTMLTextAreaElement} input
   * @param {SweetAlertOptions} params
   */


  const setInputPlaceholder = (input, params) => {
    if (!input.placeholder || params.inputPlaceholder) {
      input.placeholder = params.inputPlaceholder;
    }
  };
  /**
   * @param {Input} input
   * @param {Input} prependTo
   * @param {SweetAlertOptions} params
   */


  const setInputLabel = (input, prependTo, params) => {
    if (params.inputLabel) {
      input.id = swalClasses.input;
      const label = document.createElement('label');
      const labelClass = swalClasses['input-label'];
      label.setAttribute('for', input.id);
      label.className = labelClass;

      if (typeof params.customClass === 'object') {
        addClass(label, params.customClass.inputLabel);
      }

      label.innerText = params.inputLabel;
      prependTo.insertAdjacentElement('beforebegin', label);
    }
  };
  /**
   * @param {SweetAlertOptions['input']} inputType
   * @returns {HTMLElement}
   */


  const getInputContainer = inputType => {
    return getDirectChildByClass(getPopup(), swalClasses[inputType] || swalClasses.input);
  };
  /**
   * @param {HTMLInputElement | HTMLOutputElement | HTMLTextAreaElement} input
   * @param {SweetAlertOptions['inputValue']} inputValue
   */


  const checkAndSetInputValue = (input, inputValue) => {
    if (['string', 'number'].includes(typeof inputValue)) {
      input.value = "".concat(inputValue);
    } else if (!isPromise(inputValue)) {
      warn("Unexpected type of inputValue! Expected \"string\", \"number\" or \"Promise\", got \"".concat(typeof inputValue, "\""));
    }
  };
  /** @type Record<string, (input: Input | HTMLElement, params: SweetAlertOptions) => Input> */


  const renderInputType = {};
  /**
   * @param {HTMLInputElement} input
   * @param {SweetAlertOptions} params
   * @returns {HTMLInputElement}
   */

  renderInputType.text = renderInputType.email = renderInputType.password = renderInputType.number = renderInputType.tel = renderInputType.url = (input, params) => {
    checkAndSetInputValue(input, params.inputValue);
    setInputLabel(input, input, params);
    setInputPlaceholder(input, params);
    input.type = params.input;
    return input;
  };
  /**
   * @param {HTMLInputElement} input
   * @param {SweetAlertOptions} params
   * @returns {HTMLInputElement}
   */


  renderInputType.file = (input, params) => {
    setInputLabel(input, input, params);
    setInputPlaceholder(input, params);
    return input;
  };
  /**
   * @param {HTMLInputElement} range
   * @param {SweetAlertOptions} params
   * @returns {HTMLInputElement}
   */


  renderInputType.range = (range, params) => {
    const rangeInput = range.querySelector('input');
    const rangeOutput = range.querySelector('output');
    checkAndSetInputValue(rangeInput, params.inputValue);
    rangeInput.type = params.input;
    checkAndSetInputValue(rangeOutput, params.inputValue);
    setInputLabel(rangeInput, range, params);
    return range;
  };
  /**
   * @param {HTMLSelectElement} select
   * @param {SweetAlertOptions} params
   * @returns {HTMLSelectElement}
   */


  renderInputType.select = (select, params) => {
    select.textContent = '';

    if (params.inputPlaceholder) {
      const placeholder = document.createElement('option');
      setInnerHtml(placeholder, params.inputPlaceholder);
      placeholder.value = '';
      placeholder.disabled = true;
      placeholder.selected = true;
      select.appendChild(placeholder);
    }

    setInputLabel(select, select, params);
    return select;
  };
  /**
   * @param {HTMLInputElement} radio
   * @returns {HTMLInputElement}
   */


  renderInputType.radio = radio => {
    radio.textContent = '';
    return radio;
  };
  /**
   * @param {HTMLLabelElement} checkboxContainer
   * @param {SweetAlertOptions} params
   * @returns {HTMLInputElement}
   */


  renderInputType.checkbox = (checkboxContainer, params) => {
    const checkbox = getInput(getPopup(), 'checkbox');
    checkbox.value = '1';
    checkbox.id = swalClasses.checkbox;
    checkbox.checked = Boolean(params.inputValue);
    const label = checkboxContainer.querySelector('span');
    setInnerHtml(label, params.inputPlaceholder);
    return checkbox;
  };
  /**
   * @param {HTMLTextAreaElement} textarea
   * @param {SweetAlertOptions} params
   * @returns {HTMLTextAreaElement}
   */


  renderInputType.textarea = (textarea, params) => {
    checkAndSetInputValue(textarea, params.inputValue);
    setInputPlaceholder(textarea, params);
    setInputLabel(textarea, textarea, params);
    /**
     * @param {HTMLElement} el
     * @returns {number}
     */

    const getMargin = el => parseInt(window.getComputedStyle(el).marginLeft) + parseInt(window.getComputedStyle(el).marginRight); // https://github.com/sweetalert2/sweetalert2/issues/2291


    setTimeout(() => {
      // https://github.com/sweetalert2/sweetalert2/issues/1699
      if ('MutationObserver' in window) {
        const initialPopupWidth = parseInt(window.getComputedStyle(getPopup()).width);

        const textareaResizeHandler = () => {
          const textareaWidth = textarea.offsetWidth + getMargin(textarea);

          if (textareaWidth > initialPopupWidth) {
            getPopup().style.width = "".concat(textareaWidth, "px");
          } else {
            getPopup().style.width = null;
          }
        };

        new MutationObserver(textareaResizeHandler).observe(textarea, {
          attributes: true,
          attributeFilter: ['style']
        });
      }
    });
    return textarea;
  };

  /**
   * @param {SweetAlert2} instance
   * @param {SweetAlertOptions} params
   */

  const renderContent = (instance, params) => {
    const htmlContainer = getHtmlContainer();
    applyCustomClass(htmlContainer, params, 'htmlContainer'); // Content as HTML

    if (params.html) {
      parseHtmlToContainer(params.html, htmlContainer);
      show(htmlContainer, 'block');
    } // Content as plain text
    else if (params.text) {
      htmlContainer.textContent = params.text;
      show(htmlContainer, 'block');
    } // No content
    else {
      hide(htmlContainer);
    }

    renderInput(instance, params);
  };

  /**
   * @param {SweetAlert2} instance
   * @param {SweetAlertOptions} params
   */

  const renderFooter = (instance, params) => {
    const footer = getFooter();
    toggle(footer, params.footer);

    if (params.footer) {
      parseHtmlToContainer(params.footer, footer);
    } // Custom class


    applyCustomClass(footer, params, 'footer');
  };

  /**
   * @param {SweetAlert2} instance
   * @param {SweetAlertOptions} params
   */

  const renderIcon = (instance, params) => {
    const innerParams = privateProps.innerParams.get(instance);
    const icon = getIcon(); // if the given icon already rendered, apply the styling without re-rendering the icon

    if (innerParams && params.icon === innerParams.icon) {
      // Custom or default content
      setContent(icon, params);
      applyStyles(icon, params);
      return;
    }

    if (!params.icon && !params.iconHtml) {
      hide(icon);
      return;
    }

    if (params.icon && Object.keys(iconTypes).indexOf(params.icon) === -1) {
      error("Unknown icon! Expected \"success\", \"error\", \"warning\", \"info\" or \"question\", got \"".concat(params.icon, "\""));
      hide(icon);
      return;
    }

    show(icon); // Custom or default content

    setContent(icon, params);
    applyStyles(icon, params); // Animate icon

    addClass(icon, params.showClass.icon);
  };
  /**
   * @param {HTMLElement} icon
   * @param {SweetAlertOptions} params
   */

  const applyStyles = (icon, params) => {
    for (const iconType in iconTypes) {
      if (params.icon !== iconType) {
        removeClass(icon, iconTypes[iconType]);
      }
    }

    addClass(icon, iconTypes[params.icon]); // Icon color

    setColor(icon, params); // Success icon background color

    adjustSuccessIconBackgroundColor(); // Custom class

    applyCustomClass(icon, params, 'icon');
  }; // Adjust success icon background color to match the popup background color


  const adjustSuccessIconBackgroundColor = () => {
    const popup = getPopup();
    const popupBackgroundColor = window.getComputedStyle(popup).getPropertyValue('background-color');
    /** @type {NodeListOf<HTMLElement>} */

    const successIconParts = popup.querySelectorAll('[class^=swal2-success-circular-line], .swal2-success-fix');

    for (let i = 0; i < successIconParts.length; i++) {
      successIconParts[i].style.backgroundColor = popupBackgroundColor;
    }
  };

  const successIconHtml = "\n  <div class=\"swal2-success-circular-line-left\"></div>\n  <span class=\"swal2-success-line-tip\"></span> <span class=\"swal2-success-line-long\"></span>\n  <div class=\"swal2-success-ring\"></div> <div class=\"swal2-success-fix\"></div>\n  <div class=\"swal2-success-circular-line-right\"></div>\n";
  const errorIconHtml = "\n  <span class=\"swal2-x-mark\">\n    <span class=\"swal2-x-mark-line-left\"></span>\n    <span class=\"swal2-x-mark-line-right\"></span>\n  </span>\n";
  /**
   * @param {HTMLElement} icon
   * @param {SweetAlertOptions} params
   */

  const setContent = (icon, params) => {
    let oldContent = icon.innerHTML;
    let newContent;

    if (params.iconHtml) {
      newContent = iconContent(params.iconHtml);
    } else if (params.icon === 'success') {
      newContent = successIconHtml;
      oldContent = oldContent.replace(/ style=".*?"/g, ''); // undo adjustSuccessIconBackgroundColor()
    } else if (params.icon === 'error') {
      newContent = errorIconHtml;
    } else {
      const defaultIconHtml = {
        question: '?',
        warning: '!',
        info: 'i'
      };
      newContent = iconContent(defaultIconHtml[params.icon]);
    }

    if (oldContent.trim() !== newContent.trim()) {
      setInnerHtml(icon, newContent);
    }
  };
  /**
   * @param {HTMLElement} icon
   * @param {SweetAlertOptions} params
   */


  const setColor = (icon, params) => {
    if (!params.iconColor) {
      return;
    }

    icon.style.color = params.iconColor;
    icon.style.borderColor = params.iconColor;

    for (const sel of ['.swal2-success-line-tip', '.swal2-success-line-long', '.swal2-x-mark-line-left', '.swal2-x-mark-line-right']) {
      setStyle(icon, sel, 'backgroundColor', params.iconColor);
    }

    setStyle(icon, '.swal2-success-ring', 'borderColor', params.iconColor);
  };
  /**
   * @param {string} content
   * @returns {string}
   */


  const iconContent = content => "<div class=\"".concat(swalClasses['icon-content'], "\">").concat(content, "</div>");

  /**
   * @param {SweetAlert2} instance
   * @param {SweetAlertOptions} params
   */

  const renderImage = (instance, params) => {
    const image = getImage();

    if (!params.imageUrl) {
      return hide(image);
    }

    show(image, ''); // Src, alt

    image.setAttribute('src', params.imageUrl);
    image.setAttribute('alt', params.imageAlt); // Width, height

    applyNumericalStyle(image, 'width', params.imageWidth);
    applyNumericalStyle(image, 'height', params.imageHeight); // Class

    image.className = swalClasses.image;
    applyCustomClass(image, params, 'image');
  };

  /**
   * @param {SweetAlert2} instance
   * @param {SweetAlertOptions} params
   */

  const renderPopup = (instance, params) => {
    const container = getContainer();
    const popup = getPopup(); // Width
    // https://github.com/sweetalert2/sweetalert2/issues/2170

    if (params.toast) {
      applyNumericalStyle(container, 'width', params.width);
      popup.style.width = '100%';
      popup.insertBefore(getLoader(), getIcon());
    } else {
      applyNumericalStyle(popup, 'width', params.width);
    } // Padding


    applyNumericalStyle(popup, 'padding', params.padding); // Color

    if (params.color) {
      popup.style.color = params.color;
    } // Background


    if (params.background) {
      popup.style.background = params.background;
    }

    hide(getValidationMessage()); // Classes

    addClasses(popup, params);
  };
  /**
   * @param {HTMLElement} popup
   * @param {SweetAlertOptions} params
   */

  const addClasses = (popup, params) => {
    // Default Class + showClass when updating Swal.update({})
    popup.className = "".concat(swalClasses.popup, " ").concat(isVisible(popup) ? params.showClass.popup : '');

    if (params.toast) {
      addClass([document.documentElement, document.body], swalClasses['toast-shown']);
      addClass(popup, swalClasses.toast);
    } else {
      addClass(popup, swalClasses.modal);
    } // Custom class


    applyCustomClass(popup, params, 'popup');

    if (typeof params.customClass === 'string') {
      addClass(popup, params.customClass);
    } // Icon class (#1842)


    if (params.icon) {
      addClass(popup, swalClasses["icon-".concat(params.icon)]);
    }
  };

  /**
   * @param {SweetAlert2} instance
   * @param {SweetAlertOptions} params
   */

  const renderProgressSteps = (instance, params) => {
    const progressStepsContainer = getProgressSteps();

    if (!params.progressSteps || params.progressSteps.length === 0) {
      return hide(progressStepsContainer);
    }

    show(progressStepsContainer);
    progressStepsContainer.textContent = '';

    if (params.currentProgressStep >= params.progressSteps.length) {
      warn('Invalid currentProgressStep parameter, it should be less than progressSteps.length ' + '(currentProgressStep like JS arrays starts from 0)');
    }

    params.progressSteps.forEach((step, index) => {
      const stepEl = createStepElement(step);
      progressStepsContainer.appendChild(stepEl);

      if (index === params.currentProgressStep) {
        addClass(stepEl, swalClasses['active-progress-step']);
      }

      if (index !== params.progressSteps.length - 1) {
        const lineEl = createLineElement(params);
        progressStepsContainer.appendChild(lineEl);
      }
    });
  };
  /**
   * @param {string} step
   * @returns {HTMLLIElement}
   */

  const createStepElement = step => {
    const stepEl = document.createElement('li');
    addClass(stepEl, swalClasses['progress-step']);
    setInnerHtml(stepEl, step);
    return stepEl;
  };
  /**
   * @param {SweetAlertOptions} params
   * @returns {HTMLLIElement}
   */


  const createLineElement = params => {
    const lineEl = document.createElement('li');
    addClass(lineEl, swalClasses['progress-step-line']);

    if (params.progressStepsDistance) {
      applyNumericalStyle(lineEl, 'width', params.progressStepsDistance);
    }

    return lineEl;
  };

  /**
   * @param {SweetAlert2} instance
   * @param {SweetAlertOptions} params
   */

  const renderTitle = (instance, params) => {
    const title = getTitle();
    toggle(title, params.title || params.titleText, 'block');

    if (params.title) {
      parseHtmlToContainer(params.title, title);
    }

    if (params.titleText) {
      title.innerText = params.titleText;
    } // Custom class


    applyCustomClass(title, params, 'title');
  };

  /**
   * @param {SweetAlert2} instance
   * @param {SweetAlertOptions} params
   */

  const render = (instance, params) => {
    renderPopup(instance, params);
    renderContainer(instance, params);
    renderProgressSteps(instance, params);
    renderIcon(instance, params);
    renderImage(instance, params);
    renderTitle(instance, params);
    renderCloseButton(instance, params);
    renderContent(instance, params);
    renderActions(instance, params);
    renderFooter(instance, params);

    if (typeof params.didRender === 'function') {
      params.didRender(getPopup());
    }
  };

  /**
   * Hides loader and shows back the button which was hidden by .showLoading()
   */

  function hideLoading() {
    // do nothing if popup is closed
    const innerParams = privateProps.innerParams.get(this);

    if (!innerParams) {
      return;
    }

    const domCache = privateProps.domCache.get(this);
    hide(domCache.loader);

    if (isToast()) {
      if (innerParams.icon) {
        show(getIcon());
      }
    } else {
      showRelatedButton(domCache);
    }

    removeClass([domCache.popup, domCache.actions], swalClasses.loading);
    domCache.popup.removeAttribute('aria-busy');
    domCache.popup.removeAttribute('data-loading');
    domCache.confirmButton.disabled = false;
    domCache.denyButton.disabled = false;
    domCache.cancelButton.disabled = false;
  }

  const showRelatedButton = domCache => {
    const buttonToReplace = domCache.popup.getElementsByClassName(domCache.loader.getAttribute('data-button-to-replace'));

    if (buttonToReplace.length) {
      show(buttonToReplace[0], 'inline-block');
    } else if (allButtonsAreHidden()) {
      hide(domCache.actions);
    }
  };

  /**
   * Gets the input DOM node, this method works with input parameter.
   * @returns {HTMLElement | null}
   */

  function getInput$1(instance) {
    const innerParams = privateProps.innerParams.get(instance || this);
    const domCache = privateProps.domCache.get(instance || this);

    if (!domCache) {
      return null;
    }

    return getInput(domCache.popup, innerParams.input);
  }

  /*
   * Global function to determine if SweetAlert2 popup is shown
   */

  const isVisible$1 = () => {
    return isVisible(getPopup());
  };
  /*
   * Global function to click 'Confirm' button
   */

  const clickConfirm = () => getConfirmButton() && getConfirmButton().click();
  /*
   * Global function to click 'Deny' button
   */

  const clickDeny = () => getDenyButton() && getDenyButton().click();
  /*
   * Global function to click 'Cancel' button
   */

  const clickCancel = () => getCancelButton() && getCancelButton().click();

  const DismissReason = Object.freeze({
    cancel: 'cancel',
    backdrop: 'backdrop',
    close: 'close',
    esc: 'esc',
    timer: 'timer'
  });

  /**
   * @param {GlobalState} globalState
   */

  const removeKeydownHandler = globalState => {
    if (globalState.keydownTarget && globalState.keydownHandlerAdded) {
      globalState.keydownTarget.removeEventListener('keydown', globalState.keydownHandler, {
        capture: globalState.keydownListenerCapture
      });
      globalState.keydownHandlerAdded = false;
    }
  };
  /**
   * @param {SweetAlert2} instance
   * @param {GlobalState} globalState
   * @param {SweetAlertOptions} innerParams
   * @param {*} dismissWith
   */

  const addKeydownHandler = (instance, globalState, innerParams, dismissWith) => {
    removeKeydownHandler(globalState);

    if (!innerParams.toast) {
      globalState.keydownHandler = e => keydownHandler(instance, e, dismissWith);

      globalState.keydownTarget = innerParams.keydownListenerCapture ? window : getPopup();
      globalState.keydownListenerCapture = innerParams.keydownListenerCapture;
      globalState.keydownTarget.addEventListener('keydown', globalState.keydownHandler, {
        capture: globalState.keydownListenerCapture
      });
      globalState.keydownHandlerAdded = true;
    }
  };
  /**
   * @param {SweetAlertOptions} innerParams
   * @param {number} index
   * @param {number} increment
   */

  const setFocus = (innerParams, index, increment) => {
    const focusableElements = getFocusableElements(); // search for visible elements and select the next possible match

    if (focusableElements.length) {
      index = index + increment; // rollover to first item

      if (index === focusableElements.length) {
        index = 0; // go to last item
      } else if (index === -1) {
        index = focusableElements.length - 1;
      }

      return focusableElements[index].focus();
    } // no visible focusable elements, focus the popup


    getPopup().focus();
  };
  const arrowKeysNextButton = ['ArrowRight', 'ArrowDown'];
  const arrowKeysPreviousButton = ['ArrowLeft', 'ArrowUp'];
  /**
   * @param {SweetAlert2} instance
   * @param {KeyboardEvent} e
   * @param {function} dismissWith
   */

  const keydownHandler = (instance, e, dismissWith) => {
    const innerParams = privateProps.innerParams.get(instance);

    if (!innerParams) {
      return; // This instance has already been destroyed
    } // Ignore keydown during IME composition
    // https://developer.mozilla.org/en-US/docs/Web/API/Document/keydown_event#ignoring_keydown_during_ime_composition
    // https://github.com/sweetalert2/sweetalert2/issues/720
    // https://github.com/sweetalert2/sweetalert2/issues/2406


    if (e.isComposing || e.keyCode === 229) {
      return;
    }

    if (innerParams.stopKeydownPropagation) {
      e.stopPropagation();
    } // ENTER


    if (e.key === 'Enter') {
      handleEnter(instance, e, innerParams);
    } // TAB
    else if (e.key === 'Tab') {
      handleTab(e, innerParams);
    } // ARROWS - switch focus between buttons
    else if ([...arrowKeysNextButton, ...arrowKeysPreviousButton].includes(e.key)) {
      handleArrows(e.key);
    } // ESC
    else if (e.key === 'Escape') {
      handleEsc(e, innerParams, dismissWith);
    }
  };
  /**
   * @param {SweetAlert2} instance
   * @param {KeyboardEvent} e
   * @param {SweetAlertOptions} innerParams
   */


  const handleEnter = (instance, e, innerParams) => {
    // https://github.com/sweetalert2/sweetalert2/issues/2386
    if (!callIfFunction(innerParams.allowEnterKey)) {
      return;
    }

    if (e.target && instance.getInput() && e.target instanceof HTMLElement && e.target.outerHTML === instance.getInput().outerHTML) {
      if (['textarea', 'file'].includes(innerParams.input)) {
        return; // do not submit
      }

      clickConfirm();
      e.preventDefault();
    }
  };
  /**
   * @param {KeyboardEvent} e
   * @param {SweetAlertOptions} innerParams
   */


  const handleTab = (e, innerParams) => {
    const targetElement = e.target;
    const focusableElements = getFocusableElements();
    let btnIndex = -1;

    for (let i = 0; i < focusableElements.length; i++) {
      if (targetElement === focusableElements[i]) {
        btnIndex = i;
        break;
      }
    } // Cycle to the next button


    if (!e.shiftKey) {
      setFocus(innerParams, btnIndex, 1);
    } // Cycle to the prev button
    else {
      setFocus(innerParams, btnIndex, -1);
    }

    e.stopPropagation();
    e.preventDefault();
  };
  /**
   * @param {string} key
   */


  const handleArrows = key => {
    const confirmButton = getConfirmButton();
    const denyButton = getDenyButton();
    const cancelButton = getCancelButton();

    if (document.activeElement instanceof HTMLElement && ![confirmButton, denyButton, cancelButton].includes(document.activeElement)) {
      return;
    }

    const sibling = arrowKeysNextButton.includes(key) ? 'nextElementSibling' : 'previousElementSibling';
    let buttonToFocus = document.activeElement;

    for (let i = 0; i < getActions().children.length; i++) {
      buttonToFocus = buttonToFocus[sibling];

      if (!buttonToFocus) {
        return;
      }

      if (buttonToFocus instanceof HTMLButtonElement && isVisible(buttonToFocus)) {
        break;
      }
    }

    if (buttonToFocus instanceof HTMLButtonElement) {
      buttonToFocus.focus();
    }
  };
  /**
   * @param {KeyboardEvent} e
   * @param {SweetAlertOptions} innerParams
   * @param {function} dismissWith
   */


  const handleEsc = (e, innerParams, dismissWith) => {
    if (callIfFunction(innerParams.allowEscapeKey)) {
      e.preventDefault();
      dismissWith(DismissReason.esc);
    }
  };

  /**
   * This module contains `WeakMap`s for each effectively-"private  property" that a `Swal` has.
   * For example, to set the private property "foo" of `this` to "bar", you can `privateProps.foo.set(this, 'bar')`
   * This is the approach that Babel will probably take to implement private methods/fields
   *   https://github.com/tc39/proposal-private-methods
   *   https://github.com/babel/babel/pull/7555
   * Once we have the changes from that PR in Babel, and our core class fits reasonable in *one module*
   *   then we can use that language feature.
   */
  var privateMethods = {
    swalPromiseResolve: new WeakMap(),
    swalPromiseReject: new WeakMap()
  };

  // Adding aria-hidden="true" to elements outside of the active modal dialog ensures that
  // elements not within the active modal dialog will not be surfaced if a user opens a screen
  // reader’s list of elements (headings, form controls, landmarks, etc.) in the document.

  const setAriaHidden = () => {
    const bodyChildren = Array.from(document.body.children);
    bodyChildren.forEach(el => {
      if (el === getContainer() || el.contains(getContainer())) {
        return;
      }

      if (el.hasAttribute('aria-hidden')) {
        el.setAttribute('data-previous-aria-hidden', el.getAttribute('aria-hidden'));
      }

      el.setAttribute('aria-hidden', 'true');
    });
  };
  const unsetAriaHidden = () => {
    const bodyChildren = Array.from(document.body.children);
    bodyChildren.forEach(el => {
      if (el.hasAttribute('data-previous-aria-hidden')) {
        el.setAttribute('aria-hidden', el.getAttribute('data-previous-aria-hidden'));
        el.removeAttribute('data-previous-aria-hidden');
      } else {
        el.removeAttribute('aria-hidden');
      }
    });
  };

  /* istanbul ignore file */

  const iOSfix = () => {
    const iOS = // @ts-ignore
    /iPad|iPhone|iPod/.test(navigator.userAgent) && !window.MSStream || navigator.platform === 'MacIntel' && navigator.maxTouchPoints > 1;

    if (iOS && !hasClass(document.body, swalClasses.iosfix)) {
      const offset = document.body.scrollTop;
      document.body.style.top = "".concat(offset * -1, "px");
      addClass(document.body, swalClasses.iosfix);
      lockBodyScroll();
      addBottomPaddingForTallPopups();
    }
  };
  /**
   * https://github.com/sweetalert2/sweetalert2/issues/1948
   */

  const addBottomPaddingForTallPopups = () => {
    const ua = navigator.userAgent;
    const iOS = !!ua.match(/iPad/i) || !!ua.match(/iPhone/i);
    const webkit = !!ua.match(/WebKit/i);
    const iOSSafari = iOS && webkit && !ua.match(/CriOS/i);

    if (iOSSafari) {
      const bottomPanelHeight = 44;

      if (getPopup().scrollHeight > window.innerHeight - bottomPanelHeight) {
        getContainer().style.paddingBottom = "".concat(bottomPanelHeight, "px");
      }
    }
  };
  /**
   * https://github.com/sweetalert2/sweetalert2/issues/1246
   */


  const lockBodyScroll = () => {
    const container = getContainer();
    let preventTouchMove;
    /**
     * @param {TouchEvent} e
     */

    container.ontouchstart = e => {
      preventTouchMove = shouldPreventTouchMove(e);
    };
    /**
     * @param {TouchEvent} e
     */


    container.ontouchmove = e => {
      if (preventTouchMove) {
        e.preventDefault();
        e.stopPropagation();
      }
    };
  };
  /**
   * @param {TouchEvent} event
   * @returns {boolean}
   */


  const shouldPreventTouchMove = event => {
    const target = event.target;
    const container = getContainer();

    if (isStylus(event) || isZoom(event)) {
      return false;
    }

    if (target === container) {
      return true;
    }

    if (!isScrollable(container) && target instanceof HTMLElement && target.tagName !== 'INPUT' && // #1603
    target.tagName !== 'TEXTAREA' && // #2266
    !(isScrollable(getHtmlContainer()) && // #1944
    getHtmlContainer().contains(target))) {
      return true;
    }

    return false;
  };
  /**
   * https://github.com/sweetalert2/sweetalert2/issues/1786
   *
   * @param {*} event
   * @returns {boolean}
   */


  const isStylus = event => {
    return event.touches && event.touches.length && event.touches[0].touchType === 'stylus';
  };
  /**
   * https://github.com/sweetalert2/sweetalert2/issues/1891
   *
   * @param {TouchEvent} event
   * @returns {boolean}
   */


  const isZoom = event => {
    return event.touches && event.touches.length > 1;
  };

  const undoIOSfix = () => {
    if (hasClass(document.body, swalClasses.iosfix)) {
      const offset = parseInt(document.body.style.top, 10);
      removeClass(document.body, swalClasses.iosfix);
      document.body.style.top = '';
      document.body.scrollTop = offset * -1;
    }
  };

  const fixScrollbar = () => {
    // for queues, do not do this more than once
    if (states.previousBodyPadding !== null) {
      return;
    } // if the body has overflow


    if (document.body.scrollHeight > window.innerHeight) {
      // add padding so the content doesn't shift after removal of scrollbar
      states.previousBodyPadding = parseInt(window.getComputedStyle(document.body).getPropertyValue('padding-right'));
      document.body.style.paddingRight = "".concat(states.previousBodyPadding + measureScrollbar(), "px");
    }
  };
  const undoScrollbar = () => {
    if (states.previousBodyPadding !== null) {
      document.body.style.paddingRight = "".concat(states.previousBodyPadding, "px");
      states.previousBodyPadding = null;
    }
  };

  /*
   * Instance method to close sweetAlert
   */

  function removePopupAndResetState(instance, container, returnFocus, didClose) {
    if (isToast()) {
      triggerDidCloseAndDispose(instance, didClose);
    } else {
      restoreActiveElement(returnFocus).then(() => triggerDidCloseAndDispose(instance, didClose));
      removeKeydownHandler(globalState);
    }

    const isSafari = /^((?!chrome|android).)*safari/i.test(navigator.userAgent); // workaround for #2088
    // for some reason removing the container in Safari will scroll the document to bottom

    if (isSafari) {
      container.setAttribute('style', 'display:none !important');
      container.removeAttribute('class');
      container.innerHTML = '';
    } else {
      container.remove();
    }

    if (isModal()) {
      undoScrollbar();
      undoIOSfix();
      unsetAriaHidden();
    }

    removeBodyClasses();
  }

  function removeBodyClasses() {
    removeClass([document.documentElement, document.body], [swalClasses.shown, swalClasses['height-auto'], swalClasses['no-backdrop'], swalClasses['toast-shown']]);
  }

  function close(resolveValue) {
    resolveValue = prepareResolveValue(resolveValue);
    const swalPromiseResolve = privateMethods.swalPromiseResolve.get(this);
    const didClose = triggerClosePopup(this);

    if (this.isAwaitingPromise()) {
      // A swal awaiting for a promise (after a click on Confirm or Deny) cannot be dismissed anymore #2335
      if (!resolveValue.isDismissed) {
        handleAwaitingPromise(this);
        swalPromiseResolve(resolveValue);
      }
    } else if (didClose) {
      // Resolve Swal promise
      swalPromiseResolve(resolveValue);
    }
  }
  function isAwaitingPromise() {
    return !!privateProps.awaitingPromise.get(this);
  }

  const triggerClosePopup = instance => {
    const popup = getPopup();

    if (!popup) {
      return false;
    }

    const innerParams = privateProps.innerParams.get(instance);

    if (!innerParams || hasClass(popup, innerParams.hideClass.popup)) {
      return false;
    }

    removeClass(popup, innerParams.showClass.popup);
    addClass(popup, innerParams.hideClass.popup);
    const backdrop = getContainer();
    removeClass(backdrop, innerParams.showClass.backdrop);
    addClass(backdrop, innerParams.hideClass.backdrop);
    handlePopupAnimation(instance, popup, innerParams);
    return true;
  };

  function rejectPromise(error) {
    const rejectPromise = privateMethods.swalPromiseReject.get(this);
    handleAwaitingPromise(this);

    if (rejectPromise) {
      // Reject Swal promise
      rejectPromise(error);
    }
  }
  const handleAwaitingPromise = instance => {
    if (instance.isAwaitingPromise()) {
      privateProps.awaitingPromise.delete(instance); // The instance might have been previously partly destroyed, we must resume the destroy process in this case #2335

      if (!privateProps.innerParams.get(instance)) {
        instance._destroy();
      }
    }
  };

  const prepareResolveValue = resolveValue => {
    // When user calls Swal.close()
    if (typeof resolveValue === 'undefined') {
      return {
        isConfirmed: false,
        isDenied: false,
        isDismissed: true
      };
    }

    return Object.assign({
      isConfirmed: false,
      isDenied: false,
      isDismissed: false
    }, resolveValue);
  };

  const handlePopupAnimation = (instance, popup, innerParams) => {
    const container = getContainer(); // If animation is supported, animate

    const animationIsSupported = animationEndEvent && hasCssAnimation(popup);

    if (typeof innerParams.willClose === 'function') {
      innerParams.willClose(popup);
    }

    if (animationIsSupported) {
      animatePopup(instance, popup, container, innerParams.returnFocus, innerParams.didClose);
    } else {
      // Otherwise, remove immediately
      removePopupAndResetState(instance, container, innerParams.returnFocus, innerParams.didClose);
    }
  };

  const animatePopup = (instance, popup, container, returnFocus, didClose) => {
    globalState.swalCloseEventFinishedCallback = removePopupAndResetState.bind(null, instance, container, returnFocus, didClose);
    popup.addEventListener(animationEndEvent, function (e) {
      if (e.target === popup) {
        globalState.swalCloseEventFinishedCallback();
        delete globalState.swalCloseEventFinishedCallback;
      }
    });
  };

  const triggerDidCloseAndDispose = (instance, didClose) => {
    setTimeout(() => {
      if (typeof didClose === 'function') {
        didClose.bind(instance.params)();
      }

      instance._destroy();
    });
  };

  /**
   * @param {SweetAlert2} instance
   * @param {string[]} buttons
   * @param {boolean} disabled
   */

  function setButtonsDisabled(instance, buttons, disabled) {
    const domCache = privateProps.domCache.get(instance);
    buttons.forEach(button => {
      domCache[button].disabled = disabled;
    });
  }
  /**
   * @param {HTMLInputElement} input
   * @param {boolean} disabled
   */


  function setInputDisabled(input, disabled) {
    if (!input) {
      return;
    }

    if (input.type === 'radio') {
      const radiosContainer = input.parentNode.parentNode;
      const radios = radiosContainer.querySelectorAll('input');

      for (let i = 0; i < radios.length; i++) {
        radios[i].disabled = disabled;
      }
    } else {
      input.disabled = disabled;
    }
  }

  function enableButtons() {
    setButtonsDisabled(this, ['confirmButton', 'denyButton', 'cancelButton'], false);
  }
  function disableButtons() {
    setButtonsDisabled(this, ['confirmButton', 'denyButton', 'cancelButton'], true);
  }
  function enableInput() {
    setInputDisabled(this.getInput(), false);
  }
  function disableInput() {
    setInputDisabled(this.getInput(), true);
  }

  function showValidationMessage(error) {
    const domCache = privateProps.domCache.get(this);
    const params = privateProps.innerParams.get(this);
    setInnerHtml(domCache.validationMessage, error);
    domCache.validationMessage.className = swalClasses['validation-message'];

    if (params.customClass && params.customClass.validationMessage) {
      addClass(domCache.validationMessage, params.customClass.validationMessage);
    }

    show(domCache.validationMessage);
    const input = this.getInput();

    if (input) {
      input.setAttribute('aria-invalid', true);
      input.setAttribute('aria-describedby', swalClasses['validation-message']);
      focusInput(input);
      addClass(input, swalClasses.inputerror);
    }
  } // Hide block with validation message

  function resetValidationMessage$1() {
    const domCache = privateProps.domCache.get(this);

    if (domCache.validationMessage) {
      hide(domCache.validationMessage);
    }

    const input = this.getInput();

    if (input) {
      input.removeAttribute('aria-invalid');
      input.removeAttribute('aria-describedby');
      removeClass(input, swalClasses.inputerror);
    }
  }

  function getProgressSteps$1() {
    const domCache = privateProps.domCache.get(this);
    return domCache.progressSteps;
  }

  const defaultParams = {
    title: '',
    titleText: '',
    text: '',
    html: '',
    footer: '',
    icon: undefined,
    iconColor: undefined,
    iconHtml: undefined,
    template: undefined,
    toast: false,
    showClass: {
      popup: 'swal2-show',
      backdrop: 'swal2-backdrop-show',
      icon: 'swal2-icon-show'
    },
    hideClass: {
      popup: 'swal2-hide',
      backdrop: 'swal2-backdrop-hide',
      icon: 'swal2-icon-hide'
    },
    customClass: {},
    target: 'body',
    color: undefined,
    backdrop: true,
    heightAuto: true,
    allowOutsideClick: true,
    allowEscapeKey: true,
    allowEnterKey: true,
    stopKeydownPropagation: true,
    keydownListenerCapture: false,
    showConfirmButton: true,
    showDenyButton: false,
    showCancelButton: false,
    preConfirm: undefined,
    preDeny: undefined,
    confirmButtonText: 'OK',
    confirmButtonAriaLabel: '',
    confirmButtonColor: undefined,
    denyButtonText: 'No',
    denyButtonAriaLabel: '',
    denyButtonColor: undefined,
    cancelButtonText: 'Cancel',
    cancelButtonAriaLabel: '',
    cancelButtonColor: undefined,
    buttonsStyling: true,
    reverseButtons: false,
    focusConfirm: true,
    focusDeny: false,
    focusCancel: false,
    returnFocus: true,
    showCloseButton: false,
    closeButtonHtml: '&times;',
    closeButtonAriaLabel: 'Close this dialog',
    loaderHtml: '',
    showLoaderOnConfirm: false,
    showLoaderOnDeny: false,
    imageUrl: undefined,
    imageWidth: undefined,
    imageHeight: undefined,
    imageAlt: '',
    timer: undefined,
    timerProgressBar: false,
    width: undefined,
    padding: undefined,
    background: undefined,
    input: undefined,
    inputPlaceholder: '',
    inputLabel: '',
    inputValue: '',
    inputOptions: {},
    inputAutoTrim: true,
    inputAttributes: {},
    inputValidator: undefined,
    returnInputValueOnDeny: false,
    validationMessage: undefined,
    grow: false,
    position: 'center',
    progressSteps: [],
    currentProgressStep: undefined,
    progressStepsDistance: undefined,
    willOpen: undefined,
    didOpen: undefined,
    didRender: undefined,
    willClose: undefined,
    didClose: undefined,
    didDestroy: undefined,
    scrollbarPadding: true
  };
  const updatableParams = ['allowEscapeKey', 'allowOutsideClick', 'background', 'buttonsStyling', 'cancelButtonAriaLabel', 'cancelButtonColor', 'cancelButtonText', 'closeButtonAriaLabel', 'closeButtonHtml', 'color', 'confirmButtonAriaLabel', 'confirmButtonColor', 'confirmButtonText', 'currentProgressStep', 'customClass', 'denyButtonAriaLabel', 'denyButtonColor', 'denyButtonText', 'didClose', 'didDestroy', 'footer', 'hideClass', 'html', 'icon', 'iconColor', 'iconHtml', 'imageAlt', 'imageHeight', 'imageUrl', 'imageWidth', 'preConfirm', 'preDeny', 'progressSteps', 'returnFocus', 'reverseButtons', 'showCancelButton', 'showCloseButton', 'showConfirmButton', 'showDenyButton', 'text', 'title', 'titleText', 'willClose'];
  const deprecatedParams = {};
  const toastIncompatibleParams = ['allowOutsideClick', 'allowEnterKey', 'backdrop', 'focusConfirm', 'focusDeny', 'focusCancel', 'returnFocus', 'heightAuto', 'keydownListenerCapture'];
  /**
   * Is valid parameter
   *
   * @param {string} paramName
   * @returns {boolean}
   */

  const isValidParameter = paramName => {
    return Object.prototype.hasOwnProperty.call(defaultParams, paramName);
  };
  /**
   * Is valid parameter for Swal.update() method
   *
   * @param {string} paramName
   * @returns {boolean}
   */

  const isUpdatableParameter = paramName => {
    return updatableParams.indexOf(paramName) !== -1;
  };
  /**
   * Is deprecated parameter
   *
   * @param {string} paramName
   * @returns {string | undefined}
   */

  const isDeprecatedParameter = paramName => {
    return deprecatedParams[paramName];
  };
  /**
   * @param {string} param
   */

  const checkIfParamIsValid = param => {
    if (!isValidParameter(param)) {
      warn("Unknown parameter \"".concat(param, "\""));
    }
  };
  /**
   * @param {string} param
   */


  const checkIfToastParamIsValid = param => {
    if (toastIncompatibleParams.includes(param)) {
      warn("The parameter \"".concat(param, "\" is incompatible with toasts"));
    }
  };
  /**
   * @param {string} param
   */


  const checkIfParamIsDeprecated = param => {
    if (isDeprecatedParameter(param)) {
      warnAboutDeprecation(param, isDeprecatedParameter(param));
    }
  };
  /**
   * Show relevant warnings for given params
   *
   * @param {SweetAlertOptions} params
   */


  const showWarningsForParams = params => {
    if (!params.backdrop && params.allowOutsideClick) {
      warn('"allowOutsideClick" parameter requires `backdrop` parameter to be set to `true`');
    }

    for (const param in params) {
      checkIfParamIsValid(param);

      if (params.toast) {
        checkIfToastParamIsValid(param);
      }

      checkIfParamIsDeprecated(param);
    }
  };

  /**
   * Updates popup parameters.
   */

  function update(params) {
    const popup = getPopup();
    const innerParams = privateProps.innerParams.get(this);

    if (!popup || hasClass(popup, innerParams.hideClass.popup)) {
      return warn("You're trying to update the closed or closing popup, that won't work. Use the update() method in preConfirm parameter or show a new popup.");
    }

    const validUpdatableParams = filterValidParams(params);
    const updatedParams = Object.assign({}, innerParams, validUpdatableParams);
    render(this, updatedParams);
    privateProps.innerParams.set(this, updatedParams);
    Object.defineProperties(this, {
      params: {
        value: Object.assign({}, this.params, params),
        writable: false,
        enumerable: true
      }
    });
  }

  const filterValidParams = params => {
    const validUpdatableParams = {};
    Object.keys(params).forEach(param => {
      if (isUpdatableParameter(param)) {
        validUpdatableParams[param] = params[param];
      } else {
        warn("Invalid parameter to update: ".concat(param));
      }
    });
    return validUpdatableParams;
  };

  function _destroy() {
    const domCache = privateProps.domCache.get(this);
    const innerParams = privateProps.innerParams.get(this);

    if (!innerParams) {
      disposeWeakMaps(this); // The WeakMaps might have been partly destroyed, we must recall it to dispose any remaining WeakMaps #2335

      return; // This instance has already been destroyed
    } // Check if there is another Swal closing


    if (domCache.popup && globalState.swalCloseEventFinishedCallback) {
      globalState.swalCloseEventFinishedCallback();
      delete globalState.swalCloseEventFinishedCallback;
    }

    if (typeof innerParams.didDestroy === 'function') {
      innerParams.didDestroy();
    }

    disposeSwal(this);
  }
  /**
   * @param {SweetAlert2} instance
   */

  const disposeSwal = instance => {
    disposeWeakMaps(instance); // Unset this.params so GC will dispose it (#1569)
    // @ts-ignore

    delete instance.params; // Unset globalState props so GC will dispose globalState (#1569)

    delete globalState.keydownHandler;
    delete globalState.keydownTarget; // Unset currentInstance

    delete globalState.currentInstance;
  };
  /**
   * @param {SweetAlert2} instance
   */


  const disposeWeakMaps = instance => {
    // If the current instance is awaiting a promise result, we keep the privateMethods to call them once the promise result is retrieved #2335
    // @ts-ignore
    if (instance.isAwaitingPromise()) {
      unsetWeakMaps(privateProps, instance);
      privateProps.awaitingPromise.set(instance, true);
    } else {
      unsetWeakMaps(privateMethods, instance);
      unsetWeakMaps(privateProps, instance);
    }
  };
  /**
   * @param {object} obj
   * @param {SweetAlert2} instance
   */


  const unsetWeakMaps = (obj, instance) => {
    for (const i in obj) {
      obj[i].delete(instance);
    }
  };



  var instanceMethods = /*#__PURE__*/Object.freeze({
    hideLoading: hideLoading,
    disableLoading: hideLoading,
    getInput: getInput$1,
    close: close,
    isAwaitingPromise: isAwaitingPromise,
    rejectPromise: rejectPromise,
    handleAwaitingPromise: handleAwaitingPromise,
    closePopup: close,
    closeModal: close,
    closeToast: close,
    enableButtons: enableButtons,
    disableButtons: disableButtons,
    enableInput: enableInput,
    disableInput: disableInput,
    showValidationMessage: showValidationMessage,
    resetValidationMessage: resetValidationMessage$1,
    getProgressSteps: getProgressSteps$1,
    update: update,
    _destroy: _destroy
  });

  /**
   * Shows loader (spinner), this is useful with AJAX requests.
   * By default the loader be shown instead of the "Confirm" button.
   */

  const showLoading = buttonToReplace => {
    let popup = getPopup();

    if (!popup) {
      new Swal(); // eslint-disable-line no-new
    }

    popup = getPopup();
    const loader = getLoader();

    if (isToast()) {
      hide(getIcon());
    } else {
      replaceButton(popup, buttonToReplace);
    }

    show(loader);
    popup.setAttribute('data-loading', 'true');
    popup.setAttribute('aria-busy', 'true');
    popup.focus();
  };

  const replaceButton = (popup, buttonToReplace) => {
    const actions = getActions();
    const loader = getLoader();

    if (!buttonToReplace && isVisible(getConfirmButton())) {
      buttonToReplace = getConfirmButton();
    }

    show(actions);

    if (buttonToReplace) {
      hide(buttonToReplace);
      loader.setAttribute('data-button-to-replace', buttonToReplace.className);
    }

    loader.parentNode.insertBefore(loader, buttonToReplace);
    addClass([popup, actions], swalClasses.loading);
  };

  const handleInputOptionsAndValue = (instance, params) => {
    if (params.input === 'select' || params.input === 'radio') {
      handleInputOptions(instance, params);
    } else if (['text', 'email', 'number', 'tel', 'textarea'].includes(params.input) && (hasToPromiseFn(params.inputValue) || isPromise(params.inputValue))) {
      showLoading(getConfirmButton());
      handleInputValue(instance, params);
    }
  };
  const getInputValue = (instance, innerParams) => {
    const input = instance.getInput();

    if (!input) {
      return null;
    }

    switch (innerParams.input) {
      case 'checkbox':
        return getCheckboxValue(input);

      case 'radio':
        return getRadioValue(input);

      case 'file':
        return getFileValue(input);

      default:
        return innerParams.inputAutoTrim ? input.value.trim() : input.value;
    }
  };

  const getCheckboxValue = input => input.checked ? 1 : 0;

  const getRadioValue = input => input.checked ? input.value : null;

  const getFileValue = input => input.files.length ? input.getAttribute('multiple') !== null ? input.files : input.files[0] : null;

  const handleInputOptions = (instance, params) => {
    const popup = getPopup();

    const processInputOptions = inputOptions => populateInputOptions[params.input](popup, formatInputOptions(inputOptions), params);

    if (hasToPromiseFn(params.inputOptions) || isPromise(params.inputOptions)) {
      showLoading(getConfirmButton());
      asPromise(params.inputOptions).then(inputOptions => {
        instance.hideLoading();
        processInputOptions(inputOptions);
      });
    } else if (typeof params.inputOptions === 'object') {
      processInputOptions(params.inputOptions);
    } else {
      error("Unexpected type of inputOptions! Expected object, Map or Promise, got ".concat(typeof params.inputOptions));
    }
  };

  const handleInputValue = (instance, params) => {
    const input = instance.getInput();
    hide(input);
    asPromise(params.inputValue).then(inputValue => {
      input.value = params.input === 'number' ? parseFloat(inputValue) || 0 : "".concat(inputValue);
      show(input);
      input.focus();
      instance.hideLoading();
    }).catch(err => {
      error("Error in inputValue promise: ".concat(err));
      input.value = '';
      show(input);
      input.focus();
      instance.hideLoading();
    });
  };

  const populateInputOptions = {
    select: (popup, inputOptions, params) => {
      const select = getDirectChildByClass(popup, swalClasses.select);

      const renderOption = (parent, optionLabel, optionValue) => {
        const option = document.createElement('option');
        option.value = optionValue;
        setInnerHtml(option, optionLabel);
        option.selected = isSelected(optionValue, params.inputValue);
        parent.appendChild(option);
      };

      inputOptions.forEach(inputOption => {
        const optionValue = inputOption[0];
        const optionLabel = inputOption[1]; // <optgroup> spec:
        // https://www.w3.org/TR/html401/interact/forms.html#h-17.6
        // "...all OPTGROUP elements must be specified directly within a SELECT element (i.e., groups may not be nested)..."
        // check whether this is a <optgroup>

        if (Array.isArray(optionLabel)) {
          // if it is an array, then it is an <optgroup>
          const optgroup = document.createElement('optgroup');
          optgroup.label = optionValue;
          optgroup.disabled = false; // not configurable for now

          select.appendChild(optgroup);
          optionLabel.forEach(o => renderOption(optgroup, o[1], o[0]));
        } else {
          // case of <option>
          renderOption(select, optionLabel, optionValue);
        }
      });
      select.focus();
    },
    radio: (popup, inputOptions, params) => {
      const radio = getDirectChildByClass(popup, swalClasses.radio);
      inputOptions.forEach(inputOption => {
        const radioValue = inputOption[0];
        const radioLabel = inputOption[1];
        const radioInput = document.createElement('input');
        const radioLabelElement = document.createElement('label');
        radioInput.type = 'radio';
        radioInput.name = swalClasses.radio;
        radioInput.value = radioValue;

        if (isSelected(radioValue, params.inputValue)) {
          radioInput.checked = true;
        }

        const label = document.createElement('span');
        setInnerHtml(label, radioLabel);
        label.className = swalClasses.label;
        radioLabelElement.appendChild(radioInput);
        radioLabelElement.appendChild(label);
        radio.appendChild(radioLabelElement);
      });
      const radios = radio.querySelectorAll('input');

      if (radios.length) {
        radios[0].focus();
      }
    }
  };
  /**
   * Converts `inputOptions` into an array of `[value, label]`s
   * @param inputOptions
   */

  const formatInputOptions = inputOptions => {
    const result = [];

    if (typeof Map !== 'undefined' && inputOptions instanceof Map) {
      inputOptions.forEach((value, key) => {
        let valueFormatted = value;

        if (typeof valueFormatted === 'object') {
          // case of <optgroup>
          valueFormatted = formatInputOptions(valueFormatted);
        }

        result.push([key, valueFormatted]);
      });
    } else {
      Object.keys(inputOptions).forEach(key => {
        let valueFormatted = inputOptions[key];

        if (typeof valueFormatted === 'object') {
          // case of <optgroup>
          valueFormatted = formatInputOptions(valueFormatted);
        }

        result.push([key, valueFormatted]);
      });
    }

    return result;
  };

  const isSelected = (optionValue, inputValue) => {
    return inputValue && inputValue.toString() === optionValue.toString();
  };

  /**
   * @param {SweetAlert2} instance
   */

  const handleConfirmButtonClick = instance => {
    const innerParams = privateProps.innerParams.get(instance);
    instance.disableButtons();

    if (innerParams.input) {
      handleConfirmOrDenyWithInput(instance, 'confirm');
    } else {
      confirm(instance, true);
    }
  };
  /**
   * @param {SweetAlert2} instance
   */

  const handleDenyButtonClick = instance => {
    const innerParams = privateProps.innerParams.get(instance);
    instance.disableButtons();

    if (innerParams.returnInputValueOnDeny) {
      handleConfirmOrDenyWithInput(instance, 'deny');
    } else {
      deny(instance, false);
    }
  };
  /**
   * @param {SweetAlert2} instance
   * @param {Function} dismissWith
   */

  const handleCancelButtonClick = (instance, dismissWith) => {
    instance.disableButtons();
    dismissWith(DismissReason.cancel);
  };
  /**
   * @param {SweetAlert2} instance
   * @param {'confirm' | 'deny'} type
   */

  const handleConfirmOrDenyWithInput = (instance, type) => {
    const innerParams = privateProps.innerParams.get(instance);

    if (!innerParams.input) {
      error("The \"input\" parameter is needed to be set when using returnInputValueOn".concat(capitalizeFirstLetter(type)));
      return;
    }

    const inputValue = getInputValue(instance, innerParams);

    if (innerParams.inputValidator) {
      handleInputValidator(instance, inputValue, type);
    } else if (!instance.getInput().checkValidity()) {
      instance.enableButtons();
      instance.showValidationMessage(innerParams.validationMessage);
    } else if (type === 'deny') {
      deny(instance, inputValue);
    } else {
      confirm(instance, inputValue);
    }
  };
  /**
   * @param {SweetAlert2} instance
   * @param {string} inputValue
   * @param {'confirm' | 'deny'} type
   */


  const handleInputValidator = (instance, inputValue, type) => {
    const innerParams = privateProps.innerParams.get(instance);
    instance.disableInput();
    const validationPromise = Promise.resolve().then(() => asPromise(innerParams.inputValidator(inputValue, innerParams.validationMessage)));
    validationPromise.then(validationMessage => {
      instance.enableButtons();
      instance.enableInput();

      if (validationMessage) {
        instance.showValidationMessage(validationMessage);
      } else if (type === 'deny') {
        deny(instance, inputValue);
      } else {
        confirm(instance, inputValue);
      }
    });
  };
  /**
   * @param {SweetAlert2} instance
   * @param {any} value
   */


  const deny = (instance, value) => {
    const innerParams = privateProps.innerParams.get(instance || undefined);

    if (innerParams.showLoaderOnDeny) {
      showLoading(getDenyButton());
    }

    if (innerParams.preDeny) {
      privateProps.awaitingPromise.set(instance || undefined, true); // Flagging the instance as awaiting a promise so it's own promise's reject/resolve methods doesn't get destroyed until the result from this preDeny's promise is received

      const preDenyPromise = Promise.resolve().then(() => asPromise(innerParams.preDeny(value, innerParams.validationMessage)));
      preDenyPromise.then(preDenyValue => {
        if (preDenyValue === false) {
          instance.hideLoading();
          handleAwaitingPromise(instance);
        } else {
          instance.close({
            isDenied: true,
            value: typeof preDenyValue === 'undefined' ? value : preDenyValue
          });
        }
      }).catch(error$$1 => rejectWith(instance || undefined, error$$1));
    } else {
      instance.close({
        isDenied: true,
        value
      });
    }
  };
  /**
   * @param {SweetAlert2} instance
   * @param {any} value
   */


  const succeedWith = (instance, value) => {
    instance.close({
      isConfirmed: true,
      value
    });
  };
  /**
   *
   * @param {SweetAlert2} instance
   * @param {string} error
   */


  const rejectWith = (instance, error$$1) => {
    // @ts-ignore
    instance.rejectPromise(error$$1);
  };
  /**
   *
   * @param {SweetAlert2} instance
   * @param {any} value
   */


  const confirm = (instance, value) => {
    const innerParams = privateProps.innerParams.get(instance || undefined);

    if (innerParams.showLoaderOnConfirm) {
      showLoading();
    }

    if (innerParams.preConfirm) {
      instance.resetValidationMessage();
      privateProps.awaitingPromise.set(instance || undefined, true); // Flagging the instance as awaiting a promise so it's own promise's reject/resolve methods doesn't get destroyed until the result from this preConfirm's promise is received

      const preConfirmPromise = Promise.resolve().then(() => asPromise(innerParams.preConfirm(value, innerParams.validationMessage)));
      preConfirmPromise.then(preConfirmValue => {
        if (isVisible(getValidationMessage()) || preConfirmValue === false) {
          instance.hideLoading();
          handleAwaitingPromise(instance);
        } else {
          succeedWith(instance, typeof preConfirmValue === 'undefined' ? value : preConfirmValue);
        }
      }).catch(error$$1 => rejectWith(instance || undefined, error$$1));
    } else {
      succeedWith(instance, value);
    }
  };

  const handlePopupClick = (instance, domCache, dismissWith) => {
    const innerParams = privateProps.innerParams.get(instance);

    if (innerParams.toast) {
      handleToastClick(instance, domCache, dismissWith);
    } else {
      // Ignore click events that had mousedown on the popup but mouseup on the container
      // This can happen when the user drags a slider
      handleModalMousedown(domCache); // Ignore click events that had mousedown on the container but mouseup on the popup

      handleContainerMousedown(domCache);
      handleModalClick(instance, domCache, dismissWith);
    }
  };

  const handleToastClick = (instance, domCache, dismissWith) => {
    // Closing toast by internal click
    domCache.popup.onclick = () => {
      const innerParams = privateProps.innerParams.get(instance);

      if (innerParams && (isAnyButtonShown(innerParams) || innerParams.timer || innerParams.input)) {
        return;
      }

      dismissWith(DismissReason.close);
    };
  };
  /**
   * @param {*} innerParams
   * @returns {boolean}
   */


  const isAnyButtonShown = innerParams => {
    return innerParams.showConfirmButton || innerParams.showDenyButton || innerParams.showCancelButton || innerParams.showCloseButton;
  };

  let ignoreOutsideClick = false;

  const handleModalMousedown = domCache => {
    domCache.popup.onmousedown = () => {
      domCache.container.onmouseup = function (e) {
        domCache.container.onmouseup = undefined; // We only check if the mouseup target is the container because usually it doesn't
        // have any other direct children aside of the popup

        if (e.target === domCache.container) {
          ignoreOutsideClick = true;
        }
      };
    };
  };

  const handleContainerMousedown = domCache => {
    domCache.container.onmousedown = () => {
      domCache.popup.onmouseup = function (e) {
        domCache.popup.onmouseup = undefined; // We also need to check if the mouseup target is a child of the popup

        if (e.target === domCache.popup || domCache.popup.contains(e.target)) {
          ignoreOutsideClick = true;
        }
      };
    };
  };

  const handleModalClick = (instance, domCache, dismissWith) => {
    domCache.container.onclick = e => {
      const innerParams = privateProps.innerParams.get(instance);

      if (ignoreOutsideClick) {
        ignoreOutsideClick = false;
        return;
      }

      if (e.target === domCache.container && callIfFunction(innerParams.allowOutsideClick)) {
        dismissWith(DismissReason.backdrop);
      }
    };
  };

  const isJqueryElement = elem => typeof elem === 'object' && elem.jquery;

  const isElement = elem => elem instanceof Element || isJqueryElement(elem);

  const argsToParams = args => {
    const params = {};

    if (typeof args[0] === 'object' && !isElement(args[0])) {
      Object.assign(params, args[0]);
    } else {
      ['title', 'html', 'icon'].forEach((name, index) => {
        const arg = args[index];

        if (typeof arg === 'string' || isElement(arg)) {
          params[name] = arg;
        } else if (arg !== undefined) {
          error("Unexpected type of ".concat(name, "! Expected \"string\" or \"Element\", got ").concat(typeof arg));
        }
      });
    }

    return params;
  };

  function fire() {
    const Swal = this; // eslint-disable-line @typescript-eslint/no-this-alias

    for (var _len = arguments.length, args = new Array(_len), _key = 0; _key < _len; _key++) {
      args[_key] = arguments[_key];
    }

    return new Swal(...args);
  }

  /**
   * Returns an extended version of `Swal` containing `params` as defaults.
   * Useful for reusing Swal configuration.
   *
   * For example:
   *
   * Before:
   * const textPromptOptions = { input: 'text', showCancelButton: true }
   * const {value: firstName} = await Swal.fire({ ...textPromptOptions, title: 'What is your first name?' })
   * const {value: lastName} = await Swal.fire({ ...textPromptOptions, title: 'What is your last name?' })
   *
   * After:
   * const TextPrompt = Swal.mixin({ input: 'text', showCancelButton: true })
   * const {value: firstName} = await TextPrompt('What is your first name?')
   * const {value: lastName} = await TextPrompt('What is your last name?')
   *
   * @param mixinParams
   */
  function mixin(mixinParams) {
    class MixinSwal extends this {
      _main(params, priorityMixinParams) {
        return super._main(params, Object.assign({}, mixinParams, priorityMixinParams));
      }

    }

    return MixinSwal;
  }

  /**
   * If `timer` parameter is set, returns number of milliseconds of timer remained.
   * Otherwise, returns undefined.
   */

  const getTimerLeft = () => {
    return globalState.timeout && globalState.timeout.getTimerLeft();
  };
  /**
   * Stop timer. Returns number of milliseconds of timer remained.
   * If `timer` parameter isn't set, returns undefined.
   */

  const stopTimer = () => {
    if (globalState.timeout) {
      stopTimerProgressBar();
      return globalState.timeout.stop();
    }
  };
  /**
   * Resume timer. Returns number of milliseconds of timer remained.
   * If `timer` parameter isn't set, returns undefined.
   */

  const resumeTimer = () => {
    if (globalState.timeout) {
      const remaining = globalState.timeout.start();
      animateTimerProgressBar(remaining);
      return remaining;
    }
  };
  /**
   * Resume timer. Returns number of milliseconds of timer remained.
   * If `timer` parameter isn't set, returns undefined.
   */

  const toggleTimer = () => {
    const timer = globalState.timeout;
    return timer && (timer.running ? stopTimer() : resumeTimer());
  };
  /**
   * Increase timer. Returns number of milliseconds of an updated timer.
   * If `timer` parameter isn't set, returns undefined.
   */

  const increaseTimer = n => {
    if (globalState.timeout) {
      const remaining = globalState.timeout.increase(n);
      animateTimerProgressBar(remaining, true);
      return remaining;
    }
  };
  /**
   * Check if timer is running. Returns true if timer is running
   * or false if timer is paused or stopped.
   * If `timer` parameter isn't set, returns undefined
   */

  const isTimerRunning = () => {
    return globalState.timeout && globalState.timeout.isRunning();
  };

  let bodyClickListenerAdded = false;
  const clickHandlers = {};
  function bindClickHandler() {
    let attr = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : 'data-swal-template';
    clickHandlers[attr] = this;

    if (!bodyClickListenerAdded) {
      document.body.addEventListener('click', bodyClickListener);
      bodyClickListenerAdded = true;
    }
  }

  const bodyClickListener = event => {
    for (let el = event.target; el && el !== document; el = el.parentNode) {
      for (const attr in clickHandlers) {
        const template = el.getAttribute(attr);

        if (template) {
          clickHandlers[attr].fire({
            template
          });
          return;
        }
      }
    }
  };



  var staticMethods = /*#__PURE__*/Object.freeze({
    isValidParameter: isValidParameter,
    isUpdatableParameter: isUpdatableParameter,
    isDeprecatedParameter: isDeprecatedParameter,
    argsToParams: argsToParams,
    isVisible: isVisible$1,
    clickConfirm: clickConfirm,
    clickDeny: clickDeny,
    clickCancel: clickCancel,
    getContainer: getContainer,
    getPopup: getPopup,
    getTitle: getTitle,
    getHtmlContainer: getHtmlContainer,
    getImage: getImage,
    getIcon: getIcon,
    getInputLabel: getInputLabel,
    getCloseButton: getCloseButton,
    getActions: getActions,
    getConfirmButton: getConfirmButton,
    getDenyButton: getDenyButton,
    getCancelButton: getCancelButton,
    getLoader: getLoader,
    getFooter: getFooter,
    getTimerProgressBar: getTimerProgressBar,
    getFocusableElements: getFocusableElements,
    getValidationMessage: getValidationMessage,
    isLoading: isLoading,
    fire: fire,
    mixin: mixin,
    showLoading: showLoading,
    enableLoading: showLoading,
    getTimerLeft: getTimerLeft,
    stopTimer: stopTimer,
    resumeTimer: resumeTimer,
    toggleTimer: toggleTimer,
    increaseTimer: increaseTimer,
    isTimerRunning: isTimerRunning,
    bindClickHandler: bindClickHandler
  });

  class Timer {
    /**
     * @param {Function} callback
     * @param {number} delay
     */
    constructor(callback, delay) {
      this.callback = callback;
      this.remaining = delay;
      this.running = false;
      this.start();
    }

    start() {
      if (!this.running) {
        this.running = true;
        this.started = new Date();
        this.id = setTimeout(this.callback, this.remaining);
      }

      return this.remaining;
    }

    stop() {
      if (this.running) {
        this.running = false;
        clearTimeout(this.id);
        this.remaining -= new Date().getTime() - this.started.getTime();
      }

      return this.remaining;
    }

    increase(n) {
      const running = this.running;

      if (running) {
        this.stop();
      }

      this.remaining += n;

      if (running) {
        this.start();
      }

      return this.remaining;
    }

    getTimerLeft() {
      if (this.running) {
        this.stop();
        this.start();
      }

      return this.remaining;
    }

    isRunning() {
      return this.running;
    }

  }

  const swalStringParams = ['swal-title', 'swal-html', 'swal-footer'];
  /**
   * @param {SweetAlertOptions} params
   * @returns {SweetAlertOptions}
   */

  const getTemplateParams = params => {
    /** @type {HTMLTemplateElement} */
    const template = typeof params.template === 'string' ? document.querySelector(params.template) : params.template;

    if (!template) {
      return {};
    }
    /** @type {DocumentFragment} */


    const templateContent = template.content;
    showWarningsForElements(templateContent);
    const result = Object.assign(getSwalParams(templateContent), getSwalButtons(templateContent), getSwalImage(templateContent), getSwalIcon(templateContent), getSwalInput(templateContent), getSwalStringParams(templateContent, swalStringParams));
    return result;
  };
  /**
   * @param {DocumentFragment} templateContent
   * @returns {SweetAlertOptions}
   */

  const getSwalParams = templateContent => {
    const result = {};
    /** @type {HTMLElement[]} */

    const swalParams = Array.from(templateContent.querySelectorAll('swal-param'));
    swalParams.forEach(param => {
      showWarningsForAttributes(param, ['name', 'value']);
      const paramName = param.getAttribute('name');
      const value = param.getAttribute('value');

      if (typeof defaultParams[paramName] === 'boolean' && value === 'false') {
        result[paramName] = false;
      }

      if (typeof defaultParams[paramName] === 'object') {
        result[paramName] = JSON.parse(value);
      }
    });
    return result;
  };
  /**
   * @param {DocumentFragment} templateContent
   * @returns {SweetAlertOptions}
   */


  const getSwalButtons = templateContent => {
    const result = {};
    /** @type {HTMLElement[]} */

    const swalButtons = Array.from(templateContent.querySelectorAll('swal-button'));
    swalButtons.forEach(button => {
      showWarningsForAttributes(button, ['type', 'color', 'aria-label']);
      const type = button.getAttribute('type');
      result["".concat(type, "ButtonText")] = button.innerHTML;
      result["show".concat(capitalizeFirstLetter(type), "Button")] = true;

      if (button.hasAttribute('color')) {
        result["".concat(type, "ButtonColor")] = button.getAttribute('color');
      }

      if (button.hasAttribute('aria-label')) {
        result["".concat(type, "ButtonAriaLabel")] = button.getAttribute('aria-label');
      }
    });
    return result;
  };
  /**
   * @param {DocumentFragment} templateContent
   * @returns {SweetAlertOptions}
   */


  const getSwalImage = templateContent => {
    const result = {};
    /** @type {HTMLElement} */

    const image = templateContent.querySelector('swal-image');

    if (image) {
      showWarningsForAttributes(image, ['src', 'width', 'height', 'alt']);

      if (image.hasAttribute('src')) {
        result.imageUrl = image.getAttribute('src');
      }

      if (image.hasAttribute('width')) {
        result.imageWidth = image.getAttribute('width');
      }

      if (image.hasAttribute('height')) {
        result.imageHeight = image.getAttribute('height');
      }

      if (image.hasAttribute('alt')) {
        result.imageAlt = image.getAttribute('alt');
      }
    }

    return result;
  };
  /**
   * @param {DocumentFragment} templateContent
   * @returns {SweetAlertOptions}
   */


  const getSwalIcon = templateContent => {
    const result = {};
    /** @type {HTMLElement} */

    const icon = templateContent.querySelector('swal-icon');

    if (icon) {
      showWarningsForAttributes(icon, ['type', 'color']);

      if (icon.hasAttribute('type')) {
        /** @type {SweetAlertIcon} */
        // @ts-ignore
        result.icon = icon.getAttribute('type');
      }

      if (icon.hasAttribute('color')) {
        result.iconColor = icon.getAttribute('color');
      }

      result.iconHtml = icon.innerHTML;
    }

    return result;
  };
  /**
   * @param {DocumentFragment} templateContent
   * @returns {SweetAlertOptions}
   */


  const getSwalInput = templateContent => {
    const result = {};
    /** @type {HTMLElement} */

    const input = templateContent.querySelector('swal-input');

    if (input) {
      showWarningsForAttributes(input, ['type', 'label', 'placeholder', 'value']);
      /** @type {SweetAlertInput} */
      // @ts-ignore

      result.input = input.getAttribute('type') || 'text';

      if (input.hasAttribute('label')) {
        result.inputLabel = input.getAttribute('label');
      }

      if (input.hasAttribute('placeholder')) {
        result.inputPlaceholder = input.getAttribute('placeholder');
      }

      if (input.hasAttribute('value')) {
        result.inputValue = input.getAttribute('value');
      }
    }
    /** @type {HTMLElement[]} */


    const inputOptions = Array.from(templateContent.querySelectorAll('swal-input-option'));

    if (inputOptions.length) {
      result.inputOptions = {};
      inputOptions.forEach(option => {
        showWarningsForAttributes(option, ['value']);
        const optionValue = option.getAttribute('value');
        const optionName = option.innerHTML;
        result.inputOptions[optionValue] = optionName;
      });
    }

    return result;
  };
  /**
   * @param {DocumentFragment} templateContent
   * @param {string[]} paramNames
   * @returns {SweetAlertOptions}
   */


  const getSwalStringParams = (templateContent, paramNames) => {
    const result = {};

    for (const i in paramNames) {
      const paramName = paramNames[i];
      /** @type {HTMLElement} */

      const tag = templateContent.querySelector(paramName);

      if (tag) {
        showWarningsForAttributes(tag, []);
        result[paramName.replace(/^swal-/, '')] = tag.innerHTML.trim();
      }
    }

    return result;
  };
  /**
   * @param {DocumentFragment} templateContent
   */


  const showWarningsForElements = templateContent => {
    const allowedElements = swalStringParams.concat(['swal-param', 'swal-button', 'swal-image', 'swal-icon', 'swal-input', 'swal-input-option']);
    Array.from(templateContent.children).forEach(el => {
      const tagName = el.tagName.toLowerCase();

      if (!allowedElements.includes(tagName)) {
        warn("Unrecognized element <".concat(tagName, ">"));
      }
    });
  };
  /**
   * @param {HTMLElement} el
   * @param {string[]} allowedAttributes
   */


  const showWarningsForAttributes = (el, allowedAttributes) => {
    Array.from(el.attributes).forEach(attribute => {
      if (allowedAttributes.indexOf(attribute.name) === -1) {
        warn(["Unrecognized attribute \"".concat(attribute.name, "\" on <").concat(el.tagName.toLowerCase(), ">."), "".concat(allowedAttributes.length ? "Allowed attributes are: ".concat(allowedAttributes.join(', ')) : 'To set the value, use HTML within the element.')]);
      }
    });
  };

  const SHOW_CLASS_TIMEOUT = 10;
  /**
   * Open popup, add necessary classes and styles, fix scrollbar
   *
   * @param {SweetAlertOptions} params
   */

  const openPopup = params => {
    const container = getContainer();
    const popup = getPopup();

    if (typeof params.willOpen === 'function') {
      params.willOpen(popup);
    }

    const bodyStyles = window.getComputedStyle(document.body);
    const initialBodyOverflow = bodyStyles.overflowY;
    addClasses$1(container, popup, params); // scrolling is 'hidden' until animation is done, after that 'auto'

    setTimeout(() => {
      setScrollingVisibility(container, popup);
    }, SHOW_CLASS_TIMEOUT);

    if (isModal()) {
      fixScrollContainer(container, params.scrollbarPadding, initialBodyOverflow);
      setAriaHidden();
    }

    if (!isToast() && !globalState.previousActiveElement) {
      globalState.previousActiveElement = document.activeElement;
    }

    if (typeof params.didOpen === 'function') {
      setTimeout(() => params.didOpen(popup));
    }

    removeClass(container, swalClasses['no-transition']);
  };
  /**
   * @param {AnimationEvent} event
   */

  const swalOpenAnimationFinished = event => {
    const popup = getPopup();

    if (event.target !== popup) {
      return;
    }

    const container = getContainer();
    popup.removeEventListener(animationEndEvent, swalOpenAnimationFinished);
    container.style.overflowY = 'auto';
  };
  /**
   * @param {HTMLElement} container
   * @param {HTMLElement} popup
   */


  const setScrollingVisibility = (container, popup) => {
    if (animationEndEvent && hasCssAnimation(popup)) {
      container.style.overflowY = 'hidden';
      popup.addEventListener(animationEndEvent, swalOpenAnimationFinished);
    } else {
      container.style.overflowY = 'auto';
    }
  };
  /**
   * @param {HTMLElement} container
   * @param {boolean} scrollbarPadding
   * @param {string} initialBodyOverflow
   */


  const fixScrollContainer = (container, scrollbarPadding, initialBodyOverflow) => {
    iOSfix();

    if (scrollbarPadding && initialBodyOverflow !== 'hidden') {
      fixScrollbar();
    } // sweetalert2/issues/1247


    setTimeout(() => {
      container.scrollTop = 0;
    });
  };
  /**
   * @param {HTMLElement} container
   * @param {HTMLElement} popup
   * @param {SweetAlertOptions} params
   */


  const addClasses$1 = (container, popup, params) => {
    addClass(container, params.showClass.backdrop); // this workaround with opacity is needed for https://github.com/sweetalert2/sweetalert2/issues/2059

    popup.style.setProperty('opacity', '0', 'important');
    show(popup, 'grid');
    setTimeout(() => {
      // Animate popup right after showing it
      addClass(popup, params.showClass.popup); // and remove the opacity workaround

      popup.style.removeProperty('opacity');
    }, SHOW_CLASS_TIMEOUT); // 10ms in order to fix #2062

    addClass([document.documentElement, document.body], swalClasses.shown);

    if (params.heightAuto && params.backdrop && !params.toast) {
      addClass([document.documentElement, document.body], swalClasses['height-auto']);
    }
  };

  var defaultInputValidators = {
    /**
     * @param {string} string
     * @param {string} validationMessage
     * @returns {Promise<void | string>}
     */
    email: (string, validationMessage) => {
      return /^[a-zA-Z0-9.+_-]+@[a-zA-Z0-9.-]+\.[a-zA-Z0-9-]{2,24}$/.test(string) ? Promise.resolve() : Promise.resolve(validationMessage || 'Invalid email address');
    },

    /**
     * @param {string} string
     * @param {string} validationMessage
     * @returns {Promise<void | string>}
     */
    url: (string, validationMessage) => {
      // taken from https://stackoverflow.com/a/3809435 with a small change from #1306 and #2013
      return /^https?:\/\/(www\.)?[-a-zA-Z0-9@:%._+~#=]{1,256}\.[a-z]{2,63}\b([-a-zA-Z0-9@:%_+.~#?&/=]*)$/.test(string) ? Promise.resolve() : Promise.resolve(validationMessage || 'Invalid URL');
    }
  };

  /**
   * @param {SweetAlertOptions} params
   */

  function setDefaultInputValidators(params) {
    // Use default `inputValidator` for supported input types if not provided
    if (!params.inputValidator) {
      Object.keys(defaultInputValidators).forEach(key => {
        if (params.input === key) {
          params.inputValidator = defaultInputValidators[key];
        }
      });
    }
  }
  /**
   * @param {SweetAlertOptions} params
   */


  function validateCustomTargetElement(params) {
    // Determine if the custom target element is valid
    if (!params.target || typeof params.target === 'string' && !document.querySelector(params.target) || typeof params.target !== 'string' && !params.target.appendChild) {
      warn('Target parameter is not valid, defaulting to "body"');
      params.target = 'body';
    }
  }
  /**
   * Set type, text and actions on popup
   *
   * @param {SweetAlertOptions} params
   */


  function setParameters(params) {
    setDefaultInputValidators(params); // showLoaderOnConfirm && preConfirm

    if (params.showLoaderOnConfirm && !params.preConfirm) {
      warn('showLoaderOnConfirm is set to true, but preConfirm is not defined.\n' + 'showLoaderOnConfirm should be used together with preConfirm, see usage example:\n' + 'https://sweetalert2.github.io/#ajax-request');
    }

    validateCustomTargetElement(params); // Replace newlines with <br> in title

    if (typeof params.title === 'string') {
      params.title = params.title.split('\n').join('<br />');
    }

    init(params);
  }

  let currentInstance;

  class SweetAlert {
    constructor() {
      // Prevent run in Node env
      if (typeof window === 'undefined') {
        return;
      }

      currentInstance = this; // @ts-ignore

      for (var _len = arguments.length, args = new Array(_len), _key = 0; _key < _len; _key++) {
        args[_key] = arguments[_key];
      }

      const outerParams = Object.freeze(this.constructor.argsToParams(args));
      Object.defineProperties(this, {
        params: {
          value: outerParams,
          writable: false,
          enumerable: true,
          configurable: true
        }
      }); // @ts-ignore

      const promise = currentInstance._main(currentInstance.params);

      privateProps.promise.set(this, promise);
    }

    _main(userParams) {
      let mixinParams = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : {};
      showWarningsForParams(Object.assign({}, mixinParams, userParams));

      if (globalState.currentInstance) {
        // @ts-ignore
        globalState.currentInstance._destroy();

        if (isModal()) {
          unsetAriaHidden();
        }
      }

      globalState.currentInstance = currentInstance;
      const innerParams = prepareParams(userParams, mixinParams);
      setParameters(innerParams);
      Object.freeze(innerParams); // clear the previous timer

      if (globalState.timeout) {
        globalState.timeout.stop();
        delete globalState.timeout;
      } // clear the restore focus timeout


      clearTimeout(globalState.restoreFocusTimeout);
      const domCache = populateDomCache(currentInstance);
      render(currentInstance, innerParams);
      privateProps.innerParams.set(currentInstance, innerParams);
      return swalPromise(currentInstance, domCache, innerParams);
    } // `catch` cannot be the name of a module export, so we define our thenable methods here instead


    then(onFulfilled) {
      const promise = privateProps.promise.get(this);
      return promise.then(onFulfilled);
    }

    finally(onFinally) {
      const promise = privateProps.promise.get(this);
      return promise.finally(onFinally);
    }

  }
  /**
   * @param {SweetAlert2} instance
   * @param {DomCache} domCache
   * @param {SweetAlertOptions} innerParams
   * @returns {Promise}
   */


  const swalPromise = (instance, domCache, innerParams) => {
    return new Promise((resolve, reject) => {
      // functions to handle all closings/dismissals

      /**
       * @param {DismissReason} dismiss
       */
      const dismissWith = dismiss => {
        // @ts-ignore
        instance.close({
          isDismissed: true,
          dismiss
        });
      };

      privateMethods.swalPromiseResolve.set(instance, resolve);
      privateMethods.swalPromiseReject.set(instance, reject);

      domCache.confirmButton.onclick = () => {
        handleConfirmButtonClick(instance);
      };

      domCache.denyButton.onclick = () => {
        handleDenyButtonClick(instance);
      };

      domCache.cancelButton.onclick = () => {
        handleCancelButtonClick(instance, dismissWith);
      };

      domCache.closeButton.onclick = () => {
        // @ts-ignore
        dismissWith(DismissReason.close);
      };

      handlePopupClick(instance, domCache, dismissWith);
      addKeydownHandler(instance, globalState, innerParams, dismissWith);
      handleInputOptionsAndValue(instance, innerParams);
      openPopup(innerParams);
      setupTimer(globalState, innerParams, dismissWith);
      initFocus(domCache, innerParams); // Scroll container to top on open (#1247, #1946)

      setTimeout(() => {
        domCache.container.scrollTop = 0;
      });
    });
  };
  /**
   * @param {SweetAlertOptions} userParams
   * @param {SweetAlertOptions} mixinParams
   * @returns {SweetAlertOptions}
   */


  const prepareParams = (userParams, mixinParams) => {
    const templateParams = getTemplateParams(userParams);
    const params = Object.assign({}, defaultParams, mixinParams, templateParams, userParams); // precedence is described in #2131

    params.showClass = Object.assign({}, defaultParams.showClass, params.showClass);
    params.hideClass = Object.assign({}, defaultParams.hideClass, params.hideClass);
    return params;
  };
  /**
   * @param {SweetAlert2} instance
   * @returns {DomCache}
   */


  const populateDomCache = instance => {
    const domCache = {
      popup: getPopup(),
      container: getContainer(),
      actions: getActions(),
      confirmButton: getConfirmButton(),
      denyButton: getDenyButton(),
      cancelButton: getCancelButton(),
      loader: getLoader(),
      closeButton: getCloseButton(),
      validationMessage: getValidationMessage(),
      progressSteps: getProgressSteps()
    };
    privateProps.domCache.set(instance, domCache);
    return domCache;
  };
  /**
   * @param {GlobalState} globalState
   * @param {SweetAlertOptions} innerParams
   * @param {Function} dismissWith
   */


  const setupTimer = (globalState$$1, innerParams, dismissWith) => {
    const timerProgressBar = getTimerProgressBar();
    hide(timerProgressBar);

    if (innerParams.timer) {
      globalState$$1.timeout = new Timer(() => {
        dismissWith('timer');
        delete globalState$$1.timeout;
      }, innerParams.timer);

      if (innerParams.timerProgressBar) {
        show(timerProgressBar);
        applyCustomClass(timerProgressBar, innerParams, 'timerProgressBar');
        setTimeout(() => {
          if (globalState$$1.timeout && globalState$$1.timeout.running) {
            // timer can be already stopped or unset at this point
            animateTimerProgressBar(innerParams.timer);
          }
        });
      }
    }
  };
  /**
   * @param {DomCache} domCache
   * @param {SweetAlertOptions} innerParams
   */


  const initFocus = (domCache, innerParams) => {
    if (innerParams.toast) {
      return;
    }

    if (!callIfFunction(innerParams.allowEnterKey)) {
      blurActiveElement();
      return;
    }

    if (!focusButton(domCache, innerParams)) {
      setFocus(innerParams, -1, 1);
    }
  };
  /**
   * @param {DomCache} domCache
   * @param {SweetAlertOptions} innerParams
   * @returns {boolean}
   */


  const focusButton = (domCache, innerParams) => {
    if (innerParams.focusDeny && isVisible(domCache.denyButton)) {
      domCache.denyButton.focus();
      return true;
    }

    if (innerParams.focusCancel && isVisible(domCache.cancelButton)) {
      domCache.cancelButton.focus();
      return true;
    }

    if (innerParams.focusConfirm && isVisible(domCache.confirmButton)) {
      domCache.confirmButton.focus();
      return true;
    }

    return false;
  };

  const blurActiveElement = () => {
    if (document.activeElement instanceof HTMLElement && typeof document.activeElement.blur === 'function') {
      document.activeElement.blur();
    }
  }; // This anti-war message will only be shown to Russian users visiting Russian sites


  if (typeof window !== 'undefined' && /^ru\b/.test(navigator.language) && location.host.match(/\.(ru|su|xn--p1ai)$/)) {
    if (Math.random() < 0.1) {
      const noWar = document.createElement('div');
      noWar.className = 'leave-russia-now-and-apply-your-skills-to-the-world';
      const video = getRandomElement([{
        text: "\u0412 \u043D\u0438\u0436\u0435\u043F\u0440\u0438\u0432\u0435\u0434\u0451\u043D\u043D\u043E\u043C \u0432\u0438\u0434\u0435\u043E \u043E\u0431\u044A\u044F\u0441\u043D\u044F\u0435\u0442\u0441\u044F \u043A\u0430\u043A \u043A\u0430\u0436\u0434\u044B\u0439 \u0438\u0437 \u043D\u0430\u0441 \u043C\u043E\u0436\u0435\u0442 \u043F\u043E\u043C\u043E\u0447\u044C \u0432 \u0442\u043E\u043C,\n        <strong>\u0447\u0442\u043E\u0431\u044B \u044D\u0442\u0430 \u0431\u0435\u0441\u0441\u043C\u044B\u0441\u043B\u0435\u043D\u043D\u0430\u044F \u0438 \u0431\u0435\u0441\u0447\u0435\u043B\u043E\u0432\u0435\u0447\u043D\u0430\u044F \u0432\u043E\u0439\u043D\u0430 \u043E\u0441\u0442\u0430\u043D\u043E\u0432\u0438\u043B\u0430\u0441\u044C</strong>:",
        id: '4CfDhaRkw7I'
      }, {
        text: 'Эмпатия - главное <strong>человеческое</strong> чувство. Способность сопереживать. <strong>Способность поставить себя на место другого.</strong>',
        id: 's-GLAIY4DXA'
      }]);
      setInnerHtml(noWar, "\n      <div>\n        \u0415\u0441\u043B\u0438 \u043C\u044B \u043D\u0435 \u043E\u0441\u0442\u0430\u043D\u043E\u0432\u0438\u043C \u0432\u043E\u0439\u043D\u0443, \u043E\u043D\u0430 \u043F\u0440\u0438\u0434\u0435\u0442 \u0432 \u0434\u043E\u043C <strong>\u043A\u0430\u0436\u0434\u043E\u0433\u043E \u0438\u0437 \u043D\u0430\u0441</strong> \u0438 \u0435\u0451 \u043F\u043E\u0441\u043B\u0435\u0434\u0441\u0442\u0432\u0438\u044F \u0431\u0443\u0434\u0443\u0442 <strong>\u0443\u0436\u0430\u0441\u0430\u044E\u0449\u0438\u043C\u0438</strong>.\n      </div>\n      <div>\n        \u041F\u0443\u0442\u0438\u043D\u0441\u043A\u0438\u0439 \u0440\u0435\u0436\u0438\u043C \u0437\u0430 20 \u0441 \u043B\u0438\u0448\u043D\u0438\u043C \u043B\u0435\u0442 \u0441\u0432\u043E\u0435\u0433\u043E \u0441\u0443\u0449\u0435\u0441\u0442\u0432\u043E\u0432\u0430\u043D\u0438\u044F \u0432\u0434\u043E\u043B\u0431\u0438\u043B \u043D\u0430\u043C, \u0447\u0442\u043E \u043C\u044B \u0431\u0435\u0441\u0441\u0438\u043B\u044C\u043D\u044B \u0438 \u043E\u0434\u0438\u043D \u0447\u0435\u043B\u043E\u0432\u0435\u043A \u043D\u0435 \u043C\u043E\u0436\u0435\u0442 \u043D\u0438\u0447\u0435\u0433\u043E \u0441\u0434\u0435\u043B\u0430\u0442\u044C. <strong>\u042D\u0442\u043E \u043D\u0435 \u0442\u0430\u043A!</strong>\n      </div>\n      <div>\n        ".concat(video.text, "\n      </div>\n      <iframe width=\"560\" height=\"315\" src=\"https://www.youtube.com/embed/").concat(video.id, "\" frameborder=\"0\" allow=\"accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture\" allowfullscreen></iframe>\n      <div>\n        \u041D\u0435\u0442 \u0432\u043E\u0439\u043D\u0435!\n      </div>\n      "));
      const closeButton = document.createElement('button');
      closeButton.innerHTML = '&times;';

      closeButton.onclick = () => noWar.remove();

      noWar.appendChild(closeButton);
      window.addEventListener('load', () => {
        setTimeout(() => {
          document.body.appendChild(noWar);
        }, 1000);
      });
    }
  } // Assign instance methods from src/instanceMethods/*.js to prototype


  Object.assign(SweetAlert.prototype, instanceMethods); // Assign static methods from src/staticMethods/*.js to constructor

  Object.assign(SweetAlert, staticMethods); // Proxy to instance methods to constructor, for now, for backwards compatibility

  Object.keys(instanceMethods).forEach(key => {
    /**
     * @param {...any} args
     * @returns {any}
     */
    SweetAlert[key] = function () {
      if (currentInstance) {
        return currentInstance[key](...arguments);
      }
    };
  });
  SweetAlert.DismissReason = DismissReason;
  SweetAlert.version = '11.4.33';

  const Swal = SweetAlert; // @ts-ignore

  Swal.default = Swal;

  return Swal;

}));
if (typeof this !== 'undefined' && this.Sweetalert2){  this.swal = this.sweetAlert = this.Swal = this.SweetAlert = this.Sweetalert2}

"undefined"!=typeof document&&function(e,t){var n=e.createElement("style");if(e.getElementsByTagName("head")[0].appendChild(n),n.styleSheet)n.styleSheet.disabled||(n.styleSheet.cssText=t);else try{n.innerHTML=t}catch(e){n.innerText=t}}(document,".swal2-popup.swal2-toast{box-sizing:border-box;grid-column:1/4!important;grid-row:1/4!important;grid-template-columns:1fr 99fr 1fr;padding:1em;overflow-y:hidden;background:#fff;box-shadow:0 0 1px hsla(0deg,0%,0%,.075),0 1px 2px hsla(0deg,0%,0%,.075),1px 2px 4px hsla(0deg,0%,0%,.075),1px 3px 8px hsla(0deg,0%,0%,.075),2px 4px 16px hsla(0deg,0%,0%,.075);pointer-events:all}.swal2-popup.swal2-toast>*{grid-column:2}.swal2-popup.swal2-toast .swal2-title{margin:.5em 1em;padding:0;font-size:1em;text-align:initial}.swal2-popup.swal2-toast .swal2-loading{justify-content:center}.swal2-popup.swal2-toast .swal2-input{height:2em;margin:.5em;font-size:1em}.swal2-popup.swal2-toast .swal2-validation-message{font-size:1em}.swal2-popup.swal2-toast .swal2-footer{margin:.5em 0 0;padding:.5em 0 0;font-size:.8em}.swal2-popup.swal2-toast .swal2-close{grid-column:3/3;grid-row:1/99;align-self:center;width:.8em;height:.8em;margin:0;font-size:2em}.swal2-popup.swal2-toast .swal2-html-container{margin:.5em 1em;padding:0;overflow:initial;font-size:1em;text-align:initial}.swal2-popup.swal2-toast .swal2-html-container:empty{padding:0}.swal2-popup.swal2-toast .swal2-loader{grid-column:1;grid-row:1/99;align-self:center;width:2em;height:2em;margin:.25em}.swal2-popup.swal2-toast .swal2-icon{grid-column:1;grid-row:1/99;align-self:center;width:2em;min-width:2em;height:2em;margin:0 .5em 0 0}.swal2-popup.swal2-toast .swal2-icon .swal2-icon-content{display:flex;align-items:center;font-size:1.8em;font-weight:700}.swal2-popup.swal2-toast .swal2-icon.swal2-success .swal2-success-ring{width:2em;height:2em}.swal2-popup.swal2-toast .swal2-icon.swal2-error [class^=swal2-x-mark-line]{top:.875em;width:1.375em}.swal2-popup.swal2-toast .swal2-icon.swal2-error [class^=swal2-x-mark-line][class$=left]{left:.3125em}.swal2-popup.swal2-toast .swal2-icon.swal2-error [class^=swal2-x-mark-line][class$=right]{right:.3125em}.swal2-popup.swal2-toast .swal2-actions{justify-content:flex-start;height:auto;margin:0;margin-top:.5em;padding:0 .5em}.swal2-popup.swal2-toast .swal2-styled{margin:.25em .5em;padding:.4em .6em;font-size:1em}.swal2-popup.swal2-toast .swal2-success{border-color:#a5dc86}.swal2-popup.swal2-toast .swal2-success [class^=swal2-success-circular-line]{position:absolute;width:1.6em;height:3em;transform:rotate(45deg);border-radius:50%}.swal2-popup.swal2-toast .swal2-success [class^=swal2-success-circular-line][class$=left]{top:-.8em;left:-.5em;transform:rotate(-45deg);transform-origin:2em 2em;border-radius:4em 0 0 4em}.swal2-popup.swal2-toast .swal2-success [class^=swal2-success-circular-line][class$=right]{top:-.25em;left:.9375em;transform-origin:0 1.5em;border-radius:0 4em 4em 0}.swal2-popup.swal2-toast .swal2-success .swal2-success-ring{width:2em;height:2em}.swal2-popup.swal2-toast .swal2-success .swal2-success-fix{top:0;left:.4375em;width:.4375em;height:2.6875em}.swal2-popup.swal2-toast .swal2-success [class^=swal2-success-line]{height:.3125em}.swal2-popup.swal2-toast .swal2-success [class^=swal2-success-line][class$=tip]{top:1.125em;left:.1875em;width:.75em}.swal2-popup.swal2-toast .swal2-success [class^=swal2-success-line][class$=long]{top:.9375em;right:.1875em;width:1.375em}.swal2-popup.swal2-toast .swal2-success.swal2-icon-show .swal2-success-line-tip{-webkit-animation:swal2-toast-animate-success-line-tip .75s;animation:swal2-toast-animate-success-line-tip .75s}.swal2-popup.swal2-toast .swal2-success.swal2-icon-show .swal2-success-line-long{-webkit-animation:swal2-toast-animate-success-line-long .75s;animation:swal2-toast-animate-success-line-long .75s}.swal2-popup.swal2-toast.swal2-show{-webkit-animation:swal2-toast-show .5s;animation:swal2-toast-show .5s}.swal2-popup.swal2-toast.swal2-hide{-webkit-animation:swal2-toast-hide .1s forwards;animation:swal2-toast-hide .1s forwards}.swal2-container{display:grid;position:fixed;z-index:1060;top:0;right:0;bottom:0;left:0;box-sizing:border-box;grid-template-areas:\"top-start     top            top-end\" \"center-start  center         center-end\" \"bottom-start  bottom-center  bottom-end\";grid-template-rows:minmax(-webkit-min-content,auto) minmax(-webkit-min-content,auto) minmax(-webkit-min-content,auto);grid-template-rows:minmax(min-content,auto) minmax(min-content,auto) minmax(min-content,auto);height:100%;padding:.625em;overflow-x:hidden;transition:background-color .1s;-webkit-overflow-scrolling:touch}.swal2-container.swal2-backdrop-show,.swal2-container.swal2-noanimation{background:rgba(0,0,0,.4)}.swal2-container.swal2-backdrop-hide{background:0 0!important}.swal2-container.swal2-bottom-start,.swal2-container.swal2-center-start,.swal2-container.swal2-top-start{grid-template-columns:minmax(0,1fr) auto auto}.swal2-container.swal2-bottom,.swal2-container.swal2-center,.swal2-container.swal2-top{grid-template-columns:auto minmax(0,1fr) auto}.swal2-container.swal2-bottom-end,.swal2-container.swal2-center-end,.swal2-container.swal2-top-end{grid-template-columns:auto auto minmax(0,1fr)}.swal2-container.swal2-top-start>.swal2-popup{align-self:start}.swal2-container.swal2-top>.swal2-popup{grid-column:2;align-self:start;justify-self:center}.swal2-container.swal2-top-end>.swal2-popup,.swal2-container.swal2-top-right>.swal2-popup{grid-column:3;align-self:start;justify-self:end}.swal2-container.swal2-center-left>.swal2-popup,.swal2-container.swal2-center-start>.swal2-popup{grid-row:2;align-self:center}.swal2-container.swal2-center>.swal2-popup{grid-column:2;grid-row:2;align-self:center;justify-self:center}.swal2-container.swal2-center-end>.swal2-popup,.swal2-container.swal2-center-right>.swal2-popup{grid-column:3;grid-row:2;align-self:center;justify-self:end}.swal2-container.swal2-bottom-left>.swal2-popup,.swal2-container.swal2-bottom-start>.swal2-popup{grid-column:1;grid-row:3;align-self:end}.swal2-container.swal2-bottom>.swal2-popup{grid-column:2;grid-row:3;justify-self:center;align-self:end}.swal2-container.swal2-bottom-end>.swal2-popup,.swal2-container.swal2-bottom-right>.swal2-popup{grid-column:3;grid-row:3;align-self:end;justify-self:end}.swal2-container.swal2-grow-fullscreen>.swal2-popup,.swal2-container.swal2-grow-row>.swal2-popup{grid-column:1/4;width:100%}.swal2-container.swal2-grow-column>.swal2-popup,.swal2-container.swal2-grow-fullscreen>.swal2-popup{grid-row:1/4;align-self:stretch}.swal2-container.swal2-no-transition{transition:none!important}.swal2-popup{display:none;position:relative;box-sizing:border-box;grid-template-columns:minmax(0,100%);width:32em;max-width:100%;padding:0 0 1.25em;border:none;border-radius:5px;background:#fff;color:#545454;font-family:inherit;font-size:1rem}.swal2-popup:focus{outline:0}.swal2-popup.swal2-loading{overflow-y:hidden}.swal2-title{position:relative;max-width:100%;margin:0;padding:.8em 1em 0;color:inherit;font-size:1.875em;font-weight:600;text-align:center;text-transform:none;word-wrap:break-word}.swal2-actions{display:flex;z-index:1;box-sizing:border-box;flex-wrap:wrap;align-items:center;justify-content:center;width:auto;margin:1.25em auto 0;padding:0}.swal2-actions:not(.swal2-loading) .swal2-styled[disabled]{opacity:.4}.swal2-actions:not(.swal2-loading) .swal2-styled:hover{background-image:linear-gradient(rgba(0,0,0,.1),rgba(0,0,0,.1))}.swal2-actions:not(.swal2-loading) .swal2-styled:active{background-image:linear-gradient(rgba(0,0,0,.2),rgba(0,0,0,.2))}.swal2-loader{display:none;align-items:center;justify-content:center;width:2.2em;height:2.2em;margin:0 1.875em;-webkit-animation:swal2-rotate-loading 1.5s linear 0s infinite normal;animation:swal2-rotate-loading 1.5s linear 0s infinite normal;border-width:.25em;border-style:solid;border-radius:100%;border-color:#2778c4 transparent #2778c4 transparent}.swal2-styled{margin:.3125em;padding:.625em 1.1em;transition:box-shadow .1s;box-shadow:0 0 0 3px transparent;font-weight:500}.swal2-styled:not([disabled]){cursor:pointer}.swal2-styled.swal2-confirm{border:0;border-radius:.25em;background:initial;background-color:#7066e0;color:#fff;font-size:1em}.swal2-styled.swal2-confirm:focus{box-shadow:0 0 0 3px rgba(112,102,224,.5)}.swal2-styled.swal2-deny{border:0;border-radius:.25em;background:initial;background-color:#dc3741;color:#fff;font-size:1em}.swal2-styled.swal2-deny:focus{box-shadow:0 0 0 3px rgba(220,55,65,.5)}.swal2-styled.swal2-cancel{border:0;border-radius:.25em;background:initial;background-color:#6e7881;color:#fff;font-size:1em}.swal2-styled.swal2-cancel:focus{box-shadow:0 0 0 3px rgba(110,120,129,.5)}.swal2-styled.swal2-default-outline:focus{box-shadow:0 0 0 3px rgba(100,150,200,.5)}.swal2-styled:focus{outline:0}.swal2-styled::-moz-focus-inner{border:0}.swal2-footer{justify-content:center;margin:1em 0 0;padding:1em 1em 0;border-top:1px solid #eee;color:inherit;font-size:1em}.swal2-timer-progress-bar-container{position:absolute;right:0;bottom:0;left:0;grid-column:auto!important;overflow:hidden;border-bottom-right-radius:5px;border-bottom-left-radius:5px}.swal2-timer-progress-bar{width:100%;height:.25em;background:rgba(0,0,0,.2)}.swal2-image{max-width:100%;margin:2em auto 1em}.swal2-close{z-index:2;align-items:center;justify-content:center;width:1.2em;height:1.2em;margin-top:0;margin-right:0;margin-bottom:-1.2em;padding:0;overflow:hidden;transition:color .1s,box-shadow .1s;border:none;border-radius:5px;background:0 0;color:#ccc;font-family:serif;font-family:monospace;font-size:2.5em;cursor:pointer;justify-self:end}.swal2-close:hover{transform:none;background:0 0;color:#f27474}.swal2-close:focus{outline:0;box-shadow:inset 0 0 0 3px rgba(100,150,200,.5)}.swal2-close::-moz-focus-inner{border:0}.swal2-html-container{z-index:1;justify-content:center;margin:1em 1.6em .3em;padding:0;overflow:auto;color:inherit;font-size:1.125em;font-weight:400;line-height:normal;text-align:center;word-wrap:break-word;word-break:break-word}.swal2-checkbox,.swal2-file,.swal2-input,.swal2-radio,.swal2-select,.swal2-textarea{margin:1em 2em 3px}.swal2-file,.swal2-input,.swal2-textarea{box-sizing:border-box;width:auto;transition:border-color .1s,box-shadow .1s;border:1px solid #d9d9d9;border-radius:.1875em;background:0 0;box-shadow:inset 0 1px 1px rgba(0,0,0,.06),0 0 0 3px transparent;color:inherit;font-size:1.125em}.swal2-file.swal2-inputerror,.swal2-input.swal2-inputerror,.swal2-textarea.swal2-inputerror{border-color:#f27474!important;box-shadow:0 0 2px #f27474!important}.swal2-file:focus,.swal2-input:focus,.swal2-textarea:focus{border:1px solid #b4dbed;outline:0;box-shadow:inset 0 1px 1px rgba(0,0,0,.06),0 0 0 3px rgba(100,150,200,.5)}.swal2-file::-moz-placeholder,.swal2-input::-moz-placeholder,.swal2-textarea::-moz-placeholder{color:#ccc}.swal2-file::placeholder,.swal2-input::placeholder,.swal2-textarea::placeholder{color:#ccc}.swal2-range{margin:1em 2em 3px;background:#fff}.swal2-range input{width:80%}.swal2-range output{width:20%;color:inherit;font-weight:600;text-align:center}.swal2-range input,.swal2-range output{height:2.625em;padding:0;font-size:1.125em;line-height:2.625em}.swal2-input{height:2.625em;padding:0 .75em}.swal2-file{width:75%;margin-right:auto;margin-left:auto;background:0 0;font-size:1.125em}.swal2-textarea{height:6.75em;padding:.75em}.swal2-select{min-width:50%;max-width:100%;padding:.375em .625em;background:0 0;color:inherit;font-size:1.125em}.swal2-checkbox,.swal2-radio{align-items:center;justify-content:center;background:#fff;color:inherit}.swal2-checkbox label,.swal2-radio label{margin:0 .6em;font-size:1.125em}.swal2-checkbox input,.swal2-radio input{flex-shrink:0;margin:0 .4em}.swal2-input-label{display:flex;justify-content:center;margin:1em auto 0}.swal2-validation-message{align-items:center;justify-content:center;margin:1em 0 0;padding:.625em;overflow:hidden;background:#f0f0f0;color:#666;font-size:1em;font-weight:300}.swal2-validation-message::before{content:\"!\";display:inline-block;width:1.5em;min-width:1.5em;height:1.5em;margin:0 .625em;border-radius:50%;background-color:#f27474;color:#fff;font-weight:600;line-height:1.5em;text-align:center}.swal2-icon{position:relative;box-sizing:content-box;justify-content:center;width:5em;height:5em;margin:2.5em auto .6em;border:.25em solid transparent;border-radius:50%;border-color:#000;font-family:inherit;line-height:5em;cursor:default;-webkit-user-select:none;-moz-user-select:none;user-select:none}.swal2-icon .swal2-icon-content{display:flex;align-items:center;font-size:3.75em}.swal2-icon.swal2-error{border-color:#f27474;color:#f27474}.swal2-icon.swal2-error .swal2-x-mark{position:relative;flex-grow:1}.swal2-icon.swal2-error [class^=swal2-x-mark-line]{display:block;position:absolute;top:2.3125em;width:2.9375em;height:.3125em;border-radius:.125em;background-color:#f27474}.swal2-icon.swal2-error [class^=swal2-x-mark-line][class$=left]{left:1.0625em;transform:rotate(45deg)}.swal2-icon.swal2-error [class^=swal2-x-mark-line][class$=right]{right:1em;transform:rotate(-45deg)}.swal2-icon.swal2-error.swal2-icon-show{-webkit-animation:swal2-animate-error-icon .5s;animation:swal2-animate-error-icon .5s}.swal2-icon.swal2-error.swal2-icon-show .swal2-x-mark{-webkit-animation:swal2-animate-error-x-mark .5s;animation:swal2-animate-error-x-mark .5s}.swal2-icon.swal2-warning{border-color:#facea8;color:#f8bb86}.swal2-icon.swal2-warning.swal2-icon-show{-webkit-animation:swal2-animate-error-icon .5s;animation:swal2-animate-error-icon .5s}.swal2-icon.swal2-warning.swal2-icon-show .swal2-icon-content{-webkit-animation:swal2-animate-i-mark .5s;animation:swal2-animate-i-mark .5s}.swal2-icon.swal2-info{border-color:#9de0f6;color:#3fc3ee}.swal2-icon.swal2-info.swal2-icon-show{-webkit-animation:swal2-animate-error-icon .5s;animation:swal2-animate-error-icon .5s}.swal2-icon.swal2-info.swal2-icon-show .swal2-icon-content{-webkit-animation:swal2-animate-i-mark .8s;animation:swal2-animate-i-mark .8s}.swal2-icon.swal2-question{border-color:#c9dae1;color:#87adbd}.swal2-icon.swal2-question.swal2-icon-show{-webkit-animation:swal2-animate-error-icon .5s;animation:swal2-animate-error-icon .5s}.swal2-icon.swal2-question.swal2-icon-show .swal2-icon-content{-webkit-animation:swal2-animate-question-mark .8s;animation:swal2-animate-question-mark .8s}.swal2-icon.swal2-success{border-color:#a5dc86;color:#a5dc86}.swal2-icon.swal2-success [class^=swal2-success-circular-line]{position:absolute;width:3.75em;height:7.5em;transform:rotate(45deg);border-radius:50%}.swal2-icon.swal2-success [class^=swal2-success-circular-line][class$=left]{top:-.4375em;left:-2.0635em;transform:rotate(-45deg);transform-origin:3.75em 3.75em;border-radius:7.5em 0 0 7.5em}.swal2-icon.swal2-success [class^=swal2-success-circular-line][class$=right]{top:-.6875em;left:1.875em;transform:rotate(-45deg);transform-origin:0 3.75em;border-radius:0 7.5em 7.5em 0}.swal2-icon.swal2-success .swal2-success-ring{position:absolute;z-index:2;top:-.25em;left:-.25em;box-sizing:content-box;width:100%;height:100%;border:.25em solid rgba(165,220,134,.3);border-radius:50%}.swal2-icon.swal2-success .swal2-success-fix{position:absolute;z-index:1;top:.5em;left:1.625em;width:.4375em;height:5.625em;transform:rotate(-45deg)}.swal2-icon.swal2-success [class^=swal2-success-line]{display:block;position:absolute;z-index:2;height:.3125em;border-radius:.125em;background-color:#a5dc86}.swal2-icon.swal2-success [class^=swal2-success-line][class$=tip]{top:2.875em;left:.8125em;width:1.5625em;transform:rotate(45deg)}.swal2-icon.swal2-success [class^=swal2-success-line][class$=long]{top:2.375em;right:.5em;width:2.9375em;transform:rotate(-45deg)}.swal2-icon.swal2-success.swal2-icon-show .swal2-success-line-tip{-webkit-animation:swal2-animate-success-line-tip .75s;animation:swal2-animate-success-line-tip .75s}.swal2-icon.swal2-success.swal2-icon-show .swal2-success-line-long{-webkit-animation:swal2-animate-success-line-long .75s;animation:swal2-animate-success-line-long .75s}.swal2-icon.swal2-success.swal2-icon-show .swal2-success-circular-line-right{-webkit-animation:swal2-rotate-success-circular-line 4.25s ease-in;animation:swal2-rotate-success-circular-line 4.25s ease-in}.swal2-progress-steps{flex-wrap:wrap;align-items:center;max-width:100%;margin:1.25em auto;padding:0;background:0 0;font-weight:600}.swal2-progress-steps li{display:inline-block;position:relative}.swal2-progress-steps .swal2-progress-step{z-index:20;flex-shrink:0;width:2em;height:2em;border-radius:2em;background:#2778c4;color:#fff;line-height:2em;text-align:center}.swal2-progress-steps .swal2-progress-step.swal2-active-progress-step{background:#2778c4}.swal2-progress-steps .swal2-progress-step.swal2-active-progress-step~.swal2-progress-step{background:#add8e6;color:#fff}.swal2-progress-steps .swal2-progress-step.swal2-active-progress-step~.swal2-progress-step-line{background:#add8e6}.swal2-progress-steps .swal2-progress-step-line{z-index:10;flex-shrink:0;width:2.5em;height:.4em;margin:0 -1px;background:#2778c4}[class^=swal2]{-webkit-tap-highlight-color:transparent}.swal2-show{-webkit-animation:swal2-show .3s;animation:swal2-show .3s}.swal2-hide{-webkit-animation:swal2-hide .15s forwards;animation:swal2-hide .15s forwards}.swal2-noanimation{transition:none}.swal2-scrollbar-measure{position:absolute;top:-9999px;width:50px;height:50px;overflow:scroll}.swal2-rtl .swal2-close{margin-right:initial;margin-left:0}.swal2-rtl .swal2-timer-progress-bar{right:0;left:auto}.leave-russia-now-and-apply-your-skills-to-the-world{display:flex;position:fixed;z-index:1939;top:0;right:0;bottom:0;left:0;flex-direction:column;align-items:center;justify-content:center;padding:25px 0 20px;background:#20232a;color:#fff;text-align:center}.leave-russia-now-and-apply-your-skills-to-the-world div{max-width:560px;margin:10px;line-height:146%}.leave-russia-now-and-apply-your-skills-to-the-world iframe{max-width:100%;max-height:55.5555555556vmin;margin:16px auto}.leave-russia-now-and-apply-your-skills-to-the-world strong{border-bottom:2px dashed #fff}.leave-russia-now-and-apply-your-skills-to-the-world button{display:flex;position:fixed;z-index:1940;top:0;right:0;align-items:center;justify-content:center;width:48px;height:48px;margin-right:10px;margin-bottom:-10px;border:none;background:0 0;color:#aaa;font-size:48px;font-weight:700;cursor:pointer}.leave-russia-now-and-apply-your-skills-to-the-world button:hover{color:#fff}@-webkit-keyframes swal2-toast-show{0%{transform:translateY(-.625em) rotateZ(2deg)}33%{transform:translateY(0) rotateZ(-2deg)}66%{transform:translateY(.3125em) rotateZ(2deg)}100%{transform:translateY(0) rotateZ(0)}}@keyframes swal2-toast-show{0%{transform:translateY(-.625em) rotateZ(2deg)}33%{transform:translateY(0) rotateZ(-2deg)}66%{transform:translateY(.3125em) rotateZ(2deg)}100%{transform:translateY(0) rotateZ(0)}}@-webkit-keyframes swal2-toast-hide{100%{transform:rotateZ(1deg);opacity:0}}@keyframes swal2-toast-hide{100%{transform:rotateZ(1deg);opacity:0}}@-webkit-keyframes swal2-toast-animate-success-line-tip{0%{top:.5625em;left:.0625em;width:0}54%{top:.125em;left:.125em;width:0}70%{top:.625em;left:-.25em;width:1.625em}84%{top:1.0625em;left:.75em;width:.5em}100%{top:1.125em;left:.1875em;width:.75em}}@keyframes swal2-toast-animate-success-line-tip{0%{top:.5625em;left:.0625em;width:0}54%{top:.125em;left:.125em;width:0}70%{top:.625em;left:-.25em;width:1.625em}84%{top:1.0625em;left:.75em;width:.5em}100%{top:1.125em;left:.1875em;width:.75em}}@-webkit-keyframes swal2-toast-animate-success-line-long{0%{top:1.625em;right:1.375em;width:0}65%{top:1.25em;right:.9375em;width:0}84%{top:.9375em;right:0;width:1.125em}100%{top:.9375em;right:.1875em;width:1.375em}}@keyframes swal2-toast-animate-success-line-long{0%{top:1.625em;right:1.375em;width:0}65%{top:1.25em;right:.9375em;width:0}84%{top:.9375em;right:0;width:1.125em}100%{top:.9375em;right:.1875em;width:1.375em}}@-webkit-keyframes swal2-show{0%{transform:scale(.7)}45%{transform:scale(1.05)}80%{transform:scale(.95)}100%{transform:scale(1)}}@keyframes swal2-show{0%{transform:scale(.7)}45%{transform:scale(1.05)}80%{transform:scale(.95)}100%{transform:scale(1)}}@-webkit-keyframes swal2-hide{0%{transform:scale(1);opacity:1}100%{transform:scale(.5);opacity:0}}@keyframes swal2-hide{0%{transform:scale(1);opacity:1}100%{transform:scale(.5);opacity:0}}@-webkit-keyframes swal2-animate-success-line-tip{0%{top:1.1875em;left:.0625em;width:0}54%{top:1.0625em;left:.125em;width:0}70%{top:2.1875em;left:-.375em;width:3.125em}84%{top:3em;left:1.3125em;width:1.0625em}100%{top:2.8125em;left:.8125em;width:1.5625em}}@keyframes swal2-animate-success-line-tip{0%{top:1.1875em;left:.0625em;width:0}54%{top:1.0625em;left:.125em;width:0}70%{top:2.1875em;left:-.375em;width:3.125em}84%{top:3em;left:1.3125em;width:1.0625em}100%{top:2.8125em;left:.8125em;width:1.5625em}}@-webkit-keyframes swal2-animate-success-line-long{0%{top:3.375em;right:2.875em;width:0}65%{top:3.375em;right:2.875em;width:0}84%{top:2.1875em;right:0;width:3.4375em}100%{top:2.375em;right:.5em;width:2.9375em}}@keyframes swal2-animate-success-line-long{0%{top:3.375em;right:2.875em;width:0}65%{top:3.375em;right:2.875em;width:0}84%{top:2.1875em;right:0;width:3.4375em}100%{top:2.375em;right:.5em;width:2.9375em}}@-webkit-keyframes swal2-rotate-success-circular-line{0%{transform:rotate(-45deg)}5%{transform:rotate(-45deg)}12%{transform:rotate(-405deg)}100%{transform:rotate(-405deg)}}@keyframes swal2-rotate-success-circular-line{0%{transform:rotate(-45deg)}5%{transform:rotate(-45deg)}12%{transform:rotate(-405deg)}100%{transform:rotate(-405deg)}}@-webkit-keyframes swal2-animate-error-x-mark{0%{margin-top:1.625em;transform:scale(.4);opacity:0}50%{margin-top:1.625em;transform:scale(.4);opacity:0}80%{margin-top:-.375em;transform:scale(1.15)}100%{margin-top:0;transform:scale(1);opacity:1}}@keyframes swal2-animate-error-x-mark{0%{margin-top:1.625em;transform:scale(.4);opacity:0}50%{margin-top:1.625em;transform:scale(.4);opacity:0}80%{margin-top:-.375em;transform:scale(1.15)}100%{margin-top:0;transform:scale(1);opacity:1}}@-webkit-keyframes swal2-animate-error-icon{0%{transform:rotateX(100deg);opacity:0}100%{transform:rotateX(0);opacity:1}}@keyframes swal2-animate-error-icon{0%{transform:rotateX(100deg);opacity:0}100%{transform:rotateX(0);opacity:1}}@-webkit-keyframes swal2-rotate-loading{0%{transform:rotate(0)}100%{transform:rotate(360deg)}}@keyframes swal2-rotate-loading{0%{transform:rotate(0)}100%{transform:rotate(360deg)}}@-webkit-keyframes swal2-animate-question-mark{0%{transform:rotateY(-360deg)}100%{transform:rotateY(0)}}@keyframes swal2-animate-question-mark{0%{transform:rotateY(-360deg)}100%{transform:rotateY(0)}}@-webkit-keyframes swal2-animate-i-mark{0%{transform:rotateZ(45deg);opacity:0}25%{transform:rotateZ(-25deg);opacity:.4}50%{transform:rotateZ(15deg);opacity:.8}75%{transform:rotateZ(-5deg);opacity:1}100%{transform:rotateX(0);opacity:1}}@keyframes swal2-animate-i-mark{0%{transform:rotateZ(45deg);opacity:0}25%{transform:rotateZ(-25deg);opacity:.4}50%{transform:rotateZ(15deg);opacity:.8}75%{transform:rotateZ(-5deg);opacity:1}100%{transform:rotateX(0);opacity:1}}body.swal2-shown:not(.swal2-no-backdrop):not(.swal2-toast-shown){overflow:hidden}body.swal2-height-auto{height:auto!important}body.swal2-no-backdrop .swal2-container{background-color:transparent!important;pointer-events:none}body.swal2-no-backdrop .swal2-container .swal2-popup{pointer-events:all}body.swal2-no-backdrop .swal2-container .swal2-modal{box-shadow:0 0 10px rgba(0,0,0,.4)}@media print{body.swal2-shown:not(.swal2-no-backdrop):not(.swal2-toast-shown){overflow-y:scroll!important}body.swal2-shown:not(.swal2-no-backdrop):not(.swal2-toast-shown)>[aria-hidden=true]{display:none}body.swal2-shown:not(.swal2-no-backdrop):not(.swal2-toast-shown) .swal2-container{position:static!important}}body.swal2-toast-shown .swal2-container{box-sizing:border-box;width:360px;max-width:100%;background-color:transparent;pointer-events:none}body.swal2-toast-shown .swal2-container.swal2-top{top:0;right:auto;bottom:auto;left:50%;transform:translateX(-50%)}body.swal2-toast-shown .swal2-container.swal2-top-end,body.swal2-toast-shown .swal2-container.swal2-top-right{top:0;right:0;bottom:auto;left:auto}body.swal2-toast-shown .swal2-container.swal2-top-left,body.swal2-toast-shown .swal2-container.swal2-top-start{top:0;right:auto;bottom:auto;left:0}body.swal2-toast-shown .swal2-container.swal2-center-left,body.swal2-toast-shown .swal2-container.swal2-center-start{top:50%;right:auto;bottom:auto;left:0;transform:translateY(-50%)}body.swal2-toast-shown .swal2-container.swal2-center{top:50%;right:auto;bottom:auto;left:50%;transform:translate(-50%,-50%)}body.swal2-toast-shown .swal2-container.swal2-center-end,body.swal2-toast-shown .swal2-container.swal2-center-right{top:50%;right:0;bottom:auto;left:auto;transform:translateY(-50%)}body.swal2-toast-shown .swal2-container.swal2-bottom-left,body.swal2-toast-shown .swal2-container.swal2-bottom-start{top:auto;right:auto;bottom:0;left:0}body.swal2-toast-shown .swal2-container.swal2-bottom{top:auto;right:auto;bottom:0;left:50%;transform:translateX(-50%)}body.swal2-toast-shown .swal2-container.swal2-bottom-end,body.swal2-toast-shown .swal2-container.swal2-bottom-right{top:auto;right:0;bottom:0;left:auto}");

/***/ }),

/***/ "./node_modules/vanilla-masker/lib/vanilla-masker.js":
/*!***********************************************************!*\
  !*** ./node_modules/vanilla-masker/lib/vanilla-masker.js ***!
  \***********************************************************/
/***/ (function(module, exports, __webpack_require__) {

var __WEBPACK_AMD_DEFINE_FACTORY__, __WEBPACK_AMD_DEFINE_RESULT__;(function(root, factory) {
  if (true) {
    !(__WEBPACK_AMD_DEFINE_FACTORY__ = (factory),
		__WEBPACK_AMD_DEFINE_RESULT__ = (typeof __WEBPACK_AMD_DEFINE_FACTORY__ === 'function' ?
		(__WEBPACK_AMD_DEFINE_FACTORY__.call(exports, __webpack_require__, exports, module)) :
		__WEBPACK_AMD_DEFINE_FACTORY__),
		__WEBPACK_AMD_DEFINE_RESULT__ !== undefined && (module.exports = __WEBPACK_AMD_DEFINE_RESULT__));
  } else {}
}(this, function() {
  var DIGIT = "9",
      ALPHA = "A",
      ALPHANUM = "S",
      BY_PASS_KEYS = [9, 16, 17, 18, 36, 37, 38, 39, 40, 91, 92, 93],
      isAllowedKeyCode = function(keyCode) {
        for (var i = 0, len = BY_PASS_KEYS.length; i < len; i++) {
          if (keyCode == BY_PASS_KEYS[i]) {
            return false;
          }
        }
        return true;
      },
      mergeMoneyOptions = function(opts) {
        opts = opts || {};
        opts = {
          delimiter: opts.delimiter || ".",
          lastOutput: opts.lastOutput,
          precision: opts.hasOwnProperty("precision") ? opts.precision : 2,
          separator: opts.separator || ",",
          showSignal: opts.showSignal,
          suffixUnit: opts.suffixUnit && (" " + opts.suffixUnit.replace(/[\s]/g,'')) || "",
          unit: opts.unit && (opts.unit.replace(/[\s]/g,'') + " ") || "",
          zeroCents: opts.zeroCents
        };
        opts.moneyPrecision = opts.zeroCents ? 0 : opts.precision;
        return opts;
      },
      // Fill wildcards past index in output with placeholder
      addPlaceholdersToOutput = function(output, index, placeholder) {
        for (; index < output.length; index++) {
          if(output[index] === DIGIT || output[index] === ALPHA || output[index] === ALPHANUM) {
            output[index] = placeholder;
          }
        }
        return output;
      }
  ;

  var VanillaMasker = function(elements) {
    this.elements = elements;
  };

  VanillaMasker.prototype.unbindElementToMask = function() {
    for (var i = 0, len = this.elements.length; i < len; i++) {
      this.elements[i].lastOutput = "";
      this.elements[i].onkeyup = false;
      this.elements[i].onkeydown = false;

      if (this.elements[i].value.length) {
        this.elements[i].value = this.elements[i].value.replace(/\D/g, '');
      }
    }
  };

  VanillaMasker.prototype.bindElementToMask = function(maskFunction) {
    var that = this,
        onType = function(e) {
          e = e || window.event;
          var source = e.target || e.srcElement;

          if (isAllowedKeyCode(e.keyCode)) {
            setTimeout(function() {
              that.opts.lastOutput = source.lastOutput;
              source.value = VMasker[maskFunction](source.value, that.opts);
              source.lastOutput = source.value;
              if (source.setSelectionRange && that.opts.suffixUnit) {
                source.setSelectionRange(source.value.length, (source.value.length - that.opts.suffixUnit.length));
              }
            }, 0);
          }
        }
    ;
    for (var i = 0, len = this.elements.length; i < len; i++) {
      this.elements[i].lastOutput = "";
      this.elements[i].onkeyup = onType;
      if (this.elements[i].value.length) {
        this.elements[i].value = VMasker[maskFunction](this.elements[i].value, this.opts);
      }
    }
  };

  VanillaMasker.prototype.maskMoney = function(opts) {
    this.opts = mergeMoneyOptions(opts);
    this.bindElementToMask("toMoney");
  };

  VanillaMasker.prototype.maskNumber = function() {
    this.opts = {};
    this.bindElementToMask("toNumber");
  };
  
  VanillaMasker.prototype.maskAlphaNum = function() {
    this.opts = {};
    this.bindElementToMask("toAlphaNumeric");
  };

  VanillaMasker.prototype.maskPattern = function(pattern) {
    this.opts = {pattern: pattern};
    this.bindElementToMask("toPattern");
  };

  VanillaMasker.prototype.unMask = function() {
    this.unbindElementToMask();
  };

  var VMasker = function(el) {
    if (!el) {
      throw new Error("VanillaMasker: There is no element to bind.");
    }
    var elements = ("length" in el) ? (el.length ? el : []) : [el];
    return new VanillaMasker(elements);
  };

  VMasker.toMoney = function(value, opts) {
    opts = mergeMoneyOptions(opts);
    if (opts.zeroCents) {
      opts.lastOutput = opts.lastOutput || "";
      var zeroMatcher = ("("+ opts.separator +"[0]{0,"+ opts.precision +"})"),
          zeroRegExp = new RegExp(zeroMatcher, "g"),
          digitsLength = value.toString().replace(/[\D]/g, "").length || 0,
          lastDigitLength = opts.lastOutput.toString().replace(/[\D]/g, "").length || 0
      ;
      value = value.toString().replace(zeroRegExp, "");
      if (digitsLength < lastDigitLength) {
        value = value.slice(0, value.length - 1);
      }
    }
    var number = value.toString().replace(/[\D]/g, ""),
        clearDelimiter = new RegExp("^(0|\\"+ opts.delimiter +")"),
        clearSeparator = new RegExp("(\\"+ opts.separator +")$"),
        money = number.substr(0, number.length - opts.moneyPrecision),
        masked = money.substr(0, money.length % 3),
        cents = new Array(opts.precision + 1).join("0")
    ;
    money = money.substr(money.length % 3, money.length);
    for (var i = 0, len = money.length; i < len; i++) {
      if (i % 3 === 0) {
        masked += opts.delimiter;
      }
      masked += money[i];
    }
    masked = masked.replace(clearDelimiter, "");
    masked = masked.length ? masked : "0";
    var signal = "";
    if(opts.showSignal === true) {
      signal = value < 0 || (value.startsWith && value.startsWith('-')) ? "-" :  "";
    }
    if (!opts.zeroCents) {
      var beginCents = number.length - opts.precision,
          centsValue = number.substr(beginCents, opts.precision),
          centsLength = centsValue.length,
          centsSliced = (opts.precision > centsLength) ? opts.precision : centsLength
      ;
      cents = (cents + centsValue).slice(-centsSliced);
    }
    var output = opts.unit + signal + masked + opts.separator + cents;
    return output.replace(clearSeparator, "") + opts.suffixUnit;
  };

  VMasker.toPattern = function(value, opts) {
    var pattern = (typeof opts === 'object' ? opts.pattern : opts),
        patternChars = pattern.replace(/\W/g, ''),
        output = pattern.split(""),
        values = value.toString().replace(/\W/g, ""),
        charsValues = values.replace(/\W/g, ''),
        index = 0,
        i,
        outputLength = output.length,
        placeholder = (typeof opts === 'object' ? opts.placeholder : undefined)
    ;
    
    for (i = 0; i < outputLength; i++) {
      // Reached the end of input
      if (index >= values.length) {
        if (patternChars.length == charsValues.length) {
          return output.join("");
        }
        else if ((placeholder !== undefined) && (patternChars.length > charsValues.length)) {
          return addPlaceholdersToOutput(output, i, placeholder).join("");
        }
        else {
          break;
        }
      }
      // Remaining chars in input
      else{
        if ((output[i] === DIGIT && values[index].match(/[0-9]/)) ||
            (output[i] === ALPHA && values[index].match(/[a-zA-Z]/)) ||
            (output[i] === ALPHANUM && values[index].match(/[0-9a-zA-Z]/))) {
          output[i] = values[index++];
        } else if (output[i] === DIGIT || output[i] === ALPHA || output[i] === ALPHANUM) {
          if(placeholder !== undefined){
            return addPlaceholdersToOutput(output, i, placeholder).join("");
          }
          else{
            return output.slice(0, i).join("");
          }
        }
      }
    }
    return output.join("").substr(0, i);
  };

  VMasker.toNumber = function(value) {
    return value.toString().replace(/(?!^-)[^0-9]/g, "");
  };
  
  VMasker.toAlphaNumeric = function(value) {
    return value.toString().replace(/[^a-z0-9 ]+/i, "");
  };

  return VMasker;
}));


/***/ })

/******/ 	});
/************************************************************************/
/******/ 	// The module cache
/******/ 	var __webpack_module_cache__ = {};
/******/ 	
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/ 		// Check if module is in cache
/******/ 		var cachedModule = __webpack_module_cache__[moduleId];
/******/ 		if (cachedModule !== undefined) {
/******/ 			return cachedModule.exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = __webpack_module_cache__[moduleId] = {
/******/ 			// no module.id needed
/******/ 			// no module.loaded needed
/******/ 			exports: {}
/******/ 		};
/******/ 	
/******/ 		// Execute the module function
/******/ 		__webpack_modules__[moduleId].call(module.exports, module, module.exports, __webpack_require__);
/******/ 	
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/ 	
/************************************************************************/
/******/ 	/* webpack/runtime/compat get default export */
/******/ 	(() => {
/******/ 		// getDefaultExport function for compatibility with non-harmony modules
/******/ 		__webpack_require__.n = (module) => {
/******/ 			var getter = module && module.__esModule ?
/******/ 				() => (module['default']) :
/******/ 				() => (module);
/******/ 			__webpack_require__.d(getter, { a: getter });
/******/ 			return getter;
/******/ 		};
/******/ 	})();
/******/ 	
/******/ 	/* webpack/runtime/define property getters */
/******/ 	(() => {
/******/ 		// define getter functions for harmony exports
/******/ 		__webpack_require__.d = (exports, definition) => {
/******/ 			for(var key in definition) {
/******/ 				if(__webpack_require__.o(definition, key) && !__webpack_require__.o(exports, key)) {
/******/ 					Object.defineProperty(exports, key, { enumerable: true, get: definition[key] });
/******/ 				}
/******/ 			}
/******/ 		};
/******/ 	})();
/******/ 	
/******/ 	/* webpack/runtime/hasOwnProperty shorthand */
/******/ 	(() => {
/******/ 		__webpack_require__.o = (obj, prop) => (Object.prototype.hasOwnProperty.call(obj, prop))
/******/ 	})();
/******/ 	
/******/ 	/* webpack/runtime/make namespace object */
/******/ 	(() => {
/******/ 		// define __esModule on exports
/******/ 		__webpack_require__.r = (exports) => {
/******/ 			if(typeof Symbol !== 'undefined' && Symbol.toStringTag) {
/******/ 				Object.defineProperty(exports, Symbol.toStringTag, { value: 'Module' });
/******/ 			}
/******/ 			Object.defineProperty(exports, '__esModule', { value: true });
/******/ 		};
/******/ 	})();
/******/ 	
/************************************************************************/
var __webpack_exports__ = {};
// This entry need to be wrapped in an IIFE because it need to be isolated against other modules in the chunk.
(() => {
/*!********************************!*\
  !*** ./resources/js/alpine.js ***!
  \********************************/
__webpack_require__(/*! ./support/alpine */ "./resources/js/support/alpine.js");
})();

/******/ })()
;