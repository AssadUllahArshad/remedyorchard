@extends('layouts.app')

@section('title', 'Free Calorie Calculator | Healthy Habits Hub')
@section('meta_description', 'Calculate your BMR, TDEE, and daily calorie needs using the Mifflin-St Jeor equation — the clinical standard for estimating energy expenditure — plus a protein, carb, and fat breakdown for your goal.')
@section('og_title', 'Free Calorie Calculator | Healthy Habits Hub')
@section('og_description', 'Find your BMR, TDEE, and a goal-based macro breakdown using the Mifflin-St Jeor equation.')

@section('content')

<!-- INTRO -->
<section class="section-dark py-section" style="padding-top:4rem; padding-bottom:2.5rem;">
  <div class="container text-center" style="max-width:720px; margin:0 auto;">
    <span class="eyebrow d-flex justify-content-center">Free tool</span>
    <h1 class="hero-h1" style="color:var(--text-on-dark);">Calorie Calculator</h1>
    <p class="hero-sub" style="max-width:640px; margin:0 auto; color:var(--text-on-dark-dim);">
      Find your daily calorie needs using the Mifflin-St Jeor equation — the same formula used clinically to estimate resting energy expenditure, and more accurate than the older Harris-Benedict method still used on most generic calculators.
    </p>
  </div>
</section>

