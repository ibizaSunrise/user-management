"use strict";
(self["webpackChunk"] = self["webpackChunk"] || []).push([["resources_js_components_Register_vue"],{

/***/ "./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/lib/index.js??vue-loader-options!./resources/js/components/Register.vue?vue&type=script&lang=js&":
/*!***************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/lib/index.js??vue-loader-options!./resources/js/components/Register.vue?vue&type=script&lang=js& ***!
  \***************************************************************************************************************************************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = ({
  name: "Register",
  data: function data() {
    return {
      'name': null,
      'surname': null,
      'email': null,
      'password': null,
      'password_confirmation': null
    };
  },
  methods: {
    register: function register() {
      var _this = this;
      axios.get('/sanctum/csrf-cookie').then(function (response) {
        axios.post('/register', {
          name: _this.name,
          surname: _this.surname,
          email: _this.email,
          password: _this.password,
          password_confirmation: _this.password_confirmation
        }).then(function (res) {
          localStorage.setItem('x_xsrf_token', res.config.headers['X-XSRF-TOKEN']);
          _this.$router.push({
            name: 'users'
          });
        })["catch"](function (er) {
          console.log(er);
        });
      });
    }
  }
});

/***/ }),

/***/ "./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/lib/loaders/templateLoader.js??ruleSet[1].rules[2]!./node_modules/vue-loader/lib/index.js??vue-loader-options!./resources/js/components/Register.vue?vue&type=template&id=97358ae4&scoped=true&":
/*!**************************************************************************************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/lib/loaders/templateLoader.js??ruleSet[1].rules[2]!./node_modules/vue-loader/lib/index.js??vue-loader-options!./resources/js/components/Register.vue?vue&type=template&id=97358ae4&scoped=true& ***!
  \**************************************************************************************************************************************************************************************************************************************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "render": () => (/* binding */ render),
/* harmony export */   "staticRenderFns": () => (/* binding */ staticRenderFns)
/* harmony export */ });
var render = function render() {
  var _vm = this,
    _c = _vm._self._c;
  return _c("div", {
    staticClass: "container center_div"
  }, [_c("div", {
    staticClass: "form-outline mb-4"
  }, [_c("input", {
    directives: [{
      name: "model",
      rawName: "v-model",
      value: _vm.name,
      expression: "name"
    }],
    staticClass: "form-control",
    attrs: {
      type: "text",
      id: "form3Example5"
    },
    domProps: {
      value: _vm.name
    },
    on: {
      input: function input($event) {
        if ($event.target.composing) return;
        _vm.name = $event.target.value;
      }
    }
  }), _vm._v(" "), _c("label", {
    staticClass: "form-label",
    attrs: {
      "for": "form3Example5"
    }
  }, [_vm._v("Name")])]), _vm._v(" "), _c("div", {
    staticClass: "form-outline mb-4"
  }, [_c("input", {
    directives: [{
      name: "model",
      rawName: "v-model",
      value: _vm.surname,
      expression: "surname"
    }],
    staticClass: "form-control",
    attrs: {
      type: "text",
      id: "form3Example6"
    },
    domProps: {
      value: _vm.surname
    },
    on: {
      input: function input($event) {
        if ($event.target.composing) return;
        _vm.surname = $event.target.value;
      }
    }
  }), _vm._v(" "), _c("label", {
    staticClass: "form-label",
    attrs: {
      "for": "form3Example6"
    }
  }, [_vm._v("Surname")])]), _vm._v(" "), _c("div", {
    staticClass: "form-outline mb-4"
  }, [_c("input", {
    directives: [{
      name: "model",
      rawName: "v-model",
      value: _vm.email,
      expression: "email"
    }],
    staticClass: "form-control",
    attrs: {
      type: "email",
      id: "form3Example7"
    },
    domProps: {
      value: _vm.email
    },
    on: {
      input: function input($event) {
        if ($event.target.composing) return;
        _vm.email = $event.target.value;
      }
    }
  }), _vm._v(" "), _c("label", {
    staticClass: "form-label",
    attrs: {
      "for": "form3Example7"
    }
  }, [_vm._v("Email")])]), _vm._v(" "), _c("div", {
    staticClass: "form-outline mb-4"
  }, [_c("input", {
    directives: [{
      name: "model",
      rawName: "v-model",
      value: _vm.password,
      expression: "password"
    }],
    staticClass: "form-control",
    attrs: {
      type: "password",
      id: "form3Example8"
    },
    domProps: {
      value: _vm.password
    },
    on: {
      input: function input($event) {
        if ($event.target.composing) return;
        _vm.password = $event.target.value;
      }
    }
  }), _vm._v(" "), _c("label", {
    staticClass: "form-label",
    attrs: {
      "for": "form3Example8"
    }
  }, [_vm._v("Password")])]), _vm._v(" "), _c("div", {
    staticClass: "form-outline mb-4"
  }, [_c("input", {
    directives: [{
      name: "model",
      rawName: "v-model",
      value: _vm.password_confirmation,
      expression: "password_confirmation"
    }],
    staticClass: "form-control",
    attrs: {
      type: "password",
      id: "form3Example9"
    },
    domProps: {
      value: _vm.password_confirmation
    },
    on: {
      input: function input($event) {
        if ($event.target.composing) return;
        _vm.password_confirmation = $event.target.value;
      }
    }
  }), _vm._v(" "), _c("label", {
    staticClass: "form-label",
    attrs: {
      "for": "form3Example9"
    }
  }, [_vm._v("Password")])]), _vm._v(" "), _c("button", {
    staticClass: "btn btn-primary btn-block mb-4",
    attrs: {
      type: "submit"
    },
    on: {
      click: function click($event) {
        $event.preventDefault();
        return _vm.register.apply(null, arguments);
      }
    }
  }, [_vm._v("Sign up")])]);
};
var staticRenderFns = [];
render._withStripped = true;


