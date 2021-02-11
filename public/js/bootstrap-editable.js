! function(t) {
    "use strict";
    var e = function(e, i) { this.options = t.extend({}, t.fn.editableform.defaults, i), this.$div = t(e), this.options.scope || (this.options.scope = this) };
    e.prototype = {
        constructor: e,
        initInput: function() { this.input = this.options.input, this.value = this.input.str2value(this.options.value), this.input.prerender() },
        initTemplate: function() { this.$form = t(t.fn.editableform.template) },
        initButtons: function() {
            var e = this.$form.find(".editable-buttons");
            e.append(t.fn.editableform.buttons), "bottom" === this.options.showbuttons && e.addClass("editable-buttons-bottom")
        },
        render: function() {
            this.$loading = t(t.fn.editableform.loading), this.$div.empty().append(this.$loading), this.initTemplate(), this.options.showbuttons ? this.initButtons() : this.$form.find(".editable-buttons").remove(), this.showLoading(), this.isSaving = !1, this.$div.triggerHandler("rendering"), this.initInput(), this.$form.find("div.editable-input").append(this.input.$tpl), this.$div.append(this.$form), t.when(this.input.render()).then(t.proxy(function() {
                if (this.options.showbuttons || this.input.autosubmit(), this.$form.find(".editable-cancel").click(t.proxy(this.cancel, this)), this.input.error) this.error(this.input.error), this.$form.find(".editable-submit").attr("disabled", !0), this.input.$input.attr("disabled", !0), this.$form.submit(function(t) { t.preventDefault() });
                else {
                    this.error(!1), this.input.$input.removeAttr("disabled"), this.$form.find(".editable-submit").removeAttr("disabled");
                    var e = null === this.value || void 0 === this.value || "" === this.value ? this.options.defaultValue : this.value;
                    this.input.value2input(e), this.$form.submit(t.proxy(this.submit, this))
                }
                this.$div.triggerHandler("rendered"), this.showForm(), this.input.postrender && this.input.postrender()
            }, this))
        },
        cancel: function() { this.$div.triggerHandler("cancel") },
        showLoading: function() {
            var t, e;
            this.$form ? (t = this.$form.outerWidth(), e = this.$form.outerHeight(), t && this.$loading.width(t), e && this.$loading.height(e), this.$form.hide()) : (t = this.$loading.parent().width()) && this.$loading.width(t), this.$loading.show()
        },
        showForm: function(t) { this.$loading.hide(), this.$form.show(), !1 !== t && this.input.activate(), this.$div.triggerHandler("show") },
        error: function(e) {
            var i, s = this.$form.find(".control-group"),
                n = this.$form.find(".editable-error-block");
            if (!1 === e) s.removeClass(t.fn.editableform.errorGroupClass), n.removeClass(t.fn.editableform.errorBlockClass).empty().hide();
            else {
                if (e) {
                    i = ("" + e).split("\n");
                    for (var a = 0; a < i.length; a++) i[a] = t("<div>").text(i[a]).html();
                    e = i.join("<br>")
                }
                s.addClass(t.fn.editableform.errorGroupClass), n.addClass(t.fn.editableform.errorBlockClass).html(e).show()
            }
        },
        submit: function(e) {
            e.stopPropagation(), e.preventDefault();
            var i = this.input.input2value(),
                s = this.validate(i);
            if ("object" === t.type(s) && void 0 !== s.newValue) { if (i = s.newValue, this.input.value2input(i), "string" == typeof s.msg) return this.error(s.msg), void this.showForm() } else if (s) return this.error(s), void this.showForm();
            if (this.options.savenochange || this.input.value2str(i) != this.input.value2str(this.value)) {
                var n = this.input.value2submit(i);
                this.isSaving = !0, t.when(this.save(n)).done(t.proxy(function(t) { this.isSaving = !1; var e = "function" == typeof this.options.success ? this.options.success.call(this.options.scope, t, i) : null; return !1 === e ? (this.error(!1), void this.showForm(!1)) : "string" == typeof e ? (this.error(e), void this.showForm()) : (e && "object" == typeof e && e.hasOwnProperty("newValue") && (i = e.newValue), this.error(!1), this.value = i, void this.$div.triggerHandler("save", { newValue: i, submitValue: n, response: t })) }, this)).fail(t.proxy(function(t) {
                    var e;
                    this.isSaving = !1, e = "function" == typeof this.options.error ? this.options.error.call(this.options.scope, t, i) : "string" == typeof t ? t : t.responseText || t.statusText || "Unknown error!", this.error(e), this.showForm()
                }, this))
            } else this.$div.triggerHandler("nochange")
        },
        save: function(e) { this.options.pk = t.fn.editableutils.tryParseJson(this.options.pk, !0); var i, s = "function" == typeof this.options.pk ? this.options.pk.call(this.options.scope) : this.options.pk; if (!!("function" == typeof this.options.url || this.options.url && ("always" === this.options.send || "auto" === this.options.send && null !== s && void 0 !== s))) return this.showLoading(), i = { name: this.options.name || "", value: e, pk: s }, "function" == typeof this.options.params ? i = this.options.params.call(this.options.scope, i) : (this.options.params = t.fn.editableutils.tryParseJson(this.options.params, !0), t.extend(i, this.options.params)), "function" == typeof this.options.url ? this.options.url.call(this.options.scope, i) : t.ajax(t.extend({ url: this.options.url, data: i, type: "POST" }, this.options.ajaxOptions)) },
        validate: function(t) { if (void 0 === t && (t = this.value), "function" == typeof this.options.validate) return this.options.validate.call(this.options.scope, t) },
        option: function(t, e) { t in this.options && (this.options[t] = e), "value" === t && this.setValue(e) },
        setValue: function(t, e) { this.value = e ? this.input.str2value(t) : t, this.$form && this.$form.is(":visible") && this.input.value2input(this.value) }
    }, t.fn.editableform = function(i) {
        var s = arguments;
        return this.each(function() {
            var n = t(this),
                a = n.data("editableform"),
                o = "object" == typeof i && i;
            a || n.data("editableform", a = new e(this, o)), "string" == typeof i && a[i].apply(a, Array.prototype.slice.call(s, 1))
        })
    }, t.fn.editableform.Constructor = e, t.fn.editableform.defaults = { type: "text", url: null, params: null, name: null, pk: null, value: null, defaultValue: null, send: "auto", validate: null, success: null, error: null, ajaxOptions: null, showbuttons: !0, scope: null, savenochange: !1 }, t.fn.editableform.template = '<form class="form-inline editableform"><div class="control-group"><div><div class="editable-input"></div><div class="editable-buttons"></div></div><div class="editable-error-block"></div></div></form>', t.fn.editableform.loading = '<div class="editableform-loading"></div>', t.fn.editableform.buttons = '<button type="submit" class="editable-submit">ok</button><button type="button" class="editable-cancel">cancel</button>', t.fn.editableform.errorGroupClass = null, t.fn.editableform.errorBlockClass = "editable-error", t.fn.editableform.engine = "jquery"
}(window.jQuery),
function(t) {
    "use strict";
    t.fn.editableutils = {
        inherit: function(t, e) {
            var i = function() {};
            i.prototype = e.prototype, t.prototype = new i, t.prototype.constructor = t, t.superclass = e.prototype
        },
        setCursorPosition: function(t, e) {
            if (t.setSelectionRange) t.setSelectionRange(e, e);
            else if (t.createTextRange) {
                var i = t.createTextRange();
                i.collapse(!0), i.moveEnd("character", e), i.moveStart("character", e), i.select()
            }
        },
        tryParseJson: function(t, e) {
            if ("string" == typeof t && t.length && t.match(/^[\{\[].*[\}\]]$/))
                if (e) try { t = new Function("return " + t)() } catch (t) {} finally { return t } else t = new Function("return " + t)();
            return t
        },
        sliceObj: function(e, i, s) { var n, a, o = {}; if (!t.isArray(i) || !i.length) return o; for (var r = 0; r < i.length; r++) n = i[r], e.hasOwnProperty(n) && (o[n] = e[n]), !0 !== s && (a = n.toLowerCase(), e.hasOwnProperty(a) && (o[n] = e[a])); return o },
        getConfigData: function(e) {
            var i = {};
            return t.each(e.data(), function(t, e) {
                ("object" != typeof e || e && "object" == typeof e && (e.constructor === Object || e.constructor === Array)) && (i[t] = e)
            }), i
        },
        objectKeys: function(t) { if (Object.keys) return Object.keys(t); if (t !== Object(t)) throw new TypeError("Object.keys called on a non-object"); var e, i = []; for (e in t) Object.prototype.hasOwnProperty.call(t, e) && i.push(e); return i },
        escape: function(e) { return t("<div>").text(e).html() },
        itemsByValue: function(e, i, s) {
            if (!i || null === e) return [];
            if ("function" != typeof s) {
                var n = s || "value";
                s = function(t) { return t[n] }
            }
            var a = t.isArray(e),
                o = [],
                r = this;
            return t.each(i, function(i, n) {
                if (n.children) o = o.concat(r.itemsByValue(e, n.children, s));
                else if (a) t.grep(e, function(t) { return t == (n && "object" == typeof n ? s(n) : n) }).length && o.push(n);
                else {
                    var l = n && "object" == typeof n ? s(n) : n;
                    e == l && o.push(n)
                }
            }), o
        },
        createInput: function(e) { var i, s = e.type; return "date" === s && ("inline" === e.mode ? t.fn.editabletypes.datefield ? s = "datefield" : t.fn.editabletypes.dateuifield && (s = "dateuifield") : t.fn.editabletypes.date ? s = "date" : t.fn.editabletypes.dateui && (s = "dateui"), "date" !== s || t.fn.editabletypes.date || (s = "combodate")), "datetime" === s && "inline" === e.mode && (s = "datetimefield"), "wysihtml5" !== s || t.fn.editabletypes[s] || (s = "textarea"), "function" == typeof t.fn.editabletypes[s] ? new(i = t.fn.editabletypes[s])(this.sliceObj(e, this.objectKeys(i.defaults))) : (t.error("Unknown type: " + s), !1) },
        supportsTransitions: function() {
            var t = (document.body || document.documentElement).style,
                e = "transition",
                i = ["Moz", "Webkit", "Khtml", "O", "ms"];
            if ("string" == typeof t[e]) return !0;
            e = e.charAt(0).toUpperCase() + e.substr(1);
            for (var s = 0; s < i.length; s++)
                if ("string" == typeof t[i[s] + e]) return !0;
            return !1
        }
    }
}(window.jQuery),
function(t) {
    "use strict";
    var e = function(t, e) { this.init(t, e) },
        i = function(t, e) { this.init(t, e) };
    e.prototype = {
        containerName: null,
        containerDataName: null,
        innerCss: null,
        containerClass: "editable-container editable-popup",
        defaults: {},
        init: function(i, s) {
            this.$element = t(i), this.options = t.extend({}, t.fn.editableContainer.defaults, s), this.splitOptions(), this.formOptions.scope = this.$element[0], this.initContainer(), this.delayedHide = !1, this.$element.on("destroyed", t.proxy(function() { this.destroy() }, this)), t(document).data("editable-handlers-attached") || (t(document).on("keyup.editable", function(e) { 27 === e.which && t(".editable-open").editableContainer("hide") }), t(document).on("click.editable", function(i) {
                var s, n = t(i.target),
                    a = [".editable-container", ".ui-datepicker-header", ".datepicker", ".modal-backdrop", ".bootstrap-wysihtml5-insert-image-modal", ".bootstrap-wysihtml5-insert-link-modal"];
                if (t.contains(document.documentElement, i.target) && !n.is(document)) {
                    for (s = 0; s < a.length; s++)
                        if (n.is(a[s]) || n.parents(a[s]).length) return;
                    e.prototype.closeOthers(i.target)
                }
            }), t(document).data("editable-handlers-attached", !0))
        },
        splitOptions: function() { if (this.containerOptions = {}, this.formOptions = {}, !t.fn[this.containerName]) throw new Error(this.containerName + " not found. Have you included corresponding js file?"); for (var e in this.options) e in this.defaults ? this.containerOptions[e] = this.options[e] : this.formOptions[e] = this.options[e] },
        tip: function() { return this.container() ? this.container().$tip : null },
        container: function() { var t; return this.containerDataName && (t = this.$element.data(this.containerDataName)) ? t : t = this.$element.data(this.containerName) },
        call: function() { this.$element[this.containerName].apply(this.$element, arguments) },
        initContainer: function() { this.call(this.containerOptions) },
        renderForm: function() { this.$form.editableform(this.formOptions).on({ save: t.proxy(this.save, this), nochange: t.proxy(function() { this.hide("nochange") }, this), cancel: t.proxy(function() { this.hide("cancel") }, this), show: t.proxy(function() { this.delayedHide ? (this.hide(this.delayedHide.reason), this.delayedHide = !1) : this.setPosition() }, this), rendering: t.proxy(this.setPosition, this), resize: t.proxy(this.setPosition, this), rendered: t.proxy(function() { this.$element.triggerHandler("shown", t(this.options.scope).data("editable")) }, this) }).editableform("render") },
        show: function(e) { this.$element.addClass("editable-open"), !1 !== e && this.closeOthers(this.$element[0]), this.innerShow(), this.tip().addClass(this.containerClass), this.$form, this.$form = t("<div>"), this.tip().is(this.innerCss) ? this.tip().append(this.$form) : this.tip().find(this.innerCss).append(this.$form), this.renderForm() },
        hide: function(t) { this.tip() && this.tip().is(":visible") && this.$element.hasClass("editable-open") && (this.$form.data("editableform").isSaving ? this.delayedHide = { reason: t } : (this.delayedHide = !1, this.$element.removeClass("editable-open"), this.innerHide(), this.$element.triggerHandler("hidden", t || "manual"))) },
        innerShow: function() {},
        innerHide: function() {},
        toggle: function(t) { this.container() && this.tip() && this.tip().is(":visible") ? this.hide() : this.show(t) },
        setPosition: function() {},
        save: function(t, e) { this.$element.triggerHandler("save", e), this.hide("save") },
        option: function(t, e) { this.options[t] = e, t in this.containerOptions ? (this.containerOptions[t] = e, this.setContainerOption(t, e)) : (this.formOptions[t] = e, this.$form && this.$form.editableform("option", t, e)) },
        setContainerOption: function(t, e) { this.call("option", t, e) },
        destroy: function() { this.hide(), this.innerDestroy(), this.$element.off("destroyed"), this.$element.removeData("editableContainer") },
        innerDestroy: function() {},
        closeOthers: function(e) {
            t(".editable-open").each(function(i, s) {
                if (s !== e && !t(s).find(e).length) {
                    var n = t(s),
                        a = n.data("editableContainer");
                    a && ("cancel" === a.options.onblur ? n.data("editableContainer").hide("onblur") : "submit" === a.options.onblur && n.data("editableContainer").tip().find("form").submit())
                }
            })
        },
        activate: function() { this.tip && this.tip().is(":visible") && this.$form && this.$form.data("editableform").input.activate() }
    }, t.fn.editableContainer = function(s) {
        var n = arguments;
        return this.each(function() {
            var a = t(this),
                o = "editableContainer",
                r = a.data(o),
                l = "object" == typeof s && s,
                h = "inline" === l.mode ? i : e;
            r || a.data(o, r = new h(this, l)), "string" == typeof s && r[s].apply(r, Array.prototype.slice.call(n, 1))
        })
    }, t.fn.editableContainer.Popup = e, t.fn.editableContainer.Inline = i, t.fn.editableContainer.defaults = { value: null, placement: "top", autohide: !0, onblur: "cancel", anim: !1, mode: "popup" }, jQuery.event.special.destroyed = { remove: function(t) { t.handler && t.handler() } }
}(window.jQuery),
function(t) {
    "use strict";
    t.extend(t.fn.editableContainer.Inline.prototype, t.fn.editableContainer.Popup.prototype, { containerName: "editableform", innerCss: ".editable-inline", containerClass: "editable-container editable-inline", initContainer: function() { this.$tip = t("<span></span>"), this.options.anim || (this.options.anim = 0) }, splitOptions: function() { this.containerOptions = {}, this.formOptions = this.options }, tip: function() { return this.$tip }, innerShow: function() { this.$element.hide(), this.tip().insertAfter(this.$element).show() }, innerHide: function() { this.$tip.hide(this.options.anim, t.proxy(function() { this.$element.show(), this.innerDestroy() }, this)) }, innerDestroy: function() { this.tip() && this.tip().empty().remove() } })
}(window.jQuery),
function(t) {
    "use strict";
    var e = function(e, i) { this.$element = t(e), this.options = t.extend({}, t.fn.editable.defaults, i, t.fn.editableutils.getConfigData(this.$element)), this.options.selector ? this.initLive() : this.init(), this.options.highlight && !t.fn.editableutils.supportsTransitions() && (this.options.highlight = !1) };
    e.prototype = {
        constructor: e,
        init: function() {
            var e, i = !1;
            if (this.options.name = this.options.name || this.$element.attr("id"), this.options.scope = this.$element[0], this.input = t.fn.editableutils.createInput(this.options), this.input) {
                switch (void 0 === this.options.value || null === this.options.value ? (this.value = this.input.html2value(t.trim(this.$element.html())), i = !0) : (this.options.value = t.fn.editableutils.tryParseJson(this.options.value, !0), "string" == typeof this.options.value ? this.value = this.input.str2value(this.options.value) : this.value = this.options.value), this.$element.addClass("editable"), "textarea" === this.input.type && this.$element.addClass("editable-pre-wrapped"), "manual" !== this.options.toggle ? (this.$element.addClass("editable-click"), this.$element.on(this.options.toggle + ".editable", t.proxy(function(t) {
                    if (this.options.disabled || t.preventDefault(), "mouseenter" === this.options.toggle) this.show();
                    else {
                        var e = "click" !== this.options.toggle;
                        this.toggle(e)
                    }
                }, this))) : this.$element.attr("tabindex", -1), "function" == typeof this.options.display && (this.options.autotext = "always"), this.options.autotext) {
                    case "always":
                        e = !0;
                        break;
                    case "auto":
                        e = !t.trim(this.$element.text()).length && null !== this.value && void 0 !== this.value && !i;
                        break;
                    default:
                        e = !1
                }
                t.when(!e || this.render()).then(t.proxy(function() { this.options.disabled ? this.disable() : this.enable(), this.$element.triggerHandler("init", this) }, this))
            }
        },
        initLive: function() {
            var e = this.options.selector;
            this.options.selector = !1, this.options.autotext = "never", this.$element.on(this.options.toggle + ".editable", e, t.proxy(function(e) {
                var i = t(e.target);
                i.data("editable") || (i.hasClass(this.options.emptyclass) && i.empty(), i.editable(this.options).trigger(e))
            }, this))
        },
        render: function(t) { if (!1 !== this.options.display) return this.input.value2htmlFinal ? this.input.value2html(this.value, this.$element[0], this.options.display, t) : "function" == typeof this.options.display ? this.options.display.call(this.$element[0], this.value, t) : this.input.value2html(this.value, this.$element[0]) },
        enable: function() { this.options.disabled = !1, this.$element.removeClass("editable-disabled"), this.handleEmpty(this.isEmpty), "manual" !== this.options.toggle && "-1" === this.$element.attr("tabindex") && this.$element.removeAttr("tabindex") },
        disable: function() { this.options.disabled = !0, this.hide(), this.$element.addClass("editable-disabled"), this.handleEmpty(this.isEmpty), this.$element.attr("tabindex", -1) },
        toggleDisabled: function() { this.options.disabled ? this.enable() : this.disable() },
        option: function(e, i) {
            if (e && "object" == typeof e) t.each(e, t.proxy(function(e, i) { this.option(t.trim(e), i) }, this));
            else { if (this.options[e] = i, "disabled" === e) return i ? this.disable() : this.enable(); "value" === e && this.setValue(i), this.container && this.container.option(e, i), this.input.option && this.input.option(e, i) }
        },
        handleEmpty: function(e) {!1 !== this.options.display && (void 0 !== e ? this.isEmpty = e : "function" == typeof this.input.isEmpty ? this.isEmpty = this.input.isEmpty(this.$element) : this.isEmpty = "" === t.trim(this.$element.html()), this.options.disabled ? this.isEmpty && (this.$element.empty(), this.options.emptyclass && this.$element.removeClass(this.options.emptyclass)) : this.isEmpty ? (this.$element.html(this.options.emptytext), this.options.emptyclass && this.$element.addClass(this.options.emptyclass)) : this.options.emptyclass && this.$element.removeClass(this.options.emptyclass)) },
        show: function(e) {
            if (!this.options.disabled) {
                if (this.container) { if (this.container.tip().is(":visible")) return } else {
                    var i = t.extend({}, this.options, { value: this.value, input: this.input });
                    this.$element.editableContainer(i), this.$element.on("save.internal", t.proxy(this.save, this)), this.container = this.$element.data("editableContainer")
                }
                this.container.show(e)
            }
        },
        hide: function() { this.container && this.container.hide() },
        toggle: function(t) { this.container && this.container.tip().is(":visible") ? this.hide() : this.show(t) },
        save: function(t, e) {
            if (this.options.unsavedclass) {
                var i = !1;
                (i = (i = (i = (i = i || "function" == typeof this.options.url) || !1 === this.options.display) || void 0 !== e.response) || this.options.savenochange && this.input.value2str(this.value) !== this.input.value2str(e.newValue)) ? this.$element.removeClass(this.options.unsavedclass): this.$element.addClass(this.options.unsavedclass)
            }
            if (this.options.highlight) {
                var s = this.$element,
                    n = s.css("background-color");
                s.css("background-color", this.options.highlight), setTimeout(function() { "transparent" === n && (n = ""), s.css("background-color", n), s.addClass("editable-bg-transition"), setTimeout(function() { s.removeClass("editable-bg-transition") }, 1700) }, 10)
            }
            this.setValue(e.newValue, !1, e.response)
        },
        validate: function() { if ("function" == typeof this.options.validate) return this.options.validate.call(this, this.value) },
        setValue: function(e, i, s) { this.value = i ? this.input.str2value(e) : e, this.container && this.container.option("value", this.value), t.when(this.render(s)).then(t.proxy(function() { this.handleEmpty() }, this)) },
        activate: function() { this.container && this.container.activate() },
        destroy: function() { this.disable(), this.container && this.container.destroy(), this.input.destroy(), "manual" !== this.options.toggle && (this.$element.removeClass("editable-click"), this.$element.off(this.options.toggle + ".editable")), this.$element.off("save.internal"), this.$element.removeClass("editable editable-open editable-disabled"), this.$element.removeData("editable") }
    }, t.fn.editable = function(i) {
        var s = {},
            n = arguments,
            a = "editable";
        switch (i) {
            case "validate":
                return this.each(function() {
                    var e, i = t(this).data(a);
                    i && (e = i.validate()) && (s[i.options.name] = e)
                }), s;
            case "getValue":
                return 2 === arguments.length && !0 === arguments[1] ? s = this.eq(0).data(a).value : this.each(function() {
                    var e = t(this).data(a);
                    e && void 0 !== e.value && null !== e.value && (s[e.options.name] = e.input.value2submit(e.value))
                }), s;
            case "submit":
                var o = arguments[1] || {},
                    r = this,
                    l = this.editable("validate");
                if (t.isEmptyObject(l)) {
                    var h = {};
                    if (1 === r.length) {
                        var u = r.data("editable"),
                            p = { name: u.options.name || "", value: u.input.value2submit(u.value), pk: "function" == typeof u.options.pk ? u.options.pk.call(u.options.scope) : u.options.pk };
                        "function" == typeof u.options.params ? p = u.options.params.call(u.options.scope, p) : (u.options.params = t.fn.editableutils.tryParseJson(u.options.params, !0), t.extend(p, u.options.params)), h = { url: u.options.url, data: p, type: "POST" }, o.success = o.success || u.options.success, o.error = o.error || u.options.error
                    } else {
                        var d = this.editable("getValue");
                        h = { url: o.url, data: d, type: "POST" }
                    }
                    h.success = "function" == typeof o.success ? function(t) { o.success.call(r, t, o) } : t.noop, h.error = "function" == typeof o.error ? function() { o.error.apply(r, arguments) } : t.noop, o.ajaxOptions && t.extend(h, o.ajaxOptions), o.data && t.extend(h.data, o.data), t.ajax(h)
                } else "function" == typeof o.error && o.error.call(r, l);
                return this
        }
        return this.each(function() {
            var s = t(this),
                o = s.data(a),
                r = "object" == typeof i && i;
            r && r.selector ? o = new e(this, r) : (o || s.data(a, o = new e(this, r)), "string" == typeof i && o[i].apply(o, Array.prototype.slice.call(n, 1)))
        })
    }, t.fn.editable.defaults = { type: "text", disabled: !1, toggle: "click", emptytext: "Empty", autotext: "auto", value: null, display: null, emptyclass: "editable-empty", unsavedclass: "editable-unsaved", selector: null, highlight: "#FFFF80" }
}(window.jQuery),
function(t) {
    "use strict";
    t.fn.editabletypes = {};
    var e = function() {};
    e.prototype = { init: function(e, i, s) { this.type = e, this.options = t.extend({}, s, i) }, prerender: function() { this.$tpl = t(this.options.tpl), this.$input = this.$tpl, this.$clear = null, this.error = null }, render: function() {}, value2html: function(e, i) { t(i)[this.options.escape ? "text" : "html"](t.trim(e)) }, html2value: function(e) { return t("<div>").html(e).text() }, value2str: function(t) { return t }, str2value: function(t) { return t }, value2submit: function(t) { return t }, value2input: function(t) { this.$input.val(t) }, input2value: function() { return this.$input.val() }, activate: function() { this.$input.is(":visible") && this.$input.focus() }, clear: function() { this.$input.val(null) }, escape: function(e) { return t("<div>").text(e).html() }, autosubmit: function() {}, destroy: function() {}, setClass: function() { this.options.inputclass && this.$input.addClass(this.options.inputclass) }, setAttr: function(t) { void 0 !== this.options[t] && null !== this.options[t] && this.$input.attr(t, this.options[t]) }, option: function(t, e) { this.options[t] = e } }, e.defaults = { tpl: "", inputclass: null, escape: !0, scope: null, showbuttons: !0 }, t.extend(t.fn.editabletypes, { abstractinput: e })
}(window.jQuery),
function(t) {
    "use strict";
    var e = function(t) {};
    t.fn.editableutils.inherit(e, t.fn.editabletypes.abstractinput), t.extend(e.prototype, {
        render: function() { var e = t.Deferred(); return this.error = null, this.onSourceReady(function() { this.renderList(), e.resolve() }, function() { this.error = this.options.sourceError, e.resolve() }), e.promise() },
        html2value: function(t) { return null },
        value2html: function(e, i, s, n) {
            var a = t.Deferred(),
                o = function() { "function" == typeof s ? s.call(i, e, this.sourceData, n) : this.value2htmlFinal(e, i), a.resolve() };
            return null === e ? o.call(this) : this.onSourceReady(o, function() { a.resolve() }), a.promise()
        },
        onSourceReady: function(e, i) {
            var s;
            if (t.isFunction(this.options.source) ? (s = this.options.source.call(this.options.scope), this.sourceData = null) : s = this.options.source, this.options.sourceCache && t.isArray(this.sourceData)) e.call(this);
            else {
                try { s = t.fn.editableutils.tryParseJson(s, !1) } catch (t) { return void i.call(this) }
                if ("string" == typeof s) {
                    if (this.options.sourceCache) {
                        var n, a = s;
                        if (t(document).data(a) || t(document).data(a, {}), !1 === (n = t(document).data(a)).loading && n.sourceData) return this.sourceData = n.sourceData, this.doPrepend(), void e.call(this);
                        if (!0 === n.loading) return n.callbacks.push(t.proxy(function() { this.sourceData = n.sourceData, this.doPrepend(), e.call(this) }, this)), void n.err_callbacks.push(t.proxy(i, this));
                        n.loading = !0, n.callbacks = [], n.err_callbacks = []
                    }
                    var o = t.extend({ url: s, type: "get", cache: !1, dataType: "json", success: t.proxy(function(s) { n && (n.loading = !1), this.sourceData = this.makeArray(s), t.isArray(this.sourceData) ? (n && (n.sourceData = this.sourceData, t.each(n.callbacks, function() { this.call() })), this.doPrepend(), e.call(this)) : (i.call(this), n && t.each(n.err_callbacks, function() { this.call() })) }, this), error: t.proxy(function() { i.call(this), n && (n.loading = !1, t.each(n.err_callbacks, function() { this.call() })) }, this) }, this.options.sourceOptions);
                    t.ajax(o)
                } else this.sourceData = this.makeArray(s), t.isArray(this.sourceData) ? (this.doPrepend(), e.call(this)) : i.call(this)
            }
        },
        doPrepend: function() { null !== this.options.prepend && void 0 !== this.options.prepend && (t.isArray(this.prependData) || (t.isFunction(this.options.prepend) && (this.options.prepend = this.options.prepend.call(this.options.scope)), this.options.prepend = t.fn.editableutils.tryParseJson(this.options.prepend, !0), "string" == typeof this.options.prepend && (this.options.prepend = { "": this.options.prepend }), this.prependData = this.makeArray(this.options.prepend)), t.isArray(this.prependData) && t.isArray(this.sourceData) && (this.sourceData = this.prependData.concat(this.sourceData))) },
        renderList: function() {},
        value2htmlFinal: function(t, e) {},
        makeArray: function(e) { var i, s, n, a, o = []; if (!e || "string" == typeof e) return null; if (t.isArray(e)) { a = function(t, e) { if (s = { value: t, text: e }, i++ >= 2) return !1 }; for (var r = 0; r < e.length; r++) "object" == typeof(n = e[r]) ? (i = 0, t.each(n, a), 1 === i ? o.push(s) : i > 1 && (n.children && (n.children = this.makeArray(n.children)), o.push(n))) : o.push({ value: n, text: n }) } else t.each(e, function(t, e) { o.push({ value: t, text: e }) }); return o },
        option: function(t, e) { this.options[t] = e, "source" === t && (this.sourceData = null), "prepend" === t && (this.prependData = null) }
    }), e.defaults = t.extend({}, t.fn.editabletypes.abstractinput.defaults, { source: null, prepend: !1, sourceError: "Error when loading list", sourceCache: !0, sourceOptions: null }), t.fn.editabletypes.list = e
}(window.jQuery),
function(t) {
    "use strict";
    var e = function(t) { this.init("text", t, e.defaults) };
    t.fn.editableutils.inherit(e, t.fn.editabletypes.abstractinput), t.extend(e.prototype, {
        render: function() { this.renderClear(), this.setClass(), this.setAttr("placeholder") },
        activate: function() { this.$input.is(":visible") && (this.$input.focus(), t.fn.editableutils.setCursorPosition(this.$input.get(0), this.$input.val().length), this.toggleClear && this.toggleClear()) },
        renderClear: function() {
            this.options.clear && (this.$clear = t('<span class="editable-clear-x"></span>'), this.$input.after(this.$clear).css("padding-right", 24).keyup(t.proxy(function(e) {
                if (!~t.inArray(e.keyCode, [40, 38, 9, 13, 27])) {
                    clearTimeout(this.t);
                    var i = this;
                    this.t = setTimeout(function() { i.toggleClear(e) }, 100)
                }
            }, this)).parent().css("position", "relative"), this.$clear.click(t.proxy(this.clear, this)))
        },
        postrender: function() {},
        toggleClear: function(t) {
            if (this.$clear) {
                var e = this.$input.val().length,
                    i = this.$clear.is(":visible");
                e && !i && this.$clear.show(), !e && i && this.$clear.hide()
            }
        },
        clear: function() { this.$clear.hide(), this.$input.val("").focus() }
    }), e.defaults = t.extend({}, t.fn.editabletypes.abstractinput.defaults, { tpl: '<input type="text">', placeholder: null, clear: !0 }), t.fn.editabletypes.text = e
}(window.jQuery),
function(t) {
    "use strict";
    var e = function(t) { this.init("textarea", t, e.defaults) };
    t.fn.editableutils.inherit(e, t.fn.editabletypes.abstractinput), t.extend(e.prototype, { render: function() { this.setClass(), this.setAttr("placeholder"), this.setAttr("rows"), this.$input.keydown(function(e) { e.ctrlKey && 13 === e.which && t(this).closest("form").submit() }) }, activate: function() { t.fn.editabletypes.text.prototype.activate.call(this) } }), e.defaults = t.extend({}, t.fn.editabletypes.abstractinput.defaults, { tpl: "<textarea></textarea>", inputclass: "ticket-reply-textbox market-form-input form-control", placeholder: null, rows: 1 }), t.fn.editabletypes.textarea = e
}(window.jQuery),
function(t) {
    "use strict";
    var e = function(t) { this.init("select", t, e.defaults) };
    t.fn.editableutils.inherit(e, t.fn.editabletypes.list), t.extend(e.prototype, {
        renderList: function() {
            this.$input.empty();
            var e = function(i, s) {
                var n;
                if (t.isArray(s))
                    for (var a = 0; a < s.length; a++) n = {}, s[a].children ? (n.label = s[a].text, i.append(e(t("<optgroup>", n), s[a].children))) : (n.value = s[a].value, s[a].disabled && (n.disabled = !0), i.append(t("<option>", n).text(s[a].text)));
                return i
            };
            e(this.$input, this.sourceData), this.setClass(), this.$input.on("keydown.editable", function(e) { 13 === e.which && t(this).closest("form").submit() })
        },
        value2htmlFinal: function(e, i) {
            var s = "",
                n = t.fn.editableutils.itemsByValue(e, this.sourceData);
            n.length && (s = n[0].text), t.fn.editabletypes.abstractinput.prototype.value2html.call(this, s, i)
        },
        autosubmit: function() { this.$input.off("keydown.editable").on("change.editable", function() { t(this).closest("form").submit() }) }
    }), e.defaults = t.extend({}, t.fn.editabletypes.list.defaults, { tpl: "<select></select>" }), t.fn.editabletypes.select = e
}(window.jQuery),
function(t) {
    "use strict";
    var e = function(t) { this.init("checklist", t, e.defaults) };
    t.fn.editableutils.inherit(e, t.fn.editabletypes.list), t.extend(e.prototype, {
        renderList: function() {
            var e;
            if (this.$tpl.empty(), t.isArray(this.sourceData)) {
                for (var i = 0; i < this.sourceData.length; i++) e = t("<label>").append(t("<input>", { type: "checkbox", value: this.sourceData[i].value })).append(t("<span>").text(" " + this.sourceData[i].text)), t("<div>").append(e).appendTo(this.$tpl);
                this.$input = this.$tpl.find('input[type="checkbox"]'), this.setClass()
            }
        },
        value2str: function(e) { return t.isArray(e) ? e.sort().join(t.trim(this.options.separator)) : "" },
        str2value: function(e) { var i, s = null; return "string" == typeof e && e.length ? (i = new RegExp("\\s*" + t.trim(this.options.separator) + "\\s*"), s = e.split(i)) : s = t.isArray(e) ? e : [e], s },
        value2input: function(e) {
            this.$input.prop("checked", !1), t.isArray(e) && e.length && this.$input.each(function(i, s) {
                var n = t(s);
                t.each(e, function(t, e) { n.val() == e && n.prop("checked", !0) })
            })
        },
        input2value: function() { var e = []; return this.$input.filter(":checked").each(function(i, s) { e.push(t(s).val()) }), e },
        value2htmlFinal: function(e, i) {
            var s = [],
                n = t.fn.editableutils.itemsByValue(e, this.sourceData),
                a = this.options.escape;
            n.length ? (t.each(n, function(e, i) {
                var n = a ? t.fn.editableutils.escape(i.text) : i.text;
                s.push(n)
            }), t(i).html(s.join("<br>"))) : t(i).empty()
        },
        activate: function() { this.$input.first().focus() },
        autosubmit: function() { this.$input.on("keydown", function(e) { 13 === e.which && t(this).closest("form").submit() }) }
    }), e.defaults = t.extend({}, t.fn.editabletypes.list.defaults, { tpl: '<div class="editable-checklist"></div>', inputclass: null, separator: "," }), t.fn.editabletypes.checklist = e
}(window.jQuery),
function(t) {
    "use strict";
    var e = function(t) { this.init("password", t, e.defaults) };
    t.fn.editableutils.inherit(e, t.fn.editabletypes.text), t.extend(e.prototype, { value2html: function(e, i) { e ? t(i).text("[hidden]") : t(i).empty() }, html2value: function(t) { return null } }), e.defaults = t.extend({}, t.fn.editabletypes.text.defaults, { tpl: '<input type="password">' }), t.fn.editabletypes.password = e
}(window.jQuery),
function(t) {
    "use strict";
    var e = function(t) { this.init("email", t, e.defaults) };
    t.fn.editableutils.inherit(e, t.fn.editabletypes.text), e.defaults = t.extend({}, t.fn.editabletypes.text.defaults, { tpl: '<input type="email">' }), t.fn.editabletypes.email = e
}(window.jQuery),
function(t) {
    "use strict";
    var e = function(t) { this.init("url", t, e.defaults) };
    t.fn.editableutils.inherit(e, t.fn.editabletypes.text), e.defaults = t.extend({}, t.fn.editabletypes.text.defaults, { tpl: '<input type="url">' }), t.fn.editabletypes.url = e
}(window.jQuery),
function(t) {
    "use strict";
    var e = function(t) { this.init("tel", t, e.defaults) };
    t.fn.editableutils.inherit(e, t.fn.editabletypes.text), e.defaults = t.extend({}, t.fn.editabletypes.text.defaults, { tpl: '<input type="tel">' }), t.fn.editabletypes.tel = e
}(window.jQuery),
function(t) {
    "use strict";
    var e = function(t) { this.init("number", t, e.defaults) };
    t.fn.editableutils.inherit(e, t.fn.editabletypes.text), t.extend(e.prototype, { render: function() { e.superclass.render.call(this), this.setAttr("min"), this.setAttr("max"), this.setAttr("step") }, postrender: function() { this.$clear && this.$clear.css({ right: 24 }) } }), e.defaults = t.extend({}, t.fn.editabletypes.text.defaults, { tpl: '<input type="number">', inputclass: "input-mini", min: null, max: null, step: null }), t.fn.editabletypes.number = e
}(window.jQuery),
function(t) {
    "use strict";
    var e = function(t) { this.init("range", t, e.defaults) };
    t.fn.editableutils.inherit(e, t.fn.editabletypes.number), t.extend(e.prototype, { render: function() { this.$input = this.$tpl.filter("input"), this.setClass(), this.setAttr("min"), this.setAttr("max"), this.setAttr("step"), this.$input.on("input", function() { t(this).siblings("output").text(t(this).val()) }) }, activate: function() { this.$input.focus() } }), e.defaults = t.extend({}, t.fn.editabletypes.number.defaults, { tpl: '<input type="range"><output style="width: 30px; display: inline-block"></output>', inputclass: "input-medium" }), t.fn.editabletypes.range = e
}(window.jQuery),
function(t) {
    "use strict";
    var e = function(t) { this.init("time", t, e.defaults) };
    t.fn.editableutils.inherit(e, t.fn.editabletypes.abstractinput), t.extend(e.prototype, { render: function() { this.setClass() } }), e.defaults = t.extend({}, t.fn.editabletypes.abstractinput.defaults, { tpl: '<input type="time">' }), t.fn.editabletypes.time = e
}(window.jQuery),
function(t) {
    "use strict";
    var e = function(i) {
        if (this.init("select2", i, e.defaults), i.select2 = i.select2 || {}, this.sourceData = null, i.placeholder && (i.select2.placeholder = i.placeholder), !i.select2.tags && i.source) {
            var s = i.source;
            t.isFunction(i.source) && (s = i.source.call(i.scope)), "string" == typeof s ? (i.select2.ajax = i.select2.ajax || {}, i.select2.ajax.data || (i.select2.ajax.data = function(t) { return { query: t } }), i.select2.ajax.results || (i.select2.ajax.results = function(t) { return { results: t } }), i.select2.ajax.url = s) : (this.sourceData = this.convertSource(s), i.select2.data = this.sourceData)
        }
        if (this.options.select2 = t.extend({}, e.defaults.select2, i.select2), this.isMultiple = this.options.select2.tags || this.options.select2.multiple, this.isRemote = "ajax" in this.options.select2, this.idFunc = this.options.select2.id, "function" != typeof this.idFunc) {
            var n = this.idFunc || "id";
            this.idFunc = function(t) { return t[n] }
        }
        this.formatSelection = this.options.select2.formatSelection, "function" != typeof this.formatSelection && (this.formatSelection = function(t) { return t.text })
    };
    t.fn.editableutils.inherit(e, t.fn.editabletypes.abstractinput), t.extend(e.prototype, {
        render: function() { this.setClass(), this.isRemote && this.$input.on("select2-loaded", t.proxy(function(t) { this.sourceData = t.items.results }, this)), this.isMultiple && this.$input.on("change", function() { t(this).closest("form").parent().triggerHandler("resize") }) },
        value2html: function(i, s) {
            var n, a = "",
                o = this;
            this.options.select2.tags ? n = i : this.sourceData && (n = t.fn.editableutils.itemsByValue(i, this.sourceData, this.idFunc)), t.isArray(n) ? (a = [], t.each(n, function(t, e) { a.push(e && "object" == typeof e ? o.formatSelection(e) : e) })) : n && (a = o.formatSelection(n)), a = t.isArray(a) ? a.join(this.options.viewseparator) : a, e.superclass.value2html.call(this, a, s)
        },
        html2value: function(t) { return this.options.select2.tags ? this.str2value(t, this.options.viewseparator) : null },
        value2input: function(e) {
            if (t.isArray(e) && (e = e.join(this.getSeparator())), this.$input.data("select2") ? this.$input.val(e).trigger("change", !0) : (this.$input.val(e), this.$input.select2(this.options.select2)), this.isRemote && !this.isMultiple && !this.options.select2.initSelection) {
                var i = this.options.select2.id,
                    s = this.options.select2.formatSelection;
                if (!i && !s) {
                    var n = t(this.options.scope);
                    if (!n.data("editable").isEmpty) {
                        var a = { id: e, text: n.text() };
                        this.$input.select2("data", a)
                    }
                }
            }
        },
        input2value: function() { return this.$input.select2("val") },
        str2value: function(e, i) { if ("string" != typeof e || !this.isMultiple) return e; var s, n, a; if (i = i || this.getSeparator(), null === e || e.length < 1) return null; for (n = 0, a = (s = e.split(i)).length; n < a; n += 1) s[n] = t.trim(s[n]); return s },
        autosubmit: function() { this.$input.on("change", function(e, i) { i || t(this).closest("form").submit() }) },
        getSeparator: function() { return this.options.select2.separator || t.fn.select2.defaults.separator },
        convertSource: function(e) {
            if (t.isArray(e) && e.length && void 0 !== e[0].value)
                for (var i = 0; i < e.length; i++) void 0 !== e[i].value && (e[i].id = e[i].value, delete e[i].value);
            return e
        },
        destroy: function() { this.$input.data("select2") && this.$input.select2("destroy") }
    }), e.defaults = t.extend({}, t.fn.editabletypes.abstractinput.defaults, { tpl: '<input type="hidden">', select2: null, placeholder: null, source: null, viewseparator: ", " }), t.fn.editabletypes.select2 = e
}(window.jQuery),
function(t) {
    var e = function(e, i) { this.$element = t(e), this.$element.is("input") ? (this.options = t.extend({}, t.fn.combodate.defaults, i, this.$element.data()), this.init()) : t.error("Combodate should be applied to INPUT element") };
    e.prototype = {
        constructor: e,
        init: function() { this.map = { day: ["D", "date"], month: ["M", "month"], year: ["Y", "year"], hour: ["[Hh]", "hours"], minute: ["m", "minutes"], second: ["s", "seconds"], ampm: ["[Aa]", ""] }, this.$widget = t('<span class="combodate"></span>').html(this.getTemplate()), this.initCombos(), this.$widget.on("change", "select", t.proxy(function(e) { this.$element.val(this.getValue()).change(), this.options.smartDays && (t(e.target).is(".month") || t(e.target).is(".year")) && this.fillCombo("day") }, this)), this.$widget.find("select").css("width", "auto"), this.$element.hide().after(this.$widget), this.setValue(this.$element.val() || this.options.value) },
        getTemplate: function() {
            var e = this.options.template;
            return t.each(this.map, function(t, i) {
                i = i[0];
                var s = new RegExp(i + "+"),
                    n = i.length > 1 ? i.substring(1, 2) : i;
                e = e.replace(s, "{" + n + "}")
            }), e = e.replace(/ /g, "&nbsp;"), t.each(this.map, function(t, i) {
                var s = (i = i[0]).length > 1 ? i.substring(1, 2) : i;
                e = e.replace("{" + s + "}", '<select class="' + t + '"></select>')
            }), e
        },
        initCombos: function() {
            for (var t in this.map) {
                var e = this.$widget.find("." + t);
                this["$" + t] = e.length ? e : null, this.fillCombo(t)
            }
        },
        fillCombo: function(t) {
            var e = this["$" + t];
            if (e) {
                var i = this["fill" + t.charAt(0).toUpperCase() + t.slice(1)](),
                    s = e.val();
                e.empty();
                for (var n = 0; n < i.length; n++) e.append('<option value="' + i[n][0] + '">' + i[n][1] + "</option>");
                e.val(s)
            }
        },
        fillCommon: function(t) {
            var e, i = [];
            if ("name" === this.options.firstItem) {
                var s = "function" == typeof(e = moment.relativeTime || moment.langData()._relativeTime)[t] ? e[t](1, !0, t, !1) : e[t];
                s = s.split(" ").reverse()[0], i.push(["", s])
            } else "empty" === this.options.firstItem && i.push(["", ""]);
            return i
        },
        fillDay: function() {
            var t, e, i = this.fillCommon("d"),
                s = -1 !== this.options.template.indexOf("DD"),
                n = 31;
            if (this.options.smartDays && this.$month && this.$year) {
                var a = parseInt(this.$month.val(), 10),
                    o = parseInt(this.$year.val(), 10);
                isNaN(a) || isNaN(o) || (n = moment([o, a]).daysInMonth())
            }
            for (e = 1; e <= n; e++) t = s ? this.leadZero(e) : e, i.push([e, t]);
            return i
        },
        fillMonth: function() {
            var t, e, i = this.fillCommon("M"),
                s = -1 !== this.options.template.indexOf("MMMM"),
                n = -1 !== this.options.template.indexOf("MMM"),
                a = -1 !== this.options.template.indexOf("MM");
            for (e = 0; e <= 11; e++) t = s ? moment().date(1).month(e).format("MMMM") : n ? moment().date(1).month(e).format("MMM") : a ? this.leadZero(e + 1) : e + 1, i.push([e, t]);
            return i
        },
        fillYear: function() {
            var t, e, i = [],
                s = -1 !== this.options.template.indexOf("YYYY");
            for (e = this.options.maxYear; e >= this.options.minYear; e--) t = s ? e : (e + "").substring(2), i[this.options.yearDescending ? "push" : "unshift"]([e, t]);
            return i = this.fillCommon("y").concat(i)
        },
        fillHour: function() {
            var t, e, i = this.fillCommon("h"),
                s = -1 !== this.options.template.indexOf("h"),
                n = (this.options.template.indexOf("H"), -1 !== this.options.template.toLowerCase().indexOf("hh")),
                a = s ? 12 : 23;
            for (e = s ? 1 : 0; e <= a; e++) t = n ? this.leadZero(e) : e, i.push([e, t]);
            return i
        },
        fillMinute: function() {
            var t, e, i = this.fillCommon("m"),
                s = -1 !== this.options.template.indexOf("mm");
            for (e = 0; e <= 59; e += this.options.minuteStep) t = s ? this.leadZero(e) : e, i.push([e, t]);
            return i
        },
        fillSecond: function() {
            var t, e, i = this.fillCommon("s"),
                s = -1 !== this.options.template.indexOf("ss");
            for (e = 0; e <= 59; e += this.options.secondStep) t = s ? this.leadZero(e) : e, i.push([e, t]);
            return i
        },
        fillAmpm: function() {
            var t = -1 !== this.options.template.indexOf("a");
            this.options.template.indexOf("A");
            return [
                ["am", t ? "am" : "AM"],
                ["pm", t ? "pm" : "PM"]
            ]
        },
        getValue: function(e) {
            var i, s = {},
                n = this,
                a = !1;
            return t.each(this.map, function(t, e) { if ("ampm" !== t) { var i = "day" === t ? 1 : 0; return s[t] = n["$" + t] ? parseInt(n["$" + t].val(), 10) : i, isNaN(s[t]) ? (a = !0, !1) : void 0 } }), a ? "" : (this.$ampm && (12 === s.hour ? s.hour = "am" === this.$ampm.val() ? 0 : 12 : s.hour = "am" === this.$ampm.val() ? s.hour : s.hour + 12), i = moment([s.year, s.month, s.day, s.hour, s.minute, s.second]), this.highlight(i), null === (e = void 0 === e ? this.options.format : e) ? i.isValid() ? i : null : i.isValid() ? i.format(e) : "")
        },
        setValue: function(e) {
            if (e) {
                var i = "string" == typeof e ? moment(e, this.options.format) : moment(e),
                    s = this,
                    n = {};
                i.isValid() && (t.each(this.map, function(t, e) { "ampm" !== t && (n[t] = i[e[1]]()) }), this.$ampm && (n.hour >= 12 ? (n.ampm = "pm", n.hour > 12 && (n.hour -= 12)) : (n.ampm = "am", 0 === n.hour && (n.hour = 12))), t.each(n, function(t, e) { s["$" + t] && ("minute" === t && s.options.minuteStep > 1 && s.options.roundTime && (e = a(s["$" + t], e)), "second" === t && s.options.secondStep > 1 && s.options.roundTime && (e = a(s["$" + t], e)), s["$" + t].val(e)) }), this.options.smartDays && this.fillCombo("day"), this.$element.val(i.format(this.options.format)).change())
            }

            function a(e, i) { var s = {}; return e.children("option").each(function(e, n) { var a, o = t(n).attr("value"); "" !== o && (a = Math.abs(o - i), (void 0 === s.distance || a < s.distance) && (s = { value: o, distance: a })) }), s.value }
        },
        highlight: function(t) { t.isValid() ? this.options.errorClass ? this.$widget.removeClass(this.options.errorClass) : this.$widget.find("select").css("border-color", this.borderColor) : this.options.errorClass ? this.$widget.addClass(this.options.errorClass) : (this.borderColor || (this.borderColor = this.$widget.find("select").css("border-color")), this.$widget.find("select").css("border-color", "red")) },
        leadZero: function(t) { return t <= 9 ? "0" + t : t },
        destroy: function() { this.$widget.remove(), this.$element.removeData("combodate").show() }
    }, t.fn.combodate = function(i) {
        var s, n = Array.apply(null, arguments);
        return n.shift(), "getValue" === i && this.length && (s = this.eq(0).data("combodate")) ? s.getValue.apply(s, n) : this.each(function() {
            var s = t(this),
                a = s.data("combodate"),
                o = "object" == typeof i && i;
            a || s.data("combodate", a = new e(this, o)), "string" == typeof i && "function" == typeof a[i] && a[i].apply(a, n)
        })
    }, t.fn.combodate.defaults = { format: "DD-MM-YYYY HH:mm", template: "D / MMM / YYYY   H : mm", value: null, minYear: 1970, maxYear: 2015, yearDescending: !0, minuteStep: 5, secondStep: 1, firstItem: "empty", errorClass: null, roundTime: !0, smartDays: !1 }
}(window.jQuery),
function(t) {
    "use strict";
    var e = function(i) { this.init("combodate", i, e.defaults), this.options.viewformat || (this.options.viewformat = this.options.format), i.combodate = t.fn.editableutils.tryParseJson(i.combodate, !0), this.options.combodate = t.extend({}, e.defaults.combodate, i.combodate, { format: this.options.format, template: this.options.template }) };
    t.fn.editableutils.inherit(e, t.fn.editabletypes.abstractinput), t.extend(e.prototype, {
        render: function() { this.$input.combodate(this.options.combodate), "bs3" === t.fn.editableform.engine && this.$input.siblings().find("select").addClass("form-control"), this.options.inputclass && this.$input.siblings().find("select").addClass(this.options.inputclass) },
        value2html: function(t, i) {
            var s = t ? t.format(this.options.viewformat) : "";
            e.superclass.value2html.call(this, s, i)
        },
        html2value: function(t) { return t ? moment(t, this.options.viewformat) : null },
        value2str: function(t) { return t ? t.format(this.options.format) : "" },
        str2value: function(t) { return t ? moment(t, this.options.format) : null },
        value2submit: function(t) { return this.value2str(t) },
        value2input: function(t) { this.$input.combodate("setValue", t) },
        input2value: function() { return this.$input.combodate("getValue", null) },
        activate: function() { this.$input.siblings(".combodate").find("select").eq(0).focus() },
        autosubmit: function() {}
    }), e.defaults = t.extend({}, t.fn.editabletypes.abstractinput.defaults, { tpl: '<input type="text">', inputclass: null, format: "YYYY-MM-DD", viewformat: null, template: "D / MMM / YYYY", combodate: null }), t.fn.editabletypes.combodate = e
}(window.jQuery),
function(t) {
    "use strict";
    var e = t.fn.editableform.Constructor.prototype.initInput;
    t.extend(t.fn.editableform.Constructor.prototype, {
        initTemplate: function() { this.$form = t(t.fn.editableform.template), this.$form.find(".control-group").addClass("form-group"), this.$form.find(".editable-error-block").addClass("help-block") },
        initInput: function() {
            e.apply(this);
            var i = null === this.input.options.inputclass || !1 === this.input.options.inputclass,
                s = "input-sm",
                n = "text,select,textarea,password,email,url,tel,number,range,time,typeaheadjs".split(",");
            ~t.inArray(this.input.type, n) && (this.input.$input.addClass("form-control"), i && (this.input.options.inputclass = s, this.input.$input.addClass(s)));
            for (var a = this.$form.find(".editable-buttons"), o = i ? [s] : this.input.options.inputclass.split(" "), r = 0; r < o.length; r++) "input-lg" === o[r].toLowerCase() && a.find("button").removeClass("btn-sm").addClass("btn-lg")
        }
    }), t.fn.editableform.buttons = '<button type="submit" class="btn btn-success btn-sm editable-submit"><i class="fa fa-check"></i></button><button style="margin-left: 8px;" type="button" class="btn btn-danger btn-inverse btn-sm editable-cancel"><i class="fa fa-close"></i></button>', t.fn.editableform.errorGroupClass = "has-error", t.fn.editableform.errorBlockClass = null, t.fn.editableform.engine = "bs3"
}(window.jQuery),
function(t) {
    "use strict";
    t.extend(t.fn.editableContainer.Popup.prototype, {
        containerName: "popover",
        containerDataName: ".bs.popover",
        innerCss: ".popover-content",
        defaults: t.fn.popover.Constructor.DEFAULTS,
        initContainer: function() {
            var e;
            t.extend(this.containerOptions, { trigger: "manual", selector: !1, content: " ", template: this.defaults.template }), this.$element.data("template") && (e = this.$element.data("template"), this.$element.removeData("template")), this.call(this.containerOptions), e && this.$element.data("template", e)
        },
        innerShow: function() { this.call("show") },
        innerHide: function() { this.call("hide") },
        innerDestroy: function() { this.call("destroy") },
        setContainerOption: function(t, e) { this.container().options[t] = e },
        setPosition: function() {
            (function() {
                var t = this.tip(),
                    e = "function" == typeof this.options.placement ? this.options.placement.call(this, t[0], this.$element[0]) : this.options.placement,
                    i = /\s?auto?\s?/i,
                    s = i.test(e);
                s && (e = e.replace(i, "") || "top");
                var n = this.getPosition(),
                    a = t[0].offsetWidth,
                    o = t[0].offsetHeight;
                if (s) {
                    var r = this.$element.parent(),
                        l = e,
                        h = document.documentElement.scrollTop || document.body.scrollTop,
                        u = "body" == this.options.container ? window.innerWidth : r.outerWidth(),
                        p = "body" == this.options.container ? window.innerHeight : r.outerHeight(),
                        d = "body" == this.options.container ? 0 : r.offset().left;
                    e = "bottom" == e && n.top + n.height + o - h > p ? "top" : "top" == e && n.top - h - o < 0 ? "bottom" : "right" == e && n.right + a > u ? "left" : "left" == e && n.left - a < d ? "right" : e, t.removeClass(l).addClass(e)
                }
                var c = this.getCalculatedOffset(e, n, a, o);
                this.applyPlacement(c, e)
            }).call(this.container())
        }
    })
}(window.jQuery),
function(t) {
    function e() { return new Date(Date.UTC.apply(Date, arguments)) }
    var i = function(e, i) { this._process_options(i), this.element = t(e), this.isInline = !1, this.isInput = this.element.is("input"), this.component = !!this.element.is(".date") && this.element.find(".add-on, .btn"), this.hasInput = this.component && this.element.find("input").length, this.component && 0 === this.component.length && (this.component = !1), this.picker = t(h.template), this._buildEvents(), this._attachEvents(), this.isInline ? this.picker.addClass("datepicker-inline").appendTo(this.element) : this.picker.addClass("datepicker-dropdown dropdown-menu"), this.o.rtl && (this.picker.addClass("datepicker-rtl"), this.picker.find(".prev i, .next i").toggleClass("icon-arrow-left icon-arrow-right")), this.viewMode = this.o.startView, this.o.calendarWeeks && this.picker.find("tfoot th.today").attr("colspan", function(t, e) { return parseInt(e) + 1 }), this._allow_update = !1, this.setStartDate(this.o.startDate), this.setEndDate(this.o.endDate), this.setDaysOfWeekDisabled(this.o.daysOfWeekDisabled), this.fillDow(), this.fillMonths(), this._allow_update = !0, this.update(), this.showMode(), this.isInline && this.show() };
    i.prototype = {
        constructor: i,
        _process_options: function(e) {
            this._o = t.extend({}, this._o, e);
            var i = this.o = t.extend({}, this._o),
                s = i.language;
            switch (l[s] || (s = s.split("-")[0], l[s] || (s = o.language)), i.language = s, i.startView) {
                case 2:
                case "decade":
                    i.startView = 2;
                    break;
                case 1:
                case "year":
                    i.startView = 1;
                    break;
                default:
                    i.startView = 0
            }
            switch (i.minViewMode) {
                case 1:
                case "months":
                    i.minViewMode = 1;
                    break;
                case 2:
                case "years":
                    i.minViewMode = 2;
                    break;
                default:
                    i.minViewMode = 0
            }
            i.startView = Math.max(i.startView, i.minViewMode), i.weekStart %= 7, i.weekEnd = (i.weekStart + 6) % 7;
            var n = h.parseFormat(i.format);
            i.startDate !== -1 / 0 && (i.startDate = h.parseDate(i.startDate, n, i.language)), i.endDate !== 1 / 0 && (i.endDate = h.parseDate(i.endDate, n, i.language)), i.daysOfWeekDisabled = i.daysOfWeekDisabled || [], t.isArray(i.daysOfWeekDisabled) || (i.daysOfWeekDisabled = i.daysOfWeekDisabled.split(/[,\s]*/)), i.daysOfWeekDisabled = t.map(i.daysOfWeekDisabled, function(t) { return parseInt(t, 10) })
        },
        _events: [],
        _secondaryEvents: [],
        _applyEvents: function(t) { for (var e, i, s = 0; s < t.length; s++) e = t[s][0], i = t[s][1], e.on(i) },
        _unapplyEvents: function(t) { for (var e, i, s = 0; s < t.length; s++) e = t[s][0], i = t[s][1], e.off(i) },
        _buildEvents: function() {
            this.isInput ? this._events = [
                [this.element, { focus: t.proxy(this.show, this), keyup: t.proxy(this.update, this), keydown: t.proxy(this.keydown, this) }]
            ] : this.component && this.hasInput ? this._events = [
                [this.element.find("input"), { focus: t.proxy(this.show, this), keyup: t.proxy(this.update, this), keydown: t.proxy(this.keydown, this) }],
                [this.component, { click: t.proxy(this.show, this) }]
            ] : this.element.is("div") ? this.isInline = !0 : this._events = [
                [this.element, { click: t.proxy(this.show, this) }]
            ], this._secondaryEvents = [
                [this.picker, { click: t.proxy(this.click, this) }],
                [t(window), { resize: t.proxy(this.place, this) }],
                [t(document), { mousedown: t.proxy(function(t) { this.element.is(t.target) || this.element.find(t.target).size() || this.picker.is(t.target) || this.picker.find(t.target).size() || this.hide() }, this) }]
            ]
        },
        _attachEvents: function() { this._detachEvents(), this._applyEvents(this._events) },
        _detachEvents: function() { this._unapplyEvents(this._events) },
        _attachSecondaryEvents: function() { this._detachSecondaryEvents(), this._applyEvents(this._secondaryEvents) },
        _detachSecondaryEvents: function() { this._unapplyEvents(this._secondaryEvents) },
        _trigger: function(e, i) {
            var s = i || this.date,
                n = new Date(s.getTime() + 6e4 * s.getTimezoneOffset());
            this.element.trigger({ type: e, date: n, format: t.proxy(function(t) { var e = t || this.o.format; return h.formatDate(s, e, this.o.language) }, this) })
        },
        show: function(t) { this.isInline || this.picker.appendTo("body"), this.picker.show(), this.height = this.component ? this.component.outerHeight() : this.element.outerHeight(), this.place(), this._attachSecondaryEvents(), t && t.preventDefault(), this._trigger("show") },
        hide: function(t) { this.isInline || this.picker.is(":visible") && (this.picker.hide().detach(), this._detachSecondaryEvents(), this.viewMode = this.o.startView, this.showMode(), this.o.forceParse && (this.isInput && this.element.val() || this.hasInput && this.element.find("input").val()) && this.setValue(), this._trigger("hide")) },
        remove: function() { this.hide(), this._detachEvents(), this._detachSecondaryEvents(), this.picker.remove(), delete this.element.data().datepicker, this.isInput || delete this.element.data().date },
        getDate: function() { var t = this.getUTCDate(); return new Date(t.getTime() + 6e4 * t.getTimezoneOffset()) },
        getUTCDate: function() { return this.date },
        setDate: function(t) { this.setUTCDate(new Date(t.getTime() - 6e4 * t.getTimezoneOffset())) },
        setUTCDate: function(t) { this.date = t, this.setValue() },
        setValue: function() {
            var t = this.getFormattedDate();
            this.isInput ? this.element.val(t) : this.component && this.element.find("input").val(t)
        },
        getFormattedDate: function(t) { return void 0 === t && (t = this.o.format), h.formatDate(this.date, t, this.o.language) },
        setStartDate: function(t) { this._process_options({ startDate: t }), this.update(), this.updateNavArrows() },
        setEndDate: function(t) { this._process_options({ endDate: t }), this.update(), this.updateNavArrows() },
        setDaysOfWeekDisabled: function(t) { this._process_options({ daysOfWeekDisabled: t }), this.update(), this.updateNavArrows() },
        place: function() {
            if (!this.isInline) {
                var e = parseInt(this.element.parents().filter(function() { return "auto" != t(this).css("z-index") }).first().css("z-index")) + 10,
                    i = this.component ? this.component.parent().offset() : this.element.offset(),
                    s = this.component ? this.component.outerHeight(!0) : this.element.outerHeight(!0);
                this.picker.css({ top: i.top + s, left: i.left, zIndex: e })
            }
        },
        _allow_update: !0,
        update: function() {
            if (this._allow_update) {
                var t, e = !1;
                arguments && arguments.length && ("string" == typeof arguments[0] || arguments[0] instanceof Date) ? (t = arguments[0], e = !0) : (t = this.isInput ? this.element.val() : this.element.data("date") || this.element.find("input").val(), delete this.element.data().date), this.date = h.parseDate(t, this.o.format, this.o.language), e && this.setValue(), this.date < this.o.startDate ? this.viewDate = new Date(this.o.startDate) : this.date > this.o.endDate ? this.viewDate = new Date(this.o.endDate) : this.viewDate = new Date(this.date), this.fill()
            }
        },
        fillDow: function() {
            var t = this.o.weekStart,
                e = "<tr>";
            if (this.o.calendarWeeks) {
                var i = '<th class="cw">&nbsp;</th>';
                e += i, this.picker.find(".datepicker-days thead tr:first-child").prepend(i)
            }
            for (; t < this.o.weekStart + 7;) e += '<th class="dow">' + l[this.o.language].daysMin[t++ % 7] + "</th>";
            e += "</tr>", this.picker.find(".datepicker-days thead").append(e)
        },
        fillMonths: function() {
            for (var t = "", e = 0; e < 12;) t += '<span class="month">' + l[this.o.language].monthsShort[e++] + "</span>";
            this.picker.find(".datepicker-months td").html(t)
        },
        setRange: function(e) { e && e.length ? this.range = t.map(e, function(t) { return t.valueOf() }) : delete this.range, this.fill() },
        getClassNames: function(e) {
            var i = [],
                s = this.viewDate.getUTCFullYear(),
                n = this.viewDate.getUTCMonth(),
                a = this.date.valueOf(),
                o = new Date;
            return e.getUTCFullYear() < s || e.getUTCFullYear() == s && e.getUTCMonth() < n ? i.push("old") : (e.getUTCFullYear() > s || e.getUTCFullYear() == s && e.getUTCMonth() > n) && i.push("new"), this.o.todayHighlight && e.getUTCFullYear() == o.getFullYear() && e.getUTCMonth() == o.getMonth() && e.getUTCDate() == o.getDate() && i.push("today"), a && e.valueOf() == a && i.push("active"), (e.valueOf() < this.o.startDate || e.valueOf() > this.o.endDate || -1 !== t.inArray(e.getUTCDay(), this.o.daysOfWeekDisabled)) && i.push("disabled"), this.range && (e > this.range[0] && e < this.range[this.range.length - 1] && i.push("range"), -1 != t.inArray(e.valueOf(), this.range) && i.push("selected")), i
        },
        fill: function() {
            var i, s = new Date(this.viewDate),
                n = s.getUTCFullYear(),
                a = s.getUTCMonth(),
                o = this.o.startDate !== -1 / 0 ? this.o.startDate.getUTCFullYear() : -1 / 0,
                r = this.o.startDate !== -1 / 0 ? this.o.startDate.getUTCMonth() : -1 / 0,
                u = this.o.endDate !== 1 / 0 ? this.o.endDate.getUTCFullYear() : 1 / 0,
                p = this.o.endDate !== 1 / 0 ? this.o.endDate.getUTCMonth() : 1 / 0;
            this.date && this.date.valueOf();
            this.picker.find(".datepicker-days thead th.datepicker-switch").text(l[this.o.language].months[a] + " " + n), this.picker.find("tfoot th.today").text(l[this.o.language].today).toggle(!1 !== this.o.todayBtn), this.picker.find("tfoot th.clear").text(l[this.o.language].clear).toggle(!1 !== this.o.clearBtn), this.updateNavArrows(), this.fillMonths();
            var d = e(n, a - 1, 28, 0, 0, 0, 0),
                c = h.getDaysInMonth(d.getUTCFullYear(), d.getUTCMonth());
            d.setUTCDate(c), d.setUTCDate(c - (d.getUTCDay() - this.o.weekStart + 7) % 7);
            var f = new Date(d);
            f.setUTCDate(f.getUTCDate() + 42), f = f.valueOf();
            for (var m, v = []; d.valueOf() < f;) {
                if (d.getUTCDay() == this.o.weekStart && (v.push("<tr>"), this.o.calendarWeeks)) {
                    var y = new Date(+d + (this.o.weekStart - d.getUTCDay() - 7) % 7 * 864e5),
                        b = new Date(+y + (11 - y.getUTCDay()) % 7 * 864e5),
                        g = new Date(+(g = e(b.getUTCFullYear(), 0, 1)) + (11 - g.getUTCDay()) % 7 * 864e5),
                        w = (b - g) / 864e5 / 7 + 1;
                    v.push('<td class="cw">' + w + "</td>")
                }(m = this.getClassNames(d)).push("day");
                var D = this.o.beforeShowDay(d);
                void 0 === D ? D = {} : "boolean" == typeof D ? D = { enabled: D } : "string" == typeof D && (D = { classes: D }), !1 === D.enabled && m.push("disabled"), D.classes && (m = m.concat(D.classes.split(/\s+/))), D.tooltip && (i = D.tooltip), m = t.unique(m), v.push('<td class="' + m.join(" ") + '"' + (i ? ' title="' + i + '"' : "") + ">" + d.getUTCDate() + "</td>"), d.getUTCDay() == this.o.weekEnd && v.push("</tr>"), d.setUTCDate(d.getUTCDate() + 1)
            }
            this.picker.find(".datepicker-days tbody").empty().append(v.join(""));
            var k = this.date && this.date.getUTCFullYear(),
                $ = this.picker.find(".datepicker-months").find("th:eq(1)").text(n).end().find("span").removeClass("active");
            k && k == n && $.eq(this.date.getUTCMonth()).addClass("active"), (n < o || n > u) && $.addClass("disabled"), n == o && $.slice(0, r).addClass("disabled"), n == u && $.slice(p + 1).addClass("disabled"), v = "", n = 10 * parseInt(n / 10, 10);
            var C = this.picker.find(".datepicker-years").find("th:eq(1)").text(n + "-" + (n + 9)).end().find("td");
            n -= 1;
            for (var x = -1; x < 11; x++) v += '<span class="year' + (-1 == x ? " old" : 10 == x ? " new" : "") + (k == n ? " active" : "") + (n < o || n > u ? " disabled" : "") + '">' + n + "</span>", n += 1;
            C.html(v)
        },
        updateNavArrows: function() {
            if (this._allow_update) {
                var t = new Date(this.viewDate),
                    e = t.getUTCFullYear(),
                    i = t.getUTCMonth();
                switch (this.viewMode) {
                    case 0:
                        this.o.startDate !== -1 / 0 && e <= this.o.startDate.getUTCFullYear() && i <= this.o.startDate.getUTCMonth() ? this.picker.find(".prev").css({ visibility: "hidden" }) : this.picker.find(".prev").css({ visibility: "visible" }), this.o.endDate !== 1 / 0 && e >= this.o.endDate.getUTCFullYear() && i >= this.o.endDate.getUTCMonth() ? this.picker.find(".next").css({ visibility: "hidden" }) : this.picker.find(".next").css({ visibility: "visible" });
                        break;
                    case 1:
                    case 2:
                        this.o.startDate !== -1 / 0 && e <= this.o.startDate.getUTCFullYear() ? this.picker.find(".prev").css({ visibility: "hidden" }) : this.picker.find(".prev").css({ visibility: "visible" }), this.o.endDate !== 1 / 0 && e >= this.o.endDate.getUTCFullYear() ? this.picker.find(".next").css({ visibility: "hidden" }) : this.picker.find(".next").css({ visibility: "visible" })
                }
            }
        },
        click: function(i) {
            i.preventDefault();
            var s = t(i.target).closest("span, td, th");
            if (1 == s.length) switch (s[0].nodeName.toLowerCase()) {
                case "th":
                    switch (s[0].className) {
                        case "datepicker-switch":
                            this.showMode(1);
                            break;
                        case "prev":
                        case "next":
                            var n = h.modes[this.viewMode].navStep * ("prev" == s[0].className ? -1 : 1);
                            switch (this.viewMode) {
                                case 0:
                                    this.viewDate = this.moveMonth(this.viewDate, n);
                                    break;
                                case 1:
                                case 2:
                                    this.viewDate = this.moveYear(this.viewDate, n)
                            }
                            this.fill();
                            break;
                        case "today":
                            var a = new Date;
                            a = e(a.getFullYear(), a.getMonth(), a.getDate(), 0, 0, 0), this.showMode(-2);
                            var o = "linked" == this.o.todayBtn ? null : "view";
                            this._setDate(a, o);
                            break;
                        case "clear":
                            var r;
                            this.isInput ? r = this.element : this.component && (r = this.element.find("input")), r && r.val("").change(), this._trigger("changeDate"), this.update(), this.o.autoclose && this.hide()
                    }
                    break;
                case "span":
                    if (!s.is(".disabled")) {
                        if (this.viewDate.setUTCDate(1), s.is(".month")) {
                            var l = 1,
                                u = s.parent().find("span").index(s),
                                p = this.viewDate.getUTCFullYear();
                            this.viewDate.setUTCMonth(u), this._trigger("changeMonth", this.viewDate), 1 === this.o.minViewMode && this._setDate(e(p, u, l, 0, 0, 0, 0))
                        } else {
                            p = parseInt(s.text(), 10) || 0, l = 1, u = 0;
                            this.viewDate.setUTCFullYear(p), this._trigger("changeYear", this.viewDate), 2 === this.o.minViewMode && this._setDate(e(p, u, l, 0, 0, 0, 0))
                        }
                        this.showMode(-1), this.fill()
                    }
                    break;
                case "td":
                    if (s.is(".day") && !s.is(".disabled")) {
                        l = parseInt(s.text(), 10) || 1, p = this.viewDate.getUTCFullYear(), u = this.viewDate.getUTCMonth();
                        s.is(".old") ? 0 === u ? (u = 11, p -= 1) : u -= 1 : s.is(".new") && (11 == u ? (u = 0, p += 1) : u += 1), this._setDate(e(p, u, l, 0, 0, 0, 0))
                    }
            }
        },
        _setDate: function(t, e) {
            var i;
            e && "date" != e || (this.date = new Date(t)), e && "view" != e || (this.viewDate = new Date(t)), this.fill(), this.setValue(), this._trigger("changeDate"), this.isInput ? i = this.element : this.component && (i = this.element.find("input")), i && (i.change(), !this.o.autoclose || e && "date" != e || this.hide())
        },
        moveMonth: function(t, e) {
            if (!e) return t;
            var i, s, n = new Date(t.valueOf()),
                a = n.getUTCDate(),
                o = n.getUTCMonth(),
                r = Math.abs(e);
            if (e = e > 0 ? 1 : -1, 1 == r) s = -1 == e ? function() { return n.getUTCMonth() == o } : function() { return n.getUTCMonth() != i }, i = o + e, n.setUTCMonth(i), (i < 0 || i > 11) && (i = (i + 12) % 12);
            else {
                for (var l = 0; l < r; l++) n = this.moveMonth(n, e);
                i = n.getUTCMonth(), n.setUTCDate(a), s = function() { return i != n.getUTCMonth() }
            }
            for (; s();) n.setUTCDate(--a), n.setUTCMonth(i);
            return n
        },
        moveYear: function(t, e) { return this.moveMonth(t, 12 * e) },
        dateWithinRange: function(t) { return t >= this.o.startDate && t <= this.o.endDate },
        keydown: function(t) {
            if (this.picker.is(":not(:visible)")) 27 == t.keyCode && this.show();
            else {
                var e, i, s, n, a = !1;
                switch (t.keyCode) {
                    case 27:
                        this.hide(), t.preventDefault();
                        break;
                    case 37:
                    case 39:
                        if (!this.o.keyboardNavigation) break;
                        e = 37 == t.keyCode ? -1 : 1, t.ctrlKey ? (i = this.moveYear(this.date, e), s = this.moveYear(this.viewDate, e)) : t.shiftKey ? (i = this.moveMonth(this.date, e), s = this.moveMonth(this.viewDate, e)) : ((i = new Date(this.date)).setUTCDate(this.date.getUTCDate() + e), (s = new Date(this.viewDate)).setUTCDate(this.viewDate.getUTCDate() + e)), this.dateWithinRange(i) && (this.date = i, this.viewDate = s, this.setValue(), this.update(), t.preventDefault(), a = !0);
                        break;
                    case 38:
                    case 40:
                        if (!this.o.keyboardNavigation) break;
                        e = 38 == t.keyCode ? -1 : 1, t.ctrlKey ? (i = this.moveYear(this.date, e), s = this.moveYear(this.viewDate, e)) : t.shiftKey ? (i = this.moveMonth(this.date, e), s = this.moveMonth(this.viewDate, e)) : ((i = new Date(this.date)).setUTCDate(this.date.getUTCDate() + 7 * e), (s = new Date(this.viewDate)).setUTCDate(this.viewDate.getUTCDate() + 7 * e)), this.dateWithinRange(i) && (this.date = i, this.viewDate = s, this.setValue(), this.update(), t.preventDefault(), a = !0);
                        break;
                    case 13:
                        this.hide(), t.preventDefault();
                        break;
                    case 9:
                        this.hide()
                }
                if (a) this._trigger("changeDate"), this.isInput ? n = this.element : this.component && (n = this.element.find("input")), n && n.change()
            }
        },
        showMode: function(t) { t && (this.viewMode = Math.max(this.o.minViewMode, Math.min(2, this.viewMode + t))), this.picker.find(">div").hide().filter(".datepicker-" + h.modes[this.viewMode].clsName).css("display", "block"), this.updateNavArrows() }
    };
    var s = function(e, i) { this.element = t(e), this.inputs = t.map(i.inputs, function(t) { return t.jquery ? t[0] : t }), delete i.inputs, t(this.inputs).datepicker(i).bind("changeDate", t.proxy(this.dateUpdated, this)), this.pickers = t.map(this.inputs, function(e) { return t(e).data("datepicker") }), this.updateDates() };
    s.prototype = {
        updateDates: function() { this.dates = t.map(this.pickers, function(t) { return t.date }), this.updateRanges() },
        updateRanges: function() {
            var e = t.map(this.dates, function(t) { return t.valueOf() });
            t.each(this.pickers, function(t, i) { i.setRange(e) })
        },
        dateUpdated: function(e) {
            var i = t(e.target).data("datepicker").getUTCDate(),
                s = t.inArray(e.target, this.inputs),
                n = this.inputs.length;
            if (-1 != s) {
                if (i < this.dates[s])
                    for (; s >= 0 && i < this.dates[s];) this.pickers[s--].setUTCDate(i);
                else if (i > this.dates[s])
                    for (; s < n && i > this.dates[s];) this.pickers[s++].setUTCDate(i);
                this.updateDates()
            }
        },
        remove: function() { t.map(this.pickers, function(t) { t.remove() }), delete this.element.data().datepicker }
    };
    var n = t.fn.datepicker,
        a = t.fn.datepicker = function(e) {
            var n, a = Array.apply(null, arguments);
            return a.shift(), this.each(function() {
                var h = t(this),
                    u = h.data("datepicker"),
                    p = "object" == typeof e && e;
                if (!u) {
                    var d = function(e, i) {
                            var s = t(e).data(),
                                n = {},
                                a = new RegExp("^" + i.toLowerCase() + "([A-Z])");
                            i = new RegExp("^" + i.toLowerCase());
                            for (var o in s) i.test(o) && (n[o.replace(a, function(t, e) { return e.toLowerCase() })] = s[o]);
                            return n
                        }(this, "date"),
                        c = function(e) { var i = {}; if (l[e] || (e = e.split("-")[0], l[e])) { var s = l[e]; return t.each(r, function(t, e) { e in s && (i[e] = s[e]) }), i } }(t.extend({}, o, d, p).language),
                        f = t.extend({}, o, c, d, p);
                    if (h.is(".input-daterange") || f.inputs) {
                        var m = { inputs: f.inputs || h.find("input").toArray() };
                        h.data("datepicker", u = new s(this, t.extend(f, m)))
                    } else h.data("datepicker", u = new i(this, f))
                }
                if ("string" == typeof e && "function" == typeof u[e] && void 0 !== (n = u[e].apply(u, a))) return !1
            }), void 0 !== n ? n : this
        },
        o = t.fn.datepicker.defaults = { autoclose: !1, beforeShowDay: t.noop, calendarWeeks: !1, clearBtn: !1, daysOfWeekDisabled: [], endDate: 1 / 0, forceParse: !0, format: "mm/dd/yyyy", keyboardNavigation: !0, language: "en", minViewMode: 0, rtl: !1, startDate: -1 / 0, startView: 0, todayBtn: !1, todayHighlight: !1, weekStart: 0 },
        r = t.fn.datepicker.locale_opts = ["format", "rtl", "weekStart"];
    t.fn.datepicker.Constructor = i;
    var l = t.fn.datepicker.dates = { en: { days: ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday", "Sunday"], daysShort: ["Sun", "Mon", "Tue", "Wed", "Thu", "Fri", "Sat", "Sun"], daysMin: ["Su", "Mo", "Tu", "We", "Th", "Fr", "Sa", "Su"], months: ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"], monthsShort: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"], today: "Today", clear: "Clear" } },
        h = {
            modes: [{ clsName: "days", navFnc: "Month", navStep: 1 }, { clsName: "months", navFnc: "FullYear", navStep: 1 }, { clsName: "years", navFnc: "FullYear", navStep: 10 }],
            isLeapYear: function(t) { return t % 4 == 0 && t % 100 != 0 || t % 400 == 0 },
            getDaysInMonth: function(t, e) { return [31, h.isLeapYear(t) ? 29 : 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31][e] },
            validParts: /dd?|DD?|mm?|MM?|yy(?:yy)?/g,
            nonpunctuation: /[^ -\/:-@\[\u3400-\u9fff-`{-~\t\n\r]+/g,
            parseFormat: function(t) {
                var e = t.replace(this.validParts, "\0").split("\0"),
                    i = t.match(this.validParts);
                if (!e || !e.length || !i || 0 === i.length) throw new Error("Invalid date format.");
                return { separators: e, parts: i }
            },
            parseDate: function(s, n, a) {
                if (s instanceof Date) return s;
                if ("string" == typeof n && (n = h.parseFormat(n)), /^[\-+]\d+[dmwy]([\s,]+[\-+]\d+[dmwy])*$/.test(s)) {
                    var o, r = /([\-+]\d+)([dmwy])/,
                        u = s.match(/([\-+]\d+)([dmwy])/g);
                    s = new Date;
                    for (var p = 0; p < u.length; p++) switch (f = r.exec(u[p]), o = parseInt(f[1]), f[2]) {
                        case "d":
                            s.setUTCDate(s.getUTCDate() + o);
                            break;
                        case "m":
                            s = i.prototype.moveMonth.call(i.prototype, s, o);
                            break;
                        case "w":
                            s.setUTCDate(s.getUTCDate() + 7 * o);
                            break;
                        case "y":
                            s = i.prototype.moveYear.call(i.prototype, s, o)
                    }
                    return e(s.getUTCFullYear(), s.getUTCMonth(), s.getUTCDate(), 0, 0, 0)
                }
                u = s && s.match(this.nonpunctuation) || [], s = new Date;
                var d, c, f, m = {},
                    v = ["yyyy", "yy", "M", "MM", "m", "mm", "d", "dd"],
                    y = { yyyy: function(t, e) { return t.setUTCFullYear(e) }, yy: function(t, e) { return t.setUTCFullYear(2e3 + e) }, m: function(t, e) { for (e -= 1; e < 0;) e += 12; for (e %= 12, t.setUTCMonth(e); t.getUTCMonth() != e;) t.setUTCDate(t.getUTCDate() - 1); return t }, d: function(t, e) { return t.setUTCDate(e) } };
                y.M = y.MM = y.mm = y.m, y.dd = y.d, s = e(s.getFullYear(), s.getMonth(), s.getDate(), 0, 0, 0);
                var b = n.parts.slice();
                if (u.length != b.length && (b = t(b).filter(function(e, i) { return -1 !== t.inArray(i, v) }).toArray()), u.length == b.length) {
                    p = 0;
                    for (var g = b.length; p < g; p++) {
                        if (d = parseInt(u[p], 10), f = b[p], isNaN(d)) switch (f) {
                            case "MM":
                                c = t(l[a].months).filter(function() { var t = this.slice(0, u[p].length); return t == u[p].slice(0, t.length) }), d = t.inArray(c[0], l[a].months) + 1;
                                break;
                            case "M":
                                c = t(l[a].monthsShort).filter(function() { var t = this.slice(0, u[p].length); return t == u[p].slice(0, t.length) }), d = t.inArray(c[0], l[a].monthsShort) + 1
                        }
                        m[f] = d
                    }
                    var w;
                    for (p = 0; p < v.length; p++)(w = v[p]) in m && !isNaN(m[w]) && y[w](s, m[w])
                }
                return s
            },
            formatDate: function(e, i, s) {
                "string" == typeof i && (i = h.parseFormat(i));
                var n = { d: e.getUTCDate(), D: l[s].daysShort[e.getUTCDay()], DD: l[s].days[e.getUTCDay()], m: e.getUTCMonth() + 1, M: l[s].monthsShort[e.getUTCMonth()], MM: l[s].months[e.getUTCMonth()], yy: e.getUTCFullYear().toString().substring(2), yyyy: e.getUTCFullYear() };
                n.dd = (n.d < 10 ? "0" : "") + n.d, n.mm = (n.m < 10 ? "0" : "") + n.m;
                e = [];
                for (var a = t.extend([], i.separators), o = 0, r = i.parts.length; o <= r; o++) a.length && e.push(a.shift()), e.push(n[i.parts[o]]);
                return e.join("")
            },
            headTemplate: '<thead><tr><th class="prev"><i class="icon-arrow-left"/></th><th colspan="5" class="datepicker-switch"></th><th class="next"><i class="icon-arrow-right"/></th></tr></thead>',
            contTemplate: '<tbody><tr><td colspan="7"></td></tr></tbody>',
            footTemplate: '<tfoot><tr><th colspan="7" class="today"></th></tr><tr><th colspan="7" class="clear"></th></tr></tfoot>'
        };
    h.template = '<div class="datepicker"><div class="datepicker-days"><table class=" table-condensed">' + h.headTemplate + "<tbody></tbody>" + h.footTemplate + '</table></div><div class="datepicker-months"><table class="table-condensed">' + h.headTemplate + h.contTemplate + h.footTemplate + '</table></div><div class="datepicker-years"><table class="table-condensed">' + h.headTemplate + h.contTemplate + h.footTemplate + "</table></div></div>", t.fn.datepicker.DPGlobal = h, t.fn.datepicker.noConflict = function() { return t.fn.datepicker = n, this }, t(document).on("focus.datepicker.data-api click.datepicker.data-api", '[data-provide="datepicker"]', function(e) {
        var i = t(this);
        i.data("datepicker") || (e.preventDefault(), a.call(i, "show"))
    }), t(function() { a.call(t('[data-provide="datepicker-inline"]')) })
}(window.jQuery),
function(t) {
    "use strict";
    t.fn.bdatepicker = t.fn.datepicker.noConflict(), t.fn.datepicker || (t.fn.datepicker = t.fn.bdatepicker);
    var e = function(t) { this.init("date", t, e.defaults), this.initPicker(t, e.defaults) };
    t.fn.editableutils.inherit(e, t.fn.editabletypes.abstractinput), t.extend(e.prototype, {
        initPicker: function(e, i) { this.options.viewformat || (this.options.viewformat = this.options.format), e.datepicker = t.fn.editableutils.tryParseJson(e.datepicker, !0), this.options.datepicker = t.extend({}, i.datepicker, e.datepicker, { format: this.options.viewformat }), this.options.datepicker.language = this.options.datepicker.language || "en", this.dpg = t.fn.bdatepicker.DPGlobal, this.parsedFormat = this.dpg.parseFormat(this.options.format), this.parsedViewFormat = this.dpg.parseFormat(this.options.viewformat) },
        render: function() { this.$input.bdatepicker(this.options.datepicker), this.options.clear && (this.$clear = t('<a href="#"></a>').html(this.options.clear).click(t.proxy(function(t) { t.preventDefault(), t.stopPropagation(), this.clear() }, this)), this.$tpl.parent().append(t('<div class="editable-clear">').append(this.$clear))) },
        value2html: function(t, i) {
            var s = t ? this.dpg.formatDate(t, this.parsedViewFormat, this.options.datepicker.language) : "";
            e.superclass.value2html.call(this, s, i)
        },
        html2value: function(t) { return this.parseDate(t, this.parsedViewFormat) },
        value2str: function(t) { return t ? this.dpg.formatDate(t, this.parsedFormat, this.options.datepicker.language) : "" },
        str2value: function(t) { return this.parseDate(t, this.parsedFormat) },
        value2submit: function(t) { return this.value2str(t) },
        value2input: function(t) { this.$input.bdatepicker("update", t) },
        input2value: function() { return this.$input.data("datepicker").date },
        activate: function() {},
        clear: function() { this.$input.data("datepicker").date = null, this.$input.find(".active").removeClass("active"), this.options.showbuttons || this.$input.closest("form").submit() },
        autosubmit: function() {
            this.$input.on("mouseup", ".day", function(e) {
                if (!t(e.currentTarget).is(".old") && !t(e.currentTarget).is(".new")) {
                    var i = t(this).closest("form");
                    setTimeout(function() { i.submit() }, 200)
                }
            })
        },
        parseDate: function(t, e) { var i = null; return t && (i = this.dpg.parseDate(t, e, this.options.datepicker.language), "string" == typeof t && t !== this.dpg.formatDate(i, e, this.options.datepicker.language) && (i = null)), i }
    }), e.defaults = t.extend({}, t.fn.editabletypes.abstractinput.defaults, { tpl: '<div class="editable-date well"></div>', inputclass: null, format: "yyyy-mm-dd", viewformat: null, datepicker: { weekStart: 0, startView: 0, minViewMode: 0, autoclose: !1 }, clear: "&times; clear" }), t.fn.editabletypes.date = e
}(window.jQuery),
function(t) {
    "use strict";
    var e = function(t) { this.init("datefield", t, e.defaults), this.initPicker(t, e.defaults) };
    t.fn.editableutils.inherit(e, t.fn.editabletypes.date), t.extend(e.prototype, { render: function() { this.$input = this.$tpl.find("input"), this.setClass(), this.setAttr("placeholder"), this.$tpl.bdatepicker(this.options.datepicker), this.$input.off("focus keydown"), this.$input.keyup(t.proxy(function() { this.$tpl.removeData("date"), this.$tpl.bdatepicker("update") }, this)) }, value2input: function(t) { this.$input.val(t ? this.dpg.formatDate(t, this.parsedViewFormat, this.options.datepicker.language) : ""), this.$tpl.bdatepicker("update") }, input2value: function() { return this.html2value(this.$input.val()) }, activate: function() { t.fn.editabletypes.text.prototype.activate.call(this) }, autosubmit: function() {} }), e.defaults = t.extend({}, t.fn.editabletypes.date.defaults, { tpl: '<div class="input-append date"><input type="text"/><span class="add-on"><i class="icon-th"></i></span></div>', inputclass: "input-small", datepicker: { weekStart: 0, startView: 0, minViewMode: 0, autoclose: !0 } }), t.fn.editabletypes.datefield = e
}(window.jQuery),
function(t) {
    "use strict";
    var e = function(t) { this.init("datetime", t, e.defaults), this.initPicker(t, e.defaults) };
    t.fn.editableutils.inherit(e, t.fn.editabletypes.abstractinput), t.extend(e.prototype, {
        initPicker: function(e, i) { this.options.viewformat || (this.options.viewformat = this.options.format), e.datetimepicker = t.fn.editableutils.tryParseJson(e.datetimepicker, !0), this.options.datetimepicker = t.extend({}, i.datetimepicker, e.datetimepicker, { format: this.options.viewformat }), this.options.datetimepicker.language = this.options.datetimepicker.language || "en", this.dpg = t.fn.datetimepicker.DPGlobal, this.parsedFormat = this.dpg.parseFormat(this.options.format, this.options.formatType), this.parsedViewFormat = this.dpg.parseFormat(this.options.viewformat, this.options.formatType) },
        render: function() {
            this.$input.datetimepicker(this.options.datetimepicker), this.$input.on("changeMode", function(e) {
                var i = t(this).closest("form").parent();
                setTimeout(function() { i.triggerHandler("resize") }, 0)
            }), this.options.clear && (this.$clear = t('<a href="#"></a>').html(this.options.clear).click(t.proxy(function(t) { t.preventDefault(), t.stopPropagation(), this.clear() }, this)), this.$tpl.parent().append(t('<div class="editable-clear">').append(this.$clear)))
        },
        value2html: function(t, i) {
            var s = t ? this.dpg.formatDate(this.toUTC(t), this.parsedViewFormat, this.options.datetimepicker.language, this.options.formatType) : "";
            if (!i) return s;
            e.superclass.value2html.call(this, s, i)
        },
        html2value: function(t) { var e = this.parseDate(t, this.parsedViewFormat); return e ? this.fromUTC(e) : null },
        value2str: function(t) { return t ? this.dpg.formatDate(this.toUTC(t), this.parsedFormat, this.options.datetimepicker.language, this.options.formatType) : "" },
        str2value: function(t) { var e = this.parseDate(t, this.parsedFormat); return e ? this.fromUTC(e) : null },
        value2submit: function(t) { return this.value2str(t) },
        value2input: function(t) { t && this.$input.data("datetimepicker").setDate(t) },
        input2value: function() { var t = this.$input.data("datetimepicker"); return t.date ? t.getDate() : null },
        activate: function() {},
        clear: function() { this.$input.data("datetimepicker").date = null, this.$input.find(".active").removeClass("active"), this.options.showbuttons || this.$input.closest("form").submit() },
        autosubmit: function() {
            this.$input.on("mouseup", ".minute", function(e) {
                var i = t(this).closest("form");
                setTimeout(function() { i.submit() }, 200)
            })
        },
        toUTC: function(t) { return t ? new Date(t.valueOf() - 6e4 * t.getTimezoneOffset()) : t },
        fromUTC: function(t) { return t ? new Date(t.valueOf() + 6e4 * t.getTimezoneOffset()) : t },
        parseDate: function(t, e) { var i = null; return t && (i = this.dpg.parseDate(t, e, this.options.datetimepicker.language, this.options.formatType), "string" == typeof t && t !== this.dpg.formatDate(i, e, this.options.datetimepicker.language, this.options.formatType) && (i = null)), i }
    }), e.defaults = t.extend({}, t.fn.editabletypes.abstractinput.defaults, { tpl: '<div class="editable-date well"></div>', inputclass: null, format: "yyyy-mm-dd hh:ii", formatType: "standard", viewformat: null, datetimepicker: { todayHighlight: !1, autoclose: !1 }, clear: "&times; clear" }), t.fn.editabletypes.datetime = e
}(window.jQuery),
function(t) {
    "use strict";
    var e = function(t) { this.init("datetimefield", t, e.defaults), this.initPicker(t, e.defaults) };
    t.fn.editableutils.inherit(e, t.fn.editabletypes.datetime), t.extend(e.prototype, { render: function() { this.$input = this.$tpl.find("input"), this.setClass(), this.setAttr("placeholder"), this.$tpl.datetimepicker(this.options.datetimepicker), this.$input.off("focus keydown"), this.$input.keyup(t.proxy(function() { this.$tpl.removeData("date"), this.$tpl.datetimepicker("update") }, this)) }, value2input: function(t) { this.$input.val(this.value2html(t)), this.$tpl.datetimepicker("update") }, input2value: function() { return this.html2value(this.$input.val()) }, activate: function() { t.fn.editabletypes.text.prototype.activate.call(this) }, autosubmit: function() {} }), e.defaults = t.extend({}, t.fn.editabletypes.datetime.defaults, { tpl: '<div class="input-append date"><input type="text"/><span class="add-on"><i class="icon-th"></i></span></div>', inputclass: "input-medium", datetimepicker: { todayHighlight: !1, autoclose: !0 } }), t.fn.editabletypes.datetimefield = e
}(window.jQuery);