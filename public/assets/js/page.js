(window["webpackJsonp"] = window["webpackJsonp"] || []).push([["assets/js/page"],{

/***/ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/Comment.vue?vue&type=script&lang=js&":
/*!******************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib??ref--4-0!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/components/Comment.vue?vue&type=script&lang=js& ***!
  \******************************************************************************************************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
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
  name: 'Comment',
  props: ['data'],
  created: function created() {}
});

/***/ }),

/***/ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/Media6.vue?vue&type=script&lang=js&":
/*!*****************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib??ref--4-0!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/components/Media6.vue?vue&type=script&lang=js& ***!
  \*****************************************************************************************************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
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
  name: 'Media6',
  props: ['data'],
  created: function created() {}
});

/***/ }),

/***/ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/views/Page.vue?vue&type=script&lang=js&":
/*!**********************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib??ref--4-0!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/views/Page.vue?vue&type=script&lang=js& ***!
  \**********************************************************************************************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var vue_owl_carousel__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! vue-owl-carousel */ "./node_modules/vue-owl-carousel/dist/vue-owl-carousel.js");
/* harmony import */ var vue_owl_carousel__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(vue_owl_carousel__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var _components_Sidebar__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ../components/Sidebar */ "./resources/js/components/Sidebar.vue");
/* harmony import */ var _components_Comment__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ../components/Comment */ "./resources/js/components/Comment.vue");
/* harmony import */ var _components_Media6__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! ../components/Media6 */ "./resources/js/components/Media6.vue");
/* harmony import */ var _api__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(/*! ../api */ "./resources/js/api.js");
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


var SocialSharing = __webpack_require__(/*! vue-social-sharing */ "./node_modules/vue-social-sharing/dist/vue-social-sharing.common.js");





/* harmony default export */ __webpack_exports__["default"] = ({
  name: "Page",
  components: {
    Sidebar: _components_Sidebar__WEBPACK_IMPORTED_MODULE_1__["default"],
    Comment: _components_Comment__WEBPACK_IMPORTED_MODULE_2__["default"],
    Media6: _components_Media6__WEBPACK_IMPORTED_MODULE_3__["default"],
    SocialSharing: SocialSharing,
    carousel: vue_owl_carousel__WEBPACK_IMPORTED_MODULE_0___default.a
  },
  watch: {
    $route: function $route(to, from) {
      this.filter.link = this.$router.history.current.params.link;
      this.getData();
    }
  },
  created: function created() {
    this.filter.link = this.$router.history.current.params.link;
    this.getData();
  },
  data: function data() {
    return {
      loading: false,
      error: false,
      filter: {
        link: ''
      },
      data: {},
      comment: {},
      related: []
    };
  },
  methods: {
    share: function share(tp) {
      alert(tp);
    },
    getData: function getData() {
      var _this = this;

      this.loading = true;
      var parameter = {
        client_secret: _api__WEBPACK_IMPORTED_MODULE_4__["api"].clientSecret,
        filter: this.filter
      };
      window.axios.post(_api__WEBPACK_IMPORTED_MODULE_4__["api"].news_detail + "/".concat(this.filter.link), parameter).then(function (res) {
        _this.loading = false;
        _this.error = false;
        var r = res.data;
        var app = _this;
        _this.data = r.data;
        _this.data.meta.url = window.location.href;

        if (_this.data.type_page != 'page') {
          _this.getRelated();
        }

        _this.meta.set(_this.data.meta);
      })["catch"](function (err) {
        _this.loading = false;
        _this.error = true; // console.log(err);
      });
    },
    getRelated: function getRelated() {
      var _this2 = this;

      var parameter = {
        client_secret: _api__WEBPACK_IMPORTED_MODULE_4__["api"].clientSecret,
        filter: this.filter
      };
      window.axios.post(_api__WEBPACK_IMPORTED_MODULE_4__["api"].news_detail_related + "/".concat(this.filter.link), parameter).then(function (res) {
        var r = res.data;
        var app = _this2;
        _this2.related = r.data;
      })["catch"](function (err) {// console.log(err);
      });
    },
    getComment: function getComment() {
      var _this3 = this;

      var parameter = {
        client_secret: _api__WEBPACK_IMPORTED_MODULE_4__["api"].clientSecret,
        filter: this.filter
      };
      window.axios.post(_api__WEBPACK_IMPORTED_MODULE_4__["api"].news_detail_comment, parameter).then(function (res) {
        var r = res.data;
        var app = _this3;
        _this3.comment = r.data;
      })["catch"](function (err) {// console.log(err);
      });
    }
  }
});