/***/ }),

/***/ "./resources/js/components/Register.vue":
/*!**********************************************!*\
  !*** ./resources/js/components/Register.vue ***!
  \**********************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var _Register_vue_vue_type_template_id_97358ae4_scoped_true___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./Register.vue?vue&type=template&id=97358ae4&scoped=true& */ "./resources/js/components/Register.vue?vue&type=template&id=97358ae4&scoped=true&");
/* harmony import */ var _Register_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./Register.vue?vue&type=script&lang=js& */ "./resources/js/components/Register.vue?vue&type=script&lang=js&");
/* harmony import */ var _node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! !../../../node_modules/vue-loader/lib/runtime/componentNormalizer.js */ "./node_modules/vue-loader/lib/runtime/componentNormalizer.js");





/* normalize component */
;
var component = (0,_node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__["default"])(
  _Register_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__["default"],
  _Register_vue_vue_type_template_id_97358ae4_scoped_true___WEBPACK_IMPORTED_MODULE_0__.render,
  _Register_vue_vue_type_template_id_97358ae4_scoped_true___WEBPACK_IMPORTED_MODULE_0__.staticRenderFns,
  false,
  null,
  "97358ae4",
  null
  
)

/* hot reload */
if (false) { var api; }
component.options.__file = "resources/js/components/Register.vue"
/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (component.exports);

/***/ }),

/***/ "./resources/js/components/Register.vue?vue&type=script&lang=js&":
/*!***********************************************************************!*\
  !*** ./resources/js/components/Register.vue?vue&type=script&lang=js& ***!
  \***********************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var _node_modules_babel_loader_lib_index_js_clonedRuleSet_5_use_0_node_modules_vue_loader_lib_index_js_vue_loader_options_Register_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!../../../node_modules/vue-loader/lib/index.js??vue-loader-options!./Register.vue?vue&type=script&lang=js& */ "./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/lib/index.js??vue-loader-options!./resources/js/components/Register.vue?vue&type=script&lang=js&");
 /* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (_node_modules_babel_loader_lib_index_js_clonedRuleSet_5_use_0_node_modules_vue_loader_lib_index_js_vue_loader_options_Register_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__["default"]); 

/***/ }),

/***/ "./resources/js/components/Register.vue?vue&type=template&id=97358ae4&scoped=true&":
/*!*****************************************************************************************!*\
  !*** ./resources/js/components/Register.vue?vue&type=template&id=97358ae4&scoped=true& ***!
  \*****************************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "render": () => (/* reexport safe */ _node_modules_babel_loader_lib_index_js_clonedRuleSet_5_use_0_node_modules_vue_loader_lib_loaders_templateLoader_js_ruleSet_1_rules_2_node_modules_vue_loader_lib_index_js_vue_loader_options_Register_vue_vue_type_template_id_97358ae4_scoped_true___WEBPACK_IMPORTED_MODULE_0__.render),
/* harmony export */   "staticRenderFns": () => (/* reexport safe */ _node_modules_babel_loader_lib_index_js_clonedRuleSet_5_use_0_node_modules_vue_loader_lib_loaders_templateLoader_js_ruleSet_1_rules_2_node_modules_vue_loader_lib_index_js_vue_loader_options_Register_vue_vue_type_template_id_97358ae4_scoped_true___WEBPACK_IMPORTED_MODULE_0__.staticRenderFns)
/* harmony export */ });
/* harmony import */ var _node_modules_babel_loader_lib_index_js_clonedRuleSet_5_use_0_node_modules_vue_loader_lib_loaders_templateLoader_js_ruleSet_1_rules_2_node_modules_vue_loader_lib_index_js_vue_loader_options_Register_vue_vue_type_template_id_97358ae4_scoped_true___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!../../../node_modules/vue-loader/lib/loaders/templateLoader.js??ruleSet[1].rules[2]!../../../node_modules/vue-loader/lib/index.js??vue-loader-options!./Register.vue?vue&type=template&id=97358ae4&scoped=true& */ "./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/lib/loaders/templateLoader.js??ruleSet[1].rules[2]!./node_modules/vue-loader/lib/index.js??vue-loader-options!./resources/js/components/Register.vue?vue&type=template&id=97358ae4&scoped=true&");


/***/ })

}]);