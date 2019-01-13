module.exports=function(e){function t(i){if(n[i])return n[i].exports;var a=n[i]={exports:{},id:i,loaded:!1};return e[i].call(a.exports,a,a.exports,t),a.loaded=!0,a.exports}var n={};return t.m=e,t.c=n,t.p="",t(0)}([function(e,t,n){"use strict";function i(e){return e&&e.__esModule?e:{default:e}}function a(e){var t=g.getDataByKey("novi-plugin-material-parallax");return e.ui.editor[0].title=t.editor.title,e.ui.editor[0].tooltip=t.editor.tooltip,e}var r=n(1),o=function(e){if(e&&e.__esModule)return e;var t={};if(null!=e)for(var n in e)Object.prototype.hasOwnProperty.call(e,n)&&(t[n]=e[n]);return t.default=e,t}(r),l=n(2),s=i(l),u=n(3),c=i(u),p=novi.react.React,g=novi.language,f={name:"novi-plugin-material-parallax",title:"Novi Material Parallax Plugin",description:"Novi Material Parallax Plugin description",version:"1.0.4",dependencies:{novi:"0.9.0"},defaults:{querySelector:".parallax-container"},ui:{editor:[s.default],settings:p.createElement(c.default,null)},excerpt:o.isValidParallax,onLanguageChange:a};novi.plugins.register(f)},function(e,t){"use strict";function n(e){return!!e&&e.hasAttribute("data-parallax-img")}Object.defineProperty(t,"__esModule",{value:!0}),t.isValidParallax=n},function(e,t){"use strict";function n(e){novi.media.choose({onSubmit:i.bind(this,e),width:e.offsetWidth,height:e.offsetHeight,type:l.mediaImage})}function i(e,t){var n=t.replace(/['|"]/g,"");novi.element.setAttribute(e,"data-parallax-img",n),e.setAttribute("data-parallax-img",n),e.style.backgroundImage="url("+n+")"}Object.defineProperty(t,"__esModule",{value:!0});var a=novi.react.React,r=novi.ui.icon,o=novi.ui.icons,l=novi.types,s=novi.language.getDataByKey("novi-plugin-material-parallax"),u={trigger:a.createElement(r,null,o.ICON_BG_IMAGE),tooltip:s.editor.tooltip,closeIcon:"submit",title:s.editor.title,onTriggerClick:n};t.default=u},function(e,t){"use strict";function n(e,t){if(!(e instanceof t))throw new TypeError("Cannot call a class as a function")}function i(e,t){if(!e)throw new ReferenceError("this hasn't been initialised - super() hasn't been called");return!t||"object"!=typeof t&&"function"!=typeof t?e:t}function a(e,t){if("function"!=typeof t&&null!==t)throw new TypeError("Super expression must either be null or a function, not "+typeof t);e.prototype=Object.create(t&&t.prototype,{constructor:{value:e,enumerable:!1,writable:!0,configurable:!0}}),t&&(Object.setPrototypeOf?Object.setPrototypeOf(e,t):e.__proto__=t)}Object.defineProperty(t,"__esModule",{value:!0});var r=function(){function e(e,t){for(var n=0;n<t.length;n++){var i=t[n];i.enumerable=i.enumerable||!1,i.configurable=!0,"value"in i&&(i.writable=!0),Object.defineProperty(e,i.key,i)}}return function(t,n,i){return n&&e(t.prototype,n),i&&e(t,i),t}}(),o=novi.react.React,l=novi.react.Component,s=novi.ui.input,u=novi.ui.button,c=novi.language,p=function(e){function t(e){n(this,t);var a=i(this,(t.__proto__||Object.getPrototypeOf(t)).call(this));return a.state={settings:e.settings},a.saveSettings=a.saveSettings.bind(a),a.onChange=a.onChange.bind(a),a.messages=c.getDataByKey("novi-plugin-material-parallax"),a}return a(t,e),r(t,[{key:"componentWillReceiveProps",value:function(e){this.setState({settings:e.settings})}},{key:"render",value:function(){return o.createElement("div",null,o.createElement("span",{style:{letterSpacing:"0,0462em"}},"Material Parallax Plugin"),o.createElement("div",{style:{fontSize:13,color:"#6E778A",marginTop:21}},this.messages.settings.inputPlaceholder),o.createElement(s,{style:{marginTop:10,width:340},value:this.state.settings.querySelector,onChange:this.onChange}),o.createElement("div",{style:{marginTop:30}},o.createElement(u,{type:"primary",messages:{textContent:this.messages.settings.submitButton},onClick:this.saveSettings})))}},{key:"onChange",value:function(e){var t=e.target.value;this.setState({settings:{querySelector:t}})}},{key:"saveSettings",value:function(){novi.plugins.settings.update("novi-plugin-material-parallax",this.state.settings)}}]),t}(l);t.default=p}]);