/***/ }),

/***/ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/Comment.vue?vue&type=template&id=54ded044&":
/*!**********************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/components/Comment.vue?vue&type=template&id=54ded044& ***!
  \**********************************************************************************************************************************************************************************************************/
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
  return _vm._m(0)
}
var staticRenderFns = [
  function() {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c("div", [
      _c("div", { staticClass: "readers_comment" }, [
        _c("div", { staticClass: "single_media_title" }, [
          _c("h2", [_vm._v("Related Comments")])
        ]),
        _vm._v(" "),
        _c("div", { staticClass: "media" }, [
          _c("div", { staticClass: "media-left" }, [
            _c("a", { attrs: { href: "#" } }, [
              _c("img", {
                staticClass: "media-object",
                attrs: {
                  alt: "64x64",
                  "data-src": "assets/img/img-author1.jpg",
                  src: "assets/img/img-author1.jpg",
                  "data-holder-rendered": "true"
                }
              })
            ])
          ]),
          _vm._v(" "),
          _c("div", { staticClass: "media-body" }, [
            _c("h2", { staticClass: "media-heading" }, [_vm._v("Sr. Ryan")]),
            _vm._v(
              "\n                But who has any right to find fault with a man who chooses to enjoy a pleasure that has\n                no annoying consequences, or one who avoids a pain that produces no resultant pleasure?\n                "
            ),
            _c("div", { staticClass: "comment_article_social" }, [
              _c("a", { attrs: { href: "#" } }, [
                _c("i", {
                  staticClass: "fa fa-thumbs-o-up",
                  attrs: { "aria-hidden": "true" }
                })
              ]),
              _vm._v(" "),
              _c("a", { attrs: { href: "#" } }, [
                _c("i", {
                  staticClass: "fa fa-thumbs-o-down",
                  attrs: { "aria-hidden": "true" }
                })
              ]),
              _vm._v(" "),
              _c("a", { attrs: { href: "#" } }, [
                _c("span", { staticClass: "reply_ic" }, [_vm._v("Reply ")])
              ])
            ]),
            _vm._v(" "),
            _c("div", { staticClass: "media reply" }, [
              _c("div", { staticClass: "media-left" }, [
                _c("a", { attrs: { href: "#" } }, [
                  _c("img", {
                    staticClass: "media-object",
                    attrs: {
                      alt: "64x64",
                      "data-src": "assets/img/img-author2.jpg",
                      src: "assets/img/img-author2.jpg",
                      "data-holder-rendered": "true"
                    }
                  })
                ])
              ]),
              _vm._v(" "),
              _c("div", { staticClass: "media-body" }, [
                _c("h2", { staticClass: "media-heading" }, [_vm._v("Admin")]),
                _vm._v(
                  "\n                        But who has any right to find fault with a man who chooses to enjoy a pleasure\n                        that has no annoying consequences, or one who avoids a pain that produces no\n                        resultant pleasure?\n                        "
                ),
                _c("div", { staticClass: "comment_article_social" }, [
                  _c("a", { attrs: { href: "#" } }, [
                    _c("i", {
                      staticClass: "fa fa-thumbs-o-up",
                      attrs: { "aria-hidden": "true" }
                    })
                  ]),
                  _vm._v(" "),
                  _c("a", { attrs: { href: "#" } }, [
                    _c("i", {
                      staticClass: "fa fa-thumbs-o-down",
                      attrs: { "aria-hidden": "true" }
                    })
                  ]),
                  _vm._v(" "),
                  _c("a", { attrs: { href: "#" } }, [
                    _c("span", { staticClass: "reply_ic" }, [_vm._v(" Reply ")])
                  ])
                ])
              ])
            ])
          ])
        ]),
        _vm._v(" "),
        _c("div", { staticClass: "media" }, [
          _c("div", { staticClass: "media-left" }, [
            _c("a", { attrs: { href: "#" } }, [
              _c("img", {
                staticClass: "media-object",
                attrs: {
                  alt: "64x64",
                  "data-src": "assets/img/img-author1.jpg",
                  src: "assets/img/img-author1.jpg",
                  "data-holder-rendered": "true"
                }
              })
            ])
          ]),
          _vm._v(" "),
          _c("div", { staticClass: "media-body" }, [
            _c("h2", { staticClass: "media-heading" }, [_vm._v("S. Joshep")]),
            _vm._v(
              "\n                But who has any right to find fault with a man who chooses to enjoy a pleasure that has\n                no annoying consequences, or one who avoids a pain that produces no resultant pleasure?\n                "
            ),
            _c("div", { staticClass: "comment_article_social" }, [
              _c("a", { attrs: { href: "#" } }, [
                _c("i", {
                  staticClass: "fa fa-thumbs-o-up",
                  attrs: { "aria-hidden": "true" }
                })
              ]),
              _vm._v(" "),
              _c("a", { attrs: { href: "#" } }, [
                _c("i", {
                  staticClass: "fa fa-thumbs-o-down",
                  attrs: { "aria-hidden": "true" }
                })
              ]),
              _vm._v(" "),
              _c("a", { attrs: { href: "#" } }, [
                _c("span", { staticClass: "reply_ic" }, [_vm._v(" Reply ")])
              ])
            ])
          ])
        ])
      ]),
      _vm._v(" "),
      _c("div", { staticClass: "add_a_comment" }, [
        _c("div", { staticClass: "single_media_title" }, [
          _c("h2", [_vm._v("Add a Comment")])
        ]),
        _vm._v(" "),
        _c("div", { staticClass: "comment_form" }, [
          _c("form", [
            _c("div", { staticClass: "form-group" }, [
              _c("input", {
                staticClass: "form-control",
                attrs: { type: "text", id: "inputName", placeholder: "Name" }
              })
            ]),
            _vm._v(" "),
            _c("div", { staticClass: "form-group" }, [
              _c("input", {
                staticClass: "form-control",
                attrs: { type: "text", id: "inputEmail", placeholder: "Email" }
              })
            ]),
            _vm._v(" "),
            _c("div", { staticClass: "form-group comment" }, [
              _c("textarea", {
                staticClass: "form-control",
                attrs: { id: "inputComment", placeholder: "Comment" }
              })
            ]),
            _vm._v(" "),
            _c(
              "button",
              { staticClass: "btn btn-submit red", attrs: { type: "submit" } },
              [_vm._v("Submit")]
            )
          ])
        ])
      ])
    ])
  }
]
render._withStripped = true



