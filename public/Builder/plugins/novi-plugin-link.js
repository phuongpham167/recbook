module.exports=function(e){function t(i){if(n[i])return n[i].exports;var a=n[i]={exports:{},id:i,loaded:!1};return e[i].call(a.exports,a,a.exports,t),a.loaded=!0,a.exports}var n={};return t.m=e,t.c=n,t.p="",t(0)}([function(e,t,n){"use strict";function i(e){return e&&e.__esModule?e:{default:e}}function a(e){var t=g.getDataByKey("novi-plugin-link");return e.ui.editor[0].title=t.editor.title,e.ui.editor[0].tooltip=t.editor.tooltip,e.ui.editor[0].header[1]=c.createElement("span",null,t.editor.header),e}var l=n(1),o=i(l),s=n(3),r=i(s),u=n(4),p=function(e){if(e&&e.__esModule)return e;var t={};if(null!=e)for(var n in e)Object.prototype.hasOwnProperty.call(e,n)&&(t[n]=e[n]);return t.default=e,t}(u),c=novi.react.React,g=novi.language,v={name:"novi-plugin-link",title:"Novi Link",description:"Novi Link description",version:"1.1.0",dependencies:{novi:"0.9.0"},defaults:{querySelector:"a[href]",favoriteLinks:[{title:"",value:""}],applyToProjectElements:!0},ui:{editor:[o.default],settings:c.createElement(r.default,null)},excerpt:p.isLinkReplaceble,onLanguageChange:a};novi.plugins.register(v)},function(e,t,n){"use strict";function i(e,t){var n=t[0];n.href===n.value&&n.initBlank===n.blank||(n.href!==n.value&&novi.element.setAttribute(n.element,"href",n.value),n.initBlank!==n.blank&&(n.blank?novi.element.setAttribute(n.element,"target","_blank"):novi.element.removeAttribute(n.element,"target")))}Object.defineProperty(t,"__esModule",{value:!0});var a=n(2),l=function(e){return e&&e.__esModule?e:{default:e}}(a),o=novi.react.React,s=novi.ui.icons,r=novi.language.getDataByKey("novi-plugin-link"),u={trigger:s.ICON_LINK,tooltip:r.editor.tooltip,header:[s.ICON_LINK,o.createElement("span",null,r.editor.header)],body:[o.createElement(l.default,null)],closeIcon:"submit",width:360,height:200,title:r.editor.title,onSubmit:i};t.default=u},function(e,t){"use strict";function n(e,t){if(!(e instanceof t))throw new TypeError("Cannot call a class as a function")}function i(e,t){if(!e)throw new ReferenceError("this hasn't been initialised - super() hasn't been called");return!t||"object"!=typeof t&&"function"!=typeof t?e:t}function a(e,t){if("function"!=typeof t&&null!==t)throw new TypeError("Super expression must either be null or a function, not "+typeof t);e.prototype=Object.create(t&&t.prototype,{constructor:{value:e,enumerable:!1,writable:!0,configurable:!0}}),t&&(Object.setPrototypeOf?Object.setPrototypeOf(e,t):e.__proto__=t)}Object.defineProperty(t,"__esModule",{value:!0});var l=function(){function e(e,t){for(var n=0;n<t.length;n++){var i=t[n];i.enumerable=i.enumerable||!1,i.configurable=!0,"value"in i&&(i.writable=!0),Object.defineProperty(e,i.key,i)}}return function(t,n,i){return n&&e(t.prototype,n),i&&e(t,i),t}}(),o=novi.ui.input,s=(novi.ui.icons,novi.ui.radioGroup),r=novi.ui.select,u=novi.ui.checkbox,p=novi.react.React,c=novi.react.Component,g=novi.language,v=function(e){function t(e){n(this,t);var a=i(this,(t.__proto__||Object.getPrototypeOf(t)).call(this));a.messages=g.getDataByKey("novi-plugin-link");var l=novi.element.getAttribute(e.element,"href");a.pages=a._getPages(novi.utils.getProjectPages()),a.favoriteLinks=a._getLinks(novi.plugins.settings.get("novi-plugin-link").favoriteLinks);var o=a._getLinkTypeFromValue(a.messages.editor,l),s="_blank"===novi.element.getAttribute(e.element,"target")||!1;return a.state={type:o,element:e.element,value:l,href:l,initBlank:s,blank:s},a._handleChange=a._handleChange.bind(a),a._handleRadioButtonClick=a._handleRadioButtonClick.bind(a),a._renderSettingsData=a._renderSettingsData.bind(a),a._handleSelectChange=a._handleSelectChange.bind(a),a.onTargetChange=a.onTargetChange.bind(a),a}return a(t,e),l(t,[{key:"render",value:function(){return p.createElement("div",{className:"novi-link-plugin-wrap",style:{padding:"0 12px",display:"flex",flexDirection:"column",justifyContent:"center",height:"100%",color:"#6E778A"}},p.createElement("p",{className:"novi-label",style:{marginTop:"0"}},this.messages.editor.body.linkType),p.createElement(s,{options:[this.messages.editor.body.pagesTabTitle,this.messages.editor.body.favoritesTabTitle,this.messages.editor.body.customTabTitle],value:this.state.type,onChange:this._handleRadioButtonClick}),this._renderSettingsData())}},{key:"_getPages",value:function(e){return e.filter(function(e){return e.path&&e.title}).map(function(e){return{label:e.title,value:e.path}})}},{key:"_getLinks",value:function(e){return e.filter(function(e){return e.title&&e.value&&"index.html"!==e.value}).map(function(e){return{label:e.title,value:e.value}})}},{key:"_handleRadioButtonClick",value:function(e){this.setState({type:e})}},{key:"_renderSettingsData",value:function(){switch(this.state.type){case this.messages.editor.body.customTabTitle:return this._renderCustomInput();case this.messages.editor.body.favoritesTabTitle:return this._renderFavoriteLinks();default:return this._renderPagesSelect()}}},{key:"_renderPagesSelect",value:function(){return p.createElement("div",{className:"novi-link-plugin-body",style:{marginTop:"20px"}},p.createElement("p",{className:"novi-label",style:{marginTop:"0"}},this.messages.editor.body.pagesLabel),p.createElement(r,{searchable:!0,clearable:!1,options:this.pages,onChange:this._handleSelectChange,value:this.state.value}),p.createElement("div",{style:{marginTop:10}},p.createElement(u,{checked:this.state.blank,onChange:this.onTargetChange},this.messages.editor.body.openInNewTab)))}},{key:"_renderFavoriteLinks",value:function(){return p.createElement("div",{className:"novi-link-plugin-body",style:{marginTop:"20px"}},p.createElement("p",{className:"novi-label",style:{marginTop:"0"}},this.messages.editor.body.linksLabel),p.createElement(r,{searchable:!0,clearable:!1,options:this.favoriteLinks,onChange:this._handleSelectChange,value:this.state.value}),p.createElement("div",{style:{marginTop:10}},p.createElement(u,{checked:this.state.blank,onChange:this.onTargetChange},this.messages.editor.body.openInNewTab)))}},{key:"_renderCustomInput",value:function(){return p.createElement("div",null,p.createElement("p",{className:"novi-label",style:{marginTop:20}},this.messages.editor.body.inputLabel),p.createElement(o,{onChange:this._handleChange,value:this.state.value}),p.createElement("div",{style:{marginTop:10}},p.createElement(u,{checked:this.state.blank,onChange:this.onTargetChange},this.messages.editor.body.openInNewTab)))}},{key:"onTargetChange",value:function(){this.setState({blank:!this.state.blank})}},{key:"_handleSelectChange",value:function(e){this.setState({value:e.value})}},{key:"_handleChange",value:function(e){var t=e.target.value;this.setState({value:t})}},{key:"_getLinkTypeFromValue",value:function(e,t){var n=void 0;for(n=0;n<this.pages.length;n++)if(this.pages[n].value===t)return e.body.pagesTabTitle;for(n=0;n<this.favoriteLinks.length;n++)if(this.favoriteLinks[n].value===t)return e.body.favoritesTabTitle;return e.body.customTabTitle}}]),t}(c);t.default=v},function(e,t){"use strict";function n(e,t){if(!(e instanceof t))throw new TypeError("Cannot call a class as a function")}function i(e,t){if(!e)throw new ReferenceError("this hasn't been initialised - super() hasn't been called");return!t||"object"!=typeof t&&"function"!=typeof t?e:t}function a(e,t){if("function"!=typeof t&&null!==t)throw new TypeError("Super expression must either be null or a function, not "+typeof t);e.prototype=Object.create(t&&t.prototype,{constructor:{value:e,enumerable:!1,writable:!0,configurable:!0}}),t&&(Object.setPrototypeOf?Object.setPrototypeOf(e,t):e.__proto__=t)}Object.defineProperty(t,"__esModule",{value:!0});var l="function"==typeof Symbol&&"symbol"==typeof Symbol.iterator?function(e){return typeof e}:function(e){return e&&"function"==typeof Symbol&&e.constructor===Symbol&&e!==Symbol.prototype?"symbol":typeof e},o=function(){function e(e,t){for(var n=0;n<t.length;n++){var i=t[n];i.enumerable=i.enumerable||!1,i.configurable=!0,"value"in i&&(i.writable=!0),Object.defineProperty(e,i.key,i)}}return function(t,n,i){return n&&e(t.prototype,n),i&&e(t,i),t}}(),s=novi.react.React,r=novi.react.Component,u=novi.ui.input,p=novi.ui.icons,c=novi.ui.checkbox,g=novi.ui.button,v=novi.language,h=function(e){function t(e){n(this,t);var a=i(this,(t.__proto__||Object.getPrototypeOf(t)).call(this));return a.counterId=0,a.state={querySelector:e.settings.querySelector,favoriteLinks:a._getFavoriteLinks(e.settings.favoriteLinks),applyToProjectElements:e.settings.applyToProjectElements},a._saveSettings=a._saveSettings.bind(a),a._onChange=a._onChange.bind(a),a._renderFavoriteLinks=a._renderFavoriteLinks.bind(a),a._onAdd=a._onAdd.bind(a),a._onCheckboxChange=a._onCheckboxChange.bind(a),a.messages=v.getDataByKey("novi-plugin-link"),a.style='\n                .novi-link-plugin-settings-wrap{\n                    display: flex;\n                    justify-content: flex-start;\n                }       \n                .novi-link-plugin-settings-left-part{\n                    position: fixed;\n                    max-width: 355px;\n                }\n                .novi-link-plugin-settings-right-part{\n                    margin-left: 400px;\n                    min-width: 373px;\n                }\n                .novi-link-plugin-settings-right-part-header{\n                    position:relative\n                }\n                .novi-link-plugin-settings-input-label{\n                    font-size: 13px;\n                    color: #6E778A;\n                    margin-top: 10px;\n                    display: block;\n                    padding-bottom: 10px;\n                    line-height: 22px;\n                }\n                .novi-link-plugin-settings-input-label span{\n                    float: right;\n                }\n                \n                .novi-link-plugin-settings-apply-type-description{\n                    font-size: 13px;\n                    color: #6E778A; \n                    margin-top: 10px;\n                    display: block;\n                    line-height: 22px;\n                }\n                .novi-link-plugin-settings-apply-type{\n                    margin-top: 15px;\n                }\n                .novi-link-plugin-settings-apply-type .checkbox .checkbox-text{\n                    font-size: 13px;\n                }\n                .novi-link-plugin-settings-title{\n                    font-size: 13px;\n                    line-height: 16px;\n                    color: #fff;\n                    letter-spacing: 0.0462em;\n                }\n                .novi-link-plugin-settings-group{\n                    display: flex;\n                    align-items: flex-end;\n                }\n                .novi-link-plugin-settings-group-number{\n                    font-size: 15px;\n                    display: block;\n                    color: #6E778A;\n                    padding-bottom: 7px;\n                    padding-right: 10px;\n                    font-weight: 300;\n                }\n                .novi-link-plugin-duplicated-icon{\n                    position: absolute;\n                    right: 5px;\n                    bottom: 6px;\n                    width: 20px;\n                    height: 20px;\n                }\n                .novi-link-plugin-duplicated-icon svg{\n                    fill: rgba(255, 220, 131, 0.6);\n                }\n                .novi-link-plugin-settings-group-item{ \n                    position: relative\n                }\n                .novi-link-plugin-settings-group-item .novi-input{\n                    width: 200px;\n                }\n               \n                .novi-link-plugin-settings-group-item .novi-link-plugin-settings-input.duplicated{\n                    border-color: rgba(255, 220, 131, 0.6);\n                    padding-right: 33px;\n                }\n                .novi-link-plugin-settings-group-item + .novi-link-plugin-settings-group-item{\n                    margin-left: 20px;\n                }\n                .novi-link-plugin-settings-group-item + .novi-link-plugin-settings-group-item .novi-link-plugin-settings-input-label{\n                    margin-top: 10px;\n                }\n                .novi-link-plugin-settings-group-remove-button{\n                    position:relative;\n                    width: 30px;\n                    height: 30px;\n                    margin-left: 5px;\n                    cursor: pointer; \n                }\n                .novi-link-plugin-settings-group-remove-button svg{\n                    width: 10px;\n                    height: 10px;\n                    fill: rgb(255, 255, 255);\n                    position: absolute;\n                    top: 50%;\n                    left: 50%;\n                    transform: translate(-50%, -50%);\n                }\n                .novi-plugin-link-settings-group-add{\n                    width: 12px;\n                    height: 12px;\n                    position: absolute;\n                    cursor: pointer;\n                    right: 10px;\n                    top: 2px;\n                }\n               \n                .novi-plugin-link-settings-group-add-icon{\n                    position: relative;\n                    width: 100%;\n                    height: 100%;\n                }\n                .novi-plugin-link-settings-group-add-icon:before {\n                    width: 12px;\n                    margin-left: -6px;\n                    content: "";\n                    position: absolute;\n                    left: 50%;\n                    top: 50%;\n                    height: 2px;\n                    background: #10B7F7;\n                    margin-top: -1px;\n                }\n                .novi-plugin-link-settings-group-add-icon:after{\n                    content: "";\n                    position: absolute;\n                    left: 50%;\n                    top: 50%;\n                    width: 2px;\n                    margin-left: -1px;\n                    background: #10B7F7;\n                    height: 12px;\n                    margin-top: -6px;\n                }\n                .novi-link-plugin-settings-save-button{\n                    margin-top: 30px;\n                }\n        ',a}return a(t,e),o(t,[{key:"render",value:function(){return s.createElement("div",null,s.createElement("div",{className:"novi-link-plugin-settings-wrap"},s.createElement("style",null,this.style),s.createElement("div",{className:"novi-link-plugin-settings-left-part"},s.createElement("span",{className:"novi-link-plugin-settings-title"},"Link Plugin"),s.createElement("div",{className:"novi-link-plugin-settings-input-label"},this.messages.settings.inputPlaceholder),s.createElement(u,{className:"novi-link-plugin-settings-input",value:this.state.querySelector,onChange:this._onChange}),s.createElement("div",{className:"novi-link-plugin-settings-apply-type"},s.createElement(c,{onChange:this._onCheckboxChange,checked:this.state.applyToProjectElements},this.messages.settings.applyToProjectElements),s.createElement("div",{className:"novi-link-plugin-settings-apply-type-description"},this.messages.settings.applyToProjectElementsDescription)),s.createElement("div",{className:"novi-link-plugin-settings-save-button"},s.createElement(g,{type:"primary",disabled:this.state.hasEmptyValues,className:"novi-link-plugin-settings-save-button",messages:{textContent:this.messages.settings.submitButton},onClick:this._saveSettings}))),s.createElement("div",{className:"novi-link-plugin-settings-right-part"},s.createElement("div",{className:"novi-link-plugin-settings-right-part-header"},s.createElement("span",{className:"novi-link-plugin-settings-title"},this.messages.settings.favoriteLinksTitle),s.createElement("div",{className:"novi-plugin-link-settings-group-add",onClick:this._onAdd},s.createElement("div",{className:"novi-plugin-link-settings-group-add-icon"}))),s.createElement("div",{className:"novi-link-plugin-settings-right-part-body"},this._renderFavoriteLinks()))))}},{key:"_renderFavoriteLinks",value:function(){var e=this,t=0;return this.state.favoriteLinks.map(function(n,i){if(!n.toDelete)return t+=1,s.createElement("div",{key:n.id,className:"novi-link-plugin-settings-group"},s.createElement("div",{className:"novi-link-plugin-settings-group-number"},t,"."),s.createElement("div",{className:"novi-link-plugin-settings-group-item"},s.createElement("span",{className:"novi-link-plugin-settings-input-label"},e.messages.settings.favoriteItemLinkTitle),s.createElement(u,{className:"novi-link-plugin-settings-input",type:"text",value:n.title,onChange:e._onLinkChange.bind(e,i,"title")})),s.createElement("div",{className:"novi-link-plugin-settings-group-item"},s.createElement("span",{className:"novi-link-plugin-settings-input-label"},e.messages.settings.favoriteItemLinkValue," ",s.createElement("span",{style:{float:"right"}},"(",e.messages.settings.linksCountLabel," ",n.count,")")),s.createElement(u,{className:n.duplicated?"novi-link-plugin-settings-input duplicated":"novi-link-plugin-settings-input",type:"text",value:n.value,onChange:e._onLinkChange.bind(e,i,"value")}),e._renderDuplicatedItemIcon(n)),s.createElement("div",{onClick:e._onRemove.bind(e,i),className:"novi-link-plugin-settings-group-remove-button"},s.createElement("svg",{viewBox:"0 0 20 20"},s.createElement("path",{d:"M10.707 10.5l8.646-8.646c0.195-0.195 0.195-0.512 0-0.707s-0.512-0.195-0.707 0l-8.646 8.646-8.646-8.646c-0.195-0.195-0.512-0.195-0.707 0s-0.195 0.512 0 0.707l8.646 8.646-8.646 8.646c-0.195 0.195-0.195 0.512 0 0.707 0.098 0.098 0.226 0.146 0.354 0.146s0.256-0.049 0.354-0.146l8.646-8.646 8.646 8.646c0.098 0.098 0.226 0.146 0.354 0.146s0.256-0.049 0.354-0.146c0.195-0.195 0.195-0.512 0-0.707l-8.646-8.646z"}))))})}},{key:"_renderDuplicatedItemIcon",value:function(e){return e.duplicated?(novi.tooltip.forceUpdate(),s.createElement("div",{className:"novi-link-plugin-duplicated-icon","data-for":e.duplicated?"tooltip-global":"","data-tip":this.messages.settings.duplicateError},p.ICON_WARNING)):null}},{key:"_getFavoriteLinks",value:function(e){this.counterId=e.length;var t=e.map(function(e,t){var n=Object.assign({},e);return n.value&&(n.initValue=n.value),n.id=t,n}),n=void 0;for(var i in t)n=0,novi.utils.loopElementsBySelector('a[href="'+t[i].value+'"]',function(){n++},!1),t[i].count=n;return this._isItemValueDuplicate(t)}},{key:"_onChange",value:function(e){this.setState({querySelector:e.target.value})}},{key:"_onCheckboxChange",value:function(e){this.setState({applyToProjectElements:e})}},{key:"_onLinkChange",value:function(e,t,n){var i=!1,a=this._immutableCopy(this.state.favoriteLinks);if(a[e][t]=n.target.value,this._hasEmptyValues(a)&&(i=!0),"value"===t){var l=0;novi.utils.loopElementsBySelector('a[href="'+a[e].value+'"]',function(){l++},!1),a[e].count=l}this.setState({favoriteLinks:this._isItemValueDuplicate(a),hasEmptyValues:i})}},{key:"_onRemove",value:function(e){var t=this._immutableCopy(this.state.favoriteLinks),n=!1;t[e].toDelete=!0,t[e].initValue&&(t[e].value="#"),this._getFavoriteLinksLength(t)||(t.unshift({value:"",title:"",id:this.counterId,count:0}),this.counterId+=1),this._hasEmptyValues(t)&&(n=!0),this.setState({favoriteLinks:this._isItemValueDuplicate(t),hasEmptyValues:n})}},{key:"_onAdd",value:function(){var e=this._immutableCopy(this.state.favoriteLinks);e.unshift({value:"",title:"",id:this.counterId,count:0}),this.counterId+=1,this.setState({favoriteLinks:this._isItemValueDuplicate(e),hasEmptyValues:!0})}},{key:"_saveSettings",value:function(){var e=this._immutableCopy(this.state.favoriteLinks);this._changeProjectLinks(e),e=e.filter(function(e){return!e.toDelete}).map(function(e){return{value:e.value,title:e.title,id:e.id}});var t={settings:{querySelector:this.state.querySelector,favoriteLinks:e,applyToProjectElements:this.state.applyToProjectElements}};this.setState(t.settings),novi.plugins.settings.update("novi-plugin-link",t.settings)}},{key:"_immutableCopy",value:function(e){return e.slice().map(function(e){return Object.assign({},e)})}},{key:"_changeProjectLinks",value:function(e){if(e.length&&this.state.applyToProjectElements)for(var t=0;t<e.length;t++){var n=function(t){var n=e[t].initValue,i=e[t].value;if(n&&n!==i&&"index.html"!==n){if(e[t].toDelete&&e[t].duplicated)return{v:void 0};novi.utils.loopElementsBySelector('a[href="'+n+'"]',function(e,t,n){n?novi.element.setAttribute(t,"href",i):e.setAttribute("href",i)})}}(t);if("object"===(void 0===n?"undefined":l(n)))return n.v}}},{key:"_getFavoriteLinksLength",value:function(e){for(var t=0,n=0;n<e.length;n++)e[n].toDelete||(t+=1);return t}},{key:"_isItemValueDuplicate",value:function(e){var t=void 0;for(var n in e)if(!e[n].toDelete){t=!1;for(var i in e)n!==i&&(e[i].value!==e[n].value||e[i].toDelete||(t=!0,e[i].duplicated=!0));e[n].duplicated=t}return e}},{key:"_hasEmptyValues",value:function(e){for(var t=0,n=0,i=0;i<e.length;i++)e[i].toDelete||(t+=1,e[i].value&&e[i].title||(n+=1));return!!n&&(1!==n||1!==t)}}]),t}(r);t.default=h},function(e,t){"use strict";function n(e){return!!(e&&e.hasAttribute("href")&&novi.element.hasAttribute(e,"href"))&&e.getAttribute("href")===novi.element.getAttribute(e,"href")}Object.defineProperty(t,"__esModule",{value:!0}),t.isLinkReplaceble=n}]);