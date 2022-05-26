<p class="text-sm text-gray-600 mb-4">Select a Plan</p>
@foreach($plans as $plan)

    <input type="radio" id="{{ $plan->plan_name }}-plan" name="pricing_api_id"
           @if(Auth::user()->plan->pricing_api_id == $plan->pricing_api_id)
              checked
           @endif value="{{ $plan->pricing_api_id }}"
           class="radio-plan hidden">
    <label for="{{ $plan->plan_name }}-plan"
           class="border-2 border-gray-300 w-full px-4 py-3 block rounded-lg cursor-pointer mb-3 relative">
        <div class="flex">
            <img src="/img/plans/{{ $plan->pricing_api_id }}.png"
                 class="w-16 h-16 mr-3">
            <div>
                <span class="block">{{ ucfirst($plan->plan_name) }}</span>
                <span class="text-xs text-gray-700">{{ $plan->plan_name }}</span>
                <span
                    class="absolute right-0 bottom-0 bg-indigo-600 text-white font-bold rounded-br rounded-tl-lg text-xs px-2 py-1">
                    ${{$plan->price}}/mo.
                </span>
            </div>
        </div>
    </label>
@endforeach