/***/ }),

/***/ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/Media6.vue?vue&type=template&id=2860fc06&":
/*!*********************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/components/Media6.vue?vue&type=template&id=2860fc06& ***!
  \*********************************************************************************************************************************************************************************************************/
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
  return _c("div", { staticClass: "media" }, [
    _c(
      "div",
      { staticClass: "media-left" },
      [
        _c("router-link", { attrs: { to: _vm.data.link } }, [
          _c("div", {
            staticClass: "skeleton",
            staticStyle: {
              width: "80px",
              height: "80px",
              "background-size": "cover"
            },
            style: { "background-image": "url(" + _vm.data.img + ")" }
          })
        ])
      ],
      1
    ),
    _vm._v(" "),
    _c("div", { staticClass: "media-body" }, [
      _c(
        "h4",
        { staticClass: "media-heading" },
        [
          _c("router-link", { attrs: { to: _vm.data.link } }, [
            _vm._v(
              "\n                        " +
                _vm._s(_vm.data.title) +
                "\n                    "
            )
          ])
        ],
        1
      ),
      _vm._v(" "),
      _c("div", { staticClass: "media_meta" }, [
        _c("a", { attrs: { href: "#" } }, [
          _vm._v(_vm._s(_vm._f("toDateIndo")(_vm.data.date)) + ",")
        ]),
        _vm._v(" by:"),
        _c("a", { attrs: { href: "#" } }, [_vm._v(_vm._s(_vm.data.writer))])
      ]),
      _vm._v(" "),
      _c("div", { staticClass: "media_content" }, [
        _c("div", { staticClass: "prev" }, [
          _vm._v(
            "\n                " +
              _vm._s(_vm.data.content_prev) +
              "\n            "
          )
        ])
      ])
    ])
  ])
}
var staticRenderFns = []
render._withStripped = true



/***/ }),

