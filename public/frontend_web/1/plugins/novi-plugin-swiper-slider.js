(function(){function r(e,n,t){function o(i,f){if(!n[i]){if(!e[i]){var c="function"==typeof require&&require;if(!f&&c)return c(i,!0);if(u)return u(i,!0);var a=new Error("Cannot find module '"+i+"'");throw a.code="MODULE_NOT_FOUND",a}var p=n[i]={exports:{}};e[i][0].call(p.exports,function(r){var n=e[i][1][r];return o(n||r)},p,p.exports,r,e,n,t)}return n[i].exports}for(var u="function"==typeof require&&require,i=0;i<t.length;i++)o(t[i]);return o}return r})()({1:[function(require,module,exports){
"use strict";

Object.defineProperty(exports, "__esModule", {
    value: true
});

var _Utils = require("./Utils");

var Utils = _interopRequireWildcard(_Utils);

function _interopRequireWildcard(obj) { if (obj && obj.__esModule) { return obj; } else { var newObj = {}; if (obj != null) { for (var key in obj) { if (Object.prototype.hasOwnProperty.call(obj, key)) newObj[key] = obj[key]; } } newObj.default = obj; return newObj; } }

var React = novi.react.React;
var Icons = novi.ui.icons;
var Icon = novi.ui.icon;
var messages = novi.language.getDataByKey("novi-plugin-swiper-slider");
var AddSlideItem = {
    trigger: React.createElement(
        Icon,
        null,
        Icons.ICON_PLUS_SQUARE
    ),
    tooltip: messages.editor.addSlide.tooltip,
    closeIcon: "submit",
    title: messages.editor.addSlide.title,
    collapsed: true,
    onTriggerClick: addSlide
};

exports.default = AddSlideItem;


function addSlide(element) {
    var correctPath = path.replace(/['|"]/g, "");
    var currentSlide = Utils.getCurrentSlideElement(element);
    if (!currentSlide) return;

    var staticElement = novi.element.getStaticReference(currentSlide);
    var slidesCount = Utils.getSlidesCount(element);
    if (!staticElement) return;

    var newStaticSlide = staticElement.cloneNode(true);
    var staticSlideParent = novi.element.getStaticReference(currentSlide.parentNode);
    novi.element.appendStatic(newStaticSlide, staticSlideParent);
    var newDynamicSlide = novi.element.map(newStaticSlide);
    var url = void 0;

    var swiper = element.swiper;
    swiper.appendSlide(newDynamicSlide);
    if (url = newDynamicSlide.getAttribute("data-slide-bg")) {
        newDynamicSlide.style["backgroundImage"] = "url(" + url + ")";
        newDynamicSlide.style["backgroundSize"] = "cover";
    }
    swiper.slideTo(slidesCount);
}

},{"./Utils":7}],2:[function(require,module,exports){
"use strict";

Object.defineProperty(exports, "__esModule", {
    value: true
});

var _Utils = require("./Utils");

var Utils = _interopRequireWildcard(_Utils);

function _interopRequireWildcard(obj) { if (obj && obj.__esModule) { return obj; } else { var newObj = {}; if (obj != null) { for (var key in obj) { if (Object.prototype.hasOwnProperty.call(obj, key)) newObj[key] = obj[key]; } } newObj.default = obj; return newObj; } }

var React = novi.react.React;
var Icons = novi.ui.icons;
var Icon = novi.ui.icon;
var messages = novi.language.getDataByKey("novi-plugin-swiper-slider");
var RemoveSlideItem = {
    trigger: React.createElement(
        Icon,
        null,
        Icons.ICON_MINUS_SQUARE
    ),
    tooltip: messages.editor.removeSlide.tooltip,
    closeIcon: "submit",
    title: messages.editor.removeSlide.title,
    collapsed: true,
    onTriggerClick: removeSlide
};

exports.default = RemoveSlideItem;


function removeSlide(element) {
    var currentSlideIndex = Utils.getCurrentSlideIndex(element);
    var currentSlide = Utils.getCurrentSlideElement(element);
    var staticCurrentSlide = novi.element.getStaticReference(currentSlide);
    var slidesCount = Utils.getSlidesCount(element);
    if (!currentSlide || slidesCount <= 1) return;

    var swiper = element.swiper;
    swiper.removeSlide(currentSlideIndex);
    novi.element.removeStatic(staticCurrentSlide);
}

},{"./Utils":7}],3:[function(require,module,exports){
"use strict";

Object.defineProperty(exports, "__esModule", {
    value: true
});

var _Utils = require("./Utils");

var Utils = _interopRequireWildcard(_Utils);

function _interopRequireWildcard(obj) { if (obj && obj.__esModule) { return obj; } else { var newObj = {}; if (obj != null) { for (var key in obj) { if (Object.prototype.hasOwnProperty.call(obj, key)) newObj[key] = obj[key]; } } newObj.default = obj; return newObj; } }

var React = novi.react.React;
var Icons = novi.ui.icons;
var Icon = novi.ui.icon;
var Types = novi.types;
var messages = novi.language.getDataByKey("novi-plugin-swiper-slider");
var ReplaceImageItem = {
    trigger: React.createElement(
        Icon,
        null,
        Icons.ICON_BG_IMAGE
    ),
    tooltip: messages.editor.imageReplace.tooltip,
    closeIcon: "submit",
    title: messages.editor.imageReplace.title,
    onTriggerClick: onClick
};

exports.default = ReplaceImageItem;


function onClick(element) {
    var ratio = element.offsetWidth / element.offsetHeight;
    novi.media.choose({ onSubmit: onSubmitCrop.bind(this, element), width: element.offsetWidth, height: element.offsetHeight, type: Types.mediaImage });
}

function onSubmitCrop(element, path) {
    var correctPath = path.replace(/['|"]/g, "");
    var currentSlide = Utils.getCurrentSlideElement(element);
    if (!currentSlide) return;

    novi.element.setAttribute(currentSlide, "data-slide-bg", correctPath);
    currentSlide.style["backgroundImage"] = "url(" + correctPath + ")";
    currentSlide.setAttribute("data-slide-bg", correctPath);

    if ($(currentSlide).closest('.swiper-gallery').find('.gallery-thumbs').length > 0) {
        $(currentSlide).closest('.swiper-gallery').find('.gallery-thumbs .swiper-slide-active').attr("data-slide-bg", correctPath).css('backgroundImage', 'url(' + correctPath + ')');
    }

    //console.log($(currentSlide).closest('.swiper-gallery').find('.gallery-thumbs .swiper-slide-active'));
}

},{"./Utils":7}],4:[function(require,module,exports){
"use strict";

Object.defineProperty(exports, "__esModule", {
    value: true
});

var _createClass = function () { function defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } } return function (Constructor, protoProps, staticProps) { if (protoProps) defineProperties(Constructor.prototype, protoProps); if (staticProps) defineProperties(Constructor, staticProps); return Constructor; }; }();

function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

function _possibleConstructorReturn(self, call) { if (!self) { throw new ReferenceError("this hasn't been initialised - super() hasn't been called"); } return call && (typeof call === "object" || typeof call === "function") ? call : self; }

function _inherits(subClass, superClass) { if (typeof superClass !== "function" && superClass !== null) { throw new TypeError("Super expression must either be null or a function, not " + typeof superClass); } subClass.prototype = Object.create(superClass && superClass.prototype, { constructor: { value: subClass, enumerable: false, writable: true, configurable: true } }); if (superClass) Object.setPrototypeOf ? Object.setPrototypeOf(subClass, superClass) : subClass.__proto__ = superClass; }

var React = novi.react.React;
var Component = novi.react.Component;
var Input = novi.ui.input;
var Select = novi.ui.select;
var Button = novi.ui.button;
var Language = novi.language;

var Settings = function (_Component) {
    _inherits(Settings, _Component);

    function Settings(props) {
        _classCallCheck(this, Settings);

        var _this = _possibleConstructorReturn(this, (Settings.__proto__ || Object.getPrototypeOf(Settings)).call(this));

        _this.state = {
            querySelector: props.settings.querySelector,
            effects: props.settings.effects
        };
        _this.saveSettings = _this.saveSettings.bind(_this);
        _this.onChange = _this.onChange.bind(_this);
        _this.onEffectChange = _this.onEffectChange.bind(_this);

        _this.effects = [{ label: "Slide", value: "slide", clearableValue: false }, { label: "Fade", value: "fade", clearableValue: false }, { label: "Cube", value: "cube" }, { label: "Coverflow", value: "coverflow" }, { label: "Flip", value: "flip" }];
        _this.messages = Language.getDataByKey("novi-plugin-swiper-slider");
        return _this;
    }

    _createClass(Settings, [{
        key: "componentWillReceiveProps",
        value: function componentWillReceiveProps(props) {
            this.setState({
                querySelector: props.settings.querySelector,
                effects: props.settings.effects
            });
        }
    }, {
        key: "render",
        value: function render() {
            return React.createElement(
                "div",
                null,
                React.createElement(
                    "span",
                    { style: { letterSpacing: "0,0462em" } },
                    "Swiper Slider Plugin"
                ),
                React.createElement(
                    "div",
                    { style: { fontSize: 13, color: "#6E778A", marginTop: 21 } },
                    this.messages.settings.pluginElement
                ),
                React.createElement(Input, { style: { marginTop: 10, width: 340 }, value: this.state.querySelector, onChange: this.onChange }),
                React.createElement(
                    "div",
                    { style: { marginTop: 30, width: 340 } },
                    React.createElement(
                        "div",
                        { style: { fontSize: 13, color: "#6E778A", marginTop: 21 } },
                        this.messages.settings.effects
                    ),
                    React.createElement(Select, { multi: true, searchable: false, style: { marginTop: 10 }, options: this.effects, value: this.state.effects, onChange: this.onEffectChange })
                ),
                React.createElement(
                    "div",
                    { style: { marginTop: 30 } },
                    React.createElement(Button, { type: "primary", messages: { textContent: this.messages.settings.submitButton }, onClick: this.saveSettings })
                )
            );
        }
    }, {
        key: "onChange",
        value: function onChange(e) {
            var value = e.target.value;
            this.setState({
                querySelector: value
            });
        }
    }, {
        key: "onEffectChange",
        value: function onEffectChange(value) {
            this.setState({
                effects: value
            });
        }
    }, {
        key: "saveSettings",
        value: function saveSettings() {
            novi.plugins.settings.update("novi-plugin-swiper-slider", this.state);
        }
    }]);

    return Settings;
}(Component);

exports.default = Settings;

},{}],5:[function(require,module,exports){
'use strict';

Object.defineProperty(exports, "__esModule", {
    value: true
});

var _createClass = function () { function defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } } return function (Constructor, protoProps, staticProps) { if (protoProps) defineProperties(Constructor.prototype, protoProps); if (staticProps) defineProperties(Constructor, staticProps); return Constructor; }; }();

function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

function _possibleConstructorReturn(self, call) { if (!self) { throw new ReferenceError("this hasn't been initialised - super() hasn't been called"); } return call && (typeof call === "object" || typeof call === "function") ? call : self; }

function _inherits(subClass, superClass) { if (typeof superClass !== "function" && superClass !== null) { throw new TypeError("Super expression must either be null or a function, not " + typeof superClass); } subClass.prototype = Object.create(superClass && superClass.prototype, { constructor: { value: subClass, enumerable: false, writable: true, configurable: true } }); if (superClass) Object.setPrototypeOf ? Object.setPrototypeOf(subClass, superClass) : subClass.__proto__ = superClass; }

var Input = novi.ui.input;
var React = novi.react.React;
var Component = novi.react.Component;
var Switcher = novi.ui.switcher;
var Select = novi.ui.select;
var lodash = novi.utils.lodash;
var Language = novi.language;

var Body = function (_Component) {
    _inherits(Body, _Component);

    function Body(props) {
        _classCallCheck(this, Body);

        var _this = _possibleConstructorReturn(this, (Body.__proto__ || Object.getPrototypeOf(Body)).call(this, props));

        var autoplay = novi.element.getAttribute(props.element, 'data-autoplay') !== 'false';
        var autoplayTime = autoplay ? novi.element.getAttribute(props.element, 'data-autoplay') / 1000 : 5;
        var slideEffect = novi.element.getAttribute(props.element, 'data-slide-effect');
        var transitionEffect = slideEffect ? { label: lodash.capitalize(slideEffect), value: slideEffect } : { label: "Slide", value: "slide" };

        _this.state = {
            autoplayTime: autoplayTime,
            autoplay: autoplay,
            transitionEffect: transitionEffect,
            initValue: {
                autoplayTime: autoplayTime,
                autoplay: autoplay,
                transitionEffect: transitionEffect
            },
            element: props.element
        };

        _this.style = '\n        .rd-mailform-wrap{\n            padding: 20px 12px 0;\n            display: flex;\n            flex-direction: column;\n            height: calc(100% - 20px);\n            color: #6E778A;\n        }\n        \n        .swiper-switcher{\n            display: flex;\n            flex-direction: row;\n            justify-content: space-between;\n            align-items: center;\n            margin-top: 16px;\n        }\n      \n        .swiper-switcher .novi-input{\n            width: 55px;\n        }  \n        .swiper-wrap .Select-menu-outer, .swiper-wrap .Select-menu{\n            max-height: 85px;\n        }\n        ';

        _this.effects = novi.plugins.settings.get("novi-plugin-swiper-slider").effects;

        _this._handleAutoplayChange = _this._handleAutoplayChange.bind(_this);
        _this._handleSwitcherChange = _this._handleSwitcherChange.bind(_this);
        _this._handleTransitionEffectChange = _this._handleTransitionEffectChange.bind(_this);
        _this.messages = Language.getDataByKey("novi-plugin-swiper-slider");
        return _this;
    }

    _createClass(Body, [{
        key: 'render',
        value: function render() {
            return React.createElement(
                'div',
                {
                    className: 'swiper-wrap', style: {
                        "padding": "0 12px",
                        "display": "flex",
                        "flexDirection": "column",
                        "justifyContent": "center",
                        "height": "100%",
                        "color": "#6E778A"
                    }
                },
                React.createElement(
                    'style',
                    null,
                    this.style
                ),
                React.createElement(
                    'p',
                    { className: 'novi-label', style: { "marginTop": "0" } },
                    this.messages.editor.settings.body.effect
                ),
                React.createElement(Select, { searchable: false, options: this.effects, value: this.state.transitionEffect, onChange: this._handleTransitionEffectChange }),
                React.createElement(
                    'div',
                    { className: 'swiper-switcher' },
                    React.createElement(
                        'p',
                        { className: 'novi-label', style: { "margin": 0 } },
                        this.messages.editor.settings.body.autoPlay
                    ),
                    React.createElement(Switcher, { isActive: this.state.autoplay, onChange: this._handleSwitcherChange })
                ),
                React.createElement(
                    'div',
                    { className: 'swiper-switcher' },
                    React.createElement(
                        'p',
                        { className: 'novi-label', style: { "margin": 0 } },
                        this.messages.editor.settings.body.autoPlayDelay
                    ),
                    React.createElement(Input, { disabled: !this.state.autoplay, onChange: this._handleAutoplayChange, value: this.state.autoplayTime })
                )
            );
        }
    }, {
        key: '_handleAutoplayChange',
        value: function _handleAutoplayChange(e) {
            var value = e.target.value;
            this.setState({
                autoplayTime: value
            });
        }
    }, {
        key: '_handleSwitcherChange',
        value: function _handleSwitcherChange(isActive) {
            this.setState({
                autoplay: isActive
            });
        }
    }, {
        key: '_handleTransitionEffectChange',
        value: function _handleTransitionEffectChange(value) {
            this.setState({
                transitionEffect: value
            });
        }
    }]);

    return Body;
}(Component);

exports.default = Body;

},{}],6:[function(require,module,exports){
"use strict";

Object.defineProperty(exports, "__esModule", {
    value: true
});

var _SettingsBody = require("./SettingsBody");

var _SettingsBody2 = _interopRequireDefault(_SettingsBody);

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { default: obj }; }

var React = novi.react.React;
var Icons = novi.ui.icons;
var Icon = novi.ui.icon;
var lodash = novi.utils.lodash;
var messages = novi.language.getDataByKey("novi-plugin-swiper-slider");
var icon = React.createElement(
    Icon,
    null,
    React.createElement(
        "svg",
        { viewBox: "0 0 27 16", style: { height: 28, width: 28, maxWidth: "inherit", maxHeight: "inherit" } },
        React.createElement("path", {
            d: "M17,10 C15.8976,10 15,9.1024 15,8 C15,6.8976 15.8976,6 17,6 C18.1024,6 19,6.8976 19,8 C19,9.1024 18.1024,10 17,10 Z M17,7 C16.4486667,7 16,7.44866667 16,8 C16,8.55133333 16.4486667,9 17,9 C17.5513333,9 18,8.55133333 18,8 C18,7.44866667 17.5513333,7 17,7 Z"
        }),
        React.createElement("path", {
            d: "M8,1 L8,2.05144019 L19,2.0758879 L19,1 L8,1 Z M8,0 L19,0 C19.5522847,-1.01453063e-16 20,0.44771525 20,1 L20,2.08777076 L7,2.0470348 L7,1 C7,0.44771525 7.44771525,1.01453063e-16 8,0 Z"
        }),
        React.createElement("path", {
            d: "M20.5,2 L6.5,2 C5.673,2 5,2.673 5,3.5 L5,14.5 C5,15.327 5.673,16 6.5,16 L20.5,16 C21.327,16 22,15.327 22,14.5 L22,3.5 C22,2.673 21.327,2 20.5,2 Z M6,12.693 L10.197,8.076 C10.282,7.983 10.393,7.931 10.511,7.929 C10.629,7.927 10.742,7.977 10.829,8.068 L17.329,15 L6.499,15 C6.223,15 5.999,14.776 5.999,14.5 L6,12.693 Z M20.5,15 L18.714,15 L11.553,7.377 C11.272,7.083 10.898,6.925 10.5,6.93 C10.102,6.935 9.732,7.103 9.458,7.404 L6.001,11.207 L6.001,3.5 C6.001,3.224 6.225,3 6.501,3 L20.501,3 C20.777,3 21.001,3.224 21.001,3.5 L21.001,14.5 C21,14.776 20.776,15 20.5,15 Z"
        }),
        React.createElement("path", {
            d: "M2.85325,11.85225 C3.04825,11.65725 3.04825,11.34025 2.85325,11.14525 L1.20725,9.49925 L2.85325,7.85325 C3.04825,7.65825 3.04825,7.34125 2.85325,7.14625 C2.65825,6.95125 2.34125,6.95125 2.14625,7.14625 L0.14625,9.14625 C-0.04875,9.34125 -0.04875,9.65825 0.14625,9.85325 L2.14625,11.85325 C2.24425,11.95125 2.37225,11.99925 2.50025,11.99925 C2.62725,11.99825 2.75525,11.94925 2.85325,11.85225 Z"
        }),
        React.createElement("path", {
            d: "M26.85325,11.85225 C27.04825,11.65725 27.04825,11.34025 26.85325,11.14525 L25.20725,9.49925 L26.85325,7.85325 C27.04825,7.65825 27.04825,7.34125 26.85325,7.14625 C26.65825,6.95125 26.34125,6.95125 26.14625,7.14625 L24.14625,9.14625 C23.95125,9.34125 23.95125,9.65825 24.14625,9.85325 L26.14625,11.85325 C26.24425,11.95125 26.37225,11.99925 26.50025,11.99925 C26.62725,11.99825 26.75525,11.94925 26.85325,11.85225 Z",
            transform: "translate(25.499750, 9.499625) scale(-1, 1) translate(-25.499750, -9.499625) "
        })
    )
);

var SettingsItem = {
    trigger: icon,
    tooltip: messages.editor.settings.tooltip,
    title: messages.editor.settings.title,
    header: [icon, React.createElement(
        "span",
        null,
        messages.editor.settings.header
    )],
    body: [React.createElement(_SettingsBody2.default, null)],
    closeIcon: "submit",
    onSubmit: onSubmitAction,
    collapsed: true,
    width: 320,
    height: 181

};

exports.default = SettingsItem;


function onSubmitAction(headerStates, bodyStates) {
    var state = bodyStates[0];
    var values = {
        autoplayTime: state.autoplayTime,
        autoplay: state.autoplay,
        transitionEffect: state.transitionEffect
    };

    if (lodash.isEqual(state.initValue, values)) return;

    if (state.autoplay) {
        novi.element.setAttribute(state.element, "data-autoplay", state.autoplayTime * 1000);
    } else {
        novi.element.setAttribute(state.element, "data-autoplay", "false");
    }

    novi.element.setAttribute(state.element, "data-slide-effect", state.transitionEffect.value);

    if (!lodash.isEqual(values.transitionEffect, state.initValue.transitionEffect)) novi.page.forceUpdate();
}

},{"./SettingsBody":5}],7:[function(require,module,exports){
"use strict";

Object.defineProperty(exports, "__esModule", {
    value: true
});
exports.getCurrentSlideElement = getCurrentSlideElement;
exports.getSlidesCount = getSlidesCount;
exports.getCurrentSlideIndex = getCurrentSlideIndex;
var utils = novi.utils;
function getCurrentSlideElement(element) {
    return element.querySelector(".swiper-slide.swiper-slide-active");
}

function getSlidesCount(element) {
    var slidesParent = element.querySelector(".swiper-slide.swiper-slide-active").parentNode;
    if (!slidesParent) return null;
    var j = 0,
        slideCounter = 0;

    while (j < slidesParent.childNodes.length) {
        if (utils.dom.isElementNode(slidesParent.childNodes[j])) {
            slideCounter++;
        }

        j++;
    }

    return slideCounter;
}

function getCurrentSlideIndex(element) {
    var tmpCurrent = element.querySelector(".swiper-slide.swiper-slide-active");
    if (!tmpCurrent) return null;

    var childNodes = tmpCurrent.parentNode.childNodes;
    var elementCounter = 0;
    for (var i = 0; i < childNodes.length; i++) {
        if (childNodes[i] === tmpCurrent) {
            return elementCounter;
        }
        if (childNodes[i].nodeType === 1) elementCounter++;
    }

    return null;
}

},{}],8:[function(require,module,exports){
"use strict";

var _ReplaceImageItem = require("./ReplaceImageItem");

var _ReplaceImageItem2 = _interopRequireDefault(_ReplaceImageItem);

var _AddSlideItem = require("./AddSlideItem");

var _AddSlideItem2 = _interopRequireDefault(_AddSlideItem);

var _RemoveSlideItem = require("./RemoveSlideItem");

var _RemoveSlideItem2 = _interopRequireDefault(_RemoveSlideItem);

var _SettingsItem = require("./SettingsItem");

var _SettingsItem2 = _interopRequireDefault(_SettingsItem);

var _Settings = require("./Settings");

var _Settings2 = _interopRequireDefault(_Settings);

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { default: obj }; }

var React = novi.react.React;

var Language = novi.language;
var Plugin = {
    name: "novi-plugin-swiper-slider",
    title: "Novi Swiper Slider",
    description: "Novi Swiper Slider description",
    version: "1.0.3",
    dependencies: {
        novi: "0.9.0"
    },
    defaults: {
        querySelector: '.swiper-container',
        effects: [{ label: "Slide", value: "slide", clearableValue: false }, { label: "Fade", value: "fade", clearableValue: false }]
    },
    ui: {
        editor: [_ReplaceImageItem2.default, _AddSlideItem2.default, _RemoveSlideItem2.default, _SettingsItem2.default],
        settings: React.createElement(_Settings2.default, null)
    },
    onLanguageChange: onLanguageChange
};
function onLanguageChange(plugin) {
    var messages = Language.getDataByKey("novi-plugin-swiper-slider");
    plugin.ui.editor[0].title = messages.editor.imageReplace.title;
    plugin.ui.editor[0].tooltip = messages.editor.imageReplace.tooltip;

    plugin.ui.editor[1].title = messages.editor.addSlide.title;
    plugin.ui.editor[1].tooltip = messages.editor.addSlide.tooltip;

    plugin.ui.editor[2].title = messages.editor.removeSlide.title;
    plugin.ui.editor[2].tooltip = messages.editor.removeSlide.tooltip;

    plugin.ui.editor[3].title = messages.editor.settings.title;
    plugin.ui.editor[3].tooltip = messages.editor.settings.tooltip;
    plugin.ui.editor[3].header[1] = React.createElement(
        "span",
        null,
        messages.editor.settings.tooltip
    );

    return plugin;
}
novi.plugins.register(Plugin);

},{"./AddSlideItem":1,"./RemoveSlideItem":2,"./ReplaceImageItem":3,"./Settings":4,"./SettingsItem":6}]},{},[8]);
