<?php

namespace Tests\Feature;

use App\Models\FlightSchedule;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Log;
use Tests\TestCase;

class FlightControllerTest extends TestCase
{
    use DatabaseTransactions;
    use WithFaker;

    public function testBookFlight()
    {
        // Create a user and log them in
        $user = User::factory()->create();
        $this->actingAs($user);

        // Create a flight schedule
        $flight = FlightSchedule::factory()->create([
            'slug' => 'test-flight',
        ]);

        // Make a request to the bookFlight route
        $response = $this->get(route('book-flight', ['slug' => $flight->slug]));

        Log::info($response->getContent());
        // Assert that the response status is 200
        $response->assertStatus(200);

        // Assert that the view contains the flight data
        $response->assertViewHas('flight', function ($viewFlight) use ($flight) {
            return $viewFlight->id === $flight->id;
        });

        // Assert that the view contains seats data
        $response->assertViewHas('seats');
    }

    /**
     * Test storePassengerInfo method
     *
     * @return void
     */
    public function testStorePassengerInfo()
    {
        // Create a user and log them in
        $user = User::factory()->create();
        $this->actingAs($user);

        // Create a flight schedule
        $flight = FlightSchedule::factory()->create([
            'slug' => 'test-flight',
        ]);

        // Prepare passenger data
        $passengerData = [
            'is_random' => 0,
            'passengers' => [
                [
                    'firstname' => 'John',
                    'lastname' => 'Doe',
                    'dob' => '2010-05-05',
                    'seat' => '1A',
                ],
                [
                    'firstname' => 'Jane',
                    'lastname' => 'Doe',
                    'dob' => '2008-05-05',
                    'seat' => '1B',
                ],
            ],
            'fireExitResponsibility' => 1,
        ];

        // Make a request to the storePassengerInfo route
        $response = $this->post(route('store-passenger-info', ['slug' => $flight->slug]), $passengerData);

        // Assert that the response is a redirect to the index route
        $response->assertRedirect(route('index'));

        // Assert that the booking and booking seats were created in the database
        $this->assertDatabaseHas('bookings', [
            'flight_schedule_id' => $flight->id,
            'user_id' => $user->id,
        ]);

        foreach ($passengerData['passengers'] as $passenger) {
            $this->assertDatabaseHas('booking_seats', [
                'first_name' => $passenger['firstname'],
                'last_name' => $passenger['lastname'],
                'dob' => $passenger['dob'],
            ]);
        }
    }
}