/***/ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/views/Page.vue?vue&type=template&id=1e4e62ae&":
/*!**************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/views/Page.vue?vue&type=template&id=1e4e62ae& ***!
  \**************************************************************************************************************************************************************************************************/
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
  return _c(
    "section",
    {
      staticClass: "feature_category_section single-page section_wrapper",
      attrs: { id: "feature_category_section" }
    },
    [
      _vm.loading ? _c("MediaSkolten") : _vm._e(),
      _vm._v(" "),
      _vm.error && !_vm.loading
        ? _c("div", { staticClass: "text-center" }, [
            _vm._v("\n        plesae try again, "),
            _c("br"),
            _c(
              "a",
              {
                staticClass: "btn btn btn-danger btn-sm",
                on: {
                  click: function($event) {
                    return _vm.getData()
                  }
                }
              },
              [_vm._v("try")]
            )
          ])
        : _vm._e(),
      _vm._v(" "),
      !_vm.loading && !_vm.error
        ? _c("div", { staticClass: "container" }, [
            _c("div", { staticClass: "row" }, [
              _c("div", { staticClass: "col-md-9" }, [
                _c("div", { staticClass: "single_content_layout" }, [
                  _c(
                    "div",
                    {
                      staticClass: "item feature_news_item",
                      staticStyle: { postion: "relative" }
                    },
                    [
                      _vm.data.img && _vm.data.type_page != "galery"
                        ? _c("div", { staticClass: "item_img" }, [
                            _c("img", {
                              staticClass: "img-responsive",
                              attrs: { src: _vm.data.img, alt: _vm.data.title }
                            })
                          ])
                        : _vm._e(),
                      _vm._v(" "),
                      _vm.data.video
                        ? _c("div", { staticClass: "item_img" }, [
                            _vm.data.video
                              ? _c("iframe", {
                                  attrs: {
                                    width: "100%",
                                    height: "480",
                                    src: _vm.data.video,
                                    frameborder: "0",
                                    gesture: "media",
                                    allowfullscreen: ""
                                  }
                                })
                              : _vm._e()
                          ])
                        : _vm._e(),
                      _vm._v(" "),
                      _c(
                        "div",
                        { staticClass: "galery-div" },
                        [
                          _vm.data.imgs
                            ? _c(
                                "carousel",
                                {
                                  attrs: {
                                    id: "feature_video_slider",
                                    items: 1,
                                    nav: true,
                                    autoplay: false,
                                    loop: false,
                                    dots: false
                                  }
                                },
                                [
                                  _vm._l(_vm.data.imgs, function(item) {
                                    return _c(
                                      "div",
                                      { staticClass: "item_img" },
                                      [
                                        _c("img", {
                                          staticClass: "img-responsive",
                                          attrs: {
                                            src: item.img,
                                            alt: item.name
                                          }
                                        })
                                      ]
                                    )
                                  }),
                                  _vm._v(" "),
                                  _c("template", { slot: "prev" }, [
                                    _c("span", { staticClass: "prev-galery" }, [
                                      _c("i", {
                                        staticClass: "fa fa-arrow-circle-left"
                                      })
                                    ])
                                  ]),
                                  _vm._v(" "),
                                  _c("template", { slot: "next" }, [
                                    _c("span", { staticClass: "next-galery" }, [
                                      _c("i", {
                                        staticClass: "fa fa-arrow-circle-right"
                                      })
                                    ])
                                  ])
                                ],
                                2
                              )
                            : _vm._e()
                        ],
                        1
                      ),
                      _vm._v(" "),
                      _c(
                        "div",
                        { staticClass: "item_wrapper" },
                        [
                          _c("div", { staticClass: "news_item_title" }, [
                            _c("h2", [
                              _c("a", { attrs: { href: "#" } }, [
                                _vm._v(_vm._s(_vm.data.title))
                              ])
                            ])
                          ]),
                          _vm._v(" "),
                          _vm.data.date
                            ? _c("div", { staticClass: "item_meta" }, [
                                _c("a", { attrs: { href: "#" } }, [
                                  _vm._v(
                                    _vm._s(
                                      _vm._f("toDateIndo")(_vm.data.date)
                                    ) + ","
                                  )
                                ]),
                                _vm._v(" by:"),
                                _c("a", { attrs: { href: "#" } }, [
                                  _vm._v(_vm._s(_vm.data.writer))
                                ])
                              ])
                            : _vm._e(),
                          _vm._v(" "),
                          _vm.data.meta
                            ? _c("social-sharing", {
                                attrs: {
                                  url: _vm.data.meta.url,
                                  title: _vm.data.meta.title,
                                  description: _vm.data.meta.description
                                },
                                inlineTemplate: {
                                  render: function() {
                                    var _vm = this
                                    var _h = _vm.$createElement
                                    var _c = _vm._self._c || _h
                                    return _c(
                                      "div",
                                      { staticClass: "single_social_icon" },
                                      [
                                        _c(
                                          "network",
                                          { attrs: { network: "facebook" } },
                                          [
                                            _c(
                                              "a",
                                              { staticClass: "icons-sm fb-ic" },
                                              [
                                                _c("i", {
                                                  staticClass: "fa fa-facebook"
                                                }),
                                                _c("span", [_vm._v("Facbook")])
                                              ]
                                            )
                                          ]
                                        ),
                                        _vm._v(" "),
                                        _c(
                                          "network",
                                          { attrs: { network: "twitter" } },
                                          [
                                            _c(
                                              "a",
                                              { staticClass: "icons-sm tw-ic" },
                                              [
                                                _c("i", {
                                                  staticClass: "fa fa-twitter"
                                                }),
                                                _c("span", [_vm._v("Twitter")])
                                              ]
                                            )
                                          ]
                                        ),
                                        _vm._v(" "),
                                        _c(
                                          "network",
                                          { attrs: { network: "whatsapp" } },
                                          [
                                            _c(
                                              "a",
                                              {
                                                staticClass:
                                                  "icons-sm whatsapp-ic"
                                              },
                                              [
                                                _c("i", {
                                                  staticClass: "fa fa-whatsapp"
                                                }),
                                                _c("span", [_vm._v("Whatsapp")])
                                              ]
                                            )
                                          ]
                                        ),
                                        _vm._v(" "),
                                        _c(
                                          "network",
                                          { attrs: { network: "line" } },
                                          [
                                            _c(
                                              "a",
                                              {
                                                staticClass: "icons-sm line-ic"
                                              },
                                              [
                                                _c("i", {
                                                  staticClass:
                                                    "fa fa-commenting-o"
                                                }),
                                                _c("span", [_vm._v("Line")])
                                              ]
                                            )
                                          ]
                                        ),
                                        _vm._v(" "),
                                        _c(
                                          "network",
                                          { attrs: { network: "email" } },
                                          [
                                            _c(
                                              "a",
                                              { staticClass: "icons-sm li-ic" },
                                              [
                                                _c("i", {
                                                  staticClass: "fa fa-envelope"
                                                }),
                                                _c("span", [_vm._v("Email")])
                                              ]
                                            )
                                          ]
                                        )
                                      ],
                                      1
                                    )
                                  },
                                  staticRenderFns: []
                                }
                              })
                            : _vm._e(),
                          _vm._v(" "),
                          _c("div", {
                            staticClass: "item_content",
                            domProps: { innerHTML: _vm._s(_vm.data.content) }
                          }),
                          _vm._v(" "),
                          _vm._l(_vm.data.content_slide, function(item) {
                            return _c("div", [
                              _c("h3", [
                                _vm._v(
                                  "\n                                        " +
                                    _vm._s(item.display_order) +
                                    ".  " +
                                    _vm._s(item.title) +
                                    "\n                                    "
                                )
                              ]),
                              _vm._v(" "),
                              item.img
                                ? _c("div", { staticClass: "item_img" }, [
                                    _c("img", {
                                      staticClass: "img-responsive",
                                      attrs: { src: item.img, alt: item.title }
                                    })
                                  ])
                                : _vm._e(),
                              _vm._v(" "),
                              _c("div", {
                                staticClass: "item_content",
                                domProps: { innerHTML: _vm._s(item.content) }
                              })
                            ])
                          }),
                          _vm._v(" "),
                          _vm.data.key_word
                            ? _c(
                                "div",
                                { staticClass: "category_list" },
                                _vm._l(_vm.data.key_word.split(","), function(
                                  item
                                ) {
                                  return _c(
                                    "span",
                                    { attrs: { href: "javascipt:;" } },
                                    [
                                      _c(
                                        "router-link",
                                        {
                                          staticClass: "page-scroll",
                                          attrs: { to: "/search?tag=" + item }
                                        },
                                        [
                                          _vm._v(
                                            "\n                                        " +
                                              _vm._s(item) +
                                              "\n                                    "
                                          )
                                        ]
                                      )
                                    ],
                                    1
                                  )
                                }),
                                0
                              )
                            : _vm._e()
                        ],
                        2
                      )
                    ]
                  ),
                  _vm._v(" "),
                  _vm.related.length > 0
                    ? _c("div", { staticClass: "single_related_news" }, [
                        _vm._m(0),
                        _vm._v(" "),
                        _c(
                          "div",
                          { staticClass: "media_wrapper" },
                          _vm._l(_vm.related, function(item) {
                            return _c("Media6", {
                              key: item.id,
                              attrs: { data: item }
                            })
                          }),
                          1
                        )
                      ])
                    : _vm._e()
                ])
              ]),
              _vm._v(" "),
              !_vm.loading
                ? _c("div", { staticClass: "col-md-3" }, [_c("Sidebar")], 1)
                : _vm._e()
            ])
          ])
        : _vm._e()
    ],
    1
  )
}
var staticRenderFns = [
  function() {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c("div", { staticClass: "single_media_title" }, [
      _c("h2", [_vm._v("Related News")])
    ])
  }
]
render._withStripped = true



