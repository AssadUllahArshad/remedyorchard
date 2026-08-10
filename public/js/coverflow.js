(function () {
  var RENDER_RANGE = 6;

  // Card `index`'s signed distance from centre at position `pos`, wrapped
  // into (-count/2, count/2] so the loop is seamless (no visible jump).
  function relOf(index, pos, count) {
    var rel = (((index - pos) % count) + count) % count;
    if (rel > count / 2) rel -= count;
    return rel;
  }

  // Horizontal offset (px) from centre for a signed distance `rel`.
  function xForRel(rel, sizing, gap) {
    var ar = Math.abs(rel);
    var c1 = sizing.activeWidth / 2 + gap + sizing.restWidth / 2;
    var pitch = sizing.restWidth + gap;
    var mag = ar <= 1 ? ar * c1 : c1 + (ar - 1) * pitch;
    return (rel < 0 ? -1 : 1) * mag;
  }

  // 0 at centre (full active size) → 1 a full slot away (rest/slat size).
  function blendForRel(rel) {
    return Math.min(Math.abs(rel), 1);
  }

  function initCoverflow(root) {
    var cardEls = Array.prototype.slice.call(root.querySelectorAll('[data-coverflow-card]'));
    var prevBtn = root.querySelector('[data-coverflow-prev]');
    var nextBtn = root.querySelector('[data-coverflow-next]');
    if (cardEls.length === 0) return;

    var inners = cardEls.map(function (el) {
      return el.querySelector('.coverflow-card-inner');
    });

    var count = cardEls.length;
    var R = Math.max(1, Math.min(RENDER_RANGE, Math.floor(count / 2) - 1 || 1));
    var moveDur = 0.45;

    var sizing = { activeWidth: 0, activeHeight: 0, restWidth: 0, restHeight: 0 };
    var gap = 24;

    function computeSizing() {
      var rect = root.getBoundingClientRect();
      var H = rect.height;
      var W = rect.width;
      sizing.activeHeight = H * 0.88;
      sizing.activeWidth = Math.min(sizing.activeHeight * 1.5, W * 0.62);
      sizing.restHeight = H * 0.62;
      sizing.restWidth = sizing.restHeight * 0.74;
      gap = Math.max(14, W * 0.018);
    }

    var pos = 0;
    var target = 0;
    var raf = null;
    var lastT = null;

    function render() {
      for (var i = 0; i < cardEls.length; i++) {
        var outer = cardEls[i];
        var inner = inners[i];
        if (!inner) continue;

        var rel = relOf(i, pos, count);
        var ar = Math.abs(rel);
        var blend = blendForRel(rel);

        var x = xForRel(rel, sizing, gap);
        var width = sizing.activeWidth + (sizing.restWidth - sizing.activeWidth) * blend;
        var height = sizing.activeHeight + (sizing.restHeight - sizing.activeHeight) * blend;
        var opacity = ar <= R ? 1 : ar >= R + 1 ? 0 : 1 - (ar - R);
        var z = Math.round(1000 - ar * 100);

        outer.style.transform = 'translateX(' + x + 'px)';
        outer.style.opacity = String(opacity);
        outer.style.zIndex = String(z);
        outer.style.pointerEvents = opacity < 0.05 ? 'none' : 'auto';

        inner.style.width = width + 'px';
        inner.style.height = height + 'px';

        if (ar < 0.5) outer.classList.add('is-active');
        else outer.classList.remove('is-active');
      }
    }

    function tick(t) {
      var last = lastT == null ? t : lastT;
      var dt = Math.min((t - last) / 1000, 1 / 30);
      lastT = t;

      var diff = target - pos;
      var dur = Math.max(0.08, moveDur);
      var step = (1 / dur) * dt;

      if (Math.abs(diff) <= step) {
        pos = target;
        render();
        raf = null;
        lastT = null;
        return;
      }

      pos += diff > 0 ? step : -step;
      render();
      raf = requestAnimationFrame(tick);
    }

    function ensureRunning() {
      if (raf == null) {
        lastT = null;
        raf = requestAnimationFrame(tick);
      }
    }

    function goNext() { target += 1; ensureRunning(); }
    function goPrev() { target -= 1; ensureRunning(); }
    function goTo(index) {
      var d = index - target;
      d = ((d % count) + count) % count;
      if (d > count / 2) d -= count;
      target += d;
      ensureRunning();
    }

    cardEls.forEach(function (outer, i) {
      var inner = inners[i];
      if (!inner) return;
      inner.addEventListener('click', function (e) {
        var rel = relOf(i, pos, count);
        if (Math.abs(rel) < 0.5) return; // already active — let the CTA link work natively
        e.preventDefault();
        goTo(i);
      });
    });

    if (prevBtn) prevBtn.addEventListener('click', goPrev);
    if (nextBtn) nextBtn.addEventListener('click', goNext);

    root.addEventListener('keydown', function (e) {
      if (e.key === 'ArrowLeft') { e.preventDefault(); goPrev(); }
      else if (e.key === 'ArrowRight') { e.preventDefault(); goNext(); }
    });

    var ro = typeof ResizeObserver !== 'undefined'
      ? new ResizeObserver(function () {
          computeSizing();
          render();
        })
      : null;
    if (ro) ro.observe(root);

    computeSizing();
    render();
  }

  document.querySelectorAll('[data-coverflow]').forEach(initCoverflow);
})();
