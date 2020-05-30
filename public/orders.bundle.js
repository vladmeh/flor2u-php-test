(window["webpackJsonp"] = window["webpackJsonp"] || []).push([["orders.bundle"],{

/***/ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/OrderList.vue?vue&type=script&lang=js&":
/*!********************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib??ref--4-0!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/components/OrderList.vue?vue&type=script&lang=js& ***!
  \********************************************************************************************************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _model_Order__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ../model/Order */ "./resources/js/model/Order.js");
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//

/* harmony default export */ __webpack_exports__["default"] = ({
  name: "Orders",
  data: function data() {
    return {
      orders: [],
      meta: null,
      links: {
        first: null,
        last: null,
        next: null,
        prev: null
      },
      statuses: {
        0: "новый",
        10: "подтвержден",
        20: "завершен"
      },
      error: null
    };
  },
  computed: {
    nextPage: function nextPage() {
      if (!this.meta || this.meta.current_page === this.meta.last_page) {
        return;
      }

      return this.meta.current_page + 1;
    },
    prevPage: function prevPage() {
      if (!this.meta || this.meta.current_page === 1) {
        return;
      }

      return this.meta.current_page - 1;
    },
    paginationCount: function paginationCount() {
      if (!this.meta) {
        return;
      }

      var _this$meta = this.meta,
          current_page = _this$meta.current_page,
          last_page = _this$meta.last_page;
      return "".concat(current_page, " of ").concat(last_page);
    }
  },
  beforeRouteEnter: function beforeRouteEnter(to, from, next) {
    _model_Order__WEBPACK_IMPORTED_MODULE_0__["default"].getOrders(to.query.page, function (err, data) {
      next(function (vm) {
        return vm.setData(err, data);
      });
    });
  },
  beforeRouteUpdate: function beforeRouteUpdate(to, from, next) {
    var _this = this;

    this.orders = this.links = this.meta = null;
    _model_Order__WEBPACK_IMPORTED_MODULE_0__["default"].getOrders(to.query.page, function (err, data) {
      _this.setData(err, data);

      next();
    });
  },
  methods: {
    fetchData: function fetchData() {
      var _this2 = this;

      return _model_Order__WEBPACK_IMPORTED_MODULE_0__["default"].all(function (orders) {
        return _this2.orders = orders;
      });
    },
    costOrder: function costOrder(products) {
      return products.map(function (item) {
        return item.price * item.quantity;
      }).reduce(function (a, b) {
        return a + b;
      }, 0);
    },
    setData: function setData(err, _ref) {
      var orders = _ref.data,
          links = _ref.links,
          meta = _ref.meta;

      if (err) {
        this.error = err.toString();
      } else {
        this.orders = orders;
        this.links = links;
        this.meta = meta;
      }
    }
  }
});

/***/ }),

/***/ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/OrderList.vue?vue&type=template&id=2b02cd9e&":
/*!************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/components/OrderList.vue?vue&type=template&id=2b02cd9e& ***!
  \************************************************************************************************************************************************************************************************************/
/*! exports provided: render, staticRenderFns */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "render", function() { return render; });
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "staticRenderFns", function() { return staticRenderFns; });
var render = function() {
  var _vm = this
  var _h = _vm.$createElement
  var _c = _vm._self._c || _h
  return _c("div", [
    _c("h1", { staticClass: "mb-3 text-3xl" }, [_vm._v("Список заказов")]),
    _vm._v(" "),
    _c("div", { staticClass: "mb-3 flex justify-between items-center" }, [
      _c(
        "div",
        [
          _c(
            "router-link",
            {
              staticClass:
                "bg-white hover:bg-gray-100 text-gray-800 font-semibold py-2 px-4 border border-gray-400 rounded shadow",
              class: !_vm.prevPage ? "opacity-50 cursor-not-allowed" : "",
              attrs: {
                tag: "button",
                to: { query: { page: _vm.prevPage } },
                disabled: !_vm.prevPage
              }
            },
            [_vm._v("Previous")]
          ),
          _vm._v(" "),
          _c(
            "router-link",
            {
              staticClass:
                "bg-white hover:bg-gray-100 text-gray-800 font-semibold py-2 px-4 border border-gray-400 rounded shadow",
              class: !_vm.nextPage ? "opacity-50 cursor-not-allowed" : "",
              attrs: {
                tag: "button",
                to: { query: { page: _vm.nextPage } },
                disabled: !_vm.nextPage
              }
            },
            [_vm._v("Next")]
          )
        ],
        1
      ),
      _vm._v(" "),
      _c("div", {
        staticClass: "font-bold",
        domProps: { textContent: _vm._s(_vm.paginationCount) }
      })
    ]),
    _vm._v(" "),
    _c("table", { staticClass: "shadow-lg w-full table-auto" }, [
      _vm._m(0),
      _vm._v(" "),
      _c(
        "tbody",
        _vm._l(_vm.orders, function(order) {
          return _c("tr", [
            _c(
              "td",
              { staticClass: "border px-4 py-2" },
              [
                _c(
                  "router-link",
                  {
                    staticClass:
                      "flex hover:bg-gray-100 hover:shadow-outline items-center justify-center",
                    attrs: {
                      to: { name: "order.show", params: { id: order.id } }
                    }
                  },
                  [_vm._v(_vm._s(order.id))]
                )
              ],
              1
            ),
            _vm._v(" "),
            _c("td", {
              staticClass: "border px-4 py-2",
              domProps: { textContent: _vm._s(order.partner.name) }
            }),
            _vm._v(" "),
            _c("td", {
              staticClass: "border px-4 py-2",
              domProps: {
                textContent: _vm._s(_vm.costOrder(order.products) + " руб.")
              }
            }),
            _vm._v(" "),
            _c(
              "td",
              { staticClass: "border px-4 py-2" },
              _vm._l(order.products, function(product) {
                return _c("div", {
                  domProps: { textContent: _vm._s(product.name) }
                })
              }),
              0
            ),
            _vm._v(" "),
            _c("td", {
              staticClass: "border px-4 py-2",
              domProps: { textContent: _vm._s(_vm.statuses[order.status]) }
            })
          ])
        }),
        0
      )
    ])
  ])
}
var staticRenderFns = [
  function() {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c("thead", [
      _c("tr", [
        _c("th", { staticClass: "bg-gray-200 border px-4 py-4" }, [
          _vm._v("Заказ №")
        ]),
        _vm._v(" "),
        _c("th", { staticClass: "bg-gray-200 border px-4 py-4" }, [
          _vm._v("Партнер")
        ]),
        _vm._v(" "),
        _c("th", { staticClass: "bg-gray-200 border px-4 py-4" }, [
          _vm._v("Стоимость Заказа")
        ]),
        _vm._v(" "),
        _c("th", { staticClass: "bg-gray-200 border px-4 py-4" }, [
          _vm._v("Состав Заказа")
        ]),
        _vm._v(" "),
        _c("th", { staticClass: "bg-gray-200 border px-4 py-4" }, [
          _vm._v("Статус Заказа")
        ])
      ])
    ])
  }
]
render._withStripped = true