/***/ }),

/***/ "./resources/js/components/Comment.vue":
/*!*********************************************!*\
  !*** ./resources/js/components/Comment.vue ***!
  \*********************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _Comment_vue_vue_type_template_id_54ded044___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./Comment.vue?vue&type=template&id=54ded044& */ "./resources/js/components/Comment.vue?vue&type=template&id=54ded044&");
/* harmony import */ var _Comment_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./Comment.vue?vue&type=script&lang=js& */ "./resources/js/components/Comment.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport *//* harmony import */ var _node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ../../../node_modules/vue-loader/lib/runtime/componentNormalizer.js */ "./node_modules/vue-loader/lib/runtime/componentNormalizer.js");





/* normalize component */

var component = Object(_node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__["default"])(
  _Comment_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__["default"],
  _Comment_vue_vue_type_template_id_54ded044___WEBPACK_IMPORTED_MODULE_0__["render"],
  _Comment_vue_vue_type_template_id_54ded044___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"],
  false,
  null,
  null,
  null
  
)

/* hot reload */
if (false) { var api; }
component.options.__file = "resources/js/components/Comment.vue"
/* harmony default export */ __webpack_exports__["default"] = (component.exports);

/***/ }),

/***/ "./resources/js/components/Comment.vue?vue&type=script&lang=js&":
/*!**********************************************************************!*\
  !*** ./resources/js/components/Comment.vue?vue&type=script&lang=js& ***!
  \**********************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_Comment_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../node_modules/babel-loader/lib??ref--4-0!../../../node_modules/vue-loader/lib??vue-loader-options!./Comment.vue?vue&type=script&lang=js& */ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/Comment.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport */ /* harmony default export */ __webpack_exports__["default"] = (_node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_Comment_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__["default"]); 

