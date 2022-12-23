"use strict";
! function(e) {
    function t(n) {
        if (a[n]) return a[n].exports;
        var o = a[n] = {
            exports: {},
            id: n,
            loaded: !1
        };
        return e[n].call(o.exports, o, o.exports, t), o.loaded = !0, o.exports
    }
    var a = {};
    return t.m = e, t.c = a, t.p = "", t(0)
}([function(e, t, a) {
    a(10), a(11), a(9), e.exports = a(8)
}, 

function(e, t) {
    Object.defineProperty(t, "__esModule", {
        value: !0
    });
    t.backDrops = function(e, t, a) {
        var n = $("body"),
            o = $("html");
        a.hasClass(e) ? ("expand" === e || "app_sidebar-left-open" === e ? n.append('<div class="backdrop ' + e + ' top"></div>') : n.append('<div class="backdrop ' + e + '"></div>'), MaterialLab.APP_TOUCH === !0 ? $("." + e + ".backdrop").hammer().bind("tap", function(e) {
            e.stopPropagation(), t.trigger("click")
        }) : $("." + e + ".backdrop").on("click", function(e) {
            e.stopPropagation(), t.trigger("click")
        }), $(".backdrop").length > 0 && !o.hasClass("backdrop-open") && o.addClass("backdrop-open")) : ("sidebar-overlay-open" === e && $("#chat_compose_wrapper").removeClass("open"), $("." + e + ".backdrop").fadeOut(250, function() {
            $(this).remove(), 0 === $(".backdrop").length && o.removeClass("backdrop-open")
        }))
    }
},

 function(e, t) {
    Object.defineProperty(t, "__esModule", {
        value: !0
    });
    var a = function() {
            var e = !1,
                t = {
                    data: [],
                    placeholder: "",
                    secondaryPlaceholder: ""
                };
            $(document).on("click", ".chip .close", function(e) {
                var t = $(this).closest(".chips");
                t.attr("data-initialized") || $(this).closest(".chip").remove()
            }), $.fn.material_chip = function(a) {
                var n = this;
                if (this.$el = $(this), this.$document = $(document), this.SELS = {
                        CHIPS: ".chips",
                        CHIP: ".chip",
                        INPUT: "input",
                        DELETE: ".close.zmdi.zmdi-close",
                        SELECTED_CHIP: ".selected"
                    }, "data" === a) return this.$el.data("chips");
                var o = $.extend({}, t, a);
                this.init = function() {
                    var e = 0;
                    n.$el.each(function() {
                        var t = $(this),
                            a = Materialize.guid();
                        o.data && o.data instanceof Array || (o.data = []), t.data("chips", o.data), t.attr("data-index", e), t.attr("data-initialized", !0), t.hasClass(n.SELS.CHIPS) || t.addClass("chips"), n.chips(t, a), e++
                    })
                }, this.handleEvents = function() {
                    var e = n.SELS;
                    n.$document.off("click.chips-focus", e.CHIPS).on("click.chips-focus", e.CHIPS, function(t) {
                        $(t.target).find(e.INPUT).focus()
                    }), n.$document.off("click.chips-select", e.CHIP).on("click.chips-select", e.CHIP, function(t) {
                        $(e.CHIP).removeClass("selected"), $(this).toggleClass("selected")
                    }), n.$document.off("keydown.chips").on("keydown.chips", function(t) {
                        if (!$(t.target).is("input, textarea")) {
                            var a, o = n.$document.find(e.CHIP + e.SELECTED_CHIP),
                                i = o.closest(e.CHIPS),
                                r = o.siblings(e.CHIP).length;
                            if (o.length)
                                if (8 === t.which || 46 === t.which) {
                                    t.preventDefault(), a = o.index(), n.deleteChip(a, i);
                                    var s = null;
                                    a + 1 < r ? s = a : a !== r && a + 1 !== r || (s = r - 1), s < 0 && (s = null), null !== s && n.selectChip(s, i), r || i.find("input").focus()
                                } else if (37 === t.which) {
                                if (a = o.index() - 1, a < 0) return;
                                $(e.CHIP).removeClass("selected"), n.selectChip(a, i)
                            } else if (39 === t.which) {
                                if (a = o.index() + 1, $(e.CHIP).removeClass("selected"), a > r) return void i.find("input").focus();
                                n.selectChip(a, i)
                            }
                        }
                    }), n.$document.off("focusin.chips", e.CHIPS + " " + e.INPUT).on("focusin.chips", e.CHIPS + " " + e.INPUT, function(t) {
                        var a = $(t.target).closest(e.CHIPS);
                        a.addClass("focus"), a.siblings("label, .prefix").addClass("active"), $(e.CHIP).removeClass("selected")
                    }), n.$document.off("focusout.chips", e.CHIPS + " " + e.INPUT).on("focusout.chips", e.CHIPS + " " + e.INPUT, function(t) {
                        var a = $(t.target).closest(e.CHIPS);
                        a.removeClass("focus"), a.data("chips").length || a.siblings("label").removeClass("active"), a.siblings(".prefix").removeClass("active")
                    }), n.$document.off("keydown.chips-add", e.CHIPS + " " + e.INPUT).on("keydown.chips-add", e.CHIPS + " " + e.INPUT, function(t) {
                        var a = $(t.target),
                            o = a.closest(e.CHIPS),
                            i = o.children(e.CHIP).length;
                        return 13 === t.which ? (t.preventDefault(), n.addChip({
                            tag: a.val()
                        }, o), void a.val("")) : 8 !== t.keyCode && 37 !== t.keyCode || "" !== a.val() || !i ? void 0 : (n.selectChip(i - 1, o), void a.blur())
                    }), n.$document.off("click.chips-delete", e.CHIPS + " " + e.DELETE).on("click.chips-delete", e.CHIPS + " " + e.DELETE, function(t) {
                        var a = $(t.target),
                            o = a.closest(e.CHIPS),
                            i = a.closest(e.CHIP);
                        t.stopPropagation(), n.deleteChip(i.index(), o), o.find("input").focus()
                    })
                }, this.chips = function(e, t) {
                    var a = "";
                    e.data("chips").forEach(function(e) {
                        a += n.renderChip(e)
                    }), a += '<input id="' + t + '" class="input" placeholder="">', e.html(a), n.setPlaceholder(e);
                    var o = e.next("label");
                    o.length && (o.attr("for", t), e.data("chips").length && o.addClass("active"))
                }, this.renderChip = function(e) {
                    if (e.tag) {
                        var t = '<div class="chip">' + e.tag;
                        return e.image && (t += ' <img src="' + e.image + '"> '), t += '<i class="zmdi zmdi-close close"></i>', t += "</div>"
                    }
                }, this.setPlaceholder = function(e) {
                    e.data("chips").length && o.placeholder ? e.find("input").prop("placeholder", o.placeholder) : !e.data("chips").length && o.secondaryPlaceholder && e.find("input").prop("placeholder", o.secondaryPlaceholder)
                }, this.isValid = function(e, t) {
                    for (var a = e.data("chips"), n = !1, o = 0; o < a.length; o++)
                        if (a[o].tag === t.tag) return void(n = !0);
                    return "" !== t.tag && !n
                }, this.addChip = function(e, t) {
                    if (n.isValid(t, e)) {
                        for (var a = n.renderChip(e), o = [], i = t.data("chips"), r = 0; r < i.length; r++) o.push(i[r]);
                        o.push(e), t.data("chips", o), $(a).insertBefore(t.find("input")), t.trigger("chip.add", e), n.setPlaceholder(t)
                    }
                }, this.deleteChip = function(e, t) {
                    var a = t.data("chips")[e];
                    t.find(".chip").eq(e).remove();
                    for (var o = [], i = t.data("chips"), r = 0; r < i.length; r++) r !== e && o.push(i[r]);
                    t.data("chips", o), t.trigger("chip.delete", a), n.setPlaceholder(t)
                }, this.selectChip = function(e, t) {
                    var a = t.find(".chip").eq(e);
                    a && !1 === a.hasClass("selected") && (a.addClass("selected"), t.trigger("chip.select", t.data("chips")[e]))
                }, this.getChipsElement = function(e, t) {
                    return t.eq(e)
                }, this.init(), e || (this.handleEvents(), e = !0)
            }
        },
        n = function() {
            $(".chips").material_chip(), $(".chips-initial").material_chip({
                data: [{
                    tag: "Apple"
                }, {
                    tag: "Microsoft"
                }, {
                    tag: "Google"
                }]
            }), $(".chips-placeholder").material_chip({
                placeholder: "Enter a tag",
                secondaryPlaceholder: "+Tag"
            })
        };
    t.chips = a, t.initChips = n
}, function(e, t) {
    Object.defineProperty(t, "__esModule", {
        value: !0
    });
    var a = function(e, t, a, n, o, i, r) {
            $("<div id='tooltip'></div>").css({
                position: "absolute",
                display: "none",
                border: "1px solid #fdd",
                padding: "2px",
                "background-color": "#fee",
                opacity: .8
            }).appendTo("body"), $.plot($(e), [{
                data: t,
                label: n[0],
                color: o[0]
            }, {
                data: a,
                label: n[1],
                color: o[1]
            }], {
                series: {
                    lines: {
                        show: !0,
                        fill: !0,
                        lineWidth: 1,
                        fillColor: {
                            colors: [{
                                opacity: .2
                            }, {
                                opacity: .9
                            }]
                        }
                    },
                    points: {
                        show: !0
                    },
                    shadowSize: 0
                },
                legend: {
                    position: "nw"
                },
                grid: {
                    hoverable: !0,
                    clickable: !0,
                    borderColor: "#fff",
                    borderWidth: 0,
                    labelMargin: 10,
                    backgroundColor: "#fff"
                },
                yaxis: {
                    min: 0,
                    max: 15,
                    color: "rgba(0,0,0,0)"
                },
                xaxis: {
                    color: "rgba(0,0,0,0)"
                },
                tooltip: !0,
                tooltipOpts: {
                    content: "%s: Value of %x is %y",
                    shifts: {
                        x: -60,
                        y: 25
                    },
                    defaultTheme: !1
                }
            })
        },
        n = function() {
            for (var e = [], t = 0; t <= 10; t += 1) e.push([t, 13 * Math.random()]);
            for (var n = [], t = 0; t <= 10; t += 1) n.push([t, 13 * Math.random()]);
            var o = ["Unique", "Returning"],
                i = ["#2196F3", "#5867C3"],
                r = "#fff",
                s = "#fff";
            $("#website-stats").length > 0 && a("#website-stats", e, n, o, i, r, s)
        },
        o = function() {
            $("#sparkline1").sparkline([345, 404, 305, 455, 378, 567, 586, 685, 458, 742, 565], {
                type: "line",
                width: "100%",
                height: "40",
                spotRadius: 4,
                lineWidth: 1,
                lineColor: "#ffffff",
                fillColor: !1,
                minSpotColor: !1,
                maxSpotColor: !1,
                highlightLineColor: "#ffffff",
                highlightSpotColor: "#ffffff",
                tooltipChartTitle: "Page Views",
                spotColor: "#ffffff",
                valueSpots: {
                    "0:": "#ffffff"
                }
            });
            var e = $("#sparkline2"),
                t = [40, 32, 65, 53, 62, 55, 24, 67, 45, 70, 45, 56, 34, 67, 76, 32, 65, 53, 62, 55, 24, 67, 45, 70, 45, 56, 70, 45, 56, 34, 67, 76, 32, 65, 53, 62, 55],
                a = t.length,
                n = 1,
                o = function() {
                    e.sparkline(t, {
                        type: "bar",
                        height: 55,
                        barWidth: Math.round((e.parent().width() - (a - 1) * n) / a),
                        barSpacing: n,
                        zeroAxis: !1,
                        tooltipChartTitle: "Weekly Donations",
                        tooltipPrefix: "$ ",
                        barColor: "rgba(255,255,255,.7)"
                    })
                };
            o()
        },
        i = function() {
            if ($("#ct-PathAnimation1 ").length > 0) {
                var e = new Chartist.Line("#ct-PathAnimation1 .ct-chart", {
                    labels: ["Jan", "Feb", "March "],
                    series: [
                        [1, 5, 2],
                        [2, 3, 4],
                        [5, 4, 3]
                    ]
                }, {
                    low: 0,
                    showArea: !0,
                    showPoint: !1,
                    fullWidth: !0
                });
                e.on("draw", function(e) {
                    "line" !== e.type && "area" !== e.type || e.element.animate({
                        d: {
                            begin: 2e3 * e.index,
                            dur: 2e3,
                            from: e.path.clone().scale(1, 0).translate(0, e.chartRect.height()).stringify(),
                            to: e.path.clone().stringify(),
                            easing: Chartist.Svg.Easing.easeOutQuint
                        }
                    })
                })
            }
            if ($("#ct-PathAnimation2 ").length > 0) {
                var e = new Chartist.Line("#ct-PathAnimation2 .ct-chart", {
                    labels: ["April", "May", "June"],
                    series: [
                        [3, 2, 2],
                        [2, 3, 4],
                        [1, 4, .5]
                    ]
                }, {
                    low: 0,
                    showArea: !0,
                    showPoint: !1,
                    fullWidth: !0
                });
                e.on("draw", function(e) {
                    "line" !== e.type && "area" !== e.type || e.element.animate({
                        d: {
                            begin: 2e3 * e.index,
                            dur: 2e3,
                            from: e.path.clone().scale(1, 0).translate(0, e.chartRect.height()).stringify(),
                            to: e.path.clone().stringify(),
                            easing: Chartist.Svg.Easing.easeOutQuint
                        }
                    })
                })
            }
            if ($("#ct-PathAnimation3 ").length > 0) {
                var e = new Chartist.Line("#ct-PathAnimation3 .ct-chart", {
                    labels: ["July", "Aug", "Sept"],
                    series: [
                        [2, 4, 3],
                        [1, 5, .5],
                        [2, 3, 2]
                    ]
                }, {
                    low: 0,
                    showArea: !0,
                    showPoint: !1,
                    fullWidth: !0
                });
                e.on("draw", function(e) {
                    "line" !== e.type && "area" !== e.type || e.element.animate({
                        d: {
                            begin: 2e3 * e.index,
                            dur: 2e3,
                            from: e.path.clone().scale(1, 0).translate(0, e.chartRect.height()).stringify(),
                            to: e.path.clone().stringify(),
                            easing: Chartist.Svg.Easing.easeOutQuint
                        }
                    })
                })
            }
            if ($("#ct-PathAnimation4").length > 0) {
                var e = new Chartist.Line("#ct-PathAnimation4 .ct-chart", {
                    labels: ["Oct", "Nov", "Dec"],
                    series: [
                        [.5, 5, 2],
                        [6, 3, 4],
                        [5, 8, 6]
                    ]
                }, {
                    low: 0,
                    showArea: !0,
                    showPoint: !1,
                    fullWidth: !0
                });
                e.on("draw", function(e) {
                    "line" !== e.type && "area" !== e.type || e.element.animate({
                        d: {
                            begin: 2e3 * e.index,
                            dur: 2e3,
                            from: e.path.clone().scale(1, 0).translate(0, e.chartRect.height()).stringify(),
                            to: e.path.clone().stringify(),
                            easing: Chartist.Svg.Easing.easeOutQuint
                        }
                    })
                })
            }
        },
        r = function() {
            $("#ct-LineChart1").length > 0 && new Chartist.Line("#ct-LineChart1 .ct-chart", {
                labels: [10, 20, 30, 40, 50, 60],
                series: [
                    [5, 3, 7, 5, 2, 7, 9]
                ]
            }, {
                low: 0,
                showArea: !0
            }), $("#ct-LineChart2").length > 0 && new Chartist.Line("#ct-LineChart2 .ct-chart", {
                labels: [10, 20, 30, 40, 50, 60],
                series: [
                    [2, 3, 6, 8, 7, 5, 2]
                ]
            }, {
                low: 0,
                showArea: !0
            }), $("#ct-LineChart3").length > 0 && new Chartist.Line("#ct-LineChart3 .ct-chart", {
                labels: [10, 20, 30, 40, 50, 60],
                series: [
                    [5, 3, 7, 5, 2, 4, 9]
                ]
            }, {
                low: 0,
                showArea: !0
            }), $("#ct-LineChart4").length > 0 && new Chartist.Line("#ct-LineChart4 .ct-chart", {
                labels: [10, 20, 30, 40, 50, 60],
                series: [
                    [3, 4, 7, 8, 5, 3, 5]
                ]
            }, {
                low: 0,
                showArea: !0
            })
        },
        s = function() {
            $("#ct-BarChart1").length > 0 && new Chartist.Bar("#ct-BarChart1 .ct-chart", {
                labels: ["JAN", "FEB", "MARCH", "APRIL"],
                series: [
                    [8e5, 12e5, 14e5, 13e5],
                    [2e5, 4e5, 5e5, 3e5],
                    [1e5, 2e5, 4e5, 6e5]
                ]
            }, {
                stackBars: !0,
                axisY: {
                    labelInterpolationFnc: function(e) {
                        return e / 1e3 + "k"
                    }
                }
            }).on("draw", function(e) {
                "bar" === e.type && e.element.attr({
                    style: "stroke-width: 30px"
                })
            }), $("#ct-BarChart2").length > 0 && new Chartist.Bar("#ct-BarChart2 .ct-chart", {
                labels: ["MAY", "JUNE", "JULY", "AUG"],
                series: [
                    [2e5, 8e5, 9e5, 13e5],
                    [205e3, 505e3, 305e3, 805e3],
                    [505e3, 7e5, 1e6, 11e5]
                ]
            }, {
                stackBars: !0,
                axisY: {
                    labelInterpolationFnc: function(e) {
                        return e / 1e3 + "k"
                    }
                }
            }).on("draw", function(e) {
                "bar" === e.type && e.element.attr({
                    style: "stroke-width: 30px"
                })
            }), $("#ct-BarChart3").length > 0 && new Chartist.Bar("#ct-BarChart3 .ct-chart", {
                labels: ["Sept", "OCT", "NOV", "DEC"],
                series: [
                    [1e6, 12e5, 14e5, 18e5],
                    [6e5, 7e5, 1e6, 12e5],
                    [11e4, 14e4, 16e5, 18e5]
                ]
            }, {
                stackBars: !0,
                axisY: {
                    labelInterpolationFnc: function(e) {
                        return e / 1e3 + "k"
                    }
                }
            }).on("draw", function(e) {
                "bar" === e.type && e.element.attr({
                    style: "stroke-width: 30px"
                })
            }), $("#ct-BarChart4").length > 0 && new Chartist.Bar("#ct-BarChart4 .ct-chart", {
                series: [
                    [1e5, 12e5, 17e5, 2e6],
                    [2e5, 5e5, 9e5, 3e6],
                    [13e4, 16e5, 18e5, 2e6]
                ]
            }, {
                stackBars: !0,
                axisY: {
                    labelInterpolationFnc: function(e) {
                        return e / 1e3 + "k"
                    }
                }
            }).on("draw", function(e) {
                "bar" === e.type && e.element.attr({
                    style: "stroke-width: 30px"
                })
            })
        },
        l = function() {
            $("#ct-BiPolarChart1").length > 0 && new Chartist.Line("#ct-BiPolarChart1 .ct-chart", {
                labels: [1, 2, 3, 4, 5, 6, 7, 8],
                series: [
                    [1, 2, 3, 1, -2, 0, 1, 0],
                    [-2, -1, -2, -1, -2.5, -1, -2, -1],
                    [0, 0, 0, 1, 2, 2.5, 2, 1],
                    [2.5, 2, 1, .5, 1, .5, -1, -2.5]
                ]
            }, {
                high: 3,
                low: -3,
                showArea: !0,
                showLine: !1,
                showPoint: !1,
                fullWidth: !0,
                axisX: {
                    showLabel: !1,
                    showGrid: !1
                }
            }), $("#ct-BiPolarChart2").length > 0 && new Chartist.Line("#ct-BiPolarChart2 .ct-chart", {
                labels: [1, 2, 3, 4, 5, 6, 7, 8],
                series: [
                    [2.5, 2, 1, .5, 1, .5, -1, -2.5],
                    [1, 2, 3, -1, -2, 0, 1, 4],
                    [-2, 1, -2, -1, -2.5, -1.5, -2, -1],
                    [0, 3, 0, 1, 2, 2.5, 2, 1]
                ]
            }, {
                high: 3,
                low: -3,
                showArea: !0,
                showLine: !1,
                showPoint: !1,
                fullWidth: !0,
                axisX: {
                    showLabel: !1,
                    showGrid: !1
                }
            }), $("#ct-BiPolarChart3").length > 0 && new Chartist.Line("#ct-BiPolarChart3 .ct-chart", {
                labels: [1, 2, 3, 4, 5, 6, 7, 8],
                series: [
                    [1, 2, 1, 1, -2, .5, 1, 0],
                    [-2, -1, -2, -1, 2.5, -1, -2, -1],
                    [0, 0, 0, 1.5, 2, 2.5, 2, 1],
                    [2.5, 2, 1.5, .5, 1, 5, -1, 2.5]
                ]
            }, {
                high: 3,
                low: -3,
                showArea: !0,
                showLine: !1,
                showPoint: !1,
                fullWidth: !0,
                axisX: {
                    showLabel: !1,
                    showGrid: !1
                }
            }), $("#ct-BiPolarChart4").length > 0 && new Chartist.Line("#ct-BiPolarChart4 .ct-chart", {
                labels: [1, 2, 3, 4, 5, 6, 7, 8],
                series: [
                    [1, 2, -3, 1, 2, 0, 1, 0],
                    [-2, -1, -2, 4, -2.5, -1, 2, -1],
                    [3, 0, 0, 1, 2.5, 2.5, 2, 1],
                    [2.5, 2, 1, .5, 1, .5, -1, -2.5]
                ]
            }, {
                high: 3,
                low: -3,
                showArea: !0,
                showLine: !1,
                showPoint: !1,
                fullWidth: !0,
                axisX: {
                    showLabel: !1,
                    showGrid: !1
                }
            })
        },
        c = function() {
            var e = [0, 1, 3, 6, 1, 1, 4, 1, 12, 7, 5, 2, 4, 1, 2, 6, 10, 4, 2, 0, 3, 1, 8, 4, 1, 0, 2, 3, 6, 3, 4];
            $("#sparkline-line").sparkline(e, {
                type: "line",
                width: "calc(100% + 4px)",
                height: "45",
                chartRangeMax: 11,
                lineColor: "rgba(34, 110, 125,0.5)",
                fillColor: "rgba(34, 110, 125,0.4)",
                highlightLineColor: "rgba(0,0,0,0)",
                highlightSpotColor: "rgba(0,0,0,.2)",
                tooltip: !0
            });
            var t = $("#sparkline-bar").parents(".card"),
                a = [0, 1, 3, 4, 2, 7, 11, 2, 6, 3, 2, 4, 1, 1, 4, 1, 2, 0, 3, 1, 3, 4, 1, 10, 2, 3, 1, 2, 6, 12, 4],
                n = 5;
            $("#sparkline-bar").sparkline(a, {
                type: "bar",
                height: $("#sparkline-bar").height() + "px",
                width: "100%",
                barWidth: n,
                barSpacing: (t.width() - a.length * n) / a.length,
                barColor: "rgba(34, 110, 125,.6)",
                tooltipFormat: ' <span class="tooltip">&#9679;</span> {{value}}</span>'
            })
        },
        d = function() {
            var kiss = $('#dashboardC3Donut').data('kisses');
            var received = $('#dashboardC3Donut').data('received');
            if ($("#dashboardC3Donut").length) {
                var e = c3.generate({
                    bindto: "#dashboardC3Donut",
                    data: {
                        columns: [
                            ["You have sent", kiss],
                            ["You have received", received]
                        ],
                        type: "donut",                      
                    width:150,
                    height:150,
                        onclick: function(e, t) {},
                        onmouseover: function(e, t) {},
                        onmouseout: function(e, t) {}
                    },
                    donut: {
                        title: "Kisses"
                    },
                    color: {
                        pattern: [
                        MaterialLab.APP_COLORS.info,
                        MaterialLab.APP_COLORS.success,
                        MaterialLab.APP_COLORS.primary,
                        MaterialLab.APP_COLORS.mw_purple,
                        MaterialLab.APP_COLORS.success
                        ]
                    }
                });
                // setTimeout(function() {
                //     e.load({
                //         columns: [
                //         ["Responded", 2.5, 1.9, 2.1, 1.8, 2.2, 2.1, 1.7, 1.8, 1.8, 2.5, 2, 1.9, 2.1, 2, 2.4, 2.3, 1.8, 2.2, 2.3, 1.5, 2.3, 2, 2, 1.8, 2.1, 1.8, 1.8, 1.8, 2.1, 1.6, 1.9, 2, 2.2, 1.5, 1.4, 2.3, 2.4, 1.8, 1.8, 2.1, 2.4, 2.3, 1.9, 2.3, 2.5, 2.3, 1.9, 2, 2.3, 1.8]
                //         ]
                //     })
                // }, 1500), setTimeout(function() {
                //     e.unload({
                //         ids: "data1"
                //     }), e.unload({
                //         ids: "data2"
                //     })
                // }, 2500)
            }
        };
    t.dashboardWebStats = n, t.sparklineDashboard = o, t.chartistLineDashboard = r, t.chartistBarsDashboard = s, t.chartistBiPolarChartDashboard = l, t.chartistPathAnimationDashboard = i, t.drawSparkline = c, t.dashboardC3Donut = d
}, function(e, t, a) {
    Object.defineProperty(t, "__esModule", {
        value: !0
    }), t.toggleDrawer = void 0;
    var n = a(1),
        o = a(6),
        i = function() {
            var e = $("[data-drawer]");
            e.off("click"), e.on("click", function(e) {
                e.stopPropagation();
                var t = ($("body"), $(this)),
                    a = t.data("drawer"),
                    i = $("#content_wrapper");
                a && (i.hasClass(a) ? i.removeClass(a) : i.addClass(a)), "open-left" === a || "open-right" === a || "open-left-lg" === a || "open-right-lg" === a ? (0, n.backDrops)(a, t, i) : ("toggle-left" === a && Modernizr.mq("(max-width: 992px)") || "toggle-right" === a && Modernizr.mq("(max-width: 992px)")) && (0, n.backDrops)(a, t, i), setTimeout(function() {
                    (0, o.masonryInit)()
                }, 200), setTimeout(function() {
                    if ($("#storeLocations").length > 0) {
                        var e = window.storeLocations || (window.storeLocations = {});
                        google.maps.event.trigger(e, "resize")
                    }
                }, 200)
            });
            var t = $("[data-dismiss=drawer]");
            t.on("click", function(e) {
                e.stopPropagation(), $(".backdrop").trigger("click")
            })
        };
    t.toggleDrawer = i
}, function(e, t) {
    Object.defineProperty(t, "__esModule", {
        value: !0
    });
    var a = function(e, t) {
            $(e).keyup(function() {
                var a = $(this).val().replace(/\s/g, "");
                t.each(function() {
                    $(this).text().replace(/\s/g, "").search(new RegExp(a, "i")) < 0 ? ($(this).fadeOut(), n(e, t)) : $(this).show()
                })
            })
        },
        n = function(e, t) {
            t.not("li.filter").is(":visible") === !1 ? 0 === t.closest("ul").find("li.no-results").length && t.parent().append('<li class="no-results"><div class="alert alert-danger" role="alert">No Match Found</div></li>') : t.closest("ul").find(".no-results").remove()
        };
    t.filterList = a
}, function(e, t) {
    Object.defineProperty(t, "__esModule", {
        value: !0
    });
    var a = function() {
            $(".scrollbar").length > 0 && $(".scrollbar").mCustomScrollbar({
                theme: "minimal-dark",
                scrollInertia: 1e3,
                mouseWheel: {
                    preventDefault: !0
                }
            }), $("#app_main-menu-wrapper.scrollbar").mCustomScrollbar("scrollTo", ".nav-dropdown.active", {
                scrollInertia: 0
            })
        },
        n = function() {
            $(".scrollbar-minimal-light").length > 0 && $(".scrollbar-minimal-light").mCustomScrollbar({
                theme: "minimal",
                scrollInertia: 1e3,
                mouseWheel: {
                    preventDefault: !0
                }
            }), $(".scrollbar-light").length > 0 && $(".scrollbar-light").mCustomScrollbar({
                theme: "light",
                scrollInertia: 1e3,
                mouseWheel: {
                    preventDefault: !0
                }
            }), $(".scrollbar-dark").length > 0 && $(".scrollbar-dark").mCustomScrollbar({
                theme: "dark",
                scrollInertia: 1e3,
                mouseWheel: {
                    preventDefault: !0
                }
            })
        },
        o = function() {
            $(".select.country").dropdown({
                optionClass: "withripple",
                dropdownClass: "country-icons",
                callback: function(e) {
                    $("body").on("click", function() {
                        e.children().removeClass("focus")
                    })
                }
            }), $(".country-icons ul li").each(function() {
                var e = $(this).text();
                "English" === $.trim(e) ? $(this).prepend('<img src="assets/img/icons/flags/US.png" class="max-w-20 m-r-10" alt="" />') : "Español" === $.trim(e) ? $(this).prepend('<img src="assets/img/icons/flags/ES.png" class="max-w-20 m-r-10" alt="" />') : "Français" === $.trim(e) ? $(this).prepend('<img src="assets/img/icons/flags/FR.png" class="max-w-20 m-r-10" alt="" />') : "Italiano" === $.trim(e) && $(this).prepend('<img src="assets/img/icons/flags/IT.png" class="max-w-20 m-r-10" alt="" />')
            }), $(".select").dropdown({
                optionClass: "withripple"
            })
        },
        i = function() {
            $(".timer").countTo()
        },
        r = function() {
            $('[data-toggle="tooltip"]').tooltip(), $('[data-toggle="tooltip"]').on("shown.bs.tooltip", function() {
                $(".tooltip").addClass("scale").css("opacity", 1)
            })
        },
        s = function() {
            var e = $(".circle-profile-photo"),
                t = $(".square-profile-photo");
            e.materialAvatar({
                shape: "circle"
            }), t.materialAvatar()
        },
        l = function() {
            if ($("#slider-danger").length) {
                var e = document.getElementById("slider-danger");
                noUiSlider.create(e, {
                    start: 10,
                    connect: [!0, !1],
                    range: {
                        min: 0,
                        max: 100
                    }
                })
            }
            if ($("#slider-warning").length) {
                var t = document.getElementById("slider-warning");
                noUiSlider.create(t, {
                    start: 20,
                    connect: [!0, !1],
                    range: {
                        min: 0,
                        max: 100
                    }
                })
            }
            if ($("#slider-info").length) {
                var a = document.getElementById("slider-info");
                noUiSlider.create(a, {
                    start: 40,
                    connect: [!0, !1],
                    range: {
                        min: 0,
                        max: 100
                    }
                })
            }
            if ($("#slider-success").length) {
                var n = document.getElementById("slider-success");
                noUiSlider.create(n, {
                    start: 10,
                    connect: [!0, !1],
                    range: {
                        min: 0,
                        max: 100
                    }
                })
            }
            if ($("#slider-primary").length) {
                var o = document.getElementById("slider-primary");
                noUiSlider.create(o, {
                    start: 60,
                    connect: [!0, !1],
                    range: {
                        min: 0,
                        max: 100
                    }
                })
            }
            if ($("#slider-danger-vert").length) {
                var i = document.getElementById("slider-danger-vert");
                noUiSlider.create(i, {
                    start: 10,
                    orientation: "vertical",
                    connect: [!0, !1],
                    range: {
                        min: 0,
                        max: 100
                    }
                })
            }
            if ($("#slider-warning-vert").length) {
                var r = document.getElementById("slider-warning-vert");
                noUiSlider.create(r, {
                    start: 20,
                    orientation: "vertical",
                    connect: [!0, !1],
                    range: {
                        min: 0,
                        max: 100
                    }
                })
            }
            if ($("#slider-info-vert").length) {
                var s = document.getElementById("slider-info-vert");
                noUiSlider.create(s, {
                    start: 40,
                    orientation: "vertical",
                    connect: [!0, !1],
                    range: {
                        min: 0,
                        max: 100
                    }
                })
            }
            if ($("#slider-success-vert").length) {
                var l = document.getElementById("slider-success-vert");
                noUiSlider.create(l, {
                    start: 10,
                    orientation: "vertical",
                    connect: [!0, !1],
                    range: {
                        min: 0,
                        max: 100
                    }
                })
            }
            if ($("#slider-primary-vert").length) {
                var c = document.getElementById("slider-primary-vert");
                noUiSlider.create(c, {
                    start: 60,
                    orientation: "vertical",
                    connect: [!0, !1],
                    range: {
                        min: 0,
                        max: 100
                    }
                })
            }
            if ($("#slider-range").length) {
                var d = document.getElementById("slider-range"),
                    p = wNumb({
                        decimals: 0,
                        thousand: ",",
                        prefix: "$"
                    });
                noUiSlider.create(d, {
                    start: [162091, 676818],
                    step: 1,
                    range: {
                        min: [1e5],
                        max: [1e6]
                    },
                    connect: !0,
                    format: p
                }), d.noUiSlider.on("update", function(e, t) {
                    document.getElementById("slider-range-value1").innerHTML = e[0], document.getElementById("slider-range-value2").innerHTML = e[1], document.getElementsByName("min-value").value = p.from(e[0]), document.getElementsByName("max-value").value = p.from(e[1])
                })
            }
        },
        c = function() {
            $("#md_input_date").bootstrapMaterialDatePicker({
                weekStart: 0,
                time: !1
            }), $("#md_input_time").bootstrapMaterialDatePicker({
                date: !1,
                format: "HH:mm"
            }), $("#md_input_date_time").bootstrapMaterialDatePicker({
                format: "dddd DD MMMM YYYY - HH:mm"
            })
        },
        d = function() {
            var e, t, a = (new Pikaday({
                    field: document.getElementById("datepicker"),
                    firstDay: 1,
                    minDate: new Date,
                    maxDate: new Date(2020, 12, 31),
                    yearRange: [2e3, 2020]
                }), new Pikaday({
                    field: document.getElementById("datepicker-theme"),
                    theme: "dark-theme"
                }), function() {
                    o.setStartRange(e), i.setStartRange(e), i.setMinDate(e)
                }),
                n = function() {
                    o.setEndRange(t), o.setMaxDate(t), i.setEndRange(t)
                },
                o = new Pikaday({
                    field: document.getElementById("start_date"),
                    minDate: new Date,
                    maxDate: new Date(2020, 12, 31),
                    onSelect: function() {
                        e = this.getDate(), a()
                    }
                }),
                i = new Pikaday({
                    field: document.getElementById("end_date"),
                    minDate: new Date,
                    maxDate: new Date(2020, 12, 31),
                    onSelect: function() {
                        t = this.getDate(), n()
                    }
                }),
                r = o.getDate(),
                s = i.getDate();
            r && (e = r, a()), s && (t = s, n())
        },
        p = function() {
            $("#form-horizontal").validate({
                highlight: function(e) {
                    $(e).closest(".form-group").addClass("has-error")
                },
                unhighlight: function(e) {
                    $(e).closest(".form-group").removeClass("has-error")
                },
                errorElement: "span",
                errorClass: "help-block",
                errorPlacement: function(e, t) {
                    t.parent(".input-group").length ? e.insertAfter(t.parent()) : t.parent("label").length ? e.insertBefore(t.parent()) : e.insertAfter(t)
                }
            })
        },
        u = function() {
            $("#masonry").masonry({
                itemSelector: ".masonry-item"
            })
        },
        h = function() {
            $(document).on("click", ".dropdown-menu", function(e) {
                e.stopPropagation()
            })
        },
        m = function() {
            $("#new_arrivals_img").slick({
                dots: !0,
                infinite: !0,
                speed: 500,
                cssEase: "linear"
            })
        },
        f = function() {
            $("audio, video")[0] && $("video,audio").mediaelementplayer()
        },
        g = function() {
            $("[data-toggle=popover]").popover()
        },
        b = function() {
            $(".toolbar-icons a").on("click", function(e) {
                e.preventDefault()
            }), $('button[data-toolbar="user-options"]').toolbar({
                content: "#user-options",
                position: "top",
                event: "hover"
            }), $('button[data-toolbar="transport-options"]').toolbar({
                content: "#transport-options",
                position: "top",
                event: "hover"
            }), $('button[data-toolbar="transport-options-o"]').toolbar({
                content: "#transport-options-o",
                position: "bottom",
                event: "hover"
            }), $('button[data-toolbar="content-option"]').toolbar({
                content: "#transport-options",
                event: "hover"
            }), $('button[data-toolbar="position-option"]').toolbar({
                content: "#transport-options",
                position: "bottom",
                event: "hover"
            }), $('button[data-toolbar="style-option"]').toolbar({
                content: "#transport-options",
                position: "bottom",
                style: "primary",
                event: "hover"
            }), $('button[data-toolbar="animation-option"]').toolbar({
                content: "#transport-options",
                position: "bottom",
                style: "primary",
                animation: "flyin",
                event: "hover"
            }), $('button[data-toolbar="event-option"]').toolbar({
                content: "#transport-options",
                position: "bottom",
                style: "primary",
                event: "hover"
            }), $('button[data-toolbar="hide-option"]').toolbar({
                content: "#transport-options",
                position: "bottom",
                style: "primary",
                event: "hover",
                hideOnClick: !0
            }), $("#link-toolbar").toolbar({
                content: "#user-options",
                position: "top",
                event: "hover",
                adjustment: 35
            }), $('button[data-toolbar="set-01"]').toolbar({
                content: "#set-01-options",
                position: "top",
                event: "hover"
            }), $('button[data-toolbar="set-02"]').toolbar({
                content: "#set-02-options",
                position: "left",
                event: "hover"
            }), $('button[data-toolbar="set-03"]').toolbar({
                content: "#set-03-options",
                position: "bottom",
                event: "hover"
            }), $('button[data-toolbar="set-04"]').toolbar({
                content: "#set-04-options",
                position: "right",
                event: "hover"
            }), $(".download").on("click", function() {
                mixpanel.track("Toolbar.Download")
            }), $("#transport-options-2").find("a").on("hover", function() {
                $this = $(this), $button = $('button[data-toolbar="transport-options-2"]'), $newClass = $this.find("i").attr("class").substring(3), $oldClass = $button.find("i").attr("class").substring(3), $newClass != $oldClass && $button.find("i").animate({
                    top: "+=50",
                    opacity: 0
                }, 200, function() {
                    $(this).removeClass($oldClass).addClass($newClass).css({
                        top: "-=100",
                        opacity: 1
                    }).animate({
                        top: "+=50"
                    })
                })
            }), $('button[data-toolbar="transport-options-2"]').toolbar({
                content: "#transport-options-2",
                position: "top"
            })
        };
    t.scrollBar = a, t.selectDropdowns = o, t.materialAvatar = s, t.initTooltips = r, t.initPopovers = g, t.countTo = i, t.otherScrollbarOptions = n, t.initSliders = l, t.materialDatePicker = c, t.pikaday = d, t.triggerFormValidation = p, t.masonryInit = u, t.keepDropdownOpen = h, t.slickCarousel = m, t.videoPlayer = f, t.initToolbarjs = b
}, function(e, t) {
    Object.defineProperty(t, "__esModule", {
        value: !0
    });
    var a = function() {
            var e = $("#app_main-menu-wrapper .nav");
            $(e).navgoco({
                caretHtml: !1,
                accordion: !0
            })
        },
        n = function() {
            $("#app_sidebar-left").on("mouseleave", function() {
                $("body.app_sidebar-menu-collapsed").length > 0 && ($(".nav-dropdown").each(function() {
                    $(this).hasClass("open") && !$(this).hasClass("active") && ($(this).removeClass("open"), $(this).children(".nav-sub").removeAttr("style"))
                }), $("#profile-menu").length > 0 && $("#profile-menu").hasClass("open") && ($("#profile-menu").removeClass("open"), $("#profile-menu .submenu").css({
                    display: "none"
                })))
            })
        },
        o = function() {
            var e = $("body"),
                t = $("html");
            $(window).width() < 1280 && !t.hasClass("backdrop-open") ? (e.removeClass("app_sidebar-menu-collapsed"), $("#content_wrapper").removeClass("toggle-left toggle-right")) : t.hasClass("backdrop-open") || e.removeClass("app_sidebar-left-open")
        },
        i = function(e) {
            "app_sidebar-menu-collapsed" === e.context.dataset.toggleState && ($("body.app_sidebar-menu-collapsed").length > 0 ? $("#app_topnavbar-wrapper .menu-icon a").addClass("is-active") : $("#app_topnavbar-wrapper .menu-icon a").removeClass("is-active")), "sidebar-overlay-open" === e.context.dataset.toggleState && ($("body.sidebar-overlay-open").length > 0 ? $('[data-toggle-state="sidebar-overlay-open"] i').toggleClass("") : $('[data-toggle-state="sidebar-overlay-open"] i').toggleClass(" "))
        },
        r = function() {
            $("[data-toggle-profile]").on("click", function() {
                $("#profile-menu").slideToggle()
            })
        },
        s = function() {
            $('[data-profile="open-menu"]').on("click", function() {
                $(this).parents("#profile-menu").toggleClass("open").find(".submenu").slideToggle()
            })
        },
        l = function() {
            $('[data-trigger="sidebar-overlay-open"]').on("click", function(e) {
                e.stopPropagation(), $('[data-toggle-state="sidebar-overlay-open"]').trigger("click"), $('a[href="#sidebar_settings"]').trigger("click")
            })
        };
    t.initSubMenu = a, t.closeOpenState = n, t.switchMenuState = o, t.menuIconState = i, t.openProfile = r, t.openProfileMenu = s, t.openThemeSettingPanel = l
}, function(e, t, a) {
    var n = a(14),
        o = a(4),
        i = a(13),
        r = a(36),
        s = a(18),
        l = a(3),
        c = a(19),
        d = a(21),
        p = a(20),
        u = a(22),
        h = a(7),
        m = a(30),
        f = a(35),
        g = a(31),
        b = a(2),
        v = a(38),
        C = a(34),
        k = a(15),
        w = a(17),
        y = a(12),
        x = a(33),
        P = a(6),
        S = a(26),
        T = a(40),
        M = a(32),
        D = a(27),
        L = a(16),
        O = a(25),
        I = a(41),
        A = a(29),
        B = a(37),
        E = a(24),
        z = a(39),
        W = a(28),
        R = a(23),
        H = window.MaterialLab || (window.MaterialLab = {});
    H.dashboardWebStats = l.dashboardWebStats,
        function(e) {
            e.Package ? Materialize = {} : e.Materialize = {}
        }(window), Materialize.guid = function() {
            function e() {
                return Math.floor(65536 * (1 + Math.random())).toString(16).substring(1)
            }
            return function() {
                return e() + e() + "-" + e() + "-" + e() + "-" + e() + "-" + e() + e() + e()
            }
        }(), $(function() {
            $.material.init(), (0, P.selectDropdowns)(), (0, P.scrollBar)(), (0, P.keepDropdownOpen)(), (0, P.slickCarousel)(), (0, P.videoPlayer)(), (0, P.initToolbarjs)(), (0, P.materialAvatar)(), (0, h.initSubMenu)(), (0, n.toggleState)(), (0, n.toggleExpand)(), (0, r.navBarSearch)(), (0, s.cardRefresh)(), (0, s.cardToggleHighlighter)(), (0, h.switchMenuState)(), (0, h.openProfileMenu)(), (0, h.openProfile)(), (0, h.openThemeSettingPanel)(), (0, l.dashboardWebStats)(), (0, l.dashboardC3Donut)(), (0, l.chartistPathAnimationDashboard)(), (0, l.chartistBarsDashboard)(), (0, l.chartistLineDashboard)(), (0, l.chartistBiPolarChartDashboard)(), (0, O.mwDataTables)(), (0, s.cardStacks)(), (0, s.cardOffCanvas)(), (0, o.toggleDrawer)(), (0, l.sparklineDashboard)(), (0, S.currentDateTimeSidebar)(), (0, S.todaysDate)(), (0, S.timlineInput)(), (0, S.nextThreeDays)(), (0, s.cardCollapse)(), (0, h.closeOpenState)(), (0, P.initTooltips)(), (0, P.initPopovers)(), (0, P.countTo)(), (0, P.otherScrollbarOptions)(), (0, T.fullscreenTransition)(), (0, D.css3AnimationDemos)(), (0, D.iconModal)(), (0, k.loginV3)(), (0, k.registerForm)(), (0, y.sweetAlerts)(), (0, y.alertifyjs)(), (0, s.cardSearch)(), (0, C.expansionPanel)(), (0, v.simpleStepper)(), (0, b.chips)(), (0, B.sidebarChatCompose)(), (0, b.initChips)(), (0, m.dismissListItem)(), (0, P.initSliders)(), (0, s.cardReveal)(), (0, s.cardTask)(), (0, P.materialDatePicker)(), (0, P.pikaday)(), (0, L.countryAutocomplete)(), (0, L.autocompleteBasic)(), (0, L.autocompleteClear)(), (0, P.triggerFormValidation)(), (0, I.wizardDemo)(), (0, i.fabMenu)(), (0, P.masonryInit)(), (0, i.toggleCard)(), (0, i.toggleSearch)(), (0, f.initPhotoSwipeFromDOM)(), (0, D.cardCarousel)(), (0, D.cardDemoMorrisChart)(), (0, D.loadThemes)(), (0, D.swapLayoutMode)(), (0, c.c3_pie)(), (0, c.c3_donut)(), (0, c.c3_gauges)(), (0, c.c3_areaChart)(), (0, c.c3_combination)(), (0, c.c3_zoom)(), (0, c.c3_stacked_bars_chart)(), (0, c.c3_areaSpline)(), (0, c.c3_scatter)(), (0, p.chartist_simplePie)(), (0, p.chartist_pieCustomLabels)(), (0, p.chartist_animatingDonut)(), (0, p.chartist_biPolarBar)(), (0, p.chartist_peakCircles)(), (0, p.chartist_stackedBar)(), (0, p.chartist_horizontalBar)(), (0, p.chartist_lineChart)(), (0, p.chartist_holesInData)(), (0, p.chartist_filledHolesInData)(), (0, p.chartist_onlyWholeNumbers)(), (0, p.chartist_lineScatter)(), (0, p.chartist_lineChartWithArea)(), (0, p.chartist_biPolar)(), (0, d.chartjs_lineChart)(), (0, d.chartjs_barChart)(), (0, d.chartjs_radarChart)(), (0, d.chartjs_polarChart)(), (0, d.chartjs_pieChart)(), (0, d.chartjs_doughnutChart)(), (0, u.morrisjs_demo)(), (0, R.chatContactList)(), (0, O.checkAll)(), (0, O.deleteItem)(), (0, O.pagination)(), (0, W.triggerSummerNoteEcom)(), (0, W.triggerDropzoneEcom)(), (0, W.addProductTags)(), (0, W.editProductImg)(), (0, W.orderTable)(), (0, W.customerTable)(), (0, x.allNotes)(), (0, x.notesAdd)(), (0, x.noteSelected)(), (0, x.noteImgUpload)(), (0, x.noteAddList)(), (0, x.updateNote)(), (0, g.mailList)(), (0, g.mailCompose)(), (0, g.mailSelected)(), (0, z.loadTaskId)(), (0, z.getTaskCardInfo)(), (0, z.addNewTask)(), (0, z.addNewTaskList)(), (0, z.deleteTask)(), (0, z.editTask)(), (0, z.filterTaskMembers)(), (0, z.dragDropTask)(), (0, E.contactSetup)(), (0, E.contactEditUser)(), (0, E.contactNewUser)(), (0, E.contactSelected)(), (0, w.cal)(), (0, w.updateInputCal)(), (0, w.addInputCal)(), (0, w.filterCalMembers)(), (0, A.loadGmaps)(), Modernizr.mq("screen and (min-width:768px)") && (0, M.matchElementHeight)(".match-height .card")
        }), window.onload = function() {
            (0, W.salesStats)(), (0, W.conversionStats)(), (0, W.todaysSales)(), (0, W.newUsers)()
        }, $(document).on("resize", function() {
            _.debounce(h.switchMenuState, 300, !1)(), _.debounce(l.drawSparkline, 300, !1)()
        })
}, function(e, t) {
    ! function(e, t, a, n) {
        var o = e.MaterialLab || (e.MaterialLab = {});
        Modernizr.touchevents ? o.APP_TOUCH = !0 : o.APP_TOUCH = !1, o.APP_MEDIAQUERY = {
            desktopLG: 1280,
            desktop: 992,
            tablet: 768,
            mobile: 480
        }, o.APP_COLORS = {
            primary: "#ec407a",
            success: "#28bebd",
            info: "#42a5f5",
            warning: "#fdf39e",
            danger: "#ef5350",
            mw_purple: "#6B79C4",
            mw_turquoise: "#00c5dc",
            mw_peach: "#feb38d",
            mw_salmon: "#EE6E73",
            mw_lightGray: "#EEF5F9",
            mw_gray: "#8f9eb5",
            mw_darkGray: "#707C94",
            mw_grayBlue: "#59779B"
        }
    }(window, document, window.jQuery),
    function(e, t, a, n) {
        var o = !0,
            i = a("html"),
            r = a("body");
        a("#app_wrapper"), a("#app_sidebar-left"), a("#app_sidebar-right");
        o && "undefined" != typeof localStorage && (e.appConfig = Storages.initNamespaceStorage("appConfig"), appConfig.localStorage.isEmpty() && appConfig.localStorage.set({
            leftSideBar: ""
        }), r.addClass(appConfig.localStorage.get("leftSideBar"))), e.app = {
            persist: o,
            config: {
                isTouch: function() {
                    return i.hasClass("touch")
                },
                isLeftSideBarCollapsed: function() {
                    return r.hasClass("app_sidebar-menu-collapsed")
                }
            }
        }
    }(window, document, window.jQuery)
}, function(e, t) {
    ! function(e) {
        function t(e) {
            return "undefined" == typeof e.which || "number" == typeof e.which && e.which > 0 && (!e.ctrlKey && !e.metaKey && !e.altKey && 8 != e.which && 9 != e.which && 13 != e.which && 16 != e.which && 17 != e.which && 20 != e.which && 27 != e.which)
        }

        function a(t) {
            var a = e(t);
            a.prop("disabled") || a.closest(".form-group").addClass("is-focused")
        }

        function n(e, t) {
            var a;
            return a = e.hasClass("checkbox-inline") || e.hasClass("radio-inline") ? e : e.closest(".checkbox").length ? e.closest(".checkbox") : e.closest(".radio"),
                a.toggleClass("disabled", t)
        }

        function o(t) {
            var o = !1;
            (t.is(e.material.options.checkboxElements) || t.is(e.material.options.radioElements)) && (o = !0), t.closest("label").hover(function() {
                var t = e(this).find("input"),
                    i = t.prop("disabled");
                o && n(e(this), i), i || a(t)
            }, function() {
                i(e(this).find("input"))
            })
        }

        function i(t) {
            e(t).closest(".form-group").removeClass("is-focused")
        }
        e.expr[":"].notmdproc = function(t) {
            return !e(t).data("mdproc")
        }, e.material = {
            options: {
                validate: !0,
                input: !0,
                ripples: !0,
                checkbox: !0,
                togglebutton: !0,
                radio: !0,
                arrive: !0,
                autofill: !1,
                withRipples: [".btn:not(.withoutripple)", ".submenu > li > a", ".submenu > ul > li > a", ".nav-pills li a ", ".fc-button", ".dropdown-alt .list-group", "#leftnav .list-group .list-group-item ", ".navbar a:not(.withoutripple)", ".dropdown-menu li a", ".nav-tabs a:not(.withoutripple)", ".withripple", ".pagination li:not(.active):not(.disabled) a:not(.withoutripple)"].join(","),
                inputElements: "input.form-control, textarea.form-control, select.form-control",
                checkboxElements: ".checkbox > label > input[type=checkbox], label.checkbox-inline > input[type=checkbox]",
                togglebuttonElements: ".togglebutton > label > input[type=checkbox]",
                radioElements: ".radio > label > input[type=radio], label.radio-inline > input[type=radio]"
            },
            checkbox: function(t) {
                var a = e(t ? t : this.options.checkboxElements).filter(":notmdproc").data("mdproc", !0).after("<span class='checkbox-material'><span class='check'></span></span>");
                o(a)
            },
            togglebutton: function(t) {
                var a = e(t ? t : this.options.togglebuttonElements).filter(":notmdproc").data("mdproc", !0).after("<span class='toggle'></span>");
                o(a)
            },
            radio: function(t) {
                var a = e(t ? t : this.options.radioElements).filter(":notmdproc").data("mdproc", !0).after("<span class='circle'></span><span class='check'></span>");
                o(a)
            },
            input: function(t) {
                e(t ? t : this.options.inputElements).filter(":notmdproc").data("mdproc", !0).each(function() {
                    var t = e(this),
                        a = t.closest(".form-group");
                    0 !== a.length || "hidden" === t.attr("type") || t.attr("hidden") || (t.wrap("<div class='form-group'></div>"), a = t.closest(".form-group")), t.attr("data-hint") && (t.after("<p class='help-block'>" + t.attr("data-hint") + "</p>"), t.removeAttr("data-hint"));
                    var n = {
                        "input-lg": "form-group-lg",
                        "input-sm": "form-group-sm"
                    };
                    if (e.each(n, function(e, n) {
                            t.hasClass(e) && (t.removeClass(e), a.addClass(n))
                        }), t.hasClass("floating-label")) {
                        var o = t.attr("placeholder");
                        t.attr("placeholder", null).removeClass("floating-label");
                        var i = t.attr("id"),
                            r = "";
                        i && (r = "for='" + i + "'"), a.addClass("label-floating"), t.after("<label " + r + "class='control-label'>" + o + "</label>")
                    }
                    null !== t.val() && "undefined" != t.val() && "" !== t.val() || a.addClass("is-empty"), a.find("input[type=file]").length > 0 && a.addClass("is-fileinput")
                })
            },
            attachInputEventHandlers: function() {
                var n = this.options.validate;
                e(document).on("keydown paste", ".form-control", function(a) {
                    t(a) && e(this).closest(".form-group").removeClass("is-empty")
                }).on("keyup change", ".form-control", function() {
                    var t = e(this),
                        a = t.closest(".form-group"),
                        o = "undefined" == typeof t[0].checkValidity || t[0].checkValidity();
                    "" === t.val() ? a.addClass("is-empty") : a.removeClass("is-empty"), n && (o ? a.removeClass("has-error") : a.addClass("has-error"))
                }).on("focus", ".form-control, .form-group.is-fileinput", function() {
                    a(this)
                }).on("blur", ".form-control, .form-group.is-fileinput", function() {
                    i(this)
                }).on("change", ".form-group input", function() {
                    var t = e(this);
                    if ("file" != t.attr("type")) {
                        var a = t.closest(".form-group"),
                            n = t.val();
                        n ? a.removeClass("is-empty") : a.addClass("is-empty")
                    }
                }).on("change", ".form-group.is-fileinput input[type='file']", function() {
                    var t = e(this),
                        a = t.closest(".form-group"),
                        n = "";
                    e.each(this.files, function(e, t) {
                        n += t.name + ", "
                    }), n = n.substring(0, n.length - 2), n ? a.removeClass("is-empty") : a.addClass("is-empty"), a.find("input.form-control[readonly]").val(n)
                })
            },
            ripples: function(t) {
                e(t ? t : this.options.withRipples).ripples()
            },
            autofill: function() {
                var t = setInterval(function() {
                    e("input[type!=checkbox]").each(function() {
                        var t = e(this);
                        t.val() && t.val() !== t.attr("value") && t.trigger("change")
                    })
                }, 100);
                setTimeout(function() {
                    clearInterval(t)
                }, 1e4)
            },
            attachAutofillEventHandlers: function() {
                var t;
                e(document).on("focus", "input", function() {
                    var a = e(this).parents("form").find("input").not("[type=file]");
                    t = setInterval(function() {
                        a.each(function() {
                            var t = e(this);
                            t.val() !== t.attr("value") && t.trigger("change")
                        })
                    }, 100)
                }).on("blur", ".form-group input", function() {
                    clearInterval(t)
                })
            },
            init: function(t) {
                this.options = e.extend({}, this.options, t);
                var a = e(document);
                e.fn.ripples && this.options.ripples && this.ripples(), this.options.input && (this.input(), this.attachInputEventHandlers()), this.options.checkbox && this.checkbox(), this.options.togglebutton && this.togglebutton(), this.options.radio && this.radio(), this.options.autofill && (this.autofill(), this.attachAutofillEventHandlers()), document.arrive && this.options.arrive && (e.fn.ripples && this.options.ripples && a.arrive(this.options.withRipples, function() {
                    e.material.ripples(e(this))
                }), this.options.input && a.arrive(this.options.inputElements, function() {
                    e.material.input(e(this))
                }), this.options.checkbox && a.arrive(this.options.checkboxElements, function() {
                    e.material.checkbox(e(this))
                }), this.options.radio && a.arrive(this.options.radioElements, function() {
                    e.material.radio(e(this))
                }), this.options.togglebutton && a.arrive(this.options.togglebuttonElements, function() {
                    e.material.togglebutton(e(this))
                }))
            }
        }
    }(jQuery)
}, function(e, t) {
    ! function(e, t, a, n) {
        function o(t, a) {
            r = this, this.element = e(t), this.options = e.extend({}, s, a), this._defaults = s, this._name = i, this.init()
        }
        var i = "ripples",
            r = null,
            s = {};
        o.prototype.init = function() {
            var a = this.element;
            a.on("mousedown touchstart", function(n) {
                if (!r.isTouch() || "mousedown" !== n.type) {
                    a.find(".ripple-container").length || a.append('<div class="ripple-container"></div>');
                    var o = a.children(".ripple-container"),
                        i = r.getRelY(o, n),
                        s = r.getRelX(o, n);
                    if (i || s) {
                        var l = r.getRipplesColor(a),
                            c = e("<div></div>");
                        c.addClass("ripple").css({
                                left: s,
                                top: i,
                                "background-color": l
                            }), o.append(c),
                            function() {
                                return t.getComputedStyle(c[0]).opacity
                            }(), r.rippleOn(a, c), setTimeout(function() {
                                r.rippleEnd(c)
                            }, 500), a.on("mouseup mouseleave touchend", function() {
                                c.data("mousedown", "off"), "off" === c.data("animating") && r.rippleOut(c)
                            })
                    }
                }
            })
        }, o.prototype.getNewSize = function(e, t) {
            return Math.max(e.outerWidth(), e.outerHeight()) / t.outerWidth() * 2.5
        }, o.prototype.getRelX = function(e, t) {
            var a = e.offset();
            return r.isTouch() ? (t = t.originalEvent, 1 === t.touches.length && t.touches[0].pageX - a.left) : t.pageX - a.left
        }, o.prototype.getRelY = function(e, t) {
            var a = e.offset();
            return r.isTouch() ? (t = t.originalEvent, 1 === t.touches.length && t.touches[0].pageY - a.top) : t.pageY - a.top
        }, o.prototype.getRipplesColor = function(e) {
            var a = e.data("ripple-color") ? e.data("ripple-color") : t.getComputedStyle(e[0]).color;
            return a
        }, o.prototype.hasTransitionSupport = function() {
            var e = a.body || a.documentElement,
                t = e.style,
                o = t.transition !== n || t.WebkitTransition !== n || t.MozTransition !== n || t.MsTransition !== n || t.OTransition !== n;
            return o
        }, o.prototype.isTouch = function() {
            return /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent)
        }, o.prototype.rippleEnd = function(e) {
            e.data("animating", "off"), "off" === e.data("mousedown") && r.rippleOut(e)
        }, o.prototype.rippleOut = function(e) {
            e.off(), r.hasTransitionSupport() ? e.addClass("ripple-out") : e.animate({
                opacity: 0
            }, 100, function() {
                e.trigger("transitionend")
            }), e.on("transitionend webkitTransitionEnd oTransitionEnd MSTransitionEnd", function() {
                e.remove()
            })
        }, o.prototype.rippleOn = function(e, t) {
            var a = r.getNewSize(e, t);
            r.hasTransitionSupport() ? t.css({
                "-ms-transform": "scale(" + a + ")",
                "-moz-transform": "scale(" + a + ")",
                "-webkit-transform": "scale(" + a + ")",
                transform: "scale(" + a + ")"
            }).addClass("ripple-on").data("animating", "on").data("mousedown", "on") : t.animate({
                width: 2 * Math.max(e.outerWidth(), e.outerHeight()),
                height: 2 * Math.max(e.outerWidth(), e.outerHeight()),
                "margin-left": -1 * Math.max(e.outerWidth(), e.outerHeight()),
                "margin-top": -1 * Math.max(e.outerWidth(), e.outerHeight()),
                opacity: .2
            }, 500, function() {
                t.trigger("transitionend")
            })
        }, e.fn.ripples = function(t) {
            return this.each(function() {
                e.data(this, "plugin_" + i) || e.data(this, "plugin_" + i, new o(this, t))
            })
        }
    }(jQuery, window, document)
}, function(e, t) {
    Object.defineProperty(t, "__esModule", {
        value: !0
    });
    var a = function() {
            $("#sweet_alerts_card").on("click.sweet-error", ".sweet-error", function(e) {
                e.stopPropagation(), swal("Oops...", "Something went wrong!", "error")
            }), $("#sweet_alerts_card").on("click.sweet-message", ".sweet-message", function(e) {
                e.stopPropagation(), swal("Here's simple message!")
            }), $("#sweet_alerts_card").on("click.sweet-success", ".sweet-success", function(e) {
                e.stopPropagation(), swal("Good job!", "You clicked the button!", "success")
            }), $("#sweet_alerts_card").on("click.sweet-warning", ".sweet-warning", function(e) {
                e.stopPropagation(), swal({
                    title: "Are you sure?",
                    text: "You will not be able to recover this imaginary file!",
                    type: "warning",
                    showCancelButton: !0,
                    confirmButtonColor: "#DD6B55",
                    confirmButtonText: "Yes, delete it!",
                    closeOnConfirm: !1
                }, function() {
                    swal("Deleted!", "Your imaginary file has been deleted.", "success")
                })
            }), $("#sweet_alerts_card").on("click.sweet-warning-cancel", ".sweet-warning-cancel", function(e) {
                e.stopPropagation(), swal({
                    title: "Are you sure?",
                    text: "You will not be able to recover this imaginary file!",
                    type: "warning",
                    showCancelButton: !0,
                    confirmButtonColor: "#DD6B55",
                    confirmButtonText: "Yes, delete it!",
                    cancelButtonText: "No, cancel plx!",
                    closeOnConfirm: !1,
                    closeOnCancel: !1
                }, function(e) {
                    e ? swal("Deleted!", "Your imaginary file has been deleted!", "success") : swal("Cancelled", "Your imaginary file is safe :)", "error")
                })
            })
        },
        n = function() {
            $("#alertify_card").on("click.alertifyAlert", "#alert", function(e) {
                e.stopPropagation(), alertify.alert("Message")
            }), $("#alertify_card").on("click.alertifyConfirm", "#confirm", function(e) {
                e.stopPropagation(), alertify.confirm("Message", function() {
                    alertify.success("You've clicked OK")
                }, function() {
                    alertify.success("You've clicked CANCEL")
                })
            }), $("#alertify_card").on("click.alertifyPrompt", "#prompt", function() {
                alertify.defaultValue("Default Value").prompt("This is a prompt dialog", function(e, t) {
                    t.preventDefault(), alertify.success("You've clicked OK and typed: " + e)
                }, function(e) {
                    e.preventDefault(), alertify.error("You've clicked Cancel")
                })
            }), $("#alertify_card").on("click.alertifyCustomLabel", "#custom-label", function(e) {
                e.stopPropagation(), alertify.okBtn("Accept").cancelBtn("Deny").confirm("Confirm dialog with custom button labels", function(e) {
                    e.preventDefault(), alertify.success("You've clicked OK")
                }, function(e) {
                    e.preventDefault(), alertify.error("You've clicked Cancel")
                })
            })
        };
    t.sweetAlerts = a, t.alertifyjs = n
}, function(e, t) {
    Object.defineProperty(t, "__esModule", {
        value: !0
    });
    var a = function() {
            $(".fab-menu").on("click", function(e) {
                e.stopPropagation();
                var t = $(this),
                    a = t.parent(),
                    n = t.next().children(),
                    o = "";
                if (o = "right" == t.data("fab") ? "translateX(" : "left" == t.data("fab") ? "translateX(-" : "up" == t.data("fab") ? "translateY(-" : "translateY(", t.parent().toggleClass("open"), a.hasClass("open")) {
                    var i = 0;
                    n.each(function(e, t) {
                        i += 48, $(this).css({
                            transform: "" + o + i + "px)"
                        })
                    })
                } else $(this).removeAttr("style")
            }), $(document).on("click", function(e) {
                $(".btn-fab-group").removeClass("open")
            })
        },
        n = function() {
            $("input#toggle-price:checkbox").on("change", function() {
                $(this).is(":checked") ? $(".pricing-wrapper .card-container").addClass("flipped") : $(".pricing-wrapper .card-container").removeClass("flipped")
            })
        },
        o = function() {
            if ($(".search-target")[0]) {
                var e = "[data-search-trigger]",
                    t = $("body");
                t.on("focus", e, function(e) {
                    var t = $(this),
                        a = (t.data("searchTrigger"), t.parents(".search-target"));
                    a.addClass("open")
                }), t.on("blur", e, function(e) {
                    var t = $(this),
                        a = (t.data("searchTrigger"), t.parents(".search-target"));
                    a.removeClass("open")
                })
            }
        };
    t.fabMenu = a, t.toggleCard = n, t.toggleSearch = o
}, function(e, t, a) {
    Object.defineProperty(t, "__esModule", {
        value: !0
    }), t.toggleExpand = t.toggleState = void 0;
    var n = a(7),
        o = a(1),
        i = function() {
            $("[data-toggle-state]");
            $("[data-toggle-state]").on("click", function(e) {
                e.stopPropagation();
                var t = $("body"),
                    a = $(this),
                    i = a.data("toggleState"),
                    r = a.data("key"),
                    s = t;
                i && (s.hasClass(i) ? (s.removeClass(i), "undefined" != typeof localStorage && window.app.persist && Modernizr.mq("(min-width: 1280px)") && appConfig.localStorage.set(r, "")) : ("app_sidebar-menu-collapsed" === i && $("#profile-menu").length > 0 && $("#profile-menu").hasClass("open") && ($("#profile-menu").removeClass("open"), $("#profile-menu .submenu").css({
                    display: "none"
                })), s.addClass(i), "undefined" != typeof localStorage && window.app.persist && Modernizr.mq("(min-width: 1280px)") && appConfig.localStorage.set(r, i))), (0, n.menuIconState)(a), ("undefined" != typeof localStorage && window.app.persist && Modernizr.mq("(max-width: 1280px)") || "undefined" != typeof localStorage && window.app.persist && "sidebar-overlay-open" === i) && ((0, o.backDrops)(i, a, s), appConfig.localStorage.set(r, ""))
            })
        },
        r = function() {
            var e = $("[data-toggle-expand]");
            e.on("click", function(e) {
                e.stopPropagation();
                var t = $("#app_wrapper"),
                    a = $(this),
                    n = a.children("i"),
                    o = a.data("toggleExpand"),
                    i = (a.data("key"), t);
                o && (i.hasClass(o) ? (i.removeClass(o), n.toggleClass("zmdi-fullscreen-exit zmdi-fullscreen")) : (i.addClass(o), n.toggleClass("zmdi-fullscreen zmdi-fullscreen-exit")))
            })
        };
    t.toggleState = i, t.toggleExpand = r
}, function(e, t) {
    Object.defineProperty(t, "__esModule", {
        value: !0
    });
    var a = function() {
            $('[data-toggle="register"]').on("click", function(e) {
                e.stopPropagation(), $(this).parents("#login_content").toggleClass("open")
            })
        },
        n = function() {
            $("#login-wrapper .btn-fab").on("click", function(e) {
                e.stopPropagation(), $(this).parents(".card").toggleClass("active")
            })
        };
    t.loginV3 = n, t.registerForm = a
}, function(e, t) {
    Object.defineProperty(t, "__esModule", {
        value: !0
    });
    var a = function() {
            var e = ["Alabama", "Alaska", "Arizona", "Arkansas", "California", "Colorado", "Connecticut", "Delaware", "Florida", "Georgia", "Hawaii", "Idaho", "Illinois", "Indiana", "Iowa", "Kansas", "Kentucky", "Louisiana", "Maine", "Maryland", "Massachusetts", "Michigan", "Minnesota", "Mississippi", "Missouri", "Montana", "Nebraska", "Nevada", "New Hampshire", "New Jersey", "New Mexico", "New York", "North Carolina", "North Dakota", "Ohio", "Oklahoma", "Oregon", "Pennsylvania", "Rhode Island", "South Carolina", "South Dakota", "Tennessee", "Texas", "Utah", "Vermont", "Virginia", "Washington", "West Virginia", "Wisconsin", "Wyoming"];
            $("#autocomplete_states").typeahead({
                source: e
            })
        },
        n = function() {
            var e = ["Alabama", "Alaska", "Arizona", "Arkansas", "California", "Colorado", "Connecticut", "Delaware", "Florida", "Georgia", "Hawaii", "Idaho", "Illinois", "Indiana", "Iowa", "Kansas", "Kentucky", "Louisiana", "Maine", "Maryland", "Massachusetts", "Michigan", "Minnesota", "Mississippi", "Missouri", "Montana", "Nebraska", "Nevada", "New Hampshire", "New Jersey", "New Mexico", "New York", "North Carolina", "North Dakota", "Ohio", "Oklahoma", "Oregon", "Pennsylvania", "Rhode Island", "South Carolina", "South Dakota", "Tennessee", "Texas", "Utah", "Vermont", "Virginia", "Washington", "West Virginia", "Wisconsin", "Wyoming"];
            $("#autocomplete_clear").typeahead({
                source: e
            }), $(document.body).on("click", ".autocomplete_clear .zmdi-close", function() {
                $("#autocomplete_clear").val(""), $(".autocomplete_clear .zmdi-close").remove()
            }), $("#autocomplete_clear").on("change keyup copy paste cut", function(e) {
                8 == e.which && 0 == this.value.length ? $(this).parent().find(".zmdi-close").remove() : 0 == $(".autocomplete_clear .zmdi-close").length && $(this).parent().append('<i class="zmdi zmdi-close"></i>')
            })
        },
        o = function() {
            var e = {},
                t = [],
                a = _.debounce(function(a, n) {
                    $.ajax({
                        url: "/assets/data/autocomplete_countries.json",
                        cache: !1,
                        success: function(a) {
                            e = {}, t = [], _.each(a, function(a, n, o) {
                                t.push(a.countryName), e[a.countryName] = a
                            }), n(t)
                        }
                    })
                }, 300);
            $("#autocomplete_countries").typeahead({
                source: function(e, t) {
                    a(e, t)
                },
                highlighter: function(t) {
                    var a = e[t];
                    return '<div class="country"><img style="max-width:45px;margin:10px;" src="assets/img/icons/flags/' + a.countryCode + '.png"/><strong>' + a.countryName + "</strong></div>"
                },
                updater: function(t) {
                    return $(".country").val(e[t].id), t
                }
            })
        };
    t.autocompleteBasic = a, t.autocompleteClear = n, t.countryAutocomplete = o
}, function(e, t, a) {
    Object.defineProperty(t, "__esModule", {
        value: !0
    }), t.filterCalMembers = t.addInputCal = t.updateInputCal = t.cal = void 0;
    var n = a(5),
        o = function() {
            var e = new Date,
                t = (e.getMonth(), e.getFullYear(), $("#calendar"));
            t.fullCalendar({
                header: {
                    left: "today",
                    center: "prev,title,next",
                    right: "month,agendaWeek,agendaDay"
                },
                theme: !1,
                selectable: !0,
                selectHelper: !0,
                editable: !0,
                navLinks: !0,
                eventLimit: !0,
                events: [{
                    id: 1,
                    title: "Plan design meeting",
                    start: "2017-04-02T10:30:00.000Z",
                    end: "2017-04-02T12:30:00.000Z",
                    allDay: !1,
                    className: "mw-salmon",
                    description: "Fashion axe kitsch marfa, art party gluten-free beard meditation lumbersexual pinterest sapiente. Aute portland nostrud four dollar toast, organic typewriter cold-pressed wolf do chartreuse godard."
                }, {
                    id: 2,
                    title: "Client Meeting",
                    start: "2017-04-05T08:30:00",
                    end: "2017-04-05T12:00:00",
                    allDay: !1,
                    className: "mw-grayBlue",
                    description: "Before they sold out consequat voluptate man bun, craft beer ullamco mlkshk quis health goth cold-pressed yuccie pork belly."
                }, {
                    id: 3,
                    title: "Conference in NYC",
                    start: "2017-04-09",
                    end: "2017-04-12",
                    allDay: !0,
                    className: "mw-green",
                    description: "Celiac tilde commodo four dollar toast. Scenester kale chips roof party PBR&B, organic everyday carry cornhole tumblr kickstarter marfa salvia photo booth voluptate gastropub ennui. "
                }, {
                    id: 4,
                    title: "UX design review",
                    start: "2017-04-13T11:30:00",
                    end: "2017-04-13T14:30:00",
                    allDay: !1,
                    className: "mw-blue",
                    description: "Paleo flexitarian bushwick letterpress, ea migas yr adipisicing. "
                }, {
                    id: 5,
                    title: "Board Meeting",
                    start: "2017-04-23T10:00:00",
                    end: "2017-04-23T13:00:00",
                    allDay: !0,
                    className: "mw-grayBlue",
                    description: ""
                }, {
                    id: 6,
                    title: "Concert",
                    start: "2017-04-22",
                    end: "2017-04-23",
                    allDay: !0,
                    className: "mw-turquoise",
                    description: "Man bun tacos tumblr kombucha, yuccie banjo affogato dolore gentrify retro chartreuse. "
                }, {
                    id: 7,
                    title: "Birthday",
                    start: "2017-04-08",
                    end: "2017-04-09",
                    allDay: !0,
                    className: "mw-turquoise",
                    description: "Celiac tilde commodo four dollar toast. Scenester kale chips roof party PBR&B, organic everyday carry cornhole tumblr kickstarter marfa salvia photo booth voluptate gastropub ennui. "
                }, {
                    id: 8,
                    title: "Design Meeting",
                    start: "2017-04-18",
                    end: "2017-04-19",
                    allDay: !0,
                    className: "mw-salmon",
                    description: "Before they sold out consequat voluptate man bun, craft beer ullamco mlkshk quis health goth cold-pressed yuccie pork belly."
                }, {
                    id: 9,
                    title: "Dr. Appointment",
                    start: "2017-04-15T10:00:00",
                    end: "2017-04-15T16:00:00",
                    allDay: !1,
                    className: "mw-turquoise",
                    description: "Celiac tilde commodo four dollar toast."
                }, {
                    id: 10,
                    title: "Brainstorm Session",
                    start: "2017-05-15T10:30:00",
                    end: "2017-05-19T12:30:00",
                    allDay: !1,
                    className: "mw-grayBlue",
                    description: ""
                }],
                dayClick: function(e, t, a) {
                    $("#modal_new_event").modal("show"), $("#modal_new_event #new_event_title").val(""), $("#modal_new_event #allDay").prop("checked", !0), $("#modal_new_event #add_event_start_time,#modal_new_event #add_event_end_time").val("").attr("disabled", !0), $("#modal_new_event #add_event_start_date").val(moment(e).format("YYYY-MM-DD")), $("#modal_new_event #add_event_end_date").val(moment(e).format("YYYY-MM-DD"))
                },
                viewRender: function(e) {
                    var t = $("#calendar").fullCalendar("getDate"),
                        a = t.month();
                    $("#calendar .fc-toolbar").attr("data-calendar-month", a), $(".block-header-calendar > h2 > span").html(e.title)
                },
                eventClick: function(e, t) {
                    $(".edit_event_id").val(e.id), $(".edit_event_title").val(e.title), $("#modal_edit_event #event_start_date").val(moment(e.start).format("YYYY-MM-DD")), $("#modal_edit_event #event_end_date").val(moment(e.end).format("YYYY-MM-DD")), $("#modal_edit_event #event_start_time").val(moment(e.start).format("HH:mm a")), $("#modal_edit_event #event_end_time").val(moment(e.end).format("HH:mm a")), $("#modal_edit_event .edit_event_description").val(e.description), $("#modal_edit_event input[value=" + e.className + "]").prop("checked", !0), $("#modal_edit_event").modal("show"), e.allDay === !0 ? ($("#toggle-allDay").prop("checked", !0), $("#modal_edit_event #event_start_time,#modal_edit_event #event_end_time").val("").attr("disabled", !0)) : ($("#toggle-allDay").prop("checked", !1), $("#modal_edit_event #event_start_time,#modal_edit_event #event_end_time").attr("disabled", !1))
                }
            }), $(document).on("click", "#btn_add_event", function() {
                var e = $("#new_event_title").val(),
                    t = $("#add_event_start_date").val(),
                    a = $("#add_event_start_time").val(),
                    n = $("#add_event_end_date").val(),
                    o = $("#add_event_end_time").val(),
                    i = moment(t).add(a).toISOString(),
                    r = moment(n).add(o).toISOString(),
                    s = {
                        Stored: [],
                        Job: function() {
                            var e = Date.now().toString().substr(6);
                            return this.Check(e) ? this.Job() : (this.Stored.push(e), e)
                        },
                        Check: function(e) {
                            for (var t = 0; t < this.Stored.length; t++)
                                if (this.Stored[t] == e) return !0;
                            return !1
                        }
                    };
                "" != e ? ($("#calendar").fullCalendar("renderEvent", {
                    id: s.Job(),
                    title: e,
                    start: i,
                    end: r,
                    allDay: !0,
                    className: $(".event-tag input:checked").val(),
                    description: ""
                }, !0), $(".form-event")[0].reset(), $("#modal_new_event").modal("hide"), $("#new_event_title").closest(".form-group").removeClass("has-error")) : ($("#new_event_title").closest(".form-group").addClass("has-error"), $("#new_event_title").focus())
            }), $("body").on("click", "[data-calendar]", function() {
                var e = $(this).data("calendar"),
                    a = $(".edit_event_id").val(),
                    n = $(".edit_event_title").val(),
                    o = $(".edit_event_description").val(),
                    i = $(".event-tag-edit input:checked").val(),
                    r = $("#calendar").fullCalendar("clientEvents", a);
                "update" === e && ("" != n ? (r[0].title = n, r[0].description = o, r[0].className = i, $("#calendar").fullCalendar("updateEvent", r[0]), $("#modal_edit_event").modal("hide")) : ($(".edit_event_title").closest(".form-group").addClass("has-error"), $(".edit_event_title").focus())), "delete" === e && ($("#modal_edit_event").modal("hide"), setTimeout(function() {
                    swal({
                        title: "Are you sure?",
                        text: "You won't be able to revert this!",
                        type: "warning",
                        showCancelButton: !0,
                        confirmButtonColor: "#3085d6",
                        cancelButtonColor: "#d33",
                        confirmButtonText: "Yes, delete it!"
                    }).then(function() {
                        t.fullCalendar("removeEvents", a), swal("Deleted!", "Your event has been removed.", "success")
                    })
                }, 250))
            }), $('[data-trigger="popover-guests"]').popover({
                trigger: "manual",
                html: !0,
                title: function() {
                    return $("#popover-guests").find(".head").html()
                },
                content: function() {
                    return $("#popover-guests").find(".content").html()
                },
                container: "body",
                placement: "right"
            }).on("click", function(e) {
                e.stopPropagation(), $(this).popover("show"), $("#popover-guests").parents(".popover").addClass("guest_popover_open")
            }), $("body").on("click", function(e) {
                $("#popover-guests").length && $(".popover:visible").length && $(".popover").hide()
            }), $(".fc-today-button").addClass("btn btn-white-text btn-flat").html('<i class="zmdi zmdi-calendar-alt"></i><span>Today</span>'), $(".fc-prev-button,.fc-next-button").addClass("btn btn-white-text btn-flat btn-fab btn-fab-sm"), $(".fc-month-button").addClass("btn btn-white-text btn-flat").html('<i class="zmdi zmdi-view-comfy"></i><span>Month</span>'), $(".fc-agendaWeek-button").addClass("btn btn-white-text btn-flat").html('<i class="zmdi zmdi-view-week"></i><span>Week</span>'), $(".fc-agendaDay-button").addClass("btn btn-white-text btn-flat").html('<i class="zmdi zmdi-view-day"></i><span>Day</span>')
        },
        i = function() {
            var e, t, a = function() {
                    o.setStartRange(e), i.setStartRange(e), i.setMinDate(e)
                },
                n = function() {
                    o.setEndRange(t), i.setEndRange(t)
                },
                o = new Pikaday({
                    field: document.getElementById("event_start_date"),
                    minDate: new Date,
                    maxDate: new Date(2020, 12, 31),
                    onSelect: function() {
                        e = this.getDate(), a()
                    }
                }),
                i = new Pikaday({
                    field: document.getElementById("event_end_date"),
                    minDate: new Date,
                    maxDate: new Date(2020, 12, 31),
                    onSelect: function() {
                        t = this.getDate(), n()
                    }
                }),
                r = o.getDate(),
                s = i.getDate();
            r && (e = r, a()), s && (t = s, n()), $("#event_start_time").timepicker({
                scrollDefault: "now"
            }), $("#event_end_time").timepicker({
                minTime: "2:00pm",
                maxTime: "11:30pm",
                showDuration: !0
            }), $("input#toggle-allDay:checkbox").on("change", function() {
                $(this).is(":checked") ? $("#event_start_time,#event_end_time").val("").attr("disabled", !0) : $("#event_start_time,#event_end_time").attr("disabled", !1)
            })
        },
        r = function() {
            var e, t, a = function() {
                    o.setStartRange(e), i.setStartRange(e), i.setMinDate(e)
                },
                n = function() {
                    o.setEndRange(t), i.setEndRange(t)
                },
                o = new Pikaday({
                    field: document.getElementById("add_event_start_date"),
                    minDate: new Date,
                    maxDate: new Date(2020, 12, 31),
                    onSelect: function() {
                        e = this.getDate(), a()
                    }
                }),
                i = new Pikaday({
                    field: document.getElementById("add_event_end_date"),
                    minDate: new Date,
                    maxDate: new Date(2020, 12, 31),
                    onSelect: function() {
                        t = this.getDate(), n()
                    }
                }),
                r = o.getDate(),
                s = i.getDate();
            r && (e = r, a()), s && (t = s, n()), $("#add_event_start_time").timepicker({
                scrollDefault: "now"
            }), $("#add_event_end_time").timepicker({
                minTime: "2:00pm",
                maxTime: "11:30pm",
                showDuration: !0
            }), $("input#allDay:checkbox").on("change", function() {
                $(this).is(":checked") ? $("#add_event_start_time,#add_event_end_time").val("").attr("disabled", !0) : $("#add_event_start_time,#add_event_end_time").attr("disabled", !1)
            })
        },
        s = function() {
            $("#modal_edit_event").on("show.bs.modal", function(e) {
                $(".popover").on("show.bs.popover", function() {
                    var e = $("#modal_edit_event #filter_cal_input"),
                        t = $("#modal_edit_event .filter_cal_list li");
                    (0, n.filterList)(e, t)
                })
            })
        };
    t.cal = o, t.updateInputCal = i, t.addInputCal = r, t.filterCalMembers = s
}, function(e, t, a) {
    Object.defineProperty(t, "__esModule", {
        value: !0
    }), t.cardReveal = t.cardSearch = t.cardToggleHighlighter = t.cardTask = t.cardStacks = t.cardOffCanvas = t.cardCollapse = t.cardRefresh = void 0;
    var n = a(3),
        o = {
            cardClass: ".card",
            cardHeadingClass: ".card .card-heading",
            cardBodyClass: ".card .card-body",
            cardFooterClass: ".card .card-footer",
            cardRevealClass: ".card .card-reveal",
            cardRefresh: '.card a[data-toggle="refresh"]',
            cardClose: '.card a[data-toggle="close"]',
            cardCollapse: '.card a[data-toggle="collapse"]',
            cardToggleHighlighter: 'a[data-toggle-view="code"]',
            cardSearchOpen: 'a[data-card-search="open"]',
            cardSearchClose: '[data-card-search="close"]',
            cardRevealToggle: '[data-toggle="reveal"]'
        },
        i = function() {
            $(document).on("click", o.cardRefresh, function(e) {
                e.preventDefault();
                var t = $(this).closest(o.cardClass);
                t.append('<div class="load"></div>');
                var a = t.find(".load");
                a.load("assets/partials/_preloader.html", function() {
                    setTimeout(function() {
                        a.fadeOut("1500", function() {
                            a.remove()
                        })
                    }, 1700)
                })
            })
        },
        r = function() {
            $(document).on("click", o.cardCollapse, function(e) {
                e.preventDefault(), $(this).children("i").toggleClass("zmdi-chevron-up zmdi-chevron-down");
                var t = $(this).closest(".card").children(".card-body");
                t.slideToggle()
            })
        },
        s = function() {
            $(document).on("click", o.cardToggleHighlighter, function(e) {
                e.preventDefault();
                var t = $(this).closest(".card").find(".syntax-highlighter");
                t.slideToggle()
            })
        },
        l = function() {
            $("[data-card-off-canvas]").on("click", function() {
                var e = $(this),
                    t = e.data("card-off-canvas");
                return e.toggleClass(t), e.closest(".card").find(".card-body").toggleClass(t), e.parents(".card").find(".card-off-canvas").toggleClass(t), $(".card-off-canvas.is-active").length > 0 ? e.closest(".card.drawer ").prepend('<div class="card-backdrop"></div>') : e.parents(".drawer").find(".card-backdrop").remove(), !1
            }), $("#content_type.drawer").on("click", ".card-backdrop", function() {
                $(".card-backdrop").length > 0 && $("[data-card-off-canvas]").trigger("click")
            }), $("[data-off-canvas-mobile]").on("click", function() {
                var e = $(this),
                    t = e.data("off-canvas-mobile");
                return e.toggleClass(t), e.closest(".card").find(".card-body").toggleClass(t), e.parents(".card").find(".card-off-canvas").toggleClass(t), $(".card-off-canvas.is-active").length > 0 ? e.closest(".card.card-contacts ").prepend('<div class="card-backdrop"></div>') : e.parents(".drawer").find(".card-backdrop").remove(), !1
            })
        },
        c = function() {
            $(".card-stack-wrapper > li").on("click", function(e) {
                e.preventDefault();
                var t = $(this).parents(".card-stack-wrapper");
                $(this).appendTo(t), t.is("#chartistBarsDashboard") ? setTimeout(function() {
                    (0, n.chartistBarsDashboard)()
                }, 200) : t.is("#chartistLineDashboard") ? setTimeout(function() {
                    (0, n.chartistLineDashboard)()
                }, 200) : t.is("#chartistBiPolarChartDashboard") ? setTimeout(function() {
                    (0, n.chartistBiPolarChartDashboard)()
                }, 200) : t.is("#chartistPathAnimationDashboard") && setTimeout(function() {
                    (0, n.chartistPathAnimationDashboard)()
                }, 200)
            })
        },
        d = function() {
            if ($('[data-toggle="input"]').on("click", function() {
                    $(this).toggleClass("open");
                    var e = $(this).parents(".card-task").find("form");
                    e.toggleClass("open"), e.find("input").focus()
                }), $(".checklist input[type=checkbox]").length > 0) {
                var e = $(".checklist input[type=checkbox]");
                e.each(function(e) {
                    $(this).attr("id", "task_" + e)
                }), e.change(function() {
                    this.checked ? $(this).closest("label").css({
                        "text-decoration": "line-through"
                    }) : $(this).closest("label").css({
                        "text-decoration": "none"
                    })
                })
            }
        },
        p = function() {
            $(document).on("click", o.cardSearchOpen, function(e) {
                e.preventDefault();
                var t = $(this),
                    a = t.closest(o.cardClass),
                    n = a.find(".card-search"),
                    i = t.data("cardSearch");
                n.addClass(i), n.find(".form-control").focus()
            }), $(document).on("click", o.cardSearchClose, function(e) {
                e.preventDefault();
                var t = $(this),
                    a = t.closest(".card"),
                    n = a.find(".card-search");
                t.data("cardSearch");
                if (n.removeClass("open"), n.find(".form-control").val(""), a.hasClass("card-data-tables")) {
                    var o = $(".dataTable").DataTable();
                    o.search($(this).val()).draw()
                }
            })
        },
        u = function() {
            $(document).on("click", o.cardRevealToggle, function(e) {
                e.preventDefault();
                var t = $(this).closest(".card.reveal");
                t.toggleClass("open"), $(".email-form input,.email-form textarea").val(""), t.hasClass("open") && setTimeout(function() {
                    $("#email-to").focus()
                }, 100)
            })
        };
    t.cardRefresh = i, t.cardCollapse = r, t.cardOffCanvas = l, t.cardStacks = c, t.cardTask = d, t.cardToggleHighlighter = s, t.cardSearch = p, t.cardReveal = u
}, function(e, t) {
    Object.defineProperty(t, "__esModule", {
        value: !0
    });
    var a = function() {
            if ($("#c3_gauge").length) {
                var e = c3.generate({
                    bindto: "#c3_gauge",
                    data: {
                        columns: [
                            ["data", 91.4]
                        ],
                        type: "gauge",
                        onclick: function(e, t) {},
                        onmouseover: function(e, t) {},
                        onmouseout: function(e, t) {}
                    },
                    color: {
                        pattern: [MaterialLab.APP_COLORS.success, MaterialLab.APP_COLORS.info, MaterialLab.APP_COLORS.warning, MaterialLab.APP_COLORS.primary],
                        threshold: {
                            values: [30, 60, 90, 100]
                        }
                    },
                    size: {
                        height: 100,
                        width:150
                    }
                });
                setTimeout(function() {
                    e.load({
                        columns: [
                            ["data", 10]
                        ]
                    })
                }, 1e3), setTimeout(function() {
                    e.load({
                        columns: [
                            ["data", 50]
                        ]
                    })
                }, 2e3), setTimeout(function() {
                    e.load({
                        columns: [
                            ["data", 70]
                        ]
                    })
                }, 3e3), setTimeout(function() {
                    e.load({
                        columns: [
                            ["data", 0]
                        ]
                    })
                }, 4e3), setTimeout(function() {
                    e.load({
                        columns: [
                            ["data", 100]
                        ]
                    })
                }, 5e3)
            }
            if ($("#c5_gauge").length) {
                var gauge = c3.generate({
                    bindto: "#c5_gauge",
                    data: {
                        columns: [
                            ["data", 91.4]
                        ],
                        type: "gauge",
                        onclick: function(gauge, t) {},
                        onmouseover: function(gauge, t) {},
                        onmouseout: function(gauge, t) {}
                    },
                    color: {
                        pattern: [MaterialLab.APP_COLORS.success,
                         MaterialLab.APP_COLORS.info, 
                         MaterialLab.APP_COLORS.warning,
                          MaterialLab.APP_COLORS.primary
                          ],
                        threshold: {
                            values: [30, 60, 90, 100]
                        }
                    },
                    size: {
                        height: 100,
                        width:150
                    }
                });
                setTimeout(function() {
                    gauge.load({
                        columns: [
                            ["data", 10]
                        ]
                    })
                }, 1e3), setTimeout(function() {
                   gauge.load({
                        columns: [
                            ["data", 50]
                        ]
                    })
                }, 2e3), setTimeout(function() {
                    gauge.load({
                        columns: [
                            ["data", 70]
                        ]
                    })
                }, 3e3), setTimeout(function() {
                    gauge.load({
                        columns: [
                            ["data", 0]
                        ]
                    })
                }, 4e3), setTimeout(function() {
                    gauge.load({
                        columns: [
                            ["data", 100]
                        ]
                    })
                }, 5e3)
            }
        },

       

        n = function() {
            if ($("#c3_pie").length) {
                var e = c3.generate({
                    bindto: "#c3_pie",
                    data: {
                        columns: [
                            ["data1", 30],
                            ["data2", 120]
                        ],
                        type: "pie",
                        onclick: function(e, t) {},
                        onmouseover: function(e, t) {},
                        onmouseout: function(e, t) {}
                    },
                    color: {
                        pattern: [MaterialLab.APP_COLORS.info, MaterialLab.APP_COLORS.success, MaterialLab.APP_COLORS.primary, MaterialLab.APP_COLORS.mw_purple, MaterialLab.APP_COLORS.success]
                    }
                });
                setTimeout(function() {
                    e.load({
                        columns: [
                            ["setosa", .2, .2, .2, .2, .2, .4, .3, .2, .2, .1, .2, .2, .1, .1, .2, .4, .4, .3, .3, .3, .2, .4, .2, .5, .2, .2, .4, .2, .2, .2, .2, .4, .1, .2, .2, .2, .2, .1, .2, .2, .3, .3, .2, .6, .4, .3, .2, .2, .2, .2],
                            ["versicolor", 1.4, 1.5, 1.5, 1.3, 1.5, 1.3, 1.6, 1, 1.3, 1.4, 1, 1.5, 1, 1.4, 1.3, 1.4, 1.5, 1, 1.5, 1.1, 1.8, 1.3, 1.5, 1.2, 1.3, 1.4, 1.4, 1.7, 1.5, 1, 1.1, 1, 1.2, 1.6, 1.5, 1.6, 1.5, 1.3, 1.3, 1.3, 1.2, 1.4, 1.2, 1, 1.3, 1.2, 1.3, 1.3, 1.1, 1.3],
                            ["virginica", 2.5, 1.9, 2.1, 1.8, 2.2, 2.1, 1.7, 1.8, 1.8, 2.5, 2, 1.9, 2.1, 2, 2.4, 2.3, 1.8, 2.2, 2.3, 1.5, 2.3, 2, 2, 1.8, 2.1, 1.8, 1.8, 1.8, 2.1, 1.6, 1.9, 2, 2.2, 1.5, 1.4, 2.3, 2.4, 1.8, 1.8, 2.1, 2.4, 2.3, 1.9, 2.3, 2.5, 2.3, 1.9, 2, 2.3, 1.8]
                        ]
                    })
                }, 1500), setTimeout(function() {
                    e.unload({
                        ids: "data1"
                    }), e.unload({
                        ids: "data2"
                    })
                }, 2500)
            }
        },
        o = function() {
            if ($("#c3_scatter").length) {
                var e = c3.generate({
                    bindto: "#c3_scatter",
                    data: {
                        xs: {
                            setosa: "setosa_x",
                            versicolor: "versicolor_x"
                        },
                        columns: [
                            ["setosa_x", 3.5, 3, 3.2, 3.1, 3.6, 3.9, 3.4, 3.4, 2.9, 3.1, 3.7, 3.4, 3, 3, 4, 4.4, 3.9, 3.5, 3.8, 3.8, 3.4, 3.7, 3.6, 3.3, 3.4, 3, 3.4, 3.5, 3.4, 3.2, 3.1, 3.4, 4.1, 4.2, 3.1, 3.2, 3.5, 3.6, 3, 3.4, 3.5, 2.3, 3.2, 3.5, 3.8, 3, 3.8, 3.2, 3.7, 3.3],
                            ["versicolor_x", 3.2, 3.2, 3.1, 2.3, 2.8, 2.8, 3.3, 2.4, 2.9, 2.7, 2, 3, 2.2, 2.9, 2.9, 3.1, 3, 2.7, 2.2, 2.5, 3.2, 2.8, 2.5, 2.8, 2.9, 3, 2.8, 3, 2.9, 2.6, 2.4, 2.4, 2.7, 2.7, 3, 3.4, 3.1, 2.3, 3, 2.5, 2.6, 3, 2.6, 2.3, 2.7, 3, 2.9, 2.9, 2.5, 2.8],
                            ["setosa", .2, .2, .2, .2, .2, .4, .3, .2, .2, .1, .2, .2, .1, .1, .2, .4, .4, .3, .3, .3, .2, .4, .2, .5, .2, .2, .4, .2, .2, .2, .2, .4, .1, .2, .2, .2, .2, .1, .2, .2, .3, .3, .2, .6, .4, .3, .2, .2, .2, .2],
                            ["versicolor", 1.4, 1.5, 1.5, 1.3, 1.5, 1.3, 1.6, 1, 1.3, 1.4, 1, 1.5, 1, 1.4, 1.3, 1.4, 1.5, 1, 1.5, 1.1, 1.8, 1.3, 1.5, 1.2, 1.3, 1.4, 1.4, 1.7, 1.5, 1, 1.1, 1, 1.2, 1.6, 1.5, 1.6, 1.5, 1.3, 1.3, 1.3, 1.2, 1.4, 1.2, 1, 1.3, 1.2, 1.3, 1.3, 1.1, 1.3]
                        ],
                        type: "scatter"
                    },
                    axis: {
                        x: {
                            label: "Sepal.Width",
                            tick: {
                                fit: !1
                            }
                        },
                        y: {
                            label: "Petal.Width"
                        }
                    },
                    color: {
                        pattern: [MaterialLab.APP_COLORS.success, MaterialLab.APP_COLORS.primary]
                    }
                });
                setTimeout(function() {
                    e.load({
                        xs: {
                            virginica: "virginica_x"
                        },
                        columns: [
                            ["virginica_x", 3.3, 2.7, 3, 2.9, 3, 3, 2.5, 2.9, 2.5, 3.6, 3.2, 2.7, 3, 2.5, 2.8, 3.2, 3, 3.8, 2.6, 2.2, 3.2, 2.8, 2.8, 2.7, 3.3, 3.2, 2.8, 3, 2.8, 3, 2.8, 3.8, 2.8, 2.8, 2.6, 3, 3.4, 3.1, 3, 3.1, 3.1, 3.1, 2.7, 3.2, 3.3, 3, 2.5, 3, 3.4, 3],
                            ["virginica", 2.5, 1.9, 2.1, 1.8, 2.2, 2.1, 1.7, 1.8, 1.8, 2.5, 2, 1.9, 2.1, 2, 2.4, 2.3, 1.8, 2.2, 2.3, 1.5, 2.3, 2, 2, 1.8, 2.1, 1.8, 1.8, 1.8, 2.1, 1.6, 1.9, 2, 2.2, 1.5, 1.4, 2.3, 2.4, 1.8, 1.8, 2.1, 2.4, 2.3, 1.9, 2.3, 2.5, 2.3, 1.9, 2, 2.3, 1.8]
                        ]
                    })
                }, 1e3), setTimeout(function() {
                    e.unload({
                        ids: "setosa"
                    })
                }, 2e3), setTimeout(function() {
                    e.load({
                        columns: [
                            ["virginica", .2, .2, .2, .2, .2, .4, .3, .2, .2, .1, .2, .2, .1, .1, .2, .4, .4, .3, .3, .3, .2, .4, .2, .5, .2, .2, .4, .2, .2, .2, .2, .4, .1, .2, .2, .2, .2, .1, .2, .2, .3, .3, .2, .6, .4, .3, .2, .2, .2, .2]
                        ]
                    })
                }, 3e3)
            }
        },
        i = function() {
            if ($("#c3_donut").length) {
                var e = c3.generate({
                    bindto: "#c3_donut",
                    data: {
                        columns: [
                            ["data1", 30],
                            ["data2", 120]
                        ],
                        type: "donut",
                        onclick: function(e, t) {},
                        onmouseover: function(e, t) {},
                        onmouseout: function(e, t) {}
                    },
                    donut: {
                        title: "Iris Petal Width"
                    },
                    color: {
                        pattern: [MaterialLab.APP_COLORS.info, MaterialLab.APP_COLORS.success, MaterialLab.APP_COLORS.primary, MaterialLab.APP_COLORS.mw_purple, MaterialLab.APP_COLORS.success]
                    }
                });
                setTimeout(function() {
                    e.load({
                        columns: [
                            ["setosa", .2, .2, .2, .2, .2, .4, .3, .2, .2, .1, .2, .2, .1, .1, .2, .4, .4, .3, .3, .3, .2, .4, .2, .5, .2, .2, .4, .2, .2, .2, .2, .4, .1, .2, .2, .2, .2, .1, .2, .2, .3, .3, .2, .6, .4, .3, .2, .2, .2, .2],
                            ["versicolor", 1.4, 1.5, 1.5, 1.3, 1.5, 1.3, 1.6, 1, 1.3, 1.4, 1, 1.5, 1, 1.4, 1.3, 1.4, 1.5, 1, 1.5, 1.1, 1.8, 1.3, 1.5, 1.2, 1.3, 1.4, 1.4, 1.7, 1.5, 1, 1.1, 1, 1.2, 1.6, 1.5, 1.6, 1.5, 1.3, 1.3, 1.3, 1.2, 1.4, 1.2, 1, 1.3, 1.2, 1.3, 1.3, 1.1, 1.3],
                            ["virginica", 2.5, 1.9, 2.1, 1.8, 2.2, 2.1, 1.7, 1.8, 1.8, 2.5, 2, 1.9, 2.1, 2, 2.4, 2.3, 1.8, 2.2, 2.3, 1.5, 2.3, 2, 2, 1.8, 2.1, 1.8, 1.8, 1.8, 2.1, 1.6, 1.9, 2, 2.2, 1.5, 1.4, 2.3, 2.4, 1.8, 1.8, 2.1, 2.4, 2.3, 1.9, 2.3, 2.5, 2.3, 1.9, 2, 2.3, 1.8]
                        ]
                    })
                }, 1500), setTimeout(function() {
                    e.unload({
                        ids: "data1"
                    }), e.unload({
                        ids: "data2"
                    })
                }, 2500)
            }
        },
        r = function() {
            if ($("#c3_area-chart").length) {
                c3.generate({
                    bindto: "#c3_area-chart",
                    data: {
                        columns: [
                            ["data1", 300, 350, 300, 0, 0, 0],
                            ["data2", 130, 100, 140, 200, 150, 50]
                        ],
                        types: {
                            data1: "area",
                            data2: "area-spline"
                        }
                    },
                    color: {
                        pattern: [MaterialLab.APP_COLORS.info, MaterialLab.APP_COLORS.primary]
                    }
                })
            }
        },
        s = function() {
            if ($("#c3_spline-chart").length) {
                c3.generate({
                    bindto: "#c3_spline-chart",
                    data: {
                        columns: [
                            ["data1", 30, 200, 100, 400, 150, 250],
                            ["data2", 130, 100, 140, 200, 150, 50]
                        ],
                        type: "spline"
                    },
                    color: {
                        pattern: [MaterialLab.APP_COLORS.info, MaterialLab.APP_COLORS.primary]
                    }
                })
            }
        },
        l = function() {
            if ($("#c3_combination-chart").length) {
                c3.generate({
                    bindto: "#c3_combination-chart",
                    data: {
                        columns: [
                            ["data1", 30, 20, 50, 40, 60, 50],
                            ["data2", 200, 130, 90, 240, 130, 220],
                            ["data3", 300, 200, 160, 400, 250, 250],
                            ["data4", 200, 130, 90, 240, 130, 220],
                            ["data5", 130, 120, 150, 140, 160, 150],
                            ["data6", 90, 70, 20, 50, 60, 120]
                        ],
                        type: "bar",
                        types: {
                            data3: "spline",
                            data4: "line",
                            data6: "area"
                        },
                        groups: [
                            ["data1", "data2"]
                        ]
                    },
                    axis: {
                        x: {
                            type: "categorized"
                        }
                    },
                    color: {
                        pattern: [MaterialLab.APP_COLORS.info, MaterialLab.APP_COLORS.success, MaterialLab.APP_COLORS.primary, MaterialLab.APP_COLORS.warning, MaterialLab.APP_COLORS.mw_purple, MaterialLab.APP_COLORS.mw_peach]
                    }
                })
            }
        },
        c = function() {
            if ($("#c3_zoom").length) {
                c3.generate({
                    bindto: "#c3_zoom",
                    data: {
                        columns: [
                            ["sample", 30, 200, 100, 400, 150, 250, 150, 200, 170, 240, 350, 150, 100, 400, 150, 250, 150, 200, 170, 240, 100, 150, 250, 150, 200, 170, 240, 30, 200, 100, 400, 150, 250, 150, 200, 170, 240, 350, 150, 100, 400, 350, 220, 250, 300, 270, 140, 150, 90, 150, 50, 120, 70, 40]
                        ]
                    },
                    zoom: {
                        enabled: !0
                    },
                    color: {
                        pattern: [MaterialLab.APP_COLORS.info, MaterialLab.APP_COLORS.success, MaterialLab.APP_COLORS.primary, MaterialLab.APP_COLORS.warning, MaterialLab.APP_COLORS.mw_purple, MaterialLab.APP_COLORS.mw_peach]
                    }
                })
            }
        },
        d = function() {
            if ($("#c3_stacked-bars-chart").length) {
                var e = c3.generate({
                    bindto: "#c3_stacked-bars-chart",
                    data: {
                        columns: [
                            ["data1", -30, 200, 200, 400, -150, 250],
                            ["data2", 130, 100, -100, 200, -150, 50],
                            ["data3", -230, 200, 200, -300, 250, 250]
                        ],
                        type: "bar",
                        groups: [
                            ["data1", "data2"]
                        ]
                    },
                    grid: {
                        y: {
                            lines: [{
                                value: 0
                            }]
                        }
                    },
                    color: {
                        pattern: [MaterialLab.APP_COLORS.info, MaterialLab.APP_COLORS.success, MaterialLab.APP_COLORS.primary, MaterialLab.APP_COLORS.mw_purple, MaterialLab.APP_COLORS.mw_peach]
                    }
                });
                setTimeout(function() {
                    e.groups([
                        ["data1", "data2", "data3"]
                    ])
                }, 1e3), setTimeout(function() {
                    e.load({
                        columns: [
                            ["data4", 100, -50, 150, 200, -300, -100]
                        ]
                    })
                }, 1500), setTimeout(function() {
                    e.groups([
                        ["data1", "data2", "data3", "data4"]
                    ])
                }, 2e3)
            }
        };
    t.c3_gauges = a, t.c3_pie = n, t.c3_donut = i, t.c3_areaChart = r, t.c3_combination = l, t.c3_zoom = c, t.c3_stacked_bars_chart = d, t.c3_areaSpline = s, t.c3_scatter = o
}, function(e, t) {
    Object.defineProperty(t, "__esModule", {
        value: !0
    });
    var a = function() {
            if ($("#chartist_simplePie").length) {
                var e = {
                        series: [5, 3, 4]
                    },
                    t = function(e, t) {
                        return e + t
                    };
                new Chartist.Pie("#chartist_simplePie", e, {
                    labelInterpolationFnc: function(a) {
                        return Math.round(a / e.series.reduce(t) * 100) + "%"
                    }
                })
            }
        },
        n = function() {
            if ($("#chartist_pieCustomLabels").length) {
                var e = {
                        labels: ["Bananas", "Apples", "Grapes"],
                        series: [20, 15, 40]
                    },
                    t = {
                        labelInterpolationFnc: function(e) {
                            return e[0]
                        }
                    },
                    a = [
                        ["screen and (min-width: 640px)", {
                            chartPadding: 30,
                            labelOffset: 100,
                            labelDirection: "explode",
                            labelInterpolationFnc: function(e) {
                                return e
                            }
                        }],
                        ["screen and (min-width: 1024px)", {
                            labelOffset: 80,
                            chartPadding: 20
                        }]
                    ];
                new Chartist.Pie("#chartist_pieCustomLabels", e, t, a)
            }
        },
        o = function() {
            if ($("#chartist_animatingDonut").length) {
                var e = new Chartist.Pie("#chartist_animatingDonut", {
                    series: [10, 20, 50, 20, 5, 50, 15],
                    labels: [1, 2, 3, 4, 5, 6, 7]
                }, {
                    donut: !0,
                    showLabel: !1
                });
                e.on("draw", function(e) {
                    if ("slice" === e.type) {
                        var t = e.element._node.getTotalLength();
                        e.element.attr({
                            "stroke-dasharray": t + "px " + t + "px"
                        });
                        var a = {
                            "stroke-dashoffset": {
                                id: "anim" + e.index,
                                dur: 1e3,
                                from: -t + "px",
                                to: "0px",
                                easing: Chartist.Svg.Easing.easeOutQuint,
                                fill: "freeze"
                            }
                        };
                        0 !== e.index && (a["stroke-dashoffset"].begin = "anim" + (e.index - 1) + ".end"), e.element.attr({
                            "stroke-dashoffset": -t + "px"
                        }), e.element.animate(a, !1)
                    }
                }), e.on("created", function() {
                    window.__anim21278907124 && (clearTimeout(window.__anim21278907124), window.__anim21278907124 = null), window.__anim21278907124 = setTimeout(e.update.bind(e), 1e4)
                })
            }
        },
        i = function() {
            if ($("#chartist_biPolarBar").length) {
                var e = {
                        labels: ["W1", "W2", "W3", "W4", "W5", "W6", "W7", "W8", "W9", "W10"],
                        series: [
                            [1, 2, 4, 8, 6, -2, -1, -4, -6, -2]
                        ]
                    },
                    t = {
                        high: 10,
                        low: -10,
                        axisX: {
                            labelInterpolationFnc: function(e, t) {
                                return t % 2 === 0 ? e : null
                            }
                        }
                    };
                new Chartist.Bar("#chartist_biPolarBar", e, t)
            }
        },
        r = function() {
            if ($("#chartist_peakCircles").length) {
                var e = new Chartist.Bar("#chartist_peakCircles", {
                    labels: ["W1", "W2", "W3", "W4", "W5", "W6", "W7", "W8", "W9", "W10"],
                    series: [
                        [1, 2, 4, 8, 6, -2, -1, -4, -6, -2]
                    ]
                }, {
                    high: 10,
                    low: -10,
                    axisX: {
                        labelInterpolationFnc: function(e, t) {
                            return t % 2 === 0 ? e : null
                        }
                    }
                });
                e.on("draw", function(e) {
                    "bar" === e.type && e.group.append(new Chartist.Svg("circle", {
                        cx: e.x2,
                        cy: e.y2,
                        r: 2 * Math.abs(Chartist.getMultiValue(e.value)) + 5
                    }, "ct-slice-pie"))
                })
            }
        },
        s = function() {
            $("#chartist_stackedBar").length && new Chartist.Bar("#chartist_stackedBar", {
                labels: ["Q1", "Q2", "Q3", "Q4"],
                series: [
                    [8e5, 12e5, 14e5, 13e5],
                    [2e5, 4e5, 5e5, 3e5],
                    [1e5, 2e5, 4e5, 6e5]
                ]
            }, {
                stackBars: !0,
                axisY: {
                    labelInterpolationFnc: function(e) {
                        return e / 1e3 + "k"
                    }
                }
            }).on("draw", function(e) {
                "bar" === e.type && e.element.attr({
                    style: "stroke-width: 30px"
                })
            })
        },
        l = function() {
            $("#chartist_horizontalBar").length && new Chartist.Bar("#chartist_horizontalBar", {
                labels: ["Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday", "Sunday"],
                series: [
                    [5, 4, 3, 7, 5, 10, 3],
                    [3, 2, 9, 5, 4, 6, 4]
                ]
            }, {
                seriesBarDistance: 10,
                reverseData: !0,
                horizontalBars: !0,
                axisY: {
                    offset: 70
                }
            })
        },
        c = function() {
            $("#chartist_lineChart").length && new Chartist.Line("#chartist_lineChart", {
                labels: ["Monday", "Tuesday", "Wednesday", "Thursday", "Friday"],
                series: [
                    [12, 9, 7, 8, 5],
                    [2, 1, 3.5, 7, 3],
                    [1, 3, 4, 5, 6]
                ]
            }, {
                fullWidth: !0,
                chartPadding: {
                    right: 40
                }
            })
        },
        d = function() {
            if ($("#chartist_holesInData").length) {
                new Chartist.Line("#chartist_holesInData", {
                    labels: [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16],
                    series: [
                        [5, 5, 10, 8, 7, 5, 4, null, null, null, 10, 10, 7, 8, 6, 9],
                        [10, 15, null, 12, null, 10, 12, 15, null, null, 12, null, 14, null, null, null],
                        [null, null, null, null, 3, 4, 1, 3, 4, 6, 7, 9, 5, null, null, null],
                        [{
                            x: 3,
                            y: 3
                        }, {
                            x: 4,
                            y: 3
                        }, {
                            x: 5,
                            y: void 0
                        }, {
                            x: 6,
                            y: 4
                        }, {
                            x: 7,
                            y: null
                        }, {
                            x: 8,
                            y: 4
                        }, {
                            x: 9,
                            y: 4
                        }]
                    ]
                }, {
                    fullWidth: !0,
                    chartPadding: {
                        right: 10
                    },
                    low: 0
                })
            }
        },
        p = function() {
            if ($("#chartist_filledHolesInData").length) {
                new Chartist.Line("#chartist_filledHolesInData", {
                    labels: [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16],
                    series: [
                        [5, 5, 10, 8, 7, 5, 4, null, null, null, 10, 10, 7, 8, 6, 9],
                        [10, 15, null, 12, null, 10, 12, 15, null, null, 12, null, 14, null, null, null],
                        [null, null, null, null, 3, 4, 1, 3, 4, 6, 7, 9, 5, null, null, null],
                        [{
                            x: 3,
                            y: 3
                        }, {
                            x: 4,
                            y: 3
                        }, {
                            x: 5,
                            y: void 0
                        }, {
                            x: 6,
                            y: 4
                        }, {
                            x: 7,
                            y: null
                        }, {
                            x: 8,
                            y: 4
                        }, {
                            x: 9,
                            y: 4
                        }]
                    ]
                }, {
                    fullWidth: !0,
                    chartPadding: {
                        right: 10
                    },
                    lineSmooth: Chartist.Interpolation.cardinal({
                        fillHoles: !0
                    }),
                    low: 0
                })
            }
        },
        u = function() {
            $("#chartist_onlyWholeNumbers").length && new Chartist.Line("#chartist_onlyWholeNumbers", {
                labels: [1, 2, 3, 4, 5, 6, 7, 8],
                series: [
                    [1, 2, 3, 1, -2, 0, 1, 0],
                    [-2, -1, -2, -1, -3, -1, -2, -1],
                    [0, 0, 0, 1, 2, 3, 2, 1],
                    [3, 2, 1, .5, 1, 0, -1, -3]
                ]
            }, {
                high: 3,
                low: -3,
                fullWidth: !0,
                axisY: {
                    onlyInteger: !0,
                    offset: 20
                }
            })
        },
        h = function() {
            if ($("#chartist_lineScatter").length) {
                var e = function(e) {
                        return Array.apply(null, new Array(e))
                    },
                    t = e(52).map(Math.random).reduce(function(e, t, a) {
                        return e.labels.push(a + 1), e.series.forEach(function(e) {
                            e.push(100 * Math.random())
                        }), e
                    }, {
                        labels: [],
                        series: e(4).map(function() {
                            return new Array
                        })
                    }),
                    a = {
                        showLine: !1,
                        axisX: {
                            labelInterpolationFnc: function(e, t) {
                                return t % 13 === 0 ? "W" + e : null
                            }
                        }
                    },
                    n = [
                        ["screen and (min-width: 640px)", {
                            axisX: {
                                labelInterpolationFnc: function(e, t) {
                                    return t % 4 === 0 ? "W" + e : null
                                }
                            }
                        }]
                    ];
                new Chartist.Line("#chartist_lineScatter", t, a, n)
            }
        },
        m = function() {
            $("#chartist_lineChartWithArea").length && new Chartist.Line("#chartist_lineChartWithArea", {
                labels: [1, 2, 3, 4, 5, 6, 7, 8],
                series: [
                    [5, 9, 7, 8, 5, 3, 5, 4]
                ]
            }, {
                low: 0,
                showArea: !0
            })
        },
        f = function() {
            $("#chartist_biPolar").length && new Chartist.Line("#chartist_biPolar", {
                labels: [1, 2, 3, 4, 5, 6, 7, 8],
                series: [
                    [1, 2, 3, 1, -2, 0, 1, 0],
                    [-2, -1, -2, -1, -2.5, -1, -2, -1],
                    [0, 0, 0, 1, 2, 2.5, 2, 1],
                    [2.5, 2, 1, .5, 1, .5, -1, -2.5]
                ]
            }, {
                high: 3,
                low: -3,
                showArea: !0,
                showLine: !1,
                showPoint: !1,
                fullWidth: !0,
                axisX: {
                    showLabel: !1,
                    showGrid: !1
                }
            }), $("#chartist_megaMenu").length && new Chartist.Line("#chartist_megaMenu", {
                labels: [1, 2, 3, 4, 5, 6, 7, 8],
                series: [
                    [1, 2, 3, 1, -2, 0, 1, 0],
                    [-2, -1, -2, -1, -2.5, -1, -2, -1],
                    [0, 0, 0, 1, 2, 2.5, 2, 1],
                    [2.5, 2, 1, .5, 1, .5, -1, -2.5]
                ]
            }, {
                high: 3,
                low: -3,
                showArea: !0,
                showLine: !1,
                showPoint: !1,
                fullWidth: !0,
                axisX: {
                    showLabel: !1,
                    showGrid: !1
                }
            })
        };
    t.chartist_simplePie = a, t.chartist_pieCustomLabels = n, t.chartist_animatingDonut = o, t.chartist_biPolarBar = i, t.chartist_peakCircles = r, t.chartist_stackedBar = s, t.chartist_horizontalBar = l, t.chartist_lineChart = c, t.chartist_holesInData = d, t.chartist_filledHolesInData = p, t.chartist_onlyWholeNumbers = u, t.chartist_lineScatter = h, t.chartist_lineChartWithArea = m, t.chartist_biPolar = f
}, function(e, t) {
    Object.defineProperty(t, "__esModule", {
        value: !0
    });
    var a = function() {
            if ($("#chartjs_lineChart").length) {
                var e = document.getElementById("chartjs_lineChart").getContext("2d");
                new Chart(e, {
                    type: "line",
                    data: {
                        labels: ["M", "T", "W", "T", "F", "S", "S"],
                        datasets: [{
                            label: "apples",
                            data: [12, 19, 3, 17, 6, 3, 7],
                            backgroundColor: "rgba(88, 103, 195,0.4)",
                            borderColor: "rgba(88, 103, 195,0.7)",
                            borderWidth: .6
                        }, {
                            label: "oranges",
                            data: [2, 29, 5, 5, 2, 3, 10],
                            backgroundColor: "rgba(28, 134, 191,0.4)",
                            borderColor: "rgba(28, 134, 191,0.7)",
                            borderWidth: .6
                        }]
                    }
                })
            }
        },
        n = function() {
            if ($("#chartjs_barChart").length) {
                var e = document.getElementById("chartjs_barChart").getContext("2d");
                new Chart(e, {
                    type: "bar",
                    data: {
                        labels: ["M", "T", "W", "R", "F", "S", "S"],
                        datasets: [{
                            label: "apples",
                            data: [12, 19, 3, 17, 28, 24, 7],
                            backgroundColor: "rgba(88, 103, 195,0.4)"
                        }, {
                            label: "oranges",
                            data: [30, 29, 5, 5, 20, 3, 10],
                            backgroundColor: "rgba(28, 134, 191,0.4)"
                        }]
                    }
                })
            }
        },
        o = function() {
            if ($("#chartjs_radarChart").length) {
                var e = document.getElementById("chartjs_radarChart");
                new Chart(e, {
                    type: "radar",
                    data: {
                        labels: ["M", "T", "W", "T", "F", "S", "S"],
                        datasets: [{
                            label: "apples",
                            backgroundColor: "rgba(88, 103, 195,0.4)",
                            borderColor: "rgba(88, 103, 195,0.7)",
                            data: [12, 19, 3, 17, 28, 24, 7]
                        }, {
                            label: "oranges",
                            backgroundColor: "rgba(28, 134, 191,0.4)",
                            borderColor: "rgba(28, 134, 191,0.7)",
                            data: [30, 29, 5, 5, 20, 3, 10]
                        }]
                    }
                })
            }
        },
        i = function() {
            if ($("#chartjs_polarChart").length) {
                var e = document.getElementById("chartjs_polarChart").getContext("2d");
                new Chart(e, {
                    type: "polarArea",
                    data: {
                        labels: ["M", "T", "W", "T", "F", "S", "S"],
                        datasets: [{
                            backgroundColor: ["#5867C3", "#1C86BF", "#28BEBD", "#FEB38D", "#EE6E73", "#EC407A", "#F8C200"],
                            data: [12, 19, 3, 17, 28, 24, 7]
                        }]
                    }
                })
            }
        },
        r = function() {
            if ($("#chartjs_pieChart").length) {
                var e = document.getElementById("chartjs_pieChart").getContext("2d");
                new Chart(e, {
                    type: "pie",
                    data: {
                        labels: ["M", "T", "W", "T", "F", "S", "S"],
                        datasets: [{
                            backgroundColor: ["#5867C3", "#1C86BF", "#28BEBD", "#FEB38D", "#EE6E73", "#EC407A", "#F8C200"],
                            data: [12, 19, 3, 17, 28, 24, 7]
                        }]
                    }
                })
            }
        },
        s = function() {
            if ($("#chartjs_doughnutChart").length) {
                var e = document.getElementById("chartjs_doughnutChart").getContext("2d");
                new Chart(e, {
                    type: "doughnut",
                    data: {
                        labels: ["M", "T", "W", "T", "F", "S", "S"],
                        datasets: [{
                            backgroundColor: ["#5867C3", "#1C86BF", "#28BEBD", "#FEB38D", "#EE6E73", "#EC407A", "#F8C200"],
                            data: [12, 19, 3, 17, 28, 24, 7]
                        }]
                    }
                })
            }
        };
    t.chartjs_lineChart = a, t.chartjs_barChart = n, t.chartjs_radarChart = o, t.chartjs_polarChart = i, t.chartjs_pieChart = r, t.chartjs_doughnutChart = s
}, function(e, t) {
    Object.defineProperty(t, "__esModule", {
        value: !0
    });
    t.morrisjs_demo = function() {
        if ($("#morris_area_chart").length) {
            var e = [{
                    y: "2016",
                    a: 35,
                    b: 90
                }, {
                    y: "2017",
                    a: 45,
                    b: 75
                }, {
                    y: "2018",
                    a: 55,
                    b: 50
                }, {
                    y: "2019",
                    a: 65,
                    b: 60
                }, {
                    y: "2020",
                    a: 75,
                    b: 65
                }, {
                    y: "2021",
                    a: 90,
                    b: 70
                }, {
                    y: "2022",
                    a: 95,
                    b: 75
                }, {
                    y: "2023",
                    a: 105,
                    b: 75
                }, {
                    y: "2024",
                    a: 115,
                    b: 85
                }, {
                    y: "2025",
                    a: 125,
                    b: 85
                }, {
                    y: "2026",
                    a: 145,
                    b: 95
                }],
                t = {
                    data: e,
                    xkey: "y",
                    ykeys: ["a", "b"],
                    labels: ["Total Income", "Total Outcome"],
                    fillOpacity: .6,
                    hideHover: "auto",
                    behaveLikeLine: !0,
                    resize: !0,
                    pointFillColors: ["#ffffff"],
                    pointStrokeColors: ["black"],
                    lineColors: [MaterialLab.APP_COLORS.mw_purple, MaterialLab.APP_COLORS.success],
                    barColors: [MaterialLab.APP_COLORS.mw_purple, MaterialLab.APP_COLORS.success]
                };
            t.element = "morris_area_chart", Morris.Area(t), t.element = "morris_line_chart", Morris.Line(t), t.element = "morris_bar_chart", Morris.Bar(t), t.element = "morris_stacked", t.stacked = !0, Morris.Bar(t), Morris.Donut({
                element: "morris_pie_chart",
                data: [{
                    label: "Study",
                    value: 30
                }, {
                    label: "Sleep",
                    value: 15
                }, {
                    label: "Work",
                    value: 45
                }, {
                    label: "Eat",
                    value: 10
                }],
                colors: [MaterialLab.APP_COLORS.success, MaterialLab.APP_COLORS.mw_grayBlue, MaterialLab.APP_COLORS.mw_purple, MaterialLab.APP_COLORS.mw_gray]
            })
        }
    }
}, function(e, t) {
    Object.defineProperty(t, "__esModule", {
        value: !0
    });
    t.chatContactList = function() {
        $('[data-contacts="show"]').on("click", function(e) {
            e.stopPropagation(), $("#chat_contact_wrapper").toggleClass("hide show")
        }), $(document).on("click touchstart", '[data-contacts="hide"]', function(e) {
            e.stopPropagation(), $("#chat_contact_wrapper").toggleClass("show hide")
        })
    }
}, function(e, t) {
    Object.defineProperty(t, "__esModule", {
        value: !0
    });
    var a = function() {
            var e = $("#contact-wrapper .panel-group .panel"),
                t = 0;
            e.each(function() {
                $(this).attr("id", "contact_item_" + t), $(this).find("#contact_checkbox_").attr("id", "contact_checkbox_" + t), t++
            }), $("#contact-wrapper .panel .action").on("click", function(e) {
                e.stopPropagation()
            }), n()
        },
        n = function() {
            $(".zmdi.star").parent().on("click", function(e) {
                e.stopPropagation(), $(this).children("i").hasClass("text-yellow") ? ($(this).children("i").removeClass("zmdi-star text-yellow"), $(this).children().addClass("zmdi-star-outline")) : ($(this).children("i").removeClass("zmdi-star-outline"), $(this).children("i").addClass("zmdi-star text-yellow"))
            })
        },
        o = function() {
            $("#contactEditUser").on("show.bs.modal", function(e) {
                var t = $(e.relatedTarget).data("name"),
                    a = $(e.relatedTarget).data("phone"),
                    n = $(e.relatedTarget).data("email"),
                    o = $(e.relatedTarget).data("img"),
                    i = $(e.relatedTarget).data("star");
                $(e.currentTarget).find(".user-avatar-wrapper .name").text(t), $(e.currentTarget).find(".user-avatar-wrapper .avatar").attr("src", o), $(e.currentTarget).find("#edit_name").val(t), $(e.currentTarget).find("#edit_phone").val(a), $(e.currentTarget).find("#edit_email").val(n), i === !0 ? ($(e.currentTarget).find(".user-avatar-wrapper .star").removeClass("zmdi-star-outline"), $(e.currentTarget).find(".user-avatar-wrapper .star").addClass("zmdi-star text-yellow")) : ($(e.currentTarget).find(".user-avatar-wrapper .star").addClass("zmdi-star-outline"), $(e.currentTarget).find(".user-avatar-wrapper .star").removeClass("zmdi-star text-yellow")), $("#edit_name").keydown(function() {
                    var e = $(this).val();
                    $("#contactEditUser .name").text(e)
                })
            })
        },
        i = function() {
            $("#newContactModal").on("show.bs.modal", function(e) {
                $("#add_name").keydown(function() {
                    var e = $(this).val();
                    $("#newContactModal .name").text(e)
                }), $("#add_name").on("blur", function() {
                    var e = $(this).val(),
                        t = e.split(" ").map(function(e) {
                            return e[0]
                        }).join("");
                    $("#newContactModal .no-avatar").text(t.toUpperCase())
                })
            })
        },
        r = function() {
            $("#contact-wrapper [id*=contact_checkbox_]").change(function(e) {
                e.stopPropagation();
                var t = $(this);
                $("#contact-wrapper input[id*=contact_checkbox_][type=checkbox]:checked").length ? $("#header_action_bar").addClass("open") : $("#header_action_bar").removeClass("open"), t.is(":checked") ? t.closest(".panel-heading").addClass("highlight") : t.closest(".panel-heading").removeClass("highlight");
                var a = $("#contact-wrapper input[id*=contact_checkbox_][type=checkbox]:checked").length;
                $("#selected_items span").text(a + " selected")
            }), $('#header_action_bar [data-mail-actionbar="closed"]').on("click", function(e) {
                e.stopPropagation(), $("#header_action_bar").removeClass("open"), $("#contact-wrapper input[id*=contact_checkbox_][type=checkbox]:checked").each(function() {
                    $(this).prop("checked", !1), $(this).closest(".panel-heading").removeClass("highlight")
                })
            })
        };
    t.contactSetup = a, t.contactEditUser = o, t.contactNewUser = i, t.contactSelected = r
}, function(e, t) {
    Object.defineProperty(t, "__esModule", {
        value: !0
    });
    var a = function() {
            $(".card-data-tables table tbody .checkbox-cell .checkbox input[type=checkbox]").each(function(e) {
                $(this).attr("id", "CheckboxId_" + (e + 1))
            }), $(".product-table-wrapper table").DataTable({
                aaSorting: [
                    [2, "asc"]
                ]
            });
            var e = $(".dataTable").DataTable();
            $(".filter-input").keyup(function() {
                e.search($(this).val()).draw()
            });
            var t = $(".card.card-data-tables select.form-control.input-sm"),
                a = t.detach();
            $("#dataTablesLength").append(a), $(".card.card-data-tables .card-actions select.form-control.input-sm").dropdown({
                optionClass: "withripple"
            }), $("#dataTablesLength .dropdownjs .fakeinput").hide(), $("#dataTablesLength .dropdownjs ul").addClass("dropdown-menu dropdown-menu-right")
        },
        n = function() {
            if (0 == $(" .checkbox-cell input[id*=CheckboxId_][type=checkbox]:checked").length) $("#deleteItems").hide();
            else {
                $("#deleteItems").show();
                var e = $(".checkbox-cell input[id*=CheckboxId_][type=checkbox]:checked").length;
                if (1 === e) var t = "item";
                else if (e > 0) var t = "items";
                $("#deleteItems span").text(e + " " + t + " selected")
            }
            $("#checkAll").on("click", function() {
                $(".checkbox-cell input:checkbox").not(this).prop("checked", this.checked)
            }), $(".checkbox-cell [id*=CheckboxId_]").change(function() {
                var e = $(this);
                $(".checkbox-cell input[id*=CheckboxId_][type=checkbox]:checked").length == $(".checkbox-cell input[id*=CheckboxId_][type=checkbox]").length ? $("#checkAll").prop("checked", !0) : $("#checkAll").prop("checked", !1), e.is(":checked") ? e.closest("tr").addClass("highlight") : e.closest("tr").removeClass("highlight"), 0 == $(".checkbox-cell input[id*=CheckboxId_][type=checkbox]:checked").length ? $("#deleteItems").hide() : $("#deleteItems").show();
                var t = $(".checkbox-cell input[id*=CheckboxId_]:visible[type=checkbox]:checked").length;
                if (1 === t) var a = "item";
                else if (t > 0) var a = "items";
                $("#deleteItems span").text(t + " " + a + " selected")
            }), $("#checkAll").change(function() {
                var e = $(this);
                e.is(":checked") ? $(".card-data-tables table tbody .checkbox-cell .checkbox input[type=checkbox]").each(function() {
                    $(this).closest("tr").addClass("highlight")
                }) : $(".card-data-tables table tbody .checkbox-cell .checkbox input[type=checkbox]").each(function() {
                    $(this).closest("tr").removeClass("highlight")
                }), 0 == $(".checkbox-cell input[id*=CheckboxId_][type=checkbox]:checked").length ? $("#deleteItems").hide() : $("#deleteItems").show();
                var t = $(".checkbox-cell input[id*=CheckboxId_]:visible[type=checkbox]:checked").length;
                if (1 === t) var a = "item";
                else if (t > 0) var a = "items";
                $("#deleteItems span").text(t + " " + a + " selected")
            })
        },
        o = function() {
            $("#confirmDelete").on("click", function(e) {
                e.stopPropagation(), swal({
                    title: "Are you sure?",
                    text: "You will not be able to recover this data.",
                    type: "warning",
                    showCancelButton: !0,
                    confirmButtonColor: "#DD6B55",
                    confirmButtonText: "Delete",
                    cancelButtonText: "Cancel",
                    closeOnConfirm: !1,
                    closeOnCancel: !1
                }, function(e) {
                    e ? (swal("Deleted!", "Your data has been deleted.", "success"), setTimeout(function() {
                        $(".checkbox-cell input[id*=CheckboxId_][type=checkbox]:checked").each(function() {
                            $(this).prop("checked", !1), $(this).closest("tr").fadeOut(), $("#deleteItems").fadeOut()
                        }), $("#checkAll").is(":checked") && $("#checkAll").prop("checked", !1), $("#deleteItems span").text("")
                    }, 600), setTimeout(function() {
                        $(".card-data-tables table tbody tr").attr("style", "").removeClass("highlight")
                    }, 2e3)) : swal("Cancelled", "Your action has been cancelled.", "error")
                })
            })
        },
        i = function() {
            $(".card-data-tables table").on("page.dt", function() {
                $(".card-data-tables table tbody .checkbox-cell .checkbox input[type=checkbox]").each(function(e) {
                    $(this).prop("checked", !1), $(this).closest("tr").removeClass("highlight")
                }), setTimeout(function() {
                    n(), o()
                }, 600)
            })
        };
    t.mwDataTables = a, t.checkAll = n, t.deleteItem = o, t.pagination = i
}, function(e, t) {
    Object.defineProperty(t, "__esModule", {
        value: !0
    });
    var a = function() {
            moment.updateLocale("en", {
                ordinal: function(e, t) {
                    var a = e % 10,
                        n = 1 === ~~(e % 100 / 10) ? "th" : 1 === a ? "st" : 2 === a ? "nd" : 3 === a ? "rd" : "th";
                    return e + "<sup>" + n + "</sup>"
                }
            }), $(".curr-dd").html(moment().format("dddd") + ","), $(".curr-mmmm-dd").html(moment().format("MMMM Do"))
        },
        n = function() {
            moment.updateLocale("en", {
                calendar: {
                    lastDay: "D MMMM",
                    sameDay: "h:mmA",
                    nextDay: "dddd",
                    lastWeek: "dddd",
                    nextWeek: "dddd",
                    sameElse: "dddd"
                }
            }), $(".forcast").length > 0 && ($(".forcast-one").html(moment().add(1, "days").calendar()), $(".forcast-two").html(moment().add(2, "days").calendar()), $(".forcast-three").html(moment().add(3, "days").calendar()))
        },
        o = function() {
            var e = moment().format("MM/DD/YYYY"),
                t = moment().format("YYYY");
            $(".today").text(e), $(".year").text(t)
        },
        i = function() {
            var e = (new Date).toISOString().substring(0, 10);
            $("#timeline-date").val(e);
            new Pikaday({
                field: document.getElementById("timeline-date"),
                firstDay: 1,
                minDate: new Date,
                maxDate: new Date(2020, 12, 31),
                yearRange: [2e3, 2020]
            })
        };
    t.currentDateTimeSidebar = a, t.nextThreeDays = n, t.todaysDate = o, t.timlineInput = i
}, function(e, t) {
    Object.defineProperty(t, "__esModule", {
        value: !0
    });
    var a = function() {
            var e = $(".icon"),
                t = "bus";
            e.on("click", function(e) {
                e.preventDefault();
                var a = t;
                t = $(this).data("name");
                var n = $(this).data("code"),
                    o = $(this).parent().parent().find(".page-header").html();
                $("#icon-sizes i").removeClass("zmdi-" + a).addClass("zmdi-" + t), $("#iconModal .source").html('&lt;i class="zmdi zmdi-' + t + '"&gt;&lt;/i&gt;'), $("#icon-code .zmdi").html("&#x" + n), $("#icon-code .unicode").html("Unicode: " + n), $("#icon-code .category").html("Category: " + o), $("#iconModalLabel").html("zmdi-" + t)
            })
        },
        n = function() {
            $(".animation-demo .btn").on("click", function() {
                var e = $(this).text(),
                    t = $(this).closest(".card").find("img");
                $(this).closest("img").addClass(e), t.removeAttr("class"), t.addClass("img-circle animated " + e), setTimeout(function() {
                    t.removeClass(e)
                }, 1500)
            })
        },
        o = function() {
            $("#card-carousel").slick({
                dots: !0,
                infinite: !0,
                speed: 300,
                slidesToShow: 1,
                adaptiveHeight: !0
            })
        },
        i = function() {
            if ($("#morris_card_demo").length) {
                var e = [{
                        y: "2014",
                        a: 50,
                        b: 90
                    }, {
                        y: "2015",
                        a: 65,
                        b: 75
                    }, {
                        y: "2016",
                        a: 50,
                        b: 50
                    }, {
                        y: "2017",
                        a: 75,
                        b: 60
                    }, {
                        y: "2018",
                        a: 80,
                        b: 65
                    }, {
                        y: "2019",
                        a: 90,
                        b: 70
                    }, {
                        y: "2020",
                        a: 100,
                        b: 75
                    }, {
                        y: "2021",
                        a: 115,
                        b: 75
                    }, {
                        y: "2022",
                        a: 120,
                        b: 85
                    }, {
                        y: "2023",
                        a: 145,
                        b: 85
                    }, {
                        y: "2024",
                        a: 160,
                        b: 95
                    }],
                    t = {
                        data: e,
                        xkey: "y",
                        ykeys: ["a", "b"],
                        labels: ["Total Income", "Total Outcome"],
                        fillOpacity: .6,
                        hideHover: "auto",
                        behaveLikeLine: !0,
                        resize: !0,
                        pointFillColors: ["#ffffff"],
                        pointStrokeColors: ["black"],
                        barColors: ["#db5c60", "#f4b0b2"]
                    };
                t.element = "morris_card_demo", t.stacked = !0, Morris.Bar(t)
            }
        },
        r = function() {
            $("[data-load-css]").on("click", function(e) {
                var t = $(this);
                t.is("a") && e.preventDefault();
                var a, n = t.data("loadCss");
                n ? (a = s(n), a || $.error("Error creating stylesheet link element.")) : $.error("No stylesheet location defined.")
            })
        },
        s = function(e) {
            var t = "autoloaded-stylesheet",
                a = $("#" + t).attr("id", t + "-old");
            return $("head").append($("<link/>").attr({
                id: t,
                rel: "stylesheet",
                href: e
            })), a.length && a.remove(), $("#" + t)
        },
        l = function() {
            $("input[name=layoutMode]").click(function() {
                $("body").hasClass("boxed-layout") && $("body").removeClass("boxed-layout");
                var e = $(this).val();
                $("body").addClass(e)
            })
        };
    t.iconModal = a, t.css3AnimationDemos = n, t.cardCarousel = o, t.cardDemoMorrisChart = i, t.loadThemes = r, t.swapLayoutMode = l
}, function(e, t, a) {
    Object.defineProperty(t, "__esModule", {
        value: !0
    }), t.customerTable = t.orderTable = t.editProductImg = t.addProductTags = t.triggerDropzoneEcom = t.triggerSummerNoteEcom = t.newUsers = t.todaysSales = t.conversionStats = t.salesStats = void 0;
    var n = (a(2), function() {
            if ($("#conversionStats").length) {
                var e = document.getElementById("conversionStats").getContext("2d"),
                    t = {
                        labels: ["Added to Cart", "Reached Checkout", "Purchased", "Cancelled"],
                        datasets: [{
                            label: "Conversion Funnel",
                            backgroundColor: ["rgba(255, 206, 86, 0.2)", "rgba(54, 162, 235, 0.2)", "rgba(75, 192, 192, 0.2)", "rgba(255, 99, 132, 0.2)"],
                            borderColor: ["rgba(255, 206, 86, 1)", "rgba(54, 162, 235, 1)", "rgba(75, 192, 192, 1)", "rgba(255,99,132,1)"],
                            borderWidth: 1,
                            data: [38, 32, 17, 3]
                        }]
                    };
                new Chart(e, {
                    type: "bar",
                    data: t,
                    responsive: !0
                })
            }
        }),
        o = function() {
            if ($("#salesStats").length) {
                var e = document.getElementById("salesStats").getContext("2d"),
                    t = function() {
                        return Math.round(100 * Math.random())
                    },
                    a = {
                        labels: ["Monday", "Tuesday", "Wednesday", "Friday", "Saturday", "Sunday"],
                        datasets: [{
                            label: "Credit Card",
                            backgroundColor: "rgba(75,192,192,0.4)",
                            borderColor: "rgba(75,192,192,1)",
                            pointBorderColor: "rgba(75,192,192,1)",
                            pointBackgroundColor: "#fff",
                            pointHoverBackgroundColor: "rgba(75,192,192,1)",
                            pointHoverBorderColor: "rgba(220,220,220,1)",
                            bezierCurve: !0,
                            data: [t(), t(), t(), t(), t(), t(), t()]
                        }, {
                            label: "PayPal",
                            backgroundColor: "rgba(66, 165, 245,0.4)",
                            borderColor: "rgba(66, 165, 245,1)",
                            pointBorderColor: "rgba(66, 165, 245,1)",
                            pointBackgroundColor: "#fff",
                            pointHoverBackgroundColor: "rgba(66, 165, 245,1)",
                            pointHoverBorderColor: "rgba(220,220,220,1)",
                            bezierCurve: !0,
                            data: [t(), t(), t(), t(), t(), t(), t()]
                        }]
                    };
                new Chart(e, {
                    type: "line",
                    data: a,
                    responsive: !0
                })
            }
        },
        i = function() {
            if ($("#totalSales").length) {
                var e = new ProgressBar.Circle("#totalSales", {
                    color: "#fb4869",
                    strokeWidth: 3,
                    trailWidth: 3,
                    duration: 1500,
                    text: {
                        value: "0%"
                    },
                    step: function(e, t) {
                        t.setText((100 * t.value()).toFixed(0) + "%")
                    }
                });
                e.animate(.8)
            }
        },
        r = function() {
            if ($("#newSignups").length) {
                var e = new ProgressBar.Circle("#newSignups", {
                    color: "#42a5f5",
                    strokeWidth: 3,
                    trailWidth: 3,
                    duration: 1500,
                    text: {
                        value: "0%"
                    },
                    step: function(e, t) {
                        t.setText((100 * t.value()).toFixed(0) + "%")
                    }
                });
                e.animate(.64)
            }
        },
        s = function() {
            $("#add_product_desc, #edit_product_desc").summernote()
        },
        l = function() {
            Dropzone && Dropzone.length || (Dropzone.autoDiscover = !1, $("#product_add_images_form").dropzone({
                url: "/assets/file/upload",
                addRemoveLinks: !0
            }))
        },
        c = function() {
            $(".chips-placeholder").material_chip({
                placeholder: "+Tag",
                secondaryPlaceholder: "+Tag",
                data: [{
                    tag: "Geometric"
                }, {
                    tag: "Nature"
                }]
            })
        },
        d = function() {
            $(".edit_product_img").slick({
                dots: !0,
                infinite: !0,
                speed: 500,
                cssEase: "linear"
            })
        },
        p = function() {
            $(".order-table-wrapper table").DataTable({
                aaSorting: [
                    [2, "asc"]
                ]
            })
        },
        u = function() {
            $(".customer-table-wrapper table").DataTable({
                aaSorting: [
                    [2, "asc"]
                ]
            })
        };
    t.salesStats = o, t.conversionStats = n, t.todaysSales = i, t.newUsers = r, t.triggerSummerNoteEcom = s, t.triggerDropzoneEcom = l, t.addProductTags = c, t.editProductImg = d, t.orderTable = p, t.customerTable = u
}, function(e, t) {
    Object.defineProperty(t, "__esModule", {
        value: !0
    });
    t.loadGmaps = function() {
        if ($("#storeLocations").length > 0) {
            var e, t, a = function() {
                    var a = {
                            zoom: 10,
                            center: new google.maps.LatLng(47.604981, -122.334249),
                            styles: [{
                                featureType: "landscape.natural",
                                elementType: "geometry.fill",
                                stylers: [{
                                    visibility: "on"
                                }, {
                                    color: "#e0efef"
                                }]
                            }, {
                                featureType: "poi",
                                elementType: "geometry.fill",
                                stylers: [{
                                    visibility: "on"
                                }, {
                                    hue: "#1900ff"
                                }, {
                                    color: "#c0e8e8"
                                }]
                            }, {
                                featureType: "road",
                                elementType: "geometry",
                                stylers: [{
                                    lightness: 100
                                }, {
                                    visibility: "simplified"
                                }]
                            }, {
                                featureType: "road",
                                elementType: "labels",
                                stylers: [{
                                    visibility: "off"
                                }]
                            }, {
                                featureType: "transit.line",
                                elementType: "geometry",
                                stylers: [{
                                    visibility: "on"
                                }, {
                                    lightness: 700
                                }]
                            }, {
                                featureType: "water",
                                elementType: "all",
                                stylers: [{
                                    color: "#8bdadb"
                                }]
                            }]
                        },
                        r = document.getElementById("storeLocations");
                    t = new google.maps.Map(r, a), t.setMapTypeId(google.maps.MapTypeId.ROADMAP), e = new google.maps.InfoWindow;
                    var s, l, c, d = new google.maps.LatLngBounds;
                    for (l in i) {
                        s = i[l], c = new google.maps.LatLng(s.latlng[0], s.latlng[1]), d.extend(c);
                        var p = n(t, c, s.name);
                        o(p)
                    }
                    t.fitBounds(d)
                },
                n = function(t, a, n) {
                    var o = new google.maps.MarkerImage("assets/img/icons/misc/pin-icon.png", null, null, null, new google.maps.Size(64, 64)),
                        i = new google.maps.Marker({
                            position: a,
                            map: t,
                            title: n,
                            icon: o
                        });
                    return google.maps.event.addListener(i, "click", function() {
                        e.setContent("<strong>" + n + "</title>"), e.open(t, i)
                    }), i
                },
                o = function(e) {
                    var t = document.getElementById("marker_list"),
                        a = document.createElement("li"),
                        n = e.getTitle();
                    a.innerHTML = n, t.appendChild(a), $("#marker_list li").addClass("list-group-item"), google.maps.event.addDomListener(a, "click", function() {
                        google.maps.event.trigger(e, "click")
                    })
                },
                i = [{
                    latlng: [47.604981, -122.334249],
                    name: '\n        <span class="list-group-item-body"><img src="assets/img/locations/shop_1.jpg" alt="" class="img-rounded max-w-75 m-r-10"></span>\n        <div class="list-group-item-body">\n        <span class="list-group-item-heading">Big House Coffee</span>\n        <span class="list-group-item-text block">999 Third Avenue, Seattle, WA</span>\n        <span class="list-group-item-text block">Open until 9:00 PM</span>\n        </div>\n        '
                }, {
                    latlng: [47.605666, -122.335108],
                    name: '\n        <span class="list-group-item-body"><img src="assets/img/locations/shop_2.jpg" alt="" class="img-rounded max-w-75 m-r-10"></span>\n        <div class="list-group-item-body">\n        <span class="list-group-item-heading">Big House Coffee</span>\n        <span class="list-group-item-text block">1000 Second Avenue, Seattle, WA</span>\n        <span class="list-group-item-text block">Open until 9:00 PM</span>\n        </div>\n        '
                }, {
                    latlng: [47.60371, -122.335673],
                    name: '\n        <span class="list-group-item-body"><img src="assets/img/locations/shop_3.jpg" alt="" class="img-rounded max-w-75 m-r-10"></span>\n        <div class="list-group-item-body">\n        <span class="list-group-item-heading">Big House Coffee</span>\n        <span class="list-group-item-text block">823 First Ave, Seattle, WA </span>\n        <span class="list-group-item-text block">Open until 9:00 PM</span>\n        </div>\n        '
                }, {
                    latlng: [47.606006, -122.336716],
                    name: '\n        <span class="list-group-item-body"><img src="assets/img/locations/shop_4.jpg" alt="" class="img-rounded max-w-75 m-r-10"></span>\n        <div class="list-group-item-body">\n        <span class="list-group-item-heading">Big House Coffee</span>\n        <span class="list-group-item-text block">1191 2nd Avenue, Seattle, WA</span>\n        <span class="list-group-item-text block">Open until 9:00 PM</span>\n        </div>\n        '
                }, {
                    latlng: [47.607285, -122.334292],
                    name: '\n        <span class="list-group-item-body"><img src="assets/img/locations/shop_5.jpg" alt="" class="img-rounded max-w-75 m-r-10"></span>\n        <div class="list-group-item-body">\n        <span class="list-group-item-heading">Big House Coffee</span>\n        <span class="list-group-item-text block">1125 4th Avenue, Seattle, WA</span>\n        <span class="list-group-item-text block">Open until 9:00 PM</span>\n        </div>\n        '
                }, {
                    latlng: [47.607058, -122.336067],
                    name: '\n        <span class="list-group-item-body"><img src="assets/img/locations/shop_6.jpg" alt="" class="img-rounded max-w-75 m-r-10"></span>\n        <div class="list-group-item-body">\n        <span class="list-group-item-heading">Big House Coffee</span>\n        <span class="list-group-item-text block">1201 3rd Ave, Seattle, WA</span>\n        <span class="list-group-item-text block">Open until 9:00 PM</span>\n        </div>\n        '
                }, {
                    latlng: [47.607058, -122.336067],
                    name: '\n        <span class="list-group-item-body"><img src="assets/img/locations/shop_7.jpg" alt="" class="img-rounded max-w-75 m-r-10"></span>\n        <div class="list-group-item-body">\n        <span class="list-group-item-heading">Big House Coffee</span>\n        <span class="list-group-item-text block">621 2nd Ave, Seattle, WA</span>\n        <span class="list-group-item-text block">Open until 9:00 PM</span>\n        </div>\n        '
                }, {
                    latlng: [47.604505, -122.330604],
                    name: '\n        <span class="list-group-item-body"><img src="assets/img/locations/shop_8.jpg" alt="" class="img-rounded max-w-75 m-r-10"></span>\n        <div class="list-group-item-body">\n        <span class="list-group-item-heading">Big House Coffee</span>\n        <span class="list-group-item-text block">701 5th Avenue, Seattle, WA</span>\n        <span class="list-group-item-text block">Open until 9:00 PM</span>\n        </div>\n        '
                }, {
                    latlng: [47.605708, -122.330206],
                    name: '\n        <span class="list-group-item-body"><img src="assets/img/locations/shop_9.jpg" alt="" class="img-rounded max-w-75 m-r-10"></span>\n        <div class="list-group-item-body">\n        <span class="list-group-item-heading">Big House Coffee</span>\n        <span class="list-group-item-text block">800 5th Ave Seattle, WA</span>\n        <span class="list-group-item-text block">Open until 9:00 PM</span>\n        </div>\n        '
                }, {
                    latlng: [47.607636, -122.338118],
                    name: '\n        <span class="list-group-item-body"><img src="assets/img/locations/shop_10.jpg" alt="" class="img-rounded max-w-75 m-r-10"></span>\n        <div class="list-group-item-body">\n        <span class="list-group-item-heading">Big House Coffee</span>\n        <span class="list-group-item-text block">1301 2nd Ave, Seattle, WA</span>\n        <span class="list-group-item-text block">Open until 9:00 PM</span>\n        </div>\n        '
                }];
            google.maps.event.addDomListener(window, "load", a)
        }
    }
}, function(e, t) {
    Object.defineProperty(t, "__esModule", {
        value: !0
    });
    var a = function() {
        $(".dismissable").on("click", function() {
            var e = $(this).parents(".list-group-item"),
                t = e.next(".list-group-separator");
            e.addClass("animated slideOutRight"), t.addClass("animated slideOutRight"), setTimeout(function() {
                $(e).remove(), $(t).remove(), $.trim($("#dismissable-group").html()).length || $("#dismissable-group").append('<div class="alert alert-success" role="alert"> <strong > Well done! </strong> You successfully cleared all items from your list.</div>')
            }, 250)
        })
    };
    t.dismissListItem = a
}, function(e, t, a) {
    Object.defineProperty(t, "__esModule", {
        value: !0
    }), t.mailSelected = t.mailCompose = t.mailList = void 0;
    var n = a(1),
        o = function() {
            var e = $("#mail-wrapper .panel-group .panel"),
                t = 0;
            e.each(function() {
                $(this).find("#expansionHeading_").attr("id", "expansionHeading_" + t), $(this).find('div[aria-labelledby="expansionHeading_"]').attr("aria-labelledby", "expansionHeading_" + t), $(this).find('a[href="#expansion_"]').attr("href", "#expansion_" + t), $(this).find('a[aria-controls="expansion_"]').attr("aria-controls", "expansion_" + t), $(this).find("#expansion_").attr("id", "expansion_" + t), $(this).find("#expansionCheckbox_").attr("id", "expansionCheckbox_" + t), t++
            }), $("#mail-wrapper .action, #mail-wrapper .checkbox-material .ckeck").on("click", function(e) {
                e.stopPropagation()
            })
        },
        i = function() {
            var e = $("[data-compose]");
            e.on("click", function(e) {
                e.stopPropagation();
                var t = ($("body"), $(this)),
                    a = t.data("compose"),
                    o = $("#mail_compose_wrapper");
                "open" == a && (o.hasClass(a) ? (o.removeClass(a), $(".backdrop").fadeOut(250, function() {
                    $(this).remove()
                })) : o.addClass(a)), "close" == a && (o.removeAttr("class"), $("#mail_compose_wrapper .zmdi-window-maximize").length && ($('#mail_compose_wrapper [data-compose="min"] i').remove("zmdi-window-maximize"), $('#mail_compose_wrapper [data-compose="min"] i').addClass("zmdi-window-minimize")), $("#mail_compose_wrapper .mdi-arrow-compress").length && ($('#mail_compose_wrapper [data-compose="expand"] i').remove("mdi-arrow-compress"), $('#mail_compose_wrapper [data-compose="expand"] i').addClass("mdi-arrow-expand")), $("#mail_compose_wrapper input[type=text],#mail_compose_wrapper textarea").val(""), $(".backdrop").length && $(".backdrop").fadeOut(250, function() {
                    $(this).remove()
                })), "expand" == a && (o.hasClass(a) ? (o.removeClass(a), t.children("i").removeClass("mdi-arrow-compress"), t.children("i").addClass("mdi-arrow-expand"), $(".backdrop").length && $(".backdrop").fadeOut(250, function() {
                    $(this).remove()
                })) : (t.children("i").removeClass("mdi-arrow-expand"), t.children("i").addClass("mdi-arrow-compress"), o.addClass(a), (0, n.backDrops)(a, t, o))), "min" == a && (o.hasClass(a) ? (t.children("i").removeClass("zmdi-window-maximize"), t.children("i").addClass("zmdi-window-minimize"), o.removeClass(a), o.addClass("open")) : (o.removeAttr("class"), t.children("i").removeClass("zmdi-window-minimize"), t.children("i").addClass("zmdi-window-maximize"), o.addClass(a), $(".backdrop").length && $(".backdrop").fadeOut(250, function() {
                    $(this).remove()
                })))
            })
        },
        r = function() {
            $("#mail-wrapper [id*=expansionCheckbox_]").change(function(e) {
                e.stopPropagation();
                var t = $(this);
                $("#mail-wrapper input[id*=expansionCheckbox_][type=checkbox]:checked").length ? $("#header_action_bar").addClass("open") : $("#header_action_bar").removeClass("open"), t.is(":checked") ? t.closest(".panel-heading").addClass("highlight") : t.closest(".panel-heading").removeClass("highlight");
                var a = $("#mail-wrapper input[id*=expansionCheckbox_][type=checkbox]:checked").length;
                $("#selected_items span").text(a + " selected")
            }), $('#header_action_bar [data-mail-actionbar="closed"]').on("click", function(e) {
                e.stopPropagation(), $("#header_action_bar").removeClass("open"), $("#mail-wrapper input[id*=expansionCheckbox_][type=checkbox]:checked").each(function() {
                    $(this).prop("checked", !1), $(this).closest(".panel-heading").removeClass("highlight")
                })
            })
        };
    t.mailList = o, t.mailCompose = i, t.mailSelected = r
}, function(e, t) {
    Object.defineProperty(t, "__esModule", {
        value: !0
    });
    t.matchElementHeight = function(e) {
        var t = (window.innerWidth, $(e)),
            a = [];
        t.length > 1 && ($.each(t, function() {
            $(this).css("height", ""), a.push($(this).outerHeight())
        }), $(e).css("height", Math.max.apply(Math, a)))
    }
}, function(e, t) {
    Object.defineProperty(t, "__esModule", {
        value: !0
    });
    var a = {
            triggerInput: ".card-add-note",
            noteForm: "#note_form .card-body",
            noteTitle: "#noteTitle",
            noteHeading: ".card-heading",
            selected: '[data-note="selected"]'
        },
        n = function() {
            var e = $(".card-notes div[id*=note_id_]"),
                t = 0;
            e.each(function() {
                $(this).attr("id", "note_id_" + t), t++
            }), $(".card-note").each(function() {
                $(this).find(".card-body p").text().length <= 20 ? $(this).find(".card-body p").css({
                    "font-size": "48px",
                    "line-height": "1.2em"
                }) : $(this).find(".card-body p").text().length <= 45 ? $(this).find(".card-body p").css({
                    "font-size": "32px",
                    "line-height": "1.5em"
                }) : $(this).find(".card-body p").text().length <= 75 && $(this).find(".card-body p").css({
                    "font-size": "22px",
                    "line-height": "1.6em"
                })
            }), $("#masonry").masonry({
                itemSelector: ".masonry-item"
            })
        },
        o = function() {
            $(a.triggerInput).on("click", function(e) {
                $(this).addClass("open"), e.stopPropagation()
            }), $(a.noteForm).is(":visible") && $(a.triggerInput).on("click", function(e) {
                e.stopPropagation(), $("#note_form .card-actions li.dropdown").removeClass("open")
            }), $("#note_form .card-actions li.dropdown").on("click", function(e) {
                $(this).toggleClass("open"), e.stopPropagation()
            }), $("body").on("click", function(e) {
                $(a.triggerInput).removeClass("open"), $("#note_form .card-actions li.dropdown").removeClass("open"), $("#note-color-wrapper").attr("class", "")
            })
        },
        i = function() {
            $('a[data-note="selected"]').on("click", function(e) {
                e.stopPropagation(), $(this).closest(".card-note").toggleClass("selected"), r()
            }), $(".card-note .card-heading,.card-note .card-body,#header_action_bar").on("click", function(e) {
                e.stopPropagation()
            }), $("#header_action_bar .dropdown").on("click", function(e) {
                e.stopPropagation(), $(this).toggleClass("open")
            }), $("body").on("click", function(e) {
                $(".card-note").removeClass("selected"), r()
            })
        },
        r = function() {
            var e = $(".notes-app .card-notes .card-note.selected"),
                t = $(".notes-app .card-notes .card-note.selected").length;
            e.length > 0 ? ($(".notes-app #header_action_bar").addClass("open"), $(".notes-app #selected_items span").text(t + " selected")) : $(".notes-app #header_action_bar").removeClass("open")
        },
        s = function() {
            function e(e) {
                $("#notesTempImg").attr("src", e.target.result), $(".notesTempImgWrapper").fadeIn()
            }
            $(function() {
                $(":file").change(function() {
                    if (this.files && this.files[0]) {
                        var t = new FileReader;
                        t.onload = e, t.readAsDataURL(this.files[0])
                    }
                })
            })
        },
        l = function() {
            var e = $("#add_textarea_wrapper"),
                t = $("#add_list_wrapper");
            $('a[data-note="list"]').on("click", function(a) {
                e.is(":visible") ? (e.hide(), t.show()) : (e.show(), t.hide())
            }), $("#add_list_item_btn").on("click", function() {
                var e = $(this).closest("#add_list_wrapper").find("#add_list_item");
                e.length > 0 && ($("#add_list_wrapper #add_list").append('<li><div class="checkbox"><label><input type="checkbox" value="">' + e.val() + "</label></div></li>"), $.material.init())
            }), $("#note_form .swatches input").on("click", function() {
                var e = $(this).parents("#note-color-wrapper"),
                    t = $(this).val();
                e.attr("class", ""), e.addClass(t)
            })
        },
        c = function() {
            $(".card-note .swatches input").on("click", function() {
                var e = $(this).parents("div[id*=note_id_]"),
                    t = $(this).val();
                e.attr("class", ""), e.addClass(t)
            })
        };
    t.allNotes = n, t.notesAdd = o, t.noteSelected = i, t.noteImgUpload = s, t.noteAddList = l, t.updateNote = c
}, function(e, t) {
    Object.defineProperty(t, "__esModule", {
        value: !0
    });
    var a = function() {
        var e = ($(".panel-group.expansion"), $(".panel-group.expansion .panel")),
            t = $(".panel-group.expansion .panel .panel-title > a");
        $(".panel-group.expansion .panel-collapse");
        t.on("click", function() {
            e.removeClass("active"), $(this).hasClass("collapsed") ? $(this).parents(".panel").addClass("active") : $(this).parents(".panel").removeClass("active")
        })
    };
    t.expansionPanel = a
}, function(e, t) {
    Object.defineProperty(t, "__esModule", {
        value: !0
    });
    t.initPhotoSwipeFromDOM = function() {
        var e = [];
        $("#photo-gallery").find("figure").each(function() {
            var t = $(this).find("a"),
                a = {
                    src: t.attr("href"),
                    w: t.data("width"),
                    h: t.data("height"),
                    title: t.data("caption")
                };
            e.push(a)
        }), $("#photo-gallery figure a").on("click", function(t) {
            t.preventDefault();
            var a = $(".pswp")[0],
                n = {
                    index: $(this).parent("figure").index(),
                    bgOpacity: .85,
                    showHideOpacity: !0
                },
                o = new PhotoSwipe(a, PhotoSwipeUI_Default, e, n);
            o.init()
        })
    }
}, function(e, t) {
    Object.defineProperty(t, "__esModule", {
        value: !0
    });
    var a = function() {
        var e = $("[data-navsearch-open]"),
            t = $("[data-navsearch-close]"),
            a = $("#navbar_form"),
            n = $("#navbar_search"),
            o = $(document);
        e.on("click", function(e) {
            e.stopPropagation(), a.addClass("open"), n.focus()
        }), t.on("click", function(e) {
            e.stopPropagation(), a.removeClass("open"), n.val("")
        }), o.on("click", function(e) {
            e.stopPropagation(), e.target !== $("#navbar_search") && (a.removeClass("open"), n.val(""))
        }), n.on("click", function(e) {
            e.stopPropagation()
        })
    };
    t.navBarSearch = a
}, function(e, t) {
    Object.defineProperty(t, "__esModule", {
        value: !0
    });
    t.sidebarChatCompose = function() {
        $("[data-chat]").on("click", function(e) {
            var t = ($("body"), $(this)),
                a = t.data("chat"),
                n = $("#chat_compose_wrapper");
            "open" == a && (n.hasClass(a) ? n.removeClass(a) : n.addClass(a)), "close" == a && n.removeAttr("class")
        })
    }
}, function(e, t) {
    Object.defineProperty(t, "__esModule", {
        value: !0
    });
    var a = function(e) {
        function t(e) {
            $(e).click()
        }
        var a, n, o, i = $(".modal-stepper .stepper"),
            r = i.find(".prev-step"),
            s = i.find(".next-step"),
            l = i.find('[data-toggle="tab"]'),
            c = i.find('[data-toggle="tab"][title]'),
            d = $(".cancel-stepper"),
            p = $(".stepper li");
        c.tooltip(), l.on("show.bs.tab", function(e) {
            var t = $(e.target);
            if (t.parent().hasClass("active, disabled") || t.parent().prev().addClass("completed"), t.parent().hasClass("disabled")) return !1
        }), s.on("click", function() {
            a = i.find(".active"), a.next().removeClass("disabled"), o = a.next().find('a[data-toggle="tab"]'), t(o)
        }), r.on("click", function() {
            a = i.find(".active"), n = a.prev().find('a[data-toggle="tab"]'), t(n)
        }), d.on("click", function() {
            p.attr("class", ""), p.each(function(e, t) {
                0 === e ? $(this).addClass("active") : $(this).addClass("disabled")
            })
        })
    };
    t.simpleStepper = a
}, function(e, t, a) {
    Object.defineProperty(t, "__esModule", {
        value: !0
    }), t.dragDropTask = t.filterTaskMembers = t.editTask = t.deleteTask = t.addNewTaskList = t.addNewTask = t.loadTaskId = t.getTaskCardInfo = void 0;
    var n = a(4),
        o = a(5),
        i = function() {
            $(".card-task-item").on("click.taskInfo", function(e) {
                var t = $(this);
                $("#editTaskTitle,#editTaskNotes").editable("destroy"), $("#task-info-wrapper .card-active .filter_members_list li:not(.filter)").removeClass("active");
                var a = {
                    taskCardId: t.find("[data-task-id]").data("taskId"),
                    taskListTitle: t.parents(".card-lane-wrapper").find("[data-task-title]").data("taskTitle"),
                    taskCardColor: t.parents(".card-lane-wrapper").find("[data-task-color]").data("taskColor"),
                    taskCardTitle: t.find('[data-task="title"]').text(),
                    taskCardUsers: t.find('[data-task="users"] li.list-group-item').clone(),
                    taskCardNotes: t.find('[data-task="notes"]').text().trim(),
                    taskCardMetaData: t.find('[data-task="metadata"]')
                };
                console.log(a.taskListTitle), $("#task-info-wrapper .card-heading .card-number").text(""), $("#task-info-wrapper .card-body #editTaskTitle").text(""), $("#task-info-wrapper .card [data-task-color]").removeAttr("class"), $("#task-info-wrapper .card-body #editTaskNotes").text(""), $("#task-info-wrapper .editable-inline textarea").val(""), $("#task-info-wrapper .card-body .user-group > li.list-group-item").remove(), $("#task-info-wrapper [data-active-id]").data("activeId", a.taskCardId), $("#task-info-wrapper .card-heading .card-number").text("#" + a.taskCardId), $("#task-info-wrapper .card-heading #taskListTitle").text(a.taskListTitle), $("#task-info-wrapper .card [data-task-color]").addClass(a.taskCardColor), $("#task-info-wrapper .card-body #editTaskTitle").text(a.taskCardTitle), $("#task-info-wrapper .card-body #editTaskNotes").text(a.taskCardNotes), $("#task-info-wrapper .card-body .user-group").prepend(a.taskCardUsers), r(), $("#task-info-wrapper .card-active .user-group > li.list-group-item").each(function() {
                    var e = $(this),
                        t = e.find("img").attr("src");
                    $("#task-info-wrapper .card-active .filter_members_list li:not(.filter)").each(function() {
                        var e = $(this).find("img").attr("src");
                        e == t && $(this).addClass("active")
                    })
                })
            }), $(document).on("click", ".editable-submit", function(e) {
                var t = $(this),
                    a = t.parents("form").find("input.form-control").val(),
                    n = t.parents("form").find("textarea.form-control").val(),
                    o = $("#task-info-wrapper").find("[data-active-id]").data("activeId");
                $('.card-task-item [data-task-id="' + o + '"]').find(".card-title").text(a), $('.card-task-item [data-task-id="' + o + '"]').find('[data-task="notes"]').text(n)
            })
        },
        r = function() {
            $.fn.editable.defaults.mode = "inline", $("#editTaskTitle,#editTaskNotes").editable(), $.fn.editableform.buttons = '<button type="submit" class="btn btn-primary btn-fab btn-fab-xs m-5 editable-submit"><i class="mdi mdi-check"></i></button><button type="button" class="btn btn-default btn-fab btn-fab-xs m-5 editable-cancel"><i class="mdi mdi-close"></i></button>'
        },
        s = function() {
            return Math.floor(9e4 * Math.random()) + 1e4
        },
        l = function() {
            if ($(".card-task-item.active").length > 0) {
                var e = s();
                $(".card-task-item.active").find("[data-task-id]").data("taskId", e), $(".card-task-item.active").removeClass("active")
            } else $("div[data-task-id]").each(function() {
                var e = $(this).parents(".card.card-task-item"),
                    t = s();
                $(this).attr("data-task-id", t), e.find(".task-number").text("#" + t), c()
            })
        },
        c = function() {
            $(".card-lane-wrapper .card-lane").each(function() {
                var e = $(this).find(".card-task-item").length;
                return $(this).parents(".card-lane-wrapper").find(".count").text(e), e
            })
        },
        d = function() {
            $('[data-task="add-task"]').on("click", function() {
                var e = $(this);
                $("#addTaskForm").length > 0 ? e.attr("disabled", !0) : $.get("assets/partials/task/_task-add.html", function(t) {
                    e.parents(".card-lane-wrapper").find(".card-lane").append(t).find(".form-control").focus(), e.attr("disabled", !0), m(), u()
                })
            })
        },
        p = function() {
            $(".card-task.empty").on("click.addNewTaskList", function() {
                var e = $(this);
                e.find(".card-body").slideDown(), e.removeClass("empty")
            }), $(".card-task.empty .card-body").on("click.addNewTaskList", function(e) {}), $('[data-task="cancel-list"]').on("click", function(e) {
                e.stopPropagation();
                var t = $(this).parents(".card-task");
                t.find(".card-body").slideUp(), t.addClass("empty"), t.find('.swatches [name=swatches][value="bg-white"]').prop("checked", !0), t.find("[data-task-color]").data("taskColor", "").attr("class", "")
            }), $(".card-task .swatches input").on("click", function() {
                var e = $(this).parents(".card-task"),
                    t = e.find("[data-task-color]"),
                    a = $(this).val();
                t.attr("class", ""), t.addClass(a)
            }), $('[data-task="save-task-list"]').on("click", function(e) {
                var t = $(this).parents(".card-task"),
                    a = $(this).parents(".card-lane-wrapper"),
                    n = t.find("#newTaskListInput"),
                    o = t.find(".card-title"),
                    i = t.find(".swatches input:checked").val(),
                    r = t.find("[data-task-color]");
                "" === $.trim(n.val()) ? $(this).parents(".form-group").addClass("has-error") : (o.text(n.val()), r.data("taskColor", i), t.find(".badge.count").addClass(i), t.find(".card-body").remove(), a.find(".hidden").removeClass("hidden"))
            })
        },
        u = function() {
            $('[data-task="save-task"]').on("click", function(e) {
                var t = $(this).parents(".card.card-task-item"),
                    a = t.find(".form-control");
                t.find('[data-task="add-task"]');
                if ("" === $.trim(a.val())) $(this).parents(".form-group").addClass("has-error");
                else {
                    t.addClass("active"), t.find(".card-title").removeClass("hide").text(a.val()), t.find(".card-actions li").removeClass("hide"), t.find("#addTaskForm").remove(), t.find('[data-task="cancel"]').remove(), t.find('[data-drawer="open-right-lg"]').unbind(), l();
                    var o = t.find("[data-task-id]");
                    t.find(".task-number").text("#" + o.data("taskId")), t.find("[data-task-id]").attr("data-task-id", o.data("taskId")), (0, n.toggleDrawer)(), $(a).removeClass("has-error"), $('[data-task="add-task"]').removeAttr("disabled"), i(), c()
                }
                return !1
            })
        },
        h = function() {
            $('[data-task="delete"]').on("click", function(e) {
                e.stopPropagation();
                var t = $(this);
                setTimeout(function() {
                    swal({
                        title: "Are you sure?",
                        text: "You won't be able to revert this!",
                        type: "warning",
                        showCancelButton: !0,
                        confirmButtonColor: "#3085d6",
                        cancelButtonColor: "#d33",
                        confirmButtonText: "Yes, delete it!"
                    }).then(function() {
                        t.parents(".card-task-item").remove(), $('[data-task="add-task"]').removeAttr("disabled"), swal("Deleted!", "Your task has been removed.", "success")
                    })
                }, 250)
            })
        },
        m = function() {
            $('[data-task="cancel"]').on("click", function() {
                $(this).parents(".card.card-task-item").remove(), $('[data-task="add-task"]').removeAttr("disabled")
            })
        },
        f = function() {
            $('[data-task="edit-task"]').on("click", function(e) {
                var t = $(this),
                    a = t.parents(".card-task-item").find(".card-title"),
                    n = a.text();
                return $.get("assets/partials/task/_task-edit.html", function(e) {
                    if (!$("#addTaskForm").length > 0) {
                        t.closest("ul").children("li").addClass("hide"), $(e).insertAfter(a);
                        var o = t.parents(".card-task-item").find("#addTaskForm #editTaskInput");
                        o.val(n), m(), h(), u()
                    }
                }), !1
            })
        },
        g = function() {
            var e = $("#task-info-wrapper #filter_members_input"),
                t = $("#task-info-wrapper .filter_members_list li:not(.filter)");
            (0, o.filterList)(e, t), $("#task-info-wrapper .filter_members_list li:not(.filter)").on("click", function(e) {
                var t = $(this);
                if (!t.hasClass("active")) {
                    t.toggleClass("active");
                    var a = t.clone().html();
                    t.parents(".user-group").prepend('<li class="list-group-item">' + a + '<a class="remove-guests"><i class="zmdi zmdi-minus-circle"></i></a></li>')
                }
                $("#task-info-wrapper .remove-guests").on("click", function() {
                    var e = $(this),
                        t = e.parent(".list-group-item").find("img").attr("src");
                    $("#task-info-wrapper .filter_members_list li:not(.filter)").each(function() {
                        var a = $(this).children("img").attr("src");
                        $(this).hasClass("active") && t === a && (e.parent(".list-group-item").fadeOut(), $(this).removeClass("active"))
                    })
                })
            })
        },
        b = function() {
            var e = dragula({});
            $(".card-lane").each(function() {
                e.containers.push($(this).get(0)), e.on("drag", function(e) {
                    e.classList.add("is-moving")
                }).on("dragend", function(e) {
                    e.classList.remove("is-moving"), window.setTimeout(function() {
                        e.classList.add("is-moved"), t()
                    }, 100)
                })
            });
            var t = function() {
                $("#fadedColor").remove();
                var e = $(".is-moved").parents(".card-lane-wrapper").find("[data-task-color]").data("taskColor");
                $(".is-moved").prepend('<div id="fadedColor" class="' + e + '"></div>'), window.setTimeout(function() {
                    $("#fadedColor").remove(), $(".card-task-item").removeClass("is-moved"), c()
                }, 350)
            }
        };
    t.getTaskCardInfo = i, t.loadTaskId = l, t.addNewTask = d, t.addNewTaskList = p, t.deleteTask = h, t.editTask = f, t.filterTaskMembers = g, t.dragDropTask = b
}, 

function(e, t) {
    Object.defineProperty(t, "__esModule", {
        value: !0
    });
    t.fullscreenTransition = function() {
        $("[data-transition]").on("click", function(e) {
            var t = $("body"),
                a = $(this),
                n = a.data("transition");
            return a.hasClass(n) || (a.addClass(n), t.addClass(n)), !1
        })
    }
}, 

function(e, t) {
    Object.defineProperty(t, "__esModule", {
        value: !0
    });
    var a = function() {
        $("#rootwizard").bootstrapWizard({
            onTabShow: function(e, t, a) {
                var n = t.find("li").length,
                    o = a + 0,
                    i = o / (n - 1) * 100,
                    r = 100 - 100 / n + "%";
                t.find("li").removeClass("done"), t.find("li.active").prevAll().addClass("done"), $("#rootwizard").find(".progress-bar").css({
                    width: i + "%"
                }), $(".form-wizard-horizontal").find(".progress").css({
                    width: r
                })
            }
        }), $("#rootwizard .finish").on("click", function(e) {
            e.stopPropagation(), swal({
                title: "Order Complete",
                text: "Thank you for your purchase!",
                type: "success",
                timer: 2e3,
                showConfirmButton: !1
            }), $("#rootwizard").find("a[href*='tab1']").trigger("click")
        })
    };
    t.wizardDemo = a
},





]);
//# sourceMappingURL=app.bundle.js.map

$(document).ready(function(){
$('.select').click(function(){
        $('.selectDropdown').toggleClass('open');
    });
});
    