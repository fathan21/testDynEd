(window.webpackJsonp=window.webpackJsonp||[]).push([[3],{"7zA9":function(t,a,i){"use strict";var e="function"==typeof Symbol&&"symbol"==typeof Symbol.iterator?function(t){return typeof t}:function(t){return t&&"function"==typeof Symbol&&t.constructor===Symbol&&t!==Symbol.prototype?"symbol":typeof t},s=r(i("tLi0")),n=r(i("wcCE"));function r(t){return t&&t.__esModule?t:{default:t}}var o=i("ed4o");t.exports={render:o.call(void 0),model:{prop:"page",event:"paginate"},props:{page:{type:Number,required:!0},for:{type:String,required:!1},records:{type:Number,required:!0},perPage:{type:Number,default:25},vuex:{type:Boolean},options:{type:Object}},data:function(){return{firstPage:this.page}},watch:{page:function(t){"scroll"===this.opts.chunksNavigation&&this.allowedPage(t)&&!this.inDisplay(t)&&(this.firstPage=t)}},computed:{opts:function(){return(0,n.default)((0,s.default)(),this.options)},Theme:function(){if("object"===e(this.opts.theme))return this.opts.theme;var t={bootstrap3:i("qHon"),bootstrap4:i("wyBb"),bulma:i("MQ+X")};if(void 0===e(t[this.opts.theme]))throw"vue-pagination-2: the theme "+this.opts.theme+" does not exist";return t[this.opts.theme]},pages:function(){return this.records?(t=this.paginationStart,a=this.pagesInCurrentChunk,Array.apply(0,Array(a)).map(function(a,i){return i+t})):[];var t,a},totalPages:function(){return this.records?Math.ceil(this.records/this.perPage):1},totalChunks:function(){return Math.ceil(this.totalPages/this.opts.chunk)},currentChunk:function(){return Math.ceil(this.page/this.opts.chunk)},paginationStart:function(){return"scroll"===this.opts.chunksNavigation?this.firstPage:(this.currentChunk-1)*this.opts.chunk+1},pagesInCurrentChunk:function(){return this.paginationStart+this.opts.chunk<=this.totalPages?this.opts.chunk:this.totalPages-this.paginationStart+1},count:function(){if(/{page}/.test(this.opts.texts.count))return this.totalPages<=1?"":this.opts.texts.count.replace("{page}",this.page).replace("{pages}",this.totalPages);var t=this.opts.texts.count.split("|"),a=(this.page-1)*this.perPage+1,i=this.page==this.totalPages?this.records:a+this.perPage-1;return t[Math.min(1==this.records?2:1==this.totalPages?1:0,t.length-1)].replace("{count}",this.formatNumber(this.records)).replace("{from}",this.formatNumber(a)).replace("{to}",this.formatNumber(i))}},methods:{setPage:function(t){this.allowedPage(t)&&this.paginate(t)},paginate:function(t){this.$emit("paginate",t)},next:function(){var t=this.page+1;return"scroll"===this.opts.chunksNavigation&&this.allowedPage(t)&&!this.inDisplay(t)&&this.firstPage++,this.setPage(t)},prev:function(){var t=this.page-1;return"scroll"===this.opts.chunksNavigation&&this.allowedPage(t)&&!this.inDisplay(t)&&this.firstPage--,this.setPage(t)},inDisplay:function(t){var a=this.firstPage,i=a+this.opts.chunk-1;return t>=a&&t<=i},nextChunk:function(){return this.setChunk(1)},prevChunk:function(){return this.setChunk(-1)},setChunk:function(t){this.setPage((this.currentChunk-1+t)*this.opts.chunk+1)},allowedPage:function(t){return t>=1&&t<=this.totalPages},allowedChunk:function(t){return 1==t&&this.currentChunk<this.totalChunks||-1==t&&this.currentChunk>1},allowedPageClass:function(t){return this.allowedPage(t)?"":this.Theme.disabled},allowedChunkClass:function(t){return this.allowedChunk(t)?"":this.Theme.disabled},activeClass:function(t){return this.page==t?this.Theme.active:""},formatNumber:function(t){return this.opts.format?t.toString().replace(/\B(?=(\d{3})+(?!\d))/g,","):t}}}},"8UgP":function(t,a,i){"use strict";i.r(a);var e=i("E2nf"),s=i("ck9e"),n=i("yxA1"),r=i("7zA9"),o=i.n(r),c={name:"Category",components:{Sidebar:e.a,Media4:n.a,Pagination:o.a},watch:{$route:function(t,a){this.filter.cat=this.$router.history.current.params.link,this.getData()}},created:function(){this.filter.cat=this.$router.history.current.params.link,this.getData()},data:function(){return{loading:!1,error:!1,filter:{page:1,limit:6,q:"",cat:""},countData:0,data:[],main_news:{}}},mounted:function(){},methods:{getData:function(){var t=this;this.loading=!0;var a={client_secret:s.a.clientSecret,filter:this.filter};window.axios.post(s.a.news,a).then(function(a){t.loading=!1;var i=a.data;t.data=i.data,t.main_news=i.data[0],t.countData=i.count}).catch(function(a){t.loading=!1})},pagenation:function(t){jQuery("html, body").animate({scrollTop:0},500),this.getData()}}},l=i("KHd+"),u=Object(l.a)(c,function(){var t=this,a=t.$createElement,i=t._self._c||a;return i("section",{staticClass:"feature_category_section category_page section_wrapper",attrs:{id:"feature_category_section"}},[t.loading?i("MediaSkolten"):t._e(),t._v(" "),t.loading||t.error?t._e():i("div",{staticClass:"container"},[i("div",{staticClass:"row"},[i("div",{staticClass:"col-md-9"},[i("div",{staticClass:"row"},[i("div",{staticClass:"col-md-12"},[1==t.filter.page&&t.main_news?i("Media4",{attrs:{data:t.main_news}}):t._e()],1)]),t._v(" "),i("div",{staticClass:"row"},t._l(t.data,function(t){return i("div",{staticClass:"col-md-6"},[i("Media4",{attrs:{data:t}})],1)}),0),t._v(" "),i("div",{staticClass:"row"},[i("div",{staticClass:"col-md-12",staticStyle:{"text-align":"center"}},[i("pagination",{attrs:{records:t.countData,"per-page":t.filter.limit},on:{paginate:t.pagenation},model:{value:t.filter.page,callback:function(a){t.$set(t.filter,"page",a)},expression:"filter.page"}})],1)])]),t._v(" "),t.loading?t._e():i("div",{staticClass:"col-md-3"},[i("Sidebar")],1)])])],1)},[],!1,null,null,null);a.default=u.exports},E2nf:function(t,a,i){"use strict";var e=i("L2JU"),s={name:"Media1",props:["data"],created:function(){}},n=i("KHd+"),r={name:"Media2",props:["data"],created:function(){}};function o(t,a,i){return a in t?Object.defineProperty(t,a,{value:i,enumerable:!0,configurable:!0,writable:!0}):t[a]=i,t}var c={name:"Sidebar",components:{Media1:Object(n.a)(s,function(){var t=this.$createElement,a=this._self._c||t;return a("div",{staticClass:"media"},[a("div",{staticClass:"media-left"},[a("router-link",{attrs:{to:this.data.link}},[a("div",{staticClass:"skeleton",staticStyle:{width:"80px",height:"80px","background-size":"cover"},style:{"background-image":"url("+this.data.img+")"}})])],1),this._v(" "),a("div",{staticClass:"media-body"},[a("h3",{staticClass:"media-heading"},[a("router-link",{attrs:{to:this.data.link}},[this._v("\n                "+this._s(this.data.title)+"\n            ")])],1)])])},[],!1,null,null,null).exports,Media2:Object(n.a)(r,function(){var t=this,a=t.$createElement,i=t._self._c||a;return i("div",{staticClass:"media"},[i("div",{staticClass:"media-left"},[i("router-link",{attrs:{to:t.data.link}},[i("div",{staticClass:"skeleton",staticStyle:{width:"80px",height:"80px","background-size":"cover"},style:{"background-image":"url("+t.data.img+")"}})])],1),t._v(" "),i("div",{staticClass:"media-body"},[i("h3",{staticClass:"media-heading"},[i("router-link",{attrs:{to:t.data.link}},[t._v("\n                "+t._s(t.data.title)+"\n            ")])],1),t._v(" "),i("div",{staticClass:"comment_box"},[t._m(0),t._v(" "),i("div",{staticClass:"comments"},[i("router-link",{attrs:{to:t.data.link}},[t._v(t._s(t.data.comment_count)+" Comments")])],1)])])])},[function(){var t=this.$createElement,a=this._self._c||t;return a("div",{staticClass:"comments_icon"},[a("i",{staticClass:"fa fa-comments",attrs:{"aria-hidden":"true"}})])}],!1,null,null,null).exports},computed:function(t){for(var a=1;a<arguments.length;a++){var i=null!=arguments[a]?arguments[a]:{},e=Object.keys(i);"function"==typeof Object.getOwnPropertySymbols&&(e=e.concat(Object.getOwnPropertySymbols(i).filter(function(t){return Object.getOwnPropertyDescriptor(i,t).enumerable}))),e.forEach(function(a){o(t,a,i[a])})}return t}({},Object(e.c)(["getSidebar"])),data:function(){return{tab_v:"#1"}},methods:{tab:function(t,a){this.tab_v=t}}},l=Object(n.a)(c,function(){var t=this,a=t.$createElement,i=t._self._c||a;return i("div",[i("div",{staticClass:"tab sitebar"},[i("ul",{staticClass:"nav nav-tabs"},[i("li",{class:{active:"#1"===t.tab_v}},[i("a",{on:{click:function(a){return t.tab("#1",a)}}},[t._v("Latest")])]),t._v(" "),i("li",{class:{active:"#2"===t.tab_v}},[i("a",{on:{click:function(a){return t.tab("#2",a)}}},[t._v("Populer")])])]),t._v(" "),i("div",{staticClass:"tab-content"},[i("div",{staticClass:"tab-pane",class:{active:"#1"===t.tab_v},attrs:{id:"1"}},t._l(t.getSidebar.latest,function(t){return i("Media1",{key:t.id,attrs:{data:t}})}),1),t._v(" "),i("div",{staticClass:"tab-pane",class:{active:"#2"===t.tab_v},attrs:{id:"2"}},t._l(t.getSidebar.populer,function(t){return i("Media1",{key:t.id,attrs:{data:t}})}),1)])])])},[],!1,null,null,null);a.a=l.exports},"MQ+X":function(t,a,i){"use strict";t.exports={nav:"",count:"",wrapper:"pagination",list:"pagination-list",item:"",link:"pagination-link",next:"",prev:"",active:"is-current",disabled:""}},ed4o:function(t,a,i){"use strict";t.exports=function(){return function(t){var a=this.Theme,i=[],e="",s="",n="",r="";return this.opts.edgeNavigation&&this.totalChunks>1&&(n=t("li",{class:"VuePagination__pagination-item "+a.item+" "+(1===this.page?a.disabled:"")+" VuePagination__pagination-item-prev-chunk"},[t("a",{class:a.link,attrs:{href:"javascript:void(0);",disabled:1===this.page},on:{click:this.setPage.bind(this,1)}},[this.opts.texts.first])]),r=t("li",{class:"VuePagination__pagination-item "+a.item+" "+(this.page===this.totalPages?a.disabled:"")+" VuePagination__pagination-item-prev-chunk"},[t("a",{class:a.link,attrs:{href:"javascript:void(0);",disabled:this.page===this.totalPages},on:{click:this.setPage.bind(this,this.totalPages)}},[this.opts.texts.last])])),"fixed"===this.opts.chunksNavigation&&(e=t("li",{class:"VuePagination__pagination-item "+a.item+" "+a.prev+" VuePagination__pagination-item-prev-chunk "+this.allowedChunkClass(-1)},[t("a",{class:a.link,attrs:{href:"javascript:void(0);",disabled:!!this.allowedChunkClass(-1)},on:{click:this.setChunk.bind(this,-1)}},["<<"])]),s=t("li",{class:"VuePagination__pagination-item "+a.item+" "+a.next+" VuePagination__pagination-item-next-chunk "+this.allowedChunkClass(1)},[t("a",{class:a.link,attrs:{href:"javascript:void(0);",disabled:!!this.allowedChunkClass(1)},on:{click:this.setChunk.bind(this,1)}},[">>"])])),this.pages.map(function(e){i.push(t("li",{class:"VuePagination__pagination-item "+a.item+" "+this.activeClass(e)},[t("a",{class:a.link+" "+this.activeClass(e),attrs:{href:"javascript:void(0)",role:"button"},on:{click:this.setPage.bind(this,e)}},[e])]))}.bind(this)),t("div",{class:"VuePagination "+a.wrapper},[t("nav",{class:""+a.nav},[t("ul",{directives:[{name:"show",value:this.totalPages>1}],class:a.list+" VuePagination__pagination"},[n,e,t("li",{class:"VuePagination__pagination-item "+a.item+" "+a.prev+" VuePagination__pagination-item-prev-page "+this.allowedPageClass(this.page-1)},[t("a",{class:a.link,attrs:{href:"javascript:void(0);",disabled:!!this.allowedPageClass(this.page-1)},on:{click:this.prev.bind(this)}},["<"])]),i,t("li",{class:"VuePagination__pagination-item "+a.item+" "+a.next+" VuePagination__pagination-item-next-page "+this.allowedPageClass(this.page+1)},[t("a",{class:a.link,attrs:{href:"javascript:void(0);",disabled:!!this.allowedPageClass(this.page+1)},on:{click:this.next.bind(this)}},[">"])]),s,r]),t("p",{directives:[{name:"show",value:parseInt(this.records)}],class:"VuePagination__count "+a.count},[this.count])])])}}},qHon:function(t,a,i){"use strict";t.exports={nav:"",count:"",wrapper:"",list:"pagination",item:"page-item",link:"page-link",next:"",prev:"",active:"active",disabled:"disabled"}},tLi0:function(t,a,i){"use strict";Object.defineProperty(a,"__esModule",{value:!0}),a.default=function(){return{format:!0,chunk:10,chunksNavigation:"fixed",edgeNavigation:!1,theme:"bootstrap3",texts:{count:"Showing {from} to {to} of {count} records|{count} records|One record",first:"First",last:"Last"}}}},wcCE:function(t,a,i){(function(t){!function(a){var i=function(t){return s(!0===t,!1,arguments)};function e(t,a){if("object"!==n(t))return a;for(var i in a)"object"===n(t[i])&&"object"===n(a[i])?t[i]=e(t[i],a[i]):t[i]=a[i];return t}function s(t,a,s){var r=s[0],o=s.length;(t||"object"!==n(r))&&(r={});for(var c=0;c<o;++c){var l=s[c];if("object"===n(l))for(var u in l)if("__proto__"!==u){var h=t?i.clone(l[u]):l[u];r[u]=a?e(r[u],h):h}}return r}function n(t){return{}.toString.call(t).slice(8,-1).toLowerCase()}i.recursive=function(t){return s(!0===t,!0,arguments)},i.clone=function(t){var a,e,s=t,r=n(t);if("array"===r)for(s=[],e=t.length,a=0;a<e;++a)s[a]=i.clone(t[a]);else if("object"===r)for(a in s={},t)s[a]=i.clone(t[a]);return s},a?t.exports=i:window.merge=i}(t&&"object"==typeof t.exports&&t.exports)}).call(this,i("YuTi")(t))},wyBb:function(t,a,i){"use strict";t.exports={nav:"",count:"",wrapper:"",list:"pagination",item:"page-item",link:"page-link",next:"",prev:"",active:"active",disabled:"disabled"}},yxA1:function(t,a,i){"use strict";var e={name:"Media4",props:["data"],created:function(){}},s=i("KHd+"),n=Object(s.a)(e,function(){var t=this,a=t.$createElement,i=t._self._c||a;return i("div",{staticClass:"item feature_news_item"},[i("div",{staticClass:"item_wrapper"},[i("div",{staticClass:"item_img_background \n        ",style:{"background-image":"url("+t.data.img+")"}}),t._v(" "),i("div",{staticClass:"item_title_date"},[i("div",{staticClass:"news_item_title"},[i("h2",[i("router-link",{attrs:{to:t.data.link}},[t._v("\n                        "+t._s(t.data.title)+"\n                    ")])],1)]),t._v(" "),i("div",{staticClass:"item_meta"},[i("a",{attrs:{href:"#"}},[t._v(t._s(t._f("toDateIndo")(t.data.date))+",")]),t._v(" "),i("a",{attrs:{href:"#"}},[t._v(t._s(t.data.writer))])])])]),t._v(" "),i("div",{staticClass:"item_content"},[i("div",{staticClass:"prev"},[t._v("\n            "+t._s(t.data.content_prev)+"\n        ")])])])},[],!1,null,null,null);a.a=n.exports}}]);