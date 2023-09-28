var Tooltip = (function () { 
    function Tooltip(targetEl, triggerEl, placementEl) {
        this._targetEl = targetEl;
        this._triggerEl = triggerEl;
        this._placementEl = placementEl;
        this._init();
    }

    Tooltip.prototype._init = function () {
        if (this._triggerEl) {
            this._setupEventListeners();
            this._setupAttribute();
        }
    };

    Tooltip.prototype._setupAttribute = function () {
        this._targetEl.setAttribute('data-popper-placement', this._placementEl);
    };

    Tooltip.prototype._setupEventListeners = function () {
        var _this = this;
        _this._handleStyle();
        this._triggerEl.addEventListener('mouseenter', function() {
            _this.show();
        });
        this._triggerEl.addEventListener('mouseleave', function() {
            _this.hide();
        });
    };

    Tooltip.prototype._handleStyle = function () {
        var _this = this;
        const arrow = this._targetEl.querySelector('.tooltip-arrow');

        _this._setupStyleElement(arrow);
        _this._setupStyleArrow(arrow);
    };

    Tooltip.prototype._setupStyleElement = function (arrow) {
        const translateX = this._triggerEl.offsetLeft + (this._triggerEl.offsetWidth - this._targetEl.offsetWidth) / 2;
        const translateY = this._triggerEl.offsetTop + this._triggerEl.offsetHeight + arrow.offsetHeight;

        this._targetEl.style.position = 'absolute';
        this._targetEl.style.inset = '0px auto auto 0px';
        this._targetEl.style.margin = '0px';
        this._targetEl.style.transform = `translate3d(${translateX}px, ${translateY}px, 0px)`;
    };

    Tooltip.prototype._setupStyleArrow = function (arrow) {
        const translateX = (this._targetEl.offsetWidth / 2) - (arrow.offsetWidth / 2);
        
        arrow.style.position = 'absolute';
        arrow.style.left = '0px';
        arrow.style.transform = `translate3d(${translateX}px, 0px, 0px)`;
    };

    Tooltip.prototype.show = function () {
        this._targetEl.classList.remove('opacity-0', 'invisible');
        this._targetEl.classList.add('opacity-100', 'visible');
    };

    Tooltip.prototype.hide = function () {
        this._targetEl.classList.remove('opacity-100', 'visible');
        this._targetEl.classList.add('opacity-0', 'invisible');
    };

    return Tooltip;
}());

function initTooltips() { 
    document.querySelectorAll('[data-tooltip-target]').forEach(function(triggerEl) {
        const tooltipId = triggerEl.getAttribute('data-tooltip-target');
        const placement = triggerEl.getAttribute('data-tooltip-placement');
        const tooltipEl = document.getElementById(tooltipId);

        new Tooltip(tooltipEl, triggerEl, placement);
    });
};

initTooltips();