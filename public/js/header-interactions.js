(function () {
  // ── Sliding nav indicator ────────────────────────────────
  var nav = document.querySelector('[data-sliding-nav]');
  if (nav) {
    var indicator = nav.querySelector('[data-nav-indicator]');
    var links = Array.prototype.slice.call(nav.querySelectorAll('[data-nav-link]'));

    if (indicator && links.length > 0) {
      var activeLink = nav.querySelector('[data-nav-link].active') || links[0];

      var moveTo = function (el) {
        indicator.style.width = el.offsetWidth + 'px';
        indicator.style.transform = 'translateX(' + el.offsetLeft + 'px)';
      };

      var resetToActive = function () { moveTo(activeLink); };

      var placeInstantly = function () {
        indicator.style.transition = 'none';
        resetToActive();
        requestAnimationFrame(function () {
          indicator.style.transition = '';
        });
      };

      placeInstantly();

      links.forEach(function (link) {
        link.addEventListener('mouseenter', function () { moveTo(link); });
      });
      nav.addEventListener('mouseleave', resetToActive);

      window.addEventListener('resize', placeInstantly);
    }
  }

  // ── Magnetic CTA buttons ─────────────────────────────────
  var MAX_OFFSET = 8;   // px, capped so it never looks silly
  var STRENGTH = 0.35;  // fraction of cursor offset applied
  var LIFT = -1;        // px, preserves the existing hover-lift feel

  var buttons = document.querySelectorAll('[data-magnetic]');
  buttons.forEach(function (btn) {
    btn.addEventListener('mousemove', function (e) {
      var rect = btn.getBoundingClientRect();
      var dx = e.clientX - (rect.left + rect.width / 2);
      var dy = e.clientY - (rect.top + rect.height / 2);
      var x = Math.max(-MAX_OFFSET, Math.min(MAX_OFFSET, dx * STRENGTH));
      var y = Math.max(-MAX_OFFSET, Math.min(MAX_OFFSET, dy * STRENGTH)) + LIFT;
      btn.style.transform = 'translate(' + x + 'px, ' + y + 'px)';
    });
    btn.addEventListener('mouseleave', function () {
      btn.style.transform = 'translate(0, 0)';
    });
  });
})();
