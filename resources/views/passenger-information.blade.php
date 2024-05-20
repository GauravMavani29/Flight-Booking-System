<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            background-color: #f8f9fa;
        }

        .container {
            max-width: 600px;
            margin: 8px auto;
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h1 {
            text-align: center;
            margin-bottom: 20px;
        }

        .form-group {
            margin-bottom: 15px;
        }

        label {
            display: block;
            margin-bottom: 5px;
        }

        input[type="text"],
        input[type="email"],
        input[type="number"] {
            width: 100%;
            padding: 8px;
            box-sizing: border-box;
        }

        .btn-submit {
            display: block;
            width: 100%;
            padding: 10px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        .btn-submit:hover {
            background-color: #0056b3;
        }

        .passenger-box {
            border: 1px solid #ccc;
            padding: 10px;
            margin-bottom: 20px;
            border-radius: 8px;
        }
    </style>

    <script>
        function calculateDiscount(dobInputId, discountMessageId, seatPrice) {
            const dobInput = document.getElementById(dobInputId);
            const discountMessage = document.getElementById(discountMessageId);

            dobInput.addEventListener('input', function() {
                var dob = new Date(dobInput.value);
                var today = new Date();
                var age = today.getFullYear() - dob.getFullYear();
                const monthDiff = today.getMonth() - dob.getMonth();
                if (monthDiff < 0 || (monthDiff === 0 && today.getDate() < dob.getDate())) {
                    age--;
                }

                if (age <= 15) {
                    const discount = seatPrice * 0.25;
                    discountMessage.innerText = `Eligible for 25% discount: $${discount.toFixed(2)}`;
                } else {
                    discountMessage.innerText = '';
                }
            });
        }
    </script>

    <div class="container">
        <h1>Passenger Information</h1>
        <form action="{{ route('store-passenger-info', $flight->slug) }}" method="POST">
            @csrf
            @if ($isRandom == 1)
                @for ($i = 1; $i <= $seatCount; $i++)
                    <div class="passenger-box">
                        <h3>Passenger {{ $i }} <strong>{{ $seatClasses[$i - 1] ?? 'Random' }}
                            </strong></h3>
                        <div class="form-group">
                            <label for="passenger_name_{{ $i }}">First Name</label>
                            <input type="text" id="passenger_firstname_{{ $i }}"
                                name="passengers[{{ $i }}][firstname]" required>
                        </div>
                        <div class="form-group">
                            <label for="passenger_name_{{ $i }}">Last Name</label>
                            <input type="text" id="passenger_lastname_{{ $i }}"
                                name="passengers[{{ $i }}][lastname]" required>
                        </div>
                        <div class="form-group">
                            <label for="passenger_age_{{ $i }}">DOB</label>
                            <input type="date" id="passenger_dob_{{ $i }}"
                                name="passengers[{{ $i }}][dob]" required>
                            <p id="discount_message_{{ $i }}"
                                class="discount-message"style="color: rgb(0, 219, 0);"></p>
                        </div>
                        <input type="hidden" name="is_random" value="1">
                    </div>
                    <script>
                        // Call the function for each passenger to calculate discount
                        calculateDiscount('passenger_dob_{{ $i }}', 'discount_message_{{ $i }}',
                            {{ $seats[$i - 1]->price ?? 0 }});
                    </script>
                @endfor
            @else
                @for ($i = 1; $i <= $seatCount; $i++)
                    <div class="passenger-box">
                        <h3>Passenger {{ $i }} <strong>{{ $seatClasses[$i - 1] ?? 'Random' }} -
                                £{{ $seats[$i - 1]?->price }}</strong></h3>
                        <div class="form-group">
                            <label for="passenger_name_{{ $i }}">First Name</label>
                            <input type="text" id="passenger_firstname_{{ $i }}"
                                name="passengers[{{ $i }}][firstname]" required>
                        </div>
                        <div class="form-group">
                            <label for="passenger_name_{{ $i }}">Last Name</label>
                            <input type="text" id="passenger_lastname_{{ $i }}"
                                name="passengers[{{ $i }}][lastname]" required>
                        </div>
                        <div class="form-group">
                            <label for="passenger_age_{{ $i }}">DOB</label>
                            <input type="date" id="passenger_dob_{{ $i }}"
                                name="passengers[{{ $i }}][dob]" required>
                            <p id="discount_message_{{ $i }}" class="discount-message"
                                style="color: rgb(0, 219, 0);"></p>
                        </div>
                        <input type="hidden" name="passengers[{{ $i }}][seat]"
                            value="{{ $seats[$i - 1]->id }}">
                        <input type="hidden" name="is_random" value="0">
                    </div>
                    <script>
                        // Call the function for each passenger to calculate discount
                        calculateDiscount('passenger_dob_{{ $i }}', 'discount_message_{{ $i }}',
                            {{ $seats[$i - 1]->price }});
                    </script>
                @endfor
            @endif
            <input type="hidden" name="fireExitResponsibility" value="{{ $fireExitResponsibility }}">
            <button type="submit" class="btn-submit">Submit</button>
        </form>
    </div>

</x-app-layout>
