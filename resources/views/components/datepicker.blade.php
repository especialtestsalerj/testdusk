@props([
    'id' => 'reservation_date',
    'name' => 'reservation_date',
    'label' => 'Data da Visita',
    'value' => '',
    'wireModel' => 'reservation_date',
    'xRef' => 'reservation_date',
    'blockedDates' => [],
    'maxDate' => null,
    'dateFormat' => 'd/m/Y',
    'options' => [],
    'required' => false,
])

<div {{ $attributes->merge(['class' => 'w-full']) }}>
    <label for="{{ $id }}"
           class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
        {{ $label }} @if($required) * @endif
    </label>
    <input id="{{ $id }}" type="button"
           value="{{ $value }}"
           name="{{ $name }}"
           wire:model="{{ $wireModel }}"
           x-ref="{{ $xRef }}"
           class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg
                  focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5
                  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400
                  dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
    <div>
        @error($name)
        <small class="text-danger text-red-700">
            <i class="fas fa-exclamation-triangle"></i>
            {{ $message }}
        </small>
        @enderror
    </div>
</div>
<input type="hidden" name="{{ $name }}"
       value="{{ $value }}"
       wire:model="{{ $wireModel }}" />

@push('scripts')
    <!-- Include Flatpickr scripts -->
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr/dist/l10n/pt.js"></script>
    <script>
        document.addEventListener('livewire:load', function () {
            var blockedDates = @json($blockedDates);
            var maxDate = @json($maxDate);
            var inputId = "{{ $id }}";
            var wireModel = "{{ $wireModel }}";

            var flatpickrInstance = flatpickr("#" + inputId, {
                locale: "pt",
                dateFormat: "{{ $dateFormat }}",
                minDate: "today",
                maxDate: maxDate ? new Date().fp_incr(maxDate) : null,
                disable: [
                    function (date) {
                        // Disable Saturdays (6) and Sundays (0)
                        return (date.getDay() === 6 || date.getDay() === 0);
                    }
                ].concat(blockedDates),
                onChange: function (selectedDates, dateStr, instance) {
                    @this.set(wireModel, dateStr);
                },
                ...@json($options),
            });

            Livewire.on('blockedDatesUpdated', function (newBlockedDates) {
                flatpickrInstance.set('disable', [
                    function (date) {
                        return (date.getDay() === 6 || date.getDay() === 0);
                    }
                ].concat(newBlockedDates));

                if (maxDate) {
                    flatpickrInstance.set('maxDate', new Date().fp_incr(maxDate));
                }
            });

            Livewire.on('maxDateUpdated', function (newMaxDate) {
                maxDate = newMaxDate;
                flatpickrInstance.set('maxDate', new Date().fp_incr(newMaxDate));
            });
        });
    </script>
@endpush
