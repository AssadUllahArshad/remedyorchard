<?php

namespace Database\Seeders;

use App\Models\Article;
use App\Models\Author;
use App\Models\Category;
use Illuminate\Database\Seeder;

class ArticleSeeder extends Seeder
{
    public function run(): void
    {
        $articles = [
            [
                'category' => 'heart-health',
                'author' => 'Dr. Sarah Mitchell',
                'title' => '12 Proven Home Remedies to Lower Blood Pressure Naturally',
                'slug' => 'blood-pressure-remedies',
                'excerpt' => 'Science-backed natural approaches that can make a meaningful difference, before or alongside medication.',
                'thumbnail_url' => 'https://images.unsplash.com/photo-1505576399279-565b52d4ac71?w=800&q=80&auto=format&fit=crop',
                'read_time' => '8 min read',
                'featured' => true,
                'body' => '<p>High blood pressure — hypertension — affects nearly half of all adults and is a leading risk factor for heart attack and stroke. The good news: lifestyle changes can produce meaningful, measurable reductions in blood pressure, often within weeks.</p>
<h2>1. Reduce sodium — but do it strategically</h2>
<p>The DASH diet research shows that reducing sodium to 1,500 mg per day can lower systolic blood pressure by 8–14 mmHg. Rather than eliminating salt entirely, focus on processed foods, which account for over 70% of dietary sodium intake.</p>
<h2>2. Add potassium-rich foods</h2>
<p>Potassium counteracts the blood-pressure-raising effects of sodium. Bananas, sweet potatoes, spinach, and avocados are all excellent sources. Aim for 3,500–5,000 mg per day from food sources.</p>
<h2>3. Try hibiscus tea</h2>
<p>Multiple randomised controlled trials have found that hibiscus tea can lower systolic blood pressure by 7–10 mmHg, comparable to some first-line medications. Drink 2–3 cups daily of brewed hibiscus (not commercially sweetened blends).</p>
<h2>4. Practice slow breathing</h2>
<p>The Device-Guided Slow Breathing (DGSB) technique — breathing at 6 breaths per minute — activates the parasympathetic nervous system. Studies show 5–10 minutes daily can reduce systolic blood pressure by 3–5 mmHg.</p>
<h2>5. Walk for 30 minutes daily</h2>
<p>Consistent moderate-intensity aerobic exercise reduces resting blood pressure by 5–8 mmHg. Walking is the most studied, most sustainable option — and the benefits accumulate even in three 10-minute sessions.</p>
<p><em>Medical note: These approaches work best as complements to, not replacements for, prescribed treatment. Always discuss changes with your physician.</em></p>',
                'meta_title' => '12 Natural Remedies to Lower Blood Pressure | Healthy Habits Hub',
                'meta_description' => 'Science-backed natural approaches to lower blood pressure — from hibiscus tea to the DASH diet. Reviewed by a cardiologist.',
            ],
            [
                'category' => 'nutrition',
                'author' => 'Emma Rhodes',
                'title' => 'The Anti-Inflammatory Diet: A Complete 30-Day Plan',
                'slug' => 'anti-inflammatory-diet',
                'excerpt' => "Inflammation is a common thread running through heart disease, diabetes, Alzheimer's and several cancers. This 30-day plan gives you a week-by-week way to work against it, starting with your next meal.",
                'thumbnail_url' => 'https://images.unsplash.com/photo-1547592166-23ac45744acd?w=800&q=80&auto=format&fit=crop',
                'read_time' => '12 min read',
                'featured' => true,
                'body' => <<<'EOT'
<p>Ask a cardiologist, an endocrinologist, and a neurologist what's driving the diseases they treat, and you'll hear a surprisingly similar answer from all three: inflammation. Not the visible, short-term kind — a sprained ankle, a sore throat — but a quieter, low-grade version that runs in the background for years, and that diet has an outsized influence over.</p>
<p>That's the part worth sitting with. This isn't a factor you're stuck managing after a diagnosis. It's one you can start acting on today.</p>

<h2>The research behind the plan</h2>
<p>The strongest evidence for a food-first approach to inflammation comes from PREDIMED, one of the largest and best-designed nutrition trials to date. People following a Mediterranean-style diet built around olive oil and nuts had 30% fewer cardiovascular events than those on a standard low-fat diet.</p>
<p>What makes that number more than a headline is what researchers found underneath it: measurable reductions in the actual inflammatory markers doctors test for — CRP, IL-6 and TNF-α. The diet wasn't just correlated with better outcomes; it was changing the biology behind them.</p>

<h2>How the 30 days breaks down</h2>
<p>Think of this less as a strict protocol and more as four sequential shifts — each one making the next easier.</p>

<h3>Days 1–7 — Subtract first</h3>
<p>Before adding anything, this week is about clearing space. Cut refined sugar, omega-6-rich vegetable oils (sunflower, corn, soybean), ultra-processed foods, and alcohol. It's a demanding week, but often the most impactful one — CRP levels typically start moving within these first two weeks, before any new "healthy" food has even entered the picture.</p>

<h3>Days 8–14 — Fill the space back in</h3>
<p>With the triggers out of the way, start building the foundation: fatty fish like salmon, sardines, or mackerel three times a week, leafy greens at every single meal, and extra-virgin olive oil as your go-to cooking fat in place of whatever you removed in week one.</p>

<h3>Days 15–21 — Layer in the extras</h3>
<p>This is where spices earn their place — not as a gimmick, but based on real trial data. Turmeric (always with black pepper, which meaningfully boosts absorption), ginger, and rosemary all carry anti-inflammatory effects on their own. They won't compensate for a poor diet, but stacked on top of weeks one and two, the effect is additive.</p>

<h3>Days 22–30 — Work on what you can't see</h3>
<p>The final stretch turns attention to the gut. A more diverse gut microbiome produces short-chain fatty acids that act directly on inflammatory pathways — which is why fermented foods (kefir, kimchi, sauerkraut) and fiber from whole grains, legumes, and vegetables round out the plan rather than opening it.</p>

<h2>At a glance</h2>
<table>
<thead>
<tr><th>Week</th><th>Focus</th><th>Key additions</th></tr>
</thead>
<tbody>
<tr><td>1</td><td>Remove triggers</td><td>—</td></tr>
<tr><td>2</td><td>Rebuild the base</td><td>Fatty fish, leafy greens, olive oil</td></tr>
<tr><td>3</td><td>Layer in spices</td><td>Turmeric + black pepper, ginger, rosemary</td></tr>
<tr><td>4</td><td>Support the gut</td><td>Fermented foods, fiber-rich carbs</td></tr>
</tbody>
</table>

<h2>Common questions</h2>
<h3>Will I feel different before the 30 days are up?</h3>
<p>Many people notice changes in energy and digestion within the first two weeks, largely tied to the removal phase. Markers like CRP can shift on a similar timeline, though the full picture usually takes the full month to show.</p>

<h3>What if I can't give up alcohol completely in week one?</h3>
<p>Reducing matters more than perfection here. Even cutting back significantly during the first week will support the goal — the plan is a framework, not an all-or-nothing test.</p>

<h3>Can this diet replace medication for an inflammatory condition?</h3>
<p>No. It's designed to work alongside medical treatment, not instead of it. If you have a diagnosed inflammatory or autoimmune condition, loop your doctor in before making major changes.</p>
EOT,
                'meta_title' => 'Anti-Inflammatory Diet: Complete 30-Day Plan | Healthy Habits Hub',
                'meta_description' => 'A structured 30-day anti-inflammatory diet plan reviewed by a registered dietitian. Week-by-week guide to reducing chronic inflammation through food.',
            ],
            [
                'category' => 'home-remedies',
                'author' => 'James Okafor',
                'title' => '7 Adaptogenic Herbs That Actually Work for Stress Relief',
                'slug' => 'adaptogenic-herbs',
                'excerpt' => 'Ashwagandha, rhodiola, holy basil — the research on adaptogens has exploded in the past decade. Here\'s what holds up.',
                'thumbnail_url' => 'https://images.unsplash.com/photo-1416879595882-3373a0480b5b?w=800&q=80&auto=format&fit=crop',
                'read_time' => '7 min read',
                'featured' => false,
                'body' => '<p>Adaptogens are a class of herbs that help the body maintain equilibrium under physical and psychological stress — at least in theory. The concept was formalised by Soviet pharmacologist Nikolai Lazarev in 1947, and while Western medicine has been slow to take it seriously, the clinical evidence has grown substantially in the past decade.</p>
<h2>1. Ashwagandha (Withania somnifera)</h2>
<p>The best-studied adaptogen. A 2019 meta-analysis of five randomised controlled trials found significant reductions in self-reported stress and cortisol levels with doses of 300–600 mg of root extract daily. Look for KSM-66 or Sensoril extract — both are well-standardised.</p>
<h2>2. Rhodiola rosea</h2>
<p>Particularly effective for mental fatigue and burnout. A 2017 Cochrane-linked review found meaningful improvement in stress-related burnout symptoms with 200–400 mg daily. Works faster than most adaptogens — effects often felt within 1–2 weeks.</p>
<h2>3. Holy Basil (Ocimum tenuiflorum)</h2>
<p>Known in Ayurvedic medicine as "Tulsi." Clinical trials have shown reductions in anxiety, cortisol, and blood glucose, with an especially strong safety profile. It can be consumed as tea — a practical advantage over capsule-only herbs.</p>
<h2>4. Panax Ginseng</h2>
<p>The most researched ginseng species for cognitive performance under stress. Benefits are well-documented but dose-dependent — most effective evidence uses 200–400 mg standardised to 4% ginsenosides. Avoid taking late in the day; it can interfere with sleep.</p>',
                'meta_title' => '7 Adaptogenic Herbs for Stress: What the Research Shows',
                'meta_description' => 'Ashwagandha, rhodiola, holy basil and more — a naturopathic doctor reviews the clinical evidence for the most popular adaptogenic herbs.',
            ],
            [
                'category' => 'sleep',
                'author' => 'Dr. Priya Nair',
                'title' => 'Sleep Hygiene for Adults Over 40: Why It Changes and What to Do',
                'slug' => 'sleep-hygiene',
                'excerpt' => 'Sleep architecture shifts significantly after 40. Understanding circadian biology helps you stop fighting your own body clock.',
                'thumbnail_url' => 'https://images.unsplash.com/photo-1631558432963-2c7eb7fdc5e2?w=800&q=80&auto=format&fit=crop',
                'read_time' => '9 min read',
                'featured' => false,
                'body' => '<p>Sleep complaints are among the most common health concerns I see in patients over 40 — and most of them are working against their own biology without realising it. Understanding what actually changes about sleep as we age makes the solutions much clearer.</p>
<h2>What changes after 40</h2>
<p>Three things shift measurably in sleep architecture after mid-life. First, slow-wave sleep (deep sleep) decreases — this is where physical restoration and memory consolidation happen. Second, the circadian rhythm advances, meaning most people naturally feel sleepy earlier and wake earlier. Third, sleep becomes more fragmented, with more and longer awakenings.</p>
<h2>Melatonin production declines</h2>
<p>Melatonin output drops substantially after 40, which is why the timing of light exposure becomes more important. Evening light — especially blue-spectrum light from screens — suppresses melatonin and delays sleep onset. This is not just a recommendation to "put the phone down" — it\'s a biological intervention.</p>
<h2>What actually helps</h2>
<h3>Light therapy in the morning</h3>
<p>10,000 lux bright light exposure within an hour of waking advances the circadian phase and improves sleep quality more consistently than any supplement. A 20–30 minute session is sufficient.</p>
<h3>Consistent sleep and wake times</h3>
<p>Irregular schedules are one of the most underappreciated causes of poor sleep quality. The circadian system is trained by consistency — even a 45-minute difference on weekends ("social jet lag") measurably impairs sleep architecture.</p>
<h3>Temperature regulation</h3>
<p>Core body temperature needs to drop 1–2°F to initiate sleep. Keeping your bedroom at 65–68°F (18–20°C) actively supports this process. A warm bath 1–2 hours before bed paradoxically helps by triggering compensatory cooling afterwards.</p>',
                'meta_title' => 'Sleep Changes After 40: What Shifts and What to Do | Healthy Habits Hub',
                'meta_description' => 'A sleep medicine specialist explains how sleep architecture changes after 40 and what evidence-based strategies actually improve sleep quality.',
            ],
            [
                'category' => 'fitness',
                'author' => 'Carlos Mendez',
                'title' => 'Zone 2 Cardio: The Most Underrated Health Investment You Can Make',
                'slug' => 'zone-2-cardio',
                'excerpt' => 'Elite athletes do 80% of their training at low intensity. Emerging research shows this approach delivers remarkable benefits for everyone.',
                'thumbnail_url' => 'https://images.unsplash.com/photo-1571019613454-1cb2f99b2d8b?w=800&q=80&auto=format&fit=crop',
                'read_time' => '10 min read',
                'featured' => true,
                'body' => '<p>If you\'ve spent any time in fitness circles recently, you\'ve probably heard about Zone 2 training. The concept comes from elite sport — professional endurance athletes like marathon runners and cyclists do roughly 80% of their training volume at very low intensities. Researchers are now understanding why, and the findings are relevant for everyone, not just competitive athletes.</p>
<h2>What is Zone 2?</h2>
<p>Zone 2 refers to the intensity range where you\'re working aerobically but comfortably — able to hold a conversation, working at roughly 60–70% of your maximum heart rate. Physiologically, it\'s the intensity at which fat is your primary fuel source and your mitochondria are working hard but not stressed.</p>
<h2>The mitochondrial advantage</h2>
<p>Mitochondria — the cellular engines that produce ATP (energy) — are the key mechanism here. Zone 2 training is the most effective stimulus for mitochondrial biogenesis (creating more mitochondria) and improving their efficiency. This matters because mitochondrial density and function are among the strongest predictors of both athletic performance and metabolic health across the lifespan.</p>
<h2>The metabolic health case</h2>
<p>A 2022 study by Iñigo San Millán — one of the leading researchers in Zone 2 — found that four months of Zone 2 training produced significant improvements in fat oxidation, lactate clearance, and insulin sensitivity in overweight adults. The improvements were comparable to pharmaceutical interventions for metabolic syndrome, without the side effects.</p>
<h2>How to implement it</h2>
<p>The target is 150–180 minutes per week of true Zone 2 exercise — this is more than most people currently do. Walking at a brisk pace, cycling at an easy effort, swimming laps at a comfortable speed all qualify. The key is staying genuinely easy — if you\'re slightly breathless, you\'re likely in Zone 3.</p>',
                'meta_title' => 'Zone 2 Cardio: Benefits, How-To, and What Science Says',
                'meta_description' => 'A certified strength coach explains Zone 2 training — what it is, why it\'s so effective for metabolic and cardiovascular health, and how to do it.',
            ],
            [
                'category' => 'mental-health',
                'author' => 'Dr. Maya Chen',
                'title' => 'The Science of Stress: Why Chronic Stress Is Different From Acute Stress',
                'slug' => 'chronic-vs-acute-stress',
                'excerpt' => 'Not all stress is harmful. Understanding the difference between acute and chronic stress helps you work with your nervous system, not against it.',
                'thumbnail_url' => 'https://images.unsplash.com/photo-1506126613408-eca07ce68773?w=800&q=80&auto=format&fit=crop',
                'read_time' => '8 min read',
                'featured' => false,
                'body' => '<p>We talk about stress as if it\'s a single thing — but the physiology of a stressful moment before an important meeting and the physiology of being chronically overwhelmed for three months are fundamentally different. Understanding this distinction changes how you approach stress management.</p>
<h2>The acute stress response: designed to help</h2>
<p>When you perceive an immediate threat, the hypothalamic-pituitary-adrenal (HPA) axis activates within milliseconds. Adrenaline and noradrenaline flood the bloodstream, heart rate and blood pressure rise, blood sugar spikes, and the immune system briefly upregulates. This cascade is not harmful — it\'s adaptive, and it resolves within minutes to hours once the stressor passes.</p>
<h2>What happens when stress becomes chronic</h2>
<p>The problem is the modern stress landscape. Relationship conflicts, financial pressure, work demands, and health worries don\'t resolve in minutes. When the HPA axis stays activated for weeks or months, cortisol — which is anti-inflammatory and useful in the short term — becomes chronically elevated and begins to cause damage. Hippocampal neurons are particularly vulnerable: chronic stress literally shrinks the brain\'s memory centre.</p>
<h2>The evidence-based interventions</h2>
<p>The most robust data supports three categories of intervention for chronic stress. Mindfulness-Based Stress Reduction (MBSR) — an 8-week structured programme — has been shown in multiple RCTs to reduce perceived stress and cortisol. Exercise remains the most well-studied and effective single intervention. And sleep quality directly regulates HPA axis function — poor sleep perpetuates chronic stress in a vicious cycle.</p>',
                'meta_title' => 'Chronic vs Acute Stress: The Science and What to Do About It',
                'meta_description' => 'An integrative medicine physician explains the physiology of stress, why chronic stress damages the brain and body, and what evidence-based interventions actually help.',
            ],
        ];

        foreach ($articles as $data) {
            $category = Category::where('slug', $data['category'])->first();
            $author = Author::where('name', 'like', '%' . $data['author'] . '%')->first();

            if (!$category || !$author) {
                continue;
            }

            Article::firstOrCreate(
                ['slug' => $data['slug']],
                [
                    'title' => $data['title'],
                    'slug' => $data['slug'],
                    'excerpt' => $data['excerpt'],
                    'body' => $data['body'],
                    'category_id' => $category->id,
                    'author_id' => $author->id,
                    'thumbnail_url' => $data['thumbnail_url'],
                    'read_time' => $data['read_time'],
                    'status' => 'published',
                    'published_at' => now()->subDays(rand(1, 30)),
                    'meta_title' => $data['meta_title'],
                    'meta_description' => $data['meta_description'],
                    'featured' => $data['featured'],
                ]
            );
        }
    }
}