<!-- CALCULATOR -->
<section class="section-pill py-section" style="padding-top:0;">
  <div class="container" style="max-width:760px;">
    <div class="card-dark p-4 p-md-5">

      {{-- Unit toggle --}}
      <div class="calc-unit-toggle">
        <button type="button" class="calc-unit-btn active" data-unit="metric">Metric</button>
        <button type="button" class="calc-unit-btn" data-unit="imperial">Imperial</button>
      </div>

      <form id="calc-form">
        <div class="row g-3 mb-1">
            <div class="col-sm-6">
              <fieldset class="form-fieldset-v2">
                <legend class="form-label-v2">Sex</legend>
                <div class="calc-pill-group">
                  <button type="button" class="calc-pill active" data-field="sex" data-value="male">Male</button>
                  <button type="button" class="calc-pill" data-field="sex" data-value="female">Female</button>
                </div>
              </fieldset>
            </div>
          <div class="col-sm-6">
            <label class="form-label-v2" for="calc-age">Age</label>
            <input type="number" id="calc-age" class="form-input-v2" min="10" max="100" value="30" required>
          </div>
        </div>

        <div class="row g-3 mb-1" data-unit-fields="metric">
          <div class="col-sm-4">
            <label class="form-label-v2" for="calc-height-cm">Height (cm)</label>
            <input type="number" id="calc-height-cm" class="form-input-v2" min="100" max="250" value="170" required>
          </div>
          <div class="col-sm-4">
            <label class="form-label-v2" for="calc-weight-kg">Weight (kg)</label>
            <input type="number" id="calc-weight-kg" class="form-input-v2" min="30" max="300" value="70" required>
          </div>
          <div class="col-sm-4">
            <label class="form-label-v2" for="calc-target-kg">Target weight (kg) <span class="calc-optional-tag">optional</span></label>
            <input type="number" id="calc-target-kg" class="form-input-v2" min="30" max="300" placeholder="e.g. 65">
          </div>
        </div>

        <div class="row g-3 mb-1 d-none" data-unit-fields="imperial">
          <div class="col-sm-3">
            <label class="form-label-v2" for="calc-height-ft">Height (ft)</label>
            <input type="number" id="calc-height-ft" class="form-input-v2" min="3" max="8" value="5">
          </div>
          <div class="col-sm-3">
            <label class="form-label-v2" for="calc-height-in">Height (in)</label>
            <input type="number" id="calc-height-in" class="form-input-v2" min="0" max="11" value="7">
          </div>
          <div class="col-sm-3">
            <label class="form-label-v2" for="calc-weight-lb">Weight (lb)</label>
            <input type="number" id="calc-weight-lb" class="form-input-v2" min="60" max="660" value="154">
          </div>
          <div class="col-sm-3">
            <label class="form-label-v2" for="calc-target-lb">Target (lb) <span class="calc-optional-tag">opt.</span></label>
            <input type="number" id="calc-target-lb" class="form-input-v2" min="60" max="660" placeholder="e.g. 143">
          </div>
        </div>

        <label class="form-label-v2 mt-2" for="calc-activity">Activity level</label>
        <select id="calc-activity" class="form-input-v2 mb-1">
          <option value="1.2">Sedentary — little or no exercise</option>
          <option value="1.375" selected>Lightly active — light exercise 1–3 days/week</option>
          <option value="1.55">Moderately active — moderate exercise 3–5 days/week</option>
          <option value="1.725">Very active — hard exercise 6–7 days/week</option>
          <option value="1.9">Extra active — physical job or twice-daily training</option>
        </select>
      <fieldset class="form-fieldset-v2 mt-3">
        <lagend class="form-label-v2 mt-3">Goal</lagend>
        <div class="calc-pill-group mb-3">
          <button type="button" class="calc-pill" data-field="goal" data-value="lose">Lose weight</button>
          <button type="button" class="calc-pill active" data-field="goal" data-value="maintain">Maintain</button>
          <button type="button" class="calc-pill" data-field="goal" data-value="gain">Gain weight</button>
        </div>
      </fieldset>
      
        <button type="submit" class="btn-pill-primary btn-pill-primary--lg w-100 justify-content-center">
          Calculate my calories
        </button>
      </form>

      {{-- Results (hidden until calculated) --}}
      <div id="calc-results" class="calc-results d-none">
        <div class="calc-print-header">Healthy Habits Hub — Calorie Calculator Results</div>

        <div class="calc-results-divider"></div>

        <div class="calc-print-row">
          <button type="button" class="btn-pill-outline calc-print-btn" id="calc-print-btn">
            <i class="bi bi-printer"></i> Print my results
          </button>
        </div>

        <div class="row g-3 text-center mb-3">
          <div class="col-md-4">
            <span class="stat-num" id="result-bmr">—</span>
            <span class="stat-label">BMR</span>
          </div>
          <div class="col-md-4">
            <span class="stat-num" id="result-tdee">—</span>
            <span class="stat-label">Maintenance (TDEE)</span>
          </div>
          <div class="col-md-4">
            <span class="stat-num text-emerald" id="result-target">—</span>
            <span class="stat-label" id="result-target-label">Your target</span>
          </div>
        </div>

        <p class="calc-timeline d-none" id="result-timeline"></p>

        <div class="row g-3 text-center mb-4">
          <div class="col-md-4">
            <span class="stat-num" id="result-bmi">—</span>
            <span class="stat-label">BMI</span>
          </div>
          <div class="col-md-4">
            <span class="stat-num" id="result-ideal-range">—</span>
            <span class="stat-label">Healthy weight range</span>
          </div>
          <div class="col-md-4">
            <span class="stat-num" id="result-water">—</span>
            <span class="stat-label">Water/day</span>
          </div>
        </div>

        <h3 class="mb-3" style="font-size:1.05rem;">Suggested daily macros</h3>
        <div class="row g-4 mb-4 align-items-center">
          <div class="col-md-5">
            <div class="calc-chart-col">
              <div class="calc-chart-wrap">
                <svg id="calc-macro-chart" class="calc-donut" viewBox="0 0 200 200" role="img" aria-label="Macro breakdown by percentage of daily calories">
                  <g id="calc-donut-segments"></g>
                  <text class="calc-donut-center-value" id="calc-donut-center-value" x="100" y="97" text-anchor="middle">—</text>
                  <text class="calc-donut-center-label" x="100" y="118" text-anchor="middle">kcal/day</text>
                </svg>
                <div class="calc-chart-tooltip" id="calc-chart-tooltip" role="tooltip"></div>
              </div>
              <ul class="calc-chart-legend" id="calc-chart-legend">
                <li><span class="calc-legend-key" data-series="protein"></span>Protein <strong>30%</strong></li>
                <li><span class="calc-legend-key" data-series="carbs"></span>Carbs <strong>40%</strong></li>
                <li><span class="calc-legend-key" data-series="fat"></span>Fat <strong>30%</strong></li>
              </ul>
            </div>
          </div>
          <div class="col-md-7">
            <div class="row g-3">
              <div class="col-6">
                <div class="calc-macro-card">
                  <span class="calc-macro-value" id="result-protein">—</span>
                  <span class="calc-macro-sub" id="result-protein-perkg"></span>
                  <span class="calc-macro-label">Protein (g)</span>
                </div>
              </div>
              <div class="col-6">
                <div class="calc-macro-card">
                  <span class="calc-macro-value" id="result-carbs">—</span>
                  <span class="calc-macro-label">Carbs (g)</span>
                </div>
              </div>
              <div class="col-6">
                <div class="calc-macro-card">
                  <span class="calc-macro-value" id="result-fat">—</span>
                  <span class="calc-macro-label">Fat (g)</span>
                </div>
              </div>
              <div class="col-6">
                <div class="calc-macro-card">
                  <span class="calc-macro-value" id="result-fiber">—</span>
                  <span class="calc-macro-label">Fiber (g)</span>
                </div>
              </div>
            </div>
          </div>
        </div>

        <h3 class="mb-3" style="font-size:1.05rem;">Estimated heart-rate training zones</h3>
        <div class="row g-3">
          <div class="col-md-4">
            <div class="calc-macro-card">
              <span class="calc-macro-value" id="result-hr-fatburn">—</span>
              <span class="calc-macro-label">Fat burn (50–60%)</span>
            </div>
          </div>
          <div class="col-md-4">
            <div class="calc-macro-card">
              <span class="calc-macro-value" id="result-hr-cardio">—</span>
              <span class="calc-macro-label">Cardio (60–70%)</span>
            </div>
          </div>
          <div class="col-md-4">
            <div class="calc-macro-card">
              <span class="calc-macro-value" id="result-hr-peak">—</span>
              <span class="calc-macro-label">Peak (70–85%)</span>
            </div>
          </div>
        </div>

        <div class="calc-email-capture" id="calc-email-capture">
          <h3 class="mb-1" style="font-size:1rem;">Want these numbers in your inbox?</h3>
          <p class="calc-email-capture-note">We'll send your results, plus one research-backed nutrition tip a week. No spam, unsubscribe anytime.</p>
          <form id="calc-email-form" class="calc-email-form" action="{{ route('newsletter.subscribe') }}" method="POST">
            @csrf
            <input type="hidden" name="source" value="calorie-calculator-results">
            <input type="email" name="email" id="calc-email-input" placeholder="your@email.com" required autocomplete="email" class="form-input-v2">
            <button type="submit" class="btn-pill-primary" id="calc-email-submit">Email me my results</button>
          </form>
          <p class="calc-email-message" id="calc-email-message"></p>
        </div>

        <p class="calc-disclaimer">
          This is an estimate based on population averages, not a medical assessment. Individual needs vary — consult a registered dietitian or physician for personalised guidance.
        </p>
      </div>

    </div>
  </div>
</section>

@endsection
