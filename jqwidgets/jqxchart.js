/*
jQWidgets v13.1.0 (2021-Nov)
Copyright (c) 2011-2021 jQWidgets.
License: https://jqwidgets.com/license/
*/
/* eslint-disable */
(function(a) {
    a.jqx.jqxWidget("jqxDraw", "", {});
    a.extend(a.jqx._jqxDraw.prototype, {
        defineInstance: function() {
            var c = {
                renderEngine: ""
            };
            a.extend(true, this, c);
            var d = ["clear", "on", "off", "removeElement", "attr", "getAttr", "line", "circle", "rect", "path", "pieslice", "text", "measureText"];
            for (var b in d) {
                this._addFn(a.jqx._jqxDraw.prototype, d[b])
            }
            if (this === a.jqx._jqxDraw.prototype) {
                return c
            }
            return c
        },
        _addFn: function(c, b) {
            if (c[b]) {
                return
            }
            c[b] = function() {
                return this.renderer[b].apply(this.renderer, arguments)
            }
        },
        createInstance: function(b) {},
        _initRenderer: function(b) {
            return a.jqx.createRenderer(this, b)
        },
        _internalRefresh: function() {
            var b = this;
            if (a.jqx.isHidden(b.host)) {
                return
            }
            if (!b.renderer) {
                b.host.empty();
                b._initRenderer(b.host)
            }
            var d = b.renderer;
            if (!d) {
                return
            }
            var c = d.getRect();
            b._render({
                x: 1,
                y: 1,
                width: c.width,
                height: c.height
            });
            if (d instanceof a.jqx.HTML5Renderer) {
                d.refresh()
            }
        },
        _saveAsImage: function(d, e, b, c) {
            return a.jqx._widgetToImage(this, d, e, b, c)
        },
        _render: function(c) {
            var b = this;
            var d = b.renderer;
            b._plotRect = c
        },
        refresh: function() {
            this._internalRefresh()
        },
        getSize: function() {
            var b = this._plotRect;
            return {
                width: b.width,
                height: b.height
            }
        },
        saveAsPNG: function(d, b, c) {
            return this._saveAsImage("png", d, b, c)
        },
        saveAsJPEG: function(d, b, c) {
            return this._saveAsImage("jpeg", d, b, c)
        }
    })
})(jqxBaseFramework);
(function(a) {
    a.jqx.toGreyScale = function(b) {
        if (b.indexOf("#") == -1) {
            return b
        }
        var c = a.jqx.cssToRgb(b);
        c[0] = c[1] = c[2] = Math.round(0.3 * c[0] + 0.59 * c[1] + 0.11 * c[2]);
        var d = a.jqx.rgbToHex(c[0], c[1], c[2]);
        return "#" + d[0] + d[1] + d[2]
    }, a.jqx.adjustColor = function(e, d) {
        if (typeof(e) != "string") {
            return "#000000"
        }
        if (e.indexOf("#") == -1) {
            return e
        }
        var f = a.jqx.cssToRgb(e);
        var b = a.jqx.rgbToHsl(f);
        b[2] = Math.min(1, b[2] * d);
        b[1] = Math.min(1, b[1] * d * 1.1);
        f = a.jqx.hslToRgb(b);
        var e = "#";
        for (var g = 0; g < 3; g++) {
            var h = Math.round(f[g]);
            h = a.jqx.decToHex(h);
            if (h.toString().length == 1) {
                e += "0"
            }
            e += h
        }
        return e.toUpperCase()
    };
    a.jqx.decToHex = function(b) {
        return b.toString(16)
    };
    a.jqx.hexToDec = function(b) {
        return parseInt(b, 16)
    };
    a.jqx.rgbToHex = function(e, d, c) {
        return [a.jqx.decToHex(e), a.jqx.decToHex(d), a.jqx.decToHex(c)]
    };
    a.jqx.hexToRgb = function(c, d, b) {
        return [a.jqx.hexToDec(c), a.jqx.hexToDec(d), a.jqx.hexToDec(b)]
    };
    a.jqx.cssToRgb = function(b) {
        if (b.indexOf("rgb") <= -1) {
            return a.jqx.hexToRgb(b.substring(1, 3), b.substring(3, 5), b.substring(5, 7))
        }
        return b.substring(4, b.length - 1).split(",")
    };
    a.jqx.hslToRgb = function(m) {
        var i = parseFloat(m[0]);
        var n = parseFloat(m[1]);
        var f = parseFloat(m[2]);
        if (n == 0) {
            var c, j, k;
            c = j = k = f
        } else {
            var d = f < 0.5 ? f * (1 + n) : f + n - f * n;
            var e = 2 * f - d;
            var c = a.jqx.hueToRgb(e, d, i + 1 / 3);
            var j = a.jqx.hueToRgb(e, d, i);
            var k = a.jqx.hueToRgb(e, d, i - 1 / 3)
        }
        return [c * 255, j * 255, k * 255]
    };
    a.jqx.hueToRgb = function(d, c, b) {
        if (b < 0) {
            b += 1
        }
        if (b > 1) {
            b -= 1
        }
        if (b < 1 / 6) {
            return d + (c - d) * 6 * b
        } else {
            if (b < 1 / 2) {
                return c
            } else {
                if (b < 2 / 3) {
                    return d + (c - d) * (2 / 3 - b) * 6
                }
            }
        }
        return d
    };
    a.jqx.rgbToHsl = function(j) {
        var c = parseFloat(j[0]) / 255;
        var i = parseFloat(j[1]) / 255;
        var k = parseFloat(j[2]) / 255;
        var m = Math.max(c, i, k),
            e = Math.min(c, i, k);
        var f, o, d = (m + e) / 2;
        if (m == e) {
            f = o = 0
        } else {
            var n = m - e;
            o = d > 0.5 ? n / (2 - m - e) : n / (m + e);
            switch (m) {
                case c:
                    f = (i - k) / n + (i < k ? 6 : 0);
                    break;
                case i:
                    f = (k - c) / n + 2;
                    break;
                case k:
                    f = (c - i) / n + 4;
                    break
            }
            f /= 6
        }
        return [f, o, d]
    };
    a.jqx.swap = function(b, d) {
        var c = b;
        b = d;
        d = c
    };
    a.jqx.getNum = function(b) {
        if (!a.isArray(b)) {
            if (isNaN(b)) {
                return 0
            }
        } else {
            for (var c = 0; c < b.length; c++) {
                if (!isNaN(b[c])) {
                    return b[c]
                }
            }
        }
        return 0
    };
    a.jqx._ptdist = function(c, e, b, d) {
        return Math.sqrt((b - c) * (b - c) + (d - e) * (d - e))
    };
    a.jqx._ptrnd = function(c) {
        if (!document.createElementNS) {
            if (Math.round(c) == c) {
                return c
            }
            return a.jqx._rnd(c, 1, false, true)
        }
        var b = a.jqx._rnd(c, 0.5, false, true);
        if (Math.abs(b - Math.round(b)) != 0.5) {
            return b > c ? b - 0.5 : b + 0.5
        }
        return b
    };
    a.jqx._ptRotate = function(d, i, c, h, f) {
        var b = Math.sqrt(Math.pow(Math.abs(d - c), 2) + Math.pow(Math.abs(i - h), 2));
        var e = Math.asin((d - c) / b);
        var g = e + f;
        d = c + Math.cos(g) * b;
        i = h + Math.sin(g) * b;
        return {
            x: d,
            y: i
        }
    };
    a.jqx._rup = function(c) {
        var b = Math.round(c);
        if (c > b) {
            b++
        }
        return b
    };
    a.jqx.log = function(c, b) {
        return Math.log(c) / (b ? Math.log(b) : 1)
    };
    a.jqx._mod = function(d, c) {
        var e = Math.abs(d > c ? c : d);
        var f = 1;
        if (e != 0) {
            while (e * f < 100) {
                f *= 10
            }
        }
        d = d * f;
        c = c * f;
        return (d % c) / f
    };
    a.jqx._rnd = function(d, f, e, c) {
        if (isNaN(d)) {
            return d
        }
        if (undefined === c) {
            c = true
        }
        var b = d - ((c == true) ? d % f : a.jqx._mod(d, f));
        if (d == b) {
            return b
        }
        if (e) {
            if (d > b) {
                b += f
            }
        } else {
            if (b > d) {
                b -= f
            }
        }
        return (f == 1) ? Math.round(b) : b
    };
    a.jqx.commonRenderer = {
        pieSlicePath: function(k, j, h, r, A, B, d) {
            if (!r) {
                r = 1
            }
            var m = Math.abs(A - B);
            var p = m > 180 ? 1 : 0;
            if (m >= 360) {
                B = A + 359.99
            }
            var q = A * Math.PI * 2 / 360;
            var i = B * Math.PI * 2 / 360;
            var w = k,
                v = k,
                f = j,
                e = j;
            var n = !isNaN(h) && h > 0;
            if (n) {
                d = 0
            }
            if (d + h > 0) {
                if (d > 0) {
                    var l = m / 2 + A;
                    var z = l * Math.PI * 2 / 360;
                    k += d * Math.cos(z);
                    j -= d * Math.sin(z)
                }
                if (n) {
                    var u = h;
                    w = k + u * Math.cos(q);
                    f = j - u * Math.sin(q);
                    v = k + u * Math.cos(i);
                    e = j - u * Math.sin(i)
                }
            }
            var t = k + r * Math.cos(q);
            var s = k + r * Math.cos(i);
            var c = j - r * Math.sin(q);
            var b = j - r * Math.sin(i);
            var o = "";
            var g = (Math.abs(Math.abs(B - A) - 360) > 0.02);
            if (n) {
                o = "M " + v + "," + e;
                o += " a" + h + "," + h;
                o += " 0 " + p + ",1 " + (w - v) + "," + (f - e);
                if (g) {
                    o += " L" + t + "," + c
                } else {
                    o += " M" + t + "," + c
                }
                o += " a" + r + "," + r;
                o += " 0 " + p + ",0 " + (s - t) + "," + (b - c);
                if (g) {
                    o += " Z"
                }
            } else {
                o = "M " + s + "," + b;
                o += " a" + r + "," + r;
                o += " 0 " + p + ",1 " + (t - s) + "," + (c - b);
                if (g) {
                    o += " L" + k + "," + j;
                    o += " Z"
                }
            }
            return o
        },
        measureText: function(o, f, g, n, l) {
            var e = l._getTextParts(o, f, g);
            var i = e.width;
            var b = e.height;
            if (false == n) {
                b /= 0.6
            }
            var c = {};
            if (isNaN(f)) {
                f = 0
            }
            if (f == 0) {
                c = {
                    width: a.jqx._rup(i),
                    height: a.jqx._rup(b)
                }
            } else {
                var k = f * Math.PI * 2 / 360;
                var d = Math.abs(Math.sin(k));
                var j = Math.abs(Math.cos(k));
                var h = Math.abs(i * d + b * j);
                var m = Math.abs(i * j + b * d);
                c = {
                    width: a.jqx._rup(m),
                    height: a.jqx._rup(h)
                }
            }
            if (n) {
                c.textPartsInfo = e
            }
            return c
        },
        alignTextInRect: function(q, n, b, r, m, o, i, p, e, d) {
            var k = e * Math.PI * 2 / 360;
            var c = Math.sin(k);
            var j = Math.cos(k);
            var l = m * c;
            var h = m * j;
            if (i == "center" || i == "" || i == "undefined") {
                q = q + b / 2
            } else {
                if (i == "right") {
                    q = q + b
                }
            }
            if (p == "center" || p == "middle" || p == "" || p == "undefined") {
                n = n + r / 2
            } else {
                if (p == "bottom") {
                    n += r - o / 2
                } else {
                    if (p == "top") {
                        n += o / 2
                    }
                }
            }
            d = d || "";
            var f = "middle";
            if (d.indexOf("top") != -1) {
                f = "top"
            } else {
                if (d.indexOf("bottom") != -1) {
                    f = "bottom"
                }
            }
            var g = "center";
            if (d.indexOf("left") != -1) {
                g = "left"
            } else {
                if (d.indexOf("right") != -1) {
                    g = "right"
                }
            }
            if (g == "center") {
                q -= h / 2;
                n -= l / 2
            } else {
                if (g == "right") {
                    q -= h;
                    n -= l
                }
            }
            if (f == "top") {
                q -= o * c;
                n += o * j
            } else {
                if (f == "middle") {
                    q -= o * c / 2;
                    n += o * j / 2
                }
            }
            q = a.jqx._rup(q);
            n = a.jqx._rup(n);
            return {
                x: q,
                y: n
            }
        }
    };
    a.jqx.svgRenderer = function() {};
    a.jqx.svgRenderer.prototype = {
        _svgns: "http://www.w3.org/2000/svg",
        init: function(f) {
            var d = "<table class=tblChart cellspacing='0' cellpadding='0' border='0' align='left' valign='top'><tr><td colspan=2 class=tdTop></td></tr><tr><td class=tdLeft></td><td><div class='chartContainer' style='position:relative' onselectstart='return false;'></div></td></tr></table>";
            f.append(d);
            this.host = f;
            var b = f.find(".chartContainer");
            b[0].style.width = f.width() + "px";
            b[0].style.height = f.height() + "px";
            var h;
            try {
                var c = document.createElementNS(this._svgns, "svg");
                c.setAttribute("id", "svgChart");
                c.setAttribute("version", "1.1");
                c.setAttribute("width", "100%");
                c.setAttribute("height", "100%");
                c.setAttribute("overflow", "hidden");
                b[0].appendChild(c);
                this.canvas = c
            } catch (g) {
                return false
            }
            this._id = new Date().getTime();
            this.clear();
            this._layout();
            this._runLayoutFix();
            return true
        },
        getType: function() {
            return "SVG"
        },
        refresh: function() {},
        _runLayoutFix: function() {
            var b = this;
            this._fixLayout()
        },
        _fixLayout: function() {
            var f = this.canvas.getBoundingClientRect();
            var d = (parseFloat(f.left) == parseInt(f.left));
            var b = (parseFloat(f.top) == parseInt(f.top));
            if (a.jqx.browser.msie) {
                var d = true,
                    b = true;
                var e = this.host;
                var c = 0,
                    g = 0;
                while (e && e.position && e[0].parentNode) {
                    var h = e.position();
                    c += parseFloat(h.left) - parseInt(h.left);
                    g += parseFloat(h.top) - parseInt(h.top);
                    e = e.parent()
                }
                d = parseFloat(c) == parseInt(c);
                b = parseFloat(g) == parseInt(g)
            }
            if (!d) {
                this.host.find(".tdLeft")[0].style.width = "0.5px"
            }
            if (!b) {
                this.host.find(".tdTop")[0].style.height = "0.5px"
            }
        },
        _layout: function() {
            var b = this.host.find(".chartContainer");
            this._width = Math.max(a.jqx._rup(this.host.width()) - 1, 0);
            this._height = Math.max(a.jqx._rup(this.host.height()) - 1, 0);
            b[0].style.width = this._width;
            b[0].style.height = this._height;
            this._fixLayout()
        },
        getRect: function() {
            return {
                x: 0,
                y: 0,
                width: this._width,
                height: this._height
            }
        },
        getContainer: function() {
            var b = this.host.find(".chartContainer");
            return b
        },
        clear: function() {
            while (this.canvas.childElementCount > 0) {
                this.removeElement(this.canvas.firstElementChild)
            }
            this._defaultParent = undefined;
            this._defs = document.createElementNS(this._svgns, "defs");
            this._gradients = {};
            this.canvas.appendChild(this._defs)
        },
        removeElement: function(d) {
            if (undefined == d) {
                return
            }
            this.removeHandler(d);
            try {
                while (d.firstChild) {
                    this.removeElement(d.firstChild)
                }
                if (d.parentNode) {
                    d.parentNode.removeChild(d)
                } else {
                    this.canvas.removeChild(d)
                }
            } catch (c) {
                var b = c
            }
        },
        _openGroups: [],
        beginGroup: function() {
            var b = this._activeParent();
            var c = document.createElementNS(this._svgns, "g");
            b.appendChild(c);
            this._openGroups.push(c);
            return c
        },
        endGroup: function() {
            if (this._openGroups.length == 0) {
                return
            }
            this._openGroups.pop()
        },
        _activeParent: function() {
            return this._openGroups.length == 0 ? this.canvas : this._openGroups[this._openGroups.length - 1]
        },
        createClipRect: function(d) {
            var e = document.createElementNS(this._svgns, "clipPath");
            var b = document.createElementNS(this._svgns, "rect");
            this.attr(b, {
                x: d.x,
                y: d.y,
                width: d.width,
                height: d.height,
                fill: "none"
            });
            this._clipId = this._clipId || 0;
            e.id = "cl" + this._id + "_" + (++this._clipId).toString();
            e.appendChild(b);
            this._defs.appendChild(e);
            return e
        },
        getWindowHref: function() {
            var c = a.jqx.browser;
            if (c && c.browser == "msie" && c.version < 10) {
                return ""
            }
            var b = window.location.href;
            if (!b) {
                return b
            }
            b = b.replace(/([\('\)])/g, "\\$1");
            b = b.replace(/#.*$/, "");
            return b
        },
        setClip: function(d, c) {
            var b = "url(" + this.getWindowHref() + "#" + c.id + ")";
            return this.attr(d, {
                "clip-path": b
            })
        },
        _clipId: 0,
        addHandler: function(b, d, c) {
            if (a(b).on) {
                a(b).on(d, c)
            } else {
                a(b).bind(d, c)
            }
        },
        removeHandler: function(b, d, c) {
            if (a(b).off) {
                a(b).off(d, c)
            } else {
                a(b).unbind(d, c)
            }
        },
        on: function(b, d, c) {
            this.addHandler(b, d, c)
        },
        off: function(b, d, c) {
            this.removeHandler(b, d, c)
        },
        shape: function(b, e) {
            var c = document.createElementNS(this._svgns, b);
            if (!c) {
                return undefined
            }
            for (var d in e) {
                if (e[d] !== undefined && e[d].toString() === "NaN") {
                    c.setAttribute(d, 0)
                } else {
                    c.setAttribute(d, e[d])
                }
            }
            this._activeParent().appendChild(c);
            return c
        },
        _getTextParts: function(q, g, h) {
            var f = {
                width: 0,
                height: 0,
                parts: []
            };
            if (undefined === q) {
                return f
            }
            var m = 0.6;
            var r = q.toString().split("<br>");
            var o = this._activeParent();
            var k = document.createElementNS(this._svgns, "text");
            this.attr(k, h);
            for (var j = 0; j < r.length; j++) {
                var c = r[j];
                var d = k.ownerDocument.createTextNode(c);
                k.appendChild(d);
                o.appendChild(k);
                var p;
                try {
                    p = k.getBBox()
                } catch (n) {}
                var l = a.jqx._rup(p.width);
                var b = a.jqx._rup(p.height * m);
                k.removeChild(d);
                f.width = Math.max(f.width, l);
                f.height += b + (j > 0 ? 4 : 0);
                f.parts.push({
                    width: l,
                    height: b,
                    text: c
                })
            }
            o.removeChild(k);
            return f
        },
        _measureText: function(e, d, c, b) {
            return a.jqx.commonRenderer.measureText(e, d, c, b, this)
        },
        measureText: function(d, c, b) {
            return this._measureText(d, c, b, false)
        },
        text: function(t, q, p, B, z, H, J, I, s, k, c) {
            var v = this._measureText(t, H, J, true);
            var j = v.textPartsInfo;
            var f = j.parts;
            var A;
            if (!s) {
                s = "center"
            }
            if (!k) {
                k = "center"
            }
            if (f.length > 1 || I) {
                A = this.beginGroup()
            }
            if (I) {
                var g = this.createClipRect({
                    x: a.jqx._rup(q) - 1,
                    y: a.jqx._rup(p) - 1,
                    width: a.jqx._rup(B) + 2,
                    height: a.jqx._rup(z) + 2
                });
                this.setClip(A, g)
            }
            var o = this._activeParent();
            var L = 0,
                l = 0;
            var b = 0.6;
            L = j.width;
            l = j.height;
            if (isNaN(B) || B <= 0) {
                B = L
            }
            if (isNaN(z) || z <= 0) {
                z = l
            }
            var r = B || 0;
            var G = z || 0;
            if (!H || H == 0) {
                p += l;
                if (k == "center" || k == "middle") {
                    p += (G - l) / 2
                } else {
                    if (k == "bottom") {
                        p += G - l
                    }
                }
                if (!B) {
                    B = L
                }
                if (!z) {
                    z = l
                }
                var o = this._activeParent();
                var n = 0;
                for (var F = f.length - 1; F >= 0; F--) {
                    var u = document.createElementNS(this._svgns, "text");
                    this.attr(u, J);
                    this.attr(u, {
                        cursor: "default"
                    });
                    var E = u.ownerDocument.createTextNode(f[F].text);
                    u.appendChild(E);
                    var M = q;
                    var m = f[F].width;
                    var e = f[F].height;
                    if (s == "center") {
                        M += (r - m) / 2
                    } else {
                        if (s == "right") {
                            M += (r - m)
                        }
                    }
                    this.attr(u, {
                        x: a.jqx._rup(M),
                        y: a.jqx._rup(p + n),
                        width: a.jqx._rup(m),
                        height: a.jqx._rup(e)
                    });
                    o.appendChild(u);
                    n -= f[F].height + 4
                }
                if (A) {
                    this.endGroup();
                    return A
                }
                return u
            }
            var C = a.jqx.commonRenderer.alignTextInRect(q, p, B, z, L, l, s, k, H, c);
            q = C.x;
            p = C.y;
            var D = this.shape("g", {
                transform: "translate(" + q + "," + p + ")"
            });
            var d = this.shape("g", {
                transform: "rotate(" + H + ")"
            });
            D.appendChild(d);
            var n = 0;
            for (var F = f.length - 1; F >= 0; F--) {
                var K = document.createElementNS(this._svgns, "text");
                this.attr(K, J);
                this.attr(K, {
                    cursor: "default"
                });
                var E = K.ownerDocument.createTextNode(f[F].text);
                K.appendChild(E);
                var M = 0;
                var m = f[F].width;
                var e = f[F].height;
                if (s == "center") {
                    M += (j.width - m) / 2
                } else {
                    if (s == "right") {
                        M += (j.width - m)
                    }
                }
                this.attr(K, {
                    x: a.jqx._rup(M),
                    y: a.jqx._rup(n),
                    width: a.jqx._rup(m),
                    height: a.jqx._rup(e)
                });
                d.appendChild(K);
                n -= e + 4
            }
            o.appendChild(D);
            if (A) {
                this.endGroup()
            }
            return D
        },
        line: function(d, f, c, e, g) {
            var b = this.shape("line", {
                x1: d,
                y1: f,
                x2: c,
                y2: e
            });
            this.attr(b, g);
            return b
        },
        path: function(c, d) {
            var b = this.shape("path");
            b.setAttribute("d", c);
            if (d) {
                this.attr(b, d)
            }
            return b
        },
        rect: function(b, g, c, e, f) {
            b = a.jqx._ptrnd(b);
            g = a.jqx._ptrnd(g);
            c = Math.max(1, a.jqx._rnd(c, 1, false));
            e = Math.max(1, a.jqx._rnd(e, 1, false));
            var d = this.shape("rect", {
                x: b,
                y: g,
                width: c,
                height: e
            });
            if (f) {
                this.attr(d, f)
            }
            return d
        },
        circle: function(b, f, d, e) {
            var c = this.shape("circle", {
                cx: b,
                cy: f,
                r: d
            });
            if (e) {
                this.attr(c, e)
            }
            return c
        },
        pieSlicePath: function(c, h, g, e, f, d, b) {
            return a.jqx.commonRenderer.pieSlicePath(c, h, g, e, f, d, b)
        },
        pieslice: function(j, h, g, d, f, b, i, c) {
            var e = this.pieSlicePath(j, h, g, d, f, b, i);
            var k = this.shape("path");
            k.setAttribute("d", e);
            if (c) {
                this.attr(k, c)
            }
            return k
        },
        attr: function(b, d) {
            if (!b || !d) {
                return
            }
            for (var c in d) {
                if (c == "textContent") {
                    b.textContent = d[c]
                } else {
                    b.setAttribute(c, d[c])
                }
            }
        },
        removeAttr: function(b, d) {
            if (!b || !d) {
                return
            }
            for (var c in d) {
                if (c == "textContent") {
                    b.textContent = ""
                } else {
                    b.removeAttribute(d[c])
                }
            }
        },
        getAttr: function(c, b) {
            return c.getAttribute(b)
        },
        _gradients: {},
        _toLinearGradient: function(e, h, j) {
            var c = "grd" + this._id + e.replace("#", "") + (h ? "v" : "h");
            var b = "url(" + this.getWindowHref() + "#" + c + ")";
            if (this._gradients[b]) {
                return b
            }
            var d = document.createElementNS(this._svgns, "linearGradient");
            this.attr(d, {
                x1: "0%",
                y1: "0%",
                x2: h ? "0%" : "100%",
                y2: h ? "100%" : "0%",
                id: c
            });
            for (var f = 0; f < j.length; f++) {
                var g = j[f];
                var l = document.createElementNS(this._svgns, "stop");
                var k = "stop-color:" + a.jqx.adjustColor(e, g[1]);
                this.attr(l, {
                    offset: g[0] + "%",
                    style: k
                });
                d.appendChild(l)
            }
            this._defs.appendChild(d);
            this._gradients[b] = true;
            return b
        },
        _toRadialGradient: function(e, j, h) {
            var c = "grd" + this._id + e.replace("#", "") + "r" + (h != undefined ? h.key : "");
            var b = "url(" + this.getWindowHref() + "#" + c + ")";
            if (this._gradients[b]) {
                return b
            }
            var d = document.createElementNS(this._svgns, "radialGradient");
            if (h == undefined) {
                this.attr(d, {
                    cx: "50%",
                    cy: "50%",
                    r: "100%",
                    fx: "50%",
                    fy: "50%",
                    id: c
                })
            } else {
                this.attr(d, {
                    cx: h.x,
                    cy: h.y,
                    r: h.outerRadius,
                    id: c,
                    gradientUnits: "userSpaceOnUse"
                })
            }
            for (var f = 0; f < j.length; f++) {
                var g = j[f];
                var l = document.createElementNS(this._svgns, "stop");
                var k = "stop-color:" + a.jqx.adjustColor(e, g[1]);
                this.attr(l, {
                    offset: g[0] + "%",
                    style: k
                });
                d.appendChild(l)
            }
            this._defs.appendChild(d);
            this._gradients[b] = true;
            return b
        }
    };
    a.jqx.vmlRenderer = function() {};
    a.jqx.vmlRenderer.prototype = {
        init: function(g) {
            var f = "<div class='chartContainer' style=\"position:relative;overflow:hidden;\"><div>";
            g.append(f);
            this.host = g;
            var b = g.find(".chartContainer");
            b[0].style.width = g.width() + "px";
            b[0].style.height = g.height() + "px";
            var d = true;
            try {
                for (var c = 0; c < document.namespaces.length; c++) {
                    if (document.namespaces[c].name == "v" && document.namespaces[c].urn == "urn:schemas-microsoft-com:vml") {
                        d = false;
                        break
                    }
                }
            } catch (h) {
                return false
            }
            if (a.jqx.browser.msie && parseInt(a.jqx.browser.version) < 9 && (document.childNodes && document.childNodes.length > 0 && document.childNodes[0].data && document.childNodes[0].data.indexOf("DOCTYPE") != -1)) {
                if (d) {
                    document.namespaces.add("v", "urn:schemas-microsoft-com:vml")
                }
                this._ie8mode = true
            } else {
                if (d) {
                    document.namespaces.add("v", "urn:schemas-microsoft-com:vml");
                    document.createStyleSheet().cssText = "v\\:* { behavior: url(#default#VML); display: inline-block; }"
                }
            }
            this.canvas = b[0];
            this._width = Math.max(a.jqx._rup(b.width()), 0);
            this._height = Math.max(a.jqx._rup(b.height()), 0);
            b[0].style.width = this._width + 2;
            b[0].style.height = this._height + 2;
            this._id = new Date().getTime();
            this.clear();
            return true
        },
        getType: function() {
            return "VML"
        },
        refresh: function() {},
        getRect: function() {
            return {
                x: 0,
                y: 0,
                width: this._width,
                height: this._height
            }
        },
        getContainer: function() {
            var b = this.host.find(".chartContainer");
            return b
        },
        clear: function() {
            while (this.canvas.childElementCount > 0) {
                this.removeHandler(this.canvas.firstElementChild);
                this.canvas.removeChild(this.canvas.firstElementChild)
            }
            this._gradients = {};
            this._defaultParent = undefined
        },
        removeElement: function(b) {
            if (b != null) {
                this.removeHandler(b);
                b.parentNode.removeChild(b)
            }
        },
        _openGroups: [],
        beginGroup: function() {
            var b = this._activeParent();
            var c = document.createElement("v:group");
            c.style.position = "absolute";
            c.coordorigin = "0,0";
            c.coordsize = this._width + "," + this._height;
            c.style.left = 0;
            c.style.top = 0;
            c.style.width = this._width;
            c.style.height = this._height;
            b.appendChild(c);
            this._openGroups.push(c);
            return c
        },
        endGroup: function() {
            if (this._openGroups.length == 0) {
                return
            }
            this._openGroups.pop()
        },
        _activeParent: function() {
            return this._openGroups.length == 0 ? this.canvas : this._openGroups[this._openGroups.length - 1]
        },
        createClipRect: function(b) {
            var c = document.createElement("div");
            c.style.height = (b.height + 1) + "px";
            c.style.width = (b.width + 1) + "px";
            c.style.position = "absolute";
            c.style.left = b.x + "px";
            c.style.top = b.y + "px";
            c.style.overflow = "hidden";
            this._clipId = this._clipId || 0;
            c.id = "cl" + this._id + "_" + (++this._clipId).toString();
            this._activeParent().appendChild(c);
            return c
        },
        setClip: function(c, b) {},
        _clipId: 0,
        addHandler: function(b, d, c) {
            if (a(b).on) {
                a(b).on(d, c)
            } else {
                a(b).bind(d, c)
            }
        },
        removeHandler: function(b, d, c) {
            if (a(b).off) {
                a(b).off(d, c)
            } else {
                a(b).unbind(d, c)
            }
        },
        on: function(b, d, c) {
            this.addHandler(b, d, c)
        },
        off: function(b, d, c) {
            this.removeHandler(b, d, c)
        },
        _getTextParts: function(o, f, g) {
            var e = {
                width: 0,
                height: 0,
                parts: []
            };
            var m = 0.6;
            var p = o.toString().split("<br>");
            var n = this._activeParent();
            var j = document.createElement("v:textbox");
            this.attr(j, g);
            n.appendChild(j);
            for (var h = 0; h < p.length; h++) {
                var c = p[h];
                var d = document.createElement("span");
                d.appendChild(document.createTextNode(c));
                j.appendChild(d);
                if (g && g["class"]) {
                    d.className = g["class"]
                }
                var l = a(j);
                var k = a.jqx._rup(l.width());
                var b = a.jqx._rup(l.height() * m);
                if (b == 0 && a.jqx.browser.msie && parseInt(a.jqx.browser.version) < 9) {
                    var q = l.css("font-size");
                    if (q) {
                        b = parseInt(q);
                        if (isNaN(b)) {
                            b = 0
                        }
                    }
                }
                j.removeChild(d);
                e.width = Math.max(e.width, k);
                e.height += b + (h > 0 ? 2 : 0);
                e.parts.push({
                    width: k,
                    height: b,
                    text: c
                })
            }
            n.removeChild(j);
            return e
        },
        _measureText: function(e, d, c, b) {
            if (Math.abs(d) > 45) {
                d = 90
            } else {
                d = 0
            }
            return a.jqx.commonRenderer.measureText(e, d, c, b, this)
        },
        measureText: function(d, c, b) {
            return this._measureText(d, c, b, false)
        },
        text: function(r, n, m, A, t, G, I, H, q, g) {
            var B;
            if (I && I.stroke) {
                B = I.stroke
            }
            if (B == undefined) {
                B = "black"
            }
            var s = this._measureText(r, G, I, true);
            var e = s.textPartsInfo;
            var b = e.parts;
            var J = s.width;
            var j = s.height;
            if (isNaN(A) || A == 0) {
                A = J
            }
            if (isNaN(t) || t == 0) {
                t = j
            }
            var v;
            if (!q) {
                q = "center"
            }
            if (!g) {
                g = "center"
            }
            if (b.length > 0 || H) {
                v = this.beginGroup()
            }
            if (H) {
                var c = this.createClipRect({
                    x: a.jqx._rup(n),
                    y: a.jqx._rup(m),
                    width: a.jqx._rup(A),
                    height: a.jqx._rup(t)
                });
                this.setClip(v, c)
            }
            var l = this._activeParent();
            var p = A || 0;
            var F = t || 0;
            if (Math.abs(G) > 45) {
                G = 90
            } else {
                G = 0
            }
            var u = 0,
                E = 0;
            if (q == "center") {
                u += (p - J) / 2
            } else {
                if (q == "right") {
                    u += (p - J)
                }
            }
            if (g == "center") {
                E = (F - j) / 2
            } else {
                if (g == "bottom") {
                    E = F - j
                }
            }
            if (G == 0) {
                m += j + E;
                n += u
            } else {
                n += J + u;
                m += E
            }
            var k = 0,
                K = 0;
            var d;
            for (var D = b.length - 1; D >= 0; D--) {
                var z = b[D];
                var o = (J - z.width) / 2;
                if (G == 0 && q == "left") {
                    o = 0
                } else {
                    if (G == 0 && q == "right") {
                        o = J - z.width
                    } else {
                        if (G == 90) {
                            o = (j - z.width) / 2
                        }
                    }
                }
                var f = k - z.height;
                E = G == 90 ? o : f;
                u = G == 90 ? f : o;
                d = document.createElement("v:textbox");
                d.style.position = "absolute";
                d.style.left = a.jqx._rup(n + u);
                d.style.top = a.jqx._rup(m + E);
                d.style.width = a.jqx._rup(z.width);
                d.style.height = a.jqx._rup(z.height);
                if (G == 90) {
                    d.style.filter = "progid:DXImageTransform.Microsoft.BasicImage(rotation=3)";
                    d.style.height = a.jqx._rup(z.height) + 5
                }
                var C = document.createElement("span");
                C.appendChild(document.createTextNode(z.text));
                if (I && I["class"]) {
                    C.className = I["class"]
                }
                d.appendChild(C);
                l.appendChild(d);
                k -= z.height + (D > 0 ? 2 : 0)
            }
            if (v) {
                this.endGroup();
                return l
            }
            return d
        },
        shape: function(b, e) {
            var c = document.createElement(this._createElementMarkup(b));
            if (!c) {
                return undefined
            }
            for (var d in e) {
                c.setAttribute(d, e[d])
            }
            this._activeParent().appendChild(c);
            return c
        },
        line: function(e, g, d, f, h) {
            var b = "M " + e + "," + g + " L " + d + "," + f + " X E";
            var c = this.path(b);
            this.attr(c, h);
            return c
        },
        _createElementMarkup: function(b) {
            var c = "<v:" + b + ' style=""></v:' + b + ">";
            if (this._ie8mode) {
                c = c.replace('style=""', 'style="behavior: url(#default#VML);"')
            }
            return c
        },
        path: function(c, d) {
            var b = document.createElement(this._createElementMarkup("shape"));
            b.style.position = "absolute";
            b.coordsize = this._width + " " + this._height;
            b.coordorigin = "0 0";
            b.style.width = parseInt(this._width);
            b.style.height = parseInt(this._height);
            b.style.left = 0 + "px";
            b.style.top = 0 + "px";
            b.setAttribute("path", c);
            this._activeParent().appendChild(b);
            if (d) {
                this.attr(b, d)
            }
            return b
        },
        rect: function(b, g, c, d, f) {
            b = a.jqx._ptrnd(b);
            g = a.jqx._ptrnd(g);
            c = a.jqx._rup(c);
            d = a.jqx._rup(d);
            var e = this.shape("rect", f);
            e.style.position = "absolute";
            e.style.left = b;
            e.style.top = g;
            e.style.width = c;
            e.style.height = d;
            e.strokeweight = 0;
            if (f) {
                this.attr(e, f)
            }
            return e
        },
        circle: function(b, f, d, e) {
            var c = this.shape("oval");
            b = a.jqx._ptrnd(b - d);
            f = a.jqx._ptrnd(f - d);
            d = a.jqx._rup(d);
            c.style.position = "absolute";
            c.style.left = b;
            c.style.top = f;
            c.style.width = d * 2;
            c.style.height = d * 2;
            if (e) {
                this.attr(c, e)
            }
            return c
        },
        updateCircle: function(d, b, e, c) {
            if (b == undefined) {
                b = parseFloat(d.style.left) + parseFloat(d.style.width) / 2
            }
            if (e == undefined) {
                e = parseFloat(d.style.top) + parseFloat(d.style.height) / 2
            }
            if (c == undefined) {
                c = parseFloat(d.width) / 2
            }
            b = a.jqx._ptrnd(b - c);
            e = a.jqx._ptrnd(e - c);
            c = a.jqx._rup(c);
            d.style.left = b;
            d.style.top = e;
            d.style.width = c * 2;
            d.style.height = c * 2
        },
        pieSlicePath: function(k, j, h, r, B, C, d) {
            if (!r) {
                r = 1
            }
            var m = Math.abs(B - C);
            var p = m > 180 ? 1 : 0;
            if (m > 360) {
                B = 0;
                C = 360
            }
            var q = B * Math.PI * 2 / 360;
            var i = C * Math.PI * 2 / 360;
            var w = k,
                v = k,
                f = j,
                e = j;
            var n = !isNaN(h) && h > 0;
            if (n) {
                d = 0
            }
            if (d > 0) {
                var l = m / 2 + B;
                var A = l * Math.PI * 2 / 360;
                k += d * Math.cos(A);
                j -= d * Math.sin(A)
            }
            if (n) {
                var u = h;
                w = a.jqx._ptrnd(k + u * Math.cos(q));
                f = a.jqx._ptrnd(j - u * Math.sin(q));
                v = a.jqx._ptrnd(k + u * Math.cos(i));
                e = a.jqx._ptrnd(j - u * Math.sin(i))
            }
            var t = a.jqx._ptrnd(k + r * Math.cos(q));
            var s = a.jqx._ptrnd(k + r * Math.cos(i));
            var c = a.jqx._ptrnd(j - r * Math.sin(q));
            var b = a.jqx._ptrnd(j - r * Math.sin(i));
            r = a.jqx._ptrnd(r);
            h = a.jqx._ptrnd(h);
            k = a.jqx._ptrnd(k);
            j = a.jqx._ptrnd(j);
            var g = Math.round(B * 65535);
            var z = Math.round((C - B) * 65536);
            if (h < 0) {
                h = 1
            }
            var o = "";
            if (n) {
                o = "M" + w + " " + f;
                o += " AE " + k + " " + j + " " + h + " " + h + " " + g + " " + z;
                o += " L " + s + " " + b;
                g = Math.round((B - C) * 65535);
                z = Math.round(C * 65536);
                o += " AE " + k + " " + j + " " + r + " " + r + " " + z + " " + g;
                o += " L " + w + " " + f
            } else {
                o = "M" + k + " " + j;
                o += " AE " + k + " " + j + " " + r + " " + r + " " + g + " " + z
            }
            o += " X E";
            return o
        },
        pieslice: function(k, i, h, e, g, b, j, d) {
            var f = this.pieSlicePath(k, i, h, e, g, b, j);
            var c = this.path(f, d);
            if (d) {
                this.attr(c, d)
            }
            return c
        },
        _keymap: [{
            svg: "fill",
            vml: "fillcolor"
        }, {
            svg: "stroke",
            vml: "strokecolor"
        }, {
            svg: "stroke-width",
            vml: "strokeweight"
        }, {
            svg: "stroke-dasharray",
            vml: "dashstyle"
        }, {
            svg: "fill-opacity",
            vml: "fillopacity"
        }, {
            svg: "stroke-opacity",
            vml: "strokeopacity"
        }, {
            svg: "opacity",
            vml: "opacity"
        }, {
            svg: "cx",
            vml: "style.left"
        }, {
            svg: "cy",
            vml: "style.top"
        }, {
            svg: "height",
            vml: "style.height"
        }, {
            svg: "width",
            vml: "style.width"
        }, {
            svg: "x",
            vml: "style.left"
        }, {
            svg: "y",
            vml: "style.top"
        }, {
            svg: "d",
            vml: "v"
        }, {
            svg: "display",
            vml: "style.display"
        }],
        _translateParam: function(b) {
            for (var c in this._keymap) {
                if (this._keymap[c].svg == b) {
                    return this._keymap[c].vml
                }
            }
            return b
        },
        attr: function(c, e) {
            if (!c || !e) {
                return
            }
            for (var d in e) {
                var b = this._translateParam(d);
                if (undefined == e[d]) {
                    continue
                }
                if (b == "fillcolor" && e[d].indexOf("grd") != -1) {
                    c.type = e[d]
                } else {
                    if (b == "fillcolor" && e[d] == "transparent") {
                        c.style.filter = "alpha(opacity=0)";
                        c["-ms-filter"] = "progid:DXImageTransform.Microsoft.Alpha(Opacity=0)"
                    } else {
                        if (b == "opacity" || b == "fillopacity") {
                            if (c.fill) {
                                c.fill.opacity = e[d]
                            }
                        } else {
                            if (b == "textContent") {
                                c.children[0].innerText = e[d]
                            } else {
                                if (b == "dashstyle") {
                                    c.dashstyle = e[d].replace(",", " ")
                                } else {
                                    if (b.indexOf("style.") == -1) {
                                        c[b] = e[d]
                                    } else {
                                        c.style[b.replace("style.", "")] = e[d]
                                    }
                                }
                            }
                        }
                    }
                }
            }
        },
        removeAttr: function(b, d) {
            if (!b || !d) {
                return
            }
            for (var c in d) {
                b.removeAttribute(d[c])
            }
        },
        getAttr: function(d, c) {
            var b = this._translateParam(c);
            if (b == "opacity" || b == "fillopacity") {
                if (d.fill) {
                    return d.fill.opacity
                } else {
                    return 1
                }
            }
            if (b.indexOf("style.") == -1) {
                return d[b]
            }
            return d.style[b.replace("style.", "")]
        },
        _gradients: {},
        _toRadialGradient: function(b, d, c) {
            return b
        },
        _toLinearGradient: function(g, k, l) {
            if (this._ie8mode) {
                return g
            }
            var d = "grd" + g.replace("#", "") + (k ? "v" : "h");
            var e = "#" + d + "";
            if (this._gradients[e]) {
                return e
            }
            var f = document.createElement(this._createElementMarkup("fill"));
            f.type = "gradient";
            f.method = "linear";
            f.angle = k ? 0 : 90;
            var c = "";
            for (var h = 0; h < l.length; h++) {
                var j = l[h];
                if (j > 0) {
                    c += ", "
                }
                c += j[0] + "% " + a.jqx.adjustColor(g, j[1])
            }
            f.colors = c;
            var b = document.createElement(this._createElementMarkup("shapetype"));
            b.appendChild(f);
            b.id = d;
            this.canvas.appendChild(b);
            return e
        }
    };
    a.jqx.HTML5Renderer = function() {};
    a.jqx.ptrnd = function(c) {
        if (Math.abs(Math.round(c) - c) == 0.5) {
            return c
        }
        var b = Math.round(c);
        if (b < c) {
            b = b - 1
        }
        return b + 0.5
    };
    a.jqx.HTML5Renderer.prototype = {
        init: function(b) {
            try {
                this.host = b;
                this.host.append("<div class='chartContainer' style='position:relative' onselectstart='return false;'><canvas id='__jqxCanvasWrap' style='width:100%; height: 100%;'/></div>");
                this.canvas = b.find("#__jqxCanvasWrap");
                this.canvas[0].width = b.width();
                this.canvas[0].height = b.height();
                this.ctx = this.canvas[0].getContext("2d");
                this._elements = {};
                this._maxId = 0;
                this._gradientId = 0;
                this._gradients = {};
                this._currentPoint = {
                    x: 0,
                    y: 0
                };
                this._lastCmd = "";
                this._pos = 0
            } catch (c) {
                return false
            }
            return true
        },
        getType: function() {
            return "HTML5"
        },
        getContainer: function() {
            var b = this.host.find(".chartContainer");
            return b
        },
        getRect: function() {
            return {
                x: 0,
                y: 0,
                width: this.canvas[0].width - 1,
                height: this.canvas[0].height - 1
            }
        },
        beginGroup: function() {},
        endGroup: function() {},
        setClip: function() {},
        createClipRect: function(b) {},
        addHandler: function(b, d, c) {},
        removeHandler: function(b, d, c) {},
        on: function(b, d, c) {
            this.addHandler(b, d, c)
        },
        off: function(b, d, c) {
            this.removeHandler(b, d, c)
        },
        clear: function() {
            this._elements = {};
            this._maxId = 0;
            this._renderers._gradients = {};
            this._gradientId = 0
        },
        removeElement: function(b) {
            if (undefined == b) {
                return
            }
            if (this._elements[b.id]) {
                delete this._elements[b.id]
            }
        },
        shape: function(b, e) {
            var c = {
                type: b,
                id: this._maxId++
            };
            for (var d in e) {
                c[d] = e[d]
            }
            this._elements[c.id] = c;
            return c
        },
        attr: function(b, d) {
            for (var c in d) {
                b[c] = d[c]
            }
        },
        removeAttr: function(b, d) {
            for (var c in d) {
                delete b[d[c]]
            }
        },
        rect: function(b, g, c, e, f) {
            if (isNaN(b)) {
                throw 'Invalid value for "x"'
            }
            if (isNaN(g)) {
                throw 'Invalid value for "y"'
            }
            if (isNaN(c)) {
                throw 'Invalid value for "width"'
            }
            if (isNaN(e)) {
                throw 'Invalid value for "height"'
            }
            var d = this.shape("rect", {
                x: b,
                y: g,
                width: c,
                height: e
            });
            if (f) {
                this.attr(d, f)
            }
            return d
        },
        path: function(b, d) {
            var c = this.shape("path", d);
            this.attr(c, {
                d: b
            });
            return c
        },
        line: function(c, e, b, d, f) {
            return this.path("M " + c + "," + e + " L " + b + "," + d, f)
        },
        circle: function(b, f, d, e) {
            var c = this.shape("circle", {
                x: b,
                y: f,
                r: d
            });
            if (e) {
                this.attr(c, e)
            }
            return c
        },
        pieSlicePath: function(c, h, g, e, f, d, b) {
            return a.jqx.commonRenderer.pieSlicePath(c, h, g, e, f, d, b)
        },
        pieslice: function(j, h, g, e, f, b, i, c) {
            var d = this.path(this.pieSlicePath(j, h, g, e, f, b, i), c);
            this.attr(d, {
                x: j,
                y: h,
                innerRadius: g,
                outerRadius: e,
                angleFrom: f,
                angleTo: b
            });
            return d
        },
        _getCSSStyle: function(c) {
            var g = document.styleSheets;
            try {
                for (var d = 0; d < g.length; d++) {
                    for (var b = 0; g[d].cssRules && b < g[d].cssRules.length; b++) {
                        if (g[d].cssRules[b].selectorText.indexOf(c) != -1) {
                            return g[d].cssRules[b].style
                        }
                    }
                }
            } catch (f) {}
            return {}
        },
        _getTextParts: function(p, f, g) {
            var l = "Arial";
            var q = "10pt";
            var m = "";
            if (g && g["class"]) {
                var b = this._getCSSStyle(g["class"]);
                if (b.fontSize) {
                    q = b.fontSize
                }
                if (b.fontFamily) {
                    l = b.fontFamily
                }
                if (b.fontWeight) {
                    m = b.fontWeight
                }
            }
            this.ctx.font = m + " " + q + " " + l;
            var e = {
                width: 0,
                height: 0,
                parts: []
            };
            var k = 0.6;
            var o = p.toString().split("<br>");
            for (var h = 0; h < o.length; h++) {
                var d = o[h];
                var j = this.ctx.measureText(d).width;
                var n = document.createElement("span.jqxchart");
                n.font = this.ctx.font;
                n.textContent = d;
                document.body.appendChild(n);
                var c = n.offsetHeight * k;
                document.body.removeChild(n);
                e.width = Math.max(e.width, a.jqx._rup(j));
                e.height += c + (h > 0 ? 4 : 0);
                e.parts.push({
                    width: j,
                    height: c,
                    text: d
                })
            }
            return e
        },
        _measureText: function(e, d, c, b) {
            return a.jqx.commonRenderer.measureText(e, d, c, b, this)
        },
        measureText: function(d, c, b) {
            return this._measureText(d, c, b, false)
        },
        text: function(m, l, j, c, n, f, g, d, h, k, e) {
            var o = this.shape("text", {
                text: m,
                x: l,
                y: j,
                width: c,
                height: n,
                angle: f,
                clip: d,
                halign: h,
                valign: k,
                rotateAround: e
            });
            if (g) {
                this.attr(o, g)
            }
            o.fontFamily = "Arial";
            o.fontSize = "10pt";
            o.fontWeight = "";
            o.color = "#000000";
            if (g && g["class"]) {
                var b = this._getCSSStyle(g["class"]);
                o.fontFamily = b.fontFamily || o.fontFamily;
                o.fontSize = b.fontSize || o.fontSize;
                o.fontWeight = b.fontWeight || o.fontWeight;
                o.color = b.color || o.color
            }
            var i = this._measureText(m, 0, g, true);
            this.attr(o, {
                textPartsInfo: i.textPartsInfo,
                textWidth: i.width,
                textHeight: i.height
            });
            if (c <= 0 || isNaN(c)) {
                this.attr(o, {
                    width: i.width
                })
            }
            if (n <= 0 || isNaN(n)) {
                this.attr(o, {
                    height: i.height
                })
            }
            return o
        },
        _toLinearGradient: function(c, g, f) {
            if (this._renderers._gradients[c]) {
                return c
            }
            var b = [];
            for (var e = 0; e < f.length; e++) {
                b.push({
                    percent: f[e][0] / 100,
                    color: a.jqx.adjustColor(c, f[e][1])
                })
            }
            var d = "gr" + this._gradientId++;
            this.createGradient(d, g ? "vertical" : "horizontal", b);
            return d
        },
        _toRadialGradient: function(c, f) {
            if (this._renderers._gradients[c]) {
                return c
            }
            var b = [];
            for (var e = 0; e < f.length; e++) {
                b.push({
                    percent: f[e][0] / 100,
                    color: a.jqx.adjustColor(c, f[e][1])
                })
            }
            var d = "gr" + this._gradientId++;
            this.createGradient(d, "radial", b);
            return d
        },
        createGradient: function(d, c, b) {
            this._renderers.createGradient(this, d, c, b)
        },
        _renderers: {
            createGradient: function(e, d, c, b) {
                e._gradients[d] = {
                    orientation: c,
                    colorStops: b
                }
            },
            setStroke: function(c, d) {
                var b = c.ctx;
                b.strokeStyle = d.stroke || "transparent";
                b.lineWidth = d["stroke-width"] || 1;
                if (d["fill-opacity"] != undefined) {
                    b.globalAlpha = d["fill-opacity"]
                } else {
                    if (d.opacity != undefined) {
                        b.globalAlpha = d.opacity
                    } else {
                        b.globalAlpha = 1
                    }
                }
                if (b.setLineDash) {
                    if (d["stroke-dasharray"]) {
                        b.setLineDash(d["stroke-dasharray"].split(","))
                    } else {
                        b.setLineDash([])
                    }
                }
            },
            setFillStyle: function(c, h) {
                var r = c.ctx;
                r.fillStyle = "transparent";
                if (h["fill-opacity"] != undefined) {
                    r.globalAlpha = h["fill-opacity"]
                } else {
                    if (h.opacity != undefined) {
                        r.globalAlpha = h.opacity
                    } else {
                        r.globalAlpha = 1
                    }
                }
                if (h.fill && h.fill.indexOf("#") == -1 && c._gradients[h.fill]) {
                    var p = c._gradients[h.fill].orientation != "horizontal";
                    var k = c._gradients[h.fill].orientation == "radial";
                    var d = a.jqx.ptrnd(h.x);
                    var q = a.jqx.ptrnd(h.y);
                    var b = a.jqx.ptrnd(h.x + (p ? 0 : h.width));
                    var m = a.jqx.ptrnd(h.y + (p ? h.height : 0));
                    var o;
                    if ((h.type == "circle" || h.type == "path" || h.type == "rect") && k) {
                        var n = a.jqx.ptrnd(h.x);
                        var l = a.jqx.ptrnd(h.y);
                        var g = h.innerRadius || 0;
                        var f = h.outerRadius || h.r || 0;
                        if (h.type == "rect") {
                            n += h.width / 2;
                            l += h.height / 2
                        }
                        o = r.createRadialGradient(n, l, g, n, l, f)
                    }
                    if (!k) {
                        if (isNaN(d) || isNaN(b) || isNaN(q) || isNaN(m)) {
                            d = 0;
                            q = 0;
                            b = p ? 0 : r.canvas.width;
                            m = p ? r.canvas.height : 0
                        }
                        o = r.createLinearGradient(d, q, b, m)
                    }
                    var e = c._gradients[h.fill].colorStops;
                    for (var j = 0; j < e.length; j++) {
                        o.addColorStop(e[j].percent, e[j].color)
                    }
                    r.fillStyle = o
                } else {
                    if (h.fill) {
                        r.fillStyle = h.fill
                    }
                }
            },
            rect: function(b, c) {
                if (c.width == 0 || c.height == 0) {
                    return
                }
                b.fillRect(a.jqx.ptrnd(c.x), a.jqx.ptrnd(c.y), c.width, c.height);
                b.strokeRect(a.jqx.ptrnd(c.x), a.jqx.ptrnd(c.y), c.width, c.height)
            },
            circle: function(b, c) {
                if (c.r == 0) {
                    return
                }
                b.beginPath();
                b.arc(a.jqx.ptrnd(c.x), a.jqx.ptrnd(c.y), c.r, 0, Math.PI * 2, false);
                b.closePath();
                b.fill();
                b.stroke()
            },
            _parsePoint: function(c) {
                var b = this._parseNumber(c);
                var d = this._parseNumber(c);
                return ({
                    x: b,
                    y: d
                })
            },
            _parseNumber: function(d) {
                var e = false;
                for (var b = this._pos; b < d.length; b++) {
                    if ((d[b] >= "0" && d[b] <= "9") || d[b] == "." || d[b] == "e" || (d[b] == "-" && !e) || (d[b] == "-" && b >= 1 && d[b - 1] == "e")) {
                        e = true;
                        continue
                    }
                    if (!e && (d[b] == " " || d[b] == ",")) {
                        this._pos++;
                        continue
                    }
                    break
                }
                var c = parseFloat(d.substring(this._pos, b));
                if (isNaN(c)) {
                    return undefined
                }
                this._pos = b;
                return c
            },
            _cmds: "mlcazq",
            _isRelativeCmd: function(b) {
                return a.jqx.string.contains(this._cmds, b)
            },
            _parseCmd: function(b) {
                for (var c = this._pos; c < b.length; c++) {
                    if (a.jqx.string.containsIgnoreCase(this._cmds, b[c])) {
                        this._pos = c + 1;
                        this._lastCmd = b[c];
                        return this._lastCmd
                    }
                    if (b[c] == " ") {
                        this._pos++;
                        continue
                    }
                    if (b[c] >= "0" && b[c] <= "9") {
                        this._pos = c;
                        if (this._lastCmd == "") {
                            break
                        } else {
                            return this._lastCmd
                        }
                    }
                }
                return undefined
            },
            _toAbsolutePoint: function(b) {
                return {
                    x: this._currentPoint.x + b.x,
                    y: this._currentPoint.y + b.y
                }
            },
            path: function(A, J) {
                var x = J.d;
                this._pos = 0;
                this._lastCmd = "";
                var k = undefined;
                this._currentPoint = {
                    x: 0,
                    y: 0
                };
                A.beginPath();
                var E = 0;
                while (this._pos < x.length) {
                    var D = this._parseCmd(x);
                    if (D == undefined) {
                        break
                    }
                    if (D == "M" || D == "m") {
                        var B = this._parsePoint(x);
                        if (B == undefined) {
                            break
                        }
                        A.moveTo(B.x, B.y);
                        this._currentPoint = B;
                        if (k == undefined) {
                            k = B
                        }
                        continue
                    }
                    if (D == "L" || D == "l") {
                        var B = this._parsePoint(x);
                        if (B == undefined) {
                            break
                        }
                        A.lineTo(B.x, B.y);
                        this._currentPoint = B;
                        continue
                    }
                    if (D == "A" || D == "a") {
                        var g = this._parseNumber(x);
                        var f = this._parseNumber(x);
                        var H = this._parseNumber(x) * (Math.PI / 180);
                        var L = this._parseNumber(x);
                        var e = this._parseNumber(x);
                        var o = this._parsePoint(x);
                        if (this._isRelativeCmd(D)) {
                            o = this._toAbsolutePoint(o)
                        }
                        if (g == 0 || f == 0) {
                            continue
                        }
                        var h = this._currentPoint;
                        var G = {
                            x: Math.cos(H) * (h.x - o.x) / 2 + Math.sin(H) * (h.y - o.y) / 2,
                            y: -Math.sin(H) * (h.x - o.x) / 2 + Math.cos(H) * (h.y - o.y) / 2
                        };
                        var j = Math.pow(G.x, 2) / Math.pow(g, 2) + Math.pow(G.y, 2) / Math.pow(f, 2);
                        if (j > 1) {
                            g *= Math.sqrt(j);
                            f *= Math.sqrt(j)
                        }
                        var p = (L == e ? -1 : 1) * Math.sqrt(((Math.pow(g, 2) * Math.pow(f, 2)) - (Math.pow(g, 2) * Math.pow(G.y, 2)) - (Math.pow(f, 2) * Math.pow(G.x, 2))) / (Math.pow(g, 2) * Math.pow(G.y, 2) + Math.pow(f, 2) * Math.pow(G.x, 2)));
                        if (isNaN(p)) {
                            p = 0
                        }
                        var F = {
                            x: p * g * G.y / f,
                            y: p * -f * G.x / g
                        };
                        var z = {
                            x: (h.x + o.x) / 2 + Math.cos(H) * F.x - Math.sin(H) * F.y,
                            y: (h.y + o.y) / 2 + Math.sin(H) * F.x + Math.cos(H) * F.y
                        };
                        var y = function(i) {
                            return Math.sqrt(Math.pow(i[0], 2) + Math.pow(i[1], 2))
                        };
                        var t = function(m, i) {
                            return (m[0] * i[0] + m[1] * i[1]) / (y(m) * y(i))
                        };
                        var K = function(m, i) {
                            return (m[0] * i[1] < m[1] * i[0] ? -1 : 1) * Math.acos(t(m, i))
                        };
                        var C = K([1, 0], [(G.x - F.x) / g, (G.y - F.y) / f]);
                        var n = [(G.x - F.x) / g, (G.y - F.y) / f];
                        var l = [(-G.x - F.x) / g, (-G.y - F.y) / f];
                        var I = K(n, l);
                        if (t(n, l) <= -1) {
                            I = Math.PI
                        }
                        if (t(n, l) >= 1) {
                            I = 0
                        }
                        if (e == 0 && I > 0) {
                            I = I - 2 * Math.PI
                        }
                        if (e == 1 && I < 0) {
                            I = I + 2 * Math.PI
                        }
                        var t = (g > f) ? g : f;
                        var w = (g > f) ? 1 : g / f;
                        var q = (g > f) ? f / g : 1;
                        A.translate(z.x, z.y);
                        A.rotate(H);
                        A.scale(w, q);
                        A.arc(0, 0, t, C, C + I, 1 - e);
                        A.scale(1 / w, 1 / q);
                        A.rotate(-H);
                        A.translate(-z.x, -z.y);
                        continue
                    }
                    if ((D == "Z" || D == "z") && k != undefined) {
                        A.lineTo(k.x, k.y);
                        this._currentPoint = k;
                        continue
                    }
                    if (D == "C" || D == "c") {
                        var d = this._parsePoint(x);
                        var c = this._parsePoint(x);
                        var b = this._parsePoint(x);
                        A.bezierCurveTo(d.x, d.y, c.x, c.y, b.x, b.y);
                        this._currentPoint = b;
                        continue
                    }
                    if (D == "Q" || D == "q") {
                        var d = this._parsePoint(x);
                        var c = this._parsePoint(x);
                        A.quadraticCurveTo(d.x, d.y, c.x, c.y);
                        this._currentPoint = c;
                        continue
                    }
                }
                A.fill();
                A.stroke();
                A.closePath()
            },
            text: function(u, D) {
                var n = a.jqx.ptrnd(D.x);
                var m = a.jqx.ptrnd(D.y);
                var s = a.jqx.ptrnd(D.width);
                var q = a.jqx.ptrnd(D.height);
                var p = D.halign;
                var g = D.valign;
                var A = D.angle;
                var b = D.rotateAround;
                var e = D.textPartsInfo;
                var d = e.parts;
                var B = D.clip;
                if (B == undefined) {
                    B = true
                }
                u.save();
                if (!p) {
                    p = "center"
                }
                if (!g) {
                    g = "center"
                }
                if (B) {
                    u.rect(n, m, s, q);
                    u.clip()
                }
                var E = D.textWidth;
                var j = D.textHeight;
                var o = s || 0;
                var z = q || 0;
                u.fillStyle = D.color;
                u.font = D.fontWeight + " " + D.fontSize + " " + D.fontFamily;
                if (!A || A == 0) {
                    m += j;
                    if (g == "center" || g == "middle") {
                        m += (z - j) / 2
                    } else {
                        if (g == "bottom") {
                            m += z - j
                        }
                    }
                    if (!s) {
                        s = E
                    }
                    if (!q) {
                        q = j
                    }
                    var l = 0;
                    for (var v = d.length - 1; v >= 0; v--) {
                        var r = d[v];
                        var F = n;
                        var k = d[v].width;
                        var c = d[v].height;
                        if (p == "center") {
                            F += (o - k) / 2
                        } else {
                            if (p == "right") {
                                F += (o - k)
                            }
                        }
                        u.fillText(r.text, F, m + l);
                        l -= r.height + (v > 0 ? 4 : 0)
                    }
                    u.restore();
                    return
                }
                var t = a.jqx.commonRenderer.alignTextInRect(n, m, s, q, E, j, p, g, A, b);
                n = t.x;
                m = t.y;
                var f = A * Math.PI * 2 / 360;
                u.translate(n, m);
                u.rotate(f);
                var l = 0;
                var C = e.width;
                for (var v = d.length - 1; v >= 0; v--) {
                    var F = 0;
                    if (p == "center") {
                        F += (C - d[v].width) / 2
                    } else {
                        if (p == "right") {
                            F += (C - d[v].width)
                        }
                    }
                    u.fillText(d[v].text, F, l);
                    l -= d[v].height + 4
                }
                u.restore()
            }
        },
        refresh: function() {
            this.ctx.clearRect(0, 0, this.canvas[0].width, this.canvas[0].height);
            for (var b in this._elements) {
                var c = this._elements[b];
                this._renderers.setFillStyle(this, c);
                this._renderers.setStroke(this, c);
                this._renderers[this._elements[b].type](this.ctx, c)
            }
        }
    };
    a.jqx.createRenderer = function(b, d) {
        var c = b;
        var e = c.renderer = null;
        if (document.createElementNS && (c.renderEngine != "HTML5" && c.renderEngine != "VML")) {
            e = new a.jqx.svgRenderer();
            if (!e.init(d)) {
                if (c.renderEngine == "SVG") {
                    throw "Your browser does not support SVG"
                }
                return null
            }
        }
        if (e == null && c.renderEngine != "HTML5") {
            e = new a.jqx.vmlRenderer();
            if (!e.init(d)) {
                if (c.renderEngine == "VML") {
                    throw "Your browser does not support VML"
                }
                return null
            }
            c._isVML = true
        }
        if (e == null && (c.renderEngine == "HTML5" || c.renderEngine == undefined)) {
            e = new a.jqx.HTML5Renderer();
            if (!e.init(d)) {
                throw "Your browser does not support HTML5 Canvas"
            }
        }
        c.renderer = e;
        return e
    }, a.jqx._widgetToImage = function(o, i, d, m, g, f) {
        var k = o;
        if (!k) {
            return false
        }
        if (d == undefined || d == "") {
            d = "image." + i
        }
        var l = k.renderEngine;
        var c = k.enableAnimations;
        k.enableAnimations = false;
        k.renderEngine = "HTML5";
        if (k.renderEngine != l) {
            try {
                k.refresh()
            } catch (h) {
                k.renderEngine = l;
                k.refresh();
                k.enableAnimations = c;
                return false
            }
        }
        var b = k.renderer.getContainer().find("canvas")[0];
        var j = true;
        if (a.isFunction(f)) {
            j = f(o, b)
        }
        var n = true;
        if (j) {
            n = a.jqx.exportImage(b, i, d, m, g)
        }
        if (k.renderEngine != l) {
            k.renderEngine = l;
            k.refresh();
            k.enableAnimations = c
        }
        return n
    };
    a.jqx.getByPriority = function(b) {
        var d = undefined;
        for (var c = 0; c < b.length && d == undefined; c++) {
            if (d == undefined && b[c] != undefined) {
                d = b[c]
            }
        }
        return d
    };
    a.jqx.exportImage = function(d, n, f, q, i) {
        if (!d) {
            return false
        }
        var k = n.toLowerCase() === "pdf";
        if (k) {
            n = "jpeg"
        }
        if (f == undefined || f == "") {
            f = "image." + n
        }
        if (q == undefined || q == "") {
            throw "Please specifiy export server"
        }
        var s = true;
        try {
            if (d) {
                var g = d.toDataURL("image/" + n);
                if (k) {
                    if (!a.jqx.pdfExport) {
                        a.jqx.pdfExport = {
                            orientation: "portrait",
                            paperSize: "a4"
                        }
                    }
                    var h = 595;
                    switch (a.jqx.pdfExport.paperSize) {
                        case "legal":
                            var h = 612;
                            if (a.jqx.pdfExport.orientation !== "portrait") {
                                h = 1008
                            }
                            break;
                        case "letter":
                            var h = 612;
                            if (a.jqx.pdfExport.orientation !== "portrait") {
                                h = 792
                            }
                            break;
                        case "a3":
                            var h = 841;
                            if (a.jqx.pdfExport.orientation !== "portrait") {
                                h = 1190
                            }
                            break;
                        case "a4":
                            var h = 595;
                            if (a.jqx.pdfExport.orientation !== "portrait") {
                                h = 842
                            }
                            break;
                        case "a5":
                            var h = 420;
                            if (a.jqx.pdfExport.orientation !== "portrait") {
                                h = 595
                            }
                            break
                    }
                    var j = a(d).width();
                    var o = j * 72 / 96;
                    if (o >= h - 20) {
                        o = h - 20
                    }
                    var p;
                    try {
                        var p = new window.pdfDataExport(a.jqx.pdfExport.orientation, "pt", a.jqx.pdfExport.paperSize)
                    } catch (m) {
                        var p = new window.jqxPdfDataExport(a.jqx.pdfExport.orientation, "pt", a.jqx.pdfExport.paperSize)
                    }
                    p.addImage(g, "JPEG", 10, 10, o, 0);
                    p.save(f);
                    return
                }
                g = g.replace("data:image/" + n + ";base64,", "");
                if (i) {
                    a.ajax({
                        dataType: "string",
                        url: q,
                        type: "POST",
                        data: {
                            content: g,
                            fname: f
                        },
                        async: false,
                        success: function(t, e, u) {
                            s = true
                        },
                        error: function(t, e, u) {
                            s = false
                        }
                    })
                } else {
                    var c = document.createElement("form");
                    c.method = "POST";
                    c.action = q;
                    c.style.display = "none";
                    document.body.appendChild(c);
                    var r = document.createElement("input");
                    r.name = "fname";
                    r.value = f;
                    r.style.display = "none";
                    var b = document.createElement("input");
                    b.name = "content";
                    b.value = g;
                    b.style.display = "none";
                    c.appendChild(r);
                    c.appendChild(b);
                    c.submit();
                    document.body.removeChild(c);
                    s = true
                }
            }
        } catch (l) {
            s = false
        }
        return s
    }
})(jqxBaseFramework);
(function(a) {
    window.jqxPlot = function() {};
    window.jqxPlot.prototype = {
        get: function(d, b, c) {
            return c !== undefined ? d[b][c] : d[b]
        },
        min: function(f, d) {
            var c = NaN;
            for (var b = 0; b < f.length; b++) {
                var e = this.get(f, b, d);
                if (isNaN(c) || e < c) {
                    c = e
                }
            }
            return c
        },
        max: function(f, d) {
            var b = NaN;
            for (var c = 0; c < f.length; c++) {
                var e = this.get(f, c, d);
                if (isNaN(b) || e > b) {
                    b = e
                }
            }
            return b
        },
        sum: function(f, c) {
            var d = 0;
            for (var b = 0; b < f.length; b++) {
                var e = this.get(f, b, c);
                if (!isNaN(e)) {
                    d += e
                }
            }
            return d
        },
        count: function(f, c) {
            var d = 0;
            for (var b = 0; b < f.length; b++) {
                var e = this.get(f, b, c);
                if (!isNaN(e)) {
                    d++
                }
            }
            return d
        },
        avg: function(c, b) {
            return this.sum(c, b) / Math.max(1, this.count(c, b))
        },
        filter: function(e, d) {
            if (!d) {
                return e
            }
            var b = [];
            for (var c = 0; c < e.length; c++) {
                if (d(e[c])) {
                    b.push(e[c])
                }
            }
            return b
        },
        scale: function(d, i, j, g) {
            if (isNaN(d)) {
                return NaN
            }
            if (d < Math.min(i.min, i.max) || d > Math.max(i.min, i.max)) {
                if (!g || g.ignore_range !== true) {
                    return NaN
                }
            }
            var n = NaN;
            var l = 1;
            if (i.type === undefined || i.type != "logarithmic") {
                var k = Math.abs(i.max - i.min);
                if (!k) {
                    k = 1
                }
                l = Math.abs(d - Math.min(i.min, i.max)) / k
            } else {
                if (i.type === "logarithmic") {
                    var e = i.base;
                    if (isNaN(e)) {
                        e = 10
                    }
                    var h = Math.min(i.min, i.max);
                    if (h <= 0) {
                        h = 1
                    }
                    var m = Math.max(i.min, i.max);
                    if (m <= 0) {
                        m = 1
                    }
                    var f = a.jqx.log(m, e);
                    m = Math.pow(e, f);
                    var c = a.jqx.log(h, e);
                    h = Math.pow(e, c);
                    var b = a.jqx.log(d, e);
                    l = Math.abs(b - c) / (f - c)
                }
            }
            if (j.type === "logarithmic") {
                var e = j.base;
                if (isNaN(e)) {
                    e = 10
                }
                var f = a.jqx.log(j.max, e);
                var c = a.jqx.log(j.min, e);
                if (j.flip) {
                    l = 1 - l
                }
                var b = Math.min(c, f) + l * Math.abs(f - c);
                n = Math.pow(e, b)
            } else {
                n = Math.min(j.min, j.max) + l * Math.abs(j.max - j.min);
                if (j.flip) {
                    n = Math.max(j.min, j.max) - n + j.min
                }
            }
            return n
        },
        axis: function(o, p, k) {
            if (k <= 1) {
                return [p, o]
            }
            var f = o;
            var h = p;
            if (isNaN(k) || k < 2) {
                k = 2
            }
            var b = 0;
            while (Math.round(o) != o && Math.round(p) != p && b < 10) {
                o *= 10;
                p *= 10;
                b++
            }
            var l = (p - o) / k;
            while (b < 10 && Math.round(l) != l) {
                o *= 10;
                p *= 10;
                l *= 10;
                b++
            }
            var t = [1, 2, 5];
            var g = 0;
            var q = 0;
            while (true) {
                var m = q % t.length;
                var e = Math.floor(q / t.length);
                var n = Math.pow(10, e) * t[m];
                m = (q + 1) % t.length;
                e = Math.floor((q + 1) / t.length);
                var j = Math.pow(10, e) * t[m];
                if (l >= n && l < j) {
                    break
                }
                q++
            }
            var d = j;
            var r = [];
            var s = a.jqx._rnd(o, d, false);
            var c = b <= 0 ? 1 : Math.pow(10, b);
            while (s < p + d) {
                r.push(s / c);
                s += d
            }
            return r
        }
    }
})(jqxBaseFramework);

(function(a) {
    a.jqx.jqxWidget("jqxChart", "", {});
    a.extend(a.jqx._jqxChart.prototype, {
        defineInstance: function() {
            a.extend(true, this, this._defaultSettings);
            this._createColorsCache();
            return this._defaultSettings
        },
        _defaultSettings: {
            title: "Title",
            description: "Description",
            source: [],
            seriesGroups: [],
            categoryAxis: null,
            xAxis: {},
            valueAxis: null,
            renderEngine: "",
            enableAnimations: true,
            enableAxisTextAnimation: false,
            backgroundImage: "",
            background: "#FFFFFF",
            padding: {
                left: 5,
                top: 5,
                right: 5,
                bottom: 5
            },
            backgroundColor: "#FFFFFF",
            showBorderLine: true,
            borderLineWidth: 1,
            borderLineColor: null,
            borderColor: null,
            titlePadding: {
                left: 5,
                top: 5,
                right: 5,
                bottom: 10
            },
            showLegend: true,
            legendLayout: null,
            enabled: true,
            colorScheme: "scheme01",
            animationDuration: 500,
            showToolTips: true,
            showToolTipsOnAllSeries: false,
            toolTipShowDelay: 300,
            toolTipDelay: 500,
            toolTipHideDelay: 4000,
            toolTipMoveDuration: 300,
            toolTipFormatFunction: null,
            toolTipAlignment: "dataPoint",
            localization: null,
            columnSeriesOverlap: false,
            rtl: false,
            legendPosition: null,
            greyScale: false,
            axisPadding: 5,
            enableCrosshairs: false,
            crosshairsColor: "#BCBCBC",
            crosshairsDashStyle: "2,2",
            crosshairsLineWidth: 1,
            enableEvents: true,
            _itemsToggleState: [],
            _isToggleRefresh: false,
            _isSelectorRefresh: false,
            _sliders: [],
            _selectorRange: [],
            _rangeSelectorInstances: {},
            _resizeState: {},
            renderer: null,
            _isRangeSelectorInstance: false,
            drawBefore: null,
            draw: null,
            _renderData: {},
            enableSampling: true
        },
        _defaultLineColor: "#BCBCBC",
        _touchEvents: {
            mousedown: a.jqx.mobile.getTouchEventName("touchstart"),
            click: a.jqx.mobile.getTouchEventName("touchstart"),
            mouseup: a.jqx.mobile.getTouchEventName("touchend"),
            mousemove: a.jqx.mobile.getTouchEventName("touchmove"),
            mouseenter: "mouseenter",
            mouseleave: "mouseleave"
        },
        _getEvent: function(b) {
            if (this._isTouchDevice) {
                return this._touchEvents[b]
            } else {
                return b
            }
        },
        destroy: function() {
            this.host.remove()
        },
        _jqxPlot: null,
        createInstance: function(d) {
            if (!a.jqx.dataAdapter) {
                throw "jqxdata.js is not loaded"
            }
            var c = this;
            c._refreshOnDownloadComlete();
            c._isTouchDevice = a.jqx.mobile.isTouchDevice();
            if (!c._jqxPlot) {
                c._jqxPlot = new jqxPlot()
            }
            c.addHandler(c.host, c._getEvent("mousemove"), function(g) {
                if (c.enabled == false) {
                    return
                }
                if (!c._isRangeSelectorInstance) {
                    c.host.css("cursor", "default")
                }
                var f = g.pageX || g.clientX || g.screenX;
                var j = g.pageY || g.clientY || g.screenY;
                var i = c.host.offset();
                if (c._isTouchDevice) {
                    var h = a.jqx.position(g);
                    f = h.left;
                    j = h.top
                }
                f -= i.left;
                j -= i.top;
                c.onmousemove(f, j)
            });
            c.addHandler(c.host, c._getEvent("mouseleave"), function(h) {
                if (c.enabled == false) {
                    return
                }
                var f = c._mouseX;
                var i = c._mouseY;
                var g = c._plotRect;
                if (g && f >= g.x && f <= g.x + g.width && i >= g.y && i <= g.y + g.height) {
                    return
                }
                c._cancelTooltipTimer();
                c._hideToolTip(0);
                c._unselect()
            });
            c.addHandler(c.host, "click", function(g) {
                if (c.enabled == false) {
                    return
                }
                var f = g.pageX || g.clientX || g.screenX;
                var j = g.pageY || g.clientY || g.screenY;
                var i = c.host.offset();
                if (c._isTouchDevice) {
                    var h = a.jqx.position(g);
                    f = h.left;
                    j = h.top
                }
                f -= i.left;
                j -= i.top;
                c._mouseX = f;
                c._mouseY = j;
                if (!isNaN(c._lastClickTs)) {
                    if ((new Date()).valueOf() - c._lastClickTs < 100) {
                        return
                    }
                }
                this._hostClickTimer = setTimeout(function() {
                    if (!c._isTouchDevice) {
                        c._cancelTooltipTimer();
                        c._hideToolTip();
                        c._unselect()
                    }
                    if (c._pointMarker && c._pointMarker.element) {
                        var l = c.seriesGroups[c._pointMarker.gidx];
                        var k = l.series[c._pointMarker.sidx];
                        g.stopImmediatePropagation();
                        c._raiseItemEvent("click", l, k, c._pointMarker.iidx)
                    }
                }, 100)
            });
            var e = c.element.style;
            if (e) {
                var b = false;
                if (e.width != null) {
                    b |= e.width.toString().indexOf("%") != -1
                }
                if (e.height != null) {
                    b |= e.height.toString().indexOf("%") != -1
                }
                if (b) {
                    a.jqx.utilities.resize(this.host, function() {
                        if (c.timer) {
                            clearTimeout(c.timer)
                        }
                        var f = 1;
                        c.timer = setTimeout(function() {
                            var g = c.enableAnimations;
                            c.enableAnimations = false;
                            c.refresh();
                            c.enableAnimations = g
                        }, f)
                    }, false, true)
                }
            }
        },
        _refreshOnDownloadComlete: function() {
            var d = this;
            var e = this.source;
            if (e instanceof a.jqx.dataAdapter) {
                var f = e._options;
                if (f == undefined || (f != undefined && !f.autoBind)) {
                    e.autoSync = false;
                    e.dataBind()
                }
                var c = this.element.id;
                if (e.records.length == 0) {
                    var b = function() {
                        if (d.ready) {
                            d.ready()
                        }
                        d.refresh()
                    };
                    e.unbindDownloadComplete(c);
                    e.bindDownloadComplete(c, b)
                } else {
                    if (d.ready) {
                        d.ready()
                    }
                }
                e.unbindBindingUpdate(c);
                e.bindBindingUpdate(c, function() {
                    if (d._supressBindingRefresh) {
                        return
                    }
                    d.refresh()
                })
            }
        },
        propertyChangedHandler: function(b, c, e, d) {
            if (this.isInitialized == undefined || this.isInitialized == false) {
                return
            }
            if (c == "source") {
                this._refreshOnDownloadComlete()
            }
            this.refresh()
        },
        _initRenderer: function(b) {
            if (!a.jqx.createRenderer) {
                throw "Please include jqxdraw.js"
            }
            return a.jqx.createRenderer(this, b)
        },
        _internalRefresh: function() {
            var b = this;
            if (a.jqx.isHidden(b.host)) {
                return
            }
            b._stopAnimations();
            if (!b.renderer || (!b._isToggleRefresh && !b._isUpdate)) {
                b._hideToolTip(0);
                b._isVML = false;
                b.host.empty();
                b._measureDiv = undefined;
                b._initRenderer(b.host)
            }
            var d = b.renderer;
            if (!d) {
                return
            }
            var c = d.getRect();
            b._render({
                x: 1,
                y: 1,
                width: c.width,
                height: c.height
            });
            this._raiseEvent("refreshBegin", {
                instance: this
            });
            if (d instanceof a.jqx.HTML5Renderer) {
                d.refresh()
            }
            b._isUpdate = false;
            this._raiseEvent("refreshEnd", {
                instance: this
            })
        },
        saveAsPNG: function(d, b, c) {
            return this._saveAsImage("png", d, b, c)
        },
        saveAsJPEG: function(d, b, c) {
            return this._saveAsImage("jpeg", d, b, c)
        },
        saveAsPDF: function(d, b, c) {
            return this._saveAsImage("pdf", d, b, c)
        },
        _saveAsImage: function(e, h, b, c) {
            var g = false;
            for (var d = 0; d < this.seriesGroups.length && !g; d++) {
                var f = this._getXAxis(d);
                if (f && f.rangeSelector) {
                    g = true
                }
            }
            return a.jqx._widgetToImage(this, e, h, b, c, g ? this._selectorSaveAsImageCallback : undefined)
        },
        _selectorSaveAsImageCallback: function(B, h) {
            var r = B;
            for (var z = 0; z < r.seriesGroups.length; z++) {
                var o = r._getXAxis(z);
                if (!o || !o.rangeSelector || o.rangeSelector.renderTo) {
                    continue
                }
                var m = r._rangeSelectorInstances[z];
                if (!m) {
                    continue
                }
                var s = m.jqxChart("getInstance");
                var e = s.renderEngine;
                var d = s.renderer.getRect();
                var f = s.renderer.getContainer().find("canvas")[0];
                var p = f.getContext("2d");
                var w = r._sliders[z];
                var b = r.seriesGroups[z].orientation == "horizontal";
                var c = !b ? "width" : "height";
                var v = b ? "width" : "height";
                var y = !b ? "x" : "y";
                var g = b ? "x" : "y";
                var k = {};
                k[y] = w.startOffset + w.rect[y];
                k[g] = w.rect[g];
                k[c] = w.endOffset - w.startOffset;
                k[v] = w.rect[v];
                var n = o.rangeSelector.colorSelectedRange || "blue";
                var u = o.rangeSelector.colorUnselectedRange || "white";
                var l = o.rangeSelector.colorRangeLine || "grey";
                var q = [];
                q.push(s.renderer.rect(k.x, k.y, k.width, k.height, {
                    fill: n,
                    opacity: 0.1
                }));
                if (!b) {
                    q.push(s.renderer.line(a.jqx._ptrnd(w.rect.x), a.jqx._ptrnd(w.rect.y), a.jqx._ptrnd(k.x), a.jqx._ptrnd(w.rect.y), {
                        stroke: l,
                        opacity: 0.5
                    }));
                    q.push(s.renderer.line(a.jqx._ptrnd(k.x + k.width), a.jqx._ptrnd(w.rect.y), a.jqx._ptrnd(w.rect.x + w.rect.width), a.jqx._ptrnd(w.rect.y), {
                        stroke: l,
                        opacity: 0.5
                    }));
                    q.push(s.renderer.line(a.jqx._ptrnd(k.x), a.jqx._ptrnd(w.rect.y), a.jqx._ptrnd(k.x), a.jqx._ptrnd(w.rect.y + w.rect.height), {
                        stroke: l,
                        opacity: 0.5
                    }));
                    q.push(s.renderer.line(a.jqx._ptrnd(k.x + k.width), a.jqx._ptrnd(w.rect.y), a.jqx._ptrnd(k.x + k.width), a.jqx._ptrnd(w.rect.y + w.rect.height), {
                        stroke: l,
                        opacity: 0.5
                    }))
                } else {
                    q.push(s.renderer.line(a.jqx._ptrnd(w.rect.x + w.rect.width), a.jqx._ptrnd(w.rect.y), a.jqx._ptrnd(w.rect.x + w.rect.width), a.jqx._ptrnd(k.y), {
                        stroke: l,
                        opacity: 0.5
                    }));
                    q.push(s.renderer.line(a.jqx._ptrnd(w.rect.x + w.rect.width), a.jqx._ptrnd(k.y + k.height), a.jqx._ptrnd(w.rect.x + w.rect.width), a.jqx._ptrnd(w.rect.y + w.rect.height), {
                        stroke: l,
                        opacity: 0.5
                    }));
                    q.push(s.renderer.line(a.jqx._ptrnd(w.rect.x), a.jqx._ptrnd(k.y), a.jqx._ptrnd(w.rect.x + w.rect.width), a.jqx._ptrnd(k.y), {
                        stroke: l,
                        opacity: 0.5
                    }));
                    q.push(s.renderer.line(a.jqx._ptrnd(w.rect.x), a.jqx._ptrnd(k.y + k.height), a.jqx._ptrnd(w.rect.x + w.rect.width), a.jqx._ptrnd(k.y + k.height), {
                        stroke: l,
                        opacity: 0.5
                    }))
                }
                s.renderer.refresh();
                var t = p.getImageData(d.x, d.y, d.width, d.height);
                var A = h.getContext("2d");
                A.putImageData(t, parseInt(m.css("left")), parseInt(m.css("top")), 1, 1, d.width, d.height);
                for (var x = 0; x < q.length; x++) {
                    s.renderer.removeElement(q[x])
                }
                s.renderer.refresh()
            }
            return true
        },
        refresh: function() {
            this._internalRefresh()
        },
        update: function() {
            this._isUpdate = true;
            this._internalRefresh()
        },
        _seriesTypes: ["line", "stackedline", "stackedline100", "spline", "stackedspline", "stackedspline100", "stepline", "stackedstepline", "stackedstepline100", "area", "stackedarea", "stackedarea100", "splinearea", "stackedsplinearea", "stackedsplinearea100", "steparea", "stackedsteparea", "stackedsteparea100", "rangearea", "splinerangearea", "steprangearea", "column", "stackedcolumn", "stackedcolumn100", "rangecolumn", "scatter", "stackedscatter", "stackedscatter100", "bubble", "stackedbubble", "stackedbubble100", "pie", "donut", "candlestick", "ohlc", "waterfall", "stackedwaterfall"],
        clear: function() {
            var b = this;
            for (var c in b._defaultSettings) {
                b[c] = b._defaultSettings[c]
            }
            b.title = "";
            b.description = "";
            b.refresh()
        },
        _validateSeriesGroups: function() {
            if (!a.isArray(this.seriesGroups)) {
                throw "Invalid property: 'seriesGroups' property is required and must be a valid array."
            }
            for (var b = 0; b < this.seriesGroups.length; b++) {
                var c = this.seriesGroups[b];
                if (!c.type) {
                    throw "Invalid property: Each series group must have a valid 'type' property."
                }
                if (!a.isArray(c.series)) {
                    throw "Invalid property: Each series group must have a 'series' property which must be a valid array."
                }
            }
        },
        _render: function(C) {
            var m = this;
            var I = m.renderer;
            m._validateSeriesGroups();
            m._colorsCache.clear();
            if (!m._isToggleRefresh && m._isUpdate && m._renderData) {
                m._renderDataClone()
            }
            m._renderData = [];
            I.clear();
            m._unselect();
            m._hideToolTip(0);
            var n = m.backgroundImage;
            if (n == undefined || n == "") {
                m.host.css({
                    "background-image": ""
                })
            } else {
                m.host.css({
                    "background-image": (n.indexOf("(") != -1 ? n : "url('" + n + "')")
                })
            }
            m._rect = C;
            var Y = m.padding || {
                left: 5,
                top: 5,
                right: 5,
                bottom: 5
            };
            var q = I.createClipRect(C);
            var L = I.beginGroup();
            I.setClip(L, q);
            var ai = I.rect(C.x, C.y, C.width - 2, C.height - 2);
            if (n == undefined || n == "") {
                I.attr(ai, {
                    fill: m.backgroundColor || m.background || "white"
                })
            } else {
                I.attr(ai, {
                    fill: "transparent"
                })
            }
            if (m.showBorderLine != false) {
                var F = m.borderLineColor == undefined ? m.borderColor : m.borderLineColor;
                if (F == undefined) {
                    F = m._defaultLineColor
                }
                var o = this.borderLineWidth;
                if (isNaN(o) || o < 0 || o > 10) {
                    o = 1
                }
                I.attr(ai, {
                    "stroke-width": 0,
                    stroke: F
                })
            } else {
                if (a.jqx.browser.msie && a.jqx.browser.version < 9) {
                    I.attr(ai, {
                        "stroke-width": 0,
                        stroke: m.backgroundColor || "white"
                    })
                }
            }
            if (a.isFunction(m.drawBefore)) {
                m.drawBefore(I, C)
            }
            var V = {
                x: Y.left,
                y: Y.top,
                width: C.width - Y.left - Y.right,
                height: C.height - Y.top - Y.bottom
            };
            m._paddedRect = V;
            var e = m.titlePadding || {
                left: 2,
                top: 2,
                right: 2,
                bottom: 2
            };
            var l;
            if (m.title && m.title.length > 0) {
                var S = m.toThemeProperty("jqx-chart-title-text", null);
                l = I.measureText(m.title, 0, {
                    "class": S
                });
                I.text(m.title, V.x + e.left, V.y + e.top, V.width - (e.left + e.right), l.height, 0, {
                    "class": S
                }, true, "center", "center");
                V.y += l.height;
                V.height -= l.height
            }
            if (m.description && m.description.length > 0) {
                var T = m.toThemeProperty("jqx-chart-title-description", null);
                l = I.measureText(m.description, 0, {
                    "class": T
                });
                I.text(m.description, V.x + e.left, V.y + e.top, V.width - (e.left + e.right), l.height, 0, {
                    "class": T
                }, true, "center", "center");
                V.y += l.height;
                V.height -= l.height
            }
            if (m.title || m.description) {
                V.y += (e.bottom + e.top);
                V.height -= (e.bottom + e.top)
            }
            var b = {
                x: V.x,
                y: V.y,
                width: V.width,
                height: V.height
            };
            m._plotRect = b;
            m._buildStats(b);
            var H = m._isPieOnlySeries();
            var s = m.seriesGroups;
            var E;
            var D = {
                xAxis: {},
                valueAxis: {}
            };
            for (var Z = 0; Z < s.length && !H; Z++) {
                if (s[Z].type == "pie" || s[Z].type == "donut") {
                    continue
                }
                var z = m._getXAxis(Z);
                if (!z) {
                    throw "seriesGroup[" + Z + "] is missing xAxis definition"
                }
                var ae = z == m._getXAxis() ? -1 : Z;
                D.xAxis[ae] = 0
            }
            var U = m.axisPadding;
            if (isNaN(U)) {
                U = 5
            }
            var r = {
                left: 0,
                right: 0,
                leftCount: 0,
                rightCount: 0
            };
            var p = [];
            for (Z = 0; Z < s.length; Z++) {
                var ad = s[Z];
                if (ad.type == "pie" || ad.type == "donut" || ad.spider == true || ad.polar == true) {
                    p.push({
                        width: 0,
                        position: 0,
                        xRel: 0
                    });
                    continue
                }
                E = ad.orientation == "horizontal";
                var z = m._getXAxis(Z);
                var ae = z == m._getXAxis() ? -1 : Z;
                var k = m._getValueAxis(Z);
                var O = k == m._getValueAxis() ? -1 : Z;
                var R = !E ? k.axisSize : z.axisSize;
                var f = {
                    x: 0,
                    y: b.y,
                    width: b.width,
                    height: b.height
                };
                var Q = E ? m._getXAxis(Z).position : k.position;
                if (!R || R == "auto") {
                    if (E) {
                        R = this._renderXAxis(Z, f, true, b).width;
                        if ((D.xAxis[ae] & 1) == 1) {
                            R = 0
                        } else {
                            if (R > 0) {
                                D.xAxis[ae] |= 1
                            }
                        }
                    } else {
                        R = m._renderValueAxis(Z, f, true, b).width;
                        if ((D.valueAxis[O] & 1) == 1) {
                            R = 0
                        } else {
                            if (R > 0) {
                                D.valueAxis[O] |= 1
                            }
                        }
                    }
                }
                if (Q != "left" && m.rtl == true) {
                    Q = "right"
                }
                if (Q != "right") {
                    Q = "left"
                }
                if (r[Q + "Count"] > 0 && r[Q] > 0 && R > 0) {
                    r[Q] += U
                }
                p.push({
                    width: R,
                    position: Q,
                    xRel: r[Q]
                });
                r[Q] += R;
                r[Q + "Count"]++
            }
            var u = Math.max(1, Math.max(C.width, C.height));
            var ac = {
                top: 0,
                bottom: 0,
                topCount: 0,
                bottomCount: 0
            };
            var W = [];
            for (Z = 0; Z < s.length; Z++) {
                var ad = s[Z];
                if (ad.type == "pie" || ad.type == "donut" || ad.spider == true || ad.polar == true) {
                    W.push({
                        height: 0,
                        position: 0,
                        yRel: 0
                    });
                    continue
                }
                E = ad.orientation == "horizontal";
                var k = this._getValueAxis(Z);
                var O = k == m._getValueAxis() ? -1 : Z;
                var z = m._getXAxis(Z);
                var ae = z == m._getXAxis() ? -1 : Z;
                var ab = !E ? z.axisSize : k.axisSize;
                var Q = E ? k.position : z.position;
                if (!ab || ab == "auto") {
                    if (E) {
                        ab = m._renderValueAxis(Z, {
                            x: 0,
                            y: 0,
                            width: u,
                            height: 0
                        }, true, b).height;
                        if ((D.valueAxis[O] & 2) == 2) {
                            ab = 0
                        } else {
                            if (ab > 0) {
                                D.valueAxis[O] |= 2
                            }
                        }
                    } else {
                        ab = m._renderXAxis(Z, {
                            x: 0,
                            y: 0,
                            width: u,
                            height: 0
                        }, true).height;
                        if ((D.xAxis[ae] & 2) == 2) {
                            ab = 0
                        } else {
                            if (ab > 0) {
                                D.xAxis[ae] |= 2
                            }
                        }
                    }
                }
                if (Q != "top") {
                    Q = "bottom"
                }
                if (ac[Q + "Count"] > 0 && ac[Q] > 0 && ab > 0) {
                    ac[Q] += U
                }
                W.push({
                    height: ab,
                    position: Q,
                    yRel: ac[Q]
                });
                ac[Q] += ab;
                ac[Q + "Count"]++
            }
            m._createAnimationGroup("series");
            var t = (m.showLegend != false);
            var B = !t ? {
                width: 0,
                height: 0
            } : m._renderLegend(m.legendLayout ? m._rect : V, true);
            if (this.legendLayout && (!isNaN(this.legendLayout.left) || !isNaN(this.legendLayout.top))) {
                B = {
                    width: 0,
                    height: 0
                }
            }
            if (V.height < ac.top + ac.bottom + B.height || V.width < r.left + r.right) {
                I.endGroup();
                return
            }
            b.height -= ac.top + ac.bottom + B.height;
            b.x += r.left;
            b.width -= r.left + r.right;
            b.y += ac.top;
            var G = [];
            if (!H) {
                var af = m._getXAxis().tickMarksColor || m._defaultLineColor;
                for (Z = 0; Z < s.length; Z++) {
                    var ad = s[Z];
                    if (ad.polar == true || ad.spider == true || ad.type == "pie" || ad.type == "donut") {
                        continue
                    }
                    E = ad.orientation == "horizontal";
                    var ae = m._getXAxis(Z) == m._getXAxis() ? -1 : Z;
                    var O = m._getValueAxis(Z) == m._getValueAxis() ? -1 : Z;
                    var f = {
                        x: b.x,
                        y: 0,
                        width: b.width,
                        height: W[Z].height
                    };
                    if (W[Z].position != "top") {
                        f.y = b.y + b.height + W[Z].yRel
                    } else {
                        f.y = b.y - W[Z].yRel - W[Z].height
                    }
                    if (E) {
                        if ((D.valueAxis[O] & 4) == 4) {
                            continue
                        }
                        if (!m._isGroupVisible(Z)) {
                            continue
                        }
                        m._renderValueAxis(Z, f, false, b);
                        D.valueAxis[O] |= 4
                    } else {
                        G.push(f);
                        if ((D.xAxis[ae] & 4) == 4) {
                            continue
                        }
                        if (!m._isGroupVisible(Z)) {
                            continue
                        }
                        m._renderXAxis(Z, f, false, b);
                        D.xAxis[ae] |= 4
                    }
                }
            }
            if (t) {
                var A = m.legendLayout ? m._rect : V;
                var P = V.x + a.jqx._ptrnd((V.width - B.width) / 2);
                var N = b.y + b.height + ac.bottom;
                var R = V.width;
                var ab = B.height;
                if (m.legendLayout) {
                    if (!isNaN(m.legendLayout.left)) {
                        P = m.legendLayout.left
                    }
                    if (!isNaN(m.legendLayout.top)) {
                        N = m.legendLayout.top
                    }
                    if (!isNaN(m.legendLayout.width)) {
                        R = m.legendLayout.width
                    }
                    if (!isNaN(m.legendLayout.height)) {
                        ab = m.legendLayout.height
                    }
                }
                if (P + R > A.x + A.width) {
                    R = A.x + A.width - P
                }
                if (N + ab > A.y + A.height) {
                    ab = A.y + A.height - N
                }
                m._renderLegend({
                    x: P,
                    y: N,
                    width: R,
                    height: ab
                })
            }
            m._hasHorizontalLines = false;
            if (!H) {
                for (Z = 0; Z < s.length; Z++) {
                    var ad = s[Z];
                    if (ad.polar == true || ad.spider == true || ad.type == "pie" || ad.type == "donut") {
                        continue
                    }
                    E = s[Z].orientation == "horizontal";
                    var f = {
                        x: b.x - p[Z].xRel - p[Z].width,
                        y: b.y,
                        width: p[Z].width,
                        height: b.height
                    };
                    if (p[Z].position != "left") {
                        f.x = b.x + b.width + p[Z].xRel
                    }
                    var ae = m._getXAxis(Z) == m._getXAxis() ? -1 : Z;
                    var O = m._getValueAxis(Z) == m._getValueAxis() ? -1 : Z;
                    if (E) {
                        G.push(f);
                        if ((D.xAxis[ae] & 8) == 8) {
                            continue
                        }
                        if (!m._isGroupVisible(Z)) {
                            continue
                        }
                        m._renderXAxis(Z, f, false, b);
                        D.xAxis[ae] |= 8
                    } else {
                        if ((D.valueAxis[O] & 8) == 8) {
                            continue
                        }
                        if (!m._isGroupVisible(Z)) {
                            continue
                        }
                        m._renderValueAxis(Z, f, false, b);
                        D.valueAxis[O] |= 8
                    }
                }
            }
            if (b.width <= 0 || b.height <= 0) {
                return
            }
            m._plotRect = {
                x: b.x,
                y: b.y,
                width: b.width,
                height: b.height
            };
            for (Z = 0; Z < s.length; Z++) {
                this._drawPlotAreaLines(Z, true, {
                    gridLines: false,
                    tickMarks: false,
                    alternatingBackground: true
                });
                this._drawPlotAreaLines(Z, false, {
                    gridLines: false,
                    tickMarks: false,
                    alternatingBackground: true
                })
            }
            for (Z = 0; Z < s.length; Z++) {
                this._drawPlotAreaLines(Z, true, {
                    gridLines: true,
                    tickMarks: true,
                    alternatingBackground: false
                });
                this._drawPlotAreaLines(Z, false, {
                    gridLines: true,
                    tickMarks: true,
                    alternatingBackground: false
                })
            }
            var K = false;
            for (Z = 0; Z < s.length && !K; Z++) {
                var ad = s[Z];
                if (ad.annotations !== undefined || a.isFunction(ad.draw) || a.isFunction(ad.drawBefore)) {
                    K = true;
                    break
                }
            }
            var M = I.beginGroup();
            if (!K) {
                var J = I.createClipRect({
                    x: b.x - 2,
                    y: b.y,
                    width: b.width + 4,
                    height: b.height
                });
                I.setClip(M, J)
            }
            for (Z = 0; Z < s.length; Z++) {
                var ad = s[Z];
                var c = false;
                for (var ag in m._seriesTypes) {
                    if (m._seriesTypes[ag] == ad.type) {
                        c = true;
                        break
                    }
                }
                if (!c) {
                    throw 'Invalid serie type "' + ad.type + '"'
                }
                if (a.isFunction(ad.drawBefore)) {
                    ad.drawBefore(I, C, Z, this)
                }
                if (ad.polar == true || ad.spider == true) {
                    if (ad.type.indexOf("pie") == -1 && ad.type.indexOf("donut") == -1) {
                        m._renderSpiderAxis(Z, b)
                    }
                }
                m._renderAxisBands(Z, b, true);
                m._renderAxisBands(Z, b, false)
            }
            for (Z = 0; Z < s.length; Z++) {
                var ad = s[Z];
                if (m._isColumnType(ad.type)) {
                    m._renderColumnSeries(Z, b)
                } else {
                    if (ad.type.indexOf("pie") != -1 || ad.type.indexOf("donut") != -1) {
                        m._renderPieSeries(Z, b)
                    } else {
                        if (ad.type.indexOf("line") != -1 || ad.type.indexOf("area") != -1) {
                            m._renderLineSeries(Z, b)
                        } else {
                            if (ad.type.indexOf("scatter") != -1 || ad.type.indexOf("bubble") != -1) {
                                m._renderScatterSeries(Z, b)
                            } else {
                                if (ad.type.indexOf("candlestick") != -1 || ad.type.indexOf("ohlc") != -1) {
                                    m._renderCandleStickSeries(Z, b, ad.type.indexOf("ohlc") != -1)
                                }
                            }
                        }
                    }
                }
                if (ad.annotations) {
                    if (!this._moduleAnnotations) {
                        throw "Please include 'jqxchart.annotations.js'"
                    }
                    for (var X = 0; X < ad.annotations.length; X++) {
                        m._renderAnnotation(Z, ad.annotations[X], b)
                    }
                }
                if (a.isFunction(ad.draw)) {
                    m.draw(I, C, Z, this)
                }
            }
            I.endGroup();
            if (m.enabled == false) {
                var aa = I.rect(C.x, C.y, C.width, C.height);
                I.attr(aa, {
                    fill: "#777777",
                    opacity: 0.5,
                    stroke: "#00FFFFFF"
                })
            }
            if (a.isFunction(m.draw)) {
                m.draw(I, C)
            }
            I.endGroup();
            m._startAnimation("series");
            if (m._credits) {
                m._credits()
            }
            var ah = false;
            for (var Z = 0; Z < m.seriesGroups.length && !ah; Z++) {
                var z = m._getXAxis(Z);
                if (z && z.rangeSelector) {
                    ah = true
                }
            }
            if (ah) {
                if (!this._moduleRangeSelector) {
                    throw "Please include 'jqxchart.rangeselector.js'"
                }
                var d = [];
                if (!this._isSelectorRefresh) {
                    m.removeHandler(a(document), m._getEvent("mousemove"), m._onSliderMouseMove);
                    m.removeHandler(a(document), m._getEvent("mousedown"), m._onSliderMouseDown);
                    m.removeHandler(a(document), m._getEvent("mouseup"), m._onSliderMouseUp)
                }
                if (!m._isSelectorRefresh) {
                    m._rangeSelectorInstances = {}
                }
                for (Z = 0; Z < m.seriesGroups.length; Z++) {
                    var v = this._getXAxis(Z);
                    if (d.indexOf(v) == -1) {
                        if (this._renderXAxisRangeSelector(Z, G[Z])) {
                            d.push(v)
                        }
                    }
                }
            }
        },
        _credits: function() {
            if (a.jqx.credits !== "75CE8878-FCD1-4EC7-9249-BA0F153A5DE8") {
                var c = this;
                var d = String.fromCharCode(119, 119, 119, 46, 106, 113, 119, 105, 100, 103, 101, 116, 115, 46, 99, 111, 109);
                if (!c._isRangeSelectorInstance && location.hostname.indexOf(d.substring(4)) == -1) {
                    var g = c.renderer;
                    var f = c._rect;
                    var h = {
                        "class": c.toThemeProperty("jqx-chart-legend-text", null),
                        opacity: 0.5
                    };
                    var e = g.measureText(d, 0, h);
                    var b = g.text(d, f.x + f.width - e.width - 5, f.y + f.height - e.height - 5, e.width, e.height, 0, h);
                    a(b).on("click", function() {
                        location.href = ""
                    })
                }
            }
        },
        _isPieOnlySeries: function() {
            var c = this.seriesGroups;
            if (c.length == 0) {
                return false
            }
            for (var b = 0; b < c.length; b++) {
                if (c[b].type != "pie" && c[b].type != "donut") {
                    return false
                }
            }
            return true
        },
        _renderChartLegend: function(V, C, S, v) {
            var l = this;
            var D = l.renderer;
            var I = {
                x: C.x,
                y: C.y,
                width: C.width,
                height: C.height
            };
            var N = 3;
            if (I.width >= 2 * N) {
                I.x += N;
                I.width -= 2 * N
            }
            if (I.height >= 2 * N) {
                I.y += N;
                I.height -= 2 * N
            }
            var E = {
                width: I.width,
                height: 0
            };
            var G = 0,
                F = 0;
            var p = 20;
            var m = 0;
            var f = 10;
            var Q = 10;
            var w = 0;
            for (var P = 0; P < V.length; P++) {
                var J = V[P].css;
                if (!J) {
                    J = l.toThemeProperty("jqx-chart-legend-text", null)
                }
                p = 20;
                var A = V[P].text;
                var j = D.measureText(A, 0, {
                    "class": J
                });
                if (j.height > p) {
                    p = j.height
                }
                if (j.width > w) {
                    w = j.width
                }
                if (v) {
                    if (P != 0) {
                        F += p
                    }
                    if (F > I.height) {
                        F = 0;
                        G += w + 2 * Q + f;
                        w = j.width;
                        E.width = G + w
                    }
                } else {
                    if (G != 0) {
                        G += Q
                    }
                    if (G + 2 * f + j.width > I.width && j.width < I.width) {
                        G = 0;
                        F += p;
                        p = 20;
                        m = I.width;
                        E.height = F + p
                    }
                }
                var K = false;
                if (j.width > I.width) {
                    K = true;
                    var s = I.width;
                    var T = A;
                    var X = T.split(/\s+/);
                    var o = [];
                    var q = "";
                    for (var M = 0; M < X.length; M++) {
                        var k = q + ((q.length > 0) ? " " : "") + X[M];
                        var B = l.renderer.measureText(k, 0, {
                            "class": J
                        });
                        if (B.width > s && k.length > 0 && q.length > 0) {
                            o.push({
                                text: q
                            });
                            q = X[M]
                        } else {
                            q = k
                        }
                        if (M + 1 == X.length) {
                            o.push({
                                text: q
                            })
                        }
                    }
                    j.width = 0;
                    var c = 0;
                    for (var H = 0; H < o.length; H++) {
                        var W = o[H].text;
                        var B = l.renderer.measureText(W, 0, {
                            "class": J
                        });
                        j.width = Math.max(j.width, B.width);
                        c += j.height
                    }
                    j.height = c
                }
                var z = (G + j.width < I.width) && (F + j.height < C.height);
                if (l.legendLayout) {
                    var z = I.x + G + j.width < l._rect.x + l._rect.width && I.y + F + j.height < l._rect.y + l._rect.height
                }
                if (!S && z) {
                    var h = V[P].seriesIndex;
                    var n = V[P].groupIndex;
                    var b = V[P].itemIndex;
                    var Y = V[P].fillColor;
                    var U = V[P].lineColor;
                    var e = l._isSerieVisible(n, h, b);
                    var R = D.beginGroup();
                    var O = e ? V[P].opacity : 0.1;
                    if (K) {
                        var T = A;
                        var s = I.width;
                        var X = T.split(/\s+/);
                        var u = "";
                        var d = 0;
                        var o = [];
                        var q = "";
                        for (var M = 0; M < X.length; M++) {
                            var k = q + ((q.length > 0) ? " " : "") + X[M];
                            var B = l.renderer.measureText(k, 0, {
                                "class": J
                            });
                            if (B.width > s && k.length > 0 && q.length > 0) {
                                o.push({
                                    text: q,
                                    dy: d
                                });
                                d += B.height;
                                q = X[M]
                            } else {
                                q = k
                            }
                            if (M + 1 == X.length) {
                                o.push({
                                    text: q,
                                    dy: d
                                })
                            }
                        }
                        for (var H = 0; H < o.length; H++) {
                            var W = o[H].text;
                            d = o[H].dy;
                            var B = l.renderer.measureText(W, 0, {
                                "class": J
                            });
                            if (v) {
                                l.renderer.text(W, I.x + G + 1.5 * f, I.y + F + d, j.width, p, 0, {
                                    "class": J
                                }, false, "left", "center")
                            } else {
                                l.renderer.text(W, I.x + G + 1.5 * f, I.y + F + d, j.width, p, 0, {
                                    "class": J
                                }, false, "center", "center")
                            }
                        }
                        var L = D.rect(I.x + G, I.y + F + f / 2 + d / 2, f, f);
                        if (v) {
                            F += d
                        }
                        l.renderer.attr(L, {
                            fill: Y,
                            "fill-opacity": O,
                            stroke: U,
                            "stroke-width": 0,
                            "stroke-opacity": V[P].opacity
                        })
                    } else {
                        var L = D.rect(I.x + G, I.y + F + f / 2, f, f);
                        l.renderer.attr(L, {
                            fill: Y,
                            "fill-opacity": O,
                            stroke: U,
                            "stroke-width": 0,
                            "stroke-opacity": V[P].opacity
                        });
                        if (v) {
                            l.renderer.text(A, I.x + G + 1.5 * f, I.y + F, j.width, j.height + f / 2, 0, {
                                "class": J
                            }, false, "left", "center")
                        } else {
                            l.renderer.text(A, I.x + G + 1.5 * f, I.y + F, j.width, p, 0, {
                                "class": J
                            }, false, "center", "center")
                        }
                    }
                    l.renderer.endGroup();
                    l._setLegendToggleHandler(n, h, b, R)
                }
                if (v) {} else {
                    G += j.width + 2 * f;
                    if (m < G) {
                        m = G
                    }
                }
            }
            if (S) {
                E.height = a.jqx._ptrnd(F + p + 5);
                E.width = a.jqx._ptrnd(m);
                return E
            }
        },
        isSerieVisible: function(d, b, c) {
            return this._isSerieVisible(d, b, c)
        },
        _isSerieVisible: function(f, b, d) {
            while (this._itemsToggleState.length < f + 1) {
                this._itemsToggleState.push([])
            }
            var e = this._itemsToggleState[f];
            while (e.length < b + 1) {
                e.push(isNaN(d) ? true : [])
            }
            var c = e[b];
            if (isNaN(d)) {
                return c
            }
            if (!a.isArray(c)) {
                e[b] = c = []
            }
            while (c.length < d + 1) {
                c.push(true)
            }
            return c[d]
        },
        isGroupVisible: function(b) {
            return this._isGroupVisible(b)
        },
        _isGroupVisible: function(e) {
            var d = false;
            var c = this.seriesGroups[e].series;
            if (!c) {
                return d
            }
            for (var b = 0; b < c.length; b++) {
                if (this._isSerieVisible(e, b)) {
                    d = true;
                    break
                }
            }
            return d
        },
        _toggleSerie: function(h, b, e, c) {
            var g = !this._isSerieVisible(h, b, e);
            if (c != undefined) {
                g = c
            }
            var i = this.seriesGroups[h];
            var f = i.series[b];
            this._raiseEvent("toggle", {
                state: g,
                seriesGroup: i,
                serie: f,
                elementIndex: e
            });
            if (isNaN(e)) {
                this._itemsToggleState[h][b] = g
            } else {
                var d = this._itemsToggleState[h][b];
                if (!a.isArray(d)) {
                    d = []
                }
                while (d.length < e) {
                    d.push(true)
                }
                d[e] = g
            }
            this._isToggleRefresh = true;
            this.update();
            this._isToggleRefresh = false
        },
        showSerie: function(d, b, c) {
            this._toggleSerie(d, b, c, true)
        },
        hideSerie: function(d, b, c) {
            this._toggleSerie(d, b, c, false)
        },
        _setLegendToggleHandler: function(j, c, h, e) {
            var i = this.seriesGroups[j];
            var f = i.series[c];
            var b = f.enableSeriesToggle;
            if (b == undefined) {
                b = i.enableSeriesToggle != false
            }
            if (b) {
                var d = this;
                this.renderer.addHandler(e, "click", function(g) {
                    d._toggleSerie(j, c, h)
                })
            }
        },
        _renderLegend: function(c, e) {
            var o = this;
            var d = [];
            for (var v = 0; v < o.seriesGroups.length; v++) {
                var t = o.seriesGroups[v];
                if (t.showLegend == false) {
                    continue
                }
                for (var q = 0; q < t.series.length; q++) {
                    var m = t.series[q];
                    if (m.showLegend == false) {
                        continue
                    }
                    var u = o._getSerieSettings(v, q);
                    var p;
                    if (t.type == "pie" || t.type == "donut") {
                        var k = o._getXAxis(v);
                        var h = m.legendFormatSettings || t.legendFormatSettings || k.formatSettings || m.formatSettings || t.formatSettings;
                        var n = m.legendFormatFunction || t.legendFormatFunction || k.formatFunction || m.formatFunction || t.formatFunction;
                        var j = o._getDataLen(v);
                        for (var r = 0; r < j; r++) {
                            p = o._getDataValue(r, m.displayText, v);
                            p = o._formatValue(p, h, n, v, q, r);
                            var l = o._getColors(v, q, r);
                            d.push({
                                groupIndex: v,
                                seriesIndex: q,
                                itemIndex: r,
                                text: p,
                                css: m.displayTextClass,
                                fillColor: l.fillColor,
                                lineColor: l.lineColor,
                                opacity: u.opacity
                            })
                        }
                        continue
                    }
                    var h = m.legendFormatSettings || t.legendFormatSettings;
                    var n = m.legendFormatFunction || t.legendFormatFunction;
                    p = o._formatValue(m.displayText || m.dataField || "", h, n, v, q, NaN);
                    var l = o._getSeriesColors(v, q);
                    var f = this._get([m.legendFillColor, m.legendColor, l.fillColor]);
                    var b = this._get([m.legendLineColor, m.legendColor, l.lineColor]);
                    d.push({
                        groupIndex: v,
                        seriesIndex: q,
                        text: p,
                        css: m.displayTextClass,
                        fillColor: f,
                        lineColor: b,
                        opacity: u.opacity
                    })
                }
            }
            return o._renderChartLegend(d, c, e, (o.legendLayout && o.legendLayout.flow == "vertical"))
        },
        _getInterval: function(d, c) {
            if (!d) {
                return c
            }
            var b = this._get([d.unitInterval, c]);
            if (!isNaN(d.step)) {
                b = d.step * c
            }
            return b
        },
        _getOffsets: function(u, d, n, t, r, l, g, e, k) {
            var s = this._getInterval(r[u], e);
            var m = [];
            if (u == "" || (r[u].visible && r[u].visible != "custom")) {
                m = this._generateIntervalValues(t, s, e, g, k)
            }
            var f;
            if (u != "labels") {
                var j = g ? l.left : 0;
                if (!g && e > 1) {
                    j = l.left * (e + 1)
                }
                if (m.length == 1) {
                    j *= 2
                }
                f = this._valuesToOffsets(m, d, t, n, l, false, j);
                if (!g) {
                    var o = (l.left + l.right) * s / e;
                    if (d.flip) {
                        f.unshift(f[0] + o)
                    } else {
                        f.push(f[f.length - 1] + o)
                    }
                }
            } else {
                var j = l.left;
                if (m.length == 1) {
                    j *= 2
                }
                f = this._valuesToOffsets(m, d, t, n, l, g, j)
            }
            var q = this._arraysToObjectsArray([m, f], ["value", "offset"]);
            if (d[u] && d[u].custom) {
                var h = this._objectsArraysToArray(d[u].custom, "value");
                var c = this._objectsArraysToArray(d[u].custom, "offset");
                var b = this._valuesToOffsets(h, d, t, n, l, g, l.left);
                for (var p = 0; p < d[u].custom.length; p++) {
                    q.push({
                        value: h[p],
                        offset: isNaN(c[p]) ? b[p] : c[p]
                    })
                }
            }
            return q
        },
        _renderXAxis: function(d, y, Q, c) {
            var f = this;
            var r = f._getXAxis(d);
            var P = f.seriesGroups[d];
            var W = P.orientation == "horizontal";
            var G = {
                width: 0,
                height: 0
            };
            var O = f._getAxisSettings(r);
            if (!r || !O.visible || P.type == "spider") {
                return G
            }
            if (!f._isGroupVisible(d) || this._isPieGroup(d)) {
                return G
            }
            var V = f._alignValuesWithTicks(d);
            while (f._renderData.length < d + 1) {
                f._renderData.push({})
            }
            if (f.rtl) {
                r.flip = true
            }
            var A = W ? y.height : y.width;
            var w = r.text;
            var t = f._calculateXOffsets(d, A);
            var S = t.axisStats;
            var j = r.rangeSelector;
            var E = 0;
            if (j) {
                if (!this._moduleRangeSelector) {
                    throw "Please include 'jqxchart.rangeselector.js'"
                }
                E = this._selectorGetSize(r)
            }
            var D = (W && r.position == "right") || (!W && r.position == "top");
            if (!Q && j) {
                if (W) {
                    y.width -= E;
                    if (r.position != "right") {
                        y.x += E
                    }
                } else {
                    y.height -= E;
                    if (r.position == "top") {
                        y.y += E
                    }
                }
            }
            var k = {
                rangeLength: t.rangeLength,
                itemWidth: t.itemWidth,
                intervalWidth: t.intervalWidth,
                data: t,
                settings: O,
                isMirror: D,
                rect: y
            };
            f._renderData[d].xAxis = k;
            var F = S.interval;
            if (isNaN(F)) {
                return G
            }
            if (W) {
                O.title.angle -= 90;
                O.labels.angle -= 90
            }
            var m = this._getInterval(O.gridLines, F);
            var J = this._getInterval(O.tickMarks, F);
            var B = this._getInterval(O.labels, F);
            var K;
            var U = S.min;
            var s = S.max;
            var M = t.padding;
            var R = r.flip == true || f.rtl;
            var h = {
                min: U,
                max: s
            };
            if (S.logAxis.enabled) {
                h.min = S.logAxis.minPow;
                h.max = S.logAxis.maxPow
            }
            if (r.type == "date") {
                O.gridLines.offsets = this._generateDTOffsets(U, s, A, M, m, F, S.dateTimeUnit, V, NaN, false, R);
                O.tickMarks.offsets = this._generateDTOffsets(U, s, A, M, J, F, S.dateTimeUnit, V, NaN, false, R);
                K = this._generateDTOffsets(U, s, A, M, B, F, S.dateTimeUnit, V, NaN, true, R)
            } else {
                O.gridLines.offsets = this._getOffsets("gridLines", r, A, S, O, M, V, F);
                O.tickMarks.offsets = this._getOffsets("tickMarks", r, A, S, O, M, V, F);
                K = this._getOffsets("labels", r, A, S, O, M, V, F)
            }
            var n = f.renderer.getRect();
            var l = n.width - y.x - y.width;
            var p = f._getDataLen(d);
            var o;
            if (f._elementRenderInfo && f._elementRenderInfo.length > d) {
                o = f._elementRenderInfo[d].xAxis
            }
            var q = [];
            var I;
            if (O.labels.formatFunction) {
                I = O.labels.formatFunction
            }
            var v;
            if (O.labels.formatSettings) {
                v = a.extend({}, O.labels.formatSettings)
            }
            if (r.type == "date") {
                if (r.dateFormat && !I) {
                    if (v) {
                        v.dateFormat = v.dateFormat || r.dateFormat
                    } else {
                        v = {
                            dateFormat: r.dateFormat
                        }
                    }
                } else {
                    if (!I && (!v || (v && !v.dateFormat))) {
                        I = this._getDefaultDTFormatFn(r.baseUnit || "day")
                    }
                }
            }
            for (var N = 0; N < K.length; N++) {
                var L = K[N].value;
                var H = K[N].offset;
                if (isNaN(H)) {
                    continue
                }
                var T = undefined;
                if (r.type != "date" && S.useIndeces && r.dataField) {
                    T = Math.round(L);
                    L = f._getDataValue(T, r.dataField);
                    if (L == undefined) {
                        L = ""
                    }
                }
                var w = f._formatValue(L, v, I, d, undefined, T);
                if (w == undefined || w.toString() == "") {
                    if (isNaN(T)) {
                        T = N
                    }
                    if (T >= S.filterRange.min && T <= S.filterRange.max) {
                        w = S.useIndeces ? (S.min + T).toString() : (L == undefined ? "" : L.toString())
                    }
                }
                var b = {
                    key: L,
                    text: w,
                    targetX: H,
                    x: H
                };
                if (o && o.itemOffsets[L]) {
                    b.x = o.itemOffsets[L].x;
                    b.y = o.itemOffsets[L].y
                }
                q.push(b)
            }
            var C = f._getAnimProps(d);
            var u = C.enabled && q.length < 500 ? C.duration : 0;
            if (f.enableAxisTextAnimation == false) {
                u = 0
            }
            var z = {
                items: q,
                renderData: k
            };
            var e = f._renderAxis(W, D, O, {
                x: y.x,
                y: y.y,
                width: y.width,
                height: y.height
            }, c, F, false, true, z, Q, u);
            if (W) {
                e.width += E
            } else {
                e.height += E
            }
            return e
        },
        _animateAxisText: function(f, h) {
            var c = f.items;
            var d = f.textSettings;
            for (var e = 0; e < c.length; e++) {
                var g = c[e];
                if (!g) {
                    continue
                }
                if (!g.visible) {
                    continue
                }
                var b = g.targetX;
                var j = g.targetY;
                if (!isNaN(g.x) && !isNaN(g.y)) {
                    b = g.x + (b - g.x) * h;
                    j = g.y + (j - g.y) * h
                }
                if (g.element) {
                    this.renderer.removeElement(g.element);
                    g.element = undefined
                }
                g.element = this.renderer.text(g.text, b, j, g.width, g.height, d.angle, {
                    "class": d.style
                }, false, d.halign, d.valign, d.textRotationPoint)
            }
        },
        _getPolarAxisCoords: function(f, b) {
            var j = this.seriesGroups[f];
            var q = b.x + a.jqx.getNum([j.offsetX, b.width / 2]);
            var p = b.y + a.jqx.getNum([j.offsetY, b.height / 2]);
            var l = Math.min(b.width, b.height);
            var g = j.radius;
            if (this._isPercent(g)) {
                g = parseFloat(g) / 100 * l / 2
            }
            if (isNaN(g)) {
                g = l / 2 * 0.6
            }
            var i = this._alignValuesWithTicks(f);
            var o = this._get([j.startAngle, j.minAngle, 0]) - 90;
            if (isNaN(o)) {
                o = 0
            } else {
                o = 2 * Math.PI * o / 360
            }
            var n = this._get([j.endAngle, j.maxAngle, 360]) - 90;
            if (isNaN(n)) {
                n = 2 * Math.PI
            } else {
                n = 2 * Math.PI * n / 360
            }
            if (o > n) {
                var m = o;
                o = n;
                n = m
            }
            var u = a.jqx._rnd(Math.abs(o - n) / (Math.PI * 2), 0.001, true);
            var r = Math.PI * 2 * g * u;
            var h = this._calcGroupOffsets(f, b).xoffsets;
            if (!h) {
                return
            }
            var k = !(Math.abs(Math.abs(n - o) - Math.PI * 2) > 0.00001);
            if (j.spider) {
                var e = this._getXAxisStats(f, this._getXAxis(f), r);
                var s = e.interval;
                if (isNaN(s) || s == 0) {
                    s = 1
                }
                var d = (e.max - e.min) / s + (k ? 1 : 0);
                d = Math.round(d);
                if (d > 2) {
                    var c = Math.cos(Math.abs(n - o) / 2 / d);
                    c = a.jqx._rnd(c, 0.01);
                    if (c == 0) {
                        c = 1
                    }
                    var t = g / c;
                    if (t > g && i) {
                        g = t
                    }
                }
            }
            g = a.jqx._ptrnd(g);
            return {
                x: q,
                y: p,
                r: g,
                adjR: this._get([t, g]),
                itemWidth: h.itemWidth,
                rangeLength: h.rangeLength,
                valuesOnTicks: i,
                startAngle: o,
                endAngle: n,
                isClosedCircle: k,
                axisSize: r
            }
        },
        _toPolarCoord: function(j, f, h, e) {
            var c = Math.abs(j.startAngle - j.endAngle) / (Math.PI * 2);
            var b = (h - f.x) * 2 * Math.PI * c / Math.max(1, f.width) + j.startAngle;
            var d = ((f.height + f.y) - e) * j.r / Math.max(1, f.height);
            var i = j.x + d * Math.cos(b);
            var g = j.y + d * Math.sin(b);
            return {
                x: a.jqx._ptrnd(i),
                y: a.jqx._ptrnd(g)
            }
        },
        _renderSpiderAxis: function(z, k) {
            var ao = this;
            var g = ao._getXAxis(z);
            var aA = this._getAxisSettings(g);
            if (!g || !aA.visible) {
                return
            }
            var W = ao.seriesGroups[z];
            var R = ao._getPolarAxisCoords(z, k);
            if (!R) {
                return
            }
            var L = a.jqx._ptrnd(R.x);
            var K = a.jqx._ptrnd(R.y);
            var t = R.adjR;
            var X = R.startAngle;
            var V = R.endAngle;
            if (t < 1) {
                return
            }
            var av = a.jqx._rnd(Math.abs(X - V) / (Math.PI * 2), 0.001, true);
            var h = Math.PI * 2 * t * av;
            var c = R.isClosedCircle;
            var w = this._renderData[z].xoffsets;
            if (!w.rangeLength) {
                return
            }
            var S = w.axisStats.interval;
            if (isNaN(S) || S < 1) {
                S = 1
            }
            var ar = W.orientation == "horizontal";
            var Z = (ar && g.position == "right") || (!ar && g.position == "top");
            while (ao._renderData.length < z + 1) {
                ao._renderData.push({})
            }
            var at = {
                rangeLength: w.rangeLength,
                itemWidth: w.itemWidth,
                data: w,
                rect: k,
                settings: aA
            };
            ao._renderData[z].xAxis = at;
            ao._renderData[z].polarCoords = R;
            var ay = true;
            for (var Q = 0; Q < z; Q++) {
                var A = ao._renderData[Q].xAxis;
                var b = ao._renderData[Q].polarCoords;
                var D = ao._getXAxis(Q);
                var U = false;
                for (var O in R) {
                    if (R[O] != b[O]) {
                        U = true;
                        break
                    }
                }
                if (!U || D != g) {
                    ay = false
                }
            }
            var e = aA.gridLines;
            var T = aA.tickMarks;
            var y = aA.labels;
            var ac = this._getInterval(e, S);
            var aD = this._getInterval(T, S);
            var am = this._getInterval(y, S);
            var G = ao._alignValuesWithTicks(z);
            var ad = ao.renderer;
            var ah;
            var ae = w.axisStats;
            var aC = ae.min;
            var r = ae.max;
            var u = this._getPaddingSize(w.axisStats, g, G, h, true, c, false);
            var ai = g.flip == true || ao.rtl;
            if (g.type == "date") {
                e.offsets = this._generateDTOffsets(aC, r, h, u, ac, S, g.baseUnit, true, 0, false, ai);
                T.offsets = this._generateDTOffsets(aC, r, h, u, aD, S, g.baseUnit, true, 0, false, ai);
                ah = this._generateDTOffsets(aC, r, h, u, am, S, g.baseUnit, true, 0, true, ai)
            } else {
                aA.gridLines.offsets = this._getOffsets("gridLines", g, h, ae, aA, u, true, S);
                aA.tickMarks.offsets = this._getOffsets("tickMarks", g, h, ae, aA, u, true, S);
                ah = this._getOffsets("labels", g, h, ae, aA, u, true, S)
            }
            var aj = ao.renderer.getRect();
            var aw = aj.width - k.x - k.width;
            var ag = ao._getDataLen(z);
            var s;
            if (ao._elementRenderInfo && ao._elementRenderInfo.length > z) {
                s = ao._elementRenderInfo[z].xAxis
            }
            var aq = [];
            var af = this._getDataLen(z);
            for (var Q = 0; Q < ah.length; Q++) {
                var F = ah[Q].offset;
                var H = ah[Q].value;
                if (g.type != "date" && ae.useIndeces && g.dataField) {
                    var ax = Math.round(H);
                    if (ax >= af) {
                        continue
                    }
                    H = ao._getDataValue(ax, g.dataField);
                    if (H == undefined) {
                        H = ""
                    }
                }
                var ap = ao._formatValue(H, y.formatSettings, y.formatFunction, z, undefined, ax);
                if (ap == undefined || ap.toString() == "") {
                    ap = ae.useIndeces ? (ae.min + Q).toString() : (H == undefined ? "" : H.toString())
                }
                var d = {
                    key: H,
                    text: ap,
                    targetX: F,
                    x: F
                };
                if (s && s.itemOffsets[H]) {
                    d.x = s.itemOffsets[H].x;
                    d.y = s.itemOffsets[H].y
                }
                aq.push(d)
            }
            var az = {
                items: aq,
                renderData: at
            };
            var l = {
                stroke: e.color,
                fill: "none",
                "stroke-width": 0,
                "stroke-dasharray": e.dashStyle || ""
            };
            if (!W.spider) {
                if (av == 1) {
                    ad.circle(L, K, t, l)
                } else {
                    var E = -X / Math.PI * 180;
                    var aE = -V / Math.PI * 180;
                    this.renderer.pieslice(L, K, 0, t, Math.min(E, aE), Math.max(E, aE), undefined, l)
                }
            }
            var M = aq.length;
            var m = 2 * Math.PI / (M);
            var al = X;
            var f, C;
            if (e.visible && ay) {
                if (!G && !c) {
                    e.offsets.unshift({
                        offset: -u.right
                    })
                }
                for (var Q = 0; Q < e.offsets.length; Q++) {
                    var n = e.offsets[Q].offset;
                    if (!G) {
                        if (c) {
                            n += u.right / 2
                        } else {
                            n += u.right
                        }
                    }
                    var B = al + n * 2 * Math.PI * av / Math.max(1, h);
                    if (B - V > 0.01) {
                        continue
                    }
                    var q = a.jqx._ptrnd(L + t * Math.cos(B));
                    var p = a.jqx._ptrnd(K + t * Math.sin(B));
                    ad.line(L, K, q, p, l)
                }
            }
            if (T.visible && ay) {
                var P = 5;
                var o = {
                    stroke: T.color,
                    fill: "none",
                    "stroke-width": 0,
                    "stroke-dasharray": T.dashStyle || ""
                };
                if (!G && !c) {
                    T.offsets.unshift({
                        offset: -u.right
                    })
                }
                for (var Q = 0; Q < T.offsets.length; Q++) {
                    var n = T.offsets[Q].offset;
                    if (!G) {
                        if (c) {
                            n += u.right / 2
                        } else {
                            n += u.right
                        }
                    }
                    var B = al + n * 2 * Math.PI * av / Math.max(1, h);
                    if (B - V > 0.01) {
                        continue
                    }
                    var ab = {
                        x: L + t * Math.cos(B),
                        y: K + t * Math.sin(B)
                    };
                    var aa = {
                        x: L + (t + P) * Math.cos(B),
                        y: K + (t + P) * Math.sin(B)
                    };
                    ad.line(a.jqx._ptrnd(ab.x), a.jqx._ptrnd(ab.y), a.jqx._ptrnd(aa.x), a.jqx._ptrnd(aa.y), o)
                }
            }
            var an = [];
            if (W.spider) {
                var v = [];
                if (g.type == "date") {
                    v = this._generateDTOffsets(aC, r, h, u, S, S, g.baseUnit, true, 0, false, ai)
                } else {
                    v = this._getOffsets("", g, h, ae, aA, u, true, S)
                }
                if (!G && !c) {
                    v.unshift({
                        offset: -u.right
                    })
                }
                for (var Q = 0; Q < v.length; Q++) {
                    var n = v[Q].offset;
                    if (!G) {
                        if (c) {
                            n += u.right / 2
                        } else {
                            n += u.right
                        }
                    }
                    var B = al + n * 2 * Math.PI * av / Math.max(1, h);
                    if (B - V > 0.01) {
                        continue
                    }
                    an.push(B)
                }
                at.offsetAngles = an
            }
            var Y = ao._renderSpiderValueAxis(z, k, (G ? R.adjR : R.r), an);
            if (!Y) {
                Y = []
            }
            if (W.spider) {
                if (!G) {
                    for (var Q = 0; Q < Y.length; Q++) {
                        Y[Q] = Y[Q] * R.adjR / R.r
                    }
                }
                Y.push(t);
                this._renderSpiderLines(L, K, Y, R, an, l)
            }
            if (ay && y.visible) {
                at.polarLabels = [];
                for (var Q = 0; Q < aq.length; Q++) {
                    var n = aq[Q].x;
                    var B = al + n * 2 * Math.PI * av / Math.max(1, h);
                    B = (360 - B / (2 * Math.PI) * 360) % 360;
                    if (B < 0) {
                        B = 360 + B
                    }
                    var ak = ad.measureText(aq[Q].text, 0, {
                        "class": aA.labels.style
                    });
                    var N = (G ? R.adjR : R.r) + (T.visible ? 7 : 2);
                    var au = aA.labels;
                    var aB;
                    if (au.autoRotate) {
                        var J = a.jqx._ptRotate(L - ak.width / 2, K - N - ak.height, L, K, -B / 180 * Math.PI);
                        var I = a.jqx._ptRotate(L + ak.width / 2, K - N, L, K, -B / 180 * Math.PI);
                        ak.width = Math.abs(J.x - I.x);
                        ak.height = Math.abs(J.y - I.y);
                        aB = {
                            x: Math.min(J.x, I.x),
                            y: Math.min(J.y, I.y)
                        }
                    } else {
                        aB = this._adjustTextBoxPosition(L, K, ak, N, B, false, false, false)
                    }
                    at.polarLabels.push({
                        x: aB.x,
                        y: aB.y,
                        value: aq[Q].text
                    });
                    ad.text(aq[Q].text, aB.x, aB.y, ak.width, ak.height, au.autoRotate ? 90 - B : au.angle, {
                        "class": au.style
                    }, false, au.halign, au.valign)
                }
            }
        },
        _renderSpiderLines: function(h, f, u, m, e, b) {
            var p = this.renderer;
            var q = m.startAngle;
            var o = m.endAngle;
            var g = m.isClosedCircle;
            for (var r = 0; r < u.length; r++) {
                var d = u[r];
                var c = undefined,
                    n = undefined;
                for (var s = 0; s < e.length; s++) {
                    var t = e[s];
                    var l = a.jqx._ptrnd(h + d * Math.cos(t));
                    var k = a.jqx._ptrnd(f + d * Math.sin(t));
                    if (c) {
                        p.line(c.x, c.y, l, k, b)
                    }
                    c = {
                        x: l,
                        y: k
                    };
                    if (!n) {
                        n = {
                            x: l,
                            y: k
                        }
                    }
                }
                if (n && g) {
                    p.line(c.x, c.y, n.x, n.y, b)
                }
            }
        },
        _renderSpiderValueAxis: function(e, F, V, U) {
            var k = this;
            var w = this.seriesGroups[e];
            var G = this._getPolarAxisCoords(e, F);
            if (!G) {
                return
            }
            var R = a.jqx._ptrnd(G.x);
            var Q = a.jqx._ptrnd(G.y);
            V = V || G.r;
            var h = G.startAngle;
            var ac = G.endAngle;
            var Z = a.jqx._rnd(Math.abs(h - ac) / (Math.PI * 2), 0.001, true);
            if (V < 1) {
                return
            }
            V = a.jqx._ptrnd(V);
            var g = this._getValueAxis(e);
            var ab = this._getAxisSettings(g);
            if (!g || false == ab.visible) {
                return
            }
            var N = this._stats.seriesGroups[e].mu;
            var C = ab.labels;
            var B = C.formatSettings;
            var c = w.type.indexOf("stacked") != -1 && w.type.indexOf("100") != -1;
            if (c && !B) {
                B = {
                    sufix: "%"
                }
            }
            var z = this._get([C.step, C.unitInterval / N]);
            if (isNaN(z)) {
                z = 1
            }
            z = Math.max(1, Math.round(z));
            this._calcValueAxisItems(e, V, z);
            var d = ab.gridLines;
            var D = ab.tickMarks;
            var s = this._getInterval(d, N);
            var S = this._getInterval(D, N);
            var n = ab.labels;
            var m = {
                stroke: d.color,
                fill: "none",
                "stroke-width": 0,
                "stroke-dasharray": d.dashStyle || ""
            };
            var q = this._renderData[e].valueAxis;
            var A = q.items;
            var v = h;
            if (A.length && ab.line.visible) {
                if (!isNaN(ab.line.angle)) {
                    v = 2 * Math.PI * ab.line.angle / 360
                }
                var p = R + Math.cos(v) * V;
                var af = Q + Math.sin(v) * V;
                if (U.indexOf(v) == -1) {
                    var X = a.extend({}, m);
                    X["stroke-width"] = 0;
                    X.stroke = ab.line.color;
                    X["stroke-dasharray"] = ab.line.dashStyle;
                    this.renderer.line(R, Q, p, af, X)
                }
            }
            A = A.reverse();
            var K = this.renderer;
            q.polarLabels = [];
            for (var aa = 0; aa < A.length - 1; aa++) {
                var T = A[aa];
                if (isNaN(T)) {
                    continue
                }
                var E = (n.formatFunction) ? n.formatFunction(T) : this._formatNumber(T, B);
                var f = K.measureText(E, 0, {
                    "class": n.style
                });
                var P = R + (g.showTickMarks != false ? 3 : 2);
                var O = Q - q.itemWidth * aa - f.height / 2;
                var J = a.jqx._ptRotate(P, O, R, Q, v);
                var I = a.jqx._ptRotate(P + f.width, O + f.height, R, Q, v);
                P = Math.min(J.x, I.x);
                O = Math.min(J.y, I.y);
                f.width = Math.abs(J.x - I.x);
                f.height = Math.abs(J.y - I.y);
                P += ab.labels.textOffset.x;
                O += ab.labels.textOffset.y;
                q.polarLabels.push({
                    x: P,
                    y: O,
                    value: E
                });
                K.text(E, P, O, f.width, f.height, n.autoRotate ? (90 + h * 180 / Math.PI) : n.angle, {
                    "class": n.style
                }, false, n.halign, n.valign)
            }
            var r = g.logarithmicScale == true;
            var u = r ? A.length : q.rangeLength;
            var l = 2 * Math.PI / u;
            var ae = g.valuesOnTicks != false;
            var M = this._stats.seriesGroups[e];
            var j = M.mu;
            var L = g.logarithmicScale == true;
            var H = g.logarithmicScaleBase || 10;
            if (L) {
                j = 1
            }
            var ad = {
                min: M.min,
                max: M.max,
                logAxis: {
                    enabled: L == true,
                    base: g.logarithmicScaleBase,
                    minPow: M.minPow,
                    maxPow: M.maxPow
                }
            };
            if (d.visible || w.spider || g.alternatingBackgroundColor || g.alternatingBackgroundColor2) {
                d.offsets = this._getOffsets("gridLines", g, V, ad, ab, {
                    left: 0,
                    right: 0
                }, ae, j)
            }
            var W = [];
            if (d.visible || w.spider) {
                var m = {
                    stroke: d.color,
                    fill: "none",
                    "stroke-width": 0,
                    "stroke-dasharray": d.dashStyle || ""
                };
                for (var aa = 0; aa < d.offsets.length; aa++) {
                    var O = a.jqx._ptrnd(d.offsets[aa].offset);
                    if (O == V) {
                        continue
                    }
                    if (w.spider) {
                        W.push(O);
                        continue
                    }
                    if (Z != 1) {
                        var o = -h / Math.PI * 180;
                        var Y = -ac / Math.PI * 180;
                        this.renderer.pieslice(R, Q, 0, O, Math.min(o, Y), Math.max(o, Y), undefined, m)
                    } else {
                        K.circle(R, Q, O, m)
                    }
                }
            }
            if (!g.tickMarks || (!g.tickMarks.visible && !g.showTickMarks)) {
                D.visible = false
            }
            if (D.visible) {
                D.offsets = this._getOffsets("tickMarks", g, V, ad, ab, {
                    left: 0,
                    right: 0
                }, ae, j);
                var t = D.size * 2;
                var m = {
                    stroke: D.color,
                    fill: "none",
                    "stroke-width": 0,
                    "stroke-dasharray": D.dashStyle || ""
                };
                for (var aa = 0; aa < D.offsets.length; aa++) {
                    var b = D.offsets[aa].offset;
                    var J = {
                        x: R + b * Math.cos(v) - t / 2 * Math.sin(v + Math.PI / 2),
                        y: Q + b * Math.sin(v) - t / 2 * Math.cos(v + Math.PI / 2)
                    };
                    var I = {
                        x: R + b * Math.cos(v) + t / 2 * Math.sin(v + Math.PI / 2),
                        y: Q + b * Math.sin(v) + t / 2 * Math.cos(v + Math.PI / 2)
                    };
                    K.line(a.jqx._ptrnd(J.x), a.jqx._ptrnd(J.y), a.jqx._ptrnd(I.x), a.jqx._ptrnd(I.y), m)
                }
            }
            return W
        },
        _renderAxis: function(H, D, Q, z, c, F, m, V, C, U, d) {
            if (Q.customDraw && !U) {
                return {
                    width: NaN,
                    height: NaN
                }
            }
            var t = Q.title,
                n = Q.labels,
                e = Q.gridLines,
                A = Q.tickMarks,
                P = Q.padding;
            var o = A.visible ? A.size : 0;
            var R = 2;
            var G = {
                width: 0,
                height: 0
            };
            var q = {
                width: 0,
                height: 0
            };
            if (H) {
                G.height = q.height = z.height
            } else {
                G.width = q.width = z.width
            }
            if (!U && D) {
                if (H) {
                    z.x -= z.width
                }
            }
            var l = C.renderData;
            var b = l.itemWidth;
            if (t.visible && t.text != undefined && t != "") {
                var p = t.angle;
                var f = this.renderer.measureText(t.text, p, {
                    "class": t.style
                });
                q.width = f.width;
                q.height = f.height;
                if (!U) {
                    this.renderer.text(t.text, z.x + t.offset.x + (H ? (!D ? R + P.left : -P.right - R + 2 * z.width - q.width) : 0), z.y + t.offset.y + (!H ? (!D ? z.height - R - q.height - P.bottom : P.top + R) : 0), H ? q.width : z.width, !H ? q.height : z.height, p, {
                        "class": t.style
                    }, true, t.halign, t.valign, t.rotationPoint)
                }
            }
            var L = 0;
            var u = V ? -b / 2 : 0;
            if (V && !H) {
                n.halign = "center"
            }
            var N = z.x;
            var M = z.y;
            var E = n.textOffset;
            if (E) {
                if (!isNaN(E.x)) {
                    N += E.x
                }
                if (!isNaN(E.y)) {
                    M += E.y
                }
            }
            if (!H) {
                N += u;
                if (D) {
                    M += q.height > 0 ? q.height + 3 * R : 2 * R;
                    M += o - (V ? o : o / 4)
                } else {
                    M += V ? o : o / 4
                }
                M += P.top
            } else {
                N += P.left + R + (q.width > 0 ? q.width + R : 0) + (D ? z.width - q.width : 0);
                M += u
            }
            var T = 0;
            var K = 0;
            var r = C.items;
            l.itemOffsets = {};
            if (this._isToggleRefresh || !this._isUpdate) {
                d = 0
            }
            var k = false;
            var j = 0;
            for (var S = 0; S < r.length && n.visible; S++, L += b) {
                if (!r[S] || isNaN(b)) {
                    continue
                }
                var v = r[S].text;
                if (!isNaN(r[S].targetX)) {
                    L = r[S].targetX
                }
                var f = this.renderer.measureText(v, n.angle, {
                    "class": n.style
                });
                if (f.width > K) {
                    K = f.width
                }
                if (f.height > T) {
                    T = f.height
                }
                j += H ? T : K;
                if (!U) {
                    if ((H && L > z.height + 2) || (!H && L > z.width + 2)) {
                        continue
                    }
                    var J = H ? N + (D ? (q.width == 0 ? o : o - R) : 0) : N + L;
                    var I = H ? M + L : M;
                    l.itemOffsets[r[S].key] = {
                        x: J,
                        y: I
                    };
                    if (!k) {
                        if (!isNaN(r[S].x) || !isNaN(r[S].y) && d) {
                            k = true
                        }
                    }
                    r[S].targetX = J;
                    r[S].targetY = I;
                    r[S].width = !H ? b : z.width - P.left - P.right - 2 * R - o - ((q.width > 0) ? q.width + R : 0);
                    r[S].height = H ? b : z.height - P.top - P.bottom - 2 * R - o - ((q.height > 0) ? q.height + R : 0);
                    r[S].visible = true
                }
            }
            l.avgWidth = r.length == 0 ? 0 : j / r.length;
            if (!U) {
                var s = {
                    items: r,
                    textSettings: n
                };
                if (isNaN(d) || !k) {
                    d = 0
                }
                this._animateAxisText(s, d == 0 ? 1 : 0);
                if (d != 0) {
                    var g = this;
                    this._enqueueAnimation("series", undefined, undefined, d, function(i, h, w) {
                        g._animateAxisText(h, w)
                    }, s)
                }
            }
            G.width += 2 * R + o + q.width + K + (H && q.width > 0 ? R : 0);
            G.height += 2 * R + o + q.height + T + (!H && q.height > 0 ? R : 0);
            if (!H) {
                G.height += P.top + P.bottom
            } else {
                G.width += P.left + P.right
            }
            var B = {};
            if (!U && Q.line.visible) {
                var O = {
                    stroke: Q.line.color,
                    "stroke-width": 0,
                    "stroke-dasharray": Q.line.dashStyle || ""
                };
                if (H) {
                    var J = z.x + z.width + (D ? P.left : -P.right);
                    J = a.jqx._ptrnd(J);
                    this.renderer.line(J, z.y, J, z.y + z.height, O)
                } else {
                    var I = a.jqx._ptrnd(z.y + (D ? z.height - P.bottom : P.top));
                    this.renderer.line(a.jqx._ptrnd(z.x), I, a.jqx._ptrnd(z.x + z.width + 1), I, O)
                }
            }
            G.width = a.jqx._rup(G.width);
            G.height = a.jqx._rup(G.height);
            return G
        },
        _drawPlotAreaLines: function(j, z, f) {
            var E = this.seriesGroups[j];
            var c = E.orientation != "horizontal";
            if (!this._renderData || this._renderData.length <= j) {
                return
            }
            var J = z ? "valueAxis" : "xAxis";
            var v = this._renderData[j][J];
            if (!v) {
                return
            }
            var n = this._renderData.axisDrawState;
            if (!n) {
                n = this._renderData.axisDrawState = {}
            }
            var A = "",
                h;
            if (z) {
                A = "valueAxis_" + ((E.valueAxis) ? j : "") + (c ? "swap" : "");
                h = this._getValueAxis(j)
            } else {
                A = "xAxis_" + ((E.xAxis || E.categoryAxis) ? j : "") + (c ? "swap" : "");
                h = this._getXAxis(j)
            }
            if (n[A]) {
                n = n[A]
            } else {
                n = n[A] = {}
            }
            if (!z) {
                c = !c
            }
            var H = v.settings;
            if (!H) {
                return
            }
            if (H.customDraw) {
                return
            }
            var G = H.gridLines,
                q = H.tickMarks,
                u = H.padding;
            var e = v.rect;
            var l = this._plotRect;
            if (!G || !q) {
                return
            }
            var p = 0.5;
            var d = {};
            var b = {
                stroke: G.color,
                "stroke-width": 0,
                "stroke-dasharray": G.dashStyle || ""
            };
            var D = z ? e.y + e.height : e.x;
            var o = G.offsets;
            if (z && !h.flip) {
                o = a.extend([], o);
                o = o.reverse()
            }
            if (o && o.length > 0) {
                var k = NaN;
                var C = o.length;
                for (var B = 0; B < o.length; B++) {
                    if (c) {
                        var F = a.jqx._ptrnd(e.y + o[B].offset);
                        if (F < e.y - p) {
                            F = a.jqx._ptrnd(e.y)
                        }
                        if (F > e.y + e.height) {
                            F = e.y + e.height
                        }
                    } else {
                        F = a.jqx._ptrnd(e.x + o[B].offset);
                        if (F > e.x + e.width + p) {
                            F = a.jqx._ptrnd(e.x + e.width)
                        }
                    }
                    if (isNaN(F)) {
                        continue
                    }
                    if (!isNaN(k) && Math.abs(F - k) < 2) {
                        continue
                    }
                    k = F;
                    if (f.gridLines && G.visible != false && n.gridLines != true) {
                        if (c) {
                            this.renderer.line(a.jqx._ptrnd(l.x), F, a.jqx._ptrnd(l.x + l.width), F, b)
                        } else {
                            this.renderer.line(F, a.jqx._ptrnd(l.y), F, a.jqx._ptrnd(l.y + l.height), b)
                        }
                    }
                    d[F] = true;
                    if (f.alternatingBackground && (G.alternatingBackgroundColor || G.alternatingBackgroundColor2) && n.alternatingBackground != true) {
                        var m = ((B % 2) == 0) ? G.alternatingBackgroundColor2 : G.alternatingBackgroundColor;
                        if (B > 0 && m) {
                            var I;
                            if (c) {
                                I = this.renderer.rect(a.jqx._ptrnd(l.x), D, a.jqx._ptrnd(l.width - 1), F - D, b)
                            } else {
                                I = this.renderer.rect(D, a.jqx._ptrnd(l.y), F - D, a.jqx._ptrnd(l.height), b)
                            }
                            this.renderer.attr(I, {
                                "stroke-width": 0,
                                fill: m,
                                opacity: G.alternatingBackgroundOpacity || 1
                            })
                        }
                    }
                    D = F
                }
            }
            var b = {
                stroke: q.color,
                "stroke-width": 0,
                "stroke-dasharray": q.dashStyle || ""
            };
            if (f.tickMarks && q.visible && n.tickMarks != true) {
                var t = q.size;
                var o = q.offsets;
                var k = NaN;
                for (var B = 0; B < o.length; B++) {
                    if (c) {
                        F = a.jqx._ptrnd(e.y + o[B].offset);
                        if (F < e.y - p) {
                            F = a.jqx._ptrnd(e.y)
                        }
                        if (F > e.y + e.height) {
                            F = e.y + e.height
                        }
                    } else {
                        F = a.jqx._ptrnd(e.x + o[B].offset);
                        if (F > e.x + e.width + p) {
                            F = a.jqx._ptrnd(e.x + e.width)
                        }
                    }
                    if (isNaN(F)) {
                        continue
                    }
                    if (!isNaN(k) && Math.abs(F - k) < 2) {
                        continue
                    }
                    if (d[F - 1]) {
                        F--
                    } else {
                        if (d[F + 1]) {
                            F++
                        }
                    }
                    if (c) {
                        if (F > e.y + e.height + p) {
                            break
                        }
                    } else {
                        if (F > e.x + e.width + p) {
                            break
                        }
                    }
                    k = F;
                    var w = !v.isMirror ? -t : t;
                    if (c) {
                        var s = e.x + e.width + (h.position == "right" ? u.left : -u.right);
                        if (!z) {
                            s = e.x + (v.isMirror ? u.left : -u.right + e.width)
                        }
                        this.renderer.line(s, F, s + w, F, b)
                    } else {
                        var r = e.y + (v.isMirror ? e.height : 0);
                        r += v.isMirror ? -u.bottom : u.top;
                        r = a.jqx._ptrnd(r);
                        this.renderer.line(F, r, F, r - w, b)
                    }
                }
            }
            n.tickMarks = n.tickMarks || f.tickMarks;
            n.gridLines = n.gridLines || f.gridLines;
            n.alternatingBackground = n.alternatingBackground || f.alternatingBackground
        },
        _calcValueAxisItems: function(j, d, l) {
            var n = this._stats.seriesGroups[j];
            if (!n || !n.isValid) {
                return false
            }
            var w = this.seriesGroups[j];
            var b = w.orientation == "horizontal";
            var f = this._getValueAxis(j);
            var m = f.valuesOnTicks != false;
            var e = f.dataField;
            var o = n.intervals;
            var s = d / o;
            var u = n.min;
            var r = n.mu;
            var c = f.logarithmicScale == true;
            var k = f.logarithmicScaleBase || 10;
            var h = w.type.indexOf("stacked") != -1 && w.type.indexOf("100") != -1;
            if (c) {
                r = !isNaN(f.unitInterval) ? f.unitInterval : 1
            }
            if (!m) {
                o = Math.max(o - 1, 1)
            }
            while (this._renderData.length < j + 1) {
                this._renderData.push({})
            }
            this._renderData[j].valueAxis = {};
            var q = this._renderData[j].valueAxis;
            q.itemWidth = q.intervalWidth = s;
            q.items = [];
            var p = q.items;
            for (var v = 0; v <= o; v++) {
                var t = 0;
                if (c) {
                    if (h) {
                        t = n.max / Math.pow(k, o - v)
                    } else {
                        t = u * Math.pow(k, v)
                    }
                } else {
                    t = m ? u + v * r : u + (v + 0.5) * r
                }
                if (v % l != 0) {
                    p.push(NaN);
                    continue
                }
                p.push(t)
            }
            q.rangeLength = c && !h ? n.intervals : (n.intervals) * r;
            if (f.flip != true) {
                p = p.reverse()
            }
            return true
        },
        _getDecimalPlaces: function(b, g, c) {
            var h = 0;
            if (isNaN(c)) {
                c = 10
            }
            for (var f = 0; f < b.length; f++) {
                var k = g === undefined ? b[f] : b[f][g];
                if (isNaN(k)) {
                    continue
                }
                var d = k.toString();
                for (var e = 0; e < d.length; e++) {
                    if (d[e] < "0" || d[e] > "9") {
                        h = d.length - (e + 1);
                        if (h >= 0) {
                            return Math.min(h, c)
                        }
                    }
                }
                if (h > 0) {
                    k *= Math.pow(10, h)
                }
                while (Math.round(k) != k && h < c) {
                    h++;
                    k *= 10
                }
            }
            return h
        },
        _renderValueAxis: function(f, x, L, e) {
            var K = this.seriesGroups[f];
            var P = K.orientation == "horizontal";
            var r = this._getValueAxis(f);
            if (!r) {
                throw "SeriesGroup " + f + " is missing valueAxis definition"
            }
            var E = {
                width: 0,
                height: 0
            };
            if (!this._isGroupVisible(f) || this._isPieOnlySeries() || K.type == "spider") {
                return E
            }
            var O = r.valuesOnTicks != false;
            var F = this._stats.seriesGroups[f];
            var j = F.mu;
            var D = r.logarithmicScale == true;
            var A = r.logarithmicScaleBase || 10;
            if (D) {
                j = !isNaN(r.unitInterval) ? r.unitInterval : 1
            }
            if (j == 0) {
                j = 1
            }
            if (isNaN(j)) {
                return E
            }
            var I = this._getAxisSettings(r);
            var q = I.title,
                t = I.labels;
            var k = r.labels || {};
            var v = this._get([r.horizontalTextAlignment, k.horizontalAlignment]);
            if (!v && t.angle == 0) {
                t.halign = P ? "center" : (r.position == "right" ? "left" : "right")
            }
            var o = this._get([t.step, t.unitInterval / j]);
            if (isNaN(o)) {
                o = 1
            }
            o = Math.max(1, Math.round(o));
            if (!this._calcValueAxisItems(f, (P ? x.width : x.height), o) || !I.visible) {
                return E
            }
            if (!P) {
                q.angle = (!this.rtl ? -90 : 90);
                if (q.rotationPoint == "centercenter") {
                    if (q.valign == "top") {
                        q.rotationPoint = "rightcenter"
                    } else {
                        if (q.valign == "bottom") {
                            q.rotationPoint = "leftcenter"
                        }
                    }
                }
            }
            var l = this._renderData[f].valueAxis;
            var h = t.formatSettings;
            var c = K.type.indexOf("stacked") != -1 && K.type.indexOf("100") != -1;
            if (c && !h) {
                h = {
                    sufix: "%"
                }
            }
            if (!t.formatFunction && (!h || !h.decimalPlaces)) {
                h = h || {};
                h.decimalPlaces = this._getDecimalPlaces([F.min, F.max, j], undefined, 3)
            }
            var d = I.gridLines;
            var m = D ? j : this._getInterval(d, j);
            var z = P ? x.width : x.height;
            var M = (r.flip == true);
            r.flip = !M;
            var N = {
                min: F.min,
                max: F.max,
                logAxis: {
                    enabled: D == true,
                    base: A,
                    minPow: F.minPow,
                    maxPow: F.maxPow
                }
            };
            if (d.visible || r.alternatingBackgroundColor || r.alternatingBackgroundColor2) {
                d.offsets = this._getOffsets("gridLines", r, z, N, I, {
                    left: 0,
                    right: 0
                }, O, j)
            }
            var u = I.tickMarks;
            if (u.visible) {
                u.offsets = this._getOffsets("tickMarks", r, z, N, I, {
                    left: 0,
                    right: 0
                }, O, j)
            }
            var G = this._getOffsets("labels", r, z, N, I, {
                left: 0,
                right: 0
            }, O, j, !O);
            r.flip = M;
            var p = [];
            var n;
            if (this._elementRenderInfo && this._elementRenderInfo.length > f) {
                n = this._elementRenderInfo[f].valueAxis
            }
            for (var J = 0; J < G.length; J++) {
                var H = G[J].value;
                if (isNaN(G[J].offset)) {
                    p.push(undefined);
                    continue
                }
                var w = (t.formatFunction) ? t.formatFunction(H) : (!isNaN(H)) ? this._formatNumber(H, h) : H;
                var b = {
                    key: H,
                    text: w
                };
                if (n && n.itemOffsets[H]) {
                    b.x = n.itemOffsets[H].x;
                    b.y = n.itemOffsets[H].y
                }
                b.targetX = G[J].offset;
                if (!isNaN(b.targetX)) {
                    p.push(b)
                }
            }
            var C = (P && r.position == "top") || (!P && r.position == "right") || (!P && this.rtl && r.position != "left");
            var y = {
                items: p,
                renderData: l
            };
            var B = this._getAnimProps(f);
            var s = B.enabled && p.length < 500 ? B.duration : 0;
            if (this.enableAxisTextAnimation == false) {
                s = 0
            }
            l.settings = I;
            l.isMirror = C;
            l.rect = x;
            return this._renderAxis(!P, C, I, x, e, j, D, true, y, L, s)
        },
        _objectsArraysToArray: function(e, d) {
            var b = [];
            if (!a.isArray(e)) {
                return b
            }
            for (var c = 0; c < e.length; c++) {
                b.push(e[c][d])
            }
            return b
        },
        _arraysToObjectsArray: function(f, e) {
            var c = [];
            if (f.length != e.length) {
                return c
            }
            for (var d = 0; d < f.length; d++) {
                for (var b = 0; b < f[d].length; b++) {
                    if (c.length <= b) {
                        c.push({})
                    }
                    c[b][e[d]] = f[d][b]
                }
            }
            return c
        },
        _valuesToOffsets: function(q, e, l, r, p, f, c) {
            var h = [];
            if (!e || !a.isArray(q)) {
                return h
            }
            var d = l.logAxis.base;
            var m = l.logAxis.enabled ? "logarithmic" : "linear";
            var k = e.flip;
            var o = r;
            var b = 0,
                g = 0;
            if (p && !isNaN(p.left)) {
                b = p.left
            }
            if (p && !isNaN(p.right)) {
                g = p.right
            }
            o = r - b - g;
            r = o;
            for (var j = 0; j < q.length; j++) {
                var n = this._jqxPlot.scale(q[j], {
                    min: l.min.valueOf(),
                    max: l.max.valueOf(),
                    type: m,
                    base: d
                }, {
                    min: 0,
                    max: f ? r : o,
                    flip: k
                }, {});
                if (!isNaN(n)) {
                    if (!isNaN(c)) {
                        n += c
                    }
                    if (n <= r + b + g + 1) {
                        h.push(a.jqx._ptrnd(n))
                    } else {
                        h.push(NaN)
                    }
                } else {
                    h.push(NaN)
                }
            }
            return h
        },
        _generateIntervalValues: function(n, c, b, d, e) {
            var j = [];
            var g = n.min;
            var m = n.max;
            if (n.logAxis && n.logAxis.enabled) {
                g = n.logAxis.minPow;
                m = n.logAxis.maxPow
            }
            if (g == undefined || m == undefined) {
                return j
            }
            if (g == m) {
                if (n.logAxis && n.logAxis.enabled) {
                    return [Math.pow(n.logAxis.base, g)]
                } else {
                    return [g]
                }
            }
            var l = 1;
            if (b < 1) {
                l = 1000000;
                g *= l;
                m *= l;
                b *= l
            }
            for (var h = g; h <= m; h += b) {
                j.push(h / l + (e ? b / 2 : 0))
            }
            if (c > b) {
                var f = [];
                var k = Math.round(c / b);
                for (var h = 0; h < j.length; h++) {
                    if ((h % k) == 0) {
                        f.push(j[h])
                    }
                }
                j = f
            }
            if (n.logAxis && n.logAxis.enabled) {
                for (var h = 0; h < j.length; h++) {
                    j[h] = Math.pow(n.logAxis.base, j[h])
                }
            }
            return j
        },
        _generateDTOffsets: function(p, s, x, n, y, c, o, b, u, v, g) {
            if (!o) {
                o = "day"
            }
            var f = [];
            if (p > s) {
                return f
            }
            if (p == s) {
                if (v) {
                    f.push({
                        offset: b ? x / 2 : n.left,
                        value: p
                    })
                } else {
                    if (b) {
                        f.push({
                            offset: x / 2,
                            value: p
                        })
                    }
                }
                return f
            }
            var j = x - n.left - n.right;
            var w = p;
            var k = n.left;
            var e = k;
            c = Math.max(c, 1);
            var m = c;
            var d = Math.min(1, c);
            if (c > 1 && o != "millisecond") {
                c = 1
            }
            while (a.jqx._ptrnd(e) <= a.jqx._ptrnd(n.left + j + (b ? 0 : n.right))) {
                f.push({
                    offset: e,
                    value: w
                });
                var z = new Date(w.valueOf());
                if (o == "millisecond") {
                    z.setMilliseconds(w.getMilliseconds() + c)
                } else {
                    if (o == "second") {
                        z.setSeconds(w.getSeconds() + c)
                    } else {
                        if (o == "minute") {
                            z.setMinutes(w.getMinutes() + c)
                        } else {
                            if (o == "hour") {
                                var l = z.valueOf();
                                z.setHours(w.getHours() + c);
                                if (l == z.valueOf()) {
                                    z.setHours(w.getHours() + c + 1)
                                }
                            } else {
                                if (o == "day") {
                                    z.setDate(w.getDate() + c)
                                } else {
                                    if (o == "month") {
                                        z.setMonth(w.getMonth() + c)
                                    } else {
                                        if (o == "year") {
                                            z.setFullYear(w.getFullYear() + c)
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
                w = z;
                e = k + (w.valueOf() - p.valueOf()) * d / (s.valueOf() - p.valueOf()) * j
            }
            if (g) {
                for (var r = 0; r < f.length; r++) {
                    f[r].offset = x - f[r].offset
                }
            }
            if (m > 1 && o != "millisecond") {
                var q = [];
                for (var r = 0; r < f.length; r += m) {
                    q.push({
                        offset: f[r].offset,
                        value: f[r].value
                    })
                }
                f = q
            }
            if (!b && !v && f.length > 1) {
                var q = [];
                q.push({
                    offset: 0,
                    value: undefined
                });
                for (var r = 1; r < f.length; r++) {
                    q.push({
                        offset: f[r - 1].offset + (f[r].offset - f[r - 1].offset) / 2,
                        value: undefined
                    })
                }
                var t = q.length;
                if (t > 1) {
                    q.push({
                        offset: q[t - 1].offset + (q[t - 1].offset - q[t - 2].offset)
                    })
                } else {
                    q.push({
                        offset: x,
                        value: undefined
                    })
                }
                f = q
            }
            if (y > c) {
                var q = [];
                var h = Math.round(y / m);
                for (var r = 0; r < f.length; r++) {
                    if ((r % h) == 0) {
                        q.push({
                            offset: f[r].offset,
                            value: f[r].value
                        })
                    }
                }
                f = q
            }
            return f
        },
        _hasStackValueReversal: function(e, s) {
            var g = this.seriesGroups[e];
            var h = -1 != g.type.indexOf("stacked");
            if (!h) {
                return false
            }
            var b = -1 != g.type.indexOf("waterfall");
            var q = this._getDataLen(e);
            var t = 0;
            var l = false;
            var v = [];
            for (var o = 0; o < g.series.length; o++) {
                v[o] = this._isSerieVisible(e, o)
            }
            for (var p = 0; p < q; p++) {
                var m = (b && p != 0) ? t : s;
                var d = 0,
                    r = 0;
                var c = undefined;
                if (!b) {
                    l = false
                }
                for (var n = 0; n < g.series.length; n++) {
                    if (!v[n]) {
                        continue
                    }
                    var u = this._getDataValueAsNumber(p, g.series[n].dataField, e);
                    if (isNaN(u)) {
                        continue
                    }
                    if (g.series[n].summary) {
                        var f = this._getDataValue(p, g.series[n].summary, e);
                        if (undefined !== f) {
                            continue
                        }
                    }
                    var k = !l ? u < s : u < 0;
                    l = true;
                    if (c == undefined) {
                        c = k
                    }
                    if (k != c) {
                        return true
                    }
                    c = k;
                    t += u
                }
            }
            return false
        },
        _getValueAxis: function(b) {
            var c = b == undefined ? this.valueAxis : this.seriesGroups[b].valueAxis || this.valueAxis;
            if (!c) {
                c = this.valueAxis = {}
            }
            return c
        },
        _buildStats: function(H) {
            var U = {
                seriesGroups: []
            };
            this._stats = U;
            for (var s = 0; s < this.seriesGroups.length; s++) {
                var A = this.seriesGroups[s];
                U.seriesGroups[s] = {};
                var D = this._getXAxis(s);
                var n = this._getValueAxis(s);
                var q = this._getXAxisStats(s, D, (A.orientation != "horizontal") ? H.width : H.height);
                var x = U.seriesGroups[s];
                x.isValid = true;
                var I = (A.orientation == "horizontal") ? H.width : H.height;
                var K = n.logarithmicScale == true;
                var J = n.logarithmicScaleBase;
                if (isNaN(J)) {
                    J = 10
                }
                var E = -1 != A.type.indexOf("stacked");
                var e = E && -1 != A.type.indexOf("100");
                var G = -1 != A.type.indexOf("range");
                var Q = A.type.indexOf("waterfall") != -1;
                if (Q && !this._moduleWaterfall) {
                    throw "Please include 'jqxchart.waterfall.js'"
                }
                if (e) {
                    x.psums = [];
                    x.nsums = []
                }
                var t = NaN,
                    M = NaN;
                var d = NaN,
                    f = NaN;
                var r = n ? n.baselineValue : NaN;
                if (isNaN(r)) {
                    r = K && !e ? 1 : 0
                }
                var g = false;
                if (r != 0 && E) {
                    g = this._hasStackValueReversal(s, r);
                    if (g) {
                        r = 0
                    }
                }
                if (E && Q) {
                    g = this._hasStackValueReversal(s, r)
                }
                var z = this._getDataLen(s);
                var c = 0;
                var V = NaN;
                var m = [];
                if (Q) {
                    for (var k = 0; k < A.series.length; k++) {
                        m.push(NaN)
                    }
                }
                var v = NaN;
                for (var T = 0; T < z && x.isValid; T++) {
                    if (D.rangeSelector) {
                        var h = D.dataField ? this._getDataValue(T, D.dataField, s) : T;
                        if (h && q.isDateTime) {
                            h = this._castAsDate(h, D.dateFormat)
                        }
                        if (q.useIndeces) {
                            h = T
                        }
                        if (h && (h.valueOf() < q.min.valueOf() || h.valueOf() > q.max.valueOf())) {
                            continue
                        }
                    }
                    var W = n.minValue;
                    var C = n.maxValue;
                    if (n.baselineValue) {
                        if (isNaN(W)) {
                            W = r
                        } else {
                            W = Math.min(r, W)
                        }
                        if (isNaN(C)) {
                            C = r
                        } else {
                            C = Math.max(r, C)
                        }
                    }
                    var u = 0,
                        w = 0;
                    for (var k = 0; A.series && k < A.series.length; k++) {
                        if (!this._isSerieVisible(s, k)) {
                            continue
                        }
                        var F = NaN,
                            P = NaN,
                            y = NaN;
                        if (A.type.indexOf("candle") != -1 || A.type.indexOf("ohlc") != -1) {
                            var b = ["Open", "Low", "Close", "High"];
                            for (var R in b) {
                                var l = this._getDataValueAsNumber(T, A.series[k]["dataField" + b[R]], s);
                                if (isNaN(l)) {
                                    continue
                                }
                                y = isNaN(P) ? l : Math.min(y, l);
                                P = isNaN(P) ? l : Math.max(P, l)
                            }
                        } else {
                            if (G) {
                                var X = this._getDataValueAsNumber(T, A.series[k].dataFieldFrom, s);
                                var B = this._getDataValueAsNumber(T, A.series[k].dataFieldTo, s);
                                P = Math.max(X, B);
                                y = Math.min(X, B)
                            } else {
                                F = this._getDataValueAsNumber(T, A.series[k].dataField, s);
                                if (Q) {
                                    if (this._isSummary(s, T)) {
                                        var S = this._getDataValue(T, A.series[k].summary, s);
                                        if (S !== undefined) {
                                            continue
                                        }
                                    }
                                    if (!E) {
                                        if (isNaN(m[k])) {
                                            m[k] = F
                                        } else {
                                            F += m[k]
                                        }
                                        m[k] = F
                                    } else {
                                        if (!isNaN(v)) {
                                            F += v
                                        }
                                        v = F
                                    }
                                }
                                if (isNaN(F) || (K && F <= 0)) {
                                    continue
                                }
                                y = P = F
                            }
                        }
                        if ((isNaN(C) || P > C) && ((isNaN(n.maxValue)) ? true : P <= n.maxValue)) {
                            C = P
                        }
                        if ((isNaN(W) || y < W) && ((isNaN(n.minValue)) ? true : y >= n.minValue)) {
                            W = y
                        }
                        if (!isNaN(F) && E && !Q) {
                            if (F > r) {
                                u += F
                            } else {
                                if (F < r) {
                                    w += F
                                }
                            }
                        }
                    }
                    if (!e) {
                        if (!isNaN(n.maxValue)) {
                            u = Math.min(n.maxValue, u)
                        }
                        if (!isNaN(n.minValue)) {
                            w = Math.max(n.minValue, w)
                        }
                    }
                    if (K && e) {
                        for (var k = 0; k < A.series.length; k++) {
                            if (!this._isSerieVisible(s, k)) {
                                V = 0.01;
                                continue
                            }
                            var F = this._getDataValueAsNumber(T, A.series[k].dataField, s);
                            if (isNaN(F) || F <= 0) {
                                V = 0.01;
                                continue
                            }
                            var N = u == 0 ? 0 : F / u;
                            if (isNaN(V) || N < V) {
                                V = N
                            }
                        }
                    }
                    var o = u - w;
                    if (c < o) {
                        c = o
                    }
                    if (e) {
                        x.psums[T] = u;
                        x.nsums[T] = w
                    }
                    if (C > M || isNaN(M)) {
                        M = C
                    }
                    if (W < t || isNaN(t)) {
                        t = W
                    }
                    if (u > d || isNaN(d)) {
                        d = u
                    }
                    if (w < f || isNaN(f)) {
                        f = w
                    }
                }
                if (e) {
                    d = d == 0 ? 0 : Math.max(d, -f);
                    f = f == 0 ? 0 : Math.min(f, -d)
                }
                if (t == M) {
                    if (!isNaN(n.minValue) && isNaN(n.maxValue)) {
                        t = n.minValue;
                        M = K ? t * J : t + 1
                    } else {
                        if (isNaN(n.minValue) && !isNaN(n.maxValue)) {
                            M = n.maxValue;
                            t = K ? M / J : M - 1
                        }
                    }
                }
                if (t == M) {
                    if (t == 0) {
                        t = -1;
                        M = 1
                    } else {
                        if (t < 0) {
                            M = 0
                        } else {
                            if (!K) {
                                t = 0
                            } else {
                                if (t == 1) {
                                    t = t / J;
                                    M = M * J
                                }
                            }
                        }
                    }
                }
                var O = {
                    gmin: t,
                    gmax: M,
                    gsumP: d,
                    gsumN: f,
                    gbase: r,
                    isLogAxis: K,
                    logBase: J,
                    minPercent: V,
                    gMaxRange: c,
                    isStacked: E,
                    isStacked100: e,
                    isWaterfall: Q,
                    hasStackValueReversal: g,
                    valueAxis: n,
                    valueAxisSize: I
                };
                if (O.isStacked) {
                    if (O.gsumN < 0) {
                        O.gmin = Math.min(O.gmin, O.gbase + O.gsumN)
                    }
                    if (O.gsumP > 0) {
                        O.gmax = Math.max(O.gmax, O.gbase + O.gsumP)
                    }
                }
                x.context = O
            }
            this._mergeCommonValueAxisStats();
            for (var T = 0; T < U.seriesGroups.length; T++) {
                var x = U.seriesGroups[T];
                if (!x.isValid) {
                    continue
                }
                var L = this._calcOutputGroupStats(x.context);
                for (var R in L) {
                    x[R] = L[R]
                }
                delete x.context
            }
        },
        _mergeCommonValueAxisStats: function() {
            var f = {};
            for (var e = 0; e < this.seriesGroups.length; e++) {
                if (!this._isGroupVisible(e)) {
                    continue
                }
                if (this.seriesGroups[e].valueAxis) {
                    continue
                }
                var d = this._stats.seriesGroups[e].context;
                f.gbase = d.gbase;
                if (isNaN(f.gmin) || d.gmin < f.gmin) {
                    f.gmin = d.gmin
                }
                if (isNaN(f.gmax) || d.gmax > f.gmax) {
                    f.gmax = d.gmax
                }
                if (isNaN(f.gsumP) || d.gsumP > f.gsumP) {
                    f.gsumP = d.gsumP
                }
                if (isNaN(f.gsumN) || d.gsumN < f.gsumN) {
                    f.gsumN = d.gsumN
                }
                if (isNaN(f.logBase) || d.logBase < f.logBase) {
                    f.logBase = d.logBase
                }
                if (isNaN(f.minPercent) || d.minPercent < f.minPercent) {
                    f.minPercent = d.minPercent
                }
                if (f.gsumN > 0) {
                    f.gmin = Math.min(f.gmin, f.gbase + f.gsumN)
                }
                if (f.gsumP > 0) {
                    f.gmax = Math.max(f.gmax, f.gbase + f.gsumP)
                }
            }
            for (var e = 0; e < this.seriesGroups.length; e++) {
                if (this.seriesGroups[e].valueAxis) {
                    continue
                }
                var b = this._stats.seriesGroups[e].context;
                for (var c in f) {
                    b[c] = f[c]
                }
            }
        },
        _calcOutputGroupStats: function(g) {
            var c = g.gmin,
                f = g.gmax,
                y = g.gsumP,
                z = g.gsumN,
                x = g.gbase,
                d = g.isLogAxis,
                j = g.logBase,
                t = g.minPercent,
                k = g.gMaxRange,
                l = g.isStacked,
                h = g.isStacked100,
                e = g.isWaterfall,
                n = g.hasStackValueReversal,
                w = g.valueAxis,
                u = g.valueAxisSize;
            var s = g.valueAxis.unitInterval;
            if (!s) {
                s = this._calcInterval(c, f, Math.max(u / 80, 2))
            }
            if (c == f) {
                c = x;
                f = 2 * f
            }
            var i = NaN;
            var b = 0;
            var q = 0;
            if (d) {
                if (h) {
                    i = 0;
                    var r = 1;
                    b = q = a.jqx.log(100, j);
                    while (r > t) {
                        r /= j;
                        b--;
                        i++
                    }
                    c = Math.pow(j, b)
                } else {
                    if (l && !e) {
                        f = Math.max(f, y)
                    }
                    q = a.jqx._rnd(a.jqx.log(f, j), 1, true);
                    f = Math.pow(j, q);
                    b = a.jqx._rnd(a.jqx.log(c, j), 1, false);
                    c = Math.pow(j, b)
                }
                s = j
            }
            if (c < z) {
                z = c
            }
            if (f > y) {
                y = f
            }
            var v = c;
            var o = f;
            if (!d) {
                if (0 != Math.abs(o - v) % s) {
                    v = a.jqx._rnd(c, s, false);
                    o = a.jqx._rnd(f, s, true)
                }
            }
            if (h && o > 100) {
                o = 100
            }
            if (h && !d) {
                o = (o > 0) ? 100 : 0;
                v = (v < 0) ? -100 : 0;
                s = w.unitInterval;
                if (isNaN(s) || s <= 0 || s >= 100) {
                    s = 10
                }
                if ((100 % s) != 0) {
                    for (; s >= 1; s--) {
                        if ((100 % s) == 0) {
                            break
                        }
                    }
                }
            }
            if (isNaN(o) || isNaN(v) || isNaN(s)) {
                return {}
            }
            if (isNaN(i)) {
                i = parseInt(((o - v) / (s == 0 ? 1 : s)).toFixed())
            }
            if (d && !h) {
                i = q - b;
                k = Math.pow(j, i)
            }
            if (i < 1) {
                return {}
            }
            var m = {
                min: v,
                max: o,
                logarithmic: d,
                logBase: j,
                base: d ? v : x,
                minPow: b,
                maxPow: q,
                sumP: y,
                sumN: z,
                mu: s,
                maxRange: k,
                intervals: i,
                hasStackValueReversal: n
            };
            return m
        },
        _getDataLen: function(c) {
            var b = this.source;
            if (c != undefined && c != -1 && this.seriesGroups[c].source) {
                b = this.seriesGroups[c].source
            }
            if (b instanceof a.jqx.dataAdapter) {
                b = b.records
            }
            if (b) {
                return b.length
            }
            return 0
        },
        _getDataValue: function(b, e, d) {
            var c = this.source;
            if (d != undefined && d != -1) {
                c = this.seriesGroups[d].source || c
            }
            if (c instanceof a.jqx.dataAdapter) {
                c = c.records
            }
            if (!c || b < 0 || b > c.length - 1) {
                return undefined
            }
            if (a.isFunction(e)) {
                return e(b, c)
            }
            return (e && e != "") ? c[b][e] : c[b]
        },
        _getDataValueAsNumber: function(b, e, c) {
            var d = this._getDataValue(b, e, c);
            if (this._isDate(d)) {
                return d.valueOf()
            }
            if (typeof(d) != "number") {
                d = parseFloat(d)
            }
            if (typeof(d) != "number") {
                d = undefined
            }
            return d
        },
        _isPieGroup: function(b) {
            var c = this.seriesGroups[b];
            if (!c || !c.type) {
                return false
            }
            return c.type.indexOf("pie") != -1 || c.type.indexOf("donut") != -1
        },
        _renderPieSeries: function(e, c) {
            var f = this._getDataLen(e);
            var g = this.seriesGroups[e];
            var m = this._calcGroupOffsets(e, c).offsets;
            for (var p = 0; p < g.series.length; p++) {
                var k = g.series[p];
                if (k.customDraw) {
                    continue
                }
                var v = this._getSerieSettings(e, p);
                var h = k.colorScheme || g.colorScheme || this.colorScheme;
                var r = this._getAnimProps(e, p);
                var b = r.enabled && f < 5000 && !this._isToggleRefresh && this._isVML != true ? r.duration : 0;
                if (a.jqx.mobile.isMobileBrowser() && (this.renderer instanceof a.jqx.HTML5Renderer)) {
                    b = 0
                }
                var t = this._get([k.minAngle, k.startAngle]);
                if (isNaN(t) || t < 0 || t > 360) {
                    t = 0
                }
                var x = this._get([k.maxAngle, k.endAngle]);
                if (isNaN(x) || x < 0 || x > 360) {
                    x = 360
                }
                var o = {
                    rect: c,
                    minAngle: t,
                    maxAngle: x,
                    groupIndex: e,
                    serieIndex: p,
                    settings: v,
                    items: []
                };
                for (var u = 0; u < f; u++) {
                    var n = m[p][u];
                    if (!n.visible) {
                        continue
                    }
                    var q = n.fromAngle;
                    var d = n.toAngle;
                    var w = this.renderer.pieslice(n.x, n.y, n.innerRadius, n.outerRadius, q, b == 0 ? d : q, n.centerOffset);
                    this._setRenderInfo(e, p, u, {
                        element: w
                    });
                    var j = {
                        displayValue: n.displayValue,
                        itemIndex: u,
                        visible: n.visible,
                        x: n.x,
                        y: n.y,
                        innerRadius: n.innerRadius,
                        outerRadius: n.outerRadius,
                        fromAngle: q,
                        toAngle: d,
                        centerOffset: n.centerOffset
                    };
                    o.items.push(j)
                }
                this._animatePieSlices(o, 0);
                var l = this;
                this._enqueueAnimation("series", undefined, undefined, b, function(s, i, y) {
                    l._animatePieSlices(i, y)
                }, o)
            }
        },
        _sliceSortFunction: function(d, c) {
            return d.fromAngle - c.fromAngle
        },
        _animatePieSlices: function(o, c) {
            var j;
            if (this._elementRenderInfo && this._elementRenderInfo.length > o.groupIndex && this._elementRenderInfo[o.groupIndex].series && this._elementRenderInfo[o.groupIndex].series.length > o.serieIndex) {
                j = this._elementRenderInfo[o.groupIndex].series[o.serieIndex]
            }
            var f = 360 * c;
            var u = this.seriesGroups[o.groupIndex];
            var n = this._getLabelsSettings(o.groupIndex, o.serieIndex, NaN);
            var m = n.visible;
            var b = [];
            for (var t = 0; t < o.items.length; t++) {
                var w = o.items[t];
                if (!w.visible) {
                    continue
                }
                var p = w.fromAngle;
                var e = w.fromAngle + c * (w.toAngle - w.fromAngle);
                if (j && j[w.displayValue]) {
                    var l = j[w.displayValue].fromAngle;
                    var d = j[w.displayValue].toAngle;
                    p = l + (p - l) * c;
                    e = d + (e - d) * c
                }
                b.push({
                    index: t,
                    from: p,
                    to: e
                })
            }
            if (j) {
                b.sort(this._sliceSortFunction)
            }
            var x = NaN;
            for (var t = 0; t < b.length; t++) {
                var w = o.items[b[t].index];
                var q = this._getRenderInfo(o.groupIndex, o.serieIndex, w.itemIndex);
                var p = b[t].from;
                var e = b[t].to;
                if (j) {
                    if (!isNaN(x) && p > x) {
                        p = x
                    }
                    x = e;
                    if (t == b.length - 1 && e != b[0].from) {
                        e = o.maxAngle + b[0].from
                    }
                }
                var r = this.renderer.pieSlicePath(w.x, w.y, w.innerRadius, w.outerRadius, p, e, w.centerOffset);
                this.renderer.attr(q.element, {
                    d: r
                });
                var h = this._getColors(o.groupIndex, o.serieIndex, w.itemIndex, "radialGradient", w.outerRadius);
                var v = o.settings;
                q.colors = h;
                q.settings = v;
                this.renderer.attr(q.element, {
                    fill: h.fillColor,
                    stroke: h.lineColor,
                    "stroke-width": 0,
                    "fill-opacity": v.opacity,
                    "stroke-opacity": v.opacity,
                    "stroke-dasharray": "none" || v.dashStyle
                });
                var k = u.series[o.serieIndex];
                if (m) {
                    this._showPieLabel(o.groupIndex, o.serieIndex, w.itemIndex, n)
                }
                if (c == 1) {
                    this._installHandlers(q.element, "pieslice", o.groupIndex, o.serieIndex, w.itemIndex)
                }
            }
        },
        _showPieLabel: function(e, f, A, p, h) {
            var k = this._renderData[e].offsets[f][A];
            if (k.elementInfo.labelElement) {
                this.renderer.removeElement(k.elementInfo.labelElement)
            }
            if (!p) {
                p = this._getLabelsSettings(e, f, NaN)
            }
            if (!p.visible) {
                return
            }
            var B = k.fromAngle,
                D = k.toAngle;
            var l = Math.abs(B - D);
            var q = l > 180 ? 1 : 0;
            if (l > 360) {
                B = 0;
                D = 360
            }
            var r = B * Math.PI * 2 / 360;
            var i = D * Math.PI * 2 / 360;
            var j = l / 2 + B;
            j = j % 360;
            var C = j * Math.PI * 2 / 360;
            var v;
            if (p.autoRotate == true) {
                v = j < 90 || j > 270 ? 360 - j : 180 - j
            }
            var u = p.linesEnabled;
            var o = this._showLabel(e, f, A, {
                x: 0,
                y: 0,
                width: 0,
                height: 0
            }, "center", "center", true, false, false, v);
            var d = p.radius || k.outerRadius + Math.max(o.width, o.height);
            if (this._isPercent(d)) {
                d = parseFloat(d) / 100 * Math.min(this._plotRect.width, this._plotRect.height) / 2
            }
            d += k.centerOffset;
            if (isNaN(h)) {
                h = 0
            }
            d += h;
            var x = this.seriesGroups[e];
            var n = x.series[f];
            var z = a.jqx.getNum([n.offsetX, x.offsetX, this._plotRect.width / 2]);
            var y = a.jqx.getNum([n.offsetY, x.offsetY, this._plotRect.height / 2]);
            var c = this._plotRect.x + z;
            var b = this._plotRect.y + y;
            var w = this._adjustTextBoxPosition(c, b, o, d, j, k.outerRadius > d, p.linesAngles != false, p.autoRotate == true);
            var m = {};
            k.elementInfo.labelElement = this._showLabel(e, f, A, {
                x: w.x,
                y: w.y,
                width: o.width,
                height: o.height
            }, "left", "top", false, false, false, v, m);
            if (d > k.outerRadius + 5 && u != false) {
                var t = {
                    lineColor: k.elementInfo.colors.lineColor,
                    stroke: k.elementInfo.settings.stroke,
                    opacity: k.elementInfo.settings.opacity,
                    dashStyle: k.elementInfo.settings.dashStyle
                };
                k.elementInfo.labelArrowPath = this._updateLebelArrowPath(k.elementInfo.labelArrowPath, c, b, d, k.outerRadius + h, C, p.linesAngles != false, t, m)
            }
        },
        _updateLebelArrowPath: function(d, j, f, h, l, g, o, e, r) {
            var c = a.jqx._ptrnd(j + (h - 0) * Math.cos(g));
            var n = a.jqx._ptrnd(f - (h - 0) * Math.sin(g));
            var b = a.jqx._ptrnd(j + (l + 2) * Math.cos(g));
            var m = a.jqx._ptrnd(f - (l + 2) * Math.sin(g));
            var p = [];
            p.push({
                x: r.x + r.width / 2,
                y: r.y
            });
            p.push({
                x: r.x + r.width / 2,
                y: r.y + r.height
            });
            p.push({
                x: r.x,
                y: r.y + r.height / 2
            });
            p.push({
                x: r.x + r.width,
                y: r.y + r.height / 2
            });
            if (!o) {
                p.push({
                    x: r.x,
                    y: r.y
                });
                p.push({
                    x: r.x + r.width,
                    y: r.y
                });
                p.push({
                    x: r.x + r.width,
                    y: r.y + r.height
                });
                p.push({
                    x: r.x,
                    y: r.y + r.height
                })
            }
            p = p.sort(function(s, i) {
                return a.jqx._ptdist(s.x, s.y, j, f) - a.jqx._ptdist(i.x, i.y, j, f)
            });
            p = p.sort(function(s, i) {
                return (Math.abs(s.x - j) + Math.abs(s.y - f)) - (Math.abs(i.x - j) + Math.abs(i.y - f))
            });
            for (var k = 0; k < p.length; k++) {
                p[k].x = a.jqx._ptrnd(p[k].x);
                p[k].y = a.jqx._ptrnd(p[k].y)
            }
            c = p[0].x;
            n = p[0].y;
            var q = "M " + c + "," + n + " L" + b + "," + m;
            if (o) {
                q = "M " + c + "," + n + " L" + b + "," + n + " L" + b + "," + m
            }
            if (d) {
                this.renderer.attr(d, {
                    d: q
                })
            } else {
                d = this.renderer.path(q, {})
            }
            this.renderer.attr(d, {
                fill: "none",
                stroke: e.lineColor,
                "stroke-width": 0,
                "stroke-opacity": e.opacity,
                "stroke-dasharray": "none" || e.dashStyle
            });
            return d
        },
        _adjustTextBoxPosition: function(f, e, n, g, s, c, i, o) {
            var d = s * Math.PI * 2 / 360;
            var k = a.jqx._ptrnd(f + g * Math.cos(d));
            var j = a.jqx._ptrnd(e - g * Math.sin(d));
            if (o) {
                var l = n.width;
                var p = n.height;
                var t = Math.atan(p / l) % (Math.PI * 2);
                var u = d % (Math.PI * 2);
                var r = 0,
                    q = 0;
                var m = 0;
                if (u <= t) {
                    m = l / 2 * Math.cos(d)
                } else {
                    if (u >= t && u < Math.PI - t) {
                        m = (p / 2) * Math.sin(d)
                    } else {
                        if (u >= Math.PI - t && u < Math.PI + t) {
                            m = l / 2 * Math.cos(d)
                        } else {
                            if (u >= Math.PI + t && u < 2 * Math.PI - t) {
                                m = p / 2 * Math.sin(d)
                            } else {
                                if (u >= 2 * Math.PI - t && u < 2 * Math.PI) {
                                    m = l / 2 * Math.cos(d)
                                }
                            }
                        }
                    }
                }
                g += Math.abs(m) + 3;
                var k = a.jqx._ptrnd(f + g * Math.cos(d));
                var j = a.jqx._ptrnd(e - g * Math.sin(d));
                k -= n.width / 2;
                j -= n.height / 2;
                return {
                    x: k,
                    y: j
                }
            }
            if (!c) {
                if (!i) {
                    if (s >= 0 && s < 45 || s >= 315 && s < 360) {
                        j -= n.height / 2
                    } else {
                        if (s >= 45 && s < 135) {
                            j -= n.height;
                            k -= n.width / 2
                        } else {
                            if (s >= 135 && s < 225) {
                                j -= n.height / 2;
                                k -= n.width
                            } else {
                                if (s >= 225 && s < 315) {
                                    k -= n.width / 2
                                }
                            }
                        }
                    }
                } else {
                    if (s >= 90 && s < 270) {
                        j -= n.height / 2;
                        k -= n.width
                    } else {
                        j -= n.height / 2
                    }
                }
            } else {
                k -= n.width / 2;
                j -= n.height / 2
            }
            return {
                x: k,
                y: j
            }
        },
        _isColumnType: function(b) {
            return (b.indexOf("column") != -1 || b.indexOf("waterfall") != -1)
        },
        _getColumnGroupsCount: function(c) {
            var e = 0;
            c = c || "vertical";
            var f = this.seriesGroups;
            for (var d = 0; d < f.length; d++) {
                var b = f[d].orientation || "vertical";
                if (this._isColumnType(f[d].type) && b == c) {
                    e++
                }
            }
            if (this.columnSeriesOverlap) {
                e = 1
            }
            return e
        },
        _getColumnGroupIndex: function(g) {
            var b = 0;
            var c = this.seriesGroups[g].orientation || "vertical";
            for (var e = 0; e < g; e++) {
                var f = this.seriesGroups[e];
                var d = f.orientation || "vertical";
                if (this._isColumnType(f.type) && d == c) {
                    b++
                }
            }
            return b
        },
        _renderAxisBands: function(e, A, I) {
            var x = I ? this._getXAxis(e) : this._getValueAxis(e);
            var t = this.seriesGroups[e];
            var v = I ? undefined : t.bands;
            if (!v) {
                for (var N = 0; N < e; N++) {
                    var n = I ? this._getXAxis(N) : this._getValueAxis(N);
                    if (n == x) {
                        return
                    }
                }
                v = x.bands
            }
            if (!a.isArray(v)) {
                return
            }
            var o = A;
            var V = t.orientation == "horizontal";
            if (V) {
                o = {
                    x: A.y,
                    y: A.x,
                    width: A.height,
                    height: A.width
                }
            }
            this._calcGroupOffsets(e, o);
            for (var N = 0; N < v.length; N++) {
                var c = v[N];
                var T = this._get([c.minValue, c.from]);
                var w = this._get([c.maxValue, c.to]);
                var s = I ? this.getXAxisDataPointOffset(T, e) : this.getValueAxisDataPointOffset(T, e);
                var U = I ? this.getXAxisDataPointOffset(w, e) : this.getValueAxisDataPointOffset(w, e);
                if (isNaN(s) || isNaN(U)) {
                    continue
                }
                var y = Math.abs(s - U);
                var H;
                if (t.polar || t.spider) {
                    var r = this._renderData[e];
                    var d = r.polarCoords;
                    if (!I) {
                        var D = this._toPolarCoord(d, A, A.x, r.baseOffset);
                        var C = this._toPolarCoord(d, A, A.x, s);
                        var B = this._toPolarCoord(d, A, A.x, U);
                        var q = a.jqx._ptdist(D.x, D.y, C.x, C.y);
                        var p = a.jqx._ptdist(D.x, D.y, B.x, B.y);
                        var h = Math.round(-d.startAngle * 360 / (2 * Math.PI));
                        var O = Math.round(-d.endAngle * 360 / (2 * Math.PI));
                        if (h > O) {
                            var G = h;
                            h = O;
                            O = G
                        }
                        if (t.spider) {
                            var E = r.xAxis.offsetAngles;
                            var F = "";
                            var K = [p, q];
                            var z = E;
                            if (d.isClosedCircle) {
                                z = a.extend([], E);
                                z.push(z[0])
                            }
                            for (var J in K) {
                                for (var L = 0; L < z.length; L++) {
                                    var S = J == 0 ? L : E.length - L - 1;
                                    var l = d.x + K[J] * Math.cos(z[S]);
                                    var g = d.y + K[J] * Math.sin(z[S]);
                                    if (F == "") {
                                        F += "M "
                                    } else {
                                        F += " L"
                                    }
                                    F += a.jqx._ptrnd(l) + "," + a.jqx._ptrnd(g)
                                }
                                if (J == 0) {
                                    var l = d.x + K[1] * Math.cos(z[S]);
                                    var g = d.y + K[1] * Math.sin(z[S]);
                                    F += " L" + a.jqx._ptrnd(l) + "," + a.jqx._ptrnd(g)
                                }
                            }
                            F += " Z";
                            H = this.renderer.path(F)
                        } else {
                            H = this.renderer.pieslice(d.x, d.y, q, p, h, O)
                        }
                    } else {
                        if (t.spider) {
                            var Q = this.getPolarDataPointOffset(T, this._stats.seriesGroups[e].max, e);
                            var P = this.getPolarDataPointOffset(w, this._stats.seriesGroups[e].max, e);
                            var F = "M " + d.x + "," + d.y;
                            F += " L " + Q.x + "," + Q.y;
                            F += " L " + P.x + "," + P.y;
                            H = this.renderer.path(F)
                        } else {
                            var f = {};
                            var m = {
                                x: Math.min(s, U),
                                y: A.y,
                                width: y,
                                height: A.height
                            };
                            this._columnAsPieSlice(f, A, d, m);
                            H = f.element
                        }
                    }
                } else {
                    var b = {
                        x: Math.min(s, U),
                        y: o.y,
                        width: y,
                        height: o.height
                    };
                    if (!I) {
                        b = {
                            x: o.x,
                            y: Math.min(s, U),
                            width: o.width,
                            height: y
                        }
                    }
                    if (V) {
                        var G = b.x;
                        b.x = b.y;
                        b.y = G;
                        G = b.width;
                        b.width = b.height;
                        b.height = G
                    }
                    if (y == 0 || y == 1) {
                        H = this.renderer.line(a.jqx._ptrnd(b.x), a.jqx._ptrnd(b.y), a.jqx._ptrnd(b.x + (V ? 0 : b.width)), a.jqx._ptrnd(b.y + (V ? b.height : 0)))
                    } else {
                        H = this.renderer.rect(b.x, b.y, b.width, b.height)
                    }
                }
                var W = c.fillColor || c.color || "#AAAAAA";
                var R = c.lineColor || W;
                var u = c.lineWidth;
                if (isNaN(u)) {
                    u = 1
                }
                var M = c.opacity;
                if (isNaN(M) || M < 0 || M > 1) {
                    M = 1
                }
                this.renderer.attr(H, {
                    fill: W,
                    "fill-opacity": M,
                    stroke: R,
                    "stroke-opacity": M,
                    "stroke-width": 0,
                    "stroke-dasharray": c.dashStyle
                })
            }
        },
        _getColumnGroupWidth: function(m, h, o) {
            var e = this.seriesGroups[m];
            var l = e.type.indexOf("stacked") != -1;
            var d = l ? 1 : e.series.length;
            var k = this._getColumnGroupsCount(e.orientation);
            if (isNaN(k) || 0 == k) {
                k = 1
            }
            var n = h.rangeLength >= 1 ? h.itemWidth : o * 0.9;
            var c = e.columnsMinWidth;
            if (isNaN(c)) {
                c = 1
            }
            if (!isNaN(e.columnsMaxWidth)) {
                c = Math.min(e.columnsMaxWidth, c)
            }
            if (c > n && h.length > 0) {
                n = Math.max(n, o * 0.9 / h.length)
            }
            var i = c;
            if (!l) {
                var f = e.seriesGapPercent;
                if (isNaN(f) || f < 0) {
                    f = 10
                }
                f /= 100;
                var b = c;
                b *= (1 + f);
                i += e.series.length * b
            }
            var j = Math.max(n / k, i);
            return {
                requiredWidth: i,
                availableWidth: n,
                targetWidth: j
            }
        },
        _getColumnSerieWidthAndOffset: function(d, e) {
            var m = this.seriesGroups[d];
            var u = m.series[e];
            var c = m.orientation == "horizontal";
            var b = this._plotRect;
            if (c) {
                b = {
                    x: b.y,
                    y: b.x,
                    width: b.height,
                    height: b.width
                }
            }
            var v = this._calcGroupOffsets(d, b);
            if (!v || v.xoffsets.length == 0) {
                return
            }
            var l = true;
            var w = this._getColumnGroupsCount(m.orientation);
            if (m.type == "candlestick" || m.type == "ohlc") {
                w = 1
            }
            var q = this._getColumnGroupIndex(d);
            var r = this._getColumnGroupWidth(d, v.xoffsets, c ? b.height : b.width);
            var h = 0;
            var f = r.targetWidth;
            if (this.columnSeriesOverlap == true || (Math.round(f) > Math.round(r.availableWidth / w))) {
                w = 1;
                q = 0
            }
            if (l) {
                h -= (f * w) / 2
            }
            h += f * q;
            var B = m.columnsGapPercent;
            if (B <= 0) {
                B = 0
            }
            if (isNaN(B) || B >= 100) {
                B = 25
            }
            B /= 100;
            var k = f * B;
            if (k + r.requiredWidth > r.targetWidth) {
                k = Math.max(0, r.targetWidth - r.requiredWidth)
            }
            if (Math.round(f) > Math.round(r.availableWidth)) {
                k = 0
            }
            f -= k;
            h += k / 2;
            var x = m.seriesGapPercent;
            if (isNaN(x) || x < 0) {
                x = 10
            }
            var n = m.type.indexOf("stacked") != -1;
            var t = f;
            if (!n) {
                t /= m.series.length
            }
            var y = this._get([m.seriesGap, (f * x / 100) / (m.series.length - 1)]);
            if (m.polar == true || m.spider == true || n || m.series.length <= 1) {
                y = 0
            }
            var o = y * (m.series.length - 1);
            if (m.series.length > 1 && o > f - m.series.length * 1) {
                o = f - m.series.length * 1;
                y = o / Math.max(1, (m.series.length - 1))
            }
            var g = t - (o / m.series.length);
            var A = 0;
            var i = m.columnsMaxWidth;
            if (!isNaN(i)) {
                if (g > i) {
                    A = g - i;
                    g = i
                }
            }
            var z = A / 2;
            var j = 0;
            if (!n) {
                var C = (f - (g * m.series.length) - o) / 2;
                var p = Math.max(0, e);
                j = C + g * e + p * y
            } else {
                j = A / 2
            }
            return {
                width: g,
                offset: h + j
            }
        },
        _renderColumnSeries: function(f, c) {
            var j = this.seriesGroups[f];
            if (!j.series || j.series.length == 0) {
                return
            }
            var h = this._getDataLen(f);
            var e = j.orientation == "horizontal";
            var y = c;
            if (e) {
                y = {
                    x: c.y,
                    y: c.x,
                    width: c.height,
                    height: c.width
                }
            }
            var p = this._calcGroupOffsets(f, y);
            if (!p || p.xoffsets.length == 0) {
                return
            }
            var m;
            if (j.polar == true || j.spider == true) {
                m = this._getPolarAxisCoords(f, y)
            }
            var r = {
                groupIndex: f,
                rect: c,
                vertical: !e,
                seriesCtx: [],
                renderData: p,
                polarAxisCoords: m
            };
            r.columnGroupWidth = this._getColumnGroupWidth(f, p.xoffsets, e ? y.height : y.width);
            var g = this._getGroupGradientType(f);
            for (var t = 0; t < j.series.length; t++) {
                var n = j.series[t];
                if (n.customDraw) {
                    continue
                }
                var w = n.dataField;
                var u = this._getAnimProps(f, t);
                var b = u.enabled && !this._isToggleRefresh && p.xoffsets.length < 100 ? u.duration : 0;
                var k = this._getColumnSerieWidthAndOffset(f, t);
                var q = this._isSerieVisible(f, t);
                var l = this._getSerieSettings(f, t);
                var z = this._getColors(f, t, NaN, this._getGroupGradientType(f), 4);
                var d = [];
                if (a.isFunction(n.colorFunction) && !m) {
                    for (var x = p.xoffsets.first; x <= p.xoffsets.last; x++) {
                        d.push(this._getColors(f, t, x, g, 4))
                    }
                }
                var v = {
                    seriesIndex: t,
                    serieColors: z,
                    itemsColors: d,
                    settings: l,
                    columnWidth: k.width,
                    xAdjust: k.offset,
                    isVisible: q
                };
                r.seriesCtx.push(v)
            }
            this._animColumns(r, b == 0 ? 1 : 0);
            var o = this;
            this._enqueueAnimation("series", undefined, undefined, b, function(s, i, A) {
                o._animColumns(i, A)
            }, r)
        },
        _getPercent: function(d, c, b, e) {
            if (isNaN(d)) {
                d = c
            }
            if (!isNaN(b) && !isNaN(d) && d < b) {
                d = b
            }
            if (!isNaN(e) && !isNaN(d) && d > e) {
                d = e
            }
            if (isNaN(d)) {
                return NaN
            }
            return d
        },
        _getColumnVOffsets: function(n, j, e, B, u, c) {
            var p = this.seriesGroups[j];
            var F = this._getPercent(p.columnsTopWidthPercent, 100, 0, 100);
            var v = this._getPercent(p.columnsBottomWidthPercent, 100, 0, 100);
            if (F == 0 && v == 0) {
                v = 100
            }
            var H = this._getPercent(p.columnsNeckHeightPercent, NaN, 0, 100) / 100;
            var C = this._getPercent(p.columnsNeckWidthPercent, 100, 0, 100) / 100;
            var r = [];
            var G = NaN;
            for (var q = 0; q < e.length; q++) {
                var L = e[q];
                var k = L.seriesIndex;
                var E = p.series[k];
                var o = n.offsets[k][B].from;
                var N = n.offsets[k][B].to;
                var x = n.xoffsets.data[B];
                var g;
                var h = L.isVisible;
                if (!h) {
                    N = o
                }
                var b = this._elementRenderInfo;
                if (h && b && b.length > j && b[j].series.length > k) {
                    var D = n.xoffsets.xvalues[B];
                    g = b[j].series[k][D];
                    if (g && !isNaN(g.from) && !isNaN(g.to)) {
                        o = g.from + (o - g.from) * c;
                        N = g.to + (N - g.to) * c;
                        x = g.xoffset + (x - g.xoffset) * c
                    }
                }
                if (!g) {
                    N = o + (N - o) * (u ? 1 : c)
                }
                if (isNaN(o)) {
                    o = isNaN(G) ? n.baseOffset : G
                }
                if (!isNaN(N) && u) {
                    G = N
                } else {
                    G = o
                }
                if (isNaN(N)) {
                    N = o
                }
                var A = {
                    from: o,
                    to: N,
                    xOffset: x
                };
                if (F != 100 || v != 100) {
                    A.funnel = true;
                    A.toWidthPercent = F;
                    A.fromWidthPercent = v
                }
                r.push(A)
            }
            if (u && r.length > 1 && !(this._elementRenderInfo && this._elementRenderInfo.length > j)) {
                var l = 0,
                    m = 0,
                    I = -Infinity,
                    w = Infinity,
                    J = Infinity,
                    z = -Infinity;
                for (var K = 0; K < r.length; K++) {
                    var L = e[K];
                    if (L.isVisible) {
                        if (r[K].to >= r[K].from) {
                            m += r[K].to - r[K].from;
                            J = Math.min(J, r[K].from);
                            z = Math.max(z, r[K].to)
                        } else {
                            l += r[K].from - r[K].to;
                            I = Math.max(I, r[K].from);
                            w = Math.min(w, r[K].to)
                        }
                    }
                }
                var M = l;
                var t = m;
                l *= c;
                m *= c;
                var d = 0,
                    f = 0;
                for (var K = 0; K < r.length; K++) {
                    if (r[K].to >= r[K].from) {
                        var y = r[K].to - r[K].from;
                        if (y + f > m) {
                            y = Math.max(0, m - f);
                            r[K].to = r[K].from + y
                        }
                        if (F != 100 || v != 100) {
                            r[K].funnel = true;
                            if (!isNaN(H) && t * H >= f) {
                                r[K].fromWidthPercent = C * 100
                            } else {
                                r[K].fromWidthPercent = (Math.abs(r[K].from - J) / t) * (F - v) + v
                            }
                            if (!isNaN(H) && t * H >= (0 + (f + y))) {
                                r[K].toWidthPercent = C * 100
                            } else {
                                r[K].toWidthPercent = (Math.abs(r[K].to - J) / t) * (F - v) + v
                            }
                        }
                        f += y
                    } else {
                        var y = r[K].from - r[K].to;
                        if (y + d > l) {
                            y = Math.max(0, l - d);
                            r[K].to = r[K].from - y
                        }
                        if (F != 100 || v != 100) {
                            r[K].funnel = true;
                            if (!isNaN(H) && M * H >= d) {
                                r[K].fromWidthPercent = C * 100
                            } else {
                                r[K].fromWidthPercent = (Math.abs(r[K].from - I) / M) * (F - v) + v
                            }
                            if (!isNaN(H) && M * H >= (0 + (d + y))) {
                                r[K].toWidthPercent = C * 100
                            } else {
                                r[K].toWidthPercent = (Math.abs(r[K].to - I) / M) * (F - v) + v
                            }
                        }
                        d += y
                    }
                }
            }
            return r
        },
        _columnAsPieSlice: function(d, k, m, o) {
            var e = this._toPolarCoord(m, k, o.x, o.y);
            var f = this._toPolarCoord(m, k, o.x, o.y + o.height);
            var l = a.jqx._ptdist(m.x, m.y, f.x, f.y);
            var i = a.jqx._ptdist(m.x, m.y, e.x, e.y);
            var c = k.width;
            var n = Math.abs(m.startAngle - m.endAngle) * 180 / Math.PI;
            var b = -((o.x - k.x) * n) / c;
            var h = -((o.x + o.width - k.x) * n) / c;
            var j = m.startAngle;
            j = 360 * j / (Math.PI * 2);
            b -= j;
            h -= j;
            if (d) {
                if (d.element != undefined) {
                    var g = this.renderer.pieSlicePath(m.x, m.y, l, i, h, b, 0);
                    g += " Z";
                    this.renderer.attr(d.element, {
                        d: g
                    })
                } else {
                    d.element = this.renderer.pieslice(m.x, m.y, l, i, h, b, 0)
                }
            }
            return {
                fromAngle: h,
                toAngle: b,
                innerRadius: l,
                outerRadius: i
            }
        },
        _setRenderInfo: function(e, b, d, c) {
            this._renderData[e].offsets[b][d].elementInfo = c
        },
        _getRenderInfo: function(d, b, c) {
            return this._renderData[d].offsets[b][c].elementInfo || {}
        },
        _animColumns: function(ai, d) {
            var p = this;
            var q = ai.groupIndex;
            var A = this.seriesGroups[q];
            var v = ai.renderData;
            var aa = A.type.indexOf("waterfall") != -1;
            var G = this._getXAxis(q);
            var I = A.type.indexOf("stacked") != -1;
            var e = ai.polarAxisCoords;
            var z = this._getGroupGradientType(q);
            var s = ai.columnGroupWidth.targetWidth;
            var y = -1;
            for (var ab = 0; ab < A.series.length; ab++) {
                if (this._isSerieVisible(q, ab)) {
                    y = ab;
                    break
                }
            }
            var aj = NaN,
                t = NaN;
            for (var ab = 0; ab < ai.seriesCtx.length; ab++) {
                var ah = ai.seriesCtx[ab];
                if (isNaN(aj) || aj > ah.xAdjust) {
                    aj = ah.xAdjust
                }
                if (isNaN(t) || t < ah.xAdjust + ah.columnWidth) {
                    t = ah.xAdjust + ah.columnWidth
                }
            }
            var r = Math.abs(t - aj);
            var C = this._get([A.columnsGapPercent, 25]) / 100;
            if (isNaN(C) < 0 || C >= 1) {
                C = 0.25
            }
            var f = C * r;
            var Z = ai.renderData.xoffsets;
            var S = -1;
            var O = {};
            var R = A.skipOverlappingPoints == true;
            for (var ad = Z.first; ad <= Z.last; ad++) {
                var V = Z.data[ad];
                if (isNaN(V)) {
                    continue
                }
                if (S != -1 && Math.abs(V - S) < (r - 1 + f) && R) {
                    continue
                } else {
                    S = V
                }
                var F = this._getColumnVOffsets(v, q, ai.seriesCtx, ad, I, d);
                var L = false;
                if (aa) {
                    for (var B = 0; B < A.series.length; B++) {
                        if (A.series[B].summary && Z.xvalues[ad][A.series[B].summary]) {
                            L = true
                        }
                    }
                }
                for (var B = 0; B < ai.seriesCtx.length; B++) {
                    var ah = ai.seriesCtx[B];
                    var m = ah.seriesIndex;
                    var E = A.series[m];
                    var w = F[B].from;
                    var ak = F[B].to;
                    var K = F[B].xOffset;
                    var g = (ai.vertical ? ai.rect.x : ai.rect.y) + ah.xAdjust;
                    var ae = ah.settings;
                    var W = ah.itemsColors.length != 0 ? ah.itemsColors[ad - v.xoffsets.first] : ah.serieColors;
                    var h = this._isSerieVisible(q, m);
                    if (!h) {
                        continue
                    }
                    var V = a.jqx._ptrnd(g + K);
                    var Q = {
                        x: V,
                        width: ah.columnWidth
                    };
                    if (F[B].funnel) {
                        Q.fromWidthPercent = F[B].fromWidthPercent;
                        Q.toWidthPercent = F[B].toWidthPercent
                    }
                    var k = true;
                    if (ai.vertical) {
                        Q.y = w;
                        Q.height = ak - w;
                        if (Q.height < 0) {
                            Q.y += Q.height;
                            Q.height = -Q.height;
                            k = false
                        }
                    } else {
                        Q.x = w < ak ? w : ak;
                        Q.width = Math.abs(w - ak);
                        k = w - ak < 0;
                        Q.y = V;
                        Q.height = ah.columnWidth
                    }
                    var n = w - ak;
                    if (isNaN(n)) {
                        continue
                    }
                    n = Math.abs(n);
                    var H = undefined;
                    var c = p._getRenderInfo(q, m, ad);
                    var u = c.element;
                    var P = c.labelElement;
                    var N = u == undefined;
                    if (P) {
                        p.renderer.removeElement(P);
                        P = undefined
                    }
                    if (!e) {
                        if (F[B].funnel) {
                            var Y = this._getTrapezoidPath(a.extend({}, Q), ai.vertical, k);
                            if (N) {
                                u = this.renderer.path(Y, {})
                            } else {
                                this.renderer.attr(u, {
                                    d: Y
                                })
                            }
                        } else {
                            if (N) {
                                u = this.renderer.rect(Q.x, Q.y, ai.vertical ? Q.width : 0, ai.vertical ? 0 : Q.height)
                            } else {
                                if (ai.vertical == true) {
                                    this.renderer.attr(u, {
                                        x: Q.x,
                                        y: Q.y,
                                        height: n
                                    })
                                } else {
                                    this.renderer.attr(u, {
                                        x: Q.x,
                                        y: Q.y,
                                        width: n
                                    })
                                }
                            }
                        }
                    } else {
                        var l = {
                            element: u
                        };
                        H = this._columnAsPieSlice(l, ai.rect, e, Q);
                        u = l.element;
                        var W = this._getColors(q, m, undefined, "radialGradient", H.outerRadius)
                    }
                    if (n < 1 && (d != 1 || e)) {
                        this.renderer.attr(u, {
                            display: "none"
                        })
                    } else {
                        this.renderer.attr(u, {
                            display: "block"
                        })
                    }
                    if (N) {
                        this.renderer.attr(u, {
                            fill: W.fillColor,
                            "fill-opacity": ae.opacity,
                            "stroke-opacity": ae.opacity,
                            stroke: W.lineColor,
                            "stroke-width": 0,
                            "stroke-dasharray": ae.dashStyle
                        })
                    }
                    if (P) {
                        this.renderer.removeElement(P)
                    }
                    if (!h || (n == 0 && d < 1)) {
                        c = {
                            element: u,
                            labelElement: P
                        };
                        p._setRenderInfo(q, m, ad, c);
                        continue
                    }
                    if (aa && this._get([E.showWaterfallLines, A.showWaterfallLines]) != false) {
                        if (!I || (I && B == y)) {
                            var ac = I ? -1 : B;
                            if (d == 1 && !isNaN(v.offsets[B][ad].from) && !isNaN(v.offsets[B][ad].to)) {
                                var M = O[ac];
                                if (M != undefined) {
                                    var ag = {
                                        x: M.x,
                                        y: a.jqx._ptrnd(M.y)
                                    };
                                    var af = {
                                        x: V,
                                        y: ag.y
                                    };
                                    var T = A.columnsTopWidthPercent / 100;
                                    if (isNaN(T)) {
                                        T = 1
                                    } else {
                                        if (T > 1 || T < 0) {
                                            T = 1
                                        }
                                    }
                                    var X = A.columnsBottomWidthPercent / 100;
                                    if (isNaN(X)) {
                                        X = 1
                                    } else {
                                        if (X > 1 || X < 0) {
                                            X = 1
                                        }
                                    }
                                    var o = ai.vertical ? Q.width : Q.height;
                                    ag.x = ag.x - o / 2 + o / 2 * T;
                                    if (L) {
                                        var b = o * T / 2;
                                        af.x = af.x + o / 2 - (G.flip ? -b : b)
                                    } else {
                                        var b = o * X / 2;
                                        af.x = af.x + o / 2 - (G.flip ? -b : b)
                                    }
                                    if (!ai.vertical) {
                                        this._swapXY([ag]);
                                        this._swapXY([af])
                                    }
                                    this.renderer.line(ag.x, ag.y, af.x, af.y, {
                                        stroke: M.color,
                                        "stroke-width": 0,
                                        "stroke-opacity": ae.opacity,
                                        "fill-opacity": ae.opacity,
                                        "stroke-dasharray": ae.dashStyle
                                    })
                                }
                            }
                        }
                        if (d == 1 && n != 0) {
                            O[I ? -1 : B] = {
                                y: ak,
                                x: (ai.vertical ? Q.x + Q.width : Q.y + Q.height),
                                color: W.lineColor
                            }
                        }
                    }
                    if (e) {
                        var U = this._toPolarCoord(e, ai.rect, Q.x + Q.width / 2, Q.y);
                        var o = this._showLabel(q, m, ad, Q, undefined, undefined, true);
                        var J = H.outerRadius + 10;
                        var D = this._adjustTextBoxPosition(e.x, e.y, o, J, (H.fromAngle + H.toAngle) / 2, true, false, false);
                        P = this._showLabel(q, m, ad, {
                            x: D.x,
                            y: D.y
                        }, undefined, undefined, false, false, false)
                    } else {
                        P = this._showLabel(q, m, ad, Q, undefined, undefined, false, false, k)
                    }
                    c = {
                        element: u,
                        labelElement: P
                    };
                    p._setRenderInfo(q, m, ad, c);
                    if (d == 1) {
                        this._installHandlers(u, "column", q, m, ad)
                    }
                }
            }
        },
        _getTrapezoidPath: function(g, h, f) {
            var l = "";
            var b = g.fromWidthPercent / 100;
            var c = g.toWidthPercent / 100;
            if (!h) {
                var e = g.width;
                g.width = g.height;
                g.height = e;
                e = g.x;
                g.x = g.y;
                g.y = e
            }
            var j = g.x + g.width / 2;
            var k = [{
                x: j - g.width * (!f ? b : c) / 2,
                y: g.y + g.height
            }, {
                x: j - g.width * (!f ? c : b) / 2,
                y: g.y
            }, {
                x: j + g.width * (!f ? c : b) / 2,
                y: g.y
            }, {
                x: j + g.width * (!f ? b : c) / 2,
                y: g.y + g.height
            }];
            if (!h) {
                this._swapXY(k)
            }
            l += "M " + a.jqx._ptrnd(k[0].x) + "," + a.jqx._ptrnd(k[0].y);
            for (var d = 1; d < k.length; d++) {
                l += " L " + a.jqx._ptrnd(k[d].x) + "," + a.jqx._ptrnd(k[d].y)
            }
            l += " Z";
            return l
        },
        _swapXY: function(d) {
            for (var c = 0; c < d.length; c++) {
                var b = d[c].x;
                d[c].x = d[c].y;
                d[c].y = b
            }
        },
        _renderCandleStickSeries: function(e, c, t) {
            var m = this;
            var h = m.seriesGroups[e];
            if (!h.series || h.series.length == 0) {
                return
            }
            var d = h.orientation == "horizontal";
            var v = c;
            if (d) {
                v = {
                    x: c.y,
                    y: c.x,
                    width: c.height,
                    height: c.width
                }
            }
            var n = m._calcGroupOffsets(e, v);
            if (!n || n.xoffsets.length == 0) {
                return
            }
            var w = v.width;
            var k;
            if (h.polar || h.spider) {
                k = m._getPolarAxisCoords(e, v);
                w = 2 * k.r
            }
            var g = m._alignValuesWithTicks(e);
            var f = m._getGroupGradientType(e);
            var i = [];
            for (var p = 0; p < h.series.length; p++) {
                i[p] = m._getColumnSerieWidthAndOffset(e, p)
            }
            for (var p = 0; p < h.series.length; p++) {
                if (!this._isSerieVisible(e, p)) {
                    continue
                }
                var u = m._getSerieSettings(e, p);
                var l = h.series[p];
                if (l.customDraw) {
                    continue
                }
                var j = a.isFunction(l.colorFunction) ? undefined : m._getColors(e, p, NaN, f);
                var o = {
                    rect: c,
                    inverse: d,
                    groupIndex: e,
                    seriesIndex: p,
                    symbolType: l.symbolType,
                    symbolSize: l.symbolSize,
                    "fill-opacity": u.opacity,
                    "stroke-opacity": u.opacity,
                    "stroke-width": 0,
                    "stroke-dasharray": u.dashStyle,
                    gradientType: f,
                    colors: j,
                    renderData: n,
                    polarAxisCoords: k,
                    columnsInfo: i,
                    isOHLC: t,
                    items: [],
                    self: m
                };
                var q = m._getAnimProps(e, p);
                var b = q.enabled && !m._isToggleRefresh && n.xoffsets.length < 5000 ? q.duration : 0;
                m._animCandleStick(o, 0);
                var r;
                m._enqueueAnimation("series", undefined, undefined, b, function(y, s, x) {
                    m._animCandleStick(s, x)
                }, o)
            }
        },
        _animCandleStick: function(t, b) {
            var q = ["Open", "Low", "Close", "High"];
            var e = t.columnsInfo[t.seriesIndex].width;
            var g = t.self.seriesGroups[t.groupIndex];
            var v = t.renderData.xoffsets;
            var E = -1;
            var n = Math.abs(v.data[v.last] - v.data[v.first]);
            n *= b;
            var c = NaN,
                r = NaN;
            for (var z = 0; z < t.columnsInfo.length; z++) {
                var w = t.columnsInfo[z];
                if (isNaN(c) || c > w.offset) {
                    c = w.offset
                }
                if (isNaN(r) || r < w.offset + w.width) {
                    r = w.offset + w.width
                }
            }
            var m = Math.abs(r - c);
            var B = g.skipOverlappingPoints != false;
            for (var A = v.first; A <= v.last; A++) {
                var l = v.data[A];
                if (isNaN(l)) {
                    continue
                }
                if (E != -1 && Math.abs(l - E) < m && B) {
                    continue
                }
                var C = Math.abs(v.data[A] - v.data[v.first]);
                if (C > n) {
                    break
                }
                E = l;
                var D = t.items[A] = t.items[A] || {};
                for (var z in q) {
                    var F = t.self._getDataValueAsNumber(A, g.series[t.seriesIndex]["dataField" + q[z]], t.groupIndex);
                    if (isNaN(F)) {
                        break
                    }
                    var k = t.renderData.offsets[t.seriesIndex][A][q[z]];
                    if (isNaN(k)) {
                        break
                    }
                    D[q[z]] = k
                }
                l += t.inverse ? t.rect.y : t.rect.x;
                if (t.polarAxisCoords) {
                    var s = this._toPolarCoord(t.polarAxisCoords, this._plotRect, l, k);
                    l = s.x;
                    k = s.y
                }
                l = a.jqx._ptrnd(l);
                for (var f in q) {
                    D[f] = a.jqx._ptrnd(D[f])
                }
                var h = t.colors;
                if (!h) {
                    h = t.self._getColors(t.groupIndex, t.seriesIndex, A, t.gradientType)
                }
                if (!t.isOHLC) {
                    var u = D.lineElement;
                    if (!u) {
                        u = t.inverse ? this.renderer.line(D.Low, l, D.High, l) : this.renderer.line(l, D.Low, l, D.High);
                        this.renderer.attr(u, {
                            fill: h.fillColor,
                            "fill-opacity": t["fill-opacity"],
                            "stroke-opacity": t["fill-opacity"],
                            stroke: h.lineColor,
                            "stroke-width": 0,
                            "stroke-dasharray": t["stroke-dasharray"]
                        });
                        D.lineElement = u
                    }
                    var p = D.stickElement;
                    l -= e / 2;
                    if (!p) {
                        var d = h.fillColor;
                        if (D.Close <= D.Open && h.fillColorAlt) {
                            d = h.fillColorAlt
                        }
                        p = t.inverse ? this.renderer.rect(Math.min(D.Open, D.Close), l, Math.abs(D.Close - D.Open), e) : this.renderer.rect(l, Math.min(D.Open, D.Close), e, Math.abs(D.Close - D.Open));
                        this.renderer.attr(p, {
                            fill: d,
                            "fill-opacity": t["fill-opacity"],
                            "stroke-opacity": t["fill-opacity"],
                            stroke: h.lineColor,
                            "stroke-width": 0,
                            "stroke-dasharray": t["stroke-dasharray"]
                        });
                        D.stickElement = p
                    }
                    if (b == 1) {
                        this._installHandlers(p, "column", t.groupIndex, t.seriesIndex, A)
                    }
                } else {
                    var o = "M" + l + "," + D.Low + " L" + l + "," + D.High + " M" + (l - e / 2) + "," + D.Open + " L" + l + "," + D.Open + " M" + (l + e / 2) + "," + D.Close + " L" + l + "," + D.Close;
                    if (t.inverse) {
                        o = "M" + D.Low + "," + l + " L" + D.High + "," + l + " M" + D.Open + "," + (l - e / 2) + " L" + D.Open + "," + l + " M" + D.Close + "," + l + " L" + D.Close + "," + (l + e / 2)
                    }
                    var u = D.lineElement;
                    if (!u) {
                        u = this.renderer.path(o, {});
                        this.renderer.attr(u, {
                            fill: h.fillColor,
                            "fill-opacity": t["fill-opacity"],
                            "stroke-opacity": t["fill-opacity"],
                            stroke: h.lineColor,
                            "stroke-width": 0,
                            "stroke-dasharray": t["stroke-dasharray"]
                        });
                        D.lineElement = u
                    }
                    if (b == 1) {
                        this._installHandlers(u, "column", t.groupIndex, t.seriesIndex, A)
                    }
                }
            }
        },
        _renderScatterSeries: function(e, D, F) {
            var u = this.seriesGroups[e];
            if (!u.series || u.series.length == 0) {
                return
            }
            var f = u.type.indexOf("bubble") != -1;
            var v = u.orientation == "horizontal";
            var m = D;
            if (v) {
                m = {
                    x: D.y,
                    y: D.x,
                    width: D.height,
                    height: D.width
                }
            }
            var n = this._calcGroupOffsets(e, m);
            if (!n || n.xoffsets.length == 0) {
                return
            }
            var N = m.width;
            var c;
            if (u.polar || u.spider) {
                c = this._getPolarAxisCoords(e, m);
                N = 2 * c.r
            }
            var V = this._alignValuesWithTicks(e);
            var t = this._getGroupGradientType(e);
            if (!F) {
                F = "to"
            }
            for (var g = 0; g < u.series.length; g++) {
                var T = this._getSerieSettings(e, g);
                var K = u.series[g];
                if (K.customDraw) {
                    continue
                }
                var A = K.dataField;
                var l = a.isFunction(K.colorFunction);
                var L = this._getColors(e, g, NaN, t);
                var U = NaN,
                    z = NaN;
                if (f) {
                    for (var S = n.xoffsets.first; S <= n.xoffsets.last; S++) {
                        var C = this._getDataValueAsNumber(S, (K.radiusDataField || K.sizeDataField), e);
                        if (typeof(C) != "number") {
                            throw "Invalid radiusDataField value at [" + S + "]"
                        }
                        if (!isNaN(C)) {
                            if (isNaN(U) || C < U) {
                                U = C
                            }
                            if (isNaN(z) || C > z) {
                                z = C
                            }
                        }
                    }
                }
                var j = K.minRadius || K.minSymbolSize;
                if (isNaN(j)) {
                    j = N / 50
                }
                var E = K.maxRadius || K.maxSymbolSize;
                if (isNaN(E)) {
                    E = N / 25
                }
                if (j > E) {
                    E = j
                }
                var M = K.radius;
                if (isNaN(M) && !isNaN(K.symbolSize)) {
                    M = (K.symbolType == "circle") ? K.symbolSize / 2 : K.symbolSize
                } else {
                    M = 5
                }
                var G = this._getAnimProps(e, g);
                var B = G.enabled && !this._isToggleRefresh && n.xoffsets.length < 5000 ? G.duration : 0;
                var w = {
                    groupIndex: e,
                    seriesIndex: g,
                    symbolType: K.symbolType,
                    symbolSize: K.symbolSize,
                    "fill-opacity": T.opacity,
                    "stroke-opacity": T.opacity,
                    "stroke-width": 0,
                    "stroke-width-symbol": T.strokeSymbol,
                    "stroke-dasharray": T.dashStyle,
                    items: [],
                    polarAxisCoords: c
                };
                var o = undefined;
                for (var S = n.xoffsets.first; S <= n.xoffsets.last; S++) {
                    var C = this._getDataValueAsNumber(S, A, e);
                    if (typeof(C) != "number") {
                        continue
                    }
                    var J = n.xoffsets.data[S];
                    var H = n.xoffsets.xvalues[S];
                    var I = n.offsets[g][S][F];
                    if (I < m.y || I > m.y + m.height) {
                        continue
                    }
                    if (isNaN(J) || isNaN(I)) {
                        continue
                    }
                    if (v) {
                        var Q = J;
                        J = I;
                        I = Q + D.y
                    } else {
                        J += D.x
                    }
                    if (!l && o && this.enableSampling && a.jqx._ptdist(o.x, o.y, J, I) < 1) {
                        continue
                    }
                    o = {
                        x: J,
                        y: I
                    };
                    var O = M;
                    if (f) {
                        var p = this._getDataValueAsNumber(S, (K.radiusDataField || K.sizeDataField), e);
                        if (typeof(p) != "number") {
                            continue
                        }
                        O = j + (E - j) * (p - U) / Math.max(1, z - U);
                        if (isNaN(O)) {
                            O = j
                        }
                    }
                    n.offsets[g][S].radius = O;
                    var k = NaN,
                        P = NaN;
                    var q = 0;
                    var b = this._elementRenderInfo;
                    if (H != undefined && b && b.length > e && b[e].series.length > g) {
                        var d = b[e].series[g][H];
                        if (d && !isNaN(d.to)) {
                            k = d.to;
                            P = d.xoffset;
                            q = M;
                            if (v) {
                                var Q = P;
                                P = k;
                                k = Q + D.y
                            } else {
                                P += D.x
                            }
                            if (f) {
                                q = j + (E - j) * (d.valueRadius - U) / Math.max(1, z - U);
                                if (isNaN(q)) {
                                    q = j
                                }
                            }
                        }
                    }
                    if (l) {
                        L = this._getColors(e, g, S, t)
                    }
                    w.items.push({
                        from: q,
                        to: O,
                        itemIndex: S,
                        fill: L.fillColor,
                        stroke: L.lineColor,
                        x: J,
                        y: I,
                        xFrom: P,
                        yFrom: k
                    })
                }
                this._animR(w, 0);
                var h = this;
                var R;
                this._enqueueAnimation("series", undefined, undefined, B, function(s, i, r) {
                    h._animR(i, r)
                }, w)
            }
        },
        _animR: function(o, g) {
            var j = o.items;
            var p = o.symbolType || "circle";
            var c = o.symbolSize;
            for (var e = 0; e < j.length; e++) {
                var n = j[e];
                var l = n.x;
                var k = n.y;
                var b = Math.round((n.to - n.from) * g + n.from);
                if (!isNaN(n.yFrom)) {
                    k = n.yFrom + (k - n.yFrom) * g
                }
                if (!isNaN(n.xFrom)) {
                    l = n.xFrom + (l - n.xFrom) * g
                }
                if (o.polarAxisCoords) {
                    var m = this._toPolarCoord(o.polarAxisCoords, this._plotRect, l, k);
                    l = m.x;
                    k = m.y
                }
                l = a.jqx._ptrnd(l);
                k = a.jqx._ptrnd(k);
                b = a.jqx._ptrnd(b);
                var f = this._getRenderInfo(o.groupIndex, o.seriesIndex, j[e].itemIndex);
                var d = f.element;
                var h = f.labelElement;
                if (p == "circle") {
                    if (!d) {
                        d = this.renderer.circle(l, k, b);
                        this.renderer.attr(d, {
                            fill: n.fill,
                            "fill-opacity": o["fill-opacity"],
                            "stroke-opacity": o["fill-opacity"],
                            stroke: n.stroke,
                            "stroke-width": 0,
                            "stroke-dasharray": o["stroke-dasharray"]
                        })
                    }
                    if (this._isVML) {
                        this.renderer.updateCircle(d, undefined, undefined, b)
                    } else {
                        this.renderer.attr(d, {
                            r: b,
                            cy: k,
                            cx: l
                        })
                    }
                } else {
                    if (d) {
                        this.renderer.removeElement(d)
                    }
                    d = this._drawSymbol(p, l, k, n.fill, o["fill-opacity"], n.stroke, o["stroke-opacity"] || o["fill-opacity"], o["stroke-width-symbol"], o["stroke-dasharray"], c || b)
                }
                if (h) {
                    this.renderer.removeElement(h)
                }
                h = this._showLabel(o.groupIndex, o.seriesIndex, n.itemIndex, {
                    x: l - b,
                    y: k - b,
                    width: 2 * b,
                    height: 2 * b
                });
                if (g >= 1) {
                    this._installHandlers(d, "circle", o.groupIndex, o.seriesIndex, n.itemIndex)
                }
                this._setRenderInfo(o.groupIndex, o.seriesIndex, j[e].itemIndex, {
                    element: d,
                    labelElement: h
                })
            }
        },
        _showMultiSeriesToolTip: function(n, l, e) {
            var s = this;
            var w = '<div style="text-align:left">';
            var h = "";
            for (var B = 0; B < s.seriesGroups.length; B++) {
                if (s._isPieGroup(B)) {
                    continue
                }
                var j = s._getXAxis(B);
                var c = s._getValueAxis(B);
                var i = s.seriesGroups[B];
                var f = this._getAxisSettings(j);
                var A = f.toolTipFormatSettings;
                var d = f.toolTipFormatFunction;
                var q = s._getDataValue(e, j.dataField, B);
                if (j.dataField == undefined || j.dataField == "") {
                    q = e
                }
                if (j.type == "date") {
                    q = s._castAsDate(q, (A ? A.dateFormat : undefined) || j.dateFormat)
                }
                if (!d && !A && j.type == "date") {
                    d = this._getDefaultDTFormatFn(j.baseUnit || "day")
                }
                var r = (j.displayText || j.dataField || "");
                if (r != "") {
                    r += ": "
                }
                var b = r + s._formatValue(q, A, d, B, v, e);
                if (h != b) {
                    if (h != "") {
                        w += "<br />"
                    }
                    w += b + "<br /><br />";
                    h = b
                }
                for (var v = 0; v < i.series.length; v++) {
                    var t = i.series[v];
                    if (i.showToolTips == false || t.showToolTips == false) {
                        continue
                    }
                    if (!s._isSerieVisible(B, v)) {
                        continue
                    }
                    var g = s._get([t.toolTipFormatSettings, i.toolTipFormatSettings, c.toolTipFormatSettings, s.toolTipFormatSettings]);
                    var p = s._get([t.toolTipFormatFunction, i.toolTipFormatFunction, c.toolTipFormatFunction, s.toolTipFormatFunction]);
                    var o = s._getFormattedValue(B, v, e, g, p);
                    var k = s._getColors(B, v, e);
                    w += "<span style='color:" + k.lineColor + ";'>" + o + "</span><br />\n"
                }
            }
            var z = this._get([s.toolTipClass, this.toThemeProperty("jqx-chart-tooltip-text", null)]);
            var C = this._get([s.toolTipBackground, "#FFFFFF"]);
            var D = this._get([s.toolTipLineColor, s._defaultLineColor]);
            var m = this._get([s.toolTipOpacity, 1]);
            w += "</div>";
            var u = this.getItemCoord(s._ttEl.gidx, s._ttEl.sidx, s._ttEl.iidx);
            s._createTooltip(u, s.seriesGroups[s._ttEl.gidx], w, {
                css: z,
                fill: C,
                stroke: D,
                fillOpacity: m,
                symbolSize: 3
            })
        },
        _showToolTip: function(K, I, n, e, b) {
            var h = this;
            var w = h._getXAxis(n);
            var l = h._getValueAxis(n);
            if (h._ttEl && n == h._ttEl.gidx && e == h._ttEl.sidx && b == h._ttEl.iidx) {
                return
            }
            var s = h.seriesGroups[n];
            var g = s.series[e];
            var G = h.enableCrosshairs;
            if (h._pointMarker) {
                K = parseInt(h._pointMarker.x + 5);
                I = parseInt(h._pointMarker.y - 5)
            } else {
                G = false
            }
            var X = G && h.showToolTips == false;
            K = a.jqx._ptrnd(K);
            I = a.jqx._ptrnd(I);
            var m = h._ttEl == undefined;
            if (s.showToolTips == false || g.showToolTips == false) {
                return
            }
            if (!h._ttEl) {
                h._ttEl = {}
            }
            h._ttEl.sidx = e;
            h._ttEl.gidx = n;
            h._ttEl.iidx = b;
            var f = 0;
            for (var T = 0; T < h.seriesGroups.length; T++) {
                for (var S = 0; S < h.seriesGroups[T].series.length; S++) {
                    f++
                }
            }
            if (h.showToolTipsOnAllSeries && !h._isPieGroup(n) && f > 1) {
                h._showMultiSeriesToolTip(K, I, b);
                return
            }
            var z = h._get([g.toolTipFormatSettings, s.toolTipFormatSettings, l.toolTipFormatSettings, h.toolTipFormatSettings]);
            var F = h._get([g.toolTipFormatFunction, s.toolTipFormatFunction, l.toolTipFormatFunction, h.toolTipFormatFunction]);
            var O = h._getColors(n, e, b);
            var d = h._getDataValue(b, w.dataField, n);
            if (w.dataField == undefined || w.dataField == "") {
                d = b
            }
            if (w.type == "date") {
                d = h._castAsDate(d, (z ? z.dateFormat : undefined) || w.dateFormat)
            }
            var C = "";
            if (a.isFunction(F)) {
                var M = {};
                var v = 0;
                for (var k in g) {
                    if (k.indexOf("dataField") == 0) {
                        M[k.substring(9, k.length).toLowerCase()] = h._getDataValue(b, g[k], n);
                        v++
                    }
                }
                if (v == 0) {
                    M = h._getDataValue(b, undefined, n)
                } else {
                    if (v == 1) {
                        M = M[""]
                    }
                }
                C = F(M, b, g, s, d, w)
            } else {
                C = h._getFormattedValue(n, e, b, z, F);
                var L = this._getAxisSettings(w);
                var P = L.toolTipFormatSettings;
                var U = L.toolTipFormatFunction;
                if (!U && !P && w.type == "date") {
                    U = this._getDefaultDTFormatFn(w.baseUnit || "day")
                }
                var o = h._formatValue(d, P, U, n, e, b);
                if (!h._isPieGroup(n)) {
                    var N = (w.displayText || w.dataField || "");
                    if (N.length > 0) {
                        C = N + ": " + o + "<br>" + C
                    } else {
                        C = o + "<br>" + C
                    }
                } else {
                    d = h._getDataValue(b, g.displayText || g.dataField, n);
                    o = h._formatValue(d, P, U, n, e, b);
                    C = o + ": " + C
                }
            }
            var D = h.renderer.getRect();
            if (G) {
                var J = a.jqx._ptrnd(h._pointMarker.x);
                var H = a.jqx._ptrnd(h._pointMarker.y);
                var B = h.crosshairsColor || h._defaultLineColor;
                if (s.polar || s.spider) {
                    var E = this._getPolarAxisCoords(n, this._plotRect);
                    var c = a.jqx._ptdist(J, H, E.x, E.y);
                    if (c > E.r) {
                        return
                    }
                    var A = Math.atan2(H - E.y, J - E.x);
                    var p = Math.cos(A) * E.r + E.x;
                    var W = Math.sin(A) * E.r + E.y;
                    if (h._ttEl.vLine) {
                        h.renderer.attr(h._ttEl.vLine, {
                            x1: E.x,
                            y1: E.y,
                            x2: p,
                            y2: W
                        })
                    } else {
                        h._ttEl.vLine = h.renderer.line(E.x, E.y, p, W, {
                            stroke: B,
                            "stroke-width": 0,
                            "stroke-dasharray": h.crosshairsDashStyle || ""
                        })
                    }
                } else {
                    if (h._ttEl.vLine && h._ttEl.hLine) {
                        h.renderer.attr(h._ttEl.vLine, {
                            x1: J,
                            x2: J
                        });
                        h.renderer.attr(h._ttEl.hLine, {
                            y1: H,
                            y2: H
                        })
                    } else {
                        h._ttEl.vLine = h.renderer.line(J, h._plotRect.y, J, h._plotRect.y + h._plotRect.height, {
                            stroke: B,
                            "stroke-width": 0,
                            "stroke-dasharray": h.crosshairsDashStyle || ""
                        });
                        h._ttEl.hLine = h.renderer.line(h._plotRect.x, H, h._plotRect.x + h._plotRect.width, H, {
                            stroke: B,
                            "stroke-width": 0,
                            "stroke-dasharray": h.crosshairsDashStyle || ""
                        })
                    }
                }
            }
            if (!X && h.showToolTips != false) {
                var Q = this._get([g.toolTipClass, s.toolTipClass, h.toolTipClass, this.toThemeProperty("jqx-chart-tooltip-text", null)]);
                var u = this._get([g.toolTipBackground, s.toolTipBackground, h.toolTipBackground, "#FFFFFF"]);
                var r = this._get([g.toolTipLineColor, s.toolTipLineColor, h.toolTipLineColor, O.lineColor]);
                var R = this._get([g.toolTipOpacity, s.toolTipOpacity, h.toolTipOpacity, 1]);
                var q = this.getItemCoord(n, e, b);
                var V = 0;
                if (h._pointMarker && h._pointMarker.element) {
                    V = g.symbolSizeSelected;
                    if (isNaN(V)) {
                        V = g.symbolSize
                    }
                    if (isNaN(V) || V > 50 || V < 0) {
                        V = s.symbolSize
                    }
                    if (isNaN(V) || V > 50 || V < 0) {
                        V = 8
                    }
                }
                h._createTooltip(q, s, C, {
                    css: Q,
                    fill: u,
                    stroke: r,
                    fillOpacity: R,
                    symbolSize: V
                })
            }
        },
        _fitTooltip: function(c, h, j, k, e) {
            var d = {};
            var b = 2 + e / 2;
            var f = 7;
            if (h.x - j.width - f - b > c.x && h.y + h.height / 2 - j.height / 2 > c.y && h.y + h.height / 2 + j.height / 2 < c.y + c.height) {
                d.left = {
                    arrowLocation: "right",
                    x: h.x - j.width - f - b,
                    y: h.y + h.height / 2 - j.height / 2,
                    width: j.width + f,
                    height: j.height
                }
            }
            if (h.x + h.width + j.width + f + b < c.x + c.width && h.y + h.height / 2 - j.height / 2 > c.y && h.y + h.height / 2 + j.height / 2 < c.y + c.height) {
                d.right = {
                    arrowLocation: "left",
                    x: h.x + h.width + b,
                    y: h.y + h.height / 2 - j.height / 2,
                    width: j.width + f,
                    height: j.height
                }
            }
            if (h.y - j.height - b - f > c.y && h.x + h.width / 2 - j.width / 2 > c.x && h.x + h.width / 2 + j.width / 2 < c.x + c.width) {
                d.top = {
                    arrowLocation: "bottom",
                    x: h.x + h.width / 2 - j.width / 2,
                    y: h.y - j.height - b - f,
                    width: j.width,
                    height: j.height + f
                }
            }
            if (h.y + h.height + j.height + f + b < c.y + c.height && h.x + h.width / 2 - j.width / 2 > c.x && h.x + h.width / 2 + j.width / 2 < c.x + c.width) {
                d.bottom = {
                    arrowLocation: "top",
                    x: h.x + h.width / 2 - j.width / 2,
                    y: h.y + h.height + b,
                    width: j.width,
                    height: j.height + f
                }
            }
            if (h.width > h.height || ((k.type.indexOf("stackedcolumn") != -1 || k.type.indexOf("stackedwaterfall") != -1) && k.orientation != "horizontal")) {
                if (d.left) {
                    return d.left
                }
                if (d.right) {
                    return d.right
                }
            } else {
                if (d.top) {
                    return d.top
                }
                if (d.bottom) {
                    return d.bottom
                }
            }
            for (var g in d) {
                if (d[g]) {
                    return d[g]
                }
            }
            return {
                arrowLocation: ""
            }
        },
        _createTooltip: function(G, l, A, B) {
            var u = this;
            var z = l.type;
            var E = false;
            var F = u._ttEl.box;
            if (!F) {
                E = true;
                F = u._ttEl.box = document.createElement("div");
                var f = 10000000;
                F.style.position = "absolute";
                F.style.cursor = "default";
                a(b).css({
                    "z-index": f,
                    "box-sizing": "content-box"
                });
                a(F).css({
                    "z-index": f
                });
                a(document.body).append(F);
                var b = document.createElement("div");
                b.id = "arrowOuterDiv";
                b.style.width = "0px";
                b.style.height = "0px";
                b.style.position = "absolute";
                a(b).css({
                    "z-index": f + 1,
                    "box-sizing": "content-box"
                });
                var h = document.createElement("div");
                h.id = "arrowInnerDiv";
                h.style.width = "0px";
                h.style.height = "0px";
                h.style.position = "absolute";
                var w = document.createElement("div");
                w.id = "contentDiv";
                w.style.position = "absolute";
                a(w).css({
                    "box-sizing": "content-box",
                    outline: "none",
                    border: "1px solid transparent",
                    padding: "3px",
                    "text-align": "center",
                    "vertical-align": "middle",
                    margin: "0 0 0 0",
                    cursor: "default"
                });
                a(w).addClass("jqx-rc-all");
                a(w).appendTo(a(F));
                a(b).appendTo(a(F));
                a(h).appendTo(a(F));
                a(h).css({
                    "z-index": f + 2,
                    "box-sizing": "content-box"
                })
            }
            if (!A || A.length == 0) {
                a(F).fadeTo(0, 0);
                return
            }
            w = a(F).find("#contentDiv")[0];
            b = a(F).find("#arrowOuterDiv")[0];
            h = a(F).find("#arrowInnerDiv")[0];
            h.style.opacity = b.style.opacity = B.fillOpacity;
            w.style.backgroundColor = B.fill;
            w.style.borderColor = B.stroke;
            w.style.opacity = B.fillOpacity;
            var p = "<span class='" + B.css + "'>" + A + "</span>";
            a(w).html(p);
            var t = this._measureHtml(p, "jqx-rc-all jqx-button");
            var c = u._plotRect;
            if (t.width > c.width || t.height > c.height) {
                return
            }
            var r = {
                width: t.width,
                height: t.height
            };
            var j = "";
            var D = 5;
            var s = 7;
            var v = u._isColumnType(z);
            var o = Math.max(G.x, c.x);
            var m = Math.max(G.y, c.y);
            if (u.toolTipAlignment == "dataPoint") {
                if (z.indexOf("pie") != -1 || z.indexOf("donut") != -1) {
                    var n = (G.fromAngle + G.toAngle) / 2;
                    n = n * (Math.PI / 180);
                    var g = (!isNaN(G.innerRadius) && G.innerRadius > 0) ? (G.innerRadius + G.outerRadius) / 2 : G.outerRadius * 0.75;
                    o = G.x = G.center.x + Math.cos(n) * g;
                    m = G.y = G.center.y - Math.sin(n) * g;
                    G.width = G.height = 1
                } else {
                    if (v && (l.polar || l.spider)) {
                        G.width = G.height = 1
                    }
                }
                var C = this._fitTooltip(this._plotRect, G, r, l, B.symbolSize);
                if (C.arrowLocation != "") {
                    j = C.arrowLocation;
                    o = C.x;
                    m = C.y;
                    r.width = C.width;
                    r.height = C.height
                }
            } else {
                j = ""
            }
            if (j == "top" || j == "bottom") {
                r.height += s;
                o -= s / 2;
                if (j == "bottom") {
                    m -= s
                }
            } else {
                if (j == "left" || j == "right") {
                    r.width += s;
                    m -= s / 2;
                    if (j == "right") {
                        o -= s
                    }
                }
            }
            if (o + r.width > c.x + c.width) {
                j = "";
                o = c.x + c.width - r.width
            }
            if (m + r.height > c.y + c.height) {
                j = "";
                m = c.y + c.height - r.height
            }
            var i = {
                    x: 0,
                    y: 0
                },
                e = {
                    x: 0,
                    y: 0
                };
            a(w).css({
                width: t.width,
                height: t.height,
                left: 0,
                top: 0
            });
            b.style["margin-top"] = b.style["margin-left"] = 0;
            h.style["margin-top"] = h.style["margin-left"] = 0;
            w.style["margin-top"] = w.style["margin-left"] = 0;
            var k = s + "px solid";
            var d = s + "px solid transparent";
            switch (j) {
                case "left":
                    i = {
                        x: 0,
                        y: (t.height - s) / 2
                    };
                    e = {
                        x: s,
                        y: 0
                    };
                    w.style["margin-left"] = s + "px";
                    b.style["margin-left"] = 0 + "px";
                    b.style["margin-top"] = i.y + "px";
                    b.style["border-left"] = "";
                    b.style["border-right"] = k + " " + B.stroke;
                    b.style["border-top"] = d;
                    b.style["border-bottom"] = d;
                    h.style["margin-left"] = 1 + "px";
                    h.style["margin-top"] = i.y + "px";
                    h.style["border-left"] = "";
                    h.style["border-right"] = k + " " + B.fill;
                    h.style["border-top"] = d;
                    h.style["border-bottom"] = d;
                    break;
                case "right":
                    i = {
                        x: r.width - s,
                        y: (t.height - s) / 2
                    };
                    e = {
                        x: 0,
                        y: 0
                    };
                    b.style["margin-left"] = i.x + "px";
                    b.style["margin-top"] = i.y + "px";
                    b.style["border-left"] = k + " " + B.stroke;
                    b.style["border-right"] = "";
                    b.style["border-top"] = d;
                    b.style["border-bottom"] = d;
                    h.style["margin-left"] = i.x - 1 + "px";
                    h.style["margin-top"] = i.y + "px";
                    h.style["border-left"] = k + " " + B.fill;
                    h.style["border-right"] = "";
                    h.style["border-top"] = d;
                    h.style["border-bottom"] = d;
                    break;
                case "top":
                    i = {
                        x: r.width / 2 - s / 2,
                        y: 0
                    };
                    e = {
                        x: 0,
                        y: s
                    };
                    w.style["margin-top"] = e.y + "px";
                    b.style["margin-left"] = i.x + "px";
                    b.style["border-top"] = "";
                    b.style["border-bottom"] = k + " " + B.stroke;
                    b.style["border-left"] = d;
                    b.style["border-right"] = d;
                    h.style["margin-left"] = i.x + "px";
                    h.style["margin-top"] = 1 + "px";
                    h.style["border-top"] = "";
                    h.style["border-bottom"] = k + " " + B.fill;
                    h.style["border-left"] = d;
                    h.style["border-right"] = d;
                    break;
                case "bottom":
                    i = {
                        x: r.width / 2 - s / 2,
                        y: r.height - s
                    };
                    e = {
                        x: 0,
                        y: 0
                    };
                    b.style["margin-left"] = i.x + "px";
                    b.style["margin-top"] = i.y + "px";
                    b.style["border-top"] = k + " " + B.stroke;
                    b.style["border-bottom"] = "";
                    b.style["border-left"] = d;
                    b.style["border-right"] = d;
                    h.style["margin-left"] = i.x + "px";
                    h.style["margin-top"] = i.y - 1 + "px";
                    h.style["border-top"] = k + " " + B.fill;
                    h.style["border-bottom"] = "";
                    h.style["border-left"] = d;
                    h.style["border-right"] = d;
                    break
            }
            if (j == "") {
                a(b).hide();
                a(h).hide()
            } else {
                a(b).show();
                a(h).show()
            }
            a(F).css({
                width: r.width + "px",
                height: r.height + "px"
            });
            var q = u.host.coord();
            if (E) {
                a(F).fadeOut(0, 0);
                F.style.left = o + q.left + "px";
                F.style.top = m + q.top + "px"
            }
            a(F).clearQueue();
            a(F).animate({
                left: o + q.left,
                top: m + q.top,
                opacity: 1
            }, u.toolTipMoveDuration, "easeInOutCirc");
            a(F).fadeTo(400, 1)
        },
        _measureHtml: function(c, b) {
            var e = this._measureDiv;
            if (!e) {
                this._measureDiv = e = document.createElement("div");
                e.style.position = "absolute";
                e.style.cursor = "default";
                e.style.overflow = "hidden";
                e.style.display = "none";
                a(e).addClass(b);
                this.host.append(e)
            }
            a(e).html(c);
            var d = {
                width: a(e).width() + 2,
                height: a(e).height() + 2
            };
            if (a.jqx.browser && a.jqx.browser.mozilla) {
                d.height += 3
            }
            return d
        },
        _hideToolTip: function(b) {
            if (!this._ttEl) {
                return
            }
            if (this._ttEl.box) {
                if (b == 0) {
                    a(this._ttEl.box).hide()
                } else {
                    a(this._ttEl.box).fadeOut()
                }
            }
            this._hideCrosshairs();
            this._ttEl.gidx = undefined
        },
        _hideCrosshairs: function() {
            if (!this._ttEl) {
                return
            }
            if (this._ttEl.vLine) {
                this.renderer.removeElement(this._ttEl.vLine);
                this._ttEl.vLine = undefined
            }
            if (this._ttEl.hLine) {
                this.renderer.removeElement(this._ttEl.hLine);
                this._ttEl.hLine = undefined
            }
        },
        _get: function(b) {
            return a.jqx.getByPriority(b)
        },
        _getAxisSettings: function(f) {
            if (!f) {
                return {}
            }
            var l = this;
            var k = f.gridLines || {};
            var n = {
                visible: this._get([k.visible, f.showGridLines, true]),
                color: l._get([k.color, f.gridLinesColor, l._defaultLineColor]),
                unitInterval: l._get([k.unitInterval, k.interval, f.gridLinesInterval]),
                step: l._get([k.step, f.gridLinesStep]),
                dashStyle: l._get([k.dashStyle, f.gridLinesDashStyle]),
                width: l._get([k.lineWidth, 1]),
                offsets: [],
                alternatingBackgroundColor: f.alternatingBackgroundColor,
                alternatingBackgroundColor2: f.alternatingBackgroundColor2,
                alternatingBackgroundOpacity: f.alternatingBackgroundOpacity
            };
            var d = f.tickMarks || {};
            var h = {
                visible: this._get([d.visible, f.showTickMarks, true]),
                color: l._get([d.color, f.tickMarksColor, l._defaultLineColor]),
                unitInterval: l._get([d.unitInterval, d.interval, f.tickMarksInterval]),
                step: l._get([d.step, f.tickMarksStep]),
                dashStyle: l._get([d.dashStyle, f.tickMarksDashStyle]),
                width: l._get([d.lineWidth, 1]),
                size: l._get([d.size, 4]),
                offsets: []
            };
            var e = f.title || {};
            var c = {
                visible: l._get([e.visible, true]),
                text: l._get([f.description, e.text]),
                style: l._get([f.descriptionClass, e["class"], l.toThemeProperty("jqx-chart-axis-description", null)]),
                halign: l._get([f.horizontalDescriptionAlignment, e.horizontalAlignment, "center"]),
                valign: l._get([f.verticalDescriptionAlignment, e.verticalAlignment, "center"]),
                angle: 0,
                rotationPoint: l._get([e.rotationPoint, "centercenter"]),
                offset: l._get([e.offset, {
                    x: 0,
                    y: 0
                }])
            };
            var i = f.line || {};
            var b = {
                visible: l._get([i.visible, true]),
                color: l._get([i.color, n.color, l._defaultLineColor]),
                dashStyle: l._get([i.dashStyle, n.dashStyle, ""]),
                width: l._get([i.lineWidth, 1]),
                angle: l._get([i.angle, NaN])
            };
            var j = f.padding || {};
            j = {
                left: j.left || 0,
                right: j.right || 0,
                top: j.top || 0,
                bottom: j.bottom || 0
            };
            var g = this._getAxisLabelsSettings(f);
            var m = {
                visible: this._get([f.visible, f.showValueAxis, f.showXAxis, f.showCategoryAxis, true]),
                customDraw: this._get([f.customDraw, false]),
                gridLines: n,
                tickMarks: h,
                line: b,
                title: c,
                labels: g,
                padding: j,
                toolTipFormatFunction: this._get([f.toolTipFormatFunction, f.formatFunction, g.formatFunction]),
                toolTipFormatSettings: this._get([f.toolTipFormatSettings, f.formatSettings, g.formatSettings])
            };
            return m
        },
        _getAxisLabelsSettings: function(d) {
            var b = this;
            var e = d.labels || {};
            var c = {
                visible: b._get([d.showLabels, e.visible, true]),
                unitInterval: b._get([e.unitInterval, e.interval, d.labelsInterval]),
                step: b._get([e.step, d.labelsStep]),
                angle: b._get([d.textRotationAngle, e.angle, 0]),
                style: b._get([d["class"], e["class"], b.toThemeProperty("jqx-chart-axis-text", null)]),
                halign: b._get([d.horizontalTextAlignment, e.horizontalAlignment, "center"]),
                valign: b._get([d.verticalTextAlignment, e.verticalAlignment, "center"]),
                textRotationPoint: b._get([d.textRotationPoint, e.rotationPoint, "auto"]),
                textOffset: b._get([d.textOffset, e.offset, {
                    x: 0,
                    y: 0
                }]),
                autoRotate: b._get([d.labelsAutoRotate, e.autoRotate, false]),
                formatSettings: b._get([d.formatSettings, e.formatSettings, undefined]),
                formatFunction: b._get([d.formatFunction, e.formatFunction, undefined])
            };
            return c
        },
        _getLabelsSettings: function(p, l, h, t) {
            var j = this.seriesGroups[p];
            var r = j.series[l];
            var m = isNaN(h) ? undefined : this._getDataValue(h, r.dataField, p);
            var k = t || ["Visible", "Offset", "Angle", "HorizontalAlignment", "VerticalAlignment", "Class", "BackgroundColor", "BorderColor", "BorderOpacity", "Padding", "Opacity", "BackgroundOpacity", "LinesAngles", "LinesEnabled", "AutoRotate", "Radius"];
            var q = {};
            for (var f = 0; f < k.length; f++) {
                var n = k[f];
                var c = "labels" + n;
                var b = "label" + n;
                var o = n.substring(0, 1).toLowerCase() + n.substring(1);
                var d = undefined;
                if (j.labels && typeof(j.labels) == "object") {
                    d = j.labels[o]
                }
                if (r.labels && typeof(r.labels) == "object" && undefined != r.labels[o]) {
                    d = r.labels[o]
                }
                d = this._get([r[c], r[b], d, j[c], j[b]]);
                if (a.isFunction(d)) {
                    q[o] = d(m, h, r, j)
                } else {
                    q[o] = d
                }
            }
            q["class"] = q["class"] || this.toThemeProperty("jqx-chart-label-text", null);
            q.visible = this._get([q.visible, r.showLabels, j.showLabels, r.labels != undefined ? true : undefined, j.labels != undefined ? true : undefined]);
            var e = q.padding || 1;
            q.padding = {
                left: this._get([e.left, isNaN(e) ? 1 : e]),
                right: this._get([e.right, isNaN(e) ? 1 : e]),
                top: this._get([e.top, isNaN(e) ? 1 : e]),
                bottom: this._get([e.bottom, isNaN(e) ? 1 : e])
            };
            return q
        },
        _showLabel: function(J, E, f, b, t, i, e, k, c, F, B) {
            var m = this.seriesGroups[J];
            var r = m.series[E];
            var C = {
                    width: 0,
                    height: 0
                },
                q;
            if (isNaN(f)) {
                return
            }
            var I = this._getLabelsSettings(J, E, f);
            if (!I.visible) {
                return e ? C : undefined
            }
            if (b.width < 0 || b.height < 0) {
                return e ? C : undefined
            }
            var g = I.angle;
            if (!isNaN(F)) {
                g = F
            }
            var j = I.offset || {};
            var G = {
                x: j.x,
                y: j.y
            };
            if (isNaN(G.x)) {
                G.x = 0
            }
            if (isNaN(G.y)) {
                G.y = 0
            }
            t = t || I.horizontalAlignment || "center";
            i = i || I.verticalAlignment || "center";
            var v = this._getFormattedValue(J, E, f, undefined, undefined, true);
            var s = b.width;
            var H = b.height;
            if (k == true && t != "center") {
                t = t == "right" ? "left" : "right"
            }
            if (c == true && i != "center" && i != "middle") {
                i = i == "top" ? "bottom" : "top";
                G.y *= -1
            }
            C = this.renderer.measureText(v, g, {
                "class": I["class"]
            });
            if (e) {
                return C
            }
            var p = 0,
                n = 0;
            if (s > 0) {
                if (t == "" || t == "center") {
                    p += (s - C.width) / 2
                } else {
                    if (t == "right") {
                        p += (s - C.width)
                    }
                }
            }
            if (H > 0) {
                if (i == "" || i == "center") {
                    n += (H - C.height) / 2
                } else {
                    if (i == "bottom") {
                        n += (H - C.height)
                    }
                }
            }
            p += b.x + G.x;
            n += b.y + G.y;
            var o = this._plotRect;
            if (p <= o.x) {
                p = o.x + 2
            }
            if (n <= o.y) {
                n = o.y + 2
            }
            var l = {
                width: Math.max(C.width, 1),
                height: Math.max(C.height, 1)
            };
            if (n + l.height >= o.y + o.height) {
                n = o.y + o.height - (q ? (l.height + q.height) / 2 : l.height) - 2
            }
            if (p + l.width >= o.x + o.width) {
                p = o.x + o.width - l.width - 2
            }
            var d;
            var A = I.backgroundColor;
            var D = I.borderColor;
            var z = I.padding;
            if (A || D) {
                d = this.renderer.beginGroup();
                var b = this.renderer.rect(p - z.left, n - z.top, C.width + z.left + z.right, C.height + z.bottom + z.bottom, {
                    fill: A || "transparent",
                    "fill-opacity": I.backgroundOpacity || 1,
                    stroke: D || "transparent",
                    "stroke-opacity": I.borderOpacity,
                    "stroke-width": 0
                })
            }
            var u = this.renderer.text(v, p, n, C.width, C.height, g, {
                "class": I["class"],
                opacity: I.opacity || 1
            }, false, "center", "center");
            if (B) {
                B.x = p - z.left;
                B.y = n - z.top;
                B.width = C.width + z.left + z.right;
                B.height = C.height + z.bottom + z.bottom
            }
            if (this._isVML) {
                this.renderer.removeElement(u);
                this.renderer.getContainer()[0].appendChild(u)
            }
            if (d) {
                this.renderer.endGroup()
            }
            return d || u
        },
        _getAnimProps: function(j, f) {
            var e = this.seriesGroups[j];
            var c = !isNaN(f) ? e.series[f] : undefined;
            var b = this.enableAnimations == true;
            if (e.enableAnimations) {
                b = e.enableAnimations == true
            }
            if (c && c.enableAnimations) {
                b = c.enableAnimations == true
            }
            var i = this.animationDuration;
            if (isNaN(i)) {
                i = 1000
            }
            var d = e.animationDuration;
            if (!isNaN(d)) {
                i = d
            }
            if (c) {
                var h = c.animationDuration;
                if (!isNaN(h)) {
                    i = h
                }
            }
            if (i > 5000) {
                i = 1000
            }
            return {
                enabled: b,
                duration: i
            }
        },
        _isColorTransition: function(f, d, e, g) {
            if (g - 1 < e.xoffsets.first) {
                return false
            }
            var b = this._getColors(f, d, g, this._getGroupGradientType(f));
            var c = this._getColors(f, d, g - 1, this._getGroupGradientType(f));
            return (b.fillColor != c.fillColor)
        },
        _renderLineSeries: function(k, Q) {
            var H = this.seriesGroups[k];
            if (!H.series || H.series.length == 0) {
                return
            }
            var s = H.type.indexOf("area") != -1;
            var K = H.type.indexOf("stacked") != -1;
            var e = K && H.type.indexOf("100") != -1;
            var ae = H.type.indexOf("spline") != -1;
            var t = H.type.indexOf("step") != -1;
            var O = H.type.indexOf("range") != -1;
            var af = H.polar == true || H.spider == true;
            if (af) {
                t = false
            }
            if (t && ae) {
                return
            }
            var z = this._getDataLen(k);
            var ac = Q.width / z;
            var aj = H.orientation == "horizontal";
            var B = this._getXAxis(k).flip == true;
            var y = Q;
            if (aj) {
                y = {
                    x: Q.y,
                    y: Q.x,
                    width: Q.height,
                    height: Q.width
                }
            }
            var C = this._calcGroupOffsets(k, y);
            if (!C || C.xoffsets.length == 0) {
                return
            }
            if (!this._linesRenderInfo) {
                this._linesRenderInfo = {}
            }
            this._linesRenderInfo[k] = {};
            for (var n = H.series.length - 1; n >= 0; n--) {
                var g = this._getSerieSettings(k, n);
                var ah = {
                    groupIndex: k,
                    rect: y,
                    serieIndex: n,
                    swapXY: aj,
                    isArea: s,
                    isSpline: ae,
                    isRange: O,
                    isPolar: af,
                    settings: g,
                    segments: [],
                    pointsLength: 0
                };
                var j = this._isSerieVisible(k, n);
                if (!j) {
                    this._linesRenderInfo[k][n] = ah;
                    continue
                }
                var J = H.series[n];
                if (J.customDraw) {
                    continue
                }
                var w = a.isFunction(J.colorFunction);
                var U = C.xoffsets.first;
                var G = U;
                var N = this._getColors(k, n, NaN, this._getGroupGradientType(k));
                var ab = false;
                var u;
                do {
                    var W = [];
                    var T = [];
                    var r = [];
                    var P = -1;
                    var p = 0,
                        o = 0;
                    var R = NaN;
                    var E = NaN;
                    var ai = NaN;
                    if (C.xoffsets.length < 1) {
                        continue
                    }
                    var S = this._getAnimProps(k, n);
                    var L = S.enabled && !this._isToggleRefresh && C.xoffsets.length < 10000 && this._isVML != true ? S.duration : 0;
                    var v = U;
                    u = false;
                    var d = this._getColors(k, n, U, this._getGroupGradientType(k));
                    var D = undefined;
                    for (var ad = U; ad <= C.xoffsets.last; ad++) {
                        U = ad;
                        var X = C.xoffsets.data[ad];
                        var V = C.xoffsets.xvalues[ad];
                        if (isNaN(X)) {
                            continue
                        }
                        X = Math.max(X, 1);
                        p = X;
                        o = C.offsets[n][ad].to;
                        if (!w && D && this.enableSampling && a.jqx._ptdist(D.x, D.y, p, o) < 1) {
                            continue
                        }
                        D = {
                            x: p,
                            y: o
                        };
                        var aa = C.offsets[n][ad].from;
                        if (isNaN(o) || isNaN(aa)) {
                            if (J.emptyPointsDisplay == "connect") {
                                continue
                            } else {
                                if (J.emptyPointsDisplay == "zero") {
                                    if (isNaN(o)) {
                                        o = C.baseOffset
                                    }
                                    if (isNaN(aa)) {
                                        aa = C.baseOffset
                                    }
                                } else {
                                    u = true;
                                    break
                                }
                            }
                        }
                        if (w && this._isColorTransition(k, n, C, U)) {
                            if (W.length > 1) {
                                U--;
                                break
                            }
                        }
                        var c = this._elementRenderInfo;
                        if (c && c.length > k && c[k].series.length > n) {
                            var f = c[k].series[n][V];
                            var ai = a.jqx._ptrnd(f ? f.to : undefined);
                            var I = a.jqx._ptrnd(y.x + (f ? f.xoffset : undefined));
                            r.push(aj ? {
                                y: I,
                                x: ai,
                                index: ad
                            } : {
                                x: I,
                                y: ai,
                                index: ad
                            })
                        }
                        G = ad;
                        if (g.stroke < 2) {
                            if (o - y.y <= 1) {
                                o = y.y + 1
                            }
                            if (aa - y.y <= 1) {
                                aa = y.y + 1
                            }
                            if (y.y + y.height - o <= 1) {
                                o = y.y + y.height - 1
                            }
                            if (y.y + y.height - aa <= 1) {
                                aa = y.y + y.height - 1
                            }
                        }
                        if (!s && e) {
                            if (o <= y.y) {
                                o = y.y + 1
                            }
                            if (o >= y.y + y.height) {
                                o = y.y + y.height - 1
                            }
                            if (aa <= y.y) {
                                aa = y.y + 1
                            }
                            if (aa >= y.y + y.height) {
                                aa = y.y + y.height - 1
                            }
                        }
                        X = Math.max(X, 1);
                        p = X + y.x;
                        if (H.skipOverlappingPoints == true && !isNaN(R) && Math.abs(R - p) <= 1) {
                            continue
                        }
                        if (t && !isNaN(R) && !isNaN(E)) {
                            if (E != o) {
                                W.push(aj ? {
                                    y: p,
                                    x: a.jqx._ptrnd(E)
                                } : {
                                    x: p,
                                    y: a.jqx._ptrnd(E)
                                })
                            }
                        }
                        W.push(aj ? {
                            y: p,
                            x: a.jqx._ptrnd(o),
                            index: ad
                        } : {
                            x: p,
                            y: a.jqx._ptrnd(o),
                            index: ad
                        });
                        T.push(aj ? {
                            y: p,
                            x: a.jqx._ptrnd(aa),
                            index: ad
                        } : {
                            x: p,
                            y: a.jqx._ptrnd(aa),
                            index: ad
                        });
                        R = p;
                        E = o;
                        if (isNaN(ai)) {
                            ai = o
                        }
                    }
                    if (W.length == 0) {
                        U++;
                        continue
                    }
                    var F = W[W.length - 1].index;
                    if (w) {
                        N = this._getColors(k, n, F, this._getGroupGradientType(k))
                    }
                    var l = y.x + C.xoffsets.data[v];
                    var Z = y.x + C.xoffsets.data[G];
                    if (s && H.alignEndPointsWithIntervals == true) {
                        var A = B ? -1 : 1;
                        if (l > y.x) {
                            l = y.x
                        }
                        if (Z < y.x + y.width) {
                            Z = y.x + y.width
                        }
                        if (B) {
                            var Y = l;
                            l = Z;
                            Z = Y
                        }
                    }
                    Z = a.jqx._ptrnd(Z);
                    l = a.jqx._ptrnd(l);
                    var m = C.baseOffset;
                    ai = a.jqx._ptrnd(ai);
                    var h = a.jqx._ptrnd(o) || m;
                    if (O) {
                        W = W.concat(T.reverse())
                    }
                    ah.pointsLength += W.length;
                    var b = {
                        lastItemIndex: F,
                        colorSettings: N,
                        pointsArray: W,
                        pointsStart: r,
                        left: l,
                        right: Z,
                        pyStart: ai,
                        pyEnd: h,
                        yBase: m,
                        labelElements: [],
                        symbolElements: []
                    };
                    ah.segments.push(b)
                } while (U < C.xoffsets.first + C.xoffsets.length - 1 || u);
                this._linesRenderInfo[k][n] = ah
            }
            var M = this._linesRenderInfo[k];
            var ag = [];
            for (var ad in M) {
                ag.push(M[ad])
            }
            ag = ag.sort(function(x, i) {
                return x.serieIndex - i.serieIndex
            });
            if (s && K) {
                ag.reverse()
            }
            for (var ad = 0; ad < ag.length; ad++) {
                var ah = ag[ad];
                this._animateLine(ah, L == 0 ? 1 : 0);
                var q = this;
                this._enqueueAnimation("series", undefined, undefined, L, function(x, i, ak) {
                    q._animateLine(i, ak)
                }, ah)
            }
        },
        _animateLine: function(w, b) {
            var A = w.settings;
            var f = w.groupIndex;
            var g = w.serieIndex;
            var j = this.seriesGroups[f];
            var s = j.series[g];
            var v = this._getSymbol(f, g);
            var p = this._getLabelsSettings(f, g, NaN, ["Visible"]).visible;
            var o = true;
            if (w.isPolar) {
                if (!isNaN(j.endAngle) && Math.round(Math.abs((isNaN(j.startAngle) ? 0 : j.startAngle) - j.endAngle)) != 360) {
                    o = false
                }
            }
            if (s.endPointsConnect == false) {
                o = false
            }
            var q = 0;
            for (var d = 0; d < w.segments.length; d++) {
                var u = w.segments[d];
                var x = this._calculateLine(f, w.pointsLength, q, u.pointsArray, u.pointsStart, u.yBase, b, w.isArea, w.swapXY);
                q += u.pointsArray.length;
                if (x == "") {
                    continue
                }
                var r = x.split(" ");
                var y = r.length;
                var h = x;
                if (h != "") {
                    h = this._buildLineCmd(x, w.isRange, u.left, u.right, u.pyStart, u.pyEnd, u.yBase, w.isArea, w.isPolar, o, w.isSpline, w.swapXY)
                } else {
                    h = "M 0 0"
                }
                var l = u.colorSettings;
                if (!u.pathElement) {
                    u.pathElement = this.renderer.path(h, {
                        "stroke-width": 0,
                        stroke: l.lineColor,
                        "stroke-opacity": A.opacity,
                        "fill-opacity": A.opacity,
                        "stroke-dasharray": A.dashStyle,
                        fill: w.isArea ? l.fillColor : "none"
                    });
                    this._installHandlers(u.pathElement, "path", f, g, u.lastItemIndex)
                } else {
                    this.renderer.attr(u.pathElement, {
                        d: h
                    })
                }
                if (u.labelElements) {
                    for (var z = 0; z < u.labelElements.length; z++) {
                        this.renderer.removeElement(u.labelElements[z])
                    }
                    u.labelElements = []
                }
                if (u.symbolElements) {
                    for (var z = 0; z < u.symbolElements.length; z++) {
                        this.renderer.removeElement(u.symbolElements[z])
                    }
                    u.symbolElements = []
                }
                if (u.pointsArray.length == r.length) {
                    if (v != "none" || p) {
                        var C = s.symbolSize;
                        var B = this._plotRect;
                        for (var z = 0; z < r.length; z++) {
                            var t = r[z].split(",");
                            t = {
                                x: parseFloat(t[0]),
                                y: parseFloat(t[1])
                            };
                            if (t.x < B.x || t.x > B.x + B.width || t.y < B.y || t.y > B.y + B.height) {
                                continue
                            }
                            if (v != "none") {
                                var n = this._getColors(f, g, u.pointsArray[z].index, this._getGroupGradientType(f));
                                var e = this._drawSymbol(v, t.x, t.y, n.fillColorSymbol, A.opacity, n.lineColorSymbol, A.opacity, A.strokeSymbol, undefined, C);
                                u.symbolElements.push(e)
                            }
                            if (p) {
                                var k = (z > 0 ? r[z - 1] : r[z]).split(",");
                                k = {
                                    x: parseFloat(k[0]),
                                    y: parseFloat(k[1])
                                };
                                var m = (z < r.length - 1 ? r[z + 1] : r[z]).split(",");
                                m = {
                                    x: parseFloat(m[0]),
                                    y: parseFloat(m[1])
                                };
                                t = this._adjustLineLabelPosition(f, g, u.pointsArray[z].index, t, k, m);
                                if (t) {
                                    var c = this._showLabel(f, g, u.pointsArray[z].index, {
                                        x: t.x,
                                        y: t.y,
                                        width: 0,
                                        height: 0
                                    });
                                    u.labelElements.push(c)
                                }
                            }
                        }
                    }
                }
                if (b == 1 && v != "none") {
                    for (var z = 0; z < u.symbolElements.length; z++) {
                        if (isNaN(u.pointsArray[z].index)) {
                            continue
                        }
                        this._installHandlers(u.symbolElements[z], "symbol", f, g, u.pointsArray[z].index)
                    }
                }
            }
        },
        _adjustLineLabelPosition: function(i, g, d, h, f, e) {
            var b = this._showLabel(i, g, d, {
                width: 0,
                height: 0
            }, "", "", true);
            if (!b) {
                return
            }
            var c = {
                x: h.x - b.width / 2,
                y: 0
            };
            c.y = h.y - 1.5 * b.height;
            return c
        },
        _calculateLine: function(h, v, p, o, n, f, e, z, c) {
            var w = this.seriesGroups[h];
            var m;
            if (w.polar == true || w.spider == true) {
                m = this._getPolarAxisCoords(h, this._plotRect)
            }
            var s = "";
            var t = o.length;
            if (!z && n.length == 0) {
                var r = v * e;
                t = r - p
            }
            var j = NaN;
            for (var u = 0; u < t + 1 && u < o.length; u++) {
                if (u > 0) {
                    s += " "
                }
                var k = o[u].y;
                var l = o[u].x;
                var b = !z ? k : f;
                var d = l;
                if (n && n.length > u) {
                    b = n[u].y;
                    d = n[u].x;
                    if (isNaN(b) || isNaN(d)) {
                        b = k;
                        d = l
                    }
                }
                j = d;
                if (t <= o.length && u > 0 && u == t) {
                    d = o[u - 1].x;
                    b = o[u - 1].y
                }
                if (c) {
                    l = a.jqx._ptrnd((l - b) * (z ? e : 1) + b);
                    k = a.jqx._ptrnd(k)
                } else {
                    l = a.jqx._ptrnd((l - d) * e + d);
                    k = a.jqx._ptrnd((k - b) * e + b)
                }
                if (m) {
                    var q = this._toPolarCoord(m, this._plotRect, l, k);
                    l = q.x;
                    k = q.y
                }
                s += l + "," + k
            }
            return s
        },
        _buildLineCmd: function(k, o, g, s, e, m, d, r, c, j, f, b) {
            var p = k;
            var l = b ? d + "," + g : g + "," + d;
            var h = b ? d + "," + s : s + "," + d;
            if (r && !c && !o) {
                p = l + " " + k + " " + h
            }
            if (f) {
                p = this._getBezierPoints(p)
            }
            var n = p.split(" ");
            if (n.length == 0) {
                return ""
            }
            if (n.length == 1) {
                var q = n[0].split(",");
                return "M " + n[0] + " L" + (parseFloat(q[0]) + 1) + "," + (parseFloat(q[1]) + 1)
            }
            var i = n[0].replace("M", "");
            if (r && !c) {
                if (!o) {
                    p = "M " + l + " L " + i + " " + p
                } else {
                    p = "M " + i + " L " + i + (f ? "" : (" L " + i + " ")) + p
                }
            } else {
                if (!f) {
                    p = "M " + i + " L " + i + " " + p
                }
            }
            if ((c && j) || o) {
                p += " Z"
            }
            return p
        },
        _getSerieSettings: function(i, c) {
            var h = this.seriesGroups[i];
            var g = h.type.indexOf("area") != -1;
            var f = h.type.indexOf("line") != -1;
            var d = h.series[c];
            var k = d.dashStyle || h.dashStyle || "";
            var e = d.opacity || h.opacity;
            if (isNaN(e) || e < 0 || e > 1) {
                e = 1
            }
            var j = d.lineWidth;
            if (isNaN(j) && j != "auto") {
                j = h.lineWidth
            }
            if (j == "auto" || isNaN(j) || j < 0 || j > 15) {
                if (g) {
                    j = 2
                } else {
                    if (f) {
                        j = 3
                    } else {
                        j = 1
                    }
                }
            }
            var b = d.lineWidthSymbol;
            if (isNaN(b)) {
                b = 1
            }
            return {
                stroke: j,
                strokeSymbol: b,
                opacity: e,
                dashStyle: k
            }
        },
        _getColors: function(u, p, d, e, b) {
            var k = this.seriesGroups[u];
            var o = k.series[p];
            var c = this._get([o.useGradientColors, k.useGradientColors, k.useGradient, true]);
            var l = this._getSeriesColors(u, p, d);
            if (!l.fillColor) {
                l.fillColor = r;
                l.fillColorSelected = a.jqx.adjustColor(r, 1.1);
                l.fillColorAlt = a.jqx.adjustColor(r, 4);
                l.fillColorAltSelected = a.jqx.adjustColor(r, 3);
                l.lineColor = l.symbolColor = a.jqx.adjustColor(r, 0.9);
                l.lineColorSelected = l.symbolColorSelected = a.jqx.adjustColor(r, 0.9)
            }
            var h = [
                [0, 1.4],
                [100, 1]
            ];
            var f = [
                [0, 1],
                [25, 1.1],
                [50, 1.4],
                [100, 1]
            ];
            var n = [
                [0, 1.3],
                [90, 1.2],
                [100, 1]
            ];
            var j = NaN;
            if (!isNaN(b)) {
                j = b == 2 ? h : f
            }
            if (c) {
                var q = {};
                for (var s in l) {
                    q[s] = l[s]
                }
                l = q;
                if (e == "verticalLinearGradient" || e == "horizontalLinearGradient") {
                    var g = e == "verticalLinearGradient" ? j || h : j || f;
                    var m = ["fillColor", "fillColorSelected", "fillColorAlt", "fillColorAltSelected"];
                    for (var v in m) {
                        var r = l[m[v]];
                        if (r) {
                            l[m[v]] = this.renderer._toLinearGradient(r, e == "verticalLinearGradient", g)
                        }
                    }
                } else {
                    if (e == "radialGradient") {
                        var t;
                        var j = h;
                        if ((k.type == "pie" || k.type == "donut" || k.polar) && d != undefined && this._renderData[u] && this._renderData[u].offsets[p]) {
                            t = this._renderData[u].offsets[p][d];
                            j = n
                        }
                        l.fillColor = this.renderer._toRadialGradient(l.fillColor, j, t);
                        l.fillColorSelected = this.renderer._toRadialGradient(l.fillColorSelected, j, t)
                    }
                }
            }
            return l
        },
        _installHandlers: function(c, f, i, h, d) {
            if (!this.enableEvents) {
                return false
            }
            var j = this;
            var e = this.seriesGroups[i];
            var k = this.seriesGroups[i].series[h];
            var b = e.type.indexOf("line") != -1 || e.type.indexOf("area") != -1;
            if (!b && !(e.enableSelection == false || k.enableSelection == false)) {
                this.renderer.addHandler(c, "mousemove", function(m) {
                    var l = j._selected;
                    if (l && l.isLineType && l.linesUnselectMode == "click" && !(l.group == i && l.series == h)) {
                        return
                    }
                    var g = m.pageX || m.clientX || m.screenX;
                    var o = m.pageY || m.clientY || m.screenY;
                    var n = j.host.offset();
                    g -= n.left;
                    o -= n.top;
                    if (j._mouseX == g && j._mouseY == o) {
                        return
                    }
                    if (j._ttEl) {
                        if (j._ttEl.gidx == i && j._ttEl.sidx == h && j._ttEl.iidx == d) {
                            return
                        }
                    }
                    j._startTooltipTimer(i, h, d)
                })
            }
            if (!(e.enableSelection == false || k.enableSelection == false)) {
                this.renderer.addHandler(c, "mouseover", function(l) {
                    var g = j._selected;
                    if (g && g.isLineType && g.linesUnselectMode == "click" && !(g.group == i && g.series == h)) {
                        return
                    }
                    j._select(c, f, i, h, d, d)
                })
            }
            this.renderer.addHandler(c, "click", function(g) {
                clearTimeout(j._hostClickTimer);
                j._lastClickTs = (new Date()).valueOf();
                if (b && (f != "symbol" && f != "pointMarker")) {
                    return
                }
                if (j._isColumnType(e.type)) {
                    j._unselect()
                }
                if (isNaN(d)) {
                    return
                }
                g.stopImmediatePropagation();
                j._raiseItemEvent("click", e, k, d)
            })
        },
        _getHorizontalOffset: function(A, s, k, j) {
            var c = this._plotRect;
            var h = this._getDataLen(A);
            if (h == 0) {
                return {
                    index: undefined,
                    value: k
                }
            }
            var p = this._calcGroupOffsets(A, this._plotRect);
            if (p.xoffsets.length == 0) {
                return {
                    index: undefined,
                    value: undefined
                }
            }
            var n = k;
            var m = j;
            var w = this.seriesGroups[A];
            var l;
            if (w.polar || w.spider) {
                l = this._getPolarAxisCoords(A, c)
            }
            var e = this._getXAxis(A).flip == true;
            var b, o, v, f;
            for (var t = p.xoffsets.first; t <= p.xoffsets.last; t++) {
                var u = p.xoffsets.data[t];
                var d = p.offsets[s][t].to;
                var q = 0;
                if (l) {
                    var r = this._toPolarCoord(l, c, u + c.x, d);
                    u = r.x;
                    d = r.y;
                    q = a.jqx._ptdist(n, m, u, d)
                } else {
                    if (w.orientation == "horizontal") {
                        u += c.y;
                        var z = d;
                        d = u;
                        u = z;
                        q = a.jqx._ptdist(n, m, u, d)
                    } else {
                        u += c.x;
                        q = Math.abs(n - u)
                    }
                }
                if (isNaN(b) || b > q) {
                    b = q;
                    o = t;
                    v = u;
                    f = d
                }
            }
            return {
                index: o,
                value: p.xoffsets.data[o],
                polarAxisCoords: l,
                x: v,
                y: f
            }
        },
        onmousemove: function(k, j) {
            if (this._mouseX == k && this._mouseY == j) {
                return
            }
            this._mouseX = k;
            this._mouseY = j;
            if (!this._selected) {
                return
            }
            var B = this._selected.group;
            var q = this._selected.series;
            var v = this.seriesGroups[B];
            var n = v.series[q];
            var b = this._plotRect;
            if (this.renderer) {
                b = this.renderer.getRect();
                b.x += 5;
                b.y += 5;
                b.width -= 10;
                b.height -= 10
            }
            if (k < b.x || k > b.x + b.width || j < b.y || j > b.y + b.height) {
                this._hideToolTip();
                this._unselect();
                return
            }
            var e = v.orientation == "horizontal";
            var b = this._plotRect;
            if (v.type.indexOf("line") != -1 || v.type.indexOf("area") != -1) {
                var f = this._getHorizontalOffset(B, this._selected.series, k, j);
                var u = f.index;
                if (u == undefined) {
                    return
                }
                if (this._selected.item != u) {
                    var p = this._linesRenderInfo[B][q].segments;
                    var r = 0;
                    while (u > p[r].lastItemIndex) {
                        r++;
                        if (r >= p.length) {
                            return
                        }
                    }
                    var c = p[r].pathElement;
                    var C = p[r].lastItemIndex;
                    this._unselect(false);
                    this._select(c, "path", B, q, u, C)
                }
                var m = this._getSymbol(this._selected.group, this._selected.series);
                if (m == "none") {
                    m = "circle"
                }
                var o = this._calcGroupOffsets(B, b);
                var d = o.offsets[this._selected.series][u].to;
                var t = d;
                if (v.type.indexOf("range") != -1) {
                    t = o.offsets[this._selected.series][u].from
                }
                var l = e ? k : j;
                if (!isNaN(t) && Math.abs(l - t) < Math.abs(l - d)) {
                    j = t
                } else {
                    j = d
                }
                if (isNaN(j)) {
                    return
                }
                k = f.value;
                if (e) {
                    var z = k;
                    k = j;
                    j = z + b.y
                } else {
                    k += b.x
                }
                if (f.polarAxisCoords) {
                    k = f.x;
                    j = f.y
                }
                j = a.jqx._ptrnd(j);
                k = a.jqx._ptrnd(k);
                if (this._pointMarker && this._pointMarker.element) {
                    this.renderer.removeElement(this._pointMarker.element);
                    this._pointMarker.element = undefined
                }
                if (isNaN(k) || isNaN(j)) {
                    return
                }
                var h = this._getSeriesColors(B, q, u);
                var w = this._getSerieSettings(B, q);
                var A = n.symbolSizeSelected;
                if (isNaN(A)) {
                    A = n.symbolSize
                }
                if (isNaN(A) || A > 50 || A < 0) {
                    A = v.symbolSize
                }
                if (isNaN(A) || A > 50 || A < 0) {
                    A = 8
                }
                if (this.showToolTips || this.enableCrosshairs) {
                    this._pointMarker = {
                        type: m,
                        x: k,
                        y: j,
                        gidx: B,
                        sidx: q,
                        iidx: u
                    };
                    this._pointMarker.element = this._drawSymbol(m, k, j, h.fillColorSymbolSelected, w.opacity, h.lineColorSymbolSelected, w.opacity, w.strokeSymbol, w.dashStyle, A);
                    this._installHandlers(this._pointMarker.element, "pointMarker", B, q, u)
                }
                this._startTooltipTimer(B, this._selected.series, u)
            }
        },
        _drawSymbol: function(i, l, j, c, m, k, f, g, b, o) {
            var e;
            var h = o || 6;
            var d = h / 2;
            switch (i) {
                case "none":
                    return undefined;
                case "circle":
                    e = this.renderer.circle(l, j, h / 2);
                    break;
                case "square":
                    h = h - 1;
                    d = h / 2;
                    e = this.renderer.rect(l - d, j - d, h, h);
                    break;
                case "diamond":
                    var n = "M " + (l - d) + "," + (j) + " L" + (l) + "," + (j - d) + " L" + (l + d) + "," + (j) + " L" + (l) + "," + (j + d) + " Z";
                    e = this.renderer.path(n);
                    break;
                case "triangle_up":
                case "triangle":
                    var n = "M " + (l - d) + "," + (j + d) + " L " + (l + d) + "," + (j + d) + " L " + (l) + "," + (j - d) + " Z";
                    e = this.renderer.path(n);
                    break;
                case "triangle_down":
                    var n = "M " + (l - d) + "," + (j - d) + " L " + (l) + "," + (j + d) + " L " + (l + d) + "," + (j - d) + " Z";
                    e = this.renderer.path(n);
                    break;
                case "triangle_left":
                    var n = "M " + (l - d) + "," + (j) + " L " + (l + d) + "," + (j + d) + " L " + (l + d) + "," + (j - d) + " Z";
                    e = this.renderer.path(n);
                    break;
                case "triangle_right":
                    var n = "M " + (l - d) + "," + (j - d) + " L " + (l - d) + "," + (j + d) + " L " + (l + d) + "," + (j) + " Z";
                    e = this.renderer.path(n);
                    break;
                default:
                    e = this.renderer.circle(l, j, h)
            }
            this.renderer.attr(e, {
                fill: c,
                "fill-opacity": m,
                stroke: k,
                "stroke-width": 0,
                "stroke-opacity": f,
                "stroke-dasharray": b || ""
            });
            if (i != "circle") {
                this.renderer.attr(e, {
                    r: h / 2
                });
                if (i != "square") {
                    this.renderer.attr(e, {
                        x: l,
                        y: j
                    })
                }
            }
            return e
        },
        _getSymbol: function(f, b) {
            var c = ["circle", "square", "diamond", "triangle_up", "triangle_down", "triangle_left", "triangle_right"];
            var e = this.seriesGroups[f];
            var d = e.series[b];
            var h;
            if (d.symbolType != undefined) {
                h = d.symbolType
            }
            if (h == undefined) {
                h = e.symbolType
            }
            if (h == "default") {
                return c[b % c.length]
            } else {
                if (h != undefined) {
                    return h
                }
            }
            return "none"
        },
        _startTooltipTimer: function(k, j, d, i, h, b, f) {
            this._cancelTooltipTimer();
            var l = this;
            var e = l.seriesGroups[k];
            var c = this.toolTipShowDelay || this.toolTipDelay;
            if (isNaN(c) || c > 10000 || c < 0) {
                c = 500
            }
            if (this._ttEl || (true == this.enableCrosshairs && false == this.showToolTips)) {
                c = 0
            }
            if (!isNaN(b)) {
                c = b
            }
            clearTimeout(this._tttimerHide);
            if (isNaN(i)) {
                i = l._mouseX
            }
            if (isNaN(h)) {
                h = l._mouseY - 3
            }
            if (c == 0) {
                l._showToolTip(i, h, k, j, d)
            }
            this._tttimer = setTimeout(function() {
                if (c != 0) {
                    l._showToolTip(i, h, k, j, d)
                }
                var g = l.toolTipHideDelay;
                if (!isNaN(f)) {
                    g = f
                }
                if (isNaN(g)) {
                    g = 4000
                }
                l._tttimerHide = setTimeout(function() {
                    l._hideToolTip();
                    l._unselect()
                }, g)
            }, c)
        },
        _cancelTooltipTimer: function() {
            clearTimeout(this._tttimer)
        },
        _getGroupGradientType: function(c) {
            var b = this.seriesGroups[c];
            if (b.type.indexOf("area") != -1) {
                return b.orientation == "horizontal" ? "horizontalLinearGradient" : "verticalLinearGradient"
            } else {
                if (this._isColumnType(b.type) || b.type.indexOf("candle") != -1) {
                    if (b.polar) {
                        return "radialGradient"
                    }
                    return b.orientation == "horizontal" ? "verticalLinearGradient" : "horizontalLinearGradient"
                } else {
                    if (b.type.indexOf("scatter") != -1 || b.type.indexOf("bubble") != -1 || this._isPieGroup(c)) {
                        return "radialGradient"
                    }
                }
            }
            return undefined
        },
        _select: function(h, l, o, n, i, m) {
            if (this._selected) {
                if ((this._selected.item != i || this._selected.series != n || this._selected.group != o)) {
                    this._unselect()
                } else {
                    return
                }
            }
            var k = this.seriesGroups[o];
            var p = k.series[n];
            if (k.enableSelection == false || p.enableSelection == false) {
                return
            }
            var f = k.type.indexOf("line") != -1 && k.type.indexOf("area") == -1;
            this._selected = {
                element: h,
                type: l,
                group: o,
                series: n,
                item: i,
                iidxBase: m,
                isLineType: f,
                linesUnselectMode: p.linesUnselectMode || k.linesUnselectMode
            };
            var b = this._getColors(o, n, m || i, this._getGroupGradientType(o));
            var c = b.fillColorSelected;
            if (f) {
                c = "none"
            }
            var e = this._getSerieSettings(o, n);
            var d = (l == "symbol") ? b.lineColorSymbolSelected : b.lineColorSelected;
            c = (l == "symbol") ? b.fillColorSymbolSelected : c;
            var j = (l == "symbol") ? 1 : e.stroke;
            if (this.renderer.getAttr(h, "fill") == b.fillColorAlt) {
                c = b.fillColorAltSelected
            }
            this.renderer.attr(h, {
                stroke: d,
                fill: c,
                "stroke-width": 0
            });
            if (k.type.indexOf("pie") != -1 || k.type.indexOf("donut") != -1) {
                this._applyPieSelect()
            }
            this._raiseItemEvent("mouseover", k, p, i)
        },
        _applyPieSelect: function() {
            var c = this;
            c._createAnimationGroup("animPieSlice");
            var e = this._selected;
            if (!e) {
                return
            }
            var f = this.getItemCoord(e.group, e.series, e.item);
            if (!f) {
                return
            }
            var d = this._getRenderInfo(e.group, e.series, e.item);
            var b = {
                element: d,
                coord: f
            };
            this._enqueueAnimation("animPieSlice", undefined, undefined, 300, function(i, g, j) {
                var l = g.coord;
                var h = l.selectedRadiusChange * j;
                var k = c.renderer.pieSlicePath(l.center.x, l.center.y, l.innerRadius == 0 ? 0 : (l.innerRadius + h), l.outerRadius + h, l.fromAngle, l.toAngle, l.centerOffset);
                c.renderer.attr(g.element.element, {
                    d: k
                });
                c._showPieLabel(e.group, e.series, e.item, undefined, h)
            }, b);
            c._startAnimation("animPieSlice")
        },
        _applyPieUnselect: function() {
            this._stopAnimations();
            var b = this._selected;
            if (!b) {
                return
            }
            var d = this.getItemCoord(b.group, b.series, b.item);
            if (!d || !d.center) {
                return
            }
            var c = this.renderer.pieSlicePath(d.center.x, d.center.y, d.innerRadius, d.outerRadius, d.fromAngle, d.toAngle, d.centerOffset);
            this.renderer.attr(b.element, {
                d: c
            });
            this._showPieLabel(b.group, b.series, b.item, undefined, 0)
        },
        _unselect: function() {
            var o = this;
            if (o._selected) {
                var n = o._selected.group;
                var m = o._selected.series;
                var f = o._selected.item;
                var k = o._selected.iidxBase;
                var j = o._selected.type;
                var i = o.seriesGroups[n];
                var p = i.series[m];
                var e = i.type.indexOf("line") != -1 && i.type.indexOf("area") == -1;
                var b = o._getColors(n, m, k || f, o._getGroupGradientType(n));
                var c = b.fillColor;
                if (e) {
                    c = "none"
                }
                var d = o._getSerieSettings(n, m);
                var l = (j == "symbol") ? b.lineColorSymbol : b.lineColor;
                c = (j == "symbol") ? b.fillColorSymbol : c;
                if (this.renderer.getAttr(o._selected.element, "fill") == b.fillColorAltSelected) {
                    c = b.fillColorAlt
                }
                var h = (j == "symbol") ? 1 : d.stroke;
                o.renderer.attr(o._selected.element, {
                    stroke: l,
                    fill: c,
                    "stroke-width": 0
                });
                if (i.type.indexOf("pie") != -1 || i.type.indexOf("donut") != -1) {
                    this._applyPieUnselect()
                }
                o._selected = undefined;
                if (!isNaN(f)) {
                    o._raiseItemEvent("mouseout", i, p, f)
                }
            }
            if (o._pointMarker) {
                if (o._pointMarker.element) {
                    o.renderer.removeElement(o._pointMarker.element);
                    o._pointMarker.element = undefined
                }
                o._pointMarker = undefined;
                o._hideCrosshairs()
            }
        },
        _raiseItemEvent: function(f, g, e, c) {
            var d = e[f] || g[f];
            var h = 0;
            for (; h < this.seriesGroups.length; h++) {
                if (this.seriesGroups[h] == g) {
                    break
                }
            }
            if (h == this.seriesGroups.length) {
                return
            }
            var b = {
                event: f,
                seriesGroup: g,
                serie: e,
                elementIndex: c,
                elementValue: this._getDataValue(c, e.dataField, h)
            };
            if (d && a.isFunction(d)) {
                d(b)
            }
            this._raiseEvent(f, b)
        },
        _raiseEvent: function(d, c) {
            var e = new a.Event(d);
            e.owner = this;
            c.event = d;
            e.args = c;
            var b = this.host.trigger(e);
            return b
        },
        _calcInterval: function(d, j, h) {
            var m = Math.abs(j - d);
            var k = m / h;
            var f = [1, 2, 3, 4, 5, 10, 15, 20, 25, 50, 100];
            var b = [0.5, 0.25, 0.125, 0.1];
            var c = 0.1;
            var g = f;
            if (k < 1) {
                g = b;
                c = 10
            }
            var l = 0;
            do {
                l = 0;
                if (k >= 1) {
                    c *= 10
                } else {
                    c /= 10
                }
                for (var e = 1; e < g.length; e++) {
                    if (Math.abs(g[l] * c - k) > Math.abs(g[e] * c - k)) {
                        l = e
                    } else {
                        break
                    }
                }
            } while (l == g.length - 1);
            return g[l] * c
        },
        _renderDataClone: function() {
            if (!this._renderData || this._isToggleRefresh) {
                return
            }
            var d = this._elementRenderInfo = [];
            if (this._isSelectorRefresh) {
                return
            }
            for (var h = 0; h < this._renderData.length; h++) {
                var c = this._getXAxis(h).dataField;
                while (d.length <= h) {
                    d.push({})
                }
                var b = d[h];
                var f = this._renderData[h];
                if (!f.offsets) {
                    continue
                }
                if (f.valueAxis) {
                    b.valueAxis = {
                        itemOffsets: {}
                    };
                    for (var j in f.valueAxis.itemOffsets) {
                        b.valueAxis.itemOffsets[j] = f.valueAxis.itemOffsets[j]
                    }
                }
                if (f.xAxis) {
                    b.xAxis = {
                        itemOffsets: {}
                    };
                    for (var j in f.xAxis.itemOffsets) {
                        b.xAxis.itemOffsets[j] = f.xAxis.itemOffsets[j]
                    }
                }
                b.series = [];
                var g = b.series;
                var l = this._isPieGroup(h);
                for (var m = 0; m < f.offsets.length; m++) {
                    g.push({});
                    for (var e = 0; e < f.offsets[m].length; e++) {
                        if (!l) {
                            g[m][f.xoffsets.xvalues[e]] = {
                                value: f.offsets[m][e].value,
                                valueRadius: f.offsets[m][e].valueRadius,
                                xoffset: f.xoffsets.data[e],
                                from: f.offsets[m][e].from,
                                to: f.offsets[m][e].to
                            }
                        } else {
                            var k = f.offsets[m][e];
                            g[m][k.displayValue] = {
                                value: k.value,
                                x: k.x,
                                y: k.y,
                                fromAngle: k.fromAngle,
                                toAngle: k.toAngle
                            }
                        }
                    }
                }
            }
        },
        getPolarDataPointOffset: function(d, c, f) {
            var e = this._renderData[f];
            if (!e) {
                return {
                    x: NaN,
                    y: NaN
                }
            }
            var h = this.getValueAxisDataPointOffset(c, f);
            var b = this.getXAxisDataPointOffset(d, f);
            var g = this._toPolarCoord(e.polarCoords, e.xAxis.rect, b, h);
            return {
                x: g.x,
                y: g.y
            }
        },
        _getDataPointOffsetDiff: function(j, i, b, f, g, d, h) {
            var e = this._getDataPointOffset(j, b, f, g, d, h);
            var c = this._getDataPointOffset(i, b, f, g, d, h);
            return Math.abs(e - c)
        },
        _getXAxisRenderData: function(d) {
            if (d >= this._renderData.length) {
                return
            }
            var e = this.seriesGroups[d];
            var c = this._renderData[d].xAxis;
            if (!c) {
                return
            }
            if (e.xAxis == undefined) {
                for (var b = 0; b <= d; b++) {
                    if (this.seriesGroups[b].xAxis == undefined) {
                        break
                    }
                }
                c = this._renderData[b].xAxis
            }
            return c
        },
        getXAxisDataPointOffset: function(j, l) {
            var k = this.seriesGroups[l];
            if (isNaN(j)) {
                return NaN
            }
            var m = this._getXAxisRenderData(l);
            if (!m) {
                return NaN
            }
            var f = m.data.axisStats;
            var i = f.min.valueOf();
            var b = f.max.valueOf();
            var g = b - i;
            if (g == 0) {
                g = 1
            }
            if (j.valueOf() > b || j.valueOf() < i) {
                return NaN
            }
            var c = this._getXAxis(l);
            var d = k.orientation == "horizontal" ? "height" : "width";
            var o = k.orientation == "horizontal" ? "y" : "x";
            var h = (j.valueOf() - i) / g;
            var n = m.rect[d] - m.data.padding.left - m.data.padding.right;
            if (k.polar || k.spider) {
                var e = this._renderData[l].polarCoords;
                if (e.isClosedCircle) {
                    n = m.data.axisSize
                }
            }
            return this._plotRect[o] + m.data.padding.left + n * (c.flip ? (1 - h) : h)
        },
        getValueAxisDataPointOffset: function(g, h) {
            var j = this._getValueAxis(h);
            if (!j) {
                return NaN
            }
            var i = this._renderData[h];
            if (!i) {
                return NaN
            }
            var f = j.flip == true;
            var d = i.logBase;
            var e = i.scale;
            var b = i.gbase;
            var c = i.baseOffset;
            return this._getDataPointOffset(g, b, d, e, c, f)
        },
        _getDataPointOffset: function(f, c, d, h, e, b) {
            var g;
            if (isNaN(f)) {
                f = c
            }
            if (!isNaN(d)) {
                g = (a.jqx.log(f, d) - a.jqx.log(c, d)) * h
            } else {
                g = (f - c) * h
            }
            if (this._isVML) {
                g = Math.round(g)
            }
            if (b) {
                g = e + g
            } else {
                g = e - g
            }
            return g
        },
        _calcGroupOffsets: function(l, K) {
            var x = this.seriesGroups[l];
            while (this._renderData.length < l + 1) {
                this._renderData.push({})
            }
            if (this._renderData[l] != null && this._renderData[l].offsets != undefined) {
                return this._renderData[l]
            }
            if (this._isPieGroup(l)) {
                return this._calcPieSeriesGroupOffsets(l, K)
            }
            var o = this._getValueAxis(l);
            if (!o || !x.series || x.series.length == 0) {
                return this._renderData[l]
            }
            var z = o.flip == true;
            var O = o.logarithmicScale == true;
            var N = o.logarithmicScaleBase || 10;
            var T = [];
            var E = x.type.indexOf("stacked") != -1;
            var d = E && x.type.indexOf("100") != -1;
            var J = x.type.indexOf("range") != -1;
            var U = this._isColumnType(x.type);
            var Z = x.type.indexOf("waterfall") != -1;
            var s = this._getDataLen(l);
            var r = x.baselineValue || o.baselineValue || 0;
            if (d) {
                r = 0
            }
            var ag = this._stats.seriesGroups[l];
            if (!ag || !ag.isValid) {
                return
            }
            var aj = ag.hasStackValueReversal;
            if (aj) {
                r = 0
            }
            if (Z && E) {
                if (aj) {
                    return
                } else {
                    r = ag.base
                }
            }
            if (r > ag.max) {
                r = ag.max
            }
            if (r < ag.min) {
                r = ag.min
            }
            var q = (d || O) ? ag.maxRange : ag.max - ag.min;
            var an = ag.min;
            var B = ag.max;
            var M = K.height / (O ? ag.intervals : q);
            var ai = 0;
            if (d) {
                if (an * B < 0) {
                    q /= 2;
                    ai = -(q + r) * M
                } else {
                    ai = -r * M
                }
            } else {
                ai = -(r - an) * M
            }
            if (z) {
                ai = K.y - ai
            } else {
                ai += K.y + K.height
            }
            var ah = [];
            var ad = [];
            var S = [];
            var al, G;
            if (O) {
                al = a.jqx.log(B, N) - a.jqx.log(r, N);
                if (E) {
                    al = ag.intervals;
                    r = d ? 0 : an
                }
                G = ag.intervals - al;
                if (!z) {
                    ai = K.y + al / ag.intervals * K.height
                }
            }
            ai = a.jqx._ptrnd(ai);
            var c = (an * B < 0) ? K.height / 2 : K.height;
            var m = [];
            var W = [];
            var ao = E && (U || O);
            var am = [];
            T = new Array(x.series.length);
            for (var ab = 0; ab < x.series.length; ab++) {
                T[ab] = new Array(s)
            }
            for (var ac = 0; ac < s; ac++) {
                if (!Z && E) {
                    W = []
                }
                for (var ab = 0; ab < x.series.length; ab++) {
                    if (!E && O) {
                        m = []
                    }
                    var C = x.series[ab];
                    var D = C.dataField;
                    var aq = C.dataFieldFrom;
                    var P = C.dataFieldTo;
                    var Y = C.radiusDataField || C.sizeDataField;
                    T[ab][ac] = {};
                    var g = this._isSerieVisible(l, ab);
                    if (x.type.indexOf("candle") != -1 || x.type.indexOf("ohlc") != -1) {
                        var b = ["Open", "Close", "High", "Low"];
                        for (var ak in b) {
                            var p = "dataField" + b[ak];
                            if (C[p]) {
                                T[ab][ac][b[ak]] = this._getDataPointOffset(this._getDataValueAsNumber(ac, C[p], l), r, O ? N : NaN, M, ai, z)
                            }
                        }
                        continue
                    }
                    if (E) {
                        while (W.length <= ac) {
                            W.push(0)
                        }
                    }
                    var ap = NaN;
                    if (J) {
                        ap = this._getDataValueAsNumber(ac, aq, l);
                        if (isNaN(ap)) {
                            ap = r
                        }
                    }
                    var I = NaN;
                    if (J) {
                        I = this._getDataValueAsNumber(ac, P, l)
                    } else {
                        I = this._getDataValueAsNumber(ac, D, l)
                    }
                    var e = this._getDataValueAsNumber(ac, Y, l);
                    if (E) {
                        W[ac] += g ? I : 0
                    }
                    if (!g) {
                        I = NaN
                    }
                    if (isNaN(I) || (O && I <= 0)) {
                        T[ab][ac] = {
                            from: undefined,
                            to: undefined
                        };
                        continue
                    }
                    var H;
                    if (E) {
                        if (ao) {
                            H = (I >= r) ? ah : ad
                        } else {
                            I = W[ac]
                        }
                    }
                    var af = M * (I - r);
                    if (J) {
                        af = M * (I - ap)
                    }
                    if (E && ao) {
                        if (!am[ac]) {
                            am[ac] = true;
                            af = M * (I - r)
                        } else {
                            af = M * I
                        }
                    }
                    if (O) {
                        while (m.length <= ac) {
                            m.push({
                                p: {
                                    value: 0,
                                    height: 0
                                },
                                n: {
                                    value: 0,
                                    height: 0
                                }
                            })
                        }
                        var A = (J || J) ? ap : r;
                        var aa = I > A ? m[ac].p : m[ac].n;
                        aa.value += I;
                        if (d) {
                            I = aa.value / (ag.psums[ac] + ag.nsums[ac]) * 100;
                            af = (a.jqx.log(I, N) - ag.minPow) * M
                        } else {
                            af = a.jqx.log(aa.value, N) - a.jqx.log(A, N);
                            af *= M
                        }
                        af -= aa.height;
                        aa.height += af
                    }
                    var R = ai;
                    if (J) {
                        var t = 0;
                        if (O) {
                            t = (a.jqx.log(ap, N) - a.jqx.log(r, N)) * M
                        } else {
                            t = (ap - r) * M
                        }
                        R += z ? t : -t
                    }
                    if (E) {
                        if (d && !O) {
                            var w = (ag.psums[ac] - ag.nsums[ac]);
                            if (I > r) {
                                af = (ag.psums[ac] / w) * c;
                                if (ag.psums[ac] != 0) {
                                    af *= I / ag.psums[ac]
                                }
                            } else {
                                af = (ag.nsums[ac] / w) * c;
                                if (ag.nsums[ac] != 0) {
                                    af *= I / ag.nsums[ac]
                                }
                            }
                        }
                        if (ao) {
                            if (isNaN(H[ac])) {
                                H[ac] = R
                            }
                            R = H[ac]
                        }
                    }
                    if (isNaN(S[ac])) {
                        S[ac] = 0
                    }
                    var ae = S[ac];
                    af = Math.abs(af);
                    var V = af;
                    if (af >= 1) {
                        var L = this._isVML ? Math.round(af) : a.jqx._ptrnd(af) - 1;
                        if (Math.abs(af - L) > 0.5) {
                            af = Math.round(af)
                        } else {
                            af = L
                        }
                    }
                    ae += af - V;
                    if (!E) {
                        ae = 0
                    }
                    if (Math.abs(ae) > 0.5) {
                        if (ae > 0) {
                            af -= 1;
                            ae -= 1
                        } else {
                            af += 1;
                            ae += 1
                        }
                    }
                    S[ac] = ae;
                    if (ab == x.series.length - 1 && d) {
                        var v = 0;
                        for (var X = 0; X < ab; X++) {
                            v += Math.abs(T[X][ac].to - T[X][ac].from)
                        }
                        v += af;
                        if (v < c) {
                            if (af > 0.5) {
                                af = a.jqx._ptrnd(af + c - v)
                            } else {
                                var X = ab - 1;
                                while (X >= 0) {
                                    var F = Math.abs(T[X][ac].to - T[X][ac].from);
                                    if (F > 1) {
                                        if (T[X][ac].from > T[X][ac].to) {
                                            T[X][ac].from += c - v
                                        }
                                        break
                                    }
                                    X--
                                }
                            }
                        }
                    }
                    if (z) {
                        af *= -1
                    }
                    var Q = I < r;
                    if (J) {
                        Q = ap > I
                    }
                    var n = isNaN(ap) ? I : {
                        from: ap,
                        to: I
                    };
                    if (Q) {
                        if (ao) {
                            H[ac] += af
                        }
                        T[ab][ac] = {
                            from: R,
                            to: R + af,
                            value: n,
                            valueRadius: e
                        }
                    } else {
                        if (ao) {
                            H[ac] -= af
                        }
                        T[ab][ac] = {
                            from: R,
                            to: R - af,
                            value: n,
                            valueRadius: e
                        }
                    }
                }
            }
            var u = this._renderData[l];
            u.baseOffset = ai;
            u.gbase = r;
            u.logBase = O ? N : NaN;
            u.scale = M;
            u.offsets = !Z ? T : this._applyWaterfall(T, s, l, ai, r, O ? N : NaN, M, z, E);
            u.xoffsets = this._calculateXOffsets(l, K.width);
            return this._renderData[l]
        },
        _isPercent: function(b) {
            return (typeof(b) === "string" && b.length > 0 && b.indexOf("%") == b.length - 1)
        },
        _calcPieSeriesGroupOffsets: function(e, b) {
            var z = this;
            var m = this._getDataLen(e);
            var n = this.seriesGroups[e];
            var A = this._renderData[e] = {};
            var G = A.offsets = [];
            for (var C = 0; C < n.series.length; C++) {
                var t = n.series[C];
                var E = this._get([t.minAngle, t.startAngle]);
                if (isNaN(E) || E < 0 || E > 360) {
                    E = 0
                }
                var M = this._get([t.maxAngle, t.endAngle]);
                if (isNaN(M) || M < 0 || M > 360) {
                    M = 360
                }
                var f = M - E;
                var o = t.initialAngle || 0;
                if (o < E) {
                    o = E
                }
                if (o > M) {
                    o = M
                }
                var c = t.centerOffset || 0;
                var K = a.jqx.getNum([t.offsetX, n.offsetX, b.width / 2]);
                var J = a.jqx.getNum([t.offsetY, n.offsetY, b.height / 2]);
                var w = Math.min(b.width, b.height) / 2;
                var v = o;
                var g = t.radius;
                if (z._isPercent(g)) {
                    g = parseFloat(g) / 100 * w
                }
                if (isNaN(g)) {
                    g = w * 0.4
                }
                var l = t.innerRadius;
                if (z._isPercent(l)) {
                    l = parseFloat(l) / 100 * w
                }
                if (isNaN(l) || l >= g) {
                    l = 0
                }
                var d = t.selectedRadiusChange;
                if (z._isPercent(d)) {
                    d = parseFloat(d) / 100 * (g - l)
                }
                if (isNaN(d)) {
                    d = 0.1 * (g - l)
                }
                G.push([]);
                var h = 0;
                var j = 0;
                for (var F = 0; F < m; F++) {
                    var L = this._getDataValueAsNumber(F, t.dataField, e);
                    if (isNaN(L)) {
                        continue
                    }
                    if (!this._isSerieVisible(e, C, F) && t.hiddenPointsDisplay != true) {
                        continue
                    }
                    if (L > 0) {
                        h += L
                    } else {
                        j += L
                    }
                }
                var r = h - j;
                if (r == 0) {
                    r = 1
                }
                for (var F = 0; F < m; F++) {
                    var L = this._getDataValueAsNumber(F, t.dataField, e);
                    if (isNaN(L)) {
                        G[C].push({});
                        continue
                    }
                    var D = t.displayText || t.displayField;
                    var k = this._getDataValue(F, D, e);
                    if (k == undefined) {
                        k = F
                    }
                    var I = 0;
                    var B = this._isSerieVisible(e, C, F);
                    if (B || t.hiddenPointsDisplay == true) {
                        I = Math.abs(L) / r * f
                    }
                    var q = b.x + K;
                    var p = b.y + J;
                    var H = c;
                    if (a.isFunction(c)) {
                        H = c({
                            seriesIndex: C,
                            seriesGroupIndex: e,
                            itemIndex: F
                        })
                    }
                    if (isNaN(H)) {
                        H = 0
                    }
                    var u = {
                        key: e + "_" + C + "_" + F,
                        value: L,
                        displayValue: k,
                        x: q,
                        y: p,
                        fromAngle: v,
                        toAngle: v + I,
                        centerOffset: H,
                        innerRadius: l,
                        outerRadius: g,
                        selectedRadiusChange: d,
                        visible: B
                    };
                    G[C].push(u);
                    v += I
                }
            }
            return A
        },
        _isPointSeriesOnly: function() {
            for (var b = 0; b < this.seriesGroups.length; b++) {
                var c = this.seriesGroups[b];
                if (c.type.indexOf("line") == -1 && c.type.indexOf("area") == -1 && c.type.indexOf("scatter") == -1 && c.type.indexOf("bubble") == -1) {
                    return false
                }
            }
            return true
        },
        _hasColumnSeries: function() {
            var d = ["column", "ohlc", "candlestick", "waterfall"];
            for (var c = 0; c < this.seriesGroups.length; c++) {
                var e = this.seriesGroups[c];
                for (var b in d) {
                    if (e.type.indexOf(d[b]) != -1) {
                        return true
                    }
                }
            }
            return false
        },
        _alignValuesWithTicks: function(f) {
            var b = this._isPointSeriesOnly();
            var c = this.seriesGroups[f];
            var e = this._getXAxis(f);
            var d = e.valuesOnTicks == undefined ? b : e.valuesOnTicks != false;
            if (e.logarithmicScale) {
                d = true
            }
            if (f == undefined) {
                return d
            }
            if (c.valuesOnTicks == undefined) {
                return d
            }
            return c.valuesOnTicks
        },
        _getYearsDiff: function(c, b) {
            return b.getFullYear() - c.getFullYear()
        },
        _getMonthsDiff: function(c, b) {
            return 12 * (b.getFullYear() - c.getFullYear()) + b.getMonth() - c.getMonth()
        },
        _getDateDiff: function(f, e, d, b) {
            var c = 0;
            if (d != "year" && d != "month") {
                c = e.valueOf() - f.valueOf()
            }
            switch (d) {
                case "year":
                    c = this._getYearsDiff(f, e);
                    break;
                case "month":
                    c = this._getMonthsDiff(f, e);
                    break;
                case "day":
                    c /= (24 * 3600 * 1000);
                    break;
                case "hour":
                    c /= (3600 * 1000);
                    break;
                case "minute":
                    c /= (60 * 1000);
                    break;
                case "second":
                    c /= (1000);
                    break;
                case "millisecond":
                    break
            }
            if (d != "year" && d != "month" && b != false) {
                c = a.jqx._rnd(c, 1, true)
            }
            return c
        },
        _getBestDTUnit: function(k, p, q, d, g) {
            var f = "day";
            var m = p.valueOf() - k.valueOf();
            if (m < 1000) {
                f = "second"
            } else {
                if (m < 3600000) {
                    f = "minute"
                } else {
                    if (m < 86400000) {
                        f = "hour"
                    } else {
                        if (m < 2592000000) {
                            f = "day"
                        } else {
                            if (m < 31104000000) {
                                f = "month"
                            } else {
                                f = "year"
                            }
                        }
                    }
                }
            }
            var o = [{
                key: "year",
                cnt: m / (1000 * 60 * 60 * 24 * 365)
            }, {
                key: "month",
                cnt: m / (1000 * 60 * 60 * 24 * 30)
            }, {
                key: "day",
                cnt: m / (1000 * 60 * 60 * 24)
            }, {
                key: "hour",
                cnt: m / (1000 * 60 * 60)
            }, {
                key: "minute",
                cnt: m / (1000 * 60)
            }, {
                key: "second",
                cnt: m / 1000
            }, {
                key: "millisecond",
                cnt: m
            }];
            var l = -1;
            for (var h = 0; h < o.length; h++) {
                if (o[h].key == f) {
                    l = h;
                    break
                }
            }
            var b = -1,
                n = -1;
            for (; l < o.length; l++) {
                if (o[l].cnt / 100 > d) {
                    break
                }
                var c = this._estAxisInterval(k, p, q, d, o[l].key, g);
                var e = this._getDTIntCnt(k, p, c, o[l].key);
                if (b == -1 || b < e) {
                    b = e;
                    n = l
                }
            }
            f = o[n].key;
            return f
        },
        _getXAxisStats: function(h, o, F) {
            var m = this._getDataLen(h);
            var c = o.type == "date" || o.type == "time";
            if (c && !this._autoDateFormats) {
                if (!this._autoDateFormats) {
                    this._autoDateFormats = []
                }
                var q = this._testXAxisDateFormat();
                if (q) {
                    this._autoDateFormats.push(q)
                }
            }
            var p = c ? this._castAsDate(o.minValue, o.dateFormat) : this._castAsNumber(o.minValue);
            var s = c ? this._castAsDate(o.maxValue, o.dateFormat) : this._castAsNumber(o.maxValue);
            if (this._selectorRange && this._selectorRange[h]) {
                var j = this._selectorRange[h].min;
                if (!isNaN(j)) {
                    p = c ? this._castAsDate(j, o.dateFormat) : this._castAsNumber(j)
                }
                var k = this._selectorRange[h].max;
                if (!isNaN(k)) {
                    s = c ? this._castAsDate(k, o.dateFormat) : this._castAsNumber(k)
                }
            }
            var A = p,
                E = s;
            var f, r;
            var d = o.type == undefined || o.type == "auto";
            var l = (d || o.type == "basic");
            var B = 0,
                e = 0;
            for (var D = 0; D < m && o.dataField; D++) {
                var z = this._getDataValue(D, o.dataField, h);
                z = c ? this._castAsDate(z, o.dateFormat) : this._castAsNumber(z);
                if (isNaN(z)) {
                    continue
                }
                if (c) {
                    B++
                } else {
                    e++
                }
                if (isNaN(f) || z < f) {
                    f = z
                }
                if (isNaN(r) || z >= r) {
                    r = z
                }
            }
            if (d && ((!c && e == m) || (c && B == m))) {
                l = false
            }
            if (l) {
                f = 0;
                r = Math.max(0, m - 1)
            }
            if (isNaN(A)) {
                A = f
            }
            if (isNaN(E)) {
                E = r
            }
            if (c) {
                if (!this._isDate(A)) {
                    A = this._isDate(E) ? E : new Date()
                }
                if (!this._isDate(E)) {
                    E = this._isDate(A) ? A : new Date()
                }
            } else {
                if (isNaN(A)) {
                    A = 0
                }
                if (isNaN(E)) {
                    E = l ? Math.max(0, m - 1) : A
                }
            }
            if (f == undefined) {
                f = A
            }
            if (r == undefined) {
                r = E
            }
            var t = o.rangeSelector;
            if (t) {
                var u = t.minValue || A;
                if (u && c) {
                    u = this._castAsDate(u, t.dateFormat || o.dateFormat)
                }
                var y = t.maxValue || E;
                if (y && c) {
                    y = this._castAsDate(y, t.dateFormat || o.rangeSelector)
                }
                if (A < u) {
                    A = u
                }
                if (E < u) {
                    E = y
                }
                if (A > y) {
                    A = u
                }
                if (E > y) {
                    E = y
                }
            }
            var G = o.unitInterval;
            var x, H;
            if (c) {
                x = o.baseUnit;
                if (!x) {
                    x = this._getBestDTUnit(A, E, h, F)
                }
                H = x == "hour" || x == "minute" || x == "second" || x == "millisecond"
            }
            var v = o.logarithmicScale == true;
            var g = o.logarithmicScaleBase;
            if (isNaN(g) || g <= 1) {
                g = 10
            }
            var G = o.unitInterval;
            if (v) {
                G = 1
            } else {
                if (isNaN(G) || G <= 0) {
                    G = this._estAxisInterval(A, E, h, F, x)
                }
            }
            var C = {
                min: A,
                max: E
            };
            var n = this.seriesGroups[h];
            if (v) {
                if (!A) {
                    A = 1;
                    if (E && A > E) {
                        A = E
                    }
                }
                if (!E) {
                    E = A
                }
                C = {
                    min: A,
                    max: E
                };
                var b = a.jqx._rnd(a.jqx.log(A, g), 1, false);
                var w = a.jqx._rnd(a.jqx.log(E, g), 1, true);
                E = Math.pow(g, w);
                A = Math.pow(g, b)
            } else {
                if (!c && (n.polar || n.spider)) {
                    A = a.jqx._rnd(A, G, false);
                    E = a.jqx._rnd(E, G, true)
                }
            }
            return {
                min: A,
                max: E,
                logAxis: {
                    enabled: v,
                    base: g,
                    minPow: b,
                    maxPow: w
                },
                dsRange: {
                    min: f,
                    max: r
                },
                filterRange: C,
                useIndeces: l,
                isDateTime: c,
                isTimeUnit: H,
                dateTimeUnit: x,
                interval: G
            }
        },
        _getDefaultDTFormatFn: function(d) {
            var b = ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"];
            var c;
            if (d == "year" || d == "month" || d == "day") {
                c = function(e) {
                    return e.getDate() + "-" + b[e.getMonth()] + "-" + e.getFullYear()
                }
            } else {
                c = function(e) {
                    return e.getDate() + "-" + b[e.getMonth()] + "-" + e.getFullYear() + "<br>" + e.getHours() + ":" + e.getMinutes() + ":" + e.getSeconds()
                }
            }
            return c
        },
        _getDTIntCnt: function(e, b, c, h) {
            var d = 0;
            var f = new Date(e);
            var g = new Date(b);
            g = g.valueOf();
            if (c <= 0) {
                return 1
            }
            while (f.valueOf() < g) {
                if (h == "millisecond") {
                    f = new Date(f.valueOf() + c)
                } else {
                    if (h == "second") {
                        f = new Date(f.valueOf() + c * 1000)
                    } else {
                        if (h == "minute") {
                            f = new Date(f.valueOf() + c * 60000)
                        } else {
                            if (h == "hour") {
                                f = new Date(f.valueOf() + c * 60000 * 24)
                            } else {
                                if (h == "day") {
                                    f.setDate(f.getDate() + c)
                                } else {
                                    if (h == "month") {
                                        f.setMonth(f.getMonth() + c)
                                    } else {
                                        if (h == "year") {
                                            f.setFullYear(f.getFullYear() + c)
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
                d++
            }
            return d
        },
        _estAxisInterval: function(e, h, m, b, j, c) {
            if (isNaN(e) || isNaN(h)) {
                return NaN
            }
            var d = [1, 2, 5, 10, 15, 20, 50, 100, 200, 500];
            var g = 0;
            var f = b / ((!isNaN(c) && c > 0) ? c : 50);
            if (this._renderData && this._renderData.length > m && this._renderData[m].xAxis && !isNaN(this._renderData[m].xAxis.avgWidth)) {
                var o = Math.max(1, this._renderData[m].xAxis.avgWidth);
                if (o != 0 && isNaN(c)) {
                    f = 0.9 * b / o
                }
            }
            if (f <= 1) {
                return Math.abs(h - e)
            }
            var n = 0;
            while (true) {
                var l = g >= d.length ? Math.pow(10, 3 + g - d.length) : d[g];
                if (this._isDate(e) && this._isDate(h)) {
                    n = this._getDTIntCnt(e, h, l, j)
                } else {
                    n = (h - e) / l
                }
                if (n <= f) {
                    break
                }
                g++
            }
            var k = this.seriesGroups[m];
            if (k.spider || k.polar) {
                if (2 * l > h - e) {
                    l = h - e
                }
            }
            return l
        },
        _getPaddingSize: function(m, e, f, c, o, g, p) {
            var h = m.min;
            var k = m.max;
            if (m.logAxis.enabled) {
                h = m.logAxis.minPow;
                k = m.logAxis.maxPow
            }
            var b = m.interval;
            var d = m.dateTimeUnit;
            if (o) {
                var l = (c / Math.max(1, k - h + b)) * b;
                if (g) {
                    return {
                        left: 0,
                        right: l
                    }
                } else {
                    if (f) {
                        return {
                            left: 0,
                            right: 0
                        }
                    }
                    return {
                        left: l / 2,
                        right: l / 2
                    }
                }
            }
            if (f && !p) {
                return {
                    left: 0,
                    right: 0
                }
            }
            if (this._isDate(h) && this._isDate(k)) {
                var n = this._getDTIntCnt(h, k, Math.min(b, k - h), d);
                var i = c / Math.max(2, n);
                return {
                    left: i / 2,
                    right: i / 2
                }
            }
            var n = Math.max(1, k - h);
            if (n == 1) {
                var j = c / 4;
                return {
                    left: j,
                    right: j
                }
            }
            var i = c / (n + 1);
            return {
                left: i / 2,
                right: i / 2
            }
        },
        _calculateXOffsets: function(f, E) {
            var D = this.seriesGroups[f];
            var o = this._getXAxis(f);
            var w = [];
            var m = [];
            var n = this._getDataLen(f);
            var d = this._getXAxisStats(f, o, E);
            var v = d.min;
            var B = d.max;
            var b = d.isDateTime;
            var G = d.isTimeUnit;
            var C = this._hasColumnSeries();
            var c = D.polar || D.spider;
            var y = this._get([D.startAngle, D.minAngle, 0]);
            var t = this._get([D.endAngle, D.maxAngle, 360]);
            var q = c && !(Math.abs(Math.abs(t - y) - 360) > 0.0001);
            var l = this._alignValuesWithTicks(f);
            var s = this._getPaddingSize(d, o, l, E, c, q, C);
            var I = B - v;
            var A = d.filterRange;
            if (I == 0) {
                I = 1
            }
            var H = E - s.left - s.right;
            if (c && l && !q) {
                s.left = s.right = 0
            }
            var j = -1,
                p = -1;
            for (var z = 0; z < n; z++) {
                var u = (o.dataField === undefined) ? z : this._getDataValue(z, o.dataField, f);
                if (d.useIndeces) {
                    if (z < A.min || z > A.max) {
                        w.push(NaN);
                        m.push(undefined);
                        continue
                    }
                    r = s.left + (z - v) / I * H;
                    if (d.logAxis.enabled == true) {
                        var e = d.logAxis.base;
                        r = this._jqxPlot.scale(u, {
                            min: v.valueOf(),
                            max: B.valueOf(),
                            type: "logarithmic",
                            base: e
                        }, {
                            min: 0,
                            max: H,
                            flip: false
                        })
                    }
                    w.push(a.jqx._ptrnd(r));
                    m.push(u);
                    if (j == -1) {
                        j = z
                    }
                    if (p == -1 || p < z) {
                        p = z
                    }
                    continue
                }
                u = b ? this._castAsDate(u, o.dateFormat) : this._castAsNumber(u);
                if (isNaN(u) || u < A.min || u > A.max) {
                    w.push(NaN);
                    m.push(undefined);
                    continue
                }
                var r = 0;
                if (d.logAxis.enabled == true) {
                    var e = d.logAxis.base;
                    r = this._jqxPlot.scale(u, {
                        min: v.valueOf(),
                        max: B.valueOf(),
                        type: "logarithmic",
                        base: e
                    }, {
                        min: 0,
                        max: H,
                        flip: false
                    })
                } else {
                    if (!b || (b && G)) {
                        var F = u - v;
                        r = (u - v) * H / I
                    } else {
                        r = (u.valueOf() - v.valueOf()) / (B.valueOf() - v.valueOf()) * H
                    }
                }
                r = a.jqx._ptrnd(s.left + r);
                w.push(r);
                m.push(u);
                if (j == -1) {
                    j = z
                }
                if (p == -1 || p < z) {
                    p = z
                }
            }
            if (o.flip == true) {
                for (var z = 0; z < w.length; z++) {
                    if (!isNaN(w[z])) {
                        w[z] = E - w[z]
                    }
                }
            }
            if (G || b) {
                I = this._getDateDiff(v, B, o.baseUnit);
                I = a.jqx._rnd(I, 1, false)
            }
            var k = Math.max(1, I);
            var h = H / k;
            if (j == p && k == 1) {
                w[j] = s.left + H / 2
            }
            return {
                axisStats: d,
                data: w,
                xvalues: m,
                first: j,
                last: p,
                length: p == -1 ? 0 : p - j + 1,
                itemWidth: h,
                intervalWidth: h * d.interval,
                rangeLength: I,
                useIndeces: d.useIndeces,
                padding: s,
                axisSize: H
            }
        },
        _getXAxis: function(b) {
            if (b == undefined || this.seriesGroups.length <= b) {
                return this.categoryAxis || this.xAxis
            }
            return this.seriesGroups[b].categoryAxis || this.seriesGroups[b].xAxis || this.categoryAxis || this.xAxis
        },
        _isGreyScale: function(e, b) {
            var d = this.seriesGroups[e];
            var c = d.series[b];
            if (c.greyScale == true) {
                return true
            } else {
                if (c.greyScale == false) {
                    return false
                }
            }
            if (d.greyScale == true) {
                return true
            } else {
                if (d.greyScale == false) {
                    return false
                }
            }
            return this.greyScale == true
        },
        _getSeriesColors: function(f, c, e) {
            var b = this._getSeriesColorsInternal(f, c, e);
            if (this._isGreyScale(f, c)) {
                for (var d in b) {
                    b[d] = a.jqx.toGreyScale(b[d])
                }
            }
            return b
        },
        _getColorFromScheme: function(o, l, b) {
            var d = "#000000";
            var n = this.seriesGroups[o];
            var g = n.series[l];
            if (this._isPieGroup(o)) {
                var c = this._getDataLen(o);
                d = this._getItemColorFromScheme(g.colorScheme || n.colorScheme || this.colorScheme, l * c + b, o, l)
            } else {
                var m = 0;
                for (var f = 0; f <= o; f++) {
                    for (var e in this.seriesGroups[f].series) {
                        if (f == o && e == l) {
                            break
                        } else {
                            m++
                        }
                    }
                }
                var k = this.colorScheme;
                if (n.colorScheme) {
                    k = n.colorScheme;
                    var p = l
                }
                if (k == undefined || k == "") {
                    k = this.colorSchemes[0].name
                }
                if (!k) {
                    return d
                }
                for (var f = 0; f < this.colorSchemes.length; f++) {
                    var h = this.colorSchemes[f];
                    if (h.name == k) {
                        while (m > h.colors.length) {
                            m -= h.colors.length;
                            if (++f >= this.colorSchemes.length) {
                                f = 0
                            }
                            h = this.colorSchemes[f]
                        }
                        d = h.colors[m % h.colors.length]
                    }
                }
            }
            return d
        },
        _createColorsCache: function() {
            this._colorsCache = {
                get: function(b) {
                    if (this._store[b]) {
                        return this._store[b]
                    }
                },
                set: function(c, b) {
                    if (this._size < 10000) {
                        this._store[c] = b;
                        this._size++
                    }
                },
                clear: function() {
                    this._store = {};
                    this._size = 0
                },
                _size: 0,
                _store: {}
            }
        },
        _getSeriesColorsInternal: function(m, d, b) {
            var f = this.seriesGroups[m];
            var o = f.series[d];
            if (!a.isFunction(o.colorFunction) && f.type != "pie" && f.type != "donut") {
                b = NaN
            }
            var h = m + "_" + d + "_" + (isNaN(b) ? "NaN" : b);
            if (this._colorsCache.get(h)) {
                return this._colorsCache.get(h)
            }
            var c = {
                lineColor: "#222222",
                lineColorSelected: "#151515",
                lineColorSymbol: "#222222",
                lineColorSymbolSelected: "#151515",
                fillColor: "#222222",
                fillColorSelected: "#333333",
                fillColorSymbol: "#222222",
                fillColorSymbolSelected: "#333333",
                fillColorAlt: "#222222",
                fillColorAltSelected: "#333333"
            };
            var i;
            if (a.isFunction(o.colorFunction)) {
                var j = !isNaN(b) ? this._getDataValue(b, o.dataField, m) : NaN;
                if (f.type.indexOf("range") != -1 && !isNaN(b)) {
                    var e = this._getDataValue(b, o.dataFieldFrom, m);
                    var l = this._getDataValue(b, o.dataFieldTo, m);
                    j = {
                        from: e,
                        to: l
                    }
                }
                i = o.colorFunction(j, b, o, f);
                if (typeof(i) == "object") {
                    for (var k in i) {
                        c[k] = i[k]
                    }
                } else {
                    c.fillColor = i
                }
            } else {
                for (var k in c) {
                    if (o[k]) {
                        c[k] = o[k]
                    }
                }
                if (!o.fillColor && !o.color) {
                    c.fillColor = this._getColorFromScheme(m, d, b)
                } else {
                    o.fillColor = o.fillColor || o.color
                }
            }
            var n = {
                fillColor: {
                    baseColor: "fillColor",
                    adjust: 1
                },
                fillColorSelected: {
                    baseColor: "fillColor",
                    adjust: 1.1
                },
                fillColorSymbol: {
                    baseColor: "fillColor",
                    adjust: 1
                },
                fillColorSymbolSelected: {
                    baseColor: "fillColorSymbol",
                    adjust: 2
                },
                fillColorAlt: {
                    baseColor: "fillColor",
                    adjust: 4
                },
                fillColorAltSelected: {
                    baseColor: "fillColor",
                    adjust: 3
                },
                lineColor: {
                    baseColor: "fillColor",
                    adjust: 0.95
                },
                lineColorSelected: {
                    baseColor: "lineColor",
                    adjust: 0.95
                },
                lineColorSymbol: {
                    baseColor: "lineColor",
                    adjust: 1
                },
                lineColorSymbolSelected: {
                    baseColor: "lineColorSelected",
                    adjust: 1
                }
            };
            for (var k in c) {
                if (typeof(i) != "object" || !i[k]) {
                    if (o[k]) {
                        c[k] = o[k]
                    }
                }
            }
            for (var k in c) {
                if (typeof(i) != "object" || !i[k]) {
                    if (!o[k]) {
                        c[k] = a.jqx.adjustColor(c[n[k].baseColor], n[k].adjust)
                    }
                }
            }
            this._colorsCache.set(h, c);
            return c
        },
        _getItemColorFromScheme: function(d, f, k, h) {
            if (d == undefined || d == "") {
                d = this.colorSchemes[0].name
            }
            for (var g = 0; g < this.colorSchemes.length; g++) {
                if (d == this.colorSchemes[g].name) {
                    break
                }
            }
            var e = 0;
            while (e <= f) {
                if (g == this.colorSchemes.length) {
                    g = 0
                }
                var b = this.colorSchemes[g].colors.length;
                if (e + b <= f) {
                    e += b;
                    g++
                } else {
                    var c = this.colorSchemes[g].colors[f - e];
                    if (this._isGreyScale(k, h) && c.indexOf("#") == 0) {
                        c = a.jqx.toGreyScale(c)
                    }
                    return c
                }
            }
        },
        getColorScheme: function(b) {
            for (var c = 0; c < this.colorSchemes.length; c++) {
                if (this.colorSchemes[c].name == b) {
                    return this.colorSchemes[c].colors
                }
            }
            return undefined
        },
        addColorScheme: function(c, b) {
            for (var d = 0; d < this.colorSchemes.length; d++) {
                if (this.colorSchemes[d].name == c) {
                    this.colorSchemes[d].colors = b;
                    return
                }
            }
            this.colorSchemes.push({
                name: c,
                colors: b
            })
        },
        removeColorScheme: function(b) {
            for (var c = 0; c < this.colorSchemes.length; c++) {
                if (this.colorSchemes[c].name == b) {
                    this.colorSchemes.splice(c, 1);
                    break
                }
            }
        },
        colorSchemes: [{
            name: "scheme01",
            colors: ["#ee3c61", "#07ad84"]
        }, {
            name: "scheme02",
            colors: ["#0f6f6f", "#f43c51"]
        }, {
            name: "scheme03",
            colors: ["#E8601A", "#FF9639", "#F5BD6A", "#599994", "#115D6E"]
        }, {
            name: "scheme04",
            colors: ["#D02841", "#FF7C41", "#FFC051", "#5B5F4D", "#364651"]
        }, {
            name: "scheme05",
            colors: ["#25A0DA", "#309B46", "#8EBC00", "#FF7515", "#FFAE00"]
        }, {
            name: "scheme06",
            colors: ["#0A3A4A", "#196674", "#33A6B2", "#9AC836", "#D0E64B"]
        }, {
            name: "scheme07",
            colors: ["#CC6B32", "#FFAB48", "#FFE7AD", "#A7C9AE", "#888A63"]
        }, {
            name: "scheme08",
            colors: ["#3F3943", "#01A2A6", "#29D9C2", "#BDF271", "#FFFFA6"]
        }, {
            name: "scheme09",
            colors: ["#1B2B32", "#37646F", "#A3ABAF", "#E1E7E8", "#B22E2F"]
        }, {
            name: "scheme10",
            colors: ["#5A4B53", "#9C3C58", "#DE2B5B", "#D86A41", "#D2A825"]
        }, {
            name: "scheme11",
            colors: ["#993144", "#FFA257", "#CCA56A", "#ADA072", "#949681"]
        }, {
            name: "scheme12",
            colors: ["#105B63", "#EEEAC5", "#FFD34E", "#DB9E36", "#BD4932"]
        }, {
            name: "scheme13",
            colors: ["#BBEBBC", "#F0EE94", "#F5C465", "#FA7642", "#FF1E54"]
        }, {
            name: "scheme14",
            colors: ["#60573E", "#F2EEAC", "#BFA575", "#A63841", "#BFB8A3"]
        }, {
            name: "scheme15",
            colors: ["#444546", "#FFBB6E", "#F28D00", "#D94F00", "#7F203B"]
        }, {
            name: "scheme16",
            colors: ["#583C39", "#674E49", "#948658", "#F0E99A", "#564E49"]
        }, {
            name: "scheme17",
            colors: ["#142D58", "#447F6E", "#E1B65B", "#C8782A", "#9E3E17"]
        }, {
            name: "scheme18",
            colors: ["#4D2B1F", "#635D61", "#7992A2", "#97BFD5", "#BFDCF5"]
        }, {
            name: "scheme19",
            colors: ["#844341", "#D5CC92", "#BBA146", "#897B26", "#55591C"]
        }, {
            name: "scheme20",
            colors: ["#56626B", "#6C9380", "#C0CA55", "#F07C6C", "#AD5472"]
        }, {
            name: "scheme21",
            colors: ["#96003A", "#FF7347", "#FFBC7B", "#FF4154", "#642223"]
        }, {
            name: "scheme22",
            colors: ["#5D7359", "#E0D697", "#D6AA5C", "#8C5430", "#661C0E"]
        }, {
            name: "scheme23",
            colors: ["#16193B", "#35478C", "#4E7AC7", "#7FB2F0", "#ADD5F7"]
        }, {
            name: "scheme24",
            colors: ["#7B1A25", "#BF5322", "#9DA860", "#CEA457", "#B67818"]
        }, {
            name: "scheme25",
            colors: ["#0081DA", "#3AAFFF", "#99C900", "#FFEB3D", "#309B46"]
        }, {
            name: "scheme26",
            colors: ["#0069A5", "#0098EE", "#7BD2F6", "#FFB800", "#FF6800"]
        }, {
            name: "scheme27",
            colors: ["#FF6800", "#A0A700", "#FF8D00", "#678900", "#0069A5"]
        }],
        _formatValue: function(g, i, c, f, b, d) {
            if (g == undefined) {
                return ""
            }
            if (this._isObject(g) && !this._isDate(g) && !c) {
                return ""
            }
            if (c) {
                if (!a.isFunction(c)) {
                    return g.toString()
                }
                try {
                    return c(g, d, b, f)
                } catch (h) {
                    return h.message
                }
            }
            if (this._isNumber(g)) {
                return this._formatNumber(g, i)
            }
            if (this._isDate(g)) {
                return this._formatDate(g, i)
            }
            if (i) {
                return (i.prefix || "") + g.toString() + (i.sufix || "")
            }
            return g.toString()
        },
        _getFormattedValue: function(f, h, y, p, d, l) {
            var w = this.seriesGroups[f];
            var n = w.series[h];
            var m = "";
            var j = p,
                k = d;
            if (!k) {
                k = n.formatFunction || w.formatFunction
            }
            if (!j) {
                j = n.formatSettings || w.formatSettings
            }
            if (!n.formatFunction && n.formatSettings) {
                k = undefined
            }
            var o = {},
                t = 0;
            for (var b in n) {
                if (b.indexOf("dataField") == 0) {
                    o[b.substring(9).toLowerCase()] = this._getDataValue(y, n[b], f);
                    t++
                }
            }
            if (t == 0) {
                o = this._getDataValue(y, undefined, f)
            }
            if (w.type.indexOf("waterfall") != -1 && this._isSummary(f, y)) {
                o = this._renderData[f].offsets[h][y].value;
                t = 0
            }
            if (k && a.isFunction(k)) {
                try {
                    return k(t == 1 ? o[""] : o, y, n, w)
                } catch (x) {
                    return x.message
                }
            }
            if (t == 1 && this._isPieGroup(f)) {
                return this._formatValue(o[""], j, k, f, h, y)
            }
            if (t > 0) {
                var u = 0;
                for (var b in o) {
                    if (u > 0 && m != "") {
                        m += "<br>"
                    }
                    var r = "dataField" + (b.length > 0 ? b.substring(0, 1).toUpperCase() + b.substring(1) : "");
                    var q = "displayText" + (b.length > 0 ? b.substring(0, 1).toUpperCase() + b.substring(1) : "");
                    var v = n[q] || n[r];
                    var c = o[b];
                    if (undefined != c) {
                        c = this._formatValue(c, j, k, f, h, y)
                    } else {
                        continue
                    }
                    if (l === true) {
                        m += c
                    } else {
                        m += v + ": " + c
                    }
                    u++
                }
            } else {
                if (undefined != o) {
                    m = this._formatValue(o, j, k, f, h, y)
                }
            }
            return m || ""
        },
        _isNumberAsString: function(d) {
            if (typeof(d) != "string") {
                return false
            }
            d = a.trim(d);
            for (var b = 0; b < d.length; b++) {
                var c = d.charAt(b);
                if ((c >= "0" && c <= "9") || c == "," || c == ".") {
                    continue
                }
                if (c == "-" && b == 0) {
                    continue
                }
                if ((c == "(" && b == 0) || (c == ")" && b == d.length - 1)) {
                    continue
                }
                return false
            }
            return true
        },
        _castAsDate: function(f, c) {
            if (f instanceof Date && !isNaN(f)) {
                return f
            }
            if (typeof(f) == "string") {
                var b;
                if (c) {
                    b = a.jqx.dataFormat.parsedate(f, c);
                    if (this._isDate(b)) {
                        return b
                    }
                }
                if (this._autoDateFormats) {
                    for (var e = 0; e < this._autoDateFormats.length; e++) {
                        b = a.jqx.dataFormat.parsedate(f, this._autoDateFormats[e]);
                        if (this._isDate(b)) {
                            return b
                        }
                    }
                }
                var d = this._detectDateFormat(f);
                if (d) {
                    b = a.jqx.dataFormat.parsedate(f, d);
                    if (this._isDate(b)) {
                        this._autoDateFormats.push(d);
                        return b
                    }
                }
                b = new Date(f);
                if (this._isDate(b)) {
                    if (f.indexOf(":") == -1) {
                        b.setHours(0, 0, 0, 0)
                    }
                }
                return b
            }
            return undefined
        },
        _castAsNumber: function(c) {
            if (c instanceof Date && !isNaN(c)) {
                return c.valueOf()
            }
            if (typeof(c) == "string") {
                if (this._isNumber(c)) {
                    c = parseFloat(c)
                } else {
                    if (!/[a-zA-Z]/.test(c)) {
                        var b = new Date(c);
                        if (b != undefined) {
                            c = b.valueOf()
                        }
                    }
                }
            }
            return c
        },
        _isNumber: function(b) {
            if (typeof(b) == "string") {
                if (this._isNumberAsString(b)) {
                    b = parseFloat(b)
                }
            }
            return typeof b === "number" && isFinite(b)
        },
        _isDate: function(b) {
            return b instanceof Date && !isNaN(b.getDate())
        },
        _isBoolean: function(b) {
            return typeof b === "boolean"
        },
        _isObject: function(b) {
            return (b && (typeof b === "object" || a.isFunction(b))) || false
        },
        _formatDate: function(d, c) {
            var b = d.toString();
            if (c) {
                if (c.dateFormat) {
                    b = a.jqx.dataFormat.formatDate(d, c.dateFormat)
                }
                b = (c.prefix || "") + b + (c.sufix || "")
            }
            return b
        },
        _formatNumber: function(n, e) {
            if (!this._isNumber(n)) {
                return n
            }
            e = e || {};
            var q = ".";
            var o = "";
            var r = this;
            if (r.localization) {
                q = r.localization.decimalSeparator || r.localization.decimalseparator || q;
                o = r.localization.thousandsSeparator || r.localization.thousandsseparator || o
            }
            if (e.decimalSeparator) {
                q = e.decimalSeparator
            }
            if (e.thousandsSeparator) {
                o = e.thousandsSeparator
            }
            var m = e.prefix || "";
            var p = e.sufix || "";
            var h = e.decimalPlaces;
            if (isNaN(h)) {
                h = this._getDecimalPlaces([n], undefined, 3)
            }
            var l = e.negativeWithBrackets || false;
            var g = (n < 0);
            if (g && l) {
                n *= -1
            }
            var d = n.toString();
            var b;
            var k = Math.pow(10, h);
            d = (Math.round(n * k) / k).toString();
            if (isNaN(d)) {
                d = ""
            }
            b = d.lastIndexOf(".");
            if (h > 0) {
                if (b < 0) {
                    d += q;
                    b = d.length - 1
                } else {
                    if (q !== ".") {
                        d = d.replace(".", q)
                    }
                }
                while ((d.length - 1 - b) < h) {
                    d += "0"
                }
            }
            b = d.lastIndexOf(q);
            b = (b > -1) ? b : d.length;
            var f = d.substring(b);
            var c = 0;
            for (var j = b; j > 0; j--, c++) {
                if ((c % 3 === 0) && (j !== b) && (!g || (j > 1) || (g && l))) {
                    f = o + f
                }
                f = d.charAt(j - 1) + f
            }
            d = f;
            if (g && l) {
                d = "(" + d + ")"
            }
            return m + d + p
        },
        _defaultNumberFormat: {
            prefix: "",
            sufix: "",
            decimalSeparator: ".",
            thousandsSeparator: ",",
            decimalPlaces: 2,
            negativeWithBrackets: false
        },
        _calculateControlPoints: function(g, f) {
            var e = g[f],
                m = g[f + 1],
                d = g[f + 2],
                j = g[f + 3],
                c = g[f + 4],
                i = g[f + 5];
            var l = 0.4;
            var o = Math.sqrt(Math.pow(d - e, 2) + Math.pow(j - m, 2));
            var b = Math.sqrt(Math.pow(c - d, 2) + Math.pow(i - j, 2));
            var h = (o + b);
            if (h == 0) {
                h = 1
            }
            var n = l * o / h;
            var k = l - n;
            return [d + n * (e - c), j + n * (m - i), d - k * (e - c), j - k * (m - i)]
        },
        _getBezierPoints: function(d) {
            var c = "";
            var h = [],
                e = [];
            var g = d.split(" ");
            for (var f = 0; f < g.length; f++) {
                var j = g[f].split(",");
                h.push(parseFloat(j[0]));
                h.push(parseFloat(j[1]));
                if (isNaN(h[h.length - 1]) || isNaN(h[h.length - 2])) {
                    continue
                }
            }
            var b = h.length;
            if (b <= 1) {
                return ""
            } else {
                if (b == 2) {
                    c = "M" + a.jqx._ptrnd(h[0]) + "," + a.jqx._ptrnd(h[1]) + " L" + a.jqx._ptrnd(h[0] + 1) + "," + a.jqx._ptrnd(h[1] + 1) + " ";
                    return c
                }
            }
            for (var f = 0; f < b - 4; f += 2) {
                e = e.concat(this._calculateControlPoints(h, f))
            }
            for (var f = 2; f < b - 5; f += 2) {
                c += " C" + a.jqx._ptrnd(e[2 * f - 2]) + "," + a.jqx._ptrnd(e[2 * f - 1]) + " " + a.jqx._ptrnd(e[2 * f]) + "," + a.jqx._ptrnd(e[2 * f + 1]) + " " + a.jqx._ptrnd(h[f + 2]) + "," + a.jqx._ptrnd(h[f + 3]) + " "
            }
            if (b <= 4 || (Math.abs(h[0] - h[2]) < 3 || Math.abs(h[1] - h[3]) < 3) || this._isVML) {
                c = "M" + a.jqx._ptrnd(h[0]) + "," + a.jqx._ptrnd(h[1]) + " L" + a.jqx._ptrnd(h[2]) + "," + a.jqx._ptrnd(h[3]) + " " + c
            } else {
                c = "M" + a.jqx._ptrnd(h[0]) + "," + a.jqx._ptrnd(h[1]) + " Q" + a.jqx._ptrnd(e[0]) + "," + a.jqx._ptrnd(e[1]) + " " + a.jqx._ptrnd(h[2]) + "," + a.jqx._ptrnd(h[3]) + " " + c
            }
            if (b >= 4 && (Math.abs(h[b - 2] - h[b - 4]) < 3 || Math.abs(h[b - 1] - h[b - 3]) < 3 || this._isVML)) {
                c += " L" + a.jqx._ptrnd(h[b - 2]) + "," + a.jqx._ptrnd(h[b - 1]) + " "
            } else {
                if (b >= 5) {
                    c += " Q" + a.jqx._ptrnd(e[b * 2 - 10]) + "," + a.jqx._ptrnd(e[b * 2 - 9]) + " " + a.jqx._ptrnd(h[b - 2]) + "," + a.jqx._ptrnd(h[b - 1]) + " "
                }
            }
            return c
        },
        _animTickInt: 50,
        _createAnimationGroup: function(b) {
            if (!this._animGroups) {
                this._animGroups = {}
            }
            this._animGroups[b] = {
                animations: [],
                startTick: NaN
            }
        },
        _startAnimation: function(c) {
            var e = new Date();
            var b = e.getTime();
            this._animGroups[c].startTick = b;
            this._runAnimation();
            this._enableAnimTimer()
        },
        _enqueueAnimation: function(e, d, c, g, f, b, h) {
            if (g < 0) {
                g = 0
            }
            if (h == undefined) {
                h = "easeInOutSine"
            }
            this._animGroups[e].animations.push({
                key: d,
                properties: c,
                duration: g,
                fn: f,
                context: b,
                easing: h
            })
        },
        _stopAnimations: function() {
            clearTimeout(this._animtimer);
            this._animtimer = undefined;
            this._animGroups = undefined
        },
        _enableAnimTimer: function() {
            if (!this._animtimer) {
                var b = this;
                this._animtimer = setTimeout(function() {
                    b._runAnimation()
                }, this._animTickInt)
            }
        },
        _runAnimation: function(q) {
            if (this._animGroups) {
                var t = new Date();
                var h = t.getTime();
                var o = {};
                for (var l in this._animGroups) {
                    var s = this._animGroups[l].animations;
                    var m = this._animGroups[l].startTick;
                    var g = 0;
                    for (var n = 0; n < s.length; n++) {
                        var u = s[n];
                        var b = (h - m);
                        if (u.duration > g) {
                            g = u.duration
                        }
                        var r = u.duration > 0 ? b / u.duration : 1;
                        var k = r;
                        if (u.easing && u.duration != 0) {
                            k = a.easing[u.easing](r, b, 0, 1, u.duration)
                        }
                        if (r > 1) {
                            r = 1;
                            k = 1
                        }
                        if (u.fn) {
                            u.fn(u.key, u.context, k);
                            continue
                        }
                        var f = {};
                        for (var l = 0; l < u.properties.length; l++) {
                            var c = u.properties[l];
                            var e = 0;
                            if (r == 1) {
                                e = c.to
                            } else {
                                e = k * (c.to - c.from) + c.from
                            }
                            f[c.key] = e
                        }
                        this.renderer.attr(u.key, f)
                    }
                    if (m + g > h) {
                        o[l] = ({
                            startTick: m,
                            animations: s
                        })
                    }
                }
                this._animGroups = o;
                if (this.renderer instanceof a.jqx.HTML5Renderer) {
                    this.renderer.refresh()
                }
            }
            this._animtimer = null;
            for (var l in this._animGroups) {
                this._enableAnimTimer();
                break
            }
        },
        _fixCoords: function(d, e) {
            var b = this.seriesGroups[e].orientation == "horizontal";
            if (!b) {
                return d
            }
            var c = d.x;
            d.x = d.y;
            d.y = c + this._plotRect.y - this._plotRect.x;
            var c = d.width;
            d.width = d.height;
            d.height = c;
            return d
        },
        getItemCoord: function(d, f, A) {
            var n = this;
            if (n._isPieGroup(d) && (!n._isSerieVisible(d, f, A) || !n._renderData || n._renderData.length <= d)) {
                return {
                    x: NaN,
                    y: NaN
                }
            }
            if (!n._isSerieVisible(d, f) || !n._renderData || n._renderData.length <= d) {
                return {
                    x: NaN,
                    y: NaN
                }
            }
            var u = n.seriesGroups[d];
            var l = u.series[f];
            var q = n._getItemCoord(d, f, A);
            if (n._isPieGroup(d)) {
                if (isNaN(q.x) || isNaN(q.y) || isNaN(q.fromAngle) || isNaN(q.toAngle)) {
                    return {
                        x: NaN,
                        y: NaN
                    }
                }
                var k = this._plotRect;
                var r = q.fromAngle * (Math.PI / 180);
                var h = q.toAngle * (Math.PI / 180);
                var v = k.x + q.center.x + Math.cos(r) * q.outerRadius;
                var t = k.x + q.center.x + Math.cos(h) * q.outerRadius;
                var c = k.y + q.center.y - Math.sin(r) * q.outerRadius;
                var b = k.y + q.center.y - Math.sin(h) * q.outerRadius;
                var j = Math.min(v, t);
                var o = Math.abs(t - v);
                var i = Math.min(c, b);
                var m = Math.abs(b - c);
                q = {
                    x: j,
                    y: i,
                    width: o,
                    height: m,
                    center: q.center,
                    centerOffset: q.centerOffset,
                    innerRadius: q.innerRadius,
                    outerRadius: q.outerRadius,
                    selectedRadiusChange: q.selectedRadiusChange,
                    fromAngle: q.fromAngle,
                    toAngle: q.toAngle
                };
                return q
            }
            if (u.type.indexOf("column") != -1 || u.type.indexOf("waterfall") != -1) {
                var B = this._getColumnSerieWidthAndOffset(d, f);
                q.height = Math.abs(q.y.to - q.y.from);
                q.y = Math.min(q.y.to, q.y.from);
                q.x += B.offset;
                q.width = B.width
            } else {
                if (u.type.indexOf("ohlc") != -1 || u.type.indexOf("candlestick") != -1) {
                    var B = this._getColumnSerieWidthAndOffset(d, f);
                    var i = q.y;
                    var z = Math.min(i.Open, i.Close, i.Low, i.High);
                    var w = Math.max(i.Open, i.Close, i.Low, i.High);
                    q.height = Math.abs(w - z);
                    q.y = z;
                    q.x += B.offset;
                    q.width = B.width
                } else {
                    if (u.type.indexOf("line") != -1 || u.type.indexOf("area") != -1) {
                        q.width = q.height = 0;
                        q.y = q.y.to
                    } else {
                        if (u.type.indexOf("bubble") != -1 || u.type.indexOf("scatter") != -1) {
                            q.center = {
                                x: q.x,
                                y: q.y.to
                            };
                            var e = q.y.radius;
                            if (l.symbolType != "circle" && l.symbolType != undefined) {
                                e /= 2
                            }
                            q.y = q.y.to;
                            q.radius = e;
                            q.width = 2 * e;
                            q.height = 2 * e
                        }
                    }
                }
            }
            q = this._fixCoords(q, d);
            if (u.polar || u.spider) {
                var p = this._toPolarCoord(this._renderData[d].polarCoords, this._plotRect, q.x, q.y);
                q.x = p.x;
                q.y = p.y;
                if (q.center) {
                    q.center = this._toPolarCoord(this._renderData[d].polarCoords, this._plotRect, q.center.x, q.center.y)
                }
            }
            if (u.type.indexOf("bubble") != -1 || u.type.indexOf("scatter") != -1) {
                q.x -= e;
                q.y -= e
            }
            return q
        },
        _getItemCoord: function(o, j, b) {
            var e = this.seriesGroups[o],
                l, k;
            if (!e || !this._renderData) {
                return {
                    x: NaN,
                    y: NaN
                }
            }
            var f = e.series[j];
            if (!f) {
                return {
                    x: NaN,
                    y: NaN
                }
            }
            var h = this._plotRect;
            if (this._isPieGroup(o)) {
                var m = this._renderData[o].offsets[j][b];
                if (!m) {
                    return {
                        x: NaN,
                        y: NaN
                    }
                }
                var c = (m.fromAngle + m.toAngle) / 2 * (Math.PI / 180);
                l = h.x + m.x + Math.cos(c) * m.outerRadius;
                k = h.y + m.y - Math.sin(c) * m.outerRadius;
                return {
                    x: l,
                    y: k,
                    center: {
                        x: m.x,
                        y: m.y
                    },
                    centerOffset: m.centerOffset,
                    innerRadius: m.innerRadius,
                    outerRadius: m.outerRadius,
                    selectedRadiusChange: m.selectedRadiusChange,
                    fromAngle: m.fromAngle,
                    toAngle: m.toAngle
                }
            } else {
                l = h.x + this._renderData[o].xoffsets.data[b];
                k = this._renderData[o].offsets[j][b];
                if (isNaN(l) || !k) {
                    return {
                        x: NaN,
                        y: NaN
                    }
                }
            }
            var n = {};
            for (var d in k) {
                n[d] = k[d]
            }
            return {
                x: l,
                y: n
            }
        },
        getXAxisValue: function(g, r) {
            var q = this.seriesGroups[r];
            if (!q) {
                return undefined
            }
            var c = this._getXAxis(r);
            var n = this._plotRect;
            var b = 0;
            var m = NaN;
            var e = this._renderData[0].xoffsets.axisStats;
            var f = 0,
                l = 0;
            if (q.polar || q.spider) {
                if (isNaN(g.x) || isNaN(g.y)) {
                    return NaN
                }
                var h = this._getPolarAxisCoords(r, n);
                var k = a.jqx._ptdist(g.x, g.y, h.x, h.y);
                if (k > h.r) {
                    return NaN
                }
                var i = Math.atan2(h.y - g.y, g.x - h.x);
                i = Math.PI / 2 - i;
                if (i < 0) {
                    i = 2 * Math.PI + i
                }
                m = i * h.r;
                var j = h.startAngle + Math.PI / 2;
                var d = h.endAngle + Math.PI / 2;
                f = j * h.r;
                l = d * h.r;
                b = (d - j) * h.r;
                var o = this._getPaddingSize(e, c, c.valuesOnTicks, b, true, h.isClosedCircle, this._hasColumnSeries());
                if (h.isClosedCircle) {
                    b -= (o.left + o.right);
                    l -= (o.left + o.right)
                } else {
                    if (!c.valuesOnTicks) {
                        f += o.left;
                        l -= o.right
                    }
                }
            } else {
                if (q.orientation != "horizontal") {
                    if (g < n.x || g > n.x + n.width) {
                        return NaN
                    }
                    m = g - n.x;
                    b = n.width
                } else {
                    if (g < n.y || g > n.y + n.height) {
                        return NaN
                    }
                    m = g - n.y;
                    b = n.height
                }
                if (this._renderData[r] && this._renderData[r].xoffsets) {
                    var o = this._renderData[r].xoffsets.padding;
                    b -= (o.left + o.right);
                    m -= o.left
                }
                l = b
            }
            var p = this._jqxPlot.scale(m, {
                min: f,
                max: l
            }, {
                min: e.min.valueOf(),
                max: e.max.valueOf(),
                type: e.logAxis.enabled ? "logarithmic" : "linear",
                base: e.logAxis.base,
                flip: c.flip
            });
            return p
        },
        getValueAxisValue: function(c, j) {
            var i = this.seriesGroups[j];
            if (!i) {
                return undefined
            }
            var k = this._getValueAxis(j);
            var g = this._plotRect;
            var b = 0;
            var f = NaN;
            if (i.polar || i.spider) {
                if (isNaN(c.x) || isNaN(c.y)) {
                    return NaN
                }
                var e = this._getPolarAxisCoords(j, g);
                f = a.jqx._ptdist(c.x, c.y, e.x, e.y);
                b = e.r;
                f = b - f
            } else {
                if (i.orientation == "horizontal") {
                    if (c < g.x || c > g.x + g.width) {
                        return NaN
                    }
                    f = c - g.x;
                    b = g.width
                } else {
                    if (c < g.y || c > g.y + g.height) {
                        return NaN
                    }
                    f = c - g.y;
                    b = g.height
                }
            }
            var d = this._stats.seriesGroups[j];
            var h = this._jqxPlot.scale(f, {
                min: 0,
                max: b
            }, {
                min: d.min.valueOf(),
                max: d.max.valueOf(),
                type: d.logarithmic ? "logarithmic" : "linear",
                base: d.logBase,
                flip: !k.flip
            });
            return h
        },
        _detectDateFormat: function(g, c) {
            var h = {
                en_US_d: "M/d/yyyy",
                en_US_D: "dddd, MMMM dd, yyyy",
                en_US_t: "h:mm tt",
                en_US_T: "h:mm:ss tt",
                en_US_f: "dddd, MMMM dd, yyyy h:mm tt",
                en_US_F: "dddd, MMMM dd, yyyy h:mm:ss tt",
                en_US_M: "MMMM dd",
                en_US_Y: "yyyy MMMM",
                en_US_S: "yyyy\u0027-\u0027MM\u0027-\u0027dd\u0027T\u0027HH\u0027:\u0027mm\u0027:\u0027ss",
                en_CA_d: "dd/MM/yyyy",
                en_CA_D: "MMMM-dd-yy",
                en_CA_f: "MMMM-dd-yy h:mm tt",
                en_CA_F: "MMMM-dd-yy h:mm:ss tt",
                ISO: "yyyy-MM-dd hh:mm:ss",
                ISO2: "yyyy-MM-dd HH:mm:ss",
                d1: "dd.MM.yyyy",
                d2: "dd-MM-yyyy",
                zone1: "yyyy-MM-ddTHH:mm:ss-HH:mm",
                zone2: "yyyy-MM-ddTHH:mm:ss+HH:mm",
                custom: "yyyy-MM-ddTHH:mm:ss.fff",
                custom2: "yyyy-MM-dd HH:mm:ss.fff",
                de_DE_d: "dd.MM.yyyy",
                de_DE_D: "dddd, d. MMMM yyyy",
                de_DE_t: "HH:mm",
                de_DE_T: "HH:mm:ss",
                de_DE_f: "dddd, d. MMMM yyyy HH:mm",
                de_DE_F: "dddd, d. MMMM yyyy HH:mm:ss",
                de_DE_M: "dd MMMM",
                de_DE_Y: "MMMM yyyy",
                fr_FR_d: "dd/MM/yyyy",
                fr_FR_D: "dddd d MMMM yyyy",
                fr_FR_t: "HH:mm",
                fr_FR_T: "HH:mm:ss",
                fr_FR_f: "dddd d MMMM yyyy HH:mm",
                fr_FR_F: "dddd d MMMM yyyy HH:mm:ss",
                fr_FR_M: "d MMMM",
                fr_FR_Y: "MMMM yyyy",
                it_IT_d: "dd/MM/yyyy",
                it_IT_D: "dddd d MMMM yyyy",
                it_IT_t: "HH:mm",
                it_IT_T: "HH:mm:ss",
                it_IT_f: "dddd d MMMM yyyy HH:mm",
                it_IT_F: "dddd d MMMM yyyy HH:mm:ss",
                it_IT_M: "dd MMMM",
                it_IT_Y: "MMMM yyyy",
                ru_RU_d: "dd.MM.yyyy",
                ru_RU_D: "d MMMM yyyy '?.'",
                ru_RU_t: "H:mm",
                ru_RU_T: "H:mm:ss",
                ru_RU_f: "d MMMM yyyy '?.' H:mm",
                ru_RU_F: "d MMMM yyyy '?.' H:mm:ss",
                ru_RU_Y: "MMMM yyyy",
                cs_CZ_d: "d.M.yyyy",
                cs_CZ_D: "d. MMMM yyyy",
                cs_CZ_t: "H:mm",
                cs_CZ_T: "H:mm:ss",
                cs_CZ_f: "d. MMMM yyyy H:mm",
                cs_CZ_F: "d. MMMM yyyy H:mm:ss",
                cs_CZ_M: "dd MMMM",
                cs_CZ_Y: "MMMM yyyy",
                he_IL_d: "dd MMMM yyyy",
                he_IL_D: "dddd dd MMMM yyyy",
                he_IL_t: "HH:mm",
                he_IL_T: "HH:mm:ss",
                he_IL_f: "dddd dd MMMM yyyy HH:mm",
                he_IL_F: "dddd dd MMMM yyyy HH:mm:ss",
                he_IL_M: "dd MMMM",
                he_IL_Y: "MMMM yyyy",
                hr_HR_d: "d.M.yyyy.",
                hr_HR_D: "d. MMMM yyyy.",
                hr_HR_t: "H:mm",
                hr_HR_T: "H:mm:ss",
                hr_HR_f: "d. MMMM yyyy. H:mm",
                hr_HR_F: "d. MMMM yyyy. H:mm:ss",
                hr_HR_M: "d. MMMM",
                hu_HU_d: "yyyy.MM.dd.",
                hu_HU_D: "yyyy. MMMM d.",
                hu_HU_t: "H:mm",
                hu_HU_T: "H:mm:ss",
                hu_HU_f: "yyyy. MMMM d. H:mm",
                hu_HU_F: "yyyy. MMMM d. H:mm:ss",
                hu_HU_M: "MMMM d.",
                hu_HU_Y: "yyyy. MMMM",
                jp_JP_d: "gg y/M/d",
                jp_JP_D: "gg y'?'M'?'d'?'",
                jp_JP_t: "H:mm",
                jp_JP_T: "H:mm:ss",
                jp_JP_f: "gg y'?'M'?'d'?' H:mm",
                jp_JP_F: "gg y'?'M'?'d'?' H:mm:ss",
                jp_JP_M: "M'?'d'?'",
                jp_JP_Y: "gg y'?'M'?'",
                lt_LT_d: "yyyy.MM.dd",
                lt_LT_D: "yyyy 'm.' MMMM d 'd.'",
                lt_LT_t: "HH:mm",
                lt_LT_T: "HH:mm:ss",
                lt_LT_f: "yyyy 'm.' MMMM d 'd.' HH:mm",
                lt_LT_F: "yyyy 'm.' MMMM d 'd.' HH:mm:ss",
                lt_LT_M: "MMMM d 'd.'",
                lt_LT_Y: "yyyy 'm.' MMMM",
                sa_IN_d: "dd-MM-yyyy",
                sa_IN_D: "dd MMMM yyyy dddd",
                sa_IN_t: "HH:mm",
                sa_IN_T: "HH:mm:ss",
                sa_IN_f: "dd MMMM yyyy dddd HH:mm",
                sa_IN_F: "dd MMMM yyyy dddd HH:mm:ss",
                sa_IN_M: "dd MMMM",
                basic_y: "yyyy",
                basic_ym: "yyyy-MM",
                basic_d: "yyyy-MM-dd",
                basic_dhm: "yyyy-MM-dd hh:mm",
                basic_bhms: "yyyy-MM-dd hh:mm:ss",
                basic2_ym: "MM-yyyy",
                basic2_d: "MM-dd-yyyy",
                basic2_dhm: "MM-dd-yyyy hh:mm",
                basic2_dhms: "MM-dd-yyyy hh:mm:ss",
                basic3_ym: "yyyy/MM",
                basic3_d: "yyyy/MM/dd",
                basic3_dhm: "yyyy/MM/dd hh:mm",
                basic3_bhms: "yyyy/MM/dd hh:mm:ss",
                basic4_ym: "MM/yyyy",
                basic4_d: "MM/dd/yyyy",
                basic4_dhm: "MM/dd/yyyy hh:mm",
                basic4_dhms: "MM/dd/yyyy hh:mm:ss"
            };
            if (c) {
                h = a.extend({}, h, c)
            }
            var f = [];
            if (!a.isArray(g)) {
                f.push(g)
            } else {
                f = g
            }
            for (var d in h) {
                h[d] = {
                    format: h[d],
                    count: 0
                }
            }
            for (var e = 0; e < f.length; e++) {
                var k = f[e];
                if (k == null || k == undefined) {
                    continue
                }
                for (var d in h) {
                    var l = a.jqx.dataFormat.parsedate(k, h[d].format);
                    if (l != null) {
                        h[d].count++
                    }
                }
            }
            var b = {
                key: undefined,
                count: 0
            };
            for (var d in h) {
                if (h[d].count > b.count) {
                    b.key = d;
                    b.count = h[d].count
                }
            }
            return b.key ? h[b.key].format : ""
        },
        _testXAxisDateFormat: function(j) {
            var l = this;
            var d = l._getXAxis(j);
            var c = l._getDataLen(j);
            var e = {};
            if (l.localization && l.localization.patterns) {
                for (var k in l.localization.patterns) {
                    e["local_" + k] = l.localization.patterns[k]
                }
            }
            var g = [];
            for (var f = 0; f < c && f < 10; f++) {
                var h = l._getDataValue(f, d.dataField, j);
                if (h == null || h == undefined) {
                    continue
                }
                g.push(h)
            }
            var b = l._detectDateFormat(g, e);
            return b
        }
    })
})(jqxBaseFramework);

(function(a) {
    a.extend(a.jqx._jqxChart.prototype, {
        _moduleApi: true,
        getItemsCount: function(f, b) {
            var d = this.seriesGroups[f];
            if (!this._isSerieVisible(f, b)) {
                return 0
            }
            var e = this._renderData;
            if (!d || !e || e.length <= f) {
                return 0
            }
            var c = d.series[b];
            if (!c) {
                return 0
            }
            return e[f].offsets[b].length
        },
        getXAxisRect: function(c) {
            var b = this._renderData;
            if (!b || b.length <= c) {
                return undefined
            }
            if (!b[c].xAxis) {
                return undefined
            }
            return b[c].xAxis.rect
        },
        getXAxisLabels: function(k) {
            var d = [];
            var l = this._renderData;
            if (!l || l.length <= k) {
                return d
            }
            l = l[k].xAxis;
            if (!l) {
                return d
            }
            var j = this.seriesGroups[k];
            if (j.polar || j.spider) {
                for (var e = 0; e < l.polarLabels.length; e++) {
                    var h = l.polarLabels[e];
                    d.push({
                        offset: {
                            x: h.x,
                            y: h.y
                        },
                        value: h.value
                    })
                }
                return d
            }
            var c = this._getXAxis(k);
            var g = this.getXAxisRect(k);
            var b = c.position == "top" || c.position == "right";
            var f = j.orientation == "horizontal";
            for (var e = 0; e < l.data.length; e++) {
                if (f) {
                    d.push({
                        offset: {
                            x: g.x + (b ? 0 : g.width),
                            y: g.y + l.data.data[e]
                        },
                        value: l.data.xvalues[e]
                    })
                } else {
                    d.push({
                        offset: {
                            x: g.x + l.data.data[e],
                            y: g.y + (b ? g.height : 0)
                        },
                        value: l.data.xvalues[e]
                    })
                }
            }
            return d
        },
        getValueAxisRect: function(c) {
            var b = this._renderData;
            if (!b || b.length <= c) {
                return undefined
            }
            if (!b[c].valueAxis) {
                return undefined
            }
            return b[c].valueAxis.rect
        },
        getValueAxisLabels: function(h) {
            var c = [];
            var j = this._renderData;
            if (!j || j.length <= h) {
                return c
            }
            j = j[h].valueAxis;
            if (!j) {
                return c
            }
            var k = this._getValueAxis(h);
            var b = k.position == "top" || k.position == "right";
            var g = this.seriesGroups[h];
            var e = g.orientation == "horizontal";
            if (g.polar || g.spider) {
                for (var d = 0; d < j.polarLabels.length; d++) {
                    var f = j.polarLabels[d];
                    c.push({
                        offset: {
                            x: f.x,
                            y: f.y
                        },
                        value: f.value
                    })
                }
                return c
            }
            for (var d = 0; d < j.items.length; d++) {
                if (e) {
                    c.push({
                        offset: {
                            x: j.itemOffsets[j.items[d]].x + j.itemWidth / 2,
                            y: j.rect.y + (b ? j.rect.height : 0)
                        },
                        value: j.items[d]
                    })
                } else {
                    c.push({
                        offset: {
                            x: j.rect.x + j.rect.width,
                            y: j.itemOffsets[j.items[d]].y + j.itemWidth / 2
                        },
                        value: j.items[d]
                    })
                }
            }
            return c
        },
        getPlotAreaRect: function() {
            return this._plotRect
        },
        getRect: function() {
            return this._rect
        },
        showToolTip: function(f, c, e, b, d) {
            var g = this.getItemCoord(f, c, e);
            if (isNaN(g.x) || isNaN(g.y)) {
                return
            }
            this._startTooltipTimer(f, c, e, g.x, g.y, b, d)
        },
        hideToolTip: function(c) {
            if (isNaN(c)) {
                c = 0
            }
            var b = this;
            b._cancelTooltipTimer();
            setTimeout(function() {
                b._hideToolTip(0)
            }, c)
        },
    })
})(jqxBaseFramework);

(function(a) {
    a.extend(a.jqx._jqxChart.prototype, {
        _moduleRangeSelector: true,
        _renderXAxisRangeSelector: function(p, n) {
            var r = this;
            r._isTouchDevice = a.jqx.mobile.isTouchDevice();
            var i = r.seriesGroups[p];
            var e = r._getXAxis(p);
            var l = e ? e.rangeSelector : undefined;
            if (!r._isSelectorRefresh) {
                var q = (l && l.renderTo) ? l.renderTo : r.host;
                q.find(".rangeSelector").remove()
            }
            if (!e || e.visible == false || i.type == "spider") {
                return false
            }
            if (!r._isGroupVisible(p)) {
                return false
            }
            if (!l) {
                return false
            }
            var h = i.orientation == "horizontal";
            if (l.renderTo) {
                h = false
            }
            if (r.rtl) {
                e.flip = true
            }
            var d = h ? this.host.height() : this.host.width();
            d -= 4;
            var o = this._getXAxisStats(p, e, d);
            var k = e.position;
            if (l.renderTo && l.position) {
                k = l.position
            }
            if (!this._isSelectorRefresh) {
                var m = l.renderTo;
                var b = "<div class='rangeSelector jqx-disableselect' style='position: absolute; background-color: transparent;' onselectstart='return false;'></div>";
                var f = a(b).appendTo(m ? m : this.renderer.getContainer());
                if (!m) {
                    var j = this.host.coord();
                    j.top = 0;
                    j.left = 0;
                    var c = this._selectorGetSize(e);
                    if (!h) {
                        f.css("left", j.left + 1);
                        f.css("top", j.top + n.y + (k != "top" ? n.height : -c));
                        f.css("height", c);
                        f.css("width", d)
                    } else {
                        f.css("left", j.left + 1 + n.x + (k != "right" ? -c : n.width));
                        f.css("top", j.top);
                        f.css("height", d);
                        f.css("width", c);
                        n.height = c
                    }
                } else {
                    f.css({
                        width: m.width(),
                        height: m.height()
                    });
                    n.width = m.width();
                    n.height = m.height()
                }
                this._refreshSelector(p, e, o, f, n, h)
            }
            this._isSelectorRefresh = false;
            return true
        },
        _refreshSelector: function(f, e, d, A, c, b) {
            var g = {};
            var u = e.rangeSelector;
            var k = this.seriesGroups[f];
            for (var w in u) {
                g[w] = u[w]
            }
            delete g.padding;
            var r = g.minValue;
            var v = g.maxValue;
            if (undefined == r) {
                r = Math.min(d.min.valueOf(), d.dsRange.min.valueOf())
            }
            if (undefined == v) {
                v = Math.max(d.max.valueOf(), d.dsRange.max.valueOf())
            }
            if (this._isDate(d.min)) {
                r = new Date(r)
            }
            if (this._isDate(d.max)) {
                v = new Date(v)
            }
            var l = e.position;
            if (u.renderTo && u.position) {
                l = u.position
            }
            g.dataField = e.dataField;
            delete g.rangeSelector;
            g.type = e.type;
            g.baseUnit = u.baseUnit || e.baseUnit;
            g.minValue = r;
            g.maxValue = v;
            g.flip = e.flip;
            g.position = l;
            var h = 5;
            var q = 2,
                z = 2,
                y = 2,
                C = 2;
            if (!u.renderTo) {
                q = b ? 0 : c.x;
                z = b ? 0 : this._rect.width - c.x - c.width;
                y = b ? c.y : h;
                C = b ? this._paddedRect.height - this._plotRect.height : h
            }
            var n = u.padding;
            if (n == undefined && !u.renderTo) {
                n = {
                    left: q,
                    top: y,
                    right: z,
                    bottom: C
                }
            } else {
                n = {
                    left: ((n && n.left) ? n.left : q),
                    top: ((n && n.top) ? n.top : y),
                    right: ((n && n.right) ? n.right : z),
                    bottom: ((n && n.bottom) ? n.bottom : C)
                }
            }
            var t = e.rangeSelector.dataField;
            for (var w = 0; undefined == t && w < this.seriesGroups.length; w++) {
                for (var s = 0; undefined == t && s < this.seriesGroups[w].series.length; s++) {
                    t = this.seriesGroups[w].series[s].dataField
                }
            }
            var m = {
                padding: n,
                _isRangeSelectorInstance: true,
                title: u.title || "",
                description: u.description || "",
                titlePadding: u.titlePadding,
                colorScheme: u.colorScheme || this.colorScheme,
                backgroundColor: u.backgroundColor || this.backgroundColor || "transparent",
                backgroundImage: u.backgroundImage || "",
                showBorderLine: u.showBorderLine || (u.renderTo ? true : false),
                borderLineWidth: u.borderLineWidth || this.borderLineWidth,
                borderLineColor: u.borderLineColor || this.borderLineColor,
                rtl: u.rtl || this.rtl,
                greyScale: u.greyScale || this.greyScale,
                renderEngine: this.renderEngine,
                showLegend: false,
                enableAnimations: false,
                enableEvents: false,
                showToolTips: false,
                source: this.source,
                xAxis: g,
                seriesGroups: [{
                    orientation: b ? "horizontal" : "vertical",
                    valueAxis: {
                        visible: false
                    },
                    type: e.rangeSelector.serieType || "area",
                    skipOverlappingPoints: a.jqx.getByPriority([e.rangeSelector.skipOverlappingPoints, true]),
                    columnSeriesOverlap: a.jqx.getByPriority([e.rangeSelector.columnSeriesOverlap, false]),
                    columnsGapPercent: a.jqx.getByPriority([e.rangeSelector.columnsGapPercent, 25]),
                    seriesGapPercent: a.jqx.getByPriority([e.rangeSelector.seriesGapPercent, 25]),
                    series: [{
                        dataField: t,
                        opacity: 0.8,
                        lineWidth: 1
                    }]
                }]
            };
            if (e.rangeSelector.seriesGroups) {
                m.seriesGroups = e.rangeSelector.seriesGroups
            }
            if (e.rangeSelector.valueAxis) {
                m.valueAxis = e.rangeSelector.valueAxis
            }
            if (!m.showBorderLine) {
                m.borderLineWidth = 1;
                m.borderLineColor = a.jqx.getByPriority([this.backgroundColor, this.background, "#FFFFFF"]);
                m.showBorderLine = true
            }
            var o = this;
            o._supressBindingRefresh = true;
            A.empty();
            A.jqxChart(m);
            o._rangeSelectorInstances[f] = A;
            o._supressBindingRefresh = false;
            A.on(o._getEvent("mousemove"), function() {
                o._unselect();
                o._hideToolTip()
            });
            var x = A.jqxChart("getInstance");
            if (!x._plotRect) {
                return
            }
            var B = x._paddedRect;
            B.height = x._plotRect.height;
            if (!b && l == "top") {
                B.y += x._renderData[0].xAxis.rect.height
            } else {
                if (b) {
                    var p = x._renderData[0].xAxis.rect.width;
                    B.width -= p;
                    if (l != "right") {
                        B.x += p
                    }
                }
            }
            o._createSliderElements(f, A, B, u);
            o.removeHandler(a(document), o._getEvent("mousemove") + "." + this.element.id, o._onSliderMouseMove);
            o.removeHandler(a(document), o._getEvent("mousedown"), o._onSliderMouseDown);
            o.removeHandler(a(document), o._getEvent("mouseup") + "." + this.element.id, o._onSliderMouseUp);
            o.addHandler(a(document), o._getEvent("mousemove") + "." + this.element.id, o._onSliderMouseMove, {
                self: this,
                groupIndex: f,
                renderTo: A,
                swapXY: b
            });
            o.addHandler(a(A), o._getEvent("mousedown"), this._onSliderMouseDown, {
                self: this,
                groupIndex: f,
                renderTo: A,
                swapXY: b
            });
            o.addHandler(a(document), o._getEvent("mouseup") + "." + this.element.id, o._onSliderMouseUp, {
                element: this.element.id,
                self: this,
                groupIndex: f,
                renderTo: A,
                swapXY: b
            })
        },
        _createSliderElements: function(d, t, c, l) {
            t.find(".slider").remove();
            var g = l.selectedRangeColor || "blue";
            var b = a.jqx.getByPriority([l.selectedRangeOpacity, 0.1]);
            var u = a.jqx.getByPriority([l.unselectedRangeOpacity, 0.5]);
            var m = l.unselectedRangeColor || "white";
            var f = l.rangeLineColor || "grey";
            var i = a("<div class='slider' style='position: absolute;'></div>");
            i.css({
                background: g,
                opacity: b,
                left: c.x,
                top: c.y,
                width: c.width,
                height: c.height
            });
            i.appendTo(t);
            while (this._sliders.length < d + 1) {
                this._sliders.push({})
            }
            var n = "<div class='slider' style='position: absolute;  background: " + m + "; opacity: " + u + ";'></div>";
            var p = "<div class='slider' style='position: absolute; background:" + f + "; opacity: " + u + ";'></div>";
            var h = "<div class='slider jqx-rc-all' style='position: absolute; background: white; border-style: solid; border-width: 1px; border-color: " + f + ";'></div>";
            this._sliders[d] = {
                element: i,
                host: t,
                _sliderInitialAbsoluteRect: {
                    x: i.coord().left,
                    y: i.coord().top,
                    width: c.width,
                    height: c.height
                },
                _hostInitialAbsolutePos: {
                    x: t.coord().left,
                    y: t.coord().top
                },
                getRect: function() {
                    return {
                        x: this.host.coord().left - this._hostInitialAbsolutePos.x + this._sliderInitialAbsoluteRect.x,
                        y: this.host.coord().top - this._hostInitialAbsolutePos.y + this._sliderInitialAbsoluteRect.y,
                        width: this._sliderInitialAbsoluteRect.width,
                        height: this._sliderInitialAbsoluteRect.height
                    }
                },
                rect: c,
                left: a(n),
                right: a(n),
                leftTop: a(p),
                rightTop: a(p),
                leftBorder: a(p),
                leftBar: a(h),
                rightBorder: a(p),
                rightBar: a(h)
            };
            this._sliders[d].left.appendTo(t);
            this._sliders[d].right.appendTo(t);
            this._sliders[d].leftTop.appendTo(t);
            this._sliders[d].rightTop.appendTo(t);
            this._sliders[d].leftBorder.appendTo(t);
            this._sliders[d].rightBorder.appendTo(t);
            this._sliders[d].leftBar.appendTo(t);
            this._sliders[d].rightBar.appendTo(t);
            var k = this._renderData[d].xAxis;
            var s = k.data.axisStats;
            var j = s.min.valueOf();
            var q = s.max.valueOf();
            var o = this._valueToOffset(d, j);
            var e = this._valueToOffset(d, q);
            if (o > e) {
                var r = e;
                e = o;
                o = r
            }
            if (this.seriesGroups[d].orientation != "horizontal") {
                i.css({
                    left: Math.round(c.x + o),
                    top: c.y,
                    width: Math.round(e - o),
                    height: c.height
                })
            } else {
                i.css({
                    top: Math.round(c.y + o),
                    left: c.x,
                    height: Math.round(e - o),
                    width: c.width
                })
            }
            this._setSliderPositions(d, o, e)
        },
        _setSliderPositions: function(e, r, h) {
            var t = this.seriesGroups[e];
            var d = this._getXAxis(e);
            var o = d.rangeSelector;
            var b = t.orientation == "horizontal";
            if (d.rangeSelector.renderTo) {
                b = false
            }
            var j = d.position;
            if (o.renderTo && o.position) {
                j = o.position
            }
            var l = (b && j == "right") || (!b && j == "top");
            var n = this._sliders[e];
            var q = b ? "top" : "left";
            var f = b ? "left" : "top";
            var i = b ? "height" : "width";
            var p = b ? "width" : "height";
            var k = b ? "y" : "x";
            var m = b ? "x" : "y";
            var c = n.rect;
            n.startOffset = r;
            n.endOffset = h;
            n.left.css(q, c[k]);
            n.left.css(f, c[m]);
            n.left.css(i, r);
            n.left.css(p, c[p]);
            n.right.css(q, c[k] + h);
            n.right.css(f, c[m]);
            n.right.css(i, c[i] - h + 1);
            n.right.css(p, c[p]);
            n.leftTop.css(q, c[k]);
            n.leftTop.css(f, c[m] + (((b && j == "right") || (!b && j != "top")) ? 0 : c[p]));
            n.leftTop.css(i, r);
            n.leftTop.css(p, 1);
            n.rightTop.css(q, c[k] + h);
            n.rightTop.css(f, c[m] + (((b && j == "right") || (!b && j != "top")) ? 0 : c[p]));
            n.rightTop.css(i, c[i] - h + 1);
            n.rightTop.css(p, 1);
            n.leftBorder.css(q, c[k] + r);
            n.leftBorder.css(f, c[m]);
            n.leftBorder.css(i, 1);
            n.leftBorder.css(p, c[p]);
            var s = c[p] / 4;
            if (s > 20) {
                s = 20
            }
            if (s < 3) {
                s = 3
            }
            n.leftBar.css(q, c[k] + r - 3);
            n.leftBar.css(f, c[m] + c[p] / 2 - s / 2);
            n.leftBar.css(i, 5);
            n.leftBar.css(p, s);
            n.rightBorder.css(q, c[k] + h);
            n.rightBorder.css(f, c[m]);
            n.rightBorder.css(i, 1);
            n.rightBorder.css(p, c[p]);
            n.rightBar.css(q, c[k] + h - 3);
            n.rightBar.css(f, c[m] + c[p] / 2 - s / 2);
            n.rightBar.css(i, 5);
            n.rightBar.css(p, s)
        },
        _resizeState: {},
        _onSliderMouseDown: function(d) {
            d.stopImmediatePropagation();
            d.stopPropagation();
            var b = d.data.self;
            var c = b._sliders[d.data.groupIndex];
            if (!c) {
                return
            }
            if (b._resizeState.state == undefined) {
                b._testAndSetReadyResize(d)
            }
            if (b._resizeState.state != "ready") {
                return
            }
            a.jqx._rangeSelectorTarget = b;
            b._resizeState.state = "resizing"
        },
        _valueToOffset: function(m, k) {
            var l = this.seriesGroups[m];
            var d = this._sliders[m];
            var c = d.host.jqxChart("getInstance");
            var n = c._renderData[0].xAxis;
            var g = n.data.axisStats;
            var j = g.min.valueOf();
            var b = g.max.valueOf();
            var h = b - j;
            if (h == 0) {
                h = 1
            }
            var e = this._getXAxis(m);
            var f = l.orientation == "horizontal" ? "height" : "width";
            var i = (k.valueOf() - j) / h;
            return d.getRect()[f] * (e.flip ? (1 - i) : i)
        },
        _offsetToValue: function(o, f) {
            var d = this._sliders[o];
            var n = this.seriesGroups[o];
            var e = this._getXAxis(o);
            var g = n.orientation == "horizontal" ? "height" : "width";
            var i = d.getRect()[g];
            if (i == 0) {
                i = 1
            }
            var j = f / i;
            var c = d.host.jqxChart("getInstance");
            var m = c._renderData[0].xAxis;
            var h = m.data.axisStats;
            var k = h.min.valueOf();
            var b = h.max.valueOf();
            var l = f / i * (b - k) + k;
            if (e.flip == true) {
                l = b - f / i * (b - k)
            }
            if (this._isDate(h.min) || this._isDate(h.max)) {
                l = new Date(l)
            } else {
                if (e.dataField == undefined || h.useIndeces) {
                    l = Math.round(l)
                }
                if (l < h.min) {
                    l = h.min
                }
                if (l > h.max) {
                    l = h.max
                }
            }
            return l
        },
        _onSliderMouseUp: function(r) {
            var m = a.jqx._rangeSelectorTarget;
            if (!m) {
                return
            }
            var g = r.data.groupIndex;
            var b = r.data.swapXY;
            var o = m._sliders[g];
            if (!o) {
                return
            }
            if (m._resizeState.state != "resizing") {
                return
            }
            r.stopImmediatePropagation();
            r.stopPropagation();
            m._resizeState = {};
            m.host.css("cursor", "default");
            var j = !b ? "left" : "top";
            var c = !b ? "width" : "height";
            var q = !b ? "x" : "y";
            var p = o.element.coord()[j];
            var e = p + (!b ? o.element.width() : o.element.height());
            var d = o.getRect();
            var k = m._offsetToValue(g, p - d[q]);
            var t = m._offsetToValue(g, e - d[q]);
            var l = o.host.jqxChart("getInstance");
            var n = l._renderData[0].xAxis;
            var v = n.data.axisStats;
            if (!v.isTimeUnit && (t.valueOf() - k.valueOf()) > 86400000) {
                k.setHours(0, 0, 0, 0);
                t.setDate(t.getDate() + 1);
                t.setHours(0, 0, 0, 0)
            }
            var f = m._getXAxis(g);
            if (f.flip) {
                var u = k;
                k = t;
                t = u
            }
            for (var s = 0; s < m.seriesGroups.length; s++) {
                var h = m._getXAxis(s);
                if (h == f) {
                    m._selectorRange[s] = {
                        min: k,
                        max: t
                    }
                }
            }
            m._isSelectorRefresh = true;
            var w = m.enableAnimations;
            m._raiseEvent("rangeSelectionChanging", {
                instance: m,
                minValue: k,
                maxValue: t
            });
            m.enableAnimations = false;
            m.update();
            m.enableAnimations = w;
            m._raiseEvent("rangeSelectionChanged", {
                instance: m,
                minValue: k,
                maxValue: t
            })
        },
        _onSliderMouseMove: function(t) {
            var o = t.data.self;
            var v = t.data.renderTo;
            var i = t.data.groupIndex;
            var q = o._sliders[i];
            var d = t.data.swapXY;
            if (!q) {
                return
            }
            var f = q.getRect();
            var h = q.element;
            var w = a.jqx.position(t);
            var r = h.coord();
            var p = d ? "left" : "top";
            var m = !d ? "left" : "top";
            var g = d ? "width" : "height";
            var e = !d ? "width" : "height";
            var s = !d ? "x" : "y";
            if (o._resizeState.state == "resizing") {
                t.stopImmediatePropagation();
                t.stopPropagation();
                if (o._resizeState.side == "left") {
                    var n = Math.round(w[m] - r[m]);
                    var l = f[s];
                    if (r[m] + n >= l && r[m] + n <= l + f[e]) {
                        var j = parseInt(h.css(m));
                        var c = Math.max(2, (d ? h.height() : h.width()) - n);
                        h.css(e, c);
                        h.css(m, j + n)
                    }
                } else {
                    if (o._resizeState.side == "right") {
                        var b = d ? h.height() : h.width();
                        var n = Math.round(w[m] - r[m] - b);
                        var l = f[s];
                        if (r[m] + b + n >= l && r[m] + n + b <= l + f[e]) {
                            var c = Math.max(2, b + n);
                            h.css(e, c)
                        }
                    } else {
                        if (o._resizeState.side == "move") {
                            var b = d ? h.height() : h.width();
                            var j = parseInt(h.css(m));
                            var n = Math.round(w[m] - o._resizeState.startPos);
                            if (r[m] + n >= f[s] && r[m] + n + b <= f[s] + f[e]) {
                                o._resizeState.startPos = w[m];
                                h.css(m, j + n)
                            }
                        }
                    }
                }
                var u = parseInt(h.css(m)) - q.rect[s];
                var k = u + (d ? h.height() : h.width());
                o._setSliderPositions(i, u, k)
            } else {
                o._testAndSetReadyResize(t)
            }
        },
        _testAndSetReadyResize: function(b) {
            var q = b.data.self;
            var k = b.data.renderTo;
            var o = b.data.groupIndex;
            var c = q._sliders[o];
            var g = b.data.swapXY;
            var m = c.getRect();
            var e = c.element;
            var f = a.jqx.position(b);
            var h = e.coord();
            var j = g ? "left" : "top";
            var p = !g ? "left" : "top";
            var i = g ? "width" : "height";
            var l = !g ? "width" : "height";
            var d = !g ? "x" : "y";
            var n = q._isTouchDevice ? 30 : 5;
            if (f[j] >= h[j] && f[j] <= h[j] + m[i]) {
                if (Math.abs(f[p] - h[p]) <= n) {
                    k.css("cursor", g ? "row-resize" : "col-resize");
                    q._resizeState = {
                        state: "ready",
                        side: "left"
                    }
                } else {
                    if (Math.abs(f[p] - h[p] - (!g ? e.width() : e.height())) <= n) {
                        k.css("cursor", g ? "row-resize" : "col-resize");
                        q._resizeState = {
                            state: "ready",
                            side: "right"
                        }
                    } else {
                        if (f[p] + n > h[p] && f[p] - n < h[p] + (!g ? e.width() : e.height())) {
                            k.css("cursor", "pointer");
                            q._resizeState = {
                                state: "ready",
                                side: "move",
                                startPos: f[p]
                            }
                        } else {
                            k.css("cursor", "default");
                            q._resizeState = {}
                        }
                    }
                }
            } else {
                k.css("cursor", "default");
                q._resizeState = {}
            }
        },
        _selectorGetSize: function(b) {
            if (b.rangeSelector.renderTo) {
                return 0
            }
            return b.rangeSelector.size || this._paddedRect.height / 3
        }
    })
})(jqxBaseFramework);

(function(a) {
    a.extend(a.jqx._jqxChart.prototype, {
        _moduleAnnotations: true,
        _renderAnnotation: function(f, g, c) {
            var j = this.seriesGroups[f];
            var q = this.renderer;
            if (isNaN(f)) {
                return
            }
            var l = this._get([this.getXAxisDataPointOffset(g.xValue, f), g.x]);
            var k = this._get([this.getValueAxisDataPointOffset(g.yValue, f), g.y]);
            var v = this._get([this.getXAxisDataPointOffset(g.xValue2, f), g.x2]);
            var e = this._get([this.getValueAxisDataPointOffset(g.yValue2, f), g.y2]);
            if (j.polar || j.spider) {
                var r = this.getPolarDataPointOffset(g.xValue, g.yValue, f);
                if (r && !isNaN(r.x) && !isNaN(r.y)) {
                    l = r.x;
                    k = r.y
                } else {
                    l = g.x;
                    k = g.y
                }
            }
            if (isNaN(k) || isNaN(l)) {
                return false
            }
            if (j.orientation == "horizontal") {
                var w = l;
                l = k;
                k = w;
                w = v;
                v = e;
                e = w
            }
            if (g.offset) {
                if (!isNaN(g.offset.x)) {
                    l += g.offset.x;
                    v += g.offset.x
                }
                if (!isNaN(g.offset.y)) {
                    k += g.offset.y;
                    e += g.offset.y
                }
            }
            var p = this._get([g.width, v - l]);
            var o = this._get([g.height, e - k]);
            var d;
            switch (g.type) {
                case "rect":
                    d = q.rect(l, k, p, o);
                    break;
                case "circle":
                    d = q.rect(l, k, g.radius);
                    break;
                case "line":
                    d = q.rect(l, k, v, e);
                    break;
                case "path":
                    d = q.path(g.path);
                    break
            }
            q.attr(d, {
                fill: g.fillColor,
                stroke: g.lineColor,
                opacity: this._get([g.fillOpacity, g.opacity]),
                "stroke-opacity": this._get([g.lineOpacity, g.opacity]),
                "stroke-width": 0,
                "stroke-dasharray": g.dashStyle || "none",
            });
            var u;
            if (g.text) {
                var m = g.text;
                var z = 0,
                    h = 0;
                if (m.offset) {
                    if (!isNaN(m.offset.x)) {
                        z += m.offset.x
                    }
                    if (!isNaN(m.offset.y)) {
                        h += m.offset.y
                    }
                }
                u = q.text(m.value, l + z, k + h, NaN, NaN, m.angle, {}, m.clip === true, m.horizontalAlignment || "center", m.verticalAlignment || "center", m.rotationPoint || "centermiddle");
                q.attr(u, {
                    fill: m.fillColor,
                    stroke: m.lineColor,
                    "class": m["class"]
                })
            }
            var b = ["click", "mouseenter", "mouseleave"];
            var n = this;
            for (var t = 0; t < b.length; t++) {
                var s = this._getEvent(b[t]) || b[t];
                if (d) {
                    this.renderer.addHandler(d, s, function() {
                        n._raiseAnnotationEvent(g, s)
                    })
                }
                if (u) {
                    this.renderer.addHandler(u, s, function() {
                        n._raiseAnnotationEvent(g, s)
                    })
                }
            }
        },
        _raiseAnnotationEvent: function(b, c) {
            this._raiseEvent("annotation_" + c, {
                annotation: b
            })
        }
    })
})(jqxBaseFramework);

(function(a) {
    a.extend(a.jqx._jqxChart.prototype, {
        _moduleWaterfall: true,
        _isSummary: function(e, c) {
            var f = this.seriesGroups[e];
            for (var d = 0; d < f.series.length; d++) {
                if (undefined === f.series[d].summary) {
                    continue
                }
                var b = this._getDataValue(c, f.series[d].summary, e);
                if (undefined !== b) {
                    return true
                }
            }
            return false
        },
        _applyWaterfall: function(x, z, g, f, A, h, C, e, p) {
            var o = this.seriesGroups[g];
            if (x.length == 0) {
                return x
            }
            var t = f;
            var b = {};
            var c = [];
            var d = undefined;
            var D = [];
            for (var v = 0; v < o.series.length; v++) {
                D.push(this._isSerieVisible(g, v))
            }
            var r = {};
            for (var w = 0; w < z; w++) {
                var m = f;
                var n = 0;
                var l = this._isSummary(g, w);
                for (var v = 0; v < x.length; v++) {
                    if (!D[v]) {
                        continue
                    }
                    var B = 0;
                    if (l) {
                        B = m == f ? A : 0;
                        x[v][w].value = b[v];
                        x[v][w].summary = true;
                        d = x[v][w].value < B;
                        if (e) {
                            d = !d
                        }
                        var s = 0;
                        if (!isNaN(h)) {
                            s = this._getDataPointOffsetDiff(x[v][w].value + n, n == 0 ? A : n, B || A, h, C, f, e)
                        } else {
                            s = this._getDataPointOffsetDiff(x[v][w].value, B, B, NaN, C, f, e)
                        }
                        x[v][w].to = m + (d ? s : -s);
                        x[v][w].from = m;
                        if (p) {
                            n += x[v][w].value;
                            m = x[v][w].to
                        }
                        continue
                    }
                    var u = p ? -1 : v;
                    if (isNaN(x[v][w].value)) {
                        continue
                    }
                    if (undefined === r[u]) {
                        B = A;
                        r[u] = true
                    }
                    d = x[v][w].value < B;
                    if (e) {
                        d = !d
                    }
                    var q = NaN,
                        s = NaN;
                    if (!p) {
                        q = w == 0 ? f : x[v][c[v]].to
                    } else {
                        q = t
                    }
                    var s = 0;
                    if (!isNaN(h)) {
                        s = this._getDataPointOffsetDiff(x[v][w].value + (isNaN(b[u]) ? 0 : b[u]), isNaN(b[u]) ? A : b[u], B || A, h, C, q, e)
                    } else {
                        s = this._getDataPointOffsetDiff(x[v][w].value, B, B, NaN, C, f, e)
                    }
                    x[v][w].to = t = q + (d ? s : -s);
                    x[v][w].from = q;
                    if (isNaN(b[u])) {
                        b[u] = x[v][w].value
                    } else {
                        b[u] += x[v][w].value
                    }
                    if (u == -1) {
                        if (isNaN(b[v])) {
                            b[v] = x[v][w].value
                        } else {
                            b[v] += x[v][w].value
                        }
                    }
                    if (!p) {
                        c[v] = w
                    }
                }
            }
            return x
        }
    })
})(jqxBaseFramework);