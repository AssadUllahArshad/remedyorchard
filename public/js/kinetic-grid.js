(function () {
  var host = document.querySelector('[data-kinetic-grid]');
  if (!host) return;

  var canvas = host.querySelector('canvas');
  if (!canvas) return;

  var ctx = canvas.getContext('2d');
  if (!ctx) return;

  var dotColor   = host.dataset.dotColor   || '#FFFFFF';
  var lineColor  = host.dataset.lineColor  || '#2E6DA4';
  var trailColor = host.dataset.trailColor || lineColor;
  var spacing    = parseFloat(host.dataset.spacing)  || 38;
  var radius     = parseFloat(host.dataset.radius)   || 220;
  var strengthIn = parseFloat(host.dataset.strength) || 4;
  var showTrail  = host.dataset.trail !== 'false';

  var prefersReduced = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

  var GAP  = Math.max(8, spacing);
  var R    = Math.max(1, radius);
  var PULL = (Math.max(1, Math.min(10, strengthIn)) / 10) * 4;

  var W = 1, H = 1;
  var cols = [];
  var dots = [];
  var mouse = { x: -9999, y: -9999, active: false };
  var trailPts = [];
  var raf = 0;

  function build(mw, mh) {
    var rect = host.getBoundingClientRect();
    W = Math.max(1, Math.floor(mw || rect.width));
    H = Math.max(1, Math.floor(mh || rect.height));

    var dpr = window.devicePixelRatio || 1;
    canvas.width = Math.floor(W * dpr);
    canvas.height = Math.floor(H * dpr);
    canvas.style.width = W + 'px';
    canvas.style.height = H + 'px';
    ctx.setTransform(dpr, 0, 0, dpr, 0, 0);

    cols = [];
    dots = [];
    var nCols = Math.floor(W / GAP) + 2;
    var nRows = Math.floor(H / GAP) + 2;
    for (var c = 0; c < nCols; c++) {
      var col = [];
      for (var r = 0; r < nRows; r++) {
        var hx = c * GAP, hy = r * GAP;
        var d = { hx: hx, hy: hy, x: hx, y: hy, vx: 0, vy: 0 };
        col.push(d);
        dots.push(d);
      }
      cols.push(col);
    }
  }

  // One-shot render at rest positions — used for prefers-reduced-motion,
  // matching how the original component drew its static thumbnail state.
  function drawStatic() {
    ctx.clearRect(0, 0, W, H);

    ctx.globalAlpha = 0.14;
    ctx.strokeStyle = lineColor;
    ctx.lineWidth = 0.75;
    for (var c = 0; c < cols.length; c++) {
      for (var r = 0; r < cols[c].length; r++) {
        var d = cols[c][r];
        var right = cols[c + 1] ? cols[c + 1][r] : null;
        var down = cols[c][r + 1];
        if (right) {
          ctx.beginPath();
          ctx.moveTo(d.hx, d.hy);
          ctx.lineTo(right.hx, right.hy);
          ctx.stroke();
        }
        if (down) {
          ctx.beginPath();
          ctx.moveTo(d.hx, d.hy);
          ctx.lineTo(down.hx, down.hy);
          ctx.stroke();
        }
      }
    }

    ctx.globalAlpha = 0.4;
    ctx.fillStyle = dotColor;
    for (var i = 0; i < dots.length; i++) {
      var dd = dots[i];
      ctx.beginPath();
      ctx.arc(dd.hx, dd.hy, 1.2, 0, Math.PI * 2);
      ctx.fill();
    }
    ctx.globalAlpha = 1;
  }

  build();

  var ro = typeof ResizeObserver !== 'undefined'
    ? new ResizeObserver(function (entries) {
        var cr = entries[0] && entries[0].contentRect;
        build(cr && cr.width, cr && cr.height);
        if (prefersReduced) drawStatic();
      })
    : null;
  if (ro) ro.observe(host);

  if (prefersReduced) {
    drawStatic();
    return;
  }

  function setMouse(clientX, clientY) {
    var r = canvas.getBoundingClientRect();
    var mx = clientX - r.left;
    var my = clientY - r.top;
    mouse.x = mx;
    mouse.y = my;
    mouse.active = true;

    var now = performance.now();
    trailPts.push({ x: mx, y: my, t: now });
    if (trailPts.length > 80) trailPts.shift();
  }

  function onMove(e) { setMouse(e.clientX, e.clientY); }
  function onLeave() {
    mouse.active = false;
    mouse.x = -9999;
    mouse.y = -9999;
  }
  function onTouch(e) {
    var t = e.touches[0];
    if (t) setMouse(t.clientX, t.clientY);
  }

  host.addEventListener('mousemove', onMove);
  host.addEventListener('mouseleave', onLeave);
  host.addEventListener('touchmove', onTouch, { passive: true });
  host.addEventListener('touchend', onLeave);

  function frame() {
    var m = mouse;
    ctx.clearRect(0, 0, W, H);

    for (var i = 0; i < dots.length; i++) {
      var d = dots[i];
      var ax = (d.hx - d.x) * 0.08;
      var ay = (d.hy - d.y) * 0.08;
      if (m.active) {
        var dx = m.x - d.x;
        var dy = m.y - d.y;
        var dist = Math.sqrt(dx * dx + dy * dy);
        if (dist < R && dist > 0.001) {
          var f = (1 - dist / R) * PULL;
          ax += (dx / dist) * f;
          ay += (dy / dist) * f;
        }
      }
      d.vx = (d.vx + ax) * 0.82;
      d.vy = (d.vy + ay) * 0.82;
      d.x += d.vx;
      d.y += d.vy;
    }

    for (var c = 0; c < cols.length; c++) {
      for (var r = 0; r < cols[c].length; r++) {
        var dd = cols[c][r];
        var right = cols[c + 1] ? cols[c + 1][r] : null;
        var down = cols[c][r + 1];
        var prox = m.active
          ? Math.max(0, 1 - Math.sqrt(Math.pow(m.x - dd.x, 2) + Math.pow(m.y - dd.y, 2)) / R)
          : 0;

        if (right) {
          ctx.globalAlpha = 0.14 + prox * 0.55;
          ctx.strokeStyle = lineColor;
          ctx.lineWidth = 0.5 + prox * 1.5;
          ctx.beginPath();
          ctx.moveTo(dd.x, dd.y);
          ctx.lineTo(right.x, right.y);
          ctx.stroke();
        }
        if (down) {
          ctx.globalAlpha = 0.14 + prox * 0.55;
          ctx.strokeStyle = lineColor;
          ctx.lineWidth = 0.5 + prox * 1.5;
          ctx.beginPath();
          ctx.moveTo(dd.x, dd.y);
          ctx.lineTo(down.x, down.y);
          ctx.stroke();
        }
      }
    }

    for (var j = 0; j < dots.length; j++) {
      var dp = dots[j];
      var prox2 = m.active
        ? Math.max(0, 1 - Math.sqrt(Math.pow(m.x - dp.x, 2) + Math.pow(m.y - dp.y, 2)) / R)
        : 0;
      ctx.globalAlpha = 0.4 + prox2 * 0.55;
      ctx.fillStyle = dotColor;
      ctx.beginPath();
      ctx.arc(dp.x, dp.y, 0.8 + prox2 * 2.2, 0, Math.PI * 2);
      ctx.fill();
    }

    if (showTrail) {
      var now2 = performance.now();
      ctx.lineCap = 'round';
      ctx.lineJoin = 'round';
      for (var k = 1; k < trailPts.length; k++) {
        var a = trailPts[k - 1];
        var b = trailPts[k];
        var age = now2 - b.t;
        if (age > 260) continue;
        ctx.globalAlpha = Math.max(0, 1 - age / 260) * 0.85;
        ctx.strokeStyle = trailColor;
        ctx.lineWidth = 2;
        ctx.beginPath();
        ctx.moveTo(a.x, a.y);
        ctx.lineTo(b.x, b.y);
        ctx.stroke();
      }
    }

    ctx.globalAlpha = 1;
    raf = requestAnimationFrame(frame);
  }
  raf = requestAnimationFrame(frame);
})();
