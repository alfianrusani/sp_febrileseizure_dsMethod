<?php

use App\Models\Disease;
use App\Models\Treatment;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

it('does not create a second treatment for a disease that already has one', function () {
    $disease = Disease::create([
        'code' => 'P99',
        'name' => 'Penyakit Uji',
        'description' => 'Deskripsi uji',
        'treatment' => 'Penanganan default',
    ]);

    $existingTreatment = Treatment::create([
        'disease_id' => $disease->id,
        'action_title' => 'Tindakan awal',
        'first_step_handling' => 'Penanganan awal',
        'medicine' => 'Obat awal',
    ]);

    $response = $this->withoutMiddleware()->post(route('admin.treatments.store'), [
        'disease_id' => $disease->id,
        'action_title' => 'Tindakan baru',
        'first_step_handling' => 'Penanganan baru',
        'medicine' => 'Obat baru',
    ]);

    $response->assertRedirect(route('admin.treatments.edit', $existingTreatment));
    expect(Treatment::where('disease_id', $disease->id)->count())->toBe(1);
});
