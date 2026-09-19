<?php

namespace App\Services;

use App\Models\Symptom;
use App\Models\Disease;

class DempsterShaferService
{
    /**
     * Run Dempster-Shafer inference.
     *
     * @param  array  $symptomIds   Array of selected Symptom IDs
     * @return array  ['disease' => Disease|null, 'belief' => float, 'steps' => array]
     */
    public function diagnose(array $symptomIds): array
    {
        if (empty($symptomIds)) {
            return ['disease' => null, 'belief' => 0.0, 'steps' => []];
        }

        // Load symptoms with their related diseases
        $symptoms = Symptom::with('diseases')->whereIn('id', $symptomIds)->get();

        // Get all diseases for building hypothesis sets
        $diseases = Disease::all()->keyBy('id');
        $diseaseIds = $diseases->keys()->toArray();

        // ── Initialise mass functions ─────────────────────────────────────────
        // We start from the first symptom
        $current = $this->initMass($symptoms->first(), $diseaseIds);
        $steps   = [$current];

        // Combine each subsequent symptom
        foreach ($symptoms->slice(1) as $symptom) {
            $next    = $this->initMass($symptom, $diseaseIds);
            $current = $this->combine($current, $next);
            $steps[] = $current;
        }

        // ── Find the hypothesis with the highest belief ───────────────────────
        $maxBelief  = 0.0;
        $maxDiseaseId = null;

        foreach ($current['beliefs'] as $key => $value) {
            if ($key === 'theta') continue; // skip the uncertainty set
            if ($value > $maxBelief) {
                $maxBelief    = $value;
                $maxDiseaseId = $key; // key is either a single disease id or "d1,d2" joint
            }
        }

        // If the top belief is a joint hypothesis, pick the one with highest individual belief
        if ($maxDiseaseId && str_contains((string)$maxDiseaseId, ',')) {
            $parts = explode(',', $maxDiseaseId);
            $maxDiseaseId = $parts[0];
        }

        $disease = $maxDiseaseId ? $diseases->get((int)$maxDiseaseId) : null;

        return [
            'disease' => $disease,
            'belief'  => $maxBelief,
            'steps'   => $steps,
        ];
    }

    /**
     * Initialise the mass function for a single symptom.
     * A symptom either supports specific disease(s) or theta (all diseases).
     */
    private function initMass(Symptom $symptom, array $diseaseIds): array
    {
        $density       = (float) $symptom->density;
        $plausibility  = 1 - $density;
        $relatedIds    = $symptom->diseases->pluck('id')->toArray();

        $beliefs = [];

        if (empty($relatedIds)) {
            // No known disease link → supports theta only
            $beliefs['theta'] = 1.0;
        } elseif (count($relatedIds) === 1) {
            $id = $relatedIds[0];
            $beliefs[(string)$id] = $density;
            $beliefs['theta']     = $plausibility;
        } else {
            // Symptom shared across multiple diseases
            $jointKey = implode(',', $relatedIds);
            $beliefs[$jointKey] = $density;
            $beliefs['theta']   = $plausibility;
        }

        return [
            'symptom'  => $symptom->name,
            'density'  => $density,
            'beliefs'  => $beliefs,
        ];
    }

    /**
     * Dempster's combination rule for two mass functions.
     * m3(Z) = Σ_{X∩Y=Z} m1(X)·m2(Y) / (1 − K)
     * where K = Σ_{X∩Y=∅} m1(X)·m2(Y)
     */
    private function combine(array $m1data, array $m2data): array
    {
        $m1 = $m1data['beliefs'];
        $m2 = $m2data['beliefs'];

        $numerators = [];
        $conflict   = 0.0;

        foreach ($m1 as $x => $v1) {
            foreach ($m2 as $y => $v2) {
                $product      = $v1 * $v2;
                $intersection = $this->intersect($x, $y);

                if ($intersection === null) {
                    $conflict += $product;
                } else {
                    $numerators[$intersection] = ($numerators[$intersection] ?? 0.0) + $product;
                }
            }
        }

        $denominator = 1 - $conflict;
        if ($denominator <= 0) $denominator = 1e-9;

        $beliefs = [];
        foreach ($numerators as $key => $val) {
            $beliefs[$key] = $val / $denominator;
        }

        return [
            'symptom' => $m2data['symptom'],
            'density' => $m2data['density'],
            'beliefs' => $beliefs,
        ];
    }

    /**
     * Compute the intersection of two hypothesis sets.
     * Returns null when the intersection is empty (conflict).
     */
    private function intersect(string $x, string $y): ?string
    {
        if ($x === 'theta') return $y;
        if ($y === 'theta') return $x;

        $setX = explode(',', $x);
        $setY = explode(',', $y);

        $common = array_intersect($setX, $setY);

        if (empty($common)) return null;

        sort($common);
        return count($common) === 1 ? $common[0] : implode(',', $common);
    }
}
