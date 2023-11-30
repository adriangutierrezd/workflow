<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            {{ __('Preferences') }}
        </h2>
    </header>

    <form id="theme-selector-form" class="mt-3">
        <label for="theme_selector" class="form-label">{{__('Theme')}}:</label>
        <select name="theme_selector" id="theme_selector" required class="form-field mb-6">
            <option value="dark">{{__('Dark')}}</option>
            <option value="light">{{__('Light')}}</option>
            <option value="system">{{__('System preferences')}}</option>
        </select>

        <x-primary-button>{{ __('Save') }}</x-primary-button>
    </form>
</section>
@push('scripts')
    <script src="{{ asset('js/theme-selector.js') }}" defer type="module"></script>
@endpush