/***/ }),

/***/ "./resources/js/components/Comment.vue?vue&type=template&id=54ded044&":
/*!****************************************************************************!*\
  !*** ./resources/js/components/Comment.vue?vue&type=template&id=54ded044& ***!
  \****************************************************************************/
/*! exports provided: render, staticRenderFns */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_Comment_vue_vue_type_template_id_54ded044___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!../../../node_modules/vue-loader/lib??vue-loader-options!./Comment.vue?vue&type=template&id=54ded044& */ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/Comment.vue?vue&type=template&id=54ded044&");
/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "render", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_Comment_vue_vue_type_template_id_54ded044___WEBPACK_IMPORTED_MODULE_0__["render"]; });

/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "staticRenderFns", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_Comment_vue_vue_type_template_id_54ded044___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"]; });



/***/ }),

/***/ "./resources/js/components/Media6.vue":
/*!********************************************!*\
  !*** ./resources/js/components/Media6.vue ***!
  \********************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _Media6_vue_vue_type_template_id_2860fc06___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./Media6.vue?vue&type=template&id=2860fc06& */ "./resources/js/components/Media6.vue?vue&type=template&id=2860fc06&");
/* harmony import */ var _Media6_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./Media6.vue?vue&type=script&lang=js& */ "./resources/js/components/Media6.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport *//* harmony import */ var _node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ../../../node_modules/vue-loader/lib/runtime/componentNormalizer.js */ "./node_modules/vue-loader/lib/runtime/componentNormalizer.js");





/* normalize component */

