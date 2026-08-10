(function () {
  function initRoundCarousel(root) {
    var tilt = root.querySelector('[data-round-carousel-tilt]');
    var ring = root.querySelector('[data-round-carousel-ring]');
    var items = Array.prototype.slice.call(root.querySelectorAll('[data-round-carousel-item]'));
    if (!tilt || !ring || items.length === 0) return;

    var count = items.length;
    var angle = 360 / count;
    var spacing = 7;
    var speed = 2;      // slower than a photo carousel — quotes need time to read
    var direction = 1;  // 1 = right, -1 = left
    var tiltDeg = -4;
    var factor = 1 + spacing * 0.15;
    var degPerSec = speed * 6 * direction;

    var radius = 0;

    function placeItems() {
      var rect = ring.getBoundingClientRect();
      var width = rect.width;
      radius = (width * factor) / (2 * Math.tan(Math.PI / count));
      items.forEach(function (item, i) {
        item.style.transform = 'rotateY(' + (i * angle) + 'deg) translateZ(' + radius + 'px)';
      });
    }

    tilt.style.transform = 'rotateX(' + tiltDeg + 'deg)';
    placeItems();

    var rotY = 0;
    var vel = 0;
    var lastT = 0;
    var drag = { active: false, x: 0 };
    var raf = 0;

    function apply() {
      ring.style.transform = 'translateZ(' + (-radius) + 'px) rotateY(' + rotY + 'deg)';
    }
    apply();

    function draw(now) {
      var dt = lastT ? (now - lastT) / 1000 : 0;
      lastT = now;
      var f = Math.min(dt, 0.1);

      if (!drag.active) {
        if (Math.abs(vel) > 0.01) {
          rotY += vel * f;
          vel *= 0.94;
        } else {
          rotY += degPerSec * f;
        }
      }
      apply();
      raf = requestAnimationFrame(draw);
    }
    raf = requestAnimationFrame(draw);

    function onPointerDown(e) {
      if (root.setPointerCapture) root.setPointerCapture(e.pointerId);
      drag.active = true;
      drag.x = e.clientX;
      vel = 0;
    }
    function onPointerMove(e) {
      if (!drag.active) return;
      var dx = e.clientX - drag.x;
      drag.x = e.clientX;
      var k = 0.3 * 5; // sensitivity
      rotY += dx * k;
      vel = dx * k * 60;
    }
    function onPointerUp(e) {
      if (root.releasePointerCapture) root.releasePointerCapture(e.pointerId);
      drag.active = false;
    }

    root.addEventListener('pointerdown', onPointerDown);
    root.addEventListener('pointermove', onPointerMove);
    root.addEventListener('pointerup', onPointerUp);
    root.addEventListener('pointercancel', onPointerUp);

    var ro = typeof ResizeObserver !== 'undefined'
      ? new ResizeObserver(placeItems)
      : null;
    if (ro) ro.observe(ring);
  }

  document.querySelectorAll('[data-round-carousel]').forEach(initRoundCarousel);
})();
