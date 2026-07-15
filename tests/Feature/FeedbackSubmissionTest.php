<?php

use App\Models\Diagnosis;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

test('it stores feedback for the current diagnosis patient', function () {
    $diagnosis = Diagnosis::create([
        'patient_name' => 'Budi',
        'gender' => 'Laki-laki',
        'phone' => '08123456789',
        'birth_date' => '2023-01-01',
        'age_months' => 18,
        'address' => 'Medan',
        'diagnosis_date' => now()->toDateString(),
        'disease_id' => null,
        'belief_value' => 0.75,
        'selected_symptoms' => [1],
    ]);

    $response = $this->post(route('diagnosis.feedback.store', $diagnosis), [
        'comments' => 'Sangat membantu, terima kasih.',
    ]);

    $response->assertRedirect();
    $response->assertSessionHas('feedback_success');

    $this->assertDatabaseHas('feedbacks', [
        'diagnosis_id' => $diagnosis->id,
        'patient_name' => 'Budi',
        'comments' => 'Sangat membantu, terima kasih.',
    ]);
});
