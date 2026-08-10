(function () {
  var form = document.getElementById('calc-form');
  if (!form) return;

  var unit = 'metric';
  var sex = 'male';
  var goal = 'maintain';

  var unitButtons = document.querySelectorAll('.calc-unit-btn');
  var metricFields = document.querySelector('[data-unit-fields="metric"]');
  var imperialFields = document.querySelector('[data-unit-fields="imperial"]');

  unitButtons.forEach(function (btn) {
    btn.addEventListener('click', function () {
      unit = btn.dataset.unit;
      unitButtons.forEach(function (b) { b.classList.toggle('active', b === btn); });
      if (unit === 'metric') {
        metricFields.classList.remove('d-none');
        imperialFields.classList.add('d-none');
      } else {
        metricFields.classList.add('d-none');
        imperialFields.classList.remove('d-none');
      }
    });
  });

  document.querySelectorAll('.calc-pill[data-field="sex"]').forEach(function (btn) {
    btn.addEventListener('click', function () {
      sex = btn.dataset.value;
      document.querySelectorAll('.calc-pill[data-field="sex"]').forEach(function (b) {
        b.classList.toggle('active', b === btn);
      });
    });
  });

  document.querySelectorAll('.calc-pill[data-field="goal"]').forEach(function (btn) {
    btn.addEventListener('click', function () {
      goal = btn.dataset.value;
      document.querySelectorAll('.calc-pill[data-field="goal"]').forEach(function (b) {
        b.classList.toggle('active', b === btn);
      });
    });
  });

  // ── Macro donut chart ────────────────────────────────────
  var DONUT_RADIUS = 80;
  var DONUT_STROKE = 28;
  var DONUT_GAP_PX = 3;
  var DONUT_CIRCUMFERENCE = 2 * Math.PI * DONUT_RADIUS;

  var chartWrap = document.querySelector('.calc-chart-wrap');
  var chartTooltip = document.getElementById('calc-chart-tooltip');

  function positionChartTooltip(clientX, clientY, targetEl) {
    var wrapRect = chartWrap.getBoundingClientRect();
    var x, y;
    if (clientX != null) {
      x = clientX - wrapRect.left;
      y = clientY - wrapRect.top;
    } else {
      var r = targetEl.getBoundingClientRect();
      x = r.left + r.width / 2 - wrapRect.left;
      y = r.top + r.height / 2 - wrapRect.top;
    }
    chartTooltip.style.left = x + 'px';
    chartTooltip.style.top = y + 'px';
  }

  function showChartTooltip(seg, fraction, clientX, clientY, targetEl) {
    chartTooltip.textContent = '';
    var strong = document.createElement('strong');
    strong.textContent = Math.round(seg.grams) + 'g';
    var span = document.createElement('span');
    span.textContent = seg.label + ' · ' + Math.round(fraction * 100) + '%';
    chartTooltip.appendChild(strong);
    chartTooltip.appendChild(span);
    chartTooltip.classList.add('is-visible');
    positionChartTooltip(clientX, clientY, targetEl);
  }

  function hideChartTooltip() {
    chartTooltip.classList.remove('is-visible');
  }

  function buildDonutChart(segments, totalCalories) {
    var svgNS = 'http://www.w3.org/2000/svg';
    var group = document.getElementById('calc-donut-segments');
    group.textContent = '';

    var cursorFraction = 0;
    segments.forEach(function (seg) {
      var fraction = seg.calories / totalCalories;
      var gapFraction = DONUT_GAP_PX / DONUT_CIRCUMFERENCE;
      var visibleFraction = Math.max(0.001, fraction - gapFraction);
      var dashLength = visibleFraction * DONUT_CIRCUMFERENCE;
      var offset = -cursorFraction * DONUT_CIRCUMFERENCE;

      var circle = document.createElementNS(svgNS, 'circle');
      circle.setAttribute('cx', '100');
      circle.setAttribute('cy', '100');
      circle.setAttribute('r', String(DONUT_RADIUS));
      circle.setAttribute('fill', 'none');
      circle.setAttribute('stroke', 'var(--calc-series-' + seg.key + ')');
      circle.setAttribute('stroke-width', String(DONUT_STROKE));
      circle.setAttribute('stroke-linecap', 'butt');
      circle.setAttribute('stroke-dasharray', dashLength + ' ' + (DONUT_CIRCUMFERENCE - dashLength));
      circle.setAttribute('stroke-dashoffset', String(offset));
      circle.setAttribute('transform', 'rotate(-90 100 100)');
      circle.setAttribute('tabindex', '0');
      circle.setAttribute('role', 'img');
      circle.setAttribute('aria-label', seg.label + ': ' + Math.round(fraction * 100) + '%, ' + Math.round(seg.grams) + ' grams, ' + Math.round(seg.calories) + ' kcal');
      circle.classList.add('calc-donut-segment');

      circle.addEventListener('pointerenter', function (ev) { showChartTooltip(seg, fraction, ev.clientX, ev.clientY, circle); });
      circle.addEventListener('pointermove', function (ev) { positionChartTooltip(ev.clientX, ev.clientY, circle); });
      circle.addEventListener('pointerleave', hideChartTooltip);
      circle.addEventListener('focus', function () { showChartTooltip(seg, fraction, null, null, circle); });
      circle.addEventListener('blur', hideChartTooltip);

      group.appendChild(circle);
      cursorFraction += fraction;
    });
  }

  form.addEventListener('submit', function (e) {
    e.preventDefault();

    var age = parseFloat(document.getElementById('calc-age').value);
    var heightCm, weightKg;

    if (unit === 'metric') {
      heightCm = parseFloat(document.getElementById('calc-height-cm').value);
      weightKg = parseFloat(document.getElementById('calc-weight-kg').value);
    } else {
      var ft = parseFloat(document.getElementById('calc-height-ft').value) || 0;
      var inch = parseFloat(document.getElementById('calc-height-in').value) || 0;
      heightCm = ((ft * 12) + inch) * 2.54;
      var lb = parseFloat(document.getElementById('calc-weight-lb').value);
      weightKg = lb * 0.453592;
    }

    if (!age || !heightCm || !weightKg) return;

    var activityMultiplier = parseFloat(document.getElementById('calc-activity').value);

    var bmr = sex === 'male'
      ? (10 * weightKg) + (6.25 * heightCm) - (5 * age) + 5
      : (10 * weightKg) + (6.25 * heightCm) - (5 * age) - 161;

    var tdee = bmr * activityMultiplier;

    var target = tdee;
    var targetLabel = 'Calories to maintain';
    if (goal === 'lose') { target = tdee - 500; targetLabel = 'Calories to lose weight'; }
    if (goal === 'gain') { target = tdee + 500; targetLabel = 'Calories to gain weight'; }

    var protein = (target * 0.30) / 4;
    var carbs   = (target * 0.40) / 4;
    var fat     = (target * 0.30) / 9;
    var fiber   = (target / 1000) * 14; // ~14g fiber per 1,000 kcal, standard guideline
    var proteinPerKg = protein / weightKg;

    // BMI + healthy weight range (BMI 18.5–24.9)
    var heightM = heightCm / 100;
    var bmi = weightKg / (heightM * heightM);
    var minHealthyKg = 18.5 * heightM * heightM;
    var maxHealthyKg = 24.9 * heightM * heightM;
    var rangeUnit = unit === 'metric' ? 'kg' : 'lb';
    var minDisplay = unit === 'metric' ? Math.round(minHealthyKg) : Math.round(minHealthyKg * 2.20462);
    var maxDisplay = unit === 'metric' ? Math.round(maxHealthyKg) : Math.round(maxHealthyKg * 2.20462);

    // Water intake: ~35ml per kg, with a bump for higher activity levels
    var waterMl = weightKg * 35;
    if (activityMultiplier >= 1.55) waterMl += 350;
    if (activityMultiplier >= 1.9) waterMl += 350;

    // Heart-rate training zones (Tanaka formula: more accurate than 220-age)
    var maxHR = 208 - (0.7 * age);
    var hrFatBurn = [Math.round(maxHR * 0.50), Math.round(maxHR * 0.60)];
    var hrCardio  = [Math.round(maxHR * 0.60), Math.round(maxHR * 0.70)];
    var hrPeak    = [Math.round(maxHR * 0.70), Math.round(maxHR * 0.85)];

    // Weight-change timeline (only shown if a matching target weight was given)
    var timelineText = '';
    var targetWeightInput = unit === 'metric'
      ? parseFloat(document.getElementById('calc-target-kg').value)
      : parseFloat(document.getElementById('calc-target-lb').value);
    if (targetWeightInput && goal !== 'maintain') {
      var targetWeightKg = unit === 'metric' ? targetWeightInput : targetWeightInput * 0.453592;
      var directionMatches = (goal === 'lose' && targetWeightKg < weightKg) || (goal === 'gain' && targetWeightKg > weightKg);
      if (directionMatches) {
        var deltaKg = Math.abs(weightKg - targetWeightKg);
        var weeksNeeded = Math.round((deltaKg * 7700) / 500 / 7); // ~7700 kcal per kg of body weight
        if (weeksNeeded > 0) {
          var displayTargetWeight = unit === 'metric'
            ? Math.round(targetWeightKg) + ' kg'
            : Math.round(targetWeightKg * 2.20462) + ' lb';
          timelineText = 'At this rate, you could reach ' + displayTargetWeight + ' in approximately ' + weeksNeeded + ' week' + (weeksNeeded === 1 ? '' : 's') + '.';
        }
      }
    }

    document.getElementById('result-bmr').textContent = Math.round(bmr).toLocaleString();
    document.getElementById('result-tdee').textContent = Math.round(tdee).toLocaleString();
    document.getElementById('result-target').textContent = Math.round(target).toLocaleString();
    document.getElementById('result-target-label').textContent = targetLabel;
    document.getElementById('result-protein').textContent = Math.round(protein);
    document.getElementById('result-protein-perkg').textContent = proteinPerKg.toFixed(1) + ' g/kg';
    document.getElementById('result-carbs').textContent = Math.round(carbs);
    document.getElementById('result-fat').textContent = Math.round(fat);
    document.getElementById('result-fiber').textContent = Math.round(fiber);

    document.getElementById('result-bmi').textContent = bmi.toFixed(1);
    document.getElementById('result-ideal-range').textContent = minDisplay + '–' + maxDisplay + ' ' + rangeUnit;
    document.getElementById('result-water').textContent = (waterMl / 1000).toFixed(1) + ' L';

    document.getElementById('result-hr-fatburn').textContent = hrFatBurn[0] + '–' + hrFatBurn[1];
    document.getElementById('result-hr-cardio').textContent = hrCardio[0] + '–' + hrCardio[1];
    document.getElementById('result-hr-peak').textContent = hrPeak[0] + '–' + hrPeak[1];

    var timelineEl = document.getElementById('result-timeline');
    if (timelineText) {
      timelineEl.textContent = timelineText;
      timelineEl.classList.remove('d-none');
    } else {
      timelineEl.classList.add('d-none');
    }

    document.getElementById('calc-donut-center-value').textContent = Math.round(target).toLocaleString();
    buildDonutChart([
      { key: 'protein', label: 'Protein', calories: protein * 4, grams: protein },
      { key: 'carbs',   label: 'Carbs',   calories: carbs * 4,   grams: carbs },
      { key: 'fat',     label: 'Fat',     calories: fat * 9,     grams: fat }
    ], target);

    var results = document.getElementById('calc-results');
    results.classList.remove('d-none');
    results.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
  });

  // ── Email-my-results capture ────────────────────────────
  var emailForm = document.getElementById('calc-email-form');
  if (emailForm) {
    var emailSubmit = document.getElementById('calc-email-submit');
    var emailMessage = document.getElementById('calc-email-message');

    emailForm.addEventListener('submit', function (e) {
      e.preventDefault();

      emailSubmit.disabled = true;
      emailSubmit.textContent = 'Sending…';
      emailMessage.textContent = '';
      emailMessage.className = 'calc-email-message';

      fetch(emailForm.action, {
        method: 'POST',
        headers: {
          'Accept': 'application/json',
          'X-Requested-With': 'XMLHttpRequest'
        },
        body: new FormData(emailForm)
      })
        .then(function (response) {
          return response.json().then(function (data) {
            return { ok: response.ok, data: data };
          });
        })
        .then(function (result) {
          if (result.ok && result.data.success) {
            emailMessage.textContent = result.data.message;
            emailMessage.className = 'calc-email-message is-success';
            emailForm.reset();
            emailForm.querySelector('input[type="email"]').disabled = true;
            emailSubmit.textContent = 'Sent';
          } else {
            var msg = (result.data.errors && result.data.errors.email && result.data.errors.email[0])
              || result.data.message
              || 'Something went wrong — please try again.';
            emailMessage.textContent = msg;
            emailMessage.className = 'calc-email-message is-error';
            emailSubmit.disabled = false;
            emailSubmit.textContent = 'Email me my results';
          }
        })
        .catch(function () {
          emailMessage.textContent = 'Something went wrong — please try again.';
          emailMessage.className = 'calc-email-message is-error';
          emailSubmit.disabled = false;
          emailSubmit.textContent = 'Email me my results';
        });
    });
  }

  // ── Print / save-as-PDF ──────────────────────────────────
  var printBtn = document.getElementById('calc-print-btn');
  if (printBtn) {
    printBtn.addEventListener('click', function () {
      window.print();
    });
  }
})();
