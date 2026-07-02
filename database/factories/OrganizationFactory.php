<?php

namespace Database\Factories;

use App\Models\Organization;
use Illuminate\Database\Eloquent\Factories\Factory;

class OrganizationFactory extends Factory
{
    protected $model = Organization::class;

    public function definition(): array
    {
        return [
            'type' => Organization::TYPE_REGION,
            'name' => fake()->unique()->city(),
            'code' => fake()->unique()->bothify('??-###'),
            'is_active' => true,
            'sort_order' => 0,
        ];
    }

    public function region(): static
    {
        return $this->state(fn (array $attributes) => [
            'type' => Organization::TYPE_REGION,
            'name' => 'Region ' . fake()->numberBetween(1, 13),
            'code' => fake()->unique()->lexify('REG-???'),
            'parent_id' => null,
        ]);
    }

    public function province(): static
    {
        return $this->state(fn (array $attributes) => [
            'type' => Organization::TYPE_PROVINCE,
            'name' => fake()->unique()->city() . ' Province',
            'code' => fake()->unique()->lexify('PROV-???'),
        ]);
    }

    public function lgu(): static
    {
        return $this->state(fn (array $attributes) => [
            'type' => Organization::TYPE_LGU,
            'name' => fake()->unique()->city(),
            'code' => fake()->unique()->lexify('LGU-???'),
        ]);
    }

    public function barangay(): static
    {
        return $this->state(fn (array $attributes) => [
            'type' => Organization::TYPE_BARANGAY,
            'name' => 'Barangay ' . fake()->unique()->lastName(),
            'code' => fake()->unique()->lexify('BRGY-???'),
        ]);
    }

    public function department(): static
    {
        return $this->state(fn (array $attributes) => [
            'type' => Organization::TYPE_DEPARTMENT,
            'name' => fake()->randomElement([
                'Human Resources Department',
                'Engineering Department',
                'Health Department',
                'Education Department',
                'Finance Department',
            ]),
            'code' => fake()->unique()->lexify('DEPT-???'),
        ]);
    }

    public function probation(): static
    {
        return $this->state(fn (array $attributes) => [
            'type' => Organization::TYPE_PROBATION,
            'name' => fake()->randomElement([
                'Probation Office',
                'Parole Division',
                'Community Supervision Unit',
            ]),
            'code' => fake()->unique()->lexify('PROB-???'),
        ]);
    }
}