/***/ }),

/***/ "./resources/js/components/OrderList.vue":
/*!***********************************************!*\
  !*** ./resources/js/components/OrderList.vue ***!
  \***********************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _OrderList_vue_vue_type_template_id_2b02cd9e___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./OrderList.vue?vue&type=template&id=2b02cd9e& */ "./resources/js/components/OrderList.vue?vue&type=template&id=2b02cd9e&");
/* harmony import */ var _OrderList_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./OrderList.vue?vue&type=script&lang=js& */ "./resources/js/components/OrderList.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport *//* harmony import */ var _node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ../../../node_modules/vue-loader/lib/runtime/componentNormalizer.js */ "./node_modules/vue-loader/lib/runtime/componentNormalizer.js");





/* normalize component */

var component = Object(_node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__["default"])(
  _OrderList_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__["default"],
  _OrderList_vue_vue_type_template_id_2b02cd9e___WEBPACK_IMPORTED_MODULE_0__["render"],
  _OrderList_vue_vue_type_template_id_2b02cd9e___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"],
  false,
  null,
  null,
  null
  
)

/* hot reload */
if (false) { var api; }
component.options.__file = "resources/js/components/OrderList.vue"
/* harmony default export */ __webpack_exports__["default"] = (component.exports);

/***/ }),

/***/ "./resources/js/components/OrderList.vue?vue&type=script&lang=js&":
/*!************************************************************************!*\
  !*** ./resources/js/components/OrderList.vue?vue&type=script&lang=js& ***!
  \************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_OrderList_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../node_modules/babel-loader/lib??ref--4-0!../../../node_modules/vue-loader/lib??vue-loader-options!./OrderList.vue?vue&type=script&lang=js& */ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/OrderList.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport */ /* harmony default export */ __webpack_exports__["default"] = (_node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_OrderList_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__["default"]); 

/***/ }),

/***/ "./resources/js/components/OrderList.vue?vue&type=template&id=2b02cd9e&":
/*!******************************************************************************!*\
  !*** ./resources/js/components/OrderList.vue?vue&type=template&id=2b02cd9e& ***!
  \******************************************************************************/
/*! exports provided: render, staticRenderFns */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_OrderList_vue_vue_type_template_id_2b02cd9e___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!../../../node_modules/vue-loader/lib??vue-loader-options!./OrderList.vue?vue&type=template&id=2b02cd9e& */ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/OrderList.vue?vue&type=template&id=2b02cd9e&");
/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "render", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_OrderList_vue_vue_type_template_id_2b02cd9e___WEBPACK_IMPORTED_MODULE_0__["render"]; });

/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "staticRenderFns", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_OrderList_vue_vue_type_template_id_2b02cd9e___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"]; });



/***/ }),

/***/ "./resources/js/model/Order.js":
/*!*************************************!*\
  !*** ./resources/js/model/Order.js ***!
  \*************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

function _defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } }

function _createClass(Constructor, protoProps, staticProps) { if (protoProps) _defineProperties(Constructor.prototype, protoProps); if (staticProps) _defineProperties(Constructor, staticProps); return Constructor; }

var Order = /*#__PURE__*/function () {
  function Order() {
    _classCallCheck(this, Order);
  }

  _createClass(Order, null, [{
    key: "all",
    value: function all(then) {
      return fetch('/api/orders', {
        cache: "no-cache"
      }).then(function (response) {
        return response.json();
      }).then(function (_ref) {
        var data = _ref.data;
        return then(data);
      });
    }
  }, {
    key: "getOrders",
    value: function getOrders(page, callback) {
      var params = {
        page: page
      };
      console.log(params);
      axios.get('/api/orders', {
        params: params
      }).then(function (response) {
        callback(null, response.data);
      })["catch"](function (error) {
        callback(error, error.response.data);
      });
    }
  }]);

  return Order;
}();

/* harmony default export */ __webpack_exports__["default"] = (Order);

/***/ })

}]);