<?php

namespace Tests\Feature;

use App\Enums\Reservation\StatusEnum as ReservationStatusEnum;
use App\Enums\User\RoleEnum;
use App\Models\Room;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ReservationTest extends TestCase
{
    use RefreshDatabase;

    private User $client;

    private User $admin;

    protected function setUp(): void
    {
        parent::setUp();

        $this->client = User::factory()->create(['role' => RoleEnum::CLIENT->value]);
        $this->admin = User::factory()->create(['role' => RoleEnum::ADMIN->value]);
    }

    /**
     * Case: Display reservation index page.
     */
    public function test_displays_reservation_index_page()
    {
        // Arrange
        $room = Room::factory()->create();

        // Act
        $response = $this->actingAs($this->client)
            ->get(route('reservations.index'));

        // Assert
        $response->assertStatus(200)
            ->assertViewIs('reservations.index')
            ->assertViewHas('rooms')
            ->assertViewHas('statuses')
            ->assertViewHas('reservations');
    }

    /**
     * Case: Create reservation.
     */
    public function test_stores_reservation_when_room_is_available()
    {
        // Arrange
        $room = Room::factory()->create();
        $reservationData = [
            'room_id' => $room->id,
            'start_time' => now()->addDay()->setTime(14, 0),
        ];

        // Act
        $response = $this->actingAs($this->client)
            ->post(route('reservations.store'), $reservationData);

        // Assert
        $response->assertRedirect(route('reservations.index'))
            ->assertSessionHasNoErrors()
            ->assertSessionHas('success', 'Reservation created successfully.');

        $this->assertDatabaseHas('reservations', [
            'room_id' => $room->id,
            'user_id' => $this->client->id,
            'status' => ReservationStatusEnum::PENDING->value,
            'start_time' => now()->addDay()->setTime(14, 0),
            'end_time' => now()->addDay()->setTime(15, 0),
        ]);
    }
}