var component = Object(_node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__["default"])(
  _Media6_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__["default"],
  _Media6_vue_vue_type_template_id_2860fc06___WEBPACK_IMPORTED_MODULE_0__["render"],
  _Media6_vue_vue_type_template_id_2860fc06___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"],
  false,
  null,
  null,
  null
  
)

/* hot reload */
if (false) { var api; }
component.options.__file = "resources/js/components/Media6.vue"
/* harmony default export */ __webpack_exports__["default"] = (component.exports);

/***/ }),

/***/ "./resources/js/components/Media6.vue?vue&type=script&lang=js&":
/*!*********************************************************************!*\
  !*** ./resources/js/components/Media6.vue?vue&type=script&lang=js& ***!
  \*********************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_Media6_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../node_modules/babel-loader/lib??ref--4-0!../../../node_modules/vue-loader/lib??vue-loader-options!./Media6.vue?vue&type=script&lang=js& */ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/Media6.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport */ /* harmony default export */ __webpack_exports__["default"] = (_node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_Media6_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__["default"]); 

/***/ }),

/***/ "./resources/js/components/Media6.vue?vue&type=template&id=2860fc06&":
/*!***************************************************************************!*\
  !*** ./resources/js/components/Media6.vue?vue&type=template&id=2860fc06& ***!
  \***************************************************************************/
/*! exports provided: render, staticRenderFns */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_Media6_vue_vue_type_template_id_2860fc06___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!../../../node_modules/vue-loader/lib??vue-loader-options!./Media6.vue?vue&type=template&id=2860fc06& */ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/Media6.vue?vue&type=template&id=2860fc06&");
/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "render", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_Media6_vue_vue_type_template_id_2860fc06___WEBPACK_IMPORTED_MODULE_0__["render"]; });

/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "staticRenderFns", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_Media6_vue_vue_type_template_id_2860fc06___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"]; });



/***/ }),

/***/ "./resources/js/views/Page.vue":
/*!*************************************!*\
  !*** ./resources/js/views/Page.vue ***!
  \*************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _Page_vue_vue_type_template_id_1e4e62ae___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./Page.vue?vue&type=template&id=1e4e62ae& */ "./resources/js/views/Page.vue?vue&type=template&id=1e4e62ae&");
/* harmony import */ var _Page_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./Page.vue?vue&type=script&lang=js& */ "./resources/js/views/Page.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport *//* harmony import */ var _node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ../../../node_modules/vue-loader/lib/runtime/componentNormalizer.js */ "./node_modules/vue-loader/lib/runtime/componentNormalizer.js");





/* normalize component */

var component = Object(_node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__["default"])(
  _Page_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__["default"],
  _Page_vue_vue_type_template_id_1e4e62ae___WEBPACK_IMPORTED_MODULE_0__["render"],
  _Page_vue_vue_type_template_id_1e4e62ae___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"],
  false,
  null,
  null,
  null
  
)

/* hot reload */
if (false) { var api; }
component.options.__file = "resources/js/views/Page.vue"
/* harmony default export */ __webpack_exports__["default"] = (component.exports);

/***/ }),

/***/ "./resources/js/views/Page.vue?vue&type=script&lang=js&":
/*!**************************************************************!*\
  !*** ./resources/js/views/Page.vue?vue&type=script&lang=js& ***!
  \**************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_Page_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../node_modules/babel-loader/lib??ref--4-0!../../../node_modules/vue-loader/lib??vue-loader-options!./Page.vue?vue&type=script&lang=js& */ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/views/Page.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport */ /* harmony default export */ __webpack_exports__["default"] = (_node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_Page_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__["default"]); 

/***/ }),

/***/ "./resources/js/views/Page.vue?vue&type=template&id=1e4e62ae&":
/*!********************************************************************!*\
  !*** ./resources/js/views/Page.vue?vue&type=template&id=1e4e62ae& ***!
  \********************************************************************/
/*! exports provided: render, staticRenderFns */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_Page_vue_vue_type_template_id_1e4e62ae___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!../../../node_modules/vue-loader/lib??vue-loader-options!./Page.vue?vue&type=template&id=1e4e62ae& */ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/views/Page.vue?vue&type=template&id=1e4e62ae&");
/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "render", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_Page_vue_vue_type_template_id_1e4e62ae___WEBPACK_IMPORTED_MODULE_0__["render"]; });

/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "staticRenderFns", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_Page_vue_vue_type_template_id_1e4e62ae___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"]; });



/***/ })

}]);